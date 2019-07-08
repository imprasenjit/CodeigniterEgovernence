<?php
$dept="boiler";
$form="7";
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
		$esta_yr=$results['esta_yr'];$jobs_typ=$results['jobs_typ'];$is_firm_approved=$results['is_firm_approved'];$firm_app_det=$results['firm_app_det'];$is_recogn_req=$results['is_recogn_req'];$firm_app_details=$results['firm_app_details'];$is_rec_gener=$results['is_rec_gener'];	$working_sites=$results['working_sites'];$is_firm_pre_execute=$results['is_firm_pre_execute'];$is_firm_pre_accept=$results['is_firm_pre_accept'];$is_firm_supply_mat=$results['is_firm_supply_mat'];$is_firm_internal=$results['is_firm_internal'];$firm_int_qua_det=$results['firm_int_qua_det'];$classification_applied=$results['classification_applied'];
		
		if($classification_applied=='SC') $classification_applied="Special Class ( For any Boiler Pressure)";
		else if($classification_applied=='C1') $classification_applied="Class I (For Boiler Pressure upto 125 kg.cm2)";
		else if($classification_applied=='C2') $classification_applied="Class II (For Boiler Pressure upto 40 kg./cm2)";
		else if($classification_applied=='C3') $classification_applied="Class III (For Boiler Pressure upto 17.5 kg/cm2)";
		else $classification_applied="";
				
		$is_firm_approved=($is_firm_approved=="Y")?'YES':'NO';
		$is_recogn_req=($is_recogn_req=="Y")?'YES':'NO';
		$is_rec_gener=($is_rec_gener=="Y")?'YES':'NO';
		$is_firm_pre_execute=($is_firm_pre_execute=="Y")?'YES':'NO';
		$is_firm_pre_accept=($is_firm_pre_accept=="Y")?'YES':'NO';
		$is_firm_supply_mat=($is_firm_supply_mat=="Y")?'YES':'NO';
		$is_firm_internal=($is_firm_internal=="Y")?'YES':'NO';
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
            <td colspan="2">
                1.(a) Registered name of the firm and its permanent address
			</td>
		</tr>
		<tr>
			<td width="50%">Name of the firm  :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
	    <tr>
			<td> &nbsp;&nbsp;&nbsp;Permanent Address of the firm :</td>
			<td>
			    <table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
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
						<td>Pin Code </td>
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
			<td> &nbsp;&nbsp;&nbsp; Address of the workshop :</td>
			<td>
			    <table class="table table-bordered table-responsive">
					<tr>
						<td>Street name 1 </td>
						<td>'.strtoupper($b_street_name1).'</td>
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
						<td>Pin Code </td>
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
				<td>2. Year of establishment :</td>
				<td>'.strtoupper($esta_yr).'</td>
		</tr>
   
		<tr>
				<td>3. Classification applied for :</td>
				<td>'.strtoupper($classification_applied).'</td>
		</tr>
		<tr>
				<td>4. Type of jobs executed by the firm earlier, with special reference to their maximum working pressure,temperature and the materials involved, with documentary evidence :</td>
				<td>'.strtoupper($jobs_typ).'</td>
		</tr> 
		<tr>
				<td>5.(a) Whether the firm has ever been approved by any Boiler Directorate/Inspectorate?</td>
				<td>'.strtoupper($is_firm_approved).'</td>
		</tr>
		<tr>
				<td>If so, give details :</td>
				<td>'.strtoupper($firm_app_det).'</td>
		</tr>
		
		<tr>
				<td>(b) Has your request for recognition as a repairer under Indian Boiler Regulations, 1950 been rejected by any Authority?</td>
				<td>'.strtoupper($is_recogn_req).'</td>
		</tr>
		<tr>
				<td>If so, please give details :</td>
				<td>'.strtoupper($firm_app_details).'</td>
		</tr>
		<tr>
				<td>6. Whether having rectifier/generator, grinder, general tools and tackles, dye penetrant kit, expander and measuring instruments or any other tools and tackles under regulation 392(5)(i).?</td>
				<td>'.strtoupper($is_rec_gener).'</td>
		</tr>
		
		<tr>
				      <td colspan="2">7. Detailed list of technical personnel with designation, educational qualifications and relevant experience (attach copies of documents) who are permanently employed with the firm. :</td>
		</tr>
				<tr>
					<td colspan="2">
						<table class="table table-bordered table-responsive">		
							<thead>
							<tr>												
								<td>Sl No.</td>
								<td>Name</td>
								<td>Designation</td>
								<td>Qualification</td>
								<td>Experience</td>
							</tr>
							</thead>';					
								$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["slno"]).'</td>
									<td>'.strtoupper($row_1["name"]).'</td>
									<td>'.strtoupper($row_1["designation"]).'</td>
									<td>'.strtoupper($row_1["qualification"]).'</td>
									<td>'.strtoupper($row_1["experience"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>
		
		<tr>
				<td>8. How many working sites can be handled by the firm simultaneously?</td>
				<td>'.strtoupper($working_sites).'</td>
		</tr>
		<tr>
				<td>9. Whether the firm is prepared to execute the job strictly in conformity with the regulations and maintain a high standard of work ?</td>
				<td>'.strtoupper($is_firm_pre_execute).'</td>
		</tr>
		<tr>
				<td>10. Whether the firm is prepared to accept full responsibility for the work done and is prepared to clarify any controversial issue, if required ?</td>
				<td>'.strtoupper($is_firm_pre_accept).'</td>
		</tr>
		<tr>
				<td>11. Whether the firm is in a position to supply materials to required specification with proper test certificates if asked for ?</td>
				<td>'.strtoupper($is_firm_supply_mat).'</td>
		</tr>
		<tr>
				<td>12. Whether the firm has an internal quality control system of their own ? </td>
				<td>'.strtoupper($is_firm_internal).'</td>
		</tr>
		<tr>
				<td>If so, give details :</td>
				<td>'.strtoupper($firm_int_qua_det).'</td>
		</tr>
		<tr>
				      <td colspan="2">13. List of welders employed with copies of current certificate issued by a Competent Authority under the Indian Boiler Regulations, 1950. :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<td>Sl No.</td>
						<td>Name</td>
						<td>Name</td>
						
					</tr>
					</thead>';					
						$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
						while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name2"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
			
		<tr>
			<td rowspan="2">Date : '.date("d-m-Y",strtotime($results["sub_date"])).'
			
			</td>
			<td align="right">Authorised Signatory : '.strtoupper($key_person).'</td>
		</tr>
	</table>
';
?>