<?php
$dept="mines";
$form="2";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
	
	if($q->num_rows > 0){
	$results=$q->fetch_array();
			$form_id=$results["form_id"];$profession=$results["profession"];$permit=$results["permit"];$minerals=$results["minerals"];$prospect=$results["prospect"];$is_residential=$results["is_residential"];
			$circle_name=$results["circle_name"];$forest_range=$results["forest_range"];$felling_series=$results["felling_series"];$nature_joint=$results["nature_joint"];
			$resource=$results["resource"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}	
			if(!empty($results["area"])){
				$area=json_decode($results["area"]);
				$area_a=$area->a;$area_b=$area->b;
			}else{				
				$area_a="";$area_b="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num;
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}	
		$is_residential=($is_residential=="Y")?'YES':'NO';
		
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
		<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
		<br>
		<table class="table table-bordered table-responsive">
		<tbody>	
		<tr>  				
			<td colspan="2">To<br/>Through<br/>	</td>
		</tr>		
		<tr>  				
			<td colspan="2">Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">I/We request that a reconnaissance permit under the Mineral Concession Rules, 1960 be granted to me/us.</td>
		</tr>		
		<tr>  				
			<td colspan="2">The required particulars are given below:-</td>
		</tr>
		 				
		<tr>  				
			<td valign="top" width="50%">1. Name of the applicant :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">2.  Full Postal Address with Pin code and contact telephone No :</td>
			<td>
			<table class="table table-bordered table-responsive">
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
				
				</table>
			</td>
		</tr>
		
		<tr>  				
			<td>3. Legal Entity of the Business or Constitution of Business :</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>  				
			<td valign="top" colspan="2" >4. In case applicant is  :</td></tr>
		<tr>
			<td>(a) an individual, his nationality :</td>
			<td>'.strtoupper($applicant_nation).'</td>
		</tr>
		<tr>
			<td valign="top">(b) a company, an attested copy of the certificate of registration of the company shall be enclosed :</td>
			<td>'.strtoupper($applicant_reg_number).'</td>
		</tr>
		<tr>
			<td valign="top">(c) firm or association, the nationality of all the Partners of the firm or members of the association :</td>
			<td>'.strtoupper($applicant_firm_asso).'</td>
		</tr>
		<tr>  				
			<td valign="top" >5. Profession or nature of business of applicant :</td>
			<td>'.strtoupper($profession).'</td>
		</tr>
		<tr>  				
			<td >6a. No. and date of the valid clearance certificate of payment of mining dues(copy attached) :</td>
			<td>'.strtoupper($clearance_num).' '.strtoupper($clearance_dt).'</td>
		</tr>
		
		<tr>  				
			<td valign="top" >6b. If on the date of application the applicant does not hold a prospecting licence, it should be stated whether an affidavit to this effect has been furnished to the satisfaction of the State Government. :</td>
			<td>'.strtoupper($permit).'</td>
		</tr>
		<tr>  				
			<td valign="top" >7. Mineral or minerals which the applicant intends to prospect :</td>
			<td>'.strtoupper($minerals).'</td>
		</tr>
		<tr>  				
			<td>8. Period for which the prospecting licence is required :</td>
			<td>'.strtoupper($period_from_dt). ' To ' .strtoupper($period_to_dt).'</td>
		</tr>
		<tr>  				
			<td valign="top" >9. Extent of the area the applicant wants to prospect :</td>
			<td>'.strtoupper($prospect).'</td>
		</tr>
		
		<tr>
			<td valign="top" colspan="2">10. Details of the area in respect of which prospecting licence is required :</td>
		</tr>	
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
							<th width="5%">Sl. No.</th>
							<th width="20%">District</th>
							<th width="15">Taluq</th>
							<th width="20%">Village</th>
							<th width="15%">Khasra No.</th>
							<th width="15">Plot No.</th>
							<th width="10%">Area</th>
						</tr>';
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["sl_no"]).'</td>
								<td>'.strtoupper($row_1["district"]).'</td>
								<td>'.strtoupper($row_1["taluq"]).'</td>
								<td>'.strtoupper($row_1["village"]).'</td>
								<td>'.strtoupper($row_1["khasra_no"]).'</td>
								<td>'.strtoupper($row_1["plot_no"]).'</td>
								<td>'.strtoupper($row_1["area"]).'</td>
							</tr>';
							
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
				
			<tr>
				<td>11. Does the applicant have surface rights over the area for which he requires a prospecting licence?</td>
				<td>'.strtoupper($is_residential).'</td>
		</tr>
		
				
			
			<tr>
				<td colspan="2">12. Brief description of the area with Particular reference to the following:</td>
			</tr>
			<tr>
				<td>(a) The situation of the area in respect to natural features such as streams etc :</td>
				<td>'.strtoupper($area_a).' </td>
			</tr> 
			<tr>
				<td>(b) In the case of village, areas, the name of the village : </td>
				<td>'.strtoupper($area_b).' </td>
			</tr> 
			<tr>
				<td colspan="2">(c) In the case of forest areas:</td>
			</tr>
			<tr>
				<td>The name of the working circle :</td>
				<td>'.strtoupper($circle_name).' </td>
			</tr> 
			<tr>	
				<td>The range :</td>
				<td>'.strtoupper($forest_range).' </td>
			</tr> 
			<tr>
				<td>The felling series. :</td>
				<td>'.strtoupper($felling_series).' </td>
			</tr> 
				<tr>
					<td colspan="2">13.Particulars of the areas mineral-wise within the jurisdiction of the State Government for which the applicant or any person joint in interest with him:</td>	</tr>
					
					<tr><td>(a) Already holds under prospecting licence :</td>
					<td>'.strtoupper($particulars_a).' </td>
				</tr> 
				<tr><td>(b) Has already applied for but not granted :</td>
					<td>'.strtoupper($particulars_b).' </td>
				</tr> 
				<tr><td>(c) Being applied for simultaneously :</td>
					<td>'.strtoupper($particulars_c).' </td>
				</tr> 
				
				<tr>
					<td valign="top">14. Nature of joint in interest, if any. :</td>	
					<td>'.strtoupper($nature_joint).' </td>
				</tr>    		
				
		<tr>
			<td valign="top" colspan="2">15. If the applicant intends to supervise the works, his previous experience of prospecting and mining should be explained :</td>
		</tr>	
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
												<th width="5%">Slno</th>
												<th width="25%">Name</th>
												<th width="20%">Qualification</th>
												<th width="25%">Experience</th>
						</tr>';
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_2["sl_no"]).'</td>
								<td>'.strtoupper($row_2["name"]).'</td>
								<td>'.strtoupper($row_2["qualification"]).'</td>
								<td>'.strtoupper($row_2["experience"]).'</td>
								
							</tr>';
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		

		<tr>
			<td valign="top">16. Financial resources of the applicant. :</td>	
			<td>'.strtoupper($resource).' </td>
		</tr> 
		';	
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 			
			<tr>
				<td colspan="2"><br/>&nbsp;I/We do hereby declare that the particulars furnished above are correct and am/are ready to furnish any other details, including accurate plans as may be required by you.</td>				
			</tr>	
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center">Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="center"> Designation :<strong>'.strtoupper($status_applicant).'</strong></td>				
			</tr>						
		</table>';
?>

