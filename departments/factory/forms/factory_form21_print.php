<?php
$dept="factory";
$form="21";
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
	$form_id=$results["form_id"];
	$serial_no=$results['serial_no'];$works_no=$results['works_no'];$worker_name=$results['worker_name'];$sex=$results['sex'];$age=$results['age'];$employ_date=$results['employ_date'];$leave_date=$results['leave_date'];$reason=$results['reason'];$nature=$results['nature'];$raw_material=$results['raw_material'];$sus_period=$results['sus_period'];$sus_reason=$results['sus_reason'];$resume_dt=$results['resume_dt'];$is_issued=$results['is_issued'];$surgeon_sign=$results['surgeon_sign'];
	
	if($sex=="M") $sex="Male";
	else $sex="Female";
	if($is_issued=="Y") $is_issued="Yes";
	else $is_issued="No";
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
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<h4 align="center">'.$assamSarkarLogo.'<br/>'.$form_name.'</h4>
<br>
<table class="table table-bordered table-responsive">
	<tr>
		<td colspan="2">1. Name of Certifying Surgeon : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl. No.</th>
					<th>Name </th>
					<th>From </th>
					<th>To </th>
				</tr>
			</thead>';
			$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
			$num = $part1->num_rows;
			if($num>0){
				$sl=1;
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["from_dt"]).'</td>
						<td>'.strtoupper($row_1["to_dt"]).'</td>
					</tr>';
					$sl++;
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		</td>
	</tr>
	<tr>  				
		<td width="50%">2. Serial No. </td>
		<td>'.strtoupper($serial_no).'</td>
	</tr>
	<tr>  				
		<td>3. Works No. </td>
		<td>'.strtoupper($works_no).'</td>
	</tr>
	<tr>  				
		<td>4. Name of worker </td>
		<td>'.strtoupper($worker_name).'</td>
	</tr>
	<tr>  				
		<td>5. Sex </td>
		<td>'.strtoupper($sex).'</td>
	</tr>
	<tr>  				
		<td>6. Age </td>
		<td>'.strtoupper($age).'</td>
	</tr>
	<tr>  				
		<td>7. Date of employment on present work </td>
		<td>'.strtoupper($employ_date).'</td>
	</tr>
	<tr>  				
		<td>8. Date of leaving or transfer to other works </td>
		<td>'.strtoupper($leave_date).'</td>
	</tr>
	<tr>  				
		<td>9. Reason for leaving, transfer or discharge </td>
		<td>'.strtoupper($reason).'</td>
	</tr>
	<tr>  				
		<td>10. Nature of job or occupation </td>
		<td>'.strtoupper($nature).'</td>
	</tr>
	<tr>  				
		<td>11. Raw material or by-product handled </td>
		<td>'.strtoupper($raw_material).'</td>
	</tr>
	<tr>
		<td colspan="2">12. Details of Medical Examination : </td>
	</tr>
	<tr>
		<td colspan="2">
		<table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>Sl No. </th>
					<th>Dates of Medical Examination by Certifying Surgeon </th>
					<th>Result of Medical Examination </th>
				</tr>
			</thead>';
			$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
			$num2 = $part2->num_rows;
			if($num2>0){
				$sl=1;
				while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($sl).'</td>
						<td>'.strtoupper($row_2["exam_dt"]).'</td>
						<td>'.strtoupper($row_2["result"]).'</td>
					</tr>';
					$sl++;
				}
			}else{
				$printContents=$printContents.'
				<tr>
					<td colspan="4">No records entered.</td>
				</tr>';
			}
			$printContents=$printContents.'
		</table>
		</td>
	</tr>
	<tr>  				
		<td>13. If suspended from work, state period of suspension with detailed reason </td>
		<td>Period : '.strtoupper($sus_period).'<br/>Reason : '.strtoupper($sus_reason).'</td>
	</tr>
	<tr>  				
		<td>14. Recertified fit to resume duty on </td>
		<td>'.strtoupper($resume_dt).'</td>
	</tr>
	<tr>  				
		<td>15. If certificate of unfitness or suspension issued to worker </td>
		<td>'.strtoupper($is_issued).'</td>
	</tr>
	';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
	<tr>
		<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td align="right">Signature of Certifying Surgeon : <strong>'.strtoupper($surgeon_sign).'</strong></td>		
	</tr>
</table>';
?>