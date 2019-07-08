<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="14";
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
		$claim_no=$results['claim_no'];$period_of_claim_from=$results['period_of_claim_from'];$period_of_claim_to=$results['period_of_claim_to'];$reg_no=$results['reg_no'];$dor=$results['dor'];$reg_no1=$results['reg_no1'];
		$cert=$results['cert'];$man_product=$results['man_product'];$service_product=$results['service_product'];
		$man_dt=$results['man_dt'];$service_dt=$results['service_dt'];$service_product1=$results['service_product1'];
		$turnover=$results['turnover'];$turnover1=$results['turnover1'];$turnover2=$results['turnover2'];
		$raw_material=$results['raw_material'];$finished_product=$results['finished_product'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$work_capital_limit=$results['work_capital_limit'];$sanction_number=$results['sanction_number'];$sanction_dt2=$results['sanction_dt2'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];
		$remarks=$results['remarks'];$employment_generation=$results['employment_generation'];
		
		##### Part A #######
		if(!empty($results["existing_expansional_date"])){
			$existing_expansional_date=json_decode($results["existing_expansional_date"]);
			$existing_expansional_date_msu_pe=$existing_expansional_date->msu_pe;
			$existing_expansional_date_msu_ae=$existing_expansional_date->msu_ae;
			$existing_expansional_date_ssu_pe=$existing_expansional_date->ssu_pe;
			$existing_expansional_date_ssu_ae=$existing_expansional_date->ssu_ae;
		}else{
			$existing_expansional_date_msu_pe="";$existing_expansional_date_msu_ae="";$existing_expansional_date_ssu_pe="";$existing_expansional_date_ssu_ae="";
		}			
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_em_no=$ack->em_no;$ack_em_dt=$ack->em_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_permanent_no=$ack->permanent_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_em_no="";$ack_em_dt="";$ack_ind_dt="";$ack_ind_no="";
			$ack_permanent_no="";
		}
		if(!empty($results["capital_investment"])){
			$capital_investment=json_decode($results["capital_investment"]);			
			$capital_investment_land1=$capital_investment->land1;$capital_investment_land2=$capital_investment->land2;$capital_investment_land3=$capital_investment->land3;			
			$capital_investment_sd1=$capital_investment->sd1;$capital_investment_sd2=$capital_investment->sd2;$capital_investment_sd3=$capital_investment->sd3;			
			$capital_investment_fact1=$capital_investment->fact1;$capital_investment_fact2=$capital_investment->fact2;$capital_investment_fact3=$capital_investment->fact3;
			$capital_investment_ob1=$capital_investment->ob1;$capital_investment_ob2=$capital_investment->ob2;$capital_investment_ob3=$capital_investment->ob3;			
			$capital_investment_items1=$capital_investment->items1;$capital_investment_items2=$capital_investment->items2;$capital_investment_items3=$capital_investment->items3;			
			$capital_investment_ei1=$capital_investment->ei1;$capital_investment_ei2=$capital_investment->ei2;$capital_investment_ei3=$capital_investment->ei3;			
			$capital_investment_exp1=$capital_investment->exp1;$capital_investment_exp2=$capital_investment->exp2;$capital_investment_exp3=$capital_investment->exp3;			
		}else{
			$capital_investment_land1="";$capital_investment_land2="";$capital_investment_land3="";
			$capital_investment_sd1="";$capital_investment_sd2="";$capital_investment_sd3="";
			$capital_investment_fact1="";$capital_investment_fact2="";$capital_investment_fact3="";
			$capital_investment_ob1="";$capital_investment_ob2="";$capital_investment_ob3="";
			$capital_investment_items1="";$capital_investment_items2="";$capital_investment_items3="";
			$capital_investment_ei1="";$capital_investment_ei2="";$capital_investment_ei3="";
			$capital_investment_exp1="";$capital_investment_exp2="";$capital_investment_exp3="";
			$capital_investment_tot1="";$capital_investment_tot2="";$capital_investment_tot3="";
		}		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;
			$fixed_amount_site_dev=$fixed_amount->site_dev;
			$fixed_amount_wall=$fixed_amount->wall;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;$fixed_amount_ei2=$fixed_amount->ei2;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";
		}
	}else{
		$form_id="";
		$claim_no="";$period_of_claim_from="";$period_of_claim_to="";$reg_no="";$dor="";$reg_no1="";$power="";$raw_meterial="";$total_investment="";$new_units_dt="";$existing_units_dt="";$act_date="";$new_production="";$nature="";$date_commencement1="";
		$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";$ack_permanent_no="";$cert="";$man_product="";
		$service_product="";$man_dt="";$service_dt="";
		$existing_expansional_date_msu_pe="";$existing_expansional_date_msu_ae="";$existing_expansional_date_ssu_pe="";$existing_expansional_date_ssu_ae="";
		$capital_investment_land1="";$capital_investment_land2="";$capital_investment_land3="";$capital_investment_sd1="";$capital_investment_sd2="";$capital_investment_sd3="";$capital_investment_fact1="";$capital_investment_fact2="";$capital_investment_fact3="";
		$capital_investment_ob1="";$capital_investment_ob2="";$capital_investment_ob3="";
		$capital_investment_items1="";$capital_investment_items2="";$capital_investment_items3="";
		$capital_investment_ei1="";$capital_investment_ei2="";$capital_investment_ei3="";
		$capital_investment_exp1="";$capital_investment_exp2="";$capital_investment_exp3="";$turnover="";$turnover1="";
		$turnover2="";$raw_material="";$finished_product="";$work_capital_bnk_name="";$work_capital_branch="";$work_capital_limit="";$cash_credit_acc_no="";$sanction_number="";$sanction_dt2="";$tot_interest_charged_bnk="";$tot_interest_subsidy_elig="";$remarks="";$employment_generation="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];$claim_no=$results['claim_no'];$period_of_claim_from=$results['period_of_claim_from'];$period_of_claim_to=$results['period_of_claim_to'];$reg_no=$results['reg_no'];$dor=$results['dor'];$reg_no1=$results['reg_no1'];$cert=$results['cert'];$man_product=$results['man_product'];$service_product=$results['service_product'];$man_dt=$results['man_dt'];$service_dt=$results['service_dt'];$service_product1=$results['service_product1'];$turnover=$results['turnover'];
	$turnover1=$results['turnover1'];$turnover2=$results['turnover2'];$raw_material=$results['raw_material'];$finished_product=$results['finished_product'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$work_capital_limit=$results['work_capital_limit'];$sanction_number=$results['sanction_number'];$sanction_dt2=$results['sanction_dt2'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];$remarks=$results['remarks'];$employment_generation=$results['employment_generation'];
	
	##### Part A #######
	if(!empty($results["existing_expansional_date"])){
		$existing_expansional_date=json_decode($results["existing_expansional_date"]);
		$existing_expansional_date_msu_pe=$existing_expansional_date->msu_pe;
		$existing_expansional_date_msu_ae=$existing_expansional_date->msu_ae;
		$existing_expansional_date_ssu_pe=$existing_expansional_date->ssu_pe;
		$existing_expansional_date_ssu_ae=$existing_expansional_date->ssu_ae;
	}else{
		$existing_expansional_date_msu_pe="";$existing_expansional_date_msu_ae="";$existing_expansional_date_ssu_pe="";$existing_expansional_date_ssu_ae="";
	}		
	if(!empty($results["ack"])){
		$ack=json_decode($results["ack"]);
		$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_em_no=$ack->em_no;$ack_em_dt=$ack->em_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_permanent_no=$ack->permanent_no;
	}else{
		$ack_pm_no="";$ack_pm_dt="";$ack_em_no="";$ack_em_dt="";$ack_ind_dt="";$ack_ind_no="";
		$ack_permanent_no="";
	}	
	if(!empty($results["capital_investment"])){
		$capital_investment=json_decode($results["capital_investment"]);		
		$capital_investment_land1=$capital_investment->land1;$capital_investment_land2=$capital_investment->land2;$capital_investment_land3=$capital_investment->land3;		
		$capital_investment_sd1=$capital_investment->sd1;$capital_investment_sd2=$capital_investment->sd2;$capital_investment_sd3=$capital_investment->sd3;		
		$capital_investment_fact1=$capital_investment->fact1;$capital_investment_fact2=$capital_investment->fact2;$capital_investment_fact3=$capital_investment->fact3;		
		$capital_investment_ob1=$capital_investment->ob1;$capital_investment_ob2=$capital_investment->ob2;$capital_investment_ob3=$capital_investment->ob3;		
		$capital_investment_items1=$capital_investment->items1;$capital_investment_items2=$capital_investment->items2;$capital_investment_items3=$capital_investment->items3;		
		$capital_investment_ei1=$capital_investment->ei1;$capital_investment_ei2=$capital_investment->ei2;$capital_investment_ei3=$capital_investment->ei3;		
		$capital_investment_exp1=$capital_investment->exp1;$capital_investment_exp2=$capital_investment->exp2;$capital_investment_exp3=$capital_investment->exp3;		
	}else{
		$capital_investment_land1="";$capital_investment_land2="";$capital_investment_land3="";
		$capital_investment_sd1="";$capital_investment_sd2="";$capital_investment_sd3="";
		$capital_investment_fact1="";$capital_investment_fact2="";$capital_investment_fact3="";
		$capital_investment_ob1="";$capital_investment_ob2="";$capital_investment_ob3="";
		$capital_investment_items1="";$capital_investment_items2="";$capital_investment_items3="";
		$capital_investment_ei1="";$capital_investment_ei2="";$capital_investment_ei3="";
		$capital_investment_exp1="";$capital_investment_exp2="";$capital_investment_exp3="";
		$capital_investment_tot1="";$capital_investment_tot2="";$capital_investment_tot3="";
	}	
	if(!empty($results["fixed_amount"])){
		$fixed_amount=json_decode($results["fixed_amount"]);
		$fixed_amount_land=$fixed_amount->land;
		$fixed_amount_site_dev=$fixed_amount->site_dev;
		$fixed_amount_wall=$fixed_amount->wall;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;$fixed_amount_ei2=$fixed_amount->ei2;
	}else{
		$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";
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
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform14" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										 <tr>
											<td width="25%">1 (a). Name of Unit </td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $unit_name; ?>" disabled></td>
											<td></td>
											<td></td>
										 </tr>
										 <tr>
											<td colspan="4">(b). Office Address with Telephone/ Mobile no.</td>								
										 </tr>
										 <tr>
											<td width="25%"> Street Name1 :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text"  value="<?php echo $b_street_name1	; ?>" disabled></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_street_name2	; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Vill/Town :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_vill; ?>" disabled></td>
											<td width="25%">District :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_dist; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">PIN Code :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_pincode; ?>" disabled></td>
											<td width="25%">Mobile No :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_mobile_no; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Phone Number :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										 <tr>
											<td colspan="4">(c). Factory Address with Telephone no.</td>				
										 </tr>
										  <tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_street_name1	; ?>" disabled></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_street_name2	; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Vill/Town :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_vill; ?>" disabled></td>
											<td width="25%">District :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_dist; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">PIN Code :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_pincode; ?>" disabled></td>
											<td width="25%">Mobile No :</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" value="<?php echo $b_mobile_no; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">(d) Indicate the claim no. (say 1st claim, 2nd claim, etc.). </td>
											<td width="25%"><textarea name="claim_no" class="form-control text-uppercase"><?php echo $claim_no; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="2">(e). Period of Claim </td>
											<td><input type="text" placeholder="From" class="dobindia form-control" name="period_of_claim_from" value="<?php if($period_of_claim_from!="0000-00-00" && $period_of_claim_from!="") echo date("d-m-Y",strtotime($period_of_claim_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>										
											<td><input type="text" placeholder="To" class="dobindia form-control" name="period_of_claim_to" value="<?php if($period_of_claim_to!="0000-00-00" && $period_of_claim_to!="") echo date("d-m-Y",strtotime($period_of_claim_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="4">2. (a) Registration number under NEIIPP, 2007 along with date</td>
										</tr>
										<tr>
											<td>Registration No. :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class=" form-control text-uppercase" name="reg_no" required="required" value="<?php echo $reg_no;?>"></td>
											<td>Date of Registration :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="dor" required="required" value="<?php if($dor!="0000-00-00" && $dor!="") echo date("d-m-Y",strtotime($dor)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="2">(b) Any other registration number required statutorily/ mandatorily </td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="reg_no1"  value="<?php echo $reg_no1;?>"> </td>
										</tr>
									   <tr>
											<td colspan="2">3. Constitution of the unit(whether Proprietorship/Partnership/Private Ltd./Limited Company/Cooperative) </td>
											<td colspan="2"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $Type_of_ownership; ?>" disabled></td>
										</tr>
										<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>
										</tr>
									</table>
									</form>
									</div>
									
									<div  id="table2" class="tab-pane <?php echo $tabbtn2;?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive table-bordered ">	
										<tr>
										<td colspan="4">4. Name/s, address(es) of the Proprietor/ Partners/ Directors of Board of Directors/ Secretary and President (as applicable) </td>
										</tr>
										<tr>
											<td colspan="4">
											<table  class="table table-responsive">
											<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="20%">Partners/Directors Name</th>
													<th width="15%">Street Name 1</th>
													<th width="15%">Street Name 2</th>
													<th width="15%">Village/Town</th>
													<th width="15%">District</th>
													<th width="15%">Pincode</th>													
												</tr>
											</thead>	
											<?php 
											$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
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
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
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
											<td colspan="4">5. Details of Enterprise Registration </td>
										</tr>
										<tr>
											<td colspan="4">(i) Acknowledgement of Entrepreneur Memorandum (EM)-part-I , No & date <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td width="25%">Acknowledgement No. :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="ack[pm_no]" value="<?php echo $ack_pm_no;?>"></td>
											<td width="25%">Date of Entrepreneur Memorandum (EM) :</td>
											<td width="25%"><input type="text" class="dobindia form-control text-uppercase"  name="ack[pm_dt]" required="required" value="<?php if($ack_pm_dt!="0000-00-00" && $ack_pm_dt!="") echo date("d-m-Y",strtotime($ack_pm_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="4">(ii) Acknowledgement of Entrepreneur Memorandum (EM)-part-II , No & date <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>Acknowledgement No. : </td>
											<td><input type="text" class=" form-control text-uppercase" name="ack[em_no]" required="required" value="<?php echo $ack_em_no;?>"></td>
											<td>Date of Entrepreneur Memorandum (EM) :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="ack[em_dt]" required="required" value="<?php if($ack_em_dt!="0000-00-00" && $ack_em_dt!="") echo date("d-m-Y",strtotime($ack_em_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										
										</tr>
										<tr>
											<td colspan="4">(iii) Acknowledgement of Industrial Entrepreneur Memorandum (IEM), No & date <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>Acknowledgement No. :</td>
											<td><input type="text" class=" form-control text-uppercase" name="ack[ind_no]" required="required" value="<?php echo $ack_ind_no;?>"></td>
											<td>Date of Industrial Entrepreneur Memorandum (EM) :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="ack[ind_dt]" required="required" value="<?php if($ack_ind_dt!="0000-00-00" && $ack_ind_dt!="") echo date("d-m-Y",strtotime($ack_ind_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td>iv) Permanent registration number in case of existing unit </td>
											<td><input type="text" class="form-control text-uppercase" required="required" name="ack[permanent_no]" value="<?php echo $ack_permanent_no;?>"></td>
										</tr>
										
										<tr>
											<td colspan="3">6. Certificate of the unit having become functional/ operational (for Service Sector from concerned Department) : </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" required="required" name="cert" value="Y"  <?php if(isset($cert) && $cert=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="cert"  value="N"  <?php if(isset($cert) && $cert=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
										<td width="25%">7. (a) Name of the product (for Manufacturing Sector) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="man_product" value="<?php echo $man_product;?>"></td>
										<td width="25%">(b) Name of the activity (for Service Sector) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="service_product"value="<?php echo $service_product;?>"></td>
										</tr>
										
										<tr>
											<td colspan="4">8. Whether the unit is new or an existing unit under going substantial expansion</td>
										</tr>
										<tr>
											<td colspan="4">(a) In case of New Unit : </td>
										</tr>
										
										<tr>
											<td>(i) Date of commencement of production (Manufacturing Sector units) :</td>
											<td><input type="text" class="dobindia form-control text-uppercase"  name="man_dt" value="<?php if($man_dt!="0000-00-00" && $man_dt!="") echo date("d-m-Y",strtotime($man_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										
											<td>(ii) Date of becoming operational (Service Sector units) :</td>
											<td><input type="text" class="dobindia form-control text-uppercase"  name="service_dt" value="<?php if($service_dt!="0000-00-00" && $service_dt!="") echo date("d-m-Y",strtotime($service_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>			
										</tr>
										<tr>
											<td colspan="4">(b) In case of Existing Unit :  </td>
										</tr>
										<tr>
											<td colspan="2">Date of going into commercial production/ becoming operational </td>
											<td> Prior to Expansion </td>
											<td> After to Expansion </td>
										</tr>
									
										<tr>
											<td colspan="2">(i)  Manufacturing Sector units :</td>
											<td><input type="text" class="dobindia form-control text-uppercase"  name="existing_expansional_date[msu_pe]" value="<?php if($existing_expansional_date_msu_pe!="0000-00-00" && $existing_expansional_date_msu_pe!="") echo date("d-m-Y",strtotime($existing_expansional_date_msu_pe)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase"  name="existing_expansional_date[msu_ae]" value="<?php if($existing_expansional_date_msu_ae!="0000-00-00" && $existing_expansional_date_msu_ae!="") echo date("d-m-Y",strtotime($existing_expansional_date_msu_ae)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>							
										</tr>	
										<tr>
											<td colspan="2">(i)  Service Sector units :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="existing_expansional_date[ssu_pe]" value="<?php if($existing_expansional_date_ssu_pe!="0000-00-00" && $existing_expansional_date_ssu_pe!="") echo date("d-m-Y",strtotime($existing_expansional_date_ssu_pe)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>	
											<td><input type="text" class="dobindia form-control text-uppercase" name="existing_expansional_date[ssu_ae]" value="<?php if($existing_expansional_date_ssu_ae!="0000-00-00" && $existing_expansional_date_ssu_ae!="") echo date("d-m-Y",strtotime($existing_expansional_date_ssu_ae)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>								
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
									<form name="myform14" id="myformFT1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4">9. Capital Investment [to be supported by CA Certificate as per Form-1D(A)(i)/Form:1D(A)(ii)]</td>
										</tr>
										<tr>
											<td colspan="4">
											<table class="table table-bordered table-responsive">
												<thead>
												<tr>
													<th rowspan="2" class="text-center">Particulars</th>
													<th rowspan="2" class="text-center">For New Unit (Amount in Rs.) </th>
													<th colspan="2" class="text-center">For Existing Units undergoing expansion</th>
													
												</tr>
												<tr>
													
													<th class="text-center">Prior to Expansion</th>
													<th class="text-center">After Expansion</th>
													
												</tr>
												</thead>
												<tr>
														<td>a. Land & Site Development</td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[land1]" value="<?php echo $capital_investment_land1;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[land2]" value="<?php echo $capital_investment_land2;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[land3]" value="<?php echo $capital_investment_land3;?>" validate="onlyNumbers"></td>
														
												</tr>
												<tr>
														<td>b.(i) Office Building</td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitala"  name="capital_investment[sd1]" value="<?php echo $capital_investment_sd1;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[sd2]" value="<?php echo $capital_investment_sd2;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[sd3]" value="<?php echo $capital_investment_sd3;?>" validate="onlyNumbers"></td>
														
												</tr>
												<tr>
														<td>b. (ii) Factory Building</td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitala"  name="capital_investment[fact1]" value="<?php echo $capital_investment_fact1;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[fact2]" value="<?php echo $capital_investment_fact2;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[fact3]" value="<?php echo $capital_investment_fact3;?>" validate="onlyNumbers"></td>
														
													</tr>
												<tr>
													<td>c. Plant & Machinery</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[ob1]" value="<?php echo $capital_investment_ob1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[ob2]" value="<?php echo $capital_investment_ob2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[ob3]" value="<?php echo $capital_investment_ob3;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
													<td>d. Accessories</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[items1]" value="<?php echo $capital_investment_items1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[items2]" value="<?php echo $capital_investment_items2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[items3]" value="<?php echo $capital_investment_items3;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
														<td>e. Miscellaneous Fixed Assets</td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[ei1]" value="<?php echo $capital_investment_ei1;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[ei2]" value="<?php echo $capital_investment_ei2;?>" validate="onlyNumbers"></td>
														<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[ei3]" value="<?php echo $capital_investment_ei3;?>" validate="onlyNumbers"></td>
														
														
													</tr>
												<tr>
													<td>f. Preliminary & Pre-Operative Expenses</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[exp1]" value="<?php echo $capital_investment_exp1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[exp2]" value="<?php echo $capital_investment_exp2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[exp3]" value="<?php echo $capital_investment_exp3;?>" validate="onlyNumbers"></td>
													
												</tr>
											</table>
											</td>
										</tr>
										<tr>
											<td colspan="3">10. Increase in investment (in case of existing unit)</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="service_product1" value="<?php echo $service_product1;?>"></td>
										</tr>
										<tr>
											<td colspan="2">11. (a) For New unit : </td>
											<td>(i) Annual Turnover of the unit (in Rs.) :</td>
											<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="turnover" value="<?php echo $turnover;?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td colspan="2" rowspan="2">(b) For Existing unit undergoing expansion : </td>
											<td>(i) Annual turnover before expansion (in Rs.) :</td>
											<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="turnover1" value="<?php echo $turnover1;?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td>(ii) Annual turnover after expansion (in Rs.) :</td>
											<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="turnover2" value="<?php echo $turnover2;?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td colspan="4">12.(a) Names of the raw materials utilized with quantity and value during the claim period. </td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="30%">Name</th>
														<th width="30%">Quantity</th>
														<th width="30%">Value</th>
													</tr>
													</thead>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name1"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["qty1"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["value1"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10"  class="form-control text-uppercase" name="txtC1"></td>
															<td><input id="txtD1" size="10"  class="form-control text-uppercase" name="txtD1"></td>
																													
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">(b) Name of the finished product(s) alongwith quantity and value during the claim period.
											<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">Sl. No.</th>
														<th width="30%">Name</th>
														<th width="30%">Quantity</th>
														<th width="30%">Value</th>
													</tr>
													</thead>
													<?php
														$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
														$num2 = $part2->num_rows;
														if($num2>0){
														  $count=1;
														  while($row_2=$part2->fetch_array()){	?>
															<tr>
																<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name2"]; ?>" validate="letters" name="textB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_2["qty2"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_2["value2"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
															<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
															<td><input id="textC1" size="10"  class="form-control text-uppercase" name="textC1"></td>
															<td><input id="textD1" size="10"  class="form-control text-uppercase" name="textD1"></td>
																													
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="4">13. Working Capital</td>
										</tr>
										<tr>
											<td colspan="4"> (a). Name of the Bank & Branch providing Working Capital Loan </td>
										</tr>
										<tr>
											<td width ="25%">Name of the Bank :</td>
											<td width ="25%"><input type="text" class="form-control text-uppercase" name="work_capital_bnk_name" value="<?php echo $work_capital_bnk_name;?>" /></td>
											<td width ="25%">Branch :</td>
											<td width ="25%"><input type="text" class="form-control text-uppercase" name="work_capital_branch" value="<?php echo $work_capital_branch;?>" /></td>
										</tr>
										<tr>
											<td colspan="3">(b) Maximum Limit of working capital sanctioned along with the rate of interest :</td>
											<td ><input type="text" class="form-control text-uppercase"  name="work_capital_limit" value="<?php echo $work_capital_limit;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">(c) Sanction Number & Date </td>
										</tr>
										<tr>
											<td width ="25%">Number :</td>
											<td width ="25%"><input type="text" class="form-control text-uppercase" name="sanction_number" value="<?php echo $sanction_number;?>" /></td>
											<td width ="25%">Date :</td>
											<td width ="25%"><input type="text" class="dobindia form-control text-uppercase" name="sanction_dt2" value="<?php if($sanction_dt2!="0000-00-00" && $sanction_dt2!="") echo date("d-m-Y",strtotime($sanction_dt2)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
										</tr>
										<tr>
											<td colspan="2">(d) Cash Credit Account No. of the Unit :</td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="cash_credit_acc_no" value="<?php echo $cash_credit_acc_no;?>" /></td>
										</tr>
										
										<tr>
											<td colspan="2">(e) Total interest charged by the Bank [enclose detailed bank statement for the period, along with recommendation certificate issued by the Bank as per Form:1D(B)]:</td>
											<td colspan="2"><input type="text" class="form-control text-uppercase"  name="tot_interest_charged_bnk" value="<?php echo $tot_interest_charged_bnk;?>" /></td>
										</tr>
										<tr>
											<td colspan="2">(f) Total Interest Subsidy Eligible :</td>
											<td colspan="2"><input type="text" class="form-control text-uppercase" name="tot_interest_subsidy_elig" value="<?php echo $tot_interest_subsidy_elig;?>" /></td>
										</tr>
										<tr>
											<td colspan="2">14. Remarks if any </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="remarks"><?php echo $remarks;?></textarea></td>
										</tr>
										<tr>
											<td colspan="2">15. Employment generation in various fields of work </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="employment_generation"><?php echo $employment_generation;?></textarea></td>
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