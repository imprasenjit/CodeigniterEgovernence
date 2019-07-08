<?php
$dept="land";
$form="1";
$table_name=getTableName($dept,$form);
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from land_form1 where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from land_form1 where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from land_form1 where user_id='$swr_id' and form_id='$form_id'");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from land_form1 where user_id='$swr_id' and active='1'");
	} 
		
    
      
        //$q=$formFunctions->executeQuery($dept,"select * from land_form1 where user_id=$swr_id") ;
        
		$results=$q->fetch_assoc();

        if($q->num_rows>0){
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
            $adhar_no=$results["adhar_no"];$post_office=$results["post_office"];$parties=$results["parties"];$desc_doc=$results["desc_doc"];$reg_off=$results["reg_off"];$rel_petition=$results["rel_petition"];$deed_no=$results["deed_no"];$deed_year=$results["deed_year"];$req_nature=$results["req_nature"];$remarks=$results["remarks"];
            

            
            $file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];

        if(!isset($css)){
            $val1=$formFunctions->get_uploadFile($file1);
            $val2=$formFunctions->get_uploadFile($file2);
            $val3=$formFunctions->get_uploadFile($file3);
            $val4=$formFunctions->get_uploadFile($file4);
            
        }else{
            $val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
            $val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
            $val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
            $val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
        }
        if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
            $courier_details=json_decode($results["courier_details"]);
            $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
        }else{
            $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
        }
        $desc_doc= wordwrap($desc_doc, 40, "<br/>", true);
        $remarks= wordwrap($remarks, 40, "<br/>", true);
    }
    if($results["payment_mode"]==0){
		$payment_mode="OFFLINE";
		$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
	}else{
		$payment_mode="ONLINE";
	}
    $form_name=$formFunctions->get_formName($dept,$form);    
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 1</title>
<style>
input, textarea { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 700px;
  width: 100%;
}
#form1 table {
  vertical-align: middle;
}
</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM NO. 1</h4>
         <p  style="text-align:center"> Department: Revenue</p>
        <h4>'.$form_name.'</h4>
        </div><br/>
            <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr>
                    <td colspan="2"><strong> Applicant&apos;s Details</strong></td>
                </tr>
                <tr>
                    <td style="width:50%"> Applicant&apos;s Name</td>
                    <td style="width:50%">'.strtoupper($key_person).'</td>
				</tr>
				<tr>
                    <td>Mobile Number</td>
                    <td>'.strtoupper($mobile_no).'</td>
                </tr>
                <tr>
                    <td>Mail Id</td>
                    <td>'.$email.'</td>
				</tr>
                <tr>
                    <td>Pan Number</td>
                    <td>'.strtoupper($pan_no).'</td>
                </tr>
                <tr>
                    <td>Aadhar card Number</td>
                    <td>'.strtoupper($adhar_no).'</td>
				</tr>
                <tr>
                    <td>Date of Application</td>
                    <td>'.date('d-m-Y', strtotime($today)).'</td>                 
                </tr>

                <tr>
                    <td colspan="2"><strong>Address Details</strong></td>
                </tr>
                <tr>
					<td >Street Name 1 </td>
                    <td >'.strtoupper($b_street_name1).'</td>
				</tr>
                <tr>
                    <td>Street Name 2 </td>
                    <td>'.strtoupper($b_street_name2).'</td>
                </tr>
                <tr>
					<td>State </td>
					<td>ASSAM</td>
				</tr>
                <tr>
					<td>District </td>
					<td>'.strtoupper($b_dist).'</td>
                </tr>
                <tr>
					<td>Sub-Division </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
                <tr>
					<td>Circle Office </td>
					<td>'.strtoupper($revenue).'</td>
                </tr>
                <tr>
					<td>Mouza</td>
					<td>'.strtoupper($mouza).'</td>
				</tr>
                <tr>
					<td>Village/Town </td>
					<td>'.strtoupper($b_vill).'</td>
                                
                </tr>
                
                <tr>
					<td>Post Office </td>
					<td>'.strtoupper($post_office).'</td>
				</tr>
                <tr>
					<td>Pin Code </td>
					<td>'.strtoupper($b_pincode).'</td>
                </tr>
                       
                <tr>
                    <td colspan="2"><strong>Other Details</strong></td>
                </tr>
                <tr>                  
					<td>Name of the parties with concerned document </td>
					<td>'.strtoupper($parties).'</td>
                </tr>
                <tr>
					<td>Description of Document I /Land II / Marriage III </td>
					<td>'.strtoupper($desc_doc).'</td>
                </tr>
                <tr>
					<td>Name of Registering office where deed is registered </td>
					<td>'.strtoupper($reg_off).'</td>
				</tr>
                <tr>
					<td>Relation of Petitioner with the subject matter</td>
					<td>'.strtoupper($rel_petition).'</td>
                </tr>
                <tr>
					<td>Deed No </td>
					<td>'.strtoupper($deed_no).'</td>
				</tr>
                <tr>
					<td>Year of Deed</td>
					<td>'.strtoupper($deed_year).'</td>
                </tr>
                <tr>
					<td>Nature of Requirement </td>
					<td>'.strtoupper($req_nature).'</td>
				</tr>
                <tr>
					<td>Remarks </td>
					<td>'.strtoupper($remarks).'</td>
                </tr>
				<tr><td colspan="2">Checklists.<br/>* NA - Not Applicable <br/>* SC - Send By Courier</td></tr>
				<tr><td>1. NOC of DC.</td><td >'.$val1.'</td></tr>
				<tr><td>2. NOC from GMDA/Permission from Municipality.</td><td>'.$val2.'</td></tr>
				<tr><td>3. Original deed in stamp paper (with stamp assessment).</td><td>'.$val3.'</td></tr> </tr>  
				<tr><td>4. Any other document.</td><td>'.$val4.'</td></tr>';
				
        if(!empty($results["courier_details"] && $results["courier_details"]!=1)){
            $printContents=$printContents.'
            <tr>           
            <td colspan="2">
                <table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
                    <tr><td height="30px" colspan="2">Courier Details.</td></tr>
                    <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
                    <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
                    <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
                </table>
            </td>
            </tr>
            ';              
            } 
			if($results["payment_mode"]!=NULL){ 
			$printContents=$printContents.'<tr>		    
			<td colspan="2">
				<table border="1" align="center" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive" width="100%">
				<tr><td height="45px" colspan="2">Payment Details :</td></tr>
				<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
				if($results["payment_mode"]==0)
				{
					$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
					<td>'.$offline_challan.'</td></tr>';
				}
				$printContents=$printContents.'</table>			
			</td>
		  </tr>';
		  }
            $printContents=$printContents.'     
        <tr>
		<td colspan="2" style="width:99%">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				 <tr>
					<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
					<td align="right">Signature of the Applicant : '.strtoupper($key_person).'<br/>
					Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
				</tr>
			</table>
        </td>
        </tr>        
    </tbody>
	</table>
';
?>