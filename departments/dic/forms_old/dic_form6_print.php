<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form6 a, dic_form6_part1 b, dic_form6_upload c  where a.user_id='$swr_id' and a.form_id='$form_id' and b.form_id=a.form_id and c.form_id=a.form_id") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form6 a, dic_form6_part1 b, dic_form6_upload c  where a.uain='$uain' and a.user_id='$swr_id' and b.form_id=a.form_id and c.form_id=a.form_id") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form6 a, dic_form6_part1 b, dic_form6_upload c where a.user_id='$swr_id' and a.form_id='$form_id' and b.form_id=a.form_id and c.form_id=a.form_id") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form6 a, dic_form6_part1 b, dic_form6_upload c where a.user_id='$swr_id' and a.active='1' and b.form_id=a.form_id and c.form_id=a.form_id") or die($dic->error);
	}
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
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
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
	
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
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
		#### PART II #####	
			#### PART III #####	
			$tot_cov_area=$results['tot_cov_area'];$ann_rent=$results['ann_rent'];$build_loc=$results['build_loc'];$total_f_coloumn=$results['total_f_coloumn'];$total_fixed_capital=$results['total_fixed_capital'];
		
			if(!empty($results["building_construction"])){
				$building_construction=json_decode($results["building_construction"]);
				$building_construction_strt_dt=$building_construction->strt_dt;$building_construction_com_dt=$building_construction->comp_dt;$building_construction_total_area=$building_construction->total_area;$building_construction_total_cost=$building_construction->total_cost;$building_construction_direct_area=$building_construction->direct_area;$building_construction_direct_cost=$building_construction->direct_cost;
			}else{
				$building_construction_strt_dt="";$building_construction_com_dt="";$building_construction_total_area="";$building_construction_total_cost="";$building_construction_direct_area="";$building_construction_direct_cost="";
			}
			if(!empty($results["govt_agency"])){
				$govt_agency=json_decode($results["govt_agency"]);
				$govt_agency_name=$govt_agency->name;$govt_agency_sn1=$govt_agency->sn1;$govt_agency_sn2=$govt_agency->sn2;$govt_agency_town=$govt_agency->town;$govt_agency_dist=$govt_agency->dist;$govt_agency_pincode=$govt_agency->pincode;$govt_agency_mobile=$govt_agency->mobile;$govt_agency_email=$govt_agency->email;
			}else{
				$govt_agency_name="";$govt_agency_sn1="";$govt_agency_sn2="";$govt_agency_town="";$govt_agency_dist="";$govt_agency_pincode="";$govt_agency_mobile="";$govt_agency_email="";
			}
			if(!empty($results["build_reg"])){
				$build_reg=json_decode($results["build_reg"]);
				$build_reg_no=$build_reg->no;$build_reg_dt=$build_reg->dt;
			}else{
				$build_reg_no="";$build_reg_dt="";
			}
			if(!empty($results["val_period"])){
				$val_period=json_decode($results["val_period"]);
				$val_period_rent_from=$val_period->rent_from;$val_period_rent_to=$val_period->rent_to;
			}else{
				$val_period_rent_from="";$val_period_rent_to="";
			}
			if(!empty($results["land"])){
				$land=json_decode($results["land"]);
				$land_prior=$land->prior;$land_additional=$land->additional;$land_total=$land->total;
			}else{
				$land_prior="";$land_additional="";$land_total="";
			}
			if(!empty($results["site"])){
				$site=json_decode($results["site"]);
				$site_prior=$site->prior;$site_additional=$site->additional;$site_total=$site->total;
			}else{
				$site_prior="";$site_additional="";$site_total="";
			}
			if(!empty($results["fact_direct"])){
				$fact_direct=json_decode($results["fact_direct"]);
				$fact_direct_prior=$fact_direct->prior;$fact_direct_additional=$fact_direct->additional;$fact_direct_total=$fact_direct->total;
			}else{
				$fact_direct_prior="";$fact_direct_additional="";$fact_direct_total="";
			}
			if(!empty($results["office_direct"])){
				$office_direct=json_decode($results["office_direct"]);
				$office_direct_prior=$office_direct->prior;$office_direct_additional=$office_direct->additional;$office_direct_total=$office_direct->total;
			}else{
				$office_direct_prior="";$office_direct_additional="";$office_direct_total="";
			}
			if(!empty($results["plant"])){
				$plant=json_decode($results["plant"]);
				$plant_prior=$plant->prior;$plant_additional=$plant->additional;$plant_total=$plant->total;
			}else{
				$plant_prior="";$plant_additional="";$plant_total="";
			}
			if(!empty($results["equip"])){
				$equip=json_decode($results["equip"]);
				$equip_prior=$equip->prior;$equip_additional=$equip->additional;$equip_total=$equip->total;
			}else{
				$equip_prior="";$equip_additional="";$equip_total="";
			}
			if(!empty($results["power"])){
				$power=json_decode($results["power"]);
				$power_prior=$power->prior;$power_additional=$power->additional;$power_total=$power->total;
			}else{
				$power_prior="";$power_additional="";$power_total="";
			}
			if(!empty($results["electrical"])){
				$electrical=json_decode($results["electrical"]);
				$electrical_prior=$electrical->prior;$electrical_additional=$electrical->additional;$electrical_total=$electrical->total;
			}else{
				$electrical_prior="";$electrical_additional="";$electrical_total="";
			}
			if(!empty($results["utility"])){
				$utility=json_decode($results["utility"]);
				$utility_prior=$utility->prior;$utility_additional=$utility->additional;$utility_total=$utility->total;
			}else{
				$utility_prior="";$utility_additional="";$utility_total="";
			}
			if(!empty($results["misc"])){
				$misc=json_decode($results["misc"]);
				$misc_prior=$misc->prior;$misc_additional=$misc->additional;$misc_total=$misc->total;
			}else{
				$misc_prior="";$misc_additional="";$misc_total="";
			}
			if(!empty($results["prelim"])){
				$prelim=json_decode($results["prelim"]);
				$prelim_prior=$prelim->prior;$prelim_additional=$prelim->additional;$prelim_total=$prelim->total;
			}else{
				$prelim_prior="";$prelim_additional="";$prelim_total="";
			}
			##### PART IV #####
			$total_contribution=$results['total_contribution'];
			
			if(!empty($results["sources_f_finance"])){
				$sources_f_finance=json_decode($results["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results["financial_ins"])){
				$financial_ins=json_decode($results["financial_ins"]);
				$financial_ins_prior=$financial_ins->prior;$financial_ins_additional=$financial_ins->additional;$financial_ins_tot=$financial_ins->tot;
			}else{
				$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";
			}
			if(!empty($results["term"])){
				$term=json_decode($results["term"]);
				$term_prior=$term->prior;$term_additional=$term->additional;$term_tot=$term->tot;
			}else{
				$term_prior="";$term_additional="";$term_tot="";
			}
			if(!empty($results["wc"])){
				$wc=json_decode($results["wc"]);
				$wc_prior=$wc->prior;$wc_additional=$wc->additional;$wc_tot=$wc->tot;
			}else{
				$wc_prior="";$wc_additional="";$wc_tot="";
			}
			if(!empty($results["tl"])){
				$tl=json_decode($results["tl"]);
				$tl_prior=$tl->prior;$tl_additional=$tl->additional;$tl_tot=$tl->tot;
			}else{
				$tl_prior="";$tl_additional="";$tl_tot="";
			}
			if(!empty($results["roi_tl"])){
				$roi_tl=json_decode($results["roi_tl"]);
				$roi_tl_prior=$roi_tl->prior;$roi_tl_additional=$roi_tl->additional;$roi_tl_tot=$roi_tl->tot;
			}else{
				$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";
			}
			if(!empty($results["repayment"])){
				$repayment=json_decode($results["repayment"]);
				$repayment_prior=$repayment->prior;$repayment_additional=$repayment->additional;$repayment_tot=$repayment->tot;
			}else{
				$repayment_prior="";$repayment_additional="";$repayment_tot="";
			}
			if(!empty($results["tl_amt"])){
				$tl_amt=json_decode($results["tl_amt"]);
				$tl_amt_prior=$tl_amt->prior;$tl_amt_additional=$tl_amt->additional;$tl_amt_tot=$tl_amt->tot;
			}else{
				$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";
			}
			if(!empty($results["tl_date"])){
				$tl_date=json_decode($results["tl_date"]);
				$tl_date_prior=$tl_date->prior;$tl_date_additional=$tl_date->additional;$tl_date_tot=$tl_date->tot;
			}else{
				$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";
			}
			if(!empty($results["wor_cap"])){
				$wor_cap=json_decode($results["wor_cap"]);
				$wor_cap_prior=$wor_cap->prior;$wor_cap_additional=$wor_cap->additional;$wor_cap_tot=$wor_cap->tot;
			}else{
				$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";
			}
			if(!empty($results["wor_dat"])){
				$wor_dat=json_decode($results["wor_dat"]);
				$wor_dat_prior=$wor_dat->prior;$wor_dat_additional=$wor_dat->additional;$wor_dat_tot=$wor_dat->tot;
			}else{
				$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
			}
			if(!empty($results["quant"])){
				$quant=json_decode($results["quant"]);
				$quant_prior=$quant->prior;$quant_additional=$quant->additional;$quant_tot=$quant->tot;
			}else{
				$quant_prior="";$quant_additional="";$quant_tot="";
			}
			if(!empty($results["quant_let"])){
				$quant_let=json_decode($results["quant_let"]);
				$quant_let_prior=$quant_let->prior;$quant_let_additional=$quant_let->additional;$quant_let_tot=$quant_let->tot;
			}else{
				$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";
			}
			if(!empty($results["quant_dat"])){
				$quant_dat=json_decode($results["quant_dat"]);
				$quant_dat_prior=$quant_dat->prior;$quant_dat_additional=$quant_dat->additional;$quant_dat_tot=$quant_dat->tot;
			}else{
				$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";
			}
			if(!empty($results["elec"])){
				$elec=json_decode($results["elec"]);
				$elec_prior=$elec->prior;$elec_additional=$elec->additional;$elec_tot=$elec->tot;
			}else{
				$elec_prior="";$elec_additional="";$elec_tot="";
			}
			if(!empty($results["elec_dat"])){
				$elec_dat=json_decode($results["elec_dat"]);
				$elec_dat_prior=$elec_dat->prior;$elec_dat_additional=$elec_dat->additional;$elec_dat_tot=$elec_dat->tot;
			}else{
				$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";
			}
			if(!empty($results["ser_en"])){
				$ser_en=json_decode($results["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results["ser_en"])){
				$ser_en=json_decode($results["ser_en"]);
				$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;$ser_en_tot=$ser_en->tot;
			}else{
				$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
			}
			if(!empty($results["est_amt"])){
				$est_amt=json_decode($results["est_amt"]);
				$est_amt_prior=$est_amt->prior;$est_amt_additional=$est_amt->additional;$est_amt_tot=$est_amt->tot;
			}else{
				$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";
			}
			if(!empty($results["est_mr"])){
				$est_mr=json_decode($results["est_mr"]);
				$est_mr_prior=$est_mr->prior;$est_mr_additional=$est_mr->additional;$est_mr_tot=$est_mr->tot;
			}else{
				$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
			}
			if(!empty($results["est_dat"])){
				$est_dat=json_decode($results["est_dat"]);
				$est_dat_prior=$est_dat->prior;$est_dat_additional=$est_dat->additional;$est_dat_tot=$est_dat->tot;
			}else{
				$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";
			}
			if(!empty($results["sub_expan"])){
				$sub_expan=json_decode($results["sub_expan"]);
				$sub_expan_prior=$sub_expan->prior;$sub_expan_additional=$sub_expan->additional;$sub_expan_tot=$sub_expan->tot;
			}else{
				$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";
			}
			if(!empty($results["sub_dat"])){
				$sub_dat=json_decode($results["sub_dat"]);
				$sub_dat_prior=$sub_dat->prior;$sub_dat_additional=$sub_dat->additional;$sub_dat_tot=$sub_dat->tot;
			}else{
				$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";
			}
			if(!empty($results["mr_subexpan"])){
				$mr_subexpan=json_decode($results["mr_subexpan"]);
				$mr_subexpan_prior=$mr_subexpan->prior;$mr_subexpan_additional=$mr_subexpan->additional;$mr_subexpan_tot=$mr_subexpan->tot;
			}else{
				$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";
			}
			if(!empty($results["mr_subexpan_dat"])){
				$mr_subexpan_dat=json_decode($results["mr_subexpan_dat"]);
				$mr_subexpan_dat_prior=$mr_subexpan_dat->prior;$mr_subexpan_dat_additional=$mr_subexpan_dat->additional;$mr_subexpan_dat_tot=$mr_subexpan_dat->tot;
			}else{
				$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
			}
			if(!empty($results["total_expenditure"])){
				$total_expenditure=json_decode($results["total_expenditure"]);
				$total_expenditure_prior=$total_expenditure->prior;$total_expenditure_additional=$total_expenditure->additional;$total_expenditure_tot=$total_expenditure->tot;
			}else{
				$total_expenditure_prior="";$total_expenditure_additional="";$total_expenditure_tot="";
			}
			##### PART V #####
			$bef_sub_expan=$results['bef_sub_expan'];$after_sub_expan=$results['after_sub_expan'];$total_12d_prod=$results['total_12d_prod'];
			
			
			##### PART VI #####
			$mandays_utilized=$results['mandays_utilized'];
			if(!empty($results["managerial"])){
				$managerial=json_decode($results["managerial"]);
				$managerial_assam_prior=$managerial->assam_prior;$managerial_nonassam_prior=$managerial->nonassam_prior;$managerial_assam_after=$managerial->assam_after;$managerial_nonassam_after=$managerial->nonassam_after;$managerial_total=$managerial->total;
			}else{
				$managerial_assam_prior="";$managerial_nonassam_prior="";$managerial_assam_after="";$managerial_nonassam_after="";$managerial_total="";
			}
			if(!empty($results["super"])){
				$super=json_decode($results["super"]);
				$super_assam_prior=$super->assam_prior;$super_nonassam_prior=$super->nonassam_prior;$super_assam_after=$super->assam_after;$super_nonassam_after=$super->nonassam_after;$super_total=$super->total;
			}else{
				$super_assam_prior="";$super_nonassam_prior="";$super_assam_after="";$super_nonassam_after="";$super_total="";
			}
			if(!empty($results["skilled"])){
				$skilled=json_decode($results["skilled"]);
				$skilled_assam_prior=$skilled->assam_prior;$skilled_nonassam_prior=$skilled->nonassam_prior;$skilled_assam_after=$skilled->assam_after;$skilled_nonassam_after=$skilled->nonassam_after;$skilled_total=$skilled->total;
			}else{
				$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";
			}
			if(!empty($results["semiskilled"])){
				$semiskilled=json_decode($results["semiskilled"]);
				$semiskilled_assam_prior=$semiskilled->assam_prior;$semiskilled_nonassam_prior=$semiskilled->nonassam_prior;$semiskilled_assam_after=$semiskilled->assam_after;$semiskilled_nonassam_after=$semiskilled->nonassam_after;$semiskilled_total=$semiskilled->total;
			}else{
				$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";
			}
			if(!empty($results["unskilled"])){
				$unskilled=json_decode($results["unskilled"]);
				$unskilled_assam_prior=$unskilled->assam_prior;$unskilled_nonassam_prior=$unskilled->nonassam_prior;$unskilled_assam_after=$unskilled->assam_after;$unskilled_nonassam_after=$unskilled->nonassam_after;$unskilled_total=$unskilled->total;
			}else{
				$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";
			}
			if(!empty($results["total"])){
				$total=json_decode($results["total"]);
				$total_assam_prior=$total->assam_prior;$total_nonassam_prior=$total->nonassam_prior;$total_assam_after=$total->assam_after;$total_nonassam_after=$total->nonassam_after;$total_total=$total->total;
			}else{
				$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";
			}
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];$file11=$results["file11"];$file12=$results["file12"];$file13=$results["file13"];$file14=$results["file14"];$file15=$results["file15"];$file16=$results["file16"];$file17=$results["file17"];$file18=$results["file18"];$file19=$results["file19"];$file20=$results["file20"];$file21=$results["file21"];$file22=$results["file22"];$file23=$results["file23"];
			if(!isset($css)){
				$val1=$formFunctions->get_uploadFile($file1);
				$val2=$formFunctions->get_uploadFile($file2);
				$val3=$formFunctions->get_uploadFile($file3);
				$val4=$formFunctions->get_uploadFile($file4);
				$val5=$formFunctions->get_uploadFile($file5);
				$val6=$formFunctions->get_uploadFile($file6);
				$val7=$formFunctions->get_uploadFile($file7);
				$val8=$formFunctions->get_uploadFile($file8);
				$val9=$formFunctions->get_uploadFile($file9);
				$val10=$formFunctions->get_uploadFile($file10);
				$val11=$formFunctions->get_uploadFile($file11);
				$val12=$formFunctions->get_uploadFile($file12);
				$val13=$formFunctions->get_uploadFile($file13);
				$val14=$formFunctions->get_uploadFile($file14);
				$val15=$formFunctions->get_uploadFile($file15);
				$val16=$formFunctions->get_uploadFile($file16);
				$val17=$formFunctions->get_uploadFile($file17);
				$val18=$formFunctions->get_uploadFile($file18);
				$val19=$formFunctions->get_uploadFile($file19);
				$val20=$formFunctions->get_uploadFile($file20);
				$val21=$formFunctions->get_uploadFile($file21);
				$val22=$formFunctions->get_uploadFile($file22);
				$val23=$formFunctions->get_uploadFile($file23);
			}else{
				$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
				$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
				$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
				$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
				$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
				$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
				$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
				$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
				$val9=$formFunctions->get_useruploadFile($file9,$applicant_id);
				$val10=$formFunctions->get_useruploadFile($file10,$applicant_id);
				$val11=$formFunctions->get_useruploadFile($file11,$applicant_id);
				$val12=$formFunctions->get_useruploadFile($file12,$applicant_id);
				$val13=$formFunctions->get_useruploadFile($file13,$applicant_id);
				$val14=$formFunctions->get_useruploadFile($file14,$applicant_id);
				$val15=$formFunctions->get_useruploadFile($file15,$applicant_id);
				$val16=$formFunctions->get_useruploadFile($file16,$applicant_id);
				$val17=$formFunctions->get_useruploadFile($file17,$applicant_id);
				$val18=$formFunctions->get_useruploadFile($file18,$applicant_id);
				$val19=$formFunctions->get_useruploadFile($file19,$applicant_id);
				$val20=$formFunctions->get_useruploadFile($file20,$applicant_id);
				$val21=$formFunctions->get_useruploadFile($file21,$applicant_id);
				$val22=$formFunctions->get_useruploadFile($file22,$applicant_id);
				$val23=$formFunctions->get_useruploadFile($file23,$applicant_id);
			}
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
					$courier_details=json_decode($results["courier_details"]);
					$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
	if($land_owned=="L") $land_owned="OWNED";	else $land_owned="LEASED";
    $form_name=$formFunctions->get_formName('dic','6');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 6</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>Form- LM-1<br/>[See rule 11 (1)]<br/>'.$form_name.'</h4>
		</div><br/>
		<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>  				
				<td valign="top" width="50%">1. (a) (i) Name of the Industrial unit :</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>  				
				<td valign="top" width="50%">  (ii) PAN no of the unit :</td>
				<td>'.strtoupper($pan_no).'</td>
			</tr>
			<tr>
				<td valign="top">(b)  Factory address :</td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Street Name 1</td>
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
						<td>Mobile No.</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID</td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td valign="top">(c) Office address with telephone / mobile no ( if any) :</td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($b_street_name3).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($b_street_name4).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($b_vill2).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist2).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($b_pincode2).'</td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td>'.strtoupper($office_mob).'</td>
					</tr>
					<tr>
						<td>E-Mail ID</td>
						<td>'.$office_email.'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>  				
				<td valign="top" width="50%"> 2. (a) Constitution of the organization promoting the unit (Whether Proprietorial / partnership / Private Limited / Limited company / Cooperative Society/trust/any other legal entity )</td>
				<td style="width:50%">'.strtoupper($l_o_business_val).'</td>
			</tr>
			<tr>
				<td colspan="2"> (b) Name(s) , Permanent address(es) of the Proprietor/ Partners / Directors/ Secretary / President /chairman/CEO/Trustee etc with the mention of their permanent Account No (PAN) : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
						<thead>
						<tr>
							<th align="center">Sl No</th>
							<th align="center">Partners/Directors Name</th>
							<th align="center">Street Name 1</th>
							<th align="center">Street Name 2</th>
							<th align="center">Village/Town</th>
							<th align="center">District</th>
							<th align="center">Pincode</th>
							<th align="center">PAN No.</th>
						</tr>
						<thead>';
						$results1=$dic->query("select * from dic_form6_members where form_id='$form_id'") or die("Error : ".$dic->error);
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
							<tr align="center">
									<td>'.$sl.'</td>
									<td>'.strtoupper($rows->name).'</td>
									<td>'.strtoupper($rows->sn1).'</td>
									<td>'.strtoupper($rows->sn2).'</td>
									<td>'.strtoupper($rows->vill).'</td>
									<td>'.strtoupper($rows->dist).'</td>
									<td>'.strtoupper($rows->pin).'</td>
									<td>'.strtoupper($rows->pan).'</td>
							</tr>';
							$sl++;
							}$printContents=$printContents.'
					</table>
				<td>
			</tr>
			<tr>
				<td>(c) No and date of Registration under the concerned Act (e.g Companies act, partnership act etc.) :</td>
				<td>Registration Number : '.strtoupper($act_reg_no).'<br/>
					Registration Date  : '.strtoupper($act_reg_date).' 
				</td>
			</tr>
			<tr>
				<td>(d) Registered Head Office of the promoter organization :</td>
				<td>'.strtoupper($act_reg_office).'</td>
			</tr>				
			<tr>
				<td colspan="2">3. Details of registration of the unit :</td>		
			</tr>
			<tr>
				<td colspan="2"> (a)Micro & Small Scale :</td>
			</tr>
				<tr>
			<td>i) Provisional Registration no and date/EM part-I acknowledgement No and date :</td>
			<td>Provisional Registration no : '.strtoupper($provisional_reg_no).'<br/>
		        Provisional Registration date : '.strtoupper($provisional_reg_date).'
			</td>
		</tr>
		<tr>
			<td>ii) Permanent Registration no and date/EM part-II acknowledgement No and date  :</td>
			<td>Permanent Registration No.: '.strtoupper($permanent_reg_no).'<br/>
		        Permanent Registration date : '.strtoupper($permanent_reg_date).'
			</td>
		</tr>
		<tr>
			<td colspan="2">(b) Medium and Large  </td>			
		</tr>
			<tr>
			<td> (i) No and date of Industrial License/Letter of Intent/Industrial Entrepreneurs Memorandum (IEM) / Entrepreneurs Memorandum (EM) prior to and after commencement of commercial production/service with uptodate amendments. </td>
			<td>No.: '.strtoupper($indus_license_no).'<br/>
		        Date  : '.strtoupper($indus_license_date).'
			</td>
		</tr>
		<tr>
			<td> 4. (a) Letter no and date etc acknowledging intimation given/ according approval by concerned implementing agency for substantial expansion</td>
			<td>Letter No : '.strtoupper($intimation_letter_no).'<br/>
		        Date : '.strtoupper($intimation_date).'
			</td>
		</tr>
		<tr>
			<td> b) A note in brief on substantial expansion undertaken with special reference to its product/ service, process, existing capacity etc.</td>
			<td>'.strtoupper($note_substantial).'</td>
		</tr>
		<tr>
			<td valign="top"> c) Name and address of the consultant who prepared the Project Feasibility Report:</td>
			<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Name </td>
						<td>'.strtoupper($consultant_name).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($consultant_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($consultant_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($consultant_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($consultant_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($consultant_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($consultant_mobile).'</td>
				</tr>				
				<tr>
						<td>Email-id</td>
						<td> '.$consultant_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
			<tr>
			<td>(d) EC No and date obtained earlier, if any</td>
			<td>Letter No : '.strtoupper($ec_no).'<br/>
		        Date : '.strtoupper($ec_date).'
			</td>
		</tr>
		<tr>
			<td colspan="2"> 5. Details of land including additional investment etc made  </td>
		</tr>
		<tr>
			<td>a) Whether the land is owned/ leased hold from private party/ slotted by the Government/ Government agency</td>
			<td>'.strtoupper($land_owned).'</td>
		</tr>
		<tr>
			<td>b) (i) Total Area (sq mtr)  </td>
			<td>'.strtoupper($total_area).'</td>
		</tr>
		<tr>
			<td>(ii) Area under use for the project  </td>
			<td>'.strtoupper($area_under_use).'</td>
		</tr>
		<tr>
			<td>c) Location  </td>
			<td>'.strtoupper($area_loc).'</td>
		</tr>
		<tr>
			<td valign="top">d) Dag no, Patta no, Revenue village and Mauza  </td>
			<td>Dag no : '.strtoupper($land_detail_dag_no).'<br/>
				Patta no : '.strtoupper($land_detail_patta_no).'<br/>
				Revenue village : '.strtoupper($land_detail_revenue_vill).'<br/>
				Mauza : '.strtoupper($land_detail_mauza).'<br/>
			</td>
		</tr>
		<tr>
			<td valign="top">e) Name & address of the present owner of land/ Lessor/ Govt agency allotting land </td>
			<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Name</td>
						<td>'.strtoupper($land_owner_name).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($land_owner_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($land_owner_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($land_owner_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($land_owner_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($land_owner_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($land_owner_mobile).'</td>
				</tr>				
				<tr>
						<td>Email-id</td>
						<td> '.$land_owner_email.'</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">f) No and date of registration of the purchase deed/ lease deed and name, designation & address of the registering authority </td>
		</tr>
		<tr>
			<td>No</td>
			<td> '.strtoupper($no_pur_deed).'</td>
		</tr>
		<tr>
			<td> Date </td>
			<td>'.strtoupper($dor_pur_deed).'</td>
		</tr>
		<tr>
			<td>  Name</td>
			<td>  '.strtoupper($auth_name).'	</td>
		</tr>
		<tr>
			<td> Designation</td>
			<td>'.strtoupper($auth_desig).'</td>
		</tr>
		<tr>
			<td valign="top">Address of the registering authority </td>
			<td>
			<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($auth_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($auth_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($auth_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($auth_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($auth_pincode).'</td>
				</tr>			
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($auth_mobile).'</td>
				</tr>				
				<tr>
						<td>Email-id</td>
						<td> '.$auth_email.'</td>
				</tr>
				</table>
		   </td>
		</tr>
			<tr>
				<td valign="top">g) Purchase price, registration fee and stamp duty/annual lease rent payable/one time premium paid  </td>
				<td>Purchase price : '.strtoupper($pur_price).'<br/>
					Registration fee  : '.strtoupper($pur_reg_fee).'<br/>
					Stamp duty/annual lease rent payable/one time premium paid  : '.strtoupper($stamp_duty).'
				</td>
		</tr>
		<tr>
				<td>h) The date of taking over possession of land </td>
				<td> '.strtoupper($date_possesion).'</td>
		</tr>
		<tr>
				<td valign="top">i) Duration of lease   </td>
				<td> From :  '.strtoupper($lease_from).'<br/>
					 To : '.strtoupper($lease_to).'<tr>
		</tr>
		<tr>
				<td colspan="2">6. Details of building</td>
		</tr>
		<tr>
				<td colspan="2">a) If the building has been constructed</td>
		</tr>
		<tr>
				<td>(i) Date of starting of the civil construction </td>
				<td>'.strtoupper($building_construction_strt_dt).'</td>
		</tr>
		<tr>
				<td>(ii) Date of completion of the civil construction works </td>
				<td> '.strtoupper($building_construction_com_dt).'</td>
		</tr>
		<tr>
				<td>(iii) Total area under construction </td>
				<td> '.strtoupper($building_construction_total_area).'</td>
		</tr>
		<tr>
				<td>(iv) Total cost of construction, site development etc </td>
				<td> '.strtoupper($building_construction_total_cost).'</td>
		</tr>
		<tr>
				<td>(v) Cost of construction and area of the building connected directly to manufacturing process/service rendered </td>
				<td> Cost of construction: '.strtoupper($building_construction_direct_cost).'<br/>
					Area of the building: '.strtoupper($building_construction_direct_area).'</td>
		</tr>
		<tr>
			<td colspan="2">b) If the building has been allotted by the Government agency/taken on rent from private party:</td>
		</tr>
		<tr>
			<td valign="top">(i) Name & address of the Govt agency / land lord</td>
			<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
				<tr>
					<td width="50%">Name</td>
					<td>'.strtoupper($govt_agency_name).'</td>
				</tr>
				<tr>
					<td width="50%">Street Name 1</td>
					<td>'.strtoupper($govt_agency_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($govt_agency_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($govt_agency_town).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($govt_agency_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($govt_agency_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($govt_agency_mobile).'</td>
				</tr>
				<tr>
						<td>Email-id</td>
						<td> '.$govt_agency_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(ii) Total covered area</td>
			<td>'.strtoupper($tot_cov_area).'</td>
		</tr>
		<tr>
				<td>(iii) Annual rent</td>
				<td>'.strtoupper($ann_rent).'</td>
		</tr>
		<tr>
			<td>(iv) No & date of registration of the rent agreement/lease deed and address of the registering authority</td>
			<td>Registration Number :  '.strtoupper($build_reg_no).'<br/>
		        Registration Date  : '.strtoupper($build_reg_dt).'
			</td>
		</tr>
		<tr>
			<td>(v) Location :</td>
			<td>'.strtoupper($build_loc).'	</td>
		</tr>
		<tr>
			<td valign="top">(vi) Period of validity of rent agreement/lease deed</td>
			<td>From :  '.strtoupper($val_period_rent_from).'<br/>
		        To  : '.strtoupper($val_period_rent_to).'
			</td>
		</tr>
		<tr>
			<td colspan="2">7. Details of Capital Investment (gross value in Rupees) :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="5%">Sl No.</th>
							<th width="25%">Item of Fixed Assets </th>
							<th width="20%">Prior to undertaking substantial expansion</th>
							<th width="25%">Additional investment made for substantial expansion </th>
							<th width="25%">Total investment after completion of substantial expansion </th>
						</tr>
					</thead>
					</thead>
					<tbody>
						<tr>
							<td>a.</td>
							<td>Land </td>
							<td>'.strtoupper($land_prior).'</td>
							<td>'.strtoupper($land_additional).'</td>
							<td>'.strtoupper($land_total).'</td>
						</tr>
						<tr>
							<td>b.</td>
							<td>Site development </td>
							<td>'.strtoupper($site_prior).'</td>
							<td>'.strtoupper($site_additional).'</td>
							<td>'.strtoupper($site_total).'</td>
						</tr>
						<tr>
							<td>c.</td>
							<td colspan="4" >Building </td>
						</tr>
						<tr>
							<td rowspan="2"></td>
							<td>i)  Factory/Institutional building and other civil construction works directly connected to process of manufacture/service rendered </td>
							<td>'.strtoupper($fact_direct_prior).'</td>
							<td>'.strtoupper($fact_direct_additional).'</td>
							<td>'.strtoupper($fact_direct_total).'</td>
						</tr>
						<tr>
							<td>ii) Office building, labour quarter etc no directly connected to process of manufacture/ service rendered (ineligible building) </td>
							<td>'.strtoupper($office_direct_prior).'</td>
							<td>'.strtoupper($office_direct_additional).'</td>
							<td>'.strtoupper($office_direct_total).'</td>
						</tr>
						<tr>
							<td >d.</td>
							<td>Plant and Machinery </td>
							<td>'.strtoupper($plant_prior).'</td>
							<td>'.strtoupper($plant_additional).'</td>
							<td>'.strtoupper($plant_total).'</td>
						</tr>
						<tr>
							<td >e.</td>
							<td>Equipment, accessories, components & fittings etc </td>
							<td>'.strtoupper($equip_prior).'</td>
							<td>'.strtoupper($equip_additional).'</td>
							<td>'.strtoupper($equip_total).'</td>
						</tr>
						<tr>
							<td >f.</td>
							<td>Drawal of Power line </td>
							<td>'.strtoupper($power_prior).'</td>
							<td>'.strtoupper($power_additional).'</td>
							<td>'.strtoupper($power_total).'</td>
						</tr>
						<tr>
							<td >g.</td>
							<td>Electrical Installation other than drawal of power line</td>
							<td>'.strtoupper($electrical_prior).'</td>
							<td>'.strtoupper($electrical_additional).'</td>
							<td>'.strtoupper($electrical_total).'</td>
						</tr>
						<tr>
							<td >h.</td>
							<td>Utility installation other than electrical power</td>
							<td>'.strtoupper($utility_prior).'</td>
							<td>'.strtoupper($utility_additional).'</td>
							<td>'.strtoupper($utility_total).'</td>
						</tr>
						<tr>
							<td >i.</td>
							<td>Miscellaneous fixed assets ( in details) </td>
							<td>'.strtoupper($misc_prior).'</td>
							<td>'.strtoupper($misc_additional).'</td>
							<td>'.strtoupper($misc_total).'</td>
						</tr>
						<tr>
							<td >j.</td>
							<td>Preliminary and preoperative expenses capitalised </td>
							<td>'.strtoupper($prelim_prior).'</td>
							<td>'.strtoupper($prelim_additional).'</td>
							<td>'.strtoupper($prelim_total).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>B. Total of the coloumn 4 as percentage of the total column 3 </td>
			<td>'.strtoupper($total_f_coloumn).'</td>
		</tr>
		<tr>
			<td>C. Total fixed capital investment (gross value) as per last EC </td>
			<td>'.strtoupper($total_fixed_capital).'</td>
		</tr>
		<tr>
			<td colspan="2">8. Source of Finance</td>
		</tr>
		<tr>
			<td>a. Promoters contribution</td>
			<td>'.strtoupper($sources_f_finance_a).'</td>
		</tr>
		<tr>
			<td>b. Govt contribution as seed money/share capital etc</td>
			<td>'.strtoupper($sources_f_finance_b).'</td>
		</tr>
		<tr>
			<td>c. Borrowing from Bank/Financial Institution </td>
			<td>'.strtoupper($sources_f_finance_c).'</td>
		</tr>
		<tr>
			<td>d. Un secured loan/private finance </td>
			<td>'.strtoupper($sources_f_finance_d).'</td>
		</tr>
		<tr>
			<td>e. Any other sources </td>
			<td>'.strtoupper($sources_f_finance_e).'</td>
		</tr>
		<tr>
			<td>Total </td>
			<td>'.strtoupper($total_contribution).'</td>
		</tr>
		<tr>
			<td colspan="2">9. Details of financial assistance received from Bank/ Financial Institution/ Govt organization etc.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse"> 
					<thead>
					<tr>
						<th width="5%">Sl no.</th>
						<th width="25%">Particulars</th>
						<th width="20">Prior to undertaking substantial expansion </th>
						<th width="25%">Additional for substantial expansion</th>
						<th width="25%">Total after completion of substantial expansion</th>
					</tr>
					</thead>
					<tr>
						<td>a.</td>
						<td>Name(s) of Financial Institution(s)</td>
						<td>'.strtoupper($financial_ins_prior).'</td>
						<td>'.strtoupper($financial_ins_additional).'</td>
						<td>'.strtoupper($financial_ins_tot).'</td>
					</tr>
					<tr>
						<td rowspan="3" valign="top">b.</td>
						<td colspan="4">Amount sanctioned as</td>
					</tr>
					<tr>
						<td>(i)   Term Loan ( in rupees) </td>
						<td>'.strtoupper($term_prior).'</td>
						<td>'.strtoupper($term_additional).'</td>
						<td>'.strtoupper($term_tot).'</td>
					</tr>
					<tr>
						<td>(ii)  WC/OD/CC/OCC/Margin money contribution etc (in rupees)</td>
						<td>'.strtoupper($wc_prior).'</td>
						<td>'.strtoupper($wc_additional).'</td>
						<td>'.strtoupper($wc_tot).'</td>
					</tr>
					<tr>
						<td rowspan="3" valign="top">c.</td>
						<td>(i)  Term Loan disbursed till date of application</td>
						<td>'.strtoupper($tl_prior).'</td>
						<td>'.strtoupper($tl_additional).'</td>
						<td>'.strtoupper($tl_tot).'</td>
					</tr>
					<tr>
						<td>(ii)  Rate of Interest on TL </td>
						<td>'.strtoupper($roi_tl_prior).'</td>
						<td>'.strtoupper($roi_tl_additional).'</td>
						<td>'.strtoupper($roi_tl_tot).'</td>
					</tr>
					<tr>
						<td>(iii) Schedule of Repayment of TL ( showing principal amount, Interest etc separately )</td>
						<td>'.strtoupper($repayment_prior).'</td>
						<td>'.strtoupper($repayment_additional).'</td>
						<td>'.strtoupper($repayment_tot).'</td>
					</tr>
					<tr>
						<td rowspan="5" valign="top">d.</td>
						<td colspan="4">Letter no & date of sanction of loan as</td>
					</tr>
					<tr>
						<td valign="top" rowspan="2">(i)  Term Loan </td>
						<td>'.strtoupper($tl_amt_prior).'</td>
						<td>'.strtoupper($tl_amt_additional).'</td>
						<td>'.strtoupper($tl_amt_tot).'</td>
					</tr>
					<tr>
						<td>'.strtoupper($tl_date_prior).'</td>
						<td>'.strtoupper($tl_date_additional).'</td>
						<td>'.strtoupper($tl_date_tot).'</td>
					</tr>
					<tr>
						<td valign="top" rowspan="2">(ii) Working Capital etc :</td>
						<td>'.strtoupper($wor_cap_prior).'</td>
						<td>'.strtoupper($wor_cap_additional).'</td>
						<td>'.strtoupper($wor_cap_tot).'</td>
					</tr>
					<tr>
						<td>'.strtoupper($wor_dat_prior).'</td>
						<td>'.strtoupper($wor_dat_additional).'</td>
						<td>'.strtoupper($wor_dat_tot).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">10. Details of Power connection </td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th> Sl no.</th>
							<th>Particulars</th>
							<th>Prior to undertaking substantial expansion </th>
							<th>Additional for substantial expansion</th>
							<th>Total after completion of substantial expansion</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td valign="top" rowspan="3">a</td>
							<td valign="top" rowspan="3"> Quantum, letter no and date of sanction </td>
							<td>'.strtoupper($quant_prior).'</td>
							<td>'.strtoupper($quant_additional).'</td>
							<td>'.strtoupper($quant_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($quant_let_prior).'</td>
							<td>'.strtoupper($quant_let_additional).'</td>
							<td>'.strtoupper($quant_let_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($quant_dat_prior).'</td>
							<td>'.strtoupper($quant_dat_additional).'</td>
							<td>'.strtoupper($quant_dat_tot).'</td>
						</tr>
						<tr>
							<td rowspan="2" valign="top">b.</td>
							<td rowspan="2" valign="top"> Connected electrical load and date of connection of power </td>
							<td>'.strtoupper($elec_prior).'</td>
							<td>'.strtoupper($elec_additional).'</td>
							<td>'.strtoupper($elec_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($elec_dat_prior).'</td>
							<td>'.strtoupper($elec_dat_additional).'</td>
							<td>'.strtoupper($elec_dat_tot).'</td>
						</tr>
						<tr>
							<td >c.</td>
							<td>Serial no of energy meter(s) connected</td>
							<td>'.strtoupper($ser_en_prior).'</td>
							<td>'.strtoupper($ser_en_additional).'</td>
							<td>'.strtoupper($ser_en_tot).'</td>
						</tr>
						<tr>
							<td rowspan="3" valign="top">d.</td>
							<td rowspan="3" valign="top">Estimated amount of ASEB for power connection with MR no and date of payment</td>
							<td>'.strtoupper($est_amt_prior).'</td>
							<td>'.strtoupper($est_amt_additional).'</td>
							<td>'.strtoupper($est_amt_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($est_mr_prior).'</td>
							<td>'.strtoupper($est_mr_additional).'</td>
							<td>'.strtoupper($est_mr_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($est_dat_prior).'</td>
							<td>'.strtoupper($est_dat_additional).'</td>
							<td>'.strtoupper($est_dat_tot).'</td>
						</tr>
						<tr>
							<td valign="top" rowspan="5">e</td>
							<td colspan="4">First ASEB Bill </td>
						</tr>
						<tr>
							<td valign="top" rowspan="2">(i)  Bill no and date after substantial expansion</td>
							<td>'.strtoupper($sub_expan_prior).'</td>
							<td>'.strtoupper($sub_expan_additional).'</td>
							<td>'.strtoupper($sub_expan_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($sub_dat_prior).'</td>
							<td>'.strtoupper($sub_dat_additional).'</td>
							<td>'.strtoupper($sub_dat_tot).'</td>
						</tr>
						<tr>
							<td valign="top" rowspan="2">(ii)  MR no and date of payment after substantial expansion</td>
							<td>'.strtoupper($mr_subexpan_prior).'</td>
							<td>'.strtoupper($mr_subexpan_additional).'</td>
							<td>'.strtoupper($mr_subexpan_tot).'</td>
						</tr>
						<tr>
							<td>'.strtoupper($mr_subexpan_dat_prior).'</td>
							<td>'.strtoupper($mr_subexpan_dat_additional).'</td>
							<td>'.strtoupper($mr_subexpan_dat_tot).'</td>
						</tr>
						<tr>
							<td >f.</td>
							<td>Total expenditure incurred for obtaining additional power connection ( excluding load security deposited to ASEB)</td>
							<td>'.strtoupper($total_expenditure_prior).'</td>
							<td>'.strtoupper($total_expenditure_additional).'</td>
							<td>'.strtoupper($total_expenditure_tot).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">11. Date of commencement of commercial production / service rendered</td>
		</tr>
		<tr>
			<td>(a) Prior to undertake substantial expansion</td>
			<td >'.strtoupper($bef_sub_expan).'</td>
		</tr>
		<tr>
			<td>(b) After completion of substantial expansion</td>
			<td >'.strtoupper($after_sub_expan).'</td>
		</tr>
		<tr>
			<td colspan="2">12.(a) Details of the production/service rendered</td>
		</tr>
		<tr>
			<td colspan="2">(i) Prior to substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					';
					$part1=$dic->query("SELECT * FROM dic_form6_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["items"]).'</td>
						<td>'.strtoupper($row_1["annual_quantity"]).'</td>
						<td>'.strtoupper($row_1["annual_rupees"]).'</td>
						<td>'.strtoupper($row_1["actual_quantity"]).'</td>
						<td>'.strtoupper($row_1["actual_rupees"]).'</td>
						<td>'.strtoupper($row_1["percentage"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>	
			<td colspan="2">(ii)After substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					';
					$part2=$dic->query("SELECT * FROM dic_form6_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["items"]).'</td>
						<td>'.strtoupper($row_2["annual_quantity"]).'</td>
						<td>'.strtoupper($row_2["annual_rupees"]).'</td>
						<td>'.strtoupper($row_2["actual_quantity"]).'</td>
						<td>'.strtoupper($row_2["actual_rupees"]).'</td>
						<td>'.strtoupper($row_2["percentage"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">(b) Actual average production/service rendered during last three years preceding the date of completion of substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
					<tr>
						<th width="5%">Sl no.</th>
						<th width="20%">Items</th>
						<th width="25%">Physical quantity of finished product/service</th>
						<th width="30%">Cost in rupees per unit of the finished product/service</th>
						<th width="20%">Total value in rupees of the finished product/service as per cost</th>
					</tr>
					</thead>
					';
					$part3=$dic->query("SELECT * FROM dic_form6_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_3["slno"]).'</td>
						<td>'.strtoupper($row_3["items"]).'</td>
						<td>'.strtoupper($row_3["physical_qty"]).'</td>
						<td>'.strtoupper($row_3["cost_per_unit"]).'</td>
						<td>'.strtoupper($row_3["total_value"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">(c) Actual production/service rendered since date of completion of substantial expansion till date of submission of application</td>
		</tr>
		<tr>
			<td colspan="2"> 
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
					<tr>
						<th width="5%">Sl no.</th>
						<th width="15%">Items</th>
						<th width="30%">Physical quantity of finished product/service</th>
						<th width="30%">Cost in rupees per unit of the finished product/service</th>
						<th width="20%">Total value in rupees of the finished product/service as per cost</th>
					</tr>
					</thead>
					';
					$part4=$dic->query("SELECT * FROM dic_form6_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_4["slno"]).'</td>
						<td>'.strtoupper($row_4["items"]).'</td>
						<td>'.strtoupper($row_4["physical_qty"]).'</td>
						<td>'.strtoupper($row_4["cost_per_unit"]).'</td>
						<td>'.strtoupper($row_4["total_value"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>d) Total production/service rendered expressed in percentage viz: (total of Col 20)- (total of Col 16) divided by (total of col 20) and multiplied by 100. </td>
			<td>'.strtoupper($total_12d_prod).'</td>
		</tr>
		<tr>
			<td colspan="2">13. Raw Materials/ Consumables</td>
		</tr>
		<tr>
			<td colspan="2">a) Utilisation of Materials</td>
		</tr>
		<tr>
			<td colspan="2">i) Prior to substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					</thead>';
					$part5=$dic->query("SELECT * FROM dic_form6_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_5["slno"]).'</td>
						<td>'.strtoupper($row_5["items"]).'</td>
						<td>'.strtoupper($row_5["actual_quantity"]).'</td>
						<td>'.strtoupper($row_5["actual_rupees"]).'</td>
						<td>'.strtoupper($row_5["utilise_quantity"]).'</td>
						<td>'.strtoupper($row_5["utilise_rupees"]).'</td>
						<td>'.strtoupper($row_5["remark"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">(ii) After substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
					<tr>
						<th rowspan="2" width="5%">Sl no.</th>
						<th rowspan="2" width="15%">Items</th>
						<th colspan="2" width="30%">Actual Requirements</th>
						<th colspan="2" width="30%">Utilisation since date of completion of substantial expansion till date of submission of application</th>
						<th rowspan="2" width="20%">Remarks</th>
					</tr>
					<tr>
						<th>Quantity</th>
						<th>Value (in Rupees)</th>
						<th>Quantity</th>
						<th>Value (in Rupees)</th>
					</tr>
					</thead>';
					$part6=$dic->query("SELECT * FROM dic_form6_t6 WHERE form_id='$form_id'");
					while($row_6=$part6->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_6["slno"]).'</td>
						<td>'.strtoupper($row_6["items"]).'</td>
						<td>'.strtoupper($row_6["actual_quantity"]).'</td>
						<td>'.strtoupper($row_6["actual_rupees"]).'</td>
						<td>'.strtoupper($row_6["utilise_quantity"]).'</td>
						<td>'.strtoupper($row_6["utilise_rupees"]).'</td>
						<td>'.strtoupper($row_6["remark"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"> (b) Source(s) of materials</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					<tr>';
					$part7=$dic->query("SELECT * FROM dic_form6_t7 WHERE form_id='$form_id'");
					while($row_7=$part7->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_7["slno"]).'</td>
						<td>'.strtoupper($row_7["items"]).'</td>
						<td>'.strtoupper($row_7["source"]).'</td>
						<td>'.strtoupper($row_7["name"]).'</td>
						<td>'.strtoupper($row_7["hno"]).'</td>
						<td>'.strtoupper($row_7["vill"]).'</td>
						<td>'.strtoupper($row_7["dist"]).'</td>
						<td>'.strtoupper($row_7["pin"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">14. Details of Sale of finished product(s)/ Service(s) rendered</td>
		</tr>
		<tr>
			<td colspan="2">a)Prior to Substantial Expansion</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					</thead>';
					$part8=$dic->query("SELECT * FROM dic_form6_t8 WHERE form_id='$form_id'");
					while($row_8=$part8->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_8["slno"]).'</td>
						<td>'.strtoupper($row_8["items"]).'</td>
						<td>'.strtoupper($row_8["within_assam_quantity"]).'</td>
						<td>'.strtoupper($row_8["within_assam_value"]).'</td>
						<td>'.strtoupper($row_8["outside_assam_quantity"]).'</td>
						<td>'.strtoupper($row_8["outside_assam_value"]).'</td>
						<td>'.strtoupper($row_8["remark"]).'</td>
					</tr>';
					}$printContents=$printContents.'
					</thead>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">b) Prior to Substantial Expansion</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
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
					</thead>';
					$part9=$dic->query("SELECT * FROM dic_form6_t9 WHERE form_id='$form_id'");
					while($row_9=$part9->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_9["slno"]).'</td>
						<td>'.strtoupper($row_9["items"]).'</td>
						<td>'.strtoupper($row_9["within_assam_quantity"]).'</td>
						<td>'.strtoupper($row_9["within_assam_value"]).'</td>
						<td>'.strtoupper($row_9["outside_assam_quantity"]).'</td>
						<td>'.strtoupper($row_9["outside_assam_value"]).'</td>
						<td>'.strtoupper($row_9["remark"]).'</td>
					</tr>';
					}$printContents=$printContents.'
					</thead>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">15. Employment Generation</td>
		</tr>
		<tr>
			<td colspan="2">(a) Regular Employment</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
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
						<td>'.strtoupper($managerial_assam_prior).'</td>
						<td>'.strtoupper($managerial_nonassam_prior).'</td>
						<td>'.strtoupper($managerial_assam_after).'</td>
						<td>'.strtoupper($managerial_nonassam_after).'</td>
						<td>'.strtoupper($managerial_total).'</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Supervisory </td>
						<td>'.strtoupper($super_assam_prior).'</td>
						<td>'.strtoupper($super_nonassam_prior).'</td>
						<td>'.strtoupper($super_assam_after).'</td>
						<td>'.strtoupper($super_nonassam_after).'</td>
						<td>'.strtoupper($super_total).'</td>
					</tr>
					<tr>
						<td>3  </td>
						<td>Skilled    </td>
						<td>'.strtoupper($skilled_assam_prior).'</td>
						<td>'.strtoupper($skilled_nonassam_prior).'</td>
						<td>'.strtoupper($skilled_assam_after).'</td>
						<td>'.strtoupper($skilled_nonassam_after).'</td>
						<td>'.strtoupper($skilled_total).'</td>
					</tr>
					<tr>
						<td> 4</td>
						<td>Semi-Skilled </td>
						<td>'.strtoupper($semiskilled_assam_prior).'</td>
						<td>'.strtoupper($semiskilled_nonassam_prior).'</td>
						<td>'.strtoupper($semiskilled_assam_after).'</td>
						<td>'.strtoupper($semiskilled_nonassam_after).'</td>
						<td>'.strtoupper($semiskilled_total).'</td>
					
					</tr>
					<tr>
						<td>5  </td>
						<td>Unskilled & others    </td>
						<td>'.strtoupper($unskilled_assam_prior).'</td>
						<td>'.strtoupper($unskilled_nonassam_prior).'</td>
						<td>'.strtoupper($unskilled_assam_after).'</td>
						<td>'.strtoupper($unskilled_nonassam_after).'</td>
						<td>'.strtoupper($unskilled_total).'</td>
					</tr>
					<tr>
						<td colspan="2">Total </td>
						<td>'.strtoupper($total_assam_prior).'</td>
						<td>'.strtoupper($total_nonassam_prior).'</td>
						<td>'.strtoupper($total_assam_after).'</td>
						<td>'.strtoupper($total_nonassam_after).'</td>
						<td>'.strtoupper($total_total).'</td>
					</tr>
				</table>
				</td>
			</tr>								
			<tr>
				<td colspan="2">(b)Casual employment</td>
			</tr>
			<tr>
				<td>i) Average mandays utilized per month :</td>
				<td>'.strtoupper($mandays_utilized).'</td>
			</tr>
			<tr>
				<td colspan="2">16.Incentives applied for  :</td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
				<thead>
				<tr>
					<th width="5%">Sl no.</th>
					<th width="45%">Name of the incentive(s)</th>
					<th width="50%">Remarks</th>
				</tr>
				</thead>';
				$part10=$dic->query("SELECT * FROM dic_form6_t10 WHERE form_id='$form_id'");
				while($row_10=$part10->fetch_array()){
				$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_10["slno"]).'</td>
					<td>'.strtoupper($row_10["name"]).'</td>
					<td>'.strtoupper($row_10["remark"]).'</td>
				</tr>';
				}$printContents=$printContents.'
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">Checklists of documents--<br/>*NA - Not Applicable<br/>*SC - Send By Courier</td>
			</tr>
			<tr>
				<td>1. Documents on Constitution of the promoter organization, e.g<br/>(a) Registered partnership deed, memorandum & article of association etc.<br/>(b) Registration certificate under the concerned Act<br/>(c) List of Directors /Partners/members of the executive body etc as on the date of application<br/>(d) General/special power of attorney, declaration regarding authorized signatory etc.<br/>(e) Resolution of the partner/boards of Directors/Executive body etc for expansion of the unit.</td>
				<td>'.$val1.'</td>
			</tr>
			<tr>
				<td>2. Registration Certificate(s) of the unit under Industries & Commerce Department of Government of Assam/Government of India (EM/IEM etc) with upto date amendments recording additional investment, additional item of production/service, date of commencement of production/service after substantial expansion.</td>
				<td>'.$val2.'</td>
			</tr>
			<tr>
				<td>3. Documents on land & building, including landed property acquired e.g.<br/>(a) Allotment letter issued by Govt/Govt agency for land or shed<br/>(b) Trace Map of land allotted/leased/owned<br/>(c) Premium payment receipt for allotted land<br/>(d) Registered land lease deed with general/special power of attorney<br/>(e) Up-to-date land lease rent payment receipt/factory rent payment receipt<br/>(f) Land purchase deed, up-to-date no encumbrance certificate<br/>(g) Jamabandi/land patta etc<br/>(h) Registered rent agreement</td>
				<td>'.$val3.'</td>
			</tr>
			<tr>
				<td>4. Plan/design, estimate and engineers&apos; certificate as per <b>Proforma E</b> for all types of additional civil construction works including machine foundation, electrical installation, mechanical fabrication works of the plant etc.</td>
				<td>'.$val4.'</td>
			</tr>
			<tr>
				<td>5. Sanction letter(s) from the Financial Institution/Bank/Government organization for Term Loan & Working Capital loan/CC/OCC/OD/margin Money contribution etc with repayment schedule of Term Loan showing Principal, interest etc separately after substantial expansion.</td>
				<td>'.$val5.'</td>
			</tr>
			<tr>
				<td>6. Document on power<br/>(a) Power sanction letter(s)<br/>(b) Estimate prepared by ASEB for additional power connection.<br/>(c) Test report on electrical installation, energy meter, CTPT etc approved by authority concerned pertaining to additional power connection.<br/>(d) Installation report of power generating set from Chief Electrical Inspector cum Adviser, Assam, wherever applicable, pertaining to expansion programme.<br/>(e) First Power Bill and MR of ASEB after substantial expansion.<br/>(f) Last power bill and MR of ASEB prior to substantial expansion.</td>
				<td>'.$val6.'</td>
			</tr>
			<tr>
				<td>7. List of<br/>(a) Plant & Machinery/ equipment prior to and after substantial expansion as per prescribed <b>Proforma- B & B.1</b> with all bills/challan/vouchers/money receipt etc for substantial expansion claim.<br/>(b) Other components of fixed capital investment e.g miscellaneous fixed assets ( i.e office equipment, vehicle, furniture etc) , accessories, electrical installation ( including transformer, DG set, Stabilizer, CTPT, energy meter etc)/ utility installations other than electrical power etc prior to and after substantial expansion  as per prescribed <b>Proforma- B & B.1</b> with all bills/challan/vouchers/ money receipt etc for substantial expansion claim.<br/>(c) Details of preliminary & preoperative expenses capitalized in respect of expansion project.</td>
				<td>'.$val7.'</td>
			</tr>
			<tr>
				<td>8. Certificate from a Registered Chartered Accountant for fixed capital investment & sources of finance as per prescribed <b>Proforma-C</b>.</td>
				<td>'.$val8.'</td>
			</tr>
			<tr>
				<td>9. (a) List of employees after substantial expansion as per prescribed <b>Proforma-D & D.1</b> ( based on daily attendance register of the unit on the date of application.)<br/>(b) Local Eemployme > Proforma Ecate from the District Employment Officer/Director of Employment & Craftsmen Training, Assam prior to and after substantial expansion.</td>
				<td>'.$val9.'</td>
			</tr>
			<tr>
				<td>10. Project Feasibility Report/Scheme projecting substantial expansion.</td>
				<td>'.$val10.'</td>
			</tr>
			<tr>
				<td>11. First bill, money receipt on purchase of raw material(s) after substantial expansion.</td>
				<td>'.$val11.'</td>
			</tr>
			<tr>
				<td>12. Challan against the first sale of finish product(s) after substantial expansion.</td>
				<td>'.$val12.'</td>
			</tr>
			<tr>
				<td>13. Details sources of own finance for expansion undertaken e.g promoter&apos;s contribution, equity, unsecured loan etc with supporting documents like account confirmation letter, PAN of landers/promoters, amount, cheque no & date, drawee bank etc.</td>
				<td>'.$val13.'</td>
			</tr>
			<tr>
				<td>14. Agreement with the organization providing technical Know-how and quality certification, if any/ MOU for franchise for substantial expansion.</td>
				<td>'.$val14.'</td>
			</tr>
			<tr>
				<td>15. No objection certificate, trade License from the local body/authorities.</td>
				<td>'.$val15.'</td>
			</tr>
			<tr>
				<td>16. NOC, Consent of operation from the Pollution Control Authority.</td>
				<td>'.$val16.'</td>
			</tr>
			<tr>
				<td>17. Complete balance sheet  for last three (3) accounting years preceding the year of completion of substantial expansion, for the years of expansion and subsequent year(s) if any.</td>
				<td>'.$val17.'</td>
			</tr>
			<tr>
				<td>18. Copy of registration certificate under AGST Act/AVAT Act & CST Act.</td>
				<td>'.$val18.'</td>
			</tr>
			<tr>
				<td>19. Latest IT clearance/ return, saral of the unit duly acknowledged by the authority concerned, PAN of the unit and promoter(s).</td>
				<td>'.$val19.'</td>
			</tr>
			<tr>
				<td>20. Factory License</td>
				<td>'.$val20.'</td>
			</tr>
			<tr>
				<td>21. Eligibility certificate issued, if any, before substantial expansion.</td>
				<td>'.$val21.'</td>
			</tr>
			<tr>
				<td>22. Other registration /permission/License/NOC etc required for establishing and running of the unit, e.g Central Excise registration, Forest License, Tea Board&apos;s registration, Labour License, Service Tax registration etc.</td>
				<td>'.$val22.'</td>
			</tr>
			<tr>
				<td>23. Any other documents sought for by the authority concerned.</td>
				<td>'.$val23.'</td>
			</tr>			
			';
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1 ){
			$printContents=$printContents.'
			<tr>		            
			<td colspan="2">
				<table border="0" width="100%" class="table table-bordered table-responsive" style="border-collapse: collapse">
					<tr><td height="45px" colspan="2">Courier Details.</td></tr>
					<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
					<tr><td>Ref. No./ Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
					<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
				</table>
			</td>
			</tr>
			';				
			}		
			$printContents=$printContents.'
			<tr>
				<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="right">Signature : '.strtoupper($key_person).'<br/>Status in relation to the unit : '.strtoupper($status_applicant).'</td>
			</tr>
	</table>
	';
?>