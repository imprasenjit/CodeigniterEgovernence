<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('power','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=power';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=power';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form.php";

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$sector_classes_b=$row1['sector_classes_b'];$w_l=$row1['w_l'];$mouza=$row1['mouza'];$dagno=$row1['dagno'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;
	
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	if($w_l=="O") $w_l="Own";
	else if($w_l=="R") $w_l="Rented";
	else if($w_l=="L") $w_l="Leased";
	else $w_l="";
	$q=$power->query("select * from power_form1 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();
	if($q->num_rows<1){		
		$consumer_category="";$service_requested="";$supply_type="";$exist_con_no="";			
		$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";			
		$mouza_no="";$dag_no="";$esd="";
		$request_load="";
		$file1="";$file2="";$contract_demand_num="";$contract_demand_unit="";
	}else{			
		$required_power=$results["required_power"];
		$service_requested=$results["service_requested"];
		$file1=$results["file1"];$file2=$results["file2"];
		$consumer_category=$results["consumer_category"];
		
		$exist_con_no=$results["exist_con_no"];$esd=$results["esd"];$request_load=$results["request_load"];
		$mouza_no=$results["mouza_no"];$dag_no=$results["dag_no"];
		
		if(!empty($results["billing"])){
			$billing=json_decode($results["billing"]);
			$billing_sn1=$billing->sn1;$billing_sn2=$billing->sn2;$billing_town=$billing->town;$billing_d=$billing->d;$billing_pin=$billing->pin;$billing_mobile=$billing->mobile;
		}else{
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";
		}
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
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
								<strong><?php echo $form_name=$formFunctions->get_formName('power','1'); ?></strong>
							</h4>		
							</div>
							<div class="panel-body">
								<form name="form1" id="form1" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="tab1" class="table table-responsive">
									<tr>
										<td colspan="4"><strong>General Information</strong></td>
									</tr>
									<tr>
										<td width="25%">Required Power (in KW) :<span class="mandatory_field">*</span></td>
										<td width="25%">
											<div class="input-group">
												<input type="number" class="form-control" id="required_power" name="required_power" value="<?php echo $required_power; ?>" required="required" placeholder="Load" aria-describedby="basic-addon2">
												<span class="input-group-addon" id="basic-addon2">K.W.</span>
											</div>
										</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td width="25%">Consumer Category :<span class="mandatory_field">*</span></td>
										<td width="25%">
										<select class="form-control text-uppercase" name="consumer_category" required="required" id="consumer_category">
			<option value="">Please Select</option>
			<option <?php if($consumer_category=="LT Commercial") echo "selected";?> value="LT Commercial">LT Commercial</option>
			<option <?php if($consumer_category=="LT General Purpose") echo "selected";?> value="LT General Purpose">LT General Purpose</option>
			<option <?php if($consumer_category=="LT Small Industries") echo "selected";?> value="LT Small Industries">LT Small Industries</option>
			<option <?php if($consumer_category=="HT Small Industries") echo "selected";?> value="HT Small Industries">HT Small Industries</option>
			<option <?php if($consumer_category=="HT Industries I") echo "selected";?> value="HT Industries I">HT Industries I</option>
			<option <?php if($consumer_category=="HT Industries II") echo "selected";?> value="HT Industries II">HT Industries II</option>
										</select></td>
										<td>Service Requested :<span class="mandatory_field">*</span></td>
										<td>
										<select class="form-control text-uppercase" required="required" name="service_requested" id="service_requested">
											<option <?php if($service_requested=="P") echo "selected";?> value="P">New Connection(Permanent)</option>
										    <option <?php if($service_requested=="T") echo "selected";?> value="T">New Connection(Temporary)</option>
										</select></td>
									</tr>
									<tr>
										<td>Company Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_name" id="applicant_name"  disabled="disabled"  value="<?php echo $unit_name; ?>"/></td>
										<td>Name of the Applicant :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_name" id="applicant_name"  disabled="disabled"  value="<?php echo $key_person; ?>"/></td>									
									</tr>
									<tr>
										<td colspan="4"><strong>Address of the Applicant </strong> 	</td>
									</tr>
									<tr>
										<td>House No/ Plot No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $street_name1 ?>"></td>
										<td>Road :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"> </td>
									</tr>
									<tr>
										<td> Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $pincode; ?>" ></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td colspan="4"><strong>Address of the enterprise at which supply is required </strong> 	</td>
									</tr>
									<tr>
										<td>Street Name 1 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1 ?>"></td>
										<td>Street Name 2 :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"> </td>
									</tr>
									<tr>
										<td> Pin :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_pincode; ?>" ></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td>Existing/ Nearest Consumer Number :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" maxlength="11" required="required" placeholder="Please enter 11 digit Consumer No." name="exist_con_no" id="exist_con_no" value="<?php echo $exist_con_no; ?>" >
										<span id="wrong_esd" class="text-danger"></span>
										</td>
										<td>Electrical Sub Station :</td>
										<td><input type="text" class="form-control text-uppercase" readonly="readonly" name="esd" id="esd"  value="<?php echo $esd; ?>"></td>
									</tr>
									<tr>
										<td><strong>Billing Details :</strong> </td>
										<td colspan="3">
											<input type="radio" name="billing_details" value="A" /> same as applicant address
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="billing_details" value="E" /> same as enterprise address
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="billing_details" value="O" /> Other
										</td>
									</tr>
									<tr>
										<td>Street Name 1 :</td>
										<td><input type="text" class="form-control text-uppercase" name="billing[sn1]" id="hno" placeholder=" Street Name 1" value="<?php echo $billing_sn1 ?>"></td>
										<td>Street Name 2 :</td>
										<td><input type="text" class="form-control text-uppercase" name="billing[sn2]" id="road" placeholder=" Street Name 2" value="<?php echo $billing_sn2; ?>"></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase" name="billing[town]" id="town" placeholder=" town / village " value="<?php echo $billing_town; ?>"></td>
										<td>District :</td>
										<td>
									    <?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
										<select name="billing[d]" id="district" class="form-control text-uppercase"><?php
											while($dstrows=$dstresult->fetch_object()) { 
												if(isset($billing_d) && ($billing_d==$dstrows->district)) $s='selected'; else $s=''; ?>
												<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
											<?php } ?>					
										</select>
								        </td>
								    </tr>
								    <tr>
								        <td> Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="billing[pin]" id="pin" placeholder="6 digit pin" value="<?php echo $billing_pin; ?>"></td>
								        <td> Mobile No.:</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" name="billing[mobile]" id="mobile" placeholder="Please enter 10 digit mobile number" value="<?php echo $billing_mobile; ?>"></td>
									</tr>
									<tr>
										<td>Type of Premises :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $w_l; ?>"></td>
										
									</tr>
									<tr>
										<td>Mouza No.:<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  required="required" name="mouza_no" id="mouza_no" value="<?php if(!empty($mouza_no)) echo $mouza_no; else echo $mouza; ?>"></td>
										<td>Dag No. :<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  required="required" name="dag_no" id="dag_no" value="<?php if(!empty($dag_no)) echo $dag_no; else echo $dagno; ?>"></td>
									</tr>
									<tr>
										<td colspan="4"><strong>List of Documents to be submitted :</strong></td>
									</tr>
									<tr>
										<td colspan="2">For proof of Ownership/Occupancy, Land record details from Land Revenue Department or ownership/occupancy records from Municipal Corporation or Development Authority or Gaon Panchayat is required.<span class="mandatory_field">*</span></td>
										<td>
										<select trigger="FileModal" id="file1" class="file1 form-control" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
										</td>
										<td id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>	
									</tr>
									<tr>
										<td colspan="2">Electrical Test Reports from valid Electrical contractor would required in the case of all applicants.<span class="mandatory_field">*</span></td>
										<td><select trigger="FileModal" class="file2 form-control" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
										<td id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
									</tr>
									<tr>
										<td>Date : </td>
										<td><?php echo $today; ?></td>
										<td>Signature of the Applicant</td>
										<td><input type="text" name="signature" size="40" class="form-control text-uppercase" value="<?php echo $key_person; ?>" id="sign" readonly="readonly" /></td>
									</tr>
									
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1 " value="SAVE" name="save" title="Save " rel="tooltip" >Save &amp Next</button>
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

	$('input[name="billing_details"]').on('change', function(){
		if($(this).val() == 'A'){
			$('#hno').val('<?php echo $street_name1; ?>');		
			$('#road').val('<?php echo $street_name2; ?>');			
			$('#town').val('<?php echo $vill; ?>');			
			$('#district').val('<?php echo $dist; ?>');			
			$('#pin').val('<?php echo $pincode; ?>');		
			$('#mobile').val('<?php echo $mobile_no; ?>');		
		}else if($(this).val() == 'E'){
			$('#hno').val('<?php echo $b_street_name1; ?>');	
			$('#road').val('<?php echo $b_street_name2; ?>');			
			$('#town').val('<?php echo $b_vill; ?>');			
			$('#district').val('<?php echo $b_dist; ?>');			
			$('#pin').val('<?php echo $b_pincode; ?>');
			$('#mobile').val('<?php echo $b_mobile_no; ?>');
		}else{
			$('#hno').val('');
			$('#road').val('');			
			$('#town').val('');			
			$('#district').val('');			
			$('#pin').val('');
			$('#mobile').val('');
		}
	});
	$('#exist_con_no').change(function(){
		var specials=/\d{11}/;		
        var exist_con_no=$(this).val();
		var pattern = new RegExp(specials);
		var res = pattern.exec(exist_con_no);
		
		if(exist_con_no.length != 11 || res == null){
			$("#wrong_esd").html("Please enter 11 digit consumer number. ");
			$("#exist_con_no").focus();
			$('#esd').val("");
		}else{
			$("#wrong_esd").html("");
			$('#esd').val("");
			
			$.ajax({ 
				type: 'GET',
				url: '../../../ajax/power_esd.php', 
				data: { exist_con_no: exist_con_no},
				beforeSend:function(){
					$("#esd").html("Loading..");
				},
				success:function(data){
					if(data==false){
						$("#esd").val("To be allocated.");
					}else{
						$("#esd").val(data);
					}                
				},
				error:function(){ }
			}); //ajax end
		}		
    });
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	//$('required_power').on({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$("#consumer_category").attr("readonly","readonly");
	$("#consumer_category option[value='LT Commercial']").hide();
	$("#consumer_category option[value='LT General Purpose']").hide();
	$("#consumer_category option[value='LT Small Industries']").hide();
	$("#consumer_category option[value='HT Industries I']").hide();
	$("#consumer_category option[value='HT Industries II']").hide();
	$("#consumer_category option[value='HT Small Industries']").hide();
	$('input[name="required_power"]').on('change', function(){
		$("#consumer_category").removeAttr("readonly","readonly");
		var value=$(this).val();
		if(value < 20){			
			$("#consumer_category option[value='HT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").hide();	
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='LT Commercial']").show();
			$("#consumer_category option[value='LT General Purpose']").show();
			$("#consumer_category option[value='LT Small Industries']").show();				
		}else if(value > 20 && value < 40){
			$("#consumer_category option[value='HT Small Industries']").show();
			$("#consumer_category option[value='HT Industries I']").hide();	
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();			
		}else if(value > 40 && value < 120){
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").show();
			$("#consumer_category option[value='HT Industries II']").hide();
			$("#consumer_category option[value='HT Small Industries']").hide();
		}else if(value > 120){
			$("#consumer_category option[value='LT Commercial']").hide();
			$("#consumer_category option[value='LT General Purpose']").hide();
			$("#consumer_category option[value='LT Small Industries']").hide();
			$("#consumer_category option[value='HT Industries I']").hide();
			$("#consumer_category option[value='HT Industries II']").show();
			$("#consumer_category option[value='HT Small Industries']").hide();
		}else{
			$("#consumer_category").attr("readonly","readonly");
		}
	});
	/*
	UPTO 20 kw - Commercial or General Purpose or Small Industries
	20<value<40 -- HT Small Industries
	40-120 --- HT Industries I
	120 KW - above - HT Industries II 
	*/
</script>
</body>
</html>