<?php
$dept="gmc";
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
	

	if($q->num_rows > 0){
        $results=$q->fetch_array();
			$form_id=$results["form_id"];$fat_name=$results["fat_name"];$is_factory_license=$results["is_factory_license"];$property_tax=$results["property_tax"];$prop_dispose=$results["prop_dispose"];$plant_par=$results["plant_par"];$rent_details=$results["rent_details"];$trade_premises=$results["trade_premises"];$date_fac=$results["date_fac"];
			
			if($date_fac=="0000-00-00") $date_fac="";
			
			if($is_factory_license=="Y"){
				$is_factory_license="YES";
			}else{
				$is_factory_license="NO";
			}
			if(!empty($results["factory"])){
				$factory=json_decode($results["factory"]);
				$factory_name=$factory->name;$factory_nature=$factory->nature;$factory_trade_premises=$factory->trade_premises;	
			}else{				
				$factory_name="";$factory_nature="";$factory_trade_premises="";
			}
			if(!empty($results["property_tax"])){
				$property_tax=json_decode($results["property_tax"]);
				$property_tax_payment_date=$property_tax->payment_date;$property_tax_receipt_no=$property_tax->receipt_no;	
			}else{				
				$property_tax_payment_date="";$property_tax_receipt_no="";
			}			
			if(!empty($results["worker"])){
				$worker=json_decode($results["worker"]);
				$worker_year=$worker->year;$worker_month=$worker->month;$worker_employed=$worker->employed;
			}else{
				$worker_year="";$worker_month="";$worker_employed="";
			}		
			if(!empty($results["is_license"])){
				$is_license=Array();
				$is_license=explode("//",$results["is_license"]);
				$is_license_a=$is_license[0];$is_license_b=$is_license[1];
			}else{
				$is_license_a="";$is_license_b="";
			}		
			if(!empty($results["power"])){
				$power=json_decode($results["power"]);
				$power_nature=$power->nature;$power_amount=$power->amount;
			}else{
				$power_nature="";$power_amount="";
			}	
			if(!empty($results["owner"])){
				$owner=json_decode($results["owner"]);
				$owner_name=$owner->name;$owner_sn1=$owner->sn1;$owner_sn2=$owner->sn2;$owner_d=$owner->d;$owner_v=$owner->v;$owner_p=$owner->p;
			}else{
				$owner_name="";$owner_sn1="";$owner_sn2="";$owner_v="";$owner_d="";$owner_p="";
			}
			if(!empty($results["company"])){
				$company=json_decode($results["company"]);
				$company_capital=$company->capital;$company_income_tax=$company->income_tax;
			}else{
				$company_capital="";$company_income_tax="";
			}
			if(!empty($results["godown"])){
				$godown=json_decode($results["godown"]);
				$godown_premises=$godown->premises;$godown_outside=$godown->outside;
			}else{
				$godown_premises="";$godown_outside="";
			}	
			if(!empty($results["fact_const"])){
				$fact_const=json_decode($results["fact_const"]);
				$fact_const_date_approval=$fact_const->date_approval;$fact_const_ref_no=$fact_const->ref_no;
			}else{
				$fact_const_date_approval="";$fact_const_ref_no="";
			}
	}	
	$prop_dispose= wordwrap($prop_dispose, 40, "<br/>", true);
	$plant_par= wordwrap($plant_par, 40, "<br/>", true);
	
	
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
				<td colspan="2">To,<br/>The Commissioner,<br/>GUWAHATI MUNICIPAL CORPORATION<br/>GUWAHATI.
				<br/><br/>&nbsp;Application for granting or renewal of licence for Factories, Workshop or trade premises in which steam, electricity water or other mechanical power is intended to employ U/S 273 read with Section 378 of the Guwahati Municipal Corporation Act 1969 for the year - 1st April of '.strtoupper($results["from_year"]).' to 31st March of '.strtoupper($results["to_year"]).'.</td>
			</tr>
			<tr>
				<td valign="center" colspan="2"></td>		
			</tr>
			<tr>				
				<td valign="top" width="40%">1. Full Name of the Factory etc. </td>
				<td  width="60%">'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td valign="top">2. (a) Name of the owner </td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td valign="top">(b) Father&#39;s Name </td>
				<td>'.strtoupper($fat_name).'</td>
			</tr>
			<tr>
				<td valign="top"> 3. Full Address and situation of factory with ward No. </td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td width=50%>Street Name1</td><td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name2</td><td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village</td><td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District</td><td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td><td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile no.</td><td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Phone No.</td><td>'.strtoupper($b_landline_std).'-'.strtoupper($b_landline_no).'</td>
					</tr>
					<tr>
						<td>Ward No.</td><td>'.strtoupper($b_block).'</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td>4. Factory licence already obtained ? </td>
				<td>'.strtoupper($is_factory_license).'</td>
			</tr>';
			if($is_factory_license=="YES"){
				$printContents=$printContents.'
				<tr>
					<td>Registration No.</td>
					<td>'.strtoupper($is_license_a).'</td>
				</tr>
				<tr>
					<td>Date and Year </td>
					<td>'.date("d-m-Y",strtotime($is_license_b)).'</td>
				</tr>';
			}else{
				$printContents=$printContents.'
				<tr>
					<td>State the details of the site plan </td>
					<td>'.strtoupper($is_license_a).'</td>
				</tr>
				<tr>
					<td>Date of commencement </td>
					<td>'.date("d-m-Y",strtotime($is_license_b)).'</td>				
				</tr>';
			}			
			$printContents=$printContents.'
			<tr>
				<td>5. (a) Name of the principal products manufactured during the last 12 months </td>
				<td>'.strtoupper($factory_name).'</td>
			</tr>
			<tr>
				<td>(b) If it is a workshop state nature of work done </td>
				<td>'.strtoupper($factory_nature).'</td>
			</tr>
			<tr>
				<td>(c) If it is a trade premises state the particular of products deal in. </td>
				<td>'.strtoupper($factory_trade_premises).'</td>
			</tr>
			<tr>
				<td>6. (a) Maximum number of workers proposed to be employed on any during the year </td>
				<td>'.strtoupper($worker_year).'</td>
			</tr>
			<tr>
				<td>(b) Minimum number of workers on any day during the last 12 months.</td>
				<td>'.strtoupper($worker_month).'</td>
			</tr>
			<tr>
				<td>(c) Number of workers to be ordinarily employed </td>
				<td>'.strtoupper($worker_employed).'</td>
			</tr>
			<tr>
				<td>7. (a) Nature and total amount of power (H.P) installed </td>
				<td>'.strtoupper($power_nature).'-'.strtoupper($power_amount).'</td>
			</tr>
			<tr>
				<td valign="top">8. Full Name of the owner of the building and address of the premises </td>
				<td>
				<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Name </td>
					<td>'.strtoupper($owner_name).'</td>
				</tr>
				<tr>
					<td>Street Name1 </td>
					<td>'.strtoupper($owner_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name2 </td>
					<td>'.strtoupper($owner_sn2).'</td>
				</tr>
				<tr>
					<td>Village </td>
					<td>'.strtoupper($owner_v).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($owner_d).'</td>
				</tr>
				<tr>
					<td>Pincode </td>
					<td>'.strtoupper($owner_p).'</td>
				</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>9. In the case of Factory constructed or extended after the date of the commencement of the building by law give reference number &amp; date of approval of the site plan by the Guwahati Municipal Corporation. </td>
				<td>'.strtoupper($fact_const_ref_no).', '.strtoupper($fact_const_date_approval).'</td>
			</tr>
			<tr>
				<td>10. If the building is assessed to the property tax mention the receipt no. and date of payment of tax </td>
				<td>'.strtoupper($property_tax_receipt_no).', '.strtoupper($property_tax_payment_date).'</td>
			</tr>
			<tr>
				<td>11. How do u propose to dispose trade waste and effluent and whether approval from the Municipal Authority has been sought for or applied </td>
				<td>'.strtoupper($prop_dispose).'</td>
			</tr>
			<tr>
				<td>12. Particular of plants installed or proposed to be installed. </td>
				<td>'.strtoupper($plant_par).'</td>
			</tr>
			<tr>
				<td>13. If rented, state the actual rent per months if not, State the prevailing market rent of the premises </td>
				<td>'.strtoupper($rent_details).'</td>
			</tr>
			<tr>
				<td>14. Income from the Factory/Workshop/ or Trade premises.</td>
				<td>'.strtoupper($trade_premises).'</td>
			</tr>
			<tr>
				<td colspan="2">15. If it is Company-
				<table class="table table-bordered table-responsive">	
					<tr>
						<td width="40%">(a) Paid up capital-</td>
						<td>'.strtoupper($company_capital).'</td>
					</tr>
					<tr>
						<td>(b) Income Tax paid for last two years-</td>
						<td>'.strtoupper($company_income_tax).'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">16. Godown-
				<table class="table table-bordered table-responsive">	
					<tr>
						<td width="40%">(a) Situated in the same premises-</td>
						<td>'.strtoupper($godown_premises).'</td>
					</tr>
					<tr>
						<td>(b) Situated outside premises, and give location and its rent-</td>
						<td>'.strtoupper($godown_outside).'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>17. Date of the establishment of the factory/workshop/or trade premise.</td>
				<td>'.strtoupper($date_fac).'</td>
			</tr>
			<tr>
				<td colspan="2">I, &nbsp;'.strtoupper($key_person).' solemnly affirm and state that the above statement made by me is true to my knowledge and belief.</td>
			</tr>';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			<tr>
				<td>Signatures and Dates:</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Signature of the applicant.</td>
						<td>'.strtoupper($key_person).'<br/></td>				
					</tr>	
					<tr>
						<td width="60%">Date : </td>
						<td>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>