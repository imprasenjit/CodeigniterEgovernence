<?php  require_once "../../requires/login_session.php"; 
$dept="clm";
$form="4";
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
			$license_no=$results['license_no'];$type_changes=$results['type_changes'];$weight_trademark=$results['weight_trademark'];$workshop_details =$results['workshop_details'];$production_details =$results['production_details'];$shop_reg_no =$results['shop_reg_no'];$shop_reg_date =$results['shop_reg_date'];$tax_reg_no =$results['tax_reg_no'];$state =$results['state'];$total_turnover =$results['total_turnover'];
			
			if(!empty($results['type'])){
				$type=json_decode($results['type']);
				$type_measures=$type->measures;$type_weight=$type->weight;$type_instrument=$type->instrument;$type_details=$type->details;
			}else{
				$type_measures="";$type_weight="";$type_instrument="";$type_details="";
			}
		}else{		
			$form_id="";
			$license_no="";
			$type_measures="";$type_weight="";$type_instrument="";$type_details="";$type_changes="";$weight_trademark="";$workshop_details="";$production_details="";$shop_reg_no="";$shop_reg_date="";$tax_reg_no="";
			$state="";$total_turnover="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$license_no=$results['license_no'];$type_changes=$results['type_changes'];$weight_trademark=$results['weight_trademark'];$workshop_details =$results['workshop_details'];$production_details =$results['production_details'];$shop_reg_no =$results['shop_reg_no'];$shop_reg_date =$results['shop_reg_date'];$tax_reg_no =$results['tax_reg_no'];$state =$results['state'];$total_turnover =$results['total_turnover'];
		
		if(!empty($results['type'])){
			$type=json_decode($results['type']);
			$type_measures=$type->measures;$type_weight=$type->weight;$type_instrument=$type->instrument;$type_details=$type->details;
		}else{
			$type_measures="";$type_weight="";$type_instrument="";$type_details="";
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
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. (a) Name of the manufacturing concern for which renewal of license is desired: </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>									
									<tr>
									    <td colspan="4">(b) Address of the manufacturing concern for which renewal of license is desired:</td>
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
										<td width="25%">2. Manufacturing License No. : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="license_no" value="<?php echo $license_no;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan=4>3. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
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
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
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
										<td colspan="4">4.(a) Type of weights and measures which are manufactured as per license granted : </td>
									</tr>
									<tr>
										<td width="25%">(i)Weights :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[weight]" value="<?php echo $type_weight;?>"></td>
										<td width="25%">(ii)Measures :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[measures]" value="<?php echo $type_measures;?>"></td>
									</tr>
									<tr>
										<td width="25%">(iii)Weighing Instruments :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[instrument]" value="<?php echo $type_instrument;?>"></td>
										<td width="25%">(iv)Measuring Instruments with details in each case :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[details]" value="<?php echo $type_details;?>"></td>
									</tr>
									<tr>
										<td width="25%">4.(b) Do you propose any change ? </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_changes" value="<?php echo $type_changes;?>"></td>
										<td width="25%">5. The monogram or trademarks used on weights and measures manufactured by you : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weight_trademark" value="<?php echo $weight_trademark;?>"></td>
									</tr>
									<tr>
										<td width="25%">6. Details of workshop facilities available : </td>
										<td><textarea type="text" validate="textarea" class="form-control text-uppercase" name="workshop_details"><?php echo $workshop_details;?></textarea>255 Characters Only</td>
										<td width="25%">7. Details of production and sales in the last 5 years : </td>
										<td><textarea type="text" validate="textarea" class="form-control text-uppercase" name="production_details"><?php echo $production_details;?></textarea>255 Characters Only</td>
									</tr>
									<tr>
										<td width="25%">8. (a) Number of shop/establishment Registration : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="shop_reg_no" value="<?php echo $shop_reg_no;?>"></td>
										<td width="25%">8. (b) Date of shop/establishment Registration : </td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="shop_reg_date" value="<?php if($shop_reg_date!="0000-00-00" && $shop_reg_date!="") echo date("d-m-Y",strtotime($shop_reg_date)); else echo ""; ?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">9. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tax_reg_no" value="<?php echo $tax_reg_no;?>"></td>
										<td width="25%">Total value of transactions / turnover :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="total_turnover"  validate="onlyNumbers" value="<?php echo $total_turnover;?>" ></td>
									</tr>	
									<tr>
										<td colspan="4" class="text-center"> <b>To be certified by the applicant(s) </b></td>
									</tr>
									<tr>
										<td colspan="4">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state <input type="text" class="form-control1 text-uppercase" validate="letters" name="state" value="<?php echo $state;?>"> . 
										Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under. All the information furnished above is true to the best of my/ our knowledge.
										</td>
									</tr>
									<tr>
										<td >
										   Place : <?php echo strtoupper($dist)?>
										   <br/>
										   Date :&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td></td>
										<td></td>
										<td align="right">Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
										Designation : <strong><?php echo strtoupper($status_applicant);?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form; ?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; next</button>
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
	/* ---------------------upload S/C click operation-------------------- */
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
</script>