<?php 
$dept="cei";
$form="11";
$table_name=getTableName($dept,$form);
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id' ORDER BY form_id DESC LIMIT 1") ;
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ORDER BY form_id DESC LIMIT 1") ;
	}
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		$letter_no=$results['letter_no'];$letter_dt=$results['letter_dt'];$completed_on=$results['completed_on'];$rated_speed=$results['rated_speed'];
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
			<td colspan="2">To,<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Inspector of Lift and Escalators,<br/><br/>
			Sub : Installation of Lift at '.strtoupper($unit_name).'<br/><br/>	
			Dear Sir,<br/><br/>								
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;With reference to letter No.- <b>'.strtoupper($letter_no).'</b>&nbsp; dated - <b>'.date('d-m-Y',strtotime($letter_dt)).'</b> &nbsp;of your office granting permission to install a Lift at the above mentioned premises, I/We have to state that the work of installation of the Lift has been completed on <b>'.date('d-m-Y',strtotime($completed_on)).'</b>.<br/> 
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We therefore request that a license for operating the Lift may be granted. <br/>
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The work of erection of the Lift has been carried out in accordance with the provisions of the Assam Lifts and Escalators Rules, 2010. <br/>
			</td>  
		</tr>
		<tr>
				<td>Rated speed (meter per second) </td>
				<td>'.strtoupper($rated_speed).'</td>
		</tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 
	<tr>
		<td> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
		<td align="right">	<b>'.strtoupper($key_person).'</b><br/>
			Signature of the applicant
		</td>
	</tr>
	</tbody>
</table>';

?>
