<?php
$dept="gmc";
$form="14";
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
	




if($q->num_rows > 0){
	$results=$q->fetch_array();	
	$form_id=$results["form_id"];$ref_no=$results["ref_no"];$submit_dt=$results["submit_dt"];$storey=$results["storey"];	
	if(!empty($results["eng"])){
		$eng=json_decode($results["eng"]);
		$eng_sign=$eng->sign;$eng_name=$eng->name;$eng_address=$eng->address;
	}else{				
		$eng_sign="";$eng_name="";$eng_address="";
	}
	if(!empty($results["dev"])){
		$dev=json_decode($results["dev"]);
        if(isset($dev->sign)) $dev_sign=$dev->sign; else $dev_sign="";
        if(isset($dev->name)) $dev_name=$dev->name; else $dev_name="";
        if(isset($dev->address)) $dev_address=$dev->address; else $dev_address="";
		
	}else{				
		$dev_sign="";$dev_name="";$dev_address="";
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
		<td width="25%">Reference No. </td>
		<td width="25%">'.strtoupper($ref_no).'</td>
		<td width="25%">Submitted on </td>
		<td width="25%">'.strtoupper($submit_dt).'</td>
	</tr>
	<tr>
		<td>Owners Name </td>
		<td>'.strtoupper($key_person).'</td>
		<td>Location </td>
		<td>'.strtoupper($b_dist).'</td>
	</tr>
	<tr>
		<td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;We hereby inform you that the work of execution of the building as per approved plan, working drawing and structural drawings has reached '.strtoupper($storey).' storey level and is executed under our supervision.<br/>We declare that the amended plan is not necessary at this stage.</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
				
	<tr>
		<td colspan="2">Signature of the Construction Engineer on Record : <b>'.strtoupper($eng_sign).'</b><br/>
			Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
			Name : '.strtoupper($eng_name).'<br/>
			Address : '.strtoupper($eng_address).'
		</td>
		<td colspan="2" align="right">Signature of the Owner/ Developer/ Builder : <b>'.strtoupper($dev_sign).'</b><br/>
			Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
			Name : '.strtoupper($dev_name).'<br/>
			Address : '.strtoupper($dev_address).'
		</td>
	</tr>
</table>';
?>