<?php
$dept="pcb";
$form="9";
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
	### form9a #######
	$com_date=$results["com_date"];$no_workers=$results["no_workers"];$validity_haz_waste=$results["validity_haz_waste"];
	$prod_capacity=$results['prod_capacity'];
	if(!empty($results["consent_validity"])){
		$consent_validity=json_decode($results["consent_validity"]);
		$consent_validity_air=$consent_validity->air;$consent_validity_water=$consent_validity->water;
	}else{
		$consent_validity_air="";$consent_validity_water="";
	}
	####### form 9b#####
	$water_fee=$results["water_fee"];$air_fug_emission=$results["air_fug_emission"];$is_faci_provided=$results["is_faci_provided"];$disp_detail=$results["disp_detail"];
	if(!empty($results["water_consption"])){
		$water_consption=json_decode($results["water_consption"]);
		$water_consption_i=$water_consption->i;$water_consption_d=$water_consption->d;
	}else{
		$water_consption_i="";$water_consption_d="";
	}
	if(!empty($results["waste_water"])){
		$waste_water=json_decode($results["waste_water"]);
		$waste_water_i=$waste_water->i;$waste_water_d=$waste_water->d;
	}else{
		$waste_water_i="";$waste_water_d="";
	}
	if(!empty($results["waste_wat_dis"])){
		$waste_wat_dis=json_decode($results["waste_wat_dis"]);
		$waste_wat_dis_day=$waste_wat_dis->day;$waste_wat_dis_loc=$waste_wat_dis->loc;$waste_wat_dis_treate_water=$waste_wat_dis->treate_water;
	}else{
		$waste_wat_dis_day="";$waste_wat_dis_loc="";$waste_wat_dis_treate_water="";
	}
	#######form9c #########
	$yes_adeq_detail=$results["yes_adeq_detail"];
	$is_adequate_prov=$results["is_adequate_prov"];$is_compliance=$results["is_compliance"];$is_satisfactory=$results["is_satisfactory"];$is_condition=$results["is_condition"];$is_material_handled=$results["is_material_handled"];
	if(!empty($results["waste_proposed"])){
		$waste_proposed=json_decode($results["waste_proposed"]);
		$waste_proposed_name=$waste_proposed->name;$waste_proposed_qnty_req=$waste_proposed->qnty_req;$waste_proposed_pos=$waste_proposed->pos;$waste_proposed_nature=$waste_proposed->nature;
	}else{
		$waste_proposed_name="";$waste_proposed_qnty_req="";$waste_proposed_pos="";$waste_proposed_nature="";
	}
	if(!empty($results["cost_pollution"])){
		$cost_pollution=json_decode($results["cost_pollution"]);
		$cost_pollution_unit=$cost_pollution->unit;$cost_pollution_capital=$cost_pollution->capital;$cost_pollution_recurring=$cost_pollution->recurring;
	}else{
		$cost_pollution_unit="";$cost_pollution_capital="";$cost_pollution_recurring="";
	}
	if(!empty($results["other_info"])){
		$other_info=json_decode($results["other_info"]);
		$other_info_o1=$other_info->o1;$other_info_o2=$other_info->o2;$other_info_o3=$other_info->o3;
	}else{
		$other_info_o1="";$other_info_o2="";$other_info_o3="";
	}		
	if($is_adequate_prov=="Y") $is_adequate_prov="YES";
	else $is_adequate_prov="NO";
	if($is_compliance=="Y") $is_compliance="YES";
	else $is_compliance="NO";
	if($is_satisfactory=="Y") $is_satisfactory="YES";
	else $is_satisfactory="NO";
	if($is_condition=="Y") $is_condition="YES";
	else $is_condition="NO";
	if($is_material_handled=="Y") $is_material_handled="YES";
	else $is_material_handled="NO";
	if($is_faci_provided=="Y") $is_faci_provided="YES";
	else $is_faci_provided="NO";

	$air_fug_emission = wordwrap($results["air_fug_emission"], 40, "<br/>", true);
	$disp_detail = wordwrap($results["disp_detail"], 40, "<br/>", true); 
	$yes_adeq_detail = wordwrap($results["yes_adeq_detail"], 40, "<br/>", true); 
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
		<td width="50%">1. Name & address of the unit</td>
		<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
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
        			<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'&nbsp;'.strtoupper($b_landline_no).'</td>
      		</tr>
      		</table>
    	</td>
	</tr>	
  	<tr>
    	<td>2. Contact person with designation,Tel</td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($key_person).'</td>
      		</tr>
      		<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($status_applicant).'</td>
      		</tr>
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</td>
      		</tr>
			<tr>
        			<td>Email</td>
        			<td>'.$email.'</td>
      		</tr>
			</table>
    	</td>
  	</tr>  	
  	<tr>
		<td>3. Date of Commissioning</td>
    	<td>'.strtoupper($com_date).'</td>
  	</tr>
  	<tr>
		<td>4. No. of Workers (including contract labourers)</td>
    	<td>'.strtoupper($no_workers).'</td>
  	</tr>
  	<tr>
		<td>5. Consent Validity</td>
    	<td>a) Under Air Act, 1981; Valid up to - '.strtoupper($consent_validity_air).'<br/>
		b) Under Water Act, 1974; Valid up to - '.strtoupper($consent_validity_water).'</td>
  	</tr>
  	<tr>
		<td>6. Validity of Authorization under rule 5 of the Hazardous Wastes (Management and Handling Rules,1989</td>
    	<td>Valid up to - '.strtoupper($validity_haz_waste).'</td>
  	</tr>
  	<tr>
		<td>7. Installed capacity of the production in (MTA)</td>
    	<td>'.strtoupper($prod_capacity).'</td>
  	</tr>  	
  	<tr>
		<td colspan="2">8. Products Manufactured (Tones/years) during the last three years<br/><br/>
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No</td>
				<td align="center">Product Name</td>
				<td align="center">Year-1</td>
				<td align="center">Year-2</td>
				<td align="center">Year-3</td>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["product_name"]).'</td>
						<td>'.strtoupper($row_1["year1"]).'</td>
						<td>'.strtoupper($row_1["year2"]).'</td>
						<td>'.strtoupper($row_1["year3"]).'</td>
				</tr>';
				}
			$printContents=$printContents.'
   		</table>   	
		</td>
  	</tr>
  	<tr>
		<td colspan="2">9. Raw material consumed (Tones/year)<br/><br/>
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center">Sl No </td>
				<td align="center">Raw Material Name </td>
				<td align="center">Year-1</td>
				<td align="center">Year-2</td>
				<td align="center">Year-3</td> 
			
			</tr>';
			
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["product_name"]).'</td>
						<td>'.strtoupper($row_2["year1"]).'</td>
						<td>'.strtoupper($row_2["year2"]).'</td>
						<td>'.strtoupper($row_2["year3"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table>   	
		</td>
  	</tr>
	<tr>
		<td>10. Manufacturing Process Please attach manufacturing process flow diagram for each product (s)</td>
    	<td>(Document is Attached)</td>
  	</tr>
	<tr>
		<td>11. Water Consumption</td>
    	<td>Industrial-'.strtoupper($water_consption_i).'m<sup>3</sup> /day<br/>
		Domestic-'.strtoupper($water_consption_d).'m<sup>3</sup> /day</td>
	</tr>
	<tr>
		<td>12. Waste Water generation <br/> a) as per consent m<sup>3</sup> /day<br/> </td>
    	<td>'.strtoupper($water_fee).'</td>
  	</tr>  
  	<tr>
		<td>b) actual m<sup>3</sup> /day (average of last three months)</td>
    	<td>Industrial- '.strtoupper($waste_water_i).'<br/>Domestic- '.strtoupper($waste_water_d).'</td>
  	</tr> 
  	<tr>
		<td>13. Waste water treatment (please provide flow diagram of the treatment scheme)</td>
    	<td>Industrial-(Document is Attached) <br/>Domestic- (Document is Attached)</td>
  	</tr> 
  	<tr>
		<td>14. Waste water discharge</td>
		<td>Quantity m<sup>3</sup> /day - '.strtoupper($waste_wat_dis_day).'<br/>
		Location- '.strtoupper($waste_wat_dis_loc).'<br/>
		<u>Analysis of treated waste water-</u><br/>pH, BOD, COD, SS, O&G, Any other<br/>(indicate the corresponding standards applicable)- '.strtoupper($waste_wat_dis_treate_water).'
    	</td>
  	</tr>   	
  	<tr>
		<td>15. Air Pollution Control<p style="text-indent:14px;">a. Please provide flow diagram for emission control system(s) installed for each process unit,utilities etc.</p></td>
		<td>(Document is Attached)</td>
  	</tr>  	
  	<tr>
		<td><p style="text-indent:14px;">b. Details of facilities provided for control of fugitives emission due to material handling, process, utilities etc.</p></td>
		<td>'.strtoupper($air_fug_emission).'</td>
  	</tr>
  	<tr>
		<td colspan="2"><p style="text-indent:14px;">c. Fuel Consumption.</p><br/>
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td>S. No</td>
				<td>Name of the fuel</td>
				<td>Quantity/day</td>
			
			</tr>';	
			$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
			while($row_3=$part3->fetch_array()){
			$printContents=$printContents.'
			<tr align="center">
					<td>'.strtoupper($row_3["slno"]).'</td>
					<td>'.strtoupper($row_3["fuel"]).'</td>
					<td>'.strtoupper($row_3["quantity"]).'</td>
			</tr>';
			}$printContents=$printContents.'
		</table>   	
		</td>
  	</tr>  	
  	<tr>
		<td colspan="2"><p style="text-indent:14px;">d. Stack emission monitoring results vis-à-vis the standards applicable.</p><br/>

			<table class="table table-bordered table-responsive">
				<tr align="center">
					<td>S. No</td>
					<td>Stack attached to</td>
					<td>Emission g/Nm<sup>3</sup></td>
				</tr>';
		
				$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
				while($row_4=$part4->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_4["slno"]).'</td>
						<td>'.strtoupper($row_4["stack"]).'</td>
						<td>'.strtoupper($row_4["quantity"]).'</td>
				</tr>';
					}$printContents=$printContents.'
			</table>  
		</td>
  	</tr>  	
  	<tr>
		<td colspan="2"><p style="text-indent:14px;">e. Ambient air quality.</p><br/>
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td>S. No</td>
				<td>Location</td>
				<td>Result ug/ m<sup>3</sup></td>
			</tr>';
			
			$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
			while($row_5=$part5->fetch_array()){
			$printContents=$printContents.'
			<tr align="center">
					<td>'.strtoupper($row_5["slno"]).'</td>
					<td>'.strtoupper($row_5["location"]).'</td>
					<td>'.strtoupper($row_5["result"]).'</td>
			</tr>';
			}$printContents=$printContents.'
		</table>  
		</td>
  	</tr>
  	<tr>
		<td colspan="2">16. Hazardous Waste Management<br/></td>
	</tr>
	<tr>
		<td colspan="2">a) Waste generation
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td>Sl. No</td>
				<td>Name of the Waste</td>
				<td>Process category</td>
				<td>Quantity/Y</td>
			</tr>
			';
			
			$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
			while($row_6=$part6->fetch_array()){
			$printContents=$printContents.'
			<tr align="center">
					<td>'.strtoupper($row_6["slno"]).'</td>
					<td>'.strtoupper($row_6["name"]).'</td>
					<td>'.strtoupper($row_6["category"]).'</td>
					<td>'.strtoupper($row_6["qty"]).'</td>
			</tr>';
			}$printContents=$printContents.'
		</table> 
		</td>
	</tr>	
	<tr>
		<td colspan="2">b) Details of collection, treatment<br/>
		<table class="table table-bordered table-responsive">
			<tr align="center">
				<td>Sl. No</td>
				<td>Name of the Waste</td>
				<td>Process category</td>
				<td>Quantity/Y</td>
			</tr>
			';
	
			$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
			while($row_7=$part7->fetch_array()){
			$printContents=$printContents.'
			<tr align="center">
					<td>'.strtoupper($row_7["slno"]).'</td>
					<td>'.strtoupper($row_7["name"]).'</td>
					<td>'.strtoupper($row_7["category"]).'</td>
					<td>'.strtoupper($row_7["qty"]).'</td>
			</tr>';
			}$printContents=$printContents.'
		</table> 
		</td>
       </tr>
	<tr>
		<td  colspan="2">c)  Disposal (including point of final discharge)><br/>		
		<table class="table table-bordered table-responsive">
		<tr align="center">
			<td>Sl. No</td>
			<td>Name of the Waste</td>
			<td>Process category</td>
			<td>Quantity/Y</td>
		</tr>';
		$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
		while($row_8=$part8->fetch_array()){
		$printContents=$printContents.'
		<tr align="center">
				<td>'.strtoupper($row_8["slno"]).'</td>
				<td>'.strtoupper($row_8["name"]).'</td>
				<td>'.strtoupper($row_8["category"]).'</td>
				<td>'.strtoupper($row_8["qty"]).'</td>
		</tr>';
		}$printContents=$printContents.'
		</table> 
		</td>
	</tr>
  	<tr>
	  	<td >(i) Please provide details of the disposal facility</td>
		<td >'.strtoupper($disp_detail).'</td> 	
  	</tr>  	
  	<tr>
	  	<td>(ii) Whether facilities provided are in compliance of the conditions issued by the SPCB in Authorization</td>
		<td>'.strtoupper($is_faci_provided).'</td>
	</tr>
  	<tr>
	  	<td>(iii)Please attach analysis report of characterization of hazardous waste generated (including leachate test if applicable)</td>
		<td>(Document is Attached)</td>
  	</tr> 
	<tr>
		<td>17. Details of waste proposed to be taken in auction or import, as the case may be for use as raw material</td>
		<td>
    		1. Name -'.strtoupper($waste_proposed_name).'<br/>
			2. Quantity required/-'.strtoupper($waste_proposed_qnty_req).'<br/>
			3. Position in List A/List B as per Basel Convention (BC)-'.strtoupper($waste_proposed_pos).'<br/>
			4. Nature as per Annexure III of BC -'.strtoupper($waste_proposed_nature).'<br/>
    	</td>
	</tr>
	<tr>
		<td>18. Occupational safety and health aspects(Please provide details of facilities provided).</td>
		<td>(Document is Attached)</td>
	</tr>
	<tr>
		<td>Remarks<p style="text-indent:14px;">19. (i) Whether industry has provided adequate pollution control system/ equipment to meet the standards of emission/ effluent. If yes, please furnish details.</p></td>
		<td>'.strtoupper($is_adequate_prov).'<br/>'.strtoupper($yes_adeq_detail).'
		</td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">(ii) Whether industry is in compliance with conditions laid down in the Hazardous Waste Authorization.</p></td>
		<td>'.strtoupper($is_compliance).'</td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">(iii) Whether Hazardous Waste collection and Treatment, Storage and Disposal Facility (TSDF) are operating satisfactorily.</p></td>
		<td>'.strtoupper($is_satisfactory).'</td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">(iv) Whether conditions exist or likely to exists of the material being handled/ processed of posing immediate or delayed adverse impacts on the environment.</p></td>
		<td>'.strtoupper($is_condition).'</td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">(v) Whether conditions exist or is likely to exist of the material being handled/ processed by any means capable of yielding another material e.g. leachate which may possess eco-toxicity</p></td>
		<td>'.strtoupper($is_material_handled).'</td>
	</tr>
	<tr>
		<td>20. (i) Cost of the unit</td>
		<td>'.strtoupper($cost_pollution_unit).'</td>
	</tr>
	<tr>
		<td>(ii) Cost of pollution control equipment including environmental safeguard measures</td>
		<td></td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">a) Capital:</p></td>
		<td>'.strtoupper($cost_pollution_capital).'</td>
	</tr>
	<tr>
		<td><p style="text-indent:14px;">a) Recurring:</p></td>
		<td>'.strtoupper($cost_pollution_recurring).'</td>
	</tr>
	<tr>
		<td>21.Any other information:<br/></td>
		<td>i)&nbsp;&nbsp;'.strtoupper($other_info_o1).'<br/>
			ii)&nbsp;'.strtoupper($other_info_o2).'<br/>
			iii)'.strtoupper($other_info_o3).'
		</td>
	</tr>
	';				
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
	
	<tr>
		<td align="left">Date: '.date('d-m-Y', strtotime($results["sub_date"])).'<br/><br/> Place: '.strtoupper($dist).'</td>
		<td align="right">
			Signature:  &nbsp; &nbsp; '.strtoupper($key_person).'<br/>
			Designation:  &nbsp;'.strtoupper($status_applicant).'</td>
    </tr>
</table>';
?>