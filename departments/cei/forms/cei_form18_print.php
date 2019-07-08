<?php 
$dept="cei";
$form="18";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'") ;
	}
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$lift=$results['lift'];$owned=$results['owned'];$auth_person=$results['auth_person'];$auth_no=$results['auth_no'];
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
  			'.$assamSarkarLogo.'
			<h4> '.$form_name.'</h4>
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>  				
				<td colspan="2">
				To,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As  required  by  rule  9  of  the  Assam  Lifts  and  Escalators  Rules,  2010  I/We hereby    certify    that    the    escalator(s)    installed    at&nbsp; <b>'.strtoupper($lift).'</b>&nbsp;And    owned by&nbsp;<b>'.strtoupper($owned).'</b>&nbsp;is under my/our maintenance. <br/><br/>
								
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The installation of the aforesaid escalator satisfies the entire requirement as laid  down  under  the  Assam  Lifts  and  Escalators  Act,  2006  and  the  rules  thereunder.  I/We maintain logbook as required under Rule 9(j) of the Assam Lifts and Escalators Rules, 2010.<br/><br/><br/><br/> </td>
			</tr>
			';
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'  
			<tr>
				<td valign="top"> Date : &nbsp;<b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
				<td valign="top" align="right">Name of the authorized person:&nbsp;<b>'.strtoupper($auth_person).'</b><br/>
				Authorization number:&nbsp;<b>'.strtoupper($auth_no).'</b></td>
			</tr>
		</table>';

?>

