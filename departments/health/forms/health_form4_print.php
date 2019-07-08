<?php
$dept="health";
$form="4";
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
		$eye_bnk_name=$results["eye_bnk_name"];$eye_bnk_ad=$results["eye_bnk_ad"];
		$is_eye_bnk_gov=$results["is_eye_bnk_gov"];$is_teaching=$results["is_teaching"];$is_eye_bnk_iec=$results["is_eye_bnk_iec"];
		$is_availability=$results["is_availability"];
		$is_register_main=$results["is_register_main"];$m_no=$results["m_no"];$is_transport_facility=$results["is_transport_facility"];$is_instrument=$results["is_instrument"];$is_preservation=$results["is_preservation"];$is_pre_media=$results["is_pre_media"];$is_waste_disp=$results["is_waste_disp"];$is_power_supply=$results["is_power_supply"];
		$incharge=$results["incharge"];$eye_technician=$results["eye_technician"];$eye_don_counselors=$results["eye_don_counselors"];$task_staff=$results["task_staff"];$space_req=$results["space_req"];
		$is_records_main=$results["is_records_main"];$is_reg_pledges=$results["is_reg_pledges"];$is_comp_fac=$results["is_comp_fac"];
		$name_2=$results["name_2"];$eye_ret_add=$results["eye_ret_add"];
		$is_eye_ret_gov=$results["is_eye_ret_gov"];$is_eye_ret_teaching=$results["is_eye_ret_teaching"];
		$eye_ret_info=$results["eye_ret_info"];$eye_ret_name=$results["eye_ret_name"];
		$rem_incharge=$results["rem_incharge"];$rem_technician=$results["rem_technician"];$rem_mts=$results["rem_mts"];$is_rem_trans=$results["is_rem_trans"];
		$is_amb_col=$results["is_amb_col"];$is_instr_set=$results["is_instr_set"];$is_spc_bot_pres=$results["is_spc_bot_pres"];$is_transit=$results["is_transit"];$is_prev_med=$results["is_prev_med"];$is_waste=$results["is_waste"];$tel_number=$results["tel_number"];$s_req=$results["s_req"];
		$is_records=$results["is_records"];
		$ster_facility=$results["ster_facility"];$ref_temp=$results["ref_temp"];$ret_centre=$results["ret_centre"];$trans_name=$results["trans_name"];$trans_add=$results["trans_add"];$is_trans_gov=$results["is_trans_gov"];$is_trans_teaching=$results["is_trans_teaching"];$is_trans_iec=$results["is_trans_iec"];$trans_reg_name=$results["trans_reg_name"];
		$per_staff_no=$results["per_staff_no"];$temp_staff_no=$results["temp_staff_no"];$equip_det=$results["equip_det"];$is_OT_facilities=$results["is_OT_facilities"];$is_safe_sto_facilities=$results["is_safe_sto_facilities"];$records_reg=$results["records_reg"];$any_info=$results["any_info"];
		
		if(!empty($results["equip"])){
			$equip=json_decode($results["equip"]);
			$equip_a=$equip->a;$equip_b=$equip->b;$equip_c=$equip->c;$equip_d=$equip->d;$equip_e=$equip->e;
		}else{			
			$equip_a="";$equip_b="";$equip_c="";$equip_d="";$equip_e="";
		}
		if(!empty($results["lab_facility"])){
			$lab_facility=json_decode($results["lab_facility"]);
			$lab_facility_a=$lab_facility->a;$lab_facility_b=$lab_facility->b;$lab_facility_c=$lab_facility->c;
		}else{			
			$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
		}
		if(!empty($results["reg_renewal"])){
			$reg_renewal=json_decode($results["reg_renewal"]);
			$reg_renewal_a=$reg_renewal->a;$reg_renewal_b=$reg_renewal->b;$reg_renewal_c=$reg_renewal->c;
		}else{			
			$reg_renewal_a="";$reg_renewal_b="";$reg_renewal_c="";
		}
		if($is_eye_bnk_gov=="G"){
			$is_eye_bnk_gov="GOVERNMENT";
		}else if($is_eye_bnk_gov=="P"){
			$is_eye_bnk_gov="PRIVATE";
		}else if($is_eye_bnk_gov=="V"){
			$is_eye_bnk_gov="VOLUNTARY";
		}else{
			$is_eye_bnk_gov="";
		}
		
		$is_teaching=($is_teaching=="T")?'TEACHING':'NON TEACHING';
		$is_eye_bnk_iec=($is_eye_bnk_iec=="Y")?'YES':'NO';
		$is_availability=($is_availability=="Y")?'YES':'NO';
		$is_register_main=($is_register_main=="Y")?'YES':'NO';
		$is_transport_facility=($is_transport_facility=="Y")?'YES':'NO';
		$is_instrument=($is_instrument=="Y")?'YES':'NO';
		$is_preservation=($is_preservation=="Y")?'YES':'NO';
		$is_pre_media=($is_pre_media=="Y")?'YES':'NO';
		$is_waste_disp=($is_waste_disp=="Y")?'YES':'NO';
		$is_power_supply=($is_power_supply=="Y")?'YES':'NO';
		$is_records_main=($is_records_main=="Y")?'YES':'NO';
		$is_reg_pledges=($is_reg_pledges=="Y")?'YES':'NO';
		$is_comp_fac=($is_comp_fac=="Y")?'YES':'NO';
		if($is_eye_ret_gov=="G"){
			$is_eye_ret_gov="GOVERNMENT";
		}else if($is_eye_ret_gov=="P"){
			$is_eye_ret_gov="PRIVATE";
		}else if($is_eye_ret_gov=="V"){
			$is_eye_ret_gov="VOLUNTARY";
		}else{
			$is_eye_ret_gov="";
		}
		$is_eye_ret_teaching=($is_eye_ret_teaching=="T")?'TEACHING':'NON TEACHING';
		$is_rem_trans=($is_rem_trans=="Y")?'YES':'NO';
		$is_amb_col=($is_amb_col=="Y")?'YES':'NO';
		$is_instr_set=($is_instr_set=="Y")?'YES':'NO';
		$is_spc_bot_pres=($is_spc_bot_pres=="Y")?'YES':'NO';
		$is_transit=($is_transit=="Y")?'YES':'NO';
		$is_prev_med=($is_prev_med=="Y")?'YES':'NO';
		$is_waste=($is_waste=="Y")?'YES':'NO';
		$is_records=($is_records=="Y")?'YES':'NO';
		
		if($is_trans_gov=="G"){
			$is_trans_gov="GOVERNMENT";
		}else if($is_trans_gov=="P"){
			$is_trans_gov="PRIVATE";
		}else if($is_trans_gov=="V"){
			$is_trans_gov="VOLUNTARY";
		}else{
			$is_trans_gov="";
		}
		$is_trans_teaching=($is_trans_teaching=="T")?'TEACHING':'NON TEACHING';
		$is_trans_iec=($is_trans_iec=="Y")?'YES':'NO';
		$is_OT_facilities=($is_OT_facilities=="Y")?'YES':'NO';
		$is_safe_sto_facilities=($is_safe_sto_facilities=="Y")?'YES':'NO';
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
			<p  style="text-align:center"></p>
		</div><br/>
		<table class="table table-bordered table-responsive">		
			<tr>				
				<td colspan="2"><b>I. EYE BANKING</b></td>
			
			</tr>
			<tr>
				<td valign="top"><b>(A) EYE BANK & Institution affiliated Ophthalmic/General Hospital</b></td>
				<td>
				<table class="table table-bordered table-responsive">
				
						<tr>
							<td>1. Name :</td>
							<td>'.strtoupper($eye_bnk_name).'</td>
						</tr>
						<tr>
							<td>2. Address :</td>
							<td>'.strtoupper($eye_bnk_ad).'</td>
						</tr>
						<tr>
							<td>3. Government / Private / Voluntary :</td>
							<td>'.strtoupper($is_eye_bnk_gov).'</td>
						</tr>
						<tr>
							<td>4. Teaching / Non teaching :</td>
							<td>'.strtoupper($is_teaching).'</td>
						</tr>
						<tr>
							<td>5. IEC for Eye Donation :</td>
							<td>'.strtoupper($is_eye_bnk_iec).'</td>
						</tr>
				</table>
				</td>	
			</tr>
			<tr>
				    <td colspan="2"><b>(B) REMOVAL OF EYE BALLS AND STORAGE</b></td>
			</tr>
			<tr>
				<td >1. Availability of adequate trained and qualified Personal for removal of eye balls/cornea ?</td>
				<td>'.strtoupper($is_availability).'</td>
			</tr>
			
			<tr>
					<td colspan="2">2. Name, qualification & address of the designated staff who will be doing whole globe / cornea retrieval :</td>
			</tr>
			<tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">			
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Name</td>
								<td>Qualification</td>
								<td>Address</td>
							</tr>
							</thead>';					
								$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["name"]).'</td>
									<td>'.strtoupper($row_1["qualification"]).'</td>
									<td>'.strtoupper($row_1["address"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>
			
			<tr>
				<td colspan="2">3. Availability of following as per requirement : </td>
			</tr>
			<tr>
				<td>(a) Whether register maintained for tissue request received from surgeon of corneal transplant centre :  </td>
				<td>'.strtoupper($is_register_main).'</td>
			</tr>
			<tr>
				<td>(b) Mobile No :</td>
				<td>' . $m_no . '</td>
			</tr>
			<tr>
				<td>(c) Transport facility for collecting Eyeballs from outside : </td>
				<td>'.strtoupper($is_transport_facility).'</td>
			</tr>
			<tr>
				<td>(d) Sets of Instruments for removal of whole globe/Cornea as per requirement :</td>
				<td>'.strtoupper($is_instrument).'</td>
			</tr>
			<tr>
				<td>(e) Special bottles with stands for preservation of eye Balls / Cornea during transit :</td>
				<td>'.strtoupper($is_preservation).'</td>
			</tr>
			<tr>
				<td>(f) Suitable preservation media :</td>
				<td>'.strtoupper($is_pre_media).'</td>
			</tr>
			<tr>
				<td>(g) Biomedical waste disposal : </td>
				<td>'.strtoupper($is_waste_disp).'</td>
			</tr>
			<tr>
				<td>(h) Uninterrupted Power supply :</td>
				<td>'.strtoupper($is_power_supply).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>(C) MANPOWER </b></td>
			</tr>
			<tr>
				<td>1. In charge / Director (Ophthalmologist) : </td>
				<td>'.strtoupper($incharge).'</td>
			</tr>
			<tr>
				<td>2. Eye Bank Technician :</td>
				<td>'.strtoupper($eye_technician).'</td>
			</tr>
			<tr>
				<td>3. Eye Donation Counselors (EDC) :</td>
				<td>'.strtoupper($eye_don_counselors).'</td>
			</tr>
			<tr>
				<td>4. Multi task Staff (MTS) :</td>
				<td>'.strtoupper($task_staff).'</td>
			</tr>
			
			<tr>
				<td ><b>(D)Space requirement for eye Banks  ( 400 sqft minimum )</b></td>
				<td>'.strtoupper($space_req).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>(E) RECORDS </b></td>
			</tr>
			<tr>
				<td>1. Arrangement for maintaining the records :</td>
				<td>'.strtoupper($is_records_main).'</td>
			</tr>
			<tr>
				<td>2. Arrangement for registration of pledges/donors and maintenance of utilization report :</td>
				<td>'.strtoupper($is_reg_pledges ).'</td>
			</tr>
			
			<tr>
				<td>3. Computer with internet facility and printer :</td>
				<td>'.strtoupper($is_comp_fac).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>(F) EQUIPMENT </b></td>
			</tr>
			
			<tr>
				<td>1. Slit lamp Bio microscope :</td>
				<td>'.strtoupper($equip_a).'</td>
				
			</tr>
			<tr>
				<td>2. Specular Microscope for Eye Bank :</td>
				<td>'.strtoupper($equip_b).'</td>
			</tr>
			
			<tr>
				<td>3. Laminar flow (Class II) :</td>
				<td>'.strtoupper($equip_c).'</td>
			</tr>
			<tr>
				<td>4. Sterilization facility (In-house or outsourced) :</td>
				<td>'.strtoupper($equip_d).'</td>
			</tr>
			<tr>
				<td>5. Refrigerator with temperature monitoring for preservation of Eyeballs/ Cornea :</td>
				<td>'.strtoupper($equip_e).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>(G) LABORATORY FACILITIES </b></td>
			</tr>
			<tr>
				<td>1. Facility for HIV, Hepatitis B & C testing :</td>
				<td>'.strtoupper($lab_facility_a).'</td>
				
			</tr>
			<tr>
				<td>2. In no where do you avail it? Please mention Name and address of Institute :</td>
				<td>'.strtoupper($lab_facility_b).'</td>
			</tr>
			
			<tr>
				<td>3. Facility for culture and sensitivity of Corneoscleral ring. :</td>
			    <td>'.strtoupper($lab_facility_c).'</td>
			</tr>
			<tr>
				<td colspan="2"><b>(H) RENEWAL OF REGISTRATION</b></td>
			</tr>
			
			<tr>
				<td>1. Period of renewal 5 years after last registration :</td>
				<td>'.strtoupper($reg_renewal_a).'</td>
				
			</tr>
			<tr>
				<td>2. Minimum of 500 corneas to be collected in 5 years :</td>
				<td>'.strtoupper($reg_renewal_b).'</td>
			</tr>
			
			<tr>
				<td>3. Maintenance of eye bank standards (as per Guidelines) :</td>
				<td>'.strtoupper($reg_renewal_c).'</td>
			</tr>
			<tr>				
				<td colspan="2"><b>II. EYE RETRIEVAL CENTRE (ERC)</b></td>
			</tr>
			<tr>
			
				<td valign="top"><b>(A) RETRIEVAL CENTER – A Centre affiliated to an EYE Bank</b></td>
				<td>
				<table class="table table-bordered table-responsive">
			
						<tr>
							<td>1. Name :</td>
							<td>'.strtoupper($name_2).'</td>
							
						</tr>
						<tr>
							<td>2. Address :</td>
							<td>'.strtoupper($eye_ret_add).'</td>
						</tr>
						<tr>
							<td>3. Government / Private / Voluntary :</td>
							<td>'.strtoupper($is_eye_ret_gov).'</td>
						</tr>
						<tr>
							<td>4. Teaching / Non teaching :</td>
							<td>'.strtoupper($is_eye_ret_teaching).'</td>
						</tr>
						<tr>
							<td>5. Information, Education and Communication Activities for Eye Donation :</td>
							<td>'.strtoupper($eye_ret_info).'</td>
						</tr>
						<tr>
							<td>6. Name of Eye Bank to which ERC is affilited :</td>
							<td>'.strtoupper($eye_ret_name).'</td>
						</tr>
					 </table>
					</td>	
			</tr>
			<tr>
				    <td colspan="2"><b>(B) REMOVAL OF EYE BALLS AND STORAGE</b></td>
			</tr>
			<tr>
				    <td colspan="2">1. Manpower: Adequate trained and qualified personal for removal of eye balls/cornea(annex detail) :</td>
			</tr>
			<tr>
				<td>a. In charge / Director :</td>
				<td>'.strtoupper($rem_incharge).'</td>
			</tr>
			<tr>
				<td>b. Technician :</td>
				<td>'.strtoupper($rem_technician).'</td>
			</tr>
			<tr>
				<td>c. MTS (Multi task staff) :</td>
				<td>'.strtoupper($rem_mts).'</td>
			</tr>
			<tr>
					<td>2. Transport facility (or outsource) with storage medium :</td>
					<td>'.strtoupper($is_rem_trans).'</td>
			</tr>
			<tr>
					<td colspan="2"><b>(C) Name, qualification and address of the personal who will be doing enucleation / removal of cornea (annex details) :</b></td>
			</tr>
			<tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">			
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Name</td>
								<td>Qualification</td>
								<td>Address</td>
							</tr>
							</thead>';					
								$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
								while($row_2=$part2->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_2["slno"]).'</td>
									<td>'.strtoupper($row_2["name2"]).'</td>
									<td>'.strtoupper($row_2["qualification2"]).'</td>
									<td>'.strtoupper($row_2["address2"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
            </tr>
				   
			<tr>
				    <td colspan="2"><b>(D) AVAILABILITY OF FOLLOWING </b></td>
			</tr>
			<tr>
					<td>1. Ambulance/ vehicle or funds to pay taxi for collecting eye balls from Outside :</td>
					<td>'.strtoupper($is_amb_col).'</td>
			</tr>
			<tr>
					<td>2. Sets of instruments for removal of Eye Balls / Cornea :</td>
					<td>'.strtoupper($is_instr_set).'</td>
			</tr>
			<tr>
					<td>3. Special bottles with stands for preservation :</td>
					<td>'.strtoupper($is_spc_bot_pres).'</td>
			</tr>
			<tr>
					<td>4. Eye balls/cornea during transit :</td>
					<td>'.strtoupper($is_transit).'</td>
			</tr>
			<tr>
					<td>5. Suitable preservation media :</td>
					<td>'.strtoupper($is_prev_med).'</td>
			</tr>
			<tr>
					<td>6. Waste Disposal(Biomedical Waste Management) :</td>
					<td>'.strtoupper($is_waste).'</td>
			</tr>
			<tr>
					<td>7. Mobile Number :</td>
					<td>' . $tel_number . '</td>
			</tr>
			<tr>
					<td>8. Space requirement(Designated area) :</td>
					<td>'.strtoupper($s_req).'</td>
			</tr>
			<tr>
				    <td colspan="2"><b>(E) RECORDS </b></td>
			</tr>
			<tr>
					<td>1. Arrangement for maintaining the records  :</td>
					<td>'.strtoupper($is_records).'</td>
			</tr>
			<tr>
				    <td colspan="2"><b>(F) EQUIPMENT </b></td>
			</tr>
			<tr>
					<td>1. Sterilization facility  :</td>
					<td>'.strtoupper($ster_facility).'</td>
			</tr>
			<tr>
					<td>2. Refrigerator temperature control 24 hrs for preservation of Eyeballs/Cornea. (power back up) :</td>
					<td>'.strtoupper($ref_temp).'</td>
			</tr>
			<tr>
					<td>3. The retrieval centre is affiliated with an eye bank and Eye Bank is only authorized to distribute corneas :</td>
					<td>'.strtoupper($ret_centre).'</td>
			</tr>
			<tr>				
				<td colspan="2"><b>III. CORNEAL TRANSPLANTATATION CENTRE</b></td>
			
			</tr>
			<tr>
				<td colspan="2"><b>(A)</b></td>
				<td>
				<table class="table table-bordered table-responsive">
			
						<tr>
							<td valign="top">1. Name of the Transplant Centre / Hospital :</td>
							<td>'.strtoupper($trans_name).'</td>
						</tr>
						<tr>
							<td>2. Address :</td>
							<td>'.strtoupper($trans_add).'</td>
						</tr>
						<tr>
							<td>3. Government / Private / Voluntary :</td>
							<td>'.strtoupper($is_trans_gov).'</td>
						</tr>
						<tr>
							<td>4. Teaching / Non teaching :</td>
							<td>'.strtoupper($is_trans_teaching).'</td>
						</tr>
						<tr>
							<td>5. IEC for Eye Donation :</td>
							<td>'.strtoupper($is_trans_iec).'</td>
						</tr>
						<tr>
							<td>6. Name of the registered Eye Bank for procuring tissue :</td>
							<td>'.strtoupper($trans_reg_name).'</td>
						</tr>
					</table>
                </td>
			</tr>
			<tr>
				    <td colspan="2"><b>(B)</b></td>
			</tr>
			
			<tr>
					<td>1. No. of permanent staff members with their designation :</td>
					<td>'.strtoupper($per_staff_no).'</td>
			</tr>
			<tr>
					<td>2. No. of temporary staff with their designation :</td>
					<td>'.strtoupper($temp_staff_no).'</td>
			</tr>
			<tr>
					<td colspan="2">3. Trained persons for Keratoplasty and Corneal Transplantation with their names and qualifications: 2 (one Corneal Transplant surgeon should be on the pay roll of the Institute) :</td>
			</tr>
		    <tr>
				<td colspan="2">
						<table class="table table-bordered table-responsive">			
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Name</td>
								<td>Qualification</td>
								
							</tr>
							</thead>';					
								$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
								while($row_3=$part3->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_3["slno"]).'</td>
									<td>'.strtoupper($row_3["name3"]).'</td>
									<td>'.strtoupper($row_3["qualification3"]).'</td>
									
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
			</tr>
			
			<tr>
				    <td><b>(C) Equipment: Slit lamp, Clinical Specular, Keratoplasty or intraocular instruments :</b></td>
					<td>'.strtoupper($equip_det).'</td>
			</tr>
			<tr>
					<td><b>(D) OT facilities :</b></td>
					<td>'.strtoupper($is_OT_facilities).'</td>
			</tr>
			<tr>
					<td><b>(E) Safe Storage facility :</b></td>
					<td>'.strtoupper($is_safe_sto_facilities).'</td>
			</tr>
			<tr>
					<td><b>(F) Records Registration and follow up :</b></td>
					<td>'.strtoupper($records_reg).'</td>
			</tr>
			<tr>
					<td><b>(G) Any other information :</b></td>
					<td>'.strtoupper($any_info).'</td>
			</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
			<tr>
				<td rowspan="2" valign="top"><b>Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</b>
				<br/>
				<b>Place : '.strtoupper($dist).'</b></td>
				<td align="right"><b>Signature of Head of Institution : '.strtoupper($key_person).'<br/>
				Name : '.strtoupper($key_person).' </b></td>
			</tr>
		</table>';
?>