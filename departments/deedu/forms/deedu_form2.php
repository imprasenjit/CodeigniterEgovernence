<?php  require_once "../../requires/login_session.php";
$dept="deedu";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";
   
    
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];$affil=$results["affil"];$instruct=$results["instruct"];$land=$results["land"];$land_status=$results["land_status"];$intake_cap=$results["intake_cap"];$no_students=$results["no_students"];$is_scheme=$results["is_scheme"];$is_available=$results["is_available"];$is_water=$results["is_water"];	$play_material=$results["play_material"];	$teaching_aid=$results["teaching_aid"];$lab_facility=$results["lab_facility"];$no_books=$results["no_books"];	$fire_safety=$results["fire_safety"];$co_curricular=$results["co_curricular"];$inst_location=$results["inst_location"];	$is_commercial=$results["is_commercial"];$is_admission=$results["is_admission"];$other_info=$results["other_info"];	$managing_comm=$results["managing_comm"];$education_stage=$results["education_stage"];$edu_level=$results["edu_level"];
			
			if(!empty($results["inst_loc"])){
				$inst_loc=json_decode($results["inst_loc"]);
				$inst_loc_a=$inst_loc->a;$inst_loc_b=$inst_loc->b;
			}else{				
				$inst_loc_a="";$inst_loc_b="";
			}			
			if(!empty($results["is_comm_act"])){
				$is_comm_act=json_decode($results["is_comm_act"]);
				$is_comm_act_a=$is_comm_act->a;$is_comm_act_b=$is_comm_act->b;
			}else{				
				$is_comm_act_a="";$is_comm_act_b="";
			}
			if(!empty($results["recog"])){
				$recog=json_decode($results["recog"]);
				$recog_no=$recog->no;$recog_dt=$recog->dt;
			}else{				
				$recog_no="";$recog_dt="";
			}				
			if(!empty($results["is_inst_estd"])){
				$is_inst_estd=json_decode($results["is_inst_estd"]);
				$is_inst_estd_a=$is_inst_estd->a;$is_inst_estd_b=$is_inst_estd->b;
			}else{				
				$is_inst_estd_a="";$is_inst_estd_b="";
			}				
			if(!empty($results["land"])){
				$land=json_decode($results["land"]);
				$land_a=$land->a;$land_b=$land->b;
			}else{				
				$land_a="";$land_b="";
			}					
			if(!empty($results["board_result"])){
				$board_result=json_decode($results["board_result"]);
				$board_result_a=$board_result->a;$board_result_b=$board_result->b;$board_result_c=$board_result->c;
			}else{				
				$board_result_a="";$board_result_b="";$board_result_c="";
			}
		}else{
			$form_id="";$affil="";$instruct="";$land="";$land_status="";$intake_cap="";$is_scheme="";$no_students="";$is_available="";$is_water="";$play_material="";$teaching_aid="";$lab_facility="";$no_books="";$fire_safety="";$co_curricular="";$inst_location="";$is_commercial="";$is_admission="";$other_info="";$managing_comm="";
			$is_comm_act_a="";$is_comm_act_b="";
			$inst_loc_a="";$inst_loc_b="";
			$is_inst_estd_a="";$is_inst_estd_b="";
			$recog_no="";$recog_dt="";
			$education_stage="";$edu_level="";
			$land_a="";$land_b="";
			$board_result_a="";$board_result_b="";$board_result_c="";
		}
	}else{	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$affil=$results["affil"];$instruct=$results["instruct"];$land=$results["land"];$land_status=$results["land_status"];$intake_cap=$results["intake_cap"];$no_students=$results["no_students"];$is_scheme=$results["is_scheme"];$is_available=$results["is_available"];$is_water=$results["is_water"];	$play_material=$results["play_material"];	$teaching_aid=$results["teaching_aid"];$lab_facility=$results["lab_facility"];$no_books=$results["no_books"];	$fire_safety=$results["fire_safety"];$co_curricular=$results["co_curricular"];$inst_location=$results["inst_location"];	$is_commercial=$results["is_commercial"];$is_admission=$results["is_admission"];$other_info=$results["other_info"];	$managing_comm=$results["managing_comm"];$education_stage=$results["education_stage"];$edu_level=$results["edu_level"];
		if(!empty($results["inst_loc"])){
			$inst_loc=json_decode($results["inst_loc"]);
			$inst_loc_a=$inst_loc->a;$inst_loc_b=$inst_loc->b;
		}else{				
			$inst_loc_a="";$inst_loc_b="";
		}			
		if(!empty($results["is_comm_act"])){
			$is_comm_act=json_decode($results["is_comm_act"]);
			$is_comm_act_a=$is_comm_act->a;$is_comm_act_b=$is_comm_act->b;
		}else{				
			$is_comm_act_a="";$is_comm_act_b="";
		}
		if(!empty($results["recog"])){
			$recog=json_decode($results["recog"]);
			$recog_no=$recog->no;$recog_dt=$recog->dt;
		}else{				
			$recog_no="";$recog_dt="";
		}				
		if(!empty($results["is_inst_estd"])){
			$is_inst_estd=json_decode($results["is_inst_estd"]);
			$is_inst_estd_a=$is_inst_estd->a;$is_inst_estd_b=$is_inst_estd->b;
		}else{				
			$is_inst_estd_a="";$is_inst_estd_b="";
		}				
		if(!empty($results["land"])){
			$land=json_decode($results["land"]);
			$land_a=$land->a;$land_b=$land->b;
		}else{				
			$land_a="";$land_b="";
		}					
		if(!empty($results["board_result"])){
			$board_result=json_decode($results["board_result"]);
			$board_result_a=$board_result->a;$board_result_b=$board_result->b;$board_result_c=$board_result->c;
		}else{				
			$board_result_a="";$board_result_b="";$board_result_c="";
		}	
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_Addmore.php"); ?>
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
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform2" id="stage_form" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1.Name of the Institution</td>
											<td width="25%"><input type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%">2. Name of the individual/ Association of individuals/ Society/ Trust establishing the institution</td>
											<td width="25%"><input  type="text" value="<?php echo $owner_names; ?>" class="form-control text-uppercase" readonly></td>
										</tr>
										<tr>
											<td colspan="4">3. Name of the Manager with address and contact telephone No.</td>
										</tr>
										<tr>
											<td>Name:</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"/></td>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										</tr>
										<tr>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										</tr>
										<tr>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										</tr>
										<tr>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">4. Full address with Pin code</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
											<td>Street Name2:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>
										    <td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $b_email; ?>"></td>
										</tr>
										<tr>
											<td width="25%">5. Location (Urban/Semi-urban/ Rural).</td>
											<td><select class="form-control text-uppercase" name="inst_location">
											<option value="">Please Select</option>
											<option value="R" <?php if($inst_location=="R") echo "selected";?> >Rural</option>
											<option value="SU" <?php if($inst_location=="SU") echo "selected";?>>Semi Urban</option>
											<option value="U" <?php if($inst_location=="U") echo "selected";?>>Urban</option>
											</select></td>
											<td >6. Date of establishment</td>
											<td ><input type="text" class="text-uppercase form-control" value="<?php echo $date_of_commencement;?>" disabled="disabled"/></td>
										</tr>
										<tr>
											<td>7. Affiliating body (SEBA/AHSEC/CBSE/ICSE/ others) :</td>
											<td><select class="form-control text-uppercase" name="affil">
											<option value="disabled">Please Select</option>
											<option value="SEBA" <?php if($affil=="SEBA") echo "selected";?> >SEBA</option>
											<option value="AHSEC" <?php if($affil=="AHSEC") echo "selected";?>>AHSEC</option>
											<option value="CBSE" <?php if($affil=="CBSE") echo "selected";?>>CBSE</option>
											<option value="ICSE" <?php if($affil=="ICSE") echo "selected";?>>ICSE</option>
											<option value="Other" <?php if($affil=="Other") echo "selected";?>>Other</option>
											</select></td>
											<td>8. Medium of instruction :</td>
											<td><input type="text" class="form-control text-uppercase" name="instruct" value="<?php echo $instruct; ?>"></td>
										</tr>
										<tr>
											<td >9. Whether existing on the day of commencement of the Act? </td>
											<td><label class="radio-inline">
											<input type="radio" name="is_comm_act[a]" class="is_comm_act_a" value="Y"  <?php if(isset($is_comm_act_a) && $is_comm_act_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_comm_act_a" name="is_comm_act[a]"  value="N" <?php if(isset($is_comm_act_a) && ($is_comm_act_a=='N' || $is_comm_act_a=='')) echo 'checked'; ?>/> No</label></td>
											<td>If yes, please furnish documentary evidence such as purchase of land/ building permission/ electricity bill/ opening of Bank Account/ Fixed Deposit Certificate in the name of the institution </td>
											<td><input  type="text" name="is_comm_act[b]" id="is_comm_act_b" value="<?php echo $is_comm_act_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td >10. Whether the institution is established with prior permission from Director after commencement of the Act? </td>
											<td><label class="radio-inline">
											<input type="radio" name="is_inst_estd[a]" class="is_inst_estd_a" value="Y"  <?php if(isset($is_inst_estd_a) && $is_inst_estd_a=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_inst_estd_a" name="is_inst_estd[a]"  value="N" <?php if(isset($is_inst_estd_a) && ($is_inst_estd_a=='N' || $is_inst_estd_a=='')) echo 'checked'; ?>/> No</label></td>
											<td>If yes, please furnish No. & Date of such permission (a copy of permission letter to be enclosed)</td>
											<td><input type="text" name="is_inst_estd[b]"  id="is_inst_estd_b" value="<?php echo $is_inst_estd_b;?>" class="form-control text-uppercase"> </td>
										</tr >
										<tr>
											<td colspan="4">11. No. & date of Recognition from Govt./ Affiliating Body (copy of document to be enclosed where applicable)</td>
										</tr>
										<tr>
											<td>Number</td>
											<td><input type="text" class="form-control text-uppercase" name="recog[no]" value="<?php echo $recog_no; ?>"></td>
											<td>Date</td>
											<td><input type="text" class="dob form-control text-uppercase" name="recog[dt]" value="<?php echo $recog_dt; ?>"></td>
										</tr>
										<tr>
											<td >12. Level of education imparted</td>
											<td>
											<?php 
												if($education_stage!=""){
													$education_stage_array=Array();
													$education_stage_array=explode(",",$education_stage);
												}else{
													$education_stage_array=Array();
												}
											?>
											<div class="checkbox" id="stage">
												<label class="checkbox-inline">
													<input type="checkbox" <?php if(in_array("P",$education_stage_array)) echo "checked"; ?> value="P" name="education_stage[]" class="education_stage"> Primary
												</label>
												<br/>
												<label class="checkbox-inline">
													<input type="checkbox" <?php if(in_array("M",$education_stage_array)) echo "checked"; ?> value="M" name="education_stage[]" class="education_stage" value="M"> Middle
												</label><br/>
												<label class="checkbox-inline">
													<input type="checkbox" <?php if(in_array("S",$education_stage_array)) echo "checked"; ?> value="S" name="education_stage[]" class="education_stage" value="S"> Secondary
												</label><br/>
												<label class="checkbox-inline">
													<input type="checkbox" <?php if(in_array("H",$education_stage_array)) echo "checked"; ?> value="H" name="education_stage[]" class="education_stage" value="H"> Higher Secondary
												</label>
											</div>
											
											</td>
											<td>Classes Opened</td>
											<td><input type="text" class="text-uppercase form-control" name="edu_level" value="<?php echo $edu_level;?>"/></td>
										</tr>
										<tr>
											<td colspan="4">13. Measurement of the plot of land where the institution is located with Dag No. & Patta No. (a copy enclosed)</td>
										</tr>
										<tr>
											<td>Land Measurement</td>
											<td><input type="text" class="form-control text-uppercase" name="land[a]" value="<?php echo $land_a; ?>"></td>
											<td>Dag No. and Patta No.</td>
											<td><input type="text" class="form-control text-uppercase" name="land[b]" value="<?php echo $land_b; ?>"></td>
										</tr>
										<tr>
											<td >14. Status of the land (Myadi/ Annual Patta/ Lease hold). If lease hold, copy of the lease document to be attached</td>
											<td><input validate="letters" type="text" name="land_status" value="<?php echo $land_status; ?>" class="form-control text-uppercase"></td>
											<td>15. Whether scheme of management as required under section 14 of the Act has been prepared? If so, please attach a copy of the same.</td>
											<td><label class="radio-inline"><input type="radio" name="is_scheme" value="Y"  <?php if(isset($is_scheme) && $is_scheme=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_scheme"  value="N"  <?php if(isset($is_scheme) && ($is_scheme=='N' || $is_scheme=='')) echo 'checked'; ?>/> No</label></td>
										</tr>							
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" id="submit" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">16. What is the intake capacity of the institution (class-wise).</td>
											<td width="25%"><input validate="onlyNumbers" type="text" name="intake_cap" value="<?php echo $intake_cap; ?>" class="form-control text-uppercase"></td>
											<td width="25%">17. No. of students enrolled class-wise during last 3 years (separate sheet)</td>
											<td width="25%"><input validate="onlyNumbers" type="text" name="no_students" value="<?php echo $no_students; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="4">18. Results of Board's Final Examination for last 3 years.</td>
										</tr>
										<tr>
											<td>Total No. of students appeared</td>
											<td><input name="board_result[a]" value="<?php echo $board_result_a; ?>" validate="onlyNumbers" class="form-control text-uppercase"></td>
											<td>Total no. of students passed with division</td>
											<td><input validate="onlyNumbers" type="text" name="board_result[b]" value="<?php echo $board_result_b; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Percentage of pass</td>
											<td><input type="text" name="board_result[c]" value="<?php echo $board_result_c; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">19. Total built up area indicating No. & size of classrooms, office room, common room, Library room, Science laboratory, store room,etc
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
												<tr>
													<th width="5%">Slno</th>
													<th width="35%">Name</th>
													<th width="30%">Total built up area indicating No.</th>
													<th width="30%">Size</th>
												</tr>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="specialChar" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["no"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["size"]; ?>" id="txtD<?php echo $count;?>" validate="specialChar" class="onlyNumbers form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10" validate="onlyNumbers"  class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10" validate="onlyNumbers"  class="form-control text-uppercase" name="txtD1"></td>	
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
											<td>20. Furniture and equipment available in the institution</td>
											<td><label class="radio-inline"><input type="radio" name="is_available" value="Y"  <?php if(isset($is_available) && $is_available=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_available"  value="N"  <?php if(isset($is_available) && $is_available=='N') echo 'checked'; ?>/> No</label></td>
											<td>21. Sanitation & Drinking water facilities</td>
											<td><label class="radio-inline"><input type="radio" name="is_water" value="Y"  <?php if(isset($is_water) && $is_water=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_water"  value="N"  <?php if(isset($is_water) && $is_water=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
										<tr>
											<td colspan="4">22. Students fee structure (accomodation fee, tuition fee, games & sports fee, library fee, development fee, festival fee, etc.) class-wise
											<table class="table table-responsive text-center" name="objectTable2" id="objectTable2" >
												<tr>
													<th width="5%">Slno</th>
													<th width="45%">Particulars</th>
													<th width="50%">Fees</th>
												</tr>
												<?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" validate="letters"name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" validate="specialChar"  class="form-control text-uppercase" value="<?php echo $row_2["particulars"]; ?>" validate="specialChar" name="textB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_2["fees"]; ?>" id="textC<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>						
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" validate="specialChar" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10" validate="onlyNumbers"  class="form-control text-uppercase" name="textC1"></td>				
													</tr>
													<?php } ?>
														
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
											<td>23. Constitution of the Managing Committee</td>
											<td><input validate="letters" type="text" name="managing_comm" value="<?php echo $managing_comm; ?>" class="form-control text-uppercase"></td>
											<td>24. Playgrounds and play materials</td>
											<td><input validate="letters" type="text" name="play_material" value="<?php echo $play_material; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>25. Teaching aids available in the institution</td>
											<td><input validate="letters" type="text" name="teaching_aid" value="<?php echo $teaching_aid; ?>" class="form-control text-uppercase"></td>
											<td>26. Laboratory facility</td>
											<td><input validate="letters" type="text" name="lab_facility" value="<?php echo $lab_facility; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>27. No. of Library books (Textbooks, reference books, other books, journals, news paper, etc.)</td>
											<td><input type="text" name="no_books" validate="onlyNumbers" value="<?php echo $no_books; ?>" class="form-control text-uppercase" ></td>
											<td>28. Fire safety measures available in the institution</td>
											<td><input type="text" name="fire_safety" value="<?php echo $fire_safety; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>29. Facilities for co-curricular activities</td>
											<td><input type="text" name="co_curricular" value="<?php echo $co_curricular; ?>" class="form-control text-uppercase" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>30. Whether the institution is residential/semi residential/ non-residential? </td>
											<td>
												<select class="form-control text-uppercase" name="inst_loc[a]" id="inst_loc_a">
													<option value="">Please Select</option>
													<option value="R" <?php if($inst_loc_a=="R") echo "selected";?>>Residential</option>
													<option value="SR" <?php if($inst_loc_a=="SR") echo "selected";?>>Semi Residential</option>
													<option value="NR" <?php if($inst_loc_a=="NR") echo "selected";?>>Non-Residential</option>
												</select>
											</td>
											<td>If residential, what is the hostel capacity</td>
											<td><input type="text" name="inst_loc[b]" id="inst_loc_b" value="<?php echo $inst_loc_b; ?>" class="form-control text-uppercase" ></td>
										</tr>
										<tr>
											<td>31. Whether the institution on commercial basis for profit to any individual or association of individuals?</td>
											<td><label class="radio-inline"><input type="radio" name="is_commercial" value="Y"  <?php if(isset($is_commercial) && $is_commercial=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_commercial"  value="N"  <?php if(isset($is_commercial) && $is_commercial=='N') echo 'checked'; ?>/> No</label></td>
											<td>32. Whether admission is open for students irrespective of caste, race, religion and place of birth?</td>						
											<td width="25%"><label class="radio-inline"><input type="radio" name="is_admission" value="Y"  <?php if(isset($is_admission) && $is_admission=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_admission"  value="N"  <?php if(isset($is_admission) && $is_admission=='N') echo 'checked'; ?>/> No</label></td>
										</tr>
										<tr>
											<td colspan="4">33. Details of teaching and non-teaching staff
											<table class="table table-responsive text-center" name="objectTable3" id="objectTable3">
												<tr>
													<th width="5%">Slno</th>
													<th>Name</th>
													<th>Date of Birth</th>
													<th>Academic qualification</th>
													<th>Date of Appointment</th>
													<th>Present Salary</th>
													<th>Whether whole time or part time</th>
												</tr>
												<tr>
													<td>1</td>
													<td>2</td>
													<td>3</td>
													<td>4</td>
													<td>5</td>
													<td>6</td>
													<td>7</td>
												</tr>
											<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
															<td><input type="text" id="ttxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name"]; ?>" validate="letters" name="ttxtB<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_3["dob"]; ?>" id="ttxtC<?php echo $count;?>"  class="dob form-control text-uppercase" size="10" name="ttxtC<?php echo $count;?>"></td>				
															<td><input type="text" value="<?php echo $row_3["qualification"]; ?>" id="ttxtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="ttxtD<?php echo $count;?>"></td>			
															<td><input type="text"  value="<?php echo $row_3["dt_appt"]; ?>" id="ttxtE<?php echo $count;?>"  class="dob form-control text-uppercase" size="10" name="ttxtE<?php echo $count;?>"></td>			
															<td><input type="text" value="<?php echo $row_3["salary"]; ?>" id="ttxtF<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" size="10" name="ttxtF<?php echo $count;?>"></td>									
															<td><input type="text"  value="<?php echo $row_3["time"]; ?>" id="ttxtG<?php echo $count;?>" validate="letters" class="form-control text-uppercase" placeholder="Part Time/Full Time" size="10" name="ttxtG<?php echo $count;?>"></td>	
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  value="1" id="ttxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="ttxtA1"></td>
														<td><input type="text" id="ttxtB1" size="10" class="form-control text-uppercase" validate="letters" name="ttxtB1"></td>
														<td><input type="text" id="ttxtC1" size="10"  class="dob form-control text-uppercase" name="ttxtC1"></td>				
														<td><input type="text"  id="ttxtD1" size="10" class="form-control text-uppercase" name="ttxtD1"></td>	<td><input type="text"  id="ttxtE1" size="10" class="dob form-control text-uppercase" name="ttxtE1"></td>				
														<td><input type="text"  id="ttxtF1" size="10" validate="onlyNumbers"  class=" form-control text-uppercase" name="ttxtF1"></td>				
														<td><input id="ttxtG1" size="10" validate="letters"  placeholder="Part Time/Full Time" class="form-control text-uppercase" name="ttxtG1"></td>				
													</tr>
													<?php } ?>
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
											<td>34.  Any other information</td>
											<td><textarea class="form-control text-uppercase" name="other_info"><?php echo $other_info;?></textarea></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>Place :</td>
											<td><label class="form-control text-uppercase"><?php echo $dist;?></label></td>
											<td>Name and Signature of the Manager of the Institution:</td>
											<td><label class="form-control text-uppercase"><?php echo $key_person;?></label></td>
										</tr>
										<tr>
											<td>Date :</td>
											<td><label class="form-control text-uppercase"><?php echo $today;?></label></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success">Save and Next</button>
											</td>
											<td></td>
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
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	function calculateAge()
	{
		var dob = new Date(y,m.d);
		alert();
		dob.setFullYear(y, m-1, d);
		
		var today = new Date();
		today.setFullYear(today.getFullYear());
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		return age;
	}

	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform2 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('#is_comm_act_b').attr('readonly','readonly');
	<?php if($is_comm_act_a == 'Y') echo "$('#is_comm_act_b').removeAttr('readonly','readonly');"; ?>
	$('.is_comm_act_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_comm_act_b').removeAttr('readonly','readonly');
		}else{
			$('#is_comm_act_b').attr('readonly','readonly');
			$('#is_comm_act_b').val('');
		}			
	});
	$('#is_inst_estd_b').attr('readonly','readonly');
	<?php if($is_inst_estd_a == 'Y') echo "$('#is_inst_estd_b').removeAttr('readonly','readonly');"; ?>
	$('.is_inst_estd_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_inst_estd_b').removeAttr('readonly','readonly');
		}else{
			$('#is_inst_estd_b').attr('readonly','readonly');
			$('#is_inst_estd_b').val('');
		}			
	});
	$('#inst_loc_b').attr('readonly','readonly');
	<?php if($inst_loc_b!=""){  ?>
				$('#inst_loc_b').removeAttr('readonly','readonly');
	<?php } ?>
		
	//$('input:select[name="inst_loc_a"]').onchange();
	$('#inst_loc_a').change(function(){
		if ($(this).val() == "R") {
			$('#inst_loc_b').removeAttr('readonly');
		}else{
			$('#inst_loc_b').attr('readonly','readonly');  
		}	
	});	
	$("#submit").click(function(e){
		var number_of_checked_checkbox= $(".education_stage:checked").length;
	
		if(number_of_checked_checkbox==0){
			alert("Please select atleast one stage in Sl No. 6.");			
			//$("#stage").css("border: 3px solid rgb(255, 0, 0);padding: 3px 0 3px 10px;");
			$("#stage").css("border","3px solid #f00");
			$("#stage").css("padding","3px 0 3px 10px");
			e.preventDefault();
			return false;
		}else{
			$("#stage_form").submit();
		}
     });
</script>