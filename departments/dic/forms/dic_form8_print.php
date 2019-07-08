<?php 
$dept="dic";
$form="8";
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
		
		###### PART I #####
		$claim_period_form=$results['claim_period_form'];
		if($claim_period_form!="" && $claim_period_form!="0000-00-00"){
			$claim_period_form = date('d-m-Y',strtotime($claim_period_form));
		}else{
			$claim_period_form="";
		}
		$claim_period_to=$results['claim_period_to'];
		if($claim_period_to!="" && $claim_period_to!="0000-00-00"){
			$claim_period_to = date('d-m-Y',strtotime($claim_period_to));
		}else{
			$claim_period_to="";
		}
		$item_of_product=$results['item_of_product'];$promoters_name=$results['promoters_name'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		if(!empty($results["promoters_address"])){
			$promoters_address=json_decode($results["promoters_address"]);
			$promoters_address_st1=$promoters_address->st1;$promoters_address_st2=$promoters_address->st2;$promoters_address_vt=$promoters_address->vt;$promoters_address_dist=$promoters_address->dist;$promoters_address_pin=$promoters_address->pin;$promoters_address_mob=$promoters_address->mob;
		}else{
			$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";
		}
		###### PART II #####
		$date_of_comm=$results['date_of_comm'];
		if($date_of_comm!="" && $date_of_comm!="0000-00-00"){
			$date_of_comm = date('d-m-Y',strtotime($date_of_comm));
		}else{
			$date_of_comm="";
		}
		$date_of_service=$results['date_of_service'];
		if($date_of_service!="" && $date_of_service!="0000-00-00"){
			$date_of_service = date('d-m-Y',strtotime($date_of_service));
		}else{
			$date_of_service="";
		}
		$cert_no=$results['cert_no'];
		$cert_date=$results['cert_date'];
		if($cert_date!="" && $cert_date!="0000-00-00"){
			$cert_date = date('d-m-Y',strtotime($cert_date));
		}else{
			$cert_date="";
		}		
		$period_from=$results['period_from'];
		if($period_from!="" && $period_from!="0000-00-00"){
			$period_from = date('d-m-Y',strtotime($period_from));
		}else{
			$period_from="";
		}		
		$period_to=$results['period_to'];
		if($period_to!="" && $period_to!="0000-00-00"){
			$period_to = date('d-m-Y',strtotime($period_to));
		}else{
			$period_to="";
		}		
		$percentage_of_increase=$results['percentage_of_increase'];
		if(!empty($results["new_unit"])){
			$new_unit=json_decode($results["new_unit"]);
			$new_unit_sanction=$new_unit->sanction;$new_unit_dt=$new_unit->dt;$new_unit_load=$new_unit->load;$new_unit_sl_no=$new_unit->sl_no;$new_unit_initial_meter=$new_unit->initial_meter;
		}else{
			$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
		}
		if($new_unit_dt!="" && $new_unit_dt!="0000-00-00"){
			$new_unit_dt = date('d-m-Y',strtotime($new_unit_dt));
		}else{
			$new_unit_dt="";
		}
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_power=$exist_unit->power;$exist_unit_load=$exist_unit->load;$exist_unit_tot_load=$exist_unit->tot_load;$exist_unit_sl_no=$exist_unit->sl_no;$exist_unit_initial_meter=$exist_unit->initial_meter;$exist_unit_last_meter=$exist_unit->last_meter;
		}else{
			$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
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
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>  				
				<td  width="50%">1. Name of the Unit:</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>  				
				<td>PAN</td>
				<td>'.strtoupper($pan_no).'</td>
			</tr> 
			<tr>
				<td>a). Address of the Factory  : </td>
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
							<td>Mobile No.</td>
							<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>(b) Address of the Office :  </td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($office_address_st1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($office_address_st2).'</td>
					</tr>
					<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($office_address_vt).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($office_address_dist).'</td>
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
							<td>E-mail ID</td>
							<td>'.($office_address_email).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>2. Period of Claim :   </td> 		
				<td>From: '.strtoupper($claim_period_form).'<br/>
				To: '.strtoupper($claim_period_to).'</td>      		
			</tr>
			<tr>
				<td>3. Name & Address of the promoter(s) :</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>(a)Name</td>
						<td>'.strtoupper($promoters_name).'</td>
					</tr>
					<tr>
						<td colspan="2">(b) Address</td>
					</tr> 
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($promoters_address_st1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($promoters_address_st2).'</td>
					</tr>
					<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($promoters_address_vt).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($promoters_address_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($promoters_address_pin).'</td>
					</tr>
					
					<tr>
							<td>Mobile No.</td>
							<td>+91 - '.strtoupper($promoters_address_mob).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
					<td>4. Items of production/service rendered : </td>
					<td> '.strtoupper($item_of_product).'</td>
			</tr>
			<tr>
					<td>5. (a) Date of commencement of commercial production/ service ( initial) : </td>
					<td> '.strtoupper($date_of_comm).'</td>
			</tr>
			<tr>
					<td>(b)Date of commencement of production or service after substantial expansion/declaring : </td>
					<td> '.strtoupper($date_of_service).'</td>
			</tr>
			<tr>
					<td>6. No and date of Eligibility certificate :</td>
					<td> No : '.strtoupper($cert_no).'<br/>
						Date : '.strtoupper($cert_date).'</td>
			</tr>
			<tr>
					<td>7. Period of eligibility for availing power subsidy as per EC :   </td>
					<td>From : '.strtoupper($period_from).'<br/>
									To : '.strtoupper($period_to).'</td>   
			</tr>
			<tr>
					<td colspan="2">8.Details of power connection in case of New unit :</td>
			</tr>
			<tr>
					<td>(a) Total Electrical power sanctioned and date of sanctioned :   </td> 
					<td>Sanction : '.strtoupper($new_unit_sanction).'<br/>
									Date: '.strtoupper($new_unit_dt).'
					</td>
			</tr>
			<tr>
					<td>(b) Total electrical load connected </td>
					<td> '.strtoupper($new_unit_load).'</td>
			</tr>
			<tr>
					<td>(c)Sl no of energy meter(s) allotted </td>
					<td> '.strtoupper($new_unit_sl_no).'</td>
			</tr>
			<tr>
					<td>(d) Initial energy meter reading </td>
					<td> '.strtoupper($new_unit_initial_meter).'</td>
			</tr>
			<tr>
					<td colspan="2">9.Details of power connection in case of existing unit undertaking substantial expansion/sick unit :</td>
			</tr>
			<tr>
					<td>(a) Additional electrical power sanctioned by ASEB , if any </td>
					<td> '.strtoupper($exist_unit_power).'</td>
			</tr>
			<tr>
					<td>(b) Additional electrical load connected </td>
					<td> '.strtoupper($exist_unit_load).'</td>
			</tr>
			<tr>
					<td>(c) Total electrical load connected </td>
					<td> '.strtoupper($exist_unit_tot_load).'</td>
			</tr>
			<tr>
					<td>(d) Sl no of energy meter(s) allotted by ASEB for additional Power connection provided </td>
					<td> '.strtoupper($exist_unit_sl_no).'</td>
			</tr>
			<tr>
					<td>(e) Initial meter reading of the new energy meter provided</td>
					<td> '.strtoupper($exist_unit_initial_meter).'</td>
			</tr>
			<tr>
					<td>(f) Last meter reading prior to substantial expansion/declaring as a sick etc </td>
					<td> '.strtoupper($exist_unit_last_meter).'</td>
			</tr> 
			<tr>
					<td>10.Statement showing the monthly electricity consumption:
						( to be submitted separately as per guidelines mentioned earlier)</td>
					<td> Upload later in upload section </td>
			</tr>
			<tr>
					<td>11.Percentage of Increase in fixed capital investment as per EC </td>
					<td> '.strtoupper($percentage_of_increase).'</td>
			</tr>
			<tr>
					<td colspan="2" >12. Declaration<br/>
						I/We '.strtoupper($unit_name).' hereby declare that the information furnished along with the above application for power subsidy is true to the best of my/our knowledge.</td>
			</tr>
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
			<tr>
						<td> Date : &nbsp;<b>'.strtoupper($results["sub_date"]).'</b></td>
						<td align="right">Signature of the applicant:&nbsp;<b>'.strtoupper($key_person).'</b></td>
					</tr> 
		</table>';
?>