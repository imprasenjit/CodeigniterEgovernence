<?php
$dept="gmc";
$form="18";
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

 


if($q->num_rows > 0){
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$from_year=$results["from_year"];$to_year=$results["to_year"];$family_name=$results["family_name"];$premises=$results["premises"];$godown=$results["godown"];$old_trade=$results["old_trade"];$annual_income=$results["annual_income"];$it_payable=$results["it_payable"];$license_type=$results["license_type"];
	if(!empty($results["premises_details"])){
		$premises_details=json_decode($results["premises_details"]);
		$premises_details_a=$premises_details->a;$premises_details_b=$premises_details->b;$premises_details_c=$premises_details->c;$premises_details_d=$premises_details->d;$premises_details_e=$premises_details->e;
	}else{
		$premises_details_a="";$premises_details_b="";$premises_details_c="";$premises_details_d="";$premises_details_e="";
	}
	if(!empty($results["old_trade_details"])){
		$old_trade_details=json_decode($results["old_trade_details"]);
		$old_trade_details_a=$old_trade_details->a;$old_trade_details_b=$old_trade_details->b;$old_trade_details_c=$old_trade_details->c;
	}else{
		$old_trade_details_a="";$old_trade_details_b="";$old_trade_details_c="";
	}		
	if(!empty($results["godown_details"])){
		$godown_details=json_decode($results["godown_details"]);
		$godown_details_b=$godown_details->b;$godown_details_c=$godown_details->c;
	}else{
		$godown_details_b="";$godown_details_c="";
	}	
	$dob=$results["dob"];$owner_age=$results["owner_age"];
	
	if($results["license_type"]=="G"){
		$license_type="REGURAL (1 YEAR)";
	}else{
		$license_type="PROVISIONAL (1 YEAR)";
	}	
	if($results["old_trade"]=="Y"){
		$old_trade_result="YES";
	}else{
		$old_trade_result="NO";
	}
	if($godown_details_c=="Y"){
		$godown_details_c="YES";
	}else{
		$godown_details_c="NO";
	}
	if($results["premises"]=="R"){
		$premises_result="RENTED";
	}else{
		$premises_result="OWN";
	}
	if($results["godown"]=="Y"){
		$godown_result="YES";
	}else{
		$godown_result="NO";
	}
}

$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);

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
<h2 align="center">'.$assamSarkarLogo.'<br/>Application for issue of Trade License (General)</h2>
<br/>
<table class="table table-bordered table-responsive">
	<tr>
		<td valign="center" colspan="2" style="padding-right:10px" width="100%" align="right" ><b>For The Year : '.strtoupper($results["from_year"]).' to '.strtoupper($results["to_year"]).'</b></td>		
	</tr>				
	<tr>
		<td colspan="2" height="45px" align="center"><b>I. DETAILS OF THE TRADE/OWNER </b></td>
	</tr>
	<tr>
		<td width="35%">(a) Applicant&apos;s Name </td>
		<td width="50%">'.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td width="35%">(b) Applicant&apos;s PAN CARD Number </td>
		<td width="50%">'.strtoupper($pan_no).'</td>
	</tr>	
	<tr>
		<td>Name of trade / shop </td>
		<td>'.strtoupper($trade_name).'</td>
	</tr>	
	<tr>
		<td>Owner&rsquo;s Type </td>
		<td>'.strtoupper($owner_type_name).'</td>
	</tr>	
	<tr>
		<td>Owner&rsquo;s Name </td>
		<td>'.strtoupper($owner_names).'</td>
	</tr>
	<tr>
		<td>Father&rsquo;s / Spouse&rsquo;s name </td>
		<td>'.strtoupper($results["family_name"]).'</td>
	</tr>
	<tr>
		<td>GMC Zone/ Ward No. </td>
		<td>'.strtoupper($gmc_zone).'-('.strtoupper($gmc_zone_name).')</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%"> (a) Owner&rsquo;s Date of Birth :</td><td width="25%">'.strtoupper($results["dob"]).'</td><td width="25%">(b) Owner&rsquo;s Age :</td><td width="25%">'.strtoupper($results["owner_age"]).'</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td>Address of the Trade </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tbody>
					<tr>
						<td width="30%">Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>					   
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Town/Vill </td>						
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>						
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Block/Ward No. </td>						
						<td>'.strtoupper($gmc_zone).'</td>
					</tr>
					<tr>
						<td>Pin Code </td>						
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td>  Address of the Owner : </td>
		<td>
			<table class="table table-bordered table-responsive">
				<tbody>
					<tr>
						<td width="30%">Street name 1 </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>					   
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Town/Vill </td>						
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>						
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>State </td>						
						<td>'.strtoupper($block).'</td>
					</tr>
					<tr>
						<td>Pin Code </td>						
						<td>'.strtoupper($pincode).'</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="25%">(a) Phone No. </td><td width="25%">'.strtoupper($landline_std).'-'.strtoupper($landline_no).'</td>
					<td width="25%">(b) Mobile No. </td><td width="25%">+91 '.strtoupper($mobile_no).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="45px" align="center"><b>II. TYPES OF PREMISES </b></td>
	</tr>
	<tr>
		<td>Type of premises </td>
		<td>'.strtoupper($premises_result).'</td>
	</tr>
	';
	if($results["premises"]=='R'){
		$printContents=$printContents.'
		<tr>
			<td width="35%">GMC Holding No. </td>
			<td width="50%">'.strtoupper($premises_details_a).'</td>
		</tr>
		<tr>
			<td>Owner&rsquo;s Name </td>
			<td>'.strtoupper($premises_details_b).'</td>
		</tr>
		<tr>
			<td>(a) Rent Per Month </td>
			<td>'.strtoupper($premises_details_c).'</td>
		</tr>
		<tr>
			<td>(b) Does premises have parking space ? </td>
			<td>'.strtoupper($premises_details_d).'</td>
		</tr>
		<tr>
			<td>Owner&rsquo;s Address </td>
			<td>'.strtoupper($premises_details_e).'</td>
		</tr>';
	}
	else{
		$printContents=$printContents.'	
		<tr>
			<td width="35%">GMC Holding No. </td>
			<td width="50%">'.strtoupper($premises_details_a).'</td>		
		</tr>			
		<tr>
			<td>Owner&rsquo;s Name </td>
			<td>'.strtoupper($premises_details_b).'</td>
		</tr>			
		<tr>
			<td>(a) Rent Per Month / value </td>
			<td>'.strtoupper($premises_details_c).'</td>
		</tr>
		<tr>
			<td>(b) Does premises have parking space ? </td>
			<td>'.strtoupper($premises_details_d).' </td>
		</tr>			
		<tr>
			<td>Owner&rsquo;s Residence Address </td>
			<td>'.strtoupper($premises_details_e).'</td>
		</tr>';
	}			
	$printContents=$printContents.'	
	<tr>
		<td colspan="2" height="45px" align="center"><b>III. GODOWN EXISTS </b></td>
	</tr>
	<tr>
		<td>Does Godown Exist in the same premises ? </td>
		<td>'.strtoupper($godown_result).'</td>
	</tr>
	';
	if($results["godown"]=="Y"){
		$printContents=$printContents.'
		<tr>
			<td>Godown Address </td>
			<td>Same Premises </td>
		</tr>		
		<tr>
			<td>(a) Rent Per Annum </td>
			<td>'.strtoupper($godown_details_b).'</td>
		</tr>
		<tr>
			<td>(b) Does godown have parking space ? </td>
			<td>'.strtoupper($godown_details_c).'</td>
		</tr>';
	}
	$printContents=$printContents.'
	<tr>
		<td colspan="2" height="45px" align="center"><b>IV. OLD TRADE LICENSE DETAILS </b></td>
	</tr>
	<tr>
		<td>Do you have existing Trade License ? </td>
		<td>'.strtoupper($old_trade_result).'</td>
	</tr>';
	if($results["old_trade"]=="Y"){
		$printContents=$printContents.'
		<tr>
			<td>License Number </td>
			<td>'.strtoupper($old_trade_details_a).'</td>
		</tr>		
		<tr>
			<td>Date of Issue (Most recent)</td>
			<td>'.strtoupper($old_trade_details_b).'</td>
		</tr>
		<tr>
			<td>1st License Issue Date</td>
			<td>'.strtoupper($old_trade_details_c).'  </td>
		</tr>';
	}
	$printContents=$printContents.'
	<tr>
		<td colspan="2" height="45px" align="center"><b>V. OTHER DETAILS </b></td>
	</tr>
	<tr>
		<td>Type of Business</td>
		<td>'.strtoupper($business_type).'</td>
	</tr>
	
	<tr>
		<td>Capital Investment</td>
		<td>'.strtoupper($cap_investment).'</td>
	</tr>
	<tr>
		<td>Annual Income for the previous<br/>financial year (in Rupees) </td>
		<td>'.strtoupper($results["annual_income"]).'</td>
	</tr>
	<tr>
		<td>  Income Tax Payable / Paid for <br/>the previous financial year (in Rupees) : </td>
		<td>'.strtoupper($results["it_payable"]).'</td>
	</tr>
	<tr>
		<td>  License:(Regural /Provisional (1 Year)) </td>
		<td>'.strtoupper($license_type).'</td>
	</tr>
	';
   
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
	<tr>
		<td style="width:40%">Signatures and Dates : </td>
		<td style="width:60%">
			<table class="table table-bordered table-responsive">
				<tbody>
					<tr>
						<td style="border:none"> Signature of Applicant </td>
						<td style="border:none"><strong>:</strong></td>
						<td style="border:none">'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td style="border:none">Date</td>
						<td style="border:none"><strong>:</strong></td>
						<td style="border:none">'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					</tr>										
				</tbody>
			</table>
		</td>
	</tr>
</table>';
?>