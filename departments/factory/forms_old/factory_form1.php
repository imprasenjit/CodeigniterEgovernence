<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="1";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$factory->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($factory->error);
	if($q->num_rows<1){
	$p=$factory->query("select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or  die($factory->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();	
			$form_id=$results['form_id'];	
			$fac_situation=$results['fac_situation'];$province=$results['province'];$vill3=$results['vill3'];$pin3=$results['pin3'];$m_no=$results['m_no'];$n_rail_station =$results['n_rail_station'];	$particulars =$results['particulars'];	$dist3 =$results['dist3'];	$is_hazardous =$results['is_hazardous'];

		}else{
			$fac_situation="";$province="";$vill3="";$dist3="";$pin3="";$m_no="";$n_rail_station="";$particulars="";$is_hazardous="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$fac_situation=$results['fac_situation'];$province=$results['province'];$vill3=$results['vill3'];$pin3=$results['pin3'];$m_no=$results['m_no'];$n_rail_station =$results['n_rail_station'];	$particulars =$results['particulars'];	$dist3 =$results['dist3'];	$is_hazardous =$results['is_hazardous'];
	}       

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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?> </strong>
								</h4>	
							</div>
							<div class="panel-body">
							
								<br>
								
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									
									<tr>
										<td width="25%">1. Name of the Applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $key_person; ?>" ></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">2. Address of the Applicant :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name2 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo "+91-".$mobile_no; ?>"></td>
									</tr>
									<tr>
										<td>Phone No :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $landline_std." - ".$landline_no; ?>"></td>
										<td>Email ID :</td>
										<td><input type="text" class="form-control" disabled="disabled" readonly="readonly" value="<?php echo  $email; ?>"></td>
									</tr>
									<tr>
										<td>3.(a) Full name of the Factory/Establishment :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo  $unit_name; ?>"></td>
										<td></td>
										<td></td>
										
									</tr>
									<tr>
									    <td colspan="4">3.(b) Address for communication of the factory/establishment :</td>
									</tr>
									<tr>
										<td>Street Name1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="fac_situation" value="<?php if($fac_situation==NULL){ echo $b_street_name1;} else { echo $fac_situation;}  ?>"  required="required"/></td>
										<td>Street Name2 :</td>										
										<td><input type="text" class="form-control text-uppercase" required name="province"  value="<?php if($province==NULL){ echo $b_street_name2; } else { echo $province; } ?>"></td>
									</tr>
									<tr>
										<td>Village/Town :</td>
									    <td><input type="text" class="form-control text-uppercase" required name="vill3" value="<?php if($vill3==NULL){ echo $b_vill; } else { echo $vill3; } ?>"></td>
										<td>District :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" required name="dist3" value="<?php if($dist3==NULL){ echo $b_dist; } else { echo $dist3; } ?>"></td>
									</tr>
									<tr>
										<td>Pin Code :</td>										
									    <td><input type="text" class="form-control text-uppercase" required name="pin3" validate="pincode" maxlength="6" value="<?php if($pin3==NULL){ echo $b_pincode; } else { echo $pin3; } ?>"></td>
										<td>Mobile No :</td>
										<td><input type="text" class="form-control text-uppercase" name="m_no" validate="mobileNumber" maxlength="10" value="<?php if($m_no==NULL) { echo $b_mobile_no; } else { echo $m_no; } ?>"></td>
									</tr>
									<tr>
									     <td colspan="4"> 4. Location of the Factory :</td>
									     
									</tr>
									<tr>
								
										<td>Street Name :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name3; ?>"  disabled="disabled"/></td>
										<td>Province :</td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $b_street_name4; ?>" disabled="disabled"></td>
									</tr>
									<tr>
									    <td>Village/Town :</td>
									    <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_vill2; ?>" disabled="disabled"></td>
									    <td>District :</td>										
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo  $b_dist2; ?>"></td>
									</tr>
									<tr>
									    <td>Pin Code :</td>
									    <td><input type="text" class="form-control text-uppercase" value="<?php echo $b_pincode2; ?>" disabled="disabled"></td>
									    <td>Nearest railway station :<span class="mandatory_field">*</span></td>
									    <td><input type="text" class="form-control text-uppercase" required="required" name="n_rail_station" value="<?php echo $n_rail_station; ?>"></td>
									</tr>
									<tr>
										<td>5. Particulars of Plants & Machinery to be installed :</td>
										<td><textarea class="form-control text-uppercase" name="particulars"><?php echo $particulars; ?></textarea></td>
										
										
									</tr>
									<tr>
									   <td >6. Nature of Manufacturing Powers/Inputs/Outputs/Wastages : </td>
									   <td colspan="3">
											<label class="radio-inline"><input type="radio" id="inlineRadio1" value="Y" name="is_hazardous" <?php if($is_hazardous=='Y') echo 'checked'; ?>> Hazardous </label>
											<label class="radio-inline"><input type="radio" id="inlineRadio1"  value="N" name="is_hazardous" <?php if($is_hazardous=='N' || $is_hazardous=='') echo 'checked'; ?>> Non-Hazardous </label><br/>*If you choose HAZARDOUS then after final submission,you need to fill up the SITE APPRAISAL FORM.
										</td>									
									</tr>
									<tr>
									   <td>Date : <?php echo date('d-m-Y', strtotime($today)); ?></td>
									   <td>&nbsp;</td>
									   <td>&nbsp;</td>
									   <td>Signature of the applicant : <label id="signature" name="signature" class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>									
											<td class="text-center" colspan="4">
												<button type="submit" name="save<?php echo $form; ?>" class="btn btn-success submit1">Save &amp; Next</button>
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
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>