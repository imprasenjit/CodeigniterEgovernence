<?php
$dept="pcb";
$form="61";
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
	$agency_name=$results['agency_name'];$municipal_auth=$results['municipal_auth'];$officer_name=$results['officer_name'];$officer_desgn=$results['officer_desgn'];$applied_auth=$results['applied_auth'];
		
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_sn1=$corr_add->sn1;$corr_add_sn2=$corr_add->sn2;$corr_add_vill=$corr_add->vill;$corr_add_dist=$corr_add->dist;$corr_add_pin=$corr_add->pin;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;
	}else{				
		$corr_add_sn1="";$corr_add_sn2="";$corr_add_vill="";$corr_add_dist="";$corr_add_pin="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";
	}	
	
	if(!empty($results["proposal"])){
		$proposal=json_decode($results["proposal"]);
		$proposal_loc=$proposal->loc;$proposal_site_qty=$proposal->site_qty;$proposal_comp=$proposal->comp;$proposal_tech=$proposal->tech;$proposal_qty=$proposal->qty;$proposal_clearance=$proposal->clearance;$proposal_points=$proposal->points;
	}else{				
		$proposal_loc="";$proposal_site_qty="";$proposal_comp="";$proposal_tech="";$proposal_qty="";$proposal_clearance="";$proposal_points="";
	}
	
	if(!empty($results["plan"])){
		$plan=json_decode($results["plan"]);
		$plan_amount=$plan->amount;$plan_disposal=$plan->disposal;$plan_prevent=$plan->prevent;$plan_invest=$plan->invest;$plan_safety=$plan->safety;
	}else{				
		$plan_amount="";$plan_disposal="";$plan_prevent="";$plan_invest="";$plan_safety="";
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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">To, <br/>&nbsp;&nbsp;&nbsp;The Member Secretary</td>
	</tr>
	<tr>  				
		<td width="50%">1. Name of the local authority or Name of the agency</td>
		<td>'.strtoupper($agency_name).'</td>
	</tr>
	<tr>  				
		<td>2. Appointed by the municipal authority</td>
		<td>'.strtoupper($municipal_auth).'</td>
	</tr>
	<tr>
		<td colspan="2">3. Correspondence address : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1</td>
				<td>'.strtoupper($corr_add_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2</td>
				<td>'.strtoupper($corr_add_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town</td>
				<td>'.strtoupper($corr_add_vill).'</td>
			</tr>
			<tr>
				<td>District</td>
				<td>'.strtoupper($corr_add_dist).'</td>
			</tr>
			<tr>
				<td>Pincode</td>
				<td>'.strtoupper($corr_add_pin).'</td>
			</tr>			
			<tr>
				<td>Mobile</td>
				<td>+91 - '.strtoupper($corr_add_mobile).'</td>
			</tr>
			<tr>
				<td>Telephone No. </td>
				<td>'.strtoupper($corr_add_tel).'</td>
			</tr>
			<tr>
				<td>Fax No. </td>
				<td>'.strtoupper($corr_add_fax).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td>4. Nodal Officer and designation (Officer authorized by the competent authority or agency responsible for operation of processing or recycling or disposal facility)</td>
		<td><b>Name of Nodal Officer : </b>&nbsp;'.strtoupper($officer_name).'<br/><b>Designation : </b>&nbsp;'.strtoupper($officer_desgn).'</td>
	</tr>
	<tr>  				
		<td>5. Authorisation applied for (Setting up of processing or recycling facility of construction and demolition waste)</td>
		<td>'.strtoupper($applied_auth).'</td>
	</tr>
	<tr>  				
		<td colspan="2">6. Detailed proposal of construction and demolition waste processing or recycling facility to include the following : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Location of site approved and allotted by the Competent Authority </td>
				<td>'.strtoupper($proposal_loc).'</td>
			</tr>
			<tr>
				<td>(b) Average quantity (in tons per day) and composition of construction and demolition waste to be handled at the specific site</td>
				<td><b>Quantity (in tons per day) : </b>&nbsp;'.strtoupper($proposal_site_qty).'<br/><b>Composition : </b>&nbsp;'.strtoupper($proposal_comp).'</td>
			</tr>
			<tr>
				<td>(c) Details of construction and demolition waste processing or recycling technology to be used</td>
				<td>'.strtoupper($proposal_tech).'</td>
			</tr>
			<tr>
				<td>(d) Quantity of construction and demolition waste to be processed per day</td>
				<td>'.strtoupper($proposal_qty).'</td>
			</tr>
			<tr>
				<td>(e) Site clearance from Prescribed Authority</td>
				<td>'.strtoupper($proposal_clearance).'</td>
			</tr>	
			<tr>
				<td>(f) Salient points of agreement between competent authority or local authority and operating agency (attach relevant document) </td>
				<td>'.strtoupper($proposal_points).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>  				
		<td colspan="2">7. Plan for utilization of recycled product : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Expected amount of process rejects and plan for its disposal (e.g., sanitary landfill for solid waste)</td>
				<td><b>Amount : </b>&nbsp;'.strtoupper($plan_amount).'<br/><b>Plan for disposal : </b>&nbsp;'.strtoupper($plan_disposal).'</td>
			</tr>
			<tr>
				<td>(b) Measures to be taken for prevention and control of environmental pollution</td>
				<td>'.strtoupper($plan_prevent).'</td>
			</tr>			
			<tr>
				<td>(c) Investment on project and expected returns</td>
				<td>'.strtoupper($plan_invest).'</td>
			</tr>
			<tr>
				<td>(d) Measures to be taken for safety of workers working in the processing or recycling plant</td>
				<td>'.strtoupper($plan_safety).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><br/>Any preventive plan for accident during the collection, transportation and treatment including processing and recycling should be informed to the Competent Authority (Local Authority) or Prescribed Authority.</td>
	</tr>
	<tr>
		<td align="left">Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature : <strong>'.strtoupper($key_person).'</strong></td>		
	</tr>
</table>';
?>