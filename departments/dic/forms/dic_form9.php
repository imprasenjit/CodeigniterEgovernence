<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="9";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form.php";

	
	

	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			###### PART I #####
			$post_office=$results['post_office'];$reg_no=$results['reg_no'];$reg_date=$results['reg_date'];$investment=$results['investment'];$total_invest=$results['total_invest'];$plant_machinery=$results['plant_machinery'];
			if(!empty($results["office_address"])){
				$office_address=json_decode($results["office_address"]);
				$office_address_web=$office_address->web;$office_address_po=$office_address->po;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
			}else{
				$office_address_web="";$office_address_po="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
			}
			###### PART II #####
			$s1=$results['s1'];$reg_details=$results['reg_details'];$date_of_production=$results['date_of_production'];$other_incentives=$results['other_incentives'];$total_amount=$results['total_amount'];$total_year=$results['total_year'];$transport_regno=$results['transport_regno'];$period_of_val_f=$results['period_of_val_f'];$period_of_val_t=$results['period_of_val_t'];
			if(!empty($results["pmt_reg"])){
				$pmt_reg=json_decode($results["pmt_reg"]);
				$pmt_reg_no=$pmt_reg->no;$pmt_reg_dt=$pmt_reg->dt;
			}else{
				$pmt_reg_no="";$pmt_reg_dt="";
			}
			if(!empty($results["under_neipp"])){
				$under_neipp=json_decode($results["under_neipp"]);
				$under_neipp_amount1=$under_neipp->amount1;$under_neipp_year1=$under_neipp->year1;$under_neipp_amount2=$under_neipp->amount2;$under_neipp_year2=$under_neipp->year2;$under_neipp_amount3=$under_neipp->amount3;$under_neipp_year3=$under_neipp->year3;$under_neipp_amount4=$under_neipp->amount4;$under_neipp_year4=$under_neipp->year4;
			}else{
				$under_neipp_amount1="";$under_neipp_year1="";$under_neipp_amount2="";$under_neipp_year2="";$under_neipp_amount3="";$under_neipp_year3="";$under_neipp_amount4="";$under_neipp_year4="";
			}
			###### PART III ##### 
			$no_of_employee=$results['no_of_employee'];$emp_under_contractor=$results['emp_under_contractor'];$tan_n_unit=$results['tan_n_unit'];$central_excise=$results['central_excise'];$vat_reg=$results['vat_reg'];$dist_f_focal=$results['dist_f_focal'];$dist_f_rstation=$results['dist_f_rstation'];$product_ext_from=$results['product_ext_from'];
			if(!empty($results["power"])){
				$power=json_decode($results["power"]);
				$power_tot_req=$power->tot_req;$power_sanction_load=$power->sanction_load;$power_conn_load=$power->conn_load;
			}else{
				$power_tot_req="";$power_sanction_load="";$power_conn_load="";
			}
			if(!empty($results["claim"])){
				$claim=json_decode($results["claim"]);
				$claim_period_from=$claim->period_from;$claim_period_to=$claim->period_to;
			}else{
				$claim_period_from="";$claim_period_to="";
			}
			###### PART III ##### 
			$unit_consumed=$results['unit_consumed'];$dg_set_rating=$results['dg_set_rating'];$diesel_consumed=$results['diesel_consumed'];$dg_unit_consumed=$results['dg_unit_consumed'];$total_elec_unit=$results['total_elec_unit'];
			if(!empty($results["bank_details"])){
				$bank_details=json_decode($results["bank_details"]);
				$bank_details_name=$bank_details->name;$bank_details_no=$bank_details->no;$bank_details_branch=$bank_details->branch;$bank_details_ifsc=$bank_details->ifsc;$bank_details_micr=$bank_details->micr;
			}else{
				$bank_details_name="";$bank_details_no="";$bank_details_branch="";$bank_details_ifsc="";$bank_details_micr="";
			}
		}else{ 
			$form_id="";
			###### PART I #####
			$post_office="";$reg_no="";$reg_date="";$partner_address="";$partner_pan_no="";$investment="";$total_invest="";$plant_machinery="";
			$office_address_web="";$office_address_po="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
			###### PART II #####
			$s1="";$reg_details="";$date_of_production="";$other_incentives="";$total_amount="";$total_year="";$transport_regno="";$period_of_val_f="";$period_of_val_t="";
			$pmt_reg_no="";$pmt_reg_dt="";
			$under_neipp_amount1="";$under_neipp_year1="";$under_neipp_amount2="";$under_neipp_year2="";$under_neipp_amount3="";$under_neipp_year3="";$under_neipp_amount4="";$under_neipp_year4="";
			###### PART III #####
			$no_of_employee="";$emp_under_contractor="";$tan_n_unit="";$central_excise="";$vat_reg="";$dist_f_focal="";$dist_f_rstation="";$product_ext_from="";
			$power_tot_req="";$power_sanction_load="";$power_conn_load="";
			$claim_period_from="";$claim_period_to="";
			###### PART IV #####
			$unit_consumed="";$dg_set_rating="";$diesel_consumed="";$dg_unit_consumed="";$total_elec_unit="";
			$bank_details_name="";$bank_details_no="";$bank_details_branch="";$bank_details_ifsc="";$bank_details_micr="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		###### PART I #####
		$post_office=$results['post_office'];$reg_no=$results['reg_no'];$reg_date=$results['reg_date'];$investment=$results['investment'];$total_invest=$results['total_invest'];$plant_machinery=$results['plant_machinery'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_web=$office_address->web;$office_address_po=$office_address->po;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_web="";$office_address_po="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		###### PART II #####
		$s1=$results['s1'];$reg_details=$results['reg_details'];$date_of_production=$results['date_of_production'];$other_incentives=$results['other_incentives'];$total_amount=$results['total_amount'];$total_year=$results['total_year'];$transport_regno=$results['transport_regno'];$period_of_val_f=$results['period_of_val_f'];$period_of_val_t=$results['period_of_val_t'];
		if(!empty($results["pmt_reg"])){
			$pmt_reg=json_decode($results["pmt_reg"]);
			$pmt_reg_no=$pmt_reg->no;$pmt_reg_dt=$pmt_reg->dt;
		}else{
			$pmt_reg_no="";$pmt_reg_dt="";
		}
		if(!empty($results["under_neipp"])){
			$under_neipp=json_decode($results["under_neipp"]);
			$under_neipp_amount1=$under_neipp->amount1;$under_neipp_year1=$under_neipp->year1;$under_neipp_amount2=$under_neipp->amount2;$under_neipp_year2=$under_neipp->year2;$under_neipp_amount3=$under_neipp->amount3;$under_neipp_year3=$under_neipp->year3;$under_neipp_amount4=$under_neipp->amount4;$under_neipp_year4=$under_neipp->year4;
		}else{
			$under_neipp_amount1="";$under_neipp_year1="";$under_neipp_amount2="";$under_neipp_year2="";$under_neipp_amount3="";$under_neipp_year3="";$under_neipp_amount4="";$under_neipp_year4="";
		}
		###### PART III ##### 
		$no_of_employee=$results['no_of_employee'];$emp_under_contractor=$results['emp_under_contractor'];$tan_n_unit=$results['tan_n_unit'];$central_excise=$results['central_excise'];$vat_reg=$results['vat_reg'];$dist_f_focal=$results['dist_f_focal'];$dist_f_rstation=$results['dist_f_rstation'];$product_ext_from=$results['product_ext_from'];
		if(!empty($results["power"])){
			$power=json_decode($results["power"]);
			$power_tot_req=$power->tot_req;$power_sanction_load=$power->sanction_load;$power_conn_load=$power->conn_load;
		}else{
			$power_tot_req="";$power_sanction_load="";$power_conn_load="";
		}
		if(!empty($results["claim"])){
			$claim=json_decode($results["claim"]);
			$claim_period_from=$claim->period_from;$claim_period_to=$claim->period_to;
		}else{
			$claim_period_from="";$claim_period_to="";
		}
		###### PART III ##### 
		$unit_consumed=$results['unit_consumed'];$dg_set_rating=$results['dg_set_rating'];$diesel_consumed=$results['diesel_consumed'];$dg_unit_consumed=$results['dg_unit_consumed'];$total_elec_unit=$results['total_elec_unit'];
		if(!empty($results["bank_details"])){
			$bank_details=json_decode($results["bank_details"]);
			$bank_details_name=$bank_details->name;$bank_details_no=$bank_details->no;$bank_details_branch=$bank_details->branch;$bank_details_ifsc=$bank_details->ifsc;$bank_details_micr=$bank_details->micr;
		}else{
			$bank_details_name="";$bank_details_no="";$bank_details_branch="";$bank_details_ifsc="";$bank_details_micr="";
		}
		
	}
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
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
								<h4 class="text-center"><strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table3">PART IV</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td width="">1. (a)Name of the Industrial unit </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">(b) Factory Address  </td>					
									</tr>
									<tr>
										<td width="25%">Vill/Town/Ward</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td width="25%">Post Office<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="post_office" required value="<?php echo $post_office;?>"></td>
									</tr>
									<tr>
										<td>Pin Code</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Phone No</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_landline_std.'-'.$b_landline_no;?>"></td>
									</tr>
									<tr>
										<td>State</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="ASSAM"  ></td>
										<td>District</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Office Address</td>					
									</tr>
									<tr>
										<td width="25%">Vill/Town/Ward</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[vt]" value="<?php echo $office_address_vt;?>" ></td>
										<td width="25%">Post Office </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[po]" value="<?php echo $office_address_po;?>" ></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[pin]" value="<?php echo $office_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[mob]" value="<?php echo $office_address_mob;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td> E-Mail ID</td>
										<td><input type="email" class="form-control" name="office_address[email]" value="<?php echo $office_address_email;?>"></td>
										<td> Website / URL</td>
										<td><input type="text" class="form-control" name="office_address[web]" value="<?php echo $office_address_web;?>"></td>
									</tr>
									<tr>
										<td> State</td>
										<td><input type="text" class="form-control text-uppercase" readonly="readonly" value="ASSAM"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control" name="office_address[dist]" value="<?php echo $office_address_dist;?>"></td>
										
									</tr>
									<tr>
										<td>3. Constitution of the unit  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">4. Company registration No and Date / Partnership Deed </td>
									</tr>
									<tr>
										<td> Company registration No </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no;?>"></td>
										<td>Date</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="reg_date" value="<?php if($reg_date!="0000-00-00" && $reg_date!="") echo date("d-m-Y",strtotime($reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">5. Name(s) , Address(es) of the Proprietor/ Partners / Directors/ Secretary and President of the Cooperative dic with PAN* </td>
									</tr>
									<tr>
										<td colspan="4">
										<table id="" class="text-center table table-responsive table-bordered">
										<thead>
										<tr>
											<th>Sl No.</th>
											<th>Name </th>
											<th>Address<span class="mandatory_field">*</span></th>
											<th>PAN No<span class="mandatory_field">*</span></th>
										</tr>
										</thead>
										<tbody>										
										<?php 
										$partners_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_partners where form_id='$form_id'") ;
										if($partners_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="partner_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><textarea name="partner_address<?php echo $i;?>" class="form-control text-uppercase" required="required" maxlength="255" ></textarea></td>
												<td><input type="text" name="partner_pan_no<?php echo $i;?>" id="partner_pan_no<?php echo $i?>" onchange="validatePanNo(this)" class="form-control text-uppercase" value="" required="required" /></td>
												
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$partners_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="partner_name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->partner_name; ?>" /></td>
												<td><textarea name="partner_address<?php echo $i;?>" class="form-control text-uppercase" required="required" maxlength="255"><?php echo $rows->partner_address; ?> </textarea></td>
												<td><input type="text" name="partner_pan_no<?php echo $i;?>" id="<?php echo $i?>" onchange="validatePanNo(this)" class="form-control text-uppercase" value="<?php echo $rows->partner_pan_no; ?>" required="required" /></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $partners_results->num_rows; ?>"/>
										<?php } ?>
										</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td width="25%">6. PAN of the industrial unit</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pan_no;?>"></td>
										<td width="25%">7. Investment (in Lakh) </td>
										<td width="25%" class="form-inline"><input type="text" class="form-control text-uppercase" name="investment" value="<?php echo $investment;?>" validate="onlyNumbers">(in Rupees)</td>
									</tr>
									<tr>
										<td>8. Total Investment in the unit (In Lakh)</td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase" name="total_invest" value="<?php echo $total_invest;?>" validate="onlyNumbers">(in Rupees)</td>
										<td>9. Investment in the Plant & Machinery (In Lakh) </td>
										<td class="form-inline"><input type="text" class="form-control text-uppercase" name="plant_machinery" value="<?php echo $plant_machinery;?>" validate="onlyNumbers">(in Rupees)</td>
									</tr>
									<tr>
										<td colspan="4">10. Loan</td>									
									</tr>	
									<tr>
										<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
											<thead>
												<tr>												
													<th width="10%"> Sl No</th>	
													<th width="25%"> Name of the Bank/Financial Institutions </th>	
													<th width="20%"> Amount of Term Loan Provided (in Rs.)</th>
													<th width="25%"> Requirement of Working capital (Rs. in lakh)</th>
													<th width="20%"> Working capital limit (Rs. in lakh)</th>
												</tr>
											</thead>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
											<tr>
												<td><input  type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="25"></td>
												<td><input  type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["bank_name"]; ?>" name="txtB<?php echo $count;?>" size="25"></td>
												<td><input type="text" validate="onlyNumbers" value="<?php echo $row_1["amount_of_term"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txtC<?php echo $count;?>"></td>
												<td><input  type="text" validate="onlyNumbers" value="<?php echo $row_1["working_capital"]; ?>"  id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="25"></td>
												<td><input  type="text" validate="onlyNumbers" value="<?php echo $row_1["working_capital_limit"]; ?>"  id="txtE<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txtE<?php echo $count;?>"></td>					
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input  type="text" id="txtA1" value="1" readonly size="25"  class="form-control text-uppercase" name="txtA1"></td>
											<td><input  type="text" id="txtB1" size="25"   class="form-control text-uppercase" name="txtB1"></td>					
											<td><input  type="text" id="txtC1" size="25" validate="onlyNumbers" class="form-control text-uppercase"  name="txtC1"></td>
											<td><input  type="text" id="txtD1" size="25" validate="onlyNumbers" class="form-control text-uppercase" name="txtD1"></td>		
											<td><input  type="text" id="txtE1" size="25" validate="onlyNumbers" class="form-control text-uppercase" name="txtE1"></td>		
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
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
									<tr>
									    <td >11. Product/ Sector  </td>
										<td><select name="s1" class="form-control text-uppercase">
						                    <option value="a" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="a") echo 'selected'; ?>>a</option>
						                        <option value="b"  class="form-control text-uppercase" <?php if(isset($s1) && $s1=="b") echo 'selected'; ?>>b</option>
						                        <option value="c" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="c") echo 'selected'; ?>>c</option>
						                        <option value="d" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="d") echo 'selected'; ?>>d</option>
						                        <option value="e" class="form-control text-uppercase" <?php if(isset($s1) && $s1=="e") echo 'selected'; ?>>e</option>
					                        </select>
					                    </td>
										<td>12.Registration details<span class="mandatory_field">*</span></td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="reg_details" value="<?php echo $reg_details;?>"></td>
									</tr>
									<tr>
										<td colspan="4">13. Permanent (PMT) Registration no with date/ Acknowledgement of IEM no with date/ EM-part-II No. & date* </td>					
									</tr>
									<tr>
										<td width="25%"> Registration no</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="pmt_reg[no]" value="<?php echo $pmt_reg_no;?>"></td>
										<td width="25%"> Date</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" required="required" name="pmt_reg[dt]" value="<?php if($pmt_reg_dt!="0000-00-00" && $pmt_reg_dt!="") echo date("d-m-Y",strtotime($pmt_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td>14. Date of going into commercial production<span class="mandatory_field">*</span> </td>
										<td><input type="text" class=" dobindia form-control text-uppercase" required="required" name="date_of_production" value="<?php if($date_of_production!="0000-00-00" && $date_of_production!="") echo date("d-m-Y",strtotime($date_of_production)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>15. Any other incentives/subsidy enjoyed by the unit</td>
										<td><input type="text" class="form-control text-uppercase" name="other_incentives" value="<?php echo $other_incentives;?>"></td>
									</tr>
									<tr>
										<td colspan="2">16. Under NEIPP,97/NEIIPP,2007/TS scheme:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table id="" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Incentives/Subsidy under Central Government Policy</th>
												<th width="30%">Amount received in (in Rs.) </th>
												<th width="30%">Year of received</th>
											</tr>
											<tr>
												<td>1</td>
												<td>Central Capital Investment Subsidy</td>
												<td><input type="text" class="form-control text-uppercase addTotal" name="under_neipp[amount1]" validate="onlyNumbers" value="<?php echo $under_neipp_amount1;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="under_neipp[year1]" validate="onlyNumbers" maxlength="4" value="<?php echo $under_neipp_year1;?>"></td>
											</tr>
											<tr>
												<td>2</td>
												<td>Interest Subsidy on Working Capital</td>
												<td><input type="text" class="form-control text-uppercase addTotal" name="under_neipp[amount2]" validate="onlyNumbers" value="<?php echo $under_neipp_amount2;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="under_neipp[year2]" validate="onlyNumbers" maxlength="4" value="<?php echo $under_neipp_year2;?>"></td>
											</tr>
											<tr>
												<td>3</td>
												<td>Insurance Subsidy</td>
												<td><input type="text" class="form-control text-uppercase addTotal" name="under_neipp[amount3]" validate="onlyNumbers" value="<?php echo $under_neipp_amount3;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="under_neipp[year3]" validate="onlyNumbers" maxlength="4" value="<?php echo $under_neipp_year3;?>"></td>
											</tr>
											<tr>
												<td>4</td>
												<td>Transport Subsidy</td>
												<td><input type="text" class="form-control text-uppercase addTotal" name="under_neipp[amount4]" validate="onlyNumbers" value="<?php echo $under_neipp_amount4;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="under_neipp[year4]" validate="onlyNumbers" maxlength="4" value="<?php echo $under_neipp_year4;?>"></td>
											</tr>
											<tr>
												
												<td colspan="2" class="text-center">Total</td>
												<td><input type="text" class="form-control text-uppercase" id="total_amount" name="total_amount" validate="onlyNumbers" value="<?php echo $total_amount;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="total_year" validate="onlyNumbers" value="<?php echo $total_year;?>"></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4">17. Under State Government Policy</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Incentives/subsidy</th>
												<th width="30%">Amount received ( in Rs.) </th>
												<th width="30%">Year of received</th>
											</tr>
											<?php
											$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
											$num2 = $part2->num_rows;
											if($num2>0){
											  $count=1;
											  while($row_2=$part2->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="textB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_2["incentive_name"]; ?>" name="textB<?php echo $count;?>" size="25"></td>
												<td><input type="text" validate="onlyNumbers" value="<?php echo $row_2["amount"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="textC<?php echo $count;?>"></td>
												<td><input type="text" validate="onlyNumbers" maxlength="4" value="<?php echo $row_2["year"]; ?>" id="textD<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="textD<?php echo $count;?>"></td>
															
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input type="text" id="textB1" size="25"   class="form-control text-uppercase" name="textB1"></td>					
											<td><input type="text" id="textC1" size="25" validate="onlyNumbers" class="form-control text-uppercase"  name="textC1"></td>
											<td><input type="text" id="textD1" size="25" validate="onlyNumbers" maxlength="4" class="form-control text-uppercase" name="textD1"></td>			
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
										<td>18. Registration number under the Transport Subsidy Scheme* </td>
										<td><input type="text" class="form-control text-uppercase" name="transport_regno" value="<?php echo $transport_regno;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">19. Period of validity of Transport subsidy as per TS registration<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="period_of_val_f" value="<?php if($period_of_val_f!="0000-00-00" && $period_of_val_f!="") echo date("d-m-Y",strtotime($period_of_val_f)); else echo "";?>" placeholder="DD-MM-YYYY" required readonly="readonly"></td>
										<td>To</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="period_of_val_t" value="<?php if($period_of_val_t!="0000-00-00" && $period_of_val_t!="") echo date("d-m-Y",strtotime($period_of_val_t)); else echo "";?>" placeholder="DD-MM-YYYY" required readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">20. Item/s of production: </td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="25%">Name of the item/s </th>
												<th width="20%">Annual Installed Capacity </th>
												<th width="20%">Value (in Rs.) </th>
												<th width="25%">Capacity as per joint capacity assessment/as mentioned in the acknowledgment of IEM if any. </th>
											</tr>
											<?php
											$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
											$num3 = $part3->num_rows;
											if($num3>0){
											  $count=1;
											  while($row_3=$part3->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_3["item_name"]; ?>" name="txxtB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_3["ins_cap"]; ?>" id="txxtC<?php echo $count;?>" validate="onlyNumbers"  class="form-control text-uppercase" size="25" name="txxtC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_3["value"]; ?>"  id="txxtD<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txxtD<?php echo $count;?>" size="25"></td>				
												<td><input type="text" value="<?php echo $row_3["capacity"]; ?>"  id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="25"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
											<td><input type="text" id="txxtB1" size="25"   class="form-control text-uppercase" name="txxtB1"></td>					
											<td><input type="text" id="txxtC1" size="25" class="form-control text-uppercase" validate="onlyNumbers"  name="txxtC1"></td>
											<td><input type="text" id="txxtD1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="txxtD1"></td>			
											<td><input type="text" id="txxtE1" size="25"  class="form-control text-uppercase" name="txxtE1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
										</div>
										</td>
									</tr>
									<tr>
										<td colspan="4">21. Requirement of Raw Materials  </td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="25%">Name of the Raw material/s </th>
												<th width="20%">Annual Requirement </th>
												<th width="20%">Value (in Rs.) </th>
												<th width="25%">Requirement of Raw materials as per joint capacity assessment/as mentioned in the acknowledgment of IEM if any</th>
											</tr>
											<?php
											$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
											$num4 = $part4->num_rows;
											if($num4>0){
											  $count=1;
											  while($row_4=$part4->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["sl_no"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txttB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_4["raw_material"]; ?>" name="txttB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_4["annual_req"]; ?>" id="txttC<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" size="25" name="txttC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_4["value"]; ?>" validate="onlyNumbers" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="25"></td>				
												<td><input type="text" value="<?php echo $row_4["joint_capacity"]; ?>"  id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="25"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
											<td><input type="text" id="txttB1" size="25"   class="form-control text-uppercase" name="txttB1"></td>					
											<td><input type="text" id="txttC1" size="25" validate="onlyNumbers" class="form-control text-uppercase"  name="txttC1"></td>
											<td><input type="text" id="txttD1" size="25" validate="onlyNumbers" class="form-control text-uppercase" name="txttD1"></td>			
											<td><input type="text" id="txttE1" size="25"  class="form-control text-uppercase" name="txttE1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/>
										</div>
										</td>
									</tr>														
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">								
									<tr>
									    <td width="25%">22. Total no of employment in the industrial unit </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $e_n_employee;?>"></td>
										<td width="25%">23. No of Employees as per pay register</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="no_of_employee"  value="<?php echo $no_of_employee;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%">24. No of employees under Contractor</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="emp_under_contractor" value="<?php echo $emp_under_contractor;?>" validate="onlyNumbers"></td>
										<td width="25%">25. TAN no of the unit if any</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tan_n_unit" value="<?php echo $tan_n_unit;?>"></td>
									</tr>
									<tr>
										<td>26. Central Excise Registration no if any</td>
										<td><input type="text" class="form-control text-uppercase" name="central_excise" value="<?php echo $central_excise;?>"></td>
										<td>27. VAT registration of the unit if any</td>
										<td><input type="text" class="form-control text-uppercase" name="vat_reg" value="<?php echo $vat_reg;?>"></td>
									</tr>
									<tr>
										<td colspan="4">28. Statutory amount paid during the period of claim if any:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Item/s</th>
												<th width="30%">Date </th>
												<th width="30%">Amount paid (in Rs.)</th>
											</tr>
											<?php
											$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
											$num5 = $part5->num_rows;
											if($num5>0){
											  $count=1;
											  while($row_5=$part5->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["sl_no"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txttB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_5["item"]; ?>" name="txttB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php if($row_5["date"]!="0000-00-00" && $row_5["date"]!="") echo date("d-m-Y",strtotime($row_5["date"])); else echo "";?>" placeholder="DD-MM-YYYY" class="dobindia form-control text-uppercase" name="txttC<?php echo $count;?>" readonly="readonly"></td>
												<td><input type="text" value="<?php echo $row_5["amount"]; ?>"  id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" validate="onlyNumbers" size="25"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
											<td><input type="text" id="txttB1" size="25" class="form-control text-uppercase" name="txttB1"></td>					
											<td><input type="text" class="dobindia form-control text-uppercase" name="txttC1" placeholder="DD-MM-YYYY" readonly="readonly"/></td>
											<!--<td><input type="text" id="txttC1" class="dob form-control text-uppercase" name="txttC1" placeholder="DD-MM-YYYY" readonly="readonly"></td>-->
											<td><input type="text" id="txttD1" size="25" validate="onlyNumbers" class="form-control text-uppercase" name="txttD1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/>
										</div>
										</td>
									</tr>	
									<tr>
										<td colspan="4">29. Power/Electricity  </td>					
									</tr>
									<tr>
										<td width="25%">Total requirement of Power</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="power[tot_req]" value="<?php echo $power_tot_req;?>"></td>
										<td width="25%">Sanction load (KW)</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="power[sanction_load]" value="<?php echo $power_sanction_load;?>" validate="decimal"></td>
									</tr>
									<tr>
										<td>Connected Load (KW)</td>
										<td><input type="text" class="form-control text-uppercase" name="power[conn_load]" value="<?php echo $power_conn_load;?>" validate="decimal"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">30. Claim for the period</td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="claim[period_from]" value="<?php if($claim_period_from!="0000-00-00" && $claim_period_from!="") echo date("d-m-Y",strtotime($claim_period_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>To</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="claim[period_to]" value="<?php if($claim_period_to!="0000-00-00" && $claim_period_to!="") echo date("d-m-Y",strtotime($claim_period_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>	
									<tr>
										<td>31. Distance from focal point to nearest Railway Station of the factory (km)</td>
										<td><input type="text" class="form-control" name="dist_f_focal" value="<?php echo $dist_f_focal;?>" validate="decimal"></td>
										<td>32. Distance from the railway station to factory</td>
										<td><input type="text" class="form-control" name="dist_f_rstation" value="<?php echo $dist_f_rstation;?>"></td>
									</tr>
									<tr>
										<td colspan="4">33. Particulars of raw materials imported to the industrial unit from outside the North Eastern Region during the period ( as per Annexure-I)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable6" id="objectTable6" class="table table-responsive text-center">
											<tr>
												<tr>
												<th width="10%">Sl no</th>
												<th width="20%">Name of the Raw materials</th>
												<th width="15%">Quantity</th>
												<th width="15%">Value (in Rs.)</th>
												<th width="20%">Transport charges (in Rs.)</th>
												<th width="20%">Transport charges actually paid (in Rs.)</th>
											</tr>
											<?php
											$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
											$num6 = $part6->num_rows;
											if($num6>0){
											  $count=1;
											  while($row_6=$part6->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_6["raw_mat"]; ?>" name="txxtB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_6["qty"]; ?>" id="txxtC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txxtC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_6["value"]; ?>"  id="txxtD<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" name="txxtD<?php echo $count;?>" size="25"></td>			
												<td><input type="text" value="<?php echo $row_6["transport_charge"]; ?>"  id="txxtE<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="25"></td>				
												<td><input type="text" value="<?php echo $row_6["transport_charge_paid"]; ?>"  id="txxtF<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txxtF<?php echo $count;?>" size="25"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
											<td><input type="text" id="txxtB1" size="25"   class="form-control text-uppercase" name="txxtB1"></td>					
											<td><input  id="txxtC1" size="25" class="form-control text-uppercase"  name="txxtC1"></td>
											<td><input type="text" id="txxtD1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="txxtD1"></td>			
											<td><input type="text" id="txxtE1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="txxtE1"></td>			
											<td><input type="text" id="txxtF1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="txxtF1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore6()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/>
										</div>
										</td>
									</tr>
									
									<tr>
										<td colspan="4" class="form-inline">34. Particulars of finished products Exported from <input type="text" class="form-control text-uppercase" name="product_ext_from" validate="letters" value="<?php echo $product_ext_from;?>"> to places outside North Eastern Region ( As per Annexure- III)</td>					
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable7" id="objectTable7" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="20%">Name of the Finished products 	</th>
												<th width="15%">Quantity exported</th>
												<th width="15%">Value (in Rs.)</th>
												<th width="20%">Transport charges (in Rs.)</th>
												<th width="20%">Transport charges actually paid (in Rs.)</th>
											</tr>
											<?php
											$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
											$num7 = $part7->num_rows;
											if($num7>0){
											  $count=1;
											  while($row_7=$part7->fetch_array()){	?>
											<tr>
												<td><input type="text"  readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="textB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_7["product_name"]; ?>" name="textB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_7["quantity"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="textC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_7["value"]; ?>"  id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" validate="onlyNumbers" size="25"></td>				
												<td><input type="text" value="<?php echo $row_7["transport_charge"]; ?>"  id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" validate="onlyNumbers" size="25"></td>
												<td><input type="text" value="<?php echo $row_7["transport_charge_paid"]; ?>"  id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>" validate="onlyNumbers" size="25"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input type="text" id="textB1" size="25"   class="form-control text-uppercase" name="textB1"></td>					
											<td><input  type="text" id="textC1" size="25" class="form-control text-uppercase"  name="textC1"></td>
											<td><input type="text" id="textD1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="textD1"></td>			
											<td><input type="text" id="textE1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="textE1"></td>			
											<td><input type="text" id="textF1" size="25"  class="form-control text-uppercase" validate="onlyNumbers" name="textF1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore7()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction7()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/>
										</div>
										</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">
									<tr>
										<td colspan="4">35. Details of utilization of imported raw materials and manufacture of finished products during the period ( vide Annexure-II)  </td>
									</tr>
									<tr>
										<td colspan="2">(a)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable8" id="objectTable8" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Raw Materials</th>
												<th width="20%">Brought from outside NER during the claim period ( Qty)</th>
												<th width="20%">Actually utilized during the period (Qty)</th>
												<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
											</tr>
											<?php
											$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
											$num8 = $part8->num_rows;
											if($num8>0){
											  $count=1;
											  while($row_8=$part8->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="textB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_8["raw_mat"]; ?>" name="textB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_8["outside_qty"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="textC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_8["utilized_qty"]; ?>"  id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="25"></td>				
												<td><input type="text" value="<?php echo $row_8["subsidy_amount"]; ?>"  id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="25"></td>				
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input type="text" id="textB1" size="25"   class="form-control text-uppercase" name="textB1"></td>					
											<td><input type="text" id="textC1" size="25" class="form-control text-uppercase"  name="textC1"></td>
											<td><input type="text" id="textD1" size="25"  class="form-control text-uppercase" name="textD1"></td>			
											<td><input type="text" id="textE1" size="25"  class="form-control text-uppercase" name="textE1"></td>	
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore8()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction8()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval7; ?>"/>
										</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">(b)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable9" id="objectTable9" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Finished products</th>
												<th width="20%">Sold outside of NER during the claim period ( Qty)</th>
												<th width="20%">Actually sold during the period (Qty)</th>
												<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
											</tr>
											<?php
											$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'");
											$num9 = $part9->num_rows;
											if($num9>0){
											  $count=1;
											  while($row_9=$part9->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_9["sl_no"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_9["product_name"]; ?>" name="txxtB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_9["sold_qty"]; ?>" id="txxtC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txxtC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_9["sold_during"]; ?>"  id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>" size="25"></td>				
												<td><input type="text" value="<?php echo $row_9["amount"]; ?>"  id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="25"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
											<td><input type="text" id="txxtB1" size="25"   class="form-control text-uppercase" name="txxtB1"></td>					
											<td><input type="text"  id="txxtC1" size="25" class="form-control text-uppercase"  name="txxtC1"></td>
											<td><input type="text" id="txxtD1" size="25"  class="form-control text-uppercase" name="txxtD1"></td>			
											<td><input type="text" id="txxtE1" size="25"  class="form-control text-uppercase" name="txxtE1"></td>	
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore9()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction9()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval9" name="hiddenval9" value="<?php echo $hiddenval9; ?>"/>
										</div>
										</td>
									</tr>
									<tr>
										<td colspan="4">(c)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable10" id="objectTable10" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Raw Materials</th>
												<th width="20%">Brought within NER during the claim period ( Qty)</th>
												<th width="20%">Actually utilized during the period (Qty)</th>
												<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
											</tr>
											<?php
											$part10=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t10 WHERE form_id='$form_id'");
											$num10 = $part10->num_rows;
											if($num10>0){
											  $count=1;
											  while($row_10=$part10->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_10["sl_no"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
												<td><input type="text" id="txttB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_10["raw_mat"]; ?>" name="txttB<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_10["within_ner_qty"]; ?>" id="txttC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txttC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_10["utilized_qty"]; ?>"  id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="25"></td>	
												<td><input type="text" value="<?php echo $row_10["amount"]; ?>"  id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="25"></td>	
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
											<td><input type="text" id="txttB1" size="25"   class="form-control text-uppercase" name="txttB1"></td>					
											<td><input  id="txttC1" size="25" class="form-control text-uppercase"  name="txttC1"></td>
											<td><input type="text" id="txttD1" size="25"  class="form-control text-uppercase" name="txttD1"></td>		
											<td><input type="text" id="txttE1" size="25"  class="form-control text-uppercase" name="txttE1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore10()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction10()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval10" name="hiddenval10" value="<?php echo $hiddenval10; ?>"/>
										</div>
										</td>
									</tr>
									<tr>
										<td colspan="2">(d)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable11" id="objectTable11" class="table table-responsive text-center">
											<tr>
												<th width="10%">Sl no</th>
												<th width="30%">Name of the Finished products</th>
												<th width="20%">Sold within NER during the claim period ( Qty)</th>
												<th width="20%">Actually sold during the period (Qty)</th>
												<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
											</tr>
											<?php
											$part11=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t11 WHERE form_id='$form_id'");
											$num11 = $part11->num_rows;
											if($num11>0){
											  $count=1;
											  while($row_11=$part11->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_11["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="25"></td>
												<td><input type="text" id="txtB<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_11["product_name"]; ?>" name="txtB<?php echo $count;?>" size="25"></td>
												<td><input type="text"value="<?php echo $row_11["sold_ner_qty"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txtC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_11["sold_during"]; ?>"  id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_11["amount"]; ?>"  id="txtE<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txtE<?php echo $count;?>"></td>					
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" id="txtA1" value="1" readonly size="25"  class="form-control text-uppercase" name="txtA1"></td>
											<td><input type="text" id="txtB1" size="25"   class="form-control text-uppercase" name="txtB1"></td>					
											<td><input type="text" id="txtC1" size="25" class="form-control text-uppercase"  name="txtC1"></td>
											<td><input type="text" id="txtD1" size="25"  validate="onlyNumbers" class="form-control text-uppercase" name="txtD1"></td>		
											<td><input type="text" id="txtE1" size="25"  validate="onlyNumbers" class="form-control text-uppercase" name="txtE1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore11()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction11()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval11" name="hiddenval11" value="<?php echo $hiddenval11; ?>"/>
										</div>
										</td>
									</tr>
									<tr>										
										<td width="25%">36. Unit ( electricity) consumed during the claim period</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="unit_consumed" value="<?php echo $unit_consumed;?>"></td>
										<td width="25%">37. DG set rating during the claim period (if any)</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="dg_set_rating" value="<?php echo $dg_set_rating;?>"></td>
									</tr>
									<tr>										
										<td>38. Diesel consumed for DG set during the period</td>
										<td><input type="text" class="form-control text-uppercase" name="diesel_consumed" value="<?php echo $diesel_consumed;?>"></td>
										<td>39. DG unit consumed during the claim period</td>
										<td><input type="text" class="form-control text-uppercase" name="dg_unit_consumed" value="<?php echo $dg_unit_consumed;?>"></td>
									</tr>
									<tr>										
										<td>40. Total electrical unit consumed during the period ( Electricity from Board + unit consumed from the generator)</td>
										<td><input type="text" class="form-control text-uppercase" name="total_elec_unit" value="<?php echo $total_elec_unit;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">41. Bank Details where the amount of subsidy to be deposited:* </td>
									</tr>
									<tr>
										<td colspan="4">
										<table id="" class="table table-responsive">
											<tr>
												<th width="30%">Name of the Bank</th>
												<th width="20%">Account No</th>
												<th width="20%">Branch</th>
												<th width="20%">IFSC Code of the Branch</th>
												<th width="20%">MICR Code of the Branch</th>
											</tr>
											<tr>
												<td><input type="text" class="form-control text-uppercase" name="bank_details[name]" value="<?php echo $bank_details_name;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="bank_details[no]" value="<?php echo $bank_details_no;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="bank_details[branch]" value="<?php echo $bank_details_branch;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="bank_details[ifsc]" value="<?php echo $bank_details_ifsc;?>"></td>
												<td><input type="text" class="form-control text-uppercase" name="bank_details[micr]"  value="<?php echo $bank_details_micr;?>"></td>
											</tr>
										</table>
										</td>
									</tr>	
									<tr>
										<td >Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> <br/> Place : <label><?php echo strtoupper($dist)?> </label></td>
										<td></td>
										<td></td>
										<td align="right"> <b><?php echo strtoupper($key_person) ?></b> <br/> Signature of Applicant</td>
									</tr>																			
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>d" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
<script type="text/javascript">
	function validatePanNo(val){
            var result;
            var re = /[A-Za-z]{5}[0-9]{4}[A-Za-z]{1}/g;
            result = re.exec(val.value);
            if(result == null || undefined){                
				alert('Please enter a valid PAN number');
				document.getElementById(val.id).value = '';
				document.getElementById(val.id).style.border = "1px solid  #ff6666";				
				return false;
            }else{
				document.getElementById(val.id).style.border = "1px solid  #ccc";
				return true;
			}
        }
		
		$('.addTotal').on('change', function(){
		var sum = 0;
		$('.addTotal').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total_amount').val(sum);
		});
	});
</script>