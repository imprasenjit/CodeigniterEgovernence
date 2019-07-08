<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="8";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);	
include "save_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	    if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
			if($p->num_rows>0){
				$row=$p->fetch_array();
				$form_id=$row['form_id'];$owner_name=$row['owner_name'];
				
					if(!empty($row["o_s_a_storage"])){
						$o_s_a_storage=json_decode($row["o_s_a_storage"]);
						$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
					}else{				
						$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
					}
				
					if(!empty($row["owner_address"])){
						$owner_address=json_decode($row["owner_address"]);
						$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
					}else{				
						$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
					}
							
					if(!empty($row["surround_prop"])){	
							 $surround_prop=json_decode($row["surround_prop"]);
							 $surround_prop_e=$surround_prop->e;
							 $surround_prop_w=$surround_prop->w;
							 $surround_prop_n=$surround_prop->n;
							 $surround_prop_s=$surround_prop->s;
					}else{				
						$surround_prop_e="";$surround_prop_w="";$surround_prop_n=""; $surround_prop_s="";
					}
					
					if(!empty($row["os_width"])){	
							 $os_width=json_decode($row["os_width"]);
							 $os_width_e=$os_width->e;
							 $os_width_w=$os_width->w;
							 $os_width_n=$os_width->n;
							 $os_width_s=$os_width->s;	
					}else{				
						$os_width_e="";$os_width_w="";$os_width_n=""; $os_width_s="";
					}
					
					$chemical_stored=$row["chemical_stored"];$quantity_stored=$row["quantity_stored"];$type_storage=$row["type_storage"];
					$flash_stored=$row["flash_stored"];$details_electric=$row["details_electric"];$total_area=$row["total_area"];
					$access_premises=$row["access_premises"];$provision_segregate=$row["provision_segregate"];$size_exit=$row["size_exit"];
					$nearest_station=$row["nearest_station"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_no=$row["license_no"];
					$other_info=$row["other_info"]; 
				   
			}else{	   
				$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width_e="";$os_width_w="";$os_width_n="";$os_width_s="";$chemical_stored="";$quantity_stored="";$type_storage="";$flash_stored="";$details_electric="";$total_area="";
				$access_premises="";$provision_segregate="";$size_exit="";$nearest_station="";$fire_details="";$water_details="";$personnel_details="";$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n="";$o_s_a_storage_s="";$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
				$s_no="";$license_no="";$other_info="";$owner_name="";
		   }	
		}else{ 
        
			$row=$q->fetch_array();
			$form_id=$row['form_id'];$owner_name=$row['owner_name'];
			 
				if(!empty($row["o_s_a_storage"])){
					$o_s_a_storage=json_decode($row["o_s_a_storage"]);
					$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
				}else{				
					$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
				}
			
				if(!empty($row["owner_address"])){
					$owner_address=json_decode($row["owner_address"]);
					$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
				}else{				
					$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
				}
							
				if(!empty($row["surround_prop"])){	
						 $surround_prop=json_decode($row["surround_prop"]);
						 $surround_prop_e=$surround_prop->e;
						 $surround_prop_w=$surround_prop->w;
						 $surround_prop_n=$surround_prop->n;
						 $surround_prop_s=$surround_prop->s;
				}else{				
					$surround_prop_e="";$surround_prop_w="";$surround_prop_n=""; $surround_prop_s="";
				}
				
				if(!empty($row["os_width"])){	
						 $os_width=json_decode($row["os_width"]);
						 $os_width_e=$os_width->e;
						 $os_width_w=$os_width->w;
						 $os_width_n=$os_width->n;
						 $os_width_s=$os_width->s;	
				}else{				
					$os_width_e="";$os_width_w="";$os_width_n=""; $os_width_s="";
				}
				$chemical_stored=$row["chemical_stored"];$quantity_stored=$row["quantity_stored"];$type_storage=$row["type_storage"];
				$flash_stored=$row["flash_stored"];$details_electric=$row["details_electric"];$total_area=$row["total_area"];
				$access_premises=$row["access_premises"];$provision_segregate=$row["provision_segregate"];$size_exit=$row["size_exit"];
				$nearest_station=$row["nearest_station"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_no=$row["license_no"];
				$other_info=$row["other_info"];    
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
										<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
									</h4>	
								</div>
								<div class="panel-body">
									<ul class="nav nav-pills">
										<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
										<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART 2</a></li>
									</ul>
									<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
								<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">1. Name and address of the Applicant</td>
										</tr>
										<tr>
											<td width="25%"> Applicant's Name</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td width="25%"> Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name1;?>" disabled="disabled"></td>
										
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>	
											<td> Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $vill;?>" disabled="disabled"></td>
										
											<td> District</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td> State</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $block;?>" disabled="disabled"></td>
										
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
										   
										</tr>
										
										<tr>
											<td colspan="4">2. Name and Address of the owner of the premises <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td> Owner's Name</td>
											<td><input type="text" class="form-control text-uppercase" validate="letters"  name="owner_name" id="oname"  value="<?php echo $owner_name;?>" required="required"/></td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[s1]" value="<?php echo $owner_address_s1;?>" /></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[s2]" value="<?php echo $owner_address_s2;?>" /></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[vt]" value="<?php echo $owner_address_vt;?>" /></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[dist]" value="<?php echo $owner_address_dist;?>" /></td>
										</tr>
										<tr>
											<td>Block </td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[blk]" value="<?php echo $owner_address_blk;?>" /></td>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="owner_address[pin]" value="<?php echo $owner_address_pin;?>" /></td>
										</tr>
										<tr>
											<td>3. Address of the premises</td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_vill;?>" disabled="disabled"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_pincode;?>" disabled="disabled"></td>
											<td> Block</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_block;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td colspan="4">4. Contact numbers of the applicant/occupier/owner  </td>
										</tr>
										<tr>
											<td>Mobile no. </td>
											<td> <input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="+91 -<?php echo $mobile_no;?>" disabled="disabled">
											</td>
											<td>Landline no.</td>
											<td><input type="text" class="form-control text-uppercase"   name="onbehalf" id="onbehalf"  value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">
										</tr>
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
										</tr>
								</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
										<tr>
											<td width="25%">5. Chemicals proposed to be stored<span class="mandatory_field">*</span></td>
											<td width="25%"><input type="text"  class="form-control text-uppercase"  name="chemical_stored" id="chemical_stored" value="<?php echo $chemical_stored;?>"  required="required" /></td>
								  
											<td width="25%">6. Quantity proposed to be Stored<span class="mandatory_field">*</span></td>
											<td width="25%"><input type="text"  class="form-control text-uppercase"  name="quantity_stored" id="quantity_stored" value="<?php echo $quantity_stored;?>"  required="required" /></td>
										</tr>
										<tr>
											<td>7. Type of the Storage<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="type_storage" id="type_storage"  value="<?php echo $type_storage;?>"  required="required"/></td>
									  
											<td>8. Flash point/s of the product proposed to be Stored<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase"  name="flash_stored" id="flash_stored" value="<?php echo $flash_stored;?>"  required="required"/></td>
										</tr>
										<tr>
											<td>9. Details of the electrification in the proposed area<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase"  name="details_electric" id="details_electric" value="<?php echo $details_electric;?>" /></td>
									 
											<td>10. Total Storage Area/ Total area of the installation<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase" name="total_area" id="total_area" value="<?php echo $total_area;?>"  required="required" /></td>
										</tr>
										<tr>
											<td>11. Surrounding properties <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>East</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"  required="required"/></td>
										  
											<td>West</td>
											<td><input type="text"  class="form-control text-uppercase" validate="jsonObj" name="surround_prop[w]" id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"  required="required"/></td>
										</tr>
										<tr>
											<td>North</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[n]"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"  required="required" />
										 
											<td>South</td>
											<td><input type="text"  class="form-control text-uppercase" validate="jsonObj" name="surround_prop[s]"  id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"  required="required"/></td>
										</tr>
										<tr>
											<td>12. Accessibility to the premises<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="access_premises" id="access_premises"  value="<?php echo $access_premises;?>"  required="required"/></td>
										</tr>
										<tr>
											<td colspan="3">13. Open Space available around the Storage <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>Eastern Side</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[e]"  id="os_width[e]" value="<?php echo $os_width_e;?>"  required="required"/></td>
										   
											<td>Western Side</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[w]"  id="os_width[w]" value="<?php echo $os_width_w;?>"  required="required"/></td>
										</tr>
										<tr>
											<td>Northern Side</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[n]"  id="os_width[n]" value="<?php echo $os_width_n;?>"  required="required"/></td>
										   
											<td>Southern Side</td>
											<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[s]"  id="os_width[s]" value="<?php echo $os_width_s;?>"  required="required"/></td>
										</tr>
										  
										<tr>
											<td>14. Provision made of segregate the premises<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="provision_segregate"  id="provision_segregate" value="<?php echo $provision_segregate;?>"  required="required"/></td>
									  
											<td>15. Name, Type and size of the exits<span class="mandatory_field">*</span></td>
											<td><input type="text1" class="form-control text-uppercase"  name="size_exit"  id="size_exit" value="<?php echo $size_exit;?>"  required="required"/></td>
										</tr>
										<tr>
											<td>16. Name of the nearest fire Station<span class="mandatory_field">*</span></td>
                                             <td><?php 
											//$b_dist_id=$formFunctions->get_district_id($b_dist);	
											$fire_stations=$formFunctions->executeQuery($dept,"select * from nearest_fire_stations where district_id='$b_dist_id'"); ?>
											<select name="nearest_station" class="form-control text-uppercase" required="required">
												<option value="">Please Select Nearest Fire Station</option>
												<?php while($rows=$fire_stations->fetch_object()) {
													if(isset($nearest_station) && ($nearest_station==$rows->id)){
														$s='selected'; 
													}else{
														$s='';
													}  ?>
													<option value="<?php echo $rows->id; ?>" <?php echo $s;?>><?php echo $rows->nearest_fire_station; ?></option>
												<?php }		?>
											</select></td>
											
									  
											<td>17. Details of the Fire Fighting Equipments available<span class="mandatory_field">*</span></td>
											<td><textarea name="fire_details" validate="textarea" class="form-control text-uppercase" id="fire_details" cols="45"  required="required" placeholder="Details of fire fight Equipments" rows="5"><?php echo $fire_details;?></textarea>
											</td>
										</tr>
										<tr>
											<td>18. Details of the water storages available in the premises<span class="mandatory_field">*</span></td>
											<td><textarea name="water_details" validate="textarea" class="form-control text-uppercase" id="water_details"  required="required" cols="45" rows="5" placeholder="Details of Water Storage"><?php echo $water_details;?></textarea></td>
										</tr>
										<tr>
											<td>19. Details of the personnel trained basic fire fighting (Sl No. of the training certificate)</td>
											<td><textarea name="personnel_details" validate="textarea" class="form-control text-uppercase" id="personnel_details" placeholder="Details of Trained Personnel" cols="45" rows="5"><?php echo $personnel_details;?></textarea></td>
										
											<td>Sl.no</td>
											<td><input type="text" class="form-control text-uppercase"  name="s_no" placeholder="Sl no" id="s_no" value="<?php echo $s_no;?>"/></td>
										</tr>
										<tr>
											<td>20. License number (not applicable for new applicants)</td>
											<td><input type="text" class="form-control text-uppercase" name="license_no" id="license_no" value="<?php echo $license_no;?>"/></td>
											<td>21. Any other information that the applicant desires to provide</td>
											<td><textarea name="other_info" validate="textarea" class="form-control text-uppercase" id="other_info" cols="45" rows="5"><?php echo $other_info; ?></textarea></td>
										</tr>
									  
									   <tr>
											<td class="text-center" colspan="4">
												<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
												<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success submit1">Save and Next</button>
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
		</div>
</section>
</div>
  <!-- /.content-wrapper -->
  <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
$('#dist1').change(function(){
	var city=$(this).val();
	$('#block1').empty();
	$.ajax({ 
		type: 'GET',
		url: '../../../ajax/district_blocks.php', 
		data: { city: city },
		beforeSend:function(){
			$("#block1").html("Loading..");
		},
		success:function(data){
			$("#block1").html(data);
		},
		error:function(){ }
	}); //ajax end
});
</script>