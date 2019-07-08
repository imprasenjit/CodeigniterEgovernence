<?php  require_once "../../requires/login_session.php";
$dept="mines";
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
			$form_id=$results["form_id"];$profession=$results["profession"];$permit=$results["permit"];$minerals=$results["minerals"];$prospect=$results["prospect"];$is_residential=$results["is_residential"];
			$circle_name=$results["circle_name"];$forest_range=$results["forest_range"];$felling_series=$results["felling_series"];$nature_joint=$results["nature_joint"];
			$resource=$results["resource"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}	
			if(!empty($results["area"])){
				$area=json_decode($results["area"]);
				$area_a=$area->a;$area_b=$area->b;
			}else{				
				$area_a="";$area_b="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num;
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}
		}else{
			$form_id="";$profession="";$permit="";$minerals="";$prospect="";$is_residential="";$nature_joint="";$resource="";$circle_name="";$forest_range="";$felling_series="";
			$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			$clearance_dt="";$clearance_num="";
			$period_from_dt="";$period_to_dt="";
			$area_a="";$area_b="";
			$particulars_a="";$particulars_b="";$particulars_c="";
        }
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];$profession=$results["profession"];$permit=$results["permit"];$minerals=$results["minerals"];$prospect=$results["prospect"];$is_residential=$results["is_residential"];
			$circle_name=$results["circle_name"];$forest_range=$results["forest_range"];$felling_series=$results["felling_series"];$nature_joint=$results["nature_joint"];
			$resource=$results["resource"];
			
			if(!empty($results["applicant"])){
				$applicant=json_decode($results["applicant"]);
				$applicant_firm_asso=$applicant->firm_asso;$applicant_nation=$applicant->nation;$applicant_reg_number=$applicant->reg_number;
			}else{				
				$applicant_firm_asso="";$applicant_nation="";$applicant_reg_number="";
			}	
			if(!empty($results["area"])){
				$area=json_decode($results["area"]);
				$area_a=$area->a;$area_b=$area->b;
			}else{				
				$area_a="";$area_b="";
			}				
			if(!empty($results["clearance"])){
				$clearance=json_decode($results["clearance"]);
				$clearance_dt=$clearance->dt;$clearance_num=$clearance->num;
			}else{				
				$clearance_dt="";$clearance_num="";
			}				
			if(!empty($results["period"])){
				$period=json_decode($results["period"]);
				$period_from_dt=$period->from_dt;$period_to_dt=$period->to_dt;
			}else{				
				$period_from_dt="";$period_to_dt="";
			}				
			if(!empty($results["particulars"])){
				$particulars=json_decode($results["particulars"]);
				$particulars_a=$particulars->a;$particulars_b=$particulars->b;$particulars_c=$particulars->c;
			}else{				
				$particulars_a="";$particulars_b="";$particulars_c="";
			}	
		
	}
	
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
								  
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
										
											<td colspan="1">1. Name of the applicant :</td>
											<td colspan="1"><input type="text" class="form-control text-uppercase"  disabled="disabled" readonly="readonly"  value="<?php echo $key_person; ?>" ></td>
											<td colspan="2"></td>
											
										</tr>
										<tr>
											<td colspan="4">2. Full Postal Address with Pin code and contact telephone No :</td>
										</tr>
										<tr>										
											<td width="25%">Street Name1 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td width="25%">Street Name2 :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>
										
										<tr>
											<td >3. Legal Entity of the Business or Constitution of Business :</td>
											<td ><input type="text" class="form-control" disabled="disabled" value="<?php echo strtoupper($Type_of_ownership); ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>										
										<tr>
											<td colspan="4">4. In case applicant is :</td>
										</tr>
										<tr>
											<td>(a) an individual, his nationality :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[nation]" value="<?php echo $applicant_nation; ?>"></td>
											<td>(b) a company, an attested copy of the certificate of registration of the company shall be enclosed :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant[reg_number]"  value="<?php echo $applicant_reg_number; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">(c) firm or association, the nationality of all the Partners of the firm or members of the association :</td>
											<td><textarea class="form-control text-uppercase" name="applicant[firm_asso]" ><?php echo $applicant_firm_asso; ?></textarea></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										
										<tr>
											<td>5. Profession or nature of business of applicant :</td>
											<td><input type="text" class="form-control text-uppercase" name="profession" validate="letters" value="<?php echo $profession; ?>"></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">6a. No. and date of the valid clearance certificate of payment of mining dues(copy attached) :</td>
										</tr>
										<tr>
											<td>Number :</td>
											<td><input type="text" class="form-control text-uppercase" name="clearance[num]"  value="<?php echo $clearance_num; ?>"></td>
											<td>Date :</td>
											<td><input type="text" class="dob form-control text-uppercase" name="clearance[dt]"  value="<?php echo $clearance_dt; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">6b. If on the date of application the applicant does not hold a prospecting licence, it should be stated whether an affidavit to this effect has been furnished to the satisfaction of the State Government. :</td>
											<td><textarea class="form-control text-uppercase" name="permit" ><?php echo $permit; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="3">7. Mineral or minerals which the applicant intends to prospect :</td>
											<td><input type="text" class="form-control text-uppercase" name="minerals"  value="<?php echo $minerals; ?>"></td>
										</tr>
										<tr>
											<td>8. Period for which the prospecting licence is required :<span class="mandatory_field">*</span></td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[from_dt]" placeholder="Form Date" value="<?php echo $period_from_dt; ?>"></td>
											<td>To</td>
											<td><input type="text" class=" dob form-control text-uppercase" name="period[to_dt]" placeholder="To Date" value="<?php echo $period_to_dt; ?>"></td>
										</tr>
										
									<tr>										
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
									</table>
									</form>
								</div>
									
								
								
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
									
										<tr><td >9. Extent of the area the applicant wants to prospect :<span class="mandatory_field">*</span></td>
											<td ><input type="text" class="form-control text-uppercase" name="prospect" value="<?php echo $prospect; ?>"></td></tr>
											
										<tr><td colspan="4">10. Details of the area in respect of which prospecting licence is required :</td>
										</tr>	
										<tr>
										<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="20%">District</th>
													<th width="15">Taluq</th>
													<th width="15%">Village</th>
													<th width="15%">Khasra No.</th>
													<th width="15">Plot No.</th>
													<th width="15%">Area</th>
												</tr>
												</thead>
												<?php
													$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
													
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														
														<td><input type="text" readonly id="textA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														
														<td><input type="text"  id="textB<?php echo $count;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $row_1["district"]; ?>" name="textB<?php echo $count;?>" size="20"></td>
														<td><input type="text" value="<?php echo $row_1["taluq"]; ?>" id="textC<?php echo $count;?>"  class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>			
														<td><input type="text" value="<?php echo $row_1["village"]; ?>" id="textD<?php echo $count;?>"  class="form-control text-uppercase" name="textD<?php echo $count;?>"   size="10"></td>
														<td><input type="text" value="<?php echo $row_1["khasra_no"]; ?>" id="textE<?php echo $count;?>"  name="textE<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["plot_no"]; ?>" id="textF<?php echo $count;?>"  name="textF<?php echo $count;?>" class="form-control text-uppercase"></td>
														<td><input type="text" value="<?php echo $row_1["area"]; ?>" id="textG<?php echo $count;?>"  name="textG<?php echo $count;?>" class="form-control text-uppercase"></td>
														
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="textA1" size="1"  class="form-control text-uppercase"  name="textA1"></td>
														<td><input  type="text" id="textB1"  class="form-control text-uppercase" validate="letters" name="textB1"></td>
														<td><input type="text" id="textC1" title="No special characters are allowed except Dot"   class="form-control text-uppercase" name="textC1" size="20"></td>					
														<td><input type="text"  id="textD1"  class="form-control text-uppercase" name="textD1"  size="20"></td>
														<td><input type="text" id="textE1"  class="form-control text-uppercase" name="textE1"  size="10"></td>
														<td><input type="text" id="textF1"  class="form-control text-uppercase" name="textF1"  size="10"></td>
														<td><input type="text" id="textG1"  class="form-control text-uppercase" name="textG1"  size="10"></td>
													</tr>
													<?php } ?>
											</table>	
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="addMorefunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div>
										</td>
									</tr>

									<tr>
										<td colspan="3">11. Does the applicant have surface rights over the area for which he requires a prospecting licence?</td>
										<td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_residential=="Y" || $is_residential=="") echo "checked"; ?> id="inlineRadio1" name="is_residential"> Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($is_residential=="N") echo "checked"; ?> id="inlineRadio1" name="is_residential"> No </label></td>
									</tr>
									
									
									<tr><td colspan="4" >12. Brief description of the area with Particular reference to the following :</td></tr>
									<tr>
											<td width="25%"> (a) The situation of the area in respect to natural features such as streams etc : </td>
											<td width="25%"><input  type="text" name="area[a]" value="<?php echo $area_a; ?>" class="form-control text-uppercase" ></td>			
											<td width="25%"> (b) In the case of village, areas, the name of the village : </td>
											<td width="25%"><input  type="text" name="area[b]" value="<?php echo $area_b; ?>" class="form-control text-uppercase" ></td>
									</tr>
									<tr>
											<td colspan="4" > (c) In the case of forest areas, </td></tr>
									<tr>
											<td width="25%" > The name of the working circle : </td>
											<td width="25%"><input  type="text" name="circle_name" value="<?php echo $circle_name; ?>" class="form-control text-uppercase" ></td>
									
											<td width="25%"> The range : </td>
											<td width="25%"><input  type="text" name="forest_range" value="<?php echo $forest_range; ?>" class="form-control text-uppercase" ></td>
									</tr>
									<tr>
											<td > The felling series. : </td>
											<td ><input  type="text" name="felling_series" value="<?php echo $felling_series; ?>" class="form-control text-uppercase" ></td>
									</tr>
										
									<tr>
										<td colspan="4">13.Particulars of the areas mineral-wise within the jurisdiction of the State Government for which the applicant or any person joint in interest with him :</td>
									</tr>
									<tr>
										<td>(a) Already holds under prospecting licence :</td>
										<td><input  type="text" name="particulars[a]" value="<?php echo $particulars_a; ?>" class="form-control text-uppercase" ></td>
										<td>(b) Has already applied for but not granted :</td>
										<td><input  type="text" name="particulars[b]" value="<?php echo $particulars_b; ?>" class="form-control text-uppercase" ></td>
									</tr>
									<tr>
										<td>(c) Being applied for simultaneously :</td>
										<td><input  type="text" name="particulars[c]" value="<?php echo $particulars_c; ?>" class="form-control text-uppercase" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td>14. Nature of joint in interest, if any. :</td>
										<td><input  type="text" name="nature_joint" value="<?php echo $nature_joint; ?>" class="form-control text-uppercase" ></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td colspan="4">15. If the applicant intends to supervise the works, his previous experience of prospecting and mining should be explained :</td>
									</tr>
									<tr>
										<td colspan="4">
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
															<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_2["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input type="txt" value="<?php echo $row_2["qualification"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input type="text" value="<?php echo $row_2["experience"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="txtA1" size="1"  class="form-control text-uppercase"  name="txtA1"></td>
														<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
														<td><input type="text" id="txtC1" size="10" class="form-control text-uppercase" name="txtC1"></td>
														<td><input type="text" id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
													</tr>
													<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px">
												<button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
											</div>
										</td>
									</tr>
									<tr>
										<td>16. Financial resources of the applicant. :</td>
										<td><input validate="specialChar" type="text" name="resource" value="<?php echo $resource; ?>" class="form-control text-uppercase" ></td>
										<td></td>
										<td></td>
									</tr>							
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/>
											Place: <strong><?php echo strtoupper($dist)?></strong></td>
										
										<td colspan="4" align="right">Designation of the Applicant&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($status_applicant)?></strong><br>
										Signature of the Applicant&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/></td>
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
										<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>b" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>

	$('input[name="is_residential"]').on('change', function(){
		if($(this).val() == 'N')
			$('.is_residential').attr('disabled', 'disabled');
		else
			$('.is_residential').removeAttr('disabled');
	}); 	

</script>