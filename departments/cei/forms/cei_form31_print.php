<?php
$dept="cei";
$form="31";
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
	$exam_name=$results["exam_name"];$certificate_class=$results["certificate_class"];$applicant_name=$results["applicant_name"];$birth_place=$results["birth_place"];$birth_date=$results["birth_date"];$is_citizen=$results["is_citizen"];$is_citizen_details=$results["is_citizen_details"];$father_name=$results["father_name"];$father_nationality=$results["father_nationality"];$centre=$results["centre"];$language=$results["language"];$test_name=$results["test_name"];$challan=$results["challan"];$challan_date=$results["challan_date"];$amount=$results["amount"];$rupees=$results["rupees"];$treasury=$results["treasury"];
		
	if(!empty($results["home"])){
		$home=json_decode($results["home"]);
		$home_sn1=$home->sn1;$home_sn2=$home->sn2;$home_vill=$home->vill;$home_dist=$home->dist;$home_pincode=$home->pincode;$home_mobile=$home->mobile;
	}else{				
		$home_sn1="";$home_sn2="";$home_vill="";$home_dist="";$home_pincode="";$home_mobile="";
	}	
	
	if(!empty($results["present"])){
		$present=json_decode($results["present"]);
		$present_sn1=$present->sn1;$present_sn2=$present->sn2;$present_vill=$present->vill;$present_dist=$present->dist;$present_pincode=$present->pincode;$present_mobile=$present->mobile;
	}else{				
		$present_sn1="";$present_sn2="";$present_vill="";$present_dist="";$present_pincode="";$present_mobile="";
	}

	if(!empty($results["details"])){
		$details=json_decode($results["details"]);
		$details_tech=$details->tech; $details_cert=$details->cert;$details_permit=$details->permit;$details_reg_no=$details->reg_no;$details_date=$details->date;$details_issue=$details->issue;
	}else{				
		$details_tech="";$details_cert="";$details_permit="";$details_reg_no="";$details_date="";$details_issue="";
	}	
	
	if(!empty($results["service"])){
		$service=json_decode($results["service"]);
		$service_commence=$service->commence;$service_terminate=$service->terminate;
	}else{				
		$service_commence="";$service_terminate="";
	}
	
	if($is_citizen=="Y") $is_citizen="Yes";
	else $is_citizen="No";
	
	if($centre=="G") $centre="Guwahati";
	else if($centre=="J") $centre="Jorhat";
	else if($centre=="S") $centre="Silchar";
	else if($centre=="D") $centre="Dibrugarh";
	else if($centre=="T") $centre="Tezpur";
	
	if($language=="A") $language="Assamese";
	else if($language=="B") $language="Bengali";
	else if($language=="E") $language="English";
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
	<tr>  				
		<td width="50%">1. Examination  test  for  which  the  candidate proposes to appear : </td>
		<td>'.strtoupper($exam_name).'</td>
	</tr>
	<tr>  				
		<td>2. Class of certificate of competency permit for which he is a candidate : </td>
		<td>'.strtoupper($certificate_class). '</td>
	</tr> 
	<tr>  				
		<td>3. Name of applicant (in block letters) : </td>
		<td>'.strtoupper($applicant_name). '</td>
	</tr>
	<tr>  				
		<td>4.(a) Place of birth : </td>
		<td>'.strtoupper($birth_place). '</td>
	</tr>
	<tr>  				
		<td>(b) Date of birth (certificate  showing age shall be attached) : </td>
		<td>'.strtoupper($birth_date). '</td>
	</tr>
	<tr>
		<td colspan="2">5. Home Address (in full) :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($home_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($home_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($home_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($home_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($home_pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($home_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">6. Present Address (in full) :</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($present_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($present_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($present_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($present_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($present_pincode).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($present_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>7. (a) Are you a citizen of India if so, how? </td>
		<td>'.strtoupper($is_citizen).'. &nbsp;&nbsp;&nbsp; '.strtoupper($is_citizen_details).'</td>
	</tr>
	<tr>  				
		<td>(b) Name and nationality of your father : </td>
		<td><b>Name : </b>'.strtoupper($father_name).'<br/><b>Nationality : </b>'.strtoupper($father_nationality). '</td>
	</tr>
	<tr>
		<td colspan="2">8. Details of qualification (attested copies of certificates are to be enclosed and for the purpose of following columns (a) (b) (c) (d) Extra sheet may be annexed to this form if space is not found adequate) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Academic & technical qualification </td>
				<td>'.strtoupper($details_tech).'</td>
			</tr>
			<tr>
				<td>(b) Regd. No. of certificate of competency (if any) issued by the electrical Licensing Board Assam</td>
				<td>'.strtoupper($details_cert).'</td>
			</tr>
			<tr>
				<td>(c) Regd. No. of Permit (if any issued by the Electrical Licensing Board, Assam </td>
				<td>'.strtoupper($details_permit).'</td>
			</tr>
			<tr>
				<td>(d) Regd. No. and date of issue of the Certificate of competency/permit issued by other authority, if any (state name of issuing authority)</td>
				<td><b>Registration No. : </b>'.strtoupper($details_reg_no).'<br/><b>Date of Issue : </b>'.strtoupper($details_date).'<br/><b>Name of issuing authority : </b>'.strtoupper($details_issue). '</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">9. Details of past and present service (date of commencement and termination of each appointment to be given, if necessary, extra sheet may be annexed to this form : </td>
	</tr>
	<tr>
		<td colspan="2">		
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th colspan="3" align="left">PAST SERVICE : </th>					
				</tr>
				<tr>
					<th width="20%">Sl. No.</th>
					<th width="40%">Date of Commencement</th>
					<th width="40%">Date of Termination</th>							
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				$sl=1;
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_1["commencement"]).'</td>
						<td>'.strtoupper($row_1["termination"]).'</td>
					</tr>';
					$sl++;
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="4"><strong>PRESENT SERVICE : </strong></td>
			</tr>
			<tr>
				<td width="25%">Date of Commencement : </td>
				<td width="25%">'.strtoupper($service_commence).'</td>
				<td width="25%">Date of Termination : </td>
				<td width="25%">'.strtoupper($service_terminate).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>10. Centre of Examination : </td>
		<td>'.strtoupper($centre). '</td>
	</tr>
	<tr>  				
		<td>11. Language  in  which  candidate  desires  to  be examined</td>
		<td>'.strtoupper($language). '</td>
	</tr>
	<tr>
		<td colspan="2"><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; I am  a  candidate  for &nbsp;'.strtoupper($test_name).'&nbsp;  examination  and  test  and  the facts stated above are true to the best of my knowledge and belief. In case of any false statement I shall be liable for any action the Board may deem fit and proper. <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A treasury challan No. &nbsp;'.strtoupper($challan).'&nbsp; dated &nbsp;'.strtoupper($challan_date).'&nbsp; for Rs. &nbsp;'.strtoupper($amount).'&nbsp; (Rupees &nbsp;'.strtoupper($rupees).'&nbsp;)  only   deposited   to   the   bank   through  &nbsp;'.strtoupper($treasury).'&nbsp; Treasury is enclosed herewith.</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left">Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of applicant : <strong>'.strtoupper($applicant_name).'</strong></td>							
	</tr>
</table>';
?>