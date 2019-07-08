 <?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form3 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form3 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form3 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form3 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
$row1=$formFunctions->fetch_swr($swr_id);
  $key_person=$row1['Key_person']; $ownername=$row1['Name_of_owner'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
   $from=strtoupper($key_person)." \n".strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill)."\nBlock : ".strtoupper($block)."\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

		
//$sql=$fire->query("select * from fire_form3 where user_id=$swr_id");
$row=$q->fetch_array();

$form_id=$row['form_id'];$license_no=$row["license_no"];$lic_date=$row["lic_date"];$owner_address=json_decode($row["owner_address"]);$owner_address_s1= $owner_address->s1;$owner_address_s2= $owner_address->s2;$owner_address_vt= $owner_address->vt;
  $owner_address_dist= $owner_address->dist;$owner_address_blk= $owner_address->blk;$owner_address_pin=$owner_address->pin;
   $site_area=$row["site_area"];$total_area=$row["total_area"];$premise_access=$row["premise_access"];$no_of_floor=$row["no_of_floor"];$floor_details=$row["floor_details"]; $access_premises=$row["access_premises"];$width_entry=$row["width_entry"];
  $no_of_entrance=$row["no_of_entrance"];$parking=$row["parking"];$fire_name=$row["fire_name"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];$system_details=$row["system_details"];$water_details=$row["water_details"];
  $personnel_details=$row["personnel_details"];$license_authority=$row["license_authority"];$other_info=$row["other_info"];$submited=$row["sub_date"];$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
  
     if(!empty($row["surround_prop"])){ 
         $surround_prop=json_decode($row["surround_prop"]);
         $surround_prop_e=$surround_prop->e;
         $surround_prop_w=$surround_prop->w;
         $surround_prop_n=$surround_prop->n;
         $surround_prop_s=$surround_prop->s;
        }
        if(!empty($row["os_width"])){ 
         $os_width=json_decode($row["os_width"]);
         $os_width_e=$os_width->e;
         $os_width_w=$os_width->w;
         $os_width_n=$os_width->n;
         $os_width_s=$os_width->s;  
        }   
	if($parking=="Y"){
		$parking="YES";
	}else{
		$parking="NO";
		$two_wheeler="N/A";
		$four_wheeler="N/A";	
	}
if(!isset($css)){
      $val1=$formFunctions->get_uploadFile($row["file1"]);
      $val2=$formFunctions->get_uploadFile($row["file2"]);
      $val3=$formFunctions->get_uploadFile($row["file3"]); 
      $val4=$formFunctions->get_uploadFile($row["file4"]);
      
    }else{
      $val1=$formFunctions->get_useruploadFile($row["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($row["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($row["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($row["file4"],$applicant_id);
      
    }


   if(!empty($row["courier_details"])&&$row["courier_details"]!=1){
        $courier_details=json_decode($row["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }   
 $form_name=$formFunctions->get_formName('fire','3');
 $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - III</title>
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
if(!empty($row["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($row["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM - III</h4>
        <h4>FORM OF APPLICATION FOR "NO OBJECTION CERTIFICATE (NOC)" IN RESPECT OF FIRE SAFETY MEASURES IN '.$form_name.' &lsquo;ASSAM FIRE SERVICE RULES 1989&rsquo;</h4>
        </div><br/>
  <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%">To,</td><td width="95%">&nbsp;</td>
          </tr>
          <tr>
            <td width="5%"></td>
      <td width="95%">
              The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel
            </td>
          </tr>
		  <tr>
            <td width="5%">Sir,</td><td width="95%">&nbsp;</td>
          </tr>
<tr><td width="5%"></td><td width="95%">
	I/We &nbsp;'.strtoupper($key_person).'&nbsp;on behalf of&nbsp; '.strtoupper($ownername).' &nbsp;apply for N.O.C. in respect of Fire Prevention and Fire Safety Measures under &lsquo;Assam Fire Service Rules 1989&rsquo; for the purpose of Existing/ Proposed Transport Go-downs and other go-downs. Required documents/ information as per formate furnished below.<p>&nbsp;</p>
</td>
</tr>
</table></td>
</tr>
</table>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
  <tr>
    <td width="40%" valign="top">1. Name and address of the Applicant</td>
    <td width="60%"><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
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
            <td>State </td>
            <td>'.strtoupper($block).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($dist).'</td>
          </tr>
          <tr>
            <td>Pincode</td>
            <td>'.$pincode.'</td>
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
        <td>'.strtoupper($ownername).'</td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td>
	<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
          <tr>
            <td width="50%">Street Name 1</td>
            <td>'.strtoupper($owner_address_s1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($owner_address_s2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($owner_address_vt).'</td>
          </tr>
	 <tr>
            <td>Block</td>
            <td>'.strtoupper($owner_address_blk).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($owner_address_dist).'</td>
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
            <td>'.$b_pincode.'</td>
          </tr>
        </table></td>
  </tr>
<tr>
  <td>4. Contact numbers of the applicant/occupier/owner</td>
    <td>Landline No : '.$landline_std.'-'.$landline_no.'
<br>
Mobile No : +91-'.$mobile_no.'
</td>
  </tr>
 <tr>
    <td valign="top">5. License Number and Date of issue</td>
    <td>License No : '.strtoupper($row["license_no"]).'<br>
		 Issue Date : '.strtoupper($row["lic_date"]).'
	</td>
  </tr>
 <tr>
    <td>6. Total site area</td>
    <td>'.strtoupper($row["site_area"]).'</td>
  </tr>
 <tr>
    <td>7. Total built up area</td>
    <td>'.strtoupper($row["total_area"]).'</td>
  </tr>
<tr>
    <td>8. Accessibility to the premises</td>
    <td>'.strtoupper($row["premise_access"]).'</td>
  </tr>
<tr>
    <td valign="top">9. Surrounding properties</td>
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
    <td>10. Number of floors</td>
    <td>'.strtoupper($no_of_floor).'</td>
  </tr>
<tr>
    <td>11. Occupancy in each floor</td>
    <td>'.strtoupper($floor_details).'</td>
  </tr>
  <tr>
    <td valign="top">12. Open Space available around the Structure</td>
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
    <td>13. Access to the premises</td>
    <td>'.strtoupper($access_premises).'</td>
  </tr>

<tr>
    <td>14. Width of entry/ exits</td>
    <td>'.strtoupper($width_entry).'</td>
  </tr>
<tr>
    <td>15. Number of emergency exits, sizes etc</td>
    <td>'.strtoupper($no_of_entrance).'</td>
  </tr>
<tr>
    <td>16. Provision of parking 2 wheelers and 4 wheelers</td>
    <td>'.strtoupper($parking).' &nbsp;&nbsp;&nbsp;
    Two wheeler : '.strtoupper($two_wheeler).'&nbsp;&nbsp;&nbsp;Four wheeler : '.strtoupper($four_wheeler).'</td>
  </tr>
<tr>
    <td>17. Name of nearest Fire Station and telephone Number</td>
    <td>Name : '.strtoupper($fire_name).'<br>
		Contact No : '.strtoupper($fire_std).'-'.strtoupper($fire_land).'
	</td>
  </tr>

 <tr>
    <td valign="top">18. Details of the Fire Fighting System/ Equipments available</td>
    <td>'.strtoupper($system_details).'    </td>
  </tr>
<tr>
    <td valign="top">19. Details of water storages available in the premises</td>
    <td>'.strtoupper($water_details).'    </td>
  </tr>
  <tr>
    <td valign="top">20. Details of the personnel trained basic fire fighting</td>
    <td>'.strtoupper($personnel_details).'</td>
  </tr>
 <tr>
    <td valign="top">21. Licence Number/ permission from the concerned land owner/ authority</td>
    <td>'.strtoupper($license_authority).'</td>
  </tr>
  <tr>
    <td valign="top">22. Any other information that the applicant desire to provide</td>
    <td>'.strtoupper($other_info).'    </td>
  </tr>
  <tr>
    <td colspan="2">23. Checklists of documents.<br/>* NA - Not Applicable <br/>* SC - Send by Courier</td>
  </tr>
  <tr>
    <td colspan="2">	
		<table  width="100%" border="1" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
			<tr>
			<td width="40%">1. Site plan</td>
			<td>'.$val1.'</td></tr>
			<tr>
			<td>2. Layout plan</td>
			<td>'.$val2.'</td></tr>
			<tr>
			<td>3. Service plan</td>
			<td>'.$val3.'</td></tr>
			<tr>
			<td>4. Licence/Permission etc.</td>
			<td>'.$val4.'</td></tr>
			<tr>
		</table>	
    </td>
  </tr>
  ';

    if(!empty($row["courier_details"])&&$row["courier_details"]!=1){
      $printContents=$printContents.'
      <tr>       
      <td colspan="2">
        <table  width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse;">
          <tr><td colspan="2">Courier Details.</td></tr>
          <tr><td width="40%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
        </table>
      </td>
      </tr>'; 
    } 
  $printContents=$printContents.'
  <tr>
    <td colspan="2">
    <br />
    <table width="100%" border="0" class="table table-bordered table-responsive" style="border-collapse:collapse;">
      <tr>
         <td width="50%">Place : '.strtoupper($dist).'</td>
        <td align="right">'.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Date : '.date('d-m-Y',strtotime($row["sub_date"])).'</td>
        <td align="right">Signature of the Applicant<br/>
        (Owner/ Signing Authority)</td>
      </tr>
    </table>
    </td>
  </tr>
</table>';
?>