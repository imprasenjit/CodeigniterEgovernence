<?php  require_once "../../requires/login_session.php";
$dept="excise";
$form="11";
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
			$name_father=$results["name_father"];$edu_quali=$results["edu_quali"];$owner_age=$results["owner_age"];
			$sex_applicant=$results["sex_applicant"];$state=$results["state"];$pre_past_occupation=$results["pre_past_occupation"];
			
			$is_citizen=$results["is_citizen"];$is_criminal=$results["is_criminal"];$proposed_plant=$results["proposed_plant"];$apparatus_description=$results["apparatus_description"];$plant_site=$results["plant_site"];$ten_date=$results["ten_date"];$esti_quantity=$results["esti_quantity"];$is_servant=$results["is_servant"];$is_pollution=$results["is_pollution"];
			
			
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
			
			if(!empty($results["bond_limit"])){
				$bond_limit=json_decode($results["bond_limit"]);
				if(isset($bond_limit->a)) $bond_limit_a=$bond_limit->a; 
				
			}else{				
				$bond_limit_a="";
			}
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->a)) $site_distance_a=$site_distance->a; else $site_distance_a="";
				if(isset($site_distance->b)) $site_distance_b=$site_distance->b; else $site_distance_b="";
			}else{				
				$site_distance_a="";$site_distance_b="";
			}
		}else{
			$form_id="";
			$name_father="";$edu_quali="";$owner_age="";
			$sex_applicant="";$state="";$pre_past_occupation="";$is_citizen="";$is_criminal="";$proposed_plant="";		
			$apparatus_description="";
			$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_z="";
			$plant_site="";$ten_date="";$esti_quantity="";
			
			$site_distance_a="";$site_distance_b="";$is_servant="";$bond_limit_a="";$is_pollution="";
		}
	}else{	
            $results=$q->fetch_array();		
			$form_id=$results["form_id"];
			$name_father=$results["name_father"];$edu_quali=$results["edu_quali"];$owner_age=$results["owner_age"];
			$sex_applicant=$results["sex_applicant"];$state=$results["state"];$pre_past_occupation=$results["pre_past_occupation"];
			
			$is_citizen=$results["is_citizen"];$is_criminal=$results["is_criminal"];$proposed_plant=$results["proposed_plant"];$apparatus_description=$results["apparatus_description"];$plant_site=$results["plant_site"];$ten_date=$results["ten_date"];$esti_quantity=$results["esti_quantity"];$is_servant=$results["is_servant"];$is_pollution=$results["is_pollution"];
			
			
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
			
			if(!empty($results["bond_limit"])){
				$bond_limit=json_decode($results["bond_limit"]);
				if(isset($bond_limit->a)) $bond_limit_a=$bond_limit->a; 
				
			}else{				
				$bond_limit_a="";
			}
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->a)) $site_distance_a=$site_distance->a; else $site_distance_a="";
				if(isset($site_distance->b)) $site_distance_b=$site_distance->b; else $site_distance_b="";
			}else{				
				$site_distance_a="";$site_distance_b="";
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
							<td>1.Name of Applicant :</td>
							<td><input  type="text" value="<?php echo $key_person; ?>" class="form-control text-uppercase" disabled></td>
						</tr>
						<tr>
							<td width="25%">2.Name of Father/Husband :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" name="name_father" value="<?php echo $name_father; ?>"></td>
							<td width="25%">3.Sex of Applicant :</td>
							<td width="25%"><input type="text" class="form-control text-uppercase" name="sex_applicant" value="<?php echo $sex_applicant; ?>"></td>
						</tr>
						<tr>
							<td>Age of the applicant :</td>
							<td><input type="text" value="<?php echo $owner_age; ?>" class="form-control text-uppercase"  name="owner_age" validate="onlyNumbers"></td>
						</tr>
						
						<tr>
							<td>4. Educational Qualification :</td>
							<td><input type="text" class="form-control text-uppercase" placeholder="Highest Qualification" name="edu_quali" value="<?php echo $edu_quali; ?>"></td>
						</tr>
						<tr>
							<td colspan="4">5. Address of the Applicant :</td>
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
						    <td>Email id </td>
							<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
							<td>State </td>
							<td><input type="text" value="<?php echo $state; ?>" class="form-control text-uppercase"  name="state"></td>
						</tr>
						<tr>
							<td>6. Present and Past Occupation of the Applicant :</td>
							<td><textarea name="pre_past_occupation"  id="pre_past_occupation" class="form-control text-uppercase"><?php echo $pre_past_occupation; ?></textarea></td>	
							<td>7. Whether the Applicant is a citizen of India as defined in articles 5 & 8 of the Constitution :</td>
							<td>
							<label class="radio-inline"><input type="radio" name="is_citizen" class="is_citizen" value="Y"  <?php if(isset($is_citizen) && $is_citizen=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" class="is_citizen" name="is_citizen"  value="N"  <?php if(isset($is_citizen) && ($is_citizen=='N' || $is_citizen=='')) echo 'checked'; ?>/> No</label>
						    </td>
						</tr>
						<tr>
							
							<td>8. Ever Convicted by a Criminal Court ?</td>
							<td><label class="radio-inline"><input type="radio" name="is_criminal" class="is_criminal" value="Y"  <?php if(isset($is_criminal) && $is_criminal=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" class="is_criminal" name="is_criminal"  value="N"  <?php if(isset($is_criminal) && ($is_criminal=='N' || $is_criminal=='')) echo 'checked'; ?>/> No</label></td>
							<td>9. Purposed  of the proposed plant : </td>
							<td><input type="text" value="<?php echo $proposed_plant; ?>" class="form-control text-uppercase" name="proposed_plant" id="proposed_plant" ></td>
						</tr>
						<tr>
							   <td>10. Proposed Site's Location :</td>
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
								<td>District : <span class="mandatory_field">*</span> </td>
                                <td><input type="text" class="form-control text-uppercase" name="site_loc[d]" id="d" value="<?php echo $site_loc_d;?>"></td>
								
								<td>Zip/Pincode :</td>
								<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" name="site_loc[z]" id="site_loc_z" value="<?php echo $site_loc_z;?>"/></td>
						</tr>
					   <tr>
								<td width="25%">11. Plant site :</td>
								<td><textarea name="plant_site"  id="plant_site" class="form-control text-uppercase"><?php echo $plant_site; ?></textarea></td>	
								<td width="25%">12. Apparatus Description :</td>
								<td><textarea name="apparatus_description"  id="apparatus_description" class="form-control text-uppercase"><?php echo $apparatus_description; ?></textarea></td>	
						</tr>
						<tr>
							  <td>13. Tentative date :</td>
							  <td><input type="text" class="dob form-control text-uppercase" name="ten_date" id="ten_date" value="<?php echo $ten_date;?>"/></td>
						</tr>
						<tr>
							<td width="25%">14. Estimated quantity :</td>
							<td><textarea name="esti_quantity"  id="esti_quantity" class="form-control text-uppercase"><?php echo $esti_quantity; ?></textarea></td>	
						   <td>15. Bond limit : </td>
							<td>
								<select name="bond_limit[a]" required="required" class="form-control text-uppercase">
										<option value="">Choose an option</option>
										<option value="A" <?php if($bond_limit_a=="A") echo "selected"; ?>>Bondlimit 50 Lakh</option>
										<option value="B" <?php if($bond_limit_a=="B") echo "selected"; ?>>Bondlimit 50 Lakhto 1 crore</option>
										<option value="C" <?php if($bond_limit_a=="C") echo "selected"; ?>>Bondlimit above 1 crore</option>
								</select>
						   </td>
					  </tr>
					  <tr>
							<td>16. Enviromental pollution,if :</td>
							<td>
							<label class="radio-inline"><input type="radio" name="is_pollution" class="is_pollution" value="Y"  <?php if(isset($is_pollution) && $is_pollution=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" class="is_pollution" name="is_pollution"  value="N"  <?php if(isset($is_pollution) && ($is_pollution=='N' || $is_pollution=='')) echo 'checked'; ?>/> No</label>
						    </td>
							<td>17. Distance from Institutions :</td>
							 <td><input type="text" class="form-control text-uppercase" name="site_distance[a]" id="site_distance_a" value="<?php echo $site_distance_a;?>"/></td>
						</tr>
						<tr>
							<td>18. Distance from National/State Highway :</td>
							 <td><input type="text" class="form-control text-uppercase" name="site_distance[b]" id="site_distance_b" value="<?php echo $site_distance_b;?>"/></td>
							 <td>19. Related to any Government servant,if :</td>
							<td>
							<label class="radio-inline"><input type="radio" name="is_servant" class="is_servant" value="Y"  <?php if(isset($is_servant) && $is_servant=='Y') echo 'checked'; ?> required="required" /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;
							<label class="radio-inline"><input type="radio" class="is_servant" name="is_servant"  value="N"  <?php if(isset($is_servant) && ($is_servant=='N' || $is_servant=='')) echo 'checked'; ?>/> No</label>
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
	
$('#country_spirit').attr('readonly','readonly');
	<?php if($is_sprit == 'Y') echo "$('#country_spirit').removeAttr('readonly','readonly');"; ?>
	$('.is_sprit').on('change', function(){
		if($(this).val() == 'Y'){
			$('#country_spirit').removeAttr('readonly','readonly');
		}else{
			$('#country_spirit').attr('readonly','readonly');
			$('#country_spirit').val('');
		}			
	});
	
	
	/* ------------------------------------------------------ */	
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
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>
