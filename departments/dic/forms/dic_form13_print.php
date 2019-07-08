<?php
$dept="dic";
$form="13";
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
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where  user_id='$swr_id' and active='1'") ;
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$office_mob=$results['office_mob'];
		$act_reg_date=$results['act_reg_date'];
		$act_date=$results['act_date'];
		$nature=$results['nature'];	
		$new_units_dt=$results['new_units_dt'];
		$if_any=$results['if_any'];
		$date_commencement2=$results['date_commencement2'];
		$if_any1=$results['if_any1'];
		$if_any2=$results['if_any2'];
		$if_any3=$results['if_any3'];
		$PI_indicate=$results['PI_indicate'];
		$conn_load=$results['conn_load'];
		$new_production=$results['new_production'];
		$date_commencement1=$results['date_commencement1'];
		$capital_investment=$results['capital_investment'];$saction_date=$results['saction_date'];
		
		if(!empty($results["fixed_amount"])){
			$fixed_amount=json_decode($results["fixed_amount"]);
	
			if(isset($fixed_amount->land))  $fixed_amount_land=$fixed_amount->land; else $fixed_amount_land="";
			if(isset($fixed_amount->site_dev))  $fixed_amount_site_dev=$fixed_amount->site_dev; else $fixed_amount_site_dev="";
			if(isset($fixed_amount->wall))  $fixed_amount_wall=$fixed_amount->wall; else $fixed_amount_wall="";
			if(isset($fixed_amount->pm))  $fixed_amount_pm=$fixed_amount->pm; else $fixed_amount_pm="";
			if(isset($fixed_amount->fb))  $fixed_amount_fb=$fixed_amount->fb; else $fixed_amount_fb="";
			if(isset($fixed_amount->m))  $fixed_amount_m=$fixed_amount->m; else $fixed_amount_m="";
			if(isset($fixed_amount->ob))  $fixed_amount_ob=$fixed_amount->ob; else $fixed_amount_ob="";
			if(isset($fixed_amount->pe))  $fixed_amount_pe=$fixed_amount->pe; else $fixed_amount_pe="";
			if(isset($fixed_amount->ei))  $fixed_amount_ei=$fixed_amount->ei; else $fixed_amount_ei="";
			if(isset($fixed_amount->ei2))  $fixed_amount_ei2=$fixed_amount->ei2; else $fixed_amount_ei2="";
			if(isset($fixed_amount->ei3))  $fixed_amount_ei3=$fixed_amount->ei3; else $fixed_amount_ei3="";
			/*$fixed_amount_land=$fixed_amount->land;$fixed_amount_site_dev=$fixed_amount->site_dev;$fixed_amount_wall=$fixed_amount->wall;$fixed_amount_pm=$fixed_amount->pm;$fixed_amount_fb=$fixed_amount->fb;$fixed_amount_m=$fixed_amount->m;$fixed_amount_ob=$fixed_amount->ob;$fixed_amount_pe=$fixed_amount->pe;$fixed_amount_ei=$fixed_amount->ei;$fixed_amount_ei2=$fixed_amount->ei2;$fixed_amount_ei3=$fixed_amount->ei3; */
		}else{
			$fixed_amount_land="";$fixed_amount_site_dev="";$fixed_amount_wall="";$fixed_amount_pm="";$fixed_amount_fb="";$fixed_amount_m="";$fixed_amount_ob="";$fixed_amount_pe="";$fixed_amount_ei="";$fixed_amount_ei2="";$fixed_amount_ei3="";
		}
		if(!empty($results["head"])){
			$head=json_decode($results["head"]);
			$head_street1=$head->street1;
			$head_street2=$head->street2;
			$head_vill=$head->vill;
			$head_dist=$head->dist;
			$head_pin=$head->pin;
			$head_mobile=$head->mobile;
			$head_email=$head->email;
		}else{
			$head_street1="";$head_street2="";$head_vill="";$head_dist="";$head_pincode="";$head_mobile="";$head_email="";
		}
	    if(!empty($results["ack"])){
		$ack=json_decode($results["ack"]);
		$ack_pm_no=$ack->pm_no;$ack_pm_dt=$ack->pm_dt;$ack_ind_dt=$ack->ind_dt;$ack_ind_no=$ack->ind_no;$ack_lic_no=$ack->lic_no;
	    }else{
		$ack_pm_no="";$ack_pm_dt="";$ack_ind_dt="";$ack_ind_no="";$ack_lic_no="";
	    }
		
	    if($ack_pm_dt!="" && $ack_pm_dt!="0000-00-00"){
		$ack_pm_dt = date('d-m-Y',strtotime($ack_pm_dt));
	    }else{
		$ack_pm_dt="";
	     }
	    if($ack_ind_dt!="" && $ack_ind_dt!="0000-00-00"){
		$ack_ind_dt = date('d-m-Y',strtotime($ack_ind_dt));
	    }else{
		$ack_ind_dt="";
	    }
		if(!empty($results["period_of_ins"])){
			$period_of_ins=json_decode($results["period_of_ins"]);
			$period_of_ins_p_from=$period_of_ins->p_from;$period_of_ins_p_to=$period_of_ins->p_to;
		}else{
			$period_of_ins_p_from="";$period_of_ins_p_to="";
		}
		$fire_policy_no=$results['fire_policy_no'];$basis_sum_insured=$results['basis_sum_insured'];
		
		$boundary_wall=$results['boundary_wall'];$buildings=$results['buildings'];$plant_machinery=$results['plant_machinery'];$misc_fixed_assets=$results['misc_fixed_assets'];$net_pre_paid=$results['net_pre_paid'];$amount_of_refund=$results['amount_of_refund'];$is_cert_policy=$results['is_cert_policy'];$reim_ins_premium=$results['reim_ins_premium'];$work_capital_bnk_name=$results['work_capital_bnk_name'];$work_capital_branch=$results['work_capital_branch'];$cash_credit_acc_no=$results['cash_credit_acc_no'];
		
		if($is_cert_policy=="Y"){
			$is_cert_policy="Yes";
		}else{
			$is_cert_policy="No";
		}
		
		if($nature=="O"){
			$nature="Own";
		}else if($nature=="L"){
			$nature="Loan";
		}
		else{
			$nature="Others";
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
			<td valign="top">1.Name of the Industrial  Unit. :  </td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">2.Office Address with telephone no. :</td>
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
			<td style="width:50%" valign="top">3. Factory Address with telephone no.: </td>
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
			<td>4. Constitution of the unit(whether Proprietorship/Partnership/Private Ltd./Limited Company/Cooperative):</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
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
			<td>6. Date of registration under the Companies Act/the concerned Act including the Act:</td>
			<td>'.strtoupper($act_reg_date).'</td>
		</tr>
		<tr>
			<td valign="top">7. Registered Head Office of the Company :</td>
			<td>
				<table class="table table-bordered table-responsive"> 
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($head_street1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($head_street2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($head_vill).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($head_dist).'</td>
					</tr>
					<tr>
							<td height="29">Pincode</td>
							<td>'.strtoupper($head_pin).'</td>
					</tr>
					<tr>
							<td height="29">Mobile no</td>
							<td>'.strtoupper($head_mobile).'</td>
					</tr>
					<tr>
							<td>E-Mail ID</td>
							<td>'.$head_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		
		
		<tr>
			<td colspan="2">8. Details of the registration of the unit with the concerned Department<br>(A). If Manufacturing Sector, please indicate :</td>
		</tr>
		<tr>
			<td>(i) Acknowledgement No. / Date of Entrepreneur Memorandum (EM), Part-1 (if any) of MSME : </td>
			<td> '.strtoupper($ack_pm_no).' '.strtoupper($ack_pm_dt).'</td>
		</tr>
		<tr>
			<td>(ii) Acknowledgement No. / Date of Industrial Entrepreneur Memorandum (EM) (if any) of DIPP : </td>
			<td>'.strtoupper($ack_ind_no).' '.strtoupper($ack_ind_dt).'</td>
		</tr>
		
		<tr>
			<td>(B) If Service Sector, please indicate requisite Registration / License No. from the concerned  Department (if any)  : </td>
			<td>'.strtoupper($ack_lic_no).'</td>
		</tr>
		<tr>
			<td>9. Date of Commencement of Commercial Production (for New Unit) :</td>
			<td> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
		</tr>
		<tr>
			<td>10. Whether the Unit was set up after 1.4.2007 : </td>
			<td>'.strtoupper($if_any).'</td>
		</tr>
		<tr>
			<td>11. If existing unit undergoing substantial expansion,:</td>
		</tr>
		<tr>
		  <td>i) What is the percentage of investment up to 31.3.2007?</td>
		  <td>'.strtoupper($new_units_dt).'</td>
		</tr>
		<tr>
		  <td>ii) Date of commencement of commercial production after expansion.</td>
		  <td>'.strtoupper($date_commencement2).'</td>
		</tr>
		<tr>
			<td> 12. Actual capital Investment (Capitalized value): : </td>
			<td>'.strtoupper($capital_investment).'</td>
		</tr>
		<tr>
			<td>(a)Land </td>
			<td>'.strtoupper($fixed_amount_land).'</td>
		</tr>
		<tr>
			<td>(b)Site Development  :</td>
			<td>'.strtoupper($fixed_amount_site_dev).'</td>
		</tr>
		<tr>
		    <td>(c)Boundary Wall:</td>
            <td>'.strtoupper($fixed_amount_wall).'</td>			
		</tr>
		<tr>
			<td>(b) Building :</td>
			<td>(i)Office : '.strtoupper($fixed_amount_ob).'<br/>(ii) Factory : '.strtoupper($fixed_amount_fb).'</td>
		</tr>
		<tr>
			<td>(c) Plant and Machinery / Component / Items :</td>
			<td>'.strtoupper($fixed_amount_pm).'</td>
		</tr>
		<tr>
			<td>(d) Accessories:</td>
			<td>'.strtoupper($fixed_amount_ei).'</td>
		</tr>
		
		<tr>
			<td>(f) Electrical Installation :</td>
			<td>'.strtoupper($fixed_amount_ei2).'</td>
		</tr>
		<tr>
			<td>(g) Erection/ Installation: </td>
			<td>'.strtoupper($fixed_amount_ei3).'</td>
		</tr>
		<tr>
			<td>(h) Miscellaneous fixed assets: </td>
			<td>'.strtoupper($fixed_amount_m).'</td>
		</tr>
		
		<tr>
			<td>13. Whether a Certificate from a Registered Chartered Accountant (which needs to be Enclosed) on Capital Investment is attached [Form:1E(A)] : </td>
			<td>'.strtoupper($if_any1).'</td>
		</tr>
		
	     <tr>
			<td> 14. Means of Finance  :</td>
			<td>'.strtoupper($nature).'</td>
		</tr>
		<tr>
			<td>15. Whether availed Subsidy under Central Capital Investment Subsidy Scheme, 2007 :</td>
			<td>'.strtoupper($if_any2).'</td>
		</tr>
		<tr>
			<td>16. Whether subsidy availed on a new unit or Expanded unit:</td>
			<td>'.strtoupper($if_any3).'</td>
		</tr>
		<tr>
			<td>17. If Capital Subsidy is not availed/ granted specify the reason thereof:</td>
			<td>'.strtoupper($PI_indicate).'</td>
		</tr>
		 <tr>
			<td colspan="2">18. Details of Power Utilization </td>
		</tr>
		 <tr>
			<td>i) Date of sanction of power and load: :</td>
			<td>'.strtoupper($saction_date).'</td>
		</tr>
		<tr>
			<td>a) Connection load: </td>
			<td>'.strtoupper($conn_load).'</td>
		</tr>
		 <tr>
			<td>b) Date:</td>
			<td>'.strtoupper($act_date).'</td>
		</tr>
		 <tr>
			<td>ii)Details of production of the new unit:</td>
			<td>'.strtoupper($new_production).'</td>
		</tr>
		
		<tr>
			<td colspan="2">19.Give briefs details of manufacturing process of the unit (attach separate sheets, if necessary) </td>
		</tr>
		<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td align="center">Sl. No.</td>
					<td align="center">Name of  Product(s)</td>
					<td align="center">Installed Annual Production Capacity</td>
					<td align="center">Actual Annual Production (yearwise)</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["quantity"]).'</td>
							<td>'.strtoupper($row_1["production"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
		</tr>
		<tr>
			<td colspan="2">20.Fire Insurance for Fixed Assets  </td>
		</tr>
		<tr>
		    <td>Name of the Insured :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">2. Address of the Insured :</td>
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
							<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
							<td>E-Mail ID</td>
							<td>'.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td>c) Date of commencement of first Fire Insurance on commission of the Unit :</td>
			<td>'.strtoupper($date_commencement1).'</td>
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
			<td colspan="2">7.  Total Sum-Insured Break-up of Sum Insured:
				<table class="table table-bordered table-responsive">
					
					
						<tr>
							
							<td>I)  Boundary Wall :</td>
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
			<td>10. Whether a certificate from the Policy issuing Office attached stating that the Policy was in force for the entire policy period and amount of refund availed/due [in the prescribed Format Form: 1E(B)]</td>
			<td>'.strtoupper($is_cert_policy).'</td>
		</tr>
		<tr>
			<td>11. Reimbursement of Insurance Premium availed so far under the scheme and details thereof :</td>
			<td>'.strtoupper($reim_ins_premium).'</td>
		</tr>
		
		<tr>
			<td colspan="2">1.  Name of the Bank & Branch providing Working Capital Loan :</td>
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