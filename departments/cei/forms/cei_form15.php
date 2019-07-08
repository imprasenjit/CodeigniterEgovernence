<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="15";
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
			$install_at=$results['install_at'];$install_lift=$results['install_lift'];
			
		}else{
			$form_id="";
			$install_at="";$install_lift="";	
		}
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$install_at=$results['install_at'];$install_lift=$results['install_lift'];
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
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
										Sub : Renewal of working license for the lift installed at <input type="text" id="field1" onkeyup="display()" class="form-control1 text-uppercase" name="install_at" value="<?php echo $install_at; ?>"> <br/><br/>
										Sir,<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to the above, it is stated that the working license in respect of lift installed <input type="text" id="field2" class="form-control1 text-uppercase" name="install_lift" value="<?php echo $install_lift; ?>" readonly="readonly"> is sent herewith for renewal thereof as required under section 6 of the Assam Lifts and Escalators Act, 2006 and it is requested to return the same after renewal.<br/><br/>
										</td>
									</tr>								
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of the owner</td>
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
	function display(){
            var same = document.getElementById('field1').value;
			document.getElementById('field2').value = same;			
        }
	
	/* ------------------------------------------------------ */
</script>