<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;
	
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$father_name=$results['father_name'];$name_of_person=$results['name_of_person'];$applicant_relation=$results['applicant_relation'];$class_of_license=$results['class_of_license'];$particular_details=$results['particular_details'];	
			
			if(!empty($results["present_addr"]))
			{
				$present_addr=json_decode($results["present_addr"]);
				$present_addr_st1=$present_addr->st1;;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;;$present_addr_email=$present_addr->email;
			}
			else
			{
				$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			}	
			
		}else{
			$form_id="";
			$father_name="";$name_of_person="";$applicant_relation="";$class_of_license="";$particular_details="";
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
			
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$father_name=$results['father_name'];$name_of_person=$results['name_of_person'];$applicant_relation=$results['applicant_relation'];$class_of_license=$results['class_of_license'];$particular_details=$results['particular_details'];	
		
		if(!empty($results["present_addr"]))
		{
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;;$present_addr_email=$present_addr->email;
		}
		else
		{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
										<td width="25%">1. Name of the Applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly" value="<?php echo $key_person; ?>" ></td>
										<td width="25%">2. Father’s Name:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="letters"  name="father_name" value="<?php echo $father_name; ?>" ></td>
									</tr>
									<tr>
									    <td colspan="4">3. Present Address:</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[st1]"  value="<?php echo $present_addr_st1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[st2]"  value="<?php echo $present_addr_st2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[vt]"  value="<?php echo $present_addr_vt; ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($present_addr_dist);?>"   name="present_addr[dist]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[pin]"  value="<?php echo $present_addr_pin; ?>" maxlength="6" validate="pincode"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="present_addr[mob]" value="<?php echo $present_addr_mob; ?>" maxlength="10" validate="mobileNumber"></td>
									</tr>
									<tr>
										<td>Email Id:</td>
										<td><input type="email" class="form-control" name="present_addr[email]" validate="jsonObj" value="<?php echo  $present_addr_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">4. Permanent Address:</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
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
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
										<td>5. Name of the person or firm on whose favour the license is sought:</td>
										<td><input type="text" class="form-control text-uppercase" name="name_of_person"  value="<?php echo  $name_of_person; ?>"></td>
										<td>6. Relationship of the applicant with the person or firm referred to in column 5 above and the capacity to file the application:</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_relation"  value="<?php echo  $applicant_relation; ?>"></td>										
									</tr>
									<tr>
										<td colspan="4">7. Business Address of the person of the firm referred to in column 5 above.</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_street_name2; ?>" ></td>
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
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_landline_std." - ".$b_landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $b_email; ?>"></td>
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
										<td colspan="4">8. In case of partnership, names and detail particulars of the partners (additional sheets may be annexed if necessary)</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="25">Name</th>
													<th width="30%">Permanent Address</th>
													<th width="15%">Age</th>
													<th width="25">Details of interest</th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["name"]; ?>" name="txtB<?php echo $count;?>" size="20" validate="letters"></td>
														<td><input type="text" value="<?php echo $row_1["permanent_address"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>			
														<td><input type="text" value="<?php echo $row_1["age"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"  validate="onlyNumbers"></td>
														<td><input type="text" value="<?php echo $row_1["detail"]; ?>" id="txtE<?php echo $count;?>"  name="txtE<?php echo $count;?>" class="form-control text-uppercase">
														</td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text" readonly value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input type="text" id="txtB1" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
														<td><input type="text" id="txtC1"  title="No special characters are allowed except Dot"  class="form-control text-uppercase" name="txtC1"></td>					
														<td><input type="text" id="txtD1" class="form-control text-uppercase" name="txtD1" validate="onlyNumbers"></td>
														<td><input type="text" id="txtE1" class="form-control text-uppercase"  name="txtE1"></td>
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									
									
									<tr>
											<td width="25%">9. Class of License applied for :<span class="mandatory_field">*</span></td></td>
											<td width="25%">
													<select class="form-control" name="class_of_license" required="required" >
														<option value="">Please select one class</option>
														<option <?php if($class_of_license==1) echo "selected"; ?> value="1">Class I</option>
														<option <?php if($class_of_license==2) echo "selected"; ?> value="2">Class II (for building Wiring)</option>
														<option <?php if($class_of_license==3) echo "selected"; ?> value="3">Class II (for installations upto 650 Volts)</option>
														<option <?php if($class_of_license==4) echo "selected"; ?> value="4">Special Class</option>
													</select>											
											</td>
											<td width="25%">10. If any contractors license already been granted, detail particulars thereof.</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="particular_details"  value="<?php echo  $particular_details; ?>"></td>
									</tr> 
									<tr>
										<td colspan="4">11. Details of Supervisor and Workman under full time and part time employment:<br/>
										(Additional sheets may be annexed if necessary)</td>
									</tr>
									<tr>
											<td colspan="4">
												<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="5%">Sl. No.</th>
														<th width="20">Name</th>
														<th width="20%">Permanent Address</th>
														<th width="10%">Date of Joining </th>
														<th width="10">Class(Parts)</th>
														<th width="10">Date of Issue</th>
														<th width="10">Date of Expiry</th>
														<th width="15">Whether fulltime</th>
													</tr>
													</thead>
													<?php
														$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
														$num2= $part2->num_rows;
														if($num2>0){
														$count=1;
														while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_2["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
															<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="txxtB<?php echo $count;?>" validate="letters" ></td>
															<td><input type="text" value="<?php echo $row_2["permanent_address"]; ?>"  title="No special characters are allowed except Dot" id="txxtC<?php echo $count;?>" class="form-control text-uppercase"  name="txxtC<?php echo $count;?>" ></td>			
															<td><input type="text" value="<?php echo $row_2["joining_date"]; ?>" id="txxtD<?php echo $count;?>" class="dob form-control text-uppercase"  name="txxtD<?php echo $count;?>" ></td>
															<td><input type="text" value="<?php echo $row_2["class"]; ?>" id="txxtE<?php echo $count;?>"  name="txxtE<?php echo $count;?>" class="form-control text-uppercase">
															</td>
															<td><input type="text" value="<?php echo $row_2["issue_date"]; ?>" id="txxtF<?php echo $count;?>"  name="txxtF<?php echo $count;?>" class="dob form-control text-uppercase"></td>
															<td><input type="text" value="<?php echo $row_2["expiry_date"]; ?>" id="txxtG<?php echo $count;?>" name="txxtG<?php echo $count;?>"  class="dob form-control text-uppercase"></td>
															<td><input type="text" value="<?php echo $row_2["fulltime"]; ?>" id="txxtH<?php echo $count;?>" name="txxtH<?php echo $count;?>"  class="form-control text-uppercase">
															</td>
														</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input type="text" readonly value="1" id="txxtA1" size="1" class="form-control text-uppercase"  name="txxtA1"></td>
															<td><input type="text" id="txxtB1" size="20" class="form-control text-uppercase" name="txxtB1" validate="letters"></td>
															<td><input type="text" id="txxtC1" title="No special characters are allowed except Dot"  class="form-control text-uppercase" name="txxtC1"></td>					
															<td><input type="text" id="txxtD1" class="dob form-control text-uppercase" name="txxtD1" ></td>
															<td><input type="text" id="txxtE1"  name="txxtE1" class="form-control text-uppercase"></td>
															<td><input type="text" id="txxtF1"  name="txxtF1" class="dob form-control text-uppercase"></td>
															<td><input type="text" id="txxtG1"  name="txxtG1" class="dob form-control text-uppercase"></td>
															<td><input type="text" id="txxtH1"  name="txxtH1" class="form-control text-uppercase"></td>
														</tr>
														<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
									</tr>
								
									<tr>
										<td colspan="4">12. Details of Testing instruments and other apparatus in possession:-</td>
									</tr>
									<tr>
											<td colspan="4">
												<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="5%">Sl. No.</th>
														<th width="20">Name of instrument </th>
														<th width="20%">Makers Name </th>
														<th width="15%">Capacity thereof  </th>
														<th width="15">Year of Manufactur</th>
														<th width="10">Sl. No. of instrument </th>
														<th width="15">Quantitative no. thereof </th>
													</tr>
													</thead>
													<?php
														$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
														$num3= $part3->num_rows;
														if($num3>0){
														$count=1;
														while($row_1=$part3->fetch_array()){	?>
														<tr>
															<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["sl_no"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
															<td><input type="text" id="txttB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["name"]; ?>" name="txttB<?php echo $count;?>" size="20"></td>
															<td><input type="text" value="<?php echo $row_1["makers_name"]; ?>" title="No special characters are allowed except Dot" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" validate="letters"></td>			
															<td><input type="text" value="<?php echo $row_1["capacity"]; ?>" id="txttD<?php echo $count;?>" class="form-control text-uppercase"  name="txttD<?php echo $count;?>" ></td>
															<td><input type="text" value="<?php echo $row_1["year"]; ?>" id="txttE<?php echo $count;?>"  name="txttE<?php echo $count;?>" class="form-control text-uppercase">
															<td><input type="text" value="<?php echo $row_1["ins_no"]; ?>" id="txttF<?php echo $count;?>"  name="txttF<?php echo $count;?>" class="form-control text-uppercase">
															<td><input type="text" value="<?php echo $row_1["quantitative"]; ?>" id="txttG<?php echo $count;?>"  name="txttG<?php echo $count;?>" class="form-control text-uppercase">
															</td>
														</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input type="text" readonly value="1" id="txttA1"  size="1" class="form-control text-uppercase" name="txttA1"></td>
															<td><input type="text" id="txttB1" size="20"  class="form-control text-uppercase" name="txttB1"></td>
															<td><input type="text" id="txttC1"  title="No special characters are allowed except Dot" class="form-control text-uppercase" name="txttC1" validate="letters"></td>
															<td><input type="text" id="txttD1"  class="form-control text-uppercase" name="txttD1" ></td>
															<td><input type="text" id="txttE1"  name="txttE1" class="form-control text-uppercase"></td>
															<td><input type="text" id="txttF1"  name="txttF1" class="form-control text-uppercase"></td>
															<td><input type="text" id="txttG1"  name="txttG1" class="form-control text-uppercase"></td>
														</tr>
														<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
											</td>
									</tr>
									<tr>
										<td colspan="4">
										The particulars and information furnished above are true to the best of my knowledge and in case anything is found or proved to be untrue, I shall be liable for any action the Board may deem fit and proper.</td>
									</tr>						
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/>
											Place: <strong><?php echo strtoupper($dist)?></strong></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="right"><strong><?php echo strtoupper($key_person)?></strong><br/>Signature of the Applicant</td>
									</tr>					
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
    
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>