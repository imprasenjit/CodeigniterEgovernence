<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('clm','2');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=clm';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=2&dept=clm';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$pincode="";$address="";$contact="";$family_name="";
	
	$q=$clm->query("select * from clm_form2 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$is_lease_doc="";$area="";$previous="";$machinery="";$elect_energy="";$sufficient="";$reg_number="";$weights_measure="";$is_applied="";$is_applied_details="";
		$fact_reg_date="";$fact_reg_no="";
		$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		$weights_measure_w="";$weights_measure_m="";$weights_measure_wi="";$weights_measure_mi="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";$total_turnover="";
	}
	else{
		$form_id=$results['form_id'];	
		$is_lease_doc=$results['is_lease_doc'];$area=$results['area'];$previous=$results['previous'];$machinery=$results['machinery'];$elect_energy =$results['elect_energy'];$sufficient =$results['sufficient'];$reg_number =$results['reg_number'];$weights_measure =$results['weights_measure'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];$total_turnover =$results['total_turnover'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
		}
		if(!empty($results["weights_measure"]))
		{
			$weights_measure=json_decode($results["weights_measure"]);
			$weights_measure_w=$weights_measure->w;$weights_measure_m=$weights_measure->m;$weights_measure_wi=$weights_measure->wi;$weights_measure_mi=$weights_measure->mi;
		}else{
			$weights_measure_w="";$weights_measure_m="";$weights_measure_wi="";$weights_measure_mi="";
		}
		if(!empty($results["persons"]))
		{
			$persons=json_decode($results["persons"]);
			$persons_skill=$persons->skill;$persons_semi_skill=$persons->semi_skill;$persons_unskill=$persons->unskill;$persons_trained=$persons->trained;
		}else{
			$persons_skill="";$persons_semi_skill="";$persons_unskill="";$persons_trained="";
		}		
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}		
	}
	
##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
##PHP TAB management ends
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control{
			background-color: #fff;
			background-image: none;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
			color: #555;
			display: block;
			font-size: 14px;
			height: 34px;
			line-height: 1.42857;
			padding: 6px 12px;
			transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
			width: 100%;
		}
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
	<div class="wrapper">
	  <?php require '../../../user_area/includes/header.php'; ?>
	  <?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									
									<strong>Form LR-I<br/>SCHEDULE-II A<br/>[See rule 11 (1)]<br/><?php echo $form_name=$formFunctions->get_formName('clm','2'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td colspan="3">1. Name of the manufacturing concern seeking the license :</td>
										<td ><input type="text" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled" ></td>
									</tr>
									<tr>
										<td colspan="4">2. Complete address of the workshop.</td>					
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
										<td width="25%">3. (a) Whether premises are owned /rented / taken on lease duly supported by documents:<span class="mandatory_field">*</span></td>
										<td width="25%"><select required="required" name="is_lease_doc" class="form-control text-uppercase">
											<option value="">Please Select</option>
											<option <?php if($is_lease_doc=="O") echo "selected"; ?> value="O">Owned</option>
											<option <?php if($is_lease_doc=="R") echo "selected"; ?> value="R">rented</option>
											<option <?php if($is_lease_doc=="T") echo "selected"; ?> value="T">Taken on lease</option>
										</select></td>
										<td width="25%">(b) Date of Establishment :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" value="<?php echo date('d-m-Y',strtotime($date_of_commencement));?>" disabled="disabled"></td>
									</tr>
									<tr>
										<td colspan=4>4. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company :</td>
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
										$member_results=$clm->query("select * from clm_form2_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6"value="<?php echo $pincode; ?>" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" maxlength="10" title="Please enter 10 digit number" value="<?php echo $contact; ?>" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" maxlength="13" pattern="[0-9]{10,13}" title="Please enter 10 digit number" value="<?php echo $rows->contact; ?>" /></td>
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
										<td colspan="4">5. Number and date of shop/ establishment/ current Municipal Trade Licence. :</td>
									</tr>
									<tr>
										<td width="25%">Date :</td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="fact[reg_date]" readonly="readonly" value="<?php if($fact_reg_date!="0000-00-00" && $fact_reg_date!="") echo date('d-m-Y',strtotime($fact_reg_date));else echo "";?>" placeholder="DD-MM-YYYY" ></td>
										<td width="25%">Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="fact[reg_no]" validate="specialChar" value="<?php echo $fact_reg_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">6. Professional Tax/ IT Tax registration Number etc if any :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="reg_number" validate="specialChar" value="<?php echo $reg_number;?>" ></td>
										<td width="25%">Total value of transactions / turnover :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="total_turnover"  validate="onlyNumbers" value="<?php echo $total_turnover;?>"></td>
									</tr>
									<tr>
										<td colspan="4">7. The type of weights and measures proposed to be repaired. :</td>		
									</tr>
									<tr>
										<td width="25%">(i)Weights : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weights_measure[w]" validate="specialChar" value="<?php echo $weights_measure_w;?>"  ></td>
										<td width="25%">(ii)Measures : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weights_measure[m]" validate="specialChar" value="<?php echo $weights_measure_m;?>"  ></td>	
									</tr>
									<tr>
										<td width="25%">(iii)Weighing Instruments : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weights_measure[wi]" validate="specialChar" value="<?php echo $weights_measure_wi;?>"  ></td>
										<td width="25%">(iv)Measuring Instruments with details in each case : </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weights_measure[mi]" validate="specialChar" value="<?php echo $weights_measure_mi;?>"  ></td>	
									</tr>
									<tr>
										<td>8. Area in which you wish to operate.:</td>
										<td><input type="text" class="form-control text-uppercase" name="area" validate="specialChar" value="<?php echo $area;?>" ></td>
										<td>9. Previous experience in the line :</td>
										<td><input type="text" class="form-control text-uppercase" name="previous" validate="specialChar" value="<?php echo $previous;?>"></td>
									</tr>
									<tr>
										<td colspan="4">10. The number of persons employed/proposed to be employed :</td>
									</tr>
									<tr>
										<td>(i)Skilled :</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[skill]" validate="onlyNumbers" value="<?php echo $persons_skill;?>"></td>
										<td>(ii)Semi-skilled:</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[semi_skill]" validate="onlyNumbers" value="<?php echo $persons_semi_skill;?>"></td>
									</tr>
									<tr>
										<td>(iii)Unskilled:</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[unskill]" validate="onlyNumbers" value="<?php echo $persons_unskill;?>"></td>
										<td>(iv)Specialist trained in the line:</td>
										<td><input type="text" class="form-control text-uppercase" name="persons[trained]" validate="onlyNumbers" value="<?php echo $persons_trained;?>"></td>
									</tr>
									<tr>
									<tr>
										<td >11. Details of machinery/ tools/ accessories available :</td>
										<td><textarea class="form-control text-uppercase" name="machinery" validate="textarea"><?php echo $machinery;?></textarea></td>
										<td >12. Availability of electric energy :</td>
										<td><input type="text" class="form-control text-uppercase" name="elect_energy" validate="SpecialChar" value="<?php echo $elect_energy;?>" ></td>
									</tr>
									<tr>
										<td >13. Have you sufficient stock of loan/test weights, etc.Give details. :</td>
										<td><textarea class="form-control text-uppercase" validate="textarea" name="sufficient"><?php echo $sufficient;?></textarea></td>
									</tr>
									<tr>
										<td >14. Have you applied previously for a repairer’s licence.:<span class="mandatory_field">*</span></td>
										<td><label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="Y" <?php if($is_applied=='Y') echo 'checked'; ?> required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="N" <?php if($is_applied=='N') echo 'checked'; ?> >&nbsp;No </label></td>
										<td>If, so When and with what results? :</td>
										<td><input type="text" class="form-control text-uppercase" name="is_applied_details" id="is_applied_details" validate="specialChar" value="<?php echo $is_applied_details;?>"></td>
									</tr>	
									<tr>
										<td>Date : <strong><?php echo date('d-m-Y',strtotime($today));?></strong><br/>
										Place : <strong><?php echo strtoupper($dist);?></strong></td>
										<td></td>
										<td></td>
										<td>Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
										Designation : <strong><?php echo strtoupper($status_applicant);?></strong></td>
									</tr>																			
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save2" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	  <?php require '../../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php' ?>
<script>
	$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4').css('display', 'none');
	});
	/* ----------------------------------------------------- */
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
</body>
</html>