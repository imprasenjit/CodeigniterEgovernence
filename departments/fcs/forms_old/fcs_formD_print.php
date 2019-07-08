<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fcs->query("select * from fcs_form4 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fcs->query("select * from fcs_form4 where uain='$uain' and user_id='$swr_id'") or die($fcs->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fcs->query("select * from fcs_form4 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else{
		$q=$fcs->query("select * from fcs_form4 where user_id='$swr_id' and active='1'") or die($fcs->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

	$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;

	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	$results=$q->fetch_assoc();
	if($q->num_rows>0)
	{				
		$form_id=$results["form_id"];$auth_address=$results["auth_address"];$license_no=$results["license_no"];$expiry_date=$results["expiry_date"];$license_stands=$results["license_stands"];$renewal_desired=$results["renewal_desired"];$details_action=$results["details_action"];$file1=$results["file1"];
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($file1);
		}else{
			$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		}
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		
		$form_name=$formFunctions->get_formName('fcs','4');
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		
	}
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form IV</title>
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>PROFORMA &#39;B&#39; <br/>[(See Clause 2 (j) ] 5<br/>
  			'.$form_name.'</h4>
	</div><br/> 
  	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
  	    <tr>
            <td colspan="2">
			<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
				<tr>
					<td colspan="2">
							<p>The Licensing Authority<br/>
							<b> '.strtoupper($auth_address).' </b></p>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<p>Sir,</p><br/>
						<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I, hereby apply for renewal of my license no.<b> '.strtoupper($license_no).'</b> &nbsp; issued under the Assam Trade Article (Licensing &amp; Control) Order, 1982. The required Particulars are given hereunder -<br/><br/></p>
					</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td width="50%" valign="top">1. Date on which the licence expire</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">2. Name in which licence stands</td>
			<td >'.strtoupper($license_stands).'</td>
		</tr>
		<tr>
			<td>3. For how many years the renewal is desired</td>	
			<td width="50%">'.strtoupper($renewal_desired).'</td>				
		</tr>   
		<tr>
			<td>4. Details of the action, if any taken against the licensee during the last 3 (three) years for contravention of an order issued under the Essential Commodities Act, 1953.</td>
			<td width="50%">'.strtoupper($details_action).'</td>
		</tr>
		<tr>
				<td colspan="2" height="50px"><font color="red">Checklist of the Documents</font></td>
		</tr>					
		<tr>
				<td>A copy of Original licence </td>
				<td>'.$val1.'</td>
		</tr>
		<tr>
			<td colspan="2">I Shri <b>'.strtoupper($key_person).'</b> hereby declare that the particulars mentioned above are correct and true to best of my knowledge and belief, nothing has been concealed therein.</td>
		</tr>
		<tr>
			<td style="border:none">Place<strong> :</strong> '.strtoupper($dist).'</td>
			<td style="border:none"  >Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td style="border:none">Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td style="border:none">&nbsp;</td>
		</tr>
			
	</table>
	';
?>