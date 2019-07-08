<?php  require_once "../../requires/login_session.php";
$dept="cfs";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];		
		// Tab 1 //
		$others_specify=$results['others_specify'];		
		if(!empty($results["business"])){
			$business=json_decode($results["business"]);
			if(isset($business->a)) $business_a=$business->a; else $business_a="";
			if(isset($business->b)) $business_b=$business->b; else $business_b="";
			if(isset($business->c)) $business_c=$business->c; else $business_c="";
			if(isset($business->d)) $business_d=$business->d; else $business_d="";
			if(isset($business->e)) $business_e=$business->e; else $business_e="";
			if(isset($business->f)) $business_f=$business->f; else $business_f="";
			if(isset($business->g)) $business_g=$business->g; else $business_g="";
			if(isset($business->h)) $business_h=$business->h; else $business_h="";
			if(isset($business->i)) $business_i=$business->i; else $business_i="";
			if(isset($business->j)) $business_j=$business->j; else $business_j="";
			if(isset($business->k)) $business_k=$business->k; else $business_k="";
			if(isset($business->l)) $business_l=$business->l; else $business_l="";
			if(isset($business->m)) $business_m=$business->m; else $business_m="";
			if(isset($business->n)) $business_n=$business->n; else $business_n="";
			if(isset($business->o)) $business_o=$business->o; else $business_o="";
			if(isset($business->p)) $business_p=$business->p; else $business_p="";
			if(isset($business->q)) $business_q=$business->q; else $business_q="";
			if(isset($business->r)) $business_r=$business->r; else $business_r="";
			if(isset($business->s)) $business_s=$business->s; else $business_s="";
			if(isset($business->t)) $business_t=$business->t; else $business_t="";
		}else{
			$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";$business_l="";$business_m="";$business_n="";$business_o="";$business_p="";$business_q="";$business_r="";$business_s="";$business_t="";
		}		
		if(!empty($results["premise_add"])){
			$premise_add=json_decode($results["premise_add"]);
			$premise_add_sn1=$premise_add->sn1;$premise_add_sn2=$premise_add->sn2;$premise_add_vill=$premise_add->vill;$premise_add_dist=$premise_add->dist;$premise_add_pin=$premise_add->pin;$premise_add_mobile=$premise_add->mobile;
		}else{				
			$premise_add_sn1="";$premise_add_sn2="";$premise_add_vill="";$premise_add_dist="";$premise_add_pin="";$premise_add_mobile="";
		}        
		if(!empty($results["in_charge"])){
			$in_charge=json_decode($results["in_charge"]);
			$in_charge_name=$in_charge->name;$in_charge_qual=$in_charge->qual;$in_charge_address=$in_charge->address;$in_charge_mobile=$in_charge->mobile;$in_charge_tel=$in_charge->tel;$in_charge_email=$in_charge->email;$in_charge_card=$in_charge->card;$in_charge_expiry=$in_charge->expiry;
		}else{				
			$in_charge_name="";$in_charge_qual="";$in_charge_address="";$in_charge_mobile="";$in_charge_tel="";$in_charge_email="";$in_charge_card="";$in_charge_expiry="";
		}
		if(!empty($results["comply"])){
			$comply=json_decode($results["comply"]);
			$comply_name=$comply->name;$comply_address=$comply->address;$comply_mobile=$comply->mobile;$comply_tel=$comply->tel;$comply_email=$comply->email;$comply_card=$comply->card;$comply_expiry=$comply->expiry;
		}else{				
			$comply_name="";$comply_address="";$comply_mobile="";$comply_tel="";$comply_email="";$comply_card="";$comply_expiry="";
		}
		if(!empty($results["corr_add"])){
			$corr_add=json_decode($results["corr_add"]);
			$corr_add_address=$corr_add->address;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
		}else{				
			$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		}		
		// Tab 2 //
		$is_license=$results['is_license'];	$capacity=$results['capacity'];		
		if(!empty($results["dairy"])){
			$dairy=json_decode($results["dairy"]);
			$dairy_lean=$dairy->lean;$dairy_flush=$dairy->flush;
		}else{				
			$dairy_lean="";$dairy_flush="";
		}		
		// Tab 3 //
		$electricity=$results['electricity'];$is_unit=$results['is_unit'];$is_unit_details=$results['is_unit_details'];$period=$results['period'];$rupees=$results['rupees'];$draft=$results['draft'];
		if(!empty($results["factory"])){
			$factory_values=json_decode($results["factory"]);
			$factory_name=$factory_values->name;$factory_sn1=$factory_values->sn1;$factory_sn2=$factory_values->sn2;$factory_vill=$factory_values->vill;$factory_dist=$factory_values->dist;$factory_pin=$factory_values->pin;$factory_mobile=$factory_values->mobile;
		}else{				
			$factory_name="";$factory_sn1="";$factory_sn2="";$factory_vill="";$factory_dist="";$factory_pin="";$factory_mobile="";
		}  
	}else{
		$form_id="";
		// Tab 1 //
		$others_specify="";
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";$business_l="";$business_m="";$business_n="";$business_o="";$business_p="";$business_q="";$business_r="";$business_s="";$business_t="";
		$premise_add_sn1="";$premise_add_sn2="";$premise_add_vill="";$premise_add_dist="";$premise_add_pin="";$premise_add_mobile="";
		$in_charge_name="";$in_charge_qual="";$in_charge_address="";$in_charge_mobile="";$in_charge_tel="";$in_charge_email="";$in_charge_card="";$in_charge_expiry="";
		$comply_name="";$comply_address="";$comply_mobile="";$comply_tel="";$comply_email="";$comply_card="";$comply_expiry="";
		$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		// Tab 2 //
		$is_license="";$capacity="";
		$dairy_lean="";$dairy_flush="";
		// Tab 3 //
		$electricity="";$is_unit="";$is_unit_details="";$period="";$rupees="";$draft="";
		$factory_name="";$factory_sn1="";$factory_sn2="";$factory_vill="";$factory_dist="";$factory_pin="";$factory_mobile="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	// Tab 1 //
	$others_specify=$results['others_specify'];	
	if(!empty($results["business"])){
		$business=json_decode($results["business"]);
		if(isset($business->a)) $business_a=$business->a; else $business_a="";
		if(isset($business->b)) $business_b=$business->b; else $business_b="";
		if(isset($business->c)) $business_c=$business->c; else $business_c="";
		if(isset($business->d)) $business_d=$business->d; else $business_d="";
		if(isset($business->e)) $business_e=$business->e; else $business_e="";
		if(isset($business->f)) $business_f=$business->f; else $business_f="";
		if(isset($business->g)) $business_g=$business->g; else $business_g="";
		if(isset($business->h)) $business_h=$business->h; else $business_h="";
		if(isset($business->i)) $business_i=$business->i; else $business_i="";
		if(isset($business->j)) $business_j=$business->j; else $business_j="";
		if(isset($business->k)) $business_k=$business->k; else $business_k="";
		if(isset($business->l)) $business_l=$business->l; else $business_l="";
		if(isset($business->m)) $business_m=$business->m; else $business_m="";
		if(isset($business->n)) $business_n=$business->n; else $business_n="";
		if(isset($business->o)) $business_o=$business->o; else $business_o="";
		if(isset($business->p)) $business_p=$business->p; else $business_p="";
		if(isset($business->q)) $business_q=$business->q; else $business_q="";
		if(isset($business->r)) $business_r=$business->r; else $business_r="";
		if(isset($business->s)) $business_s=$business->s; else $business_s="";
		if(isset($business->t)) $business_t=$business->t; else $business_t="";
	}else{
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";$business_l="";$business_m="";$business_n="";$business_o="";$business_p="";$business_q="";$business_r="";$business_s="";$business_t="";
	}	
	if(!empty($results["premise_add"])){
		$premise_add=json_decode($results["premise_add"]);
		$premise_add_sn1=$premise_add->sn1;$premise_add_sn2=$premise_add->sn2;$premise_add_vill=$premise_add->vill;$premise_add_dist=$premise_add->dist;$premise_add_pin=$premise_add->pin;$premise_add_mobile=$premise_add->mobile;
	}else{				
		$premise_add_sn1="";$premise_add_sn2="";$premise_add_vill="";$premise_add_dist="";$premise_add_pin="";$premise_add_mobile="";
	}        
	if(!empty($results["in_charge"])){
		$in_charge=json_decode($results["in_charge"]);
		$in_charge_name=$in_charge->name;$in_charge_qual=$in_charge->qual;$in_charge_address=$in_charge->address;$in_charge_mobile=$in_charge->mobile;$in_charge_tel=$in_charge->tel;$in_charge_email=$in_charge->email;$in_charge_card=$in_charge->card;$in_charge_expiry=$in_charge->expiry;
	}else{				
		$in_charge_name="";$in_charge_qual="";$in_charge_address="";$in_charge_mobile="";$in_charge_tel="";$in_charge_email="";$in_charge_card="";$in_charge_expiry="";
	}
	if(!empty($results["comply"])){
		$comply=json_decode($results["comply"]);
        if(isset($comply->name)) $comply_name=$comply->name; else $comply_name="";
        if(isset($comply->address)) $comply_address=$comply->address; else $comply_address="";
        if(isset($comply->mobile)) $comply_mobile=$comply->mobile; else $comply_mobile="";
        if(isset($comply->tel)) $comply_tel=$comply->tel; else $comply_tel="";
        if(isset($comply->email)) $comply_email=$comply->email; else $comply_email="";
        if(isset($comply->card)) $comply_card=$comply->card; else $comply_card="";
        if(isset($comply->expiry)) $comply_expiry=$comply->expiry; else $comply_expiry="";
		
	}else{				
		$comply_name="";$comply_address="";$comply_mobile="";$comply_tel="";$comply_email="";$comply_card="";$comply_expiry="";
	}
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_address=$corr_add->address;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
	}else{				
		$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
	}
	// Tab 2 //
	$is_license=$results['is_license'];$capacity=$results['capacity'];	
	if(!empty($results["dairy"])){
		$dairy=json_decode($results["dairy"]);
		$dairy_lean=$dairy->lean;$dairy_flush=$dairy->flush;
	}else{				
		$dairy_lean="";$dairy_flush="";
	}
	// Tab 3 //
	$electricity=$results['electricity'];$is_unit=$results['is_unit'];$is_unit_details=$results['is_unit_details'];$period=$results['period'];$rupees=$results['rupees'];$draft=$results['draft'];
	if(!empty($results["factory"])){
		$factory_values=json_decode($results["factory"]);
		$factory_name=$factory_values->name;$factory_sn1=$factory_values->sn1;$factory_sn2=$factory_values->sn2;$factory_vill=$factory_values->vill;$factory_dist=$factory_values->dist;$factory_pin=$factory_values->pin;$factory_mobile=$factory_values->mobile;
	}else{				
		$factory_name="";$factory_sn1="";$factory_sn2="";$factory_vill="";$factory_dist="";$factory_pin="";$factory_mobile="";
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
    <?php include ("".$table_name."_addmore.php"); ?>
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
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="4">1. Kind of business (Please tick more than one, if applicable) :</td>
											</tr>											
											<tr>
												<td width="25%">
													<label class="checkbox"><input type="checkbox" <?php if($business_a=="MA") echo "checked"; ?> name="business[a]" value="MA">Manufacturing/ Processing including sorting, grading etc </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_b=="M") echo "checked"; ?> name="business[b]" value="M">Milk Collection/ Chilling </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_c=="S") echo "checked"; ?> name="business[c]" value="S">Slaughter House </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_d=="P") echo "checked"; ?> name="business[d]" value="P">Packaging </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_e=="RE") echo "checked"; ?> name="business[e]" value="RE">Restaurant </label>
												</td>
												<td width="25%">
													<label class="checkbox"><input type="checkbox" <?php if($business_f=="SO") echo "checked"; ?> name="business[f]" value="SO">Solvent extracting unit </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_g=="OR") echo "checked"; ?> name="business[g]" value="OR">Solvent extracting and oil refining plant </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_h=="PC") echo "checked"; ?> name="business[h]" value="PC">Solvent extracting plant equipped with pre cleaning of oil seeds or pre expelling of oil </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_i=="I") echo "checked"; ?> name="business[i]" value="I">Importing </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_j=="ST") echo "checked"; ?> name="business[j]" value="ST">Storage/ Warehouse/ Cold Storage </label>
												</td>
												<td width="25%">
													<label class="checkbox"><input type="checkbox" <?php if($business_k=="RT") echo "checked"; ?> name="business[k]" value="RT">Retail Trade </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_l=="W") echo "checked"; ?> name="business[l]" value="W">Wholesale Trade </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_m=="D") echo "checked"; ?> name="business[m]" value="D"> Distributor/ Supplier </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_n=="T") echo "checked"; ?> name="business[n]" value="T">Transporter of food </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_o=="C") echo "checked"; ?> name="business[o]" value="C">Catering </label>
												</td>
												<td width="25%">
													<label class="checkbox"><input type="checkbox" <?php if($business_p=="FV") echo "checked"; ?> name="business[p]" value="FV">Dhabha or any other food vending establishment </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_q=="CL") echo "checked"; ?> name="business[q]" value="CL">Club/ Canteen </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_r=="H") echo "checked"; ?> name="business[r]" value="H">Hotel </label>
													<label class="checkbox"><input type="checkbox" <?php if($business_s=="R") echo "checked"; ?> name="business[s]" value="R">Relabeling (manufactured by third party under own packing and labeling) </label>
												</td>
											</tr>
											<tr>
												<td><label class="checkbox"><input id="others" type="checkbox" <?php if($business_t=="O") echo "checked"; ?> name="business[t]" value="O"> Other(s), Please specify : </label></td>
												<td colspan="2"><input type="text" name="others_specify" id="others_specify" placeholder="Please specify" class="form-control text-uppercase" value="<?php echo $others_specify; ?>"/></td>
												<td></td>
											</tr>
											<tr>
												<td width="25%">2. Name of the Company/Organization : </td>
												<td width="25%"><input type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled="disabled"></td>
												<td width="25%">3. Registered Office Address :</td>
												<td width="25%"><textarea class="form-control text-uppercase" disabled="disabled"><?php echo $unit_details; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="4">4. Address of Premise for which license is being applied : </td>
											</tr>
											<tr>
												<td>Street Name1 : </td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[sn1]" value="<?php echo $premise_add_sn1; ?>"	></td>
												<td>Street Name2 :</td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[sn2]" value="<?php echo $premise_add_sn2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[vill]" value="<?php echo $premise_add_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[dist]" value="<?php echo $premise_add_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[pin]" validate="pincode" maxlength="6" value="<?php echo $premise_add_pin; ?>" ></td>
												<td>Mobile No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="premise_add[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $premise_add_mobile; ?>" ></td>
											</tr>
											<tr>
												<td colspan="4">5. Name and/or designation, qualification and address of technically qualified person in charge of operations as required under Regulation</td>
											</tr>											      
											<tr>
												<td>(a) Name : </td>
												<td><input type="text" class="form-control text-uppercase" name="in_charge[name]" value="<?php echo $in_charge_name; ?>"></td>
												<td>(b) Qualification</td>
												<td><input type="text" class="form-control text-uppercase" name="in_charge[qual]" value="<?php echo $in_charge_qual; ?>"></td>
											</tr>
											<tr>
												<td>(c) Address : </td>
												<td><textarea class="form-control text-uppercase" name="in_charge[address]"><?php echo $in_charge_address; ?></textarea></td>	
												<td>(d) Mobile No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="in_charge[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $in_charge_mobile; ?>" ></td>
											</tr>  
											<tr>
												<td>(e) Telephone Number(s) : </td>
												<td><input type="text" class="form-control text-uppercase" name="in_charge[tel]" value="<?php echo $in_charge_tel; ?>"></td>
												<td>(f) Email : </td>
												<td><input type="email" class="form-control text-uppercase" name="in_charge[email]" value="<?php echo $in_charge_email;?>" validate="email"></td>
											</tr>
											<tr>
												<td>(g) Photo Identity card no and expiry date : </td>
												<td><input type="text" class="form-control text-uppercase" name="in_charge[card]" value="<?php echo $in_charge_card; ?>" placeholder="Card Number"></td>
												<td><input type="text" class="dob form-control" name="in_charge[expiry]" value="<?php echo $in_charge_expiry; ?>" placeholder="Expiry Date"></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">6. Name and/or designation, address and contact details of person responsible for complying with conditions of license (if different from 4 Above) : </td>
											</tr>											      
											<tr>
												<td>(a) Name : </td>
												<td><input type="text" class="form-control text-uppercase" name="comply[name]" value="<?php echo $comply_name; ?>"></td>
												<td>(b) Address : </td>
												<td><textarea class="form-control text-uppercase" name="comply[address]"><?php echo $comply_address; ?></textarea></td>	
											</tr>
											<tr>
												<td>(c) Mobile No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="comply[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $comply_mobile; ?>" ></td>
												<td>(d) Telephone Number(s) : </td>
												<td><input type="text" class="form-control text-uppercase" name="comply[tel]" value="<?php echo $comply_tel; ?>"></td>
											</tr>
											<tr>
												<td>(e) Email : </td>
												<td><input type="email" class="form-control text-uppercase" name="comply[email]" value="<?php echo $comply_email;?>" validate="email"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>(f) Photo Identity card no and expiry date : </td>
												<td><input type="text" class="form-control text-uppercase" name="comply[card]" value="<?php echo $comply_card; ?>" placeholder="Card Number"></td>
												<td><input type="text" class="dob form-control" name="comply[expiry]" value="<?php echo $comply_expiry; ?>" placeholder="Expiry Date"></td>
												<td></td>
											</tr>
											<tr>
												<td>7. Correspondence address (if different from 3 above) : </td>
												<td colspan="2"><textarea class="form-control text-uppercase" name="corr_add[address]"><?php echo $corr_add_address; ?></textarea></td>	
												<td></td>
											</tr>
											<tr>
												<td>8. (a) Mobile No. : </td>
												<td><input type="text" class="form-control text-uppercase" name="corr_add[mobile]" value="<?php echo $corr_add_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
												<td>(b) Telephone Number : </td>
												<td><input type="text" class="form-control text-uppercase" name="corr_add[tel]" value="<?php echo $corr_add_tel; ?>"></td>
											</tr>
											<tr>
												<td>(c) Fax number : </td>
												<td><input type="text" class="form-control text-uppercase" name="corr_add[fax]" value="<?php echo $corr_add_fax; ?>"></td>
												<td>(d) Email : </td>
												<td><input type="email" class="form-control text-uppercase" name="corr_add[email]" value="<?php echo $corr_add_email;?>" validate="email"></td>
											</tr>											
											<tr>												
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>a" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>												
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td width="25%">9. Food items proposed to be manufactured : </td>
												<td colspan="3">
												<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
													<thead>
														<th>Sl No.</th>
														<th>Name of Food category/item </th>
														<th>Quantity in Kg per day or M.T. per annum </th>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input name="textB<?php echo $count;?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" ></td>
															<td><input name="textC<?php echo $count;?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" ></td>
														</tr>		
													<?php $count++; } 
													}else{	?>
														<tr>
															<td><input name="textA1" id="textA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="textB1" id="textB1" class="form-control text-uppercase" ></td>				
															<td><input name="textC1" id="textC1" class="form-control text-uppercase" ></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px">
													<button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>10. Do you already have valid license ? <span class="mandatory_field">*</span></td>
												<td colspan="3">
													<label class="radio-inline"><input type="radio" name="is_license" class="is_license" value="Y" <?php if(isset($is_license) && $is_license=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_license"  value="N"  name="is_license" <?php if(isset($is_license) && ($is_license=='N' || $is_license=='')) echo 'checked'; ?>/> No </label>
												</td>												
											</tr>
											<tr>
												<td>If already having valid license - mention annual quantity of each food category manufactured during last three years : </td>
												<td colspan="3">
												<table name="objectTable2" class="table table-responsive table-bordered "id="objectTable2" >
													<thead>
														<th>Sl No. </th>
														<th>Name of Food category/item </th>
														<th>Quantity in Kg per day or M.T. per annum </th>
													</thead>
													<?php
													$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
														$count=1;
														while($row_1=$part2->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text1A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text1A<?php echo $count;?>" size="1"></td>
															<td><input name="text1B<?php echo $count;?>" id="text1B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" ></td>
															<td><input name="text1C<?php echo $count;?>" id="text1C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text1A1" id="text1A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text1B1" id="text1B1" class="form-control text-uppercase" ></td>				
															<td><input name="text1C1" id="text1C1" class="form-control text-uppercase" ></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td width="25%">11. Installed Capacity food product wise (per day) : </td>
												<td width="25%"><input type="text" name="capacity" class="form-control text-uppercase" value="<?php echo $capacity;?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">12. For Dairy units : </td>
											</tr>
											<tr>
												<td colspan="4">(i) Location and installed capacity of Milk Chilling Centers (MCC) / Bulk Milk Cooling Centers (BMCs)/ Milk Processing Unit/ Milk Packaging Unit in litres owned or managed by the applicant : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable3" class="table table-responsive table-bordered "id="objectTable3" >
													<thead>
														<th>Sl No. </th>
														<th>Name and address of MCC/BMC </th>
														<th>Installed Capacity </th>
													</thead>
													<?php
													$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
													$num3 = $part3->num_rows;
													if($num3>0){
														$count=1;
														while($row_1=$part3->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text2A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text2A<?php echo $count;?>" size="1"></td>
															<td><input name="text2B<?php echo $count;?>" id="text2B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" ></td>
															<td><input name="text2C<?php echo $count;?>" id="text2C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["capacity"]; ?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text2A1" id="text2A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text2B1" id="text2B1" class="form-control text-uppercase" ></td>				
															<td><input name="text2C1" id="text2C1" class="form-control text-uppercase" ></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction3()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">(ii) Average Quantity of milk per day to be used/handled in : </td>
											</tr>
											<tr>
												<td width="25%">(a) In lean season : </td>
												<td width="25%"><input type="text" name="dairy[lean]" class="form-control text-uppercase" value="<?php echo $dairy_lean;?>"></td>
												<td width="25%">(b) In flush season : </td>
												<td width="25%"><input type="text" name="dairy[flush]" class="form-control text-uppercase" value="<?php echo $dairy_flush;?>"></td>
											</tr>
											<tr>
												<td>(iii) Milk products to be manufactured and their manufacturing capacity (tones/year) : </td>
												<td colspan="3">
												<table name="objectTable4" class="table table-responsive table-bordered "id="objectTable4" >
													<thead>
														<th>Sl No. </th>
														<th>Milk products to be manufactured </th>
														<th>Manufacturing capacity (tones/year) </th>
													</thead>
													<?php
													$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
													$num4 = $part4->num_rows;
													if($num4>0){
														$count=1;
														while($row_1=$part4->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text3A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text3A<?php echo $count;?>" size="1"></td>
															<td><input name="text3B<?php echo $count;?>" id="text3B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["products"]; ?>" placeholder="Milk products"></td>
															<td><input name="text3C<?php echo $count;?>" id="text3C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["capacity"]; ?>" placeholder="tones/year"></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text3A1" id="text3A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text3B1" id="text3B1" class="form-control text-uppercase" placeholder="Milk products"></td>				
															<td><input name="text3C1" id="text3C1" class="form-control text-uppercase" placeholder="tones/year"></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction4()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>	
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" class="myform1 submit1" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">13. For Solvent - Extracted Oil, De oiled meal and Edible Flour : </td>
											</tr>
											<tr>
												<td colspan="4">(i) Details of proposed business : </td>
											</tr>											
											<tr>
												<td colspan="4">
												<table name="objectTable5" class="table table-responsive table-bordered "id="objectTable5" >
													<thead>
														<tr>
															<th rowspan="2" class="text-center" width="4%">Sl. No.</th>
															<th rowspan="2" class="text-center" width="10%">Name of Oil bearing material</th>
															<th rowspan="2" class="text-center" width="10%">From seed or nut or cake</th>
															<th colspan="6" class="text-center" width="60%">Solvent - Extracted Oil, De oiled meal and Edible Flour</th>
															<th rowspan="2" class="text-center" width="10%">Vegetable Oil</th>
														</tr>
														<tr>
															<th width="10%">Crude </th>
															<th width="10%">Neutralized </th>
															<th width="10%">Neutralized & Bleached </th>
															<th width="10%">Refined </th>
															<th width="10%">De oiled meal </th>
															<th width="10%">Edible Flour </th>
														</tr>
													</thead>
													<?php
													$part5=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t5 where form_id='$form_id'");
													$num5 = $part5->num_rows;
													if($num5>0){
														$count=1;
														while($row_1=$part5->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text4A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text4A<?php echo $count;?>" size="1"></td>
															<td><input name="text4B<?php echo $count;?>" id="text4B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>"></td>
															<td><input name="text4C<?php echo $count;?>" id="text4C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["seed"]; ?>"></td>
															<td><input name="text4D<?php echo $count;?>" id="text4D<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["crude"]; ?>"></td>
															<td><input name="text4E<?php echo $count;?>" id="text4E<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["neutralized"]; ?>"></td>
															<td><input name="text4F<?php echo $count;?>" id="text4F<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["bleached"]; ?>"></td>
															<td><input name="text4G<?php echo $count;?>" id="text4G<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["refined"]; ?>"></td>
															<td><input name="text4H<?php echo $count;?>" id="text4H<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["meat"]; ?>"></td>
															<td><input name="text4I<?php echo $count;?>" id="text4I<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["flour"]; ?>"></td>
															<td><input name="text4J<?php echo $count;?>" id="text4J<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["vegetable"]; ?>"></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text4A1" id="text4A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text4B1" id="text4B1" class="form-control text-uppercase"></td>				
															<td><input name="text4C1" id="text4C1" class="form-control text-uppercase"></td>				
															<td><input name="text4D1" id="text4D1" class="form-control text-uppercase"></td>				
															<td><input name="text4E1" id="text4E1" class="form-control text-uppercase"></td>				
															<td><input name="text4F1" id="text4F1" class="form-control text-uppercase"></td>				
															<td><input name="text4G1" id="text4G1" class="form-control text-uppercase"></td>				
															<td><input name="text4H1" id="text4H1" class="form-control text-uppercase"></td>				
															<td><input name="text4I1" id="text4I1" class="form-control text-uppercase"></td>				
															<td><input name="text4J1" id="text4J1" class="form-control text-uppercase"></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction5()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">If already having valid license - mention annual quantity of each product manufactured during last three years : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable6" class="table table-responsive table-bordered "id="objectTable6" >
													<thead>
														<th>Sl No. </th>
														<th>Name of Food category/item </th>
														<th>Quantity in Kg per day or M.T. per annum </th>
													</thead>
													<?php
													$part6=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t6 where form_id='$form_id'");
													$num6 = $part6->num_rows;
													if($num6>0){
														$count=1;
														while($row_1=$part6->fetch_array()){ ?>
														<tr>
															<td><input readonly="readonly" id="text5A<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="text5A<?php echo $count;?>" size="1"></td>
															<td><input name="text5B<?php echo $count;?>" id="text5B<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" ></td>
															<td><input name="text5C<?php echo $count;?>" id="text5C<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" ></td>
														</tr>	
													<?php $count++; } 
													}else{?>
														<tr>
															<td><input name="text5A1" id="text5A1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
															<td><input name="text5B1" id="text5B1" class="form-control text-uppercase" ></td>				
															<td><input name="text5C1" id="text5C1" class="form-control text-uppercase" ></td>
														</tr>
													<?php } ?>
												</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction6()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">(ii) Name and address of factory or factories used by the miller or solvent extractor for processing oil bearing material produced or procured by him or for refining solvent extracted Oil produced by him : </td>
											</tr>
											<tr>
												<td width="25%">Name :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="factory[name]" value="<?php echo $factory_name; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td width="25%">Street Name1 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="factory[sn1]" value="<?php echo $factory_sn1; ?>"></td>
												<td width="25%">Street Name2 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="factory[sn2]" value="<?php echo $factory_sn2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" name="factory[vill]" value="<?php echo $factory_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" name="factory[dist]" value="<?php echo $factory_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" name="factory[pin]" validate="pincode" maxlength="6" value="<?php echo $factory_pin; ?>" ></td>
												<td>Mobile No. :</td>
												<td><input type="text" class="form-control text-uppercase" name="factory[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $factory_mobile; ?>" ></td>
											</tr>
											<tr>
												<td>14. Sanctioned electricity load or HP to be used :</td>
												<td><input type="text" class="form-control text-uppercase" name="electricity" value="<?php echo $electricity; ?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td>15. Whether unit is equipped with an analytical laboratory ? <span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" name="is_unit" class="is_unit" value="Y" <?php if(isset($is_unit) && $is_unit=='Y') echo 'checked'; ?> /> Yes </label>
													<label class="radio-inline"><input type="radio" class="is_unit"  value="N"  name="is_unit" <?php if(isset($is_unit) && ($is_unit=='N' || $is_unit=='')) echo 'checked'; ?>/> No </label>
												</td>
												<td>If yes the details thereof : </td>	
												<td><input type="text" name="is_unit_details" id="is_unit_details" class="form-control text-uppercase" value="<?php echo $is_unit_details; ?>"></td>
											</tr>
											<tr>
												<td colspan="3">16. In case of renewal or transfer of license granted under other laws as per provison to Regulation 5(1) - period for which license required (1 to 5 years) : </td>
												<td><input type="text" class="form-control text-uppercase" name="period" value="<?php echo $period; ?>"></td>
											</tr>
											<tr class="form-inline">
												<td colspan="4">17. I/We have forwarded a sum of Rs. &nbsp;<input type="text"  class="form-control text-uppercase" name="rupees" value="<?php echo $rupees;?>" >&nbsp; towards License fees according to the provision of the Food Safety and Standards Regulations, 2011 vide : <br/>&nbsp; Demand Draft no (payable to &nbsp;<input type="text"  class="form-control text-uppercase" name="draft" value="<?php echo $draft;?>" >&nbsp; )</td>
											</tr>											
											<tr>
												<td colspan="4" align="right">Signature of the applicant/authorized signatory : <strong><?php echo strtoupper($key_person)?></strong></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>c" class="btn btn-success text-bold submit1">Save and Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */		
	<?php if(isset($others_specify) && $others_specify=="") echo '$("#others_specify").attr("disabled", "disabled");	';?>	
	$("#others").click(function () {
		if ($(this).is(":checked")) {
			$("#others_specify").removeAttr("disabled");
			$("#others_specify").focus();
		} else {
			$("#others_specify").attr("disabled", "disabled");
		}
	});
	/* ------------------------------------------------------ */
	$('#is_unit_details').attr('readonly','readonly');
	<?php if($is_unit == 'Y') echo "$('#is_unit_details').removeAttr('readonly','readonly');"; ?>
	$('.is_unit').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_unit_details').removeAttr('readonly','readonly');
		}else{
			$('#is_unit_details').attr('readonly','readonly');
			$('#is_unit_details').val('');
		}			
	});
</script>