<?php
$dept="boiler";
$form="5";
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

	if($q->num_rows>0) {		
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
		$is_copy_report=$results["is_copy_report"];$is_firm=$results["is_firm"];
		$is_firm_prepared=$results["is_firm_prepared"];$is_internal_quality=$results["is_internal_quality"];$numeric_power_stn=$results["numeric_power_stn"];$is_conservant=$results["is_conservant"];$is_instruments=$results["is_instruments"];$testing=$results["testing"];$is_recording=$results["is_recording"];$is_internal_quality_details=$results["is_internal_quality_details"];
		
		if(!empty($results["class_applied"])){
			$class_applied=json_decode($results["class_applied"]);
			$class_applied_a=$class_applied->a;
		}else{
			$class_applied_a="";
		}
		
		if($class_applied_a=="L"){
			$class_applied_a="Class –III : Less than boiler pressure 17.5 Kg/cm2.";
		}else if($class_applied_a=="A"){
		   $class_applied_a="Class –II : Above boiler pressure 17.5 Kg/cm2, but less than 40 Kg/ cm2.";
	    }else if($class_applied_a=="AB"){
			$class_applied_a="Class - I : Above boiler pressure 40 Kg/ Cm2, but less than 100 Kg/ cm2.";
	    }else if($class_applied_a=="P"){
			$class_applied_a="Special Class : Above boiler pressure 100 Kg/ cm2.";
		}else{
			$class_applied_a="";
		}
		$is_copy_report=($is_copy_report=="Y")?'YES':'NO';
		
		$is_firm=($is_firm=="Y")?'YES':'NO';
		$is_firm_prepared=($is_firm_prepared=="Y")?'YES':'NO';
		$is_internal_quality=($is_internal_quality=="Y")?'YES':'NO';
		$is_conservant=($is_conservant=="Y")?'YES':'NO';
		$is_instruments=($is_instruments=="Y")?'YES':'NO'; 
		$is_recording=($is_recording=="Y")?'YES':'NO'; 
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
			<td width="50%">1.Name of the Firm :</td>
			<td>'.strtoupper($unit_name).'</td>
		</tr>
		<tr>
			<td width="50%">2. Address of the workshop : :</td>
			<td>
			<table class="table table-bordered table-responsive">
				
				<tr>
					<td>Street name 1 :</td>
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
					<td>Pin Code :</td>
					<td>'.strtoupper($pincode).'</td>
				</tr>
				
				
			</table>
			</td>
		</tr>
		<tr>
				<td>3. Address for communication  :</td>
				<td>
				 <table class="table table-bordered table-responsive">
					
					<tr>
						<td>Street name 1 :</td>
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
						<td>Pin Code :</td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					
				</table>
				</td>
		</tr>				
		<tr>
			<td>4.(i) Type of jobs executed by the firm earlier,with special reference to their maximum working pressure,temperature and the materials involved with the documentary evidence :</td>
			<td>Uploaded in Upload Section</td>
		</tr>
		<tr>
			<td>4.(ii) Classification applied for : </td>
			<td>'.strtoupper($class_applied_a).'</td>
		</tr>
		<tr>
			<td>5.(i) Whether having rectifier/generator,grinder tools and tackles,dye penetrant kit,expander and measuring instruments or any other tools and tackles NDT facilities,heat treatment etc. :</td>
			<td>'.strtoupper($is_copy_report).'</td>
		</tr>
		<tr>
			<td colspan="2">6. Details list of technical personnel & supervisory staff with qualification and experience :<br/>
				<table class="table table-bordered table-responsive">		
					<thead>
						<tr>												
							<th>Sl No.</th>
							<th>Details of technical personnel</th>
							<th>Details of Supervisory Staff</th>
							<th>Qualification</th>
							<th>Experience</th>
						</tr>
					</thead>';					
					$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
					while($row_1=$part1->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["details_technical"]).'</td>
						<td>'.strtoupper($row_1["details_supervisory"]).'</td>
						<td>'.strtoupper($row_1["qualification"]).'</td>
						<td>'.strtoupper($row_1["experience"]).'</td>
					</tr>';
					}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">7. List of permanent welders with their experience(enclosed welders certificate issued under IBR):<br/>
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
							<th>Sl. No.</th>
							<th>Name of permanent welders</th>
							<th width="25">Experience</th>
					</tr>
					</thead>';					
						$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'") or die($boiler->error);
						while($row_2=$part2->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_2["slno"]).'</td>
							<td>'.strtoupper($row_2["name1"]).'</td>
							<td>'.strtoupper($row_2["experience"]).'</td>
							
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
	   <tr>
			  <td >8.Whether the firm is prepared to execute the job strictly in conformity with the IBR and maintain a high standard of work: </td>
				<td>'.strtoupper($is_firm).'</td> 
		</tr>
		<tr>
			  <td >9.Whether the firm is prepared to accept full responsibilty for the work done and is prepared to clarify any controversial issue,if required?: </td>
				<td>'.strtoupper($is_firm_prepared).'</td> 
		</tr>
		<tr>
			  <td>10.Whether the firm has an internal quality control system of their own?if so,give details</td>
			<td>'.strtoupper($is_internal_quality).'</td> 
		</tr>
		<tr>
			<td> If so, give details  </td>
			<td>'.strtoupper($is_internal_quality_details).'</td>
		</tr>
	   
	  
		<tr>
			  <td>11.Details of power sanction: </td>
				<td>'.strtoupper($numeric_power_stn).'</td> 
		</tr>
		
		<tr>
			  <td>12.Whether the firm is conservant with Boilers Act,1923 and Indian Boiler Regulation,1950 :</td>
				<td>'.strtoupper($is_conservant).'</td> 
		</tr>
		<tr>
			<td>13.Whether the aforesaid instruments are caliberated periodically.If so,give details :</td>
			<td>'.strtoupper($is_instruments).'</td> 
		</tr>
		<tr>
			<td>14.Details of testing facilities available:</td>
			<td>'.strtoupper($testing).'</td> 
		</tr>
		<tr>
			<td>15.Whether the recording system of documents,Data storing,processing etc has been computerized with Internet:</td>
			<td>'.strtoupper($is_recording).'</td> 
		</tr>
		';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.' 
		
		<tr>
			<td>
				Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'
			</td>
            <td align="right">
				<b>'.strtoupper($key_person).'</b><br/>
					Authorised Signatory              
             </td>
        </tr>        
	</table>
	
';
?>