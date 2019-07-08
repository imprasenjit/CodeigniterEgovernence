<?php  require_once "../../requires/login_session.php"; 

$dept="jdl";
$form="1";
$table_name=$formFunctions->getTableName($dept,$form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_jdl_form.php";

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
	

	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	if($q->num_rows<1){
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results['form_id'];	
			$peti_type=$results['peti_type'];$peti_is=$results['peti_is'];$peti_name=$results['peti_name'];$peti_nm=$results['peti_nm'];$peti_dob=$results['peti_dob'];$peti_nationality=$results['peti_nationality'];$peti_gender=$results['peti_gender'];$peti_caste=$results['peti_caste'];$peti_father_name=$results['peti_father_name'];$peti_mother_name=$results['peti_mother_name'];$peti_address=$results['peti_address'];$peti_state=$results['peti_state'];
			$peti_dist=$results['peti_dist'];$peti_pin=$results['peti_pin'];$peti_occu=$results['peti_occu'];$peti_email=$results['peti_email'];$peti_mobile=$results['peti_mobile'];
			
			//tab 2//
			$respondent_type=$results['respondent_type'];$respondent_is=$results['respondent_is'];$respondent_nm=$results['respondent_nm'];$respon_age=$results['respon_age'];$res_fnm=$results['res_fnm'];$res_mname=$results['res_mname'];$res_add=$results['res_add'];
			$res_state=$results['res_state'];$res_district=$results['res_district'];$res_pin=$results['res_pin'];$res_occupation=$results['res_occupation'];$res_eid=$results['res_eid'];$res_mno=$results['res_mno'];$res_phno=$results['res_phno'];$resp_nationality=$results['resp_nationality'];$resp_gender=$results['resp_gender'];$resp_caste=$results['resp_caste'];
			
		}else{
			$form_id="";
			$peti_type="";$peti_is="";$peti_name="";$peti_nm="";$peti_dob="";$peti_nationality="";
			$peti_gender="";$peti_caste="";$peti_father_name="";$peti_mother_name="";$peti_mname="";$peti_address="";$peti_state="";$peti_dist="";$peti_pin="";$peti_occu="";$peti_email="";$peti_mobile="";
			
			//tab 2//
			$respondent_type="";$respondent_is="";$respondent_nm="";$respon_age="";$res_fnm="";$res_mname="";$res_add="";$res_state="";$res_district="";$res_pin="";$res_occupation="";$res_eid="";$res_mno="";$res_phno="";$resp_nationality="";$resp_gender="";$resp_caste="";
		}	
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		
			$form_id=$results['form_id'];	
			$peti_type=$results['peti_type'];$peti_is=$results['peti_is'];$peti_name=$results['peti_name'];$peti_nm=$results['peti_nm'];$peti_dob=$results['peti_dob'];$peti_nationality=$results['peti_nationality'];$peti_gender=$results['peti_gender'];$peti_caste=$results['peti_caste'];$peti_father_name=$results['peti_father_name'];$peti_mother_name=$results['peti_mother_name'];$peti_address=$results['peti_address'];$peti_state=$results['peti_state'];
			$peti_dist=$results['peti_dist'];$peti_pin=$results['peti_pin'];$peti_occu=$results['peti_occu'];$peti_email=$results['peti_email'];$peti_mobile=$results['peti_mobile'];
			
          //tab2//
			$respondent_type=$results['respondent_type'];$respondent_is=$results['respondent_is'];$respondent_nm=$results['respondent_nm'];$respon_age=$results['respon_age'];$res_fnm=$results['res_fnm'];$res_mname=$results['res_mname'];$res_add=$results['res_add'];
			$res_state=$results['res_state'];$res_district=$results['res_district'];$res_pin=$results['res_pin'];$res_occupation=$results['res_occupation'];$res_eid=$results['res_eid'];$res_mno=$results['res_mno'];$res_phno=$results['res_phno'];$resp_nationality=$results['resp_nationality'];$resp_gender=$results['resp_gender'];$resp_caste=$results['resp_caste'];
			
			
	}
	##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3=""; 
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3=""; 
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3=""; 
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active"; 
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
	<?php //include ("".$table_name."_Addmore.php"); ?> <!-- File handles 'Addmore' Operation -->
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
								<h4 class="text-center">
									<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a href="#table1">Petitioner Details</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a href="#table2">Respondent Details</a></li>
									
								</ul>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive ">
										
											<tr>
												<td width="25%">Petitioner Type</td>
												<td><select class="form-control text-uppercase" id="peti_type" name="peti_type">
													<option value="" >Select</option>
													<option value="I" <?php if($peti_type=="I") echo "selected";?> >Individual</option>
													<option value="G" <?php if($peti_type=="G") echo "selected";?>>Group</option>
												</select></td>
												<td width="25%">Petitioner is</td>
												<td><select class="form-control text-uppercase" name="peti_is">
													<option value="" >Select</option>
													<option value="M" <?php if($peti_is=="M") echo "selected";?> >Main</option>
													<option value="O" <?php if($peti_is=="O") echo "selected";?>>Other</option>
													
												</select></td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" class="form-control text-uppercase" name="peti_name" value="<?php echo $peti_nm;?>"></td>
												<td>Date of Birth</td>
												<td><input type="text" class="dob form-control text-uppercase" name="peti_dob" value="<?php echo $peti_dob;?>"></td>
											</tr>
											<tr>
												<td>Nationality</td>
												<td><select class="form-control text-uppercase" name="peti_nationality">
													<option value="" >Select</option>
													<option value="I" <?php if($peti_nationality=="I") echo "selected";?> >Indian</option>
													<option value="O" <?php if($peti_nationality=="O") echo "selected";?>>Other</option>
												</select></td>
												<td>Gender</td>
												<td><select class="form-control text-uppercase" name="peti_gender">
													<option value="" >Select</option>
													<option value="M" <?php if($peti_gender=="M") echo "selected";?> >Male</option>
													<option value="F" <?php if($peti_gender=="F") echo "selected";?>>Female</option>
												</select></td>
											</tr>
											<tr>
												<td width="25%">Caste</td>
												<td><select class="form-control text-uppercase" name="peti_caste">
													<option value="" >Select</option>
													<option value="G" <?php if($peti_caste=="G") echo "selected";?> >General</option>
													<option value="O" <?php if($peti_caste=="O") echo "selected";?>>OBC</option>
													<option value="SC" <?php if($peti_caste=="SC") echo "selected";?> >SC</option>
													<option value="ST" <?php if($peti_caste=="ST") echo "selected";?> >ST</option>
													</select>
												</td>
												<td width="25%">Father's name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="peti_father_name" value="<?php echo $peti_father_name;?>"></td>
											</tr>
											<tr>
												<td>Mother's Name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="peti_mother_name" value="<?php echo $peti_mother_name;?>"></td>
												<td>Address</td>
												<td><textarea class="form-control text-uppercase" name="peti_address"><?php echo $peti_address; ?></textarea></td>
											</tr>
											<tr>
												<td>State</td>
												<td><input type="text" class="form-control text-uppercase" name="peti_state" value="<?php echo $peti_state;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase"  name="peti_dist" value="<?php echo $peti_dist;?>"></td>
											</tr>	
											<tr>
												<td>PIN</td>
												<td><input type="pincode" class="form-control"  name="peti_pin" validtae="pincode" maxlength="6" value="<?php echo $peti_pin;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Occupation</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="peti_occu" value="<?php echo $peti_occu;?>"></td>
												<td>Email ID</td>
												<td width="25%"><input type="text" class="form-control"  name="peti_email" value="<?php echo $peti_email;?>"></td>
											</tr>
											<tr>
												<td width="25%">Mobile No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumber" maxlength="10" name="peti_mobile" value="<?php echo $peti_mobile;?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
										<tr>										
											<td class="text-center" colspan="4">
												<button type="button" class="btn btn-primary" onclick="addMorefunction1()" name="save">ADD</button>
												
												<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
											</td>									
										</tr>
											
										<tr>
											<td colspan="4">
										
										
												<table name="objectTable1" id="objectTable1" class="table table-responsive 	text-center">
													<thead>
													<tr>
														<th width="3%">Sl. No.</th>
														<th width="10%">Petitioner Type</th>
														<th width="5%">Petitioner is</th>
														<th width="10%">Name</th>
														<th width="5%">Gender</th>
														<th width="10%">Father's Name</th>
														<th width="10%">Mother's Name</th>
														<th width="10%">Address</th>
														<th width="10%">District</th>
														<th width="5%">Mobile</th>
														<th width="10%">Email</th>
													</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div>
											</td>
										  </tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td width="25%">Respondent Type</td>
												<td><select class="form-control text-uppercase" name="respondent_type">
													<option value="" >Select</option>
													<option value="I" <?php if($respondent_type=="I") echo "selected";?> >Individual</option>
													<option value="G" <?php if($respondent_type=="G") echo "selected";?> >Group</option>
												</select></td>
												<td width="25%">Respondent is</td>
												<td><select class="form-control text-uppercase" name="respondent_is">
													<option value="" >Select</option>
													<option value="M" <?php if($respondent_is=="M") echo "selected";?> >Main</option>
													<option value="O" <?php if($respondent_is=="O") echo "selected";?>>Other</option>
													
												</select></td>
											</tr>
											<tr>
												<td>Name</td>
												<td><input type="text" class="form-control text-uppercase" name="respondent_nm" value="<?php echo $respondent_nm;?>"></td>
												<td>Age</td>
												<td><input type="text" class="form-control" name="respon_age" value="<?php echo $respon_age;?>"></td>
											</tr>
											<tr>
												<td>Nationality</td>
												<td><select class="form-control text-uppercase" name="resp_nationality">
													<option value="" >Select</option>
													<option value="I" <?php if($resp_nationality=="I") echo "selected";?> >Indian</option>
													<option value="O" <?php if($resp_nationality=="O") echo "selected";?>>Other</option>
												</select></td>
												<td>Gender</td>
												<td><select class="form-control text-uppercase" name="resp_gender">
													<option value="" >Select</option>
													<option value="M" <?php if($resp_gender=="M") echo "selected";?> >Male</option>
													<option value="F" <?php if($resp_gender=="F") echo "selected";?>>Female</option>
												</select></td>
											</tr>
											<tr>
												<td width="25%">Caste</td>
												<td><select class="form-control text-uppercase" name="resp_caste">
													<option value="" >Select</option>
													<option value="G" <?php if($resp_caste=="G") echo "selected";?> >General</option>
													<option value="O" <?php if($resp_caste=="O") echo "selected";?>>OBC</option>
													<option value="SC" <?php if($resp_caste=="SC") echo "selected";?> >SC</option>
													<option value="ST" <?php if($resp_caste=="ST") echo "selected";?> >ST</option>
													</select>
												</td>
												<td width="25%">Fathers name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="res_fnm" value="<?php echo $res_fnm;?>"></td>
											</tr>
											<tr>
												<td>Mothers Name</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="res[mname]" value="<?php echo $res_mname;?>"></td>
												<td>Address</td>
												<td><textarea class="form-control text-uppercase" name="res_add"><?php echo $res_add; ?></textarea></td>
											</tr>
											<tr>
												<td>State</td>
												<td><input type="text" class="form-control text-uppercase" name="res_state" value="<?php echo $res_state;?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase"  name="res_district" value="<?php echo $res_district;?>"></td>
											</tr>	
											<tr>
												<td>PIN</td>
												<td><input type="pincode" class="form-control"  name="res_pin" validtae="pincode" maxlength="6" value="<?php echo $res_pin;?>"></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Occupation</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="res_occupation" value="<?php echo $res_occupation;?>"></td>
												<td>Email ID</td>
												<td width="25%"><input type="email" class="form-control"  name="res_eid" value="<?php echo $res_eid;?>"></td>
											</tr>
											<tr>
												<td width="25%">Mobile No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" validtae="mobileNumber" maxlength="10" name="res_mno" value="<?php echo $res_mno;?>"></td>
												<td width="25%">Phone No</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="res_phno" value="<?php echo $res_phno;?>"></td>
											</tr>
											<tr>
												<td>Date : <b><?php echo date('d-m-Y',strtotime($today)); ?></b> <br/> Place : <label><?php echo strtoupper($dist);?> </label></td>
												<td></td><td></td>
												<td align="right"><label><b><?php echo strtoupper($key_person); ?></b></label><br/>Signature of the Applicant</td>	
											</tr>
											<tr><td class="text-center" colspan="4"></td></tr>
											<tr>										
												<td class="text-center" colspan="4">
													<a href="<?php echo $table_name;?>.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit" class="btn btn-success submit1" name="save" >ADD</button>
													<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
												</td>									
											</tr>
								
								          
										  <tr>
											<td colspan="4">
												<table name="objectTable1" id="objectTable1" class="table table-responsive 	text-center">
													<thead>
													<tr>
														<th width="5%">Sl. No.</th>
														<th width="10%">Respondent Type</th>
														<th width="10%">Name</th>
														<th width="5%">Gender</th>
														<th width="10%">Father's Name</th>
														<th width="10%">Mother's Name</th>
														<th width="10%">Address</th>
														<th width="10%">District</th>
														<th width="10%">Mobile</th>
														<th width="5%">Phone No</th>
														<th width="5%">Email</th>
														<th width="10%">State</th>
														<th width="5%">Cancel</th>
													</tr>
													</thead>
													<?php
														$part1=$jdl->query("SELECT * FROM ".$table_name."_respondent WHERE form_id='$form_id'");
														$num1 = $part1->num_rows;
														if($num1>0){
														  $count=1;
														  while($row_1=$part1->fetch_array()){	?>
															<tr>
																<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["respondent_type"]; ?>"  name="txtB<?php echo $count;?>" size="10"></td>
																<td><input value="<?php echo $row_1["respondent_nm"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["resp_gender"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_fnm"]; ?>" id="txtE<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtE<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_mname"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtF<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_add"]; ?>" id="txtG<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtG<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_district"]; ?>" id="txtH<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtH<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["peti_mobileno"]; ?>" id="txtI<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtI<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_phno"]; ?>" id="txtJ<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtJ<?php echo $count;?>"></td>
																<td><input value="<?php echo $row_1["res_eid"]; ?>" id="txtK<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtK<?php echo $count;?>"></td><td>
																<input value="<?php echo $row_1["res_state"]; ?>" id="txtL<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtL<?php echo $count;?>"></td>
																<input value="<?php echo $row_1["cancel"]; ?>" id="txtM<?php echo $count;?>"  class=" form-control text-uppercase" size="10" name="txtM<?php echo $count;?>"></td>
																
															</tr>	
														<?php $count++; } 
														}else{	?>
														<tr>
															<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
															<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
															<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>
															<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>	
															<td><input id="txtE1" size="10"   class="form-control text-uppercase" name="txtE1"></td>
															<td><input id="txtF1" size="10"   class="form-control text-uppercase" name="txtF1"></td>
															<td><input id="txtG1" size="10"   class="form-control text-uppercase" name="txtG1"></td>
															<td><input id="txtH1" size="10"   class="form-control text-uppercase" name="txtH1"></td>
															<td><input id="txtI1" size="10"   class="form-control text-uppercase" name="txtI1"></td>
															<td><input id="txtJ1" size="10"   class="form-control text-uppercase" name="txtJ1"></td>
															<td><input id="txtK1" size="10"   class="form-control text-uppercase" name="txtK1"></td>
															<td><input id="txtL1" size="10"   class="form-control text-uppercase" name="txtL1"></td>
															<td><input id="txtM1" size="10"   class="form-control text-uppercase" name="txtM1"></td>
																													
														</tr>
														<?php } ?>														
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
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
index=1;
function addMorefunction1(){
	
	var peti_type = $( "#peti_type option:selected" ).val();
	if(peti_type=="I") var peti_type_value = "Individual";	else peti_type_value = "Group";
	
	$('#objectTable1').append('<tr id="row'+index+'"><td>'+index+'</td><td>'+peti_type_value+'</td><td>more data</td></tr>');
	index++;
	document.getElementById("hiddenval1").value=index;
}
    <?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	
	$('.dob2').datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,changeYear: true, yearRange: "-50:+50"});
</script>
</body>
</html>