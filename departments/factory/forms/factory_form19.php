<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="19";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form_new.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
		    $results=$p->fetch_assoc();		
		    $form_id=$results["form_id"];$appli_sign=$results["appli_sign"];
	}else{
		$form_id="";$appli_sign="";
	}
 }else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$appli_sign=$results["appli_sign"];
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
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th>Sl. No. </th>
														<th>Department/works</th>
														<th>Name of Worker</th>
														<th>Sex </th>
														<th>Age (on Last Birthday)</th>
														<th colspan="2">Occupation</th>
														<th colspan="2">Examination of eye sight</th>
														<th>Signature of Ophthalmologist</th>
														<th>Remarks</th>
													</tr>
													<tr>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th></th>
														<th>Nature</th>
														<th>Date of Employment</th>
														<th>Date</th>
														<th>Result</th>
													</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num1 = $part1->num_rows;
												if($num1>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["works"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>" ></td>									
														<td><input value="<?php echo $row_1["name_worker"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["sex"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["age_birthday"]; ?>" id="txtE<?php echo $count;?>" class="dob form-control" name="txtE<?php echo $count;?>"></td>														
														<td><input value="<?php echo $row_1["nature"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["employment_dt"]; ?>" id="txtG<?php echo $count;?>" class="dob form-control" name="txtG<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["occu_date"]; ?>" id="txtH<?php echo $count;?>" class="dob form-control" name="txtH<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["eye_result"]; ?>" id="txtI<?php echo $count;?>" class="form-control text-uppercase" name="txtI<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["signature"]; ?>" id="txtJ<?php echo $count;?>" class="form-control text-uppercase" name="txtJ<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtK<?php echo $count;?>" class="form-control text-uppercase" name="txtK<?php echo $count;?>"></td>
														
													</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" name="txtB1" ></td>					
														<td><input id="txtC1" class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1" class="form-control text-uppercase" name="txtF1"></td>
														<td><input id="txtG1" class="dob form-control" name="txtG1"></td>
														<td><input id="txtH1" class="dob form-control" name="txtH1"></td>
														<td><input id="txtI1" class="form-control text-uppercase" name="txtI1"></td>
														<td><input id="txtJ1" class="form-control text-uppercase" name="txtJ1"></td>
														<td><input id="txtK1" class="form-control text-uppercase" name="txtK1"></td>
														
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>											
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : &nbsp;<input type="text" class="form-control text-uppercase" name="appli_sign" value="<?php echo $appli_sign; ?>"></td>
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