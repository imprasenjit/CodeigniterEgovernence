<?php
 $dept="doa";
 $form="3";
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
		$form_id=$results["form_id"];$licence_no=$results["licence_no"];$licence_dt=$results["licence_dt"];$father_name=$results["father_name"];$virtue=$results["virtue"];
					
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
				<td colspan="2" class="form-inline">1. I / We &nbsp;'.strtoupper($key_person).' &nbsp;of&nbsp;'.strtoupper($unit_name).' &nbsp;  hereby apply for the renewal of the licence to manufacture insecticides on the premises situated at  &nbsp;'.strtoupper($dist).' &nbsp; &nbsp;'.strtoupper($licence_no).' &nbsp; &nbsp;'.strtoupper($licence_dt).' .</td>
		</tr>
		<tr>
				<td colspan="2">2. The other details regarding the manufacture of the insecticides continue to remain the same. </td>
		</tr>
		<tr>
				<td colspan="2"> <strong>Verification</strong><br/><br/>I &nbsp;'.strtoupper($key_person).' &nbsp;s/o&nbsp;'.strtoupper($father_name).' &nbsp; do hereby solemnly verify that to the best of my knowledge and belief.<br/><br/>
				I further declare that I am making this application in my capacity as  &nbsp;'.strtoupper($status_applicant).' &nbsp;&nbsp; and that I am competent to make this application and verify it by virtue of  &nbsp;&nbsp;'.strtoupper($virtue).' &nbsp;&nbsp; a photo/attested copy of which is enclosed herewith.</td>
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
	</table>
	';
?>