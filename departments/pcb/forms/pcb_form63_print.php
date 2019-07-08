<?php
$dept="pcb";
$form="63";
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
	$auth_num=$results['auth_num'];$auth_date=$results['auth_date'];$validity=$results['validity'];
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
		<td colspan="2"><b><u>Ref</u></b> : Your application for Grant of Extended Producer Responsibility - Authorisation for following Electrical & Electronic Equipment under E-Waste (Management) Rules, 2016</td>
	</tr>
	<tr>
		<td width="50%">1. Number of Authorisation</td>
		<td>'.strtoupper($auth_num).'</td>
	</tr>
	<tr>
		<td>2. Authorisation Date</td>
		<td>'.strtoupper($auth_date).'</td>
	</tr>
	<tr>
		<td colspan="2">3.  M/S &nbsp;'.strtoupper($unit_name).'&nbsp;is hereby granted Extended Producer Responsibility - Authorisation based on : <br/>(a) overall Extended Producer Responsibility plan <br/>(b) proposed target for collection of e-waste</td>
	</tr>
	<tr>
		<td colspan="2">4. The Authorisation shall be valid for a period of &nbsp;'.strtoupper($validity).'&nbsp;years from date of issue with following conditions: <br/>
		(i) you shall strictly follow the approved Extended Producer Responsibility plan, a copy of which is enclosed herewith;<br/>
		(ii) you shall ensure that collection mechanism or centre are set up or designated as per the details given in the Extended Producer Responsibility plan. Information on collection mechanism/centre including the state-wise setup should be provided;<br/>
		(iii) you shall ensure that all the collected e-waste is channelised to authorised dismantler or recycler designated as per the details. Information on authorised dismantler or recycler designated state-wise should be provided;<br/>
		(iv) you shall maintain records, in Form-2 of these Rules, of e-waste and make such records available for scrutiny by Central Pollution Control Board; <br/>
		(v) you shall file annual returns in Form-3 to the Central Pollution Control Board on or before 30th day of June following the financial year to which that returns relates; <br/>
		(vi) General Terms & Conditions of the Authorisation:
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; a) The authorisation shall comply with provisions of the Environment (Protection) Act, 1986 and the Rules made there under;
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b) The authorisation or its renewal shall be produced for inspection at the request of an officer authorised by the Central Pollution Control Board; 
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; c) Any change in the approved Extended Producer Responsibility plan should be informed to Central Pollution Control Board on which decision shall be communicated by Central Pollution Control Board within sixty days;
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; d) It is the duty of the authorised person to take prior permission of the concerned State Pollution Control Boards and Central Pollution Control Board to close down the facility;
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; e) An application for the renewal of authorisation shall be made as laid down in sub-rule (vi) of rule of 13(1) the E-Waste (Management) Rules, 2016;
		<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; f) The Board reserves right to cancel/amend/revoke the authorisation at any time as per the Policy of the Board or Government.</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td colspan="2" align="right">Authorized signatory : <strong>'.strtoupper($key_person).'</strong><br/>
		Designation : <strong>'.strtoupper($status_applicant).'</strong></td>
	</tr>
</table>';
?>