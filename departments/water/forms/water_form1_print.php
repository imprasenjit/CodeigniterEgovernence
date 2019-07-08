<?php
$dept="water";
$form="1";
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
	
/*if(isset($css)){
	$email=$formFunctions->executeQuery($dept,"select email from users where id='$applicant_id'")->fetch_object();
}else{
	$email=$formFunctions->executeQuery($dept,"select email from users where id='$sid'")->fetch_object();
}*/

if($q->num_rows>0){
	$results=$q->fetch_assoc();
	####### Part 1######
	$form_id=$results["form_id"];
	$residential="";$residential_other="";  $institutional=""; $commercial=""; $industrial="";$other="";
	$fat_name=$results["fat_name"];$documents=$results["documents"];$property_type=$results["property_type"];$property_type_sub_category=$results["property_type_sub_category"];$occu_pro=$results["occu_pro"];$tot_per=$results["tot_per"];
	
	if($property_type=="R"){
		$residential=$property_type_sub_category;
		if(strlen($residential)>3){
			$residential_other=substr($residential, 8);
		}
	}else if($property_type=="I"){
		$institutional=$property_type_sub_category;
	}else if($property_type=="C") $commercial=$property_type_sub_category;
	else if($property_type=="IN") $industrial=$property_type_sub_category;
	else if(strlen($property_type)>3) $other=substr($property_type, 8);
	else {}
			
	if($property_type=="R"){
		$property="Residential";
		if($property_type_sub_category=="IH") $property_type_sub_category="Independent House";
		if($property_type_sub_category=="CD") $property_type_sub_category="Collective Dwelling (Old age home, Orphanage, Destitute home included)";
		if($property_type_sub_category=="R") $property_type_sub_category="Residence cum other use";
		if($property_type_sub_category=="A") $property_type_sub_category="Apartment";
		if(strlen($property_type_sub_category)>3) $property_type_sub_category=$property_type_sub_category;
	}else if($property_type=="I"){
		$property="Institutional";
		if($property_type_sub_category=="HCF") $property_type_sub_category="Health Care Facility";
		if($property_type_sub_category=="EI") $property_type_sub_category="Educational Institute";
		if($property_type_sub_category=="PAO") $property_type_sub_category="Public Administration Office";
		if($property_type_sub_category=="R") $property_type_sub_category="Religious Place";
	}else if($property_type=="C"){
		$property="Commercial Place";
		if($property_type_sub_category=="O") $property_type_sub_category="Office";
		if($property_type_sub_category=="S") $property_type_sub_category="Shop";
		if($property_type_sub_category=="SC") $property_type_sub_category="Shopping Complex";
		if($property_type_sub_category=="SM") $property_type_sub_category="Shopping Mall";
		if($property_type_sub_category=="R") $property_type_sub_category="Restaurant";
		if($property_type_sub_category=="HO") $property_type_sub_category="Hotel";
		if($property_type_sub_category=="G") $property_type_sub_category="Guesthouse";
		if($property_type_sub_category=="H") $property_type_sub_category="Hostel";
	}else if($property_type=="IND"){
		$property="Industrial";
		if($property_type_sub_category=="W") $property_type_sub_category="Workshops";
		if($property_type_sub_category=="F") $property_type_sub_category="Factories";
		if($property_type_sub_category=="I") $property_type_sub_category="Industries";
	}else if(strlen($property_type)>3){
		$property=$property_type;
	}else {}
			
	if(!empty($results["pro_add"])){
		$pro_add=json_decode($results["pro_add"]);
		$pro_add_byelane=$pro_add->byelane;$pro_add_area=$pro_add->area;$pro_add_col_name=$pro_add->col_name;$pro_add_nl=$pro_add->nl;$pro_add_road=$pro_add->road;$pro_add_holding_no=$pro_add->holding_no;
	}else{				
		$pro_add_byelane="";$pro_add_area="";$pro_add_col_name="";$pro_add_nl="";$pro_add_road="";$pro_add_holding_no="";
	}
	if(!empty($results["b_add"])){
		$b_add=json_decode($results["b_add"]);				
		$bill_house=$b_add->a;$bill_locality=$b_add->b;$b_byelane=$b_add->c;$bill_ward=$b_add->d;$bill_dag=$b_add->e;$bill_patta=$b_add->f;$bill_mouza=$b_add->g;$bill_society=$b_add->h;$bill_road=$b_add->i;$bill_area=$b_add->j;$bill_landmark=$b_add->k;$bill_vill=$b_add->l;$bill_pincode=$b_add->m;$bill_mobile=$b_add->n;
	}else{				
		$bill_house="";$bill_locality="";$b_byelane="";$bill_ward="";$bill_dag="";$bill_patta="";$bill_mouza="";$bill_society="";$bill_road="";$bill_area="";$bill_landmark="";$bill_vill="";$bill_pincode="";$bill_mobile="";
	}
	if(!empty($results["tot_per"])){
		$tot_per=json_decode($results["tot_per"]);
		$tot_per_a=$tot_per->a;$tot_per_m=$tot_per->m;
	}else{				
		$tot_per_a="";$tot_per_m="";
	}
			
	########## Part 2#####
	$connect_type=$results["connect_type"];$comm_mode=$results["comm_mode"];$gps_point=$results["gps_point"];
	if(!empty($results["is_connection"])){
		$is_connection=json_decode($results["is_connection"]);  
		if(isset($is_connection->a)) $is_connection_a=$is_connection->a; else $is_connection_a="";
		if(isset($is_connection->b)) $is_connection_b=$is_connection->b; else $is_connection_b="";
	}else{				
		$is_connection_a="";$is_connection_b="";
	}
	if(!empty($results["is_arrear"])){
		$is_arrear=json_decode($results["is_arrear"]);
		if(isset($is_arrear->a)) $is_arrear_a=$is_arrear->a; else $is_arrear_a="";
		if(isset($is_arrear->b)) $is_arrear_b=$is_arrear->b; else $is_arrear_b="";
	}else{				
		$is_arrear_a="";$is_arrear_b="";
	}
	if(!empty($results["declaration"])){
		$declaration=json_decode($results["declaration"]);
		$declaration_a=$declaration->a; $declaration_b=$declaration->b;$declaration_c=$declaration->c;  $declaration_d=$declaration->d; $declaration_e=$declaration->e; 
	}else{				
		$declaration_a="";$declaration_b="";$declaration_c="";$declaration_d="";$declaration_e="";
	}
}

if($is_connection_a=="Y") $is_connection_a="YES"; else $is_connection_a="NO";
if($is_arrear_a=="Y") $is_arrear_a="YES"; else $is_arrear_a="NO";
if($documents=="GO") $documents="Govt. Organization";
else if($documents=="HCF") $documents="Health Care Facility";
else if($documents=="EI") $documents="Govt. or Govt. aided Educational Institute";
else if($documents=="PEI") $documents="Private Educational Institute";
else  $documents="Religious places";
if($occu_pro=="O") $occu_pro="Owner";
else if($occu_pro=="T") $occu_pro="Tenant";
else $occu_pro="Lessee";
if($connect_type=="T") $connect_type="Temporary";
else if($connect_type=="P") $connect_type="Permanent";
else $connect_type="Alteration to existing connection";
if($comm_mode=="ES") $comm_mode="Email and SMS";
else $comm_mode="Paper Format and SMS";

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
		$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<div style="text-align:center">
		'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>  				
				<td valign="top"  colspan="2">1. Details of Applicant :</td>
			</tr>
			<tr>
					<td width="50%">a) Name : </td>
					<td>'.strtoupper($key_person).' </td>
			</tr>
			<tr>
					<td>b) Designation : </td>
					<td>'.strtoupper($status_applicant).'</td>
			</tr>
			<tr>
					<td>c)Father/Spouse Name :  </td>
					<td>'.strtoupper($fat_name).'</td>
			</tr>
			<tr>
					<td>d) Please Tick the relevant box and furnish supporting document for the same : </td>
					<td>'.strtoupper($documents).'</td>
			</tr>
			<tr>
					<td colspan="2">2. Contact Details : </td>
			</tr>
			<tr>
					<td >a) Mobile NO. : </td>
					<td >'.strtoupper($mobile_no).' </td>
			</tr>
			<tr>
					<td >b) Office No. : </td>
					<td >'.strtoupper($b_mobile_no).' </td>
			</tr>
			<tr>
				<td valign="top">3. Property Address :</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>House No.</td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Locality</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Bye-lane</td>
						<td>'.strtoupper($pro_add_byelane).'</td>
					</tr>
					<tr>
						<td>Ward No.</td>
						<td>'.strtoupper($b_block).'</td>
					</tr>
					<tr>
						<td>Dag No.</td>
						<td>'.strtoupper($dag_no).'</td>
					</tr>
					<tr>
						<td>Patta No.</td>
						<td>'.strtoupper($patta_no).'</td>
					</tr>
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($mouza).'</td>
					</tr>
					<tr>
						<td>Society / Colony Name</td>
						<td>'.strtoupper($pro_add_col_name).'</td>
					</tr>
					<tr>
						<td>Road</td>
						<td>'.strtoupper($pro_add_road).'</td>
					</tr>
					<tr>
						<td>Area</td>
						<td>'.strtoupper($pro_add_area).'</td>
					</tr>
					<tr>
						<td>Nearest Landmark 	</td>
						<td>'.strtoupper($pro_add_nl).'</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>Holding No</td>
						<td>'.strtoupper($pro_add_holding_no).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile no.</td>
						<td>+91 - '.strtoupper($b_mobile_no).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>4. Type of Property as per use :</td><td>'.strtoupper($property).' - '.strtoupper($property_type_sub_category).'</td>
			</tr>
			<tr>
				<td>(b) Occupant of the Property :</td>
				<td>'.strtoupper($occu_pro).'</td>
			</tr>
			<tr>
				<td colspan="2">(c) Total number of persons actually living in the property including tenants :</td>
			</tr>
			<tr>
				<td>i. Adults :</td>
				<td>'.strtoupper($tot_per_a).'</td>
			</tr>
			<tr>
				<td >ii. Minors :</td>
				<td>'.strtoupper($tot_per_m).'</td>
			</tr>
			<tr>
				<td valign="top">5. Billing Address (For future use) :</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>House No.</td>
						<td>'.strtoupper($bill_house).'</td>
					</tr>
					<tr>
						<td>Locality</td>
						<td>'.strtoupper($bill_locality).'</td>
					</tr>
					<tr>
						<td>Bye-lane</td>
						<td>'.strtoupper($b_byelane).'</td>
					</tr>
					<tr>
						<td>Ward No.</td>
						<td>'.strtoupper($bill_ward).'</td>
					</tr>
					<tr>
						<td>Dag No.</td>
						<td>'.strtoupper($bill_dag).'</td>
					</tr>
					<tr>
						<td>Patta No.</td>
						<td>'.strtoupper($bill_patta).'</td>
					</tr>
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($bill_mouza).'</td>
					</tr>
					<tr>
						<td>Society / Colony Name</td>
						<td>'.strtoupper($bill_society).'</td>
					</tr>
					<tr>
						<td>Road</td>
						<td>'.strtoupper($bill_road).'</td>
					</tr>
					<tr>
						<td>Area</td>
						<td>'.strtoupper($bill_area).'</td>
					</tr>
					<tr>
						<td>Nearest Landmark 	</td>
						<td>'.strtoupper($bill_landmark).'</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>'.strtoupper($bill_vill).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($bill_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile no.</td>
						<td>'.strtoupper($bill_mobile).'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>6. Type of Connection needed :</td>
				<td>'.strtoupper($connect_type).' </td>
			</tr>
			<tr>
				<td>7. Whether there is already a connection to the premises from GMC,PHED or AUWSSB. If yes, Please specify along with Consumer No. :</td>
				<td>'.strtoupper($is_connection_a).' '.strtoupper($is_connection_b).'</td>
			</tr>
			<tr>
				<td>8. Is there any arrear fee outstanding against previous water supply connection? If yes,Please provide details: </td>
				<td>'.strtoupper($is_arrear_a).' '.strtoupper($is_arrear_b).'</td>
			</tr>
			<tr>
				<td colspan="2">9. Other details : </td>
			</tr>
		
			<tr>
				<td> Preferred Mode of Communication :   </td>
				<td>'.strtoupper($comm_mode).'</td>
			</tr>		
			<tr>
				<td colspan="2">11. Declaration :<br/><br/>
				a) I / We certify that the above information is correct and true to the best of my /our knowledge.<br/>
				b) I / We undertake to abide by the &nbsp;'.strtoupper($declaration_a).'&nbsp; as amended to from time to time and all other relevant orders and notifications that would come up from time to time in future.<br/>
				c) I / We undertake to pay to &nbsp;'.strtoupper($declaration_b).'&nbsp; all such fees / charges as are applicable for the purpose.<br/>
				d) I / We undertake that in future if no bill is received by me / us by the prescribed time of the month towards user fee / charges, it would be my/our responsibility to contact the Officer-in- charge of the  &nbsp;'.strtoupper($declaration_c).'&nbsp; in the are to the collect the bill and pay up the latest updated water bill(s) against my / our premises by the date(s) prescribed in the bill(s), failing which the  &nbsp;'.strtoupper($declaration_d).'&nbsp; will have the right to take appropriate action in the matter including disconnecting the service if so needed.<br/>
				e) I / We understand that a sanction for water connection to the above mentioned premises by the  &nbsp;'.strtoupper($declaration_e).'&nbsp; will be restricted only to water service provision and that such a sanction of house connection will have no implication in any form including legality on ownership of the property.</td>
			</tr>
			<tr>
				<td> GPS Point :   </td>
				<td>'.strtoupper($gps_point).'</td>
			</tr>
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			<tr>
				<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="center">Signature of the Applicant : '.strtoupper($key_person).'</td>
			</tr>
	</table>';
?>