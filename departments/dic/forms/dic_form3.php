<?php  require_once "../../requires/login_session.php"; 
$dept="dic";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			############### part 1###########
			if(!empty($results["pmt"])){
				$pmt=json_decode($results["pmt"]);
				$pmt_ack_dt=$pmt->ack_dt;$pmt_ack_no=$pmt->ack_no;$pmt_reg_dt=$pmt->reg_dt;$pmt_reg_no=$pmt->reg_no;$pmt_lic_no=$pmt->lic_no;
			}else{
				$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
			}
			if(!empty($results["fixed_amount"])){
				$fixed_amount=json_decode($results["fixed_amount"]);
				
				$fixed_amount_land1=$fixed_amount->land1;$fixed_amount_land2=$fixed_amount->land2;
				$fixed_amount_sd1=$fixed_amount->sd1;$fixed_amount_sd2=$fixed_amount->sd2;
				$fixed_amount_fact1=$fixed_amount->fact1;$fixed_amount_fact2=$fixed_amount->fact2;
				$fixed_amount_ob1=$fixed_amount->ob1;$fixed_amount_ob2=$fixed_amount->ob2;
				$fixed_amount_ei1=$fixed_amount->ei1;$fixed_amount_ei2=$fixed_amount->ei2;
				$fixed_amount_items1=$fixed_amount->items1;$fixed_amount_items2=$fixed_amount->items2;
				$fixed_amount_exp1=$fixed_amount->exp1;$fixed_amount_exp2=$fixed_amount->exp2;
				$fixed_amount_mis1=$fixed_amount->mis1;$fixed_amount_mis2=$fixed_amount->mis2;
				
			}else{
				$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
				$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
				$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
				$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
				$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
				$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
				$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
				$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
				$fixed_amount_tot1="";
			}	
			############### End ###########
			############### part 2###########
				
			if(!empty($results["land"])){
				$land=json_decode($results["land"]);
				$land_allot=$land->allot;$land_area=$land->area;$land_rev=$land->rev;$land_dag=$land->dag;$land_patta=$land->patta;$land_dt_lease=$land->dt_lease;$land_dt_poss=$land->dt_poss;$land_dt_pur=$land->dt_pur;$land_dt_reg=$land->dt_reg;$land_period=$land->period;
			}else{
				$land_allot="";$land_area="";$land_rev="";$land_dag="";$land_patta="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";	
			}		
			if(!empty($results["building"])){
				$building=json_decode($results["building"]);
				$building_expan=$building->expan;$building_pro_built=$building->pro_built;$building_type=$building->type;
			}else{
				$building_expan="";$building_pro_built="";$building_type="";
			}			
			if(!empty($results["electricity"])){
				$electricity=json_decode($results["electricity"]);
				$electricity_connect=$electricity->connect;$electricity_pro_built=$electricity->pro_built;$electricity_sanc=$electricity->sanc;
			}else{
				$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
			}		
			if(!empty($results["proposed"])){
				$proposed=json_decode($results["proposed"]);
				$proposed_managerial1=$proposed->managerial1;$proposed_managerial2=$proposed->managerial2;$proposed_managerial3=$proposed->managerial3;
				$proposed_skilled1=$proposed->skilled1;$proposed_skilled2=$proposed->skilled2;$proposed_skilled3=$proposed->skilled3;
				$proposed_semi_skilled1=$proposed->semi_skilled1;$proposed_semi_skilled2=$proposed->semi_skilled2;$proposed_semi_skilled3=$proposed->semi_skilled3;
				
				$proposed_ss1=$proposed->ss1;$proposed_ss2=$proposed->ss2;$proposed_ss3=$proposed->ss3;
				
				$proposed_unskilled1=$proposed->unskilled1;$proposed_unskilled2=$proposed->unskilled2;$proposed_unskilled3=$proposed->unskilled3;
				
				$proposed_others1=$proposed->others1;$proposed_others2=$proposed->others2;$proposed_others3=$proposed->others3;
			}else{
				$proposed_managerial1="";$proposed_managerial2="";$proposed_managerial3="";$proposed_managerial_tot="";
				$proposed_skilled1="";$proposed_skilled2="";$proposed_skilled2="";$proposed_skilled3="";$proposed_skilled_tot="";
				$proposed_semi_skilled1="";$proposed_semi_skilled2="";$proposed_semi_skilled3="";$proposed_semi_skilled_tot="";
				$proposed_ss1="";$proposed_ss2="";$proposed_ss3="";$proposed_ss_tot="";
				$proposed_unskilled1="";$proposed_unskilled2="";$proposed_unskilled3="";$proposed_unskilled_tot="";
				$proposed_others1="";$proposed_others2="";$proposed_others3="";$proposed_others_tot="";
			}
		}else{
			$form_id="";
			############### part 1###########
			$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
			$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
			$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
			$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
			$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
			$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
			$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
			$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
			$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
			$fixed_amount_tot1="";$fixed_amount_tot2="";$fixed_amount_tot3="";
			############### End ###########
			############### part 2###########
			$land_allot="";$land_area="";$land_rev="";$land_dag="";$land_patta="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";
			$building_area="";$building_expan="";$building_pro_built="";$building_type="";
			$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
			$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
			$proposed_managerial1="";$proposed_managerial2="";$proposed_managerial3="";$proposed_managerial_tot="";
			$proposed_skilled1="";$proposed_skilled2="";$proposed_skilled2="";$proposed_skilled3="";$proposed_skilled_tot="";
			$proposed_semi_skilled1="";$proposed_semi_skilled2="";$proposed_semi_skilled3="";$proposed_semi_skilled_tot="";
			$proposed_ss1="";$proposed_ss2="";$proposed_ss3="";$proposed_ss_tot="";
			$proposed_unskilled1="";$proposed_unskilled2="";$proposed_unskilled3="";$proposed_unskilled_tot="";
			$proposed_others1="";$proposed_others2="";$proposed_others3="";$proposed_others_tot="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		############### part 1###########
		if(!empty($results["pmt"])){
			$pmt=json_decode($results["pmt"]);
			$pmt_ack_dt=$pmt->ack_dt;$pmt_ack_no=$pmt->ack_no;$pmt_reg_dt=$pmt->reg_dt;$pmt_reg_no=$pmt->reg_no;$pmt_lic_no=$pmt->lic_no;
		}else{
			$pmt_ack_dt="";$pmt_ack_no="";$pmt_lic_no="";$pmt_reg_dt="";$pmt_reg_no="";
		}
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			
			$fixed_amount_land1=$fixed_amount->land1;$fixed_amount_land2=$fixed_amount->land2;
			$fixed_amount_sd1=$fixed_amount->sd1;$fixed_amount_sd2=$fixed_amount->sd2;
			$fixed_amount_fact1=$fixed_amount->fact1;$fixed_amount_fact2=$fixed_amount->fact2;
			$fixed_amount_ob1=$fixed_amount->ob1;$fixed_amount_ob2=$fixed_amount->ob2;
			$fixed_amount_ei1=$fixed_amount->ei1;$fixed_amount_ei2=$fixed_amount->ei2;
			$fixed_amount_items1=$fixed_amount->items1;$fixed_amount_items2=$fixed_amount->items2;
			$fixed_amount_exp1=$fixed_amount->exp1;$fixed_amount_exp2=$fixed_amount->exp2;
			$fixed_amount_mis1=$fixed_amount->mis1;$fixed_amount_mis2=$fixed_amount->mis2;
			
		}else{
			$fixed_amount_land1="";$fixed_amount_land2="";$fixed_amount_land3="";
			$fixed_amount_sd1="";$fixed_amount_sd2="";$fixed_amount_sd3="";
			$fixed_amount_fact1="";$fixed_amount_fact2="";$fixed_amount_fact3="";
			$fixed_amount_ob1="";$fixed_amount_ob2="";$fixed_amount_ob3="";
			$fixed_amount_items1="";$fixed_amount_items2="";$fixed_amount_items3="";
			$fixed_amount_ei1="";$fixed_amount_ei2="";$fixed_amount_ei3="";
			$fixed_amount_exp1="";$fixed_amount_exp2="";$fixed_amount_exp3="";
			$fixed_amount_mis1="";$fixed_amount_mis2="";$fixed_amount_mis3="";
			$fixed_amount_tot1="";
		}	
		############### End ###########
		############### part 2###########
			
		if(!empty($results["land"])){
			$land=json_decode($results["land"]);
			$land_allot=$land->allot;$land_area=$land->area;$land_rev=$land->rev;$land_dag=$land->dag;$land_patta=$land->patta;$land_dt_lease=$land->dt_lease;$land_dt_poss=$land->dt_poss;$land_dt_pur=$land->dt_pur;$land_dt_reg=$land->dt_reg;$land_period=$land->period;
		}else{
			$land_allot="";$land_area="";$land_rev="";$land_dag="";$land_patta="";$land_dt_lease="";$land_dt_poss="";$land_dt_pur="";$land_dt_reg=""; $land_period="";	
		}		
		if(!empty($results["building"])){
			$building=json_decode($results["building"]);
			$building_expan=$building->expan;$building_pro_built=$building->pro_built;$building_type=$building->type;
		}else{
			$building_expan="";$building_pro_built="";$building_type="";
		}			
		if(!empty($results["electricity"])){
			$electricity=json_decode($results["electricity"]);
			$electricity_connect=$electricity->connect;$electricity_pro_built=$electricity->pro_built;$electricity_sanc=$electricity->sanc;
		}else{
			$electricity_connect="";$electricity_pro_built="";$electricity_sanc="";
		}		
		if(!empty($results["proposed"])){
			$proposed=json_decode($results["proposed"]);
			$proposed_managerial1=$proposed->managerial1;$proposed_managerial2=$proposed->managerial2;$proposed_managerial3=$proposed->managerial3;
			$proposed_skilled1=$proposed->skilled1;$proposed_skilled2=$proposed->skilled2;$proposed_skilled3=$proposed->skilled3;
			$proposed_semi_skilled1=$proposed->semi_skilled1;$proposed_semi_skilled2=$proposed->semi_skilled2;$proposed_semi_skilled3=$proposed->semi_skilled3;
			
			$proposed_ss1=$proposed->ss1;$proposed_ss2=$proposed->ss2;$proposed_ss3=$proposed->ss3;
			
			$proposed_unskilled1=$proposed->unskilled1;$proposed_unskilled2=$proposed->unskilled2;$proposed_unskilled3=$proposed->unskilled3;
			
			$proposed_others1=$proposed->others1;$proposed_others2=$proposed->others2;$proposed_others3=$proposed->others3;
		}else{
			$proposed_managerial1="";$proposed_managerial2="";$proposed_managerial3="";$proposed_managerial_tot="";
			$proposed_skilled1="";$proposed_skilled2="";$proposed_skilled2="";$proposed_skilled3="";$proposed_skilled_tot="";
			$proposed_semi_skilled1="";$proposed_semi_skilled2="";$proposed_semi_skilled3="";$proposed_semi_skilled_tot="";
			$proposed_ss1="";$proposed_ss2="";$proposed_ss3="";$proposed_ss_tot="";
			$proposed_unskilled1="";$proposed_unskilled2="";$proposed_unskilled3="";$proposed_unskilled_tot="";
			$proposed_others1="";$proposed_others2="";$proposed_others3="";$proposed_others_tot="";
		}
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
	}
	##PHP TAB management ends
	
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
	  <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							<div class="panel-body">
							    <ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">									
									<tr>
									    <td >1. (a) Name of the Industrial unit :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4"> (b) Complete address with telephone No. :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Block</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>				
									</tr>
									<tr>
										<td width="25%">2. (a) Constitution of the unit</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
										<td width="25%">&nbsp;</td>
										<td width="25%">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">(b) Name(s), address(es), of the Proprietor / Partners / Directors of Board of Directors / Secretary and  President of the Cooperative Society : </td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%" >Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase"  value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase"  value="" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" validate="letters" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text"  name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text"  name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
									<tr>
										<td>3. Proposed date of commencement of commercial  production of unit after expansion :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>"></td>
										<td>4. Whether the industrial unit falls under Manufacturing sector OR Service sector :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $business_type; ?>"></td>
									</tr>	
									<tr>
										<td colspan="4">5. Details of Registration with the concerned Department :</td>
									<tr>
									<tr>
										<td colspan="4">(A). If Manufacturing Sector, please indicate :</td>
									<tr>
									<tr>
										<td colspan="4">(i) PMT registration no with Date/Acknowledge No./Date of Entrepreneur Memorandum(EM) Part-1 / Part-2 (if any) of MSME:</td>
									</tr>
									<tr>
										<td>Registration No.-</td>
										<td><input type="text" class="form-control text-uppercase"  name="pmt[reg_no]" value="<?php echo $pmt_reg_no;?>"></td>
										<td>Registration Date-</td>
										<td><input type="text" class="dobindia form-control text-uppercase"  name="pmt[reg_dt]" value="<?php if($pmt_reg_dt!="0000-00-00" && $pmt_reg_dt!="") echo date("d-m-Y",strtotime($pmt_reg_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									<tr>
										<td colspan="4">  (ii) Acknowledgement No. / Date of Entrepreneur Memorandum (EM) (if any) of DIPP :</td>
									</tr>
										<td>Registration No.-</td>
										<td><input type="text" class="form-control text-uppercase" name="pmt[ack_no]" value="<?php echo $pmt_ack_no;?>"></td>
										<td>Registration Date-</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="pmt[ack_dt]" value="<?php if($pmt_ack_dt!="0000-00-00" && $pmt_ack_dt!="") echo date("d-m-Y",strtotime($pmt_ack_dt)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>	
									<tr>
										<td colspan="3">(B) If Service Sector, please indicate requisite  Registration / License No. from the concerned Department (if any)  : </td>
										<td><input type="text" class="form-control text-uppercase" name="pmt[lic_no]" value="<?php echo $pmt_lic_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">6. Particulars / Details of Fixed Capital Investment (in rupees) : 
										<table class="table table-responsive table-bordered">
											<tr>
												<th>Sl no.</th>
												<th>Particulars</th>
												<th>Existing Investment</th>
												<th>Additional Investment proposed for expansion</th>
												<th>Total</th>
											</tr>
											<tr>
												<td>a</td>
												<td>Land</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(1)" id="fixedCapital1a" name="fixed_amount[land1]" value="<?php echo $fixed_amount_land1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(1)" id="fixedCapital1b"  name="fixed_amount[land2]" value="<?php echo $fixed_amount_land2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum1" name="fixed_amount[land3]" disabled="disabled" value="<?php echo $fixed_amount_land3=((int)$fixed_amount_land1+(int)$fixed_amount_land2);?>"></td>
											</tr>
											<tr>
												<td>b</td>
												<td>Site Development</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(2)" id="fixedCapital2a"  name="fixed_amount[sd1]" value="<?php echo $fixed_amount_sd1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(2)" id="fixedCapital2b"  name="fixed_amount[sd2]" value="<?php echo $fixed_amount_sd2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum2" name="fixed_amount[sd3]" disabled="disabled" value="<?php echo $fixed_amount_sd3=((int)$fixed_amount_sd1+(int)$fixed_amount_sd2);?>"></td>
											</tr>
											<tr>
												<td>c</td>
												<td colspan="3">Building</td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>(i) Factory</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(3)" id="fixedCapital3a"  name="fixed_amount[fact1]" value="<?php echo $fixed_amount_fact1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(3)" id="fixedCapital3b"  name="fixed_amount[fact2]" value="<?php echo $fixed_amount_fact2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum3" name="fixed_amount[fact3]" disabled="disabled" value="<?php echo $fixed_amount_fact3=((int)$fixed_amount_fact1+(int)$fixed_amount_fact2);?>"></td>
											</tr>
											<tr>
												<td>&nbsp;</td>
												<td>(ii) Office Building</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(4)" id="fixedCapital4a"  name="fixed_amount[ob1]" value="<?php echo $fixed_amount_ob1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(4)" id="fixedCapital4b"  name="fixed_amount[ob2]" value="<?php echo $fixed_amount_ob2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum4" name="fixed_amount[ob3]" disabled="disabled" value="<?php echo $fixed_amount_ob3=((int)$fixed_amount_ob1+(int)$fixed_amount_ob2);?>"></td>
											</tr>
											<tr>
												<td>d</td>
												<td>Plant and Machinery/ Component items</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(5)" id="fixedCapital5a"  name="fixed_amount[items1]" value="<?php echo $fixed_amount_items1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(5)" id="fixedCapital5b"  name="fixed_amount[items2]" value="<?php echo $fixed_amount_items2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum5" name="fixed_amount[items3]" disabled="disabled" value="<?php echo $fixed_amount_items3=((int)$fixed_amount_items1+(int)$fixed_amount_items2);?>"></td>
											</tr>
											<tr>
												<td>e</td>
												<td>Electrical Installation</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(6)" id="fixedCapital6a"  name="fixed_amount[ei1]" value="<?php echo $fixed_amount_ei1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(6)" id="fixedCapital6b"  name="fixed_amount[ei2]" value="<?php echo $fixed_amount_ei2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum6" name="fixed_amount[ei3]"  disabled="disabled" value="<?php echo $fixed_amount_ei3=((int)$fixed_amount_ei1+(int)$fixed_amount_ei2);?>"></td>
											</tr>
											<tr>
												<td>f</td>
												<td>Preliminary & Preoperative expenses</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(7)" id="fixedCapital7a"  name="fixed_amount[exp1]" value="<?php echo $fixed_amount_exp1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(7)" id="fixedCapital7b"  name="fixed_amount[exp2]" value="<?php echo $fixed_amount_exp2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum7" name="fixed_amount[exp3]"  disabled="disabled" value="<?php echo $fixed_amount_exp3=((int)$fixed_amount_exp1+(int)$fixed_amount_exp2);?>"></td>
											</tr>
											<tr>
												<td>g</td>
												<td>Miscellaneous fixed assets</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitala" onchange="addCapital(8)" id="fixedCapital8a"  name="fixed_amount[mis1]" value="<?php echo $fixed_amount_mis1;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalb" onchange="addCapital(8)" id="fixedCapital8b"  name="fixed_amount[mis2]" value="<?php echo $fixed_amount_mis2;?>" validate="onlyNumbers"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSum" id="fixedCapitalSum8" name="fixed_amount[mis3]" disabled="disabled"  value="<?php echo $fixed_amount_mis3=((int)$fixed_amount_mis1+(int)$fixed_amount_mis2);?>"></td>
											</tr>
											<tr>
												<td></td>
												<td>Total</td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalaTotal" onchange="addCapital(9)" id="fixedCapital9a" name="fixed_amount[tot1]" disabled="disabled" value="<?php echo $fixed_amount_tot1=((int)$fixed_amount_land1+(int)$fixed_amount_sd1+(int)$fixed_amount_fact1+(int)$fixed_amount_ob1+(int)$fixed_amount_items1+(int)$fixed_amount_ei1+(int)$fixed_amount_exp1+(int)$fixed_amount_mis1); ?>"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalbTotal" onchange="addCapital(9)" id="fixedCapital9b" name="fixed_amount[tot2]" disabled="disabled" value="<?php echo $fixed_amount_tot2=((int)$fixed_amount_land2+(int)$fixed_amount_sd2+(int)$fixed_amount_fact2+(int)$fixed_amount_ob2+(int)$fixed_amount_items2+(int)$fixed_amount_ei2+(int)$fixed_amount_exp2+(int)$fixed_amount_mis2); ?>"></td>
												<td><input  type="text" class="form-control text-uppercase fixedCapitalSumTotal" id="fixedCapitalSum9" name="fixed_amount[tot3]" disabled="disabled" value="<?php echo $fixed_amount_tot3=((int)$fixed_amount_tot1+(int)$fixed_amount_tot2); ?>"></td>
											</tr>
										</table></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="fileUpload" class="submit1" id="myform1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">		
									<tr>
										<td colspan="4">7. Details of Land and Building :</td>
									</tr>
									<tr>
										<td colspan="4">A. Land:</td>
									</tr>
									<tr>
										<td colspan="4">a) Own Land </td>
									</tr>
									<tr>
										<td width="25%">(i) Land area</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase"  name="land[area]" value="<?php echo $land_area;?>"></td>
										<td width="25%">Revenue village</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase"  name="land[rev]" value="<?php echo $land_rev;?>"></td>
									</tr>
									<tr>
										<td width="25%">Dag No.</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase"  name="land[dag]" value="<?php echo $land_dag;?>"></td>
										<td width="25%">Patta No.</td>
										<td width="25%"><input  type="text" class="form-control text-uppercase"  name="land[patta]" value="<?php echo $land_patta;?>"></td>
									</tr>
									<tr>
										<td width="25%">(ii) Date of Purchase</td>
										<td width="25%"><input  type="text" class=" dobindia form-control text-uppercase"  name="land[dt_pur]" value="<?php if($land_dt_pur!="0000-00-00" && $land_dt_pur!="") echo date("d-m-Y",strtotime($land_dt_pur)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>(iii) Date of Registration</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="land[dt_reg]" value="<?php if($land_dt_reg!="0000-00-00" && $land_dt_reg!="") echo date("d-m-Y",strtotime($land_dt_reg)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">b) Land Alloted by Government / Government Agency  </td>
									</tr>
									<tr>
										<td>(i) Date of allotment / agreement with area of land :</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="land[allot]" value="<?php if($land_allot!="0000-00-00" && $land_allot!="") echo date("d-m-Y",strtotime($land_allot)); else echo "";?>" placeholder="DD-MM-YYYY"  readonly="readonly"></td>
										<td>(ii) Date of taking over possession:</td>
										<td><input  type="text" class="dobindia form-control text-uppercase"  name="land[dt_poss]" value="<?php if($land_dt_poss!="0000-00-00" && $land_dt_poss!="") echo date("d-m-Y",strtotime($land_dt_poss)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">c) Lease hold land  </td>
									</tr>
									<tr>
										<td>(i) Date of Registration of lease deed :</td>
										<td><input type="text" class="dobindia form-control text-uppercase" name="land[dt_lease]" value="<?php if($land_dt_lease!="0000-00-00" && $land_dt_lease!="") echo date("d-m-Y",strtotime($land_dt_lease)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td>(ii) Period of lease  :</td>
										<td><input type="text" class=" form-control text-uppercase" name="land[period]" value="<?php echo $land_period;?>"></td>
									</tr>
									
									<tr>
										<td colspan="4">B. Building</td>
									</tr>
									<tr>
										<td>a) Building Type :<span class="mandatory_field">*</span> </td>
										<td><select required class="form-control text-uppercase" name="building[type]">
											<option value="" >Select</option>
											<option value="R" <?php if($building_type=="R") echo "selected";?> >Rented</option>
											<option value="O" <?php if($building_type=="O") echo "selected";?>>Owned</option>
										</select></td>
										<td></td>
										<td></td>
									</tr>
									<tr> 
										<td colspan="4">b) In case of own building :</td>
									</tr>
									<tr>
										<td>(i)Build up area prior to expansion:</td>
										<td><input  type="text" class="form-control text-uppercase"  name="building[expan]" value="<?php echo $building_expan;?>"></td>
										<td>(ii) Proposed built up area after expansion :</td>
										<td><input  type="text" class=" form-control text-uppercase"  name="building[pro_built]" value="<?php echo $building_pro_built;?>"></td>
									</tr>
									<tr>
										<td colspan="4">8. Details of electricity utilization :</td>
									</tr>
									<tr>
										<td>(i) Sanctioned load prior to expansion :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[sanc]" value="<?php echo $electricity_sanc;?>"></td>
										<td>(ii) Connected load prior to expansion :</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[connect]" value="<?php echo $electricity_connect;?>"></td>
									</tr>
									<tr>
										<td colspan="3">(iii) Whether requirement of additional load is essential for expansion. If so, the quantum of additional load required/applied for.</td>
										<td><input  type="text" class="form-control text-uppercase"  name="electricity[pro_built]" value="<?php echo $electricity_pro_built;?>"></td>
									</tr>
									<tr>
										<td colspan="4">9. Production Capacity : 
										<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl No</th>
											<th rowspan="2" width="15%">Name of the Product(s)/Service rendered</th>
											<th colspan="2" width="40">Annual installed capacity prior to expansion</th>
											<th colspan="2" width="40">Proposed annual installed capacity after expansion</th>
										</tr>
										<tr>
										   <th>Quantity</th>
										   <th>Value in Rupees</th>
										   <th>Quantity</th>
										   <th>Value in Rupees</th>
										</tr>
										</thead>
									   <?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["quantity1"]; ?>" validate="onlyNumbers" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_1["rupees1"]; ?>" validate="onlyNumbers" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtD<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_1["quantity2"]; ?>" validate="onlyNumbers" id="txtE<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtE<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_1["rupees2"]; ?>" validate="onlyNumbers" id="txtF<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtF<?php echo $count;?>"></td>				
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
											<td><input id="txtB1" size="20"   class="form-control text-uppercase" name="txtB1"></td>					
											<td><input  id="txtC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txtC1"></td>
											<td><input id="txtD1" size="20"  validate="onlyNumbers" class="form-control text-uppercase" name="txtD1"></td>			
											<td><input id="txtE1" size="20"   validate="onlyNumbers" class="form-control text-uppercase" name="txtE1"></td>			
											<td><input id="txtF1" size="20"   validate="onlyNumbers" class="form-control text-uppercase" name="txtF1"></td>			
										</tr>
										<?php } ?>
										</table>
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
									</td>
								</tr>								
								<tr>
									<td colspan="4">10.
									<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center">
										<thead>
										<tr>
											<th rowspan="2" width="5%">Sl No</th>
											<th rowspan="2" width="15%">Raw Materials</th>
											<th colspan="2" width="40%">Annual requirement prior to expansion</th>
											<th colspan="2" width="40%">Proposed annual requiremen after expansion</th>
										</tr>
										<tr>
										   <th>Quantity</th>
										   <th>Value in Rupees</th>
										   <th>Quantity</th>
										   <th>Value in Rupees</th>
										</tr>
										</thead>
									   <?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num2 = $part2->num_rows;
										if($num2>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["name"]; ?>" id="textB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["quantity1"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_2["rupees1"]; ?>" validate="onlyNumbers" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_2["quantity2"]; ?>" validate="onlyNumbers" id="textE<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textE<?php echo $count;?>"></td>				
											<td><input value="<?php echo $row_2["rupees2"]; ?>" validate="onlyNumbers" id="textF<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textF<?php echo $count;?>"></td>				
										</tr>	
										<?php $count++; } 
										}else{	?>
										<tr>
											<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input id="textB1" size="20"   class="form-control text-uppercase" name="textB1"></td>					
											<td><input  id="textC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="textC1"></td>
											<td><input id="textD1" size="20"  validate="onlyNumbers" class="form-control text-uppercase" name="textD1"></td>			
											<td><input id="textE1" size="20"   validate="onlyNumbers" class="form-control text-uppercase" name="textE1"></td>			
											<td><input id="textF1" size="20"  validate="onlyNumbers" class="form-control text-uppercase" name="textF1"></td>			
										</tr>
										<?php } ?>
										</table>
									
										<div><button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td colspan="4">11. Proposed Employment Generation in the unit in various fields of work :
									<table class="table table-responsive table-bordered">	
									<thead>
									<tr>
										<th width="20%" align="center">Sl no  </th>
										<th width="20%" align="center">Employment Generation in the unit in various fields of work</th>
										<th width="20%" align="center">Prior to expansion</th>
										<th width="20%" align="center">Proposed additional employment for expansion</th>
										<th width="20%" align="center">Total</th>
									</tr>
									</thead>
									<tr>
										<td>(a) Managerial :   </td>
										<td><input  type="text" class="form-control text-uppercase employGen1"  name="proposed[managerial1]" onchange="femployGen(1)" value="<?php echo $proposed_managerial1;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen1"  name="proposed[managerial2]" onchange="femployGen(1)" value="<?php echo $proposed_managerial2;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen1"  name="proposed[managerial3]" onchange="femployGen(1)" value="<?php echo $proposed_managerial3;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal1" disabled="disabled" value="<?php echo $proposed_managerial_tot=((int)$proposed_managerial1+(int)$proposed_managerial2+(int)$proposed_managerial3);?>"></td>
									</tr>
									<tr>
										<td>(b) Supervisory Staff :</td>
										<td><input  type="text" class="form-control text-uppercase employGen2"  name="proposed[ss1]" onchange="femployGen(2)" value="<?php echo $proposed_ss1;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen2"  name="proposed[ss2]" onchange="femployGen(2)" value="<?php echo $proposed_ss2;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen2"  name="proposed[ss3]" onchange="femployGen(2)" value="<?php echo $proposed_ss3;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal2" disabled="disabled" value="<?php echo $proposed_ss_tot=((int)$proposed_ss1+(int)$proposed_ss2+(int)$proposed_ss3);?>"></td>
									</tr>
									<tr>									
										<td>(c) Skilled Worker :   </td>
										<td><input  type="text" class="form-control text-uppercase employGen3"  name="proposed[skilled1]" onchange="femployGen(3)" value="<?php echo $proposed_skilled1;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen3"  name="proposed[skilled2]" onchange="femployGen(3)" value="<?php echo $proposed_skilled2;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen3"  name="proposed[skilled3]" onchange="femployGen(3)" value="<?php echo $proposed_skilled3;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal3" disabled="disabled" value="<?php echo $proposed_skilled_tot=((int)$proposed_skilled1+(int)$proposed_skilled2+(int)$proposed_skilled3);?>"></td>
									</tr>
									<tr>
										<td> (d) Semi Skilled Worker :</td>
										<td><input  type="text" class="form-control text-uppercase employGen4" name="proposed[semi_skilled1]" onchange="femployGen(4)" value="<?php echo $proposed_semi_skilled1;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen4" name="proposed[semi_skilled2]" onchange="femployGen(4)" value="<?php echo $proposed_semi_skilled2;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen4" name="proposed[semi_skilled3]" onchange="femployGen(4)" value="<?php echo $proposed_semi_skilled3;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal4" disabled="disabled" value="<?php echo $proposed_semi_skilled_tot=((int)$proposed_semi_skilled1+(int)$proposed_semi_skilled2+(int)$proposed_semi_skilled3);?>"></td>
									</tr>								
									<tr>
										<td>(e) Unskilled Worker :   </td>
										<td><input  type="text" class="form-control text-uppercase employGen5"  name="proposed[unskilled1]" onchange="femployGen(5)" value="<?php echo $proposed_unskilled1;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen5"  name="proposed[unskilled2]" onchange="femployGen(5)" value="<?php echo $proposed_unskilled2;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen5"  name="proposed[unskilled3]" onchange="femployGen(5)" value="<?php echo $proposed_unskilled3;?>" validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal5" disabled="disabled" value="<?php echo $proposed_unskilled_tot=((int)$proposed_unskilled1+(int)$proposed_unskilled2+(int)$proposed_unskilled3);?>"></td>
									</tr>								
									<tr>
										<td>(f) Others :</td>
										<td><input  type="text" class="form-control text-uppercase employGen6"  name="proposed[others1]" onchange="femployGen(6)" value="<?php echo $proposed_others1;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen6"  name="proposed[others2]" onchange="femployGen(6)" value="<?php echo $proposed_others2;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase employGen6"  name="proposed[others3]" onchange="femployGen(6)" value="<?php echo $proposed_others3;?>"validate="onlyNumbers"></td>
										<td><input  type="text" class="form-control text-uppercase" id="employGenTotal6" disabled="disabled" value="<?php echo $proposed_others_tot=((int)$proposed_others1+(int)$proposed_others2+(int)$proposed_others3);?>"></td>
									</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td >Place : <label class="text-uppercase"><?php echo strtoupper($dist);?></label> <br/> Date : <b><?php echo date('d-m-Y',strtotime($today));?></b></td>
									<td></td>
									<td></td>
									<td align="right"><strong><?php echo strtoupper($key_person)?></strong><br/>Name of the Applicant(s)</td>
								</tr>																					
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
		</div>
		</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	function addCapital(num){
		var sum1=0,sum2=0,sum3=0,sum4=0,fixedCapitala1,fixedCapitalb1;
		if(!isNaN(parseInt($('#fixedCapital'+num+'a').val()))) fixedCapitala1=parseInt($('#fixedCapital'+num+'a').val()); else  fixedCapitala1=0;
		if(!isNaN(parseInt($('#fixedCapital'+num+'b').val()))) fixedCapitalb1=parseInt($('#fixedCapital'+num+'b').val()); else  fixedCapitalb1=0;
		sum1=sum1+fixedCapitala1+fixedCapitalb1;
		
		
		$('#fixedCapitalSum'+num+'').val(sum1);
		
		$('.fixedCapitala').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum2 = sum2 + parseInt($(this).val());
			}
			$('.fixedCapitalaTotal').val(sum2);
		});
		$('.fixedCapitalb').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum3 = sum3 + parseInt($(this).val());
			}
			$('.fixedCapitalbTotal').val(sum3);
		});
		
		$('.fixedCapitalSum').each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum4 = sum4 + parseInt($(this).val());
			}
			$('.fixedCapitalSumTotal').val(sum4);
		});
	}
	function femployGen(num){
		var sum1=0;
		$('.employGen'+num).each(function(){			
			if(!isNaN(parseInt($(this).val()))){
				sum1 = sum1 + parseInt($(this).val());
			}
			$('#employGenTotal'+num).val(sum1);
		});		
	}
	
	/* ----------------------------------------------------- */

</script>