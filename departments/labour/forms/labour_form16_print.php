<?php
$dept="labour";
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
    
		
if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$notification_no=$results['notification_no'];$notification_date=$results['notification_date'];
}

$form_name=$formFunctions->get_formName($dept,$form);
//$dept_name=$formFunctions->get_deptName($dept);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);

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
		table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}
	</style>
</head>
<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center"><br/><br/>
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div>
<table class="table table-bordered table-responsive">
	
	<tr>
		<td colspan="2"><b>Sub :&nbsp;&nbsp;</b>Application for Registration under Self-Certification -Cum- Consolidated Annual Return Scheme of Assam, 2016.</td>
	</tr>
	<tr>
		<td colspan="2">Sir,<br/><br/>In response to the Govt. Notification No. :&nbsp;&nbsp;'.strtoupper($notification_no).'&nbsp;,&nbsp; dated &nbsp;'.$notification_date.'&nbsp; regarding Self Certification and have understood the same. <br/>I/We wish to be covered under the same, as such I/We request you kindly to issue me/us necessary approval for the same. The necessary information and other supporting documents, as required under the scheme, are enclosed as per Check list provided under the scheme. I/We undertake to abide by all terms and conditions of the scheme. It is also certified that I/We are competent and duly authorized to make any statement or provide any information to central/state Government agency on behalf of this establishment/enterprise.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kindly issue the necessary Registration at the earliest.<br/><br/></td>
	</tr>
	';
	
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 

	<tr>
		<td><b>Date: '.strtoupper($results["sub_date"]).'</b></td>
		<td align="right"><b>Yours faithfully,<br/>'.strtoupper($key_person).'</b><br/>(Signature of the Applicant)</td>
	</tr>     		
</table>';
?>