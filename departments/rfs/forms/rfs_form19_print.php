<?php
$dept="rfs";
$form="19";
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
	
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	$land_type=$row1['w_l'];$mouza=$row1['mouza'];$patta_no=$row1['pattano'];$dag_no=$row1['dagno'];$pan_doc=$row1['pan_doc'];$ubin=$row1['ubin'];
	$circle=$row1['revenue'];$area=$b_street_name3." ,".$b_street_name4;
	
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$sector_classes_b=$row1['sector_classes_b'];
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];	
	
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative otheriety";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Asotheriation of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$regn_no=$results["regn_no"];$date_registration=$results["date_registration"];
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
				<td>2.Registration No </td>
				<td>'.strtoupper($regn_no).'</td>
			</tr>
			<tr>
				<td>3.Date of Registration</td>
				<td>'.strtoupper($date_registration).'</td>
			</tr>
			<tr>
				<td colspan="2">4.Address of the Society.</td>
			</tr>
			<tr>
				<td colspan="2">
				<table class="table table-bordered table-responsive">
					<thead>			
						<tr>
							<th>Sl No.</th>
							<th>Old address of the society	</th>
							<th>Address of the society proposed for	</th>
						</tr>
					</thead>
					';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_object()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows->old_address).'</td>
							<td>'.strtoupper($rows->address_socity).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
				</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">5. A list of members of the Executive Committee with their full name (in block letter), address and occupation. :</td>
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
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
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

  