<?php
$dept="factory";
$form="18";
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
	$serial_no=$results['serial_no'];$child=$results['child'];$department=$results['department'];$name_child=$results['name_child'];$child_serial=$results['child_serial'];$father_name=$results['father_name'];$entry_dt=$results['entry_dt'];$discharge_dt=$results['discharge_dt'];$service_year=$results['service_year'];$is_leave=$results['is_leave'];$balance=$results['balance'];$remarks=$results['remarks'];
	
	if(!empty($results["payment"])){
		$payment=json_decode($results["payment"]);			
		$payment_amount=$payment->amount;$payment_dt=$payment->dt;
	}else{
		$payment_amount="";$payment_dt="";
	}
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);			
		$period_from=$period->from;$period_to=$period->to;
	}else{
		$period_from="";$period_to="";
	}
	if(!empty($results["wage"])){
		$wage=json_decode($results["wage"]);			
		$wage_earn=$wage->earn;$wage_days=$wage->days;
	}else{
		$wage_earn="";$wage_days="";
	}
	if(!empty($results["days"])){
		$days=json_decode($results["days"]);
		$days_a=$days->a;$days_b=$days->b;$days_c=$days->c;$days_d=$days->d;$days_e=$days->e;
	}else{
		$days_a="";$days_b="";$days_c="";$days_d="";$days_e="";
	}	
	if(!empty($results["credit"])){
		$credit=json_decode($results["credit"]);
		$credit_a=$credit->a;$credit_b=$credit->b;$credit_c=$credit->c;
	}else{
		$credit_a="";$credit_b="";$credit_c="";
	}	
	if(!empty($results["leaves"])){
		$leaves=json_decode($results["leaves"]);			
		$leaves_from=$leaves->from;$leaves_to=$leaves->to;
	}else{
		$leaves_from="";$leaves_to="";
	}	
	if(!empty($results["rate"])){
		$rate=json_decode($results["rate"]);
		$rate_a=$rate->a;$rate_b=$rate->b;$rate_c=$rate->c;
	}else{
		$rate_a="";$rate_b="";$rate_c="";
	}	
	
	if($is_leave=="Y") $is_leave="Yes";
	else $is_leave="No";
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
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Serial No. : '.strtoupper($serial_no).'</td>
					<td>Adult/Child : '.strtoupper($child).'</td>
				</tr>
				<tr>
					<td>Department : '.strtoupper($department).'</td>
					<td>Name : '.strtoupper($name_child).'</td>
				</tr>
				<tr>
					<td>Serial No. in the Adult/Child workers : '.strtoupper($child_serial).'</td>
					<td>Father`s Name : '.strtoupper($father_name).'</td>
				</tr>
				<tr>
					<td>Date of entry into service : '.strtoupper($entry_dt).'</td>
					<td>Date of discharge : '.strtoupper($discharge_dt).'</td>
				</tr>
				<tr>
					<td>Name of factory : '.strtoupper($unit_name).'</td>
					<td>Date and amount of payment made in lieu of leave due : <br/><b>Date :</b> '.strtoupper($payment_dt).', <b>Amount :</b> '.strtoupper($payment_amount).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td width="50%">1. Calendar year of service </td>
		<td>'.strtoupper($service_year).'</td>
	</tr>
	<tr>
		<td>2. Wage period or periods during one month immediately preceeding leave </td>
		<td>From : '.strtoupper($period_from).'<br/>To : '.strtoupper($period_to).'</td>
	</tr>	
	<tr>
		<td>3. Wages earned during the wage period in point 2 and the number of days worked during the period </td>
		<td>Wages earned : '.strtoupper($wage_earn).'<br/>Number of days : '.strtoupper($wage_days).'</td>
	</tr>
	<tr>
		<td colspan="2"><b>No. of days worked during calendar year : </b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">4. Number of days work perfomed </td>
					<td>'.strtoupper($days_a).'</td>
				</tr>
				<tr>
					<td>5. Number of days of layoff </td>
					<td>'.strtoupper($days_b).'</td>
				</tr>
				<tr>
					<td>6. Number of days of maternity leave </td>
					<td>'.strtoupper($days_c).'</td>
				</tr>
				<tr>
					<td>7. Number of days of leave enjoyed </td>
					<td>'.strtoupper($days_d).'</td>
				</tr>
				<tr>
					<td><b>8. Total </b></td>
					<td><b>'.strtoupper($days_e).'</b></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>Leave to Credit : </b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">9. Balance of leave from preceeding year </td>
					<td>'.strtoupper($credit_a).'</td>
				</tr>
				<tr>
					<td>10. Leave earned during the year mentioned in point 1 </td>
					<td>'.strtoupper($credit_b).'</td>
				</tr>
				<tr>
					<td><b>11. Total </b></td>
					<td><b>'.strtoupper($credit_c).'</b></td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>12. Whether leave in accordance with schemes under Section 9 (8) was refused </td>
		<td>'.strtoupper($is_leave).'</td>
	</tr>
	<tr>
		<td>13. Leave enjoyed </td>
		<td>From : '.strtoupper($leaves_from).'<br/>To : '.strtoupper($leaves_to).'</td>
	</tr>
	<tr>
		<td>14. Balance of leave to credit </td>
		<td>'.strtoupper($balance).'</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">15. Normal rate of wages </td>
					<td>'.strtoupper($rate_a).'</td>
				</tr>
				<tr>
					<td>16. Cash equivalent of advantage accruing through concessional sale of foodgrains and other articles </td>
					<td>'.strtoupper($rate_b).'</td>
				</tr>
				<tr>
					<td><b>17. Rate of wages for the leave period </b></td>
					<td><b>'.strtoupper($rate_c).'</b></td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>18. Remarks </td>
		<td>'.strtoupper($remarks).'</td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong></td>		
	</tr>
</table>';
?>