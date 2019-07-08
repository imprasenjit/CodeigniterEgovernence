<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('fcs','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=fcs';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=fcs';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=1';</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);

include "save_form.php";
		$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];	
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	/* echo $Name_of_owner=$row1['Name_of_owner'];die();
	if (preg_match('/,/',$Name_of_owner)){
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
	}else{
		$owners = array($Name_of_owner);
	} */
    
	
	
		$q=$fcs->query("select * from fcs_form1 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$father_name="";$age="";$caste="";$name_lic="";$is_lic_prev="";$trading="";$stocks="";$is_convicted="";$particulars="";$is_declared="";
			$is_registration="";
			$business_place1="";$business_place2="";$business_place3="";
			$licence_name="";$licence_number="";
			$address_s1="";$address_s2="";$address_d="";$address_p="";
			
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];$father_name=$results["father_name"];$age=$results["age"];$caste=$results["caste"];$name_lic=$results["name_lic"];$is_lic_prev=$results["is_lic_prev"];$trading=$results["trading"];$stocks=$results["stocks"];$is_convicted=$results["is_convicted"];$particulars=$results["particulars"];$is_declared=$results["is_declared"];
			
			if(!empty($results["business"])){
				$business=json_decode($results["business"]);
				$business_place1=$business->place1;$business_place2=$business->place2;$business_place3=$business->place3;
			}else{				
				$business_place1="";$business_place2="";$business_place3="";
			}				
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_name=$licence->name;$licence_number=$licence->number;
			}else{				
				$licence_name="";$licence_number="";
			}				
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
			}else{				
				$address_s1="";$address_s2="";$address_d="";$address_p="";
			}	
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}	
	}
	$q1=$fcs->query("select * from fcs_form1_members where form_id='$form_id'");
	$results1=$q1->fetch_array();
	if($q1->num_rows<1){
		$form_id="";
		$name="";$fat_name="";$age="";$address="";$contact="";
	}
	else{
		$form_id=$results1['form_id'];
		$name=$results1['name'];$fat_name=$results1['fat_name'];$age=$results1['age'];$address=$results1['address'];$contact=$results1['contact'];
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
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
	<?php include ("fcs_form1_addmore.php"); ?>
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
								<strong><?php echo $form_name=$formFunctions->get_formName('fcs','1'); ?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td width="25%">1. Applicant's particulars :</td>
									<td width="25%">&nbsp;</td>
									<td width="25%"></td>
									<td width="25%"></td>									
								</tr>
								<tr>
									<td width="25%">Name :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									<td width="25%">S/O :</td>
									<td width="25%"><input type="text" name="father_name" validate="letters" value="<?php echo $father_name; ?>" class="form-control text-uppercase"></td>		
								</tr>
								<tr>
									<td width="25%">Age :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" validate="onlyNumbers" name="age" value="<?php echo $age;?>"/></td>
									<td width="25%">Caste :</td>
									<td><select class="form-control text-uppercase" name="caste" >
											<option value="disabled">Please Select</option>
											<option value="ST" <?php if($caste=="ST") echo "selected";?> >ST</option>
											<option value="SC" <?php if($caste=="SC") echo "selected";?>>SC</option>
											<option value="OBC" <?php if($caste=="OBC") echo "selected";?>>OBC</option>
											<option value="MOBC" <?php if($caste=="MOBC") echo "selected";?>>MOBC</option>
											<option value="GEN" <?php if($caste=="GEN") echo "selected";?>>GEN</option>
											</select></td>									
								</tr>
								<tr>
									 <td colspan="4"> 2. Residential address of the applicant :</td>				 
								</tr>
								<tr>
									<td width="25%">Street name 1 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									<td width="25%">Street name 2 :</td>
									<td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>	
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
									<td>District :</td>
									<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
									<td>Mobile No. :</td>
									<td><input validate="onlyNumbers" type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								</tr>
								<tr>
									<td>E-mail id :</td>
									<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td></td>
									<td></td>									
								</tr>
								<tr>
									<td>3. Name/Style which licence is required : </td>
									<td><input type="text" class="form-control text-uppercase" name="name_lic" value="<?php echo $name_lic;?>"/></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								</tr>
								<tr>								   
									<td colspan="4">4. Situation of application's place of business :</td>
								</tr>
								<tr>
									<td>a) House/ Shop No :</td>
									<td><input type="text" class="form-control text-uppercase" name="business[place1]" value="<?php echo $business_place1;?>" /></td>
									<td>b) Market :</td>
									<td><input type="text" class="form-control text-uppercase"  name="business[place2]" value="<?php echo $business_place2;?>" /></td>
								</tr>
								<tr>
									<td>c) Village/ Town :</td>
									<td><input type="text" class="form-control text-uppercase"  name="business[place3]" value="<?php echo $business_place3;?>" /></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
								   <td colspan="4">5. Name of partners, if any of the firm :</td>
								</tr>
								<tr>
									<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father's Name</th>
												<th>Age</th>
												<th>Address</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
											$member_results=$fcs->query("select * from fcs_form1_members where form_id='$form_id'") or die("Error : ".$fcs->error);					
											if($member_results->num_rows==0){
												for($i=1;$i<=count($owners);$i++){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
													<td><input type="text" name="fat_name<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text"  validate="onlyNumbers" name="age<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" validate="address" value="" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="" ></td>
												</tr>
												<?php } ?>
												<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
											<?php }else{
													$i=1;
											while($rows=$member_results->fetch_object()){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
													<td><input type="text" name="fat_name<?php echo $i;?>" class="form-control text-uppercase" validate="specialChar" value="<?php echo $rows->fat_name; ?>" /></td>
													<td><input type="text" name="age<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" value="<?php echo $rows->age; ?>" /></td>
													<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" validate="address" ></td>
													<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" maxlength="10" value="<?php echo $rows->contact; ?>" /></td>
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
								   <td colspan="4">6. Particulars of trade articles in which the applicant wants to carry on business as a :
										<table name="objectTable1" id="objectTable1" class="table table-responsive table-bordered text-center" >
											<tr>
												<th width="5%">Slno</th>
												<th width="25%">As a wholesaler</th>
												<th width="20%">As a Importer</th>
												<th width="25%">As a Retailer</th>
											</tr>
											<?php
												$part1=$fcs->query("SELECT * FROM fcs_form1_t1 WHERE form_id='$form_id'");
												$num = $part1->num_rows;
												if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["wholesaler"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
														<td><input type="text" value="<?php echo $row_1["impoter"]; ?>" id="txtC<?php echo $count;?>" validate="letters" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
														<td><input type="text" value="<?php echo $row_1["retailer"]; ?>" id="txtD<?php echo $count;?>" validate="letters" class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
													</tr>	
												<?php $count++; } 
												}else{	?>
												<tr>
													<td><input type="text" value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
													<td><input type="text" id="txtB1" size="10" class="form-control text-uppercase" name="txtB1"></td>
													<td><input type="text" id="txtC1" size="10" validate="letters"  class="form-control text-uppercase" name="txtC1"></td>
													<td><input type="text" id="txtD1" size="10" validate="letters"  class="form-control text-uppercase" name="txtD1"></td>
												</tr>
												<?php } ?>														
											</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
									</tr>		
								<tr>
								   <td colspan="3">7. Did the applicant previously hold a licence of the trade articles for which licence has now been applied for if so, give details: </td>
								   <td><label class="radio-inline"><input type="radio" name="is_lic_prev" <?php if($is_lic_prev=="Y") echo "checked"; ?> value="Y"/> Yes </label>&nbsp;&nbsp;<label class="radio-inline"><input type="radio" name="is_lic_prev" <?php if($is_lic_prev=="N" || $is_lic_prev=="") echo "checked"; ?> value="N"/> No</label></td>
								</tr>
								<tr>									
									<td>i) Name of trade articles (s) :</td>
									<td><input type="text" name="licence[name]" value="<?php echo $licence_name; ?>" class="form-control text-uppercase lice_value"></td>
									<td>ii) Licence no. :</td>
									<td><input type="text" name="licence[number]" value="<?php echo $licence_number; ?>" class="form-control text-uppercase lice_value"></td>
								</tr>
								<tr>									
									<td>8. How long has the application been trading in the trade article for which the license has been applied for? :</td>
									<td><input type="text" name="trading" value="<?php echo $trading; ?>" class="form-control text-uppercase"></td>
									<td>9. Particular regarding stocks of trade article in possession on the date of application  :</td>
									<td><textarea type="text" name="stocks" class="form-control text-uppercase"><?php echo $stocks; ?></textarea></td>
								</tr>
								<tr>									
									<td colspan="4">10. Complete address (with House no. market etc.) of godowns or place where trade articles for which licence has been applied will be stored :</td>
								</tr>
								<tr>									
									<td>a) Village/ Town :</td>
									<td><input type="text" name="address[s1]" value="<?php echo $address_s1; ?>" class="form-control text-uppercase"></td>
									<td> b) P.S:</td>
									<td><input type="text" name="address[s2]" value="<?php echo $address_s2; ?>" class="text-uppercase form-control"></td>
								</tr>
								<tr>									
									<td>c) District : </td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
											<select class="form-control text-uppercase" name="address[d]" id="dist" ><?php
												while($dstrows=$dstresult->fetch_object()) { 
												if($address_d==$dstrows->district) $s='selected'; else $s=''; ?>
												<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
											<?php } ?>					
											</select> 
										</td>
									<td>d) Pincode </td>
									<td><input type="text" name="address[p]" validate="pincode" maxlength="6" value="<?php echo $address_p; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>									
									<td>11. Has the applicant ever been convicted by a court of law for contravention of any order issued under Essential Commodities Act, 1955 during last 3 years?  : </td>
									<td><label class="radio-inline"><input type="radio" name="is_convicted" id="is_convicted" value="Y"  <?php if(isset($is_convicted) && $is_convicted=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" name="is_convicted"  value="N"  id="is_convicted" <?php if(isset($is_convicted) && $is_convicted=='N') echo 'checked'; ?> /> No</label></td>
									<td>12. Particulars of suspension or cancellation of the licence held the applicant during last 3 years.</td>
									<td><input type="text" name="particulars" value="<?php echo $particulars; ?>" class="form-control text-uppercase"></td>
								</tr>
								<tr>									
									<td>13. Weather the applicant was declared or adjudged as an insolvent by a court ? : </td>
									<td><label class="radio-inline"><input type="radio" name="is_declared" id="is_declared" value="Y"  <?php if(isset($is_declared) && $is_declared=='Y') echo 'checked'; ?> /> Yes</label>
									<label class="radio-inline"><input type="radio" name="is_declared"  value="N"  id="is_declared" <?php if(isset($is_declared) && $is_declared=='N') echo 'checked'; ?> /> No</label></td>
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
										<button type="submit" name="save1" class="btn btn-success submit1">Submit</button>
									</td>									
								</tr>
							</table>
							</form>
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
	
	
	
	$('.lice_value').attr('readonly','readonly');
	$('input[name=is_lic_prev]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.lice_value').removeAttr('readonly','readonly');
		}else{
			$('.lice_value').attr('readonly','readonly');
			$('.lice_value').val('');
		}			
	});
	
</script>
</body>
</html>