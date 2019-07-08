<?php
$dept="factory";
$form="1";
$table_name=$formFunctions->getTableName($dept,$form);	
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($factory->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$factory->query("select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") or die($factory->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") or die($factory->error);		
	}else{
		$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($factory->error);
	}
	if(isset($css)){
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	
	$from="Street Name 1 : ".strtoupper($street_name1)."<br/>Street Name 2 : ".strtoupper($street_name2)."<br/>Vill/Town : ".strtoupper($vill)."<br/>District : ".strtoupper($dist)."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std." - ".$landline_no."<br/>Email ID : ".$email;

	$unit_details="Street Name 1 : ".strtoupper($b_street_name1)."<br/>Street Name 2 : ".strtoupper($b_street_name2)."<br/>Vill/Town : ".strtoupper($b_vill)."<br/>District : ".strtoupper($b_dist)."<br/>Pin Code : ".$b_pincode."<br/>Mobile Number : +91 ".$b_mobile_no."<br/>Phone Number : ".$b_landline_std."-".$b_landline_no;

	
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$fac_situation="";$province="";$vill3="";$dist3="";$pin3="";$m_no="";$n_rail_station="";$particulars="";$is_hazardous="";
	}else{
		$form_id=$results['form_id'];	
		$fac_situation=$results['fac_situation'];$province=$results['province'];$vill3=$results['vill3'];$pin3=$results['pin3'];$m_no=$results['m_no'];$n_rail_station =$results['n_rail_station'];	$particulars =$results['particulars'];	$dist3 =$results['dist3'];	$is_hazardous =$results['is_hazardous'];				
	}
	if($is_hazardous=="Y") $is_hazardous_full="Hazardous";
	else $is_hazardous_full="Non Hazardous";
	$particulars= wordwrap($particulars, 40, "<br/>", true);
	
	
	
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	}else{
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	$form_name=$formFunctions->get_formName($dept,'1');
	$form_name2=$formFunctions->get_formName($dept,'3');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 1</title>
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
  			'.$assamSarkarLogo.'<h4>FORM NO. 1</h4>
			<p  style="text-align:center">(Prescribed under Rule 3)</p>
  			<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">			
			<tr>				
				<td valign="top" width="40%">1. Name of the Applicant</td>
				<td  width="60%">'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td valign="top">2. Address of the Applicant</td>
				<td>'.$from.'</td>
			</tr>
			<tr>
				<td valign="top">3.(a) Full name of the factory</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td valign="top"> (b) Postal address of the factory</td>
				<td>Street Name 1: '.strtoupper($fac_situation).'<br/>Street Name 2 : '.strtoupper($province).'<br/>Vill/Town : '.strtoupper($vill3).'<br/>District : '.strtoupper($dist3).'<br/>Pincode : '.strtoupper($pin3).'<br/>Moblie No : '.$m_no.'</td>
			</tr>
			<tr>
				<td valign="top">4. Location of the Factory</td>
				<td>Street Name : '.strtoupper($b_street_name3).'<br/>Province : '.strtoupper($b_street_name4).'<br/>Vill/Town : '.strtoupper($b_vill2).'<br/>District : '.strtoupper($b_dist2).'<br/>Pincode : '.strtoupper($b_pincode2).'<br/>Nearest railway station : '.strtoupper($n_rail_station).'</td>
			</tr>
			
			<tr>
				<td>5. Particulars of Plants and Machinery to be installed</td>
				<td>'.strtoupper($particulars).'</td>
			</tr>
			<tr>
				<td>6. Nature of Manufacturing Powers/ Inputs/ Outputs/ Wastages</td>
				<td>'.strtoupper($is_hazardous_full).'</td>
			</tr>
			';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'<tr>
				<td>Signatures and Dates :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td align="right">Signature of Applicant : &nbsp; &nbsp; '.strtoupper($key_person).'<br/></td>				
					</tr>	
					<tr>
						<td align="right">Date : '.date('d-m-Y', strtotime($results["sub_date"])).'</td>
						
					</tr>
					</table>
				</td>
			</tr>
		
	</table>';
if($is_hazardous=="Y"){
	
		$query=$factory->query("select * from factory_form3 a,factory_form3_upload b where a.form_id='$form_id' and b.form_id=$form_id");
		if($query->num_rows > 0){
		$results2=$query->fetch_array();		
		$form_id=$results2['form_id'];$other_info=$results2['other_info'];	
		
			if(!empty($results2["ownership_data"])){
			$ownership_data=json_decode($results2["ownership_data"]);
			$ownership_data_sno=$ownership_data->sno;$ownership_data_is_classified=$ownership_data->is_classified;$ownership_data_is_proposed=$ownership_data->is_proposed;$ownership_data_local_auth=$ownership_data->local_auth;
		}else{
			$ownership_data_sno="";$ownership_data_is_classified="";$ownership_data_is_proposed="";$ownership_data_local_auth="";
		}
		if(!empty($results2["site_plan"])){
			$site_plan=json_decode($results2["site_plan"]);
			if(isset($site_plan->monument)) $site_plan_monument=$site_plan->monument; else $site_plan_monument="";
			if(isset($site_plan->unit)) $site_plan_unit=$site_plan->unit; else $site_plan_unit="";
			if(isset($site_plan->source)) $site_plan_source=$site_plan->source; else $site_plan_source="";
			if(isset($site_plan->distance)) $site_plan_distance=$site_plan->distance; else $site_plan_distance="";
			if(isset($site_plan->transmission)) $site_plan_transmission=$site_plan->transmission; else $site_plan_transmission="";
			if(isset($site_plan->soil)) $site_plan_soil=$site_plan->soil; else $site_plan_soil="";
		}else{
			$site_plan_monument="";$site_plan_unit="";$site_plan_source="";$site_plan_distance="";$site_plan_transmission="";$site_plan_soil="";
		}
		if($site_plan_monument=="Y"){
			$site_plan_monument="YES";
		}else{
			$site_plan_monument="NO";
		} 
		if(!empty($results2["project_report"])){
			$project_report=json_decode($results2["project_report"]);
			if(isset($project_report->summary)) $project_report_summary=$project_report->summary; else $project_report_summary="";
			if(isset($project_report->status)) $project_report_status=$project_report->status;  else $project_report_status="";
			if(isset($project_report->no)) $project_report_no=$project_report->no;  else $project_report_no="";
			if(isset($project_report->housing)) $project_report_housing=$project_report->housing;  else $project_report_housing="";
			
			$project_report_summary = wordwrap($project_report_summary, 40, "<br/>", true);
			$project_report_housing = wordwrap($project_report_housing, 40, "<br/>", true);			
			
		}else{
			$project_report_summary="";$project_report_status="";$project_report_no="";$project_report_housing="";
		}
		//print_r($results2["project_report"]);die();
		if($project_report_status=="G"){
			$project_report_status="Govt";
		}elseif($project_report_status=="SG"){
			$project_report_status="Semi Govt";
		}elseif ($project_report_status=="P") {
			$project_report_status="Public";	
		}elseif ($project_report_status=="PR") {
			$project_report_status="Private";
		}elseif ($project_report_status=="O") {
			$project_report_status="Others";
		}else{
			$project_report_status="Others - ".$project_report_status;
		}
		

		if(!empty($results2["supply"])){
			$supply=json_decode($results2["supply"]);
			$supply_p_amt=$supply->p_amt;$supply_w_amt=$supply->w_amt;$supply_p_unit=$supply->p_unit;$supply_w_unit=$supply->w_unit;$supply_p_src=$supply->p_src;$supply_w_src=$supply->w_src;
		}else{
			$supply_p_amt="";$supply_w_amt="";$supply_p_unit="";$supply_w_unit="";$supply_p_src="";$supply_w_src="";
		}
		if($supply_p_unit=="K"){
			$supply_p_unit="KW";
		}elseif($supply_p_unit=="H"){
			$supply_p_unit="HP";
		}
		if($supply_w_unit=="K"){
			$supply_w_unit="KL";
		}
		if($supply_p_src=='S'){
			$supply_p_src="State Electricity Authority";
		}else if($supply_p_src=='SG'){
			$supply_p_src="Self Generation";
		}else{
			$supply_p_src="From Grid";
		}
		if($supply_w_src=='R'){
			$supply_w_src="River/Stream/Canal";
		}else if($supply_w_src=='GW'){
			$supply_w_src="Ground Water";
		}else if($supply_w_src=='MS'){
			$supply_w_src="Municipal Supply";
		}else{
			$supply_w_src="Mined";
		}
		if(!empty($results2["org_structure"])){
			$org_structure=json_decode($results2["org_structure"]);
			$org_structure_area=$org_structure->area;$org_structure_measures=$org_structure->measures;
		}else{
			$org_structure_area="";$org_structure_measures="";
		}	
		if(!empty($results2["comm_link"])){
			$communication_link=json_decode($results2["comm_link"]);
			$communication_link_details=$communication_link->details;
			$communication_link_facility=$communication_link->facility;
		}else{
			$communication_link_details="";$communication_link_facility="";
		}		
	$file1=$results2["file1"];$file2=$results2["file2"];$file3=$results2["file3"];$file4=$results2["file4"];$file5=$results2["file5"];$file6=$results2["file6"];$file7=$results2["file7"];$file8=$results2["file8"];$file9=$results2["file9"];$file10=$results2["file10"];$file11=$results2["file11"];$file12=$results2["file12"];
		
	
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($results2["file1"]);
		$val2=$formFunctions->get_uploadFile($results2["file2"]);
		$val3=$formFunctions->get_uploadFile($results2["file3"]);
		$val4=$formFunctions->get_uploadFile($results2["file4"]);
		$val5=$formFunctions->get_uploadFile($results2["file5"]);
		$val6=$formFunctions->get_uploadFile($results2["file6"]);
		$val7=$formFunctions->get_uploadFile($results2["file7"]);
		$val8=$formFunctions->get_uploadFile($results2["file8"]);
		$val9=$formFunctions->get_uploadFile($results2["file9"]);
		$val10=$formFunctions->get_uploadFile($results2["file10"]);
		$val11=$formFunctions->get_uploadFile($results2["file11"]);
		$val12=$formFunctions->get_uploadFile($results2["file12"]);
	}else{
		$val1=$formFunctions->get_useruploadFile($results2["file1"],$applicant_id);
		$val2=$formFunctions->get_useruploadFile($results2["file2"],$applicant_id);
		$val3=$formFunctions->get_useruploadFile($results2["file3"],$applicant_id);
		$val4=$formFunctions->get_useruploadFile($results2["file4"],$applicant_id);
		$val5=$formFunctions->get_useruploadFile($results2["file5"],$applicant_id);
		$val6=$formFunctions->get_useruploadFile($results2["file6"],$applicant_id);
		$val7=$formFunctions->get_useruploadFile($results2["file7"],$applicant_id);
		$val8=$formFunctions->get_useruploadFile($results2["file8"],$applicant_id);
		$val9=$formFunctions->get_useruploadFile($results2["file9"],$applicant_id);
		$val10=$formFunctions->get_useruploadFile($results2["file10"],$applicant_id);
		$val11=$formFunctions->get_useruploadFile($results2["file11"],$applicant_id);
		$val12=$formFunctions->get_useruploadFile($results2["file12"],$applicant_id);
	}
	
	$site_plan_unit = wordwrap($site_plan_unit, 40, "<br/>", true);
	$site_plan_source = wordwrap($site_plan_source, 40, "<br/>", true);
	$site_plan_distance = wordwrap($site_plan_distance, 40, "<br/>", true);
	$site_plan_transmission = wordwrap($site_plan_transmission, 40, "<br/>", true);
	$site_plan_soil = wordwrap($site_plan_soil, 40, "<br/>", true);
	
	$other_info = wordwrap($other_info, 40, "<br/>", true);
}

$printContents=$printContents.'
<br/><br/><br/><br/>
		<h3 align="center"><b>'.$form_name2.'</b></h3><br/>
		<table class="table table-bordered table-responsive">		
			<tr>  				
				<td valign="top" width="60%" colspan="2"><b>1. Full Name and Address of the Applicant:</b></td>
			</tr>
			<tr>  				
				<td>1. Full Name of the Applicant:</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td>Street Name 1</td>
				<td>'.strtoupper($street_name1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($street_name2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($pincode).'</td>
			</tr>
			<tr>
				<td>Mobile</td>
				<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</td>
			</tr>
			<tr>
				<td>Email-id</td>
				<td>'.$email.'</td>
			</tr>      
			<tr>
				<td colspan="2"><b>2. Site ownership data</b></td>
			</tr>
			<tr>
				<td>2.1. Revenue details of site such as Survey No:</td>
				<td>'.strtoupper($ownership_data_sno).'</td>
			</tr>
			<tr>
				<td>2.2. Whether the site is classified as forest and if so,whether approval of the central Govt. under Sec. 5 of the Indian Forest Act,1927 has been taken:</td>
				<td>'.strtoupper($ownership_data_is_classified).'</td>
			</tr>
			<tr>
				<td>2.3. Whether the proposed site attracts the provisions of section 3(2) (V) of the E.P.Act,1986, if so that nature of the restrictions:</td>
				<td>'.strtoupper($ownership_data_is_proposed).'</td>
			</tr>
			<tr>
				<td>2.4. Local authority under whose jurisdiction the site is located :</td>
				<td>'.strtoupper($ownership_data_local_auth).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>3. Site Plan</b></td>				
			</tr>
			<tr>
					<td>3.1. Site plan with clear identification of boundaries & total area proposed to be occupied & showing the following details nearby the proposed site :</td>
					<td>Site plan is attached.</td>
			</tr>
			<tr>
					<td>a) Historical monument, if any, in the vicinity :</td>
					<td>'.strtoupper($site_plan_monument).'</td>
			</tr>
			<tr>
					<td>b) Names of neighboring manufacturing units & human habitats, Educational & training institutions, patrol installations storages of LPG & other hazardous substances in the vicinity & their distances from the proposed unit :</td>
					<td>'.strtoupper($site_plan_unit).'</td>
			</tr>
			<tr>
					<td>c) Water sources(rivers, streams, canals, dams, water filtration plants etc.) in the vicinity :</td>
					<td>'.strtoupper($site_plan_source).'</td>
			</tr>
			<tr>
					<td>d) Nearest hospitals, fire-stations, civil defense stations & police stations & their distances :</td>
					<td>'.strtoupper($site_plan_distance).'</td>
			</tr>
			<tr>
					<td>e) High tension electrical transmission line, pipe lines for water ,oil, gas or sewerage, railway lines, roads,stations,jetties & other similar installations :</td>
					<td>'.strtoupper($site_plan_transmission).'</td>
			</tr>
			<tr>
					<td>3.2. Details of soil conditions & depth at which hard strata obtained :</td>
					<td>'.strtoupper($site_plan_soil).'</td>
			</tr>
			<tr>
					<td> 3.3. Contour map of the area showing nearby hillocks & difference in levels :</td>
					<td>Contour map is attached.</td>
			</tr>
			<tr>
					<td>3.4. Plot plan of the factory showing the entry & exit Points, roads, within water drains, etc. :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>4. Project Report</b></td>
					
			</tr>
			<tr>
					<td>4.1. A summary of the salient features of the project :</td>
					<td>'.strtoupper($project_report_summary).'</td>
			</tr>
			<tr>
					<td>4.2. Status of the organization (Govt. Semi Govt. Public or private etc.) :</td>
					<td>'.strtoupper($project_report_status).'</td>
			</tr>
			<tr>
					<td>4.3. Maximum number of persons likely to be working in the factory :</td>
					<td>'.strtoupper($project_report_no).'</td>
			</tr>
			<tr>
					<td rowspan="2">4.4. Maximum amount of power & water requirements & sources of their supply :</td>
					<td>Power : '.strtoupper($supply_p_amt).' Units '.strtoupper($supply_p_unit).' &nbsp;Source : '.strtoupper($supply_p_src).'</td>
			</tr>       
			<tr>
					<td>Water : '.strtoupper($supply_w_amt).' Units '.strtoupper($supply_w_unit).' &nbsp;Source : '.strtoupper($supply_w_src).'</td>
			</tr> 
			<tr>
					<td>4.5. Block diagram of the buildings & installations, in the proposed supply :</td>
					<td>Diagram is attached</td>
			</tr>
			<tr>
					<td>4.6. Details of housing colony, hospital, school & other infrastructural facilities proposed :</td>
					<td>'.strtoupper($project_report_housing).'</td>
			</tr>
			<tr>
					<td>5. Organisation structure of the proposed manufacturing unit/Factory :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>5.1 Organisation diagrams of proposed enterprise in general-Health, Safety & Environment protection	departments & their linkages to operation & technical department :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>5.2. Proposed Health & Safety Policy :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>5.3. Area allocated for treatment of wastes & affluent :</td>
					<td>'.strtoupper($org_structure_area).'</td>
			</tr>
			<tr>
					<td>5.4. Percentage outlay on safety, health & environment protection measures(in%) :</td>
					<td>'.strtoupper($org_structure_measures).'</td>
			</tr>
			<tr>
					<td colspan="2"><b>6. Meteorological data relating to the site</b></td>
					
			</tr>
			<tr>
					<td>6.1. Average, Minimum & maximum Temperaturehumidity-wind velocities during the previous ten years :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>6.2. Seasonal variations of wind direction :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>6.3. High water level reached during the floods in the area recorded so far :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>7. Communication Links</b></td>
					
			</tr>
			<tr>
					<td>7.1. Availability of telephone/telex wireless & other communication facilities for outside communication :</td>
					<td>'.strtoupper($communication_link_details).'</td>
			</tr>
			<tr>
					<td>7.2. Internal communication facilities proposed :</td>
					<td>'.strtoupper($communication_link_facility).'</td>
			</tr>
			<tr>
					<td colspan="2"><b>8.Manufacturing process information</b></td>					
			</tr>			
			<tr>
					<td>8.1. Process flow diagram :</td>
					<td>Diagram is attached.</td>
			</tr>
			<tr>
					<td>8.2. Brief write up on process & technology :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>8.3. Critical process parameters such as pressure build-up, temperature rise & run-way reactions :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>8.4. Different aspects critical to the process having safety implications, such as ingress of moisture or water, contact with incompatible substances, sudden power failure :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>8.5. Highlights of the building safety pollution control devices or measures/incorporated in the manufacturing process :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>9. Information of Hazardous Materials</b></td>
					
			</tr>
			<tr>
					<td>9.1. Raw materials, intermediates, products & by products & their quantities (enclose Material safety data sheet in respect of each hazardous such stances) :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>9.2. Main & intermediate shortages proposed for raw materials/intermediates/products/by-products(Maximum quantities to be stored at any time) :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>9.3. Transportation methods to be used for materials in flow & out flow, their quantities & likely routes to be followed :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>9.4. Measures proposed for handling of materials, internal & external transportation & disposal (packing & forwarding of finished products :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>10. Information of Dispersal/Disposal of wastes & Pollutant</b></td>
					
			</tr>
			<tr>
					<td>10.1. Major pollutants(Gas, liquid, solid, their characteristics & quantities (average & at peak load) :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>10.2. Quality & Quantity of solid wastes generated, method of their treatment & disposal :</td>
					<td>Document is attached.</td>
			</tr>	
			<tr>
					<td>10.3. Air, water and soil pollutions problems anticipated & the proposed measures to control the same, including treatment & disposal of affluent :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>11. Process Hazards information.</b></td>
					
			</tr>
			<tr>
					<td>11.1. Enclose a copy of the report on environmental impact assessment :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>11.2. Enclose a copy of the report on Risk Assessment study :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>11.3. Published (open or classified) reports, if any, on accident situations/occupational health hazards of similar plants elsewhere (within or outside the country) :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>12. Information of proposed safety & occupational health Measures :</b></td>
					
			</tr>
			<tr>
					<td>12.1. Details of fire fighting facilities & minimum quantity or water, CO2 or other fire fighting measures needed to meet the emergencies :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>12.2. Details of in house medical facilities proposed :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td colspan="2"><b>13. Information of Emergency.</b></td>
					
			</tr>
			<tr>
					<td>13.1. Outside Emergency Plan :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>13.2. Proposed arrangements, if any for mutual aid scheme with the group of neighboring factories :</td>
					<td>Document is attached.</td>
			</tr>
			<tr>
					<td>14. Any other relevant information :</td>
					<td>'.strtoupper($other_info).'</td>
			</tr>
			<tr>
					<td colspan="2" height="50px"><b>Checklist of the Documents--</b><br/>
				  *N/A -- Not Available<br/>
				  *S/C -- Send By Courier</td>
			</tr>
				<tr>
					<td width="40%" >1. Site plan.</td>
					<td>'.$val1.'</td> 
				</tr>
				<tr>
					<td >2. Contour map of the area showing nearby hillocks & difference in levels.</td>
					<td >'.$val2.'</td> 
				</tr>
				<tr>
					<td >3. Plot plan of the factory showing the entry & exit Points, roads, within water drains, etc.</td>
					<td >'.$val3.'</td> 
				</tr>
				<tr>
					<td >4. Block diagram of the buildings & installations, in the proposed supply and Organisation structure with diagrams (as stated in 4.5, 5, 5.1 and 5.2).</td>
					<td >'.$val4.'</td> 
				</tr>
				<tr>
					<td >5. Meteorological data relating to the site .(as stated in 6.1, 6.2 and 6.3).</td>
					<td >'.$val5.'</td> 
				</tr>
				<tr>
					<td >6. Manufacturing Process Information.(as stated in 8.1, 8.2, 8.3, 8.4 and 8.5).</td>
					<td >'.$val6.'</td> 
				</tr>
				<tr>
					<td >7. Information of Hazardous Materials.(as stated in 9.1, 9.2, 9.3 and 9.4).</td>
					<td >'.$val7.'</td> 
				</tr>
				<tr>
					<td >8. Information of Dispersal/Disposal of wastes and Pollutant.(as stated in 10.1, 10.2 and 10.3).</td>
					<td >'.$val8.'</td> 
				</tr>
				<tr>
					<td >9. Process Hazards Information (as stated in 11.1, 11.2 and 11.3).</td>
					<td >'.$val9.'</td> 
				</tr>
				<tr>
					<td >10. Information of proposed safety and occupational health measures (as stated in 12.1 and 12.2).</td>
					<td >'.$val10.'</td> 
				</tr>
				<tr>
					<td >11. Information of Emergency.(as stated in 13.1 and 13.2)</td>
					<td >'.$val11.'</td> 
				</tr>
				<tr>
					<td >12. Enclose Any other copy of relevant information.</td>
					<td >'.$val12.'</td> 
				</tr>';
	
			
			$printContents=$printContents.'
			<tr>
				<td valign="top"><b>Signatures and Dates :</b></td>
				<td align="right">Signature of Applicant : '.strtoupper($key_person).'<br/>
				Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
			</tr>
		</table>';
}
?>

