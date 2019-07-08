<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="10";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id=$swr_id and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];$form_against=$results['form_against'];$order_num=$results['order_num'];$order_date=$results['order_date'];$auth_representative=$results['auth_representative'];$ground_appeal=$results['ground_appeal'];		
		}else{
			$form_id="";
			$form_against="";$order_num="";$order_date="";$auth_representative="";$ground_appeal="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];$form_against=$results['form_against'];$order_num=$results['order_num'];$order_date=$results['order_date'];$auth_representative=$results['auth_representative'];	$ground_appeal=$results['ground_appeal'];		
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>
							</div>
							<div class="panel-body">
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Form of appeal against an order of a<span class="mandatory_field">*</span></td>
										<td width="25%"><select name="form_against" required class="form-control  text-uppercase">
											<option class="form-control text-uppercase" value="">Please Select an option</option>
											<option class="form-control text-uppercase" <?php if($form_against=="L") echo "selected";?> value="L"  >Legal Metrology Officer</option>
											<option class="form-control text-uppercase" <?php if($form_against=="C") echo "selected"; ?> value="C"  >Controller Legal Metrology</option>
										</select></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">2. Name and address of the appellant.</td>
									</tr>
										<tr>
											<td width="25%">Name</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person; ?>" disabled="disabled"></td>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
										</tr>
										<tr>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
										</tr>
										<tr>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										</tr>
										<tr>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
											<td>E-Mail ID</td>
											<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">3. No. and date of order of Legal Metrology Officer/ Controller of Legal Metrology against which the appeal is preferred</td>
										</tr>
										<tr>
											<td> (a)No. :</td>
											<td><input type="text" class="form-control text-uppercase"  name="order_num" value="<?php echo $order_num; ?>" /></td>
											<td >(b) Date :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="order_date" readonly="readonly" value="<?php if($order_date!="0000-00-00" && $order_date!="") echo date('d-m-Y',strtotime($order_date));else echo "";?>" placeholder="DD-MM-YYYY"></td>
										</tr>
										<tr>
											<td width="25%">
												4. Whether the appellant desires to be heard in person or through an authorized representative<span class="mandatory_field">*</span>
											</td>                                
											<td>
												<select class="form-control text-uppercase" required="required" name="auth_representative">
												<option value="">Please Select</option>
												<option <?php if($auth_representative=="I") echo "selected"; ?> value="I">In person</option>
												<option <?php if($auth_representative=="T") echo "selected"; ?> value="T">Through an authorized representative</option>
												</select></td>
											<td width="25%">5. Grounds of appeal.<span class="mandatory_field">*</span></td>
											<td><input type="text" name="ground_appeal" class="form-control text-uppercase" required="required" value="<?php echo $ground_appeal; ?>"></td>
										</tr>
									<tr>
										<td>
											Place:&nbsp; <strong> <?php echo strtoupper($dist); ?> </strong> <br/>
											Date:&nbsp; <strong> <?php echo date('d-m-Y',strtotime($today)); ?> </strong> 
										</td>
										<td></td>
										<td></td>
										<td align="right">Signature: <strong><?php echo strtoupper($key_person); ?></strong><br/>Designation: <strong><?php echo strtoupper($status_applicant); ?></strong></td>
									</tr>	
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Submit</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>