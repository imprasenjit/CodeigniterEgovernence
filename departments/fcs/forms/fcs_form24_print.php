<?php
$dept="fcs";
$form="24";
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
		$form_id=$results["form_id"];$stock_point=$results['stock_point'];$lice_type=$results['lice_type'];
		if(!empty($results["supplier"])){
			$supplier=json_decode($results["supplier"]);
			$supplier_n=$supplier->n;$supplier_s1=$supplier->s1;$supplier_s2=$supplier->s2;$supplier_d=$supplier->d;$supplier_v=$supplier->v;$supplier_p=$supplier->p;$supplier_mno=$supplier->mno;
		}else{
			$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
		}
		
		if($lice_type=='NL'){
			$lice_type='NEW LICENCE';
		}else if($lice_type=='R'){
			$lice_type='RENEWAL';
		}else{
			$lice_type=$lice_type;
		}
	}
		
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4><br/>'.$form_name.'</h4>
	</div><br/> 
  	<table class="table table-bordered table-responsive">
  	    
		<tr>
			<td>1. FULL NAME OF THE APPLICANT :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top"> 2. ADDRESS IN FULL   :</td>
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>PIN Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td valign="top">3. LOCATION OF THE PLACE (S) OF  BUSINESS/ADDRESS : </td>	
			<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td >'.strtoupper($b_street_name1).'</td>
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
				</table>
			</td>				
		</tr>   
		<tr>
				<td>4. NAME OF COMPANY/ COMPANIES WHOSE PRODUCT IS BEING TRADE : </td>	
				<td>'.strtoupper($unit_name).'</td>				
		</tr>   
		<tr>
				<td valign="top">5. NAME OF SUPPLIER AND ADDRESS IN FULL :</td>
				<td >
			<table class="table table-bordered table-responsive">
				<tr>
						<td>Name</td>
						<td>'.strtoupper($supplier_n).'</td>
				</tr>
				<tr>
						<td>Street Name 1</td>
						<td>'.strtoupper($supplier_s1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($supplier_s2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($supplier_v).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($supplier_d).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($supplier_p).'</td>
				</tr>				
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($supplier_mno).'</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
				<td>MENTION HERE THE NAME OF THE STOCK POINT :</td>
				<td>'.strtoupper($stock_point).'</td>
		</tr>
		<tr>
				<td>6. LICENCE TYPE :</td>
				<td>'.strtoupper($lice_type).' </td>
		</tr>
		<tr>
				<td colspan="2"> I SOLEMNLY DECLARE THAT THE INFORMATION GIVEN ABOVE IS TRUE TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>