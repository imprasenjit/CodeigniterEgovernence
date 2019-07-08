<?php  require_once "../../requires/login_session.php";
$dept="health";
$form="8";
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
			$form_id=$results['form_id'];
			$eye_bnk_name=$results["eye_bnk_name"];$eye_bnk_ad=$results["eye_bnk_ad"];
			$is_eye_bnk_gov=$results["is_eye_bnk_gov"];$is_teaching=$results["is_teaching"];$is_eye_bnk_iec=$results["is_eye_bnk_iec"];
			$is_availability=$results["is_availability"];
			$is_register_main=$results["is_register_main"];$m_no=$results["m_no"];$is_transport_facility=$results["is_transport_facility"];$is_instrument=$results["is_instrument"];$is_preservation=$results["is_preservation"];$is_pre_media=$results["is_pre_media"];$is_waste_disp=$results["is_waste_disp"];$is_power_supply=$results["is_power_supply"];
			$incharge=$results["incharge"];$eye_technician=$results["eye_technician"];$eye_don_counselors=$results["eye_don_counselors"];$task_staff=$results["task_staff"];$space_req=$results["space_req"];
			$is_records_main=$results["is_records_main"];$is_reg_pledges=$results["is_reg_pledges"];$is_comp_fac=$results["is_comp_fac"];
			$name_2=$results["name_2"];$eye_ret_add=$results["eye_ret_add"];
			$is_eye_ret_gov=$results["is_eye_ret_gov"];$is_eye_ret_teaching=$results["is_eye_ret_teaching"];
			$eye_ret_info=$results["eye_ret_info"];$eye_ret_name=$results["eye_ret_name"];
			$rem_incharge=$results["rem_incharge"];$rem_technician=$results["rem_technician"];$rem_mts=$results["rem_mts"];$is_rem_trans=$results["is_rem_trans"];
			$is_amb_col=$results["is_amb_col"];$is_instr_set=$results["is_instr_set"];$is_spc_bot_pres=$results["is_spc_bot_pres"];$is_transit=$results["is_transit"];$is_prev_med=$results["is_prev_med"];$is_waste=$results["is_waste"];$tel_number=$results["tel_number"];$s_req=$results["s_req"];
			$is_records=$results["is_records"];
			$ster_facility=$results["ster_facility"];$ref_temp=$results["ref_temp"];$ret_centre=$results["ret_centre"];$trans_name=$results["trans_name"];$trans_add=$results["trans_add"];$is_trans_gov=$results["is_trans_gov"];$is_trans_teaching=$results["is_trans_teaching"];$is_trans_iec=$results["is_trans_iec"];$trans_reg_name=$results["trans_reg_name"];
			$per_staff_no=$results["per_staff_no"];$temp_staff_no=$results["temp_staff_no"];$equip_det=$results["equip_det"];$is_OT_facilities=$results["is_OT_facilities"];$is_safe_sto_facilities=$results["is_safe_sto_facilities"];$records_reg=$results["records_reg"];$any_info=$results["any_info"];
			
			if(!empty($results["equip"])){
				$equip=json_decode($results["equip"]);
				$equip_a=$equip->a;$equip_b=$equip->b;$equip_c=$equip->c;$equip_d=$equip->d;$equip_e=$equip->e;
			}else{			
				$equip_a="";$equip_b="";$equip_c="";$equip_d="";$equip_e="";			
			}
			if(!empty($results["lab_facility"])){
				$lab_facility=json_decode($results["lab_facility"]);
				$lab_facility_a=$lab_facility->a;$lab_facility_b=$lab_facility->b;$lab_facility_c=$lab_facility->c;
			}else{			
				$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
			}
			if(!empty($results["reg_renewal"])){
				$reg_renewal=json_decode($results["reg_renewal"]);
				$reg_renewal_a=$reg_renewal->a;$reg_renewal_b=$reg_renewal->b;$reg_renewal_c=$reg_renewal->c;
			}else{			
				$reg_renewal_a="";$reg_renewal_b="";$reg_renewal_c="";
			}
		}else{
			$form_id="";	
			$eye_bnk_name=""; $eye_bnk_ad="";$is_eye_bnk_gov="";$is_teaching="";$is_eye_bnk_iec="";
			$is_availability="";
			$is_register_main="";$m_no="";$is_transport_facility="";$is_instrument="";$is_preservation="";$is_pre_media="";$is_waste_disp="";$is_power_supply="";
			$incharge="";$eye_technician="";$eye_don_counselors="";$task_staff="";$space_req="";
			$is_records_main="";$is_reg_pledges="";$is_comp_fac="";
			$equip_a="";$equip_b="";$equip_c="";$equip_d="";$equip_e="";
			$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
			$reg_renewal_a="";$reg_renewal_b="";$reg_renewal_c="";
			$name_2="";$eye_ret_add="";
			$is_eye_ret_gov="";$is_eye_ret_teaching="";
			$eye_ret_info="";$eye_ret_name="";
			$rem_incharge="";$rem_technician="";$rem_mts="";$is_rem_trans="";
			$is_amb_col="";$is_instr_set="";$is_spc_bot_pres="";$is_transit="";$is_prev_med="";$is_waste="";$tel_number="";$s_req="";
			$is_records="";
			$ster_facility="";$ref_temp="";$ret_centre="";$trans_name="";$trans_add="";$is_trans_gov="";$is_trans_teaching="";$is_trans_iec="";$trans_reg_name="";
			$per_staff_no="";$temp_staff_no="";$equip_det="";$is_OT_facilities="";$is_safe_sto_facilities="";$records_reg="";$any_info="";
		}	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$eye_bnk_name=$results["eye_bnk_name"];$eye_bnk_ad=$results["eye_bnk_ad"];
		$is_eye_bnk_gov=$results["is_eye_bnk_gov"];$is_teaching=$results["is_teaching"];$is_eye_bnk_iec=$results["is_eye_bnk_iec"];
		$is_availability=$results["is_availability"];
		$is_register_main=$results["is_register_main"];$m_no=$results["m_no"];$is_transport_facility=$results["is_transport_facility"];$is_instrument=$results["is_instrument"];$is_preservation=$results["is_preservation"];$is_pre_media=$results["is_pre_media"];$is_waste_disp=$results["is_waste_disp"];$is_power_supply=$results["is_power_supply"];
		$incharge=$results["incharge"];$eye_technician=$results["eye_technician"];$eye_don_counselors=$results["eye_don_counselors"];$task_staff=$results["task_staff"];$space_req=$results["space_req"];
		$is_records_main=$results["is_records_main"];$is_reg_pledges=$results["is_reg_pledges"];$is_comp_fac=$results["is_comp_fac"];
		$name_2=$results["name_2"];$eye_ret_add=$results["eye_ret_add"];
		$is_eye_ret_gov=$results["is_eye_ret_gov"];$is_eye_ret_teaching=$results["is_eye_ret_teaching"];
		$eye_ret_info=$results["eye_ret_info"];$eye_ret_name=$results["eye_ret_name"];
		$rem_incharge=$results["rem_incharge"];$rem_technician=$results["rem_technician"];$rem_mts=$results["rem_mts"];$is_rem_trans=$results["is_rem_trans"];
		$is_amb_col=$results["is_amb_col"];$is_instr_set=$results["is_instr_set"];$is_spc_bot_pres=$results["is_spc_bot_pres"];$is_transit=$results["is_transit"];$is_prev_med=$results["is_prev_med"];$is_waste=$results["is_waste"];$tel_number=$results["tel_number"];$s_req=$results["s_req"];
		$is_records=$results["is_records"];
		$ster_facility=$results["ster_facility"];$ref_temp=$results["ref_temp"];$ret_centre=$results["ret_centre"];$trans_name=$results["trans_name"];$trans_add=$results["trans_add"];$is_trans_gov=$results["is_trans_gov"];$is_trans_teaching=$results["is_trans_teaching"];$is_trans_iec=$results["is_trans_iec"];$trans_reg_name=$results["trans_reg_name"];
		
		$per_staff_no=$results["per_staff_no"];$temp_staff_no=$results["temp_staff_no"];$equip_det=$results["equip_det"];$is_OT_facilities=$results["is_OT_facilities"];$is_safe_sto_facilities=$results["is_safe_sto_facilities"];$records_reg=$results["records_reg"];$any_info=$results["any_info"];
		
		if(!empty($results["equip"])){
			$equip=json_decode($results["equip"]);
			$equip_a=$equip->a;$equip_b=$equip->b;$equip_c=$equip->c;$equip_d=$equip->d;$equip_e=$equip->e;
		}else{			
			$equip_a="";$equip_b="";$equip_c="";$equip_d="";$equip_e="";			
		}
		if(!empty($results["lab_facility"])){
			$lab_facility=json_decode($results["lab_facility"]);
			$lab_facility_a=$lab_facility->a;$lab_facility_b=$lab_facility->b;$lab_facility_c=$lab_facility->c;
		}else{			
			$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
		}
		if(!empty($results["reg_renewal"])){
			$reg_renewal=json_decode($results["reg_renewal"]);
			$reg_renewal_a=$reg_renewal->a;$reg_renewal_b=$reg_renewal->b;$reg_renewal_c=$reg_renewal->c;
		}else{			
			$reg_renewal_a="";$reg_renewal_b="";$reg_renewal_c="";
		}
	}	
##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";
	}
	
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>
								<p class="text-center"></p>
							</div>
							<div class="panel-body">
							<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li  class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
									<li  class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
							</ul>
							<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table   class="table table-responsive table-bordered">
									
									<tr>
											<td><b>I. EYE BANKING</b></td>
											<td></td>
											<td></td>
											<td></td>
									</tr>
									<tr>
											<td colspan="4"><b>(A) EYE BANK & Institution affiliated Ophthalmic/General Hospital</b></td>					
									</tr>
									<tr>
											<td width="25%">1. Name :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="eye_bnk_name"  value="<?php echo $eye_bnk_name; ?>"></td>
											<td width="25%">2. Address :</td>
											<td width="25%"><textarea class="form-control text_uppercase" name="eye_bnk_ad"><?php echo $eye_bnk_ad;?></textarea></td>
									</tr>

								   <tr>
											<td>3. Government / Private / Voluntary : </td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_eye_bnk_gov" <?php if($is_eye_bnk_gov=="G" || $is_eye_bnk_gov=="") echo "checked"; ?> value="G"/> Government </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_eye_bnk_gov" <?php if($is_eye_bnk_gov=="P") echo "checked"; ?> value="P"/> Private</label>&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" required="required" name="is_eye_bnk_gov" <?php if($is_eye_bnk_gov=="V" ) echo "checked"; ?> value="V"/> Voluntary</label></td>
											<td>4. Teaching / Non teaching :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_teaching" <?php if($is_teaching=="T") echo "checked"; ?> value="T"/> Teaching </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_teaching" <?php if($is_teaching=="N" || $is_teaching=="") echo "checked"; ?> value="N"/> Non teaching</label></td>
									</tr>	
									<tr>
											<td >5. IEC for Eye Donation :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_eye_bnk_iec" <?php if($is_eye_bnk_iec=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_eye_bnk_iec" <?php if($is_eye_bnk_iec=="N" || $is_eye_bnk_iec=="") echo "checked"; ?> value="N"/> No</label></td>
									</tr>
									<tr>
											<td colspan="4"><b>(B) REMOVAL OF EYE BALLS AND STORAGE</b></td>
									</tr>

									<tr>
											<td colspan="3" >1. Availability of adequate trained and qualified Personal for removal of eye balls/cornea ?<span class="mandatory_field">*</span></td>
											<td><label class="radio-inline"><input type="radio" name="is_availability" value="Y"  <?php if(isset($is_availability) && $is_availability=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_availability"  value="N"  <?php if(isset($is_availability) && $is_availability=='N') echo 'checked'; ?>/> No</label>
											</td>
									</tr>
									
									<tr>
										<td colspan="4">2. Name, qualification & address of the designated staff who will be doing whole globe / cornea retrieval :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Name</th>
													<th width="30%">Qualification</th>
													<th width="30%">Address</th>
													
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
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["address"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
										
									<tr>
											<td colspan="4">3. Availability of following as per requirement :</td>
									</tr>

                                <tr>
											<td width="25%">(a) Whether register maintained for tissue request received from surgeon of corneal transplant centre:</td>
											<td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_register_main" <?php if($is_register_main=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_register_main" <?php if($is_register_main=="N" || $is_register_main=="") echo "checked"; ?> value="N"/> No </label></td>
											<td width="25%">(b) Mobile No :</td>
											<td width="25%"><input type="text" class="form-control text_uppercase" name="m_no" validate="mobileNumber" maxlength="10" value="<?php echo $m_no; ?>"></td>
                                </tr>

									<tr>
											<td>(c) Transport facility for collecting Eyeballs from outside : </td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_transport_facility" <?php if($is_transport_facility=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_transport_facility" <?php if($is_transport_facility=="N" || $is_transport_facility=="") echo "checked"; ?> value="N"/> No </label></td>
											<td>(d) Sets of Instruments for removal of whole globe/Cornea as per requirement :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_instrument" <?php if($is_instrument=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_instrument" <?php if($is_instrument=="N" || $is_instrument=="") echo "checked"; ?> value="N"/> No </label></td>
                                </tr>
										
									<tr>
											<td>(e) Special bottles with stands for preservation of eye Balls / Cornea during transit :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_preservation" <?php if($is_preservation=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_preservation" <?php if($is_preservation=="N" || $is_preservation=="") echo "checked"; ?> value="N"/> No </label></td>
											<td>(f) Suitable preservation media :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_pre_media" <?php if($is_pre_media=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_pre_media" <?php if($is_pre_media=="N" || $is_pre_media=="") echo "checked"; ?> value="N"/> No </label></td>
                                </tr>
								   
									<tr>
											<td>(g) Biomedical waste disposal :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_waste_disp" <?php if($is_waste_disp=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_waste_disp" <?php if($is_waste_disp=="N" || $is_waste_disp=="") echo "checked"; ?> value="N"/> No </label></td>
											<td>(h) Uninterrupted Power supply :</td>
											<td><label class="radio-inline"><input type="radio" required="required" name="is_power_supply" <?php if($is_power_supply=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_power_supply" <?php if($is_power_supply=="N" || $is_power_supply=="") echo "checked"; ?> value="N"/> No </label></td>
                                </tr>
									
										
									<tr>
											<td colspan="4"><b>(C) MANPOWER</b></td>					
									</tr>	
									<tr>
											<td width="25%">1. In charge / Director (Ophthalmologist) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="incharge" value="<?php echo $incharge; ?>"></td>
											<td width="25%">2. Eye Bank Technician :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="eye_technician" value="<?php echo $eye_technician; ?>"></td>
									</tr>
									<tr>
											<td>3. Eye Donation Counselors (EDC) :</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="eye_don_counselors" value="<?php echo $eye_don_counselors; ?>"></td>
											<td>4. Multi task Staff (MTS) :</td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="task_staff" value="<?php echo $task_staff; ?>"></td>
									</tr>
									<tr>
											<td><b>(D)Space requirement for eye Banks  ( 400 sqft minimum )</b>  :</td>
											<td><input type="text" class="form-control text-uppercase" name="space_req" value="<?php echo $space_req; ?>"></td>
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
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive ">	
								
								<tr>
										<td colspan="4"><b>(E) RECORDS</b></td>					
								</tr>
								
								<tr>
                                    <td width="25%">1. Arrangement for maintaining the records :</td>
                                    <td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_records_main" <?php if($is_records_main=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_records_main" <?php if($is_records_main=="N" || $is_records_main=="") echo "checked"; ?> value="N"/> No </label></td>
										<td width="25%">2. Arrangement for registration of pledges/donors and maintenance of utilization report :</td>
										<td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_reg_pledges" <?php if($is_reg_pledges=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_reg_pledges" <?php if($is_reg_pledges=="N" || $is_reg_pledges=="") echo "checked"; ?> value="N"/> No </label></td>
                            </tr>
								<tr>
                                    <td>3. Computer with internet facility and printer :</td>
                                    <td><label class="radio-inline"><input type="radio" required="required" name="is_comp_fac" <?php if($is_comp_fac=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_comp_fac" <?php if($is_comp_fac=="N" || $is_comp_fac=="") echo "checked"; ?> value="N"/> No </label></td>	
                            </tr>
								<tr>
										<td colspan="4"><b>(F) EQUIPMENT</b></td>					
								</tr>
								<tr>
                                    <td width="25%">1. Slit lamp Bio microscope :</td>
                                    <td width="25%"><input type="text" class="form-control text-uppercase" name="equip[a]" value="<?php echo $equip_a; ?>"></td>
										<td width="25%">2. Specular Microscope for Eye Bank :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="equip[b]" value="<?php echo $equip_b; ?>"></td>
                            </tr>
								<tr>
                                    <td width="25%">3. Laminar flow (Class II) :</td>
                                    <td width="25%"><input type="text" class="form-control text-uppercase" name="equip[c]" value="<?php echo $equip_c; ?>"></td>
										<td width="25%">4. Sterilization facility (In-house or outsourced) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="equip[d]" value="<?php echo $equip_d; ?>"></td>
                            </tr>
								<tr>
                                    <td colspan="3">5. Refrigerator with temperature monitoring for preservation of Eyeballs/ Cornea :</td>
                                    <td ><input type="text" class="form-control text-uppercase" name="equip[e]" value="<?php echo $equip_e; ?>"></td>
								</tr>
								<tr>
										<td colspan="4"><b>(G) LABORATORY FACILITIES</b></td>					
								</tr>
								<tr>
                                    <td width="25%">1. Facility for HIV, Hepatitis B & C testing :</td>
                                    <td width="25%"><input type="text" class="form-control text-uppercase" name="lab_facility[a]" value="<?php echo $lab_facility_a; ?>"></td>
										<td width="25%">2. In no where do you avail it? Please mention Name and address of Institute :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="lab_facility[b]" value="<?php echo $lab_facility_b; ?>"></td>
                            </tr>
								<tr>
                                    <td >3. Facility for culture and sensitivity of Corneoscleral ring. :</td>
                                    <td ><input type="text" class="form-control text-uppercase" name="lab_facility[c]" value="<?php echo $lab_facility_c; ?>"></td>
								</tr>
								<tr>
										<td colspan="4"><b>(H) RENEWAL OF REGISTRATION</b></td>					
								</tr>
								<tr>
                                    <td width="25%">1. Period of renewal 5 years after last registration :</td>
                                    <td width="25%"><input type="text" class="form-control text-uppercase" name="reg_renewal[a]" value="<?php echo $reg_renewal_a; ?>"></td>
										<td width="25%">2. Minimum of 500 corneas to be collected in 5 years :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_renewal[b]" value="<?php echo $reg_renewal_b; ?>"></td>
                            </tr>
								<tr>
                                    <td >3. Maintenance of eye bank standards (as per Guidelines) :</td>
                                    <td ><input type="text" class="form-control text-uppercase" name="reg_renewal[c]" value="<?php echo $reg_renewal_c; ?>"></td>
								</tr>
								<tr>
									    <td><b>II. EYE RETRIEVAL CENTRE (ERC) :</b></td>
										<td></td>
										<td></td>
										<td></td>
								</tr>
								<tr>
										<td colspan="4"><b>(A) RETRIEVAL CENTER – A Centre affiliated to an EYE Bank</b></td>					
								</tr>
								<tr>
										<td width="25%">1. Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name_2"  value="<?php echo $name_2; ?>"></td>
										<td>2. Address</td>
										<td><textarea class="form-control text_uppercase" name="eye_ret_add"><?php echo $eye_ret_add;?></textarea></td>
								</tr>

								<tr>
										<td>3. Government / Private / Voluntary : </td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_eye_ret_gov" <?php if($is_eye_ret_gov=="G" || $is_eye_ret_gov=="") echo "checked"; ?> value="G"/> Government </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_eye_ret_gov" <?php if($is_eye_ret_gov=="P" ) echo "checked"; ?> value="P"/> Private</label>&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" required="required" name="is_eye_ret_gov" <?php if($is_eye_ret_gov=="V") echo "checked"; ?> value="V"/> Voluntary</label></td>
										<td>4. Teaching / Non teaching :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_eye_ret_teaching" <?php if($is_eye_ret_teaching=="T") echo "checked"; ?> value="T"/> Teaching </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_eye_ret_teaching" <?php if($is_eye_ret_teaching=="N" || $is_eye_ret_teaching=="") echo "checked"; ?> value="N"/> Non teaching</label></td>
								</tr>	
								<tr>
										<td width="25%">5. Information, Education and Communication Activities for Eye Donation :</td>
										<td><textarea class="form-control text_uppercase" name="eye_ret_info"><?php echo $eye_ret_info;?></textarea></td>
										<td width="25%">6. Name of Eye Bank to which ERC is affilited :</td>
										<td><textarea class="form-control text_uppercase" name="eye_ret_name"><?php echo $eye_ret_name;?></textarea></td>
								</tr>
								<tr>
										<td colspan="4"><b>(B) REMOVAL OF EYE BALLS AND STORAGE</b></td>					
								</tr>
								
								<tr>
										<td colspan="4">1. Manpower: Adequate trained and qualified personal for removal of eye balls/cornea(annex detail) :</td>
								</tr>
								<tr>
										<td >a. In charge / Director :</td>
										<td ><input type="text" class="form-control text-uppercase" name="rem_incharge"  value="<?php echo $rem_incharge; ?>"></td>
										<td>b. Technician :</td>
										<td><input type="text" class="form-control text-uppercase" name="rem_technician"  value="<?php echo $rem_technician; ?>"></td>
								</tr>
								<tr>
										<td>c. MTS (Multi task staff):</td>
										<td><input type="text" class="form-control text-uppercase" name="rem_mts"  value="<?php echo $rem_mts; ?>"></td>
										<td>2. Transport facility (or outsource) with storage medium :<span class="mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" name="is_rem_trans" value="Y"  <?php if(isset($is_rem_trans) && $is_rem_trans=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_rem_trans"  value="N"  <?php if(isset($is_rem_trans) && $is_rem_trans=='N') echo 'checked'; ?>/> No</label>
										</td>
								</tr>
								
								<tr>
									<td colspan="4">(C) Name, qualification and address of the personal who will be doing enucleation / removal of cornea (annex details) :
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
											<thead>
											<tr>
												<th width="10%">Sl. No.</th>
												<th width="30%">Name</th>
												<th width="30%">Qualification</th>
												<th width="30%">Address</th>
													
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
															<td><input value="<?php echo $row_2["qualification2"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["address2"]; ?>" id="textD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>	
														<td><input id="textD1" size="10"   class="form-control text-uppercase" name="textD1"></td>
																												
													</tr>
													<?php } ?>														
										</table>
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
									</td>
								</tr>
							
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>							
							</table>
							</form>
							</div>
							
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive ">	
								
								<tr>
										<td colspan="4"><b>(D) AVAILABILITY OF FOLLOWING :</b></td>					
								</tr>
								
								<tr>
										<td width="25%">1. Ambulance/ vehicle or funds to pay taxi for collecting eye balls from Outside :</td>
										<td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_amb_col" <?php if($is_amb_col=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_amb_col" <?php if($is_amb_col=="N" || $is_amb_col=="") echo "checked"; ?> value="N"/> No </label></td>
										<td width="25%">2. Sets of instruments for removal of Eye Balls / Cornea :</td>
										<td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_instr_set" <?php if($is_instr_set=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_instr_set" <?php if($is_instr_set=="N" || $is_instr_set=="") echo "checked"; ?> value="N"/> No </label></td>
                            </tr>
								<tr>
										<td>3. Special bottles with stands for preservation :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_spc_bot_pres" <?php if($is_spc_bot_pres=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_spc_bot_pres" <?php if($is_spc_bot_pres=="N" || $is_spc_bot_pres=="") echo "checked"; ?> value="N"/> No </label></td>
										<td>4. Eye balls/cornea during transit :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_transit" <?php if($is_transit=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_transit" <?php if($is_transit=="N" || $is_transit=="") echo "checked"; ?> value="N"/> No </label></td>
                            </tr>
								<tr>
										<td>5. Suitable preservation media :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_prev_med" <?php if($is_prev_med=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_prev_med" <?php if($is_prev_med=="N" || $is_prev_med=="") echo "checked"; ?> value="N"/> No </label></td>
										<td>6. Waste Disposal(Biomedical Waste Management) :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_waste" <?php if($is_waste=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_waste" <?php if($is_waste=="N" || $is_waste=="") echo "checked"; ?> value="N"/> No </label></td>
                            </tr>
								<tr>
										<td>7. Mobile Number :</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="tel_number" value="<?php echo $tel_number; ?>"></td>
										<td>8. Space requirement(Designated area) :</td>
										<td><input type="text" class="form-control text-uppercase" name="s_req" value="<?php echo $s_req; ?>"></td>
                            </tr>
								<tr>
										<td colspan="4"><b>(E) RECORDS :</b></td>					
								</tr>
								<tr>
										<td width="25%">1. Arrangement for maintaining the records :</td>
										<td width="25%"><label class="radio-inline"><input type="radio" required="required" name="is_records" <?php if($is_records=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_records" <?php if($is_records=="N" || $is_records=="") echo "checked"; ?> value="N"/> No </label></td>
										
                            </tr>
								
								<tr>
										<td colspan="4"><b>(F) EQUIPMENT</b></td>					
								</tr>
								<tr>
										<td>1. Sterilization facility :</td>
										<td><input type="text" class="form-control text-uppercase" name="ster_facility" value="<?php echo $ster_facility; ?>"></td>
										<td>2. Refrigerator temperature control 24 hrs for preservation of Eyeballs/Cornea. (power back up) :</td>
										<td><input type="text" class="form-control text-uppercase" name="ref_temp" value="<?php echo $ref_temp; ?>"></td>
                            </tr>
								<tr>
										<td colspan="3">3. The retrieval centre is affiliated with an eye bank and Eye Bank is only authorized to distribute corneas :</td>
										<td ><input type="text" class="form-control text-uppercase" name="ret_centre" value="<?php echo $ret_centre; ?>"></td>
								</tr>
								<tr>
										<td><b>III. CORNEAL TRANSPLANTATATION CENTRE :</b></td>
										<td></td>
										<td></td>
										<td></td>
								</tr>
								<tr>
										<td colspan="4"><b>(A) </b></td>					
								</tr>
								<tr>
										<td>1. Name of the Transplant Centre / Hospital :</td>
										<td><textarea class="form-control text_uppercase" name="trans_name"><?php echo $trans_name;?></textarea></td>
										<td>2. Address :</td>
										<td><textarea class="form-control text_uppercase" name="trans_add"><?php echo $trans_add;?></textarea></td>
								</tr>
								<tr>
										<td>3. Government / Private / Voluntary : </td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_trans_gov" <?php if($is_trans_gov=="G"  || $is_trans_gov=="") echo "checked"; ?> value="G"/> Government </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_trans_gov" <?php if($is_trans_gov=="P") echo "checked"; ?> value="P"/> Private</label>&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" required="required" name="is_trans_gov" <?php if($is_trans_gov=="V") echo "checked"; ?> value="V"/> Voluntary</label></td>
										<td>4. Teaching / Non teaching :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_trans_teaching" <?php if($is_trans_teaching=="T") echo "checked"; ?> value="T"/> Teaching </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_trans_teaching" <?php if($is_trans_teaching=="N" || $is_trans_teaching=="") echo "checked"; ?> value="N"/> Non teaching</label></td>
								</tr>	
								<tr>
										<td>5. IEC for Eye Donation :</td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_trans_iec" <?php if($is_trans_iec=="Y") echo "checked"; ?> value="Y"/> Yes</label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_trans_iec" <?php if($is_trans_iec=="N" || $is_trans_iec=="") echo "checked"; ?> value="N"/> No</label></td>
										<td>6. Name of the registered Eye Bank for procuring tissue :</td>
										<td><input type="text" class="form-control text-uppercase" name="trans_reg_name"  value="<?php echo $trans_reg_name; ?>"></td>
								</tr>	
								<tr>
										<td colspan="4"><b>(B) </b></td>					
								</tr>
								<tr>
										<td>1. No. of permanent staff members with their designation :</td>
										<td><input type="text" class="form-control text-uppercase" name="per_staff_no"  value="<?php echo $per_staff_no; ?>"></td>
										<td>2. No. of temporary staff with their designation :</td>
										<td><input type="text" class="form-control text-uppercase" name="temp_staff_no"  value="<?php echo $temp_staff_no; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">3. Trained persons for Keratoplasty and Corneal Transplantation with their names and qualifications: 2 (one Corneal Transplant surgeon should be on the pay roll of the Institute) :
										<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
											<thead>
											<tr>
												<th width="10%">Sl. No.</th>
												<th width="45%">Name</th>
												<th width="45%">Qualification</th>
													
													
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
															
															
														</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" id="txA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txA1"></td>
														<td><input id="txB1" size="10" validate="letters" class="form-control text-uppercase" name="txB1"></td>
														<td><input id="txC1" size="10"   class="form-control text-uppercase" name="txC1"></td>	
													</tr>
													<?php } ?>														
										</table>
										<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
										<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
										<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
									</td>
								</tr>
								<tr>
										<td colspan="3"><b>(C) Equipment: Slit lamp, Clinical Specular, Keratoplasty or intraocular instruments :</b></td>
										<td><textarea class="form-control text_uppercase" name="equip_det"><?php echo $equip_det;?></textarea></td>
								</tr>
								<tr>
										<td><b>(D) OT facilities :</b></td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_OT_facilities" <?php if($is_OT_facilities=="Y") echo "checked"; ?> value="Y"/> Yes</label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_OT_facilities" <?php if($is_OT_facilities=="N" || $is_OT_facilities=="") echo "checked"; ?> value="N"/> No</label></td>
										<td><b>(E) Safe Storage facility :</b></td>
										<td><label class="radio-inline"><input type="radio" required="required" name="is_safe_sto_facilities" <?php if($is_safe_sto_facilities=="Y") echo "checked"; ?> value="Y"/> Yes</label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_safe_sto_facilities" <?php if($is_safe_sto_facilities=="N" || $is_safe_sto_facilities=="") echo "checked"; ?> value="N"/> No</label></td>
								</tr>
								
								<tr>
										<td><b>(F) Records Registration and follow up :</b></td>
										<td><textarea class="form-control text_uppercase" name="records_reg"><?php echo $records_reg;?></textarea></td>
										<td><b>(G) Any other information :</b></td>
										<td><textarea class="form-control text_uppercase" name="any_info"><?php echo $any_info;?></textarea></td>
								</tr>
								<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
										Place : <strong><?php echo strtoupper($dist)?></strong>
										</td>										
										<td colspan="2" align="right">Signature of Head of Institution: <strong><?php echo strtoupper($key_person)?></strong><br/>
										Name: <label><?php echo strtoupper($key_person)?></strong>
										</td>
								</tr>
								
								<tr>
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" class="btn btn-success text-bold submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
