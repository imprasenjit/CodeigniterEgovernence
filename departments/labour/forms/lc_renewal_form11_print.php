<?php
$dept="labour";
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
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$prev_lic_date=$results["prev_lic_date"];$is_suspended=$results["is_suspended"];$max_workers=$results["max_workers"];
		
		if(!empty($results["contractor"])){
			$contractor=json_decode($results["contractor"]);
			$contractor_sn1=$contractor->sn1;$contractor_sn2=$contractor->sn2;$contractor_v=$contractor->v;$contractor_d=$contractor->d;$contractor_pin=$contractor->pin;
		}else{
			$contractor_sn1="";$contractor_sn2="";$contractor_v="";$contractor_d="";$contractor_pin="";
		}
		if(!empty($results["license"])){
			$license=json_decode($results["license"]);
			$license_no=$license->no;$license_dt=$license->dt;
		}else{
			$license_no="";$license_dt="";
		}
	}
	if($results["is_suspended"]=="Y"){
		$is_suspended="YES";
	}else{
		$is_suspended="NO";
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
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4><br/>
</div> 
<table class="table table-bordered table-responsive">
	<tr>
		<td width="50%"> 1.Name and address of the Contractor.</td>
		<td>'.strtoupper($from).'</td>
	</tr>

	<tr>
		<td>2.Number and Date of the License </td>
	</tr>
	<tr>
		<td>Number </td>
		<td>'.strtoupper($license_no).'</td>
	</tr>
	<tr>
		<td>Date </td>
		<td>'.strtoupper($license_dt).'</td>
	</tr> 
	<tr>
		<td >3. Date of expiry of the previous license. </td>
		<td>'.strtoupper($prev_lic_date).'</td>
	</tr>
	<tr>
		<td >4. Whether the license of the contractor was suspended or revoked.  </td>
		<td>'.strtoupper($is_suspended).'</td>
	</tr>
	<tr>
		<td >5. No. of workers employed on any day. </td>
		<td>'.strtoupper($results["max_workers"]).'</td>
	</tr>
';
		
	$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
	$printContents=$printContents.'   
	<tr>
		<td colspan="2">
		  <table class="table table-bordered table-responsive">
				<tr>
					<td colspan="2"><br/>Signatures and Dates:  </td>
				</tr>
				<tr>
					<td width="50%">Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</td>
					<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
					<td>Place : '.strtoupper($dist).'</td>
					<td>Signature of the Applicant (Contractor)</td>
			   </tr>                  
			</table>
	   </td>
	</tr>		
</table>';
?>