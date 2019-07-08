<?php
$dept="pcb";
$form="72";
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
	$form_id=$results['form_id'];
	$facility_name=$results['facility_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$info=$results['info'];
		
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
	}else{				
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
	}
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_recycle=$waste->recycle;$waste_treat=$waste->treat;$waste_dispose=$waste->dispose;$waste_utilisation=$waste->utilisation;$waste_leachate_qty=$waste->leachate_qty;$waste_leachate_tech=$waste->leachate_tech;$waste_prevent=$waste->prevent;$waste_safety=$waste->safety;$waste_details=$waste->details;
	}else{				
		$waste_recycle="";$waste_treat="";$waste_dispose="";$waste_utilisation="";$waste_leachate_qty="";$waste_leachate_tech="";$waste_prevent="";$waste_safety="";$waste_details="";
	}
	        
	if(!empty($results["disposal"])){
		$disposal=json_decode($results["disposal"]);
		$disposal_sites=$disposal->sites;$disposal_qty=$disposal->qty;$disposal_criteria=$disposal->criteria;$disposal_operation=$disposal->operation;$disposal_methodology=$disposal->methodology;$disposal_measures=$disposal->measures;
	}else{				
		$disposal_sites="";$disposal_qty="";$disposal_criteria="";$disposal_operation="";$disposal_methodology="";$disposal_measures="";
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
	if($authorization_a=="W") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>Waste Processing &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_b=="T") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>Treatment &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_c=="R") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>Recycling  &nbsp;&nbsp;&nbsp;&nbsp;';
	if($authorization_d=="D") $authorization_values=$authorization_values. '<span class="tickmark">&#10004;</span>Disposal at landfill &nbsp;&nbsp;&nbsp;&nbsp;';
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
		<td colspan="2">To, <br/>&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;State Pollution Control Board or Pollution Control Committee</td>
	</tr>
	<tr>
		<td colspan="2">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for authorisation under the Solid Waste Management Rules, 2016 for processing, recycling, treatment and disposal of solid waste.</td>
	</tr>
	<tr>  				
		<td width="50%">1. Name of the local body/agency appointed by them/ operator of facility </td>
		<td>'.strtoupper($facility_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Correspondence address : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($corr_add_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($corr_add_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($corr_add_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($corr_add_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($corr_add_pin).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($corr_add_mobile).'</td>
			</tr>
			<tr>
				<td>Telephone No. </td>
				<td>'.strtoupper($corr_add_tel).'</td>
			</tr>
			<tr>
				<td>Fax No. </td>
				<td>'.strtoupper($corr_add_fax).'</td>
			</tr>
			<tr>
				<td>Email </td>
				<td>'.strtoupper($corr_add_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>3. Nodal Officer and designation (Officer authorised by the local body or agency responsible for operation of processing/ treatment or disposal facility)</td>
		<td><b>Name of Nodal Officer : </b>&nbsp;'.strtoupper($officer_name).'<br/><b>Designation : </b>&nbsp;'.strtoupper($officer_desgn).'</td>
	</tr>
	<tr>  				
		<td>4. Authorisation required for setting up and operation of the facility</td>
		<td>'. $authorization_values .'</td>
	</tr>
	<tr>
		<td colspan="2">5. Processing/recycling/treatment of solid waste : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">(i) Total Quantity of waste to be processed per day : </td>
			</tr>
			<tr>
				<td width="50%">Quantity of waste to be recycled</td>
				<td>'.strtoupper($waste_recycle).'</td>
			</tr>
			<tr>
				<td>Quantity of waste to be treated</td>
				<td>'.strtoupper($waste_treat).'</td>
			</tr>
			<tr>
				<td>Quantity of waste to be disposed into landfill</td>
				<td>'.strtoupper($waste_dispose).'</td>
			</tr>
			<tr>
				<td>(ii)Utilisation programme for waste processed (Product utilisation) :</td>
				<td>'.strtoupper($waste_utilisation).'</td>
			</tr>			
			<tr>
				<td colspan="2">(iii)Methodology for disposal (attach details) : </td>
			</tr>
			<tr>
				<td>Quantity of leachate </td>
				<td>'.strtoupper($waste_leachate_qty).'</td>
			</tr>
			<tr>
				<td>Treatment technology for leachate </td>
				<td>'.strtoupper($waste_leachate_tech).'</td>
			</tr>
			<tr>
				<td>(iv)Measures to be taken for prevention and control of environmental pollution : </td>
				<td>'.strtoupper($waste_prevent).'</td>
			</tr>
			<tr>
				<td>(v)Measures to be taken for safety of workers working in the plant : </td>
				<td>'.strtoupper($waste_safety).'</td>
			</tr>
			<tr>
				<td>(vi)Details on solid waste processing/recycling/ treatment/disposal facility (to be attached) : </td>
				<td>'.strtoupper($waste_details).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">6. Disposal of solid waste : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Number of sites identified </td>
				<td>'.strtoupper($disposal_sites).'</td>
			</tr>
			<tr>
				<td>(b) Quantity of waste to be disposed per day</td>
				<td>'.strtoupper($disposal_qty).'</td>
			</tr>
			<tr>
				<td>(c) Details of methodology or criteria followed for site selection</td>
				<td>'.strtoupper($disposal_criteria).'</td>
			</tr>
			<tr>
				<td>(d) Details of existing site under operation </td>
				<td>'.strtoupper($disposal_operation).'</td>
			</tr>
			<tr>
				<td>(e) Methodology and operational details of landfilling </td>
				<td>'.strtoupper($disposal_methodology).'</td>
			</tr>
			<tr>
				<td>(f) Measures taken to check environmental pollution </td>
				<td>'.strtoupper($disposal_measures).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>7. Any other information </td>
		<td>'.strtoupper($info).'</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong><br/>
		Designation : <strong>'.strtoupper($status_applicant).'</strong></td>
	</tr>
</table>';
?>