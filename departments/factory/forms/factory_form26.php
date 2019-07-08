<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="26";
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
		$days_worked=$results['days_worked'];$rupees=$results['rupees'];$deduction=$results['deduction'];$amount=$results['amount'];$sign=$results['sign'];$designation=$results['designation'];
	}else{
		$form_id="";$days_worked="";$rupees="";$deduction="";$amount="";$sign="";$designation="";
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$days_worked=$results['days_worked'];$rupees=$results['rupees'];$deduction=$results['deduction'];$amount=$results['amount'];$sign=$results['sign'];$designation=$results['designation'];
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
											<td width="25%">1. (a) Name of the Factory or Establishment : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name; ?>" disabled="disabled"></td>
											<td width="25%">(b) Postal Address : </td>
											<td width="25%"><textarea class="form-control text-uppercase" disabled="disabled" ><?php echo $unit_details; ?></textarea></td>	
										</tr>
										<tr>
											<td>2. Number of days worked during the year : </td>
											<td><input type="text" class="form-control text-uppercase" name="days_worked" value="<?php echo $days_worked; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">3. (a) Number of mondays worked during the year : </td>
										</tr>
										<tr>
											<td colspan="4">3. (b) Average daily number of person employed during the year : </td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">3. (c) Gross amount paid as remuneration to person getting less than Rs. &nbsp;<input type="text" class="form-control text-uppercase" name="rupees" value="<?php echo $rupees; ?>">&nbsp; per month including deduction under Section 7(2) &nbsp;<input type="text" class="form-control text-uppercase" name="deduction" value="<?php echo $deduction; ?>">&nbsp; which the amount due to profit sharing bonus is and that due to money value of concessions is &nbsp;<input type="text" class="form-control text-uppercase" name="amount" value="<?php echo $amount; ?>"></td>
										</tr>										
										<tr>
											<td colspan="4">4. Total wages paid including deduction under Section 7(2) own the following accounts : </td>
										</tr>											
										<tr>
											<td colspan="4">5. Deductions - Number of case and amount realized : </td>
										</tr>											
										<tr>
											<td colspan="4">6. Fines Fund : </td>
										</tr>									
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : &nbsp;<input type="text" class="form-control text-uppercase" name="sign" value="<?php echo $sign; ?>">&nbsp;<br/>Designation : &nbsp;<input type="text" class="form-control text-uppercase" name="designation" value="<?php echo $designation; ?>"></td>
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