<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form5 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form5 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form5 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form5 where user_id='$swr_id' and active='1'") or die($clm->error);
	}       
    $row1=$formFunctions->fetch_swr($swr_id);
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
        $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
        $b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
        $from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
        $unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
        
		$q=$clm->query("select * from clm_form5 where user_id=$swr_id and active='1'") or die($clm->error);
        $results=$q->fetch_assoc();
        if($q->num_rows>0){
            $form_id=$results['form_id'];$repairer_lic=$results["repairer_lic"];$tl_reg_no=$results["tl_reg_no"];$tl_date=$results["tl_date"];$it_reg_no=$results["it_reg_no"];$type_wm=$results["type_wm"];$any_change=$results["any_change"];$op_area=$results["op_area"];$hav_u=$results["hav_u"];$stamp_details=$results["stamp_details"];$state=$results["state"];$lic_fee=$results["lic_fee"];$lic_fee_words=$results["lic_fee_words"];$bank_sub_date=$results["bank_sub_date"];
			if($any_change=="Y"){
				$any_change="YES";
			}else {
				$any_change="NO";
			}
			if($hav_u=="Y"){
				$hav_u="YES";
			}else {
				$hav_u="NO";
			}
			
    }
    $stamp_details = wordwrap($results["stamp_details"], 40, "<br/>", true);
    $form_name=$cms->query("select form_name from clm_form_names where form_no='5'")->fetch_object()->form_name; 
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form LR-II</title>
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
</style>
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
        '.$assamSarkarLogo.'<h4>Form LR-II</h4>
        <p  style="text-align:center"> SCHEDULE II B </p>
		<p  style="text-align:center"> [See rule 11 (2)] </p>
        <h4>'.$form_name.'</h4>
        </div>
		<br/>
            <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr>
                    <td width="50%">1. (a) Name of the repairing concern/ person seeking renewal of license:</td>
                    <td>'.strtoupper($key_person).'</td>
                </tr>
                <tr>
                    <td width="50%" valign="top" style="text-indent:14px;">(b) Address of the repairing concern/ person seeking renewal of license:</td>
					<td>
						<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
							<tr>
									<td width="50%">Street Name 1</td>
									<td>'.strtoupper($street_name1).'</td>
							</tr>
							<tr>
									<td>Street Name 2</td>
									<td>'.strtoupper($street_name2).'</td>
							</tr>
							<tr>
									<td>Village/Town</td>
									<td>'.strtoupper($vill).'</td>
							</tr>
							<tr>
									<td>District</td>
									<td>'.strtoupper($dist).'</td>
							</tr>
							<tr>
									<td>Pincode</td>
									<td>'.strtoupper($pincode).'</td>
							</tr>
							
							<tr>
									<td>Mobile</td>
									<td>+91 - '.strtoupper($mobile_no).'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>2. Repairer&apos;s License Number :</td>
					<td>'.strtoupper($repairer_lic).'</td>
				</tr>
				<tr>
					<td colspan="2">3. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
				</tr>
                <tr>
					<td colspan="2">
						<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
								<tr>
									<td width="10%">Sl No.</td>
									<td width="20%">Name</td>
									<td width="20%">Father&apos;s/Spouse&apos;s Name</td>
									<td width="20%">Address</td>
									<td width="10%">Pincode</td>
									<td width="20%">Contact No</td>
								</tr>';
								$results1=$clm->query("select * from clm_form5_members where form_id='$form_id'") or die("Error : ".$clm->error);
								$sl=1;
								while($rows=$results1->fetch_object()){
									$printContents=$printContents.'
									<tr>
										<td>'.$sl.'</td>
										<td>'.strtoupper($rows->name).'</td>
										<td>'.strtoupper($rows->family_name).'</td>
										<td>'.strtoupper($rows->address).'</td>
										<td>'.strtoupper($rows->pincode).'</td>
										<td>'.strtoupper($rows->contact).'</td>
									</tr>';
									$sl++;
								}
								$printContents=$printContents.'
						</table>
					</td>
				</tr>
				<tr>
					<td>4. (a) Registration number of current shop/establishment/ Municipal Trade License: </td>
					<td>'.strtoupper($tl_reg_no).'</td>
				</tr>
				<tr>
					<td>(b) Date of current shop/establishment/ Municipal Trade License: </td>
					<td>'.strtoupper($tl_date).'</td>
				</tr>
				<tr>
					<td>5. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
					<td>'.strtoupper($it_reg_no).'</td>
				</tr>
				<tr>
					<td>6.(a) The type of weights and measures repaired as per license granted: </td>
					<td>'.strtoupper($type_wm).'</td>
				</tr>
				<tr>
					<td>(b) Do you propose any change? </td>
					<td>'.strtoupper($any_change).'</td>
				</tr>
				<tr>
					<td>7. Area in which you are operating: </td>
					<td>'.strtoupper($op_area).'</td>
				</tr>
				<tr>
					<td>8. Have you sufficient stock of loan/test weights, etc.: </td>
					<td>'.strtoupper($hav_u).'</td>
				</tr>
				<tr>
					<td>9. Please give details with particulars of stamping: </td>
					<td>'.strtoupper($stamp_details).'</td>
				</tr>
				<tr>
					<td colspan="2"><center><b>To be certified by the applicant(s)</b></center></td>
				</tr>
				<tr>
					<td colspan="2">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state '.strtoupper($state).' .Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.</br>&emsp;&emsp;&emsp;I/We have deposited the Scheduled licence fees of Rs. '.strtoupper($lic_fee).' (Rupees '.strtoupper($lic_fee_words).') to the Sub- Treasury/ Bank on '.strtoupper($bank_sub_date).' and the original challan is enclosed.</br>All the information furnished above is true to the best of my/ our knowledge.</td>
				</tr>
				
			</table>
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
				<tbody>
					 <tr>
						<td width="50%">Place : '.strtoupper($dist).'<br/> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						<td align="center">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).' </td>
					</tr> 
				</tbody>
			</table>';
?>


