<?php
$dept="sdc";
$form="12";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id=form_id");
}

	
	if($q->num_rows > 0){
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$auth_person=$results["auth_person"];$licence_no=$results["licence_no"];$location=$results["location"];$homoeopathic=$results["homoeopathic"];
		if(!empty($results["competent_staff"])){
			$competent_staff=json_decode($results["competent_staff"]);
			$competent_staff_name=$competent_staff->name;$competent_staff_quali=$competent_staff->quali;
			$competent_staff_expc=$competent_staff->expc;
		}else{				
			$competent_staff_name="";$competent_staff_quali="";$competent_staff_expc="";
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
			<td colspan="2">1. I/We &nbsp;<b>'.strtoupper($auth_person).'</b>&nbsp; of &nbsp; <b>'.strtoupper($unit_name).'</b> &nbsp;holder of licence No. &nbsp;<b>'.strtoupper($licence_no).'</b>&nbsp; in Form 20-C hereby apply for grant/renewal of licence to manufacture the under-mentioned Homoeopathic Mother Tincture/Potentised and other preparations on the premises situated at &nbsp;<b>'.strtoupper($location).'</b>.</td>
		</tr>			
		<tr>
			<td>Name of the Homoeopathic preparations<br/>(Each item to be separately specified).:</td>
			<td>'.strtoupper($homoeopathic).'</td>
		</tr>			
		<tr>
			<td colspan="2">2. Names, qualifications and experience of technical staff employed for manufacture and testing of Homoeopathic medicines.</td>
		</tr>
		<tr>
			<td colspan="2">	
				<table class="table table-bordered table-responsive">
				<tr>
					<th>Sl No </th>
					<th>Name </th>
					<th>Qualification</th>
					<th>Experience</th>			
					<th>Responsible</th>			
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
					if($row_1["responsible"]=="M"){
						$responsible="MANUFACTURE";
					}else{
						$responsible="TESTING";
					} 
				$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_1["slno"]).'</td>
					<td>'.strtoupper($row_1["name"]).'</td>
					<td>'.strtoupper($row_1["qualification"]).'</td>
					<td>'.strtoupper($row_1["experience"]).'</td>
					<td>'.strtoupper($responsible).'</td>
				</tr>';
				}$printContents=$printContents.'
				</table>  
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
			
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="right"> Signature :&nbsp;<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>