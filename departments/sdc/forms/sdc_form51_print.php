<?php
$dept="sdc";
$form="51";
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
	
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];$drugs_name=$results["drugs_name"];$auth_person=$results["auth_person"];$prev_lic_no=$results["prev_lic_no"];
		if($results["prev_issue_date"]!="" || $results["prev_issue_date"]!='00-00-0000' || $results["prev_issue_date"]!='0000-00-00'){
			$prev_issue_date=date('d-m-Y',strtotime($results["prev_issue_date"]));
		}else{
			$prev_issue_date="";
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
	<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
	<br>
	<table class="table table-bordered table-responsive">	
		<tr>
			<td colspan="2">1.I/We &nbsp;'.strtoupper($auth_person).' &nbsp; of &nbsp;'.strtoupper($unit_name).'&nbsp;&nbsp;hereby apply for a licence to manufacture the drugs specified below for purposes examination, test or analysis at &nbsp;'.strtoupper($dist).' &nbsp;  and I undertake to comply with the conditions applicable to the licence.</td>
		</tr>
		<tr>
			<td>Name of drugs :</td>
			<td>'.strtoupper($drugs_name).'</td>
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
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Signature of the Applicant               
               </td>
        </tr>        						
	</table>';
?>

