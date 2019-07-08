<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$dsedu->query("select * from dsedu_form1  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$dsedu->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$dsedu->query("select * from dsedu_form1  where user_id='$swr_id' and uain='$uain'") or die("Error :".$dsedu->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$dsedu->query("select * from dsedu_form1  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$dsedu->error);
}else{
	$q=$dsedu->query("select * from dsedu_form1  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$dsedu->error);
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

					
		$form_id=$results["form_id"];$edu_proposed=$results["edu_proposed"];$inst_location=$results["inst_location"];$measure_land=$results["measure_land"];$land_status=$results["land_status"];$instutition_names=$results["instutition_names"];$proposed_scheme=$results["proposed_scheme"];$capacity=$results["capacity"];$academic=$results["academic"];$time_frame=$results["time_frame"];$ins_name=$results["ins_name"];	$fee_structure=$results["fee_structure"];$finan_status=$results["finan_status"];$project_cost=$results["project_cost"];$funds=$results["funds"];$is_residential=$results["is_residential"];	$is_registration=$results["is_registration"];	
			$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];
			if(!empty($results["is_nonResidential"])){
				$is_nonResidential=json_decode($results["is_nonResidential"]);
				$is_nonResidential_a=$is_nonResidential->a;$is_nonResidential_b=$is_nonResidential->b;
			}else{				
				$is_nonResidential_a="";$is_nonResidential_b="";
			}				
			if(!empty($results["semi_residential"])){
				$semi_residential=json_decode($results["semi_residential"]);
				$semi_residential_a=$semi_residential->a;$semi_residential_b=$semi_residential->b;
			}else{				
				$semi_residential_a="";$semi_residential_b="";
			}	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];
	if($is_registration=='Y'){$is_registration='Yes';} else {$is_registration='No';} 
	if($is_nonResidential_a=='Y'){$is_nonResidential_a='Yes';} else {$is_nonResidential_a='No';} 
	if($is_residential=='Y'){$is_residential='Yes';} else {$is_residential='No';} 
	if($inst_location=='R'){$inst_location='Rural';} 
	else if($inst_location=='SU') {$inst_location='Semi Urban';}
	else {$inst_location='Urban';}
	if($edu_proposed=='P'){$edu_proposed='Primary';} 
	else if($edu_proposed=='M') {$edu_proposed='Middle';}
	else if($edu_proposed=='S') {$edu_proposed='Secondary';}
	else {$edu_proposed='Higher Secondary';}
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);
		$val3=$formFunctions->get_uploadFile($file3);
		$val4=$formFunctions->get_uploadFile($file4);
		$val5=$formFunctions->get_uploadFile($file5);
		$val6=$formFunctions->get_uploadFile($file6);
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
		$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
		$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
		$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
		$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
	}
	
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('dsedu','1');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>FORM-I</title>
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
		<h4 align="center">'.$assamSarkarLogo.'<br/>FORM-I<br/>[SEE RULE 3(1)]<br/>'.$form_name.'</h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tbody>			
<tr>  				
			<td valign="top" width="50%">1.  Name of the Organization/ Individual/Group of individuals/ Society/ Trust :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td valign="top">2.  Full Postal Address with Pin code and contact telephone No :</td>
			<td>
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
			<td valign="top" colspan="2">3.Name of Members of the organization	with postal address and contact with postal address and contact the telephone No.:</td>
		</tr>	
<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
							<td width="10%">Sl No.</td>
							<td width="20%">Name</td>
							<td width="20%">Address</td>
							<td width="10%">Pincode</td>
							<td width="20%">Contact No</td>
						</tr>';
						$results1=$dsedu->query("select * from dsedu_form1_members where form_id='$form_id'") or die("Error : ".$dsedu->error);
						$sl=1;
						while($rows=$results1->fetch_object()){
							$printContents=$printContents.'
							<tr>
								<td>'.$sl.'</td>
								<td>'.strtoupper($rows->name).'</td>
								<td>'.strtoupper($rows->address).'</td>
								<td>'.strtoupper($rows->pincode).'</td>
								<td>'.strtoupper($rows->contact).'</td>
							</tr>';
							$sl++;
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
				<tr>
					<td valign="top" > 4. Whether registered under the Registration  of  Societies  Act 1860. (Copies of audited accounts	for last 3 years are to be enclosed) If yes?  Please enclose  a   copy  of  the  Registration Certificate.  :          </td>
					<td>'.strtoupper($is_registration).'  </td>
				</tr>
				
				<tr>
					<td valign="top" > 5. Proposed name of the Education Institution to be established : </td>
					<td>'.strtoupper($ins_name).' </td>
				</tr>
				<tr>
					<td valign="top">  6. Stage(s) of Education  proposed to be imparted? :         </td>
					<td>'.strtoupper($edu_proposed).'  </td>
				</tr>
				<tr>
					<td valign="top"> 7. Location of the proposed institution :           </td>
					<td>'.strtoupper($inst_location).'    </td>
				</tr>
				<tr>
					<td valign="top"> 8. Names of same category of institutions of the  neighbouring  area  of  the  proposed institution  within  a radius of 1 km  in case of Primary, 3 km in case of Middle, 5 km in case of Secondary and 10 km in case of  Higher  Secondary  level ofinstitutions (including all govt. prov. and non govt. institutions) :           </td>
					<td >'.strtoupper($instutition_names).'</td>
				</tr>
				<tr>
					<td valign="top"> 9. Measurement of the land in possession :    </td>
					<td >'.strtoupper($measure_land).'</td>
				</tr>							
				<tr>
					<td>10. Status of land (Myadi patta/ Annual patta/  Govt. allotment/  Lease) under occupation. (copies of land documentto be attached) :</td>									
					<td>'.strtoupper($land_status).'</td>
				</tr>  							
				<tr>
					<td>11. In case of lease holder, the copy of the lease document is to be attached : </td>	
					<td>Document to be attached</td>
				</tr>   							
				<tr>
					<td>12. Proposed Scheme of management for establishment  of  the  Educational institution  for  which  permission is sought for : </td>	
					<td>'.strtoupper($proposed_scheme).'</td>
				</tr>   							
				<tr>
					<td>13. What would be the intake capacity? (class-wise) : </td>	
					<td>'.strtoupper($capacity).'</td>
				</tr>   							
				<tr>
					<td>14. Whether  it  would  be  completely residential?  : </td>	
					<td>'.strtoupper($is_residential).'</td>
				</tr>    							
				<tr>
					<td>15. Whether it would be non-residential?If  yes, what  would  be  the  mode of  transport  facility  for  students? : </td>	
					<td>'.strtoupper($is_nonResidential_a).' '.strtoupper($is_nonResidential_b).'</td>
				</tr>     							
				<tr>
					<td>16. Whether it would be semi residential? If yes, what would be the hostel capacity? :</td>	
					<td>'.strtoupper($is_nonResidential_a).' '.strtoupper($is_nonResidential_b).'</td>
				</tr>     							
				<tr>
					<td>17.	Copy of the Plan and estimate of the proposed  buildings  and   other infrastructures. (Indicate the number of classroom and other infrastructures to be constructed initially). :</td>	
					<td>Document to be attached </td>
				</tr>       							
				<tr>
					<td>18.	What is the time frame for completion of the proposed construction? :</td>	
					<td>'.strtoupper($time_frame).' </td>
				</tr>      							
				<tr>
					<td>19.	From  which  academic  session, the	class(s) will  be  started? :</td>	
					<td>'.strtoupper($academic).' </td>
				</tr>      							
				<tr>
					<td>20.	What would be the project cost? (Itemwise estimate is to be attached) :</td>	
					<td>'.strtoupper($project_cost).' </td>
				</tr>     							
				<tr>
					<td>21.	Probable sources of funds :</td>	
					<td>'.strtoupper($funds).' </td>
				</tr>      							
				<tr>
					<td>22.	What would be the maximum  probable	fee structure? (Item-wise and year-wise	breakup  per  student per  class is to be furnished) :</td>	
					<td>'.strtoupper($fee_structure).' </td>
				</tr>       							
				<tr>
					<td>23.	What  is  the  present financial  status? (documents in support are to be attached) :</td>	
					<td>'.strtoupper($finan_status).' </td>
				</tr> 
			<tr>
					<td colspan="2" height="50px"><font color="red">Checklist of the Documents</font></td>
			</tr>					
			<tr>
					<td>Copy of the Memorandum of Association and Rules of the organization</td>
					<td>'.$val1.'</td>
			</tr>					
			<tr>
				  <td>Copy  of  the  Registration Certificate. (Copies of audited accounts for last 3 years are to be enclosed)</td>
				  <td>'.$val2.'</td>
			</tr>					
			<tr>
				  <td>Copy of land document</td>
				  <td>'.$val3.'</td>
			</tr>
			<tr>
				  <td>Copy of the lease document</td>
				  <td>'.$val4.'</td>
			</tr>
			<tr>
				  <td>Project cost(Item-wise estimate)</td>
				  <td>'.$val5.'</td>
			</tr>
			<tr>
				  <td>Present financial  status</td>
				  <td>'.$val6.'</td>
			</tr>';			
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
				<td colspan="2"><br/>&emsp;Certified that the above mentioned information are true to the best of my knowledge and belief and in case of detection of any wrong information, the undersigned shall be held responsible.</td>				
			</tr>			
			<tr>
				<td colspan="2">&emsp;Further, I/We do hereby solemnly affirm that the construction works will be completed within the period as specified and in case of failure to do so, the authority shall be at liberty to cancel the prior permission and I/We shall have no right to establish and run the proposed institution.<br/><br/></td>				
			</tr>
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> <strong>'.strtoupper($key_person).'</strong><br/>Signature of Authorized Signatory</td>				
			</tr>						
		</table>';

?>

