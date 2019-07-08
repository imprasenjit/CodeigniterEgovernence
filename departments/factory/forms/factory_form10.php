<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="10";
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
		$form_id=$results["form_id"];$manager_sign=$results['manager_sign'];
	}else{
		$form_id="";$manager_sign="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$manager_sign=$results['manager_sign'];
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
											<td colspan="4" class="text-center"><strong>RECORD OF LIMEWASHING, PAINTING, ETC. </strong></td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th width="4%">Sl. No. </th>
														<th width="16%">Parts of factory e.g., Name of room </th>
														<th width="20%">Parts limewashed, painted, varnished or oiled, e.g., walls, ceilings, wood work etc. </th>
														<th width="17%">Treatment, whether limewashed, painted, varnished or oiled </th>
														<th width="20%">Date on which limewashing, painting, varnishing or oiling was carried out (according to the English calendar) </th>
														<th width="18%">Remarks </th>
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
														<td><input value="<?php echo $row_1["parts"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["treat"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["treat_date"]; ?>" id="txtE<?php echo $count;?>" class="dob form-control" name="txtE<?php echo $count;?>"></td>														
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
													</tr>	
													<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" name="txtB1" ></td>					
														<td><input id="txtC1" class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" class="dob form-control" name="txtE1"></td>
														<td><input id="txtF1" class="form-control text-uppercase" name="txtF1"></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>											
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature of Manager : &nbsp;<input type="text" class="form-control text-uppercase" name="manager_sign" value="<?php echo $manager_sign; ?>"></td>
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