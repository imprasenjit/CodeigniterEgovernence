<?php
$dept="dic";
$form="12";
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
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where  user_id='$swr_id' and active='1'");
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
		
		#### PART III #####	
		
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
		
        $capital_investment_tot1=((int)$capital_investment_land1+(int)$capital_investment_sd1+(int)$capital_investment_fact1+(int)$capital_investment_ob1+(int)$capital_investment_items1+(int)$capital_investment_ei1+(int)$capital_investment_exp1);
	
		$capital_investment_tot2=((int)$capital_investment_land2+(int)$capital_investment_sd2+(int)$capital_investment_fact2+(int)$capital_investment_ob2+(int)$capital_investment_items2+(int)$capital_investment_ei2+(int)$capital_investment_exp2);
		
		$capital_investment_tot3=((int)$capital_investment_land3+(int)$capital_investment_sd3+(int)$capital_investment_fact3+(int)$capital_investment_ob3+(int)$capital_investment_items3+(int)$capital_investment_ei3+(int)$capital_investment_exp3);
		
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
          '.$assamSarkarLogo.'<br/><h4>'.$form_name.'</h4>
    </div><br/> 
    <table class="table table-bordered table-responsive">  
		<tr>
			<td valign="top"> Industrial land available at : </td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">2.Registered Office Address with Telephone No. :</td>
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
							<td height="29">Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
							<td>E-Mail ID</td>
							<td>'.$b_email.'</td>
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
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name1</td>
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
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
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
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>
		  <td> 6. Names and address of the Proprietor/Partners/Directors/President & Secretary :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>Sl. No.</th>
							<th>Partners/Directors Name</th>
							<th>Street Name 1</th>
							<th>Street Name 2</th>
							<th>Village/Town</th>
							<th>District</th>
							<th>Pincode</th>
						</tr>
					</thead>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") ;
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
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>Sl no.</th>
							<th>Date of going into commercial production/becoming operational</th>
							<th>Prior to Expansion</th>
							<th>After Expansion</th>
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
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">HSN Code</td>
					<td align="center">Description</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
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
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">NIC Code</td>
					<td align="center">Description</td>
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
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
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th>Ack No</th>
							<th>Date</th>
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
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name 1</td>
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
			<td colspan="2">7. Break up of Sum Insured :</td>
            	<td>
				<table class="table table-bordered table-responsive">
					
				
						<tr>
							
							<td>I)  Boundary Wall :</td>
							<td width="60%">'.strtoupper($boundary_wall).'</td>
							
						</tr>
						<tr>
							
							<td>II)  Buildings :</td>
							<td>'.strtoupper($buildings).'</td>
						</tr>
						<tr>
							
							<td>III)  Plant & Machinery :</td>
							<td>'.strtoupper($plant_machinery).'</td>
						</tr>
						<tr>
							
							<td>IV)  Miscellaneous Fixed Assets :</td>
							<td>'.strtoupper($misc_fixed_assets).'</td>
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
				<table class="table table-bordered table-responsive">
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
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">Name of Bank/Financial Institution</td>
					<td align="center">Amount of Term /Working Capital Loan Sanctioned</td>
					<td align="center">Sanction Letter No.</td>
					<td align="center">Sanction Date</td>
					<td align="center">Amount of Term /Working Capital Loan Disbursed</td>
				</tr>';
				
				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
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
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl No.</td>
					<td align="center">Name of the person</td>
					<td align="center">Amount</td>
					<td align="center">PAN No.</td>
					<td align="center">Mode of Payment</td>
					
				</tr>';
				
				$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
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
		<td colspan="2">Details of Unsecured Loan (if any) :</td>
	</tr>	
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl No.</td>
					<td align="center">Name of the person</td>
					<td align="center">Amount</td>
					<td align="center">PAN No.</td>
					<td align="center">Mode of Payment</td>
					
				</tr>';
				
				$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
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
			<td>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right"><b>'.strtoupper($key_person).'</b><br/>Signature of the Applicant</td>
        </tr>        
	</table>';
?>