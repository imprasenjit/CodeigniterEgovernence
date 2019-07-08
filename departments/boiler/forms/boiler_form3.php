<?php  require_once "../../requires/login_session.php"; 
$dept="boiler";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");

	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$places_visit=$results["places_visit"];
		$is_copy_report=$results["is_copy_report"];$is_sup_materials=$results["is_sup_materials"];$non_destructive_testing=$results["non_destructive_testing"];$directorate_info=$results["directorate_info"];		
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$places_visit=$results["places_visit"];
			$is_copy_report=$results["is_copy_report"];$is_sup_materials=$results["is_sup_materials"];$non_destructive_testing=$results["non_destructive_testing"];$directorate_info=$results["directorate_info"];		
		}else{
			$form_id="";
			$places_visit="";	
			$is_copy_report="";$is_sup_materials="";$non_destructive_testing="";$directorate_info="";		
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
											<td width="25%">1. Name of the repairer :</td>
											<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">2. Full address of the repairer :</td>
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
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id :</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" validate="jsonObj"value="<?php echo  $email; ?>"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
										   <td>3. Places of visit to be paid by the Inspector other than owner's premises :</td>
										   
											<td><input type="text" class="form-control text-uppercase"  name="places_visit" value="<?php echo  $places_visit; ?>"></td>
										</tr>
										<tr>
										   <td>4. Whether copy of the report on repairs/fabrications/renewals or letter of approval of the drawing steam and feed pipe lines are furnished. :</td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_copy_report" class="is_copy_report" value="Y"  <?php if(isset($is_copy_report) && $is_copy_report=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" class="is_copy_report" name="is_copy_report"  value="N"  <?php if(isset($is_copy_report) && ($is_copy_report=='N' || $is_copy_report=='')) echo 'checked'; ?>/> No</label>
											</td>
											<td>5. Whether the repairer prepared to supply materials covered by proper test certificates or to carry out necessary tests, if required. :</td>
										   <td>
												<label class="radio-inline"><input type="radio" name="is_sup_materials" class="is_sup_materials" value="Y"  <?php if(isset($is_sup_materials) && $is_sup_materials=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" class="is_sup_materials" name="is_sup_materials"  value="N"  <?php if(isset($is_sup_materials) && ($is_sup_materials=='N' || $is_sup_materials=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="4">6. Details of machines, tools and tackles to be used for the particular job. :
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
														<tr>
															<th width="5%">Sl. No.</th>
															<th width="35%">Details of machines</th>
															<th width="30">Tools</th>
															<th width="30%">Tackles</th>
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
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["details_machine"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["tools"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["tackles"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>	
														</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
												</div>
											</td>
										</tr>
										<tr>
											<td colspan="4">7. Name and Experience of fitters, riveters,slotters and other working personnel to be engaged in the particular job. :
												<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="5%">Sl. No.</th>
														<th width="20%">Name</th>
														<th width="20">Experience of Fitters</th>
														<th width="20%">Riveters</th>
														<th width="20%">Slotters</th>
														<th width="15%">Other Working Personnel</th>
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
																<td><input value="<?php echo $row_2["experience2"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_2["riveters"]; ?>" id="textD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_2["slotters"]; ?>" id="textE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textE<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_2["other_working_per"]; ?>" id="textF<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textF<?php echo $count;?>"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
															<td><input id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
															<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>	
															<td><input id="textD1" size="10"   class="form-control text-uppercase" name="textD1"></td>
															<td><input id="textE1" size="10"   class="form-control text-uppercase" name="textE1"></td>
															<td><input id="textF1" size="10"   class="form-control text-uppercase" name="textF1"></td>														
														</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">8. Name, technical qualifications (if any) & experience of the supervisor, who will supervise the particular job. :
												<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="5%">Sl. No.</th>
														<th width="35%">Name</th>
														<th width="30">Qualification</th>
														<th width="30%">Experience</th>
						
													</tr>
													</thead>
													<?php
														$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
														$num3 = $part3->num_rows;
														if($num3>0){
														  $count=1;
														  while($row_3=$part3->fetch_array()){	?>
															<tr>
																<td><input readonly id="txA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txA<?php echo $count;?>" size="1"></td>
																<td><input id="txB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name3"]; ?>" validate="letters" name="txB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_3["qualification3"]; ?>" id="txC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_3["experience3"]; ?>" id="txD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txD<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txA1"></td>
															<td><input id="txB1" size="10" validate="letters" class="form-control text-uppercase" name="txB1"></td>
															<td><input id="txC1" size="10"   class="form-control text-uppercase" name="txC1"></td>	
															<td><input id="txD1" size="10"   class="form-control text-uppercase" name="txD1"></td>
																													
														</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">9. Name and Address of the welders to be engaged in the job. :
												<table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="40%">Name</th>
														<th width="50">Address</th>
													
													</tr>
													</thead>
													<?php
														$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
														$num4 = $part4->num_rows;
														if($num4>0){
														  $count=1;
														  while($row_4=$part4->fetch_array()){	?>
															<tr>
																<td><input readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
																<td><input id="txttB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["name4"]; ?>" validate="letters" name="txttB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_4["address4"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txttC<?php echo $count;?>"></td>
																
																
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txttA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txttA1"></td>
														<td><input id="txttB1" size="10" validate="letters" class="form-control text-uppercase" name="txttB1"></td>
														<td><input id="txttC1" size="10"   class="form-control text-uppercase" name="txttC1"></td>	
																											
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">10. Details of equipment necessary for heat treatment of the repair, fabrication/renewal (if necessary) for the particular job. :
												<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="40%">Name</th>
														<th width="50">Details</th>
													
													</tr>
													</thead>
													<?php
													$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
													$num5 = $part5->num_rows;
													if($num5>0){
													  $count=1;
													  while($row_5=$part5->fetch_array()){	?>
														<tr>
															<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
															<td><input id="ttxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["name_equip"]; ?>" validate="letters" name="ttxtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_5["det_equip"]; ?>" id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="ttxtC<?php echo $count;?>"></td>
															
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="ttxtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="ttxtA1"></td>
														<td><input id="ttxtB1" size="10" validate="letters" class="form-control text-uppercase" name="ttxtB1"></td>
														<td><input id="ttxtC1" size="10"   class="form-control text-uppercase" name="ttxtC1"></td>	
																											
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
											</td>
										</tr>
								
										<tr>
											<td >11. Details of Non-destructive testing of repair/fabrication/renewal, if necessary. :</td>
											<td><textarea class="form-control text-uppercase" name="non_destructive_testing"> <?php echo  $non_destructive_testing; ?></textarea></td>
											<td >12. Any other information relevant to the job considered significant to the Directorate. :</td>
											<td><textarea class="form-control text-uppercase" name="directorate_info"> <?php echo  $directorate_info; ?></textarea></td>
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
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
											</td>									
										</tr>
									</table>
								</form>
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
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$(document).ready(function(){
			$("#heating_value").on("change", function(){	
				$('input[id="is_fabrication_n"]').prop('checked', true);
				var putValue = $(this).val()
				if(putValue > 3000){
				var calValue = putValue-3000 ;
				var calValue2 = Math.floor(calValue/200);
				var calValue3 = Math.floor(calValue2 * 600);
				var calValue4 = Math.floor(calValue3 + 21600);
				$('#reg_fees').val(calValue4);
				
				
				}
			});
			$('input[id="boiler_type_a"]').on('change', function(){
				if($(this).val() == 'U'){
					$('input[value="WT"]').prop('checked', true);
					$('input[id="boiler_type_b"]').attr('disabled', 'disabled');
				}else{
					$('input[value="WT"]').prop('checked', '');
					$('input[id="boiler_type_b"]').attr('disabled', false);
				}
			});
			$('input[name="heating_value"]').on('change', function(){
				//alert(typeof $(this).val());
				if($(this).val() <= 10){
					$('select[name="heating_select"] option[value="2"]').prop('selected', true);
					 $('#reg_fees').val("1800");
					 $('#heating').val("2");
				}else if($(this).val() >= 11 && $(this).val() < 30){
					$('select[name="heating_select"] option[value="3"]').prop('selected', true);
					$('#reg_fees').val("2400");
					$('#heating').val("3");					
				}else if($(this).val() >= 31 && $(this).val() <= 50){
					$('select[name="heating_select"] option[value="4"]').prop('selected', true);
					$('#reg_fees').val("2700");
					$('#heating').val("4");
				}else if($(this).val() >= 51 && $(this).val() <= 70){
					$('select[name="heating_select"] option[value="5"]').prop('selected', true);
					$('#reg_fees').val("3300");
					$('#heating').val("5");
				}else if($(this).val() >= 71 && $(this).val() <= 90){
					$('select[name="heating_select"] option[value="6"]').prop('selected', true);
					$('#reg_fees').val("3900");
					$('#heating').val("6");
				}else if($(this).val() >= 91 && $(this).val() <= 110){
					$('select[name="heating_select"] option[value="7"]').prop('selected', true);
					$('#reg_fees').val("4500");
					$('#heating').val("7");
				}else if($(this).val() >= 111 && $(this).val() <= 200){
					$('select[name="heating_select"] option[value="8"]').prop('selected', true);
					$('#reg_fees').val("5100");
					$('#heating').val("8");
				}else if($(this).val() >= 201 && $(this).val() <= 400){
					$('select[name="heating_select"] option[value="9"]').prop('selected', true);
					$('#reg_fees').val("5700");
					$('#heating').val("9");
				}else if($(this).val() >= 401 && $(this).val() <= 600){
					$('select[name="heating_select"] option[value="10"]').prop('selected', true);
					$('#reg_fees').val("6600");
					$('#heating').val("10");
				}else if($(this).val() >= 601 && $(this).val() <= 800){
					$('select[name="heating_select"] option[value="11"]').prop('selected', true);
					$('#reg_fees').val("7200");
					$('#heating').val("11");
				}else if($(this).val() >= 801 && $(this).val() <= 1000){
					$('select[name="heating_select"] option[value="12"]').prop('selected', true);
					$('#reg_fees').val("8100");
					$('#heating').val("12");
				}else if($(this).val() >= 1001 && $(this).val() <= 1200){
					$('select[name="heating_select"] option[value="13"]').prop('selected', true);
					$('#reg_fees').val("9600");
					$('#heating').val("13");
				}else if($(this).val() >= 1201 && $(this).val() <= 1400){
					$('select[name="heating_select"] option[value="14"]').prop('selected', true);
					$('#reg_fees').val("10800");
					$('#heating').val("14");
				}else if($(this).val() >= 1401 && $(this).val() <= 1600){
					$('select[name="heating_select"] option[value="15"]').prop('selected', true);
					$('#reg_fees').val("12600");
					$('#heating').val("15");
				}else if($(this).val() >= 1601 && $(this).val() <= 1800){
					$('select[name="heating_select"] option[value="16"]').prop('selected', true);
					$('#reg_fees').val("13500");
					$('#heating').val("16");
				}else if($(this).val() >= 1801 && $(this).val() <= 2000){
					$('select[name="heating_select"] option[value="17"]').prop('selected', true);
					$('#reg_fees').val("15000");
					$('#heating').val("17");
				}else if($(this).val() >= 2001 && $(this).val() <= 2200){
					$('select[name="heating_select"] option[value="18"]').prop('selected', true);
					$('#reg_fees').val("16200");
					$('#heating').val("18");
				}else if($(this).val() >= 2201 && $(this).val() <= 2400){
					$('select[name="heating_select"] option[value="19"]').prop('selected', true);
					$('#reg_fees').val("18000");
					$('#heating').val("19");
				}else if($(this).val() >= 2401 && $(this).val() <= 2600){
					$('select[name="heating_select"] option[value="20"]').prop('selected', true);
					$('#reg_fees').val("18900");
					$('#heating').val("20");
				}else if($(this).val() >= 2601 && $(this).val() <= 2800){
					$('select[name="heating_select"] option[value="21"]').prop('selected', true);
					$('#reg_fees').val("20400");
					$('#heating').val("21");
				}else if($(this).val() >= 2801 && $(this).val() <= 3000){
					$('select[name="heating_select"] option[value="22"]').prop('selected', true);
					$('#reg_fees').val("21600");
					$('#heating').val("22");			
				}else if($(this).val() >= '3001'){
					$('select[name="heating_select"] option[value="23"]').prop('selected', true);
					$('#heating').val("23");
				}else{
					$('#heating').val("1");
					$('select[name="heating_select"] option[value="1"]').prop('selected', true);
				}													
			});
			var oldValue=0, newValue=0;
			$('input[name="is_fabrication"]').on('change', function(){				
				if($(this).val() == 'Y'){
					if($('input[id="reg_fees"]').val() != ''){						
						oldValue2 = $('input[id="reg_fees"]').val()
						oldValue = $('input[id="reg_fees"]').val()
						newValue = oldValue*4;
						$('input[id="reg_fees"]').val(newValue);
					}	
				}else{
					$('input[id="reg_fees"]').val(oldValue2);
				}
				
			});
		});   
		$('input[name="boiler_owner"]').on('change', function(){
			if($(this).val() != 'undefined')
			$('input[name="signature"]').val($(this).val());			
		});
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
	
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
	
</script>