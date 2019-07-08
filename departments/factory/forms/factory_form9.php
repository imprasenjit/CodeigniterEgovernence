<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="9";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$serial_no=$results['serial_no'];$works_no=$results['works_no'];$worker_name=$results['worker_name'];$sex=$results['sex'];$age=$results['age'];$employ_date=$results['employ_date'];$leave_date=$results['leave_date'];$reason=$results['reason'];$nature=$results['nature'];$raw_material=$results['raw_material'];$sus_period=$results['sus_period'];$sus_reason=$results['sus_reason'];$resume_dt=$results['resume_dt'];$is_issued=$results['is_issued'];$surgeon_sign=$results['surgeon_sign'];
	}else{
		$form_id="";
		$serial_no="";$works_no="";$worker_name="";$sex="";$age="";$employ_date="";$leave_date="";$reason="";$nature="";$raw_material="";$sus_period="";$sus_reason="";$resume_dt="";$is_issued="";$surgeon_sign="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$serial_no=$results['serial_no'];$works_no=$results['works_no'];$worker_name=$results['worker_name'];$sex=$results['sex'];$age=$results['age'];$employ_date=$results['employ_date'];$leave_date=$results['leave_date'];$reason=$results['reason'];$nature=$results['nature'];$raw_material=$results['raw_material'];$sus_period=$results['sus_period'];$sus_reason=$results['sus_reason'];$resume_dt=$results['resume_dt'];$is_issued=$results['is_issued'];$surgeon_sign=$results['surgeon_sign'];
}
?>

<?php require_once "../../requires/header.php";   ?>
   <?php include ("".$table_name."_addmore.php"); ?>
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
											<td colspan="4">1. Name of Certifying Surgeon : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th>Sl. No.</th>
														<th>Name </th>
														<th>From </th>
														<th>To </th>
													</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>" ></td>									
														<td><input value="<?php echo $row_1["from_dt"]; ?>" id="txtC<?php echo $count;?>" class="dob form-control" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["to_dt"]; ?>" id="txtD<?php echo $count;?>" class="dob form-control" name="txtD<?php echo $count;?>"></td>
													</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" name="txtB1" ></td>					
														<td><input id="txtC1" class="dob form-control" name="txtC1"></td>	
														<td><input id="txtD1" class="dob form-control" name="txtD1"></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td width="25%">2. Serial No. : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="serial_no" value="<?php echo $serial_no; ?>"></td>
											<td width="25%">3. Works No. : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="works_no" value="<?php echo $works_no; ?>"></td>
										</tr>
										<tr>
											<td>4. Name of worker : </td>
											<td><input type="text" class="form-control text-uppercase" name="worker_name" value="<?php echo $worker_name; ?>"></td>
											<td>5. Sex : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="sex" value="M"  <?php if(isset($sex) && $sex=='M') echo 'checked'; ?> /> Male </label>
												<label class="radio-inline"><input type="radio" value="F"  name="sex" <?php if(isset($sex) && ($sex=='F' || $sex=='')) echo 'checked'; ?>/> Female</label>
											</td>
										</tr>
										<tr>
											<td>6. Age : </td>
											<td><input type="text" class="form-control text-uppercase" name="age" value="<?php echo $age; ?>"></td>
											<td>7. Date of employment on present work : </td>
											<td><input type="date" class="dob form-control" name="employ_date" value="<?php echo $employ_date; ?>"></td>
										</tr>
										<tr>
											<td>8. Date of leaving or transfer to other works : </td>
											<td><input type="date" class="dob form-control" name="leave_date" value="<?php echo $leave_date; ?>"></td>
											<td>9. Reason for leaving, transfer or discharge : </td>
											<td><input type="text" class="form-control text-uppercase" name="reason" value="<?php echo $reason; ?>"></td>											
										</tr>
										<tr>
											<td>10. Nature of job or occupation : </td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
											<td>11. Raw material or by-product handled : </td>
											<td><input type="text" class="form-control text-uppercase" name="raw_material" value="<?php echo $raw_material; ?>"></td>											
										</tr>
										<tr>
											<td colspan="4">12. Details of Medical Examination : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable2" class="table table-responsive table-bordered  text-center" id="objectTable2" >
												<thead>
													<tr>  
														<th>Sl No. </th>
														<th>Dates of Medical Examination by Certifying Surgeon </th>
														<th>Result of Medical Examination </th>
													</tr>
												</thead>
												<?php
												$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_2["exam_dt"]; ?>" id="textB<?php echo $count;?>" class="dob form-control" name="textB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_2["result"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" placeholder="Fit/ Unfit/ Suspended"></td>
													</tr>	
												<?php $count++; } 
												}else{?>
													<tr>
														<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" class="dob form-control" name="textB1"></td>
														<td><input id="textC1" class="form-control text-uppercase" name="textC1" placeholder="Fit/ Unfit/ Suspended"></td>	
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>										
										<tr>
											<td>13. If suspended from work, state period of suspension with detailed reason : </td>
											<td><input type="text" class="form-control text-uppercase" name="sus_period" value="<?php echo $sus_period; ?>" placeholder="Period of Suspension"></td>	
											<td><textarea class="form-control text-uppercase" name="sus_reason" placeholder="Reason of Suspension"><?php echo $sus_reason; ?></textarea></td>
											<td></td>
										</tr>											
										<tr>
											<td>14. Recertified fit to resume duty on : </td>
											<td><input type="date" class="dob form-control" name="resume_dt" value="<?php echo $resume_dt; ?>"></td>	
											<td>15. If certificate of unfitness or suspension issued to worker : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_issued" value="Y"  <?php if(isset($is_issued) && $is_issued=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_issued" <?php if(isset($is_issued) && ($is_issued=='N' || $is_issued=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>												
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature of Certifying Surgeon : &nbsp;<input type="text" class="form-control text-uppercase" name="surgeon_sign" value="<?php echo $surgeon_sign; ?>"></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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