<?php
$dept="mines";
$form="8";
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
			$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$revenue_estate=$results["revenue_estate"];$permission_from=$results["permission_from"];$permission_to=$results["permission_to"];$permission_year=$results["permission_year"];
			
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
			<td colspan="2">Dear Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">Whereas Shri/Messers<strong> '.strtoupper($key_person).' </strong> Owner (s) of Brick Kiln falling in category<strong> '.strtoupper($owner_names).' </strong>has/has applied for quarrying permit for removal of the "Brick Earth" , for a period of two years from the land measuring<strong> '.strtoupper($land_measure).' </strong>bigha/acres/hectares bearing Dag, Patta numbers<strong> '.strtoupper($details_of_dag).'  </strong>in the revenue estate of<strong> '.strtoupper($revenue_estate).'  </strong>Sub-division<strong> '.strtoupper($street_name1).' , '.strtoupper($dist).' </strong>District 2012.
			</td>
		</tr>
		<tr>  				
			<td colspan="2">The permission is hereby granted for removal of brick earth and manufacture of bricks from the aforesaid area during the period from <strong> '.strtoupper($permission_from).' </strong>  to <strong> '.strtoupper($permission_to).' </strong> ( upto 31 st March, <strong> '.strtoupper($permission_year).' </strong>.) subject to the conditions given below :-                			
			
			</td>
		</tr>
		
			<tr>  				
				<td colspan="2">1. The holder of the permits shall keep the Government indemnified from third party claim relating to the extraction of brick earth from the land for which quarrying permit is given.</td>
			</tr>
			<tr>  				
				<td colspan="2">2. The holder of the permit shall excavate the brick earth in such a manner that the same shall not disturb or damage any road, public ways, buildings, premises of public grounds.</td>
			</tr>
			<tr>  				
				<td colspan="2">3. The holder of the permit shall not use the brick earth excavated from the land granted on permit for any other purpose than that of manufacturing of bricks. In case the brick earth is to be transported up to brick kiln from the site of excavation, the permit holder transports the same only by issuing a mineral Transit Pass.</td>
			</tr>
			<tr>  				
				<td colspan="2">4. That the holder of the permit shall not fell any tree standing on the land without obtaining prior permission in writing from the competent authority in the forest department. In Case Such Permission has been granted, he shall abide by the terms and conditions stipulated in such permission.</td>
			</tr>
			<tr>  				
				<td colspan="2">5. The permit holder shall not carry on surface operations in any area prohibited by any authority, without obtaining prior permission in writing from the concerned authority.</td>
			</tr>
			<tr>  				
				<td colspan="2">6. The permit holder shall not enter and work in any forest without obtaining prior written permission of the Forest Department.</td>
			</tr>
			<tr>  				
				<td colspan="2">7. The permit holder shall report immediately all accidents to the deputy commissioner and the competent authority concerned.</td>
			</tr>
			<tr>  				
				<td colspan="2">8. The depth of the pit below surface shall not exceed nine feet.</td>
			</tr>
			<tr>  				
				<td colspan="2">9. The annual amount of royalty shall be paid in advance by 1 st april of every year.</td>
			</tr>
			<tr>  				
				<td colspan="2">In Case the annual royalty is not paid on the date specified above , the permit holder shall be liable to pay interest as the following :</td>
			</tr>
			<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
						<tr>
							<th width="5%">Sl no.</th>
							<th width="30%">Periods of delay</th>
							<th width="30%">Rate of Interest applicable</th>
							
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1.</td>
							<td>If paid within a period of 7 days from the due date</td>
							<td>A grace period of up to 7 days is allowed without any interest;</td>
						</tr>
						<tr>
							<td>2.</td>
							<td>If paid after 7 days but up to 30 days of the due date</td>
							<td>15% on the amount of default for the period of default including the grace period;</td>
						</tr>
						<tr>
							<td>3.</td>
							<td>If paid after 30 days but within 60 days of due date</td>
							<td>18% on the amount of default for the period of default including the grace period</td>
						</tr>
						<tr>
							<td>4.</td>
							<td>Delay 60 days of the due date</td>
							<td>Termination of the permit and the entire outstanding amount would be recoverable along with interest calculated @21% for the entire period of default</td>
						</tr>
						
						</tbody>
				</table>
			</td>
		</tr>
		<tr>  				
			<td colspan="2">10. The brick Kiln Owner shall be liable to make payment of Lump-Sum royalty for the whole of the year notwithstanding the operation of the Kiln for any part of the year</td>
		</tr>	
		<tr>  				
			<td colspan="2">11. In case of any default in due observance of the terms and conditions of this permit or in payment of the installment on due date, the permit may be cancelled by the competent authority by giving one months notice. Any sum due from the permit holder on account of royalty and interest thereon shall be recovered from him/ them as an arrear of land Revenue.</td>
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

