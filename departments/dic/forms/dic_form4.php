<?php require_once "../../requires/login_session.php"; 
$dept="dic";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
  
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$acknowledge_number=$results["acknowledge_number"];$issue_em=$results["issue_em"];	
			#### Part A #######
			$nature=$results["nature"];$ancillary=$results["ancillary"];$installation_date=$results["installation_date"];$fact_act=$results["fact_act"];$area_r=$results["area_r"];$is_unit_computer=$results["is_unit_computer"];
			#### Part B #######
			$cat_enter=$results["cat_enter"];
			
			$source_reason=$results["source_reason"];
			
			if(!empty($results["manuf"]))
			{
				$manuf=json_decode($results["manuf"]);
				$manuf_code=$manuf->code;$manuf_name=$manuf->name;
			}else{
				$manuf_code="";$manuf_name="";
			}
			if(!empty($results["fixed_asset"]))
			{
				$fixed_asset=json_decode($results["fixed_asset"]);
				$fixed_asset_plant_approx=$fixed_asset->plant_approx;$fixed_asset_building=$fixed_asset->building;$fixed_asset_building_approx=$fixed_asset->building_approx;$fixed_asset_land=$fixed_asset->land;$fixed_asset_land_approx=$fixed_asset->land_approx;
				$fixed_asset_equity_approx=$fixed_asset->equity_approx;$fixed_asset_euipment_approx=$fixed_asset->equipment_approx;
			}else{
				$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";	$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
			}
			if(!empty($results["power"]))
			{
				$power=json_decode($results["power"]);
				$power_unit=$power->unit;$power_load=$power->load;
			}else{
				$power_unit="";$power_load="";
			}	
			if(!empty($results["source"]))
			{
				$source=json_decode($results["source"]);
				if(isset($source->a)) $source_a=$source->a; 
				if(isset($source->b)) $source_b=$source->b; 
				if(isset($source->c)) $source_c=$source->c; 
				if(isset($source->d)) $source_d=$source->d; 
				if(isset($source->e)) $source_e=$source->e; 
				if(isset($source->f)) $source_f=$source->f; 
				if(isset($source->g)) $source_g=$source->g; 
				if(isset($source->h)) $source_h=$source->h; 
			}else{
				$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";
			}	
			##### Part C########
			$annual_rupees=$results["annual_rupees"];$export_rupees=$results["export_rupees"];$expect_date=$results["expect_date"];$is_unit_computer=$results["is_unit_computer"];
			
			if(!empty($results["expected"]))
			{
				$expected=json_decode($results["expected"]);
				$expected_staff1=$expected->staff1;$expected_staff2=$expected->staff2;
				$expected_supervisory1=$expected->supervisory1;$expected_supervisory2=$expected->supervisory2;
				$expected_workers1=$expected->workers1;$expected_workers2=$expected->workers2;
			}else{
				$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";
			}
			 
		}else{ 
			$form_id="";
			#### Part A #######
			$nature="";$ancillary="";$installation_date="";$fact_act="";$area_r="";$is_unit_computer="";$issue_em="";
			#### Part B #######
			$cat_enter="";$acknowledge_number="";
			$manuf_code="";$manuf_name="";
			$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
			$power_unit="";$power_load="";
			$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
			##### Part C ######
			$export_rupees="";$annual_rupees="";$expect_date="";$is_unit_computer="";
			$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";$gender="";$caste="";$edu="";$is_stack="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];	
		#### Part A #######
		$nature=$results["nature"];$ancillary=$results["ancillary"];$installation_date=$results["installation_date"];$fact_act=$results["fact_act"];$area_r=$results["area_r"];$is_unit_computer=$results["is_unit_computer"];
		#### Part B #######
		$cat_enter=$results["cat_enter"];$acknowledge_number=$results["acknowledge_number"];$issue_em=$results["issue_em"];$source_reason=$results["source_reason"];
		
		if(!empty($results["manuf"]))
		{
			$manuf=json_decode($results["manuf"]);
			$manuf_code=$manuf->code;$manuf_name=$manuf->name;
		}else{
			$manuf_code="";$manuf_name="";
		}
		if(!empty($results["fixed_asset"]))
		{
			$fixed_asset=json_decode($results["fixed_asset"]);
			$fixed_asset_plant_approx=$fixed_asset->plant_approx;$fixed_asset_building=$fixed_asset->building;$fixed_asset_building_approx=$fixed_asset->building_approx;$fixed_asset_land=$fixed_asset->land;$fixed_asset_land_approx=$fixed_asset->land_approx;
			$fixed_asset_equity_approx=$fixed_asset->equity_approx;$fixed_asset_euipment_approx=$fixed_asset->equipment_approx;
		}else{
			$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";	$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
		}

        if(!empty($results["power"]))
			{
				$power=json_decode($results["power"]);
				$power_unit=$power->unit;$power_load=$power->load;
			}else{
				$power_unit="";$power_load="";
			}
			
		 if(!empty($results["source"]))
		{
			$source=json_decode($results["source"]);
			if(isset($source->a)) $source_a=$source->a; else $source_a="";
			if(isset($source->b)) $source_b=$source->b; else $source_b="";
			if(isset($source->c)) $source_c=$source->c; else $source_c="";
			if(isset($source->d)) $source_d=$source->d; else $source_d="";
			if(isset($source->e)) $source_e=$source->e; else $source_e="";
			if(isset($source->f)) $source_f=$source->f; else $source_f="";
			if(isset($source->g)) $source_g=$source->g; else $source_g="";
			if(isset($source->h)) $source_h=$source->h; else $source_h="";
		}else{
			$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";
		}	
		##### Part C########
		$annual_rupees=$results["annual_rupees"];$export_rupees=$results["export_rupees"];$expect_date=$results["expect_date"];$is_unit_computer=$results["is_unit_computer"];
		if(!empty($results["expected"]))
		{
			$expected=json_decode($results["expected"]);
			$expected_staff1=$expected->staff1;$expected_staff2=$expected->staff2;
			$expected_supervisory1=$expected->supervisory1;$expected_supervisory2=$expected->supervisory2;
			$expected_workers1=$expected->workers1;$expected_workers2=$expected->workers2;
		}else{
			$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";
		}	
	}
	##PHP TAB management
	$showtab = isset($_GET['tab']) ? $_GET['tab'] : "";

	$tabbtn1 = "";
	$tabbtn2 = "";
	$tabbtn3 = "";
	if ($showtab == "" || $showtab < 2 || $showtab > 5 || is_numeric($showtab) == false) {
		$tabbtn1 = "active";
		$tabbtn2 = "";
		$tabbtn3 = "";
	}
	if ($showtab == 2) {
		$tabbtn1 = "";
		$tabbtn2 = "active";
		$tabbtn3 = "";
	}
	if ($showtab == 3) {
		$tabbtn1 = "";
		$tabbtn2 = "";
		$tabbtn3 = "active";
	}
	##PHP TAB management ends
?>
<?php require_once "../../requires/header.php";   ?>
	  <?php include ("".$table_name."_Addmore-operation.php"); ?>
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
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									
									<tr>
									    <td >A. ENTERPRENEURS MEMORANDUM NUMBER(Part 1) :<br/>(If you already filed EM1, please mention the acknowledge number) </td>
										<td ><input type="text" class="form-control text-uppercase" name="acknowledge_number"  value="<?php echo $acknowledge_number;?>"></td>
										<td>B. Date of Issue EM Part1:  </td>
										<td ><input type="text" class="dob form-control text-uppercase" name="issue_em" value="<?php echo $issue_em;?>"></td>
									</tr>
									
									<tr>
									    <td >1. Name of Applicant :   </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $key_person;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">2. a) Address of Communication  :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. b) Permanent Residential Address (Main Applicant) :   </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3. Name of Enterprise :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td colspan="4">4. Location of Enterprise:  </td>					
									</tr>
									<tr>
										<td width="25%"> Street Name 1  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Street Name 2  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td> Vill/Town  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>District  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Block </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td> Pin Code </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td>State  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="Assam"></td>
										<td> Email Id</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>		
									<tr>
										<td>Mobile No </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_mobile_no;?>"></td>
										<td> Area :<span class="mandatory_field">*</span></td>
										<td><select name="area_r" required="required" class="form-control text-uppercase">
											<option value="">Select Area</option>
											<option value="R" <?php if($area_r=="R") echo "selected";?> >Rural</option>
											<option value="U" <?php if($area_r=="U") echo "selected";?> >Urban</option>
										</select>
										</td>
									</tr>	
									<tr>
										<td>5. Nature of Activity :  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $business_type; ?>"></td>
										<td>6. Nature of Operation :<span class="mandatory_field">*</span> </td>
										<td><select required="required" class="form-control text-uppercase" name="nature">
											<option value="" >Select</option>
											<option value="P" <?php if($nature=="P") echo "selected";?> >Perennial</option>
											<option value="S" <?php if($nature=="S") echo "selected";?>>Seasonal</option>
											<option value="C" <?php if($nature=="C") echo "selected";?> >Casual</option>
										</select></td>
									</tr>	
									<tr>
										<td>7. Whether the Unit will be an Ancillary :<span class="mandatory_field">*</span></td>
										<td><input required type="radio" name="ancillary" value="Y" <?php if($ancillary=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="ancillary" value="N" <?php if($ancillary=="N") echo "checked"; ?> /> No</td>
										<td>8. Month & year of installation of plant & machinery :<span class="mandatory_field">*</span> </td>
										<td><input type="text" class="form-control text-uppercase" name="installation_date" required="required" value="<?php echo $installation_date;?>"></td>
									</tr>		
									<tr>
										<td>9. Whether Unit is Registered under Factory Act :<span class="mandatory_field">*</span></td>
										<td><input required type="radio" name="fact_act" value="1" <?php if($fact_act=="1") echo "checked"; ?> /> Under Section 1978 </td>
										<td><input type="radio" name="fact_act" value="2" <?php if($fact_act=="2") echo "checked"; ?> /> Under Section 1985</td>
										<td><input type="radio" name="fact_act" value="3" <?php if($fact_act=="3") echo "checked"; ?> /> Not Registered </td>
									</tr>	
									<tr>
										<td>10. Type of Organization :   </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $Type_of_ownership;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>																				
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
						<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">11. (a). Main Manufacturing/Service Activity : </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class=" form-control text-uppercase" name="manuf[name]" requried="required" value="<?php echo $manuf_name;?>" ></td>
										<td width="25%">Code (NIC2004) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="manuf[code]" requried="required" value="<?php echo $manuf_code;?>" ></td>
									</tr>
									<tr>
										<td colspan="4">11. (b). Products To Be Manufactured/Services To Be Provided : <br/><i>(<font color="red">*</font>) Codes for activities and production/services as per classification specified from time to time by the Development Commissioner (Small Scale Industries), Govt. of India to be filled in by the District Industries Centre or the office where the Entrepreneur's memorandum is subimitted.</i></td>
									</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable1" id="objectTable1" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Name</td>
										   <td align="center">Code</td>
										   <td align="center">Quantity</td>
										   <td align="center">Unit</td>
										</tr>
									   <?php
										$part1=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>"  class="form-control text-uppercase" validate="letters" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["code"]; ?>" validate="onlyNumbers" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtd<?php echo $count;?>"  class="form-control text-uppercase" validate="onlyNumbers" size="20" name="txtD<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["unit"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase"  name="txtA1"></td>
										<td><input id="txtB1" size="20" validate="letters"  class="form-control text-uppercase" name="txtB1"></td>					
										<td><input  id="txtC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="txtC1"></td>
										<td><input id="txtD1" size="20"   class="form-control text-uppercase" validate="onlyNumbers" name="txtD1"></td>					
										<td><input  id="txtE1" size="20" class="form-control text-uppercase" name="txtE1"></td>
									</tr>
									<?php } ?>
									<tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore()" value="">Add More</button>
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/>
									</td>
								</tr>
								<tr>
									<td colspan="4">12.  Investment in Fixed Assets [In Rupees] :</td>
								</tr>
								<tr>
									<td> (i) Land :<span class="mandatory_field">*</span> </td>
									<td><select required class="form-control text-uppercase" name="fixed_asset[land]" >
										<option value="">Select</option>
										<option value="O" <?php if($fixed_asset_land=="O") echo "selected"; ?>>Owned</option>
										<option value="R" <?php if($fixed_asset_land=="R") echo "selected"; ?>>Rented</option>
										<option value="L" <?php if($fixed_asset_land=="L") echo "selected"; ?>>Leased</option>
									</select></td>
									<td> Approximate Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[land_approx]" value="<?php echo $fixed_asset_land_approx;?>"></td>
								</tr>
								<tr>
									<td>(ii) Building  :<span class="mandatory_field">*</span> </td>
									<td><select required class="form-control text-uppercase" name="fixed_asset[building]" >
										<option value="">Select</option>
										<option value="O" <?php if($fixed_asset_building=="O") echo "selected"; ?>>Owned</option>
										<option value="R" <?php if($fixed_asset_building=="R") echo "selected"; ?>>Rented</option>
										<option value="L" <?php if($fixed_asset_building=="L") echo "selected"; ?>>Leased</option>
									</select></td>
									<td> Approximate Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[building_approx]" value="<?php echo $fixed_asset_building_approx;?>"></td>
								</tr>
								<tr>
									<td>(iii) Plant & Machinery (in case of manufacturing  enterprise) Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[plant_approx]" min="1000" value="<?php echo $fixed_asset_plant_approx;?>"></td>
									<td>  (iv) Equipment (in case of services enterprise)   Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[equipment_approx]" min="5000" value="<?php echo $fixed_asset_euipment_approx;?>"></td>
								</tr>
								<tr>
									<td>(v) Foreign Equity (if any) Value : </td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[equity_approx]" min="1000" value="<?php echo $fixed_asset_equity_approx;?>" ></td>
									<td>  &nbsp;</td>
									<td> &nbsp;</td>
								</tr>
								<tr>
									<td>13. Category of Enterprise :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="cat_enter" min="1000" value="<?php echo $cat_enter;?>"></td>
									<td> 14. Power Load (Anticipated):<span class="mandatory_field">*</span> </td>
									<td class="form-inline">
									<input  type="text" class="form-control text-uppercase" required="required" name="power[load]" style="width:150px;" value="<?php echo $power_load;?>" validate="onlyNumbers"> 
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit" value="HP" <?php if($power_unit=='HP') echo 'checked'; ?> > HP </label>
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit"value="KW" <?php if($power_unit=='KW') echo 'checked'; ?> />&nbsp;KW </label></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">15.(a) (i). Other Source of Energy/Power (if required):   </td>
								</tr>
								<tr>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[a]" id="source_a" value="a" <?php if($source_a=='a') echo 'checked'; ?> >No Power Needed </label></td>
									<td><label class="checkbox-inline"><input type="checkbox"  name="source[b]" id="source_b" value="b" <?php if($source_b=='b') echo 'checked'; ?> />&nbsp;Coal </label>  </td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[c]" id="source_c" value="c" <?php if($source_c=='c') echo 'checked'; ?> > OIL </label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[d]" id="source_d" value="d" <?php if($source_d=='d') echo 'checked'; ?> />&nbsp;Liquid Petrolium Gas </label></td>
								</tr>
								<tr>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[e]" id="source_e" value="e" <?php if($source_e=='e') echo 'checked'; ?> >Electricity from Grid</label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[f]" id="source_f" value="f" <?php if($source_f=='f') echo 'checked'; ?> />&nbsp;Electricity from Generator </label> </td> 
									<td><label class="checkbox-inline"><input type="checkbox" name="source[g]" id="source_g" value="g" <?php if($source_g=='g') echo 'checked'; ?> > Non Conventional Energy  </label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[h]" id="source_h" value="h" <?php if($source_h=='h') echo 'checked'; ?> />&nbsp;Traditional Energy </label>
									</td>
								</tr>
								<tr>
									<td > (ii). If no power required, specify reasons :  </td>
									<td><input  type="text" class="form-control text-uppercase"  name="source_reason" value="<?php echo $source_reason;?>"></td>
									<td> &nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td colspan="4">(b). Indicate Annual Requirement :   </td>
								</tr>
								<tr>
									<td colspan="4"> 
									<table name="objectTable2" id="objectTable2" class="table table-responsive">
									<tbody>
										<tr>
											<td align="center">Sl No</td>
										   <td align="center">Source of Energy</td>
										   <td align="center">Quantity</td>
										   <td align="center">Unit</td>
										</tr>
									   <?php
										$part2=$formFunctions->executeQuery($dept,"SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
										$num = $part2->num_rows;
										if($num>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["name"]; ?>" id="textB<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["quantity"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_2["unit"]; ?>" id="textD<?php echo $count;?>"  class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
										<tr>
											<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input id="textB1" size="20"   class="form-control text-uppercase" name="textB1"></td>
											<td><input  id="textC1" size="20" class="form-control text-uppercase" validate="onlyNumbers" name="textC1"></td>
											<td><input id="textD1" size="20"   class="form-control text-uppercase" name="textD1"></td>			
										</tr>
									<?php } ?>
									<tbody>
									</table>
									</td>
								</tr>
								<tr>
									<td colspan="4">
										<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction2()" value="">Delete</button>
										<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore2()" value="">Add More</button>
										<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
									</td>
								</tr>
								<tr>										
									<td class="text-center" colspan="4">
										<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary text-bold">Go Back & Edit</a>
										<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
								</table>
							</form>
						</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
								<tr>
									<td colspan="4">16. Employment : 
										<table class="table table-responsive">
											<tr>
												<th >&nbsp;</th>
												<th>Male</th>
												<th > Female </th>
											</tr>
											<tr>
												<td > 1.Management and Office Staff </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[staff1]" value="<?php echo $expected_staff1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[staff2]" value="<?php echo $expected_staff2;?>"></td>
											</tr>
											<tr>
												<td > 2.Supervisory </td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[supervisory1]" value="<?php echo $expected_supervisory1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[supervisory2]" value="<?php echo $expected_supervisory2;?>"></td>
											</tr>
											<tr>
												<td >3.Workers</td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[workers1]" value="<?php echo $expected_workers1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="expected[workers2]" value="<?php echo $expected_workers2;?>"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td >17. Total annual turnover (in Rupees) :</td>
									<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="annual_rupees" value="<?php echo $annual_rupees;?>"></td>
									<td>18. Export if any (in Rupees)  :</td>
									<td><input  type="text" class="form-control text-uppercase" validate="onlyNumbers" name="export_rupees" value="<?php echo $export_rupees;?>"></td>
								</tr>
									<tr>
										<td colspan=4>19. Entrepreneurs' Profile(of all Partners/Directors of the organisation):</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Partners/Directors Name</th>
												<th width="10%" >Gender</th>
												<th width="10%">Caste</th>
												<th width="10%">Knowledge-Level</th>
												<th width="10%">Equity Participation(In Rs)</th>
												<th width="10%">Percentage of total Equity</th>
												<th width="10%">Stake in other Manufacturing Enterprises<span class="mandatory_field">*</span> </th>
											</tr>
										</thead>	
											<?php 
										$member_results=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'") ;
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td>
												<select name="gender<?php echo $i;?>" class="form-control text-uppercase"> 
													<option value="M">Male</option>
													<option value="F">Female</option>
												</select></td>
												<td><select name="caste<?php echo $i;?>" class="form-control text-uppercase"> 
													<option value="ST">ST</option>
													<option value="SC">SC</option>
													<option value="O">OBC</option>
													<option value="OT">Other</option>
													<option value="PC">Physically Challenged </option>
												</select></td>
												<td><select name="edu<?php echo $i;?>"class="form-control text-uppercase"> 
													<option value="TG">Technical Graduate</option>
													<option value="MG">Management Graduate</option>
													<option value="PG">Post Graduate</option>
													<option value="OG">Other Graduate</option>
													<option value="UG">Under Graduate</option>
													<option value="OL">Any other lower</option>
												</select></td>
												<td><input type="text" name="equity_rs<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers"  value="" /></td>
												<td><input type="text" name="equity_per<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers"  value="" /></td>
												<td><label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>" value="Y"  <?php if(isset($is_stack) && $is_stack=='Y') echo 'checked'; ?> required="required" /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>"  value="N"  <?php if(isset($is_stack) && $is_stack=='N') echo 'checked'; ?>/> No</label></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><select name="gender<?php echo $i;?>" class="form-control text-uppercase"> 
													<option <?php if($rows->gender=="M") echo "selected"; ?> value="M">Male</option>
													<option <?php if($rows->gender=="F") echo "selected"; ?> value="F">Female</option>
												</select></td>
												<td><select name="caste<?php echo $i;?>" class="form-control text-uppercase"> 
													<option <?php if($rows->caste=="ST") echo "selected"; ?> value="ST">ST</option>
													<option <?php if($rows->caste=="SC") echo "selected"; ?> value="SC">SC</option>
													<option <?php if($rows->caste=="O") echo "selected"; ?> value="O">OBC</option>
													<option <?php if($rows->caste=="OT") echo "selected"; ?> value="OT">Other</option>
													<option <?php if($rows->caste=="PC") echo "selected"; ?> value="PC">Physically Challenged </option>
												</select></td>
												<td><select name="edu<?php echo $i;?>"class="form-control text-uppercase"> 
													<option <?php if($rows->edu=="TG") echo "selected"; ?> value="TG">Technical Graduate</option>
													<option <?php if($rows->edu=="MG") echo "selected"; ?> value="MG">Management Graduate</option>
													<option <?php if($rows->edu=="PG") echo "selected"; ?> value="PG">Post Graduate</option>
													<option <?php if($rows->edu=="OG") echo "selected"; ?> value="OG">Other Graduate</option>
													<option <?php if($rows->edu=="UG") echo "selected"; ?> value="UG">Under Graduate</option>
													<option <?php if($rows->edu=="OL") echo "selected"; ?> value="OL">Any other lower</option>
												</select></td>
												<td><input type="text" name="equity_rs<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->equity_rs; ?>"/></td>
												<td><input type="text" name="equity_per<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->equity_per; ?>"/></td>
												<td><label class="radio-inline"><input required type="radio" name="is_stack<?php echo $i;?>" value="Y"  <?php if($rows->is_stack=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>"  value="N"  <?php if($rows->is_stack=='N') echo 'checked'; ?> /> No</label></td>
											</tr>
										<?php $i++;
										} ?>
											<input type="hidden" name="hidden_value" value="<?php echo $member_results->num_rows; ?>"/>
										<?php } ?>									
										</td>
										</tr>
										</table></td>
									</tr>
									<tr>
										<td >20. Expected Schedule of Commencement of Production :</td>
										<td ><input type="text" class="dobindia form-control text-uppercase" required="required" name="expect_date" value="<?php if($expect_date!="0000-00-00" && $expect_date!="") echo date("d-m-Y",strtotime($expect_date)); else echo "";?>" placeholder="DD-MM-YYYY" readonly="readonly"></td>
										<td >21. Whether the Unit has Computer :</td>
										<td ><input required type="radio" name="is_unit_computer" value="Y" <?php if($is_unit_computer=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_unit_computer" value="N" <?php if($is_unit_computer=="N") echo "checked"; ?> /> No</td>
									</tr>
									<tr>
										<td >Date :<b><?php echo date('d-m-Y',strtotime($today)); ?></b> <br/> Place :<label><?php echo strtoupper($dist);?> </label></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr><td class="text-center" colspan="4"></td></tr>
									<tr>										
										<td class="text-center" colspan="4">
											<a href="<?php echo $table_name;?>.php?tab=2" type="button" class="btn btn-primary text-bold">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>