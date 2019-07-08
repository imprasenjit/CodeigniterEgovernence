<?php  require_once "../../requires/login_session.php"; 
$dept="boiler";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;// For reccuring form fill ups

if($q->num_rows>0){		 
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$boiler_location=$results['boiler_location'];$reg_no=$results['reg_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$boiler_type=$results['boiler_type'];$heating_value=$results['heating_value'];$safety_valves=$results['safety_valves'];$caliberation_date =$results['caliberation_date'];$boiler_interior  =$results['boiler_interior'];$boiler_engr_name  =$results['boiler_engr_name'];$certificate_no=$results['certificate_no'];$tentative_date=$results['tentative_date'];
	
	if(!empty($results["boiler_type"])){
		$boiler_type=json_decode($results["boiler_type"]);
		if(isset($boiler_type->a)) $boiler_type_a=$boiler_type->a;
		else $boiler_type_a="";
		if(isset($boiler_type->b)) $boiler_type_b=$boiler_type->b;
		else $boiler_type_b="";
		if($boiler_type_a=="U") $boiler_type_b="WT";
	}else{
		$boiler_type_a="";$boiler_type_b="";
	}
}else{	
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$boiler_location=$results['boiler_location'];$reg_no=$results['reg_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$boiler_type=$results['boiler_type'];$heating_value=$results['heating_value'];$safety_valves=$results['safety_valves'];$caliberation_date =$results['caliberation_date'];$boiler_interior  =$results['boiler_interior'];$boiler_engr_name  =$results['boiler_engr_name'];$certificate_no=$results['certificate_no'];$tentative_date=$results['tentative_date'];
		
		if(!empty($results["boiler_type"])){
			$boiler_type=json_decode($results["boiler_type"]);
			if(isset($boiler_type->a)) $boiler_type_a=$boiler_type->a;
			else $boiler_type_a="";
			if(isset($boiler_type->b)) $boiler_type_b=$boiler_type->b;
			else $boiler_type_b="";
			if($boiler_type_a=="U") $boiler_type_b="WT";
		}else{
			$boiler_type_a="";$boiler_type_b="";
		}	
	}else{
		$boiler_owner="";$street_name1="";$street_name2="";$owner_vill="";$owner_dist="";$owner_pin="";$owner_mobile=""; $owner_email="";$boiler_location="";$reg_no="";$manu_name="";$manu_year="";$boiler_type="";$heating_value="";$safety_valves="";  $caliberation_date ="";  $boiler_interior ="";  $boiler_engr_name ="";$certificate_no ="";  $tentative_date="";  $boiler_type_a="";$boiler_type_b="";		
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
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
						   <div class="panel-body">
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform2" id="myform2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table  class="table table-responsive">									
											<tr>
												<td colspan="4">To<br/>
												&nbsp;&nbsp;&nbsp;&nbsp;The Chief Inspector Of Boilers, Assam,<br/>&nbsp;&nbsp;&nbsp;&nbsp;Lalmati, Guwahati-29</td>
											</tr>
											<tr>
												<td width="25%">1. (a) Name of Boiler Owner :</td>
												<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
													 <td colspan="4"> (b) Address of Boiler Owner :</td>
											</tr>
											<tr>
												<td>Street name 1 :</td>
												<td><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
												<td>Street name 2 :</td>
												<td><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Village/Town :</td>
												<td><input type="text" disabled value="<?php echo $b_vill; ?>" class="form-control text-uppercase"></td>
												<td>District :</td>
												<td><input type="text" disabled value="<?php echo $b_dist; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>Pin code :</td>
												<td><input type="text" disabled value="<?php echo $b_pincode; ?>" class="form-control text-uppercase"></td>
												<td>Mobile No. :</td>
												<td><input  type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control"></td>
											</tr>
											<tr>
												<td>E-mail id:</td>
												<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>2. Location of the Boiler :<br/>(Whether Boiler to be installed) </td>
												<td><textarea  name="boiler_location"  class="form-control text-uppercase" maxlength="255"><?php echo $boiler_location; ?></textarea></td>
											   <td>3. Registration no. of the Boiler :</td>
											   <td><input type="text" name="reg_no" value="<?php echo $reg_no; ?>" maxlength="30" 	class="form-control text-uppercase"></td>
											</tr>
											<tr>
											   <td>4. Name of the Manufacturer :<span class="mandatory_field">*</span></td></td>
											   <td><input type="text" required name="manu_name" value="<?php echo $manu_name; ?>" 	class="form-control text-uppercase"></td>
												<td>5. Year of Manufacture :<span class="mandatory_field">*</span></td></td>
												<td><input type="number" name="manu_year" min="1947" max="2020" required placeholder="YYYY" value="<?php echo $manu_year; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>6. Type of the Boiler :</td>
												<td>
												<label class="radio-inline"><input type="radio" id="boiler_type_a" name="boiler_type[a]" <?php if($boiler_type_a=="F" || $boiler_type_a=="") echo "checked"; ?> value="F"> Fired  </label>
												<label class="radio-inline"><input type="radio" <?php if($boiler_type_a=="U") echo "checked"; ?> name="boiler_type[a]" id="boiler_type_a" value="U"> Unfired </label>
												</td>
												
												<td><label class="radio-inline"><input type="radio" id="boiler_type_b" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> name="boiler_type[b]" <?php if($boiler_type_b=="FT" || $boiler_type_b=="") echo "checked"; ?> value="FT"> Fire Tube   </label>
												<label class="radio-inline"><input type="radio" id="boiler_type_b" name="boiler_type[b]" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> <?php if($boiler_type_b=="WT") echo "checked"; ?> value="WT"> Water Tube </label></td>

											</tr>
											<tr>
												<td>7. Heating surface of the Boiler (in Sq. Meter):<span class="mandatory_field">*</span></td>
												<td><input type="text" validate="onlyNumbers" required value="<?php echo $heating_value; ?>" class="form-control text-uppercase" max="9999999999" name="heating_value" id="heating_value"/></span></td>
												<td colspan="2"><span id="heating_select"></span></td>
											</tr>
											<tr>
												<td >8. Inspection fees ( based on heating<br/> surface as shown at website for <br/>the specified slab )</td>
												<td><input type="text" readonly="readonly" id="reg_fees" name="reg_fees" value="" class="form-control text-uppercase" /></td>
												<td>9. Whether safety valves works efficiently:</td>
												<td><input type="text" name="safety_valves" value="<?php echo $safety_valves; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>10. Date of caliberation of pressure gauge:</td>
												<td><input type="datetime" name="caliberation_date" value="<?php echo $caliberation_date; ?>" class="dob form-control text-uppercase"></td>
												<td>11. Whether boiler interior cleaned properly:</td>
												<td><input type="text" name="boiler_interior" value="<?php echo $boiler_interior; ?>" class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td colspan="4">12. Name of the boiler attendant/boiler operation engineer and their certificate number :</td>
											</tr>
											<tr>
												<td>Full name :</td>
												<td><input type="text" name="boiler_engr_name"class="form-control text-uppercase"  value="<?php echo $boiler_engr_name; ?>"></td>
												<td>Certificate No.  :</td>
												<td><input type="text"  name="certificate_no" value="<?php echo $certificate_no; ?>"class="form-control text-uppercase"></td>
											</tr>
											<tr>
												<td>13. Tentative Date of Inspection :</td>
												<td><input type="datetime" name="tentative_date" value="<?php echo $tentative_date; ?>" class="dob form-control text-uppercase"></td>
												<td></td>
												<td></td>
											</tr>
											<tr >
											   <td>Date:</td>
											   <td class="text-uppercase"><strong><?php echo date('d-m-Y',strtotime($today));?></strong></td>
											   <td>Signature of the Authorised Signatory:</td>
											   <td class="text-uppercase"><strong><?php echo $key_person; ?></strong></td>
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
				</div>
				</section>
			</div>
			<!-- /.content-wrapper -->
		<?php require_once "../../../views/users/requires/footer.php";  ?>
    <?php require '../../requires/js.php' ?>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$(document).ready(function(){	
	$('input[id="boiler_type_a"]').on('change', function(){
		if($(this).val() == 'U'){
			$('input[value="WT"]').prop('checked', true);
			$('input[id="boiler_type_b"]').attr('disabled', 'disabled');
		}else{
			$('input[value="WT"]').prop('checked', '');
			$('input[id="boiler_type_b"]').attr('disabled', false);
		}
	});
	var heating_value=$('input[name="heating_value"]').val();
	$.ajax({ 
		type: 'POST',
		url: 'fees_calculation.php', 
		data: { heating_value: heating_value, form : 2 },
		beforeSend:function(){
			$("#heating_select").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
			$('input[id="reg_fees"]').val("");
		},
		success:function(res){ 	//alert(res);
			var valNew=res.split('//');
			
			if(valNew[0] != ""){
				$('input[id="reg_fees"]').val(valNew[0]);
				
				$("#heating_select").html(valNew[1]);							
			}else{							
				$('input[id="reg_fees"]').val("");
				$("#heating_select").html("Not Found !!");
			} 
		},
		error:function(){}
	});
	
	
	$('input[name="heating_value"]').on('change', function(){
		var heating_value=$(this).val();
		$.ajax({ 
			type: 'POST',
			url: 'fees_calculation.php', 
			data: { heating_value: heating_value, form : 2 },
			beforeSend:function(){
				$("#heating_select").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
				$('input[id="reg_fees"]').val("");
			},
			success:function(res){ 	//alert(res);
				var valNew=res.split('//');
				
				if(valNew[0] != ""){
					$('input[id="reg_fees"]').val(valNew[0]);
					
					$("#heating_select").html(valNew[1]);							
				}else{							
					$('input[id="reg_fees"]').val("");
					$("#heating_select").html("Not Found !!");
				} 
			},
			error:function(){}
		});
	});
		
});   
$('input[name="boiler_owner"]').on('change', function(){
	if($(this).val() != 'undefined')
	$('input[name="signature"]').val($(this).val());			
});
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
	
	/* ----------------------------------------------------- */
</script>