<?php
$dept="cfs";
$form="2";
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
	$form_id=$results['form_id'];
	$others_business=$results['others_business'];$others_desgn=$results['others_desgn'];$applicant_name=$results['applicant_name'];$identity_proof=$results['identity_proof'];$area=$results['area'];$start_date=$results['start_date'];$opening=$results['opening'];$closing=$results['closing'];$is_power=$results['is_power'];$is_power_details=$results['is_power_details'];$rupees=$results['rupees'];$draft=$results['draft'];$fees=$results['fees'];$supply=$results['supply'];
	
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
        if(isset($corr_add->name)) $corr_add_name=$corr_add->name; else $corr_add_name="";
        if(isset($corr_add->address)) $corr_add_address=$corr_add->address; else $corr_add_address="";
        if(isset($corr_add->mobile)) $corr_add_mobile=$corr_add->mobile; else $corr_add_mobile="";
        if(isset($corr_add->tel)) $corr_add_tel=$corr_add->tel; else $corr_add_tel="";
        if(isset($corr_add->fax)) $corr_add_fax=$corr_add->fax; else $corr_add_fax="";
        if(isset($corr_add->email)) $corr_add_email=$corr_add->email; else $corr_add_email="";
		
	}else{				
		$corr_add_name="";$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
	}
		
	if(!empty($results["business"])){
		$business=json_decode($results["business"]);
		if(isset($business->a)) $business_a=$business->a; else $business_a="";
		if(isset($business->b)) $business_b=$business->b; else $business_b="";
		if(isset($business->c)) $business_c=$business->c; else $business_c="";
		if(isset($business->d)) $business_d=$business->d; else $business_d="";
		if(isset($business->e)) $business_e=$business->e; else $business_e="";
		if(isset($business->f)) $business_f=$business->f; else $business_f="";
		if(isset($business->g)) $business_g=$business->g; else $business_g="";
		if(isset($business->h)) $business_h=$business->h; else $business_h="";
		if(isset($business->i)) $business_i=$business->i; else $business_i="";
		if(isset($business->j)) $business_j=$business->j; else $business_j="";
		if(isset($business->k)) $business_k=$business->k; else $business_k="";
	}else{
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";
	}
	// BUSINESS CHECKMARKS //
	$business_values="";		
	if($business_a=="S") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Permanent/Temporary Stall holder <br/>';
	if($business_b=="H") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Hawker (Itinerant / Mobile food vendor) <br/>';
	if($business_c=="D") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Dhaba <br/>';
	if($business_d=="P") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Petty Retailer of snacks/tea shops <br/>';
	if($business_e=="M") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Manufacturer/Processor <br/>';
	if($business_f=="FI") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Fish/meat/poultry shop/seller <br/>';
	if($business_g=="R") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Re-Packer <br/>';
	if($business_h=="F") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Food stalls/arrangements in Religious gatherings, fairs etc <br/>';
	if($business_i=="V") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Milk producers (who are not member of dairy co operative society)/ milk vendor <br/>';
	if($business_j=="HB") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Home based canteens/dabba wallas <br/>';
	if($business_k=="O") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Other(s) : ';
	
	if(!empty($results["designation"])){
		$designation=json_decode($results["designation"]);
		if(isset($designation->a)) $designation_a=$designation->a; else $designation_a="";
		if(isset($designation->b)) $designation_b=$designation->b; else $designation_b="";
		if(isset($designation->c)) $designation_c=$designation->c; else $designation_c="";
		if(isset($designation->d)) $designation_d=$designation->d; else $designation_d="";
		if(isset($designation->e)) $designation_e=$designation->e; else $designation_e="";
	}else{
		$designation_a="";$designation_b="";$designation_c="";$designation_d="";$designation_e="";
	}
	// DESIGNATION CHECKMARKS //
	$designation_values="";		
	if($designation_a=="I") $designation_values=$designation_values. '<span class="tickmark">&#10004;</span>Individual <br/>';
	if($designation_b=="P") $designation_values=$designation_values. '<span class="tickmark">&#10004;</span>Partner <br/>';
	if($designation_c=="PR") $designation_values=$designation_values. '<span class="tickmark">&#10004;</span>Proprietor <br/>';
	if($designation_d=="S") $designation_values=$designation_values. '<span class="tickmark">&#10004;</span>Secretary of dairy co-operative society <br/>';
	if($designation_e=="O") $designation_values=$designation_values. '<span class="tickmark">&#10004;</span>Other(s) : ';
	
	if($supply=="PU") $supply="Public supply";
	else if($supply=="PR") $supply="Private supply";
	else if($supply=="O") $supply="Any other source"; 
	
	if($fees=="D") $fees="Demand Draft no. payable to ";
	else if($fees=="C") $fees="Cash";
	
	if($is_power=="Y") $is_power="Yes";
	else $is_power="No";
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
		<td width="50%">1. Kind of business </td>
		<td>'. $business_values .'&nbsp;'. strtoupper($others_business) .'</td>
	</tr>
	<tr>
		<td>2. Name of the Applicant/Company </td>
		<td>'.strtoupper($applicant_name).'</td>
	</tr>
	<tr>
		<td>3. Designation </td>
		<td>'. $designation_values .'&nbsp;'. strtoupper($others_desgn) .'</td>
	</tr>
	<tr>
		<td>4. Proof of Identity of applicant </td>
		<td>'.strtoupper($identity_proof).'</td>
	</tr>
	<tr>
		<td>5. Correspondence address </td>
		<td>'.strtoupper($corr_add_address).'</td>	
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Name of contact person</td>
				<td>'.strtoupper($corr_add_name).'</td>
			</tr><tr>
				<td>(b) Mobile No. </td>
				<td>'.strtoupper($corr_add_mobile).'</td>
			</tr>
			<tr>
				<td>(c) Telephone Number </td>
				<td>'.strtoupper($corr_add_tel).'</td>
			</tr>
			<tr>
				<td>(d) Fax number </td>
				<td>'.strtoupper($corr_add_fax).'</td>
			</tr>
			<tr>
				<td>(e) Email </td>
				<td>'.strtoupper($corr_add_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>6. Area or Location where food business is to be conducted/Address of the premises </td>
		<td>'.strtoupper($area).'</td>	
	</tr>
	<tr>
		<td colspan="2">7. Description of the food items proposed to be Manufactured or sold : </td>
	</tr>	
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl No.</th>
						<th>Name of Food category/item </th>
						<th>Quantity in Kg per day or M.T. per annum </th>
					</tr>
				</thead>';
				$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
				$num = $part1->num_rows;
				if($num>0){
					while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>  
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["qty"]).'</td>
						</tr>';
					}
				}else{
					$printContents=$printContents.'
					<tr>
						<td colspan="4">No records entered.</td>
					</tr>';
				}
				$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>8. In case of new business - intended date of start </td>
		<td>'.strtoupper($start_date).'</td>	
	</tr>
	<tr>
		<td>9. In case of seasonal business, state the opening and closing period of the year </td>
		<td>Opening period : '.strtoupper($opening).'<br/>Closing period : '.strtoupper($closing).'</td>	
	</tr>
	<tr>
		<td>10. Source of water supply </td>
		<td>'.strtoupper($supply).'</td>	
	</tr>
	<tr>
		<td>11. Whether any electric power is used in manufacture of the food items ?<br/>If yes, please state the exact HP used or sanctioned Electricity load : </td>
		<td>'.strtoupper($is_power).'<br/>'.strtoupper($is_power_details).'</td>
	</tr>
	<tr>
		<td colspan="2">12. I/We have forwarded a sum of Rs. &nbsp;'.strtoupper($rupees).'&nbsp; towards registration fees according to the provision of the Food Safety and Standards (Licensing and Registration) Regulations, 2011 vide : <br/>'.strtoupper($fees).'&nbsp;'.strtoupper($draft).'</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td colspan="2" align="right">Signature of the Applicant : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>