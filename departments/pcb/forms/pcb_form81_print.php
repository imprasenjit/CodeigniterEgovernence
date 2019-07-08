<?php
$dept="pcb";
$form="81";
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
	// Tab 1 //
	$owner_name=$results['owner_name'];
	if(!empty($results["applicant"])){
		$applicant=json_decode($results["applicant"]);
		$applicant_name=$applicant->name;$applicant_nationality=$applicant->nationality;
	}else{				
		$applicant_name="";$applicant_nationality="";
	}			
	if(!empty($results["details"])){
		$details=json_decode($results["details"]);
		$details_ind=$details->ind;$details_prop=$details->prop;$details_firm=$details->firm;$details_joint=$details->joint;$details_priv=$details->priv;$details_pub=$details->pub;$details_state=$details->state;$details_central=$details->central;$details_union=$details->union;$details_foreign=$details->foreign;$details_other=$details->other;
	}else{				
		$details_ind="";$details_prop="";$details_firm="";$details_joint="";$details_priv="";$details_pub="";$details_state="";$details_central="";$details_union="";$details_foreign="";$details_other="";
	}	
	
	if($details_firm=="R") $details_firm="Registered";
	else $details_firm="Unregistered";
	
	// Tab 2 //
	$indus_add=$results['indus_add'];$no_of_employee=$results['no_of_employee'];$licence=$results['licence'];$auth_name=$results['auth_name'];$capacity=$results['capacity'];$is_treat=$results['is_treat'];
	
	if(!empty($results["comm"])){
		$comm=json_decode($results["comm"]);
		$comm_work=$comm->work;$comm_prod=$comm->prod;
	}else{				
		$comm_work="";$comm_prod="";
	}		
	if(!empty($results["daily"])){
		$daily=json_decode($results["daily"]);
		$daily_qty=$daily->qty;$daily_source=$daily->source;
	}else{				
		$daily_qty="";$daily_source="";
	}
	if(!empty($results["effluent"])){
		$effluent=json_decode($results["effluent"]);
		$effluent_qty1=$effluent->qty1;$effluent_mode1=$effluent->mode1;$effluent_qty2=$effluent->qty2;$effluent_mode2=$effluent->mode2;$effluent_discharge=$effluent->discharge;$effluent_monitor=$effluent->monitor;
	}else{				
		$effluent_qty1="";$effluent_mode1="";$effluent_qty2="";$effluent_mode2="";$effluent_discharge="";$effluent_monitor="";
	}
	if(!empty($results["solid"])){
		$solid=json_decode($results["solid"]);
		$solid_qty=$solid->qty;$solid_desc=$solid->desc;$solid_method=$solid->method;$solid_dispose=$solid->dispose;
	}else{				
		$solid_qty="";$solid_desc="";$solid_method="";$solid_dispose="";
	}		
	if(!empty($results["draft"])){
		$draft=json_decode($results["draft"]);
		$draft_no=$draft->no;$draft_dt=$draft->dt;$draft_name=$draft->name;$draft_amnt=$draft->amnt;$draft_rupees=$draft->rupees;
	}else{				
		$draft_no="";$draft_dt="";$draft_name="";$draft_amnt="";$draft_rupees="";
	}
	
	if($is_treat=="Y") $is_treat="Yes";
	else $is_treat="No";
}

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br/>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">From,<br/>'.strtoupper($key_person).'<br/>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>
		<td colspan="2">To, <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Member Secretary,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Central Pollution Control Board.</td>
	</tr>
	<tr>
		<td colspan="2">Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We hereby apply for Consent/Renewal of Consent under section 25 of the Water (Prevention and Control of Pollution) Act, 1974 (6 of 1974) for establishing or taking any steps for establishment of Industry/operation process or any treatment/disposal system to bring into use any new/altered outlet for discharge of sewage/trade effluent to continue to discharge sewage/trade effluent from land/premises owned by &nbsp;'.strtoupper($owner_name).'</td>
	</tr>
	<tr>
		<td colspan="2">The other relevant details are below :- </td>
	</tr>
	<tr>
		<td width="50%">1. Full Name of the applicant </td>
		<td>'.strtoupper($applicant_name).'</td>
	</tr>
	<tr>
		<td>2. Nationality of the applicant </td>
		<td>'.strtoupper($applicant_nationality).'</td>
	</tr>
	<tr>
		<td>3. (a) Individual </td>
		<td>'.strtoupper($details_ind).'</td>
	</tr>
	<tr>
		<td>(b) Proprietary concern </td>
		<td>'.strtoupper($details_prop).'</td>
	</tr>
	<tr>
		<td>(c) Partnership firm </td>
		<td>'.strtoupper($details_firm).'</td>
	</tr>
	<tr>
		<td>(d) Joint family concern </td>
		<td>'.strtoupper($details_joint).'</td>
	</tr>
	<tr>
		<td>(e) Private Limited Company </td>
		<td>'.strtoupper($details_priv).'</td>
	</tr>
	<tr>
		<td>(f) Public Limited Company </td>
		<td>'.strtoupper($details_pub).'</td>
	</tr>
	<tr>
		<td>(g) Government Company </td>
		<td>i) State Government : '.strtoupper($details_state).'<br/>ii) Central Government : '.strtoupper($details_central).'<br/>iii) Union Territory  : '.strtoupper($details_union).'</td>
	</tr>
	<tr>
		<td>(h) Foreign Company (If a foreign company, the details of registration, incorporation, etc.) </td>
		<td>'.strtoupper($details_foreign).'</td>
	</tr>
	<tr>
		<td>(i) Any other Association or Body </td>
		<td>'.strtoupper($details_other).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Name, Address and Telephone Nos. of Applicant &nbsp;&nbsp;(The full list of individuals, partners, persons, Chairman (Full-time or part-time Managing Directors, Managing Partners Directors (Full time or part-time) and other kinds of office bearers are to be furnished with their period of tenure in the respective office with telephone Nos. and address) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No. </th>
					<th>Name </th>
					<th>Address </th>
					<th>Telephone Nos. </th>
					<th>Period of tenure </th>
					<th>Respective office </th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>  
						<td>'.strtoupper($row_1["sl_no"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["address"]).'</td>
						<td>'.strtoupper($row_1["phone"]).'</td>
						<td>'.strtoupper($row_1["tenure"]).'</td>
						<td>'.strtoupper($row_1["office"]).'</td>
					</tr>';
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">5. Details of commissioning etc. : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Approximate date of proposed commissioning of work </td>
				<td>'.strtoupper($comm_work).'</td>
			</tr>
			<tr>
				<td>(b) Expected date of production </td>
				<td>'.strtoupper($comm_prod).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>6. Address of the Industry &nbsp;&nbsp;(Survey No, Khasra No, location as per the revenue records, Village, Firka, Tehsil, District, Police Station or SHO jurisdiction of the First-Class Magistrate) </td>
		<td>'.strtoupper($indus_add).'</td>
	</tr>
	<tr>
		<td>7. Total number of employee expected to employed </td>
		<td>'.strtoupper($no_of_employee).'</td>
	</tr>
	<tr>
		<td>8. Details of licence, if any obtained under the provisions of Industrial Development Regulations Act, 1951 </td>
		<td>'.strtoupper($licence).'</td>
	</tr>
	<tr>
		<td>9. Name of the person authorised to sign this form (the original authorisation except in the case of individual proprietary concern is to be enclosed) </td>
		<td>'.strtoupper($auth_name).'</td>
	</tr>
	<tr>
		<td>10. (a) Licence Annual Capacity of the Factory/Industry </td>
		<td>'.strtoupper($capacity).'</td>
	</tr>
	<tr>
		<td>(b) Attach the list of raw materials and chemicals used per month </td>
		<td>Upload later in upload section </td>
	</tr>
	<tr>
		<td>11. State daily quantity of water in kilolitres utilised and its source (domestic/industrial process boiler Cooling others) </td>
		<td>Quantity : '.strtoupper($daily_qty).'<br/>Source : '.strtoupper($daily_source).'</td>
	</tr>
	<tr>
		<td colspan="2">12. (a) State the daily maximum quantity of effluents quantity and mode of disposal (sewer or drains or river) : <br/>Also attach analysis report of the effluents. </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Type of effluent </th>
					<th>Quantity (In Kilolitres) </th>
					<th>Mode of disposal </th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Domestic </td>
					<td>'.strtoupper($effluent_qty1).'</td>
					<td>'.strtoupper($effluent_mode1).'</td>
				</tr>
				<tr>
					<td>Industrial </td>
					<td>'.strtoupper($effluent_qty2).'</td>
					<td>'.strtoupper($effluent_mode2).'</td>
				</tr>
			</tbody>
		</table>
		</td>
	</tr>
	<tr>
		<td>(b) Quality of effluent currently being discharged or expected to be discharged </td>
		<td>'.strtoupper($effluent_discharge).'</td>
	</tr>
	<tr>
		<td>(c) What monitoring arrangement is currently there or proposed </td>
		<td>'.strtoupper($effluent_monitor).'</td>
	</tr>
	<tr>
		<td>13. State whether you have any treatment plant for industrial, domestic or combined effluents <br/>If yes, attach the description of the process of treatment in brief. Attach information on the quality of treated effluent vis-a-vis the standards. </td>
		<td>'.strtoupper($is_treat).'</td>
	</tr>		
	<tr>
		<td colspan="2">14. State details of sold wastes generated in the process or during waste treatment : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Description </td>
				<td>'.strtoupper($solid_desc).'</td>
			</tr>
			<tr>
				<td>(b) Quantity </td>
				<td>'.strtoupper($solid_qty).'</td>
			</tr>
			<tr>
				<td>(c) Method </td>
				<td>'.strtoupper($solid_method).'</td>
			</tr>
			<tr>
				<td>(d) Method of disposal </td>
				<td>'.strtoupper($solid_dispose).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="4">15. I/We further declare that the information furnished above is correct to the best of my/our knowledge.</td>
	</tr>
			<tr>
		<td colspan="4">16. I/We hereby submit that in case of change either of the point of discharge or the quantity of discharge or its quality a fresh application for CONSENT shall be made and until such CONSENT is granted no change shall be made.</td>
	</tr>
	<tr>
		<td colspan="4">17. I/We hereby agree to submit to the Central Board an application for renewal of consent one month in advance of the date of expiry of the consented period for outlet/discharge if to be continued thereafter.</td>
	</tr>
	<tr>
		<td colspan="4">18. I/We, undertake to furnish any other information within one month or its being called by the Central Board.</td>
	</tr>
	<tr class="form-inline">
		<td colspan="4">19. I/We, enclose herewith cash receipt No./bank draft No. &nbsp;'.strtoupper($draft_no).'&nbsp; dated &nbsp;'.strtoupper($draft_dt).'&nbsp; for &nbsp;'.strtoupper($draft_name).'&nbsp; Rs. &nbsp;'.strtoupper($draft_amnt).'&nbsp; (Rupees &nbsp;'.strtoupper($draft_rupees).'&nbsp;) in favour of the Central Pollution Control Board, New Delhi, as fees payable under section 25 of the Act.</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left">Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of the applicant : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>