<?php
$dept="clm";
$form="9";
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
		$meeting_date=$results['meeting_date'];$meeting_place=$results['meeting_place'];
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
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
     <table class="table table-bordered table-responsive">
		<tr >
			<td colspan="2" >
				&nbsp;&nbsp;Notice is hereby given that '.strtoupper($key_person).' Director of the '.strtoupper($unit_name).' '.strtoupper($b_dist).' (name and address of the company) has been nominated by the company by a Resolution passed at their meeting held on '.strtoupper($meeting_date).' at '.strtoupper($meeting_place).' to be charge of, and be responsible for the conduct of business of the company or any establishment/ branch/unit thereof and authorized to exercise all such powers and take all such steps as may be necessary or expedient to prevent the commission any offence by the said company under the Legal Metrology Act, 2009.</td>
		</tr>
		<tr>
			<td colspan="2" class="form-inline">
				&nbsp;&nbsp;&nbsp;&nbsp;'.strtoupper($key_person).'&nbsp;&nbsp;Designation  '.strtoupper($status_applicant).' has accepted the said nomination and copy of said acceptance is enclosed herewith.
			</td>
		</tr>
		<tr>
			<td colspan="2">
				&nbsp;&nbsp;&nbsp;&nbsp;A certified copy of the said Resolution is also enclosed.</td>
		</tr>
		';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'   
		
		<tr>
			<td>Date : <label>'.date('d-m-Y',strtotime($results["sub_date"])).'</label><br/>
				Place:<label>'.strtoupper($dist).'</label></td>
			<td align="right"> <label>'.strtoupper($key_person).'</label><br/>
				Managing Director/Secretary<br/>(name of the company)</td>
		</tr>
		<tr>
			<td colspan="2">Note: Score out the portion which is not applicable.</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;I accept the above nomination in pursuance of sub &#45; section (2) of Section 49 of the Legal Metrology Act, 2009 and Rule 29 of the Legal Metrology (General) Rules, 2011 made there under.</td>
		</tr>
	    
        <tr>
			<td>Date : <label>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</label><br/>
			Place:<label> '.strtoupper($dist).'</label></td>
			<td align="right"> <label>'.strtoupper($key_person).'</label><br/>
			Director of &nbsp;'.strtoupper($unit_name).'</td>
		</tr>
</table>';

?>