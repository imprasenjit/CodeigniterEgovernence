<?php  require_once "../../requires/login_session.php";
$dept="dsedu";
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
			$form_id=$results["form_id"];$education_stage=$results["education_stage"];$inst_location=$results["inst_location"];$measure_land=$results["measure_land"];$land_status=$results["land_status"];$instutition_names=$results["instutition_names"];$proposed_scheme=$results["proposed_scheme"];$capacity=$results["capacity"];$academic=$results["academic"];$time_frame=$results["time_frame"];$ins_name=$results["ins_name"];	$fee_structure=$results["fee_structure"];$finan_status=$results["finan_status"];$project_cost=$results["project_cost"];$funds=$results["funds"];$is_residential=$results["is_residential"];$is_registration=$results["is_registration"];
			if(!empty($results["is_nonResidential"])){
				$is_nonResidential=json_decode($results["is_nonResidential"]);
				$is_nonResidential_a=$is_nonResidential->a;$is_nonResidential_b=$is_nonResidential->b;
			}else{				
				$is_nonResidential_a="";$is_nonResidential_b="";
			}				
			if(!empty($results["semi_residential"])){
				$semi_residential=json_decode($results["semi_residential"]);
				$semi_residential_a=$semi_residential->a;$semi_residential_b=$semi_residential->b;
			}else{				
				$semi_residential_a="";$semi_residential_b="";
			}
		}else{	
			$form_id="";$is_="";$education_stage="";$inst_location="";$measure_land="";$land_status="";$instutition_names="";$proposed_scheme="";$is_residential="";$capacity="";$academic="";$ins_name="";$funds="";$fee_structure="";$finan_status="";$project_cost="";$time_frame="";$dist2="";$pin2="";$parking="";
			$is_registration_a="";$is_registration_b="";
			$is_nonResidential_a="";$is_nonResidential_b="";
			$semi_residential_a="";$semi_residential_b="";
		}
	}else{			
		$results=$q->fetch_array();
		$form_id=$results["form_id"];$education_stage=$results["education_stage"];$inst_location=$results["inst_location"];$measure_land=$results["measure_land"];$land_status=$results["land_status"];$instutition_names=$results["instutition_names"];$proposed_scheme=$results["proposed_scheme"];$capacity=$results["capacity"];$academic=$results["academic"];$time_frame=$results["time_frame"];$ins_name=$results["ins_name"];	$fee_structure=$results["fee_structure"];$finan_status=$results["finan_status"];$project_cost=$results["project_cost"];$funds=$results["funds"];$is_residential=$results["is_residential"];$is_registration=$results["is_registration"];
		if(!empty($results["is_nonResidential"])){
			$is_nonResidential=json_decode($results["is_nonResidential"]);
			$is_nonResidential_a=$is_nonResidential->a;$is_nonResidential_b=$is_nonResidential->b;
		}else{				
			$is_nonResidential_a="";$is_nonResidential_b="";
		}				
		if(!empty($results["semi_residential"])){
			$semi_residential=json_decode($results["semi_residential"]);
			$semi_residential_a=$semi_residential->a;$semi_residential_b=$semi_residential->b;
		}else{				
			$semi_residential_a="";$semi_residential_b="";
		}	
	}
	$q1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
	if($q1->num_rows<1){
		$form_id="";
		$address="";$pincode="";$contact="";
	}else{
		$results1=$q1->fetch_array();
		$form_id=$results1['form_id'];
		$address=$results1['address'];$pincode=$results1['pincode'];$contact=$results1['contact'];
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							  <li class="<?php echo $tabbtn1; ?>"><a  href="javascript:void(0)">Part 1</a></li>
							  <li class="<?php echo $tabbtn2; ?>"><a  href="javascript:void(0)">Part 2</a></li>
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">
											<tr>
												<td colspan="3">1. Name of the Organization/ Individual/Group of individuals/ Society/ Trust</td>
												<td ><input validate="specialChar" type="text" value="<?php echo $unit_name; ?>" class="form-control text-uppercase" disabled></td>
											</tr>
											<tr>
												<td colspan="4">2. Full Postal Address with Pin code and contact telephone No</td>
											</tr>
											<tr>
												<td width="25%">Street Name1 :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name1; ?>"	></td>
												<td width="25%">Street Name2:</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_vill; ?>"></td>
												<td>District :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_dist; ?>"></td>
											</tr>
											<tr>
												<td>Pin Code :</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $b_pincode; ?>"></td>
												<td>Mobile No:</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$b_mobile_no; ?>"></td>
											</tr>
											<tr>
												<td colspan="4">3. Name of Members of the organization	with postal address and contact with postal address and contact the telephone No.  </td>
											</tr>
											<tr>
												<td colspan="4">
											<table class="table table-responsive text-center">
											<thead>
												<tr >
													<th>Sl. No.</th>
													<th>Name</th>
													<th>Address</th>
													<th>Pincode</th>
													<th>Contact No</th>
												</tr>
											</thead>	
												<?php 
												$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");		
												if($member_results->num_rows==0){
													for($i=1;$i<=count($owners);$i++){ ?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
														<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
														<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
														<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="" ></td>
													</tr>
													<?php } ?>
													<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
												<?php }else{
														$i=1;
												while($rows=$member_results->fetch_object()){ ?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
														<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $rows->address; ?>" /></td>
														<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
														<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
													</tr>
												<?php $i++;
												} ?>
													<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
												<?php } ?>									
												</td>
												</tr>
												</table></td>
											</tr>
											<tr>
												<td colspan="3">4. Whether registered under the Registration  of  Societies  Act 1860. (Copies of audited accounts	for last 3 years are to be enclosed).If yes?  Please enclose  a   copy  of  the  Registration Certificate.</td>
												<td><label class="radio-inline"><input type="radio" name="is_registration" class="is_registration" value="Y"  <?php if(isset($is_registration) && $is_registration=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="is_registration"  value="N"  name="is_registration" <?php if(isset($is_registration) && $is_registration=='N') echo 'checked'; ?> checked /> No</label></td>
											</tr>
											<tr>
												<td>5. Proposed name of the Education Institution to be established.</td>
												<td><input validate="letters" type="text" name="ins_name" value="<?php echo $ins_name; ?>" class="form-control text-uppercase"></td>
												<td>6.Stage(s) of Education  proposed to be imparted?</td>
												<td>
												<?php 
													if($education_stage!=""){
														$education_stage_array=Array();
														$education_stage_array=explode(",",$education_stage);
													}else{
														$education_stage_array=Array();
													}
												?>
												<div class="checkbox" id="stage">
													<label class="checkbox-inline">
														<input type="checkbox" <?php if(in_array("P",$education_stage_array)) echo "checked"; ?> value="P" name="education_stage[]" class="education_stage"> Primary
													</label>
													<br/>
													<label class="checkbox-inline">
														<input type="checkbox" <?php if(in_array("M",$education_stage_array)) echo "checked"; ?> value="M" name="education_stage[]" class="education_stage" value="M"> Middle
													</label><br/>
													<label class="checkbox-inline">
														<input type="checkbox" <?php if(in_array("S",$education_stage_array)) echo "checked"; ?> value="S" name="education_stage[]" class="education_stage" value="S"> Secondary
													</label><br/>
													<label class="checkbox-inline">
														<input type="checkbox" <?php if(in_array("H",$education_stage_array)) echo "checked"; ?> value="H" name="education_stage[]" class="education_stage" value="H"> Higher Secondary
													</label>
												</div>
											</td>
											</tr>
											<tr>
												<td>7. Location of the proposed institution</td>
												<td><select class="form-control text-uppercase" name="inst_location">
												<option value="">Please Select</option>
												<option value="R" <?php if($inst_location=="R") echo "selected";?>>Rural</option>
												<option value="SU" <?php if($inst_location=="SU") echo "selected";?>>Semi Urban</option>
												<option value="U" <?php if($inst_location=="U") echo "selected";?>>Urban</option>
												</select></td>
												<td>&nbsp;</td>
												<td>&nbsp;</td>
											</tr>
											<tr>
												<td colspan="3">8. Names of same category of institutions of the  neighbouring  area  of  the  proposed institution  within  a radius of 1 km  in case of Primary, 3 km in case of Middle, 5 km in case of Secondary and 10 km in case of  Higher  Secondary  level ofinstitutions (including all govt. prov. and non govt. institutions)</td>
												<td><input  type="text" value="<?php echo $instutition_names; ?>" name="instutition_names" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>9. Measurement of the land in possession</td>
												<td><input type="text" name="measure_land" value="<?php echo $measure_land; ?>" class="form-control text-uppercase" ></td>
												<td>10. Status of land (Myadi patta/ Annual patta/  Govt. allotment/  Lease) under occupation. (copies of land documentto be attached)</td>
												<td><input type="text" name="land_status" value="<?php echo $land_status; ?>" class="form-control text-uppercase"></td>
											</tr>															
										<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" id="submit" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
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
												<td width="25%">11. In case of lease holder, the copy of the lease document is to be attached.</td>
												<td width="25%">Document to be attached</td>
												<td width="25%">12. Proposed Scheme of management for establishment  of  the  Educational institution  for  which  permission is sought for.</td>
												<td width="25%"><input type="text" name="proposed_scheme" value="<?php echo $proposed_scheme; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>13. What would be the intake capacity? (class-wise)</td>
												<td><input type="text" name="capacity" validate="onlyNumbers" value="<?php echo $capacity; ?>" class="form-control text-uppercase"></td>
												<td>14. Whether  it  would  be  completely residential?</td>
												<td><label class="radio-inline"><input type="radio" name="is_residential" id="is_residential" value="Y"  <?php if(isset($is_residential) && $is_residential=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_residential"  value="N"  id="is_residential" <?php if(isset($is_residential) && $is_residential=='N') echo 'checked'; ?> /> No</label></td>
											</tr>
											<tr>
												<td>15. Whether it would be non-residential?</td>
												<td>
												<label class="radio-inline"><input type="radio" name="is_nonResidential[a]" class="is_nonResidential_a" value="Y"  <?php if(isset($is_nonResidential_a) && $is_nonResidential_a=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="is_nonResidential_a"  value="N"  name="is_nonResidential[a]" <?php if(isset($is_nonResidential_a) && ($is_nonResidential_a=='N' || $is_nonResidential_a=='')) echo 'checked'; ?>/> No</label>
												</td>
												<td>If  yes, what  would  be  the  mode of  transport  facility  for  students? </td>
												<td><input  type="text" name="is_nonResidential[b]" id="is_nonResidential_b" value="<?php echo $is_nonResidential_b; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>16. Whether it would be semi residential? </td>		
												<td>
												<label class="radio-inline"><input type="radio" name="semi_residential[a]" class="semi_residential_a" value="Y"  <?php if(isset($semi_residential_a) && $semi_residential_a=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" class="semi_residential_a"  value="N"  name="semi_residential[a]" <?php if(isset($semi_residential_a) && ($semi_residential_a=='N' || $semi_residential_a=='')) echo 'checked'; ?>  /> No</label>
												</td>
												<td>If yes, please furnish No. & Date of such permission (a copy of permission letter to be enclosed)</td>
												<td><input  type="text" name="semi_residential[b]" id="semi_residential_b" value="<?php echo $semi_residential_b; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>17.	Copy of the Plan and estimate of the proposed  buildings  and   other infrastructures. (Indicate the number of classroom and other infrastructures to be constructed initially).</td>
												<td>Document to be attached</td>
												<td>18.	What is the time frame for completion of the proposed construction?</td>
												<td><input type="text" name="time_frame" value="<?php echo $time_frame; ?>" class="time form-control text-uppercase" ></td>
											</tr>
											<tr>
												<td>19.	From  which  academic  session, the	class(s) will  be  started?</td>
												<td><input type="text" name="academic" value="<?php echo $academic; ?>" class="form-control text-uppercase" ></td>
												<td>20.	What would be the project cost? (Itemwise estimate is to be attached)</td>
												<td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" value="<?php echo $project_cost; ?>" name="project_cost" ></td>
											</tr>
											<tr>
												<td>21.	Probable sources of funds</td>
												<td><input type="text" class="form-control text-uppercase" name="funds" value="<?php echo $funds; ?>"></td>
												<td>22.	What would be the maximum  probable	fee structure? (Item-wise and year-wise	breakup  per  student per  class is to be furnished)</td>
												<td><input type="text" validate="onlyNumbers" class="form-control text-uppercase" name="fee_structure" value="<?php echo $fee_structure; ?>" ></td>
											</tr>
											<tr>
												<td>23.	What  is  the  present financial  status? (documents in support are to be attached)</td>
												<td><input type="text" class="form-control text-uppercase" name="finan_status" value="<?php echo $finan_status; ?>" ></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Date :</td>
												<td><label ><?php echo $today;?></label></td>
												<td>Signature of Authorized Signatory</td>
												<td><strong><?php echo strtoupper($key_person)?></strong></td>
											</tr>	  
											<tr>
												<td></td>
												<td class="text-center" colspan="2">
													<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary avoid_me submit1">Go Back & Edit</a>&nbsp;<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>b" class="btn btn-success">Save and Next</button>
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
	
/*$('#is_registration_b').attr('readonly','readonly');
	<?php if($is_registration_a == 'Y') echo "$('#is_registration_b').removeAttr('readonly','readonly');"; ?>
	$('.is_registration_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_b').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_b').attr('readonly','readonly');
		}			
	});*/
$('#is_nonResidential_b').attr('readonly','readonly');
	<?php if($is_nonResidential_a == 'Y') echo "$('#is_nonResidential_b').removeAttr('readonly','readonly');"; ?>
	$('.is_nonResidential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_nonResidential_b').removeAttr('readonly','readonly');
		}else{
			$('#is_nonResidential_b').attr('readonly','readonly');
			$('#is_nonResidential_b').val('');
		}			
	});
	
$('#semi_residential_b').attr('readonly','readonly');
	<?php if($semi_residential_a == 'Y') echo "$('#semi_residential_b').removeAttr('readonly','readonly');"; ?>
	$('.semi_residential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#semi_residential_b').removeAttr('readonly','readonly');
		}else{
			$('#semi_residential_b').attr('readonly','readonly');
			$('#semi_residential_b').val('');
		}			
	});
	/* ----------------------------------------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ----------------------------------------------------- */
	
	$("#submit").click(function(e){
		var number_of_checked_checkbox= $(".education_stage:checked").length;
	
		if(number_of_checked_checkbox==0){
			alert("Please select atleast one stage in Sl No. 6.");			
			//$("#stage").css("border: 3px solid rgb(255, 0, 0);padding: 3px 0 3px 10px;");
			$("#stage").css("border","3px solid #f00");
			$("#stage").css("padding","3px 0 3px 10px");
			e.preventDefault();
			return false;
		}else{
			$("#stage_form").submit();
		}
     });
</script>