<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
		if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();
				$form_id=$results['form_id'];
				$owner_name=$results['owner_name'];$consultant_name=$results['consultant_name'];$no_of_block=$results['no_of_block'];$no_of_floor=$results['no_of_floor'];$floor_details=$results['floor_details'];$building_height=$results['building_height'];$site_area=$results['site_area'];$total_area=$results['total_area'];$premise_access=$results['premise_access'];
				$road_width=$results['road_width'];$no_of_entrance=$results['no_of_entrance'];$height_clearance=$results['height_clearance'];$projection_height=$results['projection_height'];$parking_argmnt=$results['parking_argmnt'];$is_provided=$results['is_provided'];$is_provided_details=$results['is_provided_details'];$handrail_height=$results['handrail_height'];$sprinkler_system=$results['sprinkler_system'];$portable_exting=$results['portable_exting'];$public_address=$results['public_address'];$nearest_station=$results['nearest_station'];$other_info=$results['other_info'];
				
				if(!empty($results["owner_address"])){
					$owner_address=json_decode($results["owner_address"]);
					$owner_address_s1= $owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vill=$owner_address->vill;$owner_address_dist= $owner_address->dist;$owner_address_block= $owner_address->block;$owner_address_pin=$owner_address->pin;
				}else{
					$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";$owner_address_std="";$owner_address_land="";$owner_address_mobile="";  
				}
				if(!empty($results["no_of"])){
					$no_of=json_decode($results["no_of"]);
					$no_of_staircase= $no_of->staircase;$no_of_loc_stair= $no_of->loc_stair;$no_of_stair_width= $no_of->stair_width;$no_of_treads_width= $no_of->treads_width;$no_of_risers_height= $no_of->risers_height;$no_of_no_risers= $no_of->no_risers;
				}else{
					$no_of_staircase="";$no_of_loc_stair="";$no_of_stair_width="";$no_of_treads_width="";$no_of_risers_height="";$no_of_no_risers="";
				}
				if(!empty($results["consultant_address"])){
					$consultant_address=json_decode($results["consultant_address"]);
					$consultant_address_s1= $consultant_address->s1; $consultant_address_s2= $consultant_address->s2;$consultant_address_vt= $consultant_address->vt; $consultant_address_dist= $consultant_address->dist;
					$consultant_address_block= $consultant_address->b;	$consultant_address_pin=$consultant_address->pin;
				}else{
					$consultant_address_s1="";$consultant_address_s2="";$consultant_address_vt="";$consultant_address_dist="";$consultant_address_block="";$consultant_address_pin="";
				}
				if(!empty($results["provided"])){
					$provided=json_decode($results["provided"]);
					$provided_height= $provided->height;$provided_parking= $provided->parking; $provided_num_rams= $provided->num_rams;$provided_num_staircase= $provided->num_staircase; $provided_loc_stair= $provided->loc_stair;$provided_stair_width= $provided->stair_width;	$provided_treads_width=$provided->treads_width;$provided_risers_height=$provided->risers_height;$provided_no_risers=$provided->no_risers;
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
					 $surround_prop_e=$surround_prop->e; $surround_prop_w=$surround_prop->w; $surround_prop_n=$surround_prop->n;
					 $surround_prop_s=$surround_prop->s;
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
			}else{
				$no_of_block="";$no_of_floor="";$floor_details="";$building_height="";$site_area="";$total_area="";$premise_access="";$road_width="";$no_of_entrance="";$height_clearance="";$projection_height="";$parking_argmnt="";$is_provided="";$is_provided_details="";$handrail_height="";$sprinkler_system="";$portable_exting="";$public_address="";$public_address="";$nearest_station="";$other_info="";
				$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width= "";$os_width_f= ""; $os_width_r="";$os_width_sa= "";$os_width_sb ="";$no_of_staircase="";$no_of_loc_stair="";$no_of_stair_width="";$no_of_treads_width="";$no_of_risers_height="";$no_of_no_risers="";$part_hr_clearence="";$part_travel_distance="";$part_no_of_lifts="";$part_capacity_of_lift="";$type_of_door="";$type_service_duct="";$type_standby_gen="";$type_ac="";$type_wetrisers="";$type_tanks_capacity="";$type_alarm= "";  $type_detect_system="";
				$owner_name="";$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";$owner_address_std="";$owner_address_land="";$owner_address_mobile="";$consultant_name="";$consultant_address_s1="";$consultant_address_s2="";$consultant_address_vt="";$consultant_address_dist="";$consultant_address_block="";$consultant_address_pin="";
			}
		}else{
			$results=$q->fetch_array();
			$form_id=$results['form_id'];
			$owner_name=$results['owner_name'];$consultant_name=$results['consultant_name'];$no_of_block=$results['no_of_block'];$no_of_floor=$results['no_of_floor'];$floor_details=$results['floor_details'];$building_height=$results['building_height'];$site_area=$results['site_area'];$total_area=$results['total_area'];$premise_access=$results['premise_access'];
			$road_width=$results['road_width'];$no_of_entrance=$results['no_of_entrance'];$height_clearance=$results['height_clearance'];$projection_height=$results['projection_height'];$parking_argmnt=$results['parking_argmnt'];$is_provided=$results['is_provided'];$is_provided_details=$results['is_provided_details'];$handrail_height=$results['handrail_height'];$sprinkler_system=$results['sprinkler_system'];$portable_exting=$results['portable_exting'];$public_address=$results['public_address'];$nearest_station=$results['nearest_station'];$other_info=$results['other_info'];
			
			if(!empty($results["owner_address"])){
				$owner_address=json_decode($results["owner_address"]);
				$owner_address_s1= $owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vill=$owner_address->vill;$owner_address_dist= $owner_address->dist;$owner_address_block= $owner_address->block;$owner_address_pin=$owner_address->pin;
			}else{
				$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";$owner_address_std="";$owner_address_land="";$owner_address_mobile="";  
			}
			if(!empty($results["no_of"])){
				$no_of=json_decode($results["no_of"]);
				$no_of_staircase= $no_of->staircase;$no_of_loc_stair= $no_of->loc_stair;$no_of_stair_width= $no_of->stair_width;$no_of_treads_width= $no_of->treads_width;$no_of_risers_height= $no_of->risers_height;$no_of_no_risers= $no_of->no_risers;
			}else{
				$no_of_staircase="";$no_of_loc_stair="";$no_of_stair_width="";$no_of_treads_width="";$no_of_risers_height="";$no_of_no_risers="";
			}
			if(!empty($results["consultant_address"])){
				$consultant_address=json_decode($results["consultant_address"]);
				$consultant_address_s1= $consultant_address->s1; $consultant_address_s2= $consultant_address->s2;$consultant_address_vt= $consultant_address->vt; $consultant_address_dist= $consultant_address->dist;
				$consultant_address_block= $consultant_address->b;	$consultant_address_pin=$consultant_address->pin;
			}else{
				$consultant_address_s1="";$consultant_address_s2="";$consultant_address_vt="";$consultant_address_dist="";$consultant_address_block="";$consultant_address_pin="";
			}
			if(!empty($results["provided"])){
				$provided=json_decode($results["provided"]);
				$provided_height= $provided->height;$provided_parking= $provided->parking; $provided_num_rams= $provided->num_rams;$provided_num_staircase= $provided->num_staircase; $provided_loc_stair= $provided->loc_stair;$provided_stair_width= $provided->stair_width;	$provided_treads_width=$provided->treads_width;$provided_risers_height=$provided->risers_height;$provided_no_risers=$provided->no_risers;
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
				 $surround_prop_e=$surround_prop->e; $surround_prop_w=$surround_prop->w; $surround_prop_n=$surround_prop->n;
				 $surround_prop_s=$surround_prop->s;
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
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
							  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART 2</a></li>
							  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART 3</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4">1. Name and address of the Applicant :</td>
										</tr>
										<tr>
											<td width="25%"> Applicant's Name</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td width="25%"> Street Name 1</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name1;?>" disabled="disabled"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td> Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $vill;?>" disabled="disabled"></td>
											<td> District</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td> State </td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $block;?>" disabled="disabled"></td>
										
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
										   <td></td>
										   <td></td>
										</tr>
										<tr>
											<td colspan="3">2. Name and Address of the owner of the premises :<span class="mandatory_field">*</span></td>
										</tr>									
										<tr>
											<td>Name</td>
											<td><input type="text" class="form-control text-uppercase" required="required"  validate="letters" name="owner_name" id="street3" value="<?php echo $owner_name;?>"/></td>
										</tr> 
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[s1]" value="<?php echo $owner_address_s1;?>"/></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="owner_address[s2]" value="<?php echo $owner_address_s2;?>"/></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[vill]" value="<?php echo $owner_address_vill;?>"/></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[dist]" value="<?php echo $owner_address_dist;?>"/></td>
										</tr>
										<tr>
											<td>Block</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[block]" value="<?php echo $owner_address_block;?>"/></td>
											<td>Pincode</td>
											<td><input type="text" maxlength="6" class="form-control text-uppercase" required="required" name="owner_address[pin]" validate="pincode" id="pin1" value="<?php echo $owner_address_pin;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">3. Telephone numbers of the applicant/occupier/owner :</td>
										</tr>
										<tr>
											<td>Mobile no </td>
											<td><input type="text" class="form-control" name="onbehalf" id="onbehalf"  value="<?php echo "+91 - ".$mobile_no; ?>" disabled="disabled"></td>
											<td>Landline no</td>
											<td><input type="text" class="form-control" name="onbehalf" id="onbehalf"  value="<?php echo $landline_std." - ".$landline_no;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td colspan="3">4. Name and address of Architect/Consultation :<span class="mandatory_field">*</span> </td>
										</tr>
										<tr>
											 <td>Name</td>
											<td><input type="text" required="required" validate="letters" class="form-control text-uppercase" name="consultant_name" id="aname" value="<?php echo $consultant_name;?>" /> </td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>Street Name 1 </td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase" required="required" name="consultant_address[s1]" id="street6" value="<?php echo $consultant_address_s1;?>"/></td>
										
											<td>Street Name 2</td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase"  name="consultant_address[s2]" id="street6" value="<?php echo $consultant_address_s2;?>"/></td>
										</tr>
										<tr>
											<td>Village/Town </td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase" required="required" name="consultant_address[vt]" id="vill2" value="<?php echo $consultant_address_vt; ?>"/></td>
											<td>District </td>
											<td><input type="text" class="form-control text-uppercase" required="required" name="consultant_address[dist]" placeholder="" id="consultant_address_dist" value="<?php echo $consultant_address_dist;?>"/></td>
										</tr>
										<tr>
											<td>Block </td>
											<td><input type="text" class="form-control text-uppercase" required="required" name="consultant_address[b]" placeholder="" id="consultant_address_block" value="<?php echo $consultant_address_block;?>"/></td>
											<td>Pincode </td>
											<td><input type="text" class="form-control text-uppercase"  name="consultant_address[pin]"  validate="pincode"  maxlength="6"   value="<?php echo $consultant_address_pin;?>"required="required" /></td>
										</tr>
										<tr>			
											<td>5. Number of blocks/ building :<span class="mandatory_field">*</span>  </td>
											<td><input type="text" class="form-control text-uppercase" required="required" validate="onlyNumbers" name="no_of_block" placeholder="" id="no_of_block" value="<?php echo $no_of_block;?>"/></td>
											<td>6. Number of floor in each block/ buildings :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required"  name="no_of_floor" validate="onlyNumbers" placeholder="" id="no_of_floor" value="<?php echo $no_of_floor;?>"/></td>
										</tr>
										<tr>
											<td>7. Floor-wise details of occupancy :<span class="mandatory_field">*</span> </td>
											<td><textarea type="text" class="form-control text-uppercase" required="required"  name="floor_details" placeholder="" id="floor_details"><?php echo $floor_details;?></textarea></td>
											<td>8. Height of the building :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required"  name="building_height" placeholder="" id="building_height" value="<?php echo $building_height;?>"/></td>
										</tr>
										<tr>
											<td>9. Site area :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required" name="site_area" placeholder="" id="site_area" value="<?php echo $site_area;?>"/></td>
											<td>10. Total built up area floor :&emsp;&emsp;&emsp;<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required" name="total_area" placeholder="" id="total_area" value="<?php echo $total_area;?>"/></td>
										</tr>			
										<tr>
											<td class="text-center" colspan="4">
											<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id=""  class="table table-responsive">
										<tr>
											<td width="25%">11. Accessibility to the premises :<span class="mandatory_field">*</span> </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="premise_access" id="premise_access" placeholder="Accessibility to Premises" value="<?php echo $premise_access;?>"/></td>
										</tr>
										<tr>
											<td colspan="4">12. Surrounding properties :<span class="mandatory_field">*</span>  </td>
										</tr>
										<tr>	
											<td width="25%">East</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="surround_prop[e]" validate="jsonObj" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"/></td>
											<td width="25%">West</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="surround_prop[w]" required="required" validate="jsonObj" id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"/></td>
										</tr>
										<tr>
											<td>North </td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase" name="surround_prop[n]" required="required"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"/></td>
										  
											<td>South</td>
											<td><input type="text" validate="jsonObj"  class="form-control text-uppercase" name="surround_prop[s]" required="required" placeholder="" id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"/></td>
										</tr>
										<tr>
											<td>13. Width of the abutting road/ roads and condition( Hard surfaced or not) :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" name="road_width" required="required" placeholder="" id="road_width" value="<?php echo $road_width;?>"/></td>
										</tr>
										<tr>
											<td>14. Number of entrances and width of each entrance to the premises :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" name="no_of_entrance" required="required" id="no_of_entrance" value="<?php echo $no_of_entrance;?>"/></td>
											<td>15. Height clearance :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" name="height_clearance" required="required" id="height_clearance" value="<?php echo $height_clearance;?>"/></td>
										</tr>
										<tr>			
											<td colspan="3">16. Width of open space  :<span class="mandatory_field">*</span> </td>
										</tr>	
										<tr>
											<td>Front</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" placeholder="" name="os_width[f]" id="os_width" value="<?php echo $os_width_f;?>"/></td>
											<td>Rear</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[r]" required="required" placeholder="" id="rear" value="<?php echo $os_width_r;?>"/></td>
										 </tr>
										<tr>
											<td>Side A</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[sa]" required="required" placeholder="" id="sideA" value="<?php echo $os_width_sa;?>"/></td>
											<td>Side B</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[sb]" required="required" placeholder="" id="sideB" value="<?php echo $os_width_sb;?>"/></td>
										</tr>
										<tr>
											<td>17. Canopy or balcony projection provided.<br/> If so at what height(metre) :</td>
											<td><input type="text" class="form-control text-uppercase" name="projection_height" validate="onlyNumbers" id="projection_height" value="<?php echo $projection_height;?>"/></td>
											<td>18. Arrangement for parking the cars :</td>
											<td>
											<input type="radio" value="Y" name="parking_argmnt" <?php if($parking_argmnt=='Y') echo 'checked'; ?> /> YES&emsp;&emsp;&emsp;
											<input type="radio" value="N" name="parking_argmnt" <?php if($parking_argmnt=='N' || $parking_argmnt=='') echo 'checked'; ?>/> NO
											</td>
										</tr>
										<tr>
											<td>19. If basement is provided, number of rams available For the vehicles to reach the basement and it’s location :<span class="mandatory_field">*</span> </td>
											<td>
												<input type="radio" required value="Y" name="is_provided" <?php if($is_provided=='Y') echo 'checked'; ?> /> YES	&emsp;&emsp;&emsp;
												<input type="radio" value="N" name="is_provided" <?php if($is_provided=='N' || $is_provided=='') echo 'checked'; ?>/> NO
											</td>
											<td><textarea type="text" class="form-control text-uppercase" name="is_provided_details" id="is_provided_details" <?php if ($is_provided=='N') echo 'disabled'; ?> /> <?php echo $is_provided_details; ?></textarea>						 
											</td>
											<td></td>
										</tr>
										<tr>
											<td>20. Number of Staircase :</td>
											<td><input type="text"  class="form-control text-uppercase" validate="onlyNumbers"  name="no_of[staircase]" id="no_of_staircase" value="<?php echo $no_of_staircase;?>"/></td>
											<td>21. Location of the staircases (extended to the basement or terminated at ground floor level) :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="no_of[loc_stair]" id="staircase_loc" value="<?php echo $no_of_loc_stair;?>"/></td>
										</tr>
										<tr>
											<td>22. Width of staircase :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="no_of[stair_width]" id="staircase_width" value="<?php echo $no_of_stair_width;?>"/></td>
											<td>23. Width of treads :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="no_of[treads_width]" id="treads_width" value="<?php echo $no_of_treads_width;?>"/></td>
										</tr>
										<tr>
											<td>24. Height of risers :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="no_of[risers_height]" id="risers_height" value="<?php echo $no_of_risers_height;?>"/></td>
											<td>25. Number of risers in a flight :</td>
											<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers"   name="no_of[no_risers]" id="no_of_risers" value="<?php echo $no_of_no_risers;?>"/></td>
										</tr>
									</table>			
										<div align="center">
										<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
										<button type="submit"  style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success submit1">Save and Next</button>
										</div>	
									</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id=""  class="table table-responsive">
										<tr>
											<td width="25%">26. Height of hand rails :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="handrail_height" id="handrail_height" value="<?php echo $handrail_height;?>"/></td>
											<td width="25%">27. Headroom clearance :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" validate="jsonObj" name="part[hr_clearence]" id="hr_clearence" value="<?php echo $part_hr_clearence;?>"/></td>
										</tr>
										<tr>
											<td>28. Travel distance from the farthest point and from the dead end of the corridor to the staircase :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="part[travel_distance]" id="travel_distance" value="<?php echo $part_travel_distance;?>"/></td>
											<td>29. Number of lifts :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  required="required" name="part[no_of_lifts]" id="no_of_lifts" value="<?php echo $part_no_of_lifts;?>"/></td>
										</tr>
										<tr>
											<td>30. Capacity of each lift :<span class="mandatory_field">*</span> </td>
											 <td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="part[capacity_of_lift]" id="capacity_of_lift" value="<?php echo $part_capacity_of_lift;?>"/></td>
											<td>31. Type of door provided at lift car and at each landing :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[of_door]" id="type_of_door" value="<?php echo $type_of_door;?>"/></td>
										</tr>
										<tr>
											<td>32. Whether service ducts are provided.<br/> If so whether the ducts are sealed at each floor level :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[service_duct]" id="service_duct" value="<?php echo $type_service_duct;?>"/></td>
											<td>33. Standby generator is available or not. <br/> If not what capacity is required to provide service to all the emergency provisions in the building :</td>
											<td><input type="text" class="form-control text-uppercase" jstag="validateNotSpecialChar" name="type[standby_gen]" id="standby_gen" value="<?php echo $type_standby_gen;?>"/></td>
										</tr>
										<tr>
											<td>34. Air conditioned or not. <br/>If air conditioned, the type :</td>
											<td><input type="text" class="form-control text-uppercase" jstag="validateNotSpecialChar" name="type[ac]" id="ac_type" value="<?php echo $type_ac;?>"/></td>
											<td>35. Type and number of wet risers/down comer to be proposed to be provided in the building :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="type[wetrisers]" id="wetrisers_type" value="<?php echo $type_wetrisers;?>"/></td>
										</tr>
										<tr>
											<td>36. Capacity of overhead/underground tanks proposed :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="type[tanks_capacity]" id="tanks_capacity" value="<?php echo $type_tanks_capacity;?>"/></td>
											<td>37. Type of fire alarm system proposed :</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="type[alarm]" id="alerm_type" value="<?php echo $type_alarm;?>"/></td>
										</tr>
										<tr>
											<td>38. Type of detection system proposed :&emsp;&emsp;&emsp;</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="type[detect_system]" id="detect_system" value="<?php echo $type_detect_system;?>"/></td>
											<td>39. Sprinkler system. If proposed where : &emsp;&emsp;&emsp;</td>
											<td><input type="text" class="form-control text-uppercase" name="sprinkler_system" id="sprinkler_system" value="<?php echo $sprinkler_system;?>"/></td>
										</tr>
										<tr>			
											<td>40. Area-wise details of the type and number of portable extinguishers proposed to be provided in the building :</td>
											<td><input type="text" class="form-control text-uppercase" name="portable_exting" id="portable_exting" value="<?php echo $portable_exting;?>"/></td>
											<td>41. Public address system proposed :</td>
											<td><input type="text" class="form-control text-uppercase" name="public_address" id="public_address" value="<?php echo $public_address;?>"/></td>
										</tr>
										<tr>			
											<td>42. Nearest fire &amp; Emergency Service Station :<span class="mandatory_field">*</span> </td>
                                             <td>
											<!-- <input type="text" class="form-control text-uppercase" name="nearest_station" id="nearest_station" value="<?php //echo $nearest_station;?>"/>-->
											
											<?php 
											//$b_dist_id=$formFunctions->get_district_id($b_dist);	
											$fire_stations=$formFunctions->executeQuery($dept,"select * from nearest_fire_stations where district_id='$b_dist_id'"); ?>
											<select name="nearest_station" class="form-control text-uppercase" required="required">
												<option value="">Please Select Nearest Fire Station</option>
												<?php while($rows=$fire_stations->fetch_object()) {
													if(isset($nearest_station) && ($nearest_station==$rows->id)){
														$s='selected'; 
													}else{
														$s='';
													}  ?>
													<option value="<?php echo $rows->id; ?>" <?php echo $s;?>><?php echo $rows->nearest_fire_station; ?></option>
												<?php }		?>
											</select>
											
											 </td>
											
											<td>43. Any other information which is to be included in the N.O.C. :</td>
											<td><textarea  class="form-control text-uppercase" validate="textarea" name="other_info" id="other_info" ><?php echo $other_info;?></textarea></td>
										</tr>									
									</table>
										<div align="center">
										<a type="button" href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
										<button type="submit"  style="font-weight:bold" name="save<?php echo $form; ?>c" class="btn btn-success submit1">Save and Next</button>
										</div>	
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
  <!-- /.content-wrapper -->
 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
<?php if($is_provided=="N"){ ?>
	$('#is_provided').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_provided"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_provided_details').attr('disabled', 'disabled');
		else
			$('#is_provided_details').removeAttr('disabled');
	});		
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>