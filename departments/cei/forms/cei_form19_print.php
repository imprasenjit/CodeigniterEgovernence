<?php 
$dept="cei";
$form="19";
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
		$is_lift_esc=$results['is_lift_esc'];$is_certificate=$results['is_certificate'];
		$certificate_date =$results['certificate_date'];
		if($certificate_date=='0000-00-00')
		{$certificate_date='';}else{$certificate_date=$certificate_date;}
		$maintance=$results['maintance'];$contract_reg_no =$results['contract_reg_no'];	
		$is_solvency=$results["is_solvency"];$details_of_staff=$results["details_of_staff"];$workshop_details=$results["workshop_details"];$testing_details=$results["testing_details"];$safety_details=$results["safety_details"];$facility_details=$results["facility_details"];$remarks=$results["remarks"];
		
		$is_certificate=($is_certificate=="Y")?'YES':'NO';
		if($is_certificate=="YES"){
			$certificate_number =$results['certificate_number'];
			$certificate_date =$results['certificate_date'];
		}else{
			$certificate_number ="N/A";
			$certificate_date ="N/A";
		}
		$is_solvency=($is_solvency=="Y")?'YES':'NO';
		if($is_lift_esc=='L'){
			$is_lift_esc="LIFT";
		}else{
			$is_lift_esc="ESCALATOR";
		}
		
    }
	$maintance=wordwrap($maintance,40,"<br/>",true);
	$details_of_staff=wordwrap($details_of_staff,40,"<br/>",true);
	$workshop_details=wordwrap($workshop_details,40,"<br/>",true);
	$testing_details=wordwrap($testing_details,40,"<br/>",true);
	$safety_details=wordwrap($safety_details,40,"<br/>",true);
	$facility_details=wordwrap($facility_details,40,"<br/>",true);
	$remarks=wordwrap($remarks,40,"<br/>",true);
	
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
  			'.$assamSarkarLogo.'
			<h4> '.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2" align="center">'.strtoupper($is_lift_esc).'</td>
			</tr>
			<tr>
				<td valign="top">1. Name of the applicant:</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td valign="top">2. Legal status (whether individual firm or company) (Registration Number, and names of partners or Directors to be given in case of firm or company, as the case may be.)</td>
				<td>Legal Status:&nbsp; '.strtoupper($Type_of_ownership).'<br/>
				Registration Number:&nbsp; '.strtoupper($ubin).'<br/>
				Names of Partners or Directors:&nbsp; '.strtoupper($owner_names).'</td>
			</tr>
			<tr>  				
				<td valign="top">3. Business Address (Details about possession) </td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>					
					<tr>
							<td>Mobile</td>
							<td>+91 - '.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
							<td>Phone Number</td>
							<td>'.strtoupper($b_landline_std).'&nbsp;-&nbsp;'.strtoupper($b_landline_no).'</td>
					</tr>
					<tr>
							<td>Email-id</td>
							<td>'.$b_email.'</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">4. Whether certificate of authorization was issued in the past in the same name. If so, give number and date of certificate of authorization. </td>
				<td>'.strtoupper($is_certificate).'</td>
			</tr>
			<tr>
				<td valign="top">(i)Certificate Number</td>
				<td>'.strtoupper($certificate_number).'</td>
			</tr>
			<tr>
				<td valign="top">(ii)Certificate Date</td>
				<td>'.strtoupper($certificate_date).'</td>
			</tr>
			<tr>
				<td valign="top">5.  Particulars relating to erection or maintenance of lifts/escalators. Details of lifts/escalators erected or maintained to be furnished. </td>
				<td>'.strtoupper($maintance).'</td>										
			</tr>
			<tr>
				<td valign="top">6. Registration number of electrical contractor’s license. </td>
				<td>'.strtoupper($contract_reg_no).'</td>
			</tr>
			<tr>
				<td valign="top">7. Whether solvency certificate is attached </td>
				<td>'.strtoupper($is_solvency).'</td>
			</tr>
			<tr>
				<td valign="top">8. Details of entire staff employed </td>
				<td>'.strtoupper($details_of_staff).'</td>
			</tr>
			<tr>
				<td valign="top">9. Details of workshop with machineries. </td>
				<td>'.strtoupper($workshop_details).'</td>
			</tr>
			<tr>
				<td valign="top">10. Details of testing instruments. </td>
				<td>'.strtoupper($testing_details).'</td>
			</tr>
			<tr>
				<td valign="top">11. Details of safety gadgets/tools. </td>
				<td>'.strtoupper($safety_details).'</td>
			</tr> 
			<tr>
				<td valign="top">12. Details of facilities of vehicles.</td>
				<td>'.strtoupper($facility_details).'</td>
			</tr>
			<tr>
				<td valign="top" style="width:50%">13. Remarks</td>
				<td>'.strtoupper($remarks).'</td>
			</tr>';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 	
			<tr>
				<td valign="top"> Date : &nbsp;<b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
				<td valign="top" align="right">Signature:&nbsp;<b>'.strtoupper($key_person).'</b><br/>
											Name:&nbsp;<b>'.strtoupper($key_person).'</b><br/>
											Designation:&nbsp;<b>'.strtoupper($status_applicant).'</b></td>
			</tr>   			
		</table>';
	//echo $printContents;exit;
?>

