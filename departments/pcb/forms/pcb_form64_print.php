<?php
$dept="pcb";
$form="64";
$table_name=getTableName($dept,$form);
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
  

if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];$facilities=$results['facilities'];
	
	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;$contact_fax=$contact->fax;$contact_email=$contact->email;
	}else{				
		$contact_desgn="";$contact_tel="";$contact_fax="";$contact_email="";
	}	
	
	if(!empty($results["ewaste"])){
		$ewaste=json_decode($results["ewaste"]);
		$ewaste_generate=$ewaste->generate;$ewaste_refurbish=$ewaste->refurbish;$ewaste_recycle=$ewaste->recycle;$ewaste_dispose=$ewaste->dispose;
	}else{
		$ewaste_generate="";$ewaste_refurbish="";$ewaste_recycle="";$ewaste_dispose="";
	}
	
	if(!empty($results["authorization"])){
		$authorization=json_decode($results["authorization"]);
		if(isset($authorization->a)) $authorization_a=$authorization->a; else $authorization_a="";
		if(isset($authorization->b)) $authorization_b=$authorization->b; else $authorization_b="";
		if(isset($authorization->c)) $authorization_c=$authorization->c; else $authorization_c="";
		if(isset($authorization->d)) $authorization_d=$authorization->d; else $authorization_d="";
	}else{
		$authorization_a="";$authorization_b="";$authorization_c="";$authorization_d="";
	}
	
	//AUTHORIZATION CHECKMARKS///
	$authorization_values="";		
	if($authorization_a=="G") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>(i) Generation during manufacturing or refurbishing &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_b=="T") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>(ii) Treatment, if any  &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_c=="C") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>(iii) Collection, Transportation, Storage  &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_d=="R") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>(iv) Refurbishing &nbsp;&nbsp;&nbsp;&nbsp;';
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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">To, <br/>&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;Pollution Control Board</td>
	</tr>
	<tr>
		<td colspan="2">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I / We hereby apply for authorisation/renewal of authorisation under rule 13(2) (i) to 13(2) (viii) and/or 13 (4) (i) of the E-Waste (Management) Rules, 2016 for collection/storage/ transportation/ treatment/ refurbishing/disposal of e-wastes.</td>
	</tr>
	<tr>
		<td width="50%">1. Name of applicant </td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Full Address :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($street_name1).'</td>
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
				<td>District</td>
				<td>'.strtoupper($dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($mobile_no).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">3. Details of Contact Person :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Designation</td>
				<td>'.strtoupper($contact_desgn).'</td>
			</tr>
			<tr>
				<td>Telephone No.</td>
				<td>'.strtoupper($contact_tel).'</td>
			</tr>
			<tr>
				<td>Fax No.</td>
				<td>'.strtoupper($contact_fax).'</td>
			</tr>
			<tr>
				<td>Email Id</td>
				<td>'.strtoupper($contact_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>4. Authorisation required for (Please tick mark appropriate activity/ies) : </td>
		<td>'. $authorization_values .'</td>
	</tr>
	<tr>
		<td colspan="2">5. E-waste details : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Total quantity e-waste generated in MT/A</td>
				<td>'.strtoupper($ewaste_generate).'</td>
			</tr>
			<tr>
				<td>(b) Quantity refurbished (applicable to refurbisher)</td>
				<td>'.strtoupper($ewaste_refurbish).'</td>
			</tr>
			<tr>
				<td>(c) Quantity sent for recycling</td>
				<td>'.strtoupper($ewaste_recycle).'</td>
			</tr>
			<tr>
				<td>(d) Quantity sent for disposal</td>
				<td>'.strtoupper($ewaste_dispose).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>6. Details of Facilities for storage/handling/treatment/refurbishing</td>
		<td>'.strtoupper($facilities).'</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong><br/>
		(Name : <strong>'.strtoupper($key_person).'</strong>)<br/>
		(Designation : <strong>'.strtoupper($status_applicant).'</strong>)</td>
	</tr>
</table>';
?>