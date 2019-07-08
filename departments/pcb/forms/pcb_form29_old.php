<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('pcb','29');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=29&dept=pcb';
		</script>";	
}
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

		$email=$formFunctions->get_usermail($swr_id);
	    $row1=$formFunctions->fetch_swr($swr_id);
		
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=$key_person."\nAddress : ".$street_name1." ".$street_name2."\nVill/Town : ".$vill.",".$dist."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nE-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$q=$pcb->query("select * from pcb_form29 where user_id='$swr_id' and active='1'") or die("Error :".$pcb->error);
		$results=$q->fetch_assoc();
		if($q->num_rows<1)////////for empty/////
		{	 
			$form_id="";

			
			
		}
		else////////////for Not empty///////
		{
			$form_id=$results['form_id'];	
			$owner_name=$results["owner_name"];$local_activity=$results["local_activity"];$qty_waste=$results["qty_waste"];$manufac_process=$results["manufac_process"];$is_gen_hazard =$results["is_gen_hazard"];	$hw_generate =$results["hw_generate"];		
		
				
			
		}
			##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==3){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:block;'";$tabbtn3="active";$tabdiv4="style='display:none;'";$tabbtn4="";
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
									<strong><?php echo $form_name=$cms->query("select form_name from pcb_form_names where form_no='29'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">1. Characteristics of hazardous and other wastes:</td>
									</tr>
									<tr>
									    <td colspan="4">
										<table id="" class="table table-bordered table-responsive text-center">
											<thead>
												<th>S. No.</th>
												<th>Type of waste</th>
												<th>Physical properties/</th>
												<th>Chemical constituents</th>
												<th>Exposure hazards</th>
												<th>First Aid requirements</th>
											</thead>
											<tr>
												<td></td>
												<td></td>
											</tr>
										</table>
										</td>									     
									</tr>
									<tr>
									    <td>2. Procedure to be followed in case of fire:</td>
										<td><input type="text"  value="<?php echo $b_email; ?>" class="form-control "></td>
										<td>3. Procedure to be followed in case of spillage/accident/explosion:</td>
										<td><input type="text"  value="<?php echo $b_email; ?>" class="form-control "></td>
									</tr>
									
									<tr>
									    <td colspan="4">4. For expert services, please contact:</td>
									</tr>
									<tr>
									    <td colspan="4">(i) Name and Address:</td>
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No:</td>
										<td><input type="text" disabled value="<?php echo $landline_std.$landline_no; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo $today ?></label><br/>
														Place: <label><?php echo strtoupper($dist)?>
										</td>
										<td colspan="2" align="right">Signature:<label><?php echo strtoupper($key_person)?>
										</label><br/>Name:<label><?php echo strtoupper($key_person)?> </td>
																					
									</tr>			
									<tr>										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save1a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' ||$file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC' ||$file9=='SC' ||$file10=='SC'||$file11=='SC'||$file12=='SC'||$file13=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>