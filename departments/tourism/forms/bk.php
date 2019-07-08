<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('tourism','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=tourism';
		</script>";	
} 
$get_file_name=basename(__FILE__);
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$tourism->query("select * from tourism_form1 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();

	if($q->num_rows<1){	 ###EMPTY FORM DETAILS###
	
		$form_id="";
		
		#@@@@@@@@PART1@@@@@@@@#
		
		$film_title="";$film_type="";$feature_film="";$any_feature="";$applicant_refuse="";$film_public="";$any_visit="";$applicant_refuse_radio="";$film_public_radio="";$any_visit_radio="";$duration="";$dt_of_comm="";$general_info="";
		
		$film_details_org="";$film_details_name="";$film_details_desig="";$film_details_office="";$film_details_mobile="";$film_details_email="";
			
		$rep_details_org="";$rep_details_name="";$rep_details_desig="";$rep_details_office="";$rep_details_mobile="";$rep_details_email="";
		
		#@@@@@@@@PART2@@@@@@@@#
		
		$wish_to_hire="";$name_of_studio="";$cameraman_name="";$editor_name="";$recordist_name="";$film_info="";
		
		#@@@@@@@@PART3@@@@@@@@#
		$forest_area="";
		
		#@@@@@@@@PART4@@@@@@@@#
		$temp_film="";$total_area="";$nature="";$electric_dist="";$height_of_ceiling="";$fire_details="";$water_detail="";$fire_info="";
		
		$access_premise_dist="";$access_premise_width="";
		$sur_property_east="";$sur_property_west="";$sur_property_north="";$sur_property_south="";
		$open_space_eastern="";$open_space_western="";$open_space_northern="";$open_space_southern="";
		$arrangement_details_cooking="";$arrangement_details_distance="";
		$fire_st_name="";$fire_st_no="";
		$personnel_detail_fire="";$personnel_detail_no="";
		$electrician_detail_name="";$electrician_detail_no="";
		
		#@@@@@@@@PART5@@@@@@@@#
		$film_arch="";$monument_name="";$monument_part="";$arch_info="";
		
		$arch_address_building="";$arch_address_street="";$arch_address_city="";$arch_address_locality="";$arch_address_state="";$arch_address_pin="";$arch_address_dist="";
		
		#@@@@@@@@PART6@@@@@@@@#
		
		
		$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";$file12="";$file13="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";

	}else{
		$form_id=$results['form_id'];	
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];$file11=$results["file11"];$file12=$results["file12"];$file13=$results["file13"];
		#######################################part1 starts here###############################
		$film_title=$results['film_title'];$film_type=$results['film_type'];$feature_film=$results['feature_film'];$any_feature=$results['any_feature'];$applicant_refuse_radio=$results['applicant_refuse_radio'];$film_public_radio=$results['film_public_radio'];$any_visit_radio=$results['any_visit_radio'];$applicant_refuse=$results['applicant_refuse'];$film_public=$results['film_public'];$any_visit=$results['any_visit'];$duration=$results['duration'];$dt_of_comm=$results['dt_of_comm'];$general_info=$results['general_info'];
			
		if(!empty($results["film_details"])){
			$film_details=json_decode($results["film_details"]);
			$film_details_org=$film_details->org;$film_details_name=$film_details->name;$film_details_desig=$film_details->desig;$film_details_office=$film_details->office;$film_details_mobile=$film_details->mobile;$film_details_email=$film_details->email;
		}else{
			$film_details_org="";$film_details_name="";$film_details_desig="";$film_details_office="";$film_details_mobile="";$film_details_email="";
		}
		if(!empty($results["rep_details"])){
			$rep_details=json_decode($results["rep_details"]);
			$rep_details_org=$rep_details->org;$rep_details_name=$rep_details->name;$rep_details_desig=$rep_details->desig;$rep_details_office=$rep_details->office;$rep_details_mobile=$rep_details->mobile;$rep_details_email=$rep_details->email;
		}else{
			$rep_details_org="";$rep_details_name="";$rep_details_desig="";$rep_details_office="";$rep_details_mobile="";$rep_details_email="";
		}
		######################################part2 starts##################################
		$wish_to_hire=$results['wish_to_hire'];$cameraman_name=$results['cameraman_name'];$editor_name=$results['editor_name'];$recordist_name=$results['recordist_name'];$film_info=$results['film_info'];
		
		###################################part3 starts#######################################
		$forest_area=$results['forest_area'];
		
		###################################part4 starts#######################################
		
		$temp_film=$results['temp_film'];$total_area=$results['total_area'];$nature=$results['nature'];$electric_dist=$results['electric_dist'];$height_of_ceiling=$results['height_of_ceiling'];$fire_details=$results['fire_details'];$water_detail=$results['water_detail'];$fire_info=$results['fire_info'];

		if(!empty($results["access_premise"])){
			$access_premise=json_decode($results["access_premise"]);
			$access_premise_dist=$access_premise->dist;$access_premise_width=$access_premise->width;
		}else{
			$access_premise_dist="";$access_premise_width="";
		}
		if(!empty($results["sur_property"])){
			$sur_property=json_decode($results["sur_property"]);
			$sur_property_east=$sur_property->east;$sur_property_west=$sur_property->west;$sur_property_north=$sur_property->north;$sur_property_south=$sur_property->south;
		}else{
			$sur_property_east="";$sur_property_west="";$sur_property_north="";$sur_property_south="";
		}
		if(!empty($results["open_space"])){
			$open_space=json_decode($results["open_space"]);
			$open_space_eastern=$open_space->eastern;$open_space_western=$open_space->western;$open_space_northern=$open_space->northern;$open_space_southern=$open_space->southern;
		}else{
			$open_space_eastern="";$open_space_western="";$open_space_northern="";$open_space_southern="";
		}
		if(!empty($results["arrangement_details"])){
			$arrangement_details=json_decode($results["arrangement_details"]);
			$arrangement_details_cooking=$arrangement_details->cooking;$arrangement_details_distance=$arrangement_details->distance;
		}else{
			$arrangement_details_cooking="";$arrangement_details_distance="";
		}
		if(!empty($results["fire_st"])){
			$fire_st=json_decode($results["fire_st"]);
			$fire_st_name=$fire_st->name;$fire_st_no=$fire_st->no;
		}else{
			$fire_st_name="";$fire_st_no="";
		}
		if(!empty($results["personnel_detail"])){
			$personnel_detail=json_decode($results["personnel_detail"]);
			$personnel_detail_fire=$personnel_detail->fire;$personnel_detail_no=$personnel_detail->no;
		}else{
			$personnel_detail_fire="";$personnel_detail_no="";
			
		}
		if(!empty($results["electrician_detail"])){
			$electrician_detail=json_decode($results["electrician_detail"]);
			$electrician_detail_name=$electrician_detail->name;$electrician_detail_no=$electrician_detail->no;
		}else{
			$electrician_detail_name="";$electrician_detail_no="";
		}
		###################################part5 starts#######################################
		$film_arch=$results['film_arch'];$monument_name=$results['monument_name'];$monument_part=$results['monument_part'];$arch_info=$results['arch_info'];
		
		if(!empty($results["arch_address"])){
			$arch_address=json_decode($results["arch_address"]);
			$arch_address_building=$arch_address->building;$arch_address_street=$arch_address->street;$arch_address_city=$arch_address->city;$arch_address_locality=$arch_address->locality;$arch_address_pin=$arch_address->pin;$arch_address_dist=$arch_address->dist;
		}else{
			$arch_address_building="";$arch_address_street="";$arch_address_city="";$arch_address_locality="";$arch_address_state="";$arch_address_pin="";$arch_address_dist="";
		}
		
		
		###################################Courier details#######################################
		if(!empty($results["courier_details"])){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}		
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";$tabdiv5="";$tabbtn5="";$tabdiv6="";$tabbtn6="";$tabdiv7="";$tabbtn7="";
	if($showtab=="" || $showtab<7 || $showtab>7 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==4){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:block;'";$tabbtn4="active";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==5){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:block;'";$tabbtn5="active";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==6){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:block;'";$tabbtn6="active";$tabdiv7="style='display:none;'";$tabbtn7="";
	}
	if($showtab==7){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";$tabdiv6="style='display:none;'";$tabbtn6="";$tabdiv7="style='display:block;'";$tabbtn7="active";
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
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
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
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
		.scroll_div{
			height: 300px; // Set this height to the appropriate size
			position: fixed;
			overflow-y: scroll;
			padding: 20px;
			margin: 20px;
		}
	</style>
	
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
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
									<strong><?php echo $form_name=$cms->query("select form_name from tourism_form_names where form_no='1'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">General Information</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">Film Society</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab" href="#table3">Environment &amp; Forest</a></li>
								  <li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab" href="#table4">Fire &amp; Safety</a></li>
								  <li class="<?php echo $tabbtn5; ?>"><a data-toggle="tab" href="#table5">Archaeological Survey</a></li>
								  <li class="<?php echo $tabbtn6; ?>"><a data-toggle="tab" href="#table6">Upload Section</a></li>
								  <li class="<?php echo $tabbtn7; ?>"><a data-toggle="tab" href="#table7">Undertaking</a></li>
								  
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">1. Title of the Film:</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" name="film_title" value="<?php echo $film_title; ?>" ></td>
										<td width="25%">2. Type of Film: </td>
										<td width="25%"><label><input type="radio" id="inlineRadio1" <?php if($film_type=="F" || $film_type=="") echo "checked"; ?> class="radio-inline" value="F" name="film_type"> Feature Film 
											<input type="radio" id="inlineRadio2" <?php if($film_type=="D") echo "checked"; ?> class="radio-inline" value="D" name="film_type" > Documentary </label>
										</td>
										
									</tr>
									<tr>
										<td colspan="4">3. Details of the Production House/Company/Producer/Film Maker of the Film:</td>
			
									</tr>
									<tr>
										<td>a) Organization/Company:</td>
										<td><input type="text"  class="form-control text-uppercase" name="film_details[org]" value="<?php echo $film_details_org; ?>" ></td>
										<td>b) Name of Authorized Person:</td>
										<td><input type="text"  class="form-control text-uppercase" name="film_details[name]" value="<?php echo $film_details_name; ?>" validate="specialChar"></td>
									</tr>
									<tr>
										<td>c) Designation of Authorized Person:</td>
										<td><input type="text"  class="form-control text-uppercase" name="film_details[desig]" value="<?php echo $film_details_desig; ?>" ></td>
										<td>d)Address of the Registered Office:</td>
										<td><input type="text"  class="form-control text-uppercase" name="film_details[office]" value="<?php echo $film_details_office; ?>" ></td>
									</tr>
									<tr>
										<td>e) Mobile Phone No.:</td>
										<td><input type="text"  class="form-control text-uppercase" name="film_details[mobile]" value="<?php echo $film_details_mobile; ?>" maxlength="10" validate="mobileNumber" ></td>
										<td>f) Email:</td>
										<td><input type="text"  class="form-control" name="film_details[email]" value="<?php echo $film_details_email; ?>" validate="email"></td>
									</tr>
									<tr>
										<td colspan="4">4. Details of Representative in Assam, if any:</td>
									</tr>
									<tr>
										<td>a) Organization/Company:</td>
										<td><input type="text"  class="form-control text-uppercase" name="rep_details[org]" value="<?php echo $rep_details_org; ?>" ></td>
										<td>b) Name of Authorized Person:</td>
										<td><input type="text"  class="form-control text-uppercase" name="rep_details[name]" value="<?php echo $rep_details_name; ?>" validate="specialChar"></td>
									</tr>
									<tr>
										<td>c) Designation of Authorized Person:</td>
										<td><input type="text"  class="form-control text-uppercase" name="rep_details[desig]" value="<?php echo $rep_details_desig; ?>" ></td>
										<td>d)Address of the Registered Office:</td>
										<td><input type="text"  class="form-control text-uppercase" name="rep_details[office]" value="<?php echo $rep_details_office; ?>"></td>
									</tr>
									<tr>
										<td>e) Mobile Phone No.:</td>
										<td><input type="text"  class="form-control text-uppercase" name="rep_details[mobile]" value="<?php echo $rep_details_mobile; ?>" maxlength="10" validate="mobileNumber" ></td>
										<td>f) Email:</td>
										<td><input type="text"  class="form-control " name="rep_details[email]" value="<?php echo $rep_details_email; ?>" validate="email"></td>
									</tr>
									<tr>
										<td>5. Feature film/documentaries made earlier by applicant:</td>
										<td><input type="text"  class="form-control text-uppercase" name="feature_film" value="<?php echo $feature_film; ?>" ></td>
										<td>Upload in Later Upload Section</td>
										<td></td>
									</tr> 
									<tr>
										<td>6. Any Feature film/ documentary previously filmed in Assam:</td>
										<td><input type="text"  class="form-control text-uppercase" name="any_feature" value="<?php echo $any_feature; ?>" ></td>
										<td>Upload in Later Upload Section</td>
										<td></td>
									</tr>
									<tr>
										<td>7. Has applicant ever been refused permission of filming in Assam/India?</td>
										<td>
											<label class="radio-inline"><input type="radio" name="applicant_refuse_radio" value="Y"  <?php if(isset($applicant_refuse_radio) && $applicant_refuse_radio=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="applicant_refuse_radio"  value="N"  <?php if(isset($applicant_refuse_radio) && $applicant_refuse_radio=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td>If Yes, Give details.</td>
										<td><textarea name="applicant_refuse" class="form-control text-uppercase" id="applicant_refuse"  validate="textarea" ><?php echo $applicant_refuse; ?></textarea></td>
									</tr>
									<tr>
										<td>8. Is the film/documentary for public broadcast?</td>
										<td>
											<label class="radio-inline"><input type="radio" name="film_public_radio" value="Y"  <?php if(isset($film_public_radio) && $film_public_radio=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="film_public_radio"  value="N"  <?php if(isset($film_public_radio) && $film_public_radio=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td>If Yes, Give details of network/channel/medium of broadcast.</td>
										<td><textarea class="form-control text-uppercase" id="film_public" name="film_public" validate="textarea" ><?php echo $film_public; ?></textarea></td>
									</tr>
									<tr>
										<td>9. Is any pre-filming visit intended:</td>
										<td>
											<label class="radio-inline"><input type="radio" name="any_visit_radio" value="Y"  <?php if(isset($any_visit_radio) && $any_visit_radio=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="any_visit_radio"  value="N"  <?php if(isset($any_visit_radio) && $any_visit_radio=='N') echo 'checked'; ?>/> No</label>
										</td>
										<td>If Yes, Give details.</td>
										<td><textarea class="form-control text-uppercase" id="any_visit" name="any_visit" validate="textarea"><?php echo $any_visit; ?></textarea></td>
									</tr>
									<tr>
										<td>10. Duration of the filming operation (in days): <!--days in only numbers--></td>
										<td><input type="text"  style="width:100px"maxlength="4" class="form-control text-uppercase" validate="onlyNumbers" name="duration" value="<?php echo $duration; ?>" ></td>
										<td>11. Date of Commencement of the filming operation in Assam:</td>
										<td><input type="text" readonly class="form-control" id="dobn" name="dt_of_comm" value="<?php echo $dt_of_comm; ?>" ></td>
									</tr>
									<tr>
										<td>12. Any other information to be declared</td>
										<td>
											<textarea class="form-control text-uppercase" name="general_info" validate="textarea" > <?php echo $general_info; ?> </textarea>255 characters only
										</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save1a" class="btn btn-success" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
							       <tr>
										<td colspan="4">Do You Wish to Hire Equipment/Studio from Jyoti Chitraban (Film Studio) Society &nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" name="wish_to_hire" value="Y"  <?php if(isset($wish_to_hire) && $wish_to_hire=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="wish_to_hire"  value="N"  <?php if(isset($wish_to_hire) && $wish_to_hire=='N') echo 'checked'; ?>/> No</label>
										</td>
									</tr>
								</table>
								<table id="wish_to_hire_radio_yes" class="table table-responsive">
									<tr>
										<td colspan="4">1. Name of the Studio Equipment/Campus Floor/G.Van/Sound Dept/Video Dept etc.</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-bordered table-responsive text-center">
											<thead>
											<tr>
												<th width="35%" align="center" rowspan="2"> Name of the Studio Equipment/Campus Floor/G.Van/Sound Dept/Video Dept etc.</th>
												<th width="25%" align="center" colspan="2"> Hire Period</th>
												<th width="25%" align="center" rowspan="2"> Location</th>
												<th width="15%" align="center" rowspan="2"> Call Time</th>
											</tr>
											<tr>
												<th align="center">From</th>
												<th align="center">To</th>
											</tr>
											</thead>
											
											<?php
											$part1=$tourism->query("SELECT * FROM tourism_form1_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
												$count=1;
												while($row_1=$part1->fetch_array()){
                                                
												?>
												<tr>
													<td><select class="form-control text-uppercase" onClick="selectcd(this.id)" name="txtA<?php echo $count;?>" id="txtA<?php echo $count;?>"><option>Please Select</option></select></td>
													<td><input value="<?php echo $row_1["hire_from"]; ?>" onclick="dateadd(this.id)" id="txtB<?php echo $count;?>"  class="form-control" size="20" name="txtB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_1["hire_to"]; ?>" id="txtC<?php echo $count;?>" onclick="dateadd(this.id)" class="form-control" name="txtC<?php echo $count;?>" size="20"></td>	
													<td><input value="<?php echo $row_1["location"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
													<td><input value="<?php echo $row_1["call_time"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" onclick="timepickeradd(this.id)" name="txtE<?php echo $count;?>" size="20"></td>
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><select class="form-control text-uppercase" onclick="selectcd(this.id)" name="txtA1" id="txtA1"><option>Please Select</option></select></td>
													<td><input id="txtB1" size="20" onclick="dateadd(this.id)" class="form-control" name="txtB1"></td>					
													<td><input  id="txtC1" size="20" onclick="dateadd(this.id)" class="form-control" name="txtC1"></td>
													<td><input id="txtD1" size="20" class="form-control text-uppercase" name="txtD1"></td>
													<td><input id="txtE1" size="20" onclick="timepickeradd(this.id)" class="form-control text-uppercase" name="txtE1"></td>
												</tr>
												<?php } ?>
											</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
									</tr>
									
							
									<tr>
										<td width="25%">2. Name of the Cameraman:</td>
										<td width="25%"><input type="text"  class="form-control text-uppercase" name="cameraman_name" value="<?php echo $cameraman_name; ?>" validate="specialChar"></td>
										<td width="25%">3. Name of the Editor:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="editor_name" value="<?php echo $editor_name; ?>"  validate="specialChar"></td>
									</tr>
									<tr>										
										<td >4. Name of the Recordist:</td>
										<td><input type="text"  class="form-control text-uppercase" name="recordist_name" value="<?php echo $recordist_name; ?>"  validate="specialChar"></td>
										<td>5. Any other information to be declared</td>
										<td><textarea class="form-control text-uppercase" name="film_info" validate="textarea"> <?php echo $film_info; ?> </textarea>255 characters only</td>
									</tr>
									<tr>
										<td colspan="4">Note: Any cancellation will have to be communicated to the Studio Authority in written 7 days ahead; in
										case of failure to do so the 50% of the hiring charge will be forfeited.</td>
									</tr>
								</table>
								<table id="" class="table table-responsive">
									<tr>
										<td class="text-center" colspan="4">
											<a type="button" href="tourism_form1.php?tab=1" class="btn btn-primary">Go Back & Edit</a>		
											<button type="submit" name="save1b" class="btn btn-success" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
							       <tr>
										<td colspan="4">Do You Wish to film at a Forest Area/National Park/Wildlife Sanctuary?&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="forest_area" value="Y"  <?php if(isset($forest_area) && $forest_area=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="forest_area"  value="N"  <?php if(isset($forest_area) && $forest_area=='N') echo 'checked'; ?>/> No</label>
										</td>
									
									</tr>
								</table>
								<table id="forest_area_radio_yes" class="table table-responsive">
									<tr>
										<td colspan="4">Terms &amp; Condition
											<ol>
												<li>A tentative script may be furnished containing exact period of shooting, conveyance, budget etc.</li>
												<li>All the provisions relating to the National Parks, Sanctuaries, Tiger reserves under the Wildlife (P) Act, 1972 and amended
													upto date and guidelines issued by the MoEF shall be adhered to.</li>
												<li>No shooting shall be done between the sunrise and sunset inside protected areas (PAs)</li>
												<li>Shooting will not be permitted to move around in the PAs on foot.</li>
												<li> Use of aircraft will not be permitted.</li>
												<li>No boundary mark of the Protected Areas (PAs) will be damaged, altered, destroyed moved or defaced.</li>
												<li>No wild animal will be teased, molested or disturbed to its natural behavior.</li>
												<li> No damage to any flora or fauna will be caused.</li>
												<li>The ground of the Protected Areas will not be littered.</li>
												<li>The necessary entry fee, filming fee as prescribed by the State Government for Foreign Nationals will be paid before
													entering into the PAs and fee paid receipt shall be furnished while withdrawing security deposit.</li>
												<li>A responsible officer authorized by the PA authority will supervise the activities of the shooting to ensure the adherence of
													all conditions stipulated herein Entry to the PA will be subject to the convenience of the PA Authorities only.</li>
												<li>The Officer in-charge of the Protected Area will reserve the right to cancel/ terminate this permission at any time,
													whenever he considers that the activities resulting from this permission is affecting the flora and fauna adversely or the
													permit holder is not abiding by the stipulations contained herein.</li>
												<li>Three copies of edited film with entire footage will have to be furnished to the Research Officer, O/P the PCCF (WL) Assam
													for official us.</li>
												<li>An amount of Rs 10000/- will have to be deposited in the form of “Fixed deposit” pledged in favor of the Chief Wildlife Warden, Assam, Basistha, Guwahati-29 as a security deposit which will be released immediately after fulfilling the clauses 10 & 13 and also on receipt of the report about satisfactory compliance of all the above stipulations & NOC from PA Authorities for release of security deposit.</li>
											</ol>
										</td>
									</tr>
									
									<tr>
										<td colspan="4" align="center"><u>Undertaking</u></td>
									</tr>
									<tr>
										<td colspan="4">
										<p>I do hereby undertake that I shall abide all the stipulations contained in this permission and I am entering into the PAs at my
										own risk and in case of any violation of any of the stipulation not only my security deposit will be liable to be forfeited but
										also I shall be liable to be prosecuted under the relevant provision of law.</p></td>
									</tr>
									<tr>
									    
									    <td colspan="4" align="right">  <label><?php echo  strtoupper($key_person)?></label><br/>Signature of the Applicant</td>
									</tr>
									
								</table>
								<table id="" class="table table-responsive">
									<tr>
										<td class="text-center" colspan="4">
											<a type="button" href="tourism_form1.php?tab=2" class="btn btn-primary">Go Back & Edit</a>	 
											<button type="submit" name="save1c" class="btn btn-success" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
							       <tr>
										<td colspan="4">Do you wish to construct/erect temporary film shooting sets?&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="temp_film" value="Y"  <?php if(isset($temp_film) && $temp_film=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="temp_film"  value="N"  <?php if(isset($temp_film) && $temp_film=='N') echo 'checked'; ?>/> No</label>
										</td>
										
									</tr>
								</table>
								<table id="temp_film_radio_yes" class="table table-responsive">
									<tr>
										<td width="25%">1. Total area proposed to be utilized</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="total_area" value="<?php echo $total_area; ?>"></td>
										<td width="25%">2. Nature and Type of Construction proposed</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">3. Accessibility to the premises</td>
									</tr>
									<tr>
										<td>a. Distance from motor-able road</td>
										<td><input type="text" class="form-control text-uppercase" name="access_premise[dist]" value="<?php echo $access_premise_dist; ?>"></td>
										<td>b. Width of the road</td>
										<td><input type="text" class="form-control text-uppercase" name="access_premise[width]" value="<?php echo $access_premise_width; ?>"></td>
									</tr>
									<tr>
										<td colspan="4">4. Surrounding properties</td>
									</tr>
									<tr>
										<td >East</td>
										<td><input type="text"  class="form-control text-uppercase" name="sur_property[east]" value="<?php echo $sur_property_east; ?>" ></td>										<td>West</td>										<td><input type="text"  class="form-control text-uppercase" name="sur_property[west]" value="<?php echo $sur_property_west; ?>" ></td>
								</tr>
								<tr>
									<td >North</td>
									<td><input type="text"  class="form-control text-uppercase" name="sur_property[north]" value="<?php echo $sur_property_north; ?>"></td>
									<td>South</td>
									<td><input type="text"  class="form-control text-uppercase" name="sur_property[south]" value="<?php echo $sur_property_south; ?>" ></td>
								</tr>
								<tr>
									<td colspan="4">5. Open space available around the Structure</td>
								</tr>
								<tr>
									<td >Eastern</td>
									<td><input type="text"  class="form-control text-uppercase" name="open_space[eastern]" value="<?php echo $open_space_eastern; ?>"></td>
									<td>Western</td>
									<td><input type="text"  class="form-control text-uppercase" name="open_space[western]" value="<?php echo $open_space_western; ?>"></td>
								</tr>
								<tr>
									<td >Northern</td>
									<td><input type="text"  class="form-control text-uppercase" name="open_space[northern]" value="<?php echo $open_space_northern; ?>"></td>
									<td>Southern</td>
									<td><input type="text"  class="form-control text-uppercase" name="open_space[southern]" value="<?php echo $open_space_southern; ?>"></td>
								</tr>
								<tr>
									<td >6.a) Details of arrangement for cooking/restaurants/stalls in the premises (if any)</td>
									<td><input type="text"  class="form-control text-uppercase" name="arrangement_details[cooking]" value="<?php echo $arrangement_details_cooking; ?>"></td>
									<td >b)Their distance from the main structure</td>
									<td><input type="text"  class="form-control text-uppercase" name="arrangement_details[distance]" value="<?php echo $arrangement_details_distance; ?>"></td>
								</tr>
								<tr>
									<td>7. Distance to the nearest overhead electric line</td>
									<td><input type="text"  class="form-control text-uppercase" name="electric_dist" value="<?php echo $electric_dist; ?>"></td>
								
									<td >8. Height of ceiling of the structure</td>
									<td><input type="text"  class="form-control text-uppercase" name="height_of_ceiling" value="<?php echo $height_of_ceiling; ?>"></td>
								</tr>
								<tr>
									<td>9. a) Name of the nearest Fire Station </td>
									<td><input type="text"  class="form-control text-uppercase" name="fire_st[name]" value="<?php echo $fire_st_name; ?>" ></td>
									<td>b) Telephone Number of the nearest Fire Station</td>
									<td><input type="text"  class="form-control text-uppercase" name="fire_st[no]" value="<?php echo $fire_st_no; ?>" ></td>
								</tr>
								<tr>
									<td >10. Details of Fire Fighting Equipment provided in the premises/temporary shooting set</td>
									<td><textarea  class="form-control text-uppercase" name="fire_details" ><?php echo $fire_details; ?></textarea></td>
									<td>11. Details of the Water storage available in the premises</td>
									<td><textarea  class="form-control text-uppercase" name="water_detail"> <?php echo $water_detail; ?></textarea></td>
								</tr>
								<tr>
									<td >12. a)Details of the personnel trained in basic fire-fighting </td>
									<td><textarea  class="form-control text-uppercase" name="personnel_detail[fire]"> <?php echo $personnel_detail_fire; ?></textarea></td>
									<td > b) Number of the training	certificate</td>
									<td><input type="text"  class="form-control text-uppercase" name="personnel_detail[no]" value="<?php echo $personnel_detail_no; ?>"></td>
								</tr>
								<tr>
									<td>13. a)Name of Electrician</td>
									<td><input type="text"  class="form-control text-uppercase" name="electrician_detail[name]" value="<?php echo $electrician_detail_name; ?>" ></td>
									<td> b)License number of Electrician</td>
									<td><input type="text"  class="form-control text-uppercase" name="electrician_detail[no]" value="<?php echo $electrician_detail_no; ?>" ></td>
								</tr>
								<tr>
									<td >14. Any other information to be declared</td>
									<td><textarea class="form-control text-uppercase" name="fire_info" validate="textarea"> <?php echo $fire_info; ?> </textarea>255 characters only</td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">
									
									<div id="section1" class="container-fluid">
							<p class="text-bold">Terms and Conditions to be followed by Film Shooting Agencies while erecting sets :</p>
						</div>
						<div class="scroll_div" style="background-color: #c0c0c0;border-radius:10px" >
							
							<div id="section2" class="container-fluid">
								<ul>
									<li>For shooting films/ erecting  film sets in High rise buildings/ Hotels Hospitals/ Schools/ Shopping Malls / Industries etc the Film Shooting agencies should ensure that the buildings/ establishments proposed to be used for shooting purpose must have previously obtained Fire Safety NOC  from Fire & Emer4gency Services, Assam Fire Safety NOC will be required to be furnished by the applicant for utilizing such establishments.</li>
									<li><p class="text-bold">Recommendations for the fire precautionary measures for erecting Temporary Film Shooting Sets.</p>
										<ul>
											<li>The height of the ceiling of Shootings Sets/ structures shall not be less than 3 meters.</li>
											<li>No synthetic material should be used in such structures.</li>
											<li>Synthetic rope should not be used and instead either coir or manila should be used.</li>
											<li>Margins of at least 3 meters shall be kept on all sides away from any pre-existing  walls  or buildings.</li>
											<li>No structure shall be erected beneath any live electrical line.</li>
											<li>The structures should be erected reasonably away from railway lines electric sub-stations, furnaces or other hazardous places and a minimum distance of 15 meters must be maintained.</li>
											<li>Exists on all sides of the Sets will be kept sufficiently wide ( minimum 1.5 meters) The exist must not be of tunnel like shape.</li>
											<li>Enough spaces should be kept for movement within the Sets.</li>
											<li>The lighting arrangement should be through a licensed electrical contractor. No cable joints should be left exposed. They should be carefully covered with insulating types. If possible internal circuit should be through conduits.</li>
											<li>There should be provision for standby emergency light.</li>
										</ul>
									</li>
								</ul>
							</div>
							<div id="section3" class="container-fluid">
								<h4><u>FIRE PROTECTION MEASURES</u></h4>
									<ul>
										<li>The ground enclosed  by any temporary structure, pandal, tent or shamina, a distance of not less than 4.5 m outside of such structure shall be cleared of all combustible materials or vegetation and any material obstructing the movement.</li>
										<li>Storage of combustible materials like shavings, straw, flammable and explosive chemicals and similar materials shall not be permitted to be stored inside and temporary structure.</li>
										<li>No Fire works or open flame of any kind shall be permitted in any temporary structure film shooting sets or in the immediate vicinity.</li>
										<li>Open Fires: No open fires except small size controlled fires for religious purposes shall be permitted inside or near the shooting sets or other temporary structures.</li>
										<li>Kitchen area for cooking of snacks/ food shall be totally segregated from the main pandal/ temporary structure and preferably of G.I sheet.</li>	
									</ul>
								  
							</div>
							<div id="section4" class="container-fluid">
								<h4><u>FIRE FIGHTING ARRANGEMENTS</u></h4>
									<ol type="a">
										<li>Provision of water for Fire Fighting.<br/>Supply of water shall not be less than 0.75 1/m2 of floor area for each shooting sets or other temporary structure. The water shall be stored in buckets / drums and kept in readiness for use. Half quantity may be kept inside the temporary structure and the other half in its immediate vicinity. The buckets or receptacles stating water shall at all times be readily available for immediate use for dealing with the fire.</li>
										<li>Fire Extinguisher
										<ul>
											<li>Adequate nos of CO2 or D.C.P extinguisher of 4.5/4.kg capacity should be installed in the film shooting sets/temporary structures. The extinguisher shall be so distributed over each floor area so that a person has to travel not more than 15 mtrs to reach the nearest extinguisher or in each 100 m2 in floor area.</li>
											<li>At least two nos. of D.C.P or CO2 extinguisher of 4/4.5 kg and two nos. of AFFF extinguisher  of 9 lts. Capacity should be provided near the Car Parking area ( if any)</li>
											<li>At least two Nos of CO2 extinguisher of 4.5 kg capacity should be provided near the Electric Panel Board/ Switch gear room.</li>
											<li>At least two nos. of AFFF extinguisher of 9 lts capacity with ISI mark should be provided near the Generator/ Transformer.</li>
											<li>N.B: All Fire Extinguishers should be newly introduced Indian Standard- as per IS 15683:2006</li>
										</ul>
										</li>
										<li>Directional sign showing ENTRY & EXIT should be displayed clearly.</li>
										<li>A responsible person (volunteers) shall always be available at the site of the temporary structure/ sets  to organize prompt evacuation, fire fighting to deal with emergencies at the incipient stage and informing the Fire Service. The emergency Fire service telephone number shall be displayed prominently.</li>
										<li>Volunteers should bear Badges for easy identification.</li>	
									</ol>
								  
							</div>
							<div id="section5" class="container-fluid">
								<h4><u>MAINTENANCE</u></h4>									
									<ul>
										<li>All temporary structures/ sets shall be maintained in a safe and sanitary condition. All devices or safeguards which are required by this standard shall be maintained in good working condition.</li>
										<li>All temporary structures shall be periodically inspected and any deterioration or any defect observed shall be brought to the notice of the authority for remedy.</li>
										<li>Particular attention shall be paid to the means of escape and gangways, exits etc. are extinguishers easily visible and accessible before public is admitted at any time.</li>
										<li>The emergency telephone numbers shall be displayed prominently in and around the structures and provision for standby emergency light should be provided.</li>
										
									</ul>									
							</div>
						</div>
						<br/>
									
									</td>
								</tr>
								<tr>
									<td colspan="4" align="center"><b>Undertaking</b></td>
									
								</tr>
								<tr>
									<td colspan="4">I/We <input type="text"   class="form-control1 text-uppercase"  value="<?php echo $film_details_name; ?>"> on behalf of &nbsp;<input type="text" class="form-control1 text-uppercase" value="<?php echo $film_details_org; ?>" >&nbsp; do hereby declare that I have complied to the terms and conditions/ guidelines of Fire Prevention&amp; Fire Safety Measures for the Film Shooting Sets/Structures/ Stages  <!--of <input type="text" style="width:200px" class="text-uppercase" name="stage" value="<?php echo $stage; ?>" >-->as circulated by your good office. That
									in case of violation detected, I will be held responsible for consequences</td>
								</tr>
							</table>
							<table id="" class="table table-responsive">	
								<tr>
									<td class="text-center" colspan="4">
										<a type="button" href="tourism_form1.php?tab=3" class="btn btn-primary">Go Back & Edit</a>	
										<button type="submit" name="save1d" class="btn btn-success" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')">Save and Next</button>
									</td>
								</tr>
							</table>
							</form>
							</div>
							<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
								<tr>
									<td colspan="4">Do you wish to film at Archaeological Sites/Monuments?&nbsp;&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="film_arch" value="Y"  <?php if(isset($film_arch) && $film_arch=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="film_arch"  value="N"  <?php if(isset($film_arch) && $film_arch=='N') echo 'checked'; ?>/> No</label>
									</td>
									
								</tr>	
								</table>
								<table id="film_arch_radio_yes" class="table table-responsive">
								<tr>
									<td>1. Name of the monument/site at which the proposed filming operation is to be carried out</td>
									<td><input type="text"  class="form-control text-uppercase" name="monument_name" value="<?php echo $monument_name; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">2. Address :</td>
								</tr>
								<tr>
									<td>a. Building/Premises</td>
									<td><input type="text"  class="form-control text-uppercase" name="arch_address[building]" value="<?php echo $arch_address_building; ?>"></td>
									<td>b. Street</td>
									<td><input type="text"  class="form-control text-uppercase" name="arch_address[street]" value="<?php echo $arch_address_street; ?>"></td>
								</tr>
								<tr>
									<td>c. Locality</td>
									<td><input type="text"  class="form-control text-uppercase" name="arch_address[locality]" value="<?php echo $arch_address_locality; ?>"></td>
									<td>d. City</td>
									<td><input type="text"  class="form-control text-uppercase" name="arch_address[city]" value="<?php echo $arch_address_city; ?>"></td>
								</tr>
								<tr>
									<td>e. District</td>
									<td>
					                <?php $dstresult=$mysql->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
					                <select name="ew_dismant[dist]" class="form-control text-uppercase"><?php
						            while($dstrows=$dstresult->fetch_object()) { 
							             if(isset($arch_address_dist) && ($arch_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
							                  <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						               <?php } ?>					
					                </select>
       			                    </td>
									<td>f. State</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="ASSAM" ></td>
									
								</tr>
								<tr>
									
									<td>g. Pin</td>
									<td><input type="text"  class="form-control text-uppercase" name="arch_address[pin]" value="<?php echo $arch_address_pin; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
										<td width="25%">3. Part of the monument/site to be filmed</td>
										<td width="25%"><textarea  class="form-control text-uppercase" name="monument_part"><?php echo $monument_part; ?></textarea></td>
										<td width="25%">4. Any other information to be declared</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="arch_info" validate="textarea"> <?php echo $arch_info; ?> </textarea>255 characters only</td>
									</tr>
									<tr>
										<td colspan="4">I declare that the above information is correct. I also undertake to observe the provisions of the Ancient
											Monuments and Archaeological Sites and Remains Act 1958, and the rules thereunder.</td>
									</tr>
									<tr>
											<td colspan="4" align="center"><input type="checkbox">I Agree</td>
									</tr>
								</table>
								<table id="" class="table table-responsive">
									<tr>
										<td class="text-center" colspan="4">
											<a type="button" href="tourism_form1.php?tab=4" class="btn btn-primary">Go Back & Edit</a>										
											<button type="submit" name="save1e" class="btn btn-success" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
										
									</tr>
								</table>
								</form>
							</div>
							<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
							<tr>
								<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
							</tr>
								
							<tr>
								<td width="50%">Synopsis of the Feature Film/Documentary.</td>
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
								<td>Itinerary of pre-filming visit alongwith places to stay and the mode of
									conveyance/transportation to be used.</td>
								<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
								<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
								<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
								<td><input type="CheckBox" id="B1" class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
								<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
							</tr>
							<tr>
								<td>List of Cinematic Equipment to be used, if any, alongwith necessary certification and
								authorization.</td>
								<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
								<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
								<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
								<td><input type="CheckBox" id="C1"  class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
								<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file2!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
							</tr>
							<tr>
								<td>List/Full details of Crew members alongwith security classification, if any.</td>
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
								<td> List/Full details of Firearms/Explosives to be carried, if any, alongwith necessary certification and
								authorization.</td>
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
								<td> Itinerary of the filming schedule alongwith places to stay and the mode of
									conveyance/transportation to be used.</td>
								<td><select trigger="FileModal" class="file6" id="file6" <?php if($file6!="" || $file6=="SC" || $file6=="NA") echo "disabled='disabled'"; ?>>
									<option value="0" selected="selected">Select</option>
									<option value="1">From E-Locker</option>
									<option value="2">From PC</option>
								</select>
								<input type="hidden" name="mfile6" value="<?php if($file6!="") echo $file6; ?>" id="mfile6" readonly="readonly"/></td>
								<td width="20%" id="mfile6-chiranjit"><?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file6" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
								<td><input type="CheckBox" id="F1" class="file6" name="F1" <?php if($file6=="NA") echo "checked"; ?> <?php if($file6!="" && $file6!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
								<td><input type="CheckBox" id="F2" class="file6 cd" name="F2" <?php if($file6=="SC") echo "checked"; ?> <?php if($file6!="" && $file6!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>
							</tr>
							<tr>
								<td> Certificate/Permission letter from competent authority for use of helicopters/drones etc. or any
									other specialized equipment.</td>
								<td><select trigger="FileModal" class="file7" id="file7" <?php if($file7!="" || $file7=="SC" || $file7=="NA") echo "disabled='disabled'"; ?>>
									<option value="0" selected="selected">Select</option>
									<option value="1">From E-Locker</option>
									<option value="2">From PC</option>
								</select>
								<input type="hidden" name="mfile7" value="<?php if($file7!="") echo $file7; ?>" id="mfile7" readonly="readonly"/></td>
								<td width="20%" id="mfile7-chiranjit"><?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
								<td><input type="CheckBox" id="G1" class="file7" name="G1" <?php if($file7=="NA") echo "checked"; ?> <?php if($file7!="" && $file7!="NA") echo "disabled='disabled'"; ?> value='F1' onClick="checkData(this)">N/A</input></td>
								<td><input type="CheckBox" id="G2" class="file7 cd" name="G2" <?php if($file7=="SC") echo "checked"; ?> <?php if($file7!="" && $file7!="SC") echo "disabled='disabled'"; ?> value='F2' onClick="checkData(this)">S/C</input></td>(
									</tr>
							<tr>
							<td> List/Full Details of Fire Fighting Equipment (Fire Extinguisher, Foam etc.) available with the team in case of filming with inflammable materials or in case of construction or erection of tempory sets/structures.</td>
							<td><select trigger="FileModal" class="file8" id="file8" <?php if($file8!="" || $file8=="SC" || $file8=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
								<input type="hidden" name="mfile8" value="<?php if($file8!="") echo $file8; ?>" id="mfile8" readonly="readonly"/></td>
							<td width="20%" id="mfile8-chiranjit"><?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file7" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
							<td><input type="CheckBox" id="H1" class="file8" name="H1" <?php if($file8=="NA") echo "checked"; ?> <?php if($file8!="" && $file8!="NA") echo "disabled='disabled'"; ?> value='H1' onClick="checkData(this)">N/A</input></td>
							<td><input type="CheckBox" id="H2" class="file8 cd" name="H2" <?php if($file8=="SC") echo "checked"; ?> <?php if($file8!="" && $file8!="SC") echo "disabled='disabled'"; ?> value='H2' onClick="checkData(this)">S/C</input></td>
						</tr>	
						<tr>
							<td> A receipt of amount of Rs 10000/- pledged in favor of the Chief Wildlife
								Warden, Assam, Basistha, Guwahati-29 as a security deposit to be uploaded.</td>
							<td><select trigger="FileModal" class="file9" id="file9" <?php if($file9!="" || $file9=="SC" || $file9=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
								<input type="hidden" name="mfile9" value="<?php if($file9!="") echo $file9; ?>" id="mfile9" readonly="readonly"/></td>
							<td width="20%" id="mfile9-chiranjit"><?php if($file9!="" && $file9!="SC" && $file9!="NA"){ echo '<a href="'.$upload.$file9.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file9" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
							<td><input type="CheckBox" id="I1" class="file9" name="I1" <?php if($file9=="NA") echo "checked"; ?> <?php if($file9!="" && $file9!="NA") echo "disabled='disabled'"; ?> value='I1' onClick="checkData(this)">N/A</input></td>
							<td><input type="CheckBox" id="I2" class="file9 cd" name="I2" <?php if($file9=="SC") echo "checked"; ?> <?php if($file9!="" && $file9!="SC") echo "disabled='disabled'"; ?> value='I2' onClick="checkData(this)">S/C</input></td>
						</tr>
						
						<tr>
							<td> A copy of approval letter from NTCA/ Wildlife Div. of Govt. of India, MoEF &amp; CC shall be submitted prior to accord
								permission.</td>
							<td><select trigger="FileModal" class="file10" id="file10" <?php if($file10!="" || $file10=="SC" || $file10=="NA") echo "disabled='disabled'"; ?>>
											<option value="0" selected="selected">Select</option>
											<option value="1">From E-Locker</option>
											<option value="2">From PC</option>
										</select>
								<input type="hidden" name="mfile10" value="<?php if($file10!="") echo $file10; ?>" id="mfile10" readonly="readonly"/></td>
							<td width="20%" id="mfile10-chiranjit"><?php if($file10!="" && $file10!="SC" && $file10!="NA"){ echo '<a href="'.$upload.$file10.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file10" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
							<td><input type="CheckBox" id="J1" class="file10" name="J1" <?php if($file10=="NA") echo "checked"; ?> <?php if($file10!="" && $file10!="NA") echo "disabled='disabled'"; ?> value='J1' onClick="checkData(this)">N/A</input></td>
							<td><input type="CheckBox" id="J2" class="file10 cd" name="J2" <?php if($file10=="SC") echo "checked"; ?> <?php if($file10!="" && $file10!="SC") echo "disabled='disabled'"; ?> value='J2' onClick="checkData(this)">S/C</input></td>
						</tr>
						<tr>
							<td> Nature and purpose of the proposed filming operations and the context in which the monument is proposed to be filmed (relevant extract of the script to be attached alongwith details of the scenes to be filmed should be furnished)</td>
										<td><select trigger="FileModal" class="file11" id="file11" <?php if($file11!="" || $file11=="SC" || $file11=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile11" value="<?php if($file11!="") echo $file11; ?>" id="mfile11" readonly="readonly"/></td>
									<td width="20%" id="mfile11-chiranjit"><?php if($file11!="" && $file11!="SC" && $file11!="NA"){ echo '<a href="'.$upload.$file11.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file11" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="K1" class="file11" name="G1" <?php if($file11=="NA") echo "checked"; ?> <?php if($file11!="" && $file11!="NA") echo "disabled='disabled'"; ?> value='K1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="K2" class="file11 cd" name="G2" <?php if($file11=="SC") echo "checked"; ?> <?php if($file11!="" && $file11!="SC") echo "disabled='disabled'"; ?> value='K2' onClick="checkData(this)">S/C</input></td>
						</tr>
						<tr>
							<td>Feature film/documentaries made earlier by applicant.</td>
							<td><select trigger="FileModal" class="file12" id="file12" <?php if($file12!="" || $file12=="SC" || $file12=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
							<input type="hidden" name="mfile12" value="<?php if($file12!="") echo $file12; ?>" id="mfile12" readonly="readonly"/></td>
							<td width="20%" id="mfile12-chiranjit"><?php if($file12!="" && $file12!="SC" && $file12!="NA"){ echo '<a href="'.$upload.$file12.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file12" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
							<td><input type="CheckBox" id="L1" class="file12" name="G1" <?php if($file12=="NA") echo "checked"; ?> <?php if($file12!="" && $file12!="NA") echo "disabled='disabled'"; ?> value='L1' onClick="checkData(this)">N/A</input></td>
							<td><input type="CheckBox" id="L2" class="file12 cd" name="G2" <?php if($file12=="SC") echo "checked"; ?> <?php if($file12!="" && $file12!="SC") echo "disabled='disabled'"; ?> value='L2' onClick="checkData(this)">S/C</input></td>
						</tr>
						<tr>
							<td>Any Feature film/ documentary previously filmed in Assam.</td>
							<td><select trigger="FileModal" class="file13" id="file13" <?php if($file13!="" || $file13=="SC" || $file13=="NA") echo "disabled='disabled'"; ?>>
								<option value="0" selected="selected">Select</option>
								<option value="1">From E-Locker</option>
								<option value="2">From PC</option>
							</select>
							<input type="hidden" name="mfile13" value="<?php if($file13!="") echo $file13; ?>" id="mfile13" readonly="readonly"/></td>
							<td width="20%" id="mfile13-chiranjit"><?php if($file13!="" && $file13!="SC" && $file13!="NA"){ echo '<a href="'.$upload.$file13.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file13" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
							<td><input type="CheckBox" id="L1" class="file13" name="G1" <?php if($file13=="NA") echo "checked"; ?> <?php if($file13!="" && $file13!="NA") echo "disabled='disabled'"; ?> value='M1' onClick="checkData(this)">N/A</input></td>
							<td><input type="CheckBox" id="L2" class="file13 cd" name="G2" <?php if($file13=="SC") echo "checked"; ?> <?php if($file13!="" && $file13!="SC") echo "disabled='disabled'"; ?> value='M2' onClick="checkData(this)">S/C</input></td>
						</tr>
							
						<tr id="courierd">
							<td colspan="5">
								<table width="100%">
								<tr>
									<td colspan="6">Courier Details : </td>
								</tr>
								<tr>
									<td>Name of Courier Service <input type="text" required="required" name="courier_details[cn]" value="<?php echo $courier_details_cn; ?>" placeholder="Name" size="35" class="text-uppercase" ></td>
									<td>Ref. No. / Consignment No. <input type="text" required="required" name="courier_details[rn]" value="<?php echo $courier_details_rn; ?>" size="20" placeholder="Ref. Number" class="text-uppercase" ></td>
									<td>Dispatch Date <input type="datetime" required="required" value="<?php echo $courier_details_dt; ?>" name="courier_details[dt]" size="20" placeholder="DD/MM/YYYY" class="dob text-uppercase" ></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td class="text-center" colspan="4">
								<a type="button" href="tourism_form1.php?tab=5" class="btn btn-primary">Go Back & Edit</a>										
								<button type="submit" class="btn btn-success" name="save1f" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
							</td>
							
						</tr>
						</table>								
						</form>
						</div>
						<div id="table7" class="tab-pane <?php echo $tabbtn7; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<div id="section1" class="container-fluid">
								<p class="text-bold">DO’s and DON’Ts in National Parks/ Wildlife Sanctuaries</p>
							</div>
							<div class="scroll_div" style="background-color: #c0c0c0;border-radius:10px" >
								
								<div id="section2" class="container-fluid">
									<h4>DO’s</h4>
									<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">
										<ul>
											<li>Obtain permit before entering the Park.</li>
											<li>Always be accompanied by a guide authorized by the Park Authority.</li>
											<li>Wear inconspicuous ‘Khaki’, ‘Olive’ or ‘Grey’ clothing.</li>
											<li>Bright clothes particularly white, black and red are not advisable.</li>
											<li>Drive slowly in the prescribed route with maximum speed limit of
												20kms/hr.</li>
											<li>Grant right of way to the animals.</li>
											<li>Maintain silence to have a close look on wildlife.</li>
											<li>Drive only on the specified routes.</li>
											<li>Leave the Park before sunset.</li>
										</ul>
										</td>
										</tr>
										</table>
								</div>
								<div id="section3" class="container-fluid">
									<h4>DON’Ts</h4>
									<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">
									
										<ul>
											<li>Enter the Park before or after the specified time.</li>
											<li>Entry to ‘Sanctum Sanctorum’ or prohibited areas of the Park.</li>
											<li>Carrying pets, transistors, tape recorders and musical instruments inside
												the Park.</li>
											<li>Try to cook anything inside the Park.</li>
											<li>Drive off the road.</li>
											<li>Overtake other vehicles.</li>
											<li>Disembark from the vehicle to move on foot.</li>
											<li>Disturb the animals.</li>
											<li>Smoke or kindle fire.</li>
											<li>Throw trash inside the Park.</li>
											<li>Litter the areas (natural environment) where shooting is done.</li>
											
										</ul>
									  
										</td>
										</tr>
										</table>
								</div>
								<div id="section4" class="container-fluid">
									<h4>Prohibited:</h4>
									<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">
									
										<ul>
											<li>Drinking alcohol inside the park and temples, monuments/ archeological
												sites etc.</li>
											<li>Carrying of arms and ammunitions/ fire crackers.</li>
											<li>Fishing and trapping wildlife with any equipment.</li>
											<li>Fishing and trapping wildlife with any equipment.</li>
											
										</ul>
										</td>
									</tr>
									</table>
								</div>
								<div id="section5" class="container-fluid">
									<h4><u>Guidelines for applying permission for shooting of Feature Film/ documentary
									film.</u></h4>
									<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">
									
										<ol type="1">
											<li>Categories of Films to be shoot in the places of Assam.</li>
											<ul type="a">
												<li>Feature films.</li>
												<li>Documentaries</li>
												<li>Tele films and</li>
												<li>Television serials including Reality Television</li>
											</ul>
											<li>All people of the unit shall carry valid ID proof at the time of Shooting of
												Films etc. i9n the location.</li>
											<li>Timing of the event has to be agreed in advance and must be strictly
												adhered to.</li>
											<li>It shall be the sole responsibility of the applicant to clean up debris or any
												garbage materials any housekeeping activities created and/ or brought in
												by the applicant.</li>
											<li>In case of power requirement during the shooting the applicant has to
												contact the concerning ASEB office on payment basis on power supply.
												The applicant can also use generators for supply of powers as required by
												their own through the experienced and certificate holder technician. All
												cords and wiring running along the floor must be taped or guarded so that
												the artists/ staffs do not trip or fall.</li>
											<li>The office of the location/ site at all times retains the right to halt any
												activity that is deemed to be adversely impact the safety and security of
												the shooting personnel and property.</li>
											<li>The company/ production house may use film, video and photographs
												shot at for the purpose stated in the application form. The image/ footage
												should not be used for any other purpose without written purpose from
												the authority.</li>
											<li>The authority reserves the right to restrict the member of persons and the
												type of equipments entering into the place for this activity.</li>
											<li>The authority shall not be held responsible for any liabilities, bodily
												injuries, death, losses, lawsuits, claims demands, fines, damages, costs and
												expenses (including all costs for investigation and expenses of legal fees
												thereof) which are caused by the action in the film / event companies /
												media and photographers and/ or by any participant in the shooting of
												film etc.</li>
											<li>Any customer, staff will not be involved in shooting without the prior
												permission of the authority.</li>
											<li>The authority reserves the right to interrupt or halt any event in progress
												if the company goes against the ethics of the shooting of film etc. In the
												location.</li>
											<li>The applicant should pay compensation for any loss and damage of the
												properties in the location fixed by the authority of the location.</li>
											<li>Use of alcoholic drinks or any intoxicants are totally prohibited.</li>
											<li>Carry of arms and ammunitions, crackers etc. in the location are totally
												prohibited.</li>
											<li>Use of sound system , microphone in the location of shooting are totally
												banned except the audio system etc. used for shooting purpose</li>
											
										</ol>
										
									<p>Any violation of the guidelines or permission accorded by the authority
										will render the erring organization ineligible for further consideration in addition
										to the cancellation of the permission granted for the purpose.</p>
									</td>
									</tr>
									</table>
								</div>
							</div>
							<br/>
							<div id="section6" class="container-fluid content-secondary">		
								<p class="text-center"><b>UNDERTAKING</b></p>
								<p>I certify that the details on this application accurately reflects the event as
									proposed, and I have fully read and understood the terms and conditions. If the
									event is approved, my company and I agree to abide by the guidelines etc.
									including do’s and don’ts established for this event.</p>
									
									
							</div>
							<table id="" class="table table-responsive">
							<tr>
								<td colspan="2">Date: <label><?php echo strtoupper($today) ?></label></td>
								<td colspan="2">Name: <label><?php echo strtoupper($film_details_name) ?></label><br/>
									Designation: <label><?php echo strtoupper($film_details_desig) ?></label>
								</td>	
							</tr>
							<tr>
								<td class="text-center" colspan="4">
									<a type="button" href="tourism_form1.php?tab=6" class="btn btn-primary">Go Back & Edit</a>				
									<button type="submit" class="btn btn-success" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">SUBMIT</button>
								</td>
							
							</tr>
							</table>
						
						</div>
						</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<?php 
if(isset($form_id)){
	$part1=$tourism->query("SELECT id FROM tourism_form1_t1 WHERE form_id='$form_id'");
	$num = $part1->num_rows;
}else{
	$num=0;
}
if($num>0){
	$hiddenval=$num+1;
	$num=$num+1;
}else{
	$hiddenval=2;
	$num=2;
}
?>
<script type="text/javascript">
		var index=<?php echo $num;?>;
		function addMore1(){
		var myobj=document.getElementById("objectTable1");
		var row=myobj.insertRow(myobj.rows.length);        var cell1=row.insertCell(0);		
		var array4 = ["Please Select"];
		var array4a = [""];
		//Create and append select list
		var t1 = document.createElement("select");
		t1.setAttribute("id", "txtA"+index);
		t1.setAttribute("name", "txtA"+index);
		t1.setAttribute("onclick", "selectcd(this.id)");
		
		t1.className = "form-control text-uppercase";
		cell1.appendChild(t1);
		//Create and append the options
		for (var i = 0; i < array4.length; i++) {
			var option = document.createElement("option");
			// $.ajax({ 
					// type: 'GET',
					// url: '../../../ajax/selectcd_tourism.php', 
					// data: { city: 1},
					// beforeSend:function(){
						// $(".selectcd").html("Loading..");
					// },
					// success:function(data){
						// $(".selectcd").html(data);
					// },
					// error:function(){ }
			// });
			option.setAttribute("value", array4a[i]);
			option.text = array4[i];
			t1.appendChild(option);
		}
        var cell2=row.insertCell(1);
	    var t2=document.createElement("input");
        t2.id = "txtB"+index;
		t2.name = "txtB"+index;
		t2.setAttribute("onclick", "dateadd(this.id)");
		t2.className = "form-control";
		t2.style="";
		t2.size="20";	
		//t2.title = "Only Numbers are allowed";
        cell2.appendChild(t2);
		var cell3=row.insertCell(2);
		var t3=document.createElement("input");
		t3.id = "txtC"+index;
		t3.name = "txtC"+index;
		t3.setAttribute("onclick", "dateadd(this.id)");
		t3.className = "form-control";
		t3.style="";
		t3.size="20";
		cell3.appendChild(t3);
		var cell4=row.insertCell(3);
		var t4=document.createElement("input");
		t4.id = "txtD"+index;				
		t4.name = "txtD"+index;
		t4.className = "form-control text-uppercase";
		t4.style="";
		t4.size="20";
		cell4.appendChild(t4);
		var cell5=row.insertCell(4);
		var t5=document.createElement("input");
		t5.id = "txtE"+index;				
		t5.name = "txtE"+index;
		t5.setAttribute("onclick", "timepickeradd(this.id)");
		t5.className = "form-control text-uppercase";
		t5.size="20";
		cell5.appendChild(t5);
		index++;
		document.getElementById("hiddenval").value=index;	}
	function mydelfunction1(){
		if(index>2){	
			var myobj=document.getElementById("objectTable1");
			myobj.deleteRow(-1);
			index--;
			document.getElementById("hiddenval").value=index;
		}
	}

</script>
<script>
$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){		
		$('#tab4').css('display', 'table');		
		$('#tab1, #tab2, #tab3, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');	
	});	
	$('a[href="#tab5"]').on('click', function(){		
		$('#tab5').css('display', 'table');		
		$('#tab1, #tab2, #tab3, #tab4, #tab6, #tab7, #tab8, #tab9').css('display', 'none');	
	});
	$('a[href="#tab6"]').on('click', function(){
		$('#tab6').css('display', 'table');		
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab7, #tab8, #tab9').css('display', 'none');	
		});	
	$('a[href="#tab7"]').on('click', function(){		
		$('#tab7').css('display', 'table');		
		$('#tab1, #tab2, #tab3,  #tab4, #tab5, #tab6, #tab8, #tab9').css('display', 'none');
		});	
	$('a[href="#tab8"]').on('click', function(){	
		$('#tab8').css('display', 'table');	
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab9').css('display', 'none');	
	});
	$('a[href="#tab9"]').on('click', function(){		
		$('#tab9').css('display', 'table');		
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8').css('display', 'none');	
	});	
	/* ----------------------------------------------------- */	
	$('#resid').hide();	
		$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ----------------------------------------------------- */
	function selectcd(id){
		$.ajax({ 
				type: 'GET',
				url: '../../../ajax/selectcd_tourism.php', 
				data: { city: 1},
				beforeSend:function(){
					if($("#"+id).html()=="<option>Please Select</option>"){
						$("#"+id).html("Loading...");
					}
					else if($("#"+id).html()=='<option value="">Please Select</option>'){
						$("#"+id).html("Loading...");
					}else{}
				},
				success:function(data){
					if($("#"+id).html()=="Loading..."){
						$("#"+id).html(data);
					}					
				},
				error:function(){ }
		});
	} 
	/* ----------------------------------------------------- */
	function timepickeradd(id){
		$("#"+id).wickedpicker();
	}
	function dateadd(id){
		$("#"+id).datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50", minDate: 0});
	}
	
	$('#dobn').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50", minDate: 0});
	/* ------------------------------------------------------ */
	<?php if($any_visit_radio=="N"){ ?>
		$('#any_visit').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="any_visit_radio"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#any_visit').removeAttr('disabled', 'disabled');			
		}else{
			$('#any_visit').attr('disabled', 'disabled');			
		}
	});
	<?php if($film_public_radio=="N"){ ?>
		$('#film_public').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="film_public_radio"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#film_public').removeAttr('disabled', 'disabled');			
		}else{
			$('#film_public').attr('disabled', 'disabled');			
		}
	});
	<?php if($applicant_refuse_radio=="N"){ ?>
		$('#applicant_refuse').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="applicant_refuse_radio"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#applicant_refuse').removeAttr('disabled', 'disabled');			
		}else{
			$('#applicant_refuse').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	/*<?php if(empty($wish_to_hire)){ ?>
		$('#wish_to_hire').attr('disabled', 'disabled');
	<?php } ?>*/
	$('#wish_to_hire_radio_yes').css('display','none');
	$('input[name="wish_to_hire"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#wish_to_hire_radio_yes').css('display','table');			
		}else{
			$('#wish_to_hire_radio_yes').css('display','none');			
		}
	});
	$('#forest_area_radio_yes').css('display','none');
	$('input[name="forest_area"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#forest_area_radio_yes').css('display','table');			
		}else{
			$('#forest_area_radio_yes').css('display','none');			
		}
	});
	$('#temp_film_radio_yes').css('display','none');
	$('input[name="temp_film"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#temp_film_radio_yes').css('display','table');			
		}else{
			$('#temp_film_radio_yes').css('display','none');			
		}
	});
	$('#film_arch_radio_yes').css('display','none');
	$('input[name="film_arch"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#film_arch_radio_yes').css('display','table');			
		}else{
			$('#film_arch_radio_yes').css('display','none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	$('.dobold').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	$('.dobnew').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	/* ---------------------upload S/C click operation-------------------- */
	// var strtDt  = new $('.dobold').val();
	// var endDt  = new $('.dobnew').val();

	// if (endDt <= strtDt){
	   // alert("true");
	// }
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' ||$file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC' ||$file9=='SC' ||$file10=='SC'||$file11=='SC'||$file12=='SC'||$file13=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	
</script>

</body>
</html>>