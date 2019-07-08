<?php
 $dept="doa";
 $form="19";
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
		$form_id=$results["form_id"];$licence=$results["licence"];$day=$results["day"];$year=$results["year"];$licence_authority=$results["licence_authority"];$operation=$results["operation"];$expert=$results["expert"];
	
		$insect=$results["insect"];$stock=$results["stock"];$branch=$results["branch"];$new_branch=$results["new_branch"];$other=$results["other"];$total_pesticides=$results["total_pesticides"];$engage=$results["engage"];$name2=$results["name2"];$son_of=$results["son_of"];$designation=$results["designation"];	
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
            <td colspan="2">1. I/We hereby apply for renewal of the licence to stock and use restricted insecticides for categories I, II and III, under the name and style of&nbsp;'.strtoupper($licence).'&nbsp;The licence desired to be renewed was granted the Licensing Authority and alloted License No&nbsp;'.strtoupper($licence_authority).'&nbsp;&nbsp;&nbsp;on the day of &nbsp;&nbsp;'.strtoupper($day).'&nbsp;&nbsp; 20'.strtoupper($year).'.</td>
		</tr>
		<tr>
			<td colspan="2">2. State the, if any, in </td>
			<td><table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">(a) Category of operation</td>
						<td>'.strtoupper($operation).'</td>
					</tr>
					<tr>
					    <td>(b) Expert staff </td>
						<td>'.strtoupper($expert).'</td>
					</tr>
					<tr>
						<td>(c) Restricted insecticides used</td>
						<td>'.strtoupper($insect).'</td>
					</tr>
					<tr>
						<td>(d) Premises of stocking</td>
						<td>'.strtoupper($stock).'</td>
					</tr>
					<tr>
						<td>(e) Address including branch officers</td>
						<td>'.strtoupper($branch).'</td>
					</tr>
					<tr>
						<td>(f) Whether any new branch / unit has been opened after grant or renewal of license</td>
						<td>'.strtoupper($new_branch).'</td>
					</tr>
					<tr>
						<td>(g) Any other change</td>
						<td>'.strtoupper($other).'</td>
					</tr>
					</table>
                  </td>
				</tr>
				
					<tr>
						<td>3. Total No. of Pesticides :</td>
						<td>'.strtoupper($total_pesticides).'</td>
					</tr>
					<tr>
						<td>4. Give latest details of persons engaged (attach separate sheet, duly authenticated)</td>
						<td>'.strtoupper($engage).'</td>
					</tr>
					
				
				
		<tr>
			<td colspan="2"><b>Verification</b></td>
		</tr>
		
		<tr>
            <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;'.strtoupper($name2).'&nbsp;S/O'.strtoupper($son_of).'&nbsp;do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexures and statements accompanying it is correct and complete.<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp; I further declare that I am making this application in my capacity as&nbsp;'.strtoupper($designation).'&nbsp;&nbsp;and that I am competent to make this application and verify it, by virtue of a photo/attested copy which has already been submitted.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 		
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>  