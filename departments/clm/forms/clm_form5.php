<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="5";
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
			$repairer_lic=$results["repairer_lic"];$tl_reg_no=$results["tl_reg_no"];$tl_date=$results["tl_date"];$it_reg_no=$results["it_reg_no"];$any_change=$results["any_change"];$op_area=$results["op_area"];$hav_u=$results["hav_u"];$stamp_details=$results["stamp_details"];$state=$results["state"];$total_turnover =$results['total_turnover'];
			
			if(!empty($results['type_wm'])){
				$type_wm=json_decode($results['type_wm']);
				$type_wm_w=$type_wm->w;$type_wm_m=$type_wm->m;$type_wm_wi=$type_wm->wi;$type_wm_mi=$type_wm->mi;
			}else{
				$type_wm_w="";$type_wm_m="";$type_wm_wi="";$type_wm_mi="";
			}
		}else{		
			$form_id="";
			$repairer_lic="";$tl_reg_no="";$tl_date="";$it_reg_no="";$type_wm="";$any_change="";$op_area="";$hav_u="";$stamp_details="";$state="";$type_wm_w="";$type_wm_m="";$type_wm_wi="";$type_wm_mi="";$total_turnover="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$repairer_lic=$results["repairer_lic"];$tl_reg_no=$results["tl_reg_no"];$tl_date=$results["tl_date"];$it_reg_no=$results["it_reg_no"];$type_wm=$results["type_wm"];$any_change=$results["any_change"];$op_area=$results["op_area"];$hav_u=$results["hav_u"];$stamp_details=$results["stamp_details"];$state=$results["state"];$total_turnover =$results['total_turnover'];
		
		if(!empty($results['type_wm'])){
			$type_wm=json_decode($results['type_wm']);
			$type_wm_w=$type_wm->w;$type_wm_m=$type_wm->m;$type_wm_wi=$type_wm->wi;$type_wm_mi=$type_wm->mi;
		}else{
			$type_wm_w="";$type_wm_m="";$type_wm_wi="";$type_wm_mi="";
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
										<td width="25%">1. (a) Name of the repairing concern/ person seeking renewal of license : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the repairing concern/ person seeking renewal of license :</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $street_name1;?>" disabled="disabled"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $street_name2;?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $vill;?>" disabled="disabled"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $dist;?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $pincode;?>" disabled="disabled"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $mobile_no;?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td width="25%">2. Repairer's License Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="repairer_lic" value="<?php echo $repairer_lic;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									</tr>
									<tr>
										<td colspan="4">3. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" pattern="[0-9]{10,11}" title="Please enter 10 digit number" value="" ></td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="mobileNumber" maxlength="10" pattern="[0-9]{10,11}" title="Please enter 10 digit number" value="<?php echo $rows->contact; ?>" /></td>
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
										<td width="25%">4. (a) Registration number of current shop/establishment/ Municipal Trade License : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tl_reg_no" value="<?php echo $tl_reg_no;?>"></td>
										<td width="25%">(b) Date of current shop/establishment/ Municipal Trade License : </td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="tl_date" readonly="readonly" value="<?php if($tl_date!="0000-00-00" && $tl_date!="") echo date("d-m-Y",strtotime($tl_date)); else echo ""; ?>" placeholder="DD-MM-YYYY"></td>
									</tr>
									<tr>
										<td width="25%">5. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="it_reg_no" value="<?php echo $it_reg_no;?>"></td>
										<td width="25%">Total value of transactions / turnover :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="total_turnover"  validate="onlyNumbers" value="<?php echo $total_turnover;?>" ></td>
									</tr>									
									<tr>
										<td colspan="4">6.(a) The type of weights and measures repaired as per license granted : </td>
									</tr>
									<tr>
										<td width="25%">(i)Weights : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_wm[w]" validate="specialChar" value="<?php echo $type_wm_w;?>"  ></td>
										<td width="25%">(ii)Measures : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_wm[m]" validate="specialChar" value="<?php echo $type_wm_m;?>"  ></td>	
									</tr>
									<tr>
										<td width="25%">(iii)Weighing Instruments : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_wm[wi]" validate="specialChar" value="<?php echo $type_wm_wi;?>"  ></td>
										<td width="25%">(iv)Measuring Instruments with details in each case : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_wm[mi]" validate="specialChar" value="<?php echo $type_wm_mi;?>"  ></td>	
									</tr>
									<tr>
										<td width="25%">(b) Do you propose any change? </td>
										<td width="25%"><input type="radio" name="any_change" value="Y" <?php if($any_change=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="any_change" value="N" <?php if($any_change=="N" || $any_change=="") echo "checked"; ?> /> No</td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">7. Area in which you are operating : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="op_area" value="<?php echo $op_area;?>"></td>
										<td width="25%">8. Have you sufficient stock of loan/test weights, etc. : </td>
										<td width="25%"><input type="radio" name="hav_u" value="Y" <?php if($hav_u=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="hav_u" value="N" <?php if($hav_u=="N" || $hav_u=="") echo "checked"; ?> /> No</td>
									</tr>
									<tr>										
										<td width="25%">9. Please give details with particulars of stamping : </td>
										<td width="25%"><textarea type="text" class="form-control text-uppercase" name="stamp_details" ><?php echo $stamp_details;?></textarea></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4" class="text-center"> <b>To be certified by the applicant(s)</b></td>
									</tr>
									<tr>
										<td colspan="4">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state <input type="text" class="form-control1 text-uppercase" name="state" validate="letters" value="<?php echo $state;?>"> . 
										Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under. All the information furnished above is true to the best of my/ our knowledge.
										</td>
									</tr>
									<tr>
										<td >
										   Place : <?php echo strtoupper($dist);?>
										   <br/>
										   Date :&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td></td>
										<td></td>
										<td align="right"><?php echo strtoupper($key_person); ?><br/>Signature and Designation </td>
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
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>	
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>