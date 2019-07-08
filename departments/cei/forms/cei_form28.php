<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="28";
$ci->load->helper('get_uain_details');
$table_name=getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;
	if($q->num_rows<1){	
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$manager_name=$results['manager_name'];$location_details=$results['location_details'];$is_apdcl=$results['is_apdcl'];$connected_load=$results['connected_load'];$sanction_load=$results['sanction_load'];$name_authority=$results['name_authority'];$sanction_dt=$results['sanction_dt'];$ref_sanction=$results['ref_sanction'];$sub_division=$results['sub_division'];$e_division=$results['e_division'];$proposed_load=$results['proposed_load'];$interlock_changeover=$results['interlock_changeover'];$isolated_mode=$results['isolated_mode'];$protection_generator=$results['protection_generator'];$designation_competency=$results['designation_competency'];$is_installation=$results['is_installation'];	$is_installation_details=$results['is_installation_details'];$contractor_person=$results['contractor_person'];
			
			
		if(!empty($results["generator"]))
		    {
			 $generator=json_decode($results["generator"]);
			 $generator_m=$generator->m;$generator_l=$generator->l;
		   }else{
			 $generator_m="";$generator_l="";
		    }
			
		if(!empty($results["other_speci"])){
			$other_speci=json_decode($results["other_speci"]);
			if(isset($other_speci->a)) $other_speci_a=$other_speci->a; else $other_speci_a="";
			if(isset($other_speci->b)) $other_speci_b=$other_speci->b; else $other_speci_b="";
			if(isset($other_speci->c)) $other_speci_c=$other_speci->c; else $other_speci_c="";
			
		}else{
			$other_speci_a="";$other_speci_b="";$other_speci_c="";
			 
		}	
		if(!empty($results["installation"])){
			$installation=json_decode($results["installation"]);
			$installation_edate=$installation->edate;$installation_cdate=$installation->cdate;$installation_commdate=$installation->commdate;
		}else{
			$installation_edate="";$installation_cdate="";$installation_commdate="";
		}
			
			
		}else{
			$form_id="";
			$manager_name="";$location_details="";$is_apdcl="";$connected_load="";$sanction_load="";$name_authority="";$sanction_dt="";$ref_sanction="";$sub_division="";$e_division="";$proposed_load="";$interlock_changeover="";$generator_m="";$generator_l="";$other_speci_a="";$other_speci_b="";$other_speci_c="";$isolated_mode="";$protection_generator="";$installation_edate="";$installation_cdate="";$installation_commdate="";
			$designation_competency="";$is_installation="";$is_installation_details="";$contractor_person="";
			
		}

	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$manager_name=$results['manager_name'];$location_details=$results['location_details'];$is_apdcl=$results['is_apdcl'];$connected_load=$results['connected_load'];$sanction_load=$results['sanction_load'];$name_authority=$results['name_authority'];$sanction_dt=$results['sanction_dt'];$ref_sanction=$results['ref_sanction'];$sub_division=$results['sub_division'];$e_division=$results['e_division'];$proposed_load=$results['proposed_load'];$interlock_changeover=$results['interlock_changeover'];$isolated_mode=$results['isolated_mode'];$protection_generator=$results['protection_generator'];$designation_competency=$results['designation_competency'];$is_installation=$results['is_installation'];	$is_installation_details=$results['is_installation_details'];$contractor_person=$results['contractor_person'];
		
		if(!empty($results["generator"]))
		{
			$generator=json_decode($results["generator"]);
			$generator_m=$generator->m;$generator_l=$generator->l;
		}else{
			$generator_m="";$generator_l="";
		}
		if(!empty($results["other_speci"])){
			$other_speci=json_decode($results["other_speci"]);
			if(isset($other_speci->a)) $other_speci_a=$other_speci->a; else $other_speci_a="";
			if(isset($other_speci->b)) $other_speci_b=$other_speci->b; else $other_speci_b="";
			if(isset($other_speci->c)) $other_speci_c=$other_speci->c; else $other_speci_c="";
			
		}else{
			$other_speci_a="";$other_speci_b="";$other_speci_c="";
			 
		}	
		if(!empty($results["installation"])){
				$installation=json_decode($results["installation"]);
				$installation_edate=$installation->edate;$installation_cdate=$installation->cdate;$installation_commdate=$installation->commdate;
			}else{
				$installation_edate="";$installation_cdate="";$installation_commdate="";
			}
	}
	

##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
	}
	##PHP TAB management ends

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
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">								
									
									<tr>
										<td colspan="4">1. Details of the Applicant </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $key_person; ?>"></td>
										<td width="25%">Manager/Executive or Officer-in-Charge :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="manager_name" value="<?php echo $manager_name; ?>"></td>
									</tr>
									<tr>
										<td width="25%">Full Postal Address &amp; Phone No :</td>
										<td width="25%"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email Id:</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
									    <td colspan="2">2. Location or the proposed location of D. G. set(s) with full Postal Addrcss:</td>
										<td><textarea class="form-control text-uppercase" name="location_details" validate="textarea"><?php echo $location_details;?></textarea></td>
									</tr>
									<tr>
										<td colspan="4">3. Detail of Generator(s) </td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="20%">Sl. No.</th>
													<th width="20">Capacity(KW/KVA)</th>
													<th width="20%">Rated Voltage in volts </th>
													<th width="10%">Make and Serial Number</th>
													<th width="10%"></th>
													<th width="20">Make and Serial Number of Generating Set.</th>
												</tr>
												<tr>
													<th width="20%"></th>
													<th width="20"></th>
													<th width="20%"></th>
													<th width="10%">Alternator</th>
													<th width="10%">Engine</th>
													<th width="20"></th>
												</tr>
												</thead>
												
												
												
												<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input type="text"  id="txtB<?php echo $count;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $row_1["capacity"]; ?>" name="txtB<?php echo $count;?>" size="20"></td>
														<td><input type="text" value="<?php echo $row_1["voltage"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>			
														<td><input type="text" value="<?php echo $row_1["alternator"]; ?>" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" name="txtD<?php echo $count;?>"   size="10"></td>
														<td><input type="text" value="<?php echo $row_1["engine"]; ?>" id="txtE<?php echo $count;?>"  name="txtE<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["serial_no"]; ?>" id="txtF<?php echo $count;?>"  name="txtF<?php echo $count;?>" class="form-control text-uppercase"></td>
														
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="txtA1" size="1"  class="form-control text-uppercase"  name="txtA1"></td>
														<td><input  type="text" id="txtB1"  class="form-control text-uppercase" validate="letters" name="txtB1"></td>
														<td><input type="text" id="txtC1" title="No special characters are allowed except Dot"   class="form-control text-uppercase" name="txtC1" size="20"></td>					
														<td><input type="text"  id="txtD1"  class="form-control text-uppercase" name="txtD1"  size="20"></td>
														<td><input type="text" id="txtE1"  class="form-control text-uppercase" name="txtE1"  size="10"></td>
														<td><input type="text" id="txtF1"  class="form-control text-uppercase" name="txtF1"  size="10"></td>
														
														
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
									   <td colspan="3"><b>(Manufacturer's test reports on engine/turbine, alternator and Generator enclosers to be submitted along with this application. Installafion test result to be furnished in enclosed Annexures-Dc-I, DG-II & DG-III)</b></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
									</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							    <form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									
									<table id="" class="table table-responsive">
									 <tr>
										<td width="25%">4.Whether supply from APDCL/ Discom is available:</td>
										  <td colspan="2">
												<label class="radio-inline"><input type="radio" name="is_apdcl" value="Y"  <?php if(isset($is_apdcl) && $is_apdcl=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_apdcl"  value="N"  <?php if(isset($is_apdcl) && $is_apdcl=='N') echo 'checked'; ?>/> No</label>
											</td>
									 </tr>
                               </table>	
                               <table id="is_apdcl_yes" class="table table-responsive">
                                  <tr>
										<td width="25%">4.1 Total Connected Load :</td> 
										<td width="25%"><input type="text" class="form-control text-uppercase" name="connected_load" value="<?php echo $connected_load?>" ></td>
										<td width="25%">4.2 Total Sanction Load :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="sanction_load" value="<?php echo $sanction_load?>" ></td>
									 </tr>
									 <tr>
										<td width="25%">4.3 Date and reference of sanction(with name of authority which sanctioned) :</td> 
									</tr>
									<tr>
									   <td>Name of Authority :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name_authority" value="<?php echo $name_authority?>" ></td>
										<td width="25%">Date :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="sanction_dt" value="<?php echo $sanction_dt?>" ></td>
									 </tr>
									 <tr>
									   <td>Reference of sanction  :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="ref_sanction" value="<?php echo $ref_sanction?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>
									 </tr>
									 
                                 <tr>
										<td>4.4 Name of Electrical :</td> 
									</tr>
									<tr>
										<td width="25%">a) Sub-Division :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="sub_division" value="<?php echo $sub_division?>" ></td>
										<td width="25%">b) Division :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="e_division" value="<?php echo $e_division?>" ></td>
									</tr>
								    <tr>
										<td>4.5 Total proposed load to be supplied from the generator(s):</td> 
										<td><input type="text" class="form-control text-uppercase" name="proposed_load" value="<?php echo $proposed_load?>" ></td>
										<td>4.6 Details of interlock/changeover arrangement provided to prevent accidental paralleling of the generator with the supply system of Grid. :</td>
										<td><textarea class="form-control text-uppercase" name="interlock_changeover" validate="textarea" ><?php echo $interlock_changeover;?></textarea></td>
									</tr>
								</table>
                             <table id="" class="table table-responsive">									
									<tr>
										<td colspan="3">5. Details of Load proposed to be supplied from the generator(s) :</td> 
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td width="25%">5.1 Motor (AC) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="generator[m]" value="<?php echo $generator_m?>" ></td>
										<td width="25%">5.2 Light and Fans :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="generator[l]" value="<?php echo $generator_l?>" ></td>
									</tr>
                      
									<tr>
										<td>5.3 Other (to be specified) :</td>
										<td colspan="3">
										       
												<label class="checkbox-inline"><input type="checkbox" <?php if($other_speci_a=="P") echo "checked"; ?> name="other_speci[a]" value="P">Power Point&nbsp;&nbsp; </label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($other_speci_b=="R") echo "checked"; ?> name="other_speci[b]" value="R">Rectifier&nbsp;&nbsp;</label></br>
												<label class="checkbox-inline"><input type="checkbox" <?php if($other_speci_c=="F") echo "checked"; ?> name="other_speci[c]" value="F">Fire alarm&nbsp;&nbsp;</label>
										</td>
									</tr>
									<tr>
										<td colspan="2">6. Submit the following Drawings in duplicate :</td>
										<td></td>
									</tr>
									<tr>
										<td>6.1 Single Line Diagram of the installation :</td>
										<td>Upload later in upload section</td>
										<td>6.2 Physical layout drawing</td>
										<td>Upload later in upload section</td>
									</tr>
									<tr>
										<td>6.3 Earthing arrangement drawing :</td>
										<td>Upload later in upload section</td>
									</tr>
									<tr>
										<td colspan="3">Note: In the single line diagram, changeover arrangement/interlock arrangement to avoidaccidental connection of two different sources of supply need to be clearly shown with rating of all devices/equipment.</td>
									</tr>
								</table>
								 <table id="" class="table table-responsive">	
										<tr>
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>							
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>										
										</tr>
									</table>
									</form>
								</div>
                             <div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
								
									<tr>
										<td width="25%">7.A Indicate if the generators (in case more then one generator will be installed) will run in parallel or isolated mode. :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="isolated_mode" value="<?php echo $isolated_mode?>" ></td>
										<td>7.B Protection used for generator(s) :</td>
										<td><input type="text" class="form-control text-uppercase" name="protection_generator" value="<?php echo $protection_generator?>" ></td>
									</tr>
									<tr>
										<td>8.1   Expected date of starting the installation work :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="installation[edate]" value="<?php echo $installation_edate?>" ></td>
										<td>8.2 Expected date of completion of work :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="installation[cdate]" value="<?php echo $installation_cdate?>" ></td>
									</tr>
									<tr>
										<td>8.3 Expected date of commissioning :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="installation[commdate]" value="<?php echo $installation_commdate?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									  <td colspan="2">In cases installation are already completed detailed test reports will have to be submitted.</td>
									</tr>
									<tr>
										<td>9. Name of the contractor person through which the Electrical works connected with the installation is proposed to be done.</td>
										<td><input type="text" class="form-control text-uppercase" name="contractor_person" value="<?php echo $contractor_person?>" ></td>
										<td>10 Name of the person who will be authorised to operate the generator and electrical system connected to the generator, with designation and competency.</td>
										<td width="25%"><textarea name="designation_competency"  id="designation_competency" class="form-control text-uppercase"  ><?php echo $designation_competency; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="2">11. Is the matter of installation of Generator intimated to the Supplier ? If so, if any directive/guidelines received from them.:</td>
										<td>
											<label class="radio-inline"><input type="radio" name="is_installation" class="is_installation" value="Y"  <?php if(isset($is_installation) && $is_installation=='Y') echo 'checked'; ?>  /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="is_installation" name="is_installation"  value="N"  <?php if(isset($is_installation) && ($is_installation=='N' || $is_installation=='')) echo 'checked'; ?>/> No</label>
										</td>
										
									</tr>
									<tr>
									  <td colspan="2">If so, if any directive/guidelines received from them ?</td>
										<td width="25%"><textarea name="is_installation_details"  id="is_installation_details" class="form-control text-uppercase"  ><?php echo $is_installation_details; ?></textarea></td>
									</tr>
									<tr>
										<td colspan="2">Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>
										 Full Signature of the Applicant</td>
									</tr>									
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name; ?>.php?tab=2" type="button" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										 </td>											
										</tr>
									</table>
									</form>
								</div>
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
    $('#is_apdcl_yes').css('display','table');	 
	<?php if($is_apdcl == 'N' || $is_apdcl == '') echo "$('#is_apdcl_yes').css('display','none');"; ?>
	
	$('input[name="is_apdcl"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_apdcl_yes').css('display','table');			
		}else{
			$('#is_apdcl_yes').css('display','none');			
		}
	});
	$('#is_installation_details').attr('readonly','readonly');
	<?php if($is_installation == 'Y') echo "$('#is_installation_details').removeAttr('readonly','readonly');"; ?>
	$('.is_installation').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_installation_details').removeAttr('readonly','readonly');
		}else{
			$('#is_installation_details').attr('readonly','readonly');
			$('#is_installation_details').val('');
		}			
	});
	
	/* ----------------------------------------------------- */
	// /* ---------------------upload S/C click operation-------------------- */
	// <?php if($check!=0 && $check!=4){ ?>
		// $("#myform1 :input,select").prop("disabled", true);
	// <?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
</script>