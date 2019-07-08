<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
		    $results=$p->fetch_array();	
			$form_id=$results["form_id"];$is_registration=$results["is_registration"];$is_registration_details=$results["is_registration_details"];$is_facilities=$results["is_facilities"];$is_facilities_details=$results["is_facilities_details"];$father_name=$results["father_name"];$capacity=$results["capacity"];$virtue=$results["virtue"];
			
		}else{			
			$form_id="";$is_registration="";$is_registration_details="";$is_facilities="";$is_facilities_details="";$father_name="";$capacity="";$virtue="";
		}
	}else{
			$results=$q->fetch_array();
			$form_id=$results["form_id"]; $is_registration=$results["is_registration"];$is_registration_details=$results["is_registration_details"];$is_facilities=$results["is_facilities"];$is_facilities_details=$results["is_facilities_details"];$father_name=$results["father_name"];$capacity=$results["capacity"];$virtue=$results["virtue"];
	}
?>
<?php require_once "../../requires/header.php";   ?>
    <?php include ("".$table_name."_Addmore.php"); ?>
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
									<td width="25%">1. i. Name of the applicant :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%"></td>
									<td width="25%"></td>		
								</tr>
								<tr>
									 <td colspan="4">ii. Address of the applicant :  	</td>				 
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
									<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
									<td>iii. Status  of the applicant  :</td>
									<td><input type="text" disabled value="<?php echo $status_applicant; ?>" class="form-control text-uppercase"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
									<td colspan="4">2. Address of the premises where the manufacturing activity will be done :</td>
								</tr>
								<tr>
									<td> Street Name 1  :</td>
									<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>" /></td>
									<td> Street Name 2 :</td>
									<td><input type="text" class="form-control text-uppercase"  disabled value="<?php echo $b_street_name2;?>" /></td>
								</tr>
								<tr>
									<td> Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"   disabled value="<?php echo $b_vill;?>"/></td>
									<td>District :</td>
									<td><input type="text" class="form-control text-uppercase"   disabled value="<?php echo $b_dist;?>"/></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" class="form-control text-uppercase"  disabled value="<?php echo $b_pincode;?>"></td>
									<td>Mobile No. :</td>
									<td><input type="text" disabled value="<?php echo $b_mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td colspan="4">3. Name of the insecticides with their registration number and date for which manufacturing license is applied: (enclose copies of certificates of registration duly signed by the applicant). : 
									<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
											<tr>
												<th width="5%">Slno</th>
												<th width="25%">Name of Insecticide</th>
												<th width="20%">Registration No </th>
												<th width="25%">Date</th>
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
														<td><input type="text" value="<?php echo $row_1["reg_no"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["date"]; ?>" id="txtD<?php echo $count;?>" class="dob form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" id="txtD1" size="10" class="dob form-control text-uppercase" name="txtD1"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
								</tr>
								<tr>
									<td width="25%">4. Whether any registration is provisional :</td>
									<td><label class="radio-inline"><input type="radio" name="is_registration" class="is_registration" value="Y"  <?php if(isset($is_registration) && $is_registration=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" class="is_registration"  value="N"  name="is_registration" <?php if(isset($is_registration) && ($is_registration=='N' || $is_registration=='')) echo 'checked'; ?>/> No</label></td>
									<td width="25%">if so give particulars :</td>
									<td><input  type="text" name="is_registration_details" id="is_registration_details" value="<?php echo $is_registration_details; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td colspan="4">5. Details of full time expert staf connected with the manufacture and testing  of the insecticides in the above unit :
									<table name="objectTable2" id="objectTable2" class="table table-responsive table-bordered text-center" >
											<tr>
												<th width="5%">Slno</th>
												<th width="25%">Name</th>
												<th width="20%">Qualification</th>
												<th width="25%">Experience</th>
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
														<td><input type="text" value="<?php echo $row_2["qualification"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_2["experience"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
													<td><input type="text" id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
													<td><input type="text" id="textC1" size="10" class="form-control text-uppercase" name="textC1"></td>
													<td><input type="text" id="textD1" size="10" class="form-control text-uppercase" name="textD1"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
									</td>
								</tr>
								<tr>
									<td width="25%">6. Whether all the facilities required under Chapter VIII of the rules have been provided. :</td>
									<td><label class="radio-inline"><input type="radio" name="is_facilities" class="is_facilities" value="Y"  <?php if(isset($is_facilities) && $is_facilities=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" class="is_facilities"  value="N"  name="is_facilities" <?php if(isset($is_facilities) && ($is_facilities=='N' || $is_facilities=='')) echo 'checked'; ?>/> No</label></td>
									<td width="25%"> Give full details in a separate sheet :</td>
									<td><textarea class="form-control text-uppercase" name="is_facilities_details" id="is_facilities_details"><?php echo $is_facilities_details; ?></textarea></td>
								</tr>
								<tr>
									<td colspan="4">Verification</td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I &nbsp;<input  type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"> &nbsp;s/o &nbsp;<input  type="text" name="father_name" value="<?php echo $father_name; ?>" class="form-control text-uppercase">&nbsp; do hereby solemnly verify that to the best of my knowledge and belief the information given in the application and the annexure and statements accompanying it is correct and complete.</td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">I further declare that I am making this application in my capacity as  &nbsp;<input  type="text" name="capacity" value="<?php echo $capacity; ?>" class="form-control text-uppercase"> &nbsp; and that I am competent to make this application and verify it by virtue of  &nbsp;<input  type="text" name="virtue" value="<?php echo $virtue; ?>" class="form-control text-uppercase"> &nbsp; a photo/attested copy of which is enclosed herewith.</td>
								</tr>
								<tr>
								   <td>Place :</td>
									<td><label disabled class="form-control text-uppercase" ><?php echo $dist; ?></label></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
								   <td>Date :</td>
									<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
									<td>Signature of applicant :</td>
									<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
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
	
$('#is_registration_details').attr('readonly','readonly');
	<?php if($is_registration == 'Y') echo "$('#is_registration_details').removeAttr('readonly','readonly');"; ?>
	$('.is_registration').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_details').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_details').attr('readonly','readonly');
			$('#is_registration_details').val('');
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
/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>	
</script>