<?php if(!isset($get_file_name)){    
    ob_start();
	require_once "../../requires/login_session.php";
}
	$row1=$row1=$formFunctions->fetch_swr($swr_id);$Type_of_ownership=$row1['Type_of_ownership'];
	$pan=$row1['pan_doc'];if($Type_of_ownership=="CS"){
		$Name_of_owner=$row1['Name_of_owner'];
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
	} 
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	
	$date_of_commencement=$row1['date_of_commencement'];
	$unit_name=$row1['Name'];$pan_no=$row1['pan_no'];
	
	///registered office///
	$land_type=$row1['w_l'];$mouza=$row1['mouza'];$patta_no=$row1['pattano'];$dag_no=$row1['dagno'];$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];
	$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$circle=$row1['revenue'];$area=$b_street_name3." ,".$b_street_name4;
	//////////
	
	///other than registered office///
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];
	$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$area1=$b_street_name1." ,".$b_street_name2;
	
if($b_street_name1==$b_street_name3  && $b_street_name2==$b_street_name4 && $b_pincode==$b_pincode2 && $b_vill==$b_vill2)	{
	
	$checked11='disabled ';$checked22='checked';$style2='display:none';$style3='display:none';
	}else{
	    $checked11='checked ';$checked22='disabled';			  
}
    $query1=$rfs->query("select * from rfs_form1 where user_id='$swr_id'");
	$row=$query1->fetch_array();
	$form_id=$row["form_id"];
	$members=$rfs->query("select * from rfs_form1_partners where form_id='$form_id'");	
    $row4=$members->fetch_array();
    $memberCount=mysqli_num_rows($members); 
    $partner=json_decode($row4['partner_details'],true);
	
	$query2=$rfs->query("select * from rfs_form1_address where form_id='".$form_id."' and address_type='P'");
    $row2=$query2->fetch_array();
	if($row2["land_type"]=="O"){ $land_type1="OWN";}
	if($row2["land_type"]=="L"){ $land_type1="LEASED";}
	if($row2["land_type"]=="R"){ $land_type1="RENTED";}
	$query3=$rfs->query("select * from rfs_form1_address where form_id='".$form_id."' and address_type='O'");
    $row3=$query3->fetch_array();
	if($row3["land_type"]=="O"){ $land_type2="OWN";}
	if($row3["land_type"]=="L"){ $land_type2="LEASED";}
	if($row3["land_type"]=="R"){ $land_type2="RENTED";}
	if($row["firm_duration"]=="U"){$firm_duration="UNLIMITED";}else{$firm_duration="LIMITED";}
	if($row3['area']==''){
	$land_type2='NA';$row3['mouza']='NA';$row3['circle']='NA';$row3['patta_no']='NA';$row3['dag_no']='NA';
    $row3['area']='NA';$row3['vtc_name']='NA';$row3['po_name']='NA';$row3['ps_name']='NA';$row3['dist_name']='NA';
    $row3['pin_code']='NA';
}  $upload=$server_url."departments/rfs/forms/upload/";$upload1=$server_url."Document_locker/";

         if($land_type1=='OWN'){
         $land_type_condition1= '<tr>
				<td>Mouza </td>
				
				<td>'.$mouza.'</td>
			
				<td>Circle </td>
				
				<td> '.$circle.'</td>
			</tr>
			<tr>
				<td>Patta No. </td>
				
				<td>'.$patta_no.'</td>
			
				<td>Dag No. </td>
				
				<td>'.$dag_no.'</td>
			</tr>';
		}else{$land_type_condition1="";}

		
        if($row3['area']!='NA'){

        	  $land_type_condition_p='<tr>
				
				<td>
					<br></br><b>7. Does the proposed firm carry out its business in any other place apart from the registered office ?</b>
				</td>
			</tr>
			<tr>
				<td>
					Own Land/leased/rented land 
				</td>
				<td>
					:
				</td>
				<td>
					'.$land_type2.'
				</td>
			</tr>';

          if($land_type2=='OWN'){

         $land_type_condition2= $land_type_condition_p.'<tr>
				<td>Mouza </td>
				
				<td>'.$row3['mouza'].'</td>
				<td>Circle </td>
				
				<td> '.$row3['circle'].'</td>
			</tr>
			<tr>
				<td>Patta No. </td>
				
				<td>'.$row3['patta_no'].'</td>
			
				<td>Dag No. </td>
				
				<td>'.$row3['dag_no'].'</td>
			</tr>';
		}else
		{$land_type_condition2=$land_type_condition_p;}

		$land_type_condition2=$land_type_condition2.'<tr>
				<td>Area </td>
				
				<td> '.strtoupper($area1).'</td>
				<td>Village/Town/City </td>
				
				<td>'.strtoupper($b_vill).'</td>
			</tr>
			<tr>
				<td>Post Office </td>
				
				<td>'.strtoupper($row3['po_name']).'</td>
			
				<td>Police Station </td>
				
				<td>'.strtoupper($row3['ps_name']).'</td>
			</tr>
			<tr>
				<td>Dist </td>
				
				<td>'.strtoupper($b_dist).'</td>
			
				<td>Pin Code </td>
				
				<td>'.$b_pincode.'</td>
			
			</tr>';

	}else {$land_type_condition2="";}



	$query4=$rfs->query("select * from rfs_form1_partners where form_id='$form_id'");
    ob_start();
   if($firm_duration=="LIMITED"){
    $limited='<tr>
				<td><b></b>&nbsp;&nbsp;&nbsp;  Date of Expiry of the firm :</td>
				<td>'.$row["firm_date_expiry"].'</td>
			</tr>';
		}else { $limited='';}
	$form_name=$formFunctions->get_formName('rfs','1');
	
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form1</title>
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
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'<div>
    <link href="css/style.css" rel="stylesheet"/>
	
    </p>
	
		<h3 style="text-align:center">Form No I<br>'.$form_name.'<br>Fees Rs. 50.00</br>
                        </h3>
        <table  class="table table-responsive table-striped" style="">		   
			<tr>
				<td><b>1</b>. Name of the Proposed Firm :</td>
				<td>'.$unit_name.'</td>
			
				<td><b>2</b>. Nature of Business  :</td>
				<td>'.strtoupper($sector_classes_b).'</td>
			</tr>
			<tr>
				<td><b>3</b>. Pan No :</td>
				<td>'.$pan_no.'</td>
			
				<td><b>4</b>. Duration of the Firm :</td>
				<td>'.$firm_duration.'</td>
			</tr>
			<tr>
				<td><b>5</b>. Date of Establishment :</td>
				<td>'.$date_of_commencement.'</td>
			</tr>'.$limited.'
			
		</table>
		
		<table  class="table table-responsive table-striped" style="">
			<tr>
				<td>
					<b>6. Principle place of the proposed firm</b>
				</td>
			</tr>
			<tr>
				<td>
					Own Land/leased/rented land 
				</td>
				<td>
					:
				</td>
				<td>
					'.$land_type1.'
				</td>
			</tr>
			'.$land_type_condition1.'
			<tr>
				<td>Area </td>
				
				<td> '.strtoupper($area).'</td>
			
				<td>Village/Town/City </td>
				
				<td>'.strtoupper($b_vill2).'</td>
			</tr>
			<tr>
				<td>Post Office </td>
				
				<td>'.strtoupper($row2['po_name']).'</td>
			
				<td>Police Station </td>
				
				<td>'.strtoupper($row2['ps_name']).'</td>
			</tr>
			<tr>
				<td>Dist </td>
				
				<td>'.strtoupper($b_dist2).'</td>
			
				<td>Pin Code </td>
				
				<td>'.$b_pincode2.'</td>
			
			</tr>
			
			'.$land_type_condition2.'
			
		</table>';
	 $printContents=$printContents.'<br><strong>8. The names in full and permanent address of all the partners, and the date of each partner joined the firm:</strong>
		<table width="100%"  class="table table-responsive table-striped" style="text-align:top;">
			<tr>
				<td></td>
				<td><b>Name in full of partners</b></td>
				<td><b>Permanent Address</b></td>
				<td><b>Date of Joining</b></td>
				<td><b>Photo</td>
				<td><b>Sign</b></td>
				<td><b>Pan</b></td>
			</tr>';
		
		
		for($i=1;$i<=count($partner);$i++){ 
		
	 $printContents=$printContents.'<tr>
				<td width="3%">'.$i.'</td>
				<td width="19%">
				'.strtoupper($partner[$i]["pname"]).'</td>
				<td width="19%">'.strtoupper($partner[$i]["paddr"]).'</td>
				<td width="15%">'.strtoupper($partner[$i]["dateofjoin"]).'</td>
				<td><img src="'.$upload.$partner[$i]["photo"].'" style="width:80px;height:20px;" alt="partner "/>
		       </td>
			   <td><img src="'.$upload.$partner[$i]["sign"].'" style="width:80px;height:20px;" alt="partner "/>
		       </td>
			   <td><img src="'.$upload.$partner[$i]["pan"].'" style="width:80px;height:20px;" alt="partner "/>
		       </td>	
			</tr>
			
			';

		}	
		$query5=$rfs->query("select * from rfs_form1_credentials where form_id='$form_id'");
		$row=$query5->fetch_array();
		$is_certificate=$row['is_cer'];
		$show_certificate=0;
		//if($is_certificate=='Y'){ $show_certificate=1;}else{$show_certificate=0;}
	 $printContents=$printContents.'
		</tr></table>
		<br><br><b>9. Registered Deed of Partnership</b>
		<table width="100%"  class="table table-responsive table-striped" style="text-align:top;">
			<tr>
				<td>Deed No. </td>
				
				<td>'.$row["deed_no"].'</td>
			
				<td>Date </td>
				
				<td> '.$row["deed_date"].'</td>
			</tr>
			<tr>
				<td>Place of Deed Registration </td>
				
				<td> '.$row["deed_place"].'</td>
			</tr>
		</table>
		<br><br>';
		
		  
		if($is_certificate=="Y"){
		 $printContents=$printContents.'
		<br><br><b> 10. Sales tax clearance / Affidavit   :</b> &nbsp;&nbsp;&nbsp;&nbsp;<b>YES</b>
		<table width="100%"  class="table table-responsive table-striped" >
			<tr>
				<td>Enter Certificate No . </td>
				
				<td>'.$row["cer_no"].'</td>
			
				<td>Certificate Issue By </td>
				
				<td> '.$row["issue_by"].'</td>
			</tr>
			<tr>
				<td>Certificate Issue Date </td>
				
				<td> '.$row["issue_date"].'</td>
			
				<td>Upload File </td>
				
				<td> '.$row["affidafit"].'</td>
			</tr>
		</table>'; }else{
			 $printContents=$printContents.'
		<br><br><b>10. Sales tax clearance / Affidavit   :</b> &nbsp;&nbsp;&nbsp;&nbsp;<b>NO</b>
		';
			
		}
		 $printContents=$printContents.'
		<br><br> 
		
		<table  width="100%"  class="table table-responsive table-striped" style="text-align:top;">
			
			<tr>
				<td><b>11. Treasury Challan </b></td>
				<td> No.</td>
				
				<td> '.$row["challan_no"].'</td>
			
				<td></td>
				<td>Date</td>
				
				<td>'.$row["challan_date"].'</td>
			</tr>
			<tr>
				<td></td>
				<td> Branch</td>
				
				<td>'.$row["challan_branch"].'</td>
			
				<td></td>
				<td> Amount</td>
				
				<td>'.$row['challan_amount'].' /-</td>
			</tr>
		</table>';
		
		$uploa=$rfs->query("select * from rfs_form1_docs where form_id='$form_id'");
		$res=$uploa->fetch_array();
		
		
		if(!isset($css)){
     echo  $val1=$formFunctions->get_uploadFile($res["reg_form"]); 
      $val2=$formFunctions->get_uploadFile($res["partnership_deed"]);
      $val3=$formFunctions->get_uploadFile($res["principal_land"]); 
      $val4=$formFunctions->get_uploadFile($res["principal_land_afdt"]);
      $val5=$formFunctions->get_uploadFile($res["other_land"]);
	  $val6=$formFunctions->get_uploadFile($res["other_land_afdt"]);
	  $val7=$formFunctions->get_uploadFile($res["trade_license"]); 
	 
    }else{
      $val1=$formFunctions->get_useruploadFile($res["reg_form"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($res["partnership_deed"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($res["principal_land"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($res["principal_land_afdt"],$applicant_id);
      $val5=$formFunctions->get_useruploadFile($res["other_land"],$applicant_id);
	  $val6=$formFunctions->get_useruploadFile($res["other_land_afdt"],$applicant_id);
	  $val7=$formFunctions->get_useruploadFile($res["trade_license"],$applicant_id);
	 
    }
	 $printContents=$printContents.'<br><b>Scanned copies of following documents are to be uploaded </b>
			<br/>
			
			<table width="100%"  class="table table-responsive table-striped" style="text-align:top;">
				<tr>
					<th> Particulars</th>
					<th> Upload</th>
				</tr>
				<tr>
					<td>  Fill in Form No. I and witnessed by either a judicial Magistrate or a Chartered Accountant</td>
					
					<td>'.$val1.'</td> 
				</tr>
				<tr>
					<td>  Cerified copy of Registered Deed of Partnership</td>
					
					<td >'.$val2.'</td> 
				</tr>';
				if ($land_type=="O"){ 
				 $printContents=$printContents.'<tr>
					<td>  Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of the principal place of business.
							
					</td>
					<td >'.$val3.'</td> 
				</tr>';
				 }else if ($land_type=="L" || $land_type=="R"){
					 
				 $printContents=$printContents.'
				<tr>
					<td> 
						  if not Land Lease Agreement/Affidavit from the house owner if does not have own land.
					</td>
					<td>'.$val4.'</td> 
				 </tr>';
				 }
				 if ($land_type2=="OWN"){ 
			
				 $printContents=$printContents.'
				<tr>
					<td>  Land Document (Jamabandi / Mutation Order / Registered Sale deed/Govt allotment order) for office accomodation of any other place of business.
							
					</td>
					
					<td>'.$val5.'</td> 
				 </tr>';}
				else if ($land_type2=="LEASED" ||$land_type=="RENTED"){
					 $printContents=$printContents.'
				<tr>
					<td> 
						 if not Land Lease Agreement/Affidavit from the house owner if does not have own land.
					</td>
					
					<td >'.$val6.'</td> 
				</tr>';
				}
				 $printContents=$printContents.'
				<tr>
					<td> 
						 Trade License obtained from the Municipal Corporation/ Municipal Board / Town commitee or Gaon Panchayat
					</td>
					
					<td>'.$val7.'</td> 
				</tr>
				<tr>
					<td> 
						 PAN Card
					</td>
					
					<td><a href=" '.$upload1.$pan.'" target="_blank"> View</a></td>
				
				</tr>
				
				
				
			</table>';
			
		$query7=$rfs->query("select * from rfs_form1 where form_id='$form_id'");
		$row=$query5->fetch_array();
       if(!empty($row["courier_details"]) && $row["courier_details"]!=1){
		 $courier_details=json_decode($row["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	   }else{
		   $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	   }
	   if(!empty($row["courier_details"]) && $row["courier_details"]!=1){
     $printContents=$printContents.'<tr>       
      <td colspan="2">
        <table class="table table-bordered table-responsive" width="100%">
          <tr><td>Courier Details.</td></tr>
          <tr><td>Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td>Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
     
	   }

			
		
	
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