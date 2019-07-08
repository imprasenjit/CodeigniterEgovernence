<?php  require_once "../../requires/login_session.php";
$dept="factory";
$form="14";
$ci->load->helper('get_uain_details');
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__); 
include "save_form.php";

//$email=$formFunctions->get_usermail($swr_id);
$row1=$row1=$formFunctions->fetch_swr($swr_id);
$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
$l_o_business=$row1['Type_of_ownership'];
$get_array_legal_entity_values=Array();
$get_array_legal_entity_values=get_legal_entity($l_o_business);
$get_array_legal_entity_values=explode("/",$get_array_legal_entity_values);
$l_o_business_val=$get_array_legal_entity_values[0];$l_o_business_name=$get_array_legal_entity_values[1];
$Name_of_owner=$row1['Name_of_owner'];
$owners=Array();
$owners=explode(",",$Name_of_owner); 
	
$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_array();		
		$form_id=$results["form_id"];		
	}else{
		$form_id="";$nature="";$no_of_workers="";$relay_no="";$period_m1="";$period_m2="";$period_m3="";$period_w1="";$period_w2="";$period_w3="";$period_c1="";$period_c2="";$period_c3="";$notice_dt="";$manager_sign="";$group_no="";$shift_no="";
	}
}else{	
	$results=$q->fetch_array();
	$form_id=$results["form_id"];
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
	<?php  require '../../../user_area/includes/css.php';?>
	<style>
		/* Over writes AdminLTE form styles */
		p{text-align: justify;}
		.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control text-uppercase{
			background-color: #fff;
			background-imtests: none;
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
<div id="gif"></div>
<div class="wrapper">
  <?php require_once "../../requires/header.php";   ?>
  <?php require '../../../user_area/includes/aside.php'; ?>
	<!-- Content Wrapper. Contains ptests content -->
	<div class="content-wrapper">
		<section class="content-header"></section>
		<section class="content">
			<?php require '../../requires/banner.php'; ?>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h4 class="text-center text-bold" >
								<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">
										<tr>
											<td width="25%">Name of factory : </td>
											<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>"></td>
											<td width="25%"></td>
											<td width="25%"></td>	
										</tr>
										<tr>
											<td>Place : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_vill; ?>"></td>
											<td colspan="2"></td>	
										</tr>
										<tr>
											<td>District : </td>
											<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist; ?>"></td>
											<td colspan="2"></td>	
										</tr>																					
										<tr>
											<td>1. Nature of work : </td>
											<td><input type="text" class="form-control text-uppercase" name="nature" value="<?php echo $nature; ?>"></td>
											<td>2. Group Number : </td>
											<td><input type="date" class="dob form-control" name="group_no" value="<?php echo $group_no; ?>"></td>
										</tr>																					
										<tr>
											<td>3. No. of workers in each group : </td>
											<td><input type="text" class="form-control text-uppercase" name="no_of_workers" value="<?php echo $no_of_workers; ?>"></td>											
											<td>4. Shift No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="shift_no" value="<?php echo $shift_no; ?>"></td>
										</tr>																					
										<tr>
											<td>5. Relay No. : </td>
											<td><input type="text" class="form-control text-uppercase" name="relay_no" value="<?php echo $relay_no; ?>"></td>
											<td colspan="2"></td>									
										</tr>
										<tr>
											<td colspan="4">6. Period of Work : </td>
										</tr>
										<tr>
											<td colspan="4">
											<table class="table table-responsive table-bordered text-center">
												<thead>
													<tr>
														<th colspan="9">Monday to Friday </th>
													</tr>
													<tr><th colspan="3">Men </th>
														<th colspan="3">Women </th>
														<th colspan="3">Children </th>
													</tr>
													<tr>
														<th>1st period </th>
														<th>2nd period </th>
														<th>3rd period </th>
														<th>1st period </th>
														<th>2nd period </th>
														<th>3rd period </th>
														<th>1st period </th>
														<th>2nd period </th>
														<th>3rd period </th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="text" class="form-control text-uppercase" name="period[m1]" value="<?php echo $period_m1; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[m2]" value="<?php echo $period_m2; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[m3]" value="<?php echo $period_m3; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[w1]" value="<?php echo $period_w1; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[w2]" value="<?php echo $period_w2; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[w3]" value="<?php echo $period_w3; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[c1]" value="<?php echo $period_c1; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[c2]" value="<?php echo $period_c2; ?>"></td>
														<td><input type="text" class="form-control text-uppercase" name="period[c3]" value="<?php echo $period_c3; ?>"></td>
													</tr>
												</tbody>
											</table>
											</td>
										</tr>
										<tr>
											<td>7. Date on which this notice is first exhibited : </td>
											<td><input type="date" class="dob form-control" name="notice_dt" value="<?php echo $notice_dt; ?>"></td>
											<td colspan="2"></td>									
										</tr>
										<tr class="form-inline">
											<td colspan="4" align="right">Signature of Manager : &nbsp;<input type="text" class="form-control text-uppercase" name="manager_sign" value="<?php echo $manager_sign; ?>">&nbsp;</td>
										</tr>										
										<tr>										
											<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save the form ?')" >Save & Next</button>
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
	<?php require_once "../../../views/users/requires/footer.php";  ?>
</div>
<!-- ./wrapper -->
<?php require '../../requires/js.php' ?>
<script>
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
</body>
</html>