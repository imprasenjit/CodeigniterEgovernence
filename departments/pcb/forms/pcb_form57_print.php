<?php
$dept="pcb";
$form="57";
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
	$is_unit_registered=$results["is_unit_registered"];
	$form_id=$results['form_id'];
	if(!empty($results["pre_reg"])){
		$pre_reg=json_decode($results["pre_reg"]);
		$pre_reg_no=$pre_reg->no;$pre_reg_dt=$pre_reg->dt;
	}else{
		$pre_reg_no="";$pre_reg_dt="";
	}
	if(!empty($results["project"])){
		$project=json_decode($results["project"]);
		$project_tot_cap=$project->tot_cap;$project_year=$project->year;
	}else{
		$project_tot_cap="";$project_year="";
	}
}	
if($is_unit_registered=="N"){
	$is_unit_registered="NO";
	$val1="None";
}else{
	$is_unit_registered="YES";
}
	
$form_name=$formFunctions->get_formName($dept,$form);
// $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
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
       <h4>'.$form_name.'<br/>[See rules 13(4)]<br/></h4>
    </div>
	<table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
				<tr>
					<td>From,<br/>'.strtoupper($key_person).'<br/>'.strtoupper($street_name1).', '.strtoupper($street_name2).'<br/>'.strtoupper($dist).'<br/>'.strtoupper($vill).'<br/>'.strtoupper($pincode).'</td>
				</tr>
				<tr>
					<td>To,<br/>The Member Secretary,<br/>'.strtoupper($dist).', Pollution Control Board or Pollution Control Committee<br/>'.strtoupper($pincode).'</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td width="50%">1.(a) Name and location of the unit</td>
			<td>Name : '.strtoupper($unit_name).'<br/>Location : '.strtoupper($b_dist).'</td>
		</tr>
		<tr>
			<td>(b) Address of the unit</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile no.</td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>(c) In case of renewal, previous registration number and date of registration</td>
			<td>Registration Number : '.strtoupper($pre_reg_no).'<br/>Date : '.strtoupper($pre_reg_dt).'</td>	
		</tr>
		<tr>
			<td>2. Is the unit registered with the DIC or DCSSI of the State Government or Union Territory? If yes, attach a copy.</td>
			<td>'.strtoupper($is_unit_registered).'</td>
		</tr>
		<tr>
			<td>3.(a) Total capital invested on the project</td>
			<td>'.strtoupper($project_tot_cap).'</td>
		</tr>
		<tr>
			<td>(b) Year of commencement of production</td>
			<td>'.strtoupper($project_year).'</td>
		</tr>
		<tr>
			<td>(c) List of producers and quantum of raw materials supplied to producers</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr align="center">
					<td align="center">Sl No</td>
				   <td align="center">Producers</td>
				   <td align="center">Quantum</td>			
				</tr>';
				
				$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["producers"]).'</td>
						<td>'.strtoupper($row_1["quantum"]).'</td>
					</tr>';
				}$printContents=$printContents.'
				</table>
			</td>
		</tr>';

		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'    
		
		<tr>
			<td>Date : &nbsp;<b>'.date('d-m-Y',strtotime($today)).'</b></td>										
			<td align="right">Signature :&nbsp;<b>'.strtoupper($key_person).'</b></td>
		</tr>
		<tr>
			<td>Place :&nbsp;<b> '.strtoupper($dist).'</b></td>
			<td align="right">Designation :&nbsp;<b>'.strtoupper($status_applicant).'</b></td>
		</tr>
	</table>
	';
?>