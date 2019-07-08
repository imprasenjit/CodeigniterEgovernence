<?php
$dept="sdc";
$form="5";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id=form_id");
}

	if($q->num_rows > 0){
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$location=$results["location"];$situated=$results["situated"];$drug_name=$results["drug_name"];$particulars=$results["particulars"];
		if(!empty($results["dealer"])){
			$dealer=json_decode($results["dealer"]);
			$dealer_name=$dealer->name;$dealer_lic_no=$dealer->lic_no;
		}else{				
			$dealer_name="";$dealer_lic_no="";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
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
			<td colspan="2">1.I/We &nbsp;'.strtoupper($auth_person).' &nbsp; of &nbsp;'.strtoupper($unit_name).'&nbsp;&nbsp;hereby apply for a licence sell by retail.</td>
		</tr>
		<tr>
			<td>(i)  Drugs other than those specified in Schedules C, C(1) and X on the premises situated at </td><td>'.strtoupper($location).' &nbsp; </td>
		</tr>
		<tr>
			<td>(ii)  Drugs specified in [Schedule C(1)] on the situated at </td><td>'.strtoupper($situated).' &nbsp; </td>
		</tr>
		<tr>
			<td colspan="2">2. Sales shall be restricted to such drugs as can be sold without the supervision of a qualified person under the Drugs and Cosmetics. </td>
		</tr>
		<tr>
			<td width="50%">3. Names or classes of drugs proposed to be sold.:</td>
			<td width="50%">'.strtoupper($drug_name).'</td>
		</tr>	
		<tr>
			<td>4. Particulars of the storage accomodation for the storage of [Schedule C(1)] drugs on the premises referred to above. :</td>
			<td>'.strtoupper($particulars).'</td>
		</tr>			
		<tr>
			<td>5. The drugs for sale will be purchased from the following dealers and such other dealers as may be endorsed on the license by the licensing authority from time to time.</td>
			<td>Name of the dealers  :	'.strtoupper($dealer_name).'<br/>
			Licence No. :	'.strtoupper($dealer_lic_no).'<br/>
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
			
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>

