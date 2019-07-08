<?php
$dept="power";
$form="1";
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
		$uain=$results["uain"];
		$required_power=$results["required_power"];
		$service_requested=$results["service_requested"];
		
		if($service_requested=="P"){
			$service_requested="New Connection(Permanent)";
		}else{
			$service_requested="New Connection(Temporary)";
		}
			
		$consumer_category=$results["consumer_category"];
		$exist_con_no=$results["exist_con_no"];
		$esd=$formFunctions->getApdclEsd($exist_con_no);
		$request_load=$results["request_load"];
		$mouza_no=$results["mouza_no"];$dag_no=$results["dag_no"];
		
		if(!empty($results["billing"])){
			$billing=json_decode($results["billing"]);
			if(isset($billing->sn1))  $billing_sn1=$billing->sn1; else $billing_sn1="";
			if(isset($billing->sn2))  $billing_sn2=$billing->sn2; else $billing_sn2="";
			if(isset($billing->town))  $billing_town=$billing->town; else $billing_town="";
			if(isset($billing->d))  $billing_d=$billing->d; else $billing_d="";
			if(isset($billing->pin))  $billing_pin=$billing->pin; else $billing_pin="";
			if(isset($billing->mobile))  $billing_mobile=$billing->mobile; else $billing_mobile="";
		}else{
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
		}
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
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
	';		
	}else{
		$printContents='';
	}
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right;padding:10px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
	$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/>
	<table class="table table-bordered table-responsive">
		<tr>
            <th colspan="4" style="text-align:left;height:40px">General Information</th>
        </tr>
		<tbody>
        <tr>
            <td colspan="2">Required Power (in KW) :</td>
            <td colspan="2">'.strtoupper($required_power).' KW</td>
        </tr>
        <tr>
            <td width="25%">Consumer Category :</td>
            <td width="25%">'.strtoupper($consumer_category).'</td>
            <td width="25%">Service Requested :</td>
            <td width="25%">'.strtoupper($service_requested).'</td>
        </tr>
        <tr>
            <td>Company Name :</td>
            <td>'.strtoupper($unit_name).'</td>
            <td>Name of the Applicant :</td>
            <td>'.strtoupper($key_person).'</td>
        </tr>
        <tr>
           <th colspan="4" style="text-align:left;height:40px">Address of the Applicant</th>
        </tr>
        <tr>
            <td>House No/ Plot No. :</td>
            <td>'.strtoupper($street_name1).'</td>
            <td>Road :</td>
            <td>'.strtoupper($street_name2).'</td>
        </tr>
        <tr>
            <td> Town/Village:</td>
            <td>'.strtoupper($vill).'</td>
            <td>District: </td>
            <td>'.strtoupper($dist).'</td>
        </tr>
        <tr>
            <td>Pincode :</td>
            <td>'.strtoupper($pincode).'</td>
            <td>Mobile No. :</td>
            <td>'.strtoupper($mobile_no).'</td>
        </tr>
        <tr>
            <th colspan="4" style="text-align:left;height:40px">Address of the enterprise at which supply is required </th>
        </tr>
        <tr>
            <td>House No/ Plot No. :</td>
            <td>'.strtoupper($b_street_name1).'</td>
            <td>Road :</td>
            <td>'.strtoupper($b_street_name2).'</td>
        </tr>
        <tr>
            <td> Town/Village:</td>
            <td>'.strtoupper($b_vill).'</td>
            <td>District: </td>
            <td>'.strtoupper($b_dist).'</td>
        </tr>
        <tr>
            <td >Pincode :</td>
            <td>'.strtoupper($b_pincode).'</td>
            <td>Mobile No. :</td>
            <td>'.strtoupper($b_mobile_no).'</td>
        </tr>
        <tr>
            <td> Existing/ Nearest Consumer Number :</td>
            <td>'.strtoupper($exist_con_no).'</td>
            <td>Electrical Sub Division</td>
            <td>'.strtoupper($esd).'</td>
        </tr>  
        <tr>
            <th colspan="4" style="text-align:left;height:40px">Billing Details</th>
        </tr>
   
        <tr>
            <td>Street name 1 : </td>
            <td>'.strtoupper($billing_sn1).'</td>
            <td>Street name 2 : </td>
            <td>'.strtoupper($billing_sn2).'</td>
        </tr>
        <tr>
            <td style=""> Town/Village :</td>
            <td>'.strtoupper($billing_town).'</td>
            <td style=""> District :</td>
            <td>'.strtoupper($billing_d).'</td>
        </tr>
        <tr>
            <td >Pincode :</td>
            <td>'.strtoupper($billing_pin).'</td>
            <td >Mobile No. :</td>
            <td>'.strtoupper($billing_mobile).'</td>
        </tr> 
		          
        <tr>
            <td style="">Type of Premises :</td>
            <td>'.strtoupper($land_type).'</td>
            <td></td>
            <td></td>
        </tr>
		<tr>
            <td>Mouza No. :</td>
            <td>'.strtoupper($mouza_no).'</td>
            <td> Dag No. :</td>
            <td>'.strtoupper($dag_no).'</td>
        </tr>		
		<tr>
			<td colspan="4">
			<table class="table table-bordered table-responsive">
			';
				$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
				$printContents=$printContents.'
			</table>
			</td>
		</tr> 
        <tr>
			<td colspan="2">Signatures and Dates:</td>
			<td colspan="2"><table width="100%">
				<tr>
					<td align="right">Signature of Applicant : &nbsp; '.strtoupper($key_person).'<br/></td>				
				</tr>	
				<tr>
					<td width="50%" align="right">Date : '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
				</tr>
				</table>
			</td>
		</tr>
    </tbody>
</table>';
?>