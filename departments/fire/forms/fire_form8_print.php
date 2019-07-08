<?php
 $dept="fire";
 $form="8";
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
		$row=$q->fetch_array();
	    $form_id=$row['form_id'];$owner_name=$row['owner_name'];
		if(!empty($row["o_s_a_storage"])){
			$o_s_a_storage=json_decode($row["o_s_a_storage"]);
			$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
		}else{				
			$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
		}	
		if(!empty($row["owner_address"])){
			$owner_address=json_decode($row["owner_address"]);
			$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
		}else{				
			$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
		}					
		if(!empty($row["surround_prop"])){	
				 $surround_prop=json_decode($row["surround_prop"]);
				 $surround_prop_e=$surround_prop->e;
				 $surround_prop_w=$surround_prop->w;
				 $surround_prop_n=$surround_prop->n;
				 $surround_prop_s=$surround_prop->s;
		}else{				
			$surround_prop_e="";$surround_prop_w="";$surround_prop_n=""; $surround_prop_s="";
		}		
		if(!empty($row["os_width"])){	
				 $os_width=json_decode($row["os_width"]);
				 $os_width_e=$os_width->e;
				 $os_width_w=$os_width->w;
				 $os_width_n=$os_width->n;
				 $os_width_s=$os_width->s;	
		}else{				
			$os_width_e="";$os_width_w="";$os_width_n=""; $os_width_s="";
		}			
		$chemical_stored=$row["chemical_stored"];$quantity_stored=$row["quantity_stored"];$type_storage=$row["type_storage"];
		$flash_stored=$row["flash_stored"];$details_electric=$row["details_electric"];$total_area=$row["total_area"];
		$access_premises=$row["access_premises"];$provision_segregate=$row["provision_segregate"];$size_exit=$row["size_exit"];
		$nearest_station=$row["nearest_station"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_no=$row["license_no"];
		$other_info=$row["other_info"];
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
if(!empty($row["uain"])){
  $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($row["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center">
    '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/>
<table class="table table-bordered table-responsive"> 
	<tr>
		<td colspan="2%">To,<br/> The Director,<br>Fire & Emergency Services, Assam<br>Through proper channel </td>
	</tr>
	<tr>
		<td colspan="2%">Sir,<br/>I/We, &nbsp;'.strtoupper($key_person).'&nbsp; on behalf of &nbsp;'.strtoupper($unit_name).'&nbsp;apply for N.O.C. in respect of Fire Prevention &amp; Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of the Existing/ Proposed storage and handling of chemicals. Required documents/ information as per formate furnished below.</td>
	</tr>
	<tr>
		<td colspan="2">1. Name and address of the Applicant</td>
	</tr>
	<tr>
		<td width="50%">Name</td>
		<td> '.strtoupper($key_person).'</td>
	</tr>
	<tr>
		<td>Address</td>
		<td>
			<table class="table table-bordered table-responsive">	
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
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">2. Name and Address of the owner of the premises</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>'.strtoupper($owner_name).'</td>
	</tr>
	<tr>
		<td>Address </td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>Street Name 1</td>
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
				<td>Pincode</td>
				<td>'.strtoupper($owner_address_pin).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>3. Address of the premises</td>
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
			</table>
		</td>
	</tr>
	<tr>
		<td>4. Contact numbers of the applicant/occupier/owner</td>
		<td>Landline No: '.$landline_std.'-'.$landline_no.'<br>Mobile No: +91-'.$mobile_no.'</td>
	</tr>
	<tr>
		<td>5. Chemicals proposed to be stored</td>
		<td>'.strtoupper($row['chemical_stored']).'</td>
	</tr>
	<tr>
		<td>6. Quantity proposed to be Stored</td>
		<td>'.strtoupper($row['quantity_stored']).'</td>
	</tr>
	<tr>
		<td>7. Type of the Storage</td>
		<td>'.strtoupper($row['type_storage']).'</td>
	</tr>
	<tr>
		<td>8. Flash point/s of the product proposed to be Stored</td>
		<td>'.strtoupper($row['flash_stored']).'</td>
	</tr>
	<tr>
		<td>9. Details of the electrification in the proposed area</td>
		<td>'.strtoupper($row['details_electric']).'</td>
	</tr>
	<tr>
		<td>10. Total Storage Area/ Total area of the installation</td>
		<td>'.strtoupper($row['total_area']).'</td>
	</tr>
	<tr>
		<td>11. Surrounding properties</td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>East</td>
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
			</table>
		</td>
	</tr>
	<tr>
		<td>12. Accessibility to the premises</td>
		<td>'.strtoupper($row['access_premises']).'</td>
	</tr>
	<tr>
		<td>13. Open Space available around the Storage</td>
		<td>
			<table class="table table-bordered table-responsive">
				<tr>
					<td>Eastern Side</td>
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
			</table>
		</td>
	</tr>
	<tr>
		<td>14. Provision made of segregate the premises</td>
		<td>'.strtoupper($row['provision_segregate']).'</td>
	</tr>
	<tr>
		<td>15. Name, Type and size of the exits</td>
		<td>'.strtoupper($row['size_exit']).'</td>
	</tr>
	<tr>
		<td>16. Name of the nearest Fire Station</td>
		<td>'.strtoupper($nearest_station).'</td>
	</tr>
	<tr>
		<td>17. Details of the Fire Fighting Equipments available</td>
		<td>'.strtoupper($row['fire_details']).'</td>
	</tr>
	<tr>
		<td>18. Details of the water storages available in the premises</td>
		<td>'.strtoupper($row['water_details']).'</td>
	</tr>
	<tr>
		<td>19. Details of the personnel trained basic fire fighting (Sl. No of the training certificate)</td>
		<td>'.strtoupper($row['personnel_details']).'<br />Sl. NO : '.strtoupper($row['s_no']).'&nbsp;</td>
        </tr>
	<tr>
		<td>20. License number (not applicable for new applicants)</td>
		<td>'.strtoupper($row['license_no']).'</td>
	</tr>
	<tr>
		<td>21. Any other information that the applicant desires to provide</td>
		<td> '.strtoupper($row['other_info']).'</td>
	</tr>
	';
					
		$printContents=$printContents.$formFunctions->print_upload_payment_details($row);
		$printContents=$printContents.' 
						
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Place: '.strtoupper($dist).'</td>
					<td align="right">'.strtoupper($key_person).'</td>
				</tr>
				<tr>
					<td>Date: '.date('d-m-Y',strtotime($row["sub_date"])).'</td>
					<td align="right">Signature of the Applicant<br/>
					(Owner/ Signing Authority)</td>
				</tr>
			</table>
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