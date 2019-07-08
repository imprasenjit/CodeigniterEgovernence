<?php
$dept="health";
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
		$h_name=$results["h_name"];$h_location=$results["h_location"];$bed_strength=$results["bed_strength"];$discipline=$results["discipline"];$annual_budget=$results["annual_budget"];$patient_year=$results["patient_year"];$sur_bed=$results["sur_bed"];$sur_operation=$results["sur_operation"];$sur_organ=$results["sur_organ"];$med_bed=$results["med_bed"];$med_operation=$results["med_operation"];$med_organ=$results["med_organ"];
		$med_potential=$results["med_potential"];$anaes_operation=$results["anaes_operation"];$anaes_equipment=$results["anaes_equipment"];$anaes_theatre=$results["anaes_theatre"];$anaes_emergancy=$results["anaes_emergancy"];$anaes_transplant=$results["anaes_transplant"];$facility_present=$results["facility_present"];$facility_not_present=$results["facility_not_present"];$icu_bed=$results["icu_bed"];$nurses=$results["nurses"];$technicians=$results["technicians"];$icu_equip=$results["icu_equip"];$data=$results["data"];$lab_investigation=$results["lab_investigation"];$lab_equipment=$results["lab_equipment"];$image_investigation=$results["image_investigation"];$haematology_investigation=$results["haematology_investigation"];$haematology_equipment=$results["haematology_equipment"];$image_equipment=$results["image_equipment"];$form_id=$results["form_id"];
		
		//yes-no//
		$is_gov_private=$results["is_gov_private"];
		$is_gov_private=($is_gov_private=="G")?'Government':'Private';
		$is_teaching_non=$results["is_teaching_non"];
		$is_teaching_non=($is_teaching_non=="T")?'Teaching':'Non-Teaching';
		
		$is_road=$results["is_road"];
		$is_road=($is_road=="Y")?'YES':'NO';
		$is_rail=$results["is_rail"];
		$is_rail=($is_rail=="Y")?'YES':'NO';
		$is_air=$results["is_air"];
		$is_air=($is_air=="Y")?'YES':'NO';
		$is_blood=$results["is_blood"];
		$is_blood=($is_blood=="Y")?'YES':'NO';
		$is_dialysis=$results["is_dialysis"];
		$is_dialysis=($is_dialysis=="Y")?'YES':'NO';
		$is_nephrologist=$results["is_nephrologist"];
		$is_nephrologist=($is_nephrologist=="Y")?'YES':'NO';
		$is_neurologist=$results["is_neurologist"];
		$is_neurologist=($is_neurologist=="Y")?'YES':'NO';
		$is_neuro_surgeon=$results["is_neuro_surgeon"];
		$is_neuro_surgeon=($is_neuro_surgeon=="Y")?'YES':'NO';
		$is_urologist=$results["is_urologist"];
		$is_urologist=($is_urologist=="Y")?'YES':'NO';
		$is_surgeon=$results["is_surgeon"];
		$is_surgeon=($is_surgeon=="Y")?'YES':'NO';
		$is_paediatrician=$results["is_paediatrician"];
		$is_paediatrician=($is_paediatrician=="Y")?'YES':'NO';
		$is_physiotherapist=$results["is_physiotherapist"];
		$is_physiotherapist=($is_physiotherapist=="Y")?'YES':'NO';
		$is_social=$results["is_social"];
		$is_social=($is_social=="Y")?'YES':'NO';
		$is_immunologists=$results["is_immunologists"];
		$is_immunologists=($is_immunologists=="Y")?'YES':'NO';
		$is_cardiologist=$results["is_cardiologist"];
		$is_cardiologist=($is_cardiologist=="Y")?'YES':'NO';
		$is_respiratory=$results["is_respiratory"];
		$is_respiratory=($is_respiratory=="Y")?'YES':'NO';
		$is_others=$results["is_others"];
		$is_others=($is_others=="Y")?'YES':'NO';
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
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
			
		</div><br/>
		<table class="table table-bordered table-responsive">
			<tr>
				<td colspan="2">
					<p>To<br/>
					The Appropriate Authority for organ transplantation (State or Union Territory)<br/><br/> 
					We hereby apply to be recognized as an institution to carry out organ transplantation. The required data about the facilities available in the hospital are as follows :-</p>
				</td>
			</tr>
			<tr>
				<td colspan="2"><b>(A) HOSPITAL</b></td>
			</tr>
			<tr>
				<td valign="top" width="50%">1. Name :</td>
				<td width="50%">'.strtoupper($h_name).'</td>
			</tr>
			<tr>
				<td valign="top">2. Location :</td>
				<td>'.strtoupper($h_location).'</td>
			</tr>
			<tr>
				<td valign="top">3. Goverment / Private :</td>
				<td>'.$is_gov_private.'</td>
			</tr>
			<tr>
				<td valign="top">4. Teaching / Non-teaching :</td>
				<td>'.$is_teaching_non.'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2">5. Approached by :</td>
				
			</tr>
			<tr>
				<td valign="top">Road :</td>
				<td>'.strtoupper($is_road).'</td>
			</tr>
			<tr>
				<td valign="top">Rail :</td>
				<td>'.strtoupper($is_rail).'</td>
			</tr>
			<tr>
				<td valign="top">Air :</td>
				<td>'.strtoupper($is_air).'</td>							
			</tr>
			<tr>
				<td valign="top">6. Total bed strength :</td>
				<td>'.strtoupper($bed_strength).'</td>
			</tr>
			<tr>
				<td valign="top">7. Name of the disciplines in the hospital :</td>
				<td>'.strtoupper($discipline).'</td>
			</tr>
			<tr>
				<td valign="top">8. Annual budget :</td>
				<td>'.strtoupper($annual_budget).'</td>
			</tr>
			<tr>
				<td valign="top">9. Patient turnover/ year :</td>
				<td>'.strtoupper($patient_year).'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2"><b>(B) SURGICAL FACILITIES :</b></td>
			</tr>
			<tr>
				<td>1. No. of beds :</td>
				<td>'.strtoupper($sur_bed).'</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of permanent staff members with their designations : </td>
			</tr>
				<tr>
					<td colspan="2">
					<table class="table table-bordered table-responsive">	
					<thead>
						<tr>
							<th align="center">Sl no</th>
							<th align="center">Name</th>
							<th align="center">Designation</th>
						</tr>
					</thead>
					<tbody>';
						$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'") or die("Error : ".$health->error);
						$num1 = $part1->num_rows;
						if($num1>0){
							$count=1;
							while($row_1=$part1->fetch_array()){ 
						  $printContents=$printContents.'
							<tr>
								<td>' . $count . '</td>
								<td>' . strtoupper($row_1["name"]) . '</td>
								<td>' . strtoupper($row_1["designation"]) . '</td>				
									
							</tr>';
									$count++;		
							}
						}
						$printContents=$printContents.'
					</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">3. No. of temporary staff members with their designations : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>					
							</tr>
						</thead>
						<tbody>';
							$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num2 = $part2->num_rows;
							if($num2>0){
								$count=1;
								while($row_2=$part2->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_2["name"]) . '</td>
									<td>' . strtoupper($row_2["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%">4. No. of operations done per year :</td>
				<td>'.strtoupper($sur_operation).'</td>
			</tr>								
			<tr>
				<td width="50%">5. Trained persons available for transplantation (please specify organ for transplantation) :</td>
				<td>'.strtoupper($sur_organ).'</td>
			</tr>
			<tr width="50%">
				<td valign="top" colspan="2"><b>(C) MEDICAL FACILITIES :</b></td>
			</tr>						
			<tr>
				<td>1. No. of beds :</td>
				<td>'.strtoupper($med_bed).'</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of permanent staff members with their designations : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
					<thead>
						<tr>
							<th align="center">Sl no</th>
							<th align="center">Name</th>
							<th align="center">Designation</th>
							
							</tr>
						</thead>
					<tbody>';
						$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'") or die("Error : ".$health->error);
						$num3 = $part3->num_rows;
						if($num3>0){
							$count=1;
							while($row_3=$part3->fetch_array()){ 
						  $printContents=$printContents.'
							<tr>
								<td>' . $count . '</td>
								<td>' . strtoupper($row_3["name"]) . '</td>
								<td>' . strtoupper($row_3["designation"]) . '</td>				
									
							</tr>';
									$count++;		
							}
						}
						$printContents=$printContents.'
					</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">3. No. of temporary staff members with their designations : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>
							</tr>
						</thead>
						<tbody>';
							$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num4 = $part4->num_rows;
							if($num4>0){
								$count=1;
								while($row_4=$part4->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_4["name"]) . '</td>
									<td>' . strtoupper($row_4["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%">4. Patient turnover per year :</td>
				<td>'.strtoupper($med_operation).'</td>
			</tr>
			<tr>
				<td width="50%">5. Trained persons available for transplantation (please specify organ for transplantation) :</td>
				<td>'.strtoupper($med_organ).'</td>
			</tr>
			<tr>
				<td width="50%">6. No. of potential transplant candidates admitted per year :</td>
				<td>'.strtoupper($med_potential).'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2"><b>(D) ANAESTHESIOLOGY :</b></td>
			</tr>				
			<tr>
				<td colspan="2">1. No. of permanent staff members with their designations : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num5 = $part5->num_rows;
							if($num5>0){
								$count=1;
								while($row_5=$part5->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_5["name"]) . '</td>
									<td>' . strtoupper($row_5["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of temorary staff members with their designations : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num6 = $part6->num_rows;
							if($num6>0){
								$count=1;
								while($row_6=$part6->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_6["name"]) . '</td>
									<td>' . strtoupper($row_6["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">3. Name and No. of operations performed : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
					<thead>
						<tr>
							<th align="center">Sl no</th>
							<th align="center">Name</th>
							<th align="center">Operations</th>				
						</tr>
					</thead>
						<tbody>';
							$part13=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t13 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num13 = $part13->num_rows;
							if($num13>0){
								$count=1;
								while($row_13=$part13->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_13["name"]) . '</td>
									<td>' . strtoupper($row_13["operation"]) . '</td>				
										
								</tr>';
											$count++;	
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">4. Name and No. of equipments available : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Equipment</th>				
							</tr>
						</thead>
						<tbody>';
							$part14=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t14 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num14 = $part14->num_rows;
							if($num14>0){
								$count=1;
								while($row_14=$part14->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_14["name"]) . '</td>
									<td>' . strtoupper($row_14["equipment"]) . '</td>				
										
								</tr>';
											$count++;	
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%">5. Total No. of operation theatres in the hospital :</td>
				<td>'.strtoupper($anaes_theatre).'</td>
			</tr>
			<tr>
				<td width="50%">6. No. of emergency operation theatres :</td>
				<td>'.strtoupper($anaes_emergancy).'</td>
			</tr>
			<tr>
				<td width="50%">7. No. of separate transplant operation theatre :</td>
				<td>'.strtoupper($anaes_transplant).'</td>
			</tr>					
			<tr>
				<td colspan="2"><b>(E)I.C.U./H.D.U. FACILITIES :</b></td>
			</tr>				
			<tr>
				<td colspan="2">1. I.C.U./H.D.U. facilities :</td>
			</tr>
			<tr>
				<td>Present :</td>
				<td>'.strtoupper($facility_present).'</td>
			</tr>
			<tr>
				<td>Not present :</td>
				<td>'.strtoupper($facility_not_present).'</td>
			</tr>						
			<tr>
				<td>2. No. of I.C.U. and H.D.U. beds :</td>
				<td>'.strtoupper($icu_bed).'</td>
			</tr>
			<tr>
				<td colspan="2">3.Trained :</td>
			</tr>
			<tr>
				<td>Nurses :</td>
				<td>'.strtoupper($nurses).'</td>
			</tr>
			<tr>
				<td>Technicians :</td>
				<td>'.strtoupper($technicians).'</td>							
			</tr>
			<tr>
				<td>4. Name of equipment in I.C.U. :</td>
				<td>'.strtoupper($icu_equip).'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2"><b>(F) OTHER SUPPORTIVE FACILITIES :</b></td>
			</tr>
			<tr>
				<td>Data about facilities available in the hospital :</td>
				<td>'.strtoupper($data).'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2"><b>(G) LABORATORY FACILITIES :</b></td>
			</tr>
			<tr>
				<td colspan="2">1. No. of permanent staff members with their designations :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>							
							</tr>
						</thead>
						<tbody>';
							$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num7 = $part7->num_rows;
							if($num7>0){
								$count=1;
								while($row_7=$part7->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_7["name"]) . '</td>
									<td>' . strtoupper($row_7["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of temporary staff members with their designations :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num8 = $part8->num_rows;
							if($num8>0){
								$count=1;
								while($row_8=$part8->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_8["name"]) . '</td>
									<td>' . strtoupper($row_8["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%">3. Names of the investigations carried out in the Department :</td>
				<td>'.strtoupper($lab_investigation).'</td>
			</tr>
			<tr>
				<td colspan="2">4. Name and No. of Equipments available :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Equipment</th>				
							</tr>
						</thead>
						<tbody>';
							$part15=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t15 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num15 = $part15->num_rows;
							if($num15>0){
								$count=1;
								while($row_15=$part15->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_15["name"]) . '</td>
									<td>' . strtoupper($row_15["equipment"]) . '</td>				
										
								</tr>';
											$count++;	
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>		
			<tr>
					<td valign="top" colspan="2"><b>(H) IMAGING SERVICES :</b></td>
			</tr>
			<tr>
				<td colspan="2">1. No. of permanent staff members with their designations : </td>
			</tr>
			<tr>				
				<td valign="top" colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num9 = $part9->num_rows;
							if($num9>0){
								$count=1;
								while($row_9=$part9->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_9["name"]) . '</td>
									<td>' . strtoupper($row_9["designation"]) . '</td>				
										
								</tr>';
											$count++;	
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of temporary staff members with their designation :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part10=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t10 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num10 = $part10->num_rows;
							if($num10>0){
								$count=1;
								while($row_10=$part10->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_10["name"]) . '</td>
									<td>' . strtoupper($row_10["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>
			<tr>
				<td width="50%">3. Names of the investigations carried out in the Department :</td>
				<td>'.strtoupper($image_investigation).'</td>
			</tr>
			<tr>
				<td colspan="2">4. Name and No. of Equipments available :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Equipment</th>				
							</tr>
						</thead>
						<tbody>';
							$part16=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t16 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num16 = $part16->num_rows;
							if($num16>0){
								$count=1;
								while($row_16=$part16->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_16["name"]) . '</td>
									<td>' . strtoupper($row_16["equipment"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>											
					</table>
				</td>
			</tr>		
			<tr>
				<td valign="top" colspan="2"><b>(I) HAEMATOLOGY SERVICES :</b></td> 
			</tr>
			<tr>
				<td colspan="2">1. No. of permanent staff members with their designations : </td>
			</tr>
			<tr>
				<td valign="top" colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>						
							</tr>
						</thead>
						<tbody>';
							$part11=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t11 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num11 = $part11->num_rows;
							if($num11>0){
								$count=1;
								while($row_11=$part11->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_11["name"]) . '</td>
									<td>' . strtoupper($row_11["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
						$printContents=$printContents.'
						</tbody>	
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. No. of temporary staff members with their designation : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">	
						<thead>
							<tr>
								<th align="center">Sl no</th>
								<th align="center">Name</th>
								<th align="center">Designation</th>				
							</tr>
						</thead>
						<tbody>';
							$part12=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t12 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num12 = $part12->num_rows;
							if($num12>0){
								$count=1;
								while($row_12=$part12->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_12["name"]) . '</td>
									<td>' . strtoupper($row_12["designation"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>	
					</table>			
				</td>
			</tr>
			<tr>
				<td width="50%">3. Names of the investigations carried out in the Department :</td>
				<td>'.strtoupper($haematology_investigation).'</td>
			</tr>
			<tr>
				<td colspan="2">4. Name and No. of equipments available : </td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">						
						<tr>
							<th align="center">Sl no</th>
							<th align="center">Name</th>
							<th align="center">Equipment</th>				
						</tr>			
						<tbody>';
							$part17=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t17 WHERE form_id='$form_id'") or die("Error : ".$health->error);
							$num17 = $part17->num_rows;
							if($num17>0){
								$count=1;
								while($row_17=$part17->fetch_array()){ 
							  $printContents=$printContents.'
								<tr>
									<td>' . $count . '</td>
									<td>' . strtoupper($row_17["name"]) . '</td>
									<td>' . strtoupper($row_17["equipment"]) . '</td>				
										
								</tr>';
										$count++;		
								}
							}
							$printContents=$printContents.'
						</tbody>		
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top"><b>(J) BLOOD BANK FACILITIES :</b></td>
				<td>'.strtoupper($is_blood).'</td>					
			</tr>
			<tr>
				<td valign="top"><b>(K) DIALYSIS FACILITIES :</b></td>
				<td>'.strtoupper($is_dialysis).'</td>
			</tr>
			<tr>
				<td valign="top" colspan="2"><b>(L) OTHER SUPORTIVE EXPERT PERSONNEL :</b></td>
			</tr>
			<tr>
				<td colspan="2">
					<table class="table table-bordered table-responsive">
						<tr>
							<td>1. Nephrologist :</td>
							<td>'.strtoupper($is_nephrologist).'</td>
							<td>2. Neurologist :</td>
							<td>'.strtoupper($is_neurologist).'</td>
						</tr>
						<tr>
							<td>3. Neuro-Surgeon :</td>
							<td>'.strtoupper($is_neuro_surgeon).'</td>
							<td>4. Urologist :</td>
							<td>'.strtoupper($is_urologist).'</td>
						</tr>
						<tr>
							<td >5. G.I. Surgeon :</td>
							<td>'.strtoupper($is_surgeon).'</td>
							<td>6. Paediatrician :</td>
							<td>'.strtoupper($is_paediatrician).'</td>
						</tr>
						<tr>
							<td>7. Physiotherapist :</td>
							<td>'.strtoupper($is_physiotherapist).'</td>
							<td>8. Social Worker :</td>
							<td>'.strtoupper($is_social).'</td>
						</tr>
						<tr>
							<td>9. Immunologists :</td>
							<td>'.strtoupper($is_immunologists).'</td>
							<td>10. Cardiologist :</td>
							<td>'.strtoupper($is_cardiologist).'</td>
						</tr>
						<tr>
							<td>11. Respiratory physician :</td>
							<td>'.strtoupper($is_respiratory).'</td>
							<td>12. Others :</td>
							<td>'.strtoupper($is_others).'</td>
						</tr>
					</table>
				</td>
			</tr>';
		
			$printContents=$printContents.$formFunctions->print_upload_payment_details($results);
			$printContents=$printContents.' 
			
			<tr>
				<td rowspan="2" valign="top"><b>Date : '.date('d-m-Y',strtotime(($results["sub_date"]))).'</b>
				<br/>
				<b>Place : '.strtoupper($dist).'</b></td>
				<td align="right"><b>Signature of Head of Institution : '.strtoupper($key_person).'<br/>
				Name : '.strtoupper($key_person).' </b></td>
			</tr>
		</table>';
?>