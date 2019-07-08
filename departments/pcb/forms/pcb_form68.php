<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="68";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form_new1.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$date_acci=$results['date_acci'];$event_seq=$results['event_seq'];$type_construction=$results['type_construction'];$effects_accidents=$results['effects_accidents'];$emergency_measure=$results['emergency_measure'];
		$monthly_health=$results['monthly_health'];$is_collection=$results['is_collection'];$is_processing=$results['is_processing'];
		
		if(!empty($results["steps"])){
				$steps=json_decode($results["steps"]);
				$steps_effects=$steps->effects;$steps_recurrence=$steps->recurrence;
		}else{
				$steps_effects="";$steps_recurrence="";
        }
		if(!empty($results["collection"])){
				$collection=json_decode($results["collection"]);
				$collection_treatment=$collection->treatment;$collection_recycling=$collection->recycling;$collection_authority=$collection->authority;$collection_authority1=$collection->authority1;
		}else{
				$collection_treatment="";$collection_recycling="";$collection_authority="";$collection_authority1="";
        }
		
	}else{
		$form_id="";$date_acci="";$event_seq="";$type_construction="";$effects_accidents="";$emergency_measure="";$monthly_health="";$is_collection="";$is_processing="";
		$steps_effects="";$steps_recurrence="";$collection_treatment="";$collection_recycling="";$collection_authority="";$collection_authority1="";
	}
}else{
	$results=$q->fetch_assoc();
	    $form_id=$results['form_id'];
		$date_acci=$results['date_acci'];$event_seq=$results['event_seq'];$type_construction=$results['type_construction'];$effects_accidents=$results['effects_accidents'];$emergency_measure=$results['emergency_measure'];
		$monthly_health=$results['monthly_health'];$is_collection=$results['is_collection'];$is_processing=$results['is_processing'];
		
		if(!empty($results["steps"])){
				$steps=json_decode($results["steps"]);
				$steps_effects=$steps->effects;$steps_recurrence=$steps->recurrence;
		}else{
				$steps_effects="";$steps_recurrence="";
        }
		if(!empty($results["collection"])){
				$collection=json_decode($results["collection"]);
				$collection_treatment=$collection->treatment;$collection_recycling=$collection->recycling;$collection_authority=$collection->authority;$collection_authority1=$collection->authority1;
		}else{
				$collection_treatment="";$collection_recycling="";$collection_authority="";$collection_authority1="";
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1.Date and Time of Accident  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="date_acci" value="<?php echo $date_acci;?>" ></td>
											
											<td width="25%">2.Sequence of events leading to accidents  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="event_seq" value="<?php echo $event_seq;?>" ></td>
											
										</tr>
										<tr>
											<td width="25%">3.The type of construction and demolition waste involved in accident  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="type_construction" value="<?php echo $type_construction;?>" ></td>
											
											<td width="25%">4. Assessment of the effects of the accidents
											a. on traffic, drainage system and the environment  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="effects_accidents" value="<?php echo $effects_accidents;?>" ></td>
											
										</tr>
										<tr>
											<td width="25%">5.Emergency measures taken </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="emergency_measure" value="<?php echo $emergency_measure;?>" ></td>
											
											<td width="25%">6.Steps taken to alleviate the effects
											a. of accidents</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="steps[effects]" value="<?php echo $steps_effects;?>" ></td>
											
										</tr>
										<tr>
											<td width="25%">7.Steps taken to prevent the recurrence
											a. of such an accident </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="steps[recurrence]" value="<?php echo $steps_recurrence;?>" ></td>
											
											<td width="25%">8.Regular monthly health check up of workers at </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="monthly_health" value="<?php echo $monthly_health;?>" ></td>
											
										</tr>
										<tr>
											<td>9. a. Processing / recycling site shall be made</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" value="Y" <?php if($is_processing=="Y" || $is_processing=="") echo "checked"; ?> id="inlineRadio1" name="is_processing"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_processing=="N") echo "checked"; ?> id="inlineRadio1" name="is_processing"> No </label>
											</td>
									  </tr>
									  <tr>
											<td>10. Any accident during the collection ?</td>
											<td colspan="2">
											<label class="radio-inline"><input type="radio" value="Y" <?php if($is_collection=="Y" || $is_collection=="") echo "checked"; ?> id="inlineRadio1" name="is_collection"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_collection=="N") echo "checked"; ?> id="inlineRadio1" name="is_collection"> No </label>
											</td>
										</tr>
										<tr>
											<td width="25%">a. Transportation and treatment including</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="collection[treatment]" value="<?php echo $collection_treatment;?>" ></td>
											
											<td width="25%">b. Processing and recycling should be informed</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="collection[recycling]" value="<?php echo $collection_recycling;?>" ></td>
											
										</tr>
										<tr>
											<td width="25%">c. To the Competent Authority (Local Authority) or</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="collection[authority]" value="<?php echo $collection_authority;?>" ></td>
											
											<td width="25%">d. Prescribed Authority</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="collection[authority1]" value="<?php echo $collection_authority1;?>" ></td>
											
										</tr>
										<tr>
											<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right"><br/> Signature :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
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