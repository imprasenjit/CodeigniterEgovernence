<?php
$dept="pcpndt";
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
		//PART I
		$reg_no=$results["reg_no"];$patient_age=$results["patient_age"];$fathers_name=$results["fathers_name"];$doc_full_name=$results["doc_full_name"];$ref_reg_no=$results["ref_reg_no"];
		$last_menstrual_details=$results["last_menstrual_details"];$prev_child_with=$results["prev_child_with"];$maternal_age=$results["maternal_age"];$genetic_disease=$results["genetic_disease"];$other_indication=$results["other_indication"];
		if(!empty($results["address"])){
			$address=json_decode($results["address"]);
			$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vil=$address->vil;$address_dist=$address->dist;$address_pincode=$address->pincode;$address_mno=$address->mno;
		}else{				
			$address_sn1="";$address_sn2="";$address_vil="";$address_dist="";$address_pincode="";$address_mno="";$address_email="";
		}	
		if(!empty($results["history"])){
			$history=json_decode($results["history"]);
			$history_clinical=$history->clinical;$history_bioclinical=$history->bioclinical;$history_cytogenetic=$history->cytogenetic;$history_other=$history->other;
		}else{				
			$history_clinical="";$history_bioclinical="";$history_cytogenetic="";$history_other="";
		}
		if(!empty($results["indication"])){
			$indication=json_decode($results["indication"]);
			$indication_a=$indication->a;$indication_b=$indication->b;$indication_c=$indication->c;$indication_d=$indication->d;$indication_e=$indication->e;$indication_f=$indication->f;$indication_g=$indication->g;$indication_h=$indication->h;
		}else{				
			$indication_a="";$indication_b="";$indication_c="";$indication_d="";$indication_e="";$indication_f="";$indication_g="";$indication_h="";
		}
		//PART II
		
		$is_result_details=$results["is_result_details"];$is_result=$results["is_result"];
		$is_MTP_advised=$results["is_MTP_advised"];	$commencement_date=$results["commencement_date"];$completion_date=$results["completion_date"];
		
		if(!empty($results["procedure_advised"])){
			$procedure_advised=json_decode($results["procedure_advised"]);
			$procedure_advised_ultrasound=$procedure_advised->ultrasound;$procedure_advised_amni=$procedure_advised->amni;$procedure_advised_biopsy=$procedure_advised->biopsy;$procedure_advised_foeto=$procedure_advised->foeto;$procedure_advised_foetal_skin=$procedure_advised->foetal_skin;$procedure_advised_cordo=$procedure_advised->cordo;$procedure_advised_others=$procedure_advised->others;
		}else{				
			$procedure_advised_ultrasound="";$procedure_advised_amni="";$procedure_advised_biopsy="";$procedure_advised_foeto="";$procedure_advised_foetal_skin="";$procedure_advised_cordo="";$procedure_advised_others="";
		}	
		if(!empty($results["lab_tests"])){
			$lab_tests=json_decode($results["lab_tests"]);
			$lab_tests_chromo_stud=$lab_tests->chromo_stud;$lab_tests_bio_stud=$lab_tests->bio_stud;$lab_tests_mole_stud=$lab_tests->mole_stud;$lab_tests_preimplan=$lab_tests->preimplan;
		}else{
			
			$lab_tests_chromo_stud="";$lab_tests_bio_stud="";$lab_tests_mole_stud="";$lab_tests_preimplan="";
		}
			
		if(!empty($results["referred_address"])){
			$referred_address=json_decode($results["referred_address"]);
			$referred_address_gen_clinic_name=$referred_address->gen_clinic_name;$referred_address_sn1=$referred_address->sn1;$referred_address_sn2=$referred_address->sn2;$referred_address_v=$referred_address->v;$referred_address_d=$referred_address->d;$referred_address_phn_no=$referred_address->phn_no;$referred_address_p=$referred_address->p;
		}else{				
			$referred_address_gen_clinic_name="";$referred_address_sn1="";$referred_address_sn2="";$referred_address_v="";$referred_address_d="";$referred_address_phn_no="";$referred_address_p="";
		}	
		if($is_result=='N') $is_result="NORMAL";
		else $is_result="ABNORMAL";
		if($is_MTP_advised=='Y') $is_MTP_advised="YES";
		else $is_MTP_advised="NO";
    }
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form '.$form.'</title>
	<style>
	input, textarea { 
	text-transform: uppercase;
	}
	.header{
	width: 100%;
	height: 130px;
	font-weight: bold;
	}
	.main_body {
	height: 700px;
	width: 100%;
	}
	#form1 table {
	vertical-align: middle;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';       
	}else{
    $printContents='';
	}	

	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/> 
  	<table class="table table-bordered table-responsive">
			      
					<tr>
							<td colspan="2">1. Name and address of Genetic Counselling centre.</td>
					</tr>
					<tr>
							<td width="50%">Name :</td>
							<td >'.strtoupper($unit_name).'</td>
					</tr>
					<tr>
							<td>Address :</td>
							<td>
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td >Street name 1 :</td>
									<td>'.strtoupper($b_street_name1).'</td>
								</tr>
								<tr>
									<td >Street name 2 :</td>
									<td>'.strtoupper($b_street_name2).'</td>
								</tr>
								<tr>
									<td >Village/Town :</td>
									<td>'.strtoupper($b_vill).'</td>
								</tr>
								<tr>
									<td >District :</td>
									<td>'.strtoupper($b_dist).'</td>
								</tr>
								<tr>
									<td >Pincode :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								<tr>
									<td >Mobile No :</td>
									<td>'.strtoupper($b_mobile_no).'</td>
								</tr>
								<tr>
									<td >Email-ID :</td>
									<td>'.$b_email.'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
							<td>2. Registration No. :</td>
							<td>'.strtoupper($reg_no).'</td>
					</tr>
					<tr>
							<td>3. Patients name :</td>
							<td>'.strtoupper($key_person).'</td>
					</tr>
					<tr>
							<td>4. Age :</td>
							<td>'.strtoupper($patient_age).'</td>
					</tr>
					<tr>
							<td>5. Husbands / Fathers name :</td>
							<td>'.strtoupper($fathers_name).'</td>
					</tr>
					<tr>
							<td>6. Full address with Tel. No., if any</td>
							<td>
							<table class="table table-bordered table-responsive">
								<tr>
									<td >Street name 1 :</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td >Street name 2 :</td>
									<td>'.strtoupper($street_name2).'</td>
								</tr>
								<tr>
									<td >Village/Town :</td>
									<td>'.strtoupper($vill).'</td>
								</tr>
								<tr>
									<td >District :</td>
									<td>'.strtoupper($dist).'</td>
								</tr>
								<tr>
									<td >Pincode :</td>
									<td>'.strtoupper($pincode).'</td>
								</tr>
								<tr>
									<td >Mobile No. :</td>
									<td>'.strtoupper($mobile_no).'</td>
								</tr>
								<tr>
									<td >Email Id :</td>
									<td>'.$email.'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
						<td colspan="2">7. Referred by (Full name and address of Doctor(s) with registration No.(s) (Referral note to be preserved carefully with case papers).</td>
					</tr>
					<tr>
							<td >Full name :</td>
							<td >'.strtoupper($doc_full_name).'</td>
					</tr>
					<tr>
							<td>Registration No. :</td>
							<td>'.strtoupper($ref_reg_no).'</td>
					</tr>
					
					<tr>
							<td>Address :</td>
							<td>
							<table class="table table-bordered table-responsive">
								<tr>
									<td >Street name 1 :</td>
									<td>'.strtoupper($address_sn1).'</td>
								</tr>
								<tr>
									<td >Street name 2 :</td>
									<td>'.strtoupper($address_sn2).'</td>
								</tr>
								<tr>
									<td >Village/Town :</td>
									<td>'.strtoupper($address_vil).'</td>
								</tr>
								<tr>
									<td >District :</td>
									<td>'.strtoupper($address_dist).'</td>
								</tr>
								<tr>
									<td >Pincode :</td>
									<td>'.strtoupper($address_pincode).'</td>
								</tr>
								<tr>
									<td >Mobile No :</td>
									<td>'.strtoupper($address_mno).'</td>
								</tr>
							</table>
							</td>
					</tr>
					<tr>
						<td>8. Last menstrual period/ weeks of pregnancy :</td>
						<td>'.strtoupper($last_menstrual_details).'</td>
					</tr>
					<tr>
						<td colspan="2">9. History of genetic/medical disease in the family(specify) - <br/>Basis of diagnosis.:</td>
					</tr>
					<tr>
						<td>  </td>
						<td><table class="table table-bordered table-responsive">
								<tr>
									<td >(a) Clinical :</td>
									<td>'.strtoupper($history_clinical).'</td>
								</tr>
								<tr>
									<td >(b) Bio-chemical :</td>
									<td>'.strtoupper($history_bioclinical).'</td>
								</tr>
								<tr>
									<td >(c) Cytogenetic :</td>
									<td>'.strtoupper($history_cytogenetic).'</td>
								</tr>
								<tr>
									<td >(d) Other (e.g. radiological, ulrasonography ) :</td>
									<td>'.strtoupper($history_other).'</td>
								</tr>
								
						</table></td> 
					</tr>
					<tr>
						<td colspan="2">10. Indication for per-natal diagnosis.</td>
					</tr>
					<tr>
						<td >A. Previous child/ children with  : </td>
						<td>'.strtoupper($prev_child_with).'</td> 
					</tr>
					<tr>
						<td> </td>
						<td><table class="table table-bordered table-responsive">
								<tr>
									<td >(i) Chromosomal disorders  :</td>
									<td>'.strtoupper($indication_a).'</td>
								</tr>
								<tr>
									<td >(ii) Metabolic disorders :</td>
									<td>'.strtoupper($indication_b).'</td>
								</tr>
								<tr>
									<td >(iii) Congenital anomaly  :</td>
									<td>'.strtoupper($indication_c).'</td>
								</tr>
								<tr>
									<td >(iv) Mental retardation  :</td>
									<td>'.strtoupper($indication_d).'</td>
								</tr>
								<tr>
									<td >(v) Haemoglobinopathy :</td>
									<td>'.strtoupper($indication_e).'</td>
								</tr>
								<tr>
									<td >(vi) Sex linked disorders  :</td>
									<td>'.strtoupper($indication_f).'</td>
								</tr>
								<tr>
									<td >(vii) Single gene disorder  :</td>
									<td>'.strtoupper($indication_g).'</td>
								</tr>
								<tr>
									<td >(Viii) Any other (specify)  :</td>
									<td>'.strtoupper($indication_h).'</td>
								</tr>
								
						</table></td> 
					</tr>
					
					<tr>
						<td>B. Advanced maternal age (35 years or above)  :</td>
						<td>'.strtoupper($maternal_age).'</td> 
					</tr>
					<tr>
						<td>C. Mother /father/sibling having genetic disease (specify) :</td>
						<td>'.strtoupper($genetic_disease).'</td> 
					</tr>
					<tr>
						<td>D. Others (specify)  :</td>
						<td>'.strtoupper($other_indication).'</td> 
					</tr>
					<tr>
						<td colspan="2">11. Procedure advised.</td>
					</tr>
					<tr>
						<td> </td>
						<td><table class="table table-bordered table-responsive">
								<tr>
									<td>(i) Ultrasound :</td>
									<td>'.strtoupper($procedure_advised_ultrasound).'</td>
								</tr>
								<tr>
									<td>(ii) Amniocentesis :</td>
									<td>'.strtoupper($procedure_advised_amni).'</td>
								</tr>
								<tr>
									<td>(iii) Chorionic villi biopsy  :</td>
									<td>'.strtoupper($procedure_advised_biopsy).'</td>
								</tr>
								<tr>
									<td>(iv) Foetoscopy :</td>
									<td>'.strtoupper($procedure_advised_foeto).'</td>
								</tr>
								<tr>
									<td>(v) Foetal skin or organ biopsy :</td>
									<td>'.strtoupper($procedure_advised_foetal_skin).'</td>
								</tr>
								<tr>
									<td>(vi) Cordocentesis :</td>
									<td>'.strtoupper($procedure_advised_cordo).'</td>
								</tr>
								<tr>
									<td>(vii) Any other (specify) :</td>
									<td>'.strtoupper($procedure_advised_others).'</td>
								</tr>
								
						</table></td> 
					</tr>
					
					<tr>
						<td colspan="2">12. Laboratory tests to be carried out.</td>
					</tr>
					<tr>
						<td > </td>
						<td><table class="table table-bordered table-responsive">
								<tr>
									<td>(i) Chromosomal studies :</td>
									<td>'.strtoupper($lab_tests_chromo_stud).'</td>
								</tr>
								<tr>
									<td>(ii) Biochmical studies :</td>
									<td>'.strtoupper($lab_tests_bio_stud).'</td>
								</tr>
								<tr>
									<td>(iii) Molecular studies :</td>
									<td>'.strtoupper($lab_tests_mole_stud).'</td>
								</tr>
								<tr>
									<td>(iv) Preimplantation genetic diagnosis :</td>
									<td>'.strtoupper($lab_tests_preimplan).'</td>
								</tr>
						</table></td> 
					</tr>
					
					<tr>
						<td >13. Result of diagnosis :</td>
						<td>'.strtoupper($is_result).' &nbsp;&nbsp;&nbsp;&nbsp; '.strtoupper($is_result_details).'</td>
					</tr>
					<tr>
						<td>14. Was MTP advised :</td>
						<td>'.strtoupper($is_MTP_advised).'</td> 
					</tr>
					<tr>
						<td colspan="2">15. Name and address of Genetic Clinic* to which patient is referred. </td>
					</tr>
					<tr>
						<td>Name of Genetic Clinic :</td>
						<td>'.strtoupper($referred_address_gen_clinic_name).'</td> 
					</tr>
					<tr>
					      <td>Address </td>
						    <td><table class="table table-bordered table-responsive">
								<tr>
									<td >Street name 1 :</td>
									<td>'.strtoupper($referred_address_sn1).'</td>
								</tr>
								<tr>
									<td >Street name 2 :</td>
									<td>'.strtoupper($referred_address_sn2).'</td>
								</tr>
								<tr>
									<td >Village/Town :</td>
									<td>'.strtoupper($referred_address_v).'</td>
								</tr>
								<tr>
									<td >District :</td>
									<td>'.strtoupper($referred_address_d).'</td>
								</tr>
								<tr>
									<td >Pincode :</td>
									<td>'.strtoupper($referred_address_p).'</td>
								</tr>
								<tr>
									<td >Contact No. :</td>
									<td>'.strtoupper($referred_address_phn_no).'</td>
								</tr>
							</table></td> 
				</tr>
				<tr>
					<td colspan="2">16. Dates of commencement and completion of genetic counseling.</td>
				</tr>
				<tr>
						<td>Date of commencement :</td>
						<td>'.strtoupper($commencement_date).'</td> 
				</tr>
				<tr>
						<td>Date of completion :</td>
						<td>'.strtoupper($completion_date).'</td> 
				</tr>
				';
				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
            </td>
        </tr>        
	</table>';
?>
				  
				