<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$tcp->query("select * from tcp_form7  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$tcp->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$tcp->query("select * from tcp_form7  where user_id='$swr_id' and uain='$uain'") or die("Error :".$tcp->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$tcp->query("select * from tcp_form7 where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$tcp->error);
}else{
	$q=$tcp->query("select * from tcp_form7 where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$tcp->error);
}
	$row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode;
	
	$results=$q->fetch_assoc();
	
	if($q->num_rows>0){
		####### Part 1######
			$form_id=$results["form_id"];
			$address=$results["address"];$conforms_to=$results["conforms_to"];$inst_address =$results["inst_address"];$zone =$results["zone"];
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
	$form_name=$formFunctions->get_formName('tcp','7');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form</title>
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
  			'.$assamSarkarLogo.'<h4><br/><br/>'.$form_name.'</h4>
		</div><br/>
      <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		
		<tr>
			<td colspan="2">
			Subject: Self Certification of ground based tower/composite structure (roof top tower + building) for communication network.<br/><br/>
										
										
			It is certified that the Ground based tower/composite structure (roof top tower + Building), a part of our communication network and located at &nbsp;'.strtoupper($address).' &nbsp;conforms to &nbsp;'.strtoupper($conforms_to).' &nbsp;GR issued by TEC, DoT/design approved by &nbsp;'.strtoupper($inst_address).'&nbsp;(name and address of the institute, etc.). The tower/composite structure (rooftop tower + building) falling under seismic zone&nbsp;'.strtoupper($zone).'&nbsp;is compliant to the latest BIS code IS 1893 and other provisions envisaged in the instructions issued by DoT from time to time. The relevant particulars are as per datasheet enclosed.</td>
		</tr>
		
		 ';
		
		$printContents=$printContents.'
		<tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="center">Signature:'.strtoupper($key_person).'</td>
		</tr>
	</table>';
?>