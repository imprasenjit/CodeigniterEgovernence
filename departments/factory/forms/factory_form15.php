<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="15";
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
		$serial_no=$results['serial_no'];$father_name=$results['father_name'];$work_name=$results['work_name'];$letter=$results['letter'];$relay_no=$results['relay_no'];$token_no=$results['token_no'];$remarks=$results['remarks'];
		
		if(!empty($results["worker"])){
			$worker=json_decode($results["worker"]);
			$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
		}else{
			$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		}
		if(!empty($results["certificate"])){
			$certificate=json_decode($results["certificate"]);			
			$certificate_no=$certificate->no;$certificate_dt=$certificate->dt;
		}else{
			$certificate_no="";$certificate_dt="";
		}	
	}else{
		$form_id="";
		$serial_no="";$father_name="";$work_name="";$letter="";$relay_no="";$token_no="";$remarks="";
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
		$certificate_no="";$certificate_dt="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$serial_no=$results['serial_no'];$father_name=$results['father_name'];$work_name=$results['work_name'];$letter=$results['letter'];$relay_no=$results['relay_no'];$token_no=$results['token_no'];$remarks=$results['remarks'];
	
	if(!empty($results["worker"])){
		$worker=json_decode($results["worker"]);
		$worker_name=$worker->name;$worker_sn1=$worker->sn1;$worker_sn2=$worker->sn2;$worker_vill=$worker->vill;$worker_dist=$worker->dist;$worker_pin=$worker->pin;$worker_mobile=$worker->mobile;
	}else{
		$worker_name="";$worker_sn1="";$worker_sn2="";$worker_vill="";$worker_dist="";$worker_pin="";$worker_mobile="";
	}
	if(!empty($results["certificate"])){
		$certificate=json_decode($results["certificate"]);			
		$certificate_no=$certificate->no;$certificate_dt=$certificate->dt;
	}else{
		$certificate_no="";$certificate_dt="";
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
											<td width="25%">2. Name of worker : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="worker[name]" value="<?php echo $worker_name; ?>"></td>	
										</tr>
										<tr>
											<td colspan="4">3. Residential Address of Worker : </td>
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
											<td>4. Father's Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo $father_name; ?>"></td>
											<td>5. Name of work : </td>
											<td><input type="text" class="form-control text-uppercase" name="work_name" value="<?php echo $work_name; ?>"></td>
										</tr>																					
										<tr>
											<td>6. Letter of Group as in Form 11 : </td>
											<td><input type="text" class="form-control text-uppercase" name="letter" value="<?php echo $letter; ?>"></td>
											<td>7. Number of relay, if working in shifts : </td>
											<td><input type="text" class="form-control text-uppercase" name="relay_no" value="<?php echo $relay_no; ?>"></td>
										</tr>																					
										<tr>
											<td>8. No. of certificate and date if an adolesscent : </td>
											<td><input type="text" class="form-control text-uppercase" name="certificate[no]" value="<?php echo $certificate_no; ?>" placeholder="Number"></td>
											<td><input type="date" class="dob form-control" name="certificate[dt]" value="<?php echo $certificate_dt; ?>" placeholder="DATE"></td>
											<td></td>
										</tr>
										<tr>
											<td>9. Token No. giving reference to the certificate : </td>
											<td><input type="text" class="form-control text-uppercase" name="token_no" value="<?php echo $token_no; ?>"></td>
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