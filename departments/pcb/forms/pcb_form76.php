<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="76";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form_new.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$city_name=$results['city_name'];$population=$results['population'];$auth_name=$results['auth_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$waste_used=$results['waste_used'];$is_practice=$results['is_practice'];$is_practice_details=$results['is_practice_details'];$lift_bin_equip=$results['lift_bin_equip'];$improve=$results['improve'];$efforts=$results['efforts'];$slums=$results['slums'];$is_action=$results['is_action'];$is_action_details=$results['is_action_details'];
		
		if(!empty($results["auth"])){
			$auth=json_decode($results["auth"]);
			$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_tel=$auth->tel;$auth_fax=$auth->fax;$auth_email=$auth->email;$auth_website=$auth->website;
		}else{				
			$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_tel="";$auth_fax="";$auth_email="";$auth_website="";
		}	
		
		if(!empty($results["generate"])){
			$generate=json_decode($results["generate"]);
			$generate_lean=$generate->lean;$generate_tpd=$generate->tpd;$generate_collect=$generate->collect;$generate_facility=$generate->facility;$generate_status=$generate->status;
		}else{				
			$generate_lean="";$generate_tpd="";$generate_collect="";$generate_facility="";$generate_status="";
		}		
		
		if(!empty($results["recycle"])){
			$recycle=json_decode($results["recycle"]);
			$recycle_concrete=$recycle->concrete;$recycle_sand=$recycle->sand;$recycle_rmc=$recycle->rmc;$recycle_blocks=$recycle->blocks;$recycle_gsb=$recycle->gsb;$recycle_others=$recycle->others;
		}else{				
			$recycle_concrete="";$recycle_sand="";$recycle_rmc="";$recycle_blocks="";$recycle_gsb="";$recycle_others="";
		}       

		if(!empty($results["dispose"])){
			$dispose=json_decode($results["dispose"]);
			$dispose_landfill=$dispose->landfill;$dispose_area=$dispose->area;$dispose_weigh=$dispose->weigh;$dispose_facility=$dispose->facility;
		}else{				
			$dispose_landfill="";$dispose_area="";$dispose_weigh="";$dispose_facility="";
		}
		
		if(!empty($results["storage"])){
			$storage=json_decode($results["storage"]);
			$storage_collect=$storage->collect;$storage_project=$storage->project;$storage_bin=$storage->bin;$storage_others=$storage->others;$storage_attend=$storage->attend;
		}else{				
			$storage_collect="";$storage_project="";$storage_bin="";$storage_others="";$storage_attend="";
		}
		
		if(!empty($results["lift_bin"])){
			$lift_bin=json_decode($results["lift_bin"]);
			if(isset($lift_bin->a)) $lift_bin_a=$lift_bin->a; else $lift_bin_a="";
			if(isset($lift_bin->b)) $lift_bin_b=$lift_bin->b; else $lift_bin_b="";
			if(isset($lift_bin->c)) $lift_bin_c=$lift_bin->c; else $lift_bin_c="";
		}else{				
			$lift_bin_a="";$lift_bin_b="";$lift_bin_c="";
		}
		
		if(!empty($results["required"])){
			$required=json_decode($results["required"]);
			$required_a=$required->a;$required_b=$required->b;$required_c=$required->c;$required_d=$required->d;$required_e=$required->e;$required_f=$required->f;$required_g=$required->g;$required_h=$required->h;
		}else{				
			$required_a="";$required_b="";$required_c="";$required_d="";$required_e="";$required_f="";$required_g="";$required_h="";
		}
		
		if(!empty($results["technologies"])){
			$technologies=json_decode($results["technologies"]);
			$technologies_q1=$technologies->q1;$technologies_q2=$technologies->q2;$technologies_q3=$technologies->q3;$technologies_s1=$technologies->s1;$technologies_s2=$technologies->s2;$technologies_s3=$technologies->s3;
		}else{				
			$technologies_q1="";$technologies_q2="";$technologies_q3="";$technologies_s1="";$technologies_s2="";$technologies_s3="";
		}
		
		if(!empty($results["provisions"])){
			$provisions=json_decode($results["provisions"]);
			$provisions_river=$provisions->river;$provisions_low_line=$provisions->low_line;$provisions_waste=$provisions->waste;$provisions_parks=$provisions->parks;
		}else{				
			$provisions_river="";$provisions_low_line="";$provisions_waste="";$provisions_parks="";
		}
	}else{
		$form_id="";$city_name="";$population="";$auth_name="";$officer_name="";$officer_desgn="";$waste_used="";$is_practice="";$is_practice_details="";$improve="";$efforts="";$slums="";$is_action="";$is_action_details="";
		$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_tel="";$auth_fax="";$auth_email="";$auth_website="";
		$generate_lean="";$generate_tpd="";$generate_collect="";$generate_facility="";$generate_status="";
		$recycle_concrete="";$recycle_sand="";$recycle_rmc="";$recycle_blocks="";$recycle_gsb="";$recycle_others="";
		$dispose_landfill="";$dispose_area="";$dispose_weigh="";$dispose_facility="";
		$storage_collect="";$storage_project="";$storage_bin="";$storage_others="";$storage_attend="";
		$lift_bin_equip="";$lift_bin_a="";$lift_bin_b="";$lift_bin_c="";
		$required_a="";$required_b="";$required_c="";$required_d="";$required_e="";$required_f="";$required_g="";$required_h="";
		$technologies_q1="";$technologies_q2="";$technologies_q3="";$technologies_s1="";$technologies_s2="";$technologies_s3="";
		$provisions_river="";$provisions_low_line="";$provisions_waste="";$provisions_parks="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$city_name=$results['city_name'];$population=$results['population'];$auth_name=$results['auth_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$waste_used=$results['waste_used'];$is_practice=$results['is_practice'];$is_practice_details=$results['is_practice_details'];$lift_bin_equip=$results['lift_bin_equip'];$improve=$results['improve'];$efforts=$results['efforts'];$slums=$results['slums'];$is_action=$results['is_action'];$is_action_details=$results['is_action_details'];
		
	if(!empty($results["auth"])){
		$auth=json_decode($results["auth"]);
		$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_tel=$auth->tel;$auth_fax=$auth->fax;$auth_email=$auth->email;$auth_website=$auth->website;
	}else{				
		$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pincode="";$auth_mobile="";$auth_tel="";$auth_fax="";$auth_email="";$auth_website="";
	}	
	
	if(!empty($results["generate"])){
		$generate=json_decode($results["generate"]);
		$generate_lean=$generate->lean;$generate_tpd=$generate->tpd;$generate_collect=$generate->collect;$generate_facility=$generate->facility;$generate_status=$generate->status;
	}else{				
		$generate_lean="";$generate_tpd="";$generate_collect="";$generate_facility="";$generate_status="";
	}		
	
	if(!empty($results["recycle"])){
		$recycle=json_decode($results["recycle"]);
		$recycle_concrete=$recycle->concrete;$recycle_sand=$recycle->sand;$recycle_rmc=$recycle->rmc;$recycle_blocks=$recycle->blocks;$recycle_gsb=$recycle->gsb;$recycle_others=$recycle->others;
	}else{				
		$recycle_concrete="";$recycle_sand="";$recycle_rmc="";$recycle_blocks="";$recycle_gsb="";$recycle_others="";
	}       

	if(!empty($results["dispose"])){
		$dispose=json_decode($results["dispose"]);
		$dispose_landfill=$dispose->landfill;$dispose_area=$dispose->area;$dispose_weigh=$dispose->weigh;$dispose_facility=$dispose->facility;
	}else{				
		$dispose_landfill="";$dispose_area="";$dispose_weigh="";$dispose_facility="";
	}
	
	if(!empty($results["storage"])){
		$storage=json_decode($results["storage"]);
		$storage_collect=$storage->collect;$storage_project=$storage->project;$storage_bin=$storage->bin;$storage_others=$storage->others;$storage_attend=$storage->attend;
	}else{				
		$storage_collect="";$storage_project="";$storage_bin="";$storage_others="";$storage_attend="";
	}
	
	if(!empty($results["lift_bin"])){
		$lift_bin=json_decode($results["lift_bin"]);
		if(isset($lift_bin->a)) $lift_bin_a=$lift_bin->a; else $lift_bin_a="";
		if(isset($lift_bin->b)) $lift_bin_b=$lift_bin->b; else $lift_bin_b="";
		if(isset($lift_bin->c)) $lift_bin_c=$lift_bin->c; else $lift_bin_c="";
	}else{				
		$lift_bin_a="";$lift_bin_b="";$lift_bin_c="";
	}
	
	if(!empty($results["required"])){
		$required=json_decode($results["required"]);
		$required_a=$required->a;$required_b=$required->b;$required_c=$required->c;$required_d=$required->d;$required_e=$required->e;$required_f=$required->f;$required_g=$required->g;$required_h=$required->h;
	}else{				
		$required_a="";$required_b="";$required_c="";$required_d="";$required_e="";$required_f="";$required_g="";$required_h="";
	}
	
	if(!empty($results["technologies"])){
			$technologies=json_decode($results["technologies"]);
			$technologies_q1=$technologies->q1;$technologies_q2=$technologies->q2;$technologies_q3=$technologies->q3;$technologies_s1=$technologies->s1;$technologies_s2=$technologies->s2;$technologies_s3=$technologies->s3;
		}else{				
			$technologies_q1="";$technologies_q2="";$technologies_q3="";$technologies_s1="";$technologies_s2="";$technologies_s3="";
		}
	
	if(!empty($results["provisions"])){
		$provisions=json_decode($results["provisions"]);
		$provisions_river=$provisions->river;$provisions_low_line=$provisions->low_line;$provisions_waste=$provisions->waste;$provisions_parks=$provisions->parks;
	}else{				
		$provisions_river="";$provisions_low_line="";$provisions_waste="";$provisions_parks="";
	}
}
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
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of the City or Town : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="city_name" value="<?php echo $city_name;?>" ></td>
											<td width="25%">2. Population : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="population" value="<?php echo $population;?>" ></td>
										</tr>
										<tr>
											<td>3. Name of local authority or competent authority :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth_name" value="<?php echo $auth_name; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">4. Address of local authority or competent authority : </td>	
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[sn1]" value="<?php echo $auth_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[sn2]" value="<?php echo $auth_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[vill]" value="<?php echo $auth_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[dist]" value="<?php echo $auth_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[pin]" validate="pincode" maxlength="6" value="<?php echo $auth_pin; ?>" ></td>
											<td>Mobile No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $auth_mobile; ?>" ></td>
										</tr>
										<tr>
											<td>Telephone No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="auth[tel]" value="<?php echo $auth_tel; ?>" ></td>
											<td>Fax No. :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[fax]" value="<?php echo $auth_fax; ?>" ></td>
										</tr>
										<tr>
											<td>Email id : </td>
											<td><input type="email" class="form-control text-uppercase" name="auth[email]" value="<?php echo $auth_email; ?>" ></td>
											<td>Website :</td>
											<td><input type="text" class="form-control text-uppercase" name="auth[website]" value="<?php echo $auth_website; ?>" ></td>
										</tr>
										<tr>
											<td colspan="2">5. Name of In-charge or Nodal Officer dealing with construction and demolition wastes management with designation : </td>
											<td><input type="text" class="form-control text-uppercase" name="officer_name" value="<?php echo $officer_name; ?>" placeholder="Name" ></td>
											<td><input type="text" class="form-control text-uppercase" name="officer_desgn" value="<?php echo $officer_desgn; ?>" placeholder="Designation" ></td>
										</tr>
										<tr>
											<td colspan="4">6. Quantity and composition of construction and demolition waste including any deconstruction waste : </td>
										</tr>
										<tr>
											<td colspan="4">(a) Total quantity of construction and demolition waste generated during the whole year (in metric ton) : </td>
										</tr>
										<tr>
											<td>Any figures for lean period and peak period generation per day : </td>
											<td><input type="text" class="form-control text-uppercase" name="generate[lean]" value="<?php echo $generate_lean; ?>" placeholder="(in metric ton)" validate="decimal"></td>
											<td>Average generation of construction and demolition waste (TPD) : </td>
											<td><input type="text" class="form-control text-uppercase" name="generate[tpd]" value="<?php echo $generate_tpd; ?>" placeholder="(in metric ton)" validate="decimal"></td>
										</tr>
										<tr>
											<td>Total quantity of construction and demolition waste collected per day : </td>
											<td><input type="text" class="form-control text-uppercase" validate="decimal" name="generate[collect]" value="<?php echo $generate_collect; ?>" placeholder="(in metric ton)"></td>
											<td>Any Processing / Recycling Facility set up in the city : </td>
											<td><input type="text" class="form-control text-uppercase" name="generate[facility]" value="<?php echo $generate_facility; ?>"></td>
										</tr> 
										<tr>
											<td>Status of the facility : </td>
											<td><input type="text" class="form-control text-uppercase" name="generate[status]" value="<?php echo $generate_status; ?>"></td>
											<td colspan="2"></td>
										</tr> 
										<tr>
											<td colspan="4">(b) Total quantity of construction and demolition waste processed / recycled (in metric ton) : </td>
										</tr>
										<tr>
											<td>Non-structural concrete aggregate : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[concrete]" value="<?php echo $recycle_concrete;?>" placeholder="(in metric ton)" validate="decimal"></td>
											<td>Manufactured sand : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[sand]" value="<?php echo $recycle_sand;?>" placeholder="(in metric ton)" validate="decimal"></td>
										</tr>
										<tr>
											<td>Ready-mix concrete (RMC) : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[rmc]" value="<?php echo $recycle_rmc;?>" placeholder="(in metric ton)" validate="decimal"></td>
											<td>Paving blocks : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[blocks]" value="<?php echo $recycle_blocks;?>" placeholder="(in metric ton)" validate="decimal"></td>
										</tr> 
										<tr>
											<td>GSB : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[gsb]" value="<?php echo $recycle_gsb;?>" placeholder="(in metric ton)" validate="decimal"></td>
											<td>Others, if any, please specify : </td>
											<td><input type="text" class="form-control text-uppercase" name="recycle[others]" value="<?php echo $recycle_others;?>" placeholder="Others (in metric ton)"></td>
										</tr> 
										<tr>
											<td colspan="4">(c) Total quantity of Construction & Demolition waste disposed by land filling without processing (last option) or filling low lying areas : </td>
										</tr>
										<tr>
											<td>No of landfill sites used : </td>
											<td><input type="text" class="form-control text-uppercase" name="dispose[landfill]" value="<?php echo $dispose_landfill;?>"></td>
											<td>Area used : </td>
											<td><input type="text" class="form-control text-uppercase" name="dispose[area]" value="<?php echo $dispose_area;?>"></td>
										</tr>
										<tr>
											<td>Whether weigh-bridge : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="dispose[weigh]" value="Y"  <?php if(isset($dispose_weigh) && ($dispose_weigh=='Y' || $dispose_weigh=='')) echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="radio-inline"><input type="radio" name="dispose[weigh]" value="N" <?php if(isset($dispose_weigh) && $dispose_weigh=='N') echo 'checked'; ?>/> No</label>
											</td>
											<td>Facility used for quantity estimation : </td>
											<td><input type="text" class="form-control text-uppercase" name="dispose[facility]" value="<?php echo $dispose_facility;?>"></td>
										</tr> 
										<tr>
											<td colspan="3">(d) Whether construction and demolition waste used in sanitary landfill (for solid waste) as per Schedule III : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="waste_used" value="Y"  <?php if(isset($waste_used) && ($waste_used=='Y' || $waste_used=='')) echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="waste_used" value="N" <?php if(isset($waste_used) && $waste_used=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="4">7. Storage facilities : </td>
										</tr>	
										<tr>
											<td>(a) Area or location or plot or societies covered for collection of Construction and Demolition waste : </td>
											<td><input type="text" class="form-control text-uppercase" name="storage[collect]" value="<?php echo $storage_collect;?>"></td>
											<td>(b) No. of large Projects (including roadways project) covered : </td>
											<td><input type="text" class="form-control text-uppercase" name="storage[project]" value="<?php echo $storage_project;?>"></td>
										</tr>
										<tr>
											<td>(c) Whether Area or location or plot or societies collection is Practiced : </td> 
											<td>
												<label class="radio-inline"><input type="radio" name="is_practice" class="is_practice" value="Y" <?php if(isset($is_practice) && $is_practice=='Y') echo 'checked'; ?> /> Yes </label>
												<label class="radio-inline"><input type="radio" class="is_practice"  value="N"  name="is_practice" <?php if(isset($is_practice) && ($is_practice=='N' || $is_practice=='')) echo 'checked'; ?>/> No </label>
											</td>
											<td>If yes, whether done by : </td>
											<td>
												<select name="is_practice_details" id="is_practice_details" class="form-control text-uppercase">
													<option value="">Choose One</option>
													<option value="C" <?php if($is_practice_details=="C") echo "selected"; ?>>Competent Authority</option>
													<option value="L" <?php if($is_practice_details=="L") echo "selected"; ?>>Local Authority</option>
													<option value="P" <?php if($is_practice_details=="P") echo "selected"; ?>>Private Agency</option>
													<option value="N" <?php if($is_practice_details=="N") echo "selected"; ?>>Non-Governmental Organization</option>
												</select>
											</td>
										</tr>
										<tr>
											<td colspan="4">(d) Storage Bins : </td>
										</tr>
										<tr>
											<td>(i) Containers or receptacle (Capacity) : </td>
											<td><input type="text" class="form-control text-uppercase" name="storage[bin]" value="<?php echo $storage_bin;?>"></td>
											<td>(ii) Others, please specify : </td>
											<td><input type="text" class="form-control text-uppercase" name="storage[others]" value="<?php echo $storage_others;?>"></td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
												<thead>
												<tr>
													<th>Sl No.</th>
													<th>Specifications (Shape & Size)</th>
													<th>Existing Number</th>
													<th>Proposed for future</th>
												</tr>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["specification"]; ?>" id="txtB<?php echo $count;?>" placeholder="Specifications (Shape & Size)" class="form-control text-uppercase" name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["existing_no"]; ?>" id="txtC<?php echo $count;?>" placeholder="Existing Number" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["future"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" placeholder="Proposed for future" ></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" class="form-control text-uppercase" placeholder="Specifications (Shape & Size)" name="txtB1"></td>					
														<td><input id="txtC1" class="form-control text-uppercase" placeholder="Existing Number" name="txtC1"></td>	
														<td><input id="txtD1" class="form-control text-uppercase" name="txtD1" placeholder="Proposed for future"></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td colspan="2">(e) Whether all storage bins/collection spots are attended for daily lifting : </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="storage[attend]" value="Y"  <?php if(isset($storage_attend) && ($storage_attend=='Y' || $storage_attend=='')) echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="storage[attend]" value="N" <?php if(isset($storage_attend) && $storage_attend=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
										    <td>(f) Whether lifting of Construction & Demolition Waste from Storage bins is manual or mechanical (Please tick mark) <span class="mandatory_field">*</span></td>
											<td>
												<label class="checkbox-inline"><input type="checkbox" <?php if($lift_bin_a=="MA") echo "checked"; ?> name="lift_bin[a]" value="MA">Manual</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($lift_bin_b=="ME") echo "checked"; ?> name="lift_bin[b]" value="ME">Mechanical</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($lift_bin_c=="O") echo "checked"; ?> name="lift_bin[c]" value="O">Others</label>
											</td>
											<td>Equipment used (Please specify mode) : </td>
											<td><input type="text" class="form-control text-uppercase" name="lift_bin_equip" value="<?php echo $lift_bin_equip;?>"></td>
										</tr>
										<tr> 
											<td>8. (a) Transportation : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[a]" value="<?php echo $required_a;?>" placeholder="Existing Actually Required/Proposed number"></td>
											<td>(b) Truck : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[b]" value="<?php echo $required_b;?>" placeholder="Existing Actually Required/Proposed number"></td>
										</tr>
										<tr>
											<td>(c) Truck-Hydraulic : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[c]" value="<?php echo $required_c;?>" placeholder="Existing Actually Required/Proposed number"></td>
											<td>(d) Tractor-Trailer : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[d]" value="<?php echo $required_d;?>" placeholder="Existing Actually Required/Proposed number"></td>
										</tr>
										<tr>
											<td>(e) Dumper-placers : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[e]" value="<?php echo $required_e;?>" placeholder="Existing Actually Required/Proposed number"></td>
											<td>(f) Tricycle : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[f]" value="<?php echo $required_f;?>" placeholder="Existing Actually Required/Proposed number"></td>
										</tr>
										<tr>
											<td>(g) Refuse-collector : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[g]" value="<?php echo $required_g;?>" placeholder="Existing Actually Required/Proposed number"></td>
											<td>(h) Others (Please specify) : </td>
											<td><input type="text" class="form-control text-uppercase" name="required[h]" value="<?php echo $required_h;?>" placeholder="Existing Actually Required/Proposed number"></td>
										</tr>
										<tr>
											<td colspan="2">9. Whether any proposal has been made to improve Construction and Demolition waste management practices : </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="improve" value="Y"  <?php if(isset($improve) && ($improve=='Y' || $improve=='')) echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="improve" value="N" <?php if(isset($improve) && $improve=='N') echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="2">10. Have any efforts been made to involve PPP for processing of Construction & Demolition waste? </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" name="efforts" class="efforts" value="Y" <?php if(isset($efforts) && $efforts=='Y') echo 'checked'; ?> /> Yes </label>
												<label class="radio-inline"><input type="radio" class="efforts"  value="N"  name="efforts" <?php if(isset($efforts) && ($efforts=='N' || $efforts=='')) echo 'checked'; ?>/> No </label>
											</td>										
										</tr>	
										<tr>
											<td colspan="4">If yes, what is (are) the technologies being used, such as :</td>
										</tr>
										<tr>
											<td colspan="4">
												<table name="technologies" id="" class="table table-responsive table-bordered">
													<thead>
														<tr>
															<th>Processing / recycling Technology</th>
															<th>Quantity to be processed</th>
															<th>Steps taken</th>
														</tr>
													</thead>
													<tr>
														<td>Dry Process</td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[q1]" value="<?php echo $technologies_q1;?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[s1]" value="<?php echo $technologies_s1;?>"></td>
													</tr>
													<tr>
														<td>Wet Process</td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[q2]" value="<?php echo $technologies_q2;?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[s2]" value="<?php echo $technologies_s2;?>"></td>
													</tr>
													<tr>
														<td>Others, if any, Please specify</td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[q3]" value="<?php echo $technologies_q3;?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="technologies[s3]" value="<?php echo $technologies_s3;?>"></td>
													</tr>
												</table>
											</td>
										</tr>	
										<tr>
											<td colspan="4">11. What provisions are available to check unauthorized operations of? </td>
										</tr>
										<tr> 
											<td>Encroachment on river bank or wet bodies : </td>
											<td><input type="text" class="form-control text-uppercase" name="provisions[river]" value="<?php echo $provisions_river;?>"></td>
											<td>Unauthorized filling of low line areas : </td>
											<td><input type="text" class="form-control text-uppercase" name="provisions[low_line]" value="<?php echo $provisions_low_line;?>"></td>
										</tr>
										<tr>
											<td>Mixing with solid waste : </td>
											<td><input type="text" class="form-control text-uppercase" name="provisions[waste]" value="<?php echo $provisions_waste;?>"></td>
											<td>Encroachment in Parks, Footpaths etc. : </td>
											<td><input type="text" class="form-control text-uppercase" name="provisions[parks]" value="<?php echo $provisions_parks;?>"></td>
										</tr>
										<tr>
											<td>12. How many slums are provided with construction and demolition waste receptacles facilities? </td>
											<td><input type="text" class="form-control text-uppercase" name="slums" value="<?php echo $slums; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>13. Are municipal magistrates appointed for taking penal action for non-compliance with these rules? </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_action" class="is_action" value="Y" <?php if(isset($is_action) && $is_action=='Y') echo 'checked'; ?> /> Yes </label>
												<label class="radio-inline"><input type="radio" class="is_action"  value="N"  name="is_action" <?php if(isset($is_action) && ($is_action=='N' || $is_action=='')) echo 'checked'; ?>/> No </label>
											</td>
											<td>If yes, how many cases registered & settled during last three years (give year wise details) </td>	
											<td width="25%"><textarea name="is_action_details" class="form-control text-uppercase" id="is_action_details" validate="textarea" ><?php echo $is_action_details; ?></textarea></td>
										</tr>										
										<tr>
											<td colspan="2" align="left">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/> Place : <strong><?php echo $dist;?></strong></td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person)?></strong><br/>(Name : <strong><?php echo $key_person;?></strong>)<br/> (Designation : <strong><?php echo $status_applicant;?></strong>)</td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */	
	$('#is_practice_details').attr('disabled','disabled');
	<?php if($is_practice == 'Y') echo "$('#is_practice_details').removeAttr('disabled','disabled');"; ?>
	$('.is_practice').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_practice_details').removeAttr('disabled','disabled');
		}else{
			$('#is_practice_details').attr('disabled','disabled');
			$('#is_practice_details').val('');
		}			
	});
	/* ------------------------------------------------------ */
	$('#is_action_details').attr('readonly','readonly');
	<?php if($is_action == 'Y') echo "$('#is_action_details').removeAttr('readonly','readonly');"; ?>
	$('.is_action').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_action_details').removeAttr('readonly','readonly');
		}else{
			$('#is_action_details').attr('readonly','readonly');
			$('#is_action_details').val('');
		}			
	});
</script>