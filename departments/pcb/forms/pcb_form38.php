<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="38";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_plastic_form.php";
	

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$com_date=$results["com_date"];$no_worker=$results["no_worker"];$disposal_detail=$results["disposal_detail"];$facilities_detail=$results["facilities_detail"];$is_indus_provided=$results["is_indus_provided"];$adq_system=$results["adq_system"];$is_compliance=$results["is_compliance"];$is_condition=$results["is_condition"];$is_processed=$results["is_processed"];$other_info=$results["other_info"];
				
		if(!empty($results["contact_person"])){
			$contact_person=json_decode($results["contact_person"]);
			$contact_person_name=$contact_person->name;$contact_person_desig=$contact_person->desig;$contact_person_email=$contact_person->email;$contact_person_m_no=$contact_person->m_no;
		}else{
			$contact_person_name="";$contact_person_desig="";$contact_person_email="";$contact_person_m_no="";
		}
		if(!empty($results["const_validate"])){
			$const_validate=json_decode($results["const_validate"]);
			$const_validate_air=$const_validate->air;$const_validate_water=$const_validate->water;$const_validate_valid_date=$const_validate->valid_date;
		}else{
			$const_validate_air="";$const_validate_water="";$const_validate_valid_date="";
		}
		if(!empty($results["plastic_waste"])){
			$plastic_waste=json_decode($results["plastic_waste"]);
			$plastic_waste_name=$plastic_waste->name;$plastic_waste_qty=$plastic_waste->qty;
		}else{
			$plastic_waste_name="";$plastic_waste_qty="";
		}
	}else{				
		$form_id="";$com_date="";$no_worker="";$disposal_detail="";$facilities_detail="";$is_indus_provided="";$adq_system="";$is_compliance="";$is_condition="";$is_processed="";$other_info="";
		$contact_person_name="";$contact_person_desig="";$contact_person_email="";$contact_person_m_no="";
		$const_validate_air="";$const_validate_water="";$const_validate_valid_date="";
		$plastic_waste_name="";$plastic_waste_qty="";
	}
}else{	
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$com_date=$results["com_date"];$no_worker=$results["no_worker"];$disposal_detail=$results["disposal_detail"];$facilities_detail=$results["facilities_detail"];$is_indus_provided=$results["is_indus_provided"];$adq_system=$results["adq_system"];$is_compliance=$results["is_compliance"];$is_condition=$results["is_condition"];$is_processed=$results["is_processed"];$other_info=$results["other_info"];
			
	if(!empty($results["contact_person"])){
		$contact_person=json_decode($results["contact_person"]);
		$contact_person_name=$contact_person->name;$contact_person_desig=$contact_person->desig;$contact_person_email=$contact_person->email;$contact_person_m_no=$contact_person->m_no;
	}else{
		$contact_person_name="";$contact_person_desig="";$contact_person_email="";$contact_person_m_no="";
	}
	if(!empty($results["const_validate"])){
		$const_validate=json_decode($results["const_validate"]);
		$const_validate_air=$const_validate->air;$const_validate_water=$const_validate->water;$const_validate_valid_date=$const_validate->valid_date;
	}else{
		$const_validate_air="";$const_validate_water="";$const_validate_valid_date="";
	}
	if(!empty($results["plastic_waste"])){
		$plastic_waste=json_decode($results["plastic_waste"]);
		$plastic_waste_name=$plastic_waste->name;$plastic_waste_qty=$plastic_waste->qty;
	}else{
		$plastic_waste_name="";$plastic_waste_qty="";
	}				
}
?>

	<?php require_once "../../requires/header.php";   ?>
	  <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
                            <div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1" id="myformBT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Name and Address of the unit :</td>
										<td width="25%"> </td>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No</td>
		                             <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Contact person with designation,Tel./email :</td>
									</tr>
									<tr>
										<td>Full Name</td>
										<td><input type="text" class="form-control text-uppercase" name="contact_person[name]"value="<?php echo $contact_person_name;?>" validate="letters"></td>
										<td>Designation</td>
										<td><input type="text" class="form-control text-uppercase" name="contact_person[desig]" value="<?php echo $contact_person_desig;?>"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" name="contact_person[m_no]" maxlength="10" value="<?php echo $contact_person_m_no;?>"></td>
										<td>Email-Id</td>
		                            <td><input type="email" class="form-control" name="contact_person[email]" value="<?php echo $contact_person_email;?>"></td>
									</tr>
									<tr>
										<td>3. Date of commencement :</td>
										<td><input type="text" class="dob form-control text-uppercase" readonly="readonly" name="com_date" value="<?php echo $com_date;?>"></td>
										<td>4. No. of workers (including contract labour) :</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_worker" value="<?php echo $no_worker;?>" ></td>
									</tr>
									<tr>
										<td colspan="4">5. Consents Validity</td>
									</tr>
									<tr>
										<td>a. Water (Prevention & Control of Pollution) Act, 1974;Valid up to</td>
										<td><input type="text" class="dob form-control text-uppercase" name="const_validate[water]" value="<?php echo $const_validate_water;?>"></td>
										<td>b. Air (Prevention & Control of Pollution) Act, 1981;Valid up to</td>
										<td><input type="text" class="dob form-control text-uppercase" name="const_validate[air]" value="<?php echo $const_validate_air;?>"></td>
									</tr>
									<tr>
										<td>c. Authorization ; valid up to</td>
										<td><input type="text" class="dob form-control text-uppercase" name="const_validate[valid_date]"value="<?php echo $const_validate_valid_date;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>6. Manufacturing Process :</td>
										<td colspan="3">Please attach a flow diagram of the manufacturing process flowdiagram for each product.</td>
									</tr>
									<tr>
										<td colspan="4">7. Products and installed capacity of production (MTA) :
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
										<tbody>
											<tr>
											   <td align="center" width="5%">Sl No.</td>
											   <td align="center" width="50%">Products</td>
											   <td align="center">Installed capacity</td>
											</tr>
											<?php
									$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
									$num = $part1->num_rows;
									if($num>0){
									  $count=1;
									  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly  id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["product"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
											<td><input value="<?php echo $row_1["capacity"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input  value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
										<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
										<td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</td>
								</tr>
									<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
									</tr>
									<tr>
										<td colspan="4">8. Waste Management </td>
									</tr>
									<tr>
										<td colspan="4">a. Waste generation in processing plastic-waste :
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Type</td>
										   <td align="center">Category</td>
										   <td align="center">Quantity</td>
										</tr>
									   <?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num = $part2->num_rows;
										if($num>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly  id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["type"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["category"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>	
											<td><input value="<?php echo $row_2["qty"]; ?>"  id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="20"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
										<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
										<td><input id="textD1" size="20" class="form-control text-uppercase" name="textD1"></td>
									</tr>
									<?php } ?>
									</tbody>
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
										<td colspan="2">b. Waste Collection and transportation (attach details) :</td>
										<td >Upload later in Upload Section </td>
									</tr>
									<tr>
										<td colspan="4">c. Waste Disposal details :
									<table name="objectTable3" id="objectTable3" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Type</td>
										   <td align="center">Category</td>
										   <td align="center">Quantity</td>
										</tr>
									   <?php
										$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
										$num = $part3->num_rows;
										if($num>0){
										  $count=1;
										  while($row_3=$part3->fetch_array()){	?>
										<tr>
											<td><input readonly  id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_3["type"]; ?>" id="txttB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_3["category"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="20"></td>	
											<td><input value="<?php echo $row_3["qty"]; ?>"  id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="20"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
										<td><input id="txttB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txttB1"></td>					
										<td><input  id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>
										<td><input id="txttD1" size="20" class="form-control text-uppercase" name="txttD1"></td>
									</tr>
									<?php } ?>
									</tbody>
									</table>
									</td>
								</tr>
									<tr>
									<td colspan="4">
										
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
										<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
									</td>
								</tr>
									<tr>
										<td>d. Provide details of the disposal facility, whether the facility is authorized by SPCB or PCC</td>
										<td><textarea class="form-control text-uppercase" name="disposal_detail"> <?php echo $disposal_detail;?></textarea></td>
										<td>e. Please attach analysis report of characterization ofwaste generated (including leachate test if applicable) :</td>
										<td >Upload later in Upload Section</td>
									</tr>
									<tr>
										<td colspan="4">9. Details of plastic waste proposed to be acquired through sale, auction, contract or import, as the case may be, for use as raw material :</td>
									</tr>
									<tr>
										<td>(i) Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="plastic_waste[name]" value="<?php echo $plastic_waste_name;?>"></td>
										<td>(ii)Quantity required /year :</td>
										<td><input type="text" class="form-control text-uppercase" name="plastic_waste[qty]" value="<?php echo $plastic_waste_qty;?>"></td>
									</tr>
									<tr>
										<td colspan="3">10. Occupational safety and health aspects(Please provide details of facilities) :</td>
										<td><textarea name="facilities_detail" id="facilities_detail" class="form-control text-uppercase" validate="textarea" ><?php echo $facilities_detail; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="4">11. Pollution Control Measures :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td colspan="3">(a)Whether the unit has adequate pollution control systems or equipment to meet the standards of emission or effluent. :</td>
										<td width="25%"><label class="radio-inline"><input type="radio" name="is_indus_provided" value="Y"  <?php if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_indus_provided"  value="N"  <?php if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
								</tr>
									<tr>
									<td width="25%">If Yes, please furnish details :<br/></td>
									<td><textarea name="adq_system" id="adq_system" class="form-control text-uppercase" validate="textarea" ><?php if(isset($adq_system)) echo $adq_system; ?></textarea></td>
									<td></td>
									<td></td>
								</tr> 
									<tr>
										<td colspan="3">(b)Whether unit is in compliance with conditions laid down in the said rules. :</td>
										<td><label class="radio-inline"><input type="radio" name="is_compliance" value="Y"  <?php if(isset($is_compliance) && $is_compliance=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_compliance"  value="N"  <?php if(isset($is_compliance) && $is_compliance=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td colspan="3">(c)Whether conditions exist or are likely to exist of the material being handled or processed posing adverse immediate or delayed impacts on the environment. :</td>
										<td><label class="radio-inline"><input type="radio" name="is_condition" value="Y"  <?php if(isset($is_condition) && $is_condition=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_condition"  value="N"  <?php if(isset($is_condition) && $is_condition=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td colspan="3">(d)Whether conditions exist (or are likely to exist) of the material being handled or processed by any means capable of yielding another material (e.g. leachate) which may possess eco-toxicity. :</td>
										<td><label class="radio-inline"><input type="radio" name="is_processed" value="Y"  <?php if(isset($is_processed) && $is_processed=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" name="is_processed"  value="N"  <?php if(isset($is_processed) && $is_processed=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>12. Any other relevant information including fire or accident mitigative measures :</td>
										<td><input type="text" name="other_info"  value="<?php echo $other_info; ?>" class="form-control text-uppercase" /></td>
										<td>13. List of enclosures as per rule :<span class="mandatory_field">*</span></td>
										<td >Upload later in Upload Section</td>
									</tr>
									<tr>
										<td>Date</td>
										<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>										
										<td>Signature of the authorized person</td>
										<td><label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><label><?php echo strtoupper($dist); ?></label></td>
										<td>Designation</td>
										<td><label> <?php echo $status_applicant;?></label></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	$('#adq_system').show();
	<?php if($is_indus_provided=="N" || $is_indus_provided==" "){ ?>
		$('#adq_system').attr('disabled', 'disabled');
		$('#adq_system').hide();
	<?php }?>
	$('input[name="is_indus_provided"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#adq_system').removeAttr('disabled', 'disabled');			
			$('#adq_system').show();			
		}else{
			$('#adq_system').attr('disabled', 'disabled');	
			$('#adq_system').hide();			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>