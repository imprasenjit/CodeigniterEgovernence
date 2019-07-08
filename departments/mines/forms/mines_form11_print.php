<?php
$dept="mines";
$form="11";
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
    $results=$q->fetch_assoc();
			$form_id=$results["form_id"];
			$lease_with_respect=$results["lease_with_respect"];$land_measure=$results["land_measure"];$is_statutory=$results["is_statutory"];$is_statutory_details1=$results["is_statutory_details1"];$is_statutory_details2=$results["is_statutory_details2"];$applicant_profession=$results["applicant_profession"];$applicant_nature=$results["applicant_nature"];$items=$results["items"];$period_of_license=$results["period_of_license"];$area_extent=$results["area_extent"];$area_description=$results["area_description"];$proposed_area=$results["proposed_area"];
			$area_mining_lease_a=$results["area_mining_lease_a"];
			$start_mining_date=$results["start_mining_date"];$targeted_production=$results["targeted_production"];$any_particulars=$results["any_particulars"];
			
			
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_area=$details->area;$details_dist=$details->dist;$details_subdivision=$details->subdivision;$details_area2=$details->area2;
			}else{				
				$details_area="";$details_dist="";$details_subdivision="";$details_area2="";
			}
			if(!empty($results["applied_area"])){
				$applied_area=json_decode($results["applied_area"]);
				$applied_area_dt1=$applied_area->dt1;$applied_area_lease=$applied_area->lease;$applied_area_dt2=$applied_area->dt2;$applied_area_production=$applied_area->production;
			}else{				
				$applied_area_dt1="";$applied_area_lease="";$applied_area_dt2="";$applied_area_production="";
			}
			if($is_statutory=="Y") $is_statutory="YES";
			else $is_statutory="NO";	
			
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
				<td colspan="2">To,</td>
		</tr>
		<tr>
				<td colspan="2">THE SECRETARY TO THE GOVT. OF ASSAM,<br/>MINES AND MINERALS,<br/>DISPUR, GUWAHATI-6<br/>(THROUGH THE DIRECTOR, DIRECTORATE OF GEOLOGY AND MINING, ASSAM, KAHILIPARA, GUWAHATI-19.)</td>
		</tr>
		<tr>
				<td colspan="2">Sir,</td>
		</tr>
		<tr>
			<td colspan="2">I/We request for re-grant of Petroleum Exploration License / Petroleum Mining lease under the P&amp; NG Rule 1959(Amendment Rule 2003) with respect to <strong> '.strtoupper($lease_with_respect).' </strong> Area admeasuring <strong> '.strtoupper($land_measure).' </strong> Sq.Km in <strong> '.strtoupper($dist).' </strong> District Assam. </td>
											
		</tr>
		<tr>  				
			<td colspan="2">1. Name of the applicant with complete address : </td>
		</tr>
		<tr>
			<td>Name of the applicant :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>  				
			<td>Address of the applicant :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Street Name1 :</td>
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
						<td>Email Id</td>
						<td>'.strtoupper($email).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Is the applicant a private individual/private ?</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
		</tr>
		<tr>
			<td>3. If the applicant is a statutory corporation?</td>
			<td>'.strtoupper($is_statutory).'</td>
		</tr>
		<tr>  				
			<td>If so give details :?</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Name of the Act :</td>
						<td>'.strtoupper($is_statutory_details1).'</td>
				</tr>
				<tr>
						<td>Act No. under which it is constituted :</td>
						<td>'.strtoupper($is_statutory_details2).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>4. (i) Profession of the applicant :</td>
			<td>'.strtoupper($applicant_profession).'</td>
		</tr>
		<tr>
			<td>(ii) Nature of business of the applicant :</td>
			<td>'.strtoupper($applicant_nature).'</td>
		</tr>
		<tr>
			<td>5. Item or Items the applicant intends to :</td>
			<td>'.strtoupper($items).'</td>
		</tr>
		<tr>
			<td>6. Period for which the license/mining lease is required :</td>
			<td>'.strtoupper($period_of_license).'</td>
		</tr>
		<tr>
			<td>7. Extent of the area the applicant wants to mine :</td>
			<td>'.strtoupper($area_extent).'</td>
		</tr>
		<tr>  				
			<td>8. Details of the area for which mining lease is required :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>(a) Name of the area :</td>
						<td>'.strtoupper($details_area).'</td>
				</tr>
				<tr>
						<td>(b) Name of the District :</td>
						<td>'.strtoupper($details_dist).'</td>
				</tr>
				<tr>
						<td>(c) Name of the sub-division :</td>
						<td>'.strtoupper($details_subdivision).'</td>
				</tr>
				<tr>
						<td>(d) Area in square kilometers :</td>
						<td>'.strtoupper($details_area2).'</td>
				</tr>
				</table>
			</td>
		</tr>
		
		<tr>  				
			<td>9. Is the area applied for ML and as :- <br/>described at (viii) above or part thereof comes under any mining granted to the applicant earlier. If yes, :</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>(a) The date of grant of the ML :</td>
						<td>'.strtoupper($applied_area_dt1).'</td>
				</tr>
				<tr>
						<td>(b) Area of the lease :</td>
						<td>'.strtoupper($applied_area_lease).'</td>
				</tr>
				<tr>
						<td>(c) Date of execution of the ML deed :</td>
						<td>'.strtoupper($applied_area_dt2).'</td>
				</tr>
				<tr>
						<td>(d) Cumulative Production of Oil and Natural gas during the lease hold Period :</td>
						<td>'.strtoupper($applied_area_production).'</td>
				</tr>
				</table>
			</td>
		</tr>
	
		<tr>
			<td>10. A brief description of the area with particular reference to natural or other surface features such as river stream, roads, township etc. :</td>
			<td>'.strtoupper($area_description).'</td>
		</tr>
		<tr>
			<td>11. Whether or the proposed area for ML or part thereof falls within any reserve forest. If so, mention the area in sq.km that falls within R.F along with the name of R.F. :</td>
			<td>'.strtoupper($proposed_area).'</td>
		</tr>
	
		<tr>
			<td colspan="2">12. The area applied for Mining lease should be marked on the plan as detailed below. :</td>
											
		</tr>
		<tr>
			<td>a) The area should be marked on a plan drawn to the scale showing on this plan important surface &amp; natural features, District, Mining lease &amp; PEL boundaries if any, the dimensions of the lines forming the boundary of the area &amp; the bearing and the distance of all corner points from any important /prominent and fixed point or points. :</td>
			<td>'.strtoupper($area_mining_lease_a).'</td>
		</tr>
		
		
		<tr>
			<td colspan="2">b) If the area or part thereof falls within any reserve forest , this should be shown properly demarcated in the plan indicating the area in Sq.km. under R.F. Here mention the name &amp; address of the Forest Division / Divisions under whose jurisdiction the area falls :</td>
		</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td  align="center">Sl. No.</td>
					<td  align="center">Name</td>
					<td  align="center">Address</td>
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["address"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
	<tr>
			<td colspan="2">c) The map of the proposed ML the concerned revenue authority under proper seal &amp; signature Here mention the name , designation&amp; address of the concerned revenue authorities by whom the relevant map has been authenticated :</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td  align="center">Sl. No.</td>
					<td  align="center">Name</td>
					<td  align="center">Designation</td>
					<td  align="center">Address</td>
				</tr>';
				
				$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td align="center">'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name"]).'</td>
							<td>'.strtoupper($row_2["designation"]).'</td>
							<td>'.strtoupper($row_2["address"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table> 
			</td>
	</tr>
		
		<tr>
			<td>13. The probable date, month with effect from which the applicant intends to start mining operation in the area. :</td>
			<td>'.strtoupper($start_mining_date).'</td>
		</tr>
		<tr>
			<td>14. The targeted production of enclosed as Annexure-II Oil &amp; Gas production figures enclosed. Crude oil in the 1 st five years of the lease. :</td>
			<td>'.strtoupper($targeted_production).'</td>
		</tr>
		<tr>
			<td>15. Any other particulars :</td>
			<td>'.strtoupper($any_particulars).'</td>
		</tr>		
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
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

