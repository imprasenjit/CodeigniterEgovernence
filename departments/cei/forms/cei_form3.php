<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ;// For reccuring form fill ups
	
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			########## Part A ###############
			$use_of_building=$results['use_of_building'];
			$builder_name=$results["builder_name"];
			$owner_name=$results["owner_name"];
			if(!empty($results["builder_address"])){
				$builder_address=json_decode($results["builder_address"]);
				$builder_address_sn1=$builder_address->sn1;$builder_address_sn2=$builder_address->sn2;$builder_address_vt=$builder_address->vt;$builder_address_d=$builder_address->d;$builder_address_p=$builder_address->p;$builder_address_m_no=$builder_address->m_no;$builder_address_p_no=$builder_address->p_no;
			}else{
				$builder_address_sn1="";$builder_address_sn2="";$builder_address_vt="";$builder_address_d="";$builder_address_p="";$builder_address_m_no="";$builder_address_p_no="";
			}	
			if(!empty($results["owner_address"])){
				$owner_address=json_decode($results["owner_address"]);
				$owner_address_sn1=$owner_address->sn1;$owner_address_sn2=$owner_address->sn2;$owner_address_vt=$owner_address->vt;$owner_address_d=$owner_address->d;$owner_address_p=$owner_address->p;$owner_address_m_no=$owner_address->m_no;$owner_address_p_no=$owner_address->p_no;
			}else{
				$owner_address_sn1="";$owner_address_sn2="";$owner_address_vt="";$owner_address_d="";$owner_address_p="";$owner_address_m_no="";$owner_address_p_no="";
			}	
			if(!empty($results["mb_address"]))
			{
				$mb_address=json_decode($results["mb_address"]);
				$mb_address_sn1=$mb_address->sn1;$mb_address_sn2=$mb_address->sn2;$mb_address_vt=$mb_address->vt;$mb_address_d=$mb_address->d;$mb_address_p=$mb_address->p;$mb_address_m_no=$mb_address->m_no;$mb_address_p_no=$mb_address->p_no;
			}else{
				$mb_address_sn1="";$mb_address_sn2="";$mb_address_vt="";$mb_address_d="";$mb_address_p="";$mb_address_m_no="";$mb_address_p_no="";
			}	
			if(!empty($results["particular"]))
			{
				$particular=json_decode($results["particular"]);
				$particular_area=$particular->area;;$particular_no=$particular->no;$particular_tot_floor=$particular->tot_floor;$particular_tot_height=$particular->tot_height;$particular_type=$particular->type;
			}else{
				$particular_area="";$particular_no="";$particular_tot_floor="";$particular_tot_height="";$particular_type="";
			}	
			########## Part B ###############
			$is_applied=$results["is_applied"];
			if(!empty($results["elect_inst"]))
			{
				$elect_inst=json_decode($results["elect_inst"]);
				$elect_inst_cables=$elect_inst->cables;	
				$elect_inst_cables_flr=$elect_inst_cables->flr;$elect_inst_cables_pipes=$elect_inst_cables->pipes;	$elect_inst_building=$elect_inst->building;$elect_inst_type=$elect_inst->type;$elect_inst_devices=$elect_inst->devices;$elect_inst_vol_sup=$elect_inst->vol_sup;
			}else{
				$elect_inst_cables_flr="";$elect_inst_cables_pipes=""; 
				$elect_inst_building="";$elect_inst_devices="";$elect_inst_type="";$elect_inst_vol_sup="";
			}
			if(!empty($results["control_room"]))
			{
				$control_room=json_decode($results["control_room"]);
				$control_room_constt=$control_room->constt;$control_room_door=$control_room->door;$control_room_equip=$control_room->equip;$control_room_size=$control_room->size;
			}else{
				$control_room_constt="";$control_room_door="";$control_room_equip="";$control_room_size="";
			}
			########## Part C ###############
			$name_contractor=$results["name_contractor"];
			$is_generator=$results["is_generator"];$is_generator_plan=$results["is_generator_plan"];$is_generator_plan1=$results["is_generator_plan1"];$is_generator_plan2=$results["is_generator_plan2"];
			if(!empty($results["contractor_address"]))
			{
				$contractor_address=json_decode($results["contractor_address"]);
				$contractor_address_sn1=$contractor_address->sn1;$contractor_address_sn2=$contractor_address->sn2;$contractor_address_vt=$contractor_address->vt;$contractor_address_d=$contractor_address->d;$contractor_address_p=$contractor_address->p;$contractor_address_mob=$contractor_address->mob;$contractor_address_cert_no=$contractor_address->cert_no;$contractor_address_compet=$contractor_address->compet;$contractor_address_super=$contractor_address->super;$contractor_address_lic_no=$contractor_address->lic_no;$contractor_address_valid=$contractor_address->valid;
			}else{
				$contractor_address_sn1="";$contractor_address_sn2="";$contractor_address_vt="";$contractor_address_d="";$contractor_address_p="";$contractor_address_mob="";$contractor_address_cert_no="";$contractor_address_compet="";$contractor_address_super="";$contractor_address_valid="";$contractor_address_lic_no="";
			}
		}else{
				$form_id="";
				########## Part A ###############
				$use_of_building="";		
				$builder_address_sn1="";$builder_address_sn2="";$builder_address_vt="";$builder_address_d="";$builder_address_p="";$builder_address_m_no="";$builder_address_p_no="";		
				$owner_address_sn1="";$owner_address_sn2="";$owner_address_vt="";$owner_address_d="";$owner_address_p="";$owner_address_m_no="";$owner_address_p_no="";	
				$mb_address_sn1="";$mb_address_sn2="";$mb_address_vt="";$mb_address_d="";$mb_address_p="";$mb_address_m_no="";$mb_address_p_no="";
				$particular_area="";$particular_no="";$particular_tot_floor="";$particular_tot_height="";$particular_type="";		
				$builder_name="";$owner_name="";
				########## Part B ###############
				$is_applied="";
				$elect_inst_vol_sup="";$elect_inst_type="";$elect_inst_building="";$elect_inst_devices="";$elect_inst_cables_flr="";$elect_inst_cables_pipes="";
				$control_room_constt="";$control_room_door="";$control_room_equip="";$control_room_size="";
			
				########## Part C ###############
				$name_contractor="";$contractor_address_sn1="";$contractor_address_sn2="";$contractor_address_vt="";$contractor_address_d="";$contractor_address_p="";$contractor_address_mob="";$contractor_address_cert_no="";$contractor_address_compet="";$contractor_address_super="";$contractor_address_valid="";$contractor_address_lic_no="";
				$is_generator="";$is_generator_plan="";$is_generator_plan1="";$is_generator_plan2="";
				
				
			}
		
	}else{
		
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			########## Part A ###############
			$use_of_building=$results['use_of_building'];
			$builder_name=$results["builder_name"];
			$owner_name=$results["owner_name"];
			if(!empty($results["builder_address"])){
				$builder_address=json_decode($results["builder_address"]);
				$builder_address_sn1=$builder_address->sn1;$builder_address_sn2=$builder_address->sn2;$builder_address_vt=$builder_address->vt;$builder_address_d=$builder_address->d;$builder_address_p=$builder_address->p;$builder_address_m_no=$builder_address->m_no;$builder_address_p_no=$builder_address->p_no;
			}else{
				$builder_address_sn1="";$builder_address_sn2="";$builder_address_vt="";$builder_address_d="";$builder_address_p="";$builder_address_m_no="";$builder_address_p_no="";
			}	
			if(!empty($results["owner_address"])){
				$owner_address=json_decode($results["owner_address"]);
				$owner_address_sn1=$owner_address->sn1;$owner_address_sn2=$owner_address->sn2;$owner_address_vt=$owner_address->vt;$owner_address_d=$owner_address->d;$owner_address_p=$owner_address->p;$owner_address_m_no=$owner_address->m_no;$owner_address_p_no=$owner_address->p_no;
			}else{
				$owner_address_sn1="";$owner_address_sn2="";$owner_address_vt="";$owner_address_d="";$owner_address_p="";$owner_address_m_no="";$owner_address_p_no="";
			}	
			if(!empty($results["mb_address"]))
			{
				$mb_address=json_decode($results["mb_address"]);
				$mb_address_sn1=$mb_address->sn1;$mb_address_sn2=$mb_address->sn2;$mb_address_vt=$mb_address->vt;$mb_address_d=$mb_address->d;$mb_address_p=$mb_address->p;$mb_address_m_no=$mb_address->m_no;$mb_address_p_no=$mb_address->p_no;
			}else{
				$mb_address_sn1="";$mb_address_sn2="";$mb_address_vt="";$mb_address_d="";$mb_address_p="";$mb_address_m_no="";$mb_address_p_no="";
			}	
			if(!empty($results["particular"]))
			{
				$particular=json_decode($results["particular"]);
				$particular_area=$particular->area;;$particular_no=$particular->no;$particular_tot_floor=$particular->tot_floor;$particular_tot_height=$particular->tot_height;$particular_type=$particular->type;
			}else{
				$particular_area="";$particular_no="";$particular_tot_floor="";$particular_tot_height="";$particular_type="";
			}	
			########## Part B ###############
			$is_applied=$results["is_applied"];
			if(!empty($results["elect_inst"]))
			{
				$elect_inst=json_decode($results["elect_inst"]);
				$elect_inst_cables=$elect_inst->cables;	
				$elect_inst_cables_flr=$elect_inst_cables->flr;$elect_inst_cables_pipes=$elect_inst_cables->pipes;	$elect_inst_building=$elect_inst->building;$elect_inst_type=$elect_inst->type;$elect_inst_devices=$elect_inst->devices;$elect_inst_vol_sup=$elect_inst->vol_sup;
			}else{
				$elect_inst_cables_flr="";$elect_inst_cables_pipes=""; 
				$elect_inst_building="";$elect_inst_devices="";$elect_inst_type="";$elect_inst_vol_sup="";
			}
			if(!empty($results["control_room"]))
			{
				$control_room=json_decode($results["control_room"]);
				$control_room_constt=$control_room->constt;$control_room_door=$control_room->door;$control_room_equip=$control_room->equip;$control_room_size=$control_room->size;
			}else{
				$control_room_constt="";$control_room_door="";$control_room_equip="";$control_room_size="";
			}
			########## Part C ###############
			$name_contractor=$results["name_contractor"];
			$is_generator=$results["is_generator"];$is_generator_plan=$results["is_generator_plan"];$is_generator_plan1=$results["is_generator_plan1"];$is_generator_plan2=$results["is_generator_plan2"];
			if(!empty($results["contractor_address"]))
			{
				$contractor_address=json_decode($results["contractor_address"]);
				$contractor_address_sn1=$contractor_address->sn1;$contractor_address_sn2=$contractor_address->sn2;$contractor_address_vt=$contractor_address->vt;$contractor_address_d=$contractor_address->d;$contractor_address_p=$contractor_address->p;$contractor_address_mob=$contractor_address->mob;$contractor_address_cert_no=$contractor_address->cert_no;$contractor_address_compet=$contractor_address->compet;$contractor_address_super=$contractor_address->super;$contractor_address_lic_no=$contractor_address->lic_no;$contractor_address_valid=$contractor_address->valid;
			}else{
				$contractor_address_sn1="";$contractor_address_sn2="";$contractor_address_vt="";$contractor_address_d="";$contractor_address_p="";$contractor_address_mob="";$contractor_address_cert_no="";$contractor_address_compet="";$contractor_address_super="";$contractor_address_valid="";$contractor_address_lic_no="";
			}
		}else{
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];	
			########## Part A ###############
			$use_of_building=$results['use_of_building'];
			$builder_name=$results["builder_name"];
			$owner_name=$results["owner_name"];
			if(!empty($results["builder_address"])){
				$builder_address=json_decode($results["builder_address"]);
				$builder_address_sn1=$builder_address->sn1;$builder_address_sn2=$builder_address->sn2;$builder_address_vt=$builder_address->vt;$builder_address_d=$builder_address->d;$builder_address_p=$builder_address->p;$builder_address_m_no=$builder_address->m_no;$builder_address_p_no=$builder_address->p_no;
			}else{
				$builder_address_sn1="";$builder_address_sn2="";$builder_address_vt="";$builder_address_d="";$builder_address_p="";$builder_address_m_no="";$builder_address_p_no="";
			}	
			if(!empty($results["owner_address"])){
				$owner_address=json_decode($results["owner_address"]);
				$owner_address_sn1=$owner_address->sn1;$owner_address_sn2=$owner_address->sn2;$owner_address_vt=$owner_address->vt;$owner_address_d=$owner_address->d;$owner_address_p=$owner_address->p;$owner_address_m_no=$owner_address->m_no;$owner_address_p_no=$owner_address->p_no;
			}else{
				$owner_address_sn1="";$owner_address_sn2="";$owner_address_vt="";$owner_address_d="";$owner_address_p="";$owner_address_m_no="";$owner_address_p_no="";
			}	
			if(!empty($results["mb_address"]))
			{
				$mb_address=json_decode($results["mb_address"]);
				$mb_address_sn1=$mb_address->sn1;$mb_address_sn2=$mb_address->sn2;$mb_address_vt=$mb_address->vt;$mb_address_d=$mb_address->d;$mb_address_p=$mb_address->p;$mb_address_m_no=$mb_address->m_no;$mb_address_p_no=$mb_address->p_no;
			}else{
				$mb_address_sn1="";$mb_address_sn2="";$mb_address_vt="";$mb_address_d="";$mb_address_p="";$mb_address_m_no="";$mb_address_p_no="";
			}	
			if(!empty($results["particular"]))
			{
				$particular=json_decode($results["particular"]);
				$particular_area=$particular->area;;$particular_no=$particular->no;$particular_tot_floor=$particular->tot_floor;$particular_tot_height=$particular->tot_height;$particular_type=$particular->type;
			}else{
				$particular_area="";$particular_no="";$particular_tot_floor="";$particular_tot_height="";$particular_type="";
			}	
			########## Part B ###############
			$is_applied=$results["is_applied"];
			if(!empty($results["elect_inst"]))
			{
				$elect_inst=json_decode($results["elect_inst"]);
				$elect_inst_cables=$elect_inst->cables;	
				$elect_inst_cables_flr=$elect_inst_cables->flr;$elect_inst_cables_pipes=$elect_inst_cables->pipes;	$elect_inst_building=$elect_inst->building;$elect_inst_type=$elect_inst->type;$elect_inst_devices=$elect_inst->devices;$elect_inst_vol_sup=$elect_inst->vol_sup;
			}else{
				$elect_inst_cables_flr="";$elect_inst_cables_pipes=""; 
				$elect_inst_building="";$elect_inst_devices="";$elect_inst_type="";$elect_inst_vol_sup="";
			}
			if(!empty($results["control_room"]))
			{
				$control_room=json_decode($results["control_room"]);
				$control_room_constt=$control_room->constt;$control_room_door=$control_room->door;$control_room_equip=$control_room->equip;$control_room_size=$control_room->size;
			}else{
				$control_room_constt="";$control_room_door="";$control_room_equip="";$control_room_size="";
			}
			########## Part C ###############
			$name_contractor=$results["name_contractor"];
			$is_generator=$results["is_generator"];$is_generator_plan=$results["is_generator_plan"];$is_generator_plan1=$results["is_generator_plan1"];$is_generator_plan2=$results["is_generator_plan2"];
			if(!empty($results["contractor_address"]))
			{
				$contractor_address=json_decode($results["contractor_address"]);
				$contractor_address_sn1=$contractor_address->sn1;$contractor_address_sn2=$contractor_address->sn2;$contractor_address_vt=$contractor_address->vt;$contractor_address_d=$contractor_address->d;$contractor_address_p=$contractor_address->p;$contractor_address_mob=$contractor_address->mob;$contractor_address_cert_no=$contractor_address->cert_no;$contractor_address_compet=$contractor_address->compet;$contractor_address_super=$contractor_address->super;$contractor_address_lic_no=$contractor_address->lic_no;$contractor_address_valid=$contractor_address->valid;
			}else{
				$contractor_address_sn1="";$contractor_address_sn2="";$contractor_address_vt="";$contractor_address_d="";$contractor_address_p="";$contractor_address_mob="";$contractor_address_cert_no="";$contractor_address_compet="";$contractor_address_super="";$contractor_address_valid="";$contractor_address_lic_no="";
			}
		}
		
		
		
	}
	
    ##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							    <ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
										<td width="25%">1.(a) Name of applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $key_person; ?>" ></td>
										<td width="25%">(b) Occupation/designation/status:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $status_applicant; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">(c) Full Postal Address & Phone No.:</td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name1; ?>"></td>
										<td width="25%">Street Name2:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" validate="jsonObj"value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">2. Builder of the multistoried building with postal address and details of the owner(s).(Details to be furnished in a separate sheet):</td>
									</tr>
									<tr>
										<td>Builder's Name</td>
										<td><input type="text" class="form-control text-uppercase" name="builder_name" value="<?=$builder_name;?>"/></td>
										<td colspan="2"></td>
									</tr>
									<tr>
									    <td colspan="4"><b>Builder address:</b></td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="builder_address[sn1]"  value="<?php echo $builder_address_sn1;?>" ></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase"  name="builder_address[sn2]"  value="<?php echo $builder_address_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="builder_address[vt]"  value="<?php echo $builder_address_vt;?>"></td>
										<td>District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($builder_address_d);?>"   name="builder_address[d]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="builder_address[p]" maxlength="6" validate="pincode" value="<?php echo $builder_address_p;?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="builder_address[m_no]" value="<?php echo $builder_address_m_no;?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" name="builder_address[p_no]" validate="jsonObj" value="<?php echo $builder_address_p_no;?>" maxlength="13" validate="onlyNumbers"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>Owner's Name</td>
										<td><input type="text" class="form-control text-uppercase" name="owner_name" value="<?=$owner_name;?>"/></td>
										<td colspan="2"></td>
									</tr>
									<tr>
									    <td colspan="4"><b>Owner address:</b></td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="owner_address[sn1]"  value="<?php echo $owner_address_sn1;?>" ></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase"  name="owner_address[sn2]"  value="<?php echo $owner_address_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="owner_address[vt]"  value="<?php echo $owner_address_vt;?>"></td>
										<td>District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($owner_address_d);?>"   name="owner_address[d]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="owner_address[p]" maxlength="6" value="<?php echo $owner_address_p;?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" maxlength="10" class="form-control text-uppercase" validate="mobileNumber"  name="owner_address[m_no]" value="<?php echo $owner_address_m_no;?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" name="owner_address[p_no]" value="<?php echo $owner_address_p_no;?>" maxlength="13" validate="onlyNumbers"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">3. Location of the multistoried building with full postal address of the premise :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="mb_address[sn1]"   value="<?php echo $mb_address_sn1;?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase"  name="mb_address[sn2]"  value="<?php echo $mb_address_sn2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="mb_address[vt]"   value="<?php echo $mb_address_vt;?>"></td>
										<td>District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($mb_address_d);?>"   name="mb_address[d]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="mb_address[p]" maxlength="6" value="<?php echo $mb_address_p;?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" maxlength="10" class="form-control text-uppercase" validate="mobileNumber" name="mb_address[m_no]" value="<?php echo $mb_address_m_no;?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" name="mb_address[p_no]"  value="<?php echo $mb_address_p_no;?>" maxlength="10" validate="onlyNumbers"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">4. Particulars of the Building:</td>
									</tr>
									<tr>
										<td>4.1 Type</td>
										<td><input type="text" class="form-control text-uppercase" name="particular[type]"  value="<?php echo $particular_type;?>"></td>
										<td>4.2 Area per floor</td>
										<td><input type="text" class="form-control text-uppercase"  name="particular[area]"  value="<?php echo $particular_area;?>"></td>
									</tr>
									<tr>
										<td>4.3 Numbers of stories</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="particular[no]"value="<?php echo $particular_no;?>"></td>
										<td>4.4 Total floor area</td>
										<td><input type="text" class="form-control text-uppercase" name="particular[tot_floor]"  value="<?php echo $particular_tot_floor;?>"></td>
									</tr>
									<tr>
										<td>4.5 Total height of the Building from ground level</td>
										<td><input type="text" class="form-control text-uppercase" name="particular[tot_height]"  value="<?php echo $particular_tot_height;?>"></td>
										<td>4.6 Certified copy of approved drawing and NOC to construct the building and completion certificate to be enclosed.</td>
										<td>To be Uploaded in Upload Section</td>
									</tr>
									
									<tr>
										<td width="25%">5. Purpose of use of the building :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="use_of_building"  value="<?php echo $use_of_building;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
																								
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save3a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4">6. Particulars of Electrical Installation :</td>
									</tr>
									<tr>
										<td width="25%">6.1 Voltage of supply</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="elect_inst[vol_sup]"  value="<?php echo $elect_inst_vol_sup;?>" ></td>
										<td width="25%">6.2 Connected load with break up of lighting, powers and others type of load in annexed sheet.</td>	
										<td width="25%">To be Uploaded in Upload Section</td>
									</tr>
									
									<tr>
										<td colspan="3">6.3 Distribution System details:(A single line diagram clearly indicating all devices, controls, connection, with all ratings and specification to be furnished. Load in each sub-circuit to be shown. In case of individual flats/ units having similar connections and electrical loads, details of one unit of each type only need to be furnished).</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									
									<tr>
										<td>6.4 Type of wiring</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_inst[type]"  value="<?php echo $elect_inst_type;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">6.5 Method of drawing cables and type of ducts used for electrical cables.</td>
									</tr>
									<tr>
										<td>6.5.1 Whether any other pipes/cable laid in the same duct used for electrical cables?</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_inst[cables][pipes]"  value="<?php echo $elect_inst_cables_pipes;?>"></td>
										<td>6.5.2 Have adequate fire barriers provided which crossing the floors by cables? Give details</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_inst[cables][flr]"  value="<?php echo $elect_inst_cables_flr;?>"></td>
									</tr>
									<tr>
										<td>6.6 Type, size, make and specification of different wires/cables used in the building (details may be furnished as an Annexure)</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_inst[building]"  value="<?php echo $elect_inst_building;?>"></td>
										<td>6.7 Type, size, specification and make of major control devices used(details may be furnished as an Annexure)</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_inst[devices]"  value="<?php echo $elect_inst_devices;?>"></td>
									</tr>
								
									<tr>
										<td colspan="3">6.8 Connected/ sanctioned/applied Loads. Has the APDCL/DISCOM sanctioned electrical load for the building.  </td>
										<td colspan="1">
											<label class="radio-inline"><input type="radio" name="is_applied" validate="jsonObj" value="Y"  <?php if(isset($is_applied) && $is_applied=='Y') echo 'checked'; ?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" name="is_applied"  validate="jsonObj" value="N"  <?php if(isset($is_applied) && $is_applied=='N') echo 'checked'; ?>/> No</label>
										</td>											
									</tr>	
									
									<tr>
										<td colspan="4">7. Lay out Plan :</td>
									</tr>
									<tr>
										<td colspan="3">7.1 Physical layout plan indicating the position of the transformer, panels, generator, route of all OH line/cables with dimensions/clearances.</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</td>
									
									<tr>
										<td colspan="3">7.2 Position of Main Control Room/Breakers/MCCBs/MCB, DB & electrical cable ducts and layout of main cable(s)</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									<tr>
										<td colspan="4">8. Details of the main control room :</td>
									</tr>
									<tr>
										<td >8.1 Size</td>
										<td><input type="text" class="form-control text-uppercase" name="control_room[size]"  value="<?php echo $control_room_size;?>"></td>
										<td >8.2 Construction</td>
										<td><input type="text" class="form-control text-uppercase" name="control_room[constt]"  value="<?php echo $control_room_constt;?>"></td>
									</tr>
									<tr>
										<td >8.3 Construction of doors and windows</td>
										<td><input type="text" class="form-control text-uppercase" name="control_room[door]"  value="<?php echo $control_room_door;?>" ></td>
										<td >8.4 A layout of equipment and devices in the control room may be furnished with all distances and clearances.</td>
										<td><input type="text" class="form-control text-uppercase" name="control_room[equip]"  value="<?php echo $control_room_equip;?>"></td>
									</tr>
									<tr>
										<td colspan="4">9. Details of main panel(s) :</td>
									</tr>
									<tr>
										<td colspan="3">9.1 A single line diagram of the main panel(s) indicating all connections and control/protective and metering equipment/devices with ratings and specifications.</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									<tr>
										<td colspan="3">9.2 A front view of the panel(s) indicating all equipment/devices.</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									<tr>
										<td colspan="3">9.3 A Test Report of the panel duly signed by the Electrical Supervisor of the manufacturer who has manufactured the electrical panel(s).</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form3.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save3b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>					
									</tr>				
							</table>
							</form>
							</div>
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive ">	
									<tr>
										<td colspan="3">10. Details of earthing (A layout of earthing of the main panel and other equipment to be furnished in the diagram required under 7.4 above.)</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
								
									<tr>
										<td >11.(a) Has any generator been installed?<span class="mandatory_field">*</span></td> </td>
										<td >
											<label class="radio-inline"><input type="radio" name="is_generator" class="is_generator" value="Y"  <?php if(isset($is_generator) && $is_generator=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="is_generator" name="is_generator"  value="N"  <?php if(isset($is_generator) && ($is_generator=='N' || $is_generator=='')) echo 'checked'; ?>/> No</label></td>
										<td>(b) If no, any plan to install a generator? <span class="mandatory_field">*</span></td> </td>
										<td >
											<label class="radio-inline"><input type="radio" id="is_generator_plan" name="is_generator_plan" value="Y"  <?php if(isset($is_generator_plan) && $is_generator_plan=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" id="is_generator_plan" name="is_generator_plan"  value="N"  <?php if(isset($is_generator_plan) && ($is_generator_plan=='N' || $is_generator_plan=='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td >12.(a) Has any lift been installed?<span class="mandatory_field">*</span></td></td>
										<td><label class="radio-inline"><input type="radio" name="is_generator_plan1" value="Y"  <?php if(isset($is_generator_plan1) && $is_generator_plan1=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_generator_plan1"  value="N"  <?php if(isset($is_generator_plan1) && ($is_generator_plan1=='N' || $is_generator_plan1=='')) echo 'checked'; ?>/> No</label></td>
										<td>(b) If no, any plan to install a lift?In case a lift is installed or being installed, separate application to be submitted as per lift Acts & rules of Assam.<span class="mandatory_field">*</span></td></td>
										<td><label class="radio-inline"><input type="radio" name="is_generator_plan2" value="Y"  <?php if(isset($is_generator_plan2) && $is_generator_plan2=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
										<label class="radio-inline"><input type="radio" name="is_generator_plan2"  value="N"  <?php if(isset($is_generator_plan2) && ($is_generator_plan2=='N' || $is_generator_plan2=='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									
									<tr>
										<td colspan="3">13. Has lightning protection been provided:?Detailed diagram of lightening protection to be provided separately.</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									
									<tr>
										<td colspan="3">14. Furnish details of fire protection/fire alarm system provided. NOC of state fire department to be furnished.</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
									</tr>
									
								<tr>
										<td colspan="3">15. Testing <br/>A detailed test report with circuit wise insulation resistance and details of earth resistance test to be furnished. (Separately for each section, each panel and each unit/conductor).</td>
										<td colspan="1">To be Uploaded in Upload Section</td>
								</tr>
									
									<tr>
										<td colspan="4">16. The Electrical wiring and installation works carried out by</td>
									</tr>
									<tr>
										<td width="25%">Name of Electrical Contractor</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name_contractor" validate="letters" value="<?php echo $name_contractor;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">Address</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[sn1]"  value="<?php echo $contractor_address_sn1;?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[sn2]"   value="<?php echo $contractor_address_sn2;?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[vt]"  value="<?php echo $contractor_address_vt;?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($contractor_address_d);?>"   name="contractor_address[d]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="contractor_address[p]"  value="<?php echo $contractor_address_p;?>" maxlength="6"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[mob]" validate="mobileNumber" value="<?php echo $contractor_address_mob;?>" maxlength="10"></td>
									</tr>
									<tr>
										<td>License No. and Class :</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[lic_no]"  value="<?php echo $contractor_address_lic_no;?>"></td>
										<td>Valid upto :</td>
										<td><input type="text" class="dob2 form-control text-uppercase" name="contractor_address[valid]" readonly="readonly" value="<?php echo $contractor_address_valid;?>"></td>
									</tr>
									<tr>
										<td>Name of Electrical Supervisor:</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[super]"  validate="letters" value="<?php echo $contractor_address_super;?>"></td>
										<td>Certificate No. :</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[cert_no]"  value="<?php echo $contractor_address_cert_no;?>" ></td>
									</tr>
									<tr>
										<td>Details of competency (Parts qualified):</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_address[compet]"   value="<?php echo $contractor_address_compet;?>"></td>
										<td></td>
										<td></td>
									</tr>									
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label></td>										
										<td colspan="2" align="right">Signature: <strong><?php echo strtoupper($key_person)?></strong><br/>
										Name: <label><?php echo strtoupper($key_person)?></strong>
										</td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											<a href="cei_form3.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save3c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	
	<?php if($is_applied == 'N' || $is_applied == '') echo "$('#is_applied_id').hide();"; ?>
	$('input[name="is_applied"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_applied_id').hide();
		else
			$('#is_applied_id').show();
	});
	
	$('#is_generator_plan').attr('readonly','readonly');
	<?php if($is_generator== 'Y') echo "$('#is_generator_plan').removeAttr('readonly','readonly');"; ?>
	$('.is_generator').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_generator_plan').attr('readonly','readonly');
		}else{
			$('#is_generator_plan').removeAttr('readonly','readonly');
		}			
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>