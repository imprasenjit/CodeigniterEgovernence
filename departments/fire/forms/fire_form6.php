<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="6";
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
				$form_id=$row['form_id'];
				$owner_name=$row['owner_name'];
				
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
				
				$total_area=$row["total_area"];$purpose_erect=$row["purpose_erect"];$distance_motor=$row["distance_motor"];$width_road=$row["width_road"];$parking=$row["parking"];$arrange_cook=$row["arrange_cook"];$distance_electric=$row["distance_electric"];$nearest_station=$row["nearest_station"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_authority=$row["license_authority"];$license_name=$row["license_name"];$license_no=$row["license_no"];$other_info=$row["other_info"];$two_wheeler=$row["two_wheeler"];$four_wheeler=$row["four_wheeler"];
				
			}else{
				$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";$os_width_e="";$os_width_w="";$os_width_n="";$os_width_s="";$distance_motor="";$width_road="";$parking="";$arrange_cook="";$distance_electric="";$nearest_station="";$fire_std="";$fire_land="";$fire_details="";$s_no="";$license_name="";$license_no="";$other_info="";$water_details="";$personnel_details="";$license_authority="";$owner_name="";$purpose_erect="";$total_area="";$two_wheeler="";$four_wheeler="";$owner_address_s1="";$owner_address_s2="";$owner_address_vt=""; $owner_address_dist="";$owner_address_blk="";$owner_address_pin="";
			}
		}else{ 
            $row=$q->fetch_array();	
	        $form_id=$row['form_id'];
		    $owner_name=$row['owner_name'];
			
			
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
		    $total_area=$row["total_area"];$purpose_erect=$row["purpose_erect"];$distance_motor=$row["distance_motor"];$width_road=$row["width_road"];$parking=$row["parking"];$arrange_cook=$row["arrange_cook"];$distance_electric=$row["distance_electric"];$nearest_station=$row["nearest_station"];$fire_std=$row["fire_std"];$fire_land=$row["fire_land"];$fire_details=$row["fire_details"];$water_details=$row["water_details"];$personnel_details=$row["personnel_details"];$s_no=$row["s_no"];$license_authority=$row["license_authority"];$license_name=$row["license_name"];$license_no=$row["license_no"];$other_info=$row["other_info"];$two_wheeler=$row["two_wheeler"];$four_wheeler=$row["four_wheeler"];	
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
											<td></td>
											<td></td>
										</tr>
										
										<tr>
											<td colspan="4">2. Name and Address of the owner of the premises <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td> Owner's Name</td></td>
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
											<td><input type="text" class="form-control text-uppercase"   name="onbehalf" id="onbehalf"  value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled"></td>								
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
											<td width="25%">5. Total area proposed to be utilized<span class="mandatory_field">*</span></td></td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  name="total_area" placeholder="Total Site Area" id="total_area"  value="<?php echo $total_area; ?>"  required="required"/></td>
									   
											<td width="25%">6. Purpose for erecting temporary structures<span class="mandatory_field">*</span></td></td>
											<td width="25%"><textarea validate="textarea" cols="45" rows="5" name="purpose_erect" id="purpose_erect" class="form-control text-uppercase" required="required"><?php echo $purpose_erect; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">7. Accessibility to the premises <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td>a. Distance from motor-able road</td></td>
											<td><input type="text"  class="form-control text-uppercase"  required="required"   name="distance_motor" id="distance_motor"  value="<?php echo $distance_motor; ?>"/></td>			  
											<td>b. Width of the road</td></td>
											<td><input type="text"  class="form-control text-uppercase" name="width_road"  id="width_road"  required="required"  value="<?php echo $width_road; ?>"/></td>
										</tr>
										<tr>
											<td>8. Surrounding properties <span class="mandatory_field">*</span></td>
										</tr>	
										<tr>
											<td>East</td>
											<td><input type="text"  class="form-control text-uppercase"   name="surround_prop[e]" id="surround_prop[e]"  value="<?php echo $surround_prop_e; ?>"  required="required" /></td>
												
											<td>West</td>
											<td><input type="text"  class="form-control text-uppercase"  name="surround_prop[w]"  id="surround_prop[w]"  value="<?php echo $surround_prop_w; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>North</td>
											<td><input type="text" class="form-control text-uppercase"  name="surround_prop[n]"  id="surround_prop[n]"  value="<?php echo $surround_prop_n; ?>"  required="required" /></td>
												
											<td>South</td>
											<td><input type="text"  class="form-control text-uppercase"  name="surround_prop[s]"  id="surround_prop[s]"  value="<?php echo $surround_prop_s; ?>"  required="required" /></td>
										</tr>
										<tr>
											<td colspan="4">9. Open Space available around the Structure <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
												<td>Eastern Side</td>
												<td><input type="text"  class="form-control text-uppercase"  name="os_width[e]" placeholder="" id="os_width[e]"  value="<?php echo $os_width_e; ?>"  required="required" /></td>
											 
												<td>Western Side</td>
												<td><input type="text"  class="form-control text-uppercase"  name="os_width[w]" placeholder="" id="os_width[w]"  value="<?php echo $os_width_w; ?>"  required="required" /></td>
										</tr>
										<tr>
												<td>Northern Side</td>
												<td><input type="text"   class="form-control text-uppercase"  name="os_width[n]" placeholder="" id="os_width[n]"  value="<?php echo $os_width_n; ?>"  required="required" /></td>
											  
												<td>Southern Side</td>
												<td><input type="text"  class="form-control text-uppercase"  name="os_width[s]" placeholder="" id="os_width[s]"  value="<?php echo $os_width_s; ?>"  required="required" /></td>
										</tr>
											
										<tr>
											<td>10. Provision for parking<span class="mandatory_field">*</span></td> 2 wheelers &amp; 4 wheelers</td>
											<td>
												<input type="radio" required value="Y" name="parking" <?php if($parking=='Y') echo 'checked'; ?> /> YES	&emsp;&emsp;&emsp;
												<input type="radio" value="N" name="parking" <?php if($parking=='N' || $parking=='') echo 'checked'; ?>/> NO
											</td>
											<td><input type="text"  validate="onlyNumbers"  name="two_wheeler" id="two_wheeler" class="form-control" placeholder="Total 2 Wheeler"  value="<?php  echo $two_wheeler; ?>"/>&nbsp;</td>
											<td><input type="text"   validate="onlyNumbers" name="four_wheeler" id="four_wheeler" class="form-control" placeholder="Total 4 Wheeler"  value="<?php  echo $four_wheeler; ?>"/></td>
										</tr>
										<tr>
											<td>11. Arrangement of cooking/restaurants/stalls in the premises and their distances from the main structure<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase"  name="arrange_cook" placeholder="Cooking Arrangements" id="arrange_cook"  value="<?php  echo $arrange_cook; ?>"  required="required"/></td>
									 
											<td>12. Distance to the nearest overhead electric line &amp; height of ceiling of the structures<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase" name="distance_electric"id="distance_electric"  value="<?php  echo $distance_electric; ?>"  required="required"/></td>
										</tr>
										<tr>
											<td>13. Name of the nearest Fire Station and telephone number:</td>
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
											</select>
											</td>
												
											<td>Contact</td>
											<td> <input type="text" placeholder="STD" maxlength="5" pattern="[0-9]{3,5}" class="form-control text-uppercase" name="fire_std" validate="onlyNumbers" id="fire_std" required="required" title="Please enter valid STD Code" value="<?php echo $fire_std; ?>"/> - <input type="text" class="form-control text-uppercase" name="fire_land" title="Please enter valid number " id="fire_land" pattern="[0-9]{6,8}"  value="<?php echo $fire_land; ?>" required="required" validate="onlyNumbers" placeholder="Land Line Number"   min="6" max="8" maxlength="8" /></td>
										</tr>
										<tr>
											<td>14. Details of the Fire Fighting Equipments available in the Premises/temporary pandel<span class="mandatory_field">*</span></td>
											<td><textarea validate="textarea" cols="45" rows="5" name="fire_details" id="fire_details" class="form-control text-uppercase"  required="required"  placeholder="Details of fire fighting Equipments"><?php  echo $fire_details; ?></textarea></td>
									 
											<td>15. Details of the water storages available in the premises</td>
											<td><textarea validate="textarea" name="water_details" cols="45" rows="5" id="water_details" class="form-control text-uppercase"  placeholder="Details of Water Storage"><?php  echo $water_details; ?></textarea></td>
										</tr>
										<tr>
											<td>16. Details of the personnel trained basic fire fighting (Sl. No of the training certificate)</td>
											<td><textarea  validate="textarea" name="personnel_details" cols="45" rows="5" class="form-control text-uppercase" id="personnel_details"  placeholder="Details of Trained Personnel" ><?php  echo $personnel_details; ?></textarea></td>
											<td>Sl no</td>
											<td><input type="text"  class="form-control text-uppercase"  name="s_no" placeholder="SL No" id="s_no"  value="<?php  echo $s_no; ?>"/></td>
											  
										</tr>
										<tr>
											<td colspan="4">17. Name and license number of electrician</td>
										</tr>
										<tr>
											<td>Name</td>
											<td><input type="text"  class="form-control text-uppercase" validate="letters" placeholder="name of electrician" name="license_name" id="license_name"  value="<?php echo $license_name; ?>"/></td>
										  
											<td>License No</td>
											<td><input type="text"  class="form-control text-uppercase" name="license_no" placeholder="License Number" id="license_no"  value="<?php echo $license_no; ?>"/></td>
										</tr>
										<tr>
											<td colspan="4">18. License number/ Permission from the concerned Land Owner/ Authority</td>
										</tr>		
										
										<tr>
											<td>License no<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  required="required" placeholder="License Number" name="license_authority" id="license_authority"  value="<?php echo $license_authority; ?>"/></td>
										  
										   <td>19. Any other information that the applicant desires to provide</td>
										   <td><textarea name="other_info" validate="textarea" id="other_info" class="form-control text-uppercase" ><?php echo $other_info; ?></textarea></td>
										</tr>
								   
									</table>
									<div align="center">
										<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back &amp; Edit</a>
										<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success submit1">Save and Next</button>
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
$('.dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
/*----------------------------------------------*/
	$('#two_wheeler').attr('disabled', 'disabled');
	$('#four_wheeler').attr('disabled', 'disabled');
	<?php if($parking=="Y"){ ?>
		$('#two_wheeler').removeAttr('disabled', 'disabled');
		$('#four_wheeler').removeAttr('disabled', 'disabled');
	<?php }?>
	$('input[name="parking"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#two_wheeler').removeAttr('disabled', 'disabled');
			$('#four_wheeler').removeAttr('disabled', 'disabled');			
		}else{
			$('#two_wheeler').attr('disabled', 'disabled');
			$('#two_wheeler').val('');			
			$('#four_wheeler').attr('disabled', 'disabled');
			$('#four_wheeler').val('');			
		}
	});
/*----------------------------------------------*/
</script>