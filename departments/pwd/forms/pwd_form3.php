<?php  require_once "../../requires/login_session.php"; 
$dept="pwd";
$form="3";
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
			
			$vendor_name=$results["vendor_name"];$reg_number=$results["reg_number"];$application_number=$results["application_number"];$vendor_type=$results["vendor_type"];$fathers_name=$results["fathers_name"];$caste=$results["caste"];$religion=$results["religion"];$date_of_birth=$results["date_of_birth"];$nationality=$results["nationality"];
			$pwrd_wing=$results["pwrd_wing"];
			if(!empty($results["permanent_address"])){
				$permanent_address=json_decode($results["permanent_address"]);
				$street_name1=$permanent_address->sn1;$street_name2=$permanent_address->sn2;$vill=$permanent_address->vill;$dist=$permanent_address->dist;$pincode=$permanent_address->pin;$mobile_no=$permanent_address->mobile_no;
			}else{				
				$permanent_address_sn1="";$permanent_address_sn2="";$permanent_address_vil="";$permanent_address_dist="";$permanent_address_pin="";$permanent_address_mobile_no="";
			}
			if(!empty($results["present_address"])){
				$present_address=json_decode($results["present_address"]);
				$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vil;$present_address_dist=$present_address->dist;$present_address_pincode=$present_address->pincode;$present_address_mno=$present_address->mno;
			}else{				
				$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pincode="";$present_address_mno="";
			}	
			//if(!empty($results["category_class"])){
			//	$category_class=json_decode($results["category_class"]);
			//	$category_class_a=$category_class->a;
			//}else{
			//	$category_class_a="";
			//}
			$category_class=$results["category_class"];
			$financial_det_year=$results["financial_det_year"];$pan_no=$results['pan_no'];$gst_no=$results["gst_no"];$bank_name=$results["bank_name"];$branch_name=$results["branch_name"];$acc_no=$results["acc_no"];
			$reg_date=$results["reg_date"];$reg_renewal_date=$results["reg_renewal_date"];
			$brief_desc=$results["brief_desc"];			
		}else{
			$form_id="";
			$vendor_name="";$reg_number="";$application_number="";$vendor_type="";$fathers_name="";$caste="";$religion="";$date_of_birth="";$nationality="";$pwrd_wing="";
			$permanent_address_sn1="";$permanent_address_sn2="";$permanent_address_vil="";$permanent_address_dist="";$permanent_address_pincode="";$permanent_address_mobile_no="";
			$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pincode="";$present_address_mno="";
			//$category_class_a="";
			$category_class="";
			$financial_det_year="";$pan_no="";$gst_no="";
			$bank_name="";$branch_name="";$acc_no="";
			$reg_date="";$reg_renewal_date="";
			$brief_desc="";
		}			
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		$vendor_name=$results["vendor_name"];$reg_number=$results["reg_number"];$application_number=$results["application_number"];$vendor_type=$results["vendor_type"];$fathers_name=$results["fathers_name"];$caste=$results["caste"];$religion=$results["religion"];$date_of_birth=$results["date_of_birth"];$nationality=$results["nationality"];
		$pwrd_wing=$results["pwrd_wing"];
		if(!empty($results["permanent_address"])){
			$permanent_address=json_decode($results["permanent_address"]);
			$street_name1=$permanent_address->sn1;$street_name2=$permanent_address->sn2;$vill=$permanent_address->vill;$dist=$permanent_address->dist;$pincode=$permanent_address->pin;$mobile_no=$permanent_address->mobile_no;
		}else{				
			$permanent_address_sn1="";$permanent_address_sn2="";$permanent_address_vil="";$permanent_address_dist="";$permanent_address_pin="";$permanent_address_mobile_no="";
		}
		if(!empty($results["present_address"])){
			$present_address=json_decode($results["present_address"]);
			$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vil;$present_address_dist=$present_address->dist;$present_address_pincode=$present_address->pincode;$present_address_mno=$present_address->mno;
		}else{				
			$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pincode="";$present_address_mno="";
		}	
		//if(!empty($results["category_class"])){
		//	$category_class=json_decode($results["category_class"]);
		//	$category_class_a=$category_class->a;
		//}else{
		//	$category_class_a="";
		//}
		//$category_class=$results["category_class"];
		$financial_det_year=$results["financial_det_year"];$pan_no=$results['pan_no'];$gst_no=$results["gst_no"];$bank_name=$results["bank_name"];$branch_name=$results["branch_name"];$acc_no=$results["acc_no"];
		$reg_date=$results["reg_date"];$reg_renewal_date=$results["reg_renewal_date"];
		$brief_desc=$results["brief_desc"];
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
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
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
								</ul>
								<br>
							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
										<tr>
											<td colspan="4">1. Vendor Details</td>
										</tr>
										<tr>
										   <td width="25%">Name :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="vendor_name" value="<?php echo $vendor_name; ?>"></td>
										   <td width="25%">Registration Number :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="reg_number"  value="<?php echo $reg_number; ?>" ></td>
										</tr>
										<tr>
									       <td>Application Number :</td>
										   <td><input type="text" class="form-control text-uppercase" name="application_number"  value="<?php echo $application_number; ?>" ></td>
										   <td></td>
										   <td></td>
										</tr>
										<tr>
										    <td>2. Type of vendor : <span class="mandatory_field">*</span></td>	
											<td><input type="text" class="form-control text-uppercase"  name="vendor_type"  value="<?php echo $vendor_type;?>" required="required" ></td>
											<td>3. Name of father/husband (in case of individual) : </td>	
											<td><input type="text" class="form-control text-uppercase" name="fathers_name"  value="<?php echo $fathers_name; ?>" ></td>
										</tr>
										<tr>
											<td>4. Caste : </td>	
											<td><input type="text" class="form-control text-uppercase" name="caste"  value="<?php echo $caste; ?>" ></td>
											<td>5. Religion : </td>	
											<td><input type="text" class="form-control text-uppercase" name="religion"  value="<?php echo $religion; ?>" ></td>
										</tr>
										<tr>
										    <td>6. Date of Birth : </td>	
											<td><input type="text" class="dobindia form-control text-uppercase" name="date_of_birth" value="<?php if($date_of_birth!="0000-00-00" && $date_of_birth!="") echo date("d-m-Y",strtotime($date_of_birth)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
											<td>7. Nationality : </td>	
											<td><input type="text" class="form-control text-uppercase" name="nationality"  value="<?php echo $nationality; ?>" ></td>
										</tr>
										<tr>
											<td>8. PWRD Wing : <span class="mandatory_field">*</span></td>	
											<td><input type="text" class="form-control text-uppercase" name="pwrd_wing"  value="<?php echo $pwrd_wing; ?>" required="required" ></td>
										</tr> 
										<tr>
											<td colspan="4">9. Permanent Address : <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[sn1]"  value="<?php echo $street_name1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[sn2]"  value="<?php echo $street_name2; ?>" ></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[vill]"   value="<?php echo $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[dist]"  value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[pin]" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="permanent_address[mobile_no]"   value="<?php echo $mobile_no; ?>"></td>
										</tr>
										
										<tr>
											<td colspan="4">10. Present address :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[sn1]" value="<?php echo  $present_address_sn1; ?>"	></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[sn2]" value="<?php echo  $present_address_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[vil]" value="<?php echo  $present_address_vil; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[dist]" value="<?php echo  $present_address_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[pincode]" validate="pincode" maxlength="6" value="<?php echo  $present_address_pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="present_address[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $present_address_mno; ?>"></td>
										</tr>
									
									<tr>
											<td>11. Class & Category : <span class="mandatory_field">*</span></td>
                                            <td><select class="form-control text-uppercase" name="category_class">
                                            <option value="">Please Select</option>
                                            <option value="A" <?php if($category_class=="A") echo "selected";?> >Class I (A)</option>
                                            <option value="B" <?php if($category_class=="B") echo "selected";?>>Class I (B)</option>
                                            <option value="C" <?php if($category_class=="C") echo "selected";?>>Class I (C)</option>
                                            </select></td>
											
											<td>12. Financial Year : <span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="financial_det_year" value="<?php echo $financial_det_year;?>" required="required" ></td>
									</tr>
									<tr>
										<td>13. PAN Number :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="pan_no" value="<?php echo $pan_no;?>" required="required"></td>
										<td>14. GST Number :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="gst_no" value="<?php echo $gst_no;?>" required="required"></td>
									</tr>
									<tr>
										<td colspan="4">15. Bank Details : <span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>Bank Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="bank_name" value="<?php echo $bank_name;?>" required="required"></td>
										<td>Branch Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="branch_name" value="<?php echo $branch_name;?>" required="required"></td>
									</tr>
									<tr>
										<td>Account Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="acc_no" value="<?php echo $acc_no;?>" required="required"></td>
									</tr>
									
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
										</td>
									</tr>
								</table>
							</form> 
							</div>
								
							<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">16. Registration Date :</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="reg_date" value="<?php if($reg_date!="0000-00-00" && $reg_date!="") echo date("d-m-Y",strtotime($reg_date)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
										<td width="25%">17. Registration Renewal Date :</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="reg_renewal_date" value="<?php if($reg_renewal_date!="0000-00-00" && $reg_renewal_date!="") echo date("d-m-Y",strtotime($reg_renewal_date)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
									</tr>
									<tr>
										<td colspan="4">18. Address of Regd. Office (Mandatory for Partnership Firm/Company </td> 
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
										<td width="25%">Street Name2 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo  $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
									</tr>
								
								<tr>
										<td colspan="4">19. Address of Individual/Proprietor in case of Proprietorship Firm.For Partnership firm, include address of all Partners. For Company, include address of designated person <span class="mandatory_field">*</span></td>
								</tr>
									<tr>
										<td colspan="4">
										<table  class="table table-responsive">
										<thead>
											<tr>
												<th width="5%">Sl. No.</th>
												<th width="30%">Partners/Directors Name</th>
												<th width="30%">Age</th>
												<th width="35%">Address</th>
												
											</tr>
										</thead>	
										<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="age<?php echo $i;?>" class="form-control text-uppercase" value="" validate="onlyNumbers"/></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="age<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->age; ?>" validate="onlyNumbers"/></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>		
										</td>
										</tr>
										</table></td>
									</tr>
								<tr>
								    <td colspan="4">20. Contact person/Authorized Signatory details <span class="mandatory_field">*</span></td> 
							    </tr>
								<tr>
									<td width="25%">Name of Authorised Signatory. :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $key_person; ?>"></td>
								</tr>
								<tr>
									<td>Street Name1 :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
									<td>Street Name2 :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $vill; ?>"></td>
									<td>District :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist; ?>"></td>
								</tr>
								<tr>
									<td>Pin Code :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									<td>Mobile No :</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $mobile_no; ?>"></td>
								</tr>
								<tr>
									<td>Email Id :</td>
									<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $email; ?>"></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>		
								<tr>
									<td></td>
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" name="save<?php echo $form; ?>b" class="btn btn-success text-bold submit1">Save and Next</button>
									</td>
								</tr>
								</table>
							</form>
							</div>	
							
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
									    <td colspan="4">21. Completed Works</td>
									</tr>
									<tr>
										<td colspan="4">Works executed in the last 5 years (Current Financial Year not to be included)
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="30%">Prime/Sub Contractor</th>
													<th width="30%">Project Name</th>
													<th width="35%">Details</th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="text1A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="text1A<?php echo $count;?>" size="1"></td>
																							
															<td>
															<select id="text1B<?php echo $count;?>" name="text1B<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_1["contractor_type"]=="P") echo "selected"; ?> value='P' >Prime Contractor</option>
															<option <?php if($row_1["contractor_type"]=="S") echo "selected"; ?> value='S' >Sub Contractor</option>
															</select>
															</td>
																														
															<td><input id="text1C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["project_name"]; ?>" name="text1C<?php echo $count;?>"  size="10"></td>
															<td><input id="text1D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["details"]; ?>" name="text1D<?php echo $count;?>"  size="10"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	
														$i=1; ?>
													<tr>
														<td><input value="1" id="text1A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text1A1"></td>
														<td>
															<select id="text1B1" name="text1B1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='P' >Prime Contractor</option>
																<option value='S' >Sub Contractor</option>
															</select>
														</td>
														<td><input id="text1C1" size="10"   class="form-control text-uppercase" name="text1C1"></td>	
														<td><input id="text1D1" size="10"   class="form-control text-uppercase" name="text1D1"></td>	
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
										<td colspan="4">22. Quantities of work executed in the last 6 years (Current Financial Year not to be included) 
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
											<thead>
											<tr>
												<th width="5%">Sl. No.</th>
												<th width="25%">Prime/Sub Contractor</th>
												<th width="25%">Work Item</th>
												<th width="25%">Quantity</th>
												<th width="20%">Financial Year</th>
												
											</tr>
											</thead>
											<?php
												$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){	?>
													<tr>
														<td><input readonly id="text2A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="text2A<?php echo $count;?>" size="1"></td>
																						
														<td>
															<select id="text2B<?php echo $count;?>" name="text2B<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_2["contractor_type"]=="P") echo "selected"; ?> value='P' >Prime Contractor</option>
															<option <?php if($row_2["contractor_type"]=="S") echo "selected"; ?> value='S' >Sub Contractor</option>
															</select>
														</td>
																														
														<td><input id="text2C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["work_item"]; ?>" name="text2C<?php echo $count;?>"  size="10"></td>
														<td><input id="text2D<?php echo $count;?>"  class=" form-control text-uppercase" value="<?php echo $row_2["quantity"]; ?>"name="text2D<?php echo $count;?>"  size="10" validate="onlyNumbers"></td>
														<td><input id="text2E<?php echo $count;?>"  class=" form-control text-uppercase" value="<?php echo $row_2["fin_year"]; ?>"name="text2E<?php echo $count;?>"  size="10" validate="onlyNumbers"></td>
														
														
												   </tr>
												<?php $count++; } 
												}else{
													$i=1; ?>
													<tr>
														<td><input value="1" id="text2A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text2A1"></td>
														<td>
															<select id="text2B1" name="text2B1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='P' >Prime Contractor</option>
																<option value='S' >Sub Contractor</option>
															</select>
														</td>
														<td><input id="text2C1" size="10" class="form-control text-uppercase" name="text2C1"></td>	
														<td><input id="text2D1" size="10" class="form-control text-uppercase" name="text2D1" validate="onlyNumbers"></td>	
														<td><input id="text2E1" size="10" class="form-control text-uppercase" name="text2E1" validate="onlyNumbers"></td>
														
													</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
											</div>
										</td>
									</tr>

									<tr>
										<td colspan="4"> 23. On going works
										<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Prime/Sub Contractor</th>
													<th width="30%">Project Name</th>
													<th width="30%">Details</th>
												</tr>
												</thead>
												<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="text3A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="text3A<?php echo $count;?>" size="1"></td>
																							
															<td>
															<select id="text3B<?php echo $count;?>" name="text3B<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_3["contractor_type"]=="P") echo "selected"; ?> value='P' >Prime Contractor</option>
															<option <?php if($row_3["contractor_type"]=="S") echo "selected"; ?> value='S' >Sub Contractor</option>
															</select>
															</td>
																														
															<td><input id="text3C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["project_name"]; ?>" name="text3C<?php echo $count;?>"  size="10"></td>
															<td><input id="text3D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["details"]; ?>" name="text3D<?php echo $count;?>"  size="10"></td>
														</tr>	
													<?php $count++; } 
													}else{?>
													<tr>
														<td><input value="1" id="text3A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text3A1"></td>
														<td>
															<select id="text3B1" name="text3B1" class="form-control text-uppercase">
																<option value='' >Select Type</option>
																<option value='P' >Prime Contractor</option>
																<option value='S' >Sub Contractor</option>
															</select>
														</td>
														<td><input id="text3C1" size="10" class="form-control text-uppercase" name="text3C1"></td>	
														<td><input id="text3D1" size="10" class="form-control text-uppercase" name="text3D1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
											</div>
										</td>
									</tr>	
									<tr>
										<td colspan="4"> 24. Key Personnel for Works and Administration <span class="mandatory_field">*</span>
										<table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="20%">Work Position</th>
													<th width="25%">Name</th>
													<th width="25%">Qualification</th>
													<th width="20%">Experience</th>
												</tr>
												</thead>
												<?php
													$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
													$num4 = $part4->num_rows;
													if($num4>0){
													  $count=1;
													  while($row_4=$part4->fetch_array()){	?>
													  <tr>
															<td><input readonly id="text4A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="text4A<?php echo $count;?>" size="1"></td>
																							
															<td>
															<select id="text4B<?php echo $count;?>" name="text4B<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select </option>
															<option <?php if($row_4["work_position"]=="M") echo "selected"; ?> value='M' >Project Manager</option>
															<option <?php if($row_4["work_position"]=="J") echo "selected"; ?> value='J' >Junior Engineer</option>
															<option <?php if($row_4["work_position"]=="F") echo "selected"; ?> value='F' >Field Engineer</option>
															</select>
															</td>
																														
															<td><input id="text4C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["personnel_name"]; ?>" name="text4C<?php echo $count;?>"  size="10"></td>
															
															<td>
															<select id="text4D<?php echo $count;?>" name="text4D<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select </option>
															<option <?php if($row_4["qualification"]=="B") echo "selected"; ?> value='B'>BE Civil</option>
															<option <?php if($row_4["qualification"]=="D") echo "selected"; ?> value='D'>Diploma in Civil Engineering</option>
															</select>
															</td>
															
															<td><input id="text4E<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["experience"]; ?>" validate="onlyNumbers" name="text4E<?php echo $count;?>"  size="10"></td>
														</tr>
														<?php $count++; } 
														}else{?>
														<tr>
															<td><input value="1" id="text4A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text4A1"></td>
															<td>
																<select id="text4B1" name="text4B1" class="form-control text-uppercase">
																	<option value='' >Select</option>
																	<option value='P' >Project Manager</option>
																	<option value='J' >Junior Engineer</option>
																	<option value='F' >Field Engineer</option>
																</select>
															</td>
															<td><input id="text4C1" size="10"   class="form-control text-uppercase" name="text4C1"></td>	
															<td>
																<select id="text4D1" name="text4D1" class="form-control text-uppercase">
																	<option value='' >Select</option>
																	<option value='B'>BE Civil</option>
																	<option value='D'>Diploma in Civil Engineering</option>
																</select>
															</td>
															<td><input id="text4E1" size="10" class="form-control text-uppercase" name="text4E1"validate="onlyNumbers"></td>
														</tr>
														<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
											</div>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
											<button type="submit" name="save<?php echo $form; ?>c" class="btn btn-success text-bold submit1">Save and Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
							
							<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
							<form name="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">25. Details of Machinery Owned 
											<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Type of Equipment</th>
													<th width="30%">Numbers Owned</th>
													<th width="30%">Machinery Details</th>
												</tr>
												</thead>
												<?php
													$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
													$num5 = $part5->num_rows;
													if($num5>0){
													  $count=1;
													  while($row_5=$part5->fetch_array()){	?>
														<tr>
															<td><input readonly id="text5A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="text5A<?php echo $count;?>" size="1"></td>
															<td><input id="text5B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["type_of_equipment"]; ?>" name="text5B<?php echo $count;?>"  size="10"></td>												
															<td><input id="text5C<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $row_5["numbers_owned"]; ?>" name="text5C<?php echo $count;?>"  size="10"></td>
															<td><input id="text5D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["machinery_details"]; ?>" name="text5D<?php echo $count;?>"  size="10"></td>
														</tr>	
													<?php $count++; } 
													}else{	
														$i=1; ?>
													<tr>
														<td><input value="1" id="text5A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text5A1"></td>
														<td><input id="text5B1" size="10"   class="form-control text-uppercase" name="text5B1"></td>
														<td><input id="text5C1" size="10"   class="form-control text-uppercase" name="text5C1"validate="onlyNumbers"></td>	
														<td><input id="text5D1" size="10" class="form-control text-uppercase" name="text5D1" ></td>	
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/>
											</div>
										</td>
									</tr>		
									<tr>
										<td colspan="4">26. Financial Turnover from Civil Engineering Works in the Last 5 years (Current Financial Year Not To Be Included)
											<table name="objectTable6" id="objectTable6" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="20%">Sl. No.</th>
													<th width="40%">Financial Year</th>
													<th width="40%">Turnover(INR)</th>													
												</tr>
												</thead>
												<?php
													$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
													$num6 = $part6->num_rows;
													if($num6>0){
													  $count=1;
													  while($row_6=$part6->fetch_array()){	?>
														<tr>
															<td><input readonly id="text6A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="text6A<?php echo $count;?>" size="1"></td>
															<td><input id="text6B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["financial_year"]; ?>" name="text6B<?php echo $count;?>"  size="10" validate="onlyNumbers"></td>
															<td><input id="text6C<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $row_6["turnover"]; ?>" name="text6C<?php echo $count;?>" size="10"></td>
															<td>
														</tr>
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="text6A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text6A1"></td>
														<td><input id="text6B1" size="10" class="form-control text-uppercase" name="text6B1" validate="onlyNumbers"></td>
														<td><input id="text6C1" size="10" class="form-control text-uppercase" name="text6C1" validate="onlyNumbers"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore6()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/>
											</div>
										</td>
									</tr>		
									<tr>
										<td colspan="4">27. Litigation History
											<table name="objectTable7" id="objectTable7" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="35%">Employer</th>
													<th width="40%">Cause of Dispute</th>
													<th width="20%">Status</th>													
												</tr>
												</thead>
												<?php
													$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
													$num7 = $part7->num_rows;
													if($num7>0){
													  $count=1;
													  while($row_7=$part7->fetch_array()){	?>
														<tr>
															<td><input readonly id="text7A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["slno"]; ?>" name="text7A<?php echo $count;?>" size="1"></td>
															<td><input id="text7B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["employer"]; ?>" name="text7B<?php echo $count;?>"  size="10"></td>
															<td><input id="text7C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["cause_of_dispute"]; ?>" name="text7C<?php echo $count;?>" size="10"></td>
															<td><input id="text7D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["status"]; ?>" name="text7D<?php echo $count;?>" size="10"></td>
														</tr>
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="text7A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text7A1"></td>
														<td><input id="text7B1" size="10" class="form-control text-uppercase" name="text7B1"></td>
														<td><input id="text7C1" size="10" class="form-control text-uppercase" name="text7C1"></td>
														<td><input id="text7D1" size="10" class="form-control text-uppercase" name="text7D1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore7()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction7()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/>
											</div>
										</td>
									</tr>
									<tr>
										<td colspan="4">28. Vendor History
											<table name="objectTable8" id="objectTable8" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="25%">Class</th>
													<th width="40%">Action</th>		
													<th width="30%">Date</th>													
												</tr>
												</thead>
												<?php
													$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
													$num8 = $part8->num_rows;
													if($num8>0){
													  $count=1;
													  while($row_8=$part8->fetch_array()){	?>
														<tr>
															<td><input readonly id="text8A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["slno"]; ?>" name="text8A<?php echo $count;?>" size="1"></td>
															<td><input id="text8B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["class1"]; ?>" name="text8B<?php echo $count;?>"  size="10"></td>
															<td><input id="text8C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["action1"]; ?>" name="text8C<?php echo $count;?>" size="10"></td>
															<td><input type="text" class="dobindia form-control text-uppercase" name="text8D<?php echo $count;?>" value="<?php if($row_8["date1"]!="0000-00-00" && $row_8["date1"]!="") echo date("d-m-Y",strtotime($row_8["date1"])); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
														</tr>
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="text8A1" readonly="readonly" size="10" class="form-control text-uppercase" name="text8A1"></td>
														<td><input id="text8B1" size="10" class="form-control text-uppercase" name="text8B1"></td>
														<td><input id="text8C1" size="10" class="form-control text-uppercase" name="text8C1"></td>
														<td><input id="text8D1" size="10" class="dobindia form-control text-uppercase" name="text8D1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore8()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction8()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/>
											</div>
										</td>
									</tr>
									
									<tr>
										<td width="25%">29. Brief description of requirement :</td>
										<td width="25%"><textarea name="brief_desc"  class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $brief_desc; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label></td>
										<td colspan="2" align="right">Signature: <strong><?php echo strtoupper($key_person)?></strong><br/>
										Name: <label><?php echo strtoupper($key_person)?></strong>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
											<button type="submit" name="save<?php echo $form; ?>d" class="btn btn-success text-bold submit1">Save and Next</button>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>