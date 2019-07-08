<?php  require_once "../../requires/login_session.php";
$dept="power";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){		
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$required_power=$results["required_power"];
			$service_requested=$results["service_requested"];
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
		}else{
			$consumer_category="";$service_requested="";$supply_type="";$exist_con_no="";			
			$billing_sn1="";$billing_sn2="";$billing_town="";$billing_po="";$billing_d="";$billing_pin="";$billing_mobile="";		
			$mouza_no="";$dag_no="";$esd="";
			$request_load="";$required_power="";
		}
	}else{			
		$results=$q->fetch_assoc();
		$required_power=$results["required_power"];
		$service_requested=$results["service_requested"];
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
							</h4>		
							</div>
							<div class="panel-body">
								<form name="form1" id="form1" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="tab1" class="table table-responsive">
									<tr>
										<td colspan="4"><strong>General Information</strong></td>
									</tr>
									<tr>
										<td width="25%">Required Power (in KW) : <span class="mandatory_field">*</span></td>
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
										<td width="25%">Consumer Category : <span class="mandatory_field">*</span></td>
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
										<td>Service Requested : <span class="mandatory_field">*</span></td>
										<td>
										<select class="form-control text-uppercase" required="required" name="service_requested" id="service_requested">
											<option <?php if($service_requested=="T") echo "selected";?> value="T">New Connection(Temporary)</option>
											<option <?php if($service_requested=="P") echo "selected";?> value="P">New Connection(Permanent)</option>
										    
										</select></td>
									</tr>
									<tr>
										<td>Company Name :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_name" id="applicant_name"  disabled="disabled"  value="<?php echo $unit_name; ?>"/></td>
										<td>Name of the Applicant :</td>
										<td><input type="text" class="form-control text-uppercase" name="applicant_name" id="applicant_name"  disabled="disabled"  value="<?php echo $key_person; ?>"/></td>									
									</tr>
									<tr>
										<td colspan="4"><strong>Address of the Applicant </strong></td>
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
										<td colspan="4">6. Address of the premises where service connection is applied for:</td>
									</tr>
									<tr>
										<td>House No. /Plot No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1 ?>"></td>
										<td>Road:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Lane:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1 ?>"></td>
										<td>Area/Colony:</td>
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
										<td><input type="text" class="form-control text-uppercase" maxlength="12" required="required" placeholder="Please enter 11 or 12 digit Consumer No." name="exist_con_no" validate="onlyNumbers" id="exist_con_no" value="<?php echo $exist_con_no; ?>" >
										<span id="wrong_esd" class="text-danger"></span>
										</td>
										<td>Electrical Sub Station :</td>
										<td><input type="text" class="form-control text-uppercase" readonly="readonly" name="esd" id="esd"  value="<?php echo $esd; ?>">
										<span id="wrong_ess" class="text-danger"></span>
										</td>
									</tr>
									<tr>
										<td><strong>Billing Details : <span class="mandatory_field">*</span> </td>
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
                                        <td><input type="text" class="form-control text-uppercase" name="billing[d]" id="district" placeholder=" town / village " value="<?php echo $billing_d; ?>"></td>
										
								    </tr>
								    <tr>
								        <td> Pin Code : </td>
										<td><input type="text" class="form-control text-uppercase" validate="pincode" name="billing[pin]" id="pin" placeholder="6 digit pin" value="<?php echo $billing_pin; ?>"></td>
								        <td> Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" name="billing[mobile]" id="mobile" placeholder="Please enter 10 digit mobile number" value="<?php echo $billing_mobile; ?>"></td>
									</tr>
									<tr>
										<td>Type of Premises : <span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $land_status; ?>"></td>
									</tr>
									<tr>
										<td>Mouza No. :</td>
										<td><input type="text" class="form-control text-uppercase"  required="required" name="mouza_no" id="mouza_no" value="<?php if(!empty($mouza_no)) echo $mouza_no; else echo $mouza; ?>"></td>
										<td>Dag No. :</td>
										<td><input type="text" class="form-control text-uppercase"  required="required" name="dag_no" id="dag_no" value="<?php if(!empty($dag_no)) echo $dag_no; else echo $dag_no; ?>"></td>
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
	 <?php require_once "../../../views/users/requires/footer.php";  ?>
<?php require '../../requires/js.php' ?>
<script>
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
	$('#loading_image').hide();
	$('#exist_con_no').change(function(){
		/* 
		var specials=/\d{11,12}/;	
        
		var pattern = new RegExp(specials);
		var res = pattern.exec(exist_con_no); */
		var exist_con_no=$(this).val();
		if((exist_con_no.length != 11 && exist_con_no.length != 12) || res == null){
			$("#wrong_esd").html("Please enter 11 or 12 digit consumer number. ");
			$("#exist_con_no").focus();
			$('#esd').val("");
		}else{
			$("#wrong_esd").html("");
			$('#esd').val("");
			
			$.ajax({ 
				type: 'GET',
				url: '../../../ajax/power_esd.php', 
				data: { exist_con_no: exist_con_no },
				beforeSend:function(){
					$("#esd").html("Loading..");
					$('#loading_image').show();
				},
				success:function(data){
					if(data==false){
						$("#esd").val("To be allocated.");
						alert("Please Note : Online payment can not be done since this Electrical Subdivision does not accept online payment.Kindly go to your nearest electrical subdivision and do the payment. Thank you.");
						$('#loading_image').hide();
					}else{
						$("#esd").val(data);
						alert("Electrical Sub-division : " + data);
						$('#loading_image').hide();
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
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>