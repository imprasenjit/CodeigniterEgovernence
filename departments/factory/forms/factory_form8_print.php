<?php
$dept="factory";
$form="8";
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
	$form_id=$results["form_id"];$department=$results['department'];$mark=$results['mark'];$position=$results['position'];	
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
		<td width="50%">1. Department </td>
		<td>'.strtoupper($department).'</td>
	</tr>
	<tr>  				
		<td>2. Hygrometer Distinctive mark or number </td>
		<td>'.strtoupper($mark).'</td>
	</tr>
	<tr>
		<td>3. Position in Department </td>
		<td>'.strtoupper($position).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Readings of Hygrometer : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table text-center table-bordered table-responsive">
			<thead>
				<tr>
					<th rowspan="2">Date, Month </th>
					<th rowspan="2">Year </th>
					<th colspan="2">Between 7 and 9 a.m. </th>
					<th colspan="2">Between 11 a.m. and 12 p.m. (but not in the rest period) </th>
					<th colspan="2">Between 4 and 5:30 p.m. </th>
					<th rowspan="2">If no humidity insert none </th>
					<th rowspan="2">Remarks </th>
				</tr>
				<tr>
					<th>Dry bulb </th>
					<th>Wet bulb </th>
					<th>Dry bulb </th>
					<th>Wet bulb </th>
					<th>Dry bulb </th>
					<th>Wet bulb </th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["dt_mon"]).'</td>
						<td>'.strtoupper($row_1["year"]).'</td>
						<td>'.strtoupper($row_1["dry1"]).'</td>
						<td>'.strtoupper($row_1["wet1"]).'</td>
						<td>'.strtoupper($row_1["dry2"]).'</td>
						<td>'.strtoupper($row_1["wet2"]).'</td>
						<td>'.strtoupper($row_1["dry3"]).'</td>
						<td>'.strtoupper($row_1["wet3"]).'</td>
						<td>'.strtoupper($row_1["humidity"]).'</td>
						<td>'.strtoupper($row_1["remarks"]).'</td>
					</tr>';
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
	</tr>
	<tr>
		<td colspan="2">Certified that the above entries are correct. </td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2" align="right">Signature : <strong>'.strtoupper($key_person).'</strong></td>		
	</tr>
</table>';
?>