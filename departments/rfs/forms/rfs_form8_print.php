<?php 
$dept="rfs";
$form="8";
$table_name=$formFunctions->getTableName($dept,$form);

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
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];
		if(!empty($results['society'])){
			$society=json_decode($results['society']);
			$society_mouza=$society->mouza;$society_circle=$society->circle;$society_patta_no=$society->patta_no;$society_dag_no=$society->dag_no;$society_area=$society->area;$society_locality=$society->locality;$society_vill=$society->vill;$society_post_office=$society->post_office;$society_police_station=$society->police_station;$society_dist=$society->dist;$society_pincode=$society->pincode;
		}else{
			$society_mouza="";$society_circle="";$society_patta_no="";$society_dag_no="";$society_area="";$society_post_office="";$society_police_station="";$society_locality="";$society_vill="";$society_po="";$society_ps="";$society_dist="";$society_pincode="";
		}	
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">		
			<tr>				
				<td width="50%">1. Name of the Society</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td>2. Registration No </td>
				<td>'.strtoupper($ubin).'</td>
			</tr>
			<tr>
				<td>3. Date of Registration :</td>
				<td>'.date("d-m-Y",strtotime($date_of_registration)).'</td>
			</tr>
			<tr>
				<td>4. Date of Establishment :</td>
				<td>'.date("d-m-Y",strtotime($date_of_commencement)).'</td>
			</tr>
			<tr>
				<td valign="center">5. Address of the Society </td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Mouza</td>
							<td>'.strtoupper($mouza).'</td>
						</tr>
						<tr>
							<td>Circle</td>
							<td>'.strtoupper($circle).'</td>
						</tr>
						<tr>
							<td>Patta no</td>
							<td>'.strtoupper($patta_no).'</td>
						</tr>
						<tr>
							<td>Dag no</td>
							<td>'.strtoupper($dag_no).'</td>
						</tr>
						<tr>
							<td>Area</td>
							<td>'.strtoupper($area).'</td>
						</tr>
						<tr>
							<td>Locality</td>
							<td>'.strtoupper($b_street_name2).'</td>
						</tr>
						<tr>
							<td>Village</td>
							<td>'.strtoupper($b_vill).'</td>
						</tr>
						<tr>
							<td>Post Office</td>
							<td>'.strtoupper($post_office).'</td>
						</tr>
						<tr>
							<td>Police Station</td>
							<td>'.strtoupper($police_station).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
						</tr>
						<tr>
							<td>Pin code </td>
							<td>'.strtoupper($b_pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No.</td>
							<td>'.strtoupper($b_mobile_no).'</td>
						</tr>
						<tr>
							<td>Email ID</td>
							<td>'.$b_email.'</td>
						</tr>
					</table>				
				</td>
			</tr>
			
			<tr>
				<td valign="top">6. Proposed Address of the Society</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Mouza</td>
							<td>'.strtoupper($society_mouza).'</td>
						</tr>
						<tr>
							<td>Circle</td>
							<td>'.strtoupper($society_circle).'</td>
						</tr>
						<tr>
							<td>Patta no</td>
							<td>'.strtoupper($society_patta_no).'</td>
						</tr>
						<tr>
							<td>Dag no</td>
							<td>'.strtoupper($society_dag_no).'</td>
						</tr>
						<tr>
							<td>Area</td>
							<td>'.strtoupper($society_area).'</td>
						</tr>
						<tr>
							<td>Locality</td>
							<td>'.strtoupper($society_locality).'</td>
						</tr>
						<tr>
							<td>Village</td>
							<td>'.strtoupper($society_vill).'</td>
						</tr>
						<tr>
							<td>Post Office</td>
							<td>'.strtoupper(	$society_post_office).'</td>
						</tr>
						<tr>
							<td>Police Station</td>
							<td>'.strtoupper($society_police_station).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($society_dist).'</td>
						</tr>
						<tr>
							<td>Pin code </td>
							<td>'.strtoupper($society_pincode).'</td>
						</tr>
					</table>
				</td>
			</tr>					
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
		
			<tr>
				<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
				<td align="right">
					<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
				</td>
			</tr>
	</table>

';
?>

  