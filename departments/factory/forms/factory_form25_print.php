<?php
$dept="factory";
$form="25";
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
    $serial_no=$results["serial_no"];$serial_no_1=$results["serial_no_1"];$date_1=$results["date_1"];$date_2=$results["date_2"];$appli_name=$results["appli_name"];$fathers_name=$results["fathers_name"];$sex=$results["sex"];$resi_dence=$results["resi_dence"];$date_of_birth=$results["date_of_birth"];$physical_fitness=$results["physical_fitness"];$descriptive_marks=$results["descriptive_marks"];$descriptive_marks1=$results["descriptive_marks1"];$refusal_certificate=$results["refusal_certificate"];$certificate_revoked=$results["certificate_revoked"];$name_personally=$results["name_personally"];/*$name_factory=$results["name_factory"];*/$son_daughter=$results["son_daughter"];$residing=$results["residing"];$examination=$results["examination"];$appli_sign=$results["appli_sign"];
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
	   <td width="50%">1. Serial No</td>
	   <td>'.strtoupper($serial_no).'</td>
	 </tr>
	 <tr>
	   <td>Serial No</td>
	   <td>'.strtoupper($serial_no_1).'</td>
	</tr>
	<tr>
	   <td>Date </td>
	   <td>'.strtoupper($date_1).'</td>
	</tr>
	<tr>
	   <td>Date </td>
	   <td>'.strtoupper($date_2).'</td>
	</tr>
	<tr>
	   <td>Date </td>
	   <td>'.strtoupper($date_2).'</td>
	</tr>
	<tr>
	   <td>2. Name </td>
	   <td>'.strtoupper($appli_name).'</td>
	</tr>
	<tr>
	   <td>3. Fathers Name</td>
	   <td>'.strtoupper($fathers_name).'</td>
	</tr>
	<tr>
	   <td>4.Sex</td>
	   <td>'.strtoupper($sex).'</td>
	</tr>
	<tr>
	   <td>5. Residence</td>
	   <td>'.strtoupper($resi_dence).'</td>
	</tr>
	<tr>
	   <td>6.Date of Birth, if applicable and/or certified age</td>
	   <td>'.strtoupper($date_of_birth).'</td>
	</tr>
	<tr>
	   <td>7.Physical fitness</td>
	   <td>'.strtoupper($physical_fitness).'</td>
	</tr>
	<tr>
	   <td>8.Descriptive marks</td>
	   <td>'.strtoupper($descriptive_marks).'</td>
	</tr>
	<tr>
	   <td>His/Her descriptive marks are</td>
	   <td>'.strtoupper($descriptive_marks1).'</td>
	</tr>
	<tr>
	   <td colspan="2">9.Reason for:</td>
	</tr>
	<tr>
	   <td>1.Refusal of certificate</td>
	   <td>'.strtoupper($refusal_certificate).'</td>
	</tr>
	<tr>
	   <td>2.Certificate being revoked</td>
	   <td>'.strtoupper($certificate_revoked).'</td>
	</tr>
	<tr class="form-inline">
		<td colspan="4">I hereby certify that I have personally examined (name) &nbsp;'.strtoupper($name_personally).'&nbsp; Son /daughter of &nbsp;'.strtoupper($son_daughter).'&nbsp;residing at&nbsp;'.strtoupper($residing).'&nbsp; who is desirous of being employed in a factory, and that his/her age , as nearly of being employed in a factory, and that his/her age, as nearly as can be ascertained from my examination,&nbsp;'.strtoupper($examination).'&nbsp;is years, and that he/she is fit for employment in factory as an adult/ child.</td>
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