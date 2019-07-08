<?php 
$dept="rfs";
$form="4";
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
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
			
		if(!empty($results['registration_deed'])){
			$registration_deed=json_decode($results['registration_deed']);
			$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
		}else{
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		
		#### PART II####
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}
	
	$q1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
	if($q1->num_rows>0){
		$results1=$q1->fetch_assoc();
		$form_id=$results1['form_id'];
		$member_f_address=$results1['member_f_address'];$member_p_name=$results1['member_p_name'];$member_p_address=$results1['member_p_address'];$remarks=$results1['remarks'];$upload_photo=$results1['upload_photo'];
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
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
		</div><br/>
	   <table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">1. Changes in the name and address of the Partners of the Firm</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
				<tr>
					<th rowspan="2">Sl No.</th>
					<th colspan="2">Former</th>
					<th colspan="2">Present</th>
					<th rowspan="2">Remark</th>
					<th rowspan="2">Upload Photo</th>
				</tr>
				<tr>
					<th>Name of the Partners</th>
					<th>Address of the Partners</th>
					<th>Name of the Partners</th>
					<th>Address of the Partners</th>
				</tr>
				</thead>
				<tbody>';
				$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
				$sl=1;
				while($rows=$results1->fetch_object()){
					
					if($rows->upload_photo !="") $upload_photo='<img style="padding:5px" width="110" height="140" src="'.$server_url.'departments/rfs/forms/upload/'.$rows->upload_photo .'"/>';
						else $upload_photo="";
						
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->member_f_name).'</td>
						<td>'.strtoupper($rows->member_f_address).'</td>
						<td>'.strtoupper($rows->member_p_name).'</td>
						<td>'.strtoupper($rows->member_p_address).'</td>
						<td>'.strtoupper($rows->remarks).'</td>
						<td>'.$upload_photo .'</td>
					</tr>';
					$sl++;
				}
				$printContents=$printContents.'</tbody>
			</table>
			</td>
	</tr>
	<tr>
		<td valign="top">2. Registration Deed of Partnership </td>
		<td width="50%">
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Deed No.</td>
						<td> '.strtoupper($registration_deed_no).'</td>
				</tr>
				<tr>
						<td>Date </td>
						<td> '.strtoupper($registration_deed_dte).'</td>
				</tr>
				<tr>
						<td>Place of Deed Registration  </td>
						<td> '.strtoupper($registration_deed_place).'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td valign="top">3. Rectification Registration Deed of Partnership</td>
			<td width="50%">
				<table class="table table-bordered table-responsive">
					<tr>
							<td>Deed No.</td>
							<td> '.strtoupper($rectification_reg_no).'</td>
					</tr>
					<tr>
							<td>Date</td>
							<td> '.strtoupper($rectification_reg_dte).'</td>
					</tr>
					<tr>
							<td>Place of Deed Registration</td>
							<td> '.strtoupper($rectification_reg_place).'</td>
					</tr>
				</table>
			</td>
	</tr>
	<tr>
		<td valign="top">4. Certificate of Sales Tax or Income Tax</td>
		<td width="50%">
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Certificate No.</td>
						<td> '.strtoupper($tax_certificate_no).'</td>
				</tr>
				<tr>
						<td>Issued by</td>
						<td> '.strtoupper($tax_certificate_issue).'</td>
				</tr>
				<tr>
						<td>Date of Issue</td>
						<td> '.strtoupper($tax_issuedate).'</td>
				</tr>
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