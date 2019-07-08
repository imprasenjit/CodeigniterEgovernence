<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('clm','12');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=12&dept=clm';
		</script>";	
} else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=12&dept=clm';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm1.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);
	
	$q=$clm->query("select * from clm_form12 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$make="";$model="";$accuracy="";$machine="";$platform="";$max_capacity="";$min_capacity="";$e_value="";
	}else{
		$form_id=$results['form_id'];
		$make=$results['make'];$model=$results['model'];$accuracy=$results['accuracy'];$machine=$results['machine'];$platform=$results['platform'];$max_capacity=$results['max_capacity'];$min_capacity=$results['min_capacity'];$e_value=$results['e_value'];		
	}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
		
		$tabbtn1="";$tabbtn2="";
		if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
			$tabbtn1="active";$tabbtn2="";
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
									<strong>FORM-6<br/><?php echo $form_name=$cms->query("select form_name from clm_form_names where form_no='12'")->fetch_object()->form_name; ?></strong>
								</h4>		
							</div>
							<div class="panel-body">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive">
									<tr>
										<td colspan="4"> To,<br/>&emsp;&emsp;&emsp;The Controller of Legal Metrology, Assam,<br/>&emsp;&emsp;&emsp;R.K. Mission Road, Ulubari,<br/>&emsp;&emsp;&emsp;Guwahati-781007
										</td>
									</tr>
									<tr>
										<td width="25%">1. (a) Name of the owner of the Weighbridge: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $key_person;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td colspan="4">(b) Address of the owner of the Weighbridge:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $mobile_no;?>"></td>
									</tr>
									<tr>
										<td width="25%">2. (a) Name of the Firm: </td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
									    <td>(b) Address of the Firm:</td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name1;?>"></td>
										<td>Street Name 2</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_street_name2;?>"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_vill;?>"></td>
										<td>District</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_dist;?>"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_pincode;?>"></td>
										<td>Mobile No.</td>
										<td><input type="text" class="form-control text-uppercase" disabled value="<?php echo $b_mobile_no;?>"></td>
									</tr>										
									<tr>
										<td colspan="4">3. Details of the Weighbridge:</td>
									</tr>
									<tr>
										<td colspan="4">
										<table class="table table-responsive">							
											<tr>
												<td width="25%">Make</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="make" value="<?php $make;?>"></td>
												<td width="25%">Model</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="model" value="<?php $model;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Accuracy Class</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="accuracy" value="<?php $accuracy;?>"></td>
												<td width="25%">Machine Sl. No.</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="machine" value="<?php $machine;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Platform Size</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="platform" value="<?php $platform;?>"></td>
												<td width="25%">Max. Capacity</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="max_capacity" value="<?php $max_capacity;?>"></td>
												
											</tr>
											<tr>
												<td width="25%">Min. Capacity</td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="min_capacity" value="<?php $min_capacity;?>"></td>
												<td width="25%">e-value</td>
												<td width="25%"><input type="text" class="form-control text-uppercase"  name="e_value" value="<?php $e_value;?>"></td>
											
											</tr>
										</table>
										</td>
									</tr>
									<tr>
										<td >
										   Date:&emsp;<strong><?php echo date('d-m-Y',strtotime($today)); ?></strong>
										   <br/>
										   Place:&emsp;<strong><?php echo strtoupper($dist)?></strong></td>
										<td></td>
										<td></td>
										<td align="right">Signature:&emsp;<strong><?php echo strtoupper($key_person); ?></strong><br/>
										Designation:&emsp;<strong><?php echo strtoupper($status_applicant); ?></strong><br/> </td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" name="save12" value="Save and Submit" class="btn btn-success" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
										</td>
									</tr>
								</table>
								</form>
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
	$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	$('a[href="#tab1"]').on('click', function(){
		
		$('#tab1').css('display', 'table');
		$('#tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab2"]').on('click', function(){
		
		$('#tab2').css('display', 'table');
		$('#tab1, #tab3, #tab4, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab3"]').on('click', function(){
		$('#tab3').css('display', 'table');
		$('#tab1, #tab2, #tab4, #tab5, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab4"]').on('click', function(){
		$('#tab4').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab5,#tab6,#tab7,#tab8,#tab9').css('display', 'none');
	});
	$('a[href="#tab5"]').on('click', function(){
		$('#tab5').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab6, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab6"]').on('click', function(){
		$('#tab6').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab7, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab7"]').on('click', function(){
		$('#tab7').css('display', 'table');
		$('#tab1, #tab2, #tab3,  #tab4, #tab5, #tab6, #tab8, #tab9').css('display', 'none');
	});
	$('a[href="#tab8"]').on('click', function(){
		$('#tab8').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab9').css('display', 'none');
	});
	$('a[href="#tab9"]').on('click', function(){
		$('#tab9').css('display', 'table');
		$('#tab1, #tab2, #tab3, #tab4, #tab5, #tab6, #tab7, #tab8').css('display', 'none');
	});
	/* ----------------------------------------------------- */
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
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>