<?php
$dept="rfs";
$form="6";
$table_name=$formFunctions->getTableName($dept,$form);

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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");		
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
}
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$fathers_name=$results["fathers_name"];$post_office=$results["post_office"];$police_station=$results["police_station"];
		if(!empty($results['registration_deed'])){
			$registration_deed=json_decode($results['registration_deed']);
			$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
		}else{
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		#### PART II####
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}
	
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">		
			<tr>				
				<td width="50%">1. Name of the Applicant</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>2. Fathers Name: </td>
				<td>'.strtoupper($fathers_name).'</td>
			</tr>
			
			<tr>
				<td valign="top">3. Address</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Locality</td>
							<td>'.strtoupper($b_street_name2).'</td>
						</tr>
						<tr>
							<td>Village</td>
							<td>'.strtoupper($b_vill).'</td>
						</tr>
						<tr>
							<td>Post Office</td>
							<td>'.strtoupper($post_office).'</td>
						</tr>
						<tr>
							<td>Police Station</td>
							<td>'.strtoupper($police_station).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
						</tr>
						<tr>
							<td>Pin code </td>
							<td>'.strtoupper($b_pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No.</td>
							<td>'.strtoupper($b_mobile_no).'</td>
						</tr>
						<tr>
							<td>Email ID</td>
							<td>'.$b_email.'</td>
						</tr>
					</table>
				</td>
			</tr>	
			<tr>
				<td colspan="2">4. Registration Deed of Partnership</td>
			</tr>
			<tr>
				<td>Deed No.</td>
				<td>'.strtoupper($registration_deed_no).'</td>
			</tr>
			<tr>
				<td>Date</td>
				<td>'.strtoupper($registration_deed_dte).'</td>
			</tr>
			<tr>
				<td>Place of Deed Registration:</td>
				<td>'.strtoupper($registration_deed_place).'</td>
			</tr>
			<tr>
				<td colspan="2">5. Rectification Registration Deed of Partnership</td>
			</tr>
			<tr>
				<td>Deed No.</td>
				<td>'.strtoupper($rectification_reg_no).'</td>
			</tr>
			<tr>
				<td>Date</td>
				<td>'.strtoupper($rectification_reg_dte).'</td>
			</tr>
			<tr>
				<td>Place of Deed Registration:</td>
				<td>'.strtoupper($rectification_reg_place).'</td>
			</tr>
			<tr>
				<td colspan="2">6. Certificate of Sales Tax or Income Tax</td>
			</tr>
			<tr>
					<td>Certificate No.</td>
					<td> '.strtoupper($tax_certificate_no).'</td>
			</tr>
			<tr>
					<td>Issued by</td>
					<td> '.strtoupper($tax_certificate_issue).'</td>
			</tr>
			<tr>
					<td>Date of Issue</td>
					<td> '.strtoupper($tax_issuedate).'</td>
			</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		
			<tr>
				<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
				<td align="right">
					<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
				</td>
			</tr>
	</table>

';
?>

  