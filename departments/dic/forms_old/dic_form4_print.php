<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form4 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form4 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form4 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form4 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$l_o_business=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$sn1="";$sn2="";$v="";$d="";$p="";
	
	$q=$dic->query("select * from dic_form4 where user_id=$swr_id and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];
	$nature=$results['nature'];$ancillary=$results['ancillary'];$installation_date=$results['installation_date'];$fact_act=$results['fact_act'];$area_r=$results['area_r'];$is_unit_computer=$results['is_unit_computer'];
		#### Part B #######
		$cat_enter=$results['cat_enter'];
		if(!empty($results["manuf"]))
		{
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
		if(!empty($results["source"]))
		{
			$source=json_decode($results["source"]);
			$source_reason=$source->reason;
			if(isset($source->a)) $source_a=$source->a; else $source_a="";
			if(isset($source->b)) $source_b=$source->b; else $source_b="";
			if(isset($source->c)) $source_c=$source->c; else $source_c="";
			if(isset($source->d)) $source_d=$source->d; else $source_d="";
			if(isset($source->e)) $source_e=$source->e; else $source_e="";
			if(isset($source->f)) $source_f=$source->f; else $source_f="";
			if(isset($source->g)) $source_g=$source->g; else $source_g="";
			if(isset($source->h)) $source_f=$source->h; else $source_h="";
		}else{
			$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
		}	
		##### Part C########
		$annual_rupees=$results['annual_rupees'];$export_rupees=$results['export_rupees'];$expect_date=$results['expect_date'];$is_unit_computer=$results['is_unit_computer'];
		if(!empty($results["expected"]))
		{
			$expected=json_decode($results["expected"]);
			$expected_staff1=$expected->staff1;$expected_staff2=$expected->staff2;
			$expected_supervisory1=$expected->supervisory1;$expected_supervisory2=$expected->supervisory2;
			$expected_workers1=$expected->workers1;$expected_workers2=$expected->workers2;
		}else{
			$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";
		}	
		$q1=$dic->query("select * from dic_form1 where user_id='$swr_id'") or die($dic->error);
		$results1=$q1->fetch_assoc();
		{
			$em1=$results1['uain'];$dt_em1=$results1['sub_date'];
		}	
		if($building_type==R){
			$building_type="Rented";
			}else{$building_type="Owned";}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}		
     $form_name=$formFunctions->get_formName('dic','3');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 2</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'<br/></h4>
		</div><br/>
      <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  		<tr>  				
			<td valign="top" width="50%">A. ENTERPRENEURS MEMORANDUM NUMBER(Part 1) :<br/> (If you already filed EM1, please mention the acknowledge number)</td>
			<td style="width:50%">'.strtoupper($em1).'</td>
		</tr>
  		<tr>  				
			<td valign="top" width="50%">B. Date of Issue EM Part1 : </td>
			<td style="width:50%">'.strtoupper($dt_em1).'</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">1. Name of Applicant :  </td>
			<td style="width:50%">'.strtoupper($key_person).'</td>
		</tr>
		<tr>
  		<td valign="top">2. a). Address of Communication :   </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($street_name1).'</td>
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
        			<td>+91 - '.strtoupper($mobile_no).'</td>
      		</tr>
			
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($email).'</td>
      		</tr>
			
    		</table>
		</td>
	</tr>
	<tr>
  		<td valign="top">2. b). Permanent Residential Address (Main Applicant) :  </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($b_street_name1).'</td>
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
			
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($b_email).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top">3. Name of Enterprise :  </td>
  		<td valign="top"> '.strtoupper($unit_name).'</td>
  	</tr>
	<tr>
  		<td valign="top">4. Location of Enterprise :    </td>
  		<td>
		<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td width="50%">'.strtoupper($b_street_name1).'</td>
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
        			<td height="29">Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
			
      		<tr>
        			<td>Email-id</td>
        			<td> '.strtoupper($b_email).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
	<tr>
			<td>5. Nature of Activity :</td>
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
			<td>8. Month & year of installation of plant & machinery : </td>
			<td> '.strtoupper($installation_date).'</td>
	</tr>
	<tr>
			<td>9. Whether Unit is Registered under Factory Act : </td>
			<td> '.strtoupper($fact_act).'</td>
	</tr>
	<tr>
			<td>10. Type of Organization : </td>
			<td> '.strtoupper($l_o_business_val).'</td>
	</tr>
	<tr>
			<td>11. (a). Main Manufacturing/Service Activity : </td>
			<td>Name : '.strtoupper($manuf_name).'<br/>
			Code (NIC2004) : '.strtoupper($manuf_code).'
			</td>
	</tr>
	<tr>
			<td>11. (b). Products To Be Manufactured/Services To Be Provided : <br/><i>(<font color="red">*</font>) Codes for activities and production/services as per classification specified from time to time by the Development Commissioner (Small Scale Industries), Govt. of India to be filled in by the District Industries Centre or the office where the Entrepreneurs memorandum is subimitted.</i> </td>
			<td>
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Name</td>
					<td align="center">Code</td>
					<td align="center">Quantity</td>
					<td align="center">Unit</td>
				</tr>';
				
				$part1=$dic->query("SELECT * FROM dic_form4_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["slno"]).'</td>
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
			<td>12.Investment in Fixed Assets [In Rupees] :</td>
			<td>
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<tr align="center">
							<td>(i) Land : '.strtoupper($fixed_asset_land).'</td>
							<td>Approximate Value :'.strtoupper($fixed_asset_land_approx).'</td>
					</tr>
					<tr>
							<td>(ii) Building  :'.strtoupper($fixed_asset_building).'</td>
							<td>Approximate Value :'.strtoupper($fixed_asset_building_approx).'</td>
					</tr>
					<tr>
							<td colspn="2">(iii) Plant & Machinery (in case of manufacturing  enterprise) Value :'.strtoupper($fixed_asset_plant_approx).'</td>
					</tr>
					<tr>
							<td colspn="2">(iv) Equipment (in case of services enterprise)   Value :'.strtoupper($fixed_asset_euipment_approx).'</td>
					</tr>
					<tr>
							<td colspn="2">(v) Foreign Equity (if any) Value :'.strtoupper($fixed_asset_equity_approx).'</td>
					</tr>';
		$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td>13. Category of Enterprise :</td>
			<td>'.strtoupper($cat_enter).'</td>
	</tr>
	<tr>
			<td>14. Power Load (Anticipated):</td>
			<td>'.strtoupper($power_load).' '.strtoupper($power_unit).'</td>
	</tr>
	<tr>
			<td>15.(a) (i). Other Source of Energy/Power (if required):</td>
			<td>'.strtoupper($power_load).' '.strtoupper($power_unit).'</td>
	</tr>
	<tr>
			<td>(ii). If no power required, specify reasons : </td>
			<td>'.strtoupper($source_reason).' </td>
	</tr>
	<tr>
			<td>(b). Indicate Annual Requirement :  </td>
			<td><table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Source of Energy</td>
					<td align="center">Quantity</td>
					<td align="center">Unit</td>
				</tr>';
				
				$part2=$dic->query("SELECT * FROM dic_form4_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name"]).'</td>
							<td>'.strtoupper($row_2["quantity"]).'</td>
							<td>'.strtoupper($row_2["unit"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> </td>
	</tr>
	<tr>
			<td>16. Expected Employment :  </td>
			<td> 
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>
				<th></th>
				<th>Male</th>
				<th>Female</th>
			</tr>
			<tr>
				<td>1.Management and Office Staff :</td>
				<td>'.strtoupper($expected_staff1).'</td> 
				<td>'.strtoupper($expected_staff2).'</td> 
			</tr>
			<tr>
				<td>2.Supervisory :</td>
				<td>'.strtoupper($expected_supervisory1).'</td>
				<td>'.strtoupper($expected_supervisory2).'</td>
			</tr>
			<tr>
				<td>3.Workers :</td>
				<td>'.strtoupper($expected_workers1).' </td>
				<td>'.strtoupper($expected_workers2).' </td>
			</tr>
			</table>
			</td>			
	</tr>
	<tr>
		<td  >17. Total annual turnover (in Rupees) : </td>
		<td>'.strtoupper($annual_rupees).' </td>
	</tr>
	<tr>
		<td  >18. Export if any (in Rupees)  : </td>
		<td>'.strtoupper($export_rupees).' </td>
	</tr>
	<tr>
		<td colspan="2" >19. Entrepreneurs Profile(of all Partners/Directors of the organisation):</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="99%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
					<tr >
						<th width="10%">Sl. No.</th>
						<th width="20%">Partners/Directors Name</th>
						<th width="10%" >Gender</th>
						<th width="10%">Caste</th>
						<th width="10%">Knowledge-Level</th>
						<th width="10%">Equity Participation(In Rs)</th>
						<th width="10%">Percentage of total Equity</th>
						<th width="10%">Stake in other Manufacturing Enterprises</th>
					</tr>';
					$results1=$dic->query("select * from dic_form4_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->name).'</td>
							<td>'.strtoupper($gender).'</td>
							<td>'.strtoupper($caste).'</td>
							<td>'.strtoupper($edu).'</td>
							<td>'.strtoupper($rows->equity_rs).'</td>
							<td>'.strtoupper($rows->equity_per).'</td>
							<td>'.strtoupper($is_stack).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>20. Date of Commencement of Production/Activity :</td>
		<td>'.strtoupper($expect_date).'</td>
	</tr>  
	<tr>
		<td>21. Whether the Unit has Computer :</td>
		<td>'.strtoupper($is_unit_computer).'</td>
	</tr>     
        <tr>
			<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
		</tr>
</table>';

?>
