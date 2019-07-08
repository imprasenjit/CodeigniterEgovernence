<?php 
$dept="dic";
$form="1";
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
		$nature=$results['nature'];$ancillary=$results['ancillary'];$installation_date=$results['installation_date'];$cat_enter=$results['cat_enter'];
		$expect_date=$results['expect_date'];
		if($expect_date!="" && $expect_date!="0000-00-00"){
			$expect_date = date('d-m-Y',strtotime($expect_date));
		}else{
			$expect_date="";
		}
		
		
		if(!empty($results["manuf"])){
			$manuf=json_decode($results["manuf"]);
			$manuf_code=$manuf->code;$manuf_name=$manuf->name;
		}else{
			$manuf_code="";$manuf_name="";
		}
		if(!empty($results["fixed_asset"]))
		{
			$fixed_asset=json_decode($results["fixed_asset"]);
			$fixed_asset_plant_approx=$fixed_asset->plant_approx;$fixed_asset_building=$fixed_asset->building;$fixed_asset_building_approx=$fixed_asset->building_approx;$fixed_asset_land=$fixed_asset->land;$fixed_asset_land_approx=$fixed_asset->land_approx;
			$fixed_asset_equity_approx=$fixed_asset->equity_approx;$fixed_asset_euipment_approx=$fixed_asset->equipment_approx;
		}else{
			$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";	$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
		}
		if(!empty($results["power"]))
		{
			$power=json_decode($results["power"]);
			$power_unit=$power->unit;$power_load=$power->load;
		}else{
			$power_unit="";$power_load="";
		}	
		if(!empty($results["source"])){
			$source=json_decode($results["source"]);
			if(isset($source->a)) $source_a=$source->a; else $source_a="";
			if(isset($source->b)) $source_b=$source->b; else $source_b="";
			if(isset($source->c)) $source_c=$source->c; else $source_c="";
			if(isset($source->d)) $source_d=$source->d; else $source_d="";
			if(isset($source->e)) $source_e=$source->e; else $source_e="";
			if(isset($source->f)) $source_f=$source->f; else $source_f="";
			if(isset($source->g)) $source_g=$source->g; else $source_g="";
			if(isset($source->h)) $source_h=$source->h; else $source_h="";
			if(isset($source->reason)) $source_reason=$source->reason; else $source_reason="";
		}else{
			$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
		}	
		if(!empty($results["expected"])){
			$expected=json_decode($results["expected"]);
			$expected_staff=$expected->staff;$expected_supervisory=$expected->supervisory;$expected_workers=$expected->workers;
		}else{
			$expected_staff="";$expected_supervisory="";$expected_workers="";
		}
	}
	if($fixed_asset_land=="R"){
		$fixed_asset_land="Rented";
	}else if($fixed_asset_land=="L"){
		$fixed_asset_land="Leased";
	}else{
		$fixed_asset_land="Owned";
	}
	
	if($fixed_asset_building=="R"){
		$fixed_asset_building="Rented";
	}else if($fixed_asset_building=="L"){
		$fixed_asset_building="Leased";
	}else{
		$fixed_asset_building="Owned";
	}
	
	if($nature=="P"){
		$nature="Perennial";
	}
	else if($nature=="S"){
		$nature="Seasonal";
	}
	else{
		$nature="Casual";
	}
	
	if($ancillary=="Y"){
		$ancillary="Yes";
	}else{
		$ancillary="No";
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
		$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<div style="text-align:center">
		'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div>
	<table class="table table-bordered table-responsive">
  		<tr>  				
			<td valign="top">1. Name of the Applicant :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">2. a) Address of Communication : </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
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
							<td>Mobile No</td>
							<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">2. b). Permanent Residential Address (Main Applicant) :  </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
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
					
					<tr>
							<td>Email-id</td>
							<td> '.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">3. Name of Proposed Enterprise :</td>
			<td valign="top"> '.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">4. Proposed Location of Enterprise :   </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
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
					
					<tr>
							<td>Email-id</td>
							<td> '.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>5. Nature of Activity : </td>
				<td> '.strtoupper($business_type).'</td>
		</tr>
		<tr>
				<td>6. Nature of Operation : </td>
				<td> '.strtoupper($nature).'</td>
		</tr>
		<tr>
				<td>7. Whether the Unit will be an Ancillary : </td>
				<td> '.strtoupper($ancillary).'</td>
		</tr>
		<tr>
				<td>8. Proposed month & year of installation of plant & machinery : </td>
				<td> '.strtoupper($installation_date).'</td>
		</tr>
		<tr>
				<td>9. Type of Organization : </td>
				<td> '.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>
				<td valign="top">10. (a). Main Manufacturing/Service Activity : </td>
				<td>Name : '.strtoupper($manuf_name).'<br/>
					Code (NIC2004) : '.strtoupper($manuf_code).'
				</td>
		</tr>
		<tr>
				<td colspan="2">10. (b). Products To Be Manufactured/Services To Be Provided : <br/><i>(<font color="red">*</font>) Codes for activities and production/services as per classification specified from time to time by the Development Commissioner (Small Scale Industries), Govt. of India to be filled in by the District Industries Centre or the office where the Entrepreneurs memorandum is subimitted.</i> </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<td align="center">Sl No</td>
						<td width="23%" align="center">Name</td>
						<td width="22%" align="center">Code</td>
						<td width="22%" align="center">Quantity</td>
						<td width="23%" align="center">Unit</td>
					</tr>';
					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr align="center">
								<td align="center">'.strtoupper($row_1["slno"]).'</td>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["code"]).'</td>
								<td>'.strtoupper($row_1["quantity"]).'</td>
								<td>'.strtoupper($row_1["unit"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table> 
			</td>
		</tr>
		<tr>
			<td valign="top">11. Proposed Investment in Fixed Assets [In Rupees]: <br/>(eg. For 2 Lakhs write as 200000 without using any comma) :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>(i) Land : '.strtoupper($fixed_asset_land).'</td>
						<td>Approximate Value : '.strtoupper($fixed_asset_land_approx).'</td>
				</tr>
				<tr>
						<td>(ii) Building  : '.strtoupper($fixed_asset_building).'</td>
						<td>Approximate Value : '.strtoupper($fixed_asset_building_approx).'</td>
				</tr>
				<tr>
						<td>(iii) Plant & Machinery (in case of manufacturing  enterprise) </td>
						<td>'.strtoupper($fixed_asset_plant_approx).'</td>
				</tr>
				<tr>
						<td>(iv) Equipment (in case of services enterprise)</td>
						<td>'.strtoupper($fixed_asset_euipment_approx).'</td>
				</tr>
				<tr>
						<td>(v) Foreign Equity (if any) </td>
						<td>'.strtoupper($fixed_asset_equity_approx).'</td>
				</tr>';
				$printContents=$printContents.'
			</table> 
		</td>
	</tr>
	<tr>
		<td>12. Category of Enterprise :</td>
		<td>'.strtoupper($cat_enter).'</td>
	</tr>
	<tr>
			<td>13. Power Load (Anticipated):</td>
			<td>'.strtoupper($power_load).' '.strtoupper($power_unit).'</td>
	</tr>
	<tr>
			<td valign="top">14.(a) (i). Other Source of Energy/Power (if required):</td>
			<td>
				'.strtoupper($source_a).'<br/>
				'.strtoupper($source_b).'<br/>
				'.strtoupper($source_c).'<br/>
				'.strtoupper($source_d).'<br/>
				'.strtoupper($source_e).'<br/>
				'.strtoupper($source_f).'<br/>
				'.strtoupper($source_g).'<br/>
				'.strtoupper($source_h).'
			</td>
	</tr>
	<tr>
			<td>(ii). If no power required, specify reasons : </td>
			<td>'.strtoupper($source_reason).' </td>
	</tr>
	<tr>
			<td valign="top" colspan="2">(b). Indicate Annual Requirement :  </td>
	</tr>
	<tr>
			<td colspan="2"><table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Source of Energy</td>
					<td align="center">Quantity</td>
					<td align="center">Unit</td>
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td align="center">'.strtoupper($row_2["name"]).'</td>
							<td align="center">'.strtoupper($row_2["quantity"]).'</td>
							<td align="center">'.strtoupper($row_2["unit"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> </td>
	</tr>
	<tr>
			<td valign="top">15. Expected Employment :  </td>
			<td> 	
					1. Management and Office Staff : '.strtoupper($expected_staff).'<br/> 
					2. Supervisory : '.strtoupper($expected_supervisory).'<br/>
					3. Workers : '.strtoupper($expected_workers).' 
			</td>
	</tr>
	<tr>
		<td colspan="2" >16. Entrepreneurs Profile(of all Partners/Directors of the organisation) :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
					<tr >
						<th>Sl. No.</th>
						<th>Partners/Directors Name</th>
						<th>Gender</th>
						<th>Caste</th>
						<th>Knowledge-Level</th>
						<th>Equity Participation(In Rs)</th>
						<th>Percentage of total Equity</th>
						<th>Stake in other Manufacturing Enterprises</th>
					</tr>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						if($rows->gender=="M") $gender="Male"; else $gender="Female";
						if($rows->is_stack=="Y") $is_stack="YES"; else $is_stack="NO";
						if($rows->caste=="O") $caste="OBC"; 
						else if($rows->caste=="OT") $caste="Other";
						else if($rows->caste=="PC") $caste="Physically Challanged";
						else $caste=$rows->caste;
						if($rows->edu=="TG") $edu="Technical Graduate"; 
						else if($rows->edu=="MG") $edu="Management Graduate";
						else if($rows->edu=="PG") $edu="Post Graduate";
						else if($rows->edu=="OG") $edu="Other Graduate";
						else if($rows->edu=="UG") $edu="Under Graduate";
						else $edu="Any other lower";
						$printContents=$printContents.'
						<tr>
							<td align="center">'.$sl.'</td>
							<td align="center">'.strtoupper($rows->name).'</td>
							<td align="center">'.strtoupper($gender).'</td>
							<td align="center">'.strtoupper($caste).'</td>
							<td align="center">'.strtoupper($edu).'</td>
							<td align="center">'.strtoupper($rows->equity_rs).'</td>
							<td align="center">'.strtoupper($rows->equity_per).'</td>
							<td align="center">'.strtoupper($is_stack).'</td>
							
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
			</table>       
		</td>
	</tr>
	<tr>
		<td>17. Expected Schedule of Commencement of Production :</td>
		<td>'.strtoupper($expect_date).'</td>
	</tr>';
		
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	
	<tr>
		<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>Place : <strong>'.strtoupper($dist).'</strong></td>

		<td align="right">
			<b>'.strtoupper($key_person).'</b><br/>
				Signature of the Applicant               
		</td>
	</tr>
</table>';
?>