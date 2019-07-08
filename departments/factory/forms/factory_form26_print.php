<?php
$dept="factory";
$form="26";
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
	$days_worked=$results['days_worked'];$rupees=$results['rupees'];$deduction=$results['deduction'];$amount=$results['amount'];$sign=$results['sign'];$designation=$results['designation'];
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
		<td width="50%">1. (a) Name of the Factory or Establishment </td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>  				
		<td>1. (b) Postal Address </td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>  				
		<td>2. Number of days worked during the year </td>
		<td>'.strtoupper($days_worked).'</td>
	</tr>	
	<tr>
		<td colspan="2">3. (a) Number of mandays worked during the year : </td>
	</tr>
	<tr>
		<td colspan="2">3. (b) Average daily number of person employed during the year : </td>
	</tr>
	<tr>
		<td colspan="2">3. (c) Gross amount paid as remuneration to person getting less than Rs. '.strtoupper($rupees).' per month including deduction under Section 7(2) '.strtoupper($deduction).' which the amount due to profit sharing bonus is and that due to money value of concessions is '.strtoupper($amount).'</td>
	</tr>	
	<tr>
		<td colspan="2">4. Total wages paid including deduction under Section 7(2) own the following accounts : </td>
	</tr>											
	<tr>
		<td colspan="2">5. Deductions - Number of case and amount realized : </td>
	</tr>											
	<tr>
		<td colspan="2">6. Fines Fund : </td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($sign).'</strong><br/>Designation : <strong>'.strtoupper($designation).'</strong></td>		
	</tr>
</table>';
?>