<?php
$dept="dic";
$form="14";
$table_name=$formFunctions->getTableName($dept,$form);

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
		$claim_no=$results['claim_no'];
		$period_of_claim_from=$results['period_of_claim_from'];
		$period_of_claim_to=$results['period_of_claim_to'];
		$reg_no=$results['reg_no'];
		$dor=$results['dor'];
		$reg_no1=$results['reg_no1'];
		$cert=$results['cert'];
		$man_product=$results['man_product'];
		$service_product=$results['service_product'];
		$man_dt=$results['man_dt'];
		$service_dt=$results['service_dt'];
		$service_product1=$results['service_product1'];
		$turnover=$results['turnover'];
		$turnover1=$results['turnover1'];
		$turnover2=$results['turnover2'];
		$raw_material=$results['raw_material'];
		$finished_product=$results['finished_product'];
		$work_capital_bnk_name=$results['work_capital_bnk_name'];
		$work_capital_branch=$results['work_capital_branch'];
		$work_capital_limit=$results['work_capital_limit'];
		$sanction_number=$results['sanction_number'];
		$sanction_dt2=$results['sanction_dt2'];
		$cash_credit_acc_no=$results['cash_credit_acc_no'];
		
		$tot_interest_charged_bnk=$results['tot_interest_charged_bnk'];
		$tot_interest_subsidy_elig=$results['tot_interest_subsidy_elig'];
		$remarks=$results['remarks'];
		$employment_generation=$results['employment_generation'];
		
		##### Part A #######
		if(!empty($results["existing_expansional_date"])){
			$existing_expansional_date=json_decode($results["existing_expansional_date"]);
			$existing_expansional_date_msu_pe=$existing_expansional_date->msu_pe;
			$existing_expansional_date_msu_ae=$existing_expansional_date->msu_ae;
			$existing_expansional_date_ssu_pe=$existing_expansional_date->ssu_pe;
			$existing_expansional_date_ssu_ae=$existing_expansional_date->ssu_ae;
		}else{
			$existing_expansional_date_msu_pe="";$existing_expansional_date_msu_ae="";$existing_expansional_date_ssu_pe="";$existing_expansional_date_ssu_ae="";
		}	
		
		if(!empty($results["ack"])){
			$ack=json_decode($results["ack"]);
			$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_em_no=$ack->em_no;$ack_em_dt=$ack->em_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_permanent_no=$ack->permanent_no;
		}else{
			$ack_pm_no="";$ack_pm_dt="";$ack_em_no="";$ack_em_dt="";$ack_ind_dt="";$ack_ind_no="";
			$ack_permanent_no="";
		}
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
		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
			$fixed_amount_land=$fixed_amount->land;
			$fixed_amount_site_dev=$fixed_amount->site_dev;
			$fixed_amount_wall=$fixed_amount->wall;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;$fixed_amount_ei2=$fixed_amount->ei2;
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";
		}
		
	}
	
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
			<td valign="top">1.(a) Name of Unit  :  </td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">(b). Office Address with Telephone/ Mobile no. :</td>
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
							<td height="29">Mobile No</td>
					        <td>'.$b_mobile_no.' </td>
				    </tr>
					<tr>
							<td height="29">Phone Number</td>
					        <td>'.$b_landline_std."-".$b_landline_no.' </td>
				    </tr>
					
				</table>
			</td>
		</tr>
		
		<tr>
			<td style="width:50%" valign="top">(c) Factory Address with telephone no.: </td>
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
							<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(d) Indicate the claim no. (say 1st claim, 2nd claim, etc..).</td>
			<td>'.strtoupper($claim_no).'</td>
		</tr>
		<tr>
			<td>(e). Period of Claim :</td>
			<td> From '.strtoupper($period_of_claim_from).'   to   '.strtoupper($period_of_claim_to).' </td>
		</tr>
		<tr>
		   <td colspan="2">2. (a)Registration number under NEIIPP, 2007 along with date </td>
		   
		</tr>
		<tr>
		   <td>Registration No. :</td>
		   <td>'.strtoupper($reg_no).'</td>
		</tr>
		<tr>
			<td>Date of Registration :</td>
			<td>'.strtoupper($dor).'</td>
		</tr>
		<tr>
		      <td>(b) Any other registration number required statutorily/ mandatorily:</td>
		      <td>'.strtoupper($reg_no1).'</td>
	    </tr>
		
		<tr>
			<td>3. Constitution of the unit(whether Proprietorship/Partnership/Private Ltd./Limited Company/Cooperative):</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		
		<tr>
			<td colspan="2">4. Name/s, address(es) of the Proprietor/ Partners/ Directors of Board of Directors/ Secretary and President (as applicable)</td>
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
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr>
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
			<td colspan="2">5. Details of Enterprise Registration :</td>
		</tr>
		<tr>
			<td>(i) Acknowledgement of Entrepreneur Memorandum (EM)-part-I , No & date: </td>
			<td> '.strtoupper($ack_pm_no).' '.strtoupper($ack_pm_dt).'</td>
		</tr>
		<tr>
			<td>(ii) Acknowledgement of Entrepreneur Memorandum (EM)-part-II , No & date: </td>
			<td>'.strtoupper($ack_em_no).' '.strtoupper($ack_em_dt).'</td>
		</tr>
		<tr>
			<td>(iii) Acknowledgement of Industrial Entrepreneur Memorandum (IEM), No & date:</td>
			<td>'.strtoupper($ack_ind_no).' '.strtoupper($ack_ind_dt).'</td>
		</tr>
		<tr>
			<td>iv) Permanent registration number in case of existing unit:</td>
			<td>'.strtoupper($ack_permanent_no).'</td>
		</tr>
		<tr>
			<td>6. Certificate of the unit having become functional/ operational (for Service Sector from concerned Department): </td>
			<td>'.strtoupper($cert).'</td>
		</tr>
		<tr>
		  <td>7. (a) Name of the product (for Manufacturing Sector):</td>
		  <td>'.strtoupper($man_product).'</td>
		</tr>
		<tr>
		  <td>(b) Name of the activity (for Service Sector):</td>
		  <td>'.strtoupper($service_product).'</td>
		</tr>
		
		<tr>
			<td colspan="2">8. Whether the unit is new or an existing unit under going substantial expansion</td>
		</tr>
		<tr>
			<td colspan="2">(a)In case of New Unit: </td>
		</tr>
		
		<tr>
			<td> (i) Date of commencement of production (Manufacturing Sector units):</td>
			<td>' . $man_dt .'</td>
		</tr>
		<tr>
			<td> (ii) Date of becoming operational (Service Sector units)</td>
			<td>' . $service_dt . '</td>			
		</tr>
		<tr>
			<td colspan="2">(b) In case of Existing Unit:  </td>
		</tr>
									
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							
							<th>Date of going into commercial production/ becoming operational</th>
							<th>Prior to Expansion</th>
							<th>After to Expansion </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>(i)  Manufacturing Sector units :</td>
							<td>'.strtoupper($existing_expansional_date_msu_pe).'</td>
							<td>'.strtoupper($existing_expansional_date_msu_ae).'</td>
						</tr>
						<tr>
							
							<td>(i)  Service Sector units :</td>
							<td>'.strtoupper($existing_expansional_date_ssu_pe).'</td>
							<td>'.strtoupper($existing_expansional_date_ssu_ae).'</td>
						</tr>
						</tbody>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="2">9. Capital Investment [to be supported by CA Certificate as per Form-1D(A)(i)/Form:1D(A)(ii)]</td>
			
		</tr>
		<tr>
			<td colspan="2"><strong>Capital Investment</strong></td>
		</tr>
		
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
								
								<th rowspan="2">Particulars</th>
								<th rowspan="2">For New Unit (in Rs) </th>
								<th colspan="2" >For Existing Units</th>
											
						</tr>
						<tr>
								<th>Prior to Expansion</th>
								<th>After Expansion</th>
											
						</tr>
					</thead>
					<tbody>
						<tr>
							
							<td>a. Land & Site Development</td>
							<td>'.strtoupper($capital_investment_land1).'</td>
							<td>'.strtoupper($capital_investment_land2).'</td>
							<td>'.strtoupper($capital_investment_land3).'</td>
							
						</tr>
						<tr>
							
							<td>b.(i) Office Building</td>
							<td>'.strtoupper($capital_investment_sd1).'</td>
							<td>'.strtoupper($capital_investment_sd2).'</td>
							<td>'.strtoupper($capital_investment_sd3).'</td>
						</tr>
						<tr>
							
							<td>b. (ii) Factory Building</td>
							<td>'.strtoupper($capital_investment_fact1).'</td>
							<td>'.strtoupper($capital_investment_fact2).'</td>
							<td>'.strtoupper($capital_investment_fact3).'</td>
						</tr>
						<tr>
							
							<td>c. Plant & Machinery</td>
							<td>'.strtoupper($capital_investment_ob1).'</td>
							<td>'.strtoupper($capital_investment_ob2).'</td>
							<td>'.strtoupper($capital_investment_ob3).'</td>
						</tr>
						<tr>
							
							<td>d. Accessories</td>
							<td>'.strtoupper($capital_investment_items1).'</td>
							<td>'.strtoupper($capital_investment_items2).'</td>
							<td>'.strtoupper($capital_investment_items3).'</td>
						</tr>
						<tr>
							
							<td>e. Miscellaneous Fixed Assets</td>
							<td>'.strtoupper($capital_investment_ei1).'</td>
							<td>'.strtoupper($capital_investment_ei2).'</td>
							<td>'.strtoupper($capital_investment_ei3).'</td>
						</tr>
						<tr>
							
							<td>f. Preliminary & Pre-Operative Expenses</td>
							<td>'.strtoupper($capital_investment_exp1).'</td>
							<td>'.strtoupper($capital_investment_exp2).'</td>
							<td>'.strtoupper($capital_investment_exp3).'</td>
						</tr>
						
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td>10. Increase in investment (in case of existing unit) :</td>
			<td>'.strtoupper($service_product1).'</td>
		</tr>
		<tr>
			<td colspan="2">11. (a) For New unit: </td>
		</tr>
		<tr>
			<td>(i) Annual Turnover of the unit (in Rs.) : </td>
			<td>'.strtoupper($turnover).'</td>
		</tr>
		<tr>
			<td colspan="2">(b) For Existing unit undergoing expansion :</td>
		</tr>
		<tr>
			<td>(i) Annual turnover before expansion (in Rs.) :</td>
			<td>'.strtoupper($turnover1).'</td>
		</tr>
		<tr>
			<td>(ii) Annual turnover after expansion (in Rs.) :</td>
			<td>'.strtoupper($turnover2).'</td>
		</tr>
	<tr>
		<td colspan="2">12.(a) Names of the raw materials utilized with quantity and value during the claim period.</td>
	</tr>
		
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">Name</td>
					<td align="center">Quantity</td>
					<td align="center">Value</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name1"]).'</td>
							<td>'.strtoupper($row_1["qty1"]).'</td>
							<td>'.strtoupper($row_1["value1"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
		<td colspan="2">(b) Name of the finished product(s) alongwith quantity and value during the claim period.</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">Name</td>
					<td align="center">Quantity</td>
					<td align="center">Value</td>
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name2"]).'</td>
							<td>'.strtoupper($row_2["qty2"]).'</td>
							<td>'.strtoupper($row_2["value2"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
		<td colspan="2">13. Working Capital</td>
	</tr>	
		
		<tr>
			<td colspan="2">(a). Name of the Bank & Branch providing Working Capital Loan :</td>
		</tr>
		<tr>
			<td>Name of the Bank :</td>
			<td>'.strtoupper($work_capital_bnk_name).'</td>
		</tr>
		<tr>
			<td>Branch :</td>
			<td>'.strtoupper($work_capital_branch).'</td>
		</tr>
		<tr>
			<td>(b) Maximum Limit of working capital sanctioned along with the rate of interest :</td>
			<td>'.strtoupper($work_capital_limit).'</td>
		</tr>
		
		<tr>
			<td colspan="2">(c) Sanction Number & Date :</td>
		</tr>
		<tr>
			<td>Number :</td>
			<td>'.strtoupper($sanction_number).'</td>
		</tr>
		<tr>
			<td>Date :</td>
			<td>'.strtoupper($sanction_dt2).'</td>
		</tr>
		<tr>
		    <td>(d) Cash Credit Account No. of the Unit :</td>
            <td>'.strtoupper($cash_credit_acc_no).'</td>			
		</tr>
		<tr>
			<td>(e) Total interest charged by the Bank [enclose detailed bank statement for the period, along with recommendation certificate issued by the Bank as per Form:1D(B)] :</td>
			<td>'.strtoupper($tot_interest_charged_bnk).'</td>
		</tr>
		<tr>
			<td>(f) Total Interest Subsidy Eligible :</td>
			<td>'.strtoupper($tot_interest_subsidy_elig).'</td>
		</tr>
		<tr>
			<td>14. Remarks if any :</td>
			<td>'.strtoupper($remarks).'</td>
		</tr>
		
		<tr>
			<td>15. Employment generation in various fields of work :</td>
			<td>'.strtoupper($employment_generation).'</td>
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