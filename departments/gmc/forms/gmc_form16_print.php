<?php
$dept="gmc";
$form="16";
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
	



if($q->num_rows > 0){
	$results=$q->fetch_array();	
	$form_id=$results["form_id"];
	$father_name=$results["father_name"];$ward_no=$results["ward_no"];$house_no=$results["house_no"];$road_name=$results["road_name"];$const_year=$results["const_year"];$is_pipe=$results["is_pipe"];$is_use=$results["is_use"];	
		
	if(!empty($results["plinth"])){
		$plinth=json_decode($results["plinth"]);
        if(isset($plinth->base)) $plinth_base=$plinth->base; else $plinth_base="";
        if(isset($plinth->muzz)) $plinth_muzz=$plinth->muzz; else $plinth_muzz="";
        if(isset($plinth->ground)) $plinth_ground=$plinth->ground; else $plinth_ground="";
        if(isset($plinth->first)) $plinth_first=$plinth->first; else $plinth_first="";
        if(isset($plinth->second)) $plinth_second=$plinth->second; else $plinth_second="";
        if(isset($plinth->third)) $plinth_third=$plinth->third; else $plinth_third="";
        if(isset($plinth->fourth)) $plinth_fourth=$plinth->fourth; else $plinth_fourth="";
        if(isset($plinth->fifth)) $plinth_fifth=$plinth->fifth; else $plinth_fifth="";
		
	}else{				
		$plinth_base="";$plinth_muzz="";$plinth_ground="";$plinth_first="";$plinth_second="";$plinth_third="";$plinth_fourth="";$plinth_fifth="";
	}
	if(!empty($results["area"])){
		$area=json_decode($results["area"]);
		$area_land=$area->land;$area_dag=$area->dag;$area_patta=$area->patta;$area_vill=$area->vill;$area_mouza=$area->mouza;
	}else{				
		$area_land="";$area_dag="";$area_patta="";$area_vill="";$area_mouza="";
	}
	if(!empty($results["holdings"])){
		$holdings=json_decode($results["holdings"]);
		$holdings_no=$holdings->no;$holdings_arv=$holdings->arv;$holdings_owner=$holdings->owner;
	}else{				
		$holdings_no="";$holdings_arv="";$holdings_owner="";
	}
	if(!empty($results["owner"])){
		$owner=json_decode($results["owner"]);
		$owner_certify=$owner->certify;$owner_sign=$owner->sign;$owner_contact=$owner->contact;
	}else{				
		$owner_certify="";$owner_sign="";$owner_contact="";
	}
	
	if($is_pipe=="Y") $is_pipe="Yes";
	else $is_pipe="No";
	
	if($is_use=="S") $is_use="Self used Residence";
	else if($is_use=="R") $is_use="Rented for residence";
	else if($is_use=="C") $is_use="Commercial use";
}

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	
if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>Form '.$form.'</title>
	<style type="test/css">
	table, thead, td {
		border: 1px solid #000;
		border-collapse: collapse;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';		
}else{
	$printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. Name of the Owners </td>
		<td>'.strtoupper($owner_names).'</td>
	</tr>
	<tr>
		<td>2. Father/Husband`s Name </td>
		<td>'.strtoupper($father_name).'</td>
	</tr>
	<tr>
		<td>3.(a) Ward No </td>
		<td>'.strtoupper($ward_no).'</td>
	</tr>
	<tr>
		<td>(b) House No. (If any) </td>
		<td>'.strtoupper($house_no).'</td>
	</tr>
	<tr>
		<td>4. Name of the Road </td>
		<td>'.strtoupper($road_name).'</td>
	</tr>
	<tr>
		<td colspan="2">5. Plinth area of the building, (Floor wise area in case of multi storied buildings) : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(i) Basement Floor </td>
				<td>'.strtoupper($plinth_base).'</td>
			</tr>
			<tr>
				<td>(ii) Muzzling Floor </td>
				<td>'.strtoupper($plinth_muzz).'</td>
			</tr>
			<tr>
				<td>(iii) Ground Floor </td>
				<td>'.strtoupper($plinth_ground).'</td>
			</tr>
			<tr>
				<td>(iv) First Floor </td>
				<td>'.strtoupper($plinth_first).'</td>
			</tr>
			<tr>
				<td>(v) 2nd Floor </td>
				<td>'.strtoupper($plinth_second).'</td>
			</tr>
			<tr>
				<td>(vi) 3rd Floor </td>
				<td>'.strtoupper($plinth_third).'</td>
			</tr>
			<tr>
				<td>(vii) 4th Floor </td>
				<td>'.strtoupper($plinth_fourth).'</td>
			</tr>
			<tr>
				<td>(viii) 5th Floor </td>
				<td>'.strtoupper($plinth_fifth).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>6. Year of Construction </td>
		<td>'.strtoupper($const_year).'</td>
	</tr>
	<tr>
		<td>7. Water Pipe Connection </td>
		<td>'.strtoupper($is_pipe).'</td>
	</tr>
	<tr>
		<td>8. Use of the building </td>
		<td>'.strtoupper($is_use).'</td>
	</tr>	
	<tr>
		<td>9. (a) Area of Land </td>
		<td>'.strtoupper($area_land).'</td>
	</tr>
	<tr>
		<td>(b) Dag No. </td>
		<td>'.strtoupper($area_dag).'</td>
	</tr>
	<tr>
		<td>(c) Patta No </td>
		<td>'.strtoupper($area_patta).'</td>
	</tr>
	<tr>
		<td>(d) Village </td>
		<td>'.strtoupper($area_vill).'</td>
	</tr>
	<tr>
		<td>(e) Mouza </td>
		<td>'.strtoupper($area_mouza).'</td>
	</tr>
	<tr>
		<td colspan="2">10. No. of Holdings if any : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<tr>
				<td width="50%">(i) Holding No </td>
				<td>'.strtoupper($holdings_no).'</td>
			</tr>
			<tr>
				<td>(ii) Old A.R.V. </td>
				<td>'.strtoupper($holdings_arv).'</td>
			</tr>
			<tr>
				<td>(iii) Name of the Owner of the Holding </td>
				<td>'.strtoupper($holdings_owner).'</td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>11. Copy of the Building Permission (If any) </td>
		<td>Upload later in upload section </td>
	</tr>
	<tr>
		<td colspan="2">I, '.strtoupper($owner_certify).' submitting the above information to the Corporation, as required under section 163 of the Guwahati Municipal Corporation Act, 1969 and I certify that above particulars furnished by me is true to the best of my knowledge and belief. </td>
	</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>								
		<td align="left">Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of the Owner of the Holdings : <strong>'.strtoupper($owner_sign).'</strong><br/>Contact No. : <strong>'.strtoupper($owner_contact).'</strong></td>							
	</tr>
</table>';
?>