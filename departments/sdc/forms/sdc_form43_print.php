<?php
$dept="sdc";
$form="43";
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
		$form_id=$results["form_id"];$auth_person=$results["auth_person"];$license_no=$results["license_no"];$license_date=$results["license_date"];$staff_manuf=$results["staff_manuf"];
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
			<td colspan="2">1.I/We  &nbsp;'.strtoupper($auth_person).'&nbsp; of M/s&nbsp;'.strtoupper($unit_name).'&nbsp; hereby apply for the grant of licence number&nbsp;&nbsp;'.strtoupper($license_no).'&nbsp;&nbsp; dated :&nbsp;&nbsp;'.strtoupper($license_date).'&nbsp;&nbsp;to operate a Blood Bank, for processing of whole blood and/or* for preparation of its components on the premises situated at&nbsp;&nbsp;'.strtoupper($b_dist).'</td>
		</tr>
		<tr>			
			<td colspan="2">2. Name(s) of the item(s) :</td>
		</tr>
		<tr>
			<td colspan="2"><table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center" width="5%">Sl No </td>
				<td align="center" width="95%"> Name </td>		
			</tr>';
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table>   	</td>
		</tr>
		<tr>			
			<td colspan="2">3. The name(s), qualification and experience of competent technical staff are as under :</td>
		</tr>
		<tr>
			<td colspan="2"><table class="table table-bordered table-responsive">
			<tr align="center">
				<td align="center" width="5%">Sl No </td>
				<td align="center" width="40%"> Name </td>
				<td align="center" width="15%">Experience</td>
				<td align="center" width="20%">Qualification</td>
				<td align="center" width="20%">Responsible</td>			
			</tr>';
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
					if($row_2["responsible"]=="MO"){
						$responsible="Medical Officer";
					}else if($row_2["responsible"]=="TS"){
						$responsible="Technical Supervisor";
					}else if($row_2["responsible"]=="RN"){
						$responsible="Registered Nurse";
					}else{
						$responsible="Blood Bank Technician";
					} 
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["qualification"]).'</td>
						<td>'.strtoupper($row_2["experience"]).'</td>
						<td>'.strtoupper($responsible).'</td>
				</tr>';
				}$printContents=$printContents.'
   		</table>   	</td>
		</tr>
		<tr>
			<td colspan="2">4. The premises and plant are ready for inspection/will be ready for inspection on '.strtoupper($staff_manuf).' </td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'	
				
		<tr>
			<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
			<td align="center"> Signature :<strong>'.strtoupper($key_person).'</strong><br/> </td>				
		</tr>						
	</table>';
?>
