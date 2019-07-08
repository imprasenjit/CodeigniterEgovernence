<?php
$dept="pcb";
$form="45";
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
	$hcf_name=$results["hcf_name"];$fax_no=$results["fax_no"];$web_url=$results["web_url"];$gps_coord=$results["gps_coord"];$owner=$results["owner"];$water_act=$results["water_act"];$quant_recycle=$results["quant_recycle"];$num_vehicle=$results["num_vehicle"];$cbmwtf_op_nam=$results["cbmwtf_op_nam"];$do_you_bmw=$results["do_you_bmw"];$avail=$results["avail"];$are_you=$results["are_you"];$std_not_met=$results["std_not_met"];$details_coemsi=$results["details_coemsi"];$waste_gen_meth=$results["waste_gen_meth"];$std_not_met_year=$results["std_not_met_year"];$is_met=$results["is_met"];$std_not_met_year2=$results["std_not_met_year2"];$other_info=$results["other_info"];$name_hod=$results["name_hod"];$sign_hod=$results["sign_hod"];
	
	if($do_you_bmw=="Y") $do_you_bmw="YES";
	    else $do_you_bmw="NO";
	if($avail=="Y") $avail="YES";
	    else $avail="NO";
	if($are_you=="Y") $are_you="YES";
	    else $are_you="NO";
	if($is_met=="Y") $is_met="YES";
	    else $is_met="NO";
	if(!empty($results["bmw"])){
		$bmw=json_decode($results["bmw"]);
		$bmw_auth_no=$bmw->auth_no;$bmw_valid=$bmw->valid;
	}else{
		$bmw_auth_no="";$bmw_valid="";
	}
	if(!empty($results["hcf_type"])){
		$hcf_type=json_decode($results["hcf_type"]);
		$hcf_type_num_bed=$hcf_type->num_bed;$hcf_type_nbh=$hcf_type->nbh;$hcf_type_lic=$hcf_type->lic;$hcf_type_doe=$hcf_type->doe;
	}else{
		$hcf_type_num_bed="";$hcf_type_nbh="";$hcf_type_lic="";$hcf_type_doe="";
	}
	if(!empty($results["cbmwtf_details"])){
		$cbmwtf_details=json_decode($results["cbmwtf_details"]);
		$cbmwtf_details_nhcf=$cbmwtf_details->nhcf;$cbmwtf_details_nob=$cbmwtf_details->nob;$cbmwtf_details_it=$cbmwtf_details->it;$cbmwtf_details_qbwt=$cbmwtf_details->qbwt;
	}else{
		$cbmwtf_details_nhcf="";$cbmwtf_details_nob="";$cbmwtf_details_it="";$cbmwtf_details_qbwt="";
	}
	if(!empty($results["wasteq"])){
		$wasteq=json_decode($results["wasteq"]);
		$wasteq_yellow=$wasteq->yellow;$wasteq_red=$wasteq->red;$wasteq_white=$wasteq->white;$wasteq_blue=$wasteq->blue;$wasteq_gsw=$wasteq->gsw;
	}else{
		$wasteq_yellow="";$wasteq_red="";$wasteq_white="";$wasteq_blue="";$wasteq_gsw="";
	}
	if(!empty($results["details_ossf"])){
		$details_ossf=json_decode($results["details_ossf"]);
		$details_ossf_size=$details_ossf->size;$details_ossf_cap=$details_ossf->cap;$details_ossf_poss=$details_ossf->poss;
	}else{
		$details_ossf_size="";$details_ossf_cap="";$details_ossf_poss="";
	}
	if(!empty($results["num"])){
		$num=json_decode($results["num"]);
		$num_incnrat=$num->incnrat;$num_plsm=$num->plsm;$num_atclv=$num->atclv;$num_mw=$num->mw;$num_hyclv=$num->hyclv;$num_shrdr=$num->shrdr;$num_ndl=$num->ndl;$num_cp=$num->cp;$num_dbp=$num->dbp;$num_cd=$num->cd;$num_ot=$num->ot;
	}else{
		$num_incnrat="";$num_plsm="";$num_atclv="";$num_mw="";$num_hyclv="";$num_shrdr="";$num_ndl="";$num_cp="";$num_dbp="";$num_cd="";$num_ot="";
	}
	if(!empty($results["capacity"])){
		$capacity=json_decode($results["capacity"]);
		$capacity_incnrat=$capacity->incnrat;$capacity_plsm=$capacity->plsm;$capacity_atclv=$capacity->atclv;$capacity_mw=$capacity->mw;$capacity_hyclv=$capacity->hyclv;$capacity_shrdr=$capacity->shrdr;$capacity_ndl=$capacity->ndl;$capacity_cp=$capacity->cp;$capacity_dbp=$capacity->dbp;$capacity_cd=$capacity->cd;$capacity_ot=$capacity->ot;
	}else{
		$capacity_incnrat="";$capacity_plsm="";$capacity_atclv="";$capacity_mw="";$capacity_hyclv="";$capacity_shrdr="";$capacity_ndl="";$capacity_cp="";$capacity_dbp="";$capacity_cd="";$capacity_ot="";
	}
	if(!empty($results["quantity"])){
		$quantity=json_decode($results["quantity"]);
		$quantity_incnrat=$quantity->incnrat;$quantity_plsm=$quantity->plsm;$quantity_atclv=$quantity->atclv;$quantity_mw=$quantity->mw;$quantity_hyclv=$quantity->hyclv;$quantity_shrdr=$quantity->shrdr;$quantity_ndl=$quantity->ndl;$quantity_cp=$quantity->cp;$quantity_dbp=$quantity->dbp;$quantity_cd=$quantity->cd;$quantity_ot=$quantity->ot;
	}else{
		$quantity_incnrat="";$quantity_plsm="";$quantity_atclv="";$quantity_mw="";$quantity_hyclv="";$quantity_shrdr="";$quantity_ndl="";$quantity_cp="";$quantity_dbp="";$quantity_cd="";$quantity_ot="";
	}
	if(!empty($results["quant_gen"])){
		$quant_gen=json_decode($results["quant_gen"]);
		$quant_gen_incin=$quant_gen->incin;$quant_gen_ash=$quant_gen->ash;$quant_gen_etp=$quant_gen->etp;
	}else{
		$quant_gen_incin="";$quant_gen_ash="";$quant_gen_etp="";
	}
	if(!empty($results["bmw_details"])){
		$bmw_details=json_decode($results["bmw_details"]);
		$bmw_details_ntc=$bmw_details->ntc;$bmw_details_npt=$bmw_details->npt;$bmw_details_nptti=$bmw_details->nptti;$bmw_details_npnt=$bmw_details->npnt;$bmw_details_other=$bmw_details->other;
	}else{
		$bmw_details_ntc="";$bmw_details_npt="";$bmw_details_nptti="";$bmw_details_npnt="";$bmw_details_other="";
	}
	if(!empty($results["accid_details"])){
		$accid_details=json_decode($results["accid_details"]);
		$accid_details_nao=$accid_details->nao;$accid_details_npa=$accid_details->npa;$accid_details_rat=$accid_details->rat;$accid_details_afo=$accid_details->afo;
	}else{
		$accid_details_nao="";$accid_details_npa="";$accid_details_rat="";$accid_details_afo="";
	}
	if(!empty($results["whr_disposed"])){
		$whr_disposed=json_decode($results["whr_disposed"]);
		$whr_disposed_incin=$whr_disposed->incin;$whr_disposed_ash=$whr_disposed->ash;$whr_disposed_etp=$whr_disposed->etp;
	}else{
		$whr_disposed_incin="";$whr_disposed_ash="";$whr_disposed_etp="";
	}
	$accid_details_afo = wordwrap($accid_details_afo, 50, "<br/>", true);
	$details_coemsi = wordwrap($details_coemsi, 50, "<br/>", true);
	$other_info = wordwrap($other_info, 50, "<br/>", true);
}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
        <h4>'.$form_name.'</h4>
	</div>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">1. Particulars of Occupier:</td>
		</tr>
		<tr>
			<td>(i) Name of the authorised person (occupier or operator of facility) :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>(ii) Name of HCF or CBMWTF :</td>
			<td>'.strtoupper($hcf_name).'</td>
		</tr>
		<tr>
			<td>(iii) Address for Correspondence :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($street_name2).'</td>
				</tr>
				<tr>
						<td>Vill/Town</td>
						<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
						<td >Pincode</td>
						<td>'.strtoupper($pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
						<td>Phone Number </td>
						<td>'.$landline_std."-".$landline_no.'</td>
				</tr>
				<tr>
						<td>Email ID </td>
						<td>'.$email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(iv) Address of Facility :</td>
			<td>
				<table class="table table-bordered table-responsive">  
				<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
						<td>Vill/Town</td>
						<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
						<td >Pincode</td>
						<td>'.strtoupper($b_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile</td>
						<td>+91'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
						<td>Phone Number </td>
						<td>'.$b_landline_std."-".$b_landline_no.'</td>
				</tr>
				<tr>
						<td>Fax. No </td>
						<td>'.strtoupper($fax_no).'</td>
				</tr>
				<tr>
						<td>Email ID </td>
						<td>'.$b_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(v) URL of Website :</td>
			<td>'.strtoupper($web_url).'</td>
		</tr>
		<tr>
			<td>(vi) GPS coordinates of HCF or CBMWTF :</td>
			<td>'.strtoupper($gps_coord).'</td>
		</tr>
		<tr>
			<td>(vii) Ownership of HCF or CBMWTF :</td>
			<td>'.strtoupper($owner).'</td>
		</tr>
		<tr>
			<td>(viii) Status of Authorisation under the Bio-Medical Waste (Management and Handling) Rules :</td>
			<td>Authorisation No : '.strtoupper($bmw_auth_no).'<br/>Valid up to : '.strtoupper($bmw_valid).'</td>
		</tr>
		<tr>
			<td>(ix) Status of Consents under Water Act and Air Act :</td>
			<td>Valid up to : '.strtoupper($water_act).'</td>
		</tr>
		<tr>
			<td colspan="2">2. Type of Health Care Facility :</td>
		</tr>
		<tr>
			<td>(i) Bedded Hospital :</td>
			<td>No. of Beds : '.strtoupper($hcf_type_num_bed).'</td>
		</tr>
		<tr>
			<td>(ii) Non-bedded hospital :</td>
			<td>'.strtoupper($hcf_type_nbh).'</td>
		</tr>
		<tr>
			<td>(iii)(a) License number :</td>
			<td>'.strtoupper($hcf_type_lic).'</td>
		</tr>
		<tr>
			<td>(b)Date of expiry :</td>
			<td>'.strtoupper($hcf_type_doe).'</td>
		</tr>
		<tr>
			<td colspan="2">3. Details of CBMWTF :</td>
		</tr>
		<tr>
			<td>(i) Number healthcare facilities covered by CBMWTF :</td>
			<td>'.strtoupper($cbmwtf_details_nhcf).'</td>
		</tr>
		<tr>
			<td>(ii) No of beds covered by CBMWTF :</td>
			<td>'.strtoupper($cbmwtf_details_nob).'</td>
		</tr>
		<tr>
			<td>(iii) Installed treatment and disposal capacity of CBMWTF(Kg per day) :</td>
			<td>'.strtoupper($cbmwtf_details_it).'</td>
		</tr>
		<tr>
			<td>(iv) Quantity of biomedical waste treated or disposed by CBMWTF(Kg per day) :</td>
			<td>'.strtoupper($cbmwtf_details_qbwt).'</td>
		</tr>
		<tr>
			<td>4. Quantity of waste generated or disposed in Kg per annum (on monthly average basis) :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>Yellow Category</td>
						<td>'.strtoupper($wasteq_yellow).'</td>
				</tr>
				<tr>
						<td>Red Category</td>
						<td>'.strtoupper($wasteq_red).'</td>
				</tr>
				<tr>
						<td>White</td>
						<td>'.strtoupper($wasteq_white).'</td>
				</tr>
				<tr>
						<td>Blue Category</td>
						<td>'.strtoupper($wasteq_blue).'</td>
				</tr>
				<tr>
						<td>General Solid waste</td>
						<td>'.strtoupper($wasteq_gsw).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">5. Details of the Storage, treatment, transportation, processing and Disposal Facility :</td>
		</tr>
		<tr>
			<td>(i) Details of the on-site storage facility :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
				<tr>
						<td>Size</td>
						<td>'.strtoupper($details_ossf_size).'</td>
				</tr>
				<tr>
						<td>Capacity</td>
						<td>'.strtoupper($details_ossf_cap).'</td>
				</tr>
				<tr>
						<td>Provision of on-site storage</td>
						<td>'.strtoupper($details_ossf_poss).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(ii)Disposal facilities</td>
			<td>
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>Type of treatment equipment</th>
							<th>No of units</th>
							<th>Capacity (Kg/day)</th>
							<th>Quantity treatedor disposed in kg per annum</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Incinerators</td>
							<td>'.strtoupper($num_incnrat).'</td>
							<td>'.strtoupper($capacity_incnrat).'</td>
							<td>'.strtoupper($quantity_incnrat).'</td>
						</tr>
						<tr>
							<td>Plasma Pyrolysis</td>
							<td>'.strtoupper($num_plsm).'</td>
							<td>'.strtoupper($capacity_plsm).'</td>
							<td>'.strtoupper($quantity_plsm).'</td>
						</tr>
						<tr>
							<td>Autoclaves</td>
							<td>'.strtoupper($num_atclv).'</td>
							<td>'.strtoupper($capacity_atclv).'</td>
							<td>'.strtoupper($quantity_atclv).'</td>
						</tr>
						<tr>
							<td>Microwave</td>
							<td>'.strtoupper($num_mw).'</td>
							<td>'.strtoupper($capacity_mw).'</td>
							<td>'.strtoupper($quantity_mw).'</td>
						</tr>
						<tr>
							<td>Microwave</td>
							<td>'.strtoupper($num_hyclv).'</td>
							<td>'.strtoupper($capacity_hyclv).'</td>
							<td>'.strtoupper($quantity_hyclv).'</td>
						</tr>
						<tr>
							<td>Hydroclave</td>
							<td>'.strtoupper($num_shrdr).'</td>
							<td>'.strtoupper($capacity_shrdr).'</td>
							<td>'.strtoupper($quantity_shrdr).'</td>
						</tr>
						<tr>
							<td>Shredder</td>
							<td>'.strtoupper($num_ndl).'</td>
							<td>'.strtoupper($capacity_ndl).'</td>
							<td>'.strtoupper($quantity_ndl).'</td>
						</tr>
						<tr>
							<td>Needle tip cutter or destroyer</td>
							<td>'.strtoupper($num_cp).'</td>
							<td>'.strtoupper($capacity_cp).'</td>
							<td>'.strtoupper($quantity_cp).'</td>
						</tr>
						<tr>
							<td>Sharps encapsulation or concrete pit</td>
							<td>'.strtoupper($num_dbp).'</td>
							<td>'.strtoupper($capacity_dbp).'</td>
							<td>'.strtoupper($quantity_dbp).'</td>
						</tr>
						<tr>
							<td>Deep burial pits</td>
							<td>'.strtoupper($num_cd).'</td>
							<td>'.strtoupper($capacity_cd).'</td>
							<td>'.strtoupper($quantity_cd).'</td>
						</tr>
						<tr>
							<td>Any other treatment equipment</td>
							<td>'.strtoupper($num_ot).'</td>
							<td>'.strtoupper($capacity_ot).'</td>
							<td>'.strtoupper($quantity_ot).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>(iii) Quantity of recyclable wastes sold to authorized recyclers after treatment in kg per annum.</td>
			<td>'.strtoupper($quant_recycle).'</td>
		</tr>
		<tr>
			<td>(iv) No of vehicles used for collection and transportation of biomedical waste</td>
			<td>'.strtoupper($num_vehicle).'</td>
		</tr>
		<tr>
			<td>(v) Details of incineration ash and ETP sludge generated and disposed during the treatment of wastes in Kg per annum</td>
			<td>
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th></th>
							<th>Quantity generated</th>
							<th>Where disposed</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Incineration</td>
							<td>'.strtoupper($quant_gen_incin).'</td>
							<td>'.strtoupper($whr_disposed_incin).'</td>
						</tr>
						<tr>
							<td>Ash</td>
							<td>'.strtoupper($quant_gen_ash).'</td>
							<td>'.strtoupper($whr_disposed_ash).'</td>
						</tr>
						<tr>
							<td>ETP Sludge</td>
							<td>'.strtoupper($quant_gen_etp).'</td>
							<td>'.strtoupper($whr_disposed_etp).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>(vi) Name of the Common Bio-Medical Waste Treatment Facility Operator through which wastes are disposed of</td>
			<td>'.strtoupper($cbmwtf_op_nam).'</td>
		</tr>
		<tr>
			<td>(vii) List of member HCF not handed over bio-medical waste</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td>6. Do you have bio-medical waste management committee?</td>
			<td>'.strtoupper($do_you_bmw).'</td>
		</tr>
		<tr>
			<td colspan="2">7. Details trainings conducted on BMW</td>
		</tr>
		<tr>
			<td>(i) Number of trainings conducted on BMW Management</td>
			<td>'.strtoupper($bmw_details_ntc).'</td>
		</tr>
		<tr>
			<td>(ii) number of personnel trained</td>
			<td>'.strtoupper($bmw_details_npt).'</td>
		</tr>
		<tr>
			<td>(iii) number of personnel trained at the time of induction</td>
			<td>'.strtoupper($bmw_details_nptti).'</td>
		</tr>
		<tr>
			<td>(iv) number of personnel not undergone any training so far</td>
			<td>'.strtoupper($bmw_details_npnt).'</td>
		</tr>
		<tr>
			<td>(v) whether standard manual for training is available?</td>
			<td>'.strtoupper($avail).'</td>
		</tr>
		<tr>
			<td>(vi) any other information</td>
			<td>'.strtoupper($bmw_details_other).'</td>
		</tr>
		<tr>
			<td colspan="2">8. Details of the accident occurred during the year</td>
		</tr>
		<tr>
			<td>(i) Number of Accidents occurred</td>
			<td>'.strtoupper($accid_details_nao).'</td>
		</tr>
		<tr>
			<td>(ii) Number of the persons affected</td>
			<td>'.strtoupper($accid_details_npa).'</td>
		</tr>
		<tr>
			<td>(iii) Remedial Action taken</td>
			<td>'.strtoupper($accid_details_rat).'</td>
		</tr>
		<tr>
			<td>(iv) Any Fatality occurred, details</td>
			<td>'.strtoupper($accid_details_afo).'</td>
		</tr>
		<tr>
			<td>9.(a) Are you meeting the standards of air Pollution from the incinerator?</td>
			<td>'.strtoupper($are_you).'</td>
		</tr>
		<tr>
			<td>(b) How many times in last year could not met the standards?</td>
			<td>'.strtoupper($std_not_met).'</td>
		</tr>
		<tr>
			<td>(c) Details of Continuous online emission monitoring systems installed</td>
			<td>'.strtoupper($details_coemsi).'</td>
		</tr>
		<tr>
			<td>10.(a) Liquid waste generated and treatment methods in place</td>
			<td>'.strtoupper($waste_gen_meth).'</td>
		</tr>
		<tr>
			<td>(b) How many times you have not met the standards in a year?</td>
			<td>'.strtoupper($std_not_met_year).'</td>
		</tr>
		<tr>
			<td>11.(a)Is the disinfection method or sterilization  meeting the  log 4 standards?</td>
			<td>'.strtoupper($is_met).'</td>
		</tr>
		<tr>
			<td>(b)How many times you have not met the standards in a year?</td>
			<td>'.strtoupper($std_not_met_year2).'</td>
		</tr>
		<tr>
			<td>12. Any other relevant information</td>
			<td>'.strtoupper($other_info).'</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
            <td >Date:<b>'.date('d-m-Y',strtotime($today)).'</b><br/>Place:<b>'.strtoupper($dist).'</b></td>
            <td align="right">
				Name of the Head of the Institution : <b>'.strtoupper($name_hod).'</b><br/>
				Signature of the Head of the Institution : <b>'.strtoupper($sign_hod).'</b>            
            </td>
        </tr>  
	</table>';
?>