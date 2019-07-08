<?php
$dept="mines";
$form="4";
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
			$form_id=$results["form_id"];$profession=$results["profession"];$minerals=$results["minerals"];$prospect=$results["prospect"];$nature=$results["nature"];$coal=$results["coal"];$manner=$results["manner"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;$applicant_non_indian=$applicant->non_indian;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["is_grant"])){
				$is_grant=json_decode($results["is_grant"]);
				$is_grant_a=$is_grant->a;$is_grant_b=$is_grant->b;
			}else{				
				$is_grant_a="";$is_grant_b="";
			}		
			if(!empty($results["is_carried"])){
				$is_carried=json_decode($results["is_carried"]);
				$is_carried_a=$is_carried->a;$is_carried_b=$is_carried->b;
			}else{				
				$is_carried_a="";$is_carried_b="";
			}					
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}				
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_a=$licence->a;$licence_b=$licence->b;$licence_c=$licence->c;$licence_d=$licence->d;
			}else{				
				$licence_a="";$licence_b="";$licence_c="";$licence_d="";
			}					
			if(!empty($results["situation"])){
				$situation=json_decode($results["situation"]);
				$situation_a=$situation->a;$situation_b=$situation->b;$situation_c=$situation->c;$situation_d=$situation->d;$situation_e=$situation->e;$situation_f=$situation->f;$situation_g=$situation->g;$situation_h=$situation->h;
			}else{				
				$situation_a="";$situation_b="";$situation_c="";$situation_d="";$situation_e="";$situation_f="";$situation_g="";$situation_h="";
			}					
			if(!empty($results["parameters"])){
				$parameters=json_decode($results["parameters"]);
				$parameters_a=$parameters->a;$parameters_b=$parameters->b;$parameters_c=$parameters->c;$parameters_d=$parameters->d;$parameters_e=$parameters->e;
			}else{				
				$parameters_a="";$parameters_b="";$parameters_c="";$parameters_d="";$parameters_e="";
			}					
			if(!empty($results["mine"])){
				$mine=json_decode($results["mine"]);
				$mine_a=$mine->a;$mine_b=$mine->b;$mine_c=$mine->c;$mine_d=$mine->d;
			}else{				
				$mine_a="";$mine_b="";$mine_c="";$mine_d="";
			}					
			if(!empty($results["country"])){
				$country=json_decode($results["country"]);
				$country_a=$country->a;$country_b=$country->b;$country_c=$country->c;
			}else{				
				$country_a="";$country_b="";$country_c="";
			}					
			if(!empty($results["resources"])){
				$resources=json_decode($results["resources"]);
				$resources_a=$resources->a;$resources_b=$resources->b;
			}else{				
				$resources_a="";$resources_b="";
			}					
			if(!empty($results["captive"])){
				$captive=json_decode($results["captive"]);
				$captive_a=$captive->a;$captive_b=$captive->b;
			}else{				
				$captive_a="";$captive_b="";
			}					
			if(!empty($results["person"])){
				$person=json_decode($results["person"]);
				$person_a=$person->a;$person_b=$person->b;$person_c=$person->c;
			}else{				
				$person_a="";$person_b="";$person_c="";
			}					
			if(!empty($results["foreign_people"])){
				$foreign_people=json_decode($results["foreign_people"]);
				$foreign_people_a=$foreign_people->a;$foreign_people_b=$foreign_people->b;
			}else{				
				$foreign_people_a="";$foreign_people_b="";
			}					
			if(!empty($results["app_resources"])){
				$app_resources=json_decode($results["app_resources"]);
				$app_resources_a=$app_resources->a;$app_resources_b=$app_resources->b;
			}else{				
				$app_resources_a="";$app_resources_b="";
			}					
			if(!empty($results["feasibility"])){
				$feasibility=json_decode($results["feasibility"]);
				$feasibility_a=$feasibility->a;$feasibility_b=$feasibility->b;
			}else{				
				$feasibility_a="";$feasibility_b="";
			}
		$is_grant_a=($is_grant_a=="Y")?'YES':'NO';
		$licence_a=($licence_a=="Y")?'YES':'NO';
		$is_carried_a=($is_carried_a=="Y")?'YES':'NO';
		
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
		<br/>
		<table class="table table-bordered table-responsive">
		
		<tr>  				
			<td colspan="2">To<br/>Through<br/>	</td>
		</tr>		
		<tr>  				
			<td colspan="2">Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">I/We request that a mining lease under the Mineral Concession Rules. 1960 may be granted to me/us.</td>
		</tr>		
		<tr>  				
			<td colspan="2">The required particulars are given below:-</td>
		</tr>
		 				
		<tr>  				
			<td valign="top" width="50%">1. Name of the applicant :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">Full Postal Address with Pin code and contact telephone No :</td>
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
				
				<tr>
						<td>Status of the applicant:</td>
						<td>'.strtoupper($status_applicant).'</td>
				</tr>
				
				</table>
			</td>
		</tr>
		
		<tr>  				
			<td>2. Is the applicant a private individual/co-operative/firm/association/private company/ public company/public sector undertaking/joint sector undertaking or any other :</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>  				
			<td valign="top" colspan="2" >3. In case applicant is :</td>
        </tr>
		<tr>
			<td>(a) An individual, his nationality, qualifications and experience relating to mining. :</td>
			<td>'.strtoupper($applicant_nation).'</td>
		</tr>
		<tr>
			<td valign="top">(b) A company, an attested copy of the certificate of registration of the company shall be enclosed. :</td>
			<td>'.strtoupper($applicant_reg_number).'</td>
		</tr>
		<tr>
			<td valign="top">(c) Firm or Association, the nationality of all the partners of the firm or members of the association, and :</td>
			<td>'.strtoupper($applicant_firm_asso).'</td>
		</tr>
		<tr>
			<td valign="top">(d) A co-operative the nationality of non-Indian members, if any along with place of registration and a copy of the certificate of registration. :</td>
			<td>'.strtoupper($applicant_non_indian).'</td>
		</tr>
		<tr>  				
			<td valign="top" >4. Profession or nature of business of applicant :</td>
			<td>'.strtoupper($profession).'</td>
		</tr>
		<tr>  				
			<td valign="top" >5. Mineral or minerals which the applicant intends to prospect :</td>
			<td>'.strtoupper($minerals).'</td>
		</tr>
		
		<tr>  				
			<td>6. Period for which mining lease is required Date From:</td>
			<td>'.strtoupper($period_from_dt). ' To ' .strtoupper($period_to_dt).'</td>
		</tr>
		
		<tr>  				
			<td valign="top" >7. Extent of the area the applicant wants to prospect :</td>
			<td>'.strtoupper($prospect).'</td>
		</tr>
		
		<tr>
			<td valign="top" colspan="2">8. Details of the area in respect of which mining lease is required :</td>
		</tr>	
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
							<tr>
									<th width="5%">Sl. No.</th>
									<th width="10%">District</th>
									<th width="15">Taluq</th>
									<th width="15%">Village</th>
									<th width="15%">Khasra No.</th>
									<th width="10%">Plot No.</th>
									<th width="15%">Area</th>
									<th width="15%">Ownership-Occupancy</th>
							</tr>';
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_1["slno"]).'</td>
								<td>'.strtoupper($row_1["dist"]).'</td>
								<td>'.strtoupper($row_1["taluq"]).'</td>
								<td>'.strtoupper($row_1["village"]).'</td>
								<td>'.strtoupper($row_1["khasra_no"]).'</td>
								<td>'.strtoupper($row_1["plot_no"]).'</td>
								<td>'.strtoupper($row_1["area"]).'</td>
								<td>'.strtoupper($row_1["owner"]).'</td>
							</tr>';
							
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
				
		<tr>
				<td colspan="2">9. Brief description of the area with particular reference to the following :</td>
		</tr>
		<tr>
				<td>Does the applicant have surface rights over the area for which he is making an application for grant of a mining lease?</td>
				<td>'.strtoupper($is_grant_a).'&nbsp;&nbsp;'.strtoupper($is_grant_b).'</td>
		</tr>
		<tr>
				<td>10.(a) The situation of the area in respect of natural features such as streams or lakes :</td>
				<td>'.strtoupper($situation_a).' </td>
		</tr> 
		<tr>
				<td>(b) In the case of village areas, :</td>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>The name of the village :</td>
				<td>'.strtoupper($situation_b).' </td>
		</tr> 
		<tr>
				<td>The Khasra number:</td>
				<td>'.strtoupper($situation_c).' </td>
		</tr> 
		<tr>
				<td>The area in hectares of each field or part thereof applied for:</td>
				<td>'.strtoupper($situation_d).' </td>
		</tr>				
		<tr>
				<td colspan="2">(c)In case the area applied for is under forest, then the following particulars are given:</td>
		</tr>		
		<tr>
			<td>1.Forest division, Block and Range :</td>
			<td>'.strtoupper($situation_e).' </td>
		</tr> 
		<tr>
			<td>2.Legal status of the forest (namely reserved, protected, unclassified etc.):</td>
			<td>'.strtoupper($situation_f).' </td>
		</tr>
		<tr>
			<td>3.Whether it forms part of a National Park or Wild-life Sanctuary :</td>
			<td>'.strtoupper($situation_g).' </td>
		</tr>
		<tr>
			<td>4.Type and extent of vegetation in the area:</td>
			<td>'.strtoupper($situation_h).' </td>
		</tr>			
			<tr>
				<td colspan="2">11. Particulars of the area mineral-wise in each State duly supported by an affidavit for which the applicant or any person joint in interest with him.:</td>
			</tr>
				<tr><td>1. Already holds under reconnaissance permit :</td>
				<td>'.strtoupper($particulars_a).' </td>
				</tr> 
				<tr><td>2. Has already applied for but not granted : </td>
				<td>'.strtoupper($particulars_b).' </td>
				</tr> 
				<tr><td>3. being applied for simultaneously :</td>
				<td>'.strtoupper($particulars_c).' </td>
				</tr> 
				
				<tr>
					<td valign="top">12. Nature of joint interest, if any:</td>	
					<td>'.strtoupper($nature).' </td>
				</tr>  
		<tr>
				<td >13. (a) Does the applicant hold a prospecting licence over the area mentioned at (xi) above? :</td>
				<td>'.strtoupper($licence_a).',&nbsp; Number : &nbsp;'.strtoupper($licence_b).'&nbsp;, Date of grant : &nbsp;'.strtoupper($licence_c).'&nbsp;and Date of Expiry : &nbsp;'.strtoupper($licence_d).'</td>
			</tr>
		<tr>
				<td >13. (b)Has the applicant carried out the prospecting operations over the area held under prospecting licence and sent his report to the State Government, as required by rule 16 of the Mineral Concession Rules, 1960? :</td>
				<td>'.strtoupper($is_carried_a).'</td>
		</tr>	
			<tr>
				<td>If not, state reasons for not doing so:</td>
				<td>'.strtoupper($is_carried_b).'</td>
			</tr>
		<tr>
				<td colspan="2">14. Broad parameters of the mineral/ore body/bodies. :</td>
		</tr>
		<tr>
				<td>(i)Strike length, average width and dip :</td>
				<td>'.strtoupper($parameters_a).' </td>
		</tr> 
		<tr>
				<td>(ii)Wall rocks on hanging and foot wall sides : </td>
				<td>'.strtoupper($parameters_b).' </td>
		</tr> 
		<tr>
				<td>(iii)Whether area is considerably disturbed geologically or is comparatively free of geological disturbance? (Copy of geological map of the area is to be attached.) :</td>
				<td>'.strtoupper($parameters_c).' </td>
		</tr> 
		<tr>
				<td>(iv)Reserves assessed with their grade(s) (chemical analysis reports of representative samples are to be attached) :</td>
				<td>'.strtoupper($parameters_d).' </td>
		</tr>
		<tr>
				<td>Whether the area is virgin? If not, the extent to which it has already been worked, in case there are old workings, their locations are to be shown on the geological map of the area:</td>
				<td>'.strtoupper($parameters_e).' </td>
		</tr>
		<tr>  				
				<td  colspan="2">15. Broad parameters of the mine.:</td>
		</tr>
		<tr>
				<td>(a)Proposed date of commencement of the mining operations.</td>
				<td>'.strtoupper($mine_a).'</td>
			</tr>
			<tr>
				<td colspan="2">(b) Proposed rate of mineral production during the first 5 years (year-wise). (Take count from field iv):</td>
			</tr>
			<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
								<th width="10%">Sl. No.</th>
								<th width="40%">Name of mineral ls</th>
								<th width="50" colspan="5">Years</th>
							</tr>
							<tr>
								<th width="10%"></th>
								<th width="40%"></th>
								<th width="10">Y1</th>
								<th width="10%">Y2</th>
								<th width="10%">Y3</th>
								<th width="10%">Y4</th>
								<th width="10%">Y5</th>
							</tr>';
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_2["slno"]).'</td>
								<td>'.strtoupper($row_2["name"]).'</td>
									<td>'.strtoupper($row_2["y1"]).'</td>
									<td>'.strtoupper($row_2["y2"]).'</td>
									<td>'.strtoupper($row_2["y3"]).'</td>
									<td>'.strtoupper($row_2["y4"]).'</td>
									<td>'.strtoupper($row_2["y5"]).'</td>
							</tr>';
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
		<tr>
			<td colspan="2">(c) Proposed rate of production when mine is fully developed. :</td>
		</tr>	
		<tr>
			<td colspan="2">
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
								<th width="10%">Sl. No.</th>
								<th width="45%">Name of Mineral</th>
								<th width="45">Annual Return</th>												
						</tr>';
				$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				while($row_3=$part3->fetch_array()){
				$printContents=$printContents.'
							<tr>
								<td>'.strtoupper($row_3["slno"]).'</td>
								<td>'.strtoupper($row_3["name"]).'</td>
								<td>'.strtoupper($row_3["annual"]).'</td>
							</tr>';
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>	
		<tr>
				<td>(d) Anticipated life of the mine :</td>
				<td>'.strtoupper($mine_b).' </td>
		</tr> 
		<tr>
				<td>(e) Proposed method of mining : </td>
				<td>'.strtoupper($mine_c).' </td>
		</tr> 
		<tr>
				<td colspan="2">1. If underground, the method of approach to the deposit mineral/ore whether through inclines or shafts. <br/>2. If opencast, the over-burden to ore ratio and overall pit stope. </td>
		</tr> 
		<tr>
				<td>(f) Nature of the land chosen for dumping over burden/waste and tailings (that is type of land whether agricultural, grazing land, barren, saline land etc.) and whether proposed site has been shown on the mine working plan. Give also the extent of area in hectares set apart for dumping of waste and tailings :</td>
				<td>'.strtoupper($mine_d).' </td>
		</tr>
			<tr>
					<td valign="top">16. Manner in which the mineral raised is to be utilised.:</td>	
					<td>'.strtoupper($manner).' </td>
			</tr> 
			<tr>
					<td>(a) (i) If for captive use, the location of plant and industry:</td>
					<td>'.strtoupper($captive_a).' </td>
			</tr>
			<tr>
					<td>(ii) For sale for indigenous consumption:</td>
					<td>'.strtoupper($captive_b).' </td>
			</tr>
			<tr>
					<td>(b) If for exports to foreign countries indicate,</td>
			</tr>
					<tr>
						<td>(i) Names of the countries to which it is likely to be exported where the mine is being set up on 100% export oriented or tied-up basis :</td>
						<td>'.strtoupper($foreign_people_a).' </td>
					</tr>
			
				<tr>
					<td>(ii) Whether mineral will be exported in raw form or after processing. Also indicate the stage of processing, whether intermediate stage or final stage of the end-product :</td>
					<td>'.strtoupper($foreign_people_b).' </td>
				</tr>
			<tr>
					<td>(c) If it is to be used within the country, indicate</td>
			</tr>
					<tr>
						<td>(i) The industry/industries in which it would be used :</td>
						<td>'.strtoupper($country_a).' </td>
					</tr>
			
				<tr>
					<td>(ii) Whether it will be supplied in raw form or after processing (crushing/grinding/ beneficiation/ calcining) :</td>
					<td>'.strtoupper($country_b).' </td>
				</tr>
				<tr>
					<td>(iii) Whether it would need upgradation and if so, whether it is proposed to set up beneficiation plant. Also indicate the capacity of such plant and the time by which it would be set up :</td>
					<td>'.strtoupper($country_c).' </td>
				</tr>
				<tr>
					<td>(d) In case of coal, or other high bulk minerals/ores details of existing railway transport facility available and additional transport facility, if any, required:</td>
					<td>'.strtoupper($coal).' </td>
			</tr>
			<tr>
				<td>17. (i). Name of the technical person :</td>
				<td>'.strtoupper($person_a).' </td>
			</tr> 
				<tr>
					<td>(ii). Qualification:</td>
					<td>'.strtoupper($person_b).' </td>
				</tr> 
				<tr>
					<td>(iii). Experience of the Technical Personnel available for supervising the mines :</td>
					<td>'.strtoupper($person_c).' </td>
				</tr>
			<tr>
					<td >18. (i) Financial resources of the applicant :</td>
					<td>'.strtoupper($app_resources_a).' </td>
			</tr> 
				
				<tr>
					<td>(ii) Anticipated yearly financial investment during the course of mine construction and aggregate investment upto the stage of commencement of commercial production :</td>
					<td>'.strtoupper($app_resources_b).' </td>
				</tr> 
				
			<tr>
				<td>19. (a) Nature of waste water, (e.g. whether acidic). If so, expected pH value :</td>
					<td>'.strtoupper($feasibility_a).' </td>
			</tr> 
				
				<tr>
					<td>(b) The application form should be accompanied by a statement of the salient features of the scheme of mining. This should be generally on the lines of the &quot;Project at a Glance&quot; given in a mining feasibility report including features relating to the protection of environment:</td>
					<td>'.strtoupper($feasibility_b).' </td>
				</tr> ';
				
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

