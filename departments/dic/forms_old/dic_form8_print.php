<?php 
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form8 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form8 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form8 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form8 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
    $email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
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
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$q=$dic->query("select * from dic_form8 where user_id='$swr_id'") or die($dci->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
		$form_id=$results['form_id'];
		###### PART I #####
		$claim_period_form=$results['claim_period_form'];$claim_period_to=$results['claim_period_to'];$item_of_product=$results['item_of_product'];$promoters_name=$results['promoters_name'];
		if(!empty($results["office_address"])){
			$office_address=json_decode($results["office_address"]);
			$office_address_st1=$office_address->st1;$office_address_st2=$office_address->st2;$office_address_vt=$office_address->vt;$office_address_dist=$office_address->dist;$office_address_pin=$office_address->pin;$office_address_mob=$office_address->mob;$office_address_email=$office_address->email;
		}else{
			$office_address_st1="";$office_address_st2="";$office_address_vt="";$office_address_dist="";$office_address_pin="";$office_address_mob="";$office_address_email="";
		}
		if(!empty($results["promoters_address"])){
			$promoters_address=json_decode($results["promoters_address"]);
			$promoters_address_st1=$promoters_address->st1;$promoters_address_st2=$promoters_address->st2;$promoters_address_vt=$promoters_address->vt;$promoters_address_dist=$promoters_address->dist;$promoters_address_pin=$promoters_address->pin;$promoters_address_mob=$promoters_address->mob;$promoters_address_email=$promoters_address->email;
		}else{
			$promoters_address_st1="";$promoters_address_st2="";$promoters_address_vt="";$promoters_address_dist="";$promoters_address_pin="";$promoters_address_mob="";$promoters_address_email="";
		}
		###### PART II #####
		$date_of_comm=$results['date_of_comm'];$date_of_service=$results['date_of_service'];$cert_no=$results['cert_no'];$cert_date=$results['cert_date'];$period_from=$results['period_from'];$period_to=$results['period_to'];$mothly_statement=$results['mothly_statement'];$percentage_of_increase=$results['percentage_of_increase'];
		if(!empty($results["new_unit"])){
			$new_unit=json_decode($results["new_unit"]);
			$new_unit_sanction=$new_unit->sanction;$new_unit_dt=$new_unit->dt;$new_unit_load=$new_unit->load;$new_unit_sl_no=$new_unit->sl_no;$new_unit_initial_meter=$new_unit->initial_meter;
		}else{
			$new_unit_sanction="";$new_unit_dt="";$new_unit_load="";$new_unit_sl_no="";$new_unit_initial_meter="";
		}
		if(!empty($results["exist_unit"])){
			$exist_unit=json_decode($results["exist_unit"]);
			$exist_unit_power=$exist_unit->power;$exist_unit_load=$exist_unit->load;$exist_unit_tot_load=$exist_unit->tot_load;$exist_unit_sl_no=$exist_unit->sl_no;$exist_unit_initial_meter=$exist_unit->initial_meter;$exist_unit_last_meter=$exist_unit->last_meter;
		}else{
			$exist_unit_power="";$exist_unit_load="";$exist_unit_tot_load="";$exist_unit_sl_no="";$exist_unit_initial_meter="";$exist_unit_last_meter="";
		}
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($mothly_statement);
		}else{
			$val1=$formFunctions->get_useruploadFile($mothly_statement,$applicant_id);
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
	}
    $form_name=$formFunctions->get_formName('dic','8');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 8</title>
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
  			'.$assamSarkarLogo.'<h4>Form- 8<br/>[See rule 11 (1)]<br/>'.$form_name.'</h4>
		</div><br/>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>  				
				<td valign="top" width="50%">1. Name of the Unit:</td>
				<td style="width:50%">'.strtoupper($unit_name).'</td>
			</tr>
			<tr>  				
				<td valign="top" width="50%">PAN</td>
				<td style="width:50%">'.strtoupper($pan_no).'</td>
			</tr> 
			<tr>
				<td valign="top">a). Address of the Factory  : </td>
				<td>
					<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
							<td width="50%">Street Name 1</td>
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
				<td valign="top">(b) Address of the Office :  </td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
							<td width="50%">Street Name 1</td>
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
							<td valign="top">District</td>
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
				<td valign="top">2.Period of Claim :   </td> 		
				<td width="50%">From: '.strtoupper($claim_period_form).'<br/>
				To: '.strtoupper($claim_period_to).'</td>      		
			</tr>
			<tr>
				<td colspan="2">3.Name & Address of the promoter(s)*</td>
			</tr>
			<tr>
				<td valign="top">(b)Address :   </td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td width="50%">(a)Name</td>
						<td>'.strtoupper($promoters_name).'</td>
					</tr>
					<tr>
						<td colspan="2">(b) Address</td>
					</tr> 
					<tr>
							<td width="50%">Street Name 1</td>
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
					<td>4. Items of production/service rendered: </td>
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
					<td valign="top">6. No and date of Eligibility certificate*:</td>
					<td> No : '.strtoupper($cert_no).'<br/>
						Date : '.strtoupper($cert_date).'</td>
			</tr>
			<tr>
					<td valign="top">7. Period of eligibility for availing power subsidy as per EC*:   </td>
					<td width="50%">From : '.strtoupper($period_from).'<br/>
									To : '.strtoupper($period_to).'</td>   
			</tr>
			<tr>
					<td colspan="2">8.Details of power connection in case of New unit:</td>
			</tr>
			<tr>
					<td valign="top">(a) Total Electrical power sanctioned and date of sanctioned:   </td> 
					<td width="50%">Sanction : '.strtoupper($new_unit_sanction).'<br/>
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
					<td colspan="2">9.Details of power connection in case of existing unit undertaking substantial expansion/sick unit:</td>
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
					<td> '.$val1.'</td>
			</tr>
			<tr>
					<td>11.Percentage of Increase in fixed capital investment as per EC </td>
					<td> '.strtoupper($percentage_of_increase).'</td>
			</tr>
			<tr>
					<td colspan="2" >12. Declaration<br/>
						I/We '.strtoupper($unit_name).' hereby declare that the information furnished along with the above application for power subsidy is true to the best of my/our knowledge.</td>
			</tr>';
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1 ){
		$printContents=$printContents.'
		<tr>		            
		<td colspan="2">
			<table border="0" width="100%" class="table table-bordered table-responsive" style="border-collapse: collapse">
				<tr><td height="45px" colspan="2">Courier Details.</td></tr>
				<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td>Ref. No./ Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
			</table>
		</td>
		</tr>
		';				
		}		
		$printContents=$printContents.'
			<tr>
						<td valign="top" width="50%"> Date : &nbsp;<b>'.strtoupper($results["sub_date"]).'</b></td>
						<td valign="top" align="right">Signature of the applicant:&nbsp;<b>'.strtoupper($key_person).'</b></td>
					</tr> 
		</table>';
?>