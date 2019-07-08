<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="6";
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
           
        $office_mob=$results['office_mob'];$office_email=$results['office_email'];		
		if(!empty($results["act"])){
			$act=json_decode($results["act"]);
			$act_reg_date=$act->reg_date;$act_reg_no=$act->reg_no;$act_reg_office=$act->reg_office;
		}else{
			$act_reg_date="";$act_reg_no="";$act_reg_office="";
		}
		if(!empty($results["provisional"])){
			$provisional=json_decode($results["provisional"]);
			$provisional_reg_date=$provisional->reg_date;$provisional_reg_no=$provisional->reg_no;
		}else{
			$provisional_reg_date="";$provisional_reg_no="";
		}
		if(!empty($results["permanent"])){
			$permanent=json_decode($results["permanent"]);
			$permanent_reg_date=$permanent->reg_date;$permanent_reg_no=$permanent->reg_no;
		}else{
			$permanent_reg_date="";$permanent_reg_no="";
		}
		if(!empty($results["indus"])){
			$indus=json_decode($results["indus"]);
			$indus_license_date=$indus->license_date;$indus_license_no=$indus->license_no;
		}else{
			$indus_license_date="";$indus_license_no="";
		}
		$intimation_letter_no=$results['intimation_letter_no'];$intimation_date=$results['intimation_date'];$note_substantial=$results['note_substantial'];$ec_no=$results['ec_no'];$ec_date=$results['ec_date'];$total_area=$results['total_area'];$area_under_use=$results['area_under_use'];$area_loc=$results['area_loc'];$land_owned=$results['land_owned'];$no_pur_deed=$results['no_pur_deed'];$dor_pur_deed=$results['dor_pur_deed'];$pur_price=$results['pur_price'];$pur_reg_fee=$results['pur_reg_fee'];$stamp_duty=$results['stamp_duty'];$date_possesion=$results['date_possesion'];$lease_from=$results['lease_from'];$lease_to=$results['lease_to'];
		
		if(!empty($results["consultant"])){
			$consultant=json_decode($results["consultant"]);
			$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
		}else{
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";
		}
		if(!empty($results["land_detail"])){
			$land_detail=json_decode($results["land_detail"]);
			$land_detail_dag_no=$land_detail->dag_no;$land_detail_patta_no=$land_detail->patta_no;$land_detail_revenue_vill=$land_detail->revenue_vill;$land_detail_mauza=$land_detail->mauza;
		}else{
			$land_detail_dag_no="";$land_detail_patta_no="";$land_detail_revenue_vill="";$land_detail_mauza="";
		}
		if(!empty($results["land_owner"])){
			$land_owner=json_decode($results["land_owner"]);
			$land_owner_name=$land_owner->name;$land_owner_sn1=$land_owner->sn1;$land_owner_sn2=$land_owner->sn2;$land_owner_vill=$land_owner->vill;$land_owner_dist=$land_owner->dist;$land_owner_pincode=$land_owner->pincode;$land_owner_mobile=$land_owner->mobile;$land_owner_email=$land_owner->email;
		}else{
			$land_owner_name="";$land_owner_sn1="";$land_owner_sn2="";$land_owner_vill="";$land_owner_dist="";$land_owner_pincode="";$land_owner_mobile="";$land_owner_email="";
		}
		if(!empty($results["auth"])){
			$auth=json_decode($results["auth"]);
			$auth_name=$auth->name;$auth_desig=$auth->desig;$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pincode=$auth->pincode;$auth_mobile=$auth->mobile;$auth_email=$auth->email;
		}else{
			$auth_name="";$auth_desig="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pincode="";$auth_mobile="";$auth_email="";
		}
        }else{		 
			$form_id="";
	
	
		####Tab1###
		$office_mob="";$office_email="";
		$act_reg_date="";$act_reg_no="";$act_reg_office="";
		$provisional_reg_no="";$provisional_reg_date="";
		$permanent_reg_no="";$permanent_reg_date="";
		$indus_license_no="";$indus_license_date="";
		
		#####Tab2#####
		$intimation_letter_no="";$intimation_date="";$note_substantial="";
		$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";
		$ec_no="";$ec_date="";$land_owned="";$total_area="";$area_under_use="";$area_loc="";
		$land_detail_dag_no="";$land_detail_patta_no="";$land_detail_revenue_vill="";$land_detail_mauza="";
		$land_owner_name="";$land_owner_sn1="";$land_owner_sn2="";$land_owner_vill="";$land_owner_vill="";$land_owner_dist="";$land_owner_pincode="";$land_owner_mobile="";$land_owner_email="";
		$no_pur_deed="";$dor_pur_deed="";
		$auth_name="";$auth_desig="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pincode="";$auth_mobile="";$auth_email="";
		$pur_price="";$pur_reg_fee="";$stamp_duty="";$date_possesion="";$lease_from="";$lease_to="";
		
		#####Tab3#####
		$building_construction_strt_dt="";$building_construction_com_dt="";$building_construction_total_area="";$building_construction_total_cost="";$building_construction_direct_area="";$building_construction_direct_cost="";
		$govt_agency_name="";$govt_agency_sn1="";$govt_agency_sn2="";$govt_agency_town="";$govt_agency_dist="";$govt_agency_pincode="";$govt_agency_mobile="";$govt_agency_email="";
		$tot_cov_area="";$ann_rent="";$build_reg_no="";$build_reg_dt="";
		$build_loc="";
		$val_period_rent_from="";$val_period_rent_to="";		
		$land_prior="";$land_additional="";$land_total="";
		$site_prior="";$site_additional="";$site_total="";
		$fact_direct_prior="";$fact_direct_additional="";$fact_direct_total="";
		$office_direct_prior="";$office_direct_additional="";$office_direct_total="";
		$plant_prior="";$plant_additional="";$plant_total="";
		$equip_prior="";$equip_additional="";$equip_total="";
		$power_prior="";$power_additional="";$power_total="";
		$electrical_prior="";$electrical_additional="";$electrical_total="";
		$utility_prior="";$utility_additional="";$utility_total="";
		$misc_prior="";$misc_additional="";$misc_total="";
		$prelim_prior="";$prelim_additional="";$prelim_total="";
		$total_f_coloumn="";$total_fixed_capital="";
		
		####Tab4####
		$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";$total_contribution="";
		
		$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";
		$term_prior="";$term_additional="";$term_tot="";
		$wc_prior="";$wc_additional="";$wc_tot="";
		$tl_prior="";$tl_additional="";$tl_tot="";
		$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";
		$repayment_prior="";$repayment_additional="";$repayment_tot="";
		$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";
		$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
		$quant_prior="";$quant_additional="";$quant_tot="";$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";
		$elec_prior="";$elec_additional="";$elec_tot="";$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";
		$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
		$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
		$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";
		$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
		$total_expenditure_prior=""; $total_expenditure_additional=""; $total_expenditure_tot="";
		####Tab5####
		$bef_sub_expan="";$after_sub_expan="";$total_12d_prod="";
		
		####Tab6####
		$mandays_utilized="";		
		$managerial_assam_prior="";$managerial_nonassam_prior="";$managerial_assam_after="";$managerial_nonassam_after="";$managerial_total="";
		$super_assam_prior="";$super_nonassam_prior="";$super_assam_after="";$super_nonassam_after="";$super_total="";
		$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";
		$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";
		$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";
		$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";
        }
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		#### PART I #####
		$office_mob=$results['office_mob'];$office_email=$results['office_email'];		
		if(!empty($results["act"])){
			$act=json_decode($results["act"]);
			$act_reg_date=$act->reg_date;$act_reg_no=$act->reg_no;$act_reg_office=$act->reg_office;
		}else{
			$act_reg_dt="";$act_reg_no="";$act_reg_office="";
		}
		if(!empty($results["provisional"])){
			$provisional=json_decode($results["provisional"]);
			$provisional_reg_date=$provisional->reg_date;$provisional_reg_no=$provisional->reg_no;
		}else{
			$provisional_reg_date="";$provisional_reg_no="";
		}
		if(!empty($results["permanent"])){
			$permanent=json_decode($results["permanent"]);
			$permanent_reg_date=$permanent->reg_date;$permanent_reg_no=$permanent->reg_no;
		}else{
			$permanent_reg_date="";$permanent_reg_no="";
		}
		if(!empty($results["indus"])){
			$indus=json_decode($results["indus"]);
			$indus_license_date=$indus->license_date;$indus_license_no=$indus->license_no;
		}else{
			$indus_license_date="";$indus_license_no="";
		}
		$intimation_letter_no=$results['intimation_letter_no'];$intimation_date=$results['intimation_date'];$note_substantial=$results['note_substantial'];$ec_no=$results['ec_no'];$ec_date=$results['ec_date'];$total_area=$results['total_area'];$area_under_use=$results['area_under_use'];$area_loc=$results['area_loc'];$land_owned=$results['land_owned'];$no_pur_deed=$results['no_pur_deed'];$dor_pur_deed=$results['dor_pur_deed'];$pur_price=$results['pur_price'];$pur_reg_fee=$results['pur_reg_fee'];$stamp_duty=$results['stamp_duty'];$date_possesion=$results['date_possesion'];$lease_from=$results['lease_from'];$lease_to=$results['lease_to'];
		
		if(!empty($results["consultant"])){
			$consultant=json_decode($results["consultant"]);
			$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
		}else{
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";
		}
		if(!empty($results["land_detail"])){
			$land_detail=json_decode($results["land_detail"]);
			$land_detail_dag_no=$land_detail->dag_no;$land_detail_patta_no=$land_detail->patta_no;$land_detail_revenue_vill=$land_detail->revenue_vill;$land_detail_mauza=$land_detail->mauza;
		}else{
			$land_detail_dag_no="";$land_detail_patta_no="";$land_detail_revenue_vill="";$land_detail_mauza="";
		}
		if(!empty($results["land_owner"])){
			$land_owner=json_decode($results["land_owner"]);
			$land_owner_name=$land_owner->name;$land_owner_sn1=$land_owner->sn1;$land_owner_sn2=$land_owner->sn2;$land_owner_vill=$land_owner->vill;$land_owner_dist=$land_owner->dist;$land_owner_pincode=$land_owner->pincode;$land_owner_mobile=$land_owner->mobile;$land_owner_email=$land_owner->email;
		}else{
			$land_owner_name="";$land_owner_sn1="";$land_owner_sn2="";$land_owner_vill="";$land_owner_dist="";$land_owner_pincode="";$land_owner_mobile="";$land_owner_email="";
		}
		if(!empty($results["auth"])){
			$auth=json_decode($results["auth"]);
			$auth_name=$auth->name;$auth_desig=$auth->desig;$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pincode=$auth->pincode;$auth_mobile=$auth->mobile;$auth_email=$auth->email;
		}else{
			$auth_name="";$auth_desig="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pincode="";$auth_mobile="";$auth_email="";
		}
    }
		#### PART II #####	
        $q2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id'");
        if($q2->num_rows<1){
            $p1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
                if($p1->num_rows>0){
                $results2=$p1->fetch_assoc();
			#### PART III #####	
			$tot_cov_area=$results2['tot_cov_area'];$ann_rent=$results2['ann_rent'];$build_loc=$results2['build_loc'];$total_f_coloumn=$results2['total_f_coloumn'];$total_fixed_capital=$results2['total_fixed_capital'];
		
			if(!empty($results2["building_construction"])){
				$building_construction=json_decode($results2["building_construction"]);
				$building_construction_strt_dt=$building_construction->strt_dt;$building_construction_com_dt=$building_construction->comp_dt;$building_construction_total_area=$building_construction->total_area;$building_construction_total_cost=$building_construction->total_cost;$building_construction_direct_area=$building_construction->direct_area;$building_construction_direct_cost=$building_construction->direct_cost;
			}else{
				$building_construction_strt_dt="";$building_construction_com_dt="";$building_construction_total_area="";$building_construction_total_cost="";$building_construction_direct_area="";$building_construction_direct_cost="";
			}
			if(!empty($results2["govt_agency"])){
				$govt_agency=json_decode($results2["govt_agency"]);
				$govt_agency_name=$govt_agency->name;$govt_agency_sn1=$govt_agency->sn1;$govt_agency_sn2=$govt_agency->sn2;$govt_agency_town=$govt_agency->town;$govt_agency_dist=$govt_agency->dist;$govt_agency_pincode=$govt_agency->pincode;$govt_agency_mobile=$govt_agency->mobile;$govt_agency_email=$govt_agency->email;
			}else{
				$govt_agency_name="";$govt_agency_sn1="";$govt_agency_sn2="";$govt_agency_town="";$govt_agency_dist="";$govt_agency_pincode="";$govt_agency_mobile="";$govt_agency_email="";
			}
			if(!empty($results2["build_reg"])){
				$build_reg=json_decode($results2["build_reg"]);
				$build_reg_no=$build_reg->no;$build_reg_dt=$build_reg->dt;
			}else{
				$build_reg_no="";$build_reg_dt="";
			}
			if(!empty($results2["val_period"])){
				$val_period=json_decode($results2["val_period"]);
				$val_period_rent_from=$val_period->rent_from;$val_period_rent_to=$val_period->rent_to;
			}else{
				$val_period_rent_from="";$val_period_rent_to="";
			}
			if(!empty($results2["land"])){
				$land=json_decode($results2["land"]);
				$land_prior=$land->prior;$land_additional=$land->additional;$land_total=$land->total;
			}else{
				$land_prior="";$land_additional="";$land_total="";
			}
			if(!empty($results2["site"])){
				$site=json_decode($results2["site"]);
				$site_prior=$site->prior;$site_additional=$site->additional;$site_total=$site->total;
			}else{
				$site_prior="";$site_additional="";$site_total="";
			}
			if(!empty($results2["fact_direct"])){
				$fact_direct=json_decode($results2["fact_direct"]);
				$fact_direct_prior=$fact_direct->prior;$fact_direct_additional=$fact_direct->additional;$fact_direct_total=$fact_direct->total;
			}else{
				$fact_direct_prior="";$fact_direct_additional="";$fact_direct_total="";
			}
			if(!empty($results2["office_direct"])){
				$office_direct=json_decode($results2["office_direct"]);
				$office_direct_prior=$office_direct->prior;$office_direct_additional=$office_direct->additional;$office_direct_total=$office_direct->total;
			}else{
				$office_direct_prior="";$office_direct_additional="";$office_direct_total="";
			}
			if(!empty($results2["plant"])){
				$plant=json_decode($results2["plant"]);
				$plant_prior=$plant->prior;$plant_additional=$plant->additional;$plant_total=$plant->total;
			}else{
				$plant_prior="";$plant_additional="";$plant_total="";
			}
			if(!empty($results2["equip"])){
				$equip=json_decode($results2["equip"]);
				$equip_prior=$equip->prior;$equip_additional=$equip->additional;$equip_total=$equip->total;
			}else{
				$equip_prior="";$equip_additional="";$equip_total="";
			}
			if(!empty($results2["power"])){
				$power=json_decode($results2["power"]);
				$power_prior=$power->prior;$power_additional=$power->additional;$power_total=$power->total;
			}else{
				$power_prior="";$power_additional="";$power_total="";
			}
			if(!empty($results2["electrical"])){
				$electrical=json_decode($results2["electrical"]);
				$electrical_prior=$electrical->prior;$electrical_additional=$electrical->additional;$electrical_total=$electrical->total;
			}else{
				$electrical_prior="";$electrical_additional="";$electrical_total="";
			}
			if(!empty($results2["utility"])){
				$utility=json_decode($results2["utility"]);
				$utility_prior=$utility->prior;$utility_additional=$utility->additional;$utility_total=$utility->total;
			}else{
				$utility_prior="";$utility_additional="";$utility_total="";
			}
			if(!empty($results2["misc"])){
				$misc=json_decode($results2["misc"]);
				$misc_prior=$misc->prior;$misc_additional=$misc->additional;$misc_total=$misc->total;
			}else{
				$misc_prior="";$misc_additional="";$misc_total="";
			}
			if(!empty($results2["prelim"])){
				$prelim=json_decode($results2["prelim"]);
				$prelim_prior=$prelim->prior;$prelim_additional=$prelim->additional;$prelim_total=$prelim->total;
			}else{
				$prelim_prior="";$prelim_additional="";$prelim_total="";
			}
			##### PART IV #####
			$total_contribution=$results2['total_contribution'];
			
			if(!empty($results2["sources_f_finance"])){
				$sources_f_finance=json_decode($results2["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results2["financial_ins"])){
				$financial_ins=json_decode($results2["financial_ins"]);
				$financial_ins_prior=$financial_ins->prior;$financial_ins_additional=$financial_ins->additional;$financial_ins_tot=$financial_ins->tot;
			}else{
				$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";
			}
			if(!empty($results2["term"])){
				$term=json_decode($results2["term"]);
				$term_prior=$term->prior;$term_additional=$term->additional;$term_tot=$term->tot;
			}else{
				$term_prior="";$term_additional="";$term_tot="";
			}
			if(!empty($results2["wc"])){
				$wc=json_decode($results2["wc"]);
				$wc_prior=$wc->prior;$wc_additional=$wc->additional;$wc_tot=$wc->tot;
			}else{
				$wc_prior="";$wc_additional="";$wc_tot="";
			}
			if(!empty($results2["tl"])){
				$tl=json_decode($results2["tl"]);
				$tl_prior=$tl->prior;$tl_additional=$tl->additional;$tl_tot=$tl->tot;
			}else{
				$tl_prior="";$tl_additional="";$tl_tot="";
			}
			if(!empty($results2["roi_tl"])){
				$roi_tl=json_decode($results2["roi_tl"]);
				$roi_tl_prior=$roi_tl->prior;$roi_tl_additional=$roi_tl->additional;$roi_tl_tot=$roi_tl->tot;
			}else{
				$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";
			}
			if(!empty($results2["repayment"])){
				$repayment=json_decode($results2["repayment"]);
				$repayment_prior=$repayment->prior;$repayment_additional=$repayment->additional;$repayment_tot=$repayment->tot;
			}else{
				$repayment_prior="";$repayment_additional="";$repayment_tot="";
			}
			if(!empty($results2["tl_amt"])){
				$tl_amt=json_decode($results2["tl_amt"]);
				$tl_amt_prior=$tl_amt->prior;$tl_amt_additional=$tl_amt->additional;$tl_amt_tot=$tl_amt->tot;
			}else{
				$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";
			}
			if(!empty($results2["tl_date"])){
				$tl_date=json_decode($results2["tl_date"]);
				$tl_date_prior=$tl_date->prior;$tl_date_additional=$tl_date->additional;$tl_date_tot=$tl_date->tot;
			}else{
				$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";
			}
			if(!empty($results2["wor_cap"])){
				$wor_cap=json_decode($results2["wor_cap"]);
				$wor_cap_prior=$wor_cap->prior;$wor_cap_additional=$wor_cap->additional;$wor_cap_tot=$wor_cap->tot;
			}else{
				$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";
			}
			if(!empty($results2["wor_dat"])){
				$wor_dat=json_decode($results2["wor_dat"]);
				$wor_dat_prior=$wor_dat->prior;$wor_dat_additional=$wor_dat->additional;$wor_dat_tot=$wor_dat->tot;
			}else{
				$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
			}
			if(!empty($results2["quant"])){
				$quant=json_decode($results2["quant"]);
				$quant_prior=$quant->prior;$quant_additional=$quant->additional;$quant_tot=$quant->tot;
			}else{
				$quant_prior="";$quant_additional="";$quant_tot="";
			}
			if(!empty($results2["quant_let"])){
				$quant_let=json_decode($results2["quant_let"]);
				$quant_let_prior=$quant_let->prior;$quant_let_additional=$quant_let->additional;$quant_let_tot=$quant_let->tot;
			}else{
				$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";
			}
			if(!empty($results2["quant_dat"])){
				$quant_dat=json_decode($results2["quant_dat"]);
				$quant_dat_prior=$quant_dat->prior;$quant_dat_additional=$quant_dat->additional;$quant_dat_tot=$quant_dat->tot;
			}else{
				$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";
			}
			if(!empty($results2["elec"])){
				$elec=json_decode($results2["elec"]);
				$elec_prior=$elec->prior;$elec_additional=$elec->additional;$elec_tot=$elec->tot;
			}else{
				$elec_prior="";$elec_additional="";$elec_tot="";
			}
			if(!empty($results2["elec_dat"])){
				$elec_dat=json_decode($results2["elec_dat"]);
				$elec_dat_prior=$elec_dat->prior;$elec_dat_additional=$elec_dat->additional;$elec_dat_tot=$elec_dat->tot;
			}else{
				$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";
			}
			if(!empty($results2["ser_en"])){
				$ser_en=json_decode($results2["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results2["ser_en"])){
				$ser_en=json_decode($results2["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results2["est_amt"])){
				$est_amt=json_decode($results2["est_amt"]);
				$est_amt_prior=$est_amt->prior;$est_amt_additional=$est_amt->additional;$est_amt_tot=$est_amt->tot;
			}else{
				$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";
			}
			if(!empty($results2["est_mr"])){
				$est_mr=json_decode($results2["est_mr"]);
				$est_mr_prior=$est_mr->prior;$est_mr_additional=$est_mr->additional;$est_mr_tot=$est_mr->tot;
			}else{
				$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
			}
			if(!empty($results2["est_dat"])){
				$est_dat=json_decode($results2["est_dat"]);
				$est_dat_prior=$est_dat->prior;$est_dat_additional=$est_dat->additional;$est_dat_tot=$est_dat->tot;
			}else{
				$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";
			}
			if(!empty($results2["sub_expan"])){
				$sub_expan=json_decode($results2["sub_expan"]);
				$sub_expan_prior=$sub_expan->prior;$sub_expan_additional=$sub_expan->additional;$sub_expan_tot=$sub_expan->tot;
			}else{
				$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";
			}
			if(!empty($results2["sub_dat"])){
				$sub_dat=json_decode($results2["sub_dat"]);
				$sub_dat_prior=$sub_dat->prior;$sub_dat_additional=$sub_dat->additional;$sub_dat_tot=$sub_dat->tot;
			}else{
				$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";
			}
			if(!empty($results2["mr_subexpan"])){
				$mr_subexpan=json_decode($results2["mr_subexpan"]);
				$mr_subexpan_prior=$mr_subexpan->prior;$mr_subexpan_additional=$mr_subexpan->additional;$mr_subexpan_tot=$mr_subexpan->tot;
			}else{
				$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";
			}
			if(!empty($results2["mr_subexpan_dat"])){
				$mr_subexpan_dat=json_decode($results2["mr_subexpan_dat"]);
				$mr_subexpan_dat_prior=$mr_subexpan_dat->prior;$mr_subexpan_dat_additional=$mr_subexpan_dat->additional;$mr_subexpan_dat_tot=$mr_subexpan_dat->tot;
			}else{
				$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
			}
			if(!empty($results2["total_expenditure"])){
				$total_expenditure=json_decode($results2["total_expenditure"]);
				$total_expenditure_prior=$total_expenditure->prior;$total_expenditure_additional=$total_expenditure->additional;$total_expenditure_tot=$total_expenditure->tot;
			}else{
				$total_expenditure_prior="";$total_expenditure_additional="";$total_expenditure_tot="";
			}
			##### PART V #####
			$bef_sub_expan=$results2['bef_sub_expan'];$after_sub_expan=$results2['after_sub_expan'];$total_12d_prod=$results2['total_12d_prod'];
			
			
			##### PART VI #####
			$mandays_utilized=$results2['mandays_utilized'];
			if(!empty($results2["managerial"])){
				$managerial=json_decode($results2["managerial"]);
				$managerial_assam_prior=$managerial->assam_prior;$managerial_nonassam_prior=$managerial->nonassam_prior;$managerial_assam_after=$managerial->assam_after;$managerial_nonassam_after=$managerial->nonassam_after;$managerial_total=$managerial->total;
			}else{
				$managerial_assam_prior="";$managerial_nonassam_prior="";$managerial_assam_after="";$managerial_nonassam_after="";$managerial_total="";
			}
			if(!empty($results2["super"])){
				$super=json_decode($results2["super"]);
				$super_assam_prior=$super->assam_prior;$super_nonassam_prior=$super->nonassam_prior;$super_assam_after=$super->assam_after;$super_nonassam_after=$super->nonassam_after;$super_total=$super->total;
			}else{
				$super_assam_prior="";$super_nonassam_prior="";$super_assam_after="";$super_nonassam_after="";$super_total="";
			}
			if(!empty($results2["skilled"])){
				$skilled=json_decode($results2["skilled"]);
				$skilled_assam_prior=$skilled->assam_prior;$skilled_nonassam_prior=$skilled->nonassam_prior;$skilled_assam_after=$skilled->assam_after;$skilled_nonassam_after=$skilled->nonassam_after;$skilled_total=$skilled->total;
			}else{
				$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";
			}
			if(!empty($results2["semiskilled"])){
				$semiskilled=json_decode($results2["semiskilled"]);
				$semiskilled_assam_prior=$semiskilled->assam_prior;$semiskilled_nonassam_prior=$semiskilled->nonassam_prior;$semiskilled_assam_after=$semiskilled->assam_after;$semiskilled_nonassam_after=$semiskilled->nonassam_after;$semiskilled_total=$semiskilled->total;
			}else{
				$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";
			}
			if(!empty($results2["unskilled"])){
				$unskilled=json_decode($results2["unskilled"]);
				$unskilled_assam_prior=$unskilled->assam_prior;$unskilled_nonassam_prior=$unskilled->nonassam_prior;$unskilled_assam_after=$unskilled->assam_after;$unskilled_nonassam_after=$unskilled->nonassam_after;$unskilled_total=$unskilled->total;
			}else{
				$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";
			}
			if(!empty($results2["total"])){
				$total=json_decode($results2["total"]);
				$total_assam_prior=$total->assam_prior;$total_nonassam_prior=$total->nonassam_prior;$total_assam_after=$total->assam_after;$total_nonassam_after=$total->nonassam_after;$total_total=$total->total;
			}else{
				$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";
			}
	}else{
    	$building_construction_strt_dt="";$building_construction_com_dt="";$building_construction_total_area="";$building_construction_total_cost="";$building_construction_direct_area="";$building_construction_direct_cost="";
		$govt_agency_name="";$govt_agency_sn1="";$govt_agency_sn2="";$govt_agency_town="";$govt_agency_dist="";$govt_agency_pincode="";$govt_agency_mobile="";$govt_agency_email="";
		$tot_cov_area="";$ann_rent="";$build_reg_no="";$build_reg_dt="";
		$build_loc="";
		$val_period_rent_from="";$val_period_rent_to="";		
		$land_prior="";$land_additional="";$land_total="";
		$site_prior="";$site_additional="";$site_total="";
		$fact_direct_prior="";$fact_direct_additional="";$fact_direct_total="";
		$office_direct_prior="";$office_direct_additional="";$office_direct_total="";
		$plant_prior="";$plant_additional="";$plant_total="";
		$equip_prior="";$equip_additional="";$equip_total="";
		$power_prior="";$power_additional="";$power_total="";
		$electrical_prior="";$electrical_additional="";$electrical_total="";
		$utility_prior="";$utility_additional="";$utility_total="";
		$misc_prior="";$misc_additional="";$misc_total="";
		$prelim_prior="";$prelim_additional="";$prelim_total="";
		$total_f_coloumn="";$total_fixed_capital="";
		
		####Tab4####
		$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";$total_contribution="";
		
		$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";
		$term_prior="";$term_additional="";$term_tot="";
		$wc_prior="";$wc_additional="";$wc_tot="";
		$tl_prior="";$tl_additional="";$tl_tot="";
		$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";
		$repayment_prior="";$repayment_additional="";$repayment_tot="";
		$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";
		$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
		$quant_prior="";$quant_additional="";$quant_tot="";$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";
		$elec_prior="";$elec_additional="";$elec_tot="";$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";
		$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
		$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
		$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";
		$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
		$total_expenditure_prior=""; $total_expenditure_additional=""; $total_expenditure_tot="";
		####Tab5####
		$bef_sub_expan="";$after_sub_expan="";$total_12d_prod="";
		
		####Tab6####
		$mandays_utilized="";		
		$managerial_assam_prior="";$managerial_nonassam_prior="";$managerial_assam_after="";$managerial_nonassam_after="";$managerial_total="";
		$super_assam_prior="";$super_nonassam_prior="";$super_assam_after="";$super_nonassam_after="";$super_total="";
		$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";
		$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";
		$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";
		$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";
    }
    }else{		
			$results2=$q2->fetch_assoc();
            $tot_cov_area=$results2['tot_cov_area'];$ann_rent=$results2['ann_rent'];$build_loc=$results2['build_loc'];$total_f_coloumn=$results2['total_f_coloumn'];$total_fixed_capital=$results2['total_fixed_capital'];
		
			if(!empty($results2["building_construction"])){
				$building_construction=json_decode($results2["building_construction"]);
                $building_construction_strt_dt=$building_construction->strt_dt;$building_construction_com_dt=$building_construction->comp_dt;$building_construction_total_area=$building_construction->total_area;$building_construction_total_cost=$building_construction->total_cost;$building_construction_direct_area=$building_construction->direct_area;$building_construction_direct_cost=$building_construction->direct_cost;
				
			}else{
				$building_construction_strt_dt="";$building_construction_com_dt="";$building_construction_total_area="";$building_construction_total_cost="";$building_construction_direct_area="";$building_construction_direct_cost="";
			}
			if(!empty($results2["govt_agency"])){
				$govt_agency=json_decode($results2["govt_agency"]);
				$govt_agency_name=$govt_agency->name;$govt_agency_sn1=$govt_agency->sn1;$govt_agency_sn2=$govt_agency->sn2;$govt_agency_town=$govt_agency->town;$govt_agency_dist=$govt_agency->dist;$govt_agency_pincode=$govt_agency->pincode;$govt_agency_mobile=$govt_agency->mobile;$govt_agency_email=$govt_agency->email;
			}else{
				$govt_agency_name="";$govt_agency_sn1="";$govt_agency_sn2="";$govt_agency_town="";$govt_agency_dist="";$govt_agency_pincode="";$govt_agency_mobile="";$govt_agency_email="";
			}
			if(!empty($results2["build_reg"])){
				$build_reg=json_decode($results2["build_reg"]);
				$build_reg_no=$build_reg->no;$build_reg_dt=$build_reg->dt;
			}else{
				$build_reg_no="";$build_reg_dt="";
			}
			if(!empty($results2["val_period"])){
				$val_period=json_decode($results2["val_period"]);
				$val_period_rent_from=$val_period->rent_from;$val_period_rent_to=$val_period->rent_to;
			}else{
				$val_period_rent_from="";$val_period_rent_to="";
			}
			if(!empty($results2["land"])){
				$land=json_decode($results2["land"]);
				$land_prior=$land->prior;$land_additional=$land->additional;$land_total=$land->total;
			}else{
				$land_prior="";$land_additional="";$land_total="";
			}
			if(!empty($results2["site"])){
				$site=json_decode($results2["site"]);
				$site_prior=$site->prior;$site_additional=$site->additional;$site_total=$site->total;
			}else{
				$site_prior="";$site_additional="";$site_total="";
			}
			if(!empty($results2["fact_direct"])){
				$fact_direct=json_decode($results2["fact_direct"]);
				$fact_direct_prior=$fact_direct->prior;$fact_direct_additional=$fact_direct->additional;$fact_direct_total=$fact_direct->total;
			}else{
				$fact_direct_prior="";$fact_direct_additional="";$fact_direct_total="";
			}
			if(!empty($results2["office_direct"])){
				$office_direct=json_decode($results2["office_direct"]);
				$office_direct_prior=$office_direct->prior;$office_direct_additional=$office_direct->additional;$office_direct_total=$office_direct->total;
			}else{
				$office_direct_prior="";$office_direct_additional="";$office_direct_total="";
			}
			if(!empty($results2["plant"])){
				$plant=json_decode($results2["plant"]);
				$plant_prior=$plant->prior;$plant_additional=$plant->additional;$plant_total=$plant->total;
			}else{
				$plant_prior="";$plant_additional="";$plant_total="";
			}
			if(!empty($results2["equip"])){
				$equip=json_decode($results2["equip"]);
				$equip_prior=$equip->prior;$equip_additional=$equip->additional;$equip_total=$equip->total;
			}else{
				$equip_prior="";$equip_additional="";$equip_total="";
			}
			if(!empty($results2["power"])){
				$power=json_decode($results2["power"]);
				$power_prior=$power->prior;$power_additional=$power->additional;$power_total=$power->total;
			}else{
				$power_prior="";$power_additional="";$power_total="";
			}
			if(!empty($results2["electrical"])){
				$electrical=json_decode($results2["electrical"]);
				$electrical_prior=$electrical->prior;$electrical_additional=$electrical->additional;$electrical_total=$electrical->total;
			}else{
				$electrical_prior="";$electrical_additional="";$electrical_total="";
			}
			if(!empty($results2["utility"])){
				$utility=json_decode($results2["utility"]);
				$utility_prior=$utility->prior;$utility_additional=$utility->additional;$utility_total=$utility->total;
			}else{
				$utility_prior="";$utility_additional="";$utility_total="";
			}
			if(!empty($results2["misc"])){
				$misc=json_decode($results2["misc"]);
				$misc_prior=$misc->prior;$misc_additional=$misc->additional;$misc_total=$misc->total;
			}else{
				$misc_prior="";$misc_additional="";$misc_total="";
			}
			if(!empty($results2["prelim"])){
				$prelim=json_decode($results2["prelim"]);
				$prelim_prior=$prelim->prior;$prelim_additional=$prelim->additional;$prelim_total=$prelim->total;
			}else{
				$prelim_prior="";$prelim_additional="";$prelim_total="";
			}
            
			##### PART IV #####
            
			$total_contribution=$results2['total_contribution'];
			
			if(!empty($results2["sources_f_finance"])){
				$sources_f_finance=json_decode($results2["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results2["financial_ins"])){
				$financial_ins=json_decode($results2["financial_ins"]);
				$financial_ins_prior=$financial_ins->prior;$financial_ins_additional=$financial_ins->additional;$financial_ins_tot=$financial_ins->tot;
			}else{
				$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";
			}
			if(!empty($results2["term"])){
				$term=json_decode($results2["term"]);
				$term_prior=$term->prior;$term_additional=$term->additional;$term_tot=$term->tot;
			}else{
				$term_prior="";$term_additional="";$term_tot="";
			}
			if(!empty($results2["wc"])){
				$wc=json_decode($results2["wc"]);
				$wc_prior=$wc->prior;$wc_additional=$wc->additional;$wc_tot=$wc->tot;
			}else{
				$wc_prior="";$wc_additional="";$wc_tot="";
			}
			if(!empty($results2["tl"])){
				$tl=json_decode($results2["tl"]);
				$tl_prior=$tl->prior;$tl_additional=$tl->additional;$tl_tot=$tl->tot;
			}else{
				$tl_prior="";$tl_additional="";$tl_tot="";
			}
			if(!empty($results2["roi_tl"])){
				$roi_tl=json_decode($results2["roi_tl"]);
				$roi_tl_prior=$roi_tl->prior;$roi_tl_additional=$roi_tl->additional;$roi_tl_tot=$roi_tl->tot;
			}else{
				$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";
			}
			if(!empty($results2["repayment"])){
				$repayment=json_decode($results2["repayment"]);
				$repayment_prior=$repayment->prior;$repayment_additional=$repayment->additional;$repayment_tot=$repayment->tot;
			}else{
				$repayment_prior="";$repayment_additional="";$repayment_tot="";
			}
			if(!empty($results2["tl_amt"])){
				$tl_amt=json_decode($results2["tl_amt"]);
				$tl_amt_prior=$tl_amt->prior;$tl_amt_additional=$tl_amt->additional;$tl_amt_tot=$tl_amt->tot;
			}else{
				$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";
			}
			if(!empty($results2["tl_date"])){
				$tl_date=json_decode($results2["tl_date"]);
				$tl_date_prior=$tl_date->prior;$tl_date_additional=$tl_date->additional;$tl_date_tot=$tl_date->tot;
			}else{
				$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";
			}
			if(!empty($results2["wor_cap"])){
				$wor_cap=json_decode($results2["wor_cap"]);
				$wor_cap_prior=$wor_cap->prior;$wor_cap_additional=$wor_cap->additional;$wor_cap_tot=$wor_cap->tot;
			}else{
				$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";
			}
			if(!empty($results2["wor_dat"])){
				$wor_dat=json_decode($results2["wor_dat"]);
				$wor_dat_prior=$wor_dat->prior;$wor_dat_additional=$wor_dat->additional;$wor_dat_tot=$wor_dat->tot;
			}else{
				$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
			}
			if(!empty($results2["quant"])){
				$quant=json_decode($results2["quant"]);
				$quant_prior=$quant->prior;$quant_additional=$quant->additional;$quant_tot=$quant->tot;
			}else{
				$quant_prior="";$quant_additional="";$quant_tot="";
			}
			if(!empty($results2["quant_let"])){
				$quant_let=json_decode($results2["quant_let"]);
				$quant_let_prior=$quant_let->prior;$quant_let_additional=$quant_let->additional;$quant_let_tot=$quant_let->tot;
			}else{
				$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";
			}
			if(!empty($results2["quant_dat"])){
				$quant_dat=json_decode($results2["quant_dat"]);
				$quant_dat_prior=$quant_dat->prior;$quant_dat_additional=$quant_dat->additional;$quant_dat_tot=$quant_dat->tot;
			}else{
				$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";
			}
			if(!empty($results2["elec"])){
				$elec=json_decode($results2["elec"]);
				$elec_prior=$elec->prior;$elec_additional=$elec->additional;$elec_tot=$elec->tot;
			}else{
				$elec_prior="";$elec_additional="";$elec_tot="";
			}
			if(!empty($results2["elec_dat"])){
				$elec_dat=json_decode($results2["elec_dat"]);
				$elec_dat_prior=$elec_dat->prior;$elec_dat_additional=$elec_dat->additional;$elec_dat_tot=$elec_dat->tot;
			}else{
				$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";
			}
			if(!empty($results2["ser_en"])){
				$ser_en=json_decode($results2["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results2["ser_en"])){
				$ser_en=json_decode($results2["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results2["est_amt"])){
				$est_amt=json_decode($results2["est_amt"]);
				$est_amt_prior=$est_amt->prior;$est_amt_additional=$est_amt->additional;$est_amt_tot=$est_amt->tot;
			}else{
				$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";
			}
			if(!empty($results2["est_mr"])){
				$est_mr=json_decode($results2["est_mr"]);
				$est_mr_prior=$est_mr->prior;$est_mr_additional=$est_mr->additional;$est_mr_tot=$est_mr->tot;
			}else{
				$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
			}
			if(!empty($results2["est_dat"])){
				$est_dat=json_decode($results2["est_dat"]);
				$est_dat_prior=$est_dat->prior;$est_dat_additional=$est_dat->additional;$est_dat_tot=$est_dat->tot;
			}else{
				$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";
			}
			if(!empty($results2["sub_expan"])){
				$sub_expan=json_decode($results2["sub_expan"]);
				$sub_expan_prior=$sub_expan->prior;$sub_expan_additional=$sub_expan->additional;$sub_expan_tot=$sub_expan->tot;
			}else{
				$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";
			}
			if(!empty($results2["sub_dat"])){
				$sub_dat=json_decode($results2["sub_dat"]);
				$sub_dat_prior=$sub_dat->prior;$sub_dat_additional=$sub_dat->additional;$sub_dat_tot=$sub_dat->tot;
			}else{
				$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";
			}
			if(!empty($results2["mr_subexpan"])){
				$mr_subexpan=json_decode($results2["mr_subexpan"]);
				$mr_subexpan_prior=$mr_subexpan->prior;$mr_subexpan_additional=$mr_subexpan->additional;$mr_subexpan_tot=$mr_subexpan->tot;
			}else{
				$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";
			}
			if(!empty($results2["mr_subexpan_dat"])){
				$mr_subexpan_dat=json_decode($results2["mr_subexpan_dat"]);
				$mr_subexpan_dat_prior=$mr_subexpan_dat->prior;$mr_subexpan_dat_additional=$mr_subexpan_dat->additional;$mr_subexpan_dat_tot=$mr_subexpan_dat->tot;
			}else{
				$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
			}
			if(!empty($results2["total_expenditure"])){
				$total_expenditure=json_decode($results2["total_expenditure"]);
				$total_expenditure_prior=$total_expenditure->prior;$total_expenditure_additional=$total_expenditure->additional;$total_expenditure_tot=$total_expenditure->tot;
			}else{
				$total_expenditure_prior="";$total_expenditure_additional="";$total_expenditure_tot="";
			}
            
			##### PART V #####
            
			$bef_sub_expan=$results2['bef_sub_expan'];$after_sub_expan=$results2['after_sub_expan'];$total_12d_prod=$results2['total_12d_prod'];
			
			
			##### PART VI #####
           
			$mandays_utilized=$results2['mandays_utilized'];
			if(!empty($results2["managerial"])){
				$managerial=json_decode($results2["managerial"]);
				$managerial_assam_prior=$managerial->assam_prior;$managerial_nonassam_prior=$managerial->nonassam_prior;$managerial_assam_after=$managerial->assam_after;$managerial_nonassam_after=$managerial->nonassam_after;$managerial_total=$managerial->total;
			}else{
				$managerial_assam_prior="";$managerial_nonassam_prior="";$managerial_assam_after="";$managerial_nonassam_after="";$managerial_total="";
			}
			if(!empty($results2["super"])){
				$super=json_decode($results2["super"]);
				$super_assam_prior=$super->assam_prior;$super_nonassam_prior=$super->nonassam_prior;$super_assam_after=$super->assam_after;$super_nonassam_after=$super->nonassam_after;$super_total=$super->total;
			}else{
				$super_assam_prior="";$super_nonassam_prior="";$super_assam_after="";$super_nonassam_after="";$super_total="";
			}
			if(!empty($results2["skilled"])){
				$skilled=json_decode($results2["skilled"]);
				$skilled_assam_prior=$skilled->assam_prior;$skilled_nonassam_prior=$skilled->nonassam_prior;$skilled_assam_after=$skilled->assam_after;$skilled_nonassam_after=$skilled->nonassam_after;$skilled_total=$skilled->total;
			}else{
				$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";
			}
			if(!empty($results2["semiskilled"])){
				$semiskilled=json_decode($results2["semiskilled"]);
				$semiskilled_assam_prior=$semiskilled->assam_prior;$semiskilled_nonassam_prior=$semiskilled->nonassam_prior;$semiskilled_assam_after=$semiskilled->assam_after;$semiskilled_nonassam_after=$semiskilled->nonassam_after;$semiskilled_total=$semiskilled->total;
			}else{
				$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";
			}
			if(!empty($results2["unskilled"])){
				$unskilled=json_decode($results2["unskilled"]);
				$unskilled_assam_prior=$unskilled->assam_prior;$unskilled_nonassam_prior=$unskilled->nonassam_prior;$unskilled_assam_after=$unskilled->assam_after;$unskilled_nonassam_after=$unskilled->nonassam_after;$unskilled_total=$unskilled->total;
			}else{
				$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";
			}
			if(!empty($results2["total"])){
				$total=json_decode($results2["total"]);
				$total_assam_prior=$total->assam_prior;$total_nonassam_prior=$total->nonassam_prior;$total_assam_after=$total->assam_after;$total_nonassam_after=$total->nonassam_after;$total_total=$total->total;
			}else{
				$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";
			}
            
            }
	
    
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	$tabbtn5 = "";
	$tabbtn6 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 7 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	    $tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
	    $tabbtn5 = "";
		$tabbtn6 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
		$tabbtn6 = "";
	}
	if ($showtab == 6) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "active";
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
									<li class="<?php echo $tabbtn6; ?>"><a href="#table6">PART VI</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								
								<table class="table table-bordered table-responsive ">									
									<tr>
									    <td width="25%">1. (a) (i) Name of the Industrial unit :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"></td>
										<td width="25%">(ii) PAN no of the unit :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled name="pan_no" value="<?php echo $pan_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4"> (b)  Factory address :</td>	 				
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
									</tr>
									<tr>
										<td colspan="4"> (c) Office address with telephone / mobile no ( if any) :</td> 	
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
										<td>Mobile No.<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="office_mob" value="<?php echo $office_mob; ?>" validate="onlyNumbers" maxlength="10" required></td>
									</tr>
									<tr>
										<td>E-Mail ID<span class="mandatory_field">*</span> </td>
										<td><input type="email" class="form-control" name="office_email" value="<?php echo $office_email;?>" required></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">2. (a) Constitution of the organization promoting the unit (Whether Proprietorial / partnership / Private Limited / Limited company / Cooperative Society/trust/any other legal entity ) </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Name(s) , Permanent address(es) of the Proprietor/ Partners / Directors/ Secretary / President /chairman/CEO/Trustee etc with the mention of their permanent Account No (PAN) :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table  class="table table-responsive">
										<thead>
											<tr>
												<th width="10%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%" >Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
												<th width="10%">PAN No.</th>
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
												<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="10" validate="pan_no" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name;; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->vill; ?>" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->dist; ?>" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pin; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pan; ?>" maxlength="10" validate="pan_no" ></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
									</tr>
									</table></td>
									</tr>	
									<tr>
										<td colspan="4">(c) No and date of Registration under the concerned Act (e.g Companies act, partnership act etc.) :</td>
									</tr>
									<tr>
										<td> Registration Number :</td>
										<td><input type="text" class="form-control text-uppercase"  name="act[reg_no]" value="<?php echo $act_reg_no;?>"></td>
										<td> Registration Date :</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="act[reg_date]" required="required" value="<?php if($act_reg_date!="0000-00-00" && $act_reg_date!="") echo date("d-m-Y",strtotime($act_reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>	
									<tr>
										<td>(d) Registered Head Office of the promoter organization : </td>
										<td><input type="text" class="form-control text-uppercase" name="act[reg_office]" value="<?php echo $act_reg_office;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td colspan="4">3. Details of registration of the unit : </td>
									</tr>
									<tr>
										<td colspan="4"> (a)Micro & Small Scale :</td>
									</tr>
									<tr>
										<td colspan="4">i) Provisional Registration no and date/EM part-I acknowledgement No and date :</td>
									</tr>
									<tr>
										<td>Provisional Registration no </td>
										<td><input  type="text" class="form-control text-uppercase"  name="provisional[reg_no]" min="1000" value="<?php echo $provisional_reg_no;?>"></td>
										<td>Provisional Registration date</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="provisional[reg_date]" required="required" value="<?php if($provisional_reg_date!="0000-00-00" && $provisional_reg_date!="") echo date("d-m-Y",strtotime($provisional_reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">ii) Permanent Registration no and date/EM part-II acknowledgement No and date  :</td>
									</tr>
									<tr>
										<td>Permanent Registration No.</td>
										<td><input  type="text" class="form-control text-uppercase"  name="permanent[reg_no]" min="5000" value="<?php echo $permanent_reg_no;?>"></td>
										<td>Permanent Registration date</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="permanent[reg_date]" required="required" value="<?php if($permanent_reg_date!="0000-00-00" && $permanent_reg_date!="") echo date("d-m-Y",strtotime($permanent_reg_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Medium and Large </td>
									</tr>
									<tr>
										<td colspan="4"> i) No and date of Industrial License/Letter of Intent/Industrial Entrepreneurs Memorandum (IEM) / Entrepreneurs Memorandum (EM) prior to and after commencement of commercial production/service with uptodate amendments.</td>
									</tr>
									<tr>
										<td width="25%">No.</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="indus[license_no]" value="<?php echo $indus_license_no; ?>"></td>
										<td width="25%">Date</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="indus[license_date]" required="required" value="<?php if($indus_license_date!="0000-00-00" && $indus_license_date!="") echo date("d-m-Y",strtotime($indus_license_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save6a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
									
								</table>
								</form>
								</div>
							<div  id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								
								<table class="table table-responsive ">	
								<tbody>	
									<tr>
										<td colspan="4">4. (a) Letter no and date etc acknowledging intimation given/ according approval by concerned implementing agency for substantial expansion </td>
									</tr>
									
									<tr>
										<td width="25%">Letter No:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="intimation_letter_no" value="<?php echo $intimation_letter_no; ?>"></td>
										<td width="25%">Date:</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="intimation_date" required="required" value="<?php if($intimation_date!="0000-00-00" && $intimation_date!="") echo date("d-m-Y",strtotime($intimation_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="2"> b) A note in brief on substantial expansion undertaken with special reference to its product/ service, process, existing capacity etc. </td>
										<td><textarea class="form-control text-uppercase" name="note_substantial" maxlength="255" ><?php echo $note_substantial; ?></textarea></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4"> c) Name and address of the consultant who prepared the Project Feasibility Report: </td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[name]" value="<?php echo $consultant_name;?>" validate="letters"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>									
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn1]" value="<?php echo $consultant_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn2]" value="<?php echo $consultant_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[vill]" value="<?php echo $consultant_vill;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="consultant[dist]" value="<?php echo $consultant_dist;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[pincode]" value="<?php echo $consultant_pincode;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[mobile]" value="<?php echo $consultant_mobile;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="consultant[email]" value="<?php echo $consultant_email;?>"></td>
										<td></td>
										<td></td>
									</tr>			
									<tr>
										<td colspan="4"> d) EC No and date obtained earlier, if any </td>
									</tr>
									<tr>
										<td width="25%">EC No </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ec_no" value="<?php echo $ec_no;?>"></td>
										<td width="25%">Date</td>
										<td width="25%"><input type="text" class="dobindia form-control" name="ec_date" required="required" value="<?php if($ec_date!="0000-00-00" && $ec_date!="") echo date("d-m-Y",strtotime($ec_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>	
									<tr>
										<td colspan="4"> 5. Details of land including additional investment etc made  </td>
									</tr>			
									<tr>
										<td colspan="2">a) Whether the land is owned/ leased hold from private party/ slotted by the Government/ Government agency<span class="mandatory_field">*</span>  </td>
										<td width="25%">
											<select name="land_owned" class="form-control text-uppercase" required="required">
												<option value="">Please Select</option>
												<option <?php if($land_owned=="O") echo "selected"; ?> value="O">Owned</option>
												<option <?php if($land_owned=="L") echo "selected"; ?> value="L">Leased hold from private party</option>
												<option <?php if($land_owned=="S") echo "selected"; ?> value="S">Slotted by the Government</option>
												<option <?php if($land_owned=="G") echo "selected"; ?> value="G">Government agency</option>
											</select>																				
										</td>
										<td></td>										
									</tr>			
									<tr>
										<td >b. (i) Total Area (sq mtr) : </td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="total_area" value="<?php echo $total_area;?>"></td>
										<td >(ii) Area under use for the project : </td>
										<td><input type="text" class="form-control text-uppercase" name="area_under_use" validate="decimal" value="<?php echo $area_under_use;?>"></td>
									</tr>			
									<tr>
										<td>c). Location : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="area_loc" value="<?php echo $area_loc;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">d). Dag no, Patta no, Revenue village and Mauza </td>
									</tr>
									<tr>
										<td width="25%">Dag no</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_detail[dag_no]" value="<?php echo $land_detail_dag_no;?>"></td>
										<td width="25%">Patta no</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_detail[patta_no]" value="<?php echo $land_detail_patta_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">Revenue village</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_detail[revenue_vill]" value="<?php echo $land_detail_revenue_vill;?>"></td>
										<td width="25%">Mauza</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_detail[mauza]" value="<?php echo $land_detail_mauza;?>"></td>
									</tr>
									<tr>
										<td colspan="4">e) Name & address of the present owner of land/ Lessor/ Govt agency allotting land </td>
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_owner[name]" value="<?php echo $land_owner_name;?>" validate="letters"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_owner[sn1]" value="<?php echo $land_owner_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="land_owner[sn2]" value="<?php echo $land_owner_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="land_owner[dist]" value="<?php echo $land_owner_vill;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="land_owner[vill]" value="<?php echo $land_owner_dist;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="land_owner[pincode]" validate="pincode" maxlength="6" value="<?php echo $land_owner_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="land_owner[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $land_owner_mobile;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="land_owner[email]" value="<?php echo $land_owner_email;?>"></td>
										<td></td>
										<td></td>
									</tr>		
									<tr>
										<td colspan="4">f) No and date of registration of the purchase deed/ lease deed and name, designation & address of the registering authority </td>
									</tr>
									<tr>
										<td>No</td>
										<td><input type="text" class="form-control" name="no_pur_deed" value="<?php echo $no_pur_deed;?>"></td>
										<td>Date</td>
										<td><input type="text" class="dobindia form-control" name="dor_pur_deed" required="required" value="<?php if($dor_pur_deed!="0000-00-00" && $dor_pur_deed!="") echo date("d-m-Y",strtotime($dor_pur_deed)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[name]" value="<?php echo $auth_name;?>" validate="letters"></td>
										<td width="25%">Designation</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[desig]" value="<?php echo $auth_desig;?>"></td>
									</tr>
									<tr>
										<td colspan="4">Address of the registering authority</td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[sn1]" value="<?php echo $auth_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[sn2]" value="<?php echo $auth_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="auth[vill]" value="<?php echo $auth_vill;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="auth[dist]" value="<?php echo $auth_dist;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="auth[pincode]" value="<?php echo $auth_pincode;?>" maxlength="6" validate="pincode"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="auth[mobile]" value="<?php echo $auth_mobile;?>" maxlength="10" validate="mobileNumber"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="auth[email]" value="<?php echo $auth_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">g) Purchase price, registration fee and stamp duty/annual lease rent payable/one time premium paid </td>
									</tr>
									<tr>
										<td width="25%">Purchase price</td>
										<td width="25%"><input type="text" class="form-control" name="pur_price" value="<?php echo $pur_price;?>" validate="onlyNumbers"></td>
										<td width="25%">Registration fee</td>
										<td width="25%"><input type="text" class="form-control" name="pur_reg_fee" value="<?php echo $pur_reg_fee;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td colspan="2">Stamp duty/annual lease rent payable/one time premium paid </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="stamp_duty" validate="onlyNumbers" value="<?php echo $stamp_duty;?>"></td>
									</tr>
									<tr>
										<td colspan="3">h) The date of taking over possession of land :</td>
										<td width="25%"><input type="text" class="dobindia form-control" name="date_possesion" value="<?php if($date_possesion!="0000-00-00" && $date_possesion!="") echo date("d-m-Y",strtotime($date_possesion)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td>i) Duration of lease  :</td>
										<td><input type="text" placeholder="From" class="dobindia form-control" name="lease_from" value="<?php if($lease_from!="0000-00-00" && $lease_from!="") echo date("d-m-Y",strtotime($lease_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>										
										<td><input type="text" placeholder="To" class="dobindia form-control" name="lease_to" value="<?php if($lease_to!="0000-00-00" && $lease_to!="") echo date("d-m-Y",strtotime($lease_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</tbody>
								</table>
								</form>
							</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">6. Details of building</td>
									</tr>
									<tr>
										<td colspan="4">a) If the building has been constructed</td>
									</tr>
									<tr>
										<td width="25%">(i) Date of starting of the civil construction : </td>
										<td width="25%"><input type="text" class="dobindia form-control" name="building_construction[strt_dt]" value="<?php if($building_construction_strt_dt!="0000-00-00" && $building_construction_strt_dt!="") echo date("d-m-Y",strtotime($building_construction_strt_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td width="25%">(ii) Date of completion of the civil construction works :</td>
										<td width="25%"><input type="text" class="dobindia form-control" name="building_construction[comp_dt]" value="<?php if($building_construction_com_dt!="0000-00-00" && $building_construction_com_dt!="") echo date("d-m-Y",strtotime($building_construction_com_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">(iii) Total area under construction : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[total_area]" validate="decimal" value="<?php echo $building_construction_total_area;?>"></td>
										<td width="25%">(iv) Total cost of construction, site development etc :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[total_cost]" validate="onlyNumbers" value="<?php echo $building_construction_total_cost;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(v) Cost of construction and area of the building connected directly to manufacturing process/service rendered : </td>
									</tr>
									<tr>
										<td>Cost of construction</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[direct_cost]"  value="<?php echo $building_construction_direct_cost;?>" validate="onlyNumbers"> </td>
										<td>Area of the building</td>
										<td><input type="text" class="form-control text-uppercase" name="building_construction[direct_area]" value="<?php echo $building_construction_direct_area;?>" validate="decimal"></td>
									</tr>
									<tr>
										<td colspan="4">b) If the building has been allotted by the Government agency/taken on rent from private party:</td>
									</tr>
									<tr>
										<td colspan="4">(i) Name & address of the Govt agency / land lord</td>
									</tr>
									<tr>
										<td>Name</td>
										<td width="25%"><input type="text" class="text-uppercase form-control" name="govt_agency[name]" value="<?php echo $govt_agency_name;?>" validate="letters"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="govt_agency[sn1]" value="<?php echo $govt_agency_sn1;?>"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="govt_agency[sn2]" value="<?php echo $govt_agency_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="govt_agency[town]" value="<?php echo $govt_agency_town;?>"></td>
											<td>District</td>
                                            <td><input type="text" class="form-control text-uppercase" name="govt_agency[dist]" value="<?php echo $govt_agency_dist;?>"></td>
											
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="govt_agency[pincode]" value="<?php echo $govt_agency_pincode;?>" maxlength="6" validate="pincode"></td>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" name="govt_agency[mobile]" value="<?php echo $govt_agency_mobile;?>" maxlength="10" validate="mobileNumber"></td>
										</tr>	
										<tr>
											<td>E-Mail ID</td>
											<td><input type="email" class="form-control" name="govt_agency[email]" value="<?php echo $govt_agency_email;?>"></td>
											<td></td>
											<td></td>
										</tr>								
									<tr>
										<td width="25%">(ii) Total covered area : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tot_cov_area" value="<?php echo $tot_cov_area;?>" validate="onlyNumbers"></td>
										<td width="25%">(iii) Annual rent :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ann_rent" value="<?php echo $ann_rent;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td colspan="4">(iv) No & date of registration of the rent agreement/lease deed and address of the registering authority.</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="build_reg[no]" value="<?php echo $build_reg_no;?>"></td>
										<td>Registration Date :</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="build_reg[dt]" value="<?php if($build_reg_dt!="0000-00-00" && $build_reg_dt!="") echo date("d-m-Y",strtotime($build_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td>(v) Location :</td>
										<td><input type="text" class="form-control text-uppercase" name="build_loc" value="<?php echo $build_loc;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(vi) Period of validity of rent agreement/lease deed:</td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="val_period[rent_from]" value="<?php if($val_period_rent_from!="0000-00-00" && $val_period_rent_from!="") echo date("d-m-Y",strtotime($val_period_rent_from)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>To</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="val_period[rent_to]" value="<?php if($val_period_rent_to!="0000-00-00" && $val_period_rent_to!="") echo date("d-m-Y",strtotime($val_period_rent_to)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">7. Details of Capital Investment (gross value in Rupees) :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive table-bordered">
										<thead>
											<tr>
												<th class="text-center">Sl No.</th>
												<th class="text-center">Item of Fixed Assets </th>
												<th class="text-center">Prior to undertaking substantial expansion</th>
												<th class="text-center">Additional investment made for substantial expansion </th>
												<th class="text-center">Total investment after completion of substantial expansion </th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>a.</td>
												<td>Land </td>
												<td><input type="text" class="form-control text-uppercase" name="land[prior]" value="<?php echo $land_prior?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="land[additional]" value="<?php echo $land_additional?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="land[total]" value="<?php echo $land_total?>"validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>b.</td>
												<td>Site Development </td>
												<td><input type="text" class="form-control text-uppercase" name="site[prior]" value="<?php echo $site_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="site[additional]" value="<?php echo $site_additional;?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="site[total]" value="<?php echo $site_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td rowspan="3">c</td>
												<td colspan="4">Building</td>
											</tr>
											<tr>
												<td>i)  Factory/Institutional building and other civil construction works directly connected to process of manufacture/service rendered </td>
												<td><input type="text" class="form-control text-uppercase" name="fact_direct[prior]" value="<?php echo $fact_direct_prior;?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="fact_direct[additional]" value="<?php echo $fact_direct_additional;?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="fact_direct[total]" value="<?php echo $fact_direct_total;?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>ii) Office building, labour quarter etc no directly connected to process of manufacture/ service rendered (ineligible building) </td>
												<td><input type="text" class="form-control text-uppercase" name="office_direct[prior]" value="<?php echo $office_direct_prior;?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="office_direct[additional]" value="<?php echo $office_direct_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="office_direct[total]" value="<?php echo $office_direct_total;?>" validate="onlyNumbers"></td>
											</tr>
											
											
											<tr>
												<td>d.</td>
												<td>Plant and Machinery </td>
												<td><input type="text" class="form-control text-uppercase" name="plant[prior]" value="<?php echo $plant_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="plant[additional]" value="<?php echo $plant_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="plant[total]" value="<?php echo $plant_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>e.</td>
												<td>Equipment, accessories, components & fittings etc </td>
												<td><input type="text" class="form-control text-uppercase" name="equip[prior]" value="<?php echo $equip_prior;?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="equip[additional]" value="<?php echo $equip_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="equip[total]" value="<?php echo $equip_total;?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>f.</td>
												<td>Drawal of Power line </td>
												<td><input type="text" class="form-control text-uppercase" name="power[prior]" value="<?php echo $power_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="power[additional]" value="<?php echo $power_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="power[total]" value="<?php echo $power_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>g.</td>
												<td>Electrical Installation other than drawal of power line </td>
												<td><input type="text" class="form-control text-uppercase" name="electrical[prior]" value="<?php echo $electrical_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="electrical[additional]" value="<?php echo $electrical_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="electrical[total]" value="<?php echo $electrical_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>h.</td>
												<td>Utility installation other than electrical power </td>
												<td><input type="text" class="form-control text-uppercase" name="utility[prior]" value="<?php echo $utility_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="utility[additional]" value="<?php echo $utility_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="utility[total]" value="<?php echo $utility_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>i.</td>
												<td>Miscellaneous fixed assets ( in details) </td>
												<td><input type="text" class="form-control text-uppercase" name="misc[prior]" value="<?php echo $misc_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="misc[additional]" value="<?php echo $misc_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="misc[total]" value="<?php echo $misc_total; ?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td>j.</td>
												<td>Preliminary and preoperative expenses capitalized </td>
												<td><input type="text" class="form-control text-uppercase" name="prelim[prior]" value="<?php echo $prelim_prior; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="prelim[additional]" value="<?php echo $prelim_additional; ?>" validate="onlyNumbers"></td>
												<td><input type="text" class="form-control text-uppercase" name="prelim[total]" value="<?php echo $prelim_total; ?>" validate="onlyNumbers"></td>
											</tr>
										</tbody>
									  </table>
									</tr>
									<tr>
										<td>B. Total of the column 4 as percentage of the total column 3:</td>
										<td><input type="text" class="form-control text-uppercase" name="total_f_coloumn" value="<?php echo $total_f_coloumn; ?>" ></td>
										<td>C. Total fixed capital investment (gross value) as per last EC:</td>
										<td><input type="text" class=" form-control text-uppercase" name="total_fixed_capital" value="<?php echo $total_fixed_capital; ?>"></td>
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
									<td colspan="4">8. Source of Finance </td>
								</tr>	
								<tr>
									<td width="25%">a. Promoters contribution:</td>
									<td width="25%"><input type="text" class="form-control text-uppercase addFinanceTotal" name="sources_f_finance[a]" value="<?php echo $sources_f_finance_a; ?>" validate="onlyNumbers"/></td>
									<td width="25%">b. Govt contribution as seed money/share capital etc :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase addFinanceTotal" name="sources_f_finance[b]" value="<?php echo$sources_f_finance_b; ?>" validate="onlyNumbers"/></td>
								</tr>
								<tr>
									<td>c. Borrowing from Bank/Financial Institution :</td>									
									<td><input type="text" class="form-control text-uppercase addFinanceTotal" name="sources_f_finance[c]" value="<?php echo $sources_f_finance_c; ?>" validate="onlyNumbers"/></td>
									<td>d. Un secured loan/private finance :</td>
									<td><input type="text" class="form-control text-uppercase addFinanceTotal" name="sources_f_finance[d]" value="<?php echo $sources_f_finance_d; ?>" validate="onlyNumbers"/></td>
								</tr>
								<tr>
									<td >e. Any other sources :</td>
									<td><input type="text" class="form-control text-uppercase addFinanceTotal" name="sources_f_finance[e]" value="<?php echo $sources_f_finance_e;?>" validate="onlyNumbers"/></td>
								</tr>
								<tr>
									<td>Total :</td>
									<td><input type="text" class="form-control text-uppercase" id="finance_total" name="total_contribution" value="<?php echo $total_contribution;?>" validate="onlyNumbers"/></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">9. Details of financial assistance received from Bank/ Financial Institution/ Govt organization etc. </td>
								</tr>
								<tr>
									<td colspan="4">
									<table class="table table-bordered table-responsive">
										<thead>
										<tr>
											<th class="text-center">Sl no.</th>
											<th class="text-center">Particulars</th>
											<th class="text-center">Prior to undertaking substantial expansion </th>
											<th class="text-center">Additional for substantial expansion</th>
											<th class="text-center">Total after completion of substantial expansion</th>
										</tr>
										</thead>
										<tr>
											<td>a</td>
											<td>Name(s) of Financial Institution(s)</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_ins[prior]" value="<?php echo $financial_ins_prior; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="financial_ins[additional]" value="<?php echo $financial_ins_additional; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="financial_ins[tot]" value="<?php echo $financial_ins_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="3">b</td>
											<td colspan="4">Amount sanctioned as </td>
										</tr>
										<tr>
											<td>i)   Term Loan ( in rupees)  </td>
											<td><input type="text" class="form-control text-uppercase" name="term[prior]" value="<?php echo $term_prior; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="term[additional]" value="<?php echo $term_additional; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="term[tot]" value="<?php echo  $term_tot; ?>"></td>
										</tr>
										<tr>
											<td>ii)  WC/OD/CC/OCC/Margin money contribution etc (in rupees) </td>
											<td><input type="text" class="form-control text-uppercase" name="wc[prior]" value="<?php echo $wc_prior;?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="wc[additional]" value="<?php echo $wc_additional;?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="wc[tot]" value="<?php echo   $wc_tot;?>"></td>
										</tr>
										<tr>
											<td rowspan="3">c</td>
											<td >i)  Term Loan disbursed till date of application </td>
											<td><input type="text" class="form-control text-uppercase" name="tl[prior]" value="<?php echo $tl_prior;?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="tl[additional]" value="<?php echo $tl_additional; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="tl[tot]" value="<?php echo $tl_tot; ?>"></td>
										</tr>
										<tr>
											<td>ii)  Rate of Interest on TL </td>
											<td><input type="text" class="form-control text-uppercase" name="roi_tl[prior]" value="<?php echo $roi_tl_prior;?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="roi_tl[additional]" value="<?php echo $roi_tl_additional;?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="roi_tl[tot]" value="<?php echo $roi_tl_tot; ?>"></td>
										</tr>
										<tr>
											<td>iii) Schedule of Repayment of TL ( showing principal amount, Interest etc separately ) </td>
											<td><input type="text" class="form-control text-uppercase" name="repayment[prior]" value="<?php echo $repayment_prior; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="repayment[additional]" value="<?php echo $repayment_additional; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="repayment[tot]" value="<?php echo $repayment_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="5">d</td>
											<td colspan="4">Letter no & date of sanction of loan as </td>
										</tr>
										<tr>
											<td>i)  Term Loan </td>
											<td><input type="text" class="form-control text-uppercase" name="tl_amt[prior]" value="<?php echo $tl_amt_prior; ?>" placeholder="Amount" ></td>
											<td><input type="text" class="form-control text-uppercase" name="tl_amt[additional]" value="<?php echo $tl_amt_additional;?>" placeholder="Amount"></td>
											<td><input type="text" class="form-control text-uppercase" name="tl_amt[tot]" value="<?php echo $tl_amt_tot; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="tl_date[prior]" value="<?php if($tl_date_prior!="0000-00-00" && $tl_date_prior!="") echo date("d-m-Y",strtotime($tl_date_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="tl_date[additional]" value="<?php if($tl_date_additional!="0000-00-00" && $tl_date_additional!="") echo date("d-m-Y",strtotime($tl_date_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="tl_date[tot]" value="<?php if($tl_date_tot!="0000-00-00" && $tl_date_tot!="") echo date("d-m-Y",strtotime($tl_date_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td>ii) Working Capital etc </td>
											<td><input type="text" class="form-control text-uppercase" name="wor_cap[prior]" value="<?php echo $wor_cap_prior; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form-control text-uppercase" name="wor_cap[additional]" value="<?php echo $wor_cap_additional; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form-control text-uppercase" name="wor_cap[tot]" value="<?php echo $wor_cap_tot; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="wor_dat[prior]" value="<?php if($wor_dat_prior!="0000-00-00" && $wor_dat_prior!="") echo date("d-m-Y",strtotime($wor_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="wor_dat[additional]" value="<?php if($wor_dat_additional!="0000-00-00" && $wor_dat_additional!="") echo date("d-m-Y",strtotime($wor_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" placeholder="Date" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="wor_dat[tot]" value="<?php if($wor_dat_tot!="0000-00-00" && $wor_dat_tot!="") echo date("d-m-Y",strtotime($wor_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" placeholder="Date" readonly="readonly"></td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">10. Details of Power connection </td>
								</tr>
								<tr>	
									<td colspan="4">
									<table class="table table-bordered table-responsive">
									<thead>
									<tr>
										<th> Sl no.</th>
										<th>Particulars</th>
										<th>Prior to undertaking substantial expansion </th>
										<th>Additional for substantial expansion</th>
										<th>Total after completion of substantial expansion</th>
									</tr>
									</thead>
										<tr>
											<td rowspan="3">a</td>
											<td> Quantum, letter no and date of sanction </td>
											<td><input type="text" class="form-control text-uppercase" name="quant[prior]" value="<?php echo $quant_prior; ?>"  placeholder="Quantum" ></td>
											<td><input type="text" class="form-control text-uppercase" name="quant[additional]" value="<?php echo $quant_additional; ?>" placeholder="Quantum"></td>
											<td><input type="text" class="form-control text-uppercase" name="quant[tot]" value="<?php echo $quant_tot; ?>" placeholder="Quantum"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="form-control text-uppercase" name="quant_let[prior]" value="<?php echo $quant_let_prior; ?>" placeholder="Letter No"></td>
											<td><input type="text" class="form-control text-uppercase" name="quant_let[additional]" value="<?php echo $quant_let_additional; ?>" placeholder="Letter No"></td>
											<td><input type="text" class="form-control text-uppercase" name="quant_let[tot]" value="<?php echo $quant_let_tot; ?>" placeholder="Letter No"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="quant_dat[prior]" value="<?php if($quant_dat_prior!="0000-00-00" && $quant_dat_prior!="") echo date("d-m-Y",strtotime($quant_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="quant_dat[additional]" value="<?php if($quant_dat_additional!="0000-00-00" && $quant_dat_additional!="") echo date("d-m-Y",strtotime($quant_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="quant_dat[tot]" value="<?php if($quant_dat_tot!="0000-00-00" && $quant_dat_tot!="") echo date("d-m-Y",strtotime($quant_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td rowspan="2">b</td>
											<td> Connected electrical load and date of connection of power </td>
											<td><input type="text" class="form-control text-uppercase" name="elec[prior]" value="<?php echo $elec_prior; ?>" placeholder="Load" ></td>
											<td><input type="text" class="form-control text-uppercase" name="elec[additional]" value="<?php echo $elec_additional; ?>" placeholder="Load"></td>
											<td><input type="text" class="form-control text-uppercase" name="elec[tot]" value="<?php echo $elec_tot; ?>" placeholder="Load"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="elec_dat[prior]" value="<?php if($elec_dat_prior!="0000-00-00" && $elec_dat_prior!="") echo date("d-m-Y",strtotime($elec_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="elec_dat[additional]" value="<?php if($elec_dat_additional!="0000-00-00" && $elec_dat_additional!="") echo date("d-m-Y",strtotime($elec_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="elec_dat[tot]" value="<?php if($elec_dat_tot!="0000-00-00" && $elec_dat_tot!="") echo date("d-m-Y",strtotime($elec_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td>c</td>
											<td>Serial no of energy meter(s) connected </td>
											<td><input type="text" class="form-control text-uppercase" name="ser_en[prior]" value="<?php echo $ser_en_prior; ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="ser_en[additional]" value="<?php echo $ser_en_additional;  ?>"></td>
											<td><input type="text" class="form-control text-uppercase" name="ser_en[tot]" value="<?php echo $ser_en_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="3">d</td>
											<td>Estimated amount of ASEB for power connection with MR no and date of payment </td>
											<td><input type="text" class="form-control text-uppercase" name="est_amt[prior]" value="<?php echo $est_amt_prior; ?>" placeholder="Amount" ></td>
											<td><input type="text" class="form-control text-uppercase" name="est_amt[additional]" value="<?php echo $est_amt_additional; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form-control text-uppercase" name="est_amt[tot]" value="<?php echo $est_amt_tot; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="form-control text-uppercase" name="est_mr[prior]" value="<?php echo $est_mr_prior;?>" placeholder="Mr No"></td>
											<td><input type="text" class="form-control text-uppercase" name="est_mr[additional]" value="<?php echo $est_mr_additional; ?>" placeholder="Mr No"></td>
											<td><input type="text" class="form-control text-uppercase" name="est_mr[tot]" value="<?php echo $est_mr_tot; ?>" placeholder="Mr No"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="est_dat[prior]" value="<?php if($est_dat_prior!="0000-00-00" && $est_dat_prior!="") echo date("d-m-Y",strtotime($est_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="est_dat[additional]" value="<?php if($est_dat_additional!="0000-00-00" && $est_dat_additional!="") echo date("d-m-Y",strtotime($est_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="est_dat[tot]" value="<?php if($est_dat_tot!="0000-00-00" && $est_dat_tot!="") echo date("d-m-Y",strtotime($est_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td rowspan="5">e</td>
											<td colspan="3">First ASEB Bill </td>
										</tr>
										<tr>
											<td>i)  Bill no and date after substantial expansion </td>
											<td><input type="text" class="form-control text-uppercase" name="sub_expan[prior]" value="<?php echo $sub_expan_prior; ?>" placeholder="Bill No." ></td>
											<td><input type="text" class="form-control text-uppercase" name="sub_expan[additional]" value="<?php echo $sub_expan_additional; ?>" placeholder="Bill No."></td>
											<td><input type="text" class="form-control text-uppercase" name="sub_expan[tot]" value="<?php echo $sub_expan_tot; ?>" placeholder="Bill No."></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="sub_dat[prior]" value="<?php if($sub_dat_prior!="0000-00-00" && $sub_dat_prior!="") echo date("d-m-Y",strtotime($sub_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="sub_dat[additional]" value="<?php if($sub_dat_additional!="0000-00-00" && $sub_dat_additional!="") echo date("d-m-Y",strtotime($sub_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="sub_dat[tot]" value="<?php if($sub_dat_tot!="0000-00-00" && $sub_dat_tot!="") echo date("d-m-Y",strtotime($sub_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td>ii) MR no and date of payment after substantial expansion </td>
											<td><input type="text" class="form-control text-uppercase" name="mr_subexpan[prior]" value="<?php echo $mr_subexpan_prior; ?>" placeholder="Mr No."></td>
											<td><input type="text" class="form-control text-uppercase" name="mr_subexpan[additional]" value="<?php echo $mr_subexpan_additional;?>" placeholder="Mr No."></td>
											<td><input type="text" class="form-control text-uppercase" name="mr_subexpan[tot]" value="<?php echo $mr_subexpan_tot;?>" placeholder="Mr No."></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="mr_subexpan_dat[prior]" value="<?php if($mr_subexpan_dat_prior!="0000-00-00" && $mr_subexpan_dat_prior!="") echo date("d-m-Y",strtotime($mr_subexpan_dat_prior)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="mr_subexpan_dat[additional]" value="<?php if($mr_subexpan_dat_additional!="0000-00-00" && $mr_subexpan_dat_additional!="") echo date("d-m-Y",strtotime($mr_subexpan_dat_additional)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="mr_subexpan_dat[tot]" value="<?php if($mr_subexpan_dat_tot!="0000-00-00" && $mr_subexpan_dat_tot!="") echo date("d-m-Y",strtotime($mr_subexpan_dat_tot)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td>f. </td>
											<td>Total expenditure incurred for obtaining additional power connection ( excluding load security deposited to ASEB) </td>
											<td><input type="text" class="form-control text-uppercase" name="total_expenditure[prior]" value="<?php echo $total_expenditure_prior; ?>" ></td>
											<td><input type="text" class="form-control text-uppercase" name="total_expenditure[additional]" value="<?php echo $total_expenditure_additional; ?>" ></td>
											<td><input type="text" class="form-control text-uppercase" name="total_expenditure[tot]" value="<?php echo $total_expenditure_tot; ?>" ></td>
										</tr> 
									</table>
									</td>
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
									<td colspan="4">11. Date of commencement of commercial production / service rendered</td>
								</tr>
								<tr>
									<td width="25%">a) Prior to undertake substantial expansion</td>
									<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="bef_sub_expan" value="<?php if($bef_sub_expan!="0000-00-00" && $bef_sub_expan!="") echo date("d-m-Y",strtotime($bef_sub_expan)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									<td width="25%">b) After completion of substantial expansion</td>
									<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="after_sub_expan" value="<?php if($after_sub_expan!="0000-00-00" && $after_sub_expan!="") echo date("d-m-Y",strtotime($after_sub_expan)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
								</tr>
								<tr>
									<td colspan="4">12.(a) Details of the production/service rendered</td>
								</tr>
								<tr>
									<td colspan="4">i) Prior to substantial expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl no.</th>
											<th rowspan="2" width="15%">Items</th>
											<th colspan="2" width="30%">Annual Installed Capacity</th>
											<th colspan="2" width="30%">Actual performance during the last accounting year</th>
											<th rowspan="2" width="20%">Percentage of utilization of installed capacity(5)&divide;(3)&nbsp;</th>
										</tr>
										<tr>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>											
											<td><input type="text" value="<?php echo $row_1["items"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_1["annual_quantity"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_1["annual_rupees"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["actual_quantity"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["actual_rupees"]; ?>" validate="onlyNumbers" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["percentage"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>" size="20"></td>	
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
											<td><input type="text" id="txtB1" size="20"  class="form-control text-uppercase" name="txtB1"></td>
											<td><input type="text"  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>					
											<td><input type="text" id="txtD1" size="20" class="form-control text-uppercase"  name="txtD1" validate="onlyNumbers"></td>
											<td><input type="text" id="txtE1" size="20" class="form-control text-uppercase"  name="txtE1"></td>
											<td><input type="text" id="txtF1" size="20" class="form-control text-uppercase"  name="txtF1" validate="onlyNumbers"></td>
											<td><input type="text" id="txtG1" size="20" class="form-control text-uppercase"  name="txtG1"></td>
										</tr>
										<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
									</td>
								</tr>
								<tr>
								<tr>	
									<td colspan="4">ii)After substantial expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl no.</th>
											<th rowspan="2" width="15%">Items</th>
											<th colspan="2" width="30%">Annual Installed Capacity</th>
											<th colspan="2" width="30%">Actual performance during the last accounting year</th>
											<th rowspan="2" width="20%">Percentage of utilization of installed capacity(5)&divide;(3)</th>
										</tr>
										<tr>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num2 = $part2->num_rows;
										if($num2>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>											
											<td><input type="text" value="<?php echo $row_2["items"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_2["annual_quantity"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_2["annual_rupees"]; ?>" validate="onlyNumbers" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["actual_quantity"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["actual_rupees"]; ?>" validate="onlyNumbers" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["percentage"]; ?>"  id="textG<?php echo $count;?>" class="form-control text-uppercase" name="textG<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input type="text" id="textB1" size="20"   class="form-control text-uppercase" name="textB1"></td>
										<td><input type="text"  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>					
										<td><input type="text" id="textD1" size="20" class="form-control text-uppercase"  name="textD1" validate="onlyNumbers"></td>
										<td><input type="text" id="textE1" size="20" class="form-control text-uppercase"  name="textE1"></td>
										<td><input type="text" id="textF1" size="20" class="form-control text-uppercase"  name="textF1" validate="onlyNumbers"></td>
										<td><input type="text" id="textG1" size="20" class="form-control text-uppercase"  name="textG1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">(b) Actual average production/service rendered during last three years preceding the date of completion of substantial expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table  name="objectTable3" id="objectTable3" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th width="5%">Sl no.</th>
											<th width="20%">Items</th>
											<th width="25%">Physical quantity of finished product/service</th>
											<th width="30%">Cost in rupees per unit of the finished product/service</th>
											<th width="20%">Total value in rupees of the finished product/service as per cost</th>
										</tr>
										</thead>
										<?php
										$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
										$num3 = $part3->num_rows;
										if($num3>0){
										  $count=1;
										  while($row_3=$part3->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
											<td><input type="text" value="<?php echo $row_3["items"]; ?>" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_3["physical_qty"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_3["cost_per_unit"]; ?>"  id="txxtD<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" name="txxtD<?php echo $count;?>" size="20"></td>						
											<td><input type="text" value="<?php echo $row_3["total_value"]; ?>"  id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="20"></td>						
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
										<td><input type="text" id="txxtB1" size="20" class="form-control text-uppercase" name="txxtB1"></td>
										<td><input type="text" id="txxtC1" size="20" class="form-control text-uppercase"  name="txxtC1"></td>					
										<td><input type="text" id="txxtD1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txxtD1"></td>
										<td><input type="text" id="txxtE1" size="20" class="form-control text-uppercase"  name="txxtE1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction3()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore3()" value="">Add More</button>
										<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">(c) Actual production/service rendered since date of completion of substantial expansion till date of submission of application</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable4" id="objectTable4" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th width="5%">Sl no.</th>
											<th width="15%">Items</th>
											<th width="30%">Physical quantity of finished product/service</th>
											<th width="30%">Cost in rupees per unit of the finished product/service</th>
											<th width="20%">Total value in rupees of the finished product/service as per cost</th>
										</tr>
										</thead>
										<?php
										$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
										$num4 = $part4->num_rows;
										if($num4>0){
										  $count=1;
										  while($row_4=$part4->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
											<td><input type="text" value="<?php echo $row_4["items"]; ?>" id="txttB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_4["physical_qty"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_4["cost_per_unit"]; ?>" validate="onlyNumbers" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="20"></td>				
											<td><input type="text" value="<?php echo $row_4["total_value"]; ?>" validate="onlyNumbers" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="20"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
										<td><input type="text" id="txttB1" size="20" class="form-control text-uppercase" name="txttB1"></td>
										<td><input type="text" id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>					
										<td><input type="text" id="txttD1" size="20" class="form-control text-uppercase"  name="txttD1" validate="onlyNumbers"></td>
										<td><input type="text" id="txttE1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txttE1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
										<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="2">d) Total production/service rendered expressed in percentage viz: (total of Col 20)- (total of Col 16) divided by (total of col 20) and multiplied by 100.</td>
									<td><input type="text" class="form-control text-uppercase" name="total_12d_prod" value="<?php echo $total_12d_prod; ?>"></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">13. Raw Materials/ Consumables</td>
								</tr>
								<tr>
									<td colspan="4">a) Utilisation of Materials</td>
								</tr>
								<tr>
									<td colspan="4">i) Prior to substantial expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable5" id="objectTable5" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2"width="5%">Sl no.</th>
											<th rowspan="2"width="15%">Items</th>
											<th colspan="2" width="30%">Actual Requirements</th>
											<th colspan="2" width="30%">Utilisation during the last accounting year</th>
											<th rowspan="2" width="20%">Remarks</th>
										</tr>
										<tr>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
										$num5 = $part5->num_rows;
										if($num5>0){
										$count=1;
										while($row_5=$part5->fetch_array()){	?>
										<tr>
											<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_5["items"]; ?>" id="ttxtB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="ttxtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_5["actual_quantity"]; ?>"  id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" name="ttxtC<?php echo $count;?>" size="20"></td>		
											<td><input value="<?php echo $row_5["actual_rupees"]; ?>"  id="ttxtD<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" name="ttxtD<?php echo $count;?>" size="20"></td>		
											<td><input value="<?php echo $row_5["utilise_quantity"]; ?>"  id="ttxtE<?php echo $count;?>" class="form-control text-uppercase" name="ttxtE<?php echo $count;?>" size="20"></td>		
											<td><input value="<?php echo $row_5["utilise_rupees"]; ?>"  id="ttxtF<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" name="ttxtF<?php echo $count;?>" size="20"></td>		
											<td><input value="<?php echo $row_5["remark"]; ?>"  id="ttxtG<?php echo $count;?>" class="form-control text-uppercase" name="ttxtG<?php echo $count;?>" size="20"></td>		
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
											<td><input id="ttxtB1" size="20" class="form-control text-uppercase"  name="ttxtB1"></td>
											<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>		
											<td><input  id="ttxtD1" size="20" class="form-control text-uppercase"  name="ttxtD1" validate="onlyNumbers"></td>		
											<td><input  id="ttxtE1" size="20" class="form-control text-uppercase"  name="ttxtE1"></td>		
											<td><input  id="ttxtF1" size="20" class="form-control text-uppercase"  name="ttxtF1" validate="onlyNumbers"></td>		
											<td><input  id="ttxtG1" size="20" class="form-control text-uppercase"  name="ttxtG1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
										</td>
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
							<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive">
								<tr>
									<td colspan="4">ii) After substantial expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable6" id="objectTable6" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl. No.</th>
											<th rowspan="2" width="15%">Items</th>
											<th colspan="2" width="30%">Actual requirement</th>
											<th colspan="2" width="30%">Utilisation since date of completion of substantial expansion till date of submission of application</th>
											<th rowspan="2" width="20%">Remarks</th>
										</tr>
										<tr>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
										$num6 = $part6->num_rows;
										if($num6>0){
										  $count=1;
										  while($row_6=$part6->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>											
											<td><input type="text" value="<?php echo $row_6["items"]; ?>" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_6["actual_quantity"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_6["actual_rupees"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_6["utilise_quantity"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_6["utilise_rupees"]; ?>" validate="onlyNumbers" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_6["remark"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>" size="20"></td>	
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
											<td><input type="text" id="txtB1" size="20"  class="form-control text-uppercase" name="txtB1"></td>
											<td><input type="text"  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>					
											<td><input type="text" id="txtD1" size="20" class="form-control text-uppercase"  name="txtD1" validate="onlyNumbers"></td>
											<td><input type="text" id="txtE1" size="20" class="form-control text-uppercase"  name="txtE1"></td>
											<td><input type="text" id="txtF1" size="20" class="form-control text-uppercase"  name="txtF1" validate="onlyNumbers"></td>
											<td><input type="text" id="txtG1" size="20" class="form-control text-uppercase"  name="txtG1"></td>
										</tr>
										<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction6()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore6()" value="">Add More</button>
										<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
									</td>
										
								</tr>
								<tr>
									<td colspan="4">b) Source(s) of materials</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable7" id="objectTable7" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl no.</th>
											<th rowspan="2"width="15%">Item(s)</th>
											<th rowspan="2" width="20%">Whether the source of supply is within Assam/ outside Assam</th>
											<th width="60%" colspan="5">Name and address of the supplier of principal raw materials/ consumables</th>											
										</tr>
										<tr>
											<th>Name</th>
											<th>House no</th>
											<th>Vill</th>
											<th>District</th>
											<th>Pin </th>
										</tr>
										</thead>
										<?php
										$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
										$num7 = $part7->num_rows;
										if($num7>0){
										  $count=1;
										  while($row_7=$part7->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>											
											<td><input type="text" value="<?php echo $row_7["items"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_7["source"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_7["name"]; ?>" validate="letters" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_7["hno"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_7["vill"]; ?>"  id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_7["dist"]; ?>"  id="textG<?php echo $count;?>" class="form-control text-uppercase" name="textG<?php echo $count;?>" size="20"></td>	
											<td><input type="text" value="<?php echo $row_7["pin"]; ?>"  id="textH<?php echo $count;?>" validate="pincode" maxlength="6" class="form-control text-uppercase" name="textH<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input type="text" id="textB1" size="20"   class="form-control text-uppercase" name="textB1"></td>
										<td><input type="text"  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>					
										<td><input type="text" id="textD1" size="20" class="form-control text-uppercase"  name="textD1" validate="letters"></td>
										<td><input type="text" id="textE1" size="20" class="form-control text-uppercase"  name="textE1"></td>
										<td><input type="text" id="textF1" size="20" class="form-control text-uppercase"  name="textF1" ></td>
										<td><input type="text" id="textG1" size="20" class="form-control text-uppercase"  name="textG1"></td>
										<td><input type="text" id="textH1" size="20" class="form-control text-uppercase" validate="pincode" maxlength="6" name="textH1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction7()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore7()" value="">Add More</button>
										<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">14. Details of Sale of finished product(s)/ Service(s) rendered</td>
								</tr>
								<tr>
									<td colspan="4">a)Prior to Substantial Expansion</td>
								</tr>
								<tr>
									<td colspan="4">
									<table  name="objectTable8" id="objectTable8" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="3" width="5%" >Sl no.</th>
											<th rowspan="3" width="15%" >Items</th>
											<th width="60%" colspan="4">Product(s)/ Service(s) sold during the last accounting year</th>
											<th rowspan="3" width="20%">Remarks</th>
										</tr>
										<tr>
											<th colspan="2">Within the State of Assam </th>
											<th colspan="2">Outside the State of Assam </th>
										</tr>
										<tr>
											<th>Quantity </th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
										$num8 = $part8->num_rows;
										if($num8>0){
										  $count=1;
										  while($row_8=$part8->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
											<td><input type="text" value="<?php echo $row_8["items"]; ?>" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_8["within_assam_quantity"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_8["within_assam_value"]; ?>"  id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>" size="20" validate="onlyNumbers"></td>						
											<td><input type="text" value="<?php echo $row_8["outside_assam_quantity"]; ?>"  id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="20"></td>						
											<td><input type="text" value="<?php echo $row_8["outside_assam_value"]; ?>"  id="txxtF<?php echo $count;?>" class="form-control text-uppercase" name="txxtF<?php echo $count;?>" validate="onlyNumbers" size="20"></td>						
											<td><input type="text" value="<?php echo $row_8["remark"]; ?>"  id="txxtG<?php echo $count;?>" class="form-control text-uppercase" name="txxtG<?php echo $count;?>" size="20"></td>						
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
										<td><input type="text" id="txxtB1" size="20" class="form-control text-uppercase" name="txxtB1"></td>
										<td><input type="text" id="txxtC1" size="20" class="form-control text-uppercase"  name="txxtC1"></td>					
										<td><input type="text" id="txxtD1" size="20" class="form-control text-uppercase"  name="txxtD1" validate="onlyNumbers"></td>
										<td><input type="text" id="txxtE1" size="20" class="form-control text-uppercase"  name="txxtE1"></td>
										<td><input type="text" id="txxtF1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txxtF1"></td>
										<td><input type="text" id="txxtG1" size="20" class="form-control text-uppercase"  name="txxtG1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction8()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore8()" value="">Add More</button>
										<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">b) Prior to Substantial Expansion</td>
								</tr>
								<tr>
								<tr>
									<td colspan="4">
									<table  name="objectTable9" id="objectTable9" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="3" width="5%" >Sl no.</th>
											<th rowspan="3" width="15%" >Items</th>
											<th width="60%" colspan="4">Product(s)/ Service(s) sold since the date of completion of substantial expansion till date of submission of the application</th>
											<th rowspan="3" width="20%">Remarks</th>
										</tr>
										<tr>
											<th colspan="2">Within the State of Assam </th>
											<th colspan="2">Outside the State of Assam </th>
										</tr>
										<tr>
											<th>Quantity </th>
											<th>Value (in Rupees)</th>
											<th>Quantity</th>
											<th>Value (in Rupees)</th>
										</tr>
										</thead>
										<?php
										$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'");
										$num9 = $part9->num_rows;
										if($num9>0){
										  $count=1;
										  while($row_9=$part9->fetch_array()){	?>
										<tr>
											<td><input type="text" readonly id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_9["slno"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
											<td><input type="text" value="<?php echo $row_9["items"]; ?>" id="txttB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_9["within_assam_quantity"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_9["within_assam_value"]; ?>" validate="onlyNumbers" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="20"></td>				
											<td><input type="text" value="<?php echo $row_9["outside_assam_quantity"]; ?>" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_9["outside_assam_value"]; ?>" validate="onlyNumbers" id="txttF<?php echo $count;?>" class="form-control text-uppercase" name="txttF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_9["remark"]; ?>"  id="txttG<?php echo $count;?>" class="form-control text-uppercase" name="txttG<?php echo $count;?>" size="20"></td>
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
										<td><input type="text" id="txttB1" size="20" class="form-control text-uppercase" name="txttB1"></td>
										<td><input type="text" id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>					
										<td><input type="text" id="txttD1" size="20" class="form-control text-uppercase"  name="txttD1" validate="onlyNumbers"></td>
										<td><input type="text" id="txttE1" size="20" class="form-control text-uppercase"  name="txttE1"></td>
										<td><input type="text" id="txttF1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txttF1"></td>
										<td><input type="text" id="txttG1" size="20" class="form-control text-uppercase"  name="txttG1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction9()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore9()" value="">Add More</button>
										<input type="hidden" id="hiddenval9" name="hiddenval9" value="<?php echo $hiddenval9; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">15. Employment Generation</td>
								</tr>
								<tr>
									<td colspan="4">(a) Regular Employment</td>
								</tr>
								<tr>
									<td colspan="4">
									<table class="table table-responsive table-bordered">
										<thead>
										<tr>
											<th rowspan="2" width="5%" class="text-center">Sl No.</th>
											<th rowspan="2" width="20%" class="text-center">Category</th>
											<th colspan="2" width="30%" class="text-center">No of employees prior to substantial expansion, who were</th>
											<th colspan="2" width="30%" class="text-center">No of employees after substantial expansion</th>
											<th rowspan="2" width="15%" class="text-center">Total</th>
										</tr>
										<tr>
											<th class="text-center">People of Assam</th>
											<th class="text-center">People not belonging to Assam</th>
											<th class="text-center">People of Assam</th>
											<th class="text-center">People not belonging to Assam</th>
										</tr>
										</thead>
										<tr>
											<td>1</td>
											<td>Managerial</td>
											<td><input type="text" class="form-control addTotal1 category_total1" name="managerial[assam_prior]" validate="onlyNumbers" value="<?php echo $managerial_assam_prior; ?>"></td>
											<td><input type="text" class="form-control  addTotal2 category_total1" name="managerial[nonassam_prior]" validate="onlyNumbers" value="<?php echo $managerial_nonassam_prior; ?>"></td>
											<td><input type="text" class="form-control  addTotal3 category_total1" name="managerial[assam_after]" validate="onlyNumbers" value="<?php echo $managerial_assam_after; ?>"></td>
											<td><input type="text" class="form-control  addTotal4 category_total1" name="managerial[nonassam_after]" validate="onlyNumbers" value="<?php echo $managerial_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control addTotal5" id="category_total1" name="managerial[total]" validate="onlyNumbers" value="<?php echo $managerial_total; ?>"></td>
										</tr>
										<tr>
											<td>2</td>
											<td>Supervisory</td>
											<td><input type="text" class="form-control addTotal1 category_total2" name="super[assam_prior]" validate="onlyNumbers" value="<?php echo $super_assam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal2 category_total2" name="super[nonassam_prior]" value="<?php echo $super_nonassam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal3 category_total2" name="super[assam_after]" validate="onlyNumbers" value="<?php echo $super_assam_after; ?>"></td>
											<td><input type="text" class="form-control addTotal4 category_total2" name="super[nonassam_after]" validate="onlyNumbers" value="<?php echo $super_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control addTotal5" id="category_total2" name="super[total]" validate="onlyNumbers" value="<?php echo $super_total; ?>"></td>
										</tr>
										<tr>
											<td>3</td>
											<td>Skilled</td>
											<td><input type="text" class="form-control addTotal1 category_total3" name="skilled[assam_prior]" validate="onlyNumbers" value="<?php echo $skilled_assam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal2 category_total3" name="skilled[nonassam_prior]" validate="onlyNumbers" value="<?php echo $skilled_nonassam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal3 category_total3" name="skilled[assam_after]" validate="onlyNumbers" value="<?php echo $skilled_assam_after; ?>"></td>
											<td><input type="text" class="form-control addTotal4 category_total3" name="skilled[nonassam_after]" validate="onlyNumbers" value="<?php echo $skilled_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control addTotal5" id="category_total3" name="skilled[total]" validate="onlyNumbers" value="<?php echo $skilled_total; ?>"></td>
										</tr>
										<tr>
											<td>4</td>
											<td>Semi-skilled</td>
											<td><input type="text" class="form-control addTotal1 category_total4" name="semiskilled[assam_prior]" validate="onlyNumbers" value="<?php echo $semiskilled_assam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal2 category_total4" name="semiskilled[nonassam_prior]" validate="onlyNumbers" value="<?php  echo $semiskilled_nonassam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal3 category_total4" name="semiskilled[assam_after]" validate="onlyNumbers" value="<?php echo $semiskilled_assam_after; ?>"></td>
											<td><input type="text" class="form-control addTotal4 category_total4" name="semiskilled[nonassam_after]" validate="onlyNumbers" value="<?php echo $semiskilled_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control addTotal5" id="category_total4" name="semiskilled[total]"validate="onlyNumbers" value="<?php echo $semiskilled_total; ?>"></td>
										</tr>
										<tr>
											<td>5</td>
											<td>Unskilled and others</td>
											<td><input type="text" class="form-control addTotal1 category_total5" name="unskilled[assam_prior]" validate="onlyNumbers" value="<?php echo $unskilled_assam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal2 category_total5" name="unskilled[nonassam_prior]" validate="onlyNumbers" value="<?php  echo $unskilled_nonassam_prior; ?>"></td>
											<td><input type="text" class="form-control addTotal3 category_total5" name="unskilled[assam_after]" validate="onlyNumbers" value="<?php  echo $unskilled_assam_after; ?>"></td>
											<td><input type="text" class="form-control addTotal4 category_total5" name="unskilled[nonassam_after]" validate="onlyNumbers" value="<?php  echo $unskilled_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control addTotal5" id="category_total5" name="unskilled[total]" validate="onlyNumbers" value="<?php  echo $unskilled_total; ?>"></td>
										</tr>
										<tr>
											<td colspan="2" align="center">Total</td>
											<td><input type="text" readonly="readonly" class="form-control" id="amount_total1" name="total[assam_prior]"validate="onlyNumbers" value="<?php echo $total_assam_prior; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control" id="amount_total2" name="total[nonassam_prior]" validate="onlyNumbers" value="<?php echo $total_nonassam_prior; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control" id="amount_total3" name="total[assam_after]"validate="onlyNumbers" value="<?php echo $total_assam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control" id="amount_total4" name="total[nonassam_after]" validate="onlyNumbers" value="<?php echo $total_nonassam_after; ?>"></td>
											<td><input type="text" readonly="readonly" class="form-control" id="amount_total5" name="total[total]" validate="onlyNumbers" value="<?php echo $total_total; ?>"></td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">(b)Casual employment</td>
								</tr>
								<tr>
									<td width="25%">i) Average mandays utilized per month :</td>
									<td width="25%"><input type="text" class="form-control" name="mandays_utilized" validate="onlyNumbers" value="<?php echo $mandays_utilized; ?>"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<tr>
									<td colspan="4">16. Incentives applied for</td>
								</tr>
								<tr>
									<td colspan="4">
									<table  name="objectTable10" id="objectTable10" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th width="5%">Sl no.</th>
											<th width="45%">Name of the incentive(s)</th>
											<th width="50%">Remarks</th>
										</tr>
										</thead>
										<?php
										$part10=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t10 WHERE form_id='$form_id'");
										$num10 = $part10->num_rows;
										if($num10>0){
										$count=1;
										while($row_10=$part10->fetch_array()){	?>
										<tr>
											<td><input readonly id="ttxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_10["slno"]; ?>" name="ttxtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_10["name"]; ?>" id="ttxtB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="ttxtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_10["remark"]; ?>"  id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" name="ttxtC<?php echo $count;?>" size="20"></td>
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
											<td><input id="ttxtB1" size="20" class="form-control text-uppercase"  name="ttxtB1"></td>
											<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>
										</tr>
										<?php } ?>
										</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction10()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore10()" value="">Add More</button>
										<input type="hidden" id="hiddenval10" name="hiddenval10" value="<?php echo $hiddenval10; ?>"/></div>
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
										<a href="<?php echo $table_name;?>.php?tab=5" type="button" class="btn btn-primary">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>f" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	$('.addFinanceTotal').on('change', function(){
		var sum = 0;
		
		$('.addFinanceTotal').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#finance_total').val(sum);
		});
	});
	
	
	$('.addTotal1').on('change', function(){
		var sum = 0;
		
		$('.addTotal1').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_total1').val(sum);
		});
	});
	$('.category_total1').on('change', function(){
		var sum = 0;
		
		$('.category_total1').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total1').val(sum);
		});
		var amount_total5_sum = 0;
		$('.addTotal5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#amount_total5').val(amount_total5_sum);
		});
	});
	$('.addTotal2').on('change', function(){
		var sum = 0;
		$('.addTotal2').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_total2').val(sum);
		});
	});
	$('.category_total2').on('change', function(){
		var sum = 0;
		$('.category_total2').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total2').val(sum);
		});
		var amount_total5_sum = 0;
		$('.addTotal5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#amount_total5').val(amount_total5_sum);
		});
	});
	$('.addTotal3').on('change', function(){
		var sum = 0;
		$('.addTotal3').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_total3').val(sum);
		});
	});
	$('.category_total3').on('change', function(){
		var sum = 0;
		$('.category_total3').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total3').val(sum);
		});
		var amount_total5_sum = 0;
		$('.addTotal5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#amount_total5').val(amount_total5_sum);
		});
	});
	$('.addTotal4').on('change', function(){
		var sum = 0;
		$('.addTotal4').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#amount_total4').val(sum);
		});
		
	});
	$('.category_total4').on('change', function(){
		var sum = 0;
		$('.category_total4').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total4').val(sum);
		});
		var amount_total5_sum = 0;
		$('.addTotal5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#amount_total5').val(amount_total5_sum);
		});
	});
		
	$('.category_total5').on('change', function(){
		var sum = 0;
		$('.category_total5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#category_total5').val(sum);
		});
		var amount_total5_sum = 0;
		$('.addTotal5').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				amount_total5_sum = amount_total5_sum + parseInt($(this).val());
			}
			$('#amount_total5').val(amount_total5_sum);
		});
	});
	/* ----------------------------------------------------- */
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
</script>