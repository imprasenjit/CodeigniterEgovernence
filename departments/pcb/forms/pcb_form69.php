<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="69";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
	
include "save_form_new1.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$reporting_period=$results['reporting_period'];$name_city=$results['name_city'];$city_population=$results['city_population'];$area_kilometer=$results['area_kilometer'];$summmechanisms=$results['summmechanisms'];
		$details_manpower=$results['details_manpower'];$details_contractor=$results['details_contractor'];$is_difficulties=$results['is_difficulties'];$is_prepared=$results['is_prepared'];$facilities_validity=$results['facilities_validity'];$facility2_valid=$results['facility2_valid'];$details_difficulties=$results['details_difficulties'];
		
		if(!empty($results["nmaddress"])){
				$nmaddress=json_decode($results["nmaddress"]);
				$nmaddress_name=$nmaddress->name;$nmaddress_address=$nmaddress->address;
		}else{
				$nmaddress_name="";$nmaddress_address="";
         }
		 if(!empty($results["totalnum"])){
				$totalnum=json_decode($results["totalnum"]);
				$totalnum_wards=$totalnum->wards;$totalnum_area=$totalnum->area;$totalnum_door=$totalnum->door;$totalnum_commercial=$totalnum->commercial;$totalnum_institutions=$totalnum->institutions;
		  }else{
				$totalnum_wards="";$totalnum_area="";$totalnum_door="";$totalnum_commercial="";$totalnum_institutions="";
          }
		  
		 if(!empty($results["quantity"])){
				$quantity=json_decode($results["quantity"]);
				$quantity_generated=$quantity->generated;$quantity_collected=$quantity->collected;$quantity_channelized=$quantity->channelized;$quantity_rejects=$quantity->rejects;
			}else{
				$quantity_generated="";$quantity_collected="";$quantity_channelized="";$quantity_rejects="";
          }
		  
		  if(!empty($results["facilities"])){
				$facilities=json_decode($results["facilities"]);
				$facilities_name=$facilities->name;$facilities_address=$facilities->address;$facilities_capacity=$facilities->capacity;$facilities_technology=$facilities->technology;$facilities_regnum=$facilities->regnum;
			}else{
				$facilities_name="";$facilities_address="";$facilities_capacity="";$facilities_technology="";$facilities_regnum="";
          }
		  
		  if(!empty($results["facility2"])){
				$facility2=json_decode($results["facility2"]);
				$facility2_nm=$facility2->nm;$facility2_add=$facility2->add;$facility2_capa=$facility2->capa;$facility2_techno=$facility2->techno;$facility2_reg=$facility2->reg;
			}else{
				$facility2_nm="";$facility2_add="";$facility2_capa="";$facility2_techno="";$facility2_reg="";
          }
         
		
	}else{
		$form_id="";$reporting_period="";$name_city="";$city_population="";$area_kilometer="";$summmechanisms="";$details_manpower="";$details_contractor="";$is_difficulties="";$is_prepared="";
		$nmaddress_name="";$nmaddress_address="";$totalnum_wards="";$totalnum_area="";$totalnum_door="";$totalnum_commercial="";$totalnum_institutions="";$quantity_generated="";$quantity_collected="";$quantity_channelized="";$quantity_rejects="";$facilities_name="";$facilities_address="";$facilities_capacity="";$facilities_technology="";$facilities_regnum="";$facilities_validity="";$facility2_nm="";$facility2_add="";$facility2_capa="";$facility2_techno="";$facility2_reg="";$facility2_valid="";$details_difficulties="";
	}
}else{
	    $results=$q->fetch_assoc();
	    $form_id=$results['form_id'];
		$reporting_period=$results['reporting_period'];$name_city=$results['name_city'];$city_population=$results['city_population'];$area_kilometer=$results['area_kilometer'];$summmechanisms=$results['summmechanisms'];
		$details_manpower=$results['details_manpower'];$details_contractor=$results['details_contractor'];$is_difficulties=$results['is_difficulties'];$is_prepared=$results['is_prepared'];$facilities_validity=$results['facilities_validity'];$facility2_valid=$results['facility2_valid'];$details_difficulties=$results['details_difficulties'];
		
		if(!empty($results["nmaddress"])){
				$nmaddress=json_decode($results["nmaddress"]);
				$nmaddress_name=$nmaddress->name;$nmaddress_address=$nmaddress->address;
		}else{
				$nmaddress_name="";$nmaddress_address="";
         }
		 if(!empty($results["totalnum"])){
				$totalnum=json_decode($results["totalnum"]);
				$totalnum_wards=$totalnum->wards;$totalnum_area=$totalnum->area;$totalnum_door=$totalnum->door;$totalnum_commercial=$totalnum->commercial;$totalnum_institutions=$totalnum->institutions;
		  }else{
				$totalnum_wards="";$totalnum_area="";$totalnum_door="";$totalnum_commercial="";$totalnum_institutions="";
          }
		  
		 if(!empty($results["quantity"])){
				$quantity=json_decode($results["quantity"]);
				$quantity_generated=$quantity->generated;$quantity_collected=$quantity->collected;$quantity_channelized=$quantity->channelized;$quantity_rejects=$quantity->rejects;
			}else{
				$quantity_generated="";$quantity_collected="";$quantity_channelized="";$quantity_rejects="";
          }
		  
		  if(!empty($results["facilities"])){
				$facilities=json_decode($results["facilities"]);
				$facilities_name=$facilities->name;$facilities_address=$facilities->address;$facilities_capacity=$facilities->capacity;$facilities_technology=$facilities->technology;$facilities_regnum=$facilities->regnum;
			}else{
				$facilities_name="";$facilities_address="";$facilities_capacity="";$facilities_technology="";$facilities_regnum="";
          }
		  
		  if(!empty($results["facility2"])){
				$facility2=json_decode($results["facility2"]);
				$facility2_nm=$facility2->nm;$facility2_add=$facility2->add;$facility2_capa=$facility2->capa;$facility2_techno=$facility2->techno;$facility2_reg=$facility2->reg;
			}else{
				$facility2_nm="";$facility2_add="";$facility2_capa="";$facility2_techno="";$facility2_reg="";
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
							<div id="table1" class="tab-pane" role="tabpanel">
							 <form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td width="25%">Period of Reporting:  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reporting_period" value="<?php echo $reporting_period;?>" ></td>
									</tr>
									<tr>
										<td width="25%">1. Name of the City or Town and State:  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="name_city" value="<?php echo $name_city;?>" ></td>
										<td width="25%">2. Population : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="city_population" value="<?php echo $city_population;?>" ></td>
									</tr>
									<tr>
										<td width="25%">3. Area in sq. Kilometres : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="area_kilometer" value="<?php echo $area_kilometer;?>" ></td>
									</tr>
									<tr>
										<td colspan="4">4. Name & Address of local body : </td>
									</tr>
									<tr>
										<td>Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="nmaddress[name]" value="<?php echo $nmaddress_name; ?>"></td>
										<td>Address of local body :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="nmaddress[address]" validate="textarea" ><?php echo $nmaddress_address;?></textarea></td>
									</tr>
									<tr>
										<td width="25%">5. Total Numbers of the wards in the area under jurisdiction:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="totalnum[wards]" value="<?php echo $totalnum_wards;?>" ></td>
										<td width="25%">6. Total Numbers of Households in the area under jurisdiction:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="totalnum[area]" value="<?php echo $totalnum_area;?>" ></td>
									</tr>
									<tr>
										<td width="25%">7. Number of households covered by door to door collection :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="totalnum[door]" value="<?php echo $totalnum_door;?>" ></td>
								  </tr>
								  <tr>
										<td colspan="4">8. Total number of commercial establishments and Institutions in the area under jurisdiction :</td>
									</tr>
									<tr>
										<td width="25%">Commercial establishments :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="totalnum[commercial]" value="<?php echo $totalnum_commercial;?>" ></td>
										<td width="25%">Institutions :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="totalnum[institutions]" value="<?php echo $totalnum_institutions;?>" ></td>
									</tr>
									<tr>
										<td width="25%">9. Summary of the mechanisms put in place for management of plastic waste in the area under jurisdiction along with the details of agencies involved in door to door collection :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="summmechanisms" validate="textarea" ><?php echo $summmechanisms;?></textarea></td>
										<td width="25%">10. Quantity of Plastic Waste generated during the year from area under jurisdiction (in tons) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="quantity[generated]" value="<?php echo $quantity_generated;?>" ></td>
									</tr>
									<tr>
										<td width="25%">11. Quantity of Plastic Waste collected during the year from area under jurisdiction (in tons) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="quantity[collected]" value="<?php echo $quantity_collected;?>" ></td>
										<td width="25%">12. Quantity of plastic waste channelized for recycling during the year (in tons) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="quantity[channelized]" value="<?php echo $quantity_channelized;?>" ></td>
									</tr>
									<tr>
										<td width="25%">13. Quantity of inert or rejects sent to landfill sites during the year (in tons) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="quantity[rejects]" value="<?php echo $quantity_rejects;?>" ></td>
									</tr>
									<tr>
										<td colspan="4">14. Details of each of facilities used for processing and disposal of plastic waste <br/>Facility-I</td>
									</tr>
									<tr>
										<td width="25%">i) Name of operator :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facilities[name]" value="<?php echo $facilities_name;?>" ></td>
										<td width="25%">ii) Address with Telephone Number or Mobile :</td>
										<td><textarea class="form-control text-uppercase" name="facilities[address]"><?php echo $facilities_address;?></textarea></td>
									</tr>
									<tr>
										<td width="25%">iii) Capacity :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facilities[capacity]" value="<?php echo $facilities_capacity;?>" ></td>
										<td width="25%">iv) Technology Used :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facilities[technology]" value="<?php echo $facilities_technology;?>" ></td>
									</tr>
									<tr>
										<td width="25%">v) Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facilities[regnum]" value="<?php echo $facilities_regnum;?>" ></td>
										<td width="25%">vi) Validity of Registration (up to) :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="facilities_validity" value="<?php echo $facilities_validity;?>" ></td>
									</tr>
							       <tr>
								        <td colspan="4">
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
											    <thead>
												<tr>
												    <th width="5%">Sl. No.</th>
													<th>Name of the SPC B or PCC</th>
													<th>Estimated Plastic Waste generation Tons Per Annum</th>
													<th colspan="3">No. of registered Plastic Manufacturing or Recycling (including multilayer, compostable) units. </th>
													<th>No. of Unregistered plastic manufacturing Recycling units.</th>
													<th>Details of Plastic Waste Management</th>
													<th>Partial or complete ban on usages of Plastic Carry Bags (through Executive Order)</th>
													<th>Status of Marking Labelling on carry bags complied</th>
													<th>Explicit Pricing of carry bags</th>
													<th>Details of the meeting of State Level Advisory Body (SLA) along with its recommendations on Implementation </th>
													<th>No. of violations and action taken on noncompliance of provisions of these Rules<br/>and Number of Municipal Authority or Gram Panchayat under jurisdiction and Submission of Annual Report to CPCB</th>
													
												</tr>
										        <tr>
												    <th></th>
													<th></th>
													<th></th>
												    <th>Plastic units</th>
													<th>Compostable Plastic Units</th>
													<th>Multilayer Plastic units</th>
													
												</tr>
												</thead>
												
												
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num1 = $part1->num_rows;
													if($num1>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name_spc"]; ?>" name="txtB<?php echo $count;?>" ></td>
															<td><input value="<?php echo $row_1["estimated_plastic"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase"  name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["plastic_units"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"  name="txtD<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["compostable_plastic"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtE<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["multilayer_plastic"]; ?>" id="txtF<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtF<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["no_unregistered"]; ?>" id="txtG<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtG<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["waste_management"]; ?>" id="txtH<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtH<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["complete_ban_usages"]; ?>" id="txtI<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtI<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["status_marking"]; ?>" id="txtJ<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtJ<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["explicit"]; ?>" id="txtK<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtK<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["details_meeting"]; ?>" id="txtL<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtL<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["no_violations"]; ?>" id="txtM<?php echo $count;?>"  class=" form-control text-uppercase"  name="txtM<?php echo $count;?>"></td>
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1"   class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1"    class="form-control text-uppercase" name="txtC1"></td>
														<td><input id="txtD1"    class="form-control text-uppercase" name="txtD1"></td>	
														<td><input id="txtE1"    class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1"   class="form-control text-uppercase" name="txtF1"></td>
														<td><input id="txtG1"    class="form-control text-uppercase" name="txtG1"></td>
														<td><input id="txtH1"    class="form-control text-uppercase" name="txtH1"></td>	
														<td><input id="txtI1"    class="form-control text-uppercase" name="txtI1"></td>
														<td><input id="txtJ1"    class="form-control text-uppercase" name="txtJ1"></td>
														<td><input id="txtK1"    class="form-control text-uppercase" name="txtK1"></td>
														<td><input id="txtL1"    class="form-control text-uppercase" name="txtL1"></td>
														<td><input id="txtM1"    class="form-control text-uppercase" name="txtM1"></td>
																							
													</tr>
													<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>
									<tr>
										<td colspan="4">Facility-II</td>
									</tr>
									<tr>
										<td width="25%">i) Name of operator :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facility2[nm]" value="<?php echo $facility2_nm;?>" ></td>
										<td width="25%">ii) Address with Telephone Number or Mobile :</td>
										<td><textarea class="form-control text-uppercase" name="facility2[add]"><?php echo $facility2_add;?></textarea></td>
									</tr>
									<tr>
										<td width="25%">iii) Capacity :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facility2[capa]" value="<?php echo $facility2_capa;?>" ></td>
										<td width="25%">iv) Technology Used :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facility2[techno]" value="<?php echo $facility2_techno;?>" ></td>
									</tr>
									<tr>
										<td width="25%">v) Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="facility2[reg]" value="<?php echo $facility2_reg;?>" ></td>
										<td width="25%">vi) Validity of Registration (up to) :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="facility2_valid" value="<?php echo $facility2_valid;?>" ></td>
									</tr>
									<tr>
										<td width="25%">19. Give details of: local body’s own manpower deployed for collection including street sweeping,secondary storage, transportation, processing and disposal of waste :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="details_manpower" validate="textarea" ><?php echo $details_manpower;?></textarea></td>
										<td width="25%">20. Give details of: Contractor or concessionaire’s manpower deployed for collection including street sweeping, secondary storage, transportation, processing and disposal of waste. :</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="details_contractor" validate="textarea" ><?php echo $details_contractor;?></textarea></td>
									</tr>
									<tr>
										<td>21. Mention briefly, the difficulties being experienced by the local body in complying with provisions of these rules including the financial constrains, if any :</td>
									    <td>
											<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_difficulties=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_difficulties" required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_difficulties=='N' || $is_difficulties=='') echo 'checked'; ?> id="inlineRadio1" name="is_difficulties"> No </label></td>
										</td>
									</tr>
									<tr>
										<td>Give Details</td>
										<td><textarea type="text"  name="details_difficulties" id="details_difficulties" <?php if($is_difficulties == 'N' || $is_difficulties == '' ) echo 'disabled="disabled"'; ?> class="details_difficulties form-control text-uppercase"/><?php echo $details_difficulties; ?></textarea></td>
									</tr>	
									<tr>
										   <td width="25%">22. Whether an Action Plan has been prepared for improving solid waste management practices in the city? If yes (attach copy) Date of revision :</td>
										   <td colspan="2">
											<label class="radio-inline"><input type="radio" value="Y" <?php if($is_prepared=="Y" || $is_prepared=="") echo "checked"; ?> id="inlineRadio1" name="is_prepared"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_prepared=="N") echo "checked"; ?> id="inlineRadio1" name="is_prepared"> No </label>
										   </td>
									</tr>
									<tr>
										<td colspan="2" align="left"><br/> Date :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
										<td colspan="2" align="right"><br/> Signature :&nbsp;&nbsp;&nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong></td>
									</tr>
									<tr>										
										<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	
	$('input[name="is_difficulties"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_difficulties').attr('disabled', 'disabled');
		else
			$('#details_difficulties').removeAttr('disabled');
	});
</script>