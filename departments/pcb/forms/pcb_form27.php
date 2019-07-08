<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="27";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

		
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();	
		$form_id=$results['form_id'];	
		$trader_name=$results["trader_name"];$trader_st1=$results["trader_st1"];$trader_st2=$results["trader_st2"];$trader_vill=$results["trader_vill"];$trader_dist =$results["trader_dist"];$trader_pincode =$results["trader_pincode"];$trader_mobile_no =$results["trader_mobile_no"];$trader_phone_no =$results["trader_phone_no"];$trader_email =$results["trader_email"];$export_code =$results["export_code"];$desc_n_quant_imported =$results["desc_n_quant_imported"];$storage_details =$results["storage_details"];
	}else{	 
		$form_id="";$trader_name="";$trader_st1="";$trader_st2="";$trader_vill="";$trader_dist="";$trader_pincode="";$trader_mobile_no="";$trader_phone_no="";$trader_email="";$export_code="";$desc_n_quant_imported="";$storage_details="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];	
	$trader_name=$results["trader_name"];$trader_st1=$results["trader_st1"];$trader_st2=$results["trader_st2"];$trader_vill=$results["trader_vill"];$trader_dist =$results["trader_dist"];$trader_pincode =$results["trader_pincode"];$trader_mobile_no =$results["trader_mobile_no"];$trader_phone_no =$results["trader_phone_no"];$trader_email =$results["trader_email"];$export_code =$results["export_code"];$desc_n_quant_imported =$results["desc_n_quant_imported"];$storage_details =$results["storage_details"];
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
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">1. Name and address of trader with Telephone and e-mail</td>
									</tr>
									<tr>
									     <td width="25%">Name:</td>
									     <td width="25%"><input type="text" name="trader_name" value="<?php echo $trader_name; ?>" class="form-control text-uppercase" validate="letters"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text"  name="trader_st1" value="<?php echo $trader_st1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="trader_st2" value="<?php echo $trader_st2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="trader_vill" value="<?php echo $trader_vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
                                         <td>
                                        <input type="text" class="form-control text-uppercase" value="<?php echo strtoupper($trader_dist);?>"   name="trader_dist">    
                                        </td>
										
										<td>Pincode:</td>
										<td><input type="text" name="trader_pincode" value="<?php echo $trader_pincode; ?>" class="form-control" validate="pincode" maxlength="6"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="trader_mobile_no" maxlength="10" value="<?php echo $trader_mobile_no; ?>" class="form-control text-uppercase" validate="mobileNumber"></td>
										<td>Phone No:</td>
										<td><input type="text" name="trader_phone_no" value="<?php echo $trader_phone_no; ?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="13"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="email" name="trader_email" value="<?php echo $trader_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td>2. TIN/VAT Number/Import/ Export Code:</td>
										<td><input type="text" name="export_code" value="<?php echo $export_code; ?>" class="form-control text-uppercase" ></td>
										<td>3. Description and quantity of other waste to be imported:</td>
										<td><textarea  name="desc_n_quant_imported" class="form-control text-uppercase " validate="textarea" maxlength="255"><?php echo $desc_n_quant_imported; ?></textarea>255 Characters Only</td>
									</tr>
									<tr>
									    <td>4. Details of storage, if any:</td>
										<td><textarea  name="storage_details" class="form-control text-uppercase " validate="textarea" maxlength="255"><?php echo $storage_details; ?></textarea>255 Characters Only</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td colspan="4">5. Names and address of authorised actual user (s):</td>
									</tr>
									<tr>
									     <td width="25%">Name:</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No:</td>
										<td><input type="text" disabled value="<?php echo $landline_std.$landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
														Place: <label><?php echo strtoupper($dist)?></label>
										</td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person)?><br/>
										Signature of the authorised person</label> </td>
																					
									</tr>			
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later"  onclick="return confirm('Do you want to save..?')" >Save & Next</button>
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
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>