<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="44";
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
		$facility_name=$results["facility_name"];$applic_tele_no=$results["applic_tele_no"];$applic_fax_no=$results["applic_fax_no"];$applic_web_addr=$results["applic_web_addr"];$fresh_renew=$results["fresh_renew"];$if_applied=$results["if_applied"];$prev_auth_no=$results["prev_auth_no"];$renew_date=$results["renew_date"];$under_water=$results["under_water"];$under_air=$results["under_air"];$facility_coord=$results["facility_coord"];$recycl_waste_quantity=$results["recycl_waste_quantity"];$recycl_waste_method=$results["recycl_waste_method"];$waste_sharp_quantity=$results["waste_sharp_quantity"];$waste_sharp_method=$results["waste_sharp_method"];$mode_trans=$results["mode_trans"];$auth_details=$results["auth_details"];

		if(!empty($results["auth_sght"])){
			$auth_sght=json_decode($results["auth_sght"]);
			if(isset($auth_sght->gen)) $auth_sght_gen=$auth_sght->gen;
			else $auth_sght_gen="";
			if(isset($auth_sght->seg)) $auth_sght_seg=$auth_sght->seg;
			else $auth_sght_seg="";
			if(isset($auth_sght->coll)) $auth_sght_coll=$auth_sght->coll;
			else $auth_sght_coll="";
			if(isset($auth_sght->store)) $auth_sght_store=$auth_sght->store;
			else $auth_sght_store="";
			if(isset($auth_sght->packg)) $auth_sght_packg=$auth_sght->packg;
			else $auth_sght_packg="";
			if(isset($auth_sght->recept)) $auth_sght_recept=$auth_sght->recept;
			else $auth_sght_recept="";
			if(isset($auth_sght->trans)) $auth_sght_trans=$auth_sght->trans;
			else $auth_sght_trans="";
			if(isset($auth_sght->treat)) $auth_sght_treat=$auth_sght->treat;
			else $auth_sght_treat="";
			if(isset($auth_sght->proc)) $auth_sght_proc=$auth_sght->proc;
			else $auth_sght_proc="";
			if(isset($auth_sght->con)) $auth_sght_con=$auth_sght->con;
			else $auth_sght_con="";
			if(isset($auth_sght->recyle)) $auth_sght_recyle=$auth_sght->recyle;
			else $auth_sght_recyle="";
			if(isset($auth_sght->dispose)) $auth_sght_dispose=$auth_sght->dispose;
			else $auth_sght_dispose="";
			if(isset($auth_sght->destruct)) $auth_sght_destruct=$auth_sght->destruct;
			else $auth_sght_destruct="";
			if(isset($auth_sght->uses)) $auth_sght_uses=$auth_sght->uses;
			else $auth_sght_uses="";
			if(isset($auth_sght->sale)) $auth_sght_sale=$auth_sght->sale;
			else $auth_sght_sale="";
			if(isset($auth_sght->transfer)) $auth_sght_transfer=$auth_sght->transfer;
			else $auth_sght_transfer="";
			if(isset($auth_sght->other)) $auth_sght_other=$auth_sght->other;
			else $auth_sght_transfer="";
		}else{
			$auth_sght_gen="";$auth_sght_seg="";$auth_sght_coll="";$auth_sght_store="";$auth_sght_packg="";$auth_sght_recept="";$auth_sght_trans="";$auth_sght_treat="";$auth_sght_proc="";$auth_sght_con="";$auth_sght_recyle="";$auth_sght_dispose="";$auth_sght_destruct="";$auth_sght_uses="";$auth_sght_sale="";$auth_sght_transfer="";$auth_sght_other="";
		}
		if(!empty($results["health_care"])){
			$health_care=json_decode($results["health_care"]);
			$health_care_sn1=$health_care->sn1;$health_care_sn2=$health_care->sn2;$health_care_vt=$health_care->vt;$health_care_dist=$health_care->dist;$health_care_pin=$health_care->pin;
		}else{
			$health_care_sn1="";$health_care_sn2="";$health_care_vt="";$health_care_dist="";$health_care_pin="";
		}
		if(!empty($results["hcf"])){
			$hcf=json_decode($results["hcf"]);
			$hcf_num_bed=$hcf->num_bed;$hcf_pt=$hcf->pt;$hcf_fac=$hcf->fac;
		}else{
			$hcf_num_bed="";$hcf_pt="";$hcf_fac="";
		}
		if(!empty($results["cbmwtf"])){
			$cbmwtf=json_decode($results["cbmwtf"]);
			$cbmwtf_num_bed=$cbmwtf->num_bed;$cbmwtf_capacity=$cbmwtf->capacity;$cbmwtf_quantity=$cbmwtf->quantity;$cbmwtf_area=$cbmwtf->area;
		}else{
			$cbmwtf_num_bed="";$cbmwtf_capacity="";$cbmwtf_quantity="";$cbmwtf_area="";
		}
		if(!empty($results["yellow_qnt"])){
			$yellow_qnt=json_decode($results["yellow_qnt"]);
			$yellow_qnt_haw=$yellow_qnt->haw;$yellow_qnt_aaw=$yellow_qnt->aaw;$yellow_qnt_sw=$yellow_qnt->sw;$yellow_qnt_edm=$yellow_qnt->edm;$yellow_qnt_csw=$yellow_qnt->csw;$yellow_qnt_clw=$yellow_qnt->clw;$yellow_qnt_discard=$yellow_qnt->discard;$yellow_qnt_microb=$yellow_qnt->microb;
		}else{
			$yellow_qnt_haw="";$yellow_qnt_aaw="";$yellow_qnt_sw="";$yellow_qnt_edm="";$yellow_qnt_csw="";$yellow_qnt_clw="";$yellow_qnt_discard="";$yellow_qnt_microb="";
		}
		if(!empty($results["yellow_meth"])){
			$yellow_meth=json_decode($results["yellow_meth"]);
			$yellow_meth_haw=$yellow_meth->haw;$yellow_meth_aaw=$yellow_meth->aaw;$yellow_meth_sw=$yellow_meth->sw;$yellow_meth_edm=$yellow_meth->edm;$yellow_meth_csw=$yellow_meth->csw;$yellow_meth_clw=$yellow_meth->clw;$yellow_meth_discard=$yellow_meth->discard;$yellow_meth_microb=$yellow_meth->microb;
		}else{
			$yellow_meth_haw="";$yellow_meth_aaw="";$yellow_meth_sw="";$yellow_meth_edm="";$yellow_meth_csw="";$yellow_meth_clw="";$yellow_meth_discard="";$yellow_meth_microb="";
		}
		if(!empty($results["blue_qnt"])){
			$blue_qnt=json_decode($results["blue_qnt"]);
			$blue_qnt_glas=$blue_qnt->glas;$blue_qnt_metal=$blue_qnt->metal;
		}else{
			$blue_qnt_glas="";$blue_qnt_metal="";
		}
		if(!empty($results["blue_meth"])){
			$blue_meth=json_decode($results["blue_meth"]);
			$blue_meth_glas=$blue_meth->glas;$blue_meth_metal=$blue_meth->metal;
		}else{
			$blue_meth_glas="";$blue_meth_metal="";
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
	}else{	 
		$form_id="";
		$facility_name="";$applic_tele_no="";$applic_fax_no="";$applic_web_addr="";$fresh_renew="";$if_applied="";$prev_auth_no="";$renew_date="";$under_water="";$under_air="";$facility_coord="";
		$recycl_waste_quantity="";$recycl_waste_method="";$waste_sharp_quantity="";$waste_sharp_method="";$mode_trans="";$auth_details="";
		$admin_sn1="";$admin_sn2="";$admin_vt="";$admin_dist="";$admin_pin="";$admin_mob="";$admin_email="";
		$auth_sght_gen="";$auth_sght_seg="";$auth_sght_coll="";$auth_sght_store="";$auth_sght_packg="";$auth_sght_recept="";$auth_sght_trans="";$auth_sght_treat="";$auth_sght_proc="";$auth_sght_con="";$auth_sght_recyle="";$auth_sght_dispose="";$auth_sght_destruct="";$auth_sght_uses="";$auth_sght_sale="";$auth_sght_transfer="";$auth_sght_other="";
		$health_care_sn1="";$health_care_sn2="";$health_care_vt="";$health_care_dist="";$health_care_pin="";
		$hcf_num_bed="";$hcf_pt="";$hcf_fac="";$cbmwtf_num_bed="";$cbmwtf_capacity="";$cbmwtf_quantity="";$cbmwtf_area="";
		$yellow_qnt_haw="";$yellow_qnt_aaw="";$yellow_qnt_sw="";$yellow_qnt_edm="";$yellow_qnt_csw="";$yellow_qnt_clw="";$yellow_qnt_discard="";$yellow_qnt_microb="";
		$yellow_meth_haw="";$yellow_meth_aaw="";$yellow_meth_sw="";$yellow_meth_edm="";$yellow_meth_csw="";$yellow_meth_clw="";$yellow_meth_discard="";$yellow_meth_microb="";
		$blue_qnt_glas="";$blue_qnt_metal="";$blue_meth_glas="";$blue_meth_metal="";
		$num_incnrat="";$num_plsm="";$num_atclv="";$num_mw="";$num_hyclv="";$num_shrdr="";$num_ndl="";$num_cp="";$num_dbp="";$num_cd="";$num_ot="";
		$capacity_incnrat="";$capacity_plsm="";$capacity_atclv="";$capacity_mw="";$capacity_hyclv="";$capacity_shrdr="";$capacity_ndl="";$capacity_cp="";$capacity_dbp="";$capacity_cd="";$capacity_ot="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$facility_name=$results["facility_name"];$applic_tele_no=$results["applic_tele_no"];$applic_fax_no=$results["applic_fax_no"];$applic_web_addr=$results["applic_web_addr"];$fresh_renew=$results["fresh_renew"];$if_applied=$results["if_applied"];$prev_auth_no=$results["prev_auth_no"];$renew_date=$results["renew_date"];$under_water=$results["under_water"];$under_air=$results["under_air"];$facility_coord=$results["facility_coord"];$recycl_waste_quantity=$results["recycl_waste_quantity"];$recycl_waste_method=$results["recycl_waste_method"];$waste_sharp_quantity=$results["waste_sharp_quantity"];$waste_sharp_method=$results["waste_sharp_method"];$mode_trans=$results["mode_trans"];$auth_details=$results["auth_details"];

	if(!empty($results["auth_sght"])){
		$auth_sght=json_decode($results["auth_sght"]);
		if(isset($auth_sght->gen)) $auth_sght_gen=$auth_sght->gen;
		else $auth_sght_gen="";
		if(isset($auth_sght->seg)) $auth_sght_seg=$auth_sght->seg;
		else $auth_sght_seg="";
		if(isset($auth_sght->coll)) $auth_sght_coll=$auth_sght->coll;
		else $auth_sght_coll="";
		if(isset($auth_sght->store)) $auth_sght_store=$auth_sght->store;
		else $auth_sght_store="";
		if(isset($auth_sght->packg)) $auth_sght_packg=$auth_sght->packg;
		else $auth_sght_packg="";
		if(isset($auth_sght->recept)) $auth_sght_recept=$auth_sght->recept;
		else $auth_sght_recept="";
		if(isset($auth_sght->trans)) $auth_sght_trans=$auth_sght->trans;
		else $auth_sght_trans="";
		if(isset($auth_sght->treat)) $auth_sght_treat=$auth_sght->treat;
		else $auth_sght_treat="";
		if(isset($auth_sght->proc)) $auth_sght_proc=$auth_sght->proc;
		else $auth_sght_proc="";
		if(isset($auth_sght->con)) $auth_sght_con=$auth_sght->con;
		else $auth_sght_con="";
		if(isset($auth_sght->recyle)) $auth_sght_recyle=$auth_sght->recyle;
		else $auth_sght_recyle="";
		if(isset($auth_sght->dispose)) $auth_sght_dispose=$auth_sght->dispose;
		else $auth_sght_dispose="";
		if(isset($auth_sght->destruct)) $auth_sght_destruct=$auth_sght->destruct;
		else $auth_sght_destruct="";
		if(isset($auth_sght->uses)) $auth_sght_uses=$auth_sght->uses;
		else $auth_sght_uses="";
		if(isset($auth_sght->sale)) $auth_sght_sale=$auth_sght->sale;
		else $auth_sght_sale="";
		if(isset($auth_sght->transfer)) $auth_sght_transfer=$auth_sght->transfer;
		else $auth_sght_transfer="";
		if(isset($auth_sght->other)) $auth_sght_other=$auth_sght->other;
		else $auth_sght_transfer="";
	}else{
		$auth_sght_gen="";$auth_sght_seg="";$auth_sght_coll="";$auth_sght_store="";$auth_sght_packg="";$auth_sght_recept="";$auth_sght_trans="";$auth_sght_treat="";$auth_sght_proc="";$auth_sght_con="";$auth_sght_recyle="";$auth_sght_dispose="";$auth_sght_destruct="";$auth_sght_uses="";$auth_sght_sale="";$auth_sght_transfer="";$auth_sght_other="";
	}
	if(!empty($results["health_care"])){
		$health_care=json_decode($results["health_care"]);
		$health_care_sn1=$health_care->sn1;$health_care_sn2=$health_care->sn2;$health_care_vt=$health_care->vt;$health_care_dist=$health_care->dist;$health_care_pin=$health_care->pin;
	}else{
		$health_care_sn1="";$health_care_sn2="";$health_care_vt="";$health_care_dist="";$health_care_pin="";
	}
	if(!empty($results["hcf"])){
		$hcf=json_decode($results["hcf"]);
		$hcf_num_bed=$hcf->num_bed;$hcf_pt=$hcf->pt;$hcf_fac=$hcf->fac;
	}else{
		$hcf_num_bed="";$hcf_pt="";$hcf_fac="";
	}
	if(!empty($results["cbmwtf"])){
		$cbmwtf=json_decode($results["cbmwtf"]);
		$cbmwtf_num_bed=$cbmwtf->num_bed;$cbmwtf_capacity=$cbmwtf->capacity;$cbmwtf_quantity=$cbmwtf->quantity;$cbmwtf_area=$cbmwtf->area;
	}else{
		$cbmwtf_num_bed="";$cbmwtf_capacity="";$cbmwtf_quantity="";$cbmwtf_area="";
	}
	if(!empty($results["yellow_qnt"])){
		$yellow_qnt=json_decode($results["yellow_qnt"]);
		$yellow_qnt_haw=$yellow_qnt->haw;$yellow_qnt_aaw=$yellow_qnt->aaw;$yellow_qnt_sw=$yellow_qnt->sw;$yellow_qnt_edm=$yellow_qnt->edm;$yellow_qnt_csw=$yellow_qnt->csw;$yellow_qnt_clw=$yellow_qnt->clw;$yellow_qnt_discard=$yellow_qnt->discard;$yellow_qnt_microb=$yellow_qnt->microb;
	}else{
		$yellow_qnt_haw="";$yellow_qnt_aaw="";$yellow_qnt_sw="";$yellow_qnt_edm="";$yellow_qnt_csw="";$yellow_qnt_clw="";$yellow_qnt_discard="";$yellow_qnt_microb="";
	}
	if(!empty($results["yellow_meth"])){
		$yellow_meth=json_decode($results["yellow_meth"]);
		$yellow_meth_haw=$yellow_meth->haw;$yellow_meth_aaw=$yellow_meth->aaw;$yellow_meth_sw=$yellow_meth->sw;$yellow_meth_edm=$yellow_meth->edm;$yellow_meth_csw=$yellow_meth->csw;$yellow_meth_clw=$yellow_meth->clw;$yellow_meth_discard=$yellow_meth->discard;$yellow_meth_microb=$yellow_meth->microb;
	}else{
		$yellow_meth_haw="";$yellow_meth_aaw="";$yellow_meth_sw="";$yellow_meth_edm="";$yellow_meth_csw="";$yellow_meth_clw="";$yellow_meth_discard="";$yellow_meth_microb="";
	}
	if(!empty($results["blue_qnt"])){
		$blue_qnt=json_decode($results["blue_qnt"]);
		$blue_qnt_glas=$blue_qnt->glas;$blue_qnt_metal=$blue_qnt->metal;
	}else{
		$blue_qnt_glas="";$blue_qnt_metal="";
	}
	if(!empty($results["blue_meth"])){
		$blue_meth=json_decode($results["blue_meth"]);
		$blue_meth_glas=$blue_meth->glas;$blue_meth_metal=$blue_meth->metal;
	}else{
		$blue_meth_glas="";$blue_meth_metal="";
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
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
						   </ul>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">1. Particulars of Applicant:</td>
									</tr>
									<tr>
										<td width="25%">(i) Name of the Applicant:</td>
									    <td width="25%"><input type="text" name="" value="<?php echo $key_person; ?>" disabled class="form-control text-uppercase"></td>
										<td width="25%">(ii) Name of the health care facility (HCF) or common bio-medical waste treatment facility (CBWTF) :</td>
										<td width="25%"><input type="text" name="facility_name" value="<?php echo $facility_name; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td colspan="4">(iii) Address for correspondence:</td>
									</tr>
									<tr>
										<td>Street Name 1:</td>
										<td><input type="text" name="" value="<?php echo $b_street_name1; ?>" disabled class="form-control text-uppercase"></td>
										<td>Street Name 2:</td>
										<td><input type="text" name="" value="<?php echo $b_street_name2; ?>" disabled class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town:</td>
										<td><input type="text" name="" value="<?php echo $b_vill; ?>" disabled class="form-control text-uppercase"></td>
										<td>District:</td>
										<td><input type="text" name="" value="<?php echo $b_dist; ?>" disabled class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode:</td>
										<td><input type="text" name="" value="<?php echo $b_pincode; ?>" disabled class="form-control"></td>
										<td>Mobile No:</td>
										<td><input type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(iv) Tele No.:</td>
										<td><input type="text" name="applic_tele_no" validate="onlyNumbers" value="<?php echo $applic_tele_no; ?>" class="form-control text-uppercase"></td>
										<td>Fax No:</td>
										<td><input type="text" name="applic_fax_no" value="<?php echo $applic_fax_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(v) Email:</td>
										<td><input type="email" name="applic_email" value="<?php echo $b_email; ?>" disabled class="form-control"></td>
										<td>(vi) Website Address:</td>
										<td><input type="text" name="applic_web_addr" value="<?php echo $applic_web_addr; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td colspan="4">2. Activity for which authorisation is sought:</td>
									</tr>
									<tr>
									     <td width="25%"><input type="checkbox" name="auth_sght[gen]" value="Generation" <?php if(isset($auth_sght_gen) && $auth_sght_gen=='Generation') echo 'checked'; ?> validate="jsonObj"> Generation</td>
										 <td width="25%"><input type="checkbox" name="auth_sght[seg]" value="Segregation" <?php if(isset($auth_sght_seg) && $auth_sght_seg=='Segregation') echo 'checked'; ?> validate="jsonObj"> Segregation</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[coll]" value="Collection" <?php if(isset($auth_sght_coll) && $auth_sght_coll=='Collection') echo 'checked'; ?> validate="jsonObj"> Collection</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[store]" value="Storage" <?php if(isset($auth_sght_store) && $auth_sght_store=='Storage') echo 'checked'; ?> validate="jsonObj"> Storage</td>
									</tr>
									<tr>
										 <td width="25%"><input type="checkbox" name="auth_sght[packg]" value="Packaging" <?php if(isset($auth_sght_packg) && $auth_sght_packg=='Packaging') echo 'checked'; ?> validate="jsonObj"> Packaging</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[recept]" value="Reception" <?php if(isset($auth_sght_recept) && $auth_sght_recept=='Reception') echo 'checked'; ?> validate="jsonObj"> Reception</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[trans]" value="Transportation" <?php if(isset($auth_sght_trans) && $auth_sght_trans=='Transportation') echo 'checked'; ?> validate="jsonObj"> Transportation</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[treat]" value="Treatment" <?php if(isset($auth_sght_treat) && $auth_sght_treat=='Treatment') echo 'checked'; ?> validate="jsonObj"> Treatment</td>
									</tr>
									<tr>
										<td width="25%"><input type="checkbox" name="auth_sght[proc]" value="Processing" <?php if(isset($auth_sght_proc) && $auth_sght_proc=='Processing') echo 'checked'; ?> validate="jsonObj"> Processing</td>
										<td width="25%"><input type="checkbox" name="auth_sght[con]" value="Conversion"<?php if(isset($auth_sght_con) && $auth_sght_con=='Conversion') echo 'checked'; ?> validate="jsonObj"> Conversion</td>
										<td width="25%"><input type="checkbox" name="auth_sght[recyle]" value="Recycling" <?php if(isset($auth_sght_recyle) && $auth_sght_recyle=='Recycling') echo 'checked'; ?> validate="jsonObj"> Recycling</td>
										<td width="25%"><input type="checkbox" name="auth_sght[dispose]" value="Disposal" <?php if(isset($auth_sght_dispose) && $auth_sght_dispose=='Disposal') echo 'checked'; ?> validate="jsonObj"> Disposal</td>
									</tr>
									<tr>
										 <td width="25%"><input type="checkbox" name="auth_sght[destruct]" value="Destruction" <?php if(isset($auth_sght_destruct) && $auth_sght_destruct=='Destruction') echo 'checked'; ?> validate="jsonObj"> Destruction</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[uses]" value="Use" <?php if(isset($auth_sght_uses) && $auth_sght_uses=='Use') echo 'checked'; ?> validate="jsonObj"> Use</td>
									     <td width="25%"><input type="checkbox" name="auth_sght[sale]" value="Offering for sale" <?php if(isset($auth_sght_sale) && $auth_sght_sale=='Offering for sale') echo 'checked'; ?> validate="jsonObj"> Offering for sale</td>
										 <td width="25%"><input type="checkbox" name="auth_sght[transfer]" value="Transfer" <?php if(isset($auth_sght_transfer) && $auth_sght_transfer=='Transfer') echo 'checked'; ?> validate="jsonObj"> Transfer</td>
									</tr>
									<tr>
										<td width="25%"><input type="checkbox" name="auth_sght[other]" value="Any other form of handling" <?php if(isset($auth_sght_other) && $auth_sght_other=='Any other form of handling') echo 'checked'; ?> validate="jsonObj"> Any other form of handling</td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">3. Application for fresh / renewal of authorisation (please tick whatever is applicable):<span class= "mandatory_field">*</span></td>
									</tr>
									<tr>
										<td width="25%"><input type="CheckBox" id="D1" name="fresh_renew" value="F" <?php if(isset($fresh_renew) && $fresh_renew=='F') echo 'checked'; ?> onClick="checkData(this)">Fresh</td>
										<td width="25%"><input type="CheckBox" id="D2" name="fresh_renew" value="R" <?php if(isset($fresh_renew) && $fresh_renew=='R') echo 'checked'; ?> onClick="checkData(this)">Renewal</td>	
									</tr>
									<tr>
										<td>(i) Applied for CTO/CTE :</td>
										<td><label class="radio-inline"><input type="radio" name="if_applied" value="Y"  <?php if(isset($if_applied) && $if_applied=='Y') echo 'checked'; ?> required /> Yes</label>
											<label class="radio-inline"><input type="radio" name="if_applied"  value="N"  <?php if(isset($if_applied) && $if_applied=='N') echo 'checked'; ?> required /> No</label></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(ii) In case of renewal previous authorisation number and date:</td>
									</tr>
									<tr>
										<td>Authorisation number :</td>
										<td><input type="text" name="prev_auth_no" value="<?php echo $prev_auth_no; ?>" class="form-control text-uppercase"></td>
										<td>Date :</td>
										<td><input type="text" name="renew_date" value="<?php echo $renew_date; ?>" readonly="readonly" class="dob form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>(iii) Status of Consents:</td>
									</tr>
									<tr>
										<td>(a) under the Water (Prevention and Control of Pollution) Act, 1974 :</td>
										<td><input type="text" name="under_water" value="<?php echo $under_water; ?>" class="form-control text-uppercase"></td>
										<td>(b) under the Air (Prevention and Control of Pollution) Act, 1981 :</td>
										<td><input type="text" name="under_air" value="<?php echo $under_air; ?>" class="form-control text-uppercase"></td>
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
										<td colspan="4">4.(i) Address of the health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
									</tr>
									<tr>
										<td width="25%">Street Name 1:</td>
										<td width="25%"><input type="text" name="health_care[sn1]" value="<?php echo $health_care_sn1; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%">Street Name 2:</td>
										<td width="25%"><input type="text" name="health_care[sn2]" value="<?php echo $health_care_sn2; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town:</td>
										<td><input type="text" name="health_care[vt]" value="<?php echo $health_care_vt; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td>District:</td>
                                        <td><input type="text" name="health_care[dist]" value="<?php echo $health_care_dist; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										
									</tr>
									<tr>
										<td>Pincode:</td>
										<td><input type="text" name="health_care[pin]" maxlength="6" value="<?php echo $health_care_pin; ?>" validate="pincode" class="form-control"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2">(ii) GPS coordinates of health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
										<td><input type="text" name="facility_coord" value="<?php echo $facility_coord; ?>"  class="form-control"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">5. Details of health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
									</tr>
									<tr>
										<td>(i) Number of beds of HCF:</td>
										<td><input type="text" name="hcf[num_bed]" value="<?php echo $hcf_num_bed; ?>" validate="jsonObj" class="form-control"></td>
										<td>(ii) Number of patients treated per month by HCF:</td>
										<td><input type="text" name="hcf[pt]" value="<?php echo $hcf_pt; ?>" validate="jsonObj" class="form-control"></td>
									</tr>
									<tr>
										<td>(iii) Number healthcare facilities covered by CBMWTF:</td>
										<td><input type="text" name="hcf[fac]" value="<?php echo $hcf_fac; ?>" validate="jsonObj" class="form-control"></td>
										<td>(iv) No of beds covered by CBMWTF:</td>
										<td><input type="text" name="cbmwtf[num_bed]" value="<?php echo $cbmwtf_num_bed; ?>" validate="jsonObj" class="form-control"></td>
									</tr>
									<tr>
										<td>(v) Installed treatment and disposal capacity of CBMWTF(Kg per day):</td>
										<td><input type="text" name="cbmwtf[capacity]" value="<?php  echo $cbmwtf_capacity; ?>" validate="jsonObj" class="form-control"></td>
										<td>(vi) Quantity of biomedical waste treated or disposed by CBMWTF (Kg per day) :</td>
										<td><input type="text" name="cbmwtf[quantity]" value="<?php echo $cbmwtf_quantity; ?>" validate="jsonObj" class="form-control"></td>
									</tr>
									<tr>
										<td>(vii) Area or distance covered by CBMWTF:(pl. attach map a map with GPS locations of CBMWTF and area of coverage)</td>
										<td><input type="text" name="cbmwtf[area]" value="<?php echo $cbmwtf_area; ?>" validate="jsonObj" class="form-control"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(viii) Quantity of Biomedical waste handled, treated or disposed:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table" width="99%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">  
											<thead>
												<tr>
													<th width="25%">Category</th>
													<th width="25%">Type of Waste</th>
													<th width="25%">Quantity Generated or Collected, kg/day</th>
													<th width="25%">Method of Treatment and Disposal (Refer Schedule-I)</th>
												</tr>
												<tr>
													<th>(1)</th>
													<th>(2)</th>
													<th>(3)</th>
													<th>(4)</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td rowspan="8">Yellow</td>
													<td>(a) Human Anatomical Waste :</td>
													<td><input type="text" name="yellow_qnt[haw]" value="<?php echo $yellow_qnt_haw; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[haw]" value="<?php echo $yellow_meth_haw; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(b)Animal Anatomical Waste :</td>
													<td><input type="text" name="yellow_qnt[aaw]" value="<?php echo $yellow_qnt_aaw; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[aaw]" value="<?php echo $yellow_meth_aaw; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(c) Soiled Waste :</td>
													<td><input type="text" name="yellow_qnt[sw]" value="<?php echo $yellow_qnt_sw; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[sw]" value="<?php echo $yellow_meth_sw; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(d) Expired or Discarded Medicines :</td>
													<td><input type="text" name="yellow_qnt[edm]" value="<?php echo $yellow_qnt_edm; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[edm]" value="<?php echo $yellow_meth_edm; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(e) Chemical Solid Waste :</td>
													<td><input type="text" name="yellow_qnt[csw]" value="<?php echo $yellow_qnt_csw; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[csw]" value="<?php echo $yellow_meth_csw; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													<td>(f) Chemical Liquid Waste :</td>
													<td><input type="text" name="yellow_qnt[clw]" value="<?php echo $yellow_qnt_clw; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[clw]" value="<?php echo $yellow_meth_clw; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid :</td>
													<td><input type="text" name="yellow_qnt[discard]" value="<?php echo $yellow_qnt_discard; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[discard]" value="<?php echo $yellow_meth_discard; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													
													<td>(h) Microbiology, Biotechnology and other clinical laboratory waste :</td>
													<td><input type="text" name="yellow_qnt[microb]" value="<?php echo $yellow_qnt_microb; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="yellow_meth[microb]" value="<?php echo $yellow_meth_microb; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													<td>Red</td>
													<td>Contaminated Waste (Recyclable) :</td>
													<td><input type="text" name="recycl_waste_quantity" value="<?php echo $recycl_waste_quantity; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="recycl_waste_method" value="<?php echo $recycl_waste_method; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													<td>White (Translucent)</td>
													<td>Waste sharps including Metals :</td>
													<td><input type="text" name="waste_sharp_quantity" value="<?php echo $waste_sharp_quantity; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="waste_sharp_method" value="<?php echo $waste_sharp_method; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													<td rowspan="2">Blue</td>
													<td>Glassware :</td>
													<td><input type="text" name="blue_qnt[glas]" value="<?php echo $blue_qnt_glas; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="blue_meth[glas]" value="<?php echo $blue_meth_glas; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
												<tr>
													<td>Metallic Body Implants :</td>
													<td><input type="text" name="blue_qnt[metal]" value="<?php echo $blue_qnt_metal; ?>" validate="jsonObj" class="form-control1"></td>
													<td><input type="text" name="blue_meth[metal]" value="<?php echo $blue_meth_metal; ?>" validate="jsonObj" class="form-control1"></td>
												</tr>
											</tbody>
										</table>
										</td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">6. Brief description of arrangements for handling of biomedical waste(Upload later in Upload Section) :</td>
									</tr>
									<tr>
										<td width="50%">(i) Mode of transportation (if any) of bio-medical waste:</td>
										<td width="25%"><input type="text" name="mode_trans" value="<?php echo $mode_trans; ?>" class="form-control text-uppercase"></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">(ii) Details of treatment equipment (please give details such as the number, type & capacity of each unit)</td>
									</tr>
									<tr>
										<td width="25%"></td>
										<td width="25%">No of units</td>
										<td width="25%">Capacity of each unit</td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Incinerators :</td>
										<td width="25%"><input type="text" name="num[incnrat]" value="<?php echo $num_incnrat; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[incnrat]" value="<?php echo $capacity_incnrat; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Plasma Pyrolysis :</td>
										<td width="25%"><input type="text" name="num[plsm]" value="<?php echo $num_plsm; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[plsm]" value="<?php echo $capacity_plsm; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Autoclaves :</td>
										<td width="25%"><input type="text" name="num[atclv]" value="<?php echo $num_atclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[atclv]" value="<?php echo $capacity_atclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Microwave :</td>
										<td width="25%"><input type="text" name="num[mw]" value="<?php echo $num_mw; ?>"validate="jsonObj"  class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[mw]" value="<?php echo $capacity_mw; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Hydroclave :</td>
										<td width="25%"><input type="text" name="num[hyclv]" value="<?php echo $num_hyclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[hyclv]" value="<?php echo $capacity_hyclv; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Shredder :</td>
										<td width="25%"><input type="text" name="num[shrdr]" value="<?php echo $num_shrdr; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[shrdr]" value="<?php echo $capacity_shrdr; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Needle tip cutter or destroyer :</td>
										<td width="25%"><input type="text" name="num[ndl]" value="<?php echo $num_ndl; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[ndl]" value="<?php echo $capacity_ndl; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Sharps encapsulation or concrete pit :</td>
										<td width="25%"><input type="text" name="num[cp]" value="<?php echo $num_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[cp]" value="<?php echo $capacity_cp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Deep burial pits:</td>
										<td width="25%"><input type="text" name="num[dbp]" value="<?php echo $num_dbp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[dbp]" value="<?php echo $capacity_dbp; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Chemical disinfection :</td>
										<td width="25%"><input type="text" name="num[cd]" value="<?php echo $num_cd; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[cd]" value="<?php echo $capacity_cd; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">Any other treatment equipment :</td>
										<td width="25%"><input type="text" name="num[ot]" value="<?php echo $num_ot; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"><input type="text" name="capacity[ot]" value="<?php echo $capacity_ot; ?>" validate="jsonObj" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">7. Contingency plan of common bio-medical waste treatment facility (CBWTF):</td>
										<td width="25%">Upload later in Upload Section</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td width="25%">8. Details of directions or notices or legal actions if any during the period of earlier authorisation :</td>
										<td width="25%"><textarea name="auth_details"  id="" class="form-control text-uppercase" validate="textarea" ><?php echo $auth_details; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>9. Declaration</td>
									</tr>
									<tr>
										<td colspan="4"><p>I do hereby declare that the statements made and information given above are true to the best of my knowledge and belief and that I have not concealed any information.</p>
										<p>I do also hereby undertake to provide any further information sought by the prescribed authority in relation to these rules and to fulfill any conditions stipulated by the prescribed authority.</p></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-y',strtotime($today)); ?></label><br/>
														Place: <label><?php echo strtoupper($dist)?></label>
										</td>
										<td colspan="2" align="right">Signature:<label><?php echo strtoupper($key_person)?>
										</label><br/>Designation:<label><?php echo strtoupper($status_applicant)?></label></td>
									</tr>	
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>