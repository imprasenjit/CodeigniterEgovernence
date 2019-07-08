<?php
$dept="mines";
$form="21";
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
	$lic_no=$results["lic_no"];$year=$results["year"];$tonns=$results["tonns"];$mineral=$results["mineral"];$quantity=$results["quantity"];$mineral_name=$results["mineral_name"];$date=$results["date"];
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
		<td colspan="2">To, <br/>&nbsp;&nbsp;&nbsp;The Director,<br/>&nbsp;&nbsp;&nbsp;Directorate of Geology & Mining, <br/>&nbsp;&nbsp;&nbsp;Kahilipara, Guwahati - 781019.</td>
	</tr>
	<tr>
		<td colspan="2"><br/>Sir/Madam, <br/>&nbsp;&nbsp;&nbsp;I/We hold a Mineral Dealer License Number &nbsp;'.strtoupper($lic_no).'&nbsp;(Year)&nbsp;'.strtoupper($year).'<br/>&nbsp;&nbsp;&nbsp;
		I/ we have procured/ received &nbsp;'.strtoupper($tonns).'&nbsp; tonns of &nbsp; '.strtoupper($mineral).'&nbsp; (names of minerals) from Bonafide Leases (List of the lessees and quantities attached). <br/>&nbsp;&nbsp;&nbsp;
		I/We have &nbsp;'.strtoupper($quantity).'&nbsp; (quantity) of &nbsp;'.strtoupper($mineral_name).'&nbsp; (Name of mineral) on &nbsp;'.strtoupper($date).'&nbsp; (date).<br/>&nbsp;&nbsp;&nbsp;
		I/ we therefore request you to kindly issue a transporting Challan book containing nos. of Challans.</td>
	</tr>	
	<tr>
    	<td colspan="2"><b>Details of payment made : </b></td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Amount (Rs.)</th>
					<th>Treasury Challan Number</th>
					<th>Date</th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				$sl=1;
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_1["amount"]).'</td>
						<td>'.strtoupper($row_1["challan"]).'</td>
						<td>'.strtoupper($row_1["date"]).'</td>
					</tr>';
					$sl++;
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
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2" align="right"> Yours faithfully,<br/><strong>'.strtoupper($key_person).'</strong><br/>'.strtoupper($lic_no).'<br/>'.strtoupper($year).' </td>				
	</tr>						
</table>';
?>

