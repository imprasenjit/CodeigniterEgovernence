<?php
$dept="doa";
$form="13";
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
	$form_id=$results["form_id"];$is_convicted=$results["is_convicted"];$is_convicted_details=$results["is_convicted_details"];$seeds_detail=$results["seeds_detail"];
				
	if(!empty($results["sale"])){
		$sale=json_decode($results["sale"]);
		$sale_sn1=$sale->sn1;$sale_sn2=$sale->sn2;$sale_v=$sale->v;$sale_p=$sale->p;$sale_mno=$sale->mno;$sale_d=$sale->d;
	}else{				
		$sale_sn1="";$sale_sn2="";$sale_v="";$sale_d="";$sale_p="";$sale_mno="";
	}	
	if(!empty($results["storage"])){
		$storage=json_decode($results["storage"]);
		$storage_sn1=$storage->sn1;$storage_sn2=$storage->sn2;$storage_v=$storage->v;$storage_p=$storage->p;$storage_mno=$storage->mno;$storage_d=$storage->d;
	}else{				
		$storage_sn1="";$storage_sn2="";$storage_v="";$storage_d="";$storage_p="";$storage_mno="";
	}					
	if($results["is_convicted"]=="Y"){
		$is_convicted="YES";
	}else{
		$is_convicted="NO";
		$is_convicted_details=" ";			
	}
	$seeds_detail = wordwrap($results["seeds_detail"], 40, "<br/>", true);
}

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

$printContents='
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
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
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center">
  	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/> 
<table class="table table-bordered table-responsive">
	<tr>
		<td>The Registering Authority<br/>Government of Assam</td>
		<td>Place : '.strtoupper($dist).'</td>
	</tr>
	<tr>
		<td width="50%">1. i. Name of the applicant :</td>
		<td> '.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td>ii. Postal address of the applicant :</td>
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
			<td colspan="2">2. Place of business (please give the accurate address) : </td>	
	</tr>   
	<tr>
		<td > i. For sale  :</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Street Name 1  :</td>
					<td>'.strtoupper($sale_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 : </td>
					<td>'.strtoupper($sale_sn2).'</td>
				</tr>
				<tr>
					<td>Village/ Town : </td>
					<td>'.strtoupper($sale_v).'</td>
				</tr>
				<tr>
					<td>District : </td>
					<td>'.strtoupper($sale_d).'</td>
				</tr>
				<tr>
					<td>Pincode : </td>
					<td>'.strtoupper($sale_p).'</td>
				</tr>
				<tr>
					<td>Mobile No. : </td>
					<td>'.strtoupper($sale_mno).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td> ii. For Storage :</td>
			<td><table class="table table-bordered table-responsive">
				<tr>
					<td >Street Name 1  :</td>
					<td >'.strtoupper($storage_sn1).'</td>
				</tr>
				<tr>
					<td>Street Name 2 : </td>
					<td>'.strtoupper($storage_sn2).'</td>
				</tr>
				<tr>
					<td>Village/ Town : </td>
					<td>'.strtoupper($storage_v).'</td>
				</tr>
				<tr>
					<td>District : </td>
					<td>'.strtoupper($storage_d).'</td>
				</tr>
				<tr>
					<td>Pincode : </td>
					<td>'.strtoupper($storage_p).'</td>
				</tr>
				<tr>
					<td>Mobile No. : </td>
					<td>'.strtoupper($storage_mno).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td>3. Select the appropriate category of business  :</td>
			<td>'.strtoupper($Type_of_ownership).'</td>
	</tr>
	<tr>
			<td colspan="2">4. Name and Address of the Proprietor/Partner/Manager/Karta  :</td>
	</tr>
	<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
					<tr>
						<th>Sl No.</th>
						<th>Name</th>
						<th>Address</th>
						<th>Contact No</th>
					</tr>';
					$results13=$formFunctions->executeQuery($dept,"select * from  ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results13->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->name).'</td>
							<td>'.strtoupper($rows->address).'</td>
							<td>'.strtoupper($rows->contact).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
			</table></td>
	</tr> 
	<tr>
			<td>5. Was the applicant ever convicted under the essential commodities Act. 1955 (10 of 1955) or any order issued under during the last three years preceding the date of  application.</td>
			<td>'.strtoupper($is_convicted).'</td>
	</tr>
	<tr>
			<td>if yes,  Give Details </td>
			<td>'.strtoupper($is_convicted_details).'</td>
	</tr>
	<tr>
			<td>6. Give the details of seeds to be handled :</td>
			<td>'.strtoupper($seeds_detail).'</td>
	</tr>
	<tr>
			<td colspan="2">7. Declaration:</td>
	</tr>
	<tr>
			<td colspan="2">a. I/We declare that the information given above is true to the best of my/our knowledge and belief and no part thereof is false.</td>
	</tr>
	<tr>
			<td colspan="2">b. I/We have carefully read the terms and conditions of the Licence given in Form &quot;B&quot; appended to the seeds (control) order 1983 and agreed to abide by them.</td>
	</tr>';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	
	<tr>
		<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
		<td align="right">Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
	</tr>
</table>
';
?>