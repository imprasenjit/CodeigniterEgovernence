<?php
 $dept="doa";
 $form="20";
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

	
	if($q->num_rows>0)
	{
        $results=$q->fetch_assoc();		
		$form_id=$results["form_id"];$state=$results["state"];$licence_no=$results["licence_no"];$day=$results["day"];$year=$results["year"];$premises=$results["premises"];$premises1=$results["premises1"];$pesticides=$results["pesticides"];$principals=$results["principals"];
	}
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'
  			<h4>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	   <tr>
            <td colspan="2">&nbsp;&nbsp;1.&nbsp;&nbsp; The license desired to be renewal was granted by the Licensing Authority for State of '.strtoupper($state).'&nbsp;&nbsp;license No. '.strtoupper($licence_no).'&nbsp;on the day of &nbsp;'.strtoupper($day).'&nbsp; 20'.strtoupper($year).'.</td>
		</tr>
		<tr>
            <td colspan="2">&nbsp;&nbsp;2.&nbsp; The situation of applicants premises where the insecticides are will be</td>
		</tr>
		<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Premises where insecticides are stored :</td>
			<td>'.strtoupper($premises).'</td>
		</tr>
		<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;b. Premises where insecticides are sold :</td>
			<td>'.strtoupper($premises1).'</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;&nbsp;3.&nbsp;The insecticides in which I/am/we/are carrying on business and the name of the principals whom I/we represent are stated below:-  </td>
		</tr>
		<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a. Name of Pesticides :</td>
			<td>'.strtoupper($pesticides).'</td>
		</tr>
		<tr>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; b. Name of Principals:</td>
			<td>'.strtoupper($principals).'</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td>Full Name:<strong> :</strong> '.strtoupper($key_person).' </td>
			<td align="right">Address of the Applicant <strong> :</strong>&nbsp;'.strtoupper($street_name1).'</td>
		</tr>	
	</table>
	';
?>  