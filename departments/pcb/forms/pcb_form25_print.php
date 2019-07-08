<?php
$dept="pcb";
$form="25";
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
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$facility_loc=$results["facility_loc"];$import_reason=$results["import_reason"];$details_of_import=$results["details_of_import"];$port_of_entry=$results["port_of_entry"];	
		
	if(!empty($results["imp_outside_address"])){
		$imp_outside_address=json_decode($results["imp_outside_address"]);
		$imp_outside_address_name=$imp_outside_address->name;$imp_outside_address_st1=$imp_outside_address->st1;$imp_outside_address_st2=$imp_outside_address->st2;$imp_outside_address_vt=$imp_outside_address->vt;$imp_outside_address_dist=$imp_outside_address->dist;$imp_outside_address_pin=$imp_outside_address->pin;$imp_outside_address_mob=$imp_outside_address->mob;$imp_outside_address_email=$imp_outside_address->email;			
	}else{
		$imp_outside_address_name="";$imp_outside_address_st1="";$imp_outside_address_st2="";$imp_outside_address_vt="";
		$imp_outside_address_dist="";$imp_outside_address_pin="";$imp_outside_address_mob="";$imp_outside_address_email="";
	}
	if(!empty($results["waste_detail"])){
		$waste_detail=json_decode($results["waste_detail"]);
		$waste_detail_qty=$waste_detail->qty;$waste_detail_basel=$waste_detail->basel;$waste_detail_movement=$waste_detail->movement;$waste_detail_char=$waste_detail->char;$waste_detail_special=$waste_detail->special;				
	}else{
		$waste_detail_qty="";$waste_detail_basel="";$waste_detail_movement="";$waste_detail_char="";$waste_detail_special="";
	}
	if(!empty($results["importer"])){
		$importer=json_decode($results["importer"]);
		$importer_process_detail=$importer->process_detail;$importer_capacity=$importer->capacity;
	}else{
		$importer_process_detail="";$importer_capacity="";
	}					
	$import_reason= wordwrap($import_reason, 40, "<br/>", true);
	$importer_process_detail= wordwrap($importer_process_detail, 40, "<br/>", true);
	$details_of_import= wordwrap($details_of_import, 40, "<br/>", true);
}

$form_name=$formFunctions->get_formName($dept,$form);
//$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
    <div style="text-align:center">
        <h4>'.$form_name.'</h4>
    </div><br/>  

   <table class="table table-bordered table-responsive"> 
    <tr>
        <td valign="top" width="50%">1. Importer or Exporter (name and address) in India:</td>
        <td width="50%">
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td>Name </td>
        			<td>'.strtoupper($unit_name).'</td>
      		</tr>
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
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td >Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Phone Number</td>
        			<td>'.strtoupper($b_landline_std).'-'.strtoupper($b_landline_no).'</td>
      		</tr>
      		
      		<tr>
        			<td >Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
			<tr>
					<td valign="top">Facility location/address</td>
					<td>'.strtoupper($facility_loc).'</td>
			</tr>
			<tr>
					<td valign="top">Reason for import or export</td>
					<td>'.strtoupper($import_reason).'</td>
			</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td valign="top" style="width:50%">2. Importer or exporter (name and address)outside of India:</td>
        <td>
    		<table class="table table-bordered table-responsive"> 
      		<tr>
        			<td >Name </td>
        			<td>'.strtoupper($imp_outside_address_name).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 1</td>
        			<td>'.strtoupper($imp_outside_address_st1).'</td>
      		</tr>
      		<tr>
        			<td>Street Name 2</td>
        			<td>'.strtoupper($imp_outside_address_st2).'</td>
      		</tr>
      		<tr>
        			<td>Village/Town</td>
        			<td>'.strtoupper($imp_outside_address_vt).'</td>
      		</tr>
      		<tr>
        			<td>District</td>
        			<td>'.strtoupper($imp_outside_address_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($imp_outside_address_pin).'</td>
      		</tr>
      		<tr>
        			<td>Mobile</td>
        			<td>+91'.strtoupper($imp_outside_address_mob).'</td>
      		</tr>
    		</table>
    	</td>
	</tr>
	<tr>
        <td colspan="2">3. Details of waste to be imported or exported:</td>
	</tr>       
	<tr>
		<td valign="top">(a) Quantity </td>
		<td>'.strtoupper($waste_detail_qty).'</td>
	</tr>
	<tr>
		<td valign="top">(b) Basel No</td>
		<td>'.strtoupper($waste_detail_basel).'</td>
	</tr>
	<tr>
		<td valign="top">(c) Single/multiple movement</td>
		<td>'.strtoupper($waste_detail_movement).'</td>
	</tr>
	<tr>
		<td>(d) Chemical composition of waste , where applicable</td>
		<td>Document is attached</td>
	</tr>
	<tr>
		<td valign="top">(e) Physical characteristics</td>
		<td>'.strtoupper($waste_detail_char).'</td>
	</tr>
	<tr>
		<td valign="top">(f) Special handling requirements, if applicable</td>
		<td>'.strtoupper($waste_detail_special).'</td>
	</tr> 		
  	<tr>
   	<td >4. For Schedule III A hazardous waste whether Prior Informed Consent has been obtained:</td>
        <td>Document is attached</td>
  	</tr>
  	<tr>
    	<td colspan="2">5. For importer:</td>
	</tr>
	<tr>
    	<td valign="top">(a) Process details along with environmental safeguard measures	</td>
    	<td>'.strtoupper($importer_process_detail).'</td>
  	</tr>
    <tr>
        <td valign="top">(b) Capacity of recycling or co-processing or recovery or utilization</td>
    	<td>'.strtoupper($importer_capacity).'</td>
  	</tr>
    <tr>
    	<td valign="top"> 6. Details of import against the Ministry of Environment, Forest and Climate Change permission in the previous three years</td>
    	<td>'.strtoupper($details_of_import).'</td>
  	</tr>
    <tr>
    	<td valign="top">7. Port of entry</td>
    	<td>'.strtoupper($port_of_entry).'</td>
  	</tr> 
	';				
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 	    
	
	<tr>
		<td>Place: <b>'.strtoupper($dist).'</b><br/> Date : <b>'.strtoupper($results["sub_date"]).'</b></td>
		<td align="right">
			<b>'.strtoupper($key_person).'</b><br/>
			Signature of the Occupier or <br/>Operator of the disposal facility</td>
	</tr>        
</table>';
?>