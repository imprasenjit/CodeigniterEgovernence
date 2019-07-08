<?php  require_once "../../requires/login_session.php";
$dept="pcpndt";
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
			$form_id=$results["form_id"];
			//PART I
			$reg_no=$results["reg_no"];$patient_age=$results["patient_age"];$fathers_name=$results["fathers_name"];$doc_full_name=$results["doc_full_name"];$ref_reg_no=$results["ref_reg_no"];$last_menstrual_details=$results["last_menstrual_details"];$prev_child_with=$results["prev_child_with"];$maternal_age=$results["maternal_age"];$genetic_disease=$results["genetic_disease"];$other_indication=$results["other_indication"];
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vil=$address->vil;$address_dist=$address->dist;$address_pincode=$address->pincode;$address_mno=$address->mno;
			}else{				
				$address_sn1="";$address_sn2="";$address_vil="";$address_dist="";$address_pincode="";$address_mno="";
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
		}else{
			$form_id="";
			//PART I
			$reg_no="";$patient_age="";$fathers_name="";$doc_full_name="";$ref_reg_no="";$address_sn1="";$address_sn2="";$address_vil="";$address_dist="";$address_pincode="";$address_mno="";$last_menstrual_details="";$history_clinical="";$history_bioclinical="";$history_cytogenetic="";$history_other="";$prev_child_with="";$indication_a="";$indication_b="";$indication_c="";$indication_d="";$indication_e="";$indication_f="";$indication_g="";$indication_h="";$maternal_age="";$genetic_disease="";$other_indication="";
			//PART II
			$procedure_advised_ultrasound="";$procedure_advised_amni="";$procedure_advised_biopsy="";$procedure_advised_foeto="";$procedure_advised_foetal_skin="";$procedure_advised_cordo="";$procedure_advised_others="";$lab_tests_chromo_stud="";$lab_tests_bio_stud="";$lab_tests_mole_stud="";$lab_tests_preimplan="";$is_result_details="";$is_result="";
			$is_MTP_advised="";$referred_address_gen_clinic_name="";$referred_address_sn1="";$referred_address_sn2="";$referred_address_v="";$referred_address_d="";$referred_address_phn_no="";$referred_address_p="";$commencement_date="";$completion_date="";		
		}
	}else{
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		//PART I
		$reg_no=$results["reg_no"];$patient_age=$results["patient_age"];$fathers_name=$results["fathers_name"];$doc_full_name=$results["doc_full_name"];$ref_reg_no=$results["ref_reg_no"];$last_menstrual_details=$results["last_menstrual_details"];$prev_child_with=$results["prev_child_with"];$maternal_age=$results["maternal_age"];$genetic_disease=$results["genetic_disease"];$other_indication=$results["other_indication"];
		if(!empty($results["address"])){
			$address=json_decode($results["address"]);
			$address_sn1=$address->sn1;$address_sn2=$address->sn2;$address_vil=$address->vil;$address_dist=$address->dist;$address_pincode=$address->pincode;$address_mno=$address->mno;
		}else{				
			$address_sn1="";$address_sn2="";$address_vil="";$address_dist="";$address_pincode="";$address_mno="";
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
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center text-bold" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part II</a></li>
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="4">1. Name and address of Genetic Counselling centre</td>
											</tr>
											<tr>
												<td width="25%">Name :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled"/></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">Address :</td>
											</tr>
											<tr>
												<td>Street Name1 :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
												<td>Street Name2:</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo  $b_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_pincode; ?>"></td>
												<td>Mobile No :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
											</tr>
											<tr>
												<td>Email Id :</td>
												<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $b_email; ?>"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td>2. Registration No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no; ?>"></td>
												<td>3. Patient's name :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>" ></td>
											</tr>
											<tr>
												<td>4. Age :</td>
												<td><input type="text" class="form-control text-uppercase" name="patient_age" value="<?php echo $patient_age; ?>"></td>
												<td>5. Husband's/ Father's name :</td>
												<td><input type="text" class="form-control text-uppercase" name="fathers_name" value="<?php echo $fathers_name; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">6. Full address with Tel. No., if any</td>
											</tr>
											<tr>
												<td>Street Name1 :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
												<td>Street Name2 :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
												<td>Mobile No :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$mobile_no; ?>"></td>
											</tr>
											<tr>
												<td>Email Id :</td>
												<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $email; ?>"></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>										
											<tr>
												<td colspan="4">7 Referred by (Full name and address of Doctor(s) with registration No.(s) (Referral note to be preserved carefully with case papers)</td>
											</tr>
											<tr>
												<td>Full name :</td>
												<td><input type="text" class="form-control" name="doc_full_name"  value="<?php echo  $doc_full_name; ?>"></td>
												<td>Registration No. :</td>
												<td><input type="text" class="form-control" name="ref_reg_no"  value="<?php echo  $ref_reg_no; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">Address :</td>
											</tr>
											<tr>
												<td>Street Name1 :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[sn1]" value="<?php echo  $address_sn1; ?>"	></td>
												<td>Street Name2 :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[sn2]" value="<?php echo  $address_sn2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[vil]" value="<?php echo  $address_vil; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[dist]" value="<?php echo  $address_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[pincode]" validate="pincode" maxlength="6" value="<?php echo  $address_pincode; ?>"></td>
												<td>Mobile No :</td>
												<td><input type="text" class="form-control text-uppercase" name="address[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $address_mno; ?>"></td>
											</tr>
											<tr>
												<td >8. Last menstrual period/ weeks of pregnancy :</td>
												<td><input type="text" class="form-control text-uppercase"  name="last_menstrual_details" value="<?php echo  $last_menstrual_details; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">9. History of genetic/medical disease in the family(specify) </br>Basis of diagnosis :</td>
											</tr>
											<tr>
												<td width="25%">(a) Clinical :</td>
												<td width="25%"><textarea name="history[clinical]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $history_clinical; ?></textarea></td>
												<td width="25%">(b) Bio-chemical :</td>
												<td width="25%"><textarea name="history[bioclinical]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $history_bioclinical; ?></textarea></td>
											</tr>
											<tr>
												<td>(c) Cytogenetic :</td>
												<td><textarea name="history[cytogenetic]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $history_cytogenetic; ?></textarea></td>
												<td>(d) Other (e.g. radiological, ulrasonography ) :</td>
												<td><textarea name="history[other]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $history_other; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">10. Indication for per-natal diagnosis :</td>
											</tr>
											<tr>
												<td width="25%">A. Previous child/ children with :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="prev_child_with" value="<?php echo  $prev_child_with; ?>"></td>
											</tr>
											<tr>
												<td width="25%">(i) Chromosomal disorders :</td>
												<td width="25%"><textarea name="indication[a]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_a; ?></textarea></td>
												<td width="25%">(ii) Metabolic disorders :</td>
												<td width="25%"><textarea name="indication[b]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_b; ?></textarea></td>
											</tr>
											<tr>
												<td>(iii) Congenital anomaly :</td>
												<td><textarea name="indication[c]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_c; ?></textarea></td>
												<td>(iv) Mental retardation :</td>
												<td><textarea name="indication[d]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_d; ?></textarea></td>
											</tr>
											<tr>
												<td>(v) Haemoglobinopathy :</td>
												<td><textarea name="indication[e]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_e; ?></textarea></td>
												<td>(vi) Sex linked disorders :</td>
												<td><textarea name="indication[f]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_f; ?></textarea></td>
											</tr>
											<tr>
												<td>(vii) Single gene disorder :</td>
												<td><textarea name="indication[g]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_g; ?></textarea></td>
												<td>(Viii) Any other (specify) :</td>
												<td><textarea name="indication[h]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $indication_h; ?></textarea></td>
											</tr>
											<tr>
												<td>B. Advanced maternal age (35 years or above) :</td>
												<td><input type="text" class="form-control text-uppercase"  name="maternal_age" validate="onlyNumbers" maxlength="2" value="<?php echo  $maternal_age; ?>"></td>
												<td>C. Mother /father/sibling having genetic disease (specify) :</td>
												<td><input type="text" class="form-control text-uppercase"  name="genetic_disease" value="<?php echo  $genetic_disease; ?>"></td>
											</tr>
											<tr>
												<td>D. Others (specify) :</td>
												<td><input type="text" class="form-control text-uppercase"  name="other_indication" value="<?php echo  $other_indication; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td></td>
												<td class="text-center" colspan="2">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
												</td>
												<td></td>
											</tr>
										</table>
										</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">11. Procedure advised :</td>
										</tr>
										<tr>
											<td width="25%">(i) Ultrasound :</td>
											<td width="25%"><textarea name="procedure_advised[ultrasound]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_ultrasound; ?></textarea></td>
											<td width="25%">(ii) Amniocentesis :</td>
											<td width="25%"><textarea name="procedure_advised[amni]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_amni; ?></textarea></td>
										</tr>
										<tr>
											<td>(iii) Chorionic villi biopsy :</td>
											<td><textarea name="procedure_advised[biopsy]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_biopsy; ?></textarea></td>
											<td>(iv) Foetoscopy :</td>
											<td><textarea name="procedure_advised[foeto]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_foeto; ?></textarea></td>
										</tr>
										<tr>
											<td>(v) Foetal skin or organ biopsy :</td>
											<td><textarea name="procedure_advised[foetal_skin]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_foetal_skin; ?></textarea></td>
											<td>(vi) Cordocentesis :</td>
											<td><textarea name="procedure_advised[cordo]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_cordo; ?></textarea></td>
										</tr>
										<tr>
											<td>(vii) Any other (specify) :</td>
											<td><textarea name="procedure_advised[others]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $procedure_advised_others; ?></textarea></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">12. Laboratory tests to be carried out :</td>
										</tr>
										<tr>
											<td width="25%">(i) Chromosomal studies :</td>
											<td width="25%"><textarea name="lab_tests[chromo_stud]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $lab_tests_chromo_stud; ?></textarea></td>
											<td width="25%">(ii) Biochmical studies :</td>
											<td width="25%"><textarea name="lab_tests[bio_stud]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $lab_tests_bio_stud; ?></textarea></td>
										</tr>
										<tr>
											<td>(iii) Molecular studies :</td>
											<td><textarea name="lab_tests[mole_stud]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $lab_tests_mole_stud; ?></textarea></td>
											<td>(iv) Preimplantation genetic diagnosis :</td>
											<td><textarea name="lab_tests[preimplan]"  class="form-control text-uppercase" validate="textarea" maxlength="500"><?php echo $lab_tests_preimplan; ?></textarea></td>
										</tr>
										<tr>
											<td>13. Result of diagnosis :</td>
											<td><label class="radio-inline"><input type="radio" name="is_result" class="is_result" value="N"  <?php if(isset($is_result) && $is_result=='N' || $is_result=='') echo 'checked'; ?> /> Normal</label>
											<label class="radio-inline"><input type="radio" class="is_result"  value="A"  name="is_result" <?php if(isset($is_result) && ($is_result=='A')) echo 'checked'; ?>/>Abnormal</label></td>
											<td width="25%">If abnormal give details. :</td>
											<td><input  type="text" name="is_result_details" id="is_result_details" value="<?php echo $is_result_details; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>14. Was MTP advised?</td>
											<td><label class="radio-inline"><input type="radio" name="is_MTP_advised" class="is_MTP_advised" value="Y"  <?php if(isset($is_MTP_advised) && $is_MTP_advised=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_MTP_advised"  value="N"  name="is_MTP_advised" <?php if(isset($is_MTP_advised) && ($is_MTP_advised=='N' || $is_MTP_advised=='')) echo 'checked'; ?>/>No</label></td>
										</tr>
										<tr>
											<td colspan="4">15. Name and address of Genetic Clinic* to which patient is referred :</td>
										</tr>
										<tr>
											<td>Name of Genetic Clinic :</td>
											<td><input type="text" class="form-control text-uppercase" name="referred_address[gen_clinic_name]" value="<?php echo $referred_address_gen_clinic_name; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">Address :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class=" form-control text-uppercase" name="referred_address[sn1]" value="<?php echo $referred_address_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="referred_address[sn2]" value="<?php echo $referred_address_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village :</td>
											<td><input type="text" class=" form-control text-uppercase" name="referred_address[v]" value="<?php echo $referred_address_v; ?>"></td>
											<td>District :</td>
                                            <td><input type="text" class=" form-control text-uppercase" name="referred_address[d]" value="<?php echo $referred_address_d; ?>"></td>
											
										</tr>
										<tr>
											<td>Pincode :</td>
											<td><input type="text" class="form-control text-uppercase" name="referred_address[p]" value="<?php echo $referred_address_p; ?>" maxlength="6" validate="pincode"></td>
											<td>Contact No :</td>
											<td><input type="text" class="form-control text-uppercase" name="referred_address[phn_no]" validate="mobileNumber" maxlength="10" value="<?php echo $referred_address_phn_no; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">16. Dates of commencement and completion of genetic counseling.</td>
										</tr>
										<tr>
											<td>Date of commencement :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="commencement_date" value="<?php if($commencement_date!="0000-00-00" && $commencement_date!="") echo date("d-m-Y",strtotime($commencement_date)); else echo "";?>" placeholder="DD-MM-YYYY"></td>
											<td>Date of completion :</td>
											<td><input type="text" class="dobindia form-control text-uppercase" name="completion_date" value="<?php if($completion_date!="0000-00-00" && $completion_date!="") echo date("d-m-Y",strtotime($completion_date)); else echo "";?>" placeholder="DD-MM-YYYY" ></td>
										</tr>
										<tr>
											<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
												Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
												Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
										</tr>									
										<tr>
											<td class="text-center" colspan="5">
												<a type="button" href="<?php echo $table_name; ?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="submit<?php echo $form; ?>" class="btn btn-success">Save and Submit</button>
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
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */	
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	/* ------------------------------------------------------ */	
	$('#is_result_details').attr('readonly','readonly');
		<?php if($is_result == 'A') echo "$('#is_result_details').removeAttr('readonly','readonly');"; ?>
		$('.is_result').on('change', function(){
			if($(this).val() == 'A'){
				$('#is_result_details').removeAttr('readonly','readonly');
			}else{
				$('#is_result_details').attr('readonly','readonly');
				$('#is_result_details').val('');
			}			
		});
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>