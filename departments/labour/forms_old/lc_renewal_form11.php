<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="11";
$table_name=$formFunctions->getTableName($dept,$form);

$check=$formFunctions->is_already_registered($dept,$form);
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=".$form."&dept=".$dept."';
		</script>";
}else if($check==3){
	echo "<script>
			window.location.href = '".$server_url."departments/requires/payment_section.php?form=".$form."&dept=".$dept."';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

		$q=$labour->query("select * from ".$table_name." where user_id=$swr_id") or die($labour->error);
		
		if($q->num_rows<1)////////for empty/////
		{	 
			$form_id="";$prev_lic_date="";$is_suspended="";$max_workers="";
			$license_no="";$license_dt="";	
		}else {
			$results=$q->fetch_assoc();
			$form_id=$results['form_id'];		
			$prev_lic_date=$results["prev_lic_date"];$is_suspended=$results["is_suspended"];$max_workers=$results["max_workers"];
			
			if(!empty($results["contractor"])) {
				$contractor=json_decode($results["contractor"]);
				$contractor_sn1=$contractor->sn1;$contractor_sn2=$contractor->sn2;$contractor_v=$contractor->v;$contractor_d=$contractor->d;$contractor_pin=$contractor->pin;
			}else{
				$contractor_sn1="";$contractor_sn2="";$contractor_v="";$contractor_d="";$contractor_pin="";
			}
			if(!empty($results["license"]))
			{
				$license=json_decode($results["license"]);
				$license_no=$license->no;$license_dt=$license->dt;
			}
			else
			{
				$license_no="";$license_dt="";
			}			
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>		
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td width="25%">1.(a) Name of The Contractor</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td>(b) Address of The Contractor</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no;?>"></td>
									</tr>	
									<tr>
										<td colspan="4">2. Number and Date of the license</td>
									</tr>
									<tr>
										<td>Number:<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="license[no]" value="<?php echo $license_no; ?>"  required></td>
										<td>Date:<span class="mandatory_field">*</span></td>
										<td><input type="datetime" class="dob4 form-control text-uppercase" placeholder="DD/MM/YYYY" name="license[dt]" readonly="readonly" value="<?php echo $license_dt; ?>"  required></td>
									</tr>
									<tr>
										<td>3. Date of expiry of the previous license<span class="mandatory_field">*</span></td>
										<td><input type="datetime" class="dob5 form-control text-uppercase" placeholder="DD/MM/YYYY"  name="prev_lic_date" value="<?php echo $prev_lic_date; ?>" readonly="readonly" required></td>
										<td>4. Whether the license of the contractor <br/>was suspended or revoked</td>
										<td>
										    <label class="radio-inline"><input type="radio"name="is_suspended"  value="Y" <?php if($is_suspended=='Y') echo 'checked'; ?> checked />&nbsp;Yes</label>
											<label class="radio-inline"><input type="radio" name="is_suspended" value="N" <?php if($is_suspended=='N') echo 'checked'; ?> />&nbsp;No </label></td>
									</tr>
									<tr>
										<td>5. No. of workers employed on any day :<span class="mandatory_field">*</span></td>
										<td><input type="text"  name="max_workers" required="required" validate="onlyNumbers" value="<?php echo $max_workers; ?>" class="form-control text-uppercase"></td>
										<td></td>
										<td></td>
									</tr>
										
								
									<tr>
										<td >
										   Date :&nbsp;<?php echo date('d-m-Y',strtotime($today)); ?>
										   <br/><br/>
										   Place : <?php echo strtoupper($dist);?></td>
										<td></td>
										<td></td>
										<td class="text-center" ><?php echo strtoupper($key_person); ?><br/>Signature of the Applicant (Contractor) </td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save<?php echo $form;?>" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('.dob4').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob5').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
</script>
</body>
</html>