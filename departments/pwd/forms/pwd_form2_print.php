<?php
$dept="pwd";
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


	if($q->num_rows>0){ 
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		########## Part A ###############
		$vendor_name=$results["vendor_name"];$reg_number=$results["reg_number"];$application_number=$results["application_number"];$vendor_type=$results["vendor_type"];$fathers_name=$results["fathers_name"];$caste=$results["caste"];$religion=$results["religion"];$date_of_birth=$results["date_of_birth"];$nationality=$results["nationality"];
		$pwrd_wing=$results["pwrd_wing"];
		if(!empty($results["permanent_address"])){
			$permanent_address=json_decode($results["permanent_address"]);
			$street_name1=$permanent_address->sn1;$street_name2=$permanent_address->sn2;$vill=$permanent_address->vill;$dist=$permanent_address->dist;$pincode=$permanent_address->pin;$mobile_no=$permanent_address->mobile_no;
		}else{				
			$permanent_address_sn1="";$permanent_address_sn2="";$permanent_address_vil="";$permanent_address_dist="";$permanent_address_pin="";$permanent_address_mobile_no="";
		}
		if(!empty($results["present_address"])){
			$present_address=json_decode($results["present_address"]);
			$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vil;$present_address_dist=$present_address->dist;$present_address_pincode=$present_address->pincode;$present_address_mno=$present_address->mno;
		}else{				
			$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pincode="";$present_address_mno="";
		}
		$financial_det_year=$results["financial_det_year"];$pan_no=$results['pan_no'];$gst_no=$results["gst_no"];$bank_name=$results["bank_name"];$branch_name=$results["branch_name"];$acc_no=$results["acc_no"];$category_class=$results["category_class"];

		if($category_class=="A"){
			$category_class="Class I (A)";
		}else if($category_class=="B"){
			$category_class="Class I (B)";
		}else{
			$category_class="Class I (C)";
		}
		########## Part B ###############
		$reg_date=$results["reg_date"];$reg_renewal_date=$results["reg_renewal_date"];
		
		########## Part C ###############
		
		########## Part D ###############
		$brief_desc=$results["brief_desc"];

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
		</div><br/>
		<table class="table table-bordered table-responsive">
			
			<tr>
						<td width="50%" valign="top">1. Vendor Details</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td width="50%">Name :</td>
									<td>'.strtoupper($vendor_name).'</td>
								</tr>
								<tr>
									<td width="50%">Registration Number :</td>
									<td>'.strtoupper($reg_number).'</td>
								</tr>
								<tr>
									<td width="50%">Application Number :</td>
									<td>'.strtoupper($application_number).'</td>
								</tr>
							</table>
						</td>
			</tr>
			<tr>				
				<td width="50%">2. Type of vendor :</td>
				<td  width="50%">'.strtoupper($vendor_type).'</td>
			</tr>
			<tr>				
				<td width="50%">3. Name of father/husband (in case of individual) :</td>
				<td  width="50%">'.strtoupper($fathers_name).'</td>
			</tr>
			<tr>				
				<td width="50%">4. Caste :</td>
				<td  width="50%">'.strtoupper($caste).'</td>
			</tr>
			<tr>				
				<td width="50%">5. Religion :</td>
				<td  width="50%">'.strtoupper($religion).'</td>
			</tr>
			<tr>				
				<td width="50%">6. Date of Birth :</td>
				<td  width="50%">'.strtoupper($date_of_birth).'</td>
			</tr>
			<tr>				
				<td width="50%">7. Nationality : </td>
				<td  width="50%">'.strtoupper($nationality).'</td>
			</tr>
			<tr>				
				<td width="50%">8. PWRD Wing :</td>
				<td  width="50%">'.strtoupper($pwrd_wing).'</td>
			</tr>
			
			<tr>
						<td width="50%" valign="top">9. Permanent Address :</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No :</td>
									<td>'.strtoupper($mobile_no).'</td>
								</tr>
							</table>
						</td>
			</tr>
			<tr>
						<td width="50%" valign="top">10. Present address :</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($present_address_sn1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($present_address_sn2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($present_address_vil).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($present_address_dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($present_address_pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No. :</td>
									<td>'.strtoupper($present_address_mno).'</td>
								</tr>
								
							</table>
						</td>
			</tr>
			
			<tr>
				<td>11. Class & Category :</td>
				<td>'.strtoupper($category_class).'</td>
			</tr>
			<tr>
				<td>12. Financial Year :</td>
				<td>'.strtoupper($financial_det_year).'</td>
			</tr>
			<tr>
				<td>13. PAN Number :</td>
				<td>'.strtoupper($pan_no).'</td>
			</tr>
			<tr>
				<td>14. GST Number :</td>
				<td>'.strtoupper($gst_no).'</td>
			</tr>
			<tr>
					<td width="50%" valign="top">15. Bank Details :</td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
								<tr>
									<td width="50%">Bank Name :</td>
									<td>'.strtoupper($bank_name).'</td>
								</tr>
								<tr>
									<td width="50%">Branch Name :</td>
									<td>'.strtoupper($branch_name).'</td>
								</tr>
								<tr>
									<td width="50%">Account Number :</td>
									<td>'.strtoupper($acc_no).'</td>
								</tr>
								
							</table>
						</td>
			</tr>
			<tr>
				<td width="50%">16. Registration Date :</td>
				<td>'.strtoupper($reg_date).'</td>
			</tr>
			<tr>
				<td width="50%">17. Registration Renewal Date :</td>
				<td>'.$reg_renewal_date.'</td>
			</tr>
			<tr>
					<td width="50%" valign="top">18. Address of Regd. Office (Mandatory for Partnership Firm/Company </td>
						<td width="50%">
							<table class="table table-bordered table-responsive">
								<tr>
									<td width="50%">Street Name1 :</td>
									<td>'.strtoupper($b_street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street Name2 :</td>
									<td>'.strtoupper($b_street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($b_vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($b_dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pin Code :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No :</td>
									<td>'.strtoupper($b_mobile_no).'</td>
								</tr>
							</table>
						</td>
			</tr>
		<tr>
			<td colspan="2">19. Address of Individual/Proprietor in case of Proprietorship Firm.For Partnership firm, include address of all Partners. For Company, include address of designated person :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th width="20%">Sl. No.</th>
							<th width="40%">Partners/Directors Name</th>
							<th width="40%">Age</th>
							<th width="20%">Address</th>
							
						</tr>
					</thead>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->age).'</td>
						<td>'.strtoupper($rows->address).'</td>
					
					</tr>';
						$sl++;
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
			
		<tr>
			<td width="50%" valign="top">20. Contact person/Authorized Signatory details : </td>
				<td width="50%">
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Name of Authorised Signatory. :</td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
						<tr>
							<td>Street Name1 :</td>
							<td>'.strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name2 :</td>
							<td>'.strtoupper($street_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town :</td>
							<td>'.strtoupper($vill).'</td>
						</tr>
						<tr>
							<td>District :</td>
							<td>'.strtoupper($dist).'</td>
						</tr>
						<tr>
							<td>Pin Code :</td>
							<td>'.strtoupper($pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No :</td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>Email Id :</td>
							<td>'.strtoupper($email).'</td>
						</tr>
						
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">21. Completed Works :</td>
		</tr>
		<tr>
		<td colspan="2">Works executed in the last 5 years (Current Financial Year not to be included) :
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%" align="center">Sl. No.</td>
					<td width="40%" align="center">Prime/Sub Contractor</td>
					<td width="40%" align="center">Project Name</td>
					<td width="30%" align="center">Details</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["contractor_type"]).'</td>
							<td>'.strtoupper($row_1["project_name"]).'</td>
							<td>'.strtoupper($row_1["details"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">22. Quantities of work executed in the last 6 years (Current Financial Year not to be included)  :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="10%" align="center">Sl. No.</td>
					<td width="30%" align="center">Prime/Sub Contractor</td>
					<td width="30%" align="center">Work Item</td>
					<td width="40%" align="center">Quantity</td>
					<td width="20%" align="center">Financial Year</td>
					
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["contractor_type"]).'</td>
							<td>'.strtoupper($row_2["work_item"]).'</td>
							<td>'.strtoupper($row_2["quantity"]).'</td>
							<td>'.strtoupper($row_2["fin_year"]).'</td>
							
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">23. On going works :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%" align="center">Sl. No.</td>
					<td width="40%" align="center">Prime/Sub Contractor</td>
					<td width="40%" align="center">Project Name</td>
					<td width="30%" align="center">Details</td>
				</tr>';
				
				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
					while($row_3=$part3->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_3["slno"]).'</td>
							<td>'.strtoupper($row_3["contractor_type"]).'</td>
							<td>'.strtoupper($row_3["project_name"]).'</td>
							<td>'.strtoupper($row_3["details"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">24. Key Personnel for Works and Administration :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="10%" align="center">Sl. No.</td>
					<td width="40%" align="center">Work Position</td>
					<td width="40%" align="center">Name</td>
					<td width="40%" align="center">Qualification</td>
					<td width="30%" align="center">Experience</td>
				</tr>';
				
				$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
					while($row_4=$part4->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["work_position"]).'</td>
							<td>'.strtoupper($row_4["personnel_name"]).'</td>
							<td>'.strtoupper($row_4["qualification"]).'</td>
							<td>'.strtoupper($row_4["experience"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">25. Details of Machinery Owned :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%" align="center">Sl. No.</td>
					<td width="40%" align="center">Type of Equipment</td>
					<td width="40%" align="center">Numbers Owned</td>
					<td width="30%" align="center">Machinery Details</td>
					
				</tr>';
				
				$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
					while($row_5=$part5->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["type_of_equipment"]).'</td>
							<td>'.strtoupper($row_5["numbers_owned"]).'</td>
							<td>'.strtoupper($row_5["machinery_details"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">26. Financial Turnover from Civil Engineering Works in the Last 5 years (Current Financial Year Not To Be Included) :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="30%" align="center">Sl. No.</td>
					<td width="50%" align="center">Financial Year</td>
					<td width="40%" align="center">Turnover(INR)</td>
				</tr>';
				
				$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
					while($row_6=$part6->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_6["slno"]).'</td>
							<td>'.strtoupper($row_6["financial_year"]).'</td>
							<td>'.strtoupper($row_6["turnover"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">27. Litigation History :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%" align="center">Sl. No.</td>
					<td width="40%" align="center">Employer</td>
					<td width="40%" align="center">Cause of Dispute</td>
					<td width="30%" align="center">Status</td>
				</tr>';
				
				$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
					while($row_7=$part7->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_7["slno"]).'</td>
							<td>'.strtoupper($row_7["employer"]).'</td>
							<td>'.strtoupper($row_7["cause_of_dispute"]).'</td>
							<td>'.strtoupper($row_7["status"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">28. Vendor History :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="20%" align="center">Sl. No.</td>
					<td width="40%" align="center">Class</td>
					<td width="40%" align="center">Action</td>
					<td width="30%" align="center">Date</td>
				</tr>';
				
				$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
					while($row_8=$part8->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_8["slno"]).'</td>
							<td>'.strtoupper($row_8["class1"]).'</td>
							<td>'.strtoupper($row_8["action1"]).'</td>
							<td>'.strtoupper($row_8["date1"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	
		<tr>
			<td>29. Brief description of requirement :</td>
			<td>'.strtoupper($brief_desc).'</td>
		</tr>	
		
		<tr><td colspan="2" align="center"><strong>Contractors Declaration</strong></td> </tr>
		<tr>
			<td colspan="2" align="center">I declare that the data and credentials submitted/document attached by me for the mentioned year for vendor data update is correct.</td>
		</tr>
		';
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>