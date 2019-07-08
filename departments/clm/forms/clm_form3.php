<?php  require_once "../../requires/login_session.php"; 
$dept="clm";
$form="3";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$weights_measure =$results['weights_measure'];$reg_number =$results['reg_number'];$is_intend=$results['is_intend'];$source_supply=$results['source_supply'];$monogram =$results['monogram'];$lic_num =$results['lic_num'];$regis_impoter =$results['regis_impoter'];$model_impoter =$results['model_impoter'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];
			if(!empty($results["fact"]))
			{
				$fact=json_decode($results["fact"]);
				$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
			}else{
				$fact_reg_date="";$fact_reg_no="";
			}
		}else{		 
			$form_id="";
			$weights_measure="";$reg_number="";$is_intend="";$source_supply="";$monogram="";$lic_num="";$regis_impoter="";$model_impoter="";$is_applied="";$is_applied_details="";
			$fact_reg_date="";$fact_reg_no="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$weights_measure =$results['weights_measure'];$reg_number =$results['reg_number'];$is_intend=$results['is_intend'];$source_supply=$results['source_supply'];$monogram =$results['monogram'];$lic_num =$results['lic_num'];$regis_impoter =$results['regis_impoter'];$model_impoter =$results['model_impoter'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
							</br>
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td colspan="3">1. Name of the establishment/shop/person seeking the licence :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Complete address of the establishment etc  :</td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td width="25%">3. Date of establishment :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" disabled="disabled" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">4. Name(s) and address(s) of proprietors and / or partners and Managing Director(s) in the case of Limited Company :</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father's/Spouse's Name</th>
												<th>Address</th>
												<th>Pincode</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $i; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="<?php echo $pincode; ?>" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10"pattern="[0-9]{10,13}" title="Please enter 10 digit number" value="" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" pattern="[0-9]{10,13}" title="Please enter 10 digit number" value="<?php echo $rows->contact; ?>" /></td>
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
										<td colspan="4">5. Number and date of Registration Number of current shop/ establishment/Municipal Trade licence :</td>
									</tr>
									<tr>
										<td width="25%">Date :</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="fact[reg_date]" value="<?php if($fact_reg_date!="0000-00-00" && $fact_reg_date!="") echo date('d-m-Y',strtotime($fact_reg_date));else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td width="25%">Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="fact[reg_no]" value="<?php echo $fact_reg_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">6. Categories of weights and measures sold/proposed to be sold at present :</td>
										<td width="25%"><textarea type="text" class="form-control text-uppercase" name="weights_measure"><?php echo $weights_measure;?></textarea></td>
										<td width="25%">7. Registration Number of VAT/CST/Sales Tax/ Professional Tax/Income Tax :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="reg_number" value="<?php echo $reg_number;?>" ></td>
									</tr>
									<tr>
										<td colspan="3">8. Do you intend to imports weights, etc. from places outside the State/ Country? <span class="mandatory_field">*</span></td>
										<td>
											<label class="radio-inline"><input type="radio" name="is_intend" id="is_intend" value="Y" <?php if($is_intend=='Y') echo 'checked'; ?> required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_intend" id="is_intend"value="N" <?php if($is_intend=='N') echo 'checked'; ?> />&nbsp;No </label></td>
									</tr>
									<tr id="is_intend_details">
										<td colspan="4">If so indicate sources of supply.(Give details of manufacturer’s trade mark/ monogram and  his licence number) and provide :
										<table class="table table-responsive">
											<tr>
												<td>Sources of supply :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="source_supply" id="source_supply" value="<?php echo $source_supply;?>"></td>
												<td width="25%">Manufacturer’s trade mark/ monogram :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="monogram" id="monogram" value="<?php echo $monogram;?>"></td>
											</tr>
											<tr>
												<td width="25%">License Number :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="lic_num" id="lic_num" value="<?php echo $lic_num;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td width="25%">(a) Registration of Importer of Weights and Measures, if any :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="regis_impoter" value="<?php echo $regis_impoter;?>"></td>
												<td width="25%">(b) Approval of model imported into India by Central Government :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="model_impoter" value="<?php echo $model_impoter;?>"></td>
											</tr>
										</table></td>
									</tr>
									<tr>
										<td >9. Have you applied previously for a dealer’s licence either in this State or elsewhere?  <span class="mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="Y" <?php if($is_applied=='Y') echo 'checked'; ?> required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_applied" id="is_applied"value="N" <?php if($is_applied=='N') echo 'checked'; ?> />&nbsp;No </label></td>
										<td >If so give details : </td>
										<td><input type="text" class="form-control text-uppercase" name="is_applied_details" id="is_applied_details" value="<?php echo $is_applied_details;?>"></td>
									</tr>	
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong><br/>
										Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td></td>
										<td></td>
										<td>Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
										Designation : <strong><?php echo strtoupper($status_applicant);?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you really want to save the form ?')" >Save &amp; Next</button>
										</td>
									</tr>									
								</table>
								</form>
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
	<?php if($is_applied=="N"){ ?>
	$('#is_applied_details').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_applied"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_applied_details').attr('disabled', 'disabled');
		else
			$('#is_applied_details').removeAttr('disabled');
	});
	/* ------------------------------------------------------ */
	<?php if($is_intend == 'N' || $is_intend == '') echo "$('#is_intend_details').hide();"; ?>
	$('input[name="is_intend"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_intend_details').hide();
		else
			$('#is_intend_details').show();
	});
</script>