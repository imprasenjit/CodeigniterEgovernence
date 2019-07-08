<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="3";
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
				$form_id=$row['form_id'];$owner_name=$row["owner_name"];
				$license_no=$row["license_no"];$lic_date=$row["lic_date"];
				
				$site_area=$row["site_area"];
				$total_area=$row["total_area"];$premise_access=$row["premise_access"];
				$no_of_floor=$row["no_of_floor"];$floor_details=$row["floor_details"];
				$access_premises=$row["access_premises"];$width_entry=$row["width_entry"];
				$no_of_entrance=$row["no_of_entrance"];$parking=$row["parking"];$nearest_station=$row["nearest_station"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];
				$system_details=$row["system_details"];$water_details=$row["water_details"];
				$personnel_details=$row["personnel_details"];$license_authority=$row["license_authority"];$other_info=$row["other_info"];
				$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
				
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
					$os_width_e= "";$os_width_w= "";$os_width_n= ""; $os_width_s= "";
				}
			   
			}else{
			   $form_id="";
			   $surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width_e="";$os_width_w="";$os_width_n="";$os_width_s="";$site_area="";$total_area="";$premise_access="";$no_of_floor="";$floor_details="";$access_premises="";$width_entry="";$no_of_entrance="";$parking="";$nearest_station="";$fire_std="";$fire_land="";$system_details="";$water_details="";$personnel_details="";$license_authority="";$other_info="";$two_wheeler="";$four_wheeler="";$owner_name="";$owner_address_s1= "";$owner_address_s2= "";$owner_address_vt= ""; $owner_address_dist= "";$owner_address_blk= "";$owner_address_pin="";$lic_date="";$license_no="";	
			}
		}else{
			$row=$q->fetch_array();		
			$form_id=$row['form_id'];$owner_name=$row["owner_name"];
			$license_no=$row["license_no"];$lic_date=$row["lic_date"];
			
			if(!empty($row["owner_address"])){
					$owner_address=json_decode($row["owner_address"]);
					$owner_address_s1=$owner_address->s1;$owner_address_s2=$owner_address->s2;$owner_address_vt=$owner_address->vt;$owner_address_dist=$owner_address->dist;$owner_address_blk=$owner_address->blk;$owner_address_pin=$owner_address->pin;
			}else{				
					$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
			}
			
			$site_area=$row["site_area"];
			$total_area=$row["total_area"];$premise_access=$row["premise_access"];
			$no_of_floor=$row["no_of_floor"];$floor_details=$row["floor_details"];
			$access_premises=$row["access_premises"];$width_entry=$row["width_entry"];
			$no_of_entrance=$row["no_of_entrance"];$parking=$row["parking"];$nearest_station=$row["nearest_station"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];
			$system_details=$row["system_details"];$water_details=$row["water_details"];
			$personnel_details=$row["personnel_details"];$license_authority=$row["license_authority"];$other_info=$row["other_info"];
			$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
			
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
												<td colspan="3">1. Name and Address of the Applicant</td>
												<td></td>
										</tr>
										<tr>
												<td> Applicant's Name</td>
												<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $key_person;?>" disabled="disabled"></td>
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
												<td> State </td>
												<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $block;?>" disabled="disabled"></td>
										
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $pincode;?>" disabled="disabled"></td>
												<td></td>
												<td></td>
										</tr>
										
										<tr>
												<td colspan="4">2. Name and Address of the owner of the premises<span class="mandatory_field">*</span></td>
										</tr>
										<tr>
												<td> Owner's Name</td>
												<td><input type="text" class="form-control text-uppercase" validate="letters"  name="owner_name"  value="<?php echo $owner_name;?>" required="required"/></td>
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
												<td> Block</td>
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
												<td><input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="+91 -<?php echo $mobile_no;?>" disabled="disabled"></td>
												<td>Landline no.</td>
												<td><input type="text" class="form-control text-uppercase"   name="onbehalf" id="onbehalf"  value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled"></td>
										</tr>
										<tr>
												<td colspan="2">5. License Number and date of issue</td>
										</tr>
										<tr>
											<td>License no<span class="mandatory_field">*</span></td>
											<td><input type="text"  placeholder="License Number" class="form-control text-uppercase" name="license_no" id="lic_no"  value="<?php  echo $license_no; ?>"  required="required" /></td>
										
											<td>Date of Issue<span class="mandatory_field">*</span></td>
											<td><input type="text" class="dob form-control text-uppercase"  name="lic_date" readonly="readonly"  placeholder="YYYY-MM-DD"  id="dob"  required="required" value="<?php  echo $lic_date; ?>"/></td>
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
					<table id=""  class="table table-responsive">
							<tr>
									<td width="25%">6. Total site area<span class="mandatory_field">*</span></td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" name="site_area" placeholder="" id="site_area" value="<?php echo $site_area; ?>" required="required" /></td>
									<td width="25%">7. Total built up area<span class="mandatory_field">*</span></td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="total_area" id="total_area" value="<?php echo $total_area; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>8. Accessibility to the premises<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase" name="premise_access" id="premise_access" value="<?php echo $premise_access; ?>" required="required" /></td>
							</tr>
							<tr>
									<td>9. Surrounding properties <span class="mandatory_field">*</span></td>
							</tr>
							<tr>
									<td>East</td>
									<td><input type="text" validate="jsonObj"class="form-control text-uppercase"  name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e; ?>" required="required" /></td>
								  
									<td>West</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[w]"  id="surround_prop[w]" value="<?php echo $surround_prop_w; ?>" required="required" /></td>
							</tr>
							<tr>
									<td>North</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"name="surround_prop[n]" id="surround_prop[n]" value="<?php echo $surround_prop_n; ?>" required="required"/></td>
									<td>South</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="surround_prop[s]"  id="surround_prop[s]" value="<?php echo $surround_prop_s; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>10. Number of floors<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_floor"  id="no_of_floor" value="<?php echo $no_of_floor; ?>" required="required"/></td>
							  
									<td>11. Occupancy in each floor<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase"  name="floor_details"  id="floor_details" value="<?php echo $floor_details; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>12. Open Space available around the Structure <span class="mandatory_field">*</span></td>
							</tr>
							<tr>
									<td>Eastern Side</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[e]"  id="os_width[e]" value="<?php echo $os_width_e; ?>" required="required"/></td>
								  
									<td>Western Side</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj" name="os_width[w]" id="os_width[w]" value="<?php echo $os_width_w; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>Northern Side</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[n]"  id="os_width[n]" value="<?php echo $os_width_n; ?>" required="required"/></td>
								  

									<td>Southern Side</td>
									<td><input type="text" class="form-control text-uppercase" validate="jsonObj"  name="os_width[s]"  id="os_width[s]" value="<?php echo $os_width_s; ?>" required="required"/></td>
								  
							</tr>
							<tr>
									<td>13. Access to the premises<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase"  name="access_premises" id="access_premises" value="<?php echo $access_premises; ?>" required="required" /></td>
							  
									<td>14. Width of entry/exits<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase"  name="width_entry"  id="width_entry" value="<?php echo $width_entry; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>15. Number of emergency exits, sizes etc<span class="mandatory_field">*</span></td>
									<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="no_of_entrance"  id="no_of_entrance" value="<?php echo $no_of_entrance; ?>" required="required"/></td>
							</tr>
							<tr>
									<td>16. Provision of parking 2 wheelers and 4 wheelers</td>
									<td><label class="radio-inline"><input type="radio" name="parking" value="YES" required <?php if(isset($parking) && $parking=='YES') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" name="parking"  value="NO"  <?php if(isset($parking) && $parking=='NO' || $parking=='') echo 'checked'; ?>/> No</label></td>
									<td><input type="text"  validate="onlyNumbers"  name="two_wheeler" id="two_wheeler" class="form-control" placeholder="Total 2 Wheeler"  value="<?php  echo $two_wheeler; ?>"/>&nbsp;</td>
									<td><input type="text"   validate="onlyNumbers" name="four_wheeler" id="four_wheeler" class="form-control" placeholder="Total 4 Wheeler"  value="<?php  echo $four_wheeler; ?>"/></td>
							</tr>
							<tr>
									<td colspan="2">17. Name of the nearest Fire Station</td>
									<td colspan="2"><?php 
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
									<td>Contact</td>
									<td> <input type="text" placeholder="STD" class="form-control text-uppercase" maxlength="5" validate="onlyNumbers" name="fire_std" id="fire_std"  value="<?php echo $fire_std; ?>"/></td>
									<td><input type="text" placeholder="NUMBER" class="form-control text-uppercase" validate="onlyNumbers" maxlength="8" name="fire_land" id="fire_land"  value="<?php echo $fire_land; ?>" /></td>
									<td></td>

							</tr>
							<tr>
									<td valign="top">18. Details of the Fire Fighting System/ Equipments available<span class="mandatory_field">*</span></td>
									<td><textarea name="system_details" validate="textarea" class="form-control text-uppercase" id="system_details"  required="required" placeholder="Details of Equipments"><?php echo $system_details; ?></textarea>
									</td>
							  
									<td valign="top">19. Details of water storages available in the premises<span class="mandatory_field">*</span></td>
									<td><textarea name="water_details" validate="textarea"class="form-control text-uppercase" id="water_details"  required="required" placeholder="Details of Water Storage"><?php echo $water_details; ?></textarea></td>
							</tr>
							<tr>
									<td valign="top">20. Details of the personnel trained basic fire fighting</td>
									<td><textarea name="personnel_details" validate="textarea" class="form-control text-uppercase" id="personnel_details" placeholder="Details of Trained Personnel"><?php echo $personnel_details; ?></textarea><br></td>
							 
									<td valign="top">21. License Number/ permission from the concerned land owner/ authority<span class="mandatory_field">*</span></td>
									<td><textarea name="license_authority" validate="textarea" class="form-control text-uppercase" id="license_authority" required="required"  placeholder="Details of License/permission"><?php echo $license_authority; ?></textarea></td>
							</tr> 
							<tr>
									<td valign="top">22. Any other information that the applicant desires to provide</td>
									<td><textarea name="other_info" validate="textarea" class="form-control text-uppercase" id="other_info" ><?php echo $other_info; ?></textarea></td>
									<td></td>
									<td></td>
							</tr>  
														
							</table>
							<div align="center">
								<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
								<button type="submit"  style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success submit1">Save and Next</button>
							</div>	
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
----------------------------------------*/
	<?php if($parking=="NO"){ ?>
		$('#two_wheeler').attr('disabled', 'none');
		$('#four_wheeler').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="parking"]').on('change', function(){
		if($(this).val() == 'YES'){
			$('#two_wheeler').removeAttr('disabled', 'disabled');
			$('#four_wheeler').removeAttr('disabled', 'disabled');			
		}else{
			$('#two_wheeler').attr('disabled', 'disabled');
			$('#four_wheeler').attr('disabled', 'disabled');			
		}
	});
   
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>