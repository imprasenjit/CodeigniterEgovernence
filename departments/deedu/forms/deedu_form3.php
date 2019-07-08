<?php  require_once "../../requires/login_session.php";
$dept="deedu";
$form="3";
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
			$form_id=$results["form_id"];
			$name_of_indiv=$results["name_of_indiv"];$location=$results["location"];$date_of_prior=$results["date_of_prior"];$date_of_reg=$results["date_of_reg"];$stage_of_edu=$results["stage_of_edu"];$steam_n_subjects=$results["steam_n_subjects"];$medium_of_ins=$results["medium_of_ins"];$recognized_school=$results["recognized_school"];$is_institution=$results["is_institution"];$constitution=$results["constitution"];$is_scheme=$results["is_scheme"];$camp_area=$results["camp_area"];$type_of_building=$results["type_of_building"];$accomodation=$results["accomodation"];$no_n_size=$results["no_n_size"];$drinking_water=$results["drinking_water"];$total_area=$results["total_area"];$sources_of_fund=$results["sources_of_fund"];$reserved_fund=$results["reserved_fund"];$mothly_income=$results["mothly_income"];$monthly_expen=$results["monthly_expen"];$is_admission=$results["is_admission"];$is_religious=$results["is_religious"];$details_of_curriculm=$results["details_of_curriculm"];$facility_available=$results["facility_available"];$is_manage=$results["is_manage"];$charges=$results["charges"];$no_f_student=$results["no_f_student"];$physical_education=$results["physical_education"];$medical_facility=$results["medical_facility"];$co_curricular=$results["co_curricular"];$other_info=$results["other_info"];$education_stage=$results["education_stage"];
			
			if(!empty($results["authority"])){
				$authority=json_decode($results["authority"]);
				$authority_name=$authority->name;$authority_address=$authority->address;
			}else{				
				$authority_name="";$authority_address="";
			}
			if(!empty($results["classroom"])){
				$classroom=json_decode($results["classroom"]);
				$classroom_a=$classroom->a;$classroom_b=$classroom->b;$classroom_c=$classroom->c;
			}else{				
				$classroom_a="";$classroom_b="";$classroom_c="";
			}
		}else{	
			$form_id="";$authority_name="";
			$name_of_indiv="";$location="";$date_of_prior="";$date_of_reg="";$stage_of_edu="";$steam_n_subjects="";$medium_of_ins="";$recognized_school="";$is_institution="";$constitution="";$is_scheme="";$camp_area="";$type_of_building="";$accomodation="";$no_n_size="";$drinking_water="";$total_area="";$sources_of_fund="";$reserved_fund="";$mothly_income="";$monthly_expen="";
			$is_admission="";$is_religious="";$details_of_curriculm="";$facility_available="";$is_manage="";$charges=""; $no_f_student="";$physical_education="";$medical_facility="";$co_curricular="";$other_info="";
			$authority_name="";$authority_address="";
			$is_comm_act_a="";$is_comm_act_b="";		
			$classroom_a="";$classroom_b="";$classroom_c="";$education_stage="";
		}
	}else{	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$name_of_indiv=$results["name_of_indiv"];$location=$results["location"];$date_of_prior=$results["date_of_prior"];$date_of_reg=$results["date_of_reg"];$stage_of_edu=$results["stage_of_edu"];$steam_n_subjects=$results["steam_n_subjects"];$medium_of_ins=$results["medium_of_ins"];$recognized_school=$results["recognized_school"];$is_institution=$results["is_institution"];$constitution=$results["constitution"];$is_scheme=$results["is_scheme"];$camp_area=$results["camp_area"];$type_of_building=$results["type_of_building"];$accomodation=$results["accomodation"];$no_n_size=$results["no_n_size"];$drinking_water=$results["drinking_water"];$total_area=$results["total_area"];$sources_of_fund=$results["sources_of_fund"];$reserved_fund=$results["reserved_fund"];$mothly_income=$results["mothly_income"];$monthly_expen=$results["monthly_expen"];$is_admission=$results["is_admission"];$is_religious=$results["is_religious"];$details_of_curriculm=$results["details_of_curriculm"];$facility_available=$results["facility_available"];$is_manage=$results["is_manage"];$charges=$results["charges"];$no_f_student=$results["no_f_student"];$physical_education=$results["physical_education"];$medical_facility=$results["medical_facility"];$co_curricular=$results["co_curricular"];$other_info=$results["other_info"];$education_stage=$results["education_stage"];
		
		if(!empty($results["authority"])){
			$authority=json_decode($results["authority"]);
			$authority_name=$authority->name;$authority_address=$authority->address;
		}else{				
			$authority_name="";$authority_address="";
		}
		if(!empty($results["classroom"])){
			$classroom=json_decode($results["classroom"]);
			$classroom_a=$classroom->a;$classroom_b=$classroom->b;$classroom_c=$classroom->c;
		}else{				
			$classroom_a="";$classroom_b="";$classroom_c="";
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
							  <li class="<?php echo $tabbtn3; ?>"><a  href="javascript:void(0)">Part 3</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform2" id="stage_form" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td class="form-inline" colspan="2">To<br/>
											&nbsp;&nbsp;&nbsp;&nbsp;The&nbsp;<input type="text" name="authority[name]"  class="form-control text-uppercase" value="<?php echo $authority_name;?>" placeholder="Authority Name"><br/><br/>
											&nbsp;&nbsp;&nbsp;&emsp;&emsp;<input type="text" name="authority[address]"  class="form-control text-uppercase" value="<?php echo $authority_address;?>" placeholder="Address"> &emsp; <strong>Assam</strong></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">
											Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;I beg to state that I/we have already registered the institution as required under relevant provisions of the Assam Non-Govt. Educational Institutions (Regulation &amp; Management) Act, 2006 (Assam Act, No.IV of 2007). Now I/we would like to request you kindly accord necessary administrative recognition in favour of the said institution, the detail particulars of which are furnished below :
											</td>
										</tr>
										<tr>
											<td width="25%">1. Name of the Institution</td>
											<td width="25%"><input type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%">2. Date of establishment</td>
											<td width="25%"><input  type="text" value="<?php echo $date_of_commencement; ?>" class="form-control text-uppercase" readonly></td>
										</tr>
										<tr>
											<td colspan="4">3. Full address of the Institution</td>
										</tr>										
										<tr>
											<td>Street Name1 </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
											<td>Street Name2</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
											<td>District </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
										</tr>
										<tr>											
											<td>Email Id</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $b_email; ?>"></td>
											<td></td>
											<td></td>
										</tr>										
										<tr>
											<td colspan="3">4. Name of the individual/ Association of individuals/ Society/ Trust establishing the Institution</td>
											<td><input type="text" validate="specialChar" class="form-control text-uppercase" name="name_of_indiv" value="<?php echo  $name_of_indiv; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">5. Name of the Manager with address and contact telephone No.</td>
										</tr>
										<tr>
											<td>Name </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $key_person; ?>"	></td>	
											<td>Street Name1 </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
										</tr>
										<tr>
											<td>Street Name2</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
											<td>Village/Town </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
										</tr>
										<tr>
											<td>District </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
											<td>Pin Code </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
										</tr>
										<tr>
											<td>Mobile No</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
											<td>Email Id</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
										</tr>										
										<tr>
											<td>6. Location</td>
											<td><select class="form-control text-uppercase" name="location">
												<option value="">Please Select</option>
												<option value="Urban" class="form-control text-uppercase" <?php if(isset($location) && $location=="Urban") echo 'selected'; ?>>Urban</option>
												<option value="Rural"  class="form-control text-uppercase" <?php if(isset($location) && $location=="Rural") echo 'selected'; ?>>Rural</option>
												<option value="Hill Urban" class="form-control text-uppercase" <?php if(isset($location) && $location=="Hill Urban") echo 'selected'; ?>>Hill Urban</option>
												<option value="Hill Rural" class="form-control text-uppercase" <?php if(isset($location) && $location=="Hill Rural") echo 'selected'; ?>>Hill Rural</option>
					                        </select>
											</td>
											<td>7. Date of prior permission</td>
											<td><input type="text" class="dob text-uppercase form-control" name="date_of_prior" value="<?php echo $date_of_prior;?>"/></td>
										</tr>
										<tr>
											<td>8. Date of registration</td>
											<td><input type="text" class="dob form-control text-uppercase" name="date_of_reg" value="<?php echo $date_of_reg; ?>"></td>
											
											<td>9. Level of education imparted</td>
											<td><input  type="text" name="stage_of_edu" value="<?php echo $stage_of_edu; ?>" class="form-control text-uppercase"></td>
											
										</tr>
										<tr>
											<td>10. Stage of education for which recognition is applied for</td>
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
											<td>11. In case of Higher Secondary stage, the steam  and subjects for recognition</td>
											<td><input  type="text" name="steam_n_subjects" value="<?php echo $steam_n_subjects; ?>" class="form-control text-uppercase"></td>
										</tr>	
										<tr>
											<td>12. Medium of instruction</td>
											<td><input  type="text" name="medium_of_ins" value="<?php echo $medium_of_ins; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>	
										<tr>
											<td colspan="3">13. Names of recognized schools already functioning in the neighboring area within a radius of 1 Km in respect of Primary, 3 Km in respect of Middle, 5 Km in respect of Secondary, 10 Km in respect of Higher Secondary level of institution as the case may be.</td>
											<td><input  type="text" name="recognized_school" value="<?php echo $recognized_school; ?>" class="form-control text-uppercase"></td>
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
											<td width="25%">14. Whether the institution is running on commercial basis for profit to any individual or group of individuals?</td>
											<td><label class="radio-inline"><input type="radio" name="is_institution" id="is_institution" value="Y"  <?php if(isset($is_institution) && $is_institution=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_institution"  value="N"  id="is_institution" <?php if(isset($is_institution) && $is_institution=='N') echo 'checked'; ?> /> No</label></td>
											<td>15. Constitution of the Managing Committee</td>
											<td><input  type="text" name="constitution" value="<?php echo $constitution; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="3">16. Whether the institution has a scheme of Management as required under section 14 of the Act.? If yes, please enclose a copy of the same.</td>
											<td><label class="radio-inline"><input type="radio" name="is_scheme" id="is_scheme" value="Y"  <?php if(isset($is_scheme) && $is_scheme=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_scheme"  value="N"  id="is_scheme" <?php if(isset($is_scheme) && $is_scheme=='N') echo 'checked'; ?> /> No</label></td>
										</tr>	
										<tr>
											<td width="25%">17. The area of the campus of the institution and the total built-up area</td>
											<td width="25%"><input  type="text" name="camp_area" value="<?php echo $camp_area; ?>" class="form-control text-uppercase"></td>
											<td width="25%">18. Type of the building </td>
											<td><select class="form-control text-uppercase" name="type_of_building">
												<option value="disabled">Please Select</option>
												<option value="Assam Type" class="form-control text-uppercase" <?php if(isset($type_of_building) && $type_of_building=="Assam Type") echo 'selected'; ?>>Assam Type</option>
												<option value="R.C.C. Single storey"  class="form-control text-uppercase" <?php if(isset($type_of_building) && $type_of_building=="R.C.C. Single storey") echo 'selected'; ?>>R.C.C. Single storey</option>
												<option value="R.C.C. double storey" class="form-control text-uppercase" <?php if(isset($type_of_building) && $type_of_building=="R.C.C. double storey") echo 'selected'; ?>>R.C.C. double storey</option>
												<option value="R.C.C. multiple storey" class="form-control text-uppercase" <?php if(isset($type_of_building) && $type_of_building=="R.C.C. multiple storey") echo 'selected'; ?>>R.C.C. multiple storey</option>
												</select>
											</td>
										</tr>	
										<tr>
											<td colspan="3">19. Accomodation provided in the institution  building (dimensions to be indicated in all cases)</td>
											<td><input  type="text" name="accomodation" value="<?php echo $accomodation; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="3">20. Number &amp; size of classrooms, office room,staff room, common room for students, library and reading room, school hall, Science Laboratories, Store room etc.</td>
											<td width="25%"><input  type="text" name="no_n_size" value="<?php echo $no_n_size; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td width="25%">21. Drinking water and sanitation facilities</td>
											<td width="25%"><input  type="text" name="drinking_water" value="<?php echo $drinking_water; ?>" class="form-control text-uppercase"></td>
											<td>22. Desk-bench in the classroom</td>
											<td><input type="text" name="classroom[a]" value="<?php echo $classroom_a; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>23. No. of books in the library</td>
											<td><input  type="text" name="classroom[b]" validate="onlyNumbers" value="<?php echo $classroom_b; ?>" class="form-control text-uppercase"></td>
											<td>24. Science apparatus and equipment in the Science laboratory</td>
											<td><input  type="text" name="classroom[c]" value="<?php echo $classroom_c; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>25. Total area of playgrounds and number of playgrounds available and the games played</td>
											<td><input  type="text" name="total_area" validate="onlyNumbers" value="<?php echo $total_area; ?>" class="form-control text-uppercase"></td>
											<td>26. Sources of fund and financial position of the institution</td>
											<td><input  type="text" name="sources_of_fund" value="<?php echo $sources_of_fund; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>				
											<td>27. Reserved fund</td>
											<td><input  type="text" name="reserved_fund" value="<?php echo $reserved_fund; ?>" class="form-control text-uppercase"></td>
											<td>28. Monthly income from fees and other sources</td>
											<td><input type="text" name="mothly_income" value="<?php echo $mothly_income; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>											
											<td>29. Average monthly expenditure</td>
											<td><input  type="text" name="monthly_expen" value="<?php echo $monthly_expen; ?>" class="form-control text-uppercase"></td>
											<td></td>
											<td></td>
										</tr>					
										<tr>
											<td class="text-center" colspan="4">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success">Save and Next</button>
											</td>
										</tr>
									</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4">30. Number of students in the current year</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
											<tr>
												<th width="5%">Slno</th>
												<th width="25%">Name of the Class</th>
												<th width="20%">Section</th>
												<th width="25%">Number of students enrolled</th>
												<th width="25%">Average attendance in each section during the last 6 months</th>
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
														<td><input type="text" value="<?php echo $row_1["section"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["no_f_student"]; ?>" id="txtD<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["avg_attendance"]; ?>" id="txtE<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" validate="specialChar"  class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" id="txtD1" size="10" validate="specialChar"  class="form-control text-uppercase" name="txtD1"></td>
													<td><input type="text" id="txtE1" size="10" validate="specialChar"  class="form-control text-uppercase" name="txtE1"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>		
									<tr>
										<td width="25%">31. Whether admission in the school is open to all without any discrimination based on religion,caste, race, place of birth or any</td>
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_admission" id="is_admission" value="Y"  <?php if(isset($is_admission) && $is_admission=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_admission"  value="N"  id="is_admission" <?php if(isset($is_admission) && $is_admission=='N') echo 'checked'; ?> /> No</label></td>
										<td width="25%">32. Whether any religious instruction is imparted and if so, whether it is compulsory?</td>
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_religious" id="is_religious" value="Y"  <?php if(isset($is_religious) && $is_religious=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_religious"  value="N"  id="is_religious" <?php if(isset($is_religious) && $is_religious=='N') echo 'checked'; ?> /> No</label></td>
									</tr>
									<tr>
										<td>33. Details of curriculum and syllabus followed in each class</td>
										<td><input  type="text" name="details_of_curriculm" value="<?php echo $details_of_curriculm; ?>" class="form-control text-uppercase"></td>
										<td>34. Educational and Vocational guidance facilities available</td>
										<td><input  type="text" name="facility_available" value="<?php echo $facility_available; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>35. Whether the management maintains a provident fund scheme or any other similar scheme for the staff ?</td>										
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_manage" id="is_manage" value="Y"  <?php if(isset($is_manage) && $is_manage=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_manage"  value="N"  id="is_manage" <?php if(isset($is_manage) && $is_manage=='N') echo 'checked'; ?> /> No</label></td>
										<td>36. Rates of fees and other funds/ charges (Class-wise)</td>
										<td><input  type="text" name="charges" value="<?php echo $charges; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="2">37. Number of students residing with their parents/ guardians and arrangements made for their conveyance</td>
										<td><input  type="text" name="no_f_student" value="<?php echo $no_f_student; ?>" class="form-control text-uppercase"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">38. Details of staff including Head of the Institution</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive text-center" name="objectTable2" id="objectTable2" >
											<tr>
												<th width="5%">Sl No</th>
												<th width="10%">Name</th>
												<th width="15%">Date of Birth</th>
												<th width="15%">Academic Qualifications , training previous teaching experience, if any</th>
												<th width="15%">Subject being taught at present</th>
												<th width="10%">Date of appointment</th>
												<th width="10%">Present pay with the scale of pay</th>
												<th width="20%">Whether whole time/Part time</th>
											</tr>
											<?php
												$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
												  $count=1;
												  while($row_2=$part2->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input type="text" id="textB<?php echo $count;?>" validate="letters" class="dob form-control text-uppercase" value="<?php echo $row_2["name"]; ?>"  name="textB<?php echo $count;?>" size="10"></td>
														<td><input type="date" value="<?php echo $row_2["dob"]; ?>" id="textC<?php echo $count;?>"  class="dob form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["qualification"]; ?>" id="textD<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["subject"]; ?>" id="textE<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="textE<?php echo $count;?>"></td>
														<td><input type="date" value="<?php echo $row_2["date_of_appoin"]; ?>" id="textF<?php echo $count;?>" class="dob form-control text-uppercase" size="10" name="textF<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["present_pay"]; ?>" id="textG<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="textG<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["time"]; ?>" id="textH<?php echo $count;?>" placeholder="WHOLE TIME/PART TIME"  class="form-control text-uppercase" size="10" name="textH<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
													<td><input type="text" id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
													<td><input type="date" id="textC1" size="10" class="dob form-control text-uppercase" name="textC1"></td>
													<td><input type="text" id="textD1" size="10"  class="form-control text-uppercase" name="textD1"></td>
													<td><input type="text" id="textE1" size="10"  class="form-control text-uppercase" name="textE1"></td>
													<td><input type="date" id="textF1" size="10"   class="dob form-control text-uppercase" name="textF1"></td>
													<td><input type="text" id="textG1" size="10"   class="form-control text-uppercase" name="textG1"></td>
													<td><input type="text" id="textH1" size="10"  placeholder="WHOLE TIME/PART TIME" class="form-control text-uppercase" name="textH1"></td>
												</tr>
												<?php } ?>													
											</table>										
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td>39. Details of facilities available for Physical Education and recreation</td>
										<td><input  type="text" name="physical_education" value="<?php echo $physical_education; ?>" class="form-control text-uppercase"></td>
										<td>40. Medical facilities for students</td>
										<td><input  type="text" name="medical_facility" value="<?php echo $medical_facility; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>41. Details of co-curricular, cultural and other activities organized in the school</td>
										<td><input  type="text" name="co_curricular" value="<?php echo $co_curricular; ?>" class="form-control text-uppercase"></td>
										<td>42. Any other information</td>
										<td><input  type="text" name="other_info" value="<?php echo $other_info; ?>" class="form-control text-uppercase"></td>
									</tr>											
									<tr>
										<td colspan="2">Place :<strong><?php echo strtoupper($dist)?></strong><br/>Date : <strong><?php echo strtoupper($today)?></strong></td>
										<td colspan="2" align="right">Name and Signature of the Manager of the Institution <br/>
										<strong><?php echo strtoupper($key_person)?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a type="button" href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>c" class="btn btn-success">Save and Next</button>
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
	/* ------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
   
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