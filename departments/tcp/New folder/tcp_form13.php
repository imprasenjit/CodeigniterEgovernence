<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('tcp','1');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=tcp';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=tcp';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_tcp_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$owner_type=$row1['Type_of_ownership'];$owner_name=$row1['Name_of_owner'];$pan_no=$row1['pan_no'];$trade_name=$row1['Name'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_pincode=$row1['b_pincode'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$pincode=$row1['Pincode'];$block=$row1['block'];$std_code=$row1['Landline_std'];$phone_no=$row1['Landline_no'];$mobile_no=$row1['Mobile_no'];$cap_investment=$row1['Size_of_Investment'];
		$tcp_zone=$row1['b_block'];$id_proof_doc=$row1['id_proof_doc'];
		$sector_classes_b=$row1['sector_classes_b'];
		
		$q=$tcp->query("select * from tcp_form1 where user_id='$swr_id' and active='1'") or die($tcp->error);
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";
			$app_cat="";$fm_name="";$spouse_nm="";$own_name="";$j_own_name="";$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";$vill_revenue="";$locality="";$land_use="";$road_name="";$road_width="";$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";$build_cat="";$prop_use="";$plot_area="";$build_area="";$con_type="";$no_of_floor="";$margin_north="";$margin_south="";$margin_east="";$margin_west="";$canti_north="";$canti_south="";$canti_east="";$canti_west="";$park_no_base="";$park_no_grnd="";$park_no_open="";$park_area_base="";$park_area_grnd="";$park_area_open="";$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";$total_area="";$b_wall="";$length="";$height="";$is_v_ext="";$v_no_floor="";$is_h_ext="";$h_no_floor="";$reg_no="";$rtp_name="";$tp_mobile_no="";$tp_email="";
			$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";$file9="";$file10="";$file11="";

			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$app_cat=$results["app_cat"];$fm_name=$results["fm_name"];$spouse_nm=$results["spouse_nm"];$own_name=$results["own_name"];$j_own_name=$results["j_own_name"];$vill_revenue=$results["vill_revenue"];$locality=$results["locality"];$land_use=$results["land_use"];$road_name=$results["road_name"];$road_width=$results["road_width"];$build_cat=$results["build_cat"];$prop_use=$results["prop_use"];$plot_area=$results["plot_area"];$build_area=$results["build_area"];$con_type=$results["con_type"];$no_of_floor=$results["no_of_floor"];$total_area=$results["total_area"];$b_wall=$results["b_wall"];$length=$results["length"];$height=$results["height"];$is_v_ext=$results["is_v_ext"];$v_no_floor=$results["v_no_floor"];$is_h_ext=$results["is_h_ext"];$h_no_floor=$results["h_no_floor"];$reg_no=$results["reg_no"];$rtp_name=$results["rtp_name"];$tp_mobile_no=$results["tp_mobile_no"];$tp_email=$results["tp_email"];
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];
			
			if(!empty($results["prop"])){
				$prop=json_decode($results["prop"]);
				$prop_house_no=$prop->house_no;$prop_new_dagno=$prop->new_dagno;$prop_old_dagno=$prop->old_dagno;$prop_pattano=$prop->pattano;$prop_mouza=$prop->mouza;$prop_wardno=$prop->wardno;$prop_panchayat=$prop->panchayat;$prop_zone=$prop->zone;
			}else{				
				$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";
			}
			if(!empty($results["adjoin"])){
				$adjoin=json_decode($results["adjoin"]);
				$adjoin_north=$adjoin->north;$adjoin_south=$adjoin->south;$adjoin_east=$adjoin->east;$adjoin_west=$adjoin->west;
			}else{				
				$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";
			}
			if(!empty($results["margin"])){
				$margin=json_decode($results["margin"]);
				$margin_north=$margin->north;$margin_south=$margin->south;$margin_east=$margin->east;$margin_west=$margin->west;
			}else{				
				$margin_north="";$margin_south="";$margin_east="";$margin_west="";
			}
			if(!empty($results["canti"])){
				$canti=json_decode($results["canti"]);
				$canti_north=$canti->north;$canti_south=$canti->south;$canti_east=$canti->east;$canti_west=$canti->west;
			}else{				
				$canti_north="";$canti_south="";$canti_east="";$canti_west="";
			}
			if(!empty($results["park_no"])){
				$park_no=json_decode($results["park_no"]);
				$park_no_base=$park_no->base;$park_no_grnd=$park_no->grnd;$park_no_open=$park_no->open;
			}else{				
				$park_no_base="";$park_no_grnd="";$park_no_open="";
			}
			if(!empty($results["park_area"])){
				$park_area=json_decode($results["park_area"]);
				$park_area_base=$park_area->base;$park_area_grnd=$park_area->grnd;$park_area_open=$park_area->open;
			}else{				
				$park_area_base="";$park_area_grnd="";$park_area_open="";
			}
			if(!empty($results["area"])){
				$area=json_decode($results["area"]);
				$area_grnd=$area->grnd;$area_first=$area->first;$area_second=$area->second;$area_thrid=$area->thrid;$area_fourth=$area->fourth;$area_fifth=$area->fifth;$area_sixth=$area->sixth;$area_sevnth=$area->sevnth;$area_eight=$area->eight;
			}else{				
				$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";
			}
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
		##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
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
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
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
<div id="gif"></div>
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='13'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
									   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
									   <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a>
									   </li>
									   <li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a>
									   </li>
									</ul>
								<br>
				<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                         <table class="table table-responsive">
								<tr>
									<td colspan="4"><strong>1. Design</strong></td>
								</tr>
								<tr>
									<td width="25%">1.1 Design / Drawings available</td>
									<td width="25%"><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td width="25%">Design Category</td>
									<td width="25%"><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
								</tr>
								<tr>
									<td>Type Design</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>Specific design</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Drawings prepared / checked by competent Authority</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>Design Drawings / details Structural detailed included Earthquake / cyclone resistant features included</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
								</tr>
								<tr>
									<td>Design verified / vetted by Dept. / Govt. approved agency / competent authority</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>Design changes approved by Dept. / Govt. approved agency / competent authority </td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
								</tr>
								<tr>
									<td colspan="4"><strong>2. Foundation</strong></td>
								</tr>
								<tr>
									<td>2.1 Foundation used</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Existing
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >New
										</label></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><strong>2.2 If existing foundation used</strong></td>
								</tr>
								<tr>
									<td>2.2.1 Depth of foundation below ground</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">&lt;50cm</option>
										<option value="b">50-70cm</option>
										<option value="c">&gt;70cm</option>
										</select>
									</td>
									<td>2.2.2 Type of foundation</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Isolated</option>
										<option value="b">Combined</option>
										<option value="c">Raft</option>
										<option value="d">Piled</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.2.3 Thickness of masonry (above ground)</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>2.2.4 Mortar used and Mix of cement mortar</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Cement-Sand</option>
										<option value="b">Lime and1:4</option>
										<option value="c">1:6</option>
										<option value="d">Leaner</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.2.5 Grade of concrete (M20)</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>2.2.6 Height up to Plinth(cm)</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">2.2.7 If stone masonry</td>
								</tr>
								<tr>
									<td>2.2.7.1 Through Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>If Yes</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Adequate</option>
										<option value="b">Inadequate</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.2.7.2 Corner Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>If Yes</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Adequate</option>
										<option value="b">Inadequate</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>2.3 If new foundation used</strong></td>
								</tr>
								<tr>
									<td>2.3.1 Depth of foundation below ground</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">&lt;50cm</option>
										<option value="b">50-70cm</option>
										<option value="c">&gt;70cm</option>
										</select>
									</td>
									<td>2.3.2 Type of foundation</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Isolated</option>
										<option value="b">Combined</option>
										<option value="c">Raft</option>
										<option value="d">Piled</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.3.3 Thickness of Masonry above plinth</td>
									<td><input type="text"  class="form-control text-uppercase"></td>
									<td>2.3.4 Mortar used and Mix of cement mortar (1:4)</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Cement-Sand</option>
										<option value="b">Lime </option>
										<option value="c">Mud and Y/N</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.3.5 Grade of concrete (M20)</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>2.3.6 Height up to Plinth</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">&lt;60cm</option>
										<option value="b">&gt;60cm </option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4">2.3.7 If stone masonry</td>
								</tr>
								<tr>
									<td>2.3.7.1 Through Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>If Yes</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Adequate</option>
										<option value="b">Inadequate</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.3.7.2 Corner Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td>If Yes</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Adequate</option>
										<option value="b">Inadequate</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>2.3.7.3.Vertical reinforcement in foundation</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>
								</tr>									
							</table>
						</form>
						</div>
						<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
						<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table class="table table-responsive" >
								<tr>
									<td colspan="4"><strong>3. Walling</strong></td>
								</tr>
								<tr>
									<td width="25%">3.1 Type of masonry</td>
									<td width="25%"><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Brick</option>
										<option value="b">PCC Blocks</option>
										<option value="c">Stone</option>
										</select>
									</td>
									<td width="25%">3.2 Mortar used</td>
									<td width="25%"><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Cement - Sand</option>
										<option value="b">Lime</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>3.3 Mix of cement mortar</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">1:4</option>
										<option value="b">1:6</option>
										<option value="c">Leaner</option>
										</select>
									</td>
									<td>3.4 Thickness of wall</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">&gt;23cm</option>
										<option value="b">23cm</option>
										<option value="c">23cm</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>3.5 Mixing of mortar</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
									<td>3.6 Joint Property filled</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>3.7 Wetting of bricks</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Good</option>
										<option value="b">Medium</option>
										<option value="c">Poor</option>
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">3.8 If stone masonry</td>
								</tr>
								<tr>
									<td>3.8.1 Through Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>3.8.2 Corner Stones</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label></td>
								</tr>
								<tr>
									<td>3.9 Overall workmanship</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Good</option>
										<option value="b">Medium</option>
										<option value="c">Poor</option>
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><strong>4 Roofing</strong></td>
								</tr>
								<tr>
									<td>4.1 Type of roof</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Flat</option>
										<option value="b">Sloping</option>
										</select>
									</td>
									<td>4.2 If sloped</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">A.C. sheet</option>
										<option value="b">G.I. sheet</option>
										<option value="c">Morbid tiles</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>4.3 Purlins</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Angle-Iron</option>
										<option value="b">Timber</option>
										<option value="c">NA</option>
										</select>
									</td>
									<td>4.4 Truss type</td>
									<td><input type="text" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>4.5 Anchorage with wall</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Adequate</option>
										<option value="b">Inadequate</option>
										<option value="c">NA</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>5. Materials</strong></td>
								</tr>
								<tr>
									<td colspan="4">5.1 Cement</td>
								</tr>
								<tr>
									<td>5.1 Cement</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Authorized Dealer/</option>
										<option value="b">Authorized Dealer/</option>
										</select>
									</td>
									<td>5.1.2 Type of cement</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OPC</option>
										<option value="b">PPC</option>
										<option value="c">PSC</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>5.1.3 If OPC</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Grade 33</option>
										<option value="b">Grade 43</option>
										<option value="c">Grade 53</option>
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><strong>5.2 Sand</strong></td>
								</tr>
								<tr>
									<td>5.2.1 Type of sand</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">River sand</option>
										<option value="b">Stone dust</option>
										</select>
									</td>
									<td>5.2.2 Presence of deleterious materials</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Mild</option>
										<option value="b">Moderate</option>
										<option value="c">High</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>5.3 Coarse Aggregates</strong></td>
								</tr>
								<tr>
									<td>5.3.1 Type coarse Aggregates</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Mild</option>
										<option value="b">Crushed Stone</option>
										</select>
									</td>
									<td>5.3.2 Presence of deleterious material</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Mild</option>
										<option value="b">Moderate</option>
										<option value="c">High</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4">5.4 P.C.C. Blocks (Applicable for onsite production)</td>
								</tr>
								<tr>
									<td>5.4.1 Type of P.C.C. Blocks</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Solid blocks</option>
										<option value="b">Hollow blocks</option>
										</select>
									</td>
									<td>5.4.2 Ratio of concrete in blocks</td>
									<td><input type="text" class="form-control text-uppercase"</td>
								</tr>
								<tr>
									<td>5.4.3 Interlocking feature</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>5.4.4 Course aggregates used</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Natural</option>
										<option value="b">Crushed stone</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4">5.5 Bricks Blocks, Stone etc.</td>
								</tr>
								<tr>
									<td>5.5.1 Strength (field assessment)</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Low</option>
										<option value="b">Medium</option>
										<option value="c">High</option>
										</select>
									</td>
									<td>5.5.2 Dimensional accuracy</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>
								</tr>
							</table>
						</form>
						</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
						<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table class="table table-responsive" >
								<tr>
									<td colspan="4"><strong>5.6 Concrete</strong></td>
								</tr>
								<tr>
									<td width="25%">5.6.1. Mix of concrete</td>
									<td width=="25%"><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">M20</option>
										<option value="b">Design Mix</option>
										</select>
									</td>
									<td width="25%">5.6.2 Batching</td>
									<td width="25%"><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Weigh batching</option>
										<option value="b">Volume batching</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>5.6.3 Compaction</td>
									<td width="25%"><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Vibrators</option>
										<option value="b">Thappies and rods</option>
										</select>
									</td>
									<td>5.6.4 Workability</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Low</option>
										<option value="b">Medium</option>
										<option value="c">High</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>5.6.5 Availability of water</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Optimum</option>
										<option value="b">Sufficient</option>
										<option value="c">Insufficient</option>
										</select>
									</td>
									<td>5.6.6 Curing</td>Satisfactory/Unsatisfactory.
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Satisfactory</option>
										<option value="b">Unsatisfactory</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>5.7 Reinforcing Steel</strong></td>
								</tr>
								<tr>
									<td>5.7.1 Type of Steel</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Plain mild steel</option>
										<option value="b">HYSD bars</option>
										</select>
									</td>
									<td>5.7.2 Source</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Authorised Dealer</option>
										<option value="b">Market</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>5.7.3 Whether IS marked</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>5.7.4 Conditions of bars</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Clean</option>
										<option value="b">Corroded</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>5.7.5 Fixing of reinforcement as per drawing</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>5.7.6 Suitable cover</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td>5.7.7 Spacing of bars</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Regular</option>
										<option value="b">Irregular</option>
										</select>
									</td>
									<td>5.7.8 Overlaps as per specifications</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>5.8 Form Work</strong></td>
								</tr>
								<tr>
									<td>5.8.1 Type of Form Work</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Timber</option>
										<option value="b">Plyboard</option>
										<option value="c">Steel</option>
										</select>
									</td>
									<td>5.7.8 Overlaps as per specifications</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td>5.8.3 Leakage of cement slurry</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">Observed</option>
										<option value="b">Not observed</option>
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="4"><strong>5.9 Source</strong></td>
								</tr>
								<tr>
									<td>5.9.1 Cement</td>
									<td><input type="text" class="form-control text-uppercase"></td>
									<td>5.9.2 Sand</td>
									<td><input type="text" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>5.9.3 Coarse Agg.</td>
									<td><input type="text" class="form-control text-uppercase"></td>
									<td>5.9.4 Bricks</td>
									<td><input type="text" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>5.9.5 PCC blocks.</td>
									<td><input type="text" class="form-control text-uppercase"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><strong>6. Seismic resistance features</td>
								</tr>
								<tr>
									<td colspan="4">6.1 Masonry Structures</td>
								</tr>
								<tr>
									<td colspan="4">6.1.1 Provision of bands at Provided Adequate</td>
								</tr>
								<tr>
									<td>6.1.1.1 Plinth level</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>6.1.1.2 Sill level</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td>6.1.1.3 Lintel level</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>6.1.1.4 Roof level (if applicable)</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="4">6.1.2 If sloped Roof, whether seismic bands are provide at</td>
								</tr>
								<tr>
									<td>6.1.2.1 Gable wall top</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>6.1.2.2 Eaves level</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td colspan="4">6.1.3 Provision of vertical steel in masonry at Provided Adequate</td>
								</tr>
								<tr>
									<td>6.1.3.1 Each corner</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>6.1.3.2 Each T-junction</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td>6.1.3.3 Each door joint</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
									<td>6.1.3.4 Around each window</td>
									<td><label class="radio-inline">
										  <input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes
										</label>
										<label class="radio-inline">
										  <input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No
										</label>
									</td>
								</tr>
								<tr>
									<td  colspan="4">6.1.4 Openings</td>
								</tr>
								<tr>
									<td>6.1.4.1 Total width of openings</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">&lt;50%</option>
										<option value="b">50*-60%</option>
										<option value="c">&gt;60%</option>
										</select>
									</td>
									<td>6.1.4.2 Clearance from corner</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>6.1.4.3 Pier width between two openings</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"><strong>6.2 Framed Structures</strong></td>
								</tr>
								<tr>
									<td colspan="4">6.2.1 Ductile detailing</td>
								</tr>
								<tr>
									<td >6.2.1.1 Spacing of stirrup</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
									<td>6.2.1.2 Sizes of members</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>6.2.1.3 End anchorage</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
									<td>6.2.1.4 Lapping (length, location etc.)</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>
										<option value="a">OK</option>
										<option value="b">Not OK</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>6.2.1.5 Angle of stirrup hook</td>
									<td><select class="form-control text-uppercase">
										<option value="">Please Select</option>  
										<option value="a">90 degrees</option>
										<option value="b">135 degrees</option>
										</select>
									</td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">6.3 Any testing carried out by Owner/Engg. Supervisor on</td>
								</tr>
								<tr>
									<td colspan="4">
										<table class="table table-responsive" >
											<tr>
												<td></td>
												<td>Testing done</td>
												<td>Testing results</td>
											</tr>
											<tr>
												<td>6.3.1 Water</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.2 Cement</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.3 Bricks/PCC blocks/Stones</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.4 Aggregate</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.5 Mortar</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.6 Concrete</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											<tr>
												<td>6.3.7 Reinforcement</td>
												<td><label class="radio-inline">
													<input type="radio"  value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >Yes</label>
													<label class="radio-inline">
													<input type="radio"  value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >No</label>
												</td>
												<td><select class="form-control text-uppercase">
														<option value="">Please Select</option>
														<option value="a">OK</option>
														<option value="b">Not OK</option>
													</select>
												</td>
											</tr>
											
										</table>
									</td>
								</tr>
								<tr>
									<td>Date:<strong><? echo date('d-m-Y',strtotime($today));?></strong></td>
									<td>Signature of Applicant</td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
		<?php if($is_v_ext=="N"){ ?>
	$('#v_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_v_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#v_no_floor').attr('disabled', 'disabled');
		else
			$('#v_no_floor').removeAttr('disabled');
	});
	<?php if($is_h_ext=="N"){ ?>
	$('#h_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_h_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#h_no_floor').attr('disabled', 'disabled');
		else
			$('#h_no_floor').removeAttr('disabled');
	});
	/* ---------------------upload S/C click operation-------------------- */
	
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' || $file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>		
