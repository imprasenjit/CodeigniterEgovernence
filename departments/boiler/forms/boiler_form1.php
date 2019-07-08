<?php  require_once "../../requires/login_session.php";
$dept="boiler";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' ORDER BY form_id DESC LIMIT 1") ;// For reccuring form fill ups
	
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$boiler_location=$results['boiler_location'];$maker_no=$results['maker_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$heating_value=$results['heating_value'];$offering_insp_date=$results['offering_insp_date'];$is_fabrication=$results['is_fabrication'];
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
			$boiler_location=$results['boiler_location'];$maker_no=$results['maker_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$heating_value=$results['heating_value'];$offering_insp_date=$results['offering_insp_date'];$is_fabrication=$results['is_fabrication'];
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
			$boiler_owner="";$street_name1="";$street_name2="";$owner_vill="";$owner_dist="";$owner_pin="";$owner_mobile="";$owner_email="";$boiler_location="";$maker_no="";$manu_name="";$manu_year="";$offering_insp_date="";$heating_value="";$boiler_status=""; $is_fabrication="";$boiler_type_a="";$boiler_type_b="";
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
							<h4 class="text-center">
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td colspan="4">To, <br/>
											&nbsp;&nbsp;&nbsp;&nbsp;The Chief Inspector of Boilers, Assam,<br/>&nbsp;&nbsp;&nbsp;&nbsp;Lalmati, Guwahati-29</td>
										</tr>
										<tr>
											<td width="25%">1. (a) Name of Boiler Owner : 
											<td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $unit_name; ?>" class="form-control text-uppercase"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td colspan="4"> (b) Address of Boiler Owner : </td>
										</tr>
										<tr>
											<td width="25%">Street name 1 :</td>
											<td width="25%"><input type="text" disabled value="<?php echo $b_street_name1; ?>" class="form-control text-uppercase"></td>
											<td width="25%">Street name 2 :</td>
											<td width="25%"><input type="text" disabled value="<?php echo $b_street_name2; ?>" class="form-control text-uppercase"></td>	
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
											<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$b_mobile_no; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>E-mail id :</td>
											<td><input type="text" disabled value="<?php echo $b_email; ?>" class="form-control"></td>
											<td></td>
											<td></td>									
										</tr>
										<tr>
											<td>2. Location of the Boiler :<br/>Whether Boiler to be installed </td>
											<td><textarea  name="boiler_location" class="form-control text-uppercase" validate="textarea" maxlength="255"><?php echo $boiler_location; ?></textarea>255 Characters Only</td>
											<td>3. Maker's no. of the Boiler :</td>
											<td><input type="text"  name="maker_no" value="<?php echo $maker_no; ?>" class="form-control text-uppercase"></td>
										</tr>
										<tr>								   
											<td>4. Name of the manufacturer : <span class="mandatory_field">*</span></td>
											<td><input type="text" name="manu_name" value="<?php echo $manu_name; ?>" required class="form-control text-uppercase"></td>
											<td>5. Year of manufacture : <span class="mandatory_field">*</span></td>
											<td><input type="number" name="manu_year" min="1900" max="3000" required placeholder="YYYY" value="<?php echo $manu_year; ?>" class="form-control"></td>
										</tr>
										<tr>
											<td>6. Type of the Boiler :</td>
											<td>
												<label class="radio-inline"><input type="radio" id="boiler_type_a" name="boiler_type[a]" <?php if($boiler_type_a=="F" || $boiler_type_a=="") echo "checked"; ?> value="F"> Fired  </label>
												<label class="radio-inline"><input type="radio" <?php if($boiler_type_a=="U") echo "checked"; ?> name="boiler_type[a]" id="boiler_type_a" value="U"> Unfired </label>
											</td>									
											<td>
												<label class="radio-inline"><input type="radio" id="boiler_type_b" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> name="boiler_type[b]" <?php if($boiler_type_b=="FT" || $boiler_type_b=="") echo "checked"; ?> value="FT"> Fire Tube   </label>
												<label class="radio-inline"><input type="radio" id="boiler_type_b" name="boiler_type[b]" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> <?php if($boiler_type_b=="WT") echo "checked"; ?> value="WT"> Water Tube </label>
											</td>
										</tr>
										<tr>
											<td>7. Heating surface of the Boiler (in Sq. Meter):<span class="mandatory_field">*</span></td>
											<td><input type="text" validate="onlyNumbers" required value="<?php echo $heating_value; ?>" class="form-control text-uppercase" max="9999999999" name="heating_value" id="heating_value"/></span> 				
											</div></td>
											<td colspan="2"><span id="heating_select"></span></td>
										</tr>
										<tr>
											<td colspan="2">8. Registration fees( One time for packaged Boiler and four times for Site Fabricated Boiler as displayed in the website for the specified slab of the heating surface )</td>
											<td><input type="text" readonly="readonly" id="reg_fees" name="reg_fees" value="" class="form-control" /></td>
											<td></td>								  
										</tr>
										<tr>
											<td>Fabrication at site is required ? </td>
											<td><label class="radio-inline"><input type="radio" name="is_fabrication" id="is_fabrication_y" <?php if($is_fabrication=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" class="radio-inline" name="is_fabrication" <?php if($is_fabrication=="N" || $is_fabrication=="") echo "checked"; ?> id="is_fabrication_n" value="N"/> No</label></td>
											<td></td>
											<td></td>
										</tr>
										<tr>									
											<td>9. Tentative date of offering inspection :</td>
											<td><input type="text" name="offering_insp_date" value="<?php echo $offering_insp_date; ?>" class=" dob form-control"></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>Date:</td>
											<td><input type="datetime" value="<?php echo date('d-m-Y',strtotime($today)); ?>" class="form-control" disabled></td>
											<td>Signature of the Authorised Signatory</td>
											<td><input type="text" value="<?php echo strtoupper($key_person); ?>" class="form-control" disabled></td>
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
			data: { heating_value: heating_value, form : 1 },
			beforeSend:function(){
				$("#heating_select").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
				$('input[id="reg_fees"]').val("");
			},
			success:function(res){ 	//alert(res);
				var valNew=res.split('//');
				
				if(valNew[0] != ""){
					$('input[id="reg_fees"]').val(valNew[0]);
					if($("input[name='is_fabrication']:checked"). val()=="Y"){
						newValue = valNew[0]*4;
						$('input[id="reg_fees"]').val(newValue);
					}
					
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
				data: { heating_value: heating_value, form : 1 },
				beforeSend:function(){
					$("#heating_select").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
					$('input[id="reg_fees"]').val("");
				},
				success:function(res){ 	//alert(res);
					var valNew=res.split('//');
					
					if(valNew[0] != ""){
						$('input[id="reg_fees"]').val(valNew[0]);
						if($("input[name='is_fabrication']:checked"). val()=="Y"){
							newValue = valNew[0]*4;
							$('input[id="reg_fees"]').val(newValue);
						}
						
						$("#heating_select").html(valNew[1]);							
					}else{							
						$('input[id="reg_fees"]').val("");
						$("#heating_select").html("Not Found !!");
					} 
				},
				error:function(){}
			});
		});
		
		$('input[name="is_fabrication"]').on('change', function(){				
			var heating_value=$('input[name="heating_value"]').val();
			var is_fabrication=$(this).val();
			$.ajax({ 
				type: 'POST',
				url: 'fees_calculation.php', 
				data: { heating_value: heating_value, form : 1 },
				beforeSend:function(){
					$("#heating_select").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
					$('input[id="reg_fees"]').val("");
				},
				success:function(res){ 	//alert(res);
					var valNew=res.split('//');
					
					if(valNew[0] != ""){
						$('input[id="reg_fees"]').val(valNew[0]);
						if(is_fabrication=="Y"){
							newValue = valNew[0]*4;
							$('input[id="reg_fees"]').val(newValue);
						}
						
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
	
	/* ----------------------------------------------------- */
</script>