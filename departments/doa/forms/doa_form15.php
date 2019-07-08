<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="15";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form1.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	   if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$results=$p->fetch_array();		
				$form_id=$results["form_id"];
				
				$pr_name1=$results["pr_name1"];$pr_name2=$results["pr_name2"];$pr_vill=$results["pr_vill"];$pr_dist=$results["pr_dist"];$pr_pincode=$results["pr_pincode"];$pr_mobile_no=$results["pr_mobile_no"];$pr_email=$results["pr_email"];
				$is_provisional_details=$results["is_provisional_details"];$is_provisional=$results["is_provisional"];$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
				$total_pesticides=$results["total_pesticides"];
				$son_of=$results["son_of"];$capacity=$results["capacity"];$competent=$results["competent"];$i_verification=$results["i_verification"];
				
			}else{
				$form_id="";
				$pr_name1="";$pr_name2="";
				$pr_vill="";$pr_dist="";
				$pr_pincode=""; $pr_mobile_no="";$pr_email="";
				$is_provisional_details="";$is_provisional="";$is_facilities_details="";
				$is_facilities="";$total_pesticides="";
				$son_of=""; $capacity="";$competent="";$i_verification="";
			}
		}else{
            $results=$q->fetch_array();			
			$form_id=$results["form_id"];
			$pr_name1=$results["pr_name1"];$pr_name2=$results["pr_name2"];$pr_vill=$results["pr_vill"];$pr_dist=$results["pr_dist"];$pr_pincode=$results["pr_pincode"];$pr_mobile_no=$results["pr_mobile_no"];$pr_email=$results["pr_email"];
			$is_provisional_details=$results["is_provisional_details"];$is_provisional=$results["is_provisional"];$is_facilities_details=$results["is_facilities_details"];$is_facilities=$results["is_facilities"];
			$total_pesticides=$results["total_pesticides"];
			$son_of=$results["son_of"];$capacity=$results["capacity"];$competent=$results["competent"];$i_verification=$results["i_verification"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							    
							<div id="table1" class="tab-pane" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td colspan="4">To<br/>
									&nbsp;&nbsp;&nbsp;&nbsp;The Licencing Authority ,<br/><br/>
									 <select class="form-control" style="width:300px" name="office_id" required>
                                        <option value="">Please Select</option>
										<?php
										$rows = $formFunctions->getOffices($dept);
                                        foreach($rows as $key => $values ){
											if($values["id"]!=6 && $values["id"]!=1){
												$jurisdiction = $values["jurisdiction"];
												$jurisdiction_array = explode(",",$jurisdiction); 
												//print_r($jurisdiction_array);echo "<br/><br/>";
												if(in_array(strtoupper($b_dist),$jurisdiction_array)){
													$address = $values["street1"]." ".$values["street2"].", ".$values["district"]." - ".$values["pin"];
													echo '<option value="'.$values["id"].'">'.$values["office_name"].', '.$address.'</option>';
												}												
											}												
										}
										?>											
									</select>
									<br/></td>
								</tr>
								 <tr>
									<td colspan="4">1. Name, address and e-mail address of the applicant :</td>
								 </tr>
								<tr>
									<td width="25%">Name of the applicant :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>		
								</tr>
								<tr>
									 <td colspan="4">Address of the applicant : </td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
									 <td colspan="4">2. Address of the manufacturing premises :</td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" name="pr_name1" value="<?php echo $pr_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" name="pr_name2" value="<?php echo $pr_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" name="pr_vill" value="<?php echo $pr_vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" name="pr_dist" value="<?php echo $pr_dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" name="pr_pincode" validate="pincode" maxlength="6" value="<?php echo $pr_pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input type="text" validate="mobileNumber" maxlength="10" name="pr_mobile_no" value="<?php echo $pr_mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="email" name="pr_email" validate="email"  value="<?php echo $pr_email; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="4">4.(a)Name of the insecticides with their registration number and date for which manufacturing license is applied :</td>
								</tr>
								<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
												<tr>
													<th width="10%">Slno</th>
													<th width="30%">Name of the insecticides</th>
													<th width="30%">Insecticide Registration No</th>
													<th width="30">Date</th>
												</tr>
											<?php
												$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
														<td><input type="text" value="<?php echo $row_1["reg_no"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>" ></td>
														<td><input type="text" value="<?php echo $row_1["date"]; ?>" id="txtD<?php echo $count;?>" class="dob form-control text-uppercase" size="10" name="txtD<?php echo $count;?>" ></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1" ></td>
													<td><input type="text" id="txtD1" size="10" class="dob form-control text-uppercase" name="txtD1" ></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>	
								<tr>
									<td>(b) Whether the registration is provisional or regular :</td>
									<td><label class="radio-inline"><input type="radio" name="is_provisional" class="is_provisional" value="P"  <?php if(isset($is_provisional) && $is_provisional=='P') echo 'checked'; ?> /> Provisional</label>
									<label class="radio-inline"><input type="radio" class="is_provisional"  value="R"  name="is_provisional" <?php if(isset($is_provisional) && ($is_provisional=='R' || $is_provisional=='')) echo 'checked'; ?>/>Regular</label></td>
									<td width="25%">Indicate date of validity in case of provisional registration :</td>
									<td><input  type="text" name="is_provisional_details" id="is_provisional_details" value="<?php echo $is_provisional_details; ?>" class="dobindia form-control"></td>
								</tr>
								<tr>
								   <td colspan="2">(c) Details of full time expert staff engaged in the manufacture and testing of the insecticide in the above unit :</td>
								</tr>
								<tr>
										<td colspan="4">
											<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center" >
												<tr>
													<th width="10%">Slno</th>
													<th width="30%">Name and Designation</th>
													<th width="30%">Qualification</th>
													<th width="30">Experience</th>
												</tr>
											<?php
												$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
												$num2 = $part2->num_rows;
												if($num2>0){
													$count=1;
													while($row_2=$part2->fetch_array()){	?>
													<tr>
														<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="textB<?php echo $count;?>" size="10"></td>
														<td><input type="text" value="<?php echo $row_2["qualification"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>" ></td>
														<td><input type="text" value="<?php echo $row_2["experience"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textD<?php echo $count;?>" ></td>
										
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
													<td><input type="text" id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
													<td><input type="text" id="textC1" size="10" class="form-control text-uppercase" name="textC1" ></td>
													<td><input type="text" id="textD1" size="10" class="form-control text-uppercase" name="textD1" ></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
								<tr>
									<td>(d)Whether details of facilities for manufacture of the insecticide including infrastructure and those mentioned in Chapter VIII of the Insecticides Rules, 1971, have been provided : (Enclose complete details in a separate sheet duly signed by the applicant) :</td>
									<td><label class="radio-inline"><input type="radio" name="is_facilities" class="is_facilities" value="Y"  <?php if(isset($is_facilities) && $is_facilities=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" class="is_facilities"  value="N"  name="is_facilities" <?php if(isset($is_facilities) && ($is_facilities=='N' || $is_facilities=='')) echo 'checked'; ?>/> No</label></td>
									<td width="25%">if so give details :</td>
									<td width="25%"><textarea name="is_facilities_details" class="form-control text-uppercase" id="is_facilities_details" validate="textarea" ><?php echo $is_facilities_details; ?></textarea></td>
								</tr>
								<tr>
									<td>Total No. of Pesticides : <span class="mandatory_field">*</span><span class="mandatory_field">*</span> </td>
									<td><input type="text" name="total_pesticides" class="text-uppercase form-control" required="required" validate="onlyNumbers" value="<?php echo $total_pesticides; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								
								<tr>
								     <td colspan="4" align="center"><b><u>Verification</u></b></td>
								</tr>
                             <tr>
									 <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I&nbsp;<input type="text" name="i_verification" value="<?php echo $i_verification; ?>" class="form-control text-uppercase"> &nbsp;s/o<input type="text" name="son_of" value="<?php echo $son_of; ?>" class="form-control text-uppercase">do hereby solemnly verify that the information given in the application and the annexures and statements accompanying it is correct and complete to the best of my knowledge and belief and that nothing has been concealed. I clearly understand that this license is liable to be cancelled, if any information, or part thereof, is found to be wrong, fake or false at any stage or any condition of license is violated.
									 I declare that we have adequate space and facilities to stock insecticides, manufactured by us so as to maintain their quality on shelf and shall not supply to any distributor or dealer or person who does not have adequate space and facilities to stock them so as to maintain their quality on shelf under every circumstances.</td>
								</tr>
								
                             <tr>
									 <td colspan="4" class="form-inline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I further declare that I am making this application in my capacity as&nbsp;<input type="text" name="capacity" value="<?php echo $capacity; ?>" class="form-control text-uppercase"> &nbsp;and that I am competent to make this application and verify it by virtue of<input type="text" name="competent" value="<?php echo $competent; ?>" class="form-control text-uppercase">a photo/attested copy of which is enclosed herewith.</td>
								</tr>									
								<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b>
										<br/>Place : <b><label><?php echo strtoupper($dist) ?></label></b>
										</td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of applicant</td>
								</tr>	
								<tr>
									<td class="text-center" colspan="4">
									<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
$('#is_provisional_details').attr('readonly','readonly');
	<?php if($is_provisional == 'P') echo "$('#is_provisional_details').removeAttr('readonly','readonly');"; ?>
	$('.is_provisional').on('change', function(){
		if($(this).val() == 'P'){
			$('#is_provisional_details').removeAttr('readonly','readonly');
		}else{
			$('#is_provisional_details').attr('readonly','readonly');
			$('#is_provisional_details').val('');
		}			
	});
	$('#is_facilities_details').attr('readonly','readonly');
	<?php if($is_facilities == 'Y') echo "$('#is_facilities_details').removeAttr('readonly','readonly');"; ?>
	$('.is_facilities').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_facilities_details').removeAttr('readonly','readonly');
		}else{
			$('#is_facilities_details').attr('readonly','readonly');
			$('#is_facilities_details').val('');
		}			
	});
</script>