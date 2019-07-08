<?php
	if(!isset($get_file_name)){    
    ob_start();
  require_once "../../requires/login_session.php";
}
	//$user=$_GET['id'];
	//echo "select * from t_deptt_f_registration where user_id='".$user."'";
	$user=3;
	//echo "select * from rfs_form1 where user_id='".$user."'";exit;
     $sql=$rfs->query("select * from rfs_form1 where user_id='$swr_id' ");	
    $rows=$sql->fetch_array();
	$firm_name=$rows["firm_name"];$form_id=$rows["form_id"];
	$sq=$rfs->query("select * from rfs_form4 where user_id='$swr_id' ");
        $ro=$sq->fetch_array();	
		$memberCount=mysqli_num_rows($sq);
      $date_open=$ro["date_open"];$date_close=$ro["date_close"];$remark=$ro["remark"];$business_open=$ro["business_open"];$regn_no=$ro["regn_no"];
	    $partner=json_decode($ro['partner'],true);
	$sql1=$rfs->query("select * from t_deptt_f_reg_address where form_id='$form_id' ");
$rows1=$sql1->fetch_array();
$dist_name=$rows1["dist_name"];$mouza=$rows1["mouza"];$circle=$rows1["circle"];$patta_no=$rows1["patta_no"];
$dag_no=$rows1["dag_no"];$area=$rows1["area"];$po_name=$rows1["po_name"];$ps_name=$rows1["ps_name"];
$pincode=$rows1["pin_code"]; $address=$mouza."   ".$circle."   ".$patta_no."  ".$dag_no."  ".$area."   ".$po_name."   ".$ps_name."  ".$pincode;
 $q1="select * from t_deptt_f_reg_partners where form_id=$form_id";$pem=$rfs->query($q1);{while($pem_data=$pem->fetch_assoc())  $sunil=$pem_data['partner_name'];   
}$upload=$server_url."departments/rfs/forms/upload/";
	$form_name=$formFunctions->get_formName('rfs','4');
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form3</title>
<style>
input, text { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 500px;
 width="100%"
}
</style>
</head>
<body>';    
}else{
      $printContents='';
}
if(!empty($results["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'<div>
    <link href="css/style.css" rel="stylesheet"/>
	
    </p>
	
		<h3 style="text-align:center">Form No III<br>'.$form_name.'
                        </h3>
        
			<table width="100%" class="table table-bordered table-responsive">  
								<tr>
								<td colspan="2">
								To,<br>
								The Registrar of Firms,Assam<br>
								Housefed Complex, Dispur, Guwahati-06
								</td>
								</tr>
								<tr>
								<td colspan="2">
								<p class="left50px">
									 Notice is hereby given, pursuant to section 61 and Rule 4(4) of the Indian Partnership Act,1932 of the closing/opening of the following place/places of business of the firm&nbsp;
									<b>'.$firm_name.'</b>&nbsp;(other than the principal places of business) Regn. No. &nbsp;<b>'.$regn_no.'</b>&nbsp; 
								</p>
								</td>
								</tr>
								<tr>
								
								</tr>
								</table>
								<p></p>
								<table width="100%" border="1" class="table table-bordered table-responsive">  
								
								<tr>
								<th>Place of Business Closed</th>
								<th>Date Of Closing</th>
								<th>Place of business opened</th>
								<th>Date of Opening</th>
								<th>Remarks</th>
								</tr>
								<tr>
								
								<td>'.strtoupper($address).'</td>
								<td>'.strtoupper($date_close).'</td>
								<td>'.strtoupper($business_open).'</td>
								<td>'.strtoupper($date_open).'</td>
								<td>'.strtoupper($remark).'</td>
								</tr>
								</table>
								<h3 align="center"><u>VERIFICATION</u></h3>
								<p style="text-indent:50px">
								We, the partners of the firm <b>'.$sunil.'</b>
								do hereby declare that the foregoing statement is true to our knowledge and belief.
								</p>
								
					
							
				
								<table width="100%" class="table table-bordered table-responsive">  
				      <tr>
						<td><b>S.NO</b></td>
						<td><b>Witness or Witnesses Attesting the Signatures</b></td>
						  <td><b>Scanned copy of signatures of the member of  the society <br/>in full</b></td>
						 </tr>
					
					';
					if($memberCount>0){
					
                   
					$moreindex1=count($partner); 
					for($m=1;$m<=count($partner);$m++){					
	                    $p="p$m";
						
						
						$printContents=$printContents.'
						<tr>
						<td>'.$m.'</td>
						<td>
						
						 '.strtoupper($partner[$m]['pname']).'
						</td>
						<td>
							<img  src="'.$upload.$partner[$m]['photo'].'" width="200px" height="40px"/>
								
						</td>
					</tr>';
					}
				}$printContents=$printContents.'
				</table>';
								
								
								
        
			
			//echo $printContents123;exit;
		
	
if(!isset($get_file_name))
{   
    $mypdf="FIRM-".$sid.".pdf";
    ob_end_clean();
    include('../../../mpdf60/mpdf.php'); 
    $mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;
    $mpdf->WriteHTML($printContents);
    	
    $mpdf->Output($mypdf,'I');

  $rfs->close();
} 
?>