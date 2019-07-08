<?php
$dept="factory";
$form="5";
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
	$occupier_name=$results['occupier_name'];$manager_name=$results['manager_name'];$sub_division=$results['sub_division'];$nature=$results['nature'];$no_of_days=$results['no_of_days'];

	if(!empty($results["mandays"])){
		$mandays=json_decode($results["mandays"]);
		$mandays_adult=$mandays->adult;$mandays_men=$mandays->men;$mandays_women=$mandays->women;$mandays_adolescents=$mandays->adolescents;$mandays_male=$mandays->male;$mandays_female=$mandays->female;$mandays_children=$mandays->children;$mandays_boys=$mandays->boys;$mandays_girls=$mandays->girls;
	}else{				
		$mandays_adult="";$mandays_men="";$mandays_women="";$mandays_adolescents="";$mandays_male="";$mandays_female="";$mandays_children="";$mandays_boys="";$mandays_girls="";
	}	
	
	if(!empty($results["workers"])){
		$workers=json_decode($results["workers"]);
		$workers_adult=$workers->adult;$workers_men=$workers->men;$workers_women=$workers->women;$workers_adolescents=$workers->adolescents;$workers_male=$workers->male;$workers_female=$workers->female;$workers_children=$workers->children;$workers_boys=$workers->boys;$workers_girls=$workers->girls;
	}else{				
		$workers_adult="";$workers_men="";$workers_women="";$workers_adolescents="";$workers_male="";$workers_female="";$workers_children="";$workers_boys="";$workers_girls="";
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
		<td width="50%">1. Name of the Factory :</td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>  				
		<td>2. Name of the Occupier :</td>
		<td>'.strtoupper($occupier_name).'</td>
	</tr>
	<tr>  				
		<td>3. Name of the Manager :</td>
		<td>'.strtoupper($manager_name).'</td>
	</tr>
	<tr>  				
		<td>4. Postal Address :</td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>  				
		<td>5. District :</td>
		<td>'.strtoupper($b_dist).'</td>
	</tr>
	<tr>  				
		<td>6. Sub-Division :</td>
		<td>'.strtoupper($sub_division).'</td>
	</tr>
	<tr>  				
		<td>7. Nature of Industry :</td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>  				
		<td>8. Number of days worked during the half yearly ending 30th june  :</td>
		<td>'.strtoupper($no_of_days).'</td>
	</tr>
	<tr>  				
		<td colspan="4">9. Number of mandays worked during the half yearly ending 30th June :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">Adult</td>
				<td width="25%">'.strtoupper($mandays_adult).'</td>
				<td width="25%">Men</td>
				<td width="25%">'.strtoupper($mandays_men).'</td>
			</tr>
			<tr>
				<td>Women</td>
				<td>'.strtoupper($mandays_women).'</td>
				<td>Adolescents</td>
				<td>'.strtoupper($mandays_adolescents).'</td>
			</tr>
			<tr>
				<td>Male</td>
				<td>'.strtoupper($mandays_male).'</td>
				<td>Female</td>
				<td>'.strtoupper($mandays_female).'</td>
			</tr>
			<tr>
				<td>Children</td>
				<td>'.strtoupper($mandays_children).'</td>
				<td>Boys</td>
				<td>'.strtoupper($mandays_boys).'</td>
			</tr>
			<tr>
				<td>Girls</td>
				<td>'.strtoupper($mandays_girls).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td colspan="4">10. Average number of workers employed daily :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">Adult</td>
				<td width="25%">'.strtoupper($workers_adult).'</td>
				<td width="25%">Men</td>
				<td width="25%">'.strtoupper($workers_men).'</td>
			</tr>
			<tr>
				<td>Women</td>
				<td>'.strtoupper($workers_women).'</td>
				<td>Adolescents</td>
				<td>'.strtoupper($workers_adolescents).'</td>
			</tr>
			<tr>
				<td>Male</td>
				<td>'.strtoupper($workers_male).'</td>
				<td>Female</td>
				<td>'.strtoupper($workers_female).'</td>
			</tr>
			<tr>
				<td>Children</td>
				<td>'.strtoupper($workers_children).'</td>
				<td>Boys</td>
				<td>'.strtoupper($workers_boys).'</td>
			</tr>
			<tr>
				<td>Girls</td>
				<td>'.strtoupper($workers_girls).'</td>
				<td colspan="2"></td>
			</tr>
		</table>
		</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2">The average daily number should be calculated by dividing the aggregate number of attendance on working days by the number of working days during the half year. In reckoning attendance , attendance by temporary as well as permanent employees should be counted and all employees (including apprentice) should be counted and all employees should be included whether they are employed directly or under contractor. Attendance on separate shifts (e. g. night and day shifts) should be counted separately. Days on which the factory was closed, for whatever cause, and days on which the manufacturing processes were not carried on should not be treated as working days. However, if more than 50% of workers employed (on the previous days) attend to repair maintenance or other such work on closed days, such days should be treated as working days. <br/><br/>Partial attendance for less than half a shift of working days should be neglected and attendance of half a shift or more should be treated as full attendance. <br/><br/>Certified that the information furnished above is to the best of my knowledge and belief, correct.</td>
	</tr>
	<tr>
		<td align="left">Signature of Occupier : <strong>'.strtoupper($occupier_name).'</strong><br/>	
		Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of Manager : <strong>'.strtoupper($manager_name).'</strong><br/>	
		Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>		
	</tr>
</table>';
?>