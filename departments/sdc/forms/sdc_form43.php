<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="43";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	

include "save_form3.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$license_no=$results["license_no"];$license_date=$results["license_date"];$staff_manuf=$results["staff_manuf"];
		}else{
			$form_id="";$auth_person="";$license_no="";$license_date="";$staff_manuf="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$license_no=$results["license_no"];$license_date=$results["license_date"];$staff_manuf=$results["staff_manuf"];
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4">1.I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of M/s&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply for the grant of licence number&nbsp;<input type="text"  class="form-control text-uppercase" name="license_no" value="<?php echo $license_no;?>">&nbsp;dated&nbsp;<input type="text"  class="dob form-control text-uppercase" name="license_date" value="<?php echo $license_date;?>">&nbsp;to operate a Blood Bank, for processing of whole blood and/or* for preparation of its components on the premises situated at&nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>">.</td>
											</tr>
											<tr>
												<td>2.  Name(s) of the item(s) :</td>
											</tr>
											<tr>
												<td colspan="4"><table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
													<tr>
														<th width="30%">Slno</th>
														<th width="70%">Name</th>
													</tr>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
																<td><input id="txttB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="specialChar" name="txttB<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txttA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txttA1"></td>
															<td><input id="txttB1" size="10" class="form-control text-uppercase" name="txttB1"></td>
														</tr>
														<?php }?>												
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
												<td colspan="4">3. The name(s), qualification and experience of competent technical staff are as under :
												<table name="objectTable2" id="objectTable2" class="table table-responsive text-center" >
													<tr>
														<th width="5%">Slno</th>
														<th width="30%">Name</th>
														<th width="20%">Experience</th>
														<th width="25%">Qualifications</th>
														<th width="40%">Designation<span class="mandatory_field">*</span></th>
													</tr>
													<?php
														$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
														$num2 = $part2->num_rows;
														if($num2>0){
														  $count=1;
														  while($row_2=$part2->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>	
																<td><input value="<?php echo $row_2["qualification"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_2["experience"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><select required="required" id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
																<option value='' >Select unit</option>
																<option <?php if($row_2["responsible"]=="MO") echo "selected"; ?> value='MO' >Medical Officer</option>
																<option <?php if($row_2["responsible"]=="TS") echo "selected"; ?> value='TS' >Technical Supervisor</option>
																<option <?php if($row_2["responsible"]=="RN") echo "selected"; ?> value='RN' >Registered Nurse</option>
																<option <?php if($row_2["responsible"]=="BB") echo "selected"; ?> value='BB' >Blood Bank Technician</option>
																</select>									
																</td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
															<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>	
															<td><select required="required" id="txtE1" name="txtE1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='MO' >Medical Officer</option>
																<option value='TS' >Technical Supervisor</option>
																<option value='RN' >Registered Nurse</option>
																<option value='BBT' >Blood Bank Technician</option>
															</select></td>
														</tr>
														<?php }?>												
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
												<td width="25%">4. The premises and plant are ready for inspection/will be ready for inspection on :</td>
												<td width="25%"><input type="text"  class="dob form-control text-uppercase" name="staff_manuf" value="<?php echo $staff_manuf;?>" ></td>
												<td width="25%">&nbsp;</td>
												<td width="25%">&nbsp;</td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>
												<td>Signature :</td>
												<td><label><?php echo strtoupper($key_person)?></label></td>	
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
												<td>Designation :</td>
												<td><label><?php echo strtoupper($status_applicant)?></label></td>
											</tr>	  
											<tr>
												<td></td>
												<td class="text-center" colspan="2">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success">Save and Next</button>
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
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
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
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>