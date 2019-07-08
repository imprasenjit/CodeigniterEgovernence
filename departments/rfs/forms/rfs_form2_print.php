<?php
$dept="rfs";
$form="2";
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
		$form_id=$results["form_id"];
		$reg_uain=$results["reg_uain"];
		$date_f_alt=$results["date_f_alt"];$firm_name_alt=$results["firm_name_alt"];
		if(!empty($results['alteration_address'])){
			$alteration_address=json_decode($results['alteration_address']);
			$alteration_address_locality=$alteration_address->locality;$alteration_address_vill=$alteration_address->vill;$alteration_address_po=$alteration_address->po;$alteration_address_ps=$alteration_address->ps;$alteration_address_dist=$alteration_address->dist;$alteration_address_pincode=$alteration_address->pincode;$alteration_address_mobile=$alteration_address->mobile;$alteration_address_email=$alteration_address->email;
		}else{
			$alteration_address_locality="";$alteration_address_vill="";$alteration_address_po="";$alteration_address_ps="";$alteration_address_dist="";$alteration_address_pincode="";$alteration_address_mobile="";$alteration_address_email="";
		}
		if(!empty($results['other_address'])){
			$other_address=json_decode($results['other_address']);
			$other_address_locality=$other_address->locality;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
		}else{
			$other_address_locality="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		}
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
			<td valign="top" width="50%">Choose the UAIN of the Registered Firm :</td>
			<td>'.strtoupper($reg_uain).'</td>
		</tr>
  		<tr>  				
			<td valign="top" width="50%">1. Date of Alteration</td>
			<td>'.date("d-m-Y",strtotime($date_f_alt)).'</td>
		</tr>
		<tr>  				
			<td valign="top" width="50%">2. Alteration in the name of the firm  </td>
			<td>'.strtoupper($firm_name_alt).'</td>
		</tr>
		<tr>
			<td valign="top">3. Alteration in the Principal Place of Business </td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Locality</td>
						<td>'.strtoupper($alteration_address_locality).'</td>
				</tr>
				<tr>
						<td>Village/town/city </td>
						<td>'.strtoupper($alteration_address_vill).'</td>
				</tr>
				<tr>
						<td> Post Office </td>
						<td>'.strtoupper($alteration_address_po).'</td>
				</tr>
				<tr>
						<td>Police Station</td>
						<td>'.strtoupper($alteration_address_ps).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($alteration_address_dist).'</td>
				</tr>
				<tr>
						<td>Pin code</td>
						<td>'.strtoupper($alteration_address_pincode).'</td>
				</tr>
				<tr>
						<td>Mobile No.</td>
						<td>'.strtoupper($alteration_address_mobile).'</td>
				</tr>
				<tr>
						<td>Email ID</td>
						<td>'.$alteration_address_email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">4. Alteration in the Address of any other place where the Firms carries its business</td>
			<td>
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Locality</td>
						<td>'.strtoupper($other_address_locality).'</td>
				</tr>
				<tr>
						<td>Village/town/city </td>
						<td>'.strtoupper($other_address_vill).'</td>
				</tr>
				<tr>
						<td> Post Office </td>
						<td>'.strtoupper($other_address_po).'</td>
				</tr>
				<tr>
						<td>Police Station</td>
						<td>'.strtoupper($other_address_ps).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($other_address_dist).'</td>
				</tr>
				<tr>
						<td>Pin code</td>
						<td>'.strtoupper($other_address_pincode).'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">5. Original Registration Deed of Partnership</td>
		</tr>
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
		<tr>
			<td colspan="2">6. Rectification Registration Deed of Partnership</td>
		</tr>
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
		<tr>
			<td colspan="2">7. Photos of the Partners</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<thead>
				<tr>
					<th>Sl No.</th>
					<th>Full Name of partners</th>
					<th>Upload Photo</th>
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
						<td>'.strtoupper($rows->member_name).'</td>
						<td>'.$upload_photo .'</td>
						
					</tr>';
					$sl++;
				}
				$printContents=$printContents.'</tbody>
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">8. Certificate of Sales Tax or Income Tax</td>
		</tr>
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
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
        <tr>
			<td> Date : <strong>'.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
			<td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
				Signature of the Applicant               
                </td>
        </tr>
</table>
</body>
</html>';
?>