<?php
$dept="fire";
$form="4";
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
	
	
	if($q->num_rows>0)
	{
		$row=$q->fetch_array(); 
		$form_id=$row['form_id'];
			$lc_no=$row['lc_no'];
		    $lc_date=$row['lc_date'];
		    $p_o_name=$row['p_o_name'];
			$p_o_addr=json_decode($row['p_o_addr']);
			$p_o_addr_s1=$p_o_addr->s1;
			$p_o_addr_s2=$p_o_addr->s2;
			$p_o_addr_vt=$p_o_addr->vt;
			$p_o_addr_blk=$p_o_addr->blk;
			$p_o_addr_dist=$p_o_addr->dist;
			$p_o_addr_pin=$p_o_addr->pin;
			
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
			if(empty($row['tel_no']==false)){
				$tel_no=json_decode($row['tel_no']);
				$tel_no_stc=$tel_no->stc;
				$tel_no_lno=$tel_no->lno;
			}
			if(empty($row['sl_c_details']==false)){
				$sl_c_details=json_decode($row["sl_c_details"]); 
				$sl_c_details_s=$sl_c_details->s;
				$sl_c_details_c=$sl_c_details->c;
			}

		$t_s_area=$row['t_s_area'];$t_b_area=$row['t_b_area'];$p_accessibility=$row['p_accessibility'];$n_o_floors=$row['n_o_floors'];
	    $occupancy=$row['occupancy'];$access=$row['access'];$w_premises=$row['w_premises'];	$w_building=$row['w_building'];
		$emergency=$row['emergency'];$parking=$row['parking'];$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
	    $parking=$row['parking'];	$nearest_station=$row['nearest_station'];$details_f_f_system=$row['details_f_f_system'];
		$details_w_s=$row['details_w_s'];$details_p_t=$row['details_p_t'];$other_info=$row['other_info'];
		
		$nearest_station=$row['nearest_station'];
		$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);
		
		if($parking=="Y"){
			$parking="YES";
		}else{
			$parking="NO";
			$two_wheeler="N/A";
			$four_wheeler="N/A";	
		}
		if(!empty($sl_c_details)){
		$sl_c_details=json_decode($row["sl_c_details"]); 
		$sl_c_details_s=$sl_c_details->s;	$sl_c_details_c=$sl_c_details->c;
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
if(!empty($row["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($row["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
        </div><br/>
			<table class="table table-bordered table-responsive"> 
						
								
							<tr>
										<td>To,<br/>
							
										The Director,<br/>Fire & Emergency Services, Assam<br>Through proper channel<br/><br/>
								    Sir,<br/>
									I/We, &nbsp;'.strtoupper($key_person).' on behalf of &nbsp;
									'.strtoupper($unit_name).'&nbsp;apply for N.O.C. in respect of Fire Safety Measures under "Assam Fire Service Rules 1989" for the purpose of Existing/ Proposed cinema theatres, multiplex etc. Required documents/information as per format furnished below.
								</td>
							</tr>
		
					
		<table class="table table-bordered table-responsive">
			<tr>
				<td>1. Name and address of the Applicant</td>
				<td width="60%">
					<table class="table table-bordered table-responsive">
							<tr>
									<td width="20%">Name</td>
									<td>'.strtoupper($key_person).'</td>
							</tr>
							<tr>
								<td valign="top">Address</td>
								<td><table class="table table-bordered table-responsive">
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
											<td>'.strtoupper($pincode).'</td>
									</tr>
								</table></td>
							</tr>
					</table>
				</td>
			</tr>
						<tr>
							<td>2. Name and Address of the owner of the premises</td>
							<td><table class="table table-bordered table-responsive">
								<tr>
										<td width="20%">Name</td>
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
									</table></td>
								</tr>
							</table>
						</td>
					</tr>
							<tr>
								<td>3. Address of the premises</td>
								<td><table class="table table-bordered table-responsive">
									<tr>
										<td valign="top" width="20%">Address</td>
										<td><table class="table table-bordered table-responsive">
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
										
									
								</table></td>
							</tr>
						</table>
						</td>
						</tr>
						<tr>
							<td>4. Contact numbers of the applicant/occupier/owner</td>
						</tr>

						<tr>
							<td>Landline No </td>
							<td>'.$landline_std."-".$landline_no.'</td>
						</tr>
						<tr>
							<td>Mobile No</td>
							<td>+91-'.$mobile_no.'</td>
						</tr>
									

						
					<tr>
						<td>5. License Number and date of issue</td>
					</tr>	
					<tr>
						<td>License no</td>
						<td>'.strtoupper($lc_no).'</td>
					</tr>
					<tr>
						<td>Date of issue</td>
						<td>'.strtoupper($lc_date).'</td>
					</tr>
							
					<tr>
						<td>6. Total site area</td>
						<td>'.strtoupper($t_s_area).'</td>
					</tr>
					<tr>
						<td>7. Total built up area</td>
						<td>'.strtoupper($t_b_area).'</td>
					</tr>
				
					<tr>
						<td>8. Accessibility to the premises</td>
						<td>'.strtoupper($p_accessibility).'</td>
					</tr>
					
								<tr>
									<td>9. Surrounding properties</td>
									<td><table class="table table-bordered table-responsive">
										<tr>
											<td>East</td>
											<td >'.strtoupper($s_properties->e).'</td>
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
									</table></td>
								</tr>
							

						<tr>
							<td> 10. Number of floors</td>
							<td>'.strtoupper($n_o_floors).'</td>
						</tr>
					
						<tr>
							<td>11. Occupancy in each floor</td>
							<td>'.strtoupper($occupancy).'</td>
						</tr>
						
								<tr>
									<td>12. Open Space available around the Structure</td>
									<td><table class="table table-bordered table-responsive">
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
									</table></td>
								</tr>
							
						<tr>
							<td>13. Access to the premises</td>
							<td>'.$row['access'].'</td>
						</tr>
							
						
						<tr>
							<td>14. Width of entry/exit</td>
						</tr>
						<tr>
							<td>a. Premises</td>
							<td>'.strtoupper($row['w_premises']).'</td>
						</tr>
						<tr>
							<td>b. Building</td>
							<td>'.strtoupper($row['w_building']).'</td>
						</tr>
						<tr>
							<td>15. Number of emergency exits, sizes, etc</td>
							<td>'.strtoupper($row['emergency']).'</td>
						</tr>
							
					 <tr>
						<td>16. Provision of parking 2 wheelers and 4 wheelers</td>
						<td>'.strtoupper($parking).' &nbsp;&nbsp;&nbsp;
						Two wheeler : '.strtoupper($two_wheeler).'&nbsp;&nbsp;&nbsp;Four wheeler : '.strtoupper($four_wheeler).'</td>
					</tr>
					<tr>
					   <td>17. Name of the nearest Fire Station and telephone number</td>
					 </tr>
						
					<tr>
						<td>Name</td>
						<td>'.strtoupper($nearest_station).'</td>
					</tr>
					<tr>
						<td>Telephone Number</td>
						<td>'.$tel_no->stc.'-'.$tel_no->lno.'</td>
					</tr>
									
						
					<tr>
						<td>18. Details of the Fire Fighting System/Equipments available</td>
						<td>'.strtoupper($details_f_f_system).'</td>
					</tr>
							

						
					<tr>
						<td>19. Details of the water storages available in the premises</td>
						<td>'.strtoupper($details_w_s).'</td>
					</tr>
				

			
					<tr>
						<td>20. Details of the personnel trained basic fire fighting (Sl. No of training certificates)</td>
						<td>'.strtoupper($details_p_t).'<br/>
							Sl.no :'.strtoupper($sl_c_details->s).'&nbsp;
							Certificate :'.strtoupper($sl_c_details->c).'
						</td>
					
				  </tr>
			
					<tr>
						<td>21. Any other information that the applicant desire to provide</td>
						<td>'.strtoupper($other_info).'</td>
				  </tr>
			';
		
					$printContents=$printContents.$formFunctions->print_upload_payment_details($row);
					$printContents=$printContents.' 

					</table>
					
					 <tr>
                        <td colspan="2">
					<table class="table table-bordered table-responsive">
							<tr>
								<td width="50%">Place: '.strtoupper($dist).'</td>
								<td align="right">'.strtoupper($key_person).'</td>
							</tr>
							<tr>
								<td valign="top">Date: '.date('d-m-Y',strtotime($row['sub_date'])).'</td>
								<td align="right">Signature of the Applicant<br/>
								(Owner/ Signing Authority)</td>
							</tr>
					</table>
					</td></tr>';
						  
	  
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