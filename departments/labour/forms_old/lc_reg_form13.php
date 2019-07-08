<?php  require_once "../../requires/login_session.php";
$dept="labour";
$form="13";
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
		$l_o_business_val="Cooperative labour";$l_o_business_name="Members";
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
	//$sn1="";$sn2="";$v="";$d="";$p="";
	
	$q=$labour->query("select * from ".$table_name." where user_id=$swr_id and active='1'") or die($labour->error);
	if($q->num_rows<1){	 
		$form_id="";
		$motor_trns_name="";$nature="";$tot_no="";$tot_route="";$tot_n_motor="";$max_workers="";$gm_name="";$director_name=""; 
		$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
		$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
		$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];	
		$motor_trns_name=$results['motor_trns_name'];$nature=$results['nature'];$tot_no=$results['tot_no'];$tot_route=$results['tot_route'];$tot_n_motor=$results['tot_n_motor'];$max_workers=$results['max_workers'];$gm_name=$results['gm_name'];$director_name=$results['director_name'];
			
		if(!empty($results["mt_address"])){
			$mt_address=json_decode($results["mt_address"]);
			$mt_address_sn1=$mt_address->sn1;$mt_address_sn2=$mt_address->sn2;$mt_address_vill=$mt_address->vill;$mt_address_dist=$mt_address->dist;$mt_address_pin=$mt_address->pin;$mt_address_mob=$mt_address->mob;$mt_address_email=$mt_address->email;
		}else{
			$mt_address_name="";$mt_address_sn1="";$mt_address_sn2="";$mt_address_vill="";$mt_address_dist="";$mt_address_pin="";$mt_address_mob="";$mt_address_email="";
		}		
		if(!empty($results["gm_address"])){
			$gm_address=json_decode($results["gm_address"]);
			$gm_address_sn1=$gm_address->sn1;$gm_address_sn2=$gm_address->sn2;$gm_address_vill=$gm_address->vill;$gm_address_dist=$gm_address->dist;$gm_address_pin=$gm_address->pin;
		}else{
			$gm_address_sn1="";$gm_address_sn2="";$gm_address_vill="";$gm_address_dist="";$gm_address_pin="";
		}
		if(!empty($results["director_address"])){
			$director_address=json_decode($results["director_address"]);
			$director_address_sn1=$director_address->sn1;$director_address_sn2=$director_address->sn2;$director_address_vill=$director_address->vill;$director_address_dist=$director_address->dist;$director_address_pin=$director_address->pin;
		}else{
			$director_address_sn1="";$director_address_sn2="";$director_address_vill="";$director_address_dist="";$director_address_pin="";
		}
	}
	$q1=$labour->query("select * from ".$table_name."_members where form_id='$form_id'");
	if($q1->num_rows<1){
		$form_id="";
		$sn1="";$sn2="";$v="";$d="";$p="";
	}else{
		$results1=$q1->fetch_assoc();
		$form_id=$results1['form_id'];
		$sn1=$results1['sn1'];$sn2=$results1['sn2'];$v=$results1['v'];$d=$results1['d'];$p=$results1['p'];
	}
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
								<div id="table1" class="tab-pane" role="tabpanel">
								 <form name="my_form6" id="my_form6" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								 <table class="table table-responsive">
									<tr>
									    <td width="25%">1. Name of motor transport undertaking.</td>
									    <td width="25%"><input type="text" class="form-control text-uppercase" validate="letters" name="motor_trns_name" value="<?php echo $motor_trns_name; ?>"></td>
									    <td width="25%"></td>
									    <td width="25%"></td>
									</tr>
									<tr>
										<td colspan="4">2. Full address to which communications relating to the motor transport undertaking should be sent.</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[sn1]" value="<?php echo $mt_address_sn1; ?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[sn2]" value="<?php echo $mt_address_sn2; ?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="mt_address[vill]" value="<?php echo $mt_address_vill; ?>"></td>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                <select name="mt_address[dist]" class="form-control" id="gm_address_dist"  >
						                <?php
						 	             while($dstrows=$dstresult->fetch_object()) { 
							            if($mt_address_dist==$dstrows->district) $s='selected'; else $s=''; ?>
							              <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						                <?php } ?>					
						                </select></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase"  name="mt_address[pin]" value="<?php echo $mt_address_pin; ?>" validate="pincode" maxlength="6"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" validate="mobileNumber" name="mt_address[mob]" maxlength="10" value="<?php echo $mt_address_mob; ?>"></td>
									</tr>	
									<tr>
										<td>E-Mail ID</td>
										<td><input type="email" class="form-control" name="mt_address[email]" validate="email" value="<?php echo $mt_address_email; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td>3. Nature of motor transport service, e.g., City Service, long distance passenger service, long distance freight service.</td>
										<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
										<td>4. Total number of routes.</td>
										<td><input type="text" class="form-control" name="tot_no" value="<?php echo $tot_no; ?>"></td>
									</tr>
									<tr>
										<td>5. Total route mileage.</td>
										<td><input type="text" class="form-control" name="tot_route" value="<?php echo $tot_route; ?>"></td>
										<td>6. Total number of motor transport vehicles on the last date of the preceding year.</td>
										<td><input type="text" class="form-control" name="tot_n_motor" value="<?php echo $tot_n_motor; ?>"></td>
									</tr>
									<tr>
										<td>7. Maximum number of motor transport workers directored on any day during the preceding year.<span class="mandatory_field">*</span></td>
										<td><input type="text" class="form-control" name="max_workers" required="required" validate="onlyNumbers" value="<?php echo $max_workers; ?>"></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">8. Full names and residential address : </td>
									</tr>
									<tr>
										<td colspan="4">(i) Proprietor and partners of the motor transport undertaking in case of a firm not registered under the Companies Act, 1956; or</td>
									</tr>
									<tr>
										<td colspan="4">
										<table  class="table table-responsive">
										<thead>
											<tr >
												<th width="10%">Sl. No.</th>
												<th width="20%">Proprietor and Partners Name</th>
												<th width="10%">Street Name 1</th>
												<th width="10%">Street Name 2</th>
												<th width="10%">Village/Town</th>
												<th width="10%">District</th>
												<th width="10%">Pincode</th>
											</tr>
										</thead>	
										<?php 
										$member_results=$labour->query("select * from labour_form13_members where form_id='$form_id'") or die("Error : ".$labour->error);
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="" maxlength="6" validate="pincode" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="sn1<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn1; ?>" /></td>
												<td><input type="text" name="sn2<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->sn2; ?>" /></td>
												<td><input type="text" name="v<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->v; ?>" /></td>
												<td><input type="text" name="d<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->d; ?>" /></td>
												<td><input type="text" name="p<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->p; ?>" maxlength="6" validate="pincode" ></td>
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
										<td colspan="4">(ii) General manager in case of a public sector undertaking.</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="gm_name" value="<?php echo $gm_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[sn1]" value="<?php echo $gm_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[sn2]" value="<?php echo $gm_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[vill]" value="<?php echo $gm_address_vill; ?>"> </td>
									</tr>
									<tr>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                <select name="gm_address[dist]" class="form-control" id="gm_address_dist"  >
						                <?php
						 	             while($dstrows=$dstresult->fetch_object()) { 
							            if($gm_address_dist==$dstrows->district) $s='selected'; else $s=''; ?>
							              <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						                <?php } ?>					
						                </select></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="gm_address[pin]" value="<?php echo $gm_address_pin; ?>" validate="pincode" maxlength="6"></td>
									</tr>
									<tr>
										<td colspan="4">9. Full name and residential addresses of the Directors in the case of a company registered under the Companies Act, 1956.</td>
									</tr>
									<tr>
									    <td >Full Name</td>
									    <td><input type="text" class="form-control text-uppercase" name="director_name" validate="letters" value="<?php echo $director_name; ?>"></td>
									    <td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[sn1]" value="<?php echo $director_address_sn1; ?>"></td>
									</tr>
									<tr>										
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[sn2]" value="<?php echo $director_address_sn2; ?>"></td>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[vill]" value="<?php echo $director_address_vill; ?>"></td>
									</tr>
									<tr>
										<td>District</td>
										<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
						                <select name="director_address[dist]" class="form-control" id="director_address_dist"  >
						                <?php
						 	             while($dstrows=$dstresult->fetch_object()) { 
							            if($director_address_dist==$dstrows->district) $s='selected'; else $s=''; ?>
							              <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
						                <?php } ?>					
						                </select></td>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" name="director_address[pin]" validate="pincode" maxlength="6" value="<?php echo $director_address_pin; ?>"></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')">Save and Submit</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>