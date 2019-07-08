<?php
$dept="mines";
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
	$father_name=$results["father_name"];$partner_name=$results["partner_name"];$partner_add=$results["partner_add"];$place_of_business=$results["place_of_business"];$financial_status=$results["financial_status"];$purpose=$results["purpose"];$mineral_name=$results["mineral_name"];$procured_name=$results["procured_name"];$procured_add=$results["procured_add"];$reg_no=$results["reg_no"];$reg_date=$results["reg_date"];
			
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);
		$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
	}else{				
		$period_from_dt="";$period_to_dt="";
	}	
	
	if($purpose=="P") $purpose="Processing";
	else if($purpose=="S") $purpose="Storing";
	else if($purpose=="SE") $purpose="Selling";
	else if($purpose=="T") $purpose="Trading";
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
		<td width="50%">1. Name of applicant (in full) :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>  				
		<td>2. Profession :</td>
		<td>'.strtoupper($status_applicant).'</td>
	</tr>
	<tr>
		<td colspan="2">3. Full Address :</td>
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
	</tr>
	<tr>
		<td>4. Father`s name (in full) :</td>
		<td>'.strtoupper($father_name).'  </td>
	</tr>
	<tr>
		<td colspan="2">a) In case of firm, give name and address of partners and person holding powers of attorney to act on behalf of the firm : </td>
	</tr>
	<tr>
		<td>Name :</td>
		<td>'.strtoupper($partner_name).'</td>
	</tr>
	<tr>
		<td>Address : </td>
		<td>'.strtoupper($partner_add).' </td>
	</tr>
	<tr>
		<td>5. Specific place or places of business : </td>
		<td >'.strtoupper($place_of_business).'</td>
	</tr>
	<tr>
		<td>6. Financial status with details of person (i.e. property annual payment of Income Tax and any other relevant evidence regarding financial status) :</td>
		<td >'.strtoupper($financial_status).'</td>
	</tr>							
	<tr>
		<td>7. Specific purpose for which Registration is applied for (Processing/ Storing/ Selling/ Trading) : </td>
		<td>'.strtoupper($purpose).'</td>
	</tr> 							
	<tr>
		<td>8. Name of mineral/ Ore for which registration is required : </td>	
		<td>'.strtoupper($mineral_name).'</td>
	</tr>  
	<tr>
		<td colspan="2">9. Name and address of person/ firm from whom the mineral/ ore will be purchased/ procured :</td>
	</tr>
	<tr>
		<td>Name :</td>
		<td>'.strtoupper($procured_name).'</td>
	</tr>
	<tr>
		<td>Address : </td>
		<td>'.strtoupper($procured_add).' </td>
	</tr>	
	<tr>
		<td>10. Period for which registration is required : </td>	
		<td>'.strtoupper($period_from_dt).' To '.strtoupper($period_to_dt).'</td>
	</tr>
	<tr>
		<td>11. In case of renewal, the number and date of original registration :</td>
		<td><b>Number : </b>'.strtoupper($reg_no).', <br/><b>Date : </b>'.strtoupper($reg_date).' </td>
	</tr>
	';			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td colspan="2" align="center"><strong> DECLARATION </strong></td>
	</tr>		
	<tr>
		<td colspan="2">I/We hereby declare that I/ we have read and understood all the provisions of the "The Assam Mineral Dealer`s Rule, 2017" made there under and the conditions of the registrations and I/ we agree to abide by the same.</td>
	</tr>	
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		<td align="center">Signature of Applicant : &nbsp;<strong>'.strtoupper($key_person).'</strong></td>				
	</tr>		
</table>';
?>