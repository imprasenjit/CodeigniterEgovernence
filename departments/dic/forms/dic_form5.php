<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="5";
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
			##### part 1 ######	
			
			$is_implementaion=$results['is_implementaion'];$is_owned=$results['is_owned'];$area_sq_mtr=$results['area_sq_mtr'];$area_project=$results['area_project'];$location=$results['location'];$no_purchase_deed=$results['no_purchase_deed'];$reg_purchase_deed=$results['reg_purchase_deed'];$premium=$results['premium'];$date_possesion=$results['date_possesion'];$lease_duration=$results['lease_duration'];
			
			if(!empty($results["act"])){
				$act=json_decode($results["act"]);
				$act_reg_dt=$act->reg_dt;$act_reg_no=$act->reg_no;$act_reg_office=$act->reg_office;
			}else{
				$act_reg_dt="";$act_reg_no="";$act_reg_office="";
			}
			if(!empty($results["detail_l"])){
				$detail_l=json_decode($results["detail_l"]);
				$detail_l_dag=$detail_l->dag;$detail_l_patta=$detail_l->patta;$detail_l_rev_vill=$detail_l->rev_vill;$detail_l_mauza=$detail_l->mauza;
			}else{
				$detail_l_dag="";$detail_l_patta="";$detail_l_rev_vill="";$detail_l_mauza="";
			}
			if(!empty($results["provisional"])){
				$provisional=json_decode($results["provisional"]);
				$provisional_reg_dt=$provisional->reg_dt;$provisional_reg_no=$provisional->reg_no;
			}else{
				$provisional_reg_dt="";$provisional_reg_no="";
			}
			if(!empty($results["permanent"])){
				$permanent=json_decode($results["permanent"]);
				$permanent_reg_dt=$permanent->reg_dt;$permanent_reg_no=$permanent->reg_no;
			}else{
				$permanent_reg_dt="";$permanent_reg_no="";
			}
			if(!empty($results["indus"])){
				$indus=json_decode($results["indus"]);
				$indus_reg_dt=$indus->reg_dt;$indus_reg_no=$indus->reg_no;
			}else{
				$indus_reg_dt="";$indus_reg_no="";
			}
			if(!empty($results["consultant"])){
				$consultant=json_decode($results["consultant"]);
				$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
			}else{
				$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";	
			}
			if(!empty($results["organization"])){
				$organization=json_decode($results["organization"]);
				$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pincode=$organization->pincode;$organization_mobile=$organization->mobile;$organization_email=$organization->email;
			}else{
				$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pincode="";$organization_mobile="";$organization_email="";	
			}
			$start_date_civconstruct=$results['start_date_civconstruct'];$end_date_civconstruct=$results['end_date_civconstruct'];$tot_area_underconstruct=$results['tot_area_underconstruct'];$tot_cost_construct=$results['tot_cost_construct'];$cost_manufacturing=$results['cost_manufacturing'];$agency_area_covered=$results['agency_area_covered'];$agency_annual_rent=$results['agency_annual_rent'];$agency_regnum=$results['agency_regnum'];$agency_regdate=$results['agency_regdate'];$agency_loc=$results['agency_loc'];$agency_lease_period=$results['agency_lease_period'];$capital_invest_total=$results['capital_invest_total'];
			if(!empty($results["owner"])){
				$owner=json_decode($results["owner"]);
				$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_vill=$owner->vill;$owner_dist=$owner->dist;$owner_pincode=$owner->pincode;$owner_mobile=$owner->mobile;$owner_email=$owner->email;
			}else{
				$owner_name="";$owner_sn1="";$owner_sn2="";$owner_vill="";$owner_dist="";$owner_pincode="";$owner_mobile="";$owner_email="";	
			}
			if(!empty($results["agency"])){
				$agency=json_decode($results["agency"]);
				$agency_name=$agency->name;$agency_sn1=$agency->sn1;$agency_sn2=$agency->sn2;$agency_vill=$agency->vill;$agency_dist=$agency->dist;$agency_pincode=$agency->pincode;$agency_mobile=$agency->mobile;$agency_email=$agency->email;
			}else{
				$agency_name="";$agency_sn1="";$agency_sn2="";$agency_vill="";$agency_dist="";$agency_pincode="";$agency_mobile="";$agency_email="";
			}
			if(!empty($results["reg_auth"])){
				$reg_auth=json_decode($results["reg_auth"]);
				$reg_auth_name=$reg_auth->name;$reg_auth_desig=$reg_auth->desig;$reg_auth_sn1=$reg_auth->sn1;$reg_auth_sn2=$reg_auth->sn2;$reg_auth_vill=$reg_auth->vill;$reg_auth_dist=$reg_auth->dist;$reg_auth_pincode=$reg_auth->pincode;$reg_auth_mobile=$reg_auth->mobile;$reg_auth_email=$reg_auth->email;
			}else{
				$reg_auth_name="";$reg_auth_desig="";$reg_auth_sn1="";$reg_auth_sn2="";$reg_auth_vill="";$reg_auth_dist="";$reg_auth_pincode="";$reg_auth_mobile="";$reg_auth_email="";
			}
			if(!empty($results["rent_auth"])){
				$rent_auth=json_decode($results["rent_auth"]);
				$rent_auth_sn1=$rent_auth->sn1;$rent_auth_sn2=$rent_auth->sn2;$rent_auth_vill=$rent_auth->vill;$rent_auth_dist=$rent_auth->dist;$rent_auth_pincode=$rent_auth->pincode;$rent_auth_mobile=$rent_auth->mobile;$rent_auth_email=$rent_auth->email;
			}else{
				$rent_auth_sn1="";$rent_auth_sn2="";$rent_auth_vill="";$rent_auth_dist="";$rent_auth_pincode="";$rent_auth_mobile="";$rent_auth_email="";
			}
			if(!empty($results["capital_invest"])){
				$capital_invest=json_decode($results["capital_invest"]);
				$capital_invest_land=$capital_invest->land;$capital_invest_site=$capital_invest->site;$capital_invest_factory=$capital_invest->factory;$capital_invest_office=$capital_invest->office;$capital_invest_plant=$capital_invest->plant;$capital_invest_equipment=$capital_invest->equipment;$capital_invest_power=$capital_invest->power;$capital_invest_electrical=$capital_invest->electrical;$capital_invest_utility=$capital_invest->utility;$capital_invest_misc=$capital_invest->misc;$capital_invest_operative=$capital_invest->operative;
		   }else{
				$capital_invest_land="";$capital_invest_site="";$capital_invest_factory="";$capital_invest_office="";$capital_invest_plant="";$capital_invest_equipment="";$capital_invest_power="";$capital_invest_electrical="";$capital_invest_utility="";$capital_invest_misc="";$capital_invest_operative="";
			}
		}else{		 
			$form_id="";
			##### part 1 ######
			$act_reg_dt="";$act_reg_no="";$act_reg_office="";
			$is_implementaion="";$is_owned="";$area_sq_mtr="";$area_project="";$location="";
			$detail_l_dag="";$detail_l_patta="";$detail_l_rev_vill="";$detail_l_mauza="";
			$no_purchase_deed="";$reg_purchase_deed="";$premium="";$date_possesion="";$lease_duration="";
			
			$provisional_reg_dt="";$provisional_reg_no="";	
			$permanent_reg_dt="";$permanent_reg_no="";	
			$indus_reg_no="";$indus_reg_dt="";
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";	
			$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pincode="";$organization_mobile="";$organization_email="";	
			
			######part2######
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_vill="";$owner_dist="";$owner_pincode="";$owner_mobile="";$owner_email="";
			$start_date_civconstruct="";$end_date_civconstruct="";$tot_area_underconstruct="";$tot_cost_construct="";$cost_manufacturing="";
			$agency_name="";$agency_sn1="";$agency_sn2="";$agency_vill="";$agency_dist="";$agency_pincode="";$agency_mobile="";$agency_email="";
			$reg_auth_name="";$reg_auth_desig="";$reg_auth_sn1="";$reg_auth_sn2="";$reg_auth_vill="";$reg_auth_dist="";$reg_auth_pincode="";$reg_auth_mobile="";$reg_auth_email="";
			$agency_area_covered="";$agency_annual_rent="";$agency_regnum="";$agency_regdate="";$agency_loc="";$agency_lease_period="";	
			$capital_invest_land="";$capital_invest_site="";$capital_invest_factory="";$capital_invest_office="";$capital_invest_plant="";$capital_invest_equipment="";$capital_invest_power="";$capital_invest_electrical="";$capital_invest_utility="";$capital_invest_misc="";$capital_invest_operative="";$capital_invest_total="";
			$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";$sources_f_finance_total="";
			$financial_details_name="";$financial_details_term="";$financial_details_margin="";$financial_details_t_loan="";$financial_details_rate="";$financial_details_schedule="";$financial_details_d1="";$financial_details_d2="";
			$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
			$aseb_bill_date="";$aseb_bill_no="";$aseb_mr_no="";$aseb_date_payment="";
			
			$pow_line_expen="";$dg_details="";$dg_make="";$dg_rating="";$cost_of_dgset="";$installation_date="";		
			$rent_auth_sn1="";$rent_auth_sn2="";$rent_auth_vill="";$rent_auth_dist="";$rent_auth_pincode="";$rent_auth_mobile="";$rent_auth_email="";
			######part3####
			$date_comm_prod="";$details_prod="";
			
			$managerial_assam="";$managerial_outsiders="";$managerial_total="";$managerial_remarks="";
			$supervisory_assam="";$supervisory_outsiders="";$supervisory_total="";$supervisory_remarks="";
			$skilled_assam="";$skilled_outsiders="";$skilled_total="";$skilled_remarks="";
			$semi_skilled_assam="";$semi_skilled_outsiders="";$semi_skilled_total="";$semi_skilled_remarks="";
			$unskilled_assam="";$unskilled_outsiders="";$unskilled_total="";$unskilled_remarks="";
			$total_assam="";$total_outsiders="";$gross_total="";$gross_remarks="";
			$utilized_mandays="";
			$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		##### part 1 ######	
		
		$is_implementaion=$results['is_implementaion'];$is_owned=$results['is_owned'];$area_sq_mtr=$results['area_sq_mtr'];$area_project=$results['area_project'];$location=$results['location'];$no_purchase_deed=$results['no_purchase_deed'];$reg_purchase_deed=$results['reg_purchase_deed'];$premium=$results['premium'];$date_possesion=$results['date_possesion'];$lease_duration=$results['lease_duration'];
		
		if(!empty($results["act"])){
			$act=json_decode($results["act"]);
			$act_reg_dt=$act->reg_dt;$act_reg_no=$act->reg_no;$act_reg_office=$act->reg_office;
		}else{
			$act_reg_dt="";$act_reg_no="";$act_reg_office="";
		}
		if(!empty($results["detail_l"])){
			$detail_l=json_decode($results["detail_l"]);
			$detail_l_dag=$detail_l->dag;$detail_l_patta=$detail_l->patta;$detail_l_rev_vill=$detail_l->rev_vill;$detail_l_mauza=$detail_l->mauza;
		}else{
			$detail_l_dag="";$detail_l_patta="";$detail_l_rev_vill="";$detail_l_mauza="";
		}
		if(!empty($results["provisional"])){
			$provisional=json_decode($results["provisional"]);
			$provisional_reg_dt=$provisional->reg_dt;$provisional_reg_no=$provisional->reg_no;
		}else{
			$provisional_reg_dt="";$provisional_reg_no="";
		}
		if(!empty($results["permanent"])){
			$permanent=json_decode($results["permanent"]);
			$permanent_reg_dt=$permanent->reg_dt;$permanent_reg_no=$permanent->reg_no;
		}else{
			$permanent_reg_dt="";$permanent_reg_no="";
		}
		if(!empty($results["indus"])){
			$indus=json_decode($results["indus"]);
			$indus_reg_dt=$indus->reg_dt;$indus_reg_no=$indus->reg_no;
		}else{
			$indus_reg_dt="";$indus_reg_no="";
		}
		if(!empty($results["consultant"])){
			$consultant=json_decode($results["consultant"]);
			$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
		}else{
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";	
		}
		if(!empty($results["organization"])){
			$organization=json_decode($results["organization"]);
			$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pincode=$organization->pincode;$organization_mobile=$organization->mobile;$organization_email=$organization->email;
		}else{
			$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pincode="";$organization_mobile="";$organization_email="";	
		}
		$start_date_civconstruct=$results['start_date_civconstruct'];$end_date_civconstruct=$results['end_date_civconstruct'];$tot_area_underconstruct=$results['tot_area_underconstruct'];$tot_cost_construct=$results['tot_cost_construct'];$cost_manufacturing=$results['cost_manufacturing'];$agency_area_covered=$results['agency_area_covered'];$agency_annual_rent=$results['agency_annual_rent'];$agency_regnum=$results['agency_regnum'];$agency_regdate=$results['agency_regdate'];$agency_loc=$results['agency_loc'];$agency_lease_period=$results['agency_lease_period'];$capital_invest_total=$results['capital_invest_total'];
		if(!empty($results["owner"])){
			$owner=json_decode($results["owner"]);
			$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_vill=$owner->vill;$owner_dist=$owner->dist;$owner_pincode=$owner->pincode;$owner_mobile=$owner->mobile;$owner_email=$owner->email;
		}else{
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_vill="";$owner_dist="";$owner_pincode="";$owner_mobile="";$owner_email="";	
		}
		if(!empty($results["agency"])){
			$agency=json_decode($results["agency"]);
			$agency_name=$agency->name;$agency_sn1=$agency->sn1;$agency_sn2=$agency->sn2;$agency_vill=$agency->vill;$agency_dist=$agency->dist;$agency_pincode=$agency->pincode;$agency_mobile=$agency->mobile;$agency_email=$agency->email;
		}else{
			$agency_name="";$agency_sn1="";$agency_sn2="";$agency_vill="";$agency_dist="";$agency_pincode="";$agency_mobile="";$agency_email="";
		}
		if(!empty($results["reg_auth"])){
			$reg_auth=json_decode($results["reg_auth"]);
			$reg_auth_name=$reg_auth->name;$reg_auth_desig=$reg_auth->desig;$reg_auth_sn1=$reg_auth->sn1;$reg_auth_sn2=$reg_auth->sn2;$reg_auth_vill=$reg_auth->vill;$reg_auth_dist=$reg_auth->dist;$reg_auth_pincode=$reg_auth->pincode;$reg_auth_mobile=$reg_auth->mobile;$reg_auth_email=$reg_auth->email;
		}else{
			$reg_auth_name="";$reg_auth_desig="";$reg_auth_sn1="";$reg_auth_sn2="";$reg_auth_vill="";$reg_auth_dist="";$reg_auth_pincode="";$reg_auth_mobile="";$reg_auth_email="";
		}
		if(!empty($results["rent_auth"])){
			$rent_auth=json_decode($results["rent_auth"]);
			$rent_auth_sn1=$rent_auth->sn1;$rent_auth_sn2=$rent_auth->sn2;$rent_auth_vill=$rent_auth->vill;$rent_auth_dist=$rent_auth->dist;$rent_auth_pincode=$rent_auth->pincode;$rent_auth_mobile=$rent_auth->mobile;$rent_auth_email=$rent_auth->email;
		}else{
			$rent_auth_sn1="";$rent_auth_sn2="";$rent_auth_vill="";$rent_auth_dist="";$rent_auth_pincode="";$rent_auth_mobile="";$rent_auth_email="";
		}
		if(!empty($results["capital_invest"])){
			$capital_invest=json_decode($results["capital_invest"]);
			$capital_invest_land=$capital_invest->land;$capital_invest_site=$capital_invest->site;$capital_invest_factory=$capital_invest->factory;$capital_invest_office=$capital_invest->office;$capital_invest_plant=$capital_invest->plant;$capital_invest_equipment=$capital_invest->equipment;$capital_invest_power=$capital_invest->power;$capital_invest_electrical=$capital_invest->electrical;$capital_invest_utility=$capital_invest->utility;$capital_invest_misc=$capital_invest->misc;$capital_invest_operative=$capital_invest->operative;
		}else{
			$capital_invest_land="";$capital_invest_site="";$capital_invest_factory="";$capital_invest_office="";$capital_invest_plant="";$capital_invest_equipment="";$capital_invest_power="";$capital_invest_electrical="";$capital_invest_utility="";$capital_invest_misc="";$capital_invest_operative="";
		}
		
	}
	#### PART II #####
	$q2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id'");
	if($q2->num_rows<1){
		$p1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
		if($p1->num_rows>0){
			$results2=$p1->fetch_assoc();
			$pow_line_expen=$results2['pow_line_expen'];$dg_details=$results2['dg_details'];$dg_make=$results2['dg_make'];$dg_rating=$results2['dg_rating'];$cost_of_dgset=$results2['cost_of_dgset'];$installation_date=$results2['installation_date'];$sources_f_finance_total=$results2['sources_f_finance_total'];
			if(!empty($results2["sources_f_finance"])){
				$sources_f_finance=json_decode($results2["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results2["financial_details"])){
				$financial_details=json_decode($results2["financial_details"]);
				$financial_details_name=$financial_details->name;$financial_details_term=$financial_details->term;$financial_details_margin=$financial_details->margin;$financial_details_t_loan=$financial_details->t_loan;$financial_details_rate=$financial_details->rate;$financial_details_schedule=$financial_details->schedule;$financial_details_schedule=$financial_details->schedule;$financial_details_d1=$financial_details->d1;$financial_details_d2=$financial_details->d2;
			}else{
				$financial_details_name="";$financial_details_term="";$financial_details_margin="";$financial_details_t_loan="";$financial_details_rate="";$financial_details_schedule="";$financial_details_d1="";$financial_details_d2="";
			}
			if(!empty($results2["aseb"])){
				$aseb=json_decode($results2["aseb"]);
				$aseb_bill_no=$aseb->bill_no;$aseb_bill_date=$aseb->bill_date;$aseb_mr_no=$aseb->mr_no;$aseb_date_payment=$aseb->date_payment;
			}else{
				$aseb_bill_no="";$aseb_bill_date="";$aseb_mr_no="";$aseb_date_payment="";
			}
			if(!empty($results2["details_f_power"])){
				$details_f_power=json_decode($results2["details_f_power"]);
				$details_f_power_qtm=$details_f_power->qtm;$details_f_power_lno=$details_f_power->lno;$details_f_power_dt=$details_f_power->dt;$details_f_power_con_load=$details_f_power->con_load;$details_f_power_con_dt=$details_f_power->con_dt;$details_f_power_sl_no=$details_f_power->sl_no;$details_f_power_es_amt=$details_f_power->es_amt;
			}else{
				$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
			}
			$date_comm_prod=$results2['date_comm_prod'];$details_prod=$results2['details_prod'];$total_assam=$results2['total_assam'];$total_outsiders=$results2['total_outsiders'];$gross_total=$results2['gross_total'];$gross_remarks=$results2['gross_remarks'];$utilized_mandays=$results2['utilized_mandays'];
			if(!empty($results2["managerial"])){
				$managerial=json_decode($results2["managerial"]);
				$managerial_assam=$managerial->assam;$managerial_outsiders=$managerial->outsiders;$managerial_total=$managerial->total;$managerial_remarks=$managerial->remarks;
			}else{
				$managerial_assam="";$managerial_outsiders="";$managerial_total="";$managerial_remarks="";
			}
			if(!empty($results2["supervisory"])){
				$supervisory =json_decode($results2["supervisory"]);
				$supervisory_assam=$supervisory->assam;$supervisory_outsiders=$supervisory->outsiders;$supervisory_total=$supervisory->total;$supervisory_remarks=$supervisory->remarks;
			}else{
				$supervisory_assam="";$supervisory_outsiders="";$supervisory_total="";$supervisory_remarks="";
			}
			if(!empty($results2["skilled"])){
				$skilled =json_decode($results2["skilled"]);
				$skilled_assam=$skilled->assam;$skilled_outsiders=$skilled->outsiders;$skilled_total=$skilled->total;$skilled_remarks=$skilled->remarks;
			}else{
				$skilled_assam="";$skilled_outsiders="";$skilled_total="";$skilled_remarks="";
			}
			if(!empty($results2["semi_skilled"])){
				$semi_skilled =json_decode($results2["semi_skilled"]);
				$semi_skilled_assam=$semi_skilled ->assam;$semi_skilled_outsiders=$semi_skilled->outsiders;$semi_skilled_total=$semi_skilled->total;$semi_skilled_remarks=$semi_skilled->remarks;
			}else{
				$semi_skilled_assam="";$semi_skilled_outsiders="";$semi_skilled_total="";$semi_skilled_remarks="";
			}
			if(!empty($results2["unskilled"])){
				$unskilled =json_decode($results2["unskilled"]);
				$unskilled_assam=$unskilled->assam;$unskilled_outsiders=$unskilled->outsiders;$unskilled_total=$unskilled->total;$unskilled_remarks=$unskilled->remarks;
			}else{
				$unskilled_assam="";$unskilled_outsiders="";$unskilled_total="";$unskilled_remarks="";
			}
		 
		}else{			
			$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";$sources_f_finance_total="";
			$financial_details_name="";$financial_details_term="";$financial_details_margin="";$financial_details_t_loan="";$financial_details_rate="";$financial_details_schedule="";$financial_details_d1="";$financial_details_d2="";
			$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
			$aseb_bill_date="";$aseb_bill_no="";$aseb_mr_no="";$aseb_date_payment="";
			$pow_line_expen="";$dg_details="";$dg_make="";$dg_rating="";$cost_of_dgset="";$installation_date="";		
			$date_comm_prod="";$details_prod="";
			
			$managerial_assam="";$managerial_outsiders="";$managerial_total="";$managerial_remarks="";
			$supervisory_assam="";$supervisory_outsiders="";$supervisory_total="";$supervisory_remarks="";
			$skilled_assam="";$skilled_outsiders="";$skilled_total="";$skilled_remarks="";
			$semi_skilled_assam="";$semi_skilled_outsiders="";$semi_skilled_total="";$semi_skilled_remarks="";
			$unskilled_assam="";$unskilled_outsiders="";$unskilled_total="";$unskilled_remarks="";
			$total_assam="";$total_outsiders="";$gross_total="";$gross_remarks="";
			$utilized_mandays="";
		}
			
	}else{		
			$results2=$q2->fetch_assoc();
			$pow_line_expen=$results2['pow_line_expen'];$dg_details=$results2['dg_details'];$dg_make=$results2['dg_make'];$dg_rating=$results2['dg_rating'];$cost_of_dgset=$results2['cost_of_dgset'];$installation_date=$results2['installation_date'];$sources_f_finance_total=$results2['sources_f_finance_total'];
			if(!empty($results2["sources_f_finance"])){
				$sources_f_finance=json_decode($results2["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results2["financial_details"])){
				$financial_details=json_decode($results2["financial_details"]);
				$financial_details_name=$financial_details->name;$financial_details_term=$financial_details->term;$financial_details_margin=$financial_details->margin;$financial_details_t_loan=$financial_details->t_loan;$financial_details_rate=$financial_details->rate;$financial_details_schedule=$financial_details->schedule;$financial_details_schedule=$financial_details->schedule;$financial_details_d1=$financial_details->d1;$financial_details_d2=$financial_details->d2;
			}else{
				$financial_details_name="";$financial_details_term="";$financial_details_margin="";$financial_details_t_loan="";$financial_details_rate="";$financial_details_schedule="";$financial_details_d1="";$financial_details_d2="";
			}
			if(!empty($results2["aseb"])){
				$aseb=json_decode($results2["aseb"]);
				$aseb_bill_no=$aseb->bill_no;$aseb_bill_date=$aseb->bill_date;$aseb_mr_no=$aseb->mr_no;$aseb_date_payment=$aseb->date_payment;
			}else{
				$aseb_bill_no="";$aseb_bill_date="";$aseb_mr_no="";$aseb_date_payment="";
			}
			if(!empty($results2["details_f_power"])){
				$details_f_power=json_decode($results2["details_f_power"]);
				$details_f_power_qtm=$details_f_power->qtm;$details_f_power_lno=$details_f_power->lno;$details_f_power_dt=$details_f_power->dt;$details_f_power_con_load=$details_f_power->con_load;$details_f_power_con_dt=$details_f_power->con_dt;$details_f_power_sl_no=$details_f_power->sl_no;$details_f_power_es_amt=$details_f_power->es_amt;
			}else{
				$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
			}
			$date_comm_prod=$results2['date_comm_prod'];$details_prod=$results2['details_prod'];$total_assam=$results2['total_assam'];$total_outsiders=$results2['total_outsiders'];$gross_total=$results2['gross_total'];$gross_remarks=$results2['gross_remarks'];$utilized_mandays=$results2['utilized_mandays'];
			if(!empty($results2["managerial"])){
				$managerial=json_decode($results2["managerial"]);
				$managerial_assam=$managerial->assam;$managerial_outsiders=$managerial->outsiders;$managerial_total=$managerial->total;$managerial_remarks=$managerial->remarks;
			}else{
				$managerial_assam="";$managerial_outsiders="";$managerial_total="";$managerial_remarks="";
			}
			if(!empty($results2["supervisory"])){
				$supervisory =json_decode($results2["supervisory"]);
				$supervisory_assam=$supervisory->assam;$supervisory_outsiders=$supervisory->outsiders;$supervisory_total=$supervisory->total;$supervisory_remarks=$supervisory->remarks;
			}else{
				$supervisory_assam="";$supervisory_outsiders="";$supervisory_total="";$supervisory_remarks="";
			}
			if(!empty($results2["skilled"])){
				$skilled =json_decode($results2["skilled"]);
				$skilled_assam=$skilled->assam;$skilled_outsiders=$skilled->outsiders;$skilled_total=$skilled->total;$skilled_remarks=$skilled->remarks;
			}else{
				$skilled_assam="";$skilled_outsiders="";$skilled_total="";$skilled_remarks="";
			}
			if(!empty($results2["semi_skilled"])){
				$semi_skilled =json_decode($results2["semi_skilled"]);
				$semi_skilled_assam=$semi_skilled ->assam;$semi_skilled_outsiders=$semi_skilled->outsiders;$semi_skilled_total=$semi_skilled->total;$semi_skilled_remarks=$semi_skilled->remarks;
			}else{
            $semi_skilled_assam="";$semi_skilled_outsiders="";$semi_skilled_total="";$semi_skilled_remarks="";
			}
			if(!empty($results2["unskilled"])){
				$unskilled =json_decode($results2["unskilled"]);
				$unskilled_assam=$unskilled->assam;$unskilled_outsiders=$unskilled->outsiders;$unskilled_total=$unskilled->total;$unskilled_remarks=$unskilled->remarks;
			}else{
				$unskilled_assam="";$unskilled_outsiders="";$unskilled_total="";$unskilled_remarks="";
			}
		
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	$tabbtn5 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 7 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	    $tabbtn5 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
	    $tabbtn5 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
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
									<li class="<?php echo $tabbtn1; ?>"><a  href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a  href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a  href="#table3">PART III</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a  href="#table4">PART IV</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td >1. (a) Name of the Industrial unit :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>(b) PAN of the unit :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" name="pan_no" value="<?php echo $pan_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(c) Factory address :</td>	 				
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>										
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>										
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo $b_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">2. (a) Constitution of the organization promoting the unit (Whether Proprietorial / Partnership / Private Limited / Limited company / Cooperative Society/ Trust/ any other legal entity ) </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Name(s) , Permanent address(es) of the Proprietor/ Partners/ Directors/ Secretary/ President/ Chairman/ CEO/ Trustee etc with the mention of their permanent Account No (PAN) :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">
										<thead>
											<tr>
												<th width="5%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%">Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
												<th width="10%">PAN</th>
											</tr>
										</thead>	
										<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>"></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value=""></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value=""></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value=""></td>
												<td><input type="text" name="dist<?php echo $i;?>" validate="letters" class="form-control text-uppercase" value=""></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="10"  ></td>
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
												<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pan; ?>" maxlength="10"  ></td>
											</tr>
											<?php $i++;
											} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										
										</table>
										</td>
									</tr>	
									<tr>
										<td colspan="4">(c) No and date of Registration under the concerned Act (e.g Companies act, partnership act etc.) :</td>
									<tr>
									<tr>
										<td>  Registration Number:</td>
										<td><input type="text" class="form-control text-uppercase"  name="act[reg_no]" value="<?php echo $act_reg_no;?>"></td>
										<td>  Registration Date :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="act[reg_dt]" readonly="readonly" required="required" value="<?php if($act_reg_dt!="0000-00-00" && $act_reg_dt!="") echo date("d-m-Y",strtotime($act_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>	
									<tr>
										<td>(d) Registered Head Office of the promoter organization : </td>
										<td><input type="text" class="form-control text-uppercase" name="act[reg_office]"  value="<?php echo $act_reg_office;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">3. Details of registration of the unit : </td>
									</tr>
									<tr>
										<td colspan="4">(a) Micro & Small Scale :</td>
									</tr>
									<tr>
										<td colspan="4"> i) Provisional Registration no and date/ EM part-I acknowledgement No and date :</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="provisional[reg_no]" min="1000" value="<?php echo $provisional_reg_no;?>"></td>
										<td>Registration Date :</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="provisional[reg_dt]" min="5000" readonly="readonly" value="<?php if($provisional_reg_dt!="0000-00-00" && $provisional_reg_dt!="") echo date("d-m-Y",strtotime($provisional_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td colspan="4"> ii) Permanent Registration no and date/ EM part-II acknowledgement No and date :</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="permanent[reg_no]" min="1000" value="<?php echo $permanent_reg_no;?>"></td>
										<td>Registration Date :</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="permanent[reg_dt]" min="5000" readonly="readonly" value="<?php if($permanent_reg_dt!="0000-00-00" && $permanent_reg_dt!="") echo date("d-m-Y",strtotime($permanent_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Medium and Large </td>
									</tr>
									<tr>
										<td colspan="4">i) No and date of Industrial License/ Letter of Intent/Industrial Entrepreneurs Memorandum (IEM)/ Entrepreneurs Memorandum (EM) prior to and after commencement of commercial production/service with uptodate amendments. </td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="indus[reg_no]" min="1000" value="<?php echo $indus_reg_no;?>"></td>
										<td>Registration Date :</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="indus[reg_dt]" min="5000" readonly="readonly" value="<?php if($indus_reg_dt!="0000-00-00" && $indus_reg_dt!="") echo date("d-m-Y",strtotime($indus_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td colspan="4">4. (a) Name and address of the consultant who prepared the Project Feasibility Report: </td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"> <input type="text" class="form-control text-uppercase" name="consultant[name]" value="<?php echo $consultant_name;?>" validate="letters"></td>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn1]" value="<?php echo $consultant_sn1;?>"></td>
									</tr>
									<tr>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn2]"  value="<?php echo $consultant_sn2;?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[vill]"  value="<?php echo $consultant_vill;?>"></td>
									</tr>
									<tr>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="consultant[dist]"  value="<?php echo $consultant_dist;?>"></td>
										
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[pincode]"  value="<?php echo $consultant_pincode;?>" validate="pincode" maxlength="6"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[mobile]" value="<?php echo $consultant_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="consultant[email]"  value="<?php echo $consultant_email;?>"></td>
									</tr>			
									<tr>
										<td colspan="4">(b) Name &amp; address of the organization which provided technical knowhow/ agency which certified quality of its product(s): </td>
									</tr>
									<tr>
										<td> Name</td>
										<td> <input type="text" class="form-control text-uppercase" name="organization[name]"   value="<?php echo $organization_name;?>" validate="letters"></td>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="organization[sn1]" value="<?php echo $organization_sn1;?>"></td>
									
									</tr>
									<tr>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="organization[sn2]"  value="<?php echo $organization_sn2;?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="organization[vill]"  value="<?php echo $organization_vill;?>"></td>
									</tr>
									<tr>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="organization[dist]"  value="<?php echo $organization_dist;?>"></td>
										
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="organization[pincode]"  value="<?php echo $organization_pincode;?>"  maxlength="6" validate="pincode"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="organization[mobile]"  value="<?php echo $organization_mobile;?>"  maxlength="10" validate="mobileNumber"></td>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="organization[email]"  value="<?php echo $organization_email;?>"></td>
									</tr>			
									<tr>
										<td colspan="3">(c) Whether implementation of the project has been envisaged in phased manner and if so, approximate percentage of investment in the first phase till date of submission of EC application. :<span class="mandatory_field">*</span>  </td>
										<td><label><input type="radio" required name="is_implementaion" value="Y" <?php if($is_implementaion=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_implementaion" value="N" <?php if($is_implementaion=="N") echo "checked"; ?> /> No</label></td>
									</tr>			
									<tr>
										<td colspan="4">5. Details of Land : </td>
									</tr>			
									<tr>
										<td colspan="3">I. Whether the land is owned/leased hold from private party/slotted by the Government/Government agency :<span class="mandatory_field">*</span>  </td>
										<td><label><input type="radio" required name="is_owned" value="Y" <?php if($is_owned=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_owned" value="N" <?php if($is_owned=="N") echo "checked"; ?> /> No</label></td>
									</tr>			
									<tr>
										<td >II. (a) Total Area (sq mtr) : </td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="area_sq_mtr" value="<?php echo $area_sq_mtr;?>"></td>
										<td >(b) Area under use for the project : </td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="area_project" value="<?php echo $area_project;?>"></td>
									</tr>			
									<tr>
										<td >III. Location : </td>
										<td><input type="text" class="form-control text-uppercase" name="location" value="<?php echo $location;?>"></td>
										<td ></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">IV. Dag no, Patta no, Revenue village and Mauza : </td>
									</tr>
									<tr>
										<td>(a) Dag no :</td>
										<td><input type="text" class="form-control text-uppercase" name="detail_l[dag]" value="<?php echo $detail_l_dag;?>"></td>
										<td>(b) Patta no :</td>
										<td><input type="text" class="form-control text-uppercase" name="detail_l[patta]" value="<?php echo $detail_l_patta;?>"></td>
									</tr>
									<tr>
										<td>(c) Revenue village :</td>
										<td><input type="text" class="form-control text-uppercase" name="detail_l[rev_vill]" value="<?php echo $detail_l_rev_vill;?>"></td>
										<td>(d) Mauza :</td>
										<td><input type="text" class="form-control text-uppercase" name="detail_l[mauza]" value="<?php echo $detail_l_mauza;?>"></td>
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
										<td colspan="4">V. Name &amp; address of the present owner of land/ Lessor/ Govt agency allotting land :</td>
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="owner[name]" value="<?php echo $owner_name;?>" validate="letters"></td>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="owner[sn1]" value="<?php echo $owner_sn1;?>"></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="owner[sn2]" value="<?php echo $owner_sn2;?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="owner[vill]"  value="<?php echo $owner_vill;?>"></td>
									</tr>
									<tr>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="owner[dist]"  value="<?php echo $owner_dist;?>"></td>
										
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase"  name="owner[pincode]" value="<?php echo $owner_pincode;?>" validate="pincode" maxlength="6"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="owner[mobile]" value="<?php echo $owner_mobile;?>" validate="mobileNumber" maxlength="10"></td>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="owner[email]" value="<?php echo $owner_email;?>"></td>
									</tr>		
									<tr>
										<td colspan="4">VI. No and date of registration of the purchase deed/ lease deed and name, designation &amp; address of the registering authority :</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="no_purchase_deed" value="<?php echo $no_purchase_deed;?>"></td>
										<td>Registration Date :</td>
										<td><input type="text" class="dobindia form-control" name="reg_purchase_deed" readonly="readonly" value="<?php if($reg_purchase_deed!="0000-00-00" && $reg_purchase_deed!="") echo date("d-m-Y",strtotime($reg_purchase_deed)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_auth[name]" value="<?php echo $reg_auth_name;?>" validate="letters"></td>
										<td width="25%">Designation</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_auth[desig]" value="<?php echo $reg_auth_desig;?>"></td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_auth[sn1]" value="<?php echo $reg_auth_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_auth[sn2]" value="<?php echo $reg_auth_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="reg_auth[vill]"  value="<?php echo $reg_auth_vill;?>"></td>
										<td>District</td>
                                        <td><input type="text" class="form-control text-uppercase" name="reg_auth[dist]"  value="<?php echo $reg_auth_dist;?>"></td>
										
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase"  name="reg_auth[pincode]" value="<?php echo $reg_auth_pincode;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="reg_auth[mobile]" value="<?php echo $reg_auth_mobile;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="reg_auth[email]" value="<?php echo $reg_auth_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>VII. Purchase price, registration fee and stamp duty/ annual lease rent payable/ one time premium paid</td>
										<td><input type="text" class="form-control text-uppercase" name="premium" value="<?php echo $premium;?>"></td>
										<td>VIII. The date of taking over possession of land :</td>
										<td><input type="text" class="form-control dobindia" name="date_possesion" readonly="readonly" value="<?php if($date_possesion!="0000-00-00" && $date_possesion!="") echo date("d-m-Y",strtotime($date_possesion)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td>IX. Duration of lease (in year/s) :</td>
										<td><input type="text" class="text-uppercase form-control" focus="focus" name="lease_duration" validate="onlyNumbers" value="<?php echo $lease_duration;?>"></td>
										<td></td>
										<td></td>
									</tr>
								<tr>
									<td colspan="4">6. Details of building</td>
								</tr>
								<tr>
									<td colspan="4">I. If the building has been constructed</td>
								</tr>
								<tr>
									<td width="25%">(a) Date of starting of the civil construction :<span class="mandatory_field">*</span>  </td>
									<td><input type="text" class="dobindia form-control text-uppercase" name="start_date_civconstruct" required="required" readonly="readonly" value="<?php if($start_date_civconstruct!="0000-00-00" && $start_date_civconstruct!="") echo date("d-m-Y",strtotime($start_date_civconstruct)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
									<td width="25%">(b) Date of completion of the civil construction works :<span class="mandatory_field">*</span> </td>
									<td><input type="text" class="dobindia form-control text-uppercase" name="end_date_civconstruct" required="required" readonly="readonly" value="<?php if($end_date_civconstruct!="0000-00-00" && $end_date_civconstruct!="") echo date("d-m-Y",strtotime($end_date_civconstruct)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
								</tr>
								<tr>
									<td width="25%">(c) Total area under construction : </td>
									<td width="25%"><input type="text" class="text-uppercase form-control" name="tot_area_underconstruct" validate="onlyNumbers" value="<?php echo $tot_area_underconstruct;?>"></td>
									<td width="25%">(d) Total cost of construction, site development etc :</td>
									<td width="25%"><input type="text" class="text-uppercase form-control" name="tot_cost_construct" validate="onlyNumbers" value="<?php echo $tot_cost_construct;?>"></td>
								</tr>
								<tr>
									<td colspan="3">(e) Cost of construction and area of the building connected directly to manufacturing process/ service rendered : </td>
									<td width="25%"><input type="text" class="text-uppercase form-control" name="cost_manufacturing" validate="onlyNumbers" value="<?php echo $cost_manufacturing;?>"></td>
								</tr><tr>
									<td colspan="4">II. If the building has been allotted by the Government agency/ taken on rent from private party:</td>
								</tr>
								<tr>
									<td colspan="4">(a) Name &amp; address of the Govt agency/ landlord</td>
								</tr>
								<tr>
									<td>Name of Govt Agency</td>
									<td><input type="text" class="form-control text-uppercase" validate="letters" name="agency[name]" value="<?php echo $agency_name;?>"></td>
								</tr>
								<tr>
									<td colspan="4"> Address</td>
								</tr>
								<tr>
									<td width="25%">Street Name 1</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="agency[sn1]" value="<?php echo $agency_sn1;?>"></td>
									<td width="25%">Street Name 2</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="agency[sn2]" value="<?php echo $agency_sn2;?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="agency[vill]" value="<?php echo $agency_vill;?>"></td>
									<td>District</td>
                                    <td><input type="text" class="form-control text-uppercase" name="agency[dist]" value="<?php echo $agency_dist;?>"></td>
									
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" name="agency[pincode]" value="<?php echo $agency_pincode;?>" validate="pincode" maxlength="6"></td>
									<td>Mobile No.</td>
									<td><input type="text" class="form-control text-uppercase" name="agency[mobile]" value="<?php echo $agency_mobile;?>" validate="mobileNumber" maxlength="10"></td>
								</tr>	
								<tr>
									<td>E-Mail ID</td>
									<td><input type="email" class="form-control" name="agency[email]" value="<?php echo $agency_email;?>"></td>
									<td></td>
									<td></td>
								</tr>		
								<tr>
									<td width="25%">(b) Total covered area : </td>
									<td width="25%"><input type="text" class="text-uppercase form-control" name="agency_area_covered" validate="onlyNumbers" value="<?php echo $agency_area_covered;?>"></td>
									<td width="25%">(c) Annual rent :</td>
									<td width="25%"><input type="text" class="text-uppercase form-control" validate="onlyNumbers" name="agency_annual_rent" value="<?php echo $agency_annual_rent;?>"></td>
								</tr>
								<tr>
									<td colspan="4">(d) No &amp; date of registration of the rent agreement/ lease deed and address of the registering authority.</td>
								</tr>
								<tr>
									<td>Registration Number :</td>
									<td><input type="text" class="form-control text-uppercase" name="agency_regnum" value="<?php echo $agency_regnum; ?>"></td>
									<td>Registration Date :<span class="mandatory_field">*</span> </td>
									<td><input type="text" class="dobindia form-control text-uppercase" name="agency_regdate" required="required" readonly="readonly" value="<?php if($agency_regdate!="0000-00-00" && $agency_regdate!="") echo date("d-m-Y",strtotime($agency_regdate)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
								</tr>
								<tr>
									<td width="25%">Street Name 1</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="rent_auth[sn1]" value="<?php echo $rent_auth_sn1;?>"></td>
									<td width="25%">Street Name 2</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="rent_auth[sn2]" value="<?php echo $rent_auth_sn2;?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="rent_auth[vill]"  value="<?php echo $rent_auth_vill;?>"></td>
									<td>District</td>
                                    <td><input type="text" class="form-control text-uppercase" name="rent_auth[dist]"  value="<?php echo $rent_auth_dist;?>"></td>
									
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase"  name="rent_auth[pincode]" value="<?php echo $rent_auth_pincode;?>" validate="pincode" maxlength="6"></td>
									<td>Mobile No.</td>
									<td><input type="text" class="form-control text-uppercase" name="rent_auth[mobile]" value="<?php echo $rent_auth_mobile;?>" validate="mobileNumber" maxlength="10"></td>
								</tr>
								<tr>
									<td>E-Mail ID</td>
									<td><input type="email" class="form-control" name="rent_auth[email]" value="<?php echo $rent_auth_email;?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td>(e) Location :</td>
									<td><input type="text" class="form-control text-uppercase" name="agency_loc" value="<?php echo $agency_loc;?>"></td>
									<td>(f) Period of validity of rent agreement/ lease deed:</td>
									<td><input type="text" class="dobindia form-control text-uppercase" name="agency_lease_period" value="<?php if($agency_lease_period!="0000-00-00" && $agency_lease_period!="") echo date("d-m-Y",strtotime($agency_lease_period)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
								</tr>
								<tr>
									<td colspan="4">7. Details of Capital Investment (gross value in Rupees) :
									<table class="table table-responsive table-bordered" > 
										<thead>
										<tr>
											<th width="10%" class="text-center">Sl no.</th>
											<th width="60%" class="text-center">Item of fixed assets</th>
											<th width="30%" class="text-center">Value in Rupees</th>
										</tr>
										</thead>
										<tr>
											<td>a.</td>
											<td>Land </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[land]" value="<?php echo $capital_invest_land; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td>b.</td>
											<td>Site development </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[site]" value="<?php echo $capital_invest_site; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >c.</td>
											<td colspan="2" >Building </td>
										</tr>
										<tr>
											<td rowspan="2"></td>
											<td >i) Factory/ Institutional building and other civil construction works directly connected to process of manufacture/ service rendered  </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[factory]" value="<?php echo $capital_invest_factory; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											
											<td>ii) Office building, labour quarter etc no directly connected to process of manufacture/ service rendered (ineligible building) </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[office]" value="<?php echo $capital_invest_office; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >d.</td>
											<td>Plant and Machinery </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[plant]" value="<?php echo $capital_invest_plant; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >e.</td>
											<td>Equipment, accessories, components &amp; fittings etc </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[equipment]" value="<?php echo $capital_invest_equipment; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >f.</td>
											<td>Drawal of Power line </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[power]" value="<?php echo $capital_invest_power; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >g.</td>
											<td>Electrical Installation other than drawal of power line </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[electrical]" value="<?php echo $capital_invest_electrical; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >h.</td>
											<td>Utility installation other than electrical power </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[utility]" value="<?php echo $capital_invest_utility; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >i.</td>
											<td>Miscellaneous fixed assets (in details) </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[misc]" value="<?php echo $capital_invest_misc; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td >j.</td>
											<td>Preliminary and preoperative expenses capitalised </td>
											<td><input type="text" class="form-control text-uppercase capitalInv" name="capital_invest[operative]" value="<?php echo $capital_invest_operative; ?>" validate="onlyNumbers" /></td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td>Total </td>
											<td><input type="text" readonly="readonly" class="form-control text-uppercase" id="capitalInvTotal" name="capital_invest_total" value="<?php echo $capital_invest_total; ?>" /></td>
										</tr>
									</table>
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
							<table class="table table-responsive">
								<tr>
									<td colspan="4">8. Source of Finance</td>
								</tr>
								<tr>
									<td colspan="4">
									<table class="table table-responsive table-bordered" > 
										<tr>
											<th width="10%" class="text-center">Sl no.</th>
											<th width="60%" class="text-center">Source of Finance</th>
											<th width="30%" class="text-center">In Rupees</th>
										</tr>
										<tr>
											<td>a.</td>
											<td>Promoters contribution</td>
											<td><input type="text" class="form-control text-uppercase financeSource" name="sources_f_finance[a]" value="<?php echo $sources_f_finance_a; ?>" validate="onlyNumbers" ></td>
										</tr>
										<tr>
											<td>b.</td>
											<td>Govt contribution as seed money/ share capital etc</td>
											<td><input type="text" class="form-control text-uppercase financeSource" name="sources_f_finance[b]" value="<?php echo $sources_f_finance_b; ?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td >c.</td>
											<td>Borrowing from Bank/ Financial Institution </td>
											<td><input type="text" class="form-control text-uppercase financeSource" name="sources_f_finance[c]" value="<?php echo $sources_f_finance_c; ?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td >d. </td>
											<td>Unsecured loan/ private finance </td>
											<td><input type="text" class="form-control text-uppercase financeSource" name="sources_f_finance[d]" value="<?php echo $sources_f_finance_d; ?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td >e.</td>
											<td>Any other sources </td>
											<td><input type="text" class="form-control text-uppercase financeSource" name="sources_f_finance[e]" value="<?php echo $sources_f_finance_e; ?>" validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td colspan="2">Total </td>
											<td><input type="text" readonly class="form-control text-uppercase" id="financeSourceTotal" name="sources_f_finance_total" value="<?php echo $sources_f_finance_total; ?>" validate="decimal"></td>
										</tr>
									</table></td>
								</tr>
								<tr>
									<td colspan="4">9.
									<table class="table table-responsive table-bordered"> 
										<tr>
											<th colspan="2" width="70%" class="text-center">Details of financial assistance received from Bank/ Financial Institution/ Govt organization etc.</th>
											<th width="30%" class="text-center">In Rupees</th>
										</tr>
										<tr>
											<td width="10%">a.</td>
											<td width="60%">Name(s) of the Financial Institution(s):</td>
											<td width="30"><input type="text" class="form-control text-uppercase" name="financial_details[name]" value="<?php echo $financial_details_name; ?>"></td>
										</tr>
										<tr>
											<td rowspan="3">b.</td>
											<td colspan="2">Amount sanctioned as :</td>
										</tr>
										<tr>
											<td>(i) Term Loan :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[term]" value="<?php echo $financial_details_term; ?>"  validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td>(ii) WC/ OD/ CC/ OCC/ Margin money contribution etc :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[margin]" value="<?php echo $financial_details_margin; ?>"  validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td rowspan="3">c. </td>
											<td>(i) Term Loan disbursed till date of application :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[t_loan]" value="<?php echo $financial_details_t_loan; ?>"  validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td>(ii) Rate of Interest on TL pa :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[rate]" value="<?php echo $financial_details_rate; ?>"  validate="onlyNumbers"></td>
										</tr>
										<tr>
											<td>(iii) Schedule of Repayment of TL (showing principal amount, Interest etc separately)  :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[schedule]" value="<?php echo $financial_details_schedule; ?>" validate="onlyNumbers" ></td>
										</tr>
										<tr>
											<td rowspan="3">d.</td>
											<td colspan="2">Letter no &amp; date of sanction of loan as  :</td>
											
										</tr>
										<tr>
											<td>(i) Term Loan :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[d1]" value="<?php echo $financial_details_d1; ?>" validate="onlyNumbers" ></td>
										</tr>
										<tr>
											<td>(ii) Working Capital etc :</td>
											<td><input type="text" class="form-control text-uppercase" name="financial_details[d2]" value="<?php echo $financial_details_d2; ?>" validate="onlyNumbers" ></td>
										</tr>
									</table></td>
								</tr>
								<tr>
									<td colspan="4">10.
									<table class="table table-responsive table-bordered"> 
										<tr>
											<th colspan="2" width="70%" class="text-center">Details of Power connection.</th>
											<th  width="30%" class="text-center"></th>
										</tr>
										<tr>
											<td colspan="4">a. Quantum, letter no and date of sanction:</td>
										</tr>
										<tr>
											<td rowspan="3"></td>
											<td>Quantum</td>
											<td><input type="text" class="form-control" name="details_f_power[qtm]" value="<?php echo $details_f_power_qtm; ?>"/></td>
										</tr>
										<tr>
											<td>Letter no</td>
											<td><input type="text" class="form-control " name="details_f_power[lno]" value="<?php echo $details_f_power_lno; ?>"/></td>
										</tr>
										<tr>
											<td>Date of sanction<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="details_f_power[dt]" required="required" value="<?php if($details_f_power_dt!="0000-00-00" && $details_f_power_dt!="") echo date("d-m-Y",strtotime($details_f_power_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td colspan="4">b. Connected electrical load and date of connection of power:</td>
										</tr>
										<tr>
											<td rowspan="2"></td>
											<td>Connected electrical load</td>
											<td><input type="text" class="form-control text-uppercase" name="details_f_power[con_load]" value="<?php echo $details_f_power_con_load; ?>"/></td>
										</tr>
										<tr>
											<td> Date of connection of power:<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="details_f_power[con_dt]" required="required" value="<?php if($details_f_power_con_dt!="0000-00-00" && $details_f_power_con_dt!="") echo date("d-m-Y",strtotime($details_f_power_con_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td >c.</td>
											<td>Serial no of energy meter(s) connected :</td>
											<td><input type="text" class="form-control text-uppercase" name="details_f_power[sl_no]" value="<?php echo $details_f_power_sl_no;?>"></td>
										</tr>
										<tr>
											<td >d.</td>
											<td>Estimated amount of ASEB for power connection with MR no and date of payment :</td>
											<td><input type="text" class="form-control text-uppercase" name="details_f_power[es_amt]" value="<?php echo $details_f_power_es_amt; ?>"></td>
										</tr>
										<tr>
											<td >e. </td>
											<td colspan="2">First ASEB Bill:</td>
											
										</tr>
										<tr>
											<td rowspan="4"></td>
											<td>i) Bill no:</td>
											<td><input type="text" class="form-control text-uppercase" name="aseb[bill_no]" value="<?php echo $aseb_bill_no; ?>"/></td>
										</tr>
										<tr>
											<td>ii) Bill Date :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="aseb[bill_date]" value="<?php if($aseb_bill_date!="0000-00-00" && $aseb_bill_date!="") echo date("d-m-Y",strtotime($aseb_bill_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"/></td>
										</tr>
										<tr>
											<td>(iii) MR no.</td>
											<td><input type="text" class="form-control text-uppercase" name="aseb[mr_no]" value="<?php echo $aseb_mr_no; ?>"/></td>
										</tr>
										<tr>
											<td>(iv) Date of payment  :<span class="mandatory_field">*</span> <span class="mandatory_field">*</span> </td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="aseb[date_payment]" required="required" value="<?php if($aseb_date_payment!="0000-00-00" && $aseb_date_payment!="") echo date("d-m-Y",strtotime($aseb_date_payment)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										</tr>
										<tr>
											<td >f.</td>
											<td>Total expenditure incurred for drawal of power line upto premises of the factory building (excluding load security deposited to ASEB)  :</td>
											<td><input type="text" class="form-control text-uppercase" name="pow_line_expen" value="<?php echo $pow_line_expen?>"/></td>
										</tr>
										<tr>
											<td >g.</td>
											<td>Details of DG installed, with rating:</td>
											<td><input type="text" class="form-control text-uppercase" name="dg_details" value="<?php echo $dg_details?>" /></td>
										</tr>
										<tr>
											<td >&nbsp;</td>
											<td>(a) Make :</td>
											<td><input type="text" class="form-control text-uppercase" name="dg_make" value="<?php echo $dg_make?>"/></td>
										</tr>
										<tr>
											<td >&nbsp;</td>
											<td>(b)Rating :</td>
											<td><input type="text" class="form-control text-uppercase" name="dg_rating" value="<?php echo $dg_rating?>" /></td>
										</tr>
										<tr>
											<td >&nbsp;</td>
											<td>(c)Cost of the DG set :</td>
											<td><input type="text" class="form-control text-uppercase" name="cost_of_dgset" value="<?php echo $cost_of_dgset?>"/></td>
										</tr>
										<tr>
											<td >&nbsp;</td>
											<td>(d) date of installation :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="installation_date" value="<?php if($installation_date!="0000-00-00" && $installation_date!="") echo date("d-m-Y",strtotime($installation_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly" /></td>
										</tr>
									</table>
								</td>
								</tr>
								<tr>
									<td colspan="2">11. Date of commencement of commercial production/ service rendered :<span class="mandatory_field">*</span> </td>
									<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="date_comm_prod" required="required" value="<?php if($date_comm_prod!="0000-00-00" && $date_comm_prod!="") echo date("d-m-Y",strtotime($date_comm_prod)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									<td width="25%"></td>
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
							<table class="table table-responsive table-bordered">
								<tr>
									<td width="25%">12. Details of the production/ service rendered :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="details_prod" value="<?php echo $details_prod; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th width="5%"  rowspan="2">Sl No</th>
											<th width="20%"  rowspan="2">Items</th>
											<th colspan="2" width="25%" >Annual Installed capacity</th>
											<th colspan="2" width="30%">Actual performance during the last accounting year/ since the date of commencement of production/ service to the date of submission of the application</th>
											<th width="20%"  rowspan="2">Remark</th>
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
											<td><input type="text" value="<?php echo $row_1["annual_quantity"]; ?>" validate="onlyNumbers" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_1["annual_rupees"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["actual_quantity"]; ?>" validate="onlyNumbers" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["actual_rupees"]; ?>" validate="onlyNumbers" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_1["remark"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>" size="20"></td>	
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
									<td colspan="4">13. Raw Materials/ consumables  :</td>
								</tr>
								<tr>
									<td colspan="4">(a) Utilisation of materials </td>
								</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center">
										<thead>
											<tr>
												<th width="5%" rowspan="2">Sl No</th>
												<th width="20%" rowspan="2">Items</th>
												<th colspan="2" width="25%">Annual requirement</th>
												<th colspan="2" width="30%">Utilisation during the last accounting year/ since the date of commencement of production/ service to the date of submission of the application</th>
												<th width="20%" rowspan="2">Remark</th>
											</tr>
											<tr>
												<th>Quantity</th>
												<th>Value (in Rupees)</th>
												<th>Quantity</th>
												<th>Value in Rupees</th>
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
											<td><input type="text" value="<?php echo $row_2["annual_quantity"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textC<?php echo $count;?>"></td>											
											<td><input type="text" value="<?php echo $row_2["annual_rupees"]; ?>" validate="onlyNumbers" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["utlised_quantity"]; ?>" validate="onlyNumbers" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["utlised_rupees"]; ?>" validate="onlyNumbers" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>" size="20"></td>
											<td><input type="text" value="<?php echo $row_2["remark"]; ?>"  id="textG<?php echo $count;?>" class="form-control text-uppercase" name="textG<?php echo $count;?>" size="20"></td>	
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
										<td><input type="text" id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>
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
									<td colspan="4">(b) Source(s) of materials :</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable3" id="objectTable3" class="table table-responsive table-bordered text-center">
										<thead>
											<tr>
												<th width="5%" rowspan="2">Sl No</th>
												<th width="20%" rowspan="2">Items</th>
												<th width="25%" rowspan="2">Whether the source of supply is within Assam/ out side Assam</th>
												<th width="50%" colspan="2">Name and address of the supplier of principal raw materials/ consumables</th>
											</tr>
											<tr>
												<th>Name</th>
												<th>Address</th>
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
											<td><input type="text" value="<?php echo $row_3["item"]; ?>" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_3["source"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txxtC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_3["name"]; ?>"  id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>" size="20" validate="letters"></td>						
											<td><input type="text" value="<?php echo $row_3["address"]; ?>"  id="txxtE<?php echo $count;?>" class="form-control text-uppercase" name="txxtE<?php echo $count;?>" size="20"></td>						
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA1"></td>
										<td><input type="text" id="txxtB1" size="20" class="form-control text-uppercase" name="txxtB1"></td>
										<td><input type="text" id="txxtC1" size="20" class="form-control text-uppercase"  name="txxtC1"></td>					
										<td><input type="text" id="txxtD1" size="20" class="form-control text-uppercase"  name="txxtD1" validate="letters"></td>
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
									<td colspan="4"> 14. Details of Sale of finished product(s)/ Service(s) rendered  :</td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable4" id="objectTable4" class="table table-responsive table-bordered text-center" >
										<thead>
											<tr>
												<th width="5%" rowspan="3">Sl No</th>
												<th width="20%" rowspan="3">Items</th>
												<th colspan="4" width="45%">Product(s)/ Service(s) sold during the last accounting year/ since the date of commencement of commercial production/ service to the date of submission of application</th>
												<th width="20%" rowspan="3">Remark</th>
											</tr>
											<tr>
												
												<th colspan="2">Within the State of Assam</th>
												<th colspan="2">Outside the State of Assam</th>
											</tr>
											<tr>
											   <th align="center">Quantity</th>
											   <th align="center">Value (in Rupees)</th>
											   <th align="center">Quantity</th>
											   <th align="center">Value in Rupees</th>
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
											<td><input type="text" value="<?php echo $row_4["item"]; ?>" id="txttB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttB<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_4["within_assam_quantity"]; ?>" validate="onlyNumbers" id="txttC<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txttC<?php echo $count;?>"></td>
											<td><input type="text" value="<?php echo $row_4["within_assam_rupees"]; ?>" validate="onlyNumbers" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="20"></td>				
											<td><input type="text" value="<?php echo $row_4["outside_assam_quantity"]; ?>" validate="onlyNumbers" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="20"></td>				
											<td><input type="text" value="<?php echo $row_4["outside_assam_rupees"]; ?>"  id="txttF<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" name="txttF<?php echo $count;?>" size="20"></td>				
											<td><input type="text" value="<?php echo $row_4["remarks"]; ?>"  id="txttG<?php echo $count;?>" class="form-control text-uppercase" name="txttG<?php echo $count;?>" size="20"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input type="text" value="1" readonly id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
										<td><input type="text" id="txttB1" size="20" class="form-control text-uppercase" name="txttB1"></td>
										<td><input type="text" id="txttC1" size="20" class="form-control text-uppercase"  name="txttC1"></td>					
										<td><input type="text" id="txttD1" size="20" class="form-control text-uppercase"  name="txttD1" validate="onlyNumbers"></td>
										<td><input type="text" id="txttE1" size="20" class="form-control text-uppercase"  name="txttE1"></td>
										<td><input type="text" id="txttF1" size="20" class="form-control text-uppercase"  name="txttF1" validate="onlyNumbers"></td>
										<td><input type="text" id="txttG1" size="20" class="form-control text-uppercase"  name="txttG1"></td>
									</tr>
									<?php } ?>
									</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction4()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore4()" value="">Add More</button>
										<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
									</td>
								</tr>			
								<tr>
									<td colspan="4">15. Employment generation</td>
								</tr>
								<tr>
									<td colspan="4">(a)Regular employment</td>
								</tr>
								<tr>
									<td colspan="4">
										<table class="tabel table-responsive table-bordered text-center">
											<thead>
												<tr>
													<th width="5%" rowspan="2">Sl no. </th>
													<th width="20%" rowspan="2">Category 	</th>
													<th colspan="2" width="40">No of employees, who are </th>
													<th width="15%" rowspan="2">Total </th>
													<th width="20%" rowspan="2"> Remarks  </th>
												</tr>
												<tr>
													<th>People of Assam </th>
													<th>People not belonging to Assam  </th>
												</tr>
											</thead>	
											<tr>
												<td>I</td>
												<td>Managerial </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="managerial[assam]"  value="<?php echo $managerial_assam;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="managerial[outsiders]"  value="<?php echo $managerial_outsiders;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="managerial[total]"  value="<?php echo $managerial_total;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" name="managerial[remarks]" value="<?php echo $managerial_remarks;?>"></td>
											</tr>
											<tr>
												<td>II</td>
												<td>Supervisory </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="supervisory[assam]"  value="<?php echo $supervisory_assam;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="supervisory[outsiders]"  value="<?php echo $supervisory_outsiders;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="supervisory[total]"  value="<?php echo $supervisory_total;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="supervisory[remarks]"  value="<?php echo $supervisory_remarks;?>"></td>
											</tr>
											<tr>
												<td>III  </td>
												<td>Skilled    </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="skilled[assam]"  value="<?php echo $skilled_assam;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="skilled[outsiders]"  value="<?php echo $skilled_outsiders;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="skilled[total]"  value="<?php echo $skilled_total;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="skilled[remarks]"  value="<?php echo $skilled_remarks;?>"></td>
											</tr>
											<tr>
												<td> IV</td>
												<td>Semi-Skilled </td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="semi_skilled[assam]"  value="<?php echo $semi_skilled_assam;?>"></td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="semi_skilled[outsiders]"  value="<?php echo $semi_skilled_outsiders;?>"></td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="semi_skilled[total]"  value="<?php echo $semi_skilled_total;?>"></td>
												<td><input type="text" class="form-control text-uppercase"  name="semi_skilled[remarks]"  value="<?php echo $semi_skilled_remarks;?>"></td>
											</tr>
											<tr>
												<td>V  </td>
												<td>Unskilled &amp; others    </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="unskilled[assam]"  value="<?php echo $unskilled_assam;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="unskilled[outsiders]"  value="<?php echo $unskilled_outsiders;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="unskilled[total]"  value="<?php echo $unskilled_total;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="unskilled[remarks]"  value="<?php echo $unskilled_remarks;?>"></td>
											</tr>
											<tr>
												<td colspan="2">Total </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_assam" value="<?php echo $total_assam;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_outsiders" value="<?php echo $total_outsiders;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="gross_total" value="<?php echo $gross_total;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="gross_remarks" value="<?php echo $gross_remarks;?>"></td>
											</tr>
										</table>
									</td>
								</tr>								
								<tr>
									<td colspan="4">(b) Casual employment  :</td>
								</td>
								<tr>
									<td>i) Average mandays utilized per month :   </td>
									<td width="25%"><input  type="text" class="form-control text-uppercase"  name="utilized_mandays" validate="onlyNumbers" value="<?php echo $utilized_mandays;?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">16.Incentives applied for  </td>
								</tr>
								<tr>
									<td colspan="4">
									<table name="objectTable5" id="objectTable5" class="table table-responsive table-bordered text-center">
										<thead>
											<tr>
												<th width="5%">Sl No</th>
												<th width="45%">Name of the incentive(s) </th>
												<th width="50%">Remarks</th>
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
											<td><input value="<?php echo $row_5["name"]; ?>" id="ttxtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="ttxtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_5["quantity"]; ?>"  id="ttxtC<?php echo $count;?>" class="form-control text-uppercase" name="ttxtC<?php echo $count;?>" size="20"></td>		
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="ttxtA1" size="1" class="form-control text-uppercase" name="ttxtA1"></td>
											<td><input id="ttxtB1" size="20" class="form-control text-uppercase" name="ttxtB1"></td>
											<td><input  id="ttxtC1" size="20" class="form-control text-uppercase"  name="ttxtC1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction5()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore5()" value="">Add More</button>
										<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td>
										Place :&nbsp;<b><?php echo strtoupper($dist); ?></b><br/>
										Date :&nbsp;<b><?php echo date('d-m-Y',strtotime($today)); ?></b> 
									</td>
									<td></td>
									<td></td>
									<td align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
								</tr>																					
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=3" type="button" class="btn btn-primary">Go Back &amp; Edit</a>
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
<script>
	$('.capitalInv').on('change', function(){
		var sum1=0;
		$('.capitalInv').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum1 = sum1 + parseInt($(this).val());
			}
			$('#capitalInvTotal').val(sum1);
		});		
	});
	$('.financeSource').on('change', function(){
		var sum2=0;
		$('.financeSource').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum2 = sum2 + parseInt($(this).val());
			}
			$('#financeSourceTotal').val(sum2);
		});		
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>