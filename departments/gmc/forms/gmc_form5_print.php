<?php
$dept="gmc";
$form="5";
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
	
		
	
		
		/////// FORM FETCHING DATA
		if($q->num_rows > 0){
			$results=$q->fetch_array();					
			$form_id=$results["form_id"];
			$holding_no=$results["holding_no"];$power=$results["power"];$is_business_started=$results["is_business_started"];
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
		<h2 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h2>
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>
			<tr>
				<td valign="top" width="50%">1. (a) Name of the Applicant :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td valign="top" width="50%">(b) Designation of the Applicant :</td>
				<td>'.strtoupper($status_applicant).'</td>
			</tr>
			<tr>
				<td valign="top" width="50%"> (c) Address of the Applicant</td>
				<td >
					<table class="table table-bordered table-responsive">
						<tbody>
							<tr>
								<td width="50%">Street name 1 </td>
								<td>'.strtoupper($street_name1).'</td>
							</tr>
							<tr>
								<td>Street name 2 </td>
							   
								<td>'.strtoupper($street_name2).'</td>
							</tr>
							<tr>
								<td>Town/Vill </td>								
								<td>'.strtoupper($vill).'</td>
							</tr>
							<tr>
								<td>District </td>								
								<td>'.strtoupper($dist).'</td>
							</tr>
							<tr>
								<td>State </td>								
								<td>'.strtoupper($block).'</td>
							</tr>
							<tr>
								<td>Pin Code </td>								
								<td>'.strtoupper($pincode).'</td>
							</tr>
						</tbody>
					</table>
			 </td>
			</tr>
			<tr>
				<td valign="top" width="50%">   (d) Landline No. of the Applicant : </td>
				<td>'.strtoupper($landline_std).'-'.strtoupper($landline_no).'</td>

			</tr>
			<tr>
				<td valign="top" width="50%">     (e) Mobile No. of the Applicant  :      </td>
				<td>+91 '.strtoupper($mobile_no).'</td>

			</tr>
			<tr>
				<td valign="top" width="50%">         2. Name of the Enterprise           </td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td width="50%">3. (a) Whether the business is new (not strarted) or existing (already started) :</td>
				<td>'.strtoupper($is_business_started).'</td>
			</tr>
			<tr>
				<td width="50%">&nbsp;&nbsp;&nbsp; (b) Date of commencement of business :</td>
				<td>'.strtoupper($date_of_commencement).'</td>
			</tr>
			<tr>
					<td valign="top" width="50%">     4. Legal Entity of the Business or Constitution of Business             </td>
					<td>'.strtoupper($owner_type).'</td>
			</tr>';
			if($owner_type=="H"){
				$printContents=$printContents.'
				<tr>
					<td colspan="3">5. For Hindu Undivided Family</td>
				</tr>
				<tr>
					<td>Name of the karta</td>
					<td>'.strtoupper($owners[0]).'</td>
				</tr>
				<tr>
					<td>Name of the other members</td>
					<td>
					<table>';							
							for($i=1; $i < count($owners); $i++) {
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($owners[$i]).'</td>								
								</tr>';
								} 
							$printContents=$printContents.'
					</table>
					</td>
				</tr>
			';
			}else if($owner_type=="PSU"){
				$printContents=$printContents.'
				<tr>
					<td colspan="3">5. For Public Sector Undertaking</td>
				</tr>
				<tr>
					<td>Name of the Chief Managing Director</td>
					<td>'.strtoupper($owners[0]).'</td>
				</tr>
				<tr>
					<td>Name of the other Directors</td>
					<td>
							<table>';							
									for($i=1; $i < count($owners); $i++) {
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($owners[$i]).'</td>								
								</tr>';
								} 
							$printContents=$printContents.'
							</table>
					</td>
				</tr>';
			}else if($owner_type=="PP" || $owner_type=="LLP"){
				$printContents=$printContents.'
				<tr>
					<td valign="top" >5.(a) Name of the Partners  : </td>
					<td>				'.strtoupper($row["Name_of_owner"]).'            </td>
				</tr>';
				if($owner_type=="LLP"){
				$printContents=$printContents.'	
				<tr>
					<td valign="top"> LLPIN of the Enterprise : </td>
					<td width="50%">'.strtoupper($cin_llpin).'</td>
				</tr>
				';
				}
			}else if($owner_type=="PTLC" || $owner_type=="PBLC"){
				$printContents=$printContents.'
			<tr>
				<td valign="top" >5.(a) Name of the Directors  : </td>
				<td>				'.strtoupper($row["owner_names"]).'            </td>
			</tr>
			<tr>
				<td valign="top"> CIN of the Enterprise : </td>
				<td width="50%">'.strtoupper($cin_llpin).'</td>
			</tr>
			';
			}else{
				$printContents=$printContents.'
				<tr>
				<td valign="top" >5.(a) Name of the '.strtoupper($legal_entity).'  : </td>
				<td>				'.strtoupper($owner_names).'            </td>
			</tr>';
			}
			$printContents=$printContents.'
				
				<tr>
					<td width="50%" valign="top" >6. (a) Type of unit for which NOC is being filled :</td>
					<td>'.strtoupper($unit_type).'</td>
				</tr>
							
				<tr>
					<td valign="top">(b) Address of the unit for which NOC is being filled :</td>
					<td >
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td width="50%">House No./Building Name</td>
									<td>'.strtoupper($b_street_name1).'</td>
								</tr>
								<tr>
									<td>Street/Locality</td>
								   
									<td>'.strtoupper($b_street_name2).'</td>
								</tr>
								<tr>
									<td>Village/ Town</td>
									
									<td>'.strtoupper($b_vill).'</td>
								</tr>
								<tr>
									<td>District</td>
									
									<td>'.strtoupper($b_dist).'</td>
								</tr>
								<tr>
									<td>Block/Word No. </td>
									
									<td>'.strtoupper($b_block).'</td>
								</tr>
								<tr>
									<td>Pin Code</td>									
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								<tr>
									<td> Revenue Circle</td>
									<td>'.strtoupper($circle).'</td>			
								</tr>
							</tbody>
						</table>
				 </td>
				</tr>
				<tr>
					<td valign="top" width="50%">7. Location of the Enterprise/Registered Office :</td>
					<td >
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td width="50%">House No./Building Name</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td>Street/Locality</td>								   
									<td>'.strtoupper($street_name2).'</td>
								</tr>
								<tr>
									<td>Village/ Town</td>
									
									<td>'.strtoupper($vill).'</td>
								</tr>
								<tr>
									<td>State</td>
									
									<td>'.strtoupper($state).'</td>
								</tr>
								<tr>
									<td>District</td>
									
									<td>'.strtoupper($dist).'</td>
								</tr>
								<tr>
									<td>Pin Code</td>									
									<td>'.strtoupper($pincode).'</td>
								</tr>
							</tbody>
						</table>
				 </td>
				</tr>
				<tr>
					<td valign="top"  width="50%">     8.(a) Landline No.           </td>
					<td>'.strtoupper($b_landline_std).'-'.strtoupper($b_landline_no).'</td>			
				</tr>
				<tr>
					<td valign="top"  width="50%">     (b) Mobile No.           </td>
					<td>+91 '.strtoupper($b_mobile_no).'</td>			
				</tr>				
				<tr>
					<td valign="top" width="50%">   (c) Email-ID.      </td>
					<td>'.$b_email.'</td>			
				</tr>
				<tr>
					<td width="50%" valign="top">   9. Size of Current Investment :   </td>
					<td>'.strtoupper($investment_size).'</td>
			
				</tr>
				<tr>
					<td width="50%" valign="top">   10. (a) Select Your Sector of Operation :  </td>
					<td>'.strtoupper($operation_sector).'</td>
			
				</tr>
				<tr>
					<td width="50%" valign="top">   (b) Select your business type :  </td>
					<td>'.strtoupper($business_type).'</td>			
				</tr>
				<tr>
					<td width="50%" valign="top">   11. Category of Enterprise based on pollution :   </td>
					<td>'.strtoupper($c_o_Enterprise).'</td>
			
				</tr>
				<tr>
					<td width="50%" valign="top">   12. Type of Area     </td>
					<td>'.strtoupper($t_o_area).'</td>			
				</tr>
				<tr>
					<td width="50%" valign="top">  13. Status of Land/Building/Premises :     </td>
					<td>'.strtoupper($land_status).'</td>
			
				</tr>
				<tr>
					<td width="50%" valign="top">  14 (a).Type of Land   </td>
					<td>'.strtoupper($land_type).'</td>			
				</tr>
				<tr>
					<td width="50%" valign="top">  &nbsp;&nbsp;&nbsp; (b) Dag No : </td>
					<td>'.strtoupper($dag_no).'</td>
				</tr>
				<tr>
					<td width="50%" valign="top">   &nbsp;&nbsp;&nbsp; (c) Patta No :  </td>
					<td>'.strtoupper($patta_no).'</td>
			
				</tr>
				<tr>
					<td width="50%" valign="top">  &nbsp;&nbsp;&nbsp; (d) Mouza :   </td>
					<td>'.strtoupper($mouza).'</td>
				</tr>
				<tr>
					<td width="50%" valign="top">15. Holding No of Property </td>
					<td>'.strtoupper($holding_no).'</td>
				</tr>
				<tr>
					<td width="50%" valign="top">16. Power requirement (in HP)</td>
					<td>'.strtoupper($power).'</td>
				</tr>
				
			';
						
       $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
       $printContents=$printContents.' 
	
		<tr>
			<td style="width:40%" valign="top">        Signatures and Dates:           </td>
			<td style="width:60%">
				<table class="table table-bordered table-responsive">
					<tbody>
					 <tr>
							<td style="border:none"> Signature of Applicant </td>
							<td style="border:none"><strong>:</strong></td>
							<td style="border:none">'.strtoupper($key_person).'</td>
						</tr>
						<tr>
							<td style="border:none">Date</td>
							<td style="border:none"><strong>:</strong></td>
							<td style="border:none">'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						</tr>
											
					</tbody>
				</table>
			</td>
		</tr>
	</table>';
?>