<?php  require_once "../../requires/login_session.php";
$dept="tcp";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_tcp_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and save_mode='D'");
if($q->num_rows<1){	
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();
		$form_id=$results["form_id"];$app_cat=$results["app_cat"];$fm_name=$results["fm_name"];$spouse_nm=$results["spouse_nm"];$own_name=$results["own_name"];$j_own_name=$results["j_own_name"];$vill_revenue=$results["vill_revenue"];$locality=$results["locality"];$land_use=$results["land_use"];$road_name=$results["road_name"];$road_width=$results["road_width"];$build_cat=$results["build_cat"];$prop_use=$results["prop_use"];$plot_area=$results["plot_area"];$build_area=$results["build_area"];$con_type=$results["con_type"];$no_of_floor=$results["no_of_floor"];$total_area=$results["total_area"];$b_wall=$results["b_wall"];$length=$results["length"];$height=$results["height"];$is_v_ext=$results["is_v_ext"];$v_no_floor=$results["v_no_floor"];$is_h_ext=$results["is_h_ext"];$h_no_floor=$results["h_no_floor"];$reg_no=$results["reg_no"];$rtp_name=$results["rtp_name"];$tp_mobile_no=$results["tp_mobile_no"];$tp_email=$results["tp_email"];
		$building_height=$results["building_height"];$premise_use=$results["premise_use"];
		$abutting_road_width=$results["abutting_road_width"];$material_storage=$results["material_storage"];
		
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
	}else{
		$form_id="";
		$app_cat="";$fm_name="";$spouse_nm="";$own_name="";$j_own_name="";$prop_house_no="";$prop_new_dagno="";$prop_old_dagno="";$prop_pattano="";$prop_mouza="";$prop_wardno="";$prop_panchayat="";$prop_zone="";$vill_revenue="";$locality="";$land_use="";$road_name="";$road_width="";$adjoin_north="";$adjoin_south="";$adjoin_east="";$adjoin_west="";$build_cat="";$prop_use="";$plot_area="";$build_area="";$con_type="";$no_of_floor="";$margin_north="";$margin_south="";$margin_east="";$margin_west="";$canti_north="";$canti_south="";$canti_east="";$canti_west="";$park_no_base="";$park_no_grnd="";$park_no_open="";$park_area_base="";$park_area_grnd="";$park_area_open="";$area_grnd="";$area_first="";$area_second="";$area_thrid="";$area_fourth="";$area_fifth="";$area_sixth="";$area_sevnth="";$area_eight="";$total_area="";$b_wall="";$length="";$height="";$is_v_ext="";$v_no_floor="";$is_h_ext="";$h_no_floor="";$reg_no="";$rtp_name="";$tp_mobile_no="";$tp_email="";
		$building_height="";$premise_use="";$abutting_road_width="";$material_storage="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$app_cat=$results["app_cat"];$fm_name=$results["fm_name"];$spouse_nm=$results["spouse_nm"];$own_name=$results["own_name"];$j_own_name=$results["j_own_name"];$vill_revenue=$results["vill_revenue"];$locality=$results["locality"];$land_use=$results["land_use"];$road_name=$results["road_name"];$road_width=$results["road_width"];$build_cat=$results["build_cat"];$prop_use=$results["prop_use"];$plot_area=$results["plot_area"];$build_area=$results["build_area"];$con_type=$results["con_type"];$no_of_floor=$results["no_of_floor"];$total_area=$results["total_area"];$b_wall=$results["b_wall"];$length=$results["length"];$height=$results["height"];$is_v_ext=$results["is_v_ext"];$v_no_floor=$results["v_no_floor"];$is_h_ext=$results["is_h_ext"];$h_no_floor=$results["h_no_floor"];$reg_no=$results["reg_no"];$rtp_name=$results["rtp_name"];$tp_mobile_no=$results["tp_mobile_no"];$tp_email=$results["tp_email"];
	$building_height=$results["building_height"];$premise_use=$results["premise_use"];
	$abutting_road_width=$results["abutting_road_width"];$material_storage=$results["material_storage"];
	
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
								<h4 class="text-center text-bold" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
								   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">Details of the Applicant</a></li>
								   <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Details of the Proposed Site</a></li>
								   <li class="<?php echo $tabbtn3; ?>"><a href="#table3">Details of the Building Plan</a></li>
								</ul><br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
										<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
											<table class="table table-responsive">
												<tr>
													<td width="25%">Application Category :<span class="mandatory_field">*</span></td>
													<td colspan="3">
														<label class="radio-inline">
														  <input type="radio" name="app_cat" value="NB" <?php if($app_cat=='NB') echo 'checked'; ?> required >New Building
														</label>
														<label class="radio-inline">
														  <input type="radio" name="app_cat" value="RE" <?php if($app_cat=='RE') echo 'checked'; ?> >Re Erect
														</label>
														<label class="radio-inline">
														  <input type="radio" name="app_cat" value="MA" <?php if($app_cat=='MA') echo 'checked'; ?> >Material Alteration
														</label>
													</td>
												</tr>
											   <tr>
													<td width="25%">1.  Name of the Applicant :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" value="<?php echo $key_person; ?>" disabled ></td>
													<td width="25%"></td>
													<td width="25%"></td>
											   </tr>
											   <tr>
													<td colspan="4">2. Applicant Address :</td>
											  </tr>
											   <tr>
													<td width="25%"> Steert Name 1 :</td>
													<td width="25%"><input type="text"  class="form-control" disabled value="<?php echo $street_name1; ?>" ></td>
													<td width="25%">Street Name 2 :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $street_name2; ?>" ></td>
												</tr>
												<tr>
													<td>Village/Town :</td>
													<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $vill; ?>" ></td>
													<td>District :</td>
													<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist; ?>" ></td> 
												</tr>
												<tr>
												   <td>Pincode : </td>
												   <td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pincode; ?>" ></td>
												   <td>Mobile No. :</td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $mobile_no; ?>"/></td>
												</tr>
												<tr>
													<td>Email ID :</td>
													<td><input type="text" class="form-control" disabled value="<?php  echo $email; ?>"/></td>
													<td>Pan No. :</td>
													<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $pan_no; ?>" ></td>
												</tr>
												<tr>
												   <td>3. Father/Mother Name:</td>
													<td><input type="text" name="fm_name"  class="form-control text-uppercase" validate="letters" value="<?php echo $fm_name; ?>" ></td>
													<td>4. Spouse Name:</td>
													<td><input type="text" name="spouse_nm" validate="letters" value="<?php echo $spouse_nm; ?>" class="form-control text-uppercase" ></td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">				
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
													</td>
												</tr>
											</table>			
										</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
										<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
											<table class="table table-responsive" >
												<tr>
													<td width="25%">1.  Name of the Owner of the Land :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="own_name" validate="letters" value="<?php echo $own_name; ?>" >
													</td>
													<td width="25%">2. Name of the Joint Owner :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="j_own_name" validate="letters" value="<?php echo $j_own_name; ?>" >
													</td>
											   </tr>
												<tr>
													<td colspan="4">3. Address of the Proposed Site:</td>
											   </tr>
												<tr>
													<td>House/Plot no:</td>
													<td><input type="text"  class="form-control"  name="prop[house_no]" value="<?php echo $prop_house_no; ?>" ></td>
													<td>Dag no(New) :</td>
													<td><input type="text" name="prop[new_dagno]" class="form-control text-uppercase" value="<?php echo $prop_new_dagno; ?>" ></td> 
												 </tr>
												 <tr>
													<td>Dag no(Old) :</td>
													<td><input type="text"  class="form-control text-uppercase" name="prop[old_dagno]" value="<?php echo $prop_old_dagno; ?>" ></td>
													<td>Patta no :</td>
													<td><input type="text" name="prop[pattano]" class="form-control text-uppercase" value="<?php echo $prop_pattano; ?>" ></td></tr>
												 <tr>
													<td>Mouza :</td>
													<td><input type="text"  class="form-control text-uppercase" name="prop[mouza]" value="<?php echo $prop_mouza; ?>" ></td>
													<td>Ward no :</td>
													<td><input type="text"  class="form-control text-uppercase" name="prop[wardno]" value="<?php echo $prop_wardno; ?>" ></td> 
												</tr>
												<tr>
													<td width="25%">Municipality/Gaon Panchayat Name  :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="prop[panchayat]" value="<?php echo $prop_panchayat; ?>" ></td>
													<td width="25%">Zone:</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="prop[zone]" value="<?php echo $prop_zone; ?>"  ></td>
												</tr>
												<tr>
													<td> Revenue Village :</td>
													<td><input type="text"  class="form-control text-uppercase" name="vill_revenue"  validate="letters" value="<?php echo $vill_revenue; ?>" ></td>
													<td> Locality : </td>
													<td><input type="text"  class="form-control text-uppercase" name="locality" validate="letters" value="<?php echo $locality; ?>" ></td>
												</tr>
												<tr>
													<td>Land Use:</td> 
													<td><input type="text" class="form-control text-uppercase" name="land_use" value="<?php echo $land_use; ?>" ></td>
													<td>Road/Street Name :</td>
													<td><input type="text" class="form-control text-uppercase" name="road_name" value="<?php echo $road_name; ?>" ></td>
												<tr>
													<td>Width of the Road:</td>
													<td><input type="text" class="form-control text-uppercase" name="road_width" value="<?php echo $road_width; ?>"  ></td>
												</tr>
												<tr>
													<td colspan="4">(b) Name of owners of adjoining Land:</td>
												</tr>
												<tr>
													<td>North :</td>
													<td><input type="text" class="form-control text-uppercase"  name="adjoin[north]" validate="letters" value="<?php echo $adjoin_north; ?>"></td>
													<td>South :</td>
													<td><input type="text" class="form-control text-uppercase"  name="adjoin[south]" validate="letters" value="<?php echo $adjoin_south; ?>"></td>
												</tr>
												<tr>
													<td>East :</td>
													<td><input type="text" class="form-control text-uppercase"  name="adjoin[east]" validate="letters" value="<?php echo $adjoin_east; ?>" ></td>
													<td>West :</td>
													<td><input type="text" class="form-control text-uppercase"  name="adjoin[west]" validate="letters" value="<?php echo $adjoin_west; ?>"></td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save &amp; Next</button>
													</td>
												</tr>
										  </table>
										</form>
									</div>
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform" id="myform21" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
											<table  id=""  class="table table-responsive" >
												<tr>
													<td width="25%">1. Building Category :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="build_cat" value="<?php echo $build_cat; ?>" ></td>
													<td width="25%">2. Proposed Use :</td>
													<td width="25%">
														<select name="prop_use" class="form-control text-uppercase" required="required">
															<option selected value="">Please Select</option>
															<option <?php if($prop_use=="R") echo "selected"; ?> value="R">Residential/Commercial</option>
															<option <?php if($prop_use=="S") echo "selected"; ?> value="S">Storage/Warehouses</option>
															<option <?php if($prop_use=="I") echo "selected"; ?> value="I">Industries</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>3. Plot Area: (Patta Land recorded area in Sq Mtr) :</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="plot_area" value="<?php echo $plot_area; ?>"></td>
													<td>4. Document / Building Area (Built up area in Sq Mtr) :</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="build_area" value="<?php echo $build_area; ?>"></td>
												</tr>
												<tr>
													<td>Height of the Building (in Meters):</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="building_height" value="<?php echo $building_height; ?>"></td>
													<td>Use of the Premise :</td>
													<td>
														<select name="premise_use" class="form-control text-uppercase" required="required">
															<option selected value="">Please Select</option></option>
															<option <?php if($premise_use=="RP") echo "selected"; ?> value="RP">Residential Plotted</option>
															<option <?php if($premise_use=="GH") echo "selected"; ?> value="GH">Group Housing</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>Abutting road width (in Meters):</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="abutting_road_width" value="<?php echo $abutting_road_width; ?>"></td>
													<td>Type of Material Storage :</td>
													<td>
														<select name="material_storage" class="form-control text-uppercase" required="required">
															<option selected value="">Please Select</option>
															<option <?php if($material_storage=="A") echo "selected"; ?> value="A">Category A Buildings (Built up Area 5000 sq.mt - 20000 sq.mt)</option>
															<option <?php if($material_storage=="BM") echo "selected"; ?> value="BM">Category B Buildings (Built up Area 20000 sq.mt - 50000 sq.mt) - Stacking Height Medium</option>
															<option <?php if($material_storage=="BH") echo "selected"; ?> value="BH">Category B Buildings (Built up Area 20000 sq.mt - 50000 sq.mt) - Stacking Height High</option>
															<option <?php if($material_storage=="C") echo "selected"; ?> value="C">Category C Buildings (Built up Area 50000 sq.mt - 150000 sq.mt)</option>
														</select>
													</td>
												</tr>
												<tr>
													<td>5. Type of Construction:</td>
													<td><input type="text" class="form-control text-uppercase" name="con_type" value="<?php echo $con_type; ?>"></td>
													<td>6. No. of Floors:</td>
													<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor" value="<?php echo $no_of_floor; ?>"></td>
												</tr>
												<tr>
													<td colspan="4">7. Margin Set back:</td>
												</tr>
												<tr>
													<td>North :</td>
													<td><input type="text" class="form-control text-uppercase"  name="margin[north]" value="<?php echo $margin_north; ?>"></td>
													<td>South :</td>
													<td><input type="text" class="form-control text-uppercase"  name="margin[south]" value="<?php echo $margin_south; ?>"></td>
												</tr>
												<tr>
													<td>East :</td>
													<td><input type="text" class="form-control text-uppercase"  name="margin[east]" value="<?php echo $margin_east; ?>" ></td>
													<td>West :</td>
													<td><input type="text" class="form-control text-uppercase"  name="margin[west]" value="<?php echo $margin_west; ?>"></td>
												</tr>
												<tr>
													<td colspan="4">8. Cantilever:</td>
												</tr>
												<tr>
													<td>North :</td>
													<td><input type="text" class="form-control text-uppercase"  name="canti[north]" value="<?php echo $canti_north; ?>"></td>
													<td>South :</td>
													<td><input type="text" class="form-control text-uppercase"  name="canti[south]" value="<?php echo $canti_south; ?>"></td>
												</tr>
												<tr>
													<td>East :</td>
													<td><input type="text" class="form-control text-uppercase"  name="canti[east]" value="<?php echo $canti_east; ?>" ></td>
													<td>West :</td>
													<td><input type="text" class="form-control text-uppercase"  name="canti[west]" value="<?php echo $canti_west; ?>"></td>
												</tr>
												<tr>
													<td colspan="4">9. Parking Details:</td>
												</tr>
												<tr>
													<td  colspan="4">
														<table class="table table-responsive">
															<tr>
																<th width="30%">Area</th>
																<th width="30%">Total No.</th>
																<th width="40%">Total Area.(in sq mtrs)</th>
															</tr>
															<tr>
																<td>Basement</td>
																<td><input type="text" class="form-control text-uppercase"  name="park_no[base]" value="<?php echo $park_no_base; ?>" validate="onlyNumbers"></td>
																<td><input type="text" class="form-control text-uppercase"  name="park_area[base]" value="<?php echo $park_area_base; ?>" validate="decimal"></td>
															</tr>
															<tr>
																<td>Ground</td>
																<td><input type="text" class="form-control text-uppercase"  name="park_no[grnd]" value="<?php echo $park_no_grnd; ?>" validate="onlyNumbers"></td>
																<td><input type="text" class="form-control text-uppercase"  name="park_area[grnd]" value="<?php echo $park_area_grnd; ?>" validate="decimal"></td>
															</tr>
															<tr>
																<td>Open</td>
																<td><input type="text" class="form-control text-uppercase"  name="park_no[open]" value="<?php echo $park_no_open; ?>" validate="onlyNumbers"></td>
																<td><input type="text" class="form-control text-uppercase"  name="park_area[open]" value="<?php echo $park_area_open; ?>" validate="decimal"></td>
															</tr>
														</table>
													</td>
												</tr>
												<tr>
													<td colspan="4">10. Area of Floors:</td>
												</tr>
												<tr>
													<td  colspan="4">
														<table class="table table-responsive">
															<thead>
																<tr>
																	<th>Floor</th>
																	<th>Area(in Sq mtr.)</th>
																	<th>Floor</th>
																	<th>Area(in Sq mtr.)</th>
																	<th>Floor </th>
																	<th>Area(in Sq mtr)</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td>Ground</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[grnd]" value="<?php echo $area_grnd; ?>" validate="decimal"></td>
																	<td>Third</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[thrid]" value="<?php echo $area_thrid; ?>" validate="decimal"></td>
																	<td>Sixth</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[sixth]" value="<?php echo $area_sixth; ?>" validate="decimal"></td>
																</tr>
																<tr>
																	<td>First</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[first]" value="<?php echo $area_first; ?>" validate="decimal"></td>
																	<td>Fourth</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[fourth]" value="<?php echo $area_fourth; ?>" validate="decimal"></td>
																	<td>Seventh</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[sevnth]" value="<?php echo $area_sevnth; ?>" validate="decimal"></td>
																</tr>
																<tr>
																	<td>Second</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[second]" value="<?php echo $area_second; ?>" validate="decimal"></td>
																	<td>Fifth</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[fifth]" value="<?php echo $area_fifth; ?>" validate="decimal"></td>
																	<td>Eight</td>
																	<td><input type="text" class="form-control text-uppercase"  name="area[eight]" value="<?php echo $area_eight; ?>" validate="decimal"></td>
																</tr>
															</tbody>
														</table>
													</td>
												</tr>
												<tr>
													<td>11. Total Area in Sq Mtr:</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="total_area" value="<?php echo $total_area; ?>"></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>12.Boundary Wall Details(in mtrs):</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="b_wall" value="<?php echo $b_wall; ?>"></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td>(a) Length:</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="length" value="<?php echo $length; ?>"></td>
													<td>(b)Height:</td>
													<td><input type="text" class="form-control text-uppercase" validate="decimal" name="height" value="<?php echo $height; ?>"></td>
												</tr>
												<tr>
												  <td colspan="4">13. Is there any future provision for :</td>
												</tr>
												<tr>
													<td>(i) Vertical extension :<span class="mandatory_field">*</span></td>
													<td><label class="radio-inline"><input type="radio" name="is_v_ext" id="is_v_ext" value="Y" <?php if($is_v_ext=='Y') echo 'checked'; ?> required > Yes </label>
													<label class="radio-inline"><input type="radio" name="is_v_ext" id="is_v_ext" value="N" <?php if($is_v_ext=='N') echo 'checked'; ?> > No </label></td>
													<td>No. of floors :</td>
													<td><input type="text" class="form-control text-uppercase" id="v_no_floor" validate="onlyNumbers" name="v_no_floor" value="<?php echo $v_no_floor; ?>"></td>
												</tr>
												<tr>
													<td>(ii) Horizontal extension :<span class="mandatory_field">*</span></td>
													<td><label class="radio-inline"><input type="radio" name="is_h_ext" id="is_h_ext" value="Y" <?php if($is_h_ext=='Y') echo 'checked'; ?> required> Yes </label>
													<label class="radio-inline"><input type="radio" name="is_h_ext" id="is_h_ext" value="N" <?php if($is_h_ext=='N') echo 'checked'; ?> > No </label></td>
													<td>No. of Rooms :</td>
													<td><input type="text" class="form-control text-uppercase" id="h_no_floor" validate="onlyNumbers" name="h_no_floor" value="<?php echo $h_no_floor; ?>"></td>
												</tr>
												<tr>
													<td colspan="4">14. Detail of Registered Technical Person :</td>
												</tr>
												<tr>
													<td width="25%">(a)Registration No.:</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>" ></td>

													<td width="25%">(b)Name of RTP :</td>
													<td width="25%"><input type="text"  class="form-control text-uppercase" name="rtp_name" validate="letters" value="<?php echo $rtp_name; ?>" ></td>
												</tr>
												<tr>
													<td>(c)Mobile No. :</td>
													<td><input type="text" class="form-control text-uppercase" name="tp_mobile_no" value="<?php  echo $tp_mobile_no; ?>" validate="mobileNumber" maxlength="10"/></td>
													<td>(d)Email Id :</td>
													<td><input type="email" class="form-control" name="tp_email" value="<?php  echo $tp_email; ?>"/></td>
												</tr>
												<tr>
													<td>Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong></td>
													<td colspan="2"></td>
													<td align="right">Name Of the Applicant : <strong><?php echo $key_person;?></strong></td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">
													<a href="<?php echo $form; ?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save &amp; Next</button>
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
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
