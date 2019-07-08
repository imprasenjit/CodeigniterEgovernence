<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="66";
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
		
		
		if(!empty($results["steps"])){
				$steps=json_decode($results["steps"]);
				$steps_effects=$steps->effects;$steps_recurrence=$steps->recurrence;
		}else{
				$steps_effects="";$steps_recurrence="";
        }
	}else{
		$form_id="";$date_acci="";$event_seq="";$type_construction="";$effects_accidents="";$emergency_measure="";
		$steps_effects="";$steps_recurrence="";
	}
}else{
	$results=$q->fetch_assoc();
	    $form_id=$results['form_id'];
		$date_acci=$results['date_acci'];$event_seq=$results['event_seq'];$type_construction=$results['type_construction'];$effects_accidents=$results['effects_accidents'];$emergency_measure=$results['emergency_measure'];
		
		
		if(!empty($results["steps"])){
				$steps=json_decode($results["steps"]);
				$steps_effects=$steps->effects;$steps_recurrence=$steps->recurrence;
		}else{
				$steps_effects="";$steps_recurrence="";
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
											<td width="25%">1.The date and time of the accident  </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="date_acci" value="<?php echo $date_acci;?>" ></td>
											
											<td width="25%">2.Sequence of events leading to accident </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="event_seq" value="<?php echo $event_seq;?>" ></td>
										</tr>
										<tr>
											<td width="25%">3.Details of hazardous and other wastes involved in accident  </td>
											<td><textarea class="form-control text-uppercase" name="type_construction"><?php echo $type_construction;?></textarea></td>
											<td width="25%">4. The date for assessing the effects of the accident on health or the environment  </td>
											<td width="25%"><input type="text" class="dob form-control text-uppercase" name="effects_accidents" value="<?php echo $effects_accidents;?>" ></td>
										</tr>
										<tr>
											<td width="25%">5.The emergency measures taken </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="emergency_measure" value="<?php echo $emergency_measure;?>" ></td>
											<td width="25%">6.The steps taken to alleviate the effects of accidents</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="steps[effects]" value="<?php echo $steps_effects;?>" ></td>
										</tr>
										<tr>
											<td width="25%">7.The steps take to prevent the recurrence of such an accident </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="steps[recurrence]" value="<?php echo $steps_recurrence;?>" ></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td width="25%">Date</td>
											<td width="25%"><?php echo date('d-m-Y',strtotime($today)); ?></td>
											<td>Place</td>
											<td><?php echo strtoupper($dist)?></td>
										</tr>
										<tr>
											<td>Signature</td>
											<td><?php echo strtoupper($dist)?></td>
											<td width="25%">Designation</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="status_applicant" value="<?php echo $status_applicant;?>" ></td>
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