<?php  require_once "../../requires/login_session.php";
$dept="excise";
$form="1";
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
			$owner_age=$results["owner_age"];$plant_proposed=$results["plant_proposed"];$building_proposed=$results["building_proposed"];$edu_quali=$results["edu_quali"];$state=$results["state"];
			
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
				if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
				
			}else{				
				$site_distance_i="";$site_distance_s="";
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
			if(!empty($results["site_high"])){
				$site_high=json_decode($results["site_high"]);
				if(isset($site_high->a)) $site_high_a=$site_high->a; else $site_high_a="";
				if(isset($site_high->b)) $site_high_b=$site_high->b; else $site_high_b="";
			}else{				
				$site_high_a="";$site_high_b="";
			}
		}else{
			$form_id="";
			$owner_age="";$edu_quali="";
			$site_loc_p="";$site_loc_da="";$site_loc_d="";$site_loc_pt="";$site_loc_ct="";$site_loc_z="";$plant_proposed="";$building_proposed="";
			$site_distance_i="";$site_distance_s="";$state="";
			$site_high_a="";$site_high_b="";
		}
	}else{
            $results=$q->fetch_array();			
			$form_id=$results["form_id"];
			$owner_age=$results["owner_age"];$plant_proposed=$results["plant_proposed"];$building_proposed=$results["building_proposed"];$edu_quali=$results["edu_quali"];$state=$results["state"];
			
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
				if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
				
			}else{				
				$site_distance_i="";$site_distance_s="";
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
			if(!empty($results["site_high"])){
				$site_high=json_decode($results["site_high"]);
				if(isset($site_high->a)) $site_high_a=$site_high->a; else $site_high_a="";
				if(isset($site_high->b)) $site_high_b=$site_high->b; else $site_high_b="";
			}else{				
				$site_high_a="";$site_high_b="";
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
											<td colspan="4">1. Name and Address of the Applicant :</td>
										</tr>
										<tr>
											<td>Applicant Name</td>
											<td><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
										</tr>
										<tr>
											<td colspan="4">Address</td>
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
											<td>3. State :</td>
											<td><input type="text" value="<?php echo $state; ?>" class="form-control text-uppercase"  name="state"></td>
											<td>4. Education qualification of the applicant :</td>
											<td><input type="text" value="<?php echo $edu_quali; ?>" class="form-control text-uppercase" placeholder="Highest qualification" name="edu_quali"></td>
										</tr>
										<tr>
											<td>5. Age of the applicant(with proof of age) : </td>
											<td><input validate="onlyNumbers" type="text"  id="owner_age" value="<?php echo $owner_age; ?>" name="owner_age" class="form-control text-uppercase"></td>
										</tr>
										
										<tr>
										   <td>6. Proposed Site's Location :</td>
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
											
											<td>Zip/Pincode :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_loc[z]" id="site_loc_z" validate="pincode" maxlength="6" value="<?php echo $site_loc_z;?>"/></td>
										</tr>
										<tr>
											<td width="25%">7. Purpose for which the plant is proposed to be opened. :</td>
											<td><textarea name="plant_proposed"  id="plant_proposed" class="form-control text-uppercase"><?php echo $plant_proposed; ?></textarea></td>	
											<td width="25%">8. Site on which proposed building of plants to be set up. :</td>
											<td><textarea name="building_proposed"  id="building_proposed" class="form-control text-uppercase"><?php echo $building_proposed; ?></textarea></td>
										</tr>
										<tr>
											<td width="25%">9. Distance from Institutions :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_distance[i]" id="site_distance_i" value="<?php echo $site_distance_i;?>"/></td>
											<td width="25%">10. Distance from National and State Highway. :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_distance[s]" id="site_distance_s" value="<?php echo $site_distance_s;?>"/></td>
										</tr>
										<tr>
											<td colspan="4">11. Distance of the proposed site from  :</td>
										</tr>
										<tr>
											<td width="25%">(a)National Highways :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_high[a]" id="site_high_a" value="<?php echo $site_high_a;?>"/></td>
											<td width="25%">(b) State Highways :</td>
											<td><input type="text" class="form-control text-uppercase" name="site_high[b]" id="site_high_b" value="<?php echo $site_high_b;?>"/></td>
										</tr>
								    <tr>
									    <td colspan="4"><b>Declaration</b><span class="mandatory_field">*</span><br/></td>
								    </tr>
								    <tr class="form-inline">
									    <td colspan="4">&nbsp;&nbsp;I/We here by declare that the particulars furnished above are true and correct to me/our belief/knowledge. I/We further accept that if any particular furnished in the application is subsiquently found to be false,inaccurate or imcomplete,the license,if any granted to me/as on the basis of application will be liable for inatant cancellation without prejudice to other action may be taken against me/us under thr law. </td>
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

	function calculateAge()
	{
		var dob = new Date(y,m.d);
		alert();
		dob.setFullYear(y, m-1, d);
		
		var today = new Date();
		today.setFullYear(today.getFullYear());
		var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
		return age;
	}

	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('.dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
</script>
