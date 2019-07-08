<?php  require_once "../../requires/login_session.php";
$dept="health";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
	
	
	   
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
    if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$website_name=$results["website_name"];
			$starting_date=$results["starting_date"];$location_type=$results["location_type"];$fees_description=$results["fees_description"];
			$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];
			$o_vill=$results["o_vill"];$o_block=$results["o_block"];
			$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];$o_email=$results["o_email"];$o_dist=$results["o_dist"];$o_landline_no=$results["o_landline_no"];
			
			if(!empty($results["ownership"])){
				$ownership=json_decode($results["ownership"]);
				if(isset($ownership->a)) $ownership_a=$ownership->a; else $ownership_a="";
				if(isset($ownership->b)) $ownership_b=$ownership->b; else $ownership_b="";
				if(isset($ownership->c)) $ownership_c=$ownership->c; else $ownership_c="";
				if(isset($ownership->d)) $ownership_d=$ownership->d; else $ownership_d="";
				if(isset($ownership->e)) $ownership_e=$ownership->e; else $ownership_e="";
				if(isset($ownership->f)) $ownership_f=$ownership->f; else $ownership_f="";
				if(isset($ownership->g)) $ownership_g=$ownership->g; else $ownership_g="";
			}else{
				$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
			}
			if(!empty($results["ownership2"])){
				$ownership2=json_decode($results["ownership2"]);
				if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
				if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
				if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
				if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
			}else{
				$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
				 
			}
			if(!empty($results["systems"])){
				$systems=json_decode($results["systems"]);
				if(isset($systems->a)) $systems_a=$systems->a; else $systems_a="";
				if(isset($systems->b)) $systems_b=$systems->b; else $systems_b="";
				if(isset($systems->c)) $systems_c=$systems->c; else $systems_c="";
				if(isset($systems->d)) $systems_d=$systems->d; else $systems_d="";
				if(isset($systems->e)) $systems_e=$systems->e; else $systems_e="";
				if(isset($systems->f)) $systems_f=$systems->f; else $systems_f="";
				if(isset($systems->g)) $systems_g=$systems->g; else $systems_g="";
				if(isset($systems->h)) $systems_h=$systems->h; else $systems_h="";
			}else{
				$systems_a="";$systems_b="";$systems_c="";$systems_d="";$systems_e="";$systems_f="";$systems_g="";$systems_h="";
			}
		
			//tab B//
			if(!empty($results["clinic"])){
				$clinic=json_decode($results["clinic"]);
				if(isset($clinic->a)) $clinic_a=$clinic->a; else $clinic_a="";
				if(isset($clinic->b)) $clinic_b=$clinic->b; else $clinic_b="";
				if(isset($clinic->c)) $clinic_c=$clinic->c; else $clinic_c="";
				if(isset($clinic->d)) $clinic_d=$clinic->d; else $clinic_d="";
			}else{
				$clinic_a="";$clinic_b="";$clinic_c="";$clinic_d="";$clinic_d="";
				 
			}
			if(!empty($results["facility"])){
				$facility=json_decode($results["facility"]);
				if(isset($facility->a)) $facility_a=$facility->a; else $facility_a="";
				if(isset($facility->b)) $facility_b=$facility->b; else $facility_b="";
				if(isset($facility->c)) $facility_c=$facility->c; else $facility_c="";
				if(isset($facility->d)) $facility_d=$facility->d; else $facility_d="";
			}else{
				$facility_a="";$facility_b="";$facility_c="";$facility_d="";
				 
			}
			if(!empty($results["hospital"])){
				$hospital=json_decode($results["hospital"]);
				if(isset($hospital->a)) $hospital_a=$hospital->a; else $hospital_a="";
				if(isset($hospital->b)) $hospital_b=$hospital->b; else $hospital_b="";
				if(isset($hospital->c)) $hospital_c=$hospital->c; else $hospital_c="";
				if(isset($hospital->d)) $hospital_d=$hospital->d; else $hospital_d="";
				if(isset($hospital->e)) $hospital_e=$hospital->e; else $hospital_e="";
			}else{
				$hospital_a="";$hospital_b="";$hospital_c="";$hospital_d="";$hospital_e="";
				 
			}
			if(!empty($results["dentalcl"])){
				$dentalcl=json_decode($results["dentalcl"]);
				if(isset($dentalcl->a)) $dentalcl_a=$dentalcl->a; else $dentalcl_a="";
				if(isset($dentalcl->b)) $dentalcl_b=$dentalcl->b; else $dentalcl_b="";
				
			}else{
				$dentalcl_a="";$dentalcl_b="";
			 }
			
			if(!empty($results["dental"])){
				$dental=json_decode($results["dental"]);
				if(isset($dental->a)) $dental_a=$dental->a; else $dental_a="";
				if(isset($dental->b)) $dental_b=$dental->b; else $dental_b="";
				if(isset($dental->c)) $dental_c=$dental->c; else $dental_c="";
				if(isset($dental->d)) $dental_d=$dental->d; else $dental_d="";
				if(isset($dental->e)) $dental_e=$dental->e; else $dental_e="";
				if(isset($dental->f)) $dental_f=$dental->f; else $dental_f="";
				if(isset($dental->g)) $dental_g=$dental->g; else $dental_g="";
				if(isset($dental->h)) $dental_h=$dental->h; else $dental_h="";
				if(isset($dental->i)) $dental_i=$dental->i; else $dental_i="";
				if(isset($dental->j)) $dental_j=$dental->j; else $dental_j="";
				if(isset($dental->k)) $dental_k=$dental->k; else $dental_k="";
			}else{
				$dental_a="";$dental_b="";$dental_c="";$dental_d="";$dental_e="";$dental_f="";$dental_g="";$dental_h="";$dental_i="";$dental_j="";$dental_k="";
			}
		 
			 if(!empty($results["medical"])){
				$medical=json_decode($results["medical"]);
				if(isset($medical->a)) $medical_a=$medical->a; else $medical_a="";
				if(isset($medical->b)) $medical_b=$medical->b; else $medical_b="";
				if(isset($medical->c)) $medical_c=$medical->c; else $medical_c="";
				if(isset($medical->d)) $medical_d=$medical->d; else $medical_d="";
				if(isset($medical->e)) $medical_e=$medical->e; else $medical_e="";
			}else{
				$medical_a="";$medical_b="";$medical_c="";$medical_d="";$medical_e="";
			}
			 if(!empty($results["imaging"])){
				$imaging=json_decode($results["imaging"]);
				if(isset($imaging->a)) $imaging_a=$imaging->a; else $imaging_a="";
				if(isset($imaging->b)) $imaging_b=$imaging->b; else $imaging_b="";
				
			}else{
				$imaging_a="";$imaging_b="";
			}
			if(!empty($results["imagingel"])){
				$imagingel=json_decode($results["imagingel"]);
				if(isset($imagingel->a)) $imagingel_a=$imagingel->a; else $imagingel_a="";
				if(isset($imagingel->b)) $imagingel_b=$imagingel->b; else $imagingel_b="";
				
			}else{
				$imagingel_a="";$imagingel_b="";
			}
			
			if(!empty($results["imagingul"])){
				$imagingul=json_decode($results["imagingul"]);
				if(isset($imagingul->a)) $imagingul_a=$imagingul->a; else $imagingul_a="";
				if(isset($imagingul->b)) $imagingul_b=$imagingul->b; else $imagingul_b="";
				
			}else{
				$imagingul_a="";$imagingul_b="";
			}
			
			//tab C//
			 if(!empty($results["miscellaneous"])){
				$miscellaneous=json_decode($results["miscellaneous"]);
				if(isset($miscellaneous->a)) $miscellaneous_a=$miscellaneous->a; else $miscellaneous_a="";
				if(isset($miscellaneous->b)) $miscellaneous_b=$miscellaneous->b; else $miscellaneous_b="";
				if(isset($miscellaneous->c)) $miscellaneous_c=$miscellaneous->c; else $miscellaneous_c="";
				if(isset($miscellaneous->d)) $miscellaneous_d=$miscellaneous->d; else $miscellaneous_d="";
				if(isset($miscellaneous->e)) $miscellaneous_e=$miscellaneous->e; else $miscellaneous_e="";
				if(isset($miscellaneous->f)) $miscellaneous_f=$miscellaneous->f; else $miscellaneous_f="";
			}else{
				$miscellaneous_a="";$miscellaneous_b="";$miscellaneous_c="";$miscellaneous_d="";$miscellaneous_e="";$miscellaneous_f="";
			}
			$is_clinical=$results["is_clinical"];
			$collction_center=$results["collction_center"];
			$is_authorization=$results["is_authorization"];
			$is_pollution=$results["is_pollution"];
			
			if(!empty($results["alliedh"])){
				$alliedh=json_decode($results["alliedh"]);
				if(isset($alliedh->a)) $alliedh_a=$alliedh->a; else $alliedh_a="";
				if(isset($alliedh->b)) $alliedh_b=$alliedh->b; else $alliedh_b="";
				if(isset($alliedh->c)) $alliedh_c=$alliedh->c; else $alliedh_c="";
				if(isset($alliedh->d)) $alliedh_d=$alliedh->d; else $alliedh_d="";
				if(isset($alliedh->e)) $alliedh_e=$alliedh->e; else $alliedh_e="";
				if(isset($alliedh->f)) $alliedh_f=$alliedh->f; else $alliedh_f="";
				if(isset($alliedh->g)) $alliedh_g=$alliedh->g; else $alliedh_g="";
				if(isset($alliedh->h)) $alliedh_h=$alliedh->h; else $alliedh_h="";
				if(isset($alliedh->i)) $alliedh_i=$alliedh->i; else $alliedh_i="";
				if(isset($alliedh->j)) $alliedh_j=$alliedh->j; else $alliedh_j="";
				if(isset($alliedh->k)) $alliedh_k=$alliedh->k; else $alliedh_k="";
				if(isset($alliedh->l)) $alliedh_l=$alliedh->l; else $alliedh_l="";
				if(isset($alliedh->m)) $alliedh_m=$alliedh->m; else $alliedh_m="";
				if(isset($alliedh->n)) $alliedh_n=$alliedh->n; else $alliedh_n="";
				if(isset($alliedh->o)) $alliedh_o=$alliedh->o; else $alliedh_o="";
				if(isset($alliedh->p)) $alliedh_p=$alliedh->p; else $alliedh_p="";
				if(isset($alliedh->q)) $alliedh_q=$alliedh->q; else $alliedh_q="";
				if(isset($alliedh->r)) $alliedh_r=$alliedh->r; else $alliedh_r="";
				if(isset($alliedh->s)) $alliedh_s=$alliedh->s; else $alliedh_s="";
				if(isset($alliedh->t)) $alliedh_t=$alliedh->t; else $alliedh_t="";
			}else{
				$alliedh_a="";$alliedh_b="";$alliedh_c="";$alliedh_d="";$alliedh_e="";$alliedh_f="";$alliedh_g="";$alliedh_h="";$alliedh_i="";$alliedh_j="";$alliedh_k="";$alliedh_l="";$alliedh_m="";$alliedh_n="";$alliedh_o="";$alliedh_p="";$alliedh_q="";$alliedh_r="";$alliedh_s="";$alliedh_t="";
			}
			if(!empty($results["ayush"])){
				$ayush=json_decode($results["ayush"]);
				if(isset($ayush->a)) $ayush_a=$ayush->a; else $ayush_a="";
				if(isset($ayush->b)) $ayush_b=$ayush->b; else $ayush_b="";
				if(isset($ayush->c)) $ayush_c=$ayush->c; else $ayush_c="";
				if(isset($ayush->d)) $ayush_d=$ayush->d; else $ayush_d="";
				if(isset($ayush->e)) $ayush_e=$ayush->e; else $ayush_e="";
			}else{
				$ayush_a="";$ayush_b="";$ayush_c="";$ayush_d="";$ayush_e="";
			}
			if(!empty($results["ayushyo"])){
				$ayushyo=json_decode($results["ayushyo"]);
				if(isset($ayushyo->a)) $ayushyo_a=$ayushyo->a; else $ayushyo_a="";
				if(isset($ayushyo->b)) $ayushyo_b=$ayushyo->b; else $ayushyo_b="";
			}else{
				$ayushyo_a="";$ayushyo_b="";
			}
			
			if(!empty($results["ayushun"])){
				$ayushun=json_decode($results["ayushun"]);
				if(isset($ayushun->a)) $ayushun_a=$ayushun->a; else $ayushun_a="";
				if(isset($ayushun->b)) $ayushun_b=$ayushun->b; else $ayushun_b="";
				if(isset($ayushun->c)) $ayushun_c=$ayushun->c; else $ayushun_c="";
				if(isset($ayushun->d)) $ayushun_d=$ayushun->d; else $ayushun_d="";
			}else{
				$ayushun_a="";$ayushun_b="";$ayushun_c="";$ayushun_d="";
			}
			if(!empty($results["ayushsi"])){
				$ayushsi=json_decode($results["ayushsi"]);
				if(isset($ayushsi->a)) $ayushsi_a=$ayushsi->a; else $ayushsi_a="";
				if(isset($ayushsi->b)) $ayushsi_b=$ayushsi->b; else $ayushsi_b="";
				if(isset($ayushsi->c)) $ayushsi_c=$ayushsi->c; else $ayushsi_c="";
			}else{
				 $ayushsi_a="";$ayushsi_b="";$ayushsi_c="";
			}
			if(!empty($results["ayushho"])){
				$ayushho=json_decode($results["ayushho"]);
				if(isset($ayushho->a)) $ayushho_a=$ayushho->a; else $ayushho_a="";
			}else{
				$ayushho_a="";
			}
			if(!empty($results["ayushna"])){
				$ayushna=json_decode($results["ayushna"]);
				if(isset($ayushna->a)) $ayushna_a=$ayushna->a; else $ayushna_a="";
				if(isset($ayushna->b)) $ayushna_b=$ayushna->b; else $ayushna_b="";
			}else{
			   $ayushna_a="";$ayushna_b="";
			}	
				
			//tab D//
			 if(!empty($results["service"])){
				$service=json_decode($results["service"]);
				if(isset($service->a)) $service_a=$service->a; else $service_a="";
				if(isset($service->b)) $service_b=$service->b; else $service_b="";
				if(isset($service->c)) $service_c=$service->c; else $service_c="";
				if(isset($service->d)) $service_d=$service->d; else $service_d="";
				if(isset($service->e)) $service_e=$service->e; else $service_e="";
			}else{
				$service_a="";$service_b="";$service_c="";$service_d="";$service_e="";
			}
		
			if(!empty($results["degree"])){
				$degree=json_decode($results["degree"]);
				if(isset($degree->a)) $degree_a=$degree->a; else $degree_a="";
				if(isset($degree->b)) $degree_b=$degree->b; else $degree_b="";
				if(isset($degree->c)) $degree_c=$degree->c; else $degree_c="";
				if(isset($degree->d)) $degree_d=$degree->d; else $degree_d="";
				if(isset($degree->e)) $degree_e=$degree->e; else $degree_e="";
				if(isset($degree->f)) $degree_f=$degree->f; else $degree_f="";
				if(isset($degree->g)) $degree_g=$degree->g; else $degree_g="";
				if(isset($degree->h)) $degree_h=$degree->h; else $degree_h="";
				if(isset($degree->i)) $degree_i=$degree->i; else $degree_i="";
				if(isset($degree->j)) $degree_j=$degree->j; else $degree_j="";
				if(isset($degree->k)) $degree_k=$degree->k; else $degree_k="";
				if(isset($degree->l)) $degree_l=$degree->l; else $degree_l="";
				if(isset($degree->m)) $degree_m=$degree->m; else $degree_m="";
				if(isset($degree->n)) $degree_n=$degree->n; else $degree_n="";
				if(isset($degree->o)) $degree_o=$degree->o; else $degree_o="";
				if(isset($degree->p)) $degree_p=$degree->p; else $degree_p="";
				if(isset($degree->q)) $degree_q=$degree->q; else $degree_q="";
				if(isset($degree->r)) $degree_r=$degree->r; else $degree_r="";
				
			}else{
				$degree_a="";$degree_b="";$degree_c="";$degree_d="";$degree_e="";$degree_f="";$degree_g="";$degree_h="";$degree_i="";$degree_j="";$degree_k="";$degree_l="";$degree_m="";$degree_n="";$degree_o="";$degree_p="";$degree_q="";$degree_r="";
			}
		
			if(!empty($results["surgical_special"])){
				$surgical_special=json_decode($results["surgical_special"]);
				if(isset($surgical_special->a)) $surgical_special_a=$surgical_special->a; else $surgical_special_a="";
				if(isset($surgical_special->b)) $surgical_special_b=$surgical_special->b; else $surgical_special_b="";
				if(isset($surgical_special->c)) $surgical_special_c=$surgical_special->c; else $surgical_special_c="";
				if(isset($surgical_special->d)) $surgical_special_d=$surgical_special->d; else $surgical_special_d="";
				if(isset($surgical_special->e)) $surgical_special_e=$surgical_special->e; else $surgical_special_e="";
			}else{
				$surgical_special_a="";$surgical_special_b="";$surgical_special_c="";$surgical_special_d="";$surgical_special_e="";
				 
			}
			
			
			if(!empty($results["specialties"])){
				$specialties=json_decode($results["specialties"]);
				if(isset($specialties->a)) $specialties_a=$specialties->a; else $specialties_a="";
				if(isset($specialties->b)) $specialties_b=$specialties->b; else $specialties_b="";
				if(isset($specialties->c)) $specialties_c=$specialties->c; else $specialties_c="";
				if(isset($specialties->d)) $specialties_d=$specialties->d; else $specialties_d="";
				if(isset($specialties->e)) $specialties_e=$specialties->e; else $specialties_e="";
				if(isset($specialties->f)) $specialties_f=$specialties->f; else $specialties_f="";
				if(isset($specialties->g)) $specialties_g=$specialties->g; else $specialties_g="";
				if(isset($specialties->h)) $specialties_h=$specialties->h; else $specialties_h="";
				if(isset($specialties->i)) $specialties_i=$specialties->i; else $specialties_i="";
				if(isset($specialties->j)) $specialties_j=$specialties->j; else $specialties_j="";
				if(isset($specialties->k)) $specialties_k=$specialties->k; else $specialties_k="";
			}else{
				$specialties_a="";$specialties_b="";$specialties_c="";$specialties_d="";$specialties_e="";$specialties_f="";$specialties_g="";$specialties_h="";$specialties_i="";$specialties_j="";$specialties_k="";
			 }
			 
			
			if(!empty($results["surgical"])){
				$surgical=json_decode($results["surgical"]);
				if(isset($surgical->a)) $surgical_a=$surgical->a; else $surgical_a="";
				if(isset($surgical->b)) $surgical_b=$surgical->b; else $surgical_b="";
				if(isset($surgical->c)) $surgical_c=$surgical->c; else $surgical_c="";
				if(isset($surgical->d)) $surgical_d=$surgical->d; else $surgical_d="";
				if(isset($surgical->e)) $surgical_e=$surgical->e; else $surgical_e="";
				if(isset($surgical->f)) $surgical_f=$surgical->f; else $surgical_f="";
				if(isset($surgical->g)) $surgical_g=$surgical->g; else $surgical_g="";
				if(isset($surgical->h)) $surgical_h=$surgical->h; else $surgical_h="";
				if(isset($surgical->i)) $surgical_i=$surgical->i; else $surgical_i="";
				if(isset($surgical->j)) $surgical_j=$surgical->j; else $surgical_j="";
				
			}else{
				$surgical_a="";$surgical_b="";$surgical_c="";$surgical_d="";$surgical_e="";$surgical_f="";$surgical_g="";$surgical_h="";$surgical_i="";$surgical_j="";
			}
			// tab E//
			$estarea=$results["estarea"];$cnstarea=$results["cnstarea"];$total_no=$results["total_no"];$total_no_bed=$results["total_no_bed"];$permanent_no=$results["permanent_no"];$temporary_no=$results["temporary_no"];	
	
			if(!empty($results["biomedical"])){
				$biomedical=json_decode($results["biomedical"]);
				if(isset($biomedical->a)) $biomedical_a=$biomedical->a; else $biomedical_a="";
				if(isset($biomedical->b)) $biomedical_b=$biomedical->b; else $biomedical_b="";
				if(isset($biomedical->any_other)) $biomedical_any_other=$biomedical->any_other; else $biomedical_any_other="";
			}else{
				$biomedical_a="";$biomedical_b="";$biomedical_any_other="";
			}
		}else{		
			$form_id="";		
			$website_name="";$starting_date="";
		    $owner_name="";$o_street_name1="";$o_street_name2="";$o_vill="";$o_block="";$o_pin="";$o_landline_no="";$o_mobile_no="";$o_email="";$o_dist="";$location_type="";$fees_description="";
			
			$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
			$systems_a="";$systems_b="";$systems_c="";$systems_d="";$systems_e="";$systems_f="";$systems_g="";$systems_h="";
			
			//TAB B//
			$clinic_a="";$clinic_b="";$clinic_c="";$clinic_d="";$clinic_d="";
			$facility_a="";$facility_b="";$facility_c="";$facility_d="";
			$hospital_a="";$hospital_b="";$hospital_c="";$hospital_d="";$hospital_e="";
			$dentalcl_a="";$dentalcl_b="";
			$dental_a="";$dental_b="";$dental_c="";$dental_d="";$dental_e="";$dental_f="";$dental_g="";$dental_h="";$dental_i="";
			$medical_a="";$medical_b="";$medical_c="";$medical_d="";$medical_e="";
			$imaging_a="";$imaging_b="";$imagingel_a="";$imagingel_b="";$imagingul_a="";$imagingul_a="";
			
			//TAB C//
			$miscellaneous_a="";$miscellaneous_b="";$miscellaneous_c="";$miscellaneous_d="";$miscellaneous_e="";$miscellaneous_f="";
			$is_clinical="";$collction_center="";
			$alliedh_a="";$alliedh_b="";$alliedh_c="";$alliedh_d="";$alliedh_e="";$alliedh_f="";$alliedh_g="";$alliedh_h="";$alliedh_i="";$alliedh_j="";$alliedh_k="";$alliedh_l="";$alliedh_m="";$alliedh_n="";$alliedh_o="";$alliedh_p="";$alliedh_q="";$alliedh_r="";$alliedh_s="";$alliedh_t="";
			$ayush_a="";$ayush_b=""; $ayushyo_a="";$ayushyo_b="";
			$ayushun_a="";$ayushun_b="";$ayushun_c="";$ayushun_d="";
			$ayushsi_a="";$ayushsi_b="";$ayushsi_c="";
			$ayushho_a="";
			$ayushna_a="";$ayushna_b="";
			
			//TAB D//
			$service_a="";$service_b="";$service_c="";$service_d="";$service_e="";
			$degree_a="";$degree_b="";$degree_c="";$degree_d="";$degree_e="";$degree_f="";$degree_g="";$degree_h="";$degree_i="";$degree_j="";$degree_k="";$degree_l="";$degree_m="";$degree_n="";$degree_o="";$degree_p="";$degree_q="";$degree_r="";
			$surgical_special_a="";$surgical_special_b="";$surgical_special_c="";$surgical_special_d="";$surgical_special_e="";
			$specialties_a="";$specialties_b="";$specialties_c="";$specialties_d="";$specialties_e="";$specialties_f="";$specialties_g="";$specialties_h="";$specialties_i="";$specialties_j="";$specialties_k="";
			$surgical_a="";$surgical_b="";$surgical_c="";$surgical_d="";$surgical_e="";$surgical_f="";$surgical_g="";$surgical_h="";$surgical_i="";$surgical_j="";
			$estarea="";$cnstarea="";$total_no="";$total_no_bed="";$estarea="";
			
			//TAB E//
			$biomedical_a="";$biomedical_b="";$biomedical_any_other="";
			$is_authorization="";$is_pollution="";
			$permanent_no="";$temporary_no="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$website_name=$results["website_name"];
		$starting_date=$results["starting_date"];
		$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];
		$o_vill=$results["o_vill"];$o_block=$results["o_block"];
		$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];$o_email=$results["o_email"];$o_dist=$results["o_dist"];$o_landline_no=$results["o_landline_no"];$location_type=$results["location_type"];$fees_description=$results["fees_description"];
		
		
		if(!empty($results["ownership"])){
			$ownership=json_decode($results["ownership"]);
			if(isset($ownership->a)) $ownership_a=$ownership->a; else $ownership_a="";
			if(isset($ownership->b)) $ownership_b=$ownership->b; else $ownership_b="";
			if(isset($ownership->c)) $ownership_c=$ownership->c; else $ownership_c="";
			if(isset($ownership->d)) $ownership_d=$ownership->d; else $ownership_d="";
			if(isset($ownership->e)) $ownership_e=$ownership->e; else $ownership_e="";
			if(isset($ownership->f)) $ownership_f=$ownership->f; else $ownership_f="";
			if(isset($ownership->g)) $ownership_g=$ownership->g; else $ownership_g="";
		}else{
			$ownership_a="";$ownership_b="";$ownership_c="";$ownership_d="";$ownership_e="";$ownership_f="";$ownership_g="";
		}
		if(!empty($results["ownership2"])){
			$ownership2=json_decode($results["ownership2"]);
			if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
			if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
			if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
			if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
		}else{
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
			 
		}
		if(!empty($results["systems"])){
			$systems=json_decode($results["systems"]);
			if(isset($systems->a)) $systems_a=$systems->a; else $systems_a="";
			if(isset($systems->b)) $systems_b=$systems->b; else $systems_b="";
			if(isset($systems->c)) $systems_c=$systems->c; else $systems_c="";
			if(isset($systems->d)) $systems_d=$systems->d; else $systems_d="";
			if(isset($systems->e)) $systems_e=$systems->e; else $systems_e="";
			if(isset($systems->f)) $systems_f=$systems->f; else $systems_f="";
			if(isset($systems->g)) $systems_g=$systems->g; else $systems_g="";
			if(isset($systems->h)) $systems_h=$systems->h; else $systems_h="";
		}else{
			$systems_a="";$systems_b="";$systems_c="";$systems_d="";$systems_e="";$systems_f="";$systems_g="";$systems_h="";
		}
		
		//tab B//
			
		if(!empty($results["clinic"])){
			$clinic=json_decode($results["clinic"]);
			if(isset($clinic->a)) $clinic_a=$clinic->a; else $clinic_a="";
			if(isset($clinic->b)) $clinic_b=$clinic->b; else $clinic_b="";
			if(isset($clinic->c)) $clinic_c=$clinic->c; else $clinic_c="";
			if(isset($clinic->d)) $clinic_d=$clinic->d; else $clinic_d="";
		}else{
			$clinic_a="";$clinic_b="";$clinic_c="";$clinic_d="";
			 
		}
		if(!empty($results["facility"])){
			$facility=json_decode($results["facility"]);
			if(isset($facility->a)) $facility_a=$facility->a; else $facility_a="";
			if(isset($facility->b)) $facility_b=$facility->b; else $facility_b="";
			if(isset($facility->c)) $facility_c=$facility->c; else $facility_c="";
			if(isset($facility->d)) $facility_d=$facility->d; else $facility_d="";
		}else{
			$facility_a="";$facility_b="";$facility_c="";$facility_d="";
			 
		}
		if(!empty($results["hospital"])){
			$hospital=json_decode($results["hospital"]);
			if(isset($hospital->a)) $hospital_a=$hospital->a; else $hospital_a="";
			if(isset($hospital->b)) $hospital_b=$hospital->b; else $hospital_b="";
			if(isset($hospital->c)) $hospital_c=$hospital->c; else $hospital_c="";
			if(isset($hospital->d)) $hospital_d=$hospital->d; else $hospital_d="";
			if(isset($hospital->e)) $hospital_e=$hospital->e; else $hospital_e="";
		}else{
			$hospital_a="";$hospital_b="";$hospital_c="";$hospital_d="";$hospital_e="";
			 
		}
		if(!empty($results["dentalcl"])){
			$dentalcl=json_decode($results["dentalcl"]);
			if(isset($dentalcl->a)) $dentalcl_a=$dentalcl->a; else $dentalcl_a="";
			if(isset($dentalcl->b)) $dentalcl_b=$dentalcl->b; else $dentalcl_b="";
			
		}else{
			$dentalcl_a="";$dentalcl_b="";
	     }
		
		if(!empty($results["dental"])){
			$dental=json_decode($results["dental"]);
			if(isset($dental->a)) $dental_a=$dental->a; else $dental_a="";
			if(isset($dental->b)) $dental_b=$dental->b; else $dental_b="";
			if(isset($dental->c)) $dental_c=$dental->c; else $dental_c="";
			if(isset($dental->d)) $dental_d=$dental->d; else $dental_d="";
			if(isset($dental->e)) $dental_e=$dental->e; else $dental_e="";
			if(isset($dental->f)) $dental_f=$dental->f; else $dental_f="";
			if(isset($dental->g)) $dental_g=$dental->g; else $dental_g="";
			if(isset($dental->h)) $dental_h=$dental->h; else $dental_h="";
			if(isset($dental->i)) $dental_i=$dental->i; else $dental_i="";
			if(isset($dental->j)) $dental_j=$dental->j; else $dental_j="";
			if(isset($dental->k)) $dental_k=$dental->k; else $dental_k="";
		}else{
			$dental_a="";$dental_b="";$dental_c="";$dental_d="";$dental_e="";$dental_f="";$dental_g="";$dental_h="";$dental_i="";$dental_j="";$dental_k="";
	     }
		 
		 if(!empty($results["medical"])){
			$medical=json_decode($results["medical"]);
			if(isset($medical->a)) $medical_a=$medical->a; else $medical_a="";
			if(isset($medical->b)) $medical_b=$medical->b; else $medical_b="";
			if(isset($medical->c)) $medical_c=$medical->c; else $medical_c="";
			if(isset($medical->d)) $medical_d=$medical->d; else $medical_d="";
			if(isset($medical->e)) $medical_e=$medical->e; else $medical_e="";
		}else{
			$medical_a="";$medical_b="";$medical_c="";$medical_d="";$medical_e="";
	    }
	     if(!empty($results["imaging"])){
			$imaging=json_decode($results["imaging"]);
			if(isset($imaging->a)) $imaging_a=$imaging->a; else $imaging_a="";
			if(isset($imaging->b)) $imaging_b=$imaging->b; else $imaging_b="";
			
		}else{
			$imaging_a="";$imaging_b="";
		}
		if(!empty($results["imagingel"])){
			$imagingel=json_decode($results["imagingel"]);
			if(isset($imagingel->a)) $imagingel_a=$imagingel->a; else $imagingel_a="";
			if(isset($imagingel->b)) $imagingel_b=$imagingel->b; else $imagingel_b="";
			
		}else{
			$imagingel_a="";$imagingel_b="";
		}
		
		if(!empty($results["imagingul"])){
			$imagingul=json_decode($results["imagingul"]);
			if(isset($imagingul->a)) $imagingul_a=$imagingul->a; else $imagingul_a="";
			if(isset($imagingul->b)) $imagingul_b=$imagingul->b; else $imagingul_b="";
			
		}else{
			$imagingul_a="";$imagingul_b="";
		}
		
		//tab C//
	     if(!empty($results["miscellaneous"])){
			$miscellaneous=json_decode($results["miscellaneous"]);
			if(isset($miscellaneous->a)) $miscellaneous_a=$miscellaneous->a; else $miscellaneous_a="";
			if(isset($miscellaneous->b)) $miscellaneous_b=$miscellaneous->b; else $miscellaneous_b="";
			if(isset($miscellaneous->c)) $miscellaneous_c=$miscellaneous->c; else $miscellaneous_c="";
			if(isset($miscellaneous->d)) $miscellaneous_d=$miscellaneous->d; else $miscellaneous_d="";
			if(isset($miscellaneous->e)) $miscellaneous_e=$miscellaneous->e; else $miscellaneous_e="";
			if(isset($miscellaneous->f)) $miscellaneous_f=$miscellaneous->f; else $miscellaneous_f="";
		}else{
			$miscellaneous_a="";$miscellaneous_b="";$miscellaneous_c="";$miscellaneous_d="";$miscellaneous_e="";$miscellaneous_f="";
		}
		$is_clinical=$results["is_clinical"];
		$collction_center=$results["collction_center"];
		$is_authorization=$results["is_authorization"];
		$is_pollution=$results["is_pollution"];
		
		if(!empty($results["alliedh"])){
			$alliedh=json_decode($results["alliedh"]);
			if(isset($alliedh->a)) $alliedh_a=$alliedh->a; else $alliedh_a="";
			if(isset($alliedh->b)) $alliedh_b=$alliedh->b; else $alliedh_b="";
			if(isset($alliedh->c)) $alliedh_c=$alliedh->c; else $alliedh_c="";
			if(isset($alliedh->d)) $alliedh_d=$alliedh->d; else $alliedh_d="";
			if(isset($alliedh->e)) $alliedh_e=$alliedh->e; else $alliedh_e="";
			if(isset($alliedh->f)) $alliedh_f=$alliedh->f; else $alliedh_f="";
			if(isset($alliedh->g)) $alliedh_g=$alliedh->g; else $alliedh_g="";
			if(isset($alliedh->h)) $alliedh_h=$alliedh->h; else $alliedh_h="";
			if(isset($alliedh->i)) $alliedh_i=$alliedh->i; else $alliedh_i="";
			if(isset($alliedh->j)) $alliedh_j=$alliedh->j; else $alliedh_j="";
			if(isset($alliedh->k)) $alliedh_k=$alliedh->k; else $alliedh_k="";
			if(isset($alliedh->l)) $alliedh_l=$alliedh->l; else $alliedh_l="";
			if(isset($alliedh->m)) $alliedh_m=$alliedh->m; else $alliedh_m="";
			if(isset($alliedh->n)) $alliedh_n=$alliedh->n; else $alliedh_n="";
			if(isset($alliedh->o)) $alliedh_o=$alliedh->o; else $alliedh_o="";
			if(isset($alliedh->p)) $alliedh_p=$alliedh->p; else $alliedh_p="";
			if(isset($alliedh->q)) $alliedh_q=$alliedh->q; else $alliedh_q="";
			if(isset($alliedh->r)) $alliedh_r=$alliedh->r; else $alliedh_r="";
			if(isset($alliedh->s)) $alliedh_s=$alliedh->s; else $alliedh_s="";
			if(isset($alliedh->t)) $alliedh_t=$alliedh->t; else $alliedh_t="";
		}else{
			$alliedh_a="";$alliedh_b="";$alliedh_c="";$alliedh_d="";$alliedh_e="";$alliedh_f="";$alliedh_g="";$alliedh_h="";$alliedh_i="";$alliedh_j="";$alliedh_k="";$alliedh_l="";$alliedh_m="";$alliedh_n="";$alliedh_o="";$alliedh_p="";$alliedh_q="";$alliedh_r="";$alliedh_s="";$alliedh_t="";
	    }
	    if(!empty($results["ayush"])){
			$ayush=json_decode($results["ayush"]);
			if(isset($ayush->a)) $ayush_a=$ayush->a; else $ayush_a="";
			if(isset($ayush->b)) $ayush_b=$ayush->b; else $ayush_b="";
			if(isset($ayush->c)) $ayush_c=$ayush->c; else $ayush_c="";
			if(isset($ayush->d)) $ayush_d=$ayush->d; else $ayush_d="";
			if(isset($ayush->e)) $ayush_e=$ayush->e; else $ayush_e="";
		}else{
			$ayush_a="";$ayush_b="";$ayush_c="";$ayush_d="";$ayush_e="";
		}
		if(!empty($results["ayushyo"])){
			$ayushyo=json_decode($results["ayushyo"]);
			if(isset($ayushyo->a)) $ayushyo_a=$ayushyo->a; else $ayushyo_a="";
			if(isset($ayushyo->b)) $ayushyo_b=$ayushyo->b; else $ayushyo_b="";
		}else{
			$ayushyo_a="";$ayushyo_b="";
		}
		
		if(!empty($results["ayushun"])){
			$ayushun=json_decode($results["ayushun"]);
			if(isset($ayushun->a)) $ayushun_a=$ayushun->a; else $ayushun_a="";
			if(isset($ayushun->b)) $ayushun_b=$ayushun->b; else $ayushun_b="";
			if(isset($ayushun->c)) $ayushun_c=$ayushun->c; else $ayushun_c="";
			if(isset($ayushun->d)) $ayushun_d=$ayushun->d; else $ayushun_d="";
		}else{
			$ayushun_a="";$ayushun_b="";$ayushun_c="";$ayushun_d="";
		}
		if(!empty($results["ayushsi"])){
			$ayushsi=json_decode($results["ayushsi"]);
			if(isset($ayushsi->a)) $ayushsi_a=$ayushsi->a; else $ayushsi_a="";
			if(isset($ayushsi->b)) $ayushsi_b=$ayushsi->b; else $ayushsi_b="";
			if(isset($ayushsi->c)) $ayushsi_c=$ayushsi->c; else $ayushsi_c="";
		}else{
		     $ayushsi_a="";$ayushsi_b="";$ayushsi_c="";
		}
		if(!empty($results["ayushho"])){
			$ayushho=json_decode($results["ayushho"]);
			if(isset($ayushho->a)) $ayushho_a=$ayushho->a; else $ayushho_a="";
		}else{
		    $ayushho_a="";
		}
		if(!empty($results["ayushna"])){
			$ayushna=json_decode($results["ayushna"]);
			if(isset($ayushna->a)) $ayushna_a=$ayushna->a; else $ayushna_a="";
			if(isset($ayushna->b)) $ayushna_b=$ayushna->b; else $ayushna_b="";
		}else{
		   $ayushna_a="";$ayushna_b="";
		}	
			
		//tab D//
		 if(!empty($results["service"])){
			$service=json_decode($results["service"]);
			if(isset($service->a)) $service_a=$service->a; else $service_a="";
			if(isset($service->b)) $service_b=$service->b; else $service_b="";
			if(isset($service->c)) $service_c=$service->c; else $service_c="";
			if(isset($service->d)) $service_d=$service->d; else $service_d="";
			if(isset($service->e)) $service_e=$service->e; else $service_e="";
		}else{
			$service_a="";$service_b="";$service_c="";$service_d="";$service_e="";
	    }
	
	    if(!empty($results["degree"])){
			$degree=json_decode($results["degree"]);
			if(isset($degree->a)) $degree_a=$degree->a; else $degree_a="";
			if(isset($degree->b)) $degree_b=$degree->b; else $degree_b="";
			if(isset($degree->c)) $degree_c=$degree->c; else $degree_c="";
			if(isset($degree->d)) $degree_d=$degree->d; else $degree_d="";
			if(isset($degree->e)) $degree_e=$degree->e; else $degree_e="";
			if(isset($degree->f)) $degree_f=$degree->f; else $degree_f="";
			if(isset($degree->g)) $degree_g=$degree->g; else $degree_g="";
			if(isset($degree->h)) $degree_h=$degree->h; else $degree_h="";
			if(isset($degree->i)) $degree_i=$degree->i; else $degree_i="";
			if(isset($degree->j)) $degree_j=$degree->j; else $degree_j="";
			if(isset($degree->k)) $degree_k=$degree->k; else $degree_k="";
			if(isset($degree->l)) $degree_l=$degree->l; else $degree_l="";
			if(isset($degree->m)) $degree_m=$degree->m; else $degree_m="";
			if(isset($degree->n)) $degree_n=$degree->n; else $degree_n="";
			if(isset($degree->o)) $degree_o=$degree->o; else $degree_o="";
			if(isset($degree->p)) $degree_p=$degree->p; else $degree_p="";
			if(isset($degree->q)) $degree_q=$degree->q; else $degree_q="";
			if(isset($degree->r)) $degree_r=$degree->r; else $degree_r="";			
		}else{
			$degree_a="";$degree_b="";$degree_c="";$degree_d="";$degree_e="";$degree_f="";$degree_g="";$degree_h="";$degree_i="";$degree_j="";$degree_k="";$degree_l="";$degree_m="";$degree_n="";$degree_o="";$degree_p="";$degree_q="";$degree_r="";
	    }
	
	    if(!empty($results["surgical_special"])){
			$surgical_special=json_decode($results["surgical_special"]);
			if(isset($surgical_special->a)) $surgical_special_a=$surgical_special->a; else $surgical_special_a="";
			if(isset($surgical_special->b)) $surgical_special_b=$surgical_special->b; else $surgical_special_b="";
			if(isset($surgical_special->c)) $surgical_special_c=$surgical_special->c; else $surgical_special_c="";
			if(isset($surgical_special->d)) $surgical_special_d=$surgical_special->d; else $surgical_special_d="";
			if(isset($surgical_special->e)) $surgical_special_e=$surgical_special->e; else $surgical_special_e="";
		}else{
			$surgical_special_a="";$surgical_special_b="";$surgical_special_c="";$surgical_special_d="";$surgical_special_e="";
			 
		}
		
		
		if(!empty($results["specialties"])){
			$specialties=json_decode($results["specialties"]);
			if(isset($specialties->a)) $specialties_a=$specialties->a; else $specialties_a="";
			if(isset($specialties->b)) $specialties_b=$specialties->b; else $specialties_b="";
			if(isset($specialties->c)) $specialties_c=$specialties->c; else $specialties_c="";
			if(isset($specialties->d)) $specialties_d=$specialties->d; else $specialties_d="";
			if(isset($specialties->e)) $specialties_e=$specialties->e; else $specialties_e="";
			if(isset($specialties->f)) $specialties_f=$specialties->f; else $specialties_f="";
			if(isset($specialties->g)) $specialties_g=$specialties->g; else $specialties_g="";
			if(isset($specialties->h)) $specialties_h=$specialties->h; else $specialties_h="";
			if(isset($specialties->i)) $specialties_i=$specialties->i; else $specialties_i="";
			if(isset($specialties->j)) $specialties_j=$specialties->j; else $specialties_j="";
			if(isset($specialties->k)) $specialties_k=$specialties->k; else $specialties_k="";
		}else{
			$specialties_a="";$specialties_b="";$specialties_c="";$specialties_d="";$specialties_e="";$specialties_f="";$specialties_g="";$specialties_h="";$specialties_i="";$specialties_j="";$specialties_k="";
	     }
		 
	    
		if(!empty($results["surgical"])){
			$surgical=json_decode($results["surgical"]);
			if(isset($surgical->a)) $surgical_a=$surgical->a; else $surgical_a="";
			if(isset($surgical->b)) $surgical_b=$surgical->b; else $surgical_b="";
			if(isset($surgical->c)) $surgical_c=$surgical->c; else $surgical_c="";
			if(isset($surgical->d)) $surgical_d=$surgical->d; else $surgical_d="";
			if(isset($surgical->e)) $surgical_e=$surgical->e; else $surgical_e="";
			if(isset($surgical->f)) $surgical_f=$surgical->f; else $surgical_f="";
			if(isset($surgical->g)) $surgical_g=$surgical->g; else $surgical_g="";
			if(isset($surgical->h)) $surgical_h=$surgical->h; else $surgical_h="";
			if(isset($surgical->i)) $surgical_i=$surgical->i; else $surgical_i="";
			if(isset($surgical->j)) $surgical_j=$surgical->j; else $surgical_j="";
			
		}else{
			$surgical_a="";$surgical_b="";$surgical_c="";$surgical_d="";$surgical_e="";$surgical_f="";$surgical_g="";$surgical_h="";$surgical_i="";$surgical_j="";
		}
		// tab E//
		$estarea=$results["estarea"];$cnstarea=$results["cnstarea"];$total_no=$results["total_no"];$total_no_bed=$results["total_no_bed"];$permanent_no=$results["permanent_no"];$temporary_no=$results["temporary_no"];	
		
		if(!empty($results["biomedical"])){
			$biomedical=json_decode($results["biomedical"]);
			if(isset($biomedical->a)) $biomedical_a=$biomedical->a; else $biomedical_a="";
			if(isset($biomedical->b)) $biomedical_b=$biomedical->b; else $biomedical_b="";
			if(isset($biomedical->any_other)) $biomedical_any_other=$biomedical->any_other; else $biomedical_any_other="";
		}else{
			$biomedical_a="";$biomedical_b="";$biomedical_any_other="";
		}
	}		
   
		
##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";
	}
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
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
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">I.ESTABLISHMENT DETAILS</td>
									</tr>
									<tr>
									    <td>1.Name of the establishment :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2.Address of the establishment:.</td>					
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
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
										<td>Website (if any) :</td>
										<td><input type="text" class="form-control text-uppercase" name="website_name" value="<?php echo $website_name;?>"></td>
									</tr>
									
									<tr>
										<td>3.Month and Year of starting :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="starting_date" value="<?php echo $starting_date;?>"></td>
									 </tr>
									 <tr>
									         <td>(From 4 to 11 mark all whichever are applicable)</td>
                                 </tr>
                                 <tr>
											<td>4. Location: </td>
											<td><select class="form-control text-uppercase" name="location_type" required="required">
											<option value="">Please Select</option>
											<option value="R" <?php if($location_type=="R") echo "selected";?>>Rural</option>
											<option value="M" <?php if($location_type=="M") echo "selected";?>>Metro</option>
											<option value="U" <?php if($location_type=="U") echo "selected";?>>Urban</option>
											<option value="N" <?php if($location_type=="N") echo "selected";?>>Notified / inaccessible areas (including Hilly / tribal areas)</option>
											</select></td>
											<td>Description</td>
											<td><select class="form-control text-uppercase" name="fees_description" required="required">
											<option value="">Please Select</option>
											
											<?php 
											$fees_query="select * from fees_details_urban";
											$fees_query_details=$formFunctions->executeQuery($dept,$fees_query);
										
											while($rows=$fees_query_details->fetch_object()){
												$s="";
												if( $fees_description==$rows->id ) $s="selected";
												echo '<option value="'. $rows->id .'" '.$s.'>'. $rows->fees_description .'</option>';
											}
											?>
											</select>
											</td>
										 </tr>
									       <tr>
										       <td>5. Ownership of Services : </td>
											 </tr>
											 <tr>
												<td><u>Government/Public Sector</u> </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_a=="C") echo "checked"; ?> name="ownership[a]" value="C">Central government&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_b=="S") echo "checked"; ?> name="ownership[b]" value="S">State government&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_c=="L") echo "checked"; ?> name="ownership[c]" value="L">Local government (Municipality, Zilla parishad, etc)  &nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_d=="PS") echo "checked"; ?> name="ownership[d]" value="PS">Public Sector Undertaking&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_e=="O") echo "checked"; ?> name="ownership[e]" value="O">Other ministries and departments (Railways, Police, etc.) &nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_f=="E") echo "checked"; ?> name="ownership[f]" value="E">Employee State Insurance Corporation&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership_g=="A") echo "checked"; ?> name="ownership[g]" value="A">Autonomous organization under Government&nbsp;&nbsp; </label>
												</td>
											</tr>	
									       <tr>
												<td><u>Non-Government / Private Sector</u> </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_a=="I") echo "checked"; ?> name="ownership2[a]" value="I">Individual Proprietorship&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_b=="P") echo "checked"; ?> name="ownership2[b]" value="P">Partnership&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_c=="R") echo "checked"; ?> name="ownership2[c]" value="R">Registered companies (registered under central/provincial/state Act) &nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ownership2_d=="S") echo "checked"; ?> name="ownership2[d]" value="S">Society/trust (Registered under central/provincial/state Act)&nbsp;&nbsp; </label>
											</td>
									</tr>
									<tr>
										<td>6. Name of the owner of Clinical Establishment:.</td>
                                   <td width="25%"><input type="text" class="form-control text-uppercase" name="owner_name" value="<?php echo $owner_name;?>"></td>										
									</tr>
									<tr>
									  <td colspan="4">  Address : </td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="letter"  name="o_street_name1"  value="<?php echo $o_street_name1; ?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="o_street_name2"  value="<?php echo $o_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town/city</td>
										<td><input type="text" class="form-control text-uppercase" name="o_vill" value="<?php echo $o_vill; ?>"></td>
										<td>Block</td>
										<td><input type="text" class="form-control text-uppercase" name="o_block" value="<?php echo $o_block; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" name="o_dist"  value="<?php echo $o_dist; ?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="o_pin" value="<?php echo $o_pin; ?>"></td>									
									</tr>
									<tr>
									    <td>Landline no</td>
										<td><input type="text" class="form-control text-uppercase"  name="o_landline_no" value="<?php echo $o_landline_no; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="o_mobile_no" value="<?php echo $o_mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="o_email" value="<?php echo $o_email; ?>"></td>
									</tr>
									
									<tr>
										<td colspan="4">7. Name, Designation and Qualification of person in-charge of the clinical establishment: <span class="mandatory_field">*</span></td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
										<thead>
											<tr>
											    <th width="10%" align="center">Sl no</th>
												<th width="10%" align="center">Name</th>
												<th width="10%" align="center">Designation</th>
												<th width="10%" align="center">Qualification</th>
												<th width="10%" align="center">Registration Number</th>
												<th width="15%" align="center">Name of Central/State Council(with which registered)</th>
												<th width="15%" align="center">Mobile</th>
												<th width="20%" align="center">E-mail ID</th>
											</tr>
										</thead>
											<?php
											$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
											$num=$part1->num_rows;
											if($num>0){
											$count=1;
											while($row_1=$part1->fetch_array()){	?>
											<tbody>
											<tr>
												<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $count; ?>" requried="requried" name="txtA<?php echo $count;?>" size="1"></td>
												<td><input value="<?php echo $row_1["name"]; ?>" class="form-control text-uppercase" validate="letter" title="No special characters are allowed except Dot" requried="requried" id="txtB<?php echo $count;?>" name="txtB<?php echo $count;?>"></td>
												<td><input value="<?php echo $row_1["designation"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" requried="requried"></td>				
												<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtD<?php echo $count;?>" required="required" class="form-control text-uppercase" name="txtD<?php echo $count;?>"></td>
												<td><input class="form-control text-uppercase" value="<?php echo $row_1["reg_no"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" ></td>
												<td><input value="<?php echo $row_1["name_of_central"]; ?>" id="txtF<?php echo $count;?>" requried="requried" class="form-control text-uppercase" name="txtF<?php echo $count;?>"></td>	
												<td><input value="<?php echo $row_1["mobile"]; ?>" id="txtG<?php echo $count;?>" requried="requried" validate="mobileNumber" maxlength="10"  class="form-control text-uppercase" name="txtG<?php echo $count;?>" ></td>													
												 <td><input value="<?php echo $row_1["email"]; ?>" id="txtH<?php echo $count;?>" requried="requried" class="form-control" name="txtH<?php echo $count;?>" ></td>	
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input value="1" readonly="readonly"  id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
												<td><input id="txtB1" required="required"   title="No special characters are allowed except Dot" validate="letter" class="form-control text-uppercase" name="txtB1"></td>
												<td><input  id="txtC1" required="required"  class="form-control text-uppercase" name="txtC1"></td>
												<td><input id="txtD1" required="required" class="form-control text-uppercase" name="txtD1"></td>
												<td><input id="txtE1"  required="required"   class="form-control text-uppercase" name="txtE1"></td>
												<td><input  id="txtF1" required="required" class="form-control text-uppercase" name="txtF1"></td>
												<td><input id="txtG1" required="required"  validate="mobileNumber" maxlength="10" class="form-control text-uppercase" name="txtG1"></td>
												<td><input id="txtH1"  required="required"  class="form-control" name="txtH1"></td>
											</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
											
											 <tr>
												<td>8. Systems of Medicine offered: (please tick whichever is applicable) </td>
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_a=="AL") echo "checked"; ?> name="systems[a]" value="AL">Allopathy&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_b=="AY") echo "checked"; ?> name="systems[b]" value="AY">Ayurveda&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_c=="UN") echo "checked"; ?> name="systems[c]" value="UN">Unani &nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_d=="S") echo "checked"; ?> name="systems[d]" value="S">Siddha&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_e=="HO") echo "checked"; ?> name="systems[e]" value="HO">Homoeopathy&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_f=="Y") echo "checked"; ?> name="systems[f]" value="Y">Yoga&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_g=="N") echo "checked"; ?> name="systems[g]" value="N">Naturopathy&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($systems_h=="SO") echo "checked"; ?> name="systems[h]" value="SO">Sowa-Rigpa&nbsp;&nbsp; </label>
												</td>
											</tr>		
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								
								</table>
							</form>
							</div>
                      <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
				        <form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				       <table id="" class="table table-responsive">	
				                  <tr>
												<td width="25%">9. Type of establishment :(please tick whichever is applicable)</td>
									</tr>
									<tr>       
									          <td width="25%" >(I) Clinic (Outpatient)</td>
										       <td colspan="4">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($clinic_a=="AL") echo "checked"; ?> name="clinic[a]" value="AL">Single practitioner (Consultation services only/with diagnostic services/with short stay facility)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($clinic_b=="G") echo "checked"; ?> name="clinic[b]" value="G">Poly clinic(Consultation services only/with diagnostic services/with short stay facility)</label></br>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($clinic_c=="L") echo "checked"; ?> name="clinic[c]" value="L">Dispensary&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($clinic_d=="PS") echo "checked"; ?> name="clinic[d]" value="PS">Health Checkup Centre&nbsp;&nbsp; </label></br>
												</td>
									</tr>
                                <tr>
												<td>(II). Day Care facility </td>
								
												<td colspan="4">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($facility_a=="M") echo "checked"; ?> name="facility[a]" value="M">Medical&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($facility_b=="S") echo "checked"; ?> name="facility[b]" value="S">Surgical&nbsp;&nbsp; </label></br>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($facility_c=="ME") echo "checked"; ?> name="facility[c]" value="ME">Medical SPA</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($facility_d=="W") echo "checked"; ?> name="facility[d]" value="W">Wellness centers(where qualified medical professionals are available to supervise the services). </label>
												</td>
									</tr>
                                <tr>
												<td>(III). Hospitals including Nursing Home (outpatient and inpatient): </td>
								
												<td colspan="4">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($hospital_a=="H1") echo "checked"; ?> name="hospital[a]" value="H1">Hospital Level 1 a&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($hospital_b=="H2") echo "checked"; ?> name="hospital[b]" value="H2">Hospital Level 1 b&nbsp;&nbsp; </label></br>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($hospital_c=="H3") echo "checked"; ?> name="hospital[c]" value="H3">Hospital Level 2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($hospital_d=="H4") echo "checked"; ?> name="hospital[d]" value="H4">Hospital Level 3 (Non teaching)&nbsp;&nbsp; </label></br>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($hospital_e=="H5") echo "checked"; ?> name="hospital[e]" value="H5">Hospital Level 4 (Teaching)&nbsp; </label>
												</td>
									</tr>
                                <tr>       
									          <td width="25%" >(IV). Dental Clinics and Dental Hospital:</td>
											  
									</tr>
									<tr>      
									          <td>a. Dental clinics </td>
										       <td colspan="2">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($dentalcl_a=="SP") echo "checked"; ?> name="dentalcl[a]" value="SP">Single practitioner (Consultation services only/with diagnostic services/with short stay facility)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dentalcl_b=="PO") echo "checked"; ?> name="dentalcl[b]" value="PO">Poly clinic(Consultation services only/with diagnostic services/with short stay facility)</label>
											</td>
									</tr>
                                <tr>      
									          <td>b. Dental Hospitals (specialties as listed in the IDC Act.) </td>
										       <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($dental_a=="O1") echo "checked"; ?> name="dental[a]" value="O1">i. Oral and maxillofacial surgery</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dental_b=="O2") echo "checked"; ?> name="dental[b]" value="O2">ii. Oral medicine and radiology</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($dental_c=="O3") echo "checked"; ?> name="dental[c]" value="O3">iii. Orthodontics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dental_d=="O4") echo "checked"; ?> name="dental[d]" value="O4">iv. Conservative dentistry and Endodontics</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($dental_e=="O5") echo "checked"; ?> name="dental[e]" value="O5">v. Periodontics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dental_f=="O6") echo "checked"; ?> name="dental[f]" value="O6">vi. Pedodontics and preventive dentistry</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($dental_g=="O7") echo "checked"; ?> name="dental[g]" value="O7">vii. Oral pathology and Microbiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dental_h=="O8") echo "checked"; ?> name="dental[h]" value="O8">viii. Prosthodontics and crown bridge</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($dental_i=="O9") echo "checked"; ?> name="dental[i]" value="O9">ix. Public health dentistry</label>
									</tr>
                                 <tr>       
									          <td width="25%" >(V).Diagnostic Centre:</td>
											  
									</tr> 									
                                 <tr>      
									          <td>A. Medical Diagnostic Laboratories:</td>
										       <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($medical_a=="PA") echo "checked"; ?> name="medical[a]" value="PA">Pathology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($medical_b=="BI") echo "checked"; ?> name="medical[b]" value="BI">Biochemistry</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($medical_c=="MI") echo "checked"; ?> name="medical[c]" value="MI">Microbiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($medical_d=="MO") echo "checked"; ?> name="medical[d]" value="MO">Molecular Biology and Genetic Labs</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($medical_e=="VI") echo "checked"; ?> name="medical[e]" value="VI">Virology</label>
									</tr>
                                <tr>B. Diagnostic Imaging centers:</tr>									
									<tr>      
									          <td>i. Radiology :</td>
										       <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_a=="G") echo "checked"; ?> name="imaging[a]" value="G">General radiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($imaging_b=="IR") echo "checked"; ?> name="imaging[b]" value="IR">Interventional radiology</label>
									</tr>	
                                <tr>      
									          <td>ii. Electromagnetic imaging:</td>
										       <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($imagingel_a=="MA") echo "checked"; ?> name="imagingel[a]" value="MA">Magnetic Resonance Imaging (MRI)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($imagingel_b=="PE") echo "checked"; ?> name="imagingel[b]" value="PE">Positron Emission Tomography (PET) Scan</label>
									</tr>
                                <tr>      
									          <td>iii. Ultrasound:</td>
										       <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($imagingul_a=="AL") echo "checked"; ?> name="imagingul[a]" value="AL">Allopathic</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($imagingul_b=="AY") echo "checked"; ?> name="imagingul[b]" value="AY">Ayurveda</label>
									</tr>
									<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
									</tr>
									</table>
									</form>
									</div>							   
									
                                <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										
										<table class="table table-responsive table-bordered">
						
									    <tr>
                                          <td >C. Miscellaneous </td>	
										       <td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_a=="EL") echo "checked"; ?> name="miscellaneous[a]" value="EL">Electro Cardio Graphy(ECG)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_b=="TR") echo "checked"; ?> name="miscellaneous[b]" value="TR">Tread Mill Test</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_c=="E") echo "checked"; ?> name="miscellaneous[c]" value="E">Electro Encephalo Graphy(EEG)Mammography</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_d=="EC") echo "checked"; ?> name="miscellaneous[d]" value="EC">Echocardiography</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_e=="EM") echo "checked"; ?> name="miscellaneous[e]" value="EM">Electro MyoGraphy (EMG)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($miscellaneous_f=="ES") echo "checked"; ?> name="miscellaneous[f]" value="ES">Electrophysiological studies</label>
												</td>
									</tr>
									 <tr>     
												<td>Collection centers For the clinical labs and diagnostic centres shall function under registered clinical establishment.<span class="mandatory_field">*</span></td>
										        <td><label class="radio-inline"><input type="radio" name="is_clinical" class="is_clinical" value="Y"  <?php if(isset($is_clinical) && $is_clinical=='Y') echo 'checked'; ?> /> Yes</label>
									           <label class="radio-inline"><input type="radio" class="is_clinical"  value="N"  name="is_clinical" <?php if(isset($is_clinical) && ($is_clinical=='N' || $is_clinical=='')) echo 'checked'; ?>/> No</label></td>
												<td width="25%"><textarea name="collction_center" class="form-control text-uppercase" id="collction_center" validate="textarea" ><?php echo $collction_center; ?></textarea></td>
												<td></td>
											</tr>
                                       <tr>
                                          <td >(VI). Allied Health professions: </td>
                                          <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_a=="AU") echo "checked"; ?> name="alliedh[a]" value="AU">Audiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_b=="B") echo "checked"; ?> name="alliedh[b]" value="B">Behavioral health (counseling, marriage and family therapy etc)</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_c=="E") echo "checked"; ?> name="alliedh[c]" value="E">Exercise physiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_d=="N") echo "checked"; ?> name="alliedh[d]" value="N">Nuclear medicine technology</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_e=="M") echo "checked"; ?> name="alliedh[e]" value="M">Medical Laboratory Scientist</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_f=="D") echo "checked"; ?> name="alliedh[f]" value="D">Dietetics</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_g=="OC") echo "checked"; ?> name="alliedh[g]" value="OC">Occupational therapy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_h=="OPT") echo "checked"; ?> name="alliedh[h]" value="OPT">Optometry</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_i=="OR") echo "checked"; ?> name="alliedh[i]" value="OR">Orthoptics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_j=="OP") echo "checked"; ?> name="alliedh[j]" value="OP">Orthotics and prosthetics</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_k=="OS") echo "checked"; ?> name="alliedh[k]" value="OS">Osteopathy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_l=="P") echo "checked"; ?> name="alliedh[l]" value="P">Paramedic</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_m=="PD") echo "checked"; ?> name="alliedh[m]" value="PD">Podiatry</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_n=="HE") echo "checked"; ?> name="alliedh[n]" value="HE">Health Psychology/ Clinical Psychology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_o=="PH") echo "checked"; ?> name="alliedh[o]" value="PH">Physiotherapy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_p=="RT") echo "checked"; ?> name="alliedh[p]" value="RT">Radiation therapy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_q=="RA") echo "checked"; ?> name="alliedh[q]" value="RA">Radiography / Medical imaging</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_r=="RES") echo "checked"; ?> name="alliedh[r]" value="RES">Respiratory Therapy</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_s=="SO") echo "checked"; ?> name="alliedh[s]" value="SO">Sonography</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($alliedh_t=="SPE") echo "checked"; ?> name="alliedh[t]" value="SPE">Speech pathology</label>
											</td>
									</tr>
									
									<tr>
                                          <td colspan="4"><b>(VII) AYUSH </b></td>
                                </tr>
                                <tr>	
                                         <td >Ayurveda</td>								 
                                          <td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayush_a=="AU") echo "checked"; ?> name="ayush[a]" value="AU">Ausadh Chikitsa</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayush_b=="SC") echo "checked"; ?> name="ayush[b]" value="SC">Shalya Chikitsa</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayush_c=="SH") echo "checked"; ?> name="ayush[c]" value="SH">Shodhan Chikitsa</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayush_d=="R") echo "checked"; ?> name="ayush[d]" value="R">Rasayana</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayush_e=="P") echo "checked"; ?> name="ayush[e]" value="P">Pathya Vyavastha</label>
											</td>
									</tr>
                                <tr>	
                                         <td >Yoga</td>	
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushyo_a=="AS") echo "checked"; ?> name="ayushyo[a]" value="AS">Ashtang</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayushyo_b=="Y") echo "checked"; ?> name="ayushyo[b]" value="Y">Yoga</label>
									</tr>
									<tr>	
                                         <td >Unani</td>	
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushun_a=="M") echo "checked"; ?> name="ayushun[a]" value="M">Matab</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayushun_b=="J") echo "checked"; ?> name="ayushun[b]" value="J">Jarahat</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushun_c=="IT") echo "checked"; ?> name="ayushun[c]" value="IT">Ilaj-bit-Tadbeer</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayushun_d=="HS") echo "checked"; ?> name="ayushun[d]" value="HS">Hifzan-e-Sehat</label>
											 
									</tr>
                                <tr>	
                                         <td>Siddha</td>	
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushsi_a=="MA") echo "checked"; ?> name="ayushsi[a]" value="MA">Maruthuvam</label>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($ayushsi_b=="SM") echo "checked"; ?> name="ayushsi[b]" value="SM">Sirappu Maruthuvam</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushsi_c=="VT") echo "checked"; ?> name="ayushsi[c]" value="VT">Varmam Thokknam & Yoga</label>
									</tr>
                                <tr>	
                                         <td >Homoeopathy</td>	
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushho_a=="G") echo "checked"; ?> name="ayushho[a]" value="G">General Homoeopathy</label>
									</tr>
									<tr>	
                                         <td >Naturopathy</td>	
												<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushna_a=="ET") echo "checked"; ?> name="ayushna[a]" value="ET">External Therapies with natural modalities</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($ayushna_b=="IN") echo "checked"; ?> name="ayushna[b]" value="IN">Internal Therapies</label>
								</tr>	
                             <tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form?>c" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
								</tr>
								</table>
								</form>
								</div>								
			              <div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
							<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive table-bordered">
								<tr>
									<td colspan="3"><b>II.TYPES OF SERVICE</b></td>
							    </tr>
								<tr>	
                                         <td><b>TYPE</b></td>	
                           						 
                                          <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($service_a=="G") echo "checked"; ?> name="service[a]" value="G">General Practice Services</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($service_b=="SS") echo "checked"; ?> name="service[b]" value="SS">Single Specialty Services</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($service_c=="MS") echo "checked"; ?> name="service[c]" value="MS">Multi Specialty Services (including Palliative care Centre, Trauma Centre, Maternity Home - applicable for hospitals only)</label></br>
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($service_d=="RS") echo "checked"; ?> name="service[d]" value="RS">Rasayana</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($service_e=="SP") echo "checked"; ?> name="service[e]" value="SP">Super Specialty Services</label>
											</td>
									</tr>
									<tr>
									        <td><b>SPECIALITY SPECIFIC</b></td>
							       </tr>
								    <tr>	
                                         <td>Medical Specialties – for which candidates must possess recognized PG degree(MD/Diploma/DNB or its equivalent degree)</td>
                                          <td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_a=="AN") echo "checked"; ?> name="degree[a]" value="AN">Anesthesiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_b=="AV") echo "checked"; ?> name="degree[b]" value="AV">Aviation Medicine</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_c=="CM") echo "checked"; ?> name="degree[c]" value="CM">Community Medicine</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_d=="DE") echo "checked"; ?> name="degree[d]" value="DE">Dermatology, Venerology and Leprosy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_e=="FM") echo "checked"; ?> name="degree[e]" value="FM">Family Medicine</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_f=="GM") echo "checked"; ?> name="degree[f]" value="GM">General Medicine</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_g=="GE") echo "checked"; ?> name="degree[g]" value="GE">Geriatrics</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_h=="IM") echo "checked"; ?> name="degree[h]" value="IM">ImmunoHaematology and Blood Transfusion</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_i=="NM") echo "checked"; ?> name="degree[i]" value="NM">Nuclear Medicine</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_j=="PA") echo "checked"; ?> name="degree[j]" value="PA">Paediatrics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_k=="PM") echo "checked"; ?> name="degree[k]" value="PM">Physical Medicine Rehabilitation</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_l=="PS") echo "checked"; ?> name="degree[l]" value="PS">Psychiatry</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_m=="RD") echo "checked"; ?> name="degree[m]" value="RD">Radio-diagnosis</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_n=="RT") echo "checked"; ?> name="degree[n]" value="RT">Radio-therapy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_o=="RH") echo "checked"; ?> name="degree[o]" value="RH">Rheumatology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_p=="SM") echo "checked"; ?> name="degree[p]" value="SM">Sports Medicine</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_q=="TM") echo "checked"; ?> name="degree[q]" value="TM">Tropical Medicine</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($degree_r=="TU") echo "checked"; ?> name="degree[r]" value="TU">Tuberculosis & Respiratory Medicine or Pulmonary Medicine</label>
											</td>
									</tr>
									<tr>	
                                         <td><b>Surgical specialties</b> - for which candidates must possess, recognized PG degree(MS/Diploma/DNB or its equivalent degree)</td>	
                           						 
                                          <td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_special_a=="OT") echo "checked"; ?> name="surgical_special[a]" value="OT">Otorhinolaryngology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_special_b=="GU") echo "checked"; ?> name="surgical_special[b]" value="GU">General Surgery</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_special_c=="CP") echo "checked"; ?> name="surgical_special[c]" value="CP">Ophthalmology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_special_d=="OR") echo "checked"; ?> name="surgical_special[d]" value="OR">Orthopedics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_special_e=="OB") echo "checked"; ?> name="surgical_special[e]" value="OB">Obstetrics & Gynecology</label>
											</td>
									</tr>
									<tr>	
                                         <td><b>Medical Super specialties</b></td>	
                           						 
                                          <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_a=="C") echo "checked"; ?> name="specialties[a]" value="C">Cardiology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_b=="CL") echo "checked"; ?> name="specialties[b]" value="CL">Clinical Hematology including Stem Cell Therapy</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_c=="CLI") echo "checked"; ?> name="specialties[c]" value="CLI">Clinical Pharmacology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_d=="E") echo "checked"; ?> name="specialties[d]" value="E">Endocrinology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_e=="IM") echo "checked"; ?> name="specialties[e]" value="IM">Immunology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_f=="M") echo "checked"; ?> name="specialties[f]" value="M">Medical Gastroenterology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_g=="MG") echo "checked"; ?> name="specialties[g]" value="MG">Medical Genetics</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_h=="MO") echo "checked"; ?> name="specialties[h]" value="MO">Medical Oncology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_i=="NE") echo "checked"; ?> name="specialties[i]" value="NE">Neonatology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_j=="NEU") echo "checked"; ?> name="specialties[j]" value="NEU">Neurology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specialties_k=="NR") echo "checked"; ?> name="specialties[k]" value="NR">Neuro-radiology</label>
											</td>
									</tr>
									
									<tr>	
                                         <td><b>Surgical Super-specialities</b></td>	
                           						 
                                          <td colspan="3">
												&nbsp;&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_a=="CA") echo "checked"; ?> name="surgical[a]" value="CA">Cardiovascular thoracic Surgery)</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_b=="UR") echo "checked"; ?> name="surgical[b]" value="UR">Urology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_c=="NS") echo "checked"; ?> name="surgical[c]" value="NS">Neuro-Surgery</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_d=="PA") echo "checked"; ?> name="surgical[d]" value="PA">Paediatrics Surgery.</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_e=="P") echo "checked"; ?> name="surgical[e]" value="P">Plastic & Reconstructive Surgery</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_f=="SG") echo "checked"; ?> name="surgical[f]" value="SG">Surgical Gastroenterology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_g=="SU") echo "checked"; ?> name="surgical[g]" value="SU">Surgical Oncology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_h=="E") echo "checked"; ?> name="surgical[h]" value="E">Endocrine Surgery</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_i=="G") echo "checked"; ?> name="surgical[i]" value="G">Gynecological Oncology</label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($surgical_j=="VS") echo "checked"; ?> name="surgical[j]" value="VS">Vascular Surgery</label>
											</td>
									</tr>
									<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>d" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
									</tr>
									</table>
									</form>
									</div>
									<div id="table5" class="tab-pane <?php echo $tabbtn5; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
									<table class="table table-responsive table-bordered">
									<tr>
									    <td colspan="4"><b>III INFRASTRUCTURE DETAILS</b></td>
									</tr>
									<tr>
									    <td colspan="4">10. Area of the establishment (in sqft):</td>
									</tr>
									<tr>
										<td>a) Total Area :</td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="estarea" value="<?php echo $estarea;?>"></td>
										<td>b) Constructed area :</td>
										<td><input type="text" class="form-control text-uppercase" validate="decimal" name="cnstarea" value="<?php echo $cnstarea;?>"></td>
									</tr>
									<tr>
										<td>11. Out Patient Department:</td>
									</tr>
									<tr>
										<td>11.1 Total no. of OPD Clinics:</td>
										<td><input type="text" class="form-control text-uppercase"  name="total_no" value="<?php echo $total_no;?>"></td>
									</tr>
									<tr>
									<td colspan="4">11.2 Specialty-wise distribution of OPD Clinic
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="30%">S.No.</th>
													<th width="70%">Specialty</th>
													
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
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["special"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
								</tr>
								<tr>
									   <td>12. In Patient Department:</td>
								</tr>
								<tr>   
								      <td>12.1. Total number of beds:</td>
									  <td><input type="text" class="form-control text-uppercase"  name="total_no_bed" value="<?php echo $total_no_bed;?>"></td>
								</tr>
									
									<tr>
									<td colspan="4">12.2. Specialty-wise distribution of beds, please specify:
										<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="24%">S.No.</th>
													<th width="38%">Specialty</th>
													<th width="38%">Beds</th>
												</tr>
												</thead>
												<?php
													$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
													$num3 =$part3->num_rows;
													if($num3>0){
													  $count=1;
													  while($row_3=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly id="taA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["slno"]; ?>" name="taA<?php echo $count;?>" size="1"></td>
															<td><input id="taB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["specialty"]; ?>" name="taB<?php echo $count;?>" size="10"></td>
															<td><input id="taC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["bed"]; ?>"  name="taC<?php echo $count;?>" size="10"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="taA1" readonly="readonly" size="10" class="form-control text-uppercase" name="taA1"></td>
														<td><input id="taB1" size="10" class="form-control text-uppercase" name="taB1"></td>
														<td><input id="taC1" size="10"  class="form-control text-uppercase" name="taC1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
										</td>
								</tr>
								<tr>
								      <td><b>13. Biomedical waste Management</b></td>    
                             </tr>
                             <tr>							 
                                    <td><b>13.1 Method of treatment and /or disposal of Bio-medical waste</b></td>	
										<td colspan="3">
										<label class="checkbox-inline"><input type="checkbox" <?php if($biomedical_a=="AS") echo "checked"; ?> name="biomedical[a]" value="AS">Ashtang</label></br>
										<label class="checkbox-inline"><input type="checkbox" <?php if($biomedical_b=="YO") echo "checked"; ?> name="biomedical[b]" value="YO">Yoga</label>
								</tr>
								<tr>
										<td></td>
										<td>Any other (please specify):</td>
										<td><input type="text" class="form-control text-uppercase" name="biomedical[any_other]" value="<?php echo $biomedical_any_other;?>"></td>
										<td></td>
								</tr>
					           <tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=4" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>e" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
								</tr>
								</table>
								</form>
								</div>
			
			           <div id="table6" class="tab-pane <?php echo $tabbtn6; ?>" role="tabpanel">
							<form name="myform1" class="myform1 submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive table-bordered">
									
									<tr>	
                                           <td colspan="2">13.2.Whether authorization from Pollution Control Board/Pollution Control Committee obtained?<span class="mandatory_field">*</span></td>
									           <td>
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_authorization=="Y") echo "checked"; ?> id="inlineRadio1" name="is_authorization"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_authorization=="N") echo "checked"; ?> id="inlineRadio1" name="is_authorization"> No </label>
												</td>
												<td>
													<label class="radio-inline"><input type="radio" value="AP" <?php if($is_pollution=="AP") echo "checked"; ?> id="inlineRadio1" name="is_pollution">Applied For </label>
													<label class="radio-inline"><input type="radio" value="NA" <?php if($is_pollution=="NA") echo "checked"; ?> id="inlineRadio1" name="is_pollution"> Not Applicable </label>
												</td>
											
									</tr>
									
									<tr>
									    <td><b>IV HUMAN RESOURCES</b></td>
									</tr>
									<tr>
										<td width="25%">No. of permanent staff :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="permanent_no" value="<?php echo $permanent_no;?>"></td>
										<td width="25%">No. of temporary staff :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="temporary_no" value="<?php echo $temporary_no;?>"></td>
									</tr>
									<tr>
												<td colspan="4">
													Please furnish the following details:-
												</td>
											</tr>
											<tr>
											<td colspan="4">
												<table name="objectTable4" class="table table-responsive table-bordered" id="objectTable4">
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Name</th>
														<th>Category of staff<span class="mandatory_field"> *</span></th>
														<th>Qualification</th>
														<th>Registration</th>	
														<th>Nature of service Temporary/Permanent</th>	
													</tr>
													</thead>
													<?php
													$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
													$num4 = $part4->num_rows;
													if($num4>0){
													$count=1;
													while($row_4=$part4->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="tbA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_4["slno"]; ?>" name="tbA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_4["name"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="tbB<?php echo $count;?>" class="form-control text-uppercase"; name="tbB<?php echo $count;?>"></td>
														<td>
														<select id="tbC<?php echo $count;?>" name="tbC<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Category of staff</option>
															<option <?php if($row_4["select_category"]=="D") echo "selected"; ?> value='D' >Doctors</option>
															<option <?php if($row_4["select_category"]=="N") echo "selected"; ?> value='N' >Nursing staff</option>
															<option <?php if($row_4["select_category"]=="P") echo "selected"; ?> value='P' >Para-medical staff</option>
															<option <?php if($row_4["select_category"]=="PH") echo "selected"; ?> value='PH' >Pharmacists</option>
															<option <?php if($row_4["select_category"]=="A") echo "selected"; ?> value='A' >Administrative staff</option>
															<option <?php if($row_4["select_category"]=="O") echo "selected"; ?> value='O' >Others</option>
														</select>
														</td>				
														<td><input value="<?php echo $row_4["qualification"]; ?>" id="tbD<?php echo $count;?>" class="form-control text-uppercase"; name="tbD<?php echo $count;?>" placeholder="Qualification"></td>
														<td><input value="<?php echo $row_4["registration"]; ?>" id="tbE<?php echo $count;?>" class="form-control text-uppercase"; name="tbE<?php echo $count;?>" placeholder="Registration"></td>
														<td><input value="<?php echo $row_4["nature"]; ?>" id="tbF<?php echo $count;?>" class="form-control text-uppercase"; name="tbF<?php echo $count;?>" placeholder="Nature of service Temporary/Permanent"></td>
														
													</tr>	
													<?php $count++; 
													} 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="tbA1" size="1" class="form-control text-uppercase"; name="tbA1"></td>
														<td><input id="tbB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase" name="tbB1"></td>					
														<td><select id="tbC1" name="tbC1" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option value='D' >Doctors</option>
															<option value='N' >Nursing staff</option>
															<option value='P' >Para-medical staff</option>
															<option value='PH' >Pharmacists</option>
															<option value='A' >Administrative staff</option>
															<option value='O' >Others</option>
														</select></td>
														<td><input id="tbD1" class="form-control text-uppercase" name="tbD1" ></td>
														<td><input id="tbE1" class="form-control text-uppercase" name="tbE1" ></td>
														<td><input id="tbF1" class="form-control text-uppercase" name="tbF1" ></td>
														
													</tr>
													<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
											</td>
											</tr>
											
							    <tr>
									<td colspan="4">Support Staff
										<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">S.No.</th>
													<th width="30%">Category</th>
													<th width="30%">Beds</th>
													<th width="30%">Remark</th>
													
												</tr>
												</thead>
												<?php
													$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
													$num5= $part5->num_rows;
													if($num5>0){
													  $count=1;
													  while($row_5=$part5->fetch_array()){	?>
														<tr>
															<td><input readonly id="tfA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["slno"]; ?>" name="tfA<?php echo $count;?>" size="1"></td>
															<td><input id="tfB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["cate_gory"]; ?>"  name="tfB<?php echo $count;?>" size="10"></td>
															<td><input id="tfC<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $row_5["total_no"]; ?>" name="tfC<?php echo $count;?>" size="10"></td>
															<td><input id="tfD<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["remark"]; ?>" name="tfD<?php echo $count;?>" size="10"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="tfA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tfA1"></td>
														<td><input id="tfB1" size="10" class="form-control text-uppercase" name="tfB1"></td>
														<td><input id="tfC1"  size="10" validate="onlyNumbers" class="form-control text-uppercase" name="tfC1"></td>
														<td><input id="tfD1" size="10" validate="letters" class="form-control text-uppercase" name="tfD1"></td>
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
										</td>
								</tr>
								<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=5" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>f" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
								</tr>
								</table>
								</form>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	$('#collction_center').attr('readonly','readonly');
	<?php if($is_clinical == 'Y') echo "$('#collction_center').removeAttr('readonly','readonly');"; ?>
	$('.is_clinical').on('change', function(){
		if($(this).val() == 'Y'){
			$('#collction_center').removeAttr('readonly','readonly');
		}else{
			$('#collction_center').attr('readonly','readonly');
			$('#collction_center').val('');
		}			
	});
	
</script>
