<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('fire','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=fire';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=fire';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);
include "save_form2.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);	
	$name_of_owner=$row1['Name_of_owner'];$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$no_of_block="";$no_of_floor="";$floor_details="";$building_height="";$site_area="";$total_area="";$premise_access="";$road_width="";$no_of_entrance="";$height_clearance="";$projection_height="";$parking_argmnt="";$is_provided="";$is_provided_details="";$handrail_height="";$sprinkler_system="";$portable_exting="";$public_address="";$public_address="";$nearest_station="";$other_info="";
	$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width= "";$os_width_f= ""; $os_width_r="";$os_width_sa= "";$os_width_sb ="";$no_of_staircase="";$no_of_loc_stair="";$no_of_stair_width="";$no_of_treads_width="";$no_of_risers_height="";$no_of_no_risers="";$part_hr_clearence="";$part_travel_distance="";$part_no_of_lifts="";$part_capacity_of_lift="";$type_of_door="";$type_service_duct="";$type_standby_gen="";$type_ac="";$type_wetrisers="";$type_tanks_capacity="";$type_alarm= "";  $type_detect_system="";$file1="";$file2="";$file3="";$file4="";$file5="";
	$owner_name="";$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";$owner_address_std="";$owner_address_land="";$owner_address_mobile="";$consultant_name="";$consultant_address_s1="";$consultant_address_s2="";$consultant_address_vt="";$consultant_address_dist="";$consultant_address_block="";$consultant_address_pin="";
	
	$q=$fire->query("select * from fire_form1 where user_id='$swr_id' and active='1'") or die($fire->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){	 
		$form_id=$results['form_id'];
		$q=$fire->query("select * from fire_form1_upload where form_id='$form_id' ") or die($fire->error);
		$results3=$q->fetch_assoc();
		$owner_name=$results['owner_name'];$consultant_name=$results['consultant_name'];$no_of_block=$results['no_of_block'];$no_of_floor=$results['no_of_floor'];$floor_details=$results['floor_details'];$building_height=$results['building_height'];$site_area=$results['site_area'];$total_area=$results['total_area'];$premise_access=$results['premise_access'];
		$road_width=$results['road_width'];$no_of_entrance=$results['no_of_entrance'];$height_clearance=$results['height_clearance'];$projection_height=$results['projection_height'];$parking_argmnt=$results['parking_argmnt'];$is_provided=$results['is_provided'];$is_provided_details=$results['is_provided_details'];$handrail_height=$results['handrail_height'];$sprinkler_system=$results['sprinkler_system'];$portable_exting=$results['portable_exting'];$public_address=$results['public_address'];$nearest_station=$results['nearest_station'];$other_info=$results['other_info'];
		$file1=$results3["file1"];$file2=$results3["file2"];$file3=$results3["file3"];$file4=$results3["file4"];$file5=$results3["file5"];
		
		if(!empty($results["owner_address"])){
			$owner_address=json_decode($results["owner_address"]);
			$owner_address_s1= $owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vill= $owner_address->vt;$owner_address_dist= $owner_address->dist;$owner_address_block= $owner_address->block;$owner_address_pin=$owner_address->pin;
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
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}

##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Ease of doing business | Govt. of Assam</title>
<!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php require '../../../user_area/includes/css.php';?>
          <style>
			/* Over writes AdminLTE form styles */
			p{text-align: justify;}
			.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
			.form-control text-uppercase{
				background-color: #fff;
				background-image: none;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
				color: #555;
				display: block;
				font-size: 14px;
				height: 34px;
				line-height: 1.42857;
				padding: 6px 12px;
				transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
				width: 100%;
			}
		</style>
     </head>
      <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	  <div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
      <div class="wrapper">
  <?php require '../../../user_area/includes/header.php'; ?>
  <?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<section class="content-header"></section>
				<section class="content">
					<?php require '../includes/banner.php'; ?>
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4 class="text-center" >
										<strong>FORM NO. 1 <br/><?php echo $form_name=$formFunctions->get_formName('fire','1');?> </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
									  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART 2</a></li>
									  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART 3</a></li>
									  <li class="<?php echo $tabbtn4; ?>"><a href="#table4">UPLOAD</a></li>
									 
									</ul>
									<br>
									<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
			<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
							
								<table class="table table-responsive">
								
							
								<tr>
									<td colspan="4">1. Name and address of the Applicant</td>
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
							<td colspan="3">2. Name and Address of the owner of the premises:</td>
							
						 </tr>	
								
					  <tr>
						<td>Name</td>
						<td><input type="text" class="form-control text-uppercase" required="required"  validate="letters" name="owner_name" id="street3" value="<?php echo $owner_name;?>"/></td>
					  </tr> 
					  <tr>
						<td>Street Name 1</td>
						<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[s1]" id="street3"  value="<?php echo $owner_address_s1;?>"/></td>
					  
						<td>Street Name 2</td>
						<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="owner_address[s2]" id="street4" value="<?php echo $owner_address_s2;?>"/></td>
					  </tr>
					  <tr>
							<td>Village/Town</td>
							<td><input type="text" class="form-control text-uppercase" validate="jsonObj" required="required" name="owner_address[vt]" id="vill1" value="<?php echo $owner_address_vill;?>"/></td>
					 
							<td>District</td>
							<td>
								<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
									<select name="owner_address[dist]" class="form-control text-uppercase" id="dist1" required="required">
										<option value="">Select District</option>
										<?php while($rows_dist=$dstresult->fetch_object()) {
											if(isset($owner_address_dist) && ($owner_address_dist==$rows_dist->district)){
												$s='selected'; 
											}else{
												$s='';
											}  ?>
											<option value="<?php echo $rows_dist->district; ?>" <?php echo $s;?>><?php echo $rows_dist->district; ?></option>
										<?php }		?>
									</select>										
									<font class="compulsory"> <?php if(isset($code) && $code == 4){echo $errorMsg ;}?></font>
								</td>
						</tr>
						<tr>
						<td>Block</td>
							<td id="blockdiv2">
									<select name="owner_address[block]" class="form-control text-uppercase" id="block1" >
										<?php if(isset($owner_address_block) && ($owner_address_block!="")){ ?>
											<option value="<?php echo $owner_address_block; ?>"><?php echo $owner_address_block; ?></option>
										<?php }else{ ?>
										<option value=""> Select Block</option>
										<?php } ?>
									</select>
							</td>					  
							<td>Pincode</td>
							<td><input type="text" maxlength="6" class="form-control text-uppercase" required="required" name="owner_address[pin]" validate="pincode" id="pin1" value="<?php echo $owner_address_pin;?>" /></td>
					  </tr>
								
						<tr>
							<td colspan="4">3. Telephone numbers of the applicant/occupier/owner </td>
						</tr>
						<tr>
									<td>Mobile no </td>
									
									<td><input type="text" class="form-control" name="onbehalf" id="onbehalf"  value="<?php echo "+91 - ".$mobile_no; ?>" disabled="disabled">
									</td>
									<td>Landline no</td>
									<td><input type="text" class="form-control" name="onbehalf" id="onbehalf"  value="<?php echo $landline_std." - ".$landline_no;?>" disabled="disabled"></td>
						</tr>
						<tr>
							<td colspan="3">4. Name and address of Architect/Consultation:</td>
						</tr>
						<tr>
										 <td>Name</td>
										<td><input type="text" required="required" validate="letters" class="form-control text-uppercase" name="consultant_name" id="aname" value="<?php echo $consultant_name;?>" /> </td>
										<td></td>
										<td></td>
						</tr>
						  <tr>
											<td>Street Name 1</td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase" required="required" name="consultant_address[s1]" id="street6" value="<?php echo $consultant_address_s1;?>"/></td>
										
											<td>Street Name 2</td>
											<td><input type="text" validate="jsonObj" class="form-control text-uppercase"  name="consultant_address[s2]" id="street6" value="<?php echo $consultant_address_s2;?>"/></td>
										  </tr>
										   <tr>
												<td>Village/Town</td>
												<td><input type="text" validate="jsonObj" class="form-control text-uppercase" required="required" name="consultant_address[vt]" id="vill2" value="<?php echo $consultant_address_vt; ?>"/></td>
											  
												<td>District</td>
												<td>
												<?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC") OR die("Error : ".$mysqli->error); ?>
												<select name="consultant_address[dist]" id="dist2" class="form-control text-uppercase" required="required">
													<option value="">Select District</option>
													<?php while($rows_dist=$dstresult->fetch_object()) {
														if(isset($consultant_address_dist) && ($consultant_address_dist==$rows_dist->district)){
															$s='selected'; 
														}else{
															$s='';
														}  ?>
														<option value="<?php echo $rows_dist->district; ?>" <?php echo $s;?>><?php echo $rows_dist->district; ?></option>
													<?php }		?>
												</select>										
												<font class="compulsory"> <?php if(isset($code) && $code == 4){echo $errorMsg ;}?></font>
												</td>
											  </tr>
											 <tr>
												<td>Block</td>
												<td><select class="form-control text-uppercase" name="consultant_address[b]" id="block2" >
												<?php if(isset($consultant_address_block) && ($consultant_address_block!="")){ ?>
														<option value="<?php echo $consultant_address_block; ?>"><?php echo $consultant_address_block; ?></option>
													<?php }else{ ?>
													<option value=""> Select Block</option>
													<?php } ?>
											   </select> </td>
											  
												<td>Pincode</td>

										 <td>
										 <input type="text" class="form-control text-uppercase"  name="consultant_address[pin]"  validate="pincode"  maxlength="6"   value="<?php echo $consultant_address_pin;?>"required="required" /></td>
											  </tr>
										
									
						
						<tr>			
							<td>5. Number of blocks/ building: </td>
							<td><input type="text" class="form-control text-uppercase" required="required" validate="onlyNumbers" name="no_of_block" placeholder="" id="no_of_block" value="<?php echo $no_of_block;?>"/></td>
						
							<td>6. Number of floor in each block/ buildings:</td>
							<td><input type="text" class="form-control text-uppercase" required="required"  name="no_of_floor" validate="onlyNumbers" placeholder="" id="no_of_floor" value="<?php echo $no_of_floor;?>"/></td>
						</tr>
						<tr>
							<td>7. Floor-wise details of occupancy:</td>
							<td><textarea type="text" class="form-control text-uppercase" required="required"  name="floor_details" placeholder="" id="floor_details"><?php echo $floor_details;?></textarea></td>
						
							<td>8. Height of the building:</td>
							<td><input type="text" class="form-control text-uppercase" required="required"  name="building_height" placeholder="" id="building_height" value="<?php echo $building_height;?>"/></td>
						</tr>
						<tr>
							<td>9. Site area:</td>
							<td><input type="text" class="form-control text-uppercase" required="required" name="site_area" placeholder="" id="site_area" value="<?php echo $site_area;?>"/></td>
						
							<td>10. Total built up area floor :&emsp;&emsp;&emsp;</td>
							<td><input type="text" class="form-control text-uppercase" required="required" name="total_area" placeholder="" id="total_area" value="<?php echo $total_area;?>"/></td>
						</tr>			
						<tr>
							<td class="text-center" colspan="4">
							<button type="submit" style="font-weight:bold" name="save1a" class="btn btn-success submit1">Save and Next</button>
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
							<td width="25%">11. Accessibility to the premises:</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="premise_access" id="premise_access" placeholder="Accessibility to Premises" value="<?php echo $premise_access;?>"/></td>
						</tr>
						<tr>
							<td colspan="4">12. Surrounding properties:</td>
						</tr>
						<tr>	
								<td width="25%">East</td>
								<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="surround_prop[e]" validate="jsonObj" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"/></td>
							  
								<td width="25%">West</td>
								<td width="25%"><input type="text" class="form-control text-uppercase" name="surround_prop[w]" required="required" validate="jsonObj" id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"/></td>
					  </tr>
					  <tr>
								<td>North</td>
								<td><input type="text" validate="jsonObj" class="form-control text-uppercase" name="surround_prop[n]" required="required"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"/></td>
							  
								<td>South</td>
								<td><input type="text" validate="jsonObj"  class="form-control text-uppercase" name="surround_prop[s]" required="required" placeholder="" id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"/></td>
					</tr>
					<tr>
							<td>13. Width of the abutting road/ roads and condition( Hard surfaced or not):</td>
							<td><input type="text" class="form-control text-uppercase" name="road_width" required="required" placeholder="" id="road_width" value="<?php echo $road_width;?>"/></td>
						</tr>
						
						<tr>
							<td>14. Number of entrances and width of each entrance to the premises:</td>
							<td><input type="text" class="form-control text-uppercase" name="no_of_entrance" required="required" id="no_of_entrance" value="<?php echo $no_of_entrance;?>"/></td>
						
							<td>15. Height clearance </td>
							<td><input type="text" class="form-control text-uppercase" name="height_clearance" required="required" id="height_clearance" value="<?php echo $height_clearance;?>"/></td>
						</tr>
						
						<tr>			
							<td colspan="3">16. Width of open space  :</td>
							
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
							<td>17. Canopy or balcony projection provided.<br/> If so at what height(metre):</td>
							<td><input type="text" class="form-control text-uppercase" name="projection_height" validate="onlyNumbers" id="projection_height" value="<?php echo $projection_height;?>"/></td>
						
							<td>18. Arrangement for parking the cars:</td>
							<td>
							<input type="radio" value="Y" name="parking_argmnt" <?php if($parking_argmnt=='Y') echo 'checked'; ?> /> YES&emsp;&emsp;&emsp;
							<input type="radio" value="N" name="parking_argmnt" <?php if($parking_argmnt=='N' || $parking_argmnt=='') echo 'checked'; ?>/> NO
							</td>
						</tr>
						<tr>
							<td>19. If basement is provided, number of rams available For the vehicles to reach the basement and it’s location:</td>
							<td>
								<input type="radio" required value="Y" name="is_provided" <?php if($is_provided=='Y') echo 'checked'; ?> /> YES	&emsp;&emsp;&emsp;
								<input type="radio" value="N" name="is_provided" <?php if($is_provided=='N' || $is_provided=='') echo 'checked'; ?>/> NO
							  </td>
							<td><textarea type="text" class="form-control text-uppercase" name="is_provided_details" id="is_provided_details" <?php if ($is_provided=='N') echo 'disabled'; ?> /><?php echo $is_provided_details; ?></textarea>						 
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
							<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="no_of[stair_width]" id="staircase_width" value="<?php echo $no_of_stair_width;?>"/></td>
						
							<td>23. Width of treads:</td>
							<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="no_of[treads_width]" id="treads_width" value="<?php echo $no_of_treads_width;?>"/></td>
						</tr>
						<tr>
							<td>24. Height of risers</td>
							<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="no_of[risers_height]" id="risers_height" value="<?php echo $no_of_risers_height;?>"/></td>
						
							<td>25. Number of risers in a flight</td>
							<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers"  required="required"  name="no_of[no_risers]" id="no_of_risers" value="<?php echo $no_of_no_risers;?>"/></td>
						</tr>
						</table>			
								
								<div align="center">
								<a type="button" href="fire_form1.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save1b" class="btn btn-success submit1">Save and Next</button>
									</div>	
							</form>
							</div>
							
			<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
			<form name="myform1" id="myform1" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
			<table id=""  class="table table-responsive">
				<tr>
					<td width="25%">26. Height of hand rails :</td>
					<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="handrail_height" id="handrail_height" value="<?php echo $handrail_height;?>"/></td>
				
					<td width="25%">27. Headroom clearance :</td>
					<td width="25%"><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="part[hr_clearence]" id="hr_clearence" value="<?php echo $part_hr_clearence;?>"/></td>
				</tr>
				<tr>
					<td>28. Travel distance from the farthest point and from the dead end of the corridor to the staircase:</td>
					  <td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="part[travel_distance]" id="travel_distance" value="<?php echo $part_travel_distance;?>"/></td>
				
					<td>29. Number of lifts:</td>
					<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  required="required" name="part[no_of_lifts]" id="no_of_lifts" value="<?php echo $part_no_of_lifts;?>"/></td>
				</tr>
				<tr>
					<td>30. Capacity of each lift:</td>
					 <td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="part[capacity_of_lift]" id="capacity_of_lift" value="<?php echo $part_capacity_of_lift;?>"/></td>
							
					<td>31. Type of door provided at lift car and at each landing:</td>
					<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[of_door]" id="type_of_door" value="<?php echo $type_of_door;?>"/></td>
				</tr>
				<tr>
					<td>32. Whether service ducts are provided.<br/> If so whether the ducts are sealed at each floor level :</td>
					 <td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[service_duct]" id="service_duct" value="<?php echo $type_service_duct;?>"/></td>
							
					<td>33. Standby generator is available or not. <br/> If not what capacity is required to provide service to all the emergency provisions in the building:</td>
					<td><input type="text" class="form-control text-uppercase" jstag="validateNotSpecialChar" name="type[standby_gen]" id="standby_gen" value="<?php echo $type_standby_gen;?>"/></td>
				</tr>
				<tr >
					<td>34. Air conditioned or not. <br/>If air conditioned, the type:</td>
					<td><input type="text" class="form-control text-uppercase" jstag="validateNotSpecialChar" name="type[ac]" id="ac_type" value="<?php echo $type_ac;?>"/></td>
						
					<td>35. Type and number of wet risers/down comer to be proposed to be provided in the building:</td>
					<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[wetrisers]" id="wetrisers_type" value="<?php echo $type_wetrisers;?>"/></td>
				</tr>
				<tr >
					<td>36. Capacity of overhead/underground tanks proposed:</td>
					 <td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[tanks_capacity]" id="tanks_capacity" value="<?php echo $type_tanks_capacity;?>"/></td>
							
					<td>37. Type of fire alarm system proposed:</td>
					<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[alarm]" id="alerm_type" value="<?php echo $type_alarm;?>"/></td>
				</tr>
				<tr>
					<td>38. Type of detection system proposed:&emsp;&emsp;&emsp;</td>
					<td><input type="text" class="form-control text-uppercase" required="required" validate="jsonObj" name="type[detect_system]" id="detect_system" value="<?php echo $type_detect_system;?>"/></td>
				
					<td>39. Sprinkler system. If proposed where: &emsp;&emsp;&emsp;</td>
					<td><input type="text" class="form-control text-uppercase" name="sprinkler_system" id="sprinkler_system" value="<?php echo $sprinkler_system;?>"/></td>
				</tr>
				<tr>			
					<td>40. Area-wise details of the type and number of portable extinguishers proposed to be provided in the building:</td>
					<td><input type="text" class="form-control text-uppercase" required="required" name="portable_exting" id="portable_exting" value="<?php echo $portable_exting;?>"/></td>
				
					<td>41. Public address system proposed:</td>
					<td><input type="text" class="form-control text-uppercase" required="required" name="public_address" id="public_address" value="<?php echo $public_address;?>"/></td>
				</tr>
				<tr>			
					<td>42. Nearest fire &amp; Emergency Service Station :</td>
					<td><input type="text" class="form-control text-uppercase" required="required" name="nearest_station" id="nearest_station" value="<?php echo  $nearest_station;?>"/></td>
				
					<td>43. Any other information which is to be included in the N.O.C.:</td>
					<td><textarea  class="form-control text-uppercase" validate="textarea" name="other_info" id="other_info" ><?php echo $other_info;?></textarea></td>
				</tr>
									
								</table>
								<div align="center">
								<a type="button" href="fire_form1.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
									<button type="submit"  style="font-weight:bold" name="save1c" class="btn btn-success submit1">Save and Next</button>
									</div>	
							</form>
							</div>				
			<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
			<form name="myform4" class="submit1" id="myform4" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
				<table  id=""  class="table table-responsive" >										
								<tr>
									<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mandatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>
								<tr>
					<td width="50%"> Site Plan showing all the legends</td>
					<td width="10%">
					<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
					</td>
					<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
					<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>	
				</tr>
			     <tr>
					<td>Lay Out Plan</td>
					<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
					<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="B1"  class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td> Service Plan</td>
					<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
					<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="C1" class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>Elevation Plan/Section Plan.</td>
					<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
					<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
				</tr>
				<tr>
					<td>Licence/Permission etc..</td>
					<td><select trigger="FileModal" class="file5" id="file5" <?php if($file5!="" || $file5=="SC" || $file5=="NA") echo "disabled='disabled'"; ?>>
							<option value="0" selected="selected">Select</option>
							<option value="1">From E-Locker</option>
							<option value="2">From PC</option>
						</select>
					<input type="hidden" name="mfile5" value="<?php if($file5!="") echo $file5; ?>" id="mfile5" readonly="readonly"/></td>
					<td width="20%" id="mfile5-chiranjit"><?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file5" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
					<td><input type="CheckBox" id="E1" class="file5" name="E1" <?php if($file5=="NA") echo "checked"; ?> <?php if($file5!="" && $file5!="NA") echo "disabled='disabled'"; ?> value='E1' onClick="checkData(this)">N/A</input></td>
					<td><input type="CheckBox" id="E2" class="file5 cd" name="E2" <?php if($file5=="SC") echo "checked"; ?> <?php if($file5!="" && $file5!="SC") echo "disabled='disabled'"; ?> value='E2' onClick="checkData(this)">S/C</input></td>
				</tr>
				
				<tr>
					<td class="text-center" colspan="5">
						<a type="button" href="fire_form1.php?tab=3" class="btn btn-primary">Go Back & Edit</a>										
						<button type="submit" class="btn btn-success submit1" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Submit</button>
					</td>
					</tr>
					        </table>
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
  <?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>
<script>
$('#tab2, #tab3, #tab4').css('display', 'none');
$('a[href="#tab1"]').on('click', function(){
	$('#tab1').css('display', 'table');
	$('#tab2, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab2"]').on('click', function(){
	$('#tab2').css('display', 'table');
	$('#tab1, #tab3, #tab4').css('display', 'none');
});
$('a[href="#tab3"]').on('click', function(){
	$('#tab3').css('display', 'table');
	$('#tab1, #tab2, #tab4').css('display', 'none');
});
$('a[href="#tab4"]').on('click', function(){
	$('#tab4').css('display', 'table');
	$('#tab1, #tab2, #tab3').css('display', 'none');
});

/* ----------------------------------------------------- */
<?php if($is_provided=="N"){ ?>
	$('#is_provided').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_provided"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_provided_details').attr('disabled', 'disabled');
		else
			$('#is_provided_details').removeAttr('disabled');
	});	
	
</script>
        </body>
</html>