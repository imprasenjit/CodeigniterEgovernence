<?php
$dept="tcp";
$form="8";
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
	$supervision=$results["supervision"];$name=$results["name"];$edu_quali =$results["edu_quali"];$past_exp =$results["past_exp"];$father_name =$results["father_name"];$pan =$results["pan"];$dob=$results["dob"];$owner_age=$results["owner_age"];

	if(!empty($results["authority_addres"])){
		$authority_addres=json_decode($results["authority_addres"]);
		$authority_addres_a=$authority_addres->a;$authority_addres_b=$authority_addres->b;
	}else{				
		$authority_addres_a="";$authority_addres_b="";
	}
	if(!empty($results["pre_add"])){
		$pre_add=json_decode($results["pre_add"]);
		$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;$pre_add_email=$pre_add->email;	
	}else{				
		$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";
	}
	if(!empty($results["fees"])){
		$fees=json_decode($results["fees"]);
		$fees_n=$fees->n;$fees_r=$fees->r;
	}else{				
		$fees_n="";$fees_r="";
	}
}
	
$form_name=$formFunctions->get_formName($dept,$form);
$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
	$printContents='<!DOCTYPE html>
	<html lang="en">
	<head>
	<title>Form '.$form.'</title>
	<style type="test/css">
	table, thead, td {
		border: 1px solid #000;
		border-collapse: collapse;
	}
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
	</head>
	<body>';		
}else{
		$printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
	<div style="text-align:center">
		'.$assamSarkarLogo.'<h4><br/><br/>'.$form_name.'</h4>
	</div><br/>
      <table class="table table-bordered table-responsive">
		<tr>
			<td colspan="2">To <br/>'.strtoupper($authority_addres_a).'<br/>'.strtoupper($authority_addres_b).'<br/><br/>
			I hereby apply for enrollment of my name as competent Technical personnel to do the various works of schemes for Building Permitand supervision in the &nbsp;'.strtoupper($supervision).'<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I do hereby also declare that I shall follow and shall abide by all the Rules and Regulations now in force and that may be framed from time.</td>
		</tr>
		<tr>
				<td colspan="2">My personal bio-data are as follows-</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Name</td>
				<td width="50%">'.strtoupper($name).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Qualification:</td>
				<td width="50%">'.strtoupper($edu_quali).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Past experience :</td>
				<td width="50%">'.strtoupper($past_exp).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Father&apos;s Name :</td>
				<td width="50%">'.strtoupper($father_name).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Pan No. :</td>
				<td width="50%">'.strtoupper($pan).'</td>
		</tr>
		<tr>
				<td valign="top">Present Address</td>
				<td>
					<table class="table table-bordered table-responsive">
					<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($pre_add_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($pre_add_sn2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($pre_add_v).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($pre_add_d).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($pre_add_p).'</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($pre_add_mno).'</td>
					</tr>
					<tr>
						<td>Email ID :</td>
						<td> '.$pre_add_email.'</td>
					</tr>
					</table>
				</td>
		</tr>
		<tr>
			<td valign="top">Permanent Address</td>
			<td>
				<table class="table table-bordered table-responsive">
				<tr>
					<td width="50%">Street Name 1</td>
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
					<td>+91 - '.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
					<td>Email ID :</td>
					<td> '.$email.'</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I deposit herewith annual enrolment fees of Rs. &nbsp;'.strtoupper($fees_n).'&nbsp;(Rupees)&nbsp;'.strtoupper($fees_r).'&nbsp; only in cash as required.
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="center">Signature : '.strtoupper($key_person).'</td>
		</tr>
	</table>';
?>