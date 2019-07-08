<?php
$dept="pcb";
$form="78";
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
	// Tab 1 //
	$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$capacity=$results['capacity'];$water_cess=$results['water_cess'];

	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_name=$contact->name;$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
	}else{				
		$contact_name="";$contact_desgn="";$contact_tel="";
	}	
	
	if(!empty($results["water_consume"])){
		$water_consume=json_decode($results["water_consume"]);
		$water_consume_indus=$water_consume->indus;$water_consume_dom=$water_consume->dom;
	}else{				
		$water_consume_indus="";$water_consume_dom="";
	}
	
	if(!empty($results["water_gen"])){
		$water_gen=json_decode($results["water_gen"]);
		$water_gen_indus=$water_gen->indus;$water_gen_dom=$water_gen->dom;$water_gen_indus2=$water_gen->indus2;$water_gen_dom2=$water_gen->dom2;
	}else{				
		$water_gen_indus="";$water_gen_dom="";$water_gen_indus2="";$water_gen_dom2="";
	}
	
	// Tab 2 //
	$air_facilities=$results['air_facilities'];
	if(!empty($results["water_treat"])){
		$water_treat=json_decode($results["water_treat"]);
		$water_treat_indus=$water_treat->indus;$water_treat_dom=$water_treat->dom;
	}else{				
		$water_treat_indus="";$water_treat_dom="";
	}
	
	if(!empty($results["discharge"])){
		$discharge=json_decode($results["discharge"]);
		$discharge_qty=$discharge->qty;$discharge_loc=$discharge->loc;$discharge_analysis=$discharge->analysis;
	}else{				
		$discharge_qty="";$discharge_loc="";$discharge_analysis="";
	}
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_collect=$waste->collect;$waste_dispose=$waste->dispose;$waste_facility=$waste->facility;
	}else{				
		$waste_collect="";$waste_dispose="";$waste_facility="";
	}
	
	if($waste_facility=="Y") $waste_facility="Yes";
	else $waste_facility="No";
	
	// Tab 3 //
	$occ_safety=$results['occ_safety'];$is_pollution=$results['is_pollution'];$is_pollution_details=$results['is_pollution_details'];$is_compliance=$results['is_compliance'];$is_operation=$results['is_operation'];$is_conditions=$results['is_conditions'];$is_leachate=$results['is_leachate'];$info=$results['info'];
	
	if(!empty($results["auction"])){
		$auction=json_decode($results["auction"]);
		$auction_name=$auction->name;$auction_qty=$auction->qty;$auction_position=$auction->position;$auction_nature=$auction->nature;
	}else{				
		$auction_name="";$auction_qty="";$auction_position="";$auction_nature="";
	}
	
	if(!empty($results["cost"])){
		$cost=json_decode($results["cost"]);
		$cost_unit=$cost->unit;$cost_capital=$cost->capital;$cost_recurring=$cost->recurring;
	}else{				
		$cost_unit="";$cost_capital="";$cost_recurring="";
	}	
	
	if($is_pollution=="Y") $is_pollution="Yes";
	else $is_pollution="No";
	if($is_compliance=="Y") $is_compliance="Yes";
	else $is_compliance="No";	
	if($is_operation=="Y") $is_operation="Yes";
	else $is_operation="No";
	if($is_conditions=="Y") $is_conditions="Yes";
	else $is_conditions="No";
	if($is_leachate=="Y") $is_leachate="Yes";
	else $is_leachate="No";
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
		<td width="50%">1. Name of Unit</td>
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
		<td colspan="2">3. Name and details of Contact Person :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Name</td>
				<td>'.strtoupper($contact_name).'</td>
			</tr>
			<tr>
				<td>Designation</td>
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
				<td width="50%">(a) Under Air Act, 1981; Valid up to</td>
				<td>'.strtoupper($air_valid).'</td>
			</tr>
			<tr>
				<td>(b) Under Water Act, 1974; Valid up to</td>
				<td>'.strtoupper($water_valid).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>7. Validity of Authorization under rule 5 of the Hazardous Wastes (Management and Handling Rules, 1989) Valid up to</td>
		<td>'.strtoupper($auth_valid).'</td>
	</tr>
	<tr>
		<td>8. Installed capacity of the production in (MTA) </td>
		<td>'.strtoupper($capacity).'</td>
	</tr>
	<tr>
		<td colspan="2">9. Products Manufactured (Tones/years) during the last three years : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of Product Manufactured </th>
					<th>Year-1</th>
					<th>Year-2</th>
					<th>Year-3</th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["year1"]).'</td>
						<td>'.strtoupper($row_1["year2"]).'</td>
						<td>'.strtoupper($row_1["year3"]).'</td>
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
		<td colspan="2">10. Raw material consumed (Tones/year) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of Raw material consumed </th>
					<th>Year-1</th>
					<th>Year-2</th>
					<th>Year-3</th>
				</tr>
			</thead>';
			$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
			$num2 = $part2->num_rows;
			if($num2>0){
				while($row_1=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["year1"]).'</td>
						<td>'.strtoupper($row_1["year2"]).'</td>
						<td>'.strtoupper($row_1["year3"]).'</td>
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
		<td>11. Manufacturing Process </td>
		<td>Please attach manufacturing process flow diagram for each product(s)</td>
	</tr>
	<tr>
		<td>12. Water Consumption :</td>
		<td><b>Industrial : </b>'.strtoupper($water_consume_indus).'<br/><b>Domestic : </b>'.strtoupper($water_consume_dom).'</td>
	</tr>
	<tr>
		<td>13. Water Cess paid up to </td>
		<td>'.strtoupper($water_cess).'</td>
	</tr>
	<tr>
		<td colspan="2">14. Waste Water generation : </td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) as per consent m3/day) </td>
				<td><b>Industrial : </b>'.strtoupper($water_gen_indus).'<br/><b>Domestic : </b>'.strtoupper($water_gen_dom).'</td>
			</tr>
			<tr>
				<td>(b) actual m3/day (average of last three months) </td>
				<td><b>Industrial : </b>'.strtoupper($water_gen_indus2).'<br/><b>Domestic : </b>'.strtoupper($water_gen_dom2).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>15. Waste water treatment (Please attach flow diagram of the treatment scheme) :</td>
		<td><b>Industrial : </b>'.strtoupper($water_treat_indus).'<br/><b>Domestic : </b>'.strtoupper($water_treat_dom).'</td>
	</tr>	
	<tr>
		<td colspan="2">16. Waste water discharge :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Quantity (m3/day) </td>
				<td>'.strtoupper($discharge_qty).'</td>
			</tr>
			<tr>
				<td>Location </td>
				<td>'.strtoupper($discharge_loc).'</td>
			</tr>
			<tr>
				<td>Analysis of treated waste water (pH, BOD, COD, SS, O&G, Any other) Also, indicate the corresponding standards applicable </td>
				<td>'.strtoupper($discharge_analysis).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">17. Air Pollution Control : </td>
	</tr>	
	<tr>
		<td>(a) Details of facilities provided for control of fugitives emission due to material handling, process, utilities etc.</td>
		<td>'.strtoupper($air_facilities).'</td>
	</tr>
	<tr>
		<td>(b) Fuel Consumption :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of the fuel</th>
					<th>Quantity/day</th>
				</tr>
			</thead>';
			$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
			$num3 = $part3->num_rows;
			if($num3>0){
				while($row_1=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["qty"]).'</td>
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
		<td>(c) Stack emission monitoring results vis-a-vis the standards applicable :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Stack attached to</th>
					<th>Emission g/Nm3</th>
				</tr>
			</thead>';
			$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
			$num4 = $part4->num_rows;
			if($num4>0){
				while($row_1=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["stack"]).'</td>
						<td>'.strtoupper($row_1["emission"]).'</td>
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
		<td>(d) Ambient air quality :</td>
		<td>
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Location</th>
					<th>Result mg/m3</th>
				</tr>
			</thead>';
			$part5=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t5 where form_id='$form_id'");
			$num5 = $part5->num_rows;
			if($num5>0){
				while($row_1=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["loc"]).'</td>
						<td>'.strtoupper($row_1["result"]).'</td>
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
		<td colspan="2">18. Hazardous Waste Management :</td>
	</tr>
	<tr>
		<td colspan="2">(a) Waste generation :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of the Waste</th>
					<th>Process category</th>
					<th>Quantity/Y</th>
				</tr>
			</thead>';
			$part6=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t6 where form_id='$form_id'");
			$num6 = $part6->num_rows;
			if($num6>0){
				while($row_1=$part6->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["category"]).'</td>
						<td>'.strtoupper($row_1["qty"]).'</td>
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
		<td>((b) Details of collection, treatment </td>
		<td>'.strtoupper($waste_collect).'</td>
	</tr>
	<tr>
		<td colspan="2">(c) Disposal (including point of final discharge) :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(i) Details of the disposal facility </td>
				<td>'.strtoupper($waste_dispose).'</td>
			</tr>
			<tr>
				<td>(ii) Whether facilities provided are in compliance of the conditions issued by the SPCB in Authorization ? </td>
				<td>'.strtoupper($waste_facility).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">19. Details of waste proposed to be taken in auction or import, as the case may be for use as raw material :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Name </td>
				<td>'.strtoupper($auction_name).'</td>
			</tr>
			<tr>
				<td>(b) Quantity required</td>
				<td>'.strtoupper($auction_qty).'</td>
			</tr>
			<tr>
				<td>(c) Position in List A/List B as per Basel Convention (BC) </td>
				<td>'.strtoupper($auction_position).'</td>
			</tr>
			<tr>
				<td>(d) Nature as per Annexure III of BC </td>
				<td>'.strtoupper($auction_nature).'</td>
			</tr>
		</table>
		</td>
	</tr>	
	<tr>
		<td>20. Occupational safety and health aspects (Please provide details of facilities provided) </td>
		<td>'.strtoupper($occ_safety).'</td>
	</tr>
	<tr>
		<td colspan="2">21. Remarks :</td>
	</tr>	
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(i) Whether industry has provided adequate pollution control system/equipment to meet the standards of emission/effluent ? (If yes, please furnish details) </td>
				<td>'.strtoupper($is_pollution).'.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($is_pollution_details).'</td>				
			</tr>
			<tr>
				<td>(ii) Whether industry is in compliance with conditions laid down in the Hazardous Waste Authorization ? </td>
				<td>'.strtoupper($is_compliance).'</td>
			</tr>
			<tr>
				<td>(iii) Whether Hazardous Waste collection and Treatment, Storage and Disposal Facility (TSDF) are operating satisfactorily ? </td>
				<td>'.strtoupper($is_operation).'</td>
			</tr>
			<tr>
				<td>(iv) Whether conditions exist or likely to exists of the material being handled/ processed of posing immediate or delayed adverse impacts on the environment ? </td>
				<td>'.strtoupper($is_conditions).'</td>
			</tr>
			<tr>
				<td>(v) Whether conditions exist or is likely to exit of the material being handled/ processed by any means capable of yielding another material e.g. leachate which may6 possess eco-toxicity ? </td>
				<td>'.strtoupper($is_leachate).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>22. (a) Cost of the unit </td>
		<td>'.strtoupper($cost_unit).'</td>
	</tr>
	<tr>
		<td>22. (b) Cost of pollution control equipment including environmental safeguard measures : </td>
		<td><b>(i) Capital : </b>'.strtoupper($cost_capital).'<br/><b>(ii) Recurring : </b>'.strtoupper($cost_recurring).'</td>
	</tr>
	<tr>
		<td>23. Any other information </td>
		<td>'.strtoupper($info).'</td>
	</tr>	
	<tr>
		<td colspan="2">I hereby declare that the above statements/informations are true and correct to the best of my knowledge and belief.</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong><br/>
		(Name : <strong>'.strtoupper($key_person).'</strong>)<br/>
		(Designation : <strong>'.strtoupper($status_applicant).'</strong>)</td>
	</tr>
</table>';
?>