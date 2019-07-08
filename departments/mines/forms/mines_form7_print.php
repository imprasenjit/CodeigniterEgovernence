<?php
$dept="mines";
$form="7";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name."  where user_id='$swr_id' and active='1' and form_id=form_id");
}
	
	
	
	if($q->num_rows > 0){
		$results=$q->fetch_array();
        $form_id=$results["form_id"];$grant_excavation=$results["grant_excavation"];$tonnes_cubic=$results["tonnes_cubic"];$minor_mineral=$results["minor_mineral"];
		$disposal_mineral=$results["disposal_mineral"];$periodfrm_dt=$results["periodfrm_dt"];$periodto_dt=$results["periodto_dt"];	
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
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}
		</style>
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
		<table class="table table-bordered table-responsive">
		<tbody>	
		<tr>  				
			<td colspan="2">&nbsp;&nbsp;Whereas Sh. / Messe&nbsp;&nbsp;'.strtoupper($key_person).'&nbsp;&nbsp;has applied for the grant of a permit under Rule 27 of the Assam Minor Mineral Concessision Rules ,2012,for excavation of&nbsp;&nbsp;'.strtoupper($grant_excavation).'&nbsp;&nbsp;tonnes/ cubic meter / quintals of &nbsp;&nbsp; '.strtoupper($tonnes_cubic).'&nbsp;&nbsp;Ordinary Clay/earth, a minor minerals for excavation/removal from.&nbsp;&nbsp; '.strtoupper($minor_mineral).'&nbsp;&nbsp;(details of area).</td>
		</tr>		
		<tr>  				
			<td colspan="2">&nbsp;&nbsp;The permission is hereby granted for disposal of the mineral&nbsp;&nbsp;'.strtoupper($disposal_mineral).'&nbsp;&nbsp;(name of minor minerals) tones/ cubic meter /quintals excavated / removed from the aforesaid area for the period from&nbsp;&nbsp; '.strtoupper($periodfrm_dt).'&nbsp;&nbsp;To&nbsp;&nbsp;'.strtoupper($periodto_dt).'&nbsp;&nbsp;subject to following conditions :-</td>
		</tr>
		<tr>
			<td colspan="2">1. The holder of the permits shall keep the Government indemnified from third party claim relating to the extraction of ordinary clay/earth from the Land for which quarrying permit is Given. </td>	
			
		</tr>    							
		<tr>
			<td colspan="2">2. The holder of the permit shall excavate the ordinary clay/earth in such a manner that same shall not disturb or damage any Road, Public Ways , buildings, premises of public grounds.</td>
					
		</tr>  	
		<tr>
		   <td colspan="2">3. That the holder of the permit shall not fell any tree standing on the land without obtaining prior permission in writing from the competent authority in the Forest Department. In case such permission has been granted, he shall abide by the terms and conditions stipulated in suchpermission.</td>
		</tr>
		<tr>
		   <td colspan="2">4. The permit holder shall not carry on surface operations in any area prohibited by any authority,without obtaining prior permission in writing from the concerned authority.</td>
		</tr>
		<tr>
			<td colspan="2">5. The permit holder shall not enter and work in any forest land without obtaining prior written permission of the Forest Department.</td>
			
		</tr>   							
		<tr>
			<td colspan="2">6. The permit holder shall report immediately all accidents to the Deputy Commissioner and the competent authority concerned. </td>	
		</tr>		
		<tr>
			<td colspan="2">7. The depth of the pith below surface shall not exceed nine feet and in case where sand deposits are found, the depth of the pit below surface shall not exceed three feet.</td>	
		</tr>  			   		
		';						
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
			
			<tr>
				<td colspan="2"><br/>&nbsp;&nbsp;I/We do hereby declare that the particulars furnished above are correct and am/are ready to furnish any other details, including accurate plans as may be required by you.</td>				
			</tr>	
			<tr>
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="right"> Yours faithfully,<br/>Signature of Applicant :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>	
			<tr>
				<td>Place : <strong>'.strtoupper($dist).'</strong></td>						
				<td align="right"> Designation :<strong>'.strtoupper($key_person).'</strong></td>				
			</tr>						
		</table>
		';
?>

