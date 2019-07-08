<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('clm','3');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=clm';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=3&dept=clm';
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
	
	$q=$clm->query("select * from clm_form3 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$weights_measure="";$reg_number="";$is_intend="";$source_supply="";$monogram="";$lic_num="";$regis_impoter="";$model_impoter="";$is_applied="";$is_applied_details="";
		$fact_reg_date="";$fact_reg_no="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];	
		$weights_measure =$results['weights_measure'];$reg_number =$results['reg_number'];$is_intend=$results['is_intend'];$source_supply=$results['source_supply'];$monogram =$results['monogram'];$lic_num =$results['lic_num'];$regis_impoter =$results['regis_impoter'];$model_impoter =$results['model_impoter'];$is_applied =$results['is_applied'];$is_applied_details =$results['is_applied_details'];
		if(!empty($results["fact"]))
		{
			$fact=json_decode($results["fact"]);
			$fact_reg_date=$fact->reg_date;$fact_reg_no=$fact->reg_no;
		}else{
			$fact_reg_date="";$fact_reg_no="";
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
									<strong>Form LD-I<br/>[See rule 11 (1)]<br/><?php echo $form_name=$formFunctions->get_formName('clm','3'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td width="25%">1. Name of the establishment/shop/person seeking the licence :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">2. Complete address of the establishment etc  :</td>					
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
										<td width="25%">3. Date of established :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" disabled="disabled" value="<?php echo $date_of_commencement;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">4. Name(s) and address(s) of proprietors and / or partners and Managing Director(s) in the case of Limited Company:</td>
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
										$member_results=$clm->query("select * from clm_form3_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="<?php echo $pincode; ?>" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="13" value="<?php echo $contact; ?>" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" maxlength="13" value="<?php echo $rows->contact; ?>" /></td>
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
										<td colspan="4">5. Number and date of Registration Number of current shop/ establishment/Municipal Trade licence :</td>
									</tr>
									<tr>
										<td width="25%">Date :</td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="fact[reg_date]" value="<?php echo $fact_reg_date;?>"></td>
										<td width="25%">Registration Number :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="fact[reg_no]" value="<?php echo $fact_reg_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">6. Categories of weights and measures sold/proposed to be sold at present :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weights_measure" value="<?php echo $weights_measure;?>"  ></td>
										<td width="25%">7. Registration Number of VAT/CST/Sales Tax/ Professional Tax/Income Tax :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="reg_number" value="<?php echo $reg_number;?>" ></td>
									
									</tr>
									<tr>
										<td colspan="2">8. Do you intend to imports weights, etc. from places outside the State/ Country? :</td>
										<td>
											<label class="radio-inline"><input type="radio" name="is_intend" id="is_intend" value="Y" <?php if($is_intend=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_intend" id="is_intend"value="N" <?php if($is_intend=='N') echo 'checked'; ?> />&nbsp;No </label></td>
										<td></td>
									</tr>
									<tr id="is_intend_details">
										<td colspan="4">If so indicate sources of supply.(Give details of manufacturer’s trade mark/ monogram and  his licence number) and provide :
										<table class="table table-responsive">
											<tr>
												<td>Sources of supply :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="source_supply" id="source_supply" value="<?php echo $source_supply;?>"></td>
												<td width="25%">Manufacturer’s trade mark/ monogram :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="monogram" id="monogram" value="<?php echo $monogram;?>"></td>
											</tr>
											<tr>
												<td width="25%">License Number:</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="lic_num" id="lic_num" value="<?php echo $lic_num;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td width="25%">(a) Registration of Importer of Weights and Measures, if any :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="regis_impoter" value="<?php echo $regis_impoter;?>"></td>
												<td width="25%">(b) Approval of model imported into India by Central Government :</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="model_impoter" value="<?php echo $model_impoter;?>"></td>
											</tr>
										</table></td>
									</tr>
									<tr>
										<td >9. Have you applied previously for a dealer’s licence either in this State or elsewhere?  :</td>
										<td><label class="radio-inline"><input type="radio" name="is_applied" id="is_applied" value="Y" <?php if($is_applied=='Y') echo 'checked'; ?> > Yes </label>
											<label class="radio-inline"><input type="radio" name="is_applied" id="is_applied"value="N" <?php if($is_applied=='N') echo 'checked'; ?> />&nbsp;No </label></td>
										<td >If so give details? :</td>
										<td><input type="text" class="form-control text-uppercase" name="is_applied_details" id="is_applied_details" value="<?php echo $is_applied_details;?>"></td>
									</tr>																			
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save3" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	<?php if($is_intend == 'N' || $is_intend == '') echo "$('#is_intend_details').hide();"; ?>
	$('input[name="is_intend"]').on('change', function(){
		if($(this).val() == 'N')
			$('#is_intend_details').hide();
		else
			$('#is_intend_details').show();
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>