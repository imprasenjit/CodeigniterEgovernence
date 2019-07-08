<?php  require_once "../../requires/login_session.php";
$dept="power";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form_new.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){		
	 $p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") or die($power->error);
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$exist_con_no=$results["exist_con_no"];$esd=$results["esd"];
			$applicant_name=$results["applicant_name"];$organization_name=$results["organization_name"];
			$category_tariff=$results["category_tariff"];$voltage_supply=$results["voltage_supply"];$total_load=$results["total_load"];$is_capacity=$results["is_capacity"];$capacity_details=$results["capacity_details"];$is_industry=$results["is_industry"];$industry_details=$results["industry_details"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$is_director=$results["is_director"];$details_director=$results["details_director"];
			
			if(!empty($results["consumer"])){
			$consumer=json_decode($results["consumer"]);
			$consumer_num=$consumer->num;$consumer_name=$consumer->name;
		   }else{
				$consumer_num="";$consumer_name="";
		   }
			
			if(!empty($results["existing"])){
				$existing=json_decode($results["existing"]);
				$existing_metno=$existing->metno;$existing_category=$existing->category;
			}else{
				$existing_metno="";$existing_category="";
			}
			
			if(!empty($results["contract_demand"])){
				$contract_demand=json_decode($results["contract_demand"]);
				$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
			}else{
				$contract_demand_num="";$contract_demand_unit="";
			}
		
		}else{
			$form_id="";
			$exist_con_no="";$esd="";
			$applicant_name="";$organization_name="";$voltage_supply="";$category_tariff="";$consumer_num="";$consumer_name="";$existing_metno="";$existing_category="";		
			$total_load="";$premises_postofc="";$is_capacity="";$capacity_details="";$is_industry="";$industry_details="";$is_electricity="";$details_electricity="";$is_connection="";
		    $details_connection="";$is_director="";$details_director="";$proposed_distance="";$road_crossing="";$nos_road="";$is_road_crossing="";$details_crossing="";
		 }
	}else{			
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$exist_con_no=$results["exist_con_no"];$esd=$results["esd"];
		$applicant_name=$results["applicant_name"];$organization_name=$results["organization_name"];
		$category_tariff=$results["category_tariff"];$voltage_supply=$results["voltage_supply"];$total_load=$results["total_load"];$is_capacity=$results["is_capacity"];$capacity_details=$results["capacity_details"];$is_industry=$results["is_industry"];$industry_details=$results["industry_details"];$is_electricity=$results["is_electricity"];$details_electricity=$results["details_electricity"];$is_connection=$results["is_connection"];$details_connection=$results["details_connection"];$is_director=$results["is_director"];$details_director=$results["details_director"];
		
		if(!empty($results["consumer"])){
			$consumer=json_decode($results["consumer"]);
			$consumer_num=$consumer->num;$consumer_name=$consumer->name;
		}else{
			$consumer_num="";$consumer_name="";
		}
		
		 
			if(!empty($results["existing"])){
				$existing=json_decode($results["existing"]);
				$existing_metno=$existing->metno;$existing_category=$existing->category;
			}else{
				$existing_metno="";$existing_category="";
			}
		
		if(!empty($results["contract_demand"])){
			$contract_demand=json_decode($results["contract_demand"]);
			$contract_demand_num=$contract_demand->num;$contract_demand_unit=$contract_demand->unit;
		}else{
			$contract_demand_num="";$contract_demand_unit="";
		}
		
	}
	
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2=""; 
	if($showtab=="" || $showtab<2 || $showtab>3 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2=""; 
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active"; 
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
<?php include ("".$table_name."_addmore.php"); ?>
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
							<div>
								
								<div>
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								 <table id="" class="table table-responsive">
								    <tr>
									    <td colspan="4">Sir<br/>&nbsp;&nbsp;I / We, request you to kindly allow the changes requested against my / our premises as given  above. The requisite information is furnished below:</td>
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
										<td width="25%">1. Name of Applicant:</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyLetters" name="applicant_name"  value="<?php echo $applicant_name; ?>"/></td>
										<td width="25%">2.Name of Father / Husband / Organisation (with designation):</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="organization_name"><?php echo $organization_name; ?></textarea></td>
									</tr>
									<tr>
									   <td>3.Full Address of the Premises where the connection has been installed :</td>
									</tr>
									<tr>
										<td>House No. /Plot No:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1 ?>"></td>
										<td>Road:</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>" ></td>
									</tr>
									<tr>
										<td>Town/Village :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_vill; ?>"></td>
										<td>District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"> </td>
									</tr>
									<tr>
										<td>Pin :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_pincode; ?>" ></td>
										<td>Mobile No. :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_mobile_no; ?>" ></td>
									</tr>
									<tr>
										<td>Email :</td>
										<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $b_email; ?>" ></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">4. Consumer Number and Name of the Existing Connection :</td>
									</tr>
									<tr>
									   <td>Consumer Number :</td>
										<td><input type="text" class="form-control text-uppercase" name="consumer[num]" value="<?php echo $consumer_num ?>"></td>
										<td>Consumer Name</td>
										<td><input type="text" class="form-control text-uppercase" name="consumer[name]" value="<?php echo $consumer_name ?>"></td>
									</tr>
									<tr>
									  <td colspan="4">5. Existing Meter Number & Category of the consumer</td>
									</tr>
									<tr>
										<td>Existing Meter Number</td>
										<td><input type="text" class="form-control text-uppercase" name="existing[metno]" value="<?php echo $existing_metno ?>"></td>
										<td>Existing Category</td>
										<td><input type="text" class="form-control text-uppercase" name="existing[category]" value="<?php echo $existing_category ?>"></td>
									</tr>
									<tr>
										<td>6. Voltage at which supply is required (KV):</td>
										<td><textarea class="form-control text-uppercase" placeholder="11 KV / 33 KV/ 132 KV / 220 KV" name="voltage_supply"><?php echo $voltage_supply; ?></textarea></td>
										<td>7. Total Connected Load/ Additional Load required (In Kilo-Watts):</td>
										<td><input type="text" class="form-control text-uppercase" name="total_load" value="<?php echo $total_load ?>"></td>
									</tr>
									<tr>
										<td colspan="4">8.Phasing of Contract Demand:
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<tr>
													<th width="20%">Slno</th>
													<th width="25%">CD Required (KVA)</th>
													<th width="25%">Tentative Date from which required</th>
													<th width="30%">Remarks</th>
												</tr>
												<?php
													$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["cd_reqd"]; ?>" validate="letters" name="txtB<?php echo $count;?>" ></td>
															<td><input value="<?php echo $row_1["tentative_dt"]; ?>" id="txtC<?php echo $count;?>"  class="dob form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["remarks"]; ?>" id="txtD<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" class="form-control text-uppercase" name="txtB1" validate="letters"></td>
														<td><input id="txtC1" size="10"   class="dob form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10" class="form-control text-uppercase" name="txtD1"></td>
													</tr>
													<?php } ?>														
												</table>
											</td>
									 </tr>
									 <tr>
										<td colspan="4">													
											<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
											<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
										</td>
								 </tr>
								 <tr>
									<td>9. Category of tariff opted for :</td>
									<td><input type="text" class="form-control text-uppercase" name="category_tariff" value="<?php echo $category_tariff ?>"></td>
								 </tr>
								 <tr>
									   <td>10. Production Capacity (If applicable) :</td>
										<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_capacity=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_capacity" required="required"> Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($is_capacity=='N' || $is_capacity=='') echo 'checked'; ?> id="inlineRadio1" name="is_capacity"> No </label></td>
									   <td>If applicable </td>
									   <td><textarea type="text"  name="capacity_details" placeholder="KVA" id="capacity_details" <?php if($is_capacity == 'N' || $is_capacity == '' ) echo 'disabled="disabled"'; ?> class="capacity_details form-control text-uppercase"/><?php echo $capacity_details; ?></textarea></td>
								 </tr>
								 <tr>
									   <td>11. Category of Industry (If applicable) :</td>
										<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_industry=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_industry" required="required"> Yes </label>
										<label class="radio-inline"><input type="radio" value="N" <?php if($is_industry=='N' || $is_industry=='') echo 'checked'; ?> id="inlineRadio1" name="is_industry"> No </label></td>
									   <td>If applicable </td>
									   <td><textarea type="text"  name="industry_details" placeholder="HT Small / HT-I / HT-II (Option-1) / HT-II (Option-2)" id="industry_details" <?php if($is_industry == 'N' || $is_industry == '' ) echo 'disabled="disabled"'; ?> class="industry_details form-control text-uppercase"/><?php echo $industry_details; ?></textarea></td>
								 </tr>
								 <tr>
									<td>12. Any Electricity dues outstanding in APDCL's area of operation in the Consumer's name:  </td>
									<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_electricity=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_electricity" > Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_electricity=='N' || $is_electricity=='') echo 'checked'; ?> id="inlineRadio1" name="is_electricity"> No </label></td>
									 <td>Give Details :</td>
									 <td><textarea type="text"  name="details_electricity" id="details_electricity" <?php if($is_electricity == 'N' || $is_electricity == '' ) echo 'disabled="disabled"'; ?> class="details_electricity form-control text-uppercase"/><?php echo $details_electricity; ?></textarea></td>
								</tr>
								<tr>
									<td>13. Any Electricity dues outstanding for the premises for which connection applied for: </td>
									<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_connection=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_connection" > Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_connection=='N' || $is_connection=='') echo 'checked'; ?> id="inlineRadio1" name="is_connection"> No </label></td>
									 <td>Give Details :</td>
									 <td><textarea type="text"  name="details_connection" id="details_connection" <?php if($is_connection == 'N' || $is_connection == '' ) echo 'disabled="disabled"'; ?> class="details_connection form-control text-uppercase"/><?php echo $details_connection; ?></textarea></td>
								</tr>
								<tr>
									<td>14. Any Electricity dues outstanding with the Licensee against any firm with which the consumer is  associated with any firm as an owner, Partner, Director or Managing Director: </td>
									<td><label class="radio-inline"><input type="radio" value="Y" <?php if($is_director=='Y') echo 'checked'; ?> id="inlineRadio1" name="is_director" > Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_director=='N' || $is_director=='') echo 'checked'; ?> id="inlineRadio1" name="is_director"> No </label></td>
									<td>Give Details :</td>
									<td><textarea type="text"  name="details_director" id="details_director" <?php if($is_director == 'N' || $is_director == '' ) echo 'disabled="disabled"'; ?> class="details_director form-control text-uppercase"/><?php echo $details_director; ?></textarea></td>
								</tr>
								
								<tr>
									<td>Date :<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
									<td align="right" colspan="3">Signature of the consumer / authorised signatory : <strong><?php echo $key_person; ?></strong></td>
								</tr>
								<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	
	
	$('input[name="is_capacity"]').on('change', function(){
		if($(this).val() == 'N')
			$('#capacity_details').attr('disabled', 'disabled');
		else
			$('#capacity_details').removeAttr('disabled');
	});
	
	$('input[name="is_industry"]').on('change', function(){
		if($(this).val() == 'N')
			$('#industry_details').attr('disabled', 'disabled');
		else
			$('#industry_details').removeAttr('disabled');
	});
	
	$('input[name="is_electricity"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_electricity').attr('disabled', 'disabled');
		else
			$('#details_electricity').removeAttr('disabled');
	});
	
	$('input[name="is_connection"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_connection').attr('disabled', 'disabled');
		else
			$('#details_connection').removeAttr('disabled');
	});
	
	$('input[name="is_director"]').on('change', function(){
		if($(this).val() == 'N')
			$('#details_director').attr('disabled', 'disabled');
		else
			$('#details_director').removeAttr('disabled');
	});
</script>
