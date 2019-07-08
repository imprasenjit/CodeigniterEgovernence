<?php
$dept="factory";
$form="16";
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
	$week_end=$results['week_end'];$serial_no=$results['serial_no'];$nature=$results['nature'];$group_no=$results['group_no'];$transfers=$results['transfers'];$holidays=$results['holidays'];$lost_day=$results['lost_day'];$remarks=$results['remarks'];
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["in1"])){
		$in1=json_decode($results["in1"]);			
		$in1_sun=$in1->sun;$in1_mon=$in1->mon;$in1_tue=$in1->tue;$in1_wed=$in1->wed;$in1_thur=$in1->thur;$in1_fri=$in1->fri;$in1_sat=$in1->sat;
	}else{
		$in1_sun="";$in1_mon="";$in1_tue="";$in1_wed="";$in1_thur="";$in1_fri="";$in1_sat="";
	}
	if(!empty($results["in2"])){
		$in2=json_decode($results["in2"]);			
		$in2_sun=$in2->sun;$in2_mon=$in2->mon;$in2_tue=$in2->tue;$in2_wed=$in2->wed;$in2_thur=$in2->thur;$in2_fri=$in2->fri;$in2_sat=$in2->sat;
	}else{
		$in2_sun="";$in2_mon="";$in2_tue="";$in2_wed="";$in2_thur="";$in2_fri="";$in2_sat="";
	}
	if(!empty($results["in3"])){
		$in3=json_decode($results["in3"]);			
		$in3_sun=$in3->sun;$in3_mon=$in3->mon;$in3_tue=$in3->tue;$in3_wed=$in3->wed;$in3_thur=$in3->thur;$in3_fri=$in3->fri;$in3_sat=$in3->sat;
	}else{
		$in3_sun="";$in3_mon="";$in3_tue="";$in3_wed="";$in3_thur="";$in3_fri="";$in3_sat="";
	}
	if(!empty($results["in4"])){
		$in4=json_decode($results["in4"]);			
		$in4_sun=$in4->sun;$in4_mon=$in4->mon;$in4_tue=$in4->tue;$in4_wed=$in4->wed;$in4_thur=$in4->thur;$in4_fri=$in4->fri;$in4_sat=$in4->sat;
	}else{
		$in4_sun="";$in4_mon="";$in4_tue="";$in4_wed="";$in4_thur="";$in4_fri="";$in4_sat="";
	}
	if(!empty($results["out1"])){
		$out1=json_decode($results["out1"]);			
		$out1_sun=$out1->sun;$out1_mon=$out1->mon;$out1_tue=$out1->tue;$out1_wed=$out1->wed;$out1_thur=$out1->thur;$out1_fri=$out1->fri;$out1_sat=$out1->sat;
	}else{
		$out1_sun="";$out1_mon="";$out1_tue="";$out1_wed="";$out1_thur="";$out1_fri="";$out1_sat="";
	}
	if(!empty($results["out2"])){
		$out2=json_decode($results["out2"]);			
		$out2_sun=$out2->sun;$out2_mon=$out2->mon;$out2_tue=$out2->tue;$out2_wed=$out2->wed;$out2_thur=$out2->thur;$out2_fri=$out2->fri;$out2_sat=$out2->sat;
	}else{
		$out2_sun="";$out2_mon="";$out2_tue="";$out2_wed="";$out2_thur="";$out2_fri="";$out2_sat="";
	}
	if(!empty($results["out3"])){
		$out3=json_decode($results["out3"]);			
		$out3_sun=$out3->sun;$out3_mon=$out3->mon;$out3_tue=$out3->tue;$out3_wed=$out3->wed;$out3_thur=$out3->thur;$out3_fri=$out3->fri;$out3_sat=$out3->sat;
	}else{
		$out3_sun="";$out3_mon="";$out3_tue="";$out3_wed="";$out3_thur="";$out3_fri="";$out3_sat="";
	}
	if(!empty($results["out4"])){
		$out4=json_decode($results["out4"]);			
		$out4_sun=$out4->sun;$out4_mon=$out4->mon;$out4_tue=$out4->tue;$out4_wed=$out4->wed;$out4_thur=$out4->thur;$out4_fri=$out4->fri;$out4_sat=$out4->sat;
	}else{
		$out4_sun="";$out4_mon="";$out4_tue="";$out4_wed="";$out4_thur="";$out4_fri="";$out4_sat="";
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
		<td width="50%">Name of factory </td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td>Week ending </td>
		<td>'.strtoupper($week_end).'</td>
	</tr>
	<tr>
		<td>1. Serial No. </td>
		<td>'.strtoupper($serial_no).'</td>
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
		<td>4. Nature of work </td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>
		<td>5. Group Number </td>
		<td>'.strtoupper($group_no).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Period of Work : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-responsive table-bordered text-center">
			<thead>
				<tr>
					<th colspan="15">Actual times of starting and stopping for each period </th>
				</tr>
				<tr>
					<th rowspan="2"></th>
					<th colspan="2">Sunday </th>
					<th colspan="2">Monday </th>
					<th colspan="2">Tuesday </th>
					<th colspan="2">Wednesday </th>
					<th colspan="2">Thursday </th>
					<th colspan="2">Friday </th>
					<th colspan="2">Saturday </th>
				</tr>
				<tr>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
					<th>In </th>
					<th>Out </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>1st </td>
					<td>'.strtoupper($in1_sun).'</td>
					<td>'.strtoupper($out1_sun).'</td>
					<td>'.strtoupper($in1_mon).'</td>
					<td>'.strtoupper($out1_mon).'</td>
					<td>'.strtoupper($in1_tue).'</td>
					<td>'.strtoupper($out1_tue).'</td>
					<td>'.strtoupper($in1_wed).'</td>
					<td>'.strtoupper($out1_wed).'</td>
					<td>'.strtoupper($in1_thur).'</td>
					<td>'.strtoupper($out1_thur).'</td>
					<td>'.strtoupper($in1_fri).'</td>
					<td>'.strtoupper($out1_fri).'</td>
					<td>'.strtoupper($in1_sat).'</td>
					<td>'.strtoupper($out1_sat).'</td>
				</tr>
				<tr>
					<td>2nd </td>
					<td>'.strtoupper($in2_sun).'</td>
					<td>'.strtoupper($out2_sun).'</td>
					<td>'.strtoupper($in2_mon).'</td>
					<td>'.strtoupper($out2_mon).'</td>
					<td>'.strtoupper($in2_tue).'</td>
					<td>'.strtoupper($out2_tue).'</td>
					<td>'.strtoupper($in2_wed).'</td>
					<td>'.strtoupper($out2_wed).'</td>
					<td>'.strtoupper($in2_thur).'</td>
					<td>'.strtoupper($out2_thur).'</td>
					<td>'.strtoupper($in2_fri).'</td>
					<td>'.strtoupper($out2_fri).'</td>
					<td>'.strtoupper($in2_sat).'</td>
					<td>'.strtoupper($out2_sat).'</td>
				</tr>
				<tr>
					<td>3rd </td>
					<td>'.strtoupper($in3_sun).'</td>
					<td>'.strtoupper($out3_sun).'</td>
					<td>'.strtoupper($in3_mon).'</td>
					<td>'.strtoupper($out3_mon).'</td>
					<td>'.strtoupper($in3_tue).'</td>
					<td>'.strtoupper($out3_tue).'</td>
					<td>'.strtoupper($in3_wed).'</td>
					<td>'.strtoupper($out3_wed).'</td>
					<td>'.strtoupper($in3_thur).'</td>
					<td>'.strtoupper($out3_thur).'</td>
					<td>'.strtoupper($in3_fri).'</td>
					<td>'.strtoupper($out3_fri).'</td>
					<td>'.strtoupper($in3_sat).'</td>
					<td>'.strtoupper($out3_sat).'</td>
				</tr>
				<tr>
					<td>4th </td>
					<td>'.strtoupper($in4_sun).'</td>
					<td>'.strtoupper($out4_sun).'</td>
					<td>'.strtoupper($in4_mon).'</td>
					<td>'.strtoupper($out4_mon).'</td>
					<td>'.strtoupper($in4_tue).'</td>
					<td>'.strtoupper($out4_tue).'</td>
					<td>'.strtoupper($in4_wed).'</td>
					<td>'.strtoupper($out4_wed).'</td>
					<td>'.strtoupper($in4_thur).'</td>
					<td>'.strtoupper($out4_thur).'</td>
					<td>'.strtoupper($in4_fri).'</td>
					<td>'.strtoupper($out4_fri).'</td>
					<td>'.strtoupper($in4_sat).'</td>
					<td>'.strtoupper($out4_sat).'</td>
				</tr>
			</tbody>
		</table>
		</td>
        </tr>
	<tr>
		<td>7. Record of Transfers from one group to another </td>
		<td>'.strtoupper($transfers).'</td>
	</tr>
	<tr>
		<td>8. Progressive total of compensatory holidays </td>
		<td>'.strtoupper($holidays).'</td>
	</tr>
	<tr>
		<td>9. Progressive total of lost rest day </td>
		<td>'.strtoupper($lost_day).'</td>
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