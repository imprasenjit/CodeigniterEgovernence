<?php  require_once "../../requires/login_session.php"; 
$dept="fire";
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
				$form_id=$results['form_id'];
				$p_o_name=$results['p_o_name'];$t_s_area=$results['t_s_area'];$clr_details=$results['clr_details'];
				$other_info=$results['other_info'];$nearest_station=$results['nearest_station'];$license_no=$results['license_no'];$segregate=$results['segregate'];$premise_access=$results['premise_access'];

				if(!empty($results["stored"])){
					$stored=json_decode($results["stored"]);
					$stored_chemical=$stored->chemical;	$stored_flash_point=$stored->flash_point;	$stored_qnt=$stored->qnt;
                    $stored_type=$stored->type;	
				}else{
					$stored_chemical="";$stored_flash_point="";$stored_qnt="";$stored_typ="";
				}

				if(!empty($results["p_o_addr"])){
					$p_o_addr=json_decode($results["p_o_addr"]);
					$p_o_addr_s1= $p_o_addr->s1; $p_o_addr_s2= $p_o_addr->s2;$p_o_addr_vt= $p_o_addr->vt; $p_o_addr_dist= $p_o_addr->dist;
					$p_o_addr_blk= $p_o_addr->blk;	$p_o_addr_pin=$p_o_addr->pin;
				}else{
					$p_o_addr_s1="";$p_o_addr_s2="";$p_o_addr_vt="";$p_o_addr_dist="";$p_o_addr_blk="";$p_o_addr_pin="";
					
				}
				if(!empty($results["surround_prop"])){
					$surround_prop=json_decode($results["surround_prop"]);
					
					$surround_prop_e= $surround_prop->e; $surround_prop_w= $surround_prop->w;$surround_prop_n= $surround_prop->n; $surround_prop_s= $surround_prop->s; 
				}else{
					$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";
				}
				
				if(!empty($results["space_storage"])){
					$space_storage=json_decode($results["space_storage"]);
					
					$space_storage_e= $space_storage->e; $space_storage_w= $space_storage->w;$space_storage_n= $space_storage->n; $space_storage_s= $space_storage->s; 
				}else{
					$space_storage_e="";$space_storage_w="";$space_storage_n="";$space_storage_s="";
				}
				if(!empty($results["details"])){
					$details=json_decode($results["details"]);				
					if(isset($details->fire)) $details_fire= $details->fire; else $details_fire="";
					if(isset($details->water)) $details_water= $details->water; else $details_water="";
					if(isset($details->trained)) $details_trained= $details->trained; else $details_trained="";
					if(isset($details->slno)) $details_slno= $details->slno; else $details_slno="";		
				}else{
					$details_fire="";$details_water="";$details_trained="";$details_slno="";
				} 
			}else{   
				$form_id="";	   
				$other_info="";$license_no="";$nearest_station="";$segregate="";$premise_access="";$surround_prop="";$space_storage="";$details=""; $surround_prop_e= ""; $surround_prop_w= "";$surround_prop_n=""; $surround_prop_s="";$space_storage_e=""; $space_storage_w= "";$space_storage_n=""; $space_storage_s= ""; $details_fire= "";$details_water= "";$details_trained= "";$details_slno= "";$p_o_name="";$stored="";$stored_chemical="";$stored_flash_point="";$stored_qnt="";$stored_type="";$clr_details="";$t_s_area="";
			}			
		}else{	
			$results=$q->fetch_array();	 
			$form_id=$results['form_id'];
			$p_o_name=$results['p_o_name'];$t_s_area=$results['t_s_area'];$clr_details=$results['clr_details'];
			$other_info=$results['other_info'];$nearest_station=$results['nearest_station'];$license_no=$results['license_no'];$segregate=$results['segregate'];$premise_access=$results['premise_access'];

			if(!empty($results["stored"])){
				$stored=json_decode($results["stored"]);
				$stored_chemical=$stored->chemical;	$stored_flash_point= $stored->flash_point;	$stored_qnt= $stored->qnt;$stored_type=$stored->type;	
			}else{
				$stored_chemical="";$stored_flash_point="";$stored_qnt="";$stored_type="";
			}

			if(!empty($results["p_o_addr"])){
				$p_o_addr=json_decode($results["p_o_addr"]);
				$p_o_addr_s1= $p_o_addr->s1; $p_o_addr_s2= $p_o_addr->s2;$p_o_addr_vt= $p_o_addr->vt; $p_o_addr_dist= $p_o_addr->dist;
				$p_o_addr_blk= $p_o_addr->blk;	$p_o_addr_pin=$p_o_addr->pin;
			}else{
				$p_o_addr_s1="";$p_o_addr_s2="";$p_o_addr_vt="";$p_o_addr_dist="";$p_o_addr_blk="";$p_o_addr_pin="";
					
			}
			if(!empty($results["surround_prop"])){
				$surround_prop=json_decode($results["surround_prop"]);
				
				$surround_prop_e= $surround_prop->e; $surround_prop_w= $surround_prop->w;$surround_prop_n= $surround_prop->n; $surround_prop_s= $surround_prop->s; 
			}else{
					$surround_prop_e="";$surround_prop_w="";$surround_prop_n="";$surround_prop_s="";
			}
			if(!empty($results["space_storage"])){
				$space_storage=json_decode($results["space_storage"]);
				
				$space_storage_e= $space_storage->e; $space_storage_w= $space_storage->w;$space_storage_n= $space_storage->n; $space_storage_s= $space_storage->s; 
			}else{
					$space_storage_e="";$space_storage_w="";$space_storage_n="";$space_storage_s="";
			}
			if(!empty($results["details"])){
				$details=json_decode($results["details"]);				
				if(isset($details->fire)) $details_fire= $details->fire; else $details_fire="";
				if(isset($details->water)) $details_water= $details->water; else $details_water="";
				if(isset($details->trained)) $details_trained= $details->trained; else $details_trained="";
				if(isset($details->slno)) $details_slno= $details->slno; else $details_slno="";		
			}else{
				$details_fire="";$details_water="";$details_trained="";$details_slno="";
			}	
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
											<td colspan="3">1. Name and address of the Applicant :</td>
											<td></td>
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
											<td colspan="4">2. Name and Address of the owner of the premises :<span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td> Owner's Name</td>
											<td><input type="text" class="form-control text-uppercase"  validate="letters" name="p_o_name"  value="<?php echo $p_o_name;?>" required="required"/></td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text" class="form-control text-uppercase" name="p_o_addr[s1]" value="<?php if(isset($p_o_addr_s1)){echo $p_o_addr_s1;}?>" required="required" /></td>
											<td>Street Name 2</td>
											<td><input type="text" class="form-control text-uppercase" name="p_o_addr[s2]" value="<?php if(isset($p_o_addr_s2)){echo $p_o_addr_s2;} ?>" /></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" name="p_o_addr[vt]" value="<?php if(isset($p_o_addr_vt)){echo $p_o_addr_vt;} ?>" required="required"/></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" name="p_o_addr[dist]" value="<?php if(isset($p_o_addr_dist)){echo $p_o_addr_dist;} ?>" /></td>
										</tr>
										<tr>
												<td> Block</td>
												<td><input type="text" class="form-control text-uppercase" name="p_o_addr[blk]"  value="<?php if(isset($p_o_addr_blk)){echo $p_o_addr_blk;} ?>" /></td>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" validate="pincode"  name="p_o_addr[pin]" onblur="checkPin(this.id)"  maxlength="6" value="<?php if(isset($p_o_addr_pin)){echo $p_o_addr_pin;} ?>" required="required"/></td>					
										</tr>
										<tr>
											<td>3. Address of the premises :</td>
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
										<tr colspan="4">
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_pincode;?>" disabled="disabled"></td>
											<td> Block</td>
											<td><input type="text" class="form-control text-uppercase" name="onbehalf" id="onbehalf"  value="<?php echo $b_block;?>" disabled="disabled"></td>
										</tr>				
										<tr>
											<td colspan="4">4. Contact numbers of the applicant/occupier/owner  :</td>
										</tr>
										<tr>
											<td>Mobile no. </td>
											<td><input type="text" class="form-control text-uppercase"  name="onbehalf" id="onbehalf"  value="+91 -<?php echo $mobile_no;?>" disabled="disabled"></td>
											<td>Landline no.</td>
											<td><input type="text" class="form-control text-uppercase"   name="onbehalf" id="onbehalf"  value="<?php echo $landline_std."-" .$landline_no;?>" disabled="disabled">
										</tr>								
										<tr>			
											<td>5. Chemical name/s of the gas/gases proposed to be stored :<span class="mandatory_field">*</span> </td>
											<td><input type="text" class="form-control text-uppercase"   name="stored[chemical]" placeholder="" id="chemical_name" required="required"  value="<?php echo $stored_chemical;?>"/></td>
											<td>6. Quantity proposed to be stored:<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="stored[qnt]" placeholder="" required value="<?php echo $stored_qnt;?>"/></td>
										</tr>
										<tr>
											<td>7. Type of the Storage:<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="stored[type]" id="storage_type" required="required" value="<?php echo $stored_type;?>"/></td>
										
											<td>8. Flash Point/s of the product proposed to be Stored:<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="stored[flash_point]"  id="flash_storage" required="required" value="<?php echo $stored_flash_point;?>"/></td>
										</tr>
										<tr>
											<td>9. Details of the electrification in the proposed area:<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase"  name="clr_details"  id="clerification_area" required="required" value="<?php echo $clr_details;?>"/></td>
										
											<td>10. Total Storage Area/ Total area of the installation :&emsp;&emsp;&emsp;<span class="mandatory_field">*</span></td>
											<td><input type="text" class="form-control text-uppercase" name="t_s_area" placeholder="" id="installation_area" required="required" validate="onlyNumbers" value="<?php echo $t_s_area;?>"/></td>
										</tr>
									</table>
									<div align="center">
										<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
									</div>	
								</form>
								</div>
						<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id=""  class="table table-responsive">
									<tr>
										<td colspan="4">11. Surrounding properties :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
											<td width="25%">East</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"  required="required" name="surround_prop[e]" id="surround_prop[e]" value="<?php echo $surround_prop_e;?>"/></td>
									
											<td width="25%">West</td>
											<td width="25%"><input type="text" class="form-control text-uppercase"   name="surround_prop[w]" required="required"  id="surround_prop[w]" value="<?php echo $surround_prop_w;?>"/></td>
									</tr>
									<tr>
											<td>North</td>
											<td><input type="text" class="form-control text-uppercase"  name="surround_prop[n]" required="required"  id="surround_prop[n]" value="<?php echo $surround_prop_n;?>"/></td>
										 
											<td>South </td>
											<td><input type="text" class="form-control text-uppercase"  name="surround_prop[s]" required="required" id="surround_prop[s]" value="<?php echo $surround_prop_s;?>"/></td>
									</tr>							
									<tr>
										<td>12. Accessibility to the premises :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  required="required" name="premise_access" id="premise_access" placeholder="Accessibility to Premises" value="<?php echo $premise_access;?>"/></td>
									</tr>
									<tr>
										<td>13. Open Space available around the Storage :<span class="mandatory_field">*</span></td>
									</tr>
									<tr>
											<td>Eastern Side</td>
											<td><input type="text" class="form-control text-uppercase"  required="required" name="space_storage[e]" id="space_storage[e]" value="<?php echo $space_storage_e;?>"/></td>
										 
											<td>Western Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="space_storage[w]" required="required"  id="space_storage[w]" value="<?php echo $space_storage_w;?>"/></td>
									</tr>
									<tr>
											<td>Northern Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="space_storage[n]" required="required"  id="space_storage[n]" value="<?php echo $space_storage_n;?>"/></td>
										  
											<td>Southern Side</td>
											<td><input type="text" class="form-control text-uppercase"  name="space_storage[s]" required="required"  id="space_storage[s]" value="<?php echo $space_storage_s;?>"/></td>
									</tr>							
									<tr>
										<td>14. Provision made of segregate the premises :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="segregate" required="required"  id="segregate" value="<?php echo $segregate;?>"/></td>
									
										<td>15. Name of the nearest Fire Station :<span class="mandatory_field">*</span></td>
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
										<td>16. Details of the Fire Fighting Equipments available in the premises:<span class="mandatory_field">*</span></td>
										<td>
										<input type="text" class="form-control text-uppercase"  required="required" name="details[fire]"  id="no_of_entrance" value="<?php echo $details_fire;?>"/></td>
									
										<td>17. Details of the water storages available in the premises :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  name="details[water]" required="required" id="projection_height" value="<?php echo $details_water;?>"/></td>
									</tr>
									<tr>
										<td>18. Details of the personnel trained in basic fire fighting :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  name="details[trained]" required="required" id="details_trained" value="<?php echo $details_trained;?>"/></td>
									
										<td>19. Sl No. of the training certificate:</td>
										<td><input type="text" class="form-control text-uppercase"  name="details[slno]" id="no_of_rams" value="<?php echo $details_slno;?>"/></td>
									</tr>
									<tr>
										<td>20. License number ( not applicable for new applicants) :</td>
										<td><input type="text" class="form-control text-uppercase"  name="license_no" id="license" value="<?php echo $license_no;?>"/></td>
									
										<td>21. Any other information that the applicant desires to provide :</td>
										<td><textarea class="form-control text-uppercase" name="other_info" id="other_info" validate="textarea" ><?php echo $other_info;?></textarea></td>
										
									</tr>									
								</table>
								<div align="center">
								<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
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

/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>