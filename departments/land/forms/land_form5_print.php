<?php
  if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$land->query("select * from land_form5 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$land->query("select * from land_form5 where uain='$uain' and user_id='$swr_id'") or die($land->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$land->query("select * from land_form5 where user_id='$swr_id' and form_id='$form_id'") or die($land->error);
	}else{
		$q=$land->query("select * from land_form5 where user_id='$swr_id' and active='1'") or die($land->error);
	} 
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$pan_no=$row1['pan_no'];$revenue=$row1['revenue'];$mouza=$row1['mouza'];$pattano=$row1['pattano'];$unit_name=$row1['Name'];$dagno=$row1['dagno'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$land->query("select * from land_form5 where user_id='$swr_id' and active='1'") or die($land->error);
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];   
		$father_name=$results["father_name"];$adhar_crd=$results["adhar_crd"];$name_seller=$results["name_seller"];$adhar_crd=$results["adhar_crd"];$gp=$results["gp"];$name_intender=$results["name_intender"];$buyer=$results["buyer"];$sold_village=$results["sold_village"];$sold_mouza=$results["sold_mouza"];$sold_patta=$results["sold_patta"];$sold_dag=$results["sold_dag"];$sold_area=$results["sold_area"];$sold_class=$results["sold_class"];$purpose_sale=$results["purpose_sale"];$rate_biga=$results["rate_biga"];$total_value=$results["total_value"];  
			 $file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];$file10=$results["file10"];
		$sub_date=$results["sub_date"];
	
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);
		$val3=$formFunctions->get_uploadFile($file3);
		$val4=$formFunctions->get_uploadFile($file4);
		$val5=$formFunctions->get_uploadFile($file5);
		$val6=$formFunctions->get_uploadFile($file6);
		$val7=$formFunctions->get_uploadFile($file7);
		$val8=$formFunctions->get_uploadFile($file8);
		$val9=$formFunctions->get_uploadFile($file9);
		$val10=$formFunctions->get_uploadFile($file10);  
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
		$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
		$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
		$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
		$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
		$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
		$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
		$val9=$formFunctions->get_useruploadFile($file9,$applicant_id);
		$val10=$formFunctions->get_useruploadFile($file10,$applicant_id);   
	}
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
            $courier_details=json_decode($results["courier_details"]);
            $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
          }else{
            $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
        }
       
    $form_name=$cms->query("select form_name from land_form_names where form_no='5'")->fetch_object()->form_name;    
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 5</title>
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
        '.$assamSarkarLogo.'<h4>FORM NO. 5</h4>
        <p  style="text-align:center"> Department: Revenue</p>
        <h4>'.$form_name.'</h4>
        </div><br/>
        <table class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse"  border="1"  >
         <tr>
               <td colspan="2"><b>Applicant&apos;s Details</b></td>
         </tr>
         <tr>
            <td width="50%"> Applicant&apos;s Name </td>
            <td width="50%"> '.strtoupper($key_person).'</td>
		</tr>
		<tr>
            <td> Mobile Number</td>
            <td> '.$mobile_no.'</td>
        </tr>
        <tr>
			<td>Name of Seller/Donor/Lessee</td>
			<td> '.strtoupper($name_seller).' </td>
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
            <td colspan="2"><b>Address Details</b></td>
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
			<td>Mouza </td>
			<td>'.strtoupper($mouza).'</td>
		</tr>
		<tr>
			<td>Ward </td>
			<td> '.strtoupper($b_block).'</td>   
		</tr>                                   
        <tr>
			<td>GP </td>
			<td>'.strtoupper($gp).'</td>        
		</tr>                
		<tr>
            <td colspan="2"><b>Other Details</b></td>
		</tr>
        <tr>
			<td>Name of Intending Buyer/Receiver</td>
            <td>'.strtoupper($name_intender).'</td>
		</tr>
		<tr>
            <td>Buyer/Doner Father Name</td>
            <td>'.strtoupper($buyer).'</td>
        </tr>        
        <tr>
            <td>Sold land village/ward</td>
            <td>'.strtoupper($sold_village).'</td>
		</tr>
		<tr>
            <td>Sold land mouza</td>
            <td>'.strtoupper($sold_mouza).'</td>
        </tr>
        <tr>
            <td>Sold land patta</td>
            <td>'.strtoupper($sold_patta).'</td>
		</tr>
		<tr>
            <td>Sold land dag no.</td>
            <td>'.strtoupper($sold_dag).'</td>
        </tr>
        <tr>
            <td>Sold land Area</td>
            <td>'.strtoupper($sold_area).'</td>
		</tr>
		<tr>
            <td>Sold land class</td>
            <td>'.strtoupper($sold_class).'</td>
        </tr>
        <tr>
            <td>Purpose of sale/Transfer of land</td>
            <td>'.strtoupper($purpose_sale).'</td>
		</tr>
		<tr>
            <td>Rate per bigha</td>
            <td> '.strtoupper($rate_biga).'</td>            
        </tr>                                   
        <tr>
            <td>Total value of land proposed to be sold </td>
            <td>'.strtoupper($total_value).'</td>                 
        </tr>
        <tr><td colspan="2">Checklists.<br/>	*NA - Not Applicable <br/>	*SC - Send By Courier</td>
        </tr>
        <tr><td>1. Affidavit of seller and purchaser in prescribed format.</td><td >'.$val1.'</td></tr>
        <tr><td>2.Passport size photograph of Seller.</td><td>'.$val2.'</td></tr>
        <tr><td>3.Passport size photograph of Purchaser.</td><td>'.$val3.'</td></tr>
        <tr><td>4.NOC from co-pattadars along with signed copy Photo ID proof.</td><td>'.$val4.'</td></tr>
        <tr><td>5.Certified copy of Jamabandi.</td><td>'.$val5.'</td></tr>
        <tr><td>6.Copy of Chitha of concerned Dag in case if share of seller is not mentioned.</td><td>'.$val6.'</td></tr>
        <tr><td>7.Up to date Land Revenue Receipt.</td><td>'.$val7.'</td></tr>
        <tr><td>8. Certified copy of Electoral Roll with linkage document.</td><td>'.$val8.'</td></tr>
        <tr><td>9. Trace Map.</td><td>'.$val9.'</td></tr>
        <tr><td>10.Signed photocopy of expectant of Power of Attorney wherever Power of Attorney is submitted.</td><td>'.$val10.'</td></tr>
          ';

		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$printContents=$printContents.'
		<tr>           
		<td colspan="2">
			<table border="1" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
				<tr><td height="45px" colspan="2">Courier Details.</td></tr>
				<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
			</table>
		</td>
		</tr>
		';              
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