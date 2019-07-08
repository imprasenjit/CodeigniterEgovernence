<?php
$dept="clm";
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
		$form_id=$results['form_id'];$total_turnover =$results['total_turnover'];$license_no=$results['license_no'];
		$date=$results['date'];
		if($date!="" && $date!="0000-00-00"){
			$date = date('d-m-Y',strtotime($date));
		}else{
			$date="";
		}
		$reg_no=$results['reg_no'];
		$reg_date=$results['reg_date'];
		if($reg_date!="" && $reg_date!="0000-00-00"){
			$reg_date = date('d-m-Y',strtotime($reg_date));
		}else{
			$reg_date="";
		}
		$tax_reg =$results['tax_reg'];$manu_details =$results['manu_details'];$state =$results['state'];
		
		if(!empty($results['categories'])){
				$categories=json_decode($results['categories']);
				$categories_w=$categories->w;$categories_m=$categories->m;$categories_wi=$categories->wi;$categories_mi=$categories->mi;
		}else{
				$categories_w="";$categories_m="";$categories_wi="";$categories_mi="";
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
			<td valign="top" width="50%">1. Name of the establishment/shop/person seeking the renewal of license:</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
  	<tr>
  		<td valign="top">2. Dealer&apos;s License Number:</td>
  		<td valign="top"> '.strtoupper($license_no).'</td>
  	</tr>
	<tr>
  		<td valign="top">	3. Date of Establishment:</td>
  		<td valign="top"> '.strtoupper($date).'</td>
  	</tr>
	<tr>
		<td colspan="2">4. Name(s) and address(s) along with their father&apos;s husband&apos;s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
	</tr>
	<tr>
		<td colspan="2">
			<table class="table table-bordered table-responsive">
					<tr>
						<td>Sl No.</td>
						<td>Name</td>
						<td>Father&apos;s/Spouse&apos;s Name</td>
						<td>Address</td>
						<td>Pincode</td>
						<td>Contact No</td>
					</tr>';
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
					$sl=1;
					while($rows=$results1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.$sl.'</td>
							<td>'.strtoupper($rows["name"]).'</td>
							<td>'.strtoupper($rows["family_name"]).'</td>
							<td>'.strtoupper($rows["address"]).'</td>
							<td>'.strtoupper($rows["pincode"]).'</td>
							<td>'.strtoupper($rows["contact"]).'</td>
						</tr>';
						$sl++;
					}
					$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>5. (a) Registration number of shop/establishment/current Municipal Trade License:</td>
		<td>'.strtoupper($reg_no).'</td>
	</tr>
	<tr>
		<td>Total value of transactions / turnover :</td>
		<td>'.strtoupper($total_turnover).'</td>
	</tr>
	<tr>
		<td>5. (b) Date of shop/establishment/current Municipal Trade License:</td>
		<td>'.strtoupper($reg_date).'</td>
	</tr>
	
	<tr>
		<td>6. Categories of weights and measures sold at present:</td>
		<td>(i)Weights : '.strtoupper($categories_w).'<br/>(ii)Measures : '.strtoupper($categories_m).'<br/>(iii)Weighing Instruments : '.strtoupper($categories_wi).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($categories_mi).'</td>
	</tr>
	<tr>
		<td>7. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
		<td>'.strtoupper($tax_reg).'</td>
	</tr>
	<tr>
		<td>8. Are you intending to import weights and measures etc.from places outside the State/Country? If so, indicate Sources of supply from the State(s)/Country(s).(Give details of manufacturer’s trade mark/monogram and his licence number.):</td>
		<td>'.strtoupper($manu_details).'</td>
	</tr>
	
	<tr >
		<td colspan="2" align="center">
  		<h4>To be certified by the applicant(s)</h4>
		<br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state '.strtoupper($state).' . 
		Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.All the information furnished above is true to the best of my/ our knowledge.</td>
	</tr>  ';
	  
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 	
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="center">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>
