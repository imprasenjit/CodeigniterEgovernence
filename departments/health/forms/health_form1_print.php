<?php 
$dept="health";
$form="1";
$table_name=getTableName($dept,$form);
	
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");		
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}
	
	
	
    if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$website_name=$results["website_name"];
		$owner_name=$results["owner_name"];$o_street_name1=$results["o_street_name1"];$o_street_name2=$results["o_street_name2"];
		$o_vill=$results["o_vill"];$o_block=$results["o_block"];
		$o_pin=$results["o_pin"];$o_mobile_no=$results["o_mobile_no"];  $o_email=$results["o_email"];$o_dist=$results["o_dist"];
		$estarea=$results["estarea"];$cnstarea=$results["cnstarea"];$total_no=$results["total_no"];$total_no_bed=$results["total_no_bed"];$permanent_no=$results["permanent_no"];$temporary_no=$results["temporary_no"];
		$location_type=$results["location_type"];$fees_description=$results["fees_description"];
		
		if($location_type=="R"){
			$location_type="Rural";
		}else if($location_type=="M"){
			$location_type="Metro";
		}else if($location_type=="U"){
			$location_type="Urban";
		}else if($location_type=="N"){
			$location_type="Notified / inaccessible areas (including Hilly / tribal areas)";
		}else{
			$location_type="";
		}
		
		
		if($fees_description=="1"){
			$fees_description="Our Patient Care/single doctor Clinic";
		}else if($fees_description=="2"){
			$fees_description="In patient care 1 to 30 beds";
		}else if($fees_description=="3"){
			$fees_description="30 to 100 beds";
		}else if($fees_description=="4"){
			$fees_description="Above 100 beds";
		}else if($fees_description=="5"){
			$fees_description="Testing & Diagnostic Centre";
		}else if($fees_description=="6"){
			$fees_description="Diagnostic with Inaging Centre";
		}else{
			$fees_description="";
		}
		
		
		
		
		//location CHECKMARKS///
		
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
		
		//OWNERSHIP CHECKMARKS///
		$ownership_values="";		
		if($ownership_a=="C") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Central government &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_b=="S") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> State government &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_c=="L") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Local government (Municipality, Zilla parishad, etc) &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_d=="PS") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Public Sector Undertaking &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_e=="O") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Other ministries and departments (Railways, Police, etc.)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_f=="E") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Employee State Insurance Corporation &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership_g=="A") $ownership_values=$ownership_values. '<span class="tickmark">&#10004;</span> Autonomous organization under Government &nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ownership2"])){
			$ownership2=json_decode($results["ownership2"]);
			if(isset($ownership2->a)) $ownership2_a=$ownership2->a; else $ownership2_a="";
			if(isset($ownership2->b)) $ownership2_b=$ownership2->b; else $ownership2_b="";
			if(isset($ownership2->c)) $ownership2_c=$ownership2->c; else $ownership2_c="";
			if(isset($ownership2->d)) $ownership2_d=$ownership2->d; else $ownership2_d="";
		}else{
			$ownership2_a="";$ownership2_b="";$ownership2_c="";$ownership2_d="";
		}
		
      //OWNERSHIP2//
		$ownership2_values="";
		if($ownership2_a=="I") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Individual Proprietorship&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_b=="P") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Partnership&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_c=="R") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Registered companies (registered under central/provincial/state Act) &nbsp;&nbsp;&nbsp;&nbsp;';
		if($ownership2_d=="S") $ownership2_values=$ownership2_values. '<span class="tickmark">&#10004;</span> Society/trust (Registered under central/provincial/state Act)&nbsp;&nbsp;&nbsp;&nbsp;';
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
		
		//SYSTEM//
		$systems_values="";
		if($systems_a=="AL") $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Allopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_b=="AY") $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Ayurveda &nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_c=="UN") $systems_values=$systems_values. '<span class="tickmark">&#10004;</span>Unani&nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_d=="S")  $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Siddha &nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_e=="HO") $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Homoeopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_f=="Y")  $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Yoga&nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_g=="N")  $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Naturopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($systems_h=="SO") $systems_values=$systems_values. '<span class="tickmark">&#10004;</span> Sowa-Rigpa&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($results["clinic"])){
			$clinic=json_decode($results["clinic"]);
			if(isset($clinic->a)) $clinic_a=$clinic->a; else $clinic_a="";
			if(isset($clinic->b)) $clinic_b=$clinic->b; else $clinic_b="";
			if(isset($clinic->c)) $clinic_c=$clinic->c; else $clinic_c="";
			if(isset($clinic->d)) $clinic_d=$clinic->d; else $clinic_d="";
			if(isset($clinic->any_other)) $clinic_any_other=$clinic->any_other; else $clinic_any_other="";
		}else{
			$clinic_a="";$clinic_b="";$clinic_c="";$clinic_d="";$clinic_any_other="";
		}
	
	///CLINIC///
		$clinic_values="";
		if($clinic_a=="AL") $clinic_values=$clinic_values. '<span class="tickmark">&#10004;</span> Single practitioner (Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinic_b=="G") $clinic_values=$clinic_values. '<span class="tickmark">&#10004;</span> Poly clinic(Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinic_c=="L") $clinic_values=$clinic_values. '<span class="tickmark">&#10004;</span>Dispensary &nbsp;&nbsp;&nbsp;&nbsp;';
		if($clinic_d=="PS") $clinic_values=$clinic_values. '<span class="tickmark">&#10004;</span> Health Checkup Centre&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($clinic_any_other)) $clinic_values=$clinic_values. "<br/><br/>Any Other : ". $clinic_any_other;
		if(!empty($results["facility"])){
			$facility=json_decode($results["facility"]);
			if(isset($facility->a)) $facility_a=$facility->a; else $facility_a="";
			if(isset($facility->b)) $facility_b=$facility->b; else $facility_b="";
			if(isset($facility->c)) $facility_c=$facility->c; else $facility_c="";
			if(isset($facility->d)) $facility_d=$facility->d; else $facility_d="";
			if(isset($facility->any_other)) $facility_any_other=$facility->any_other; else $facility_any_other="";
		}else{
			$facility_a="";$facility_b="";$facility_c="";$facility_d="";$facility_any_other="";
		}
		
		//FACILITY//
		$facility_values="";
		if($facility_a=="M") $facility_values=$facility_values. '<span class="tickmark">&#10004;</span> Medical&nbsp;&nbsp;&nbsp;&nbsp;';
		if($facility_b=="S") $facility_values=$facility_values. '<span class="tickmark">&#10004;</span> Surgical &nbsp;&nbsp;&nbsp;&nbsp;';
		if($facility_c=="ME") $facility_values=$facility_values. '<span class="tickmark">&#10004;</span> Medical SPA&nbsp;&nbsp;&nbsp;&nbsp;';
		if($facility_d=="W") $facility_values=$facility_values. '<span class="tickmark">&#10004;</span> Wellness centers(where qualified medical professionals are available to supervise the services) &nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($facility_any_other)) $facility_values=$facility_values. "<br/><br/>Any Other : ". $facility_any_other;
		if(!empty($results["hospital"])){
			$hospital=json_decode($results["hospital"]);
			if(isset($hospital->a)) $hospital_a=$hospital->a; else $hospital_a="";
			if(isset($hospital->b)) $hospital_b=$hospital->b; else $hospital_b="";
			if(isset($hospital->c)) $hospital_c=$hospital->c; else $hospital_c="";
			if(isset($hospital->d)) $hospital_d=$hospital->d; else $hospital_d="";
			if(isset($hospital->e)) $hospital_e=$hospital->e; else $hospital_e=""; 
		}else{
			$hospital_a="";$hospital_b="";$hospital_c="";$hospital_d="";$hospital_e="";$hospital_any_other="";
		}

		//HOSPITAL//
		$hospital_values="";
		if($hospital_a=="H1") $hospital_values=$hospital_values. '<span class="tickmark">&#10004;</span> Hospital Level 1 a&nbsp;&nbsp;&nbsp;&nbsp;';
		if($hospital_b=="H2") $hospital_values=$hospital_values. '<span class="tickmark">&#10004;</span> Hospital Level 1 b &nbsp;&nbsp;&nbsp;&nbsp;';
		if($hospital_c=="H3") $hospital_values=$hospital_values. '<span class="tickmark">&#10004;</span> Hospital Level 2&nbsp;&nbsp;&nbsp;&nbsp;';
		if($hospital_d=="H4") $hospital_values=$hospital_values. '<span class="tickmark">&#10004;</span> Hospital Level 3 (Non teaching)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($hospital_e=="H5") $hospital_values=$hospital_values. '<span class="tickmark">&#10004;</span> Hospital Level 4 (Teaching)&nbsp;&nbsp;&nbsp;&nbsp;';
	    if(!empty($results["dentalcl"])){
			$dentalcl=json_decode($results["dentalcl"]);
			if(isset($dentalcl->a)) $dentalcl_a=$dentalcl->a; else $dentalcl_a="";
			if(isset($dentalcl->b)) $dentalcl_b=$dentalcl->b; else $dentalcl_b="";
			
		}else{
			$dentalcl_a="";$dentalcl_b="";
	     }
	   $dentalcl_values="";
		if($dentalcl_a=="SP") $dentalcl_values=$dentalcl_values. '<span class="tickmark">&#10004;</span> Single practitioner (Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dentalcl_b=="PO") $dentalcl_values=$dentalcl_values. '<span class="tickmark">&#10004;</span> Poly clinic(Consultation services only/with diagnostic services/with short stay facility)&nbsp;&nbsp;&nbsp;&nbsp;';
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
		}else {
			$dental_a="";$dental_b="";$dental_c="";$dental_d="";$dental_e="";$dental_f="";$dental_g="";$dental_h="";$dental_i="";$dental_j="";$dental_k="";
		}
		//DENTAL//
		$dental_values="";
		if($dental_a=="O1") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> i. Oral and maxillofacial surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_b=="O2") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> ii. Oral medicine and radiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_c=="O3") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span>iii. Orthodontics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_d=="O4") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> iv. Conservative dentistry and Endodontics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_e=="O5") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> v.Periodontics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_f=="O6") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> vi. Pedodontics and preventive dentistry&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_g=="O7") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> vii. Oral pathology and Microbiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_h=="O8") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> viii. Prosthodontics and crown bridge&nbsp;&nbsp;&nbsp;&nbsp;';
		if($dental_i=="O9") $dental_values=$dental_values. '<span class="tickmark">&#10004;</span> ix. Public health dentistry&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($results["medical"])){
			$medical=json_decode($results["medical"]);
			if(isset($medical->a)) $medical_a=$medical->a; else $medical_a="";
			if(isset($medical->b)) $medical_b=$medical->b; else $medical_b="";
			if(isset($medical->c)) $medical_c=$medical->c; else $medical_c="";
			if(isset($medical->d)) $medical_d=$medical->d; else $medical_d="";
			if(isset($medical->e)) $medical_e=$medical->e; else $medical_e="";
		}else {
			$medical_a="";$medical_b="";$medical_c="";$medical_d="";$medical_e="";
		}	
			
		//MEDICAL//
		$medical_values="";
		if($medical_a=="PA") $medical_values=$medical_values. '<span class="tickmark">&#10004;</span>Pathology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($medical_b=="BI") $medical_values=$medical_values. '<span class="tickmark">&#10004;</span> Biochemistry&nbsp;&nbsp;&nbsp;&nbsp;';
		if($medical_c=="MI") $medical_values=$medical_values. '<span class="tickmark">&#10004;</span> Microbiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($medical_d=="MO") $medical_values=$medical_values. '<span class="tickmark">&#10004;</span>Molecular Biology and Genetic Labs&nbsp;&nbsp;&nbsp;&nbsp;';
		if($medical_e=="VI") $medical_values=$medical_values. '<span class="tickmark">&#10004;</span> v. Virology&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($medical_any_other)) $medical_values=$medical_values. "<br/><br/>Any Other : ". $dental_any_other;
		if(!empty($results["imaging"])){
			$imaging=json_decode($results["imaging"]);
			if(isset($imaging->a)) $imaging_a=$imaging->a; else $imaging_a="";
			if(isset($imaging->b)) $imaging_b=$imaging->b; else $imaging_b="";
		}else {
			$imaging_a="";$imaging_b="";
		}
		
		//IMAGING//
		$imaging_values="";
		if($imaging_a=="G") $imaging_values=$imaging_values. '<span class="tickmark">&#10004;</span>General radiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imaging_b=="IR") $imaging_values=$imaging_values. '<span class="tickmark">&#10004;</span> Interventional radiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($results["imagingel"])){
			$imagingel=json_decode($results["imagingel"]);
			if(isset($imagingel->a)) $imagingel_a=$imagingel->a; else $imagingel_a="";
			if(isset($imagingel->b)) $imagingel_b=$imagingel->b; else $imagingel_b="";
		}else {
			$imagingel_a="";$imagingel_b="";
		}
		
		//IMAGING//
		$imagingel_values="";
		if($imagingel_a=="MA") $imagingel_values=$imagingel_values. '<span class="tickmark">&#10004;</span>Magnetic Resonance Imaging (MRI)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imagingel_b=="PE") $imagingel_values=$imagingel_values. '<span class="tickmark">&#10004;</span>Positron Emission Tomography (PET) Scan&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($results["imagingul"])){
			$imagingul=json_decode($results["imagingul"]);
			if(isset($imagingul->a)) $imagingul_a=$imagingul->a; else $imagingul_a="";
			if(isset($imagingul->b)) $imagingul_b=$imagingul->b; else $imagingul_b="";
		}else {
			$imagingul_a="";$imagingul_b="";
		}
		
		//IMAGING//
		$imagingul_values="";
		if($imagingul_a=="AL") $imagingul_values=$imagingul_values. '<span class="tickmark">&#10004;</span>Allopathic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($imagingul_b=="AY") $imagingul_values=$imagingul_values. '<span class="tickmark">&#10004;</span> Ayurveda&nbsp;&nbsp;&nbsp;&nbsp;'; 
		if(!empty($results["miscellaneous"])){
			$miscellaneous=json_decode($results["miscellaneous"]);
			if(isset($miscellaneous->a)) $miscellaneous_a=$miscellaneous->a; else $miscellaneous_a="";
			if(isset($miscellaneous->b)) $miscellaneous_b=$miscellaneous->b; else $miscellaneous_b="";
			if(isset($miscellaneous->c)) $miscellaneous_c=$miscellaneous->c; else $miscellaneous_c="";
			if(isset($miscellaneous->d)) $miscellaneous_d=$miscellaneous->d; else $miscellaneous_d="";
			if(isset($miscellaneous->e)) $miscellaneous_e=$miscellaneous->e; else $miscellaneous_e="";
			if(isset($miscellaneous->f)) $miscellaneous_f=$miscellaneous->f; else $miscellaneous_f="";
		}else {
			$miscellaneous_a="";$miscellaneous_b="";$miscellaneous_c="";$miscellaneous_d="";$miscellaneous_e="";$miscellaneous_f="";
		}	
			
		//MISCELLANEOUS//
		$miscellaneous_values="";
		if($miscellaneous_a=="EL") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span>Electro Cardio Graphy(ECG)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($miscellaneous_b=="TR") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span> Tread Mill Test&nbsp;&nbsp;&nbsp;&nbsp;';
		if($miscellaneous_c=="E") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span>Electro Encephalo Graphy(EEG)Mammography&nbsp;&nbsp;&nbsp;&nbsp;';
		if($miscellaneous_d=="EC") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span>Echocardiography&nbsp;&nbsp;&nbsp;&nbsp;';
		if($miscellaneous_e=="EM") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span> Electro MyoGraphy (EMG)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($miscellaneous_f=="ES") $miscellaneous_values=$miscellaneous_values. '<span class="tickmark">&#10004;</span> Electrophysiological studies&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($miscellaneous_any_other)) $miscellaneous_values=$miscellaneous_values. "<br/><br/>Any Other : ". $miscellaneous_any_other;
		$is_clinical=$results["is_clinical"];
		$collction_center=$results["collction_center"];
		$is_clinical=($is_clinical=="Y")?'YES':'NO';
		if($is_clinical=="NO"){
			$collction_center="N/A";
		}
		$starting_date=$results["starting_date"];
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
		}else {
			$alliedh_a="";$alliedh_b="";$alliedh_c="";$alliedh_d="";$alliedh_e="";$alliedh_f="";$alliedh_g="";$alliedh_h="";$alliedh_i="";$alliedh_j="";$alliedh_k="";$alliedh_l="";$alliedh_m="";$alliedh_n="";$alliedh_o="";$alliedh_p="";$alliedh_q="";$alliedh_r="";$alliedh_s="";$alliedh_t="";
		}	
			// ALLIED alliedh PROFESSIONS://
		$alliedh_values="";
		
		if($alliedh_a=="AU") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Audiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_b=="B") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Behavioral health(counseling, marriage and family therapy etc)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_c=="E") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Exercise physiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_d=="N") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Nuclear medicine technology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_e=="M") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Medical Laboratory Scientist&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_f=="D") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Dietetics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_g=="OC") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Occupational therapy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_h=="OPT") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Optometry&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_i=="OR") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Orthoptics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_j=="OP") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Orthotics and prosthetics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_k=="OS") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Osteopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_l=="P") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Paramedic&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_m=="PD") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Podiatry&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_n=="HE") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>alliedh Psychology/ Clinical Psychology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_o=="PH") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Physiotherapy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_p=="RT") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Radiation therapy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_q=="RA") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Radiography / Medical imaging&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_r=="RES") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Respiratory Therapy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_s=="SO") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span>Sonography&nbsp;&nbsp;&nbsp;&nbsp;';
		if($alliedh_t=="SPE") $alliedh_values=$alliedh_values. '<span class="tickmark">&#10004;</span> Speech pathology&nbsp;&nbsp;&nbsp;&nbsp;';
		
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
			
		// AYUSH//
		$ayush_values="";
		if($ayush_a=="AU") $ayush_values=$ayush_values. '<span class="tickmark">&#10004;</span>Ausadh Chikitsa&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayush_b=="SC") $ayush_values=$ayush_values. '<span class="tickmark">&#10004;</span> Shalya Chikitsa&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayush_c=="SH") $ayush_values=$ayush_values. '<span class="tickmark">&#10004;</span>Shodhan Chikitsa&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayush_d=="R") $ayush_values=$ayush_values. '<span class="tickmark">&#10004;</span>Rasayana
		&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayush_e=="P") $ayush_values=$ayush_values. '<span class="tickmark">&#10004;</span> Pathya Vyavastha&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ayushyo"])){
			$ayushyo=json_decode($results["ayushyo"]);
			if(isset($ayushyo->a)) $ayushyo_a=$ayushyo->a; else $ayushyo_a="";
			if(isset($ayushyo->b)) $ayushyo_b=$ayushyo->b; else $ayushyo_b="";
		}else{
			$ayushyo_a="";$ayushyo_b="";
		}
		
		$ayushyo_values="";
		
		if($ayushyo_a=="AS") $ayushyo_values=$ayushyo_values. '<span class="tickmark">&#10004;</span>Ashtang&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushyo_b=="Y") $ayushyo_values=$ayushyo_values. '<span class="tickmark">&#10004;</span>Yoga&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ayushun"])){
			$ayushun=json_decode($results["ayushun"]);
			if(isset($ayushun->a)) $ayushun_a=$ayushun->a; else $ayushun_a="";
			if(isset($ayushun->b)) $ayushun_b=$ayushun->b; else $ayushun_b="";
			if(isset($ayushun->c)) $ayushun_c=$ayushun->c; else $ayushun_c="";
			if(isset($ayushun->d)) $ayushun_d=$ayushun->d; else $ayushun_d="";
		}else{
			$ayushun_a="";$ayushun_b="";$ayushun_c="";$ayushun_d="";
		}
		$ayushun_values="";
		
		if($ayushun_a=="M") $ayushun_values=$ayushun_values. '<span class="tickmark">&#10004;</span>Matab&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushun_b=="J") $ayushun_values=$ayushun_values. '<span class="tickmark">&#10004;</span> Jarahat&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushun_c=="IT") $ayushun_values=$ayushun_values. '<span class="tickmark">&#10004;</span>Ilaj-bit-Tadbeer&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushun_d=="HS") $ayushun_values=$ayushun_values. '<span class="tickmark">&#10004;</span>
        Hifzan-e-Sehat&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ayushsi"])){
			$ayushsi=json_decode($results["ayushsi"]);
			if(isset($ayushsi->a)) $ayushsi_a=$ayushsi->a; else $ayushsi_a="";
			if(isset($ayushsi->b)) $ayushsi_b=$ayushsi->b; else $ayushsi_b="";
			if(isset($ayushsi->c)) $ayushsi_c=$ayushsi->c; else $ayushsi_c="";
		}else{
		     $ayushsi_a="";$ayushsi_b="";$ayushsi_c="";
		}
		
		$ayushsi_values="";
		
		if($ayushsi_a=="MA") $ayushsi_values=$ayushsi_values. '<span class="tickmark">&#10004;</span>Maruthuvam&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushsi_b=="SM") $ayushsi_values=$ayushsi_values. '<span class="tickmark">&#10004;</span> Sirappu Maruthuvam&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushsi_c=="VT") $ayushsi_values=$ayushsi_values. '<span class="tickmark">&#10004;</span>Varmam Thokknam & Yoga&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ayushho"])){
			$ayushho=json_decode($results["ayushho"]);
			if(isset($ayushho->a)) $ayushho_a=$ayushho->a; else $ayushho_a="";
		}else{
		    $ayushho_a="";
		}
		$ayushho_values="";
		
		if($ayushho_a=="G") $ayushho_values=$ayushho_values. '<span class="tickmark">&#10004;</span>General Homoeopathy&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["ayushna"])){
			$ayushna=json_decode($results["ayushna"]);
			if(isset($ayushna->a)) $ayushna_a=$ayushna->a; else $ayushna_a="";
			if(isset($ayushna->b)) $ayushna_b=$ayushna->b; else $ayushna_b="";
		}else{
		   $ayushna_a="";$ayushna_b="";
		}

        $ayushna_values="";
		
		if($ayushna_a=="ET") $ayushna_values=$ayushna_values. '<span class="tickmark">&#10004;</span>External Therapies with natural modalities&nbsp;&nbsp;&nbsp;&nbsp;';
		if($ayushna_b=="IN") $ayushna_values=$ayushna_values. '<span class="tickmark">&#10004;</span> Internal Therapies&nbsp;&nbsp;&nbsp;&nbsp;';
			
		if(!empty($results["service"])){
			$service=json_decode($results["service"]);
			if(isset($service->a)) $service_a=$service->a; else $service_a="";
			if(isset($service->b)) $service_b=$service->b; else $service_b="";
			if(isset($service->c)) $service_c=$service->c; else $service_c="";
			if(isset($service->d)) $service_d=$service->d; else $service_d="";
			if(isset($service->e)) $service_e=$service->e; else $service_e="";
		}else {
			$service_a="";$service_b="";$service_c="";$service_d="";$service_e="";
		}
			
		// TYPE OF SERVICE//
		$service_values="";
		
		if($service_a=="G") $service_values=$service_values. '<span class="tickmark">&#10004;</span>General Practice Services&nbsp;&nbsp;&nbsp;&nbsp;';
		if($service_b=="SS") $service_values=$service_values. '<span class="tickmark">&#10004;</span> Single Specialty Services&nbsp;&nbsp;&nbsp;&nbsp;';
		if($service_c=="MS") $service_values=$service_values. '<span class="tickmark">&#10004;</span>Multi Specialty Services (including Palliative care Centre, Trauma Centre, Maternity Home - applicable for hospitals only)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($service_d=="RS") $service_values=$service_values. '<span class="tickmark">&#10004;</span>Rasayana&nbsp;&nbsp;&nbsp;&nbsp;';
		if($service_e=="SP") $service_values=$service_values. '<span class="tickmark">&#10004;</span>Super Specialty Services&nbsp;&nbsp;&nbsp;&nbsp;';
		
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
		}else {
			$degree_a="";$degree_b="";$degree_c="";$degree_d="";$degree_e="";$degree_f="";$degree_g="";$degree_h="";$degree_i="";$degree_j="";$degree_k="";$degree_l="";$degree_m="";$degree_n="";$degree_o="";$degree_p="";$degree_q="";$degree_r="";
		}
			
		// TYPE OF SERVICE//
		$degree_values="";
		if($degree_a=="AN") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Anesthesiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_b=="AV") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Aviation Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_c=="CM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Community Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_d=="DE") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Dermatology, Venerology and Leprosy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_e=="FM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Family Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_f=="GM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span> General Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_g=="GE") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Geriatrics &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_h=="IM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span> ImmunoHaematology and Blood Transfusion&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_i=="NM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Nuclear Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_j=="PA") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Paediatrics &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_k=="PM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Physical Medicine Rehabilitation&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_l=="PS") $degree_values=$degree_values. '<span class="tickmark">&#10004;Psychiatry</span> Psychiatry&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_m=="RD") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Radio-diagnosis &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_n=="RT") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Radio-therapy &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_o=="RH") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Rheumatology &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_p=="SM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Sports Medicine &nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_q=="TM") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Tropical Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		if($degree_r=="TU") $degree_values=$degree_values. '<span class="tickmark">&#10004;</span>Tuberculosis & Respiratory Medicine or Pulmonary Medicine&nbsp;&nbsp;&nbsp;&nbsp;';
		
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
			//SURGICAL__SPECIAL://
		$surgical_special_values="";
		
		if($surgical_special_a=="OT") $surgical_special_values=$surgical_special_values. '<span class="tickmark">&#10004;</span>Otorhinolaryngology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_special_b=="GU") $surgical_special_values=$surgical_special_values. '<span class="tickmark">&#10004;</span>General Surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_special_c=="CP") $surgical_special_values=$surgical_special_values. '<span class="tickmark">&#10004;</span>Ophthalmology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_special_d=="OR") $surgical_special_values=$surgical_special_values. '<span class="tickmark">&#10004;</span>Orthopedics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_special_e=="OB") $surgical_special_values=$surgical_special_values. '<span class="tickmark">&#10004;</span> Obstetrics & Gynecology&nbsp;&nbsp;&nbsp;&nbsp;';
			
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
		}else {
			$specialties_a="";$specialties_b="";$specialties_c="";$specialties_d="";$specialties_e="";$specialties_f="";$specialties_g="";$specialties_h="";$specialties_i="";$specialties_j="";$specialties_k="";
		}
			
			// MEDICAL SUPER SPECIALTIES://
		$specialties_values="";
		
		if($specialties_a=="C") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Cardiology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_b=="CL") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span> Clinical Hematology including Stem Cell Therapy&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_c=="CLI") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Clinical Pharmacology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_d=="E") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Endocrinology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_e=="IM") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span> Immunology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_f=="M") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span> Medical Gastroenterology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_g=="MG") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Medical Genetics&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_h=="MO") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span> Medical Oncology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_i=="NE") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Neonatology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_j=="NEU") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Neurology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($specialties_k=="NR") $specialties_values=$specialties_values. '<span class="tickmark">&#10004;</span>Neuro-radiology&nbsp;&nbsp;&nbsp;&nbsp;';
		
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
			
		}else {
			$surgical_a="";$surgical_b="";$surgical_c="";$surgical_d="";$surgical_e="";$surgical_f="";$surgical_g="";$surgical_h="";$surgical_i="";
		}
			
			// SURGICAL SUPER SPECIALTIES://
		$surgical_values="";
		
		if($surgical_a=="CA") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Cardiovascular thoracic Surgery)&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_b=="UR") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span> Urology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_c=="NS") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Neuro-Surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_d=="PA") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Paediatrics Surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_e=="P") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span> Plastic & Reconstructive Surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_f=="SG") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Surgical Gastroenterology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_g=="SU") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Surgical Oncology&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_h=="E") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Endocrine Surgery&nbsp;&nbsp;&nbsp;&nbsp;';
		if($surgical_i=="G") $surgical_values=$surgical_values. '<span class="tickmark">&#10004;</span>Gynecological Oncology&nbsp;&nbsp;&nbsp;&nbsp;';
		
		if(!empty($results["biomedical"])){
			$biomedical=json_decode($results["biomedical"]);
			if(isset($biomedical->a)) $biomedical_a=$biomedical->a; else $biomedical_a="";
			if(isset($biomedical->b)) $biomedical_b=$biomedical->b; else $biomedical_b="";
			if(isset($biomedical->any_other)) $biomedical_any_other=$biomedical->any_other; else $biomedicall_any_other="";
			
		}else {
			$biomedical_a="";$biomedical_b="";$biomedical_any_other="";
		}
		// Biomedical waste Management//
		
		$biomedical_values="";
		
		if($biomedical_a=="AS") $biomedical_values=$biomedical_values. '<span class="tickmark">&#10004;</span>Ashtang&nbsp;&nbsp;&nbsp;&nbsp;';
		if($biomedical_b=="YO") $biomedical_values=$biomedical_values. '<span class="tickmark">&#10004;</span> Yoga&nbsp;&nbsp;&nbsp;&nbsp;';
		if(!empty($biomedical_any_other)) $biomedical_values=$biomedical_values. "<br/><br/>Any Other : ". $biomedical_any_other;
		
		$is_authorization=$results["is_authorization"];
		$is_pollution=$results["is_pollution"];
		if($is_authorization=="Y"){
				$is_authorization="Yes";
			}else if($is_authorization=="N"){
				$is_authorization="No";
			}
			
		if($is_pollution=="AP"){
			$is_pollution="Applied For";
		}else if($is_pollution=="NA"){
			$is_pollution="Not Applicable";
		}
	}
	
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
			
		</div><br/>
		<table class="table table-bordered table-responsive">			
	<tr>				
		<td valign="top" colspan="2" width="50%">I.ESTABLISHMENT DETAILS</td>
	</tr>
	<tr>
			<td>1.Name of the establishment :</td>
			<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td valign="top">2.Address of the establishment:</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td valign="top" width="50%">Street Name 1</td>
					<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
					<td valign="top">Street Name 2</td>
					<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
					<td valign="top">Village/Town/city</td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td valign="top">Block</td>
					<td>'.strtoupper($b_block).'</td>
				</tr>
				<tr>
					<td valign="top">District</td>
					<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
					<td valign="top">Pincode</td>
					<td>'.strtoupper($b_pincode).'</td>
				</tr>
				<tr>
					<td valign="top">Mobile No.</td>
					<td>'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
					<td valign="top">E-Mail ID</td>
					<td>'.$b_email.'</td>
				</tr>
				<tr>
					<td valign="top">Website (if any)</td>
					<td>'.$website_name.'</td>
				</tr>				
			</table>
		</td>
	</tr>
	<tr>
			<td>3.Month and Year of starting :</td>
			<td>'.strtoupper($starting_date).'</td>
	</tr>
	<tr>
		<td colspan="2">(From 4 to 11 mark all whichever are applicable)</td>
	</tr>	
	<tr>
		<td>4. Location:  </td>
		<td>'.strtoupper($location_type).'</td>
	</tr>
	<tr>
		<td>Description :</td>
		<td>'.strtoupper($fees_description).'</td>
	</tr>
	<tr>
		<td><u>Non-Government / Private Sector</u>  </td>
		<td>' . $ownership_values . '</td>
	</tr>
	<tr>
		<td><u>Non-Government / Private Sector</u>  </td>
		<td>' . $ownership2_values . '</td>
	</tr>
	<tr>
		<td>6. Name of the owner of Clinical Establishment:</td>
		<td>'.strtoupper($owner_name).'</td>
	</tr>

	<tr>				
		<td valign="top" width="50%">Address </td>
		<td>	
			<table class="table table-bordered table-responsive">
				<tr>
					<td valign="top" width="50%">Street Name 1</td>
					<td>'.strtoupper($o_street_name1).'</td>
				</tr>
				<tr>
					<td valign="top">Street Name 2</td>
					<td>'.strtoupper($o_street_name2).'</td>
				</tr>
				<tr>
					<td valign="top">Village/Town/city</td>
					<td>'.strtoupper($o_vill).'</td>
				</tr>
				<tr>
					<td valign="top">Block</td>
					<td>'.strtoupper($o_block).'</td>
				</tr>
				<tr>
					<td valign="top">District</td>
					<td>'.strtoupper($o_dist).'</td>
				</tr>
				<tr>
					<td valign="top">Pincode</td>
					<td>'.strtoupper($o_pin).'</td>
				</tr>
				<tr>
					<td valign="top">Mobile No.</td>
					<td>'.strtoupper($o_mobile_no).'</td>
				</tr>
				<tr>
					<td valign="top">E-Mail ID</td>
					<td>'.$o_email.'</td>
				</tr>
				<tr>
					<td valign="top">Website (if any)</td>
					<td>'. $website_name .'</td>
				</tr>				
			</table>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">7. Name, Designation and Qualification of person in-charge of the clinical establishment: </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
		<thead>
			<tr>
				<th align="center">Sl no</th>
				<th align="center">Name</th>
				<th align="center">Designation</th>
				<th align="center">Qualification</th>
				<th align="center">Registration Number</th>
				<th align="center">Name of Central/State Council(with which registered)</th>
				<th align="center">Mobile</th>
				<th align="center">E-mail ID</th>
			</tr>
		</thead>
		<tbody>';
		$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
		$num = $part1->num_rows;
		if($num>0){
			$count=1;
			while($row_1=$part1->fetch_array()){ 
          $printContents=$printContents.'
			<tr>
				<td>' . $count . '</td>
				<td>' . strtoupper($row_1["name"]) . '</td>
				<td>' . strtoupper($row_1["designation"]) . '</td>				
				<td>' . strtoupper($row_1["qualification"]) . '</td>
				<td>' . strtoupper($row_1["reg_no"]) . '</td>
				<td>' . strtoupper($row_1["name_of_central"]) . '</td>	
				<td>' . strtoupper($row_1["mobile"]) . '</td>													
				<td>' . $row_1["email"] . '</td>	
			</tr>';
							
			}
		}
$printContents=$printContents.'</tbody>											
			</table>
		</td>
	</tr>
   
	<tr>
		<td>8. Systems of Medicine offered: (please tick whichever is applicable)</td>
		<td>' .$systems_values. '</td>
	</tr>
	<tr>
		<td colspan="2">9. Type of establishment :(please tick whichever is applicable)</td>
	</tr>
	<tr>
		<td> (I) Clinic (Outpatient)  </td>
		<td>' . $clinic_values . '</td>
	</tr>
	<tr>
		<td>(II). Day Care facility.</td>
		<td>' .$facility_values. '</td>
	</tr>
	<tr>
		<td>(III). Hospitals including Nursing Home (outpatient and inpatient): </td>
		<td>' .$hospital_values. '</td>
	</tr>
	<tr>
		<td>(IV). Dental Clinics and Dental Hospital:</td>
	</tr>
	<tr>
	    <td>a. Dental clinics. </td>
		<td>' .$dentalcl_values. '</td>
	</tr>
	<tr>
	    <td>b. Dental Hospitals (specialties as listed in the IDC Act.) . </td>
		<td>' .$dental_values. '</td>
	</tr>
	
	<tr>
		<td colspan="2">(V).Diagnostic Centre :</td>
	</tr>
	<tr>
		<td>A. Medical Diagnostic Laboratories:</td>
		<td>' .$medical_values. '</td>
	</tr>
	<tr>
        <td>B. Diagnostic Imaging centers:</td>
    </tr>		
	<tr>
		<td>i. Radiology :</td>
		<td>' .$imaging_values. '</td>
	</tr>
	<tr>
		<td>ii. Electromagnetic imaging: </td>
		<td>' .$imagingel_values. '</td>
	</tr>
	<tr>
		<td>iii. Ultrasound: </td>
		<td>' .$imagingul_values. '</td>
	</tr>
	<tr>
		<td>C. Miscellaneous</td>
		<td>' .$miscellaneous_values. '</td>
	</tr>
	<tr>
		<td valign="top">Collection centers For the clinical labs and diagnostic centres shall function under registered clinical establishment.</td>
		<td>'.$is_clinical.'  &nbsp;&nbsp; '.strtoupper($collction_center).'</td>
	
	</tr>
	<tr>
		<td>(VI). Allied Health professions: </td>
		<td>' .$alliedh_values. '</td>
	</tr>
	<tr>
		<td>(VII) AYUSH </td>
	</tr>
	<tr>
		<td>Ayurveda </td>
		<td>' .$ayush_values. '</td>
	</tr>
	<tr>
		<td>Yoga </td>
		<td>' .$ayushyo_values. '</td>
	</tr>
	<tr>
	   <td>Unani</td>
	   <td>' .$ayushun_values. '</td>
	</tr>
	<tr>
	   <td>Siddha</td>
	   <td>' .$ayushsi_values. '</td>
	</tr>
	<tr>
	   <td>Homoeopathy</td>
	   <td>' .$ayushho_values. '</td>
	</tr>
	<tr>
	   <td>Naturopathy</td>
	   <td>' .$ayushna_values. '</td>
	</tr>
	<tr>
	   <td>II.TYPES OF SERVICE</td>
	</tr>
	<tr>
		<td>TYPE</td>
		<td>' .$service_values. '</td>
	</tr>
	<tr>
		<td>SPECIALITY SPECIFIC</td>
	</tr>
	<tr>
		<td>Medical Specialties – for which candidates must possess recognized PG degree(MD/Diploma/DNB or its equivalent degree)</td>
		<td>' .$degree_values. '</td>
	</tr>
	<tr>
		<td>Surgical specialties</td>
		<td>' .$surgical_special_values. '</td>
	</tr>
	<tr>
		
		<td>Medical Super specialties</td>
		<td>' .$specialties_values. '</td>
	</tr>
	
	<tr>
		
		<td>Surgical Super specialties</td>
		<td>' .$surgical_values. '</td>
	</tr>
	
	<tr>				
		<td valign="top" colspan="2" width="50%">III INFRASTRUCTURE DETAILS</td>
	</tr>
	<tr>
		<td colspan="2" >10. Area of the establishment (in sqft):</td>
	</tr>
	<tr>
		<td>a) Total Area::</td>
		<td>'.strtoupper($estarea).'</td>
	</tr>
	<tr>
		<td>b) Constructed area:</td>
		<td>'.strtoupper($cnstarea).'</td>
	</tr>
	<tr>
		<td colspan="2">11. Out Patient Department:</td>
	</tr>
	<tr>
		<td>11.1 Total no. of OPD Clinics:</td>
		<td>'.strtoupper($total_no).'</td>
	</tr>
				
	<tr>
		<td colspan="2">11.2 Specialty-wise distribution of OPD Clinic.</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">		
				<thead>
				<tr>												
					<td width="50">S. No.</td>
					<td width="50">Specialty</td>
					
				</tr>
				</thead>';					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["special"]).'</td>
						
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">12. In Patient Department:</td>
	</tr>
	<tr>
		<td>1. Total number of beds :</td>
		<td>'.strtoupper($total_no_bed).'</td>
	</tr>
	
	<tr>
		<td colspan="2">12.2. Specialty-wise distribution of beds, please specify:</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">		
				<thead>
				<tr>												
					<th width="25">S. No.</th>
					<th width="38">Specialty</th>
					<th width="37%">Beds</th>
					
				</tr>
				</thead>';					
					$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_3["slno"]).'</td>
						<td>'.strtoupper($row_3["specialty"]).'</td>
						<td>'.strtoupper($row_3["bed"]).'</td>
						
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">13. Biomedical waste Management</td>			
	</tr>
	<tr>
		<td>13.1 Method of treatment and /or disposal of Bio-medical waste</td>
		<td>'.$biomedical_values.'</td>
			
	</tr>
	<tr>
		<td>13.2.Whether authorization from Pollution Control Board/Pollution Control Committee obtained?</td>
		<td>'.strtoupper($is_authorization).' &nbsp;&nbsp;  '.strtoupper($is_pollution).'</td>
			
	</tr>
	<tr>				
		<td valign="top" colspan="2" width="50%">IV HUMAN RESOURCES</td>	
	</tr>
	<tr>
		<td>No. of permanent staff :</td>
		<td>'.strtoupper($permanent_no).'</td>
	</tr>
	<tr>
		<td>No. of temporary staff:</td>
		<td>'.strtoupper($temporary_no).'</td>
	</tr>
	<tr>
		<td valign="top" colspan="2">Please furnish the following details:-</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
			<thead>
			<tr>
				<th width="10">Sl No.</th>
				<th width="10">Name</th>
				<th width="20">Category of staff</th>
				<th width="20">Qualification</th>
				<th width="20">Registration</th>
				<th width="20">Nature of service Temporary/Permanent</th>			
			</tr>
		</thead>';
		$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
		$num4 = $part4->num_rows;
		if($num4>0){
			$slno=1;
			while($row_4=$part4->fetch_array()){
				if($row_4["select_category"]=="D"){
				$select_category="Doctors";
				}else if($row_4["select_category"]=="N"){
				$select_category="Nursing staff";
				}else if($row_4["select_category"]=="P"){
				$select_category="Para-medical Staff";
				}else if($row_4["select_category"]=="PH"){
				$select_category="Pharmacists";
				}else if($row_4["select_category"]=="A"){
				$select_category="Administrative staff";
				}else{
				$select_category="Others";
				}
			
			$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($slno).'</td>
					<td>'.strtoupper($row_4["name"]).'</td>
					<td>'.strtoupper($select_category).'</td>
					<td>'.strtoupper($row_4["qualification"]).'</td>
					<td>'.strtoupper($row_4["registration"]).'</td>
					<td>'.strtoupper($row_4["nature"]).'</td>
					
				</tr>';
				$slno++;
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
		<td colspan="2">Support Staff :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">		
				<thead>
				<tr>												
					<th width="25">S. No.</th>
					<th width="25">Category</th>
					<th>Beds</th>
					<th>Remark</th>
				</tr>
				</thead>';					
					$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_5["slno"]).'</td>
						<td>'.strtoupper($row_5["cate_gory"]).'</td>
						<td>'.strtoupper($row_5["total_no"]).'</td>
						<td>'.strtoupper($row_5["remark"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 
	
	<tr>
		<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
		<td align="right">Signature of Applicant : '.strtoupper($key_person).'<br/>
		Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
	</tr>
</table>';

?>

