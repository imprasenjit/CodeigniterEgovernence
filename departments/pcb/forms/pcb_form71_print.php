<?php
$dept="pcb";
$form="71";
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
	$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$ewaste_details=$results['ewaste_details'];$safety=$results['safety'];$facilities=$results['facilities'];
	
	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
	}else{				
		$contact_desgn="";$contact_tel="";
	}	
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_generate=$waste->generate;$waste_dispose=$waste->dispose;$waste_treat=$waste->treat;
	}else{
		$waste_generate="";$waste_dispose="";$waste_treat="";
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
		<td width="50%">1. Name of Unit </td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Address of Unit :</td>
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
		<td colspan="2">3. Details of Contact Person :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Designation</td>
				<td>'.strtoupper($contact_desgn).'</td>
			</tr>
			<tr>
				<td>Telephone No.</td>
				<td>'.strtoupper($contact_tel).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>4. Date of Commissioning </td>
		<td>'.strtoupper($comm_date).'</td>
	</tr>
	<tr>
		<td>5. No.of workers (including contract labour) </td>
		<td>'.strtoupper($no_of_workers).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Consents Validity : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Water (Prevention and Control of Pollution) Act, 1974; Valid up to</td>
				<td>'.strtoupper($water_valid).'</td>
			</tr>
			<tr>
				<td>(b) Air (Prevention and Control of Pollution) Act, 1981; Valid up to</td>
				<td>'.strtoupper($air_valid).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>7. Validity of current authorisation if any </td>
		<td><b>E-waste (Management & Handling) Rules, 2011; Valid up to :</b> '.strtoupper($auth_valid).'</td>
	</tr>
	<tr>
		<td>8. Dismantling or Recycling Process </td>
		<td>Attach complete details in upload section</td>
	</tr>
	<tr>
    	<td>9. Installed capacity in MT/year : </td>
		<td>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Products</th>
					<th>Installed capacity (MTA)</th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["products"]).'</td>
						<td>'.strtoupper($row_1["capacity"]).'</td>
					</tr>';
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
	</tr>
	<tr>
    	<td>10. E-waste processed during last three years : </td>
		<td>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Year</th>
					<th>Product</th>
					<th>Quantity</th>
				</tr>
			</thead>';
			$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
			$num2 = $part2->num_rows;
			if($num2>0){
				while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["sl_no"]).'</td>
						<td>'.strtoupper($row_2["year"]).'</td>
						<td>'.strtoupper($row_2["product"]).'</td>
						<td>'.strtoupper($row_2["qty"]).'</td>
					</tr>';
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
	</tr>
	<tr>  				
		<td colspan="2">11. Waste Management : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Waste generation in processing e-waste</td>
				<td>'.strtoupper($waste_generate).'</td>
			</tr>
			<tr>
				<td>(b) Provide details of disposal of residue</td>
				<td>'.strtoupper($waste_dispose).'</td>
			</tr>
			<tr>
				<td>(c) Name of Treatment Storage and Disposal Facility utilized for</td>
				<td>'.strtoupper($waste_treat).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>12. Details of e-waste proposed to be procured from re-processing (Please provide details) </td>
		<td>'.strtoupper($ewaste_details).'</td>
	</tr>
	<tr>
		<td>13. Occupational safety and health aspects (Please provide details) </td>
		<td>'.strtoupper($safety).'</td>
	</tr>
	<tr>
		<td>14. Details of Facilities for dismantling both manual as well as mechanised </td>
		<td>'.strtoupper($facilities).'</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td colspan="2" align="right"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
	</tr>
</table>';
?>