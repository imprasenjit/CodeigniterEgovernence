<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="13";
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
		$new_units_dt=$results['new_units_dt'];$office_mob=$results['office_mob'];$act_reg_date=$results['act_reg_date'];$nature=$results['nature'];$new_production=$results['new_production'];$date_commencement1=$results['date_commencement1'];$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$date_commencement2=$results['date_commencement2'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$PI_indicate=$results['PI_indicate'];$saction_date=$results['saction_date'];$conn_load=$results['conn_load'];$act_date=$results['act_date'];$if_any=$results['if_any'];$if_any1=$results['if_any1'];$if_any2=$results['if_any2'];$if_any3=$results['if_any3'];$capital_investment=$results['capital_investment'];
		
         if(!empty($results["period_of_ins"])){
			$period_of_ins=json_decode($results["period_of_ins"]);
			if(isset($period_of_ins->p_from)) $period_of_ins_p_from=$period_of_ins->p_from; else $period_of_ins_p_from="";
			if(isset($period_of_ins->p_to)) $period_of_ins_p_to=$period_of_ins->p_to; else $period_of_ins_p_to="";
		}else{
			$period_of_ins_p_from="";$period_of_ins_p_to="";
		}
		 
		if(!empty($results["head"])){
			$head=json_decode($results["head"]);
			$head_street1=$head->street1;
			$head_street2=$head->street2;
			$head_vill=$head->vill;
			$head_dist=$head->dist;
			$head_pin=$head->pin;
			$head_mobile=$head->mobile;
			$head_email=$head->email;
		}else{
			$head_street1="";$head_street2="";$head_vill="";$head_dist="";$head_pin="";$head_mobile="";$head_email="";
		}
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
        
		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
	
			if(isset($fixed_amount->land))  $fixed_amount_land=$fixed_amount->land; else $fixed_amount_land="";
			if(isset($fixed_amount->site_dev))  $fixed_amount_site_dev=$fixed_amount->site_dev; else $fixed_amount_site_dev="";
			if(isset($fixed_amount->wall))  $fixed_amount_wall=$fixed_amount->wall; else $fixed_amount_wall="";
			if(isset($fixed_amount->pm))  $fixed_amount_pm=$fixed_amount->pm; else $fixed_amount_pm="";
			if(isset($fixed_amount->fb))  $fixed_amount_fb=$fixed_amount->fb; else $fixed_amount_fb="";
			if(isset($fixed_amount->m))  $fixed_amount_m=$fixed_amount->m; else $fixed_amount_m="";
			if(isset($fixed_amount->ob))  $fixed_amount_ob=$fixed_amount->ob; else $fixed_amount_ob="";
			if(isset($fixed_amount->pe))  $fixed_amount_pe=$fixed_amount->pe; else $fixed_amount_pe="";
			if(isset($fixed_amount->ei))  $fixed_amount_ei=$fixed_amount->ei; else $fixed_amount_ei="";
			if(isset($fixed_amount->ei2))  $fixed_amount_ei2=$fixed_amount->ei2; else $fixed_amount_ei2="";
			if(isset($fixed_amount->ei3))  $fixed_amount_ei3=$fixed_amount->ei3; else $fixed_amount_ei3="";
			
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";$fixed_amount_ei3="";
		}
	}else{		 
		$form_id="";
		$new_units_dt="";$office_mob="";$act_reg_date="";$head_street1="";$head_street2="";$head_vill="";$head_dist="";$head_pin="";$head_mobile="";$head_email="";$new_production="";$nature="";$date_commencement1="";$period_of_ins_p_from="";$period_of_ins_p_to="";
		$fire_policy_no="";$basis_sum_insured="";$tot_sum_ins1="";$boundary_wall="";$buildings="";$plant_machinery="";$misc_fixed_assets="";$net_pre_paid="";$amount_of_refund="";$date_commencement2="";$is_cert_policy="";$reim_ins_premium="";$work_capital_bnk_name="";$work_capital_branch="";$cash_credit_acc_no="";
		$saction_date="";$conn_load="";$act_date="";$if_any="";$if_any1="";$if_any2="";$if_any3="";
		$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		$capital_investment="";
		$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";$fixed_amount_ei3="";
		$PI_indicate="";
		$proposed_managerial="";$proposed_skilled="";$proposed_unskilled="";$proposed_semi_skilled="";$proposed_ss="";$proposed_others=""; 
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$new_units_dt=$results['new_units_dt'];$office_mob=$results['office_mob'];$act_reg_date=$results['act_reg_date'];$nature=$results['nature'];$new_production=$results['new_production'];$date_commencement1=$results['date_commencement1'];$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$date_commencement2=$results['date_commencement2'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$PI_indicate=$results['PI_indicate'];$saction_date=$results['saction_date'];$conn_load=$results['conn_load'];$act_date=$results['act_date'];$if_any=$results['if_any'];$if_any1=$results['if_any1'];$if_any2=$results['if_any2'];$if_any3=$results['if_any3'];$capital_investment=$results['capital_investment'];
		
         if(!empty($results["period_of_ins"])){
			$period_of_ins=json_decode($results["period_of_ins"]);
			if(isset($period_of_ins->p_from)) $period_of_ins_p_from=$period_of_ins->p_from; else $period_of_ins_p_from="";
			if(isset($period_of_ins->p_to)) $period_of_ins_p_to=$period_of_ins->p_to; else $period_of_ins_p_to="";
		}else{
			$period_of_ins_p_from="";$period_of_ins_p_to="";
		}
		 
		if(!empty($results["head"])){
			$head=json_decode($results["head"]);
			$head_street1=$head->street1;
			$head_street2=$head->street2;
			$head_vill=$head->vill;
			$head_dist=$head->dist;
			$head_pin=$head->pin;
			$head_mobile=$head->mobile;
			$head_email=$head->email;
		}else{
			$head_street1="";$head_street2="";$head_vill="";$head_dist="";$head_pin="";$head_mobile="";$head_email="";
		}
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
		}
        
		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
	
			if(isset($fixed_amount->land))  $fixed_amount_land=$fixed_amount->land; else $fixed_amount_land="";
			if(isset($fixed_amount->site_dev))  $fixed_amount_site_dev=$fixed_amount->site_dev; else $fixed_amount_site_dev="";
			if(isset($fixed_amount->wall))  $fixed_amount_wall=$fixed_amount->wall; else $fixed_amount_wall="";
			if(isset($fixed_amount->pm))  $fixed_amount_pm=$fixed_amount->pm; else $fixed_amount_pm="";
			if(isset($fixed_amount->fb))  $fixed_amount_fb=$fixed_amount->fb; else $fixed_amount_fb="";
			if(isset($fixed_amount->m))  $fixed_amount_m=$fixed_amount->m; else $fixed_amount_m="";
			if(isset($fixed_amount->ob))  $fixed_amount_ob=$fixed_amount->ob; else $fixed_amount_ob="";
			if(isset($fixed_amount->pe))  $fixed_amount_pe=$fixed_amount->pe; else $fixed_amount_pe="";
			if(isset($fixed_amount->ei))  $fixed_amount_ei=$fixed_amount->ei; else $fixed_amount_ei="";
			if(isset($fixed_amount->ei2))  $fixed_amount_ei2=$fixed_amount->ei2; else $fixed_amount_ei2="";
			if(isset($fixed_amount->ei3))  $fixed_amount_ei3=$fixed_amount->ei3; else $fixed_amount_ei3="";
			
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";$fixed_amount_ei3="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
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
									<form name="myform13" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the Industrial  Unit. :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $unit_name; ?>" disabled></td>
										</tr>
										<tr>
											<td colspan="4">2. Office Address with telephone no. :</td>								
										</tr>
										<tr>
											<td width="25%"> Street Name1:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Vill/Town:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
											<td width="25%">District:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">PIN Code:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
											<td width="25%">Mobile No:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Phone Number:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">3. Factory Address with telephone no.:</td>				
										</tr>
										<tr>
											<td width="25%">Street Name1:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Vill/Town:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
											<td width="25%">District:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">PIN Code:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
											<td width="25%">Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" name="office_mob" value="<?php echo $office_mob; ?>" validate="onlyNumbers" maxlength="10" required></td>
										</tr>									
										<tr>
											<td width="25%">4. Constitution of the unit(whether Proprietorship/Partnership/Private Ltd./Limited Company/Cooperative):</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $Type_of_ownership; ?>" disabled></td>
										</tr>
										<tr>
											<td colspan="4">5. Names and address of the Proprietor/Partners/Directors/President & Secretary :</td>
										</tr>
										<tr>
											<td colspan="4">
											<table  class="table table-responsive">
											<thead>
												<tr>
											<th width="5%">Sl. No.</th>
											<th width="25%">Partners/Directors Name</th>
											<th width="20%">Street Name 1</th>
											<th width="15%">Street Name 2</th>
											<th width="15%">Village/Town</th>
											<th width="10%">District</th>
											<th width="10%">Pincode</th>
												</tr>
											</thead>	
											<?php 
											$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") ;
											if($member_results->num_rows==0){
												for($i=1;$i<=count($owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>

												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
											<?php }else{
													$i=1;
											while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
													<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
													<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
													<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
													<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
													<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
													
												</tr>
											<?php $i++;
											} ?>
												<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
											<?php } ?>									
											</table>
											
											</td>
										</tr>
										<tr>
											<td>6. Date of registration under the Companies Act/the concerned Act including the Act:</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="act_reg_date" required="required" value="<?php if($act_reg_date!="0000-00-00" && $act_reg_date!="") echo date("d-m-Y",strtotime($act_reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>	
										<tr>
											<td colspan="4">7. Registered Head Office of the Company :</td>	 				
										</tr>
										<tr>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="head[street1]" value="<?php echo $head_street1;?>"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="head[street2]" value="<?php echo $head_street2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase"name="head[vill]"  value="<?php echo $head_vill;?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="head[dist]"  value="<?php echo $head_dist;?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="head[pin]"  value="<?php echo $head_pin;?>" validate="pincode" maxlength="6"></td>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" name="head[mobile]"  value="<?php echo $head_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										</tr>	
										<tr>
											<td>E-Mail ID</td>
											<td><input type="email" class="form-control" name="head[email]"  value="<?php echo $head_email;?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">8. Details of the registration of the unit with the concerned Department<br>(A). If Manufacturing Sector, please indicate :</td>
										</tr>
										<tr>
											<td colspan="4">  (i) Acknowledgement No. / Date of Entrepreneur Memorandum (EM), Part-1 (if any) of MSME :</td>
										</tr>
										<tr>
											<td>Acknowledgement No.</td>
											<td><input type="text" class="form-control text-uppercase"  name="ack[pm_no]" value="<?php echo $ack_pm_no;?>"></td>
											<td>Date of Entrepreneur Memorandum (EM):</td>
											<td><input type="text" class="dobindia form-control text-uppercase"  name="ack[pm_dt]" value="<?php if($ack_pm_dt!="0000-00-00" && $ack_pm_dt!="") echo date("d-m-Y",strtotime($ack_pm_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									   </tr>
									   <tr>
											<td colspan="4">(ii) Acknowledgement No. / Date of Industrial Entrepreneur Memorandum (EM) (if any) of DIPP :</td>
										</tr>
										<tr>
											<td>Acknowledgement No. :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class=" form-control text-uppercase" name="ack[ind_no]" required="required" value="<?php echo $ack_ind_no;?>"></td>
											<td>Date of Industrial Entrepreneur Memorandum (EM) :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="ack[ind_dt]" required="required" value="<?php if($ack_ind_dt!="0000-00-00" && $ack_ind_dt!="") echo date("d-m-Y",strtotime($ack_ind_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="3">(B) If Service Sector, please indicate requisite Registration / License No. from the concerned  Department (if any)  : </td>
											<td><input type="text" class="form-control text-uppercase" name="ack[lic_no]" value="<?php echo $ack_lic_no;?>"></td>
										</tr>
										<tr>
											<td>9. Date of Commencement of Commercial Production (for New Unit) :
											</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>"></td>
										</tr>
										<tr>										
											<td class="text-center" colspan="4">
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
											</td>										
										</tr>
									</table>
									</form>
									</div>
							    
									<div  id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive ">	
											<tr>
												<td>10. Whether the Unit was set up after 1.4.2007 </td>
												<td colspan="2">
													<label class="radio-inline"><input type="radio" required="required" name="if_any" value="Y"  <?php if(isset($if_any) && $if_any=='Y') echo 'checked'; ?> /> Yes</label>
													<label class="radio-inline"><input type="radio" name="if_any"  value="N"  <?php if(isset($if_any) && $if_any=='N') echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
												<td colspan="4">11. If existing unit undergoing substantial expansion,:</td>
											</tr>
											<tr>
											<td>i) What is the percentage of investment up to 31.3.2007? </td>
											<td><input type="text" class="form-control text-uppercase"  name="new_units_dt" value="<?php echo $new_units_dt;?>"></td>
											
											<td>ii) Date of commencement of commercial production after expansion.</td>
											<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="date_commencement2" required="required" value="<?php if($date_commencement2!="0000-00-00" && $date_commencement2!="") echo date("d-m-Y",strtotime($date_commencement2)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										
											</tr>
											<tr>
											<td colspan="2">12. Actual capital Investment (Capitalized value in Rs.): </td><td colspan="2"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="capital_investment" value="<?php echo $capital_investment; ?>"></td>
											</tr>
											<tr>
											<td colspan="4">(a) Land/Site development</td>
											</tr>
											<tr>
											<td width="25%">(i)Land :</td>
											<td width="25%"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[land]" value="<?php echo $fixed_amount_land; ?>"></td>
											<td width="25%">(ii)Site Development :</td>
											<td width="25%"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[site_dev]" value="<?php echo $fixed_amount_site_dev;?>"></td>
											</tr>
											<tr>
											<td width="25%">(iii)Boundary Wall:</td>
											<td width="25%"><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[wall]" value="<?php echo $fixed_amount_wall;?>"></td>
											</tr>
											<tr>
											<td colspan="4">(b) Building</td>
											</tr>
											<tr>
											<td width="25%">(i) Office :</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers" name="fixed_amount[ob]" value="<?php echo $fixed_amount_ob;?>"></td>
											<td width="25%">(ii) Factory :</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[fb]" value="<?php echo$fixed_amount_fb;?>"></td>
											</tr>
											<tr>
											<td>(c) Plant and Machinery / Component / Items : </td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[pm]" value="<?php echo $fixed_amount_pm;?>" ></td>
											<td>(e) Accessories:</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[ei]" value="<?php echo $fixed_amount_ei;?>" ></td>
										   </tr>
											<tr>
											<td>(f) Electrical Installation:</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[ei2]" value="<?php echo $fixed_amount_ei2;?>" ></td>
											
											<td>(g) Erection/ Installation:</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[ei3]" value="<?php echo $fixed_amount_ei3; ?>" ></td>
											</tr>
											<tr>
											<td width="25%"> (h) Miscellaneous fixed assets:</td>
											<td><input  type="text" class="form-control text-uppercase addTotal" validate="onlyNumbers"  name="fixed_amount[m]" value="<?php echo $fixed_amount_m;?>" ></td>
											</tr>
											<tr>
												<td colspan="2">13. Whether a Certificate from a Registered Chartered Accountant (which needs to be Enclosed) on Capital Investment is attached [Form:1E(A)] :
												</td>
												<td>
													<label class="radio-inline"><input type="radio" required="required" name="if_any1" value="Y"  <?php if(isset($if_any1) && $if_any1=='Y') echo 'checked'; ?> /> Yes</label>
													<label class="radio-inline"><input type="radio" name="if_any1"  value="N"  <?php if(isset($if_any1) && $if_any1=='N') echo 'checked'; ?>/> No</label>
												</td>
											</tr>
											<tr>
											<td>14. Means of Finance  :<span class="mandatory_field">*</span></td>
											<td><select required class="form-control 
											<td><select required class="form-control text-uppercase" name="nature">
												<option value="" >Select</option>
												<option value="O" <?php if($nature=="O") echo "selected";?> >Own</option>
												<option value="L" <?php if($nature=="L") echo "selected";?>>Loan</option>
												<option value="OT" <?php if($nature=="OT") echo "selected";?> >Others</option>
											</select></td>
											
											</tr>
											<tr>
											<td colspan="2">15. Whether availed Subsidy under Central Capital Investment Subsidy Scheme, 2007 :
											</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" required="required" name="if_any2" value="Y"  <?php if(isset($if_any2) && $if_any2=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="if_any2"  value="N"  <?php if(isset($if_any2) && $if_any2=='N') echo 'checked'; ?>/> No</label>
											</td>
											</tr>
											<tr>
											<td colspan="2">16. Whether subsidy availed on a new unit or Expanded unit:
											</td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" required="required" name="if_any3" value="Y"  <?php if(isset($if_any3) && $if_any3=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="if_any3"  value="N"  <?php if(isset($if_any3) && $if_any3=='N') echo 'checked'; ?>/> No</label>
											</td>
											</tr>
											<tr>
											<td width="25%">17. If Capital Subsidy is not availed/ granted specify the reason thereof:</td>
											<td width="25%"><textarea name="PI_indicate"  id="PI_indicate" class="form-control text-uppercase"  ><?php echo $PI_indicate; ?></textarea></td>
											</tr>
											<tr>
											<td colspan="4">18.Details of Power Utilization</td>
											</tr>
											<tr>
												<td>i) Date of sanction of power and load:</td>
												<td><input type="text" class="dobindia form-control text-uppercase" name="saction_date" required="required" value="<?php if($saction_date!="0000-00-00" && $saction_date!="") echo date("d-m-Y",strtotime($saction_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											</tr>
											<tr>
											<td>ii) Connected load and date of connection:</td>
											</tr>
											<tr>
											<td width="25%">a) Connection load: </td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="conn_load" value="<?php echo $conn_load;?>"></td>
											<td width="25%">b) Date: </td>
											<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="act_date" required="required" value="<?php if($act_date!="0000-00-00" && $act_date!="") echo date("d-m-Y",strtotime($act_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											</tr>
											<tr>
											<td>iii) Details of production of the new unit:</td>
											<td><input type="text" class="form-control text-uppercase"  name="new_production" value="<?php echo $new_production;?>"></td>
											</tr>
											<tr>
											<td colspan="4">19.Give briefs details of manufacturing process of the unit (attach separate sheets, if necessary)</td>
											</tr>
											<tr>
												<td colspan="4"> 
												<table name="objectTable1" id="objectTable1" class="table table-responsive">
												<tbody>
												<tr>
													<td align="center">Sl No</td>
												   <td align="center">Name of  Product(s)/</td>
												   <td align="center">Installed Annual Production Capacity</td>
												   <td align="center">Actual Annual Production (yearwise)</td>
												</tr>
											   <?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
												  $count=1;
												  while($row_1=$part1->fetch_array()){	?>
												<tr>
													<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
													
													<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
													
													<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>"></td>
													
													<td><input value="<?php echo $row_1["production"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtD<?php echo $count;?>"></td>
													
												</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1" size="1"></td>
													<td><input id="txtB1" size="20"  class="form-control text-uppercase" name="txtB1"></td>
													<td><input id="txtC1" size="20"  class="form-control text-uppercase" name="txtC1"></td>
													<td><input id="txtD1" size="20"  class="form-control text-uppercase" name="txtD1"></td>				
												</tr>
												<?php } ?>
												</tbody>
												</table>
												</td>
											</tr>
											<tr>
											<td colspan="4">
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
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
										<table class="table table-bordered table-responsive ">									
											<tr>
											   <td width="25%">20.Fire Insurance for Fixed Assets </td>
											</tr>
											<tr>
												<td width="25%"> Name of the Insured :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">2. Address of the Insured :</td>	 				
											</tr>
											<tr>
												<td width="25%">Street Name 1</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>"></td>
												<td width="25%">Street Name 2</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
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
												<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_mobile_no;?>"></td>
											</tr>	
											<tr>
												<td>E-Mail ID</td>
												<td><input type="text" class="form-control" disabled value="<?php echo $b_email;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
											<td>c) Date of commencement of first Fire Insurance on commission of the Unit :</td>
											
											<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="date_commencement1" required="required" value="<?php if($date_commencement1!="0000-00-00" && $date_commencement1!="") echo date("d-m-Y",strtotime($date_commencement1)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											
											</tr>
											<tr>
												<td>3. Period of Insurance :</td>
											</tr>
											<tr>
												<td> From</td>
												<td><input type="text" placeholder="From" class="dobindia form-control" name="period_of_ins[p_from]" value="<?php if($period_of_ins_p_from!="0000-00-00" && $period_of_ins_p_from!="") echo date("d-m-Y",strtotime($period_of_ins_p_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
												<td>To</td>										
												<td><input type="text" placeholder="To" class="dobindia form-control" name="period_of_ins[p_to]" value="<?php if($period_of_ins_p_to!="0000-00-00" && $period_of_ins_p_to!="") echo date("d-m-Y",strtotime($period_of_ins_p_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
												
												
											</tr>
											<tr>
												<td>4. Fire Policy No. :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="fire_policy_no"  value="<?php echo $fire_policy_no;?>"> </td>
												<td>5. Basis of Sum Insured (Whether Book Value / Market Value / New Replacement Value)</td>
												<td><input type="text" class="form-control text-uppercase" name="basis_sum_insured" value="<?php echo $basis_sum_insured;?>"></td>
											</tr>
											<tr>
												<td colspan="4">7. Total Sum-Insured
												Break-up of Sum Insured
												<table class="table table-responsive table-bordered">
													<tr>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														<th>&nbsp;</th>
														
													</tr>
													<tr>
													
														<td > I)  Boundary Wall</td>
														<td ><input  type="text" class="form-control text-uppercase" name="boundary_wall" value="<?php echo $boundary_wall;?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													</tr>
													<tr>
														
														<td> II)  Buildings</td>
														<td><input  type="text" class="form-control text-uppercase"  name="buildings" value="<?php echo $buildings;?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													</tr>
													<tr>
														
														<td> III)  Plant & Machinery </td>
														<td><input  type="text" class="form-control text-uppercase"  name="plant_machinery" value="<?php echo $plant_machinery;?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													</tr>
													<tr>
														
														<td> IV)  Miscellaneous Fixed Assets</td>
														<td><input  type="text" class="form-control text-uppercase"  name="misc_fixed_assets" value="<?php echo $misc_fixed_assets;?>" validate="onlyNumbers" placeholder="(in Rs.)"></td>
													</tr>
													
												</table></td>
											</tr>
										   <tr>
											<td width="25%">8. Net Premium paid as per Fire Policy (in Rs.) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="net_pre_paid" value="<?php echo $net_pre_paid; ?>" validate="onlyNumbers"/></td>
											<td width="25%">9. Amount of Refund, after Issuance of policy (in Rs.) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="amount_of_refund" value="<?php echo $amount_of_refund; ?>" validate="onlyNumbers"/></td>
											</tr>
											<tr>
											<td>10. Whether a certificate from the Policy issuing Office attached stating that the Policy was in force for the entire policy period and amount of refund availed/due [in the prescribed Format Form: 1E(B)]<span class="mandatory_field">*</span></td>
											<td><input required type="radio" name="is_cert_policy" checked="checked" value="Y" <?php if($is_cert_policy=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_cert_policy" value="N" <?php if($is_cert_policy=="N") echo "checked"; ?> /> No</td>
											
											<td>11. Reimbursement of Insurance Premium availed so far under the scheme and details thereof :</td>
											<td><input type="text" class="form-control text-uppercase" name="reim_ins_premium" value="<?php echo $reim_ins_premium; ?>" /></td>
											</tr>
											<tr>
											<td colspan="4"> 1. Name of the Bank & Branch providing Working Capital Loan :</td>
											</tr>
											<tr>
											<td>Name of the Bank :</td>
											<td><input type="text" class="form-control text-uppercase" name="work_capital_bnk_name" value="<?php echo $work_capital_bnk_name;?>" /></td>
											<td>Branch :</td>
											<td><input type="text" class="form-control text-uppercase" name="work_capital_branch" value="<?php echo $work_capital_branch;?>" /></td>
											</tr>
											<tr>
											<td>Account No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="cash_credit_acc_no" value="<?php echo $cash_credit_acc_no;?>" /></td>
											</tr>
											<tr>
											<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
											Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
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
	$('.fixedCapitala').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitala').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitala').val(sum);
		});
	});
	$('.fixedCapitalb').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalb').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalb').val(sum);
		});
	});
	$('.fixedCapitalc').on('change', function(){
		var sum = 0;
		
		$('.fixedCapitalc').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_fixedCapitalc').val(sum);
		});
	});
	
	/* ----------------------------------------------------- */
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
</script>