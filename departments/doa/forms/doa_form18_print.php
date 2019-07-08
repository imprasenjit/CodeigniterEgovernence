<?php
 $dept="doa";
 $form="18";
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
			$is_application=$results["is_application"];
			$name_of_training=$results["name_of_training"];$duration_of_training=$results["duration_of_training"];$training_certificate=$results["training_certificate"];
			$registered_address=$results["registered_address"];$zonal_address=$results["zonal_address"];$branch_ofc_address=$results["branch_ofc_address"];$premises_address=$results["premises_address"];
			$is_approval=$results["is_approval"];$is_approval_details=$results["is_approval_details"];$is_approval_details1=$results["is_approval_details1"];$is_approval_details2=$results["is_approval_details2"];
			$name_of_insecticide=$results["name_of_insecticide"];$name_of_res_technical=$results["name_of_res_technical"];
			$is_qty=$results["is_qty"];$is_qty_details=$results["is_qty_details"];$is_qty_details1=$results["is_qty_details1"];
				if(!empty($results["details"])){
					$details=json_decode($results["details"]);
					$details_safety_equipment=$details->safety_equipment;$details_antidotes=$details->antidotes;$details_other_facilities=$details->other_facilities;
				}else{				
					$details_safety_equipment="";$details_antidotes="";$details_other_facilities="";
				}	
			
			$insecticide_stored_add=$results["insecticide_stored_add"];$insecticide_sold_add=$results["insecticide_sold_add"];$is_residential_area=$results["is_residential_area"];$is_premises=$results["is_premises"];$licence_number=$results["licence_number"];$date_of_grant=$results["date_of_grant"];


			
	    if($is_application=="S") $is_application="Grant/renewal of licence to sell/stock/exhibit for sale/distribution of insecticides";
		else if ($is_application="C") $is_application="Grant/renewal of licence for commercial pest control operations";
		else $is_application="Both(Grant/renewal of licence to sell/stock/exhibit for sale/distribution of insecticides /commercial pest control operations)";
		
		if($is_approval=="Y") $is_approval="YES";
		else $is_approval="NO";
		if($is_qty=="Y") $is_qty="YES";
		else $is_qty="NO";
		if($is_residential_area=="Y") $is_residential_area="YES";
		else $is_residential_area="NO";
		if($is_premises=="Y") $is_premises="YES";
		else $is_premises="NO";
		
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
				<td colspan="2">To<br/>
					The Licencing Authority ,<br/><br/>
				</td>
			</tr>
			<tr>
				<td colspan="2">1. Name, address and e-mail address of the applicant</td>
			</tr>
			
			<tr>
				<td>Name of the applicant :</td>
				<td>'.strtoupper($key_person).'</td>
			</tr>
			<tr> 
				<td width="50%">Address of the applicant :</td>
				<td><table class="table table-bordered table-responsive">
					<tr>
						<td>Street Name 1 : </td>
						<td>'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td>Street Name 2 : </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td>Village/Town : </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td>District : </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td>Pincode : </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td>Mobile No. : </td>
						<td>'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td>E-mail id : </td>
						<td>'.$email.'</td>
					</tr>
				</table></td>
			</tr>	
		
		<tr>
            <td>2. Whether the application is for ?</td>
			<td>'.strtoupper($is_application).'</td>
		</tr>
		<tr>
			<td colspan="2">3. Qualification of the applicant/ the technical personnel under employment of the applicant (minimum qualification shall be a graduate with degree in Agriculture or Science with Chemistry / Zoology / Botany / Biotechnology / Life Sciences.)</td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th align="center">Slno</th>
				<th align="center">Name</th>
				<th align="center">Qualification</th>
			</tr>';
			
			$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["name"]).'</td>
						<td>'.strtoupper($row_1["qualification"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> 
			</td>
		</tr>
		<tr> 
			<td width="50%">4. Training</td>
				<td width="50%"><table class="table table-bordered table-responsive">
					<tr>
						<td>(a) Name of the training/course : </td>
						<td>'.strtoupper($name_of_training).'</td>
					</tr>
					<tr>
						<td>(b) Duration of training course : </td>
						<td>'.strtoupper($duration_of_training).'</td>
					</tr>
					<tr>
						<td>(c) Certificate awarded, if any: </td>
						<td>'.strtoupper($training_certificate).'</td>
					</tr>
				</table></td>
		</tr>	
		<tr>
			<td colspan="2">5. In case of application for commercial pest control operations</td>
		</tr>
		<tr> 
			<td width="50%">(a) Address of registered, zonal and branch offices</td>
				<td width="50%"><table class="table table-bordered table-responsive">
						<tr>
							<td>Registered address</td>
							<td>'.strtoupper($registered_address).'</td>
						</tr>
						<tr>
							<td>Zonal address</td>
							<td>'.strtoupper($zonal_address).'</td>
						</tr>
						<tr>
							<td>Branch office address</td>
							<td>'.strtoupper($branch_ofc_address).'</td>
						</tr>
				</table></td>
		</tr>	
		
		
		<tr>
            <td>(b) Address of the premises for which the license is applied for</td>
			<td>'.strtoupper($premises_address).'</td>
		</tr>
		<tr>
            <td>(c) whether approval of technical expertise obtained ,(d)If yes, state reference number of approval, its date and validity </td>
			<td>'.strtoupper($is_approval).' &nbsp;&nbsp; '.strtoupper($is_approval_details).'  &nbsp;&nbsp; '.strtoupper($is_approval_details1).'  &nbsp;&nbsp; '.strtoupper($is_approval_details2).' </td>
		</tr>
		<tr>
            <td>(e)Name of restricted insecticides for which approved</td>
			<td>'.strtoupper($name_of_insecticide).'</td>
		</tr>
		<tr>
            <td>(f)Name of the responsible technical person</td>
			<td>'.strtoupper($name_of_res_technical).'</td>
		</tr>
		<tr>
            <td>(g)Whether any quantity of restricted insecticide in possession as on date of application, (h)If yes, particulars and respective quantity of each in possession </td>
			<td>'.strtoupper($is_qty).'&nbsp;&nbsp; '.strtoupper($is_qty_details).'  &nbsp;&nbsp; '.strtoupper($is_qty_details1).'</td>
		</tr>
		<tr>
			<td>(i) Details of safety equipment, antidotes and all other essential facilities</td>
			<td><table class="table table-bordered table-responsive">
					
					<tr>
						<td>Safety Equipment : </td>
						<td>'.strtoupper($details_safety_equipment).'</td>
					</tr>
					<tr>
						<td>Antidotes : </td>
						<td>'.strtoupper($details_antidotes).'</td>
					</tr>
					<tr>
						<td>Other Essential Facilities : </td>
						<td>'.strtoupper($details_other_facilities).'</td>
					</tr>
				</table>
			</td>
		</tr>	
		<tr>
			<td colspan="2">6. Name of the insecticide(s) and its/their manufacturer/importer which the applicant intends to deal in and status of the principal(s) certificate </td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th  align="center">Sl No.</th>
				<th  align="center">Particulars of insecticide</th>
				<th  align="center">Name of the manufacturer</th>
				<th  align="center">Registration number</th>
				<th  align="center">Detailed principal certificate number./date of issue/validity</th>
			</tr>';
			
			$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
				while($row_2=$part2->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["parti_insecticide"]).'</td>
						<td>'.strtoupper($row_2["name"]).'</td>
						<td>'.strtoupper($row_2["registration_no"]).'</td>
						<td>'.strtoupper($row_2["principal_cert"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> 
			</td>
		</tr>
		<tr>
            <td colspan="2">7. Complete address of the premises, where the insecticide(s) shall be</td>
		</tr>
		<tr>
            <td>(a) stored/stocked :</td>
			<td>'.strtoupper($insecticide_stored_add).'</td>
		</tr>
		<tr>
            <td>(b) sold or exhibited for sale or issued for use in case of commercial pest control operations :</td>
			<td>'.strtoupper($insecticide_sold_add).'</td>
		</tr>
		<tr>
            <td>(c) whether any of the above premises is situated in residential area :</td>
			<td>'.strtoupper($is_residential_area).'</td>
		</tr>
		<tr>
            <td>(d) whether food articles are also stored in any of the above premises :</td>
			<td>'.strtoupper($is_premises).'</td>
		</tr>
		<tr>
			<td colspan="2">8. Full particulars of licence(s), if issued in the name of the applicant by any other state in the area of their jurisdiction </td>
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">
			<tr align="center" >
				<th  align="center">Slno</th>
				<th  align="center">Particulars of licenses</th>
				<th  align="center">State Governments</th>
			</tr>';
			
			$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
				while($row_3=$part3->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_3["slno"]).'</td>
						<td>'.strtoupper($row_3["parti_licenses"]).'</td>
						<td>'.strtoupper($row_3["st_government"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> 
			</td>
		</tr>
		<tr>
			<td colspan="2">9. In case of renewal, please state licence number and date of grant</td>
		</tr>
		<tr>
            <td>Licence number :</td>
			<td>'.$licence_number.'</td>
		</tr>
		<tr>
            <td>Date of grant :</td>
			<td>'.$date_of_grant.'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'	
	
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td align="right">Signature of Applicant <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>  