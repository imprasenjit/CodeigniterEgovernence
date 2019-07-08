<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="7";
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
		$form_id=$results["form_id"];
		$nature_of_industry=$results['nature_of_industry'];$name_patient=$results['name_patient'];$works_no_patient=$results['works_no_patient'];$sex=$results['sex'];$age=$results['age'];$occupation=$results['occupation'];$nature_of_poison=$results['nature_of_poison'];$is_reported=$results['is_reported'];

		if(!empty($results["patient"])){
			$patient=json_decode($results["patient"]);
			$patient_sn1=$patient->sn1;$patient_sn2=$patient->sn2;$patient_vill=$patient->vill;$patient_dist=$patient->dist;$patient_pincode=$patient->pincode;$patient_mobile=$patient->mobile;
		}else{				
			$patient_sn1="";$patient_sn2="";$patient_vill="";$patient_dist="";$patient_pincode="";$patient_mobile="";
		}	
	}else{
		$form_id="";$nature_of_industry="";$name_patient="";$works_no_patient="";$sex="";$age="";$occupation="";$nature_of_poison="";$is_reported="";
		$patient_sn1="";$patient_sn2="";$patient_vill="";$patient_dist="";$patient_pincode="";$patient_mobile="";
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$nature_of_industry=$results['nature_of_industry'];$name_patient=$results['name_patient'];$works_no_patient=$results['works_no_patient'];$sex=$results['sex'];$age=$results['age'];$occupation=$results['occupation'];$nature_of_poison=$results['nature_of_poison'];$is_reported=$results['is_reported'];

	if(!empty($results["patient"])){
		$patient=json_decode($results["patient"]);
		$patient_sn1=$patient->sn1;$patient_sn2=$patient->sn2;$patient_vill=$patient->vill;$patient_dist=$patient->dist;$patient_pincode=$patient->pincode;$patient_mobile=$patient->mobile;
	}else{				
		$patient_sn1="";$patient_sn2="";$patient_vill="";$patient_dist="";$patient_pincode="";$patient_mobile="";
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4" align="center"><strong>FACTORY PARTICULARS</strong></td>
										</tr>
										<tr>
											<td width="25%">1. Name of the Factory :</td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $unit_name; ?>"></td>
											<td width="25%">2. Address of the Factory :</td>
											<td width="25%"><textarea class="form-control text-uppercase" disabled="disabled" ><?php echo $unit_details; ?></textarea></td>							
										</tr>
										<tr>
											<td colspan="4">3. Address of office or private residence of occupier :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name1; ?>"	></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $street_name2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo  $dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $pincode; ?>"></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
										</tr>
										<tr>
											<td>4. Nature of Industry :</td>
											<td><input type="text" class="form-control text-uppercase" name="nature_of_industry" value="<?php echo $nature_of_industry; ?>"></td>	
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4" align="center"><strong>PERSON AFFECTED</strong></td>
										</tr>
										<tr>
											<td>5. Name of patient : </td>
											<td><input type="text" class="form-control text-uppercase" name="name_patient" value="<?php echo $name_patient; ?>"></td>	
											<td>6. Works Number of patient :</td>
											<td><input type="text" class="form-control text-uppercase" name="works_no_patient" value="<?php echo $works_no_patient; ?>"></td>	
										</tr>
										<tr>
											<td colspan="4">7. Address of patient :</td>
										</tr>
										<tr>
											<td>Street Name1 :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[sn1]" value="<?php echo $patient_sn1; ?>"></td>
											<td>Street Name2 :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[sn2]" value="<?php echo $patient_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[vill]" value="<?php echo $patient_vill; ?>"></td>
											<td>District :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[dist]" value="<?php echo $patient_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[pincode]"validate="pincode" maxlength="6" value="<?php echo $patient_pincode; ?>" ></td>
											<td>Mobile No :</td>
											<td><input type="text" class="form-control text-uppercase" name="patient[mobile]" validate="mobileNumber" maxlength="10" value="<?php echo $patient_mobile; ?>" ></td>
										</tr>										
										<tr>
											<td>8. Sex of patient : <span class="mandatory_field">*</span></td>
											<td>
												<label class="radio-inline"><input type="radio" value="M" name="sex" <?php if($sex=='M') echo 'checked'; ?> />&nbsp;Male</label>
												<label class="radio-inline"><input type="radio" value="F" name="sex" <?php if($sex=='F' || $sex=='') echo 'checked'; ?> >&nbsp;Female</label>
											</td>
											<td>9. Age of patient  :</td>
											<td><input type="text" class="form-control text-uppercase" name="age" value="<?php echo $age; ?>"></td>											
										</tr>
										<tr>
											<td>10. Precise occupation of patient  :</td>
											<td><input type="text" class="form-control text-uppercase" name="occupation" value="<?php echo $occupation; ?>"></td>
											<td>11. Nature of Poisoning or Disease from which patient is suffering  :</td>
											<td><input type="text" class="form-control text-uppercase" name="nature_of_poison" value="<?php echo $nature_of_poison; ?>"></td>			
										</tr>
										<tr>
											<td colspan="4" align="center"><strong>GENERAL PARTICULARS</strong></td>
										</tr>
										<tr>
											<td colspan="2">12. Has the case been reported to the Certifying Surgeon? <span class="mandatory_field">*</span></td>
											<td>
												<label class="radio-inline"><input type="radio" value="Y" name="is_reported" <?php if($is_reported=='Y') echo 'checked'; ?> />&nbsp;YES</label>
												<label class="radio-inline"><input type="radio" value="N" name="is_reported" <?php if($is_reported=='N' || $is_reported=='') echo 'checked'; ?> >&nbsp;NO</label>
											</td>
										<tr>
											<td colspan="4" align="right">Signature of Factory Manager : &nbsp;&nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/> Date : &nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong><br/></td>
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
</script>