<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('clm','5');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=2&dept=clm';
		</script>";	
}  else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=5&dept=clm';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	$q=$clm->query("select * from clm_form5 where user_id=$swr_id") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$repairer_lic="";$tl_reg_no="";$tl_date="";$it_reg_no="";$type_wm="";$any_change="";$op_area="";$hav_u="";$stamp_details="";$state="";$lic_fee="";$lic_fee_words="";$bank_sub_date="";
	}else{
		$form_id=$results['form_id'];	
		$repairer_lic=$results["repairer_lic"];$tl_reg_no=$results["tl_reg_no"];$tl_date=$results["tl_date"];$it_reg_no=$results["it_reg_no"];$type_wm=$results["type_wm"];$any_change=$results["any_change"];$op_area=$results["op_area"];$hav_u=$results["hav_u"];$stamp_details=$results["stamp_details"];$state=$results["state"];$lic_fee=$results["lic_fee"];$lic_fee_words=$results["lic_fee_words"];$bank_sub_date=$results["bank_sub_date"];
	}
	##PHP TAB management
		$showtab=isset($_GET['tab'])?$_GET['tab']:"";
		
		$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";
		if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
			$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
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
									<strong><?php echo $form_name=$cms->query("select form_name from clm_form_names where form_no='5'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<br/>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1. (a) Name of the repairing concern/ person seeking renewal of license: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled="disabled"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the repairing concern/ person seeking renewal of license:</td>
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
										<td width="25%">2. Repairer's License Number: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="repairer_lic" value="<?php echo $repairer_lic;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
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
										$member_results=$clm->query("select * from clm_form5_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="13" value="" ></td>
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
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $rows->contact; ?>" /></td>
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
										<td width="25%">4. (a) Registration number of current shop/establishment/ Municipal Trade License: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="tl_reg_no" value="<?php echo $tl_reg_no;?>"></td>
										<td width="25%">(b) Date of current shop/establishment/ Municipal Trade License: </td>
										<td width="25%"><input type="text" class="dob form-control text-uppercase" name="tl_date" readonly="readonly" value="<?php echo $tl_date;?>"></td>
									</tr>
									<tr>
										<td width="25%">5. Registration Number of VAT/ Sales Tax/ CST/ Professional Tax/ Income Tax: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="it_reg_no" value="<?php echo $it_reg_no;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>									
									<tr>
										<td width="25%">6.(a) The type of weights and measures repaired as per license granted: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="type_wm" value="<?php echo $type_wm;?>"></td>
										<td width="25%">(b) Do you propose any change? </td>
										<td width="25%"><input type="radio" name="any_change" value="Y" <?php if($any_change=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="any_change" value="N" <?php if($any_change=="N" || $any_change=="") echo "checked"; ?> /> No</td>
									</tr>
									<tr>
										<td width="25%">7. Area in which you are operating: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="op_area" value="<?php echo $op_area;?>"></td>
										<td width="25%">8. Have you sufficient stock of loan/test weights, etc.: </td>
										<td width="25%"><input type="radio" name="hav_u" value="Y" <?php if($hav_u=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="hav_u" value="N" <?php if($hav_u=="N" || $hav_u=="") echo "checked"; ?> /> No</td>
							
									</tr>
									<tr>
										<td width="25%">9. Please give details with particulars of stamping: </td>
										<td width="25%"><textarea type="text" class="form-control text-uppercase" name="stamp_details" ><?php echo $stamp_details;?></textarea></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4" class="text-center"> <b>To be certified by the applicant(s)</b> </td>
									</tr>
									<tr>
										<td colspan="4">Certified that I/We have read the Legal Metrology Act, 2009 and the name of the state <input type="text" class="form-control1 text-uppercase" name="state" validate="letters" value="<?php echo $state;?>"> . 
										Legal Metrology (Enforcement) Rules, 2010 and agree to abide by the same and also the administrative orders and instructions issued or to be issued there under.</br>
										&emsp;&emsp;&emsp;I/We have deposited the Scheduled licence fees of Rs. <input type="text" class="form-control1 text-uppercase" name="lic_fee" validate="decimal" value="<?php echo $lic_fee;?>"> (Rupees <input type="text" class="form-control1 text-uppercase" name="lic_fee_words" validate="letters" value="<?php echo $lic_fee_words;?>">) to the Sub- Treasury/ Bank on <input type="text" class=" dob form-control1 text-uppercase" name="bank_sub_date" value="<?php echo $bank_sub_date;?>" readonly="readonly"> and the original challan is enclosed.</br>All the information furnished above is true to the best of my/ our knowledge.
										</td>
									</tr>

									
									
									<tr>
										<td >
										   Place:<?php echo strtoupper($dist);?>
										   <br/>
										   Date:&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?></td>
										<td></td>
										<td></td>
										<td align="right"><?php echo strtoupper($key_person); ?><br/>Signature and Designation </td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save5" value="Save and Submit" class="btn btn-success" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
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
	$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab6"]').on('click', function(){
		$('#tab6').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab7"]').on('click', function(){
		$('#tab7').css('display', 'table');
		$('#tab1, #tab2, #tab3,  #tab4, #tab5, #tab6, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab8"]').on('click', function(){
		$('#tab8').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab9').css('display', 'none');
	});
	$('a[href="#tab9"]').on('click', function(){
		$('#tab9').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8').css('display', 'none');
	});
	/* ----------------------------------------------------- */
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
	/* ---------------------upload S/C click operation-------------------- */
	
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	/* ------------------------------------------------------ */
</script>
</body>
</html>