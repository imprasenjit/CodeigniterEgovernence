<?php	
$dept="cei";
$form="1";
$table_name=getTableName($dept,$form);
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;		
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	}
	
	
	if($q->num_rows>0){	 
	$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$applicant_dob=$results['applicant_dob'];$general_edu=$results['general_edu'];$total_period=$results['total_period'];$apprentice_period=$results['apprentice_period'];	
		
		if(!empty($results["father"])){
			$father=json_decode($results["father"]);
			$father_name=$father->name;$father_st1=$father->st1;;$father_st2=$father->st2;$father_vt=$father->vt;$father_dist=$father->dist;$father_pin=$father->pin;$father_mob=$father->mob;;$father_email=$father->email;
		}else{
			$father_name="";$father_st1="";$father_st2="";$father_vt="";$father_dist="";$father_pin="";$father_mob="";$father_email="";
		}	
		if(!empty($results["present_addr"])){
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_dist=$present_addr->dist;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_name="";$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_dist="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}	
		
		$form_name=$formFunctions->get_formName($dept,$form);
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	}	
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
				<td>1. Name of the Applicant </td>
				<td >'.strtoupper($key_person).'</td>
			</tr>
			<tr>				
				<td>2. Date of Birth<br/>(as per School Certificate) </td>
				<td>'.strtoupper($applicant_dob).'</td>
			</tr>
			<tr>
				<td>3. Father’s Name & Address </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>Father Name</td>
						<td>'.strtoupper($father_name).'</td>
					</tr>
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($father_st1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($father_st2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($father_vt).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($father_dist).'</td>
					</tr>
					<tr>
						<td valign="top">Pincode</td>
						<td>'.strtoupper($father_pin).'</td>
					</tr>
					<tr>
						<td>Mobile No</td>
						<td>'.strtoupper('+91'.$father_mob).'</td>
					</tr>
					<tr>
						<td valign="top">Email</td>
						<td>'.$father_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">4. Present Address of Applicant </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($present_addr_st1).'</td>
					</tr>
					<tr>
						<td valign="top">Street Name 2</td>
						<td>'.strtoupper($present_addr_st2).'</td>
					</tr>
					<tr>
						<td valign="top">Village/Town</td>
						<td>'.strtoupper($present_addr_vt).'</td>
					</tr>
					<tr>
						<td valign="top">District</td>
						<td>'.strtoupper($present_addr_dist).'</td>
					</tr>
					<tr>
						<td valign="top">Pincode</td>
						<td>'.strtoupper($present_addr_pin).'</td>
					</tr>
					<tr>
						<td valign="top">Mobile No</td>
						<td>'.strtoupper('+91'.$present_addr_mob).'</td>
					</tr>
					<tr>
						<td valign="top">Email</td>
						<td>'.$present_addr_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">5. Permanent Address of Applicant </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td valign="top">Street Name 1</td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td valign="top">Street Name 2</td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td valign="top">Village/Town</td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td valign="top">District</td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td valign="top">Pincode</td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td valign="top">Phone No</td>
						<td>'.strtoupper($landline_std." - ".$landline_no).'</td>
					</tr>
					<tr>
						<td valign="top">Mobile No</td>
						<td>'.strtoupper('+91'.$mobile_no).'</td>
					</tr>
					<tr>
						<td valign="top">Email</td>
						<td>'.$email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">6. General educational qualification </td>
				<td>'.strtoupper($general_edu).'</td>
			</tr>
			<tr>
				<td valign="top">7. Total period of experience </td>
				<td>'.strtoupper($total_period).'</td>
			</tr>
			<tr>
				<td valign="top">8. Period served as apprentice </td>
				<td>'.strtoupper($apprentice_period).'</td>
			</tr>
			';			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 		
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right"> <strong>'.strtoupper($key_person).'</strong><br/>Full Signature of Applicant</td>				
			</tr>						
		</table>';

?>

