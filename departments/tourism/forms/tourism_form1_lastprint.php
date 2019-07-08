<?php 
if(!isset($get_file_name)){
		ob_start();
		require_once "../../requires/login_session.php";
}
	if(!isset($form_id) && !isset($_GET["token"])){
		echo "<script>
				alert('Invalid Page Access');
			</script>";	
		exit();
	}else if(isset($_GET["token"]) && is_numeric($_GET["token"])){
		$form_id=$_GET["token"];
	}else{
		$form_id=$form_id;
	}
	if(isset($css)){
		$email=$mysqli->query("select email from users where id='$applicant_id'")->fetch_object()->email;
	}else{
		$email=$mysqli->query("select email from users where id='$sid'")->fetch_object()->email;
	}
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$tourism->query("select * from tourism_form1 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	
		$form_id=$results['form_id'];	
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];$file11=$results["file11"];$file12=$results["file12"];$file13=$results["file13"];
		##part1
		$film_title=$results['film_title'];$film_type=$results['film_type'];$feature_film=$results['feature_film'];$any_feature=$results['any_feature'];$applicant_refuse_radio=$results['applicant_refuse_radio'];$applicant_refuse=$results['applicant_refuse'];$film_public_radio=$results['film_public_radio'];$film_public=$results['film_public'];$any_visit_radio=$results['any_visit_radio'];$any_visit=$results['any_visit'];$duration=$results['duration'];$dt_of_comm=$results['dt_of_comm'];$general_info=$results['general_info'];
		#part2
		$wish_to_hire=$results['wish_to_hire'];$cameraman_name=$results['cameraman_name'];$editor_name=$results['editor_name'];$recordist_name=$results['recordist_name'];$film_info=$results['film_info'];
		#part3
		$forest_area=$results['forest_area'];
		#part4
		$temp_film=$results['temp_film'];$total_area=$results['total_area'];$nature=$results['nature'];$electric_dist=$results['electric_dist'];$height_of_ceiling=$results['height_of_ceiling'];$fire_details=$results['fire_details'];$water_detail=$results['water_detail'];$fire_info=$results['fire_info'];
		###part5
		$film_arch=$results['film_arch'];$monument_name=$results['monument_name'];$monument_part=$results['monument_part'];$arch_info=$results['arch_info'];
		
		if($film_type=="F") $film_type="Feature Film ";
	    else $film_type="Documentary ";
		if($applicant_refuse_radio=="Y") $applicant_refuse_radio="YES ";
	    else $applicant_refuse_radio="NO";
		if($film_public_radio=="Y") $film_public_radio="YES ";
	    else $film_public_radio="NO ";
		if($any_visit_radio=="Y") $any_visit_radio="YES ";
	    else $any_visit_radio="NO";
		if($wish_to_hire=="Y") $wish_to_hire="YES";
	    else $wish_to_hire="NO";
		if($forest_area=="Y") $forest_area="YES";
	    else $forest_area="NO";
		if($temp_film=="Y") $temp_film="YES";
		else $temp_film="NO";
		if($film_arch=="Y") $film_arch="YES";
		else $film_arch="NO";
		
		if(!empty($results["film_details"])){
			$film_details=json_decode($results["film_details"]);
			$film_details_org=$film_details->org;$film_details_name=$film_details->name;$film_details_desig=$film_details->desig;$film_details_office=$film_details->office;$film_details_mobile=$film_details->mobile;$film_details_email=$film_details->email;
		}else{
			$film_details_org="";$film_details_name="";$film_details_desig="";$film_details_office="";$film_details_mobile="";$film_details_email="";
		}
		if(!empty($results["rep_details"])){
			$rep_details=json_decode($results["rep_details"]);
			$rep_details_org=$rep_details->org;$rep_details_name=$rep_details->name;$rep_details_desig=$rep_details->desig;$rep_details_office=$rep_details->office;$rep_details_mobile=$rep_details->mobile;$rep_details_email=$rep_details->email;
		}else{
			$rep_details_org="";$rep_details_name="";$rep_details_desig="";$rep_details_office="";$rep_details_mobile="";$rep_details_email="";
		}
		if(!empty($results["access_premise"])){
			$access_premise=json_decode($results["access_premise"]);
			$access_premise_dist=$access_premise->dist;$access_premise_width=$access_premise->width;
		}else{
			$access_premise_dist="";$access_premise_width="";
		}
		if(!empty($results["sur_property"])){
			$sur_property=json_decode($results["sur_property"]);
			$sur_property_east=$sur_property->east;$sur_property_west=$sur_property->west;$sur_property_north=$sur_property->north;$sur_property_south=$sur_property->south;
		}else{
			$sur_property_east="";$sur_property_west="";$sur_property_north="";$sur_property_south="";
		}
		if(!empty($results["open_space"])){
			$open_space=json_decode($results["open_space"]);
			$open_space_eastern=$open_space->eastern;$open_space_western=$open_space->western;$open_space_northern=$open_space->northern;$open_space_southern=$open_space->southern;
		}else{
			$open_space_eastern="";$open_space_western="";$open_space_northern="";$open_space_southern="";
		}
		if(!empty($results["arrangement_details"])){
			$arrangement_details=json_decode($results["arrangement_details"]);
			$arrangement_details_cooking=$arrangement_details->cooking;$arrangement_details_distance=$arrangement_details->distance;
		}else{
			$arrangement_details_cooking="";$arrangement_details_distance="";
		}
		if(!empty($results["fire_st"])){
			$fire_st=json_decode($results["fire_st"]);
			$fire_st_name=$fire_st->name;$fire_st_no=$fire_st->no;
		}else{
			$fire_st_name="";$fire_st_no="";
		}
		if(!empty($results["personnel_detail"])){
			$personnel_detail=json_decode($results["personnel_detail"]);
			$personnel_detail_fire=$personnel_detail->fire;$personnel_detail_no=$personnel_detail->no;
		}else{
			$personnel_detail_fire="";$personnel_detail_no="";
			
		}
		if(!empty($results["electrician_detail"])){
			$electrician_detail=json_decode($results["electrician_detail"]);
			$electrician_detail_name=$electrician_detail->name;$electrician_detail_no=$electrician_detail->no;
		}else{
			$electrician_detail_name="";$electrician_detail_no="";
		}
		if(!empty($results["arch_address"])){
			$arch_address=json_decode($results["arch_address"]);
			$arch_address_building=$arch_address->building;$arch_address_street=$arch_address->street;$arch_address_city=$arch_address->city;$arch_address_locality=$arch_address->locality;$arch_address_pin=$arch_address->pin;$arch_address_dist=$arch_address->dist;
		}else{
			$arch_address_building="";$arch_address_street="";$arch_address_city="";$arch_address_locality="";$arch_address_state="";$arch_address_pin="";$arch_address_dist="";
		}		
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($file1);
			$val2=$formFunctions->get_uploadFile($file2);
			$val3=$formFunctions->get_uploadFile($file3);
			$val4=$formFunctions->get_uploadFile($file4);
			$val5=$formFunctions->get_uploadFile($file5);
			$val6=$formFunctions->get_uploadFile($file6);
			$val7=$formFunctions->get_uploadFile($file7);
			$val8=$formFunctions->get_uploadFile($file8);
			$val9=$formFunctions->get_uploadFile($file9);
			$val10=$formFunctions->get_uploadFile($file10);
			$val11=$formFunctions->get_uploadFile($file11);
			$val12=$formFunctions->get_uploadFile($file12);
			$val13=$formFunctions->get_uploadFile($file13);
		}else{
			$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
			$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
			$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
			$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
			$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
			$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
			$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
			$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
			$val9=$formFunctions->get_useruploadFile($file9,$applicant_id);
			$val10=$formFunctions->get_useruploadFile($file10,$applicant_id);
			$val11=$formFunctions->get_useruploadFile($file11,$applicant_id);
			$val12=$formFunctions->get_useruploadFile($file12,$applicant_id);
			$val13=$formFunctions->get_useruploadFile($file13,$applicant_id);
		}
		if(!empty($results["courier_details"])){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}				
	    $form_name=$cms->query("select form_name from tourism_form_names where form_no='1'")->fetch_object()->form_name;
		$general_info= wordwrap($general_info, 40, "<br/>", true);
		$film_info= wordwrap($film_info, 40, "<br/>", true);
		$fire_info= wordwrap($fire_info, 40, "<br/>", true);
		$arch_info= wordwrap($arch_info, 40, "<br/>", true);
		$fire_details= wordwrap($fire_details, 40, "<br/>", true);
		$water_detail= wordwrap($water_detail, 40, "<br/>", true);
		$personnel_detail_fire= wordwrap($personnel_detail_fire, 40, "<br/>", true);
		$monument_part= wordwrap($monument_part, 40, "<br/>", true);	
}

if(!isset($css)){
$printContents='
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
#form1 table {
  vertical-align: middle;
}
</style>
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
        <h4>FORM NO. 1</h4>
          <h4>'.$form_name.'</h4>
        </div><br/>  

    <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>
				<td colspan="2" align="center"><h5><b>General Information</b></h5></td>
			</tr>
			<tr>
				<td width="60%">1. Title of the Film:</td>
				<td width="40%">'.strtoupper($film_title).'</td>
			</tr>
			<tr>
				<td>2. Type of Film: </td>
				<td>'.strtoupper($film_type).'</td>
				
			</tr>
			<tr>
				<td colspan="2">3. Details of the Production House/Company/Producer/Film Maker of the Film:</td>

			</tr>
			<tr>
				<td>a) Organization/Company:</td>
				<td>'.strtoupper($film_details_org).'</td>
			</tr>
			<tr>
				<td>b) Name of Authorized Person:</td>
				<td>'.strtoupper($film_details_name).'</td>
			</tr>
			<tr>
				<td>c) Designation of Authorized Person:</td>
				<td>'.strtoupper($film_details_desig).'</td>
			</tr>
			<tr>
				<td>d)Address of the Registered Office:</td>
				<td>'.strtoupper($film_details_office).'</td>
			</tr>
			<tr>
				<td>e) Mobile Phone No.:</td>
				<td>'.strtoupper($film_details_mobile).'</td>
			</tr>
			<tr>
				<td>f) Email:</td>
				<td>'.$film_details_email.'</td>
			</tr>
			<tr>
				<td colspan="2">4. Details of Representative in Assam, if any:</td>
			</tr>
			<tr>
				<td>a) Organization/Company:</td>
				<td>'.strtoupper($rep_details_org).'</td>
			</tr>
			<tr>
				<td>b) Name of Authorized Person:</td>
				<td>'.strtoupper($rep_details_name).'</td>
			</tr>
			<tr>
				<td>c) Designation of Authorized Person:</td>
				<td>'.strtoupper($rep_details_desig).'</td>
			</tr>
			<tr>
				<td>d)Address of the Registered Office:</td>
				<td>'.strtoupper($rep_details_office).'</td>
			</tr>
			<tr>
				<td>e) Mobile Phone No.:</td>
				<td>'.strtoupper($rep_details_mobile).'</td>
			</tr>
			<tr>
				<td>f) Email:</td>
				<td>'.$rep_details_email.'</td>
			</tr>
			<tr>
				<td>5. Feature film/documentaries made earlier by applicant:</td>
				<td>'.strtoupper($feature_film).'</td>
			</tr> 
			<tr>
				<td>6. Any Feature film/ documentary previously filmed in Assam:</td>
				<td>'.strtoupper($any_feature).'</td>
			</tr>			
			<tr>
				<td>7. Has applicant ever been refused permission of filming in Assam/India?</td>
				<td>'.strtoupper($applicant_refuse_radio).'</td>
			</tr>
			<tr>
				<td>If Yes, Give details.</td>
				<td>'.strtoupper($applicant_refuse).'</td>
			</tr>
			<tr>
				<td>8. Is the film/documentary for public broadcast?</td>
				<td>'.strtoupper($film_public_radio).'</td>
			</tr>
			<tr>
				<td>If Yes, Give details.</td>
				<td>'.strtoupper($film_public).'</td>
			</tr>
			<tr>
				<td>9. Is any pre-filming visit intended:</td>
				<td>'.strtoupper($any_visit_radio).'</td>
			</tr>
			<tr>
				<td>If Yes, Give details.</td>
				<td>'.strtoupper($any_visit).'</td>
			</tr>
			<tr>
				<td>10. Duration of the filming operation:</td>
				<td>'.strtoupper($duration).'</td>
			</tr>
			<tr>
				<td>11. Date of Commencement of the filming operation in Assam:</td>
				<td>'.strtoupper($dt_of_comm).'</td>
			</tr>
			<tr>
				<td>12. Any other information to be declared</td>
				<td>'.strtoupper($general_info).'</td>
			
			</tr>
			<tr>
				<td colspan="2" align="center"><h5><b>Film Society</b></h5></td>
			</tr>
			<tr>
				<td>Do You Wish to Hire Equipment/Studio from Jyoti Chitraban (Film Studio) Society?</td>
				<td>'.strtoupper($wish_to_hire).'</td>
			</tr>
			';
			if($wish_to_hire=="YES"){
				$printContents=$printContents.'
			<tr>
				<td colspan="4">1. Name of the Studio Equipment/Campus Floor/G.Van/Sound Dept/Video Dept etc. required:</td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="99%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">
			
					<thead>
					<tr>
						<th width="25%" align="center" rowspan="2">Name of the Studio Equipment/Campus Floor/G.Van/Sound Dept/Video Dept etc.</th>
						<th width="25%" align="center" colspan="2">Hire Period</th>
						<th width="25%" align="center" rowspan="2">Location</th>
						<th width="25%" align="center" rowspan="2">Call Time</th>
					</tr>
					<tr>
						<th align="center">From</th>
						<th align="center">To</th>
					</tr>
					</thead>';
						
						$part1=$tourism->query("SELECT * FROM tourism_form1_t1 WHERE form_id='$form_id'");
							while($row_1=$part1->fetch_array()){
							$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["name"]).'</td>
								<td>'.strtoupper($row_1["hire_from"]).'</td>
								<td>'.strtoupper($row_1["hire_to"]).'</td>
								<td>'.strtoupper($row_1["location"]).'</td>
								<td>'.strtoupper($row_1["call_time"]).'</td>
							</tr>';
							}$printContents=$printContents.'
					</table>
				</td>
			</tr>
			
			<tr>
				<td>2. Name of the Cameraman:</td>
				<td>'.strtoupper($cameraman_name).'</td>
			</tr>
			<tr>
				<td>3. Name of the Editor:</td>
				<td>'.strtoupper($editor_name).'</td>
			</tr>
			<tr>
				<td >4. Name of the Recordist:</td>
				<td>'.strtoupper($recordist_name).'</td>
			</tr>
			<tr>
				<td>5. Any other information to be declared</td>
				<td>'.strtoupper($film_info).'</td>
			</tr>
			<tr>
				<td colspan="2">Note: Any cancellation will have to be communicated to the Studio Authority in written 7 days ahead; in	case of failure to do so the 50% of the hiring charge will be forfeited.</td>
			</tr>';
			}
			$printContents=$printContents.'
			<tr>
				<td colspan="2" align="center"><h5><b>Environment &amp; Forest</b></h5></td>
			</tr>
			<tr>
				<td>Do You Wish to film at a Forest Area/National Park/Wildlife Sanctuary?</td>
				<td>'.strtoupper($forest_area).'</td>
			</tr>';
			if($forest_area=="YES"){
				$printContents=$printContents.'
			<tr>
				<td colspan="2">Terms &amp; Condition
					<ol>
						<li>A tentative script may be furnished containing exact period of shooting, conveyance, budget etc.</li>
						<li>All the provisions relating to the National Parks, Sanctuaries, Tiger reserves under the Wildlife (P) Act, 1972 and amended
							upto date and guidelines issued by the MoEF shall be adhered to.</li>
						<li>No shooting shall be done between the sunrise and sunset inside protected areas (PAs)</li>
						<li>Shooting will not be permitted to move around in the PAs on foot.</li>
						<li> Use of aircraft will not be permitted.</li>
						<li>No boundary mark of the Protected Areas (PAs) will be damaged, altered, destroyed moved or defaced.</li>
						<li>No wild animal will be teased, molested or disturbed to its natural behavior.</li>
						<li> No damage to any flora or fauna will be caused.</li>
						<li>The ground of the Protected Areas will not be littered.</li>
						<li>The necessary entry fee, filming fee as prescribed by the State Government for Foreign Nationals will be paid before
							entering into the PAs and fee paid receipt shall be furnished while withdrawing security deposit.</li>
						<li>A responsible officer authorized by the PA authority will supervise the activities of the shooting to ensure the adherence of
							all conditions stipulated herein Entry to the PA will be subject to the convenience of the PA Authorities only.</li>
						<li>The Officer in-charge of the Protected Area will reserve the right to cancel/ terminate this permission at any time,
							whenever he considers that the activities resulting from this permission is affecting the flora and fauna adversely or the
							permit holder is not abiding by the stipulations contained herein.</li>
						<li>Three copies of edited film with entire footage will have to be furnished to the Research Officer, O/P the PCCF (WL) Assam
							for official us.</li>
						<li>An amount of Rs 10000/- will have to be deposited in the form of “Fixed deposit” pledged in favor of the Chief Wildlife Warden, Assam, Basistha, Guwahati-29 as a security deposit which will be released immediately after fulfilling the clauses 10 & 13 and also on receipt of the report about satisfactory compliance of all the above stipulations & NOC from PA Authorities for release of security deposit.</li>		
					</ol>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><u>Undertaking</u><br/><br/>			
				I do hereby undertake that I shall abide all the stipulations contained in this permission and I am entering into the PAs at my own risk and in case of any violation of any of the stipulation not only my security deposit will be liable to be forfeited but also I shall be liable to be prosecuted under the relevant provision of law.</td>
			</tr>
			<tr>				
				<td colspan="2" align="right">  <label> '.strtoupper($film_details_name).' </label><br/>Signature of the Applicant</td>
			</tr>';
			}
			$printContents=$printContents.'
			<tr>
				<td colspan="2" align="center"><h5><b>Fire &amp; Safety</b></h5></td>
			</tr>
		   <tr>
				<td>Do you wish to construct/erect temporary film shooting sets?</td>
				<td>'.strtoupper($temp_film).'</td>
			
			</tr>';
			if($temp_film=="YES"){
				$printContents=$printContents.'
			<tr>
				<td>1. Total area proposed to be utilized</td>
				<td>'.strtoupper($total_area).'</td>
			</tr>
			<tr>
				<td>2. Nature and Type of Construction proposed</td>
				<td>'.strtoupper($nature).'</td>
			</tr>
			<tr>
				<td colspan="2">3. Accessibility to the premises</td>
			</tr>
			<tr>
				<td>a. Distance from motor-able road</td>
				<td>'.strtoupper($access_premise_dist).'</td>
			</tr>
			<tr>
				<td>b. Width of the road</td>
				<td>'.strtoupper($access_premise_width).'</td>
			</tr>
			<tr>
				<td colspan="2">4. Surrounding properties</td>
			</tr>
			<tr>
				<td >East</td>
				<td>'.strtoupper($sur_property_east).'</td>
			</tr>
			<tr>
				<td>West</td>
				<td>'.strtoupper($sur_property_west).'</td>
			</tr>
			<tr>
				<td >North</td>
				<td>'.strtoupper($sur_property_north).'</td>
			</tr>
			<tr>
				<td>South</td>
				<td>'.strtoupper($sur_property_south).'</td>
			</tr>
			<tr>
				<td colspan="2">5. Open space available around the Structure</td>
			</tr>
			<tr>
				<td >Eastern</td>
				<td>'.strtoupper($open_space_eastern).'</td>
			</tr>
			<tr>
				<td>Western</td>
				<td>'.strtoupper($open_space_western).'</td>
			</tr>
			<tr>
				<td >Northern</td>
				<td>'.strtoupper($open_space_northern).'</td>
			</tr>
			<tr>
				<td>Southern</td>
				<td>'.strtoupper($open_space_southern).'</td>
			</tr>
			<tr>
				<td >6. a) Details of arrangement for cooking/restaurants/stalls in the premises (if any) and their distance
					from the main structure</td>
				<td>'.strtoupper($arrangement_details_cooking).'</td>
			</tr>
			<tr>
				<td >b) Their distance	from the main structure</td>
				<td>'.strtoupper($arrangement_details_distance).'</td>
			</tr>
			<tr>
				<td>7. Distance to the nearest overhead electric line</td>
				<td>'.strtoupper($electric_dist).'</td>
			</tr>
			<tr>
				<td >8. Height of ceiling of the structure</td>
				<td>'.strtoupper($height_of_ceiling).'</td>
			</tr>
			<tr>
				<td>9. a) Name of the nearest Fire Station </td>
				<td>'.strtoupper($fire_st_name).'</td>
			</tr>
			<tr>
				<td>b) Telephone Number of the nearest Fire Station</td>
				<td>'.strtoupper($fire_st_no).'</td>
			</tr>
			<tr>
				<td >10. Details of Fire Fighting Equipment provided in the premises/temporary shooting set </td>
				<td>'.strtoupper($fire_details).'</td>
			</tr>
			<tr>
				<td>11. Details of the Water storage available in the premises</td>
				<td>'.strtoupper($water_detail).'</td>
			</tr>
			<tr>
				<td >12. a)Details of the personnel trained in basic fire-fighting </td>
				<td>'.strtoupper($personnel_detail_fire).'</td>
			</tr>
			<tr>
				<td>b) Number of the training certificate</td>
				<td>'.strtoupper($personnel_detail_no).'</td>
			</tr>
			<tr>
				<td>13. a) Name of Electrician</td>
				<td>'.strtoupper($electrician_detail_name).'</td>
			</tr>
			<tr>
				<td>b) License number of Electrician</td>
				<td>'.strtoupper($electrician_detail_no).'</td>
			</tr>
			<tr>
				<td >14. Any other information to be declared</td>
				<td>'.strtoupper($fire_info).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>Terms and Conditions to be followed by Film Shooting Agencies while erecting sets :</b></td>
			</tr>
			<tr>
				<td colspan="4">
				<ul>	
					<li>For shooting films/ erecting film sets in High rise buildings/ Hotels Hospitals/ Schools/ Shopping Malls / Industries etc the Film Shooting agencies should ensure that the buildings/ establishments proposed to be used for shooting purpose must have previously obtained Fire Safety NOC from Fire & Emer4gency Services, Assam Fire Safety NOC will be required to be furnished by the applicant for utilizing such establishments.</li>
					<li><b>Recommendations for the fire precautionary measures for erecting Temporary Film Shooting Sets.</b></li>
						<ul>
							<li>The height of the ceiling of Shootings Sets/ structures shall not be less than 3 meters.</li>
							<li>No synthetic material should be used in such structures.</li>
							<li>Synthetic rope should not be used and instead either coir or manila should be used.</li>
							<li>Margins of at least 3 meters shall be kept on all sides away from any pre-existing walls or buildings.</li>
							<li>No structure shall be erected beneath any live electrical line.</li>
							<li>The structures should be erected reasonably away from railway lines electric sub-stations, furnaces or other hazardous places and a minimum distance of 15 meters must be maintained.</li>
							<li>Exists on all sides of the Sets will be kept sufficiently wide ( minimum 1.5 meters) The exist must not be of tunnel like shape.</li>
							<li>Enough spaces should be kept for movement within the Sets.</li>
							<li>The lighting arrangement should be through a licensed electrical contractor. No cable joints should be left exposed. They should be carefully covered with insulating types. If possible internal circuit should be through conduits.</li>
							<li>There should be provision for standby emergency light.</li>
						</ul>
				</ul>
				<h5><u>FIRE PROTECTION MEASURES</u></h5>
				<ul>	
					<li>The ground enclosed by any temporary structure, pandal, tent or shamina, a distance of not less than 4.5 m outside of such structure shall be cleared of all combustible materials or vegetation and any material obstructing the movement.</li>
					<li>Storage of combustible materials like shavings, straw, flammable and explosive chemicals and similar materials shall not be permitted to be stored inside and temporary structure.</li>
					<li>No Fire works or open flame of any kind shall be permitted in any temporary structure film shooting sets or in the immediate vicinity.</li>
					<li>Open Fires: No open fires except small size controlled fires for religious purposes shall be permitted inside or near the shooting sets or other temporary structures.</li>
					<li>Kitchen area for cooking of snacks/ food shall be totally segregated from the main pandal/ temporary structure and preferably of G.I sheet.</li>
				</ul>
				<h5><u>FIRE FIGHTING ARRANGEMENTS</u></h5>
				<ol type="a.">
					<li>Provision of water for Fire Fighting.<br/>
					Supply of water shall not be less than 0.75 1/m2 of floor area for each shooting sets or other temporary structure. The water shall be stored in buckets / drums and kept in readiness for use. Half quantity may be kept inside the temporary structure and the other half in its immediate vicinity. The buckets or receptacles stating water shall at all times be readily available for immediate use for dealing with the fire.</li>
					<li>Fire Extinguisher</li>
						<ul>
							<li>Adequate nos of CO2 or D.C.P extinguisher of 4.5/4.kg capacity should be installed in the film shooting sets/temporary structures. The extinguisher shall be so distributed over each floor area so that a person has to travel not more than 15 mtrs to reach the nearest extinguisher or in each 100 m2 in floor area.</li>
							<li>At least two nos. of D.C.P or CO2 extinguisher of 4/4.5 kg and two nos. of AFFF extinguisher of 9 lts. Capacity should be provided near the Car Parking area ( if any)</li>
							<li>At least two Nos of CO2 extinguisher of 4.5 kg capacity should be provided near the Electric Panel Board/ Switch gear room.</li>
							<li>At least two nos. of AFFF extinguisher of 9 lts capacity with ISI mark should be provided near the Generator/ Transformer.</li>
							<li>N.B: All Fire Extinguishers should be newly introduced Indian Standard- as per IS 15683:2006</li>
						</ul>
					<li>Directional sign showing ENTRY & EXIT should be displayed clearly.</li>
					<li>A responsible person (volunteers) shall always be available at the site of the temporary structure/ sets to organize prompt evacuation, fire fighting to deal with emergencies at the incipient stage and informing the Fire Service. The emergency Fire service telephone number shall be displayed prominently.</li>
					<li>Volunteers should bear Badges for easy identification.</li>
				</ol>
				<h5><u>MAINTENANCE</u></h5>
				<ul>
					<li>All temporary structures/ sets shall be maintained in a safe and sanitary condition. All devices or safeguards which are required by this standard shall be maintained in good working condition.</li>
					<li>All temporary structures shall be periodically inspected and any deterioration or any defect observed shall be brought to the notice of the authority for remedy.</li>
					<li>Particular attention shall be paid to the means of escape and gangways, exits etc. are extinguishers easily visible and accessible before public is admitted at any time.</li>
					<li>The emergency telephone numbers shall be displayed prominently in and around the structures and provision for standby emergency light should be provided.</li>
				</ul>
				</td>
			</tr>
			<tr>
				<td colspan="2"  align="center"><b>Undertaking</b><br/><br/>
				I/We<b> '.strtoupper($film_details_name).' </b>on behalf of <b>'.strtoupper($film_details_org).' </b>do hereby declare that I have complied to the terms and conditions/ guidelines of Fire Prevention&amp; Fire Safety Measures for the Film Shooting Sets/Structures/ Stages as circulated by your good office. That in case of violation detected, I will be held responsible for consequences</td>
			</tr>';
			}	
			$printContents=$printContents.'
			<tr>
				<td colspan="2" align="center"><h5><b>Archaeological Survey</b></h5></td>
			</tr>
			<tr>
				<td>Do you wish to film at Archaeological Sites/Monuments?</td>
				<td>'.strtoupper($film_arch).'</td>
			</tr>';
			if($film_arch=="YES"){
				$printContents=$printContents.'			
			<tr>
				<td>1. Name of the monument/site at which the proposed filming operation is to be carried out</td>
				<td>'.strtoupper($monument_name).'</td>
			<tr>
				<td colspan="2">2. Address :</td>
			</tr>
			<tr>
				<td>a. Building/Premises</td>
				<td>'.strtoupper($arch_address_building).'</td>
			</tr>
			<tr>
				<td>b. Street</td>
				<td>'.strtoupper($arch_address_street).'</td>
			</tr>
			<tr>
				<td>c. Locality</td>
				<td>'.strtoupper($arch_address_locality).'</td>
			</tr>
			<tr>
				<td>d. City</td>
				<td>'.strtoupper($arch_address_city).'</td>
			</tr>
			<tr>
				<td>e. District</td>
				<td>'.strtoupper($arch_address_dist).'</td>
			</tr>
			<tr>
				<td>f. State</td>
				<td>ASSAM</td>
			</tr>
			<tr>
				<td>g. Pin</td>
				<td>'.strtoupper($arch_address_pin).'</td>
			</tr>
			<tr>
				<td>3. Part of the monument/site to be filmed</td>
				<td>'.strtoupper($monument_part).'</td>
			</tr>
		
			<tr>
				<td>4. Any other information to be declared</td>
				<td>'.strtoupper($arch_info).'</td>
			</tr>
			<tr>
				<td colspan="2">I declare that the above information is correct. I also undertake to observe the provisions of the Ancient Monuments and Archaeological Sites and Remains Act 1958, and the rules thereunder.<br/><br/></td>
			</tr>';
			}
			$printContents=$printContents.'
			<tr>
			<td colspan="2">
			    <table>
				<tr>
					<td colspan="2" height="50px"><font color="red">Submitted Documents Are---</font></td>
				</tr>
				<tr>
					<td width="60%" >Synopsis of the Feature Film/Documentary.</td>
					<td width="40%" >&nbsp;'.$val1.'</td> 
				</tr>
				<tr>
					<td> Itenary pre-filming visit along with places to stay and mode of convince/transportation to be used.</td>
					<td>&nbsp;'.$val2.'</td> 
				</tr>
				<tr>
					<td> List of Cinematic Equipment to be used, if any, alongwith necessary certification and
						authorization.</td>
					<td>&nbsp;'.$val3.'</td> 
				</tr>
				<tr>
					<td> List/Full details of Crew members alongwith security classification, if any.</td>
					<td>&nbsp;'.$val4.'</td> 
				</tr>
				<tr>
					<td>List/Full details of Firearms/Explosives to be carried, if any, alongwith necessary certification and
						authorization.</td>
					<td >&nbsp;'.$val5.'</td> 
				</tr>
				<tr>
					<td> Itinerary of the filming schedule alongwith places to stay and the mode of
					conveyance/transportation to be used.</td>
					<td>&nbsp;'.$val6.'</td> 
				</tr>
				<tr>
					<td > Certificate/Permission letter from competent authority for use of helicopters/drones etc. or any
						other specialized equipment.</td>
					<td >&nbsp;'.$val7.'</td> 
				</tr>
				<tr>
					<td > List/Full Details of Fire Fighting Equipment (Fire Extinguisher, Foam etc.) available with the team
						in case of filming with inflammable materials.</td>
					<td >&nbsp;'.$val8.'</td> 
				</tr>
				<tr>
					<td > A receipt of amount of Rs 10000/- pledged in favor of the Chief Wildlife
								Warden, Assam, Basistha, Guwahati-29 as a security deposit to be uploaded.</td>
					<td >&nbsp;'.$val9.'</td> 
				</tr>
				<tr>
					<td > A copy of approval letter from NTCA/ Wildlife Div. of Govt. of India, MoEF &amp; CC shall be submitted prior to accord
								permission.</td>
					<td  >&nbsp;'.$val10.'</td> 
				</tr>
				<tr>
					<td > Nature and purpose of the proposed filming operations and the context in which the monument is proposed to be filmed (relevant extract of the script to be attached alongwith details of the scenes to be filmed should be furnished)</td>
					<td  >&nbsp;'.$val11.'</td> 
				</tr>
				<tr>
					<td > Feature film/documentaries made earlier by applicant.</td>
					<td  >&nbsp;'.$val12.'</td> 
				</tr>
				<tr>
					<td > Any Feature film/ documentary previously filmed in Assam.</td>
					<td  >&nbsp;'.$val13.'</td> 
				</tr>
			</td>
			</tr>
		</table>';
				  if(!empty($results["courier_details"])){
					 $printContents=$printContents.'
					<tr>           
					<td colspan="2">
						<table border="1" width="99%" class="table table-bordered table-responsive">
							<tr><td height="30px" colspan="2">Courier Details.</td></tr>
							<tr><td width="60%">Name of Courier Service </td><td width="40%">'.strtoupper($courier_details_cn).'</td></tr>
							<tr><td width="60%">Ref. No. / Consignment No. </td><td width="40%">'.strtoupper($courier_details_rn).'</td></tr>
							<tr><td width="60%">Dispatch Date </td><td width="40%">'.strtoupper($courier_details_dt).'</td></tr>
						</table>
					</td>
					</tr>
					';              
					 }    
					$printContents=$printContents.'				
				<tr>
					<td colspan="2" align="center">	<b>UNDERTAKING</b><br/><br/>							
						I certify that the details on this application accurately reflects the event as proposed, and I have fully read and understood the terms and conditions. If the event is approved, my company and I agree to abide by the guidelines etc. including do’s and don’ts established for this event.
					</td>
				</tr>
				<tr>
					<td>Date: <label>'.strtoupper($today).'</label></td>
					<td align="right">Name: <label> '.strtoupper($film_details_name).' </label><br/>				
					Designation: <label>'.strtoupper($film_details_desig).'</label></td>		
				</tr>
			</table>';
if(!isset($css)){
	$printContents=$printContents.'
	</body>
	</html>
	';
}
if(!isset($get_file_name)){ 	
$mypdf="tourism_form1".$swr_id.".pdf";
ob_end_clean();
include("../../../mpdf60/mpdf.php"); 
$mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($printContents);         
$mpdf->Output($mypdf,'I');
$pcb->close();
}
?>
