<?php 
$dept="ayush";
$form="4";
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
	$row1=$row1=$formFunctions->fetch_swr($swr_id);	
    $Name_of_owner=$row1['Name_of_owner'];
    $owners=Array();
    $owners=explode(",",$Name_of_owner);
	if($q->num_rows>0){
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
    }

$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
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
		$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
	<div style="text-align:center">
		'.$assamSarkarLogo.'<h4> '.$form_name.'</h4>
	</div><br/>
		
  <table class="table table-bordered table-responsive">
  		<tr>  				
			<td colspan="2">
			1. I/We <b>'.strtoupper($Name_of_owner).' </b>
			of <b>'.strtoupper($unit_name).'</b>&nbsp;,Hereby apply for the grant/renewal of a license to manufacture Ayurvedic (including Siddha) or Unani drugs on the premises situated at <b>'.strtoupper($vill).'</b>.
			</td>
		</tr>
		<tr>
			<td colspan="2">2. Name of Drugs to be manufactured.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">	
					<thead>
					<tr>												
						<td width="20%">Sl No.</td>
						<td width="40%">Name</td>
						<td width="40%">Details</td>
						
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["drugs_name"]).'</td>
							<td>'.strtoupper($row_1["drugs_det"]).'</td>
						</tr>';
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
		<tr>
			<td colspan="2">3. Names, Qualification and Experience of technical staff employed for manufacture and testing of Ayurvedic (including Siddha) or Unani Drugs. </td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">	
						<thead>
						<tr>												
								<th width="10%">Sl. No.</th>
								<th width="30%">Name</th>
								<th width="30">Qualification</th>
								<th width="30%">Experience</th>
								
							
						</tr>
						</thead>';					
						$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
						while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name"]).'</td>
							<td>'.strtoupper($row_2["qualification"]).'</td>
							<td>'.strtoupper($row_2["experience"]).'</td>
							
						</tr>';
						}
						$printContents=$printContents.'
				</table>
			</td>
		</tr>		
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
			
		<tr>
			<td width="50%"> Date : <b>'.date('d-m-Y',strtotime($results["sub_date"])).'</b></td>
			<td align="right"><b>'.strtoupper($key_person).'</b><br/>Signature of the Applicant</td>
        </tr>
    </tbody>
</table>
';
?>

