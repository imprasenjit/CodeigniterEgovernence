<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="81";
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
		$owner_name=$results['owner_name'];
		if(!empty($results["applicant"])){
			$applicant=json_decode($results["applicant"]);
			$applicant_name=$applicant->name;$applicant_nationality=$applicant->nationality;
		}else{				
			$applicant_name="";$applicant_nationality="";
		}			
		if(!empty($results["details"])){
			$details=json_decode($results["details"]);
			$details_ind=$details->ind;$details_prop=$details->prop;$details_firm=$details->firm;$details_joint=$details->joint;$details_priv=$details->priv;$details_pub=$details->pub;$details_state=$details->state;$details_central=$details->central;$details_union=$details->union;$details_foreign=$details->foreign;$details_other=$details->other;
		}else{				
			$details_ind="";$details_prop="";$details_firm="";$details_joint="";$details_priv="";$details_pub="";$details_state="";$details_central="";$details_union="";$details_foreign="";$details_other="";
		}	
		// Tab 2 //
		$indus_add=$results['indus_add'];$no_of_employee=$results['no_of_employee'];$licence=$results['licence'];$auth_name=$results['auth_name'];$capacity=$results['capacity'];$is_treat=$results['is_treat'];
		
		if(!empty($results["comm"])){
			$comm=json_decode($results["comm"]);
			$comm_work=$comm->work;$comm_prod=$comm->prod;
		}else{				
			$comm_work="";$comm_prod="";
		}		
		if(!empty($results["daily"])){
			$daily=json_decode($results["daily"]);
			$daily_qty=$daily->qty;$daily_source=$daily->source;
		}else{				
			$daily_qty="";$daily_source="";
		}
		if(!empty($results["effluent"])){
			$effluent=json_decode($results["effluent"]);
			$effluent_qty1=$effluent->qty1;$effluent_mode1=$effluent->mode1;$effluent_qty2=$effluent->qty2;$effluent_mode2=$effluent->mode2;$effluent_discharge=$effluent->discharge;$effluent_monitor=$effluent->monitor;
		}else{				
			$effluent_qty1="";$effluent_mode1="";$effluent_qty2="";$effluent_mode2="";$effluent_discharge="";$effluent_monitor="";
		}
		if(!empty($results["solid"])){
			$solid=json_decode($results["solid"]);
			$solid_qty=$solid->qty;$solid_desc=$solid->desc;$solid_method=$solid->method;$solid_dispose=$solid->dispose;
		}else{				
			$solid_qty="";$solid_desc="";$solid_method="";$solid_dispose="";
		}		
		if(!empty($results["draft"])){
			$draft=json_decode($results["draft"]);
			$draft_no=$draft->no;$draft_dt=$draft->dt;$draft_name=$draft->name;$draft_amnt=$draft->amnt;$draft_rupees=$draft->rupees;
		}else{				
			$draft_no="";$draft_dt="";$draft_name="";$draft_amnt="";$draft_rupees="";
		}
	}else{
		$form_id="";
		// Tab 1 //
		$owner_name="";$applicant_name="";$applicant_nationality="";
		$details_ind="";$details_prop="";$details_firm="";$details_joint="";$details_priv="";$details_pub="";$details_state="";$details_central="";$details_union="";$details_foreign="";$details_other="";
		// Tab 2 //
		$indus_add="";$no_of_employee="";$licence="";$auth_name="";$capacity="";$is_treat="";
		$comm_work="";$comm_prod="";$daily_qty="";$daily_source="";
		$effluent_qty1="";$effluent_mode1="";$effluent_qty2="";$effluent_mode2="";$effluent_discharge="";$effluent_monitor="";
		$solid_qty="";$solid_desc="";$solid_method="";$solid_dispose="";
		$draft_no="";$draft_dt="";$draft_name="";$draft_amnt="";$draft_rupees="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	// Tab 1 //
	$owner_name=$results['owner_name'];
	if(!empty($results["applicant"])){
		$applicant=json_decode($results["applicant"]);
		$applicant_name=$applicant->name;$applicant_nationality=$applicant->nationality;
	}else{				
		$applicant_name="";$applicant_nationality="";
	}			
	if(!empty($results["details"])){
		$details=json_decode($results["details"]);
		$details_ind=$details->ind;$details_prop=$details->prop;$details_firm=$details->firm;$details_joint=$details->joint;$details_priv=$details->priv;$details_pub=$details->pub;$details_state=$details->state;$details_central=$details->central;$details_union=$details->union;$details_foreign=$details->foreign;$details_other=$details->other;
	}else{				
		$details_ind="";$details_prop="";$details_firm="";$details_joint="";$details_priv="";$details_pub="";$details_state="";$details_central="";$details_union="";$details_foreign="";$details_other="";
	}	
	// Tab 2 //
	$indus_add=$results['indus_add'];$no_of_employee=$results['no_of_employee'];$licence=$results['licence'];$auth_name=$results['auth_name'];$capacity=$results['capacity'];$is_treat=$results['is_treat'];
	
	if(!empty($results["comm"])){
		$comm=json_decode($results["comm"]);
		$comm_work=$comm->work;$comm_prod=$comm->prod;
	}else{				
		$comm_work="";$comm_prod="";
	}		
	if(!empty($results["daily"])){
		$daily=json_decode($results["daily"]);
		$daily_qty=$daily->qty;$daily_source=$daily->source;
	}else{				
		$daily_qty="";$daily_source="";
	}
	if(!empty($results["effluent"])){
		$effluent=json_decode($results["effluent"]);
		$effluent_qty1=$effluent->qty1;$effluent_mode1=$effluent->mode1;$effluent_qty2=$effluent->qty2;$effluent_mode2=$effluent->mode2;$effluent_discharge=$effluent->discharge;$effluent_monitor=$effluent->monitor;
	}else{				
		$effluent_qty1="";$effluent_mode1="";$effluent_qty2="";$effluent_mode2="";$effluent_discharge="";$effluent_monitor="";
	}
	if(!empty($results["solid"])){
		$solid=json_decode($results["solid"]);
		$solid_qty=$solid->qty;$solid_desc=$solid->desc;$solid_method=$solid->method;$solid_dispose=$solid->dispose;
	}else{				
		$solid_qty="";$solid_desc="";$solid_method="";$solid_dispose="";
	}		
	if(!empty($results["draft"])){
		$draft=json_decode($results["draft"]);
		$draft_no=$draft->no;$draft_dt=$draft->dt;$draft_name=$draft->name;$draft_amnt=$draft->amnt;$draft_rupees=$draft->rupees;
	}else{				
		$draft_no="";$draft_dt="";$draft_name="";$draft_amnt="";$draft_rupees="";
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
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane<?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4">From,<br/>&nbsp;&nbsp;&nbsp;<input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled">&nbsp;<br/>&nbsp;&nbsp;&nbsp;<textarea class="form-control text-uppercase" disabled="disabled"><?php echo $unit_details; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Central Pollution Control Board.</td>
											</tr>
											<tr class="form-inline">
												<td colspan="4">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for Consent/Renewal of Consent under section 25 of the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) for establishing or taking any steps for establishment of Industry/operation process or any treatment/disposal system to bring into use any new/altered outlet for discharge of sewage/trade effluent to continue to discharge sewage/trade effluent from land/premises owned by &nbsp;<input type="text"  class="form-control text-uppercase" name="owner_name" value="<?php echo $owner_name;?>"></td>
											</tr>
											<tr>
												<td colspan="4">The other relevant details are below :- </td>
											</tr>
											<tr>
												<td width="25%">1. Full Name of the applicant : </td>
												<td width="25%"><input type="text"  class="form-control text-uppercase" name="applicant[name]" value="<?php echo $applicant_name;?>"></td>
												<td width="25%">2. Nationality of the applicant : </td>
												<td width="25%"><input type="text"  class="form-control text-uppercase" name="applicant[nationality]" value="<?php echo $applicant_nationality;?>"></td>
											</tr>
											<tr>
												<td>3. (a) Individual : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[ind]" value="<?php echo $details_ind;?>"></td>
												<td>(b) Proprietary concern : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[prop]" value="<?php echo $details_prop;?>"></td>
											</tr>
											<tr>
												<td>(c) Partnership firm : </td>
												<td>
													<label class="radio-inline"><input type="radio" name="details[firm]" value="R"  <?php if(isset($details_firm) && $details_firm=='R') echo 'checked'; ?> /> Registered </label>
													<label class="radio-inline"><input type="radio" value="U"  name="details[firm]" <?php if(isset($details_firm) && ($details_firm=='U' || $details_firm=='')) echo 'checked'; ?>/> Unregistered </label>
												</td>
												<td>(d) Joint family concern : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[joint]" value="<?php echo $details_joint;?>"></td>
											</tr>
											<tr>
												<td>(e) Private Limited Company : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[priv]" value="<?php echo $details_priv;?>"></td>
												<td>(f) Public Limited Company : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[pub]" value="<?php echo $details_pub;?>"></td>
											</tr>
											<tr>
												<td colspan="4">(g) Government Company : </td>
											</tr>
											<tr>
												<td>i) State Government : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[state]" value="<?php echo $details_state;?>"></td>
												<td>ii) Central Government : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[central]" value="<?php echo $details_central;?>"></td>
											</tr>
											<tr>
												<td>iii) Union Territory : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[union]" value="<?php echo $details_union;?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>(h) Foreign Company (If a foreign company, the details of registration, incorporation, etc.) : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[foreign]" value="<?php echo $details_foreign;?>"></td>
												<td>(i) Any other Association or Body : </td>
												<td><input type="text"  class="form-control text-uppercase" name="details[other]" value="<?php echo $details_other;?>"></td>
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
												<td colspan="4">4. Name, Address and Telephone Nos. of Applicant &nbsp;&nbsp;(The full list of individuals, partners, persons, Chairman (Full-time or part-time Managing Directors, Managing Partners Directors (Full time or part-time) and other kinds of office bearers are to be furnished with their period of tenure in the respective office with telephone Nos. and address ) &nbsp; : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
													<tr> 
														<th>Sl No. </th>
														<th>Name </th>
														<th>Address </th>
														<th>Telephone Nos. </th>
														<th>Period of tenure </th>
														<th>Respective office </th>
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
															<td><input name="txtB<?php echo $count;?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>"></td>														
															<td><textarea name="txtC<?php echo $count;?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase"><?php echo $row_1["address"];?></textarea></td>
															<td><input name="txtD<?php echo $count;?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["phone"]; ?>"></td>										
															<td><input name="txtE<?php echo $count;?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["tenure"]; ?>"></td>											
															<td><textarea name="txtF<?php echo $count;?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase"><?php echo $row_1["office"];?></textarea></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
														<tr>
															<td><input  name="txtA1" id="txtA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase"></td>
															<td><input name="txtB1" id="txtB1" class="form-control text-uppercase"></td>					
															<td><textarea name="txtC1" id="txtC1" class="form-control text-uppercase"></textarea></td>	
															<td><input name="txtD1" id="txtD1" class="form-control text-uppercase"></td>	
															<td><input name="txtE1" id="txtE1" class="form-control text-uppercase"></td>	
															<td><textarea name="txtF1" id="txtF1" class="form-control text-uppercase"></textarea></td>	
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">5. Details of commissioning etc. : </td>
											</tr>
											<tr>
												<td width="25%">(a) Approximate date of proposed commissioning of work : </td>
												<td width="25%"><input type="date" class="dob form-control" name="comm[work]" value="<?php echo $comm_work;?>"></td>
												<td width="25%">(b) Expected date of production : </td>
												<td width="25%"><input type="date" class="dob form-control" name="comm[prod]" value="<?php echo $comm_prod;?>"></td>
											</tr>											
											<tr>
												<td colspan="2">6. Address of the Industry &nbsp;(Survey No, Khasra No, location as per the revenue records, Village, Firka, Tehsil, District, Police Station or SHO jurisdiction of the First-Class Magistrate )&nbsp; :</td>
												<td colspan="2"><textarea class="form-control text-uppercase" name="indus_add"><?php echo $indus_add; ?></textarea></td>
											</tr>
											<tr>
												<td>7. Total number of employee expected to employed : </td>
												<td><input type="text" class="form-control text-uppercase" name="no_of_employee" value="<?php echo $no_of_employee;?>"></td>
												<td>8. Details of licence, if any obtained under the provisions of Industrial Development Regulations Act, 1951 : </td>
												<td><input type="text" class="form-control text-uppercase" name="licence" value="<?php echo $licence;?>"></td>
											</tr>
											<tr>
												<td colspan="3">9. Name of the person authorised to sign this form (the original authorisation except in the case of individual proprietary concern is to be enclosed) : </td>
												<td><input type="text" class="form-control text-uppercase" name="auth_name" value="<?php echo $auth_name;?>"></td>											
											</tr>
											<tr>
												<td>10. (a) Licence Annual Capacity of the Factory/Industry : </td>
												<td><input type="text" class="form-control text-uppercase" name="capacity" value="<?php echo $capacity;?>"></td>
												<td>(b) Attach the list of raw materials and chemicals used per month : </td>
												<td>Upload later in upload section </td>
											</tr>
											<tr>
												<td colspan="2">11. State daily quantity of water in kilolitres utilised and its source (domestic/industrial process boiler Cooling others) : </td>
												<td><input type="text" class="form-control text-uppercase" name="daily[qty]" value="<?php echo $daily_qty;?>" placeholder="Quantity (in kilolitres)"></td>
												<td><input type="text" class="form-control text-uppercase" name="daily[source]" value="<?php echo $daily_source;?>" placeholder="Source"></td>
											</tr>
											<tr>
												<td colspan="4">12. (a) State the daily maximum quantity of effluents quantity and mode of disposal (sewer or drains or river) : <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Also attach analysis report of the effluents </td>
											</tr>
											<tr>
												<td colspan="4">
												<table class="table table-responsive table-bordered">
													<thead>
														<tr>
															<th>Type of effluent </th>
															<th>Quantity (In Kilolitres) </th>
															<th>Mode of disposal </th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>Domestic</td>
															<td><input type="text" class="form-control text-uppercase" name="effluent[qty1]" value="<?php echo $effluent_qty1;?>" placeholder="Kiloletres"></td>
															<td><input type="text" class="form-control text-uppercase" name="effluent[mode1]" value="<?php echo $effluent_mode1;?>" placeholder="Sewer or drains or river"></td>
														</tr>
														<tr>
															<td>Industrial</td>
															<td><input type="text" class="form-control text-uppercase" name="effluent[qty2]" value="<?php echo $effluent_qty2;?>" placeholder="Kiloletres"></td>
															<td><input type="text" class="form-control text-uppercase" name="effluent[mode2]" value="<?php echo $effluent_mode2;?>" placeholder="Sewer or drains or river"></td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td>(b) Quality of effluent currently being discharged or expected to be discharged : </td>
												<td><input type="text" class="form-control text-uppercase" name="effluent[discharge]" value="<?php echo $effluent_discharge;?>"></td>
												<td>(c) What monitoring arrangement is currently there or proposed : </td>
												<td><input type="text" class="form-control text-uppercase" name="effluent[monitor]" value="<?php echo $effluent_monitor;?>"></td>
											</tr>
											<tr>
												<td>13. State whether you have any treatment plant for industrial, domestic or combined effluents : </td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_treat" value="Y"  <?php if(isset($is_treat) && $is_treat=='Y') echo 'checked'; ?> /> Yes</label>
													<label class="radio-inline"><input type="radio" value="N"  name="is_treat" <?php if(isset($is_treat) && ($is_treat=='N' || $is_treat=='')) echo 'checked'; ?>/> No</label>
												</td>
												<td colspan="2">If yes, attach the description of the process of treatment in brief. Attach information on the quality of treated effluent vis-a-vis the standards.</td>
											</tr>		
											<tr>
												<td colspan="4">14. State details of sold wastes generated in the process or during waste treatment : </td>
											</tr>											
											<tr>
												<td>(a) Description : </td>
												<td><input type="text" class="form-control text-uppercase" name="solid[desc]" value="<?php echo $solid_desc;?>"></td>
												<td>(b) Quantity : </td>
												<td><input type="text" class="form-control text-uppercase" name="solid[qty]" value="<?php echo $solid_qty;?>"></td>
											</tr>										
											<tr>
												<td>(c) Method : </td>
												<td><input type="text" class="form-control text-uppercase" name="solid[method]" value="<?php echo $solid_method;?>"></td>
												<td>(d) Method of disposal : </td>
												<td><input type="text" class="form-control text-uppercase" name="solid[dispose]" value="<?php echo $solid_dispose;?>"></td>
											</tr>
											<tr>
												<td colspan="4">15. I/We further declare that the information furnished above is correct to the best of my/our knowledge.</td>
											</tr>
											<tr>
												<td colspan="4">16. I/We hereby submit that in case of change either of the point of discharge or the quantity of discharge or its quality a fresh application for CONSENT shall be made and until such CONSENT is granted no change shall be made.</td>
											</tr>
											<tr>
												<td colspan="4">17. I/We hereby agree to submit to the Central Board an application for renewal of consent one month in advance of the date of expiry of the consented period for outlet/discharge if to be continued thereafter.</td>
											</tr>
											<tr>
												<td colspan="4">18. I/We, undertake to furnish any other information within one month or its being called by the Central Board.</td>
											</tr>
											<tr class="form-inline">
												<td colspan="4">19. I/We, enclose herewith cash receipt No./bank draft No. &nbsp;<input type="text" class="form-control text-uppercase" name="draft[no]" value="<?php echo $draft_no; ?>">&nbsp; dated &nbsp;<input type="date" class="dob form-control" name="draft[dt]" value="<?php echo $draft_dt; ?>">&nbsp; for 
												&nbsp;<input type="text" class="form-control text-uppercase" name="draft[name]" value="<?php echo $draft_name; ?>">&nbsp; Rs. &nbsp;<input type="text" class="form-control text-uppercase" name="draft[amnt]" value="<?php echo $draft_amnt; ?>">&nbsp; (Rupees &nbsp;<input type="text" class="form-control text-uppercase" name="draft[rupees]" value="<?php echo $draft_rupees; ?>">&nbsp; ) in favour of the Central Pollution Control Board, New Delhi, as fees payable under section 25 of the Act.</td>
											</tr>										
											<tr>
												<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
												<td colspan="2" align="right">Signature of the applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
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
</script>