<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
			</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form10 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form10 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form10 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form10 where user_id='$swr_id' and active='1'") or die($clm->error);
	}  		
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
        $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
        $b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
        $from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
        $unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

		$q=$clm->query("select * from clm_form10 where user_id=$swr_id and active='1'") or die($clm->error);
		$results=$q->fetch_assoc();
        if($q->num_rows>0){
			$form_id=$results['form_id'];$form_against=$results['form_against'];$order_num=$results['order_num'];$order_date= $results['order_date'];$auth_representative=$results['auth_representative'];$ground_appeal=$results['ground_appeal'];$sub_date=$results['sub_date'];
		
		if($results["form_against"]=="L"){
			$form_against="Legal Metrology Officer";
		}else{
			$form_against="Controller Legal Metrology";
		}
		if($auth_representative=="I"){
			$auth_representative="In person";
		} else {
			$auth_representative="Through an authorized representative";
		}	
	}
    $form_name=$cms->query("select form_name from clm_form_names where form_no='10'")->fetch_object()->form_name;    
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>FORM-4</title>
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
			'.$assamSarkarLogo.'<h2 align="center">FORM-4</h2>
			<h4>'.$form_name.'</h4>
			<center>[SCHEDULE X, Rule 24(1) of the Assam Legal Metrology(Enforcement) Rules,2011]</center>
		</div>                      
		<br/>
	   <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>
				<td colspan="2">1. Form of appeal against an order of a '.strtoupper($form_against).'.</td>
			</tr>
			<tr>
				<td width="50%" valign="top">2. Name and address of the appellant.</td>
				<td>
					<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
						<tr>
							<td width="50%">Full Name </td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
						<tr>
							<td>Street Name 1 </td>
							<td>'.strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2 </td>
							<td>'.strtoupper($street_name2).'</td>
						</tr>
						<tr>
							<td>Vilage/Town </td>
							<td>'.strtoupper($vill).'</td>
						</tr>
						<tr>
							<td>District </td>
							<td>'.strtoupper($dist).'</td>
						</tr>
						<tr>
							<td>Pincode </td>
							<td>'.strtoupper($pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No. </td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>E-Mail ID </td>
							<td>'.$email.'</td>
						</tr>
					</table>
				</td>
			</tr>
			   <tr>
				<td valign="top" >3. No. and date of order of '.strtoupper($form_against).' against which the appeal is preferred</td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Number </td>
						<td>'.strtoupper($order_num).'</td>
					</tr>
					<tr>
						<td>Date </td>
						<td>'.strtoupper($order_date).'</td>
					</tr>
				</table>
				</td>
			</tr>
			 <tr>
				<td  valign="top">4. Whether the appellant desires to be heard in person or through an authorized representative: </td>
				<td>'.strtoupper($auth_representative).'</td>
			</tr>
			 <tr>
				<td  valign="top">5. Grounds of appeal:</td>
				<td>'.strtoupper($ground_appeal).'</td>
			</tr>
			<tr>
				<td width="50%">Place : '.strtoupper($dist).' <br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="right">'.strtoupper($key_person).'<br/>Signature of the Appellant</td>
			</tr>
	</table>';
?>


