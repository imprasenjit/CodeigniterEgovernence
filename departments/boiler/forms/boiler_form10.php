<?php  require_once "../../requires/login_session.php";
$dept="boiler";
$form="10";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$esta_yr=$results['esta_yr'];$jobs_typ=$results['jobs_typ'];$is_firm_approved=$results['is_firm_approved'];$firm_app_det=$results['firm_app_det'];$is_recogn_req=$results['is_recogn_req'];$firm_app_details=$results['firm_app_details'];$is_rec_gener=$results['is_rec_gener'];	$working_sites=$results['working_sites'];$is_firm_pre_execute=$results['is_firm_pre_execute'];$is_firm_pre_accept=$results['is_firm_pre_accept'];$is_firm_supply_mat=$results['is_firm_supply_mat'];$is_firm_internal=$results['is_firm_internal'];$firm_int_qua_det=$results['firm_int_qua_det'];
			
		if(!empty($results["classification_applied"])){
			$classification_applied=json_decode($results["classification_applied"]);
			$classification_applied_cl=$classification_applied->cl;
		}else{
			$classification_applied_cl="";
		}
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			$esta_yr=$results['esta_yr'];$jobs_typ=$results['jobs_typ'];$is_firm_approved=$results['is_firm_approved'];$firm_app_det=$results['firm_app_det'];$is_recogn_req=$results['is_recogn_req'];$firm_app_details=$results['firm_app_details'];$is_rec_gener=$results['is_rec_gener'];	$working_sites=$results['working_sites'];$is_firm_pre_execute=$results['is_firm_pre_execute'];$is_firm_pre_accept=$results['is_firm_pre_accept'];$is_firm_supply_mat=$results['is_firm_supply_mat'];$is_firm_internal=$results['is_firm_internal'];$firm_int_qua_det=$results['firm_int_qua_det'];
			
			if(!empty($results["classification_applied"])){
				$classification_applied=json_decode($results["classification_applied"]);
				$classification_applied_cl=$classification_applied->cl;
			}else{
				$classification_applied_cl="";
			}
			
		}else{
			$form_id="";$esta_yr="";$classification_applied_cl="";
			$jobs_typ="";$is_firm_approved="";$firm_app_det="";$is_recogn_req="";$firm_app_details="";$is_rec_gener=""; $working_sites="";$is_firm_pre_execute="";$is_firm_pre_accept="";$is_firm_supply_mat="";$is_firm_internal="";$firm_int_qua_det="";		
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
							  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="4">1.(a) Registered name of the firm and its permanent address</td>
											</tr>
											<tr>
												<td width="25%">Name of the firm : </td>
												<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">Permanent Address of the firm : </td>
											</tr>
											<tr>
												<td width="25%">Street name 1 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
												<td width="25%">Street name 2 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>	
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" disabled value="<?php echo $b_vill; ?>" class="form-control text-uppercase"></td>
												<td>District :</td>
												<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Pin code :</td>
												<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control text-uppercase"></td>
												<td>Mobile No. :</td>
												<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control"></td>
											</tr>
											<tr>
												<td colspan="4">(b) Address of the workshop : </td>
											</tr>
											<tr>
												<td width="25%">Street name 1 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
												<td width="25%">Street name 2 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>	
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" disabled value="<?php echo $b_vill; ?>" class="form-control text-uppercase"></td>
												<td>District :</td>
												<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Pin code :</td>
												<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control text-uppercase"></td>
												<td>Mobile No. :</td>
												<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control"></td>
											</tr>											
											<tr>
												<td>2. Year of establishment :</td>
												<td><input type="text"  name="esta_yr" value="<?php echo $esta_yr; ?>" class="form-control text-uppercase"></td>
												<td>3. Classification applied for :<span class="mandatory_field"> *</span></td>
												<td><select name="classification_applied[cl]" required="required" class="form-control text-uppercase">
														<option value='special_class' <?php if($classification_applied_cl=='special_class') echo "selected"; ?> >(a) Special Class ( For any Boiler Pressure)</option>
														<option value='classI' <?php if($classification_applied_cl=='classI') echo "selected"; ?> >(b) Class I (For Boiler Pressure upto 125 kg.cm2)</option>
														<option value='classII' <?php if($classification_applied_cl=='classII') echo "selected"; ?> >(c) Class II (For Boiler Pressure upto 40 kg./cm2)</option>
														<option value='classIII' <?php if($classification_applied_cl=='classIII') echo "selected"; ?> >(d) Class III (For Boiler Pressure upto 17.5 kg/cm2)</option>						
													</select>
												</td>
											</tr>	
											<tr>								   
												<td colspan="3">4. Type of jobs executed by the firm earlier, with special reference to their maximum working pressure,temperature and the materials involved, with documentary evidence :</td>
												<td><input type="text" name="jobs_typ" value="<?php echo $jobs_typ; ?>" required class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>5.(a) Whether the firm has ever been approved by any Boiler's Directorate/Inspectorate? </td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_firm_approved" class="is_firm_approved" value="Y"  <?php if(isset($is_firm_approved) && $is_firm_approved=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_firm_approved" name="is_firm_approved"  value="N"  <?php if(isset($is_firm_approved) && ($is_firm_approved=='N' || $is_firm_approved=='')) echo 'checked'; ?>/> No</label>
												</td>	
												<td>If so, give details :</td>
												<td><textarea  name="firm_app_det"  id="firm_app_det" <?php if($is_firm_approved=='N' || $is_firm_approved=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $firm_app_det; ?></textarea></td>
											</tr>
											<tr>
												<td>(b) Has your request for recognition as a repairer under Indian Boiler Regulations, 1950 been rejected by any Authority?  </td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_recogn_req" class="is_recogn_req" value="Y"  <?php if(isset($is_recogn_req) && $is_recogn_req=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" name="is_recogn_req" class="is_recogn_req"  value="N"  <?php if(isset($is_recogn_req) && ($is_recogn_req=='N' || $is_recogn_req=='')) echo 'checked'; ?>/> No</label>
												</td>
												<td>If so, please give details :</td>
												<td><textarea  name="firm_app_details" id="firm_app_details" <?php if($is_recogn_req=='N' || $is_recogn_req=='') echo "readonly='readonly'"; ?> class="form-control text-uppercase" validate="textarea" ><?php echo $firm_app_details; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="3">6. Whether having rectifier/generator, grinder, general tools and tackles, dye penetrant kit, expander and measuring instruments or any other tools and tackles under regulation 392(5)(i).?</td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_rec_gener" class="is_rec_gener" value="Y"  <?php if(isset($is_rec_gener) && $is_rec_gener=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_rec_gener" name="is_rec_gener"  value="N"  <?php if(isset($is_rec_gener) && ($is_rec_gener=='N' || $is_rec_gener=='')) echo 'checked'; ?>/> No</label>
												</td>	
											</tr>
											<tr>
												<td colspan="4">7. Detailed list of technical personnel with designation, educational qualifications and relevant experience (attach copies of documents) who are permanently employed with the firm. :
													<table name="objectTable1" id="objectTable1" class="table table-responsive 	text-center">
														<thead>
														<tr>
															<th width="5%">Sl. No.</th>
															<th width="20%">Name</th>
															<th width="25%">Designation</th>
															<th width="25%">Qualification</th>
															<th width="25%">Experience</th>
														</tr>
														</thead>
														<?php
															$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
															$num1 = $part1->num_rows;
															if($num1>0){
															  $count=1;
															  while($row_1=$part1->fetch_array()){	?>
																<tr>
																	<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																	<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																	<td><input value="<?php echo $row_1["designation"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																	<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																	<td><input value="<?php echo $row_1["experience"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
																	
																</tr>	
															<?php $count++; } 
															}else{	?>
															<tr>
																<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
																<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
																<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
																<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>	
																<td><input id="txtE1" size="10"   class="form-control text-uppercase" name="txtE1"></td>
																														
															</tr>
															<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>8. How many working sites can be handled by the firm simultaneously?</td>
												<td><input type="text" id="working_sites" name="working_sites" value="<?php echo $working_sites; ?>" class="form-control" /></td>
												<td></td>								  
											</tr>
											<tr>										
												<td class="text-center" colspan="4">
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
												</td>									
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">			
											<tr>
												<td width="25%">9. Whether the firm is prepared to execute the job strictly in conformity with the regulations and maintain a high standard of work?</td>
												<td width="25%">
													<label class="radio-inline"><input type="radio" name="is_firm_pre_execute" class="is_firm_pre_execute" value="Y"  <?php if(isset($is_firm_pre_execute) && $is_firm_pre_execute=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_firm_pre_execute" name="is_firm_pre_execute"  value="N"  <?php if(isset($is_firm_pre_execute) && ($is_firm_pre_execute=='N' || $is_firm_pre_execute=='')) echo 'checked'; ?>/> No</label>
												</td>
												<td width="25%">10. Whether the firm is prepared to accept full responsibility for the work done and is prepared to clarify any controversial issue, if required?</td>
												<td width="25%">
													<label class="radio-inline"><input type="radio" name="is_firm_pre_accept" class="is_firm_pre_accept" value="Y"  <?php if(isset($is_firm_pre_accept) && $is_firm_pre_accept=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_firm_pre_accept" name="is_firm_pre_accept"  value="N"  <?php if(isset($is_firm_pre_accept) && ($is_firm_pre_accept=='N' || $is_firm_pre_accept=='')) echo 'checked'; ?>/> No</label>
												</td>	
											</tr>
											<tr>
												<td >11. Whether the firm is in a position to supply materials to required specification with proper test certificates if asked for?</td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_firm_supply_mat" class="is_firm_supply_mat" value="Y"  <?php if(isset($is_firm_supply_mat) && $is_firm_supply_mat=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_firm_supply_mat" name="is_firm_supply_mat"  value="N"  <?php if(isset($is_firm_supply_mat) && ($is_firm_supply_mat=='N' || $is_firm_supply_mat=='')) echo 'checked'; ?>/> No</label>
												</td>	
											</tr>
											<tr>
												<td>12. Whether the firm has an internal quality control system of their own?  </td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_firm_internal" class="is_firm_internal" value="Y"  <?php if(isset($is_firm_internal) && $is_firm_internal=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_firm_internal" name="is_firm_internal"  value="N"  <?php if(isset($is_firm_internal) && ($is_firm_internal=='N' || $is_firm_internal=='')) echo 'checked'; ?>/> No</label>
												</td>	
												<td>If so, give details :</td>
												<td><textarea  name="firm_int_qua_det" class="form-control text-uppercase" validate="textarea" ><?php echo $firm_int_qua_det; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">13. List of welders employed with copies of current certificate issued by a Competent Authority under the Indian Boiler Regulations, 1950. :
													<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="40%">Sl. No.</th>
															<th width="60%">Name</th>
														</tr>
														</thead>
														<?php
															$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
															$num2 = $part2->num_rows;
															if($num2>0){
															  $count=1;
															  while($row_2=$part2->fetch_array()){	?>
																<tr>
																	<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																	<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name2"]; ?>" validate="letters" name="textB<?php echo $count;?>" size="10"></td>
																</tr>	
															<?php $count++; } 
																}else{	?>
																<tr>
																	<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
																	<td><input id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
																</tr>
															<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>Date:</td>
												<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
												<td>Signature of the Authorised Signatory of the firm</td>
												<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
	//$('input[name=is_recogn_req]').on('change', function(){
		
	$("input:radio[name='is_firm_approved']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#firm_app_det").removeAttr("readonly","readonly");
		}else{
			$("#firm_app_det").attr("readonly","readonly");
			$("#firm_app_det").val("");
		}
	});
	
	$("input:radio[name='is_recogn_req']").change(function(){
		var is_recogn_req_value = $(this).val();
		if(is_recogn_req_value=="Y"){
			$("#firm_app_details").removeAttr("readonly","readonly");
		}else{
			$("#firm_app_details").attr("readonly","readonly");
			$("#firm_app_details").val("");
		}
	});
	
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
</script>