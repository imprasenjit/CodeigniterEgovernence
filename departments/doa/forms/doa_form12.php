<?php  require_once "../../requires/login_session.php";
$dept="doa";
$form="12";
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
				$form_id=$results["form_id"];$is_applicant=$results["is_applicant"];$type_f_pest=$results["type_f_pest"];$is_trade=$results["is_trade"];$trade_particulars=$results["trade_particulars"];$situation=$results["situation"];$pest_control=$results["pest_control"];$full_particular=$results["full_particular"];$tech_person=$results["tech_person"];$contact_no=$results["contact_no"];$name=$results["name"];$father_name=$results["father_name"];$vill=$results["vill"];$operation=$results["operation"];$po=$results["po"];$quali=$results["quali"];$report_year=$results["report_year"];	
			}else{
				 $form_id="";$is_applicant="";$type_f_pest="";$is_trade="";$trade_particulars="";$situation="";$pest_control="";$full_particular="";$tech_person="";$contact_no="";$name="";$father_name="";$vill="";$operation="";$po=""; $quali="";$report_year="";
			}
		}else{			
			$results=$q->fetch_array();
			$form_id=$results["form_id"];$is_applicant=$results["is_applicant"];$type_f_pest=$results["type_f_pest"];$is_trade=$results["is_trade"];$trade_particulars=$results["trade_particulars"];$situation=$results["situation"];$pest_control=$results["pest_control"];$full_particular=$results["full_particular"];$tech_person=$results["tech_person"];$contact_no=$results["contact_no"];$name=$results["name"];$father_name=$results["father_name"];$vill=$results["vill"];$operation=$results["operation"];$po=$results["po"];$quali=$results["quali"];$report_year=$results["report_year"];	
		}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
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
								<h4 class="text-center text-bold" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">PART 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">PROFORMA –I</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a  href="javascript:void(0)">PROFORMA –II</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
											<td width="25%">1. i. Full name of the applicant:</td>
											<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">ii. Address of the applicant</td>
										</tr>
										<tr>
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2:</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No:</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>Email Id:</td>
											<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>2. Is the applicant a new comer</td>
											<td><label class="radio-inline"><input type="radio" name="is_applicant" class="is_applicant" value="Y"  <?php if(isset($is_applicant) && $is_applicant=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_applicant"  value="N"  name="is_applicant" <?php if(isset($is_applicant) && ($is_applicant=='N' || $is_applicant=='')) echo 'checked'; ?>/> No</label></td>
											<td>(a) If Yes the type of Pest control operation in which the applicant prepared to deal.</td>
											<td><textarea type="text" name="type_f_pest" id="type_f_pest" class="form-control text-uppercase" maxlength="255"><?php echo $type_f_pest; ?></textarea></td>
										</tr>
										<tr>
											<td>3. If the applicant has been in the trade</td>
											<td><label class="radio-inline"><input type="radio" name="is_trade" class="is_trade" value="Y"  <?php if(isset($is_trade) && $is_trade=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_trade"  value="N"  name="is_trade" <?php if(isset($is_trade) && ($is_trade=='N' || $is_trade=='')) echo 'checked'; ?>/> No</label></td>
											<td>(a) Give full particulars</td>
											<td><textarea name="trade_particulars" id="trade_particulars" class="form-control text-uppercase" maxlength="255"><?php echo $trade_particulars; ?> </textarea></td>
										</tr>
										<tr>
											<td>4. Situation of the operator&#39;s premises and area of operation.</td>
											<td><textarea name="situation" class="form-control text-uppercase" maxlength="255"><?php echo $situation; ?></textarea></td>
											<td>5. The type of pest control operation</td>
											<td><textarea type="text" name="pest_control" class="form-control text-uppercase" maxlength="255"><?php echo $pest_control; ?></textarea></td>
										</tr>
										<tr>
											<td>6. Full particulars of licence issued by other State Govt.if any, in their area.</td>
											<td><textarea type="text" name="full_particular" class="form-control text-uppercase" maxlength="255"><?php echo $full_particular; ?></textarea></td>
											<td>7. Name of the Technical Person/ Technical Expert who will be service the operation and expectance certificate.</td>
											<td><input validate="letters" type="text" name="tech_person" value="<?php echo $tech_person; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td>8. Contact No.</td>
											<td><input validate="mobileNumber" type="text" name="contact_no" value="<?php echo $contact_no; ?>" class="form-control text-uppercase" maxlength="10"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">Declaration<br/>
											I declare that the information given above is true to the best of my knowledge and belief and no part there if is false.</td>
										</tr>
										<tr>
											<td colspan="2" width="50%">DATE :<label ><?php echo $today;?></label><br/>
											PLACE:<label ><?php echo $dist;?></label></td>
											<td colspan="2" width="50%">SIGNATURE OF THE APPLICANT: <strong><?php echo strtoupper($key_person)?></strong></td>
											<td></td>
										</tr>	
										<tr>
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									   </td>
								    </tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="4" align="center"><u>TO WHOM IT MAY CONCERN</u></td>
									</tr>
									<tr>
										<td colspan="4" class="form-inline">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; This is to certified that, &nbsp;<input validate="letters" type="text" name="name" value="<?php echo $name; ?>" class="form-control text-uppercase" > &nbsp; Son of &nbsp; <input validate="letters" type="text" name="father_name" value="<?php echo $father_name; ?>" class="form-control text-uppercase"> &nbsp; Vill- &nbsp; <input  type="text" name="vill" value="<?php echo $vill; ?>" class="form-control text-uppercase"> &nbsp; do hereby undertake the responsibility of supervising the commercial pest control operation of &nbsp; <input  type="text" name="operation" value="<?php echo $operation; ?>" class="form-control text-uppercase"> &nbsp; P.O. &nbsp; <input  type="text" name="po" value="<?php echo $po; ?>" class="form-control text-uppercase"> &nbsp; for a period of two years subject to the issue of commercial pest control operation&#39;s license from the Licensing authority of Assam.<br/><br/>
										
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Further, I declare that I am not an employee to the Central/State/Semi Govt. organization and shall no under supervise ship to any other firm during the period.
										</td>
									</tr>
									<tr>
										<td>Signature of "Technical Expert"<br/>(Full name and Qualification)</td>
										<td><textarea type="text" name="quali" class="form-control text-uppercase" maxlength="255"><?php echo $quali; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
									   </td>
								    </tr>
								</table>
								</form>
								</div>
								<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td colspan="2" width="50%">Annual report of commercial pest control operation for the year</td>
										<td width="25%"><input  type="text" validate="onlyNumbers" maxlength="4" name="report_year" value="<?php echo $report_year; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									   <td colspan="4">Particulars of trade articles in which the applicant wants to carry on business as a :</td>
									</tr>
									<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
												<tr>
													<th width="5%">Slno</th>
													<th width="15%">Name of firm</th>
													<th width="20%">Stock position of different equipments</th>
													<th width="20%">Stock of safety equipments</th>
													<th width="20%">No of operator engaged</th>
													<th width="20%">Detail of the job done if any during the period.</th>
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
														<td><input type="text" value="<?php echo $row_1["position"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["safety"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["operator"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["job_done"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtF<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
													<td><input type="text" id="txtE1" size="10" class="form-control text-uppercase" name="txtE1"></td>
													<td><input type="text" id="txtF1" size="10" class="form-control text-uppercase" name="txtF1"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=2"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>c" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('#type_f_pest').attr('readonly','readonly');
	<?php if($is_applicant == 'Y') echo "$('#type_f_pest').removeAttr('readonly','readonly');"; ?>
	$('.is_applicant').on('change', function(){
		if($(this).val() == 'Y'){
			$('#type_f_pest').removeAttr('readonly','readonly');
		}else{
			$('#type_f_pest').attr('readonly','readonly');
			$('#type_f_pest').val('');
		}			
	});
	$('#trade_particulars').attr('readonly','readonly');
		<?php if($is_trade == 'Y') echo "$('#trade_particulars').removeAttr('readonly','readonly');"; ?>
		$('.is_trade').on('change', function(){
			if($(this).val() == 'Y'){
				$('#trade_particulars').removeAttr('readonly','readonly');
			}else{
				$('#trade_particulars').attr('readonly','readonly');
				$('#trade_particulars').val('');
			}			
		});
</script>