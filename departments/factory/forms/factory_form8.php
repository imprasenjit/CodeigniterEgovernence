<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="8";
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
		$form_id=$results["form_id"];$department=$results['department'];$mark=$results['mark'];$position=$results['position'];
	}else{
		$form_id="";$department="";$mark="";$position="";
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$department=$results['department'];$mark=$results['mark'];$position=$results['position'];
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
											<td width="25%">1. Department : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="department" value="<?php echo  $department; ?>"></td>
											<td width="25%">2. Hygrometer Distinctive mark or number : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="mark" value="<?php echo  $mark; ?>"></td>
										</tr>
										<tr>
											<td>3. Position in Department : </td>
											<td><input type="text" class="form-control text-uppercase" name="position" value="<?php echo $position; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">4. Readings of Hygrometer : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th rowspan="2">Date, Month </th>
														<th rowspan="2">Year </th>
														<th colspan="2">Between 7 and 9 a.m. </th>
														<th colspan="2">Between 11 a.m. and 12 p.m. (but not in the rest period) </th>
														<th colspan="2">Between 4 and 5:30 p.m. </th>
														<th rowspan="2">If no humidity insert none </th>
														<th rowspan="2">Remarks </th>
													</tr>
													<tr>
														<th>Dry bulb </th>
														<th>Wet bulb </th>
														<th>Dry bulb </th>
														<th>Wet bulb </th>
														<th>Dry bulb </th>
														<th>Wet bulb </th>
													</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input value="<?php echo $row_1["dt_mon"]; ?>" id="txtA<?php echo $count;?>" class="form-control text-uppercase" name="txtA<?php echo $count;?>" ></td>
														
														<td><input value="<?php echo $row_1["year"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>" validate="onlyNumbers" maxlength="4"></td>									
														<td><input value="<?php echo $row_1["dry1"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["wet1"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["dry2"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["wet2"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["dry3"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["wet3"]; ?>" id="txtH<?php echo $count;?>" class="form-control text-uppercase" name="txtH<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["humidity"]; ?>" id="txtI<?php echo $count;?>" class="form-control text-uppercase" name="txtI<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtJ<?php echo $count;?>" class="form-control text-uppercase" name="txtJ<?php echo $count;?>"></td>
													</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input id="txtA1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" name="txtB1" validate="onlyNumbers" maxlength="4"></td>					
														<td><input id="txtC1" class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1" class="form-control text-uppercase" name="txtF1"></td>
														<td><input id="txtG1" class="form-control text-uppercase" name="txtG1"></td>
														<td><input id="txtH1" class="form-control text-uppercase" name="txtH1"></td>
														<td><input id="txtI1" class="form-control text-uppercase" name="txtI1"></td>
														<td><input id="txtJ1" class="form-control text-uppercase" name="txtJ1"></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">Certified that the above entries are correct. </td>
										</tr>
										<tr>
											<td colspan="4" align="right">Signature : &nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
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