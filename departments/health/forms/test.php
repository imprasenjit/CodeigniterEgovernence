<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >				
	<tr>				
		<td valign="top" width="50%">I.ESTABLISHMENT DETAILS</td>
	</tr>
	 <tr>
			<td>1.Name of the establishment :</td>
			<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td valign="top">2.Address of the establishment:</td>
		<td>
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >	
				<tr>
					<td valign="top" width="50%">Street Name 1</td>
					<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
					<td valign="top">Street Name 2</td>
					<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
					<td valign="top">Village/Town/city</td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td valign="top">Block</td>
					<td>'.strtoupper($b_block).'</td>
				</tr>
				<tr>
					<td valign="top">District</td>
					<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
					<td valign="top">Pincode</td>
					<td>'.strtoupper($b_pincode).'</td>
				</tr>
				<tr>
					<td valign="top">Mobile No.</td>
					<td>'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
					<td valign="top">E-Mail ID</td>
					<td>'.$b_email.'</td>
				</tr>
				<tr>
					<td valign="top">Website (if any)</td>
					<td>'.strtoupper($website_name).'</td>
				</tr>				
			</table>
		</td>
	</tr>
	<tr>
			<td>3.Month and Year of starting :</td>
			<td>'.strtoupper($starting_date).'</td>
	</tr>
	<tr>
		<td colspan="2">(From 4 to 11 mark all whichever are applicable)</td>
	</tr>	
	<tr>
		<td>4. Location:  </td>
		<td>' . $location_values . '</td>
	</tr>
	<tr>
		<td><u>Non-Government / Private Sector</u>  </td>
		<td>' . $ownership_values . '</td>
	</tr>
	<tr>
		<td><u>Non-Government / Private Sector</u>  </td>
		<td>' . $ownership2_values . '</td>
	</tr>
	<tr>
		<td>6. Name of the owner of Clinical Establishment:</td>
		<td>'.strtoupper($owner_name).'</td>
	</tr>

	<tr>				
		<td valign="top" width="50%">Address </td>
	</tr>
	
	<tr>
		
		<td>
			
				<tr>
					<td valign="top" width="50%">Street Name 1</td>
					<td>'.strtoupper($o_street_name1).'</td>
				</tr>
				<tr>
					<td valign="top">Street Name 2</td>
					<td>'.strtoupper($o_street_name2).'</td>
				</tr>
				<tr>
					<td valign="top">Village/Town/city</td>
					<td>'.strtoupper($o_vill).'</td>
				</tr>
				<tr>
					<td valign="top">Block</td>
					<td>'.strtoupper($o_block).'</td>
				</tr>
				<tr>
					<td valign="top">District</td>
					<td>'.strtoupper($o_dist).'</td>
				</tr>
				<tr>
					<td valign="top">Pincode</td>
					<td>'.strtoupper($o_pin).'</td>
				</tr>
				<tr>
					<td valign="top">Mobile No.</td>
					<td>'.strtoupper($o_mobile_no).'</td>
				</tr>
				<tr>
					<td valign="top">E-Mail ID</td>
					<td>'.$o_email.'</td>
				</tr>
				<tr>
					<td valign="top">Website (if any)</td>
					<td>'.strtoupper($website_name).'</td>
				</tr>				
			
		</td>
	</tr>
	
	<tr>
		<td colspan="2">7. Name, Designation and Qualification of person in-charge of the clinical establishment: </td>
	</tr>
	<tr>
		<td colspan="2">
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >	
		<thead>
			<tr>
				<th width="10%" align="center">Sl no</th>
				<th width="10%" align="center">Name</th>
				<th width="10%" align="center">Designation</th>
				<th width="10%" align="center">Qualification</th>
				<th width="10%" align="center">Registration Number</th>
				<th width="15%" align="center">Name of Central/State Council(with which registered)</th>
				<th width="15%" align="center">Mobile</th>
				<th width="20%" align="center">E-mail ID</th>
			</tr>
		</thead>
		<tbody>';
		$part1=$health->query("SELECT * FROM health_form1_t1 WHERE form_id='$form_id'") or die("Error : ".$health->error);
		$num = $part1->num_rows;
		if($num>0){
			$count=1;
			while($row_1=$part1->fetch_array()){ 
$printContents=$printContents.'
			<tr>
				<td>' . $count . '</td>
				<td>' . $row_1["name"] . '</td>
				<td>' . $row_1["designation"] . '</td>				
				<td>' . $row_1["qualification"] . '</td>
				<td>' . $row_1["reg_no"] . '</td>
				<td>' . $row_1["name_of_central"] . '</td>	
				<td>' . $row_1["mobile"] . '</td>													
				 <td>' . $row_1["email"] . '</td>	
			</tr>';
				
			}
		}
$printContents=$printContents.'</tbody>											
			</table>
		</td>
	</tr>	
	<tr>
		<td> Systems of Medicine offered: (please tick whichever is applicable)  </td>
		<td>' .$system_values. '</td>
	</tr>
	<tr>
		<td> (I) Clinic (Outpatient)  </td>
		<td>' . $clinic_values . '</td>
	</tr>
	<tr>
		<td>(II). Day Care facility<br/><br/>(a)</td>
		<td>' .$facility_values. '</td>
	</tr>
	<tr>
		<td>(III). Hospitals including Nursing Home (outpatient and inpatient): </u>   </td>
		<td>' .$hospital_values. '</td>
	</tr>
	<tr>
		<td>(IV). Dental Clinics and Dental Hospital:</td>
		<td>' .$dental_values. '</td>
	</tr>
	
	<tr>
		<td>(V).Diagnostic Centre:</td>
	</tr>
	<tr>
		 <td>A. Medical Diagnostic Laboratories:</td>
		<td>' .$medical_values. '</td>
	</tr>
	<tr>
		<td>B. Diagnostic Imaging centers:</td>
	</tr>
	<tr>
		<td>i. Radiology :</td>
		<td>' .$imaging_values. '</td>
	</tr>
	<tr>
		<td>ii. Electromagnetic imaging: </td>
		<td>' .$imaging_values. '</td>
	</tr>
	<tr>
		<td>iii. Ultrasound: </td>
		<td>' .$imaging_values. '</td>
	</tr>
	<tr>
		<td>C. Miscellaneous</td>
		<td>' .$miscellaneous_values. '</td>
	</tr>
	<tr>
		<td valign="top">Collection centers For the clinical labs and diagnostic centres shall function under registered clinical establishment.</td>
		<td>'.$is_clinical.'</td>
	</tr>
	<tr>
		<td>(VI). Allied Health professions: </td>
		<td>' .$health_values. '</td>
	</tr>
	<tr>
		<td>TYPE</td>
		<td>' .$service_values. '</td>
	</tr>
	<tr>
		<td>SPECIALITY SPECIFIC</td>
	</tr>
	<tr>
		<td>Medical Specialties – for which candidates must possess recognized PG degree(MD/Diploma/DNB or its equivalent degree)</td>
		<td>' .$degree_values. '</td>
	</tr>
	<tr>
		<td>Surgical specialties</td>
		<td>' .$surgical_special_values. '</td>
	</tr>
	<tr>
		
		<td>Medical Super specialties</td>
		<td>' .$specialties_values. '</td>
	</tr>
	
	<tr>
		
		<td>Surgical Super specialties</td>
		<td>' .$surgical_values. '</td>
	</tr>
	
	<tr>				
		<td valign="top" width="50%">III INFRASTRUCTURE DETAILS</td>
	</tr>
				<tr>
					<td>10. Area of the establishment (in sqft):</td>
				</tr>
				<tr>
					<td>a) Total Area::</td>
					<td>'.strtoupper($estarea).'</td>
				</tr>
				<tr>
					<td>b) Constructed area:</td>
					<td>'.strtoupper($cnstarea).'</td>
				</tr>
				<tr>
					<td>11. Out Patient Department:</td>
				</tr>
				<tr>
					<td>11.1 Total no. of OPD Clinics:</td>
					<td>'.strtoupper($total_no).'</td>
				</tr>
				
	<tr>
			<td colspan="2">11.2 Specialty-wise distribution of OPD Clinic.</td>
		   </tr>
		   <tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
					<thead>
					<tr>												
						<td width="50">S. No.</td>
						<td width="50">Specialty</td>
						
					</tr>
					</thead>';					
						$part2=$health->query("SELECT * FROM health_form1_t2 WHERE form_id='$form_id'");
						while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["special"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		  </tr
		<tr>
			<td>12. In Patient Department:</td>
		</tr>
				<tr>
					<td>1. Total number of beds:</td>
					<td>'.strtoupper($total_no_bed).'</td>
				</tr>
	
	<tr>
			<td colspan="2">12.2. Specialty-wise distribution of beds, please specify:</td>
		   </tr>
		   <tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
					<thead>
					<tr>												
						<th width="25">S. No.</th>
						<th width="38">Specialty</th>
						<th width="37%">Beds</th>
						
					</tr>
					</thead>';					
						$part3=$health->query("SELECT * FROM health_form1_t3 WHERE form_id='$form_id'");
						while($row_3=$part3->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_3["slno"]).'</td>
							<td>'.strtoupper($row_3["specialty"]).'</td>
							<td>'.strtoupper($row_3["bed"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		  </tr>
			<tr>
					<td colspan="2">13. Biomedical waste Management</td>
					
			</tr>
			<tr>
					<td>13.1 Method of treatment and /or disposal of Bio-medical waste</td>
					<td>'.$biomedical_values.'</td>
					
			</tr>
			<tr>
					<td>13.2.Whether authorization from Pollution Control Board/Pollution Control Committee obtained?</td>
					<td>'.$pollution_values.'</td>
					
			</tr>
	<tr>				
		<td valign="top" width="50%">IV HUMAN RESOURCES</td>
	
	</tr>
	<tr>
			<td>No. of permanent staff :</td>
			<td>'.strtoupper($permanent_no).'</td>
	</tr>
	<tr>
			<td>No. of temporary staff:</td>
			<td>'.strtoupper($temporary_no).'</td>
	</tr>
	
	
	
<tr>
<td valign="top" colspan="2">Please furnish the following details:-</td>
</tr>
<tr>
<td colspan="2">
<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
<thead>
<tr>
	<th width="10">Sl No.</th>
	<th width="10">Name</th>
	<th width="20">Category of staff</th>
	<th width="20">Qualification</th>
	<th width="20">Registration</th>
	<th width="20">Nature of service Temporary/Permanent</th>			
</tr>
</thead>';
$part4=$health->query("select * from health_form1_t4 where form_id='$form_id'");
$num4 = $part4->num_rows;
if($num4>0){
	$slno=1;
	while($row_4=$part4->fetch_array()){
	if($row_4["select_category"]=="D"){
	$select_category="Doctors";
	}else if($row_4["select_category"]=="N"){
	$select_category="Nursing staff";
	}else if($row_4["select_category"]=="PH"){
	$select_category="Pharmacists";
	}else if($row_4["select_category"]=="A"){
	$select_category="Administrative staff";
	}else{
		$select_category="Others";
	}
	
	$printContents=$printContents.'
		<tr>
			<td>'.strtoupper($slno).'</td>
			<td>'.strtoupper($row_4["name"]).'</td>
			<td>'.strtoupper($select_category).'</td>
			<td>'.strtoupper($row_4["qualification"]).'</td>
			<td>'.strtoupper($row_4["registration"]).'</td>
			<td>'.strtoupper($row_4["nature"]).'</td>
			
		</tr>';
		$slno++;
	}
}else{
	$printContents=$printContents.'
		<tr>
			<td colspan="5">No records entered.</td>
		</tr>';
}
$printContents=$printContents.'
</table>
</td>
</tr>  
<tr>
<td valign="top" colspan="2">Support Staff :-</td>
</tr>
<tr>
<td valign="top" colspan="2">Separate annexure may be attached.:-</td>
</tr>
  
	<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
					<thead>
					<tr>												
						<th width="25">S.No.</th>
						<th width="38">Category</th>
						<th width="37%">Beds</th>
						<th width="37%">Remark</th>
						
					</tr>
					</thead>';					
						$part5=$health->query("SELECT * FROM health_form1_t5 WHERE form_id='$form_id'");
						while($row_5=$part5->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["cate_gory"]).'</td>
							<td>'.strtoupper($row_5["total_no"]).'</td>
							<td>'.strtoupper($row_5["remark"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		  </tr>
	
	';
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
	$printContents=$printContents.'
	<tr>		   
	<td colspan="2">
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >	
			<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
			<tr><td width="40%">Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
			<tr><td width="40%">Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
			<tr><td width="40%">Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
		</table>
	</td>
	</tr>
	';				
	}
	
	if($results["payment_mode"]!=NULL){
	$printContents=$printContents.'<tr>		    
	<td colspan="2">
		<table border="1" align="center" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive" width="100%">
		<tr><td height="45px" colspan="2">Payment Details :</td></tr>
		<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
		if($results["payment_mode"]==0)
		{
			$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
			<td>'.$offline_challan.'</td></tr>';
		}else{
			$printContents=$printContents.$formFunctions->online_payment_details($uain);
		}
		$printContents=$printContents.'</table>		
	</td>
  </tr>';
  }		
	$printContents=$printContents.'
	<tr>
		<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
		<td align="right">Signature of Applicant : '.strtoupper($key_person).'<br/>
		Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
	</tr>
</table>