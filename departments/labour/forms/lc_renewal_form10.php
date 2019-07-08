<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="10";
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
			$prev_lic_date=$results["prev_lic_date"];$is_suspended=$results["is_suspended"];$particulars=$results["particulars"];$max_workers=$results["max_workers"];
			if(!empty($results["license"])){
				$license=json_decode($results["license"]);
				$license_no=$license->no;$license_dt=$license->dt;
			}else{
				$license_no="";$license_dt="";
			}
		}else{
			$form_id="";$prev_lic_date="";$is_suspended="";$particulars="";$max_workers="";
			$license_no="";$license_dt="";	
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];		
		$prev_lic_date=$results["prev_lic_date"];$is_suspended=$results["is_suspended"];$particulars=$results["particulars"];$max_workers=$results["max_workers"];
		if(!empty($results["license"])){
			$license=json_decode($results["license"]);
			$license_no=$license->no;$license_dt=$license->dt;
		}else{
			$license_no="";$license_dt="";
		}
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
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1.(a) Name of The Contractor</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td>(b) Address of The Contractor</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>" readonly></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" readonly></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>" readonly></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>" readonly></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>" readonly></td>
										<td></td>
										<td></td>
									</tr>	
									<tr>
										<td>2. Number and Date of the license</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Number:<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="license[no]" value="<?php echo $license_no; ?>"  required></td>
										<td>Date:<span class="mandatory_field">*</span></td>
										<td><input type="datetime" class="dob4 form-control text-uppercase" placeholder="DD/MM/YYYY" id="dob" name="license[dt]" value="<?php echo $license_dt; ?>" readonly="readonly"  required></td>
									</tr>
									<tr>
										<td>3. Date of expiry of the previous license.<span class="mandatory_field">*</span></td>
										<td><input type="datetime" class="dob5 form-control text-uppercase" placeholder="DD/MM/YYYY" name="prev_lic_date" value="<?php echo $prev_lic_date; ?>" readonly="readonly" required></td>
										<td>4. Whether the license of the contractor <br/>was suspended or revoked</td>
										<td>
										    <label class="radio-inline"><input type="radio" name="is_suspended"  value="Y" <?php if($is_suspended=='Y') echo 'checked'; ?> checked> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_suspended" value="N" <?php if($is_suspended=='N') echo 'checked'; ?> />&nbsp;No </label></td>
									</tr>									
									<tr>
										<td>5. Particulars of the establishment where contract Labour is to be employed :</td>
										<td><textarea  name="particulars" class="form-control text-uppercase"><?php echo $particulars; ?></textarea></td>
										<td>6. The number of workmen employed by the contractor on any day :<span class="mandatory_field">*</span></td>
										<td><input type="text"  name="max_workers" required="required" validate="onlyNumbers" value="<?php echo $max_workers; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr class="text-uppercase text-center">
										<td align="left"><br/>
										   <b>Date : </b>&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?></b><br/>
										   <b>Place : </b>&nbsp;&nbsp;<?php echo $dist; ?></td>
										<td></td>
										<td></td>
										<td ><br/><?php echo strtoupper($key_person); ?><br/><b>Signature of the Applicant (Contractor)</b> </td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form;?>" value="Save and Next" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	$('.dob4').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob5').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>