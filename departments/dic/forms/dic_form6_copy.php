<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','6');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=6&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=6&dept=dic';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$pan_no=$row1['pan_no'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
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
	$sn1="";$sn2="";$vill="";$dist="";$pin="";$pan="";
	
	$q=$dic->query("select * from dic_form6 where user_id='$swr_id' and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		
		####Tab1###
		$office_mob="";$office_email="";
		$act_reg_date="";$act_reg_no="";$act_reg_office="";
		$provisional_reg_no="";$provisional_reg_date="";
		$permanent_reg_no="";$permanent_reg_date="";
		$indus_license_no="";$indus_license_date="";
		
		#####Tab2#####
		$intimation_letter_no="";$intimation_dt="";
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
		$souces_f_finance_a="";$souces_f_finance_b="";$souces_f_finance_c="";$souces_f_finance_d="";$souces_f_finance_e="";$total_contribution="";
		
		$financial_ins_prior="";$financial_ins_additional="";$financial_ins_tot="";$term_prior="";$term_additional="";$term_tot="";$wc_prior="";$wc_additional="";$wc_tot="";$tl_prior="";$tl_additional="";$tl_tot="";$roi_tl_prior="";$roi_tl_additional="";$roi_tl_tot="";$repayment_prior="";$repayment_additional="";$repayment_tot="";$tl_amt_prior="";$tl_amt_additional="";$tl_amt_tot="";$tl_date_prior="";$tl_date_additional="";$tl_date_tot="";$wor_cap_prior="";$wor_cap_additional="";$wor_cap_tot="";$wor_dat_prior="";$wor_dat_additional="";$wor_dat_tot="";
		$quant_prior="";$quant_additional="";$quant_tot="";$quant_let_prior="";$quant_let_additional="";$quant_let_tot="";$quant_dat_prior="";$quant_dat_additional="";$quant_dat_tot="";$elec_prior="";$elec_additional="";$elec_tot="";$elec_dat_prior="";$elec_dat_additional="";$elec_dat_tot="";$ser_en_prior="";$ser_en_additional="";$ser_en_tot="";
		$est_amt_prior="";$est_amt_additional="";$est_amt_tot="";$est_mr_prior="";$est_mr_additional="";$est_mr_tot="";
		$est_dat_prior="";$est_dat_additional="";$est_dat_tot="";$sub_expan_prior="";$sub_expan_additional="";$sub_expan_tot="";$sub_dat_prior="";$sub_dat_additional="";$sub_dat_tot="";$mr_subexpan_prior="";$mr_subexpan_additional="";$mr_subexpan_tot="";$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";$mr_subexpan_dat_tot="";
		$total_expenditure_prior=""; $total_expenditure_additional=""; $total_expenditure_tot="";
		####Tab5####
		$bef_sub_expan="";$after_sub_expan="";$items_12aprior_I2="";$ann_12aprior_I3="";$ann_12aprior_I4="";$act_12aprior_I5="";$act_12aprior_I6="";$per_12aprior_I7="";$items_12aprior_II2="";$ann_12aprior_II3="";$ann_12aprior_II4="";$act_12aprior_II5="";$act_12aprior_II6="";$per_12aprior_II7="";$items_12aafter_I2="";$items_12aafter_I3="";$items_12aafter_I4="";$items_12aafter_I5="";$items_12aafter_I6="";$items_12aafter_I7="";$items_12aafter_II2="";$items_12aafter_II3="";$items_12aafter_II4="";$items_12aafter_II5="";$items_12aafter_II5="";$items_12aafter_II6="";$items_12aafter_II7="";$items_12b_first="";$quan_12b_first="";$cos_12b_first="";$total_12b_first="";$items_12b_second="";$quan_12b_second="";$cos_12b_second="";$total_12b_second="";
		$items_12b_third="";$quan_12b_third="";$cos_12b_third="";$total_12b_third="";$items_12c_first="";$quan_12c_first="";$cos_12c_first="";$total_12c_first="";$items_12c_second="";$quan_12c_second="";$cos_12c_second="";$total_12c_second="";$items_12c_third="";$quan_12c_third="";$cos_12c_third="";$total_12c_third="";$total_12d_prod="";$item_13aprior_I2="";$actquant_13aprior_I3="";$actval_13aprior_I4="";$utlquant_13aprior_I5="";$utlval_13aprior_I6="";$rem_13aprior_I7="";$item_13aprior_II2="";$actquant_13aprior_II3="";$actval_13aprior_II4="";$utlquant_13aprior_II5="";$utlval_13aprior_II6="";$rem_13aprior_II7="";$item_13aafter_I2="";$actquant_13aafter_I3="";$actval_13aafter_I4="";$utlquant_13aafter_I5="";$utlval_13aafter_I6="";$rem_13aafter_I7="";$item_13aafter_II2="";$actquant_13aafter_II3="";$actval_13aafter_II4="";$utlquant_13aafter_II5="";$utlval_13aafter_II6="";$rem_13aafter_II7="";$item_13b_I2="";$source_13b_I3="";$name_13b_I4="";$item_13b_II2="";$source_13b_II3="";$name_13b_II4="";
		
		####Tab6####
		$items_14a_I2="";$inassam_quant_14a_I3="";$inassam_value_14a_I4="";$outassam_quant_14a_I5="";$outassam_value_14a_I6="";$remarks_14a_I7="";$items_14a_II2="";$inassam_quant_14a_II3="";$inassam_value_14a_II4="";$outassam_quant_14a_II5="";$outassam_value_14a_II6="";$remarks_14a_II7="";$items_14a_III2="";$inassam_quant_14a_III3="";$inassam_value_14a_III4="";$outassam_quant_14a_III5="";$outassam_value_14a_III6="";$remarks_14a_III7="";$items_14a_IV2="";$inassam_quant_14a_IV3="";$inassam_value_14a_IV4="";$outassam_quant_14a_IV5="";$outassam_value_14a_IV6="";$remarks_14a_IV7="";$items_14b_I2="";$inassam_quant_14b_I3="";$inassam_value_14b_I4="";$outassam_quant_14b_I5="";$outassam_value_14b_I6="";$remarks_14b_I7="";$items_14b_II2="";$inassam_quant_14b_II3="";$inassam_value_14b_II4="";$outassam_quant_14b_II5="";$outassam_value_14b_II6="";$remarks_14b_II7="";$items_14b_III2="";$inassam_quant_14b_III3="";$inassam_value_14b_III4="";$outassam_quant_14b_III5="";$outassam_value_14b_III6="";$remarks_14b_III7="";$items_14b_IV2="";$inassam_quant_14b_IV3="";$inassam_value_14b_IV4="";$outassam_quant_14b_IV5="";$outassam_value_14b_IV6="";$remarks_14b_IV7="";
		$mandays_utilized="";		
		$man_assam_prior="";$man_nonassam_prior="";$man_assam_after="";$man_nonassam_after="";$man_total="";$sup_assam_prior="";$sup_nonassam_prior="";$sup_assam_after="";$sup_nonassam_after="";$sup_total="";$skilled_assam_prior="";$skilled_nonassam_prior="";$skilled_assam_after="";$skilled_nonassam_after="";$skilled_total="";$semiskilled_assam_prior="";$semiskilled_nonassam_prior="";$semiskilled_assam_after="";$semiskilled_assam_after="";$semiskilled_nonassam_after="";$semiskilled_total="";$unskilled_assam_prior="";$unskilled_nonassam_prior="";$unskilled_assam_after="";$unskilled_nonassam_after="";$unskilled_total="";$total_assam_prior="";$total_nonassam_prior="";$total_assam_after="";$total_nonassam_after="";$total_total="";$incentive_first="";$incentive_second="";$incentive_third="";$incentive_fourth="";$incentive_fifth="";$incent_remarks_first="";$incent_remarks_second="";$incent_remarks_third="";$incent_remarks_fourth="";$incent_remarks_fifth="";
	}else{
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
			$indus_license_date=$indus->reg_date;$indus_license_no=$indus->reg_no;
		}else{
			$indus_license_date="";$indus_license_no="";
		}	
		#### PART II #####	
		$note_substantial=$results['note_substantial'];$ec_no=$results['ec_no'];$ec_date=$results['ec_date'];$land_owned=$results['land_owned'];$no_pur_deed=$results['no_pur_deed'];$dor_pur_deed=$results['dor_pur_deed'];$pur_price=$results['pur_price'];$pur_reg_fee=$results['pur_reg_fee'];$stamp_duty=$results['stamp_duty'];$date_possesion=$results['date_possesion'];$lease_from=$results['lease_from'];$lease_to=$results['lease_to'];
		if(!empty($results["intimation"])){
			$intimation=json_decode($results["intimation"]);
			$intimation_letter_no=$intimation->letter_no;$intimation_dt=$intimation->dt;
		}else{
			$intimation_letter_no="";$intimation_dt="";
		}
		if(!empty($results["consultant"])){
			$consultant=json_decode($results["consultant"]);
			$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
		}else{
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";
		}
		if(!empty($results["land_detail"])){
			$land_detail=json_decode($results["land_detail"]);
			$land_detail_dag_no=$land_detail->dag_no;$land_detail_patta_no=$land_detail->patta_no;$land_detail_revenue_vill=$land_detail->revenue_vill;$land_detail_mauza=$land_detail->mouza;
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
		#### PART III #####	
		$tot_cov_area=$results['tot_cov_area'];$ann_rent=$results['ann_rent'];$build_loc=$results['build_loc'];$land_total=$results['land_total'];$site_total=$results['site_total'];$fact_direct_total=$results['fact_direct_total'];$office_direct_total=$results['office_direct_total'];$plant_total=$results['plant_total'];$equip_total=$results['equip_total'];$power_total=$results['power_total'];$electrical_total=$results['electrical_total'];$utility_total=$results['utility_total'];$misc_total=$results['misc_total'];$prelim_total=$results['prelim_total'];$total_f_coloumn=$results['total_f_coloumn'];$total_fixed_capital=$results['total_fixed_capital'];
		
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
			$land_prior=$land->prior;$land_additional=$land->additional;
		}else{
			$land_prior="";$land_additional="";
		}
		if(!empty($results["site"])){
			$site=json_decode($results["site"]);
			$site_prior=$site->prior;$site_additional=$site->additional;
		}else{
			$site_prior="";$site_additional="";
		}
		if(!empty($results["fact_direct"])){
			$fact_direct=json_decode($results["fact_direct"]);
			$fact_direct_prior=$fact_direct->prior;$fact_direct_additional=$fact_direct->additional;
		}else{
			$fact_direct_prior="";$fact_direct_additional="";
		}
		if(!empty($results["fact_direct"])){
			$fact_direct=json_decode($results["fact_direct"]);
			$fact_direct_prior=$fact_direct->prior;$fact_direct_additional=$fact_direct->additional;
		}else{
			$fact_direct_prior="";$fact_direct_additional="";
		}
		if(!empty($results["office_direct"])){
			$office_direct=json_decode($results["office_direct"]);
			$office_direct_prior=$office_direct->prior;$office_direct_additional=$office_direct->additional;
		}else{
			$office_direct_prior="";$office_direct_additional="";
		}
		if(!empty($results["plant"])){
			$plant=json_decode($results["plant"]);
			$plant_prior=$plant->prior;$plant_additional=$plant->additional;
		}else{
			$plant_prior="";$plant_additional="";
		}
		if(!empty($results["equip"])){
			$equip=json_decode($results["equip"]);
			$equip_prior=$equip->prior;$equip_additional=$equip->additional;
		}else{
			$equip_prior="";$equip_additional="";
		}
		if(!empty($results["power"])){
			$power=json_decode($results["power"]);
			$power_prior=$power->prior;$power_additional=$power->additional;
		}else{
			$power_prior="";$power_additional="";
		}
		if(!empty($results["power"])){
			$power=json_decode($results["power"]);
			$power_prior=$power->prior;$power_additional=$power->additional;
		}else{
			$power_prior="";$power_additional="";
		}
		if(!empty($results["electrical"])){
			$electrical=json_decode($results["electrical"]);
			$electrical_prior=$electrical->prior;$electrical_additional=$electrical->additional;
		}else{
			$electrical_prior="";$electrical_additional="";
		}
		if(!empty($results["utility"])){
			$utility=json_decode($results["utility"]);
			$utility_prior=$utility->prior;$utility_additional=$utility->additional;
		}else{
			$utility_prior="";$utility_additional="";
		}
		if(!empty($results["misc"])){
			$misc=json_decode($results["misc"]);
			$misc_prior=$misc->prior;$misc_additional=$misc->additional;
		}else{
			$misc_prior="";$misc_additional="";
		}
		if(!empty($results["prelim"])){
			$prelim=json_decode($results["prelim"]);
			$prelim_prior=$prelim->prior;$prelim_additional=$prelim->additional;
		}else{
			$prelim_prior="";$prelim_additional="";
		}
		##### PART IV #####
		$total_contribution=$results['total_contribution'];$financial_ins_tot=$results['financial_ins_tot'];$term_tot=$results['term_tot'];$wc_tot=$results['wc_tot'];$tl_tot=$results['tl_tot'];$roi_tl_tot=$results['roi_tl_tot'];$repayment_tot=$results['repayment_tot'];$tl_amt_tot=$results['tl_amt_tot'];$tl_date_tot=$results['tl_date_tot'];$wor_cap_tot=$results['wor_cap_tot'];$wor_dat_tot=$results['wor_dat_tot'];$quant_tot=$results['quant_tot'];$quant_let_tot=$results['quant_let_tot'];$quant_dat_tot=$results['quant_dat_tot'];$elec_tot=$results['elec_tot'];$elec_dat_tot=$results['elec_dat_tot'];$ser_en_tot=$results['ser_en_tot'];$est_amt_tot=$results['est_amt_tot'];$est_mr_tot=$results['est_mr_tot'];$est_dat_tot=$results['est_dat_tot'];$sub_expan_tot=$results['est_dat_tot'];$sub_dat_tot=$results['sub_dat_tot'];$mr_subexpan_tot=$results['mr_subexpan_tot'];$mr_subexpan_dat_tot=$results['mr_subexpan_dat_tot'];$total_expenditure_prior=$results['total_expenditure_prior'];$total_expenditure_additional=$results['total_expenditure_additional'];$total_expenditure_tot=$results['total_expenditure_tot'];
		
		if(!empty($results["souces_f_finance"])){
			$souces_f_finance=json_decode($results["souces_f_finance"]);
			$souces_f_finance_a=$souces_f_finance->a;$souces_f_finance_b=$souces_f_finance->b;$souces_f_finance_c=$souces_f_finance->c;$souces_f_finance_d=$souces_f_finance->d;$souces_f_finance_e=$souces_f_finance->e;
		}else{
			$souces_f_finance_a="";$souces_f_finance_b="";$souces_f_finance_c="";$souces_f_finance_d="";$souces_f_finance_e="";
		}
		if(!empty($results["financial_ins"])){
			$financial_ins=json_decode($results["financial_ins"]);
			$financial_ins_prior=$financial_ins->prior;$financial_ins_additional=$financial_ins->additional;
		}else{
			$financial_ins_prior="";$financial_ins_additional="";
		}
		if(!empty($results["term"])){
			$term=json_decode($results["term"]);
			$term_prior=$term->prior;$term_additional=$term->additional;
		}else{
			$term_prior="";$term_additional="";
		}
		if(!empty($results["wc"])){
			$wc=json_decode($results["wc"]);
			$wc_prior=$wc->prior;$wc_additional=$wc->additional;
		}else{
			$wc_prior="";$wc_additional="";
		}
		if(!empty($results["tl"])){
			$tl=json_decode($results["tl"]);
			$tl_prior=$tl->prior;$tl_additional=$tl->additional;
		}else{
			$tl_prior="";$tl_additional="";
		}
		if(!empty($results["roi_tl"])){
			$roi_tl=json_decode($results["roi_tl"]);
			$roi_tl_prior=$roi_tl->prior;$roi_tl_additional=$roi_tl->additional;
		}else{
			$roi_tl_prior="";$roi_tl_additional="";
		}
		if(!empty($results["repayment"])){
			$repayment=json_decode($results["repayment"]);
			$repayment_prior=$repayment->prior;$repayment_additional=$repayment->additional;
		}else{
			$repayment_prior="";$repayment_additional="";
		}
		if(!empty($results["tl_amt"])){
			$tl_amt=json_decode($results["tl_amt"]);
			$tl_amt_prior=$tl_amt->prior;$tl_amt_additional=$tl_amt->additional;
		}else{
			$tl_amt_prior="";$tl_amt_additional="";
		}
		if(!empty($results["tl_date"])){
			$tl_date=json_decode($results["tl_date"]);
			$tl_date_prior=$tl_date->prior;$tl_date_additional=$tl_date->additional;
		}else{
			$tl_date_prior="";$tl_date_additional="";
		}
		if(!empty($results["wor_cap"])){
			$wor_cap=json_decode($results["wor_cap"]);
			$wor_cap_prior=$wor_cap->prior;$wor_cap_additional=$wor_cap->additional;
		}else{
			$wor_cap_prior="";$wor_cap_additional="";
		}
		if(!empty($results["wor_dat"])){
			$wor_dat=json_decode($results["wor_dat"]);
			$wor_dat_prior=$wor_dat->prior;$wor_dat_additional=$wor_dat->additional;
		}else{
			$wor_dat_prior="";$wor_dat_additional="";
		}
		if(!empty($results["quant"])){
			$quant=json_decode($results["quant"]);
			$quant_prior=$quant->prior;$quant_additional=$quant->additional;
		}else{
			$quant_prior="";$quant_additional="";
		}
		if(!empty($results["quant_let"])){
			$quant_let=json_decode($results["quant_let"]);
			$quant_let_prior=$quant_let->prior;$quant_let_additional=$quant_let->additional;
		}else{
			$quant_let_prior="";$quant_let_additional="";
		}
		if(!empty($results["quant_dat"])){
			$quant_dat=json_decode($results["quant_dat"]);
			$quant_dat_prior=$quant_dat->prior;$quant_dat_additional=$quant_dat->additional;
		}else{
			$quant_dat_prior="";$quant_dat_additional="";
		}
		if(!empty($results["elec"])){
			$elec=json_decode($results["elec"]);
			$elec_prior=$elec->prior;$elec_additional=$elec->additional;
		}else{
			$elec_prior="";$elec_additional="";
		}
		if(!empty($results["elec_dat"])){
			$elec_dat=json_decode($results["elec_dat"]);
			$elec_dat_prior=$elec_dat->prior;$elec_dat_additional=$elec_dat->additional;
		}else{
			$elec_dat_prior="";$elec_dat_additional="";
		}
		if(!empty($results["ser_en"])){
			$ser_en=json_decode($results["ser_en"]);
			$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;
		}else{
			$ser_en_prior="";$ser_en_additional="";
		}
		if(!empty($results["ser_en"])){
			$ser_en=json_decode($results["ser_en"]);
			$ser_en_prior=$ser_en->prior;$ser_en_additional=$ser_en->additional;
		}else{
			$ser_en_prior="";$ser_en_additional="";
		}
		if(!empty($results["est_amt"])){
			$est_amt=json_decode($results["est_amt"]);
			$est_amt_prior=$est_amt->prior;$est_amt_additional=$est_amt->additional;
		}else{
			$est_amt_prior="";$est_amt_additional="";
		}
		if(!empty($results["est_mr"])){
			$est_mr=json_decode($results["est_mr"]);
			$est_mr_prior=$est_mr->prior;$est_mr_additional=$est_mr->additional;
		}else{
			$est_mr_prior="";$est_mr_additional="";
		}
		if(!empty($results["est_dat"])){
			$est_dat=json_decode($results["est_dat"]);
			$est_dat_prior=$est_dat->prior;$est_dat_additional=$est_dat->additional;
		}else{
			$est_dat_prior="";$est_dat_additional="";
		}
		if(!empty($results["sub_expan"])){
			$sub_expan=json_decode($results["sub_expan"]);
			$sub_expan_prior=$sub_expan->prior;$sub_expan_additional=$sub_expan->additional;
		}else{
			$sub_expan_prior="";$sub_expan_additional="";
		}
		if(!empty($results["sub_dat"])){
			$sub_dat=json_decode($results["sub_dat"]);
			$sub_dat_prior=$sub_dat->prior;$sub_dat_additional=$sub_dat->additional;
		}else{
			$sub_dat_prior="";$sub_dat_additional="";
		}
		if(!empty($results["mr_subexpan"])){
			$mr_subexpan=json_decode($results["mr_subexpan"]);
			$mr_subexpan_prior=$mr_subexpan->prior;$mr_subexpan_additional=$mr_subexpan->additional;
		}else{
			$mr_subexpan_prior="";$mr_subexpan_additional="";
		}
		if(!empty($results["mr_subexpan_dat"])){
			$mr_subexpan_dat=json_decode($results["mr_subexpan_dat"]);
			$mr_subexpan_dat_prior=$mr_subexpan_dat->prior;$mr_subexpan_dat_additional=$mr_subexpan_dat->additional;
		}else{
			$mr_subexpan_dat_prior="";$mr_subexpan_dat_additional="";
		}
		##### PART IV #####
		
		
		
		
		##### PART IV #####
		
		
		
		
		
		#### Courier details #####	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==8){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="active";$tabbtn9="";
	}
	if($showtab==9){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn10="active";
	}
	if($showtab==10){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";$tabbtn10="active";
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
	<?php include ("dic_form5_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
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
									<strong>FORM : 1B<br/><?php echo $form_name=$formFunctions->get_formName('dic','6'); ?><br/>(For Existing unit undertaking Substantial Expansion)</strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab"  href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a data-toggle="tab"  href="#table3">PART III</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a data-toggle="tab"  href="#table4">PART IV</a></li>
									<li class="<?php echo $tabbtn5; ?>"><a data-toggle="tab"  href="#table5">PART V</a></li>
									<li class="<?php echo $tabbtn6; ?>"><a data-toggle="tab"  href="#table6">PART VI</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								
								<table class="table table-responsive ">									
									<tr>
									    <td width="25%">1. (a) Name of the Industrial unit :</td>
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
										<td colspan="4"> C. Office address with telephone / mobile no ( if any) :</td> 	
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
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode2;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="office_mob" value="<?php echo $office_mob;?>" validate="pincode" maxlength="6" required></td>
									</tr>
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" name="office_email" value="<?php echo $office_email;?>" validate="pincode" maxlength="6" required></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">2. (a) Constitution of the organization promoting the unit (Whether Proprietorial / partnership / Private Limited / Limited company / Cooperative Society/trust/any other legal entity ) </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Name(s) , Permanent address(es) of the Proprietor/ Partners / Directors/ Secretary / President /chairman/CEO/Trustee etc with the mention of their permanent Account No (PAN) :
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
										<thead>
											<tr >
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
										$member_results=$dic->query("select * from dic_form6_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="vill<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="dist<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="pin<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="pan<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="10" validate="pan_no" ></td>
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
										<td> Registration Number:</td>
										<td><input type="text" class="form-control text-uppercase"  name="act[reg_no]" value="<?php echo $act_reg_no;?>"></td>
										<td> Registration Date :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="act[reg_date]" requried="required" value="<?php echo $act_reg_date;?>"></td>
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
										<td><input type="text" class="dob form-control text-uppercase" name="provisional[reg_date]" requried="required" value="<?php echo $provisional_reg_date;?>"></td>
									</tr>
									<tr>
										<td colspan="4">ii) Permanent Registration no and date/EM part-II acknowledgement No and date  :</td>
									</tr>
									<tr>
										<td>Permanent Registration No.</td>
										<td><input  type="text" class="form-control text-uppercase"  name="permanent[reg_no]" min="5000" value="<?php echo $permanent_reg_no;?>"></td>
										<td>Permanent Registration date</td>
										<td><input type="text" class="dob form-control text-uppercase" name="permanent[reg_date]" requried="required" value="<?php echo $permanent_reg_date;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(b) Medium and Large </td>
									</tr>
									<tr>
										<td colspan="4"> i) No and date of Industrial License/Letter of Intent/Industrial Entrepreneurs Memorandum (IEM) / Entrepreneurs Memorandum (EM) prior to and after commencement of commercial production/service with uptodate amendments.</td>
									</tr>
									<tr>
										<td width="25%">No.</td>
										<td width="25%"><input type="text" class="form form-control" name="indus[license_no]" value="<?php echo $indus_license_no; ?>"></td>
										<td width="25%">Date</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="indus[license_date]" requried="required" value="<?php echo $indus_license_date;?>"></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save6a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
									
								</table>
								</form>
							</div>
							<div  id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								
								<table class="table table-responsive ">	
								<tbody>	
									<tr>
										<td colspan="4">4. (a) Letter no and date etc acknowledging intimation given/ according approval by concerned implementing agency for substantial expansion </td>
									</tr>
									
									<tr>
										<td width="25%">Letter No:</td>
										<td width="25%%"><input type="text" class="form form-control" name="intimation[letter_no]" value="<?php echo $intimation_letter_no; ?>"></td>
										<td width="25%%">Date:</td>
										<td width="25%%"><input type="text" class="dob form-control text-uppercase" name="intimation[dt]" requried="required" value="<?php echo $intimation_dt;?>"></td>
									</tr>
									<tr>
										<td colspan="2"> b) A note in brief on substantial expansion undertaken with special reference to its product/ service, process, existing capacity etc. </td>
										<td><textarea class="form-control text-uppercase" name="note_substantial" value="<?php echo $note_substantial; ?>" maxlength="255" validate="textarea"></textarea></td>
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
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn1] value="<?php echo $consultant_sn1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="consultant[sn2]" value="<?php echo $consultant_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[vill]" value="<?php echo $consultant_vill;?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="consultant[dist]" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($consultant_dist) && ($consultant_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[pincode]" value="<?php echo $consultant_pincode;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="consultant[mobile]" value="<?php echo $consultant_mobile;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" name="consultant[email]" value="<?php echo $consultant_email;?>"></td>
										<td></td>
										<td></td>
									</tr>			
									<tr>
										<td colspan="4"> d) EC No and date obtained earlier, if any </td>
									</tr>
									<tr>
										<td width="25%">EC No </td>
										<td width="25%"><input type="text" class="form-control" name="ec_no" value="<?php echo $ec_no;?>"></td>
										<td width="25%">Date</td>
										<td width="25%"><input type="text" class="dob form-control" name="ec_date" requried="required" value="<?php echo $ec_date;?>"></td>
									</tr>	
									<tr>
										<td colspan="4"> 5. Details of land including additional investment etc made  </td>
									</tr>			
									<tr>
										<td colspan="2">a) Whether the land is owned/ leased hold from private party/ slotted by the Government/ Government agency </td>
										<td>
											<td width="25%"> 
											<label class="radio-inline">
												<input type="radio" name="land_owned" value="Y" <?php if($land_owned=='Y') echo 'checked'; ?> >Owned
											</label>
											<label class="radio-inline">
												 <input type="radio" name="land_owned" value="N" <?php if($land_owned=='N') echo 'checked'; ?> >Leased
											</label>									
										</td>
										</td>
									</tr>			
									<tr>
										<td >b. (i) Total Area (sq mtr) : </td>
										<td><input type="text" class="form-control" name="total_area" value="<?php echo $total_area;?>"></td>
										<td >(ii) Area under use for the project : </td>
										<td><input type="text" class="form-control" name="area_under_use" value="<?php echo $area_under_use;?>"></td>
									</tr>			
									<tr>
										<td colspan="3">c). Location : </td>
										<td width="25%"><input type="text" class="form-control" name="area_loc" value="<?php echo $area_loc;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">d). Dag no, Patta no, Revenue village and Mauza </td>
									</tr>
									<tr>
										<td width="25%">Dag no</td>
										<td width="25%"><input type="text" class="form-control" name="land_detail[dag_no]" value="<?php echo $land_detail_dag_no;?>"></td>
										<td width="25%">Patta no</td>
										<td width="25%"><input type="text" class="form-control" name="land_detail[patta_no]" value="<?php echo $land_detail_patta_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">Revenue village</td>
										<td width="25%"><input type="text" class="form-control" name="land_detail[revenue_vill]" value="<?php echo $land_detail_revenue_vill;?>"></td>
										<td width="25%">Mauza</td>
										<td width="25%"><input type="text" class="form-control" name="land_detail[mauza]" value="<?php echo $land_detail_mauza;?>"></td>
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
										<td><input type="text" class="form-control text-uppercase" name="land_owner[vill]" value="<?php echo $land_owner_vill;?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="land_owner[dist]" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($land_owner_dist) && ($land_owner_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="land_owner[pincode]" value="<?php echo $land_owner_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="land_owner[mobile]" value="<?php echo $land_owner_mobile;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" name="land_owner[email]" value="<?php echo $land_owner_email;?>"></td>
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
										<td><input type="text" class="dob form-control" name="dor_pur_deed" required="required" value="<?php echo $dor_pur_deed;?>"></td>
									</tr>
									<tr>
										<td colspan="4">Address of the registering authority</td>
									</tr>
									<tr>
										<td width="25%">Name </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[name]" value="<?php echo $auth_name;?>" validate="letters"></td>
										<td width="25%">Designation</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="auth[desig]" value="<?php echo $auth_desig;?>"></td>
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
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="auth[dist]" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($auth_dist) && ($auth_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
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
										<td width="25%"><input type="text" class="form-control" name="pur_price" value="<?php echo $pur_price;?>"></td>
										<td width="25%">Registration fee</td>
										<td width="25%"><input type="text" class="form-control" name="pur_reg_fee" value="<?php echo $pur_reg_fee;?>"></td>
									</tr>
									<tr>
										<td colspan="3">Stamp duty/annual lease rent payable/one time premium paid </td>
										<td width="25%"><input type="text" class="form-control" name="stamp_duty" value="<?php echo $stamp_duty;?>"></td>
									</tr>
									<tr>
										<td colspan="3">h) The date of taking over possession of land :</td>
										<td width="25%"><input type="text" class="dob form-control" name="date_possesion" value="<?php echo $date_possesion;?>"></td>
									</tr>
									<tr>
										<td>i) Duration of lease  :</td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dob form-control" name="lease_from" value="<?php echo $lease_from;?>"></td>
										<td>To</td>
										<td><input type="text" class="dob form-control" name="lease_to" value="<?php echo $lease_to;?>"></td>
									</tr>
								</tbody>
								</table>
							</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">6. Details of building</td>
									</tr>
									<tr>
										<td colspan="4">a) If the building has been constructed</td>
									</tr>
									<tr>
										<td width="25%">(i) Date of starting of the civil construction : </td>
										<td width="25%"><input type="text" class="dob form-control" name="building_construction[strt_dt]" value="<?php echo $building_construction_strt_dt;?>"></td>
										<td width="25%">(ii) Date of completion of the civil construction works :</td>
										<td width="25%"><input type="text" class="dob form-control" name="building_construction[comp_dt]" value="<?php echo $building_construction_com_dt;?>"></td>
									</tr>
									<tr>
										<td width="25%">(iii) Total area under construction : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[total_area]" value="<?php echo $building_construction_total_area;?>"></td>
										<td width="25%">(iv) Total cost of construction, site development etc :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[total_cost]" value="<?php echo $building_construction_total_cost;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(v) Cost of construction and area of the building connected directly to manufacturing process/service rendered : </td>
									</tr>
									<tr>
										<td>Cost of construction</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="building_construction[direct_cost]"  value="<?php echo $building_construction_direct_cost;?>"> </td>
										<td>Area of the building</td>
										<td><input type="text" class="form-control text-uppercase" name="building_construction[direct_area]" value="<?php echo $building_construction_direct_area;?>"></td>
									</tr>
									<tr>
										<td colspan="4">b) If the building has been allotted by the Government agency/taken on rent from private party:</td>
									</tr>
									<tr>
										<td colspan="4">(i) Name & address of the Govt agency / land lord</td>
									</tr>
									<tr>
										<td>Name</td>
										<td width="25%"><input type="text" class="form form-control" name="govt_agency[name]" value="<?php echo $govt_agency_name;?>" validate="letters"></td>
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
											<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="govt_agency[dist]" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($govt_agency_dist) && ($govt_agency_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
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
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tot_cov_area" value="<?php echo $tot_cov_area;?>"></td>
										<td width="25%">(iii) Annual rent :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ann_rent" value="<?php echo $ann_rent;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(iv) No & date of registration of the rent agreement/lease deed and address of the registering authority.</td>
									</tr>
									<tr>
										<td>Registration Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="build_reg[no]" value="<?php echo $build_reg_no;?>"></td>
										<td>Registration Date :</td>
										<td><input type="text" class="dob form-control" name="build_reg[dt]" value="<?php echo $build_reg_dt;?>"></td>
									</tr>
									<tr>
										<td>(v) Location :</td>
										<td><input type="text" class="form-control" name="build_loc" value="<?php echo $build_loc;?>"></td>
									</tr>
									<tr>
										<td colspan="4">(vi) Period of validity of rent agreement/lease deed:</td>
									</tr>
									<tr>
										<td>From</td>
										<td><input type="text" class="dob form-control" name="val_period[rent_from]" value="<?php echo $val_period_rent_from;?>"></td>
										<td>To</td>
										<td><input type="text" class="dob form-control" name="val_period[rent_to]" value="<?php echo $val_period_rent_to;?>"></td>
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
											<tr>
												<th class="text-center">1</th>
												<th class="text-center">2</th>
												<th class="text-center">3</th>
												<th class="text-center">4</th>
												<th class="text-center">5</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>a.</td>
												<td>Land </td>
												<td><input type="text" class="form form-control" name="land[prior]" value="<?php echo $land_prior?>"></td>
												<td><input type="text" class="form form-control" name="land[additional]" value="<?php echo $land_additional?>"></td>
												<td><input type="text" class="form form-control" name="land_total" value="<?php echo $land_total?>"></td>
											</tr>
											<tr>
												<td>b.</td>
												<td>Site Development </td>
												<td><input type="text" class="form form-control" name="site[prior]" value="<?php echo $site_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="site[additional]" value="<?php echo $site_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="site_total" value="<?php echo $site_total; ?>"></td>
											</tr>
											<tr>
												<td rowspan="3">c</td>
												<td colspan="4">Building</td>
											</tr>
											<tr>
												<td>i)  Factory/Institutional building and other civil construction works directly connected to process of manufacture/service rendered </td>
												<td><input type="text" class="form form-control" name="fact_direct[prior]" value="<?php echo $fact_direct_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="fact_direct[additional]" value="<?php echo $fact_direct_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="fact_direct_total" value="<?php echo $fact_direct_total; ?>"></td>
											</tr>
											<tr>
												<td>ii) Office building, labour quarter etc no directly connected to process of manufacture/ service rendered (ineligible building) </td>
												<td><input type="text" class="form form-control" name="office_direct[prior]" value="<?php echo $office_direct_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="office_direct[additional]" value="<?php echo $office_direct_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="office_direct_total" value="<?php echo $office_direct_total;?>"></td>
											</tr>
											
											
											<tr>
												<td>d.</td>
												<td>Plant and Machinery </td>
												<td><input type="text" class="form form-control" name="plant[prior]" value="<?php echo $plant_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="plant[additional]" value="<?php echo $plant_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="plant_total" value="<?php echo $plant_total; ?>"></td>
											</tr>
											<tr>
												<td>e.</td>
												<td>Equipment, accessories, components & fittings etc </td>
												<td><input type="text" class="form form-control" name="equip[prior]" value="<?php echo$equip_prior;?>"></td>
												<td><input type="text" class="form form-control" name="equip[additional]" value="<?php echo$equip_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="equip_total" value="<?php echo$equip_total;?>"></td>
											</tr>
											<tr>
												<td>f.</td>
												<td>Drawal of Power line </td>
												<td><input type="text" class="form form-control" name="power[prior]" value="<?php echo $power_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="power[additional]" value="<?php echo $power_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="power_total" value="<?php echo $power_total; ?>"></td>
											</tr>
											<tr>
												<td>g.</td>
												<td>Electrical Installation other than drawal of power line </td>
												<td><input type="text" class="form form-control" name="electrical[prior]" value="<?php echo $electrical_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="electrical[additional]" value="<?php echo $electrical_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="electrical_total" value="<?php echo $electrical_total; ?>"></td>
											</tr>
											<tr>
												<td>h.</td>
												<td>Utility installation other than electrical power </td>
												<td><input type="text" class="form form-control" name="utility[prior]" value="<?php echo $utility_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="utility[additional]" value="<?php echo $utility_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="utility_total" value="<?php echo $utility_total; ?>"></td>
											</tr>
											<tr>
												<td>i.</td>
												<td>Miscellaneous fixed assets ( in details) </td>
												<td><input type="text" class="form form-control" name="misc[prior]" value="<?php echo $misc_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="misc[additional]" value="<?php echo $misc_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="misc_total" value="<?php echo $misc_total; ?>"></td>
											</tr>
											<tr>
												<td>j.</td>
												<td>Preliminary and preoperative expenses capitalized </td>
												<td><input type="text" class="form form-control" name="prelim[prior]" value="<?php echo $prelim_prior; ?>"></td>
												<td><input type="text" class="form form-control" name="prelim[additional]" value="<?php echo $prelim_additional; ?>"></td>
												<td><input type="text" class="form form-control" name="prelim_total" value="<?php echo $prelim_total; ?>"></td>
											</tr>
										</tbody>
									  </table>
									</tr>
									<tr>
										<td>B. Total of the coloumn 4 as percentage of the total column 3:</td>
										<td><input type="text" class="form-control text-uppercase" name="total_f_coloumn" value="<?php echo $total_f_coloumn; ?>"></td>
										<td>C. Total fixed capital investment (gross value) as per last EC:</td>
										<td><input type="text" class=" form-control text-uppercase" name="total_fixed_capital" value="<?php echo $total_fixed_capital; ?>"></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="dic_form6.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success" name="save6c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								  </table>
								</tr>								
							</table>
							</form>
							</div>
							<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
							<table class="table table-responsive ">
								<tr>
									<td colspan="4">8. Source of Finance </td>
								</tr>	
								<tr>
									<td width="25%">a. Promoters contribution:</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="souces_f_finance[a]" value="<?php echo $souces_f_finance_a; ?>"/></td>
									<td width="25%">b. Govt contribution as seed money/share capital etc :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="souces_f_finance[b]" value="<?php echo$souces_f_finance_b; ?>"/></td>
								</tr>
								<tr>
									<td>c. Borrowing from Bank/Financial Institution :</td>									
									<td><input type="text" class="form-control text-uppercase" name="souces_f_finance[c]" value="<?php echo $souces_f_finance_c; ?>"/></td>
									<td>d. Un secured loan/private finance :</td>
									<td><input type="text" class="form-control text-uppercase" name="souces_f_finance[d]" value="<?php echo $souces_f_finance_d; ?>"/></td>
								</tr>
								<tr>
									<td >e. Any other sources :</td>
									<td><input type="text" class="form-control text-uppercase" name="souces_f_finance[e]" value="<?php echo $souces_f_finance_e;?>"/></td>
								</tr>
								<tr>
									<td>Total :</td>
									<td><input type="text" class="form-control text-uppercase" name="total_contribution" value="<?php echo $total_contribution;?>"/></td>
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
											<td><input type="text" class="form-control text-uppercase" name="financial_ins_tot" value="<?php echo $financial_ins_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="3">b</td>
											<td colspan="4">Amount sanctioned as </td>
										</tr>
										<tr>
											<td>i)   Term Loan ( in rupees)  </td>
											<td><input type="text" class="form form-control" name="term[prior]" value="<?php echo $term_prior; ?>"></td>
											<td><input type="text" class="form form-control" name="term[additional]" value="<?php echo $term_additional; ?>"></td>
											<td><input type="text" class="form form-control" name="term_tot" value="<?php echo  $term_tot; ?>"></td>
										</tr>
										<tr>
											<td>ii)  WC/OD/CC/OCC/Margin money contribution etc (in rupees) </td>
											<td><input type="text" class="form form-control" name="wc[prior]" value="<?php echo $wc_prior;?>"></td>
											<td><input type="text" class="form form-control" name="wc[additional]" value="<?php echo $wc_additional;?>"></td>
											<td><input type="text" class="form form-control" name="wc_tot" value="<?php echo   $wc_tot;?>"></td>
										</tr>
										<tr>
											<td rowspan="3">c</td>
											<td >i)  Term Loan disbursed till date of application </td>
											<td><input type="text" class="form form-control" name="tl[prior]" value="<?php echo $tl_prior;?>"></td>
											<td><input type="text" class="form form-control" name="tl[additional]" value="<?php echo $tl_additional; ?>"></td>
											<td><input type="text" class="form form-control" name="tl_tot" value="<?php echo $tl_tot; ?>"></td>
										</tr>
										<tr>
											<td>ii)  Rate of Interest on TL </td>
											<td><input type="text" class="form form-control" name="roi_tl[prior]" value="<?php echo $roi_tl_prior;?>"></td>
											<td><input type="text" class="form form-control" name="roi_tl[additional]" value="<?php echo $roi_tl_additional;?>"></td>
											<td><input type="text" class="form form-control" name="roi_tl_tot" value="<?php echo $roi_tl_tot; ?>"></td>
										</tr>
										<tr>
											<td>iii) Schedule of Repayment of TL ( showing principal amount, Interest etc separately ) </td>
											<td><input type="text" class="form form-control" name="repayment[prior]" value="<?php echo $repayment_prior; ?>"></td>
											<td><input type="text" class="form form-control" name="repayment[additional]" value="<?php echo $repayment_additional; ?>"></td>
											<td><input type="text" class="form form-control" name="repayment_tot" value="<?php echo $repayment_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="5">d</td>
											<td colspan="4">Letter no & date of sanction of loan as </td>
										</tr>
										<tr>
											<td>i)  Term Loan </td>
											<td><input type="text" class="form form-control" name="tl_amt[prior]" value="<?php echo $tl_amt_prior; ?>" placeholder="Amount" ></td>
											<td><input type="text" class="form form-control" name="tl_amt[additional]" value="<?php echo $tl_amt_prior;?>" placeholder="Amount"></td>
											<td><input type="text" class="form form-control" name="tl_amt_tot" value="<?php echo $tl_amt_prior; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="tl_date[prior]" value="<?php echo $tl_date_prior; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="tl_date[additional]" value="<?php echo $tl_date_additional; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="tl_date_tot" value="<?php echo $tl_date_tot;?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td>ii) Working Capital etc </td>
											<td><input type="text" class="form form-control" name="wor_cap[prior]" value="<?php echo $wor_cap_prior; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form form-control" name="wor_cap[additional]" value="<?php echo $wor_cap_additional; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form form-control" name="wor_cap_tot" value="<?php echo $wor_cap_tot; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="wor_dat[prior]" value="<?php echo $wor_dat_prior; ?>" placeholder="Date" ></td>
											<td><input type="text" class="dob form-control" name="wor_dat[additional]" value="<?php echo $wor_dat_additional; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="wor_dat_tot" value="<?php echo $wor_dat_tot; ?>" placeholder="Date"></td>
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
											<td><input type="text" class="form form-control" name="quant[prior]" value="<?php echo $quant_prior; ?>"  placeholder="Quantum" ></td>
											<td><input type="text" class="form form-control" name="quant[additional]" value="<?php echo $quant_additional; ?>" placeholder="Quantum"></td>
											<td><input type="text" class="form form-control" name="quant_tot" value="<?php echo $quant_tot; ?>" placeholder="Quantum"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="form form-control" name="quant_let[prior]" value="<?php echo $quant_let_prior; ?>" placeholder="Letter No"></td>
											<td><input type="text" class="form form-control" name="quant_let[additional]" value="<?php echo $quant_let_additional; ?>" placeholder="Letter No"></td>
											<td><input type="text" class="form form-control" name="quant_let_tot" value="<?php echo $quant_let_tot; ?>" placeholder="Letter No"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="quant_dat[prior]" value="<?php echo $quant_dat_prior; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="quant_dat[additional]" value="<?php echo $quant_dat_additional; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="quant_dat_tot" value="<?php echo $quant_dat_tot; ?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td rowspan="2">b</td>
											<td> Connected electrical load and date of connection of power </td>
											<td><input type="text" class="form form-control" name="elec[prior]" value="<?php echo $elec_prior; ?>" placeholder="Load" ></td>
											<td><input type="text" class="form form-control" name="elec[additional]" value="<?php echo $elec_additional; ?>" placeholder="Load"></td>
											<td><input type="text" class="form form-control" name="elec_tot" value="<?php echo $elec_tot; ?>" placeholder="Load"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="elec_dat[prior]" value="<?php echo $elec_dat_prior; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="elec_dat[additional]" value="<?php echo $elec_dat_additional; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="elec_dat_tot" value="<?php echo $elec_dat_tot; ?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td>c</td>
											<td>Serial no of energy meter(s) connected </td>
											<td><input type="text" class="form form-control" name="ser_en[prior]" value="<?php echo $ser_en_prior; ?>"></td>
											<td><input type="text" class="form form-control" name="ser_en[additional]" value="<?php echo $ser_en_additional;  ?>"></td>
											<td><input type="text" class="form form-control" name="ser_en_tot" value="<?php echo $ser_en_tot; ?>"></td>
										</tr>
										<tr>
											<td rowspan="3">d</td>
											<td>Estimated amount of ASEB for power connection with MR no and date of payment </td>
											<td><input type="text" class="form form-control" name="est_amt[prior]" value="<?php echo $est_amt_prior; ?>" placeholder="Amount" ></td>
											<td><input type="text" class="form form-control" name="est_amt[additional]" value="<?php echo $est_amt_additional; ?>" placeholder="Amount"></td>
											<td><input type="text" class="form form-control" name="est_amt_tot" value="<?php echo $est_amt_tot; ?>" placeholder="Amount"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="form form-control" name="est_mr[prior]" value="<?php echo $est_mr_prior;?>" placeholder="Mr No"></td>
											<td><input type="text" class="form form-control" name="est_mr[additional]" value="<?php echo $est_mr_additional; ?>" placeholder="Mr No"></td>
											<td><input type="text" class="form form-control" name="est_mr_tot" value="<?php echo $est_mr_tot; ?>" placeholder="Mr No"></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="est_dat[prior]" value="<?php echo $est_dat_prior; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="est_dat[additional]" value="<?php echo $est_dat_additional;?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="est_dat_tot" value="<?php echo $est_dat_tot;?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td rowspan="5">e</td>
											<td colspan="3">First ASEB Bill </td>
										</tr>
										<tr>
											<td>i)  Bill no and date after substantial expansion </td>
											<td><input type="text" class="form form-control" name="sub_expan[prior]" value="<?php echo $sub_expan_prior; ?>" placeholder="Bill No." ></td>
											<td><input type="text" class="form form-control" name="sub_expan[additional]" value="<?php echo $sub_expan_additional; ?>" placeholder="Bill No."></td>
											<td><input type="text" class="form form-control" name="sub_expan_tot" value="<?php echo $sub_expan_tot; ?>" placeholder="Bill No."></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="sub_dat[prior]" value="<?php echo $sub_dat_prior;?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="sub_dat[additional]" value="<?php echo $sub_dat_additional;?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="sub_dat_tot" value="<?php echo $sub_dat_tot; ?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td>ii) MR no and date of payment after substantial expansion </td>
											<td><input type="text" class="form form-control" name="mr_subexpan[prior]" value="<?php echo $mr_subexpan_prior; ?>" placeholder="Mr No."></td>
											<td><input type="text" class="form form-control" name="mr_subexpan[additional]" value="<?php echo $mr_subexpan_additional;?>" placeholder="Mr No."></td>
											<td><input type="text" class="form form-control" name="mr_subexpan_tot" value="<?php echo $mr_subexpan_tot;?>" placeholder="Mr No."></td>
										</tr>
										<tr>
											<td width="25%"></td>
											<td><input type="text" class="dob form-control" name="mr_subexpan_dat[prior]" value="<?php echo $mr_subexpan_dat_prior; ?>" placeholder="Date" ></td>
											<td><input type="text" class="dob form-control" name="mr_subexpan_dat[additional]" value="<?php echo $mr_subexpan_dat_additional; ?>" placeholder="Date"></td>
											<td><input type="text" class="dob form-control" name="mr_subexpan_dat_tot" value="<?php echo $mr_subexpan_dat_tot; ?>" placeholder="Date"></td>
										</tr>
										<tr>
											<td>f. </td>
											<td>Total expenditure incurred for obtaining additional power connection ( excluding load security deposited to ASEB) </td>
											<td><input type="text" class="form-control text-uppercase" name="total_expenditure_prior" value="<?php echo $total_expenditure_prior; ?>" ></td>
											<td><input type="text" class="form-control text-uppercase" name="total_expenditure_additional" value="<?php echo $total_expenditure_additional; ?>" ></td>
											<td><input type="text" class="form-control" name="total_expenditure_tot" value="<?php echo $total_expenditure_tot; ?>" ></td>
										</tr> 
									</table>
									</td>
								</tr>
								<tr>										
									<td class="text-center" colspan="4">
										<a href="dic_form6.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</a>
										<button type="submit" class="btn btn-success" name="save6d" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
							</table>
							</form>
							</div>
							<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive">
								<tr>
									<td colspan="4">11. Date of commencement of commercial production / service rendered</td>
								</tr>
								<tr>
									<td width="25%">a) Prior to undertake substantial expansion</td>
									<td width="25%"><input type="text" class="dob form-control" name="bef_sub_expan" value="<?php echo $bef_sub_expan; ?>"></td>
									<td width="25%">b) After completion of substantial expansion</td>
									<td width="25%"><input type="text" class="dob form-control" name="after_sub_expan" value="<?php echo $after_sub_expan; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">12.(a) Details of the production/service rendered</td>
								</tr>
								<tr>
									<td colspan="4">i) Prior to substantial expansion</td>
								</tr>
								<tr>
								
									<td colspan="4">
									<table class="table-responsive">
										<td rowspan="2">Sl no.</td>
										<td rowspan="2">Items</td>
										<td colspan="2">Annual Installed Capacity</td>
										<td colspan="2">Actual performance during the last accounting year</td>
										<td rowspan="2">Percentage of utilization of installed capacity(5)&divide;(3)&nbsp;</td>
									</table>
									</td>
								</tr>
								<tr>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
								</tr>
								<tr>
									<td></td>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="items_12aprior_I2" value="<?php echo $items_12aprior_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="ann_12aprior_I3" value="<?php echo $ann_12aprior_I3;?>"></td>
									<td><input type="text" class="form form-control" name="ann_12aprior_I4" value="<?php echo $ann_12aprior_I4;?>"></td>
									<td><input type="text" class="form form-control" name="act_12aprior_I5" value="<?php echo $act_12aprior_I5;?>"></td>
									<td><input type="text" class="form form-control" name="act_12aprior_I6" value="<?php echo $act_12aprior_I6;?>"></td>
									<td><input type="text" class="form form-control" name="per_12aprior_I7" value="<?php echo $per_12aprior_I7;?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="items_12aprior_II2" value="<?php echo $items_12aprior_II2;?>"></td>
									<td><input type="text" class="form form-control" name="ann_12aprior_II3" value="<?php echo $ann_12aprior_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="ann_12aprior_II4" value="<?php echo $ann_12aprior_II4;?>"></td>
									<td><input type="text" class="form form-control" name="act_12aprior_II5" value="<?php echo $act_12aprior_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="act_12aprior_II6" value="<?php echo $act_12aprior_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="per_12aprior_II7" value="<?php echo $per_12aprior_II7;?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="7">ii)After substantial expansion</td>
								</tr>
								<tr>
									<td></td>
									<td>Sl no.</td>
									<td>Items</td>
									<td>Annual Installed Capacity</td>
									<td></td>
									<td>Actual performance during the last accounting year</td>
									<td></td>
									<td>Percentage of utilization of installed capacity(5)&divide;(3)</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="items_12aafter_I2" value="<?php echo $items_12aafter_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_I3" value="<?php echo $items_12aafter_I3;?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_I4" value="<?php echo $items_12aafter_I4; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_I5" value="<?php echo $items_12aafter_I5; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_I6" value="<?php echo $items_12aafter_I6; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_I7" value="<?php echo $items_12aafter_I7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="items_12aafter_II2" value="<?php echo $items_12aafter_II2; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_II3" value="<?php echo $items_12aafter_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_II4" value="<?php echo $items_12aafter_II4; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_II5" value="<?php echo $items_12aafter_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_II6" value="<?php echo $items_12aafter_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="items_12aafter_II7" value="<?php echo $items_12aafter_II7; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">Actual average production/service rendered during last three years preceding the date of completion of substantial expansion</td>
								</tr>
								<tr>
									<td>b)</td>
									<td colspan="2">Items</td>
									<td colspan="2">Physical quantity of finished product/service</td>
									<td colspan="2">Cost in rupees per unit of the finished product/service</td>
									<td>Total value in rupees of the finished product/service as per cost</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12b_first" value="<?php echo $items_12b_first; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12b_first" value="<?php echo $quan_12b_first; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12b_first" value="<?php  echo $cos_12b_first; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12b_first" value="<?php echo $total_12b_first; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12b_second" value="<?php echo $items_12b_second; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12b_second" value="<?php echo $quan_12b_second; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12b_second" value="<?php echo $cos_12b_second; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12b_second" value="<?php echo $total_12b_second; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12b_third" value="<?php echo $items_12b_third; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12b_third" value="<?php  echo $quan_12b_third; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12b_third" value="<?php  echo $cos_12b_third; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12b_third" value="<?php echo $total_12b_third; ?>"></td>
								</tr>
								<tr>
									<td>c)</td>
									<td colspan="7">Actual production/service rendered since date of completion of substantial expansion till date of submission of application</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">Items</td>
									<td colspan="2">Physical quantity of finished product/service</td>
									<td colspan="2">Cost in rupees per unit of the finished product/service</td>
									<td>Total value in rupees of the finished product/service as per cost</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12c_first" value="<?php echo $items_12c_first; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12c_first" value="<?php  echo $quan_12c_first; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12c_first" value="<?php  echo $cos_12c_first; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12c_first" value="<?php echo $total_12c_first; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12c_second" value="<?php echo $items_12c_second; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12c_second" value="<?php echo $quan_12c_second; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12c_second" value="<?php  echo $cos_12c_second; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12c_second" value="<?php echo $total_12c_second; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2"><input type="text" class="form form-control" name="items_12c_third" value="<?php echo $items_12c_third; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="quan_12c_third" value="<?php  echo $quan_12c_third; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="cos_12c_third" value="<?php  echo $cos_12c_third; ?>"></td>
									<td><input type="text" class="form form-control" name="total_12c_third" value="<?php echo $total_12c_third; ?>"></td>
								</tr>
								<tr>
									<td >d)</td>
									<td colspan="6">Total production/service rendered expressed in percentage viz: (total of Col 20)- (total of Col 16) divided by (total of col 20) and multiplied by 100.</td>
									<td><input type="text" class="form form-control" name="total_12d_prod" value="<?php echo $total_12d_prod; ?>"></td>
								</tr>
								<tr>
									<td>13</td>
									<td colspan="8">Raw Materials/ Consumables</td>
								</tr>
								<tr>
									<td rowspan="4"></td>
									<td>a)</td>
									<td colspan="7">Utilisation of Materials</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="7">i) Prior to substantial expansion</td>
								</tr>
								<tr>
									<td></td>
									<td>Sl. No.</td>
									<td>Items</td>
									<td colspan="2">Actual Requirements</td>
									<td colspan="2">Utilisation during the last accounting year</td>
									<td>Remarks</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="item_13aprior_I2" value="<?php echo $item_13aprior_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="actquant_13aprior_I3" value="<?php echo $actquant_13aprior_I3; ?>"></td>
									<td><input type="text" class="form form-control" name="actval_13aprior_I4" value="<?php echo $actval_13aprior_I4; ?>"></td>
									<td><input type="text" class="form form-control" name="utlquant_13aprior_I5" value="<?php echo $utlquant_13aprior_I5; ?>"></td>
									<td><input type="text" class="form form-control" name="utlval_13aprior_I6" value="<?php echo $utlval_13aprior_I6; ?>"></td>
									<td><input type="text" class="form form-control" name="rem_13aprior_I7" value="<?php echo $rem_13aprior_I7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="item_13aprior_II2" value="<?php echo $item_13aprior_II2; ?>"></td>
									<td><input type="text" class="form form-control" name="actquant_13aprior_II3" value="<?php echo $actquant_13aprior_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="actval_13aprior_II4" value="<?php echo $actval_13aprior_II4; ?>"></td>
									<td><input type="text" class="form form-control" name="utlquant_13aprior_II5" value="<?php echo $utlquant_13aprior_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="utlval_13aprior_II6" value="<?php echo $utlval_13aprior_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="rem_13aprior_II7" value="<?php echo $rem_13aprior_II7; ?>"></td>
								</tr>
								<tr>
									<td rowspan="11"></td>
									<td style="width: 28px; height: 23px;"></td>
									<td style="width: 586px; height: 23px;" colspan="7">ii) After substantial expansion</td>
								</tr>
								<tr>
									<td></td>
									<td>Sl. No.</td>
									<td>Items</td>
									<td colspan="2">Actual requirement</td>
									<td colspan="2">Utilisation since date of completion of substantial expansion till date of submission of application</td>
									<td>Remarks</td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>8</td>
									<td>9</td>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="item_13aafter_I2" value="<?php echo $item_13aafter_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="actquant_13aafter_I3" value="<?php echo $actquant_13aafter_I3; ?>"></td>
									<td><input type="text" class="form form-control" name="actval_13aafter_I4" value="<?php echo $actval_13aafter_I4; ?>"></td>
									<td><input type="text" class="form form-control" name="utlquant_13aafter_I5" value="<?php echo $utlquant_13aafter_I5; ?>"></td>
									<td><input type="text" class="form form-control" name="utlval_13aafter_I6" value="<?php echo $utlval_13aafter_I6; ?>"></td>
									<td><input type="text" class="form form-control" name="rem_13aafter_I7" value="<?php echo $rem_13aafter_I7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="item_13aafter_II2" value="<?php echo $item_13aafter_II2?>"></td>
									<td><input type="text" class="form form-control" name="actquant_13aafter_II3" value="<?php echo $actquant_13aafter_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="actval_13aafter_II4" value="<?php echo $actval_13aafter_II4; ?>"></td>
									<td><input type="text" class="form form-control" name="utlquant_13aafter_II5" value="<?php echo $utlquant_13aafter_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="utlval_13aafter_II6" value="<?php echo $utlval_13aafter_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="rem_13aafter_II7" value="<?php echo $rem_13aafter_II7; ?>"></td>
								</tr>
								<tr>
									<td>b)</td>
									<td colspan="7">Source(s) of materials</td>
								</tr>
								<tr>
									<td></td>
									<td>Sl. No.</td>
									<td>Item(s)</td>
									<td colspan="2">Whether the source of supply is within Assam/ outside Assam</td>
									<td colspan="3">Name and address of the supplier of principal raw materials/ consumables</td>
								</tr>
								<tr>
									<td></td>
									<td>1</td>
									<td>2</td>
									<td colspan="2">3</td>
									<td colspan="3">4</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="item_13b_I2" value="<?php echo $item_13b_I2; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="source_13b_I3" value="<?php  echo $source_13b_I3; ?>"></td>
									<td colspan="3"><textarea class="form form-control" name="name_13b_I4" value="<?php echo $name_13b_I4; ?>"></textarea></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="item_13b_II2" value="<?php echo $item_13b_II2; ?>"></td>
									<td colspan="2"><input type="text" class="form form-control" name="source_13b_II3" value="<?php  echo $source_13b_II3; ?>"></td>
									<td colspan="3"><textarea class="form form-control" name="name_13b_II4" value="<?php echo $name_13b_II4; ?>"></textarea></td>
								</tr>
							</tbody>
							</table>
						</form>
					</div>
					<div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
						<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive">
								<tbody>
									
								<tr>
									<td>14</td>
									<td colspan="8">Details of Sale of finished product(s)/ Service(s) rendered</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="7">a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Prior to Substantial Expansion</td>
								</tr>
								<tr>
									<td rowspan="10"></td>
									<td></td>
									<td rowspan="3">Sl No.</td>
									<td rowspan="3">Items</td>
									<td colspan="4">Product(s)/ Service(s) sold during the last accounting year</td>
									<td rowspan="2">Remarks</td>
								</tr>
								<tr>
									<td></td>
									<td colspan="2">Within the State of Assam</td>
									<td colspan="2">Outside the State of Assam</td>
								</tr>
								<tr>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
									<td>1</td>
									<td>2</td>
									<td>3</td>
									<td>4</td>
									<td>5</td>
									<td>6</td>
									<td>7</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="items_14a_I2" value="<?php echo $items_14a_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14a_I3" value="<?php echo $inassam_quant_14a_I3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14a_I4" value="<?php echo $inassam_value_14a_I4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14a_I5" value="<?php echo $outassam_quant_14a_I5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14a_I6" value="<?php echo $outassam_value_14a_I6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14a_I7" value="<?php echo $remarks_14a_I7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="items_14a_II2" value="<?php echo $items_14a_II2;?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14a_II3" value="<?php echo $inassam_quant_14a_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14a_II4" value="<?php echo $inassam_value_14a_II4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14a_II5" value="<?php echo $outassam_quant_14a_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14a_II6" value="<?php echo $outassam_value_14a_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14a_II7" value="<?php echo $remarks_14a_II7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>III</td>
									<td><input type="text" class="form form-control" name="items_14a_III2" value="<?php echo $items_14a_III2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14a_III3" value="<?php echo $inassam_quant_14a_III3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14a_III4" value="<?php echo $inassam_value_14a_III4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14a_III5" value="<?php echo $outassam_quant_14a_III5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14a_III6" value="<?php echo $outassam_value_14a_III6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14a_III7" value="<?php echo $remarks_14a_III7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>IV</td>
									<td><input type="text" class="form form-control" name="items_14a_IV2" value="<?php echo $items_14a_IV2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14a_IV3" value="<?php echo $inassam_quant_14a_IV3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14a_IV4" value="<?php echo $inassam_value_14a_IV4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14a_IV5" value="<?php echo $outassam_quant_14a_IV5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14a_IV6" value="<?php echo $outassam_value_14a_IV6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14a_IV7" value="<?php echo $remarks_14a_IV7; ?>"></td>
								</tr>
								<tr>
									<td>b)</td>
									<td colspan="7">Prior to Substantial Expansion</td>
								</tr>
								<tr>
									<td></td>
									<td rowspan="3">Sl. No.</td>
									<td rowspan="3">Items</td>
									<td colspan="4">Product(s)/ Service(s) sold since the date of completion of substantial expansion till date of submission of the application</td>
									<td rowspan="3">Remarks</td>
								</tr>
								<tr>
									<td rowspan="7"></td>
									<td></td>
									<td colspan="2">Within the State of Assam</td>
									<td colspan="2">Outside the State of Assam</td>
								</tr>
								<tr>
									<td></td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
									<td>Quantity</td>
									<td>Value (in Rupees)</td>
								</tr>
								<tr>
									<td></td>
									<td>8</td>
									<td>9</td>
									<td>10</td>
									<td>11</td>
									<td>12</td>
									<td>13</td>
									<td>14</td>
								</tr>
								<tr>
									<td></td>
									<td>I</td>
									<td><input type="text" class="form form-control" name="items_14b_I2" value="<?php echo $items_14b_I2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14b_I3" value="<?php echo $inassam_quant_14b_I3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14b_I4" value="<?php echo $inassam_value_14b_I4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14b_I5" value="<?php echo $outassam_quant_14b_I5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14b_I6" value="<?php echo $outassam_value_14b_I6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14b_I7" value="<?php echo $remarks_14b_I7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>II</td>
									<td><input type="text" class="form form-control" name="items_14b_II2" value="<?php echo $items_14b_II2;?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14b_II3" value="<?php echo $inassam_quant_14b_II3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14b_II4" value="<?php echo $inassam_value_14b_II4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14b_II5" value="<?php echo $outassam_quant_14b_II5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14b_II6" value="<?php echo $outassam_value_14b_II6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14b_II7" value="<?php echo $remarks_14b_II7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>III</td>
									<td><input type="text" class="form form-control" name="items_14b_III2" value="<?php echo $items_14b_III2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14b_III3" value="<?php echo $inassam_quant_14b_III3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14b_III4" value="<?php echo $inassam_value_14b_III4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14b_III5" value="<?php echo $outassam_quant_14b_III5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14b_III6" value="<?php echo $outassam_value_14b_III6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14b_III7" value="<?php echo $remarks_14b_III7; ?>"></td>
								</tr>
								<tr>
									<td></td>
									<td>IV</td>
									<td><input type="text" class="form form-control" name="items_14b_IV2" value="<?php echo $items_14b_IV2; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_quant_14b_IV3" value="<?php echo $inassam_quant_14b_IV3; ?>"></td>
									<td><input type="text" class="form form-control" name="inassam_value_14b_IV4" value="<?php echo $inassam_value_14b_IV4; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_quant_14b_IV5" value="<?php echo $outassam_quant_14b_IV5; ?>"></td>
									<td><input type="text" class="form form-control" name="outassam_value_14b_IV6" value="<?php echo $outassam_value_14b_IV6; ?>"></td>
									<td><input type="text" class="form form-control" name="remarks_14b_IV7" value="<?php echo $remarks_14b_IV7; ?>"></td>
								</tr>
									
									<tr>
										<td rowspan="13">15.</td>
										<td colspan="8">Employment Generation</td>
									</tr>
									<tr>
										<td>a</td>
										<td colspan="7">Regular Employment</td>
									</tr>
									<tr>
										<td></td>
										<td rowspan="2">Sl No.</td>
										<td rowspan="2">Category</td>
										<td colspan="2">No of employees prior to substantial expansion, who were</td>
										<td colspan="2">No of employees after substantial expansion</td>
										<td rowspan="2">Total</td>
									</tr>
									<tr>
										<td></td>
										<td>People of Assam</td>
										<td>People not belonging to Assam</td>
										<td>People of Assam</td>
										<td>People not belonging to Assam</td>
									</tr>
									<tr>
										<td></td>
										<td>1</td>
										<td>2</td>
										<td>3</td>
										<td>4</td>
										<td>5</td>
										<td>6</td>
										<td>7</td>
									</tr>
									<tr>
										<td></td>
										<td>1</td>
										<td>Managerial</td>
										<td><input type="text" class="form form-control" name="man_assam_prior" value="<?php echo $man_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="man_nonassam_prior" value="<?php echo $man_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="man_assam_after" value="<?php echo $man_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="man_nonassam_after" value="<?php echo $man_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="man_total" value="<?php echo $man_total; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>2</td>
										<td>Supervisory</td>
										<td><input type="text" class="form form-control" name="sup_assam_prior" value="<?php echo $sup_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="sup_nonassam_prior" value="<?php echo $sup_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="sup_assam_after" value="<?php echo $sup_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="sup_nonassam_after" value="<?php echo $sup_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="sup_total" value="<?php echo $sup_total; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>3</td>
										<td>Skilled</td>
										<td><input type="text" class="form form-control" name="skilled_assam_prior" value="<?php echo $skilled_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="skilled_nonassam_prior" value="<?php echo $skilled_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="skilled_assam_after" value="<?php echo $skilled_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="skilled_nonassam_after" value="<?php echo $skilled_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="skilled_total" value="<?php echo $skilled_total; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>4</td>
										<td>Semi-skilled</td>
										<td><input type="text" class="form form-control" name="semiskilled_assam_prior" value="<?php echo $semiskilled_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="semiskilled_nonassam_prior" value="<?php  echo $semiskilled_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="semiskilled_assam_after" value="<?php echo $semiskilled_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="semiskilled_nonassam_after" value="<?php echo $semiskilled_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="semiskilled_total" value="<?php echo $semiskilled_total; ?>"></td>
									</tr>
									<tr>
										<td></td>
										<td>5</td>
										<td>Unskilled and others</td>
										<td><input type="text" class="form form-control" name="unskilled_assam_prior" value="<?php echo $unskilled_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="unskilled_nonassam_prior" value="<?php  echo $unskilled_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="unskilled_assam_after" value="<?php  echo $unskilled_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="unskilled_nonassam_after" value="<?php  echo $unskilled_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="unskilled_total" value="<?php  echo $unskilled_total; ?>"></td>
									</tr>
									<tr style="height: 23px;">
										<td></td>
										<td colspan="2">Total</td>
										<td><input type="text" class="form form-control" name="total_assam_prior" value="<?php echo $total_assam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="total_nonassam_prior" value="<?php echo $total_nonassam_prior; ?>"></td>
										<td><input type="text" class="form form-control" name="total_assam_after" value="<?php echo $total_assam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="total_nonassam_after" value="<?php echo $total_nonassam_after; ?>"></td>
										<td><input type="text" class="form form-control" name="total_total" value="<?php echo $total_total; ?>"></td>
									</tr>
									<tr>
										<td>b</td>
										<td colspan="7">Casual employment</td>
									</tr>
									<tr>
										<td></td>
										<td colspan="6">i) Average mandays utilized per month :</td>
										<td><input type="text" class="form form-control" name="mandays_utilized" value="<?php echo $mandays_utilized; ?>"></td>
									</tr>
									<tr>
										<td rowspan="7">16.</td>
										<td colspan="8">Incentives applied for</td>
									</tr>
									<tr>
										<td>Sl No</td>
										<td colspan="4">Name of the incentive(s)</td>
										<td></td>
										<td></td>
										<td>Remarks</td>
									</tr>
									<tr>
										<td>1</td>
										<td colspan="4"><input type="text" class="form form-control" name="incentive_first" value="<?php echo $incentive_first; ?>"></td>
										<td colspan="3"><input type="text" class="form form-control" name="incent_remarks_first" value="<?php echo $incent_remarks_first; ?>"></td>
									</tr>
									<tr style="height: 23px;">
										<td>2</td>
										<td colspan="4"><input type="text" class="form form-control" name="incentive_second" value="<?php  echo $incentive_second ?>"></td>
										<td colspan="3"><input type="text" class="form form-control" name="incent_remarks_second" value="<?php  echo $incent_remarks_second; ?>"></td>
									</tr>
									<tr style="height: 23px;">
										<td>3</td>
										<td colspan="4"><input type="text" class="form form-control" name="incentive_third" value="<?php echo $incentive_third; ?>"></td>
										<td colspan="3"><input type="text" class="form form-control" name="incent_remarks_third" value="<?php echo $incent_remarks_third; ?>"></td>
									</tr>
									<tr style="height: 23px;">
										<td>4</td>
										<td colspan="4"><input type="text" class="form form-control" name="incentive_fourth" value="<?php echo $incentive_fourth; ?>"></td>
										<td colspan="3"><input type="text" class="form form-control" name="incent_remarks_fourth" value="<?php echo $incent_remarks_fourth; ?>"></td>
									</tr>
									<tr>
										<td>5</td>
										<td colspan="4"><input type="text" class="form form-control" name="incentive_fifth" value="<?php echo $incentive_fifth; ?>"></td>
										<td colspan="3"><input type="text" class="form form-control" name="incent_remarks_fifth" value="<?php echo $incent_remarks_fifth; ?>"></td>
									</tr>
									<tr>
										<td colspan="9"></td>
									</tr>
									<tr>
										<td colspan="9">Declaration,</td>
									</tr>
									<tr>
										<td colspan="9">&emsp;&emsp;&emsp;&emsp;&emsp;I/ We hereby solemnly declare that the information furnished in this application for grant of Eligibility Certificate claiming various incentives under Industrial Policy of Assam, 2008 are correct and true to the best of my/ our knowledge and belief.</td>
									</tr>
									<tr>
										<td colspan="9">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="5">Place:&nbsp; <strong> <?php echo strtoupper($dist); ?> </strong></td>
										<td colspan="2"></td>
										<td colspan="2">Signature: <strong><?php echo strtoupper($key_person); ?></strong></td>
									</tr>
									<tr >
										<td colspan="5">Date: &nbsp;<?php echo date('d-m-Y',strtotime($today)); ?> </td>
										<td colspan="2"></td>
										<td colspan="2">Status in relation to the unit with seal:</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="9">
											<button type="submit" class="btn btn-success" name="save6c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Submit</button>
										</td>									
									</tr>
								</tbody>
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
	<?php require '../../../user_area/includes/footer.php'; ?>
</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>