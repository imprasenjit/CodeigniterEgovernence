<?php
$dept="boiler";
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

	if($q->num_rows>0) {		
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
	    $inspector_places=$results["inspector_places"];$is_repairs=$results["is_repairs"];$is_fabricator=$results["is_fabricator"];$testing_fabrication=$results["testing_fabrication"];$job_significant=$results["job_significant"];$class_applied=$results["class_applied"];
		
		if($results["class_applied"]="1"){
			$class_applied = "Class – III : Less than boiler pressure 17.5 Kg/cm2.";
		}elseif($results["class_applied"]="2"){
			$class_applied = "Class – II : Above boiler pressure 17.5 Kg/cm2, but less than 40 Kg/ cm2.";
		}elseif($results["class_applied"]="3"){
			$class_applied = "Class - I : Above boiler pressure 40 Kg/ Cm2, but less than 100 Kg/ cm2.";
		}elseif($results["class_applied"]="4"){
			$class_applied = "Special Class : Above boiler pressure 100 Kg/ cm2.";
		}else{}
	    
		if($results["is_repairs"]=="Y"){
			$is_repairs="YES";
		}else{
			$is_repairs="NO";
		}
		if($results["is_fabricator"]=="Y"){
			$is_fabricator="YES";
		}else{
			$is_fabricator="NO";
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
			<td>1.Name of the repairer :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td>2. Full address of the repairer :</td>
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
				<tr>
					<td>Mobile No :</td>
					<td>'.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
					<td>Email Id :</td>
					<td>'.$email.'</td>
				</tr>
			</table>
			</td>	
		</tr>
		<tr>
			<td>3. Places of visit to be paid by the inspector other than owners premises :</td>
			<td>'.strtoupper($inspector_places).'</td>
		</tr>
		<tr>
			  <td>4. Whether copy of the report on repairs/fabrications/renewals or letter of approval of the drawing steam and feed pipe lines are furnished</td>
			  <td>'.strtoupper($is_repairs).'</td> 
		</tr>
		<tr>
			  <td>5. Whether the repairer prepared to supply materials covered by proper test certificates or to carry out necessary tests if required.</td>
				<td>'.strtoupper($is_fabricator).'</td> 
		</tr>
	
		<tr>
		   <td colspan="2">6. Details of machines,tools and tackles to be used for the particular job.</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<td>Sl No.</td>
						<td>Details of machines</td>
						<td>Tools</td>
						<td>Tackles</td>
					</tr>
					</thead>';					
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
						while($row_1=$part1->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_1["slno"]).'</td>
							<td>'.strtoupper($row_1["details_of_machines"]).'</td>
							<td>'.strtoupper($row_1["tools"]).'</td>
							<td>'.strtoupper($row_1["tackles"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
		  <td colspan="2">7.Name of fitters, riveters, slotters and other working personnel to be engaged in the particular job. :</td>	
		</tr>
		<tr>
			<td colspan="2">
			<table class="table table-bordered table-responsive">		
				<thead>
				<tr>												
						<th>Sl. No.</th>
						<th>Experience of fitters</th>
						<th>Experience of riveters</th>
						<th>Experience of slotters</th>
						<th>Other working personnel</th>
					
				</tr>
				</thead>';					
					$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
					while($row_2=$part2->fetch_array()){
					$printContents=$printContents.'
					<tr>
						<td>'.strtoupper($row_2["slno"]).'</td>
						<td>'.strtoupper($row_2["name_of_fitters"]).'</td>
						<td>'.strtoupper($row_2["name_of_riveters"]).'</td>
						<td>'.strtoupper($row_2["name_of_slotters"]).'</td>
						<td>'.strtoupper($row_2["others_working_personnel"]).'</td>
					</tr>';
					}$printContents=$printContents.'
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">8.Experience of fitters, riveters, slotters and other working personnel to be engaged in the particular job. :</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
							<th>Sl. No.</th>
							<th>Experience of fitters</th>
							<th width="25">Experience of riveters</th>
							<th>Experience of slotters</th>
							<th>Other working personnel</th>
					</tr>
					</thead>';					
						$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
						while($row_3=$part3->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_3["slno"]).'</td>
							<td>'.strtoupper($row_3["exp_of_fitters"]).'</td>
							<td>'.strtoupper($row_3["exp_of_riveters"]).'</td>
							<td>'.strtoupper($row_3["exp_of_slotters"]).'</td>
							<td>'.strtoupper($row_3["others_working"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">9. Name, technical qualifications (if any) experience of the supervisor, who will supervise the particular job. :</td>
		   </tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<th>slno.</th>
						<th>Name</th>
						<th>Qualification</th>
						<th>Experience</th>
					</tr>
					</thead>';					
						$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
						while($row_4=$part4->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_4["slno"]).'</td>
							<td>'.strtoupper($row_4["name1"]).'</td>
							<td>'.strtoupper($row_4["qualifications1"]).'</td>
							<td>'.strtoupper($row_4["experience1"]).'</td>
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">10. Name and Address of the welders to be engaged in the job.:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Address</th>
						
						
					</tr>
					</thead>';					
						$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
						while($row_5=$part5->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_5["slno"]).'</td>
							<td>'.strtoupper($row_5["name"]).'</td>
							<td>'.strtoupper($row_5["address"]).'</td>
						
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
		  <td colspan="2">11. Details of equipment necessary for heat treatment of the repair, fabrication/renewal (if necessary) for the particular job.:</td>
		</tr>
		<tr>
			<td colspan="2">
				<table class="table table-bordered table-responsive">		
					<thead>
					<tr>												
						<th>Sl. No.</th>
						<th>Name</th>
						<th>Address</th>
						
						
					</tr>
					</thead>';					
						$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
						while($row_6=$part6->fetch_array()){
						$printContents=$printContents.'
						<tr>
							<td>'.strtoupper($row_6["slno"]).'</td>
							<td>'.strtoupper($row_6["name2"]).'</td>
							<td>'.strtoupper($row_6["details"]).'</td>
						
						</tr>';
						}$printContents=$printContents.'
				</table>
			</td>
		</tr>
		<tr>
			<td>12. Details of Non-destructive testing of repair/fabrication/renewal, if necessary. : </td>
			<td>'.strtoupper($testing_fabrication).'</td> 
		</tr>
		<tr>
			<td>13. Any other information relevant to the job considered significant to the Directorate.: </td>
			<td>'.strtoupper($job_significant).'</td> 
		</tr>
		<tr>
			<td>14. Classification applied for :</td>
			<td>'.strtoupper($class_applied).'</td>
		</tr>';
		
		$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
		$printContents=$printContents.'
		
		<tr>
			<td rowspan="2">Date : '.date("d-m-Y",strtotime($results["sub_date"])).'
			<br/>Signature of Repairer/Fabricator : '.strtoupper($key_person).'
			</td>
			<td>Signature of Owner : '.strtoupper($key_person).'</td>
		</tr>
	</table>
';
?>
				  
				