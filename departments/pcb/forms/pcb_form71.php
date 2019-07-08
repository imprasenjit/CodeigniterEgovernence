<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="71";
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
		$form_id=$results['form_id'];
		$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$ewaste_details=$results['ewaste_details'];$safety=$results['safety'];$facilities=$results['facilities'];
		
		if(!empty($results["contact"])){
			$contact=json_decode($results["contact"]);
			$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
		}else{				
			$contact_desgn="";$contact_tel="";
		}	
		
		if(!empty($results["waste"])){
			$waste=json_decode($results["waste"]);
			$waste_generate=$waste->generate;$waste_dispose=$waste->dispose;$waste_treat=$waste->treat;
		}else{
			$waste_generate="";$waste_dispose="";$waste_treat="";
		}
	}else{
		$form_id="";$comm_date="";$no_of_workers="";$water_valid="";$air_valid="";$auth_valid="";$ewaste_details="";$safety="";$facilities="";
		$contact_desgn="";$contact_tel="";
		$waste_generate="";$waste_dispose="";$waste_treat="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$comm_date=$results['comm_date'];$no_of_workers=$results['no_of_workers'];$water_valid=$results['water_valid'];$air_valid=$results['air_valid'];$auth_valid=$results['auth_valid'];$ewaste_details=$results['ewaste_details'];$safety=$results['safety'];$facilities=$results['facilities'];
	
	if(!empty($results["contact"])){
		$contact=json_decode($results["contact"]);
		$contact_desgn=$contact->desgn;$contact_tel=$contact->tel;
	}else{				
		$contact_desgn="";$contact_tel="";
	}	
	
	if(!empty($results["waste"])){
		$waste=json_decode($results["waste"]);
		$waste_generate=$waste->generate;$waste_dispose=$waste->dispose;$waste_treat=$waste->treat;
	}else{
		$waste_generate="";$waste_dispose="";$waste_treat="";
	}
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
											<td width="25%">1. Name of Unit :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address of Unit : </td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">3. Details of Contact Person : </td>
										</tr>
										<tr>
											<td>Designation :</td>
											<td><input type="text" class="form-control text-uppercase" name="contact[desgn]" value="<?php echo  $contact_desgn; ?>"></td>
											<td>Telephone/Fax No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="contact[tel]" value="<?php echo $contact_tel; ?>"></td>
										</tr>
										<tr>
											<td>4. Date of Commissioning :</td>
											<td><input type="text" class="dob form-control" name="comm_date" value="<?php echo  $comm_date; ?>"></td>
											<td>5. No.of workers (including contract labour) :</td>
											<td><input type="text" class="form-control text-uppercase" name="no_of_workers" value="<?php echo $no_of_workers; ?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td colspan="4">6. Consents Validity : </td>
										</tr>
										<tr>
											<td>(a) Water (Prevention and Control of Pollution) Act, 1974; Valid up to :</td>
											<td><input type="text" class="dob form-control" name="water_valid" value="<?php echo  $water_valid; ?>"></td>
											<td>(b) Air (Prevention and Control of Pollution) Act, 1981; Valid up to :</td>
											<td><input type="text" class="dob form-control" name="air_valid" value="<?php echo  $air_valid; ?>"></td>
										</tr>
										<tr>
											<td>7. Validity of current authorisation if any :</td>
											<td>E-waste (Management & Handling) Rules, 2011; Valid up to : </td>
											<td><input type="text" class="dob form-control" name="auth_valid" value="<?php echo  $auth_valid; ?>"></td>
											<td></td>
										</tr>
										<tr>
											<td>8. Dismantling or Recycling Process :</td>
											<td colspan="3">Attach complete details in upload section </td>
										</tr>
										<tr>
											<td>9. Installed capacity in MT/year : </td>
											<td colspan="3">
											<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
												<thead>
												<tr> 
													<th>Sl No.</th>
													<th>Products</th>
													<th>Installed capacity (MTA)</th>
												</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["products"]; ?>" id="txtB<?php echo $count;?>" placeholder="Products" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["capacity"]; ?>" id="txtC<?php echo $count;?>" placeholder="Installed capacity (MTA)" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" placeholder="Products" name="txtB1"></td>					
														<td><input id="txtC1" class="form-control text-uppercase" placeholder="Installed capacity (MTA)" name="txtC1"></td>	
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td>10. E-waste processed during last three years : </td>
											<td colspan="3">
											<table name="objectTable2" class="table table-responsive table-bordered "id="objectTable2" >
												<thead>
												<tr>  
													<th>Sl No.</th>
													<th>Year</th>
													<th>Product</th>
													<th>Quantity</th>
												</tr>
												</thead>
												<?php
												$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_2["year"]; ?>" id="textB<?php echo $count;?>" placeholder="Year" class="form-control text-uppercase" name="textB<?php echo $count;?>" maxlength="4" validate="onlyNumbers"></td>
														<td><input value="<?php echo $row_2["product"]; ?>" id="textC<?php echo $count;?>" placeholder="Product" class="form-control text-uppercase" name="textC<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_2["qty"]; ?>" id="textD<?php echo $count;?>" placeholder="Quantity" class="form-control text-uppercase" name="textD<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{?>
													<tr>
														<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" class="form-control text-uppercase" placeholder="Year" name="textB1" maxlength="4" validate="onlyNumbers"></td>
														<td><input id="textC1" class="form-control text-uppercase" placeholder="Product" name="textC1"></td>	
														<td><input id="textD1" class="form-control text-uppercase" placeholder="Quantity" name="textD1"></td>	
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>
										<tr>
										    <td colspan="4">11. Waste Management : </td>
										</tr>
										<tr>
											<td>(a) Waste generation in processing e-waste :</td>
											<td><input type="text" class="form-control text-uppercase" name="waste[generate]" value="<?php echo  $waste_generate; ?>"></td>
											<td>(b) Provide details of disposal of residue :</td>
											<td><input type="text" class="form-control text-uppercase" name="waste[dispose]" value="<?php echo $waste_dispose; ?>"></td>
										</tr>	
										<tr>
											<td>(c) Name of Treatment Storage and Disposal Facility utilized for :</td>
											<td><input type="text" class="form-control text-uppercase" name="waste[treat]" value="<?php echo  $waste_treat; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>12. Details of e-waste proposed to be procured from re-processing (Please provide details) : </td>
											<td><input type="text" class="form-control text-uppercase" name="ewaste_details" value="<?php echo  $ewaste_details; ?>"></td>
											<td>13. Occupational safety and health aspects (Please provide details) : </td>
											<td><input type="text" class="form-control text-uppercase" name="safety" value="<?php echo  $safety; ?>"></td>
										</tr>
										<tr>
											<td>14. Details of Facilities for dismantling both manual as well as mechanised : </td>
											<td><input type="text" class="form-control text-uppercase" name="facilities" value="<?php echo  $facilities; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4" align="right">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
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