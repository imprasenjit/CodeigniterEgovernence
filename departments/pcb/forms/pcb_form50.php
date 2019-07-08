<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="50";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";

	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b, ".$table_name."_part2 c, ".$table_name."_upload d where a.user_id='$swr_id' and a.active='1' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id");
if($q->num_rows<1){	
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b, ".$table_name."_part2 c, ".$table_name."_upload d where a.user_id='$swr_id' and a.active='1' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id ORDER BY a.form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results["form_id"];
		
		/***********PART 1********/
		$revenue_survey_no=$results["revenue_survey_no"];$lb_name=$results["lb_name"];$lb_auth_name=$results["lb_auth_name"];$md_name=$results["md_name"];$is_registered=$results["is_registered"];$reg_no=$results["reg_no"];$reg_date=$results["reg_date"];$dg_set=$results["dg_set"];$from_year=$results["from_year"];$to_year=$results["to_year"];	
		
		if(!empty($results["plan_details"])){				
			$plan_details=json_decode($results["plan_details"]);
			$plan_details_prn=$plan_details->prn;$plan_details_dt=$plan_details->dt;$plan_details_ia=$plan_details->ia;			
		}else{
			$plan_details_prn="";$plan_details_dt="";$plan_details_ia="";
		}
		if(!empty($results["md_address"])){				
			$md_address=json_decode($results["md_address"]);
			$m_desig=$md_address->desig;$m_sn1=$md_address->st1;$m_sn2=$md_address->st2;$m_v=$md_address->vill;$m_d=$md_address->dist;$m_p=$md_address->pin;$m_m=$md_address->mn;$m_phn=$md_address->phn;$m_e=$md_address->email;				
		}else{
			$m_desig="";$m_sn1="";$m_sn2="";$m_v="";$m_d="";$m_p="";$m_m="";$m_phn="";$m_e="";
		}		
		/******PART 2********/	
		$wb_name=$results["wb_name"];$loc_feedback=$results["loc_feedback"];$is_situated=$results["is_situated"];$is_provided=$results["is_provided"];$is_use=$results["is_use"];$staff_nos=$results["staff_nos"];$is_res_colony=$results["is_res_colony"];
		if(!is_numeric($results["investment_cost"]) && !empty($results["investment_cost"])){
			$investment_cost=json_decode($results["investment_cost"]);
			$investment_cost_a=$investment_cost->a;$investment_cost_b=$investment_cost->b;
			$investment_cost_b=($investment_cost_b=="C")?'0000000':'00000';
			$investment_cost=$investment_cost_a.$investment_cost_b;
		}else{
			$investment_cost=$results["investment_cost"];
		}
		if(!empty($results["site_distance"])){
			$site_distance=json_decode($results["site_distance"]);
			$site_distance_a=$site_distance->a;$site_distance_b=$site_distance->b;
		}else{
			$site_distance_a="";$site_distance_b="";
		}
		if(!empty($results["total_plot_area"])){
			$total_area=json_decode($results["total_plot_area"]);
			$total_area_pa=$total_area->pa;$total_area_pau=$total_area->pau;$total_area_ba=$total_area->ba;$total_area_bau=$total_area->bau;$total_area_sa=$total_area->sa;$total_area_sau=$total_area->sau;
		}else{
			$total_area_pa="";$total_area_pau="";$total_area_ba="";$total_area_bau="";$total_area_sa="";$total_area_sau="";
		}
		
		if(!empty($results["commission_my"])){
			$commission_my=json_decode($results["commission_my"]);
			$commission_my_m=$commission_my->m;$commission_my_y=$commission_my->y;
		}else{
			$commission_my_m="";$commission_my_y="";
		}
		if(!empty($results["colony_details"])){
			$colony_details=json_decode($results["colony_details"]);
			$colony_details_pop=$colony_details->pop;$colony_details_loc=$colony_details->loc;$colony_details_dis=$colony_details->dis;
		}else{
			$colony_details_pop="";$colony_details_loc="";$colony_details_dis="";
		}
		/******** PART 3*********************/		
		$sewage_treatment=$results["sewage_treatment"];			
		if(!empty($results["wc_values"])){
			$wc_values=json_decode($results["wc_values"]);
			$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;$wc_values_f=$wc_values->f;
		}else{
			$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";$wc_values_f="";
		}
		if(!empty($results["water_source"])){
			$water_source=json_decode($results["water_source"]);
			$water_source_a=$water_source->a;$water_source_b=$water_source->b;$water_source_c=$water_source->c;
		}else{
			$water_source_a="";$water_source_b="";$water_source_c="";
		}
		if(!empty($results["budget_calc"])){
			$budget_calc=json_decode($results["budget_calc"]);
			$budget_calc_a=$budget_calc->a;
		}else{
			$budget_calc_a="";
		}
		if(!empty($results["ww_qty"])){
			$ww_qty=json_decode($results["ww_qty"]);
			$ww_qty_a=$ww_qty->a;$ww_qty_b=$ww_qty->b;$ww_qty_c=$ww_qty->c;$ww_qty_d=$ww_qty->d;$ww_qty_e=$ww_qty->e;$ww_qty_f=$ww_qty->f;$ww_qty_g=$ww_qty->g;			
		}else{
			$ww_qty_a="";$ww_qty_b="";$ww_qty_c="";$ww_qty_d="";$ww_qty_e="";$ww_qty_f="";$ww_qty_g="";
		}
		/******** PART 4*********************/		
		$is_mixed=$results["is_mixed"];$yes_detail=$results["yes_detail"];$effluents_quality=$results["effluents_quality"];$sump_capacity=$results["sump_capacity"];	
		if(!empty($results["sump_capacity"])){
			$sump_capacity=json_decode($results["sump_capacity"]);
			$sump_capacity_a=$sump_capacity->a;$sump_capacity_b=$sump_capacity->b;
		}else{
			$sump_capacity_a="";$sump_capacity_b="";
		}				
		if(!empty($results["disposal_mode"])){
			$disposal_mode=json_decode($results["disposal_mode"]);
			$disposal_mode_a=$disposal_mode->a;$disposal_mode_b=$disposal_mode->b;$disposal_mode_c=$disposal_mode->c;$disposal_mode_d=$disposal_mode->d;$disposal_mode_e=$disposal_mode->e;$disposal_mode_f=$disposal_mode->f;$disposal_mode_g=$disposal_mode->g;$disposal_mode_h=$disposal_mode->h;$disposal_mode_i=$disposal_mode->i;$disposal_mode_j=$disposal_mode->j;
		}else{
			$disposal_mode_a="";$disposal_mode_b="";$disposal_mode_c="";$disposal_mode_d="";$disposal_mode_e="";$disposal_mode_f="";$disposal_mode_g="";$disposal_mode_h="";$disposal_mode_i="";$disposal_mode_j="";$disposal_mode_k="";
		}	
		if(!empty($results["effluents_quality"])){
			$effluents_quality=json_decode($results["effluents_quality"]);
			$effluents_quality_a=$effluents_quality->a;$effluents_quality_b=$effluents_quality->b;$effluents_quality_c=$effluents_quality->c;$effluents_quality_d=$effluents_quality->d;$effluents_quality_e=$effluents_quality->e;$effluents_quality_f=$effluents_quality->f;
		}else{
			$effluents_quality_a="";$effluents_quality_b="";$effluents_quality_c="";$effluents_quality_d="";$effluents_quality_e="";$effluents_quality_f="";
		}
		/******** PART 5*********************/		
		$is_odoriferous=$results["is_odoriferous"];$is_adq_facility=$results["is_adq_facility"];
		//echo $results["fuel_consumption"]; die();
		if(!empty($results["fuel_consumption"])){
			$fc=json_decode($results["fuel_consumption"]);
			$fc_tpd=$fc->tpd;$fc_cv=$fc->cv;$fc_ac=$fc->ac;$fc_sc=$fc->sc;$fc_ot=$fc->ot;
			$fc_tpd_cl=$fc_tpd->cl;$fc_tpd_ls=$fc_tpd->ls;$fc_tpd_fo=$fc_tpd->fo;$fc_tpd_ng=$fc_tpd->ng;$fc_tpd_ot=$fc_tpd->ot;
			$fc_cv_cl=$fc_cv->cl;$fc_cv_ls=$fc_cv->ls;$fc_cv_fo=$fc_cv->fo;$fc_cv_ng=$fc_cv->ng;$fc_cv_ot=$fc_cv->ot;
			$fc_ac_cl=$fc_ac->cl;$fc_ac_ls=$fc_ac->ls;$fc_ac_fo=$fc_ac->fo;$fc_ac_ng=$fc_ac->ng;$fc_ac_ot=$fc_ac->ot;
			$fc_sc_cl=$fc_sc->cl;$fc_sc_ls=$fc_sc->ls;$fc_sc_fo=$fc_sc->fo;$fc_sc_ng=$fc_sc->ng;$fc_sc_ot=$fc_sc->ot;
			$fc_ot_cl=$fc_ot->cl;$fc_ot_ls=$fc_ot->ls;$fc_ot_fo=$fc_ot->fo;$fc_ot_ng=$fc_ot->ng;$fc_ot_ot=$fc_ot->ot;$fc_ot_sp1=$fc_ot->sp1;$fc_ot_sp2=$fc_ot->sp2;
		}else{
			$fc_tpd_cl="";$fc_tpd_ls="";$fc_tpd_fo="";$fc_tpd_ng="";$fc_tpd_ot="";
			$fc_cv_cl="";$fc_cv_ls="";$fc_cv_fo="";$fc_cv_ng="";$fc_cv_ot="";
			$fc_ac_cl="";$fc_ac_ls="";$fc_ac_fo="";$fc_ac_ng="";$fc_ac_ot="";
			$fc_sc_cl="";$fc_sc_ls="";$fc_sc_fo="";$fc_sc_ng="";$fc_sc_ot="";
			$fc_ot_cl="";$fc_ot_ls="";$fc_ot_fo="";$fc_ot_ng="";$fc_ot_ot="";$fc_ot_sp1="";$fc_ot_sp2="";
		}
		if(!empty($results["stack_details"])){
			$sd=json_decode($results["stack_details"]);				
			$sd_at=$sd->at;$sd_ca=$sd->ca;$sd_ft=$sd->ft;$sd_fq=$sd->fq;$sd_mc=$sd->mc;$sd_sh=$sd->sh;$sd_gl=$sd->gl;$sd_ds=$sd->ds;$sd_gq=$sd->gq;$sd_gt=$sd->gt;$sd_gv=$sd->gv;$sd_ce=$sd->ce;			
			$sd_at_sn1=$sd_at->sn1;$sd_at_sn2=$sd_at->sn2;$sd_at_sn3=$sd_at->sn3;$sd_at_sn4=$sd_at->sn4;
			$sd_ca_sn1=$sd_ca->sn1;$sd_ca_sn2=$sd_ca->sn2;$sd_ca_sn3=$sd_ca->sn3;$sd_ca_sn4=$sd_ca->sn4;
			$sd_ft_sn1=$sd_ft->sn1;$sd_ft_sn2=$sd_ft->sn2;$sd_ft_sn3=$sd_ft->sn3;$sd_ft_sn4=$sd_ft->sn4;
			$sd_fq_sn1=$sd_fq->sn1;$sd_fq_sn2=$sd_fq->sn2;$sd_fq_sn3=$sd_fq->sn3;$sd_fq_sn4=$sd_fq->sn4;
			$sd_mc_sn1=$sd_mc->sn1;$sd_mc_sn2=$sd_mc->sn2;$sd_mc_sn3=$sd_mc->sn3;$sd_mc_sn4=$sd_mc->sn4;
			$sd_sh_sn1=$sd_sh->sn1;$sd_sh_sn2=$sd_sh->sn2;$sd_sh_sn3=$sd_sh->sn3;$sd_sh_sn4=$sd_sh->sn4;
			$sd_gl_sn1=$sd_gl->sn1;$sd_gl_sn2=$sd_gl->sn2;$sd_gl_sn3=$sd_gl->sn3;$sd_gl_sn4=$sd_gl->sn4;
			$sd_ds_sn1=$sd_ds->sn1;$sd_ds_sn2=$sd_ds->sn2;$sd_ds_sn3=$sd_ds->sn3;$sd_ds_sn4=$sd_ds->sn4;
			$sd_gq_sn1=$sd_gq->sn1;$sd_gq_sn2=$sd_gq->sn2;$sd_gq_sn3=$sd_gq->sn3;$sd_gq_sn4=$sd_gq->sn4;
			$sd_gt_sn1=$sd_gt->sn1;$sd_gt_sn2=$sd_gt->sn2;$sd_gt_sn3=$sd_gt->sn3;$sd_gt_sn4=$sd_gt->sn4;
			$sd_gv_sn1=$sd_gv->sn1;$sd_gv_sn2=$sd_gv->sn2;$sd_gv_sn3=$sd_gv->sn3;$sd_gv_sn4=$sd_gv->sn4;
			$sd_ce_sn1=$sd_ce->sn1;$sd_ce_sn2=$sd_ce->sn2;$sd_ce_sn3=$sd_ce->sn3;$sd_ce_sn4=$sd_ce->sn4;
		}else{
			$sd_at_sn1="";$sd_at_sn2="";$sd_at_sn3="";$sd_at_sn4="";
			$sd_ca_sn1="";$sd_ca_sn2="";$sd_ca_sn3="";$sd_ca_sn4="";
			$sd_ft_sn1="";$sd_ft_sn2="";$sd_ft_sn3="";$sd_ft_sn4="";
			$sd_fq_sn1="";$sd_fq_sn2="";$sd_fq_sn3="";$sd_fq_sn4="";
			$sd_mc_sn1="";$sd_mc_sn2="";$sd_mc_sn3="";$sd_mc_sn4="";
			$sd_sh_sn1="";$sd_sh_sn2="";$sd_sh_sn3="";$sd_sh_sn4="";
			$sd_gl_sn1="";$sd_gl_sn2="";$sd_gl_sn3="";$sd_gl_sn4="";
			$sd_ds_sn1="";$sd_ds_sn2="";$sd_ds_sn3="";$sd_ds_sn4="";
			$sd_gq_sn1="";$sd_gq_sn2="";$sd_gq_sn3="";$sd_gq_sn4="";
			$sd_gt_sn1="";$sd_gt_sn2="";$sd_gt_sn3="";$sd_gt_sn4="";
			$sd_gv_sn1="";$sd_gv_sn2="";$sd_gv_sn3="";$sd_gv_sn4="";
			$sd_ce_sn1="";$sd_ce_sn2="";$sd_ce_sn3="";$sd_ce_sn4="";
		}
		/******** PART 6*********************/		
		$is_hazardous=$results["is_hazardous"];$haz_cat_no=$results["haz_cat_no"];$haz_qty=$results["haz_qty"];$storage_mode=$results["storage_mode"];$haz_pres_treatment=$results["haz_pres_treatment"];			
		if(!empty($results["auth_req"])){
			$auth_req=json_decode($results["auth_req"]);
			if(isset($auth_req->a)) $auth_req_a=$auth_req->a; else $auth_req_a="";
			if(isset($auth_req->b)) $auth_req_b=$auth_req->b; else $auth_req_b="";
			if(isset($auth_req->c)) $auth_req_c=$auth_req->c; else $auth_req_c="";
			if(isset($auth_req->d)) $auth_req_d=$auth_req->d; else $auth_req_d="";
			if(isset($auth_req->e)) $auth_req_e=$auth_req->e; else $auth_req_e="";
			if(isset($auth_req->f)) $auth_req_f=$auth_req->f; else $auth_req_f="";
		}else{
			$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";$auth_req_e="";$auth_req_f="";
		}
		if(!empty($results["haz_qty_dispose"])){
			$haz_qty_dispose=json_decode($results["haz_qty_dispose"]);
			$haz_qty_dispose_a=$haz_qty_dispose->a;$haz_qty_dispose_b=$haz_qty_dispose->b;$haz_qty_dispose_d=$haz_qty_dispose->d;$haz_qty_dispose_e=$haz_qty_dispose->e;
		}else{
			$haz_qty_dispose_a="";$haz_qty_dispose_b="";$haz_qty_dispose_d="";$haz_qty_dispose_e="";
		}
		/******** PART 7*********************/		
		$is_sys_upg=$results["is_sys_upg"];$sys_upg_details=$results["sys_upg_details"];$nonhaz_details=$results["nonhaz_details"];$haz_chemicals=$results["haz_chemicals"];$other_info=$results["other_info"];$public_hearing_doc=$results["public_hearing_doc"];if(!empty($results["haz_chemicals_details"])){
			$haz_chemicals_details=json_decode($results["haz_chemicals_details"]);
			if(isset($haz_chemicals_details->a)) $haz_chemicals_details_a=$haz_chemicals_details->a; else $haz_chemicals_details_a="";
			if(isset($haz_chemicals_details->b)) $haz_chemicals_details_b=$haz_chemicals_details->b; else $haz_chemicals_details_b="";
			if(isset($haz_chemicals_details->c)) $haz_chemicals_details_c=$haz_chemicals_details->c; else $haz_chemicals_details_c="";
			if(isset($haz_chemicals_details->d)) $haz_chemicals_details_d=$haz_chemicals_details->d; else $haz_chemicals_details_d="";
			if(isset($haz_chemicals_details->e)) $haz_chemicals_details_e=$haz_chemicals_details->e; else $haz_chemicals_details_e="";
			if(isset($haz_chemicals_details->f)) $haz_chemicals_details_f=$haz_chemicals_details->f; else $haz_chemicals_details_f="";
			if(isset($haz_chemicals_details->g)) $haz_chemicals_details_g=$haz_chemicals_details->g; else $haz_chemicals_details_g="";
			if(isset($haz_chemicals_details->h)) $haz_chemicals_details_h=$haz_chemicals_details->h; else $haz_chemicals_details_h="";
		}else{
			$haz_chemicals_details_a="";$haz_chemicals_details_b="";$haz_chemicals_details_c="";$haz_chemicals_details_d="";$haz_chemicals_details_e="";$haz_chemicals_details_f="";$haz_chemicals_details_g="";$haz_chemicals_details_h="";
		}
		if(!empty($results["to_which"])){
			$to_which=json_decode($results["to_which"]);
			if(isset($to_which->a)) $to_which_a=$to_which->a; else $to_which_a="";
			if(isset($to_which->b)) $to_which_b=$to_which->b; else $to_which_b="";
			if(isset($to_which->c)) $to_which_c=$to_which->c; else $to_which_c="";
			if(isset($to_which->d)) $to_which_d=$to_which->d; else $to_which_d="";
			if(isset($to_which->e)) $to_which_e=$to_which->e; else $to_which_e="";
			if(isset($to_which->f)) $to_which_f=$to_which->f; else $to_which_f="";
			if(isset($to_which->g)) $to_which_g=$to_which->g; else $to_which_g="";
			if(isset($to_which->h)) $to_which_h=$to_which->h; else $to_which_h="";
			if(isset($to_which->i)) $to_which_i=$to_which->i; else $to_which_i="";
			if(isset($to_which->j)) $to_which_j=$to_which->j; else $to_which_j="";
			if(isset($to_which->k)) $to_which_k=$to_which->k; else $to_which_k="";
			if(isset($to_which->l)) $to_which_l=$to_which->l; else $to_which_l="";			
		}else{
			$to_which_a="";$to_which_b="";$to_which_c="";$to_which_d="";$to_which_e="";$to_which_f="";$to_which_g="";$to_which_h="";$to_which_i="";$to_which_j="";$to_which_k="";$to_which_l="";
		}
		if(!empty($results["dgset_items"])){
			$dgset_items=json_decode($results["dgset_items"]);
			$dgset_items_a=$dgset_items->a;$dgset_items_b=$dgset_items->b;$dgset_items_c=$dgset_items->c;$dgset_items_d=$dgset_items->d;
		}else{
			$dgset_items_a="";$dgset_items_b="";$dgset_items_c="";$dgset_items_d="";
		}
	}else{		
		$form_id="";$lb_name="";$lb_auth_name="";
		$md_name="";$md_address="";$is_registered="";$reg_no="";$reg_date="";
		$u_rsn="";$u_fax_std="";$u_fax_no="";
		$m_desig="";$m_sn1="";$m_sn2="";$m_v="";$m_d="";$m_p="";$m_m="";$m_phn="";$m_e="";
		$revenue_survey_no="";$plan_details_prn="";$plan_details_dt="";$plan_details_ia="";$from_year="";$to_year="";	
		//part2
		$wb_name="";$loc_feedback="";$is_situated="";$is_provided="";$is_use="";$staff_nos="";$is_res_colony="";
		$investment_cost="";
		$dgset_items_a="";$dgset_items_b="";$dgset_items_c="";$dgset_items_d="";
		$site_distance_a="";$site_distance_b="";$total_area_pa="";$total_area_pau="";$total_area_ba="";$total_area_bau="";$total_area_sa="";$total_area_sau="";$commission_my_m="";$commission_my_y="";$colony_details_pop="";$colony_details_loc="";$colony_details_dis="";
		//part3
		$sump_capacity_radio="";
		$sump_capacity="";
		$sewage_treatment="";$is_mixed="";$yes_detail="";$sump_capacity_radio="";
		$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";$wc_values_f="";$water_source_a="";$water_source_b="";$water_source_c="";$budget_calc_a="";$ww_qty_a="";$ww_qty_b="";$ww_qty_c="";$ww_qty_d="";$ww_qty_e="";$ww_qty_f="";$ww_qty_g="";$sump_capacity_a="";$sump_capacity_b="";$disposal_mode_a="";$disposal_mode_b="";$disposal_mode_c="";$disposal_mode_d="";$disposal_mode_e="";$disposal_mode_f="";$disposal_mode_g="";$disposal_mode_h="";$disposal_mode_i="";$disposal_mode_j="";$disposal_mode_k="";$effluents_quality_a="";$effluents_quality_b="";$effluents_quality_c="";$effluents_quality_d="";$effluents_quality_e="";$effluents_quality_f="";$is_odoriferous="";$is_adq_facility="";$fc_tpd_cl="";$fc_tpd_ls="";$fc_tpd_fo="";$fc_tpd_ng="";$fc_tpd_ot="";$fc_cv_cl="";$fc_cv_ls="";$fc_cv_fo="";$fc_cv_ng="";$fc_cv_ot="";$fc_ac_cl="";$fc_ac_ls="";$fc_ac_fo="";$fc_ac_ng="";$fc_ac_ot="";$fc_sc_cl="";$fc_sc_ls="";$fc_sc_fo="";$fc_sc_ng="";$fc_sc_ot="";$fc_ot_cl="";$fc_ot_ls="";$fc_ot_fo="";$fc_ot_ng="";$fc_ot_ot="";$fc_ot_sp1="";$fc_ot_sp2="";$sd_at_sn1="";$sd_at_sn2="";$sd_at_sn3="";$sd_at_sn4="";
		$sd_ca_sn1="";$sd_ca_sn2="";$sd_ca_sn3="";$sd_ca_sn4="";
		$sd_ft_sn1="";$sd_ft_sn2="";$sd_ft_sn3="";$sd_ft_sn4="";
		$sd_fq_sn1="";$sd_fq_sn2="";$sd_fq_sn3="";$sd_fq_sn4="";
		$sd_mc_sn1="";$sd_mc_sn2="";$sd_mc_sn3="";$sd_mc_sn4="";
		$sd_sh_sn1="";$sd_sh_sn2="";$sd_sh_sn3="";$sd_sh_sn4="";
		$sd_gl_sn1="";$sd_gl_sn2="";$sd_gl_sn3="";$sd_gl_sn4="";
		$sd_ds_sn1="";$sd_ds_sn2="";$sd_ds_sn3="";$sd_ds_sn4="";
		$sd_gq_sn1="";$sd_gq_sn2="";$sd_gq_sn3="";$sd_gq_sn4="";
		$sd_gt_sn1="";$sd_gt_sn2="";$sd_gt_sn3="";$sd_gt_sn4="";
		$sd_gv_sn1="";$sd_gv_sn2="";$sd_gv_sn3="";$sd_gv_sn4="";
		$sd_ce_sn1="";$sd_ce_sn2="";$sd_ce_sn3="";$sd_ce_sn4="";
		$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";$auth_req_e="";$auth_req_f="";$haz_qty_dispose_a="";$haz_qty_dispose_b="";$haz_qty_dispose_d="";$haz_qty_dispose_e="";$haz_chemicals_details_a="";$haz_chemicals_details_b="";$haz_chemicals_details_c="";$haz_chemicals_details_d="";$haz_chemicals_details_e="";$haz_chemicals_details_f="";$haz_chemicals_details_g="";$haz_chemicals_details_h="";$to_which_a="";$to_which_b="";$to_which_c="";$to_which_d="";$to_which_e="";$to_which_f="";$to_which_g="";$to_which_h="";$to_which_i="";$to_which_j="";$to_which_k="";$to_which_l="";$dgset_items_a="";$dgset_items_b="";$dgset_items_c="";$dgset_items_d="";$dg_set="";
		$is_hazardous="";$haz_qty="";$storage_mode="";$haz_pres_treatment="";$is_sys_upg="";$sys_upg_details="";$nonhaz_details="";$haz_chemicals="";$public_hearing_doc="";$other_info="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results["form_id"];
	
	/***********PART 1********/
	$revenue_survey_no=$results["revenue_survey_no"];$lb_name=$results["lb_name"];$lb_auth_name=$results["lb_auth_name"];$md_name=$results["md_name"];$is_registered=$results["is_registered"];$reg_no=$results["reg_no"];$reg_date=$results["reg_date"];$dg_set=$results["dg_set"];$from_year=$results["from_year"];$to_year=$results["to_year"];		
	if(!empty($results["plan_details"])){				
		$plan_details=json_decode($results["plan_details"]);
		$plan_details_prn=$plan_details->prn;$plan_details_dt=$plan_details->dt;$plan_details_ia=$plan_details->ia;			
	}else{
		$plan_details_prn="";$plan_details_dt="";$plan_details_ia="";
	}
	if(!empty($results["md_address"])){				
		$md_address=json_decode($results["md_address"]);
		$m_desig=$md_address->desig;$m_sn1=$md_address->st1;$m_sn2=$md_address->st2;$m_v=$md_address->vill;$m_d=$md_address->dist;$m_p=$md_address->pin;$m_m=$md_address->mn;$m_phn=$md_address->phn;$m_e=$md_address->email;				
	}else{
		$m_desig="";$m_sn1="";$m_sn2="";$m_v="";$m_d="";$m_p="";$m_m="";$m_phn="";$m_e="";
	}	
	/******PART 2********/	
	$wb_name=$results["wb_name"];$loc_feedback=$results["loc_feedback"];$is_situated=$results["is_situated"];$is_provided=$results["is_provided"];$is_use=$results["is_use"];$staff_nos=$results["staff_nos"];$is_res_colony=$results["is_res_colony"];
	if(!is_numeric($results["investment_cost"]) && !empty($results["investment_cost"])){
		$investment_cost=json_decode($results["investment_cost"]);
		$investment_cost_a=$investment_cost->a;$investment_cost_b=$investment_cost->b;
		$investment_cost_b=($investment_cost_b=="C")?'0000000':'00000';
		$investment_cost=$investment_cost_a.$investment_cost_b;
	}else{
		$investment_cost=$results["investment_cost"];
	}
	if(!empty($results["site_distance"])){
		$site_distance=json_decode($results["site_distance"]);
		$site_distance_a=$site_distance->a;$site_distance_b=$site_distance->b;
	}else{
		$site_distance_a="";$site_distance_b="";
	}
	if(!empty($results["total_plot_area"])){
		$total_area=json_decode($results["total_plot_area"]);
		$total_area_pa=$total_area->pa;$total_area_pau=$total_area->pau;$total_area_ba=$total_area->ba;$total_area_bau=$total_area->bau;$total_area_sa=$total_area->sa;$total_area_sau=$total_area->sau;
	}else{
		$total_area_pa="";$total_area_pau="";$total_area_ba="";$total_area_bau="";$total_area_sa="";$total_area_sau="";
	}
	
	if(!empty($results["commission_my"])){
		$commission_my=json_decode($results["commission_my"]);
		$commission_my_m=$commission_my->m;$commission_my_y=$commission_my->y;
	}else{
		$commission_my_m="";$commission_my_y="";
	}
	if(!empty($results["colony_details"])){
		$colony_details=json_decode($results["colony_details"]);
		$colony_details_pop=$colony_details->pop;$colony_details_loc=$colony_details->loc;$colony_details_dis=$colony_details->dis;
	}else{
		$colony_details_pop="";$colony_details_loc="";$colony_details_dis="";
	}
	/******** PART 3*********************/		
	$sewage_treatment=$results["sewage_treatment"];			
	if(!empty($results["wc_values"])){
		$wc_values=json_decode($results["wc_values"]);
		$wc_values_a=$wc_values->a;$wc_values_b=$wc_values->b;$wc_values_c=$wc_values->c;$wc_values_d=$wc_values->d;$wc_values_e=$wc_values->e;$wc_values_f=$wc_values->f;
	}else{
		$wc_values_a="";$wc_values_b="";$wc_values_c="";$wc_values_d="";$wc_values_e="";$wc_values_f="";
	}
	if(!empty($results["water_source"])){
		$water_source=json_decode($results["water_source"]);
		$water_source_a=$water_source->a;$water_source_b=$water_source->b;$water_source_c=$water_source->c;
	}else{
		$water_source_a="";$water_source_b="";$water_source_c="";
	}
	if(!empty($results["budget_calc"])){
		$budget_calc=json_decode($results["budget_calc"]);
		$budget_calc_a=$budget_calc->a;
	}else{
		$budget_calc_a="";
	}
	if(!empty($results["ww_qty"])){
		$ww_qty=json_decode($results["ww_qty"]);
		$ww_qty_a=$ww_qty->a;$ww_qty_b=$ww_qty->b;$ww_qty_c=$ww_qty->c;$ww_qty_d=$ww_qty->d;$ww_qty_e=$ww_qty->e;$ww_qty_f=$ww_qty->f;$ww_qty_g=$ww_qty->g;			
	}else{
		$ww_qty_a="";$ww_qty_b="";$ww_qty_c="";$ww_qty_d="";$ww_qty_e="";$ww_qty_f="";$ww_qty_g="";
	}
	/******** PART 4*********************/		
	$is_mixed=$results["is_mixed"];$yes_detail=$results["yes_detail"];$effluents_quality=$results["effluents_quality"];$sump_capacity=$results["sump_capacity"];	
	if(!empty($results["sump_capacity"])){
		$sump_capacity=json_decode($results["sump_capacity"]);
		$sump_capacity_a=$sump_capacity->a;$sump_capacity_b=$sump_capacity->b;
	}else{
		$sump_capacity_a="";$sump_capacity_b="";
	}				
	if(!empty($results["disposal_mode"])){
		$disposal_mode=json_decode($results["disposal_mode"]);
		$disposal_mode_a=$disposal_mode->a;$disposal_mode_b=$disposal_mode->b;$disposal_mode_c=$disposal_mode->c;$disposal_mode_d=$disposal_mode->d;$disposal_mode_e=$disposal_mode->e;$disposal_mode_f=$disposal_mode->f;$disposal_mode_g=$disposal_mode->g;$disposal_mode_h=$disposal_mode->h;$disposal_mode_i=$disposal_mode->i;$disposal_mode_j=$disposal_mode->j;
	}else{
		$disposal_mode_a="";$disposal_mode_b="";$disposal_mode_c="";$disposal_mode_d="";$disposal_mode_e="";$disposal_mode_f="";$disposal_mode_g="";$disposal_mode_h="";$disposal_mode_i="";$disposal_mode_j="";$disposal_mode_k="";
	}	
	if(!empty($results["effluents_quality"])){
		$effluents_quality=json_decode($results["effluents_quality"]);
		$effluents_quality_a=$effluents_quality->a;$effluents_quality_b=$effluents_quality->b;$effluents_quality_c=$effluents_quality->c;$effluents_quality_d=$effluents_quality->d;$effluents_quality_e=$effluents_quality->e;$effluents_quality_f=$effluents_quality->f;
	}else{
		$effluents_quality_a="";$effluents_quality_b="";$effluents_quality_c="";$effluents_quality_d="";$effluents_quality_e="";$effluents_quality_f="";
	}
	/******** PART 5*********************/		
	$is_odoriferous=$results["is_odoriferous"];$is_adq_facility=$results["is_adq_facility"];
	//echo $results["fuel_consumption"]; die();
	if(!empty($results["fuel_consumption"])){
		$fc=json_decode($results["fuel_consumption"]);
		$fc_tpd=$fc->tpd;$fc_cv=$fc->cv;$fc_ac=$fc->ac;$fc_sc=$fc->sc;$fc_ot=$fc->ot;
		$fc_tpd_cl=$fc_tpd->cl;$fc_tpd_ls=$fc_tpd->ls;$fc_tpd_fo=$fc_tpd->fo;$fc_tpd_ng=$fc_tpd->ng;$fc_tpd_ot=$fc_tpd->ot;
		$fc_cv_cl=$fc_cv->cl;$fc_cv_ls=$fc_cv->ls;$fc_cv_fo=$fc_cv->fo;$fc_cv_ng=$fc_cv->ng;$fc_cv_ot=$fc_cv->ot;
		$fc_ac_cl=$fc_ac->cl;$fc_ac_ls=$fc_ac->ls;$fc_ac_fo=$fc_ac->fo;$fc_ac_ng=$fc_ac->ng;$fc_ac_ot=$fc_ac->ot;
		$fc_sc_cl=$fc_sc->cl;$fc_sc_ls=$fc_sc->ls;$fc_sc_fo=$fc_sc->fo;$fc_sc_ng=$fc_sc->ng;$fc_sc_ot=$fc_sc->ot;
		$fc_ot_cl=$fc_ot->cl;$fc_ot_ls=$fc_ot->ls;$fc_ot_fo=$fc_ot->fo;$fc_ot_ng=$fc_ot->ng;$fc_ot_ot=$fc_ot->ot;$fc_ot_sp1=$fc_ot->sp1;$fc_ot_sp2=$fc_ot->sp2;
	}else{
		$fc_tpd_cl="";$fc_tpd_ls="";$fc_tpd_fo="";$fc_tpd_ng="";$fc_tpd_ot="";
		$fc_cv_cl="";$fc_cv_ls="";$fc_cv_fo="";$fc_cv_ng="";$fc_cv_ot="";
		$fc_ac_cl="";$fc_ac_ls="";$fc_ac_fo="";$fc_ac_ng="";$fc_ac_ot="";
		$fc_sc_cl="";$fc_sc_ls="";$fc_sc_fo="";$fc_sc_ng="";$fc_sc_ot="";
		$fc_ot_cl="";$fc_ot_ls="";$fc_ot_fo="";$fc_ot_ng="";$fc_ot_ot="";$fc_ot_sp1="";$fc_ot_sp2="";
	}
	if(!empty($results["stack_details"])){
		$sd=json_decode($results["stack_details"]);				
		$sd_at=$sd->at;$sd_ca=$sd->ca;$sd_ft=$sd->ft;$sd_fq=$sd->fq;$sd_mc=$sd->mc;$sd_sh=$sd->sh;$sd_gl=$sd->gl;$sd_ds=$sd->ds;$sd_gq=$sd->gq;$sd_gt=$sd->gt;$sd_gv=$sd->gv;$sd_ce=$sd->ce;			
		$sd_at_sn1=$sd_at->sn1;$sd_at_sn2=$sd_at->sn2;$sd_at_sn3=$sd_at->sn3;$sd_at_sn4=$sd_at->sn4;
		$sd_ca_sn1=$sd_ca->sn1;$sd_ca_sn2=$sd_ca->sn2;$sd_ca_sn3=$sd_ca->sn3;$sd_ca_sn4=$sd_ca->sn4;
		$sd_ft_sn1=$sd_ft->sn1;$sd_ft_sn2=$sd_ft->sn2;$sd_ft_sn3=$sd_ft->sn3;$sd_ft_sn4=$sd_ft->sn4;
		$sd_fq_sn1=$sd_fq->sn1;$sd_fq_sn2=$sd_fq->sn2;$sd_fq_sn3=$sd_fq->sn3;$sd_fq_sn4=$sd_fq->sn4;
		$sd_mc_sn1=$sd_mc->sn1;$sd_mc_sn2=$sd_mc->sn2;$sd_mc_sn3=$sd_mc->sn3;$sd_mc_sn4=$sd_mc->sn4;
		$sd_sh_sn1=$sd_sh->sn1;$sd_sh_sn2=$sd_sh->sn2;$sd_sh_sn3=$sd_sh->sn3;$sd_sh_sn4=$sd_sh->sn4;
		$sd_gl_sn1=$sd_gl->sn1;$sd_gl_sn2=$sd_gl->sn2;$sd_gl_sn3=$sd_gl->sn3;$sd_gl_sn4=$sd_gl->sn4;
		$sd_ds_sn1=$sd_ds->sn1;$sd_ds_sn2=$sd_ds->sn2;$sd_ds_sn3=$sd_ds->sn3;$sd_ds_sn4=$sd_ds->sn4;
		$sd_gq_sn1=$sd_gq->sn1;$sd_gq_sn2=$sd_gq->sn2;$sd_gq_sn3=$sd_gq->sn3;$sd_gq_sn4=$sd_gq->sn4;
		$sd_gt_sn1=$sd_gt->sn1;$sd_gt_sn2=$sd_gt->sn2;$sd_gt_sn3=$sd_gt->sn3;$sd_gt_sn4=$sd_gt->sn4;
		$sd_gv_sn1=$sd_gv->sn1;$sd_gv_sn2=$sd_gv->sn2;$sd_gv_sn3=$sd_gv->sn3;$sd_gv_sn4=$sd_gv->sn4;
		$sd_ce_sn1=$sd_ce->sn1;$sd_ce_sn2=$sd_ce->sn2;$sd_ce_sn3=$sd_ce->sn3;$sd_ce_sn4=$sd_ce->sn4;
	}else{
		$sd_at_sn1="";$sd_at_sn2="";$sd_at_sn3="";$sd_at_sn4="";
		$sd_ca_sn1="";$sd_ca_sn2="";$sd_ca_sn3="";$sd_ca_sn4="";
		$sd_ft_sn1="";$sd_ft_sn2="";$sd_ft_sn3="";$sd_ft_sn4="";
		$sd_fq_sn1="";$sd_fq_sn2="";$sd_fq_sn3="";$sd_fq_sn4="";
		$sd_mc_sn1="";$sd_mc_sn2="";$sd_mc_sn3="";$sd_mc_sn4="";
		$sd_sh_sn1="";$sd_sh_sn2="";$sd_sh_sn3="";$sd_sh_sn4="";
		$sd_gl_sn1="";$sd_gl_sn2="";$sd_gl_sn3="";$sd_gl_sn4="";
		$sd_ds_sn1="";$sd_ds_sn2="";$sd_ds_sn3="";$sd_ds_sn4="";
		$sd_gq_sn1="";$sd_gq_sn2="";$sd_gq_sn3="";$sd_gq_sn4="";
		$sd_gt_sn1="";$sd_gt_sn2="";$sd_gt_sn3="";$sd_gt_sn4="";
		$sd_gv_sn1="";$sd_gv_sn2="";$sd_gv_sn3="";$sd_gv_sn4="";
		$sd_ce_sn1="";$sd_ce_sn2="";$sd_ce_sn3="";$sd_ce_sn4="";
	}
	/******** PART 6*********************/		
	$is_hazardous=$results["is_hazardous"];$haz_cat_no=$results["haz_cat_no"];$haz_qty=$results["haz_qty"];$storage_mode=$results["storage_mode"];$haz_pres_treatment=$results["haz_pres_treatment"];			
	if(!empty($results["auth_req"])){
		$auth_req=json_decode($results["auth_req"]);
		if(isset($auth_req->a)) $auth_req_a=$auth_req->a; else $auth_req_a="";
		if(isset($auth_req->b)) $auth_req_b=$auth_req->b; else $auth_req_b="";
		if(isset($auth_req->c)) $auth_req_c=$auth_req->c; else $auth_req_c="";
		if(isset($auth_req->d)) $auth_req_d=$auth_req->d; else $auth_req_d="";
		if(isset($auth_req->e)) $auth_req_e=$auth_req->e; else $auth_req_e="";
		if(isset($auth_req->f)) $auth_req_f=$auth_req->f; else $auth_req_f="";
	}else{
		$auth_req_a="";$auth_req_b="";$auth_req_c="";$auth_req_d="";$auth_req_e="";$auth_req_f="";
	}
	if(!empty($results["haz_qty_dispose"])){
		$haz_qty_dispose=json_decode($results["haz_qty_dispose"]);
		$haz_qty_dispose_a=$haz_qty_dispose->a;$haz_qty_dispose_b=$haz_qty_dispose->b;$haz_qty_dispose_d=$haz_qty_dispose->d;$haz_qty_dispose_e=$haz_qty_dispose->e;
	}else{
		$haz_qty_dispose_a="";$haz_qty_dispose_b="";$haz_qty_dispose_d="";$haz_qty_dispose_e="";
	}
	/******** PART 7*********************/		
	$is_sys_upg=$results["is_sys_upg"];$sys_upg_details=$results["sys_upg_details"];$nonhaz_details=$results["nonhaz_details"];$haz_chemicals=$results["haz_chemicals"];$other_info=$results["other_info"];$public_hearing_doc=$results["public_hearing_doc"];if(!empty($results["haz_chemicals_details"])){
		$haz_chemicals_details=json_decode($results["haz_chemicals_details"]);
		if(isset($haz_chemicals_details->a)) $haz_chemicals_details_a=$haz_chemicals_details->a; else $haz_chemicals_details_a="";
		if(isset($haz_chemicals_details->b)) $haz_chemicals_details_b=$haz_chemicals_details->b; else $haz_chemicals_details_b="";
		if(isset($haz_chemicals_details->c)) $haz_chemicals_details_c=$haz_chemicals_details->c; else $haz_chemicals_details_c="";
		if(isset($haz_chemicals_details->d)) $haz_chemicals_details_d=$haz_chemicals_details->d; else $haz_chemicals_details_d="";
		if(isset($haz_chemicals_details->e)) $haz_chemicals_details_e=$haz_chemicals_details->e; else $haz_chemicals_details_e="";
		if(isset($haz_chemicals_details->f)) $haz_chemicals_details_f=$haz_chemicals_details->f; else $haz_chemicals_details_f="";
		if(isset($haz_chemicals_details->g)) $haz_chemicals_details_g=$haz_chemicals_details->g; else $haz_chemicals_details_g="";
		if(isset($haz_chemicals_details->h)) $haz_chemicals_details_h=$haz_chemicals_details->h; else $haz_chemicals_details_h="";
	}else{
		$haz_chemicals_details_a="";$haz_chemicals_details_b="";$haz_chemicals_details_c="";$haz_chemicals_details_d="";$haz_chemicals_details_e="";$haz_chemicals_details_f="";$haz_chemicals_details_g="";$haz_chemicals_details_h="";
	}
	if(!empty($results["to_which"])){
		$to_which=json_decode($results["to_which"]);
		if(isset($to_which->a)) $to_which_a=$to_which->a; else $to_which_a="";
		if(isset($to_which->b)) $to_which_b=$to_which->b; else $to_which_b="";
		if(isset($to_which->c)) $to_which_c=$to_which->c; else $to_which_c="";
		if(isset($to_which->d)) $to_which_d=$to_which->d; else $to_which_d="";
		if(isset($to_which->e)) $to_which_e=$to_which->e; else $to_which_e="";
		if(isset($to_which->f)) $to_which_f=$to_which->f; else $to_which_f="";
		if(isset($to_which->g)) $to_which_g=$to_which->g; else $to_which_g="";
		if(isset($to_which->h)) $to_which_h=$to_which->h; else $to_which_h="";
		if(isset($to_which->i)) $to_which_i=$to_which->i; else $to_which_i="";
		if(isset($to_which->j)) $to_which_j=$to_which->j; else $to_which_j="";
		if(isset($to_which->k)) $to_which_k=$to_which->k; else $to_which_k="";
		if(isset($to_which->l)) $to_which_l=$to_which->l; else $to_which_l="";			
	}else{
		$to_which_a="";$to_which_b="";$to_which_c="";$to_which_d="";$to_which_e="";$to_which_f="";$to_which_g="";$to_which_h="";$to_which_i="";$to_which_j="";$to_which_k="";$to_which_l="";
	}
	if(!empty($results["dgset_items"])){
		$dgset_items=json_decode($results["dgset_items"]);
		$dgset_items_a=$dgset_items->a;$dgset_items_b=$dgset_items->b;$dgset_items_c=$dgset_items->c;$dgset_items_d=$dgset_items->d;
	}else{
		$dgset_items_a="";$dgset_items_b="";$dgset_items_c="";$dgset_items_d="";
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
	$tabbtn7 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 8 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
		$tabbtn7 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
		$tabbtn7 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
		$tabbtn7 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
		$tabbtn5 = "";
		$tabbtn6 = "";
		$tabbtn7 = "";
	}
	if ($showtab == 5) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "active";
		$tabbtn6 = "";
		$tabbtn7 = "";
	}
	if ($showtab == 6) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "active";
		$tabbtn7 = "";
	}
	if ($showtab == 7) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
		$tabbtn5 = "";
		$tabbtn6 = "";
		$tabbtn7 = "active";
	}
	##PHP TAB management ends
?>

	<?php require_once "../../requires/header.php";   ?>
	  <?php include ("pcb_form50_addmore.php"); ?>
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
									<li class="<?php echo $tabbtn5; ?>"><a href="#table5">Part 5</a></li>
									<li class="<?php echo $tabbtn6; ?>"><a href="#table6">Part 6</a></li>
									<li class="<?php echo $tabbtn7; ?>"><a href="#table7">Part 7</a></li>
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<input type="hidden" value="<?php //echo $enterprise_category; ?>" name="enterprise_category" class="form-control text-uppercase">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">From : <?php echo strtoupper($from);?></td>
											</tr>
											<tr>
												<td colspan="4" <?php if(isset($_GET["error"]) && $_GET["error"]==1) echo "class='danger'"; else echo "class='info'";?>>Sir,<br/> I / We hereby apply for <?php if(isset($_GET["error"]) && $_GET["error"]==1) echo "<font color='red'>[ Please check any two below checkboxes.]</font>";?> <span class="mandatory_field">*</span><br/>
													<div class="checkbox">
													  <label><input type="checkbox" name="application_for[a]" <?php if(!empty($application_for_a)) echo "checked";?> value="W">(i) Consent to Operate under section 25 and 26 of the Water (Prevention and Control of Pollution) Act, 1974, as amended.</label>
													</div>
													<div class="checkbox">
													  <label><input type="checkbox" name="application_for[b]" <?php if(!empty($application_for_b)) echo "checked";?> value="A">(ii) Consent to Operate under Section 21 of the Air (Prevention and Control of Pollution) Act, 1981, as amended.</label>
													</div>
													<div class="checkbox">
													  <label><input type="checkbox" name="application_for[c]" <?php  if(!empty($application_for_c)) echo "checked";?> value="H">(iii) Authorisation under rule 5 of the Hazardous Wastes (Management and Handling) Rules, 1989, as amended in connection with my / our existing / proposed / altered / additional manufacturing / processing activity from the premises as per the details given below.</label>
													</div>
												</td>
											</tr>
											<tr>
												<td><b>Part A : General	</b></td>
											</tr>
											<tr>
												<td width="25%">For the year </td>
												<td width="25%">From&nbsp;&nbsp;
												<select name="from_year" class="dob_year form-control">
													<?php if($from_year!=""){ echo '<option selected value="'.$from_year.'">'.$from_year.'</option>'; } ?>
												</select></td>
												<td width="25%">To&nbsp;&nbsp;
												<select name="to_year" class="dob_year form-control">
													<?php if($to_year!=""){ echo '<option selected value="'.$to_year.'">'.$to_year.'</option>'; } ?>
												</select>
												</td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">1. Name, Designation and Address with telephone, e-mail of the Applicant :</td>
											</tr>
											<tr>
												<td width="25%">Name</td>
												<td width="25%"><input type="text" value="<?php echo strtoupper($key_person);?>" class="form-control text-uppercase" disabled></td>
												<td width="25%">Designation</td>
												<td width="25%"><input type="text" value="<?php echo strtoupper($status_applicant);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" value="<?php echo strtoupper($street_name1);?>" class="form-control text-uppercase" disabled></td>
												<td>Street Name 2</td>
												<td><input type="text" value="<?php echo strtoupper($street_name2);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" value="<?php echo strtoupper($vill);?>" class="form-control text-uppercase" disabled></td>
												<td>District</td>
												<td><input type="text" value="<?php echo strtoupper($dist);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" value="<?php echo strtoupper($pincode);?>" class="form-control text-uppercase" disabled></td>
												<td>Mobile</td>
												<td><input type="text" value="<?php echo "+91 ".strtoupper($mobile_no);?>" class="dob form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" value="<?php echo strtoupper($landline_std)." - ".strtoupper($landline_no);?>" class="form-control text-uppercase" disabled></td>
												<td>Email-id</td>
												<td><input type="text" value="<?php echo $email;?>" class="form-control" disabled></td>
											</tr>
											<tr>
												<td colspan="4">2. (a) Name and location of the industrial unit / premises for which the application is made. (Give revenue Survey Number /plot number, name of Taluka and District also telephone)</td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" value="<?php echo strtoupper($unit_name);?>" class="form-control text-uppercase" disabled></td>
												<td>Street Name 1</td>
												<td><input type="text" value="<?php echo strtoupper($b_street_name1);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td>Street Name 2</td>
												<td><input type="text" value="<?php echo strtoupper($b_street_name2);?>" class="form-control text-uppercase" disabled></td>
												<td>Village/Town</td>
												<td><input type="text" value="<?php echo strtoupper($b_vill);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>District</td>
												<td><input type="text" value="<?php echo strtoupper($b_dist);?>" class="form-control text-uppercase" disabled></td>
												<td>Pincode</td>
												<td><input type="text" value="<?php echo strtoupper($b_pincode);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>Mobile</td>
												<td><input type="text" value="<?php echo "+91 ".strtoupper($b_mobile_no);?>" class="form-control text-uppercase" disabled></td>
												<td>Phone Number</td>
												<td><input type="text" value="<?php echo strtoupper($b_landline_std)." - ".strtoupper($b_landline_no);?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>												
												<td>Email-id</td>
												<td><input type="text" value="<?php echo $b_email;?>" class="form-control" disabled></td>
												<td>Revenue Survey Number / Plot Number<span class="mandatory_field">*</span></td>
												<td><input type="text" class="form-control text-uppercase" name="revenue_survey_no" title="Revenue Survey Number/ Plot Number of the industrial unit" placeholder="Revenue Survey Number/ Plot Number" value="<?php echo strtoupper($revenue_survey_no);?>" required="required"></td>											
											</tr>
											<tr>
												<td colspan="4">(b) Details of the planning permission obtained from the local body / Town and Country Planning authority / metropolitan development authority / designate authority</td>
											</tr>
											<tr>												
												<td>Permission Reference No. </td>
												<td><input type="text" title="Planning Permission Reference No." placeholder="Permission Reference No." name="plan_details[prn]" value="<?php echo strtoupper($plan_details_prn);?>" class="form-control text-uppercase" ></td>
												<td>Date<span class="mandatory_field">*</span> </td>
												<td><input type="datetime" title="Date of obtaining planning permission" name="plan_details[dt]" value="<?php echo strtoupper($plan_details_dt);?>" class="dob form-control text-uppercase" readonly required="required"></td>				
											</tr>
											<tr>												
												<td>Issuing Authority </td>
												<td><input type="text" title="Issuing Authority" placeholder="Issuing Authority" name="plan_details[ia]" value="<?php echo strtoupper($plan_details_ia);?>" class="form-control text-uppercase" ></td>
												<td>Upload later in upload section</td>
												<td>&nbsp;</td>				
											</tr>
											<tr>
												<td colspan="4">(c) Name of the local body under whose jurisdiction the unit is located and name of the licence issuing authority</td>
											</tr>
											<tr>
												<td>Local Body Name</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($lb_name);?>" name="lb_name"></td>
												<td>Licence Issuing Authority</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($lb_auth_name);?>" name="lb_auth_name"></td>
											</tr>
											
											<tr>
												<td colspan="4">3. Names, addresses with telephone of Managing Director/Managing Partner and officer responsible for matters connected with pollution control and / or hazardous waste disposal.</td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" validate="letters" class="form-control text-uppercase" value="<?php echo strtoupper($md_name);?>" name="md_name"></td>
												<td>Designation</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_desig);?>" name="md_address[desig]"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_sn1);?>" name="md_address[st1]"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_sn2);?>" name="md_address[st2]"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_v);?>" name="md_address[vill]"></td>
												<td>District</td>
												<td>
													 <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($m_d);?>"  placeholder="Enter District" name="md_address[dist]">    
												</td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" validate="pincode" maxlength="6" class="form-control text-uppercase" value="<?php echo strtoupper($m_p);?>" name="md_address[pin]"></td>
												<td>Mobile</td>
												<td><input type="text" validate="mobileNumber" maxlength="10" class="form-control text-uppercase" value="<?php echo strtoupper($m_m);?>" name="md_address[mn]"></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo strtoupper($m_phn);?>" maxlength="13" name="md_address[phn]"></td>
												<td>Email-id</td>
												<td><input type="email" class="form-control" value="<?php echo $m_e;?>" name="md_address[email]"></td>
											</tr>
											<tr>
												<td colspan="2">4. (a) Are you registered as a small-scale industrial unit ?</td>
												<td colspan="2">
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_registered=="Y" || $is_registered=="") echo "checked"; ?> id="inlineRadio1" name="is_registered"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_registered=="N") echo "checked"; ?> id="inlineRadio1" name="is_registered"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4">(b) If yes, give the number and date of registration.</td>
											</tr>
											<tr>
												<td > Registration Number</td>
												<td><input type="text" class="is_registered form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>" <?php if($is_registered=='N') echo 'disabled'; ?> ></td>
												<td >Date of Registration</td>
												<td><input type="text" name="reg_date" class="is_registered dob form-control text-uppercase" value="<?php if (isset($reg_date)) echo $reg_date; ?>" readonly <?php if($is_registered=='N') echo 'disabled'; ?> ></td>
											</tr>
											<tr>												
												<td class="text-center" colspan="4">&nbsp;</td>
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
												<td colspan="2">5. Gross capital investment (in Rupees) of the unit without depreciation till the date of application(Cost of building, land,plant and machinery)<span class="mandatory_field">*</span></td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="investment_cost" validate="onlyNumbers" value="<?php echo $investment_cost;?>"></td>								
											</tr>
											<tr>
												<td colspan="2">(To be supported by an affidavit, Annual Report or certificate from a Chartered Accountant.For proposed unit(s), give estimated figure)</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="4">6. If the site is located near sea-shore / river bank / other water bodies; indicate the distance and the name of the water body, if any</td>
											</tr>
											<tr>
												<td>Distance<span class="mandatory_field">*</span></td>
												<td>
												<input type="text" validate="onlyNumbers" name="site_distance[a]" value="<?php echo $site_distance_a;?>" class="form-control text-uppercase">
													<select name="site_distance[b]" required="required" class="form-control text-uppercase">
														<option value="">Choose a Unit</option>
														<option value="F" <?php if($site_distance_b=="F") echo "selected"; ?>>Feet</option>
														<option value="M" <?php if($site_distance_b=="M") echo "selected"; ?>>Meter</option>
														<option value="K" <?php if($site_distance_b=="K") echo "selected"; ?>>Kilo Meter</option>
													</select>
												</td>
												<td>Name of the water body</td>
												<td><input type="text" name="wb_name" value="<?php echo $wb_name?>" class="form-control text-uppercase"></td>										
											</tr>
											<tr>
												<td colspan="2">7. Does the location satisfy the requirements under relevant Central / State Govt. notifications such as Coastal Regulation Zone, Notification on Ecologically Fragile Area, Industrial location policy, etc. If so, give details.<span class="mandatory_field">*</span></td>
												<td>
													<select required="required" name="loc_feedback_select" class="form-control">
														<option value="">Please Select</option>
														<option <?php if(!empty($loc_feedback)) echo "selected"; ?> value="A">Applicable</option>
														<option value="N">Not Applicable</option>
													</select>
												</td>								
												<td><textarea class="form-control text-uppercase" <?php if(empty($loc_feedback)) echo "readonly='readonly'"; ?> name="loc_feedback" id="loc_feedback"><?php echo $loc_feedback; ?></textarea></td>								
											</tr>
											<tr>
												<td colspan="2">8. If the site is situated in notified industrial estate </td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_situated=="Y" || $is_situated=="") echo "checked"; ?> id="inlineRadio1" name="is_situated"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_situated=="N") echo "checked"; ?> id="inlineRadio1" name="is_situated"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">a) whether effluent collection, treatment and disposal system has been provided by the authority</td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_provided=="Y" || $is_provided=="") echo "checked"; ?> id="inlineRadio1" name="is_provided"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_provided=="N") echo "checked"; ?> id="inlineRadio1" name="is_provided"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">(b) will the applicant utilise the system, if provided</td>
												<td colspan="2"><input type="text" id="is_provided_yes" value="<?php echo $is_use; ?>" name="is_use" class="form-control text-uppercase"  ></td>	
											</tr>
											<tr>
												<td>c) if not provided, details of proposed arrangement.</td>
												<td>Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2" rowspan="3">9. Total plot area, built-up area and area available for the use of treated sewage / trade effluent<span class="mandatory_field">*</span></td>
												<td><input type="text" name="total_area[pa]" value="<?php echo $total_area_pa;?>" class="form-control text-uppercase" placeholder="Plot Area" validate="decimal"/></td>
												<td>
													<select name="total_area[pau]" class="form-control text-uppercase" required>
														<option value="">Choose a Unit</option>
														<option value="F" <?php if($total_area_pau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_pau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>
											</tr>
											<tr>		
												<td><input type="text" name="total_area[ba]" value="<?php echo $total_area_ba;?>" class="form-control text-uppercase" placeholder="Build-up Area" validate="decimal"/></td>
												<td>
													<select name="total_area[bau]" class="form-control text-uppercase" required>
														<option>Choose a Unit</option>
														<option value="F" <?php if($total_area_bau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_bau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>
											</tr>
											<tr>
												<td><input type="text" name="total_area[sa]"  value="<?php echo $total_area_sa;?>" class="form-control text-uppercase" placeholder="Area for Treated Sewage" validate="decimal"/></td>	
												<td>
													<select name="total_area[sau]" class="form-control text-uppercase" required>
														<option>Choose a Unit</option>
														<option value="F" <?php if($total_area_sau=="F") echo "selected"; ?>>Square Feet</option>
														<option value="M" <?php if($total_area_sau=="M") echo "selected"; ?>>Square Meter</option>
													</select>
												</td>										
											</tr>
											<tr >										
												<td colspan="2">10. Month and year of proposed commissioning of the unit<span class="mandatory_field">*</span></td>
												<td><select required="required" name="commission_my[m]" class="form-control text-uppercase">
														<option value='' >Please select a month</option>
														<option <?php if($commission_my_m=='January') echo "selected"; ?> value='January' >January</option>
														<option <?php if($commission_my_m=='February') echo "selected"; ?> value='February' >February</option>
														<option <?php if($commission_my_m=='March') echo "selected"; ?> value='March' >March</option>
														<option <?php if($commission_my_m=='April') echo "selected"; ?> value='April' >April</option>
														<option <?php if($commission_my_m=='May') echo "selected"; ?> value='May' >May</option>
														<option <?php if($commission_my_m=='June') echo "selected"; ?> value='June' >June</option>
														<option <?php if($commission_my_m=='July') echo "selected"; ?> value='July' >July</option>
														<option <?php if($commission_my_m=='August') echo "selected"; ?> value='August' >August</option>
														<option <?php if($commission_my_m=='September') echo "selected"; ?> value='September' >September</option>
														<option <?php if($commission_my_m=='October') echo "selected"; ?> value='October' >October</option>
														<option <?php if($commission_my_m=='November') echo "selected"; ?> value='November' >November</option>
														<option <?php if($commission_my_m=='December') echo "selected"; ?> value='December' >December</option>											
													</select></td>
												<td>
													<select name="commission_my[y]" class="form-control text-uppercase">
														<option value="">Please select a year</option>
														<?php for($i=1947;$i<2050;$i++){ ?>
															<option <?php if($commission_my_y==$i) echo "selected"; ?> value="<?php echo $i;?>"><?php echo $i;?></option>
														<?php } ?>
													</select>
												</td>										
											</tr>
											<tr>
												<td colspan="2">11. Number of workers and office staff.</td>
												<td ><input type="text" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $staff_nos; ?>"  name="staff_nos" /></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="2">12.(a) Do you have a residential colony within the premises in respect of which the present application is made ?</td>
												<td>
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_res_colony=="Y" || $is_res_colony=="") echo "checked"; ?> name="is_res_colony"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_res_colony=="N") echo "checked"; ?> name="is_res_colony"> No </label>
												</td>
											</tr>									
											<tr>
												<td colspan="2">(b) If yes, please state population staying</td>
												<td colspan="2"><input type="text" id="field12b" <?php if($is_res_colony=="N") echo "disabled"; ?> class="form-control text-uppercase" name="colony_details[pop]" value="<?php echo $colony_details_pop; ?>" placeholder="Population" /></td>
											</tr>									
											<tr>
												<td colspan="2">(c) Indicate its location and distance with reference to plant site.</td>
												<td><input type="text" id="field12c1" name="colony_details[loc]" value="<?php echo $colony_details_loc; ?>" class="form-control text-uppercase" <?php if($is_res_colony=="N") echo "disabled"; ?> placeholder="LOCATION" /></td>
												<td><input type="text" id="field12c2" name="colony_details[dis]" value="<?php echo $colony_details_dis; ?>" class="form-control text-uppercase" <?php if($is_res_colony=="N") echo "disabled"; ?> placeholder="DISTANCE" /></td>
											</tr>
											<tr>
												<td colspan="4">
													13. List of products and by-products manufactured in tonnes / month,kl / month or numbers / month (Give figure corresponding to maximum installed production capacity)
												</td>
											</tr>
											<tr>
											<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Name</th>
														<th>Type<span class="mandatory_field">*</span></th>
														<th>Quantity</th>
														<th>Units<span class="mandatory_field">*</span></th>	
													</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_products where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text" value="<?php echo $row_1["name"]; ?>" validate="letters" title="No special characters are allowed except Dot" id="txtB<?php echo $count;?>" class="form-control text-uppercase"; name="txtB<?php echo $count;?>" size="20"></td>
														<td>
														<select id="txtC<?php echo $count;?>" name="txtC<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_1["product_type"]=="P") echo "selected"; ?> value='P' >Product</option>
															<option <?php if($row_1["product_type"]=="B") echo "selected"; ?> value='B' >By-product</option>
														</select>
														</td>				
														<td><input type="text" value="<?php echo $row_1["qty"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"; name="txtD<?php echo $count;?>" size="15" ></td>
														<td>
														<select id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
															<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
															<option <?php if($row_1["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
															<option <?php if($row_1["unit"]=="KG") echo "selected"; ?> value='KG' >in kg / month</option>
														</select></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input type="text" id="txtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txtB1" size="20"></td>					
														<td><select id="txtC1" name="txtC1" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option value='P' >Product</option>
															<option value='B' >By-product</option>
														</select></td>
														<td><input type="text" id="txtD1" class="form-control text-uppercase"; name="txtD1" size="15"></td>
														<td>														
														<select id="txtE1" name="txtE1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='T' >in tonnes / month</option>
															<option value='K' >in kl / month</option>
															<option value='N' >in numbers / month</option>
															<option value='KG' >in kg / month</option>
														</select>
														</td>
													</tr>
													<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default submit1" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
											</tr>
											<tr>
												<td colspan="4">14. List of raw materials and process chemicals with annual consumption corresponding to above stated production figures, in tonnes / month or kl / month or numbers / month.</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable2" class="table table-responsive table-bordered " id="objectTable2" >
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Name</th>
														<th>Type<span class="mandatory_field">*</span></th>
														<th>Quantity</th>
														<th>Units<span class="mandatory_field">*</span></th>
													</tr>
													</thead>
													<?php
														$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_materials where form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
														 <tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input type="text" value="<?php echo $row_1["name"]; ?>" validate="letters" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
															<td>
															<select id="textC<?php echo $count;?>" name="textC<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["material_type"]=="R") echo "selected"; ?> value='R' >Raw material</option>
															<option <?php if($row_1["material_type"]=="C") echo "selected"; ?> value='C' >Process chemical</option>
														</select></td>				
															<td><input type="text" value="<?php echo $row_1["qty"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="15"></td>
															<td><select id="textE<?php echo $count;?>" name="textE<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option <?php if($row_1["unit"]=="T") echo "selected"; ?> value='T' >in tonnes / month</option>
															<option <?php if($row_1["unit"]=="K") echo "selected"; ?> value='K' >in kl / month</option>
															<option <?php if($row_1["unit"]=="N") echo "selected"; ?> value='N' >in numbers / month</option>
															<option <?php if($row_1["unit"]=="KG") echo "selected"; ?> value='KG' >in kg / month</option>
														</select></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
													  <td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
													  <td><input type="text" id="textB1" size="20" class="form-control text-uppercase" name="textB1"></td>					
													  <td><select id="textC1" name="textC1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='R' >Raw material</option>
															<option value='C' >Process chemical</option>
														</select>
														</td>
													  <td><input type="text" id="textD1" size="15" class="form-control text-uppercase" name="textD1"></td>
													  <td><select id="textE1" name="textE1" class="form-control text-uppercase">
															<option value='' >Select unit</option>
															<option value='T' >in tonnes / month</option>
															<option value='K' >in kl / month</option>
															<option value='N' >in numbers / month</option>
															<option value='KG' >in kg / month</option>
														</select></td>
													</tr>
													<?php } ?>
												</table>
												<button type="button" href="#" onclick="mydelfunction2()" value="" class="btn btn-default pull-right">Delete</button>
												<button type="button" onclick="addMorefunction2()" class="btn btn-default pull-right" value="">Add More</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></td>
											</tr>
											<tr>
												<td colspan="2">15. Description of process of manufacture for each of the products showing input, output, quality and quantity of solid, liquid and gaseous wastes, if any from each unit process. (To be supported by flow sheet and / or material balance and water balance sheet).</td>
												<td colspan="2">Upload later in upload section</td>
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
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part B : Waste water aspects</strong></td>
											</tr>
											<tr>
												<td colspan="4">16. Water consumption for different uses (in m3 / day)</td>
											</tr>
											<tr>
												<td style="width:25%">(i) Industrial cooling, spraying - in mine pits or boiler feeds.<span class="mandatory_field">*</span></td>
												<td style="width:25%"><input type="text" validate="decimal" required="required" name="wc_values[a]" value="<?php echo $wc_values_a; ?>" class="form-control text-uppercase wc_sum"></td>
												<td style="width:25%">(ii) Domestic purpose</td>
												<td style="width:25%"><input type="text" validate="decimal" name="wc_values[b]" value="<?php echo $wc_values_b; ?>" class=" form-control text-uppercase wc_sum"></td>
											</tr>
											<tr>
												<td >(iii) Processing whereby water gets polluted and the pollutants are easily biodegradable</td>
												<td><input type="text" validate="decimal" name="wc_values[c]" value="<?php echo $wc_values_c; ?>" class="form-control text-uppercase wc_sum"></td>
												<td>(iv) Processing whereby water gets polluted and the pollutants are not easily bio-degradable and are toxic</td>
												<td><input type="text" validate="decimal" name="wc_values[d]" value="<?php echo $wc_values_d; ?>" class=" form-control text-uppercase wc_sum"></td>
											</tr>
											<tr>
												<td >(v) Others such as agriculture, gardening etc. (specify)</td>
												<td><input type="text" validate="decimal" name="wc_values[e]" value="<?php echo $wc_values_e; ?>" class="form-control text-uppercase wc_sum"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td ><strong>TOTAL</strong></td>
												<td><input type="text" name="wc_values[f]" id="wc_values_total" readonly="readonly" value="<?php echo $wc_values_f; ?>" class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td rowspan="3" colspan="2">17. Source of water supply. Name of authority granting permission if applicable and quantity permitted *</td>
												<td>Source of water supply</td>
												<td><input type="text" name="water_source[a]" value="<?php echo $water_source_a;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Name of authority granting permission if applicable</td>
												<td><input type="text" name="water_source[b]" value="<?php echo $water_source_b;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Quantity permitted (in m3/day)</td>
												<td><input type="text" name="water_source[c]" value="<?php echo $water_source_c;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="4">18. Quantity of waste water (effluent) generated (in m3 / day) </td>
											</tr>
											<tr>
												<td>(i) Domestic </td>
												<td><input type="text" name="ww_qty[a]" validate="decimal" value="<?php echo $ww_qty_a;?>" class="form-control text-uppercase"></td>
												<td>(ii) Industrial</td>
												<td><input type="text" name="ww_qty[b]" validate="decimal" value="<?php echo $ww_qty_b;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(iii) Process </td>
												<td><input type="text" name="ww_qty[c]" validate="decimal" value="<?php echo $ww_qty_c;?>" class="form-control text-uppercase"></td>
												<td>(iv) Washings </td>
												<td><input type="text" name="ww_qty[d]" validate="decimal" value="<?php echo $ww_qty_d;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(v) Boiler Blowdown </td>
												<td><input type="text" name="ww_qty[e]" validate="decimal" value="<?php echo $ww_qty_e;?>" class="form-control text-uppercase"></td>
												<td>(vi) Cooling water blowdown </td>
												<td><input type="text" name="ww_qty[f]" validate="decimal" value="<?php echo $ww_qty_f;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(vii) DM Plant / Softening Plant washings</td>
												<td><input type="text" name="ww_qty[g]" validate="decimal" value="<?php echo $ww_qty_g;?>" class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>19. Water budget calculations accounting for difference between water consumption and effluent generated. :*</td>
												<td><input type="text" name="budget_calc[a]" value="<?php echo $budget_calc_a; ?>" class="form-control text-uppercase"></td>
												<td>Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2">20. Present treatment of sewage / canteen effluent (Give sizes / capacities of treatment units).	</td>
												<td colspan="2"><input type="text" name="sewage_treatment" value="<?php echo $sewage_treatment; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>c" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
										<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="2">21. Present treatment of trade effluent (Give sizes / capacities of treatment units). (A schematic diagram of the treatment scheme with inlet / outlet characteristics of each unit operation / process is to be provided. Include details of residue management system (ETP sludges)) </td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td>22. (a) Are sewage and trade effluents mixed together ? </td>
												<td><label class="radio-inline"><input type="radio" <?php if($is_mixed=="Y") echo "checked"; ?> value="Y" id="inlineRadio1" name="is_mixed"> Yes </label>
													<label class="radio-inline"><input type="radio" <?php if($is_mixed=="N" || $is_mixed=="") echo "checked"; ?> value="N" id="inlineRadio1" name="is_mixed"> No </label></td>
												<td>(b) If yes, state at which stage - whether  <br/>before, intermittently or after treatment.</td>
												<td><input type="text" name="yes_detail" <?php if($is_mixed=="N" || $is_mixed=="") echo "disabled='disabled'"; ?> id="yes_detail" value="<?php echo $yes_detail; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td style="width:25%">23. Capacity of treated effluent sump. Guard Pond if any.</td>
												<td style="width:25%"><label class="radio-inline"><input type="radio" <?php if($sump_capacity!=NULL) echo "checked"; ?> value="Y" id="inlineRadio1" name="sump_capacity_radio"> Yes </label>
													<label class="radio-inline"><input type="radio" <?php if($sump_capacity==NULL) echo "checked"; ?> value="N" id="inlineRadio1" name="sump_capacity_radio"> No </label></td>
												
												<td style="width:25%"><input type="text" name="sump_capacity[a]" value="<?php echo $sump_capacity_a; ?>" <?php if($sump_capacity==NULL) echo "disabled='disabled'"; ?>  class="form-control text-uppercase sump_capacity"></td>
												<td style="width:25%"><input type="text" name="sump_capacity[b]" placeholder="Quantity in m3/day" value="<?php echo $sump_capacity_b; ?>" <?php if($sump_capacity==NULL) echo "disabled='disabled'"; ?> class="form-control text-uppercase sump_capacity"></td>
											</tr>
											<tr>
												<td colspan="4">24. Mode of disposal of treated effluents, with respective quantity, in m3 / day</td>
											</tr>
											<tr>
												<td>(i) into stream / river (Name of river)</td>
												<td><input type="text" name="disposal_mode[a]" value="<?php echo $disposal_mode_a; ?>" class="form-control text-uppercase"><input type="text" name="disposal_mode[b]" value="<?php echo $disposal_mode_b; ?>" placeholder="Name of river" class="form-control text-uppercase">	</td>
												
												<td>(ii) into creek / estuary (Name of creek/estuary)</td>
												<td><input type="text" name="disposal_mode[c]" value="<?php echo $disposal_mode_c; ?>" class="form-control text-uppercase"><input type="text" name="disposal_mode[d]" value="<?php echo $disposal_mode_d; ?>" placeholder="Name of creek/estuary" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>(iii) into sea (Name of Sea)</td>
												<td><input type="text" name="disposal_mode[e]" value="<?php echo $disposal_mode_e; ?>" class="form-control text-uppercase"><input type="text" name="disposal_mode[f]" value="<?php echo $disposal_mode_f; ?>" placeholder="Name of sea" class="form-control text-uppercase"></td>
												
												<td>(iv) into drain / sewer (Owner of sewer) </td>
												<td><input type="text" name="disposal_mode[g]" value="<?php echo $disposal_mode_g; ?>" class="form-control text-uppercase"><input type="text" name="disposal_mode[h]" value="<?php echo $disposal_mode_h; ?>" placeholder="Owner of sewer" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(v) On land for irrigation on owned land / lease land. Specify cropped area.</td>
												<td><input type="text" name="disposal_mode[i]" value="<?php echo $disposal_mode_i; ?>" placeholder="Cropped Area in sq. meters" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(vi) Quantity of treated effluent reused / recycled,in m3 / day Provide a location map of disposal arrangement indicating the outlet (s) for sampling in upload section</td>
												<td><input type="text" name="disposal_mode[j]" placeholder="Quantity" value="<?php echo $disposal_mode_j; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">(vii) Provide a location map of disposal arrangement indicating the outlet(s) for sampling.</td>
												<td>(Upload Later in Checklist Section)</td>
											</tr>
											<tr>
												<td colspan="2" rowspan="3">25. (a) Quality of untreated / treated effluents (Specify pH and concentration of SS, BOD, COD and specific pollutants relevant to the industry. TDS to be reported</td>
												<td><input type="text" name="effluents_quality[a]" value="<?php echo $effluents_quality_a;?>" placeholder="pH" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[b]" value="<?php echo $effluents_quality_b;?>" placeholder="Concentration of Suspended Solid" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td><input type="text" name="effluents_quality[c]" value="<?php echo $effluents_quality_c;?>" placeholder="Biochemical Oxygen Demand" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[d]" value="<?php echo $effluents_quality_d;?>" placeholder="Chemical Oxygen Demand" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td><input type="text" name="effluents_quality[e]" value="<?php echo $effluents_quality_e;?>" placeholder="Specific Pollutants" class="form-control text-uppercase"></td>
												<td><input type="text" name="effluents_quality[f]" value="<?php echo $effluents_quality_f;?>" placeholder="Total Disolved Solids" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2">(b) Enclose a copy of the latest report of analysis from the laboratory approved by State Board / Committee / Central Board / Central Government in the Ministry of Environment & Forests. For proposed unit furnish expected characteristics of the untreated / treated effluent. </td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>d" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
									<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part - C : Air emission aspects</strong></td>
											</tr>
											<tr>
												<td colspan="4">26. Fuel consumption</td>
											</tr>
											<tr>
												<td colspan="4">
												 <table class="table table-responsive table-bordered">
													<tr>
														<td></td>
													  <td>Coal</td>
													  <td>LSHS</td>
													  <td>Furnace Oil</td>
													  <td>Natural gas</td>
													  <td>Others (Specify) <input type="text" class="form-control text-uppercase" name="fc[ot][sp1]" value="<?php echo $fc_ot_sp1; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel consumption (TPD / KLD)</td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][cl]" value="<?php echo $fc_tpd_cl; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ls]" value="<?php echo $fc_tpd_ls; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][fo]" value="<?php echo $fc_tpd_fo; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ng]" value="<?php echo $fc_tpd_ng; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[tpd][ot]" value="<?php echo $fc_tpd_ot;?>"   validate="decimal"  /></td>
													</tr>
													<tr>
													  <td>Calorific value</td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][cl]" value="<?php echo $fc_cv_cl; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ls]" value="<?php echo $fc_cv_ls; ?>"  validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][fo]" value="<?php echo $fc_cv_fo; ?>"  validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ng]" value="<?php echo $fc_cv_ng; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[cv][ot]" value="<?php echo $fc_cv_ot; ?>" validate="decimal" /></td>
													</tr>
													<tr>
													  <td><p>Ash content % </p></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][cl]" value="<?php echo $fc_ac_cl; ?>" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ls]" value="<?php echo $fc_ac_ls; ?>" validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][fo]" value="<?php echo $fc_ac_fo; ?>"  validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ng]" value="<?php echo $fc_ac_ng; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ac][ot]" value="<?php echo $fc_ac_ot; ?>"  validate="decimal" /></td>
													</tr>
													<tr>
													  <td><p>Sulphur content % </p></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][cl]" value="<?php echo $fc_sc_cl; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ls]" value="<?php echo $fc_sc_ls; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][fo]" value="<?php echo $fc_sc_fo; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ng]" value="<?php echo $fc_sc_ng; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[sc][ot]" value="<?php echo $fc_sc_ot; ?>"  validate="decimal"  /></td>
													</tr>
													<tr>
													  <td>Other  (specify) <input type="text" class="form-control text-uppercase" name="fc[ot][sp2]" value="<?php echo $fc_ot_sp2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][cl]" value="<?php echo $fc_ot_cl; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ls]" value="<?php echo $fc_ot_ls; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][fo]" value="<?php echo $fc_ot_fo; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ng]" value="<?php echo $fc_ot_ng; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="fc[ot][ot]" value="<?php echo $fc_ot_ot; ?>" validate="decimal" /></td>
													</tr>
												  </table>
												</td>
											</tr>
											<tr>
												<td colspan="4">27. (A) Details  of stack (process &amp; fuel stacks)</td>
											</tr>
											<tr>
												<td colspan="4">
												<table  class="table table-responsive table-bordered">        
													<tr>
													  <td style="width:200px;">Stack  number (s) </td>
													  <td align="center">1</td>
													  <td align="center">2</td>
													  <td align="center">3</td>
													  <td align="center">4</td>
													</tr>
													<tr>
													  <td>Attached  to</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn1]" id="textfield112" value="<?php echo $sd_at_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn2]" id="textfield113" value="<?php echo $sd_at_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn3]" id="textfield114" value="<?php echo $sd_at_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[at][sn4]" id="textfield115" value="<?php echo $sd_at_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Capacity </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn1]" id="textfield116" value="<?php echo $sd_ca_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn2]" id="textfield117" value="<?php echo $sd_ca_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn3]" id="textfield118" value="<?php echo $sd_ca_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ca][sn4]" id="textfield119" value="<?php echo $sd_ca_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel type</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn1]" id="textfield120" value="<?php echo $sd_ft_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn2]" id="textfield121" value="<?php echo $sd_ft_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn3]" id="textfield122" value="<?php echo $sd_ft_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ft][sn4]" id="textfield123" value="<?php echo $sd_ft_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Fuel quantity (TPD / KLD)</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn1]" id="textfield124" value="<?php echo $sd_fq_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn2]" id="textfield125" value="<?php echo $sd_fq_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn3]" id="textfield126" value="<?php echo $sd_fq_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[fq][sn4]" id="textfield127" value="<?php echo $sd_fq_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Material  of construction</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn1]" id="textfield128" value="<?php echo $sd_mc_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn2]" id="textfield129" value="<?php echo $sd_mc_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn3]" id="textfield130" value="<?php echo $sd_mc_sn3; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[mc][sn4]" id="textfield131" value="<?php echo $sd_mc_sn4; ?>" /></td>
													</tr>
													<tr>
													  <td>Shape (round / rectangular)</td>
													  <td><select name="sd[sh][sn1]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn1=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn1=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn2]" class="form-control text-uppercase">
															<option value="">Please Select</option>	
															<option <?php if($sd_sh_sn2=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn2=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn3]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn3=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn3=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													  <td><select name="sd[sh][sn4]" class="form-control text-uppercase">
															<option value="">Please Select</option>
															<option <?php if($sd_sh_sn4=="RO") echo "selected"; ?> value="RO">Round</option>
															<option <?php if($sd_sh_sn4=="RE") echo "selected"; ?> value="RE">Rectangular</option>
													  </select></td>
													</tr>
													<tr>
													  <td>Height,  m (above ground level) </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn1]" id="textfield136" value="<?php echo $sd_gl_sn1; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn2]" id="textfield137" value="<?php echo $sd_gl_sn2; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn3]" id="textfield138" value="<?php echo $sd_gl_sn3; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gl][sn4]" id="textfield139" value="<?php echo $sd_gl_sn4; ?>" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Diameter / size, in meters </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn1]" id="textfield140" value="<?php echo $sd_ds_sn1; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn2]" id="textfield141" value="<?php echo $sd_ds_sn2; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn3]" id="textfield142" value="<?php echo $sd_ds_sn3; ?>"  validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ds][sn4]" id="textfield143" value="<?php echo $sd_ds_sn4; ?>" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Gas quantity, Nm3 /  hr</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn1]" id="textfield144" value="<?php echo $sd_gq_sn1; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn2]" id="textfield145" value="<?php echo $sd_gq_sn2; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn3]" id="textfield146" value="<?php echo $sd_gq_sn3; ?>"  validate="decimal"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gq][sn4]" id="textfield147" value="<?php echo $sd_gq_sn4; ?>" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Gas temperature, (<sup>o</sup>C) </td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn1]" id="textfield148" value="<?php echo $sd_gt_sn1; ?>"  validate="decimal"  onchange="number(this.id)" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn2]" id="textfield149" value="<?php echo $sd_gt_sn2; ?>"  validate="decimal"  onchange="number(this.id)" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn3]" id="textfield150" value="<?php echo $sd_gt_sn3; ?>" validate="decimal"  onchange="number(this.id)" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gt][sn4]" id="textfield151" value="<?php echo $sd_gt_sn4; ?>"  validate="decimal" onchange="number(this.id)" /></td>
													</tr>
													<tr>
													  <td>Exit gas velocity, m / sec</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn1]" id="textfield152" value="<?php echo $sd_gv_sn1; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn2]" id="textfield153" value="<?php echo $sd_gv_sn2; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn3]" id="textfield154" value="<?php echo $sd_gv_sn3; ?>" validate="decimal" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[gv][sn4]" id="textfield155" value="<?php echo $sd_gv_sn4; ?>" validate="decimal" /></td>
													</tr>
													<tr>
													  <td>Control equipment preceding the stack</td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn1]" id="textfield156" value="<?php echo $sd_ce_sn1; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn2]" id="textfield157" value="<?php echo $sd_ce_sn2; ?>" /></td>
													  <td><input type="text" class="form-control text-uppercase" name="sd[ce][sn3]" id="textfield158" value="<?php echo $sd_ce_sn3; ?>" /></td>
													  <td><input type="text"  class="form-control text-uppercase" name="sd[ce][sn4]" id="textfield159" value="<?php echo $sd_ce_sn4; ?>" /></td>
													</tr>
													
												  </table>
												</td>
											</tr>
											<tr>
												 <td colspan="2">Attach specifications including residue management systems of each of the control equipment indicating inlet / outlet concentrations of relevant pollutants)</td>
												 <td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td  style="width:75%" colspan="3">(B) Whether any release of odoriferous compounds such as Mercaptans, Phorate etc. are coming out</td>
												<td><label class="radio-inline"><input type="radio" <?php if($is_odoriferous=="Y") echo "checked"; ?> value="Y" name="is_odoriferous"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_odoriferous=="N") echo "checked"; ?> name="is_odoriferous"> No </label></td>
											</tr>
											<tr>
												<td  style="width:75%" colspan="3">28. Do you have adequate facility for collection of samples of emissions in the form of port holes, platform, ladder etc. as per Central Board Publication "Emission Regulations Part-III"(December 1985)</td>
												<td>
												<label class="radio-inline"><input type="radio" value="Y" <?php if($is_adq_facility=="Y" || $is_adq_facility=="") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_adq_facility=="N") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility"> No </label>
												<label class="radio-inline"><input type="radio" value="NA" <?php if($is_adq_facility=="NA") echo "checked"; ?> id="inlineRadio1" name="is_adq_facility"> Not Applicable </label></td>
											</tr>
											<tr>
												<td colspan="2">29. Quality of treated flue gas emissions and process emissions.(Specify concentration of criteria pollutants and industry / process-specific pollutants stack-wise.) Enclose a copy of the latest report of analysis from the approved laboratory by State Board / Central Board / Central Government in the Ministry of Environment and Forests. For proposed units furnish the expected characteristics of the emission.</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=4" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>e" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
										<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
										<table class="table table-responsive">
											<tr>
												<td colspan="4"><strong>Part - D : Hazardous waste aspects</strong></td>
											</tr>
											<tr>
												<td colspan="2" rowspan="2">30. (a) Whether the unit is generating hazardous  waste as defined in the Hazardous Waste (Management and handling)  Rules, 1989, as amended.*</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_hazardous=="Y") echo "checked";?> id="inlineRadio1" checked name="is_hazardous"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_hazardous=="N") echo "checked";?> id="inlineRadio1" name="is_hazardous"> No </label></td>
											</tr>
											<tr>
												<td><input type="text" value="<?php if($is_hazardous=="Y") echo $haz_cat_no; else "";?>" <?php if($is_hazardous=="N") echo "disabled='disabled'";?> name="haz_cat_no" id="haz_cat_no" placeholder="Category Number" class="form-control text-uppercase"/></td>
											</tr>									
											<tr>
												<td>31. Authorization required for</td>
												<td colspan="2">
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_a=="C") echo "checked"; ?> name="auth_req[a]" value="C">Collection &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_b=="R") echo "checked"; ?> name="auth_req[b]" value="R">Reception &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_c=="TM") echo "checked"; ?> name="auth_req[c]" value="TM">Treatment &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_d=="TP") echo "checked"; ?> name="auth_req[d]" value="TP">Transport &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_e=="S") echo "checked"; ?> name="auth_req[e]" value="S">Storage &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($auth_req_f=="D") echo "checked"; ?> name="auth_req[f]" value="D">Disposal of the hazardous waste</label>
												</td>
											</tr>
											<tr>
												<td colspan="2">32. Quantity of hazardous waste generated (kg / day)  or (mt / month)</td>
												<td colspan="2"><input type="text" name="haz_qty" value="<?php echo $haz_qty;?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2">33. Characteristics of the hazardous waste(s). Specify concentration of relevant pollutants. (Enclose a copy of the latest report of analysis from the laboratory approved by 'State Board/Central Board/ Central Government in the Ministry of Environment and Forests ). For proposed units furnish expected characteristics.</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2">34. Mode of storage (intermediate or final) (describe area, location and methodology)</td>
												<td colspan="2"><input type="text" name="storage_mode" value="<?php echo $storage_mode; ?>"  class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td colspan="2">35. Present treatment of hazardous waste,  if any(give type and capacity of treatment units)</td>
												<td colspan="2"><input type="text" name="haz_pres_treatment" value="<?php echo $haz_pres_treatment; ?>" class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td colspan="4">36. Quantity of hazardous waste disposed</td>
											</tr>
											<tr>
												<td >(i) Within the factory</td>
												<td><input type="text" name="haz_qty_dispose[a]" id="textfield176" value="<?php echo $haz_qty_dispose_a; ?>" class="form-control text-uppercase">	</td>
												<td >(ii) Outside the factory (Specify location and enclose copies of agreement)	</td>
												<td><input type="text" name="haz_qty_dispose[b]" id="textfield176" value="<?php echo $haz_qty_dispose_b; ?>" class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td colspan="2">(iii) Through sale (Enclose documentary proof and copies of agreement) </td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td >(iv) Outside State / Union Territory , if yes particulars of (i) & (iii) above	</td>
												<td><input type="text" name="haz_qty_dispose[d]" value="<?php echo $haz_qty_dispose_d; ?>" class="form-control text-uppercase">	</td>
												<td >(v) Other (specify)</td>
												<td><input type="text" name="haz_qty_dispose[e]" value="<?php echo $haz_qty_dispose_e; ?>" class="form-control text-uppercase">	</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=5" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>f" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table7" class="tab-pane <?php echo $tabbtn7; ?>" role="tabpanel">
										<form name="myform2" class="myform1 submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4"><strong>Part - E : Additional information</strong></td>
											</tr>
											<tr>
												<td  colspan="2">37. (a) Do you have any proposals to upgrade the present system for treatment and disposal of effluent/ emission and / or hazardous waste<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_sys_upg == 'Y') echo 'checked'; ?> id="inlineRadio1" name="is_sys_upg" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_sys_upg == 'N') echo 'checked'; ?> id="inlineRadio1" name="is_sys_upg"> No </label></td>
											</tr>
											<tr>
												<td  colspan="2">37. (b) If yes, give the details with time-schedule for the implementation and approximate expenditure to be incurred on it.</td>
												<td colspan="2"><textarea type="text"  name="sys_upg_details" id="sys_upg_details" <?php if($is_sys_upg == 'N' || $is_sys_upg == '' ) echo 'disabled="disabled"'; ?> class="form-control text-uppercase"/><?php echo $sys_upg_details; ?></textarea></td>
											</tr>	
											<tr>
												<td colspan="2">38. Capital and recurring (O & M) expenditure on various aspects of environment protection such as effluent, emission ,hazardous waste, solid waste, tree plantation, monitoring, date acquisition etc. (give figures separately for items implemented / to be implemented).</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>										
											<tr>
												<td colspan="4">39. To which of the pollution control equipment, separate meters for recording consumption of electric energy are installed ?</td>
											</tr> 											
											<tr>
												<td colspan="4">
													<table class="table table-bordered table-responsive">
														<thead>
															<tr>
																<th>Pollution Control Equipment</th>
																<th>Emission/Effluent Type</th>
																<th>Seperate Meters are installed ?</th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td><input type="text" name="to_which[i]" value="<?php echo $to_which_i; ?>" placeholder="" class="form-control text-uppercase"></td>
																<td><input type="text" name="to_which[a]" value="<?php echo $to_which_a; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_b=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[b]"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_b=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[b]"> No </label>
																</td>
															</tr>
															<tr>
																<td><input type="text" name="to_which[j]" value="<?php echo $to_which_j; ?>" placeholder="" class="form-control text-uppercase"></td>
																<td><input type="text" name="to_which[c]" value="<?php echo $to_which_c; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_d=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[d]"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_d=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[d]"> No </label>
																</td>
															</tr>
															<tr>
																<td><input type="text" name="to_which[k]" value="<?php echo $to_which_k; ?>" placeholder="" class="form-control text-uppercase"></td>
																<td><input type="text" name="to_which[e]" value="<?php echo $to_which_e; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_f=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[f]"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_f=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[f]"> No </label>
																</td>
															</tr>
															<tr>
																<td><input type="text" name="to_which[l]" value="<?php echo $to_which_l; ?>" placeholder="" class="form-control text-uppercase"></td>
																<td><input type="text" name="to_which[g]" value="<?php echo $to_which_g; ?>" placeholder="Emission/Effluent Type" class="form-control text-uppercase"></td>
																<td>
																	<label class="radio-inline"><input type="radio" value="Y" <?php if($to_which_h=="Y") echo "checked"; ?> id="inlineRadio1" name="to_which[h]"> Yes </label>
																	<label class="radio-inline"><input type="radio" value="N" <?php if($to_which_h=="N") echo "checked"; ?> id="inlineRadio1" name="to_which[h]"> No </label>
																</td>
															</tr>
														</tbody>														
													</table>
												</td>
											</tr> 
											<tr>
												<td rowspan="4" colspan="2">40. Which of the pollution control items are connected to D.G. set (captive power source) to ensure their running in the event of normal power failure ?</td>
												<td colspan="2"><input type="text" name="dgset_items[a]" value="<?php echo $dgset_items_a; ?>" placeholder="" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2"><input type="text" name="dgset_items[b]" value="<?php echo $dgset_items_b; ?>" placeholder="" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2"><input type="text" name="dgset_items[c]" value="<?php echo $dgset_items_c; ?>" placeholder="" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2"><input type="text" name="dgset_items[d]" value="<?php echo $dgset_items_d; ?>" placeholder="" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="2">41. Nature, quantity and method of disposal of non-hazardous solid waste generated separately from the process of manufacture and waste treatment.(Give details of area / capacity available in applicant's land)</td>
												<td colspan="2"><input type="text" name="nonhaz_details" value="<?php echo $nonhaz_details; ?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2" >42. Hazardous Chemicals - Give details of chemicals and quantities handled and stored.</td>
												<td colspan="2" ><input type="text" name="haz_chemicals" value="<?php echo $haz_chemicals; ?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2">(i) Is the unit a Major Accident Hazard unit  as per MSIHC Rules ?<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_a == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[a]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_a == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[a]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">(ii) Is the unit an isolated storage as  defined under the MSIHC Rules ?<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_b == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[b]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_b == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[b]"> No </label></td>
											</tr>
											<tr> 
												<td colspan="2">(iii) Indicate status of compliance of Rules 5, 7, 10, 11, 1 2, 13 and 18 of the MSIHC Rules.</td>
												<td colspan="2"><input type="text" name="haz_chemicals_details[c]" value="<?php echo $haz_chemicals_details_c; ?>" class="form-control text-uppercase"/></td>
											</tr>
											<tr>
												<td colspan="2">(iv) Has approval of site been obtained from the concerned authority ?<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_d == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[d]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_d == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[d]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">(v) Has the unit prepared an Off-site Emergency Plan ?<span class="mandatory_field">*</span> </td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_e == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[e]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_e == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[e]"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">Is it updated ? <span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_f == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[f]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_f == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[f]"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">(vi) Has information on imports of chemicals been provided to the concerned authority ?<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_g == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[g]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_g == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[g]"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">(vii) Does the unit posses a policy  under the PLI Act?<span class="mandatory_field">*</span></td>
												<td colspan="2"><label class="radio-inline"><input type="radio" value="Y" <?php if($haz_chemicals_details_h == 'Y') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[h]" required="required"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($haz_chemicals_details_h == 'N') echo 'checked'; ?> id="inlineRadio1" name="haz_chemicals_details[h]"> No </label></td>
											</tr>
											<tr>
												<td colspan="2">43. Brief details of tree plantation / green belt development within applicant's premises (in hectares).</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2">44. Information of schemes for waste minimisation, resource recovery and recycling - implemented and to be implemented, separately.</td>
												<td colspan="2">Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2">45. (a) The applicant shall indicate whether industry comes under Public Hearing, if so, the relevant documents such as EIA, EMP, Risk Analysis etc. shall be submitted, if so, the relevant documents enclosed shall be indicated accordingly</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($public_hearing_doc != 'N' && $public_hearing_doc != '') echo 'checked'; ?> id="inlineRadio1" name="public_hearing_doc"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($public_hearing_doc == 'N' || $public_hearing_doc == '') echo 'checked'; ?> id="inlineRadio1" name="public_hearing_doc"> No </label></td>
												<td>Upload later in upload section</td>
											</tr>
											<tr>
												<td colspan="2">(b) Any other additional information that  the applicant desires to give.</td>
												<td colspan="2"><input type="text" name="other_info" value="<?php echo $other_info; ?>" class="form-control text-uppercase">	</td>
												<td ></td> 
												<td></td>
											</tr>
											<tr>
												<td colspan="2">46. Do You Have DG Set?</td>
												<td colspan="2"><label class="checkbox-inline"><input type="radio" value="Y" <?php if($dg_set=="Y" || $dg_set=="") echo "checked";?> name="dg_set" >Yes</label>
												<label class="checkbox-inline"><input type="radio" name="dg_set" value="N" <?php if($dg_set=="N") echo "checked";?> >No</label></td>
												<td colspan="2"></td>
											</tr>
                                       <tr>
												<td colspan=4>
													<table name="objectTable3" class="table table-responsive table-bordered "id="objectTable3" >
														<thead>
														<tr>
															<th>Sl No.</th>
															<th>Name</th>
															<th>Product ID</th>
															<th>Maker&apos;s Name</th>
															<th>Capacity</th>
															<th>Investment (only digit)</th>
															<th>Fuel Quantity<br/>per Annum</th>	
															<th>Stack Height</th>	
															<th>Control Equipment</th>	
															<th>Acoustic enclosure</th>
														</tr>
														</thead>
													<?php
													$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_dgsets where form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
													$count=1;
													while($row_3=$part3->fetch_array()){ ?>
													<tr>
														<td>
															<input readonly="readonly" id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $count; ?>" name="txxtA<?php echo $count;?>" size="1">
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtB<?php echo $count;?>" value="<?php echo $row_3["dg_name"]; ?>" name="txxtB<?php echo $count;?>"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtC<?php echo $count;?>" value="<?php echo $row_3["dg_pro_id"]; ?>" name="txxtC<?php echo $count;?>"/>
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtD<?php echo $count;?>" value="<?php echo $row_3["dg_maker"]; ?>" name="txxtD<?php echo $count;?>"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtE<?php echo $count;?>" value="<?php echo $row_3["dg_cap"]; ?>" name="txxtE<?php echo $count;?>"/>
														</td>
														<td>
															<input type="number" class="form-control text-uppercase" id="txxtF<?php echo $count;?>" value="<?php echo $row_3["dg_invest"]; ?>" name="txxtF<?php echo $count;?>"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtG<?php echo $count;?>" value="<?php echo $row_3["dg_fuel_q"]; ?>" name="txxtG<?php echo $count;?>"/>
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtH<?php echo $count;?>" value="<?php echo $row_3["dg_stack_h"]; ?>" name="txxtH<?php echo $count;?>" />
														</td>
														<td>
															<select class="form-control text-uppercase" id="txxtI<?php echo $count;?>" name="txxtI<?php echo $count;?>" >
																<option value="Y"  <?php if($row_3["dg_c_equip"]=="Y" || $row_3["dg_c_equip"]=="") echo "selected"; ?>>Yes</option>
																<option value="N" <?php if($row_3["dg_c_equip"]=="N") echo "selected"; ?>>No</option>
															</select>
														</td>
													   <td>
															<select class="form-control text-uppercase" id="txxtJ<?php echo $count;?>" name="txxtJ<?php echo $count;?>" >
																<option value="A" <?php if($row_3["dg_acoustic_e"]=="A") echo "selected"; ?>>Acoustic enclosure</option>
																<option value="NA" <?php if($row_3["dg_acoustic_e"]=="NA") echo "selected"; ?>>Not Applicable</option>
															</select>
														</td>
													</tr>	
													<?php $count++; 
													} 
												}else{	?>
													<tr>
														<td>
															<input value="1" readonly="readonly" id="txxtA1" size="1" class="form-control text-uppercase"; name="txxtA1">
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtB1" name="txxtB1"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtC1" name="txxtC1"/>
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtD1" name="txxtD1"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtE1" name="txxtE1"/>
														</td>
														<td>
															<input type="number"  class="form-control text-uppercase" id="txxtF1"  name="txxtF1"/>
														</td>				
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtG1" name="txxtG1"/>
														</td>
														<td>
															<input type="text" class="form-control text-uppercase" id="txxtH1" name="txxtH1"/>
														</td>
														<td>
															<select class="form-control text-uppercase" id="txxtI1" name="txxtI1">
																<option value="Y">Yes</option>
																<option value="N">No</option>
															</select>
														</td>
														 <td>
															<select class="form-control text-uppercase" id="txxtJ1" name="txxtJ1">
																<option value="A" selected>Acoustic enclosure</option>
																<option value="NA">Not Applicable</option>
															</select>
														</td>
													</tr>
												<?php } ?>
												</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
														<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
														<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/>
													</div>
                                          </td>
                                       </tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name; ?>.php?tab=6" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>g" class="btn btn-success text-bold submit1">Save and Next</button>
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
	$('input[name="is_res_colony"]').on('change', function(){
		if($(this).val() == 'N')
			$('#field12b, #field12c1, #field12c2, #field12c3').attr('disabled', 'disabled');
		else
			$('#field12b, #field12c1, #field12c2, #field12c3').removeAttr('disabled');
	});
	$('input[name="is_registered"]').on('change', function(){
		if($(this).val() == 'N')
			$('.is_registered').attr('disabled', 'disabled');
		else
			$('.is_registered').removeAttr('disabled');
	}); 
	$('input[name="is_hazardous"]').on('change', function(){
		if($(this).val() == 'N')
			$('#haz_cat_no').attr('disabled', 'disabled');
		else
			$('#haz_cat_no').removeAttr('disabled');
	});
	$('input[name="is_mixed"]').on('change', function(){
		if($(this).val() == 'N')
			$('#yes_detail').attr('disabled', 'disabled');
		else
			$('#yes_detail').removeAttr('disabled');
	});
	$('input[name="sump_capacity_radio"]').on('change', function(){
		if($(this).val() == 'N')
			$('.sump_capacity').attr('disabled', 'disabled');
		else
			$('.sump_capacity').removeAttr('disabled');
	}); 
	$('input[name="is_sys_upg"]').on('change', function(){
		if($(this).val() == 'N')
			$('#sys_upg_details').attr('disabled', 'disabled');
		else
			$('#sys_upg_details').removeAttr('disabled');
	});
	<?php if($public_hearing_doc == 'N' || $public_hearing_doc == '') echo "$('#public_hearing_doc_id').hide();"; ?>
	$('input[name="public_hearing_doc"]').on('change', function(){
		if($(this).val() == 'N')
			$('#public_hearing_doc_id').hide();
		else
			$('#public_hearing_doc_id').show();
	});
	<?php if($is_provided=="N"){ ?>
	$('#is_provided_yes').attr('disabled', 'disabled');
	<?php } ?>
	$('.file2').attr('disabled', 'disabled');
	$('input[name="is_provided"]').on('change', function(){
		if($(this).val() == 'N'){
			$('.file2').removeAttr('disabled');
			$('#is_provided_yes').removeAttr('disabled');
			$('#is_provided_yes').attr('disabled', 'disabled');			
			$('#is_provided_yes').val('');			
		}else{
			$('#is_provided_yes').removeAttr('disabled');
			$('.file2').removeAttr('disabled');
			$('.file2').attr('disabled', 'disabled');
		}
	});
	$('select[name="loc_feedback_select"]').on('change', function(){
		if($(this).val() == 'N'){
			$('#loc_feedback').removeAttr('readonly');
			$('#loc_feedback').val('');
			$('#loc_feedback').attr('readonly', 'readonly');			
		}else{
			$('#loc_feedback').removeAttr('readonly');
		}			
	});
	$('.wc_sum').on('change', function(){
		var sum = 0;
		$('.wc_sum').each(function(){
			if(!isNaN(parseFloat($(this).val()))){
				sum = sum + parseFloat($(this).val());
			}
			$('#wc_values_total').val(sum.toFixed(2));
		});
	});
	
	/* --------------addmore Operation---------------- */
	var field13Index = 1;
	$('#addMoreF13').on('click', function(){
		field13Index++;
		$('.multiRowF13').last().after('<tr class="multiRow"><td><input type="text" placeholder="Name" class="form-control text-uppercase"></td><td><input type="text" name="'+field13Index+'"placeholder="Quantity" class="form-control text-uppercase"></td><td><select class="form-control text-uppercase"><option>Choose a Unit</option><option>Tonnes per/month</option><option>Kilo Litre per/month </option><option>Numbers per/month </option></select></td></tr>');
	});
	var field14Index = 1;
	$('#addMoreF14').on('click', function(){
		field14Index++;
		$('.multiRowF14').last().after('<tr class="multiRow"><td><input type="text" placeholder="Name" class="form-control text-uppercase"></td><td><input type="text" name="'+field14Index+'"placeholder="Quantity" class="form-control text-uppercase"></td><td><select class="form-control text-uppercase"><option>Choose a Unit</option><option>Tonnes per/month</option><option>Kilo Litre per/month </option><option>Numbers per/month </option></select></td></tr>');
	});
	
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$(".myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>