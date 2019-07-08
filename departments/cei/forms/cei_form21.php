<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="21";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
   
    $q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$is_certificate=$results['is_certificate'];$certificate_number =$results['certificate_number'];
			$certificate_date =$results['certificate_date'];
			if($certificate_date=='0000-00-00')
			{$certificate_date='';}else{$certificate_date=$certificate_date;}
			$maintance=$results['maintance'];$details_of_staff=$results["details_of_staff"];$rated_speed=$results["rated_speed"];$is_lift_esc=$results["is_lift_esc"];
		}else{
			$form_id="";
			$is_certificate="";$certificate_number="";$certificate_date="";$maintance="";
			$details_of_staff="";$rated_speed="";$is_lift_esc="";	
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$is_certificate=$results['is_certificate'];$certificate_number =$results['certificate_number'];
		$certificate_date =$results['certificate_date'];
		if($certificate_date=='0000-00-00')
		{$certificate_date='';}else{$certificate_date=$certificate_date;}
		$maintance=$results['maintance'];$details_of_staff=$results["details_of_staff"];$rated_speed=$results["rated_speed"];$is_lift_esc=$results["is_lift_esc"];
		
	}
?>
<?php require_once "../../requires/header.php";   ?>
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
								<br>
								 <div id="table1" class="tab-pane" role="tabpanel">
								 <form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								 <table class="table table-responsive table-bordered">	
									<tr>
										<td colspan="4" align="center"><label class="radio-inline"><input type="radio" checked="checked" name="is_lift_esc" value="L"  <?php if((isset($is_lift_esc) ) AND ($is_lift_esc=='L')) echo 'checked'; ?> /> Lift</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_lift_esc"  value="E"  <?php if((isset($is_lift_esc) ) AND ($is_lift_esc=='E')) echo 'checked'; ?>/> Escalator</label></td>
									</tr>
									<tr>
										<td width="25%">1. Name of the applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $key_person; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>								
									</tr>
									<tr>
										<td colspan="4">2. Legal status : (Whether individual, firm or company. Number of registration and names and addresses of partners or directors to be given in case of firm or company, as the case may be) </td>
									</tr>
									<tr>
										<td>Legal Status</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership; ?>"></td>
										<td>Registration Number</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $ubin; ?>" ></td>
									</tr>
									<tr>
										<td>Names of Partners or Directors</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $owner_names; ?>"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
									    <td colspan="4">3. Office address with details of telephone (Details regarding possession to be given).  </td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"   value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_vill; ?>"></td>
										<td>District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($b_dist);?>"   name="b_dist">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>" ></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std .'-'. $b_landline_no;?>" ></td>
										<td>Email Id:</td>
										<td><input type="email" class="form-control"  disabled="disabled" value="<?php echo  $b_email; ?>"></td>
										
									</tr>							
									<tr>
										<td colspan="3">4. Whether certificate of authorization was issued in the past in the same name. If so, give number and date of certificate of authorization. </td>
										<td><label class="radio-inline"><input type="radio" checked="checked" name="is_certificate" value="Y"  <?php if((isset($is_certificate) ) AND ($is_certificate=='Y')) echo 'checked'; ?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_certificate"  value="N"  <?php if((isset($is_certificate) ) AND ($is_certificate=='N')) echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td>(i)Certificate number:</td>
										<td><input type="text" class="is_cert form-control text-uppercase" name="certificate_number" validate="specialChar" value="<?php echo  $certificate_number; ?>"></td>
										<td>(ii)Certificate Date:</td>
										<td><input type="text" class="is_cert dob form-control text-uppercase" name="certificate_date" validate="specialChar" value="<?php echo  $certificate_date; ?>"></td>
									</tr>
									<tr>
										<td>5. Details of technical qualifications and experience. (Attested copies to be attached).</td>
										<td><textarea class="form-control text-uppercase" name="maintance" maxlength="255" validate="textarea"><?php echo  $maintance; ?></textarea></td>
										<td>6. Details of technical and ministerial staff employed. </td>
										<td><textarea class="form-control text-uppercase" name="details_of_staff" maxlength="255" validate="textarea"><?php echo $details_of_staff; ?></textarea></td>	
									</tr>
								
									<tr>
										
										<td>7. Rated speed (meter per second)<span class="mandatory_field">*</span></td>
										<td><input type="text" class="lift_esc form-control text-uppercase" name="rated_speed" value="<?php echo  $rated_speed; ?>" validate="decimal" required="required"> </td>
									</tr>

									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b><br/>
										Place: <b><?php echo strtoupper($dist); ?></b></td>
										<td colspan="2" align="right"> 
										Signature: <label><?php echo strtoupper($key_person) ?></label><br/>
										Name: <label><?php echo strtoupper($key_person) ?></label><br/>
										Designation: <label> <?php echo strtoupper($status_applicant) ?></label><br/>
										</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
    $("input").prop('required',true);
	/* ----------------------------------------------------- */
	<?php if($is_certificate=="N"){ ?>
	$('.is_cert').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_certificate"]').on('change', function(){
		if($(this).val() == 'N')
			$('.is_cert').attr('disabled', 'disabled');
		else
			$('.is_cert').removeAttr('disabled');
	});
	<?php if($is_lift_esc=="E"){ ?>
	$('.lift_esc').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_lift_esc"]').on('change', function(){
		if($(this).val() == 'E')
			$('.lift_esc').attr('disabled', 'disabled');
		else
			$('.lift_esc').removeAttr('disabled');
	});
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>