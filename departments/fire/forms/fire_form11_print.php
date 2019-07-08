<?php
$dept="fire";
$form="11";
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
		$rowkk=$q->fetch_array();
		$form_id=$rowkk["form_id"]; $owner_name=$rowkk['owner_name'];
		$holding_no=$rowkk['holding_no'];$letter_no=$rowkk['letter_no'];$renewal_year1=$rowkk['renewal_year1'];$renewal_year2=$rowkk['renewal_year2'];$letter_valid_date=$rowkk['letter_valid_date'];$letter_date=$rowkk['letter_date'];$nearest_station=$rowkk['nearest_station']; 
		
	}
	$nearest_station=$formFunctions->get_nearest_fire_station_name($nearest_station);
		
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$form_name=$formFunctions->get_formName($dept,$form);
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
if(!empty($rowkk["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($rowkk["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'<h4>'.$form_name.'</u> </h4>
        </div><br/>
  <table width="99%" align="center" border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse"  >  
    <tr><td width="100%">
        <table class="table table-bordered table-responsive">
			<tr>
				<td valign="top">To,<br/>
					 <br/> The Director,<br>Fire & Emergency Services, Assam.<br>Panbazar, Guwahati-1.<br/>
				</td>
			</tr>
			<tr>
					<td valign="top">Sir,<br/>
						<br/>	I/We, &nbsp;'.strtoupper($owner_name).'&nbsp; on behalf of &nbsp;'.strtoupper($unit_name).'&nbsp;located at '.strtoupper($from).' &nbsp; holding No.&nbsp; 
						'.strtoupper($rowkk['holding_no']).'&nbsp; District '.strtoupper($b_dist).' ,&nbsp; State &nbsp;Assam do hereby inform you that No Objection Certificate (N.O.C.) issued vide your Letter No./ UAIN '.strtoupper($rowkk['letter_no']).'&nbsp;Dated &nbsp;'.strtoupper($rowkk['letter_date']).'&nbsp; valid up to &nbsp; '.strtoupper($rowkk['letter_valid_date']).'&nbsp;<strong>(Copy of N.O.C. is enclosed)</strong> and is due for renewal for a period of another 1(One) Year with effect from 1<sup>st</sup> of April '.strtoupper($rowkk['renewal_year1']).'&nbsp; to 31<sup>st</sup> of March '.strtoupper($rowkk['renewal_year2']).'.
					</td>
			</tr>
		</table>
		<table class="table table-bordered table-responsive">
			<tr>
				<td> Name of the nearest Fire Station</td>
				<td> '.strtoupper($nearest_station).'</td>
			</tr>
		</table>
		<table class="table table-bordered table-responsive">
			<tr>
				<td>In this connection it is submitted that -</td>
			</tr>
			<tr>
				<td>i. There is no change in trade for which license has been issued.</td>
			</tr>
			<tr>
				<td>ii. There is no any structural change of the Building either horizontally or vertically affecting means of escapes/ Exits.</td>
			</tr>
			<tr>
				<td>iii. There is no any change in existing Fire Fighting arrangement.</td>
			</tr>
			<tr>
				<td>iv. Fire prevention & Fire Safety Measures/ Arrangements have been tested and are in Good Working condition.</td>
			</tr>
			<tr>
				<td>You are requested kindly to take necessary action for grant of Renewal of N.O.C. for the above premises/ building.</td>
			</tr>
		</table>
		<table class="table table-bordered table-responsive">
			<tr>
				<td style="line-height:150%" align="left" valign="top"><u>Contact Details</u><br/>
					1. Name in Full.:-&nbsp;<b> '.strtoupper($key_person).'</b><br/>
					2. Telephone No.:-&nbsp;<b> '.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</b><br/>
					3. Mobile No.:-&nbsp;<b> +91 &nbsp;'.strtoupper($mobile_no).'</b><br/>	
				</td>
			</tr>
		</table>
		
		<table class="table table-bordered table-responsive">
			';
			$printContents=$printContents.$formFunctions->print_upload_payment_details($rowkk);
			$printContents=$printContents.'
			
		</table>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2" align="right">'.strtoupper($key_person).'<br/>Signature of the Applicant</td>
			</tr>
		</table>
		
	 </td></tr>
	</table>
	';	   
?>