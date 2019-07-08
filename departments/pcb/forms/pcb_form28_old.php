<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="28";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_hw_form.php";

		//$email=$formFunctions->get_usermail($swr_id);
	    $row1=$formFunctions->fetch_swr($swr_id);
		
        $key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=$key_person."\nAddress : ".$street_name1." ".$street_name2."\nVill/Town : ".$vill.",".$dist."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nE-mail ID : ".$email;
		
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$q=$formFunctions->executeQuery($dept,"select * from pcb_form28 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_assoc();
		if($q->num_rows<1)////////for empty/////
		{	 
			$form_id="";
            $waste_cat="";$tot_qty="";$inc_waste="";$dt_of_storage="";$sender_name="";$sender_sn1="";		
		$sender_sn2="";$sender_vt="";$sender_dist="";$sender_pin="";$sender_mob="";$sender_phn1="";$sender_phn2="";$sender_email="";$sender_contact="";$receiver_name="";$receiver_sn1="";$receiver_sn2="";$receiver_vt="";$receiver_dist="";$receiver_pin="";$mobile_no="";$receiver_phn1="";$receiver_phn2="";$receiver_email="";$receiver_contact="";$emergency_no="";
			
			
		}
		else////////////for Not empty///////
		{
			$form_id=$results['form_id'];
            $waste_cat=$results["waste_cat"];$tot_qty=$results["tot_qty"];$inc_waste=$results["inc_waste"];$dt_of_storage=$results["dt_of_storage"];$sender_name =$results["sender_name"];$sender_sn1=$results["sender_sn1"];$sender_sn2=$results["sender_sn2"];$sender_vt=$results["sender_vt"];$sender_dist=$results["sender_dist"];$sender_pin =$results["sender_pin"];$sender_mob=$results["sender_mob"];$sender_phn1=$results["sender_phn1"];$sender_phn2=$results["sender_phn2"];$sender_email=$results["sender_email"];$sender_contact=$results["sender_contact"];$receiver_name=$results["receiver_name"];$receiver_sn1=$results["receiver_sn1"];$receiver_sn2=$results["receiver_sn2"];$receiver_vt=$results["receiver_vt"];$receiver_dist=$results["receiver_dist"];$receiver_pin=$results["receiver_pin"];$mobile_no=$results["mobile_no"];$receiver_phn1=$results["receiver_phn1"];$receiver_phn2=$results["receiver_phn2"];$receiver_email=$results["receiver_email"];$receiver_contact=$results["receiver_contact"];$emergency_no=$results["emergency_no"];$receiver_phn1=$results["receiver_phn1"];	
		
				
			
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
		 <?php require_once "../../requires/header.php";   ?>
		<?php require '../../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require '../../requires/banner.php'; ?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="text-center" >
									<?php echo $form_name=$formFunctions->get_formName($dept,$form);?>
								</h4>	
							</div>
							<div class="panel-body">
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">Handle with care</td>
									</tr>
									<tr>
										<td width="25%">Waste category and characteristics as per Part C of Schedules II and III of these rules</td>	
										<td width="25%"><input type="text"  name="waste_cat" value="<?php echo $waste_cat; ?>" class="form-control "></td>
										<td width="25%">Total quantity :</td>
										<td width="25%"><input type="text" name="tot_qty" value="<?php echo $tot_qty; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td>Incompatible wastes and substances :</td>
										<td><input type="text" name="inc_waste" value="<?php echo $inc_waste; ?>" class="form-control "></td>
										<td>Date of storage :</td>
										<td><input type="text" name="dt_of_storage" value="<?php echo $dt_of_storage; ?>" class=" dob form-control "></td>
									</tr>
									
									<tr>
									    <td colspan="4">Physical State of the waste (Solid/Semi-solid/liquid):</td>
									</tr>
									<tr>
									    <td colspan="4">Sender’s name and address:</td>
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" name="sender[name]" value="<?php echo $sender_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="sender[sn1]" value="<?php echo $sender_sn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="sender[sn2]" value="<?php echo $sender_sn2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="sender[vt]" value="<?php echo $sender_vt; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" name="sender[dist]" value="<?php echo $sender_dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" name="sender[pin]" value="<?php echo $sender_pin; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="sender[mob]" value="<?php echo $sender_mob; ?>" class="form-control text-uppercase"></td>
										<td>Phone No:</td>
										<td>
											<input type="text" name="sender[phn1]" value="<?php echo $sender_phn1; ?>" class="form-control text-uppercase">
											<input type="text" name="sender[phn2]" value="<?php echo $sender_phn2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" name="sender[email]" value="<?php echo $sender_email; ?>" class="form-control "></td>
										<td>Contact person:</td>
										<td><input type="text" name="sender[contact]" value="<?php echo $sender_contact; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td colspan="4">Receiver’s name and address:</td>
									</tr>
									<tr>
									     <td width="25%">Name :</td>
									     <td width="25%"><input type="text" name="receiver[name]" value="<?php echo $receiver_name; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Street Name 1:</td>
									     <td width="25%"><input type="text" name="receiver[sn1]" value="<?php echo $receiver_sn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Street Name 2:</td>
										<td><input type="text" name="receiver[sn2]" value="<?php echo $receiver_sn2; ?>" class="form-control text-uppercase"></td>
										<td>Village/Town:</td>
										<td><input type="text" name="receiver[vt]" value="<?php echo $receiver_vt; ?>"class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>District:</td>
										<td><input type="text" name="receiver[dist]" value="<?php echo $receiver_dist; ?>" class="form-control text-uppercase"></td>
										<td>Pincode:</td>
										<td><input type="text" name="receiver[pin]" value="<?php echo $receiver_pin; ?>" class="form-control"></td>
									</tr>
									<tr>
									    <td>Mobile No:</td>
										<td><input type="text" name="receiver[mob]" value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>Phone No:</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"><input type="text" name="receiver[phn2]" value="<?php echo $receiver_phn2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>Email Id:</td>
										<td><input type="text" name="receiver[email]" value="<?php echo $receiver_email; ?>" class="form-control "></td>
										<td>Contact person:</td>
										<td><input type="text" name="receiver[contact]" value="<?php echo $receiver_contact; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td>In case of emergency please Contact:</td>
										<td><input type="text" name="emergency_no" value="<?php echo $emergency_no; ?>" class="form-control "></td>
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
	$('#courierd input').attr('name=" "', 'name=" "');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' ||$file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC' ||$file9=='SC' ||$file10=='SC'||$file11=='SC'||$file12=='SC'||$file13=='SC'){	?>		
		$('#courierd input').removeAttr('name=" "', 'name=" "');
	<?php }else{ ?>
		$('#courierd input').attr('name=" "', 'name=" "');
	<?php } ?>
	/* ------------------------------------------------------ */
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>