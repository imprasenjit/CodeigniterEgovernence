<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="25";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form_new.php";
	

$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
		    $results=$p->fetch_assoc();		
		    $form_id=$results["form_id"];$serial_no=$results["serial_no"];$serial_no_1=$results["serial_no_1"];$date_1=$results["date_1"];$date_2=$results["date_2"];$appli_name=$results["appli_name"];$fathers_name=$results["fathers_name"];$sex=$results["sex"];$resi_dence=$results["resi_dence"];$date_of_birth=$results["date_of_birth"];$physical_fitness=$results["physical_fitness"];$descriptive_marks=$results["descriptive_marks"];$descriptive_marks1=$results["descriptive_marks1"];$refusal_certificate=$results["refusal_certificate"];$certificate_revoked=$results["certificate_revoked"];$name_personally=$results["name_personally"];$son_daughter=$results["son_daughter"];$residing=$results["residing"];$examination=$results["examination"];$appli_sign=$results["appli_sign"];
	}else{
		$form_id="";$serial_no="";$serial_no_1="";$date_1="";$date_2="";$appli_name="";$fathers_name="";$sex="";$resi_dence="";$date_of_birth="";$physical_fitness="";$descriptive_marks="";$descriptive_marks1="";$refusal_certificate="";$certificate_revoked="";$name_personally="";$son_daughter="";$residing="";$examination="";$appli_sign="";
	}
 }else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];$serial_no=$results["serial_no"];$serial_no_1=$results["serial_no_1"];$date_1=$results["date_1"];$date_2=$results["date_2"];$appli_name=$results["appli_name"];$fathers_name=$results["fathers_name"];$sex=$results["sex"];$resi_dence=$results["resi_dence"];$date_of_birth=$results["date_of_birth"];$physical_fitness=$results["physical_fitness"];$descriptive_marks=$results["descriptive_marks"];$descriptive_marks1=$results["descriptive_marks1"];$refusal_certificate=$results["refusal_certificate"];$certificate_revoked=$results["certificate_revoked"];$name_personally=$results["name_personally"];$son_daughter=$results["son_daughter"];$residing=$results["residing"];$examination=$results["examination"];$appli_sign=$results["appli_sign"];
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
										   <td width="25%">1. Serial No:</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="serial_no" value="<?php echo $serial_no; ?>" ></td>
										   <td width="25%">Serial No:</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="serial_no_1" value="<?php echo $serial_no_1; ?>" ></td>
										</tr>
										<tr>
										   <td width="25%">Date :</td>
										   <td width="25%"><input type="text" class="dob form-control text-uppercase"  name="date_1" value="<?php echo $date_1; ?>" ></td>
										   <td width="25%">Date :</td>
										   <td width="25%"><input type="text" class="dob form-control text-uppercase"  name="date_2" value="<?php echo $date_2; ?>" ></td>
										</tr>
										<tr>
										   <td width="25%">2. Name :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="appli_name" value="<?php echo $appli_name; ?>" ></td>
										   <td width="25%">3. Father's Name :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="fathers_name" value="<?php echo $fathers_name; ?>" ></td>
										</tr>
										<tr>
										   <td width="25%">4.Sex :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="sex" value="<?php echo $sex; ?>" ></td>
										   <td width="25%">5. Residence :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="resi_dence" value="<?php echo $resi_dence; ?>" ></td>
										</tr>
										<tr>
										   <td width="25%">6.Date of Birth, if applicable and/or certified age :</td>
										   <td width="25%"><input type="text" class="dob form-control text-uppercase"  name="date_of_birth" value="<?php echo $date_of_birth; ?>" ></td>
										   <td width="25%">7.Physical fitness :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="physical_fitness" value="<?php echo $physical_fitness; ?>" ></td>
										</tr>
										<tr>
										   <td width="25%">8.Descriptive marks :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="descriptive_marks" value="<?php echo $descriptive_marks; ?>" ></td>
										   <td width="25%">His/Her descriptive marks are :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="descriptive_marks1" value="<?php echo $descriptive_marks1; ?>" ></td>
										</tr>
										<tr>
										   <td colspan="4">9.Reason for:</td>
										</tr>
										<tr>
										   <td width="25%">1.Refusal of certificate :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="refusal_certificate" value="<?php echo $refusal_certificate; ?>" ></td>
										   <td width="25%">2.Certificate being revoked :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase"  name="certificate_revoked" value="<?php echo $certificate_revoked; ?>" ></td>
										</tr>
                                    <tr class="form-inline">
									       <td colspan="4">I hereby certify that I have personally examined (name) <input type="text" class="form-control text-uppercase"  name="name_personally" value="<?php echo $name_personally; ?>" > Son /daughter of <input type="text" class="form-control text-uppercase"  name="son_daughter" value="<?php echo $son_daughter; ?>" >residing at<input type="text" class="form-control text-uppercase"  name="residing" value="<?php echo $residing; ?>" > who is desirous of being employed in a factory, and that his/her age , as nearly of being employed in a factory, and that his/her age, as nearly as can be ascertained from my examination,<input type="text" class="form-control text-uppercase"  name="examination" value="<?php echo $examination; ?>" > is years, and that he/she is fit for employment in factory as an adult/ child.</td>
									    </tr>
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : &nbsp;<input type="text" class="form-control text-uppercase" name="appli_sign" value="<?php echo $appli_sign; ?>"></td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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
</script>