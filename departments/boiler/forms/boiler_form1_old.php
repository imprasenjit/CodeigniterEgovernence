<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('boiler','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=boiler';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=boiler';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);

include "save_boiler_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

		$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$q=$boiler->query("select * from boiler_form1 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();
		if($q->num_rows<1)
		{	 
			$boiler_owner="";$street_name1="";$street_name2="";$owner_vill="";$owner_dist="";$owner_pin="";$owner_mobile=""; $owner_email="";$boiler_location="";$maker_no="";$manu_name="";$manu_year="";$heating="";$reg_fees="";$payment_mode="";  $offering_insp_date="";  $heating_value=""; $boiler_status=""; $is_fabrication=""; $boiler_type_a="";$boiler_type_b="";$file1="";$file2="";$file3="";$file4="";$file5="";$file6="";$file7="";$file8="";
			
		}else{
			$form_id=$results['form_id'];
			$boiler_location=$results['boiler_location'];$maker_no=$results['maker_no'];$manu_name=$results['manu_name'];$manu_year=$results['manu_year'];$heating=$results['heating'];$heating_value=$results['heating_value'];	$reg_fees=$results['reg_fees'];$payment_mode=$results['payment_mode'];$offering_insp_date=$results['offering_insp_date'];$is_fabrication=$results['is_fabrication'];
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
			} 
			$file1=$results['file1'];$file2=$results['file2'];$file3=$results['file3'];$file4=$results['file4'];$file5=$results['file5'];$file6=$results['file6'];$file7=$results['file7'];$file8=$results['file8'];
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>3 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
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
	 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js">
</script>
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
								<strong>FORM NO. 1 <br/><?php echo $form_name=$formFunctions->get_formName('boiler','1');?> </strong>
							</h4>	
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
							  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART 1</a></li>
							  <li class="<?php echo $tabbtn2; ?>"><a href="#table2">UPLOAD SECTION</a></li>							 
							</ul>
							<br>
							<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
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
												<td><label class="radio-inline"><input type="radio" id="boiler_type_b" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> name="boiler_type[b]" <?php if($boiler_type_b=="FT" || $boiler_type_b=="") echo "checked"; ?> value="FT"> Fire Tube   </label>
												<label class="radio-inline"><input type="radio" id="boiler_type_b" name="boiler_type[b]" <?php if($boiler_type_a=="U") echo "disabled='disabled'"; ?> <?php if($boiler_type_b=="WT") echo "checked"; ?> value="WT"> Water Tube </label></td>
											</tr>
											<tr>
												<td>7. Heating surface of the Boiler (in Sq. Meter):<span class="mandatory_field">*</span></td>
												<td><div id="myDiv" <?php //if($heating!=23) { echo 'class="hide"'; } else { echo 'class="show"'; } ?> >					
													<input type="text" validate="onlyNumbers" required value="<?php echo $heating_value; ?>" class="form-control text-uppercase" max="99999" name="heating_value" id="heating_value"/> <span style="width:100px" id="heating_error" <?php if($heating!=23) { echo 'class="error"'; } else { echo 'class="hide"'; } ?>></span> 				
												</div></td>
												<td colspan="2">
													<select disabled="disabled" name="heating_select" id="heating_select" class="form-control text-uppercase">
														<option <?php if($heating==1) echo "selected"; ?> value="1">FOR SMALL INDUSTRIAL BOILER AS PER CHAPTER XIV</option>
														<option <?php if($heating==2) echo "selected"; ?> value="2">FOR BOILER RATING NOT EXCEEDING 10SQ. METERS</option>
														<option <?php if($heating==3) echo "selected"; ?> value="3">FOR BOILER RATING EXCEEDING 10SQ. METERS BUT NOT EXCEEDING 30SQ. METERS</option>
														<option <?php if($heating==4) echo "selected"; ?> value="4">FOR BOILER RATING EXCEEDING 30SQ. METERS BUT NOT EXCEEDING 50SQ. METERS</option>
														<option <?php if($heating==5) echo "selected"; ?> value="5">FOR BOILER RATING EXCEEDING 50SQ. METERS BUT NOT EXCEEDING 70SQ. METERS</option>
														<option <?php if($heating==6) echo "selected"; ?> value="6">FOR BOILER RATING EXCEEDING 70SQ. METERS BUT NOT EXCEEDING 90SQ. METERS</option>
														<option <?php if($heating==7) echo "selected"; ?> value="7">FOR BOILER RATING EXCEEDING 90SQ. METERS BUT NOT EXCEEDING 110SQ. METERS</option>
														<option <?php if($heating==8) echo "selected"; ?> value="8">FOR BOILER RATING EXCEEDING 110SQ. METERS BUT NOT EXCEEDING 200SQ. METERS</option>
														<option <?php if($heating==9) echo "selected"; ?> value="9">FOR BOILER RATING EXCEEDING 200SQ. METERS BUT NOT EXCEEDING 400SQ. METERS</option>
														<option <?php if($heating==10) echo "selected"; ?> value="10">FOR BOILER RATING EXCEEDING 400SQ. METERS BUT NOT EXCEEDING 600SQ. METERS</option>
														<option <?php if($heating==11) echo "selected"; ?> value="11">FOR BOILER RATING EXCEEDING 600SQ. METERS BUT NOT EXCEEDING 800SQ. METERS</option>
														<option <?php if($heating==12) echo "selected"; ?> value="12">FOR BOILER RATING EXCEEDING 800SQ. METERS BUT NOT EXCEEDING 1000SQ. METERS</option>
														<option <?php if($heating==13) echo "selected"; ?> value="13">FOR BOILER RATING EXCEEDING 1000SQ. METERS BUT NOT EXCEEDING 1200SQ. METERS</option>
														<option <?php if($heating==14) echo "selected"; ?> value="14">FOR BOILER RATING EXCEEDING 1200SQ. METERS BUT NOT EXCEEDING 1400SQ. METERS</option>
														<option <?php if($heating==15) echo "selected"; ?> value="15">FOR BOILER RATING EXCEEDING 1400SQ. METERS BUT NOT EXCEEDING 1600SQ. METERS</option>
														<option <?php if($heating==16) echo "selected"; ?> value="16">FOR BOILER RATING EXCEEDING 1600SQ. METERS BUT NOT EXCEEDING 1800SQ. METERS</option>
														<option <?php if($heating==17) echo "selected"; ?> value="17">FOR BOILER RATING EXCEEDING 1800SQ. METERS BUT NOT EXCEEDING 2000SQ. METERS</option>
														<option <?php if($heating==18) echo "selected"; ?> value="18">FOR BOILER RATING EXCEEDING 2000SQ. METERS BUT NOT EXCEEDING 2200SQ. METERS</option>
														<option <?php if($heating==19) echo "selected"; ?> value="19">FOR BOILER RATING EXCEEDING 2200SQ. METERS BUT NOT EXCEEDING 2400SQ. METERS</option>
														<option <?php if($heating==20) echo "selected"; ?> value="20">FOR BOILER RATING EXCEEDING 2400SQ. METERS BUT NOT EXCEEDING 2600SQ. METERS</option>
														<option <?php if($heating==21) echo "selected"; ?> value="21">FOR BOILER RATING EXCEEDING 2600SQ. METERS BUT NOT EXCEEDING 2800SQ. METERS</option>
														<option <?php if($heating==22) echo "selected"; ?> value="22">FOR BOILER RATING EXCEEDING 2800SQ. METERS BUT NOT EXCEEDING 3000SQ. METERS</option>
														<option <?php if($heating==23) echo "selected"; ?> value="23">OTHERS (ABOVE 3000SQ. METERS)</option>
													</select><?php if(isset($code) && $code == 9){echo $errorMsg ;}?>
													<input type="hidden" name="heating" id="heating" value="<?php echo $heating; ?>"/>
												</td>
											</tr>
											<tr>
												<td colspan="2">8. Registration fees( One time for packaged Boiler and four times for Site Fabricated Boiler as displayed in the website for the specified slab of the heating surface )</td>
												<td><input type="text" readonly="readonly" id="reg_fees" name="reg_fees" value="<?php echo $reg_fees; ?>" class="form-control" /></td>
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
													<button type="submit" name="save1" class="btn btn-success submit1">Save &amp; Next</button>
												</td>									
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="fileUpload" id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table id="" class="table table-responsive">	
											<tr>
												<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
											</tr>
											<tr>
												<td width="50%">Form-II issued by the inspecting authority.</td>
												<td width="30%">
													<select trigger="FileModal" id="file1" class="form-control">
														<option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
												<input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile1">
													<?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Form-III issued by the inspecting authority.</td>
												<td width="30%">
													<select trigger="FileModal" id="file2" class="form-control">
														<option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile2">
													<?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Form-IV A for all materials used for the Boiler.</td>
												<td width="30%">
													<select trigger="FileModal" id="file3" class="form-control">
														<option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile3">
													<?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Form-III C for all valves, mountings and fittings.</td>
												<td width="30%">
													<select trigger="FileModal" id="file4" class="form-control">
														<option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
												<input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile4">
													<?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td colspan="3">IBR approved details drawing of boiler :</td>
											</tr>
											<tr>
												<td>All pressure parts assemble drawing.</td>
												<td width="30%">
													<select trigger="FileModal" id="file5" class="form-control"> 
														<option value="0" selected="selected"><?php echo uploadinfo($file5); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
												<input type="hidden" name="mfile5" id="mfile5" value="<?php echo $file5 !== '' ? $file5 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile5">
													<?php if($file5!="" && $file5!="SC" && $file5!="NA"){ echo '<a href="'.$upload.$file5.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Welding details drawing.</td>
												<td width="30%">
													<select trigger="FileModal" id="file6" class="form-control">
														<option value="0" selected="selected"><?php echo uploadinfo($file6); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="mfile6" id="mfile6" value="<?php echo $file6 !== '' ? $file6 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile6">
													<?php if($file6!="" && $file6!="SC" && $file6!="NA"){ echo '<a href="'.$upload.$file6.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Manhole and head hole drawing. </td>
												<td width="30%">
													<select trigger="FileModal" id="file7" class="form-control">   
														<option value="0" selected="selected"><?php echo uploadinfo($file7); ?></option>
														<option value="1">From E-Locker</option>
														<option value="2">From PC</option>
														<option value="4">Send by Courier</option>
														<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="mfile7" id="mfile7" value="<?php echo $file7 !== '' ? $file7 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile7">
													<?php if($file7!="" && $file7!="SC" && $file7!="NA"){ echo '<a href="'.$upload.$file7.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td>Feed pipeline and blow down detail drawings. </td>
												<td width="30%">
													<select trigger="FileModal" id="file8" class="form-control">  
													<option value="0" selected="selected"><?php echo uploadinfo($file8); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
													</select>
													<input type="hidden" name="mfile8" id="mfile8" value="<?php echo $file8 !== '' ? $file8 : ''; ?>" />
												</td>
												<td width="20%" id="tdfile8">
												<?php if($file8!="" && $file8!="SC" && $file8!="NA"){ echo '<a href="'.$upload.$file8.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
												</td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<a href="boiler_form1.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
													<button type="submit" class="btn btn-success submit1" name="submit1" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	
		$(document).ready(function(){
			$("#heating_value").on("change", function(){	
				$('input[id="is_fabrication_n"]').prop('checked', true);
				var putValue = $(this).val()
				if(putValue > 3000){
				var calValue = putValue-3000 ;
				var calValue2 = Math.floor(calValue/200);
				var calValue3 = Math.floor(calValue2 * 600);
				var calValue4 = Math.floor(calValue3 + 21600);
				$('#reg_fees').val(calValue4);
				
				
				}
			});
			$('input[id="boiler_type_a"]').on('change', function(){
				if($(this).val() == 'U'){
					$('input[value="WT"]').prop('checked', true);
					$('input[id="boiler_type_b"]').attr('disabled', 'disabled');
				}else{
					$('input[value="WT"]').prop('checked', '');
					$('input[id="boiler_type_b"]').attr('disabled', false);
				}
			});
			$('input[name="heating_value"]').on('change', function(){
				//alert(typeof $(this).val());
				if($(this).val() == 0){
					$('select[name="heating_select"] option[value="1"]').prop('selected', true);
					 $('#reg_fees').val("1200");
					 $('#heating').val("1");
				}else if($(this).val() <= 10){
					$('select[name="heating_select"] option[value="2"]').prop('selected', true);
					 $('#reg_fees').val("1800");
					 $('#heating').val("2");
				}else if($(this).val() >= 11 && $(this).val() <= 30){
					$('select[name="heating_select"] option[value="3"]').prop('selected', true);
					$('#reg_fees').val("2400");
					$('#heating').val("3");					
				}else if($(this).val() >= 31 && $(this).val() <= 50){
					$('select[name="heating_select"] option[value="4"]').prop('selected', true);
					$('#reg_fees').val("2700");
					$('#heating').val("4");
				}else if($(this).val() >= 51 && $(this).val() <= 70){
					$('select[name="heating_select"] option[value="5"]').prop('selected', true);
					$('#reg_fees').val("3300");
					$('#heating').val("5");
				}else if($(this).val() >= 71 && $(this).val() <= 90){
					$('select[name="heating_select"] option[value="6"]').prop('selected', true);
					$('#reg_fees').val("3900");
					$('#heating').val("6");
				}else if($(this).val() >= 91 && $(this).val() <= 110){
					$('select[name="heating_select"] option[value="7"]').prop('selected', true);
					$('#reg_fees').val("4500");
					$('#heating').val("7");
				}else if($(this).val() >= 111 && $(this).val() <= 200){
					$('select[name="heating_select"] option[value="8"]').prop('selected', true);
					$('#reg_fees').val("5100");
					$('#heating').val("8");
				}else if($(this).val() >= 201 && $(this).val() <= 400){
					$('select[name="heating_select"] option[value="9"]').prop('selected', true);
					$('#reg_fees').val("5700");
					$('#heating').val("9");
				}else if($(this).val() >= 401 && $(this).val() <= 600){
					$('select[name="heating_select"] option[value="10"]').prop('selected', true);
					$('#reg_fees').val("6600");
					$('#heating').val("10");
				}else if($(this).val() >= 601 && $(this).val() <= 800){
					$('select[name="heating_select"] option[value="11"]').prop('selected', true);
					$('#reg_fees').val("7200");
					$('#heating').val("11");
				}else if($(this).val() >= 801 && $(this).val() <= 1000){
					$('select[name="heating_select"] option[value="12"]').prop('selected', true);
					$('#reg_fees').val("8100");
					$('#heating').val("12");
				}else if($(this).val() >= 1001 && $(this).val() <= 1200){
					$('select[name="heating_select"] option[value="13"]').prop('selected', true);
					$('#reg_fees').val("9600");
					$('#heating').val("13");
				}else if($(this).val() >= 1201 && $(this).val() <= 1400){
					$('select[name="heating_select"] option[value="14"]').prop('selected', true);
					$('#reg_fees').val("10800");
					$('#heating').val("14");
				}else if($(this).val() >= 1401 && $(this).val() <= 1600){
					$('select[name="heating_select"] option[value="15"]').prop('selected', true);
					$('#reg_fees').val("12600");
					$('#heating').val("15");
				}else if($(this).val() >= 1601 && $(this).val() <= 1800){
					$('select[name="heating_select"] option[value="16"]').prop('selected', true);
					$('#reg_fees').val("13500");
					$('#heating').val("16");
				}else if($(this).val() >= 1801 && $(this).val() <= 2000){
					$('select[name="heating_select"] option[value="17"]').prop('selected', true);
					$('#reg_fees').val("15000");
					$('#heating').val("17");
				}else if($(this).val() >= 2001 && $(this).val() <= 2200){
					$('select[name="heating_select"] option[value="18"]').prop('selected', true);
					$('#reg_fees').val("16200");
					$('#heating').val("18");
				}else if($(this).val() >= 2201 && $(this).val() <= 2400){
					$('select[name="heating_select"] option[value="19"]').prop('selected', true);
					$('#reg_fees').val("18000");
					$('#heating').val("19");
				}else if($(this).val() >= 2401 && $(this).val() <= 2600){
					$('select[name="heating_select"] option[value="20"]').prop('selected', true);
					$('#reg_fees').val("18900");
					$('#heating').val("20");
				}else if($(this).val() >= 2601 && $(this).val() <= 2800){
					$('select[name="heating_select"] option[value="21"]').prop('selected', true);
					$('#reg_fees').val("20400");
					$('#heating').val("21");
				}else if($(this).val() >= 2801 && $(this).val() <= 3000){
					$('select[name="heating_select"] option[value="22"]').prop('selected', true);
					$('#reg_fees').val("21600");
					$('#heating').val("22");			
				}else if($(this).val() >= '3001'){
					$('select[name="heating_select"] option[value="23"]').prop('selected', true);
					$('#heating').val("23");
				}else{
					$('#heating').val("1");
					$('select[name="heating_select"] option[value="1"]').prop('selected', true);
				}													
			});
			var oldValue=0, newValue=0;
			$('input[name="is_fabrication"]').on('change', function(){				
				if($(this).val() == 'Y'){
					if($('input[id="reg_fees"]').val() != ''){						
						oldValue2 = $('input[id="reg_fees"]').val()
						oldValue = $('input[id="reg_fees"]').val()
						newValue = oldValue*4;
						$('input[id="reg_fees"]').val(newValue);
					}	
				}else{
					$('input[id="reg_fees"]').val(oldValue2);
				}
				
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
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	
</script>



</body>
</html>