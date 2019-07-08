<?php  require_once "../../requires/login_session.php"; 
$dept="boiler";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		$inspector_places=$results["inspector_places"];$is_repairs=$results["is_repairs"];$is_fabricator=$results["is_fabricator"];$testing_fabrication=$results["testing_fabrication"];$job_significant=$results["job_significant"];$class_applied=$results["class_applied"];
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			$inspector_places=$results["inspector_places"];$is_repairs=$results["is_repairs"];$is_fabricator=$results["is_fabricator"];$testing_fabrication=$results["testing_fabrication"];$job_significant=$results["job_significant"];$class_applied=$results["class_applied"];
				
		}else{
			$form_id=""; 
			$inspector_places="";$is_repairs="";$is_fabricator="";$testing_fabrication="";$job_significant="";$class_applied="";	
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
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table  class="table table-responsive">									
											<tr>
												<td width="25%">1. Name of the fabricator:</td>
												<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">2. Full address of the fabricator :</td>
											</tr>
											<tr>
												<td width="25%">Street name 1 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
												<td width="25%">Street name 2 :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td width="25%">Village/Town :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
												<td width="25%">District :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td width="25%">Pin code :</td>
												<td width="25%"><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
												<td width="25%">Mobile No. :</td>
												<td width="25%"><input  type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
											</tr>
											<tr>
												<td width="25%">E-mail id:</td>
												<td width="25%"><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td>3. Places of visit to be paid by the Inspector other than owner's premises </td>
												<td><textarea  name="inspector_places"  class="form-control text-uppercase" maxlength="255"><?php echo $inspector_places; ?></textarea></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
											   <td width="25%">4.Whether copy of the report on repairs/fabrications/renewals or letter of approval of the drawing steam and feed pipe lines are furnished. :</td>
											   <td width="25%">
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_repairs=="Y" || $is_repairs=="") echo "checked"; ?> id="inlineRadio1" name="is_repairs"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_repairs=="N") echo "checked"; ?> id="inlineRadio1" name="is_repairs"> No </label>
												</td>
											   <td width="25%">5.Whether the fabricator prepared to supply materials covered by proper test certificates or to carry out necessary tests, if required.</td>
											   <td width="25%">
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_fabricator=="Y" || $is_fabricator=="") echo "checked"; ?> id="inlineRadio2" name="is_fabricator"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_fabricator=="N") echo "checked"; ?> id="inlineRadio2" name="is_fabricator"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4">6.Details of machines, tools and tackles to be used for the particular job. :
													<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="10%">Sl. No.</th>
															<th width="30%">Details of machines</th>
															<th width="30%">tools</th>
															<th width="30">tackles</th>
														</tr>
														</thead> 
														<?php
															$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
															$num=$part1->num_rows;
															if($num>0){
															  $count=1;
															  while($row_1=$part1->fetch_array()){	?>
																<tr>
																	<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																	<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["details_of_machines"]; ?>" validate="specialChar" name="txtB<?php echo $count;?>" size="10"></td>
																	<td><input value="<?php echo $row_1["tools"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																	<td><input value="<?php echo $row_1["tackles"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																</tr>	
															<?php $count++; } 
															}else{	?>
															<tr>
																<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
																<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
																<td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>	
																<td><input id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>	
															</tr>
														<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">7.Name of fitters, riveters, slotters and other working personnel to be engaged in the particular job. :
													<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="10%">Sl. No.</th>
															<th width="25%">Name of fitters</th>
															<th width="25%">Name of riveters</th>
															<th width="20">Name of slotters</th>
															<th width="20">Others working personnel</th>
														</tr>
														</thead> 
														<?php
															$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
															$num2=$part2->num_rows;
															if($num2>0){
															  $count=1;
															  while($row_2=$part2->fetch_array()){	?>
																<tr>
																	<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																	<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name_of_fitters"]; ?>" validate="specialChar" name="textB<?php echo $count;?>" size="10"></td>
																	<td><input value="<?php echo $row_2["name_of_riveters"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
																	<td><input value="<?php echo $row_2["name_of_slotters"]; ?>" id="textD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
																	<td><input value="<?php echo $row_2["others_working_personnel"]; ?>" id="textE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textE<?php echo $count;?>"></td>
																</tr>	
															<?php $count++; } 
															}else{	?>
															<tr>
																<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
																<td><input id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
																<td><input id="textC1" size="10" class="form-control text-uppercase" name="textC1"></td>	
																<td><input id="textD1" size="10" class="form-control text-uppercase" name="textD1"></td>
																<td><input id="textE1" size="10"   class="form-control text-uppercase"name="textE1"></td>
															</tr>
														<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
											   <td colspan="4">8.Experience of fitters, riveters, slotters and other working personnel to be engaged in the particular job.
												 <table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="25%">Experience of fitters</th>
														<th width="25%">Experience of riveters</th>
														<th width="20">Experience of slotters</th>
														<th width="20">Other working personnel</th>
													</tr>
													</thead> 
													<?php
														$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
														$num3=$part3->num_rows;
														if($num3>0){
														  $count=1;
														  while($row_3=$part3->fetch_array()){	?>
															<tr>
																<td><input readonly id="tcA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="tcA<?php echo $count;?>" size="1"></td>
																<td><input id="tcB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["exp_of_fitters"]; ?>"  name="tcB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_3["exp_of_riveters"]; ?>" id="tcC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="tcC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_3["exp_of_slotters"]; ?>" id="tcD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="tcD<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_3["others_working"]; ?>" id="tcE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="tcE<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tcA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tcA1"></td>
															<td><input id="tcB1" size="10" validate="letters" class="form-control text-uppercase" name="tcB1"></td>
															<td><input id="tcC1" size="10" class="form-control text-uppercase" name="tcC1"></td>	
															<td><input id="tcD1" size="10" class="form-control text-uppercase" name="tcD1"></td>
													  <td><input id="tcE1" size="10"   class="form-control text-uppercase"name="tcE1"></td>
													  </tr>
													<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
												</td>
											</tr>
											<tr>
											   <td colspan="4">9. Name, technical qualifications (if any) experience of the supervisor, who will supervise the particular job.
												 <table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="30%">Name</th>
														<th width="30%">Qualifications</th>
														<th width="30%">Experience</th>
													</tr>
													</thead> 
													<?php
														$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
														$num4=$part4->num_rows;
														if($num4>0){
														  $count=1;
														  while($row_4=$part4->fetch_array()){	?>
															<tr>
																<td><input readonly id="tbA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="tbA<?php echo $count;?>" size="1"></td>
																<td><input id="tbB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["name1"]; ?>" validate="specialChar" name="tbB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_4["qualifications1"]; ?>" id="tbC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="tbC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_4["experience1"]; ?>" id="tbD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="tbD<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tbA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tbA1"></td>
															<td><input id="tbB1" size="10" validate="letters" class="form-control text-uppercase" name="tbB1"></td>
															<td><input id="tbC1" size="10" class="form-control text-uppercase" name="tbC1"></td>	
															<td><input id="tbD1" size="10" class="form-control text-uppercase" name="tbD1"></td>
													</tr>
														<?php } ?>														
												</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">10. Name and Address of the welders to be engaged in the job.:
													<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="10%">Sl. No.</th>
															<th width="40%">Name</th>
															<th width="50%">Address</th>
														</tr>
														</thead> 
														<?php
															$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
															$num5=$part5->num_rows;
															if($num5>0){
															  $count=1;
															  while($row_5=$part5->fetch_array()){	?>
																<tr>
																	<td><input readonly id="tdA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="tdA<?php echo $count;?>" size="1"></td>
																	<td><input id="tdB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["name"]; ?>" validate="specialChar" name="tdB<?php echo $count;?>" size="10"></td>
																	<td><input value="<?php echo $row_5["address"]; ?>" id="tdC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="tdC<?php echo $count;?>"></td>
																</tr>	
															<?php $count++; } 
															}else{	?>
														<tr>
																<td><input value="1" id="tdA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tdA1"></td>
																<td><input id="tdB1" size="10" validate="letters" class="form-control text-uppercase" name="tdB1"></td>
																<td><input id="tdC1" size="10" class="form-control text-uppercase" name="tdC1"></td>
																
														</tr>
														<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">11. Details of equipment necessary for heat treatment of the repair, fabrication/renewal (if necessary) for the particular job.:
													<table name="objectTable6" id="objectTable6" class="table table-responsive text-center">
														<thead>
														<tr>
															<th width="10%">Sl. No.</th>
															<th width="40%">Name</th>
															<th width="50%">Details</th>
															
														</tr>
														</thead> 
														<?php
															$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
															$num6=$part6->num_rows;
															if($num6>0){
															  $count=1;
															  while($row_6=$part6->fetch_array()){	?>
																<tr>
																	<td><input readonly id="teA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="teA<?php echo $count;?>" size="1"></td>
																	<td><input id="teB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["name2"]; ?>" validate="specialChar" name="teB<?php echo $count;?>" size="10"></td>
																	<td><input value="<?php echo $row_6["details"]; ?>" id="teC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="teC<?php echo $count;?>"></td>
																</tr>
															<?php $count++; } 
															}else{	?>
														<tr>
																<td><input value="1" id="teA1" readonly="readonly" size="10" class="form-control text-uppercase" name="teA1"></td>
																<td><input id="teB1" size="10" validate="letters" class="form-control text-uppercase" name="teB1"></td>
																<td><input id="teC1" size="10" class="form-control text-uppercase" name="teC1"></td>	
														</tr>
														<?php } ?>														
													</table>
														<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore6()" value="">Add More</button>
														<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
														<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">12. Details of Non-destructive testing of repair/fabrication/renewal, if necessary. :</td>
												<td><textarea class="form-control text-uppercase" name="testing_fabrication"> <?php echo  $testing_fabrication; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="2">13. Any other information relevant to the job considered significant to the Directorate. :</td>
												<td><textarea class="form-control text-uppercase" name="job_significant"> <?php echo  $job_significant; ?></textarea></td>
											</tr>
											<tr>
												<td>14. Classification applied for : </td>
												<td>
													<select name="class_applied" class="form-control text-uppercase" required="required">
														<option value="">Please Select</option>
														<option <?php if($class_applied==1) echo "selected"; ?> value="1">Class – III : Less than boiler pressure 17.5 Kg/cm2.</option>
														<option <?php if($class_applied==2) echo "selected"; ?> value="2">Class – II : Above boiler pressure 17.5 Kg/cm2, but less than 40 Kg/ cm2.</option>
														<option <?php if($class_applied==3) echo "selected"; ?> value="3">Class - I : Above boiler pressure 40 Kg/ Cm2, but less than 100 Kg/ cm2.</option>
														<option <?php if($class_applied==4) echo "selected"; ?> value="4">Special Class : Above boiler pressure 100 Kg/ cm2.</option>
													</select>
												</td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
												Signature of Repairer/Fabricator : <strong><?php echo strtoupper($key_person)?></strong>
												</td>										
												<td colspan="2" align="right">Signature of the owner: <strong><?php echo strtoupper($key_person)?></strong><br/>
												Name: <label><?php echo strtoupper($key_person)?></strong>
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
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
	
</script>