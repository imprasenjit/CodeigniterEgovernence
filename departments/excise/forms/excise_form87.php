<?php  require_once "../../requires/login_session.php";
$dept="excise";
$form="87";
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
				$applicant_age=$results["applicant_age"];$edu_quali=$results["edu_quali"];
				$proposed_site_name=$results["proposed_site_name"];$prev_license_no1=$results["prev_license_no1"];$prev_license_no2=$results["prev_license_no2"];
				$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];
				
				if(!empty($results["present_address"])){
					$present_address=json_decode($results["present_address"]);
					$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
				}else{				
					$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
				}
				if(!empty($results["site_loc"])){
					$site_loc=json_decode($results["site_loc"]);
					if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
					if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
					if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
					if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
					if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
					if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
					
				}else{				
					$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_z="";
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
			}else{ 
				$form_id="";
				$applicant_age="";$edu_quali="";
				$present_address_sn1=$street_name1;$present_address_sn2=$street_name2;$present_address_vil=$vill;$present_address_dist=$dist;$present_address_pin=$pincode;$present_address_mobile_no=$mobile_no;$present_address_email=$email;
				$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_z="";
				$proposed_site_name="";$prev_license_no1="";$prev_license_no2="";
				$is_liabilities="";
				$site_distance_i="";$site_distance_s="";$site_distance_sp="";
				$caste_o_a="";$is_license="";
			}
		}else{
            $results=$q->fetch_array();				
			$form_id=$results["form_id"];
			$applicant_age=$results["applicant_age"];$edu_quali=$results["edu_quali"];
			$proposed_site_name=$results["proposed_site_name"];$prev_license_no1=$results["prev_license_no1"];$prev_license_no2=$results["prev_license_no2"];
			$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];
			
			if(!empty($results["present_address"])){
				$present_address=json_decode($results["present_address"]);
				$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
			}else{				
				$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
			}
			if(!empty($results["site_loc"])){
				$site_loc=json_decode($results["site_loc"]);
				if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
				if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
				if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
				if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
				if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
				if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
				
			}else{				
				$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_z="";
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
							<td width="25%">1. Name of Applicant :</td>
							<td width="25%"><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
							
						</tr>
						<tr>
							<td width="25%">2. Age :</td>
							<td width="25%"><input type="text" value="<?php echo $applicant_age; ?>" class="form-control text-uppercase" name="applicant_age"></td>
							<td width="25%">3. Educational Qualification :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" name="edu_quali" value="<?php echo $edu_quali; ?>"></td>
						</tr>
						
						<tr>
							<td colspan="4">4. Applicant Present Address :</td>
						</tr>
						
						<tr>
							<td>Street Name1 :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[sn1]"  value="<?php echo $present_address_sn1; ?>"></td>
							<td>Street Name2 :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[sn2]"  value="<?php echo $present_address_sn2; ?>" ></td>
						</tr>
						<tr>
							<td>Village/Town :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[vill]"   value="<?php echo $present_address_vil; ?>"></td>
							<td>District :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[dist]"  value="<?php echo $present_address_dist; ?>"></td>
						</tr>
						<tr>
							<td>Pin Code :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[pin]" value="<?php echo $present_address_pin; ?>" maxlength="6"></td>
							<td>Mobile No :</td>
							<td><input type="text" class="form-control text-uppercase" name="present_address[mobile_no]" maxlength="10" value="<?php echo $present_address_mobile_no; ?>"></td>
						</tr>
						<tr>
							<td>Email-id. :</td>
							<td><input type="email" class="form-control " name="present_address[email]"  value="<?php echo $present_address_email; ?>"></td>
							
						</tr>
						<tr>
							<td colspan="4">5. Applicant Permanent Address :</td>
						</tr>
						<tr>
							<td width="25%">Street Name 1 :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
							<td width="25%">Street Name 2 :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
						</tr>
						<tr>
							<td>Village/Town :</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
							<td>District :</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
						</tr>
						<tr>
							<td>Pincode :</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
							<td>Mobile No. :</td>
							<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
						</tr>
						<tr>
						    <td>Email-id. :</td>
							<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
						</tr>
						<tr>
							<td colspan="4">Other Details</td>
						</tr>
						<tr>
							<td colspan="4">6. Proposed Site's Location :</td>
						</tr>
						<tr>
								<td>Plot No :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_loc[p]" id="site_loc_p" value="<?php echo $site_loc_p;?>"/></td>
								<td>Dag No :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_loc[da]" id="site_loc_da" value="<?php echo $site_loc_da;?>"/></td>
						</tr>
						<tr>
								<td>Patta No :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_loc[pt]" id="site_loc_pt" value="<?php echo $site_loc_pt;?>"></td>
								<td>City/Town :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_loc[ct]" id="site_loc_ct" value="<?php echo $site_loc_ct;?>"></td>
						</tr>
						<tr>
								<td>District :<span class="mandatory_field">*</span> </td>
								 <td><input type="text" class="form-control text-uppercase" name="site_loc[d]" id="d" value="<?php echo $site_loc_d;?>"></td>
								
								<td>Zip/Pincode</td>
								<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="site_loc[z]" id="site_loc_z" value="<?php echo $site_loc_z;?>"/></td>
						</tr>
						<tr>
								<td>7. Proposed site name, Building for retail shop : </td>
								<td><textarea name="proposed_site_name" class="form-control text-uppercase"><?php echo $proposed_site_name; ?></textarea></td>	
								<td>8. Your previous license No. held with validity (if any) :</td>
								<td><textarea name="prev_license_no1" class="form-control text-uppercase"><?php echo $prev_license_no1; ?></textarea></td>	
						</tr>
					   
					   <tr>
								<td>9. Your previous license No. held by Partner(s) with validity (if any) :</td>
								<td><textarea name="prev_license_no2" class="form-control text-uppercase"><?php echo $prev_license_no2; ?></textarea></td>
								<td>10. Tax Liabilities (if any) :</td>
								<td><label class="radio-inline"><input type="radio" name="is_liabilities" class="is_liabilities" value="Y"  <?php if(isset($is_liabilities) && $is_liabilities=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="radio-inline"><input type="radio" class="is_liabilities" name="is_liabilities"  value="N"  <?php if(isset($is_liabilities) && ($is_liabilities=='N' || $is_liabilities=='')) echo 'checked'; ?>/> No</label></td>
								
						</tr>
						<tr>
								<td>11. Distance from Institutions :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_distance[i]" id="site_distance_i" value="<?php echo $site_distance_i;?>"/></td>
								<td>12. Distance from National and State Highway. :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_distance[s]" id="site_distance_s" value="<?php echo $site_distance_s;?>"/></td>
						</tr>
						<tr>
								<td>13. Distance from shop(similar) :</td>
								<td><input type="text" class="form-control text-uppercase" name="site_distance[sp]" id="site_distance_sp" value="<?php echo $site_distance_sp;?>"/></td>
								<td>14. Caste : </td>
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
								
								<td>15. Trade License (if applicable) :</td>
								<td><label class="radio-inline"><input type="radio" name="is_license" class="is_license" value="Y"  <?php if(isset($is_license) && $is_license=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
								<label class="radio-inline"><input type="radio" class="is_license" name="is_license"  value="N"  <?php if(isset($is_license) && ($is_license=='N' || $is_license=='')) echo 'checked'; ?> /> No</label></td>
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
