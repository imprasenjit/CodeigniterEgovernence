<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="19";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_sw_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$seq_of_events=$results['seq_of_events'];$accident_waste=$results['accident_waste'];$effects_of_accidents=$results['effects_of_accidents'];$measures_taken=$results['measures_taken'];$steps_taken_all=$results['steps_taken_all'];$steps_taken_prevent=$results['steps_taken_prevent'];
	}else{		
		$form_id="";
		$seq_of_events="";$accident_waste="";$effects_of_accidents="";$measures_taken="";$steps_taken_all="";$steps_taken_prevent="";
	}
}else{	
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$seq_of_events=$results['seq_of_events'];$accident_waste=$results['accident_waste'];$effects_of_accidents=$results['effects_of_accidents'];$measures_taken=$results['measures_taken'];$steps_taken_all=$results['steps_taken_all'];$steps_taken_prevent=$results['steps_taken_prevent'];
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
							   <div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Date and time of accident :</td> 
										<td width="25%"><input type="text" class="dob form-control text-uppercase" value="<?php echo $today?>" disabled="disabled" ></td>
										<td width="25%">2. Sequence of events leading to accident : </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="seq_of_events" value="<?php echo $seq_of_events;?>"></td>								
									</tr>
									<tr>
										<td width="25%">3. The waste involved in accident :</td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="accident_waste" value="<?php echo $accident_waste?>"  ></td>
										<td width="25%">4. Assessment of the effects of the accidents on human health and the environment : </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="effects_of_accidents" value="<?php echo $effects_of_accidents;?>"></td>
									</tr>
									<tr>
										<td >5. Emergency measures taken :</td> 
										<td ><input type="text" class="form-control text-uppercase" name="measures_taken" value="<?php echo $measures_taken?>" ></td>
										<td >6. Steps taken to alleviate the effects of accidents : </td>
										<td><textarea class="form-control text-uppercase" name="steps_taken_all" validate="textarea" ><?php echo $steps_taken_all;?></textarea></td>
									</tr>
									<tr>
										<td colspan="3">7. Steps taken to prevent the recurrence of such an accident :</td>
										<td><textarea class="form-control text-uppercase" name="steps_taken_prevent" validate="textarea" ><?php echo $steps_taken_prevent;?></textarea></td>
										<td ></td> 
										<td ></td>									
									</tr>
									<tr>
										<td>
										   Date: &emsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong>
										   <br/>
										   Place: &emsp;<strong><?php echo strtoupper($dist)?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature :&emsp; <strong><?php echo strtoupper($key_person); ?></strong><br/>
										Designation :&emsp;<strong> <?php echo strtoupper($status_applicant); ?></strong><br/> </td>
									</tr>					
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save?')">Save and Next</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>