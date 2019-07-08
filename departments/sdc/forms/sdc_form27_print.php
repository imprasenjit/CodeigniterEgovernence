<?php
$dept="sdc";
$form="27";
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
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and uain='$uain'");	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
}else{
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' and form_id=form_id");
}	
	
	if($q->num_rows > 0){
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$location=$results["location"];$category=$results["category"];$particulars=$results["particulars"];$prev_lic_no=$results["prev_lic_no"];
			if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
				$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
			}else{
				$prev_issue_date="";
			}
		if(!empty($results["supervision"])){
			$supervision=json_decode($results["supervision"]);
			$supervision_n1=$supervision->n1;$supervision_n2=$supervision->n2;
			$supervision_q1=$supervision->q1;$supervision_q2=$supervision->q2;
			if(isset($supervision->reg)) $supervision_reg=$supervision->reg; else $supervision_reg="";
		}else{				
			$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";$supervision_reg="";
		}
	}
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);
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
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.' <br/></h4>
	<br>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">1.I/We &nbsp;'.strtoupper($auth_person).'&nbsp; hereby apply for licence to sell by wholesale/retail drugs specified in Schedules C and C(1) excluding those specified in Schedule X and/or drugs other than those specified in Schedules C. C(1) and X to the Drugs and Cosmetics Rules, 1945* and also to operate a pharmacy on the premises situated at&nbsp;'.strtoupper($location).'.</td>
		</tr>
		<tr>
			<td width="50%">2. The sale and  dispensing of drugs will be made under the personal supervision of the qualified persons namely :-</td>
			<td width="50%"><table class="table table-bordered table-responsive">
			<tr>
				<td>Name of the Applicant/Proprietor : '.strtoupper($supervision_n1).'</td>
				<td>Qualification : '.strtoupper($supervision_q1).'</td>
			</tr>
			<tr>
				<td >Name of the Qualified/Competent person : '.strtoupper($supervision_n2).'</td>
				<td>Qualification : '.strtoupper($supervision_q2).'</td>
			</tr>
			<tr>
				<td>Registration Number :</td>
				<td>'.strtoupper($supervision_reg).'</td>
			</tr>
			</table></td>
		</tr>			
		<tr>
			<td >3. Categories of drugs to be sold. :</td>
			<td >'.strtoupper($category).'</td>
		</tr>			
		<tr>
			<td >4. Particulars for special storage accomodation.:</td>
			<td >'.strtoupper($particulars).'</td>
		</tr>		
		<tr>
			<td>Licence No.</td>
			<td>'.strtoupper($prev_lic_no).'</td>
		</tr>
		<tr>
			<td>Issue date</td>
			<td>'.strtoupper($prev_issue_date).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
			
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :&nbsp;<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>

