<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form5 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form5 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form5 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form5 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$ownername=$row1['Name_of_owner'];
		
		$from= strtoupper($b_street_name1)." , ".strtoupper($b_street_name2)." ".strtoupper($b_vill);
		
		//$sql=$fire->query("select * from fire_form5 where user_id=$swr_id");
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
        $owner_address=json_decode($results["owner_address"]);
		$owner_address_street1= $owner_address->s1;	$owner_address_street2= $owner_address->s2;$owner_address_vill= $owner_address->vt;
		$owner_address_district= $owner_address->dist;$owner_address_block= $owner_address->blk;$owner_address_pin=$owner_address->pin;
		$surround_prop=json_decode($results["surround_prop"]);
		$surround_prop_e=$surround_prop->e;$surround_prop_w=$surround_prop->w;$surround_prop_n=$surround_prop->n;$surround_prop_s=$surround_prop->s;
		$os_width=json_decode($results["os_width"]);
		$os_width_e=$os_width->e;$os_width_w=$os_width->w;$os_width_n=$os_width->n;$os_width_s=$os_width->s;	
      
       if(!isset($css)){
      $val1=$formFunctions->get_uploadFile($results["file1"]);
      $val2=$formFunctions->get_uploadFile($results["file2"]);
      $val3=$formFunctions->get_uploadFile($results["file3"]);
      $val4=$formFunctions->get_uploadFile($results["file4"]);  
    }else{
      $val1=$formFunctions->get_useruploadFile($results["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($results["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($results["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($results["file4"],$applicant_id);    
    }

        if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
        $courier_details=json_decode($results["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }
  $form_name=$formFunctions->get_formName('fire','5');
  $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - V</title>
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
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM - V</h4>
        <h4>FORM OF APPLICATION FOR "NO OBJECTION CERTIFICATE (NOC)" IN RESPECT OF FIRE SAFETY'.strtoupper($results["uain"]).' MEASURES IN '.$form_name.' &lsquo;ASSAM FIRE SERVICE RULES 1989&rsquo;</h4>
        </div><br/>
  <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%" valign="top">To,</td>
      <td width="95%">
              <br>The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel
            </td>
          </tr>
	<tr><td width="5%" valign="top">Sir,</td>
	<td width="95%">
              <br>I/We &nbsp;'.strtoupper($key_person).'&nbsp;on behalf of&nbsp; '.strtoupper($ownername).' &nbsp;apply for N.O.C. in respect of Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of Existing/ Proposed function halls/ building below 15m. Required documents/information as per formate furnished below.</td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
  <tr>
    <td width="50%" valign="top">1. Name and address of the Applicant</td>
    <td><table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
      <tr>
        <td width="20%" >Name</td>
        <td> '.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
          <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($street_name1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($street_name2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($vill).'</td>
          </tr>
			<tr>
            <td>State</td>
            <td>'.strtoupper($block).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($dist).'</td>
          </tr>
          <tr>
            <td>Pincode</td>
            <td>'.strtoupper($pincode).'</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">2. Name and Address of the owner of the premises</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
      <tr>
        <td width="20%">Name</td>
        <td>'.strtoupper($results["owner_name"]).'</td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td>
	<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
          <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($owner_address_street1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($owner_address_street2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($owner_address_vill).'</td>
          </tr>
		   <tr>
            <td>District</td>
            <td>'.strtoupper($owner_address_district).'</td>
          </tr>
		  <tr>
            <td>Block</td>
            <td>'.strtoupper($owner_address_block).'</td>
          </tr>
          <tr>
            <td>PIN</td>
            <td>'.strtoupper($owner_address_pin).'</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
 <tr>
    <td valign="top">3. Address of the premises</td>
    <td>
          <table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
         <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($b_street_name1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($b_street_name2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($b_vill).'</td>
          </tr>
		  <tr>
            <td>Block</td>
            <td>'.strtoupper($b_block).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($b_dist).'</td>
          </tr>
          <tr>
            <td>PIN</td>
            <td>'.strtoupper($b_pincode).'</td>
          </tr>
        </table></td>
  </tr>
<tr>
  <td>4. Contact numbers of the applicant/occupier/owner</td>
    <td>Landline No: '.strtoupper($landline_std).'-'.strtoupper($landline_no).'
<br>
Mobile No: +91-'.strtoupper($mobile_no).'
</td>
  </tr>
 
 <tr>
    <td>5. Total site area</td>
    <td>'.strtoupper($results["site_area"]).'</td>
  </tr>
 <tr>
    <td>6. Total built up area</td>
    <td>'.strtoupper($results["total_area"]).'</td>
  </tr>
<tr>
    <td>7. Accessibility to the premises</td>
    <td>'.strtoupper($results["premise_access"]).'</td>
  </tr>
<tr>
    <td valign="top">8. Surrounding properties:</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
      <tr>
        <td width="50%">East</td>
        <td>'.strtoupper($surround_prop_e).'</td>
      </tr>
      <tr>
        <td>West</td>
        <td>'.strtoupper($surround_prop_w).'</td>
      </tr>
      <tr>
        <td>North</td>
        <td>'.strtoupper($surround_prop_n).'</td>
      </tr>
      <tr>
        <td>South</td>
        <td>'.strtoupper($surround_prop_s).'</td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td>9. Number of floors</td>
    <td>'.strtoupper($results["no_of_floor"]).'</td>
  </tr>
<tr>
    <td>10. Occupancy in each floor</td>
    <td>'.strtoupper($results["floor_details"]).'</td>
  </tr>
  <tr>
    <td valign="top">11. Open Space available around the Structure:</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
      <tr>
        <td width="50%">Eastern Side</td>
        <td>'.strtoupper($os_width_e).'</td>
      </tr>
      <tr>
        <td>Western Side</td>
        <td>'.strtoupper($os_width_w).'</td>
      </tr>
      <tr>
        <td>Northern Side</td>
        <td>'.strtoupper($os_width_n).'</td>
      </tr>
      <tr>

        <td>Southern Side</td>
        <td>'.strtoupper($os_width_s).'</td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td>12. Access to the premises</td>
    <td>'.strtoupper($results["access_premises"]).'</td>
  </tr>

<tr>
    <td>13. Width of entry/ exits</td>
    <td>'.strtoupper($results["width_entry"]).'</td>
  </tr>
<tr>
    <td>14. Number of emergency exits, size etc</td>
    <td>'.strtoupper($results["no_of_entrance"]).'</td>
  </tr>
<tr>
    <td>15. Provision of parking 2 wheelers and 4 wheelers</td>
    <td>'.strtoupper($results["parking"]).' &nbsp;&nbsp;&nbsp;
    Two wheeler : '.strtoupper($results["two_wheeler"]).'&nbsp;&nbsp;&nbsp;Four wheeler : '.strtoupper($results["four_wheeler"]).'</td>
  </tr>
<tr>
    <td>16. Name of the nearest Fire Station and telephone Number</td>
    <td>Name: '.strtoupper($results["fire_name"]).'<br>
		Contact No: '.strtoupper($results["fire_std"]).'-'.strtoupper($results["fire_land"]).'
	</td>
  </tr>

 <tr>
    <td valign="top">17. Details of the Fire Fighting Equipments available</td>
    <td>'.strtoupper($results["system_details"]).'    </td>
  </tr>
<tr>
    <td valign="top">18. Details of the water storages available in the premises</td>
    <td>'.strtoupper($results["water_details"]).'    </td>
  </tr>
  <tr>
    <td valign="top">19. Details of the personnel trained basic fire fighting</td>
    <td>'.strtoupper($results["personnel_details"]).'</td>
  </tr>
 <tr>
    <td valign="top">20. License Number/ Permission from the concerned Land Owner/ Authority</td>
    <td>'.strtoupper($results["license_authority"]).'</td>
  </tr>
  <tr>
    <td valign="top">21. Any other information that the applicant desires to provide</td>
    <td>'.strtoupper($results["other_info"]).'    </td>
  </tr>
  <tr>
    <td colspan="2">23. Checklists of Documents.<br/>* NA - Not Applicable <br/>* SC - Send by Courier</td>
  </tr>
  <tr>
    <td colspan="2">	
			<table  width="100%" border="1"  class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
				<tr>
				<td width="50%">1. Site plan</td>
				<td>'.$val1.'</td></tr>
				<tr>
				<td>2. Layout plan</td>
				<td>'.$val2.'</td></tr>
				<tr>
				<td>3. Service plan</td>
				<td>'.$val3.'</td></tr>
				<tr>
				<td>4. Licence/ Permission if any.</td>
				<td>'.$val4.'</td></tr>
			</table>
			</tr></td>
				';

    if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
      $printContents=$printContents.'
      <tr>       
      <td colspan="2">
        <table border="1" width="100%" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;" >
          <tr><td colspan="2"><u>Courier Details.</u></td></tr>
          <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details->cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details->rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details->dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
    } 
  $printContents=$printContents.'
		</table>	
    </td>
  </tr>
  <tr>
    <td colspan="2">
    <br />
    <table width="100%" border="0" class="table table-bordered table-responsive"  style="border-collapse:collapse;">
      <tr>
         <td width="50%">Place: '.strtoupper($dist).'</td>
        <td align="right">'.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Date: '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
        <td align="right">Signature of the Applicant<br/>
        (Owner/ Signing Authority)</td>
      </tr>
    </table>
    </td>
  </tr>';
      
	  
	$compliance_report_details=$fire->query("select * from compliance_report where uain='$uain' and active='0' and officer_id='0'");
	if($compliance_report_details->num_rows>0){
		$rows=$compliance_report_details->fetch_object();
		$letter_no=$rows->letter_no;
		$letter_date=$rows->letter_date;
		$letter_file=$rows->letter_file;
			$printContents=$printContents.'
			<tr>
				<td colspan="2" align="center" class="success text-center">
					<b>Compliance Report</b>
				</td>
			</tr>
			<tr>       
			<td colspan="2">
			<p>To,<br/>
			&emsp;The Director,<br/>&emsp;Fire & Emergency Services, Assam.<br/>&emsp;Panbazar, Guwahati-1.<br/><br/>
			Sir,<br/>
			&emsp;I/We, '.strtoupper($key_person).' on behalf of '.strtoupper($unit_name).' located at '.strtoupper($from).' , Block/ward no. '.strtoupper($b_block).' , District - '.strtoupper($b_dist).' , do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;'.strtoupper($letter_no).' dated &nbsp;'.date("d-m-Y",strtotime($letter_date)).' and para wise compliance report is enclosed.<br/><br/>&emsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/ building.
			</p>
			</td>
			</tr>
			<tr>
				<td colspan="2">Letter of fire safety recommendations : &nbsp; &nbsp;<a href="'.$upload.$letter_file.'">Download</a></td>
			</tr>
			'; 
	} 
	
	$printContents=$printContents.'</table>';
?>