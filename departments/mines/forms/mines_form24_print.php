<?php
$dept="mines";
$form="24";
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
	$regn_no=$results["regn_no"];$date_of_regn=$results["date_of_regn"];
	$name_of_minerals=$results["name_of_minerals"];$name_of_plant=$results["name_of_plant"];
	
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);
		$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
	}else{				
		$period_from_dt="";$period_to_dt="";
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
		<td width="50%">1. Name of the Dealer :</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Full Address :</td>
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
		<td>3. Registration No. and date of registration :</td>
		<td>Number : '.strtoupper($regn_no). '<br/>Date :  '.strtoupper($date_of_regn).'</td>
	</tr>
	<tr>  				
		<td>4. Period of validity of registration :</td>
		<td>'.strtoupper($period_from_dt). ' To ' .strtoupper($period_to_dt).'</td>
	</tr>
	<tr>  				
		<td>5. Name of mineral/ ore:</td>
		<td>'.strtoupper($name_of_minerals).'</td>		
	</tr>
	<tr>  				
		<td>6.Name of plant/ factory:</td>
		<td>'.strtoupper($name_of_plant).'</td>		
	</tr>
	<tr>
		<td colspan="2">7. Postal address of the factory :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($b_street_name1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($b_street_name2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($b_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($b_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($b_pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($b_mobile_no).'</td>
			</tr>
		</table>
		</td>
	</tr>	
	<tr>
		<td colspan="2">8.Name of district where the factory is located :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
			<tr>
				<th width="4%">Sl. No.</th>
				<th width="15%">Name of months/year</th>
				<th width="10%">Date</th>
				<th width="10%">Opening balance of mineral/ ore at the plant/ crude beneficiated</th>
				<th width="10%">Quantity of mineral/ ore received a plant</th>
				<th width="10%">Quantity of ore/ mineral fed to the beneficiation plant</th>
				<th width="10%">Quantity of ore/ mineral recovered after beneficiation</th>
				<th width="10%">Closing balance of ore/ mineral at the plant crude beneficiated</th>
				<th width="15%">Remarks</th>													
			</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				$sl=1;
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["date"]).'</td>
						<td>'.strtoupper($row_1["balance"]).'</td>
						<td>'.strtoupper($row_1["mineral"]).'</td>
						<td>'.strtoupper($row_1["ore"]).'</td>
						<td>'.strtoupper($row_1["quantity"]).'</td>
						<td>'.strtoupper($row_1["closing"]).'</td>
						<td>'.strtoupper($row_1["remarks"]).'</td>
					</tr>';
					$sl++;
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		</td>
	</tr>';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td colspan="2" align="right">Signature of the licensee : <strong>'.strtoupper($key_person).'</strong><br/>	
		Date of submission of the return : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>				
	</tr>	
</table>';
?>