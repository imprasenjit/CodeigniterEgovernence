<?php  require_once "../../requires/login_session.php";
$dept="mines";
$form="14";
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
			$lease_with_respect=$results["lease_with_respect"];$land_measure=$results["land_measure"];
			
			$is_statutory=$results["is_statutory"];$is_statutory_details1=$results["is_statutory_details1"];$is_statutory_details2=$results["is_statutory_details2"];
			
			$applicant_profession=$results["applicant_profession"];$applicant_nature=$results["applicant_nature"];$items=$results["items"];$period_of_license=$results["period_of_license"];$area_extent=$results["area_extent"];$area_description=$results["area_description"];$proposed_area=$results["proposed_area"];
			
			$area_mining_lease_a=$results["area_mining_lease_a"];
			$start_mining_date=$results["start_mining_date"];$targeted_production=$results["targeted_production"];$any_particulars=$results["any_particulars"];
			
			
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_area=$details->area;$details_dist=$details->dist;$details_subdivision=$details->subdivision;$details_area2=$details->area2;
			}else{				
				$details_area="";$details_dist="";$details_subdivision="";$details_area2="";
			}
			if(!empty($results["applied_area"])){
				$applied_area=json_decode($results["applied_area"]);
				$applied_area_dt1=$applied_area->dt1;$applied_area_lease=$applied_area->lease;$applied_area_dt2=$applied_area->dt2;$applied_area_production=$applied_area->production;
			}else{				
				$applied_area_dt1="";$applied_area_lease="";$applied_area_dt2="";$applied_area_production="";
			}
		}else{
			$form_id="";
			$lease_with_respect="";$land_measure="";
			$is_statutory="";
			$is_statutory_details1="";$is_statutory_details2="";
			$applicant_profession="";$applicant_nature="";$items="";$period_of_license="";$area_extent="";
			$details_area="";$details_dist="";$details_subdivision="";$details_area2="";
			$applied_area_dt1="";$applied_area_lease="";$applied_area_dt2="";$applied_area_production="";
			$area_description="";$proposed_area="";
			$area_mining_lease_a="";
			$start_mining_date="";$targeted_production="";$any_particulars="";
		}
	}else{
			$results=$q->fetch_array();
			$form_id=$results["form_id"];
			$lease_with_respect=$results["lease_with_respect"];$land_measure=$results["land_measure"];
			
			$is_statutory=$results["is_statutory"];$is_statutory_details1=$results["is_statutory_details1"];$is_statutory_details2=$results["is_statutory_details2"];
			
			$applicant_profession=$results["applicant_profession"];$applicant_nature=$results["applicant_nature"];$items=$results["items"];$period_of_license=$results["period_of_license"];$area_extent=$results["area_extent"];$area_description=$results["area_description"];$proposed_area=$results["proposed_area"];
			
			$area_mining_lease_a=$results["area_mining_lease_a"];
			$start_mining_date=$results["start_mining_date"];$targeted_production=$results["targeted_production"];$any_particulars=$results["any_particulars"];
			
			
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);
				$details_area=$details->area;$details_dist=$details->dist;$details_subdivision=$details->subdivision;$details_area2=$details->area2;
			}else{				
				$details_area="";$details_dist="";$details_subdivision="";$details_area2="";
			}
			if(!empty($results["applied_area"])){
				$applied_area=json_decode($results["applied_area"]);
				$applied_area_dt1=$applied_area->dt1;$applied_area_lease=$applied_area->lease;$applied_area_dt2=$applied_area->dt2;$applied_area_production=$applied_area->production;
			}else{				
				$applied_area_dt1="";$applied_area_lease="";$applied_area_dt2="";$applied_area_production="";
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
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">To,</td>
										</tr>
										<tr>
											<td colspan="4">THE SECRETARY TO THE GOVT. OF ASSAM,</br>MINES AND MINERALS,</br>DISPUR, GUWAHATI-6</br>(THROUGH THE DIRECTOR, DIRECTORATE OF GEOLOGY AND MINING, ASSAM, KAHILIPARA, GUWAHATI-19.)</td>
										</tr>
										<tr>
											<td colspan="4">Sir,</td>
										</tr>
										<tr>
											<td colspan="4" class="form-inline">&emsp;I/We request for re-grant of Petroleum Exploration License / Petroleum Mining lease under the P&amp; NG Rule 1959(Amendment Rule 2003) with respect to <input type="text" name="lease_with_respect" class="form-control text-uppercase" value="<?php echo $lease_with_respect; ?>"> Area admeasuring <input type="text" name="land_measure" class="form-control text-uppercase" value="<?php echo $land_measure; ?>"> Sq.Km in <input type="text" class="form-control text-uppercase" value="<?php echo $dist; ?>" disabled> District Assam. </td>
											
										</tr>
										<tr>
											<td colspan="4">1. Name of the applicant with complete address :</td>
										</tr>
										<tr>
											<td width="25%">Name of the applicant :</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"/></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4">Address of the applicant :</td>
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
											<td>2. Is the applicant a private individual/private ?</td>
											<td><input type="text" class="form-control" disabled="disabled"  value="<?php echo  $Type_of_ownership; ?>"></td>
										</tr>
										
										<tr>
											<td>3. If the applicant is a statutory corporation? </br>If so give details :</td>
											<td><label class="radio-inline"><input type="radio" name="is_statutory" class="is_statutory" value="Y"  <?php if(isset($is_statutory) && $is_statutory=='Y') echo 'checked'; ?> /> Yes</label>
											<label class="radio-inline"><input type="radio" class="is_statutory"  value="N"  name="is_statutory" <?php if(isset($is_statutory) && ($is_statutory=='N' || $is_statutory=='')) echo 'checked'; ?>/> No</label></td>
										</tr>
										<tr>
											<td>Name of the Act :</td>
											<td><input type="text" class="form-control text-uppercase" name="is_statutory_details1" id="is_statutory_details1"  value="<?php echo  $is_statutory_details1; ?>"></td>
											<td>Act No. under which it is constituted :</td>
											<td><input type="text" class="form-control text-uppercase" name="is_statutory_details2" id="is_statutory_details2" value="<?php echo  $is_statutory_details2; ?>"></td>
										</tr>
										<tr>
											<td>4. (i) Profession of the applicant :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant_profession"  value="<?php echo  $applicant_profession; ?>"></td>
											<td>(ii) Nature of business of the applicant :</td>
											<td><input type="text" class="form-control text-uppercase" name="applicant_nature"  value="<?php echo  $applicant_nature; ?>"></td>
										</tr>
										<tr>
											<td>5. Item or Items the applicant intends to :</td>
											<td><input type="text" class="form-control text-uppercase" name="items"  value="<?php echo  $items; ?>"></td>
											<td>6. Period for which the license/mining lease is required :</td>
											<td><input type="text" class="form-control text-uppercase" name="period_of_license"  value="<?php echo  $period_of_license; ?>"></td>
										</tr>
										<tr>
											<td>7. Extent of the area the applicant wants to mine :</td>
											<td><input type="text" class="form-control text-uppercase" name="area_extent"  value="<?php echo  $area_extent; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">8. Details of the area for which mining lease is required :</td>
										</tr>
										<tr>
											<td>(a) Name of the area :</td>
											<td><input type="text" class="form-control text-uppercase" name="details[area]"  value="<?php echo  $details_area; ?>"></td>
											<td>(b) Name of the District :</td>
											<td><input type="text" class="form-control text-uppercase" name="details[dist]"  value="<?php echo  $details_dist; ?>"></td>
										</tr>
										<tr>
											<td>(c) Name of the sub-division :</td>
											<td><input type="text" class="form-control text-uppercase" name="details[subdivision]"  value="<?php echo  $details_subdivision; ?>"></td>
											<td>(d) Area in square kilometers :</td>
											<td><input type="text" class="form-control text-uppercase" name="details[area2]"  value="<?php echo  $details_area2; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">9. Is the area applied for ML and as :- described at (viii) above or part thereof comes under any mining granted to the applicant earlier. If yes, :</td>
											
										</tr>
										<tr>
											<td>(a) The date of grant of the ML :</td>
											<td><input type="text" class="dobindia form-control" name="applied_area[dt1]"  value="<?php echo  $applied_area_dt1; ?>"></td>
											<td>(b) Area of the lease :</td>
											<td><input type="text" class="form-control text-uppercase" name="applied_area[lease]"  value="<?php echo  $applied_area_lease; ?>"></td>
										</tr>
										<tr>
											<td>(c) Date of execution of the ML deed :</td>
											<td><input type="text" class="dobindia form-control" name="applied_area[dt2]"  value="<?php echo  $applied_area_dt2; ?>"></td>
											<td>(d) Cumulative Production of Oil and Natural gas during the lease hold Period :</td>
											<td><input type="text" class="form-control text-uppercase" name="applied_area[production]"  value="<?php echo  $applied_area_production; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">10. A brief description of the area with particular reference to natural or other surface features such as river stream, roads, township etc. :</td>
											<td><input type="text" class="form-control text-uppercase" name="area_description"  value="<?php echo  $area_description; ?>"></td>
										</tr>
										<tr>
											<td colspan="3">11. Whether or the proposed area for ML or part thereof falls within any reserve forest. If so, mention the area in sq.km that falls within R.F along with the name of R.F. :</td>
											<td><input type="text" class="form-control text-uppercase" name="proposed_area"  value="<?php echo  $proposed_area; ?>"></td>
										</tr>
										<tr>
											<td colspan="4">12. The area applied for Mining lease should be marked on the plan as detailed below. :</td>
											
										</tr>
										<tr>
											<td colspan="3">a) The area should be marked on a plan drawn to the scale showing on this plan important surface &amp; natural features, District, Mining lease &amp; PEL boundaries if any, the dimensions of the lines forming the boundary of the area &amp; the bearing and the distance of all corner points from any important /prominent and fixed point or points. :</td>
											<td><input type="text" class="form-control text-uppercase" name="area_mining_lease_a"  value="<?php echo  $area_mining_lease_a; ?>"></td>
										</tr>
									
										<tr>
											<td colspan="4">b) If the area or part thereof falls within any reserve forest , this should be shown properly demarcated in the plan indicating the area in Sq.km. under R.F. Here mention the name &amp; address of the Forest Division / Divisions under whose jurisdiction the area falls. :</td>
										</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="20%">Sl. No.</th>
													<th width="40%">Name</th>
													<th width="40%">Address</th>
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
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["address"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
										
										
										<tr>
											<td colspan="4">c) The map of the proposed ML the concerned revenue authority under proper seal &amp; signature Here mention the name , designation&amp; address of the concerned revenue authorities by whom the relevant map has been authenticated. :</td>
											
										</tr>
									<tr>
										<td colspan="4">
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="10%">Sl. No.</th>
													<th width="30%">Name</th>
													<th width="30%">Designation</th>
													<th width="30%">Address</th>
												</tr>
												</thead>
												<?php
													$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
															<td><input id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["name"]; ?>" validate="letters" name="textB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_2["designation"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_2["address"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="textD<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="textA1" readonly="readonly" size="10" class="form-control text-uppercase" name="textA1"></td>
														<td><input id="textB1" size="10" class="form-control text-uppercase" name="textB1"></td>
														<td><input id="textC1" size="10"   class="form-control text-uppercase" name="textC1"></td>
														<td><input id="textD1" size="10"   class="form-control text-uppercase" name="textD1"></td>
																												
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
									</tr>
									
										
										<tr>
											<td>13. The probable date, month with effect from which the applicant intends to start mining operation in the area. :</td>
											<td><input type="text" class="dobindia form-control" name="start_mining_date"  value="<?php echo  $start_mining_date; ?>"></td>
											<td>14. The targeted production of enclosed as Annexure-II Oil &amp; Gas production figures enclosed. Crude oil in the 1 st five years of the lease. :</td>
											<td><input type="text" class="form-control text-uppercase" name="targeted_production"  value="<?php echo  $targeted_production; ?>"></td>
										</tr>
										<tr>
											<td>15. Any other particulars :</td>
											<td><input type="text" class="form-control text-uppercase" name="any_particulars"  value="<?php echo  $any_particulars; ?>"></td>
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td colspan="2">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
											Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
											<td colspan="2" align="right">Signature : <strong><?php echo strtoupper($key_person); ?></strong><br/>
											Designation : <strong><?php echo strtoupper($status_applicant); ?></strong></td>
										</tr>
																						
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
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
	
	$('#is_statutory_details1').attr('readonly','readonly');
	<?php if($is_statutory == 'Y') echo "$('#is_statutory_details1').removeAttr('readonly','readonly');"; ?>
	$('.is_statutory').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_statutory_details1').removeAttr('readonly','readonly');
		}else{
			$('#is_statutory_details1').attr('readonly','readonly');
			$('#is_statutory_details1').val('');
		}			
	});
	$('#is_statutory_details2').attr('readonly','readonly');
	<?php if($is_statutory == 'Y') echo "$('#is_statutory_details2').removeAttr('readonly','readonly');"; ?>
	$('.is_statutory').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_statutory_details2').removeAttr('readonly','readonly');
		}else{
			$('#is_statutory_details2').attr('readonly','readonly');
			$('#is_statutory_details2').val('');
		}			
	});
	
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>


</script>