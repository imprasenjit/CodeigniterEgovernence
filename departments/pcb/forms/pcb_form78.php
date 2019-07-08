<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="78";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];		
		// Tab 1 //
		$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$capacity=$results['capacity'];$water_cess=$results['water_cess'];

		if(!empty($results["contact"])){
			$contact=json_decode($results["contact"]);
			$contact_name=$contact->name;$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
		}else{				
			$contact_name="";$contact_desgn="";$contact_tel="";
		}	
		
		if(!empty($results["water_consume"])){
			$water_consume=json_decode($results["water_consume"]);
			$water_consume_indus=$water_consume->indus;$water_consume_dom=$water_consume->dom;
		}else{				
			$water_consume_indus="";$water_consume_dom="";
		}
		
		if(!empty($results["water_gen"])){
			$water_gen=json_decode($results["water_gen"]);
			$water_gen_indus=$water_gen->indus;$water_gen_dom=$water_gen->dom;$water_gen_indus2=$water_gen->indus2;$water_gen_dom2=$water_gen->dom2;
		}else{				
			$water_gen_indus="";$water_gen_dom="";$water_gen_indus2="";$water_gen_dom2="";
		}
		
		// Tab 2 //
		$air_facilities=$results['air_facilities'];
		if(!empty($results["water_treat"])){
			$water_treat=json_decode($results["water_treat"]);
			$water_treat_indus=$water_treat->indus;$water_treat_dom=$water_treat->dom;
		}else{				
			$water_treat_indus="";$water_treat_dom="";
		}
		
		if(!empty($results["discharge"])){
			$discharge=json_decode($results["discharge"]);
			$discharge_qty=$discharge->qty;$discharge_loc=$discharge->loc;$discharge_analysis=$discharge->analysis;
		}else{				
			$discharge_qty="";$discharge_loc="";$discharge_analysis="";
		}
		
		if(!empty($results["waste"])){
			$waste=json_decode($results["waste"]);
			$waste_collect=$waste->collect;$waste_dispose=$waste->dispose;$waste_facility=$waste->facility;
		}else{				
			$waste_collect="";$waste_dispose="";$waste_facility="";
		}
		
		// Tab 3 //
		$occ_safety=$results['occ_safety'];$is_pollution=$results['is_pollution'];$is_pollution_details=$results['is_pollution_details'];$is_compliance=$results['is_compliance'];$is_operation=$results['is_operation'];$is_conditions=$results['is_conditions'];$is_leachate=$results['is_leachate'];$info=$results['info'];
		
		if(!empty($results["auction"])){
			$auction=json_decode($results["auction"]);
			$auction_name=$auction->name;$auction_qty=$auction->qty;$auction_position=$auction->position;$auction_nature=$auction->nature;
		}else{				
			$auction_name="";$auction_qty="";$auction_position="";$auction_nature="";
		}
		
		if(!empty($results["cost"])){
			$cost=json_decode($results["cost"]);
			$cost_unit=$cost->unit;$cost_capital=$cost->capital;$cost_recurring=$cost->recurring;
		}else{				
			$cost_unit="";$cost_capital="";$cost_recurring="";
		}
	}else{
		$form_id="";
		// Tab 1 //
		$comm_date="";$no_of_workers="";$water_valid="";$air_valid="";$auth_valid="";$capacity="";$water_cess="";
		$contact_name="";$contact_desgn="";$contact_tel="";
		$water_consume_indus="";$water_consume_dom="";
		$water_gen_indus="";$water_gen_dom="";$water_gen_indus2="";$water_gen_dom2="";
		// Tab 2 //
		$air_facilities="";
		$water_treat_indus="";$water_treat_dom="";
		$discharge_qty="";$discharge_loc="";$discharge_analysis="";
		$waste_collect="";$waste_dispose="";$waste_facility="";
		// Tab 3 //
		$occ_safety="";$is_pollution="";$is_pollution_details="";$is_compliance="";$is_operation="";$is_conditions="";$is_leachate="";$info="";
		$auction_name="";$auction_qty="";$auction_position="";$auction_nature="";
		$cost_unit="";$cost_capital="";$cost_recurring="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	// Tab 1 //
	$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$capacity=$results['capacity'];$water_cess=$results['water_cess'];

	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_name=$contact->name;$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
	}else{				
		$contact_name="";$contact_desgn="";$contact_tel="";
	}	
	
	if(!empty($results["water_consume"])){
		$water_consume=json_decode($results["water_consume"]);
		$water_consume_indus=$water_consume->indus;$water_consume_dom=$water_consume->dom;
	}else{				
		$water_consume_indus="";$water_consume_dom="";
	}
	
	if(!empty($results["water_gen"])){
		$water_gen=json_decode($results["water_gen"]);
		$water_gen_indus=$water_gen->indus;$water_gen_dom=$water_gen->dom;$water_gen_indus2=$water_gen->indus2;$water_gen_dom2=$water_gen->dom2;
	}else{				
		$water_gen_indus="";$water_gen_dom="";$water_gen_indus2="";$water_gen_dom2="";
	}
	
	// Tab 2 //
	$air_facilities=$results['air_facilities'];
	if(!empty($results["water_treat"])){
		$water_treat=json_decode($results["water_treat"]);
		$water_treat_indus=$water_treat->indus;$water_treat_dom=$water_treat->dom;
	}else{				
		$water_treat_indus="";$water_treat_dom="";
	}
	
	if(!empty($results["discharge"])){
		$discharge=json_decode($results["discharge"]);
		$discharge_qty=$discharge->qty;$discharge_loc=$discharge->loc;$discharge_analysis=$discharge->analysis;
	}else{				
		$discharge_qty="";$discharge_loc="";$discharge_analysis="";
	}
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_collect=$waste->collect;$waste_dispose=$waste->dispose;$waste_facility=$waste->facility;
	}else{				
		$waste_collect="";$waste_dispose="";$waste_facility="";
	}
	
	// Tab 3 //
	$occ_safety=$results['occ_safety'];$is_pollution=$results['is_pollution'];$is_pollution_details=$results['is_pollution_details'];$is_compliance=$results['is_compliance'];$is_operation=$results['is_operation'];$is_conditions=$results['is_conditions'];$is_leachate=$results['is_leachate'];$info=$results['info'];
	
	if(!empty($results["auction"])){
		$auction=json_decode($results["auction"]);
		$auction_name=$auction->name;$auction_qty=$auction->qty;$auction_position=$auction->position;$auction_nature=$auction->nature;
	}else{				
		$auction_name="";$auction_qty="";$auction_position="";$auction_nature="";
	}
	
	if(!empty($results["cost"])){
		$cost=json_decode($results["cost"]);
		$cost_unit=$cost->unit;$cost_capital=$cost->capital;$cost_recurring=$cost->recurring;
	}else{				
		$cost_unit="";$cost_capital="";$cost_recurring="";
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
  <?php include ("".$table_name."_addmore.php"); ?>
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
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane<?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td width="25%">1. Name of the Unit :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">2. Address of the Unit : </td>
											</tr>
											<tr>
												<td width="25%">Street Name1 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
												<td width="25%">Street Name2 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
												<td>Mobile No :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
											</tr>
											<tr>
												<td>3. Name and details of Contact Person : </td>
												<td><input type="text" class="form-control text-uppercase" name="contact[name]" value="<?php echo  $contact_name; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>Designation :</td>
												<td><input type="text" class="form-control text-uppercase" name="contact[desgn]" value="<?php echo  $contact_desgn; ?>"></td>
												<td>Telephone No./ Fax No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="contact[tel]" value="<?php echo $contact_tel; ?>"></td>
											</tr>
											<tr>
												<td>4. Date of Commissioning : </td>
												<td><input type="text" class="dob form-control" name="comm_date" value="<?php echo  $comm_date; ?>"></td>
												<td>5. No. of Workers (including contract labourers) : </td>
												<td><input type="text" class="form-control text-uppercase" name="no_of_workers" value="<?php echo  $no_of_workers; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">6. Consents Validity : </td>
											</tr>
											<tr>
												<td>(a) Under Air Act, 1981; Valid up to :</td>
												<td><input type="text" class="dob form-control" name="air_valid" value="<?php echo  $air_valid; ?>"></td>
												<td>(b) Under Water Act, 1974; Valid up to :</td>
												<td><input type="text" class="dob form-control" name="water_valid" value="<?php echo  $water_valid; ?>"></td>
											</tr>
											<tr>
												<td>7. Validity of Authorization under rule 5 of the Hazardous Wastes (Management and Handling Rules, 1989) Valid up to : </td>
												<td><input type="text" class="dob form-control" name="auth_valid" value="<?php echo  $auth_valid; ?>"></td>
												<td>8. Installed capacity of the production in (MTA) : </td>
												<td><input type="text" class="form-control text-uppercase" name="capacity" value="<?php echo  $capacity; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">9. Products Manufactured (Tones/years) during the last three years : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
													<tr> 
														<th>Sl No.</th>
														<th>Name of Product Manufactured </th>
														<th>Year-1</th>
														<th>Year-2</th>
														<th>Year-3</th>
													</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" name="txtA<?php echo $count;?>" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" size="1"></td>
															<td><input name="txtB<?php echo $count;?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" placeholder="Name"></td>
															<td><input name="txtC<?php echo $count;?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year1"]; ?>" placeholder="Year-1" ></td>
															<td><input name="txtD<?php echo $count;?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year2"]; ?>" placeholder="Year-2" ></td>
															<td><input name="txtE<?php echo $count;?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year3"]; ?>" placeholder="Year-3" ></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
														<tr>
															<td><input  name="txtA1" id="txtA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase"></td>
															<td><input name="txtB1" id="txtB1" class="form-control text-uppercase" placeholder="Name"></td>					
															<td><input name="txtC1" id="txtC1" class="form-control text-uppercase" placeholder="Year-1" ></td>	
															<td><input name="txtD1" id="txtD1" class="form-control text-uppercase" placeholder="Year-2" ></td>	
															<td><input name="txtE1" id="txtE1" class="form-control text-uppercase" placeholder="Year-3" ></td>	
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">10. Raw material consumed (Tones/year) : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable2" class="table table-responsive table-bordered "id="objectTable2" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Name of Raw material consumed </th>
														<th>Year-1</th>
														<th>Year-2</th>
														<th>Year-3</th>
													</tr>
													</thead>
													<?php
													$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
														$count=1;
														while($row_1=$part2->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input name="textB<?php echo $count;?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" placeholder="Name"></td>
															<td><input name="textC<?php echo $count;?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year1"]; ?>" placeholder="Year-1" ></td>
															<td><input name="textD<?php echo $count;?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year2"]; ?>" placeholder="Year-2" ></td>
															<td><input name="textE<?php echo $count;?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["year3"]; ?>" placeholder="Year-3" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="textA1" id="textA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="textB1" id="textB1" class="form-control text-uppercase" placeholder="Name"></td>					
															<td><input name="textC1" id="textC1" class="form-control text-uppercase" placeholder="Year-1" ></td>	
															<td><input name="textD1" id="textD1" class="form-control text-uppercase" placeholder="Year-2" ></td>	
															<td><input name="textE1" id="textE1" class="form-control text-uppercase" placeholder="Year-3" ></td>		
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>11. Manufacturing Process :</td>
												<td colspan="3">Please attach manufacturing process flow diagram for each product(s)</td>
											</tr>
											<tr>
												<td colspan="4">12. Water Consumption : </td>
											</tr>
											<tr>
												<td>Industrial :</td>
												<td><input type="text" class="form-control text-uppercase" name="water_consume[indus]" value="<?php echo $water_consume_indus; ?>"  placeholder="m3/day"></td>
												<td>Domestic :</td>
												<td><input type="text" class="form-control text-uppercase" name="water_consume[dom]" value="<?php echo $water_consume_dom; ?>"  placeholder="m3/day"></td>
											</tr>
											<tr>
												<td>13. Water Cess paid up to : </td>
												<td><input type="text" class="dob form-control" name="water_cess" value="<?php echo  $water_cess; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">14. Waste Water generation : </td>
											</tr>
											<tr>
												<td>(a) as per consent m3/day : </td>
												<td>Industrial :  <input type="text" class="form-control text-uppercase" name="water_gen[indus]" value="<?php echo $water_gen_indus; ?>"></td>
												<td>Domestic :  <input type="text" class="form-control text-uppercase" name="water_gen[dom]" value="<?php echo $water_gen_dom; ?>"></td>
												<td></td>
											</tr>
											<tr>
												<td>(b) actual m3/day (average of last three months) : </td>
												<td>Industrial :  <input type="text" class="form-control text-uppercase" name="water_gen[indus2]" value="<?php echo $water_gen_indus2; ?>"></td>
												<td>Domestic :  <input type="text" class="form-control text-uppercase" name="water_gen[dom2]" value="<?php echo $water_gen_dom2; ?>"></td>
												<td></td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>a" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">15. Waste water treatment (Please attach flow diagram of the treatment scheme) : </td>
											</tr>
											<tr>
												<td width="25%">Industrial :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="water_treat[indus]" value="<?php echo $water_treat_indus; ?>"></td>
												<td width="25%">Domestic :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="water_treat[dom]" value="<?php echo $water_treat_dom; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">16. Waste water discharge : </td>
											</tr>
											<tr>
												<td>Quantity :</td>
												<td><input type="text" class="form-control text-uppercase" name="discharge[qty]" value="<?php echo $discharge_qty; ?>"  placeholder="m3/day"></td>
												<td>Location :</td>
												<td><input type="text" class="form-control text-uppercase" name="discharge[loc]" value="<?php echo $discharge_loc; ?>"></td>
											</tr>
											<tr>
												<td colspan="2">Analysis of treated waste water (pH, BOD, COD, SS, O&G, Any other). Also, indicate the corresponding standards applicable :</td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="discharge[analysis]" value="<?php echo $discharge_analysis;?>"></td>
											</tr>
											<tr>
												<td colspan="4">17. Air Pollution Control : </td>
											</tr>
											<tr>
												<td colspan="2">(a) Details of facilities provided for control of fugitives emission due to material handling, process, utilities etc. :</td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="air_facilities" value="<?php echo $air_facilities;?>"></td>	
											</tr>
											<tr>
												<td>(b) Fuel Consumption : </td>
												<td colspan="3">
												<table name="objectTable3" class="table table-responsive table-bordered "id="objectTable3" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Name of the fuel</th>
														<th>Quantity/day</th>
													</tr>
													</thead>
													<?php
													$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
														$count=1;
														while($row_1=$part3->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" name="text1A<?php echo $count;?>" id="text1A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" size="1"></td>
															<td><input name="text1B<?php echo $count;?>" id="text1B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" placeholder="Name of the fuel"></td>
															<td><input name="text1C<?php echo $count;?>" id="text1C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" placeholder="Quantity/day" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text1A1" id="text1A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text1B1" id="text1B1" class="form-control text-uppercase" placeholder="Name of the fuel"></td>					
															<td><input name="text1C1" id="text1C1" class="form-control text-uppercase" placeholder="Quantity/day" ></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>(c) Stack emission monitoring results vis-a-vis the standards applicable : </td>
												<td colspan="3">
												<table name="objectTable4" class="table table-responsive table-bordered "id="objectTable4" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Stack attached to</th>
														<th>Emission g/Nm3</th>
													</tr>
													</thead>
													<?php
													$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
													$num4 = $part4->num_rows;
													if($num4>0){
														$count=1;
														while($row_1=$part4->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" name="text2A<?php echo $count;?>" id="text2A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" size="1"></td>
															<td><input name="text2B<?php echo $count;?>" id="text2B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["stack"]; ?>" placeholder="Stack attached to"></td>
															<td><input name="text2C<?php echo $count;?>" id="text2C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["emission"]; ?>" placeholder="Emission g/Nm3" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text2A1" id="text2A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text2B1" id="text2B1" class="form-control text-uppercase" placeholder="Stack attached to"></td>					
															<td><input name="text2C1" id="text2C1" class="form-control text-uppercase" placeholder="Emission g/Nm3" ></td>
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction4()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>(d) Ambient air quality : </td>
												<td colspan="3">
												<table name="objectTable5" class="table table-responsive table-bordered "id="objectTable5" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Location</th>
														<th>Result mg/m3</th>
													</tr>
													</thead>
													<?php
													$part5=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t5 where form_id='$form_id'");
													$num5 = $part5->num_rows;
													if($num5>0){
														$count=1;
														while($row_1=$part5->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" name="text3A<?php echo $count;?>" id="text3A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" size="1"></td>
															<td><input name="text3B<?php echo $count;?>" id="text3B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["loc"]; ?>" placeholder="Location"></td>
															<td><input name="text3C<?php echo $count;?>" id="text3C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["result"]; ?>" placeholder="Result mg/m3" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text3A1" id="text3A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text3B1" id="text3B1" class="form-control text-uppercase" placeholder="Location"></td>					
															<td><input name="text3C1" id="text3C1" class="form-control text-uppercase" placeholder="Result mg/m3" ></td>
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction5()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">18. Hazardous Waste Management : </td>
											</tr>
											<tr>
												<td>(a) Waste generation : </td>
												<td colspan="3">
												<table name="objectTable6" class="table table-responsive table-bordered "id="objectTable6" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Name of the Waste</th>
														<th>Process category</th>
														<th>Quantity/Y</th>
													</tr>
													</thead>
													<?php
													$part6=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t6 where form_id='$form_id'");
													$num6 = $part6->num_rows;
													if($num6>0){
														$count=1;
														while($row_1=$part6->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text4A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text4A<?php echo $count;?>" size="1"></td>
															<td><input name="text4B<?php echo $count;?>" id="text4B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" placeholder="Name of the Waste"></td>
															<td><input name="text4C<?php echo $count;?>" id="text4C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["category"]; ?>" placeholder="Process category" ></td>
															<td><input name="text4D<?php echo $count;?>" id="text4D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" placeholder="Quantity/Y" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text4A1" id="text4A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text4B1" id="text4B1" class="form-control text-uppercase" placeholder="Name of the Waste"></td>				
															<td><input name="text4C1" id="text4C1" class="form-control text-uppercase" placeholder="Process category" ></td>	
															<td><input name="text4D1" id="text4D1" class="form-control text-uppercase" placeholder="Quantity/Y" ></td>		
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction6()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
												</td>
											</tr>											
											<tr>
												<td>(b) Details of collection, treatment :</td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="waste[collect]" value="<?php echo $waste_collect; ?>"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">(c) Disposal (including point of final discharge) :</td>
											</tr>
											<tr>
												<td>(i) Details of the disposal facility : </td>
												<td><input type="text" class="form-control text-uppercase" name="waste[dispose]" value="<?php echo $waste_dispose; ?>"></td>
												<td>(ii) Whether facilities provided are in compliance of the conditions issued by the SPCB in Authorization ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="waste[facility]" value="Y"  <?php if(isset($waste_facility) && ($waste_facility=='Y' || $waste_facility=='')) echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" name="waste[facility]" value="N" <?php if(isset($waste_facility) && $waste_facility=='N') echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>	
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">19. Details of waste proposed to be taken in auction or import, as the case may be for use as raw material :</td>
											</tr> 
											<tr>
												<td width="25%">(a) Name :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="auction[name]" value="<?php echo $auction_name; ?>"></td>
												<td width="25%">(b) Quantity required :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="auction[qty]" value="<?php echo $auction_qty; ?>"></td>
											</tr>
											<tr>
												<td>(c) Position in List A/List B as per Basel Convention (BC) :</td>
												<td><input type="text" class="form-control text-uppercase" name="auction[position]" value="<?php echo $auction_position; ?>"></td>
												<td>(d) Nature as per Annexure III of BC :</td>
												<td><input type="text" class="form-control text-uppercase" name="auction[nature]" value="<?php echo $auction_nature; ?>"></td>
											</tr>
											<tr>
												<td colspan="2">20. Occupational safety and health aspects (Please provide details of facilities provided):</td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="occ_safety" value="<?php echo $occ_safety; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">21. Remarks : </td>
											</tr>
											<tr>
												<td>(i) Whether industry has provided adequate pollution control system/equipment to meet the standards of emission/effluent ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_pollution" class="is_pollution" value="Y" <?php if(isset($is_pollution) && $is_pollution=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_pollution"  value="N"  name="is_pollution" <?php if(isset($is_pollution) && ($is_pollution=='N' || $is_pollution=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes, please furnish details : </td>	
												<td><input type="text" name="is_pollution_details" id="is_pollution_details" class="form-control text-uppercase" value="<?php echo $is_pollution_details; ?>"></td>
											</tr>
											<tr>
												<td>(ii) Whether industry is in compliance with conditions laid down in the Hazardous Waste Authorization ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_compliance" value="Y" <?php if(isset($is_compliance) && $is_compliance=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="is_compliance" value="N" <?php if(isset($is_compliance) && ($is_compliance=='N' || $is_compliance=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(iii) Whether Hazardous Waste collection and Treatment, Storage and Disposal Facility (TSDF) are operating satisfactorily ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_operation" value="Y" <?php if(isset($is_operation) && $is_operation=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio"  name="is_operation" value="N" <?php if(isset($is_operation) && ($is_operation=='N' || $is_operation=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>
											<tr>
												<td>(iv) Whether conditions exist or likely to exists of the material being handled/ processed of posing immediate or delayed adverse impacts on the environment ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_conditions" value="Y" <?php if(isset($is_conditions) && $is_conditions=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="is_conditions"  value="N" <?php if(isset($is_conditions) && ($is_conditions=='N' || $is_conditions=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>(v) Whether conditions exist or is likely to exit of the material being handled/ processed by any means capable of yielding another material e.g. leachate which may6 possess eco-toxicity ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_leachate" value="Y" <?php if(isset($is_leachate) && $is_leachate=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" name="is_leachate"  value="N" <?php if(isset($is_leachate) && ($is_leachate=='N' || $is_leachate=='')) echo 'checked'; ?>/> No </label>
												</td>
											</tr>      
											<tr>
												<td>22. (a) Cost of the unit :</td>
												<td><input type="text" class="form-control text-uppercase" name="cost[unit]" value="<?php echo $cost_unit; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">22. (b) Cost of pollution control equipment including environmental safeguard measures : </td>
											</tr>
											<tr>
												<td>(i) Capital : </td>
												<td><input type="text" class="form-control text-uppercase" name="cost[capital]" value="<?php echo $cost_capital; ?>"></td>
												<td>(ii) Recurring : </td>
												<td><input type="text" class="form-control text-uppercase" name="cost[recurring]" value="<?php echo $cost_recurring; ?>"></td>
											</tr>
											<tr>
												<td>23. Any other information :</td>
												<td><input type="text" class="form-control text-uppercase" name="info" value="<?php echo $info; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">I hereby declare that the above statements/informations are true and correct to the best of my knowledge and belief. </td>
											</tr>										
											<tr>
												<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
												<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person)?></strong><br/>(Name : <strong><?php echo $key_person;?></strong>)<br/> (Designation : <strong><?php echo $status_applicant;?></strong>)</td>
											</tr>										
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>c" class="btn btn-success text-bold submit1">Save and Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('#is_pollution_details').attr('readonly','readonly');
	<?php if($is_pollution == 'Y') echo "$('#is_pollution_details').removeAttr('readonly','readonly');"; ?>
	$('.is_pollution').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_pollution_details').removeAttr('readonly','readonly');
		}else{
			$('#is_pollution_details').attr('readonly','readonly');
			$('#is_pollution_details').val('');
		}			
	});
</script>