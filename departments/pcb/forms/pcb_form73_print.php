<?php
$dept="pcb";
$form="73";
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
		//$email=$formFunctions->get_usermail($swr_id);   
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$address_authority=$results['address_authority'];$appeal_made=$results['appeal_made'];
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
	</div>  <br/>
           <table class="table table-bordered table-responsive">
		<tr> 				
			<td> 1.Name and address of the person making the appeal  </td>
			
			<td width="50%">
    		<table class="table table-bordered table-responsive">
				<tr>  				
					<td width="50%">1. Full Name of the Applicant:</td>
					<td>'.strtoupper($key_person).'</td>
				</tr>
				<tr>
					<td>Street Name 1</td>
					<td>'.strtoupper($street_name1).'</td>
				</tr>
				<tr>
					<td>Street Name 2</td>
					<td>'.strtoupper($street_name2).'</td>
				</tr>
				<tr>
					<td>Village/Town</td>
					<td>'.strtoupper($vill).'</td>
				</tr>
				<tr>
					<td>District</td>
					<td>'.strtoupper($dist).'</td>
				</tr>
				<tr>
					<td>Pincode</td>
					<td>'.strtoupper($pincode).'</td>
				</tr>
				<tr>
					<td>Mobile</td>
					<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
					<td>Phone Number</td>
					<td>'.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</td>
				</tr>
				<tr>
					<td>Email-id</td>
					<td>'.$email.'</td>
				</tr> 
			</table>
		 </td>
		</tr> 
	    <tr>
			<td>2. Number, date of order and address of the authority pwhich passed the order, against which appeal is being made</td>
			<td>'.strtoupper($address_authority).'</td>
		</tr>
		 <tr>
			<td>3.Ground on which the appeal is being made  </td>
			<td>'.strtoupper($appeal_made).'</td>
		</tr>
		   
			 
			';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			
			$printContents=$printContents.'
				
			
       
       <tr>						
		<td> Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>
		<td  align="right">Signature :'.strtoupper($key_person).'</td>
	  </tr>
	  </table>';
?>