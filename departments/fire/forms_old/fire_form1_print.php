<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form1 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form1 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form1 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form1 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
	
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person']; $ownername=$row1['Name_of_owner'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$ownername=$row1['Name_of_owner'];
	
	$from= strtoupper($b_street_name1)." , ".strtoupper($b_street_name2)." ".strtoupper($b_vill);
		
	//$sql=$fire->query("select * from fire_form1 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_array();
	$form_id=$results["form_id"]; 
	$owner_name=$results['owner_name'];$consultant_name=$results['consultant_name'];$no_of_block=$results['no_of_block'];$no_of_floor=$results['no_of_floor'];$floor_details=$results['floor_details'];$building_height=$results['building_height'];$site_area=$results['site_area'];$total_area=$results['total_area'];$premise_access=$results['premise_access'];
	$road_width=$results['road_width'];$no_of_entrance=$results['no_of_entrance'];$height_clearance=$results['height_clearance'];$projection_height=$results['projection_height'];$parking_argmnt=$results['parking_argmnt'];$is_provided=$results['is_provided'];$is_provided_details=$results['is_provided_details'];$handrail_height=$results['handrail_height'];$sprinkler_system=$results['sprinkler_system'];$portable_exting=$results['portable_exting'];$public_address=$results['public_address'];$nearest_station=$results['nearest_station'];$other_info=$results['other_info'];
	if($parking_argmnt=='Y') $parking_argmnt="YES"; else $parking_argmnt="NO";
	if($is_provided=='Y'){
		$is_provided="YES";
	}else{
		$is_provided="NO"; $is_provided_details="";
	}

	if(!empty($results["owner_address"])){
		$owner_address=json_decode($results["owner_address"]);
		$owner_address_s1= $owner_address->s1;  $owner_address_s2= $owner_address->s2;  $owner_address_vill= $owner_address->vt;$owner_address_dist= $owner_address->dist;  $owner_address_block= $owner_address->block;$owner_address_pin=$owner_address->pin;
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
	$other_info = wordwrap($other_info, 30, "<br/>", true);
	$is_provided_details = wordwrap($is_provided_details, 30, "<br/>", true);
	$sql1=$fire->query("select * from fire_form1_upload where form_id='$form_id'") or die($fire->error);
	$res=$sql1->fetch_array();
	

  if(!isset($css)){
      $val1=$formFunctions->get_uploadFile($res["file1"]);
      $val2=$formFunctions->get_uploadFile($res["file2"]);
      $val3=$formFunctions->get_uploadFile($res["file3"]); 
      $val4=$formFunctions->get_uploadFile($res["file4"]);
      $val5=$formFunctions->get_uploadFile($res["file5"]);
    }else{
      $val1=$formFunctions->get_useruploadFile($res["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($res["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($res["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($res["file4"],$applicant_id);
      $val5=$formFunctions->get_useruploadFile($res["file5"],$applicant_id);
    }


	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	}else{
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	$floor_details = wordwrap($results["floor_details"], 40, "<br/>", true);
	
	
	
	
	$form_name=$formFunctions->get_formName('fire','1');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - I</title>
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
</style>
</head>
<body>';		
}else{
			$printContents='';
}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>FORM - I</h4>
  			<h4>FORM OF APPLICATION FOR "NO OBJECTION CERTIFICATE (NOC)" IN RESPECT OF FIRE SAFETY MEASURES IN '.$form_name.'  &lsquo;ASSAM FIRE SERVICE RULES 1989&rsquo;</h4>
		</div><br/>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%">To,</td><td width="95%">&nbsp;</td>
          </tr>
          <tr>
            <td width="5%"></td>
			<td width="95%">
              The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel
            </td>
          </tr>
		  <tr>
            <td width="5%">Sir,</td><td width="95%">&nbsp;</td>
          </tr>
          <tr>
			<td width=5%""></td>
            <td width="95%">I/We&nbsp;'.strtoupper($key_person).'&nbsp;on behalf of&nbsp; '.strtoupper($ownername).'&nbsp; apply for NOC in respect of Fire Prevention and Fire Safety Measures under &lsquo;Assam Fire Service Rules 1989&rsquo; for the purpose of Existing/ Proposed Multi-storeyed/ High rise building. Required documents/ information as per formate furnished below.</td>
          </tr>
        </table>
      </td>
      </tr>
      </table>
      <br/>
      <table  width="100%" class="table table-bordered table-responsive" border="1" cellpadding="1" style="text-align:top;border-collapse:collapse;">
       <tr>
        <td valign="top">1. Name and address of the Applicant</td>
        <td><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
          <tr>
          <td width="20%">Name</td>
          <td>'.strtoupper($key_person).'</td>
          </tr>
          <tr>
          <td valign="top">Address </td>
          <td>
        <table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
            <tr>
            <td width="40%">Street Name 1</td>
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
          </table></td>
          </tr>
        </table></td>
        </tr>
        
        <tr>
        <td valign="top">2. Name and Address of the owner of the premises</td>
        <td><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
          <tr>
          <td width="20%">Name</td>
          <td>'.strtoupper($owner_name).'</td>
          </tr>
          <tr>
          <td valign="top">Address </td>
          <td>
        <table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
            <tr>
            <td width="40%">Street Name 1</td>
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
          </table></td>
          </tr>
        </table></td>
        </tr>
      <tr>
        <td>3. Telephone numbers of the applicant/occupier/owner</td>
        <td>Landline No: '.strtoupper($landline_std).'-'.strtoupper($landline_no).'<br>Mobile Number: +91-'.strtoupper($mobile_no).'</td>
        </tr>
      <tr>
        <td valign="top">4. Name and Address of Architect/Consultation</td>
        <td width="50%"><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
          <tr>
          <td  width="20%">Name</td>
          <td>'.strtoupper($consultant_name).'</td>
          </tr>
          <tr>
          <td valign="top">Address</td>
          <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
            <tr>
            <td width="40%">Street Name 1</td>
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
          </table></td>
          </tr>
        </table></td>
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
        <td valign="top">12. Surrounding properties:</td>
        <td><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
          <tr>
          <td width="20%">East</td>
          <td >'.strtoupper($surround_prop_e).'</td>
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
        </table></td>
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
        <td valign="top">16. Width  of open space</td>
        <td><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
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
        </table></td>
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
        <td valign="top">43. Any other information which is to be included in the NOC</td>
        <td>'.strtoupper($other_info).'</td>
        </tr>
        <tr>
        <td valign="top" colspan="2">44. Checklist. <br/>* NA - Not Applicable <br/>* SC - Send by Courier</td>
      </tr>
      <tr>
        <td colspan="2">
          <table  width="100%" class="table table-bordered table-responsive" border="1" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
          <td width="50%">1. Site plan showing all the legends</td>
          <td>'.$val1.'</td></tr>
          <tr>
          <td>2. Layout plan</td>
          <td>'.$val2.'</td></tr>
          <tr>
          <td>3. Service plan</td>
          <td>'.$val3.'</td></tr>
          <tr>
          <td>4. Elevation plan/ Section Plan for proposed building</td>
          <td>'.$val4.'</td></tr>
          <tr>
          <td>5. In case of existing building copy of Construction permission/ Trade License issued by the concern authorities.</td>
          <td>'.$val5.'</td></tr>
          </table>
          ';

    if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
      $printContents=$printContents.'
      <tr>       
      <td colspan="2">
        <table class="table table-bordered table-responsive" border="1" style="text-align:top;border-collapse:collapse;" width="100%">
          <tr><td colspan="2">Courier Details.</td></tr>
          <tr><td width="50%">Name of Courier Service </td><td >'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
    } 
  $printContents=$printContents.'  
        </td>
        </tr>
        
        <tr>
        <td colspan="2">
        <table class="table table-bordered table-responsive" width="100%" border="1" style="border-collapse:collapse">
          <tr>
           <td width="50%">Place: '.strtoupper($dist).'<br/>Date: '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">
          '.strtoupper($key_person).'<br/>
          Signature of the Applicant<br/>
          (Owner/ Signing Authority)</td>
          </tr>
        </table>
        </td>
        </tr>';
      
	  
	$compliance_report_details=$fire->query("select * from compliance_report where uain='$uain' and active='0' and officer_id='0'");
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
	
	$printContents=$printContents.'</table>';
	  
	  
?>