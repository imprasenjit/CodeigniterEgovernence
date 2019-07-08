<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form6 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form6 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form6 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form6 where user_id='$swr_id' and active='1'") or die($clm->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$clm->query("select * from clm_form6 where user_id=$swr_id and active='1'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];$total_turnover =$results['total_turnover'];	
	$license_no=$results['license_no'];
	$date=$results['date'];
	if($date!="" && $date!="0000-00-00"){
		$date = date('d-m-Y',strtotime($date));
	}else{
		$date="";
	}
	$reg_no=$results['reg_no'];
	$reg_date=$results['reg_date'];
	if($reg_date!="" && $reg_date!="0000-00-00"){
		$reg_date = date('d-m-Y',strtotime($reg_date));
	}else{
		$reg_date="";
	}
	$tax_reg =$results['tax_reg'];$manu_details =$results['manu_details'];$state =$results['state'];$license_fee =$results['license_fee'];$license_fee_words =$results['license_fee_words'];$license_fee_date =$results['license_fee_date'];
	if($license_fee_date!="" && $license_fee_date!="0000-00-00"){
		$license_fee_date = date('d-m-Y',strtotime($license_fee_date));
	}else{
		$license_fee_date="";
	}
	if(!empty($results['categories'])){
			$categories=json_decode($results['categories']);
			$categories_w=$categories->w;$categories_m=$categories->m;$categories_wi=$categories->wi;$categories_mi=$categories->mi;
		}else{
			$categories_w="";$categories_m="";$categories_wi="";$categories_mi="";
		}		
	}
	$form_name=$formFunctions->get_formName('clm','6');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form LD-II</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
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
  			'.$assamSarkarLogo.'<h4>Form LD-II<br/>SCHEDULE II B<br/>[See rule 11 (2)]<br/>'.$form_name.'</h4>
		</div><br/>
      <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
  		<tr>  				
			<td valign="top" width="50%">1. Name of the establishment/shop/person seeking the renewal of license:</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
  	<tr>
  		<td valign="top">2. Dealer&apos;s License Number:</td>
  		<td valign="top"> '.strtoupper($license_no).'</td>
  	</tr>
	<tr>
  		<td valign="top">	3. Date of Establishment:</td>
  		<td valign="top"> '.strtoupper($date).'</td>
  	</tr>
	<tr>
		<td colspan="2" >4. Name(s) and address(s) along with their father&apos;s husband&apos;s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
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
					$results1=$clm->query("select * from clm_form6_members where form_id='$form_id'") or die("Error : ".$clm->error);
					$sl=1;
					while($rows=$results1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows["name"]).'</td>
							<td>'.strtoupper($rows["family_name"]).'</td>
							<td>'.strtoupper($rows["address"]).'</td>
							<td>'.strtoupper($rows["pincode"]).'</td>
							<td>'.strtoupper($rows["contact"]).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>5. (a) Registration number of shop/establishment/current Municipal Trade License:</td>
		<td>'.strtoupper($reg_no).'</td>
	</tr>
	<tr>
		<td>Total value of transactions / turnover :</td>
		<td>'.strtoupper($total_turnover).'</td>
	</tr>
	<tr>
		<td>5. (b) Date of shop/establishment/current Municipal Trade License:</td>
		<td>'.strtoupper($reg_date).'</td>
	</tr>
	
	<tr>
		<td>6. Categories of weights and measures sold at present:</td>
		<td>(i)Weights : '.strtoupper($categories_w).'<br/>(ii)Measures : '.strtoupper($categories_m).'<br/>(iii)Weighing Instruments : '.strtoupper($categories_wi).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($categories_mi).'</td>
	</tr>
	<tr>
		<td>7. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
		<td>'.strtoupper($tax_reg).'</td>
	</tr>
	<tr>
		<td>8. Are you intending to import weights and measures etc.from places outside the State/Country? If so, indicate Sources of supply from the State(s)/Country(s).(Give details of manufacturer’s trade mark/monogram and his licence number.):</td>
		<td>'.strtoupper($manu_details).'</td>
	</tr>
	<tr >
		<td colspan="2" align="center">
  		<h4>To be certified by the applicant(s)</h4>
		<br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state '.strtoupper($state).' . 
		Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.</br>
		<br/>I/We have deposited the Scheduled licence fees of Rs. '.strtoupper($license_fee).' (Rupees) '.strtoupper($license_fee_words).' to the Sub- Treasury/ Bank on '.strtoupper($license_fee_date).' and the original challan is enclosed.</br>All the information furnished above is true to the best of my/ our knowledge.</td>
	</tr>  
        <tr>
			<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td  align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>