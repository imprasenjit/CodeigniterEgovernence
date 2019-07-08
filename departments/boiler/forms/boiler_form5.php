<?php require_once "../../requires/login_session.php"; 
$dept="boiler";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";
    
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");

	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$is_copy_report=$results["is_copy_report"];$is_firm=$results["is_firm"];
		$is_firm_prepared=$results["is_firm_prepared"];$is_internal_quality=$results["is_internal_quality"];$numeric_power_stn=$results["numeric_power_stn"];$is_conservant=$results["is_conservant"];$is_instruments=$results["is_instruments"];$testing=$results["testing"];$is_recording=$results["is_recording"];$is_internal_quality_details=$results["is_internal_quality_details"];
				
		if(!empty($results["class_applied"])){
			$class_applied=json_decode($results["class_applied"]);
			$class_applied_a=$class_applied->a;
		}else{
			$class_applied_a="";
		}
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$is_copy_report=$results["is_copy_report"];$is_firm=$results["is_firm"];
			$is_firm_prepared=$results["is_firm_prepared"];$is_internal_quality=$results["is_internal_quality"];$numeric_power_stn=$results["numeric_power_stn"];$is_conservant=$results["is_conservant"];$is_instruments=$results["is_instruments"];$testing=$results["testing"];$is_recording=$results["is_recording"];$is_internal_quality_details=$results["is_internal_quality_details"];
				
			if(!empty($results["class_applied"])){
				$class_applied=json_decode($results["class_applied"]);
				$class_applied_a=$class_applied->a;
			}else{
				$class_applied_a="";
			}	
		}else{
			$form_id="";
			$is_copy_report="";$is_firm="";$is_firm_prepared="";$is_internal_quality="";$numeric_power_stn="";$is_conservant="";$is_instruments="";$testing="";$is_recording="";$is_sup_materials="";$non_destructive_testing="";$directorate_info="";$is_internal_quality_details="";$type="";$class_applied_a="";
		}	
	}
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
						   <div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table  class="table table-responsive">									
											<tr>
												<td width="25%">1. Name of the Firm :</td>
												<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
											   <td colspan="4">2. Address of the workshop :</td>
											</tr>
											<tr>
													<td width="25%">Street Name1 :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name1; ?>"></td>
													<td width="25%">Street Name2 :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name2; ?>" ></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
												
											</tr>
											<tr>
												 <td colspan="4">3. Address for communication :</td>
											</tr>
											<tr>
													<td width="25%">Street Name1 :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $b_street_name1; ?>"></td>
													<td width="25%">Street Name2 :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $b_street_name2; ?>" ></td>
										   </tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_pincode; ?>"></td>
												
										   </tr>
											<tr>
												<td colspan="3">4.(i) Type of jobs executed by the firm earlier,with special reference to their maximum working pressure,temperature and the materials involved with the documentary evidence :</td>
												<td>Upload later in upload section</td>
											</tr>
											<tr>
												<td>4.(ii) Classification applied for : </td>
													<td>
														<select name="class_applied[a]" required="required" class="form-control text-uppercase">
															<option value="">Choose a class</option>
															<option value="L" <?php if($class_applied_a=="L") echo "selected"; ?>>Class –III : Less than boiler pressure 17.5 Kg/cm2.</option>
															<option value="A" <?php if($class_applied_a=="A") echo "selected"; ?>>Class –II : Above boiler pressure 17.5 Kg/cm2, but less than 40 Kg/ cm2.</option>
															<option value="AB" <?php if($class_applied_a=="AB") echo "selected"; ?>>Class - I : Above boiler pressure 40 Kg/ Cm2, but less than 100 Kg/ cm2.</option>
															<option value="P" <?php if($class_applied_a=="P") echo "selected"; ?>>Special Class : Above boiler pressure 100 Kg/ cm2.</option>
														</select>
													</td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="3">5.(i)Whether having rectifier/generator, grinder tools and tackles, dye penetrant kit, expander and measuring instruments or any other tools and tackles NDT facilities, heat treatment etc. :</td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_copy_report" class="is_copy_report" value="Y"  <?php if(isset($is_copy_report) && $is_copy_report=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_copy_report" name="is_copy_report"  value="N"  <?php if(isset($is_copy_report) && ($is_copy_report=='N' || $is_copy_report=='')) echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
												<td colspan="4">6. Details list of technical personnel & supervisory staff with qualification and experience :
													<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="10%">Sl. No.</th>
															<th width="20%">Details of technical personnel</th>
															<th width="20">Details of Supervisory Staff</th>
															<th width="20%">Qualification</th>
															<th width="20%">Experience</th>
														</tr>
														</thead>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["details_technical"]; ?>" validate="specialChar" name="txtB<?php echo $count;?>" size="5"></td>
															<td><input value="<?php echo $row_1["details_supervisory"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="5" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="5" name="txtD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["experience"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase" size="5" name="txtE<?php echo $count;?>"></td>
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
														<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
														<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
														<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">7. List of permanent welders with their experience(enclosed welders certificate issued under IBR):<br/>
													<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center" >
														<tr>
															<th width="5%">Sl.No.</th>
															<th width="25%">Name</th>
															<th width="25%">Experience</th>
														</tr>
														<?php
															$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
															$num2 = $part2->num_rows;
															if($num2>0){
																$count=1;
																while($row_2=$part2->fetch_array()){	?>
																<tr>
																	<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_2["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
																	<td><input id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name1"]; ?>" name="txxtB<?php echo $count;?>" size="10"></td>
																	<td><input type="text" value="<?php echo $row_2["experience"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txxtC<?php echo $count;?>"></td>
																	
																</tr>	
															<?php $count++; } 
															}else{	?>
															<tr>
																<td><input type="text"  readonly value="1" id="txxtA1" size="1"  class="form-control text-uppercase"  name="txxtA1"></td>
																<td><input type="text" id="txxtB1" size="10" class="form-control text-uppercase" name="txxtB1"></td>
																<td><input type="text" id="txxtC1" size="10" class="form-control text-uppercase" name="txxtC1"></td>
																
															</tr>
															<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px">
														<button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
														<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
														<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
													</div>
												</td>
											</tr>
											<tr>
											   <td>8.Whether the firm is prepared to execute the job strictly in conformity with the IBR and maintain a high standard of work: 
											   </td>
												<td>
														<label class="radio-inline"><input type="radio" name="is_firm" class="is_firm" value="Y"  <?php if(isset($is_firm) && $is_firm=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
														<label class="radio-inline"><input type="radio" class="is_firm" name="is_firm"  value="N"  <?php if(isset($is_firm) && ($is_firm=='N' || $is_firm=='')) echo 'checked'; ?>/> No</label>
												</td>
											   <td>9.Whether the firm is prepared to accept full responsibilty for the work done and is prepared to clarify any controversial issue,if required?:</td> 
											   <td>
														<label class="radio-inline"><input type="radio" name="is_firm_prepared" class="is_firm_prepared" value="Y"  <?php if(isset($is_firm_prepared) && $is_firm_prepared=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
														<label class="radio-inline"><input type="radio" class="is_firm_prepared" name="is_firm_prepared"  value="N"  <?php if(isset($is_firm_prepared) && ($is_firm_prepared=='N' || $is_firm_prepared=='')) echo 'checked'; ?>/> No</label>
												</td>
											</tr>
										   <tr>
											   <td>10.Whether the firm has an internal quality control system of their own? :</td>
												<td><label class="radio-inline"><input type="radio" name="is_internal_quality" class="is_internal_quality" value="Y"  <?php if(isset($is_internal_quality) && $is_internal_quality=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="is_internal_quality"  value="N"  name="is_internal_quality" <?php if(isset($is_internal_quality) && ($is_internal_quality=='N' || $is_internal_quality=='')) echo 'checked'; ?>/> No</label></td>
												<td>If so,give details :</td>
												<td><input type="text" class="form-control text-uppercase" name="is_internal_quality_details" id="is_internal_quality_details"  value="<?php echo $is_internal_quality_details;?>"></td>
											</tr>
											<tr>
											   <td >11. Details of power sanction : <br/>Numeric(in <b> KV</b>) :</td>
												<td><input type="text" class="form-control text-uppercase" name="numeric_power_stn"   value="<?php echo $numeric_power_stn;?>"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
											   <td>12.Whether the firm is conservant with Boilers Act,1923 and Indian Boiler Regulation,1950 :</td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_conservant" class="is_conservant" value="Y"  <?php if(isset($is_conservant) && $is_conservant=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_conservant" name="is_conservant"  value="N"  <?php if(isset($is_conservant) && ($is_conservant=='N' || $is_conservant=='')) echo 'checked'; ?>/> No</label>
												</td>
											   <td>13.Whether the aforesaid instruments are caliberated periodically.If so,give details :</td>
												<td>
														<label class="radio-inline"><input type="radio" name="is_instruments" class="is_instruments" value="Y"  <?php if(isset($is_instruments) && $is_instruments=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
														<label class="radio-inline"><input type="radio" class="is_instruments" name="is_instruments"  value="N"  <?php if(isset($is_instruments) && ($is_instruments=='N' || $is_instruments=='')) echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
											   <td>14.Details of testing facilities available:</td>
												<td><input type="text" class="form-control"  name="testing" value="<?php echo  $testing; ?>"></td>
											   <td>15.Whether the recording system of documents,Data storing,processing etc has been computerized with Internet:</td>
												  <td>
													<label class="radio-inline"><input type="radio" name="is_recording" class="is_recording" value="Y"  <?php if(isset($is_recording) && $is_recording=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
													<label class="radio-inline"><input type="radio" class="is_recording" name="is_recording"  value="N"  <?php if(isset($is_recording) && ($is_recording=='N' || $is_recording=='')) echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
												<td colspan="2" >Signature and Seal: <strong><?php echo strtoupper($key_person)?></strong><br/>
												Email ID: <label><?php echo strtoupper($email)?></strong>
												</td>
											</tr>
											<tr>										
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save &amp; Next</button>
												</td>									
											</tr>
										</table>
									</form>
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
	
	$('#is_internal_quality_details').attr('readonly','readonly');
	<?php if($is_internal_quality == 'Y') echo "$('#is_internal_quality_details').removeAttr('readonly','readonly');"; ?>
		
	$('.is_internal_quality').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_internal_quality_details').removeAttr('readonly','readonly');
		}else{
			$('#is_internal_quality_details').attr('readonly','readonly');
			$('#is_internal_quality_details').val('');
		}			
	});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
</script>