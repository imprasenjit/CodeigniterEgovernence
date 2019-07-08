<?php
$dept="sdc";
$form="24";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	if($q->num_rows > 0){
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
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);
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
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.' <br/></h4>
	<br>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2"> I/We &nbsp;'.strtoupper($auth_person).'&nbsp; of M/S &nbsp;'.strtoupper($dist).' hereby apply for grant of permission for import of and/or clinical trial or for approval to manufacture a new drug or fixed dose combination or subsequent permission for already approved new drug. The necessary information/ data is given below:</td>
		</tr>
		<tr>
			<td colspan="2">1. Particulars of New Drug:</td>
		</tr>
		<tr>
			<td width="50%">(i) Name of the drug:</td>
			<td width="50%">'.strtoupper($drug_name).' </td>
		</tr>
		<tr>
			<td>(ii) Dosage Form:</td>
			<td>'.strtoupper($dosage_form).' </td>
		</tr>
		<tr>
			<td colspan="2">(iii) Test specification:</td>
		</tr>
		<tr>
			<td >(a) Active ingredients:</td>
			<td>'.strtoupper($test_spec_a).' </td>
		</tr>
		<tr>
			<td>(b) Inactive ingredients:</td>
			<td>'.strtoupper($test_spec_b).'</td>
		</tr>
		<tr>
			<td>(iv) Pharmacological classification of the drug:</td>
			<td>'.strtoupper($pharma_drug).'  </td>
		</tr>
		<tr>
			<td>(v) Indications for which proposed to be used:</td>
			<td>'.strtoupper($indication).'</td>
		</tr>
		<tr>
			<td>(vi) Manufacturer of the raw material (bulk drug substances)</td>
			<td>'.strtoupper($raw_mat).'</td>
		</tr>
		<tr>
			<td>(vii) Patent status of the drug:</td>
			<td>'.strtoupper($patent).'</td>
		</tr>
		<tr>
			<td colspan="2">2. Data submitted along with the application (as per Schedule Y with indexing and page Nos.)</td>
		</tr>
		<tr>	
			<td colspan="2">A. Permission to market a new drug :</td>
		</tr>
		<tr>
			<td>(i) Chemical and Pharmaceutical information</td>
			<td>'.strtoupper($chemical).' </td>
		</tr>
		<tr>
			<td >(ii) Animal Pharmacology</td>
			<td>'.strtoupper($animal).' </td>
		</tr>
		<tr>
			<td>(iii) Animal Toxicology</td>
			<td>'.strtoupper($toxicology).' </td>
		</tr>
		<tr>
			<td>(iv) Human/Clinical Pharmacology (Phase I)</td>
			<td>'.strtoupper($human).'</td>
		</tr>
		<tr>
			<td >(v) Exploratory Clinical Trials (Phase II)</td>
			<td>'.strtoupper($clinical_p1).' </td>
		</tr>
		<tr>
			<td >(vi) Confirmatory Clinical Trials (Phase III) (including published review articles)</td>
			<td>'.strtoupper($clinical_p2).'</td>
		</tr>
		<tr>
			<td>(vii) Bio-availability, dissolution and stability study Data</td>
			<td>'.strtoupper($dissolution).' </td>
		</tr>
		<tr>
			<td >(viii) Regulatory status in other countries</td>
			<td>'.strtoupper($reg_status).'  </td>
		</tr>
		<tr>
			<td colspan="4">(ix)Marketing information:</td>
		</tr>
		<tr>
			<td>(a) Proposed product monograph</td>
			<td>'.strtoupper($marketing_a).'</td>
		</tr>
		<tr>
			<td>(b) Drafts of labels and cartons</td>
			<td>'.strtoupper($marketing_b).'</td>
		</tr>
		<tr>
			<td>(x) Application for test licence</td>
			<td>'.strtoupper($test_licence).'</td>
		</tr>
		<tr>
			<td colspan="4">B. Subsequent approval/permission for manufacture of already approved new drug:</td>
		</tr>
		<tr>
			<td colspan="2">(a)Formulation</td>
		</tr>
		<tr>
			<td>(i) Bio-availability/bio- equivalence protocol</td>
			<td>'.strtoupper($formulation_a).' </td>
		</tr>
		<tr>
			<td>(ii) Name of the investigator/center</td>
			<td>'.strtoupper($formulation_b).'</td>
		</tr>
		<tr>
			<td>(iii) Source of raw material (bulk drug substances) and stability study data.</td>
			<td>'.strtoupper($formulation_c).' </td>
		</tr>
		<tr>
			<td colspan="2">(b) Raw material (bulk drug substances)</td>
		</tr>
		<tr>
			<td>(i) Manufacturing method</td>
			<td>'.strtoupper($raw_material_a).'</td>
		</tr>
		<tr>
			<td>(ii) Quality control parameters and/or analytical specification, stability report</td>
			<td>'.strtoupper($raw_material_b).'  </td>
		</tr>
		<tr>
			<td>(iii) Animal toxicity data</td>
			<td>'.strtoupper($raw_material_c).' </td>
		</tr>
		<tr>
			<td colspan="2">(c) Approval/Permission for fixed dose combination:</td>
		</tr>
		<tr>
			<td>(i) Therapeutic Justification (authentic literature in [peer-reviewed journals]/text books)</td>
			<td>'.strtoupper($fix_approval_a).' </td>
		</tr>
		<tr>
			<td>(ii) Data on pharmacokinetics/pharmacodynamics combination</td>
			<td>'.strtoupper($fix_approval_b).' </td>
		</tr>
		<tr>
			<td>(iii) Any other data generated by the applicant on the safety and efficacy of the combination.</td>
			<td>'.strtoupper($fix_approval_c).' </td>
		</tr>
		<tr>
			<td colspan="2">(d) Subsequent Approval or approval for new indication-new dosage form:</td>
		</tr>
		<tr>
			<td>(i) Number and date of Approval/permission already granted.</td>
			<td>'.strtoupper($sub_approval_a).'</td>
		</tr>
		<tr>
			<td>(ii) Therapeutic Justification for new claim/modified dosage form.</td>
			<td>'.strtoupper($sub_approval_b).' </td>
		</tr>
		<tr>
			<td>(iii) Data generated on safety, efficacy and quality parameters.</td>
			<td>'.strtoupper($sub_approval_c).'  </td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'			
					
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :&nbsp;<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>

