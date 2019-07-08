<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="13";
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
		$register_no=$results['register_no'];$department=$results['department'];$hours=$results['hours'];$normal_rate=$results['normal_rate'];$over_rate=$results['over_rate'];$cash=$results['cash'];$payment_dt=$results['payment_dt'];
		
		if(!empty($results["worker"])){
			$worker=json_decode($results["worker"]);
			$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
		}else{
			$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		}
		if(!empty($results["overtime"])){
			$overtime=json_decode($results["overtime"]);			
			$overtime_dt=$overtime->dt;$overtime_extent=$overtime->extent;$overtime_total=$overtime->total;
		}else{
			$overtime_dt="";$overtime_extent="";$overtime_total="";
		}
		if(!empty($results["earning"])){
			$earning=json_decode($results["earning"]);
			$earning_normal=$earning->normal;$earning_over=$earning->over;$earning_total=$earning->total;
		}else{
			$earning_normal="";$earning_over="";$earning_total="";
		}	
	}else{
		$form_id="";
		$register_no="";$department="";$hours="";$normal_rate="";$over_rate="";$cash="";$payment_dt="";
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		$overtime_dt="";$overtime_extent="";$overtime_total="";
		$earning_normal="";$earning_over="";$earning_total="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$register_no=$results['register_no'];$department=$results['department'];$hours=$results['hours'];$normal_rate=$results['normal_rate'];$over_rate=$results['over_rate'];$cash=$results['cash'];$payment_dt=$results['payment_dt'];
	
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["overtime"])){
		$overtime=json_decode($results["overtime"]);			
		$overtime_dt=$overtime->dt;$overtime_extent=$overtime->extent;$overtime_total=$overtime->total;
	}else{
		$overtime_dt="";$overtime_extent="";$overtime_total="";
	}
	if(!empty($results["earning"])){
		$earning=json_decode($results["earning"]);
		$earning_normal=$earning->normal;$earning_over=$earning->over;$earning_total=$earning->total;
	}else{
		$earning_normal="";$earning_over="";$earning_total="";
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
											<td width="25%">1. No. in Register : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="register_no" value="<?php echo $register_no; ?>"></td>
											<td width="25%">2. Name of the worker : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="worker[name]" value="<?php echo $worker_name; ?>"></td>	
										</tr>
										<tr>
											<td colspan="4">3. Residential Address of the Worker : </td>
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
											<td>4. Department : </td>
											<td><input type="text" class="form-control text-uppercase" name="department" value="<?php echo $department; ?>"></td>
											<td>5. Date on which overtime has been worked : </td>
											<td><input type="date" class="dob form-control" name="overtime[dt]" value="<?php echo $overtime_dt; ?>"></td>
										</tr>																					
										<tr>
											<td>6. Extent of overtime on each occassion : </td>
											<td><input type="text" class="form-control text-uppercase" name="overtime[extent]" value="<?php echo $overtime_extent; ?>"></td>											
											<td>7. Total overtime worked or production in case of piece workers : </td>
											<td><input type="text" class="form-control text-uppercase" name="overtime[total]" value="<?php echo $overtime_total; ?>"></td>
										</tr>
										<tr>
											<td>8. Normal hours : </td>
											<td><input type="text" class="form-control text-uppercase" name="hours" value="<?php echo $hours; ?>"></td>
											<td>9. Normal rate of pay : </td>
											<td><input type="text" class="form-control text-uppercase" name="normal_rate" value="<?php echo $normal_rate; ?>"></td>
										</tr>	
										<tr>
											<td>10. Overtime rate of pay : </td>
											<td><input type="text" class="form-control text-uppercase" name="over_rate" value="<?php echo $over_rate; ?>"></td>
											<td>11. Normal earning : </td>
											<td><input type="text" class="form-control text-uppercase" name="earning[normal]" value="<?php echo $earning_normal; ?>"></td>
										</tr>	
										<tr>
											<td>12. Overtime earning : </td>
											<td><input type="text" class="form-control text-uppercase" name="earning[over]" value="<?php echo $earning_over; ?>"></td>
											<td>13. Cash equivalent of advantages accruing through the concessional sale of food-grain and other articles : </td>
											<td><input type="text" class="form-control text-uppercase" name="cash" value="<?php echo $cash; ?>"></td>											
										</tr>																				
										<tr>
											<td>14. Total earning : </td>
											<td><input type="text" class="form-control text-uppercase" name="earning[total]" value="<?php echo $earning_total; ?>"></td>
											<td>15. Date on which overtime payments made : </td>
											<td><input type="date" class="dob form-control" name="payment_dt" value="<?php echo $payment_dt; ?>"></td>
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