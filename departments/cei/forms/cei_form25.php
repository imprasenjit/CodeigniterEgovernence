<?php  require_once "../../requires/login_session.php"; 
$dept="cei";
$form="25";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);

include "save_cei_form.php";
 
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id'") ; // For reccuring form fill ups
	
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1") ;
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];
		
		  ########## Part A ###############
					
			$Voltage=$results["Voltage"];$Location=$results["Location"];$pur_constructed=$results["pur_constructed"];$length=$results["length"];$Quantum=$results["Quantum"];$no_Spans=$results["no_Spans"];$length_Spans=$results["length_Spans"];$max_len_Spans=$results["max_len_Spans"];
			$Type_conductor=$results["Type_conductor"];$size_conductor=$results["size_conductor"];
			$Type_Support=$results["Type_Support"];$Materials=$results["Materials"];$t_Supports=$results["t_Supports"];
			$Type_Cross=$results["Type_Cross"];$Cross_size=$results["Cross_size"];$acr_street=$results["acr_street"];$a_street=$results["a_street"];$Elsewhere=$results["Elsewhere"];$point_from_pt=$results["point_from_pt"];$point_to_pt=$results["point_to_pt"];	
			
			if(!empty($results["type_insulator"])){
				$type_insulator=json_decode($results["type_insulator"]);
				if(isset($type_insulator->pin)) $type_insulator_pin=$type_insulator->pin; else $type_insulator_pin="";
				if(isset($type_insulator->disc)) $type_insulator_disc=$type_insulator->disc; else $type_insulator_disc="";
				if(isset($type_insulator->poly)) $type_insulator_poly=$type_insulator->poly; else $type_insulator_poly="";
			}else{
				$type_insulator_pin="";$type_insulator_disc="";$type_insulator_poly="";
			}
			
			
			if(!empty($results["clearance"])){
					$clearance=json_decode($results["clearance"]);
					$clearance_a=$clearance->a;$clearance_b=$clearance->b;$clearance_c=$clearance->c;
			}else{				
					$clearance_a="";$clearance_b="";$clearance_c="";
			}	
			
			########## Part B ###############
			
			$leak_volt=$results["leak_volt"];$is_cradle_g=$results["is_cradle_g"];$menti_vol=$results["menti_vol"];$h_izontal=$results["h_izontal"];$v_ertical=$results["v_ertical"];$is_h_guard=$results["is_h_guard"];
			$angle_crossing=$results["angle_crossing"];$overhead_line=$results["overhead_line"];
			########## Part C ###############
			$voltage_Insulation=$results["voltage_Insulation"];$type_size_guard=$results["type_size_guard"];$is_continuous=$results["is_continuous"];$intervals_earth_wire=$results["intervals_earth_wire"];$metallic_supports=$results["metallic_supports"];$permanently_earthed=$results["permanently_earthed"];$overhead_line_electricity=$results["overhead_line_electricity"];
			$Make=$results["Make"];$Specifications=$results["Specifications"];$protection=$results["protection"];$Normal_setting=$results["Normal_setting"];
			if(!empty($results["phase_earth"])){
				$phase_earth=json_decode($results["phase_earth"]);
				$phase_earth_ea=$phase_earth->ea;
				$phase_earth_ph=$phase_earth->ph;
				$phase_earth_ea_s1=$phase_earth_ea->s1;$phase_earth_ea_s2=$phase_earth_ea->s2;$phase_earth_ea_s3=$phase_earth_ea->s3;
				$phase_earth_ph_s1=$phase_earth_ph->s1;$phase_earth_ph_s2=$phase_earth_ph->s2;$phase_earth_ph_s3=$phase_earth_ph->s3;
			}else{
				$phase_earth_ea_s1="";$phase_earth_ea_s2="";$phase_earth_ea_s3="";
				$phase_earth_ph_s1="";$phase_earth_ph_s2="";$phase_earth_ph_s3="";
				
			}
			
			########## Part D ###############
			
			$anti_climbing=$results["anti_climbing"];$in_location=$results["in_location"];$gang_switches=$results["gang_switches"];$is_gang_switches=$results["is_gang_switches"];$efficiently_earthed=$results["efficiently_earthed"];$is_isolator=$results["is_isolator"];$is_caution=$results["is_caution"];
			
			if(!empty($results["lightning"]))
			{
				$lightning=json_decode($results["lightning"]);
				$lightning_a=$lightning->a;$lightning_b=$lightning->b;$lightning_c=$lightning->c;$lightning_d=$lightning->d;$lightning_e=$lightning->e;
			}else{
				$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";
			}
			
		}else{
			$form_id="";
			########## Part A ###############
			
			$Voltage="";$Location="";$point_from_pt="";$point_to_pt="";$pur_constructed="";$length="";
			$Quantum="";$no_Spans ="";$length_Spans ="";$max_len_Spans="";$Type_conductor="";$size_conductor="";$Type_Support="";$Materials="";$t_Supports="";$type_insulator_pin="";$type_insulator_disc="";$type_insulator_poly="";
			$Type_Insulators="";$Type_Cross="";$Cross_size="";$acr_street="";$a_street="";$Elsewhere="";$clearance_a="";
			$clearance_b="";$clearance_c="";
			
			########## Part B ###############
			$leak_volt="";$is_cradle_g="";$menti_vol="";$h_izontal ="";$v_ertical="";$is_h_guard="";$angle_crossing="";
			$overhead_line="";
			
			########## Part C ###############
			$voltage_Insulation="";$type_size_guard="";$is_continuous="";$intervals_earth_wire="";$metallic_supports="";$permanently_earthed="";$overhead_line_electricity="";
			$Make="";$Specifications="";$protection="";$Normal_setting="";
			$phase_earth_ea_s1="";$phase_earth_ea_s2="";$phase_earth_ea_s3="";
			$phase_earth_ph_s1="";$phase_earth_ph_s2="";$phase_earth_ph_s3="";
			
			########## Part D ###############
			
			$anti_climbing="";$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";$is_isolator="";$in_location="";$gang_switches="";$is_gang_switches="";$notice_boards="";$efficiently_earthed="";$is_caution="";
				
			}
		
		
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		
      ########## Part A ###############
				
		$Voltage=$results["Voltage"];$Location=$results["Location"];$pur_constructed=$results["pur_constructed"];$length=$results["length"];$Quantum=$results["Quantum"];$no_Spans=$results["no_Spans"];$length_Spans=$results["length_Spans"];$max_len_Spans=$results["max_len_Spans"];
	    $Type_conductor=$results["Type_conductor"];$size_conductor=$results["size_conductor"];
		$Type_Support=$results["Type_Support"];$Materials=$results["Materials"];$t_Supports=$results["t_Supports"];
		$Type_Cross=$results["Type_Cross"];$Cross_size=$results["Cross_size"];$acr_street=$results["acr_street"];$a_street=$results["a_street"];$Elsewhere=$results["Elsewhere"];$point_from_pt=$results["point_from_pt"];$point_to_pt=$results["point_to_pt"];
		
		if(!empty($results["type_insulator"])){
			$type_insulator=json_decode($results["type_insulator"]);
			if(isset($type_insulator->pin)) $type_insulator_pin=$type_insulator->pin; else $type_insulator_pin="";
			if(isset($type_insulator->disc)) $type_insulator_disc=$type_insulator->disc; else $type_insulator_disc="";
			if(isset($type_insulator->poly)) $type_insulator_poly=$type_insulator->poly; else $type_insulator_poly="";
		}else{
			$type_insulator_pin="";$type_insulator_disc="";$type_insulator_poly="";
		}	
		
		if(!empty($results["clearance"])){
			$clearance=json_decode($results["clearance"]);
			$clearance_a=$clearance->a;$clearance_b=$clearance->b;$clearance_c=$clearance->c;
		}else{				
			$clearance_a="";$clearance_b="";$clearance_c="";
		}	
				
		
		########## Part B ###############
		
		$leak_volt=$results["leak_volt"];$is_cradle_g=$results["is_cradle_g"];$menti_vol=$results["menti_vol"];$h_izontal=$results["h_izontal"];$v_ertical=$results["v_ertical"];$is_h_guard=$results["is_h_guard"];
		$angle_crossing=$results["angle_crossing"];$overhead_line=$results["overhead_line"];
		########## Part C ###############
		$voltage_Insulation=$results["voltage_Insulation"];$type_size_guard=$results["type_size_guard"];$is_continuous=$results["is_continuous"];$intervals_earth_wire=$results["intervals_earth_wire"];$metallic_supports=$results["metallic_supports"];$permanently_earthed=$results["permanently_earthed"];$overhead_line_electricity=$results["overhead_line_electricity"];
		$Make=$results["Make"];$Specifications=$results["Specifications"];$protection=$results["protection"];$Normal_setting=$results["Normal_setting"];
		if(!empty($results["phase_earth"])){
			$phase_earth=json_decode($results["phase_earth"]);
			$phase_earth_ea=$phase_earth->ea;
			$phase_earth_ph=$phase_earth->ph;
			$phase_earth_ea_s1=$phase_earth_ea->s1;$phase_earth_ea_s2=$phase_earth_ea->s2;$phase_earth_ea_s3=$phase_earth_ea->s3;
			$phase_earth_ph_s1=$phase_earth_ph->s1;$phase_earth_ph_s2=$phase_earth_ph->s2;$phase_earth_ph_s3=$phase_earth_ph->s3;
		}else{
			$phase_earth_ea_s1="";$phase_earth_ea_s2="";$phase_earth_ea_s3="";
			$phase_earth_ph_s1="";$phase_earth_ph_s2="";$phase_earth_ph_s3="";
			
		}
		
		########## Part D ###############
		
		$anti_climbing=$results["anti_climbing"];$in_location=$results["in_location"];$gang_switches=$results["gang_switches"];$is_gang_switches=$results["is_gang_switches"];$efficiently_earthed=$results["efficiently_earthed"];$is_isolator=$results["is_isolator"];$is_caution=$results["is_caution"];
		
		if(!empty($results["lightning"]))
		{
			$lightning=json_decode($results["lightning"]);
			$lightning_a=$lightning->a;$lightning_b=$lightning->b;$lightning_c=$lightning->c;$lightning_d=$lightning->d;$lightning_e=$lightning->e;
		}else{
			$lightning_a="";$lightning_b="";$lightning_c="";$lightning_d="";$lightning_e="";
            }
		
	}

    ##PHP TAB management
	 $showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

    $tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	$tabbtn4 = "";
	
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
		$tabbtn4 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
		$tabbtn4 = "";
	}
	if ($showtab == 4) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "";
		$tabbtn4 = "active";
	}
	##PHP TAB management ends
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
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
									<li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								
								<table class="table table-responsive table-bordered">									
									<tr>
										<td colspan="4">1. This Test Report is to be submitted in duplicate. </td>
										<tr>
										   <td width="25%">1.1  Voltage of line :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="Voltage"  value="<?php echo $Voltage; ?>" required="required"></td>
										   <td width="25%">1.2  Location:</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="Location"  value="<?php echo $Location; ?>" required="required"></td>
									   </tr>
									   <tr>
										   <td colspan="4">1.3 From (Starting point) To (Termination point) :</td>
										</tr>
										<tr>
										    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;From </td>
											<td><input type="text" class="form-control text-uppercase" name="point_from_pt" placeholder="Form point"  value="<?php echo $point_from_pt; ?>" required="required"></td>
											<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; To </td>
											<td><input type="text" class="form-control text-uppercase" name="point_to_pt" placeholder="To point" value="<?php echo $point_to_pt; ?>" required="required"></td>
										</tr>
										<tr>
										   <td width="25%">1.4 Purpose for which the line is constructed :</td>
										   <td><input type="text" class="form-control text-uppercase" name="pur_constructed" value="<?php echo $pur_constructed; ?>" required="required"></td>
										   <td width="25%">1.5  Length of line in kilometer:</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="length" value="<?php echo $length; ?>" required="required"></td>
										 </tr>
										 <tr>
										   <td width="25%">1.6  Quantum of power proposed to be transmitted:</td>
										    <td width="25%"><input type="text" class="form-control text-uppercase" name="Quantum"  value="<?php echo $Quantum; ?>" required="required"></td>
									    </tr>
									    <tr>
										    <td>2. Details of Spans of the line.</td>							
									    </tr>
									 <tr>
										<tr>
										   <td width="25%">2.1 Total No. of Spans :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="no_Spans"  value="<?php echo $no_Spans ; ?>" required="required"></td>
										   <td width="25%">2.2 Average length of Spans :</td>
										   <td width="25%"><input type="text" class="form-control text-uppercase" name="length_Spans"  value="<?php echo $length_Spans; ?>" required="required"></td>
									   </tr>
									</tr>
									<tr>
										<td>2.3 Maximum length of Spans</td>
										<td><input type="text" class="form-control text-uppercase" name="max_len_Spans"   value="<?php echo $max_len_Spans; ?>" required="required"></td>
									</tr>
									<tr>
										<td colspan="4">3. Type and size of conductor used:</td>
									</tr>
									<tr>
										<td>Type :</td>
										<td><input type="text" class="form-control text-uppercase" name="Type_conductor"   value="<?php echo $Type_conductor; ?>" required="required"></td>
										<td>size:</td>
										<td><input type="text" class="form-control text-uppercase" name="size_conductor"  value="<?php echo $size_conductor; ?>" required="required"></td>
									</tr>
									<tr>
										<td colspan="4">4. A. Type of Support used and Materials :</td>
									</tr>
									<tr>
									    <td>&nbsp;&nbsp;&nbsp;&nbsp; Type of Support :</td>
										<td><input type="text" class="form-control text-uppercase" name="Type_Support"   value="<?php echo $Type_Support; ?>" required="required"></td>
										<td> &nbsp;&nbsp;&nbsp;&nbsp; Materials :</td>
										<td><input type="text" class="form-control text-uppercase" name="Materials"  value="<?php echo $Materials; ?>" required="required"></td>
									</tr>
									<tr>
										<td>&nbsp;&nbsp; B. Total No. of Supports :</td>
										<td><input type="text" class="form-control text-uppercase" name="t_Supports"  value="<?php echo  $t_Supports; ?>" required="required"></td>									
									</tr>
									<tr>
										<td>5. Type of Insulators used :</td>
										<td colspan="3">
											<label class="checkbox-inline"><input type="checkbox" <?php if($type_insulator_pin=="P") echo "checked"; ?> name="type_insulator[pin]" value="P">Pin</label>
											<label class="checkbox-inline"><input type="checkbox" <?php if($type_insulator_disc=="D") echo "checked"; ?> name="type_insulator[disc]" value="D">Disc</label>
											<label class="checkbox-inline"><input type="checkbox" <?php if($type_insulator_poly=="PY") echo "checked"; ?> name="type_insulator[poly]" value="PY">Poly</label>
										</td>
									</tr>
									<tr>
										<td colspan="4">6. Type of Cross arms used with size:</td>
									</tr>
									<tr>
									    <td>&nbsp;&nbsp;&nbsp;&nbsp; Type of Cross :</td>
										<td><input type="text" class="form-control text-uppercase" name="Type_Cross" value="<?php echo $Type_Cross; ?>" required="required"></td>
										<td> &nbsp;&nbsp;&nbsp;&nbsp; Size :</td>
										<td><input type="text" class="form-control text-uppercase" name="Cross_size"  value="<?php echo $Cross_size; ?>" required="required"></td>
									</tr>	
								
									<tr>
										<td colspan="3">7. Clearance between ground and the lowest conductor (Regulation 58)</td>
									</tr>
										<td>7.1 Across a street </td>
										<td><input type="text" class="form-control text-uppercase" name="acr_street"  value="<?php echo  $acr_street; ?>" required="required"></td>
										<td>7.2 Along a street </td>
										<td><input type="text" class="form-control text-uppercase" name="a_street"  value="<?php echo  $a_street; ?>" required="required"></td>
									</tr>
									<tr>
										<td>7.3 Elsewhere </td>
										<td><input type="text" class="form-control text-uppercase" name="Elsewhere"  value="<?php echo  $Elsewhere; ?>" required="required"></td>
							       </tr>
									<tr>
										<td colspan="4">8. Clearance from nearby building, if any (Regulations 61):</td>
									</tr>
									
									</tr>
										<td>8.1 Minimum vertical clearance above highest part of such building :</td>
										<td><input type="text" class="form-control text-uppercase" name="clearance[a]"  value="<?php echo  $clearance_a; ?>" required="required"></td>
										<td>8.2 Minimum horizontal clearance between nearest conductor & any part of such building. </td>
										<td><input type="text" class="form-control text-uppercase" name="clearance[b]"  value="<?php echo  $clearance_b; ?>" required="required"></td>
									</tr>
									<tr>
										<td>8.3 If proper guarding provided in case of 9.1 above </td>
										<td><input type="text" class="form-control text-uppercase" name="clearance[c]"  value="<?php echo  $clearance_c; ?>" required="required"></td>
							       </tr>
									<tr>
											<td></td>
											<td class="text-center" colspan="2">
												<button type="submit" style="font-weight:bold" name="save<?php echo $form; ?>a" class="btn btn-success submit1">Save and Next</button>
											</td>
											<td></td>
										</tr>
									</table>
									</form> 
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
								 <tr>
								     <td colspan="3">9. Where conductors forming parts of system of different voltage are erected on the same support,has adequate provision been made to guard against the danger from the lower voltage system being charged above the normal working voltage by leaking from or contact with higher voltag system ? (Regulation 62) </td>
								     <td width="25%"><input type="text" class="form-control text-uppercase" name="leak_volt"  value="<?php echo  $leak_volt; ?>" required="required"></td>
									 <td></td>
									 <td></td>
							    </tr>
								 <tr>
								     <td width="25%">9.1 Has Cradle guard been provided ?</td>
									 <td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_cradle_g=="Y" || $is_cradle_g=="") echo "checked"; ?> id="inlineRadio1" name="is_cradle_g" required="required"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_cradle_g=="N") echo "checked"; ?> id="inlineRadio1" name="is_cradle_g"> No </label></td>
									
							    </tr>
								<tr>
								     <td colspan="4">10. Where overhead lines cross or are in proximity of each other, have they been suitably protected to guard against possibility of their coming into contact with each other (Regulation 69) :</td>
							    </tr>
								<tr>
								     <td width="25%">10.1 Mention the voltage of the other line in the vicinity :</td>
								     <td width="25%"><input type="text" class="form-control text-uppercase" name="menti_vol" value="<?php echo  $menti_vol ; ?>" required="required"></td>
								</tr>
								<tr>
									 <td colspan="4">10.2 What are the minimum clearance between such lines :</td>
								</tr>
								<tr>
								    <td width="25%">(a) Horizontal :</td>
								    <td width="25%"><input type="text" class="form-control text-uppercase" name="h_izontal"  value="<?php echo  $h_izontal ; ?>" required="required"></td>
								
									<td width="25%">(b)&nbsp;&nbsp; Vertical :</td>
								    <td width="25%"><input type="text" class="form-control text-uppercase" name="v_ertical"  value="<?php echo  $v_ertical ; ?>" required="required"></td>
							    </tr>
								<tr>
								     <td>10.3 Has guard been provided :</td>
									  <td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_h_guard=="Y" || $is_h_guard=="") echo "checked"; ?> id="inlineRadio1" name="is_h_guard" required="required"> Yes </label>
									<label class="radio-inline"><input type="radio" value="N" <?php if($is_h_guard=="N") echo "checked"; ?> id="inlineRadio1" name="is_h_guard"> No </label></td>
								</tr>
								<tr>
								     <td>10.4 In case two lines are crossing, what is the angle of crossing :</td>
								     <td width="25%"><input type="text" class="form-control text-uppercase" name="angle_crossing"  value="<?php echo  $angle_crossing ; ?>" required="required"></td>
								</tr>
								<tr>
								     <td colspan="3">11. Where an overhead line is crossing or is in the proximity of any telecommunication line, has theoverhead line is protected in the manner laid down in the code of practice of power and telecommuni-cation co-ordination committee (Regulation 69) :</td>
								     <td width="25%"><input type="text" class="form-control text-uppercase" name="overhead_line"  value="<?php echo  $overhead_line ; ?>" required="required"></td>
									 <td></td>
									 <td></td>
								   </tr>
											<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>b" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
										</table>
										</form>
									</div>	
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
									<tr>
									    <td colspan="3">12. Insulation resistance of the line.</td>
									</tr>
									        <tr>
												<td colspan="4">
												<table  class="table table-responsive table-bordered">        
													<tr>
													  <td style="width:200px;"></td>
													  <td align="center">(a)</td>
													  <td align="center">(b)</td>
													  <td align="center">(c)</td>
													  
												</tr>
													<tr>
													  <td>12.1 Phase to earth</td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ea][s1]" id="textfield1" value="<?php echo $phase_earth_ea_s1; ?>" required="required"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ea][s2]" id="textfield2" value="<?php echo $phase_earth_ea_s2; ?>" required="required"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ea][s3]" id="textfield3" value="<?php echo $phase_earth_ea_s3; ?>" /required="required"></td>
													  
													</tr>
													<tr>
													  <td>12.2 Phase to phase </td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ph][s1]" id="textfield4" value="<?php echo $phase_earth_ph_s1; ?>" required="required"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ph][s2]" id="textfield5" value="<?php echo $phase_earth_ph_s2; ?>" required="required"/></td>
													  <td><input type="text" class="form-control text-uppercase" name="phase_earth[ph][s3]" id="textfield6" value="<?php echo $phase_earth_ph_s3; ?>" required="required"/></td>
													  
													</tr>
											</table>
										   </td>
											</tr>
									<tr>
									    <td>12.3 Mention voltage of Insulation Tester used.</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" name="voltage_Insulation"  value="<?php echo  $voltage_Insulation ; ?>" required="required"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
									    <td>13. What is the type & size of guard wire used? (Details of earthing is to be furnished in the Annexure - I) :</td>
									    <td><textarea class="form-control text-uppercase" name="type_size_guard"> <?php echo  $type_size_guard; ?></textarea></td>
										<td></td>
										<td></td>
									</tr>
									
								    <tr>
									    <td colspan="4">14. If all the supports of overhead line and metallic fittings attached thereto are permanently & efficiently earthed (Regulation 72):</td>
									</tr>
									<tr>
									    <td>14.1  Is continuous earth wire provided : </td>
									    <td colspan="2">
													<label class="radio-inline"><input type="radio" value="Y" <?php if($is_continuous=="Y" || $is_continuous=="") echo "checked"; ?> id="inlineRadio1" name="is_continuous" required="required"> Yes </label>
													<label class="radio-inline"><input type="radio" value="N" <?php if($is_continuous=="N") echo "checked"; ?> id="inlineRadio1" name="is_continuous"> No </label>
												</td>
										</td></td>
									 </tr>    
									    <td>14.2  If so at what intervals earth wire is earthed : </td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" name="intervals_earth_wire"  value="<?php echo  $intervals_earth_wire ; ?>" required="required"></td>
										</td></td>
										</td></td>
								    </tr>
									<tr>
									    <td colspan="3">14.3 If no earth wire is used, whether metallic supports of all individual poles are earthed?(Details of earthing is to be furnished in the Annexure): </td>
									    <td width="25%"><textarea class="form-control text-uppercase" name="metallic_supports"> <?php echo  $metallic_supports; ?></textarea></td>
								    </tr>
									<tr>
									    <td colspan="3">15. Are stay wires are permanently earthed (Regulation 72) Mention the minimum height at which guy insulator is used </td>
									    <td width="25%"><textarea class="form-control text-uppercase" name="permanently_earthed"> <?php echo  $permanently_earthed; ?></textarea></td>
								    </tr>
									<tr>
									   <td colspan="3">16. Has the overhead line been suitably protected with device for rendering the line electricity harmless in case it breaks (Regulation 73) ? And its location. </td>
									    <td width="25%"><textarea class="form-control text-uppercase" name="overhead_line_electricity"> <?php echo  $overhead_line_electricity; ?></textarea></td>
			                     </tr>
								    <tr>
									   <td colspan="3">16.1 Give details of such device used. </td>
			                      </tr>
								    <tr>
									    <td width="25%">(a) Make</td>
									    <td width="25%"><input type="text" name="Make"  value="<?php echo $Make; ?>" class="form-control text-uppercase" required="required"></td>
									    <td width="25%">(b)Specifications (Rating)</td>
										<td width="25%"><input type="text" name="Specifications"  value="<?php echo $Specifications; ?>" class="form-control text-uppercase" required="required"></td>
									</tr>
									<tr>
									    <td width="25%">(c) Type of protection provided </td>
									    <td width="25%"><input type="text" name="protection"  value="<?php echo $protection; ?>" class="form-control text-uppercase" required="required"></td>
									    <td width="25%">(d) Normal setting </td>
										<td width="25%"><input type="text" name="Normal_setting"  value="<?php echo $Normal_setting; ?>" class="form-control text-uppercase" required="required"></td>
									</tr>
									
										<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=2" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>c" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
										</tr>
										</table>
										</form>
									</div>
									<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
										<form name="myform1" class="submit1"  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
										<tr>
												<td colspan="2">17. Whether anti-climbing devices have been provided for each support (Regulation 73) ? </td>
												<td width="25%"><input type="text" name="anti_climbing"  value="<?php echo $anti_climbing; ?>" class="form-control text-uppercase" required="required"></td>
											
										</tr>
										<tr>  
										      <td  colspan="4">18. Has the overhead line been provided with efficient means for diverting electrical surge due to lightning (Regulation 74) : </td>
										</tr>
										<tr>
									         <td width="25%">18.1 What type of lightning arrester used & K.A.</td>
									         <td width="25%"><input type="text" name="lightning[a]" value="<?php echo $lightning_a; ?>" class="form-control text-uppercase" required="required"></td>
									         <td width="25%">18.2 Location of lightning arrester</td>
										     <td width="25%"><input type="text" name="lightning[b]" value="<?php echo $lightning_b; ?>" class="form-control text-uppercase" required="required"></td>
									    </tr>
									    <tr>
									        <td width="25%">18.3 Has the lightning arrester been efficiently earthed to an independent electrode/System? </td>
									        <td width="25%"><input type="text" name="lightning[c]" value="<?php echo $lightning_c; ?>" class="form-control text-uppercase" required="required"> 
									        <td width="25%">18.4 Number of electrode used for earthing the lightning arrester system (Details of earthing is to be furnished in the Annexure-I </td>
										    <td width="25%"><input type="text" name="lightning[d]" value="<?php echo $lightning_d; ?>" class="form-control text-uppercase" required="required">
									   </tr>
									   <tr>
												<td width="25%">18.5 Is the lightning arrester earthing system connected to any other earthing system ? </td>
												<td width="25%"><input type="text" name="lightning[e]" value="<?php echo $lightning_e; ?>" class="form-control text-uppercase" required="required">
										</tr>
										<tr>
												<td colspan="3">19. Has any gang operated switch/isolator been provided any where ?</td>
												<td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_isolator=="Y" || $is_isolator=="") echo "checked"; ?> id="inlineRadio1" name="is_isolator" required="required"> Yes </label>
											<label class="radio-inline"><input type="radio" value="N" <?php if($is_isolator=="N" || $is_isolator=="") echo "checked"; ?> id="inlineRadio1" name="is_isolator"> No </label></td>
									
										</tr>
										<tr>
									         <td width="25%">19.1 Indicate location(s) of the same</td>
									         <td width="25%"><input type="text" name="in_location"  value="<?php echo $in_location; ?>" class="form-control text-uppercase" required="required"></td>
									         <td width="25%">19.2 Mention rating of each gang switches</td>
										      <td width="25%"><input type="text" name="gang_switches"  value="<?php echo $gang_switches; ?>" class="form-control text-uppercase" required="required"></td>
									  </tr>
									  <tr>
									         <td width="25%">19.3 Are all gang switches efficiently earthed ? (Details of earthing to be provided in the Annexure –I)</td>
									         <td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_gang_switches=="Y" || $is_gang_switches=="") echo "checked"; ?> id="inlineRadio1" name="is_gang_switches" required="required"> Yes </label>
											  <label class="radio-inline"><input type="radio" value="N" <?php if($is_gang_switches=="N") echo "checked"; ?> id="inlineRadio1" name="is_gang_switches"> No </label></td>
									
									         <td width="25%">19.4 State whether an insulated or efficiently earthed platform for the operator is provided?(Details of earthing, if any, is to be provided in the Annexure-I) </td>
										     <td width="25%"><input type="text" name="efficiently_earthed"  value="<?php echo $efficiently_earthed; ?>" class="form-control text-uppercase" required="required"></td>
									  </tr>
									  <tr>
												<td width="25%">20. Have caution notice boards been provided at each support (Regulations 18) ? </td>
												<td colspan="1"><label class="radio-inline"><input type="radio" value="Y" <?php if($is_caution=="Y" || $is_caution=="") echo "checked"; ?> id="inlineRadio1" name="is_caution" required="required"> Yes </label>
											  <label class="radio-inline"><input type="radio" value="N" <?php if($is_caution=="N") echo "checked"; ?> id="inlineRadio1" name="is_caution"> No </label></td>
										</tr>
										<tr>
										  <td colspan="4">Certified that the above statements are correct to the best of my knowledge and understand and that the works was done under my direct supervision, complying with all the provisions of the central electricity authority (measures relating to safety & electric supply) regulations, 2010 /relevant BIS standards/safety Codes.
										  </td>
										</tr>
										
										<tr>
										<td colspan="2">Date: <label><?php echo date('d-m-Y',strtotime($today));?></label></td>										
										<td colspan="2" align="right">Signature: <strong><?php echo strtoupper($key_person)?></strong><br/>
										Name: <label><?php echo strtoupper($key_person)?></strong>
										</td>
									</tr>	
										<tr>
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=3" class="btn btn-primary text-bold">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form; ?>d" class="btn btn-success text-bold submit1">Save and Next</button>
												</td>
											</tr>
	                           </table>
								</form>
							</div>
							   
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
    $('input[type="text"]').prop('required',true);
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>