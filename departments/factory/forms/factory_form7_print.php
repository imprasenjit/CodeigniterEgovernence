<?php
$dept="factory";
$form="7";
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
	$nature_of_industry=$results['nature_of_industry'];$name_patient=$results['name_patient'];$works_no_patient=$results['works_no_patient'];$sex=$results['sex'];$age=$results['age'];$occupation=$results['occupation'];$nature_of_poison=$results['nature_of_poison'];$is_reported=$results['is_reported'];

	if(!empty($results["patient"])){
		$patient=json_decode($results["patient"]);
		$patient_sn1=$patient->sn1;$patient_sn2=$patient->sn2;$patient_vill=$patient->vill;$patient_dist=$patient->dist;$patient_pincode=$patient->pincode;$patient_mobile=$patient->mobile;
	}else{				
		$patient_sn1="";$patient_sn2="";$patient_vill="";$patient_dist="";$patient_pincode="";$patient_mobile="";
	}	
	
	if($is_reported=="Y")  $is_reported="Yes";
	else  $is_reported="No";
	
	if($sex=="M")  $sex="Male";
	else  $sex="Female";
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
		<td colspan="2" align="center"><strong>FACTORY PARTICULARS</strong></td>
	</tr>
	<tr>  				
		<td width="50%">1. Name of the Factory :</td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>  				
		<td>2. Address of the Factory :</td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>
		<td colspan="2">3. Address of office or private residence of occupier :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($street_name1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($street_name2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($mobile_no).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>4. Nature of Industry :</td>
		<td>'.strtoupper($nature_of_industry).'</td>
	</tr>
	<tr>
		<td colspan="4" align="center"><strong>PERSON AFFECTED</strong></td>
	</tr>
	<tr>
		<td>5. Name of patient : </td>
		<td>'.strtoupper($name_patient).'</td>
	</tr>
	<tr>  				
		<td>6. Works Number of patient :</td>
		<td>'.strtoupper($works_no_patient).'</td>
	</tr>
	<tr>
		<td colspan="2">7. Address of patient :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($patient_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($patient_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($patient_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($patient_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($patient_pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($patient_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>8. Sex of patient  :</td>
		<td>'.strtoupper($sex).'</td>
	</tr>
	<tr>  				
		<td>9. Age of patient :</td>
		<td>'.strtoupper($age).'</td>
	</tr>
	<tr>  				
		<td>10. Precise occupation of patient  :</td>
		<td>'.strtoupper($occupation).'</td>
	</tr>
	<tr>  				
		<td>11. Nature of Poisoning or Disease from which patient is suffering  :</td>
		<td>'.strtoupper($nature_of_poison).'</td>
	</tr>
	<tr>
		<td colspan="4" align="center"><strong>GENERAL PARTICULARS</strong></td>
	</tr>
	<tr>
		<td>12. Has the case been reported to the Certifying Surgeon? </td>
		<td>'.strtoupper($is_reported).'</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2" align="right">Signature of Factory Manager : <strong>'.strtoupper($key_person).'</strong><br/>	
		Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>		
	</tr>
</table>';
?>