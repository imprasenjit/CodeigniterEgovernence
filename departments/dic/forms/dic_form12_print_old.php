<?php
$dept="dic";
$form="12";
$table_name=$formFunctions->getTableName($dept,$form);

	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($dic->error);
	}
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$l_o_business=$row1['Type_of_ownership'];$Name_of_owner=$row1['Name_of_owner'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
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
	}else if($l_o_business=="PR"){
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}else{
		$l_o_business_val="";$l_o_business_name="";
	}
	$q=$dic->query("select * from ".$table_name." where  user_id='$swr_id' and active='1'") or die($dic->error);
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		#### PART I #####
		$substantial_exp=$results['substantial_exp'];$office_mob=$results['office_mob'];$act_reg_date=$results['act_reg_date'];	$nature=$results['nature'];	$new_units_dt=$results['new_units_dt'];	$existing_units_dt=$results['existing_units_dt'];	
		if(!empty($results["man_units"])){
			$man_units=json_decode($results["man_units"]);
			$man_units_date_bf_exp1=$man_units->date_bf_exp1;$man_units_date_af_exp1=$man_units->date_af_exp1;
		}else{
			$man_units_date_bf_exp1="";$man_units_date_af_exp1="";
		}
		if(!empty($results["ser_sector"])){
			$ser_sector=json_decode($results["ser_sector"]);
			$ser_sector_date_bf_exp2=$ser_sector->date_bf_exp2;$ser_sector_date_af_exp2=$ser_sector->date_af_exp2;
		}else{
			$ser_sector_date_bf_exp2="";$ser_sector_date_af_exp2="";
		}
		#### PART II #####	
		$bnk_ac_no=$results['bnk_ac_no'];$acc_type=$results['acc_type'];$bnk_name=$results['bnk_name'];	$bnk_branch=$results['bnk_branch'];	
		
		if(!empty($results["em_part1"])){
			$em_part1=json_decode($results["em_part1"]);
			$em_part1_ack1=$em_part1->ack1;$em_part1_dt1=$em_part1->dt1;
		}else{
			$em_part1_ack1="";$em_part1_dt1="";
		}
		
		if(!empty($results["em_part2"])){
			$em_part2=json_decode($results["em_part2"]);
			$em_part2_ack2=$em_part2->ack2;$em_part2_dt2=$em_part2->dt2;
		}else{
			$em_part2_ack2="";$em_part2_dt2="";
		}
		if(!empty($results["elig_cert"])){
			$elig_cert=json_decode($results["elig_cert"]);
			$elig_cert_ack3=$elig_cert->ack3;$elig_cert_dt3=$elig_cert->dt3;
		}else{
			$elig_cert_ack3="";$elig_cert_dt3="";
		}
		if(!empty($results["gstn"])){
			$gstn=json_decode($results["gstn"]);
			$gstn_ack4=$gstn->ack4;$gstn_dt4=$gstn->dt4;
		}else{
			$gstn_ack4="";$gstn_dt4="";
		}
		if(!empty($results["pan"])){
			$pan=json_decode($results["pan"]);
			$pan_ack5=$pan->ack5;$pan_dt5=$pan->dt5;
		}else{
			$pan_ack5="";$pan_dt5="";
		}
		
		$period_of_claim_from=$results['period_of_claim_from'];$period_of_claim_to=$results['period_of_claim_to'];$period_of_power_subsidy_from=$results['period_of_power_subsidy_from'];$period_of_power_subsidy_to=$results['period_of_power_subsidy_to'];	
		
		if(!empty($results["tot_elec"])){
			$tot_elec=json_decode($results["tot_elec"]);
			$tot_elec_sanction1=$tot_elec->sanction1;$tot_elec_e_date=$tot_elec->e_date;
		}else{
			$tot_elec_sanction1="";$tot_elec_e_date="";
		}
		
		$tot_load_KVA1=$results['tot_load_KVA1'];$sl_no_energy_met=$results['sl_no_energy_met'];$ini_energy_meter=$results['ini_energy_meter'];
		#### PART III #####	
		
		if(!empty($results["existing_sanction"])){
			$existing_sanction=json_decode($results["existing_sanction"]);
			$existing_sanction_ad_elec=$existing_sanction->ad_elec;$existing_sanction_ad_elect_dt=$existing_sanction->ad_elect_dt;
		}else{
			$existing_sanction_ad_elec="";$existing_sanction_ad_elect_dt="";
		}
		
		$existing_elec_load=$results['existing_elec_load'];$tot_elec_load_con=$results['tot_elec_load_con'];$sl_no_energy_met_all=$results['sl_no_energy_met_all'];$ini_meter_reading=$results['ini_meter_reading'];$last_meter_reading=$results['last_meter_reading'];$mon_elec_consump=$results['mon_elec_consump'];$per_increase_fix_cap=$results['per_increase_fix_cap'];
		$ins_name=$results['ins_name'];
		
		if(!empty($results["ins"])){
			$ins=json_decode($results["ins"]);
			$ins_sn1=$ins->sn1;$ins_sn2=$ins->sn2;$ins_town=$ins->town;$ins_dist=$ins->dist;$ins_pincode=$ins->pincode;$ins_mobile=$ins->mobile;
		}else{
			$ins_sn1="";$ins_sn2="";$ins_town="";$ins_dist="";$ins_pincode="";$ins_mobile="";
		}
		
		$comm_dt_first_fire=$results['comm_dt_first_fire'];
		
		if(!empty($results["period_of_ins"])){
			$period_of_ins=json_decode($results["period_of_ins"]);
			$period_of_ins_p_from=$period_of_ins->p_from;$period_of_ins_p_to=$period_of_ins->p_to;
		}else{
			$period_of_ins_p_from="";$period_of_ins_p_to="";
		}
		$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];$tot_sum_ins1=$results['tot_sum_ins1'];	
			
		##### PART IV #####
		
		$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];$work_capital_limit=$results['work_capital_limit'];$sanction_number=$results['sanction_number'];$sanction_dt2=$results['sanction_dt2'];$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];	
		
		##### PART V #####
		if(!empty($results["capital_investment"])){
			$capital_investment=json_decode($results["capital_investment"]);
			
			$capital_investment_land1=$capital_investment->land1;$capital_investment_land2=$capital_investment->land2;$capital_investment_land3=$capital_investment->land3;
			
			$capital_investment_sd1=$capital_investment->sd1;$capital_investment_sd2=$capital_investment->sd2;$capital_investment_sd3=$capital_investment->sd3;
			
			$capital_investment_fact1=$capital_investment->fact1;$capital_investment_fact2=$capital_investment->fact2;$capital_investment_fact3=$capital_investment->fact3;
			
			$capital_investment_ob1=$capital_investment->ob1;$capital_investment_ob2=$capital_investment->ob2;$capital_investment_ob3=$capital_investment->ob3;
			
			$capital_investment_items1=$capital_investment->items1;$capital_investment_items2=$capital_investment->items2;$capital_investment_items3=$capital_investment->items3;
			
			$capital_investment_ei1=$capital_investment->ei1;$capital_investment_ei2=$capital_investment->ei2;$capital_investment_ei3=$capital_investment->ei3;
			
			$capital_investment_exp1=$capital_investment->exp1;$capital_investment_exp2=$capital_investment->exp2;$capital_investment_exp3=$capital_investment->exp3;
			
		}else{
			$capital_investment_land1="";$capital_investment_land2="";$capital_investment_land3="";
			$capital_investment_sd1="";$capital_investment_sd2="";$capital_investment_sd3="";
			$capital_investment_fact1="";$capital_investment_fact2="";$capital_investment_fact3="";
			$capital_investment_ob1="";$capital_investment_ob2="";$capital_investment_ob3="";
			$capital_investment_items1="";$capital_investment_items2="";$capital_investment_items3="";
			$capital_investment_ei1="";$capital_investment_ei2="";$capital_investment_ei3="";
			$capital_investment_exp1="";$capital_investment_exp2="";$capital_investment_exp3="";
			$capital_investment_tot1="";$capital_investment_tot2="";$capital_investment_tot3="";
		}
		$source_of_fin1=$results['source_of_fin1'];$source_of_fin2=$results['source_of_fin2'];$source_of_fin3=$results['source_of_fin3'];$source_of_fin4=$results['source_of_fin4'];$source_of_fin5=$results['source_of_fin5'];$source_of_fin6=$results['source_of_fin6'];	
		
	
		$capital_investment_tot1=$capital_investment_land1+$capital_investment_sd1+$capital_investment_fact1+$capital_investment_ob1+$capital_investment_items1+$capital_investment_ei1+$capital_investment_exp1;
	
		$capital_investment_tot2=$capital_investment_land2+$capital_investment_sd2+$capital_investment_fact2+$capital_investment_ob2+$capital_investment_items2+$capital_investment_ei2+$capital_investment_exp2;
		
		$capital_investment_tot3=$capital_investment_land3+$capital_investment_sd3+$capital_investment_fact3+$capital_investment_ob3+$capital_investment_items3+$capital_investment_ei3+$capital_investment_exp3;
		
		##### PART VI #####
	
		if($is_cert_policy=="Y"){
			$is_cert_policy="Yes";
		}else{
			$is_cert_policy="No";
		}
		
		if($nature=="M"){
			$nature="Manufacturing";
		}else if($nature=="S"){
			$nature="Service Sector";
		}
		else{
			$nature="Trading";
		}
	}
	//$PI_indicate = wordwrap($PI_indicate, 50, "<br/>", true);		
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
	if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
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

</style>
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
          '.$assamSarkarLogo.'<br/><h4>'.$form_name.'</h4>
    </div><br/> 
    <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">  
		<tr>
			<td valign="top"> Industrial land available at : </td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">2.Registered Office Address with Telephone No. :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1"> 
					<tr>
							<td width="50%">Street Name 1</td>
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
							<td height="29">Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
							<td>E-Mail ID</td>
							<td>'.$b_email.'</td>
					</tr>
					<tr>
					   
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>3. New Unit / Existing Unit undertaking Substantial Expansion :</td>
			<td>'.strtoupper($substantial_exp).'</td>
		</tr>
		<tr>
			<td style="width:50%" valign="top">4. Unit Address with Telephone no  :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1"> 
					<tr>
							<td width="50%">Street Name1</td>
							<td>'.strtoupper($b_street_name3).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name4).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($b_vill2).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist2).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode2).'</td>
					</tr>
					<tr>
							<td>Mobile No.</td>
							<td>'.strtoupper($office_mob).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>5. Legal Entity of the Enterprise (Proprietorship / Partnership Firm / Private Limited Company / Public Limited Company / Cooperative Society / Society / Limited Liability Partnership)</td>
			<td>'.strtoupper($l_o_business_val).'</td>
		</tr>
		<tr>
		  <td> 6. Names and address of the Proprietor/Partners/Directors/President & Secretary :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="5%">Sl. No.</th>
							<th width="25%">Partners/Directors Name</th>
							<th width="20%">Street Name 1</th>
							<th width="15%">Street Name 2</th>
							<th width="15%">Village/Town</th>
							<th width="10%">District</th>
							<th width="10%">Pincode</th>
						</tr>
					</thead>';
					$results1=$dic->query("select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr align="center">
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn1).'</td>
						<td>'.strtoupper($rows->sn2).'</td>
						<td>'.strtoupper($rows->vill).'</td>
						<td>'.strtoupper($rows->dist).'</td>
						<td>'.strtoupper($rows->pin).'</td>
					</tr>';
						$sl++;
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>7. Date of registration under Companies Act,2013 or under Indian Partnership Act, 1932 or under Assam Co-operative Societies Act, 2007 (as applicable) :</td>
			<td>'.strtoupper($act_reg_date).'</td>
		</tr>
		<tr>
			<td> 8. Nature of Operations :</td>
			<td>'.strtoupper($nature).'</td>
		</tr>
		<tr>
			<td colspan="2">9. Date of Commencement of Commercial Production / Operations (for Service Sector) :</td>
		</tr>
		<tr>
			<td>a) For New Units :</td>
			<td>'.strtoupper($new_units_dt).'</td>
		</tr>
		<tr>
			<td>b) For Existing Units undertaking Substantial Expansion :</td>
			<td>'.strtoupper($existing_units_dt).'</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="5%">Sl no.</th>
							<th width="25%">Date of going into commercial production/becoming operational</th>
							<th width="20%">Prior to Expansion</th>
							<th width="15%">After Expansion</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td>For Manufacturing Sector Units</td>
							<td>'.strtoupper($man_units_date_bf_exp1).'</td>
							<td>'.strtoupper($man_units_date_af_exp1).'</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>For Service Sector Units</td>
							<td>'.strtoupper($ser_sector_date_bf_exp2).'</td>
							<td>'.strtoupper($ser_sector_date_af_exp2).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		 <tr>
			<td colspan="2">10. Details of Bank Account where the subsidy Amount, if reimbursed,is to be deposited </td>
		</tr>
		 <tr>
			<td>a) Bank A/c Number :</td>
			<td>'.strtoupper($bnk_ac_no).'</td>
		</tr>
		<tr>
			<td>b) Type of Account (Current Account, Cash Credit Account, Term Loan Account) :</td>
			<td>'.strtoupper($acc_type).'</td>
		</tr>
		 <tr>
			<td>c) Name of the Bank :</td>
			<td>'.strtoupper($bnk_name).'</td>
		</tr>
		 <tr>
			<td>d) Name of the Branch & Address :</td>
			<td>'.strtoupper($bnk_branch).'</td>
		</tr>
		 <tr>
			<td colspan="2">11. Details of Products / Services :</td>
		</tr>
		<tr>
			<td colspan="2">(i) Under GST </td>
		</tr>
		<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="10%" align="center">Sl. No.</td>
					<td width="40%" align="center">HSN Code</td>
					<td width="40%" align="center">Description</td>
				</tr>';
				
				$part1=$dic->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["hsn_code"]).'</td>
							<td>'.strtoupper($row_1["desc1"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">(ii) Not Under GST : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="10%" align="center">Sl. No.</td>
					<td width="40%" align="center">NIC Code</td>
					<td width="40%" align="center">Description</td>
				</tr>';
				
				$part2=$dic->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["nic_code"]).'</td>
							<td>'.strtoupper($row_2["desc2"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">12. Details of Enterprise Registration :</td>
	</tr>
	  <tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="10%"></th>
							<th width="40%"></th>
							<th width="20%">Ack No</th>
							<th width="30%">Date</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td>Acknowledgement of EM-Part I</td>
							<td>'.strtoupper($em_part1_ack1).'</td>
							<td>'.strtoupper($em_part1_dt1).'</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>EM-Part II or Industrial Entrepreneur Memorandum No.</td>
							<td>'.strtoupper($em_part2_ack2).'</td>
							<td>'.strtoupper($em_part2_dt2).'</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>Eligibility Certificate </td>
							<td>'.strtoupper($elig_cert_ack3).'</td>
							<td>'.strtoupper($elig_cert_dt3).'</td>
						</tr>
						<tr>
							<td>4.</td>
							<td>GSTN</td>
							<td>'.strtoupper($gstn_ack4).'</td>
							<td>'.strtoupper($gstn_dt4).'</td>
						</tr>
						<tr>
							<td>5.</td>
							<td>PAN</td>
							<td>'.strtoupper($pan_ack5).'</td>
							<td>'.strtoupper($pan_dt5).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><b><u>POWER SUBSIDY</u></b></td>
		</tr>
		<tr>
			<td>1. Period of Claim :</td>
			<td> From '.strtoupper($period_of_claim_from).'   to   '.strtoupper($period_of_claim_to).' </td>
		</tr>
		<tr>
			<td>2. Period of Eligibility for availing power subsidy as per Eligibility Certificate :</td>
			<td> From '.strtoupper($period_of_power_subsidy_from).'   to   '.strtoupper($period_of_power_subsidy_to).' </td>
		</tr>
		<tr>
			 <td colspan="2">3. Details of Power Connection :</td>
		</tr>
									
		 <tr>
			<td colspan="2">a) In case of New Unit :
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="40%"></th>
							<th width="25%"></th>
							<th width="30%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>a) </td>
							<td>Total Electrical Power sanctioned and date of sanction. </td>
							<td>'.strtoupper($tot_elec_sanction1).'</td>
							<td>'.strtoupper($tot_elec_e_date).'</td>
						</tr>
						<tr>
							<td>b) </td>
							<td>Total electrical load connected.</td>
							<td></td>
							<td>'.strtoupper($tot_load_KVA1).'</td>
						</tr>
						<tr>
							<td>c) </td>
							<td>Sl. No. of Energy Meter(s) allotted. </td>
							<td></td>
							<td>'.strtoupper($sl_no_energy_met).'</td>
						</tr>
						<tr>
							<td>d) </td>
							<td> Initial Energy Meter reading.</td>
							<td></td>
							<td>'.strtoupper($ini_energy_meter).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		<tr>
			 <td colspan="2">b) In case of Existing unit undertaking Substantial Expansion : </td>
		</tr>
									
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
							<th width="5%"></th>
							<th width="40%"></th>
							<th width="25%"></th>
							<th width="30%"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>a) </td>
							<td>Additional Electrical Power sanctioned by APDCL</td>
							<td>'.strtoupper($existing_sanction_ad_elec).'</td>
							<td>'.strtoupper($existing_sanction_ad_elect_dt).'</td>
						</tr>
						<tr>
							<td>b) </td>
							<td>Additional Electrical Load connected.</td>
							<td></td>
							<td>'.strtoupper($existing_elec_load).'</td>
						</tr>
						<tr>
							<td>c) </td>
							<td>Total Electrical Load connected. </td>
							<td></td>
							<td>'.strtoupper($tot_elec_load_con).'</td>
						</tr>
						<tr>
							<td>d) </td>
							<td>Sl. No. of Energy Meter(s) allotted by APDCL for additional Power connection provided. </td>
							<td></td>
							<td>'.strtoupper($sl_no_energy_met_all).'</td>
						</tr>
						<tr>
							<td>e) </td>
							<td> Initial Meter reading of the New Energy Meter.</td>
							<td></td>
							<td>'.strtoupper($ini_meter_reading).'</td>
						</tr>
						<tr>
							<td>f) </td>
							<td>Last Meter reading prior to Substantial Expansion. </td>
							<td></td>
							<td>'.strtoupper($last_meter_reading).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		
		<tr>
			<td>4. Statement showing the Monthly Electricity Consumption :</td>
			<td>'.strtoupper($mon_elec_consump).'</td>
		</tr>
		<tr>
			<td>5. Percentage of Increase in Fixed Capital Investment as per Eligibility Certificate</br> (in case of Existing unit undertaking Substantial Expansion) :</td>
			<td>'.strtoupper($per_increase_fix_cap).'</td>
		</tr>
		
		<tr>
			<td colspan="2">INSURANCE SUBSIDY</td>
		</tr>
		<tr>
			<td colspan="2">1. Name and Address of the Insured (To whom the policy is issued) :</td>
		</tr>
		
		<tr>
			<td>Name :</td>
			<td>'.strtoupper($ins_name).'</td>
		</tr>
		<tr>
			<td style="width:50%" valign="top">Address with Telephone no  :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1"> 
					<tr>
							<td width="50%">Street Name 1</td>
							<td>'.strtoupper($ins_sn1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($ins_sn2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($ins_town).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($ins_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($ins_pincode).'</td>
					</tr>
					<tr>
							<td>Mobile No.</td>
							<td>'.strtoupper($ins_mobile).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Date of commencement of first Fire Insurance Policy on commission of the Unit :</td>
			<td>'.strtoupper($comm_dt_first_fire).'</td>
		</tr>
		<tr>
			<td>3. Period of Insurance :</td>
			<td> From '.strtoupper($period_of_ins_p_from).'   to   '.strtoupper($period_of_ins_p_to).' </td>
		</tr>
		<tr>
			<td>4. Fire Policy No. :</td>
			<td>'.strtoupper($fire_policy_no).'</td>
		</tr>
		<tr>
			<td>5. Basis of Sum Insured (Whether Book Value / Market Value / New Replacement Value) :</td>
			<td>'.strtoupper($basis_sum_insured).'</td>
		</tr>
		<tr>
			<td>6. Total Sum Insured (in Rs.) :</td>
			<td>'.strtoupper($tot_sum_ins1).'</td>
		</tr>
		
		<tr>
			<td colspan="2">7. Break up of Sum Insured :
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					
					
						<tr>
							
							<td width="40%">I)  Boundary Wall :</td>
							<td width="60%">'.strtoupper($boundary_wall).'</td>
							
						</tr>
						<tr>
							
							<td >II)  Buildings :</td>
							<td >'.strtoupper($buildings).'</td>
						</tr>
						<tr>
							
							<td >III)  Plant & Machinery :</td>
							<td >'.strtoupper($plant_machinery).'</td>
						</tr>
						<tr>
							
							<td >IV)  Miscellaneous Fixed Assets :</td>
							<td >'.strtoupper($misc_fixed_assets).'</td>
						</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<td>8. Net Premium paid as per Fire Policy (in Rs.) :</td>
			<td>'.strtoupper($net_pre_paid).'</td>
		</tr>
		<tr>
			<td>9. Amount of Refund, after Issuance of policy (in Rs.) :</td>
			<td>'.strtoupper($amount_of_refund).'</td>
		</tr>
		<tr>
			<td>10. Whether a Certificate from the policy issuing office has been attached stating that the policy was in force for the entire policy period and amount of refund availed?</td>
			<td>'.strtoupper($is_cert_policy).'</td>
		</tr>
		<tr>
			<td>11. Reimbursement of Insurance Premium availed so far under the scheme and details thereof :</td>
			<td>'.strtoupper($reim_ins_premium).'</td>
		</tr>
		<tr>
			<td colspan="2"><strong><u>WORKING CAPITAL INTEREST SUBSIDY</u></strong></td>
		</tr>
		<tr>
			<td colspan="2"><strong><u>WORKING CAPITAL</u></strong></td>
		</tr>
		<tr>
			<td colspan="2">1. Name of the Bank & Branch providing Working Capital Loan :</td>
		</tr>
		<tr>
			<td>Name of the Bank </td>
			<td>'.strtoupper($work_capital_bnk_name).'</td>
		</tr>
		<tr>
			<td>Branch </td>
			<td>'.strtoupper($work_capital_branch).'</td>
		</tr>
		<tr>
			<td>2. Cash Credit Account No. </td>
			<td>'.strtoupper($cash_credit_acc_no).'</td>
		</tr>
		<tr>
			<td>3. Maximum Limit of working capital sanctioned along with the rate of interest </td>
			<td>'.strtoupper($work_capital_limit).'</td>
		</tr>
		<tr>
			<td colspan="2">4. Sanction Number & Date :</td>
		</tr>
		<tr>
			<td>Number </td>
			<td>'.strtoupper($sanction_number).'</td>
		</tr>
		<tr>
			<td>Date </td>
			<td>'.strtoupper($sanction_dt2).'</td>
		</tr>
		<tr>
			<td>5. Total Interest charged by the Bank</td>
			<td>'.strtoupper($tot_interest_charged_bnk).'</td>
		</tr>
		<tr>
			<td>6. Total Interest Subsidy Eligible </td>
			<td>'.strtoupper($tot_interest_subsidy_elig).'</td>
		</tr>
		<tr>
			<td colspan="2"><strong><u>Capital Investment</u></strong></td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<thead>
						<tr>
								
								<th rowspan="2">Particulars</th>
								<th rowspan="2">For New Unit (in Rs) </th>
								<th colspan="2">For Existing Units</th>
											
						</tr>
						<tr>
								<th>Prior to Expansion</th>
								<th>After Expansion</th>
											
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td>1. Land & Site Development.</td>
							<td>'.strtoupper($capital_investment_land1).'</td>
							<td>'.strtoupper($capital_investment_land2).'</td>
							<td>'.strtoupper($capital_investment_land3).'</td>
							
						</tr>
						<tr>
							
							<td>2. Office Building.</td>
							<td>'.strtoupper($capital_investment_sd1).'</td>
							<td>'.strtoupper($capital_investment_sd2).'</td>
							<td>'.strtoupper($capital_investment_sd3).'</td>
						</tr>
						<tr>
							
							<td>3. Factory Building.</td>
							<td>'.strtoupper($capital_investment_fact1).'</td>
							<td>'.strtoupper($capital_investment_fact2).'</td>
							<td>'.strtoupper($capital_investment_fact3).'</td>
						</tr>
						<tr>
							
							<td>4. Plant & Machinery.</td>
							<td>'.strtoupper($capital_investment_ob1).'</td>
							<td>'.strtoupper($capital_investment_ob2).'</td>
							<td>'.strtoupper($capital_investment_ob3).'</td>
						</tr>
						<tr>
							
							<td>5. Accessories.</td>
							<td>'.strtoupper($capital_investment_items1).'</td>
							<td>'.strtoupper($capital_investment_items2).'</td>
							<td>'.strtoupper($capital_investment_items3).'</td>
						</tr>
						<tr>
							
							<td>6. Miscellaneous Fixed Assets.</td>
							<td>'.strtoupper($capital_investment_ei1).'</td>
							<td>'.strtoupper($capital_investment_ei2).'</td>
							<td>'.strtoupper($capital_investment_ei3).'</td>
						</tr>
						<tr>
							
							<td>7. Preliminary & Pre-Operative Expenses.</td>
							<td>'.strtoupper($capital_investment_exp1).'</td>
							<td>'.strtoupper($capital_investment_exp2).'</td>
							<td>'.strtoupper($capital_investment_exp3).'</td>
						</tr>
						<tr>
							
							<td>Total.</td>
							<td>'.strtoupper($capital_investment_tot1).'</td>
							<td>'.strtoupper($capital_investment_tot2).'</td>
							<td>'.strtoupper($capital_investment_tot3).'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2"><strong><u>CAPITAL INVESTMENT SUBSIDY</u></strong></td>
		</tr>
		<tr>
			<td colspan="2">1. Source of Finance :</td>
		</tr>
		<tr>
			<td>A. Promoters Contribution. </td>
			<td>'.strtoupper($source_of_fin1).'</td>
		</tr>
		<tr>
			<td>B. Equity. </td>
			<td>'.strtoupper($source_of_fin2).'</td>
		</tr>
		<tr>
			<td>C. Term Loan. </td>
			<td>'.strtoupper($source_of_fin3).'</td>
		</tr>
		<tr>
			<td>D. Unsecured Loan. </td>
			<td>'.strtoupper($source_of_fin4).'</td>
		</tr>
		<tr>
			<td>E. Internal Resources. </td>
			<td>'.strtoupper($source_of_fin5).'</td>
		</tr>
		<tr>
			<td>F. Any Other Source. </td>
			<td>'.strtoupper($source_of_fin6).'</td>
		</tr>
	<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="5%" align="center">Sl. No.</td>
					<td width="15%" align="center">Name of Bank/Financial Institution</td>
					<td width="20%" align="center">Amount of Term /Working Capital Loan Sanctioned</td>
					<td width="20%" align="center">Sanction Letter No.</td>
					<td width="20%" align="center">Sanction Date</td>
					<td width="20%" align="center">Amount of Term /Working Capital Loan Disbursed</td>
				</tr>';
				
				$part3=$dic->query("SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_3["slno"]).'</td>
							<td>'.strtoupper($row_3["bnk_fin_name"]).'</td>
							<td>'.strtoupper($row_3["term_amount"]).'</td>
							<td>'.strtoupper($row_3["sanction_letter_no"]).'</td>
							<td>'.strtoupper($row_3["sanction_date_no"]).'</td>
							<td>'.strtoupper($row_3["working_cap_term_amt"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
		<td colspan="2">Details of Equity (if any) :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="10%" align="center">Sl No.</td>
					<td width="30%" align="center">Name of the person</td>
					<td width="20%" align="center">Amount</td>
					<td width="20%" align="center">PAN No.</td>
					<td width="20%" align="center">Mode of Payment</td>
					
				</tr>';
				
				$part4=$dic->query("SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["name_person"]).'</td>
							<td>'.strtoupper($row_4["amt"]).'</td>
							<td>'.strtoupper($row_4["pan_no"]).'</td>
							<td>'.strtoupper($row_4["pay_mode"]).'</td>
							
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>	
	<tr>
		<td colspan="2" >Details of Unsecured Loan (if any) :</td>
	</tr>	
	<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="10%" align="center">Sl No.</td>
					<td width="30%" align="center">Name of the person</td>
					<td width="20%" align="center">Amount</td>
					<td width="20%" align="center">PAN No.</td>
					<td width="20%" align="center">Mode of Payment</td>
					
				</tr>';
				
				$part5=$dic->query("SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["name_person2"]).'</td>
							<td>'.strtoupper($row_5["amt2"]).'</td>
							<td>'.strtoupper($row_5["pan_no2"]).'</td>
							<td>'.strtoupper($row_5["pay_mode2"]).'</td>
							
					</tr>';
					}$printContents=$printContents.'
			</table> 
		</td>
	</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>