<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="24";
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
		$regn_no=$results["regn_no"];$date_of_regn=$results["date_of_regn"];
		$name_of_minerals=$results["name_of_minerals"];$name_of_plant=$results["name_of_plant"];
		
		if(!empty($results["period"])){
			$period=json_decode($results["period"]);
			$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
		}else{				
			$period_from_dt="";$period_to_dt="";
		}				  
	}else{
		$form_id="";
		$regn_no="";$date_of_regn="";$name_of_minerals="";$name_of_plant="";$period_from_dt="";$period_to_dt="";		
	} 
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$regn_no=$results["regn_no"];$date_of_regn=$results["date_of_regn"];$name_of_minerals=$results["name_of_minerals"];$name_of_plant=$results["name_of_plant"];
	
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
											<td width="25%">1. Name of the Dealer :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $key_person; ?>" ></td>
											<td colspan="2"></td>
										</tr>	
										<tr>
											<td colspan="4">2. Full Address :</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>		
										<tr>
											<td >3. Registration No.</td>
											<td><input type="text" class="form-control text-uppercase" name="regn_no"  value="<?php echo $regn_no; ?>"></td>
											<td>Date of Registration :</td>
											<td><input type="text" class="dob form-control form-control" name="date_of_regn"  value="<?php echo  $date_of_regn; ?>"></td>											
										</tr>
										<tr>
											<td>4. Period of validity of registration :<span class="mandatory_field">*</span></td>
											<td><input type="text" class="dob form-control text-uppercase" name="period[from_dt]" placeholder="From Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>										
										<tr>
											<td>5. Name of mineral/ ore:</td>
											<td><input type="text" class="form-control text-uppercase" name="name_of_minerals"  value="<?php echo $name_of_minerals; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>6. Name of plant/ factory:</td>
											<td><input type="text" class="form-control text-uppercase" name="name_of_plant"  value="<?php echo $name_of_plant; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">7. Postal address of the factory :</td>
										</tr>
										<tr>										
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2 ; ?>"></td>
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
											<td colspan="4">8. Name of district where the factory is located: </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="4%">Sl. No.</th>
													<th width="15%">Name of months/year</th>
													<th width="10%">Date</th>
													<th width="10%">Opening balance of mineral/ ore at the plant/ crude beneficiated</th>
													<th width="10%">Quantity of mineral/ ore received a plant</th>
													<th width="10%">Quantity of ore/ mineral fed to the beneficiation plant</th>
													<th width="10%">Quantity of ore/ mineral recovered after beneficiation</th>
													<th width="10%">Closing balance of ore/ mineral at the plant crude beneficiated</th>
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
														<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>															
														<td><input value="<?php echo $row_1["date"]; ?>" id="txtC<?php echo $count;?>" class="dob form-control" name="txtC<?php echo $count;?>" ></td>
														<td><input value="<?php echo $row_1["balance"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["mineral"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["ore"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>"></td>
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