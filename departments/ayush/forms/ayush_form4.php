<?php  require_once "../../requires/login_session.php"; 
$dept="ayush";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
    
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
		}else{
			$form_id="";
		}		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
	}	
?>
<?php require_once "../../requires/header.php";   ?>
  <?php include ("".$table_name."_Addmore.php"); ?>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../includes/banner.php'; ?>
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">	
									<tr>									
									   <td colspan="4">
										1. I/We &nbsp;&nbsp;<?php echo strtoupper($owner_names); ?>&nbsp;&nbsp;of &nbsp;&nbsp;<?php echo strtoupper($unit_name); ?>   &nbsp;&nbsp;Hereby apply for the renewal of a license to manufacture Ayurvedic(including Siddha) or Unani drugs on the premises situated at &nbsp;&nbsp;<?php echo strtoupper($vill); ?>
										</td>
									</tr>
									<tr>
										<td colspan="4">2. Name of Drugs to be manufactured. :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="45%">Name</th>
													<th width="45%">Details</th>
													
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["drugs_name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["drugs_det"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>	
														
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">3. Names, Qualification and Experience of technical staff employed for manufacture and testing of Ayurvedic(including Siddha) or Unani Drugs. :
											<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Name</th>
													<th width="30%">Qualification</th>
													<th width="30%">Experience</th>
													
												</tr>
												</thead>
												<?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_2["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["experience"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
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
			</div>
		</section>
	</div>
	  <!-- /.content-wrapper -->
	<?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>