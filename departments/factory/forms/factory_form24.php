<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="24";
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
		    $form_id=$results["form_id"];$name_factory=$results["name_factory"];$appli_sign=$results["appli_sign"];
	}else{
		$form_id="";$name_factory="";$appli_sign="";
	}
 }else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$name_factory=$results["name_factory"];$appli_sign=$results["appli_sign"];
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
									      <td align="center" colspan="4"><b>Muster Roll</b></td>
										</tr>
										<tr>
										   <td width="25%">Name of Factory:</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="name_factory" value="<?php echo $name_factory; ?>" ></td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th>Sl. No. </th>
														<th>Name of Worker</th>
														<th>Father's Name </th>
														<th>Nature of work</th>
														<th>For the period ending</th>
														<th>Remarks</th>
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
														<td><input value="<?php echo $row_1["name_worker"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>" ></td>									
														<td><input value="<?php echo $row_1["fathers_name"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["nature_work"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["period_end"]; ?>" id="txtE<?php echo $count;?>" class="dob form-control" name="txtE<?php echo $count;?>"></td>														
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
														
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
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div>
											</td>
										</tr>
                                    <tr>
									      <td align="center" colspan="4"><b>Register of Accidents and Dangerous Occurrences</b></td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th>Sl. No. </th>
														<th>Name of injured person(if any)</th>
														<th>Date of accident or dangerous occurrence </th>
														<th>Date of report(in form no 18) to Inspector</th>
														<th>Nature of accident or dangerous occurrence</th>
														<th>Date of return of injured person to work</th>
														<th>Number of days the injured person was absents from work</th>
													</tr>
												</thead>
												<?php
												$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){	?>
													<tr>
														<td><input readonly="readonly" id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_2["injured_person"]; ?>" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" name="txxtB<?php echo $count;?>" ></td>									
														<td><input value="<?php echo $row_2["date_of_accident"]; ?>" id="txxtC<?php echo $count;?>" class="dob form-control" name="txxtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_2["date_of_report"]; ?>" id="txxtD<?php echo $count;?>" class="dob form-control" name="txxtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_2["nature_accident"]; ?>" id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>"></td>								
														<td><input value="<?php echo $row_2["date_of_return"]; ?>" id="txxtF<?php echo $count;?>" class="dob form-control" name="txxtF<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_2["number_days"]; ?>" id="txxtG<?php echo $count;?>" class="form-control text-uppercase" name="txxtG<?php echo $count;?>"></td>
													</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txxtA1" size="1" class="form-control text-uppercase"; name="txxtA1"></td>
														<td><input id="txxtB1" class="form-control text-uppercase" name="txxtB1" ></td>					
														<td><input id="txxtC1" class="dob form-control" name="txxtC1"></td>	
														<td><input id="txxtD1" class="dob form-control" name="txxtD1"></td>
														<td><input id="txxtE1" class="form-control text-uppercase" name="txxtE1"></td>
														<td><input id="txxtF1" class="dob form-control" name="txxtF1"></td>
														<td><input id="txxtG1" class="form-control text-uppercase" name="txxtG1"></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
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