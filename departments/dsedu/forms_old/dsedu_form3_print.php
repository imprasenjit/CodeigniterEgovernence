<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$dsedu->query("select * from dsedu_form3  where user_id='$swr_id' and form_id='$form_id' and form_id=form_id") or die("Error :".$dsedu->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dsedu->query("select * from dsedu_form3  where user_id='$swr_id' and uain='$uain' and form_id=form_id") or die("Error :".$dsedu->error);	
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dsedu->query("select * from dsedu_form3  where user_id='$swr_id' and form_id='$form_id' and form_id=form_id") or die("Error :".$dsedu->error);
	}else{
		$q=$dsedu->query("select * from dsedu_form3  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$dsedu->error);
	}
	
	$results=$q->fetch_array();
	if($q->num_rows > 0){
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);

	$form_id=$results["form_id"];
	$name_of_indiv=$results["name_of_indiv"];$location=$results["location"];$date_of_prior=$results["date_of_prior"];$date_of_reg=$results["date_of_reg"];$edu_level=$results["edu_level"];$stage_of_edu=$results["stage_of_edu"];$steam_n_subjects=$results["steam_n_subjects"];$medium_of_ins=$results["medium_of_ins"];$recognized_school=$results["recognized_school"];$is_institution=$results["is_institution"];$constitution=$results["constitution"];$is_scheme=$results["is_scheme"];$camp_area=$results["camp_area"];$type_of_building=$results["type_of_building"];$accomodation=$results["accomodation"];$no_n_size=$results["no_n_size"];$drinking_water=$results["drinking_water"];$total_area=$results["total_area"];$sources_of_fund=$results["sources_of_fund"];$reserved_fund=$results["reserved_fund"];$mothly_income=$results["mothly_income"];$monthly_expen=$results["monthly_expen"];$is_admission=$results["is_admission"];$is_religious=$results["is_religious"];$details_of_curriculm=$results["details_of_curriculm"];$facility_available=$results["facility_available"];$is_manage=$results["is_manage"];$charges=$results["charges"];$no_f_student=$results["no_f_student"];$physical_education=$results["physical_education"];$medical_facility=$results["medical_facility"];$co_curricular=$results["co_curricular"];$other_info=$results["other_info"];
	
	$file1=$results["file1"];$file2=$results["file2"];	$file3=$results["file3"];	
	if(!empty($results["authority"])){
			$authority=json_decode($results["authority"]);
			$authority_name=$authority->name;$authority_address=$authority->address;
		}else{				
			$authority_name="";$authority_address="";
		}
	if($is_institution=="Y") $is_institution="YES";
		else $is_institution="NO";
	if($is_scheme=="Y") $is_scheme="YES";
		else $is_scheme="NO";
	if($is_admission=="Y") $is_admission="YES";
		else $is_admission="NO";
	if($is_religious=="Y") $is_religious="YES";
		else $is_religious="NO";
	if($is_manage=="Y") $is_manage="YES";
		else $is_manage="NO";
	if(!empty($results["classroom"])){
		$classroom=json_decode($results["classroom"]);
		$classroom_a=$classroom->a;$classroom_b=$classroom->b;$classroom_c=$classroom->c;
	}else{				
		$classroom_a="";$classroom_b="";$classroom_c="";
	}				
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	}else{
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);		
		$val3=$formFunctions->get_uploadFile($file3);		
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
		$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
		
	}	
	if($results["payment_mode"]==0){
		$payment_mode="OFFLINE";
		$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
	}else{
		$payment_mode="ONLINE";
	}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('dsedu','3');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form III</title>
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>FORM-III<br/>[SEE RULE 5)]<br/>'.$form_name.'</h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tr>
			<td colspan="2">To<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;The '.strtoupper($authority_name).'<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($authority_address).'<br/>
			Sir,<br/>&nbsp;&nbsp;&nbsp;&nbsp;I beg to state that I/we have already registered the institution as required under relevant provisions of the Assam Non-Govt. Educational Institutions (Regulation &amp; Management) Act, 2006 (Assam Act, No.IV of 2007). Now I/we would like to request you kindly accord necessary administrative recognition in favour of the said institution, the detail particulars of which are furnished below :
			</td>
		</tr>		
		<tr>  				
			<td valign="top" width="50%">1. Name of the Institution</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">2. Date of establishment</td>
			<td>'.strtoupper($date_of_commencement).'</td>
		</tr>
		<tr>
			<td valign="top" width="50%">3. Full address of the Institution</td>
			<td width="50%">
				<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
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
						<td>Mobile</td>
						<td>+91 - '.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
						<td>Email-id</td>
						<td>'.$b_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">4. Name of the individual/ Association of individuals/ Society/ Trust establishing the Institution</td>
			<td>'.strtoupper($name_of_indiv).'</td>
		</tr>		
		<tr>
			<td valign="top">5. Name of the Manager with address and contact telephone No.</td>
			<td>
				<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Name</td>
						<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
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
						<td>+91 - '.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
						<td>Email-id</td>
						<td>'.$email.'</td>
				</tr>
				</table>
			</td>
		</tr>		
		<tr>
			<td valign="top" > 6. Location</td>
			<td>'.strtoupper($location).'</td>
		</tr>
		<tr>
			<td valign="top" >7. Date of prior permission</td>
			<td>'.strtoupper($date_of_prior).'</td>
		</tr>
		<tr>
			<td valign="top"> 8. Date of registration</td>
			<td>'.strtoupper($date_of_reg).'</td>
		</tr>
		<tr>
			<td valign="top"> 9. Level of education being imparted</td>
			<td>'.strtoupper($edu_level).'    </td>
		</tr>
		<tr>
			<td valign="top">10. Stage of education for which recognition is applied for</td>
			<td >'.strtoupper($stage_of_edu).'</td>
		</tr>
		<tr>
			<td valign="top">11. In case of Higher Secondary stage, the steam  and subjects for recognition</td>
			<td >'.strtoupper($steam_n_subjects).'</td>
		</tr>							
		<tr>
			<td>12. Medium of instruction</td>									
			<td>'.strtoupper($medium_of_ins).'</td>
		</tr>  							
		<tr>
			<td>13. Names of recognized schools already functioning in the neighboring area within a radius of 1 Km in respect of Primary, 3 Km in respect of Middle, 5 Km in respect of Secondary, 10 Km in respect of Higher Secondary level of institution as the case may be.</td>	
			<td>'.strtoupper($recognized_school).'</td>
		</tr>   							
		<tr>
			<td>14. Whether the institution is running on commercial basis for profit to any individual or group of individuals?</td>	
			<td>'.strtoupper($is_institution).'</td>
		</tr>   							
		<tr>
			<td>16. Whether the institution has a scheme of Management as required under section 14 of the Act.? If yes, please enclose a copy of the same.</td>	
			<td>'.strtoupper($is_scheme).'</td>
		</tr>   							
		<tr>
			<td>17. The area of the campus of the institution and the total built-up area</td>	
			<td>'.strtoupper($camp_area).'</td>
		</tr>    							
		<tr>
			<td>18. Type of the building </td>	
			<td>'.strtoupper($type_of_building).'</td>
		</tr>     							
		<tr>
			<td>19. Accomodation provided in the institution  building (dimensions to be indicated in all cases)</td>	
			<td>'.strtoupper($accomodation).' </td>
		</tr>     							     							
		<tr>
			<td>20. Number &amp; size of classrooms, office room,staff room, common room for students, library and reading room, school hall, Science Laboratories, Store room etc.</td>	
			<td>'.strtoupper($no_n_size).' </td>
		</tr>      							
		<tr>
			<td>21. Drinking water and sanitation facilities</td>	
			<td>'.strtoupper($drinking_water).' </td>
		</tr>      							
		<tr>
			<td>22. Desk-bench in the classroom</td>	
			<td>'.strtoupper($classroom_a).' </td>
		</tr>     							
		<tr>
			<td>23. No. of books in the library</td>	
			<td>'.strtoupper($classroom_b).' </td>
		</tr>      							
		<tr>
			<td>24. Science apparatus and equipment in the Science laboratory</td>	
			<td>'.strtoupper($classroom_c).' </td>
		</tr>       							
		<tr>
			<td>25. Total area of playgrounds and number of playgrounds available and the games played</td>	
			<td>'.strtoupper($total_area).' </td>
		</tr> 
		<tr>
			<td>26. Sources of fund and financial position of the institution</td>	
			<td>'.strtoupper($sources_of_fund).' </td>
		</tr> 
		<tr>				
			<td>27. Reserved fund</td>
			<td>'.strtoupper($reserved_fund).' </td>
		</tr>
		<tr>
			<td>28. Monthly income from fees and other sources</td>
			<td>'.strtoupper($mothly_income).' </td>
		</tr>
		<tr>											
			<td>29. Average monthly expenditure</td>
			<td>'.strtoupper($monthly_expen).' </td>
		</tr>
		<tr>
			<td colspan="2">30. Number of students in the current year</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
				<tr>
					<th width="5%">Slno</th>
					<th width="25%">Name of the Class</th>
					<th width="20%">Section</th>
					<th width="25%">Number of students enrolled</th>
					<th width="25%">Average attendance in each section during the last 6 months</th>
				</tr>';
				$part1=$dsedu->query("SELECT * FROM dsedu_form3_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["section"]).'</td>
						<td>'.strtoupper($row_1["no_f_student"]).'</td>
						<td>'.strtoupper($row_1["avg_attendance"]).'</td>
				</tr>';
				}$printContents=$printContents.'				
				</table>
			</td>
		</tr>
		<tr>
			<td width="25%">31. Whether admission in the school is open to all without any discrimination based on religion,caste, race, place of birth or any</td>
			<td>'.strtoupper($is_admission).' </td>
		</tr>
		<tr>
			<td width="25%">32. Whether any religious instruction is imparted and if so, whether it is compulsory?</td>
			<td>'.strtoupper($is_religious).' </td>
		</tr>
		<tr>
			<td width="25%">33. Details of curriculum and syllabus followed in each class</td>
			<td>'.strtoupper($details_of_curriculm).' </td>
		</tr>
		<tr>
			<td width="25%">34. Educational and Vocational guidance facilities available</td>
			<td>'.strtoupper($facility_available).' </td>
		</tr>
		<tr>
			<td>35. Whether the management maintains a provident fund scheme or any other similar scheme for the staff ?</td>
			<td>'.strtoupper($is_manage).' </td>
		</tr>
		<tr>
			<td>36. Rates of fees and other funds/ charges (Class-wise)</td>
			<td>'.strtoupper($charges).' </td>
		</tr>
		<tr>
			<td>37. Number of students residing with their parents/ guardians and arrangements made for their conveyance</td>
			<td>'.strtoupper($no_f_student).' </td>
		</tr>
		<tr>
			<td colspan="2">38. Details of staff including Head of the Institution</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
				<tr>
					<th width="5%">Sl No</th>
					<th width="10%">Name</th>
					<th width="15%">Date of Birth</th>
					<th width="15%">Academic Qualifications , training previous teaching experience, if any</th>
					<th width="15%">Subject being taught at present</th>
					<th width="10%">Date of appointment</th>
					<th width="20%">Present pay with the scale of pay</th>
					<th width="10%">Whether whole time/Part time</th>
				</tr>';
				$part2=$dsedu->query("SELECT * FROM dsedu_form3_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["dob"]).'</td>
						<td>'.strtoupper($row_2["qualification"]).'</td>
						<td>'.strtoupper($row_2["subject"]).'</td>
						<td>'.strtoupper($row_2["date_of_appoin"]).'</td>
						<td>'.strtoupper($row_2["present_pay"]).'</td>
						<td>'.strtoupper($row_2["time"]).'</td>
				</tr>';
				}$printContents=$printContents.'				
				</table>
			</td>
		</tr>
		<tr>
			<td>39. Details of facilities available for Physical Education and recreation</td>
			<td>'.strtoupper($physical_education).' </td>
		</tr>
		<tr>
			<td>40. Medical facilities for students</td>
			<td>'.strtoupper($medical_facility).' </td>
		</tr>
		<tr>
			<td>41. Details of co-curricular, cultural and other activities organized in the school</td>
			<td>'.strtoupper($co_curricular).' </td>
		</tr>
		<tr>
			<td>42. Any other information</td>
			<td>'.strtoupper($other_info).' </td>
		</tr>
		<tr>
				<td colspan="2" height="50px"><font color="red">Checklist of the Documents</font></td>
		</tr>					
		<tr>
				<td> A Copy of the permission letter</td>
				<td>'.$val1.'</td>
		</tr>					
		<tr>
			  <td>A Copy of the registration letter</td>
			  <td>'.$val2.'</td>
		</tr>
		<tr>
			  <td>Scheme of Management as required under section 14 of the Act.</td>
			  <td>'.$val3.'</td>
		</tr>
		';			
		if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
			$printContents=$printContents.'
			<tr>		   
			<td colspan="2">
				<table border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
					<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
					<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
					<tr><td width="50%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
					<tr><td width="50%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
				</table>
			</td>
			</tr>
			';				
			}
			if($results["payment_mode"]!=NULL){ 
			$printContents=$printContents.'<tr>		    
			<td colspan="2">
				<table border="0" width="100%">
				<tr><td height="45px" colspan="2">Payment Details :</td></tr>
				<tr><td width="40%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
				if($results["payment_mode"]==0)
				{
					$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
					<td>'.$offline_challan.'</td></tr>';
				}
				$printContents=$printContents.'</table>			
			</td>
		  </tr>';
		  }
		$printContents=$printContents.'				
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="right"> <strong>'.strtoupper($key_person).'</strong><br/>Full Signature of Applicant</td>				
		</tr>						
	</table>';

?>

