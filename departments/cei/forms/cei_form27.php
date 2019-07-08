<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="27";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;// For reccuring form fill ups
	
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];		
			$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];$rated_speed=$results['rated_speed'];		
			
		}else{
			$form_id="";			
			$letter_no="";$letter_dt="";$completed_on="";$rated_speed="";			
		}		
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];$rated_speed=$results['rated_speed'];			
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];
			$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];$rated_speed=$results['rated_speed'];			
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
							
								<br>
								
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
									    <td colspan="4" class="form-inline">To,<br/>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
											Sub : Installation of escalator at <?php echo strtoupper($unit_name); ?><br/><br/>
											Dear Sir,<br/><br/>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to letter No&nbsp;<input type="text" class="form-control text-uppercase"  name="letter_no" value="<?php echo $letter_no; ?>">&nbsp;dated &nbsp;<input type="text" class="dob form-control text-uppercase" name="letter_dt" readonly="readonly" value="<?php echo $letter_dt; ?>">&nbsp;of your office granting permission to install a escalator at the above mentioned premises, I/We have to state that the work of installation of the escalator has been completed on &nbsp;<input type="text" class="dob form-control text-uppercase" readonly="readonly" name="completed_on" value="<?php echo $completed_on; ?>">.<br/> 
										</td>
									</tr>
									<tr>
										<td> Rated speed (meter per second) <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="rated_speed"  value="<?php echo  $rated_speed; ?>" validate="decimal" required="required"> </td>
										<td></td>
										<td></td>
									</tr>	
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										 Signature of the applicant</td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">											
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>