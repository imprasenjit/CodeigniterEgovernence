<?php  require_once "../../requires/login_session.php"; 
$dept="pcb";
$form="5";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_bt_form.php";

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){	 
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$occupier_name=$results["occupier_name"];$imprt_license_no=$results["imprt_license_no"];
	}else{	
        $form_id="";	
		$occupier_name="";$imprt_license_no="";		
	}
}else{
	$results=$q->fetch_assoc();
    $form_id=$results['form_id'];	
	$occupier_name=$results["occupier_name"];$imprt_license_no=$results["imprt_license_no"];
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
								<form name="myform1" id="myformBT2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									<tr>
										<td colspan="4">1. Name and address of the importer</td>
									</tr>
									<tr>
										<td>Name</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
									</tr>
									<tr>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									</tr>
									<tr>
										<td>Mobile</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										<td>Phone No</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $landline_std.'-'.$landline_no; ?>"></td>
										
									</tr>
									<tr>
										<td>Email-Id</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
										
									</tr>
									<tr>
										<td>2. Importer/ Export License No. <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  name="imprt_license_no" required="required" value="<?php  echo $imprt_license_no; ?>"></td>
										<td>Name of person/ owner/ occupier as the case may be <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="occupier_name" required="required" value="<?php echo $occupier_name; ?>"></td>
									</tr>
									<tr>
										<td>Place</td>
										<td><?php echo strtoupper($dist); ?></td>
										<td></td>
										<td></td>										
									</tr>
									<tr>
										<td>Date</td>
										<td><?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td>Signature of the Importer</td>
										<td><label id="signature" name="signature" class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td></td>
										<td class="text-center" colspan="2">
											<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form; ?>" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save & Next</button>
										</td>
										<td></td>
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
	/* ------------------------------------------------------ */	
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>