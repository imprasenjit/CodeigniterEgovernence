<?php  require_once "../../requires/login_session.php";
$dept="cei";
$form="31";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_cei_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$exam_name=$results["exam_name"];$certificate_class=$results["certificate_class"];$applicant_name=$results["applicant_name"];$birth_place=$results["birth_place"];$birth_date=$results["birth_date"];$is_citizen=$results["is_citizen"];$is_citizen_details=$results["is_citizen_details"];$father_name=$results["father_name"];$father_nationality=$results["father_nationality"];$centre=$results["centre"];$language=$results["language"];$test_name=$results["test_name"];$challan=$results["challan"];$challan_date=$results["challan_date"];$amount=$results["amount"];$rupees=$results["rupees"];$treasury=$results["treasury"];
		
		if(!empty($results["home"])){
			$home=json_decode($results["home"]);
			$home_sn1=$home->sn1;$home_sn2=$home->sn2;$home_vill=$home->vill;$home_dist=$home->dist;$home_pincode=$home->pincode;$home_mobile=$home->mobile;
		}else{				
			$home_sn1="";$home_sn2="";$home_vill="";$home_dist="";$home_pincode="";$home_mobile="";
		}	
		
		if(!empty($results["present"])){
			$present=json_decode($results["present"]);
			$present_sn1=$present->sn1;$present_sn2=$present->sn2;$present_vill=$present->vill;$present_dist=$present->dist;$present_pincode=$present->pincode;$present_mobile=$present->mobile;
		}else{				
			$present_sn1="";$present_sn2="";$present_vill="";$present_dist="";$present_pincode="";$present_mobile="";
		}

		if(!empty($results["details"])){
			$details=json_decode($results["details"]);
			$details_tech=$details->tech; $details_cert=$details->cert;$details_permit=$details->permit;$details_reg_no=$details->reg_no;$details_date=$details->date;$details_issue=$details->issue;
		}else{				
			$details_tech="";$details_cert="";$details_permit="";$details_reg_no="";$details_date="";$details_issue="";
		}	
		
		if(!empty($results["service"])){
			$service=json_decode($results["service"]);
			$service_commence=$service->commence;$service_terminate=$service->terminate;
		}else{				
			$service_commence="";$service_terminate="";
		}		
	}else{
		$form_id="";
		$exam_name="";$certificate_class="";$applicant_name="";$birth_place="";$birth_date="";$is_citizen="";$is_citizen_details="";$father_name="";$father_nationality="";$centre="";$language="";$test_name="";$challan="";$challan_date="";$amount="";$rupees="";$treasury="";
		$home_sn1="";$home_sn2="";$home_vill="";$home_dist="";$home_pincode="";$home_mobile="";
		$present_sn1="";$present_sn2="";$present_vill="";$present_dist="";$present_pincode="";$present_mobile="";
		$details_tech="";$details_cert="";$details_permit="";$details_reg_no="";$details_date="";$details_issue="";
		$service_commence="";$service_terminate="";
	}
}else{
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$exam_name=$results["exam_name"];$certificate_class=$results["certificate_class"];$applicant_name=$results["applicant_name"];$birth_place=$results["birth_place"];$birth_date=$results["birth_date"];$is_citizen=$results["is_citizen"];$is_citizen_details=$results["is_citizen_details"];$father_name=$results["father_name"];$father_nationality=$results["father_nationality"];$centre=$results["centre"];$language=$results["language"];$test_name=$results["test_name"];$challan=$results["challan"];$challan_date=$results["challan_date"];$amount=$results["amount"];$rupees=$results["rupees"];$treasury=$results["treasury"];
		
	if(!empty($results["home"])){
		$home=json_decode($results["home"]);
		$home_sn1=$home->sn1;$home_sn2=$home->sn2;$home_vill=$home->vill;$home_dist=$home->dist;$home_pincode=$home->pincode;$home_mobile=$home->mobile;
	}else{				
		$home_sn1="";$home_sn2="";$home_vill="";$home_dist="";$home_pincode="";$home_mobile="";
	}	
	
	if(!empty($results["present"])){
		$present=json_decode($results["present"]);
		$present_sn1=$present->sn1;$present_sn2=$present->sn2;$present_vill=$present->vill;$present_dist=$present->dist;$present_pincode=$present->pincode;$present_mobile=$present->mobile;
	}else{				
		$present_sn1="";$present_sn2="";$present_vill="";$present_dist="";$present_pincode="";$present_mobile="";
	}

	if(!empty($results["details"])){
		$details=json_decode($results["details"]);
		$details_tech=$details->tech; $details_cert=$details->cert;$details_permit=$details->permit;$details_reg_no=$details->reg_no;$details_date=$details->date;$details_issue=$details->issue;
	}else{				
		$details_tech="";$details_cert="";$details_permit="";$details_reg_no="";$details_date="";$details_issue="";
	}	
	
	if(!empty($results["service"])){
		$service=json_decode($results["service"]);
		$service_commence=$service->commence;$service_terminate=$service->terminate;
	}else{				
		$service_commence="";$service_terminate="";
	}
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Examination  test  for  which  the  candidate proposes to appear : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="exam_name"  value="<?php echo $exam_name; ?>"></td>
											<td width="25%">2. Class of certificate of competency permit for which he is a candidate : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="certificate_class"  value="<?php echo $certificate_class; ?>"></td>
										</tr>
										<tr>											
											<td>3. Name of applicant (in block letters) : </td>
											<td><input type="text" class="form-control text-uppercase" name="applicant_name"  value="<?php echo $applicant_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>						
											<td>4. (a) Place of birth :</td>
											<td><input type="text" class="form-control text-uppercase" name="birth_place"  value="<?php echo $birth_place; ?>"></td>
											<td>(b) Date of birth (certificate  showing age shall be attached) : </td>
											<td><input type="text" class="dob form-control" name="birth_date"  value="<?php echo  $birth_date; ?>"></td>											
										</tr>
										<tr>
											<td colspan="4">5. Home Address (in full) :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[sn1]" value="<?php echo $home_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[sn2]" value="<?php echo $home_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[vill]" value="<?php echo $home_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[dist]" value="<?php echo $home_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[pincode]"validate="pincode" maxlength="6" value="<?php echo $home_pincode; ?>" ></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="home[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $home_mobile; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">6. Present Address (in full) :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[sn1]" value="<?php echo $present_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[sn2]" value="<?php echo $present_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[vill]" value="<?php echo $present_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[dist]" value="<?php echo $present_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[pincode]"validate="pincode" maxlength="6" value="<?php echo $present_pincode; ?>" ></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="present[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $present_mobile; ?>" ></td>
										</tr>
										<tr>
											<td>7. (a) Are you a citizen of India if so, how? </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_citizen" class="is_citizen" value="Y"  <?php if(isset($is_citizen) && $is_citizen=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="is_citizen"  value="N"  name="is_citizen" <?php if(isset($is_citizen) && ($is_citizen=='N' || $is_citizen=='')) echo 'checked'; ?>/> No</label>
											</td>
											<td>How? </td>
											<td><input  type="text" name="is_citizen_details" id="is_citizen_details" value="<?php echo $is_citizen_details; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>7. (b) Name of your father :</td>
											<td><input type="text" class="form-control text-uppercase" name="father_name"  value="<?php echo $father_name; ?>"></td>
											<td> Nationality of your father :</td>
											<td><input type="text" class="form-control text-uppercase" name="father_nationality"  value="<?php echo $father_nationality; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">8. Details of qualification (attested copies of certificates are to be enclosed and for the purpose of following columns (a) (b) (c) (d) Extra sheet may be annexed to this form if space is not found adequate) : </td>
										</tr>
										<tr>
											<td>(a) Academic & technical qualification : </td>
											<td><input type="text" class="form-control text-uppercase" name="details[tech]" value="<?php echo $details_tech; ?>"></td>
											<td>(b) Regd. No. of certificate of competency (if any) issued by the electrical Licensing Board Assam : </td>
											<td><input type="text" class="form-control text-uppercase" name="details[cert]" value="<?php echo $details_cert; ?>"></td>
										</tr>
										<tr>
											<td>(c) Regd. No. of Permit (if any issued by the Electrical Licensing Board, Assam : </td>
											<td><input type="text" class="form-control text-uppercase" name="details[permit]" value="<?php echo $details_permit; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>(d) Regd. No. and date of issue of the Certificate of competency/permit issued by other authority, if any (state name of issuing authority)  :</td>
											<td><input type="text" class="form-control text-uppercase" name="details[reg_no]" value="<?php echo $details_reg_no; ?>" placeholder="Registration Number"></td>
											<td><input type="text" class="dob form-control" name="details[date]" value="<?php echo $details_date; ?>" placeholder="Date of issue" ></td>
											<td><input type="text" class="form-control text-uppercase" name="details[issue]" value="<?php echo $details_issue; ?>" placeholder="Name of issuing authority"></td>
										</tr>
										<tr>
											<td colspan="4">9. Details of past and present service (date of commencement and termination of each appointment to be given, if necessary, extra sheet may be annexed to this form :</td>
										</tr>
										<tr>
											<td><strong>PAST SERVICE</strong></td>
											<td colspan="3">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
												<tr>
													<th>Sl. No.</th>
													<th>Date of Commencement</th>
													<th>Date of Termination</th>
												</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["commencement"]; ?>" id="txtB<?php echo $count;?>" class="dob form-control" name="txtB<?php echo $count;?>"></td>															
														<td><input value="<?php echo $row_1["termination"]; ?>" id="txtC<?php echo $count;?>" class="dob form-control" name="txtC<?php echo $count;?>" ></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="dob form-control" name="txtB1"></td>	<td><input id="txtC1" class="dob form-control" name="txtC1"></td>
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4"><strong>PRESENT SERVICE</strong></td>
										</tr>
										<tr>											
											<td>(a) Date of Commencement : </td>
											<td><input type="text" class="dob form-control" name="service[commence]"  value="<?php echo  $service_commence; ?>"></td>
											<td>(b) Date of Termination : </td>
											<td><input type="text" class="dob form-control" name="service[terminate]"  value="<?php echo  $service_terminate; ?>"></td>
										</tr>
										<tr>
											<td>10. Centre of Examination : </td>
											<td colspan="3">
												<label class="radio-inline"><input type="radio" value="G" name="centre" <?php if($centre=='G'|| $centre=='') echo 'checked'; ?> />&nbsp;Guwahati</label>
												<label class="radio-inline"><input type="radio" value="J" name="centre" <?php if($centre=='J') echo 'checked'; ?> >&nbsp;Jorhat</label>
												<label class="radio-inline"><input type="radio" value="S" name="centre" <?php if($centre=='S') echo 'checked'; ?> >&nbsp;Silchar</label>
												<label class="radio-inline"><input type="radio" value="D" name="centre" <?php if($centre=='D') echo 'checked'; ?> >&nbsp;Dibrugarh</label>
												<label class="radio-inline"><input type="radio" value="T" name="centre" <?php if($centre=='T') echo 'checked'; ?> >&nbsp;Tezpur</label>
											</td>
										</tr>
										<tr>
											<td>11. Language  in  which  candidate  desires  to  be examined : </td>
											<td colspan="3">
												<label class="radio-inline"><input type="radio" value="A" name="language" <?php if($language=='A') echo 'checked'; ?> />&nbsp;Assamese</label>
												<label class="radio-inline"><input type="radio" value="B" name="language" <?php if($language=='B') echo 'checked'; ?> >&nbsp;Bengali</label>
												<label class="radio-inline"><input type="radio" value="E" name="language" <?php if($language=='E' || $language=='') echo 'checked'; ?> >&nbsp;English</label>
											</td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I am  a  candidate  for &nbsp;<input type="text"  class="form-control text-uppercase" name="test_name" value="<?php echo $test_name;?>" >&nbsp;  examination  and  test  and  the facts stated above are true to the best of my knowledge and belief. In case of any false statement I shall be liable for any action the Board may deem fit and proper. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											A treasury challan No &nbsp;<input type="text"  class="form-control text-uppercase" name="challan" value="<?php echo $challan;?>" >&nbsp; dated &nbsp;<input type="text"  class="dob form-control" name="challan_date" value="<?php echo $challan_date;?>" >&nbsp; for Rs. &nbsp;<input type="text"  class="form-control text-uppercase" name="amount" value="<?php echo $amount;?>" validate="onlyNumbers" >&nbsp; (Rupees &nbsp;<input type="text" class="form-control text-uppercase" name="rupees" value="<?php echo $rupees;?>" validate="letters">&nbsp;)  only   deposited   to   the   bank   through  &nbsp;<input type="text"  class="form-control text-uppercase" name="treasury" value="<?php echo $treasury;?>"> &nbsp; Treasury is enclosed herewith. 
											</td>
										</tr>
										<tr>
											<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right"><br/> Signature of applicant :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($applicant_name)?></strong></td>
										</tr>
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */	
	$('#is_citizen_details').attr('readonly','readonly');
	<?php if($is_citizen == 'Y') echo "$('#is_citizen_details').removeAttr('readonly','readonly');"; ?>
	$('.is_citizen').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_citizen_details').removeAttr('readonly','readonly');
		}else{
			$('#is_citizen_details').attr('readonly','readonly');
			$('#is_citizen_details').val('');
		}			
	});
</script>