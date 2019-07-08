<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="9";
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
			$form_id=$row["form_id"];$p_o_name=$row["p_o_name"];
	
	        if(!empty($row["owner_address"])){
				$owner_address=json_decode($row["owner_address"]);
				$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
			}else{				
				$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
			}
			if(!empty($row["s_properties"])){
				$s_properties=json_decode($row["s_properties"]);
				$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
			}else{				
				$s_properties_e="";$s_properties_w="";$s_properties_n="";$s_properties_s="";
			}
		
			if(!empty($row["o_s_a_storage"])){
				$o_s_a_storage=json_decode($row["o_s_a_storage"]);
				$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
			}else{				
				$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
			}
		
	
			if(empty($row["sl_c_details"])){
				$sl_c_details=json_decode($row["sl_c_details"]);
				$sl_c_details_s=$sl_c_details->s;
			}else{
				$sl_c_details_s="";
			}
	
		}else{
				$form_id="";$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";$s_properties_e="";$s_properties_w="";$s_properties_n="";$s_properties_s="";$p_o_name="";
				$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n="";$o_s_a_storage_s="";$sl_c_details_s="";
		}
	
	}else{

		$row=$q->fetch_array();
		$form_id=$row["form_id"];$p_o_name=$row["p_o_name"];
	  
			if(!empty($row["owner_address"])){
				$owner_address=json_decode($row["owner_address"]);
				$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
			}else{				
				$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
			}  
	   
			if(!empty($row["s_properties"])){
				$s_properties=json_decode($row["s_properties"]);
				$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
			}else{				
				$s_properties_e="";$s_properties_w="";$s_properties_n="";$s_properties_s="";
			}
			
			if(!empty($row["o_s_a_storage"])){
				$o_s_a_storage=json_decode($row["o_s_a_storage"]);
				$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
			}else{				
				$o_s_a_storage_e="";$o_s_a_storage_w="";$o_s_a_storage_n=""; $o_s_a_storage_s="";
			}
			
			if(empty($row["sl_c_details"])){
				$sl_c_details=json_decode($row['sl_c_details']);
                if(isset($sl_c_details->s))  $sl_c_details_s=$sl_c_details->s; else $sl_c_details_s="";
				
			}else{
				$sl_c_details_s="";
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
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"></td>
										</tr>
										<tr>	
											<td width="25%"> Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $street_name1;?>" disabled="disabled"></td>
										
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>	
											<td> Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $vill;?>" disabled="disabled"></td>
										
											<td> District</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $dist;?>" disabled="disabled"></td>
										</tr>
										<tr>	
											<td> State</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $block;?>" disabled="disabled"></td>
										
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $pincode;?>" disabled="disabled"></td>
										   <td></td>
										   <td></td>
										</tr>
										
										<tr>
											<td colspan="4">2. Name and Address of the owner of the building <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td> Owner's Name</td>
											<td><input type="text" class="form-control text-uppercase" validate="letters"  name="p_o_name" value="<?php echo $p_o_name;?>" required="required"/></td>
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
											<td>Block</td>
											<td><input type="text" class="form-control text-uppercase" name="owner_address[blk]" value="<?php echo $owner_address_blk;?>" /></td>	
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="owner_address[pin]" value="<?php echo $owner_address_pin;?>" /></td>
										</tr>
										<tr>
											<td>3. Address of the premises</td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_vill;?>" disabled="disabled"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase"  value="<?php echo $b_dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_pincode;?>" disabled="disabled"></td>
											<td> Block</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_block;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td colspan="4">4. Contact numbers of the applicant/occupier/owner  </td>
										</tr>
										<tr>
											<td>Mobile no. </td>
											<td> <input type="text" class="form-control text-uppercase" value="+91 -<?php echo $mobile_no;?>" disabled="disabled">
											</td>
											<td>Landline no.</td>
											<td><input type="text" class="form-control text-uppercase" value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">
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
											<td width="25%">5. Classification of explosives for which NOC is needed<span class="mandatory_field">*</span></td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="explosive_clasification" value="<?php echo $row['explosive_clasification']; ?>"  required="required" /></td>
									  
											<td width="25%">6. Quantity proposed to be Stored<span class="mandatory_field">*</span></td>
											<td width="25%"><input type="text" class="form-control text-uppercase"   name="quantity_stored" value="<?php echo $row['quantity_stored']; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>7. Type of the Storage/ Type of the Construction<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"   name="type_of_storage" value="<?php echo $row['type_of_storage']; ?>"  required="required"/></td>
									  
											<td>8. Size of room/ Magazine/ Shed etc.<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"   required="required"  name="room_size" value="<?php echo $row['room_size']; ?>" /></td>
										</tr>
										<tr>
											<td>9. Details of the electrification in the room/ shed etc</td>
											<td><input type="text" class="form-control text-uppercase" placeholder="electrification details"  name="electrification_details" value="<?php echo $row['electrification_details'];?>" /></td>
									  
											<td>10. Total Storage Area/ Total area of the Construction<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="t_s_area" value="<?php echo $row['t_s_area']; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>11. Surrounding properties <span class="mandatory_field">*</span></td>
										</tr>
										
										<tr>
											<td>East</td>
											<td><input type="text" class="form-control text-uppercase"   name="s_properties[e]" value="<?php if(isset($s_properties_e)) echo $s_properties_e; ?>"  required="required"/></td>
										  
											<td>West</td>
											<td><input type="text" class="form-control text-uppercase"  name="s_properties[w]" value="<?php if(isset($s_properties_w)) echo $s_properties_w; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>North</td>
											<td><input type="text" class="form-control text-uppercase"  name="s_properties[n]" value="<?php if(isset($s_properties_n)) echo $s_properties_n; ?>"  required="required"/></td>
										  
											<td>South</td>
											<td><input type="text" class="form-control text-uppercase"  name="s_properties[s]" value="<?php if(isset($s_properties_s)) echo $s_properties_s; ?>"  required="required"/></td>
										  
										</tr>
										<tr>
											<td>12. Accessibility to the premises<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  placeholder="Accessibility to premises" name="p_accessibility" value="<?php echo $row['p_accessibility'];?>"  required="required" /></td>
										</tr>
										<tr>
											<td>13. Open Space available around the Storage <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>Eastern Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="o_s_a_storage[e]"  value="<?php if(isset($o_s_a_storage_e)) echo $o_s_a_storage_e; ?>"  required="required"/></td>
										 
											<td>Western Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="o_s_a_storage[w]"  value="<?php if(isset($o_s_a_storage_w)) echo $o_s_a_storage_w; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>Northern Side</td>
											<td><input type="text"  class="form-control text-uppercase"   name="o_s_a_storage[n]"  value="<?php if(isset($o_s_a_storage_n)) echo $o_s_a_storage_n; ?>"  required="required"/></td>
										 
											<td>Southern Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="o_s_a_storage[s]"  value="<?php if(isset($o_s_a_storage_s)) echo $o_s_a_storage_s; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>14. Provision made of segregate the premises<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="segregate" value="<?php echo $row['segregate'];?>"  required="required"/></td>
									 
											<td>15. Name of the nearest Fire Station<span class="mandatory_field">*</span></td>
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
										
										</tr>
										<tr>
											<td>16. Details of the Fire Fighting Equipments available in the premises<span class="mandatory_field">*</span></td>
											<td> <textarea name="details_f_f_system"  class="form-control text-uppercase"  required="required" cols="45" placeholder="Details of Equipments" rows="5"><?php echo $row['details_f_f_system']; ?></textarea></td>
										
											<td>17. Details of the water storages available in the premises<span class="mandatory_field">*</span></td>
											<td><textarea name="details_w_s"  class="form-control text-uppercase" cols="40"  required="required"  rows="5" placeholder="Details of Water Storage"> <?php echo $row['details_w_s']; ?></textarea></td>
										</tr>
										<tr>
											<td>18. Details of the personnel trained in basic fire fighting (training certificates)</td>
											<td><textarea name="details_p_t"  placeholder="Details of Trained Personnel" class="form-control text-uppercase" cols="45" rows="5"><?php echo $row['details_p_t']; ?></textarea></td>
										
											<td>Sl.no</td>
											<td><input type="text" class="form-control text-uppercase"  name="sl_c_details[s]" placeholder="SL No" value="<?php if(isset($sl_c_details_s)) echo $sl_c_details_s; ?>"/></td>
										</tr>
										<tr>
											<td>19. License number (not applicable for new applicants)</td>
											<td><input type="text" class="form-control text-uppercase" name="lc_no" placeholder="license number" value="<?php echo $row['lc_no'];?>" /></td>
									  
											<td>20. Any other information that the applicant desires to provide</td>
											<td><textarea name="other_info" class="form-control text-uppercase" cols="45" rows="5"><?php echo $row['other_info'];?></textarea></td>
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