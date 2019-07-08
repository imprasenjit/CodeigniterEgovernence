<?php
$dept="rfs";
$form="13";
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
		$form_id=$results["form_id"];$soc_reg_no=$results["soc_reg_no"];$date_of_registration=$results["date_of_registration"];$post_office=$results["post_office"];$police_station=$results["police_station"];$photo_president=$results["photo_president"];$photo_secretary=$results["photo_secretary"]; $meeting_date=$results["meeting_date"]; 
		
		if(!empty($results["bank_detail"])){
			$bank_detail=json_decode($results["bank_detail"]);
			$bank_detail_no=$bank_detail->no;$bank_detail_bank=$bank_detail->bank;$bank_detail_branch=$bank_detail->branch;$bank_detail_type=$bank_detail->type;$bank_detail_holding=$bank_detail->holding;
		}else{
			$bank_detail_no="";$bank_detail_bank="";$bank_detail_branch="";$bank_detail_type="";$bank_detail_holding="";
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">		
			<tr>				
				<td width="50%">1. Name of the Society</td>
				<td>'.strtoupper($unit_name).'</td>
			</tr>
			<tr>
				<td>2. Registration No </td>
				<td>'.strtoupper($soc_reg_no).'</td>
			</tr>
			<tr>
				<td>3. Date of Registration :</td>
				<td>'.date("d-m-Y",strtotime($date_of_registration)).'</td>
			</tr>
			<tr>
				<td>4. Date of meeting for renewal :</td>
				<td>'.date("d-m-Y",strtotime($meeting_date)).'</td>
			</tr>
			<tr>
				<td valign="top">5. Address of the Society </td>
				<td width="50%">
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Mouza</td>
						<td>'.strtoupper($mouza).'</td>
					</tr>
					<tr>
						<td>Circle</td>
						<td>'.strtoupper($circle).'</td>
					</tr>
					<tr>
						<td>Patta no</td>
						<td>'.strtoupper($patta_no).'</td>
					</tr>
					<tr>
						<td>Dag no</td>
						<td>'.strtoupper($dag_no).'</td>
					</tr>
					<tr>
						<td>Area</td>
						<td>'.strtoupper($area).'</td>
					</tr>
					<tr>
						<td>Locality</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>Post Office</td>
						<td>'.strtoupper($post_office).'</td>
					</tr>
					<tr>
						<td>Police Station</td>
						<td>'.strtoupper($police_station).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pin code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No.</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>Email ID</td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">6. A list of members of the Executive Committee with their full name (in block letter), address and occupation.</td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th>Sl No.</th>
						<th>Name of the Members</th>
						<th>Address</th>
						<th>Occupation</th>
						<th>Designation</th>
					</tr>
					</thead>
					';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->member_name).'</td>
							<td>'.strtoupper($rows->member_address).'</td>
							<td>'.strtoupper($rows->member_occupation).'</td>
							<td>'.strtoupper($rows->member_designation).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">7. A statement showing the details of grant receipt from Central Government/State Government and other agencies during the preceding 3 years from the date of renewal application.</td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>
					<tr>
						<th>Sanction letter no.</th>
						<th>Sanction Date</th>
						<th>Name of the scheme</th>
						<th>Objectives of the scheme</th>
						<th>Fund releasing authority</th>	
						<th>Opening balance</th>	
						<th>Amount sanctioned during the year</th>	
						<th>Amount released during the preceding 3 years</th>	
						<th>Total available fund</th>	
						<th>Total expenditure incurred during the preceding 3 years</th>	
						<th>Remarks</th>	
					</tr>
					</thead>';				
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["letter_no"]).'</td>
							<td>'.strtoupper($row_1["letter_date"]).'</td>
							<td>'.strtoupper($row_1["scheme_name"]).'</td>
							<td>'.strtoupper($row_1["obj_of_scheme"]).'</td>
							<td>'.strtoupper($row_1["fund_release"]).'</td>
							<td>'.strtoupper($row_1["opening_balance"]).'</td>
							<td>'.strtoupper($row_1["amount_release"]).'</td>
							<td>'.strtoupper($row_1["total_fund"]).'</td>
							<td>'.strtoupper($row_1["total_exp"]).'</td>
							<td>'.strtoupper($row_1["remarks"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>   
				</td>
			</tr>
			<tr>
				<td colspan="2">8. Bank Details </td>
			</tr>
			<tr>
				<td>Account No.</td>
				<td> '.strtoupper($bank_detail_no).'</td>
			</tr>
			<tr>
				<td>Bank</td>
				<td> '.strtoupper($bank_detail_bank).'</td>
			</tr>
			<tr>
				<td>Branch</td>
				<td> '.strtoupper($bank_detail_branch).'</td>
			</tr>
			<tr>
				<td>Type of Account</td>
				<td> '.strtoupper($bank_detail_type).'</td>
			</tr>
			<tr>
				<td>Holding account</td>
				<td> '.strtoupper($bank_detail_holding).'</td>
			</tr>
			<tr>
				<td colspan="2">9. Photographs of the President & Secretary: </td>
			</tr>
			<tr>
				<td>President</td>	
				<td><a href="'.$upload.$photo_president .'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View </a></td>	
			</tr>
			<tr>
				<td>Secretary</td>
				<td><a href="'.$upload.$photo_secretary .'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View </a></td>
			</tr>
            ';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			<tr>
				<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
				<td align="right">
					<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
				</td>
			</tr>
	</table>';
?>

  