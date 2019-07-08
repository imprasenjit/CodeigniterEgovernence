<?php
$dept="factory";
$form="23";
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
	$system=$results['system'];$transport=$results['transport'];$defects=$results['defects'];$certify_dt=$results['certify_dt'];$sign=$results['sign'];$qual=$results['qual'];$qual=$results['qual'];$address=$results['address'];
	if(!empty($results["hood"])){
		$hood=json_decode($results["hood"]);			
		$hood_serial=$hood->serial;$hood_contaminant=$hood->contaminant;$hood_design=$hood->design;$hood_actual=$hood->actual;$hood_volume=$hood->volume;$hood_pressure=$hood->pressure;
	}else{
		$hood_serial="";$hood_contaminant="";$hood_design="";$hood_actual="";$hood_volume="";$hood_pressure="";
	}
	if(!empty($results["pressure"])){
		$pressure=json_decode($results["pressure"]);
		$pressure_joints=$pressure->joints;$pressure_other=$pressure->other;
	}else{
		$pressure_joints="";$pressure_other="";
	}
	if(!empty($results["device"])){
		$device=json_decode($results["device"]);
		$device_type=$device->type;$device_velocity1=$device->velocity1;$device_velocity2=$device->velocity2;$device_pressure1=$device->pressure1;$device_pressure2=$device->pressure2;
	}else{
		$device_type="";$device_velocity1="";$device_velocity2="";$device_pressure1="";$device_pressure2="";
	}
	if(!empty($results["fan"])){
		$fan=json_decode($results["fan"]);
		$fan_type=$fan->type;$fan_volume=$fan->volume;$fan_pressure=$fan->pressure;$fan_drop=$fan->drop;
	}else{
		$fan_type="";$fan_volume="";$fan_pressure="";$fan_drop="";
	}
	if(!empty($results["motor"])){
		$motor=json_decode($results["motor"]);
		$motor_type=$motor->type;$motor_speed=$motor->speed;
	}else{
		$motor_type="";$motor_speed="";
	}
	if(!empty($results["employ"])){
		$employ=json_decode($results["employ"]);
		$employ_name=$employ->name;$employ_add=$employ->add;
	}else{
		$employ_name="";$employ_add="";
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
		<td width="50%">1. Description of system </td>
		<td>'.strtoupper($system).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Hood : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">(a) Serial No. of Hood </td>
					<td>'.strtoupper($hood_serial).'</td>
				</tr>
				<tr>  				
					<td>(b) Contaminant captured </td>
					<td>'.strtoupper($hood_contaminant).'</td>
				</tr>
				<tr>  				
					<td>(c) Capture velocities (at points to be specified) </td>
					<td>Design value : '.strtoupper($hood_design).'<br/>Actual value : '.strtoupper($hood_actual).'</td>
				</tr>
				<tr>  				
					<td>(d) Volume exhausted at hood </td>
					<td>'.strtoupper($hood_volume).'</td>
				</tr>
				<tr>  				
					<td>(e) Hood Static pressure </td>
					<td>'.strtoupper($hood_pressure).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">3. Total pressure drop at : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">(a) Joints </td>
					<td>'.strtoupper($pressure_joints).'</td>
				</tr>
				<tr>  				
					<td>(b) Other points of system (to be specified) </td>
					<td>'.strtoupper($pressure_other).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>4. Transport velocity in Duet (at points along duets to be specified) </td>
		<td>'.strtoupper($transport).'</td>
	</tr>
	<tr>
		<td colspan="2">5. Air cleaning Device : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">(a) Type used </td>
					<td>'.strtoupper($device_type).'</td>
				</tr>
				<tr>  				
					<td>(b) Velocity at inlet </td>
					<td>'.strtoupper($device_velocity1).'</td>
				</tr>
				<tr>  				
					<td>(c) Static pressure at inlet </td>
					<td>'.strtoupper($device_pressure1).'</td>
				</tr>
				<tr>  				
					<td>(d) Velocity at outlet </td>
					<td>'.strtoupper($device_velocity2).'</td>
				</tr>
				<tr>  				
					<td>(e) Static pressure at outlet </td>
					<td>'.strtoupper($device_pressure2).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">6. Fan : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">(a) Type used </td>
					<td>'.strtoupper($fan_type).'</td>
				</tr>
				<tr>  				
					<td>(b) Volume handled </td>
					<td>'.strtoupper($fan_volume).'</td>
				</tr>
				<tr>  				
					<td>(c) Static pressure </td>
					<td>'.strtoupper($fan_pressure).'</td>
				</tr>
				<tr>  				
					<td>(d) Pressure drop at outlet of fan </td>
					<td>'.strtoupper($fan_drop).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">7. Fan Motor : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">(a) Type </td>
					<td>'.strtoupper($motor_type).'</td>
				</tr>
				<tr>  				
					<td>(b) Speed and horse power </td>
					<td>'.strtoupper($motor_speed).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>  				
		<td>8. Particulars of defects, if any, disclosed during test in any of the above components </td>
		<td>'.strtoupper($defects).'</td>
	</tr>
	<tr>
		<td colspan="2">I, certify that on '.strtoupper($certify_dt).' the above dust extraction system was thoroughly cleaned and (so far as its construction permits) make accessible for thorough examination. I further certify that on the said date, I thoroughly examined the above dust extraction system including its components and fittings and that the above is a true report of my examination.</td>
	</tr>
	<tr>
		<td colspan="2">9. If employed by a Company or Association, give name and address : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Name </td>
					<td>'.strtoupper($employ_name).'</td>
				</tr>
				<tr>
					<td>Address </td>
					<td>'.strtoupper($employ_add).'</td>
				</tr>
			</table>
		</td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($sign).'</strong><br/>Qualification : <strong>'.strtoupper($qual).'</strong><br/>Address : <strong>'.strtoupper($address).'</strong><br/></td>		
	</tr>
</table>';
?>