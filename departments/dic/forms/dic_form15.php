<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="15";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form.php";

	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		// Tab 1 //
		$branch_address=$results['branch_address'];$enterprise_pan=$results['enterprise_pan'];$em_no=$results['em_no'];$em_dt=$results['em_dt'];$items=$results['items'];$service=$results['service'];$capacity=$results['capacity'];$vat_no=$results['vat_no'];$vat_dt=$results['vat_dt'];$excise_no=$results['excise_no'];$excise_dt=$results['excise_dt'];$service_no=$results['service_no'];$service_dt=$results['service_dt'];$entry_no=$results['entry_no'];$entry_dt=$results['entry_dt'];
		
		if(!empty($results["office"])){
			$office=json_decode($results["office"]);
			$office_sn1=$office->sn1;$office_sn2=$office->sn2;$office_vill=$office->vill;$office_dist=$office->dist;$office_po=$office->po;$office_mobile=$office->mobile;$office_phone=$office->phone;$office_email=$office->email;
		}else{
			$office_sn1="";$office_sn2="";$office_vill="";$office_dist="";$office_po="";$office_mobile="";$office_phone="";$office_email="";
		}	
		if(!empty($results["capital"])){
			$capital=json_decode($results["capital"]);
			$capital_land=$capital->land;$capital_building=$capital->building;$capital_plant=$capital->plant;$capital_equip=$capital->equip;
		}else{
			$capital_land="";$capital_building="";$capital_plant="";$capital_equip="";
		}	
		
		// Tab 2 //
		$no_of_workers=$results['no_of_workers'];$local_percent=$results['local_percent'];$reg_no=$results['reg_no'];$reg_dt=$results['reg_dt'];$applicant_name=$results['applicant_name'];
		 
		if(!empty($results["fees"])){
			$fees=json_decode($results["fees"]);
			$fees_no=$fees->no;$fees_dt=$fees->dt;$fees_amnt=$fees->amnt;
		}else{
			$fees_no="";$fees_dt="";$fees_amnt="";
		}
	}else{
		$form_id="";
		// Tab 1 //
		$branch_address="";$enterprise_pan="";$em_no="";$em_dt="";$items="";$service="";$capacity="";$vat_no="";$vat_dt="";$excise_no="";$excise_dt="";$service_no="";$service_dt="";$entry_no="";$entry_dt="";
		$office_sn1="";$office_sn2="";$office_vill="";$office_dist="";$office_po="";$office_mobile="";$office_phone="";$office_email="";
		$capital_land="";$capital_building="";$capital_plant="";$capital_equip="";
		// Tab 2 //
		$no_of_workers="";$local_percent="";$reg_no="";$reg_dt="";$applicant_name="";
		$fees_no="";$fees_dt="";$fees_amnt="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	// Tab 1 //
	$branch_address=$results['branch_address'];$enterprise_pan=$results['enterprise_pan'];$em_no=$results['em_no'];$em_dt=$results['em_dt'];$items=$results['items'];$service=$results['service'];$capacity=$results['capacity'];$vat_no=$results['vat_no'];$vat_dt=$results['vat_dt'];$excise_no=$results['excise_no'];$excise_dt=$results['excise_dt'];$service_no=$results['service_no'];$service_dt=$results['service_dt'];$entry_no=$results['entry_no'];$entry_dt=$results['entry_dt'];
	
	if(!empty($results["office"])){
		$office=json_decode($results["office"]);
		$office_sn1=$office->sn1;$office_sn2=$office->sn2;$office_vill=$office->vill;$office_dist=$office->dist;$office_po=$office->po;$office_mobile=$office->mobile;$office_phone=$office->phone;$office_email=$office->email;
	}else{
		$office_sn1="";$office_sn2="";$office_vill="";$office_dist="";$office_po="";$office_mobile="";$office_phone="";$office_email="";
	}	
	if(!empty($results["capital"])){
		$capital=json_decode($results["capital"]);
		$capital_land=$capital->land;$capital_building=$capital->building;$capital_plant=$capital->plant;$capital_equip=$capital->equip;
	}else{
		$capital_land="";$capital_building="";$capital_plant="";$capital_equip="";
	}		
	// Tab 2 //
	$no_of_workers=$results['no_of_workers'];$local_percent=$results['local_percent'];$reg_no=$results['reg_no'];$reg_dt=$results['reg_dt'];$applicant_name=$results['applicant_name'];
	 
	if(!empty($results["fees"])){
		$fees=json_decode($results["fees"]);
		$fees_no=$fees->no;$fees_dt=$fees->dt;$fees_amnt=$fees->amnt;
	}else{
		$fees_no="";$fees_dt="";$fees_amnt="";
	}	
}
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform14" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td width="25%">1. Name of the Micro/Small Enterprise : </td>
												<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $unit_name; ?>" disabled="disabled"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">2. Location of the Enterprise : </td>
											</tr>
											<tr>
												<td colspan="4">(a) Factory location : </td>
											</tr>
											<tr>
												<td width="25%">Street Name1 : </td>
												<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_street_name1	; ?>" disabled></td>
												<td width="25%">Street Name2 :</td>
												<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_street_name2	; ?>" disabled></td>
											</tr>
											<tr>
												<td>Vill/Town :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_vill; ?>" disabled></td>
												<td>District :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_dist; ?>" disabled></td>
											</tr>
											<tr>
												<td>P.O :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_block; ?>" disabled></td>
												<td>Mobile No. :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_mobile_no; ?>" disabled></td>
											</tr>
											<tr>
												<td>Phone No. :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
												<td>Email :</td>
												<td><input class="form-control text-uppercase" type="text" value="<?php echo $b_email; ?>" disabled></td>
											</tr>
											<tr>
												<td colspan="4">(b) Office Address : </td>
											</tr>
											<tr>
												<td>Street Name1 :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[sn1]" value="<?php echo $office_sn1; ?>"></td>
												<td>Street Name2 :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[sn2]" value="<?php echo $office_sn2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[vill]" value="<?php echo $office_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[dist]" value="<?php echo $office_dist; ?>"></td>
											</tr>
											<tr>
												<td>P.O. :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[po]" value="<?php echo $office_po; ?>" ></td>
												<td>Mobile No :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[mobile]" value="<?php echo $office_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
											</tr>
											<tr>
												<td>Phone Number :</td>
												<td><input type="text" class="form-control text-uppercase" name="office[phone]" value="<?php echo $office_phone; ?>"></td>
												<td>Email :</td>
												<td><input type="email" class="form-control text-uppercase" name="office[email]" value="<?php echo $office_email; ?>"></td>
											</tr>
											<tr>
												<td>(c) Address of Registered Office : </td>
												<td><textarea class="form-control text-uppercase" disabled="disabled" ><?php echo $unit_details; ?></textarea></td>
												<td>(d) Address of the Branch Office, if any : </td>
												<td><textarea class="form-control text-uppercase" name="branch_address" ><?php echo $branch_address; ?></textarea></td>
											</tr>
											<tr>
												<td>3. Constitution of the unit : </td>
												<td colspan="2"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $Type_of_ownership; ?>" readonly></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">4. Name(s), address(es) of the Proprietor/ Partner(s)/ Director(s)/ Managing Director with their PAN No : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table class="table table-responsive">
													<thead>
														<tr>
															<th>Sl. No.</th>
															<th>Partners/Directors Name</th>
															<th>Street Name</th>
															<th>Village/Town</th>
															<th>District</th>
															<th>Pincode</th>
															<th>Mobile Number</th>
															<th>PAN Number</th>
														</tr>
													</thead>
													<?php 
													$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") ;
													if($member_results->num_rows==0){
														for($i=1;$i<=count($owners);$i++){ ?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
															<td><input type="text" name="sn<?php echo $i;?>" class="form-control text-uppercase"  value="" /></td>
															<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
															<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
															<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
															<td><input type="text" name="mobile<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="10" validate="mobileNumber"></td>													
															<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="10"></td>
														</tr>
													<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
												<?php }else{
													$i=1;
													while($rows=$member_results->fetch_object()){ ?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
														<td><input type="text"  name="sn<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn;?>" /></td>
														<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill;?>" /></td>
														<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist;?>" /></td>
														<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin;?>" maxlength="6" validate="pincode" ></td>
														<td><input type="text" name="mobile<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->mobile;?>" maxlength="10" validate="mobileNumber"></td>
														<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pan;?>" maxlength="10"></td>
													</tr>
													<?php $i++;
													} ?>
													<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
												<?php } ?>			
												</table>
												</td>
											</tr>
											<tr>
												<td>5. PAN Number of the Enterprise : </td>
												<td><input type="text" class="form-control text-uppercase" name="enterprise_pan" value="<?php echo $enterprise_pan; ?>" maxlength="10"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>6. EM Part-II Number and date : </td>
												<td><input type="text" class="form-control text-uppercase" name="em_no" value="<?php echo $em_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="em_dt" value="<?php echo $em_dt; ?>" placeholder="Date" ></td>
												<td></td>
											</tr>
											<tr>
												<td>7. Items Manufactured : </td>
												<td><input type="text" class="form-control text-uppercase" name="items" value="<?php echo $items; ?>"></td>
												<td>8. Service Provided :</td>
												<td><input type="text" class="form-control text-uppercase" name="service" value="<?php echo $service; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">9. Capital Investment : </td>
											</tr>
											<tr>
												<td>(a) Land : </td>
												<td><input type="text" name="capital[land]" class="form-control text-uppercase"  value="<?php echo $capital_land; ?>"></td>
												<td>(b) Building : </td>
												<td><input type="text" name="capital[building]" class="form-control text-uppercase"  value="<?php echo $capital_building; ?>"></td>
											</tr>
											<tr>
												<td>(c) Plant & Machinery : </td>
												<td><input type="text" name="capital[plant]" class="form-control text-uppercase"  value="<?php echo $capital_plant; ?>"></td>
												<td>(d) Accessories & Equipments : </td>
												<td><input type="text" name="capital[equip]" class="form-control text-uppercase"  value="<?php echo $capital_equip; ?>"></td>
											</tr>
											<tr>
												<td>10. Accessed Annual Production Capacity : </td>
												<td><input type="text" class="form-control text-uppercase" name="capacity" value="<?php echo $capacity; ?>"></td>
												<td colspan="2">
											</tr>
											<tr>
												<td>11. VAT Registration Number and Date : </td>
												<td><input type="text" class="form-control text-uppercase" name="vat_no" value="<?php echo $vat_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="vat_dt" value="<?php echo $vat_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>
											<tr>
												<td>12. Excise Registration Number and Date : </td>
												<td><input type="text" class="form-control text-uppercase" name="excise_no" value="<?php echo $excise_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="excise_dt" value="<?php echo $excise_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>
											<tr>
												<td>13. Service Tax Registration Number and Date : </td>
												<td><input type="text" class="form-control text-uppercase" name="service_no" value="<?php echo $service_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="service_dt" value="<?php echo $service_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>
											<tr>
												<td>14. Entry Tax Registration Number and Date : </td>
												<td><input type="text" class="form-control text-uppercase" name="entry_no" value="<?php echo $entry_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="entry_dt" value="<?php echo $entry_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form; ?>a"  class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">15. Employment : </td>
											</tr>
											<tr>
												<td width="25%">(a) No. of workers (Managerial + Skill + Workers) : </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="no_of_workers" value="<?php echo $no_of_workers; ?>"></td>
												<td width="25%">(b) Percentage of Local Employees : </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="local_percent" value="<?php echo $local_percent; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">16. Products Manufactured/ Services Rendered : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
													<tr> 
														<th width="5%">Sl No.</th>
														<th width="30%">Name of the Products Manufactured/ Services Rendered during the accounting year</th>
														<th width="20%">Accessed Annual Capacity</th>
														<th width="20%">Production during the last accounting year</th>
														<th width="25%">Remarks</th>
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
															<td><input value="<?php echo $row_1["capacity"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["prod"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
														<tr>
															<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
															<td><input id="txtB1" class="form-control text-uppercase" name="txtB1"></td>					
															<td><input id="txtC1" class="form-control text-uppercase" name="txtC1"></td>					
															<td><input id="txtD1" class="form-control text-uppercase" name="txtD1"></td>					
															<td><input id="txtE1" class="form-control text-uppercase" name="txtE1"></td>	
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>											
											<tr>
												<td colspan="4">17. Products/ Services supplied/ rendered to various Government/ Public Sector Enterprises/ Corporations/ Aided Institute : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable2" class="table table-responsive table-bordered "id="objectTable2" >
													<thead>
													<tr>  
														<th>Sl No.</th>
														<th>Name of the Products/Service</th>
														<th>Purchasing Department</th>
														<th>Order no.</th>
														<th>Order Date</th>
														<th>Quantity Supplied</th>
														<th>Rate</th>
														<th>Value</th>
														<th>Payment Received or Not</th>
													</tr>
													</thead>
													<?php
													$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
														$count=1;
														while($row_2=$part2->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input value="<?php echo $row_2["name"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" name="textB<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["purchase"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["no"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["date"]; ?>" id="textE<?php echo $count;?>" class="dob form-control" name="textE<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["qty"]; ?>" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["rate"]; ?>" id="textG<?php echo $count;?>" class="form-control text-uppercase" name="textG<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["value"]; ?>" id="textH<?php echo $count;?>" class="form-control text-uppercase" name="textH<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["payment"]; ?>" id="textI<?php echo $count;?>" class="form-control text-uppercase" name="textI<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
															<td><input id="textB1" class="form-control text-uppercase" name="textB1"></td>
															<td><input id="textC1" class="form-control text-uppercase" name="textC1"></td>	
															<td><input id="textD1" class="form-control text-uppercase" name="textD1"></td>	
															<td><input id="textE1" class="dob form-control" name="textE1"></td>	
															<td><input id="textF1" class="form-control text-uppercase" name="textF1"></td>	
															<td><input id="textG1" class="form-control text-uppercase" name="textG1"></td>	
															<td><input id="textH1" class="form-control text-uppercase" name="textH1"></td>	
															<td><input id="textI1" class="form-control text-uppercase" name="textI1"></td>	
														</tr>
													<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">18. Application Fees to be deposited by Treasury Challan : </td>
											</tr>
											<tr>
												<td>Challan No. and Date : </td>
												<td><input type="text" class="form-control text-uppercase" name="fees[no]" value="<?php echo $fees_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="fees[dt]" value="<?php echo $fees_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>		
											<tr>
												<td>Amount Deposited : </td>
												<td><input type="text" class="form-control text-uppercase" name="fees[amnt]" value="<?php echo $fees_amnt; ?>"></td>
												<td colspan="2"></td>
											</tr>											
											<tr>
												<td>19. Registration No. and Date under APSP Act 1989, if any : </td>
												<td><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>" placeholder="Number"></td>
												<td><input type="date" class="dob form-control" name="reg_dt" value="<?php echo $reg_dt; ?>" placeholder="Date"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4"><strong>Declaration of the Applicant : </strong></td>
											</tr>
											<tr class="form-inline">
												<td colspan="4">I, &nbsp;<input type="text"  class="form-control text-uppercase" name="applicant_name" value="<?php echo $applicant_name;?>" >&nbsp; do hereby solemnly declare that the above information/particulars are true to the best of my knowledge and belief. If the above particulars are found to be not true/fabricated, I shall be liable for appropriate action as the Department deem fit and proper. </td>
											</tr>
											<tr>
												<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
												<td colspan="2" align="right">Signature of the Applicant : <strong><?php echo strtoupper($key_person)?></strong></td>
											</tr>	
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>b" class="btn btn-success text-bold submit1">Save and Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>