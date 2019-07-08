<?php 
$dept="dic";
$form="7";
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
		$post_office=$results['post_office'];
		if($results['manufac_service']=='M'){
			$manufac_service='MANUFACTURING';
		}elseif($results['manufac_service']=='S'){
			$manufac_service='SERVICE';
		}
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}	
		if(!empty($results["partner_address"])){
			$partner_address=json_decode($results["partner_address"]);
			$partner_address_st1=$partner_address->st1;$partner_address_st2=$partner_address->st2;$partner_address_vt=$partner_address->vt;$partner_address_dist=$partner_address->dist;$partner_address_pin=$partner_address->pin;$partner_address_mob=$partner_address->mob;
		}else{
			$partner_address_st1="";$partner_address_st2="";$partner_address_vt="";$partner_address_dist="";$partner_address_pin="";$partner_address_mob="";$partner_address_email="";
		}
		#### PART 2 #####
		$mandtory_cert=$results['mandtory_cert'];$registration_no=$results['registration_no'];$total=$results['total'];	
		if(!empty($results["new_unit"])){
			$new_unit=json_decode($results["new_unit"]);
			$new_unit_em_no=$new_unit->em_no;$new_unit_em_dt=$new_unit->em_dt;$new_unit_iem=$new_unit->iem;$new_unit_iem_dt=$new_unit->iem_dt;
		}else{
			$new_unit_em_no="";$new_unit_em_dt="";$new_unit_iem="";$new_unit_iem_dt="";
		}
		if($new_unit_em_dt!="" && $new_unit_em_dt!="0000-00-00"){
			$new_unit_em_dt = date('d-m-Y',strtotime($new_unit_em_dt));
		}else{
			$new_unit_em_dt="";
		}
		if($new_unit_iem_dt!="" && $new_unit_iem_dt!="0000-00-00"){
			$new_unit_iem_dt = date('d-m-Y',strtotime($new_unit_iem_dt));
		}else{
			$new_unit_iem_dt="";
		}
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_pmt=$exist_unit->pmt;$exist_unit_dt=$exist_unit->dt;
		}else{
			$exist_unit_pmt="";$exist_unit_dt="";
		}
		if($exist_unit_dt!="" && $exist_unit_dt!="0000-00-00"){
			$exist_unit_dt = date('d-m-Y',strtotime($exist_unit_dt));
		}else{
			$exist_unit_dt="";
		}
		if(!empty($results["land"])){
			$land=json_decode($results["land"]);
			$land_new_unit=$land->new_unit;$land_pr_expn=$land->pr_expn;$land_d_expn=$land->d_expn;$land_tot_expn=$land->tot_expn;
		}else{
			$land_new_unit="";$land_pr_expn="";$land_d_expn="";$land_tot_expn="";
		}
		if(!empty($results["site"])){
			$site=json_decode($results["site"]);
			$site_new_unit=$site->new_unit;$site_pr_expn=$site->pr_expn;$site_d_expn=$site->d_expn;$site_tot_expn=$site->tot_expn;
		}else{
			$site_new_unit="";$site_pr_expn="";$site_d_expn="";$site_tot_expn="";
		}
		if(!empty($results["off_building"])){
			$off_building=json_decode($results["off_building"]);
			$off_building_new_unit=$off_building->new_unit;$off_building_pr_expn=$off_building->pr_expn;$off_building_d_expn=$off_building->d_expn;$off_building_tot_expn=$off_building->tot_expn;
		}else{
			$off_building_new_unit="";$off_building_pr_expn="";$off_building_d_expn="";$off_building_tot_expn="";
		}
		if(!empty($results["fac_building"])){
			$fac_building=json_decode($results["fac_building"]);
			$fac_building_new_unit=$fac_building->new_unit;$fac_building_pr_expn=$fac_building->pr_expn;$fac_building_d_expn=$fac_building->d_expn;$fac_building_tot_expn=$fac_building->tot_expn;
		}else{
			$fac_building_new_unit="";$fac_building_pr_expn="";$fac_building_d_expn="";$fac_building_tot_expn="";
		}
		if(!empty($results["plant_item"])){
			$plant_item=json_decode($results["plant_item"]);
			$plant_item_new_unit=$plant_item->new_unit;$plant_item_pr_expn=$plant_item->pr_expn;$plant_item_d_expn=$plant_item->d_expn;$plant_item_tot_expn=$plant_item->tot_expn;
		}else{
			$plant_item_new_unit="";$plant_item_pr_expn="";$plant_item_d_expn="";$plant_item_tot_expn="";
		}
		if(!empty($results["elec_ins"])){
			$elec_ins=json_decode($results["elec_ins"]);
			$elec_ins_new_unit=$elec_ins->new_unit;$elec_ins_pr_expn=$elec_ins->pr_expn;$elec_ins_d_expn=$elec_ins->d_expn;$elec_ins_tot_expn=$elec_ins->tot_expn;
		}else{
			$elec_ins_new_unit="";$elec_ins_pr_expn="";$elec_ins_d_expn="";$elec_ins_tot_expn="";
		}
		if(!empty($results["operative"])){
			$operative=json_decode($results["operative"]);
			$operative_new_unit=$operative->new_unit;$operative_pr_expn=$operative->pr_expn;$operative_d_expn=$operative->d_expn;$operative_tot_expn=$operative->tot_expn;
		}else{
			$operative_new_unit="";$operative_pr_expn="";$operative_d_expn="";$operative_tot_expn="";
		}
		if(!empty($results["fixed_asset"])){
			$fixed_asset=json_decode($results["fixed_asset"]);
			$fixed_asset_new_unit=$fixed_asset->new_unit;$fixed_asset_pr_expn=$fixed_asset->pr_expn;$fixed_asset_d_expn=$fixed_asset->d_expn;$fixed_asset_tot_expn=$fixed_asset->tot_expn;
		}else{
			$fixed_asset_new_unit="";$fixed_asset_pr_expn="";$fixed_asset_d_expn="";$fixed_asset_tot_expn="";
		}
		if(!empty($results["total_invest"])){
			$total_invest=json_decode($results["total_invest"]);
			$total_invest_new_unit=$total_invest->new_unit;$total_invest_pr_expn=$total_invest->pr_expn;$total_invest_d_expn=$total_invest->d_expn;$total_invest_tot_expn=$total_invest->tot_expn;
		}else{
			$total_invest_new_unit="";$total_invest_pr_expn="";$total_invest_d_expn="";$total_invest_tot_expn="";
		}
		if(!empty($results["soruces"])){
			$soruces=json_decode($results["soruces"]);
			$soruces_promoters=$soruces->promoters;$soruces_equity=$soruces->equity;$soruces_term=$soruces->term;$soruces_loan=$soruces->loan;$soruces_resource=$soruces->resoruce;$soruces_other=$soruces->other;
		}else{
			$soruces_promoters="";$soruces_equity="";$soruces_term="";$soruces_loan="";$soruces_resource="";$soruces_other="";
		}
		##### Part 3 #####
		$purchase_dt=$results['purchase_dt'];
		if($purchase_dt!="" && $purchase_dt!="0000-00-00"){
			$purchase_dt = date('d-m-Y',strtotime($purchase_dt));
		}else{
			$purchase_dt="";
		}
		$dt_of_reg=$results['dt_of_reg'];
		if($dt_of_reg!="" && $dt_of_reg!="0000-00-00"){
			$dt_of_reg = date('d-m-Y',strtotime($dt_of_reg));
		}else{
			$dt_of_reg="";
		}
		$built_up_area=$results['built_up_area'];$statement=$results['statement'];	
		if(!empty($results['ownland_area'])){
			$ownland_area=json_decode($results['ownland_area']);
			$ownland_area_land=$ownland_area->land;$ownland_area_rev=$ownland_area->rev;$ownland_area_dag=$ownland_area->dag;$ownland_area_patta=$ownland_area->patta;
		}else{
			$ownland_area_land="";$ownland_area_rev="";$ownland_area_dag="";$ownland_area_patta="";
		}
		if($results['is_building']=='O'){
			$is_building='Own Building';
		}elseif($results['is_building']=='R'){
			$is_building='Rented Building';
		}
		if(!empty($results["power_a"])){
			$power_a=json_decode($results["power_a"]);
			$power_a_s_load=$power_a->s_load;$power_a_c_load=$power_a->c_load;$power_a_capacity=$power_a->capacity;
		}else{
			$power_a_s_load="";$power_a_c_load="";$power_a_capacity="";
		}
		if(!empty($results["under_expan"])){
			$under_expan=json_decode($results["under_expan"]);
			$under_expan_sanc_load=$under_expan->sanc_load;$under_expan_con_load=$under_expan->con_load;$under_expan_sanc_exp=$under_expan->sanc_exp;$under_expan_con_exp=$under_expan->con_exp;$under_expan_capacity=$under_expan->capacity;
		}else{
			$under_expan_sanc_load="";$under_expan_con_load="";$under_expan_sanc_exp="";$under_expan_con_exp="";$under_expan_capacity="";
		}
		if(!empty($results["land_alloted"])){
			$land_alloted=json_decode($results["land_alloted"]);
			$land_alloted_alot_dt=$land_alloted->alot_dt;$land_alloted_poss_dt=$land_alloted->poss_dt;
		}else{
			$land_alloted_alot_dt="";$land_alloted_poss_dt="";
		}
		if($land_alloted_alot_dt!="" && $land_alloted_alot_dt!="0000-00-00"){
			$land_alloted_alot_dt = date('d-m-Y',strtotime($land_alloted_alot_dt));
		}else{
			$land_alloted_alot_dt="";
		}
		if($land_alloted_poss_dt!="" && $land_alloted_poss_dt!="0000-00-00"){
			$land_alloted_poss_dt = date('d-m-Y',strtotime($land_alloted_poss_dt));
		}else{
			$land_alloted_poss_dt="";
		}
		if(!empty($results["lease_land"])){
			$lease_land=json_decode($results["lease_land"]);
			$lease_land_dt=$lease_land->dt;$lease_land_period=$lease_land->period;
		}else{
			$lease_land_dt="";$lease_land_period="";
		}
		if($lease_land_dt!="" && $lease_land_dt!="0000-00-00"){
			$lease_land_dt = date('d-m-Y',strtotime($lease_land_dt));
		}else{
			$lease_land_dt="";
		}
		if($date_of_commencement=="N"){
			$unit_type="New Unit";
		} else{
			$unit_type="Existing Unit";
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
      <table class="table table-bordered table-responsive">
  		<tr>  				
			<td valign="top">1. a) Name of the Industrial Unit:</td>
			<td style="width:50%">'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
  		<td valign="top">b) Address of the Factory  : </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td width="50%">Street Name 1</td>
        			<td>'.strtoupper($b_street_name1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($b_street_name2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($b_vill).'</td>
      		</tr>
			<tr>
        			<td>Post office</td>
        			<td>'.strtoupper($post_office).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			<tr>
        			<td>Mobile No.</td>
        			<td>'.strtoupper($b_mobile_no).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top">c) Address of the Office :  </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($office_address_st1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($office_address_st2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($office_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($office_address_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($office_address_pin).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($office_address_mob).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>	
	<tr>
			<td>d) Email ID</td>
			<td> '.$office_address_email.'</td>
	</tr>
	<tr>
  		<td valign="top">e) Registered Address:   </td>
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
        			<td>Village/Town</td>
        			<td>'.strtoupper($b_vill).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>			
    		</table>
		</td>
  	</tr>
	<tr>
			<td>2. a) Constitution of the unit: </td>
			<td> '.strtoupper($Type_of_ownership).'</td>
	</tr>
	<tr>
			<td>b) Name(s) of the'.$Type_of_ownership.' </td>
			<td> '.strtoupper($owner_names).'</td>
	</tr>
	<tr>
			<td>PAN </td>
			<td> '.strtoupper($pan_no).'</td>
	</tr>
	<tr>
  		<td valign="top">Address(es) of the Proprietor/ Partners / Directors/ Secretary and President of the Cooperative Society :   </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($partner_address_st1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($partner_address_st2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($partner_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($partner_address_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($partner_address_pin).'</td>
      		</tr>			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($partner_address_mob).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
	<tr>
			<td>3.(a) Whether new unit or existing unit undergoing expansion </td>
			<td> '.strtoupper($unit_type).'</td>
	</tr>
	<tr>
			<td>(b) Date of commencement of commercial production/operation </td>
			<td> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
	</tr>
	<tr>
			<td>c) Whether Manufacturing or Service sector </td>
			<td> '.strtoupper($manufac_service).'</td>
	</tr>
	<tr>
			<td colspan="2">4. Details of Registration: </td>
	</tr>
	<tr>
  		<td valign="top">a) In case of New unit :   </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>i.(a) EM - part-II No</td>
        			<td>'.strtoupper($new_unit_em_no).'</td>
      		</tr>
      		<tr>
        			<td>(b) Date</td>
        			<td>'.strtoupper($new_unit_em_dt).'</td>
      		</tr>
      		<tr>
        			<td>ii.(a) IEM No</td>
        			<td>'.strtoupper($new_unit_iem).'</td>
      		</tr>
      		<tr>
        			<td>(b) Date</td>
        			<td>'.strtoupper($new_unit_iem_dt).'</td>
      		</tr>
      	</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top">b) In case of Existing unit undergoing expansion :   </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>Permanent (PMT) Registration/ IEM/ EM-part-II No.</td>
        			<td>'.strtoupper($exist_unit_pmt).'</td>
      		</tr>
      		<tr>
        			<td>Date</td>
        			<td>'.strtoupper($exist_unit_dt).'</td>
      		</tr>
      	</table>
		</td>
  	</tr>
	<tr>
        <td>c) Mandatory/Obligatory Certificate of registration/approval from the concerned department as applicable (in case of Service Sector units)</td>
        <td>'.strtoupper($mandtory_cert).'</td>
    </tr>
	<tr>
        <td>5. Registration No. under NEIIPP, 2007 (Form:1A/1B)</td>
        <td>'.strtoupper($registration_no).'</td>
    </tr>
	<tr>
        <td colspan="2">6. Fixed Capital Investment (in Rs. without decimal) (if no fig, put Zero) :</td>
    </tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">	
				<tr>
					<th rowspan="2" class="text-center"> Particulars</th>
					<th rowspan="2" class="text-center"> For New Unit</th>
					<th colspan="3" class="text-center">For Existing Unit undergoing expansion</th>
				</tr>
				<tr>
					<th class="text-center" width="20">Prior Expansion</th>
					<th class="text-center" width="20"> During Expansion</th>
					<th class="text-center" width="20"> Total After Expansion</th>
				</tr>									
				<tr>
					<td>a) Land</td>
					<td>'.strtoupper($land_new_unit).'</td>
					<td>'.strtoupper($land_pr_expn).'</td>
					<td>'.strtoupper($land_d_expn).'</td>
					<td>'.strtoupper($land_tot_expn).'</td>
				</tr>
				<tr>
					<td>b) Site Development</td>
					<td>'.strtoupper($site_new_unit).'</td>
					<td>'.strtoupper($site_pr_expn).'</td>
					<td>'.strtoupper($site_d_expn).'</td>
					<td>'.strtoupper($site_tot_expn).'</td>
				</tr> 				
				<tr>
					<td colspan="4">c) Building</td>
				</tr>
				<tr>
					<td>i. Office Building</td>
					<td>'.strtoupper($off_building_new_unit).'</td>
					<td>'.strtoupper($off_building_pr_expn).'</td>
					<td>'.strtoupper($off_building_d_expn).'</td>
					<td>'.strtoupper($off_building_tot_expn).'</td>
				</tr> 				
				<tr>
					<td>ii.Factory Building</td>
					<td>'.strtoupper($fac_building_new_unit).'</td>
					<td>'.strtoupper($fac_building_pr_expn).'</td>
					<td>'.strtoupper($fac_building_d_expn).'</td>
					<td>'.strtoupper($fac_building_tot_expn).'</td>
				</tr> 				
				<tr>
					<td>d) Plant and Machinery/Component/Item 	</td>
					<td>'.strtoupper($plant_item_new_unit).'</td>
					<td>'.strtoupper($plant_item_pr_expn).'</td>
					<td>'.strtoupper($plant_item_d_expn).'</td>
					<td>'.strtoupper($plant_item_tot_expn).'</td>
				</tr>			
				<tr>
					<td>e) Electrical Installation 	</td>
					<td>'.strtoupper($elec_ins_new_unit).'</td>
					<td>'.strtoupper($elec_ins_pr_expn).'</td>
					<td>'.strtoupper($elec_ins_d_expn).'</td>
					<td>'.strtoupper($elec_ins_tot_expn).'</td>
				</tr>			
				<tr>
					<td>f) Preliminary and pre-operative expenses </td>
					<td>'.strtoupper($operative_new_unit).'</td>
					<td>'.strtoupper($operative_pr_expn).'</td>
					<td>'.strtoupper($operative_d_expn).'</td>
					<td>'.strtoupper($operative_tot_expn).'</td>
				</tr>		
				<tr>
					<td>g) Miscellaneous Fixed Assets </td>
					<td>'.strtoupper($fixed_asset_new_unit).'</td>
					<td>'.strtoupper($fixed_asset_pr_expn).'</td>
					<td>'.strtoupper($fixed_asset_d_expn).'</td>
					<td>'.strtoupper($fixed_asset_tot_expn).'</td>
				</tr>				
				<tr>
					<td>TOTAL</td>
					<td>'.strtoupper($total_invest_new_unit).'</td>
					<td>'.strtoupper($total_invest_pr_expn).'</td>
					<td>'.strtoupper($total_invest_d_expn).'</td>
					<td>'.strtoupper($total_invest_tot_expn).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
  		<td valign="top">7. a) Source of Finance:   </td>
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>i. Promoters Contribution</td>
        			<td>'.strtoupper($soruces_promoters).'</td>
      		</tr>
      		<tr>
        			<td>ii. Equity</td>
        			<td>'.strtoupper($soruces_equity).'</td>
      		</tr>
      		<tr>
        			<td>iii. Term Loan</td>
        			<td>'.strtoupper($soruces_term).'</td>
      		</tr>
      		<tr>
        			<td>iv. Unsecured Loan</td>
        			<td>'.strtoupper($soruces_loan).'</td>
      		</tr>
			<tr>
        			<td>v. Internal Resources</td>
        			<td>'.strtoupper($soruces_resource).'</td>
      		</tr>
      		<tr>
        			<td>vi. Any other Source (please specify)</td>
        			<td>'.strtoupper($soruces_other).'</td>
      		</tr>
      		<tr>
        			<td>TOTAL</td>
        			<td>'.strtoupper($total).'</td>
      		</tr>
      	</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top" colspan="2">7. b) Details of Term/ Working capital Loan (if any) (In Rupees):  </td>
	</tr>
	<tr>
  		<td colspan="2">
			<table class="table table-bordered table-responsive">			
				<thead>
				<tr>												
					<th> Name of Bank/Financial Institution </th>	
					<th> Amount of Term/Working Capital Loan Sanctioned</th>
					<th> Sanction Letter No. & Date</th>
					<th> Amount of Term/Working Capital Loan Disbursed</th>
				</tr>
				</thead>';					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["bank_name"]).'</td>
						<td>'.strtoupper($row_1["amount_of_term"]).'</td>
						<td>'.strtoupper($row_1["letter_no"]).'</td>
						<td>'.strtoupper($row_1["loan_disbursed"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top" colspan="2">7. c) Details of Equity (if any):   </td>
	</tr>
	<tr>
  		<td colspan="2">
				<table class="table table-bordered table-responsive">			
				<thead>
				<tr>												
					<th> Name of person(s)</th>	
					<th> Amount</th>
					<th> PAN No.</th>
					<th> Mode of Payment</th>
				</tr>
				</thead>';					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["amount"]).'</td>
						<td>'.strtoupper($row_2["pan_no"]).'</td>
						<td>'.strtoupper($row_2["payment_mode"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>	
	<tr>
  		<td valign="top" colspan="2">7. d) Details of unsecured loan (if any):   </td>
	</tr>
	<tr>
  		<td colspan="2">
				<table class="table table-bordered table-responsive">			
				<thead>
				<tr>												
					<th> Name of person(s)</th>	
					<th> Amount</th>
					<th> PAN No.</th>
					<th> Mode of Payment</th>
				</tr>
				</thead>';					
					$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_3["name"]).'</td>
						<td>'.strtoupper($row_3["amount"]).'</td>
						<td>'.strtoupper($row_3["pan_no"]).'</td>
						<td>'.strtoupper($row_3["payment_mode"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>	
	<tr>
		<td colspan="2">[Details as per Form 1C(F)]</td>
	</tr>
	<tr>
		<td colspan="2">8. POWER</td>
	</tr>
	<tr>
  		<td valign="top" colspan="2">a) In case of New Units:   </td>
	</tr> 		
	<tr>
			<td>i. Sanctioned Load</td>
			<td>'.strtoupper($power_a_s_load).'</td>
	</tr>
	<tr>
			<td>ii. Connected Load</td>
			<td>'.strtoupper($power_a_c_load).'</td>
	</tr>
	<tr>
			<td>iii. Capacity of Captive Load (if any)</td>
			<td>'.strtoupper($power_a_capacity).'</td>
	</tr>
      	
  	
	<tr>
  		<td valign="top">b) In case of Existing Units undergoing Expansion:   </td>
	</tr>	
	<tr>
			<td>i. Sanctioned Load prior to expansion</td>
			<td>'.strtoupper($under_expan_sanc_load).'</td>
	</tr>
	<tr>
			<td>ii. Connected Load prior to expansion</td>
			<td>'.strtoupper($under_expan_con_load).'</td>
	</tr>
	<tr>
			<td>iii. Sanction of additional Load for expansion</td>
			<td>'.strtoupper($under_expan_sanc_exp).'</td>
	</tr>
	<tr>
			<td>iv. Additional Connected Load for expansion</td>
			<td>'.strtoupper($under_expan_con_exp).'</td>
	</tr>
	<tr>
			<td>v. Capacity of Captive Power Plant (if any)</td>
			<td>'.strtoupper($under_expan_capacity).'</td>
	</tr>
      
	<tr>
		<td colspan="2">9. DETAILS OF LAND AND BUILDING:</td>
	</tr>
	<tr>
		<td colspan="2">A. Land</td>
	</tr>
	<tr>
  		<td valign="top" colspan="2">a) OwnLand   </td>
	</tr>
	<tr>
			<td>i. Land area</td>
			<td>'.strtoupper($ownland_area_land).'</td>
	</tr>
	<tr>
			<td>Revenue Village</td>
			<td>'.strtoupper($ownland_area_rev).'</td>
	</tr>
	<tr>
			<td>Dag No.</td>
			<td>'.strtoupper($ownland_area_dag).'</td>
	</tr>
	<tr>
			<td>Patta No.</td>
			<td>'.strtoupper($ownland_area_patta).'</td>
	</tr>
	<tr>
			<td> 	ii. Date of Purchase</td>
			<td>'.strtoupper($purchase_dt).'</td>
	</tr>
	<tr>
			<td>iii. Date of Registration</td>
			<td>'.strtoupper($dt_of_reg).'</td>
	</tr>

	<tr>
  		<td valign="top" colspan="2">b) Land allotted by Government/Government agency   </td>
	</tr>  
	<tr>
			<td>i.Date of allotment/ agreement</td>
			<td>'.strtoupper($land_alloted_alot_dt).'</td>
	</tr>
	<tr>
			<td>ii.Date of taking over possession</td>
			<td>'.strtoupper($land_alloted_poss_dt).'</td>
	</tr>
    
  	
	<tr>
  		<td valign="top" colspan="2">c) Lease hold Land   </td>
	</tr> 
	<tr>
			<td>i.Date of lease of land</td>
			<td>'.strtoupper($lease_land_dt).'</td>
	</tr>
	<tr>
			<td> 	ii. Period of lease</td>
			<td>'.strtoupper($lease_land_period).'</td>
	</tr>
	<tr>
  		<td valign="top">B. Building   </td>	
  		<td>
		<table class="table table-bordered table-responsive">
      		<tr>
        			<td>a) Own Building/ Rented Building</td>
        			<td>'.strtoupper($is_building).'</td>
      		</tr>
      		<tr>
        			<td>i. In case of own building built up area</td>
        			<td>'.strtoupper($built_up_area).'</td>
      		</tr>
      	</table>
		</td>
  	</tr>
	<tr>
        <td>10. Statement of Investment in Plant & Machinery as per Form:1C(A)(in rupees)</td>
        <td>'.strtoupper($statement).'</td>
    </tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'  
			
	<tr>
		<td valign="top"> Date : &nbsp;<b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
		Place:&nbsp;<b>'.strtoupper($dist).'</b></td>
		<td valign="top" align="right">Signature : <b>'.strtoupper($key_person).'</b></td>
	</tr> 
</table>';

?>
