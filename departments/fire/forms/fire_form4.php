<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
$form="4";
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
				   $form_id=$row['form_id'];$lc_no=$row['lc_no'];$lc_date=$row['lc_date'];$p_o_name=$row['p_o_name'];$p_o_addr=json_decode($row['p_o_addr']);$p_o_addr_s1=$p_o_addr->s1;$p_o_addr_s2=$p_o_addr->s2;$p_o_addr_vt=$p_o_addr->vt;$p_o_addr_blk=$p_o_addr->blk;
				   $p_o_addr_dist=$p_o_addr->dist;$p_o_addr_pin=$p_o_addr->pin;
				
				if(empty($row['s_properties']==false)){
					$s_properties=json_decode($row['s_properties']);$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;
					$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
				}
				if(empty($row['o_s_a_storage']==false)){
					$o_s_a_storage=json_decode($row['o_s_a_storage']);$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;
					$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
				}
			
				
				if(empty($row['sl_c_details']==false)){
					$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
				}
				if(!($row['tel_no']=="NULL")){
					$tel_no=json_decode($row['tel_no']);
						$tel_no_stc=$tel_no->stc;
						$tel_no_lno=$tel_no->lno;	
				}else{
					$tel_no_stc="";$tel_no_lno="";
				}
				$t_s_area=$row['t_s_area'];$t_b_area=$row['t_b_area'];$p_accessibility=$row['p_accessibility'];$n_o_floors=$row['n_o_floors'];
				$occupancy=$row['occupancy'];$access=$row['access'];$w_premises=$row['w_premises'];$w_building=$row['w_building'];
				$emergency=$row['emergency'];$parking=$row['parking'];$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
				$parking=$row['parking'];$nearest_station=$row['nearest_station'];$details_f_f_system=$row['details_f_f_system'];
				$details_w_s=$row['details_w_s'];$details_p_t=$row['details_p_t'];$other_info=$row['other_info'];
				
				if(!empty($sl_c_details)){
					$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
				}
				
			}else{	
				$p_o_name="";$p_o_addr_s1="";$p_o_addr_s2="";$p_o_addr_vt="";$p_o_addr_blk="";$p_o_addr_dist="";$p_o_addr_pin  ="";$tel_no_stc="";$tel_no_lno="";$cno_stc="";$cno_lno="";$lc_no="";$lc_date="";$file1="";$file2="";$file3=""  ;$file4="";$file5="";$t_s_area="";$t_b_area="";$p_accessibility="";$n_o_floors="";$occupancy="";$access=""; $w_premises="";$w_building="";$emergency="";$parking="";$two_wheeler="";$four_wheeler="";$nearest_station=""; $details_f_f_system="";$details_w_s="";$details_p_t="";$other_info="";$sl_c_details_s="";$sl_c_details_c="";
			}
		}else{
				$row=$q->fetch_array();
				$form_id=$row['form_id'];
				$lc_no=$row['lc_no'];$lc_date=$row['lc_date'];$p_o_name=$row['p_o_name'];$p_o_addr=json_decode($row['p_o_addr']);$p_o_addr_s1=$p_o_addr->s1;$p_o_addr_s2=$p_o_addr->s2;$p_o_addr_vt=$p_o_addr->vt;$p_o_addr_blk=$p_o_addr->blk;
				$p_o_addr_dist=$p_o_addr->dist;$p_o_addr_pin=$p_o_addr->pin;
				
				if(empty($row['s_properties']==false)){
					$s_properties=json_decode($row['s_properties']);$s_properties_e=$s_properties->e;$s_properties_w=$s_properties->w;
					$s_properties_n=$s_properties->n;$s_properties_s=$s_properties->s;
				}
				if(empty($row['o_s_a_storage']==false)){
					$o_s_a_storage=json_decode($row['o_s_a_storage']);$o_s_a_storage_e=$o_s_a_storage->e;$o_s_a_storage_w=$o_s_a_storage->w;
					$o_s_a_storage_n=$o_s_a_storage->n;$o_s_a_storage_s=$o_s_a_storage->s;
				}
					
				if(empty($row['sl_c_details']==false)){
					$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
				}
				if(!($row['tel_no']=="NULL")){
					$tel_no=json_decode($row['tel_no']);
						$tel_no_stc=$tel_no->stc;
						$tel_no_lno=$tel_no->lno;	
				}else{
					$tel_no_stc="";$tel_no_lno="";
				}
				
				$t_s_area=$row['t_s_area'];$t_b_area=$row['t_b_area'];$p_accessibility=$row['p_accessibility'];$n_o_floors=$row['n_o_floors'];
				$occupancy=$row['occupancy'];$access=$row['access'];$w_premises=$row['w_premises'];$w_building=$row['w_building'];
				$emergency=$row['emergency'];$parking=$row['parking'];$two_wheeler=$row['two_wheeler'];$four_wheeler=$row['four_wheeler'];
				$parking=$row['parking'];$nearest_station=$row['nearest_station'];$details_f_f_system=$row['details_f_f_system'];
				$details_w_s=$row['details_w_s'];$details_p_t=$row['details_p_t'];$other_info=$row['other_info'];
					
				if(!empty($sl_c_details)){
					$sl_c_details=json_decode($row["sl_c_details"]);$sl_c_details_s=$sl_c_details->s;$sl_c_details_c=$sl_c_details->c;
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
												<td colspan="4">1. Name and address of the Applicant</td>
										</tr>
										<tr>
												<td width="25%"> Applicant's Name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"></td>
												<td width="25%"></td>
												<td width="25%"></td>
										</tr>
										<tr>
												<td width="25%"> Street1</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $street_name1;?>" disabled="disabled"></td>
										
												<td width="25%">Street2</td>
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
												<td colspan="4">2. Name and Address of the owner of the premises <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
												<td> Owner's Name</td>
												<td><input type="text" class="form-control text-uppercase"  name="p_o_name" id="oname"  value="<?php echo $p_o_name;?>" validate="letters" required="required"/></td>
										</tr>
										<tr>
												<td>Street 1</td>
												<td><input type="text" class="form-control text-uppercase"   name="p_o_addr[s1]" value="<?php if(isset($p_o_addr_s1)){echo $p_o_addr_s1;}?>" required="required" /></td>
												<td>Street 2</td>
												<td><input type="text" class="form-control text-uppercase"  name="p_o_addr[s2]" value="<?php if(isset($p_o_addr_s2)){echo $p_o_addr_s2;} ?>" /></td>
										</tr>
										<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase"  name="p_o_addr[vt]" value="<?php if(isset($p_o_addr_vt)){echo $p_o_addr_vt;} ?>" required="required"/></td>	
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase"  name="p_o_addr[dist]" value="<?php if(isset($p_o_addr_dist)){echo $p_o_addr_dist;} ?>" required="required"/></td>	
										</tr>
										<tr>
											<td> Block</td>
											<td><input type="text" class="form-control text-uppercase"  name="p_o_addr[blk]" value="<?php if(isset($p_o_addr_blk)){echo $p_o_addr_blk;} ?>" required="required"/></td>
											<td>Pincode</td>
											<td><input type="text"  name="p_o_addr[pin]" class="form-control text-uppercase" validate="pincode"  maxlength="6" value="<?php if(isset($p_o_addr_pin)){echo $p_o_addr_pin;} ?>" required="required"/></td>
										</tr>
										<tr>
											<td>3. Address of the premises</td>
										</tr>
										<tr>
											<td>Street 1</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_street_name1;?>" disabled="disabled"></td>
											<td>Street 2</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_street_name2;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_vill;?>" disabled="disabled"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_dist;?>" disabled="disabled"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_pincode;?>" disabled="disabled"></td>
											<td> Block</td>
											<td><input type="text" class="form-control text-uppercase"   value="<?php echo $b_block;?>" disabled="disabled"></td>
										</tr>
										
										
										<tr>
											<td colspan="4">4. Telephone numbers of the applicant/occupier/owner  </td>
										</tr>
										<tr>
											<td>Mobile no. </td>
											<td> <input type="text" class="form-control text-uppercase"    value="+91-<?php echo $mobile_no;?>" disabled="disabled">
											</td>
											<td>Landline no.</td>
											<td><input type="text" class="form-control text-uppercase"     value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">		
										</tr>
										<tr>	
											<td colspan="2">5. License Number and date of issue <span class="mandatory_field">*</span></td>			
										</tr>
										<tr>
											<td>License no</td>
											<td><input type="text"  placeholder="License Number" class="form-control text-uppercase" name="lc_no" id="lic_no"  value="<?php  echo $lc_no; ?>"  required="required" /></td>
										
											<td>Date of Issue</td>
											<td><input type="text" class="dob form-control text-uppercase"  name="lc_date"   required="required"  placeholder="YYYY-MM-DD"  id="dob1" readonly="readonly" value="<?php  echo $lc_date; ?>"/></td>
											
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
											<td width="25%"><input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="t_s_area" placeholder="" id="sitearea" required="required" value="<?php echo $t_s_area; ?>"  required="required"/></td>
									
											<td width="25%">7. Total built up area<span class="mandatory_field">*</span></td>
											<td width="25%"><input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="t_b_area" placeholder="" id="buildarea"  value="<?php echo $t_b_area; ?>" required="required"  required="required" /></td>
									</tr>
									<tr>
											<td>8. Accessibility to the premises<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase" jstag="validateNotSpecialChar" name="p_accessibility" id="accessibility" placeholder="Accessibility to Premises"  value="<?php  echo $p_accessibility; ?>" required="required"  required="required"/></td>
											<td></td>
											<td></td>
									</tr>
									<tr>
											<td colspan="4">9. Surrounding properties <span class="mandatory_field">*</span></td> 
									</tr>
									<tr>
												<td>East</td>
												<td><input type="text" class="form-control text-uppercase"  name="s_properties[e]" id="east"  value="<?php if(isset($s_properties_e)) echo $s_properties_e; ?>"  required="required" /></td>
											
												<td>West</td>
												<td><input type="text" class="form-control text-uppercase"   name="s_properties[w]" placeholder="" id="west"  value="<?php if(isset($s_properties_w)) echo $s_properties_w; ?>"  required="required" /></td>
									</tr>
									<tr>
												<td>North</td>
												<td><input type="text" class="form-control text-uppercase"  name="s_properties[n]" placeholder="" id="north"  value="<?php if(isset($s_properties_n)) echo $s_properties_n; ?>"  required="required"/></td>
											
												<td>South</td>
												<td><input type="text" class="form-control text-uppercase"   name="s_properties[s]" placeholder="" id="south"  value="<?php if(isset($s_properties_s)) echo $s_properties_s; ?>"  required="required" /></td>
									</tr>
										     
									<tr>
											<td>10. Number of floors<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  validate="onlyNumbers" name="n_o_floors" onchange="onlyNumber(this.id)" placeholder="No Of Floors" id="floor_no"  value="<?php echo $n_o_floors; ?>" required="required"/></td>
									
											<td>11. Occupancy in each floor<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="occupancy" placeholder="Occupancy in Each Floor" id="occupancy"  value="<?php echo $occupancy; ?>" required="required"/></td>
									</tr>
									<tr>
											<td  colspan="4">12. Open Space available around the Structure <span class="mandatory_field">*</span></td>
									</tr>
									<tr>
											<td>Eastern Side</td>
											<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[e]" placeholder="" id="eastern"  value="<?php if(isset($o_s_a_storage_e)) echo $o_s_a_storage_e; ?>"  required="required" /></td>
									
											<td>Western Side</td>
											<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[w]" placeholder="" id="western"  value="<?php if(isset($o_s_a_storage_w)) echo $o_s_a_storage_w; ?>"  required="required" /></td>
									</tr>
									<tr>
											<td>Northern Side</td>
											<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[n]" placeholder="" id="northern"  value="<?php if(isset($o_s_a_storage_n)) echo $o_s_a_storage_n; ?>"  required="required" /></td>
									
											<td>Southern Side</td>
											<td><input type="text" class="form-control text-uppercase" name="o_s_a_storage[s]" placeholder="" id="southern"  value="<?php if(isset($o_s_a_storage_s)) echo $o_s_a_storage_s; ?>"  required="required"/></td>
									</tr>
									<tr>
											<td>13. Access to the premises<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="access" id="access_prem" placeholder="Access to Premises"  value="<?php echo $access; ?>" required="required" /></td>
										
									</tr>
									<tr>
											<td  colspan="4">14. Width of entry/exit <span class="mandatory_field">*</span></td>
									</tr>
									<tr>
											<td>a. Premises</td>
											<td><input type="text" class="form-control text-uppercase"   name="w_premises" id="width_prem"  value="<?php echo $w_premises; ?>" required="required"/></td>
											
											<td>b. Building</td>
											<td><input type="text" class="form-control text-uppercase"   name="w_building" id="width_build"  value="<?php  echo $w_building; ?>" required="required"/></td>
									</tr>
									<tr>									
											<td>15. Number of emergency exits<span class="mandatory_field">*</span></td>
											<td><input type="text" validate="onlyNumbers" name="emergency" id="exits"  class="form-control text-uppercase" value="<?php  echo $emergency; ?>" required="required"/></td>
											<td></td>
											<td></td>
									</tr> 
									<tr> 
											<td>16. Provision of parking 2 wheelers and 4 wheelers</td>
											<td>
												<label class="radio-inline"><input type="radio" name="parking" value="Y"  <?php if(isset($parking) && $parking=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="parking"  value="N"  <?php if(isset($parking) && $parking=='N') echo 'checked'; ?>/> No</label>
											</td>  
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers"  name="two_wheeler" id="two_wheeler"  placeholder="Total 2 Wheeler"  value="<?php  echo $two_wheeler; ?>"/></td>
											<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="four_wheeler" id="four_wheeler"  placeholder="Total 4 Wheeler"  value="<?php  echo $four_wheeler; ?>"/></td>
									</tr>
									<tr>
											<td>17. Name of the nearest Fire Station</td>
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
											<td>Telephone Number</td>
											<td><input type="text" placeholder="std code" class="form-control" name="tel_no[stc]" validate="onlyNumbers" maxlength="5" value="<?php  echo $tel_no_stc; ?>"/> - <input type="text" name="tel_no[lno]"  maxlength="8" placeholder="landline no " validate="onlyNumbers"  class="form-control"  value="<?php echo $tel_no_lno; ?>"/></td>
									</tr>
									<tr>
											<td>18. Details of the Fire Fighting <br/>System/Equipments available<span class="mandatory_field">*</span></td>
											<td><textarea  validate="textarea" name="details_f_f_system" class="form-control text-uppercase" id="equipment"  required="required"  placeholder="Details of Equipments" maxlength="255"><?php echo $details_f_f_system; ?></textarea></br><span>255</span> Characters Left</td>
										
											<td>19. Details of the water storages<br/> available in the premises<span class="mandatory_field">*</span></td>
											<td><textarea validate="textarea" name="details_w_s" class="form-control text-uppercase" id="water_storage" required="required" placeholder="Details of Water Storage" maxlength="255"> <?php echo $details_w_s; ?></textarea></br><span>255</span> Characters Left</td>
									</tr>
									<tr>
											<td colspan="4">20. Details of the personnel trained basic fire fighting (Sl. No of training certificates)</td>
									</tr>
									<tr>
											<td></td>
											<td><textarea validate="textarea" name="details_p_t" class="form-control text-uppercase" id="pl_details" placeholder="Details of Trained Personnel" maxlength="255"><?php echo $details_p_t; ?></textarea></br><span>255</span> Characters Left
											</td>
											<td><input type="text" class="form-control text-uppercase" name="sl_c_details[s]" placeholder="SL No" id="pl_id"  value="<?php if(isset($sl_c_details_s)) echo $sl_c_details_s; ?>"/></td>
											<td><input type="text" class="form-control text-uppercase"  name="sl_c_details[c]" placeholder="Certificate Details" id="pl_certificate"  value="<?php if(isset($sl_c_details_c))  echo $sl_c_details_c; ?>"/>
											</td>
									</tr>
									<tr>
											<td>21. Any other information that<br/> the applicant desire to provide</td>
											<td><textarea validate="textarea" name="other_info" class="form-control text-uppercase" id="other_info" maxlength="255"><?php echo $other_info; ?></textarea></br><span>255</span> Characters Left</br></td>
											<td></td>
									</tr>
									
								</table>
									<div align="center">
											<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
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
$('#dob').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
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
/*----------------------------------------------*/
	<?php if($parking=="N"){ ?>
		$('#two_wheeler').attr('disabled', 'disabled');
		$('#four_wheeler').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="parking"]').on('change', function(){
		if($(this).val() == 'Y'){
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