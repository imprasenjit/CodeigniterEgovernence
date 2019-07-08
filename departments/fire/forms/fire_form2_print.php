<?php
$dept="fire";
$form="2";
$table_name=getTableName($dept,$form);
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");		
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}
	
	if($q->num_rows>0){	
		$results=$q->fetch_array();
		$form_id=$results["form_id"]; 
		$sub_date=$results["sub_date"];
		$p_o_name=$results['p_o_name'];$t_s_area=$results['t_s_area'];$clr_details=$results['clr_details'];
		$other_info=$results['other_info'];$nearest_station=$results['nearest_station'];$license_no=$results['license_no'];$segregate=$results['segregate'];$premise_access=$results['premise_access'];         
		$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);
		if(!empty($results["stored"])){
			$stored=json_decode($results["stored"]);
			$stored_chemical=$stored->chemical; $stored_flash_point= $stored->flash_point;  $stored_qnt= $stored->qnt;$stored_type= $stored->type;  
		}else{
				$stored_chemical="";$stored_flash_point="";$stored_qnt="";$stored_typ="";
		}
		if(!empty($results["p_o_addr"])){
			$p_o_addr=json_decode($results["p_o_addr"]);
			$p_o_addr_s1= $p_o_addr->s1; $p_o_addr_s2= $p_o_addr->s2;$p_o_addr_vt= $p_o_addr->vt; $p_o_addr_dist= $p_o_addr->dist;
			$p_o_addr_blk= $p_o_addr->blk;  $p_o_addr_pin=$p_o_addr->pin;
		}else{
			$p_o_addr_s1="";$p_o_addr_s2="";$p_o_addr_vt="";$p_o_addr_dist="";$p_o_addr_blk="";$p_o_addr_pin="";
					
		}
		if(!empty($results["surround_prop"])){
			$surround_prop=json_decode($results["surround_prop"]);

			$s_properties_e= $surround_prop->e; $s_properties_w= $surround_prop->w;$s_properties_n= $surround_prop->n; $s_properties_s= $surround_prop->s; 
		}else{
			$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";
		}
		if(!empty($results["space_storage"])){
			$space_storage=json_decode($results["space_storage"]);

			$space_storage_e= $space_storage->e; $space_storage_w= $space_storage->w;$space_storage_n= $space_storage->n; $space_storage_s= $space_storage->s; 
		}else{
			$space_storage_e="";$space_storage_w="";$space_storage_n="";$space_storage_s="";
		}
		if(!empty($results["details"])){
			$details=json_decode($results["details"]);				
			if(isset($details->fire)) $details_fire= $details->fire; else $details_fire="";
			if(isset($details->water)) $details_water= $details->water; else $details_water="";
			if(isset($details->trained)) $details_trained= $details->trained; else $details_trained="";
			if(isset($details->slno)) $details_slno= $details->slno; else $details_slno="";		
		}else{
			$details_fire="";$details_water="";$details_trained="";$details_slno="";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>Form '.$form.'</title>
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
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
<body>';    
}else{
      $printContents='';
}
if(!empty($results["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'<div style="text-align:center">
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
	</div>
       <table class="table table-bordered table-responsive">  
	        <tr>
				   <td colspan="2">To,<br/>
				
				    The Director,<br/>Fire & Emergency Services, Assam<br>Through proper channel<br/><br/>
					Sir,<br/>
				
						I/We '.strtoupper($key_person).' on behalf of '.strtoupper($unit_name).' apply for NOC in respect of Fire Prevention and Fire Safety Measures under &lsquo;Assam Fire Service Rules 1989&rsquo; for the purpose of Existing/Proposed the storage and handling of lpg/cng/oxygen/hydrogen/methane/propane/butane/chlorine/ammonia etc. Required documents/information as per formate furnished below.
					</td>
				</tr>
		</table>	
<table class="table table-bordered table-responsive">
  <tr>
    <td valign="top">1. Name and address of the Applicant</td>
    <td><table class="table table-bordered table-responsive">
      <tr>
        <td width="20%" height="24">Name</td>
        <td>'.strtoupper($key_person).'</td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td><table class="table table-bordered table-responsive">
          <tr>
            <td>Street Name 1</td>
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
            <td>'.strtoupper($pincode).'</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">2. Name and Address of the owner of the premises</td>
    <td><table class="table table-bordered table-responsive">
      <tr>
        <td width="20%">Name</td>
        <td>'.strtoupper($p_o_name).'</td>
      </tr>
      <tr>
        <td valign="top">Address</td>
        <td>
		<table class="table table-bordered table-responsive">
          <tr>
            <td>Street Name 1</td>
            <td>'.strtoupper($p_o_addr->s1).'</td>
          </tr>
          <tr>
            <td>Street Name 2</td>
            <td>'.strtoupper($p_o_addr->s2).'</td>
          </tr>
          <tr>
            <td>Village/Town</td>
            <td>'.strtoupper($p_o_addr->vt).'</td>
          </tr>
	 <tr>
            <td>Block</td>
            <td>'.strtoupper($p_o_addr->blk).'</td>
          </tr>
          <tr>
            <td>District</td>
            <td>'.strtoupper($p_o_addr->dist).'</td>
          </tr>
          
          <tr>
            <td>Pincode</td>
            <td>'.strtoupper($p_o_addr->pin).'</td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
 <tr>
    <td valign="top">3. Address of the premises</td>
    <td>
          <table class="table table-bordered table-responsive">
          <tr>
            <td>Street Name 1</td>
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
            <td>Pincode</td>
            <td>'.strtoupper($b_pincode).'</td>
          </tr>
        </table></td>
  </tr>
<tr>
  <td>4. Contact numbers of the applicant/occupier/owner</td>
    <td>Landline No: '.strtoupper($landline_std).'-'.strtoupper($landline_no).'<br>

Mobile No: +91-'.strtoupper($mobile_no).'</td>
  </tr>
 <tr>
    <td>5. Chemical name/s of the gas/gases proposed to be stored</td>
    <td>'.strtoupper($stored_chemical).'</td>
  </tr>
 <tr>
    <td>6. Quantity proposed to be stored</td>
    <td>'.strtoupper($stored_qnt).'</td>
  </tr>
<tr>
    <td>7. Type of the Storage</td>
    <td>'.strtoupper($stored_type).'</td>
  </tr>
<tr>
    <td>8. Flash Point/s of the product proposed to be Stored</td>
    <td>'.strtoupper($stored_flash_point).'</td>
  </tr>
<tr>
    <td>9. Details of the electrification in the proposed area</td>
    <td>'.strtoupper($clr_details).'</td>
  </tr>
<tr>
    <td>10. Total Storage Area/Total area of the installation</td>
    <td>'.strtoupper($t_s_area).'</td>
  </tr>
<tr>
    <td valign="top">11. Surrounding properties</td>
    <td><table class="table table-bordered table-responsive">
      <tr>
        <td>East</td>
        <td>'.strtoupper($s_properties_e).'</td>
      </tr>
      <tr>
        <td>West</td>
        <td>'.strtoupper($s_properties_w).'</td>
      </tr>
      <tr>
        <td>North</td>
        <td>'.strtoupper($s_properties_n).'</td>
      </tr>
      <tr>
        <td>South</td>
        <td>'.strtoupper($s_properties_s).'</td>
      </tr>
    </table></td>
</tr>
<tr>
    <td>12. Accessibility to the premises</td>
    <td>'.strtoupper($premise_access).'</td>
  </tr>
  <tr>
    <td valign="top">13. Open Space available around the Storage</td>
    <td><table class="table table-bordered table-responsive">
      <tr>
        <td>Eastern Side</td>
        <td>'.strtoupper($space_storage_e).'</td>
      </tr>
      <tr>
        <td>Western Side</td>
        <td>'.strtoupper($space_storage_w).'</td>
      </tr>
      <tr>
        <td>Northern Side</td>
        <td>'.strtoupper($space_storage_n).'</td>
      </tr>
      <tr>

        <td>Southern Side</td>
        <td>'.strtoupper($space_storage_s).'</td>
      </tr>
    </table></td>
  </tr>
<tr>
    <td>14. Provision made of segregate the premises</td>
    <td>'.strtoupper($segregate).'</td>
  </tr>
<tr>
    <td>15. Name of the nearest Fire Station</td>
    <td>'.strtoupper($nearest_station).'</td>
  </tr>
 <tr>
    <td valign="top">16. Details of the Fire Fighting Equipments available in the premises</td>
    <td>'.strtoupper($details_fire).'</td>
  </tr>
 <tr>
    <td valign="top">17. Details of the Water storages available in the premises</td>
    <td>'.strtoupper($details_water).'</td>
  </tr>
  <tr>
    <td valign="top">18. Details of the personnel trained in basic fire fighting (Sl. No. of the training certificate)</td>
    <td>'.strtoupper($details_trained).'<br />
    Sl. No. : '.strtoupper($details_slno).'&nbsp;
    
    </td>
  </tr>
 <tr>
    <td valign="top">19. License Number(not applciable for new applicants)</td>
    <td>'.strtoupper($license_no).'</td>
  </tr>
  <tr>
    <td valign="top">20. Any other information that the applicant desires to provide</td>
    <td>'.strtoupper($other_info).'</td>
  </tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 

	</table>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Place: '.strtoupper($dist).'<br/>
						Date: '.date('d-m-Y',strtotime($sub_date)).'
					</td>
					<td align="right">'.strtoupper($key_person).' <br/>
					Signature of the Applicant<br/>
					(Owner/ Signing Authority) 
					</td>
				</tr>';
      
	$compliance_report_details=$formFunctions->executeQuery($dept,"select * from compliance_report where uain='$uain' and active='0' and officer_id='0'");
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
	$printContents=$printContents.'
</table>'; 
?>