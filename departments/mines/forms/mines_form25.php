<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="25";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form2.php";
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$regn_no=$results["regn_no"];$license_date=$results["license_date"];$name_of_mineral=$results["name_of_mineral"];$place_of_transport=$results["place_of_transport"];$amount=$results["amount"];
		
		if(!empty($results["period"])){
			$period=json_decode($results["period"]);
			$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
		}else{				
			$period_from_dt="";$period_to_dt="";
		}				  
	}else{
		$form_id="";
		$regn_no="";$license_date="";$name_of_mineral="";$place_of_transport="";$period_from_dt="";$period_to_dt="";$amount="";		
	} 
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$regn_no=$results["regn_no"];$license_date=$results["license_date"];$name_of_mineral=$results["name_of_mineral"];$place_of_transport=$results["place_of_transport"];$amount=$results["amount"];
	
	if(!empty($results["period"])){
		$period=json_decode($results["period"]);
		$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
	}else{				
		$period_from_dt="";$period_to_dt="";
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
											<td width="25%">1. Name of license holder : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $key_person; ?>" ></td>
											<td colspan="2"></td>
										</tr>	
										<tr>
											<td colspan="4">2. Full Address : </td>
										</tr>
										<tr>
											<td width="25%">Street Name1 : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>		
										<tr>
											<td>3. Registration No. of license : </td>
											<td><input type="text" class="form-control text-uppercase" name="regn_no"  value="<?php echo $regn_no; ?>"></td>
											<td>4. Date of license :</td>
											<td><input type="text" class="dob form-control form-control" name="license_date"  value="<?php echo  $license_date; ?>"></td>											
										</tr>
										<tr>
											<td>5. Period of license : <span class="mandatory_field">*</span></td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[from_dt]" placeholder="From Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>										
										<tr>
											<td>6. Name of mineral/ ore is transported : </td>
											<td><input type="text" class="form-control text-uppercase" name="name_of_mineral"  value="<?php echo $name_of_mineral; ?>"></td>
											<td>7. Place from which ore/ mineral is transported : </td>
											<td><input type="text" class="form-control text-uppercase" name="place_of_transport"  value="<?php echo $place_of_transport; ?>"></td>
										</tr>
										<tr>
											<td>8. Total amount of mineral/ ore is transported : </td>
											<td><input type="text" class="form-control text-uppercase" name="amount"  value="<?php echo $amount; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">9. Name of district from which the ore/ mineral is transported : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="4%">Sl. No.</th>
													<th width="15%">Month</th>
													<th width="10%">Date</th>
													<th width="10%">Opening stock to be transported</th>
													<th width="10%">Quantity of mineral/ ore transported</th>
													<th width="10%">Number of supporting transit passes</th>
													<th width="10%">Destination to which ore/ mineral is transported</th>
													<th width="10%">Closing stock of ore/ mineral to be transported</th>
													<th width="15%">Remarks</th>													
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
														<td><input value="<?php echo $row_1["month"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>															
														<td><input value="<?php echo $row_1["date"]; ?>" id="txtC<?php echo $count;?>" class="dob form-control" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["opening"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["transit"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["destination"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["closing"]; ?>" id="txtH<?php echo $count;?>" class="form-control text-uppercase" name="txtH<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtI<?php echo $count;?>" class="form-control text-uppercase" name="txtI<?php echo $count;?>"></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" name="txtB1"></td>					
														<td><input id="txtC1" class="dob form-control" name="txtC1"></td>	
														<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1" class="form-control text-uppercase" name="txtF1"></td>
														<td><input id="txtG1" class="form-control text-uppercase" name="txtG1"></td>
														<td><input id="txtH1" class="form-control text-uppercase" name="txtH1"></td>
														<td><input id="txtI1" class="form-control text-uppercase" name="txtI1"></td>
													</tr>
												<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4" align="right">
											Signature of the licensee :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/>
											Date of submission of the return :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/>
											</td>
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