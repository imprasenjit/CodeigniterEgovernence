<?php
$dept="boiler";
$form="1";
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
	
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$boiler_location=$results['boiler_location'];$maker_no=$results['maker_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$heating_value=$results['heating_value'];$offering_insp_date=$results['offering_insp_date'];$is_fabrication=$results['is_fabrication'];
		$heating_value_limit="";
		
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
		if($results["is_fabrication"]=="Y"){
			$is_fabrication="YES";
		}else{
			$is_fabrication="NO";
		}
		
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
                <p>TO</p>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;THE CHIEF INSPECTOR OF BOILERS, ASSAM,<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LALMATI, GUWAHATI-29<br/><br/></p>
			</td>
		</tr>
		<tr>
			<td width="50%">1. (a) Name of boiler owner :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td>(b) Address of boiler owner :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 :</td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 :</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town :</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District :</td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pin Code :</td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No :</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Email Id :</td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>2. Location of the boiler: <br> (Whether Boiler to be installed ) </td>
				<td>'.strtoupper($boiler_location).'</td>
		</tr>

		<tr>
				<td>3. Maker&apos;s No. of the boiler :</td>
				<td>'.strtoupper($maker_no).'</td>
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
				<td>8. Fabrication at site is required ?</td>
				<td>'.strtoupper($is_fabrication).'</td>
		</tr>
		<tr>
				<td>9. Tentative date of offering inspection :</td>
				<td>'.strtoupper($offering_insp_date).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Authorised Signatory              
               </td>
        </tr>        
	</table>
	';
?>