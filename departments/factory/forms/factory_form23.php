<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="23";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form2.php";

	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];
		$system=$results['system'];$transport=$results['transport'];$defects=$results['defects'];$certify_dt=$results['certify_dt'];$sign=$results['sign'];$qual=$results['qual'];$qual=$results['qual'];$address=$results['address'];
		if(!empty($results["hood"])){
			$hood=json_decode($results["hood"]);			
			$hood_serial=$hood->serial;$hood_contaminant=$hood->contaminant;$hood_design=$hood->design;$hood_actual=$hood->actual;$hood_volume=$hood->volume;$hood_pressure=$hood->pressure;
		}else{
			$hood_serial="";$hood_contaminant="";$hood_design="";$hood_actual="";$hood_volume="";$hood_pressure="";
		}
		if(!empty($results["pressure"])){
			$pressure=json_decode($results["pressure"]);
			$pressure_joints=$pressure->joints;$pressure_other=$pressure->other;
		}else{
			$pressure_joints="";$pressure_other="";
		}
		if(!empty($results["device"])){
			$device=json_decode($results["device"]);
			$device_type=$device->type;$device_velocity1=$device->velocity1;$device_velocity2=$device->velocity2;$device_pressure1=$device->pressure1;$device_pressure2=$device->pressure2;
		}else{
			$device_type="";$device_velocity1="";$device_velocity2="";$device_pressure1="";$device_pressure2="";
		}
		if(!empty($results["fan"])){
			$fan=json_decode($results["fan"]);
			$fan_type=$fan->type;$fan_volume=$fan->volume;$fan_pressure=$fan->pressure;$fan_drop=$fan->drop;
		}else{
			$fan_type="";$fan_volume="";$fan_pressure="";$fan_drop="";
		}
		if(!empty($results["motor"])){
			$motor=json_decode($results["motor"]);
			$motor_type=$motor->type;$motor_speed=$motor->speed;
		}else{
			$motor_type="";$motor_speed="";
		}
		if(!empty($results["employ"])){
			$employ=json_decode($results["employ"]);
			$employ_name=$employ->name;$employ_add=$employ->add;
		}else{
			$employ_name="";$employ_add="";
		}
	}else{
		$form_id="";$system="";$transport="";$defects="";$certify_dt="";$sign="";$qual="";$qual="";$address="";
		$hood_serial="";$hood_contaminant="";$hood_design="";$hood_actual="";$hood_volume="";$hood_pressure="";
		$pressure_joints="";$pressure_other="";
		$device_type="";$device_velocity1="";$device_velocity2="";$device_pressure1="";$device_pressure2="";
		$fan_type="";$fan_volume="";$fan_pressure="";$fan_drop="";
		$motor_type="";$motor_speed="";
		$employ_name="";$employ_add="";		
	}
}else{	
	$results=$q->fetch_array();		
	$form_id=$results["form_id"];
	$system=$results['system'];$transport=$results['transport'];$defects=$results['defects'];$certify_dt=$results['certify_dt'];$sign=$results['sign'];$qual=$results['qual'];$qual=$results['qual'];$address=$results['address'];
	if(!empty($results["hood"])){
		$hood=json_decode($results["hood"]);			
		$hood_serial=$hood->serial;$hood_contaminant=$hood->contaminant;$hood_design=$hood->design;$hood_actual=$hood->actual;$hood_volume=$hood->volume;$hood_pressure=$hood->pressure;
	}else{
		$hood_serial="";$hood_contaminant="";$hood_design="";$hood_actual="";$hood_volume="";$hood_pressure="";
	}
	if(!empty($results["pressure"])){
		$pressure=json_decode($results["pressure"]);
		$pressure_joints=$pressure->joints;$pressure_other=$pressure->other;
	}else{
		$pressure_joints="";$pressure_other="";
	}
	if(!empty($results["device"])){
		$device=json_decode($results["device"]);
		$device_type=$device->type;$device_velocity1=$device->velocity1;$device_velocity2=$device->velocity1;$device_pressure1=$device->pressure1;$device_pressure2=$device->pressure2;
	}else{
		$device_type="";$device_velocity1="";$device_velocity2="";$device_pressure1="";$device_pressure2="";
	}
	if(!empty($results["fan"])){
		$fan=json_decode($results["fan"]);
		$fan_type=$fan->type;$fan_volume=$fan->volume;$fan_pressure=$fan->pressure;$fan_drop=$fan->drop;
	}else{
		$fan_type="";$fan_volume="";$fan_pressure="";$fan_drop="";
	}
	if(!empty($results["motor"])){
		$motor=json_decode($results["motor"]);
		$motor_type=$motor->type;$motor_speed=$motor->speed;
	}else{
		$motor_type="";$motor_speed="";
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
											<td width="25%">1. Description of system : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" name="system" value="<?php echo  $system; ?>"></td>
											<td width="25%"></td>
											<td width="25%"></td>							
										</tr>
										<tr>
											<td colspan="4">2. Hood : </td>
										</tr>
										<tr>
											<td>(a) Serial No. of Hood : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[serial]" value="<?php echo $hood_serial; ?>"></td>	
											<td>(b) Contaminant captured : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[contaminant]" value="<?php echo $hood_contaminant; ?>"></td>	
										</tr>
										<tr>
											<td colspan="4">(c) Capture velocities (at points to be specified) : </td>
										</tr>
										<tr>
											<td>Design value : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[design]" value="<?php echo $hood_design; ?>"></td>	
											<td>Actual value : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[actual]" value="<?php echo $hood_actual; ?>"></td>	
										</tr>
										<tr>
											<td>(d) Volume exhausted at hood : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[volume]" value="<?php echo $hood_volume; ?>"></td>
											<td>(e) Hood Static pressure : </td>
											<td><input type="text" class="form-control text-uppercase" name="hood[pressure]" value="<?php echo $hood_pressure; ?>"></td>		
										</tr>
										<tr>
											<td colspan="4">3. Total pressure drop at : </td>
										</tr>
										<tr>
											<td>(a) Joints : </td>
											<td><input type="text" class="form-control text-uppercase" name="pressure[joints]" value="<?php echo $pressure_joints; ?>"></td>	
											<td>(b) Other points of system (to be specified) : </td>
											<td><input type="text" class="form-control text-uppercase" name="pressure[other]" value="<?php echo $pressure_other; ?>"></td>	
										</tr>
										<tr>
											<td colspan="2">4. Transport velocity in Duet (at points along duets to be specified) : </td>
											<td><input type="text" class="form-control text-uppercase" name="transport" value="<?php echo $transport; ?>"></td>
											<td></td>			
										</tr>										
										<tr>
											<td colspan="4">5. Air cleaning Device : </td>
										</tr>
										<tr>
											<td>(a) Type used : </td>
											<td><input type="text" class="form-control text-uppercase" name="device[type]" value="<?php echo $device_type; ?>"></td>	
											<td>(b) Velocity at inlet : </td>
											<td><input type="text" class="form-control text-uppercase" name="device[velocity1]" value="<?php echo $device_velocity1; ?>"></td>
										</tr>
										<tr>
											<td>(c) Static pressure at inlet : </td>
											<td><input type="text" class="form-control text-uppercase" name="device[pressure1]" value="<?php echo $device_pressure1; ?>"></td>	
											<td>(d) Velocity at outlet : </td>
											<td><input type="text" class="form-control text-uppercase" name="device[velocity2]" value="<?php echo $device_velocity2; ?>"></td>
										</tr>
										<tr>
											<td>(e) Static pressure at outlet : </td>
											<td><input type="text" class="form-control text-uppercase" name="device[pressure2]" value="<?php echo $device_pressure2; ?>"></td>	
											<td colspan="2"></td>
										</tr>																				
										<tr>
											<td colspan="4">6. Fan : </td>
										</tr>
										<tr>
											<td>(a) Type used : </td>
											<td><input type="text" class="form-control text-uppercase" name="fan[type]" value="<?php echo $fan_type; ?>"></td>	
											<td>(b) Volume handled : </td>
											<td><input type="text" class="form-control text-uppercase" name="fan[volume]" value="<?php echo $fan_volume; ?>"></td>
										</tr>
										<tr>
											<td>(c) Static pressure : </td>
											<td><input type="text" class="form-control text-uppercase" name="fan[pressure]" value="<?php echo $fan_pressure; ?>"></td>	
											<td>(d) Pressure drop at outlet of fan : </td>
											<td><input type="text" class="form-control text-uppercase" name="fan[drop]" value="<?php echo $fan_drop; ?>"></td>
										</tr>
																													
										<tr>
											<td colspan="4">7. Fan Motor : </td>
										</tr>
										<tr>
											<td>(a) Type : </td>
											<td><input type="text" class="form-control text-uppercase" name="motor[type]" value="<?php echo $motor_type; ?>"></td>	
											<td>(b) Speed and horse power : </td>
											<td><input type="text" class="form-control text-uppercase" name="motor[speed]" value="<?php echo $motor_speed; ?>"></td>
										</tr>
										<tr>
											<td colspan="2">8. Particulars of defects, if any, disclosed during test in any of the above components : </td>
											<td><input type="text" class="form-control text-uppercase" name="defects" value="<?php echo $defects; ?>"></td>	
											<td></td>
										</tr>
										<tr class="form-inline">
											<td colspan="4">I, certify that on &nbsp;<input type="date" class="dob form-control" name="certify_dt" value="<?php echo $certify_dt; ?>" placeholder="DATE">&nbsp; the above dust extraction system was thoroughly cleaned and (so far as its construction permits) make accessible for thorough examination. I further certify that on the said date, I thoroughly examined the above dust extraction system including its components and fittings and that the above is a true report of my examination.</td>
										</tr>											
										<tr>
											<td colspan="4">9. If employed by a Company or Association, give name and address : </td>
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
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save & Next</button>
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