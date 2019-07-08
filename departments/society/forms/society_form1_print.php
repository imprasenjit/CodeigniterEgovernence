<?php
$dept="society";
$form="1";
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
	$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$proposed_area=$results['proposed_area'];$s_obj=$results['s_obj'];	
}
	
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
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
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center">
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/> 
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%">1. Name of the proposed society:</td>
		<td width="50%">'.strtoupper($unit_name).'</td>
	</tr>
	<tr>
		<td colspan="2">2. The address of the proposed society: </td>
	</tr>
	<tr>
		<td>a) House No./ Bye lane:</td>
		<td>'.strtoupper($b_street_name1).'</td>
	</tr>
	<tr>
		<td>b) Locality:</td>
		<td>'.strtoupper($b_street_name2).'</td>
	</tr>
	<tr>
		<td>c) Post office:</td>
		<td>'.strtoupper($s_po).'</td>
	</tr>
	<tr>
		<td>d)P.S:</td>
		<td>'.strtoupper($s_ps).'</td>
	</tr>
	<tr>
		<td>e)Vill/ Town:</td>
		<td>'.strtoupper($b_vill).'</td>
	</tr>
	<tr>
		<td>f) Mouza:</td>
		<td>'.strtoupper($mouza).'</td>
	</tr>
	<tr>
		<td>g)Circle:</td>
		<td>'.strtoupper($circle).'</td>
	</tr>
	<tr>
		<td>h) Contituency:</td>
		<td>'.strtoupper($s_con).'</td>
	</tr>
	<tr>
		<td>i)Sub-division:</td>
		<td>'.strtoupper($b_block).'</td>
	</tr>
	<tr>
		<td>j)District:</td>
		<td>'.strtoupper($b_dist).'</td>
	</tr>
	<tr>
		<td>3. Proposed area of operation of the society:</td>
		<td>'.strtoupper($proposed_area).'</td>
	</tr>
	<tr>
		<td>4.Objective of the society:</td>
		<td>'.strtoupper($s_obj).'</td>
		
	</tr>
	<tr>
		<td colspan="2">Yours faithfully</td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">			
			<thead>
				<tr>
					<th>Sl No.</th>
					<th>Name of Member</th>
					<th>Address</th>
					<th>Age</th>
					<th>Phone No.</th>
					<th>Signature</th>
				</tr>
			</thead>
			<tbody>';
				$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
				$sl=1;
				while($rows=$results1->fetch_object()){						
					if($rows->upload_signature !="") $upload_signature='<img style="padding:5px" width="200" height="60" src="'.$server_url.'departments/society/forms/upload/'.$rows->upload_signature .'"/>';
					else $upload_signature="";
					
					$printContents=$printContents.'
					<tr>
						<td>'.$sl.'</td>
						<td>'.strtoupper($rows->member_name).'</td>
						<td>'.strtoupper($rows->member_address).'</td>
						<td>'.strtoupper($rows->member_age).'</td>
						<td>'.strtoupper($rows->member_phone).'</td>
						<td>'.$upload_signature .'</td>
					</tr>';
					$sl++;
				}				
				$printContents=$printContents.'
			</tbody>
		</table>
		</td>
	</tr>';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'
	<tr>
		<td ></td>
		<td align="right">
			 <b>'.strtoupper($key_person).'</b><br/>
			 Signature of the Applicant</td>				
	</tr>   
</table>';
?>
