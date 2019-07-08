<?php 
$dept="cei";
$form="29";
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
		$year=$results['year'];$reg_no=$results['reg_no'];$class=$results['class'];$lic_valid_upto=$results['lic_valid_upto'];$from_date=$results['from_date'];$to_date=$results['to_date'];
		
    }
	$form_name=$formFunctions->get_formName($dept,$form);
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
			<td width="50%">1.For the year</td>
			<td>'.strtoupper($year).'</td>
	   </tr>
	   <tr>
			<td>2.Name of the Contractor(IN BLOCK CAPITAL LETTERS)</td>
			<td>'.strtoupper($key_person).'</td>
	   </tr>
		<tr>
				<td>3.Registration. No of License</td>
				<td>'.strtoupper($reg_no).'</td>
		</tr>
		<tr>
				<td>4.Class OF License</td>
				<td>'.strtoupper($class).'</td>
		</tr>
		<tr>
				<td>5.License valid up to</td>
				<td>'.strtoupper($lic_valid_upto).'</td>
		</tr>
		<tr>
				<td>6.Period Of Return</td>
				<td>From &nbsp;&nbsp;'.$from_date.'&nbsp;&nbsp;To&nbsp;&nbsp; '.$to_date.' </td>
		</tr>
		
	     <tr>
			<td colspan="2">7.Details of works and staff alloted therefore</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">			
				<thead>
				<tr>
					    <th>Sl. No</th>
						<th>Reference No. of Form-C </th>
						<th>Name & Description of the work with address </th>
						<th>Name of the supervisors entrusted with Regd. No. OF certificates of competency </th>
						<th>Name of the entrusted with REGD. NO. of the permits  </th>
						<th>Name of the APPRENTICES DEPLOYED </th>
						<th>Date of completion  </th>
						<th>Reference & Date of TEST REPORT  </th>
						<th>Report submitted to </th>
				</tr>
				</thead>';					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["sl_no"]).'</td>
							<td>'.strtoupper($row_1["ref_no"]).'</td>
							<td>'.strtoupper($row_1["name_address"]).'</td>
							<td>'.strtoupper($row_1["name_supervisor"]).'</td>
							<td>'.strtoupper($row_1["nm_entrusted"]).'</td>
							<td>'.strtoupper($row_1["nm_apprecentice"]).'</td>
							<td>'.strtoupper($row_1["date_completion"]).'</td>
							<td>'.strtoupper($row_1["reference_test_report"]).'</td>
							<td>'.strtoupper($row_1["report_sub"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
	';
	
    $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.' 	
        <tr>
			<td> Date :<b> '.date('d-m-Y',strtotime($results["sub_date"])).'</b><br/></td>
			<td align="right">	Signature : &nbsp; &nbsp;<b> '.strtoupper($key_person).'</b>
			</td>
        </tr>
</table>';

?>