<?php  require_once "../../requires/login_session.php";
$dept="tcp";
$form="7";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_tcp_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];
			$address=$results["address"];$conforms_to=$results["conforms_to"];$inst_address =$results["inst_address"];$zone =$results["zone"];
		}else{
			$form_id="";
			$address="";$conforms_to="";$inst_address="";$zone="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$address=$results["address"];$conforms_to=$results["conforms_to"];$inst_address =$results["inst_address"];$zone =$results["zone"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4" class="form-inline">
												Subject: Self Certification of ground based tower/composite structure (roof top tower + building) for communication network.<br/><br/>
												It is certified that the Ground based tower/composite structure (roof top tower + Building), a part of our communication network and located at &nbsp;<input type="text"  class="form-control text-uppercase" name="address" value="<?php echo $address?>"> &nbsp;conforms to &nbsp;<input type="text"  class="form-control text-uppercase" name="conforms_to" value="<?php echo $conforms_to;?>">&nbsp;GR issued by TEC, DoT/design approved by &nbsp <input type="text"  class="form-control text-uppercase" name="inst_address" value="<?php echo $inst_address;?>">&nbsp;(name and address of the institute, etc.). The tower/composite structure (rooftop tower + building) falling under seismic zone&nbsp;<input type="text"  class="form-control text-uppercase" name="zone" value="<?php echo $zone;?>">&nbsp;is compliant to the latest BIS code IS 1893 and other provisions envisaged in the instructions issued by DoT from time to time. The relevant particulars are as per datasheet enclosed.
											</td> 
										</tr>
										<tr>
											<td>Date : <strong><?=date('d-m-Y',strtotime($today));?></strong></td>
											<td></td>
											<td></td>
											<td align="right">Signature Of the Applicant : <br/><strong><?=strtoupper($key_person);?></strong></td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">				
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>	
