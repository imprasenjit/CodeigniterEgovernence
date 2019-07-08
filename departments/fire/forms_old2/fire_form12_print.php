<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form12 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form12 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form12 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form12 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
	if(!isset($css)){
		$email=$formFunctions->get_usermail($applicant_id);
	}else{
		$email=$formFunctions->get_usermail($sid);
	}
$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		//$result=$fire->query("select * from fire_form12 where user_id='$swr_id'");
        $row=$q->fetch_array();
		$holding_no=$row["holding_no"];$insurance=$row["insurance"];$noc=$row["noc"];
		
        $caller_no=$row["caller_no"];$place_occurrence=json_decode($row["place_occurrence"]);$place_occurrence_village= $place_occurrence->vt;
	$place_occurrence_ward= $place_occurrence->w;$place_occurrence_hold= $place_occurrence->h;$place_occurrence_police= $place_occurrence->p;
	$place_occurrence_district= $place_occurrence->d;$owner_address=json_decode($row["owner_address"]);$owner_address_village= $owner_address->vt;$owner_address_name= $owner_address->name;$owner_address_ward= $owner_address->w;$owner_address_hold= $owner_address->h;$owner_address_police=$owner_address->p;$owner_address_district=$owner_address->d;$occupant_address=json_decode($row["occupant_address"]);$occupant_address_village= $occupant_address->vt;$occupant_address_ward= $occupant_address->w;$occupant_name= $occupant_address->name;
     $occupant_address_hold= $occupant_address->h;$occupant_address_police=$occupant_address->p;$occupant_address_district=$occupant_address->d;$fire_desc=json_decode($row["fire_desc"]);$fire_desc_a=$fire_desc->a;$fire_desc_b=$fire_desc->b;$fire_desc_c=$fire_desc->c;$fire_desc_d=$fire_desc->d;
	
  if(!isset($css)){
    $val1=$formFunctions->get_uploadFile($row["file1"]);
    $val2=$formFunctions->get_uploadFile($row["file2"]);
    $val3=$formFunctions->get_uploadFile($row["file3"]);
    }else{
      $val1=$formFunctions->get_useruploadFile($row["file1"],$applicant_id);
      $val2=$formFunctions->get_useruploadFile($row["file2"],$applicant_id);
      $val3=$formFunctions->get_useruploadFile($row["file3"],$applicant_id);
     
     
      
    }if(!empty($row["courier_details"])&& $row["courier_details"]!=1){
   
        $courier_details=json_decode($row["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }
	$description = wordwrap($row["description"], 40, "<br/>", true);
	$descript_property = wordwrap($row["descript_property"], 40, "<br/>", true);
	$property_insured = wordwrap($row["property_insured"], 40, "<br/>", true);
	$property_uninsured = wordwrap($row["property_uninsured"], 40, "<br/>", true);
	$human_life = wordwrap($row["human_life"], 40, "<br/>", true);
$form_name=$formFunctions->get_formName('fire','12');
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form XIII</title>
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
        '.$assamSarkarLogo.'<h4>FORM NO. XIII</h4>
		<h4>Rule-19</h4>
        <h4>FORM OF APPLICATION FOR '.$form_name.' , ASSAM FIRE SERVICE RULES 1989</h4>
        </div>
       <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >  
			<tr>
				<td>
					 <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0" >  
						<tr>	
							<td width="5%">To,</td><td width="95%">&nbsp;</td>
						</tr>
						<tr>
							<td width="5%"></td>
							<td width="95%">
								The Director,<br/>Fire &amp; Emergency Services, Assam<br/>Panbazar, Guwahati-1.<br/>Through proper channel.
							</td>
						</tr>
						<tr>
							<td colspan="2">Sub:- 	Fire Attendance Certificate/Special Service Attendance Certificate</td>
						</tr>
	
						<tr>
							<td width="5%">Sir,</td><td width="95%">&nbsp;</td>
						</tr>
						<tr>
							<td width="5%"></td>
							<td width="95%">I/We&nbsp; '.strtoupper($key_person).'&nbsp; may kindly be issued a Fire Attendance Certificate/ Special Service Attendance Certificate of Fire Incident/ occurred on dated '.$row['occured_date'].'&nbsp; at &nbsp;'.$row['ocured_time'].'(Hrs.)
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table border="1" class="table table-bordered table-responsive" style="margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;">	
			<tr>
				<td width="50%" valign="top">&nbsp;1. Name of caller with Telephone Number</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">Name </td>
							<td >&nbsp;'.strtoupper($row['caller_name']).'</td>
						</tr>
				
						<tr>
							<td>&nbsp;Mobile No. </td>
							<td>&nbsp;+91&nbsp;'.$caller_no.'</td>
						</tr>
					</table>
				</td>
			</tr>		
			<tr>
				<td width="50%" valign="top">&nbsp;2. Date and Time of Occurence</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;Date: </td>
							<td >&nbsp;'.$row['occured_date'].'</td>
						</tr>
						<tr>
							<td>&nbsp;Time: </td>	
							<td>&nbsp;'.$row['ocured_time'].'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;3. Name of nearest Fire &amp; Emergency Services Station</td>
				<td>&nbsp;'.strtoupper($row['fire_station']).'</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;4. Distance from the Fire & E.S. Station to the place of occurence in KM</td>
				<td>&nbsp;'.strtoupper($row['distance_fire']).'&nbsp;(Km.)&nbsp; </td>
			</tr>
			<tr>
				<td width="50%" valign="top">&nbsp;5. Place of occurrence</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;i. Village/Town </td>
							<td >&nbsp;'.strtoupper($place_occurrence_village).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($place_occurrence_ward).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($place_occurrence_hold).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($place_occurrence_police).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($place_occurrence_district).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;6. Name & Address of Owner of the Property</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;Owner Name </td>
							<td >&nbsp;'.strtoupper($owner_address_name).'</td>
						</tr>
						<tr>
							<td>&nbsp;i. Village/Town</td>
							<td>&nbsp;'.strtoupper($owner_address_village).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($owner_address_ward).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($owner_address_hold).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($owner_address_police).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($owner_address_district).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;7. Name &amp; Address of the occupants</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;Name </td>
							<td>&nbsp;'.strtoupper($occupant_name).'</td>
						</tr>
						<tr>
							<td>&nbsp;i. Village/Town</td>
							<td>&nbsp;'.strtoupper($occupant_address_village).'</td>
						</tr>
						<tr>
							<td>&nbsp;ii. Ward No</td>
							<td>&nbsp;'.strtoupper($occupant_address_ward).'</td>
						</tr>
						<tr>
							<td>&nbsp;iii. Holding No</td>
							<td>&nbsp;'.strtoupper($occupant_address_hold).'</td>
						</tr>
						<tr>
							<td>&nbsp;iv. Police Station</td>
							<td>&nbsp;'.strtoupper($occupant_address_police).'</td>
						</tr>
						<tr>
							<td>&nbsp;v. District</td>
							<td>&nbsp;'.strtoupper($occupant_address_district).'</td>
						</tr>				
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">&nbsp;8. Brief Description of Property involved and gutted in fire</td>
				<td>
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;a. Nature of construction of the building </td>
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
					<table width="100%" class="table table-bordered table-responsive" border="1" style="border-collapse:collapse;">
						<tr>
							<td width="50%">&nbsp;a. Holding No. of the building: </td>
							<td >&nbsp;'.strtoupper($holding_no).'</td>
						</tr>
						<tr>
							<td>&nbsp;b. Insurance policy:</td>
							<td>&nbsp;'.strtoupper($insurance).'</td>
						</tr>
						<tr>
							<td>&nbsp;c. Fire Safety N.O.C./ Trade License/ any other License or Permission etc. from concerned authority:</td>
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
			<tr>
				<td valign="top" colspan="2">&nbsp;13. Checklists of documents-- <br/>*N/A--Not Available<br/>*S/C--Send By Courier</td>
			</tr>
			<tr>
				<td colspan="2">
					<table  width="100%" border="1" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
						<tr>
							<td width="50%">a. Holding No of the building</td>
							<td>'.$val1.'</td>
						</tr>
						<tr>
							<td>b. Insurance Policy</td>
							<td>'.$val2.'</td>
						</tr>
						<tr>
							<td>c. Fire Safety N.O.C./Trade License/any other License <br/>or Permission etc. from concerned authority</td>
							<td>'.$val3.'</td>
						</tr>
					</table>
          ';
    if(!empty($row["courier_details"])&& $row["courier_details"]!=1){
      $printContents=$printContents.'
				<tr><td colspan="2">Courier Details.</td></tr>
				<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
				<tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
				<tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
       
     '; 
    } 
  $printContents=$printContents.'  
			</td>
		</tr>
	</td>
</tr>
</table><br/><br/>
<table border="0" class="table table-bordered table-responsive" style="margin-left:auto;margin-right:auto;width:100%;border-collapse:collapse;">	
	<tr>
		<td width="50%">Date:&nbsp;'.date('d-m-Y',strtotime($row["sub_date"])).'</td>
			<td style="text-align:right">&nbsp;'.strtoupper($key_person).'<br/>
		</td>
			
	</tr>	
	<tr>
		<td>Place:&nbsp;'.strtoupper($dist).'</td>
		<td style="text-align:right">Signature of the Applicant</td>
	</tr>
</table>'; 
?>