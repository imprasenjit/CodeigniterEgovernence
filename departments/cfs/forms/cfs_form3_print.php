<?php
$dept="cfs";
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
	$form_id=$results['form_id'];
	// Tab 1 //
	$others_specify=$results['others_specify'];
	if(!empty($results["premise_add"])){
		$premise_add=json_decode($results["premise_add"]);
		$premise_add_sn1=$premise_add->sn1;$premise_add_sn2=$premise_add->sn2;$premise_add_vill=$premise_add->vill;$premise_add_dist=$premise_add->dist;$premise_add_pin=$premise_add->pin;$premise_add_mobile=$premise_add->mobile;
	}else{				
		$premise_add_sn1="";$premise_add_sn2="";$premise_add_vill="";$premise_add_dist="";$premise_add_pin="";$premise_add_mobile="";
	}        
	if(!empty($results["in_charge"])){
		$in_charge=json_decode($results["in_charge"]);
		$in_charge_name=$in_charge->name;$in_charge_qual=$in_charge->qual;$in_charge_address=$in_charge->address;$in_charge_mobile=$in_charge->mobile;$in_charge_tel=$in_charge->tel;$in_charge_email=$in_charge->email;$in_charge_card=$in_charge->card;$in_charge_expiry=$in_charge->expiry;
	}else{				
		$in_charge_name="";$in_charge_qual="";$in_charge_address="";$in_charge_mobile="";$in_charge_tel="";$in_charge_email="";$in_charge_card="";$in_charge_expiry="";
	}
	if(!empty($results["comply"])){
		$comply=json_decode($results["comply"]);
        if(isset($comply->name)) $comply_name=$comply->name; else $comply_name="";
        if(isset($comply->address)) $comply_address=$comply->address; else $comply_address="";
        if(isset($comply->mobile)) $comply_mobile=$comply->mobile; else $comply_mobile="";
        if(isset($comply->tel)) $comply_tel=$comply->tel; else $comply_tel="";
        if(isset($comply->email)) $comply_email=$comply->email; else $comply_email="";
        if(isset($comply->card)) $comply_card=$comply->card; else $comply_card="";
        if(isset($comply->expiry)) $comply_expiry=$comply->expiry; else $comply_expiry="";
		
	}else{				
		$comply_name="";$comply_address="";$comply_mobile="";$comply_tel="";$comply_email="";$comply_card="";$comply_expiry="";
	}
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_address=$corr_add->address;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
	}else{				
		$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
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
		if(isset($business->l)) $business_l=$business->l; else $business_l="";
		if(isset($business->m)) $business_m=$business->m; else $business_m="";
		if(isset($business->n)) $business_n=$business->n; else $business_n="";
		if(isset($business->o)) $business_o=$business->o; else $business_o="";
		if(isset($business->p)) $business_p=$business->p; else $business_p="";
		if(isset($business->q)) $business_q=$business->q; else $business_q="";
		if(isset($business->r)) $business_r=$business->r; else $business_r="";
		if(isset($business->s)) $business_s=$business->s; else $business_s="";
		if(isset($business->t)) $business_t=$business->t; else $business_t="";
	}else{
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";$business_l="";$business_m="";$business_n="";$business_o="";$business_p="";$business_q="";$business_r="";$business_s="";$business_t="";
	}
	// BUSINESS CHECKMARKS //
	$business_values="";		
	if($business_a=="MA") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Manufacturing/Processing including sorting, grading etc<br/>';
	if($business_b=="M") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Milk Collection/chilling<br/>';
	if($business_c=="S") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Slaughter House<br/>';
	if($business_d=="P") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Packaging<br/>';
	if($business_e=="RE") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Restaurant<br/>';
	if($business_f=="SO") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Solvent extracting unit<br/>';
	if($business_g=="OR") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Solvent extracting and oil refining plant<br/>';
	if($business_h=="PC") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Solvent extracting plant equipped with pre cleaning of oil seeds or pre expelling of oil<br/>';
	if($business_i=="I") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Importing<br/>';
	if($business_j=="ST") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Storage/Warehouse/Cold Storage<br/>';
	if($business_k=="RT") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Retail Trade<br/>';
	if($business_l=="W") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Wholesale Trade<br/>';
	if($business_m=="D") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Distributor/Supplier<br/>';
	if($business_n=="T") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Transporter of food<br/>';
	if($business_o=="C") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Catering<br/>';
	if($business_p=="FV") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Dhabha or any other food vending establishment<br/>';
	if($business_q=="CL") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Club /canteen<br/>';
	if($business_r=="H") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Hotel<br/>';
	if($business_s=="R") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Relabeling (manufactured by third party under own packing and labeling)<br/>';
	if($business_t=="O") $business_values=$business_values. '<span class="tickmark">&#10004;</span>Other(s) : ';
	
	// Tab 2 //
	$is_license=$results['is_license'];$capacity=$results['capacity'];	
	if(!empty($results["dairy"])){
		$dairy=json_decode($results["dairy"]);
		$dairy_lean=$dairy->lean;$dairy_flush=$dairy->flush;
	}else{				
		$dairy_lean="";$dairy_flush="";
	}	
	if($is_license=="Y") $is_license="Yes";
	else $is_license="No";
	
	// Tab 3 //
	$electricity=$results['electricity'];$is_unit=$results['is_unit'];$is_unit_details=$results['is_unit_details'];$period=$results['period'];$rupees=$results['rupees'];$draft=$results['draft'];
	if(!empty($results["factory"])){
		$factory_values=json_decode($results["factory"]);
		$factory_name=$factory_values->name;$factory_sn1=$factory_values->sn1;$factory_sn2=$factory_values->sn2;$factory_vill=$factory_values->vill;$factory_dist=$factory_values->dist;$factory_pin=$factory_values->pin;$factory_mobile=$factory_values->mobile;
	}else{				
		$factory_name="";$factory_sn1="";$factory_sn2="";$factory_vill="";$factory_dist="";$factory_pin="";$factory_mobile="";
	}
	if($is_unit=="Y") $is_unit="Yes";
	else $is_unit="No";
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
		<td>'. $business_values .'&nbsp;'. strtoupper($others_specify) .'</td>
	</tr>
	<tr>
		<td>2. Name of the Company/Organization </td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td>3. Registered Office Address </td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Address of Premise for which license is being applied : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Street Name 1 </td>
				<td>'.strtoupper($premise_add_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2 </td>
				<td>'.strtoupper($premise_add_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town </td>
				<td>'.strtoupper($premise_add_vill).'</td>
			</tr>
			<tr>
				<td>District </td>
				<td>'.strtoupper($premise_add_dist).'</td>
			</tr>
			<tr>
				<td>Pincode </td>
				<td>'.strtoupper($premise_add_pin).'</td>
			</tr>			
			<tr>
				<td>Mobile </td>
				<td>+91 - '.strtoupper($premise_add_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">5. Name and/or designation, qualification and address of technically qualified person in charge of operations as required under Regulation : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Name </td>
				<td>'.strtoupper($in_charge_name).'</td>
			</tr>
			<tr>
				<td>(b) Qualification </td>
				<td>'.strtoupper($in_charge_qual).'</td>
			</tr>
			<tr>
				<td>(c) Address </td>
				<td>'.strtoupper($in_charge_address).'</td>
			</tr>
			<tr>
				<td>(d) Mobile No. </td>
				<td>'.strtoupper($in_charge_mobile).'</td>
			</tr>
			<tr>
				<td>(e) Telephone Number(s) </td>
				<td>'.strtoupper($in_charge_tel).'</td>
			</tr>			
			<tr>
				<td>(f) Email </td>
				<td>'.strtoupper($in_charge_email).'</td>
			</tr>		
			<tr>
				<td>(g) Photo Identity card no and expiry date </td>
				<td>Card No. : '.strtoupper($in_charge_card).'<br/>Expiry date : '.strtoupper($in_charge_expiry).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">6. Name and/or designation, address and contact details of person responsible for complying with conditions of license (if different from 4 Above) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(a) Name </td>
				<td>'.strtoupper($comply_name).'</td>
			</tr>
			<tr>
				<td>(b) Address </td>
				<td>'.strtoupper($comply_address).'</td>
			</tr>
			<tr>
				<td>(c) Mobile No. </td>
				<td>'.strtoupper($comply_mobile).'</td>
			</tr>
			<tr>
				<td>(d) Telephone Number(s) </td>
				<td>'.strtoupper($comply_tel).'</td>
			</tr>			
			<tr>
				<td>(e) Email </td>
				<td>'.strtoupper($comply_email).'</td>
			</tr>		
			<tr>
				<td>(f) Photo Identity card no and expiry date </td>
				<td>Card No. : '.strtoupper($comply_card).'<br/>Expiry date : '.strtoupper($comply_expiry).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>7. Correspondence address (if different from 3 above) </td>
		<td>'.strtoupper($corr_add_address).'</td>	
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">8.(a) Mobile No. </td>
				<td>'.strtoupper($corr_add_mobile).'</td>
			</tr>
			<tr>
				<td>(b) Telephone Number </td>
				<td>'.strtoupper($corr_add_tel).'</td>
			</tr>
			<tr>
				<td>(c) Fax number </td>
				<td>'.strtoupper($corr_add_fax).'</td>
			</tr>
			<tr>
				<td>(d) Email </td>
				<td>'.strtoupper($corr_add_email).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">9. Food items proposed to be manufactured : </td>
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
		<td>10. Do you already have valid license ? </td>
		<td>'.strtoupper($is_license).'</td>
	</tr>';
	if($is_license=="Yes"){
		$printContents=$printContents.'
		<tr>
			<td colspan="2"><strong>If already having valid license - mention annual quantity of each food category manufactured during last three years : </strong></td>
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
					$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
					$num2 = $part2->num_rows;
					if($num2>0){
						while($row_1=$part2->fetch_array()){
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
		</tr>';
	}else{
		$is_license=="No";
	}
	$printContents=$printContents.'
	<tr>
		<td>11. Installed Capacity food product wise (per day) </td>
		<td>'.strtoupper($capacity).'</td>
	</tr>
	<tr>
		<td colspan="2">12. For Dairy units : </td>
	</tr>
	<tr>
		<td colspan="2">(i) Location and installed capacity of Milk Chilling Centers (MCC) / Bulk Milk Cooling Centers (BMCs)/ Milk Processing Unit/ Milk Packaging Unit in litres owned or managed by the applicant : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl No. </th>
						<th>Name and address of MCC/BMC </th>
						<th>Installed Capacity </th>
					</tr>
				</thead>';
				$part3=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t3 where form_id='$form_id'");
				$num3 = $part3->num_rows;
				if($num3>0){
					while($row_1=$part3->fetch_array()){
						$printContents=$printContents.'
						<tr>  
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["capacity"]).'</td>
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
		<td>(ii) Average Quantity of milk per day to be used/handled in </td>
		<td><b>(a) In lean season : </b>'.strtoupper($dairy_lean).'<br/><b>(b) In flush season : </b>'.strtoupper($dairy_flush).'</td>
	</tr>
	<tr>
		<td colspan="2">(iii) Milk products to be manufactured and their manufacturing capacity (tones/year) : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl No. </th>
						<th>Milk products to be manufactured </th>
						<th>Manufacturing capacity (tones/year) </th>
					</tr>
				</thead>';
				$part4=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t4 where form_id='$form_id'");
				$num4 = $part4->num_rows;
				if($num4>0){
					while($row_1=$part4->fetch_array()){
						$printContents=$printContents.'
						<tr>  
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["products"]).'</td>
							<td>'.strtoupper($row_1["capacity"]).'</td>
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
		<td colspan="2">13. For Solvent - Extracted Oil, De oiled meal and Edible Flour : </td>
	</tr>
	<tr>
		<td colspan="2">(i) Details of proposed business : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th rowspan="2" class="text-center" width="4%">Sl. No.</th>
						<th rowspan="2" class="text-center" width="10%">Name of Oil bearing material</th>
						<th rowspan="2" class="text-center" width="10%">From seed or nut or cake</th>
						<th colspan="6" class="text-center" width="60%">Solvent - Extracted Oil, De oiled meal and Edible Flour</th>
						<th rowspan="2" class="text-center" width="10%">Vegetable Oil</th>
					</tr>
					<tr>
						<th width="10%">Crude </th>
						<th width="10%">Neutralized </th>
						<th width="10%">Neutralized & Bleached </th>
						<th width="10%">Refined </th>
						<th width="10%">De oiled meal </th>
						<th width="10%">Edible Flour </th>
					</tr>
				</thead>';
				$part5=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t5 where form_id='$form_id'");
				$num5 = $part5->num_rows;
				if($num5>0){
					while($row_1=$part5->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["name"]).'</td>
							<td>'.strtoupper($row_1["seed"]).'</td>
							<td>'.strtoupper($row_1["crude"]).'</td>
							<td>'.strtoupper($row_1["neutralized"]).'</td>
							<td>'.strtoupper($row_1["bleached"]).'</td>
							<td>'.strtoupper($row_1["refined"]).'</td>
							<td>'.strtoupper($row_1["meat"]).'</td>
							<td>'.strtoupper($row_1["flour"]).'</td>
							<td>'.strtoupper($row_1["vegetable"]).'</td>
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
	</tr>';	
	if($is_license=="Yes"){
		$printContents=$printContents.'
		<tr>
			<td colspan="2"><strong>If already having valid license - mention annual quantity of each product manufactured during last three years </strong></td>
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
					$part6=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t6 where form_id='$form_id'");
					$num6 = $part6->num_rows;
					if($num6>0){
						while($row_1=$part6->fetch_array()){
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
		</tr>';
	}else{
		$is_license=="No";
	}
	$printContents=$printContents.'
	<tr>
		<td colspan="2">(ii) Name and address of factory or factories used by the miller or solvent extractor for processing oil bearing material produced or procured by him or for refining solvent extracted Oil produced by him : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">Name </td>
				<td>'.strtoupper($factory_name).'</td>
			</tr>
			<tr>
				<td>Street Name 1 </td>
				<td>'.strtoupper($factory_sn1).'</td>
			</tr>
			<tr>
				<td>Street Name 2 </td>
				<td>'.strtoupper($factory_sn2).'</td>
			</tr>
			<tr>
				<td>Village/Town </td>
				<td>'.strtoupper($factory_vill).'</td>
			</tr>
			<tr>
				<td>District </td>
				<td>'.strtoupper($factory_dist).'</td>
			</tr>
			<tr>
				<td>Pincode </td>
				<td>'.strtoupper($factory_pin).'</td>
			</tr>			
			<tr>
				<td>Mobile </td>
				<td>+91 - '.strtoupper($factory_mobile).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>14. Sanctioned electricity load or HP to be used </td>
		<td>'.strtoupper($electricity).'</td>
	</tr>
	<tr>
		<td>15. Whether unit is equipped with an analytical laboratory ? <br/>If yes the details thereof : </td>
		<td>'.strtoupper($is_unit).'<br/>'.strtoupper($is_unit_details).'</td>
	</tr>
	<tr>
		<td>16. In case of renewal or transfer of license granted under other laws as per provison to Regulation 5(1) - period for which license required (1 to 5 years) </td>
		<td>'.strtoupper($period).'</td>
	</tr>
	<tr>
		<td colspan="2">17. I/We have forwarded a sum of Rs. &nbsp;'.strtoupper($rupees).'&nbsp; towards License fees according to the provision of the Food Safety and Standards Regulations, 2011 vide : <br/>Demand Draft no (payable to &nbsp;'.strtoupper($draft).')</td>
	</tr>
	';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td colspan="2" align="right">Signature of the applicant/authorized signatory : <strong>'.strtoupper($key_person).'</strong></td>
	</tr>
</table>';
?>