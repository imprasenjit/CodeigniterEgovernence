<?php
$dept="doa";
$form="28";
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
		$form_id=$results["form_id"];
	}
	
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form '.$form.'</title>
	<style>
	input, textarea { 
	text-transform: uppercase;
	}
	.header{
	width: 100%;
	height: 130px;
	font-weight: bold;
	}
	.main_body {
	height: 700px;
	width: 100%;
	}
	#form1 table {
	vertical-align: middle;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';       
	}else{
    $printContents='';
	}	
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div><br/>
	
  	<table class="table table-bordered table-responsive">
  	    
		<tr>
			<td colspan="2">1. Name , address and status Of the applicant :</td>
		</tr>
		<tr>
			<td>Name of the applicant</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">Address Of the applicant :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2.Status of the Applicant : </td>
			<td>'.$status_applicant.'</td>
		</tr>
		<tr>
			<td valign="top">3. Address of the premises where the manufacturing activity will be done :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">4. Name of the insecticides with their registration number and date for which manufacturing license is applied:</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center">
				<th>Slno</th>
				<th>Name of the insecticides</th>
				<th>Registration number</th>
				<th>Date Of Registration</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM  ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name_insecticides"]).'</td>
						<td>'.strtoupper($row_1["reg_number"]).'</td>
						<td>'.strtoupper($row_1["reg_date"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> </td>
		</tr>'
		;
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		<tr>
			<td colspan="2">
				I have read terms and conditions of eligibility for submission of memorandum of intimation and undertake the same will be accompanied by me and in token of the same; I have signed the same and is enclosed herewith.
			</td>
		</tr>
		<tr>
			<td>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> :</strong> '.strtoupper($dist).' </td>
			<td align="right">Signature of the Applicant<strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>			
	</table>	
		';
?>