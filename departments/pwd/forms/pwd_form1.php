<?php  require_once "../../requires/login_session.php";
$dept="pwd";
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
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$uni_identification_no=$results['uni_identification_no'];
			
			if(!empty($results["road_details"])){
				$road_details=json_decode($results["road_details"]);
				$road_details_road_name=$road_details->road_name;$road_details_vill=$road_details->vill;$road_details_mouza=$road_details->mouza;$road_details_revenue_circle=$road_details->revenue_circle;$road_details_dist=$road_details->dist;
			}else{
				$road_details_road_name="";$road_details_vill="";$road_details_mouza="";$road_details_revenue_circle="";
				$road_details_dist="";
			}
			
			$road_width=$results['road_width'];$overhead_type=$results['overhead_type'];$license_no=$results['license_no'];$licensee_name=$results['licensee_name'];
			if(!empty($results["permission"])){
					$permission=json_decode($results["permission"]);
					if(isset($permission->a)) $permission_a=$permission->a; else $permission_a="";
					if(isset($permission->b)) $permission_b=$permission->b; else $permission_b="";
					
			}else{
					$permission_a="";$permission_b="";
					 
			}
			if(!empty($results["cost_of_cutting"])){
				$cost_of_cutting=json_decode($results["cost_of_cutting"]);
				$cost_of_cutting_rep=$cost_of_cutting->rep;
			}else{
				$cost_of_cutting_rep="";
			}
		}else{
			$uni_identification_no="";
			$road_details_road_name="";$road_details_vill="";$road_details_mouza="";$road_details_revenue_circle="";
			$road_details_dist="";
			$road_width="";$overhead_type="";$license_no="";$licensee_name="";
			$permission_a="";$permission_b="";
			$cost_of_cutting_rep="";
		}		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$uni_identification_no=$results['uni_identification_no'];
		if(!empty($results["road_details"])){
			$road_details=json_decode($results["road_details"]);
			$road_details_road_name=$road_details->road_name;$road_details_vill=$road_details->vill;$road_details_mouza=$road_details->mouza;$road_details_revenue_circle=$road_details->revenue_circle;$road_details_dist=$road_details->dist;
		}else{
			$road_details_road_name="";$road_details_vill="";$road_details_mouza="";$road_details_revenue_circle="";
			$road_details_dist="";
		}
		
		$road_width=$results['road_width'];$overhead_type=$results['overhead_type'];$license_no=$results['license_no'];$licensee_name=$results['licensee_name'];
		if(!empty($results["permission"])){
			$permission=json_decode($results["permission"]);
			if(isset($permission->a)) $permission_a=$permission->a; else $permission_a="";
			if(isset($permission->b)) $permission_b=$permission->b; else $permission_b="";
				
		}else{
			$permission_a="";$permission_b="";				 
		}
		if(!empty($results["cost_of_cutting"])){
			$cost_of_cutting=json_decode($results["cost_of_cutting"]);
			$cost_of_cutting_rep=$cost_of_cutting->rep;
		}else{
			$cost_of_cutting_rep="";
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							<br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4"><strong>Enterprise Details :</strong></td>
									</tr>
									<tr>
										<td width="25%">1. Name of the Enterprise :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
										<td width="25%">2. Unique Business Identification Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="uni_identification_no" value="<?php echo $uni_identification_no; ?>" ></td>
									</tr>
									<tr>
									    <td colspan="4">3. Address of the Registered Office of the Enterprise :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $mobile_no; ?>"></td>
									</tr>
									<tr>
									    <td colspan="4">4. Address of the Unit (in relation to which Right Way is sought) :</td>
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
									     <td colspan="4"><strong>Applicant Details :</strong></td>							     
									</tr>
									<tr>
										<td width="25%">1. Name of the Proprietor / Authorized Partner / Authorized Director :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person;?>"></td>
										<td width="25%">2.  Designation of the Applicant :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $status_applicant;?>"></td>
									</tr>								
									<tr>
									    <td colspan="4">3. Address of the Applicant  :</td>
									</tr>
									<tr>
										<td>Street Name 1:</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name1; ?>"  disabled="disabled"/></td>
										<td>Street Name 2 :</td>
                                        <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name2; ?>" disabled="disabled"></td>
									</tr>
									<tr>
									    <td>Village/Town :</td>
									    <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_vill; ?>" disabled="disabled"></td>
									    <td>District :</td>										
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist; ?>"></td>
									</tr>
									<tr>
									    <td>Pin Code :</td>
									    <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_pincode; ?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td>4. Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
										<td>5. Email ID of the Applicant :</td>
										<td><input type="text" class="form-control" disabled value="<?php echo $email;?>"></td>
									</tr>
									<tr>
									     <td colspan="4"><strong>Other Details :</strong></td>
									</tr>
									<tr>
										<td>1. "Right of Way" Permission to : </td>
										<td colspan="3">
											<label class="checkbox-inline"><input type="checkbox" <?php if($permission_a=="D") echo "checked"; ?> name="permission[a]" value="D">Draw overhead lines&nbsp;&nbsp; </label></br>
											<label class="checkbox-inline"><input type="checkbox" <?php if($permission_b=="C") echo "checked"; ?> name="permission[b]" value="C">Cutting of road for underground cable(s)&nbsp;&nbsp; </label>
												
										</td>
									</tr>
									<tr>
										<td colspan="2">2. Details of the road :</td>
									</tr>									
									<tr>
										<td colspan="4">										
										<table class="table table-responsive table-bordered">									
											<tr>
												<td width="30%">1.</td>
												<td width="30%">Road Name  /  Road No </td>
												<td width="40%"><input  type="text" class="form-control text-uppercase "  name="road_details[road_name]" value="<?php echo $road_details_road_name;?>" ></td>
											</tr>
											<tr>
												<td>2.</td>
												<td>Village   /  Ward No.</td>
												<td><input  type="text" class="form-control text-uppercase "  name="road_details[vill]" value="<?php echo $road_details_vill;?>" ></td>
											</tr>
											<tr>
												<td>3.</td>
												<td>Mouza</td>
												<td><input  type="text" class="form-control text-uppercase "  name="road_details[mouza]" value="<?php echo $road_details_mouza;?>" ></td>
											</tr>
											<tr>
												<td>4.</td>
												<td>Revenue Circle</td>
												<td><input  type="text" class="form-control text-uppercase "  name="road_details[revenue_circle]" value="<?php echo $road_details_revenue_circle;?>" ></td>
											</tr>
											<tr>
												<td>5.</td>
												<td>District</td>
												<td><input  type="text" class="form-control text-uppercase "  name="road_details[dist]" value="<?php echo $road_details_dist;?>" ></td>
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td>3. Width of the road :</td>
										<td><input  type="text" class="form-control text-uppercase "  name="road_width" value="<?php echo $road_width;?>" ></td>
										<td>4. Type of Overhead Line / Underground Cable / laid :</td>
										<td><input  type="text" class="form-control text-uppercase "  name="overhead_type" value="<?php echo $overhead_type;?>" ></td>
									</tr>
									<tr>
										<td colspan="4">5. License No. and name of Licensee Contractor to be engaged for road cutting :</td>
									</tr>
									<tr>										
										<td>License No. :</td>
										<td><input  type="text" class="form-control text-uppercase "  name="license_no" value="<?php echo $license_no;?>" ></td>
										<td>Name of Licensee Contractor :</td>
										<td><input  type="text" class="form-control text-uppercase "  name="licensee_name" value="<?php echo $licensee_name;?>" ></td>
									</tr>
									<tr>
										<td>6. Cost of cutting & repairing to be borne by  :<span class="mandatory_field"> *</span></td>
										<td><select name="cost_of_cutting[rep]" required="required" class="form-control text-uppercase">
											<option value='factory_owner' <?php if($cost_of_cutting_rep=='factory_owner') echo "selected"; ?> >Factory Owner</option>
											<option value='industries_department' <?php if($cost_of_cutting_rep=='industries_department') echo "selected"; ?> >Industries Department (in case of Industrial Areas)</option>	
										</select></td>										
									</tr>
									<tr>
										<td colspan="2" width="50%">Place :&nbsp; <strong> <?php echo strtoupper($dist);?></strong><br/>
										Date : &nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong> </td>
										<td colspan="2" align="right"> <strong><?php echo strtoupper($key_person); ?></strong><br/>
										Signature of the Applicant </td>
									</tr>														
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>