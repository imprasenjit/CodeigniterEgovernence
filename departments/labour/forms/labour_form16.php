<?php require_once "../../requires/login_session.php";
$dept="labour";
$form="16";
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
		$notification_no=$results['notification_no'];$notification_date=$results['notification_date'];
	}else{
		$notification_no="";$notification_date="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$notification_no=$results['notification_no'];$notification_date=$results['notification_date'];
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
							<h4 class="text-center">
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">	
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="my_form6" id="my_form6" class="submit1" method="post" ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4">To,<br/><?php echo $form_name=$formFunctions->get_formName($dept,$form);?><br/><br/></td>
										</tr>
										<tr>
											<td colspan="4"><b>Sub :&nbsp;&nbsp;</b>Application for Registration under Self-Certification -Cum- Consolidated Annual Return Scheme of Assam, 2016.<br/><br/></td>
										</tr>
										<tr>
											<td colspan="4">Sir,<br/><br/>In response to the Govt. Notification No. :&nbsp;&nbsp;<input type="text" class="form-inline text-uppercase"  name="notification_no" value="<?php echo $notification_no; ?>" required="required"> &nbsp;&nbsp; dated &nbsp;&nbsp; <input type="datetime" class="dob5 form-inline text-uppercase" placeholder="DD/MM/YYYY" name="notification_date" value="<?php echo $notification_date; ?>" required="required"> &nbsp;&nbsp; regarding Self Certification and have understood the same. <br/>I/We wish to be covered under the same, as such I/We request you kindly to issue me/us necessary approval for the same. The necessary information and other supporting documents, as required under the scheme, are enclosed as per Check list provided under the scheme. I/We undertake to abide by all terms and conditions of the scheme. It is also certified that I/We are competent and duly authorized to make any statement or provide any information to central/state Government agency on behalf of this establishment/enterprise.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kindly issue the necessary registration at the earliest.<br/><br/></td>
										</tr>
										<tr>
											<td colspan="2" class="form-inline text-uppercase"><label>Date : <?php echo date('d-m-Y',strtotime($today)); ?></label></td>
											<td colspan="2" class="form-inline text-uppercase" align="right"><label>Yours faithfully,<br/><?php echo $key_person; ?></label><br/>(Full Signature of the Applicant) </td>
										</tr>	
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
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
	$('.dob4').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob5').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	/* ------------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>