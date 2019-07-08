<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="42";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_bw_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$accident_type=$results['accident_type'];$seq_of_events=$results['seq_of_events'];$is_auth_informed=$results['is_auth_informed'];$accident_waste_type=$results['accident_waste_type'];$effects_of_accidents=$results['effects_of_accidents'];$measures_taken=$results['measures_taken'];$steps_taken_all=$results['steps_taken_all'];$steps_taken_prevent=$results['steps_taken_prevent'];
		$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
	}else{
		$form_id="";
		$accident_type="";$seq_of_events="";$is_auth_informed="";$accident_waste_type="";$effects_of_accidents="";$measures_taken="";$steps_taken_all="";$steps_taken_prevent="";
		$is_facilities_details="";$is_facilities="";
	}
}else{	
	$results=$q->fetch_assoc();		
	$form_id=$results['form_id'];
	$accident_type=$results['accident_type'];$seq_of_events=$results['seq_of_events'];$is_auth_informed=$results['is_auth_informed'];$accident_waste_type=$results['accident_waste_type'];$effects_of_accidents=$results['effects_of_accidents'];$measures_taken=$results['measures_taken'];$steps_taken_all=$results['steps_taken_all'];$steps_taken_prevent=$results['steps_taken_prevent'];
	$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
}
?>
<?php require_once "../../requires/header.php";   ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center">
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
                            <form name="myform1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. Date and time of accident  :</td> 
										<td width="25%"><input type="text" class="dob form-control text-uppercase" value="<?php echo $today?>" disabled="disabled" ></td>
										<td width="25%">2. Type of Accident  :</td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $accident_type?>" name="accident_type" ></td>
									</tr>	
									<tr>	
										<td width="25%">3. Sequence of events leading to accident : </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="seq_of_events" value="<?php echo $seq_of_events;?>"></td>
										<td width="25%">4. Has the Authority been informed immediately : </td>
										<td><label class="radio-inline"><input type="radio" name="is_auth_informed" class="is_auth_informed" value="Y"  <?php if(isset($is_auth_informed) && $is_auth_informed=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_auth_informed"  value="N"  name="is_auth_informed" <?php if(isset($is_auth_informed) && ($is_auth_informed=='N' || $is_auth_informed==='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td width="25%">5. The type of waste involved in accident :</td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="accident_waste_type" value="<?php echo $accident_waste_type?>"  ></td>
										<td width="25%">6. Assessment of the effects of the accidents on human health and the environment : </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="effects_of_accidents" value="<?php echo $effects_of_accidents;?>"></td></tr>
									<tr>
										<td >7. Emergency measures taken :</td> 
										<td ><input type="text" class="form-control text-uppercase" name="measures_taken" value="<?php echo $measures_taken?>" ></td>
										<td ></td> 
										<td ></td>	
									</tr>
									<tr>
										<td >8. Steps taken to alleviate the effects of accidents : </td>
										<td><textarea class="form-control text-uppercase" name="steps_taken_all" validate="textarea" ><?php echo $steps_taken_all;?></textarea></td>
										<td>9. Steps taken to prevent the recurrence of such an accident :</td>
										<td><textarea class="form-control text-uppercase" name="steps_taken_prevent" validate="textarea" ><?php echo $steps_taken_prevent;?></textarea></td>
									</tr>
									<tr>
										<td>10. Does you facility has an Emergency Control policy?</td>
										<td><label class="radio-inline"><input type="radio" name="is_facilities" class="is_facilities" value="Y"  <?php if(isset($is_facilities) && $is_facilities=='Y') echo 'checked'; ?> /> Yes</label>
										<label class="radio-inline"><input type="radio" class="is_facilities"  value="N"  name="is_facilities" <?php if(isset($is_facilities) && ($is_facilities=='N' || $is_facilities=='')) echo 'checked'; ?>/> No</label></td>
										<td width="25%">If yes give details:</td>
										<td width="25%"><textarea name="is_facilities_details" class="form-control text-uppercase" id="is_facilities_details" validate="textarea" ><?php echo $is_facilities_details; ?></textarea></td>
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
	$('#is_facilities_details').attr('readonly','readonly');
	<?php if($is_facilities == 'Y') echo "$('#is_facilities_details').removeAttr('readonly','readonly');"; ?>
	$('.is_facilities').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_facilities_details').removeAttr('readonly','readonly');
		}else{
			$('#is_facilities_details').attr('readonly','readonly');
			$('#is_facilities_details').val('');
		}			
	});
	/* ----------------------------------------------------- */
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
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>