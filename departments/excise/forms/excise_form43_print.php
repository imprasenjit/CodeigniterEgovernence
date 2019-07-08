<?php
 $dept="excise";
 $form="43";
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
		$name_father=$results["name_father"];$applicant_age=$results["applicant_age"];$sex_applicant=$results["sex_applicant"];$details_of_site=$results["details_of_site"];$trade_license_no=$results["trade_license_no"];$sales_tax_reg_no=$results["sales_tax_reg_no"];$details_of_license=$results["details_of_license"];
				
		if(!empty($results["present_address"])){
			$present_address=json_decode($results["present_address"]);
			$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
		}else{				
			$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
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
								<td width="50%">1. Name of Applicant </td>
								<td>'.strtoupper($key_person).'</td>
							</tr>
							<tr>
								<td>2. Name of Father/Husband</td>
								<td>'.strtoupper($name_father).'</td>
							</tr>
							<tr>
								<td colspan="2">3. Address of the person applying </td>
							</tr>
							<tr>
								<td valign="top">Present address </td>
								<td>
									<table class="table table-bordered table-responsive">
										
										<tr>
											<td>Street Name 1 :</td>
											<td>'.strtoupper($present_address_sn1).'</td>
										</tr>
										<tr>
											<td>Street name 2 :</td>
											<td>'.strtoupper($present_address_sn2).'</td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td>'.strtoupper($present_address_vil).'</td>
										</tr>
										<tr>
											<td>District :</td>
											<td>'.strtoupper($present_address_dist).'</td>
										</tr>
										<tr>
											<td>Pincode :</td>
											<td>'.strtoupper($present_address_pin).'</td>
										</tr>
										<tr>
											<td>Mobile No. :</td>
											<td>'.strtoupper($present_address_mobile_no).'</td>
										</tr>
										<tr>
											<td>Email-Id :</td>
											<td>'.$present_address_email.'</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td valign="top">Permanent address </td>
								<td>
									<table class="table table-bordered table-responsive">
										
										<tr>
											<td>Street Name 1 :</td>
											<td>'.strtoupper($street_name1).'</td>
										</tr>
										<tr>
											<td>Street name 2 :</td>
											<td>'.strtoupper($street_name2).'</td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td>'.strtoupper($vill).'</td>
										</tr>
										<tr>
											<td>District :</td>
											<td>'.strtoupper($dist).'</td>
										</tr>
										<tr>
											<td>Pincode :</td>
											<td>'.strtoupper($pincode).'</td>
										</tr>
										<tr>
											<td>Mobile No. :</td>
											<td>'.strtoupper($mobile_no).'</td>
										</tr>
										<tr>
											<td>Email-Id :</td>
											<td>'.$email.'</td>
										</tr>
									</table>
								</td>
							</tr>
								
							<tr>
								<td>4. Age of the applicant </td>
								<td>'.strtoupper($applicant_age).'</td>
							</tr>
							<tr>
								<td>5. Sex of Applicant</td>
								<td>'.strtoupper($sex_applicant).'</td>
							</tr>
								
							<tr>
								<td>6. Details of site in which the premise is to be opened</td>
								<td>'.strtoupper($details_of_site).'</td>
							</tr>		
							<tr>
								<td>7. Trade license No.</td>
								<td>'.strtoupper($trade_license_no).'</td>
							</tr>
							<tr>
								<td>8. Sales Tax registration No./VAT registration No.</td>
								<td>'.strtoupper($sales_tax_reg_no).'</td>
							</tr>
							<tr>
								<td>9. Details of any other license granted by authorities other than department of</td>
								<td>'.strtoupper($details_of_license).'</td>
							</tr>';
				
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
			<tr>
				<td valign="top" >Date: '.date('d-m-Y',strtotime($results["sub_date"])).'	</td>
				<td align="right">Signature: '.strtoupper($key_person).'</td>
			</tr> 
			<tr>
				<td valign="top" >Place: '.strtoupper($dist).'	</td>
				<td align="right">Designation : '.strtoupper($status_applicant).'</td>
			</tr>
           
		</table>
	
';
?>
				  
				