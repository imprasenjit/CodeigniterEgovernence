<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dic','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dic';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=dic';
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
	$q=$dic->query("select * from dic_form1 where user_id='$swr_id'") or die($dic->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$nature="";$ancillary="";$installation_date="";$cat_enter="";$expect_date="";
		$manuf_code="";$manuf_name="";
		$fixed_asset_land="";$fixed_asset_land_approx="";$fixed_asset_building_approx="";$fixed_asset_building="";$fixed_asset_plant_approx="";$fixed_asset_equity_approx="";$fixed_asset_euipment_approx="";
		$power_unit="";$power_load="";
		$source_a="";$source_b="";$source_c="";$source_d="";$source_e="";$source_f="";$source_g="";$source_h="";$source_reason="";
		$expected_staff="";$expected_supervisory="";$expected_workers="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}else{
		$form_id=$results['form_id'];	
		$nature=$results['nature'];$ancillary=$results['ancillary'];$installation_date=$results['installation_date'];$cat_enter=$results['cat_enter'];$expect_date=$results['expect_date'];
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
			$fixed_asset_plant_approx=$fixed_asset->plant_approx;$fixed_asset_building_approx=$fixed_asset->building_approx;$fixed_asset_land=$fixed_asset->land;$fixed_asset_land_approx=$fixed_asset->land_approx;
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
		if(!empty($results["expected"]))
		{
			$expected=json_decode($results["expected"]);
			$expected_staff=$expected->staff;$expected_supervisory=$expected->supervisory;$expected_workers=$expected->workers;
		}else{
			$expected_staff="";$expected_supervisory="";$expected_workers="";
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
	<?php include ("dic_form1_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
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
								<h4 class="text-center"><strong><?php echo $form_name=$formFunctions->get_formName('dic','1'); ?></strong></h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Part 1</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
									<li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive ">									
									<tr>
									    <td >1. Name of the Applicant : </td>
										<td ><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $key_person;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td colspan="4">2. a). Address of Communication :  </td>					
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
										<td >3. Name of Proposed Enterprise :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name;?>"></td>
										<td></td>
										<td></td>
									</tr>
									
									<tr>
										<td colspan="4">4. Proposed Location of Enterprise:  </td>					
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
										<td>Block</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block;?>"></td>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_pincode;?>"></td>
									</tr>	
									<tr>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled"value="<?php echo $b_mobile_no;?>"></td>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $b_email;?>"></td>
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
										<td>8. Proposed month & year of installation of plant & machinery :</td>
										<td><input type="text" class="dob form-control text-uppercase" name="installation_date" required="required" value="<?php echo $installation_date;?>"></td>
									</tr>	
									<tr>
										<td>9. Type of Organization :   </td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $l_o_business_val;?>"></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>																				
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save1a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
										</td>									
									</tr>
								</table>
								</form>
								</div>
						<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
									<tr>
										<td colspan="4">10. (a). Main Manufacturing/Service Activity : </td>
									</tr>
									<tr>
										<td width="25%">Name :</td>
										<td width="25%"><input type="text" class=" form-control text-uppercase" name="manuf[name]" requried="required" value="<?php echo $manuf_name;?>" ></td>
										<td width="25%">Code (NIC2004) :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" name="manuf[code]" requried="required" value="<?php echo $manuf_code;?>" ></td>
									</tr>
									<tr>
										<td colspan="4"> (b). Products To Be Manufactured/Services To Be Provided : <br/><i>(<font color="red">*</font>) Codes for activities and production/services as per classification specified from time to time by the Development Commissioner (Small Scale Industries), Govt. of India to be filled in by the District Industries Centre or the office where the Entrepreneur's memorandum is subimitted.</i></td>
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
											$part1=$dic->query("SELECT * FROM dic_form1_t1 WHERE form_id='$form_id'");
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
									<td colspan="4">11. Proposed Investment in Fixed Assets [In Rupees]: <br/>(eg. For 2 Lakhs write as 200000 without using any comma) :</td>
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
									<td>12. Category of Enterprise :   </td>
									<td><input  type="text" class="form-control text-uppercase"  name="cat_enter" min="1000" value="<?php echo $cat_enter;?>"></td>
									<td> 13. Power Load (Anticipated):</td>
									<td class="form-inline">
									<input  type="text" class="form-control text-uppercase" requried="requried" name="power[load]" style="width:150px;" value="<?php echo $power_load;?>"> 
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit" value="HP" <?php if($power_unit=='HP') echo 'checked'; ?> > HP </label>
									<label class="radio-inline"><input type="radio" name="power[unit]" id="power_unit"value="KW" <?php if($power_unit=='KW') echo 'checked'; ?> />&nbsp;KW </label></td>
								</tr>
								<tr><td class="text-center" colspan="4"></td></tr>
								<tr>										
									<td class="text-center" colspan="4">
										<button type="submit" class="btn btn-success" name="save1b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
									</td>									
								</tr>
								</table>
							</form>
						</div>
						<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">									
								<table class="table table-responsive table-bordered">
								
								<tr>
									<td colspan="4" class="form-inline">14.(a) (i). Other Source of Energy/Power (if required):   </td>
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
										$part2=$dic->query("SELECT * FROM dic_form1_t2 WHERE form_id='$form_id'");
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
									<td colspan="4">15. Expected Employment :  </td>
								</tr>
								<tr>
									<td > 1.Management and Office Staff </td>
									<td><input  type="text" class="form-control text-uppercase"  name="expected[staff]" value="<?php echo $expected_staff;?>"></td>
									<td > 2.Supervisory </td>
									<td><input  type="text" class="form-control text-uppercase"  name="expected[supervisory]" value="<?php echo $expected_supervisory;?>"></td>
								</tr>
								<tr>
									<td >3.Workers</td>
									<td><input  type="text" class="form-control text-uppercase"  name="expected[workers]" value="<?php echo $expected_workers;?>"></td>
									<td> &nbsp;</td>
									<td>&nbsp;</td>
								</tr>
									<tr>
										<td colspan=4>16. Entrepreneurs' Profile(of all Partners/Directors of the organisation):</td>
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
										$member_results=$dic->query("select * from dic_form1_members where form_id='$form_id'") or die("Error : ".$dic->error);
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
										<td colspan="3">17. Expected Schedule of Commencement of Production :</td>
										<td ><input type="text" class="dob form-control text-uppercase" requried="requried" name="expect_date" value="<?php echo $expect_date;?>"></td>
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
											<button type="submit" class="btn btn-success" name="save1c" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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