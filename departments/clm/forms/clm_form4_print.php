<?php
$dept="clm";
$form="4";
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
	$license_no=$results['license_no'];$type_changes=$results['type_changes'];$weight_trademark=$results['weight_trademark'];$workshop_details =$results['workshop_details'];$production_details =$results['production_details'];$shop_reg_no =$results['shop_reg_no'];$total_turnover =$results['total_turnover'];
	$shop_reg_date =$results['shop_reg_date'];
		if($shop_reg_date!="" && $shop_reg_date!="0000-00-00"){
			$shop_reg_date = date('d-m-Y',strtotime($shop_reg_date));
		}else{
			$shop_reg_date="";
		}	
		if(!empty($results["type"]))
			{
				$type=json_decode($results["type"]);
				$type_weight=$type->weight;$type_measures=$type->measures;$type_instrument=$type->instrument;$type_details=$type->details;
			}else{
				$type_weight="";$type_measures="";$type_instrument="";$type_details="";
			}	
		$tax_reg_no =$results['tax_reg_no'];$state =$results['state'];
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
			<td valign="top" width="50%">1. (a) Name of the manufacturing concern for which renewal of license is desired:</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
  		    <td valign="top">(b) Address of the manufacturing concern for which renewal of license is desired:</td>
  		<td>
		 <table class="table table-bordered table-responsive">
      		<tr>
        			<td width="50%">Street Name 1</td>
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
        			<td>District</td>
        			<td>'.strtoupper($b_dist).'</td>
      		</tr>
      		<tr>
        			<td>Pincode</td>
        			<td>'.strtoupper($b_pincode).'</td>
      		</tr>
			
      		<tr>
        			<td>Mobile</td>
        			<td>+91 - '.strtoupper($b_mobile_no).'</td>
      		</tr>
      		<tr>
        			<td>Email-id</td>
        			<td>'.$b_email.'</td>
      		</tr>
    		</table>
		</td>
  	</tr>
  	<tr>
  		<td valign="top">2. Manufacturing License No.:</td>
  		<td valign="top"> '.strtoupper($license_no).'</td>
  	</tr>
	<tr>
		<td colspan="2">3. Name(s) and address(s) along with their father&apos;s husband&apos;s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
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
					$results1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
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
		<td>4.(a) Type of weights and measures which are manufactured as per license granted:</td>
		<td>(i)Weights : '.strtoupper($type_weight).'<br/>(ii)Measures : '.strtoupper($type_measures).'<br/>(iii)Weighing Instruments : '.strtoupper($type_instrument).'<br/>(iv)Measuring Instruments with details in each case : '.strtoupper($type_details).'</td>
	</tr>
	<tr>
		<td>4.(b) Do you propose any change?</td>
		<td>'.strtoupper($type_changes).'</td>
	</tr>
	
	<tr>
		<td>5. The monogram or trademarks used on weights and measures manufactured by you:</td>
		<td>'.strtoupper($weight_trademark).'</td>
	</tr>
	<tr>
		<td>6. Details of workshop facilities available:</td>
		<td>'.strtoupper($workshop_details).'</td>
	</tr>
	<tr>
		<td>7. Details of production and sales in the last 5 years:</td>
		<td>'.strtoupper($production_details).'</td>
	</tr>
	<tr>
		<td>8. (a) Number of shop/establishment Registration:</td>
		<td>'.strtoupper($shop_reg_no).'</td>
	</tr>
	<tr>
		<td>8. (b) Date of shop/establishment Registration:</td>
		<td>'.strtoupper($shop_reg_date).'</td>
	</tr>
	<tr>
		<td>9. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax:</td>
		<td>'.strtoupper($tax_reg_no).'</td>
	</tr>
	<tr>
		<td>Total value of transactions / turnover :</td>
		<td>'.strtoupper($total_turnover).'</td>
	</tr>
	
	<tr>
		<td colspan="2" align="center">
  		<h4>To be certified by the applicant(s)</h4>
		<br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state '.strtoupper($state).' . 
		Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.
				All the information furnished above is true to the best of my/ our knowledge.</td>
	</tr>   
     ';
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>
