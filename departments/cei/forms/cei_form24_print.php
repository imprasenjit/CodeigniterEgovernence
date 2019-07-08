<?php
$dept="cei";
$form="24";
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
		$examination_test=$results['examination_test'];$class_of_certificate=$results['class_of_certificate'];$applicant_name=$results['applicant_name'];$place=$results['place'];$applicant_dob=$results['applicant_dob'];$citizen=$results['citizen'];$nationality=$results['nationality'];$technical_qualication=$results['technical_qualication'];$regd_no_competency=$results['regd_no_competency'];$regd_no_permit=$results['regd_no_permit'];$details_of_past=$results['details_of_past'];$centre=$results['centre'];	$language=$results['language'];$candidate_for=$results['candidate_for'];$present_addr_dist=$results['present_addr_dist'];	
		
		if(!empty($results["home_address"]))
		{
			$home_address=json_decode($results["home_address"]);
			$home_address_st1=$home_address->st1;$home_address_st2=$home_address->st2;$home_address_vt=$home_address->vt;$home_address_dist=$home_address->dist;$home_address_pin=$home_address->pin;$home_address_mob=$home_address->mob;$home_address_email=$home_address->email;
		}else{
			$home_address_name="";$home_address_st1="";$home_address_st2="";$home_address_vt="";$home_address_dist="";$home_address_pin="";$home_address_mob="";$home_address_email="";
		}
		if(!empty($results["present_addr"])){
			$present_addr=json_decode($results["present_addr"]);
			$present_addr_st1=$present_addr->st1;$present_addr_st2=$present_addr->st2;$present_addr_vt=$present_addr->vt;$present_addr_pin=$present_addr->pin;$present_addr_mob=$present_addr->mob;;$present_addr_email=$present_addr->email;
		}else{
			$present_addr_st1="";$present_addr_st2="";$present_addr_vt="";$present_addr_pin="";$present_addr_mob="";$present_addr_email="";
		}
		if(!empty($results["issue_certificate"])){
			$issue_certificate=json_decode($results["issue_certificate"]);
			$issue_certificate_regd_no=$issue_certificate->regd_no;$issue_certificate_dte=$issue_certificate->dte;
		}else{
			$issue_certificate_regd_no="";$issue_certificate_dte="";
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
				<td valign="top">1. Examination  test  for  which  the  candidate proposes to appear. </td>
				<td >'.strtoupper($examination_test).'</td>
			</tr>
			<tr>				
				<td valign="top">2. Class of certificate of competency permit for which he is a candidate.</td>
				<td>'.strtoupper($class_of_certificate).'</td>
			</tr>
			<tr>				
				<td valign="top">3. Name of applicant (in block letters)</td>
				<td>'.strtoupper($applicant_name).'</td>
			</tr>
			<tr>				
				<td valign="top">4. Place  and  date  of  birth </td>
				<td>'.strtoupper($place).'<br/>'.strtoupper($applicant_dob).'</td>
			</tr>
			<tr>
				<td valign="top">5. Home address in full</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td valign="top" >Street Name 1</td>
						<td>'.strtoupper($home_address_st1).'</td>
					</tr>
					<tr>
						<td valign="top">Street Name 2</td>
						<td>'.strtoupper($home_address_st2).'</td>
					</tr>
					<tr>
						<td valign="top">Village/Town</td>
						<td>'.strtoupper($home_address_vt).'</td>
					</tr>
					<tr>
						<td valign="top">District</td>
						<td>'.strtoupper($home_address_dist).'</td>
					</tr>
					<tr>
						<td valign="top">Pincode</td>
						<td>'.strtoupper($home_address_pin).'</td>
					</tr>
					<tr>
						<td valign="top">Mobile No</td>
						<td>'.strtoupper('+91'.$home_address_mob).'</td>
					</tr>
					<tr>
						<td valign="top">Email</td>
						<td>'.$home_address_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">6. Present address in full</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td valign="top">Street Name 1</td>
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
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">7. (a) Are you a citizen of India if so, how?</td>
				<td>'.strtoupper($citizen).'</td>
			</tr>
			<tr>
				<td valign="top">(b) Name & Nationality of your father</td>
				<td>'.strtoupper($nationality).'</td>
			</tr>
			<tr>
				<td colspan="2">8. Details of qualification (attested copies of certificates are to be enclosed and for the purpose of following columns (a) (b) (c) (d) Extra sheet may be annexed to this form if space is not found adequate)</td>
			</tr>
			<tr>
				<td valign="top">a) Academic & technical qualification </td>
				<td>'.strtoupper($technical_qualication).'</td>
			</tr>
			<tr>
				<td valign="top">b) Regd.  No.  of  certificate  of  competency  (if    any)    issued by the electrical Licensing Board Assam.</td>
				<td>'.strtoupper($regd_no_competency).'</td>
			</tr>
			<tr>
				<td valign="top">c) Regd.  No.  of  Permit  (if  any  issued  by the Electrical Licensing Board, Assam.)</td>
				<td>'.strtoupper($regd_no_permit).'</td>
			</tr>
			<tr>
				<td colspan="2">d) Regd.   No.   and   date   of  issue   of  the Certificate  of competency/permit issued by other authority, if any (state name of issuing authority)</td>
			</tr>
			<tr>
				<td valign="top"> Regd. No.</td>
				<td>'.strtoupper($issue_certificate_regd_no).'</td>
			</tr>
			<tr>
				<td valign="top"> Date</td>
				<td>'.strtoupper($issue_certificate_dte).'</td>
			</tr>
			<tr>
				<td valign="top">9. Details  of  past  and  present  service  (date  of commencement   and   termination   of   each appointment  to  be  given,  if  necessary,  extra sheet may be annexed to this form</td>
				<td>'.strtoupper($details_of_past).'</td>
			</tr>
			<tr>
				<td valign="top"> 10. Centre  of  Examination  desired  centers  are Guwahati/Jorhat/ Silchar/ Dibrugarh/ Tezpur.</td>
				<td>'.strtoupper($centre).'</td>
			</tr>
			<tr>
				<td valign="top"> 11. Language  in  which  candidate  desires  to  be examined (Assamese, Bengali or English.)</td>
				<td>'.strtoupper($language).'</td>
			</tr>
			<tr>
				<td colspan="4">I am  a  candidate  for  '.strtoupper($candidate_for).'  examination  and  test  and  the facts stated above are true to the best of my knowledge and belief. In case of any false statement I shall be liable for any action the Board may deem fit and proper.<br/><br/>
				</td>
			</tr>
			';	
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 				
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right"> <strong>'.strtoupper($applicant_name).'</strong><br/>Full Signature of Applicant</td>				
			</tr>						
		</table>';

?>

