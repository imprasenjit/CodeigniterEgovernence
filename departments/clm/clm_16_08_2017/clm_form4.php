<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('clm','4');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=clm';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=4&dept=clm';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	$q=$clm->query("select * from clm_form4 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$license_no="";
		$type_measures="";$type_weight="";$type_instrument="";$type_details="";$type_changes="";$weight_trademark="";$workshop_details="";$production_details="";$shop_reg_no="";$shop_reg_date="";$tax_reg_no="";
		$state="";$license_fee="";$license_fee_words="";$license_fee_date="";$total_turnover="";
	}else{
		$form_id=$results['form_id'];	
		$license_no=$results['license_no'];$type_changes=$results['type_changes'];$weight_trademark=$results['weight_trademark'];$workshop_details =$results['workshop_details'];$production_details =$results['production_details'];$shop_reg_no =$results['shop_reg_no'];$shop_reg_date =$results['shop_reg_date'];$tax_reg_no =$results['tax_reg_no'];$state =$results['state'];$license_fee =$results['license_fee'];$license_fee_words =$results['license_fee_words'];$license_fee_date =$results['license_fee_date'];$total_turnover =$results['total_turnover'];
		
		if(!empty($results['type'])){
			$type=json_decode($results['type']);
			$type_measures=$type->measures;$type_weight=$type->weight;$type_instrument=$type->instrument;$type_details=$type->details;
		}else{
			$type_measures="";$type_weight="";$type_instrument="";$type_details="";
		}
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
		
		$tabbtn1="";$tabbtn2="";
		if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
			$tabbtn1="active";$tabbtn2="";
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
								<strong>Form LM-II<br/>SCHEDULE II B<br/>[See rule 11 (2)]<br/><?php echo $form_name=$formFunctions->get_formName('clm','4'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. (a) Name of the manufacturing concern for which renewal of license is desired: </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
									    <td colspan="4">(b) Address of the manufacturing concern for which renewal of license is desired:</td>
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
										<td width="25%">2. Manufacturing License No.: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="license_no" value="<?php echo $license_no;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan=4>3. Name(s) and address(s) along with their father’s husband’s name of proprietor(s) and/or Partners and Managing Director(s) in the case of Limited company:</td>
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
										$member_results=$clm->query("select * from clm_form4_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="11" value="" ></td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
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
										<td colspan="4">4.(a) Type of weights and measures which are manufactured as per license granted: </td>
									</tr>
									<tr>
										<td width="25%">(i)Weights :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[weight]" value="<?php echo $type_weight;?>"></td>
										<td width="25%">(ii)Measures:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[measures]" value="<?php echo $type_measures;?>"></td>
									</tr>
									<tr>
										<td width="25%">(iii)Weighing Instruments :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[instrument]" value="<?php echo $type_instrument;?>"></td>
										<td width="25%">(iv)Measuring Instruments with details in each case:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="specialChar" name="type[details]" value="<?php echo $type_details;?>"></td>
									</tr>
									<tr>
										<td width="25%">4.(b) Do you propose any change? </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_changes" value="<?php echo $type_changes;?>"></td>
									</tr>
									<tr>
										<td width="25%">5. The monogram or trademarks used on weights and measures manufactured by you: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="weight_trademark" value="<?php echo $weight_trademark;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
										<td width="25%">6. Details of workshop facilities available: </td>
										<td><textarea type="text" validate="textarea" class="form-control text-uppercase" name="workshop_details"><?php echo $workshop_details;?></textarea>255 Characters Only</td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									
									<tr>
										<td width="25%">7. Details of production and sales in the last 5 years: </td>
										<td><textarea type="text" validate="textarea" class="form-control text-uppercase" name="production_details"><?php echo $production_details;?></textarea>255 Characters Only</td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td width="25%">8. (a) Number of shop/establishment Registration: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="shop_reg_no" value="<?php echo $shop_reg_no;?>"></td>
										<td width="25%">8. (b) Date of shop/establishment Registration: </td>
										<td width="25%"><input type="text" class="dobindia form-control text-uppercase" name="shop_reg_date" value="<?php if($shop_reg_date!="0000-00-00" && $shop_reg_date!="") echo date("d-m-Y",strtotime($shop_reg_date)); else echo ""; ?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
									</tr>
									<tr>
										<td width="25%">9. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tax_reg_no" value="<?php echo $tax_reg_no;?>"></td>
										<td width="25%">Total value of transactions / turnover :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="total_turnover"  validate="onlyNumbers" value="<?php echo $total_turnover;?>" ></td>
									</tr>	
									<tr>
										<td colspan="4" class="text-center"> <b>To be certified by the applicant(s) </b></td>
									</tr>
									<tr>
										<td colspan="4">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state <input type="text" class="form-control1 text-uppercase" validate="letters" name="state" value="<?php echo $state;?>"> . 
										Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.</br>
										&emsp;&emsp;&emsp;I/We have deposited the Scheduled licence fees of Rs. <input type="text" class="form-control1 text-uppercase" name="license_fee" validate="onlyNumbers" value="<?php echo $license_fee;?>"> (Rupees) <input type="text" class="form-control1 text-uppercase" name="license_fee_words" validate="letters" value="<?php echo $license_fee_words;?>"> to the Sub- Treasury/ Bank on <input type="text" class="dobindia form-control1 text-uppercase" name="license_fee_date" value="<?php if($license_fee_date!="0000-00-00" && $license_fee_date!="") echo date("d-m-Y",strtotime($license_fee_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"> and the original challan is enclosed.</br>All the information furnished above is true to the best of my/ our knowledge.
										</td>
									</tr>
									<tr>
										<td >
										   Place : <?php echo strtoupper($dist)?>
										   <br/>
										   Date :&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td></td>
										<td></td>
										<td align="right">Signature : <strong><?php echo strtoupper($key_person);?></strong><br/>
										Designation : <strong><?php echo strtoupper($status_applicant);?></strong></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save4" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; next</button>
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
	/* ---------------------upload S/C click operation-------------------- */
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
</script>
</body>
</html>