<?php  require_once "../../requires/login_session.php";
$dept="pcpndt";
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
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$facilities_avail=$results["facilities_avail"];$fees_description=$results["fees_description"];
			$state_details=$results["state_details"];
			if(!empty($results["facility_type"])){
				$facility_type=json_decode($results["facility_type"]);
				if(isset($facility_type->a)) $facility_type_a=$facility_type->a; else $facility_type_a="";
				if(isset($facility_type->b)) $facility_type_b=$facility_type->b; else $facility_type_b="";
				if(isset($facility_type->c)) $facility_type_c=$facility_type->c; else $facility_type_c="";
				if(isset($facility_type->d)) $facility_type_d=$facility_type->d; else $facility_type_d="";
				if(isset($facility_type->e)) $facility_type_e=$facility_type->e; else $facility_type_e="";
			}else{
				$facility_type_a="";$facility_type_b="";$facility_type_c="";$facility_type_d="";$facility_type_e="";
			}
			
			if(!empty($results["type_of"])){
			$type_of=json_decode($results["type_of"]);
			$type_of_institution=$type_of->institution;
			}else{
					$type_of_institution="";
			}
			if(!empty($results["specific_invasive"])){
				$specific_invasive=json_decode($results["specific_invasive"]);
				if(isset($specific_invasive->a)) $specific_invasive_a=$specific_invasive->a; else $specific_invasive_a="";
				if(isset($specific_invasive->b)) $specific_invasive_b=$specific_invasive->b; else $specific_invasive_b="";
				if(isset($specific_invasive->c)) $specific_invasive_c=$specific_invasive->c; else $specific_invasive_c="";
				if(isset($specific_invasive->d)) $specific_invasive_d=$specific_invasive->d; else $specific_invasive_d="";
				if(isset($specific_invasive->e)) $specific_invasive_e=$specific_invasive->e; else $specific_invasive_e="";
			}else{
				$specific_invasive_a="";$specific_invasive_b="";$specific_invasive_c="";$specific_invasive_d="";$specific_invasive_e="";		 
			}
			if(!empty($results["specific_non_invasive"])){
				$specific_non_invasive=json_decode($results["specific_non_invasive"]);
				if(isset($specific_non_invasive->a)) $specific_non_invasive_a=$specific_non_invasive->a; else $specific_non_invasive_a="";				
			}else{
				$specific_non_invasive_a="";				 
			}
			if(!empty($results["test_facility"])){
				$test_facility=json_decode($results["test_facility"]);
				if(isset($test_facility->a)) $test_facility_a=$test_facility->a; else $test_facility_a="";
				if(isset($test_facility->b)) $test_facility_b=$test_facility->b; else $test_facility_b="";
				if(isset($test_facility->c)) $test_facility_c=$test_facility->c; else $test_facility_c="";
				if(isset($test_facility->d)) $test_facility_d=$test_facility->d; else $test_facility_d="";
				if(isset($test_facility->e)) $test_facility_e=$test_facility->e; else $test_facility_e="";
				if(isset($test_facility->f)) $test_facility_f=$test_facility->f; else $test_facility_f="";
			}else{
				$test_facility_a="";$test_facility_b="";$test_facility_c="";$test_facility_d="";$test_facility_e="";$test_facility_f="";				 
			}
			if(!empty($results["lab_facility"])){
				$lab_facility=json_decode($results["lab_facility"]);
				if(isset($lab_facility->a)) $lab_facility_a=$lab_facility->a; else $lab_facility_a="";
				if(isset($lab_facility->b)) $lab_facility_b=$lab_facility->b; else $lab_facility_b="";
				if(isset($lab_facility->c)) $lab_facility_c=$lab_facility->c; else $lab_facility_c="";				
			}else{
				$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";				 
			}
		}else{
			$form_id="";$fees_description="";
			//PART I
			$facility_type_a="";$facility_type_b="";$facility_type_c="";$facility_type_d="";$facility_type_e="";$type_of_institution="";$specific_invasive_a="";$specific_invasive_b="";$specific_invasive_c="";$specific_invasive_d="";$specific_invasive_e="";$specific_non_invasive_a="";$facilities_avail="";$test_facility_a="";$test_facility_b="";$test_facility_c="";$test_facility_d="";$test_facility_e="";$test_facility_f="";$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
			$state_details="";			
		}
	}else{	
		$results=$q->fetch_array();
		$form_id=$results["form_id"];
		$facilities_avail=$results["facilities_avail"];$fees_description=$results["fees_description"];
		$state_details=$results["state_details"];
		if(!empty($results["facility_type"])){
			$facility_type=json_decode($results["facility_type"]);
			if(isset($facility_type->a)) $facility_type_a=$facility_type->a; else $facility_type_a="";
			if(isset($facility_type->b)) $facility_type_b=$facility_type->b; else $facility_type_b="";
			if(isset($facility_type->c)) $facility_type_c=$facility_type->c; else $facility_type_c="";
			if(isset($facility_type->d)) $facility_type_d=$facility_type->d; else $facility_type_d="";
			if(isset($facility_type->e)) $facility_type_e=$facility_type->e; else $facility_type_e="";
		}else{
			$facility_type_a="";$facility_type_b="";$facility_type_c="";$facility_type_d="";$facility_type_e="";				 
		}			
		if(!empty($results["type_of"])){
			$type_of=json_decode($results["type_of"]);
			$type_of_institution=$type_of->institution;
		}else{
			$type_of_institution="";
		}			
		if(!empty($results["specific_invasive"])){
			$specific_invasive=json_decode($results["specific_invasive"]);
			if(isset($specific_invasive->a)) $specific_invasive_a=$specific_invasive->a; else $specific_invasive_a="";
			if(isset($specific_invasive->b)) $specific_invasive_b=$specific_invasive->b; else $specific_invasive_b="";
			if(isset($specific_invasive->c)) $specific_invasive_c=$specific_invasive->c; else $specific_invasive_c="";
			if(isset($specific_invasive->d)) $specific_invasive_d=$specific_invasive->d; else $specific_invasive_d="";
			if(isset($specific_invasive->e)) $specific_invasive_e=$specific_invasive->e; else $specific_invasive_e="";
		}else{
			$specific_invasive_a="";$specific_invasive_b="";$specific_invasive_c="";$specific_invasive_d="";$specific_invasive_e="";
		}
		if(!empty($results["specific_non_invasive"])){
			$specific_non_invasive=json_decode($results["specific_non_invasive"]);
			if(isset($specific_non_invasive->a)) $specific_non_invasive_a=$specific_non_invasive->a; else $specific_non_invasive_a="";
		}else{
			$specific_non_invasive_a="";
		}
		if(!empty($results["test_facility"])){
			$test_facility=json_decode($results["test_facility"]);
			if(isset($test_facility->a)) $test_facility_a=$test_facility->a; else $test_facility_a="";
			if(isset($test_facility->b)) $test_facility_b=$test_facility->b; else $test_facility_b="";
			if(isset($test_facility->c)) $test_facility_c=$test_facility->c; else $test_facility_c="";
			if(isset($test_facility->d)) $test_facility_d=$test_facility->d; else $test_facility_d="";
			if(isset($test_facility->e)) $test_facility_e=$test_facility->e; else $test_facility_e="";
			if(isset($test_facility->f)) $test_facility_f=$test_facility->f; else $test_facility_f="";
		}else{
			$test_facility_a="";$test_facility_b="";$test_facility_c="";$test_facility_d="";$test_facility_e="";$test_facility_f="";
		}
		if(!empty($results["lab_facility"])){
			$lab_facility=json_decode($results["lab_facility"]);
			if(isset($lab_facility->a)) $lab_facility_a=$lab_facility->a; else $lab_facility_a="";
			if(isset($lab_facility->b)) $lab_facility_b=$lab_facility->b; else $lab_facility_b="";
			if(isset($lab_facility->c)) $lab_facility_c=$lab_facility->c; else $lab_facility_c="";
		}else{
			$lab_facility_a="";$lab_facility_b="";$lab_facility_c="";
		}			
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive table-bordered">
										<tr>
											<td width="25%">1. Name of the applicant :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"/></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">2. Address of the applicant :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id :</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $email; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>Please select one option :<font class="mandatory_field">*</font></td>
											<td colspan="3">
											<select class="form-control text-uppercase" name="fees_description" required="required">
												<option value="">Please Select</option>
												<option <?php if($fees_description=="1") echo "selected"; ?> value="1">GCC/G.Lab/GC/USC Clinic/Imaging Clinic/IVF Clinic</option>
												<option <?php if($fees_description=="2") echo "selected"; ?> value="2">Institute,Hospital,Nurse Home or any place providing jointly the services of GCC/G.Lab/GC/USG CLinic Imaging Centre or any combinations thereof</option>											
											</select>
											
											</td>
										</tr>
										<tr>
											<td>3. Type of facility to be registered :</td>
											<td colspan="3">
												<label class="checkbox-inline"><input type="checkbox" <?php if($facility_type_a=="Genetic Counselling Center") echo "checked"; ?> name="facility_type[a]" value="Genetic Counselling Center">Genetic Counselling Center&nbsp;&nbsp; </label>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($facility_type_b=="Genetic Laboratory") echo "checked"; ?> name="facility_type[b]" value="Genetic Laboratory">Genetic Laboratory&nbsp;&nbsp; </label>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($facility_type_c=="Genetic Clinic") echo "checked"; ?> name="facility_type[c]" value="Genetic Clinic">Genetic Clinic &nbsp;&nbsp; </label>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($facility_type_d=="Ultrasound Clinic") echo "checked"; ?> name="facility_type[d]" value="Ultrasound Clinic">Ultrasound Clinic &nbsp;&nbsp; </label>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($facility_type_e=="Imaging Centre") echo "checked"; ?> name="facility_type[e]" value="Imaging Centre">Imaging Centre&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
											<td colspan="4">4. Full name and address/ addresses of Genetic Counselling Center/ Genetic Laboratory/Genetic Clinic/Ultrasound Clinic/ Imaging Centre with Telephone/ Fax namber(s)/ Telegraphic/telex/E-mail address(s). :
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="35%">Name</th>
													<th width="30">Address</th>
													<th width="30%">Contact No.</th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["address"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["contact_no"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" validate="mobileNumber" maxlength="10" name="txtD<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" validate="mobileNumber" maxlength="10" name="txtD1"></td>	
													</tr>
													<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td width="25%">5. Type of ownership of Organisation (individual ownership/partnership/company/ cooperative/any other to be specified) :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
											<td width="25%">6. Type of Institution :<span class="mandatory_field">*</span></td>
											<td width="25%"><select class="form-control text-uppercase" required="required" name="type_of[institution]">
												<option value="disabled">Please Select</option>
												<option value="Govt. Hospital" <?php if($type_of_institution=="Govt. Hospital") echo "selected";?> >Govt. Hospital</option>
												<option value="Municipal Hospital" <?php if($type_of_institution=="Municipal Hospital") echo "selected";?>>Municipal Hospital</option>
												<option value="Public Hospital" <?php if($type_of_institution=="Public Hospital") echo "selected";?>>Public Hospital</option>
												<option value="Private hospital" <?php if($type_of_institution=="Private hospital") echo "selected";?>>Private hospital</option>
												<option value="private Nursing Home" <?php if($type_of_institution=="private Nursing Home") echo "selected";?>>private Nursing Home</option>
												<option value="Private Clinic" <?php if($type_of_institution=="Private Clinic") echo "selected";?>>Private Clinic</option>
												<option value="Private Laboratory" <?php if($type_of_institution=="Private Laboratory") echo "selected";?>>Private Laboratory</option>
												<option value="Any Other" <?php if($type_of_institution=="Any Other") echo "selected";?>>Any Other</option>
											</select></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>		
										<tr>
											<td colspan="2">7. Specific pre-natal diagnostic procedures/ tests for which approval is sought (a) Invasive :</br>(Leave blank if registration is sought for Genetic Counselling Center only.)</td>
											<td colspan="2">&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_invasive_a=="Amnocentesis") echo "checked"; ?> name="specific_invasive[a]" value="Amnocentesis"> Amnocentesis&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_invasive_b=="Chorionic Villi Aspiration") echo "checked"; ?> name="specific_invasive[b]" value="Chorionic Villi Aspiration">Chorionic Villi Aspiration&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_invasive_c=="Chromosomal") echo "checked"; ?> name="specific_invasive[c]" value="Chromosomal">Chromosomal &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_invasive_d=="Biochemical") echo "checked"; ?> name="specific_invasive[d]" value="Biochemical">Biochemical&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_invasive_e=="Molecular Studies") echo "checked"; ?> name="specific_invasive[e]" value="Molecular Studies">Molecular Studies&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
											<td width="25%">(b) Non-Invasive :</td>
											<td width="25%">
												<label class="checkbox-inline"><input type="checkbox" <?php if($specific_non_invasive_a=="Ultrasonography") echo "checked"; ?> name="specific_non_invasive[a]" value="Ultrasonography"> Ultrasonography&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
											<td  width="25%">8. (a) Facilities available in the Counselling Centre:</td>
											<td  width="25%"><input type="text" class="form-control text-uppercase" name="facilities_avail" value="<?php echo  $facilities_avail; ?>"	></td>
										</tr>
										<tr>
											<td colspan="2">(b) Whether facilities are or would be available in the Laboratory/ Clinic for the following tests :</td>
											<td colspan="2">&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_a=="Ultrasound") echo "checked"; ?> name="test_facility[a]" value="Ultrasound"> (i) Ultrasound&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_b=="Amniocentesis") echo "checked"; ?> name="test_facility[b]" value="Amniocentesis">(ii) Amniocentesis&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_c=="Chorionic Villi Aspiration") echo "checked"; ?> name="test_facility[c]" value="Chorionic Villi Aspiration">(iii) Chorionic Villi Aspiration &nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_d=="Foetoscopy") echo "checked"; ?> name="test_facility[d]" value="Foetoscopy">(iv) Foetoscopy&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_e=="Foetal Biopsy") echo "checked"; ?> name="test_facility[e]" value="Foetal Biopsy">(v) Foetal Biopsy&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($test_facility_f=="Cordocentesis") echo "checked"; ?> name="test_facility[f]" value="Cordocentesis">(vi) Cordocentesis&nbsp;&nbsp; </label>
											</td>
										</tr>
										<tr>
											<td colspan="2">Whether facilities are available in rhe Laboratory/Clinic for the following :</td>
											<td colspan="2">&nbsp;&nbsp;
												<label class="checkbox-inline"><input type="checkbox" <?php if($lab_facility_a=="Chromosomal Studies") echo "checked"; ?> name="lab_facility[a]" value="Chromosomal Studies">(i) Chromosomal Studies&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($lab_facility_b=="Biochemical Studies") echo "checked"; ?> name="lab_facility[b]" value="Biochemical Studies">(ii) Biochemical Studies&nbsp;&nbsp; </label>
												<label class="checkbox-inline"><input type="checkbox" <?php if($lab_facility_c=="Molecular Studies") echo "checked"; ?> name="lab_facility[c]" value="Molecular Studies">(iii) Molecular Studies &nbsp;&nbsp; </label></br>
											</td>
										</tr>
										<tr>
											<td colspan="3">9. State whether the Genetic Counselling Centre/ Genetic Laboratory/ Genetic Clinic/ultrasound clinic/imaging centre qualifies for registration in terms of requirements laid down in Rule 3] :</td>
											<td><input type="text" class="form-control" name="state_details"  value="<?php echo  $state_details; ?>"></td>											
										</tr>
										<tr>
											<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
												Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
												Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
										</tr>										
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save &amp; Next</button>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
	$('#Year, #Year2').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		if($(this).children('option').length == 1)
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
			$(this).append($('<option />').val(i).html(i));
		}
	});
	/* ------------------------------------------------------ */		
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
</script>