<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="49";
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
		$form_id=$results["form_id"];$land_premises=$results["land_premises"];$investment_cost=$results["investment_cost"];
		$natio_nality=$results["natio_nality"];$survey_no=$results["survey_no"];$khasra_no=$results["khasra_no"];$approximate_date=$results["approximate_date"];$expected_date=$results["expected_date"];$total_no_employee=$results["total_no_employee"];$is_licence=$results["is_licence"];  $is_licence_details=$results["is_licence_details"];$person_authorised=$results["person_authorised"];$licence_annual_capacity=$results["licence_annual_capacity"];//$l_o_business_val=$results["l_o_business_val"];$owners=$results["owners"];
		$dome_stic=$results["dome_stic"];$indus_trial=$results["indus_trial"];$quality_of_effluent=$results["quality_of_effluent"];$monitoring_arrangemen=$results["monitoring_arrangemen"];$is_treatment_plant=$results["is_treatment_plant"];
		
		if(!empty($results["wc_values"])){
			$wc_values=json_decode($results["wc_values"]);
			$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;
		}else{
			$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";
		}		
		if(!empty($results["sold_wastes"])){
			$sold_wastes=json_decode($results["sold_wastes"]);
			$sold_wastes_a=$sold_wastes->a;$sold_wastes_b=$sold_wastes->b;$sold_wastes_c=$sold_wastes->c;$sold_wastes_d=$sold_wastes->d;
		}else{
			$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
		}		
	}else{
		$form_id="";$natio_nality="";$survey_no="";$land_premises="";$investment_cost="";
		$khasra_no="";$approximate_date="";$expected_date="";$total_no_employee="";$total_no_employee="";$is_licence="";
		$is_licence_details="";$person_authorised="";$licence_annual_capacity="";$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";//$l_o_business_val="";$owners="";	
		$water_source="";$dome_stic="";$indus_trial="";$quality_of_effluent="";$monitoring_arrangemen="";$is_treatment_plant="";
		$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
	}
}else{	
	$results=$q->fetch_assoc();		
	$form_id=$results["form_id"];$land_premises=$results["land_premises"];$investment_cost=$results["investment_cost"];
	$natio_nality=$results["natio_nality"];$survey_no=$results["survey_no"];$khasra_no=$results["khasra_no"];$approximate_date=$results["approximate_date"];$expected_date=$results["expected_date"];$total_no_employee=$results["total_no_employee"];$is_licence=$results["is_licence"];  $is_licence_details=$results["is_licence_details"];$person_authorised=$results["person_authorised"];$licence_annual_capacity=$results["licence_annual_capacity"];//$l_o_business_val=$results["l_o_business_val"];$owners=$results["owners"];
	$dome_stic=$results["dome_stic"];$indus_trial=$results["indus_trial"];$quality_of_effluent=$results["quality_of_effluent"];$monitoring_arrangemen=$results["monitoring_arrangemen"];$is_treatment_plant=$results["is_treatment_plant"];
	
	if(!empty($results["wc_values"])){
		$wc_values=json_decode($results["wc_values"]);
		$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;
	}else{
		$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";
	}		
	if(!empty($results["sold_wastes"])){
		$sold_wastes=json_decode($results["sold_wastes"]);
		$sold_wastes_a=$sold_wastes->a;$sold_wastes_b=$sold_wastes->b;$sold_wastes_c=$sold_wastes->c;$sold_wastes_d=$sold_wastes->d;
	}else{
		$sold_wastes_a="";$sold_wastes_b="";$sold_wastes_c="";$sold_wastes_d="";
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
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr class="form-inline">
											<td colspan="4">To The Member Secretary, Central Pollution Control Board.</br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sir, I/We hereby apply for Consent/Renewal of Consent under section 25 of the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) for establishing or taking any steps for establishment of Industry/operation process or any treatment/disposal system to bring into use any new/altered outlet for discharge of *sewage/trade effluent* to continue to discharge* sewage/trade effluent* from land/premises owned by <input type="text" class="form-control text-uppercase" name="land_premises" value="<?php echo $land_premises;?>" >.</td>
										</tr>
										<tr>
											<td colspan="4">The other relevant details are below:- </td>
										</tr>
										
										<tr>
											<td width="25%">Full Name of the applicant:</td>
											<td width="25%"><input type="text" value="<?php echo strtoupper($key_person);?>" class="form-control text-uppercase" disabled></td>
											<td width="25%">2. Nationality of the applicant :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"name="natio_nality" value="<?php echo  $natio_nality; ?>"></td>
										</tr>
										<tr>
											<td>3. Select the appropriate category of business :</td>
											<td><input type="text" name="l_o_business_val" class="form-control text-uppercase" disabled value="<?php //echo $l_o_business_val;?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">4. Name, Address and Telephone Nos. of Applicant. :</td>
										</tr>
										<tr>
											<td colspan="4">
												<table  class="table table-responsive">
												<thead>
												<tr>
												<th width="5%">Sl. No.</th>
												<th width="25%">Partners/Directors Name</th>
												<th width="20%">Street Name 1</th>
												<th width="15%">Street Name 2</th>
												<th width="15%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
												</tr>
												</thead>	
												<?php 
												$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
												if($member_results->num_rows==0){
												for($i=1;$i<=count((array)$owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>

												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count((array)$owners); ?>"/>
												<?php }else{
													$i=1;
												while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php //echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
													
												</tr>
												<?php $i++;
												} ?>
												<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
												<?php } ?>	

												</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">5. Address of the Industry :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
											<td>Survey No :</td>
											<td><input type="text" class="form-control text-uppercase"  name="survey_no" value="<?php echo  $survey_no; ?>" ></td>
										</tr>
										<tr>
											<td>Khasra No :</td>
											<td><input type="text" class="form-control text-uppercase" name="khasra_no" value="<?php echo  $khasra_no; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">6. Details of commissioning etc.:- </td>
										</tr>
										<tr>
											<td>(a) Approximate date of proposed commissioning of work.:</td>
											<td><input type="text" class="dob form-control text-uppercase" name="approximate_date" value="<?php echo $approximate_date;?>" ></td>
											<td>(b) Expected date of production: </td>
											<td><input type="text" class="dob form-control text-uppercase" name="expected_date" value="<?php echo $expected_date;?>" ></td>
										</tr>
										<tr>
											<td colspan="2">Gross capital investment of the unit without depreciation till the date of application(Cost of building, land,plant and machinery)<span class="mandatory_field"> *</span></td>
											<td colspan="2">
												<div class="input-group">
													<div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
													<input placeholder="IN RUPEES" type="text" class="form-control" name="investment_cost"  validate="onlyNumbers" value="<?php echo $investment_cost;?>" required="required" />
												</div>
											</td>
										</tr>
										<tr>
											<td>7. Total number of employee expected to employed. :</td>
											<td><input type="text" class="form-control text-uppercase" name="total_no_employee" value="<?php echo $total_no_employee;?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>8.  Details  of  licence,  if  any  obtained  under  the  provisions  of  Industrial  Development Regulations Act, 1951.</td>
											 <td><label class="radio-inline"><input type="radio" name="is_licence" class= "is_licence" value="Y"  <?php if(isset($is_licence) && $is_licence=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_licence"  value="N"  name="is_licence" <?php if(isset($is_licence) && ($is_licence=='N' || $is_licence=='')) echo 'checked'; ?>/>No</label></td>
											 <td>(b) If yes, please give details.</td>
											 <td width="25%"><textarea name="is_licence_details"  id="is_licence_details" class="form-control text-uppercase"  ><?php echo $is_licence_details; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">9.  Name  of  the  person  authorised  to  sign  this  form  (the  original  authorisation  except  in  the case of individual proprietary concern is to be enclosed).  </td>
											<td><input type="text" class="form-control text-uppercase" name="person_authorised" value="<?php echo $person_authorised;?>" ></td>
										</tr>
										<tr>
											<td colspan="3">10. Licence Annual Capacity of the Factory/Industry.:</td>
											<td><input type="text" class="form-control text-uppercase" name="licence_annual_capacity" value="<?php echo $licence_annual_capacity;?>" ></td>
										</tr>
										<tr>
											<td colspan="3">11.  State  daily  quantity  of  water  in  kilolitres  utilised  and  its  source  (domestic/industrial process boiler Cooling others).</td>
										</tr>
										<tr>
											<td style="width:25%">(i) Industrial process</td>
											<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[a]" placeholder="example : 23.00" title="Please enter a decimal value" value="<?php echo $wc_values_a; ?>" class="form-control text-uppercase wc_sum"></td>
											<td style="width:25%">(ii) Domestic purpose</td>
											<td style="width:25%"><input type="text" validate="decimal" name="wc_values[b]"  value="<?php echo $wc_values_b; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
										</tr>
										<tr>
											<td style="width:25%">(iii) Boiler</td>
											<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[c]" placeholder="example : 23.00" title="Please enter a decimal value" value="<?php echo $wc_values_c; ?>" class="form-control text-uppercase wc_sum"></td>
											<td style="width:25%">(iv) Cooling </td>
											<td style="width:25%"><input type="text" validate="decimal" name="wc_values[d]"  value="<?php echo $wc_values_d; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class=" form-control text-uppercase wc_sum"></td>
										</tr>
										<tr>
											<td >(v) Others such as agriculture, gardening etc. (specify)</td>
											<td><input type="text" validate="decimal" name="wc_values[e]" value="<?php echo $wc_values_e; ?>" placeholder="example : 23.00" title="Please enter a decimal value" class="form-control text-uppercase wc_sum"></td>
											<td></td>
											<td></td>
										</tr>

										<tr> 
										   <td colspan="4">12. (a)  State  the  daily  maximum  quantity  of  effluents  quantity  and  mode  of  disposal (sewer  or  drains  or  river).  Also  attach  analysis  report  of  the  effluents. Type  of effluent quantity in kilolitres Mode of disposal.</td> 
										</tr>
										<tr>
										   <td>(i) Domestic :</td>
										   <td><input type="text" class="form-control text-uppercase" name="dome_stic" value="<?php echo  $dome_stic; ?>"></td>
										   <td>(ii) Industrial.:</td>
										   <td><input type="text" class="form-control text-uppercase" name="indus_trial" value="<?php echo  $indus_trial; ?>" ></td>
										</tr>
										<tr>
										   <td>(b) Quality of effluent currently being the discharged or expected to be discharged. :</td>
										   <td><input type="text" class="form-control text-uppercase" name="quality_of_effluent" value="<?php echo  $quality_of_effluent; ?>"></td>
										   <td>(c) What monitoring arrangement is currently there or proposed.:</td>
										   <td><input type="text" class="form-control text-uppercase" name="monitoring_arrangemen" value="<?php echo  $monitoring_arrangemen; ?>"	></td>
										</tr>
										<tr>
											<td colspan="3">13.  State  whether  you  have  any  treatment  plant  for  industrial,  domestic  or  combined effluents. </td>
											<td>
												<label class="radio-inline"><input type="radio" value="Y" <?php if($is_treatment_plant=="Y" || $is_treatment_plant=="") echo "checked"; ?> name="is_treatment_plant"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_treatment_plant=="N") echo "checked"; ?> name="is_treatment_plant"> No </label>
											</td>
										</tr>							
										<tr>												
											<td class="text-center" colspan="4">&nbsp;</td>
										</tr>
										<tr>												
											<td class="text-center" colspan="4"><button type="submit" name="save<?php echo $form; ?>a"  class="btn btn-success text-bold submit1">Save and Next</button></td>
										</tr>
										</table>
										</form>
									</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">14. State details of sold wastes generated in the process or during waste treatment.</td>
											</tr>
											<tr>
											   <td>Description </td>
												<td><input type="text" name="sold_wastes[a]"  value="<?php echo $sold_wastes_a;?>" class="form-control text-uppercase"></td>
												<td>Quantity </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[b]" value="<?php echo $sold_wastes_b;?>" ></td>
											</tr> 
											<tr>
											   <td>Method </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[c]" value="<?php echo $sold_wastes_c;?>" ></td>
												<td>Method of disposal </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sold_wastes[d]"  value="<?php echo $sold_wastes_d;?>" ></td>
											</tr>
											<tr>
												<td colspan="4">15.  I/We  further  declare  that  the  information  furnished  above  is  correct  to  the  best  of  my/our knowledge.  </td>
											</tr>
											<tr>
												<td colspan="4">16.  I/We  hereby  submit  that  in  case  of  change  either  of  the  point  of  discharge  or  the quantity of discharge  or its quality a  fresh application for CONSENT shall be  made and until such CONSENT is granted no change shall be made.    </td>
											</tr>
											<tr>
												<td colspan="4">17.  I/We  hereby  agree  to  submit  to  the  Central  Board  an  application  for  renewal  of consent  one  month  in  advance  of  the  date  of  expiry  of  the  consented  period  for outlet/discharge if to be continued thereafter.  </td>
											</tr>
											<tr>
												<td colspan="4">18. I/We, undertake to furnish any other information within one month or its being called by the Central Board.  </td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">&nbsp;</td>
											</tr>
											<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	$('#is_licence_details').attr('readonly','readonly');
	<?php if($is_licence == 'Y') echo "$('#is_licence_details').removeAttr('readonly','readonly');"; ?>
	$('.is_licence').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_licence_details').removeAttr('readonly','readonly');
		}else{
			$('#is_licence_details').attr('readonly','readonly');
			$('#is_licence_details').val('');
		}			
	});	
	/* ------------------------------------------------------ */
	$('#is_facilities_details').attr('readonly','readonly');
	<?php if($is_facilities == 'Y') echo "$('#is_facilities_details').removeAttr('readonly','readonly');"; ?>
	$('.is_facilities').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_facilities_details').removeAttr('readonly','readonly');
		}else{
			$('#is_facilities_details').attr('readonly','readonly');
			$('#is_facilities_details').val('');
		}			
	});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>