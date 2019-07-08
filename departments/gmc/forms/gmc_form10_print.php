<?php
$dept="gmc";
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
	
	
		
		
	if($q->num_rows > 0){
        $results=$q->fetch_array();		
		$form_id=$results["form_id"];$purpose_name=$results["purpose_name"];$reference_no=$results["reference_no"];$submitted_date=$results["submitted_date"];$received_dt=$results["received_dt"];$to_the=$results["to_the"];
			
	   if(!empty($results["developer"])){
			$developer=json_decode($results["developer"]);
			$developer_name=$developer->name;$developer_streetname1=$developer->streetname1;$developer_streetname2=$developer->streetname2;$developer_vill=$developer->vill;$developer_dist=$developer->dist;$developer_block=$developer->block;$developer_pin=$developer->pin;$developer_mobileno=$developer->mobileno;$developer_sign=$developer->sign;	
		}else{				
			$developer_name="";$developer_streetname1="";$developer_streetname2="";$developer_vill="";$developer_dist="";$developer_block="";$developer_pin="";$developer_mobileno="";$developer_sign="";
		}
		
		if(!empty($results["owner1"])){
			$owner1=json_decode($results["owner1"]);
			$owner1_name=$owner1->name;$owner1_streetname1=$owner1->streetname1;$owner1_streetname2=$owner1->streetname2;$owner1_vill=$owner1->vill;$owner1_dist=$owner1->dist;$owner1_block=$owner1->block;$owner1_pin=$owner1->pin;$owner1_mobileno=$owner1->mobileno;$owner1_sign=$owner1->sign;	
		}else{				
			$owner1_name="";$owner1_streetname1="";$owner1_streetname2="";$owner1_vill="";$owner1_dist="";$owner1_block="";$owner1_pin="";$owner1_mobileno="";$owner1_sign="";
		}
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName($dept,$form);
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h2 align="center">'.$assamSarkarLogo.'<br/>Application for issue of Trade License (General)</h2>
		<br/>
		<table class="table table-bordered table-responsive">
		<tbody>			
			    <tr>
					<td colspan="2">To,</td>
				</tr>
				<tr>
				   <td colspan="2">'.strtoupper($to_the).'</td>
				</tr>
				<tr>
					<td>Reference No</td>
					<td>'.strtoupper($reference_no).'</td>
				</tr>
				<tr>
					<td>Submitted on</td>
					<td>'.strtoupper($submitted_date).'</td>
				</tr>
				<tr>
					<td>Received on</td>
					<td>'.strtoupper($received_dt).'</td>
				</tr>
				<tr>
					<td colspan="2">The work of erection/re-erection of building as per approved plan is completed under the Supervision of Architect/Construction Engineer who have given the completion certificate which is enclosed herewith.</td>
				</tr>
				
				<tr>
					<td colspan="2">&nbsp;&nbsp;We declare that the work is executed as per the provisions of the Act and Development Control Regulations / Byelaws and to our satisfaction. We declare that the construction is to be used for&nbsp;&nbsp;'.strtoupper($purpose_name).'&nbsp;&nbsp;the purpose as per approved plan and it shall not be changed without obtaining written permission.</td>
				</tr>
				<tr>
					<td colspan="2">&nbsp;&nbsp;We hereby declare that the plan as per the building erected has been submitted andapproved. We have transferred the area of parking space provided as per approved plan to an individual/association before for occupancy certificate.</td>
				</tr>
				<tr>
					<td colspan="2">Any subsequent change from the completion drawings will be our responsibility.</td>
				</tr>
				<tr>
					<td valign="top"> Address and Name of Developer / Builder  : </td>
					<td>
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td width="50%">Name of Developer / Builder</td>
									<td>'.strtoupper($developer_name).'</td>
								</tr>
								<tr>
									<td>Street name 1 </td>
									<td>'.strtoupper($developer_streetname1).'</td>
								</tr>
								<tr>
									<td>Street name 2 </td>
								   
									<td>'.strtoupper($developer_streetname2).'</td>
								</tr>
								<tr>
									<td>Town/Vill </td>
									
									<td>'.strtoupper($developer_vill).'</td>
								</tr>
								<tr>
									<td>District </td>
									
									<td>'.strtoupper($developer_dist).'</td>
								</tr>
								<tr>
									<td>State </td>
									
									<td>'.strtoupper($developer_block).'</td>
								</tr>
								<tr>
									<td>Pin Code </td>
									
									<td>'.strtoupper($developer_pin).'</td>
								</tr>
							</tbody>
						</table>
				 </td>
				</tr>
				<tr>
					<td valign="top"> Address and Name of Owner  : </td>
					<td>
						<table class="table table-bordered table-responsive">
							<tbody>
								<tr>
									<td width="50%">Name of Owner</td>
									<td>'.strtoupper($owner1_name).'</td>
								</tr>
								<tr>
									<td>Street name 1 </td>
									<td>'.strtoupper($owner1_streetname1).'</td>
								</tr>
								<tr>
									<td>Street name 2 </td>
								   
									<td>'.strtoupper($owner1_streetname2).'</td>
								</tr>
								<tr>
									<td>Town/Vill </td>
									
									<td>'.strtoupper($owner1_vill).'</td>
								</tr>
								<tr>
									<td>District </td>
									
									<td>'.strtoupper($owner1_dist).'</td>
								</tr>
								<tr>
									<td>State </td>
									
									<td>'.strtoupper($owner1_block).'</td>
								</tr>
								<tr>
									<td>Pin Code </td>
									
									<td>'.strtoupper($owner1_pin).'</td>
								</tr>
							</tbody>
						</table>
				    </td>
				</tr>
				';
		   
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
				
					  <tr>
							<td>Developers / Builder&apos;s Signature<br/>'.strtoupper($developer_sign).'</td>
							<td align="right">Owner&apos;s Signature<br/>'.strtoupper($owner1_sign).'</td>
							
						</tr>
						<tr>
							<td>Date<br/>'.date('d-m-Y',strtotime($results["sub_date"])).'</td>
						</tr>
											
					</tbody>
				
	</table>';
?>