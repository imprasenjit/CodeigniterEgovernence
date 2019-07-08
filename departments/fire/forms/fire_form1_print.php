<?php
$dept="fire";
$form="1";
$table_name=getTableName($dept,$form);

	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";
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
		$results=$q->fetch_array();
		$form_id=$results["form_id"]; 
		$owner_name=$results['owner_name'];$consultant_name=$results['consultant_name'];$no_of_block=$results['no_of_block'];$no_of_floor=$results['no_of_floor'];$floor_details=$results['floor_details'];$building_height=$results['building_height'];$site_area=$results['site_area'];$total_area=$results['total_area'];$premise_access=$results['premise_access'];
		$road_width=$results['road_width'];$no_of_entrance=$results['no_of_entrance'];$height_clearance=$results['height_clearance'];$projection_height=$results['projection_height'];$parking_argmnt=$results['parking_argmnt'];$is_provided=$results['is_provided'];$is_provided_details=$results['is_provided_details'];$handrail_height=$results['handrail_height'];$sprinkler_system=$results['sprinkler_system'];$portable_exting=$results['portable_exting'];$public_address=$results['public_address'];$nearest_station=$results['nearest_station'];$other_info=$results['other_info'];
		
		$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);
		
		if($parking_argmnt=='Y') $parking_argmnt="YES"; else $parking_argmnt="NO";
		if($is_provided=='Y'){
			$is_provided="YES";
		}else{
			$is_provided="NO"; $is_provided_details="";
		}

		if(!empty($results["owner_address"])){
			$owner_address=json_decode($results["owner_address"]);
			$owner_address_s1= $owner_address->s1;  $owner_address_s2= $owner_address->s2;  $owner_address_vill=$owner_address->vill;$owner_address_dist= $owner_address->dist;  $owner_address_block= $owner_address->block;$owner_address_pin=$owner_address->pin;
		}else{
			$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";$owner_address_std="";$owner_address_land="";$owner_address_mobile="";  
		}
		if(!empty($results["no_of"])){
			$no_of=json_decode($results["no_of"]);
			$no_of_staircase= $no_of->staircase;  $no_of_loc_stair= $no_of->loc_stair;$no_of_stair_width= $no_of->stair_width;$no_of_treads_width= $no_of->treads_width;$no_of_risers_height= $no_of->risers_height;$no_of_no_risers= $no_of->no_risers;
		}else{
			$no_of_staircase="";$no_of_loc_stair="";$no_of_stair_width="";$no_of_treads_width="";$no_of_risers_height="";$no_of_no_risers=""; 
		}
		if(!empty($results["consultant_address"])){
			$consultant_address=json_decode($results["consultant_address"]);
			$consultant_address_s1= $consultant_address->s1; $consultant_address_s2= $consultant_address->s2;$consultant_address_vt= $consultant_address->vt; $consultant_address_dist= $consultant_address->dist;$consultant_address_block= $consultant_address->b;  $consultant_address_pin=$consultant_address->pin;
		}else{
			$consultant_address_s1="";$consultant_address_s2="";$consultant_address_vt="";$consultant_address_dist="";$consultant_address_block="";$consultant_address_pin="";
		}
		if(!empty($results["provided"])){
			$provided=json_decode($results["provided"]);
			$provided_height= $provided->height;$provided_parking= $provided->parking; $provided_num_rams= $provided->num_rams;$provided_num_staircase= $provided->num_staircase; $provided_loc_stair= $provided->loc_stair;$provided_stair_width= $provided->stair_width;  $provided_treads_width=$provided->treads_width;$provided_risers_height=$provided->risers_height;$provided_no_risers=$provided->no_risers;
		}else{
			$provided_height="";$provided_parking="";$provided_num_rams="";$provided_num_staircase="";$provided_loc_stair="";$provided_stair_width="";$provided_treads_width="";$provided_risers_height="";$provided_no_risers="";
		}
		if(!empty($results["part"])){
			$part=json_decode($results["part"]);
			$part_hr_clearence= $part->hr_clearence;$part_travel_distance= $part->travel_distance; $part_no_of_lifts= $part->no_of_lifts; $part_capacity_of_lift= $part->capacity_of_lift;
		}else{
			$part_hr_clearence="";$part_travel_distance="";$part_no_of_lifts="";$part_capacity_of_lift="";
		}
		if(!empty($results["surround_prop"])){  
			$surround_prop=json_decode($results["surround_prop"]);
			$surround_prop_e=$surround_prop->e; $surround_prop_w=$surround_prop->w; $surround_prop_n=$surround_prop->n;$surround_prop_s=$surround_prop->s;
		}else{
			$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";
		}
		if(!empty($results["os_width"])){ 
			$os_width=json_decode($results["os_width"]);
			$os_width_f=$os_width->f; $os_width_r=$os_width->r; $os_width_sa=$os_width->sa; $os_width_sb=$os_width->sb;  
		}else{
			$os_width_f= ""; $os_width_r="";$os_width_sa= "";$os_width_sb ="";
		}
		if(!empty($results["type"])){ 
			$type=json_decode($results["type"]);
			$type_of_door=$type->of_door; $type_service_duct=$type->service_duct;$type_standby_gen=$type->standby_gen; $type_ac=$type->ac; $type_wetrisers=$type->wetrisers;$type_tanks_capacity=$type->tanks_capacity;$type_alarm=$type->alarm; $type_detect_system=$type->detect_system; 
		}else{
			$type_of_door="";$type_service_duct="";$type_standby_gen="";$type_ac="";$type_wetrisers="";$type_tanks_capacity="";$type_alarm="";  $type_detect_system="";
		}
	}
	$other_info = wordwrap($other_info, 30, "<br/>", true);
	$is_provided_details = wordwrap($is_provided_details, 30, "<br/>", true);
	
	$floor_details = wordwrap($results["floor_details"], 40, "<br/>", true);
	$uain=$results["uain"];
		
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);
if(!isset($css)){
$printContents='
	<!DOCTYPE html>
	<html lang="en">
	<head>
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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center">
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/>
<table class="table table-bordered table-responsive"> 
	<tr>
		<td colspan="2%">To,<br/> The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel </td>
	</tr>
	<tr>
		<td colspan="2%">Sir,<br/> I/We&nbsp;'.strtoupper($key_person).'&nbsp;on behalf of&nbsp; '.strtoupper($owner_names).'&nbsp; apply for NOC in respect of Fire Prevention and Fire Safety Measures under &lsquo;Assam Fire Service Rules 1989&rsquo; for the purpose of Existing/ Proposed Multi-storeyed/ High rise building. Required documents/ information as per formate furnished below.</td>
	</tr>
	<tr>
		<td colspan="2">1. Name and address of the Applicant</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td>Address </td>
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
				<td>State </td>
				<td>'.strtoupper($block).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($pincode).'</td>
			</tr>
			</table>
		</td>
	</tr>
    <tr>
		<td colspan="2">2. Name and Address of the owner of the premises</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>'.strtoupper($owner_name).'</td>
	</tr>
	<tr>
		<td>Address </td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>Street Name 1</td>
				<td>'.strtoupper($owner_address_s1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($owner_address_s2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($owner_address_vill).'</td>
			</tr>
			<tr>
				<td>Block</td>
				<td>'.strtoupper($owner_address_block).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($owner_address_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($owner_address_pin).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Telephone numbers of the applicant/occupier/owner</td>
		<td>Landline No: '.strtoupper($landline_std).'-'.strtoupper($landline_no).'<br>Mobile Number: +91-'.strtoupper($mobile_no).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Name and Address of Architect/Consultation</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>'.strtoupper($consultant_name).'</td>
	</tr>
	<tr>
		<td>Address </td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>Street Name 1</td>
				<td>'.strtoupper($consultant_address_s1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($consultant_address_s2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($consultant_address_vt).'</td>
			</tr>
			<tr>
				<td>Block</td>
				<td>'.strtoupper($consultant_address_block).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($consultant_address_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($consultant_address_pin).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>5. Number of Blocks/building</td>
		<td>'.strtoupper($no_of_block).'</td>
	</tr>
	<tr>
		<td>6. Number of floor in each block/buildings</td>
		<td>'.strtoupper($no_of_floor).'</td>
	</tr>
	<tr>
		<td>7. Floor wise details of occupancy</td>
		<td>'.strtoupper($floor_details).'</td>
	</tr>
	<tr>
		<td>8. Height of the building</td>
		<td>'.strtoupper($building_height).'</td>
	</tr>
	<tr>
		<td>9. Site area</td>
		<td>'.strtoupper($site_area).'</td>
	</tr>
	<tr>
		<td>10. Total built up area floor</td>
		<td>'.strtoupper($total_area).'</td>
	</tr>
	<tr>
		<td>11. Accessibility to the premises</td>
		<td>'.strtoupper($premise_access).'</td>
	</tr>
	<tr>
		<td>12. Surrounding properties:</td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td width="20%">East</td>
				<td>'.strtoupper($surround_prop_e).'</td>
			</tr>
			<tr>
				<td>West</td>
				<td>'.strtoupper($surround_prop_w).'</td>
			</tr>
			<tr>
				<td>North</td>
				<td>'.strtoupper($surround_prop_n).'</td>
			</tr>
			<tr>
				<td>South</td>
				<td>'.strtoupper($surround_prop_s).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>13. Width of the abutting road/roads and condition(Hard surfaced or not)</td>
		<td>'.strtoupper($road_width).'</td>
	</tr>
	<tr>
		<td>14. Number of entrances and width of each entrance to the premises.</td>
		<td>'.strtoupper($no_of_entrance).'</td>
	</tr>
	<tr>
		<td>15. Height Clearance</td>
		<td>'.strtoupper($height_clearance).'</td>
	</tr>
	<tr>
		<td>16. Width  of open space</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%">Front</td>
					<td>'.strtoupper($os_width_f).'</td>
				</tr>
				<tr>
					<td>Rear</td>
					<td>'.strtoupper($os_width_r).'</td>
				</tr>
				<tr>
					<td>Side A</td>
					<td>'.strtoupper($os_width_sa).'</td>
				</tr>
				<tr>
					<td>Side B</td>
					<td>'.strtoupper($os_width_sb).'</td>
				</tr>
			</table>
		</td>
    </tr>
	<tr>
		<td>17. Canopy or balcony projection provided. If so at what height</td>
		<td>'.strtoupper($projection_height).'</td>
	</tr>
	<tr>
		<td>18. Arrangement for parking the cars</td>
		<td>'.strtoupper($parking_argmnt).'</td>
	</tr>
	<tr>
		<td>19. If basement is provided, number of rams available For the vehicles to reach the basement and it&apos;s location</td>
		<td>'.strtoupper($is_provided).'&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($is_provided_details).'</td>   
	</tr>
	<tr>
		<td>20. Number of staircases</td>
		<td>'.strtoupper($no_of_staircase).'</td>
	</tr>
	<tr>
		<td>21. Location of the staircases(Extended to the basement or terminated at ground floor level)</td>
		<td>'.strtoupper($no_of_loc_stair).'</td>
	</tr>
	<tr>
		<td>22. Width of staircase</td>
		<td>'.strtoupper($no_of_stair_width).'</td>
	</tr>
	<tr>
		<td>23. Width of treads</td>
		<td>'.strtoupper($no_of_treads_width).'</td>
	</tr>
	<tr>
		<td>24. Height of risers</td>
		<td>'.strtoupper($no_of_risers_height).'</td>
	</tr>
	<tr>
		<td>25. Number of risers in a flight</td>
		<td>'.strtoupper($no_of_no_risers).'</td>
	</tr>
	<tr>
		<td>26. Height of hand rails</td>
		<td>'.strtoupper($handrail_height).'</td>
	</tr>
	<tr>
		<td>27. Headroom clearance</td>
		<td>'.strtoupper($part_hr_clearence).'</td>
	</tr>
	<tr>
		<td>28. Travel distance from the farthest point and from the dead end of the corridor to the staircase</td>
		<td>'.strtoupper($part_travel_distance).'</td>
	</tr>
	<tr>
		<td>29. Number of lifts</td>
		<td>'.strtoupper($part_no_of_lifts).'</td>
	</tr>
	<tr>
		<td>30. Capacity of each lift</td>
		<td>'.strtoupper($part_capacity_of_lift).'</td>
	</tr>
	<tr>
		<td>31. Type of door provided at lift car and at each landing</td>
		<td>'.strtoupper($type_of_door).'</td>
	</tr>
	<tr>
		<td>32. Whether service ducts are provided, If so whether the ducts are sealed at each floor level</td>
		<td>'.strtoupper($type_service_duct).'</td>
	</tr>
	<tr>
		<td>33. Standby generator is available or not. If not what capacity is required to provide service to all the emergency provisions in the building</td>
		<td>'.strtoupper($type_standby_gen).'</td>
	</tr>
	<tr>
		<td>34. Air conditioned or not. If air conditioned, the type</td>
		<td>'.strtoupper($type_ac).'</td>
	</tr>
	<tr>
		<td>35. Type and number of wet risers/down comer to be proposed to be provided in the building</td>
		<td>'.strtoupper($type_wetrisers).'</td>
	</tr>
	<tr>
		<td>36. Capacity of overhead/underground tanks proposed</td>
		<td>'.strtoupper($type_tanks_capacity).'</td>
	</tr>
	<tr>
		<td>37. Type of fire alarm system proposed</td>
		<td>'.strtoupper($type_alarm).'</td>
	</tr>
	<tr>
		<td>38. Type of detection system proposed</td>
		<td>'.strtoupper($type_detect_system).'</td>
	</tr>
	<tr>
		<td>39. Sprinkler system. If proposed, where</td>
		<td>'.strtoupper($sprinkler_system).'</td>
	</tr>
	<tr>
		<td>40. Area wise details of the types and number of portable extinguishers proposed to be provided in the building</td>
		<td>'.strtoupper($portable_exting).'</td>
	</tr>  
	<tr>
		<td>41. Public address system proposed</td>
		<td>'.strtoupper($public_address).'</td>
	</tr>    
	<tr>
		<td>42. Nearest Fire and Emergency Service station</td>
		<td>'.strtoupper($nearest_station).'</td>
	</tr>   
	<tr>
		<td>43. Any other information which is to be included in the NOC</td>
		<td>'.strtoupper($other_info).'</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
               
    <tr>
        <td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Place: '.strtoupper($dist).'<br/>Date: '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="right"> '.strtoupper($key_person).'<br/>Signature of the Applicant<br/>(Owner/ Signing Authority)</td>
			</tr>
        </table>
        </td>
    </tr>';
      
	$compliance_report_details=$formFunctions->executeQuery($dept,"select * from compliance_report where uain='$uain' and active='0' and officer_id='0'");
	if($compliance_report_details->num_rows>0){
		$rows=$compliance_report_details->fetch_object();
		$letter_no=$rows->letter_no;
		$letter_date=$rows->letter_date;
		$letter_file=$rows->letter_file;
			$printContents=$printContents.'
			<tr>
				<td colspan="2" align="center" class="success text-center">
					<b>Compliance Report</b>
				</td>
			</tr>
			<tr>       
			<td colspan="2">
			<p>To,<br/>
			&emsp;The Director,<br/>&emsp;Fire & Emergency Services, Assam.<br/>&emsp;Panbazar, Guwahati-1.<br/><br/>
			Sir,<br/>
			&emsp;I/We, '.strtoupper($key_person).' on behalf of '.strtoupper($unit_name).' located at '.strtoupper($from).' , Block/ward no. '.strtoupper($b_block).' , District - '.strtoupper($b_dist).' , do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;'.strtoupper($letter_no).' dated &nbsp;'.date("d-m-Y",strtotime($letter_date)).' and para wise compliance report is enclosed.<br/><br/>&emsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/ building.
			</p>
			</td>
			</tr>
			<tr>
				<td colspan="2">Letter of fire safety recommendations : &nbsp; &nbsp;<a href="'.$upload.$letter_file.'">Download</a></td>
			</tr>
			'; 
	} 	
	$printContents=$printContents.'
</table>'; 
?>