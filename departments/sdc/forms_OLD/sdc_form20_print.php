<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$sdc->query("select * from sdc_form20  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$sdc->query("select * from sdc_form20  where user_id='$swr_id' and uain='$uain'") or die("Error :".$sdc->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$sdc->query("select * from sdc_form20  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else{
	$q=$sdc->query("select * from sdc_form20  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$sdc->error);
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
		$form_id=$results["form_id"];$edu_qualification=$results["edu_qualification"];$incharge=$results["incharge"];$business_past=$results["business_past"];$is_engaged=$results["is_engaged"];$is_engaged_detail=$results["is_engaged_detail"];$business_present=$results["business_present"];$is_license=$results["is_license"];$lic_granted=$results["lic_granted"];$particulars_license=$results["particulars_license"];$is_warned=$results["is_warned"];$is_act1940=$results["is_act1940"];$is_act1930=$results["is_act1930"];$is_act1919=$results["is_act1919"];$is_act1948=$results["is_act1948"];$other_act=$results["other_act"];$is_imported=$results["is_imported"];$statement=$results["statement"];$is_distributor=$results["is_distributor"];$distributor=$results["distributor"];$firm_cat=$results["firm_cat"];$area_room=$results["area_room"];$classes_drug=$results["classes_drug"];$commodities=$results["commodities"];$liquor=$results["liquor"];$hours_days=$results["hours_days"];
			if(!empty($results["premises"])){
				$premises=json_decode($results["premises"]);
				$premises_sn1=$premises->sn1;$premises_sn2=$premises->sn2;$premises_vt=$premises->vt;$premises_dist=$premises->dist;$premises_pin=$premises->pin;$premises_mobile=$premises->mobile;
			}else{				
				$premises_sn1="";$premises_sn2="";$premises_vt="";$premises_dist="";$premises_pin="";$premises_mobile="";
			}
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		if($is_engaged=='Y'){$is_engaged='YES';} else $is_engaged='NO';
		if($is_license=='Y'){$is_license='YES';} else $is_license='NO';
		if($is_warned=='Y'){$is_warned='YES';} else $is_warned='NO';
		if($is_act1940=='Y'){$is_act1940='YES';} else $is_act1940='NO';
		if($is_act1930=='Y'){$is_act1930='YES';} else $is_act1930='NO';
		if($is_act1919=='Y'){$is_act1919='YES';} else $is_act1919='NO';
		if($is_act1948=='Y'){$is_act1948='YES';} else $is_act1948='NO';
		if($is_imported=='Y'){$is_imported='YES';} else $is_imported='NO';
		if($is_distributor=='Y'){$is_distributor='YES';} else $is_distributor='NO';
		if($classes_drug=='P'){
			$classes_drug='Poisons';
			}else if($classes_drug=='I')
				{$classes_drug='Injections';}
				else if($classes_drug=='O')
					{$classes_drug='Oral Vitamin Products';}
				else if($classes_drug=='HM')
					{$classes_drug='Household medicines';}
				else $classes_drug='Tincture and other spirituous preparations';
		if($firm_cat=='R'){$firm_cat='Restaurant';} 
		else if($firm_cat=='G') {$firm_cat='Grocer';}
		else if($firm_cat=='PS') {$firm_cat='Panbidi shop';}
		else if($firm_cat=='GM') {$firm_cat='General Merchant';}
		else {$firm_cat='Drug Stores';}
	$q1=$sdc->query("select * from sdc_form20_members where form_id='$form_id'");
	$results1=$q1->fetch_array();
	if($q1->num_rows<1){
		$form_id="";
		$address="";$pincode="";$contact="";
	}else{
		$form_id=$results1['form_id'];
		$address=$results1['address'];$pincode=$results1['pincode'];$contact=$results1['contact'];
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('sdc','20');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
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
		<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tbody>	
		<tr>
			<td colspan="2">1.Name of all partners or Directors, Proprietors etc. and full residential address of each :</td>
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
					$results1=$sdc->query("select * from sdc_form20_members where form_id='$form_id'") or die("Error : ".$sdc->error);
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
			<td width="50%">2.(a) What are the educational qualifications of the applicant :</td>
			<td width="50%">'.strtoupper($edu_qualification).'</td>
		</tr>	
		<tr>
			<td width="50%">(b) Persons in-charge of the premises for which license is applied for :</td>
			<td width="50%">'.strtoupper($incharge).'</td>
		</tr>
		<tr>
			<td >3. What are the business carried on by the applicant within the last three years ?:</td>
			<td >	'.strtoupper($business_past).'</td>
		</tr>
		<tr>
			<td >4. Has the applicant ever engaged himself or on behalf of any other person in selling drugs any time prior to this application? If so, the dates together with necessary documentary evidence may be supplied application? If so, the dates together with necessary documentary evidence may be supplied. :</td>
			<td >	'.strtoupper($is_engaged).' '.strtoupper($is_engaged_detail).'</td>
		</tr>
		<tr>
			<td >5. What other business is carried on by the applicant at present ? :</td>
			<td >	'.strtoupper($business_present).' </td>
		</tr>
		<tr>
			<td >6. Is the application for fresh license or renewal ? :</td>
			<td >	'.strtoupper($is_license).' </td>
		</tr>
		<tr>
			<td >7. Year in which license was first granted. :</td>
			<td >	'.strtoupper($lic_granted).' </td>
		</tr>
		<tr>
			<td >8. Particulars of licences granted. :</td>
			<td >	'.strtoupper($particulars_license).' </td>
		</tr>
		<tr>
			<td >9. Was the applicant ever warned for selling goods which are not of standard quality? :</td>
			<td >	'.strtoupper($is_warned).' </td>
		</tr>
		<tr>
			<td >10. Was the applicant or any person at present employed by him on these premises ever convicted and sentenced under :</td>
			<td >(a)  Drug Act, 1940 :	'.strtoupper($is_act1940).'<br/>
			(b)  Dangerous Act, 1930 :	'.strtoupper($is_act1930).'<br/>
			(c)  The Poisons Act, 1919 :	'.strtoupper($is_act1919).'<br/>
			(d)  The Pharmacy Act, 1948 :	'.strtoupper($is_act1948).'<br/>
			(e)  Any other Act. :	'.strtoupper($other_act).'<br/>
			</td>
		</tr>
		<tr>
			<td >11. Has the applicant ever imported Spirituous Medicinal of Toilet Preparations from other States ? If so, a statement of the names of the manufacturers,  Spirituous preparations their quantities and dates on which imported during the last year should be given in a separate sheet of paper duly signed and dated by the aplicant and/or has the applicant ever dealt in spirituous Medicinal preparations or toilet preparations manufactured by Manufacturers within this State ?  :</td>
			<td >'.strtoupper($is_imported).' '.strtoupper($statement).'</td>
		</tr>
		<tr>
			<td >12. Is the applicant an agent or distributor of any drug manufacturing concern? If so, the area of distribution and the date of  appointment should be stated with full particulars.The applicant shall inform the Licensing Authority if the agency is terminated any time during which the license is in force. :</td>
			<td >'.strtoupper($is_distributor).' '.strtoupper($distributor).'</td>
		</tr>
		<tr>
			<td >13. Is the firm of company a  :</td>
			<td >'.strtoupper($firm_cat).' </td>
		</tr>
		<tr>
			<td colspan="2">14. The applicant has in full &nbsp;'.strtoupper($area_room).'&nbsp;rooms for storage and sale of drugs. The floor area in square feet of each room must be  given with a sketch. The applicant is/is not a legal tenant or a Licensee there of. Necessary documents should be enclosed.</td>
		</tr>
		<tr >
			<td >15. The applicant does/does not stock or sell drugs at any other premises for which this applicant is applied for  or the address of the other premises are :</td>
			<td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($premises_sn1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($premises_sn2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($premises_vt).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($premises_dist).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($premises_pin).'</td>
				</tr>
				
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($premises_mobile).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>16. What classes of drugs are stocked, sold or distributed :</td>
			<td>'.strtoupper($classes_drug).'</td>
		</tr>
		<tr>
			<td>17. The applicant deals in the following class of commodities only besides drugs on these premises viz. :</td>
			<td>'.strtoupper($commodities).'</td>
		</tr>
		<tr>
			<td>18. The applicant was/was not dealing in Spirits/Wine/ Country Liquor prior to the introduction of the : </td>
			<td>'.strtoupper($liquor).'</td>
		</tr>
		<tr>
			<td>19. Hours of business and working days :  </td>
			<td>'.strtoupper($hours_days ).'</td>
		</tr>
		<tr>
			<td>20. Name of the trade or professional Association of which the applicant is a member and the date of commencement of memberships : </td>
			<td>Name:'.strtoupper($unit_name ).'<br/>Date of commencement :  '.strtoupper($date_of_commencement ).'</td>
		</tr>
		<tr >
			<td colspan="2">&emsp;I certify that the above information are true and I understand that my applicaton  is liable to be rejected summarily or the license liable to be cancelled forthwith if the above information is proved to be false in any particular.</td>
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
				<td align="center"> Signature of the Applicant: :<strong>'.strtoupper($key_person).'</td>
			</tr>						
		</table>';

?>
