<?php  require_once "../../requires/login_session.php";
$dept="cfs";
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
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];	
		$others_business=$results['others_business'];$others_desgn=$results['others_desgn'];$applicant_name=$results['applicant_name'];$identity_proof=$results['identity_proof'];$area=$results['area'];$start_date=$results['start_date'];$opening=$results['opening'];$closing=$results['closing'];$is_power=$results['is_power'];$is_power_details=$results['is_power_details'];$rupees=$results['rupees'];$draft=$results['draft'];$fees=$results['fees'];$supply=$results['supply'];
		if(!empty($results["corr_add"])){
			$corr_add=json_decode($results["corr_add"]);
			$corr_add_name=$corr_add->name;$corr_add_address=$corr_add->address;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
		}else{				
			$corr_add_name="";$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		}	
		if(!empty($results["business"])){
			$business=json_decode($results["business"]);
			if(isset($business->a)) $business_a=$business->a; else $business_a="";
			if(isset($business->b)) $business_b=$business->b; else $business_b="";
			if(isset($business->c)) $business_c=$business->c; else $business_c="";
			if(isset($business->d)) $business_d=$business->d; else $business_d="";
			if(isset($business->e)) $business_e=$business->e; else $business_e="";
			if(isset($business->f)) $business_f=$business->f; else $business_f="";
			if(isset($business->g)) $business_g=$business->g; else $business_g="";
			if(isset($business->h)) $business_h=$business->h; else $business_h="";
			if(isset($business->i)) $business_i=$business->i; else $business_i="";
			if(isset($business->j)) $business_j=$business->j; else $business_j="";
			if(isset($business->k)) $business_k=$business->k; else $business_k="";
		}else{
			$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";
		}	
		if(!empty($results["designation"])){
			$designation=json_decode($results["designation"]);
			if(isset($designation->a)) $designation_a=$designation->a; else $designation_a="";
			if(isset($designation->b)) $designation_b=$designation->b; else $designation_b="";
			if(isset($designation->c)) $designation_c=$designation->c; else $designation_c="";
			if(isset($designation->d)) $designation_d=$designation->d; else $designation_d="";
			if(isset($designation->e)) $designation_e=$designation->e; else $designation_e="";
		}else{
			$designation_a="";$designation_b="";$designation_c="";$designation_d="";$designation_e="";
		}
	}else{
		$form_id="";
		$others_business="";$others_desgn="";$applicant_name="";$identity_proof="";$area="";$start_date="";$opening="";$closing="";$is_power="";$is_power_details="";$rupees="";$draft="";$fees="";$supply="";
		$corr_add_name="";$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";
		$designation_a="";$designation_b="";$designation_c="";$designation_d="";$designation_e="";		
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$others_business=$results['others_business'];$others_desgn=$results['others_desgn'];$applicant_name=$results['applicant_name'];$identity_proof=$results['identity_proof'];$area=$results['area'];$start_date=$results['start_date'];$opening=$results['opening'];$closing=$results['closing'];$is_power=$results['is_power'];$is_power_details=$results['is_power_details'];$rupees=$results['rupees'];$draft=$results['draft'];$fees=$results['fees'];$supply=$results['supply'];
	if(!empty($results["corr_add"])){
		$corr_add=json_decode($results["corr_add"]);
		$corr_add_name=$corr_add->name;$corr_add_address=$corr_add->address;$corr_add_mobile=$corr_add->mobile;$corr_add_tel=$corr_add->tel;$corr_add_fax=$corr_add->fax;$corr_add_email=$corr_add->email;
	}else{				
		$corr_add_name="";$corr_add_address="";$corr_add_mobile="";$corr_add_tel="";$corr_add_fax="";$corr_add_email="";
	}	
	if(!empty($results["business"])){
		$business=json_decode($results["business"]);
		if(isset($business->a)) $business_a=$business->a; else $business_a="";
		if(isset($business->b)) $business_b=$business->b; else $business_b="";
		if(isset($business->c)) $business_c=$business->c; else $business_c="";
		if(isset($business->d)) $business_d=$business->d; else $business_d="";
		if(isset($business->e)) $business_e=$business->e; else $business_e="";
		if(isset($business->f)) $business_f=$business->f; else $business_f="";
		if(isset($business->g)) $business_g=$business->g; else $business_g="";
		if(isset($business->h)) $business_h=$business->h; else $business_h="";
		if(isset($business->i)) $business_i=$business->i; else $business_i="";
		if(isset($business->j)) $business_j=$business->j; else $business_j="";
		if(isset($business->k)) $business_k=$business->k; else $business_k="";
	}else{
		$business_a="";$business_b="";$business_c="";$business_d="";$business_e="";$business_f="";$business_g="";$business_h="";$business_i="";$business_j="";$business_k="";
	}	
	if(!empty($results["designation"])){
		$designation=json_decode($results["designation"]);
		if(isset($designation->a)) $designation_a=$designation->a; else $designation_a="";
		if(isset($designation->b)) $designation_b=$designation->b; else $designation_b="";
		if(isset($designation->c)) $designation_c=$designation->c; else $designation_c="";
		if(isset($designation->d)) $designation_d=$designation->d; else $designation_d="";
		if(isset($designation->e)) $designation_e=$designation->e; else $designation_e="";
	}else{
		$designation_a="";$designation_b="";$designation_c="";$designation_d="";$designation_e="";
	}
}
?>

<?php require_once "../../requires/header.php";   ?>
   <?php include ("".$table_name."_addmore.php"); ?>
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
								<form name="myform1" id="myform1" class="submit1" method="post" compliance="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">1. Kind of business (Please tick more than one, if applicable) :</td>
										</tr>	  									
										<tr>
											<td width="25%">
												<label class="checkbox"><input type="checkbox" <?php if($business_a=="S") echo "checked"; ?> name="business[a]" value="S">Permanent/Temporary Stall holder </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_b=="H") echo "checked"; ?> name="business[b]" value="H">Hawker (Itinerant / Mobile food vendor) </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_c=="D") echo "checked"; ?> name="business[c]" value="D">Dhaba </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_d=="P") echo "checked"; ?> name="business[d]" value="P">Petty Retailer of snacks/tea shops </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_e=="M") echo "checked"; ?> name="business[e]" value="M">Manufacturer/Processor </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_f=="FI") echo "checked"; ?> name="business[f]" value="FI">Fish/meat/poultry shop/seller </label>
											</td>
											<td width="25%">
												<label class="checkbox"><input type="checkbox" <?php if($business_g=="R") echo "checked"; ?> name="business[g]" value="R">Re-Packer </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_h=="F") echo "checked"; ?> name="business[h]" value="F">Food stalls/arrangements in Religious gatherings, fairs etc </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_i=="V") echo "checked"; ?> name="business[i]" value="V">Milk producers (who are not member of dairy co operative society)/ Milk vendor </label>
												<label class="checkbox"><input type="checkbox" <?php if($business_j=="HB") echo "checked"; ?> name="business[j]" value="HB">Home based canteens/dabba wallasHome based canteens/dabba wallas </label>
											</td>
											<td width="25%">
												<label class="checkbox"><input id="business" type="checkbox" <?php if($business_k=="O") echo "checked"; ?> name="business[k]" value="O"> Other(s), Please specify : </label>
											</td>
											<td width="25%"><input type="text" name="others_business" id="others_business" placeholder="Please specify" class="form-control text-uppercase" value="<?php echo $others_business; ?>"/></td>
										</tr>
										<tr>
											<td width="25%">2. Name of the Applicant/Company : </td>
											<td width="25%"><input type="text" name="applicant_name" value="<?php echo $applicant_name; ?>" class="form-control text-uppercase"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td>3. Designation :</td>
											<td>
												<label class="checkbox"><input type="checkbox" <?php if($designation_a=="I") echo "checked"; ?> name="designation[a]" value="I">Individual </label>
												<label class="checkbox"><input type="checkbox" <?php if($designation_b=="P") echo "checked"; ?> name="designation[b]" value="P">Partner </label>
												<label class="checkbox"><input type="checkbox" <?php if($designation_c=="PR") echo "checked"; ?> name="designation[c]" value="PR">Proprietor </label>
												<label class="checkbox"><input type="checkbox" <?php if($designation_d=="S") echo "checked"; ?> name="designation[d]" value="S">Secretary of dairy co-operative society </label>
											</td>
											<td>
												<label class="checkbox"><input id="designation" type="checkbox" <?php if($designation_e=="O") echo "checked"; ?> name="designation[e]" value="O"> Other(s), Please specify : </label>
											</td>
											<td><input type="text" name="others_desgn" id="others_desgn" placeholder="Please specify" class="form-control text-uppercase" value="<?php echo $others_desgn; ?>"/></td>
										</tr>
										<tr>
											<td>4. Proof of Identity of applicant : </td>
											<td><input type="text" name="identity_proof" value="<?php echo $identity_proof; ?>" class="form-control text-uppercase"></td>
											<td colspan="2">[Note: Please submit a copy of photo ID like Driving License, Passport, Ration Card or Election ID card]</td>
										</tr>
										<tr>
											<td>5. Correspondence address : </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="corr_add[address]"><?php echo $corr_add_address; ?></textarea></td>	
											<td>[Note: In case the number(s) are a PP or common number(s), please specify the name of the contact person as well]</td>
										</tr>
										<tr>
											<td>(a) Name of contact person : </td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[name]" value="<?php echo $corr_add_name; ?>"></td>
											<td>(b) Mobile No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[mobile]" value="<?php echo $corr_add_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
										</tr>
										<tr>
											<td>(c) Telephone Number : </td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[tel]" value="<?php echo $corr_add_tel; ?>"></td>
											<td>(d) Fax number : </td>
											<td><input type="text" class="form-control text-uppercase" name="corr_add[fax]" value="<?php echo $corr_add_fax; ?>"></td>
										</tr>
										<tr>
											<td>(e) Email : </td>
											<td><input type="email" class="form-control text-uppercase" name="corr_add[email]" value="<?php echo $corr_add_email;?>" validate="email"></td>
											<td colspan="2"></td>
										</tr>	
										<tr>
											<td colspan="2">6. Area or Location where food business is to be conducted/ Address of the premises : </td>
											<td><input type="text" class="form-control text-uppercase" name="area" value="<?php echo $area;?>"></td>
										</tr>	
										<tr>
											<td>7. Description of the food items proposed to be Manufactured or sold : </td>
											<td colspan="3">
											<table name="objectTable1" class="table table-responsive table-bordered "id="objectTable1" >
												<thead>
													<th>Sl No.</th>
													<th>Name of Food Category </th>
													<th>Quantity in Kg per day or M.T. per annum </th>
												</thead>
												<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){ ?>
													<tr>
														<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
														<td><input name="textB<?php echo $count;?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" ></td>
														<td><input name="textC<?php echo $count;?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["qty"]; ?>" ></td>
													</tr>		
												<?php $count++; } 
												}else{	?>
													<tr>
														<td><input name="textA1" id="textA1" value="1" readonly="readonly" size="1" class="form-control text-uppercase" ></td>
														<td><input name="textB1" id="textB1" class="form-control text-uppercase" ></td>				
														<td><input name="textC1" id="textC1" class="form-control text-uppercase" ></td>
													</tr>
												<?php } ?>
											</table>	
												<div align="right" style="position:relative;right:10px">
												<button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
											<td>8. In case of new business - intended date of start : </td>
											<td><input type="text" class="dob form-control" name="start_date" value="<?php echo $start_date; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">9. In case of seasonal business, state the opening and closing period of the year : </td>
											<td><input type="text" class="form-control text-uppercase" name="opening" value="<?php echo $opening; ?>" placeholder="Opening Period"></td>
											<td><input type="text" class=" form-control text-uppercase" name="closing" value="<?php echo $closing; ?>"  placeholder="Closing Period"></td>
										</tr>
										<tr>
											<td>10. Source of water supply : <span class="mandatory_field">*</span></td>
											<td colspan="3">
												<label class="radio-inline"><input type="radio" name="supply"  value="PU" <?php if(isset($supply) && ($supply=='PU' || $supply=='')) echo 'checked';?>/> Public supply</label>
												<label class="radio-inline"><input type="radio" name="supply"  value="PR"  <?php if(isset($supply) && $supply=='PR') echo 'checked'; ?>/>Private supply</label>
												<label class="radio-inline"><input type="radio" name="supply"  value="O"  <?php if(isset($supply) && $supply=='O') echo 'checked'; ?>/>Any other source</label>
											</td>
										</tr>
										<tr>
											<td>11. Whether any electric power is used in manufacture of the food items ? <span class="mandatory_field">*</span></td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_power" class="is_power" value="Y" <?php if(isset($is_power) && $is_power=='Y') echo 'checked'; ?> /> Yes </label>
												<label class="radio-inline"><input type="radio" name="is_power" class="is_power"  value="N" <?php if(isset($is_power) && ($is_power=='N' || $is_power=='')) echo 'checked'; ?>/> No </label>
											</td>
											<td>If yes, please state the exact HP used or sanctioned Electricity load : </td>	
											<td><input type="text" name="is_power_details" id="is_power_details" class="form-control text-uppercase" value="<?php echo $is_power_details; ?>"></td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">12. I/We have forwarded a sum of Rs. &nbsp;<input type="text"  class="form-control text-uppercase" name="rupees" value="<?php echo $rupees;?>" >&nbsp; towards registration fees according to the provision of the Food Safety and Standards (Licensing and Registration) Regulations, 2011 vide :
											<br/>
											<label class="radio-inline"><input type="radio" name="fees"  value="D" <?php if(isset($fees) && ($fees=='D' || $fees=='')) echo 'checked'; ?> required="required"/> Demand Draft no. (payable to &nbsp;</label><input type="text"  class="form-control text-uppercase" name="draft" value="<?php echo $draft;?>">)<br/>
											<label class="radio-inline"><input type="radio" name="fees"  value="C"  <?php if(isset($fees) && $fees=='C') echo 'checked'; ?>/>Cash</label>
											</td>
										</tr>	
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */		
	<?php if(isset($others_business) && $others_business=="") echo '$("#others_business").attr("disabled", "disabled");	';?>	
	$("#business").click(function () {
		if ($(this).is(":checked")) {
			$("#others_business").removeAttr("disabled");
			$("#others_business").focus();
		} else {
			$("#others_business").attr("disabled", "disabled");
		}
	});
	/* ------------------------------------------------------ */		
	<?php if(isset($others_desgn) && $others_desgn=="") echo '$("#others_desgn").attr("disabled", "disabled");	';?>	
	$("#designation").click(function () {
		if ($(this).is(":checked")) {
			$("#others_desgn").removeAttr("disabled");
			$("#others_desgn").focus();
		} else {
			$("#others_desgn").attr("disabled", "disabled");
		}
	});
	/* ------------------------------------------------------ */
	$('#is_power_details').attr('readonly','readonly');
	<?php if($is_power == 'Y') echo "$('#is_power_details').removeAttr('readonly','readonly');"; ?>
	$('.is_power').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_power_details').removeAttr('readonly','readonly');
		}else{
			$('#is_power_details').attr('readonly','readonly');
			$('#is_power_details').val('');
		}			
	});
</script>