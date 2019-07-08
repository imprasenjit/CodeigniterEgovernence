<?php  require_once "../../requires/login_session.php"; 
$dept="clm";
$form="1";
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
			$nature=$results['nature'];$monogram=$results['monogram'];$tools=$results['tools'];$workshop=$results['workshop'];$facilities =$results['facilities'];$elect_energy =$results['elect_energy'];$is_loan_detail =$results['is_loan_detail'];$reg_number =$results['reg_number'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$is_proposed =$results['is_proposed'];$approval =$results['approval'];$inspection =$results['inspection'];$bankers =$results['bankers'];$total_turnover=$results['total_turnover'];
			
			if(!empty($results["fact"]))
			{
				$fact=json_decode($results["fact"]);
				$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
			}else{
				$fact_reg_date="";$fact_reg_no="";
			}
			if(!empty($results["type"]))
			{
				$type=json_decode($results["type"]);
				$type_weight=$type->weight;$type_measures=$type->measures;$type_instrument=$type->instrument;$type_details=$type->details;
			}else{
				$type_weight="";$type_measures="";$type_instrument="";$type_details="";
			}	
			if(!empty($results["persons"]))
			{
				$persons=json_decode($results["persons"]);
				$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
			}else{
				$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
			}
		}else{
			$form_id="";
			$nature="";$monogram="";$tools="";$workshop="";$facilities="";$elect_energy="";$is_loan_detail="";$bankers="";$reg_number="";$is_applied="";$is_applied_details="";$is_proposed="";$approval="";$inspection="";
			$fact_reg_date="";$fact_reg_no="";
			$type_weight="";$type_measures="";$type_instrument="";$type_details="";
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
			$total_turnover="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$nature=$results['nature'];$monogram=$results['monogram'];$tools=$results['tools'];$workshop=$results['workshop'];$facilities =$results['facilities'];$elect_energy =$results['elect_energy'];$is_loan_detail =$results['is_loan_detail'];$reg_number =$results['reg_number'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$is_proposed =$results['is_proposed'];$approval =$results['approval'];$inspection =$results['inspection'];$bankers =$results['bankers'];$total_turnover=$results['total_turnover'];
		
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
		}
		if(!empty($results["type"]))
		{
			$type=json_decode($results["type"]);
			$type_weight=$type->weight;$type_measures=$type->measures;$type_instrument=$type->instrument;$type_details=$type->details;
		}else{
			$type_weight="";$type_measures="";$type_instrument="";$type_details="";
		}	
		if(!empty($results["persons"]))
		{
			$persons=json_decode($results["persons"]);
			$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
		}else{
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
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
									    <td colspan="3">1. Name of the manufacturing concern for which license is desired :</td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. Complete address of the concern. Whether premises are owned/rented/ taken on lease/leave licence, duly supported by documents.</td>					
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
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td >3.Date of Establishment of workshop/factory :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" disabled="disabled" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan=4>4. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father&apos;s/Spouse&apos;s Name</th>
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
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="" validate="letters" /></td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="<?php echo $rows->contact; ?>"/></td>
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
										<td colspan="4">5. The date and current registration number of factory/shop/ establishment/Municipal Trade licence :</td>
									</tr>
									<tr>
										<td width="25%">Date :</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="fact[reg_date]" value="<?php if($fact_reg_date!="0000-00-00" && $fact_reg_date!="") echo date('d-m-Y',strtotime($fact_reg_date));else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td width="25%">Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="fact[reg_no]" value="<?php echo $fact_reg_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">6. Nature of manufacturing activities at present :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"   name="nature" value="<?php echo $nature;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">7. The type of weights and measures proposed to be manufactured viz :</td>			
									</tr>
									<tr>
										<td>(i)Weights :</td>
										<td><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[weight]" value="<?php echo $type_weight;?>"></td>
										<td>(ii)Measures :</td>
										<td><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[measures]" value="<?php echo $type_measures;?>"></td>
									</tr>
									<tr>
										<td>(iii)Weighing Instruments :</td>
										<td><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[instrument]" value="<?php echo $type_instrument;?>"></td>
										<td>(iv)Measuring Instruments with details in each case :</td>
										<td><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[details]" value="<?php echo $type_details;?>"></td>
									</tr>
									<tr>
										<td colspan="4">8. The number of persons employed/proposed to be employed :</td>
									</tr>
									<tr>
										<td>(i)Skilled :</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[skill]" validate="onlyNumbers" value="<?php echo $persons_skill;?>"></td>
										<td>(ii)Semi-skilled :</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[semi_skill]" validate="onlyNumbers" value="<?php echo $persons_semi_skill;?>"></td>
									</tr>
									<tr>
										<td>(iii)Unskilled :</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[unskill]" validate="onlyNumbers" value="<?php echo $persons_unskill;?>"></td>
										<td>(iv)Specialist trained in the line :</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[trained]" validate="onlyNumbers" value="<?php echo $persons_trained;?>"></td>
									</tr>
									<tr>
										<td >9. The monogram or trade mark intended to be Imprinted on weights and measures to be manufactured :</td>
										<td><input type="text" class="form-control text-uppercase" name="monogram" value="<?php  echo $monogram;?>"></td>
										<td >10. Details of machinery, tools accessories, owned and used for manufacturing weights measures etc :</td>
										<td><textarea type="text" class="form-control text-uppercase" maxlength="255" name="tools"><?php echo $tools;?></textarea>255 Characters Only</td>
									</tr>
									<tr>
										<td >11. Details of foundry/workshop facilities arranged Whether ownership, long term lease etc. :</td>
										<td><textarea type="text" validate="textarea" class="form-control text-uppercase" maxlength="255" name="workshop"><?php echo $workshop;?></textarea>255 Characters Only</td>
										<td >12. Facilities of steel casting and hardness testing of vital parts etc or other means :</td>
										<td><input type="text" class="form-control text-uppercase" name="facilities"  validate="specialChar" value="<?php echo $facilities;?>"></td>
									</tr>
									<tr>
										<td>13. Availability of electric energy :</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_energy"  value="<?php echo $elect_energy;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>14. Details of loan received from Government or financial Institution. If so, give details. :</td>
										<td><textarea type="text" class="form-control text-uppercase" maxlength="255" name="is_loan_detail"><?php echo $is_loan_detail;?></textarea>255 Characters Only</td>
									    <td >15. Name of bankers, if any.  : </td>
										<td><input type="text" class="form-control text-uppercase" name="bankers"  value="<?php echo $bankers;?>"></td>
									</tr>
									<tr>
										<td>16. VAT/Sales Tax Registration Number/CST Number/Professional Tax registration Number/IT Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="reg_number"   value="<?php echo $reg_number;?>"></td>
										<td>Total value of transactions / turnover :</td>
										<td><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="total_turnover" value="<?php echo $total_turnover;?>"></td>
									</tr>
									<tr>
										<td>17. Have you applied previously for a manufacture’s  licence? <span class="mandatory_field">*</span></td>
										<td>
											<label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="Y" <?php if($is_applied=='Y') echo 'checked'; ?> required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="N" <?php if($is_applied=='N') echo 'checked'; ?> required="required">&nbsp;No </label></td>
										<td>If so, when and with what results?  </td>
										<td><input type="text" class="form-control text-uppercase" name="is_applied_details" id="is_applied_details" value="<?php echo $is_applied_details;?>"></td>
									</tr>
									<tr>
										<td >18. (a) Whether the item(s) proposed to be manufactured will be sold within the State or outside the State or both :<span class="mandatory_field">*</span></td>
										<td> <select class="form-control text-uppercase" required="required" name="is_proposed">
											<option value="">Please Select</option>
											<option <?php if($is_proposed=="W") echo "selected"; ?> value="W">Within the State</option>
											<option <?php if($is_proposed=="O") echo "selected"; ?> value="O">Outside the State</option>
											<option <?php if($is_proposed=="B") echo "selected"; ?> value="B">Both</option>
										</select></td>
										<td >(b) Details of Model Approval received from Government of India :</td>
										<td><textarea type="text" class="form-control text-uppercase" maxlength="255" name="approval"><?php echo $approval;?></textarea>255 Characters Only</td>
									</tr>
									<tr>
										<td colspan="3">(c) When can you produce for inspection samples of your products which licence is desired? :</td>
										<td><input type="text" class="form-control text-uppercase" name="inspection" value="<?php echo $inspection;?>"></td>
									</tr>	
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong><br/>
										Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
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
	/* ---------------------Block all after submit operation-------------------- */
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
</script>