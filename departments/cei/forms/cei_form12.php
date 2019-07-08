<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="12";
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
			$is_lift_esc=$results['is_lift_esc'];
			$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];			
		}else{
			$form_id="";
			$is_lift_esc="";$auth_person="";$auth_no="";
			
		}	
	}else{
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$is_lift_esc=$results['is_lift_esc'];
			$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			$is_lift_esc=$results['is_lift_esc'];
			$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="2" align="center"><label class="radio-inline"><input type="radio" name="is_lift_esc"  value="L" <?php if(isset($is_lift_esc) && ($is_lift_esc=='L' || $is_lift_esc=='')) echo 'checked'; ?> /> Lift</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_lift_esc"  value="E"  <?php if(isset($is_lift_esc) && $is_lift_esc=='E') echo 'checked'; ?>/> Escalotor</label></td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right">Name of the authorized person <input type="text" class="form-control1 text-uppercase" validate="letters" name="auth_person"  value="<?php echo $auth_person; ?>" required="required"> <br/><br/>
										 Authorization number <input type="text" class="form-control1 text-uppercase" name="auth_no" required="required"  value="<?php echo $auth_no; ?>"> </td>
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
		</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	<?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
    $("input").prop('required',true);
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>