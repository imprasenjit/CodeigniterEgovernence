<?php
$dept="deedu";
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
	

	if($q->num_rows > 0){
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$inst_location=$results["inst_location"];$measure_land=$results["measure_land"];$land_status=$results["land_status"];$instutition_names=$results["instutition_names"];$proposed_scheme=$results["proposed_scheme"];$capacity=$results["capacity"];$academic=$results["academic"];$time_frame=$results["time_frame"];$ins_name=$results["ins_name"];	$fee_structure=$results["fee_structure"];$finan_status=$results["finan_status"];$project_cost=$results["project_cost"];$funds=$results["funds"];$is_residential=$results["is_residential"];	$is_registration=$results["is_registration"];	
		$education_stage=$results["education_stage"];
		$education_stage_array=Array();
		$education_stage_array=explode(",",$education_stage);
		$education_stage="";
		if(in_array("P",$education_stage_array)) $education_stage.="Primary<br/>";
		if(in_array("M",$education_stage_array)) $education_stage.="Middle<br/>";
		if(in_array("S",$education_stage_array)) $education_stage.="Secondary<br/>";
		if(in_array("H",$education_stage_array)) $education_stage.="Higher Secondary";
		
		
		if(!empty($results["is_nonResidential"])){
			$is_nonResidential=json_decode($results["is_nonResidential"]);
			$is_nonResidential_a=$is_nonResidential->a;$is_nonResidential_b=$is_nonResidential->b;
		}else{				
			$is_nonResidential_a="";$is_nonResidential_b="";
		}				
		if(!empty($results["semi_residential"])){
			$semi_residential=json_decode($results["semi_residential"]);
			if(isset($semi_residential->a)) $semi_residential_a=$semi_residential->a; else $semi_residential_a="";
			if(isset($semi_residential->b)) $semi_residential_b=$semi_residential->b; else $semi_residential_b="";
		}else{				
			$semi_residential_a="";$semi_residential_b="";
		}	
		if($is_registration=='Y'){$is_registration='Yes';} else {$is_registration='No';} 
		if($is_nonResidential_a=='Y'){$is_nonResidential_a='Yes';} else {$is_nonResidential_a='No';} 
		if($is_residential=='Y'){$is_residential='Yes';} else {$is_residential='No';} 
		if($inst_location=='R'){$inst_location='Rural';} 
		else if($inst_location=='SU') {$inst_location='Semi Urban';}
		else {$inst_location='Urban';}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>FORM '.$form.'</title>
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
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>			
		<tr>  				
			<td>1.  Name of the Organization/ Individual/Group of individuals/ Society/ Trust :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td>2.  Full Postal Address with Pin code and contact telephone No :</td>
			<td>
			<table class="table table-bordered table-responsive">
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
			<td colspan="2">3.Name of Members of the organization	with postal address and contact with postal address and contact the telephone No.:</td>
		</tr>	
<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
						<tr>
							<td>Sl No.</td>
							<td>Name</td>
							<td>Address</td>
							<td>Pincode</td>
							<td>Contact No</td>
						</tr>';
						$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$deedu->error);
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
					<td > 4. Whether registered under the Registration  of  Societies  Act 1860. (Copies of audited accounts	for last 3 years are to be enclosed) If yes?  Please enclose  a   copy  of  the  Registration Certificate.  :          </td>
					<td>'.strtoupper($is_registration).'  </td>
				</tr>
				
				<tr>
					<td > 5. Proposed name of the Education Institution to be established : </td>
					<td>'.strtoupper($ins_name).' </td>
				</tr>
				<tr>
					<td>  6. Stage(s) of Education  proposed to be imparted? :         </td>
					<td>'.strtoupper($education_stage).'  </td>
				</tr>
				<tr>
					<td> 7. Location of the proposed institution :           </td>
					<td>'.strtoupper($inst_location).'    </td>
				</tr>
				<tr>
					<td> 8. Names of same category of institutions of the  neighbouring  area  of  the  proposed institution  within  a radius of 1 km  in case of Primary, 3 km in case of Middle, 5 km in case of Secondary and 10 km in case of  Higher  Secondary  level ofinstitutions (including all govt. prov. and non govt. institutions) :           </td>
					<td >'.strtoupper($instutition_names).'</td>
				</tr>
				<tr>
					<td> 9. Measurement of the land in possession :    </td>
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
					<td>'.strtoupper($semi_residential_a).' '.strtoupper($semi_residential_b).'</td>
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
				</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'  
					
			<tr>
				<td colspan="2"><br/>Certified that the above mentioned information are true to the best of my knowledge and belief and in case of detection of any wrong information, the undersigned shall be held responsible.</td>				
			</tr>			
			<tr>
				<td colspan="2">Further,I/We do hereby solemnly affirm that the construction works will be completed within the period as specified and in case of failure to do so, the authority shall be at liberty to cancel the prior permission and I/We shall have no right to establish and run the proposed institution.<br/><br/></td>				
			</tr>
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> <strong>'.strtoupper($key_person).'</strong><br/>Signature of Authorized Signatory</td>				
			</tr>						
		</table>';
?>

