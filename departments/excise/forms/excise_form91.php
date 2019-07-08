<?php  require_once "../../requires/login_session.php";
$dept="excise";
$form="91";
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
				$form_id=$results["form_id"];
				$owner_age=$results["owner_age"];$edu_quali=$results["edu_quali"];$proposed_site=$results["proposed_site"];
				$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];$previ_licno_validity=$results["previ_licno_validity"];$pre_license_no=$results["pre_license_no"];
				
				if(!empty($results["site_loc"])){
					$site_loc=json_decode($results["site_loc"]);
					if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
					if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
					if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
					if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
					if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
					if(isset($site_loc->ar)) $site_loc_ar=$site_loc->ar; else $site_loc_ar="";
					if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
					
				}else{				
					$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_ar="";$site_loc_z="";
				}
				
				if(!empty($results["area_type"])){
					$area_type=json_decode($results["area_type"]);
					if(isset($area_type->a)) $area_type_a=$area_type->a; 
					
				}else{				
					$area_type_a="";
				}
				
				if(!empty($results["caste_o"])){
					$caste_o=json_decode($results["caste_o"]);
					if(isset($caste_o->a)) $caste_o_a=$caste_o->a; 
					
				}else{				
					$caste_o_a="";
				}
				if(!empty($results["site_distance"])){
					$site_distance=json_decode($results["site_distance"]);
					if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
					if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
					if(isset($site_distance->sp)) $site_distance_sp=$site_distance->sp; else $site_distance_sp="";
					
				}else{				
					$site_distance_i="";$site_distance_s="";$site_distance_sp="";
				}
				if(!empty($results["pre_add"])){
					$pre_add=json_decode($results["pre_add"]);
					$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;	
				}else{				
					$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";
				}
				
			}else{
				$form_id="";
				$owner_age="";$edu_quali="";
				$site_loc_p="";$site_loc_da="";$site_loc_d="";$site_loc_pt="";$site_loc_ct="";$site_loc_ar="";$site_loc_z="";		
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";
				$proposed_site="";$pre_license_no="";$previ_licno_validity="";$is_liabilities="";$is_license="";
				$area_type_a="";$area_type_b="";$area_type_c="";$area_type_d="";$area_type_e="";$caste_o_a="";
				$site_distance_i="";$site_distance_s="";$site_distance_sp="";
			}
		}else{
            $results=$q->fetch_array();				
			$form_id=$results["form_id"];
			$owner_age=$results["owner_age"];$edu_quali=$results["edu_quali"];$proposed_site=$results["proposed_site"];
			$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];$previ_licno_validity=$results["previ_licno_validity"];$pre_license_no=$results["pre_license_no"];
			
			if(!empty($results["site_loc"])){
				$site_loc=json_decode($results["site_loc"]);
				if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
				if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
				if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
				if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
				if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
				if(isset($site_loc->ar)) $site_loc_ar=$site_loc->ar; else $site_loc_ar="";
				if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
				
			}else{				
				$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_ar="";$site_loc_z="";
			}
			
			if(!empty($results["area_type"])){
				$area_type=json_decode($results["area_type"]);
				if(isset($area_type->a)) $area_type_a=$area_type->a; 
				
			}else{				
				$area_type_a="";
			}
			
			if(!empty($results["caste_o"])){
				$caste_o=json_decode($results["caste_o"]);
				if(isset($caste_o->a)) $caste_o_a=$caste_o->a; 
				
			}else{				
				$caste_o_a="";
			}
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
				if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
				if(isset($site_distance->sp)) $site_distance_sp=$site_distance->sp; else $site_distance_sp="";
				
			}else{				
				$site_distance_i="";$site_distance_s="";$site_distance_sp="";
			}
			if(!empty($results["pre_add"])){
				$pre_add=json_decode($results["pre_add"]);
				$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;	
			}else{				
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";
			}
			
		}
	
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">1. Name and Address of the Applicant:</td>
										</tr>
										<tr>
											<td>Applicant Name </td>
											<td><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td colspan="4">Permanent Address</td>
										</tr>
										<tr>
											<td width="25%">Street Name 1</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
											<td width="25%">Street Name 2</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
											<td>District</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
											<td>Mobile No.</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>2. Education qualification of the applicant :</td>
											<td><input type="text" value="<?php echo $edu_quali; ?>" class="form-control text-uppercase" placeholder="Highest qualification" name="edu_quali"></td>
											<td>3. Age of the applicant(with proof of age) : </td>
											<td><input validate="onlyNumbers" type="text"  id="owner_age" value="<?php echo $owner_age; ?>" name="owner_age" class="form-control text-uppercase"></td>
										</tr>
										<tr>
											<td colspan="4">4. Present Address :</td>
										</tr>
										<tr>
											<td>Street Name 1</td>
											<td><input type="text"  class="form-control text-uppercase" name="pre_add[sn1]" value="<?php echo $pre_add_sn1;?>"></td>
											<td>Street Name 2</td>
											<td><input type="text" name="pre_add[sn2]" class="form-control text-uppercase" value="<?php echo $pre_add_sn2;?>"></td>
										</tr>
										<tr>
											<td>Village/Town</td>
											<td><input type="text"  class="form-control text-uppercase" name="pre_add[v]" value="<?php echo $pre_add_v;?>"></td>
											<td>District<span class="mandatory_field">*</span> </td>
                                            <td><input type="text"  class="form-control text-uppercase" name="pre_add[d]" id="d" value="<?php echo $pre_add_d;?>"></td>
											
										</tr>
										<tr>
											<td>Pincode</td>
											<td><input validate="pincode" type="text"  class="form-control text-uppercase" maxlength="6" name="pre_add[p]" value="<?php echo $pre_add_p;?>"></td>
											<td>Mobile no.</td>
											<td><input validate="mobileNumber" type="text" name="pre_add[mno]" class="form-control text-uppercase" maxlength="10" value="<?php echo $pre_add_mno;?>"></td>
										</tr>
										
										<tr>
										   <td>5. Proposed Site's Location :</td>
										</tr>
										<tr>
											<td>Plot No </td>
											<td><input type="text" class="form-control text-uppercase" name="site_loc[p]" id="site_loc_p" value="<?php echo $site_loc_p;?>"/></td>
											<td>Dag No </td>
											<td><input type="text" class="form-control text-uppercase" name="site_loc[da]" id="site_loc_da" value="<?php echo $site_loc_da;?>"/></td>
										</tr>
										<tr >
											<td>Patta No</td>
											<td><input type="text" class="form-control text-uppercase" name="site_loc[pt]" id="site_loc_pt" value="<?php echo $site_loc_pt;?>"></td>
										</tr>
										<tr>
											<td>City/Town </td>
											<td><input type="text" class="form-control text-uppercase" name="site_loc[ct]" id="site_loc_ct" value="<?php echo $site_loc_ct;?>"></td>
											<td>Zip/Pincode </td>
										   <td><input type="text" class="form-control text-uppercase" validate="pincode"   maxlength="6" name="site_loc[z]" id="site_loc_z" value="<?php echo $site_loc_z;?>"/></td>
										</tr>
										<tr>
                                       <td>District <span class="mandatory_field">*</span> </td>
											
                                              <td><input type="text" class="form-control text-uppercase" name="site_loc[d]" id="d" value="<?php echo $site_loc_d;?>"></td>
								
										
									       <td>Area type </td>
										    <td>
          										<select name="area_type[a]" required="required" class="form-control text-uppercase">
														<option value="">Choose an Area</option>
														<option value="U" <?php if($area_type_a=="U") echo "selected"; ?>>Urban.</option>
														<option value="R" <?php if($area_type_a=="R") echo "selected"; ?>>Rural
													</select>
									       </td>
									    
										</tr>
										<tr>
											<td>6. Proposed site name,Building for Retail shop : </td>
											<td><input type="text" value="<?php echo $proposed_site; ?>" class="form-control text-uppercase" name="proposed_site" id="proposed_site" ></td>
											<td>7. Your previous License No. held with Validity (if any) :</td>
											<td><input type="text" value="<?php echo $pre_license_no; ?>" class="form-control text-uppercase" name="pre_license_no" id="pre_license_no"></td>
										</tr>
										<tr>
											<td>8. Previous License No. held by partner(s) with Validity (if any) :</td>
											<td><input type="text" class="form-control text-uppercase" name="previ_licno_validity" id="previ_licno_validity" value="<?php echo $previ_licno_validity;?>"/></td>
									   </tr>
									   <tr>
								         <td>9. Tax Liabilities (if any) :</td>
								         <td>
											<label class="radio-inline"><input type="radio" name="is_liabilities" class="is_liabilities" value="Y"  <?php if(isset($is_liabilities) && $is_liabilities=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="is_liabilities" name="is_liabilities"  value="N"  <?php if(isset($is_liabilities) && ($is_liabilities=='N' || $is_liabilities=='')) echo 'checked'; ?>/> No</label>
									    </td>
										 <td>10. Trade License (if applicable) :</td>
								         <td>
											<label class="radio-inline"><input type="radio" name="is_license" class="is_license" value="Y"  <?php if(isset($is_license) && $is_license=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline"><input type="radio" class="is_license" name="is_license"  value="N"  <?php if(isset($is_license) && ($is_license=='N' || $is_license=='')) echo 'checked'; ?> /> No</label>
									    </td>
								    </tr>
									<tr>
											<td width="25%">11. Distance from Institutions :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_distance[i]" id="site_distance_i" value="<?php echo $site_distance_i;?>"/></td>
											<td width="25%">12. Distance from National and State Highway. :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_distance[s]" id="site_distance_s" value="<?php echo $site_distance_s;?>"/></td>
									</tr>
									<tr>
											<td width="25%">13. Distance from shop(similar) :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_distance[sp]" id="site_distance_sp" value="<?php echo $site_distance_sp;?>"/></td>
									       <td> 14.  Caste : </td>
										    <td>
          										<select name="caste_o[a]" required="required" class="form-control text-uppercase">
														<option value="">Choose caste</option>
														<option value="G" <?php if($caste_o_a=="G") echo "selected"; ?>>General</option>
														<option value="O" <?php if($caste_o_a=="O") echo "selected"; ?>>OBC</option>
														<option value="M" <?php if($caste_o_a=="M") echo "selected"; ?>>MOBC</option>
														<option value="S" <?php if($caste_o_a=="S") echo "selected"; ?>>SC</option>
														<option value="T" <?php if($caste_o_a=="T") echo "selected"; ?>>ST</option>
												</select>
									       </td>
									</tr>
									 <tr>
									    <td colspan="4"><b>Declaration</b><span class="mandatory_field">*</span><br/></td>
								    </tr>
								    <tr class="form-inline">
									    <td colspan="4">&nbsp;&nbsp;I/We here by declare that the particulars furnished above are true and correct to me/our belief/knowledge. I/We further accept that if any particular furnished in the application is subsiquently found to be false,inaccurate or imcomplete,the license,if any granted to me/as on the basis of application will be liable for inatant cancellation without prejudice to other action may be taken against me/us under the law. </td>
								    </tr>
								    <tr>
										<td>Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> 
										<td></td><td></td>
										<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>	
								    </tr>
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save and Next</button>
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

	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
</script>
