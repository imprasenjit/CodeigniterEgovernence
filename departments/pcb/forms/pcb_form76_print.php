<?php
$dept="pcb";
$form="76";
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
	$city_name=$results['city_name'];$population=$results['population'];$auth_name=$results['auth_name'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$waste_used=$results['waste_used'];$is_practice=$results['is_practice'];$is_practice_details=$results['is_practice_details'];$lift_bin_equip=$results['lift_bin_equip'];$improve=$results['improve'];$efforts=$results['efforts'];$slums=$results['slums'];$is_action=$results['is_action'];$is_action_details=$results['is_action_details'];
		
	if(!empty($results["auth"])){
		$auth=json_decode($results["auth"]);
		$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_tel=$auth->tel;$auth_fax=$auth->fax;$auth_email=$auth->email;$auth_website=$auth->website;
	}else{				
		$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pincode="";$auth_mobile="";$auth_tel="";$auth_fax="";$auth_email="";$auth_website="";
	}	
	
	if(!empty($results["generate"])){
		$generate=json_decode($results["generate"]);
		$generate_lean=$generate->lean;$generate_tpd=$generate->tpd;$generate_collect=$generate->collect;$generate_facility=$generate->facility;$generate_status=$generate->status;
	}else{				
		$generate_lean="";$generate_tpd="";$generate_collect="";$generate_facility="";$generate_status="";
	}		
	
	if(!empty($results["recycle"])){
		$recycle=json_decode($results["recycle"]);
		$recycle_concrete=$recycle->concrete;$recycle_sand=$recycle->sand;$recycle_rmc=$recycle->rmc;$recycle_blocks=$recycle->blocks;$recycle_gsb=$recycle->gsb;$recycle_others=$recycle->others;
	}else{				
		$recycle_concrete="";$recycle_sand="";$recycle_rmc="";$recycle_blocks="";$recycle_gsb="";$recycle_others="";
	}       

	if(!empty($results["dispose"])){
		$dispose=json_decode($results["dispose"]);
		$dispose_landfill=$dispose->landfill;$dispose_area=$dispose->area;$dispose_weigh=$dispose->weigh;$dispose_facility=$dispose->facility;
	}else{				
		$dispose_landfill="";$dispose_area="";$dispose_weigh="";$dispose_facility="";
	}
	
	if(!empty($results["storage"])){
		$storage=json_decode($results["storage"]);
		$storage_collect=$storage->collect;$storage_project=$storage->project;$storage_bin=$storage->bin;$storage_others=$storage->others;$storage_attend=$storage->attend;
	}else{				
		$storage_collect="";$storage_project="";$storage_bin="";$storage_others="";$storage_attend="";
	}
	
	if(!empty($results["required"])){
		$required=json_decode($results["required"]);
		$required_a=$required->a;$required_b=$required->b;$required_c=$required->c;$required_d=$required->d;$required_e=$required->e;$required_f=$required->f;$required_g=$required->g;$required_h=$required->h;
	}else{				
		$required_a="";$required_b="";$required_c="";$required_d="";$required_e="";$required_f="";$required_g="";$required_h="";
	}
	if($dispose_weigh=="Y") $dispose_weigh="Yes";
	else $dispose_weigh="No";
	if($storage_attend=="Y") $storage_attend="Yes";
	else $storage_attend="No";
	if($waste_used=="Y") $waste_used="Yes";
	else $waste_used="No";	
	if($is_practice=="Y") $is_practice="Yes";
	else $is_practice="No";
	if($improve=="Y") $improve="Yes";
	else $improve="No";
	if($efforts=="Y") $efforts="Yes";
	else $efforts="No";
	if($is_action=="Y") $is_action="Yes";
	else $is_action="No";
		
	if($is_practice_details=="C") $is_practice_details="Competent Authority";
	else if($is_practice_details=="L") $is_practice_details="Local Authority";
	else if($is_practice_details=="P") $purpose="Private Agency";
	else if($is_practice_details=="N") $purpose="Non-Governmental Organization";
	
	if(!empty($results["lift_bin"])){
		$lift_bin=json_decode($results["lift_bin"]);
		if(isset($lift_bin->a)) $lift_bin_a=$lift_bin->a; else $lift_bin_a="";
		if(isset($lift_bin->b)) $lift_bin_b=$lift_bin->b; else $lift_bin_b="";
		if(isset($lift_bin->c)) $lift_bin_c=$lift_bin->c; else $lift_bin_c="";
	}else{				
		$lift_bin_a="";$lift_bin_b="";$lift_bin_c="";
	}
	
	//lift_bin CHECKMARKS///
	$lift_bin_values="";		
	if($lift_bin_a=="MA") $lift_bin_values=$lift_bin_values.  '<span class="tickmark">&#10004;</span> Manual   ';
	if($lift_bin_b=="ME") $lift_bin_values=$lift_bin_values. '<span class="tickmark">&#10004;</span> Mechanical  ';
	if($lift_bin_c=="O") $lift_bin_values=$lift_bin_values. '<span class="tickmark">&#10004;</span> Others  ';
	
	if(!empty($results["technologies"])){
		$technologies=json_decode($results["technologies"]);
		$technologies_q1=$technologies->q1;$technologies_q2=$technologies->q2;$technologies_q3=$technologies->q3;$technologies_s1=$technologies->s1;$technologies_s2=$technologies->s2;$technologies_s3=$technologies->s3;
	}else{				
		$technologies_q1="";$technologies_q2="";$technologies_q3="";$technologies_s1="";$technologies_s2="";$technologies_s3="";
	}
	
	if(!empty($results["provisions"])){
		$provisions=json_decode($results["provisions"]);
		$provisions_river=$provisions->river;$provisions_low_line=$provisions->low_line;$provisions_waste=$provisions->waste;$provisions_parks=$provisions->parks;
	}else{				
		$provisions_river="";$provisions_low_line="";$provisions_waste="";$provisions_parks="";
	}
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
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. Name of the City or Town </td>
		<td>'.strtoupper($city_name).'</td>
	</tr>
	<tr>
		<td>2. Population </td>
		<td>'.strtoupper($population).'</td>
	</tr>
	<tr>
		<td>3. Name of local authority or competent authority </td>
		<td>'.strtoupper($auth_name).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Address of local authority or competent authority :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="25%">Street Name 1</td>
				<td>'.strtoupper($auth_sn1).'</td>
				<td>Street Name 2</td>
				<td>'.strtoupper($auth_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($auth_vill).'</td>
				<td>District</td>
				<td>'.strtoupper($auth_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($auth_pin).'</td>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($auth_mobile).'</td>
			</tr>
			<tr>
				<td>Telephone No.</td>
				<td>'.strtoupper($auth_tel).'</td>
				<td>Fax No.</td>
				<td>'.strtoupper($auth_fax).'</td>
			</tr>
			<tr>
				<td>Email Id</td>
				<td>'.strtoupper($auth_email).'</td>
				<td>Website</td>
				<td>'.strtoupper($auth_website).'</td>
			</tr>
		</table>
		</td>
	</tr>	
	<tr>
		<td>5. Name of In-charge or Nodal Officer dealing with construction and demolition wastes management with designation </td>
		<td><b>Name : </b>&nbsp;'.strtoupper($officer_name).'<br/><b>Designation : </b>&nbsp;'.strtoupper($officer_desgn).'</td>
	</tr>
	<tr>
		<td colspan="2">6. Quantity and composition of construction and demolition waste including any deconstruction waste : </td>
	</tr>
	<tr>
		<td colspan="2">(a) Total quantity of construction and demolition waste generated during the whole year (in metric ton) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Any figures for lean period and peak period generation per day</td>
				<td>'.strtoupper($generate_lean).'</td>
			</tr>
			<tr>
				<td>Average generation of construction and demolition waste (TPD)</td>
				<td>'.strtoupper($generate_tpd).'</td>
			</tr>
			<tr>
				<td>Total quantity of construction and demolition waste collected per day</td>
				<td>'.strtoupper($generate_collect).'</td>
			</tr>
			<tr>
				<td>Any Processing / Recycling Facility set up in the city</td>
				<td>'.strtoupper($generate_facility).'</td>
			</tr>
			<tr>
				<td>Status of the facility</td>
				<td>'.strtoupper($generate_status).'</td>
			</tr>			
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">(b) Total quantity of construction and demolition waste processed / recycled (in metric ton) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Non-structural concrete aggregate </td>
				<td>'.strtoupper($recycle_concrete).'</td>
			</tr>
			<tr>
				<td>Manufactured sand </td>
				<td>'.strtoupper($recycle_sand).'</td>
			</tr>
			<tr>
				<td>Ready-mix concrete (RMC) </td>
				<td>'.strtoupper($recycle_rmc).'</td>
			</tr>
			<tr>
				<td>Paving blocks </td>
				<td>'.strtoupper($recycle_blocks).'</td>
			</tr>
			<tr>
				<td>GSB </td>
				<td>'.strtoupper($recycle_gsb).'</td>
			</tr>	
			<tr>
				<td>Others, if any, please specify </td>
				<td>'.strtoupper($recycle_others).'</td>
			</tr>				
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">(c) Total quantity of Construction & Demolition waste disposed by land filling without processing (last option) or filling low lying areas : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">No of landfill sites used </td>
				<td>'.strtoupper($dispose_landfill).'</td>
			</tr>
			<tr>
				<td>Area used </td>
				<td>'.strtoupper($dispose_area).'</td>
			</tr>
			<tr>
				<td>Whether weigh-bridge </td>
				<td>'.strtoupper($dispose_weigh).'</td>
			</tr>
			<tr>
				<td>Facility used for quantity estimation </td>
				<td>'.strtoupper($dispose_facility).'</td>
			</tr>			
		</table>
		</td>
	</tr>	
	<tr>
		<td>(d) Whether construction and demolition waste used in sanitary landfill (for solid waste) as per Schedule III : </td>
		<td>'.strtoupper($waste_used).'</td>
	</tr>
	<tr>
		<td colspan="2">7. Storage facilities : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Area or location or plot or societies covered for collection of Construction and Demolition waste </td>
				<td>'.strtoupper($storage_collect).'</td>
			</tr>
			<tr>
				<td>(b) No. of large Projects (including roadways project) covered </td>
				<td>'.strtoupper($storage_project).'</td>
			</tr>
			<tr>
				<td>(c) Whether Area or location or plot or societies collection is Practiced; If yes, whether done by </td>
				<td>'.strtoupper($is_practice).'<br/>'.strtoupper($is_practice_details).'</td>
			</tr>
			<tr>
				<td colspan="2">(d) Storage Bins : </td>
			</tr>
			<tr>
				<td>(i) Containers or receptacle (Capacity) </td>
				<td>'.strtoupper($storage_bin).'</td>
			</tr>
			<tr>
				<td>(ii) Others, please specify </td>
				<td>'.strtoupper($storage_others).'</td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th>Sl No.</th>
							<th>Specifications (Shape & Size)</th>
							<th>Existing Number</th>
							<th>Proposed for future</th>
						</tr>
					</thead>';
					$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
					$num = $part1->num_rows;
					if($num>0){
						$sl=1;
						while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["slno"]).'</td>
								<td>'.strtoupper($row_1["specification"]).'</td>
								<td>'.strtoupper($row_1["existing_no"]).'</td>
								<td>'.strtoupper($row_1["future"]).'</td>
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
				<td>(e) Whether all storage bins/collection spots are attended for daily lifting </td>
				<td>'.strtoupper($storage_attend).'</td>
			</tr>
			<tr>
				<td>(f) Whether lifting of Construction & Demolition Waste from Storage bins is manual or mechanical (Please tick mark) </td>
				<td>'.strtoupper($lift_bin_values).'<br/><b>Equipment used : </b>&nbsp;'.strtoupper($lift_bin_equip).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">8.(a) Transportation </td>
				<td>'.strtoupper($required_a).'</td>
			</tr>
			<tr>
				<td>(b) Truck </td>
				<td>'.strtoupper($required_b).'</td>
			</tr>
			<tr>
				<td>(c) Truck-Hydraulic </td>
				<td>'.strtoupper($required_c).'</td>
			</tr>	
			<tr>
				<td>(d) Tractor-Trailer </td>
				<td>'.strtoupper($required_d).'</td>
			</tr>
			<tr>
				<td>(e) Dumper-placers </td>
				<td>'.strtoupper($required_e).'</td>
			</tr>
			<tr>
				<td>(f) Tricycle </td>
				<td>'.strtoupper($required_f).'</td>
			</tr>
			<tr>
				<td>(g) Refuse-collector </td>
				<td>'.strtoupper($required_g).'</td>
			</tr>
			<tr>
				<td>(h) Others (Please specify) </td>
				<td>'.strtoupper($required_h).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>9. Whether any proposal has been made to improve Construction and Demolition waste management practices </td>
		<td>'.strtoupper($improve).'</td>
	</tr>
	<tr>
		<td>10. Have any efforts been made to involve PPP for processing of Construction & Demolition waste </td>
		<td>'.strtoupper($efforts).'</td>
	</tr>
	<tr>
		<td colspan="2">If yes, what is (are) the technologies being used, such as :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Processing / recycling Technology</th>
					<th>Quantity to be processed</th>
					<th>Steps taken</th>
				</tr>
			</thead>
			<tr>
				<td>Dry Process</td>
				<td>'.strtoupper($technologies_q1).'</td>
				<td>'.strtoupper($technologies_s1).'</td>
			</tr>
			<tr>
				<td>Wet Process</td>
				<td>'.strtoupper($technologies_q2).'</td>
				<td>'.strtoupper($technologies_s2).'</td>
			</tr>
			<tr>
				<td>Others, if any, Please specify</td>
				<td>'.strtoupper($technologies_q3).'</td>
				<td>'.strtoupper($technologies_s3).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">11. What provisions are available to check unauthorized operations of?  </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Encroachment on river bank or wet bodies </td>
				<td>'.strtoupper($provisions_river).'</td>
			</tr>
			<tr>
				<td>Unauthorized filling of low line areas </td>
				<td>'.strtoupper($provisions_low_line).'</td>
			</tr>
			<tr>
				<td>Mixing with solid waste </td>
				<td>'.strtoupper($provisions_waste).'</td>
			</tr>	
			<tr>
				<td>Encroachment in Parks, Footpaths etc. </td>
				<td>'.strtoupper($provisions_parks).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>12. How many slums are provided with construction and demolition waste receptacles facilities? </td>
		<td>'.strtoupper($slums).'</td>
	</tr>
	<tr>
		<td>13. Are municipal magistrates appointed for taking penal action for non-compliance with these rules?  </td>
		<td>'.strtoupper($is_action).'<br/>'.strtoupper($is_action_details).'</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left"> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong><br/>
		Place : <strong>'.strtoupper($dist).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong><br/>
		(Name : <strong>'.strtoupper($key_person).'</strong>)<br/>
		(Designation : <strong>'.strtoupper($status_applicant).'</strong>)</td>
	</tr>
</table>';
?>