<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="14";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id=$swr_id and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
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
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>		
							</div>
							<div class="panel-body">
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. (a) Name of the owner of the Dispensing Units: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the owner of the Dispensing Units:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">2. (a) Name of the Firm: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td>(b) Address of the Firm:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
									</tr>										
									<tr>
										<td colspan="4">3. Details of the New Dispensing Units:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
											<thead>
											<tr>
												<th class="text-center" width="10%"> Sl. No.</th>
												<th class="text-center" width="30%"> Make</th>
												<th class="text-center" width="30%">Model No</th>
												<th class="text-center" width="30%">Sl. No. of D.U</th>
											</tr>
											</thead>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
											<tr>
												<td><input  type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="25"></td>
												<td><input  type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["make"]; ?>" name="txtB<?php echo $count;?>" size="25"></td>
												<td><input   type="text" value="<?php echo $row_1["model_no"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="25" name="txtC<?php echo $count;?>"></td>
												<td><input  type="text" value="<?php echo $row_1["sl_f_du"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" validate="onlyNumbers" size="25"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input  type="text" id="txtA1" value="1" readonly size="25" class="form-control text-uppercase" name="txtA1"></td>
											<td><input  type="text" id="txtB1" size="25"  class="form-control text-uppercase" name="txtB1"></td>					
											<td><input  type="text" id="txtC1" size="25" class="form-control text-uppercase" name="txtC1"></td>
											<td><input  type="text" id="txtD1" size="25" validate="onlyNumbers" class="form-control text-uppercase" name="txtD1"></td>	
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</div>
										</td>
									</tr>
									<tr>
										<td colspan="4">4. Details of the Old Dispensing Units(in case of replacement):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
											<thead>
											<tr>
												<th class="text-center" width="10%"> Sl. No.</th>
												<th class="text-center" width="30%"> Make</th>
												<th class="text-center" width="30%">Model No</th>
												<th class="text-center" width="30%">Sl. No. of D.U</th>
											</tr>
											</thead>
											<?php
											$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
											$num2 = $part2->num_rows;
											if($num2>0){
											  $count=1;
											  while($row_2=$part2->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["make"]; ?>" name="textB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_2["model_no"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="25" name="textC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_2["sl_f_du"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="25" validate="onlyNumbers" name="textD<?php echo $count;?>"></td>
															
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input type="text" id="textB1" size="25"  class="form-control text-uppercase" name="textB1"></td>					
											<td><input type="text" id="textC1" size="25" class="form-control text-uppercase" name="textC1"></td>
											<td><input type="text" id="textD1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="textD1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
										</div>
										</td>
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
											<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>