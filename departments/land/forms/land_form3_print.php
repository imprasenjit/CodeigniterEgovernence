<?php
   if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$land->query("select * from land_form3 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$land->query("select * from land_form3 where uain='$uain' and user_id='$swr_id'") or die($land->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$land->query("select * from land_form3 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else{
		$q=$land->query("select * from land_form3 where user_id='$swr_id' and active='1'") or die($land->error);
	} 
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$pan_no=$row1['pan_no'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];$pattano=$row1['pattano'];$unit_name=$row1['Name'];$dagno=$row1['dagno'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$land->query("select * from land_form3 where user_id='$swr_id' and active='1'") or die($land->error);
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];   
	$father_name=$results["father_name"];$adhar_crd=$results["adhar_crd"];$registered_office=$results["registered_office"];$remarks=$results["remarks"];$nature_deed=$results["nature_deed"];$petitioner_deed=$results["petitioner_deed"];$year_inspection=$results["year_inspection"];     
	$file1=$results["file1"];$file2=$results["file2"];$area_land=$results["area_land"];$sub_date=$results["sub_date"];
	if($sub_date==NULL) $sub_date=date("d-m-Y");
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);	
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id); 
	}
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
	}else{
	$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	if($results["payment_mode"]==0){
		$payment_mode="OFFLINE";
		$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
	}else{
		$payment_mode="ONLINE";
	}
	$form_name=$cms->query("select form_name from land_form_names where form_no='3'")->fetch_object()->form_name;    
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
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM NO. 3</h4>
        <p  style="text-align:center"> Department: Revenue</p>
        <h4>'.$form_name.'</h4>
        </div><br/>
		<table class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse"  border="1"  >
		<tr><td colspan="2"><b>Applicant&apos;s Details</b></td></tr>
		<tr>
            <td style="width:50%"> Applicant&rsquo;s Name </td>
            <td style="width:50%"> '.strtoupper($key_person).'</td>
		</tr>
		<tr>
            <td> Mobile Number</td>
            <td> '.strtoupper($mobile_no).'</td>
        </tr>    
        <tr>
            <td>Father&rsquo;s Name</td>
            <td>'.strtoupper($father_name).'</td>
		</tr>
		<tr>
            <td>Mail Id </td>
            <td>'.$b_email.'</td>
        </tr>
        <tr>
            <td>Pan Number</td>
            <td>'.strtoupper($pan_no).'</td>
		</tr>
		<tr>
            <td>Aadhar card Number </td>
            <td>'.strtoupper($adhar_crd).'</td>
        </tr>
        <tr>
            <td colspan="2"><b>Enterprise’s Address</b></td>
        </tr>
        <tr>
            <td>Street Name 1</td>
            <td>'.strtoupper($b_street_name1).'</td>
		</tr>
		<tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($b_street_name2).'</td>
        </tr>
        <tr>
            <td>State</td>
            <td>ASSAM</td>
		</tr>
		<tr>
            <td>District</td>
            <td>'.strtoupper($b_dist).'</td>
        </tr>
        <tr>
            <td>Sub-division</td>
            <td>'.strtoupper($b_block).'</td>
		</tr>
		<tr>
            <td>Circle office</td>
            <td>'.strtoupper($revenue).'</td>
        </tr>
        <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($b_vill).'</td>
		</tr>
		<tr>
            <td>Pincode</td>
            <td>'.$b_pincode.'</td>           
        </tr>                                   
        <tr>
            <td colspan="2"><b>Other Details</b></td>
        </tr>
        <tr>
            <td>Relation of Petitioner with the deed</td>
            <td>'.strtoupper($petitioner_deed).'</td>            
        </tr>
        <tr>
            <td>Year of Inspection</td>
            <td>'.strtoupper($year_inspection).'</td>
		</tr>
		<tr>
            <td>Circle Name (of land) </td>
            <td>'.strtoupper($revenue).'</td>
        </tr>
        <tr>
            <td>Mouza (of land)</td>
            <td>'.strtoupper($mouza).'</td>
		</tr>
		<tr>
            <td>Patta No</td>
            <td>'.strtoupper($pattano).'</td>
            
        </tr>   
        <tr>
            <td>Dag No</td>
            <td>'.strtoupper($dagno).'</td>
		</tr>
		<tr>
            <td>Area of Land (in sq. meter)</td>
            <td>'.strtoupper($area_land).'</td>
            
        </tr>
        <tr>
            <td>Nature of Deed</td>
            <td>'.strtoupper($nature_deed).'</td>
		</tr>
		<tr>
            <td>Name of the office where Registered</td>
            <td>'.strtoupper($registered_office).'</td>            
        </tr>
		<tr>
            <td>Remarks</td>
            <td>'.strtoupper($remarks).'</td>
        </tr>
		<tr><td colspan="2">Checklists.<br/> *NA - Not Applicable <br/>*SC - Send By Courier</td></tr>
		<tr><td>1. Copy of Land deed.</td><td >'.$val1.'</td></tr>
		<tr><td>2.Any other document (Jamabandi copy, Land Revenue Receipt Or Khajana Receipt,etc).</td><td>'.$val2.'</td></tr>
    ';
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
	$printContents=$printContents.'
	<tr>           
		<td colspan="2">
			<table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
				<tr><td height="45px" colspan="2">Courier Details.</td></tr>
				<tr><td width="40%">Name of Courier Service </td><td width="60%">'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td width="40%">Ref. No. / Consignment No. </td><td width="60%">'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td width="40%">Dispatch Date </td><td width="60%">'.strtoupper($courier_details_dt).'</td></tr>
			</table>
		</td>
	</tr>';
	}
	if($results["payment_mode"]!=NULL){ 
		$printContents=$printContents.'<tr>		    
		<td colspan="2">
			<table border="1" align="center" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive" width="100%">
			<tr><td height="45px" colspan="2">Payment Details :</td></tr>
			<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
			if($results["payment_mode"]==0)
			{
				$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
				<td>'.$offline_challan.'</td></tr>';
			}
			$printContents=$printContents.'</table>			
		</td>
	  </tr>';
	  }
$printContents=$printContents.'    
	<tr>
		<td rowspan="2" valign="top"><b>Signatures and Dates :</b></td>
		<td align="right">Signature of the Applicant : '.strtoupper($key_person).'<br/>
		Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
	</tr>  
</table>
';
?>