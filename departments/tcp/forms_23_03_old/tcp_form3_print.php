<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$tcp->query("select * from tcp_form3 where user_id='$swr_id' and form_id='$form_id'") or die($tcp->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$tcp->query("select * from tcp_form3 where uain='$uain' and user_id='$swr_id'") or die($tcp->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$tcp->query("select * from tcp_form3 where user_id='$swr_id' and form_id='$form_id'") or die($tcp->error);
	}else{
		$q=$tcp->query("select * from tcp_form3 where user_id='$swr_id' and active='1'") or die($tcp->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
  $row1=$row1=$formFunctions->fetch_swr($swr_id);
  
  $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$pan_no=$row1['pan_no'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$pan_no=$row1['pan_no'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
  
  $from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
  
  $unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$tcp->query("select * from tcp_form3 where user_id='$swr_id' and active='1'") or die($tcp->error);
    $results=$q->fetch_assoc();
		if($q->num_rows>0)
		{			
			$form_id=$results["form_id"];
			$ref_no=$results["ref_no"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$officer_name=$results["officer_name"];$add_line1=$results["add_line1"];$add_line2=$results["add_line2"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$owner_name=$results["owner_name"];$owner_address=$results["owner_address"];
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
		}
	if($results["payment_mode"]==0){
		$payment_mode="OFFLINE";
		$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
	}else{
		$payment_mode="ONLINE";
	}
	 $form_name=$cms->query("select form_name from tcp_form_names where form_no='3'")->fetch_object()->form_name; 
	 $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 3</title>
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
	<br/><br/>
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM 3</h4>
        <h4>'.$form_name.'</h4>
	</div>
	<br/><br/>
	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
	<tr>
		<td width="50%">Reference No. :</td>
		<td width="50%"> '.strtoupper($ref_no).'</td> 
	</tr>
	<tr>
		<td>Owner&apos;s Name: '.strtoupper($key_person).'</td>
		<td>Location : '.strtoupper($dist).'</td>
	</tr>
	<tr>
		<td>Submitted on: '.strtoupper($submit_dt).'</td>
		<td>Received on: '.strtoupper($receive_dt).'</td>
	</tr>
	<tr>
		<td colspan="2">To,<br/>
			The &nbsp;'.strtoupper($officer_name).'<br/>
			&nbsp;'.strtoupper($add_line1).'<br/>
			&nbsp;'.strtoupper($add_line2).'<br/>
			Sir,<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby inform you that the work of execution of the building as per approved plan, working drawing and structural drawings has reached the first storey level and is executed under our supervision.<br/>	We declare that the amended plan is not necessary at this stage.
		</td>
	</tr>
	<tr>
		<td colspan="4">Yours faithfully,</td>
	</tr>
	<tr>
		<td>Name of the Construction Engineer on Record :</td>
		<td>Name of the Owner/Development/Builder :</td>
	</tr>
	<tr>
		<td>'.strtoupper($engineer).' </td>
		<td >'.strtoupper($owner_name).'</td>
		
	</tr>
	<tr>
		<td>Address of the  Construction Engineer on Record :</td>
		<td>Address of the Owner/Development/Builder :</td>
	</tr>
	<tr>
		<td>'.strtoupper($engineer_address).' </td>
		<td >'.strtoupper($owner_address).'</td>
		
	</tr>
	<tr>
		<td >Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
		<td >Signature :'.strtoupper($key_person).'</td>
	</tr>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>
	