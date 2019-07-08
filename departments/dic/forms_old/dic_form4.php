<?php require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','4');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=4&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=4&dept=dic';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dic_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$l_o_business=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative Society";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	$gender="";$caste="";$edu="";$equity_rs="";$equity_per="";$is_stack="";
	$q=$dic->query("select * from dic_form4 where user_id='$swr_id'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$file1="";$file2="";$file3="";$file4="";
		#### Part A #######
		$nature="";$ancillary="";$installation_date="";$fact_act="";$area_r="";$is_unit_computer="";
		#### Part B #######
		$cat_enter="";
		$manuf_code="";$manuf_name="";
		$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
		$power_unit="";$power_load="";
		$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
		##### Part C ######
		$export_rupees="";$annual_rupees="";$expect_date="";$is_unit_computer="";
		$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}else{
		$form_id=$results['form_id'];	
		$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];
		#### Part A #######
		$nature=$results['nature'];$ancillary=$results['ancillary'];$installation_date=$results['installation_date'];$fact_act=$results['fact_act'];$area_r=$results['area_r'];$is_unit_computer=$results['is_unit_computer'];
		#### Part B #######
		$cat_enter=$results['cat_enter'];
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
			$source_reason=$source->reason;
			if(isset($source->a)) $source_a=$source->a; else $source_a="";
			if(isset($source->b)) $source_b=$source->b; else $source_b="";
			if(isset($source->c)) $source_c=$source->c; else $source_c="";
			if(isset($source->d)) $source_d=$source->d; else $source_d="";
			if(isset($source->e)) $source_e=$source->e; else $source_e="";
			if(isset($source->f)) $source_f=$source->f; else $source_f="";
			if(isset($source->g)) $source_g=$source->g; else $source_g="";
			if(isset($source->h)) $source_f=$source->h; else $source_h="";
		}else{
			$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
		}	
		##### Part C########
		$annual_rupees=$results['annual_rupees'];$export_rupees=$results['export_rupees'];$expect_date=$results['expect_date'];$is_unit_computer=$results['is_unit_computer'];
		if(!empty($results["expected"]))
		{
			$expected=json_decode($results["expected"]);
			$expected_staff1=$expected->staff1;$expected_staff2=$expected->staff2;
			$expected_supervisory1=$expected->supervisory1;$expected_supervisory2=$expected->supervisory2;
			$expected_workers1=$expected->workers1;$expected_workers2=$expected->workers2;
		}else{
			$expected_staff1="";$expected_staff2="";$expected_supervisory1="";$expected_supervisory2="";$expected_workers1="";$expected_workers2="";
		}	
		$q1=$dic->query("select * from dic_form1 where user_id='$swr_id'") or die($dic->error);
		$results1=$q1->fetch_assoc();
		{
			$em1=$results1['uain'];$dt_em1=$results1['sub_date'];
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
	}
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==6){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="active";$tabbtn7="";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==7){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="active";$tabbtn8="";$tabbtn9="";
	}
	if($showtab==8){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="active";$tabbtn9="";
	}
	if($showtab==9){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn10="active";
	}
	if($showtab==10){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";$tabbtn7="";$tabbtn8="";$tabbtn9="";$tabbtn10="active";
	}
	##PHP TAB management ends
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
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
		}
	</style>
	<?php include ("dic_form4_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
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
								<h4 class="text-center"><strong><?php echo $form_name=$formFunctions->get_formName('dic','4'); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">PART II</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">PART III</a></li>
								  <li class="<?php echo $tabbtn4; ?>"><a href="#table4">Upload section</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td >A. ENTERPRENEURS MEMORANDUM NUMBER(Part 1) :<br/>(If you already filed EM1, please mention the acknowledge number) </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $em1;?>"></td>
										<td>B. Date of Issue EM Part1:  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $dt_em1;?>"></td>
									</tr>								
									<tr>
									    <td >1. Name of Applicant :   </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $key_person;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">2. a). Address of Communication  :  </td>					
									</tr>
									<tr>
										<td width="25%">Street Name 1</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name3;?>"></td>
										<td width="25%">Street Name 2</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name4;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill2;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist2;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode2;?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no2;?>"></td>
									</tr>
									<tr>
										<td colspan="4">2. b). Permanent Residential Address (Main Applicant) :   </td>					
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
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $mobile_no;?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email;?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td >3. Name of Enterprise :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td colspan="4">4. Location of Enterprise:  </td>					
									</tr>
									<tr>
										<td width="25%"> i. Village/Town :  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1;?>"></td>
										<td width="25%">Code :  </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td> ii. Sub-Division :  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill;?>"></td>
										<td>Code : </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td> iii. District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td> Code :</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td> iv. State : </td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
										<td>code :</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
									</tr>		
									<tr>
										<td> v. PIN Code :  </td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
										<td> vi. Area :  </td>
										<td><select name="area_r" class="form-control text-uppercase">
											<option value=" " readonly>Select Area</option>
											<option value="R" <?php if($area_r=="R") echo "selected";?> >Rural</option>
											<option value="U" <?php if($area_r=="R") echo "selected";?> >Urban</option>
										</select>
										</td>
									</tr>	
									<tr>
										<td>5. Nature of Activity :  </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled"value="<?php echo $business_type; ?>"></td>
										<td>6. Nature of Operation :</td>
										<td><select class="form-control text-uppercase" name="nature">
											<option value=" " >Select</option>
											<option value="P" <?php if($nature=="P") echo "selected";?> >Perennial</option>
											<option value="S" <?php if($nature=="S") echo "selected";?>>Seasonal</option>
											<option value="C" <?php if($nature=="C") echo "selected";?> >Casual</option>
										</select></td>
									</tr>	
									<tr>
										<td>7. Whether the Unit will be an Ancillary :   </td>
										<td><input type="radio" name="ancillary" value="Y" <?php if($ancillary=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="ancillary" value="N" <?php if($ancillary=="N" || $ancillary=="") echo "checked"; ?> /> No</td>
										<td>8. Month & year of installation of plant & machinery :</td>
										<td><input type="text" class="form-control text-uppercase" name="installation_date" required="required" value="<?php echo $installation_date;?>"></td>
									</tr>		
									<tr>
										<td>9. Whether Unit is Registered under Factory Act :  </td>
										<td><input type="radio" name="fact_act" value="i" <?php if($fact_act=="Y") echo "checked"; ?> /> Under Section 2m (i) 2m/(ii) </td>
										<td><input type="radio" name="fact_act" value="ii" <?php if($fact_act=="N" || $fact_act=="") echo "checked"; ?> /> 85/(iii) </td>
										<td><input type="radio" name="fact_act" value="NR" <?php if($fact_act=="N" || $fact_act=="") echo "checked"; ?> /> Not Registered </td>
									</tr>	
									<tr>
										<td>10. Type of Organization :   </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>																				
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save4a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
						<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
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
										$part1=$dic->query("SELECT * FROM dic_form4_t1 WHERE form_id='$form_id'");
										$num = $part1->num_rows;
										if($num>0){
										  $count=1;
										  while($row_1=$part1->fetch_array()){	?>
										<tr>
											<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_1["name"]; ?>" id="txtB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["code"]; ?>" validate="onlyNumbers" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_1["quantity"]; ?>" id="txtd<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="txtD<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_1["unit"]; ?>" validate="onlyNumbers" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="20"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
									<tr>
										<td><input value="1" readonly id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
										<td><input id="txtB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtB1"></td>					
										<td><input  id="txtC1" size="20" class="form-control text-uppercase"  name="txtC1"></td>
										<td><input id="txtD1" size="20" validate="specialChar"  class="form-control text-uppercase" name="txtD1"></td>					
										<td><input  id="txtE1" size="20" class="form-control text-uppercase"  name="txtE1"></td>
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
										<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval4; ?>"/>
									</td>
								</tr>
								<tr>
									<td colspan="4">12.  Investment in Fixed Assets [In Rupees] :</td>
								</tr>
								<tr>
									<td> (i) Land :</td>
									<td><select class="form-control text-uppercase" name="fixed_asset[land]" >
										<option value=" ">Select</option>
										<option value="O" <?php if($fixed_asset_land=="O") echo "selected"; ?>>Owned</option>
										<option value="R" <?php if($fixed_asset_land=="R") echo "selected"; ?>>Rented</option>
										<option value="L" <?php if($fixed_asset_land=="L") echo "selected"; ?>>Leased</option>
									</select></td>
									<td> Approximate Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[land_approx]" value="<?php echo $fixed_asset_land_approx;?>"></td>
								</tr>
								<tr>
									<td>(ii) Building  :</td>
									<td><select class="form-control text-uppercase" name="fixed_asset[building]" >
										<option value=" ">Select</option>
										<option value="O" <?php if($fixed_asset_building=="O") echo "selected"; ?>>Owned</option>
										<option value="R" <?php if($fixed_asset_building=="R") echo "selected"; ?>>Rented</option>
										<option value="L" <?php if($fixed_asset_building=="L") echo "selected"; ?>>Leased</option>
									</select></td>
									<td> Approximate Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[building_approx]" value="<?php echo $fixed_asset_building_approx;?>"></td>
								</tr>
								<tr>
									<td>(iii) Plant & Machinery (in case of manufacturing  enterprise) Value :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="fixed_asset[plant_approx]" min="1000" value="<?php echo$fixed_asset_plant_approx;?>"></td>
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
									<td> 14. Power Load (Anticipated):</td>
									<td class="form-inline">
									<input  type="text" class="form-control text-uppercase" requried="requried" name="power[load]" style="width:150px;" value="<?php echo $power_load;?>"> 
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit" value="HP" <?php if($power_unit=='HP') echo 'checked'; ?> > HP </label>
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit"value="KW" <?php if($power_unit=='KW') echo 'checked'; ?> />&nbsp;KW </label></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">15.(a) (i). Other Source of Energy/Power (if required):   </td>
								</tr>
								<tr>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[a]" id="source_a" value="a" <?php if($source_a=='a') echo 'checked'; ?> >No Power Needed </label></td>
									<td><label class="checkbox-inline"><input type="checkbox"  name="source[b]" id="source_b"value="b" <?php if($source_b=='b') echo 'checked'; ?> />&nbsp;Coal </label>  </td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[c]" id="source_c" value="c" <?php if($source_c=='c') echo 'checked'; ?> > OIL </label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[d]" id="source_d"value="d" <?php if($source_d=='d') echo 'checked'; ?> />&nbsp;Liquid Petrolium Gas </label></td>
								</tr>
								<tr>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[e]" id="source_e" value="e" <?php if($source_e=='e') echo 'checked'; ?> >Electricity from Grid</label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[f]" id="source_f"value="f" <?php if($source_f=='f') echo 'checked'; ?> />&nbsp;Electricity from Generator </label> </td> 
									<td><label class="checkbox-inline"><input type="checkbox" name="source[g]" id="source_g" value="g" <?php if($source_g=='g') echo 'checked'; ?> > Non Conventional Energy  </label></td>
									<td><label class="checkbox-inline"><input type="checkbox" name="source[h]" id="source_h"value="h" <?php if($source_h=='h') echo 'checked'; ?> />&nbsp;Traditional Energy </label>
									</td>
								</tr>
								<tr>
									<td > (ii). If no power required, specify reasons :  </td>
									<td><input  type="text" class="form-control text-uppercase"  name="source[reason]" value="<?php echo $source_reason;?>"></td>
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
										$part2=$dic->query("SELECT * FROM dic_form4_t2 WHERE form_id='$form_id'");
										$num = $part2->num_rows;
										if($num>0){
										  $count=1;
										  while($row_2=$part2->fetch_array()){	?>
										<tr>
											<td><input readonly id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
											<td><input value="<?php echo $row_2["name"]; ?>" id="textB<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textB<?php echo $count;?>"></td>
											<td><input value="<?php echo $row_2["quantity"]; ?>" validate="onlyNumbers" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="20"></td>
											<td><input value="<?php echo $row_2["unit"]; ?>" id="textD<?php echo $count;?>" validate="specialChar" class="form-control text-uppercase" size="20" name="textD<?php echo $count;?>"></td>				
										</tr>	
									<?php $count++; } 
									}else{	?>
										<tr>
											<td><input value="1" readonly id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
											<td><input id="textB1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textB1"></td>
											<td><input  id="textC1" size="20" class="form-control text-uppercase"  name="textC1"></td>
											<td><input id="textD1" size="20" validate="specialChar"  class="form-control text-uppercase" name="textD1"></td>			
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
										<button type="submit" class="btn btn-success" name="save4b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
								</table>
							</form>
						</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
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
												<td><input  type="text" class="form-control text-uppercase"  name="expected[staff1]" value="<?php echo $expected_staff1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="expected[staff2]" value="<?php echo $expected_staff2;?>"></td>
											</tr>
											<tr>
												<td > 2.Supervisory </td>
												<td><input  type="text" class="form-control text-uppercase"  name="expected[supervisory1]" value="<?php echo $expected_supervisory1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="expected[supervisory2]" value="<?php echo $expected_supervisory2;?>"></td>
											</tr>
											<tr>
												<td >3.Workers</td>
												<td><input  type="text" class="form-control text-uppercase"  name="expected[workers1]" value="<?php echo $expected_workers1;?>"></td>
												<td><input  type="text" class="form-control text-uppercase"  name="expected[workers2]" value="<?php echo $expected_workers2;?>"></td>
											</tr>
										</table>
									</td>
								</tr>
								<tr>
									<td >17. Total annual turnover (in Rupees) :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="annual_rupees" value="<?php echo $annual_rupees;?>"></td>
									<td>18. Export if any (in Rupees)  :</td>
									<td><input  type="text" class="form-control text-uppercase"  name="export_rupees" value="<?php echo $export_rupees;?>"></td>
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
												<th width="10%">Stake in other Manufacturing Enterprises</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$dic->query("select * from dic_form4_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
												<td><input type="text" name="equity_rs<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $equity_rs; ?>" ></td>
												<td><input type="text" name="equity_per<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $equity_per; ?>" ></td>
												<td><label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>" value="Y"  <?php if(isset($is_stack) && $is_stack=='Y') echo 'checked'; ?> /> Yes</label>
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
												<td><label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>" value="Y"  <?php if($rows->is_stack=='Y') echo 'checked'; ?> /> Yes</label>
												<label class="radio-inline"><input type="radio" name="is_stack<?php echo $i;?>"  value="N"  <?php if($rows->is_stack=='N') echo 'checked'; ?>/> No</label></td>
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
										<td ><input type="text" class="dob form-control text-uppercase" requried="requried" name="expect_date" value="<?php echo $expect_date;?>"></td>
										<td >21. Whether the Unit has Computer :</td>
										<td ><input type="radio" name="is_unit_computer" value="Y" <?php if($is_unit_computer=="Y") echo "checked"; ?> /> Yes &nbsp;&nbsp; <input type="radio" name="is_unit_computer" value="N" <?php if($is_unit_computer=="N" || $is_unit_computer=="") echo "checked"; ?> /> No</td>
									</tr>
									<tr>
										<td >Date :<b><?php echo $today; ?></b> <br/> Place :<label><?php echo $dist;?> </label></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr><td class="text-center" colspan="4"></td></tr>
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save4c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
							</form>
						</div>
						<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
						<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
						<table class="table table-responsive">
							<tr>
									<td colspan="4">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
								</tr>							
								<tr>
									<td colspan="5"> Constitution of the unit.</td>
								<tr>
									<td>(a) In case of Private Limited / Public Limited Company<br/>
									i. Registration Certificate under Companies Act<br/>ii. Memorandum of Article of Association<br/>iii. Names and address of the Directors with their PAN number<br/> (b) In case of Partnership Firm<br/>i. Deed of Partnership<br/> ii. General Power of Attorney<br/>iii. Names & address of the Partners with their PAN number<br/>    (c) In case of Co-operative Society<br/> i. Registration Certificate from the Jt. Register of Co-operative Society<br/> ii. Resolution of the General Body for registration of the unit<br/>iii. Article of memorandum of Association</td>
									<td width="10%">
									<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
									</td>
									<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</input></td>
									<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td colspan="4"> Registration</td>									
								</tr>
								<tr>
									<td> A copy of Entrepreneurs Memorandum Part I /Provisional Registration Certificate, a copy IEM issued by SIA in case of conversion to EM part-II (as applicable)</td>
									<td><select trigger="FileModal" class="file2" id="file2" <?php if($file2!="" || $file2=="SC" || $file2=="NA") echo "disabled='disabled'"; ?> >
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile2" value="<?php if($file2!="") echo $file2; ?>" id="mfile2" readonly="readonly"/></td>
									<td width="20%" id="mfile2-chiranjit"><?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file2" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo 'No File Selected'; } ?></td>
									<td><input type="CheckBox" id="B1" class="file2" name="B1" <?php if($file2=="NA") echo "checked"; ?> <?php if($file2!="" && $file2!="NA") echo "disabled='disabled'"; ?> value='B1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="B2" class="file2 cd" name="B2" <?php if($file2=="SC") echo "checked"; ?> <?php if($file2!="" && $file2!="SC") echo "disabled='disabled'"; ?> value='B2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td colspan="5"> Land & Building</td>
								</tr>
								<tr>
									<td>a) In case of own land<br/>i. Purchase deed / gift deed/any other document to establish the ownership wherever applicable<br/>ii. Upto date non-incumbent certificate wherever applicable<br/>iii. Jamabandi copy and trace map wherever applicable<br/>b) In case of Industrial land/plot allotted by any Government Agency<br/>i. Deed of agreement<br/>ii. Up to date rent payment receipt <br/>c) In case of Industrial shed/s allotted by any Government Agency<br/>i. Deed of agreement<br/>ii. Up to date rent payment receipt wherever applicable. d) In case of leasehold land from a private owner <br/>Lease deed agreement <br/>e) In case of Government land/plot allotted by Government<br/>i. Allotment letter<br/>ii. Premium payment receipt wherever applicable </td>
									<td><select trigger="FileModal" class="file3" id="file3" <?php if($file3!="" || $file3=="SC" || $file3=="NA") echo "disabled='disabled'"; ?>>
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile3" value="<?php if($file3!="") echo $file3; ?>" id="mfile3" readonly="readonly"/></td>
									<td width="20%" id="mfile3-chiranjit"><?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file3" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="C1"  class="file3" name="C1" <?php if($file3=="NA") echo "checked"; ?> <?php if($file3!="" && $file3!="NA") echo "disabled='disabled'"; ?> value='C1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="C2" class="file3 cd" name="C2" <?php if($file3=="SC") echo "checked"; ?> <?php if($file3!="" && $file3!="SC") echo "disabled='disabled'"; ?> value='C2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>
									<td>Statement of Plant and Machinery as per Annexure-A</td>
									<td><select trigger="FileModal" class="file4" id="file4" <?php if($file4!="" || $file4=="SC" || $file4=="NA") echo "disabled='disabled'"; ?> >
										<option value="0" selected="selected">Select</option>
										<option value="1">From E-Locker</option>
										<option value="2">From PC</option>
									</select>
									<input type="hidden" name="mfile4" value="<?php if($file4!="") echo $file4; ?>" id="mfile4" readonly="readonly"/></td>
									<td width="20%" id="mfile4-chiranjit"><?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file4" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
									<td><input type="CheckBox" id="D1" class="file4" name="D1" <?php if($file4=="NA") echo "checked"; ?> <?php if($file4!="" && $file4!="NA") echo "disabled='disabled'"; ?> value='D1' onClick="checkData(this)">N/A</input></td>
									<td><input type="CheckBox" id="D2" class="file4 cd" name="D2" <?php if($file4=="SC") echo "checked"; ?> <?php if($file4!="" && $file4!="SC") echo "disabled='disabled'"; ?> value='D2' onClick="checkData(this)">S/C</input></td>
								</tr>
								<tr>							
									<td class="text-center" colspan="4">
										<a href="dic_form4.php?tab=3"><button type="button" class="btn btn-primary text-bold">Go Back & Edit</button></a>	
										<button type="submit" class="btn btn-success" name="save4d" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
									</td>							
								</tr>
						</table>
			
					</div>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>