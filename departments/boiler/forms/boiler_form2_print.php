<?php
$dept="boiler";
$form="2";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
}

	
	if($q->num_rows>0)
	{					
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$boiler_location=$results['boiler_location'];$reg_no=$results['reg_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$heating_value=$results['heating_value'];$safety_valves=$results['safety_valves'];$caliberation_date =$results['caliberation_date'];$boiler_interior  =$results['boiler_interior'];$boiler_engr_name  =$results['boiler_engr_name'];$certificate_no=$results['certificate_no'];$tentative_date=$results['tentative_date'];
		
		if(!empty($results["boiler_type"])){
			$boiler_type=json_decode($results["boiler_type"]);
		if(isset($boiler_type->a)) $boiler_type_a=$boiler_type->a;
		else $boiler_type_a="";
		if(isset($boiler_type->b)) $boiler_type_b=$boiler_type->b;
		else $boiler_type_b="";
		if($boiler_type_a=="U") $boiler_type_b="WT";
		}else{
			$boiler_type_a="";$boiler_type_b="";
		}	
			
		$boiler_location = wordwrap($results["boiler_location"], 40, "<br/>", true);

		if($boiler_type_a=="U") $boiler_type_a="UNFIRED";
		else $boiler_type_a="FIRED";
		if($boiler_type_b=="FT") $boiler_type_b="FIRE TUBE";
		else $boiler_type_b="WATER TUBE";
	}
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form '.$form.'</title>
	<style>
	input, textarea { 
	text-transform: uppercase;
	}
	.header{
	width: 100%;
	height: 130px;
	font-weight: bold;
	}
	.main_body {
	height: 700px;
	width: 100%;
	}
	#form1 table {
	vertical-align: middle;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';       
	}else{
    $printContents='';
	}	
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
	   <tr>
		  <td colspan="2">
			  <p>   TO</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;THE CHIEF INSPECTOR OF BOILERS, ASSAM,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LALMATI, GUWAHATI-29</p><p>&nbsp;</p>
			</td>
		</tr>
		<tr>
			<td width="50%">1. (a) Name of boiler owner :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td> &nbsp;&nbsp;&nbsp;(b) Address of boiler owner :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pin Code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail Id </td>
						<td>'.($b_email).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Location of the boiler :<br/> whether boiler is installed </td>
			<td>'.strtoupper($boiler_location).'</td>
		</tr>
		<tr>
			<td>3.Registration No. of the boiler :</td>
			<td>'.strtoupper($reg_no).'</td>
		</tr>
		<tr>
			<td>4. Name of the manufacturer :</td>
			<td>'.strtoupper($manu_name).'</td>
		</tr> 
		<tr>
			<td>5. Year of manufacture :</td>
			<td>'.strtoupper($manu_year).'</td>
		</tr>
		<tr>
			<td>6. Type of the boiler :</td>
			<td>'.strtoupper($boiler_type_a).' AND '.strtoupper($boiler_type_b).'</td>
		</tr>
		<tr>
			<td>7. Heating surface of the Boiler (in Sq. Meter) :</td>
			<td>'.strtoupper($heating_value).'</td>
		</tr>
		<tr>
			<td>8. Whether safety valves works efficiently :</td>
			<td>'.strtoupper($safety_valves).'</td>
		</tr>
		<tr>
			<td>9. Date of caliberation of pressure gauge :</td>
			<td>'.strtoupper($caliberation_date).'</td>
		</tr>
		<tr>
			<td>10. Whether boiler interior cleaned properly :</td>
			<td>'.strtoupper($boiler_interior).'</td>
		</tr>
		<tr>
			<td>11. Name of the boiler attendant/boiler operation engineer and their certificate number:</td>
			<td>
				Full name :'.strtoupper($boiler_engr_name).' <br/>
				Certificate No:'.strtoupper($certificate_no).'
			</td>
		</tr>
		<tr>
			<td>12. Tentative date of inspection :</td>
			<td>'.strtoupper($tentative_date).'</td>
		</tr>';

		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
			<td rowspan="2"> Signature and Date : </td>
			<td>Authorised Signatory : '.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>Date : '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
		</tr>
	</table>	
';
?>