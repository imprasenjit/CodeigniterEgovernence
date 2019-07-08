<?php
$dept="sdc";
//$form=$_SESSION["form_no"];
$table_name=$formFunctions->getTableName($dept,$form);
//$form="retention";

//$table_name=$formFunctions->getTableName($dept,$form); 

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id='$form_id'");
}
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	
	if($q->num_rows > 0){
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$prev_lic_no=$results["prev_lic_no"];$prev_issue_date=$results["prev_issue_date"];$qualified_person_name=$results["qualified_person_name"];$qualified_reg_no=$results["qualified_reg_no"];
		if($form==27 || $form==28 || $form==31){
			$prev_lic_no2=$results["prev_lic_no2"];			
		}else{
			$prev_lic_no2="";
		}
	}

	switch ($form) {
		case "27" :
			$lic_for_form1="for Form 20B";
			$lic_for_form2="for Form 21B";
			break;
		case "28" :
			$lic_for_form1="for Form 20";
			$lic_for_form2="for Form 21";
			break;
		case "31" :
			$lic_for_form1="for Form 20A";
			$lic_for_form2="for Form 21A";
			break;
		default:
			$lic_for_form1="";
			$lic_for_form2="";
	} 
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
		<body>';		
	}else{
		$printContents='';
	}
	if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
	<br>
	<table class="table table-bordered table-responsive">
			<tr>
				<td valign="top">2. Name and address of the Applicant :</td>
				<td>
					<table class="table table-bordered table-responsive">						
						<tr>
							<td>Applicants Name :</td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
						<tr>
							<td>Contact No</td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>Street Name 1</td>
							<td>'. strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($street_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($vill).'</td>
						</tr>
						<tr>
							<td>State</td>
							<td>'.strtoupper($block).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($dist).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.$pincode.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">2. Name and address of the Business :</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Name of the Enterprise</td>
							<td>'. strtoupper($unit_name).'</td>
						</tr>
						<tr>
							<td>Street Name 1</td>
							<td>'. strtoupper($b_street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($b_vill).'</td>
						</tr>
						<tr>
							<td>State</td>
							<td>'.strtoupper($b_block).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.$b_pincode.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
			   <td>2.Previous Licence No and Date </td>
			</tr>
			<tr>
				<td>Previous Licence No '.$lic_for_form1.' </td>
				<td>'.strtoupper($prev_lic_no).'</td>
			</tr>
			<tr>
				<td>Previous Licence No '.$lic_for_form2.' </td>
				<td>'.strtoupper($prev_lic_no2).'</td>
			</tr>
			<tr>
				<td>Date</td>
				<td>'.strtoupper($prev_issue_date).'</td>
			</tr>
			<tr>
				<td>Name of Qualified Person in Charge </td>
				<td>'.strtoupper($qualified_person_name).'</td>
			</tr>
			<tr>
				<td>Registration No.</td>
				<td>'.strtoupper($qualified_reg_no).'</td>
			</tr>
			
			';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>
