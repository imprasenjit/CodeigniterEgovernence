<?php
$dept="cei";
$form="30";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}

if($q->num_rows > 0){
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$regn_no=$results["regn_no"];$license_date=$results["license_date"];$license_class=$results["license_class"];
	
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);
		$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
	}else{				
		$period_from_dt="";$period_to_dt="";
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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>  				
		<td width="50%">1. Name of the contractor : </td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>  				
		<td>2. Registration No. of the license :</td>
		<td>'.strtoupper($regn_no). '</td>
	</tr>    
	<tr>  				
		<td>3. Class of the license :</td>
		<td>'.strtoupper($license_class).'</td>
	</tr>
	<tr>  				
		<td>4. License valid upto :</td>
		<td>'.strtoupper($license_date).'</td>		
	</tr>
	<tr>  				
		<td>5. Period of return :</td>
		<td>'.strtoupper($period_from_dt). ' To ' .strtoupper($period_to_dt).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Details of the supervisors, workmen and apprentice during the period of return :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
			<tr>
				<th width="5%">Sl. No.</th>
				<th width="20%">Name</th>
				<th width="10%">Designation</th>
				<th width="10%">Supervisor</th>
				<th width="10%">Workmen</th>
				<th width="10%">Apprentice</th>
				<th width="10%">Registration No. Of Permit/ Certificate</th>
				<th width="10%">Parts qualified</th>
				<th width="10%">Date of Validity</th>												
			</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				$sl=1;
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["designation"]).'</td>
						<td>'.strtoupper($row_1["supervisor"]).'</td>
						<td>'.strtoupper($row_1["workmen"]).'</td>
						<td>'.strtoupper($row_1["apprentice"]).'</td>
						<td>'.strtoupper($row_1["permit_no"]).'</td>
						<td>'.strtoupper($row_1["parts"]).'</td>
						<td>'.strtoupper($row_1["validity"]).'</td>
					</tr>';
					$sl++;
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		</td>
	</tr>';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Place : <strong>'.strtoupper($b_dist).'</strong><br/> 
		Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of the contractor : <strong>'.strtoupper($key_person).'</strong></td>							
	</tr>
</table>';
?>