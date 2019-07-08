<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="11";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form.php"; 
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$occupier_name=$results['occupier_name'];$situation=$results['situation'];$nature=$results['nature'];$is_expose=$results['is_expose'];$inaccessible=$results['inaccessible'];$exam=$results['exam'];$is_provided=$results['is_provided'];$is_maintain=$results['is_maintain'];$working_pressure=$results['working_pressure'];$certify=$results['certify'];$sign=$results['sign'];$qual=$results['qual'];$address=$results['address'];
		
		if(!empty($results["vessel"])){
			$vessel=json_decode($results["vessel"]);
			$vessel_name=$vessel->name;$vessel_desc=$vessel->desc;$vessel_no=$vessel->no;
		}else{
			$vessel_name="";$vessel_desc="";$vessel_no="";
		}
		if(!empty($results["manuf"])){
			$manuf=json_decode($results["manuf"]);
			$manuf_name=$manuf->name;$manuf_sn1=$manuf->sn1;$manuf_sn2=$manuf->sn2;$manuf_vill=$manuf->vill;$manuf_dist=$manuf->dist;$manuf_pin=$manuf->pin;$manuf_mobile=$manuf->mobile;
		}else{
			$manuf_name="";$manuf_sn1="";$manuf_sn2="";$manuf_vill="";$manuf_dist="";$manuf_pin="";$manuf_mobile="";
		}
		if(!empty($results["particulars"])){
			$particulars=json_decode($results["particulars"]);			
			$particulars_const=$particulars->const;$particulars_walls=$particulars->walls;$particulars_use=$particulars->use;$particulars_pressure=$particulars->pressure;
		}else{
			$particulars_const="";$particulars_walls="";$particulars_use="";$particulars_pressure="";
		}
		if(!empty($results["test"])){
			$test=json_decode($results["test"]);
			$test_dt=$test->dt;$test_pressure=$test->pressure;
		}else{
			$test_dt="";$test_pressure="";
		}
		if(!empty($results["conditions"])){
			$conditions=json_decode($results["conditions"]);
			$conditions_external=$conditions->external;$conditions_internal=$conditions->internal;
		}else{
			$conditions_external="";$conditions_internal="";
		}
		if(!empty($results["safe"])){
			$safe=json_decode($results["safe"]);
			$safe_repair=$safe->repair;$safe_period=$safe->period;$safe_condition=$safe->condition;
		}else{
			$safe_repair="";$safe_period="";$safe_condition="";
		}
		if(!empty($results["pressure"])){
			$pressure=json_decode($results["pressure"]);
			$pressure_before=$pressure->before;$pressure_after=$pressure->after;$pressure_complete=$pressure->complete;
		}else{
			$pressure_before="";$pressure_after="";$pressure_complete="";
		}
		if(!empty($results["employ"])){
			$employ=json_decode($results["employ"]);
			$employ_name=$employ->name;$employ_add=$employ->add;
		}else{
			$employ_name="";$employ_add="";
		}
	}else{
		$form_id="";
		$occupier_name="";$situation="";$nature="";$is_expose="";$inaccessible="";$exam="";$is_provided="";$is_maintain="";$working_pressure="";$certify="";$sign="";$qual="";$address="";
		$vessel_name="";$vessel_desc="";$vessel_no="";
		$manuf_name="";$manuf_sn1="";$manuf_sn2="";$manuf_vill="";$manuf_dist="";$manuf_pin="";$manuf_mobile="";
		$particulars_const="";$particulars_walls="";$particulars_use="";$particulars_pressure="";
		$test_dt="";$test_pressure="";
		$conditions_external="";$conditions_internal="";
		$safe_repair="";$safe_period="";$safe_condition="";
		$pressure_before="";$pressure_after="";$pressure_complete="";
		$employ_name="";$employ_add="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
	$occupier_name=$results['occupier_name'];$situation=$results['situation'];$nature=$results['nature'];$is_expose=$results['is_expose'];$inaccessible=$results['inaccessible'];$exam=$results['exam'];$is_provided=$results['is_provided'];$is_maintain=$results['is_maintain'];$working_pressure=$results['working_pressure'];$certify=$results['certify'];$sign=$results['sign'];$qual=$results['qual'];$address=$results['address'];

	if(!empty($results["vessel"])){
		$vessel=json_decode($results["vessel"]);
		$vessel_name=$vessel->name;$vessel_desc=$vessel->desc;$vessel_no=$vessel->no;
	}else{
		$vessel_name="";$vessel_desc="";$vessel_no="";
	}
	if(!empty($results["manuf"])){
		$manuf=json_decode($results["manuf"]);
		$manuf_name=$manuf->name;$manuf_sn1=$manuf->sn1;$manuf_sn2=$manuf->sn2;$manuf_vill=$manuf->vill;$manuf_dist=$manuf->dist;$manuf_pin=$manuf->pin;$manuf_mobile=$manuf->mobile;
	}else{
		$manuf_name="";$manuf_sn1="";$manuf_sn2="";$manuf_vill="";$manuf_dist="";$manuf_pin="";$manuf_mobile="";
	}
	if(!empty($results["particulars"])){
		$particulars=json_decode($results["particulars"]);			
		$particulars_const=$particulars->const;$particulars_walls=$particulars->walls;$particulars_use=$particulars->use;$particulars_pressure=$particulars->pressure;
	}else{
		$particulars_const="";$particulars_walls="";$particulars_use="";$particulars_pressure="";
	}
	if(!empty($results["test"])){
		$test=json_decode($results["test"]);
		$test_dt=$test->dt;$test_pressure=$test->pressure;
	}else{
		$test_dt="";$test_pressure="";
	}
	if(!empty($results["conditions"])){
		$conditions=json_decode($results["conditions"]);
		$conditions_external=$conditions->external;$conditions_internal=$conditions->internal;
	}else{
		$conditions_external="";$conditions_internal="";
	}
	if(!empty($results["safe"])){
		$safe=json_decode($results["safe"]);
		$safe_repair=$safe->repair;$safe_period=$safe->period;$safe_condition=$safe->condition;
	}else{
		$safe_repair="";$safe_period="";$safe_condition="";
	}
	if(!empty($results["pressure"])){
		$pressure=json_decode($results["pressure"]);
		$pressure_before=$pressure->before;$pressure_after=$pressure->after;$pressure_complete=$pressure->complete;
	}else{
		$pressure_before="";$pressure_after="";$pressure_complete="";
	}
	if(!empty($results["employ"])){
		$employ=json_decode($results["employ"]);
		$employ_name=$employ->name;$employ_add=$employ->add;
	}else{
		$employ_name="";$employ_add="";
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
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">1. Name of occupier (or Factory) : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="occupier_name" value="<?php echo $occupier_name; ?>"></td>
											<td width="25%">2. Situation of factory : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="situation" value="<?php echo $situation; ?>"></td>
										</tr>
										<tr>
											<td>3. Address of the Factory : </td>
											<td><textarea class="form-control text-uppercase" disabled="disabled" ><?php echo $unit_details; ?></textarea></td>	
											<td>4. Name of pressure vessel : </td>
											<td><input type="text" class="form-control text-uppercase" name="vessel[name]" value="<?php echo $vessel_name; ?>"></td>
										</tr>
										<tr>
											<td>5. Description of pressure vessel : </td>
											<td><input type="text" class="form-control text-uppercase" name="vessel[desc]" value="<?php echo $vessel_desc; ?>"></td>
											<td>6. Distinctive number of pressure vessel : </td>
											<td><input type="text" class="form-control text-uppercase" name="vessel[no]" value="<?php echo $vessel_no; ?>"></td>
										</tr>
										<tr>
											<td>7. Name of Manufacturer : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[name]" value="<?php echo $manuf_name; ?>"></td>	
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="4">8. Address of Manufacturer : </td>
										</tr>
										<tr>
											<td>Street Name 1 : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[sn1]" value="<?php echo $manuf_sn1; ?>"></td>
											<td>Street Name 2 : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[sn2]" value="<?php echo $manuf_sn2; ?>"></td>
										</tr>
										<tr>
											<td>Village/Town : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[vill]" value="<?php echo $manuf_vill; ?>"></td>
											<td>District : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[dist]" value="<?php echo $manuf_dist; ?>"></td>
										</tr>
										<tr>
											<td>Pin Code : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[pin]" value="<?php echo $manuf_pin; ?>" validate="pincode" maxlength="6"></td>
											<td>Mobile No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="manuf[mobile]" value="<?php echo $manuf_mobile; ?>" validate="mobileNumber" maxlength="10"></td>
										</tr>										
										<tr>
											<td>9. Nature of process in which it is used : </td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
											<td colspan="2"></td>
										</tr>
										<tr>
											<td colspan="2">10. Particulars of vessel : </td>
										</tr>
										<tr>
											<td>(a) Date of construction : </td>
											<td><input type="date" class="dob form-control" name="particulars[const]" value="<?php echo $particulars_const; ?>"></td>
											<td>(b) Thickness of walls : </td>
											<td><input type="text" class="form-control text-uppercase" name="particulars[walls]" value="<?php echo $particulars_walls; ?>"></td>					
										</tr>
										<tr>
											<td>(c) Date on which the vessel was first taken into use : </td>
											<td><input type="date" class="dob form-control" name="particulars[use]" value="<?php echo $particulars_use; ?>"></td>
											<td>(d) Safe working pressure recommended by the manufacturer (The history should be briefly given, and the examiner should state whether he has seen the last/previous report) : </td>
											<td><textarea class="form-control text-uppercase" name="particulars[pressure]"> <?php echo $particulars_pressure; ?></textarea></td>										
										</tr>										
										<tr>
											<td>11. Date of last hydraulic test (if any) and pressure applied : </td>
											<td><input type="date" class="dob form-control" name="test[dt]" value="<?php echo $test_dt; ?>" placeholder="Date" ></td>
											<td><input type="text" class="form-control text-uppercase" name="test[pressure]" value="<?php echo $test_pressure; ?>" placeholder="Pressure" ></td>
											<td></td>
										</tr>					
										<tr>
											<td colspan="2">12. Is the vessel in open, or otherwise exposed to weather or to damp ? : </td>
											<td colspan="2">
												<label class="radio-inline"><input type="radio" value="O" name="is_expose" <?php if(isset($is_expose) && $is_expose=='O') echo 'checked'; ?> /> In Open </label>
												<label class="radio-inline"><input type="radio" value="W" name="is_expose" <?php if(isset($is_expose) && $is_expose=='W') echo 'checked'; ?>/> Exposed to Weather </label>
												<label class="radio-inline"><input type="radio" value="D" name="is_expose" <?php if(isset($is_expose) && ($is_expose=='D' || $is_expose=='')) echo 'checked'; ?>/> Exposed to Damp </label>
											</td>
										</tr>											
										<tr>
											<td>13. What parts (if any) were inaccessible? : </td>
											<td><input type="text" class="form-control text-uppercase" name="inaccessible" value="<?php echo $inaccessible; ?>"></td>
											<td>14. What examination and tests were made? (Specify pressure if hydraulic test was carried out) : </td>
											<td><textarea class="form-control text-uppercase" name="exam"> <?php echo $exam; ?></textarea></td>	
										</tr>										
										<tr>
											<td colspan="4">15. Condition of vessel (State any defects materially) affecting the safe working pressure or the safe working of the vessel) : </td>
										</tr>
										<tr>
											<td>External : </td>
											<td><input type="text" class="form-control text-uppercase" name="conditions[external]" value="<?php echo $conditions_external; ?>"></td>
											<td>Internal : </td>
											<td><input type="text" class="form-control text-uppercase" name="conditions[internal]" value="<?php echo $conditions_internal; ?>"></td>	
										</tr>
										<tr>
											<td>16. Are the required fittings and appliance provided in accordance with the rules for pressure vessels ? : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_provided" value="Y"  <?php if(isset($is_provided) && $is_provided=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_provided" <?php if(isset($is_provided) && ($is_provided=='N' || $is_provided=='')) echo 'checked'; ?>/> No</label>
											</td>
											<td>17. Are all fittings and appliances properly maintained and in good conditions ? : </td>
											<td>
												<label class="radio-inline"><input type="radio" name="is_maintain" value="Y"  <?php if(isset($is_maintain) && $is_maintain=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" value="N"  name="is_maintain" <?php if(isset($is_maintain) && ($is_maintain=='N' || $is_maintain=='')) echo 'checked'; ?>/> No</label>
											</td>
										</tr>
										<tr>
											<td colspan="4">18. Repairs (if any) required, and period within which they should be executed and other condition which the person making the examination thinks it necessary to specify for securing safe working : </td>
										</tr>
										<tr>
											<td><input type="text" class="form-control text-uppercase" name="safe[repair]" value="<?php echo $safe_repair; ?>" placeholder="Repairs" ></td>
											<td><input type="text" class="form-control text-uppercase" name="safe[period]" value="<?php echo $safe_period; ?>" placeholder="Period" ></td>
											<td><input type="text" class="form-control text-uppercase" name="safe[condition]" value="<?php echo $safe_condition; ?>" placeholder="Other Condition" ></td>
											<td></td>
										</tr>										
										<tr>
											<td colspan="2">19. Safe working pressure, calculated from dimensions and from the thickness and other data ascertained by the present examination, due allowance being made for conditions of working if unusual on exceptionally severe (State minimum thickness of walls measured during the examination) : </td>
											<td colspan="2"><textarea class="form-control text-uppercase" name="working_pressure"> <?php echo $working_pressure; ?></textarea></td>
										</tr>
										<tr>
											<td colspan="4">20. Where repairs affecting the safe working pressure are required, state the working pressure : </td>
										</tr>
										<tr>
											<td>(a) Before the expiration of the period specified in (18) : </td>
											<td><input type="text" class="form-control text-uppercase" name="pressure[before]" value="<?php echo $pressure_before; ?>" ></td>
											<td>(b) After the expiration of such period if the required repairs have not been completed : </td>
											<td><input type="text" class="form-control text-uppercase" name="pressure[after]" value="<?php echo $pressure_after; ?>" ></td>
										</tr>										
										<tr>
											<td>(c) After the completion of the required repairs : </td>
											<td><input type="text" class="form-control text-uppercase" name="pressure[complete]" value="<?php echo $pressure_complete; ?>" ></td>
											<td colspan="2"></td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">I certify that on &nbsp;<input type="text" class="form-control text-uppercase" name="certify" value="<?php echo $certify; ?>">&nbsp; the pressure vessel described above was thoroughly cleaned and (so far as its construction permits) made accessible for thorough examination and for such test as were necessary for thorough examination and that on the said date, I thoroughly examined this pressure vessel, including its fittings, and that the above is a true report of my examination. </td>
										</tr>										
										<tr>
											<td colspan="4">21. If employed by a Company or Association, give name and address : </td>
										</tr>										
										<tr>
											<td>Name : </td>
											<td><input type="text" class="form-control text-uppercase" name="employ[name]" value="<?php echo $employ_name; ?>" ></td>
											<td>Address : </td>
											<td><textarea class="form-control text-uppercase" name="employ[add]"> <?php echo $employ_add; ?></textarea></td>
										</tr>											
										<tr class="form-inline">
											<td colspan="2">Date : <strong><?php echo date('d-m-Y',strtotime($today)); ?></strong></td>
											<td colspan="2" align="right">Signature : &nbsp;<input type="text" class="form-control text-uppercase" name="sign" value="<?php echo $sign; ?>">&nbsp;<br/>Qualification : &nbsp;<input type="text" class="form-control text-uppercase" name="qual" value="<?php echo $qual; ?>">&nbsp;<br/>Address : &nbsp;<textarea class="form-control text-uppercase" name="address"> <?php echo $address; ?></textarea>&nbsp;</td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>