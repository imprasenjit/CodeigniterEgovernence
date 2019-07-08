<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="9";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_bt_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
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
	}else{	
		$form_id="";
		### form9a #######
		$com_date="";$no_workers="";$validity_haz_waste="";$prod_capacity="";			 
		$consent_validity_air="";$consent_validity_water="";
		#### form9b ######
		$water_fee="";$air_fug_emission="";$is_faci_provided="";$disp_detail="";			 
		$water_consption_i="";$water_consption_d="";
		$waste_water_i="";$waste_water_d="";
		$waste_wat_dis_day="";$waste_wat_dis_loc="";$waste_wat_dis_treate_water="";
		########form9c######
		$is_adequate_prov="";$is_compliance="";$yes_adeq_detail="";$is_satisfactory="";$is_condition="";$is_material_handled="";$waste_proposed_name="";$waste_proposed_qnty_req="";$waste_proposed_pos="";$waste_proposed_nature="";
		$cost_pollution_unit="";$cost_pollution_capital="";$cost_pollution_recurring="";
		$other_info_o1="";$other_info_o2="";$other_info_o3="";
	}
}else{	
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
  <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myformBT6" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
										<table class="table table-responsive">
											<tr>
												<td width="25%">1. Name & Address of the Unit </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"> </td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
												<td>Mobile</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std.'-'.$b_landline_no;?>"></td>
												<td>Email-id</td>
												<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
											</tr>
											<tr>
												<td colspan="4">2. Contact Person with Designation,Tel</td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person?>"></td>
												<td>Designation</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $status_applicant?>"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode;?>"></td>
												<td>Mobile</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no;?>"></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $landline_std.'-'.$landline_no;?>"></td>
												<td>Email</td>
												<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
											</tr>
											<tr>
												<td >3. Date of Commissioning</td>
												<td><input type="date" class="dob form-control text-uppercase" name="com_date"  required="required" value="<?php echo $com_date; ?>"></td>
												<td>4. No. of Workers (including contract labourers)</td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" required="required" name="no_workers" value="<?php echo $no_workers; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">5. Consent Validity</td>
											</tr>
											<tr>
												<td>a) Under Air Act, 1981; Valid up to-</td>
												<td><input type="date" class="dob form-control text-uppercase"  name="consent_validate[air]"  required="required" value="<?php  echo $consent_validity_air; ?>"></td>
												<td>b) Under Water Act, 1974; Valid up to-</td>
												<td><input type="date" class="dob form-control text-uppercase"  name="consent_validate[water]" required="required" value="<?php  echo $consent_validity_water; ?>"></td>
											</tr>
											<tr>
												<td >6. Validity of Authorization under rule 5 of the Hazardous Wastes (Management and Handling Rules,1989.Valid up to-</td>
												<td><input type="text" class="dob form-control text-uppercase" name="validity_haz_waste"  required="required" value="<?php  echo $validity_haz_waste; ?>"></td>
												<td>7. Installed capacity of the production in (MTA)</td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" placeholder="MTA" name="prod_capacity"  required="required" value="<?php  echo $prod_capacity; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">8. Products Manufactured (Tones/years) during the last three years</td>
											</tr>
											<tr>
												<td colspan="4"> 
												<table name="objectTable1" id="objectTable1" class="table table-responsive">
												<tbody>
													<tr>
														<td align="center">Sl No</td>
													   <td align="center">Product Name</td>
													   <td align="center">Year-1</td>
													   <td align="center">Year-2</td>
													   <td align="center">Year-3</td>
													</tr>
												   <?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["product_name"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["year1"]; ?>" id="txtC<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>	
														<td><input value="<?php echo $row_1["year2"]; ?>" id="txtD<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
														<td><input value="<?php echo $row_1["year3"]; ?>" id="txtE<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
													<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
													<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>
													<td><input id="txtD1" size="20" class="form-control text-uppercase" name="txtD1"></td>
													<td><input id="txtE1" size="20" class="form-control text-uppercase" name="txtE1"></td>
												</tr>
												<?php } ?>
												</tbody>
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
												<td colspan="4">9. Raw material consumed (Tones/year)</td>
											</tr>
											<tr>
												<td colspan="4"> 
												<table name="objectTable2" id="objectTable2" class="table table-responsive">
												<tbody>
													<tr>
														<td align="center">Sl No</td>
													   <td align="center">Raw Materials Name</td>
													   <td align="center">Year-1</td>
													   <td align="center">Year-2</td>
													   <td align="center">Year-3</td>
													
													</tr>
												   <?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num = $part2->num_rows;
													if($num>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
													<tr>
														<td><input id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_2["product_name"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_2["year1"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>	
														<td><input value="<?php echo $row_2["year2"]; ?>" validate="onlyNumbers" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="20"></td>
														<td><input value="<?php echo $row_2["year3"]; ?>" validate="onlyNumbers" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="20"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
													<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
													<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
													<td><input id="textD1" size="20" class="form-control text-uppercase" name="textD1"></td>
													<td><input id="textE1" size="20" class="form-control text-uppercase" name="textE1"></td>
												</tr>
												<?php } ?>
												</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
													<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
												</td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>a" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
												</td>												
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myformBT6b" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
									<table class="table table-responsive">
									<tr>
										<td colspan="3">10. Manufacturing Process (Please attach manufacturing process flow diagram for each product (s))<br/></td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
									<tr>
										<td colspan="4">11. Water Consumption</td>
									</tr>
									<tr>
										<td width="25%">Industrial-</td>
										<td width="25%" class="form-inline"><input type="text" name="water_consption[i]" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $water_consption_i; ?>" />m<sup>3</sup> /day</td>
										<td width="25%">Domestic</td>
										<td width="25%" class="form-inline"><input type="text" name="water_consption[d]" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $water_consption_d; ?>" />m<sup>3</sup> /day</td>
									</tr>
									<tr>
										<td colspan="4">12. Waste Water generation</td>
									</tr>
									<tr>
										<td>a) as per consent m<sup>3</sup> /day</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="water_fee" value="<?php echo $water_fee; ?>" /></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">b) actual m<sup>3</sup> /day (average of last three months)</td>
									</tr>
									<tr>
										<td>Industrial-</td> 
										<td><input type="text" name="waste_water[i]" class="form-control text-uppercase" validate="decimal" value="<?php echo $waste_water_i; ?>" /></td>
										<td>Domestic-</td>
										<td><input type="text" name="waste_water[d]" class="form-control text-uppercase" validate="decimal" value="<?php echo $waste_water_d; ?>" /></td>
									</tr>
									<tr>
										<td colspan="4">13. Waste water treatment (please provide flow diagram of the treatment scheme): </td>
									</tr>
									<tr>
										<td>Industrial- </td>
										<td>(Upload Later in Upload Section)</td>
										<td>Domestic-</td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
									<tr>
										<td colspan="4">14. Waste water discharge:-</td>
									</tr>
									<tr>
										<td>Quantity m<sup>3</sup> /day- </td>
										<td><input type="text" name="waste_wat_dis[day]" validate="decimal" class="form-control text-uppercase" value="<?php echo $waste_wat_dis_day; ?>" /></td>
										<td>Location- </td>
										<td><input type="text" name="waste_wat_dis[loc]" class="form-control text-uppercase" value="<?php echo $waste_wat_dis_loc; ?>" /></td>
									</tr>
									<tr>
										<td colspan="3">Analysis of treated waste water-pH, BOD, COD, SS, O&G, Any other(indicate the corresponding standards applicable)</td>
										<td><input type="text" class="form-control text-uppercase" name="waste_wat_dis[treate_water]"  value="<?php echo $waste_wat_dis_treate_water; ?>" /></td>
									</tr>
									<tr>
										<td colspan="4">15. Air Pollution Control</td>
									</tr>
									<tr>
										<td colspan="3">a. Please provide flow diagram for emission control system(s) installed for each process unit,utilities etc.</td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
									<tr>
										<td colspan="3">b. Details of facilities provided for control of fugitives emission due to material handling, process,utilities etc.</td>
										<td><textarea name="air_fug_emission" class="form-control text-uppercase"> <?php echo $air_fug_emission; ?> </textarea></td>
									</tr>
									<tr>
										<td colspan="4">c. Fuel Consumption.</td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable3" id="objectTable3" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Name of the fuel</td>
											   <td align="center">Quantity/day</td>
											</tr>
										   <?php
											$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
											$num = $part3->num_rows;
											if($num>0){
											  $count=1;
											  while($row_3=$part3->fetch_array()){	?>
											<tr>
												<td><input id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_3["fuel"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_3["quantity"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
											<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
											<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
										</td>
									</tr>									
									<tr>
										<td colspan="4">d. Stack emission monitoring results vis-à-vis the standards applicable.</td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable4" id="objectTable4" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Stack attached to</td>
											   <td align="center">Emission g/Nm<sup>3</sup></td>
											</tr>
										   <?php
											$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
											$num = $part4->num_rows;
											if($num>0){
												$count=1;
												while($row_4=$part4->fetch_array()){	?>
												<tr>
													<td><input id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_4["stack"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_4["quantity"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>				
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
												<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
												<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
											</tr>
											<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
										</td>
									</tr>
									<tr>
										<td colspan="4">e. Ambient air quality.</td>
									</tr>
										<tr>
										<td colspan="4"> 
										<table name="objectTable5" id="objectTable5" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
												<td align="center">Location</td>
												<td align="center">Result ug/ m<sup>3</sup></td>
											   
											</tr>
										   <?php
											$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
											$num = $part5->num_rows;
											if($num>0){
											  $count=1;
											  while($row_5=$part5->fetch_array()){	?>
											<tr>
												<td><input id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_5["location"]; ?>" id="txttB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_5["result"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="20"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
											<td><input id="txttB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txttB1"></td>					
											<td><input  id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/>
										</td>
									</tr>
									<tr>
										<td colspan="4">16. Hazardous Waste Management</td>
									</tr>
									<tr>
										<td colspan="4">a) Waste generation</td>
									</tr>
									<tr>
									<td colspan="4"> 
									<table name="objectTable6" id="objectTable6" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
											<td align="center">Name of the Waste</td>
											<td align="center">Process category</td>
											<td align="center">Quantity/Y</td>
										   
										</tr>
									   <?php
										$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
										$num = $part6->num_rows;
										if($num>0){
										  $count=1;
										  while($row_6=$part6->fetch_array()){	?>
										<tr>
											<td><input id="texttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="texttA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_6["name"]; ?>" validate="letters" id="texttB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="texttB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_6["category"]; ?>" id="texttC<?php echo $count;?>" class="form-control text-uppercase" name="texttC<?php echo $count;?>" size="20"></td>	
											<td><input value="<?php echo $row_6["qty"]; ?>"  id="texttD<?php echo $count;?>" class="form-control text-uppercase" name="texttD<?php echo $count;?>" size="20"></td>
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="texttA1" size="1" class="form-control text-uppercase" name="texttA1"></td>
											<td><input id="texttB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="texttB1"></td>					
											<td><input  id="texttC1" size="20" class="form-control text-uppercase"  name="texttC1"></td>
											<td><input id="texttD1" size="20"  class="form-control text-uppercase" name="texttD1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction6()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore6()" value="">Add More</button>
											<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/>
										</td>
									</tr>
									<tr>
										<td colspan="4">b) Details of collection, treatment</td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable7" id="objectTable7" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
												<td align="center">Name of the Waste</td>
												<td align="center">Process category</td>
												<td align="center">Quantity/Y</td>
											</tr>
										   <?php
											$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
											$num = $part7->num_rows;
											if($num>0){
											  $count=1;
											  while($row_7=$part7->fetch_array()){	?>
											<tr>
												<td><input id="txtttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["slno"]; ?>" validate="letters" name="txtttA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_7["name"]; ?>" id="txtttB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtttB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_7["category"]; ?>" id="txtttC<?php echo $count;?>" class="form-control text-uppercase" name="txtttC<?php echo $count;?>" size="20"></td>	
												<td><input value="<?php echo $row_7["qty"]; ?>"  id="txtttD<?php echo $count;?>" class="form-control text-uppercase" name="txtttD<?php echo $count;?>" size="20"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txtttA1" size="1" class="form-control text-uppercase" name="txtttA1"></td>
											<td><input id="txtttB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtttB1"></td>					
											<td><input  id="txtttC1" size="20" class="form-control text-uppercase"  name="txtttC1"></td>
											<td><input id="txtttD1"  size="20" class="form-control text-uppercase" name="txtttD1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction7()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore7()" value="">Add More</button>
											<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/>
										</td>
									</tr>
									<tr>
										<td colspan="4">c) Disposal (including point of final discharge)</td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable8" id="objectTable8" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
												<td align="center">Name of the Waste</td>
												<td align="center">Process category</td>
												<td align="center">Quantity/Y</td>
											</tr>
										   <?php
											$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
											$num = $part8->num_rows;
											if($num>0){
											  $count=1;
											  while($row_8=$part8->fetch_array()){	?>
											<tr>
												<td><input id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_8["name"]; ?>" validate="letters" id="ttxtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="ttxtB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_8["category"]; ?>" id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" name="ttxtC<?php echo $count;?>" size="20"></td>	
												<td><input  value="<?php echo $row_8["qty"]; ?>" id="ttxtD<?php echo $count;?>" class="form-control text-uppercase" name="ttxtD<?php echo $count;?>" size="20"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
											<td><input id="ttxtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="ttxtB1"></td>					
											<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>
											<td><input id="ttxtD1" size="20"   class="form-control text-uppercase" name="ttxtD1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">										
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction8()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore8()" value="">Add More</button>
											<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/>
										</td>
									</tr>										
									<tr>
										<td colspan="3">(i) Please provide details of the disposal facility</td>
										<td><textarea name="disp_detail" class="form-control text-uppercase" validate="textarea"><?php echo $disp_detail; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="3">(ii) Whether facilities provided are in compliance of the conditions issued by the SPCB in Authorization</td>
										<td><input type="radio" name="is_faci_provided" id="reg1" value="Y" <?php if($is_faci_provided=='Y') echo 'checked'; ?>  />&nbsp;Yes
										<input type="radio" name="is_faci_provided" id="reg2" value="N" <?php if($is_faci_provided=='N') echo 'checked'; ?> />&nbsp;No</td>
									</tr>
									<tr>
										<td colspan="3">(iii)Please attach analysis report of characterization of hazardous waste generated (including leachate test if applicable)</td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
									<tr>
										<td colspan="4" class="text-uppercase" align="center">
											<a href="<?php echo $table_name; ?>.php?tab=1"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>		
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>b" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>								
									</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myformBT6" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
									<table class="table table-responsive">
									  <tr>
										<td colspan="4">17. Details of waste proposed to be taken in auction or import, as the case may be for use as raw material</td>
									  </tr>
									  <tr>
										<td width="25%">1. Name :</td>
										<td><input type="text" class="form-control text-uppercase" validate="letters" name="waste_proposed[name]" value="<?php echo $waste_proposed_name; ?>"></td>
										<td>2. Quantity required : </td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="waste_proposed[qnty_req]" value="<?php echo $waste_proposed_qnty_req; ?>"></td>
									  </tr>
									  <tr>                         	
										<td>3. Position in List A/List B as per Basel Convention (BC) : </td>
										<td><input type="text" name="waste_proposed[pos]" class="form-control text-uppercase" value="<?php echo $waste_proposed_pos; ?>" /></td>
										<td>4. Nature as per Annexure III of BC : </td>
										<td><input type="text" name="waste_proposed[nature]" class="form-control text-uppercase" value="<?php echo $waste_proposed_nature; ?>" /></td>
									</tr>
									<tr>
										<td colspan="3">18. Occupational safety and health aspects.(Please provide details of facilities provided.)</td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
									<tr>
										<td colspan="4">19. Remarks</td>
									</tr>
									<tr>
										<td width="25%" colspan="3">(i) Whether industry has provided adequate pollution control system/ equipment to meet the standards of emission/effluent.</td>
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_adequate_prov" value="Y"  <?php if(isset($is_adequate_prov) && $is_adequate_prov=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_adequate_prov"  value="N"  <?php if(isset($is_adequate_prov) && $is_adequate_prov=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td width="25%">If yes, please furnish details</td>
										<td width="25%"><textarea name="yes_adeq_detail" id="yes_adeq_detail" class="form-control text-uppercase" validate="textarea" ><?php if(isset($yes_adeq_detail)) echo $yes_adeq_detail; ?></textarea></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="3">(ii) Whether industry is in compliance with conditions laid down in the Hazardous Waste Authorization.</td>
										<td><label class="radio-inline"><input type="radio" name="is_compliance" value="Y" <?php if(isset($is_compliance) && $is_compliance=='Y') echo 'checked'; ?> />Yes</label>
										<label class="radio-inline"><input type="radio" name="is_compliance" value="N" <?php if(isset($is_compliance) && $is_compliance=='N') echo 'checked'; ?> />No</label></td>
									</tr>
									<tr>
										<td colspan="3">(iii) Whether Hazardous Waste collection and Treatment, Storage and Disposal Facility (TSDF) are operating satisfactorily.</td>
										<td><label class="radio-inline"><input type="radio" name="is_satisfactory" value="Y" <?php if(isset($is_satisfactory) && $is_satisfactory=='Y') echo 'checked'; ?> checked />Yes</label>
										<label class="radio-inline"><input type="radio" name="is_satisfactory" value="N" <?php if(isset($is_satisfactory) && $is_satisfactory=='N') echo 'checked'; ?>/>No</label></td>
									</tr>
									<tr>
										<td colspan="3">(iv) Whether conditions exist or likely to exists of the material being handled/ processed of posing immediate or delayed adverse impacts on the environment.</td>
										<td><label class="radio-inline"><input type="radio" name="is_condition" value="Y" <?php if(isset($is_condition) && $is_condition=='Y') echo 'checked'; ?>  />Yes</label>
										<label class="radio-inline"><input type="radio" name="is_condition" value="N" <?php if(isset($is_condition) && $is_condition=='N') echo 'checked'; ?>/>No</label></td>
									</tr>
									<tr>
										<td colspan="3">(v) Whether conditions exist or is likely to exist of the material being handled/ processed by any means capable of yielding another material e.g. leachate which may possess eco-toxicity</td>
										<td><label class="radio-inline"><input type="radio" name="is_material_handled" value="Y" <?php if(isset($is_material_handled) && $is_material_handled=='Y') echo 'checked'; ?>  />Yes</label>
										<label class="radio-inline"><input type="radio" name="is_material_handled" value="N" <?php if(isset($is_material_handled) && $is_material_handled=='N') echo 'checked'; ?>/>No</label></td>
									</tr>
									<tr>
										<td>20. (i) Cost of the unit</td>
										<td><input type="text" name="cost_pollution[unit]" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $cost_pollution_unit; ?>" /></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(ii) Cost of pollution control equipment including environmental safeguard measures</td>
									</tr>
									<tr>
										<td>a) Capital:</td>
										<td><input type="text" name="cost_pollution[capital]" class="form-control text-uppercase" value="<?php echo $cost_pollution_capital; ?>" /></td>
										<td>b) Recurring:</td>
										<td><input type="text" name="cost_pollution[recurring]" class="form-control text-uppercase" value="<?php echo $cost_pollution_recurring; ?>"/></td>
									</tr>
									<tr>
										<td colspan="4">21. Any other information:</td>
									</tr>
									<tr>
										<td><input type="text" name="other_info[o1]" class="form-control text-uppercase" placeholder="(i)" value="<?php echo $other_info_o1; ?>" /></td>
										<td><input type="text" name="other_info[o2]" class="form-control text-uppercase" placeholder="(ii)" value="<?php echo $other_info_o2; ?>"/></td>
										<td><input type="text" name="other_info[o3]" class="form-control text-uppercase" placeholder="(iii)" value="<?php echo $other_info_o3; ?>" /></td>
										<td></td>
									</tr>
									<tr>
										<td width="25%">
											Date :<label><?php echo date('d-m-Y', strtotime($today)); ?></label><br/>
											Place: <label><?php echo strtoupper($dist); ?></label>
										</td>
										<td></td>
										<td></td>
										<td align="right">
											Signature:<label class="text-uppercase"><?php echo $key_person; ?></label><br/>
											Name:<label class="text-uppercase"><?php echo $key_person; ?></label><br/>
											Designation:<label class="text-uppercase"> <?php echo $status_applicant; ?></label>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>		
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>c" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	<?php if($is_adequate_prov=="N"){ ?>
		$('#yes_adeq_detail').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="is_adequate_prov"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#yes_adeq_detail').removeAttr('disabled', 'disabled');			
		}else{
			$('#yes_adeq_detail').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>