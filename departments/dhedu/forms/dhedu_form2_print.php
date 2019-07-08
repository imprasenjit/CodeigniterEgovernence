<?php
$dept="dhedu";
$form="2";
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
	
		
		if($q->num_rows > 0){
		$results=$q->fetch_array();			
		$form_id=$results["form_id"];$affil=$results["affil"];$instruct=$results["instruct"];$land=$results["land"];$land_status=$results["land_status"];$intake_cap=$results["intake_cap"];$no_students=$results["no_students"];$is_scheme=$results["is_scheme"];$is_available=$results["is_available"];$is_water=$results["is_water"];	$play_material=$results["play_material"];	$teaching_aid=$results["teaching_aid"];$lab_facility=$results["lab_facility"];$no_books=$results["no_books"];	$fire_safety=$results["fire_safety"];$co_curricular=$results["co_curricular"];$inst_location=$results["inst_location"];	$is_commercial=$results["is_commercial"];$is_admission=$results["is_admission"];$other_info=$results["other_info"];	$managing_comm=$results["managing_comm"];$edu_level=$results["edu_level"];
		  $education_stage=$results["education_stage"];
			$education_stage_array=Array();
			$education_stage_array=explode(",",$education_stage);
			$education_stage="";
			if(in_array("P",$education_stage_array)) $education_stage.="Primary<br/>";
			if(in_array("M",$education_stage_array)) $education_stage.="Middle<br/>";
			if(in_array("S",$education_stage_array)) $education_stage.="Secondary<br/>";
			if(in_array("H",$education_stage_array)) $education_stage.="Higher Secondary";	
		if(!empty($results["inst_loc"])){
			$inst_loc=json_decode($results["inst_loc"]);
			$inst_loc_a=$inst_loc->a;$inst_loc_b=$inst_loc->b;
		}else{				
			$inst_loc_a="";$inst_loc_b="";
		}			
		if(!empty($results["is_comm_act"])){
			$is_comm_act=json_decode($results["is_comm_act"]);
			$is_comm_act_a=$is_comm_act->a;$is_comm_act_b=$is_comm_act->b;
		}else{				
			$is_comm_act_a="";$is_comm_act_b="";
		}
		if(!empty($results["recog"])){
			$recog=json_decode($results["recog"]);
			$recog_no=$recog->no;$recog_dt=$recog->dt;
		}else{				
			$recog_no="";$recog_dt="";
		}				
		if(!empty($results["is_inst_estd"])){
			$is_inst_estd=json_decode($results["is_inst_estd"]);
			$is_inst_estd_a=$is_inst_estd->a;$is_inst_estd_b=$is_inst_estd->b;
		}else{				
			$is_inst_estd_a="";$is_inst_estd_b="";
		}				
						
		if(!empty($results["land"])){
			$land=json_decode($results["land"]);
			$land_a=$land->a;$land_b=$land->b;
		}else{				
			$land_a="";$land_b="";
		}					
		if(!empty($results["board_result"])){
			$board_result=json_decode($results["board_result"]);
			$board_result_a=$board_result->a;$board_result_b=$board_result->b;$board_result_c=$board_result->c;
		}else{				
			$board_result_a="";$board_result_b="";$board_result_c="";
		}		
		
		if($inst_location=='R'){$inst_location='Rural';} 
		else if($inst_location=='SU') {$inst_location='Semi Urban';}
		else {$inst_location='Urban';}
		if($inst_loc_a=='R'){$inst_loc_a='Residential';} 
		else if($inst_loc_a=='SR') {$inst_loc_a='Semi-Residential';}
		else {$inst_loc_a='Non-Residential';}
		
		if($is_comm_act_a=='Y'){$is_comm_act_a='Yes';} else {$is_comm_act_a='No';}
		if($is_inst_estd_a=='Y'){$is_inst_estd_a='Yes';} else {$is_inst_estd_a='No';}
		if($is_scheme=='Y'){$is_scheme='Yes';} else {$is_scheme='No';}
		if($is_available=='Y'){$is_available='Yes';} else {$is_available='No';}
		if($is_water=='Y'){$is_water='Yes';} else {$is_water='No';}
		if($is_commercial=='Y'){$is_commercial='Yes';} else {$is_commercial='No';}
		if($is_admission=='Y'){$is_admission='Yes';} else {$is_admission='No';}
	}
	$other_info=wordwrap($other_info,40,"<br/>",true);
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
	<br/>
	<table class="table table-bordered table-responsive">		
		<tr>  				
			<td valign="top">1. Name of the Institution :</td>
			<td >'.strtoupper($unit_name).'</td>
		</tr>
		<tr>  				
			<td valign="top">2. Name of the individual/ Association of individuals/ Society/ Trust establishing the institution:</td>
			<td>'.strtoupper($owner_names).'</td>
		</tr>
		<tr>  				
			<td valign="top">3.  Name of the Manager with address and contact telephone No. :</td>
			<td ><table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">Name</td>
						<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
						<td >Street Name 1</td>
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
			<td valign="top">4. Full address with Pin code :</td>
			<td >
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
			</table>
			</td>
		</tr>
		<tr>
			<td valign="top">4. NAME OF COMPANY/ COMPANIES WHOSE PRODUCT IS BEING TRADE :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">5. NAME OF SUPPLIER AND ADDRESS IN FULL :</td>
			<td>'.strtoupper($date_of_commencement).'</td>
		</tr>
		<tr>
			<td valign="top">7. Affiliating body (SEBA/AHSEC/CBSE/ICSE/ others) :</td>
			<td>'.strtoupper($affil).'</td>
		</tr>
		<tr>
			<td valign="top">8. Medium of instruction :</td>
			<td>'.strtoupper($instruct).'</td>
		</tr>
		<tr>
			<td valign="top">9. Whether existing on the day of commencement of the Act? If yes, please furnish documentary evidence such as purchase of land/ building permission/ electricity bill/ opening of Bank Account/ Fixed Deposit Certificate in the name of the institution :</td>
			<td>'.strtoupper($is_comm_act_a).' &nbsp;'.strtoupper($is_comm_act_b).'</td>
		</tr>
		<tr>
			<td valign="top">10. Whether the institution is established with prior permission from Director after commencement of the Act? If yes, please furnish No. & Date of such permission (a copy of permission letter to be enclosed) :</td>
			<td>'.strtoupper($is_inst_estd_a).' '.strtoupper($is_inst_estd_b).'</td>
		</tr>
		<tr>
			<td valign="top">11. No. & date of Recognition from Govt./ Affiliating Body (copy of document to be enclosed where applicable) :</td>
			<td>'.strtoupper($recog_no).' '.strtoupper($recog_dt).'</td>
		</tr>
		<tr>
			<td valign="top">12. Level of education imparted (Primary / Middle / Secondary / Higher Secondary Level) and classes opened :</td>
			<td>'.strtoupper($education_stage).'</td>
		</tr>
		<tr>
			<td valign="top">Classes Opened</td>
			<td>'.strtoupper($edu_level).'</td>
		</tr>
		<tr>
			<td valign="top">13. Measurement of the plot of land where the institution is located with Dag No. & Patta No. (a copy enclosed) :</td>
			<td>'.strtoupper($land_a).' '.strtoupper($land_b).'</td>
		</tr>
		<tr>
			<td valign="top">14. Status of the land (Myadi/ Annual Patta/ Lease hold). If lease hold, copy of the lease document to be attached :</td>
			<td>'.strtoupper($land_status).'</td>
		</tr>
		<tr>
			<td valign="top">15. Whether scheme of management as required under section 14 of the Act has been prepared? If so, please attach a copy of the same. :</td>
			<td>'.strtoupper($is_scheme).'</td>
		</tr>
		<tr>
			<td valign="top" > 16. What is the intake capacity of the institution (class-wise) :</td>
			<td>'.strtoupper($intake_cap).'</td>
		</tr>
		
		<tr>
			<td valign="top" >17. No. of students enrolled class-wise during last 3 years (separate sheet) : </td>
			<td>'.strtoupper($no_students).' </td>
		</tr>
		<tr>
			<td valign="top"> 18. Results of Board&amp;s Final Examination for last 3 years.        </td>	
			<td>Total No. of students appeared:'.strtoupper($board_result_a).' <br/>   
			Total no. of students passed with division:'.strtoupper($board_result_b).' <br/>   
			Percentage of pass:'.strtoupper($board_result_c).' </td>
		</tr>
		<tr>
			<td valign="top" colspan="2">19. Total built up area indicating No. & size of classrooms, office room, common room, Library room, Science laboratory, store room,etc   </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
				<tr>
					<th>Slno</th>
					<th width="35%">Name</th>
					<th width="30%">Total built up area indicating No.</th>
					<th width="30%">Size</th>
				</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["no"]).'</td>
							<td>'.strtoupper($row_1["size"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>   
			</td>
		</tr>
		<tr>
			<td valign="top">20. Furniture and equipment available in the institution :    </td>
			<td >'.strtoupper($is_available).'</td>
		</tr>							
		<tr>
			<td>21. Sanitation & Drinking water facilities</td>									
			<td>'.strtoupper($is_water).'</td>
		</tr>  	
		<tr>
			<td colspan="2">22. Students fee structure (accomodation fee, tuition fee, games & sports fee, library fee, development fee, festival fee, etc.) class-wise : </td>	
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr>
				<th>Slno</th>
				<th width="45%">Particulars</th>
				<th>Fees</th>
			</tr>';
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["particulars"]).'</td>
						<td>'.strtoupper($row_2["fees"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>   
			</td>
		</tr>   							
		<tr>
			<td>23. Constitution of the Managing Committee : </td>	
			<td>'.strtoupper($managing_comm).'</td>
		</tr>   							
		<tr>
			<td>24. Playgrounds and play materials : </td>	
			<td>'.strtoupper($play_material).'</td>
		</tr>   							
		<tr>
			<td>25. Teaching aids available in the institution : </td>	
			<td>'.strtoupper($teaching_aid).'</td>
		</tr>    							
		<tr>
			<td>26. Laboratory facility : </td>	
			<td>'.strtoupper($lab_facility).'</td>
		</tr>     							
		<tr>
			<td>27. No. of Library books (Textbooks, reference books, other books, journals, news paper, etc.):</td>	
			<td>'.strtoupper($no_books).'</td>
		</tr>     							
		<tr>
			<td>28. Fire safety measures available in the institution :</td>	
			<td>'.strtoupper($fire_safety).'</td>
		</tr>       							
		<tr>
			<td>29. Facilities for co-curricular activities :</td>	
			<td>'.strtoupper($co_curricular).' </td>
		</tr>      							
		<tr>
			<td>30. Whether the institution is residential/semi residential/ non-residential? If residential, what is the hostel capacity :</td>	
			<td>'.strtoupper($inst_loc_a).' '.strtoupper($inst_loc_b).' </td>
		</tr>      							
		<tr>
			<td>31. Whether the institution on commercial basis for profit to any individual or association of individuals? :</td>
			<td>'.strtoupper($is_commercial).' </td>
		</tr>     							
		<tr>
			<td>32. Whether admission is open for students irrespective of caste, race, religion and place of birth? :</td>	
			<td>'.strtoupper($is_admission).' </td>
		</tr>      							
		<tr>
			<td colspan="2">33. Details of teaching and non-teaching staff :</td>	
		</tr>
		<tr>
			<td colspan="2"><table class="table table-bordered table-responsive">
			<tr>
				<th>Slno</th>
				<th>Name</th>
				<th>Date of Birth</th>
				<th>Academic qualification</th>
				<th width="30%">Date of Appointment</th>
				<th width="30%">Present Salary</th>
				<th>Whether whole time or part time</th>
			</tr>';			
			$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				while($row_3=$part3->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_3["slno"]).'</td>
						<td>'.strtoupper($row_3["name"]).'</td>
						<td>'.strtoupper($row_3["dob"]).'</td>
						<td>'.strtoupper($row_3["qualification"]).'</td>
						<td>'.strtoupper($row_3["dt_appt"]).'</td>
						<td>'.strtoupper($row_3["salary"]).'</td>
						<td>'.strtoupper($row_3["time"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table>  
			</td>
		</tr>       							
		<tr>
			<td>34.  Any other information :</td>	
			<td>'.strtoupper($other_info).' </td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
					
		<tr>
			<td>Place : <strong>'.strtoupper($dist).'</strong><br/>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="right"> <strong>'.strtoupper($key_person).'</strong><br/>Name and Signature of the Manager of the Institution </td>				
		</tr>					
	</table>';

?>

