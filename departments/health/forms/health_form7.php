<?php  require_once "../../requires/login_session.php";
$dept="health";
$form="7";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc(); 
			$form_id=$results['form_id'];
			$h_name=$results["h_name"];$h_location=$results["h_location"];
			$is_gov_private=$results["is_gov_private"];$is_teaching_non=$results["is_teaching_non"];
			$is_road=$results["is_road"];$is_rail=$results["is_rail"];$is_air=$results["is_air"];	
			$bed_strength=$results["bed_strength"];$discipline=$results["discipline"];
			$annual_budget=$results["annual_budget"];$patient_year=$results["patient_year"];
			$sur_bed=$results["sur_bed"];$sur_operation=$results["sur_operation"];$sur_organ=$results["sur_organ"];
			$med_bed=$results["med_bed"];$med_operation=$results["med_operation"];
			$med_organ=$results["med_organ"];$med_potential=$results["med_potential"];
			$anaes_operation=$results["anaes_operation"];$anaes_equipment=$results["anaes_equipment"];$anaes_theatre=$results["anaes_theatre"];$anaes_emergancy=$results["anaes_emergancy"];$anaes_transplant=$results["anaes_transplant"];
			$facility_present=$results["facility_present"];$facility_not_present=$results["facility_not_present"];$icu_bed=$results["icu_bed"];$icu_equip=$results["icu_equip"];$nurses=$results["nurses"];$technicians=$results["technicians"];
			$data=$results["data"];
			$lab_investigation=$results["lab_investigation"];$lab_equipment=$results["lab_equipment"];
			$image_investigation=$results["image_investigation"];$image_equipment=$results["image_equipment"];
			$haematology_investigation=$results["haematology_investigation"];$haematology_equipment=$results["haematology_equipment"];
			$is_blood=$results["is_blood"];$is_dialysis=$results["is_dialysis"];
			$is_nephrologist=$results["is_nephrologist"];$is_neurologist=$results["is_neurologist"];$is_neuro_surgeon=$results["is_neuro_surgeon"];$is_urologist=$results["is_urologist"];$is_surgeon=$results["is_surgeon"];$is_social=$results["is_social"];$is_immunologists=$results["is_immunologists"];$is_respiratory=$results["is_respiratory"];$is_others=$results["is_others"];$is_cardiologist=$results["is_cardiologist"];$is_paediatrician=$results["is_paediatrician"];$is_physiotherapist=$results["is_physiotherapist"];		
		}else{
			$form_id="";
			$h_name="";$h_location="";
			$is_gov_private="";
			$is_teaching_non="";
			$is_road="";$is_rail="";$is_air="";
			$is_blood="";$is_dialysis="";
			$bed_strength="";$discipline="";$annual_budget="";$patient_year="";
			$sur_bed="";$sur_operation="";$sur_organ="";
			$med_bed="";$med_operation="";$med_organ="";$med_potential="";
			$anaes_operation="";$anaes_equipment="";$anaes_theatre="";$anaes_emergancy="";$anaes_transplant="";
			$facility_present="";$facility_not_present="";$icu_bed="";$icu_equip="";$nurses="";$technicians="";
			$data="";
			$lab_investigation="";$lab_equipment="";
		    $image_investigation="";$image_equipment="";
			$haematology_investigation="";$haematology_equipment="";
			$is_nephrologist="";$is_neurologist="";$is_neuro_surgeon="";$is_urologist="";$is_surgeon="";$is_paediatrician="";$is_physiotherapist="";$is_social="";$is_immunologists="";$is_respiratory="";$is_others="";$is_cardiologist="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$h_name=$results["h_name"];$h_location=$results["h_location"];
		$is_gov_private=$results["is_gov_private"];$is_teaching_non=$results["is_teaching_non"];
		$is_road=$results["is_road"];$is_rail=$results["is_rail"];$is_air=$results["is_air"];	
		$bed_strength=$results["bed_strength"];$discipline=$results["discipline"];
		$annual_budget=$results["annual_budget"];$patient_year=$results["patient_year"];
		$sur_bed=$results["sur_bed"];$sur_operation=$results["sur_operation"];$sur_organ=$results["sur_organ"];
		$med_bed=$results["med_bed"];$med_operation=$results["med_operation"];
		$med_organ=$results["med_organ"];$med_potential=$results["med_potential"];
		$anaes_operation=$results["anaes_operation"];$anaes_equipment=$results["anaes_equipment"];$anaes_theatre=$results["anaes_theatre"];$anaes_emergancy=$results["anaes_emergancy"];$anaes_transplant=$results["anaes_transplant"];
		$facility_present=$results["facility_present"];$facility_not_present=$results["facility_not_present"];$icu_bed=$results["icu_bed"];$icu_equip=$results["icu_equip"];$nurses=$results["nurses"];$technicians=$results["technicians"];
		$data=$results["data"];
		$lab_investigation=$results["lab_investigation"];$lab_equipment=$results["lab_equipment"];
		$image_investigation=$results["image_investigation"];$image_equipment=$results["image_equipment"];
		$haematology_investigation=$results["haematology_investigation"];$haematology_equipment=$results["haematology_equipment"];
		$is_blood=$results["is_blood"];$is_dialysis=$results["is_dialysis"];
		$is_nephrologist=$results["is_nephrologist"];$is_neurologist=$results["is_neurologist"];$is_neuro_surgeon=$results["is_neuro_surgeon"];$is_urologist=$results["is_urologist"];$is_surgeon=$results["is_surgeon"];$is_social=$results["is_social"];$is_immunologists=$results["is_immunologists"];$is_respiratory=$results["is_respiratory"];$is_others=$results["is_others"];$is_cardiologist=$results["is_cardiologist"];$is_paediatrician=$results["is_paediatrician"];$is_physiotherapist=$results["is_physiotherapist"];
	}
?>
<?php require_once "../../requires/header.php";   ?>
	<?php include ("".$table_name."_addmore.php"); ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>
							</div>
							<br>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table   class="table table-responsive table-bordered">
											<tr>
													<td colspan="4"><b>(A) HOSPITAL</b></td>
											</tr>
											<tr>
													<td width="25%">1. Name :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase"  name="h_name"  validate="letter" value="<?php echo $h_name; ?>"></td>
													<td width="25%">2. Location :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" name="h_location" value="<?php echo $h_location; ?>"></td>
											</tr>
											<tr>
													<td>3. Government / Private : </td>
													<td><label class="radio-inline"><input type="radio" required="required" name="is_gov_private" <?php if($is_gov_private=="G" ) echo "checked"; ?> value="G"/> Government </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_gov_private" <?php if($is_gov_private=="P") echo "checked"; ?> value="P"/> Private</label>&nbsp;&nbsp;</td>
													<td>4. Teaching / Non teaching :</td>
													<td><label class="radio-inline"><input type="radio" required="required" name="is_teaching_non" <?php if($is_teaching_non=="T") echo "checked"; ?> value="T"/> Teaching </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" required="required" name="is_teaching_non" <?php if($is_teaching_non=="N" ) echo "checked"; ?> value="N"/> Non teaching</label></td>
											</tr>
											<tr>
													<td colspan="4">5. Approached by :<span class="mandatory_field">*</span></td>
											</tr>
											<tr>
													<td >Road :</td>
													<td ><label class="radio-inline"><input type="radio" value="Y" <?php if($is_road=="Y") echo "checked"; ?> id="inlineRadio1" name="is_road"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_road=="N") echo "checked"; ?> id="inlineRadio1" name="is_road"> No </label>
													</td>
													<td >Rail :</td>
													<td ><label class="radio-inline"><input type="radio" value="Y" <?php if($is_rail=="Y") echo "checked"; ?> id="inlineRadio1" name="is_rail"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_rail=="N") echo "checked"; ?> id="inlineRadio1" name="is_rail"> No </label>
													</td>
											</tr>
											<tr>
													<td>Air :</td>
													<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_air=="Y") echo "checked"; ?> id="inlineRadio1" name="is_air"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_air=="N") echo "checked"; ?> id="inlineRadio1" name="is_air"> No </label>
													</td>
													
											</tr>
											<tr>
												<td>6. Total bed strength :</td>
												<td><input type="text" class="form-control text-uppercase" name="bed_strength"  value="<?php echo $bed_strength; ?>"></td>
												<td>7. Name of the disciplines in the hospital :</td>
												<td><input type="text" class="form-control text-uppercase" name="discipline" value="<?php echo $discipline; ?>"></td>
											</tr>
											<tr>
												<td>8. Annual budget :</td>
												<td><input type="text" class="form-control text-uppercase" name="annual_budget" value="<?php echo $annual_budget; ?>"></td>
												<td>9. Patient turnover/ year :</td>
												<td><input type="text" class="form-control text-uppercase" name="patient_year" validate="onlyNumbers" value="<?php echo $patient_year; ?>"></td>
											</tr>
											<tr>
												<td colspan="4"><b>(B) SURGICAL FACILITIES :</b></td>	
											</tr>
											<tr>
												<td width="25%">1. No. of beds :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="sur_bed" validate="onlyNumbers" value="<?php echo $sur_bed; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">2. No. of permanent staff members with their designations :  </td>
											</tr>
											<tr>
											  <td colspan="4">
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num1 = $part1->num_rows;
														if($num1>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
																<td><input id="textC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["designation"]; ?>" name="textC<?php echo $count;?>" size="10"></td>
															</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" validate="letters" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"  class="form-control text-uppercase" name="textC1"></td>
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
											<tr> 
												<td  colspan="4">3. No. of temporary staff with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
													</tr>
													</thead>
													<?php
														$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
														$num2= $part2->num_rows;
														if($num2>0){
														  $count=1;
														  while($row_2=$part2->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
																<td><input id="txtC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["designation"]; ?>" name="txtC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
														</tr>
													<?php } ?>														
												</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>4. No. of operations done per year :</td>
												<td><input type="text" class="form-control text-uppercase" name="sur_operation" value="<?php echo $sur_operation; ?>"></td>
												<td>5. Trained persons available for transplantation (please specify organ for transplantation) :</td>
												<td><input type="text" class="form-control text-uppercase" name="sur_organ"  value="<?php echo $sur_organ; ?>"></td>
											</tr>
											<tr>	
												<td colspan="4"><b>(C) MEDICAL FACILITIES :</b></td>	
											</tr>
											<tr>
												<td width="25%">1. No. of beds :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="med_bed"  validate="onlyNumbers" value="<?php echo $med_bed; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">2. No. of permanent staff members with their designations : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable3" id="objectTable3" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part3=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t3 WHERE form_id='$form_id'");
														$num3= $part3->num_rows;
														if($num3>0){
														  $count=1;
														  while($row_3=$part3->fetch_array()){	?>
															<tr>
																<td><input readonly id="taA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["sl_no"]; ?>" name="taA<?php echo $count;?>" size="1"></td>
																<td><input id="taB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["name"]; ?>" name="taB<?php echo $count;?>" size="10"></td>
																<td><input id="taC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_3["designation"]; ?>" name="taC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="taA1" readonly="readonly" size="10" class="form-control text-uppercase" name="taA1"></td>
															<td><input id="taB1" size="10" validate="letters" class="form-control text-uppercase" name="taB1"></td>
															<td><input id="taC1" size="10" class="form-control text-uppercase" name="taC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore3()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction3()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div>
												</td>
											</tr>	
											<tr>
												<td colspan="4">3. No. of temporary staff with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable4" id="objectTable4" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part4=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
														$num4= $part4->num_rows;
														if($num4>0){
														  $count=1;
														  while($row_4=$part4->fetch_array()){	?>
															<tr>
																<td><input readonly id="tbA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["sl_no"]; ?>" name="tbA<?php echo $count;?>" size="1"></td>
																<td><input id="tbB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["name"]; ?>" name="tbB<?php echo $count;?>" size="10"></td>
																<td><input id="tbC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["designation"]; ?>" name="tbC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tbA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tbA1"></td>
															<td><input id="tbB1" size="10" validate="letters" class="form-control text-uppercase" name="tbB1"></td>
															<td><input id="tbC1" size="10" class="form-control text-uppercase" name="tbC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore4()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction4()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div>
												</td>
											</tr>	
											<tr>
												<td>4. Patient turnover per year :</td>
												<td><input type="text" class="form-control text-uppercase" name="med_operation" validate="onlyNumbers" value="<?php echo $med_operation; ?>"></td>
												<td>5. Trained persons available for transplantation (please specify organ for transplantation) :</td>
												<td><input type="text" class="form-control text-uppercase" name="med_organ"  value="<?php echo $med_organ; ?>"></td>
											</tr>
											<tr>
												<td>6. No. of potential transplant candidates admitted per year :</td>
												<td><input type="text" class="form-control text-uppercase" name="med_potential"  value="<?php echo $med_potential; ?>"></td>
											</tr>
											<tr>	
												<td colspan="4"><b>(D) ANAESTHESIOLOGY :</b></td>	
											</tr>
											<tr>
												<td  colspan="4">1. No. of permanent staff members with their designations :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable5" id="objectTable5" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part5=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
														$num5= $part5->num_rows;
														if($num5>0){
														  $count=1;
														  while($row_5=$part5->fetch_array()){	?>
															<tr>
																<td><input readonly id="txxA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["sl_no"]; ?>" name="txxA<?php echo $count;?>" size="1"></td>
																<td><input id="txxB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["name"]; ?>" name="txxB<?php echo $count;?>" size="10"></td>
																<td><input id="txxC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["designation"]; ?>" name="txxC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txxA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txxA1"></td>
															<td><input id="txxB1" size="10" validate="letters" class="form-control text-uppercase" name="txxB1"></td>
															<td><input id="txxC1" size="10" class="form-control text-uppercase" name="txxC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore5()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction5()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div>
												</td>
											</tr>	
											<tr>
												<td colspan="4">2. No. of temporary staff members with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable6" id="objectTable6" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part6=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
														$num6= $part6->num_rows;
														if($num6>0){
														  $count=1;
														  while($row_6=$part6->fetch_array()){	?>
															<tr>
																<td><input readonly id="tdA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["sl_no"]; ?>" name="tdA<?php echo $count;?>" size="1"></td>
																<td><input id="tdB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["name"]; ?>" name="tdB<?php echo $count;?>" size="10"></td>
																<td><input id="tdC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["designation"]; ?>" name="tdC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tdA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tdA1"></td>
															<td><input id="tdB1" size="10" validate="letters" class="form-control text-uppercase" name="tdB1"></td>
															<td><input id="tdC1" size="10" class="form-control text-uppercase" name="tdC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore6()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction6()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">3. Name and No. of operations performed :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable13" id="objectTable13" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">No. of operations.</th>
														
													</tr>
													</thead>
													<?php
														$part13=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t13 WHERE form_id='$form_id'");
														$num13= $part13->num_rows;
														if($num13>0){
														  $count=1;
														  while($row_13=$part13->fetch_array()){	?>
															<tr>
																<td><input readonly id="tkA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_13["sl_no"]; ?>" name="tkA<?php echo $count;?>" size="1"></td>
																<td><input id="tkB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_13["name"]; ?>" name="tkB<?php echo $count;?>" size="10"></td>
																<td><input id="tkC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_13["operation"]; ?>" name="tkC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tkA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tkA1"></td>
															<td><input id="tkB1" size="10" validate="letters" class="form-control text-uppercase" name="tkB1"></td>
															<td><input id="tkC1" size="10" class="form-control text-uppercase" name="tkC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore13()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction13()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval13" name="hiddenval13" value="<?php echo $hiddenval13; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">4. Name and No. of equipments available :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable14" id="objectTable14" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">No. of equipments.</th>
														
													</tr>
													</thead>
													<?php
														$part14=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t14 WHERE form_id='$form_id'");
														$num14= $part14->num_rows;
														if($num14>0){
														  $count=1;
														  while($row_14=$part14->fetch_array()){	?>
															<tr>
																<td><input readonly id="tlA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_14["sl_no"]; ?>" name="tlA<?php echo $count;?>" size="1"></td>
																<td><input id="tlB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_14["name"]; ?>" name="tlB<?php echo $count;?>" size="10"></td>
																<td><input id="tlC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_14["equipment"]; ?>" name="tlC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tlA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tlA1"></td>
															<td><input id="tlB1" size="10" validate="letters" class="form-control text-uppercase" name="tlB1"></td>
															<td><input id="tlC1" size="10" class="form-control text-uppercase" name="tlC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore14()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction14()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval14" name="hiddenval14" value="<?php echo $hiddenval14; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>5. Total No. of operation theatres in the hospital :</td>
												<td><input type="text" class="form-control text-uppercase" name="anaes_theatre"  value="<?php echo $anaes_theatre; ?>"></td>
												<td>6. No. of emergency operation theatres :</td>
												<td><input type="text" class="form-control text-uppercase" name="anaes_emergancy"  value="<?php echo $anaes_emergancy; ?>"></td>
																				
											</tr>
											<tr>
												<td>7. No. of separate transplant operation theatre :</td>
												<td><input type="text" class="form-control text-uppercase" name="anaes_transplant"  value="<?php echo $anaes_transplant; ?>"></td>
																				
											</tr>
											<tr>	
												<td colspan="4"><b>(E)I.C.U./H.D.U. FACILITIES :</b></td>	
											</tr>
											<tr>
												<td>1. I.C.U./H.D.U. facilities :</td>
											</tr>
											<tr>
												<td width="25%">Present :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="facility_present"  value="<?php echo $facility_present; ?>"></td>
												<td width="25%">Not present :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="facility_not_present"  value="<?php echo $facility_not_present; ?>"></td>
											</tr>
											<tr>
												<td>2. No. of I.C.U. and H.D.U. beds :</td>
												<td><input type="text" class="form-control text-uppercase" name="icu_bed" validate="onlyNumbers" value="<?php echo $icu_bed; ?>"></td>
											</tr>
											<tr>
												<td width="25%">3. Trained :</td>
											</tr>
											<tr>
												<td width="25%">Nurses :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="nurses"  value="<?php echo $nurses; ?>"></td>
												<td width="25%">Technicians :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="technicians"  value="<?php echo $technicians; ?>"></td>
											</tr>
											<tr>
												<td>4. Name of equipment in I.C.U. :</td>
												<td><input type="text" class="form-control text-uppercase" name="icu_equip"  value="<?php echo $icu_equip; ?>">
												</td>
											</tr>
											<tr>	
												<td colspan="4"><b>(F) OTHER SUPPORTIVE FACILITIES :</b></td>	
											</tr>
											<tr>
												<td>Data about facilities available in the hospital :</td>
												<td><input type="text" class="form-control text-uppercase" name="data"  value="<?php echo $data; ?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>	
												<td colspan="4"><b>(G) LABORATORY FACILITIES :</b></td>	
											</tr>
											<tr>
												<td  colspan="4">1. No. of permanent staff members with their designations :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable7" id="objectTable7" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part7=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t7 WHERE form_id='$form_id'");
														$num7= $part7->num_rows;
														if($num7>0){
														  $count=1;
														  while($row_7=$part7->fetch_array()){	?>
															<tr>
																<td><input readonly id="teA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["sl_no"]; ?>" name="teA<?php echo $count;?>" size="1"></td>
																<td><input id="teB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["name"]; ?>" name="teB<?php echo $count;?>" size="10"></td>
																<td><input id="teC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_7["designation"]; ?>" name="teC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="teA1" readonly="readonly" size="10" class="form-control text-uppercase" name="teA1"></td>
															<td><input id="teB1" size="10" validate="letters" class="form-control text-uppercase" name="teB1"></td>
															<td><input id="teC1" size="10" validate="letters" class="form-control text-uppercase" name="teC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore7()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction7()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval7" name="hiddenval7" value="<?php echo $hiddenval7; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">2. No. of temporary staff members with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable8" id="objectTable8" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
													</tr>
													</thead>
													<?php
														$part8=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t8 WHERE form_id='$form_id'");
														$num8=$part8->num_rows;
														if($num8>0){
														  $count=1;
														  while($row_8=$part8->fetch_array()){	?>
															<tr>
																<td><input readonly id="tfA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["sl_no"]; ?>" name="tfA<?php echo $count;?>" size="1"></td>
																<td><input id="tfB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["name"]; ?>" name="tfB<?php echo $count;?>" size="10"></td>
																<td><input id="tfC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_8["designation"]; ?>" name="tfC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tfA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tfA1"></td>
															<td><input id="tfB1" size="10" validate="letters" class="form-control text-uppercase" name="tfB1"></td>
															<td><input id="tfC1" size="10" validate="letters" class="form-control text-uppercase" name="tfC1"></td>
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore8()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction8()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval8" name="hiddenval8" value="<?php echo $hiddenval8; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="2">3. Names of the investigations carried out in the Deptt. :</td>
												<td colspan="2"><input type="text" class="form-control text-uppercase" name="lab_investigation" value="<?php echo $lab_investigation; ?>"></td>
											</tr>
											<tr>
												<td>4. Name and No. of equipments available :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable15" id="objectTable15" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Equipment</th>
														
													</tr>
													</thead>
													<?php
														$part15=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t15 WHERE form_id='$form_id'");
														$num15= $part15->num_rows;
														if($num15>0){
														  $count=1;
														  while($row_15=$part15->fetch_array()){	?>
															<tr>
																<td><input readonly id="tmA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_15["sl_no"]; ?>" name="tmA<?php echo $count;?>" size="1"></td>
																<td><input id="tmB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_15["name"]; ?>" name="tmB<?php echo $count;?>" size="10"></td>
																<td><input id="tmC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_15["equipment"]; ?>" name="tmC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tmA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tmA1"></td>
															<td><input id="tmB1" size="10" validate="letters" class="form-control text-uppercase" name="tmB1"></td>
															<td><input id="tmC1" size="10" validate="letters" class="form-control text-uppercase" name="tmC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore15()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction15()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval15" name="hiddenval15" value="<?php echo $hiddenval15; ?>"/></div>
												</td>
											</tr>
											<tr>	
												<td colspan="4"><b>(H) IMAGING SERVICES :</b></td>	
											</tr>
											<tr>
												<td colspan="4">1. No. of permanent staff members with their designations : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable9" id="objectTable9" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part9=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t9 WHERE form_id='$form_id'");
														$num9=$part9->num_rows;
														if($num9>0){
														  $count=1;
														  while($row_9=$part9->fetch_array()){	?>
															<tr>
																<td><input readonly id="tgA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_9["sl_no"]; ?>" name="tgA<?php echo $count;?>" size="1"></td>
																<td><input id="tgB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_9["name"]; ?>" name="tgB<?php echo $count;?>" size="10"></td>
																<td><input id="tgC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_9["designation"]; ?>" name="tgC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tgA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tgA1"></td>
															<td><input id="tgB1" size="10" validate="letters" class="form-control text-uppercase" name="tgB1"></td>
															<td><input id="tgC1" size="10" validate="letters" class="form-control text-uppercase" name="tgC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore9()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction9()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval9" name="hiddenval9" value="<?php echo $hiddenval9; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td  colspan="4">2. No. of temporary staff members with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable10" id="objectTable10" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part10=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t10 WHERE form_id='$form_id'");
														$num10=$part10->num_rows;
														if($num10>0){
														  $count=1;
														  while($row_10=$part10->fetch_array()){	?>
															<tr>
																<td><input readonly id="thA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_10["sl_no"]; ?>" name="thA<?php echo $count;?>" size="1"></td>
																<td><input id="thB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_10["name"]; ?>" name="thB<?php echo $count;?>" size="10"></td>
																<td><input id="thC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_10["designation"]; ?>" name="thC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="thA1" readonly="readonly" size="10" class="form-control text-uppercase" name="thA1"></td>
															<td><input id="thB1" size="10" validate="letters" class="form-control text-uppercase" name="thB1"></td>
															<td><input id="thC1" size="10" validate="letters" class="form-control text-uppercase" name="thC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore10()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction10()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval10" name="hiddenval10" value="<?php echo $hiddenval10; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>3. Names of the investigations carried out in the Deptt. :</td>
												<td><input type="text" class="form-control text-uppercase" name="image_investigation" value="<?php echo $image_investigation; ?>"></td>
											</tr>
											<tr>
												<td>4. Name and No. of equipments available :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable16" id="objectTable16" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Equipment</th>
													</tr>
													</thead>
													<?php
														$part16=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t16 WHERE form_id='$form_id'");
														$num16=$part16->num_rows;
														if($num16>0){
														  $count=1;
														  while($row_16=$part16->fetch_array()){	?>
															<tr>
																<td><input readonly id="tnA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_16["sl_no"]; ?>" name="tnA<?php echo $count;?>" size="1"></td>
																<td><input id="tnB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_16["name"]; ?>" name="tnB<?php echo $count;?>" size="10"></td>
																<td><input id="tnC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_16["equipment"]; ?>" name="tnC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tnA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tnA1"></td>
															<td><input id="tnB1" size="10" validate="letters" class="form-control text-uppercase" name="tnB1"></td>
															<td><input id="tnC1" size="10" validate="letters" class="form-control text-uppercase" name="tnC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore16()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction16()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval16" name="hiddenval16" value="<?php echo $hiddenval16; ?>"/></div>
												</td>
											</tr>
											<tr>	
												<td colspan="4"><b>(I) HAEMATOLOGY SERVICES :</b></td>	
											</tr>
											<tr>
												<td colspan="4">1. No. of permanent staff members with their designations :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable11" id="objectTable11" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
														
													</tr>
													</thead>
													<?php
														$part11=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t11 WHERE form_id='$form_id'");
														$num11=$part11->num_rows;
														if($num11>0){
														  $count=1;
														  while($row_11=$part11->fetch_array()){	?>
															<tr>
																<td><input readonly id="taaA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_11["sl_no"]; ?>" name="taaA<?php echo $count;?>" size="1"></td>
																<td><input id="taaB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_11["name"]; ?>" name="taaB<?php echo $count;?>" size="11"></td>
																<td><input id="taaC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_11["designation"]; ?>" name="taaC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="taaA1" readonly="readonly" size="10" class="form-control text-uppercase" name="taaA1"></td>
															<td><input id="taaB1" size="10" validate="letters" class="form-control text-uppercase" name="taaB1"></td>
															<td><input id="taaC1" size="10" validate="letters" class="form-control text-uppercase" name="taaC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore11()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction11()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval11" name="hiddenval11" value="<?php echo $hiddenval11; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td colspan="4">2. No. of temporary staff members with their designation :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable12" id="objectTable12" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Designation</th>
													</tr>
													</thead>
													<?php
														$part12=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t12 WHERE form_id='$form_id'");
														$num12=$part12->num_rows;
														if($num12>0){
														  $count=1;
														  while($row_12=$part12->fetch_array()){	?>
															<tr>
																<td><input readonly id="tabA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_12["sl_no"]; ?>" name="tabA<?php echo $count;?>" size="1"></td>
																<td><input id="tabB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_12["name"]; ?>" name="tabB<?php echo $count;?>" size="12"></td>
																<td><input id="tabC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_12["designation"]; ?>" name="tabC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="tabA1" readonly="readonly" size="10" class="form-control text-uppercase" name="tabA1"></td>
															<td><input id="tabB1" size="10" validate="letters" class="form-control text-uppercase" name="tabB1"></td>
															<td><input id="tabC1" size="10" validate="letters" class="form-control text-uppercase" name="tabC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore12()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction12()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval12" name="hiddenval12" value="<?php echo $hiddenval12; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td>3. Names of the investigations carried out in the Deptt. :</td>
												<td><input type="text" class="form-control text-uppercase" name="haematology_investigation" value="<?php echo $haematology_investigation; ?>"></td>
											</tr>
											<tr>
												<td>4. Name and No. of equipments available :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable17" id="objectTable17" class="table table-responsive text-center">
													<thead>
													<tr>
														<th width="10%">S.No.</th>
														<th width="40%">Name</th>
														<th width="50%">Equipment</th>
													</tr>
													</thead>
													<?php
														$part17=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t17 WHERE form_id='$form_id'");
														$num17=$part17->num_rows;
														if($num17>0){
														  $count=1;
														  while($row_17=$part17->fetch_array()){	?>
															<tr>
																<td><input readonly id="toA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_17["sl_no"]; ?>" name="toA<?php echo $count;?>" size="1"></td>
																<td><input id="toB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_17["name"]; ?>" name="toB<?php echo $count;?>" size="12"></td>
																<td><input id="toC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_17["equipment"]; ?>" name="toC<?php echo $count;?>" size="10"></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="toA1" readonly="readonly" size="10" class="form-control text-uppercase" name="toA1"></td>
															<td><input id="toB1" size="10" validate="letters" class="form-control text-uppercase" name="toB1"></td>
															<td><input id="toC1" size="10" validate="letters" class="form-control text-uppercase" name="toC1"></td>
														</tr>
														<?php } ?>														
													</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore17()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction17()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval17" name="hiddenval17" value="<?php echo $hiddenval17; ?>"/></div>
												</td>
											</tr>
											<tr>
												<td ><b>(J) BLOOD BANK FACILITIES :<span class="mandatory_field">*</span></b></td>
												<td ><label class="radio-inline"><input type="radio" value="Y" <?php if($is_blood=="Y" ) echo "checked"; ?> id="inlineRadio1" name="is_blood"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_blood=="N") echo "checked"; ?> id="inlineRadio1" name="is_blood"> No </label>
												</td>
												<td><b>(K) DIALYSIS FACILITIES :<span class="mandatory_field">*</span></b></td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_dialysis=="Y") echo "checked"; ?> id="inlineRadio1" name="is_dialysis"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_dialysis=="N") echo "checked"; ?> id="inlineRadio1" name="is_dialysis"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4"><b>(L) OTHER SUPORTIVE EXPERT PERSONNEL :<span class="mandatory_field">*</span></b></td>
											</tr>
											<tr>
											   <td>1. Nephrologist : </td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_nephrologist=="Y") echo "checked"; ?> id="inlineRadio1" name="is_nephrologist"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_nephrologist=="N") echo "checked"; ?> id="inlineRadio1" name="is_nephrologist"> No </label>
												</td>
										
											   <td>2. Neurologist :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_neurologist=="Y") echo "checked"; ?> id="inlineRadio1" name="is_neurologist"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_neurologist=="N") echo "checked"; ?> id="inlineRadio1" name="is_neurologist"> No </label>
												</td>
											</tr>
											<tr>
											   <td>3. Neuro-Surgeon :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_neuro_surgeon=="Y") echo "checked"; ?> id="inlineRadio1" name="is_neuro_surgeon"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_neuro_surgeon=="N") echo "checked"; ?> id="inlineRadio1" name="is_neuro_surgeon"> No </label>
												</td>
												<td>4. Urologist :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_urologist=="Y") echo "checked"; ?> id="inlineRadio1" name="is_urologist"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_urologist=="N") echo "checked"; ?> id="inlineRadio1" name="is_urologist"> No </label>
												</td>
											</tr>
											<tr>
											   <td>5. G.I. Surgeon :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_surgeon=="Y") echo "checked"; ?> id="inlineRadio1" name="is_surgeon"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_surgeon=="N") echo "checked"; ?> id="inlineRadio1" name="is_surgeon"> No </label>
												</td>
										
											   <td>6. Paediatrician :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_paediatrician=="Y") echo "checked"; ?> id="inlineRadio1" name="is_paediatrician"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_paediatrician=="N") echo "checked"; ?> id="inlineRadio1" name="is_paediatrician"> No </label>
												</td>
											</tr>
											<tr>
											   <td>7. Physiotherapist :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_physiotherapist=="Y") echo "checked"; ?> id="inlineRadio1" name="is_physiotherapist"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_physiotherapist=="N") echo "checked"; ?> id="inlineRadio1" name="is_physiotherapist"> No </label>
												</td>
										
											   <td>8. Social Worker :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_social=="Y") echo "checked"; ?> id="inlineRadio1" name="is_social"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_social=="N") echo "checked"; ?> id="inlineRadio1" name="is_social"> No </label>
												</td>
											</tr>
											<tr>
											   <td>9. Immunologists :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_immunologists=="Y") echo "checked"; ?> id="inlineRadio1" name="is_immunologists"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_immunologists=="N") echo "checked"; ?> id="inlineRadio1" name="is_immunologists"> No </label>
												</td>
										
											   <td>10. Cardiologist :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_cardiologist=="Y") echo "checked"; ?> id="inlineRadio1" name="is_cardiologist"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_cardiologist=="N") echo "checked"; ?> id="inlineRadio1" name="is_cardiologist"> No </label>
												</td>
											</tr>
											<tr>
											   <td>11. Respiratory physician :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_respiratory=="Y") echo "checked"; ?> id="inlineRadio1" name="is_respiratory"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_respiratory=="N") echo "checked"; ?> id="inlineRadio1" name="is_respiratory"> No </label>
												</td>
										
											   <td>12. Others :</td>
												<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_others=="Y" ) echo "checked"; ?> id="inlineRadio1" name="is_others"> Yes </label>
												<label class="radio-inline"><input type="radio" value="N" <?php if($is_others=="N") echo "checked"; ?> id="inlineRadio1" name="is_others"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="2">Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
												Place : <strong><?php echo strtoupper($dist)?></strong>
												</td>										
												<td colspan="2" align="right">Signature of Head of Institution: <strong><?php echo strtoupper($key_person)?></strong><br/>
												Name : <label><?php echo strtoupper($key_person)?></strong>
												</td>
											</tr>					
											<tr>										
												<td class="text-center" colspan="4">
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
												</td>									
											</tr>
										</table>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
