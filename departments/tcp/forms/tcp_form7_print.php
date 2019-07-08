<?php
$dept="tcp";
$form="7";
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
	$form_id=$results["form_id"];
	$address=$results["address"];$conforms_to=$results["conforms_to"];$inst_address =$results["inst_address"];$zone =$results["zone"];
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
		'.$assamSarkarLogo.'<h4><br/><br/>'.$form_name.'</h4>
	</div><br/>
	<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
			<td colspan="2">
			Subject: Self Certification of ground based tower/composite structure (roof top tower + building) for communication network.<br/><br/>
			It is certified that the Ground based tower/composite structure (roof top tower + Building), a part of our communication network and located at &nbsp;'.strtoupper($address).' &nbsp;conforms to &nbsp;'.strtoupper($conforms_to).' &nbsp;GR issued by TEC, DoT/design approved by &nbsp;'.strtoupper($inst_address).'&nbsp;(name and address of the institute, etc.). The tower/composite structure (rooftop tower + building) falling under seismic zone&nbsp;'.strtoupper($zone).'&nbsp;is compliant to the latest BIS code IS 1893 and other provisions envisaged in the instructions issued by DoT from time to time. The relevant particulars are as per datasheet enclosed.</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="center">Signature: '.strtoupper($key_person).'</td>
		</tr>
	</table>';
?>