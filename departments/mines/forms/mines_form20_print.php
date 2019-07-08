<?php
$dept="mines";
$form="20";
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
			$form_id=$results["form_id"];
			$nationality=$results["nationality"];$place_of_business=$results["place_of_business"];$name_of_minerals=$results["name_of_minerals"];$map_description=$results["map_description"];$is_renewal_applied=$results["is_renewal_applied"];$minerals_raised=$results["minerals_raised"];$year_wise_qty=$results["year_wise_qty"];
			
			$minerals_available=$results["minerals_available"];$details_of_explorations=$results["details_of_explorations"];
			$details_of_area=$results["details_of_area"];$details_of_site=$results["details_of_site"];$details_of_defaults=$results["details_of_defaults"];$details_of_investment=$results["details_of_investment"];$any_particulars=$results["any_particulars"];$name_of_village=$results["name_of_village"];$name_of_range=$results["name_of_range"];$schedule_patta_no=$results["schedule_patta_no"];$schedule_area=$results["schedule_area"];$schedule_desc=$results["schedule_desc"];$schedule_felling_series=$results["schedule_felling_series"];$schedule_district2=$results["schedule_district2"];
			
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}			
			if(!empty($results["utilization"])){
				$utilization=json_decode($results["utilization"]);
				$utilization_a=$utilization->a;$utilization_b=$utilization->b;$utilization_c=$utilization->c;
			}else{				
				$utilization_a="";$utilization_b="";$utilization_c="";
			}			
			if(!empty($results["statement"])){
				$statement=json_decode($results["statement"]);
				$statement_a=$statement->a;$statement_b=$statement->b;$statement_c=$statement->c;
			}else{				
				$statement_a="";$statement_b="";$statement_c="";
			}				
			if(!empty($results["period_renewal"])){
				$period_renewal=json_decode($results["period_renewal"]);
				$period_renewal_from_dt=$period_renewal->from_dt;$period_renewal_to_dt=$period_renewal->to_dt;
			}else{				
				$period_renewal_from_dt="";$period_renewal_to_dt="";
			}			
			if(!empty($results["renewal_applied"])){
				$renewal_applied=json_decode($results["renewal_applied"]);
				$renewal_applied_area=$renewal_applied->area;$renewal_applied_desc=$renewal_applied->desc;
			}else{				
				$renewal_applied_area="";$renewal_applied_desc="";
			}
			if(!empty($results["compliance"])){
				$compliance=json_decode($results["compliance"]);
				$compliance_env_clearance=$compliance->env_clearance;$compliance_mining_plan=$compliance->mining_plan;$compliance_provisions=$compliance->provisions;$compliance_conditions=$compliance->conditions;
			}else{				
				$compliance_env_clearance="";$compliance_mining_plan="";$compliance_provisions="";$compliance_conditions="";
			}	
		$is_renewal_applied=($is_renewal_applied=="Y")?'YES':'NO';
		
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
			<td valign="top" width="50%">1. Name of applicant individual/firm/company or society :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">2. Nationality of the individual or place of registration or incorporation of firm, company or society :</td>
			<td>'.strtoupper($nationality).'</td>
		</tr>
		<tr>
			<td colspan="2">3. Profession or nature of business of individual or firm or company and place of business :</td>
		</tr>
		<tr>  				
			<td>Profession or nature of business of individual or firm or company :</td>
			<td>'.strtoupper($status_applicant).'</td>
		</tr>
		<tr>  				
			<td>Place of business :</td>
			<td>'.strtoupper($place_of_business).'</td>
		</tr>
		<tr>
			<td valign="top">4. Address of the individual/ firm/ company or society :</td>
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
						<td>'.strtoupper($mobile_no).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>  				
			<td>5. Name of Minor Mineral which the applicant intends to mine :</td>
			<td>'.strtoupper($name_of_minerals).'</td>
		</tr>
		<tr>  				
			<td>6. Period for which the original lease was granted :</td>
			<td>'.strtoupper($period_from_dt). ' To ' .strtoupper($period_to_dt).'</td>
		</tr>
		<tr>
			<td valign="top">7. Manner in which the Minor Mineral(s) is to be utilized (In case of manufacture, the industries in connection with which it is required should be specified) :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">a. For manufacture :</td>
						<td>'.strtoupper($utilization_a).'</td>
				</tr>
				<tr>
						<td>b. For sale :</td>
						<td>'.strtoupper($utilization_b).'</td>
				</tr>
				<tr>
						<td>c. Any other purpose :</td>
						<td>'.strtoupper($utilization_c).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>  				
			<td>8. A description illustrated by a map or plan ( in triplicate) showing as accurate as possible the situation, boundaries and area of land in respect of which the lease is required and where the area us un-surveyed the location of the area should be shown by some permanent physical features ie, roads, tanks etc. :</td>
			<td>'.strtoupper($map_description).'</td>
		</tr>
		<tr>
			<td valign="top">9. A statement showing all the areas within jurisdiction of the Government :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">(a) Already held by me/us in my/our name/names ( and jointly with others) under quarrying leases specifying the names of minor :</td>
						<td>'.strtoupper($statement_a).'</td>
				</tr>
				<tr>
						<td>(b) Already applied for but not yet granted :</td>
						<td>'.strtoupper($statement_b).'</td>
				</tr>
				<tr>
						<td>(c) Applied for simultaneously or being applied for in the state :</td>
						<td>'.strtoupper($statement_c).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>  				
			<td>10. Period for which renewal of mining lease is required :</td>
			<td>'.strtoupper($period_renewal_from_dt). ' To ' .strtoupper($period_renewal_to_dt).'</td>
		</tr>
		<tr>  				
			<td>11. Whether renewal is applied for the whole or part of the lease held ?</td>
			<td>'.strtoupper($is_renewal_applied).'</td>
		</tr>
		<tr>
			<td valign="top">12. In case the renewal applied for is only for part if the lease held :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">(a) The area applied for renewal :</td>
						<td>'.strtoupper($renewal_applied_area).'</td>
				</tr>
				<tr>
						<td>(b) Description of the area applied for renewal :</td>
						<td>'.strtoupper($renewal_applied_desc).'</td>
				</tr>
				<tr>
						<td>(c) Map ( in triplicate) of the lease held with area applied for renewal clearly marked on it ( copy of map attached) :</td>
						<td>Uploaded in Upload Section</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>  				
			<td>13. Means by which the minor mineral is to be raised ie. by hand, labour or mechanical or electric power :</td>
			<td>'.strtoupper($minerals_raised).'</td>
		</tr>
		<tr>  				
			<td>14. Year-wise quantity of the mineral(s) excavated along with royalty paid in each year since grant if lease. (attached no due certificate of concerned Officer - In - Charge) :</td>
			<td>'.strtoupper($year_wise_qty).'</td>
		</tr>
		<tr>  				
			<td>15. Mineral reserves available :</td>
			<td>'.strtoupper($minerals_available).'</td>
		</tr>
		<tr>  				
			<td>16. Details of explorations undertaken, if any :</td>
			<td>'.strtoupper($details_of_explorations).'</td>
		</tr>
		<tr>  				
			<td>17. Details of the mined out areas restored/reclaimed/rehabilitated as per progressive mine closure plan :</td>
			<td>'.strtoupper($details_of_area).'</td>
		</tr>
		<tr>  				
			<td>18. Details of the sites of overburden restored :</td>
			<td>'.strtoupper($details_of_site).'</td>
		</tr>
		<tr>
			<td valign="top">19. Details of the compliance of :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">(i). Environmental Clearance :</td>
						<td>'.strtoupper($compliance_env_clearance).'</td>
				</tr>
				<tr>
						<td>(ii). Mining plan / scheme of mining :</td>
						<td>'.strtoupper($compliance_mining_plan).'</td>
				</tr>
				<tr>
						<td>(iii). Safety provisions as per the Mines Act, 1952 and the rules and regulations framed thereunder :</td>
						<td>'.strtoupper($compliance_provisions).'</td>
				</tr>
				<tr>
						<td>(iv). Other relevant laws and terms and conditions applicable on Mines and Minerals :</td>
						<td>'.strtoupper($compliance_conditions).'</td>
				</tr>
				
				</table>
			</td>
		</tr>
		<tr>  				
			<td>20. Details of defaults, if any, in submission of production returns, payment of royalty/dead rent and found wanting in taking adequate measures for labour safety :</td>
			<td>'.strtoupper($details_of_defaults).'</td>
		</tr>
		<tr>  				
			<td>21. Details of investment made in development of mine, plant and machinery with a long term perspective and optimal benefit of the same could not have derived during the original period of lease :</td>
			<td>'.strtoupper($details_of_investment).'</td>
		</tr>
		<tr>  				
			<td>22. Any other particulars which the applicant wishes to furnish :</td>
			<td>'.strtoupper($any_particulars).'</td>
		</tr>
		<tr>
			<td valign="top">23. Schedule giving description of the area applied for :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td width="50%">a. Name of village :</td>
						<td>'.strtoupper($name_of_village).'</td>
				</tr>
				<tr>
						<td>b. In the case of forest land, the name of the range and Division :</td>
						<td>'.strtoupper($name_of_range).'</td>
				</tr>
				<tr>
						<td>c. Dag and Patta Numbers and area of each field or part thereof :</td>
						<td>'.strtoupper($schedule_patta_no).', '.strtoupper($schedule_area).'</td>
				</tr>
				<tr>
						<td>d. Full description of the area applied for with regard to its natural features :</td>
						<td>'.strtoupper($schedule_desc).'</td>
				</tr>
				<tr>
						<td>e. Felling series and working circle, if any :</td>
						<td>'.strtoupper($schedule_felling_series).'</td>
				</tr>
				<tr>
						<td>f. District :</td>
						<td>'.strtoupper($schedule_district2).'</td>
				</tr>
				</table>
			</td>
		</tr>
		';	
			
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 			
			
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right">Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="right"> Designation :<strong>'.strtoupper($status_applicant).'</strong></td>				
			</tr>						
		</table>';
?>

