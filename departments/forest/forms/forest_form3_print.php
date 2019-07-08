<?php
$dept="forest";
$form="3";
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
	

	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];$police_station=$results['police_station'];$raw_mat=$results['raw_mat'];	
		$industry=$results['industry'];$location=$results['location'];$legal_stat=$results['legal_stat'];
		$capital=$results['capital'];$capacity=$results['capacity'];$source=$results['source'];$ratio=$results['ratio'];$regular=$results['regular'];$daily=$results['daily'];
		$investment=$results['investment'];$power=$results['power'];$offense=$results['offense'];
		$other_details=$results['other_details'];$license_fee=$results['license_fee'];$wood_type=$results['wood_type'];
		if($wood_type=='A') $wood_type="Saw Mill";
		else if($wood_type=='B') $wood_type="Match Splint";
		else if($wood_type=='C') $wood_type="Katha";
		else if($wood_type=='D') $wood_type="Agarwood Oil Manufacturing";
		else if($wood_type=='E') $wood_type="Extracting unit";
		else if($wood_type=='F') $wood_type="Veneer";
		else if($wood_type=='G') $wood_type="Plywood Mill";
		else if($wood_type=='H') $wood_type="Hardboard";
		else if($wood_type=='I') $wood_type="Particle Board";
		else if($wood_type=='J') $wood_type="Match Manufacturing Unit";
		else $wood_type="Other wood based industry";
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
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
	<div style="text-align:center">
  			'.$assamSarkarLogo.'<h3>'.$form_name.'</h3>
  	</div>
	<table class="table table-bordered table-responsive">
		<tr>				
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td colspan="2">To,<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Conservator of Forests<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$b_dist.' , '.$circle.' Circle,<br/>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Through the Divisional Forest Officer, '.$b_block.' Division)<br/><br/>
					Sir,<br>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We '.strtoupper($key_person).' inhabitant (s) of '.strtoupper($from).' under '.strtoupper($police_station).' Police Station, '.strtoupper($dist).' District grant of licence for setting up of a wood-based industry as mentioned below using '.strtoupper($raw_mat).' as raw material. The particulars of the wood based industry are given herein below:
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td>1.(a) Name of the Wood-based industry :</td>
			<td>'.strtoupper($industry).'</td>
		</tr>
		<tr>
			<td valign="top">(b) Type of the Wood-based industry :</td>
			<td>'.strtoupper($wood_type).'</td>
		</tr>
		<tr>
			<td>2. Location &amp; name of the industrial estate where the wood-based industry is proposed to be established and details of area etc.</td>
			<td>'.strtoupper($location).'</td>
		</tr>
		<tr>
			<td>3. Legal status (whether ownership of Private Limited Company ) :</td>
			<td>'.strtoupper($legal_stat).'</td>
		</tr>
		<tr>
			<td>4. Whether a Limited Company/ Partnership/ Proprietorship business and the relationship of the applicant(s) with such Company or Partnership or Proprietorship business :</td>
			<td> '.strtoupper($Type_of_ownership).' , Upload later in upload section</td>
		</tr>
		<tr>
			<td>5. Capital Value:</td>
			<td>'.strtoupper($capital).'</td>
		</tr>
		<tr>
			<td>6. Rated capacity (volume of timber etc.) per year in cu.m. :</td>
			<td>'.strtoupper($capacity).'</td>
		</tr>
		<tr>
			<td>7. Expected source/ sources of raw materials :</td>
			<td>'.strtoupper($source).'</td>
		</tr>
		<tr>
			<td>8. Expected conversion ratio from raw material :</td>
			<td>'.strtoupper($ratio).'</td>
		</tr>
		<tr>
			<td colspan="2">9.Employment :</td>
		</tr>
		<tr>
			<td>(a) Strength of regular employees : </td>
			<td>'.strtoupper($regular).'</td>
		</tr>
		<tr>
			<td>(b) Strength of daily workers :</td>
			<td>'.strtoupper($daily).'</td>
		</tr>
		<tr>
			<td>10. Source of capital investment :</td>
			<td>'.strtoupper($investment).'</td>
		</tr>
		<tr>
			<td>11. Source of power :</td>
			<td>'.strtoupper($power).'</td>
		</tr>
		<tr>
			<td>12. Whether convicted or penalized in any Criminal/Forest offence case :</td>
			<td>'.strtoupper($offense).'</td>
		</tr>
		<tr>
			<td>13. Whether processing any other wood based industry in the State, if yes, details thereof. :</td>
			<td>'.strtoupper($other_details).'</td>
		</tr>
		<tr>
			<td>14. License Fees :</td>
			<td>'.strtoupper($license_fee).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
			
		<tr>			
			<td>Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>'.strtoupper($key_person).'<br/>Signature of the applicant</td>
		</tr>	
	</table>
';
?>

