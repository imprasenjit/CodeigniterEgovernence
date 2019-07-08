<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="45";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_bw_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$hcf_name=$results["hcf_name"];$fax_no=$results["fax_no"];$web_url=$results["web_url"];$gps_coord=$results["gps_coord"];$owner=$results["owner"];$water_act=$results["water_act"];$quant_recycle=$results["quant_recycle"];$num_vehicle=$results["num_vehicle"];$cbmwtf_op_nam=$results["cbmwtf_op_nam"];$do_you_bmw=$results["do_you_bmw"];$avail=$results["avail"];$are_you=$results["are_you"];$std_not_met=$results["std_not_met"];$details_coemsi=$results["details_coemsi"];$waste_gen_meth=$results["waste_gen_meth"];$std_not_met_year=$results["std_not_met_year"];$is_met=$results["is_met"];$std_not_met_year2=$results["std_not_met_year2"];$other_info=$results["other_info"];$name_hod=$results["name_hod"];$sign_hod=$results["sign_hod"];
		
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
	}else{	 
		$form_id="";
		$hcf_name="";$fax_no="";$web_url="";$gps_coord="";$owner="";$quant_recycle="";$num_vehicle="";$cbmwtf_op_nam="";$do_you_bmw="";$avail="";$are_you="";$std_not_met="";$details_coemsi="";$waste_gen_meth="";$std_not_met_year="";$is_met="";$std_not_met_year2="";$other_info="";$name_hod="";$sign_hod="";
		$bmw_auth_no="";$bmw_valid="";$water_act="";$hcf_type_bh="";$hcf_type_num_bed="";$hcf_type_nbh="";$hcf_type_lic="";$hcf_type_doe="";$hcf_type_num_bed="";$hcf_type_nbh="";$hcf_type_lic="";$hcf_type_doe="";$cbmwtf_details_nhcf="";$cbmwtf_details_nob="";$cbmwtf_details_it="";$cbmwtf_details_qbwt="";$wasteq_yellow="";$wasteq_red="";$wasteq_white="";$wasteq_blue="";$wasteq_gsw="";$details_ossf_size="";$details_ossf_cap="";$details_ossf_poss="";$num_incnrat="";$num_plsm="";$num_atclv="";$num_mw="";$num_hyclv="";$num_shrdr="";$num_ndl="";$num_cp="";$num_dbp="";$num_cd="";$num_ot="";$capacity_incnrat="";$capacity_plsm="";$capacity_atclv="";$capacity_mw="";$capacity_hyclv="";$capacity_shrdr="";$capacity_ndl="";$capacity_cp="";$capacity_dbp="";$capacity_cd="";$capacity_ot="";$quantity_incnrat="";$quantity_plsm="";$quantity_atclv="";$quantity_mw="";$quantity_hyclv="";$quantity_shrdr="";$quantity_ndl="";$quantity_cp="";$quantity_dbp="";$quantity_cd="";$quantity_ot="";$quant_gen_incin="";$quant_gen_ash="";$quant_gen_etp="";$bmw_details_ntc="";$bmw_details_npt="";$bmw_details_nptti="";$bmw_details_npnt="";$bmw_details_other="";$accid_details_nao="";$accid_details_npa="";$accid_details_rat="";$accid_details_afo="";$whr_disposed_incin="";$whr_disposed_ash="";$whr_disposed_etp="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$hcf_name=$results["hcf_name"];$fax_no=$results["fax_no"];$web_url=$results["web_url"];$gps_coord=$results["gps_coord"];$owner=$results["owner"];$water_act=$results["water_act"];$quant_recycle=$results["quant_recycle"];$num_vehicle=$results["num_vehicle"];$cbmwtf_op_nam=$results["cbmwtf_op_nam"];$do_you_bmw=$results["do_you_bmw"];$avail=$results["avail"];$are_you=$results["are_you"];$std_not_met=$results["std_not_met"];$details_coemsi=$results["details_coemsi"];$waste_gen_meth=$results["waste_gen_meth"];$std_not_met_year=$results["std_not_met_year"];$is_met=$results["is_met"];$std_not_met_year2=$results["std_not_met_year2"];$other_info=$results["other_info"];$name_hod=$results["name_hod"];$sign_hod=$results["sign_hod"];
	
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
}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part III</a></li>
							</ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">1. Particulars of the Occupier</td>
									</tr>
									<tr>
										<td width="25%">(i) Name of the authorised person (occupier or operator offacility) :</td>
										<td width="25%"><input type="text" name="" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled="disabled"></td>
										<td width="25%">(ii) Name of HCF or CBMWTF :</td>
										<td width="25%"><input type="text" name="hcf_name" value="<?php echo $hcf_name; ?>" validate="specialChar" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">(iii) Address for Correspondence :</td>
									</tr>
									<tr>
										<td>Street Name1:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $street_name1; ?>" disabled></td>
										<td>Street Name2:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $street_name2; ?>" disabled></td>
									</tr>
									<tr>
										<td>Vill/Town:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $vill; ?>" disabled></td>
										<td>District:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $dist; ?>" disabled></td>
									</tr>
									<tr>
										<td>PIN Code:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $pincode; ?>" disabled></td>
										<td>Mobile No:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $mobile_no; ?>" disabled></td>
									</tr>
									<tr>
										<td>Phone Number:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $landline_std."-".$landline_no; ?>" disabled></td>
										<td>E-mail ID</td>
										<td><input class="form-control" type="text" name="" value="<?php echo $email; ?>" disabled></td>
									</tr>
									<tr>
										<td colspan="4">(iv) Address of Facility :</td>
									</tr>
									<tr>
										<td>Street Name1:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
										<td>Street Name2:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
									</tr>
									<tr>
										<td>Vill/Town:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
										<td>District:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
									</tr>
									<tr>
										<td>Pincode:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
										<td>Mobile No:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled></td>
									</tr>
									<tr>
										<td>Phone Number:</td>
										<td><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
										<td>Fax. No :</td>
										<td><input type="text" name="fax_no" value="<?php echo $fax_no; ?>" validate="onlyNumbers" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>E-mail ID :</td>
										<td><input type="text" name="" value="<?php echo $b_email; ?>" class="form-control" disabled></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td>(v) URL of Website :</td>
										<td><input type="text" name="web_url" value="<?php echo $web_url; ?>" validate="jsonObj" class="form-control"></td>
										<td>(vi) GPS coordinates of HCF or CBMWTF  :</td>
										<td><input type="text" validate="specialChar" name="gps_coord" value="<?php echo $gps_coord; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(vii) Ownership of HCF or CBMWTF  :</td>
										<td><select class="form-control text-uppercase" name="owner" required>
											<option value="State Government" class="form-control text-uppercase" <?php if(isset($owner) && $owner=="State Government") echo 'selected'; ?>>State Government</option>
											<option value="Private" class="form-control text-uppercase" <?php if(isset($owner) && $owner=="Private") echo 'selected'; ?>>Private</option>
											<option value="Semi Govt." class="form-control text-uppercase" <?php if(isset($owner) && $owner=="Semi Govt.") echo 'selected'; ?>>Semi Govt.</option>
											<option value="other" class="form-control text-uppercase" <?php if(isset($owner) && $owner=="other") echo 'selected'; ?>>other</option>
										</select></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="4">(viii) Status of Authorisation under the Bio-Medical Waste (Management and Handling) Rules</td>
									</tr>
									<tr>
										<td>(a) Authorisation No.:</td>
									    <td><input type="text" name="bmw[auth_no]" value="<?php echo $bmw_auth_no; ?>" class="form-control text-uppercase" validate="specialChar"></td>
										<td>(b)Valid up to :</td>
										<td><input type="text" name="bmw[valid]" value="<?php echo $bmw_valid; ?>" class="dob form-control text-uppercase" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">(ix) Status of Consents under Water Act and Air Act :</td>
									</tr>
									<tr>
										<td>Valid up to :</td>
										<td><input type="text" name="water_act" readonly="readonly" value="<?php echo $water_act; ?>" class="dob form-control text-uppercase"></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="4">2. Type of Health Care Facility :</td>
									</tr>
									<tr>
										<td colspan="4">(i)Bedded Hospital :</td>
									</tr>
									<tr>
										<td>No. of Beds</td>
										<td><input type="text" name="hcf_type[num_bed]" value="<?php echo $hcf_type_num_bed; ?>" class="form-control text-uppercase" validate="onlyNumbers"></td>
										<td>(ii) Non-bedded hospital :</td>
										<td><select class="form-control text-uppercase" name="hcf_type[nbh]" validate="jsonObj" required>
											<option value="Clinic" class="form-control text-uppercase" <?php if(isset($hcf_type_nbh) && $hcf_type_nbh=="Clinic") echo 'selected'; ?>>Clinic</option>
											<option value="Blood Bank" class="form-control text-uppercase" <?php if(isset($hcf_type_nbh) && $hcf_type_nbh=="Blood Bank") echo 'selected'; ?>>Blood Bank</option>
											<option value="Clinical Laboratory" class="form-control text-uppercase" <?php if(isset($hcf_type_nbh) && $hcf_type_nbh=="Clinical Laboratory") echo 'selected'; ?>>Clinical Laboratory</option>
											<option value="Veterinary Hospital" class="form-control text-uppercase" <?php if(isset($hcf_type_nbh) && $hcf_type_nbh=="Veterinary Hospital") echo 'selected'; ?>>Veterinary Hospital</option>
											<option value="any other" class="form-control text-uppercase" <?php if(isset($hcf_type_nbh) && $hcf_type_nbh=="any other") echo 'selected'; ?>>any other</option>
										</select>
										</td>
									</tr>
									<tr>
										<td>(iii)(a) License number :</td>
										<td><input type="text" name="hcf_type[lic]" value="<?php echo $hcf_type_lic; ?>" class="form-control text-uppercase" validate="specialChar"></td>
										<td>(b)Date of expiry :</td>
										<td><input type="text" name="hcf_type[doe]" readonly="readonly" value="<?php echo $hcf_type_doe; ?>" class="dob form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">3. Details of CBMWTF :</td>
									</tr>
									<tr>
										<td>(i) Number healthcare facilities covered by CBMWTF :</td>
										<td><input type="text" name="cbmwtf_details[nhcf]" value="<?php echo $cbmwtf_details_nhcf; ?>" class="form-control text-uppercase" validate="specialChar"></td>
										<td>(ii) No of beds covered by CBMWTF :</td>
										<td><input type="text" name="cbmwtf_details[nob]" value="<?php  echo $cbmwtf_details_nob; ?>" class="form-control text-uppercase" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td>(iii) Installed treatment and disposal capacity of CBMWTF(Kg per day) :</td>
										<td><input type="text" name="cbmwtf_details[it]" value="<?php echo $cbmwtf_details_it;  ?>" class="form-control text-uppercase" validate="decimal"></td>
										<td>(iv) Quantity of biomedical waste treated or disposed by CBMWTF(Kg per day) :</td>
										<td><input type="text" name="cbmwtf_details[qbwt]" value="<?php echo $cbmwtf_details_qbwt; ?>" class="form-control text-uppercase" validate="decimal"></td>
									</tr>
									<tr>
										<td colspan="4">4. Quantity of waste generated or disposed in Kg per annum (on monthly average basis)</td>
									</tr>
									<tr>
										<td>(i)Yellow Category :</td>
										<td><input type="text" name="wasteq[yellow]" value="<?php echo $wasteq_yellow; ?>" class="form-control text-uppercase" validate="decimal"></td>
										<td>(ii)Red Category :</td>
										<td><input type="text" name="wasteq[red]" value="<?php echo $wasteq_red; ?>" class="form-control text-uppercase" validate="decimal"></td>
									</tr>
									<tr>
										<td>(iii)White :</td>
										<td><input type="text" name="wasteq[white]" value="<?php echo $wasteq_white; ?>" class="form-control text-uppercase" validate="decimal"></td>
										<td>(iv)Blue Category :</td>
										<td><input type="text" name="wasteq[blue]" value="<?php echo $wasteq_blue; ?>" class="form-control text-uppercase" validate="decimal"></td>
									</tr>
									<tr>
										<td>(v)General Solid waste :</td>
										<td><input type="text" name="wasteq[gsw]" value="<?php echo $wasteq_gsw; ?>" class="form-control text-uppercase" validate="decimal"></td>
										<td colspan="2"></td>
									</tr>	
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">5. Details of the Storage, treatment, transportation, processing and Disposal Facility :</td>
									</tr>
									<tr>
										<td colspan="4">(i) Details of the on-site storage facility :</td>
									</tr>
									<tr>
										<td width="25%">(a)Size :</td>
										<td width="25%"><input type="text" name="details_ossf[size]" value="<?php echo $details_ossf_size; ?>" class="form-control text-uppercase" validate="specialChar"></td>
										<td width="25%">(b)Capacity :</td>
										<td width="25%"><input type="text" name="details_ossf[cap]" value="<?php echo $details_ossf_cap; ?>" class="form-control text-uppercase" validate="specialChar"></td>
									</tr>
									<tr>
										<td>(c)Provision of on-site storage : (cold storage or any other provision)</td>
										<td><select class="form-control text-uppercase" name="details_ossf[poss]" validate="jsonObj" required>
											<option value="cold storage" class="form-control text-uppercase" <?php if(isset($details_ossf_poss) && $details_ossf_poss=="cold storage") echo 'selected'; ?>>cold storage</option>
											<option value="any other provision" class="form-control text-uppercase" <?php if(isset($details_ossf_poss) && $details_ossf_poss=="any other provision") echo 'selected'; ?>>any other provision</option>
										</select></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="4">(ii) Disposal Facility :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table" width="99%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">  
											<thead>
												<tr>
													<th>Type of treatment equipment</th>
													<th>No of units</th>
													<th>Capacity (Kg/day)</th>
													<th>Quantity treated or disposed in kg per annum</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Incinerators :</td>
													<td><input type="text" name="num[incnrat]" value="<?php echo $num_incnrat; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[incnrat]" value="<?php echo $capacity_incnrat; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[incnrat]" value="<?php echo $quantity_incnrat; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Plasma Pyrolysis :</td>
													<td><input type="text" name="num[plsm]" value="<?php echo $num_plsm; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[plsm]" value="<?php echo $capacity_plsm; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[plsm]" value="<?php echo $quantity_plsm; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Autoclaves :</td>
													<td><input type="text" name="num[atclv]" value="<?php echo $num_atclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[atclv]" value="<?php echo $capacity_atclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[atclv]" value="<?php echo $quantity_atclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Microwave :</td>
													<td><input type="text" name="num[mw]" value="<?php echo $num_mw; ?>"validate="jsonObj"  class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[mw]" value="<?php echo $capacity_mw; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[mw]" value="<?php echo $quantity_mw; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Hydroclave :</td>
													<td><input type="text" name="num[hyclv]" value="<?php echo $num_hyclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[hyclv]" value="<?php echo $capacity_hyclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[hyclv]" value="<?php echo $quantity_hyclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Shredder :</td>
													<td><input type="text" name="num[shrdr]" value="<?php echo $num_shrdr; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[shrdr]" value="<?php echo $capacity_shrdr; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[shrdr]" value="<?php echo $quantity_shrdr; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Needle tip cutter or destroyer :</td>
													<td><input type="text" name="num[ndl]" value="<?php echo $num_ndl; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[ndl]" value="<?php echo $capacity_ndl; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[ndl]" value="<?php echo $quantity_ndl; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Sharps encapsulation or concrete pit :</td>
													<td><input type="text" name="num[cp]" value="<?php echo $num_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[cp]" value="<?php echo $capacity_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[cp]" value="<?php echo $quantity_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Deep burial pits:</td>
													<td><input type="text" name="num[dbp]" value="<?php echo $num_dbp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[dbp]" value="<?php echo $capacity_dbp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[dbp]" value="<?php echo $quantity_dbp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Chemical disinfection :</td>
													<td><input type="text" name="num[cd]" value="<?php echo $num_cd; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[cd]" value="<?php echo $capacity_cd; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[cd]" value="<?php echo $quantity_cd; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
												<tr>
													<td>Any other treatment equipment :</td>
													<td><input type="text" name="num[ot]" value="<?php echo $num_ot; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="capacity[ot]" value="<?php echo $capacity_ot; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													<td><input type="text" name="quantity[ot]" value="<?php echo $quantity_ot; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
												</tr>
											</tbody>
										</table>
										</td>
									</tr>
									<tr>
										<td>(iii) Quantity of recyclable wastes sold to authorized recyclers after treatment in kg per annum.</td>
										<td><input type="text" name="quant_recycle" value="<?php echo $quant_recycle; ?>" class="form-control text-uppercase" validate="decimal"></td>
										<td>(iv) No of vehicles used for collection and transportation of biomedical waste</td>
										<td><input type="text" name="num_vehicle" value="<?php echo $num_vehicle; ?>" class="form-control text-uppercase" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td colspan="4">(v) Details of incineration ash and ETP sludge generated and disposed during the treatment of wastes in Kg per annum</td>
									</tr>
									<tr>
										<td colspan="4">
											<table class="table" width="99%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">  
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
														<td><input type="text" name="quant_gen[incin]" value="<?php echo $quant_gen_incin; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
														<td><input type="text" name="whr_disposed[incin]" value="<?php echo $whr_disposed_incin; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													</tr>
													<tr>
														<td>Ash</td>
														<td><input type="text" name="quant_gen[ash]" value="<?php echo $quant_gen_ash; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
														<td><input type="text" name="whr_disposed[ash]" value="<?php echo $whr_disposed_ash; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													</tr>
													<tr>
														<td>ETP Sludge</td>
														<td><input type="text" name="quant_gen[etp]" value="<?php echo $quant_gen_etp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
														<td><input type="text" name="whr_disposed[etp]" value="<?php echo $whr_disposed_etp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr>
										<td>(vi) Name of the Common Bio-Medical Waste Treatment Facility Operator through which wastes are disposed of :</td>
										<td><input type="text" name="cbmwtf_op_nam" value="<?php echo $cbmwtf_op_nam; ?>" class="form-control text-uppercase"></td>
										<td>(vii) List of member HCF not handed over bio-medical waste :</td>
										<td>Upload later in Upload Section</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="fileUpload" id="dic1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">	
									<tr>
										<td width="25%">6. Do you have bio-medical waste management committee?</td>
										<td width="25%">
											<label class="radio-inline"><input type="radio" name="do_you_bmw" value="Y"  <?php if(isset($do_you_bmw) && $do_you_bmw=='Y') echo 'checked'; ?> required /> Yes</label>
											<label class="radio-inline"><input type="radio" name="do_you_bmw"  value="N"  <?php if(isset($do_you_bmw) && $do_you_bmw=='N') echo 'checked'; ?> required /> No</label></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="4">7. Details trainings conducted on BMW :</td>
									</tr>
									<tr>
										<td>(i) Number of trainings conducted on BMW Management :</td>
										<td><input type="text" name="bmw_details[ntc]" value="<?php echo $bmw_details_ntc; ?>" class="form-control text-uppercase"></td>
										<td>(ii) number of personnel trained :</td>
										<td><input type="text" name="bmw_details[npt]" value="<?php echo $bmw_details_npt; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(iii) number of personnel trained at the time of induction :</td>
										<td><input type="text" name="bmw_details[nptti]" value="<?php echo $bmw_details_nptti; ?>" class="form-control text-uppercase"></td>
										<td>(iv) number of personnel not undergone any training so far :</td>
										<td><input type="text" name="bmw_details[npnt]" value="<?php echo $bmw_details_npnt; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(v) whether standard manual for training is available?</td>
										<td><label class="radio-inline"><input type="radio" name="avail" value="Y"  <?php if(isset($avail) && $avail=='Y') echo 'checked'; ?> required /> Yes</label>
											<label class="radio-inline"><input type="radio" name="avail"  value="N"  <?php if(isset($avail) && $avail=='N') echo 'checked'; ?> required /> No</label></td>
										<td>(vi) any other information :</td>
										<td><input type="text" name="bmw_details[other]" value="<?php echo $bmw_details_other; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">8. Details of the accident occurred during the year :</td>
									</tr>
									<tr>
										<td>(i) Number of Accidents occurred :</td>
										<td><input type="text" name="accid_details[nao]" value="<?php echo $accid_details_nao; ?>" class="form-control text-uppercase"></td>
										<td>(ii) Number of the persons affected :</td>
										<td><input type="text" name="accid_details[npa]" value="<?php echo $accid_details_npa; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(iii) Remedial Action taken :</td>
										<td><input type="text" name="accid_details[rat]" value="<?php echo $accid_details_rat; ?>" class="form-control text-uppercase"></td>
										<td>(iv) Any Fatality occurred, details :</td>
										<td><textarea name="accid_details[afo]"  id="" class="form-control text-uppercase" validate="textarea" ><?php echo $accid_details_afo; ?></textarea></td>
									</tr>
									<tr>
										<td>9.(a) Are you meeting the standards of air Pollution from the incinerator? </td>
										<td><label class="radio-inline"><input type="radio" name="are_you" value="Y"  <?php if(isset($are_you) && $are_you=='Y') echo 'checked'; ?> required /> Yes</label>
											<label class="radio-inline"><input type="radio" name="are_you"  value="N"  <?php if(isset($are_you) && $are_you=='N') echo 'checked'; ?> required /> No</label></td>
										<td>(b) How many times in last year could not met the standards?</td>
										<td><input type="text" name="std_not_met" value="<?php echo $std_not_met; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(c) Details of Continuous online emission monitoring systems installed</td>
										<td><textarea name="details_coemsi" id="" class="form-control text-uppercase" validate="textarea" ><?php echo $details_coemsi; ?></textarea></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td>10.(a) Liquid waste generated and treatment methods in place.</td>
										<td><input type="text" name="waste_gen_meth" value="<?php echo $waste_gen_meth; ?>" class="form-control text-uppercase"></td>
										<td>(b) How many times you have not met the standards in a year?</td>
										<td><input type="text" name="std_not_met_year" value="<?php echo $std_not_met_year; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>11.(a)Is the disinfection method or sterilization  meeting the  log 4 standards?</td>
										<td><label class="radio-inline"><input type="radio" name="is_met" value="Y"  <?php if(isset($is_met) && $is_met=='Y') echo 'checked'; ?> required /> Yes</label>
											<label class="radio-inline"><input type="radio" name="is_met"  value="N"  <?php if(isset($is_met) && $is_met=='N') echo 'checked'; ?> required /> No</label></td>
										<td>(b)How many times you have not met the standards in a year?</td>
										<td><input type="text" name="std_not_met_year2" value="<?php echo $std_not_met_year2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>12. Any other relevant information</td>
										<td><textarea name="other_info" id="" class="form-control text-uppercase" validate="textarea" ><?php echo $other_info; ?></textarea></td>
										<td colspan="2"></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-y',strtotime($today)); ?></label></td>
										<td align="right">Name of the Head of the Institution : </td>
										<td><input type="text" name="name_hod" value="<?php echo $name_hod; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="2">Place: <label><?php echo strtoupper($dist)?></label></td>
										<td align="right">Signature of the Head of the Institution : </td>
										<td><input type="text" name="sign_hod" value="<?php echo $sign_hod; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>