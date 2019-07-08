<?php  require_once "../../requires/login_session.php";
$dept="fcs";
$form="10";
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
			$form_id=$results['form_id'];
			$stock_point=$results['stock_point'];$lice_type=$results['lice_type'];
			if(!empty($results["supplier"])){
				$supplier=json_decode($results["supplier"]);
				$supplier_n=$supplier->n;$supplier_s1=$supplier->s1;$supplier_s2=$supplier->s2;$supplier_d=$supplier->d;$supplier_v=$supplier->v;$supplier_p=$supplier->p;$supplier_mno=$supplier->mno;
			}else{
				$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
			}
		}else{
			$stock_point="";$lice_type="";
			$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$stock_point=$results['stock_point'];$lice_type=$results['lice_type'];
		if(!empty($results["supplier"])){
			$supplier=json_decode($results["supplier"]);
			$supplier_n=$supplier->n;$supplier_s1=$supplier->s1;$supplier_s2=$supplier->s2;$supplier_d=$supplier->d;$supplier_v=$supplier->v;$supplier_p=$supplier->p;$supplier_mno=$supplier->mno;
		}else{
			$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
						   <div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform2" class="submit1" id="myform2" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">	
									<tr>
										<td width="25%">1. FULL NAME OF THE APPLICANT :</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
											 <td colspan="4"> 2. ADDRESS IN FULL :</td>
									</tr>
									<tr>
										<td>Street name 1 :</td>
										<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td>Street name 2 :</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District :</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pin code :</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
										<td>Mobile No. :</td>
										<td><input  type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>E-mail id :</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">3. LOCATION OF THE PLACE (S) OF  BUSINESS/ADDRESS :</td>
									</tr>
									<tr>
										<td width="25%">Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_street_name1; ?>"	></td>
										<td width="25%">Street Name2 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $b_pincode; ?>"></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo "+91-".$b_mobile_no; ?>"></td>
									</tr>
									<tr>
									   <td>4. NAME OF COMPANY/ COMPANIES WHOSE PRODUCT IS BEING TRADE :</td>
									   <td><input type="text" disabled name="unit_name" value="<?php echo $unit_name; ?>" 	class="form-control text-uppercase"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">5. NAME OF SUPPLIER AND ADDRESS IN FULL :</td>
									</tr>
									<tr>								
										<td>Name :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="supplier[n]" value="<?php echo $supplier_n; ?>"  required="required"/></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>								
										<td>Street Name 1 :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="supplier[s1]" value="<?php echo $supplier_s1; ?>"  required="required"/></td>
										<td>Street Name 2 :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="supplier[s2]" value="<?php echo $supplier_s2; ?>"  required="required"></td>
									</tr>
									<tr>
										<td>Village/Town :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="supplier[v]" value="<?php echo $supplier_v; ?>"  required="required"></td>
										<td>District :<span class="mandatory_field">*</span> </td>
                                        <td><input type="text" name="supplier[d]" id="supplier_d"  value="<?php echo $supplier_d; ?>" class="text-uppercase form-control"></td>
										
									</tr>
									<tr>
										<td>Pin Code :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" required name="supplier[p]" validate="pincode" maxlength="6" value="<?php echo $supplier_p; ?>"></td>
										<td>Mobile No. :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" required="required" name="supplier[mno]" validate="mobileNumber" maxlength="10" value="<?php echo $supplier_mno; ?>"></td>
									</tr>
									<tr>
										<td> MENTION HERE THE NAME OF THE STOCK POINT :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" required name="stock_point"  value="<?php echo $stock_point; ?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
									   <td>6. LICENCE TYPE :</td>
									   <td colspan="2"><label class="radio-inline"><input type="radio" name="lice_type" value="NL"  <?php if(isset($lice_type) && $lice_type=='NL' || $lice_type=='') echo 'checked'; ?> /> NEW LICENCE</label>&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="lice_type" value="R"  <?php if(isset($lice_type) && $lice_type=='R') echo 'checked'; ?> /> RENEWAL</label>&nbsp;&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="lice_type" value="O"  <?php if(isset($lice_type) && $lice_type=='O') echo 'checked'; ?> /> Other Type</label></td>		   
									   <td><input type="text" name="lice_type_other" class="form-control text-uppercase"  placeholder="Other Type"   value="<?php if(isset($lice_type) && $lice_type!='R' && $lice_type!='NL' && $lice_type!='') echo $lice_type; ?>"></td>			   
									</tr>
									<tr >
									   <td>Date:</td>
									   <td class="text-uppercase"><strong><?php echo date('d-m-Y',strtotime($today));?></strong></td>
									   <td>Signature of the Authorised Signatory:</td>
									   <td class="text-uppercase"><strong><?php echo $key_person; ?></strong></td>
									</tr>
									<tr >
									   <td>Place:</td>
										<td class="text-uppercase"><strong><?php echo $dist; ?></strong></td>
									   <td>&nbsp;</td>
									   <td >&nbsp;</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1">Save & Next </button>
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	
	$('input[name="lice_type_other"]').attr("readonly","readonly");	
	$('input[name="lice_type"]').on('change', function(){
		if($(this).val() == 'O'){
			$('input[name="lice_type_other"]').removeAttr("readonly","readonly");			
		}else{
			$('input[name="lice_type_other"]').attr("readonly","readonly");		
			$('input[name="lice_type_other"]').val('');		
		}		
	});
	$('input[name="fcs_owner"]').on('change', function(){
		if($(this).val() != 'undefined')
		$('input[name="signature"]').val($(this).val());			
	});
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
</script>