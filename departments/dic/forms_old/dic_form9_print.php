<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form9 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form9 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form9 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form9 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$e_n_employee=$row1['Estimated_n_employee'];
	if($e_n_employee=="L10") $e_n_employee="5 To 10";
	else if($e_n_employee=="L20") $e_n_employee="10 To 20";
	else if($e_n_employee=="L50") $e_n_employee="20 To 50";
	else if($e_n_employee=="G50")$e_n_employee="50 or more";
	else $e_n_employee="Less than 5";
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="promotersship Firm";$l_o_business_name="promoterss";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability promotersship";$l_o_business_name="promoterss";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative dic";$l_o_business_name="Members";
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
	$q=$dic->query("select * from dic_form9 where user_id='$swr_id'") or die($dci->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
		$form_id=$results['form_id'];
		###### PART I #####
		$post_office=$results['post_office'];$reg_no=$results['reg_no'];$reg_date=$results['reg_date'];$investment=$results['investment'];$total_invest=$results['total_invest'];$plant_machinery=$results['plant_machinery'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_web=$office_address->web;$office_address_po=$office_address->po;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_web="";$office_address_po="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		###### PART II #####
		$s1=$results['s1'];$reg_details=$results['reg_details'];$date_of_production=$results['date_of_production'];$other_incentives=$results['other_incentives'];$total_amount=$results['total_amount'];$total_year=$results['total_year'];$transport_regno=$results['transport_regno'];$period_of_val_f=$results['period_of_val_f'];$period_of_val_t=$results['period_of_val_t'];
		if(!empty($results["pmt_reg"])){
			$pmt_reg=json_decode($results["pmt_reg"]);
			$pmt_reg_no=$pmt_reg->no;$pmt_reg_dt=$pmt_reg->dt;
		}else{
			$pmt_reg_no="";$pmt_reg_dt="";
		}
		if(!empty($results["under_neipp"])){
			$under_neipp=json_decode($results["under_neipp"]);
			$under_neipp_amount1=$under_neipp->amount1;$under_neipp_year1=$under_neipp->year1;$under_neipp_amount2=$under_neipp->amount2;$under_neipp_year2=$under_neipp->year2;$under_neipp_amount3=$under_neipp->amount3;$under_neipp_year3=$under_neipp->year3;$under_neipp_amount4=$under_neipp->amount4;$under_neipp_year4=$under_neipp->year4;
		}else{
			$under_neipp_amount1="";$under_neipp_year1="";$under_neipp_amount2="";$under_neipp_year2="";$under_neipp_amount3="";$under_neipp_year3="";$under_neipp_amount4="";$under_neipp_year4="";
		}
		###### PART III ##### 
		$no_of_employee=$results['no_of_employee'];$emp_under_contractor=$results['emp_under_contractor'];$tan_n_unit=$results['tan_n_unit'];$central_excise=$results['central_excise'];$vat_reg=$results['vat_reg'];$dist_f_focal=$results['dist_f_focal'];$dist_f_rstation=$results['dist_f_rstation'];$product_ext_from=$results['product_ext_from'];
		if(!empty($results["power"])){
			$power=json_decode($results["power"]);
			$power_tot_req=$power->tot_req;$power_sanction_load=$power->sanction_load;$power_conn_load=$power->conn_load;
		}else{
			$power_tot_req="";$power_sanction_load="";$power_conn_load="";
		}
		if(!empty($results["claim"])){
			$claim=json_decode($results["claim"]);
			$claim_period_from=$claim->period_from;$claim_period_to=$claim->period_to;
		}else{
			$claim_period_from="";$claim_period_to="";
		}
		###### PART III ##### 
		$unit_consumed=$results['unit_consumed'];$dg_set_rating=$results['dg_set_rating'];$diesel_consumed=$results['diesel_consumed'];$dg_unit_consumed=$results['dg_unit_consumed'];$total_elec_unit=$results['total_elec_unit'];
		if(!empty($results["bank_details"])){
			$bank_details=json_decode($results["bank_details"]);
			$bank_details_name=$bank_details->name;$bank_details_no=$bank_details->no;$bank_details_branch=$bank_details->branch;$bank_details_ifsc=$bank_details->ifsc;$bank_details_micr=$bank_details->micr;
		}else{
			$bank_details_name="";$bank_details_no="";$bank_details_branch="";$bank_details_ifsc="";$bank_details_micr="";
		}
	}		
    $form_name=$formFunctions->get_formName('dic','9');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 9</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>Form- 9<br/>[See rule 11 (1)]<br/>'.$form_name.'</h4>
		</div><br/>
      <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  		<tr>  				
			<td valign="top" width="50%">1. (a)Name of the Industrial unit </td>
			<td style="width:50%">'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
  		<td valign="top">(b) Factory Address  </td>
  		<td>
		<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Vill/Town/Ward</td>
        			<td>'.strtoupper($b_vill).'</td>
      		</tr>
      		<tr>
        			<td>Post Office</td>
        			<td>'.strtoupper($post_office).'</td>
      		</tr>
      		<tr>
        			<td>Pin Code</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Phone No</td>
        			<td>'.strtoupper($b_landline_std.'-'.$b_landline_no).'</td>
      		</tr>
      		<tr>
        			<td>State</td>
        			<td>ASSAM</td>
      		</tr>
			<tr>
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
		<tr>
  		<td valign="top">2. Office Address  </td>
  		<td>
		<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
      		<tr>
        			<td width="50%">Vill/Town/Ward</td>
        			<td>'.strtoupper($office_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>Post Office</td>
        			<td>'.strtoupper($office_address_po).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($office_address_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile No.</td>
        			<td>+91 - '.strtoupper($office_address_mob).'</td>
      		</tr>
      		<tr>
        			<td>E-Mail ID</td>
        			<td>'.$office_address_email.'</td>
      		</tr>
			
      		<tr>
        			<td>Website / URL</td>
        			<td>'.$office_address_web.'</td>
      		</tr>
			<tr>
        			<td>State</td>
        			<td>ASSAM</td>
			</tr>
			<tr>
        			<td>District</td>
        			<td> '.strtoupper($office_address_dist).'</td>
			</tr>
    		</table>
		</td>
  	</tr>
	<tr>
		<td>3. Constitution of the unit  </td>
		<td> '.strtoupper($l_o_business_val).'</td>
	</tr>
	<tr>
		<td width="50%" valign="top">4. Company registration No and Date / Partnership Deed</td>
		<td>
			<table width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="50%">Company registration No </td>
					<td> '.strtoupper($reg_no).'</td>
				</tr>
				<tr>
					<td>Date </td>
					<td> '.strtoupper($reg_date).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">5. Name(s) , Address(es) of the Proprietor/ Partners / Directors/ Secretary and President of the Cooperative dic with PAN</td>
	</tr>
	<tr>
			<td colspan="4">
			<table width="100%" align="center" class=" text-center table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name </th>
					<th>Address</th>
					<th>PAN No</th>
				</tr>
				</thead>
				<tbody>';
				$results1=$dic->query("select * from dic_form9_partners where form_id='$form_id'") or die("Error : ".$dic->error);
				$sl=1;
				while($rows=$results1->fetch_object()){
					$rows->partner_address = wordwrap($rows->partner_address, 40, "<br/>", true);
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->partner_name).'</td>
						<td>'.strtoupper($rows->partner_address).'</td>
						<td>'.strtoupper($rows->partner_pan_no).'</td>
					</tr>';
					$sl++;
				}					
				$printContents=$printContents.'</tbody>
			</table>
			</td>
		</tr>
	<tr>
			<td>6. PAN of the industrial unit </td>
			<td> '.strtoupper($pan_no).'</td>
	</tr>
	<tr>
			<td>7. Investment (in Lakh)</td>
			<td> '.strtoupper($investment).'</td>
	</tr>
	<tr>
			<td>8. Total Investment in the unit (In Lakh)</td>
			<td> '.strtoupper($total_invest).'</td>
	</tr>
	<tr>
			<td>9. Investment in the Plant & Machinery (In Lakh)</td>
			<td> '.strtoupper($plant_machinery).'</td>
	</tr>
	<tr>
		<td colspan="2">10. Loan</td>
	</tr>
	<tr>
  		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>												
					<th width="10%"> Sl No</th>	
					<th width="25%"> Name of the Bank/Financial Institutions </th>	
					<th width="20%"> Amount of Term Loan Provided (in Rs.)</th>
					<th width="25%"> Requirement of Working capital (Rs. in lakh)</th>
					<th width="20%"> Working capital limit (Rs. in lakh)</th>
				</tr>
				</thead>';					
					$part1=$dic->query("SELECT * FROM dic_form9_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["bank_name"]).'</td>
						<td>'.strtoupper($row_1["amount_of_term"]).'</td>
						<td>'.strtoupper($row_1["working_capital"]).'</td>
						<td>'.strtoupper($row_1["working_capital_limit"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
  	</tr>
	<tr>
			<td>11. Product/ Sector</td>
			<td> '.strtoupper($s1).'</td>
	</tr>
	<tr>
			<td>12.Registration details </td>
			<td> '.strtoupper($reg_details).'</td>
	</tr>
	<tr>
		<td width="50%" valign="top">13. Permanent (PMT) Registration no with date/ Acknowledgement of IEM no with date/ EM-part-II No. & date </td>
		<td>
			<table width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
						<td width="50%">Registration no</td>
						<td>'.strtoupper($pmt_reg_no).'</td>
				</tr>
				<tr>
						<td>Date</td>
						<td>'.strtoupper($pmt_reg_dt).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>14. Date of going into commercial production</td>
		<td> '.strtoupper($date_of_production).'</td>
	</tr>
	<tr>
			<td>15. Any other incentives/subsidy enjoyed by the unit</td>
			<td> '.strtoupper($other_incentives).'</td>
	</tr>
	<tr>
			<td colspan="2">16. Under NEIPP,97/NEIIPP,2007/TS scheme</td>			
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Incentives/Subsidy under Central Government Policy</th>
					<th width="30%">Amount received in (in Rs.) </th>
					<th width="30%">Year of received</th>
				</tr>
				<tr>
					<td>1</td>
					<td>Central Capital Investment Subsidy</td>
					<td>'.strtoupper($under_neipp_amount1).'</td>
					<td>'.strtoupper($under_neipp_year1).'</td>
				</tr>
				<tr>
					<td>2</td>
					<td>Interest Subsidy on Working Capital</td>
					<td>'.strtoupper($under_neipp_amount2).'</td>
					<td>'.strtoupper($under_neipp_year2).'</td>
				</tr>
				<tr>
					<td>3</td>
					<td>Insurance Subsidy</td>
					<td>'.strtoupper($under_neipp_amount3).'</td>
					<td>'.strtoupper($under_neipp_year3).'</td>
				</tr>
				<tr>
					<td>4</td>
					<td>Transport Subsidy</td>
					<td>'.strtoupper($under_neipp_amount4).'</td>
					<td>'.strtoupper($under_neipp_year4).'</td>
				</tr>
				<tr>
					<td></td>
					<td>Total</td>
					<td>'.strtoupper($total_amount).'</td>
					<td>'.strtoupper($total_year).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">17. Under State Government Policy</td>
	</tr>
	<tr>
  		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Incentives/subsidy</th>
					<th width="30%">Amount received ( in Rs.) </th>
					<th width="30%">Year of received</th>
				</tr>
				</thead>';					
					$part2=$dic->query("SELECT * FROM dic_form9_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["sl_no"]).'</td>
						<td>'.strtoupper($row_2["incentive_name"]).'</td>
						<td>'.strtoupper($row_2["amount"]).'</td>
						<td>'.strtoupper($row_2["year"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
  	</tr>
	<tr>
		<td>18. Registration number under the Transport Subsidy Scheme</td>
		<td>'.strtoupper($transport_regno).'</td>
	</tr>
	<tr>
		<td width="50%">19. Period of validity of Transport subsidy as per TS registration</td>
		<td>
			<table width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="50%">From </td>
					<td>'.strtoupper($period_of_val_f).'</td>
				</tr>
				<tr>
					<td>To </td>
					<td>'.strtoupper($period_of_val_t).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
  		<td valign="top" colspan="2">20. Item/s of production  </td>
	</tr>
	<tr>
  		<td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="25%">Name of the item/s* </th>
					<th width="20%">Annual Installed Capacity* </th>
					<th width="20%">Value (in Rs.)* </th>
					<th width="25%">Capacity as per joint capacity assessment/as mentioned in the acknowledgment of IEM if any.* </th>
				</tr>
				</thead>';					
					$part3=$dic->query("SELECT * FROM dic_form9_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_3["sl_no"]).'</td>
						<td>'.strtoupper($row_3["item_name"]).'</td>
						<td>'.strtoupper($row_3["ins_cap"]).'</td>
						<td>'.strtoupper($row_3["value"]).'</td>
						<td>'.strtoupper($row_3["capacity"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
		</td>
  	</tr>
	<tr>
  		<td valign="top" colspan="2">21. Requirement of Raw Materials  </td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="25%">Name of the Raw material/s* </th>
					<th width="20%">Annual Requirement* </th>
					<th width="20%">Value (in Rs.)* </th>
					<th width="25%">Requirement of Raw materials as per joint capacity assessment/as mentioned in the acknowledgment of IEM if any*</th>
				</tr>
				</thead>';					
					$part4=$dic->query("SELECT * FROM dic_form9_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_4["sl_no"]).'</td>
						<td>'.strtoupper($row_4["raw_material"]).'</td>
						<td>'.strtoupper($row_4["annual_req"]).'</td>
						<td>'.strtoupper($row_4["value"]).'</td>
						<td>'.strtoupper($row_4["joint_capacity"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>	
	<tr>
		<td>22. Total no of employment in the industrial unit</td>
		<td>'.strtoupper($e_n_employee).'</td>
	</tr>
	<tr>
		<td>23. No of Employees as per pay register</td>
		<td>'.strtoupper($no_of_employee).'</td>
	</tr>
	<tr>
		<td>24. No of employees under Contractor</td>
		<td>'.strtoupper($emp_under_contractor).'</td>
	</tr>
	<tr>
		<td>25. TAN no of the unit if any</td>
		<td>'.strtoupper($tan_n_unit).'</td>
	</tr>
	<tr>
		<td>26. Central Excise Registration no if any</td>
		<td>'.strtoupper($central_excise).'</td>
	</tr>
	<tr>
		<td>27. VAT registration of the unit if any</td>
		<td>'.strtoupper($vat_reg).'</td>
	</tr>
	<tr>
  		<td valign="top" colspan="2">28. Statutory amount paid during the period of claim if any</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Item/s</th>
					<th width="30%">Date </th>
					<th width="30%">Amount paid (in Rs.)</th>
				</tr>
				</thead>';					
					$part5=$dic->query("SELECT * FROM dic_form9_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_5["sl_no"]).'</td>
						<td>'.strtoupper($row_5["item"]).'</td>
						<td>'.strtoupper($row_5["date"]).'</td>
						<td>'.strtoupper($row_5["amount"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>	
	<tr>
		<td width="50%" valign="top">29. Power/Electricity </td>
		<td>
			<table width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="50%">Total requirement of Power</td>
					<td>'.strtoupper($power_tot_req).'</td>
				</tr>
				<tr>
					<td>Sanction load (KW)</td>
					<td>'.strtoupper($power_sanction_load).'</td>
				</tr>
				<tr>
					<td>Connected Load (KW)</td>
					<td>'.strtoupper($power_conn_load).'</td>
				</tr>
			</table>
		</td>
	</tr>		
	<tr>
		<td width="50%">30. Claim for the period</td>
		<td>
			<table width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tr>
					<td width="50%">From  '.strtoupper($claim_period_from).'</td>
					<td>To  '.strtoupper($claim_period_to).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td>31. Distance from focal point to nearest Railway Station of the factory (km)</td>
			<td>'.strtoupper($dist_f_focal).'</td>
	</tr>
	<tr>
			<td>32. Distance from the railway station to factory</td>
			<td>'.strtoupper($dist_f_rstation).'</td>
	</tr>
	<tr>
		<td colspan="2">33. Particulars of raw materials imported to the industrial unit from outside the North Eastern Region during the period ( as per Annexure-I)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<tr>
					<th width="10%">Sl no</th>
					<th width="20%">Name of the Raw materials</th>
					<th width="15%">Quantity</th>
					<th width="15%">Value (in Rs.)</th>
					<th width="20%">Transport charges (in Rs.)</th>
					<th width="20%">Transport charges actually paid (in Rs.)</th>
				</tr>
				</thead>';					
					$part6=$dic->query("SELECT * FROM dic_form9_t6 WHERE form_id='$form_id'");
					while($row_6=$part6->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_6["sl_no"]).'</td>
						<td>'.strtoupper($row_6["raw_mat"]).'</td>
						<td>'.strtoupper($row_6["qty"]).'</td>
						<td>'.strtoupper($row_6["value"]).'</td>
						<td>'.strtoupper($row_6["transport_charge"]).'</td>
						<td>'.strtoupper($row_6["transport_charge_paid"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>	
	<tr>
		<td colspan="2">34. Particulars of finished products Exported from '.strtoupper($product_ext_from).' to places outside North Eastern Region ( As per Annexure- III)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="20%">Name of the Finished products 	</th>
					<th width="15%">Quantity exported</th>
					<th width="15%">Value (in Rs.)</th>
					<th width="20%">Transport charges (in Rs.)</th>
					<th width="20%">Transport charges actually paid (in Rs.)</th>
				</tr>
				</thead>';					
					$part7=$dic->query("SELECT * FROM dic_form9_t7 WHERE form_id='$form_id'");
					while($row_7=$part7->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_7["sl_no"]).'</td>
						<td>'.strtoupper($row_7["product_name"]).'</td>
						<td>'.strtoupper($row_7["quantity"]).'</td>
						<td>'.strtoupper($row_7["value"]).'</td>
						<td>'.strtoupper($row_7["transport_charge"]).'</td>
						<td>'.strtoupper($row_7["transport_charge_paid"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>
	<tr>
		<td colspan="2">35. Details of utilization of imported raw materials and manufacture of finished products during the period ( vide Annexure-II)  </td>
	</tr>
	<tr>
		<td colspan="2">(a)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Raw Materials</th>
					<th width="20%">Brought from outside NER during the claim period ( Qty)</th>
					<th width="20%">Actually utilized during the period (Qty)</th>
					<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
				</tr>
				</thead>';					
					$part8=$dic->query("SELECT * FROM dic_form9_t8 WHERE form_id='$form_id'");
					while($row_8=$part8->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_8["sl_no"]).'</td>
						<td>'.strtoupper($row_8["raw_mat"]).'</td>
						<td>'.strtoupper($row_8["outside_qty"]).'</td>
						<td>'.strtoupper($row_8["utilized_qty"]).'</td>
						<td>'.strtoupper($row_8["subsidy_amount"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>
	<tr>
		<td colspan="2">(b)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Finished products</th>
					<th width="20%">Sold outside of NER during the claim period ( Qty)</th>
					<th width="20%">Actually sold during the period (Qty)</th>
					<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
				</tr>
				</thead>';					
					$part9=$dic->query("SELECT * FROM dic_form9_t9 WHERE form_id='$form_id'");
					while($row_9=$part9->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_9["sl_no"]).'</td>
						<td>'.strtoupper($row_9["product_name"]).'</td>
						<td>'.strtoupper($row_9["sold_qty"]).'</td>
						<td>'.strtoupper($row_9["sold_during"]).'</td>
						<td>'.strtoupper($row_9["amount"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>
	<tr>
		<td colspan="2">(c)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Raw Materials</th>
					<th width="20%">Brought within NER during the claim period ( Qty)</th>
					<th width="20%">Actually utilized during the period (Qty)</th>
					<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
				</tr>
				</thead>';					
					$part10=$dic->query("SELECT * FROM dic_form9_t10 WHERE form_id='$form_id'");
					while($row_10=$part10->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_10["sl_no"]).'</td>
						<td>'.strtoupper($row_10["raw_mat"]).'</td>
						<td>'.strtoupper($row_10["within_ner_qty"]).'</td>
						<td>'.strtoupper($row_10["utilized_qty"]).'</td>
						<td>'.strtoupper($row_10["amount"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>
	<tr>
		<td colspan="2">(d)</td>
	</tr>
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>
					<th width="10%">Sl no</th>
					<th width="30%">Name of the Finished products</th>
					<th width="20%">Sold within NER during the claim period ( Qty)</th>
					<th width="20%">Actually sold during the period (Qty)</th>
					<th width="20%">Amount of subsidy admissible as per calculation of the industrial unit (in Rs.)</th>
				</tr>
				</thead>';					
					$part11=$dic->query("SELECT * FROM dic_form9_t11 WHERE form_id='$form_id'");
					while($row_11=$part11->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_11["sl_no"]).'</td>
						<td>'.strtoupper($row_11["product_name"]).'</td>
						<td>'.strtoupper($row_11["sold_ner_qty"]).'</td>
						<td>'.strtoupper($row_11["sold_during"]).'</td>
						<td>'.strtoupper($row_11["amount"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
  	</tr>
	<tr>
			<td width="50%">36. Unit ( electricity) consumed during the claim period</td>
			<td>'.strtoupper($unit_consumed).'</td>
	</tr>
	<tr>
			<td>37. DG set rating during the claim period (if any)</td>
			<td>'.strtoupper($dg_set_rating).'</td>
	</tr>
	<tr>
			<td width="50%">38. Diesel consumed for DG set during the period</td>
			<td>'.strtoupper($diesel_consumed).'</td>
	</tr>
	<tr>
			<td>39. DG unit consumed during the claim period</td>
			<td>'.strtoupper($dg_unit_consumed).'</td>
	</tr>
	<tr>
			<td>40. Total electrical unit consumed during the period ( Electricity from Board + unit consumed from the generator)</td>
			<td>'.strtoupper($total_elec_unit).'</td>
	</tr>
  	</tr>
	<tr>
  		<td valign="top" colspan="2">41. Bank Details where the amount of subsidy to be deposited </td>
	</tr>  
	<tr>
  		<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
				<thead>
				<tr>												
					<th width="30%">Name of the Bank</th>
					<th width="20%">Account No</th>
					<th width="20%">Branch</th>
					<th width="20%">IFSC Code of the Branch</th>
					<th width="20%">MICR Code of the Branch</th>
				</tr>
				</thead>
				<tr>
					<td>'.strtoupper($bank_details_name).'</td>
					<td>'.strtoupper($bank_details_no).'</td>
					<td>'.strtoupper($bank_details_branch).'</td>
					<td>'.strtoupper($bank_details_ifsc).'</td>
					<td>'.strtoupper($bank_details_micr).'</td>
				</tr>
				</table>
			</td>
  	</tr>
	<tr>
				<td valign="top" width="50%"> Date : &nbsp;<b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/>
				Place:&nbsp;<b>'.strtoupper($dist).'</b></td>
				<td align="right"> <b>'.strtoupper($key_person).'</b> <br/> Signature of Applicant</td>
			</tr> 
</table>';
?>