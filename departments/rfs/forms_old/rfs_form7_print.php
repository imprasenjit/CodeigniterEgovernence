<?php if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and form_id='$form_id'") or die($rfs->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$rfs->query("select * from rfs_form7 where uain='$uain' and user_id='$swr_id'") or die($rfs->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and form_id='$form_id'") or die($rfs->error);		
	}else{
		$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and active='1'") or die($rfs->error);
	}
	if(isset($css)){ 
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}	
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	$land_type=$row1['w_l'];$mouza=$row1['mouza'];$patta_no=$row1['pattano'];$dag_no=$row1['dagno'];$pan_doc=$row1['pan_doc'];$ubin=$row1['ubin'];
	;$circle=$row1['revenue'];$area=$b_street_name3." ,".$b_street_name4;
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative otheriety";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Asotheriation of Persons";$l_o_business_name="Members";
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
	$q=$rfs->query("select * from rfs_form7 where user_id='$swr_id' and active='1' ") or die($rfs->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){	
		$form_id=$results["form_id"];
		$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];$date_of_estab=$results["date_of_estab"];$operation_area=$results["operation_area"];
		$reg_fees=$results['reg_fees'];$results['payment_mode'];$offline_challan =$results['offline_challan'];	
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		
		if(!empty($results['society'])){
			$society=json_decode($results['society']);
			$society_name=$society->name;$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
		}else{
			$society_name="";$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_locality="";$society_vill="";$society_post_office="";$society_police_station="";$society_dist="";$society_pincode="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		#### PART II####
		if(!empty($results["objects"])){
			$objects=json_decode($results["objects"]);
			if(isset($objects->rural)) $objects_rural=$objects->rural;
			else $objects_rural="";
			if(isset($objects->health)) $objects_health=$objects->health;
			else $objects_health="";
			if(isset($objects->women)) $objects_women=$objects->women;
			else $objects_womenr="";				
			if(isset($objects->education)) $objects_education=$objects->education;
			else $objects_education="";
			if(isset($objects->science)) $objects_science=$objects->science;
			else $objects_science="";
			if(isset($objects->art)) $objects_art=$objects->art;
			else $objects_art="";
			if(isset($objects->sports)) $objects_sports=$objects->sports;
			else $objects_sports="";
			if(isset($objects->agriculture)) $objects_agriculture=$objects->agriculture;
			else $objects_agriculture="";
			if(isset($objects->environment)) $objects_environment=$objects->environment;
			else $objects_environment="";
			if(isset($objects->others)) $objects_others=$objects->others;
			else $objects_others="";
		}else{
			$objects_rural="";$objects_health="";$objects_women="";$objects_education="";$objects_science="";$objects_art="";$objects_sports="";$objects_agriculture="";$objects_environment="";$objects_others="";
		}	
		if(!empty($results["objects_of_society"])){
			$objects_of_society=json_decode($results["objects_of_society"]);
			$objects_of_society_rural=$objects_of_society->rural;$objects_of_society_health=$objects_of_society->health;$objects_of_society_women=$objects_of_society->women;$objects_of_society_education=$objects_of_society->education;$objects_of_society_science=$objects_of_society->science;$objects_of_society_art=$objects_of_society->art;$objects_of_society_sports=$objects_of_society->sports;$objects_of_society_agri=$objects_of_society->agri;$objects_of_society_env=$objects_of_society->env;$objects_of_society_other=$objects_of_society->other;
		}else{
			$objects_of_society_rural="";$objects_of_society_health="";$objects_of_society_women="";$objects_of_society_education="";$objects_of_society_science="";$objects_of_society_art="";$objects_of_society_sports="";$objects_of_society_agri="";$objects_of_society_env="";$objects_of_society_other="";
		}
		###### PART III #####
		$proced=$results["proced"];$quorum=$results["quorum"];$election=$results["election"];$short_desc=$results["short_desc"];$term=$results["term"];$re_election=$results["re_election"];$procedure_f_meet=$results["procedure_f_meet"];$quorum_f_meet=$results["quorum_f_meet"];$expulsion=$results["expulsion"];$auditor=$results["auditor"];$legal_procedure=$results["legal_procedure"];$dissolution=$results["dissolution"];
		if(!empty($results["members"])){
			$members=json_decode($results["members"]);
			$members_qualification=$members->qualification;$members_subscription=$members->subscription;$members_collection=$members->collection;$members_control=$members->control;
		}else{
			$members_qualification="";$members_subscription="";$members_collection="";$members_control="";
		}
		if(!empty($results["general_meeting"])){
			$general_meeting=json_decode($results["general_meeting"]);
			$general_meeting_dte=$general_meeting->dte;$general_meeting_place=$general_meeting->place;$general_meeting_number=$general_meeting->number;
		}else{
			$general_meeting_dte="";$general_meeting_place="";$general_meeting_number="";
		}
		if(!empty($results["treasury"])){
			$treasury=json_decode($results["treasury"]);
			$treasury_challan_no=$treasury->challan_no;$treasury_challan_date=$treasury->challan_date;$treasury_challan_branch=$treasury->challan_branch;$treasury_amount=$treasury->amount;
		}else{
			$treasury_challan_no="";$treasury_challan_date="";$treasury_challan_branch="";$treasury_amount="";
		}
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($results["file1"]);
			$val2=$formFunctions->get_uploadFile($results["file2"]);
			$val3=$formFunctions->get_uploadFile($results["file3"]);
			$val4=$formFunctions->get_uploadFile($results["file4"]);
			$val5=$formFunctions->get_uploadFile($results["file5"]);
			$val6=$formFunctions->get_uploadFile($results["file6"]);
		}else{
			$val1=$formFunctions->get_useruploadFile($results["file1"],$applicant_id);
			$val2=$formFunctions->get_useruploadFile($results["file2"],$applicant_id);
			$val3=$formFunctions->get_useruploadFile($results["file3"],$applicant_id);
			$val4=$formFunctions->get_useruploadFile($results["file4"],$applicant_id);
			$val5=$formFunctions->get_useruploadFile($results["file5"],$applicant_id);
			$val6=$formFunctions->get_useruploadFile($results["file6"],$applicant_id);
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
	$q1=$rfs->query("select * from rfs_form7_members where form_id='$form_id'");
	$results1=$q1->fetch_assoc();
	if($q1->num_rows>0){
		$form_id=$results1['form_id'];
		$member_address=$results1['member_address'];$member_occupation=$results1['member_occupation'];$member_designation=$results1['member_designation'];
	}
	$form_name=$formFunctions->get_formName('rfs','7');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	
	
	if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form VII</title>
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
  			'.$assamSarkarLogo.'<h4>Form No VIII</h4>
  			<h4>'.$form_name.'</h4>
		</div><br/>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >			
			<tr>				
				<td width="50%">1. Name of the Society</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td>2. Registration No </td>
				<td>'.strtoupper($ubin).'</td>
			</tr>
			<tr>
				<td>3. Date of Registration :</td>
				<td>'.date("d-m-Y",strtotime($date_of_registration)).'</td>
			</tr>
			<tr>
				<td>4. Date of Establishment :</td>
				<td>'.date("d-m-Y",strtotime($date_of_commencement)).'</td>
			</tr>
			<tr>
				<td valign="top">5. Address of the Society </td>
				<td width="50%">
				<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($mouza).'</td>
					</tr>
					<tr>
						<td>Circle</td>
						<td>'.strtoupper($circle).'</td>
					</tr>
					<tr>
						<td>Patta no</td>
						<td>'.strtoupper($patta_no).'</td>
					</tr>
					<tr>
						<td>Dag no</td>
						<td>'.strtoupper($dag_no).'</td>
					</tr>
					<tr>
						<td>Area</td>
						<td>'.strtoupper($area).'</td>
					</tr>
					<tr>
						<td>Locality</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>Post Office</td>
						<td>'.strtoupper($post_office).'</td>
					</tr>
					<tr>
						<td>Police Station</td>
						<td>'.strtoupper($police_station).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pin code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Email ID</td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">6. Memorandum of Association</td>
			</tr>
			<tr>
				<td>6.1 Name of the Society</td>
				<td>'.strtoupper($society_name).'</td>
			</tr>
			<tr>
				<td valign="top">6.2 Address of the Society </td>
				<td width="50%">
				<table width="99%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($society_mouza).'</td>
					</tr>
					<tr>
						<td>Circle</td>
						<td>'.strtoupper($society_circle).'</td>
					</tr>
					<tr>
						<td>Patta no</td>
						<td>'.strtoupper($society_patta_no).'</td>
					</tr>
					<tr>
						<td>Dag no</td>
						<td>'.strtoupper($society_dag_no).'</td>
					</tr>
					<tr>
						<td>Area</td>
						<td>'.strtoupper($society_area).'</td>
					</tr>
					<tr>
						<td>Locality</td>
						<td>'.strtoupper($society_locality).'</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>'.strtoupper($society_vill).'</td>
					</tr>
					<tr>
						<td>Post Office</td>
						<td>'.strtoupper($society_post_office).'</td>
					</tr>
					<tr>
						<td>Police Station</td>
						<td>'.strtoupper($society_police_station).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($society_dist).'</td>
					</tr>
					<tr>
						<td>Pin code </td>
						<td>'.strtoupper($society_pincode).'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td valign="top">6.3 The objects for which the Society is established are</td>
				<td>'.strtoupper($objects_rural) .'<br/>
					'.strtoupper($objects_health) .'<br/>
					'.strtoupper($objects_women) .'<br/>
					'.strtoupper($objects_education) .'<br/>
					'.strtoupper($objects_science) .'<br/>
					'.strtoupper($objects_art) .'<br/>
					'.strtoupper($objects_sports) .'<br/>
					'.strtoupper($objects_agriculture) .'<br/>
					'.strtoupper($objects_environment) .'<br/>
					'.strtoupper($objects_others) .'<br/>
				</td>
			</tr>
			<tr>
				<td colspan="2">6.4 The name, address and designation of the present members of the Executive Committee or Governing Body.</td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="100%" align="center" class=" text-center table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<thead>
					<tr>
						<th>Sl No.</th>
						<th>Name of the Members</th>
						<th>Address</th>
						<th>Occupation</th>
						<th>Designation</th>
					</tr>
					</thead>
					';
					$results1=$rfs->query("select * from rfs_form7_members where form_id='$form_id'") or die("Error : ".$rfs->error);
					$sl=1;
					while($rows=$results1->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->member_name).'</td>
							<td>'.strtoupper($rows->member_address).'</td>
							<td>'.strtoupper($rows->member_occupation).'</td>
							<td>'.strtoupper($rows->member_designation).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="4">6.5 We the undersigned are desirous of forming a society in pursuance of the Memorandum of Association.</td>
			</tr>
			<tr>
				<td colspan="2">
				<table width="100%" align="center" class=" text-center table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
					<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Scanned copy of signatures of the members of the society in full</th>
						<th>Address</th>
						<th>Occupation</th>
						<th>Designation</th>
					</tr>
					</thead>';				
					$part1=$rfs->query("SELECT * FROM rfs_form7_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["signature"]).'</td>
							<td>'.strtoupper($row_1["address"]).'</td>
							<td>'.strtoupper($row_1["occupation"]).'</td>
							<td>'.strtoupper($row_1["designation"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>   
				</td>
			</tr>
			<tr>
				<td>6.6 Date of Establishment</td>
				<td> '.strtoupper($date_of_estab).'</td>
			<tr>
			<tr>
				<td colspan="2">7. Rules and Regulation of the society</td>
			</tr>
			<tr>
				<td>7.1 Area of operation</td>
				<td> '.strtoupper($operation_area).'</td>
			<tr>
			<tr>
				<td colspan="2">7.2 Objects: The objects of the Society should be written elaborately</td>				
			</tr>
			<tr>
				<td>(a) Rural Development</td>
				<td> '.strtoupper($objects_of_society_rural).'</td>
			</tr>
			<tr>
				<td>(b) Health</td>
				<td> '.strtoupper($objects_of_society_health).'</td>
			</tr>
			<tr>
				<td>(c) Women & Child Welfare</td>
				<td> '.strtoupper($objects_of_society_women).'</td>
			</tr>
			<tr>
				<td>(d) Education</td>
				<td> '.strtoupper($objects_of_society_education).'</td>
			</tr>
			<tr>
				<td>(f) Art & Culture</td>
				<td> '.strtoupper($objects_of_society_art).'</td>
			</tr>
			<tr>
				<td>(g) Sports</td>
				<td> '.strtoupper($objects_of_society_sports).'</td>
			</tr>
			<tr>
				<td>(h) Agriculture</td>
				<td> '.strtoupper($objects_of_society_agri).'</td>
			</tr>
			<tr>
				<td>(i) Environment</td>
				<td> '.strtoupper($objects_of_society_env).'</td>
			</tr>
			<tr>
				<td>(j) Others</td>
				<td> '.strtoupper($objects_of_society_other).'</td>
			</tr>
			<tr>
				<td colspan="2">7.3 Members</td>
			</tr>
			<tr>
				<td>(a) Qualification to become Members</td>
				<td> '.strtoupper($members_qualification).'</td>
			</tr>
			<tr>
				<td>(b) Subscription, Donation etc.</td>
				<td> '.strtoupper($members_subscription).'</td>
			</tr>
			<tr>
				<td>(c) Collection of Fund</td>
				<td> '.strtoupper($members_collection).'</td>
			</tr>
			<tr>
				<td>(d) Control of Fund</td>
				<td> '.strtoupper($members_control).'</td>
			</tr>
			<tr>
				<td>7.4 Procedure of the General Meeting (How many times in a year General Meeting will be held)</td>
				<td> '.strtoupper($proced).'</td>
			</tr>
			<tr>
				<td>7.5 Quorum of the General Meeting (How many times of the total members of the General Body are required to be present to form quorum of the General body meeting.</td>
				<td> '.strtoupper($quorum).'</td>
			</tr>
			<tr>
				<td>7.6 Election procedure of the Executive Committee/Governing Body/Managing Committee</td>
				<td> '.strtoupper($election).'</td>
			</tr>
			<tr>
				<td>7.7 Short description of the Executive Body. (This description must tally with the list given in the item no. 4.4 of the Memorandum of Association.</td>
				<td> '.strtoupper($short_desc).'</td>
			</tr>
			<tr>
				<td>7.8 The term of the Executive Committee</td>
				<td> '.strtoupper($term).'</td>
			</tr>
			<tr>
				<td>7.9 Procedure of the Re-election of the members of the Executive Committee</td>
				<td> '.strtoupper($re_election).'</td>
			</tr>
			<tr>
				<td>7.10 Procedure of the meeting of the Executive Committee. (How many times in a year or month the meeting of the Executive body will be held)</td>
				<td> '.strtoupper($procedure_f_meet).'</td>
			</tr>
			<tr>
				<td>7.11 Quorum of the Meeting of the Executive Committee. (How many of the members of the Executive Body required to be present to form Quorum of the meeting of the Executive Body)</td>
				<td> '.strtoupper($quorum_f_meet).'</td>
			</tr>
			<tr>
				<td>7.12 Expulsion of undesirable member</td>
				<td> '.strtoupper($expulsion).'</td>
			</tr>
			<tr>
				<td>7.13 Auditor</td>
				<td> '.strtoupper($auditor).'</td>
			</tr>
			<tr>
				<td>7.14 Legal Procedure</td>
				<td> '.strtoupper($legal_procedure).'</td>
			</tr>
			<tr>
				<td>7.15 Dissolution</td>
				<td> '.strtoupper($dissolution).'</td>
			</tr>
			<tr>
				<td colspan="2">8. General Meeting</td>
			</tr>
			<tr>
				<td>Date of holding the meeting</td>
				<td> '.strtoupper($general_meeting_dte).'</td>
			</tr>
			<tr>
				<td>Place of meeting</td>
				<td> '.strtoupper($general_meeting_place).'</td>
			</tr>
			<tr>
				<td>Number of public present</td>
				<td> '.strtoupper($general_meeting_number).'</td>
			</tr>
			<tr>
				<td colspan="2">9. Treasury Challan</td>				
			</tr>
			<tr>
					<td>No.</td>
					<td> '.strtoupper($treasury_challan_no).'</td>
			</tr>
			<tr>
					<td>Date</td>
					<td> '.strtoupper($treasury_challan_date).'</td>
			</tr>
			<tr>
					<td>Branch</td>
					<td> '.strtoupper($treasury_challan_branch).'</td>
			</tr>
			<tr>
					<td>Amount</td>
					<td> '.strtoupper($reg_fees).'</td>
			</tr>
			<tr>
					<td colspan="2" height="50px"><b>Checklist of the Documents</b></td>
			</tr>
			<tr>
				<td>1. Scanned copy of witness paper in Memorandum of Association at item no. 5</td>
				<td>'.$val1.'</td> 
			</tr>
			<tr>
				<td>2. Photocopy of registration certificate </td>
				<td>'.$val2.'</td> 
			</tr>
			<tr>
				<td>3. A notice is to be issued to all members of the executive body to hold the meeting to get the certified copy of the documents of the society ten days before the proposed meeting. A copy of the same shall be sent to the Registrar.</td>
				<td>'.$val3.'</td> 
			</tr>
			<tr>
				<td>4. 2 (two) sets of Memorandum of Association and Rules and Regulations of the society.</td>
				<td>'.$val4.'</td> 
			</tr>
			<tr>
				<td>5. Treasury Challan.</td>
				<td>'.$val5.'</td> 
			</tr>
			<tr>
				<td>6. Legal Procedure</td>
				<td>'.$val6.'</td> 
			</tr>
			';
			
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$printContents=$printContents.'
			<tr>		   
				<td colspan="2">
					<table border="0" width="100%">
						<tr><td height="45px" colspan="2">Courier Details.</td></tr>
						<tr><td width="40%">Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="40%">Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="40%">Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
			</tr>';
			}
			$printContents=$printContents.'<tr>
			<tr>
				<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
				<td align="right">
					<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
				</td>
			</tr>
	</table>

';
?>

  