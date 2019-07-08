<?php
$dept="factory";
$form="13";
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
	$register_no=$results['register_no'];$department=$results['department'];$hours=$results['hours'];$normal_rate=$results['normal_rate'];$over_rate=$results['over_rate'];$cash=$results['cash'];$payment_dt=$results['payment_dt'];
	
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["overtime"])){
		$overtime=json_decode($results["overtime"]);			
		$overtime_dt=$overtime->dt;$overtime_extent=$overtime->extent;$overtime_total=$overtime->total;
	}else{
		$overtime_dt="";$overtime_extent="";$overtime_total="";
	}
	if(!empty($results["earning"])){
		$earning=json_decode($results["earning"]);
		$earning_normal=$earning->normal;$earning_over=$earning->over;$earning_total=$earning->total;
	}else{
		$earning_normal="";$earning_over="";$earning_total="";
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
		<td width="50%">1. No. in Register </td>
		<td>'.strtoupper($register_no).'</td>
	</tr>
	<tr>
		<td>2. Name of the worker </td>
		<td>'.strtoupper($worker_name).'</td>
	</tr>
	<tr>
		<td colspan="2">3. Residential Address of the Worker : </td>
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
		<td>4. Department </td>
		<td>'.strtoupper($department).'</td>
	</tr>
	<tr>
		<td>5. Date on which overtime has been worked </td>
		<td>'.strtoupper($overtime_dt).'</td>
	</tr>
	<tr>
		<td>6. Extent of overtime on each occassion </td>
		<td>'.strtoupper($overtime_extent).'</td>
	</tr>
	<tr>
		<td>7. Total overtime worked or production in case of piece workers </td>
		<td>'.strtoupper($overtime_total).'</td>
	</tr>
	<tr>
		<td>8. Normal hours </td>
		<td>'.strtoupper($hours).'</td>
	</tr>
	<tr>
		<td>9. Normal rate of pay </td>
		<td>'.strtoupper($normal_rate).'</td>
	</tr>
	<tr>
		<td>10. Overtime rate of pay </td>
		<td>'.strtoupper($over_rate).'</td>
	</tr>
	<tr>
		<td>11. Normal earning </td>
		<td>'.strtoupper($earning_normal).'</td>
	</tr>
	<tr>
		<td>12. Overtime earning </td>
		<td>'.strtoupper($earning_over).'</td>
	</tr>
	<tr>
		<td>13. Cash equivalent of advantages accruing through the concessional sale of food-grain and other articles </td>
		<td>'.strtoupper($cash).'</td>
	</tr>
	<tr>
		<td>14. Total earning </td>
		<td>'.strtoupper($earning_total).'</td>
	</tr>
	<tr>
		<td>15. Date on which overtime payments made </td>
		<td>'.strtoupper($payment_dt).'</td>
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