<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$sdc->query("select * from sdc_form33  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$sdc->query("select * from sdc_form33  where user_id='$swr_id' and uain='$uain'") or die("Error :".$sdc->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$sdc->query("select * from sdc_form33  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else{
	$q=$sdc->query("select * from sdc_form33  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$sdc->error);
}
	
	$results=$q->fetch_array();
	if($q->num_rows > 0){
		$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
		$form_id=$results["form_id"];$drug_name=$results["drug_name"];$staff_manuf=$results["staff_manuf"];
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";
		}else{
			$payment_mode="ONLINE";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('sdc','33');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>FORM-XIII</title>
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>FORM 27-B<br/>'.$form_name.'</h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tbody>	
		<tr>
			<td colspan="2">1.I/We  &nbsp;'.strtoupper($key_person).'&nbsp; of &nbsp;'.strtoupper($unit_name).'&nbsp;hereby apply for the grant/renewal of a licence to manufacture on the premises situated at&nbsp;&nbsp;'.strtoupper($b_dist).'&nbsp;&nbsp; the undermentioned drugs, specified in Schedules C, C(1) and X to the Drugs and Cosmetics Rules, 1945.</td>
		</tr>
		<tr>
			<td width="50%">Names of drugs each substance to be separately specified :</td>
			<td width="50%">'.strtoupper($drug_name).'</td>
		</tr>
		<tr>
			<td >2. The names, qualifications and experience of the expert actually connected with the manufacture and testing of specified products in the manufacturing premises.</td>
			<td >	<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr align="center">
				<td align="center">Sl No </td>
				<td align="center"> Name </td>
				<td align="center">qualification</td>
				<td align="center">Experience</td>			
				<td align="center">Responsible</td>			
			</tr>';
			$part1=$sdc->query("SELECT * FROM sdc_form33_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
					if($row_1["responsible"]=="M"){
								$responsible="MANUFACTURE";
							}else{
								$responsible="TESTING";
							} 
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["qualification"]).'</td>
						<td>'.strtoupper($row_1["experience"]).'</td>
						<td>'.strtoupper($responsible).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table> 	</td>
		</tr>
		<tr>
			<td colspan="2">3.  I/We enclose</td>
		</tr>
		<tr>
			<td colspan="2">(a)A true copy of letter from me/us to the manufacturing  concern whose manufacturing capacity is intended to be utilised by me/us.</td>
		</tr>
		<tr>
			<td colspan="2">(b)A true copy  of a letter from the manufacturing concern that they agree to lend the services of their expert staff, equipment and premises for the manufacture of each item required by me/us and that they will analyse every batch of finished product and maintain the registers of raw materials, finished products and reports of analysis separately in this behalf.</td>
		</tr>
		<tr>
			<td colspan="2">(c)Specimens of labels cartons of the products proposed to be manufactured.</td>
		</tr>
		<tr>
			<td >4.  The premises and plan are ready for inspection/will be ready for inspection on :</td>
			<td >'.strtoupper($staff_manuf).'</td>
		</tr>
		';			
			if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
				$printContents=$printContents.'
				<tr>		   
				<td colspan="2">
					<table border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
						<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
						<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="50%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="50%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
				</tr>
				';}
				if($results["payment_mode"]!=NULL){ 
				$printContents=$printContents.'<tr>		    
				<td colspan="2">
					<table border="0" width="100%">
					<tr><td height="45px" colspan="2">Payment Details :</td></tr>
					<tr><td width="40%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
					if($results["payment_mode"]==0)
					{
						$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
						<td>'.$offline_challan.'</td></tr>';
					}
					$printContents=$printContents.'</table>			
				</td>
			  </tr>'; }
			$printContents=$printContents.'				
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> </td>				
			</tr>						
		</table>';
?>
