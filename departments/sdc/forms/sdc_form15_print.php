<?php
$dept="sdc";
$form="15";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id=form_id");
}

	if($q->num_rows > 0){
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$co_name=$results["co_name"];$drug_name=$results["drug_name"];
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
			<td colspan="2">1.I/We  &nbsp;'.strtoupper($auth_person).'&nbsp; of &nbsp;'.strtoupper($unit_name).'&nbsp; hereby apply for the grant/ renewal of loan licence to manufacture on the premises situated at&nbsp;&nbsp;'.strtoupper($b_dist).'&nbsp;c/o. &nbsp;'.strtoupper($co_name).'&nbsp;the undermentioned drugs, being drugs specified in Schedules C and C(1) [excluding those specified in [Part XB and] Sch. X] to the Drugs and Cosmetics Rules, 1945.</td>
		</tr>
		<tr>
			<td width="50%">2. Names of drugs. :</td>
			<td width="50%">'.strtoupper($drug_name).'</td>
		</tr>
		<tr>
			<td colspan="2">3. The names, qualifications and experience of the expert staff actually connected with the manufacture and testing of the specified products in the manufacturing premises.</td>
		</tr>
		<tr>
			<td  colspan="2">	
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td align="center">Sl No </td>
					<td align="center"> Name </td>
					<td align="center">qualification</td>
					<td align="center">Experience</td>			
					<td align="center">Responsible</td>			
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
						if($row_1["responsible"]=="M"){
							$responsible="MANUFACTURE";
						}else{
							$responsible="TESTING";
						} 
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["qualification"]).'</td>
							<td>'.strtoupper($row_1["experience"]).'</td>
							<td>'.strtoupper($responsible).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
				
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> Designation :<strong>'.strtoupper($status_applicant).'</strong><br/> </td>				
		</tr>						
	</table>';
?>
