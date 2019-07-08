<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="22";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form2.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$worker_name=$results['worker_name'];$serial_no=$results['serial_no'];$father_name=$results['father_name'];$age=$results['age'];$birth_date=$results['birth_date'];$nature=$results['nature'];$qual=$results['qual'];$remarks=$results['remarks'];$occupier_sign=$results['occupier_sign'];
	}else{
		$form_id="";$worker_name="";$serial_no="";$father_name="";$age="";$birth_date="";$nature="";$qual="";$remarks="";$occupier_sign="";
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$worker_name=$results['worker_name'];$serial_no=$results['serial_no'];$father_name=$results['father_name'];$age=$results['age'];$birth_date=$results['birth_date'];$nature=$results['nature'];$qual=$results['qual'];$remarks=$results['remarks'];$occupier_sign=$results['occupier_sign'];
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
											<td width="25%">1. Name of worker : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="worker_name" value="<?php echo  $worker_name; ?>"></td>
											<td width="25%">2. Serial number as in the register of workers under Section 62 of the Act : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="serial_no" value="<?php echo  $serial_no; ?>"></td>							
										</tr>
										<tr>
											<td>3. Father's name : </td>
											<td><input type="text" class="form-control text-uppercase" name="father_name" value="<?php echo $father_name; ?>"></td>	
											<td>4. Age : </td>
											<td><input type="text" class="form-control text-uppercase" name="age" value="<?php echo $age; ?>"></td>	
										</tr>
										<tr>
											<td>5. Date of birth : </td>
											<td><input type="date" class="dob form-control" name="birth_date" value="<?php echo $birth_date; ?>"></td>
											<td>6. Nature of work : </td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>			
										</tr>
										<tr>
											<td>7. Qualification, if any or period of service on similar work : </td>
											<td><input type="text" class="form-control text-uppercase" name="qual" value="<?php echo $qual; ?>"></td>
											<td>8. Remarks : </td>
											<td><input type="text" class="form-control text-uppercase" name="remarks" value="<?php echo $remarks; ?>"></td>			
										</tr>
										<tr>
											<td colspan="4">I certify that the above-mentioned worker is a properly trained male adult worker who is competent to mount on ship belts of 6 inches or less in width of either laced or flush type belt joints to lubricate or do other adjusting operations on the machinery installed in my factory while they are in motion.</td>
										</tr>												
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature of Occupier : &nbsp;<input type="text" class="form-control text-uppercase" name="occupier_sign" value="<?php echo $occupier_sign; ?>"></td>
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
</script>