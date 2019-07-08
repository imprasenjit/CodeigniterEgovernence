<?php
$dept="factory";
$form="19";
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
	$form_id=$results["form_id"];$appli_sign=$results["appli_sign"];
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
   <td colspan="2">
   <table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>Sl. No. </th>
			<th>Department/works</th>
			<th>Name of Worker</th>
			<th>Sex </th>
			<th>Age (on Last Birthday)</th>
			<th colspan="2">Occupation</th>
			<th colspan="2">Examination of eye sight</th>
			<th>Signature of Ophthalmologist</th>
			<th>Remarks</th>
		</tr>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>Nature</th>
			<th>Date of Employment</th>
			<th>Date</th>
			<th>Result</th>
		</tr>
	</thead>';
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	  while($row_1=$part1->fetch_array()){
		$printContents=$printContents.'
		<tr>
			<td>'.strtoupper($row_1["slno"]).'</td>
			<td>'.strtoupper($row_1["works"]).'</td>
			<td>'.strtoupper($row_1["name_worker"]).'</td>
			<td>'.strtoupper($row_1["sex"]).'</td>
			<td>'.strtoupper($row_1["age_birthday"]).'</td>
			<td>'.strtoupper($row_1["nature"]).'</td>
			<td>'.strtoupper($row_1["employment_dt"]).'</td>
			<td>'.strtoupper($row_1["occu_date"]).'</td>
			<td>'.strtoupper($row_1["eye_result"]).'</td>
			<td>'.strtoupper($row_1["signature"]).'</td>
			<td>'.strtoupper($row_1["remarks"]).'</td>
		</tr>';
		}$printContents=$printContents.'
		</table>
	   </td>
      </tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($appli_sign).'</strong></td>		
	</tr>
</table>';
?>