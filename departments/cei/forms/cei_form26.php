<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="26";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;// For reccuring form fill ups
	
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			########## Part A ###############
			$supplier_name=$results["supplier_name"];	
			$name_trans_line=$results["name_trans_line"];$primary_sub_stn=$results["primary_sub_stn"];$secondary_sub_stn=$results["secondary_sub_stn"];$capacity=$results["capacity"];$sub_stn_type=$results["sub_stn_type"];
			if(!empty($results["supplier_address"])){
				$supplier_address=json_decode($results["supplier_address"]);
				$supplier_address_sn1=$supplier_address->sn1;$supplier_address_sn2=$supplier_address->sn2;$supplier_address_vt=$supplier_address->vt;$supplier_address_d=$supplier_address->d;$supplier_address_p=$supplier_address->p;$supplier_address_m_no=$supplier_address->m_no;
			}else{
				$supplier_address_sn1="";$supplier_address_sn2="";$supplier_address_vt="";$supplier_address_d="";$supplier_address_p="";$supplier_address_m_no="";
			}
			if(!empty($results["sub_stn"]))
			{
				$sub_stn=json_decode($results["sub_stn"]);
				$sub_stn_identification=$sub_stn->identification;$sub_stn_name=$sub_stn->name;$sub_stn_purpose=$sub_stn->purpose;$sub_stn_renovat=$sub_stn->renovat;$sub_stn_loc=$sub_stn->loc;$sub_stn_dist=$sub_stn->dist;	$sub_stn_sn1=$sub_stn->sn1;	$sub_stn_sn2=$sub_stn->sn2;$sub_stn_vt=$sub_stn->vt;$sub_stn_p=$sub_stn->p;	$sub_stn_m_no=$sub_stn->m_no;	$sub_stn_p_no=$sub_stn->p_no;			
			}else{			
				$sub_stn_identification="";$sub_stn_name="";$sub_stn_purpose="";$sub_stn_renovat="";
				$sub_stn_loc="";$sub_stn_dist="";$sub_stn_sn1="";$sub_stn_sn2="";$sub_stn_vt="";$sub_stn_p="";
				$sub_stn_m_no="";$sub_stn_p_no="";
				
			}
			########## Part B ###############
			if(!empty($results["specification"]))
			{
				$specification=json_decode($results["specification"]);
                if(isset($specification->type))  $specification_type=$specification->type; else $specification_type=""; 
                if(isset($specification->make))  $specification_make=$specification->make; else $specification_make=""; 
                if(isset($specification->conf))  $specification_conf=$specification->conf; else $specification_conf=""; 
                if(isset($specification->slno))  $specification_slno=$specification->slno; else $specification_slno=""; 
                if(isset($specification->rating))  $specification_rating=$specification->rating; else $specification_rating=""; 
                if(isset($specification->volt_hv))  $specification_volt_hv=$specification->volt_hv; else $specification_volt_hv=""; 
                if(isset($specification->volt_lv))  $specification_volt_lv=$specification->volt_lv; else $specification_volt_lv=""; 
                if(isset($specification->cur_rating_hv))  $specification_cur_rating_hv=$specification->cur_rating_hv; else $specification_cur_rating_hv=""; 
                if(isset($specification->cur_rating_lv))  $specification_cur_rating_lv=$specification->cur_rating_lv; else $specification_cur_rating_lv=""; 
                if(isset($specification->per))  $specification_per=$specification->per; else $specification_per=""; 
                if(isset($specification->tot_cap))  $specification_tot_cap=$specification->tot_cap; else $specification_tot_cap=""; 
                if(isset($specification->strength))  $specification_strength=$specification->strength; else $specification_strength=""; 
                if(isset($specification->strength_at))  $specification_strength_at=$specification->strength_at; else $specification_strength_at=""; 
            
				
			}else{
				$specification_type="";$specification_make="";$specification_conf="";$specification_slno="";
				$specification_rating="";$specification_volt_hv="";$specification_volt_lv="";$specification_cur_rating_hv="";$specification_cur_rating_lv="";$specification_per="";
				$specification_tot_cap="";$specification_strength="";$specification_strength_at="";
			}
			if(!empty($results["in_test_res"]))
			{
				$in_test_res=json_decode($results["in_test_res"]);
				$in_test_res_a=$in_test_res->a;
				$in_test_res_b=$in_test_res->b;	
				$in_test_res_c=$in_test_res->c;
			}else{
				$in_test_res_a="";$in_test_res_b="";$in_test_res_c="";
			}
			if(!empty($results["cont_test_res"]))
			{
				$cont_test_res=json_decode($results["cont_test_res"]);
				$cont_test_res_b=$cont_test_res->b;	
				$cont_test_res_c=$cont_test_res->c;
				$cont_test_res_d=$cont_test_res->d;	
				$cont_test_res_e=$cont_test_res->e;
			}else{
				$cont_test_res_b="";$cont_test_res_c="";$cont_test_res_d="";$cont_test_res_e="";
			}
			if(!empty($results["insulation"]))
			{
				$insulation=json_decode($results["insulation"]);
				$insulation_volt_rat_high=$insulation->volt_rat_high;$insulation_volt_rat_low=$insulation->volt_rat_low;$insulation_make_high=$insulation->make_high;$insulation_make_low=$insulation->make_low;$insulation_slno_high=$insulation->slno_high;$insulation_slno_low=$insulation->slno_low;
			}else{
				$insulation_volt_rat_high="";$insulation_volt_rat_low="";$insulation_make_high="";		$insulation_make_low="";$insulation_slno_high="";$insulation_slno_low="";		
			}
			########## Part C ###############
			$pad_mounted=$results["pad_mounted"];$fencing_height=$results["fencing_height"];$indoor_sub_stn=$results["indoor_sub_stn"];$sub_stn_filled=$results["sub_stn_filled"];
			$cond_arr=$results["cond_arr"];$l_arrestors=$results["l_arrestors"];
			if(!empty($results["protection"]))
			{
				$protection=json_decode($results["protection"]);
				$protection_HV=$protection->HV;$protection_LV=$protection->LV;
				
			}else{
				$protection_HV="";$protection_LV="";	
			}		
			if(!empty($results["spec"]))
			{
				$spec=json_decode($results["spec"]);
				$spec_HV=$spec->HV;$spec_LV=$spec->LV;
				
			}else{
				$spec_HV="";$spec_LV="";
			}
			
			#### Part D #####
			$type_LA=$results["type_LA"];$pro_earthed=$results["pro_earthed"];									
			$sub_stn_provision=$results["sub_stn_provision"];$sub_stn_equip=$results["sub_stn_equip"];									
			$furnish_det=$results["furnish_det"];									
			$s_provision=$results["s_provision"];									
			$name_person=$results["name_person"];									
			
			
			if(!empty($results["testing"]))
			{
				$testing=json_decode($results["testing"]);
				$testing_a=$testing->a;$testing_b=$testing->b;$testing_c=$testing->c;
				
			}else{
				$testing_a="";$testing_b="";$testing_c="";
			}
			
		}else{
			$form_id="";
			########## Part A ###############
			$supplier_name="";	
			$supplier_address_sn1="";$supplier_address_sn2="";$supplier_address_vt="";$supplier_address_d="";$supplier_address_p="";$supplier_address_m_no="";$name_trans_line="";$primary_sub_stn="";$secondary_sub_stn="";$capacity="";$sub_stn_type="";
			$sub_stn_identification="";$sub_stn_name="";$sub_stn_purpose="";$sub_stn_renovat="";
			$sub_stn_loc="";$sub_stn_dist="";$sub_stn_sn1="";$sub_stn_sn2="";$sub_stn_vt="";$sub_stn_p="";
			$sub_stn_m_no="";$sub_stn_p_no="";
			
			########## Part B ###############
			$specification_type="";$specification_make="";$specification_conf="";$specification_slno="";
			$specification_rating="";$specification_volt_hv="";$specification_volt_lv="";$specification_cur_rating_hv="";$specification_cur_rating_lv="";$specification_per="";
			$specification_tot_cap="";$specification_strength="";$specification_strength_at="";       
			$in_test_res_a="";$in_test_res_b="";$in_test_res_c="";$cont_test_res_b="";$cont_test_res_c="";
			$cont_test_res_d="";$cont_test_res_e="";
			$insulation_volt_rat_high="";$insulation_volt_rat_low="";$insulation_make_high="";$insulation_make_low="";$insulation_slno_high="";$insulation_slno_low="";
			########## Part C ###############	
			$protection_HV="";$protection_LV="";
			$spec_HV="";$spec_LV="";
			$pad_mounted="";$fencing_height="";$indoor_sub_stn="";$sub_stn_filled="";
			$cond_arr="";$l_arrestors="";
			####### Part D ##########
			$type_LA="";$pro_earthed="";									
			$sub_stn_provision="";$sub_stn_equip="";									
			$furnish_det="";									
			$s_provision="";									
			$name_person="";									
			$testing_a="";$testing_b="";$testing_c="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		########## Part A ###############
		$supplier_name=$results["supplier_name"];	
		$name_trans_line=$results["name_trans_line"];$primary_sub_stn=$results["primary_sub_stn"];$secondary_sub_stn=$results["secondary_sub_stn"];$capacity=$results["capacity"];$sub_stn_type=$results["sub_stn_type"];
		if(!empty($results["supplier_address"])){
			$supplier_address=json_decode($results["supplier_address"]);
			$supplier_address_sn1=$supplier_address->sn1;$supplier_address_sn2=$supplier_address->sn2;$supplier_address_vt=$supplier_address->vt;$supplier_address_d=$supplier_address->d;$supplier_address_p=$supplier_address->p;$supplier_address_m_no=$supplier_address->m_no;
		}else{
			$supplier_address_sn1="";$supplier_address_sn2="";$supplier_address_vt="";$supplier_address_d="";$supplier_address_p="";$supplier_address_m_no="";
		}
		if(!empty($results["sub_stn"]))
		{
			$sub_stn=json_decode($results["sub_stn"]);
			$sub_stn_identification=$sub_stn->identification;$sub_stn_name=$sub_stn->name;$sub_stn_purpose=$sub_stn->purpose;$sub_stn_renovat=$sub_stn->renovat;$sub_stn_loc=$sub_stn->loc;$sub_stn_dist=$sub_stn->dist;	$sub_stn_sn1=$sub_stn->sn1;	$sub_stn_sn2=$sub_stn->sn2;$sub_stn_vt=$sub_stn->vt;$sub_stn_p=$sub_stn->p;	$sub_stn_m_no=$sub_stn->m_no;	$sub_stn_p_no=$sub_stn->p_no;			
		}else{			
			$sub_stn_identification="";$sub_stn_name="";$sub_stn_purpose="";$sub_stn_renovat="";
			$sub_stn_loc="";$sub_stn_dist="";$sub_stn_sn1="";$sub_stn_sn2="";$sub_stn_vt="";$sub_stn_p="";
			$sub_stn_m_no="";$sub_stn_p_no="";
			
		}
		########## Part B ###############
		if(!empty($results["specification"]))
		{
			$specification=json_decode($results["specification"]);
            if(isset($specification->type))  $specification_type=$specification->type; else $specification_type=""; 
            if(isset($specification->make))  $specification_make=$specification->make; else $specification_make=""; 
            if(isset($specification->conf))  $specification_conf=$specification->conf; else $specification_conf=""; 
            if(isset($specification->slno))  $specification_slno=$specification->slno; else $specification_slno=""; 
            if(isset($specification->rating))  $specification_rating=$specification->rating; else $specification_rating=""; 
            if(isset($specification->volt_hv))  $specification_volt_hv=$specification->volt_hv; else $specification_volt_hv=""; 
            if(isset($specification->volt_lv))  $specification_volt_lv=$specification->volt_lv; else $specification_volt_lv=""; 
            if(isset($specification->cur_rating_hv))  $specification_cur_rating_hv=$specification->cur_rating_hv; else $specification_cur_rating_hv=""; 
            if(isset($specification->cur_rating_lv))  $specification_cur_rating_lv=$specification->cur_rating_lv; else $specification_cur_rating_lv=""; 
            if(isset($specification->per))  $specification_per=$specification->per; else $specification_per=""; 
            if(isset($specification->tot_cap))  $specification_tot_cap=$specification->tot_cap; else $specification_tot_cap=""; 
            if(isset($specification->strength))  $specification_strength=$specification->strength; else $specification_strength=""; 
            if(isset($specification->strength_at))  $specification_strength_at=$specification->strength_at; else $specification_strength_at=""; 
            
			
		}else{
			$specification_type="";$specification_make="";$specification_conf="";$specification_slno="";
			$specification_rating="";$specification_volt_hv="";$specification_volt_lv="";$specification_cur_rating_hv="";$specification_cur_rating_lv="";$specification_per="";
			$specification_tot_cap="";$specification_strength="";$specification_strength_at="";
		}
		if(!empty($results["in_test_res"]))
		{
			$in_test_res=json_decode($results["in_test_res"]);
			$in_test_res_a=$in_test_res->a;
			$in_test_res_b=$in_test_res->b;	
			$in_test_res_c=$in_test_res->c;
		}else{
			$in_test_res_a="";$in_test_res_b="";$in_test_res_c="";
		}
		if(!empty($results["cont_test_res"]))
		{
			$cont_test_res=json_decode($results["cont_test_res"]);
			$cont_test_res_b=$cont_test_res->b;	
			$cont_test_res_c=$cont_test_res->c;
			$cont_test_res_d=$cont_test_res->d;	
			$cont_test_res_e=$cont_test_res->e;
		}else{
			$cont_test_res_b="";$cont_test_res_c="";$cont_test_res_d="";$cont_test_res_e="";
		}
		if(!empty($results["insulation"]))
		{
			$insulation=json_decode($results["insulation"]);
			$insulation_volt_rat_high=$insulation->volt_rat_high;$insulation_volt_rat_low=$insulation->volt_rat_low;$insulation_make_high=$insulation->make_high;$insulation_make_low=$insulation->make_low;$insulation_slno_high=$insulation->slno_high;$insulation_slno_low=$insulation->slno_low;
		}else{
			$insulation_volt_rat_high="";$insulation_volt_rat_low="";$insulation_make_high="";		$insulation_make_low="";$insulation_slno_high="";$insulation_slno_low="";		
		}
		########## Part C ###############
		$pad_mounted=$results["pad_mounted"];$fencing_height=$results["fencing_height"];$indoor_sub_stn=$results["indoor_sub_stn"];$sub_stn_filled=$results["sub_stn_filled"];
		$cond_arr=$results["cond_arr"];$l_arrestors=$results["l_arrestors"];
		if(!empty($results["protection"]))
		{
			$protection=json_decode($results["protection"]);
			$protection_HV=$protection->HV;$protection_LV=$protection->LV;
			
		}else{
			$protection_HV="";$protection_LV="";	
		}		
		if(!empty($results["spec"]))
		{
			$spec=json_decode($results["spec"]);
			$spec_HV=$spec->HV;$spec_LV=$spec->LV;
			
		}else{
			$spec_HV="";$spec_LV="";
		}
		
		#### Part D #####
		$type_LA=$results["type_LA"];$pro_earthed=$results["pro_earthed"];									
		$sub_stn_provision=$results["sub_stn_provision"];$sub_stn_equip=$results["sub_stn_equip"];									
		$furnish_det=$results["furnish_det"];									
		$s_provision=$results["s_provision"];									
		$name_person=$results["name_person"];									
		
		
		if(!empty($results["testing"]))
		{
			$testing=json_decode($results["testing"]);
			$testing_a=$testing->a;$testing_b=$testing->b;$testing_c=$testing->c;
			
		}else{
			$testing_a="";$testing_b="";$testing_c="";
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
								  <li class="<?php echo $tabbtn4; ?>"><a href="#table4">PART IV</a></li>
							
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">

									<tr>
										<td colspan="4">1. Name and address of owner of the installation/sub-station :</td></tr>
										
									<tr>
										<td width="25%">(a) Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $key_person; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Full Postal Address & Phone No. :</td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name1; ?>"></td>
										<td width="25%">Street Name2 :</td>
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
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id :</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" validate="jsonObj"value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
									    <td>2. Name and address of supplier :</td>
									</tr>
									<tr>
									    <td width="25%">Supplier name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="supplier_name" validate="letters" value="<?php echo $supplier_name; ?>" required="required"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									
									</tr>
									<tr>
									    <td colspan="4">Supplier address :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="supplier_address[sn1]"  value="<?php echo $supplier_address_sn1;?>"  required="required"></td>
										<td>Street Name2 :</td>
										<td><input type="text" class="form-control text-uppercase"  name="supplier_address[sn2]"  value="<?php echo $supplier_address_sn2;?>" required="required"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="supplier_address[vt]"  value="<?php echo $supplier_address_vt;?>" required="required"></td>
										<td>District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($supplier_address_d);?>"   name="supplier_address[d]">    
                                        </td>
										
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" name="supplier_address[p]" maxlength="6" validate="pincode" value="<?php echo $supplier_address_p;?>" required="required"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="supplier_address[m_no]" value="<?php echo $supplier_address_m_no;?>" required="required"></td>
									</tr>
									
									
									<tr>
										<td colspan="3">3. Name / identification of the transmission line / feeder supplying power to the sub-station / installation :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name_trans_line"  value="<?php echo $name_trans_line;?>" required="required"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
										<td colspan="4">4.1 Voltage of the sub-station :</td>
									</tr>
									<tr>
										<td>Primary(in <b> KV</b>) :</td>
										<td><input type="text" class="form-control text-uppercase" name="primary_sub_stn"   value="<?php echo $primary_sub_stn;?>" required="required"></td>
										<td>Secondary(in <b> KV</b>) :</td>
										<td><input type="text" class="form-control text-uppercase"  name="secondary_sub_stn"  value="<?php echo $secondary_sub_stn;?>" required="required"></td>
									</tr>
									<tr>
										<td>4.2 Capacity of Transformer(in <b> KVA/MVA</b>) :</br>(In case more than one transformer and/or equipment are installed a detailed list is required to be submitted in Annexure II B)</td>
										<td><input type="text" class="form-control text-uppercase" name="capacity"  value="<?php echo $capacity;?>" required="required"></td>
										<td >5. Type of sub-station, Indoor/Outdoor Platform mounted /Pole mounted etc.(To specify) :</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_stn_type"  value="<?php echo $sub_stn_type;?>" required="required"></td>
									</tr>
									<tr>
										<td >6. Identification of the sub-station :</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_stn[identification]"  value="<?php echo $sub_stn_identification;?>" required="required"></td>
									</tr>

									<tr>
										<td width="25%">6.1 Name of the Sub-station :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="sub_stn[name]"  value="<?php echo $sub_stn_name;?>" required="required"></td>
										<td width="25%">6.2 Purpose & type of load to be supplied. :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="sub_stn[purpose]"  value="<?php echo $sub_stn_purpose;?>" required="required"></td>
									</tr>
									<tr>
										<td >6.3 New/ renovation/ augmentation work :</td>
										<td ><input type="text" class="form-control text-uppercase" name="sub_stn[renovat]"  value="<?php echo $sub_stn_renovat;?>" required="required"></td>
										<td >6.4 Location of the Sub-station :</td>
										<td ><input type="text" class="form-control text-uppercase" name="sub_stn[loc]"  value="<?php echo $sub_stn_loc;?>" required="required"></td>
									</tr>
									<tr>
										<td>6.4.1 District :</td>
                                        <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($sub_stn_dist);?>"   name="sub_stn[dist]">    
                                        </td>
										
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr><td colspan="4">6.4.2 Full address of the Sub-station :</td></tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_stn[sn1]"  value="<?php echo $sub_stn_sn1;?>" required="required"></td>
										<td>Street Name2 :</td>
										<td><input type="text" class="form-control text-uppercase"  name="sub_stn[sn2]"  value="<?php echo $sub_stn_sn2;?>" required="required"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_stn[vt]"  value="<?php echo $sub_stn_vt;?>" required="required"></td>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="sub_stn[p]" maxlength="6" value="<?php echo $sub_stn_p;?>" required="required"></td>
									</tr>
									<tr>
										<td>Mobile No :</td>
										<td><input type="text" maxlength="10" class="form-control text-uppercase" validate="mobileNumber"  name="sub_stn[m_no]" value="<?php echo $sub_stn_m_no;?>" required="required"></td>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" name="sub_stn[p_no]" value="<?php echo $sub_stn_p_no;?>" maxlength="10" validate="onlyNumbers" required="required"></td>
									</tr>							
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									
									<tr>
										<td width="25%">7. Specification of the transformer :</td>
										<td width="25%"></td>
										<td width="25%">&nbsp;</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td >7.1 Type :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[type]"  value="<?php echo $specification_type;?>"  required="required"></td>
										<td >7.2 Make :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[make]"  value="<?php echo $specification_make;?>"  required="required"></td>
									</tr>
									<tr>
										<td >7.3 Winding configuration :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[conf]"  value="<?php echo $specification_conf;?>"  required="required"></td>
										<td >7.4 Serial number :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[slno]"  value="<?php echo $specification_slno;?>"  required="required"></td>
									</tr>
									<tr>
										<td >7.5 Rating/ Capacity :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[rating]"  value="<?php echo $specification_rating;?>"  required="required"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">7.6 Voltage at no load :</td>
									</tr>
									<tr>
										<td>HV :</td>
										<td><input type="text" class="form-control text-uppercase" name="specification[volt_hv]"  value="<?php echo $specification_volt_hv;?>"  required="required"></td>
										<td>LV :</td>
										<td><input type="text" class="form-control text-uppercase" name="specification[volt_lv]"  value="<?php echo $specification_volt_lv;?>"  required="required"></td>
									</tr>
									<tr>
										<td colspan="4">7.7 Current rating :</td>
									</tr>
									<tr>
										<td>HV :</td>
										<td><input type="text" class="form-control text-uppercase" name="specification[cur_rating_hv]"  value="<?php echo $specification_cur_rating_hv;?>" required="required" ></td>
										<td>LV :</td>
										<td><input type="text" class="form-control text-uppercase" name="specification[cur_rating_lv]"  value="<?php echo $specification_cur_rating_lv;?>"  required="required"></td>
									</tr>
										<td >7.8 Percentage impedance :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[per]"  value="<?php echo $specification_per;?>"  required="required" required="required"></td>
									</tr>
									<tr>
										<td >7.9 Total Oil Capacity :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[tot_cap]"  value="<?php echo $specification_tot_cap;?>"  required="required"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td >7.10. Di-electric strength of oil used(in KV) :</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[strength]"  value="<?php echo $specification_strength;?>"  required="required"></td>
										<td >at(mm gap)</td>
										<td ><input type="text" class="form-control text-uppercase" name="specification[strength_at]"  value="<?php echo $specification_strength_at;?>"  required="required"></td>
									</tr>
									<tr><td colspan="2">(A copy of Manufacturer's test report is required to be enclosed)</td>
									<td colspan="2">To be Uploaded in Upload Section</td>
									</tr>
									
									<tr>
										<td>7.11 Insulation test results</td>	
									</tr>
									<tr>
										<td >7.11.1 Between HV&LV :</td>
										<td><input type="text" class="form-control text-uppercase" name="in_test_res[a]"  value="<?php echo $in_test_res_a;?>"  required="required"></td>
										<td >7.11.2 Between HV& Earth :</td>
										<td ><input type="text" class="form-control text-uppercase" name="in_test_res[b]"  value="<?php echo $in_test_res_b;?>"  required="required"></td>
									</tr>
									<tr>
										<td >7.11.3 Between LV& Earth :</td>
										<td ><input type="text" class="form-control text-uppercase" name="in_test_res[c]"  value="<?php echo $in_test_res_c;?>"  required="required"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td colspan="4">7.12 Continuity Test Results (L.V. Side with neutral earth connected) :</td>
									</tr>
									<tr>
										<td >7.12.1 Between Neutral & Earth :</td>
										<td ><input type="text" class="form-control text-uppercase" name="cont_test_res[b]"  value="<?php echo $cont_test_res_b;?>"  required="required"></td>
										<td >7.12.2 Phase 1 and Earth :</td>
										<td><input type="text" class="form-control text-uppercase" name="cont_test_res[c]"  value="<?php echo $cont_test_res_c;?>"  required="required"></td>
									</tr>
									<tr>
										<td >7.12.3 Phase 2 and Earth :</td>
										<td ><input type="text" class="form-control text-uppercase" name="cont_test_res[d]"  value="<?php echo $cont_test_res_d;?>"  required="required"></td>
										<td >7.12.4 Phase 3 and Earth :</td>
										<td ><input type="text" class="form-control text-uppercase" name="cont_test_res[e]"  value="<?php echo $cont_test_res_e;?>"  required="required"></td>
									</tr>
									<tr>
										<td  colspan="4">7.13. Details of insulation tester used :</td>
									</tr>
									<tr>
										<td colspan="2">High Voltage Test (7.11.1 to 7.11.3) :</td>
										<td colspan="2"> Low Voltage Test (7.12) :</td>
									</tr>
									<tr>
										<td>a) Voltage rating :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[volt_rat_high]"  value="<?php echo $insulation_volt_rat_high;?>" required="required"></td>
										<td>a) Voltage rating :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[volt_rat_low]"  value="<?php echo $insulation_volt_rat_low;?>" required="required"></td>
									</tr>
									<tr>
										<td >b) Make :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[make_high]"  value="<?php echo $insulation_make_high;?>" required="required"></td>
										<td >b) Make :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[make_low]"  value="<?php echo $insulation_make_low;?>" required="required"></td>
									</tr>
									<tr>
										<td >c) Serial No :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[slno_high]"  value="<?php echo $insulation_slno_high;?>" required="required"></td>
										<td >c) Serial No :</td>
										<td><input type="text" class="form-control text-uppercase" name="insulation[slno_low]"  value="<?php echo $insulation_slno_low;?>" required="required"></td>
									</tr>
									<tr>
										<td colspan="4">(Details about each equipment is to be furnished in Annexure II B in case more than one transformer or other equipment are installed)</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>					
									</tr>				
							</table>
							</form>
							</div>
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive ">	
									<tr>
										<td colspan="4">8. Type of protections used :</td>
									</tr>
									<tr>
										<td width="25%">a) HV side :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="protection[HV]"  value="<?php echo $protection_HV;?>" required="required"></td>
										<td width="25%">b) LV side :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="protection[LV]"  value="<?php echo $protection_LV;?>" required="required"></td>
									</tr>
									<tr><td colspan="4">(In case circuit breakers are used, details should be submitted in Annexure-II A & II B)</td></tr>
									
									<tr>
										<td colspan="4">9. Size and specification of conductors / cables :</td>
									</tr>
									<tr>
										<td>a) HV side :</td>
										<td><input type="text" class="form-control text-uppercase" name="spec[HV]"  value="<?php echo $spec_HV;?>" required="required"></td>
										<td>b) LV side :</td>
										<td><input type="text" class="form-control text-uppercase" name="spec[LV]"  value="<?php echo $spec_LV;?>" required="required"></td>
									</tr>
									
									<tr>
										<td>10. Indicate type of platform constructed for pad mounted sub-station :</td>
										<td><input type="text" class="form-control text-uppercase" name="pad_mounted"  value="<?php echo $pad_mounted;?>" required="required"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td>11. Incase of out door Sub-station :</br>(Except pole mounted Sub-station)<br/>Indicate if efficiently protected fencing is used as per Regulation 33 with type and mention the height of the fencing :</td>
										<td><input type="text" class="form-control text-uppercase" name="fencing_height"  value="<?php echo $fencing_height;?>" required="required"></td>
										<td colspan="2"></td>
									</tr>
									
									<tr>
										<td >12. In case of indoor Sub-station; if proper soak pits are provided for drainage of oil which may leak, to prevent spreading of accidental fire as per provision of Regulation 44.Details of such arrangements, if any :</td>
										
										<td><textarea class="form-control text-uppercase" name="indoor_sub_stn"> <?php echo  $indoor_sub_stn; ?></textarea></td>
										<td >13. Mention if cable trench inside the Sub-stations are filled with sand or similar non-inflammable materials or covered with non-flammable slabs. :</td>
										<td><textarea class="form-control text-uppercase" name="sub_stn_filled"> <?php echo  $sub_stn_filled; ?></textarea></td>
									</tr>
									
									
									<tr>
										<td>14. Are the conductors and apparatus are so arranged that they may be made dead in section and work carried out in each section by authorized person without any danger ?</td>
										<td>
											<label class="radio-inline"><input type="radio" name="cond_arr" class="cond_arr" value="Y"  <?php if(isset($cond_arr) && $cond_arr=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="cond_arr" name="cond_arr"  value="N"  <?php if(isset($cond_arr) && ($cond_arr=='N' || $cond_arr=='')) echo 'checked'; ?>/> No</label></td>
										<td>15. Have lightning arrestors been provided ?</td>
										<td>
											<label class="radio-inline"><input type="radio" name="l_arrestors" class="l_arrestors" value="Y"  <?php if(isset($l_arrestors) && $l_arrestors=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="l_arrestors" name="l_arrestors"  value="N"  <?php if(isset($l_arrestors) && ($l_arrestors=='N' || $l_arrestors=='')) echo 'checked'; ?>/> No</label></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>					
									</tr>				
							
							</table>
							</form>
							</div>
							
							
							<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive ">	
									
									
									<tr>
										<td width="25%">15(a). Type of LA used & K.A.rating :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_LA"  value="<?php echo $type_LA;?>" required="required"></td>
										<td width="25%">15(b). Have these been properly earthed? </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="pro_earthed"  value="<?php echo $pro_earthed;?>" required="required"></td>
									</tr>
									
									<tr><td >16. Whether any provision is made to protect the sub-station from direct lightning stroke. If so, furnish details of such protection. :</td>
									<td ><textarea class="form-control text-uppercase" name="sub_stn_provision"> <?php echo  $sub_stn_provision; ?></textarea></td>
									<td >17. Have all the equipments in the sub-station been earthed as per provision of Regulation 41, 42 & 48 of the CEA Regulations, 2010? Furnish details of earthing in Annexure-I along with drawing showing details of earth electrodes and manner. :</td>
									<td ><textarea class="form-control text-uppercase" name="sub_stn_equip"> <?php echo  $sub_stn_equip; ?></textarea></td>
									</tr>
									
									<tr>
										<td >18. Furnish details about arrangements made/ equipment provided to control fire in the electrical equipments. :</td>
										<td ><textarea class="form-control text-uppercase" name="furnish_det"> <?php echo  $furnish_det; ?></textarea></td>
										<td >19. Has suitable provisions been made for immediate and automatic discharge of every static condensers on disconnection as required vide Regulation 51 of the CEA Regulations, 2010. :</td>
										<td ><textarea class="form-control text-uppercase" name="s_provision"> <?php echo  $s_provision; ?></textarea></td>
									</tr>
									
									<tr>
										<td>20. Name of person/ agency that will be responsible for operation and maintenance of the sub-station with authority/competency. :</td>
										<td><textarea class="form-control text-uppercase" name="name_person"> <?php echo  $name_person; ?></textarea></td>
										
										<td></td>
										<td></td>
									</tr>
									
									<tr><td>21. Installation and testing done :<br/>
									(Cancel item which are not applicable)</td></tr>
									<tr>
										<td>21.1 By the supplier as a departmental work. :</td>
										<td><input type="text" class="form-control text-uppercase" name="testing[a]"  value="<?php echo $testing_a;?>" required="required"></td>
										<td>21.2 By the Contractor engaged by supplier :</td>
										<td ><input type="text" class="form-control text-uppercase" name="testing[b]"  value="<?php echo $testing_b;?>" required="required"></td>
									</tr>
									<tr>
										<td >21.3 By the Contractor engaged by the owner/consumer/occupier. :</td>
										<td ><input type="text" class="form-control text-uppercase" name="testing[c]"  value="<?php echo $testing_c;?>" required="required"></td>
										<td ></td>
										<td ></td>
									</tr>
									
									
									<tr><td colspan="2">(In case of the work is done by a Contractor, a copy of Contractor License and Supervisor license will have to be enclosed)</td>
									<td colspan="2">To be Uploaded in Upload Section</td>
									</tr>
									
								
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label></td>										
										<td colspan="2" align="right">Signature: <strong><?php echo strtoupper($key_person)?></strong><br/>
										Name: <label><?php echo strtoupper($key_person)?></strong>
										</td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=3" type="button" class="btn btn-primary">Go Back & Edit</a>	
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>d" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	
	/* ----------------------------------------------------- */
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	$('input').attr('required', 'required');
</script>