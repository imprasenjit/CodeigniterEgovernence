<?php
$dept="jdl";
$form="1";
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
		
			$peti_type="";$peti_is="";$peti_name="";$peti_nm="";$peti_dob="";$peti_nationality="";
			$peti_gender="";$peti_caste="";$peti_father_name="";$peti_mother_name="";$peti_mname="";$peti_address="";$peti_state="";$peti_dist="";$peti_pin="";$peti_occu="";$peti_email="";$peti_mobile="";$law_reg_no="";
			
			//tab 2//
			$resp_type="";$resp_is="";$resp_name="";$resp_age="";$resp_father_name="";$resp_mother_name="";$resp_address="";$resp_state="";$resp_dist="";$resp_pin="";$resp_law_reg_no="";$resp_occu="";$resp_email="";$resp_mobile="";$resp_nationality="";$resp_gender="";$resp_caste="";
		
	}	
		
    $form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form '.$form.'</title>
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
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>	
						<td>Petitioner&apos;s Name</td>
						<td>Parent&apos;s Name</td>
						<td>Petitioner&apos;s Address</td>
						<td>Occupation</td>
						<td>Nationality</td>
						<td>Gender</td>
						<td>Category</td>						
						<td>Petitioner Type</td>
						<td>Petitioner is</td>
						<td>Email ID</td>
						<td>Mobile No</td>						
						<td>Lawer Registration No</td>
						
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_petitioner WHERE form_id='$form_id'");
						while($row=$part1->fetch_array()){
							if($row["peti_nationality"]=="I"){
								$peti_nationality="Indian";
							}else{
								$peti_nationality="Other";
							}
							if($row["peti_gender"]=="M"){
								$peti_gender="Male";
							}else{
								$peti_gender="Femal";
							}
							if($row["peti_type"]=="M"){
								$peti_type="Main";
							}else{
								$peti_type="Other";
							}
							if($row["peti_is"]=="I"){
								$peti_is="Individual";
							}else{
								$peti_is="Group";
							}
							if($row["peti_caste"]=="H"){
								$peti_caste="Hindu";
							}elseif($row["peti_caste"]=="M"){
								$peti_caste="Muslim";
							}elseif($row["peti_caste"]=="C"){
								$peti_caste="Christian";
							}else{
								$peti_caste="Other";
							}
							
							
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row["peti_name"]).'</td>
							<td>'.strtoupper($row["peti_father_name"]).' , '.strtoupper($row["peti_mother_name"]).'</td>
							<td>'.strtoupper($row["peti_address"]).' , '.strtoupper($row["peti_dist"]).' , '.strtoupper($row["peti_state"]).' , '.strtoupper($row["peti_pin"]).'</td>
							<td>'.strtoupper($row["peti_occu"]).'</td>
							<td>'.strtoupper($peti_nationality).'</td>
							<td>'.strtoupper($peti_gender).'</td>
							<td>'.strtoupper($peti_caste).'</td>
							<td>'.strtoupper($peti_type).'</td>
							<td>'.strtoupper($peti_is).'</td>							
							<td>'.($row["peti_email"]).'</td>
							<td>'.strtoupper($row["peti_mobile"]).'</td>
							<td>'.strtoupper($row["law_reg_no"]).'</td>
														
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<td>Respondent&apos;s Name</td>
						<td>Parent&apos;s Name</td>
						<td>Respondent&apos;s Address</td>
						<td>Occupation</td>
						<td>Nationality</td>
						<td>Gender</td>
						<td>Category</td>						
						<td>Respondent Type</td>
						<td>Respondent is</td>
						<td>Email ID</td>
						<td>Mobile No</td>						
						<td>Lawer Registration No</td>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_respondent WHERE form_id='$form_id'");
						while($row=$part1->fetch_array()){
							if($row["resp_nationality"]=="I"){
								$resp_nationality="Indian";
							}else{
								$resp_nationality="Other";
							}
							if($row["resp_gender"]=="M"){
								$resp_gender="Male";
							}else{
								$resp_gender="Femal";
							}
							if($row["resp_type"]=="M"){
								$resp_type="Main";
							}else{
								$resp_type="Other";
							}
							if($row["resp_is"]=="I"){
								$resp_is="Individual";
							}else{
								$resp_is="Group";
							}
							if($row["resp_caste"]=="H"){
								$resp_caste="Hindu";
							}elseif($row["resp_caste"]=="M"){
								$resp_caste="Muslim";
							}elseif($row["resp_caste"]=="C"){
								$resp_caste="Christian";
							}else{
								$resp_caste="Other";
							}
							
							
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row["resp_name"]).'</td>
							<td>'.strtoupper($row["resp_father_name"]).','.strtoupper($row["resp_mother_name"]).'</td>
							<td>'.strtoupper($row["resp_address"]).','.strtoupper($row["resp_dist"]).','.strtoupper($row["resp_state"]).','.strtoupper($row["resp_pin"]).'</td>
							<td>'.strtoupper($row["resp_occu"]).'</td>
							<td>'.strtoupper($resp_nationality).'</td>
							<td>'.strtoupper($resp_gender).'</td>
							<td>'.strtoupper($resp_caste).'</td>
							<td>'.strtoupper($resp_type).'</td>
							<td>'.strtoupper($resp_is).'</td>
							<td>'.($row["resp_email"]).'</td>
							<td>'.strtoupper($row["resp_mobile"]).'</td>
							<td>'.strtoupper($row["resp_law_reg_no"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
	
	 <tr>
		<td><b>Signatures and Dates :</b></td>
		<td align="right">Signature of Applicant : '.strtoupper($key_person).'<br/>
		  Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
	</tr>  	
</table>
	';
?>