<?php
 $dept="doa";
 $form="32";
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
			//tab1
				if(!empty($results["godown_add"])){
					$godown_add=json_decode($results["godown_add"]);
					$godown_add_st1=$godown_add->st1;$godown_add_st2=$godown_add->st2;$godown_add_vil=$godown_add->vil;$godown_add_dist=$godown_add->dist;$godown_add_pin=$godown_add->pin;$godown_add_mno=$godown_add->mno;$godown_add_email=$godown_add->email;
				}else{				
					$godown_add_st1="";$godown_add_st2="";$godown_add_vil="";$godown_add_dist="";$godown_add_pin="";$godown_add_mno="";$godown_add_email="";
				}
				
				$licence_number=$results["licence_number"];$date_of_fertilizer=$results["date_of_fertilizer"];
				
				if(!empty($results["address_change"])){
					$address_change=json_decode($results["address_change"]);
					if(isset($address_change->a)) $address_change_a=$address_change->a; else $address_change_a="";
					if(isset($address_change->b)) $address_change_b=$address_change->b; else $address_change_b="";
				}else{
					$address_change_a="";$address_change_b="";
				}
				
				//tab2
				$existing_office_add=$results["existing_office_add"];$new_office_add=$results["new_office_add"];
				$existing_godown_add=$results["existing_godown_add"];$new_godown_add=$results["new_godown_add"];
				$is_affidavit=$results["is_affidavit"];


			
		$address_change_values="";		
		  if($address_change_a=="O") $address_change_values=$address_change_values. '<span class="tickmark">&#10004;</span>Office';
		  if($address_change_b=="G") $address_change_values=$address_change_values. '<span class="tickmark">&#10004;</span>Godown';
		
		if($is_affidavit=="Y") $is_affidavit="YES";
		else $is_affidavit="NO";
		
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
				<td>1. Name of the applicant :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr> 
				<td width="50%">Address of the applicant :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1 : </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town : </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-mail id : </td>
						<td>'.$email.'</td>
					</tr>
				</table></td>
			</tr>	
			<tr> 
				<td width="50%">2. Registered Office Address :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1 : </td>
						<td>'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town : </td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($b_dist).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($b_pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($b_mobile_no).'</td>
					</tr>
					<tr>
						<td>E-mail id : </td>
						<td>'.$b_email.'</td>
					</tr>
				</table></td>
			</tr>
			<tr> 
				<td width="50%">3. Godown Address :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1 : </td>
						<td>'.strtoupper($godown_add_st1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($godown_add_st2).'</td>
					</tr>
					<tr>
						<td>Village/Town : </td>
						<td>'.strtoupper($godown_add_vil).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($godown_add_dist).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($godown_add_pin).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($godown_add_mno).'</td>
					</tr>
					<tr>
						<td>E-mail id : </td>
						<td>'.$godown_add_email.'</td>
					</tr>
				</table></td>
			</tr>
			<tr>
				<td>4. Existing Valid Seed License No. & Dated :</td>
				<td><table class="table table-bordered table-responsive">
						
						<tr>
							<td>Licence number : </td>
							<td>'.strtoupper($licence_number).'</td>
						</tr>
						<tr>
							<td>Date : </td>
							<td>'.strtoupper($date_of_fertilizer).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>5. Which address to change  :</td>
				<td>'.strtoupper($address_change_values).'</td>
			</tr>
			<tr>
				<td colspan="2">6. For Office Address Change :</td>
			</tr>
			<tr>
				<td>Existing office Address  :</td>
				<td>'.strtoupper($existing_office_add).'</td>
			</tr>
			<tr>
				<td>New Office Address :</td>
				<td>'.strtoupper($new_office_add).'</td>
			</tr>
			<tr>
				<td colspan="2">7. For Godown Address Change:</td>
			</tr>
			<tr>
				<td>Existing Godown Address  :</td>
				<td>'.strtoupper($existing_godown_add).'</td>
			</tr>
			<tr>
				<td>New Godown Address :</td>
				<td>'.strtoupper($new_godown_add).'</td>
			</tr>
			<tr>
				<td>8. Court Affidavit of address change submitted</td>
				<td>'.strtoupper($is_affidavit).'</td>
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