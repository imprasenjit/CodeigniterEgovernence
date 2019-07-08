<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$sdc->query("select * from sdc_form8  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$sdc->query("select * from sdc_form8  where user_id='$swr_id' and uain='$uain'") or die("Error :".$sdc->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$sdc->query("select * from sdc_form8  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else{
	$q=$sdc->query("select * from sdc_form8  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$sdc->error);
}
	
	$results=$q->fetch_array();
	if($q->num_rows > 0){
		$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);					
		$form_id=$results["form_id"];$location=$results["location"];$names_of_drugs=$results["names_of_drugs"];$reg_fees=$results["reg_fees"];
			if(!empty($results["competent_staff"])){
				$competent_staff=json_decode($results["competent_staff"]);
				$competent_staff_name=$competent_staff->name;$competent_staff_quali=$competent_staff->quali;
				$competent_staff_expc=$competent_staff->expc;
			}else{				
				$competent_staff_name="";$competent_staff_quali="";$competent_staff_expc="";
			}
		
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('sdc','8');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>FORM 24-B</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>FORM 24-B<br/>[Rule 69]<br/>'.$form_name.' <br/> <i>[excluding those specified in Schedule X]</i></h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tbody>	
		<tr>
			<td colspan="2">1. I/We &nbsp;<b>'.strtoupper($key_person).'</b>&nbsp; of &nbsp; <b>'.strtoupper($unit_name).'</b> &nbsp;hereby apply for grant/renewal of licence to repack the following drugs at the premises situated at&nbsp;'.strtoupper($location).'.</td>
		</tr>			
		<tr>
			<td >2. Names of the drugs to be repacked.</td>
			<td >'.strtoupper($names_of_drugs).'</td>
		</tr>			
		<tr>
			<td colspan="2">3. Name, qualification and experience of competent staff</td>
		</tr>
		<tr>
			<td colspan="2">	
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr >
					<th >Sl No </th>
					<th > Name </th>
					<th>qualification</th>
					<th >Experience</th>			
				</tr>';
				$part1=$sdc->query("SELECT * FROM sdc_form8_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["qualification"]).'</td>
						<td>'.strtoupper($row_1["experience"]).'</td>
				</tr>';
				}$printContents=$printContents.'
				</table>  
			</td>
		</tr>
		';			
			if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
				$printContents=$printContents.'
				<tr>		   
				<td colspan="2">
					<table border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
						<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
						<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="50%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="50%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
				</tr>
				';				
				}
				if($results["payment_mode"]!=NULL){ 
				$printContents=$printContents.'<tr>		    
				<td colspan="2">
					<table border="0" width="100%">
					<tr><td height="45px" colspan="2">Payment Details :</td></tr>
					<tr><td width="40%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
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
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right"> Signature :&nbsp;<strong>'.strtoupper($key_person).'</strong><br/> </td>				
			</tr>						
		</table>';

?>
