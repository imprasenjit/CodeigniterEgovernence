<?php
$dept="factory";
$form="15";
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
	$serial_no=$results['serial_no'];$father_name=$results['father_name'];$work_name=$results['work_name'];$letter=$results['letter'];$relay_no=$results['relay_no'];$token_no=$results['token_no'];$remarks=$results['remarks'];
	
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["certificate"])){
		$certificate=json_decode($results["certificate"]);			
		$certificate_no=$certificate->no;$certificate_dt=$certificate->dt;
	}else{
		$certificate_no="";$certificate_dt="";
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
		<td width="50%">1. Serial No. </td>
		<td>'.strtoupper($serial_no).'</td>
	</tr>
	<tr>
		<td>2. Name of worker </td>
		<td>'.strtoupper($worker_name).'</td>
	</tr>
	<tr>
		<td colspan="2">3. Residential Address of Worker : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Street name 1 </td>
					<td>'.strtoupper($worker_sn1).'</td>
				</tr>
				<tr>
					<td>Street name 2 </td>
					<td>'.strtoupper($worker_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town </td>
					<td>'.strtoupper($worker_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($worker_dist).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($worker_pin).'</td>
				</tr>
				<tr>
					<td>Mobile No. </td>
					<td>+91 - '.strtoupper($worker_mobile).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>4. Father`s Name </td>
		<td>'.strtoupper($father_name).'</td>
	</tr>	
	<tr>
		<td>5. Name of work </td>
		<td>'.strtoupper($work_name).'</td>
	</tr>	
	<tr>
		<td>6. Letter of Group as in Form 11 </td>
		<td>'.strtoupper($letter).'</td>
	</tr>	
	<tr>
		<td>7. Number of relay, if working in shifts </td>
		<td>'.strtoupper($relay_no).'</td>
	</tr>
	<tr>
		<td>8. No. of certificate and date if an adolesscent </td>
		<td>Number : '.strtoupper($certificate_no).'<br/>Date : '.strtoupper($certificate_dt).'</td>
	</tr>		
	<tr>
		<td>9. Token No. giving reference to the certificate </td>
		<td>'.strtoupper($token_no).'</td>
	</tr>
	<tr>
		<td>10. Remarks </td>
		<td>'.strtoupper($remarks).'</td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong></td>		
	</tr>
</table>';
?>