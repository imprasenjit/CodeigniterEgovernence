<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="12";
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
			$form_id=$results['form_id'];
			$make=$results['make'];$model=$results['model'];$accuracy=$results['accuracy'];$machine=$results['machine'];$platform=$results['platform'];$max_capacity=$results['max_capacity'];$min_capacity=$results['min_capacity'];$e_value=$results['e_value'];
		}else{
			$form_id="";
			$make="";$model="";$accuracy="";$machine="";$platform="";$max_capacity="";$min_capacity="";$e_value="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$make=$results['make'];$model=$results['model'];$accuracy=$results['accuracy'];$machine=$results['machine'];$platform=$results['platform'];$max_capacity=$results['max_capacity'];$min_capacity=$results['min_capacity'];$e_value=$results['e_value'];		
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
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4"> To,<br/>&emsp;&emsp;&emsp;The Controller of Legal Metrology, Assam,<br/>&emsp;&emsp;&emsp;R.K. Mission Road, Ulubari,<br/>&emsp;&emsp;&emsp;Guwahati-781007
										</td>
									</tr>
									<tr>
										<td width="25%">1. (a) Name of the owner of the Weighbridge: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the owner of the Weighbridge:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">2. (a) Name of the Firm: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td>(b) Address of the Firm:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
									</tr>										
									<tr>
										<td colspan="4">3. Details of the Weighbridge:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">							
											<tr>
												<td width="25%">Make</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="make" value="<?php echo $make;?>"></td>
												<td width="25%">Model</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="model" value="<?php echo $model;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Accuracy Class</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="accuracy" value="<?php echo $accuracy;?>"></td>
												<td width="25%">Machine Sl. No.</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="machine" value="<?php echo $machine;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Platform Size</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="platform" value="<?php echo $platform;?>"></td>
												<td width="25%">Max. Capacity</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="max_capacity" value="<?php echo $max_capacity;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Min. Capacity</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="min_capacity" value="<?php echo $min_capacity;?>"></td>
												<td width="25%">e-value</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="e_value" value="<?php echo $e_value;?>"></td>
											
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td >
										   Date:&emsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong>
										   <br/>
										   Place:&emsp;<strong><?php echo strtoupper($dist)?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature:&emsp;<strong><?php echo strtoupper($key_person); ?></strong><br/>
										Designation:&emsp;<strong><?php echo strtoupper($status_applicant); ?></strong><br/> </td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
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
</script>