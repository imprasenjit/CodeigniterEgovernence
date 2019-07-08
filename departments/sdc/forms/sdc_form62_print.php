<?php
$dept="sdc";
$form="62";
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
	if(!empty($results["drug"])){
		$drug=json_decode($results["drug"]);
		$drug_licence_no=$drug->licence_no;$drug_form_no=$drug->form_no;$drug_validity=$drug->validity;$drug_doissue=$drug->doissue;
	}else{
		$drug_licence_no="";$drug_form_no="";$drug_validity="";$drug_doissue="";
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
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">1. I/We  &nbsp;'.strtoupper($auth_person).'&nbsp; of M/S '.strtoupper($unit_name).'&nbsp; hereby apply  to manufacturer additional products of Drugs for sale on the premises situated at &nbsp;'.strtoupper($b_dist).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Drug License No. &nbsp;'.$drug_licence_no.'&nbsp; Form &nbsp;'.$drug_form_no.'&nbsp; Validity &nbsp;'.$drug_validity.'&nbsp; Date of issue &nbsp;'.$drug_doissue.'&nbsp;.</td>
	</tr>
	<tr>
		<td>3. Name of the products:</td>
	</tr>
	<tr>
		<td colspan="4">
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Sl No </td>
					<td>Name of the product </td>
					<td>Composition</td>
					<td>Strength</td>
					<td>Claim</td>
					<td>Existing brand/From 46</td>			
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				if($part1->num_rows>0){
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name_of_product"]).'</td>
							<td>'.strtoupper($row_1["coposition"]).'</td>
							<td>'.strtoupper($row_1["strength"]).'</td>
							<td>'.strtoupper($row_1["claim"]).'</td>
							<td>'.strtoupper($row_1["existing_brand"]).'</td>
					</tr>';
					}
				}				
				$printContents=$printContents.'
			</table>   	
		</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'	
				
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> </td>				
	</tr>						
</table>';
?>