<?php
$dept="forest";
$form="4";
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
		$ref_uain=$results['ref_uain'];
		$permit_no=$results['permit_no'];$permit_date=$results['permit_date'];$locality_whence_collected=$results['locality_whence_collected'];$transported_place=$results['transported_place'];$destination=$results['destination'];$transport_route=$results['transport_route'];$transport_date=$results['transport_date'];$expire_date=$results['expire_date'];
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
		$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
		$printContents=$printContents.'<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
  		</div>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		
		<tr>
			<td>UAIN of the Certificate of Origin</td>
			<td>'.strtoupper($ref_uain).'</td>
		</tr>
		<tr>
			<td valign="top">1. Name and residence of the Passholder </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Name </td>
						<td>'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td>Street Name 1 </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pin Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>Phone Number </td>
						<td>'.strtoupper($b_landline_std).' - '.strtoupper($b_landline_no).'</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">2. Number and date of permit or Certificate of Origin </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Number</td>
						<td>'.strtoupper($permit_no).'</td>
					</tr>
					<tr>
						<td>Date</td>
						<td>'.strtoupper($permit_date).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
				<thead>
					<tr>
						<th width="5%" height="35px" align="center">Sl. No.</th>
						<th width="20%" align="center">Kind of forest produce</th>
						<th width="15%" align="center">Number of pieces packages or bundles</th>
						<th width="15%" align="center">Measurement Cubic consents or weight</th>
						<th width="15%" align="center">Marks hammar or Other</th>
						<th width="15%" align="center">Rate</th>
						<th width="15%" align="center">Amount Paid</th>
						
					</tr>
				</thead>';						
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["forest_produce"]).'</td>
							<td>'.strtoupper($row_1["no_of_pieces"]).'</td>
							<td>'.strtoupper($row_1["measurement"]).'</td>	
							<td>'.strtoupper($row_1["marks_hammar"]).'</td>	
							<td>'.strtoupper($row_1["rate"]).'</td>	
							<td>'.strtoupper($row_1["amt_paid"]).'</td>	
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>					
		</tr>

		<tr>
			<td>3. Locality Whence collected </td>
			<td>'.strtoupper($locality_whence_collected).'</td>
		</tr>
		<tr>
			<td>4. Place From which to be transported</td>
			<td>'.strtoupper($transported_place).'</td>
		</tr>
		<tr>
			<td>5. Destination</td>
			<td>'.strtoupper($destination).'</td>
		</tr>
		<tr>
			<td>6. Route Of Transport</td>
			<td>'.strtoupper($transport_route).'</td>
		</tr>
		<tr>
			<td>7. Date of transportation</td>
			<td>'.strtoupper($transport_date).'</td>
		</tr>
		<tr>
			<td>8. Date of Expiry</td>
			<td>'.strtoupper($expire_date).'</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
						
		<tr>
			<td valign="top"><strong>Signature of the Passholder with Date:</strong></td>				
			<td>Signature of the Passholder : &nbsp;  <strong>'.strtoupper($key_person).'</strong><br/>					
				Date : &nbsp;<strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
		</tr>		
	</table>';
?>