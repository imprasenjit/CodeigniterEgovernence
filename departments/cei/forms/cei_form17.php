<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="17";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			$lift=$results['lift'];$owned=$results['owned'];$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
		}else{
			$form_id="";
			$lift="";$owned="";$auth_person="";$auth_no="";	
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$lift=$results['lift'];$owned=$results['owned'];$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
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
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
									    <td colspan="4">To,<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
										As  required  by  rule  9  of  the  Assam  Lifts  and  Escalators  Rules,  2010  I/We hereby    certify    that    the    lift(s)    installed    at    &nbsp;<input type="text" validate="specialChar" class="form-control1 text-uppercase" name="lift" value="<?php echo $lift; ?>">&nbsp;And    owned by&nbsp;<input type="text" validate="letters" class="form-control1 text-uppercase" name="owned" value="<?php echo $owned; ?>">&nbsp;is under my/our maintenance. <br/><br/>
														
										The installation of the aforesaid lift satisfies the entire requirement as laid  down  under  the  Assam  Lifts  and  Escalators  Act,  2006  and  the  rules  thereunder.  I/We maintain logbook as required under Rule 9(j) of the Assam Lifts and Escalators Rules, 2010.  
							
										</td>
									</tr>								
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?><b></td>
										<td colspan="2" align="right">Name of the authorized person: <label><input validate="letters" type="text" class="form-control1 text-uppercase" name="auth_person" value="<?php echo $auth_person; ?>"></label><br/>
										 Authorization number:&nbsp;<input type="text" class="form-control1 text-uppercase" validate="specialChar" name="auth_no" value="<?php echo $auth_no; ?>"></td>
									</tr>		
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
    $("input").prop('required',true);
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>