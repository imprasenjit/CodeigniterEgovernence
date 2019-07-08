<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="1";
$table_name=$formFunctions->getTableName($dept,$form);

$check=$formFunctions->is_already_registered($dept,$form);
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=".$form."&dept=".$dept."';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=".$form."&dept=".$dept."';
		</script>";
}else if($check==3){
	echo "<script>
			window.location.href = '".$server_url."departments/requires/payment_section.php?form=".$form."&dept=".$dept."';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$owner_type=$row1['Type_of_ownership'];$date_of_commencement=$row1['date_of_commencement'];
	$business_type=$row1["sector_classes_b"];	
	$business_type=get_sector_classes_b_value($business_type);
	
	$q=$labour->query("select * from ".$table_name." where user_id='$swr_id' and active='1'") or die($labour->error);
	if($q->num_rows<1){			
		$form_id="";$situation_office="";$situation_storeroom="";$situation_godown="";$situation_warehouse="";$manager_name="";$m_street_name1="";$m_street_name2="";$m_vill="";$m_dist="";$m_pin="";$estab_category="";$max_workers="0"; $nature_business=""; $date_business="";	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$manager_name=$results["manager_name"];$estab_category=$results["estab_category"];$max_workers=$results["max_workers"];
	
		if(!empty($results["situation"])){				
			$situation=json_decode($results["situation"]);
			$situation_office=$situation->office;$situation_storeroom=$situation->storeroom;$situation_godown=$situation->godown;$situation_warehouse=$situation->warehouse;				
		}else{
			$situation_office="";$situation_storeroom="";$situation_godown="";$situation_warehouse="";
		}
		if(!empty($results["manager_address"])){				
			$manager_address=json_decode($results["manager_address"]);
			$m_street_name1=$manager_address->sn1;$m_street_name2=$manager_address->sn2;$m_vill=$manager_address->vill;$m_dist=$manager_address->dist;$m_pin=$manager_address->pin;				
		}else{
			$m_street_name1="";$m_street_name2="";$m_vill="";$m_dist="";$m_pin="";
		}			
	}
##PHP TAB management
$showtab=isset($_GET['tab'])?$_GET['tab']:"";

$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";
if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
	$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";
}
if($showtab==2){
	$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";
}
if($showtab==3){
	$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";
}
if($showtab==4){
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";
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
	</style>
	<?php include ("lc_reg_form".$form."_Addmore-operation.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
	<div id="loader" class="loader" style="display:none;"></div>
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
								<h4 class="text-center" >
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">Part 2</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a href="#table3">Part 3</a></li>
								  <li class="<?php echo $tabbtn4; ?>"><a href="#table4">Part 4</a></li>
								</ul> <br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
										<form name="myform1" class="submit1" id="myformHW1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
											<table class="table table-responsive">
												<tr>
													<td width="25%">Name of Establishment, if any:</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
													<td colspan="2"></td>
												</tr> 
												<tr>
													<td colspan="4">Postal Address and exact location of the Establishment :</td>
												</tr>
												<tr>
													<td width="25%">Street Name 1</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
													<td width="25%">Street Name 2</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
												</tr>
												<tr>
													<td>Village/Town</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>
													<td>District</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
												</tr>
												<tr>
													<td>Pincode</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
													<td></td>
													<td></td>
												</tr>									
												<tr>
													<td colspan="4">Situation of Office, store-room, godown, warehouse or work place, if any, attached to the establishment but situated in premises different from those of the establishment </td>
												</tr>
												<tr>
													<td>(a) Office</td>
													<td><textarea class="form-control text-uppercase" name="situation[office]" id="office" validate="jsonObj"><?php echo $situation_office; ?></textarea></td>
													<td>(b) Store Room</td>
													<td><textarea class="form-control text-uppercase" name="situation[storeroom]" id="storeroom" validate="jsonObj"><?php echo $situation_storeroom; ?></textarea></td>
												</tr>
												<tr>
													<td>(c) Godown </td>
													<td><textarea class="form-control text-uppercase" name="situation[godown]" id="godown" validate="jsonObj"><?php echo $situation_godown;?></textarea></td>
													<td>(d) Warehouse or Work Place</td>
													<td><textarea class="form-control text-uppercase" name="situation[warehouse]" id="warehouse" validate="jsonObj"><?php echo $situation_warehouse; ?></textarea></td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">
														<button type="submit" class="btn btn-success submit1"  name="save<?php echo $form;?>a" title="Save it and Go to the next part" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
													</td>
												</tr>
											</table>
										</form>
									</div>
									<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
										<form name="myform1" id="myformHW1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
											<table class="table table-responsive">
												<tr>
													<td width="25%">Name of the Employer :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
													<td width="25%"></td>
													<td width="25%"></td>			
												</tr>
												<tr>
													<td colspan="4">Residential address of the Employer :</td>
												</tr>
												<tr>
													<td>Street Name 1</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1;?>"></td>
													<td>Street Name 2</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2;?>"></td>
												</tr>
												<tr>
													<td>Village/Town</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill;?>"></td>
													<td>District</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist;?>"></td>
												</tr>
												<tr>
													<td>Pincode</td>
													<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode;?>"></td>
													<td></td>
													<td></td>
												</tr>		
												<tr>
													<td colspan="4">Name of the Manager/Agent/other person acting in the general management, if any, and his address. :</td>
												</tr>
												<tr>
													<td>Full Name<span class="mandatory_field">*</span> </td>
													<td><input type="text" class="form-control text-uppercase" name= "manager_name" validate="letters" value="<?php echo $manager_name; ?>" required></td>
													<td>Street Name 1<span class="mandatory_field">*</span> </td>
													<td><input type="text" class="form-control text-uppercase" id="m_street_name1" name= "manager_address[sn1]" value="<?php echo $m_street_name1; ?>" required></td>
												</tr>
												<tr>
													<td>Street Name 2<span class="mandatory_field">*</span> </td>
													<td><input type="text" class="form-control text-uppercase"  id="m_street_name2" name= "manager_address[sn2]" value="<?php echo $m_street_name2; ?>" required ></td>
													<td>Village/Town<span class="mandatory_field">*</span> </td>
													<td><input type="text" class="form-control text-uppercase" id="m_vill" name= "manager_address[vill]" value="<?php echo $m_vill; ?>" required></td>
												</tr>
												<tr>
													<td>District</td>
													<td>
												 <?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
												<select name="manager_address[dist]" id="m_dist" class="form-control text-uppercase"><?php
													while($dstrows=$dstresult->fetch_object()) { 
													if($m_dist==strtoupper($dstrows->district)) $s='selected'; else $s=''; ?>
													<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
												<?php } ?>					
												</select></td>
													<td>Pincode<span class="mandatory_field">*</span> </td>
													<td><input type="text" class="form-control text-uppercase" maxlength="6" name="manager_address[pin]" validate="pincode" value="<?php echo $m_pin; ?>" required></td>
												</tr>
												<?php if($owner_type=="PP" || $owner_type=="LLP"){ ?>
												<tr>
												<td colspan="4">Name of partners and their residential addresses (if it is a partnership concern) :
													<table name="objectTable1" class="table table-responsive" id="objectTable1" >
														<tr >
															<td width="5%" height="35px" align="center">Sl No.</td>
															<td width="25%" align="center">Full Name</td>
															<td width="20%" align="center">Street Name 1</td>
															<td width="20%" align="center">Street Name 2</td>
															<td width="10%" align="center">Town/Vill</td>
															<td width="10%" align="center">District</td>
															<td width="10%" align="center">Pin Code</td>	
														</tr>				
														<?php
														$part1=$labour->query("SELECT * FROM ".$table_name."_t1 WHERE form_id='$form_id'");
														$num = $part1->num_rows;
														if($num>0){
														$count=1;
														while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["field1"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input type="text" value="<?php echo $row_1["field2"]; ?>" validate="letters" id="txtB<?php echo $count;?>" class="form-control text-uppercase" size="20" name="txtB<?php echo $count;?>"></td>
															<td><input type="text" value="<?php echo $row_1["field3"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>" size="15"></td>				
															<td><input type="text" value="<?php echo $row_1["field4"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>" size="15"></td>
															<td><input type="text" value="<?php echo $row_1["field5"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_1["field6"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"  size="10"></td>			
															<td><input type="text" value="<?php echo $row_1["field7"]; ?>" validate="pincode" maxlength="6" id="txtA<?php echo $count;?>" class="form-control text-uppercase" name="txtG<?php echo $count;?>" size="5" ></td>
														</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"/></td>
															<td><input type="text" id="txtB1" size="20" validate="letters" class="form-control text-uppercase" name="txtB1"></td>					
															<td><input type="text" id="txtC1" size="15" class="form-control text-uppercase"  name="txtC1"></td>
															<td><input type="text" id="txtD1" size="15" class="form-control text-uppercase" name="txtD1"></td>
															<td><input type="text" id="txtE1" size="10" class="form-control text-uppercase" name="txtE1"></td>
															<td><input type="text" id="txtF1"  size="10" class="form-control text-uppercase" name="txtF1"></td>
															<td><input type="text" id="txtG1" size="5" class="form-control text-uppercase" validate="pincode" maxlength="6" name="txtG1"></td>
														</tr>
														<?php } ?>
													</table>	
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
												</td>
											</tr>
											<?php  } ?>
											<tr>
												<td class="text-center" colspan="4">
													<a href="lc_reg_form<?php echo $form; ?>.php" type="submit" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit" name="save<?php echo $form;?>b" class="btn btn-success submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
									<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
										<form name="myform1" id="" method="post" class="submit1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" >
											<table class="table table-responsive">
											<?php if($owner_type=="PTLC" || $owner_type=="PBLC"){ ?>
												<tr>
													<td colspan="4">Names and residential addresses of Directors (if it is a case of limited company)
													<table name="objectTable2" class="table table-responsive" id="objectTable2" >
														<tr>
															<td >Sl. No.</td>
															<td >Full Name</td>
															<td >Street Name 1</td>
															<td >Street Name 2</td>
															<td >Town/Vill</td>
															<td >District</td>
															<td >Pin Code</td>
														</tr>
														<?php
															$part1=$labour->query("SELECT * FROM ".$table_name."_t2 WHERE form_id='$form_id'");
															$num = $part1->num_rows;
															if($num>0){
															  $count=1;
															  while($row_1=$part1->fetch_array()){	?>
															 <tr>
																<td><input readonly="readonly" id="textA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["field1"]; ?>" name="textA<?php echo $count;?>" size="1"></td>
																<td><input type="text" value="<?php echo $row_1["field2"]; ?>" id="textB<?php echo $count;?>" class="form-control text-uppercase" size="20" validate="letters" name="textB<?php echo $count;?>"></td>
																<td><input type="text" value="<?php echo $row_1["field3"]; ?>" id="textC<?php echo $count;?>" class="form-control text-uppercase" name="textC<?php echo $count;?>" size="15"></td>				
																<td><input type="text" value="<?php echo $row_1["field4"]; ?>" id="textD<?php echo $count;?>" class="form-control text-uppercase" name="textD<?php echo $count;?>" size="15"></td>
																<td><input type="text" value="<?php echo $row_1["field5"]; ?>" id="textE<?php echo $count;?>" class="form-control text-uppercase" name="textE<?php echo $count;?>" size="10"></td>
																<td><input type="text" value="<?php echo $row_1["field6"]; ?>" id="textF<?php echo $count;?>" class="form-control text-uppercase" name="textF<?php echo $count;?>"  size="10"></td>			
																<td><input type="text" value="<?php echo $row_1["field7"]; ?>" id="textA<?php echo $count;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" name="textG<?php echo $count;?>" size="5" ></td>
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
														  <td><input value="1" readonly="readonly" id="textA1" size="1" class="form-control text-uppercase" name="textA1"></td>
														  <td><input type="text" id="textB1" size="20" validate="letters" class="form-control text-uppercase" name="textB1"></td>					
														  <td><input type="text" id="textC1" size="15" class="form-control text-uppercase"  name="textC1"></td>
														  <td><input type="text" id="textD1" size="15" class="form-control text-uppercase" name="textD1"></td>
														  <td><input type="text" id="textE1" size="10" class="form-control text-uppercase" name="textE1"></td>
														  <td><input type="text" id="textF1"  size="10" class="form-control text-uppercase" name="textF1"></td>
														  <td><input type="text" id="textG1" size="5" class="form-control text-uppercase" validate="pincode" maxlength="6" name="textG1"></td>
														</tr>
														<?php } ?>
													</table>
														<button type="button" href="#" onclick="mydelfunction2()" value="" class="btn btn-default pull-right">Delete</button>
														<button type="button" onclick="addMorefunction2()" class="btn btn-default pull-right" value="">Add More</button>
														<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/>
													</td>
												</tr>
											<?php } ?>
												<tr>
													<td>Category of establishment : <span class="mandatory_field">*</span> </td>
													<td>
													<select required name="estab_category" required="required" class="form-control text-uppercase">
														
														<?php 
														$s="";
														$payment_details=$labour->query("select shops_category_id,shops_category from payment_details_forms_1_9 GROUP BY shops_category_id ASC ORDER BY id ASC");
														if($payment_details->num_rows>0){
															while($payment_details_rows=$payment_details->fetch_object()){
																if($estab_category==$payment_details_rows->shops_category_id) $s="selected";
																echo '<option '.$s.' value="'. $payment_details_rows->shops_category_id .'">'. $payment_details_rows->shops_category .'</option>';																
															}															
														}
														if($s=="") echo '<option selected value="">Please Select</option>';
														?>
													</select>
													</td>
													<td>Total No. of Employees : <span class="mandatory_field">*</span><span class="mandatory_field">*</span> </td>
													<td>
													<input type="text" name="max_workers" class="text-uppercase form-control" required="required" validate="onlyNumbers" value="<?php echo $max_workers; ?>">
													</td>
												</tr>
												<tr>
													<td width="25%">Nature of business :</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" name="nature_business" value="<?php echo $business_type; ?>" disabled /></td>
													<td width="25%">Date of commencement of business :</td>
													<td width="25%"><input type="datetime" class="dob form-control text-uppercase"  id="dob2" name= "date_business" placeholder="DD/MM/YYYY" value="<?php echo  $date_of_commencement; ?>" disabled /></td>
												</tr>
												<tr>
													<td colspan="4" >Name of members of the employer's family employed in the establishment and residing with and wholly dependent upon him :
													<table  class="table table-responsive " name="objectTable3"  id="objectTable3">
														<thead>
															<tr>
																<th width="5%" height="35px" align="center">Sl No.</th>						
																<th width="30%" align="center">Full Name</th>
																<th width="25%" align="center">Relationship</th>
																<th width="15%" align="center">Male/Female</th>
																<th width="15%" align="center">Adult/Child</th>
															</tr>
														</thead>
														<?php 
														$part3=$labour->query("SELECT * FROM labour_form".$form."_t3 WHERE form_id='$form_id'");
														$num = $part3->num_rows;
														if($num>0){
														$count=1;
														while($row_4=$part3->fetch_array()){	?>
														<tr>
															<td><input readonly="readonly" id="txttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["field1"]; ?>" name="txttA<?php echo $count;?>" size="1"></td>
															<td><input type="text" value="<?php echo $row_4["field2"]; ?>" validate="letters" id="txttB<?php echo $count;?>" size="30" class="form-control text-uppercase" name="txttB<?php echo $count;?>"></td>
															<td><input type="text" value="<?php echo $row_4["field3"]; ?>" id="txttC<?php echo $count;?>" class="form-control text-uppercase" name="txttC<?php echo $count;?>" size="25"></td>					
															<td><input type="text" value="<?php echo $row_4["field4"]; ?>" id="txttD<?php echo $count;?>" class="form-control text-uppercase" name="txttD<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_4["field5"]; ?>" id="txttE<?php echo $count;?>" class="form-control text-uppercase" name="txttE<?php echo $count;?>" size="10"></td>
														</tr>
														<?php $count++;
														}
														}else{	?>
														<tr>
															<td><input value="1" readonly="readonly" id="txttA1" size="1" class="form-control text-uppercase" name="txttA1"></td>
															<td><input type="text" id="txttB1" size="30" validate="letters" class="form-control text-uppercase" name="txttB1"></td>
															<td><input type="text"  id="txttC1" size="25" class="form-control text-uppercase"  name="txttC1"></td>
															<td><input type="text" id="txttD1" size="10" class="form-control text-uppercase" name="txttD1"></td>
															<td><input type="text" id="txttE1" size="10" class="form-control text-uppercase" name="txttE1"></td>
														</tr>
														<?php } ?>
													</table>
														<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" href="#" onClick="addMorefunction3()" value="">Add More</button>
														<button type="button" class="btn btn-default" href="#" onClick="mydel_addmore3()" value="">Delete</button><input type="hidden" id="hiddenval3" name="hiddenval3" value="<?php echo $hiddenval3; ?>"/></div><br>
													</td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">
														<a href="lc_reg_form<?php echo $form; ?>.php?tab=2" type="submit" class="btn btn-primary">Go Back & Edit</a>
														<button type="submit" name="save<?php echo $form;?>c" class="btn btn-success submit1">Save and Next</button>
													</td>
												</tr>
											</table>
										</form>
									</div>
									<div id="table4" class="tab-pane <?php echo $tabbtn4; ?>" role="tabpanel">
										<form name="myform1" id="myformHW1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
											<table class="table table-responsive">
												<tr>
													<td colspan="4">Total Number of Permanent Employees : 
													<table  class="table table-responsive " name="objectTable4"  id="objectTable4">
														<thead>
															<tr>
																<th width="5%" height="35px" align="center">Sl No.</th>						
																<th width="30%" align="center">Full Name</th>
																<th width="25%" align="center">Relationship</th>
																<th width="15%" align="center">Male/Female</th>
																<th width="15%" align="center">Adult/Child</th>
															</tr>
														</thead>
														<?php 
														$part4=$labour->query("SELECT * FROM ".$table_name."_t4 WHERE form_id='$form_id'");
														$num = $part4->num_rows;
														if($num>0){
														$count=1;
														while($row_4=$part4->fetch_array()){	?>
														<tr>
															<td><input readonly="readonly" id="txtttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_4["field1"]; ?>" name="txtttA<?php echo $count;?>" size="1"></td>
															<td><input type="text" value="<?php echo $row_4["field2"]; ?>" validate="letters" id="txtttB<?php echo $count;?>" size="30" class="form-control text-uppercase" name="txtttB<?php echo $count;?>"></td>
															<td><input type="text" value="<?php echo $row_4["field3"]; ?>" id="txtttC<?php echo $count;?>" class="form-control text-uppercase" name="txtttC<?php echo $count;?>" size="25"></td>					
															<td><input type="text" value="<?php echo $row_4["field4"]; ?>" id="txtttD<?php echo $count;?>" class="form-control text-uppercase" name="txtttD<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_4["field5"]; ?>" id="txtttE<?php echo $count;?>" class="form-control text-uppercase" name="txtttE<?php echo $count;?>" size="10"></td>
														</tr>
														<?php $count++;
														}
														}else{	?>
														<tr>
															<td><input value="1" readonly="readonly" id="txtttA1" size="1" class="form-control text-uppercase" name="txtttA1"></td>
															<td><input type="text" id="txtttB1" size="30" validate="letters" class="form-control text-uppercase" name="txtttB1"></td>
															<td><input type="text" id="txtttC1" size="25" class="form-control text-uppercase"  name="txtttC1"></td>
															<td><input type="text" id="txtttD1" size="10" class="form-control text-uppercase" name="txtttD1"></td>
															<td><input type="text" id="txtttE1" size="10" class="form-control text-uppercase" name="txtttE1"></td>
														</tr>
														<?php } ?>
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" href="#" class="btn btn-default" onClick="addmore4()" value="">Add More</button>
													<button type="button" href="#" onClick="mydel_addmore4()" class="btn btn-default submit1" value="">Delete</button><input type="hidden" id="hiddenval4" name="hiddenval4" value="<?php echo $hiddenval4; ?>"/></div><br>
													</td>
												</tr>
												<tr>
													<td colspan="4">Total Number of Temporary or Casual Employees : 
													<table  class="table table-responsive " name="objectTable5" id="objectTable5">
													<thead>
														<tr>
															<th width="5%" height="35px" align="center">Sl No.</th>						
															<th width="30%" align="center">Full Name</th>
															<th width="25%" align="center">Relationship</th>
															<th width="15%" align="center">Male/Female</th>
															<th width="15%" align="center">Adult/Child</th>
														</tr>
													</thead>
													<?php 
													$part5=$labour->query("SELECT * FROM ".$table_name."_t5 WHERE form_id='$form_id'");
													$num5 = $part5->num_rows;
													if($num5>0){
													$count=1;
													while($row_5=$part5->fetch_array()){	?>
													<tr>
													<td><input id="txttttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_5["field1"]; ?>" readonly="readonly" name="txttttA<?php echo $count;?>" size="1"></td>
													<td><input type="text" value="<?php echo $row_5["field2"]; ?>" validate="letters" id="txttttB<?php echo $count;?>" size="30" class="form-control text-uppercase" name="txttttB<?php echo $count;?>"></td>
													<td><input type="text" value="<?php echo $row_5["field3"]; ?>" id="txttttC<?php echo $count;?>" class="form-control text-uppercase" name="txttttC<?php echo $count;?>" size="25"></td>					
													<td><input type="text" value="<?php echo $row_5["field4"]; ?>" id="txttttD<?php echo $count;?>" class="form-control text-uppercase" name="txttttD<?php echo $count;?>" size="10"></td>
													<td><input type="text" value="<?php echo $row_5["field5"]; ?>" id="txttttE<?php echo $count;?>" class="form-control text-uppercase" name="txttttE<?php echo $count;?>" size="10"></td>
													</tr>
													<?php 
													$count++;
													}
													}else{	?>
													<tr>
													<td><input value="1" readonly="readonly" id="txttttA1" size="1" class="form-control text-uppercase" name="txttttA1"></td>
													<td><input type="text" id="txttttB1" size="30" validate="letters" class="form-control text-uppercase" name="txttttB1"></td>
													<td><input type="text" id="txttttC1" size="25" class="form-control text-uppercase"  name="txttttC1"></td>
													<td><input type="text" id="txttttD1" size="10" class="form-control text-uppercase" name="txttttD1"></td>
													<td><input type="text" id="txttttE1" size="10" class="form-control text-uppercase" name="txttttE1"></td>
													</tr>
													<?php } ?>

													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" href="#" class="btn btn-default" onClick="addmore5()" value="">Add More</button>
													<button type="button" href="#" class="btn btn-default" onClick="mydel_addmore5()" value="">Delete</button><input type="hidden" id="hiddenval5" name="hiddenval5" value="<?php echo $hiddenval5; ?>"/></div><br>				
												</tr>
												<tr>
													<td colspan="4">Total Number of Learner Probationer Employees :
													<table  class="table table-responsive " name="objectTable6" id="objectTable6">
														<thead>
															<tr>
																<th width="5%" height="35px" align="center">Sl No.</th>						
																<th width="30%" align="center">Full Name</th>
																<th width="25%" align="center">Relationship</th>
																<th width="15%" align="center">Male/Female</th>
																<th width="15%" align="center">Adult/Child</th>
															</tr>
														</thead>
														<?php 
														$part6=$labour->query("SELECT * FROM ".$table_name."_t6 WHERE form_id='$form_id'");
														$num = $part6->num_rows;
														if($num>0){
														$count=1;
														while($row_6=$part6->fetch_array()){	?>
														<tr>
															<td><input id="txtttttA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_6["field1"]; ?>" name="txtttttA<?php echo $count;?>" readonly="readonly" size="1"></td>
															<td><input type="text" value="<?php echo $row_6["field2"]; ?>" validate="letters" id="txtttttB<?php echo $count;?>" size="30" class="form-control text-uppercase" name="txtttttB<?php echo $count;?>"></td>
															<td><input type="text" value="<?php echo $row_6["field3"]; ?>" id="txtttttC<?php echo $count;?>" class="form-control text-uppercase" name="txtttttC<?php echo $count;?>" size="25"></td>					
															<td><input type="text" value="<?php echo $row_6["field4"]; ?>" id="txtttttD<?php echo $count;?>" class="form-control text-uppercase" name="txtttttD<?php echo $count;?>" size="10"></td>
															<td><input type="text" value="<?php echo $row_6["field5"]; ?>" id="txtttttE<?php echo $count;?>" class="form-control text-uppercase" name="txtttttE<?php echo $count;?>" size="10"></td>
														</tr>
														<?php 
														$count++;
														}
														}else{	?>
														<tr>
															<td><input value="1" readonly="readonly" id="txtttttA1" size="1" class="form-control text-uppercase" name="txtttttA1"></td>
															<td><input type="text" id="txtttttB1" size="30" validate="letters" class="form-control text-uppercase" name="txtttttB1"></td>
															<td><input type="text" id="txtttttC1" size="25" class="form-control text-uppercase"  name="txtttttC1"></td>
															<td><input type="text" id="txtttttD1" size="10" class="form-control text-uppercase" name="txtttttD1"></td>
															<td><input type="text" id="txtttttE1" size="10" class="form-control text-uppercase" name="txtttttE1"></td>
														</tr>
														<?php } ?>
													</table>
														<div align="right" style="position:relative;right:10px"><button type="button" href="#" class="btn btn-default" onClick="addmore6()" value="">Add More</button>
														<button type="button" href="#" onClick="mydel_addmore6()" class="btn btn-default" value="">Delete</button><input type="hidden" id="hiddenval6" name="hiddenval6" value="<?php echo $hiddenval6; ?>"/></div></td>
												</tr>
												<tr>
													<td colspan="2">Signature of Employer with Date:</td>
													<td colspan="2" align="right"> 
														Signature of Employer : <label class="text-uppercase"><?php echo $key_person; ?></label><br/>
														Designation : <label class="text-uppercase"><?php echo $status_applicant; ?></label><br/>
														Date : <label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
													</td>
												</tr>
												<tr>
													<td class="text-center" colspan="4">
														<a href="lc_reg_form<?php echo $form; ?>.php?tab=3" type="submit" class="btn btn-primary">Go Back & Edit</a>
														<button type="submit" name="save<?php echo $form;?>d" class="btn btn-success submit1">Save and Next</button>
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
		  <!-- /.content-wrapper -->
		  <?php require '../../../user_area/includes/footer.php'; ?>
		</div>
	<!-- ./wrapper -->
	<?php require '../../../user_area/includes/js.php' ?>
	</div>
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
$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>