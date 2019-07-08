<?php
$dept="doa";
$form="30";
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
		
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$is_change=$results["is_change"];
			$license_no=$results["license_no"];$license_dt=$results["license_dt"];
			
			if(!empty($results["godown"])){
			$godown=json_decode($results["godown"]);
			$godown_st1=$godown->st1;$godown_st2=$godown->st2;$godown_vill=$godown->vill;$godown_dist=$godown->dist;$godown_pin=$godown->pin;$godown_mno=$godown->mno;$godown_email=$godown->email;
			}else{				
				$godown_st1="";$godown_st2="";$godown_vill="";$godown_dist="";$godown_pin="";$godown_mno="";$godown_email="";
			}
			
			if(!empty($results["address_change"])){
			 $address_change=json_decode($results["address_change"]);
			 if(isset($address_change->a)) $address_change_a=$address_change->a; else $address_change_a="";
			 if(isset($address_change->b)) $address_change_b=$address_change->b; else $address_change_b="";
			}else{
				$address_change_a="";$address_change_b="";
			}
		$address_change_values="";		
		  if($address_change_a=="O") $address_change_values=$address_change_values. '<span class="tickmark">&#10004;</span>Office';
		  if($address_change_b=="A") $address_change_values=$address_change_values. '<span class="tickmark">&#10004;</span>Godown';
		  
			
			if(!empty($results["office"])){
				$office=json_decode($results["office"]);
                 if(isset($office->address)) $office_address=$office->address; else $office_address="";
                 if(isset($office->address1)) $office_address1=$office->address1; else $office_address1="";
				
			}else{				
				$office_address="";$office_address1="";
			}
			if(!empty($results["godown_change"])){
				$godown_change=json_decode($results["godown_change"]);
                if(isset($godown_change->address)) $godown_change_address=$godown_change->address; else $godown_change_address="";
                if(isset($godown_change->address1)) $godown_change_address1=$godown_change->address1; else $godown_change_address1="";
			
			}else{				
				$godown_change_address="";$godown_change_address1="";
			}
			
			if($is_change=="Y"){
				$is_change="Yes";
			}else{
				$is_change="No";
			}
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
			<td width="50%">1. Name of the Applicant</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top">2. Registered Office Address</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$b_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">3. Godown Address</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($godown_st1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($godown_st2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($godown_vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($godown_dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($godown_pin).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($godown_mno).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$godown_email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td>4. Existing Valid Insecticide License No. & Dated </td>
		</tr>
		<tr>
			<td>License No </td>
			<td>'.strtoupper($license_no).'</td>
		</tr>
		<tr>
			<td>Date </td>
			<td>'.strtoupper($license_dt).'</td>
		</tr>
		<tr>
			<td>5. Which address to change </td>
			<td>'.strtoupper($address_change_values).'</td>
		</tr>
		<tr>
			<td>6. For Office Address Change  </td>
		</tr>
		<tr>
			<td>Existing office Address </td>
			<td>'.strtoupper($office_address).'</td>
		</tr>
		<tr>
			<td>New Office Address </td>
			<td>'.strtoupper($office_address1).'</td>
		</tr>
		<tr>
			<td>7. For Godown Address Change  </td>
		</tr>
		<tr>
			<td>Existing office Address </td>
			<td>'.strtoupper($godown_change_address).'</td>
		</tr>
		<tr>
			<td>New Office Address </td>
			<td>'.strtoupper($godown_change_address1).'</td>
		</tr>
		<tr>
			<td>8. Court Affidavit of address change submitted </td>
			<td>'.strtoupper($is_change).'</td>
		</tr>
		';
		
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
        $printContents=$printContents.' 
		
		<tr>
			<td>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
			Place<strong> :</strong> '.strtoupper($dist).' </td>
			<td align="right">Signature of the Applicant<strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>			
	</table>	
		';
?>