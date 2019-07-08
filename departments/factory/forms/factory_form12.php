<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="12";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$serial_no=$results['serial_no'];$register=$results['register'];$group_no=$results['group_no'];$lost_days=$results['lost_days'];$remarks=$results['remarks'];
		
		if(!empty($results["worker"])){
			$worker=json_decode($results["worker"]);
			$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
		}else{
			$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		}
		if(!empty($results["exempt"])){
			$exempt=json_decode($results["exempt"]);			
			$exempt_no=$exempt->no;$exempt_dt=$exempt->dt;
		}else{
			$exempt_no="";$exempt_dt="";
		}
		if(!empty($results["days"])){
			$days=json_decode($results["days"]);
			$days_year=$days->year;$days_jan=$days->jan;$days_april=$days->april;$days_july=$days->july;$days_oct=$days->oct;
		}else{
			$days_year="";$days_jan="";$days_april="";$days_july="";$days_oct="";
		}	
		if(!empty($results["holiday"])){
			$holiday=json_decode($results["holiday"]);
			$holiday_jan=$holiday->jan;$holiday_april=$holiday->april;$holiday_july=$holiday->july;$holiday_oct=$holiday->oct;
		}else{
			$holiday_jan="";$holiday_april="";$holiday_july="";$holiday_oct="";
		}		
	}else{
		$form_id="";
		$serial_no="";$register="";$group_no="";$lost_days="";$remarks="";
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		$exempt_no="";$exempt_dt="";
		$days_year="";$days_jan="";$days_april="";$days_july="";$days_oct="";
		$holiday_jan="";$holiday_april="";$holiday_july="";$holiday_oct="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$serial_no=$results['serial_no'];$register=$results['register'];$group_no=$results['group_no'];$lost_days=$results['lost_days'];$remarks=$results['remarks'];
		
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["exempt"])){
		$exempt=json_decode($results["exempt"]);			
		$exempt_no=$exempt->no;$exempt_dt=$exempt->dt;
	}else{
		$exempt_no="";$exempt_dt="";
	}
	if(!empty($results["days"])){
		$days=json_decode($results["days"]);
		$days_year=$days->year;$days_jan=$days->jan;$days_april=$days->april;$days_july=$days->july;$days_oct=$days->oct;
	}else{
		$days_year="";$days_jan="";$days_april="";$days_july="";$days_oct="";
	}	
	if(!empty($results["holiday"])){
		$holiday=json_decode($results["holiday"]);
		$holiday_jan=$holiday->jan;$holiday_april=$holiday->april;$holiday_july=$holiday->july;$holiday_oct=$holiday->oct;
	}else{
		$holiday_jan="";$holiday_april="";$holiday_july="";$holiday_oct="";
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Serial No. : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="serial_no" value="<?php echo $serial_no; ?>"></td>
											<td width="25%">2. Number in the register of workers : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="register" value="<?php echo $register; ?>"></td>
										</tr>
										<tr>
											<td>3. Name of the worker : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[name]" value="<?php echo $worker_name; ?>"></td>	
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">4. Address of the Worker : </td>
										</tr>
										<tr>
											<td>Street Name 1 : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[sn1]" value="<?php echo $worker_sn1; ?>"></td>
											<td>Street Name 2 : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[sn2]" value="<?php echo $worker_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[vill]" value="<?php echo $worker_vill; ?>"></td>
											<td>District : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[dist]" value="<?php echo $worker_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[pin]" value="<?php echo $worker_pin; ?>" validate="pincode" maxlength="6"></td>
											<td>Mobile No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker[mobile]" value="<?php echo $worker_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
										</tr>																					
										<tr>
											<td>5. Group or Relay No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="group_no" value="<?php echo $group_no; ?>"></td>
											<td colspan="2"></td>
										</tr>																					
										<tr>
											<td>6. Number and date of exempting order : </td>
											<td><input type="text" class="form-control text-uppercase" name="exempt[no]" value="<?php echo $exempt_no; ?>"></td>
											<td><input type="date" class="dob form-control" name="exempt[dt]" value="<?php echo $exempt_dt; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">7. Weekly lost days due to exempting order in : </td>
										</tr>
										<tr>
											<td colspan="4">
												<table class="table table-responsive table-bordered">
													<tr>
														<td class="text-center">Year </td>
														<td><input type="text" class="form-control text-uppercase" name="days[year]" value="<?php echo $days_year; ?>" validate="onlyNumbers" maxlength="4"></td>
														<td colspan="2"></td>
													</tr>
													<tr>
														<td>January to March </td>
														<td><input type="text" class="form-control text-uppercase" name="days[jan]" value="<?php echo $days_jan; ?>"></td>
														<td>April to June </td>
														<td><input type="text" class="form-control text-uppercase" name="days[april]" value="<?php echo $days_april; ?>"></td>
													</tr>
													<tr>
														<td>July to September </td>
														<td><input type="text" class="form-control text-uppercase" name="days[july]" value="<?php echo $days_july; ?>"></td>
														<td>October to December </td> 
														<td><input type="text" class="form-control text-uppercase" name="days[oct]" value="<?php echo $days_oct; ?>"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">8. Date of compensatory holiday given in : </td>
										</tr>
										<tr>
											<td colspan="4">
												<table class="table table-responsive table-bordered">
													<tr>
														<td>January to March </td>
														<td><input type="text" class="form-control text-uppercase" name="holiday[jan]" value="<?php echo $holiday_jan; ?>"></td>
														<td>April to June </td>
														<td><input type="text" class="form-control text-uppercase" name="holiday[april]" value="<?php echo $holiday_april; ?>"></td>
													</tr>
													<tr>
														<td>July to September </td>
														<td><input type="text" class="form-control text-uppercase" name="holiday[july]" value="<?php echo $holiday_july; ?>"></td>
														<td>October to December </td> 
														<td><input type="text" class="form-control text-uppercase" name="holiday[oct]" value="<?php echo $holiday_oct; ?>"></td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td>9. Lost rest days carried to the next year : </td>
											<td><input type="text" class="form-control text-uppercase" name="lost_days" value="<?php echo $lost_days; ?>"></td>
											<td>10. Remarks : </td>
											<td><input type="text" class="form-control text-uppercase" name="remarks" value="<?php echo $remarks; ?>"></td>
										</tr>											
										<tr>
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo $key_person; ?></strong></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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
</script>