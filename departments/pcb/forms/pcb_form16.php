<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="16";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_ew_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		//PART I
		$dt_of_comm=$results["dt_of_comm"];$no_of_workers=$results["no_of_workers"];$auth_val=$results["auth_val"];
		//PART II
		$treatment_storage=$results["treatment_storage"];
		//PART III
		$is_indus_provided=$results['is_indus_provided'];$adq_system=$results['adq_system'];$is_indus_compli=$results['is_indus_compli'];
				
		if(!empty($results["consent_val"])){
			$consent_val=json_decode($results["consent_val"]);
			$consent_val_water=$consent_val->water;$consent_val_air=$consent_val->air;
		}else{
			$consent_val_water="";$consent_val_air="";
		}	
		if(!empty($results["pro_manufac"])){
			$pro_manufac=json_decode($results["pro_manufac"]);
			$pro_manufac_year1=$pro_manufac->year1;$pro_manufac_prod1=$pro_manufac->prod1;$pro_manufac_qty1=$pro_manufac->qty1;$pro_manufac_year2=$pro_manufac->year2;$pro_manufac_prod2=$pro_manufac->prod2;$pro_manufac_qty2=$pro_manufac->qty2;
			$pro_manufac_year3=$pro_manufac->year3;$pro_manufac_prod3=$pro_manufac->prod3;$pro_manufac_qty3=$pro_manufac->qty3;
		}else{
			$pro_manufac_year1="";$pro_manufac_prod1="";$pro_manufac_qty1="";$pro_manufac_year2="";$pro_manufac_prod2="";$pro_manufac_qty2="";$pro_manufac_year3="";$pro_manufac_prod3="";$pro_manufac_qty3="";
		}	
		if(!empty($results["raw_mat_con"])){
			$raw_mat_con=json_decode($results["raw_mat_con"]);
			$raw_mat_con_year1=$raw_mat_con->year1;$raw_mat_con_prod1=$raw_mat_con->prod1;$raw_mat_con_qty1=$raw_mat_con->qty1;$raw_mat_con_year2=$raw_mat_con->year2;$raw_mat_con_prod2=$raw_mat_con->prod2;$raw_mat_con_qty2=$raw_mat_con->qty2;$raw_mat_con_year3=$raw_mat_con->year3;$raw_mat_con_prod3=$raw_mat_con->prod3;$raw_mat_con_qty3=$raw_mat_con->qty3;
		}else{
			$raw_mat_con_year1="";$raw_mat_con_prod1="";$raw_mat_con_qty1="";$raw_mat_con_year2="";$raw_mat_con_prod2="";$raw_mat_con_qty2="";$raw_mat_con_year3="";$raw_mat_con_prod3="";$raw_mat_con_qty3="";
		}		
		//Part II
		if(!empty($results["water_cs"])){
			$water_cs=json_decode($results["water_cs"]);
			$water_cs_i1=$water_cs->i1;$water_cs_d1=$water_cs->d1;$water_cs_cess=$water_cs->cess;$water_cs_waste_water=$water_cs->waste_water;$water_cs_i2=$water_cs->i2;$water_cs_d2=$water_cs->d2;$water_cs_qty=$water_cs->qty;$water_cs_an=$water_cs->an;
		}else{
			$water_cs_i1="";$water_cs_d1="";$total_qty_r_typ="";$water_cs_cess="";$water_cs_waste_water="";$water_cs_i2="";$water_cs_d2="";$water_cs_qty="";$water_cs_an="";
		}				
		//partIII
		if(!empty($results["ew_details"])){
			$ew_details=json_decode($results["ew_details"]);
			$ew_details_name=$ew_details->name;$ew_details_qty_req=$ew_details->qty_req;$ew_details_basel_no=$ew_details->basel_no;				
		}else{
			$ew_details_name="";$ew_details_qty_req="";$ew_details_basel_no="";
		}	
		if(!empty($results["any_other_info"])){
			$any_other_info=json_decode($results["any_other_info"]);
			$any_other_info_a=$any_other_info->a;$any_other_info_b=$any_other_info->b;
		}else{
			$any_other_info_a="";$any_other_info_b="";
		}
	}else{
		//PART I	
		$form_id="";$dt_of_comm="";$no_of_workers="";$auth_val=""; $consent_val_water="";$consent_val_air="";
		//PART II
		$treatment_storage="";
		$water_cs_i1="";$water_cs_d1="";$total_qty_r_typ="";$water_cs_cess="";$water_cs_waste_water="";$water_cs_i2="";$water_cs_d2="";$water_cs_qty="";$water_cs_an="";
		//PART III
		$is_indus_provided="";$adq_system="";$is_indus_compli="";
		$ew_details_name="";$ew_details_qty_req="";$ew_details_basel_no="";
		$any_other_info_a="";$any_other_info_b="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	//PART I
	$dt_of_comm=$results["dt_of_comm"];$no_of_workers=$results["no_of_workers"];$auth_val=$results["auth_val"];
	//PART II
	$treatment_storage=$results["treatment_storage"];
	//PART III
	$is_indus_provided=$results['is_indus_provided'];$adq_system=$results['adq_system'];$is_indus_compli=$results['is_indus_compli'];
			
	if(!empty($results["consent_val"])){
		$consent_val=json_decode($results["consent_val"]);
		$consent_val_water=$consent_val->water;$consent_val_air=$consent_val->air;
	}else{
		$consent_val_water="";$consent_val_air="";
	}	
	if(!empty($results["pro_manufac"])){
		$pro_manufac=json_decode($results["pro_manufac"]);
		$pro_manufac_year1=$pro_manufac->year1;$pro_manufac_prod1=$pro_manufac->prod1;$pro_manufac_qty1=$pro_manufac->qty1;$pro_manufac_year2=$pro_manufac->year2;$pro_manufac_prod2=$pro_manufac->prod2;$pro_manufac_qty2=$pro_manufac->qty2;
		$pro_manufac_year3=$pro_manufac->year3;$pro_manufac_prod3=$pro_manufac->prod3;$pro_manufac_qty3=$pro_manufac->qty3;
	}else{
		$pro_manufac_year1="";$pro_manufac_prod1="";$pro_manufac_qty1="";$pro_manufac_year2="";$pro_manufac_prod2="";$pro_manufac_qty2="";$pro_manufac_year3="";$pro_manufac_prod3="";$pro_manufac_qty3="";
	}	
	if(!empty($results["raw_mat_con"])){
		$raw_mat_con=json_decode($results["raw_mat_con"]);
		$raw_mat_con_year1=$raw_mat_con->year1;$raw_mat_con_prod1=$raw_mat_con->prod1;$raw_mat_con_qty1=$raw_mat_con->qty1;$raw_mat_con_year2=$raw_mat_con->year2;$raw_mat_con_prod2=$raw_mat_con->prod2;$raw_mat_con_qty2=$raw_mat_con->qty2;$raw_mat_con_year3=$raw_mat_con->year3;$raw_mat_con_prod3=$raw_mat_con->prod3;$raw_mat_con_qty3=$raw_mat_con->qty3;
	}else{
		$raw_mat_con_year1="";$raw_mat_con_prod1="";$raw_mat_con_qty1="";$raw_mat_con_year2="";$raw_mat_con_prod2="";$raw_mat_con_qty2="";$raw_mat_con_year3="";$raw_mat_con_prod3="";$raw_mat_con_qty3="";
	}		
	//Part II
	if(!empty($results["water_cs"])){
		$water_cs=json_decode($results["water_cs"]);
		$water_cs_i1=$water_cs->i1;$water_cs_d1=$water_cs->d1;$water_cs_cess=$water_cs->cess;$water_cs_waste_water=$water_cs->waste_water;$water_cs_i2=$water_cs->i2;$water_cs_d2=$water_cs->d2;$water_cs_qty=$water_cs->qty;$water_cs_an=$water_cs->an;
	}else{
		$water_cs_i1="";$water_cs_d1="";$total_qty_r_typ="";$water_cs_cess="";$water_cs_waste_water="";$water_cs_i2="";$water_cs_d2="";$water_cs_qty="";$water_cs_an="";
	}				
	//partIII
	if(!empty($results["ew_details"])){
		$ew_details=json_decode($results["ew_details"]);
		$ew_details_name=$ew_details->name;$ew_details_qty_req=$ew_details->qty_req;$ew_details_basel_no=$ew_details->basel_no;				
	}else{
		$ew_details_name="";$ew_details_qty_req="";$ew_details_basel_no="";
	}	
	if(!empty($results["any_other_info"])){
		$any_other_info=json_decode($results["any_other_info"]);
		$any_other_info_a=$any_other_info->a;$any_other_info_b=$any_other_info->b;
	}else{
		$any_other_info_a="";$any_other_info_b="";
	}	
}

##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		
	}
	
	##PHP TAB management ends

?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_Addmore-operation.php"); ?>
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								   <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								   <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								   <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>   
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
										<tr>
											<td colspan="4">1. Name and Address of the Unit </td>
										</tr>
										<tr>
											<td width="25%">Name :</td>
											<td><input type="text" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
											<td>Street Name 1:</td>
											<td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 2:</td>
											<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
											<td>Village/Town:</td>
											<td><input type="text" disabled value="<?php echo $b_vill; ?>"class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>District:</td>
											<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											<td>Pincode:</td>
											<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>Mobile No:</td>
											<td><input type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control text-uppercase"></td>
											<td>Phone No:</td>
											<td><input type="text" disabled value="<?php echo $b_landline_std.-$b_landline_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control "></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Name and Address of the Contact person with Designation</td>
											
										</tr>
										<tr>
											<td width="25%">Name :</td>
											<td><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
											<td>Designation</td>
											<td><input type="text" disabled value="<?php echo $status_applicant; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Street Name 1:</td>
											<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
											<td>Street Name 2:</td>
											<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Village/Town:</td>
											<td><input type="text" disabled value="<?php echo $vill; ?>"class="form-control text-uppercase"></td>
											<td>District:</td>
											<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Pincode:</td>
											<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
											<td>Mobile No:</td>
											<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>Phone No:</td>
											<td><input type="text" disabled value="<?php echo $landline_std.$landline_no; ?>" class="form-control text-uppercase"></td>
											<td>Email Id:</td>
											<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control "></td>
										</tr>
										<tr>
											<td>3. Date of Commissioning</td>
											<td><input type="text" class="dob form-control" name="dt_of_comm" value="<?php echo $dt_of_comm; ?>" /></td>
											<td>4. No. of workers (including<br/> contract labour)<span style="color:#ff0000">*</span></td>
										   <td><input type="text" class="form-control"name="no_of_workers" validate="onlyNumbers" required value="<?php echo $no_of_workers; ?>" /></td>
										</tr>
										<tr>
											<td colspan="4">5.Consents Validity</td>
										</tr>
										<tr>
										   <td width="25%">a. Water (Prevention & Control of Pollution) Act, 1974;Valid up to </td>
										   <td width="25%"><input type="text" class="dob form-control" name="consent_val[water]"  value="<?php  echo $consent_val_water; ?>"  /></td>
										   <td width="25%">b. Air (Prevention & Control of Pollution) Act, 1981;Valid up to </td>
										   <td width="25%"><input type="text" class="dob form-control" name="consent_val[air]"  value="<?php  echo $consent_val_air; ?>" /></td>
										</tr>
										<tr>
										   <td colspan="3">6. Authorization validity: E-wastes (Management and Handling) Rules, 2011; Valid up to</td>
											<td><input type="text" class="dob form-control" name="auth_val" value="<?php  echo $auth_val; ?>" /></td>
										</tr>
										<tr>
										   <td colspan="3">7. Manufacturing Process: Please attach manufacturing process flow diagram of each product(s)</td>
										   <td>(Upload Later in Upload Section)</td>
										</tr>                                     
										<tr>
										   <td colspan="4">8. Products and Installed capacity of production in (MTA)</td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive">
											<tbody>
												<tr>
												   <td align="center" width="5%">Sl No.</td>
												   <td align="center" width="50%">Products</td>
												   <td align="center">Installed capacity (MTA)</td>
												</tr>
												<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["product"]; ?>" validate="specialChar" name="txtB<?php echo $count;?>" size="10"></td>
														<td><input value="<?php echo $row_1["capacity"]; ?>" id="txtC<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input id="txtC1" size="10" validate="specialChar"  class="form-control text-uppercase" name="txtC1"></td>	
												</tr>
												<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
											</td>
										</tr>										
										<tr>
										   <td colspan="4">9. Products manufactured during the last three years (as applicable)</td>
										</tr>
										<tr>
											<td colspan="4">
												<table name="objectTable2" id="objectTable2" class="table table-responsive">
												<tbody>
													<tr>
														<td align="center">Sl No</td>
													   <td align="center">Year</td>
													   <td align="center">Product</td>
													   <td align="center">Quantity</td>
													</tr>
												   <?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num2= $part2->num_rows;
													if($num2>0){
														$count=1;
														while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input value="<?php echo $row_2["year"]; ?>" id="textB<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="textB<?php echo $count;?>" size="20"></td>	
															<td><input value="<?php echo $row_2["product"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textC<?php echo $count;?>"  ></td>
															<td><input value="<?php echo $row_2["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>			
														<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
														<td><input id="textD1" size="20" class="form-control text-uppercase" name="textD1"></td>
													</tr>
													<?php } ?>
												</tbody>
												</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
											</td>
										</tr>
										<tr>
											<td colspan="4">10. Raw material consumption during the last three years (as applicable)</td>
										</tr>
										<tr>
										<td colspan="4">
											<table name="objectTable3" id="objectTable3" class="table table-responsive">
												<tbody>
													<tr>
														<td align="center">Sl No</td>
													   <td align="center">Year</td>
													   <td align="center">Product</td>
													   <td align="center">Quantity</td>
													
													</tr>
												   <?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
													  
													<tr>
														<td><input readonly="readonly" id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_3["year"]; ?>" id="ttxtB<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="ttxtB<?php echo $count;?>" size="20"></td>	
														<td><input value="<?php echo $row_3["product"]; ?>" id="ttxtC<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="ttxtC<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_3["qty"]; ?>" id="ttxtD<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="ttxtD<?php echo $count;?>"  ></td>													
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
													<td><input id="ttxtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="ttxtB1"></td>					
													<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>
													<td><input id="ttxtD1" size="20" class="form-control text-uppercase" name="ttxtD1"></td>
												</tr>
												<?php } ?>
												</tbody>
												</table>
												</td>
											</tr>
										<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
												<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval2; ?>"/>																			
											</td>
										</tr>
										<tr>
											<td class="text-center" colspan="4">											
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
											</td>										
										</tr>
									</table>
									</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
										<tr>
											<td colspan="4">11. Water consumption</td>
										</tr>
										<tr>
											<td width="25%">Industrial </td>
											<td width="25%" class="form-inline"><input type="text" class="form-control" name="water_cs[i1]" validate="onlyNumbers" value="<?php  echo $water_cs_i1; ?>"> m<sup>3</sup>/day</td>
											<td width="25%">Domestic </td>
											<td width="25%" class="form-inline"><input type="text" class="form-control form-inline" name="water_cs[d1]" validate="onlyNumbers" value="<?php  echo $water_cs_d1; ?>" /> m<sup>3</sup>/day</td>									
										</tr>
										<tr>
											<td width="25%">Water Cess paid up to (if applicable)(Rs.)</td>
											<td width="25%" class="form-inline"><input type="text" class="form-control" validate="onlyNumbers" name="water_cs[cess]" value="<?php  echo $water_cs_cess; ?>" /></td>
											<td width="25%">Waste water generation as per consent</td>
											<td width="25%" class="form-inline"><input type="text" name="water_cs[waste_water]" class="form-control" validate="onlyNumbers" value="<?php echo $water_cs_waste_water; ?>"/>m<sup>3</sup>/day</td>
										</tr>
										<tr>
											<td width="25%" colspan="4">Actual (avg., of last 3 months)</td>
										</tr>
										<tr>
											<td width="25%">Industrial </td>
											<td class="form-inline"><input type="text" class="form-control" name="water_cs[i2]"  value="<?php echo $water_cs_i2; ?>"/> m<sup>3</sup>/day</td>
											<td width="25%">Domestic</td>
											<td width="25%" class="form-inline"><input type="text" class="form-control" name="water_cs[d2]" value="<?php  echo $water_cs_d2; ?>"/> m<sup>3</sup>/day</td>
										</tr>
										<tr>					
											<td colspan="4">Waste water treatment (provide flow diagram of the treatment scheme)</td>
										</tr>
										<tr>
											<td>Industrial</td>
											<td>(Upload Later in Upload Section)</td>
											<td>Domestic</td>
											<td>Upload Later in Uoload Section)</td>
										</tr>
										<tr>
											<td colspan="4">Waste water discharge</td>
										</tr>
										<tr>
											<td >Quantity </td>
											<td class="form-inline"><input type="text" class="form-control" name="water_cs[qty]" validate="onlyNumbers"  value="<?php  echo $water_cs_qty; ?>"/> m<sup>3</sup>/day</td>
											<td>Analysis of treated waste water for pH, BOD,COD, SS, O&G, any other parameter stipulated by SPCB/SPCC (attach details)(Upload Later in Checklist Section)</td>
											<td width="25%"class="form-inline"><input type="text" class="form-control" name="water_cs[an]"  value="<?php  echo $water_cs_an; ?>"/></td>
										</tr>
										<tr>
											<td colspan="4">12. Air Pollution Control</td>
										</tr>
										<tr>
											<td valign="top" width="25%" colspan="3">a. Provide flow diagram for emission control system(s) installed for each process unit, utilities etc.</td>
											<td>(Upload Later in Upload Section)</td>
										</tr>
										<tr>
											<td valign="top" colspan="3">b. Details for facilities provided for control of fugitive emission due to material handling, process, utilities etc.</td>
											<td>(Upload Later in Upload Section)</td>
										</tr>
										<tr>
											<td colspan="4">c. Fuel consumption </td>
										</tr>
										<tr>
											<td colspan="4"> 
											<table name="objectTable4" id="objectTable4" class="table table-responsive">
											<tbody>
												<tr>
													<td align="center">Sl No</td>
												   <td align="center">Fuel</td>
												   <td align="center">Quantity per day/month</td>
												</tr>
											   <?php
												$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
												$num4= $part4->num_rows;
												if($num4>0){
												  $count=1;
												  while($row_4=$part4->fetch_array()){	?>
												<tr>
													<td><input readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_4["fuel"]; ?>" id="txttB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_4["quantity"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="20"></td>				
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
												<td><input id="txttB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txttB1"></td>					
												<td><input  id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>
											</tr>
											<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
												<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
											</td>
										</tr>
									   <tr>
											<td colspan="4">d. Stack emission monitoring</td>
										</tr>
										<tr>
											<td colspan="4"> 
											<table name="objectTable5" id="objectTable5" class="table table-responsive">
											<tbody>
												<tr>
													<td align="center">Sl No</td>
												   <td align="center">Stack attached to</td>
												   <td align="center">Emission (SPM, SO<sub>2</sub> ,NOx , Pb etc.)mg/Nm<sup>3</sup></td>
												</tr>
											   <?php
												$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
												$num = $part5->num_rows;
												if($num>0){
												  $count=1;
												  while($row_5=$part5->fetch_array()){	?>
												<tr>
													<td><input id="textA<?php echo $count;?>" readonly  class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_5["stack"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_5["emission"]; ?>"  id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>				
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
												<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>					
												<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
											</tr>
											<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
												<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/>
											</td>
										</tr>
										<tr>
											<td colspan="4">e. Ambient air quality</td>
										</tr>
										<tr>
											<td colspan="4"> 
											<table name="objectTable6" id="objectTable6" class="table table-responsive">
											<tbody>
												<tr>
													<td align="center">Sl No</td>
												   <td align="center">Location Results ug/m<sup>3</sup></td>
												   <td align="center">Parameters (SPM, SO<sub>2</sub> ,NOx , Pb etc.)ug/m<sup>3</sup></td>
												</tr>
											   <?php
												$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
												$num6 = $part6->num_rows;
												if($num6>0){
												  $count=1;
												  while($row_6=$part6->fetch_array()){	?>
												<tr>
													<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_6["location"]; ?>" id="ttxtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="ttxtB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_6["parameter"]; ?>"  id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" name="ttxtC<?php echo $count;?>" size="20"></td>				
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
												<td><input id="ttxtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="ttxtB1"></td>					
												<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>
											</tr>
											<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction6()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore6()" value="">Add More</button>
												<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/>
											</td>
										</tr>
										<tr>
											<td colspan="4">13. Waste Management:</td>
										</tr>  	
										<tr>
										   <td colspan="4">a. Waste generation in processing e-waste</td>
										</tr>
										<tr>
											<td colspan="4"> 
											<table name="objectTable7" id="objectTable7" class="table table-responsive">
											<tbody>
												<tr>
													<td align="center">Sl No</td>
												   <td align="center">Type</td>
												   <td align="center">Category</td>
												   <td align="center">Quantity</td>
												
												</tr>
											   <?php
												$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
												$num7 = $part7->num_rows;
												if($num7>0){
												  $count=1;
												  while($row_7=$part7->fetch_array()){	?>
												<tr>
													<td><input readonly  id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													<td><input value="<?php echo $row_7["type"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
													<td><input value="<?php echo $row_7["category"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>	
													<td><input value="<?php echo $row_7["qty"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
												</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
												<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
												<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>
												<td><input id="txtD1" size="20" class="form-control text-uppercase" name="txtD1"></td>
											</tr>
											<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction7()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore7()" value="">Add More</button>
												<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/>
											</td>
										</tr>
										<tr>
										   <td colspan="3">b. Waste Collection and transportation(attach details)</td>
										   <td>(Upload Later in Upload Section)</td>
										</tr>
										<tr>
											<td colspan="4">c. Provide details of disposal of residue</td>
										</tr>
									   <tr>
										<td colspan="4"> 
										<table name="objectTable8" id="objectTable8" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
											   <td align="center">Type</td>
											   <td align="center">Category</td>
											   <td align="center">Quantity</td>
											
											</tr>
										   <?php
											$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
											$num8 = $part8->num_rows;
											if($num8>0){
											  $count=1;
											  while($row_8=$part8->fetch_array()){	?>
											<tr>
												<td><input readonly  id="ttextA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["slno"]; ?>" name="ttextA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_8["type"]; ?>" id="ttextB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="ttextB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_8["category"]; ?>" id="ttextC<?php echo $count;?>" class="form-control text-uppercase" name="ttextC<?php echo $count;?>" size="20"></td>	
												<td><input value="<?php echo $row_8["qty"]; ?>" id="ttextD<?php echo $count;?>" class="form-control text-uppercase" name="ttextD<?php echo $count;?>" size="20"></td>
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly id="ttextA1" size="1" class="form-control text-uppercase" name="ttextA1"></td>
												<td><input id="ttextB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="ttextB1"></td>					
												<td><input  id="ttextC1" size="20" class="form-control text-uppercase"  name="ttextC1"></td>
												<td><input id="ttextD1" size="20" class="form-control text-uppercase" name="ttextD1"></td>
											</tr>
											<?php } ?>
											</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="4">
												
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction8()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore8()" value="">Add More</button>
												<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/>
											</td>
										</tr>
										<tr>
											<td colspan="3"]>d. Name of Treatment Storage and Disposal Facility utilized for</td>
											<td ><input type="text" class="form-control text-uppercase"name="treatment_storage" id="textfield88" value="<?php echo $treatment_storage; ?>"/></td>
										</tr>
										<tr>
										<td valign="top" colspan="3">e. Please attach analysis report of characterization of hazardous waste generated (including leachate test if applicable)</td>
										<td>(Upload Later in Upload Section)</td>
									</tr>
										<tr>
											<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
											</td>
										</tr>		
									</table>
									</form>
									</div>
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered">
								   <tr>
									 <td colspan="4">14. Details of e-waste proposed to be procured through sale, contract or import, as the case may be, for use as raw material</td>
									</tr>
									<tr>
										<td colspan="4"> 
										<table name="objectTable9" id="objectTable9" class="table table-responsive">
										<tbody>
											<tr>
												<td align="center">Sl No</td>
												<td align="center">Name</td>
												<td align="center">Quantity required/year</td>
												<td align="center">Basel Convention Number</td>
											
											</tr>
										   <?php
											$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'");
											$num9 = $part9->num_rows;
											if($num9>0){
											  $count=1;
											  while($row_9=$part9->fetch_array()){	?>
											<tr>
												<td><input id="txtA<?php echo $count;?>" readonly class="form-control text-uppercase" value="<?php echo $row_9["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_9["name"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_9["qty"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>	
												<td><input value="<?php echo $row_9["baselno"]; ?>"   id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
											<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
											<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>
											<td><input id="txtD1" size="20" class="form-control text-uppercase" name="txtD1"></td>
										</tr>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">
											
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction9()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore9()" value="">Add More</button>
											<input type="hidden" id="hiddenval9" name="hiddenval9" value="<?php echo $hiddenval9; ?>"/>
										</td>
									</tr>
									<tr>	
										<td width="25%" colspan="2">15. Occupational safety and health aspects</td>
										<td width="25%" colspan="2">Please provide details of facilities(Upload Later in Upload Section)</td>
									</tr> 
									<tr>
										<td colspan="4">16. Remarks</td>
									</tr>   	
									<tr>
										<td width="25%" colspan="3">Whether industry has provided adequate pollution control system / equipment to meet the standards of emission / effluent.<span class="mandatory_field">*</span></td>
										<td width="25%"><label class="radio-inline"><input type="radio" required name="is_indus_provided" value="Y"  <?php if(isset($is_indus_provided) && $is_indus_provided=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_indus_provided"  value="N"  <?php if(isset($is_indus_provided) && $is_indus_provided=='N') echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td width="25%">If Yes, please furnish details<br/></td>
										<td><textarea name="adq_system" id="adq_system" class="form-control text-uppercase" validate="textarea" ><?php if(isset($adq_system)) echo $adq_system; ?></textarea></td>
										<td></td>
										<td></td>
									</tr> 
									<tr>
										<td colspan="3">Whether industry is in compliance with conditions laid down in the Authorization :<span class="mandatory_field">*</span></td>
										<td valign="top"><input type="radio" required name="is_indus_compli" value="Y" <?php if(isset($is_indus_compli) && $is_indus_compli=='Y') echo 'checked'; ?> />&nbsp;Yes&nbsp;&nbsp;&nbsp;<input type="radio" name="is_indus_compli" value="N" <?php if(isset($is_indus_compli) && $is_indus_compli=='N') echo 'checked'; ?> />&nbsp;No</td>
									</tr> 	
									<tr>
										<td colspan="4">17. Any Other Information of relevance:</td>
									</tr>
									<tr>
										<td class="form-inline">i) <input type="text" name="any_other_info[a]" class="form-control text-uppercase" jstag="validateNotSpecialChar" id="textfield93"  value="<?php  echo $any_other_info_a; ?>"/> </td>
										<td class="form-inline">ii) <input type="text" name="any_other_info[b]" class="form-control text-uppercase" jstag="validateNotSpecialChar" id="textfield94" value="<?php  echo $any_other_info_b; ?>"/> </td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									   <td>Date :<label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
										Place: <label><?php echo strtoupper($dist); ?></label></td>
									   <td></td>
									   <td></td>
									   <td align="right">
										Signature: <label><?php  echo strtoupper($key_person) ?></label><br/>
										Name:<label><?php  echo strtoupper($key_person) ?></label><br/>
									   Designation:<label><?php echo strtoupper($status_applicant) ?></label></td>
								   </tr>
									<tr>							
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=2"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>							
									</tr>	
									</table>
									</form>
									</div>
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
	<?php if($is_indus_provided=="N"){ ?>
		$('#adq_system').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="is_indus_provided"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#adq_system').removeAttr('disabled', 'disabled');			
		}else{
			$('#adq_system').attr('disabled', 'disabled');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>