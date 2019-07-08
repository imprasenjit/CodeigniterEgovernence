<?php
$dept="factory";
$form="24";
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
	$form_id=$results["form_id"];$name_factory=$results["name_factory"];
	$appli_sign=$results["appli_sign"];
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
	  <td align="center" colspan="2"><b>Muster Roll</b></td>
	</tr>
	<tr>
	   <td>Name of Factory:</td>
	   <td>'.strtoupper($name_factory).'</td>
	</tr>
  <tr>
   <td colspan="2">
   <table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>Sl. No. </th>
			<th>Name of Worker</th>
			<th>Father&apos;s Name </th>
			<th>Nature of work</th>
			<th>For the period ending</th>
			<th>Remarks</th>
		</tr>
	</thead>
	';
	$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
	  while($row_1=$part1->fetch_array()){
		$printContents=$printContents.'
		<tr>
			<td>'.strtoupper($row_1["slno"]).'</td>
			<td>'.strtoupper($row_1["name_worker"]).'</td>
			<td>'.strtoupper($row_1["fathers_name"]).'</td>
			<td>'.strtoupper($row_1["nature_work"]).'</td>
			<td>'.strtoupper($row_1["period_end"]).'</td>
			<td>'.strtoupper($row_1["remarks"]).'</td>
		</tr>';
		}$printContents=$printContents.'
		</table>
	   </td>
      </tr>
	  <tr>
		  <td align="center" colspan="2"><b>Register of Accidents and Dangerous Occurrences</b></td>
	  </tr>
	   <tr>
   <td colspan="2">
   <table class="table table-bordered table-responsive">
	<thead>
		<tr>
			<th>Sl. No. </th>
			<th>Name of injured person(if any)</th>
			<th>Date of accident or dangerous occurrence </th>
			<th>Date of report(in form no 18) to Inspector</th>
			<th>Nature of accident or dangerous occurrence</th>
			<th>Date of return of injured person to work</th>
			<th>Number of days the injured person was absents from work</th>
		</tr>
	</thead>
	';
	$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
	  while($row_2=$part2->fetch_array()){
		$printContents=$printContents.'
		<tr>
			<td>'.strtoupper($row_2["slno"]).'</td>
			<td>'.strtoupper($row_2["injured_person"]).'</td>
			<td>'.strtoupper($row_2["date_of_accident"]).'</td>
			<td>'.strtoupper($row_2["date_of_report"]).'</td>
			<td>'.strtoupper($row_2["nature_accident"]).'</td>
			<td>'.strtoupper($row_2["date_of_return"]).'</td>
			<td>'.strtoupper($row_2["number_days"]).'</td>
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