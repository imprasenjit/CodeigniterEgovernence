<?php  require_once "../../requires/login_session.php";
$dept="sdc";
$form="24";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form2.php";
		
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_array();
			$form_id=$results["form_id"];$auth_person=$results["auth_person"];$drug_name=$results["drug_name"];$dosage_form=$results["dosage_form"];$pharma_drug=$results["pharma_drug"];$indication=$results["indication"];$raw_mat=$results["raw_mat"];$patent=$results["patent"];$chemical=$results["chemical"];$animal=$results["animal"];$toxicology=$results["toxicology"];$human=$results["human"];$clinical_p1=$results["clinical_p1"];$clinical_p2=$results["clinical_p2"];$dissolution=$results["dissolution"];$reg_status=$results["reg_status"];$test_licence=$results["test_licence"];
			if(!empty($results["test_spec"])){
				$test_spec=json_decode($results["test_spec"]);
				$test_spec_a=$test_spec->a;$test_spec_b=$test_spec->b;
			}else{				
				$test_spec_a="";$test_spec_b="";
			}
			if(!empty($results["marketing"])){
				$marketing=json_decode($results["marketing"]);
				$marketing_a=$marketing->a;$marketing_b=$marketing->b;
			}else{				
				$marketing_a="";$marketing_b="";
			}
			if(!empty($results["formulation"])){
				$formulation=json_decode($results["formulation"]);
				$formulation_a=$formulation->a;$formulation_b=$formulation->b;$formulation_c=$formulation->c;
			}else{				
				$formulation_a="";$formulation_b="";$formulation_c="";
			}
			if(!empty($results["raw_material"])){
				$raw_material=json_decode($results["raw_material"]);
				$raw_material_a=$raw_material->a;$raw_material_b=$raw_material->b;$raw_material_c=$raw_material->c;
			}else{				
				$raw_material_a="";$raw_material_b="";$raw_material_c="";
			}
			if(!empty($results["fix_approval"])){
				$fix_approval=json_decode($results["fix_approval"]);
				$fix_approval_a=$fix_approval->a;$fix_approval_b=$fix_approval->b;$fix_approval_c=$fix_approval->c;
			}else{				
				$fix_approval_a="";$fix_approval_b="";$fix_approval_c="";
			}
			if(!empty($results["sub_approval"])){
				$sub_approval=json_decode($results["sub_approval"]);
				$sub_approval_a=$sub_approval->a;$sub_approval_b=$sub_approval->b;$sub_approval_c=$sub_approval->c;
			}else{				
				$sub_approval_a="";$sub_approval_b="";$sub_approval_c="";
			}
		}else{
			$form_id="";$auth_person="";$drug_name="";$dosage_form="";$pharma_drug="";$indication="";$raw_mat="";$patent="";$chemical="";$animal="";$toxicology="";$human="";$clinical_p1="";$clinical_p2="";$dissolution="";$reg_status="";$test_licence="";
			$test_spec_a="";$test_spec_b="";
			$marketing_a="";$marketing_b="";
			$formulation_a="";$formulation_b="";$formulation_c="";
			$raw_material_a="";$raw_material_b="";$raw_material_c="";
			$fix_approval_a="";$fix_approval_b="";$fix_approval_c="";
			$sub_approval_a="";$sub_approval_b="";$sub_approval_c="";
		}
	}else{		
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$drug_name=$results["drug_name"];$dosage_form=$results["dosage_form"];$pharma_drug=$results["pharma_drug"];$indication=$results["indication"];$raw_mat=$results["raw_mat"];$patent=$results["patent"];$chemical=$results["chemical"];$animal=$results["animal"];$toxicology=$results["toxicology"];$human=$results["human"];$clinical_p1=$results["clinical_p1"];$clinical_p2=$results["clinical_p2"];$dissolution=$results["dissolution"];$reg_status=$results["reg_status"];$test_licence=$results["test_licence"];
		if(!empty($results["test_spec"])){
			$test_spec=json_decode($results["test_spec"]);
			$test_spec_a=$test_spec->a;$test_spec_b=$test_spec->b;
		}else{				
			$test_spec_a="";$test_spec_b="";
		}
		if(!empty($results["marketing"])){
			$marketing=json_decode($results["marketing"]);
			$marketing_a=$marketing->a;$marketing_b=$marketing->b;
		}else{				
			$marketing_a="";$marketing_b="";
		}
		if(!empty($results["formulation"])){
			$formulation=json_decode($results["formulation"]);
			$formulation_a=$formulation->a;$formulation_b=$formulation->b;$formulation_c=$formulation->c;
		}else{				
			$formulation_a="";$formulation_b="";$formulation_c="";
		}
		if(!empty($results["raw_material"])){
			$raw_material=json_decode($results["raw_material"]);
			$raw_material_a=$raw_material->a;$raw_material_b=$raw_material->b;$raw_material_c=$raw_material->c;
		}else{				
			$raw_material_a="";$raw_material_b="";$raw_material_c="";
		}
		if(!empty($results["fix_approval"])){
			$fix_approval=json_decode($results["fix_approval"]);
			$fix_approval_a=$fix_approval->a;$fix_approval_b=$fix_approval->b;$fix_approval_c=$fix_approval->c;
		}else{				
			$fix_approval_a="";$fix_approval_b="";$fix_approval_c="";
		}
		if(!empty($results["sub_approval"])){
			$sub_approval=json_decode($results["sub_approval"]);
			$sub_approval_a=$sub_approval->a;$sub_approval_b=$sub_approval->b;$sub_approval_c=$sub_approval->c;
		}else{				
			$sub_approval_a="";$sub_approval_b="";$sub_approval_c="";
		}
	}
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr class="form-inline">
												<td colspan="4"> I/We &nbsp;<input type="text"  class="form-control text-uppercase" name="auth_person" required="required" value="<?php if($auth_person!="") { echo $auth_person; }else{ echo $key_person;}?>" validate="letters">&nbsp; of M/s. &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist;?>">&nbsp;(address) hereby apply for grant of permission for import of and/or clinical trial or for approval to manufacture a new drug or fixed dose combination or subsequent permission for already approved new drug. The necessary information/ data is given below:</td> 
											</tr>
											<tr>
												<td colspan="4">1. Particulars of New Drug:</tr>
											</tr>
											<tr>
												<td width="25%">(i) Name of the drug:</td>
												<td width="25%"><input type="text"  class="form-control text-uppercase" name="drug_name" value="<?php echo $drug_name;?>" > </td>
												<td width="25%">(ii) Dosage Form:</td>
												<td width="25%"><input type="text"  class="form-control text-uppercase" name="dosage_form" value="<?php echo $dosage_form;?>" > </td>
											</tr>
											<tr>
												<td colspan="4">(iii) Test specification:</td>
											</tr>
											<tr>
												<td width="25%">(a) Active ingredients:</td>
												<td><input type="text"  class="form-control text-uppercase" name="test_spec[a]" value="<?php echo $test_spec_a;?>" > </td>
												<td width="25%">(b) Inactive ingredients:</td>
												<td><input type="text"  class="form-control text-uppercase" name="test_spec[b]" value="<?php echo $test_spec_b;?>" > </td>
											</tr>
											<tr>
												<td width="25%">(iv) Pharmacological classification of the drug:</td>
												<td><input type="text"  class="form-control text-uppercase" name="pharma_drug" value="<?php echo $pharma_drug;?>" > </td>
												<td width="25%">(v) Indications for which proposed to be used:</td>
												<td><input type="text"  class="form-control text-uppercase" name="indication" value="<?php echo $indication;?>" > </td>
											</tr>
											<tr>
												<td width="25%">(vi) Manufacturer of the raw material (bulk drug substances)</td>
												<td><input type="text"  class="form-control text-uppercase" name="raw_mat" value="<?php echo $raw_mat;?>" > </td>
												<td width="25%">(vii) Patent status of the drug:</td>
												<td><input type="text"  class="form-control text-uppercase" name="patent" value="<?php echo $patent;?>" > </td>
											</tr>
											<tr>
												<td colspan="4">2. Data submitted along with the application (as per Schedule Y with indexing and page Nos.)</td>
											</tr>
											<tr>	
												<td colspan="4">A. Permission to market a new drug :</td>
											</tr>
											<tr>
												<td width="25%">(i) Chemical and Pharmaceutical information</td>
												<td><input type="text"  class="form-control text-uppercase" name="chemical" value="<?php echo $chemical;?>" > </td>
												<td width="25%">(ii) Animal Pharmacology</td>
												<td><input type="text"  class="form-control text-uppercase" name="animal" value="<?php echo $animal;?>" > </td>
											</tr>
											<tr>
												<td width="25%">(iii) Animal Toxicology</td>
												<td><input type="text"  class="form-control text-uppercase" name="toxicology" value="<?php echo $toxicology;?>" > </td>
												<td width="25%">(iv) Human/Clinical Pharmacology (Phase I)</td>
												<td><input type="text"  class="form-control text-uppercase" name="human" value="<?php echo $human;?>" > </td>
											</tr>
											<tr>
												<td width="25%">(v) Exploratory Clinical Trials (Phase II)</td>
												<td><input type="text"  class="form-control text-uppercase" name="clinical_p1" value="<?php echo $clinical_p1;?>" > </td>
												<td width="25%">(vi) Confirmatory Clinical Trials (Phase III) (including published review articles)</td>
												<td><input type="text"  class="form-control text-uppercase" name="clinical_p2" value="<?php echo $clinical_p2;?>" > </td>
											</tr>
											<tr>
												<td width="25%">(vii) Bio-availability, dissolution and stability study Data</td>
												<td><input type="text"  class="form-control text-uppercase" name="dissolution" value="<?php echo $dissolution;?>" > </td>
												<td width="25%">(viii) Regulatory status in other countries</td>
												<td><input type="text"  class="form-control text-uppercase" name="reg_status" value="<?php echo $reg_status;?>" > </td>
											</tr>
											<tr>
												<td colspan="4">(ix)Marketing information:</td>
											</tr>
											<tr>
												<td>(a) Proposed product monograph</td>
												<td><input type="text"  class="form-control text-uppercase" name="marketing[a]" value="<?php echo $marketing_a;?>" > </td>
												<td>(b) Drafts of labels and cartons</td>
												<td><input type="text"  class="form-control text-uppercase" name="marketing[b]" value="<?php echo $marketing_b?>" ></td>
											</tr>
											<tr>
												<td>(x) Application for test licence</td>
												<td><input type="text"  class="form-control text-uppercase" name="test_licence" value="<?php echo $test_licence;?>" > </td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">B. Subsequent approval/permission for manufacture of already approved new drug:</td>
											</tr>
											<tr>
												<td colspan="4">(a)Formulation</td>
											</tr>
											<tr>
												<td>(i) Bio-availability/bio- equivalence protocol</td>
												<td><input type="text"  class="form-control text-uppercase" name="formulation[a]" value="<?php echo $formulation_a;?>" > </td>
												<td>(ii) Name of the investigator/center</td>
												<td><input type="text"  class="form-control text-uppercase" name="formulation[b]" value="<?php echo $formulation_b;?>" > </td>
											</tr>
											<tr>
												<td>(iii) Source of raw material (bulk drug substances) and stability study data.</td>
												<td><input type="text"  class="form-control text-uppercase" name="formulation[c]" value="<?php echo $formulation_c;?>" > </td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">(b) Raw material (bulk drug substances)</td>
											</tr>
											<tr>
												<td>(i) Manufacturing method</td>
												<td><input type="text"  class="form-control text-uppercase" name="raw_material[a]" value="<?php echo $raw_material_a;?>" > </td>
												<td>(ii) Quality control parameters and/or analytical specification, stability report</td>
												<td><input type="text"  class="form-control text-uppercase" name="raw_material[b]" value="<?php echo $raw_material_b;?>" > </td>
											</tr>
											<tr>
												<td>(iii) Animal toxicity data</td>
												<td><input type="text"  class="form-control text-uppercase" name="raw_material[c]" value="<?php echo $raw_material_c;?>" > </td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">(c) Approval/Permission for fixed dose combination:</td>
											</tr>
											<tr>
												<td>(i) Therapeutic Justification (authentic literature in [peer-reviewed journals]/text books)</td>
												<td><input type="text"  class="form-control text-uppercase" name="fix_approval[a]" value="<?php echo $fix_approval_a;?>" > </td>
												<td>(ii) Data on pharmacokinetics/pharmacodynamics combination</td>
												<td><input type="text"  class="form-control text-uppercase" name="fix_approval[b]" value="<?php echo $fix_approval_b;?>" > </td>
											</tr>
											<tr>
												<td>(iii) Any other data generated by the applicant on the safety and efficacy of the combination.</td>
												<td><input type="text"  class="form-control text-uppercase" name="fix_approval[c]" value="<?php echo $fix_approval_c;?>" > </td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">(d) Subsequent Approval or approval for new indication-new dosage form:</td>
											</tr>
											<tr>
												<td>(i) Number and date of Approval/permission already granted.</td>
												<td><input type="text"  class="form-control text-uppercase" name="sub_approval[a]" value="<?php echo $sub_approval_a;?>" > </td>
												<td>(ii) Therapeutic Justification for new claim/modified dosage form.</td>
												<td><input type="text"  class="form-control text-uppercase" name="sub_approval[b]" value="<?php echo $sub_approval_b;?>" > </td>
											</tr>
											<tr>
												<td>(iii) Data generated on safety, efficacy and quality parameters.</td>
												<td><input type="text"  class="form-control text-uppercase" name="sub_approval[c]" value="<?php echo $sub_approval_c;?>" > </td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Date : </td>
												<td><label ><?php echo $today;?></label></td>
												<td>Signature : <br/>Designation :</td>
												<td><label><?php echo strtoupper($key_person)?></label><br/>
												<label><?php echo strtoupper($status_applicant)?></label></td>
											</tr>	  
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" style="font-weight:bold" name="save<?php echo $form;?>" class="btn btn-success">Save and Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>