<?php
$dept="pcb";
$form="62";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
}

if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$trader_name=$results['trader_name'];$tin_num=$results['tin_num'];$waste_desc=$results['waste_desc'];$waste_qty=$results['waste_qty'];$storage=$results['storage'];
		
	if(!empty($results["address"])){
		$address=json_decode($results["address"]);
		$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vill=$address->vill;$address_dist=$address->dist;$address_pin=$address->pin;$address_mobile=$address->mobile;$address_tel=$address->tel;$address_fax=$address->fax;$address_email=$address->email;
	}else{				
		$address_sn1="";$address_sn2="";$address_vill="";$address_dist="";$address_pin="";$address_mobile="";$address_tel="";$address_fax="";$address_email="";
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
		<td width="50%">1. Name of trader</td>
		<td>'.strtoupper($trader_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Address of trader : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($address_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($address_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($address_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($address_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($address_pin).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($address_mobile).'</td>
			</tr>
			<tr>
				<td>Telephone No. </td>
				<td>'.strtoupper($address_tel).'</td>
			</tr>
			<tr>
				<td>Fax No. </td>
				<td>'.strtoupper($address_fax).'</td>
			</tr>
			<tr>
				<td>Email </td>
				<td>'.strtoupper($address_email).'</td>
			</tr>
		</table>
		</td>
	</tr>	
	<tr>  				
		<td>3. TIN/VAT Number/Import/ Export Code</td>
		<td>'.strtoupper($tin_num).'</td>
	</tr>
	<tr>  				
		<td>4. Description and quantity of other waste to be imported</td>
		<td><b>Description : </b>&nbsp;'.strtoupper($waste_desc).'<br/><b>Quantity : </b>&nbsp;'.strtoupper($waste_qty).'</td>
	</tr>
	<tr>  				
		<td>5. Details of storage, if any</td>
		<td>'.strtoupper($storage).'</td>
	</tr>
	<tr>  				
		<td>6. Name of authorised actual user </td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td colspan="2">Address of authorised actual user :</td>
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
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature of the authorized person : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>