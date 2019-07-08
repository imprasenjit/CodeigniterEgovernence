<?php
$dept="fire";
$form="7";
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
		$form_id=$row['form_id'];$sub_date=$row["sub_date"];$p_o_name=$row['p_o_name'];
		$nearest_station=$row['nearest_station'];
		$type_of_storage=$row['type_of_storage'];
			
		if(!empty($row["owner_address"])){	
				 $owner_address=json_decode($row["owner_address"]);
				 $owner_address_s1=$owner_address->s1;
				 $owner_address_s2=$owner_address->s2;
				 $owner_address_vill=$owner_address->vill;
				 $owner_address_dist=$owner_address->dist;
				 $owner_address_pin=$owner_address->pin;
				 $owner_address_blk=$owner_address->blk;
		}else{				
			$owner_address_s1="";$owner_address_s2="";$owner_address_vill="";$owner_address_dist="";$owner_address_pin="";$owner_address_block="";
		}   
		if(!empty($row["s_properties"])){	
				 $s_properties=json_decode($row["s_properties"]);
				 $s_properties_e=$s_properties->e;
				 $s_properties_w=$s_properties->w;
				 $s_properties_n=$s_properties->n;
				 $s_properties_s=$s_properties->s;
		}else{				
			$s_properties_e="";$s_properties_w="";$s_properties_n=""; $s_properties_s="";
		}		
		if(!empty($row["o_s_a_storage"])){	
				 $o_s_a_storage=json_decode($row["o_s_a_storage"]);
				 $o_s_a_storage_e=$o_s_a_storage->e;
				 $o_s_a_storage_w=$o_s_a_storage->w;
				 $o_s_a_storage_n=$o_s_a_storage->n;
				 $o_s_a_storage_s=$o_s_a_storage->s;
		}else{				
			$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
		}		    
		if(!empty($row["sl_c_details"])){	
				 $sl_c_details=json_decode($row["sl_c_details"]);
				 $sl_c_details_s=$sl_c_details->s;
		}else{	
		   $sl_c_details_s="";
		}		
		if(!empty($row["quantity_stored"])){
			$quantity_stored=json_decode($row["quantity_stored"]);
			if(isset($quantity_stored->a)) $quantity_stored_a=$quantity_stored->a; else $quantity_stored_a="";
			if(isset($quantity_stored->b)) $quantity_stored_b=$quantity_stored->b; else $quantity_stored_b="";
			if(isset($quantity_stored->c)) $quantity_stored_c=$quantity_stored->c; else $quantity_stored_c="";
			if(isset($quantity_stored->d)) $quantity_stored_d=$quantity_stored->d; else $quantity_stored_d="";
		}else{
			$quantity_stored_a="";$quantity_stored_b="";$quantity_stored_c="";$quantity_stored_d="";
			 
		}		
		$quantity_stored_values="";		
		if($quantity_stored_a=="M") $quantity_stored_values=$quantity_stored_values. '<span class="tickmark">&#10004;</span> M.S';
		if($quantity_stored_b=="H") $quantity_stored_values=$quantity_stored_values. '<span class="tickmark">&#10004;</span> HSD';
		if($quantity_stored_c=="R") $quantity_stored_values=$quantity_stored_values. '<span class="tickmark">&#10004;</span> RSK';
		if($quantity_stored_d=="F") $quantity_stored_values=$quantity_stored_values. '<span class="tickmark">&#10004;</span> PFO';	
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
		<td colspan="2%">Sir,<br/><p>I/We, &nbsp;'.strtoupper($key_person).'&nbsp; on behalf of &nbsp;'.strtoupper($unit_name).'&nbsp;apply for N.O.C. in respect of Fire Prevention & Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of Existing/ Proposed storage &amp; handling of petroleum products(class-a, class-b and class-c). Required documents/information as per formate furnished below.</p></td>
	</tr>
	<tr>
		<td colspan="2">1. Name and address of the Applicant</td>
	</tr>
	<tr>
		<td width="50%">Name</td>
		<td>'.strtoupper($key_person).'</td>
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
					<td>'.$pincode.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">2. Name and Address of the owner of the premises</td>
	</tr>
	<tr>
		<td>Name</td>
		<td>'.strtoupper($row['p_o_name']).'</td>
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
					<td>'.strtoupper($owner_address_vill).'</td>
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
					<td>'.$owner_address_pin.'</td>
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
					<td>Street Name 2</td>'.strtoupper($key_person).'
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
					<td>'.$b_pincode.'</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>4. Contact numbers of the applicant/occupier/owner</td>
		<td>Landline No: '.$landline_std.'-'.$landline_no.'<br>Mobile No: +91-'.$mobile_no.'</td>
	</tr>
	<tr>
		<td>5. Classification of petroleum product</td>
		<td>'.strtoupper($row['product_clasification']).'</td>
	</tr>
	<tr>
		<td>6. Quantity proposed to be Stored</td>
		<td>'.strtoupper($quantity_stored_values).'</td>
	</tr>
	<tr>
		<td>7. Type of the Storage</td>
		<td>'.strtoupper($type_of_storage).'</td>
	</tr>
	<tr>
		<td>8. Flash points of the product proposed to be Stored</td>
		<td>'.strtoupper($row['flash_point']).'</td>
	</tr>
	<tr>
		<td>9. Details of the electrification in the proposed area</td>
		<td>'.strtoupper($row['electrification_details']).'</td>
	</tr>
	<tr>
		<td>10. Total Storage Area/ Total area of the installation</td>
		<td>'.strtoupper($row['t_s_area']).'</td>
	</tr>
	<tr>
		<td>11. Surrounding properties:</td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>East</td>
				<td>'.strtoupper($s_properties->e).'</td>
			</tr>
			<tr>
				<td>West</td>
				<td>'.strtoupper($s_properties->w).'</td>
			</tr>
			<tr>
				<td>North</td>
				<td>'.strtoupper($s_properties->n).'</td>
			</tr>
			<tr>
				<td>South</td>
				<td>'.strtoupper($s_properties->s).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>12. Accessibility to the premises</td>
		<td>'.strtoupper($row['p_accessibility']).'</td>
	</tr>
	<tr>
		<td>13. Open Space available around the Storage:</td>
		<td>
			<table class="table table-bordered table-responsive">
			<tr>
				<td>Eastern Side</td>
				<td>'.strtoupper($o_s_a_storage->e).'</td>
			</tr>
			<tr>
				<td>Western Side</td>
				<td>'.strtoupper($o_s_a_storage->w).'</td>
			</tr>
			<tr>
				<td>Northern Side</td>
				<td>'.strtoupper($o_s_a_storage->n).'</td>
			</tr>
			<tr>
				<td>Southern Side</td>
				<td>'.strtoupper($o_s_a_storage->s).'</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td>14. Provision made of segregate the premises</td>
		<td>'.strtoupper($row['segregate']).'</td>
	</tr>
	<tr>
		<td>15. Name of the nearest Fire Station</td>
		<td>'.strtoupper($nearest_station).'</td>
	</tr>
	<tr>
		<td>16. Details of the Fire Fighting Equipments available in the premises</td>
		<td>'.strtoupper($row['details_f_f_system']).'</td>
	</tr>
	<tr>
		<td>17. Details of the water storages available in the premises</td>
		<td>'.strtoupper($row['details_w_s']).'</td>
	</tr>
	<tr>
		<td>18. Details of the personnel trained in basic fire fighting (training certificate number)</td>
		<td>Name : '.strtoupper($row['details_p_t']).'<br/>Sl No : '.strtoupper($sl_c_details->s).'</td>
	</tr>
	<tr>
		<td>19. License number (not applicable for new applicants)</td>
		<td>'.strtoupper($row['lc_no']).'</td>
	</tr>
	<tr>
		<td>20. Any other information that the applicant desires to provide</td>
		<td>'.strtoupper($row['other_info']).'</td>
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