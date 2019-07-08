<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="12";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form12.php";

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$l_o_business=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm"; $l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	$q=$dic->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($dic->error);
	if($q->num_rows<1){
	$p=$dic->query("select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or  die($dic->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
			
			#### PART I #####
			$substantial_exp=$results['substantial_exp'];$office_mob=$results['office_mob'];$act_reg_date=$results['act_reg_date'];	$nature=$results['nature'];	$new_units_dt=$results['new_units_dt'];	$existing_units_dt=$results['existing_units_dt'];	
				if(!empty($results["man_units"])){
					$man_units=json_decode($results["man_units"]);
					$man_units_date_bf_exp1=$man_units->date_bf_exp1;$man_units_date_af_exp1=$man_units->date_af_exp1;
				}else{
					$man_units_date_bf_exp1="";$man_units_date_af_exp1="";
				}
				if(!empty($results["ser_sector"])){
					$ser_sector=json_decode($results["ser_sector"]);
					$ser_sector_date_bf_exp2=$ser_sector->date_bf_exp2;$ser_sector_date_af_exp2=$ser_sector->date_af_exp2;
				}else{
					$ser_sector_date_bf_exp2="";$ser_sector_date_af_exp2="";
				}
					
			#### PART II #####	
			$bnk_ac_no=$results['bnk_ac_no'];$acc_type=$results['acc_type'];$bnk_name=$results['bnk_name'];	$bnk_branch=$results['bnk_branch'];	
			
				if(!empty($results["em_part1"])){
					$em_part1=json_decode($results["em_part1"]);
					$em_part1_ack1=$em_part1->ack1;$em_part1_dt1=$em_part1->dt1;
				}else{
					$em_part1_ack1="";$em_part1_dt1="";
				}
				
				if(!empty($results["em_part2"])){
					$em_part2=json_decode($results["em_part2"]);
					$em_part2_ack2=$em_part2->ack2;$em_part2_dt2=$em_part2->dt2;
				}else{
					$em_part2_ack2="";$em_part2_dt2="";
				}
				if(!empty($results["elig_cert"])){
					$elig_cert=json_decode($results["elig_cert"]);
					$elig_cert_ack3=$elig_cert->ack3;$elig_cert_dt3=$elig_cert->dt3;
				}else{
					$elig_cert_ack3="";$elig_cert_dt3="";
				}
				if(!empty($results["gstn"])){
					$gstn=json_decode($results["gstn"]);
					$gstn_ack4=$gstn->ack4;$gstn_dt4=$gstn->dt4;
				}else{
					$gstn_ack4="";$gstn_dt4="";
				}
				if(!empty($results["pan"])){
					$pan=json_decode($results["pan"]);
					$pan_ack5=$pan->ack5;$pan_dt5=$pan->dt5;
				}else{
					$pan_ack5="";$pan_dt5="";
				}
			
			$period_of_claim_from=$results['period_of_claim_from'];$period_of_claim_to=$results['period_of_claim_to'];$period_of_power_subsidy_from=$results['period_of_power_subsidy_from'];$period_of_power_subsidy_to=$results['period_of_power_subsidy_to'];	
			
				if(!empty($results["tot_elec"])){
					$tot_elec=json_decode($results["tot_elec"]);
					$tot_elec_sanction1=$tot_elec->sanction1;$tot_elec_e_date=$tot_elec->e_date;
				}else{
					$tot_elec_sanction1="";$tot_elec_e_date="";
				}
			
			$tot_load_KVA1=$results['tot_load_KVA1'];$sl_no_energy_met=$results['sl_no_energy_met'];$ini_energy_meter=$results['ini_energy_meter'];
			
			#### PART III #####	
				if(!empty($results["existing_sanction"])){
					$existing_sanction=json_decode($results["existing_sanction"]);
					$existing_sanction_ad_elec=$existing_sanction->ad_elec;$existing_sanction_ad_elect_dt=$existing_sanction->ad_elect_dt;
				}else{
					$existing_sanction_ad_elec="";$existing_sanction_ad_elect_dt="";
				}
			
			$existing_elec_load=$results['existing_elec_load'];$tot_elec_load_con=$results['tot_elec_load_con'];$sl_no_energy_met_all=$results['sl_no_energy_met_all'];$ini_meter_reading=$results['ini_meter_reading'];$last_meter_reading=$results['last_meter_reading'];$mon_elec_consump=$results['mon_elec_consump'];$per_increase_fix_cap=$results['per_increase_fix_cap'];
			$ins_name=$results['ins_name'];
			
				if(!empty($results["ins"])){
					$ins=json_decode($results["ins"]);
					$ins_sn1=$ins->sn1;$ins_sn2=$ins->sn2;$ins_town=$ins->town;$ins_dist=$ins->dist;$ins_pincode=$ins->pincode;$ins_mobile=$ins->mobile;
				}else{
					$ins_sn1="";$ins_sn2="";$ins_town="";$ins_dist="";$ins_pincode="";$ins_mobile="";
				}
				
				$comm_dt_first_fire=$results['comm_dt_first_fire'];
				
				if(!empty($results["period_of_ins"])){
					$period_of_ins=json_decode($results["period_of_ins"]);
					$period_of_ins_p_from=$period_of_ins->p_from;$period_of_ins_p_to=$period_of_ins->p_to;
				}else{
					$period_of_ins_p_from="";$period_of_ins_p_to="";
				}
				
			$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];$tot_sum_ins1=$results['tot_sum_ins1'];	
					
			##### PART IV #####
			$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$work_capital_limit=$results['work_capital_limit'];$sanction_number=$results['sanction_number'];$sanction_dt2=$results['sanction_dt2'];$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];	
				
			##### PART V #####
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
			$source_of_fin1=$results['source_of_fin1'];$source_of_fin2=$results['source_of_fin2'];$source_of_fin3=$results['source_of_fin3'];$source_of_fin4=$results['source_of_fin4'];$source_of_fin5=$results['source_of_fin5'];$source_of_fin6=$results['source_of_fin6'];	

		}else{	 
			$form_id="";
			####Tab1###
			$substantial_exp="";$office_mob="";$act_reg_date="";$nature="";$new_units_dt="";$existing_units_dt="";
			$man_units_date_bf_exp1="";$man_units_date_af_exp1="";
			$ser_sector_date_bf_exp2="";$ser_sector_date_af_exp2="";
			
			#####Tab2#####
			$bnk_ac_no="";$acc_type="";$bnk_name="";$bnk_branch="";
			$em_part1_ack1="";$em_part1_dt1="";
			$em_part2_ack2="";$em_part2_dt2="";
			$elig_cert_ack3="";$elig_cert_dt3="";
			$gstn_ack4="";$gstn_dt4="";
			$pan_ack5="";$pan_dt5="";
			$period_of_claim_from="";$period_of_claim_to="";
			$period_of_power_subsidy_from="";$period_of_power_subsidy_to="";
			$tot_elec_sanction1="";$tot_elec_e_date="";
			$tot_load_KVA1="";$sl_no_energy_met="";$ini_energy_meter="";

			#####Tab3#####
			$existing_sanction_ad_elec="";$existing_sanction_ad_elect_dt="";
			$existing_elec_load="";$tot_elec_load_con="";$sl_no_energy_met_all="";$ini_meter_reading="";$last_meter_reading="";$mon_elec_consump="";$per_increase_fix_cap="";
			$ins_name="";
			$ins_sn1="";$ins_sn2="";$ins_town="";$ins_dist="";$ins_pincode="";$ins_mobile="";
			$comm_dt_first_fire="";
			$period_of_ins_p_from="";$period_of_ins_p_to="";
			$fire_policy_no="";$basis_sum_insured="";$tot_sum_ins1="";
			
			####Tab4####
			$boundary_wall="";$buildings="";$plant_machinery="";$misc_fixed_assets="";$net_pre_paid="";$amount_of_refund="";$is_cert_policy="";$reim_ins_premium="";$work_capital_bnk_name="";$work_capital_branch="";$cash_credit_acc_no="";
			$work_capital_limit="";$sanction_number="";$sanction_dt2="";$tot_interest_charged_bnk="";$tot_interest_subsidy_elig="";
				
			####Tab5####
			$capital_investment_land1="";$capital_investment_land2="";$capital_investment_land3="";
			$capital_investment_sd1="";$capital_investment_sd2="";$capital_investment_sd3="";
			$capital_investment_fact1="";$capital_investment_fact2="";$capital_investment_fact3="";
			$capital_investment_ob1="";$capital_investment_ob2="";$capital_investment_ob3="";
			$capital_investment_items1="";$capital_investment_items2="";$capital_investment_items3="";
			$capital_investment_ei1="";$capital_investment_ei2="";$capital_investment_ei3="";
			$capital_investment_exp1="";$capital_investment_exp2="";$capital_investment_exp3="";
			$capital_investment_tot1="";$capital_investment_tot2="";$capital_investment_tot3="";
			$source_of_fin1="";$source_of_fin2="";$source_of_fin3="";$source_of_fin4="";$source_of_fin5="";$source_of_fin6="";
		}	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		#### PART I #####
		$substantial_exp=$results['substantial_exp'];$office_mob=$results['office_mob'];$act_reg_date=$results['act_reg_date'];	$nature=$results['nature'];	$new_units_dt=$results['new_units_dt'];	$existing_units_dt=$results['existing_units_dt'];	
			if(!empty($results["man_units"])){
				$man_units=json_decode($results["man_units"]);
				$man_units_date_bf_exp1=$man_units->date_bf_exp1;$man_units_date_af_exp1=$man_units->date_af_exp1;
			}else{
				$man_units_date_bf_exp1="";$man_units_date_af_exp1="";
			}
			if(!empty($results["ser_sector"])){
				$ser_sector=json_decode($results["ser_sector"]);
				$ser_sector_date_bf_exp2=$ser_sector->date_bf_exp2;$ser_sector_date_af_exp2=$ser_sector->date_af_exp2;
			}else{
				$ser_sector_date_bf_exp2="";$ser_sector_date_af_exp2="";
			}
				
		#### PART II #####	
		$bnk_ac_no=$results['bnk_ac_no'];$acc_type=$results['acc_type'];$bnk_name=$results['bnk_name'];	$bnk_branch=$results['bnk_branch'];	
		
			if(!empty($results["em_part1"])){
				$em_part1=json_decode($results["em_part1"]);
				$em_part1_ack1=$em_part1->ack1;$em_part1_dt1=$em_part1->dt1;
			}else{
				$em_part1_ack1="";$em_part1_dt1="";
			}
			
			if(!empty($results["em_part2"])){
				$em_part2=json_decode($results["em_part2"]);
				$em_part2_ack2=$em_part2->ack2;$em_part2_dt2=$em_part2->dt2;
			}else{
				$em_part2_ack2="";$em_part2_dt2="";
			}
			if(!empty($results["elig_cert"])){
				$elig_cert=json_decode($results["elig_cert"]);
				$elig_cert_ack3=$elig_cert->ack3;$elig_cert_dt3=$elig_cert->dt3;
			}else{
				$elig_cert_ack3="";$elig_cert_dt3="";
			}
			if(!empty($results["gstn"])){
				$gstn=json_decode($results["gstn"]);
				$gstn_ack4=$gstn->ack4;$gstn_dt4=$gstn->dt4;
			}else{
				$gstn_ack4="";$gstn_dt4="";
			}
			if(!empty($results["pan"])){
				$pan=json_decode($results["pan"]);
				$pan_ack5=$pan->ack5;$pan_dt5=$pan->dt5;
			}else{
				$pan_ack5="";$pan_dt5="";
			}
		
		$period_of_claim_from=$results['period_of_claim_from'];$period_of_claim_to=$results['period_of_claim_to'];$period_of_power_subsidy_from=$results['period_of_power_subsidy_from'];$period_of_power_subsidy_to=$results['period_of_power_subsidy_to'];	
		
			if(!empty($results["tot_elec"])){
				$tot_elec=json_decode($results["tot_elec"]);
				$tot_elec_sanction1=$tot_elec->sanction1;$tot_elec_e_date=$tot_elec->e_date;
			}else{
				$tot_elec_sanction1="";$tot_elec_e_date="";
			}
		
		$tot_load_KVA1=$results['tot_load_KVA1'];$sl_no_energy_met=$results['sl_no_energy_met'];$ini_energy_meter=$results['ini_energy_meter'];
		
		#### PART III #####	
			if(!empty($results["existing_sanction"])){
				$existing_sanction=json_decode($results["existing_sanction"]);
				$existing_sanction_ad_elec=$existing_sanction->ad_elec;$existing_sanction_ad_elect_dt=$existing_sanction->ad_elect_dt;
			}else{
				$existing_sanction_ad_elec="";$existing_sanction_ad_elect_dt="";
			}
		
		$existing_elec_load=$results['existing_elec_load'];$tot_elec_load_con=$results['tot_elec_load_con'];$sl_no_energy_met_all=$results['sl_no_energy_met_all'];$ini_meter_reading=$results['ini_meter_reading'];$last_meter_reading=$results['last_meter_reading'];$mon_elec_consump=$results['mon_elec_consump'];$per_increase_fix_cap=$results['per_increase_fix_cap'];
		$ins_name=$results['ins_name'];
		
			if(!empty($results["ins"])){
				$ins=json_decode($results["ins"]);
				$ins_sn1=$ins->sn1;$ins_sn2=$ins->sn2;$ins_town=$ins->town;$ins_dist=$ins->dist;$ins_pincode=$ins->pincode;$ins_mobile=$ins->mobile;
			}else{
				$ins_sn1="";$ins_sn2="";$ins_town="";$ins_dist="";$ins_pincode="";$ins_mobile="";
			}
		
		$comm_dt_first_fire=$results['comm_dt_first_fire'];
		
			if(!empty($results["period_of_ins"])){
				$period_of_ins=json_decode($results["period_of_ins"]);
				$period_of_ins_p_from=$period_of_ins->p_from;$period_of_ins_p_to=$period_of_ins->p_to;
			}else{
				$period_of_ins_p_from="";$period_of_ins_p_to="";
			}
		$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];$tot_sum_ins1=$results['tot_sum_ins1'];	
				
		##### PART IV #####
		$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$work_capital_limit=$results['work_capital_limit'];$sanction_number=$results['sanction_number'];$sanction_dt2=$results['sanction_dt2'];$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];	
			
		##### PART V #####
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
		$source_of_fin1=$results['source_of_fin1'];$source_of_fin2=$results['source_of_fin2'];$source_of_fin3=$results['source_of_fin3'];$source_of_fin4=$results['source_of_fin4'];$source_of_fin5=$results['source_of_fin5'];$source_of_fin6=$results['source_of_fin6'];	
	}
	
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	if($showtab=="" || $showtab<2 || $showtab>7 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";
	}
	
	##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
	</style>
	<?php include ("".$table_name."_Addmore_old.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
    <div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
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
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">PART IV</a></li>
									<li class="<?php echo $tabbtn5; ?>"><a href="#table5">PART V</a></li>
								</ul>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-bordered table-responsive ">									
										<tr>
											<td width="25%">1. Name of the Enterprise :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">2. Registered Office Address with Telephone No. :</td>	 				
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
											<td>3. New Unit / Existing Unit undertaking Substantial Expansion :</td>
											<td><input type="text" class="form-control text-uppercase" name="substantial_exp" value="<?php echo $substantial_exp;?>"></td>
										</tr>	
										
										<tr>
											<td colspan="4">4. Unit Address with Telephone no  :</td> 	
										</tr>
										<tr>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name3;?>"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name4;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill2;?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist2;?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode2;?>"></td>
											<td>Mobile No.<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase" name="office_mob" value="<?php echo $office_mob; ?>" validate="onlyNumbers" maxlength="10" required></td>
										</tr>
										<tr>
											<td colspan="3">5. Legal Entity of the Enterprise (Proprietorship / Partnership Firm / Private Limited Company / Public Limited Company / Cooperative Society / Society / Limited Liability Partnership)</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val;?>"></td>
										</tr>
										
										<tr>
											<td colspan="4">6. Names and address of the Proprietor/Partners/Directors/President & Secretary :</td>
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
												$member_results=$dic->query("select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
											<td>7. Date of registration under Companies Act,2013 or under Indian Partnership Act, 1932 or under Assam Co-operative Societies Act, 2007 (as applicable) :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="act_reg_date" required="required" value="<?php if($act_reg_date!="0000-00-00" && $act_reg_date!="") echo date("d-m-Y",strtotime($act_reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td>8. Nature of Operations :<span class="mandatory_field">*</span></td>
											<td><select required class="form-control text-uppercase" name="nature">
												<option value="" >Select</option>
												<option value="M" <?php if($nature=="M") echo "selected";?> >Manufacturing</option>
												<option value="S" <?php if($nature=="S") echo "selected";?>>Service Sector</option>
												<option value="T" <?php if($nature=="T") echo "selected";?> >Trading</option>
											</select></td>
										</tr>
										<tr>
											<td colspan="4">9. Date of Commencement of Commercial Production / Operations (for Service Sector) :
											</td>
										</tr>
										<tr>
											<td>i) What is the percentage of investment up to 31.3.2007? </td>
											<td><input type="text" class="form-control text-uppercase"  name="new_units_dt" value="<?php echo $new_units_dt;?>"></td>
											<td>ii) Date of commencement of commercial production after expansion.</td>
											<td><input type="text" class="dobindia form-control text-uppercase" placeholder="DD-MM-YYYY"  name="existing_units_dt" value="<?php echo $existing_units_dt;?>" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="4">
											
											<table class="table table-responsive table-bordered">
												<tr>
													<th>Sl no.</th>
													<th>Date of going into commercial production/becoming operational</th>
													<th>Prior to Expansion</th>
													<th>After Expansion</th>
													
												</tr>
												<tr>
													<td>1.</td>
													<td>For Manufacturing Sector Units</td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="man_units[date_bf_exp1]" required="required" value="<?php if($man_units_date_bf_exp1!="0000-00-00" && $man_units_date_bf_exp1!="") echo date("d-m-Y",strtotime($man_units_date_bf_exp1)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="man_units[date_af_exp1]" value="<?php if($man_units_date_af_exp1!="0000-00-00" && $man_units_date_af_exp1!="") echo date("d-m-Y",strtotime($man_units_date_af_exp1)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
												
												</tr>
												<tr>
													<td>2.</td>
													<td>For Service Sector Units</td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="ser_sector[date_bf_exp2]" value="<?php if($ser_sector_date_bf_exp2!="0000-00-00" && $ser_sector_date_bf_exp2!="") echo date("d-m-Y",strtotime($ser_sector_date_bf_exp2)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="ser_sector[date_af_exp2]"  value="<?php if($ser_sector_date_af_exp2!="0000-00-00" && $ser_sector_date_af_exp2!="") echo date("d-m-Y",strtotime($ser_sector_date_af_exp2)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
												</tr>
											
											</table></td>
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
											<td colspan="4">10. Details of Bank Account where the subsidy Amount, if reimbursed,is to be deposited : </td>
										</tr>	
										<tr>
											<td width="25%">a) Bank A/c Number :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="bnk_ac_no" value="<?php echo $bnk_ac_no;?>"></td>
											
											<td width="25%">b) Type of Account (Current Account, Cash Credit Account, Term Loan Account) :</td>
													<td width="25%"><select name="acc_type" required="required" class="form-control text-uppercase">
															
															<option value='current_account' <?php if($acc_type=='current_account') echo "selected"; ?> >Current Account</option>
															<option value='cash_credit_account' <?php if($acc_type=='cash_credit_account') echo "selected"; ?> >Cash Credit Account</option>
															<option value='term_loan_account' <?php if($acc_type=='term_loan_account') echo "selected"; ?> >Term Loan Account</option>
													</select></td>
											
										</tr>
										<tr>
											<td>c) Name of the Bank :</td>
											<td><input type="text" class="form-control text-uppercase" name="bnk_name" value="<?php echo $bnk_name;?>"></td>
											<td>d) Name of the Branch & Address :</td>
											<td><input type="text" class="form-control text-uppercase" name="bnk_branch" value="<?php echo $bnk_branch;?>"></td>
										</tr>
										
										<tr>
											<td colspan="4">11. Details of Products / Services : </td>
										</tr>
										
										<tr>
											<td colspan="4">(i) Under GST :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="20%">Sl. No.</th>
														<th width="40%">HSN Code</th>
														<th width="40%">Description</th>
													</tr>
													</thead>
													<?php
														$part1=$dic->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["hsn_code"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["desc1"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
																													
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										
										
										<tr>
											<td colspan="4">(ii) Not Under GST :
											<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="20%">Sl. No.</th>
														<th width="40%">NIC Code</th>
														<th width="40%">Description</th>
													</tr>
													</thead>
													<?php
														$part2=$dic->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
														$num2 = $part2->num_rows;
														if($num2>0){
														  $count=1;
														  while($row_2=$part2->fetch_array()){	?>
															<tr>
																<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["nic_code"]; ?>" validate="letters" name="textB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_2["desc2"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
															<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
															<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>
																													
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
											</td>
										</tr>
										
										
										
										<tr>
											<td colspan="4">12. Details of Enterprise Registration : 
											<table class="table table-responsive table-bordered">
												<tr>
													<th> &nbsp; </th>
													<th> &nbsp; </th>
													<th>Ack No</th>
													<th>Date</th>
													
												</tr>
												<tr>
													<td>1. </td>
													<td>Acknowledgement of EM-Part I</td>
													<td><input  type="text" class="form-control text-uppercase" name="em_part1[ack1]" value="<?php echo $em_part1_ack1;?>" validate="onlyNumbers"></td>
													
													<td><input type="text" class="dobindia form-control text-uppercase" name="em_part1[dt1]"  value="<?php if($em_part1_dt1!="0000-00-00" && $em_part1_dt1!="") echo date("d-m-Y",strtotime($em_part1_dt1)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
													
												</tr>
												<tr>
													<td>2. </td>
													<td>EM-Part II or Industrial Entrepreneur Memorandum No.</td>
													<td><input  type="text" class="form-control text-uppercase "  name="em_part2[ack2]" value="<?php echo $em_part2_ack2;?>" validate="onlyNumbers"></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="em_part2[dt2]"  value="<?php if($em_part2_dt2!="0000-00-00" && $em_part2_dt2!="") echo date("d-m-Y",strtotime($em_part2_dt2)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
												</tr>
												
												<tr>
													<td>3. </td>
													<td>Eligibility Certificate </td>
													<td><input  type="text" class="form-control text-uppercase" name="elig_cert[ack3]" value="<?php echo $elig_cert_ack3;?>" validate="onlyNumbers"></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="elig_cert[dt3]"  value="<?php if($elig_cert_dt3!="0000-00-00" && $elig_cert_dt3!="") echo date("d-m-Y",strtotime($elig_cert_dt3)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
												</tr>
												<tr>
													<td>4. </td>
													<td>GSTN</td>
													<td><input  type="text" class="form-control text-uppercase" name="gstn[ack4]" value="<?php echo $gstn_ack4;?>" validate="onlyNumbers"></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="gstn[dt4]"  value="<?php if($gstn_dt4!="0000-00-00" && $gstn_dt4!="") echo date("d-m-Y",strtotime($gstn_dt4)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
												</tr>
												<tr>
													<td>5. </td>
													<td>PAN</td>
													<td><input  type="text" class="form-control text-uppercase"  name="pan[ack5]" value="<?php echo $pan_ack5;?>" validate="onlyNumbers"></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="pan[dt5]"  value="<?php if($pan_dt5!="0000-00-00" && $pan_dt5!="") echo date("d-m-Y",strtotime($pan_dt5)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
												</tr>
											</table></td>
										</tr>
										<tr>
											<td><strong><u>POWER SUBSIDY</u></strong></td>
										</tr>
										
										<tr>
											<td>1. Period of Claim :</td>
											<td></td>
											<td><input type="text" placeholder="From" class="dobindia form-control" name="period_of_claim_from" value="<?php if($period_of_claim_from!="0000-00-00" && $period_of_claim_from!="") echo date("d-m-Y",strtotime($period_of_claim_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>										
											<td><input type="text" placeholder="To" class="dobindia form-control" name="period_of_claim_to" value="<?php if($period_of_claim_to!="0000-00-00" && $period_of_claim_to!="") echo date("d-m-Y",strtotime($period_of_claim_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											
										</tr>
										<tr>
											<td>2. Period of Eligibility for availing power subsidy as per Eligibility Certificate :</td>
											<td></td>
											<td><input type="text" placeholder="From" class="dobindia form-control" name="period_of_power_subsidy_from" value="<?php if($period_of_power_subsidy_from!="0000-00-00" && $period_of_power_subsidy_from!="") echo date("d-m-Y",strtotime($period_of_power_subsidy_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>										
											<td><input type="text" placeholder="To" class="dobindia form-control" name="period_of_power_subsidy_to" value="<?php if($period_of_power_subsidy_to!="0000-00-00" && $period_of_power_subsidy_to!="") echo date("d-m-Y",strtotime($period_of_power_subsidy_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											
										</tr>
										
										<tr>
											<td>3. Details of Power Connection :</td>
										</tr>
										
										<tr>
											<td colspan="4">a) In case of New Unit : 
											<table class="table table-responsive table-bordered">
												<tr>
													<th> &nbsp; </th>
													<th> &nbsp; </th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													
												</tr>
												<tr>
													<td> a) </td>
													<td> Total Electrical Power sanctioned and date of sanction. </td>
													<td><input  type="text" class="form-control text-uppercase" name="tot_elec[sanction1]" value="<?php echo $tot_elec_sanction1;?>" validate="onlyNumbers" placeholder="Sanction"></td>
													
													<td><input type="text" class="dobindia form-control text-uppercase" name="tot_elec[e_date]"  value="<?php if($tot_elec_e_date!="0000-00-00" && $tot_elec_e_date!="") echo date("d-m-Y",strtotime($tot_elec_e_date)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
													
													
												</tr>
												<tr>
													<td> b) </td>
													<td> Total electrical load connected.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="tot_load_KVA1" value="<?php echo $tot_load_KVA1;?>" validate="onlyNumbers" placeholder="Load in KVA"></td>
													
													
												</tr>
												
												<tr>
													<td> c) </td>
													<td> Sl. No. of Energy Meter(s) allotted. </td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="sl_no_energy_met" value="<?php echo $sl_no_energy_met;?>" validate="onlyNumbers"></td>
												</tr>
												<tr>
													<td> d) </td>
													<td> Initial Energy Meter reading.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase" name="ini_energy_meter" value="<?php echo $ini_energy_meter;?>" validate="onlyNumbers"></td>
												</tr>
												
											</table></td>
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
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">b) In case of Existing unit undertaking Substantial Expansion : 
											<table class="table table-responsive table-bordered">
												<tr>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													<th>&nbsp;</th>
													
												</tr>
												<tr>
													<td> a) </td>
													<td> Additional Electrical Power sanctioned by APDCL </td>
													<td><input  type="text" class="form-control text-uppercase" name="existing_sanction[ad_elec]" value="<?php echo $existing_sanction_ad_elec;?>" validate="onlyNumbers" placeholder="Sanction"></td>
													<td><input type="text" class="dobindia form-control text-uppercase" name="existing_sanction[ad_elect_dt]"  value="<?php if($existing_sanction_ad_elect_dt!="0000-00-00" && $existing_sanction_ad_elect_dt!="") echo date("d-m-Y",strtotime($existing_sanction_ad_elect_dt)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
												</tr>
												<tr>
													<td> b) </td>
													<td> Additional Electrical Load connected.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase "  name="existing_elec_load" value="<?php echo $existing_elec_load;?>" validate="onlyNumbers" placeholder="Load in KVA"></td>
													
												</tr>
												<tr>
													<td> c) </td>
													<td> Total Electrical Load connected. </td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="tot_elec_load_con" value="<?php echo $tot_elec_load_con;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
													<td> d) </td>
													<td> Sl. No. of Energy Meter(s) allotted by APDCL for additional Power connection provided.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="sl_no_energy_met_all" value="<?php echo $sl_no_energy_met_all;?>" validate="onlyNumbers"></td>
												</tr>
												<tr>
													<td> e) </td>
													<td> Initial Meter reading of the New Energy Meter.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="ini_meter_reading" value="<?php echo $ini_meter_reading;?>" validate="onlyNumbers"></td>
												</tr>
												<tr>
													<td> f) </td>
													<td> Last Meter reading prior to Substantial Expansion.</td>
													<td>&nbsp;</td>
													<td><input  type="text" class="form-control text-uppercase"  name="last_meter_reading" value="<?php echo $last_meter_reading;?>" validate="onlyNumbers"></td>
												</tr>
												
											</table></td>
										</tr>
										<tr>
											<td width="25%">4. Statement showing the Monthly Electricity Consumption : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="mon_elec_consump" value="<?php echo $mon_elec_consump;?>"></td>
											<td width="25%">5. Percentage of Increase in Fixed Capital Investment as per Eligibility Certificate (in case of Existing unit undertaking Substantial Expansion) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="per_increase_fix_cap" value="<?php echo $per_increase_fix_cap;?>"></td>
										</tr>
										
										<tr>
											<td><strong><u>INSURANCE SUBSIDY</u></strong></td>
										</tr>
										<tr>
											<td colspan="4">1. Name and Address of the Insured (To whom the policy is issued) :</td>
										</tr>
										<tr>
											<td>Name</td>
											<td width="25%"><input type="text" class="text-uppercase form-control" name="ins_name" value="<?php echo $ins_name;?>" validate="letters"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
												<td width="25%">Street Name 1</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="ins[sn1]" value="<?php echo $ins_sn1;?>"></td>
												<td width="25%">Street Name 2</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="ins[sn2]" value="<?php echo $ins_sn2;?>"></td>
										</tr>
										<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" name="ins[town]" value="<?php echo $ins_town;?>"></td>
												<td>District</td>
												<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
												<select name="ins[dist]" class="form-control text-uppercase"><?php
												while($dstrows=$dstresult->fetch_object()) { 
													  if(isset($ins_dist) && ($ins_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
												<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
												<?php } ?>					
											</select></td>
										</tr>
										<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" name="ins[pincode]" value="<?php echo $ins_pincode;?>" maxlength="6" validate="pincode"></td>
												<td>Mobile No.</td>
												<td><input type="text" class="form-control text-uppercase" name="ins[mobile]" value="<?php echo $ins_mobile;?>" maxlength="10" validate="mobileNumber"></td>
										</tr>	
										<tr>
											<td colspan="3">2. Date of commencement of first Fire Insurance Policy on commission of the Unit : </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="comm_dt_first_fire" value="<?php if($comm_dt_first_fire!="0000-00-00" && $comm_dt_first_fire!="") echo date("d-m-Y",strtotime($comm_dt_first_fire)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											
										</tr>
										<tr>
											<td>3. Period of Insurance :</td>
										</tr>
										<tr>
											<td>From</td>
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
											<td width="25%">6. Total Sum Insured (in Rs.) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="tot_sum_ins1" value="<?php echo $tot_sum_ins1; ?>" validate="onlyNumbers"/></td>
											<td></td>
											<td></td>
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
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">					<table class="table table-responsive ">
										<tr>
											<td colspan="4">7. Break up of Sum Insured 
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
											<td>10. Whether a Certificate from the policy issuing office has been attached stating that the policy was in force for the entire policy period and amount of refund availed?<span class="mandatory_field">*</span></td>
											<td><input required type="radio" name="is_cert_policy" checked="checked" value="Y" <?php if($is_cert_policy=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_cert_policy" value="N" <?php if($is_cert_policy=="N") echo "checked"; ?> /> No</td>
											<td>11. Reimbursement of Insurance Premium availed so far under the scheme and details thereof :</td>
											<td><input type="text" class="form-control text-uppercase" name="reim_ins_premium" value="<?php echo $reim_ins_premium; ?>" /></td>
										</tr>
										<tr>
											<td><strong><u>WORKING CAPITAL INTEREST SUBSIDY</u></strong></td>
										</tr>
										<tr>
											<td><strong><u>WORKING CAPITAL</u></strong></td>
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
											<td>2. Cash Credit Account No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="cash_credit_acc_no" value="<?php echo $cash_credit_acc_no;?>" /></td>
											<td>3. Maximum Limit of working capital sanctioned along with the rate of interest :</td>
											<td><input type="text" class="form-control text-uppercase"  name="work_capital_limit" value="<?php echo $work_capital_limit;?>" /></td>
										</tr>
										<tr>
											<td colspan="4">4. Sanction Number & Date :</td>
										</tr>
										
										<tr>
											<td>Number :</td>
											<td><input type="text" class="form-control text-uppercase" name="sanction_number" value="<?php echo $sanction_number;?>" /></td>
											<td>Date :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="sanction_dt2" value="<?php if($sanction_dt2!="0000-00-00" && $sanction_dt2!="") echo date("d-m-Y",strtotime($sanction_dt2)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
										</tr>
										<tr>
											<td>5. Total Interest charged by the Bank :</td>
											<td><input type="text" class="form-control text-uppercase"  name="tot_interest_charged_bnk" value="<?php echo $tot_interest_charged_bnk;?>" /></td>
											<td>6. Total Interest Subsidy Eligible :</td>
											<td><input type="text" class="form-control text-uppercase" name="tot_interest_subsidy_elig" value="<?php echo $tot_interest_subsidy_elig;?>" /></td>
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
									
									<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
									<tr>
										<td colspan="4"><strong><u>Capital Investment</u></strong></td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-bordered table-responsive">
											<thead>
											<tr>
												<th rowspan="2" class="text-center">Sl no.</th>
												<th rowspan="2"  class="text-center">Particulars</th>
												<th rowspan="2"  class="text-center">For New Unit (in Rs) </th>
												<th colspan="2" class="text-center">For Existing Units</th>
												
											</tr>
											<tr>
												
												<th class="text-center">Prior to Expansion</th>
												<th class="text-center">After Expansion</th>
												
											</tr>
											</thead>
											<tr>
													<td>1.</td>
													<td>Land & Site Development</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[land1]" value="<?php echo $capital_investment_land1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[land2]" value="<?php echo $capital_investment_land2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[land3]" value="<?php echo $capital_investment_land3;?>" validate="onlyNumbers"></td>
													
											</tr>
											<tr>
													<td>2.</td>
													<td>Office Building</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala"  name="capital_investment[sd1]" value="<?php echo $capital_investment_sd1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[sd2]" value="<?php echo $capital_investment_sd2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[sd3]" value="<?php echo $capital_investment_sd3;?>" validate="onlyNumbers"></td>
													
											</tr>
												
												<tr>
													<td>3.</td>
													<td>Factory Building</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala"  name="capital_investment[fact1]" value="<?php echo $capital_investment_fact1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb"  name="capital_investment[fact2]" value="<?php echo $capital_investment_fact2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc"  name="capital_investment[fact3]" value="<?php echo $capital_investment_fact3;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
													<td>4.</td>
													<td>Plant & Machinery</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[ob1]" value="<?php echo $capital_investment_ob1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[ob2]" value="<?php echo $capital_investment_ob2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[ob3]" value="<?php echo $capital_investment_ob3;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
													<td>5.</td>
													<td>Accessories</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[items1]" value="<?php echo $capital_investment_items1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[items2]" value="<?php echo $capital_investment_items2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[items3]" value="<?php echo $capital_investment_items3;?>" validate="onlyNumbers"></td>
													
												</tr>
												<tr>
													<td>6.</td>
													<td>Miscellaneous Fixed Assets</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[ei1]" value="<?php echo $capital_investment_ei1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[ei2]" value="<?php echo $capital_investment_ei2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[ei3]" value="<?php echo $capital_investment_ei3;?>" validate="onlyNumbers"></td>
													
													
												</tr>
												<tr>
													<td>7.</td>
													<td>Preliminary & Pre-Operative Expenses</td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitala" name="capital_investment[exp1]" value="<?php echo $capital_investment_exp1;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalb" name="capital_investment[exp2]" value="<?php echo $capital_investment_exp2;?>" validate="onlyNumbers"></td>
													<td><input  type="text" class="form-control text-uppercase fixedCapitalc" name="capital_investment[exp3]" value="<?php echo $capital_investment_exp3;?>" validate="onlyNumbers"></td>
													
												</tr>
												
												<tr>
													<td></td>
													<td>Total</td>
													<td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitala" name="capital_investment[tot1]" disabled="disabled" value="<?php echo $capital_investment_tot1=$capital_investment_land1+$capital_investment_sd1+$capital_investment_fact1+$capital_investment_ob1+$capital_investment_items1+$capital_investment_ei1+$capital_investment_exp1; ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitalb" name="capital_investment[tot2]" disabled="disabled" value="<?php echo $capital_investment_tot2=$capital_investment_land2+$capital_investment_sd2+$capital_investment_fact2+$capital_investment_ob2+$capital_investment_items2+$capital_investment_ei2+$capital_investment_exp2; ?>"></td>
													<td><input  type="text" class="form-control text-uppercase" id="amount_fixedCapitalc" name="capital_investment[tot3]" disabled="disabled" value="<?php echo $capital_investment_tot3=$capital_investment_land3+$capital_investment_sd3+$capital_investment_fact3+$capital_investment_ob3+$capital_investment_items3+$capital_investment_ei3+$capital_investment_exp3; ?>"></td>
													
												</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td colspan="4"><strong><u>CAPITAL INVESTMENT SUBSIDY</u></strong></td>
									</tr>
									<tr>
										<td colspan="4">1. Source of Finance :</td>
									</tr>
									<tr>
										<td width="25%">A. Promoters Contribution</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="source_of_fin1" value="<?php echo $source_of_fin1;?>" /></td>
										<td width="25%">B. Equity</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="source_of_fin2" value="<?php echo $source_of_fin2;?>" /></td>
									</tr>
									<tr>
										<td>C. Term Loan</td>
										<td><input type="text" class="form-control text-uppercase" name="source_of_fin3" value="<?php echo $source_of_fin3;?>" /></td>
										<td>D. Unsecured Loan</td>
										<td><input type="text" class="form-control text-uppercase" name="source_of_fin4" value="<?php echo $source_of_fin4;?>" /></td>
									</tr>
									<tr>
										<td>E. Internal Resources</td>
										<td><input type="text" class="form-control text-uppercase" name="source_of_fin5" value="<?php echo $source_of_fin5;?>" /></td>
										<td>F. Any Other Source</td>
										<td><input type="text" class="form-control text-uppercase" name="source_of_fin6" value="<?php echo $source_of_fin6;?>" /></td>
									</tr>
									<tr>
										<td colspan="4">Details of Term / Working Capital Loan</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable3" id="objectTable3" class="table table-responsive table-bordered text-center">
											<thead>
											<tr>
												<th width="5%">Sl no.</th>
												<th width="15%">Name of Bank/Financial Institution</th>
												<th width="20%">Amount of Term /Working Capital Loan Sanctioned</th>
												<th width="20%">Sanction Letter No.</th>
												<th width="20%">Sanction Date</th>
												<th width="20%">Amount of Term /Working Capital Loan Disbursed</th>
											</tr>
											
											</thead>
											<?php
											$part3=$dic->query("SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
											$num3 = $part3->num_rows;
											if($num3>0){
											  $count=1;
											  while($row_3=$part3->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="taA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="taA<?php echo $count;?>" size="1"></td>											
												<td><input type="text" value="<?php echo $row_3["bnk_fin_name"]; ?>" id="taB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="taB<?php echo $count;?>"></td>											
												<td><input type="text" value="<?php echo $row_3["term_amount"]; ?>" id="taC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="taC<?php echo $count;?>"></td>											
												<td><input type="text" value="<?php echo $row_3["sanction_letter_no"]; ?>" validate="onlyNumbers" id="taD<?php echo $count;?>" class="form-control text-uppercase" name="taD<?php echo $count;?>" size="20"></td>
												
												<td><input type="text" value="<?php echo $row_3["sanction_date_no"]; ?>" id="taE<?php echo $count;?>" class="dob form-control text-uppercase" name="taE<?php echo $count;?>" size="20"></td>
												<td><input type="text" value="<?php echo $row_3["working_cap_term_amt"]; ?>" validate="onlyNumbers" id="taF<?php echo $count;?>" class="form-control text-uppercase" name="taF<?php echo $count;?>" size="20"></td>
												
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input type="text" value="1" readonly id="taA1" size="1" class="form-control text-uppercase" name="taA1"></td>
												<td><input type="text" id="taB1" size="20"  class="form-control text-uppercase" name="taB1"></td>
												<td><input type="text"  id="taC1" size="20" class="form-control text-uppercase"  name="taC1"></td>					
												<td><input type="text" id="taD1" size="20" class="form-control text-uppercase"  name="taD1" validate="onlyNumbers"></td>
												<td><input type="text" id="taE1" size="20" class=" dob form-control text-uppercase"  name="taE1"></td>
												<td><input type="text" id="taF1" size="20" class="form-control text-uppercase"  name="taF1" validate="onlyNumbers"></td>
												
											</tr>
											<?php } ?>
										</table>
											<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
										</td>
									</tr>
									<tr>	
										<td colspan="4">Details of Equity (if any)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable4" id="objectTable4" class="table table-responsive table-bordered text-center">
											<thead>
											<tr>
												<th width="5%">Sl No.</th>
												<th width="15%">Name of the person</th>
												<th width="30%">Amount</th>
												<th width="30%">PAN No.</th>
												<th width="20%">Mode of Payment</th>
											</tr>
											
											</thead>
											<?php
											$part4=$dic->query("SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
											$num4 = $part4->num_rows;
											if($num4>0){
											  $count=1;
											  while($row_4=$part4->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="tbA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="tbA<?php echo $count;?>" size="1"></td>											
												<td><input type="text" value="<?php echo $row_4["name_person"]; ?>" id="tbB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="tbB<?php echo $count;?>"></td>											
												<td><input type="text" value="<?php echo $row_4["amt"]; ?>" id="tbC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="tbC<?php echo $count;?>"></td>											
												<td><input type="text" value="<?php echo $row_4["pan_no"]; ?>" id="tbD<?php echo $count;?>" class="form-control text-uppercase" name="tbD<?php echo $count;?>" size="20"></td>
												<td><input type="text" value="<?php echo $row_4["pay_mode"]; ?>" id="tbE<?php echo $count;?>" class="form-control text-uppercase" name="tbE<?php echo $count;?>" size="20"></td>
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="tbA1" size="1" class="form-control text-uppercase" name="tbA1"></td>
											<td><input type="text" id="tbB1" size="20"   class="form-control text-uppercase" name="tbB1"></td>
											<td><input type="text"  id="tbC1" size="20" class="form-control text-uppercase"  name="tbC1"></td>					
											<td><input type="text" id="tbD1" size="20" class="form-control text-uppercase"  name="tbD1" ></td>
											<td><input type="text" id="tbE1" size="20" class="form-control text-uppercase"  name="tbE1"></td>
											
										</tr>
										<?php } ?>
										</table>
											<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
											<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">Details of Unsecured Loan (if any)</td>
									</tr>
									<tr>
										<td colspan="4">
										<table  name="objectTable5" id="objectTable5" class="table table-responsive table-bordered text-center">
											<thead>
											<tr>
												<th width="5%">Sl no.</th>
												<th width="30%">Name of the person</th>
												<th width="25%">Amount</th>
												<th width="20%">PAN No.</th>
												<th width="20%">Mode of Payment</th>
											</tr>
											</thead>
											<?php
											$part5=$dic->query("SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
											$num5 = $part5->num_rows;
											if($num5>0){
											  $count=1;
											  while($row_5=$part5->fetch_array()){	?>
											<tr>
												<td><input type="text" readonly id="tcA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="tcA<?php echo $count;?>" size="1"></td>
												<td><input type="text" value="<?php echo $row_5["name_person2"]; ?>" id="tcB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="tcB<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_5["amt2"]; ?>" id="tcC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="tcC<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_5["pan_no2"]; ?>"  id="tcD<?php echo $count;?>" class="form-control text-uppercase" name="tcD<?php echo $count;?>" size="20"></td>						
												<td><input type="text" value="<?php echo $row_5["pay_mode2"]; ?>"  id="tcE<?php echo $count;?>" class="form-control text-uppercase" name="tcE<?php echo $count;?>" size="20"></td>						
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="tcA1" size="1" class="form-control text-uppercase" name="tcA1"></td>
											<td><input type="text" id="tcB1" size="20" class="form-control text-uppercase" name="tcB1"></td>
											<td><input type="text" id="tcC1" size="20" class="form-control text-uppercase"  name="tcC1"></td>					
											<td><input type="text" id="tcD1" size="20" class="form-control text-uppercase"  name="tcD1"></td>
											<td><input type="text" id="tcE1" size="20" class="form-control text-uppercase"  name="tcE1"></td>
										</tr>
										<?php } ?>
										</table>
											<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
											Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
										<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
											Status in relation to the unit : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=4" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>e" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	<?php require '../../../user_area/includes/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
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
</body>
</html>