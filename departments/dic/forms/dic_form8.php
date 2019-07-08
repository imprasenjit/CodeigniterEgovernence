<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="8";
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
			$claim_period_form=$results['claim_period_form'];$claim_period_to=$results['claim_period_to'];$item_of_product=$results['item_of_product'];$promoters_name=$results['promoters_name'];
			if(!empty($results["office_address"])){
				$office_address=json_decode($results["office_address"]);
				$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
			}else{
				$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
			}
			if(!empty($results["promoters_address"])){
				$promoters_address=json_decode($results["promoters_address"]);
				$promoters_address_st1=$promoters_address->st1;$promoters_address_st2=$promoters_address->st2;$promoters_address_vt=$promoters_address->vt;$promoters_address_dist=$promoters_address->dist;$promoters_address_pin=$promoters_address->pin;$promoters_address_mob=$promoters_address->mob;
			}else{
				$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";
			}
			###### PART II #####
			$date_of_comm=$results['date_of_comm'];$date_of_service=$results['date_of_service'];$cert_no=$results['cert_no'];$cert_date=$results['cert_date'];$period_from=$results['period_from'];$period_to=$results['period_to'];$percentage_of_increase=$results['percentage_of_increase'];
			if(!empty($results["new_unit"])){
				$new_unit=json_decode($results["new_unit"]);
				$new_unit_sanction=$new_unit->sanction;$new_unit_dt=$new_unit->dt;$new_unit_load=$new_unit->load;$new_unit_sl_no=$new_unit->sl_no;$new_unit_initial_meter=$new_unit->initial_meter;
			}else{
				$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
			}
			if(!empty($results["exist_unit"])){
				$exist_unit=json_decode($results["exist_unit"]);
				$exist_unit_power=$exist_unit->power;$exist_unit_load=$exist_unit->load;$exist_unit_tot_load=$exist_unit->tot_load;$exist_unit_sl_no=$exist_unit->sl_no;$exist_unit_initial_meter=$exist_unit->initial_meter;$exist_unit_last_meter=$exist_unit->last_meter;
			}else{
				$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
			}
			 
		}else{	
			
			$form_id="";
			###### PART I #####
			$claim_period_form="";$claim_period_to="";$item_of_product="";$promoters_name="";
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
			$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";
			###### PART II #####
			$date_of_comm="";$date_of_service="";$cert_no="";$cert_date="";$period_from="";$period_to="";
			$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
			$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		###### PART I #####
		$claim_period_form=$results['claim_period_form'];$claim_period_to=$results['claim_period_to'];$item_of_product=$results['item_of_product'];$promoters_name=$results['promoters_name'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		if(!empty($results["promoters_address"])){
			$promoters_address=json_decode($results["promoters_address"]);
			$promoters_address_st1=$promoters_address->st1;$promoters_address_st2=$promoters_address->st2;$promoters_address_vt=$promoters_address->vt;$promoters_address_dist=$promoters_address->dist;$promoters_address_pin=$promoters_address->pin;$promoters_address_mob=$promoters_address->mob;
		}else{
			$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";
		}
		###### PART II #####
		$date_of_comm=$results['date_of_comm'];$date_of_service=$results['date_of_service'];$cert_no=$results['cert_no'];$cert_date=$results['cert_date'];$period_from=$results['period_from'];$period_to=$results['period_to'];$percentage_of_increase=$results['percentage_of_increase'];
		if(!empty($results["new_unit"])){
			$new_unit=json_decode($results["new_unit"]);
			$new_unit_sanction=$new_unit->sanction;$new_unit_dt=$new_unit->dt;$new_unit_load=$new_unit->load;$new_unit_sl_no=$new_unit->sl_no;$new_unit_initial_meter=$new_unit->initial_meter;
		}else{
			$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
		}
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_power=$exist_unit->power;$exist_unit_load=$exist_unit->load;$exist_unit_tot_load=$exist_unit->tot_load;$exist_unit_sl_no=$exist_unit->sl_no;$exist_unit_initial_meter=$exist_unit->initial_meter;$exist_unit_last_meter=$exist_unit->last_meter;
		}else{
			$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
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
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center">
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
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td>1. Name of the Unit : </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>PAN</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $pan_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(a). Address of the Factory :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Address of the Office :   </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st1]" required="required" value="<?php echo $office_address_st1;?>" validate="specialchar"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st2]" value="<?php echo $office_address_st2;?>" validate="specialchar"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[vt]" value="<?php echo $office_address_vt;?>" validate="specialchar"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="office_address[dist]" value="<?php echo $office_address_dist;?>" validate="specialchar"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[pin]" value="<?php echo $office_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[mob]" value="<?php echo $office_address_mob;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td>d) E-Mail ID</td>
										<td><input type="email" class="form-control" name="office_address[email]" value="<?php echo $office_address_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">2. Period of Claim :</td>
									</tr>
									<tr>
										<td>From </td>
										<td width="25%"> <input type="text" class="form-control text-uppercase dobindia" required="required" name="claim_period_form" value="<?php if($claim_period_form!="0000-00-00" && $claim_period_form!="") echo date("d-m-Y",strtotime($claim_period_form)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td> To </td>
										<td><input type="text" class="form-control text-uppercase dobindia" required="required" name="claim_period_to" value="<?php if($claim_period_to!="0000-00-00" && $claim_period_to!="") echo date("d-m-Y",strtotime($claim_period_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td>3.Name & Address of the promoter(s) :<span class="mandatory_field">*</span> </td>
									</tr>
									<tr>
										<td width="25%">(a)Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="promoters_name" validate="letters" value="<?php echo $promoters_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									<tr>
										<td colspan="4">(b)Address </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="promoters_address[st1]" value="<?php echo $promoters_address_st1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="promoters_address[st2]" value="<?php echo $promoters_address_st2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[vt]" value="<?php echo $promoters_address_vt;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="promoters_address[dist]" value="<?php echo $promoters_address_dist;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[pin]" value="<?php echo $promoters_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="promoters_address[mob]" validate="mobileNumber" maxlength="10" value="<?php echo $promoters_address_mob;?>"></td>
									</tr>
										
									</tr>
									
									<tr>
										<td>4. Items of production/service rendered:<span class="mandatory_field">*</span>   </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="item_of_product" value="<?php echo $item_of_product; ?>"></td>
										<td></td>
										<td></td>
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
								<table class="table table-responsive ">	
									<tr>
										<td width="25">5. (a) Date of commencement of commercial production/ service ( initial) :  </td>
										<td width="25"><input type="text" class="form-control text-uppercase dobindia" required="required" name="date_of_comm" value="<?php if($date_of_comm!="0000-00-00" && $date_of_comm!="") echo date("d-m-Y",strtotime($date_of_comm)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>			
										<td width="25">(b)Date of commencement of production or service after substantial expansion/declaring :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase dobindia" required="required" name="date_of_service" value="<?php if($date_of_service!="0000-00-00" && $date_of_service!="") echo date("d-m-Y",strtotime($date_of_service)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>	
									</tr>
									<tr>
										<td colspan="4">6. No and date of Eligibility certificate:<span class="mandatory_field">*</span> </td>
									</tr>
									<tr>
										<td> No:   </td>
										<td width="25%"> <input type="text" class="form-control text-uppercase" required="required" name="cert_no" value="<?php echo $cert_no;?>"></td>
										<td>Date</td>
										<td><input type="text" class="dobindia form-control text-uppercase" required="required" name="cert_date" value="<?php if($cert_date!="0000-00-00" && $cert_date!="") echo date("d-m-Y",strtotime($cert_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>        
										<td colspan="4">7. Period of eligibility for availing power subsidy as per EC:<span class="mandatory_field">*</span> </td>
									</tr>
									<tr>
										<td>From </td>
										<td width="25%"><input type="text" class="form-control text-uppercase dobindia" required="required" name="period_from" value="<?php if($period_from!="0000-00-00" && $period_from!="") echo date("d-m-Y",strtotime($period_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>To</td>
										<td><input type="text" class="form-control text-uppercase dobindia" required="required" name="period_to" value="<?php if($period_to!="0000-00-00" && $period_to!="") echo date("d-m-Y",strtotime($period_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										
									</tr>	 
									<tr>
										<td colspan="4"> 8.Details of power connection in case of New unit:</td>
									</tr>
									
									<tr>
										<td  colspan="4">(a) Total Electrical power sanctioned and date of sanctioned:<span class="mandatory_field">*</span></td>
									</tr>
										<tr>
										<td width="25%">Sanction </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[sanction]" value="<?php echo $new_unit_sanction;?>"></td>
										<td width="25%">Date</td>
										<td width="25%"> <input type="text" class="form-control text-uppercase dobindia" required="required" name="new_unit[dt]" value="<?php if($new_unit_dt!="0000-00-00" && $new_unit_dt!="") echo date("d-m-Y",strtotime($new_unit_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>									
										<td width="25%">(b) Total electrical load connected:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[load]" value="<?php echo $new_unit_load;?>"></td>									
										<td width="25%">(c)Sl no of energy meter(s) allotted:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[sl_no]" value="<?php echo $new_unit_sl_no;?>"></td>
									
									<tr>
										<td width="25%">(d) Initial energy meter reading<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="new_unit[initial_meter]" value="<?php echo $new_unit_initial_meter;?>"></td>
									</tr>
									<tr>
										<td colspan="4">9.Details of power connection in case of existing unit undertaking substantial expansion/sick unit</td>
									</tr>
									<tr>
										<td width="25%">(a) Additional electrical power sanctioned by ASEB , if any:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[power]" value="<?php echo $exist_unit_power;?>"></td>		
										<td width="25%">(b) Additional electrical load connected:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="exist_unit[load]" value="<?php echo $exist_unit_load;?>"></td>
									</tr>
									<tr>
										<td width="25%">(c) Total electrical load connected:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[tot_load]" value="<?php echo $exist_unit_tot_load;?>"></td>
										<td width="25%">(d) Sl no of energy meter(s) allotted by ASEB for additional Power connection provided:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[sl_no]" value="<?php echo $exist_unit_sl_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">(e) Initial meter reading of the new energy meter provided:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[initial_meter]" value="<?php echo $exist_unit_initial_meter;?>"></td>
									
										<td width="25%">(f) Last meter reading prior to substantial expansion/declaring as a sick etc:<span class="mandatory_field">*</span> </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required" name="exist_unit[last_meter]" value="<?php echo $exist_unit_last_meter;?>"></td>
									</tr>
									<tr>
										<td colspan="3">10.Statement showing the monthly electricity consumption:</br>
										    ( to be submitted separately as per guidelines mentioned earlier) </td>
										<td>Upload Later in upload section</td>
									</tr>
									<tr>
										<td width="25%">11.Percentage of Increase in fixed capital investment as per EC:<span class="mandatory_field">*</span>
										<td width="25%"><input type="text" class="form-control text-uppercase" required="required"  name="percentage_of_increase" value="<?php echo $percentage_of_increase;?>"></td>
										<td></td>
										<td></td>										
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	  <!-- /.content-wrapper -->
	</div>
<?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>