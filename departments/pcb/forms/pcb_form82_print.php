<?php
$dept="pcb";
$form="82";
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
	$scheme_details=$results['scheme_details'];$scheme_list=$results['scheme_list'];$budget=$results['budget'];$programme=$results['programme'];$is_comply=$results['is_comply'];
	if(!empty($results["producer"])){
		$producer=json_decode($results["producer"]);
		$producer_name=$producer->name;$producer_sn1=$producer->sn1;$producer_sn2=$producer->sn2;$producer_vill=$producer->vill;$producer_dist=$producer->dist;$producer_pin=$producer->pin;$producer_mobile=$producer->mobile;$producer_phone=$producer->phone;$producer_email=$producer->email;$producer_other=$producer->other;
	}else{				
		$producer_name="";$producer_sn1="";$producer_sn2="";$producer_vill="";$producer_dist="";$producer_pin="";$producer_mobile="";$producer_phone="";$producer_email="";$producer_other="";
	}			
	if(!empty($results["auth"])){
		$auth=json_decode($results["auth"]);
		$auth_name=$auth->name;$auth_sn1=$auth->sn1;$auth_sn2=$auth->sn2;$auth_vill=$auth->vill;$auth_dist=$auth->dist;$auth_pin=$auth->pin;$auth_mobile=$auth->mobile;$auth_fax=$auth->fax;$auth_email=$auth->email;
	}else{				
		$auth_name="";$auth_sn1="";$auth_sn2="";$auth_vill="";$auth_dist="";$auth_pin="";$auth_mobile="";$auth_fax="";$auth_email="";
	}			
	if(!empty($results["organization"])){
		$organization=json_decode($results["organization"]);
		$organization_name=$organization->name;$organization_sn1=$organization->sn1;$organization_sn2=$organization->sn2;$organization_vill=$organization->vill;$organization_dist=$organization->dist;$organization_pin=$organization->pin;$organization_mobile=$organization->mobile;$organization_fax=$organization->fax;$organization_email=$organization->email;
	}else{				
		$organization_name="";$organization_sn1="";$organization_sn2="";$organization_vill="";$organization_dist="";$organization_pin="";$organization_mobile="";$organization_fax="";$organization_email="";
	}
	
	if($is_comply=="Y") $is_comply="Yes";
	else $is_comply="No";
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
<br/>
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. (a) Name of Producer </td>
		<td>'.strtoupper($producer_name).'</td>
	</tr>
	<tr>
		<td colspan="2">1. (b) Full address along with telephone numbers, e-mail and other contact details of Producer (It should be the place from where sale in entire country is being managed) </td>
	</tr>
	<tr>  				
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Street Name 1</td>
					<td>'.strtoupper($producer_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($producer_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($producer_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($producer_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($producer_pin).'</td>
				</tr>				
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($producer_mobile).'</td>
				</tr>				
				<tr>
					<td>Phone Number</td>
					<td>'.strtoupper($producer_phone).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td>'.$producer_email.'</td>
				</tr>
				<tr>
					<td>Other details</td>
					<td>'.strtoupper($producer_other).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>2. (a) Name of the Authorised Person </td>
		<td>'.strtoupper($auth_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. (b) Full address of the Authorised Person with e-mail, telephone and fax number </td>
	</tr>
	<tr>  				
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Street Name 1</td>
					<td>'.strtoupper($auth_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($auth_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($auth_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($auth_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($auth_pin).'</td>
				</tr>				
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($auth_mobile).'</td>
				</tr>				
				<tr>
					<td>Fax Number</td>
					<td>'.strtoupper($auth_fax).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td>'.$auth_email.'</td>
				</tr>
			</table>
		</td>
	</tr>	
	<tr>
		<td colspan="2">3. Name, address and contact details of Producer Responsibility Organisation, if any with full address, e-mail, telephone and fax number, if engaged for implementing the Extended Producer Responsibility :  </td>
	</tr>
	<tr>  				
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Name </td>
					<td>'.strtoupper($organization_name).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($organization_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($organization_sn2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($organization_vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($organization_dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($organization_pin).'</td>
				</tr>				
				<tr>
					<td>Mobile</td>
					<td>+91 - '.strtoupper($organization_mobile).'</td>
				</tr>				
				<tr>
					<td>Fax Number</td>
					<td>'.strtoupper($organization_fax).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td>'.$organization_email.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">4. Details of electrical and electronic equipment placed on market year-wise during previous 10 years as given below : </td>
	</tr>									
	<tr>
		<td colspan="2">5. Estimated generation of Electrical and Electronic Equipment waste item-wise and estimated collection target for the forthcoming year  including those being generated from their service centres, as given below : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered text-center table-responsive">
			<thead>
				<tr>
					<th rowspan="2">Sl. No. </th>
					<th rowspan="2">Item </th>
					<th colspan="2">Estimated waste electrical and electronic equipment generation </th>
					<th colspan="2">Targeted collection </th>
				</tr>
				<tr>
					<th>Number </th>
					<th>Weight </th>
					<th>Number </th>
					<th>Weight </th>
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
						<td>'.strtoupper($row_1["item"]).'</td>
						<td>'.strtoupper($row_1["num1"]).'</td>
						<td>'.strtoupper($row_1["weight1"]).'</td>
						<td>'.strtoupper($row_1["num2"]).'</td>
						<td>'.strtoupper($row_1["weight2"]).'</td>
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
		</td>
	</tr>
	<tr>
		<td colspan="2">6. Extended Producer Responsibility Plans : </td>
	</tr>
	<tr>
		<td>(a) Please provide details of your overall scheme to fulfil Extended Producer Responsibility obligations including targets. This should comprise of general scheme of collection of used/waste Electrical and Electronic Equipment from the Electrical and Electronic Equipment placed on the market earlier such as through dealers and collection centres, Producer Responsibility Organisation, through buy-back arrangement, exchange scheme, Deposit Refund Scheme, etc. whether directly or through any authorised agency and channelising the items so collected to authorised recyclers </td>
		<td>'.strtoupper($scheme_details).'</td>
	</tr>
	<tr>
		<td>(b) Provide the list with addresses along with agreement copies with dealers, collection centres, recyclers, Treatment, Storage and Disposal Facility, etc. under your scheme </td>
		<td>'.strtoupper($scheme_list).'</td>
	</tr>
	<tr>
		<td>7. Estimated budget for Extended Producer Responsibility and allied initiatives to create consumer awareness </td>
		<td>'.strtoupper($budget).'</td>
	</tr>
	<tr>
		<td>8. Details of proposed awareness programmes </td>
		<td>'.strtoupper($programme).'</td>
	</tr>
	<tr>
		<td colspan="2">9. Details for Reduction of Hazardous Substances compliance (to be filled if applicable) : </td>
	</tr>
	<tr>
		<td>(a) Whether the Electrical and Electronic Equipment placed on market complies with the rule 16 (1) limits with respect to lead, mercury, cadmium, hexavalent chromium, polybrominated biphenyls and polybrominateddiphenyl ethers : </td>
		<td>'.strtoupper($is_comply).'</td>
	</tr>
	<tr>
		<td>(b)Provide the technical documents (Supplier declarations, Materials declarations/Analytical reports) as evidence that the Reduction of Hazardous Substances (RoHS) provisions are complied by the product based on standard EN 50581 of EU : </td>
		<td>Upload later in upload section </td>
	</tr>		
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left">Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Authorized Signature : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>