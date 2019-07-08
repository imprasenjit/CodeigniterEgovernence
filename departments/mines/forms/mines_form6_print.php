<?php
$dept="mines";
$form="6";
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
		$land_measure=$results["land_measure"];$details_of_dag=$results["details_of_dag"];$area_location=$results["area_location"];$purpose=$results["purpose"];$total_area=$results["total_area"];$extent_area_l=$results["extent_area_l"];$extent_area_b=$results["extent_area_b"];$extent_area_d=$results["extent_area_d"];$qty_of_clay_removed=$results["qty_of_clay_removed"];$qty_of_clay_disposed=$results["qty_of_clay_disposed"];$existing_status=$results["existing_status"];$advance_royalty=$results["advance_royalty"];
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
			<td colspan="2">Dear Sir,</td>
		</tr>		
		<tr>  				
			<td colspan="2">The applicant is the owner of the land or is having the written consent of the land owner of the land measuring <strong> '.strtoupper($land_measure).' </strong>. bigha/ha<strong>  '.strtoupper($details_of_dag).'</strong> ( details of Dag, Patta numbers ) in village <strong> '.strtoupper($vill).' </strong>. Sub-division <strong>'.strtoupper($street_name1).'</strong> . District <strong> '.strtoupper($dist).' </strong> and have to remove the ordinary clay/earth for leveling the land or selling the same for commercial purpose. As a result of leveling of land or excavation, Ordinary Clay / earth excavated is to be disposed off, for which permission is solicited. </td>
		</tr>
		
			<tr>  				
				<td colspan="2">1. The details of the area for which permission is being sought, is given as under :</td>
			</tr>
		
			<tr>
				<td valign="top">(a) Location of the area </td>     
				<td>'.strtoupper($area_location).'  </td>
			</tr>
			<tr>
				<td valign="top">(b) Purpose </td>     
				<td>'.strtoupper($purpose).'  </td>
			</tr>
			<tr>
				<td valign="top">(c) Total area to be excavated/leveled </td>     
				<td>'.strtoupper($total_area).'  </td>
			</tr>
			
			<tr>  				
				<td valign="top" width="50%">(d) Extent of the area[Length, Breadth and Depth(in metres)]:</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Length :</td> 
						<td>'.strtoupper($extent_area_l).'</td>
					</tr>
					<tr>
						<td width="50%">Breadth :</td>
						<td>'.strtoupper($extent_area_b).'</td>
					</tr>
					<tr>
						<td>Depth :</td>
						<td>'.strtoupper($extent_area_d).'</td>
					</tr>
				
					</table>
				</td>
			</tr>
			<tr>  				
				<td valign="top" width="50%">(e) Quantity of the ordinary clay to be removed and disposed off :</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">To be removed :</td> 
						<td>'.strtoupper($qty_of_clay_removed).'</td>
					</tr>
					<tr>
						<td width="50%">To be Disposed off :</td>
						<td>'.strtoupper($qty_of_clay_disposed).'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">(f) Existing status of the land as compared to the general ground level of the area </td>     
				<td>'.strtoupper($existing_status).'  </td>
			</tr>
			<tr>
				<td valign="top">(g) Advance royalty</td>     
				<td>'.strtoupper($advance_royalty).'  </td>
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

