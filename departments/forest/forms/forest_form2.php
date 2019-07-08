<?php  require_once "../../requires/login_session.php"; 
$dept="forest";
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
			$form_id=$results['form_id'];	
			$forest_division=$results['forest_division'];$post_office=$results['post_office'];$fat_name=$results['fat_name'];$is_registered=$results['is_registered'];$is_registered_regno=$results['is_registered_regno'];$no_trees=$results['no_trees'];$other_tree=$results['other_tree'];
			
			if(!empty($results["fat_address"])){
				$fat_address=json_decode($results["fat_address"]);
				$fat_address_s1=$fat_address->s1;$fat_address_s2=$fat_address->s2;$fat_address_v=$fat_address->v;$fat_address_d=$fat_address->d;$fat_address_pin=$fat_address->pin;
			}else{
				$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
			}
			if(!empty($results["patt_details"])){
				$patt_details=json_decode($results["patt_details"]);
				$patt_details_dag_no=$patt_details->dag_no;$patt_details_mouza=$patt_details->mouza;$patt_details_patta_no=$patt_details->patta_no;$patt_details_rc=$patt_details->rc;$patt_details_area_plot=$patt_details->area_plot;$patt_details_area_plot_unit=$patt_details->area_plot_unit;$patt_details_nature=$patt_details->nature;$patt_details_year_patta=$patt_details->year_patta;
			}else{
				$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_area_plot_unit="";$patt_details_nature="";$patt_details_year_patta="";
			}
			if(!empty($results["replant"])){
				$replant=json_decode($results["replant"]);
				$replant_no_tree=$replant->no_tree;$replant_dag=$replant->dag;$replant_patta=$replant->patta;$replant_vill=$replant->vill;$replant_mouza=$replant->mouza;$replant_rev_circle=$replant->rev_circle;$replant_dist=$replant->dist;
			}else{
				$replant_no_tree="";$replant_dag="";$replant_patta="";$replant_vill="";$replant_mouza="";$replant_rev_circle="";$replant_dist="";
			}
			if(!empty($results["under_take"])){
				$under_take=json_decode($results["under_take"]);
				$under_take_person=$under_take->person;$under_take_s_o=$under_take->s_o;$under_take_vill=$under_take->vill;$under_take_mouza=$under_take->mouza;$under_take_ps=$under_take->ps;$under_take_dist=$under_take->dist;
			}else{
				$under_take_person="";$under_take_s_o="";$under_take_vill="";$under_take_mouza="";$under_take_ps="";$under_take_dist="";
			}
		}else{
			$form_id="";$post_office="";$forest_division="";$fat_name="";
			$is_registered="";$is_registered_regno="";$no_trees="";
			$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
			$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_area_plot_unit="";$patt_details_nature="";$patt_details_year_patta="";
			$replant_no_tree="";$replant_dag="";$replant_patta="";$replant_vill="";$replant_mouza="";$replant_rev_circle="";$replant_dist="";$other_tree="";$under_take_person="";$under_take_s_o="";$under_take_vill="";$under_take_mouza="";$under_take_ps="";$under_take_dist="";
            }
	}else{
            $results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$forest_division=$results['forest_division'];$post_office=$results['post_office'];$fat_name=$results['fat_name'];$is_registered=$results['is_registered'];$is_registered_regno=$results['is_registered_regno'];$no_trees=$results['no_trees'];$other_tree=$results['other_tree'];
		
		if(!empty($results["fat_address"])){
			$fat_address=json_decode($results["fat_address"]);
			$fat_address_s1=$fat_address->s1;$fat_address_s2=$fat_address->s2;$fat_address_v=$fat_address->v;$fat_address_d=$fat_address->d;$fat_address_pin=$fat_address->pin;
		}else{
			$fat_address_s1="";$fat_address_s2="";$fat_address_v="";$fat_address_d="";$fat_address_pin="";
		}
		if(!empty($results["patt_details"])){
			$patt_details=json_decode($results["patt_details"]);
			$patt_details_dag_no=$patt_details->dag_no;$patt_details_mouza=$patt_details->mouza;$patt_details_patta_no=$patt_details->patta_no;$patt_details_rc=$patt_details->rc;$patt_details_area_plot=$patt_details->area_plot;$patt_details_area_plot_unit=$patt_details->area_plot_unit;$patt_details_nature=$patt_details->nature;$patt_details_year_patta=$patt_details->year_patta;
		}else{
			$patt_details_dag_no="";$patt_details_mouza="";$patt_details_patta_no="";$patt_details_rc="";$patt_details_area_plot="";$patt_details_area_plot_unit="";$patt_details_nature="";$patt_details_year_patta="";
		}
		if(!empty($results["replant"])){
			$replant=json_decode($results["replant"]);
			$replant_no_tree=$replant->no_tree;$replant_dag=$replant->dag;$replant_patta=$replant->patta;$replant_vill=$replant->vill;$replant_mouza=$replant->mouza;$replant_rev_circle=$replant->rev_circle;$replant_dist=$replant->dist;
		}else{
			$replant_no_tree="";$replant_dag="";$replant_patta="";$replant_vill="";$replant_mouza="";$replant_rev_circle="";$replant_dist="";
		}
		if(!empty($results["under_take"])){
			$under_take=json_decode($results["under_take"]);
			$under_take_person=$under_take->person;$under_take_s_o=$under_take->s_o;$under_take_vill=$under_take->vill;$under_take_mouza=$under_take->mouza;$under_take_ps=$under_take->ps;$under_take_dist=$under_take->dist;
		}else{
			$under_take_person="";$under_take_s_o="";$under_take_vill="";$under_take_mouza="";$under_take_ps="";$under_take_dist="";
		}
	}
?>
    <?php require_once "../../requires/header.php";   ?>
    <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="4" class="form-inline">To,<br/>
												&emsp;&emsp;The Divisional Forest Officer<br/>
												&emsp;&emsp;<input type="text" value="<?php echo $forest_division; ?>" name="forest_division" class="form-control text-uppercase"> &nbsp;Division;<br/>
												&emsp;&emsp;<input type="text" disabled  value="<?php echo $b_dist; ?>" class="form-control text-uppercase" > 
												</td>										
											</tr>
											<tr>
												<td colspan="4">Sub : <strong>Permission for operation of trees under Certificate of Origin (C.O.).</strong></td>
											</tr>
											<tr>
												<td colspan="4">Sir,<br/><br/>
												&emsp;&emsp;&emsp;&emsp;I/We would request you to accord the necessary permission to operate the following trees existing in my/our pattaland. The necessary details of the land and trees along with the required documents are furnished below :</td>
											</tr>
											<tr>
												<td colspan="4">1. Name and address of the Pattader:</td>
											</tr>
											<tr>
												<td width="25%">Name</td>
												<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>"  class="form-control text-uppercase"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
												<td>Street Name 2</td>
												<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
												<td>District</td>
												<td><input type="text" disabled value="<?php echo $dist; ?>"  class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
												<td>Mobile</td>
												<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
											</tr>
											<tr>
												<td>Phone Number</td>
												<td><input type="text" disabled value="<?php echo $b_landline_std.$b_landline_no; ?>" class="form-control"></td>
												<td>Email-id</td>
												<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
											</tr>
											<tr>
												<td>Post Office</td>
												<td><input type="text" class="form-control text-uppercase" name="post_office" value="<?=strtoupper($post_office);?>"></td>
												<td colspan="2"></td>
											</tr>
											<tr>
												<td colspan="4">2. Father&apos;s/Mother&apos;s name and address</td>
											</tr>
											<tr>
												<td>Father&apos;s/Mother&apos;s Name<span class="mandatory_field">*</span></td>
												<td><input type="text" required  name="fat_name" validate="letters" value="<?php echo $fat_name; ?>"   class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Street Name 1<span class="mandatory_field">*</span></td>
												<td><input type="text" name="fat_address[s1]" required value="<?php echo $fat_address_s1; ?>" class="form-control text-uppercase"></td>
												<td>Street Name 2<span class="mandatory_field">*</span></td>
												<td><input type="text"  name="fat_address[s2]" required value="<?php echo $fat_address_s2; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Village/Town<span class="mandatory_field">*</span></td>
												<td><input type="text" name="fat_address[v]" required value="<?php echo $fat_address_v; ?>" class="form-control text-uppercase"></td>
												
												<td>District</td>
                                                <td><input type="text" name="fat_address[d]" id="dist" required value="<?php echo $fat_address_d; ?>" class="form-control text-uppercase"></td>
												
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text"  name="fat_address[pin]" validate="pincode" value="<?php echo $fat_address_pin; ?>" maxlength="6" class="form-control"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">3. Details of the Pattaland over which the plantation has been raised:</td>
											</tr>
											<tr>
												<td>Dag No<span class="mandatory_field">*</span></td>
												<td><input type="text"  required  name="patt_details[dag_no]" value="<?php echo $patt_details_dag_no; ?>" class="form-control text-uppercase"></td>
												<td> Patta No<span class="mandatory_field">*</span></td>
												<td><input type="text"  name="patt_details[patta_no]" required value="<?php echo $patt_details_patta_no; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Mouza<span class="mandatory_field">*</span></td>
												<td><input type="text" name="patt_details[mouza]" required value="<?php echo $patt_details_mouza; ?>" class="form-control text-uppercase"></td>
												<td>Revenue Circle<span class="mandatory_field">*</span></td>
												<td><input type="text" name="patt_details[rc]" required  value="<?php echo $patt_details_rc; ?>" class="form-control text-uppercase" ></td>
											</tr>
											<tr>
												<td>Area of Plot<span class="mandatory_field">*</span></td>
												<td><input type="text" name="patt_details[area_plot]" required value="<?php echo $patt_details_area_plot; ?>"  class="form-control1 text-uppercase">
												<select class="form-control1 text-uppercase"  name="patt_details[area_plot_unit]" value="<?php echo $patt_details_area_plot_unit; ?>">
													<option value="Bigha" <?php if($patt_details_area_plot_unit=="Bigha"){ echo "selected";}?>>Bigha</option>
													<option value="Hectare" <?php if($patt_details_area_plot_unit=="Hectare"){ echo "selected";}?>>Hectare</option>
													<option value="Sq Mt" <?php if($patt_details_area_plot_unit=="Sq Mt"){ echo "selected";}?>>Sq Mt</option>
												</select></td>
												<td>Year of issue of Patta</td>
												<td>
												<select id="issue_patta" class="form-control text-uppercase"  name="patt_details[year_patta]" value="<?php echo $patt_details_year_patta; ?>">
												<?php
													$curyear=date('Y');
													for($i=1951;$i<=$curyear;$i++){
														if($patt_details_year_patta==true){
															if($patt_details_year_patta==$i){
																echo "<option value=".$i." selected>".$i."</option>";
															}else{
																echo "<option value=".$i.">".$i."</option>";
															}															   
														}else{
															echo "<option value=".$i.">".$i."</option>";
														}
													}
												?>
												</select>
												</td>
											</tr>
											<tr>
												<td>Type of Patta (Annual/Periodic/Special grant)</td>
												<td>
												<select name="patt_details[nature]" class="form-control text-uppercase" >
													<option <?php if($patt_details_nature=="Annual") echo "selected";?> value="Annual">Annual</option>
													<option <?php if($patt_details_nature=="Periodic") echo "selected";?> value="Periodic">Periodic</option>
													<option <?php if($patt_details_nature=="Special Grant") echo "selected";?> value="Special Grant">Special Grant</option>
												</select></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>4. Whether the Plantation is registered :<span class="mandatory_field">*</span></td>
												<td>
													<label class="radio-inline"><input type="radio" value="Y" id="inlineRadio1" <?php if($is_registered=="Y") echo "checked"; ?> name="is_registered" required="required"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_registered=="N") echo "checked"; ?> id="inlineRadio1" name="is_registered"> No </label></td>
												<td>5. If yes give Registration Certificate number:</td>
												<td><input type="text" name="is_registered_regno"  id="is_registered_id" value="<?php echo $is_registered_regno;?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="3">6.(a) Whether any other tree except Aam (Mangifera indica), Jamun (Syzygium cumin), Kathal (Artocarpus integrifolia), Eucalyptus and all popular species of home grown bamboo, Leteku, Paniol and Madhuriam (Psidium guajava) are  standing over the pattalanad ? <span class="mandatory_field">*</span></td>
												<td>											
													<label class="radio-inline"><input type="radio" value="Y" id="inlineRadio1" <?php if($other_tree=="Y") echo "checked"; ?> name="other_tree" required="required"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($other_tree=="N") echo "checked"; ?> id="inlineRadio1" name="other_tree"> No </label>
												</td>
											</tr>
											<tr>
												<td colspan="4">6.(b) Details of trees standing over the Pattaland : </td>
											</tr>
											<tr>
												<td colspan="4">
												<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
													<thead>
														<tr>
															<th width="5%" align="center">Sl. No.</th>
															<th width="5%" align="center">Tree Sl. No.</th>
															<th width="15%" align="center">Species<span class="mandatory_field">*</span></th>
															<th width="15%" align="center">Approximate height of the tree in m.<span class="mandatory_field">*</span></th>
															<th width="15%" align="center">Remarks, if any.<span class="mandatory_field">*</span></th>
														</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tbody>
													<tr>
														<td><input id="txtZ<?php echo $count;?>" class="form-control text-uppercase" value="<?=$count; ?>" readonly="readonly" name="txtZ<?php echo $count;?>" size="1"></td>
														<td><input id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" required="required" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["species"]; ?>" class="form-control text-uppercase" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" required="required"id="txtB<?php echo $count;?>" style="text-transform: uppercase;" size="15" name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["height"]; ?>" required="required"id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" validate="decimal"required="required" size="15"></td>				
														<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtD<?php echo $count;?>" required="required" class="form-control text-uppercase" name="txtD<?php echo $count;?>" required="required" size="15"></td>
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtZ1" size="1" class="form-control text-uppercase" name="txtZ1" readonly="readonly"></td>
														<td><input value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" required="required"  size="20" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase" name="txtB1"></td>					
														<td><input  id="txtC1" required="required" validate="decimal"  size="15" class="form-control text-uppercase" name="txtC1"></td>
														<td><input id="txtD1" required="required" size="15" class="form-control text-uppercase" name="txtD1"></td>
													</tr>
													<?php } ?>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td colspan="4">
													<button type="button" class="btn btn-default pull-right" href="#" onclick="mydelfunction4()" value="">Delete</button>
													 <button type="button"  class="btn btn-default pull-right" onclick="addmore()" value="">Add More</button>	
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
												</td>
											</tr>
											<tr>
												<td>7. No. of trees required to be operated :</td>
												<td><input type="text" name="no_trees" value="<?php echo $no_trees; ?>" validate="onlyNumbers" class="form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="4">8. Replanting details : </td>
											</tr>
											<tr>
												<td colspan="4">(1) I/ we will replant <input type="text" class="form-control1 text-uppercase" name="replant[no_tree]" value="<?=strtoupper($replant_no_tree);?>"/> nos. of trees in the plot bearing Dag No. <input type="text" class="form-control1 text-uppercase" name="replant[dag]" value="<?=strtoupper($replant_dag);?>"/> Patta No. <input type="text" class="form-control1 text-uppercase" name="replant[patta]" value="<?=strtoupper($replant_patta);?>"/>, Village <input type="text" class="form-control1 text-uppercase" name="replant[vill]" value="<?=strtoupper($replant_vill);?>"/> Mouza <input type="text" class="form-control1 text-uppercase" name="replant[mouza]" value="<?=strtoupper($replant_mouza);?>"/> Revenue Circle <input type="text" class="form-control1 text-uppercase" name="replant[rev_circle]" value="<?=strtoupper($replant_rev_circle);?>"/> District <input type="text" class="form-control1 text-uppercase" name="replant[dist]" value="<?=strtoupper($replant_dist);?>"/><br/>
												(2) I/ we do not possess area required for replanting and agreed to deposit amount as per CAMPA norms for taking replantation.</td>
											</tr>
											<tr>
												<td colspan="4" align="center"><b><u>Undertaking by the Pattadar / Owner.</u></b></td>
											</tr>
											<tr>
												<td colspan="4">I/We, Sri <input type="text" class="form-control1 text-uppercase" name="under_take[person]" value="<?=strtoupper($under_take_person);?>"/> S/o <input type="text" class="form-control1 text-uppercase" name="under_take[s_o]" value="<?=strtoupper($under_take_s_o);?>"/> of <?=strtoupper($unit_name);?> Village <input type="text" class="form-control1 text-uppercase" name="under_take[vill]" value="<?=strtoupper($under_take_vill);?>"/> Mouza <input type="text" class="form-control1 text-uppercase" name="under_take[mouza]" value="<?=strtoupper($under_take_mouza);?>"/> P.S <input type="text" class="form-control1 text-uppercase" name="under_take[ps]" value="<?=strtoupper($under_take_ps);?>"/> District <input type="text" class="form-control1 text-uppercase" name="under_take[dist]" value="<?=strtoupper($under_take_dist);?>"/> state that the information furnished above are correct.</td>
											</tr>
											<tr>
												<td colspan="4">Signature of the Pattadar with Date:</td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
												<td>Signature of the Pattadar :</td>
												<td> <label class="text-uppercase"><?php echo $key_person; ?></label></td>										
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Save & Next</button>
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
	<?php if($is_registered == 'N' || $is_registered == '') echo "$('#is_registered_id').hide();"; ?>
	$('input[name="is_registered"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_registered_id').hide();
		else
			$('#is_registered_id').show();
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ------------------------------------------------------ */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>