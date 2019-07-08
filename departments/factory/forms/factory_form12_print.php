<?php
$dept="factory";
$form="12";
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
	$serial_no=$results['serial_no'];$register=$results['register'];$group_no=$results['group_no'];$lost_days=$results['lost_days'];$remarks=$results['remarks'];
		
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["exempt"])){
		$exempt=json_decode($results["exempt"]);			
		$exempt_no=$exempt->no;$exempt_dt=$exempt->dt;
	}else{
		$exempt_no="";$exempt_dt="";
	}
	if(!empty($results["days"])){
		$days=json_decode($results["days"]);
		$days_year=$days->year;$days_jan=$days->jan;$days_april=$days->april;$days_july=$days->july;$days_oct=$days->oct;
	}else{
		$days_year="";$days_jan="";$days_april="";$days_july="";$days_oct="";
	}	
	if(!empty($results["holiday"])){
		$holiday=json_decode($results["holiday"]);
		$holiday_jan=$holiday->jan;$holiday_april=$holiday->april;$holiday_july=$holiday->july;$holiday_oct=$holiday->oct;
	}else{
		$holiday_jan="";$holiday_april="";$holiday_july="";$holiday_oct="";
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
		<td>2. Number in the register of workers </td>
		<td>'.strtoupper($register).'</td>
	</tr>
	<tr>
		<td>3. Name of the worker </td>
		<td>'.strtoupper($worker_name).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Address of the Worker : </td>
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
		<td>5. Group or Relay No. </td>
		<td>'.strtoupper($group_no).'</td>
	</tr>
	<tr>
		<td>6. Number and date of exempting order </td>
		<td>Number : '.strtoupper($exempt_no).'<br/>Date : '.strtoupper($exempt_dt).'</td>
	</tr>
	<tr>
		<td colspan="2">7. Weekly lost days due to exempting order in : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Year </td>
					<td>'.strtoupper($days_year).'</td>
				</tr>
				<tr>
					<td>January to March </td>
					<td>'.strtoupper($days_jan).'</td>
				</tr>
				<tr>
					<td>April to June </td>
					<td>'.strtoupper($days_april).'</td>
				</tr>
				<tr>
					<td>July to September </td>
					<td>'.strtoupper($days_july).'</td>
				</tr>
				<tr>
					<td>October to December </td>
					<td>'.strtoupper($days_oct).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">8. Date of compensatory holiday given in : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">January to March </td>
					<td>'.strtoupper($holiday_jan).'</td>
				</tr>
				<tr>
					<td>April to June </td>
					<td>'.strtoupper($holiday_april).'</td>
				</tr>
				<tr>
					<td>July to September </td>
					<td>'.strtoupper($holiday_july).'</td>
				</tr>
				<tr>
					<td>October to December </td>
					<td>'.strtoupper($holiday_oct).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>9. Lost rest days carried to the next year </td>
		<td>'.strtoupper($lost_days).'</td>
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