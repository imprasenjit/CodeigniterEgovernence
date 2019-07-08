<?php
$dept="fire";
$form="10";
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
		$form_id=$row["form_id"]; 
		$nearest_station=$row['nearest_station'];
		$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);

		$p_o_name=$row['p_o_name']; $form_id=$row['form_id'];
		$t_s_area=$row['t_s_area'];	    
		$p_accessibility=$row['p_accessibility'];	   
		$nearest_station=$row['nearest_station'];
		$details_f_f_system=$row['details_f_f_system'];
		$details_w_s=$row['details_w_s'];
		$details_p_t=$row['details_p_t'];
		$other_info=$row['other_info'];

		if(empty($row['p_o_addr']==false)){
			$p_o_addr=json_decode($row['p_o_addr']);
			$p_o_addr_s1=$p_o_addr->s1;
			$p_o_addr_s2=$p_o_addr->s2;
			$p_o_addr_vt=$p_o_addr->vt;
			$p_o_addr_blk=$p_o_addr->blk;
			$p_o_addr_dist=$p_o_addr->dist;
			$p_o_addr_pin=$p_o_addr->pin;
		}			
		if(empty($row['s_properties']==false)){
			 $s_properties=json_decode($row['s_properties']); 
			$s_properties_e=$s_properties->e;
			$s_properties_w=$s_properties->w;
			$s_properties_n=$s_properties->n;
			$s_properties_s=$s_properties->s;
		}
		if(empty($row['o_s_a_storage']==false)){
			$o_s_a_storage=json_decode($row['o_s_a_storage']);
			$o_s_a_storage_e=$o_s_a_storage->e;
			$o_s_a_storage_w=$o_s_a_storage->w;
			$o_s_a_storage_n=$o_s_a_storage->n;
			$o_s_a_storage_s=$o_s_a_storage->s;
		}		
		if(empty($row['sl_c_details']==false)){
			$sl_c_details=json_decode($row["sl_c_details"]); 
			$sl_c_details_s=$sl_c_details->s;
		}
		if(!empty($sl_c_details)){
			$sl_c_details=json_decode($row["sl_c_details"]); 
			$sl_c_details_s=$sl_c_details->s;		
		}
	}
	$other_info=$row['other_info'];
	$other_info = wordwrap($other_info, 40, "<br/>", true);
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
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
        </div><br/>
		<table class="table table-bordered table-responsive">
			<tr>
				<td valign="top" colspan="2">To,
					<br> The Director,<br>Fire & Emergency Services, Assam.<br>Through proper channel.
					<br><br>Sir,
					<br/>I/We, '.strtoupper($key_person).'&nbsp; on behalf of &nbsp;
						'.strtoupper($unit_name).'&nbsp;apply for N.O.C. in respect of Fire Prevention & Fire Safety Measures under \'Assam Fire Service Rules 1989\' for the purpose of the Existing/ Proposed storage &amp; handling pharmaceutical products, chemical industries/ storage of solvents etc. Required documents/ information as per formate furnished below.		
				</td>
			</tr>
			<tr>
				<td valign="top" colspan="2">1. Name and address of the applicant</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr>
				<td valign="top">Address</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Street Name 1</td>
							<td>'. strtoupper($street_name1).'</td>
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
				<td valign="top" colspan="2">2. Name and Address of the owner of the premises</td>
			</tr>	
			<tr>
				<td>Name</td>
				<td>'.strtoupper($p_o_name).'</td>
			</tr>
			<tr>
				<td valign="top">Address</td>
				<td><table class="table table-bordered table-responsive">
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
						<td>PIN</td>
						<td>'.$p_o_addr->pin.'</td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td valign="top">3. Address of the premises</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
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
										<td>PIN</td>
										<td>'.$b_pincode.'</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">4. Contact numbers of the applicant/occupier/owner</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Landline No </td>
							<td>'.$landline_std."-".$landline_no.'</td>
						</tr>
						<tr>
							<td>Mobile No</td>
							<td>+91-'.$mobile_no.'</td>
						</tr>
					</table>
				</td>
			</tr>
				<tr>
					<td>5. Chemicals (Raw material) proposed to be stored</td>
					<td>'.strtoupper($row['chemicals']).'</td>
				</tr>
				<tr>
					<td>6. Quantity proposed to be Stored</td>
					<td>'.strtoupper($row['quantity_stored']).'</td>
				</tr>
				<tr>
					<td>7. Type of the Storage</td>
					<td>'.strtoupper($row['type_of_storage']).'</td>
				</tr>
				<tr>
					<td>8. Flash point/s of the product proposed to be Stored</td>
					<td>'.$row['flash_point'].'</td>
				</tr>
				<tr>
					<td>9. Details of the electrification in the proposed area</td>
					<td>'.$row['electrification_details'].'</td>
				</tr>
				<tr>
					<td>10. Total Storage Area/Total area of the installation</td>
					<td>'.$row['t_s_area'].'</td>
				</tr>
				<tr>
					<td>11. Surrounding properties</td>
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
					<td>12. Accessibility to the premises </td>
					<td>'.$row['p_accessibility'].'</td>
				</tr>
				<tr>
					<td valign="top">13. Open Space available around the Storage </td>
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
					<td>16. Details of the Fire Fighting Equipments available</td>
					<td>'.strtoupper($row['details_f_f_system']).'</td>
				</tr>
				<tr>
					<td valign="top" align="left">17. Details of the water storages available in the premises</td>
					<td>'.strtoupper($row['details_w_s']).'</td>
				</tr>
				<tr>
					<td valign="top">18. Details of the personnel trained basic fire fighting (training certificate)</td>
					<td>
						<table class="table table-bordered table-responsive">
							<tr>
								<td>Details </td>
								<td>'.$row['details_p_t'].'</td>
							</tr>
							<tr>
								<td>Sl No </td>
								<td>'.strtoupper($sl_c_details->s).'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td valign="top" align="left">19. License number (not applicable for new applicants)</td>
					<td>'.strtoupper($row['lc_no']).'</td>
				</tr>
				<tr>
					<td valign="top" align="left">20. Any other information that the applicant desires to provide</td>
					<td>'.strtoupper($other_info).'</td>
				</tr>';

				$printContents=$printContents.$formFunctions->print_upload_payment_details($row);
				$printContents=$printContents.' 
			
				<tr>
					<td width="50%">Place: '.strtoupper($dist).'</td>
					<td align="right">'.strtoupper($key_person).'</td>
				</tr>
				<tr>
					<td valign="top">Date: '.date('d-m-Y',strtotime($row['sub_date'])).'</td>
					<td align="right">Signature of the Applicant<br/>
					(Owner/ Signing Authority)</td>
				</tr>
		
		';
      
	  
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
	
	$printContents=$printContents.'</table>';
?>