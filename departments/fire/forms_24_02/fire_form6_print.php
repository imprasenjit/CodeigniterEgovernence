<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form6 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form6 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form6 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form6 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$ownername=$row1['Name_of_owner'];
		
		$from= strtoupper($b_street_name1)." , ".strtoupper($b_street_name2)." ".strtoupper($b_vill);
    //$sql=$fire->query("select * from fire_form6 where user_id=$swr_id");
    $rowkk=$q->fetch_array();
    $form_id=$rowkk["form_id"];
		$owner_name=$rowkk['owner_name'];$owner_address=json_decode($rowkk["owner_address"]);$owner_address_street1= $owner_address->s1;	$owner_address_street2= $owner_address->s2;$owner_address_vill= $owner_address->vt;$owner_address_district= $owner_address->dist;$owner_address_block= $owner_address->blk;$owner_address_pin=$owner_address->pin;$surround_prop=json_decode($rowkk["surround_prop"]);
		$surround_prop_e=$surround_prop->e;$surround_prop_w=$surround_prop->w;$surround_prop_n=$surround_prop->n;$surround_prop_s=$surround_prop->s;$os_width=json_decode($rowkk["os_width"]);$os_width_e=$os_width->e;$os_width_w=$os_width->w;$os_width_n=$os_width->n;$os_width_s=$os_width->s;
		$two_wheeler=$rowkk["two_wheeler"];$four_wheeler=$rowkk["four_wheeler"];
		
		$nearest_station=$rowkk['nearest_station'];
		$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);
		if($rowkk["parking"]=="Y"){
			$parking="YES";
		}else{
			$parking="NO";
			$two_wheeler="NO";
			$four_wheeler="NO";
		}
        if(!isset($css)){
      $val1=$formFunctions->get_uploadFile($rowkk["file1"]);
      $val2=$formFunctions->get_uploadFile($rowkk["file2"]);
      $val3=$formFunctions->get_uploadFile($rowkk["file3"]);
      $val4=$formFunctions->get_uploadFile($rowkk["file4"]);
    }else{
      $val1=$formFunctions->get_useruploadFile($rowkk["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($rowkk["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($rowkk["file3"],$applicant_id);
      $val4=$formFunctions->get_useruploadFile($rowkk["file4"],$applicant_id);
     
      
    }
        if(!empty($rowkk["courier_details"])&& $rowkk["courier_details"]!=1){
        $courier_details=json_decode($rowkk["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }
$form_name=$formFunctions->get_formName('fire','6');
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form - VI</title>
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
if(!empty($rowkk["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($rowkk["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>FORM - VI</h4>
        <h4>FORM OF APPLICATION FOR "NO OBJECTION CERTIFICATE (NOC)" IN RESPECT OF FIRE SAFETY MEASURES IN '.$form_name.' &lsquo;ASSAM FIRE SERVICE RULES 1989&rsquo;</h4>
        </div><br/>
  <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%" valign="top">To,</td>
      <td width="95%">
              <br>The Director,<br>Fire & Emergency Services, Assam.<br>Through proper channel.
            </td>
          </tr>
<tr><td width="5%" valign="top">Sir,
			
<td width="95%">
              <br>I/We, &nbsp;'.strtoupper($key_person).'&nbsp; on behalf of &nbsp;
'.strtoupper($ownername).'&nbsp;apply for N.O.C. in respect of Fire Prevention & Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of erecting Temporary Structures/ Circus/ Moveable Theatre/ Exhibition. Required documents/ information as per formate furnished below.
</p>
<p>&nbsp;</p>
<p>
<u>Self Appraisal for erecting Temporary Structures/ Circus/ Moveable Theatre/ Exhibition</u>
</p>
		</td>
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
        <td>'.strtoupper($rowkk["owner_name"]).'</td>
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
				<td>'.$owner_address_pin.'</td>
			  </tr>
			</table>
		</td>
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
				<td valign="top">4. Contact numbers of the applicant/occupier/owner</td>
				<td>Landline No: '.$landline_std.'-'.$landline_no.'
				<br>
				Mobile No: +91-'.$mobile_no.'
				</td>
			</tr>
			</table>
			</td>
		  </tr>
		</table>
	</td>
</tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
  <tr>
    <td width="50%">5. Total area proposed to be utilized</td>
    <td>'.strtoupper($rowkk['total_area']).'</td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
  <tr>
    <td  width="50%">6. Purpose for erecting temporary structures</td>
    <td>'.strtoupper($rowkk['purpose_erect']).'</td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top">7. Accessibility to the premises:</td>
    <td>
	<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse">
      <tr>
        <td width="50%">a. Distance from motor-able road</td>
        <td>'.strtoupper($rowkk['distance_motor']).'</td>
      </tr>
      <tr>
        <td>b. Width of the road</td>
        <td>'.strtoupper($rowkk['width_road']).'</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</td>
</tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top">8. Surrounding properties:</td>
    <td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse:collapse">
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
</table>
</td>
</tr>
<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top">9. Open Space available around the Structure:</td>
    <td><table width="100%" border="1"  class="table table-bordered table-responsive"  style="border-collapse:collapse">
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
</table>
</td>
</tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left"> 10. Provision for parking of 2 wheelers and 4 wheelers</td>
    <td>'.strtoupper($parking).'&nbsp;&nbsp;&nbsp;
    Two wheeler : '.strtoupper($two_wheeler).'&nbsp;&nbsp;&nbsp;Four wheeler : '.strtoupper($four_wheeler).'</td>
  </tr>
 </table>
</td></tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">11. Arrangements for cooking/ restaurants/ stalls in the premises and their distances from the main structure</td>
    <td>'.strtoupper($rowkk['arrange_cook']).'</td>
  </tr>
    </table>
</td></tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">12. Distance to the nearest overhead electric line &amp; height of ceiling of the structures</td>
    <td>'.strtoupper($rowkk['distance_electric']).'</td>
  </tr>
    </table>
</td></tr>


<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">13. Name of the nearest Fire Station and telephone number</td>
    <td>
	<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
	<tr>
	<td width="50%">Name </td>
	<td>'.strtoupper($nearest_station).'</td>
	</tr>
	<tr>
	<td>Telephone Number </td>
	<td>'.strtoupper($rowkk['fire_std']).'-'.strtoupper($rowkk['fire_land']).'</td>
	</tr>
	</table>
    </td>
  </tr>
</table>
</td> </tr>



<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">14. Details of the Fire Fighting Equipments available in the Premises/ temporary pandel</td>
    <td>'.strtoupper($rowkk['fire_details']).'</td>
  </tr>
    </table>
</td></tr>



<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">15. Details of the water storages available in the premises</td>
    <td>'.strtoupper($rowkk['water_details']).'</td>
  </tr>
    </table>
</td></tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">16. Details of the personnel trained basic fire fighting (Sl. No of the training certificate)</td>
    <td>

	<table border="1" width="100%" class="table table-bordered table-responsive"  style="border-collapse:collapse">
	<tr>
	<td width="50%">'.strtoupper($rowkk['personnel_details']).'</td><br/></tr><tr>
	<td>Sl No: '.strtoupper($rowkk['s_no']).'</td></tr>
	
	</table>
</td>
  </tr>
    </table>
</td></tr>

<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">17. Name and license number of electrician</td>
    <td>Name : '.strtoupper($rowkk['license_name']).'<br>
	NO : '.strtoupper($rowkk['license_no']).'
	</td>
  </tr>
    </table>
</td></tr>

<tr><td>
	<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
      	<tr>
        	<td width="50%">18. License number/ Permission from the concerned Land Owner/ Authority</td>
		<td>License no : '.strtoupper($rowkk['license_authority']).'</td>
	</tr>
    </table>
</td></tr>
<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top" align="left">19. Any other information that the applicant desires to provide</td>
    <td>
     '.strtoupper($rowkk['other_info']).'
    </td>
  </tr>
</table>
</td></tr>
<tr><td>
<table width="100%" border="1" class="table table-bordered table-responsive"  style="border-collapse:collapse">
  <tr>
    <td width="50%" valign="top">20. Checklists of Documents. <br/>* NA - Not Applicable <br/>* SC - Send by Courier</td>
  </tr>
  <tr>
    <td>
     <table  width="100%" class="table table-bordered table-responsive"  border="1" cellpadding="10" style="text-align:top;border-collapse:collapse;">
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
        <td>4. Licence / Permission etc.</td>
        <td>'.$val4.'</td></tr></table></td></tr></table>
        
      ';

    if(!empty($rowkk["courier_details"])&& $rowkk["courier_details"]!=1){
      $printContents=$printContents.'
      
        <table  width="100%" border="1" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;" >
          <tr><td colspan="2"><u>Courier Details.</u></td></tr>
          <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details->cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details->rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details->dt).'</td></tr>
         </table>  
      '; 
    } 
  $printContents=$printContents.'  
   
    </td>
  </tr>
</table>
</td></tr>


<tr><td>
<p>&nbsp;</p>
<p>&nbsp;</p>
	<table width="100%" border="0" class="table table-bordered table-responsive" style="text-align:top;border-collapse:collapse;" >
      <tr>
         <td width="50%">Place: '.strtoupper($dist).'</td>
        <td align="right">'.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Date: '.date('d-m-Y',strtotime($rowkk['sub_date'])).'</td>
        <td align="right">Signature of the Applicant<br/>
        (Owner/ Signing Authority)</td>
      </tr>
    </table>
</td></tr>';
      
	  
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