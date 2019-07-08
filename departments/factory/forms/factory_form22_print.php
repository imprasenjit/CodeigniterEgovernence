<?php
$dept="factory";
$form="22";
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
	$worker_name=$results['worker_name'];$serial_no=$results['serial_no'];$father_name=$results['father_name'];$age=$results['age'];$birth_date=$results['birth_date'];$nature=$results['nature'];$qual=$results['qual'];$remarks=$results['remarks'];$occupier_sign=$results['occupier_sign'];
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
		<td width="50%">1. Name of worker </td>
		<td>'.strtoupper($worker_name).'</td>
	</tr>
	<tr>  				
		<td>2. Serial number as in the register of workers under Section 62 of the Act </td>
		<td>'.strtoupper($serial_no).'</td>
	</tr>
	<tr>  				
		<td>3. Father`s name </td>
		<td>'.strtoupper($father_name).'</td>
	</tr>
	<tr>
		<td>4. Age </td>
		<td>'.strtoupper($age).'</td>
	</tr>
	<tr>  				
		<td>5. Date of birth </td>
		<td>'.strtoupper($birth_date).'</td>
	</tr>
	<tr>  				
		<td>6. Nature of work </td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>  				
		<td>7. Qualification, if any or period of service on similar work </td>
		<td>'.strtoupper($qual).'</td>
	</tr>
	<tr>  				
		<td>8. Remarks </td>
		<td>'.strtoupper($remarks).'</td>
	</tr>
	<tr>
		<td colspan="2">I certify that the above-mentioned worker is a properly trained male adult worker who is competent to mount on ship belts of 6 inches or less in width of either laced or flush type belt joints to lubricate or do other adjusting operations on the machinery installed in my factory while they are in motion.</td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of Occupier : <strong>'.strtoupper($occupier_sign).'</strong></td>		
	</tr>
</table>';
?>