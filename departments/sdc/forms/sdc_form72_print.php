<?php
$dept="sdc";
$form="72";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
}

if($q->num_rows > 0){
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$auth_person=$results["auth_person"];
	if(!empty($results["pre"])){
		$pre=json_decode($results["pre"]);
		$pre_lic_no=$pre->lic_no;$pre_form_num=$pre->form_num;$pre_validity=$pre->validity;$pre_doi=$pre->doi;
	}else{
		$pre_lic_no="";$pre_form_num="";$pre_validity="";$pre_doi="";
	}
}

$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);
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
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.' <br/></h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">1. I/We &nbsp;'.strtoupper($auth_person).'&nbsp; of M/S&nbsp;'.strtoupper($unit_name).'&nbsp; hereby apply to manufacturer additional products of cosmetics for sale on the premises situated at &nbsp;'.strtoupper($b_dist).'.</td>
	</tr>
	<tr>
		<td colspan="2">2. Drug License No. &nbsp;'.$pre_lic_no.'&nbsp; Form &nbsp;'.$pre_form_num.'&nbsp; Validity &nbsp;'.$pre_validity.'&nbsp; Date of issue &nbsp;'.$pre_doi.'&nbsp;.</td>
	</tr>
	<tr>			
		<td colspan="2">3. Name of the Products :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr align="center">
					<th width="10%">Slno</th>
					<th width="30%">Name of the Product</th>
					<th width="30%">Formulation Details</th>
					<th width="30%">Pack Size</th>		
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["formula_details"]).'</td>
							<td>'.strtoupper($row_1["pack_size"]).'</td>
					</tr>';
				}
				$printContents=$printContents.'
			</table> 
		</td>
	</tr>';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'

	<tr>
		<td>Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="right"> Signature : <strong>'.strtoupper($key_person).'</strong><br/> 
		Designation : <strong>'.strtoupper($status_applicant).'</strong><br/> </td>				
	</tr>						
</table>';
?>