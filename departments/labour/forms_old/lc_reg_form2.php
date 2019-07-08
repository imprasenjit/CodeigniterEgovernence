<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="2";
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
	
	$q=$labour->query("select * from ".$table_name." where user_id=$swr_id and active='1'") or die($labour->error);
	if($q->num_rows<1){	 
		$nature_work="";$father_name="";$max_workers="";$nature_w_emp="";
		$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
		//$enclose_treasury="";$enclose_amount="";$enclose_date="";
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$nature_work=$results["nature_work"];$father_name=$results["father_name"];	$max_workers=$results["max_workers"];$nature_w_emp=$results["nature_w_emp"];
		if(!empty($results["manager"])){				
			$manager=json_decode($results["manager"]);
			$manager_name=$manager->name;$manager_sn1=$manager->sn1;$manager_sn2=$manager->sn2;$manager_v=$manager->v;$manager_d=$manager->d;$manager_pin=$manager->pin;				
		}else{
			$$manager_name="";$manager_sn1="";$manager_sn2="";$manager_v="";$manager_d="";$manager_pin="";
		}		
		/*if(!empty($results["enclose"]))
		{
			$enclose=json_decode($results["enclose"]);
			$enclose_treasury=$enclose->treasury;$enclose_amount=$enclose->amount;$enclose_date=$enclose->date;
		}
		else
		{
			$enclose_treasury="";$enclose_amount="";$enclose_date="";
		}*/	
	}
?>
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
								<div id="table1" class="tab-pane" role="tabpanel">
									<form name="myform1" id="labourComF2" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td width="25%">1. (a) Name of Establishment, if any </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td colspan="4">(b) Location of The Establishment </td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name1; ?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name2; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled"  value="<?php echo $b_dist; ?>" /></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode; ?>"/> </td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">2. Postal address of the Establishment(Alternate Address) </td>
											</tr>
											<tr>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name3; ?>"></td>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_street_name4; ?>"></td>
											</tr>
											<tr>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill2; ?>"></td>
												<td>District</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist2; ?>"></td>
											</tr>
											<tr>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode2; ?>"></td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">3. Full name and address of the Principal Employer (furnish father's name in the case of individuals) </td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>"></td>
												<td>Father Name</td>
												<td><input type="text" class="form-control text-uppercase" validate="letters" name="father_name" value="<?php echo $father_name;?>"></td>
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
												<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
												<td></td>
												<td></td>
											</tr>									
											<tr>
												<td colspan="4">4. Full name and Address of the Manager or person responsible for the supervision and Control of the establishment.   </td>
											</tr>
											<tr>
												<td>Full Name</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[name]" value="<?php echo $manager_name; ?>" validate="letters"></td>
												<td>Street Name 1</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[sn1]"  value="<?php echo $manager_sn1; ?>"></td>
											</tr>
											<tr>
												<td>Street Name 2</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[sn2]" value="<?php echo $manager_sn2; ?>" ></td>
												<td>Village/Town</td>
												<td><input type="text" class="form-control text-uppercase" name="manager[v]" value="<?php echo $manager_v; ?>"></td>
											</tr>
											<tr>
												<td>District</td>
												<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
										<select name="manager[d]" id="m_dist" class="form-control text-uppercase"><?php
											while($dstrows=$dstresult->fetch_object()) { 
											if($manager_d==$dstrows->district) $s='selected'; else $s=''; ?>
											<option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
										<?php } ?>					
										</select></td>
												<td>Pincode</td>
												<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6" id="manager_pin" name="manager[pin]"  value="<?php echo $manager_pin; ?>" ></td>
											</tr>
											<tr>
												<td>5. Nature of work carried on in the Establishment </td>
												<td><textarea class="form-control text-uppercase" name="nature_work" maxlength="255" validate="letters"  validate="textarea"><?php echo $nature_work; ?> </textarea></td>
												<td>6. Nature of work in which contract labour is employed or is to be employed </td>
												<td><textarea class="form-control text-uppercase"  validate="textarea" validate="letters" name="nature_w_emp"><?php echo $nature_w_emp; ?></textarea></td>
											</tr>
											<tr>
												<td colspan="3">7. Maximum no. of Contract Labour to be employed in the Establishment on any day (through all the contractors)<span class="mandatory_field">*</span></td>
												<td><input type="text" class="form-control text-uppercase" required="required" validate="onlyNumbers" name="max_workers" value="<?php echo $max_workers; ?>"></td>
											</tr>
											<!--<tr>
												<td colspan="4">8. Particulars of treasury Receipt or the crossed Postal Order enclose </td>
											</tr>
											<tr>
												<td> Name of the treasury:<span class="mandatory_field">*</span> </td>
												<td><input type="text" class="form-control text-uppercase" name="enclose[treasury]" required="required" value="<?php echo $enclose_treasury; ?>"/></td>
												<td>Amount:<span class="mandatory_field">*</span> </td>
												<td><input type="text" class="form-control text-uppercase" required="required" validate="onlyNumber" value="<?php echo $enclose_amount; ?>" name="enclose[amount]"/></td>
											</tr>
											<tr>
												<td>Date:<span class="mandatory_field">*</span> </td>
												<td><input type="datetime" class="dob form-control text-uppercase" name="enclose[date]" placeholder="DD/MM/YYYY" required="required" value="<?php echo $enclose_date; ?>" readonly="readonly"></td>
												<td></td>											
												<td></td>											
											</tr>-->
											<tr>
												<td>Submission Date:</td>
												<td><label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
												<td>Signature of the Principal Employer:</td>
												<td ><label class="text-uppercase"><?php echo $key_person; ?></label></td>
											</tr>
											<tr>
												<td class="text-center" colspan="4">
													<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you really want to save the form ?')" >Save and Next</button>
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
	/* ------------------------------------------------------ */
	$('input[name="godown"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('.GodownExists').css('display', 'table-row');			
		}else{
			$('.GodownExists').css('display', 'none');			
		}
	});
</script>
</body>
</html>