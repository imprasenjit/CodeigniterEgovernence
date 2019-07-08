<?php
$dept="clm";
$form="7";
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
	$brnch_nm=$results["brnch_nm"];$commodities=$results["commodities"];$cst_no=$results["cst_no"];
		if(!empty($results["fac"])){
			$fac=json_decode($results["fac"]);
			$fac_name=$fac->name;$fac_strt_name1=$fac->strt_name1;$fac_strt_name2=$fac->strt_name2;$fac_vill=$fac->vill;$fac_dist=$fac->dist;$fac_pincode=$fac->pincode;
		}else{
			$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
     <table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">To,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;The Controller of Legal Metrology, Assam,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;R.K. Mission Road, Ulubari,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;Guwahati-781007
				</td>
			</tr>
			<tr>
				<td width="50%" valign="top">1. Name of the Applicant/Firm :</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>(a) Name of the Firm</td>
							<td>'.strtoupper($unit_name).'</td>
						</tr>
						<tr>
							<td>(b) Name of the Applicant</td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">2. Complete address of the Applicannt/Firm :</td>
				<td>
					<table class="table table-bordered table-responsive">
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
							<td>Mobile No.</td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>Phone No.</td>
							<td>'.strtoupper($landline_std).'-'.strtoupper($landline_no).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">3. Registered office address :</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($b_street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($b_vill).'</td>
						</tr>
						<tr>
							<td>Block</td>
							<td>'.strtoupper($b_block).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">4. Location of the factory :</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Factory Name</td>
							<td>'.strtoupper($fac_name).'</td>
						</tr>
						<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($fac_strt_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($fac_strt_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($fac_vill).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($fac_dist).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.strtoupper($fac_pincode).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>5. Branches, if any :</td>
				<td>'.strtoupper($brnch_nm).'</td>
			</tr>
			<tr>
				<td colspan="2">6. Name(s) of the Proprietor/Partners/Occupier :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th>Sl. No.</th>
								<th>Name</th>
								<th>Father&apos;s/Spouse&apos;s Name</th>
								<th>Address</th>
								<th>Pincode</th>
								<th>Contact No</th>
							</tr>
						</thead>
						<tbody>';
						$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
						$sl=1;
						while($rows=$results1->fetch_object()){
							$printContents=$printContents.'
							<tr>
								<td>'.$sl.'</td>
								<td>'.strtoupper($rows->name).'</td>
								<td>'.strtoupper($rows->family_name).'</td>
								<td>'.strtoupper($rows->address).'</td>
								<td>'.strtoupper($rows->pincode).'</td>
								<td>'.strtoupper($rows->contact).'</td>
							</tr>';
							$sl++;
						}
						$printContents=$printContents.'
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>7. Commodity(ies) intended to Pre-pack :</td>
				<td>'.strtoupper($commodities).'</td>
			</tr>
			<tr>
				<td>8. CST no./AGST no/MLT no.</td>
				<td>'.strtoupper($cst_no).'</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b><u>DECLARATION</u></b></td>
			</tr>
			<tr>
				<td colspan="2">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I/we hereby declare that the packages manufactured/packed will comply the various provisions of the Legal Metrology (Packaged Commodities) Rule, 2011.</td>
			</tr>';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			<tr>
				<td>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
				<td  align="right">Designation : '.strtoupper($status_applicant).'<br/>Signature : '.strtoupper($key_person).'</td>
			</tr>
</table>';

?>