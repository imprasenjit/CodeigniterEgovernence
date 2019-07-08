<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','7');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=7&dept=dic';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$q=$dic->query("select * from dic_form7 where user_id='$swr_id'") or die($dci->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		#### PART 1 #####
		$mandtory_cert="";$registration_no="";$post_office="";$manufac_service="";	
		$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		$partner_address_st1="";$partner_address_st2="";$partner_address_vt="";$partner_address_dist="";$partner_address_pin="";$partner_address_mob="";
		#### PART 2 #####
		$new_unit_em_no="";$new_unit_em_dt="";$new_unit_iem="";$new_unit_iem_dt="";
		$exist_unit_pmt="";$exist_unit_dt="";
		$land_new_unit="";$land_pr_expn="";$land_d_expn="";$land_tot_expn="";
		$site_new_unit="";$site_pr_expn="";$site_d_expn="";$site_tot_expn="";
		$off_building_new_unit="";$off_building_pr_expn="";$off_building_d_expn="";$off_building_tot_expn="";
		$fac_building_new_unit="";$fac_building_pr_expn="";$fac_building_d_expn="";$fac_building_tot_expn="";
		$plant_item_new_unit="";$plant_item_pr_expn="";$plant_item_d_expn="";$plant_item_tot_expn="";
		$elec_ins_new_unit="";$elec_ins_pr_expn="";$elec_ins_d_expn="";$elec_ins_tot_expn="";
		$operative_new_unit="";$operative_pr_expn="";$operative_d_expn="";$operative_tot_expn="";
		$fixed_asset_new_unit="";$fixed_asset_pr_expn="";$fixed_asset_d_expn="";$fixed_asset_tot_expn="";
		$total_invest_new_unit="";$total_invest_pr_expn="";$total_invest_d_expn="";$total_invest_tot_expn="";
		$soruces_promoters="";$soruces_equity="";$soruces_term="";$soruces_loan="";$soruces_resource="";$soruces_other="";
		$total="";
		#### PART 3 #####
		$is_building="";$built_up_area="";$statement="";		
		$power_a_s_load="";$power_a_c_load="";$power_a_capacity="";
		$under_expan_sanc_load="";$under_expan_con_load="";$under_expan_sanc_exp="";$under_expan_con_exp="";$under_expan_capacity="";
		$ownland_area="";$purchase_dt="";$dt_of_reg="";
		$land_alloted_alot_dt="";$land_alloted_poss_dt="";
		$lease_land_dt="";$lease_land_period="";
		
		#### PART 4 #####
		$file1="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];$post_office=$results['post_office'];$manufac_service=$results['manufac_service'];
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
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_pmt=$exist_unit->pmt;$exist_unit_dt=$exist_unit->dt;
		}else{
			$exist_unit_pmt="";$exist_unit_dt="";
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
		$purchase_dt=$results['purchase_dt'];$dt_of_reg=$results['dt_of_reg'];$is_building=$results['is_building'];$built_up_area=$results['built_up_area'];$statement=$results['statement'];	
		if(!empty($results['ownland_area'])){
			$ownland_area=json_decode($results['ownland_area']);
			$ownland_area_land=$ownland_area->land;$ownland_area_rev=$ownland_area->rev;$ownland_area_dag=$ownland_area->dag;$ownland_area_patta=$ownland_area->patta;
		}else{
			$ownland_area_land="";$ownland_area_rev="";$ownland_area_dag="";$ownland_area_patta="";
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
		if(!empty($results["lease_land"])){
			$lease_land=json_decode($results["lease_land"]);
			$lease_land_dt=$lease_land->dt;$lease_land_period=$lease_land->period;
		}else{
			$lease_land_dt="";$lease_land_period="";
		}
		$file1=$results['file1'];
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}			
	}
	
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==8){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="active";$tabbtn9="";
	}
	if($showtab==9){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn10="active";
	}
	if($showtab==10){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";$tabbtn10="active";
	}
	##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
	</style>
	<?php include ("dic_form7_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center"><strong><?php echo $form_name=$formFunctions->get_formName('dic','7'); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Upload section</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td width="25%">1. a) Name of the Industrial Unit  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"   value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">b) Address of the Factory :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_vill;?>"></td>
										<td>Post office</td>
										<td><input type="text" class="form-control text-uppercase" name="post_office" value="<?php echo $post_office;?>" required ></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_pincode;?>"></td>
									</tr>
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo'+91'. $b_mobile_no;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">c) Address of the Office :   </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st1]" value="<?php echo $office_address_st1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="office_address[st2]" value="<?php echo $office_address_st2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[vt]" value="<?php echo $office_address_vt;?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="office_address[dist]"" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($office_address_dist) && ($office_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[pin]" value="<?php echo $office_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="office_address[mob]" value="<?php echo $office_address_mob;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>	
									<tr>
										<td>d) E-Mail ID</td>
										<td><input type="email" class="form-control" name="office_address[email]" value="<?php echo $office_address_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">e) Registered Address  :   </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name3;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name4;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $b_vill2;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist2;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode2;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>2. a) Constitution of the unit</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val; ?>"/></td>
										<td>b) Name(s) of the <?php echo $l_o_business_name; ?>    </td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $Name_of_owner;?>"></td>
									</tr>
									<tr>
										<td>PAN </td>
										<td><input type="text" class="form-control text-uppercase" readonly="readonly" name="pan_no" value="<?php echo $pan_no;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">Address(es) of the Proprietor/ Partners / Directors/ Secretary and President of the Cooperative Society :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="partner_address[st1]" value="<?php echo $partner_address_st1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="partner_address[st2]" value="<?php echo $partner_address_st2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="partner_address[vt]" value="<?php echo $partner_address_vt;?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                    <select name="partner_address[dist]"" class="form-control text-uppercase"><?php
							                while($dstrows=$dstresult->fetch_object()) { 
								                  if(isset($partner_address_dist) && ($partner_address_dist==$dstrows->district)) $s='selected'; else $s=''; ?>
								            <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
							                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="partner_address[pin]" value="<?php echo $partner_address_pin;?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" name="partner_address[mob]" value="<?php echo $partner_address_mob;?>" validate="mobileNumber" maxlength="10"></td>
									</tr>
									<tr>
										<td colspan="2">3.(a) Whether new unit or existing unit undergoing expansion  </td>
										<td colspan="2"><?php if($is_business_started=="N") echo "New Unit"; else echo "Existing Unit";?></td>
									</tr>
									<tr>
										<td colspan="2">(b) <?php if($is_business_started=="N") echo "Date of commencement of commercial production/operation"; else echo "Date of commencement of commercial production/operation after expansion";?>  </td>
										<td colspan="2"><?php echo date("d-m-Y",strtotime($date_of_commencement)); ?></td>
									</tr>
									<tr>
										<td colspan="2">c) Whether Manufacturing or Service sector   </td>
										<td colspan="2"><label class="radio-inline"><input type="radio" checked="checked" name="manufac_service" value="M"  <?php if((isset($manufac_service) ) AND ($manufac_service=='M')) echo 'checked'; ?> />  Manufacturing</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="manufac_service"  value="S"  <?php if((isset($manufac_service) ) AND ($manufac_service=='S')) echo 'checked'; ?>/> Service</label></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save7a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">										
									<tr>
										<td colspan="4">4. Details of Registration:</td>
									</tr> 
									<tr>
										<td colspan="4">a) In case of New unit :</td>
									</tr>
									<tr>
										<td width="25%">i.(a)  EM - part-II No </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="new_unit[em_no]" value="<?php echo $new_unit_em_no;?>"></td>
										<td width="25%">(b)  Date </td> 
										<td width="25%"><input type="text" class="form-control text-uppercase dob" name="new_unit[em_dt]" value="<?php echo $new_unit_em_dt;?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td>ii.(a)  IEM No </td>
										<td><input type="text" class="form-control text-uppercase" name="new_unit[iem]" value="<?php echo $new_unit_iem;?>"></td>
										<td>(b) Date </td> 
										<td><input type="text" class="form-control text-uppercase dob" name="new_unit[iem_dt]" value="<?php echo $new_unit_iem_dt;?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">b) In case of Existing unit undergoing expansion :</td>
									</tr>
									<tr>
										<td>Permanent (PMT) Registration/ IEM/ EM-part-II No.</td>
										<td><input type="text" class="form-control text-uppercase" name="exist_unit[pmt]" value="<?php echo $exist_unit_pmt;?>"></td>
										<td> Date </td> 
										<td><input type="text" class="form-control text-uppercase dob" name="exist_unit[dt]" value="<?php echo $exist_unit_dt;?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="2">c) Mandatory/Obligatory Certificate of registration/approval from the concerned department as applicable (in case of Service Sector units)  </td>
										<td><input type="text" class="form-control text-uppercase" name="mandtory_cert" value="<?php echo $mandtory_cert;?>"></td>
										<td></td>
									</tr>
									<tr>
										<td>5. Registration No. under NEIIPP, 2007 (Form:1A/1B) </td>
										<td><input type="text" class="form-control text-uppercase" name="registration_no" value="<?php echo $registration_no;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">6. Fixed Capital Investment (in Rs. without decimal) (if no fig, put Zero) :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">	
											<tr>
												<th rowspan="2" class="text-center" width="20%"> Particulars</th>
												<th rowspan="2" class="text-center" width="20%"> For New Unit</th>
												<th colspan="3" class="text-center">For Existing Unit undergoing expansion</th>
											</tr>
											<tr>
												<th class="text-center" width="20">Prior Expansion</th>
												<th class="text-center" width="20"> During Expansion</th>
												<th class="text-center" width="20"> Total After Expansion</th>
											</tr>									
											<tr>
												<td width="20%">a) Land</td>
												<td width="20%"><input type="text" class=" addTotal_a form-control text-uppercase" name="land[new_unit]"  value="<?php echo $land_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="land[pr_expn]" value="<?php echo $land_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="land[d_expn]" value="<?php echo $land_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="land[tot_expn]" value="<?php echo $land_tot_expn;?>" validate="onlyNumbers"></td>
											</tr>
											<tr>
												<td width="20%">b) Site Development</td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="site[new_unit]" value="<?php echo $site_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="site[pr_expn]" value="<?php echo $site_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="site[d_expn]" value="<?php echo $site_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="site[tot_expn]" value="<?php echo $site_tot_expn;?>" validate="onlyNumbers"></td>
											</tr> 				
											<tr>
												<td colspan="4">c) Building</td>
											</tr>
											<tr>
												<td width="20%">i. Office Building</td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="off_building[new_unit]" value="<?php echo $off_building_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="off_building[pr_expn]" value="<?php echo $off_building_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="off_building[d_expn]" value="<?php echo $off_building_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="off_building[tot_expn]" value="<?php echo $off_building_tot_expn;?>" validate="onlyNumbers"></td>
											</tr> 				
											<tr>
												<td width="20%">ii.Factory Building</td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="fac_building[new_unit]" value="<?php echo $fac_building_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="fac_building[pr_expn]" value="<?php echo $fac_building_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="fac_building[d_expn]" value="<?php echo $fac_building_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="fac_building[tot_expn]" value="<?php echo$fac_building_tot_expn;?>" validate="onlyNumbers"></td>
											</tr> 				
											<tr>
												<td width="20%">d) Plant and Machinery/Component/Item 	</td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="plant_item[new_unit]" value="<?php echo $plant_item_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="plant_item[pr_expn]" value="<?php echo $plant_item_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="plant_item[d_expn]" value="<?php echo $plant_item_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="plant_item[tot_expn]" value="<?php echo $plant_item_tot_expn;?>" validate="onlyNumbers"></td>
											</tr>			
											<tr>
												<td width="20%">e) Electrical Installation 	</td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="elec_ins[new_unit]" value="<?php echo $elec_ins_new_unit;?>"  validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="elec_ins[pr_expn]" value="<?php echo $elec_ins_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="elec_ins[d_expn]" value="<?php echo $elec_ins_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="elec_ins[tot_expn]" value="<?php echo $elec_ins_tot_expn;?>" validate="onlyNumbers"></td>
											</tr>			
											<tr>
												<td width="20%">f) Preliminary and pre-operative expenses </td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="operative[new_unit]" value="<?php echo $operative_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="operative[pr_expn]" value="<?php  echo$operative_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="operative[d_expn]" value="<?php echo $operative_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="operative[tot_expn]" value="<?php echo $operative_tot_expn;?>"validate="onlyNumbers"></td>
											</tr>		
											<tr>
												<td width="20%">g) Miscellaneous Fixed Assets </td>
												<td width="20%"><input type="text" class="addTotal_a form-control text-uppercase" name="fixed_asset[new_unit]" value="<?php echo $fixed_asset_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_b form-control text-uppercase"  name="fixed_asset[pr_expn]" value="<?php echo $fixed_asset_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_c form-control text-uppercase"  name="fixed_asset[d_expn]" value="<?php echo $fixed_asset_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="addTotal_d form-control text-uppercase"  name="fixed_asset[tot_expn]" value="<?php echo $fixed_asset_tot_expn;?>" validate="onlyNumbers"></td>
											</tr>				
											<tr>
												<td width="20%">TOTAL</td>
												<td width="20%"><input type="text" class="form-control text-uppercase" name="total_invest[new_unit]" readonly id="new_unit" value="<?php echo $total_invest_new_unit;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="form-control text-uppercase"  name="total_invest[pr_expn]" readonly id="pr_expn" value="<?php echo $total_invest_pr_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="form-control text-uppercase"  name="total_invest[d_expn]" readonly id="d_expn" value="<?php echo $total_invest_d_expn;?>" validate="onlyNumbers"></td>
												<td width="20%"><input type="text" class="form-control text-uppercase"  name="total_invest[tot_expn]" readonly id="tot_expn" value="<?php echo $total_invest_tot_expn;?>" validate="onlyNumbers"></td>
											</tr>
										</table>
										</td>
									</tr>	
									<tr>
										<td>7. a) Source of Finance:</td>
									</tr>
									<tr>
										<td width="25%"> i.   Promoters Contribution</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[promoters]" value="<?php echo $soruces_promoters;?>" validate="onlyNumbers"></td>
										<td width="25%">  ii.  Equity</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[equity]" value="<?php echo $soruces_equity;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%"> iii. Term Loan</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[term]" value="<?php echo $soruces_term;?>" validate="onlyNumbers"></td>
										<td width="25%">    iv. Unsecured Loan</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[loan]" value="<?php echo $soruces_loan;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%">v.  Internal Resources</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[resoruce]" value="<?php echo $soruces_resource;?>" validate="onlyNumbers"></td>
										<td width="25%"> vi. Any other Source (please specify)</td>
										<td width="25%"><input type="text" class="addTotal2 form-control text-uppercase" name="soruces[other]" value="<?php echo $soruces_other;?>" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td width="25%"> TOTAL</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" readonly id="total" name="total" value="<?php echo $total;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="dic_form7.php?tab=1" type="button" class=" btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success" name="save7b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">															
									<tr>
										<td colspan="4">7. b) Details of Term/ Working capital Loan (if any) (In Rupees):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive">
											<thead>
												<tr>												
													<th width="25%"> Name of Bank/Financial Institution </th>	
													<th width="25%"> Amount of Term/Working Capital Loan Sanctioned</th>
													<th width="25%"> Sanction Letter No. & Date</th>
													<th width="25%"> Amount of Term/Working Capital Loan Disbursed</th>
												</tr>
											</thead>
											<?php
											$part1=$dic->query("SELECT * FROM dic_form7_t1 WHERE form_id='$form_id'");
											$num = $part1->num_rows;
											if($num>0){
											  $count=1;
											  while($row_1=$part1->fetch_array()){	?>
											<tr>
												<td><input type="text" id="txtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["bank_name"]; ?>" name="txtA<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_1["amount_of_term"]; ?>" id="txtB<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" size="25" name="txtB<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_1["letter_no"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="25"></td>
												<td><input type="text" value="<?php echo $row_1["loan_disbursed"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" size="25" name="txtD<?php echo $count;?>"></td>					
											</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input type="text" id="txtA1" size="25"  class="form-control text-uppercase" name="txtA1"></td>
											<td><input type="text" id="txtB1" size="25" validate="onlyNumbers"  class="form-control text-uppercase" name="txtB1"></td>					
											<td><input type="text" id="txtC1" size="25" class="form-control text-uppercase"  name="txtC1"></td>
											<td><input type="text" id="txtD1" size="25" validate="onlyNumbers"  class="form-control text-uppercase" name="txtD1"></td>		
										</tr>
										<?php } ?>
										</table>
										<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</div>
										</td>
									</tr>	
									<tr>
										<td colspan="4">7. c) Details of Equity (if any):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive">
											<thead>
												<tr>												
													<th width="25%"> Name of person(s)</th>	
													<th width="25%"> Amount</th>
													<th width="25%"> PAN No.</th>
													<th width="25%"> Mode of Payment</th>
												</tr>
											</thead>
											<?php
											$part2=$dic->query("SELECT * FROM dic_form7_t2 WHERE form_id='$form_id'");
											$num2 = $part2->num_rows;
											if($num2>0){
											  $count=1;
											  while($row_2=$part2->fetch_array()){	?>
											<tr>
												<td><input type="text"  id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="textA<?php echo $count;?>" validate="letters" size="25"></td>
												<td><input type="text" value="<?php echo $row_2["amount"]; ?>" id="textB<?php echo $count;?>" validate="onlyNumbers" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
												<td><input type="text" value="<?php echo $row_2["pan_no"]; ?>"  id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>
												<td><input type="text" value="<?php echo $row_2["payment_mode"]; ?>"  id="textD<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>"></td>								
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input type="text" id="textA1" validate="letters" size="25" class="form-control text-uppercase" name="textA1"></td>
												<td><input type="text" id="textB1" size="25" validate="onlyNumbers"  class="form-control text-uppercase" name="textB1"></td>					
												<td><input type="text" id="textC1" size="25" class="form-control text-uppercase"  name="textC1"></td>
												<td><input type="text" id="textD1" size="25"  class="form-control text-uppercase" name="textD1"></td>			
														
											</tr>
											<?php } ?>
										</table>
											<div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
										</div>
										</td>
									</tr>
									
									<tr>
										<td colspan="4">7. d) Details of unsecured loan (if any):</td></tr>
									<tr>
										<td colspan="4">
										<table name="objectTable3" id="objectTable3" class="table table-responsive">
											<thead>
												<tr>												
													<th width="25%"> Name of person(s)</th>	
													<th width="25%"> Amount</th>
													<th width="25%"> PAN No.</th>
													<th width="25%"> Mode of Payment</th>
												</tr>
											</thead>
											<?php
											$part3=$dic->query("SELECT * FROM dic_form7_t3 WHERE form_id='$form_id'");
											$num3 = $part3->num_rows;
											if($num3>0){
											  $count=1;
											  while($row_3=$part3->fetch_array()){	?>
											<tr>
												<td><input type="text" id="txxtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name"]; ?>" name="txxtA<?php echo $count;?>" validate="letters" size="25"></td>
												<td><input type="text" id="txxtB<?php echo $count;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $row_3["amount"]; ?>" name="txxtB<?php echo $count;?>" size="20"></td>
												<td><input type="text" value="<?php echo $row_3["pan_no"]; ?>" id="txxtC<?php echo $count;?>" class="form-control text-uppercase" name="txxtC<?php echo $count;?>"></td>		
												<td><input type="text" value="<?php echo $row_3["payment_mode"]; ?>" id="txxtD<?php echo $count;?>" class="form-control text-uppercase" name="txxtD<?php echo $count;?>"  ></td>
											</tr>	
											<?php $count++; } 
											}else{	?>
											<tr>
												<td><input type="text" id="txxtA1" validate="letters" size="25" class="form-control text-uppercase" name="txxtA1"></td>
												<td><input type="text" validate="onlyNumbers" id="txxtB1" class="form-control text-uppercase" name="txxtB1"></td>
												<td><input type="text" id="txxtC1"  class="form-control text-uppercase" name="txxtC1"></td>					
												<td><input type="text" id="txxtD1" class="form-control text-uppercase" name="txxtD1"></td>
											</tr>
											<?php } ?>
										</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">[Details as per Form 1C(F)]</td>
									</tr>
									<tr>
										<td colspan="4">8. POWER</td>
									</tr>
									<tr>
										<td colspan="4">a) In case of New Units:</td>
									</tr>
									<tr>
										<td width="25%">  i.   Sanctioned Load</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="power_a[s_load]" value="<?php echo $power_a_s_load;?>"></td>
										<td width="25%">   ii.  Connected Load</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="power_a[c_load]" value="<?php echo $power_a_c_load;?>"></td>
									</tr>
									<tr>
										<td width="25%"> iii. Capacity of Captive Load (if any)</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="power_a[capacity]" value="<?php echo $power_a_capacity;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">b) In case of Existing Units undergoing Expansion:</td>
									</tr>
									<tr>
										<td width="25%"> i.   Sanctioned Load prior to expansion</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="under_expan[sanc_load]" value="<?php echo $under_expan_sanc_load;?>"></td>
										<td width="25%"> ii.  Connected Load prior to expansion</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="under_expan[con_load]" value="<?php echo $under_expan_con_load;?>"></td>
									</tr>
									<tr>
										<td width="25%">iii. Sanction of additional Load for expansion</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="under_expan[sanc_exp]" value="<?php echo $under_expan_sanc_exp;?>"></td>
										<td width="25%">iv. Additional Connected Load for expansion</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="under_expan[con_exp]" value="<?php echo $under_expan_con_exp;?>"></td>
									</tr>
									<tr>
										<td width="25%">v.  Capacity of Captive Power Plant (if any)</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="under_expan[capacity]" value="<?php echo $under_expan_capacity;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>9. DETAILS OF LAND AND BUILDING:</td>
									</tr>
									<tr>
										<td colspan="4"> A. Land</td>
									</tr>
									<tr>
										<td colspan="4"> a) OwnLand</td>
									</tr>
									<tr>
										<td width="25%">i.   Land area</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ownland_area[land]" value="<?php echo $ownland_area_land;?>"></td>
										<td width="25%">Revenue Village</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ownland_area[rev]" value="<?php echo $ownland_area_rev;?>"></td>
									</tr>
									<tr>
										<td width="25%">Dag No.</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ownland_area[dag]" value="<?php echo $ownland_area_dag;?>"></td>
										<td width="25%">Patta No.</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ownland_area[patta]" value="<?php echo $ownland_area_patta;?>"></td>
									</tr>
									<tr>
										<td width="25%">ii.  Date of Purchase</td>
										<td width="25%"><input type="text" class="form-control text-uppercase dob"  name="purchase_dt" value="<?php echo $purchase_dt;?>" readonly="readonly"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>iii. Date of Registration</td>
										<td><input type="text" class="form-control text-uppercase dob" name="dt_of_reg" value="<?php echo $dt_of_reg;?>" readonly="readonly"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4"> b) Land allotted by Government/Government agency</td></tr>
									<tr>
										<td>i.Date of allotment/ agreement </td>
										<td><input type="text" class="form-control text-uppercase dob" name="land_alloted[alot_dt]" value="<?php echo $land_alloted_alot_dt;?>" readonly="readonly"></td>
										<td>ii.Date of taking over possession</td>
										<td><input type="text" class="form-control text-uppercase dob" name="land_alloted[poss_dt]" value="<?php echo $land_alloted_poss_dt;?>" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4"> c) Lease hold Land</td>
									</tr>
									<tr>
										<td>i.Date of lease of land</td>
										<td><input type="text" class="form-control text-uppercase dob" name="lease_land[dt]" value="<?php echo $lease_land_dt;?>" readonly="readonly"></td>
										<td width="25%">  ii.  Period of lease </td>
										<td><input type="text" class="form-control text-uppercase" name="lease_land[period]" value="<?php echo $lease_land_period;?>"></td>
									</tr> 
									<tr>
										<td colspan="4">B. Building</td>
									</tr>
									<tr>
										<td>a) Own Building/ Rented Building</td>
										<td><label class="radio-inline"><input type="radio" checked="checked" name="is_building" value="O"  <?php if((isset($is_building) ) AND ($is_building=='O')) echo 'checked'; ?> />   Own Building</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_building"  value="R"  <?php if((isset($is_building) ) AND ($is_building=='R')) echo 'checked'; ?>/> Rented Building</label></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>i. In case of own building built up area </td>
										<td><input type="text" class="form-control text-uppercase" name="built_up_area" value="<?php echo $built_up_area;?>" maxlength="255"></td>
										<td></td>
										<td></td>
									</tr> 
									<tr>
										<td colspan="2">10. Statement of Investment in Plant & Machinery as per Form:1C(A)(in rupees) </td>
										<td><input type="text" class="form-control text-uppercase" name="statement" value="<?php echo $statement;?>"></td>
										<td></td>
									</tr>																
									<tr>
										<td >Date : <b><?php echo date('d-m-Y',strtotime($today));?></b> <br/> Place : <label><?php echo strtoupper($dist);?> </label></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr><td class="text-center" colspan="4"></td></tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="dic_form7.php?tab=2" type="button" class=" btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success" name="save7c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">	
									<tr>
										<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mandatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
									</tr>
									<tr>
										<td width="50%">Any Upload </td>
										<td width="10%">
										<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
										</td>
										<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</td>
										<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</td>	
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="dic_form7.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success" name="submit7" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
	$('.addTotal_a').on('change', function(){
		var sum = 0;
		$('.addTotal_a').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#new_unit').val(sum);
		});
	});
	$('.addTotal_b').on('change', function(){
		var sum = 0;
		$('.addTotal_b').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#pr_expn').val(sum);
		});
	});
	$('.addTotal_c').on('change', function(){
		var sum = 0;
		$('.addTotal_c').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#d_expn').val(sum);
		});
	});
	$('.addTotal_d').on('change', function(){
		var sum = 0;
		$('.addTotal_d').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#tot_expn').val(sum);
		});
	});
	$('.addTotal2').on('change', function(){
		var sum = 0;
		$('.addTotal2').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			$('#total').val(sum);
		});
	});
	/* ----------------------------------------------------- */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>