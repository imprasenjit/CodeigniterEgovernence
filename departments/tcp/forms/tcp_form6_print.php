<?php
$dept="tcp";
$form="6";
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
	$form_id=$results["form_id"];
	$ref_uain=$results["ref_uain"];$ownername=$results["ownername"];$location=$results["location"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$development_name=$results["development_name"];$development_address=$results["development_address"];$drawings=$results["drawings"];$p_plot_no=$results["p_plot_no"];$p_block_no=$results["p_block_no"];
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
	<br/><br/>
    <div style="text-align:center">
        '.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div>
	<br/><br/>
	<table class="table table-bordered table-responsive">
		<tr>
			<td width="50%">Reference No./UAIN : </td>
			<td width="50%">'.strtoupper($ref_uain).'</td> 
		</tr>
		<tr>
			<td>Owner&apos;s Name : </td>
			<td>'.strtoupper($ownername).'</td>
		</tr>
		<tr>
			<td>Location of the proposed site : </td>
			<td> '.strtoupper($location).'</td>
		</tr>
		<tr>
			<td>Plot No. : </td>
			<td>'.strtoupper($p_plot_no).'</td>
		</tr>
		<tr>
			<td>Block No. : </td>
			<td>'.strtoupper($p_block_no).'</td>
		</tr>
		<tr>
			<td>Submitted on : </td>
			<td>'.strtoupper($submit_dt).'</td>
		</tr>
		<tr>
			<td>Received on : </td>
			<td>'.strtoupper($receive_dt).'</td>
		</tr>
		<tr>
			<td colspan="2" align="justify">
				Sir,<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The work of erection/re-erection of building as per approved plan is completed under the Supervision of Architect/Construction Engineer who have given the completion certificate which is enclosed herewith.<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We declare that the work is executed as per the provisions of the Act and Development Control Regulations and to our satisfaction. We declare that the construction is to be used for &nbsp;'.strtoupper($drawings).' the purpose as per approved plan and it shall not be changed without obtaining written permission.<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby declare that the plan as per the building erected has been submitted and approved. We have transferred the area of parking space provided as per approved plan to an individual/association before for occupancy certificate.<br/>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Any subsequent change from the completion drawings shall be our responsibility.
			</td>
		</tr>
		<tr>
			<td colspan="4">Yours faithfully,</td>
		</tr>
		<tr>
			<td>Name of the Construction Engineer on Record :</td>
			<td>'.strtoupper($engineer).'</td>
		</tr>
		<tr>
			<td>Address of the  Construction Engineer on Record :</td>
			<td>'.strtoupper($engineer_address).'</td>
		</tr>
		<tr>
			<td>Name of the Owner/Development/Builder :</td>
			<td >'.strtoupper($development_name).'</td>
			
		</tr>
		<tr>
			<td>Address of the Owner/Development/Builder :</td>
			<td >'.strtoupper($development_address).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
	
		<tr>
			<td colspan="2">Signatures and Date</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						<td align="right">'.strtoupper($key_person).'<br/>Name of the applicant</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>';
?>