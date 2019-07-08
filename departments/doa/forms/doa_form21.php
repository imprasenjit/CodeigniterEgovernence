<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="21";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form1.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	   if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();
				$form_id=$results["form_id"];
				
				$is_application=$results["is_application"];
				$name_of_training=$results["name_of_training"];
				$duration_of_training=$results["duration_of_training"];
				$training_certificate=$results["training_certificate"];
				$registered_address=$results["registered_address"];$zonal_address=$results["zonal_address"];$branch_ofc_address=$results["branch_ofc_address"];$premises_address=$results["premises_address"];
				$is_approval=$results["is_approval"];$is_approval_details=$results["is_approval_details"];$is_approval_details1=$results["is_approval_details1"];$is_approval_details2=$results["is_approval_details2"];
				$name_of_insecticide=$results["name_of_insecticide"];$name_of_res_technical=$results["name_of_res_technical"];
				$is_qty=$results["is_qty"];$is_qty_details=$results["is_qty_details"];$is_qty_details1=$results["is_qty_details1"];
				if(!empty($results["details"])){
					$details=json_decode($results["details"]);
					$details_safety_equipment=$details->safety_equipment;$details_antidotes=$details->antidotes;$details_other_facilities=$details->other_facilities;
				}else{				
					$details_safety_equipment="";$details_antidotes="";$details_other_facilities="";
				}			
				
				$insecticide_stored_add=$results["insecticide_stored_add"];$insecticide_sold_add=$results["insecticide_sold_add"];$is_residential_area=$results["is_residential_area"];$is_premises=$results["is_premises"];$licence_number=$results["licence_number"];$date_of_grant=$results["date_of_grant"];
				
			}else{
				$form_id="";
				
				$is_application="";
				$name_of_training="";$duration_of_training="";$training_certificate="";
				$registered_address="";$zonal_address="";$branch_ofc_address="";$premises_address="";
				$is_approval="";$is_approval_details="";$is_approval_details1="";$is_approval_details2="";
				$name_of_insecticide="";$name_of_res_technical="";
				$is_qty="";$is_qty_details="";$is_qty_details1="";
				$details_safety_equipment="";$details_antidotes="";$details_other_facilities="";
				
				$insecticide_stored_add="";$insecticide_sold_add="";$is_residential_area="";$is_premises="";$licence_number="";$date_of_grant="";
			}
	}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];
			
			$is_application=$results["is_application"];
			$name_of_training=$results["name_of_training"];$duration_of_training=$results["duration_of_training"];$training_certificate=$results["training_certificate"];
			$registered_address=$results["registered_address"];$zonal_address=$results["zonal_address"];$branch_ofc_address=$results["branch_ofc_address"];$premises_address=$results["premises_address"];
			$is_approval=$results["is_approval"];$is_approval_details=$results["is_approval_details"];$is_approval_details1=$results["is_approval_details1"];$is_approval_details2=$results["is_approval_details2"];
			$name_of_insecticide=$results["name_of_insecticide"];$name_of_res_technical=$results["name_of_res_technical"];
			$is_qty=$results["is_qty"];$is_qty_details=$results["is_qty_details"];$is_qty_details1=$results["is_qty_details1"];
				if(!empty($results["details"])){
					$details=json_decode($results["details"]);
					$details_safety_equipment=$details->safety_equipment;$details_antidotes=$details->antidotes;$details_other_facilities=$details->other_facilities;
				}else{				
					$details_safety_equipment="";$details_antidotes="";$details_other_facilities="";
				}	
			
			$insecticide_stored_add=$results["insecticide_stored_add"];$insecticide_sold_add=$results["insecticide_sold_add"];$is_residential_area=$results["is_residential_area"];$is_premises=$results["is_premises"];$licence_number=$results["licence_number"];$date_of_grant=$results["date_of_grant"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">To<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
										 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
										<br/></td>
									</tr>
									<tr>
										<td colspan="4">To<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/></td>
									</tr>
									
									<tr>
										<td colspan="2">1. Name, address and e-mail address of the applicant :</td>
																	
									</tr>
									<tr>
										<td width="25%">Name of the applicant :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>		
									</tr>
									<tr>
										 <td colspan="4">Address of the applicant : </td>				 
									</tr>
									<tr>
										<td width="25%">Street name 1 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td width="25%">Street name 2 :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District :</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode :</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
										<td>Mobile No. :</td>
										<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>E-mail id :</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
										<td></td>
										<td></td>									
									</tr>
									<tr>
										<td colspan="1">2. Whether the application is for ?</td>
										<td colspan="3"><label class="radio-inline"><input type="radio" name="is_application" class="is_application" value="S"  <?php if(isset($is_application) && $is_application=='S') echo 'checked'; ?> /> (a) Grant/renewal of licence to sell/stock/exhibit for sale/distribution of insecticides</label><br/>
										<label class="radio-inline"><input type="radio" class="is_application"  value="C"  name="is_application" <?php if(isset($is_application) && ($is_application=='C' || $is_application=='')) echo 'checked'; ?>/> (b) Grant/renewal of licence for commercial pest control operations</label><br/>
										<label class="radio-inline"><input type="radio" class="is_application"  value="B"  name="is_application" <?php if(isset($is_application) && ($is_application=='B' || $is_application=='')) echo 'checked'; ?>/>Both(Grant/renewal of licence to sell/stock/exhibit for sale/distribution of insecticides /commercial pest control operations)</label>
										</td>
									</tr>
									<tr>
										 <td colspan="4">3. Qualification of the applicant/ the technical personnel under employment of the applicant (minimum qualification shall be a graduate with degree in Agriculture or Science with Chemistry/Zoology/Botany/Biotechnology/Life Sciences.) : </td>
									</tr>
									<tr>
											<td colspan="4">
												<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
													<tr>
														<th width="20%">Sl No.</th>
														<th width="40%">Name</th>
														<th width="40%">Qualification</th>
													</tr>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_1["qualification"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text" value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input type="text" id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
														<td><input type="text" id="textC1" size="10" class="form-control text-uppercase" name="textC1" ></td>
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>	
										<tr>
											<td colspan="4">4. Training :</td>
										</tr>
										<tr>
											<td>(a) Name of the training/course  :</td>
											<td><input type="text" class="form-control text-uppercase" name="name_of_training" value="<?php echo $name_of_training;?>" /></td>
											<td>(b) Duration of training course :</td>
											<td><input type="text" class="form-control text-uppercase"  name="duration_of_training" value="<?php echo $duration_of_training;?>" /></td>
										</tr>
										<tr>
											<td>(c) Certificate awarded, if any :</td>
											<td><input type="text" class="form-control text-uppercase" name="training_certificate" value="<?php echo $training_certificate;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">5. In case of application for commercial pest control operations : </td>
										</tr>
										<tr>
											<td colspan="4">(a) Address of registered, zonal and branch offices : </td>
										</tr>
										<tr>
											<td>Registered address :</td>
											<td><textarea class="form-control text-uppercase" name="registered_address" validate="textarea"><?php echo $registered_address;?></textarea></td>
											<td>Zonal address :</td>
											<td><textarea class="form-control text-uppercase" name="zonal_address" validate="textarea"><?php echo $zonal_address;?></textarea></td>
										</tr>
										<tr>
											<td>Branch office address :</td>
											<td><textarea class="form-control text-uppercase" name="branch_ofc_address" validate="textarea"><?php echo $branch_ofc_address;?></textarea></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>(b) Address of the premises for which the license is applied for :</td>
											<td><textarea class="form-control text-uppercase" name="premises_address" validate="textarea"><?php echo $premises_address;?></textarea></td>
											
										</tr>
										<tr>
											<td>(c) whether approval of technical expertise obtained :</td>
											<td><label class="radio-inline"><input type="radio" name="is_approval" class="is_approval" value="Y"  <?php if(isset($is_approval) && $is_approval=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_approval"  value="N"  name="is_approval" <?php if(isset($is_approval) && ($is_approval=='N' || $is_approval=='')) echo 'checked'; ?>/> No</label></td>
											<td width="25%">(d)If yes, state reference number of approval, its date and validity ; Reference Number :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="is_approval_details" id="is_approval_details" value="<?php echo $is_approval_details;?>" /></td>
										</tr>
										<tr>
											<td>Date :</td>
											<td width="25%"><input type="text" class="dob form-control text-uppercase" name="is_approval_details1" id="is_approval_details1" value="<?php if($is_approval_details1!="0000-00-00") echo $is_approval_details1;?>" /></td>
											<td>Validity :</td>
											<td><input type="text" class="form-control text-uppercase" name="is_approval_details2" id="is_approval_details2" value="<?php echo $is_approval_details2;?>" /></td>
										</tr>
										<tr>
											<td>(e)Name of restricted insecticides for which approved :</td>
											<td><textarea class="form-control text-uppercase" name="name_of_insecticide" validate="textarea"><?php echo $name_of_insecticide;?></textarea></td>
											<td>(f)Name of the responsible technical person :</td>
											<td><textarea class="form-control text-uppercase" name="name_of_res_technical" validate="textarea"><?php echo $name_of_res_technical;?></textarea></td>
										</tr>
										<tr>
											<td>(g)Whether any quantity of restricted insecticide in possession as on date of application :</td>
											<td><label class="radio-inline"><input type="radio" name="is_qty" class="is_qty" value="Y"  <?php if(isset($is_qty) && $is_qty=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_qty"  value="N"  name="is_qty" <?php if(isset($is_qty) && ($is_qty=='N' || $is_qty=='')) echo 'checked'; ?>/> No</label></td>
											<td width="25%">(h)If yes, particulars and respective quantity of each in possession ; Particulars :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="is_qty_details" id="is_qty_details" value="<?php echo $is_qty_details;?>" /></td>
										</tr>
										<tr>
											<td>Quantity :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="is_qty_details1" id="is_qty_details1" value="<?php echo $is_qty_details1;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">(i) Details of safety equipment, antidotes and all other essential facilities (Enclose supporting documents in Upload Section)  : </td>
										</tr>
										<tr>
											<td>Safety Equipment :</td>
											<td><textarea class="form-control text-uppercase" name="details[safety_equipment]" validate="textarea"><?php echo $details_safety_equipment;?></textarea></td>
											<td>Antidotes :</td>
											<td><textarea class="form-control text-uppercase" name="details[antidotes]" validate="textarea"><?php echo $details_antidotes;?></textarea></td>
										</tr>
										<tr>
											<td>Other Essential Facilities :</td>
											<td><textarea class="form-control text-uppercase" name="details[other_facilities]" validate="textarea"><?php echo $details_other_facilities;?></textarea></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save and Go to the Next Part" onclick="return confirm('Do you want to save the form ?')">Save and Next</button>
											</td>
										</tr>
									</table>
								</form>
								</div>
								
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
										<tr>
											 <td colspan="4">6. Name of the insecticide(s) and its/their manufacturer/importer which the applicant intends to deal in and status of the principal(s) certificate :</td>
										</tr>
										<tr>
												<td colspan="4">
													<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center" >
														<tr>
															<th width="5%">Sl No.</th>
															<th width="25%">Particulars of insecticide</th>
															<th width="25%">Name of the manufacturer</th>
															<th width="20%">Registration number</th>
															<th width="25%">Detailed principal certificate number./date of issue/validity</th>
														</tr>
													<?php
														$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
														$num2 = $part2->num_rows;
														if($num2>0){
															$count=1;
															while($row_2=$part2->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["parti_insecticide"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input type="text" value="<?php echo $row_2["name"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>" ></td>
																<td><input type="text" value="<?php echo $row_2["registration_no"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>" ></td>
																<td><input type="text" value="<?php echo $row_2["principal_cert"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtE<?php echo $count;?>" ></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
															<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" ></td>
															<td><input type="text" id="txtD1" size="10" class="form-control text-uppercase" name="txtD1" ></td>
															<td><input type="text" id="txtE1" size="10" class="form-control text-uppercase" name="txtE1" ></td>
														</tr>
														<?php } ?>														
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
										</tr>	
											
									<tr>
										 <td colspan="4">7. Complete address of the premises, where the insecticide(s) shall be :</td>				 
									</tr>
									<tr>
										<td width="25%">(a) stored/stocked :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="insecticide_stored_add" validate="textarea"><?php echo $insecticide_stored_add;?></textarea></td>
										<td width="25%">(b) sold or exhibited for sale or issued for use in case of commercial pest control operations :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="insecticide_sold_add" validate="textarea"><?php echo $insecticide_sold_add;?></textarea></td>
									</tr>
									<tr>
										<td>(c) whether any of the above premises is situated in residential area :</td>
										<td><label class="radio-inline"><input type="radio" name="is_residential_area" class="is_residential_area" value="Y"  <?php if(isset($is_residential_area) && $is_residential_area=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_residential_area"  value="N"  name="is_residential_area" <?php if(isset($is_residential_area) && ($is_residential_area=='N' || $is_residential_area=='')) echo 'checked'; ?>/> No</label></td>
										<td>(d) whether food articles are also stored in any of the above premises :</td>
										<td><label class="radio-inline"><input type="radio" name="is_premises" class="is_premises" value="Y"  <?php if(isset($is_premises) && $is_premises=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_premises"  value="N"  name="is_premises" <?php if(isset($is_premises) && ($is_premises=='N' || $is_premises=='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									
									
									<tr>
										 <td colspan="4">8. Full particulars of licence(s), if issued in the name of the applicant by any other state in the area of their jurisdiction :</td>
									</tr>
									<tr>
											<td colspan="4">
												<table name="objectTable3" id="objectTable3" class="table table-responsive table-bordered text-center" >
													<tr>
														<th width="20%">Slno</th>
														<th width="40%">Particulars of licenses</th>
														<th width="40%">State Governments</th>
													</tr>
												<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
														$count=1;
														while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="texttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="texttA<?php echo $count;?>" size="1"></td>
															<td><input id="texttB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["parti_licenses"]; ?>" name="texttB<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_3["st_government"]; ?>" id="texttC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="texttC<?php echo $count;?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text" value="1" id="texttA1" readonly="readonly" size="10" class="form-control text-uppercase" name="texttA1"></td>
														<td><input type="text" id="texttB1" size="10" class="form-control text-uppercase" name="texttB1"></td>
														<td><input type="text" id="texttC1" size="10" class="form-control text-uppercase" name="texttC1" ></td>
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">9. In case of renewal, please state licence number and date of grant :</td>
										</tr>
										<tr>
											<td>Licence number :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $licence_number;?>" name="licence_number" /></td>
											<td>Date of grant :</td>
											<td><input type="text" class="dob form-control text-uppercase" value="<?php echo $date_of_grant;?>" name="date_of_grant" /></td>
										</tr>
										
								
									<tr>
											<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b>
											<br/>Place : <b><label><?php echo strtoupper($dist) ?></label></b>
											</td>
											<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of applicant</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('#is_approval_details').attr('readonly','readonly');
	$('#is_approval_details1').attr('readonly','readonly');
	$('#is_approval_details2').attr('readonly','readonly');
	<?php if($is_approval == 'Y') echo "$('#is_approval_details').removeAttr('readonly','readonly');"; ?>
	<?php if($is_approval == 'Y') echo "$('#is_approval_details1').removeAttr('readonly','readonly');"; ?>
	<?php if($is_approval == 'Y') echo "$('#is_approval_details2').removeAttr('readonly','readonly');"; ?>
	$('.is_approval').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_approval_details').removeAttr('readonly','readonly');
		}else{
			$('#is_approval_details').attr('readonly','readonly');
			$('#is_approval_details').val('');
		}	
		if($(this).val() == 'Y'){
			$('#is_approval_details1').removeAttr('readonly','readonly');
		}else{
			$('#is_approval_details1').attr('readonly','readonly');
			$('#is_approval_details1').val('');
		}	
		if($(this).val() == 'Y'){
			$('#is_approval_details2').removeAttr('readonly','readonly');
		}else{
			$('#is_approval_details2').attr('readonly','readonly');
			$('#is_approval_details2').val('');
		}	
		
	});
	$('#is_qty_details').attr('readonly','readonly');
	$('#is_qty_details1').attr('readonly','readonly');
	<?php if($is_qty == 'Y') echo "$('#is_qty_details').removeAttr('readonly','readonly');"; ?>
	<?php if($is_qty == 'Y') echo "$('#is_qty_details1').removeAttr('readonly','readonly');"; ?>
	$('.is_qty').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_qty_details').removeAttr('readonly','readonly');
		}else{
			$('#is_qty_details').attr('readonly','readonly');
			$('#is_qty_details').val('');
		}	
		if($(this).val() == 'Y'){
			$('#is_qty_details1').removeAttr('readonly','readonly');
		}else{
			$('#is_qty_details1').attr('readonly','readonly');
			$('#is_qty_details1').val('');
		}	
	});
	
	
		
</script>