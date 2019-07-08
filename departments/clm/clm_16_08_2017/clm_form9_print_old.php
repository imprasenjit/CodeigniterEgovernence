<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form9 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form9 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form9 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form9 where user_id='$swr_id' and active='1'") or die($clm->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$clm->query("select * from clm_form9 where user_id=$swr_id and active='1'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];	
	$meeting_date=$results['meeting_date'];$meeting_place=$results['meeting_place'];	
	$form_name=$formFunctions->get_formName('clm','9');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 9</title>
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
  			'.$assamSarkarLogo.'<h4>FORMAT FOR NOMINATION OF THE DIRECTOR BY THE COMPANY UNDER SUB-

									SECTION (2) OF THE LEGAL METROLOGY ACT, 2009<br/>'.$form_name.'</h4>
		</div><br/>
      <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr >
			<td colspan="2" class="form-inline">
				&emsp;&emsp;Notice is hereby given that Shri/Smt. / Ms '.strtoupper($key_person).'Director of the '.strtoupper($unit_name).' '.strtoupper($b_dist).' (name and address of the company) has been nominated by the company by a Resolution passed at their meeting held on '.strtoupper($meeting_date).' at '.strtoupper($meeting_place).' to be charge of, and be responsible for the conduct of business of the company or any establishment/ branch/unit thereof and authorized to exercise all such powers and take all such steps as may be necessary or expedient to prevent the commission any offence by the said company under the Legal Metrology Act, 2009.</td>
		</tr>
		<tr>
			<td colspan="2" class="form-inline">
				&emsp;&emsp;&emsp;&emsp;Shri/Smt./Ms'.strtoupper($key_person).'Designation'.strtoupper($status_applicant).' has accepted the said nomination and copy of said acceptance is enclosed herewith.
			</td>
		</tr>
		<tr>
			<td colspan="2">
				&emsp;&emsp;&emsp;&emsp;A certified copy of the said Resolution is also enclosed.</td>
		</tr>
		<tr>
			<td>Date : <label>'.date('d-m-Y',strtotime($results["sub_date"])).'</label><br/>
				Place:<label>'.strtoupper($dist).'</label></td>
			<td align="right"> <label>'.strtoupper($key_person).'</label><br/>
				Managing Director/Secretary</br>(name of the company)</td>
		</tr>
		<tr>
			<td colspan="2">Note: Score out the portion which is not applicable.</td>
		</tr>
		<tr>
			<td colspan="2">&emsp;&emsp;&emsp;&emsp;I accept the above nomination in pursuance of sub – section (2) of Section 49 of the Legal Metrology Act, 2009 and Rule 29 of the Legal Metrology (General) Rules, 2011 made there under.</td>
		</tr>';}
            $printContents=$printContents.'     
        <tr>
			<td>Date : <label>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</label><br/>
			Place:<label> '.strtoupper($dist).'</label></td>
			<td align="right"> <label>'.strtoupper($key_person).'</label><br/>
			Director of</br>(Name of the company)</td>
		</tr>
	</table>';
?>