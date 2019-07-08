<?php	
$dept="health";
$form="2";
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
		$website_name=$results["website_name"];$no_bed=$results["no_bed"];
		$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];
		$o_vill=$results["o_vill"];$o_block=$results["o_block"];
		$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];  $o_email=$results["o_email"];$o_dist=$results["o_dist"];$any_other=$results["any_other"];
		$location_type=$results["location_type"];$fees_description=$results["fees_description"];
		
		if($location_type=="R"){
			$location_type="Rural";
		}else if($location_type=="M"){
			$location_type="Metro";
		}else if($location_type=="U"){
			$location_type="Urban";
		}else if($location_type=="N"){
			$location_type="Notified / inaccessible areas (including Hilly / tribal areas)";
		}else{
			$location_type="";
		}
		
		
		if($fees_description=="1"){
			$fees_description="Our Patient Care/single doctor Clinic";
		}else if($fees_description=="2"){
			$fees_description="In patient care 1 to 30 beds";
		}else if($fees_description=="3"){
			$fees_description="30 to 100 beds";
		}else if($fees_description=="4"){
			$fees_description="Above 100 beds";
		}else if($fees_description=="5"){
			$fees_description="Testing & Diagnostic Centre";
		}else if($fees_description=="6"){
			$fees_description="Diagnostic with Inaging Centre";
		}else{
			$fees_description="";
		}
		
		if(!empty($results["ownership"])){
			$ownership=json_decode($results["ownership"]);
			if(isset($ownership->a)) $ownership_a=$ownership->a; else $ownership_a="";
			if(isset($ownership->b)) $ownership_b=$ownership->b; else $ownership_b="";
			if(isset($ownership->c)) $ownership_c=$ownership->c; else $ownership_c="";
			if(isset($ownership->d)) $ownership_d=$ownership->d; else $ownership_d="";
			if(isset($ownership->e)) $ownership_e=$ownership->e; else $ownership_e="";
			if(isset($ownership->f)) $ownership_f=$ownership->f; else $ownership_f="";
			if(isset($ownership->g)) $ownership_g=$ownership->g; else $ownership_g="";
		}else{
			$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";		 
		}
		
		//OWNERSHIP CHECKMARKS///
		$ownership_values="";
		if($ownership_a=="C") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Central government &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_b=="S") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> State government &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_c=="L") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Local government (Municipality, Zilla parishad, etc) &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_d=="PS") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Public Sector Undertaking &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_e=="O") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Other ministries and departments (Railways, Police, etc.)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_f=="E") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Employee State Insurance Corporation &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_g=="A") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Autonomous organization under Government &nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ownership2"])){
			$ownership2=json_decode($results["ownership2"]);
			if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
			if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
			if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
			if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
		}else{
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
		}
		
		//OWNERSHIP2//
		$ownership2_values="";
		if($ownership2_a=="I") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Individual Proprietorship&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_b=="P") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Partnership&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_c=="R") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Registered companies (registered under central/provincial/state Act) &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_d=="S") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Society/trust (Registered under central/provincial/state Act)&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["system"])){
			$system=json_decode($results["system"]);
			if(isset($system->a)) $system_a=$system->a; else $system_a="";
			if(isset($system->b)) $system_b=$system->b; else $system_b="";
			if(isset($system->c)) $system_c=$system->c; else $system_c="";
			if(isset($system->d)) $system_d=$system->d; else $system_d="";
			if(isset($system->e)) $system_e=$system->e; else $system_e="";
			if(isset($system->f)) $system_f=$system->f; else $system_f="";
			if(isset($system->g)) $system_g=$system->g; else $system_g="";
			if(isset($system->h)) $system_h=$system->h; else $system_h="";
		}else{
			$system_a="";$system_b="";$system_c="";$system_d="";$system_e="";$system_f="";$system_g="";$system_h="";
		}
		
		//SYSTEM//
		$system_values="";
		if($system_a=="A") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Allopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_b=="AY") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Ayurveda &nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_c=="U") $system_values=$system_values. '<span class="tickmark">&#10004;</span>Unani&nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_d=="S") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Siddha &nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_e=="H") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Homoeopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_f=="Y") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Yoga&nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_g=="N") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Naturopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($system_g=="SR") $system_values=$system_values. '<span class="tickmark">&#10004;</span> Sowa-Rigpa&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["clinical"])){
			$clinical=json_decode($results["clinical"]);
			if(isset($clinical->a)) $clinical_a=$clinical->a; else $clinical_a="";
			if(isset($clinical->b)) $clinical_b=$clinical->b; else $clinical_b="";
			if(isset($clinical->c)) $clinical_c=$clinical->c; else $clinical_c="";
			if(isset($clinical->d)) $clinical_d=$clinical->d; else $clinical_d="";
			if(isset($clinical->any_other)) $clinical_any_other=$clinical->any_other; else $clinical_any_other="";
		}else{
			$clinical_a="";$clinical_b="";$clinical_c="";$clinical_d="";$clinical_any_other="";
		}
		///CLINICAL///
		$clinical_values="";
		if($clinical_a=="AL") $clinical_values=$clinical_values. '<span class="tickmark">&#10004;</span> Single practitioner (Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_b=="AY") $clinical_values=$clinical_values. '<span class="tickmark">&#10004;</span> Poly clinic(Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_c=="UN") $clinical_values=$clinical_values. '<span class="tickmark">&#10004;</span>Dispensary &nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_d=="PS") $clinical_values=$clinical_values. '<span class="tickmark">&#10004;</span> Health Checkup Centre&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($clinical_any_other)) $clinical_values=$clinical_values. "<br/><br/>Any Other : ". $clinical_any_other;
		
		if(!empty($results["clinical_est"])){
			$clinical_est=json_decode($results["clinical_est"]);
			if(isset($clinical_est->a)) $clinical_est_a=$clinical_est->a; else $clinical_est_a="";
			if(isset($clinical_est->b)) $clinical_est_b=$clinical_est->b; else $clinical_est_b="";
			if(isset($clinical_est->c)) $clinical_est_c=$clinical_est->c; else $clinical_est_c="";
			if(isset($clinical_est->d)) $clinical_est_d=$clinical_est->d; else $clinical_est_d="";
			if(isset($clinical_est->any_other)) $clinical_est_any_other=$clinical_est->any_other; else $clinical_est_any_other="";
		}else{
			$clinical_est_a="";$clinical_est_b="";$clinical_est_c="";$clinical_est_d="";$clinical_est_any_other="";
		}
			
		$clinical_est_values="";
		if($clinical_est_a=="AL") $clinical_est_values=$clinical_est_values. '<span class="tickmark">&#10004;</span> Single practitioner (Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_est_b=="AY") $clinical_est_values=$clinical_est_values. '<span class="tickmark">&#10004;</span> Poly clinic(Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_est_c=="UN") $clinical_est_values=$clinical_est_values. '<span class="tickmark">&#10004;</span>Dispensary &nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinical_est_d=="PS") $clinical_est_values=$clinical_est_values. '<span class="tickmark">&#10004;</span> Health Checkup Centre&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($clinical_est_any_other)) $clinical_est_values=$clinical_est_values. "<br/><br/>Any Other : ". $clinical_est_any_other;
		
		if(!empty($results["inpatient"])){
			$inpatient=json_decode($results["inpatient"]);
			if(isset($inpatient->a)) $inpatient_a=$inpatient->a; else $inpatient_a="";
			if(isset($inpatient->b)) $inpatient_b=$inpatient->b; else $inpatient_b="";
			if(isset($inpatient->c)) $inpatient_c=$inpatient->c; else $inpatient_c="";
			if(isset($inpatient->d)) $inpatient_d=$inpatient->d; else $inpatient_d="";
			if(isset($inpatient->e)) $inpatient_e=$inpatient->e; else $inpatient_e="";
			if(isset($inpatient->f)) $inpatient_f=$inpatient->f; else $inpatient_f="";
			if(isset($inpatient->g)) $inpatient_g=$inpatient->g; else $inpatient_g="";
			if(isset($inpatient->any_other)) $inpatient_any_other=$inpatient->any_other; else $inpatient_any_other="";
		}else{
			$inpatient_a="";$inpatient_b="";$inpatient_c="";$inpatient_d="";$inpatient_e="";$inpatient_f="";$inpatient_g="";$inpatient_any_other="";
		}
			
		$inpatient_values="";
		if($inpatient_a=="H") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span> Single practitioner&nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_b=="NH") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span> Dispensary&nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_c=="MH") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span> Polyclinic &nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_d=="S") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span> Dental Clinic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_e=="PC") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span> Physiotherapy / Occupational Therapy Clinic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_f=="PHC") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span>Infertility Clinic &nbsp;&nbsp;&nbsp;&nbsp;';
		if($inpatient_g=="CHC") $inpatient_values=$inpatient_values. '<span class="tickmark">&#10004;</span>Day Care centre&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($inpatient_any_other)) $inpatient_values=$inpatient_values. "<br/><br/>Any Other : ". $inpatient_any_other;
		
        if(!empty($results["outpatient"])){
			$outpatient=json_decode($results["outpatient"]);
			if(isset($outpatient->a)) $outpatient_a=$outpatient->a; else $outpatient_a="";
			if(isset($outpatient->b)) $outpatient_b=$outpatient->b; else $outpatient_b="";
			if(isset($outpatient->c)) $outpatient_c=$outpatient->c; else $outpatient_c="";
			if(isset($outpatient->d)) $outpatient_d=$outpatient->d; else $outpatient_d="";
			if(isset($outpatient->e)) $outpatient_e=$outpatient->e; else $outpatient_e="";
			if(isset($outpatient->f)) $outpatient_f=$outpatient->f; else $outpatient_f="";
			if(isset($outpatient->g)) $outpatient_g=$outpatient->g; else $outpatient_g="";
			if(isset($outpatient->h)) $outpatient_h=$outpatient->h; else $outpatient_h="";
			if(isset($outpatient->i)) $outpatient_f=$outpatient->i; else $outpatient_i="";
			if(isset($outpatient->j)) $outpatient_j=$outpatient->j; else $outpatient_j="";
			if(isset($outpatient->any_other)) $outpatient_any_other=$outpatient->any_other; else $outpatient_any_other="";
		}else{
			$outpatient_a="";$outpatient_b="";$outpatient_c="";$outpatient_d="";$outpatient_e="";$outpatient_f="";$outpatient_g="";$outpatient_h="";$outpatient_i="";$outpatient_j="";$outpatient_any_other="";
		}
		//OUTPATIENT//
		$outpatient_values="";
		if($outpatient_a=="SP") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Single practitioner&nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_b=="D") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Dispensary&nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_c=="P") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Polyclinic &nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_d=="DC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Dental Clinic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_e=="PO") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Physiotherapy / Occupational Therapy Clinic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_f=="IC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span>Infertility Clinic &nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_g=="DC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Dialysis Centre &nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_h=="DCC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span>Day Care centre&nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_i=="SC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span> Sub-Centre &nbsp;&nbsp;&nbsp;&nbsp;';
		if($outpatient_j=="MC") $outpatient_values=$outpatient_values. '<span class="tickmark">&#10004;</span>Mobile Clinic&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($outpatient_any_other)) $outpatient_values=$outpatient_values. "<br/><br/>Any Other : ". $outpatient_any_other;
		
		if(!empty($results["laboratory"])){
			$laboratory=json_decode($results["laboratory"]);
			if(isset($laboratory->a)) $laboratory_a=$laboratory->a; else $laboratory_a="";
			if(isset($laboratory->b)) $laboratory_b=$laboratory->b; else $laboratory_b="";
			if(isset($laboratory->c)) $laboratory_c=$laboratory->c; else $laboratory_c="";
			if(isset($laboratory->d)) $laboratory_d=$laboratory->d; else $laboratory_d="";
			if(isset($laboratory->e)) $laboratory_e=$laboratory->e; else $laboratory_e="";
			if(isset($laboratory->any_other)) $laboratory_any_other=$laboratory->any_other; else $laboratory_any_other="";
		}else{
			$laboratory_a="";$laboratory_b="";$laboratory_c="";$laboratory_d="";$laboratory_e="";$laboratory_any_other="";
		}
			
		//LABOTORY//
		$laboratory_values="";
		if($laboratory_a=="P") $laboratoryt_values=$laboratory_values. '<span class="tickmark">&#10004;</span> Single Pathology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($laboratory_b=="H") $laboratoryt_values=$laboratory_values. '<span class="tickmark">&#10004;</span> Haematology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($laboratory_c=="B") $laboratoryt_values=$laboratory_values. '<span class="tickmark">&#10004;</span> Biochemistry &nbsp;&nbsp;&nbsp;&nbsp;';
		if($laboratory_d=="M") $laboratoryt_values=$laboratory_values. '<span class="tickmark">&#10004;</span> Dental Microbiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($laboratory_e=="G") $laboratoryt_values=$laboratory_values. '<span class="tickmark">&#10004;</span> Dental Genetics&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($laboratory_any_other)) $laboratory_values=$laboratory_values. "<br/><br/>Any Other : ". $laboratory_any_other;
		
		if(!empty($results["imaging_center"])){
			$imaging_center=json_decode($results["imaging_center"]);
			if(isset($imaging_center->a)) $imaging_center_a=$imaging_center->a; else $imaging_center_a="";
			if(isset($imaging_center->b)) $imaging_center_b=$imaging_center->b; else $imaging_center_b="";
			if(isset($imaging_center->c)) $imaging_center_c=$imaging_center->c; else $imaging_center_c="";
			if(isset($imaging_center->d)) $imaging_center_d=$imaging_center->d; else $imaging_center_d="";
			if(isset($imaging_center->e)) $imaging_center_e=$imaging_center->e; else $imaging_center_e="";
			if(isset($imaging_center->any_other)) $imaging_center_any_other=$imaging_center->any_other; else $imaging_center_any_other="";
		}else{
			$imaging_center_a="";$imaging_center_b="";$imaging_center_c="";$imaging_center_d="";$imaging_center_e="";$imaging_center_any_other="";
		}
		//imaging_center//
		$imaging_center_values="";
		if($imaging_center_a=="X") $imaging_center_values=$imaging_center_values. '<span class="tickmark">&#10004;</span> Single Pathology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imaging_center_b=="ECG") $imaging_center_values=$imaging_center_values. '<span class="tickmark">&#10004;</span> Haematology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imaging_center_c=="U") $imaging_center_values=$imaging_center_values. '<span class="tickmark">&#10004;</span> Biochemistry &nbsp;&nbsp;&nbsp;&nbsp;';
		if($imaging_center_d=="CT") $imaging_center_values=$imaging_center_values. '<span class="tickmark">&#10004;</span> Dental Microbiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imaging_center_e=="MRI") $imaging_center_values=$imaging_center_values. '<span class="tickmark">&#10004;</span> Dental Genetics&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($imaging_center_any_other)) $imaging_center_values=$imaging_center_values. "<br/><br/>Any Other : ". $imaging_center_any_other;
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
			<p  style="text-align:center">[Under Section 14 of the Clinical Establishments (Registration and Regulation) Act, 2010]</p>
		</div><br/>
		<table class="table table-bordered table-responsive">		
			<tr>				
				<td valign="top" width="40%">1. Name of the Clinical Establishment:</td>
				<td  width="60%">'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td valign="top">2. Address:</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td valign="top">Street Name 1</td>
							<td>'.strtoupper($b_street_name1).'</td>
						</tr>
						<tr>
							<td valign="top">Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
						</tr>
						<tr>
							<td valign="top">Village/Town/city</td>
							<td>'.strtoupper($b_vill).'</td>
						</tr>
						<tr>
							<td valign="top">Block</td>
							<td>'.strtoupper($b_block).'</td>
						</tr>
						<tr>
							<td valign="top">District</td>
							<td>'.strtoupper($b_dist).'</td>
						</tr>
						<tr>
							<td valign="top">Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
						</tr>
						<tr>
							<td valign="top">Mobile No.</td>
							<td>'.strtoupper($b_mobile_no).'</td>
						</tr>
						<tr>
							<td valign="top">E-Mail ID</td>
							<td>'.$b_email.'</td>
						</tr>
						<tr>
							<td valign="top">Website (if any)</td>
							<td>'.$website_name.'</td>
						</tr>				
					</table>
				</td>
			</tr>
			<tr>
				<td>3. Name of the owner with address :</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td valign="top">Owner Name</td>
							<td>'.strtoupper($owner_name).'</td>
						</tr>
						<tr>
							<td valign="top">Street Name 1</td>
							<td>'.strtoupper($o_street_name1).'</td>
						</tr>
						<tr>
							<td valign="top">Street Name 2</td>
							<td>'.strtoupper($o_street_name2).'</td>
						</tr>
						<tr>
							<td valign="top">Village/Town/city</td>
							<td>'.strtoupper($o_vill).'</td>
						</tr>
						<tr>
							<td valign="top">Block</td>
							<td>'.strtoupper($o_block).'</td>
						</tr>
						<tr>
							<td valign="top">District</td>
							<td>'.strtoupper($o_dist).'</td>
						</tr>
						<tr>
							<td valign="top">Pincode</td>
							<td>'.strtoupper($o_pin).'</td>
						</tr>
						<tr>
							<td>Mobile No.</td>
							<td>'.strtoupper($o_mobile_no).'</td>
						</tr>
						<tr>
							<td>E-Mail ID</td>
							<td>'.$o_email.'</td>
						</tr>			
					</table>
				</td>
			</tr>
			
			
			
			<tr>
				<td colspan="2">4. Name, Designation and Qualification of person in-charge of the clinical establishment: </td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th align="center">Sl no</th>
						<th align="center">Name</th>
						<th align="center">Designation</th>
						<th align="center">Qualification</th>
						<th align="center">Registration Number</th>
						<th align="center">Name of Central/State Council(with which registered)</th>
						<th align="center">Mobile</th>
						<th align="center">E-mail ID</th>
					</tr>
				</thead>
				<tbody>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'") or die("Error : ".$health->error);
				$num = $part1->num_rows;
				if($num>0){
					$count=1;
					while($row_1=$part1->fetch_array()){ 
	        $printContents=$printContents.'
					<tr>
						<td>' . $count . '</td>
						<td>' . $row_1["name"] . '</td>
						<td>' . $row_1["designation"] . '</td>				
						<td>' . $row_1["qualification"] . '</td>
						<td>' . $row_1["reg_no"] . '</td>
						<td>' . $row_1["name_of_central"] . '</td>	
						<td>' . $row_1["mobile"] . '</td>													
						 <td>' . $row_1["email"] . '</td>	
					</tr>';
						
					}
				}
	$printContents=$printContents.'</tbody>											
					</table>
				</td>
	</tr>	
	<tr>
		<td colspan="2">(From 5 to 8 mark all whichever are applicable)</td>
	</tr>
    <tr>
	          <td>Location Type:  </td>
		     <td>'.strtoupper($location_type).'</td>
	</tr>
	<tr>
		<td>Description :</td>
		<td>'.strtoupper($fees_description).'</td>
	</tr>			
			<tr>
				<td colspan="2">5. Ownership of Services :  </td>
				
			</tr>
			<tr>
				<td><u>Government/Public Sector</u> </td>
				<td>' . $ownership_values . '</td>
			</tr>
			<tr>
				<td><u>Non-Government / Private Sector</u>  </td>
				<td>' . $ownership2_values . '</td>
			</tr>
			<tr>
				<td>6. System of Medicine: (please tick whichever is applicable)   </td>
				<td>' . $system_values . '</td>
			</tr>
			<tr>
				<td>7. Type of Clinical Services:  </td>
				<td>' . $clinical_values . '</td>
			</tr>
			<tr>
				<td>8. Type of Clinical Establishment: (please tick whichever is applicable)  <br/><br/>(a)</td>
				<td>' . $clinical_est_values . '</td>
			</tr>
			<tr>
				<td>(b) <u>i) Inpatient:</u>   </td>
				<td>' . $inpatient_values . '</td>
			</tr>
			<tr>
				<td><u>ii) Number of Beds:</u>  </td>
				<td>' . $no_bed . '</td>
			</tr>
			
			<tr>
				<td><u>iii) Outpatient:</u>  </td>
				<td>' . $outpatient_values . '</td>
			</tr>
			<tr>
				<td><u>iv) Laboratory :</u> </td>
				<td>' . $laboratory_values . '</td>
			</tr>
			
			<tr>
				<td><u>v) Imaging Centre:</u>   </td>
				<td>' . $imaging_center_values . '</td>
			</tr>
			<tr>
				<td><u>vi) Any other (please specify):</u>  </td>
				<td>' . $any_other . '</td>
			</tr>
			
			<tr>
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby declare that the statements made above are correct and true to the best of my knowledge. I shall abide by all the provisions of the Clinical Establishments (Registration and Regulation) Act, 2010 and the rules made there under. I shall intimate to the District Registering Authority, any change in the particulars given above.</td>
			</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
			<tr>
				<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
				<td align="right">Signature of Applicant : '.strtoupper($key_person).'<br/>
				Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
			</tr>
		</table>';
?>

