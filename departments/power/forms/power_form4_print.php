<?php
$dept="power";
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
		$form_id=$results["form_id"];
		$applicant_name=$results["applicant_name"];$organization_name=$results["organization_name"];
		$category_tariff=$results["category_tariff"];$voltage_supply=$results["voltage_supply"];$total_load=$results["total_load"];$is_capacity=$results["is_capacity"];$capacity_details=$results["capacity_details"];$is_industry=$results["is_industry"];$industry_details=$results["industry_details"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$is_director=$results["is_director"];$details_director=$results["details_director"];
		
		if(!empty($results["consumer"])){
			$consumer=json_decode($results["consumer"]);
			$consumer_num=$consumer->num;$consumer_name=$consumer->name;
		}else{
			$consumer_num="";$consumer_name="";
		}
		
		 
			if(!empty($results["existing"])){
				$existing=json_decode($results["existing"]);
				$existing_metno=$existing->metno;$existing_category=$existing->category;
			}else{
				$existing_metno="";$existing_category="";
			}
		
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
		}
		
	 if($is_capacity=="Y"){
	  $is_capacity="YES";
	  }else if($is_capacity=="N"){
		$is_capacity="NO";
	  }else{
		 $is_capacity="";
	  }
		
	  if($is_industry=="Y"){
	  $is_industry="YES";
	  }else if($is_industry=="N"){
		$is_industry="NO";
	  }else{
		 $is_industry="";
	  }
	  
	  if($is_electricity=="Y"){
	  $is_electricity="YES";
	  }else if($is_electricity=="N"){
		$is_electricity="NO";
	  }else{
		 $is_electricity="";
	  }
		
	   if($is_connection=="Y"){
	  $is_connection="YES";
	  }else if($is_connection=="N"){
		$is_connection="NO";
	  }else{
		 $is_connection="";
	  }
      
	   if($is_director=="Y"){
	  $is_director="YES";
	  }else if($is_director=="N"){
		$is_director="NO";
	  }else{
		 $is_director="";
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
			table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}
		</style>
	</head>
	<body>';        
}else{
    $printContents='';
}
if(!empty($results["uain"])){
	$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
}
$printContents=$printContents.'
<div style="text-align:center"><br/><br/>
	'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
</div><br/>
	<table class="table table-bordered table-responsive">
	     <tr>
			<td colspan="2">Sir<br/>&nbsp;&nbsp;I / We, request you to kindly allow the changes requested against my / our premises as given  above. The requisite information is furnished below</td>
		</tr>
        <tr>
			<td width="50%">1. Name of Applicant:</td>
			<td>'.strtoupper($applicant_name).'</td>
		</tr>
		<tr>
			<td>2.Name of Father / Husband / Organisation (with designation):</td>
			<td>'.strtoupper($organization_name).'</td>
		</tr>
		<tr>
		   <td colspan="2">3.Full Address of the Premises where the connection has been installed</td>
		</tr>
		<tr>
			<td>House No. /Plot No:</td>
			<td>'.strtoupper($b_street_name1).'</td>
		</tr>
		<tr>
			<td>Road:</td>
			<td>'.strtoupper($b_street_name2).'</td>
		</tr>
		<tr>
			<td>Town/Village :</td>
			<td>'.strtoupper($b_vill).'</td>
		</tr>
		<tr>
			<td>District :</td>
			<td>'.strtoupper($b_dist).'</td>
		</tr>
        <tr>
			<td>Pin :</td>
			<td>'.strtoupper($b_pincode).'</td>
		</tr>
		<tr>
			<td>Mobile No. :</td>
			<td>'.strtoupper($b_mobile_no).'</td>
		</tr>
        <tr>
		   <td>4. Address of the premises where service connection is applied for </td>
		  <td>
    	   <table class="table table-bordered table-responsive">
				<tr>
					<td>House No/ Plot No. </td>
					<td>'.strtoupper($b_street_name1).'</td>
				</tr>
				<tr>
					<td>Road </td>
					<td>'.strtoupper($b_street_name2).'</td>
				</tr>
			   <tr>
					<td>Town/Village </td>
					<td>'.strtoupper($b_vill).'</td>
				</tr>
				<tr>
					<td>District </td>
					<td>'.strtoupper($b_dist).'</td>
				</tr>
				<tr>
					<td> Pin Code </td>
					<td>'.strtoupper($b_pincode).'</td>
				</tr>
				<tr>
					<td>Mobile No. </td>
					<td>'.strtoupper($b_mobile_no).'</td>
				</tr>
				<tr>
					<td>Email </td>
					<td>'.$b_email.'</td>
				</tr>
			  </table>
		    </td>
		  </tr>
		  <tr>
		    <td>Consumer Number :</td>
			<td>'.strtoupper($consumer_num).'</td>
		</tr>
		<tr>
			<td>Consumer Name</td>
			<td>'.strtoupper($consumer_name).'</td> 
		</tr>
		<tr>
		  <td colspan="2">5. Existing Meter Number & Category of the consumer</td>
		</tr>
		<tr>
			<td>Existing Meter Number</td>
			<td>'.strtoupper($existing_metno).'</td>
		</tr>
		<tr>
			<td>Existing Category</td>
			<td>'.strtoupper($existing_category).'</td>
		</tr>
		<tr>
			<td>6. Voltage at which supply is required (KV):</td>
			<td>'.strtoupper($voltage_supply).'</td> 
		</tr>
		<tr>
			<td>7. Total Connected Load/ Additional Load required (In Kilo-Watts):</td>
			<td>'.strtoupper($total_load).'</td>
		</tr>
		<tr>
			<td colspan="2">8.Phasing of Contract Demand:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>
						<th>Slno</th>
						<th>CD Required (KVA)</th>
						<th>Tentative Date from which required</th>
						<th>Remarks</th>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["cd_reqd"]).'</td>
							<td>'.$row_1["tentative_dt"].'</td>
							<td>'.strtoupper($row_1["remarks"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
        <tr>
			<td>9. Category of tariff opted for </td>
			 <td>'.strtoupper($category_tariff).'</td> 
		 </tr>
		<tr>
		    <td>10. Production Capacity (If applicable)</td>
            <td>'.strtoupper($is_capacity).'  &nbsp;&nbsp;&nbsp; '.strtoupper($capacity_details).'</td>
        </tr>
        <tr>
            <td>11. Category of Industry (If applicable)</td>
            <td>'.strtoupper($is_industry).' &nbsp;&nbsp;&nbsp;  '.strtoupper($industry_details).'</td>
		</tr>
        <tr>
			 <td>12. Any Electricity dues outstanding in APDCLs area of operation in the Consumers name</td>
			 <td>'.strtoupper($is_electricity).' &nbsp;&nbsp;&nbsp;  '.strtoupper($details_electricity).'</td>
		</tr>
        <tr>
		    <td>13. Any Electricity dues outstanding for the premises for which connection applied for </td>
			 <td>'.strtoupper($is_connection).' &nbsp;&nbsp;&nbsp;  '.strtoupper($details_connection).'</td>
		</tr
		<tr>
		     <td>14. Any Electricity dues outstanding with the Licensee against any firm with which the consumer is  associated with any firm as an owner, Partner, Director or Managing Director</td>
			 <td>'.strtoupper($is_director).' &nbsp;&nbsp;&nbsp;  '.strtoupper($details_director).'</td>
		</tr>  
		
		<tr>
		   <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;I/ We hereby declare that The information provided in the form above is true to my knowledge.
		  I / We have read the Assam Electricity Supply Code and agree to abide by the conditions mentioned therein.
		I / We will deposit electricity dues, every month, as per the applicable electricity tariff and other charges.I / We will own the responsibility of security and safety of the meter, cut-out and the installation  thereafter.</td>
		</tr>
		';
		
			
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.'
		
	
			<tr>
				<td>Date  : &nbsp; '.date("d-m-Y",strtotime($results["sub_date"])).'</td>
				<td align="right">Signature of the consumer / authorised signatory : &nbsp; '.strtoupper($key_person).'</td>				
			</tr>	
			
    </tbody>
</table>';
?>