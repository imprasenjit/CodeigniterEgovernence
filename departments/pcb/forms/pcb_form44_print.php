<?php
$dept="pcb";
$form="44";
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
	$facility_name=$results["facility_name"];$applic_tele_no=$results["applic_tele_no"];$applic_fax_no=$results["applic_fax_no"];$applic_web_addr=$results["applic_web_addr"];$fresh_renew=$results["fresh_renew"];$if_applied=$results["if_applied"];$prev_auth_no=$results["prev_auth_no"];$renew_date=$results["renew_date"];$under_water=$results["under_water"];$under_air=$results["under_air"];$facility_coord=$results["facility_coord"];$recycl_waste_quantity=$results["recycl_waste_quantity"];$recycl_waste_method=$results["recycl_waste_method"];$waste_sharp_quantity=$results["waste_sharp_quantity"];$waste_sharp_method=$results["waste_sharp_method"];$mode_trans=$results["mode_trans"];$auth_details=$results["auth_details"];
	if($fresh_renew=="F") $fresh_renew="FRESH";
	    else $fresh_renew="RENEWAL";
	if($if_applied=="Y") $if_applied="YES";
	    else $if_applied="NO";
	
	if(!empty($results["admin"]))
	{
		$admin=json_decode($results["admin"]);
		$admin_sn1=$admin->sn1;$admin_sn2=$admin->sn2;$admin_vt=$admin->vt;$admin_dist=$admin->dist;$admin_pin=$admin->pin;$admin_mob=$admin->mob;$admin_email=$admin->email;
	}
	else
	{
		$admin_sn1="";$admin_sn2="";$admin_vt="";$admin_dist="";$admin_pin="";$admin_mob="";$admin_email="";
	}
			
	$auth_sght_string="";
	if(!empty($results["auth_sght"]))
	{
		$auth_sght=json_decode($results["auth_sght"]);
		if(isset($auth_sght->gen)){
			$auth_sght_gen=$auth_sght->gen;
			$auth_sght_string = $auth_sght_gen.", ";
		} 
		else $auth_sght_gen="";

		if(isset($auth_sght->seg)){
			$auth_sght_seg=$auth_sght->seg;
			$auth_sght_string = $auth_sght_string.$auth_sght_seg.", ";
		}
		else $auth_sght_seg="";
		
		if(isset($auth_sght->coll)){
			$auth_sght_coll=$auth_sght->coll;
			$auth_sght_string = $auth_sght_string.$auth_sght_coll.", ";
		}
		else $auth_sght_coll="";
		
		if(isset($auth_sght->store)){
			 $auth_sght_store=$auth_sght->store;
			$auth_sght_string = $auth_sght_string.$auth_sght_store.", ";
		}
		else $auth_sght_store="";
		
		if(isset($auth_sght->packg)){
			$auth_sght_packg=$auth_sght->packg;
			$auth_sght_string = $auth_sght_string.$auth_sght_packg.", ";
		} 
		else $auth_sght_packg="";
		
		if(isset($auth_sght->recept)){
			$auth_sght_recept=$auth_sght->recept;
			$auth_sght_string = $auth_sght_string.$auth_sght_recept.", ";
		} 
		else $auth_sght_recept="";
		
		if(isset($auth_sght->trans)){
			$auth_sght_trans=$auth_sght->trans;
			$auth_sght_string = $auth_sght_string.$auth_sght_trans.", ";
		} 
		else $auth_sght_trans="";
		
		if(isset($auth_sght->treat)){
			$auth_sght_treat=$auth_sght->treat;
			$auth_sght_string = $auth_sght_string.$auth_sght_treat.", ";
		} 
		else $auth_sght_treat="";
		
		if(isset($auth_sght->proc)){
			$auth_sght_proc=$auth_sght->proc;
			$auth_sght_string = $auth_sght_string.$auth_sght_proc.", ";
		} 
		else $auth_sght_proc="";
		
		if(isset($auth_sght->con)){
			$auth_sght_con=$auth_sght->con;
			$auth_sght_string = $auth_sght_string.$auth_sght_con.", ";
		} 
		else $auth_sght_con="";
		
		if(isset($auth_sght->recyle)){
			$auth_sght_recyle=$auth_sght->recyle;
			$auth_sght_string = $auth_sght_string.$auth_sght_recyle.", ";
		} 
		else $auth_sght_recyle="";
		
		if(isset($auth_sght->dispose)){
			$auth_sght_dispose=$auth_sght->dispose;
			$auth_sght_string = $auth_sght_string.$auth_sght_dispose.", ";
		} 
		else $auth_sght_dispose="";
		
		if(isset($auth_sght->destruct)){
			$auth_sght_destruct=$auth_sght->destruct;
			$auth_sght_string = $auth_sght_string.$auth_sght_destruct.", ";
		} 
		else $auth_sght_destruct="";
		
		if(isset($auth_sght->uses)){
			$auth_sght_uses=$auth_sght->uses;
			$auth_sght_string = $auth_sght_string.$auth_sght_uses.", ";
		} 
		else $auth_sght_uses="";
		
		if(isset($auth_sght->sale)){
			$auth_sght_sale=$auth_sght->sale;
			$auth_sght_string = $auth_sght_string.$auth_sght_sale.", ";
		} 
		else $auth_sght_sale="";
		
		if(isset($auth_sght->transfer)){
			$auth_sght_transfer=$auth_sght->transfer;
			$auth_sght_string = $auth_sght_string.$auth_sght_transfer.", ";
		} 
		else $auth_sght_transfer="";
		
		if(isset($auth_sght->other)){
			$auth_sght_other=$auth_sght->other;
			$auth_sght_string = $auth_sght_string.$auth_sght_other;
		} 
		else $auth_sght_transfer="";
	}
	else
	{
		$auth_sght_gen="";$auth_sght_seg="";$auth_sght_coll="";$auth_sght_store="";$auth_sght_packg="";$auth_sght_recept="";$auth_sght_trans="";$auth_sght_treat="";$auth_sght_proc="";$auth_sght_con="";$auth_sght_recyle="";$auth_sght_dispose="";$auth_sght_destruct="";$auth_sght_uses="";$auth_sght_sale="";$auth_sght_transfer="";$auth_sght_other="";$auth_sght_string="";
	}
	$auth_sght_string = rtrim($auth_sght_string,", ");
	if(!empty($results["health_care"]))
	{
		$health_care=json_decode($results["health_care"]);
		$health_care_sn1=$health_care->sn1;$health_care_sn2=$health_care->sn2;$health_care_vt=$health_care->vt;$health_care_dist=$health_care->dist;$health_care_pin=$health_care->pin;
	}
	else
	{
		$health_care_sn1="";$health_care_sn2="";$health_care_vt="";$health_care_dist="";$health_care_pin="";
	}
	if(!empty($results["hcf"]))
	{
		$hcf=json_decode($results["hcf"]);
		$hcf_num_bed=$hcf->num_bed;$hcf_pt=$hcf->pt;$hcf_fac=$hcf->fac;
	}
	else
	{
		$hcf_num_bed="";$hcf_pt="";$hcf_fac="";
	}
	if(!empty($results["cbmwtf"]))
	{
		$cbmwtf=json_decode($results["cbmwtf"]);
		$cbmwtf_num_bed=$cbmwtf->num_bed;$cbmwtf_capacity=$cbmwtf->capacity;$cbmwtf_quantity=$cbmwtf->quantity;$cbmwtf_area=$cbmwtf->area;
	}
	else
	{
		$cbmwtf_num_bed="";$cbmwtf_capacity="";$cbmwtf_quantity="";$cbmwtf_area="";
	}
	if(!empty($results["yellow_qnt"]))
	{
		$yellow_qnt=json_decode($results["yellow_qnt"]);
		$yellow_qnt_haw=$yellow_qnt->haw;$yellow_qnt_aaw=$yellow_qnt->aaw;$yellow_qnt_sw=$yellow_qnt->sw;$yellow_qnt_edm=$yellow_qnt->edm;$yellow_qnt_csw=$yellow_qnt->csw;$yellow_qnt_clw=$yellow_qnt->clw;$yellow_qnt_discard=$yellow_qnt->discard;$yellow_qnt_microb=$yellow_qnt->microb;
	}
	else
	{
		$yellow_qnt_haw="";$yellow_qnt_aaw="";$yellow_qnt_sw="";$yellow_qnt_edm="";$yellow_qnt_csw="";$yellow_qnt_clw="";$yellow_qnt_discard="";$yellow_qnt_microb="";
	}
	if(!empty($results["yellow_meth"]))
	{
		$yellow_meth=json_decode($results["yellow_meth"]);
		$yellow_meth_haw=$yellow_meth->haw;$yellow_meth_aaw=$yellow_meth->aaw;$yellow_meth_sw=$yellow_meth->sw;$yellow_meth_edm=$yellow_meth->edm;$yellow_meth_csw=$yellow_meth->csw;$yellow_meth_clw=$yellow_meth->clw;$yellow_meth_discard=$yellow_meth->discard;$yellow_meth_microb=$yellow_meth->microb;
	}
	else
	{
		$yellow_meth_haw="";$yellow_meth_aaw="";$yellow_meth_sw="";$yellow_meth_edm="";$yellow_meth_csw="";$yellow_meth_clw="";$yellow_meth_discard="";$yellow_meth_microb="";
	}
	if(!empty($results["blue_qnt"]))
	{
		$blue_qnt=json_decode($results["blue_qnt"]);
		$blue_qnt_glas=$blue_qnt->glas;$blue_qnt_metal=$blue_qnt->metal;
	}
	else
	{
		$blue_qnt_glas="";$blue_qnt_metal="";
	}
	if(!empty($results["blue_meth"]))
	{
		$blue_meth=json_decode($results["blue_meth"]);
		$blue_meth_glas=$blue_meth->glas;$blue_meth_metal=$blue_meth->metal;
	}
	else
	{
		$blue_meth_glas="";$blue_meth_metal="";
	}
	if(!empty($results["num"]))
	{
		$num=json_decode($results["num"]);
		$num_incnrat=$num->incnrat;$num_plsm=$num->plsm;$num_atclv=$num->atclv;$num_mw=$num->mw;$num_hyclv=$num->hyclv;$num_shrdr=$num->shrdr;$num_ndl=$num->ndl;$num_cp=$num->cp;$num_dbp=$num->dbp;$num_cd=$num->cd;$num_ot=$num->ot;
	}
	else
	{
		$num_incnrat="";$num_plsm="";$num_atclv="";$num_mw="";$num_hyclv="";$num_shrdr="";$num_ndl="";$num_cp="";$num_dbp="";$num_cd="";$num_ot="";
	}
	if(!empty($results["capacity"]))
	{
		$capacity=json_decode($results["capacity"]);
		$capacity_incnrat=$capacity->incnrat;$capacity_plsm=$capacity->plsm;$capacity_atclv=$capacity->atclv;$capacity_mw=$capacity->mw;$capacity_hyclv=$capacity->hyclv;$capacity_shrdr=$capacity->shrdr;$capacity_ndl=$capacity->ndl;$capacity_cp=$capacity->cp;$capacity_dbp=$capacity->dbp;$capacity_cd=$capacity->cd;$capacity_ot=$capacity->ot;
	}
	else
	{
		$capacity_incnrat="";$capacity_plsm="";$capacity_atclv="";$capacity_mw="";$capacity_hyclv="";$capacity_shrdr="";$capacity_ndl="";$capacity_cp="";$capacity_dbp="";$capacity_cd="";$capacity_ot="";
	}
	$auth_details = wordwrap($auth_details, 50, "<br/>", true);
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
			<td colspan="2">To<br/>
			&nbsp;&nbsp;  The Member Secretary<br/>
			&nbsp;&nbsp;  Pollution Control Board, Assam<br/>
			&nbsp;&nbsp;  Bamunimaidam, Guwahati-21</td>
		</tr>
		<tr>
			<td colspan="2">1. Particulars of Applicant:</td>
		</tr>
		<tr>
			<td>(i) Name of the Applicant:</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>(ii) Name of the health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
			<td >'.strtoupper($facility_name).'</td>
		</tr>
		<tr>
			<td>(iii) Address for correspondence:</td>
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
				</table>
			</td>
		</tr>
		<tr>
			<td>(iv) Tele No.:</td>
			<td>'.strtoupper($applic_tele_no).'</td>
		</tr>
		<tr>
			<td>Fax No:</td>
			<td>'.strtoupper($applic_fax_no).'</td>
		</tr>
		<tr>
			<td>(v) Email:</td>
			<td>'.$b_email.'</td>
		</tr>
		<tr>
			<td>(vi) Website Address:</td>
			<td>'.$applic_web_addr.'</td>
		</tr>
		<tr>
			<td>2. Activity for which authorisation is sought:</td>
			<td>'.strtoupper($auth_sght_string).'</td>
		</tr>
		<tr>
			<td>3. Application for authorisation :</td>
			<td>'.strtoupper($fresh_renew).'</td>
		</tr>
		<tr>
			<td>(i) Applied for CTO/CTE :</td>
			<td>'.strtoupper($if_applied).'</td>
		</tr>
		<tr>
			<td>(ii) In case of renewal previous authorisation number and date:</td>
			<td>Authorisation number : '.strtoupper($prev_auth_no).'<br/>Date : '.strtoupper($renew_date).'</td>
		</tr>
		<tr>
			<td colspan="2">(iii) Status of Consents:</td>
		</tr>
		<tr>
			<td>(a) under the Water (Prevention and Control of Pollution) Act, 1974 :</td>
			<td>'.strtoupper($under_water).'</td>
		</tr>
		<tr>
			<td>(b) under the Air (Prevention and Control of Pollution) Act, 1981 :</td>
			<td>'.strtoupper($under_air).'</td>
		</tr>
		<tr>
			<td>4.(i) Address of the health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
			<td>
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($health_care_sn1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($health_care_sn2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($health_care_vt).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($health_care_dist).'</td>
					</tr>
					<tr>
							<td >Pincode</td>
							<td>'.strtoupper($health_care_pin).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(ii) GPS coordinates of health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
			<td>'.strtoupper($facility_coord).'</td>
		</tr>
		<tr>
			<td colspan="2">5. Details of health care facility (HCF) or common bio-medical waste treatment facility (CBWTF):</td>
		</tr>
		<tr>
			<td>(i) Number of beds of HCF :</td>
			<td>'.strtoupper($hcf_num_bed).'</td>
		</tr>
		<tr>
			<td>(ii) Number of patients treated per month by HCF :</td>
			<td>'.strtoupper($hcf_pt).'</td>
		</tr>
		<tr>
			<td>(iii) Number healthcare facilities covered by CBMWTF :</td>
			<td>'.strtoupper($hcf_fac).'</td>
		</tr>
		<tr>
			<td>(iv) No of beds covered by CBMWTF :</td>
			<td>'.strtoupper($cbmwtf_num_bed).'</td>
		</tr>
		<tr>
			<td>(v) Installed treatment and disposal capacity of CBMWTF(Kg per day) :</td>
			<td>'.strtoupper($cbmwtf_capacity).'</td>
		</tr>
		<tr>
			<td>(vi) Quantity of biomedical waste treated or disposed by CBMWTF (Kg per day) :</td>
			<td>'.strtoupper($cbmwtf_quantity).'</td>
		</tr>
		<tr>
			<td>(vii) Area or distance covered by CBMWTF :</td>
			<td>'.strtoupper($cbmwtf_area).'</td>
		</tr>
		<tr>
			<td colspan="2">(viii) Quantity of Biomedical waste handled, treated or disposed :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive"> 
					<thead>
					  <tr>
						<th>Category</th>
						<th>Type of Waste</th>
						<th>Quantity Generated or Collected, kg/day</th>
						<th>Method of Treatment and Disposal (Refer Schedule-I)</th>
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
							<td>(a) Human Anatomical Waste </td>
							<td>'.strtoupper($yellow_qnt_haw).'</td>
							<td>'.strtoupper($yellow_meth_haw).'</td>
						</tr>
						<tr>
							<td>(b) Animal Anatomical Waste </td>
							<td>'.strtoupper($yellow_qnt_aaw).'</td>
							<td>'.strtoupper($yellow_meth_aaw).'</td>
						</tr>
						<tr>
							<td>(c) Soiled Waste </td>
							<td>'.strtoupper($yellow_qnt_sw).'</td>
							<td>'.strtoupper($yellow_meth_sw).'</td>
						</tr>
						<tr>
							<td>(d) Expired or Discarded Medicines </td>
							<td>'.strtoupper($yellow_qnt_edm).'</td>
							<td>'.strtoupper($yellow_meth_edm).'</td>
						</tr>
						<tr>
							<td>(e) Chemical Solid Waste </td>
							<td>'.strtoupper($yellow_qnt_csw).'</td>
							<td>'.strtoupper($yellow_meth_csw).'</td>
						</tr>
						<tr>
							<td>(f) Chemical Liquid Waste </td>
							<td>'.strtoupper($yellow_qnt_clw).'</td>
							<td>'.strtoupper($yellow_meth_clw).'</td>
						</tr>
						<tr>
							<td>(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid </td>
							<td>'.strtoupper($yellow_qnt_discard).'</td>
							<td>'.strtoupper($yellow_meth_discard).'</td>
						</tr>
						<tr>
							<td>(h) Microbiology, Biotechnology and other clinical laboratory waste </td>
							<td>'.strtoupper($yellow_qnt_microb).'</td>
							<td>'.strtoupper($yellow_meth_microb).'</td>
						</tr>
						<tr>
							<td>Red</td>
							<td>Contaminated Waste (Recyclable) </td>
							<td>'.strtoupper($recycl_waste_quantity).'</td>
							<td>'.strtoupper($recycl_waste_method).'</td>
						</tr>
						<tr>
							<td>White (Translucent)</td>
							<td>Waste sharps including Metals </td>
							<td>'.strtoupper($waste_sharp_quantity).'</td>
							<td>'.strtoupper($waste_sharp_method).'</td>
						</tr>
						<tr>
							<td rowspan="2">Blue</td>
							<td>Glassware </td>
							<td>'.strtoupper($blue_qnt_glas).'</td>
							<td>'.strtoupper($blue_meth_glas).'</td>
						</tr>
						<tr>
							<td>Metallic Body Implants </td>
							<td>'.strtoupper($blue_qnt_metal).'</td>
							<td>'.strtoupper($blue_meth_metal).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>6. Brief description of arrangements for handling of biomedical waste :</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td>(i) Mode of transportation of bio-medical waste :</td>
			<td>'.strtoupper($mode_trans).'</td>
		</tr>
		<tr>
			<td colspan="2">(ii) Details of treatment equipment :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive"> 
					<thead>
					  <tr>
						<th></th>
						<th>No of units</th>
						<th>Capacity of each unit</th>
					  </tr>
					</thead>
					<tbody>
						<tr>
							<td>Incinerators</td>
							<td>'.strtoupper($num_incnrat).'</td>
							<td>'.strtoupper($capacity_incnrat).'</td>
						</tr>
						<tr>
							<td>Plasma Pyrolysis</td>
							<td>'.strtoupper($num_plsm).'</td>
							<td>'.strtoupper($capacity_plsm).'</td>
						</tr>
						<tr>
							<td>Autoclaves</td>
							<td>'.strtoupper($num_atclv).'</td>
							<td>'.strtoupper($capacity_atclv).'</td>
						</tr>
						<tr>
							<td>Microwave</td>
							<td>'.strtoupper($num_mw).'</td>
							<td>'.strtoupper($capacity_mw).'</td>
						</tr>
						<tr>
							<td>Hydroclave</td>
							<td>'.strtoupper($num_hyclv).'</td>
							<td>'.strtoupper($capacity_hyclv).'</td>
						</tr>
						<tr>
							<td>Shredder</td>
							<td>'.strtoupper($num_shrdr).'</td>
							<td>'.strtoupper($capacity_shrdr).'</td>
						</tr>
						<tr>
							<td>Needle tip cutter or destroyer</td>
							<td>'.strtoupper($num_ndl).'</td>
							<td>'.strtoupper($capacity_ndl).'</td>
						</tr>
						<tr>
							<td>Sharps encapsulation or concrete pit </td>
							<td>'.strtoupper($num_cp).'</td>
							<td>'.strtoupper($capacity_cp).'</td>
						</tr>
						<tr>
							<td>Deep burial pits</td>
							<td>'.strtoupper($num_dbp).'</td>
							<td>'.strtoupper($capacity_dbp).'</td>
						</tr>
						<tr>
							<td>Chemical disinfection</td>
							<td>'.strtoupper($num_cd).'</td>
							<td>'.strtoupper($capacity_cd).'</td>
						</tr>
						<tr>
							<td>Any other treatment equipment</td>
							<td>'.strtoupper($num_ot).'</td>
							<td>'.strtoupper($capacity_ot).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>7. Contingency plan of common bio-medical waste treatment facility (CBWTF) :</td>
			<td>Document is attached</td>
		</tr>
		<tr>
			<td>8. Details of directions or notices or legal actions if any during the period of earlier authorisation :</td>
			<td>'.strtoupper($auth_details).'</td>
		</tr>
		<tr>
			<td colspan="2">9. Declaration<br/>
			I do hereby declare that the statements made and information given above are true to the best of my knowledge and belief and that I have not concealed any information.<br/>
			I do also hereby undertake to provide any further information sought by the prescribed authority in relation to these rules and to fulfill any conditions stipulated by the prescribed authority.
			</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr>
            <td >Date:<b>'.date('d-m-Y',strtotime($today)).'</b><br/>
			Place:<b>'.strtoupper($dist).'</b>
			</td>
            <td align="right">
				Signature:<b>'.strtoupper($key_person).'</b><br/>
				Designation:<b>'.strtoupper($status_applicant).'</b>            
            </td>
        </tr>  
	</table>';
?>