<?php
$dept="factory";
$form="11";
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
	$occupier_name=$results['occupier_name'];$situation=$results['situation'];$nature=$results['nature'];$is_expose=$results['is_expose'];$inaccessible=$results['inaccessible'];$exam=$results['exam'];$is_provided=$results['is_provided'];$is_maintain=$results['is_maintain'];$working_pressure=$results['working_pressure'];$certify=$results['certify'];$sign=$results['sign'];$qual=$results['qual'];$address=$results['address'];

	if(!empty($results["vessel"])){
		$vessel=json_decode($results["vessel"]);
		$vessel_name=$vessel->name;$vessel_desc=$vessel->desc;$vessel_no=$vessel->no;
	}else{
		$vessel_name="";$vessel_desc="";$vessel_no="";
	}
	if(!empty($results["manuf"])){
		$manuf=json_decode($results["manuf"]);
		$manuf_name=$manuf->name;$manuf_sn1=$manuf->sn1;$manuf_sn2=$manuf->sn2;$manuf_vill=$manuf->vill;$manuf_dist=$manuf->dist;$manuf_pin=$manuf->pin;$manuf_mobile=$manuf->mobile;
	}else{
		$manuf_name="";$manuf_sn1="";$manuf_sn2="";$manuf_vill="";$manuf_dist="";$manuf_pin="";$manuf_mobile="";
	}
	if(!empty($results["particulars"])){
		$particulars=json_decode($results["particulars"]);			
		$particulars_const=$particulars->const;$particulars_walls=$particulars->walls;$particulars_use=$particulars->use;$particulars_pressure=$particulars->pressure;
	}else{
		$particulars_const="";$particulars_walls="";$particulars_use="";$particulars_pressure="";
	}
	if(!empty($results["test"])){
		$test=json_decode($results["test"]);
		$test_dt=$test->dt;$test_pressure=$test->pressure;
	}else{
		$test_dt="";$test_pressure="";
	}
	if(!empty($results["conditions"])){
		$conditions=json_decode($results["conditions"]);
		$conditions_external=$conditions->external;$conditions_internal=$conditions->internal;
	}else{
		$conditions_external="";$conditions_internal="";
	}
	if(!empty($results["safe"])){
		$safe=json_decode($results["safe"]);
		$safe_repair=$safe->repair;$safe_period=$safe->period;$safe_condition=$safe->condition;
	}else{
		$safe_repair="";$safe_period="";$safe_condition="";
	}
	if(!empty($results["pressure"])){
		$pressure=json_decode($results["pressure"]);
		$pressure_before=$pressure->before;$pressure_after=$pressure->after;$pressure_complete=$pressure->complete;
	}else{
		$pressure_before="";$pressure_after="";$pressure_complete="";
	}
	if(!empty($results["employ"])){
		$employ=json_decode($results["employ"]);
		$employ_name=$employ->name;$employ_add=$employ->add;
	}else{
		$employ_name="";$employ_add="";
	}
	
	if($is_expose=="O") $is_expose="In Open";
	else if($is_expose=="W") $is_expose="Exposed to Weather";
	else if($is_expose=="D") $is_expose="Exposed to Damp";
	if($is_provided=="Y") $is_provided="Yes";
	else $is_provided="No";
	if($is_maintain=="Y") $is_maintain="Yes";
	else $is_maintain="No";
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
		<td width="50%">1. Name of occupier (or Factory) </td>
		<td>'.strtoupper($occupier_name).'</td>
	</tr>
	<tr>
		<td>2. Situation of factory </td>
		<td>'.strtoupper($situation).'</td>
	</tr>
	<tr>
		<td>3. Address of the Factory </td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>
		<td>4. Name of pressure vessel </td>
		<td>'.strtoupper($vessel_name).'</td>
	</tr>
	<tr>
		<td>5. Description of pressure vessel </td>
		<td>'.strtoupper($vessel_desc).'</td>
	</tr>
	<tr>
		<td>6. Distinctive number of pressure vessel </td>
		<td>'.strtoupper($vessel_no).'</td>
	</tr>
	<tr>
		<td>7. Name of Manufacturer </td>
		<td>'.strtoupper($manuf_name).'</td>
	</tr>
	<tr>
		<td colspan="2">8. Address of Manufacturer : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Street name 1 </td>
					<td>'.strtoupper($manuf_sn1).'</td>
				</tr>
				<tr>
					<td>Street name 2 </td>
					<td>'.strtoupper($manuf_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town </td>
					<td>'.strtoupper($manuf_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($manuf_dist).'</td>
				</tr>
				<tr>
					<td>Pin Code </td>
					<td>'.strtoupper($manuf_pin).'</td>
				</tr>
				<tr>
					<td>Mobile No. </td>
					<td>+91 - '.strtoupper($manuf_mobile).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>9. Nature of process in which it is used </td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>
		<td colspan="2">10. Particulars of vessel : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">(a) Date of construction </td>
					<td>'.strtoupper($particulars_const).'</td>
				</tr>
				<tr>
					<td>(b) Thickness of walls </td>
					<td>'.strtoupper($particulars_walls).'</td>
				</tr>
				<tr>
					<td>(c) Date on which the vessel was first taken into use </td>
					<td>'.strtoupper($particulars_use).'</td>
				</tr>
				<tr>
					<td>(d) Safe working pressure recommended by the manufacturer (The history should be briefly given, and the examiner should state whether he has seen the last/previous report) </td>
					<td>'.strtoupper($particulars_pressure).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>11. Date of last hydraulic test (if any) and pressure applied </td>
		<td>Date : '.strtoupper($test_dt).'<br/>Pressure : '.strtoupper($test_pressure).'</td>
	</tr>
	<tr>
		<td>12. Is the vessel in open, or otherwise exposed to weather or to damp ? </td>
		<td>'.strtoupper($is_expose).'</td>
	</tr>
	<tr>
		<td>13. What parts (if any) were inaccessible? </td>
		<td>'.strtoupper($inaccessible).'</td>
	</tr>
	<tr>
		<td>14. What examination and tests were made? (Specify pressure if hydraulic test was carried out)</td>
		<td>'.strtoupper($exam).'</td>
	</tr>
	<tr>
		<td>15. Condition of vessel (State any defects materially) affecting the safe working pressure or the safe working of the vessel) </td>
		<td>External : '.strtoupper($conditions_external).'<br/>Internal : '.strtoupper($conditions_internal).'</td>
	</tr>
	<tr>
		<td>16. Are the required fittings and appliance provided in accordance with the rules for pressure vessels ? </td>
		<td>'.strtoupper($is_provided).'</td>
	</tr>
	<tr>
		<td>17. Are all fittings and appliances properly maintained and in good conditions ? </td>
		<td>'.strtoupper($is_maintain).'</td>
	</tr>
	<tr>
		<td>18. Repairs (if any) required, and period within which they should be executed and other condition which the person making the examination thinks it necessary to specify for securing safe working : </td>
		<td>Repairs : '.strtoupper($safe_repair).'<br/>Period : '.strtoupper($safe_period).'<br/>Other condition : '.strtoupper($safe_condition).'</td>
	</tr>
	<tr>
		<td>19. Safe working pressure, calculated from dimensions and from the thickness and other data ascertained by the present examination, due allowance being made for conditions of working if unusual on exceptionally severe (State minimum thickness of walls measured during the examination) </td>
		<td>'.strtoupper($working_pressure).'</td>
	</tr>
	<tr>
		<td colspan="2">20. Where repairs affecting the safe working pressure are required, state the working pressure : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">(a) Before the expiration of the period specified in (18) </td>
					<td>'.strtoupper($pressure_before).'</td>
				</tr>
				<tr>
					<td>(b) After the expiration of such period if the required repairs have not been completed </td>
					<td>'.strtoupper($pressure_after).'</td>
				</tr>
				<tr>
					<td>(c) After the completion of the required repairs </td>
					<td>'.strtoupper($pressure_complete).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">I certify that on &nbsp;'.strtoupper($certify).'&nbsp; the pressure vessel described above was thoroughly cleaned and (so far as its construction permits) made accessible for thorough examination and for such test as were necessary for thorough examination and that on the said date, I thoroughly examined this pressure vessel, including its fittings, and that the above is a true report of my examination. </td>
	</tr>
	<tr>
		<td colspan="2">21. If employed by a Company or Association, give name and address : </td>
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