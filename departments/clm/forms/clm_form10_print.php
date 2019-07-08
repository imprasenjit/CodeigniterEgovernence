<?php
$dept="clm";
$form="10";
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
			$form_id=$results['form_id'];$form_against=$results['form_against'];$order_num=$results['order_num'];$order_date= $results['order_date'];
			if($order_date!="" && $order_date!="0000-00-00"){
				$order_date = date('d-m-Y',strtotime($order_date));
			}else{
				$order_date="";
			}
			$auth_representative=$results['auth_representative'];$ground_appeal=$results['ground_appeal'];$sub_date=$results['sub_date'];
			if($results["form_against"]=="L"){
				$form_against="Legal Metrology Officer";
			}else{
				$form_against="Controller Legal Metrology";
			}
			if($auth_representative=="I"){
				$auth_representative="In person";
			} else {
				$auth_representative="Through an authorized representative";
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
			'.$assamSarkarLogo.'
			<h4>'.$form_name.'</h4>
		</div>                      
		<br/>
	  <table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">1. Form of appeal against an order of a '.strtoupper($form_against).'.</td>
			</tr>
			<tr>
				<td width="50%" valign="top">2. Name and address of the appellant.</td>
				<td>
					<table class="table table-bordered table-responsive">
						<tr>
							<td>Full Name </td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
						<tr>
							<td>Street Name 1 </td>
							<td>'.strtoupper($street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2 </td>
							<td>'.strtoupper($street_name2).'</td>
						</tr>
						<tr>
							<td>Vilage/Town </td>
							<td>'.strtoupper($vill).'</td>
						</tr>
						<tr>
							<td>District </td>
							<td>'.strtoupper($dist).'</td>
						</tr>
						<tr>
							<td>Pincode </td>
							<td>'.strtoupper($pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No. </td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>E-Mail ID </td>
							<td>'.$email.'</td>
						</tr>
					</table>
				</td>
			</tr>
			   <tr>
				<td valign="top" >3. No. and date of order of '.strtoupper($form_against).' against which the appeal is preferred</td>
				<td>
				<table class="table table-bordered table-responsive">
					<tr>
						<td>Number </td>
						<td>'.strtoupper($order_num).'</td>
					</tr>
					<tr>
						<td>Date </td>
						<td>'.strtoupper($order_date).'</td>
					</tr>
				</table>
				</td>
			</tr>
			 <tr>
				<td  valign="top">4. Whether the appellant desires to be heard in person or through an authorized representative: </td>
				<td>'.strtoupper($auth_representative).'</td>
			</tr>
			 <tr>
				<td  valign="top">5. Grounds of appeal:</td>
				<td>'.strtoupper($ground_appeal).'</td>
			</tr>';
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'   
			
			<tr>
				<td width="50%">Place : '.strtoupper($dist).' <br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="right">'.strtoupper($key_person).'<br/>Signature of the Appellant</td>
			</tr>
	</table>';
?>