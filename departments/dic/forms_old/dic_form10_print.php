<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dic->query("select * from dic_form10 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dic->query("select * from dic_form10 where uain='$uain' and user_id='$swr_id'") or die($dic->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dic->query("select * from dic_form10 where user_id='$swr_id' and form_id='$form_id'") or die($dic->error);
	}else{
		$q=$dic->query("select * from dic_form10 where user_id='$swr_id' and active='1'") or die($dic->error);
	}
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$l_o_business=$row1['Type_of_ownership'];$Name_of_owner=$row1['Name_of_owner'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else if($l_o_business=="PR"){
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}else{
		$l_o_business_val="";$l_o_business_name="";
	}
	$q=$dic->query("select * from dic_form10 where  user_id='$swr_id' and active='1'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){

	$form_id=$results['form_id'];	
		
	$indus_land=$results["indus_land"];$actual_area=$results["actual_area"];$lic_no=$results["lic_no"];$lic_date=$results["lic_date"];$item_name=$results["item_name"];$production_capacity=$results["production_capacity"];$prod_export=$results["prod_export"];$civil_works=$results["civil_works"];$plant_n_machinery=$results["plant_n_machinery"];
	$other_fixed_assets=$results["other_fixed_assets"];$actual_prod_area=$results["actual_prod_area"];
	$godown=$results["godown"];$other_services=$results["other_services"];$power_req=$results["power_req"];$water_req=$results["water_req"];$if_any=$results["if_any"];$PI_indicate=$results["PI_indicate"];
	if($if_any=="Y") $if_any="YES";
	else if($if_any=="N") $if_any="NO";
	else $if_any="";
	$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];
	
	if(!isset($css)){
		$val1=$formFunctions->get_uploadFile($file1);
		$val2=$formFunctions->get_uploadFile($file2);
		$val3=$formFunctions->get_uploadFile($file3);
		$val4=$formFunctions->get_uploadFile($file4);
		$val5=$formFunctions->get_uploadFile($file5);
		
	}else{
		$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
		$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
		$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
		$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
		$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
	}
	if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
		$courier_details=json_decode($results["courier_details"]);
		$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;

	}else{
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}		
	$PI_indicate = wordwrap($PI_indicate, 50, "<br/>", true);		
	$form_name=$formFunctions->get_formName('dic','10');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	
}

if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form 10</title>
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
          '.$assamSarkarLogo.'<br/>
          <h4>'.$form_name.'</h4>
    </div><br/> 
    <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">  
		<tr>
			<td valign="middle" style="height:40px;width:50%">  Industrial land available at :</td>
			<td>'.$indus_land.'</td>
		</tr>
		<tr>
			<td valign="top">1. Location of land/Shed applied for (Actual name of the industrial property as mentioned):</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1"> 
					<tr>
							<td width="50%">Street Name 1</td>
							<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
							<td height="29">Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
							<td>Mobile</td>
							<td>+91'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
							<td>Phone Number</td>
							<td>'.strtoupper($b_landline_std).' '.strtoupper($b_landline_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>2. Actual area applied for (in terms of sq mtr/ft)</td>
			<td>'.strtoupper($actual_area).'</td>
		</tr>
		<tr>
			<td>3. Name of the Industrial Unit</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td style="width:50%" valign="top">4. Address for communication :</td>
			<td>
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1"> 
					<tr>
							<td width="50%">Street Name1</td>
							<td>'.strtoupper($b_street_name3).'</td>
					</tr>
					<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name4).'</td>
					</tr>
					<tr>
							<td>Vill/Town</td>
							<td>'.strtoupper($b_vill2).'</td>
					</tr>
					<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist2).'</td>
					</tr>
					<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode2).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>5. Constitution of the Industrial unit :</td>
			<td>'.strtoupper($l_o_business_val).'</td>
		</tr>
		<tr>
			<td>6. Name of the Proprietor/Partner/Board of Directors :</td>
			<td>'.strtoupper($Name_of_owner).'</td>
		</tr>
		<tr>
			<td>7. (a) EM-I/EM- II/IEM/Industrial Licence no :</td>
			<td>'.strtoupper($lic_no).'</td>
		</tr>
		<tr>
			<td style="text-indent:14px;"> (b) Licence date :</td>
			<td>'.strtoupper($lic_date).'</td>
		</tr>
		<tr>
			<td>8. Name of Item/s of manufacture:</td>
			<td>'.strtoupper($item_name).'</td>
		</tr>
		<tr>
			<td>9. Proposed Annual Installed Capacity of Production in MT (item-wise) :</td>
			<td>'.strtoupper($production_capacity).'</td>
		</tr>
		<tr>
			<td>10. Proposed export of product (in terms of MT) :</td>
			<td>'.strtoupper($prod_export).'</td>
		</tr>
		<tr>
			<td colspan="2">11. Proposed investment (Rs. in lakh)</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(a) Civil works :</td>
			<td>'.strtoupper($civil_works).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) Plant &amp; Machinery :</td>
			<td>'.strtoupper($plant_n_machinery).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(c) Other fixed assets :</td>
			<td>'.strtoupper($other_fixed_assets).'</td>
		</tr>
		<tr>
			<td colspan="2">12. Requirement of Land (sq ft)</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(a) For actual production area ( sq ft) :</td>
			<td>'.strtoupper($actual_prod_area).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) For Godown ( sq ft) :</td>
			<td>'.strtoupper($godown).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(c) Other utility services ( in sq ft ) :</td>
			<td>'.strtoupper($other_services).'</td>
		</tr>
		<tr>
			<td colspan="2">13. Other amenities</td>
		</tr>
		<tr>
			<td style="text-indent:14px;">(a) Requirement of Power (HP) :</td>
			<td>'.strtoupper($power_req).'</td>
		</tr>
		 <tr>
			<td style="text-indent:14px;">(b) Annual requirement of Water (in KL) :</td>
			<td>'.strtoupper($water_req).'</td>
		</tr>
		<tr>
			<td>14. If there any effluent problem :</td>
			<td>'.strtoupper($if_any).'</td>
		</tr>';
		if($if_any=="YES"){
		$printContents=$printContents.'
			<tr>
				<td>15. If yes , Pl indicate with 50 words :</td>
				<td>'.strtoupper($PI_indicate).'</td>
			</tr>
		';
		}
		$printContents=$printContents.'
        <tr>
			<td colspan="2" height="50px">Checklist of the Documents--<br/>*N/A--Not Available<br/>*S/C--Send By Courier</td>
		</tr>
		<tr>
			<td> Location of site (provide map).</td>
			<td>'.$val1.'</td> 
		</tr>
		<tr>
			<td> Details of processing technology.</td>
			<td>'.$val2.'</td> 
		</tr>
		<tr>
			<td> Type and Quantity of waste to be processed per day.</td>
			<td>'.$val3.'</td> 
		</tr>
		<tr>
			<td> Site clearance (from local authority, if any).</td>
			<td>'.$val4.'</td> 
		</tr>
		<tr>
			<td>Utilization of the e-waste processed.</td>
			<td>'.$val5.'</td> 
		</tr>';
		  if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
             $printContents=$printContents.'
            <tr>           
            <td colspan="2">
                <table border="0" width="100%" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse">
                    <tr><td height="30px" colspan="2"><u>Courier Details.</u></td></tr>
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
            <td colspan="2" align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        
	</table>';
?>