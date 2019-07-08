<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="6";
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
	$sector_classes_b=$row1['sector_classes_b'];
	$business_type=get_sector_classes_b_value($sector_classes_b);
	
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$labour->query("select * from ".$table_name." where user_id=$swr_id and active='1'") or die($labour->error);
	if($q->num_rows<1){	 
		$fa_sp_name="";$employer_name=""; $dob_con=""; $age_con="";$max_workers="";$is_contractor_convict="";$is_contractor_revok="";$is_contractor_work="";$is_cert_enclose="";
		$contract_labour_a="";$contract_labour_b="";
		$manager_address_name="";$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_dist="";$manager_address_pin="";
		$employ_address_sn1="";$employ_address_sn2="";$employ_address_vt="";$employ_address_d="";$employ_address_p="";
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$fa_sp_name=$results['fa_sp_name'];$employer_name=$results['employer_name'];$dob_con=$results['dob_con'];$age_con=$results['age_con'];
		$max_workers=$results['max_workers'];$is_contractor_convict=$results['is_contractor_convict'];
		$is_contractor_revok=$results['is_contractor_revok'];$is_contractor_work=$results['is_contractor_work'];$is_cert_enclose=$results['is_cert_enclose'];
		if(!empty($results["contract_labour"])){
			$contract_labour=json_decode($results["contract_labour"]);
			$contract_labour_a=$contract_labour->a;$contract_labour_b=$contract_labour->b;
		}else{
			$contract_labour_a="";$contract_labour_b="";
		}		
		if(!empty($results["manager_address"])){
			$manager_address=json_decode($results["manager_address"]);
			$manager_address_name=$manager_address->name;$manager_address_sn1=$manager_address->sn1;$manager_address_sn2=$manager_address->sn2;$manager_address_vt=$manager_address->vt;$manager_address_dist=$manager_address->dist;$manager_address_pin=$manager_address->pin;
		}else{
			$manager_address_name="";$manager_address_sn1="";$manager_address_sn2="";$manager_address_vt="";$manager_address_dist="";$manager_address_pin="";
		}		
		if(!empty($results["employ_address"])){
			$employ_address=json_decode($results["employ_address"]);
			$employ_address_sn1=$employ_address->sn1;$employ_address_sn2=$employ_address->sn2;$employ_address_vt=$employ_address->vt;$employ_address_d=$employ_address->d;$employ_address_p=$employ_address->p;
		}else{
			$employ_address_sn1="";$employ_address_sn2="";$employ_address_vt="";$employ_address_d="";$employ_address_p="";
		}
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";$tabdiv5="";$tabbtn5="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";$tabdiv5="style='display:none;'";$tabbtn5="";
	}
	if($showtab==4){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:block;'";$tabbtn4="active";
		$tabdiv5="style='display:none;'";$tabbtn5="";
	}
	if($showtab==5){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
		$tabdiv5="style='display:block;'";$tabbtn5="active";
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
								  <li class="<?php echo $tabbtn1; ?>"><a requiredhref="#table1">Part 1</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a requiredhref="#table2">Part 2</a></li>
								  <li class="<?php echo $tabbtn3; ?>"><a requiredhref="#table3">Part 3</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								 <form name="my_form6" id="my_form6" class="submit1" method="post" ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4">1. Name and address of the contractor (including his father's/husband's name in case of individuals) </td>
									</tr>
									<tr>
									    <td width="25%">Full Name</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
									    <td width="25%">Father's/Spouse's Name</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" name="fa_sp_name" id="fa_sp_name" validate="letters" value="<?php echo $fa_sp_name; ?>"  ></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $vill; ?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
										<td>Mobile No.</td>
										<td><input type="number" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="text" class="form-control" disabled="disabled" value="<?php echo $email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">2. Date of birth and age (in case of individual) </td>
									</tr>
									<tr>
										<td >(a) Date:</td>
										<td><input type="datetime" id="dob" class="form-control text-uppercase" placeholder="DD/MM/YYYY" name="dob_con" onchange="date_of_birth(this.id)" value="<?php echo $dob_con; ?>"></td>
										<td>(b) Age:</td>
										<td><input type="text" class="form-control text-uppercase" id="owner_age" name="age_con"  value="<?php echo $age_con; ?>" validate="onlyNumbers" readonly="readonly"/></td>
									</tr>
									<tr>
										<td colspan="4">3. Particulars of establishment where migrant workmen are to be employed</td>
									</tr>
									<tr>
										<td colspan="4">(a) Name and address of the establishment :</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"> </td>
									</tr>
									<tr>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"></td>
									</tr>
									<tr>
										<td colspan="2">(b) Type of business, industry, manufacture or occupation, which is carried on in the establishment : </td>
										<td></td>
										<td><input type="text" class="form-control text-uppercase"  name="business_type" value="<?php echo $business_type; ?>" disabled="disabled" ></td>
									</tr>	
									
									<tr>
										<td colspan="4">(c) Full name and address of the Principal Employer : </td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="employer_name" validate="letters" value="<?php echo $employer_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="employ_address[sn1]" value="<?php echo $employ_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="employ_address[sn2]" value="<?php echo $employ_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="employ_address[vt]" value="<?php echo $employ_address_vt; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                <select name="employ_address[d]" class="form-control" id="employ_address_d"  >
						                <?php
						 	             while($dstrows=$dstresult->fetch_object()) { 
							            if($employ_address_d==$dstrows->district) $s='selected'; else $s=''; ?>
							              <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						                <?php } ?>					
						                </select></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="employ_address[p]" validate="pincode" maxlength="6" value="<?php echo $employ_address_p; ?>"></td>
									</tr>
									<tr>
										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>a" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
							<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
							<form name="my_form6" id="my_form6" class="submit1" method="post" ction="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
								    <tr>
								        <td colspan="4">4. Particulars of contract labour  </td>
								    </tr>
									<tr>
										<td width="25%">(a) Nature of work in which contract labour is employed or is to be employed in the establishment</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="contract_labour[a]"  ><?php echo $contract_labour_a; ?></textarea></td>
										<td width="25%">(b) Duration of the proposed contract work (give particulars of proposed date of commencing and ending)</td>
										<td width="25%"><textarea class="form-control text-uppercase" name="contract_labour[b]" ><?php echo $contract_labour_b; ?></textarea></td>			
									</tr>
									<tr>
										<td colspan="4">(c) Name and Address of the Agent or Manager of Contractor at the work site</td>
									</tr>
									<tr>
										<td>Full Name<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" value="<?php echo $manager_address_name; ?>" name="manager_address[name]" validate="letters" required></td>
										<td>Street Name 1<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[sn1]"  value="<?php echo $manager_address_sn1; ?>" required></td>
									</tr>
									<tr>
										<td>Street Name 2<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[sn2]"  value="<?php echo $manager_address_sn2; ?>" required></td>
										<td>Village/Town<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[vt]" value="<?php echo $manager_address_vt; ?>" required></td>
									</tr>
									<tr>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                <select name="manager_address[dist]" class="form-control text-uppercase"id="m_dist"  >
						                <?php
						 	             while($dstrows=$dstresult->fetch_object()) { 
							            if($manager_address_dist==$dstrows->district) $s='selected'; else $s=''; ?>
							              <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						                <?php } ?>					
						                </select></td>
										<td>Pincode<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" name="manager_address[pin]"  value="<?php echo $manager_address_pin; ?>" validate="pincode" maxlength="6" required></td>
									</tr>
									<tr>
										<td colspan="3">(d) Maximum No. of contract labour proposed to be employed in the establishment on any date.<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control text-uppercase" required="required" value="<?php echo $max_workers; ?>" name="max_workers" validate="onlyNumbers"></td>
									</tr>
									<tr>
										<td colspan="3">5. Whether the contractor was convicted of any offence within the preceding five years. If so, give details </td>
										<td><input type="text" class="form-control text-uppercase" name="is_contractor_convict" value="<?php echo $is_contractor_convict; ?>"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="lc_license_form<?php echo $form;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
						                   <button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>b" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Save & Next</button>
										</td>
									</tr>
								</table>
							</form>
							</div>
							<div id="table3" class="tab-pane <?php echo $tabbtn3; ?>" role="tabpanel">
							<form name="my_form6" id="my_form6" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table  class="table table-responsive">
									
									<tr>
										<td colspan="3">6. Whether there was any order against the contractor revoking or suspending licence or forfeiting security deposit in respect of an earlier contract. If so, the date of such order.</td>
										<td width="25%"><input type="text" class="form-control text-uppercase"  name="is_contractor_revok" value="<?php echo $is_contractor_revok; ?>"></td>
									</tr>
									<tr>
										<td colspan="3">7. Whether the contractor has worked in any other establishment within the past five years. If so, give details of the Principal Employer, establishments and nature of work.</td>
										<td ><textarea class="form-control text-uppercase" name="is_contractor_work" ><?php echo $is_contractor_work; ?></textarea></td>
									</tr>
									<tr>
									    <td colspan="3">8. Whether a certificate by the Principal Employer in Form V is enclosed.</td>
									    <td>
											 <label class="radio-inline"><input type="radio" name="is_cert_enclose"  value="Y" <?php if($is_cert_enclose=='Y') echo 'checked'; ?> checked> Yes </label>
											<label class="radio-inline"><input type="radio" name="is_cert_enclose" value="N" <?php if($is_cert_enclose=='N') echo 'checked'; ?> />&nbsp;No </label></td>
										</td>
									</tr>
									<tr>
									    <td colspan="4">Declaration– I hereby declare that the details given above are correct to the best of my knowledge and belief.</td>
									</tr>
									<tr>
										<td colspan="2" class="form-inline text-uppercase">Date : <label><?php echo date('d-m-Y',strtotime($today)); ?></label><br/>
										Place : <label><?php echo $dist; ?></label> <br/><br/></td>
										<td colspan="2" class="form-inline text-uppercase" align="center">
											<label><?php echo $key_person; ?></label><br/>Signature of the Applicant (Contractor)<br/>
										</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="lc_license_form<?php echo $form;?>.php?tab=2" class="btn btn-primary">Go Back & Edit</a>
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>c" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	function date_of_birth(obj){
		
		var str2=$('#'+obj).val();
		var str3 = str2.replace('-','');
		var str = str3.replace('-','');
		
		var day=Number(str.substr(0,2));		
		var month=Number(str.substr(2,2))-1;
		var year=Number(str.substr(4,4));
		
		var today=new Date();
		var age=today.getFullYear()-year;
		
		
		if((today.getMonth()< month) || (today.getMonth()==month && today.getDate()<day))
		{
			age--;
		}
		if(age<18)
		{
			alert('Your age must be greater than 18 to fill up this form');
			$('#owner_age').val('');
			$('#dob').val('');
			
		}
		else
		{
			$('#owner_age').val(age);
			
		}	
	}
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>