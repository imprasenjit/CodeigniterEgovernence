<?php
$dept="dic";
$form="15";
$table_name=$formFunctions->getTableName($dept,$form);

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
	$branch_address=$results['branch_address'];$enterprise_pan=$results['enterprise_pan'];$em_no=$results['em_no'];$em_dt=$results['em_dt'];$items=$results['items'];$service=$results['service'];$capacity=$results['capacity'];$vat_no=$results['vat_no'];$vat_dt=$results['vat_dt'];$excise_no=$results['excise_no'];$excise_dt=$results['excise_dt'];$service_no=$results['service_no'];$service_dt=$results['service_dt'];$entry_no=$results['entry_no'];$entry_dt=$results['entry_dt'];
	
	if(!empty($results["office"])){
		$office=json_decode($results["office"]);
		$office_sn1=$office->sn1;$office_sn2=$office->sn2;$office_vill=$office->vill;$office_dist=$office->dist;$office_po=$office->po;$office_mobile=$office->mobile;$office_phone=$office->phone;$office_email=$office->email;
	}else{
		$office_sn1="";$office_sn2="";$office_vill="";$office_dist="";$office_po="";$office_mobile="";$office_phone="";$office_email="";
	}	
	if(!empty($results["capital"])){
		$capital=json_decode($results["capital"]);
		$capital_land=$capital->land;$capital_building=$capital->building;$capital_plant=$capital->plant;$capital_equip=$capital->equip;
	}else{
		$capital_land="";$capital_building="";$capital_plant="";$capital_equip="";
	}		
	// Tab 2 //
	$no_of_workers=$results['no_of_workers'];$local_percent=$results['local_percent'];$reg_no=$results['reg_no'];$reg_dt=$results['reg_dt'];$applicant_name=$results['applicant_name'];
	 
	if(!empty($results["fees"])){
		$fees=json_decode($results["fees"]);
		$fees_no=$fees->no;$fees_dt=$fees->dt;$fees_amnt=$fees->amnt;
	}else{
		$fees_no="";$fees_dt="";$fees_amnt="";
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
		<td width="50%">1. Name of the Micro/Small Enterprise </td>
		<td>'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. Location of the Enterprise : </td>
	</tr>
	<tr>
		<td colspan="2"><b>(a) Factory location : </b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive"> 
				<tr>
					<td width="50%">Street Name 1 </td>
					<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($b_street_name2).'</td>
				</tr>
				<tr>
					<td>Vill/Town </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
					<td>P.O. </td>
					<td>'.strtoupper($b_block).'</td>
				</tr>
				<tr>
					<td>Mobile </td>
					<td>+91 - '.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
					<td>Phone Number </td>
					<td>'.$b_landline_std."-".$b_landline_no.'</td>
				</tr>	
				<tr>
					<td>Email </td>
					<td>'.$b_email.'</td>				
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2"><b>(b) Office Address : </b></td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive"> 
				<tr>
					<td width="50%">Street Name 1 </td>
					<td>'.strtoupper($office_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 </td>
					<td>'.strtoupper($office_sn2).'</td>
				</tr>
				<tr>
					<td>Vill/Town </td>
					<td>'.strtoupper($office_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($office_dist).'</td>
				</tr>
				<tr>
					<td>P.O. </td>
					<td>'.strtoupper($office_po).'</td>
				</tr>
				<tr>
					<td>Mobile </td>
					<td>+91 - '.strtoupper($office_mobile).'</td>
				</tr>
				<tr>
					<td>Phone Number </td>
					<td>'.$office_phone.' </td>
				</tr>	
				<tr>
					<td>Email </td>
					<td>'.$office_email.'</td>				
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>(c) Address of Registered Office </td>
		<td>'.strtoupper($unit_details).'</td>
	</tr>
	<tr>
		<td>(d) Address of the Branch Office, if any </td>
		<td>'.strtoupper($branch_address).'</td>
	</tr>
	<tr>
		<td>3. Constitution of the unit </td>
		<td>'.strtoupper($Type_of_ownership).'</td>
	</tr>
	<tr>
		<td colspan="2">4. Name(s), address(es) of the Proprietor/ Partner(s)/ Director(s)/ Managing Director with their PAN No : </td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
					<tr>
						<th>Sl. No.</th>
						<th>Partners/Directors Name</th>
						<th>Street Name</th>
						<th>Village/Town</th>
						<th>District</th>
						<th>Pincode</th>
						<th>Mobile Number</th>
						<th>PAN Number</th>						
					</tr>
				</thead>';
				$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$dic->error);
				$sl=1;
				while($rows=$results1->fetch_object()){
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->name).'</td>
						<td>'.strtoupper($rows->sn).'</td>
						<td>'.strtoupper($rows->vill).'</td>
						<td>'.strtoupper($rows->dist).'</td>
						<td>'.strtoupper($rows->pin).'</td>
						<td>'.strtoupper($rows->mobile).'</td>
						<td>'.strtoupper($rows->pan).'</td>
					</tr>';
					$sl++;
				}$printContents=$printContents.'
			</table>
		</td>
	</tr>	
	<tr>
		<td>5. PAN Number of the Enterprise </td>
		<td>'.strtoupper($enterprise_pan).'</td>
	</tr>
	<tr>
		<td>6. EM Part-II Number and date </td>
		<td>No. : '.strtoupper($em_no).'<br/>Date : '.strtoupper($em_dt).'</td>
	</tr>
	<tr>
		<td>7. Items Manufactured </td>
		<td>'.strtoupper($items).'</td>
	</tr>
	<tr>
		<td>8. Service Provided </td>
		<td>'.strtoupper($service).'</td>
	</tr>
	<tr>
		<td>9. Capital Investment : </td>
		<td>(a) Land : '.strtoupper($capital_land).'<br/>
			(b) Building : '.strtoupper($capital_building).'<br/>
			(c) Plant & Machinery : '.strtoupper($capital_plant).'<br/>
			(d) Accessories & Equipments : '.strtoupper($capital_equip).'
		</td>
	</tr>
	<tr>
		<td>10. Accessed Annual Production Capacity </td>
		<td>'.strtoupper($capacity).'</td>
	</tr>
	<tr>
		<td>11. VAT Registration Number and Date </td>
		<td>No. : '.strtoupper($vat_no).'<br/>Date : '.strtoupper($vat_dt).'</td>
	</tr>
	<tr>
		<td>12. Excise Registration Number and Date </td>
		<td>No. : '.strtoupper($excise_no).'<br/>Date : '.strtoupper($excise_dt).'</td>
	</tr>
	<tr>
		<td>13. Service Tax Registration Number and Date </td>
		<td>No. : '.strtoupper($service_no).'<br/>Date : '.strtoupper($service_dt).'</td>
	</tr>
	<tr>
		<td>14. Entry Tax Registration Number and Date </td>
		<td>No. : '.strtoupper($entry_no).'<br/>Date : '.strtoupper($entry_dt).'</td>
	</tr>
	<tr>
		<td>15. Employment </td>
		<td>(a) No. of workers (Managerial + Skill + Workers) : '.strtoupper($no_of_workers).'<br/>
			(b) Percentage of Local Employees : '.strtoupper($local_percent).'
		</td>
	</tr>
	<tr>
		<td colspan="2">16. Products Manufactured/ Services Rendered : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th width="5%">Sl No.</th>
					<th width="40%">Name of the Products Manufactured/ Services Rendered during the accounting year</th>
					<th width="15%">Accessed Annual Capacity</th>
					<th width="15%">Production during the last accounting year</th>
					<th width="20%">Remarks</th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["capacity"]).'</td>
						<td>'.strtoupper($row_1["prod"]).'</td>
						<td>'.strtoupper($row_1["remarks"]).'</td>
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
		<td colspan="2">17. Products/ Services supplied/ rendered to various Government/ Public Sector Enterprises/ Corporations/ Aided Institute : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of the Products/Service</th>
					<th>Purchasing Department</th>
					<th>Order no.</th>
					<th>Order Date</th>
					<th>Quantity Supplied</th>
					<th>Rate</th>
					<th>Value</th>
					<th>Payment Received or Not</th>
				</tr>
			</thead>';
			$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
			$num2 = $part2->num_rows;
			if($num2>0){
				while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>                      
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["purchase"]).'</td>
						<td>'.strtoupper($row_2["no"]).'</td>
						<td>'.strtoupper($row_2["date"]).'</td>
						<td>'.strtoupper($row_2["qty"]).'</td>
						<td>'.strtoupper($row_2["rate"]).'</td>
						<td>'.strtoupper($row_2["value"]).'</td>
						<td>'.strtoupper($row_2["payment"]).'</td>
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
		<td>18. Application Fees to be deposited by Treasury Challan </td>
		<td>Challan No. : '.strtoupper($fees_no).'<br/>Challan Date : '.strtoupper($fees_dt).'<br/>Amount Deposited : '.strtoupper($fees_amnt).'</td>
	</tr>
	<tr>
		<td>19. Registration No. and Date under APSP Act 1989, if any</td>
		<td>No. : '.strtoupper($reg_no).'<br/>Date : '.strtoupper($reg_dt).'</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><b>Declaration of the Applicant </b></td>
	</tr>
	<tr>
		<td colspan="2">I, &nbsp;'.strtoupper($applicant_name).'&nbsp; do hereby solemnly declare that the above information/particulars are true to the best of my knowledge and belief. If the above particulars are found to be not true/fabricated, I shall be liable for appropriate action as the Department deem fit and proper.</td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
	
	<tr>
		<td align="left">Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
		<td align="right">Signature of the Applicant : <b>'.strtoupper($key_person).'</b></td>
	</tr>        
</table>';
?>