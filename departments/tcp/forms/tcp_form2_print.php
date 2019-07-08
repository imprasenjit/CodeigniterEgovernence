<?php
$dept="tcp";
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


if($q->num_rows>0)	{
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];
	$ref_uain=$results["ref_uain"];$ownername=$results["ownername"];$location=$results["location"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$development_name=$results["development_name"];$development_address=$results["development_address"];
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
	<br/><br/>
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div>
	<br/><br/>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">Reference No./UAIN : '.strtoupper($ref_uain).'</td>
		</tr>
		<tr>
			<td>Owner&apos;s Name : '.strtoupper($ownername).'</td>
			<td>Location : '.strtoupper($location).'</td>
		</tr>
		<tr>
			<td>Submitted on : '.strtoupper($submit_dt).'</td>
			<td>Received on : '.strtoupper($receive_dt).'</td>
		</tr>
		<tr>
			<td colspan="2">
				Sir,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby inform you that the work of execution of the building as per approved plan, working drawing and structural drawings has reached the Plinth Level and is executed under our supervision.<br/>
				We declare that the amended plan is not necessary at this stage.
			</td>
		</tr>
		<tr>
			<td colspan="4">Yours faithfully,</td>
		</tr>
		<tr>
			<td>Name of the Construction Engineer on Record :</td>
			<td>'.strtoupper($engineer).'</td>
		</tr>
		<tr>
			<td>Address of the  Construction Engineer on Record :</td>
			<td>'.strtoupper($engineer_address).'</td>
		</tr>
		<tr>
			<td>Name of the Owner/Development/Builder :</td>
			<td >'.strtoupper($development_name).'</td>
			
		</tr>
		<tr>
			<td>Address of the Owner/Development/Builder :</td>
			<td >'.strtoupper($development_address).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
		<tr>
			<td >Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td >Signature of the Applicant :'.strtoupper($key_person).'</td>
		</tr>
	</table>';
?>