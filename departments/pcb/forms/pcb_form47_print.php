<?php
$dept="pcb";
$form="47";
$table_name=getTableName($dept,$form);

if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$query=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b,".$table_name."_part2 c,".$table_name."_upload d where a.user_id='$swr_id' and a.form_id='$form_id' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$query=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b,".$table_name."_part2 c,".$table_name."_upload d where a.user_id='$swr_id' and a.uain='$uain' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$query=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b,".$table_name."_part2 c,".$table_name."_upload d where a.user_id='$swr_id' and a.form_id='$form_id' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id");	
}else{
	$query=$formFunctions->executeQuery($dept,"select * from ".$table_name." a,".$table_name."_part1 b,".$table_name."_part2 c,".$table_name."_upload d where a.user_id='$swr_id' and a.active='1' and b.form_id=a.form_id and c.form_id=a.form_id and d.form_id=a.form_id");
}

if($query->num_rows > 0){
	
	$results=$query->fetch_array();	
	
	$form_id=$results["form_id"];$dg_set=$results["dg_set"];
	if($dg_set=="Y"){
		$dg_set="YES";
	}else{
		$dg_set="NO";
	}
	
	if(!empty($results["application_for"])){				
		$application_for=json_decode($results["application_for"]);
		if(isset($application_for->a)) $application_for_a=$application_for->a; else $application_for_a="";
		if(isset($application_for->b)) $application_for_b=$application_for->b; else $application_for_b="";
		if(isset($application_for->c)) $application_for_c=$application_for->c; else $application_for_c="";			
	}else{
		$application_for_a="";$application_for_b="";$application_for_c="";
	}	
	/***********PART 1********/
	$revenue_survey_no=$results["revenue_survey_no"];$lb_name=$results["lb_name"];$lb_auth_name=$results["lb_auth_name"];$md_name=$results["md_name"];$is_registered=$results["is_registered"];$reg_no=$results["reg_no"];$from_year=$results["from_year"];$to_year=$results["to_year"];
	$reg_date=$results["reg_date"];		
	if($reg_date!="" && $reg_date!="0000-00-00"){
		$reg_date = date('d-m-Y',strtotime($reg_date));
	}else{
		$reg_date="";
	}
	if(!empty($results["plan_details"])){				
		$plan_details=json_decode($results["plan_details"]);
		$plan_details_prn=$plan_details->prn;$plan_details_dt=$plan_details->dt;$plan_details_ia=$plan_details->ia;			
	}else{
		$plan_details_prn="";$plan_details_dt="";$plan_details_ia="";
	}
	if($plan_details_dt!="0000-00-00" || $plan_details_dt!="") $plan_details_dt=date("d-m-Y",strtotime($plan_details_dt));
	else $plan_details_dt="";
	if(!empty($results["md_address"])){				
		$md_address=json_decode($results["md_address"]);
		$m_desig=$md_address->desig;$m_sn1=$md_address->st1;$m_sn2=$md_address->st2;$m_v=$md_address->vill;$m_d=$md_address->dist;$m_p=$md_address->pin;$m_m=$md_address->mn;$m_phn=$md_address->phn;$m_e=$md_address->email;				
	}else{
		$m_desig="";$m_sn1="";$m_sn2="";$m_v="";$m_d="";$m_p="";$m_m="";$m_phn="";$m_e="";
	}
	/******PART 2********/	
	$wb_name=$results["wb_name"];$loc_feedback=$results["loc_feedback"];$is_situated=$results["is_situated"];$is_provided=$results["is_provided"];$is_use=$results["is_use"];$staff_nos=$results["staff_nos"];$is_res_colony=$results["is_res_colony"];
		
	$loc_feedback = wordwrap($results["loc_feedback"], 40, "<br/>", true);
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
	$is_mixed=$results["is_mixed"];$yes_detail=$results["yes_detail"];$effluents_quality=$results["effluents_quality"];
	$sump_capacity=$results["sump_capacity"];	
	if(!empty($results["sump_capacity"])){
		$sump_capacity=json_decode($results["sump_capacity"]);
		$sump_capacity_a=$sump_capacity->a;$sump_capacity_b=$sump_capacity->b;
		$sump_capacity=$sump_capacity_a." <br/>Quantity in m3/day : ".$sump_capacity_b;
	}else{
		$sump_capacity="";
	}
	if($sump_capacity==""){
		$sump_capacity="N/A";
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
		if($sd_sh_sn1=="RO"){
			$sd_sh_sn1="ROUND";
		}else if($sd_sh_sn1=="RE"){
			$sd_sh_sn1="RECTANGULAR";
		}else{
			$sd_sh_sn1="";
		}
		if($sd_sh_sn2=="RO"){
			$sd_sh_sn2="ROUND";
		}else if($sd_sh_sn2=="RE"){
			$sd_sh_sn2="RECTANGULAR";
		}else{
			$sd_sh_sn2="";
		}
		if($sd_sh_sn3=="RO"){
			$sd_sh_sn3="ROUND";
		}else if($sd_sh_sn3=="RE"){
			$sd_sh_sn3="RECTANGULAR";
		}else{
			$sd_sh_sn3="";
		}
		if($sd_sh_sn4=="RO"){
			$sd_sh_sn4="ROUND";
		}else if($sd_sh_sn4=="RE"){
			$sd_sh_sn4="RECTANGULAR";
		}else{
			$sd_sh_sn4="";
		}
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
		
	if(!empty($results["auth_req_value"])){
		$auth_req=json_decode($results["auth_req_value"]);
		if(isset($auth_req->a)) $auth_req_value="Collection </br>"; else $auth_req_value="";
		if(isset($auth_req->b)) $auth_req_value=$auth_req_value."Reception </br>";
		if(isset($auth_req->c)) $auth_req_value=$auth_req_value."Treatment </br>";
		if(isset($auth_req->d)) $auth_req_value=$auth_req_value."Transport </br>";
		if(isset($auth_req->e)) $auth_req_value=$auth_req_value."Storage </br>";
		if(isset($auth_req->f)) $auth_req_value=$auth_req_value."Disposal of the hazardous waste </br>";
	}else{
		$auth_req_value="";
	}
	
	if(!empty($results["haz_qty_dispose"])){
		$haz_qty_dispose=json_decode($results["haz_qty_dispose"]);
		$haz_qty_dispose_a=$haz_qty_dispose->a;$haz_qty_dispose_b=$haz_qty_dispose->b;$haz_qty_dispose_d=$haz_qty_dispose->d;$haz_qty_dispose_e=$haz_qty_dispose->e;
	}else{
		$haz_qty_dispose_a="";$haz_qty_dispose_b="";$haz_qty_dispose_d="";$haz_qty_dispose_e="";
	}
	/******** PART 7*********************/	
	$is_sys_upg=$results["is_sys_upg"];$sys_upg_details=$results["sys_upg_details"];$nonhaz_details=$results["nonhaz_details"];$haz_chemicals=$results["haz_chemicals"];$other_info=$results["other_info"];$public_hearing_doc=$results["public_hearing_doc"];
	if($is_sys_upg=="N"){
		$is_sys_upg="NO";
		$sys_upg_details="N/A";
	}else{
		$is_sys_upg="YES";
	}
	$sys_upg_details=wordwrap($sys_upg_details,30,"<br/>",TRUE);
	if(!empty($results["haz_chemicals_details"])){
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
	$is_registered=($is_registered=="Y")?'YES':'NO';
	if($is_registered=="NO"){
		$reg_no="N/A";
		$reg_date="N/A";
	}
	$is_situated=($is_situated=="Y")?'YES':'NO';
	$is_provided=($is_provided=="Y")?'YES':'NO';
	if($is_provided=="NO"){
		$is_use="N/A";
	}
	$is_res_colony=($is_res_colony=="Y")?'YES':'NO';
	if($is_res_colony=="NO"){
		$colony_details_pop="N/A";
		$colony_details_loc="N/A";
		$colony_details_dis="N/A";
	}
	if($is_mixed=="Y"){
		$is_mixed="YES";
	}else{
		$is_mixed="NO";
		$yes_detail="N/A";
	}
	/* $is_mixed=($is_mixed=="Y")?'YES':'NO';
	if($is_mixed="NO"){
		$yes_detail="";
	} */
	$is_odoriferous=($is_odoriferous=="Y")?'YES':'NO';
	$is_hazardous=($is_hazardous=="Y")?'YES':'NO';
	if($is_hazardous=="NO"){
		$haz_cat_no="N/A";
	}
	$haz_chemicals_details_a=($haz_chemicals_details_a=="Y")?'YES':'NO';
	$haz_chemicals_details_b=($haz_chemicals_details_b=="Y")?'YES':'NO';
	$haz_chemicals_details_d=($haz_chemicals_details_d=="Y")?'YES':'NO';
	$haz_chemicals_details_e=($haz_chemicals_details_e=="Y")?'YES':'NO';
	$haz_chemicals_details_f=($haz_chemicals_details_f=="Y")?'YES':'NO';
	$haz_chemicals_details_g=($haz_chemicals_details_g=="Y")?'YES':'NO';
	$haz_chemicals_details_h=($haz_chemicals_details_h=="Y")?'YES':'NO';
	if($is_adq_facility=="NA"){
		$is_adq_facility="Not Applicable";
	}else if($is_adq_facility=="N"){
		$is_adq_facility="No";
	}else{
		$is_adq_facility="Yes";
	}
	
	$loc_feedback=($loc_feedback=="")? 'Not Applicable': $loc_feedback;	
	$to_which_b=($to_which_b=="Y")?"YES":"NO";
	$to_which_d=($to_which_d=="Y")?"YES":"NO";
	$to_which_f=($to_which_f=="Y")?"YES":"NO";
	$to_which_h=($to_which_h=="Y")?"YES":"NO";
	
	if($site_distance_b=="F"){
		$site_distance_b=$site_distance_a*0.3048;
		$site_distance_b=round($site_distance_b, 2);
	}else if($site_distance_b=="K"){
		$site_distance_b=$site_distance_a*1000;
	}else{
		$site_distance_b=$site_distance_a;
	}
	if($total_area_pau=="F"){
		$total_area_pa=$total_area_pa*0.092903;
		$total_area_pa=round($total_area_pa, 2);
	}else{
		$total_area_pa=$total_area_pa;
	}
	if($total_area_bau=="F"){
		$total_area_ba=$total_area_ba*0.092903;
		$total_area_ba=round($total_area_ba, 2);
	}else{
		$total_area_ba=$total_area_ba;
	}
	if($total_area_sau=="F"){
		$total_area_sa=$total_area_sa*0.092903;
		$total_area_sa=round($total_area_sa, 2);
	}else{
		$total_area_sa=$total_area_sa;
	}	
}
	$form_name=$formFunctions->get_formName($dept,$form);
	//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
		<head>
		<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
		</head>
	<body>';		
}else{
	$printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
	<div style="text-align:center">
		  <h4>'.$form_name.'</h4>
	</div><br/>  
  
<table class="table table-bordered table-responsive">
	<tr>
		<td>From : </td>
		<td>'.strtoupper($from).'</td>
	</tr>
	<tr>
    <td>Sir,</td>
    <td>I / We hereby apply for *<br/>';
	if(!empty($application_for_a)){
		$printContents=$printContents.'	(i) Consent to Operate under section 25 and 26 of the Water (Prevention and Control of Pollution) Act, 1974, as amended.<br/>';
	}
	if(!empty($application_for_b)){
		$printContents=$printContents.'	(ii) Consent to Operate under Section 21 of the Air (Prevention and Control of Pollution) Act, 1981, as amended.<br/>';
	}
	if(!empty($application_for_c)){
		$printContents=$printContents.'	(iii) Authorisation under rule 5 of the Hazardous Wastes (Management and Handling) Rules, 1989, as amended in connection with my / our existing / proposed / altered / additional manufacturing / processing activity from the premises as per the details given below.<br/>';
	}
	
    $printContents=$printContents.'	
    </td>
	</tr>

</table>
<b>Part A : General</b>
<table class="table table-bordered table-responsive">
    <tr>
			<td width="50%">For the year</td>
			<td>From &nbsp;&nbsp;'.strtoupper($from_year).' &nbsp;&nbsp;To&nbsp;&nbsp; '.strtoupper($to_year).'</td>
	</tr>
	<tr>
		<td>1. Name, designation, office address with  telephone, e-mail of the Applicant </td>
    <td>
    	<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($key_person).'</td>
      		</tr>
      		<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($status_applicant).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($pincode).'</td>
      		</tr>			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($landline_std).'&nbsp;-&nbsp;'.strtoupper($landline_no).'</td>
      		</tr>
      		<tr>
        			<td height="29">Email-id</td>
        			<td>'.$email.'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
  	<tr>
    	<td>2. (a) Name and location of the industrial unit / premises for which the application is made. (Give revenue Survey Number /plot number, name of Taluka and District also telephone)</td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($b_street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($b_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			<tr>
        			<td>Revenue Survey Number / Plot Number</td>
        			<td>'.strtoupper($revenue_survey_no).'</td>
      		</tr>
      		<tr>
        			<td>Mobile Number</td>
        			<td>+91&nbsp;-&nbsp;'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'&nbsp;-&nbsp;'.strtoupper($b_landline_no).'</td>
      		</tr>
    		</table>
    	</td>
  	</tr>
  	<tr>
		<td>(b) Details of the planning permission obtained from the local body / Town and Country Planning authority / metropolitan development authority / designate authority</td>
		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
				<td>Permission Reference No.</td>
				<td>'.strtoupper($plan_details_prn).'</td>
      		</tr>
      		<tr>
				<td>Date</td>
				<td>'.$plan_details_dt.'</td>
      		</tr>
			<tr>
				<td>Issuing Authority </td>
				<td>'.strtoupper($plan_details_ia).'</td>
      		</tr>
      		<tr>
				<td>Document is attached</td>
      		</tr>
    		</table>
		</td>
  	</tr>  	
  	<tr>
    	<td>(c) Name  of the local body under whose jurisdiction  the unit is located and name of  the licence issuing authority</td>
    	<td>Local Body Name : '.strtoupper($lb_name).'<br/>Licence Issuing Authority : '.strtoupper($lb_auth_name).'</td>
    </tr>
  	<tr>
    	<td>3. Names, addresses with telephone of Managing  Director/Managing Partner and officer responsible for matters connected with  pollution control  and / or hazardous waste disposal.</td>
    	<td>
    		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Name</td>
        			<td>'.strtoupper($md_name).'</td>
      		</tr>
      		<tr>
        			<td>Designation</td>
        			<td>'.strtoupper($m_desig).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($m_sn1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($m_sn2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($m_v).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($m_d).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($m_p).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91 &nbsp;'.strtoupper($m_m).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($m_phn).'</td>
      		</tr>
      		<tr>
        			<td>Email ID</td>
        			<td>'.$m_e.'</td>
      		</tr>
    		</table>
    	</td>
  	</tr>  	
  	<tr>
    	<td>4. (a) Are you registered as a small-scale industrial unit ?</td>
    	<td>'.$is_registered.'	</td>
  	</tr> 
	<tr>
    	<td>(b) If  yes, give the number and date of registration.</td>
    	<td>Reg. No. : '.strtoupper($reg_no).'<br/>Date of Registration : '.$reg_date.'</td>
  	</tr>
	<tr>
    	<td>5. Gross capital investment of the unit without depreciation till the date of application (Cost of building, land,plant and machinery)</td>
    	<td>'.strtoupper($investment_cost).'</td>
  	</tr>
	<tr>
    	<td>(To be supported by an affidavit, Annual Report or certificate from a Chartered Accountant. For proposed unit(s), give estimated figure)</td>
    	<td>Document is attached</td>
  	</tr>
  	<tr>
    	<td>6. If  the site is located near sea-shore / river bank / other water bodies; indicate the distance and the name of  the water body, if any</td>
    	<td>Distance :  '.strtoupper($site_distance_b).' meters<br/>Name of the water body :  '.strtoupper($wb_name).'</td>
  	</tr>  	  	
  	<tr>
    	<td>7. Does  the location satisfy the requirements under relevant Central / State Govt. notifications such as Coastal Regulation Zone, Notification on Ecologically  Fragile Area, Industrial location policy, etc. If so, give  details.</td>
    	<td>'.strtoupper($loc_feedback).'</td>
  	</tr>
	<tr>
		<td>8. If the site is situated in notified industrial estate </td>
		<td>'.$is_situated.'</td>
	</tr>
	<tr>
		<td>(a) whether effluent collection, treatment and disposal system has been provided by the authority</td>
    	<td>'.strtoupper($is_provided).'</td>
  	</tr>  	
  	<tr>
		<td>(b) will the applicant utilise the system, if provided</td>
    	<td>'.strtoupper($is_use).'</td>
  	</tr>
  	<tr>
		<td>(c) if not provided, details of proposed arrangement.</td>
    	<td>Document is attached</td>
  	</tr>  	
 	<tr>
    	<td>9. Total plot area, built-up area and area available for the use of treated sewage / trade effluent</td>
    	<td>Plot Area : '.strtoupper($total_area_pa).' sq. meters<br/>
    	Build-up Area : '.strtoupper($total_area_ba).' sq. meters<br/>
    	Area for Treated Sewage : '.strtoupper($total_area_sa).' sq. meters</td>
  	</tr>
  	<tr>
    	<td>10. Month and year of proposed commissioning of the unit</td>
    	<td>Month : '.date("F",strtotime($commission_my_m)).' &nbsp;&nbsp;&nbsp;&nbsp; Year : '.strtoupper($commission_my_y).'</td>
  	</tr>
  	<tr>
    	<td>11. Number  of workers and office staff.</td>
    	<td>'.strtoupper($staff_nos).'</td>
  	</tr>
	<tr>
    	<td>12.(a) Do you have a residential colony within the premises in respect of which the present application is	made ?</td>
    	<td>'.strtoupper($is_res_colony).'</td>
	</tr>
	<tr>
    	<td>(b) If yes, please state population staying</td>
    	<td>'.strtoupper($colony_details_pop).'</td>
	</tr>  
	<tr>
    	<td>(c) Indicate its location and distance with reference to plant site.</td>
    	<td>Location :  '.strtoupper($colony_details_loc).'<br/>
    	Distance :  '.strtoupper($colony_details_dis).'</td>
	</tr>
	<tr>
    	<td  colspan="2">13. List of products and by-products manufactured in tonnes / month,kl / month or numbers / month (Give figure corresponding to maximum installed production capacity)</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
		<thead>
		<tr>
			<th>Sl No.</th>
			<th>Name</th>
			<th>Type</th>
			<th>Quantity</th>
			<th>Units</th>	
		</tr>
		</thead>';
		$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_products where form_id='$form_id'");
		$num = $part1->num_rows;
		if($num>0){
			$sl=1;
			while($row_1=$part1->fetch_array()){
			$product_type=($row_1["product_type"]=="P")?"Product":"By-Product";
			if($row_1["unit"]=="T"){
				$unit="in tonnes / month";
			}else if($row_1["unit"]=="K"){
				$unit="in kl / month";
			}else if($row_1["unit"]=="KG"){
				$unit="in kg / month";
			}else{
				$unit="in numbers / month";
			}
			
			$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($sl).'</td>
					<td>'.strtoupper($row_1["name"]).'</td>
					<td>'.strtoupper($product_type).'</td>
					<td>'.strtoupper($row_1["qty"]).'</td>
					<td>'.$unit.'</td>
				</tr>';
				$sl++;
			}
		}else{
			$printContents=$printContents.'
				<tr>
					<td colspan="5">No records entered.</td>
				</tr>';
		}
		$printContents=$printContents.'
		</table>
	</td>
	</tr>
	<tr>
    	<td  colspan="2">14. List of raw materials and process chemicals with annual consumption corresponding to above stated production figures, in tonnes / month or kl / month or numbers / month.</td>
    </tr>
	<tr>
	<td colspan="2">
		<table class="table table-bordered table-responsive">
		<thead>
		<tr>
			<th>Sl No.</th>
			<th>Name</th>
			<th>Type</th>
			<th>Quantity</th>
			<th>Units</th>	
		</tr>
		</thead>';
		$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_materials where form_id='$form_id'");
		$num = $part1->num_rows;
		if($num>0){
			$sl=1;
			while($row_1=$part1->fetch_array()){
			$material_type=($row_1["material_type"]=="R")?"Raw material":"Process chemical";
			if($row_1["unit"]=="T"){
				$unit="in tonnes / month";
			}else if($row_1["unit"]=="K"){
				$unit="in kl / month";
			}else if($row_1["unit"]=="KG"){
				$unit="in kg / month";
			}else{
				$unit="in numbers / month";
			}
			
			$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($sl).'</td>
					<td>'.strtoupper($row_1["name"]).'</td>
					<td>'.strtoupper($material_type).'</td>
					<td>'.strtoupper($row_1["qty"]).'</td>
					<td>'.$unit.'</td>
				</tr>';
				$sl++;
			}
		}else{
			$printContents=$printContents.'
				<tr>
					<td colspan="5">No records entered.</td>
				</tr>';
		}
		$printContents=$printContents.'
		</table>
	</td>
	</tr>
	<tr>
    	<td>15.Description of process of manufacture for each of the products showing input, output, quality and quantity of solid, liquid and gaseous wastes, if any from each unit process. (To be supported by flow sheet and / or material balance and water balance sheet).</td>
    	<td>Document is attached</td>
	</tr>
  </table>
<!--//////////////////////////////////////section 3///////////////////////////////////-->
<b>Part B : Waste water aspects</b>
<table class="table table-bordered table-responsive">
  	<tr>
		<td colspan="2">16. Water  consumption for different uses (in m3 / day)</td>     
   </tr>
   <tr>
      <td>(i) Industrial cooling, spraying - in mine pits or boiler feeds.</td>
      <td>'.strtoupper($wc_values_a).'</td>
   </tr>
   <tr>
      <td> (ii) Domestic purpose</td>
      <td>'.strtoupper($wc_values_b).'</td>
   </tr>
   <tr>
      <td>(iii) Processing whereby water gets polluted and the pollutants are easily biodegradable</td>
      <td>'.strtoupper($wc_values_c).'</td>
   </tr>   
   <tr>
      <td>(iv) Processing whereby water gets polluted and the pollutants are not easily bio-degradable and are toxic</td>
      <td>'.strtoupper($wc_values_d).'</td>
   </tr>   
   <tr>
      <td>(v) Others such as agriculture, gardening etc. (specify)</td>
      <td>'.strtoupper($wc_values_e).'</td>
   </tr>   
   <tr>
      <td align="right">Total</td>
      <td>'.strtoupper($wc_values_f).'</td>
   </tr>   
    <tr>
		<td colspan="2">17. Source of water supply. Name of authority granting permission if applicable and quantity permitted</td>     
    </tr>
    <tr>
      <td>Source of water supply</td>
      <td>'.strtoupper($water_source_a).'</td>
    </tr>
    <tr>
      <td>Name of authority granting permission if applicable</td>
      <td>'.strtoupper($water_source_b).'</td>
    </tr>
    <tr>
      <td>Quantity permitted (in m3/day)</td>
      <td>'.strtoupper($water_source_c).'</td>
    </tr>    
    <tr>
		<td colspan="2">18. Quantity of waste water (effluent) generated (in m3 / day)</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
        <tr>
          <td width="25%">(i)  Domestic</td>
          <td width="25%">'.strtoupper($ww_qty_a).'</td>
		  <td width="25%">(v) Boiler Blowdown</td>
          <td width="25%">'.strtoupper($ww_qty_e).'</td>
        </tr>
        <tr>
          <td>(ii)  Industrial</td>
          <td>'.strtoupper($ww_qty_b).'</td>
		  <td>(vi) Cooling water blowdown</td>
          <td>'.strtoupper($ww_qty_f).'</td>
        </tr>
        <tr>
          <td>(iii)  Process</td>
          <td>'.strtoupper($ww_qty_c).'</td>
		  <td>(vii) DM Plant / Softening Plant  washings</td>
          <td>'.strtoupper($ww_qty_g).'</td>
        </tr>
        <tr>
          <td>(iv)  Washings </td>
          <td>   '.strtoupper($ww_qty_d).'</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </td>
    </tr>   
    <tr>
      <td>19.  Water budget calculations accounting for difference between water consumption and effluent generated. : </td>
      <td>'.strtoupper($budget_calc_a).' <br/>Document is attached</td>
    </tr>    
    <tr>
      <td>20.	Present treatment of sewage / canteen effluent (Give sizes / capacities of treatment units).</td>
      <td>'.strtoupper($sewage_treatment).'</td>
    </tr>
    <tr>
      <td>21. Present treatment of trade effluent (Give sizes / capacities of treatment units). (A schematic diagram of the treatment scheme with inlet / outlet characteristics of each unit operation / process is to be provided. Include details of residue management system (ETP sludges))
      </td>
      <td>Document is attached</td>
    </tr>    
    <tr>
      <td>22. (a) Are sewage and trade effluents mixed together ?	</td>
      <td>'.strtoupper($is_mixed).'</td>
    </tr>
    <tr>
      <td>(b) If yes , state at which stage whether before, intermittently or after treatment.</td>
      <td>'.strtoupper($yes_detail).'</td>
    </tr>
    <tr>
      <td>23. Capacity of treated effluent sump. Guard Pond if any.</td>
      <td>'.strtoupper($sump_capacity).'</td>
    </tr>
    <tr>
      <td  colspan="2" >24. Mode of disposal of treated effluents, with respective quantity, in m3 / day</td>     
    </tr>
    <tr>
      <td>(i) into stream / river (Name of river : '.strtoupper($disposal_mode_a).')</td>
       <td>'.strtoupper($disposal_mode_b).'</td>
    </tr>
    <tr>
     <td>(ii)	into creek / estuary (Name of creek/estuary : '.strtoupper($disposal_mode_c).')</td>
       <td>'.strtoupper($disposal_mode_d).'</td>
    </tr>    
    <tr>
      <td>(iii) into sea (Name of sea: '.strtoupper($disposal_mode_e).')</td>
       <td>'.strtoupper($disposal_mode_f).'</td>
    </tr>    
    <tr>
      <td>(iv)	into drain / sewer (Owner of sewer : '.strtoupper($disposal_mode_g).')	</td>
       <td>'.strtoupper($disposal_mode_h).'</td>
    </tr>    
    <tr>
      <td>(v) On land for irrigation on owned land / lease land. Specify cropped area.</td>
       <td>'.strtoupper($disposal_mode_i).'<br/></td>
    </tr>    
    <tr>
      <td>(vi)	Quantity of treated effluent reused / recycled, m3 / day Provide a location map of disposal arrangement indicating the outlet (s) for sampling</td>
       <td>'.strtoupper($disposal_mode_j).'<br/></td>
    </tr>    
    <tr>
      <td>(vii) Provide a location map of disposal arrangement indicating the outlet (s) for sampling</td>
       <td>Document is attached</td>
    </tr>    
    <tr>
    	<td  colspan="2">25. (a) Quality of untreated / treated effluents (Specify pH and concentration of SS, BOD, COD and specific pollutants relevant to the  industry. TDS to be reported</td>
  	</tr>
	<tr>
		<td>pH : '.$effluents_quality_a.'</td>
		<td>Concentration of Suspended Solid : '.$effluents_quality_b.'</td>
	</tr>
	<tr>
		<td>Biochemical Oxygen Demand : '.$effluents_quality_c.'</td>
		<td>Chemical Oxygen Demand : '.$effluents_quality_d.'</td>
	</tr>
	<tr>
		<td>Specific Pollutants : '.$effluents_quality_e.'</td>
		<td>Total Disolved Solids : '.$effluents_quality_f.'</td>
	</tr>
  	<tr>
    	<td>(b) Enclose a copy of the latest report of analysis from the laboratory approved by State Board / Committee / Central Board / Central Government in the Ministry of Environment &amp; Forests. For proposed unit furnish expected characteristics of the untreated / treated effluent. </td>
    	<td>Document is attached</td>
  	</tr>  
</table>  
<b>Part - C : Air emission asp ects</b>
<table class="table table-bordered table-responsive">
  <tr>
    <td colspan="2">26. Fuel consumption : 
     <table class="table table-bordered table-responsive">
        <tr>
		  <td width="20%"></td>
          <td width="15%">Coal</td>
          <td width="15%">LSHS</td>
          <td width="15%">Furnace Oil</td>
          <td width="15%">Natural gas</td>
          <td width="15%">Others(Specify) : '.$fc_ot_sp1.'</td>
        </tr>
        <tr>
          <td>Fuel  consumption (TPD / KLD)</td>
          <td>'.strtoupper($fc_tpd_cl).'</td>
          <td>'.strtoupper($fc_tpd_ls).'</td>
          <td>'.strtoupper($fc_tpd_fo).'</td>
          <td>'.strtoupper($fc_tpd_ng).'</td>
          <td>'.strtoupper($fc_tpd_ot).'</td>
        </tr>
        <tr>	
          <td>Calorific  value</td>
          <td>'.strtoupper($fc_cv_cl).'</td>
          <td>'.strtoupper($fc_cv_ls).'</td>
          <td>'.strtoupper($fc_cv_fo).'</td>
          <td>'.strtoupper($fc_cv_ng).'</td>
          <td>'.strtoupper($fc_cv_ot).'</td>
        </tr>
        <tr>
          <td>Ash content % </td>
          <td>'.strtoupper($fc_ac_cl).'</td>
          <td>'.strtoupper($fc_ac_ls).'</td>
          <td>'.strtoupper($fc_ac_fo).'</td>
          <td>'.strtoupper($fc_ac_ng).'</td>
          <td>'.strtoupper($fc_ac_ot).'</td>
        </tr>			
        <tr>
          <td>Sulphur content % </td>
          <td>'.strtoupper($fc_sc_cl).'</td>
          <td>'.strtoupper($fc_sc_ls).'</td>
          <td>'.strtoupper($fc_sc_fo).'</td>
          <td>'.strtoupper($fc_sc_ng).'</td>
          <td>'.strtoupper($fc_sc_ot).'</td>
        </tr>
        <tr>
          <td>Other (specify) : '.$fc_ot_sp2.'</td>
          <td>'.strtoupper($fc_ot_cl).'</td>
          <td>'.strtoupper($fc_ot_ls).'</td>
          <td>'.strtoupper($fc_ot_fo).'</td>
          <td>'.strtoupper($fc_ot_ng).'</td>
          <td>'.strtoupper($fc_ot_ot).'</td>
        </tr>
      </table></td>
    </tr>    
  <tr>
    <td colspan="2">27. (A) Details  of stack (process &amp; fuel stacks):<br/><br/>
      <table class="table table-bordered table-responsive">        
        <tr>
          <td style="width:200px;">Stack  number (s) </td>
          <td align="center">1</td>
          <td align="center">2</td>
          <td align="center">3</td>
          <td align="center">4</td>
        </tr>
        <tr>
          <td>Attached  to</td>
          <td>'.strtoupper($sd_at_sn1).'</td>
          <td>'.strtoupper($sd_at_sn2).'</td>
          <td>'.strtoupper($sd_at_sn3).'</td>
          <td>'.strtoupper($sd_at_sn4).'</td>
        </tr>
        <tr>
          <td>Capacity </td>
          <td>'.strtoupper($sd_ca_sn1).'</td>
          <td>'.strtoupper($sd_ca_sn2).'</td>
          <td>'.strtoupper($sd_ca_sn3).'</td>
          <td>'.strtoupper($sd_ca_sn4).'</td>
        </tr>
        <tr>
          <td>Fuel type</td>
          <td>'.strtoupper($sd_ft_sn1).'</td>
          <td>'.strtoupper($sd_ft_sn2).'</td>
          <td>'.strtoupper($sd_ft_sn3).'</td>
          <td>'.strtoupper($sd_ft_sn4).'</td>
        </tr>
        <tr>
          <td>Fuel quantity (TPD / KLD)</td>
          <td>'.strtoupper($sd_fq_sn1).'</td>
          <td>'.strtoupper($sd_fq_sn2).'</td>
          <td>'.strtoupper($sd_fq_sn3).'</td>
          <td>'.strtoupper($sd_fq_sn4).'</td>
        </tr>
        <tr>
          <td>Material  of construction</td>
          <td>'.strtoupper($sd_mc_sn1).'</td>
          <td>'.strtoupper($sd_mc_sn2).'</td>
          <td>'.strtoupper($sd_mc_sn3).'</td>
          <td>'.strtoupper($sd_mc_sn4).'</td>
        </tr>
        <tr>
          <td>Shape (round / rectangular)</td>
          <td>'.strtoupper($sd_sh_sn1).'</td>
          <td>'.strtoupper($sd_sh_sn2).'</td>
          <td>'.strtoupper($sd_sh_sn3).'</td>
          <td>'.strtoupper($sd_sh_sn4).'</td>
        </tr>
        <tr>
          <td>Height,  m (above ground level) </td>
          <td>'.strtoupper($sd_gl_sn1).'</td>
          <td>'.strtoupper($sd_gl_sn2).'</td>
          <td>'.strtoupper($sd_gl_sn3).'</td>
          <td>'.strtoupper($sd_gl_sn4).'</td>
        </tr>
        <tr>
          <td>Diameter / size, in meters </td>
          <td>'.strtoupper($sd_ds_sn1).'</td>
          <td>'.strtoupper($sd_ds_sn2).'</td>
          <td>'.strtoupper($sd_ds_sn3).'</td>
          <td>'.strtoupper($sd_ds_sn4).'</td>
        </tr>
        <tr>
          <td>Gas quantity, Nm3 /  hr</td>
          <td>'.strtoupper($sd_gq_sn1).'</td>
          <td>'.strtoupper($sd_gq_sn2).'</td>
          <td>'.strtoupper($sd_gq_sn3).'</td>
          <td>'.strtoupper($sd_gq_sn4).'</td>
        </tr>
        <tr>
          <td>Gas temperature, <sup>0</sup>C</td>
          <td>'.strtoupper($sd_gt_sn1).'</td>
          <td>'.strtoupper($sd_gt_sn2).'</td>
          <td>'.strtoupper($sd_gt_sn3).'</td>
          <td>'.strtoupper($sd_gt_sn4).'</td>
        </tr>
        <tr>
          <td>Exit gas velocity, m / sec</td>
          <td>'.strtoupper($sd_gv_sn1).'</td>
          <td>'.strtoupper($sd_gv_sn2).'</td>
          <td>'.strtoupper($sd_gv_sn3).'</td>
          <td>'.strtoupper($sd_gv_sn4).'</td>
        </tr>
        <tr>
          <td>Control equipment preceding the stack</td>
          <td>'.strtoupper($sd_ce_sn1).'</td>
          <td>'.strtoupper($sd_ce_sn2).'</td>
          <td>'.strtoupper($sd_ce_sn3).'</td>
          <td>'.strtoupper($sd_ce_sn4).'</td>
        </tr>
      </table>      
      </td>      
    </tr>    
    <tr>
    	<td width="50%">Attach  specifications including residue management systems of each of the control  equipment indicating inlet / outlet concentrations of relevant pollutants)</td>
    	<td>Document is attached</td>
    </tr>
  <tr>
    <td>27.(B) Whether any release of odoriferous compounds such as  Mercaptans, Phorate etc. are coming out</td>
    <td>'.strtoupper($is_odoriferous).'</td>
  </tr>
  
  <tr>
    <td>28. Do you have adequate facility for collection of samples of emissions in the form of port holes, platform, ladder etc. as per Central Board Publication &quot;Emission Regulations Part-III&quot; December 1985)</td>
    <td>'.strtoupper($is_adq_facility).'</td>
  </tr> 
  <tr>
    <td>29. Quality of treated flue gas emissions and process emissions.(Specify concentration of criteria pollutants and industry / process-specific pollutants stack-wise. Enclose a copy of the latest report of analysis from the approved laboratory by State Board / Central Board / Central Government in the Ministry of Environment and Forests. For proposed units furnish the expected characteristics of the emission</td>
    <td>Document is attached</td>
  </tr>
  </table>
<!--//////////////////////////////////////section 6///////////////////////////////////--> 
<b>Part - D : Hazardous waste aspects</b>
  <table class="table table-bordered table-responsive">
    <tr>
      <td width="50%">30. (a) Whether the unit is generating hazardous waste as defined in the Hazardous Waste (Management and handling) Rules, 1989, as amended.</td>
      <td>'.strtoupper($is_hazardous).'</td>
    </tr>
    <tr>
      <td>(b) If so, the category No.:</td>
      <td>'.strtoupper($haz_cat_no).'</td>
    </tr>
    <tr>
      <td>31. Authorization required for *</td>
      <td>'.strtoupper($auth_req_value).'</td>
    </tr>    
    <tr>
		<td>32. Quantity of hazardous waste generated (in kg / day) or (in mt / month)</td>
       <td>'.strtoupper($haz_qty).'</td>
    </tr>
    <tr>
      <td>33. Characteristics of the hazardous waste(s).Specify concentration of relevant pollutants. Enclose a copy of the latest report of analysis from the laboratory approved by State Board/Central Board/ Central Government in the Ministry of Environment and Forests ). For proposed units furnish expected characteristics.</td>
      <td>Document is attached</td>
    </tr>    
    <tr>
      <td>34. Mode of storage (intermediate or final) (describe area, location and methodology).</td>
       <td>'.strtoupper($storage_mode).'</td>
    </tr>    
    <tr>
    	<td>35. Present treatment of hazardous waste, if any (give type and capacity of treatment units)</td>
    	<td>'.strtoupper($haz_pres_treatment).'</td>
  	</tr>  
  	<tr>
      <td>36. Quantity . of hazardous waste disposed<br/>(i) Within the factory</td>
      <td>'.strtoupper($haz_qty_dispose_a).'</td>
    </tr>    
    <tr>
      <td>(ii) Outside the factory (Specify location and enclose copies of agreement)</td>
      <td>'.strtoupper($haz_qty_dispose_b).'</td>
    </tr> 
    <tr>
      <td>(iii) Through sale (Enclose documentary proof and copies of agreement)</td>
    <td>Document is attached</td>
    </tr>
    <tr>
      <td>(iv) Outside State / Union Territory , if yes particulars of (i) & (iii) above</td>
       <td>'.strtoupper($haz_qty_dispose_d).'</td>
    </tr>
    <tr>
      <td>(v) Other (specify)</td>
       <td>'.strtoupper($haz_qty_dispose_e).'</td>
    </tr>  
    </table>
<!--//////////////////////////////////////section 7///////////////////////////////////-->     
<b>Part - E : Additional information</b>
<table class="table table-bordered table-responsive">
    <tr>
      <td>37. (a) Do you have any proposals to upgrade the present system for treatment and disposal of effluent/ emission and / or hazardous waste</td>
      <td>'.strtoupper($is_sys_upg).'</td>
    </tr>	
    <tr>
      <td>37. (b) If yes, give the details with time-schedule for the implementation and approximate expenditure to be incurred on it.</td>
      <td>'.strtoupper($sys_upg_details).'</td>
    </tr>    
    <tr>
      <td>38. Capital and recurring (O & M) expenditure on various aspects of environment protection such as effluent, emission ,hazardous waste, solid waste, tree plantation, monitoring, date acquisition etc. (give figures separately for items implemented / to be implemented).</td>
    <td>Document is attached</td>
    </tr>
     <tr>
      <td colspan="2" valign="top">39. To which of the pollution control equipment, separate meters for recording consumption of electric energy are installed ?</td>
    </tr>
	<tr>
		<td colspan="2"><table class="table table-bordered table-responsive">
			<thead>
				<tr>
				<th width="40%">Pollution Control Equipment</th>
				<th width="30%">Emission/Effluent Type</th>
				<th width="30%">Seperate Meters are installed ?</th>
				</tr>
			</thead>
			<tr><td>'.strtoupper($to_which_i).'</td><td>'.strtoupper($to_which_a).'</td><td>'.$to_which_b.'</td></tr>
			<tr><td>'.strtoupper($to_which_j).'</td><td>'.strtoupper($to_which_c).'</td><td>'.$to_which_d.'</td></tr>
			<tr><td>'.strtoupper($to_which_k).'</td><td>'.strtoupper($to_which_e).'</td><td>'.$to_which_f.'</td></tr>
			<tr><td>'.strtoupper($to_which_l).'</td><td>'.strtoupper($to_which_g).'</td><td>'.$to_which_h.'</td></tr>
			</table>
		</td>
	</tr>
    <tr>
		<td rowspan="4" valign="top">40. Which of the pollution control items are connected to D.G. set (captive power source) to ensure their running in the event of normal power failure ?</td><td>'.strtoupper($dgset_items_a).'</td>
    </tr>
	<tr>
		<td>'.strtoupper($dgset_items_b).'</td>
	</tr>
	<tr>
		<td>'.strtoupper($dgset_items_c).'</td>
	</tr>
	<tr>
		<td>'.strtoupper($dgset_items_d).'</td>
	</tr>
    <tr>
      <td>41. Nature, quantity and method of disposal of non-hazardous solid waste generated separately from the process of manufacture and waste treatment. (Give details of area / capacity available in applicants land)</td>
      <td>'.strtoupper($nonhaz_details).'</td>
    </tr>
    
    <tr>
      <td>42. Hazardous Chemicals - Give details of chemicals and quantities handled and stored.</td>
      <td>'.strtoupper($haz_chemicals).'</td>
    </tr>
    <tr>
      <td>(i) Is the unit a Major Accident Hazard unit as per MSIHC Rules ?</td>
      <td>'.strtoupper($haz_chemicals_details_a).'</td>
    </tr>
    
    
    <tr>
      <td>(ii) Is the unit an isolated storage as defined under the MSIHC Rules ?</td>
      <td>'.strtoupper($haz_chemicals_details_b).'</td>
    </tr>
    
    <tr>
      <td>(iii) Indicate status of compliance of Rules 5, 7, 10, 11, 1 2, 13 and 18 of the MSIHC Rules.</td>
      <td>'.strtoupper($haz_chemicals_details_c).'</td>
    </tr>
    
    <tr>
      <td>(iv) Has approval of site been obtained from the concerned authority ?</td>
       <td>'.strtoupper($haz_chemicals_details_d).'</td>
    </tr>
    <tr>
      <td>(v) Has the unit prepared an Off-site Emergency Plan ? </td>
       <td>'.strtoupper($haz_chemicals_details_e).'<br/>Is it updated ? '.strtoupper($haz_chemicals_details_f).'</td>
    </tr>
    
     <tr>
      <td>(vi) Has information on imports of chemicals been provided to the concerned authority ?</td>
       <td>'.strtoupper($haz_chemicals_details_g).'</td>
    </tr>
     <tr>
      <td>(vii) Does the unit posses a policy under the PLI Act?</td>
       <td>'.strtoupper($haz_chemicals_details_h).'</td>
    </tr>
    <tr>
      <td>43. Brief details of tree plantation / green belt development within applicants premises (in hectares).</td>
       <td>Document is attached</td>
    </tr>    
    <tr>
      <td>44. Information of schemes for waste minimisation, resource recovery and recycling - implemented and to be implemented, separately.</td>
       <td>Document is attached</td>
    </tr> 
    <tr>
      <td>45. (a) The applicant shall indicate whether industry comes under Public Hearing, if so, the relevant documents such as EIA, EMP, Risk Analysis etc. shall be submitted, if so, the relevant documents enclosed shall be indicated accordingly</td>
       <td>'.$public_hearing_doc.'</td>
    </tr>    
    <tr>
      <td>(b) Any other additional information that the applicant desires to give.</td>
       <td>'.strtoupper($other_info).'</td>
    </tr>
    <tr>
         <td>46. Do You Have DG Set?</td>
         <td>'.strtoupper($dg_set).'</td>
    </tr>
    <tr>
        <td colspan="2">
		<table class="table table-bordered table-responsive">
            <thead>
                <tr>
                    <th>Sl No.</th>
                    <th>Name</th>
                    <th>Product ID</th>
                    <th>Maker&apos;s Name</th>
                    <th>Capacity</th>
                    <th>Investment</th>
                    <th>Fuel Quantity<br/>per Annum</th>	
                    <th>Stack Height</th>	
                    <th>Control Equipment</th>	
                    <th>Acoustic enclosure</th>
                </tr>
            </thead>';
            $part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_dgsets where form_id='$form_id'");
            $num3 = $part3->num_rows;
            if($num3>0){
                $sl=1;
                while($row_3=$part3->fetch_array()){
                if($row_3["dg_c_equip"]=="Y"){
                    $dg_c_equip="YES";
                }else{
                    $dg_c_equip="NO";
                }
                if($row_3["dg_acoustic_e"]=="A"){
                    $dg_acoustic_e="Acoustic enclosure";
                }elseif($row_3["dg_acoustic_e"]=="NA"){
                    $dg_acoustic_e="Not Applicable";
				}else{
                }
                
                $printContents=$printContents.'
                    <tr>
                        <td>'.strtoupper($sl).'</td>
                        <td>'.strtoupper($row_3["dg_name"]).'</td>
                        <td>'.strtoupper($row_3["dg_pro_id"]).'</td>
                        <td>'.strtoupper($row_3["dg_maker"]).'</td>
                        <td>'.strtoupper($row_3["dg_cap"]).'</td>
                        <td>'.strtoupper($row_3["dg_invest"]).'</td>
                        <td>'.strtoupper($row_3["dg_fuel_q"]).'</td>
                        <td>'.strtoupper($row_3["dg_stack_h"]).'</td>
                        <td>'.strtoupper($dg_c_equip).'</td>
                        <td>'.strtoupper($dg_acoustic_e).'</td>
                    </tr>';
                    $sl++;
                }
            }else{
                $printContents=$printContents.'
                    <tr>
                        <td colspan="5">No records entered.</td>
                    </tr>';
            }
            $printContents=$printContents.'
		</table>
        </td>
    </tr>  
    </table>
<!--//////////////////////////////////////section 8///////////////////////////////////-->
<table class="table table-bordered table-responsive">
    <tr>
      <td colspan="2" valign="top">47. I / We further declare that the information furnished above is correct to the best of my / our knowledge.</td>
    </tr>
    <tr>
      <td  colspan="2">48. I / We hereby submit that in case of any change from what is stated in this application in respect of raw materials, products, process of manufacture and treatment and / or disposal of effluent, emissions, hazardous wastes etc. in quality and quantity; a fresh application for Consent / Authorisation shall be made and until the grant of fresh Consent / Authorisation no change shall be made.</td>
    </tr>    
    <tr>
      <td  colspan="2">49. I / We undertake to furnish any other information within one month of its being called by the Board / Committee.</td>
    </tr>    
 	 <tr>
      <td  colspan="2">50. I / We agree to submit to the Board an application for renewal of consent / authorisation in two months in advance before the date of expiry of the consent / authorisation validity period:</td>
    </tr>
    ';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
       <tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
				<tr>
					<td>Place: '.strtoupper($dist).'<br/> Date : '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
					<td align="right">Yours faithfully,<br/>						
						Name: '.strtoupper($key_person).'<br/>
						Designation: '.strtoupper($status_applicant).'
					</td>
			</tr>
		</table>	
	</td>
    </tr>     
</table>
 ';
?>