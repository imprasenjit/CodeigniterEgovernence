<?php 
$dept="clm";
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
	
	
	if($q->num_rows>0){
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$weights_measure =$results['weights_measure'];$reg_number =$results['reg_number'];$is_intend=$results['is_intend'];$source_supply=$results['source_supply'];$monogram =$results['monogram'];$lic_num =$results['lic_num'];$regis_impoter =$results['regis_impoter'];$model_impoter =$results['model_impoter'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
		}
		if($fact_reg_date!="" && $fact_reg_date!="0000-00-00"){
			$fact_reg_date = date('d-m-Y',strtotime($fact_reg_date));
		}else{
			$fact_reg_date="";
		}		
		if($is_applied!='N'){$is_applied='Yes';} else $is_applied='No';
		if($is_intend!='N'){
			$source_value='Source Supply : '.strtoupper($source_supply).' <br/>Manufacturer’s Trade mark/monogram : '.$monogram.' <br/>License Number : '.strtoupper($lic_num);
		}else{
			$source_value='No';
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
			<td valign="top" width="50%">1. Name of the establishment/shop/person seeking the licence :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
	<tr>
  		<td valign="top">2. Complete address of the establishment etc  :</td>
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
    		</table></td>
  	</tr>
  	<tr>
  		<td valign="top">3. Date of establishment :</td>
  		<td valign="top"> '.date('d-m-Y',strtotime($date_of_commencement)).'</td>
  	</tr>
	<tr>
		<td colspan="2" >4. Name(s) and address(s) of proprietors and / or partners and Managing Director(s) in the case of Limited Company :</td>
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
					$sl++;}	
				$printContents=$printContents.'
			</table>
		</td>
	</tr>
	<tr>
		<td>5. Number and date of Registration Number of current shop/ establishment/Municipal Trade licence :</td>
		<td>'.strtoupper($fact_reg_date).'&nbsp;'.strtoupper($fact_reg_no).'</td>
	</tr>
	<tr>
		<td>6. Categories of weights and measures sold/proposed to be sold at present :</td>
		<td>'.strtoupper($weights_measure).'</td>
	</tr>
	<tr>
		<td>7. Registration Number of VAT/CST/Sales Tax/ Professional Tax/Income Tax :</td>
		<td>'.strtoupper($reg_number).'</td>
	</tr>
	<tr>
		<td>8. Do you intend to imports weights, etc. from places outside the State/ Country? If so indicate sources of supply.(Give details of manufacturer’s trade mark/ monogram and  his licence number) and provide :</td>
		<td>'.$source_value.'</td>
	</tr>
	<tr>
		<td>(a) Registration of Importer of Weights and Measures, if any :</td>
		<td>'.strtoupper($regis_impoter).'</td>
	</tr>
	<tr>
		<td>(b) Approval of model imported into India by Central Government :</td>
		<td>'.strtoupper($model_impoter).'</td>
	</tr>
	<tr>
		<td>9. Have you applied previously for a dealer’s licence either in this State or elsewhere?  :</td>
		<td>'.strtoupper($is_applied).'&nbsp;'.strtoupper($is_applied_details).'</td>
	</tr>
	<tr >
		<td colspan="2" align="center">
  		<h4>To be certified by the applicant(s)</h4>
		<p style="float:left;"><br/>Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under. <br/> <br/>
		I/ We agree to deposit the Scheduled licence fees with Government as soon as required to do so by the Licencing Authority.
		<br/><br/> All the information furnished above is true to the best of my/ our knowledge.<br/><br/></p>
		</td>
	</tr>';
	
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
        <tr>
			<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
        </tr>
</table>';

?>
