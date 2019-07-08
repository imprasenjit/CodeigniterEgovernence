<?php
$dept="fire";
$form="12";
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
		
		$caller_name=$results["caller_name"];  $description=$results["description"]; $caller_no=$results["caller_no"];
				$occured_date=$results["occured_date"]; $ocured_time=$results["ocured_time"];$nearest_station =$results["nearest_station"];$distance_fire =$results["distance_fire"];
				$descript_property =$results["descript_property"];$property_insured =$results["property_insured"];$property_uninsured =$results["property_uninsured"];$human_life =$results["human_life"];	
				$holding_no=$results['holding_no'];$insurance=$results['insurance'];$noc=$results['noc'];	
					  
				if(!empty($results["place_occurrence"]))
				{
					$place_occurrence=json_decode($results["place_occurrence"]);
					$place_occurrence_vt=$place_occurrence->vt;$place_occurrence_w=$place_occurrence->w;$place_occurrence_h=$place_occurrence->h;
					$place_occurrence_p=$place_occurrence->p;$place_occurrence_d=$place_occurrence->d;
					
				}
				else
				{
					$place_occurrence_vt="";$place_occurrence_w="";$place_occurrence_h="";$place_occurrence_p="";$place_occurrence_d="";
				}
				if(!empty($results["owner_address"]))
				{
					$owner_address=json_decode($results["owner_address"]);
					$owner_address_name=$owner_address->name;$owner_address_vt=$owner_address->vt;$owner_address_w=$owner_address->w;$owner_address_h=$owner_address->h;$owner_address_p=$owner_address->p;$owner_address_d=$owner_address->d;
				}
				else
				{
					$owner_address_name="";$owner_address_vt="";$owner_address_w="";$owner_address_h="";$owner_address_p="";$owner_address_d="";
				}
				if(!empty($results["occupant_address"]))
				{
					$occupant_address=json_decode($results["occupant_address"]);
					$occupant_address_name=$occupant_address->name;$occupant_address_vt=$occupant_address->vt;$occupant_address_w=$occupant_address->w;$occupant_address_h=$occupant_address->h;$occupant_address_p=$occupant_address->p;$occupant_address_d=$occupant_address->d;
				}
				else
				{
					$occupant_address_name="";$occupant_address_vt="";$occupant_address_w="";$occupant_address_h="";$occupant_address_p="";$occupant_address_d="";
				}
				if(!empty($results["fire_desc"]))
				{
					$fire_desc=json_decode($results["fire_desc"]);
					$fire_desc_a=$fire_desc->a;$fire_desc_b=$fire_desc->b;$fire_desc_c=$fire_desc->c;$fire_desc_d=$fire_desc->d;
				}
				else
				{
					$fire_desc_a="";$fire_desc_b="";$fire_desc_c="";$fire_desc_d="";
					$fire_desc_e="";	
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
  height: 120px;
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
       <table class="table table-bordered table-responsive" border="1"> 
			<tr>
				<td colspan="2">To<br/>&nbsp;&nbsp;The Director,<br/>&nbsp;&nbsp;Fire &amp; Emergency Services, Assam<br/>
					Sub:- 	Fire Attendance Certificate/Special Service Attendance Certificate<br/>
					<br/><br/>Sir,
					<br/>I/We&nbsp; '.strtoupper($key_person).'&nbsp; may kindly be issued a Fire Attendance Certificate/ Special Service Attendance Certificate of Fire Incident/ occurred on dated '.$results['occured_date'].'&nbsp; at &nbsp;'.$results['ocured_time'].'(Hrs.)
				</td>
			</tr>
		
		<table border="1" class="table table-bordered table-responsive" style="margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;">	
			<tr>
				<td valign="top">&nbsp;1. Name of caller with Telephone Number</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Name </td>
							<td>&nbsp;'.strtoupper($caller_name).'</td>
						</tr>
				
						<tr>
							<td>&nbsp;Mobile No. </td>
							<td>&nbsp;+91&nbsp;'.$caller_no.'</td>
						</tr>
					</table>
				</td>
			</tr>		
			<tr>
				<td valign="top">&nbsp;2. Date and Time of Occurence</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;Date: </td>
							<td >&nbsp;'.$occured_date.'</td>
						</tr>
						<tr>
							<td>&nbsp;Time: </td>	
							<td>&nbsp;'.$ocured_time.'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;3. Name of nearest Fire &amp; Emergency Services Station</td>
				<td>&nbsp;'.strtoupper($nearest_station).'</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;4. Distance from the Fire & E.S. Station to the place of occurence in KM</td>
				<td>&nbsp;'.strtoupper($distance_fire).'&nbsp;(Km.)&nbsp; </td>
			</tr>
			<tr>
				<td valign="top">&nbsp;5. Place of occurrence</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;i. Village/Town </td>
							<td>&nbsp;'.strtoupper($place_occurrence_vt).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($place_occurrence_w).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($place_occurrence_h).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($place_occurrence_p).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($place_occurrence_d).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;6. Name & Address of Owner of the Property</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;Owner Name </td>
							<td>&nbsp;'.strtoupper($owner_address_name).'</td>
						</tr>
						<tr>
							<td>&nbsp;i. Village/Town</td>
							<td>&nbsp;'.strtoupper($owner_address_vt).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($owner_address_w).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($owner_address_h).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($owner_address_p).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($owner_address_d).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;7. Name &amp; Address of the occupants</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;Name </td>
							<td>&nbsp;'.strtoupper($occupant_address_name).'</td>
						</tr>
						<tr>
							<td>&nbsp;i. Village/Town</td>
							<td>&nbsp;'.strtoupper($occupant_address_vt).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($occupant_address_w).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($occupant_address_h).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($occupant_address_p).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($occupant_address_d).'</td>
						</tr>				
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;8. Brief Description of Property involved and gutted in fire</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;a. Nature of construction of the building </td>
							<td >&nbsp;'.strtoupper($fire_desc_a).'</td>
						</tr>
						<tr>
							<td>&nbsp;b. Height of the building</td>
							<td>&nbsp;'.strtoupper($fire_desc_b).'</td>
						</tr>
						<tr>
							<td>&nbsp;c. Number of Floors</td>
							<td>&nbsp;'.strtoupper($fire_desc_c).'</td>
						</tr>
						<tr>
							<td>&nbsp;d. Covered Floor Area</td>
							<td>&nbsp;'.strtoupper($fire_desc_d).'</td>
						</tr>
						<tr>
							<td valign="top">&nbsp;e. Description of internal contents</td>
							<td>&nbsp;'.strtoupper($description).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;9. Documentary/ Evidential proof of Property gutted / involved in Fire:</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>&nbsp;a. Holding No. of the building </td>
							<td>&nbsp;'.strtoupper($holding_no).'</td>
						</tr>
						<tr>
							<td>&nbsp;b. Insurance policy</td>
							<td>&nbsp;'.strtoupper($insurance).'</td>
						</tr>
						<tr>
							<td>&nbsp;c. Fire Safety N.O.C./ Trade License/ any other License or Permission etc. from concerned authority</td>
							<td>&nbsp;'.strtoupper($noc).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;10. Description of internal Content/Property</td>
				<td>&nbsp;'.strtoupper($descript_property).'</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;11. a. Property Insured</td>
				<td>&nbsp;'.strtoupper($property_insured).'</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Property Uninsured</td>
				<td>&nbsp;'.strtoupper($property_uninsured).'</td>
			</tr>
			<tr>
				<td valign="top">12. If Human Life or Animal Life injured/lost if any, give details</td>
				<td>&nbsp;'.strtoupper($human_life).'</td>
			</tr>
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 

			</table>			
			<table border="0" class="table table-bordered table-responsive" style="margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;">	
				<tr>
					<td width="50%">Date:&nbsp;'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						<td style="text-align:right">&nbsp;'.strtoupper($key_person).'<br/>
					</td>
						
				</tr>	
				<tr>
					<td>Place:&nbsp;'.strtoupper($dist).'</td>
					<td style="text-align:right">Signature of the Applicant</td>
				</tr>
			</table>
		'; 
?>