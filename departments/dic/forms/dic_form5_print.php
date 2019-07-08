<?php 
$dept="dic";
$form="5";
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
	
	
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		##### part 1 ######	
		$area_sq_mtr=$results['area_sq_mtr'];$area_project=$results['area_project'];$location=$results['location'];$no_purchase_deed=$results['no_purchase_deed'];
		$reg_purchase_deed=$results['reg_purchase_deed'];
		if($reg_purchase_deed!="" && $reg_purchase_deed!="0000-00-00"){
			$reg_purchase_deed = date('d-m-Y',strtotime($reg_purchase_deed));
		}else{
			$reg_purchase_deed="";
		}
		$premium=$results['premium'];
		$date_possesion=$results['date_possesion'];
		if($date_possesion!="" && $date_possesion!="0000-00-00"){
			$date_possesion = date('d-m-Y',strtotime($date_possesion));
		}else{
			$date_possesion="";
		}
		$lease_duration=$results['lease_duration'];
		if($results['is_implementaion']=="N"){
			$is_implementaion="NO";
		}elseif($results['is_implementaion']=="Y"){
			$is_implementaion="YES";
		}
		if($results['is_owned']=="N"){
			$is_owned="NO";
		}elseif($results['is_owned']=="Y"){
			$is_owned="YES";
		}
		if(!empty($results["act"])){
			$act=json_decode($results["act"]);
			$act_reg_dt=$act->reg_dt;$act_reg_no=$act->reg_no;$act_reg_office=$act->reg_office;
		}else{
			$act_reg_dt="";$act_reg_no="";$act_reg_office="";
		}
		if($act_reg_dt!="" && $act_reg_dt!="0000-00-00"){
			$act_reg_dt = date('d-m-Y',strtotime($act_reg_dt));
		}else{
			$act_reg_dt="";
		}
		if(!empty($results["detail_l"])){
			$detail_l=json_decode($results["detail_l"]);
			$detail_l_dag=$detail_l->dag;$detail_l_patta=$detail_l->patta;$detail_l_rev_vill=$detail_l->rev_vill;$detail_l_mauza=$detail_l->mauza;
		}else{
			$detail_l_dag="";$detail_l_patta="";$detail_l_rev_vill="";$detail_l_mauza="";
		}
		if(!empty($results["provisional"])){
			$provisional=json_decode($results["provisional"]);
			$provisional_reg_dt=$provisional->reg_dt;$provisional_reg_no=$provisional->reg_no;
		}else{
			$provisional_reg_dt="";$provisional_reg_no="";
		}
		if($provisional_reg_dt!="" && $provisional_reg_dt!="0000-00-00"){
			$provisional_reg_dt = date('d-m-Y',strtotime($provisional_reg_dt));
		}else{
			$provisional_reg_dt="";
		}
		if(!empty($results["permanent"])){
			$permanent=json_decode($results["permanent"]);
			$permanent_reg_dt=$permanent->reg_dt;$permanent_reg_no=$permanent->reg_no;
		}else{
			$permanent_reg_dt="";$permanent_reg_no="";
		}
		if($permanent_reg_dt!="" && $permanent_reg_dt!="0000-00-00"){
			$permanent_reg_dt = date('d-m-Y',strtotime($permanent_reg_dt));
		}else{
			$permanent_reg_dt="";
		}
		if(!empty($results["indus"])){
			$indus=json_decode($results["indus"]);
			$indus_reg_dt=$indus->reg_dt;$indus_reg_no=$indus->reg_no;
		}else{
			$indus_reg_dt="";$indus_reg_no="";
		}
		if($indus_reg_dt!="" && $indus_reg_dt!="0000-00-00"){
			$indus_reg_dt = date('d-m-Y',strtotime($indus_reg_dt));
		}else{
			$indus_reg_dt="";
		}
		if(!empty($results["consultant"])){
			$consultant=json_decode($results["consultant"]);
			$consultant_name=$consultant->name;$consultant_sn1=$consultant->sn1;$consultant_sn2=$consultant->sn2;$consultant_vill=$consultant->vill;$consultant_dist=$consultant->dist;$consultant_pincode=$consultant->pincode;$consultant_mobile=$consultant->mobile;$consultant_email=$consultant->email;
		}else{
			$consultant_name="";$consultant_sn1="";$consultant_sn2="";$consultant_vill="";$consultant_dist="";$consultant_pincode="";$consultant_mobile="";$consultant_email="";	
		}
		if(!empty($results["organization"])){
			$organization=json_decode($results["organization"]);
			$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pincode=$organization->pincode;$organization_mobile=$organization->mobile;$organization_email=$organization->email;
		}else{
			$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pincode="";$organization_mobile="";$organization_email="";	
		}
		$start_date_civconstruct=$results['start_date_civconstruct'];
		if($start_date_civconstruct!="" && $start_date_civconstruct!="0000-00-00"){
			$start_date_civconstruct = date('d-m-Y',strtotime($start_date_civconstruct));
		}else{
			$start_date_civconstruct="";
		}
		$end_date_civconstruct=$results['end_date_civconstruct'];
		if($end_date_civconstruct!="" && $end_date_civconstruct!="0000-00-00"){
			$end_date_civconstruct = date('d-m-Y',strtotime($end_date_civconstruct));
		}else{
			$end_date_civconstruct="";
		}
		$tot_area_underconstruct=$results['tot_area_underconstruct'];$tot_cost_construct=$results['tot_cost_construct'];$cost_manufacturing=$results['cost_manufacturing'];$agency_area_covered=$results['agency_area_covered'];$agency_annual_rent=$results['agency_annual_rent'];$agency_regnum=$results['agency_regnum'];
		$agency_regdate=$results['agency_regdate'];
		if($agency_regdate!="" && $agency_regdate!="0000-00-00"){
			$agency_regdate = date('d-m-Y',strtotime($agency_regdate));
		}else{
			$agency_regdate="";
		}
		$agency_loc=$results['agency_loc'];
		$agency_lease_period=$results['agency_lease_period'];
		if($agency_lease_period!="" && $agency_lease_period!="0000-00-00"){
			$agency_lease_period = date('d-m-Y',strtotime($agency_lease_period));
		}else{
			$agency_lease_period="";
		}
		$capital_invest_total=$results['capital_invest_total'];
		if(!empty($results["owner"])){
			$owner=json_decode($results["owner"]);
			$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_vill=$owner->vill;$owner_dist=$owner->dist;$owner_pincode=$owner->pincode;$owner_mobile=$owner->mobile;$owner_email=$owner->email;
		}else{
			$owner_name="";$owner_sn1="";$owner_sn2="";$owner_vill="";$owner_district="";$owner_pincode="";$owner_mobile="";$owner_email="";	
		}
		if(!empty($results["agency"])){
			$agency=json_decode($results["agency"]);
			$agency_name=$agency->name;$agency_sn1=$agency->sn1;$agency_sn2=$agency->sn2;$agency_vill=$agency->vill;$agency_dist=$agency->dist;$agency_pincode=$agency->pincode;$agency_mobile=$agency->mobile;$agency_email=$agency->email;
		}else{
			$agency_name="";$agency_sn1="";$agency_sn2="";$agency_vill="";$agency_dist="";$agency_pincode="";$agency_mobile="";$agency_email="";
		}
		if(!empty($results["reg_auth"])){
			$reg_auth=json_decode($results["reg_auth"]);
			$reg_auth_name=$reg_auth->name;$reg_auth_desig=$reg_auth->desig;$reg_auth_sn1=$reg_auth->sn1;$reg_auth_sn2=$reg_auth->sn2;$reg_auth_vill=$reg_auth->vill;$reg_auth_dist=$reg_auth->dist;$reg_auth_pincode=$reg_auth->pincode;$reg_auth_mobile=$reg_auth->mobile;$reg_auth_email=$reg_auth->email;
		}else{
			$reg_auth_name="";$reg_auth_desig="";$reg_auth_sn1="";$reg_auth_sn2="";$reg_auth_vill="";$reg_auth_dist="";$reg_auth_pincode="";$reg_auth_mobile="";$reg_auth_email="";
		}
		if(!empty($results["rent_auth"])){
			$rent_auth=json_decode($results["rent_auth"]);
			$rent_auth_sn1=$rent_auth->sn1;$rent_auth_sn2=$rent_auth->sn2;$rent_auth_vill=$rent_auth->vill;$rent_auth_dist=$rent_auth->dist;$rent_auth_pincode=$rent_auth->pincode;$rent_auth_mobile=$rent_auth->mobile;$rent_auth_email=$rent_auth->email;
		}else{
			$rent_auth_sn1="";$rent_auth_sn2="";$rent_auth_vill="";$rent_auth_dist="";$rent_auth_pincode="";$rent_auth_mobile="";$rent_auth_email="";
		}
		if(!empty($results["capital_invest"])){
			$capital_invest=json_decode($results["capital_invest"]);
			$capital_invest_land=$capital_invest->land;$capital_invest_site=$capital_invest->site;$capital_invest_factory=$capital_invest->factory;$capital_invest_office=$capital_invest->office;$capital_invest_plant=$capital_invest->plant;$capital_invest_equipment=$capital_invest->equipment;$capital_invest_power=$capital_invest->power;$capital_invest_electrical=$capital_invest->electrical;$capital_invest_utility=$capital_invest->utility;$capital_invest_misc=$capital_invest->misc;$capital_invest_operative=$capital_invest->operative;
		}else{
			$capital_invest_land="";$capital_invest_site="";$capital_invest_factory="";$capital_invest_office="";$capital_invest_plant="";$capital_invest_equipment="";$capital_invest_power="";$capital_invest_electrical="";$capital_invest_utility="";$capital_invest_misc="";$capital_invest_operative="";
		}
	}
		#### PART II #####
		$q2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_part1 where form_id='$form_id'");
		
		if($q2->num_rows>0){
			$results2=$q2->fetch_assoc();
			$pow_line_expen=$results2['pow_line_expen'];$dg_details=$results2['dg_details'];$dg_make=$results2['dg_make'];$dg_rating=$results2['dg_rating'];$cost_of_dgset=$results2['cost_of_dgset'];
			$installation_date=$results2['installation_date'];
			
			if($installation_date!="" && $installation_date!="0000-00-00"){
				$installation_date = date('d-m-Y',strtotime($installation_date));
			}else{
				$installation_date="";
			}
			$sources_f_finance_total=$results2['sources_f_finance_total'];
			if(!empty($results2["sources_f_finance"])){
				$sources_f_finance=json_decode($results2["sources_f_finance"]);
				$sources_f_finance_a=$sources_f_finance->a;$sources_f_finance_b=$sources_f_finance->b;$sources_f_finance_c=$sources_f_finance->c;$sources_f_finance_d=$sources_f_finance->d;$sources_f_finance_e=$sources_f_finance->e;
			}else{
				$sources_f_finance_a="";$sources_f_finance_b="";$sources_f_finance_c="";$sources_f_finance_d="";$sources_f_finance_e="";
			}
			if(!empty($results2["financial_details"])){
				$financial_details=json_decode($results2["financial_details"]);
				$financial_details_name=$financial_details->name;$financial_details_term=$financial_details->term;$financial_details_margin=$financial_details->margin;$financial_details_t_loan=$financial_details->t_loan;$financial_details_rate=$financial_details->rate;$financial_details_schedule=$financial_details->schedule;$financial_details_schedule=$financial_details->schedule;$financial_details_d1=$financial_details->d1;$financial_details_d2=$financial_details->d2;
			}else{
				$financial_details_name="";$financial_details_term="";$financial_details_margin="";$financial_details_t_loan="";$financial_details_rate="";$financial_details_schedule="";$financial_details_d1="";$financial_details_d2="";
			}
			if(!empty($results2["aseb"])){
				$aseb=json_decode($results2["aseb"]);
				$aseb_bill_no=$aseb->bill_no;$aseb_bill_date=$aseb->bill_date;$aseb_mr_no=$aseb->mr_no;$aseb_date_payment=$aseb->date_payment;
			}else{
				$aseb_bill_no="";$aseb_bill_date="";$aseb_mr_no="";$aseb_date_payment="";
			}
			if($aseb_bill_date!="" && $aseb_bill_date!="0000-00-00"){
				$aseb_bill_date = date('d-m-Y',strtotime($aseb_bill_date));
			}else{
				$aseb_bill_date="";
			}
			if($aseb_date_payment!="" && $aseb_date_payment!="0000-00-00"){
				$aseb_date_payment = date('d-m-Y',strtotime($aseb_date_payment));
			}else{
				$aseb_date_payment="";
			}
			if(!empty($results2["details_f_power"])){
				$details_f_power=json_decode($results2["details_f_power"]);
				$details_f_power_qtm=$details_f_power->qtm;$details_f_power_lno=$details_f_power->lno;$details_f_power_dt=$details_f_power->dt;$details_f_power_con_load=$details_f_power->con_load;$details_f_power_con_dt=$details_f_power->con_dt;$details_f_power_sl_no=$details_f_power->sl_no;$details_f_power_es_amt=$details_f_power->es_amt;
			}else{
				$details_f_power_qtm="";$details_f_power_lno="";$details_f_power_dt="";$details_f_power_con_load="";$details_f_power_con_dt="";$details_f_power_sl_no="";$details_f_power_es_amt="";
			}
			if($details_f_power_dt!="" && $details_f_power_dt!="0000-00-00"){
				$details_f_power_dt = date('d-m-Y',strtotime($details_f_power_dt));
			}else{
				$details_f_power_dt="";
			}
			if($details_f_power_con_dt!="" && $details_f_power_con_dt!="0000-00-00"){
				$details_f_power_con_dt = date('d-m-Y',strtotime($details_f_power_con_dt));
			}else{
				$details_f_power_con_dt="";
			}
			$date_comm_prod=$results2['date_comm_prod'];
			if($date_comm_prod!="" && $date_comm_prod!="0000-00-00"){
				$date_comm_prod = date('d-m-Y',strtotime($date_comm_prod));
			}else{
				$date_comm_prod="";
			}
			$details_prod=$results2['details_prod'];$total_assam=$results2['total_assam'];$total_outsiders=$results2['total_outsiders'];$gross_total=$results2['gross_total'];$gross_remarks=$results2['gross_remarks'];$utilized_mandays=$results2['utilized_mandays'];
			if(!empty($results2["managerial"])){
				$managerial=json_decode($results2["managerial"]);
				$managerial_assam=$managerial->assam;$managerial_outsiders=$managerial->outsiders;$managerial_total=$managerial->total;$managerial_remarks=$managerial->remarks;
			}else{
				$managerial_assam="";$managerial_outsiders="";$managerial_total="";$managerial_remarks="";
			}
			if(!empty($results2["supervisory"])){
				$supervisory =json_decode($results2["supervisory"]);
				$supervisory_assam=$supervisory->assam;$supervisory_outsiders=$supervisory->outsiders;$supervisory_total=$supervisory->total;$supervisory_remarks=$supervisory->remarks;
			}else{
				$supervisory_assam="";$supervisory_outsiders="";$supervisory_total="";$supervisory_remarks="";
			}
			if(!empty($results2["skilled"])){
				$skilled =json_decode($results2["skilled"]);
				$skilled_assam=$skilled->assam;$skilled_outsiders=$skilled->outsiders;$skilled_total=$skilled->total;$skilled_remarks=$skilled->remarks;
			}else{
				$skilled_assam="";$skilled_outsiders="";$skilled_total="";$skilled_remarks="";
			}
			if(!empty($results2["semi_skilled"])){
				$semi_skilled =json_decode($results2["semi_skilled"]);
				$semi_skilled_assam=$semi_skilled ->assam;$semi_skilled_outsiders=$semi_skilled->outsiders;$semi_skilled_total=$semi_skilled->total;$semi_skilled_remarks=$semi_skilled->remarks;
			}else{
				$semi_skilled_assam="";$semi_skilled_outsiders="";$semi_skilled_total="";$semi_skilled_remarks="";
			}
			if(!empty($results2["unskilled"])){
				$unskilled =json_decode($results2["unskilled"]);
				$unskilled_assam=$unskilled->assam;$unskilled_outsiders=$unskilled->outsiders;$unskilled_total=$unskilled->total;$unskilled_remarks=$unskilled->remarks;
			}else{
				$unskilled_assam="";$unskilled_outsiders="";$unskilled_total="";$unskilled_remarks="";
			}
		}
	
    $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
	if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>Form '.$form.'</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
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
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
		</div>
		<br/>
      <table class="table table-bordered table-responsive">
  		<tr>  				
			<td valign="top">1. (a) Name of the Industrial unit  :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>  				
			<td valign="top" style="text-indent:14px;">  (b) PAN no of the unit :</td>
			<td>'.strtoupper($pan_no).'</td>
		</tr>
		<tr>
			<td valign="top" style="text-indent:14px;">(c)Factory address :  </td>
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
						<td>Village/Town</td>
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
						<td>Mobile</td>
						<td>+91 - '.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Email-id</td>
						<td> '.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">2. (a) Constitution of the organization promoting the unit (Whether Proprietorial / partnership / Private Limited / Limited company / Cooperative Society/trust/any other legal entity ) :</td>
			<td valign="top"> '.strtoupper($l_o_business_val).'</td>
		</tr>
		<tr>
			<td colspan="2" style="text-indent:14px;"> (b) Name(s) , Permanent address(es) of the Proprietor/ Partners / Directors/ Secretary / President /chairman/CEO/Trustee etc with the mention of their permanent Account No (PAN) :  </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<td align="center">Sl No</td>
						<td align="center">Partners/Directors Name</td>
						<td align="center">Street Name 1</td>
						<td align="center">Street Name 2</td>
						<td align="center">Village/Town</td>
						<td align="center"> District</td>
						<td align="center">Pincode</td>
						<td align="center">PAN No.</td>
					</tr>';
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
								<td>'.strtoupper($rows->pan).'</td>
						</tr>';
						$sl++;
						}$printContents=$printContents.'
				 </table> 
			</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(c) No and date of Registration under the concerned Act (e.g Companies act, partnership act etc.)  : </td>
			<td>Registration Number : '.strtoupper($act_reg_no).'<br/>
				 Registration Date  : '.strtoupper($act_reg_dt).'
			</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(d) Registered Head Office of the promoter organization : </td>
			<td>'.strtoupper($act_reg_office).'</td>
		</tr>
		<tr>
			<td colspan="2"> 3.Details of registration of the unit :  </td>
		</tr>
		<tr>
			<td colspan="2">(a)Micro & Small Scale  :  </td>
		</tr>
		<tr>
			<td>(i) Provisional Registration no and date/EM part-I acknowledgement No and date : </td>
			<td>Registration Number : '.strtoupper($provisional_reg_no).'<br/>
		         Registration Date  : '.strtoupper($provisional_reg_dt).'
			</td>
		</tr>
		<tr>
			<td>(ii) Permanent Registration no and date/EM part-II acknowledgement No and date : </td>
			<td>Registration Number: '.strtoupper($permanent_reg_no).'<br/>
		         Registration Date  : '.strtoupper($permanent_reg_dt).'
			</td>
		</tr>
		<tr>
			<td colspan="2">(b) Medium and Large : </td>
		</tr>
		<tr>
			<td> i)No and date of Industrial License/Letter of Intent/Industrial Entrepreneurs Memorandum (IEM) / Entrepreneurs Memorandum (EM) prior to and after commencement of commercial production/service with uptodate amendments.: </td>
			<td>Registration Number : '.strtoupper($indus_reg_no).'<br/>
		         Registration Date  : '.strtoupper($indus_reg_dt).'
			</td>
		</tr>
		<tr>
			<td valign="top">4. (a) Name and address of the consultant who prepared the Project Feasibility Report:   </td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Name </td>
						<td>'.strtoupper($consultant_name).'</td>
					</tr>
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($consultant_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($consultant_sn2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($consultant_vill).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($consultant_dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($consultant_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($consultant_mobile).'</td>
					</tr>
					<tr>
						<td>Email-id</td>
						<td> '.$consultant_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
	<tr>
  		<td valign="top">(b) Name &amp; address of the organization which provided technical knowhow/agency which certified quality of its product(s):   </td>
  		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Name</td>
					<td>'.strtoupper($organization_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($organization_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($organization_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($organization_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($organization_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($organization_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($organization_mobile).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td>'.$organization_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(c) Whether implementation of the project has been envisaged in phased manner and if so, approximate percentage of investment in the first phase till date of submission of EC application: </td>
		<td>'.strtoupper($is_implementaion).'</td>
	</tr>
	<tr>
	  <td colspan="2">5. Details of Land : </td>
	</tr>
	<tr>
		<td>I. Whether the land is owned/leased hold from private party/slotted by the Government/Government agency : </td>
		<td>'.strtoupper($is_owned).'</td>
	</tr>
	<tr>
		<td>II. (a) Total Area (sq mtr)</td> 
		<td>'.strtoupper($area_sq_mtr).'</td>
	</tr>
	<tr>
		<td>(b) Area under use for the project :</td>
		<td>'.strtoupper($area_project).'</td>
	</tr>
	<tr>
		<td>III. Location</td>
		<td>'.strtoupper($location).'</td>
	</tr>
	<tr>
		<td valign="top">IV. Dag no, Patta no, Revenue village and Mauza : </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>(a) Dag no</td>
					<td>'.strtoupper($detail_l_dag).'</td>
				</tr>
				<tr>
					<td>(b) Patta no</td>
					<td>'.strtoupper($detail_l_patta).'</td>
				</tr>
				<tr>
					<td>(c) Revenue village</td>
					<td>'.strtoupper($detail_l_rev_vill).'</td>
				</tr>
				<tr>
					<td>(d) Mauza</td>
					<td>'.strtoupper($detail_l_mauza).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
  		<td valign="top">V. Name &amp; address of the present owner of land/Lessor/Govt agency allotting land :  </td>
  		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Name</td>
					<td>'.strtoupper($owner_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($owner_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($owner_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($owner_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($owner_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($owner_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($owner_mobile).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td> '.$owner_email.'</td>
				</tr>
    		</table>
	   </td>
  	</tr>
	<tr>
		<td valign="top">VI. No and date of registration of the purchase deed/lease deed and name, designation & address of the registering authority  : </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Registration Number</td>
					<td>'.strtoupper($no_purchase_deed).'</td>
				</tr>
				<tr>
					<td>Registration Date</td>
					<td>'.strtoupper($reg_purchase_deed).'</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>'.strtoupper($reg_auth_name).'</td>
				</tr>
				<tr>
					<td>Designation</td>
					<td>'.strtoupper($reg_auth_desig).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($reg_auth_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($reg_auth_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($reg_auth_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($reg_auth_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($reg_auth_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($reg_auth_mobile).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td> '.$reg_auth_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>VII. Purchase price, registration fee and stamp duty/ annual lease rent payable/ one time premium paid :</td>
		<td>'.strtoupper($premium).'</td>
	</tr>
	<tr>
		<td>VIII. The date of taking over possession of land :</td>
		<td>'.strtoupper($date_possesion).'</td>
	</tr>
	<tr>
		<td>IX. Duration of lease (in year/s) :</td>
		<td>'.strtoupper($lease_duration).'</td>
	</tr>
	<tr>
	  <td colspan="2">6. Details of building :</td>
	</tr>
	<tr>
		<td valign="top">I.If the building has been constructed  : </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>(a) Date of starting of the civil construction</td>
					<td>'.strtoupper($start_date_civconstruct).'</td>
				</tr>
				<tr>
					<td>(b) Date of completion of the civil construction works</td>
					<td>'.strtoupper($end_date_civconstruct).'</td>
				</tr>
				<tr>
					<td>(c) Total area under construction</td>
					<td>'.strtoupper($tot_area_underconstruct).'</td>
				</tr>
				<tr>
					<td>(d) Total cost of construction, site development etc </td>
					<td>'.strtoupper($tot_cost_construct).'</td>
				</tr>
				<tr>
					<td>(e) Cost of construction and area of the building connected directly to manufacturing process/service rendered </td>
					<td>'.strtoupper($cost_manufacturing).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">II. If the building has been allotted by the Government agency/taken on rent from private party:</td>
	</tr>
	<tr>
		<td valign="top">(a) Name &amp; address of the Govt agency / land lord</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Name of Govt Agency</td>
					<td>'.strtoupper($agency_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($agency_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($agency_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($agency_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($agency_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($agency_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile No.</td>
					<td>'.strtoupper($agency_mobile).'</td>
				</tr>
				<tr>
					<td>E-Mail ID</td>
					<td>'.$agency_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(b) Total covered area : </td>
		<td>'.strtoupper($agency_area_covered).'</td>
	</tr>
	<tr>
		<td>(c) Annual rent :</td>
		<td>'.strtoupper($agency_annual_rent).'</td>
	</tr>
	<tr>
		<td valign="top">(d) No & date of registration of the rent agreement/lease deed and address of the registering authority :</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Registration Number</td>
					<td>'.strtoupper($agency_regnum).'</td>
				</tr>
				<tr>
					<td>Registration Date</td>
					<td>'.strtoupper($agency_regdate).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($rent_auth_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($rent_auth_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($rent_auth_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($rent_auth_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($rent_auth_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($rent_auth_mobile).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td> '.$rent_auth_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(e) Location :</td>
		<td>'.strtoupper($agency_loc).'</td>
	</tr>
	<tr>
		<td>(f) Period of validity of rent agreement/lease deed:</td>
		<td>'.strtoupper($agency_lease_period).'</td>
	</tr>
	<tr>
 		<td  colspan="2">7. Details of Capital Investment (gross value in Rupees) :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
				<tr>
					<th>Sl no.</th>
					<th>Item of fixed assets</th>
					<th width="45%">Value in Rupees</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>a.</td>
						<td>Land </td>
						<td>'.strtoupper($capital_invest_land).'</td>
					</tr>
					<tr>
						<td>b.</td>
						<td>Site development </td>
						<td>'.strtoupper($capital_invest_site).'</td>
					</tr>
					<tr>
						<td>c.</td>
						<td colspan="2">Building </td>
					</tr>
					<tr>
						<td rowspan="2"></td>
						<td>i) Factory/Institutional building and other civil construction works directly connected to process of manufacture/service rendered  </td>
						<td>'.strtoupper($capital_invest_factory).'</td>
					</tr>
					<tr>
						<td>ii) Office building, labour quarter etc no directly connected to process of manufacture/ service rendered (ineligible building) </td>
						<td>'.strtoupper($capital_invest_office).'</td>
					</tr>
					<tr>
						<td>d.</td>
						<td>Plant and Machinery </td>
						<td>'.strtoupper($capital_invest_plant).'</td>
					</tr>
					<tr>
						<td>e.</td>
						<td>Equipment, accessories, components & fittings etc </td>
						<td>'.strtoupper($capital_invest_equipment).'</td>
					</tr>
					<tr>
						<td>f.</td>
						<td>Drawal of Power line </td>
						<td>'.strtoupper($capital_invest_power).'</td>
					</tr>
					<tr>
						<td>g.</td>
						<td>Electrical Installation other than drawal of power line </td>
						<td>'.strtoupper($capital_invest_electrical).'</td>
					</tr>
					<tr>
						<td>h.</td>
						<td>Utility installation other than electrical power </td>
						<td>'.strtoupper($capital_invest_utility).'</td>
					</tr>
					<tr>
						<td>i.</td>
						<td>Miscellaneous fixed assets ( in details) </td>
						<td>'.strtoupper($capital_invest_misc).'</td>
					</tr>
					<tr>
						<td>j.</td>
						<td>Preliminary and preoperative expenses capitalised </td>
						<td>'.strtoupper($capital_invest_operative).'</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>Total </td>
						<td>'.strtoupper($capital_invest_total).'</td>
					</tr>
				</tbody>
    		</table>
	   </td>
  	</tr>
	<tr>
		<td colspan="2">8. Source of Finance</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive"> 
				<tr>
					<td>Sl no.</td>
					<td>Source of Finance</td>
					<td  width="45%">In Rupees</td>
				</tr>
				<tr>
					<td>a.</td>
					<td>Promoters contribution</td>
					<td>'.strtoupper($sources_f_finance_a).'</td>
				</tr>
				<tr>
					<td>b.</td>
					<td>Govt contribution as seed money/share capital etc</td>
					<td>'.strtoupper($sources_f_finance_b).'</td>
				</tr>
				<tr>
					<td>c.</td>
					<td>Borrowing from Bank/Financial Institution </td>
					<td>'.strtoupper($sources_f_finance_c).'</td>
				</tr>
				<tr>
					<td>d. </td>
					<td>Un secured loan/private finance </td>
					<td>'.strtoupper($sources_f_finance_d).'</td>
				</tr>
				<tr>
					<td>e.</td>
					<td>Any other sources </td>
					<td>'.strtoupper($sources_f_finance_e).'</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>Total </td>
					<td>'.strtoupper($sources_f_finance_total).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">9.</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive"> 
				<tr>
					<td>Sl no.</td>
					<td>Details of financial assistance received from Bank/Financial Institution/Govt organization etc.</td>
					<td width="45%">In Rupees</td>
				</tr>
				<tr>
					<td>a.</td>
					<td>Name(s) of the Financial Institution(s):</td>
					<td>'.strtoupper($financial_details_name).'</td>
				</tr>
				<tr>
					<td rowspan="3" valign="top">b.</td>
					<td>Amount sanctioned as :</td>
				</tr>
				<tr>
					<td>(i) Term Loan :</td>
					<td>'.strtoupper($financial_details_term).'</td>
				</tr>
				<tr>
					<td>(ii) WC/OD/CC/OCC/Margin money contribution etc :</td>
					<td>'.strtoupper($financial_details_margin).'</td>
				</tr>
				<tr>
					<td rowspan="3" valign="top">c.</td>
					<td>(i) Term Loan disbursed till date of application :</td>
					<td>'.strtoupper($financial_details_t_loan).'</td>
				</tr>
				<tr>
					<td>(ii) Rate of Interest on TL pa :</td>
					<td>'.strtoupper($financial_details_rate).'</td>
				</tr>
				<tr>
					<td>(iii) Schedule of Repayment of TL( showing principal amount, Interest etc separately ) :</td>
					<td>'.strtoupper($financial_details_schedule).'</td>
				</tr>
				<tr>
					<td rowspan="3" valign="top">d.</td>
					<td colspan="2">Letter no & date of sanction of loan as  :</td>
				</tr>
				<tr>
					<td>(i) Term Loan :</td>
					<td>'.strtoupper($financial_details_d1).'</td>
				</tr>
				<tr>
					<td>(ii) Working Capital etc :</td>
					<td>'.strtoupper($financial_details_d2).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">10.
			<table class="table table-bordered table-responsive"> 
				<tr>
					<td>Sl no.</td>
					<td>Details of Power connection.</td>
					<td  width="45%">In Rupees</td>
				</tr>
				<tr>
					<td rowspan="4" valign="top">a.</td>
					<td>Quantum, letter no and date of sanction:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Quantum</td>
					<td>'.strtoupper($details_f_power_qtm).'</td>
				</tr>
				<tr>
					<td>Letter no</td>
					<td>'.strtoupper($details_f_power_lno).'</td>
				</tr>
				<tr>
					<td>Date of sanction</td>
					<td>'.strtoupper($details_f_power_dt).'</td>
				</tr>
				<tr>
					<td rowspan="3" valign="top">b.</td>
					<td>Connected electrical load and date of connection of power:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>Connected electrical load</td>
					<td>'.strtoupper($details_f_power_con_load).'</td>
				</tr>
				<tr>
					<td>Date of connection of power</td>
					<td>'.strtoupper($details_f_power_con_dt).'</td>
				</tr>
				<tr>
					<td>c.</td>
					<td>Serial no of energy meter(s) connected :</td>
					<td>'.strtoupper($details_f_power_sl_no).'</td>
				</tr>
				<tr>
					<td>d.</td>
					<td>Estimated amount of ASEB for power connection with MR no and date of payment :</td>
					<td>'.strtoupper($details_f_power_es_amt).'</td>
				</tr>
				<tr>
					<td rowspan="5" valign="top">e. </td>
					<td>First ASEB Bill:</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>i) Bill no and Date :</td>
					<td>'.strtoupper($aseb_bill_no).'</td>
				</tr>
				<tr>
					<td>ii) Bill Date </td>
					<td>'.strtoupper($aseb_bill_date).'</td>
				</tr>
				<tr>
					<td>iii) MR no.</td>
					<td>'.strtoupper($aseb_mr_no).'</td>
				</tr>
				<tr>
					<td>iv) Date of payment </td>
					<td>'.strtoupper($aseb_date_payment).'</td>
				</tr>
				<tr>
					<td>f.</td>
					<td>Total expenditure incurred for drawal of power line upto premises of the factory building ( excluding load security deposited to ASEB)  :</td>
					<td>'.strtoupper($pow_line_expen).'</td>
				</tr>
				<tr>
					<td rowspan="5" valign="top">g.</td>
					<td>Details of DG installed, with rating:</td>
					<td>'.strtoupper($dg_details).'</td>
				</tr>
				<tr>
					<td>(a) Make :</td>
					<td>'.strtoupper($dg_make).'</td>
				</tr>
				<tr>
					<td>(b)Rating :</td>
					<td>'.strtoupper($dg_rating).'</td>
				</tr>
				<tr>
					<td>(c)Cost of the DG set :</td>
					<td>'.strtoupper($cost_of_dgset).'</td>
				</tr>
				<tr>
					<td>(d)Date of installation :</td>
					<td>'.strtoupper($installation_date).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>11. Date of commencement of commercial production / service rendered :</td>
		<td>'.strtoupper($date_comm_prod).'</td>
	</tr>
	<tr>
		<td>12. Details of the production/service rendered :</td>
		<td>'.strtoupper($details_prod).'</td>
	</tr>
	<tr>
		<td colspan="2"> 
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Sl No</td>
					<td>Items</td>
					<td colspan="2">Annual Installed capacity</td>
					<td colspan="2">Actual performance during the last accounting year/since the date of commencement of production /service to the date of submission of the application</td>
					<td>Remark</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>Quantity</td>
					<td>Value (in Rupees)</td>
					<td>Quantity</td>
					<td>Value in Rupees</td>
					<td></td>
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_1["slno"]).'</td>
					<td>'.strtoupper($row_1["items"]).'</td>
					<td>'.strtoupper($row_1["annual_quantity"]).'</td>
					<td>'.strtoupper($row_1["annual_rupees"]).'</td>
					<td>'.strtoupper($row_1["actual_quantity"]).'</td>
					<td>'.strtoupper($row_1["actual_rupees"]).'</td>
					<td>'.strtoupper($row_1["remark"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">13. Raw Materials/consumables  :  <br/>
				(a) Utilisation of materials </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Sl No</td>
					<td>Items</td>
					<td colspan="2">Annual requirement</td>
					<td colspan="2">Utilisation during the last accounting year/since the date of commencement of production /service to the date of submission of the application</td>
					<td>Remark</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
				   <td>Quantity</td>
				   <td>Value (in Rupees)</td>
				   <td>Quantity</td>
				   <td>Value in Rupees</td>
				   <td></td>
				</tr>';
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_2["slno"]).'</td>
					<td>'.strtoupper($row_2["items"]).'</td>
					<td>'.strtoupper($row_2["annual_quantity"]).'</td>
					<td>'.strtoupper($row_2["annual_rupees"]).'</td>
					<td>'.strtoupper($row_2["utlised_quantity"]).'</td>
					<td>'.strtoupper($row_2["utlised_rupees"]).'</td>
					<td>'.strtoupper($row_2["remark"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"> (b) Source(s) of materials :
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th rowspan="2">Sl No</th>
						<th rowspan="2">Items</th>
						<th rowspan="2">Whether the source of supply is within Assam/out side Assam</th>
						<th colspan="2">Name and address of the supplier of principal raw materials/consumables</th>
					</tr>
					<tr>
						<th>Name</th>
						<th>Address</th>
					</tr>
				</thead>
				';
				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				while($row_3=$part3->fetch_array()){
				$printContents=$printContents.'
				<tr>
					<td>'.strtoupper($row_3["slno"]).'</td>
					<td>'.strtoupper($row_3["item"]).'</td>
					<td>'.strtoupper($row_3["source"]).'</td>
					<td>'.strtoupper($row_3["name"]).'</td>
					<td>'.strtoupper($row_3["address"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">14. Details of Sale of finished product(s)/Service(s) rendered  :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th rowspan="3">Sl No</th>
						<th rowspan="3">Items</th>
						<th colspan="4" width="45%">Product(s)/Service(s) sold during the last accounting year/since the date of commencement of commercial production/service to the date of submission of application</th>
						<th rowspan="3">Remark</th>
					</tr>
					<tr>
						<th colspan="2">Within the State of Assam</th>
						<th colspan="2">Outside the State of Assam</th>
					</tr>
					<tr>
					   <th align="center">Quantity</th>
					   <th align="center">Value (in Rupees)</th>
					   <th align="center">Quantity</th>
					   <th align="center">Value in Rupees</th>
					</tr>';
					$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_4["slno"]).'</td>
						<td>'.strtoupper($row_4["item"]).'</td>
						<td>'.strtoupper($row_4["within_assam_quantity"]).'</td>
						<td>'.strtoupper($row_4["within_assam_rupees"]).'</td>
						<td>'.strtoupper($row_4["outside_assam_quantity"]).'</td>
						<td>'.strtoupper($row_4["outside_assam_rupees"]).'</td>
						<td>'.strtoupper($row_4["remarks"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</thead>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">15. Employment generation<br/>
		(a)Regular employment</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Sl no. </td>
					<td>Category</td>
					<td colspan="2">No of employees, who are </td>
					<td>Total </td>
					<td>Remarks  </td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>People of Assam </td>
					<td>People not belonging to Assam  </td>
				</tr>
				<tr>
					<td>I</td>
					<td>Managerial    </td>
					<td>'.strtoupper($managerial_assam).'</td>
					<td>'.strtoupper($managerial_outsiders).'</td>
					<td>'.strtoupper($managerial_total).'</td>
					<td>'.strtoupper($managerial_remarks).'</td>
				</tr>
				<tr>
					<td>II</td>
					<td>Supervisory </td>
					<td>'.strtoupper($supervisory_assam).'</td>
					<td>'.strtoupper($supervisory_outsiders).'</td>
					<td>'.strtoupper($supervisory_total).'</td>
					<td>'.strtoupper($supervisory_remarks).'</td>
				</tr>
				<tr>
					<td>III  </td>
					<td>Skilled</td>
					<td>'.strtoupper($skilled_assam).'</td>
					<td>'.strtoupper($skilled_outsiders).'</td>
					<td>'.strtoupper($skilled_total).'</td>
					<td>'.strtoupper($skilled_remarks).'</td>
				</tr>
				<tr>
					<td> IV</td>
					<td>Semi-Skilled </td>
					<td>'.strtoupper($semi_skilled_assam).'</td>
					<td>'.strtoupper($semi_skilled_outsiders).'</td>
					<td>'.strtoupper($semi_skilled_total).'</td>
					<td>'.strtoupper($semi_skilled_remarks).'</td>
				
				</tr>
				<tr>
					<td>V  </td>
					<td>Unskilled & others    </td>
					<td>'.strtoupper($unskilled_assam).'</td>
					<td>'.strtoupper($unskilled_outsiders).'</td>
					<td>'.strtoupper($unskilled_total).'</td>
					<td>'.strtoupper($unskilled_remarks).'</td>
				</tr>
					<tr>
						<td colspan="2">Total </td>
						<td>'.strtoupper($total_assam).'</td>
						<td>'.strtoupper($total_outsiders).'</td>
						<td>'.strtoupper($gross_total).'</td>
						<td>'.strtoupper($gross_remarks).'</td>
					</tr>
				</table>
			</td>
		</tr>								
		<tr>
			<td colspan="2">(b) Casual employment </td>
		</tr>
		<tr>
			<td>(i) Average mandays utilized per month :</td>
			<td>'.strtoupper($utilized_mandays).'</td>
		</tr>
		<tr>
			<td colspan="2">16.Incentives applied for  :</td>
		</tr>
		<tr>
			<td colspan="2">
			<table width="100%" border="1" class="table table-bordered text-center table-resposive" style="border-collapse: collapse">
			<tbody>
				<tr>
					<td align="center">Sl No</td>
					<td align="center">Name of the incentive(s) </td>
					<td width="45%" align="center">Remarks</td>
				</tr>';
					$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_5["slno"]).'</td>
						<td>'.strtoupper($row_5["name"]).'</td>
						<td>'.strtoupper($row_5["quantity"]).'</td>
					</tr>';
					}$printContents=$printContents.'
                    </tbody>
				</table>
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
			<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
		</tr>
	</table>';
?>