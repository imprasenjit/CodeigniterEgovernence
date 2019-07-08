<?php  require_once "../../requires/login_session.php";
$dept="clm";
$form="6";
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
			$license_no=$results['license_no'];$date=$results['date'];$reg_no=$results['reg_no'];$reg_date=$results['reg_date'];$tax_reg =$results['tax_reg'];$manu_details =$results['manu_details'];$state =$results['state'];$total_turnover =$results['total_turnover'];	
			if(!empty($results['categories'])){
				$categories=json_decode($results['categories']);
				$categories_w=$categories->w;$categories_m=$categories->m;$categories_wi=$categories->wi;$categories_mi=$categories->mi;
			}else{
				$categories_w="";$categories_m="";$categories_wi="";$categories_mi="";
			}	
			
		}else{		
			$form_id="";
			$license_no="";
			$date="";$reg_no="";$reg_date="";$categories="";$tax_reg="";$manu_details="";
			$state="";
			$categories_w="";$categories_m="";$categories_wi="";$categories_mi="";$total_turnover="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$license_no=$results['license_no'];$date=$results['date'];$reg_no=$results['reg_no'];$reg_date=$results['reg_date'];$tax_reg =$results['tax_reg'];$manu_details =$results['manu_details'];$state =$results['state'];$total_turnover =$results['total_turnover'];	
		if(!empty($results['categories'])){
			$categories=json_decode($results['categories']);
			$categories_w=$categories->w;$categories_m=$categories->m;$categories_wi=$categories->wi;$categories_mi=$categories->mi;
		}else{
			$categories_w="";$categories_m="";$categories_wi="";$categories_mi="";
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
										<td width="25%">1. Name of the establishment/shop/person seeking the renewal of license: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled"></td>
										<td width="25%">2. Dealer's License Number: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="license_no" value="<?php echo $license_no;?>"></td>
									</tr>
									
									
									<tr>
										<td width="25%">3. Date of Establishment: </td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="date" value="<?php if($date!="0000-00-00" && $date!="") echo date('d-m-Y',strtotime($date));else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">4. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="" ></td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="11" value="<?php echo $rows->contact; ?>" maxlength="13" /></td>
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
										<td width="25%">5. (a) Registration number of shop/establishment/current Municipal Trade License: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="reg_no" value="<?php echo $reg_no;?>"></td>
										<td width="25%">5. (b) Date of shop/establishment/current Municipal Trade License: </td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="reg_date" value="<?php if($reg_date!="0000-00-00" && $reg_date!="") echo date('d-m-Y',strtotime($reg_date));else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td colspan="4">6. Categories of weights and measures sold at present: </td>
									</tr>
									<tr>
										<td width="25%">(i)Weights: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="categories[w]" validate="specialChar" value="<?php echo $categories_w;?>"  ></td>
										<td width="25%">(ii)Measures: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="categories[m]" validate="specialChar" value="<?php echo $categories_m;?>"  ></td>	
									</tr>
									<tr>
										<td width="25%">(iii)Weighing Instruments: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="categories[wi]" validate="specialChar" value="<?php echo $categories_wi;?>"  ></td>
										<td width="25%">(iv)Measuring Instruments with details in each case: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="categories[mi]" validate="specialChar" value="<?php echo $categories_mi;?>"  ></td>	
									</tr>
									<tr>
										<td width="25%">7. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tax_reg" value="<?php echo $tax_reg;?>"></td>
										<td width="25%">Total value of transactions / turnover :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="total_turnover"  validate="onlyNumbers" value="<?php echo $total_turnover;?>" ></td>
									</tr>									
									<tr>
										<td colspan="3">8. Are you intending to import weights and measures etc.from places outside the State / Country? If so, indicate Sources of supply from the State(s) / Country(s). (Give details of manufacturer’s trade mark/monogram and his licence number): </td>
										<td ><textarea class="form-control text-uppercase" name="manu_details"><?php echo $manu_details;?></textarea></td>
										
									</tr>
									<tr>
										<td colspan="4" class="text-center"> <b>To be certified by the applicant(s) </b></td>
									</tr>
									<tr>
										<td colspan="4">Certified that I/We have read the Legal Metrology Act, 2009 and the (name of state) <input type="text" class="form-control1 text-uppercase" validate="letters" name="state" value="<?php echo $state;?>"> . 
										Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.
										All the information furnished above is true to the best of my/ our knowledge.
										</td>
									</tr>

									<tr>
										<td >
										   Place:&emsp;<strong><?php echo strtoupper($dist)?></strong>
										   <br/>
										   Date:&emsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature:&emsp; <strong><?php echo strtoupper($key_person); ?></strong><br/>
										Designation: &emsp;<strong><?php echo strtoupper($status_applicant); ?></strong><br/></td>
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
	
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
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
			$('#dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
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
</script>