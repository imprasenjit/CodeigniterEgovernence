<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('pcb','30');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=30&dept=pcb';
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
		
		$q=$pcb->query("select * from pcb_form30 where user_id='$swr_id' and active='1'") or die("Error :".$pcb->error);
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
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
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
									<strong><?php echo $form_name=$cms->query("select form_name from pcb_form_names where form_no='30'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									    <td colspan="4">1. Sender’s name and mailing address(including Phone No. and e-mail):</td>
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
									    <td>Email Id:</td>
										<td><input type="text" name="sender[email]" value="<?php echo $sender_email; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td>2. Sender’s authorisation No.:</td>
										<td><input type="text" name="sender[email]" value="<?php echo $sender_email; ?>" class="form-control "></td>
										<td>3. Manifest Document No.:</td>
										<td><input type="text" name="sender[contact]" value="<?php echo $sender_contact; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td colspan="4">4. Transporter’s name and address:(including Phone No. and e-mail):</td>
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
										<td><input type="text" name="receiver[mob]" value="<?php echo $receiver_mob; ?>" class="form-control text-uppercase"></td>
										<td>Email Id:</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>5. Type of vehicle:</td>
										<td><input type="checkbox" name="auth_req[Generation]" value="Generation " <?php if(isset($auth_req_col) && $auth_req_col=='Generation') echo 'checked'; ?>> Truck &nbsp;
										<input type="checkbox" name="auth_req[Collection]" value="Collection " <?php if(isset($auth_req_recept) && $auth_req_recept=='Collection ') echo 'checked'; ?>> Tanker &nbsp;
										<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Special Vehicle &nbsp;</td>
										<td>6. Transporter’s registration No.:</td>
										<td><input type="text" name="receiver[email]" value="<?php echo $receiver_email; ?>" class="form-control "></td>
									</tr>
									<tr>
									    <td>7. Vehicle registration No.:</td>
										<td><input type="text" name="receiver[email]" value="<?php echo $receiver_email; ?>" class="form-control "></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="4">8. Receiver’s name and mailing address (including Phone No. and e-mail):</td>
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
										<td>Email Id:</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>9. Receiver’s authorisation No.:</td>
										<td><input type="text" name="receiver[mob]" value="<?php echo '+91'.$mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>10. Waste description:</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>11. a) Total quantity:</td>
										<td><input type="text" name="receiver[mob]" value="<?php echo $mobile_no; ?>" class="form-control  text-uppercase">m<sup>3</sup> or MT</td>
										<td>b) No. of Containers</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td>12. Physical form:</td>
										<td><input type="text" name="receiver[mob]" value="<?php echo $mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>13. Special handling instructions and additional information</td>
										<td><input type="checkbox" name="auth_req[Generation]" value="Generation " <?php if(isset($auth_req_col) && $auth_req_col=='Generation') echo 'checked'; ?>> Solid &nbsp;
										<input type="checkbox" name="auth_req[Collection]" value="Collection " <?php if(isset($auth_req_recept) && $auth_req_recept=='Collection ') echo 'checked'; ?>> Semi-Solid &nbsp;
										<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Sludge &nbsp;<br/>
										<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Oily &nbsp;<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Tarry &nbsp;<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Slurry &nbsp;<input type="checkbox" name="auth_req[Storage]" value="Storage" <?php if(isset($auth_req_treatment) && $auth_req_treatment=='Storage') echo 'checked'; ?>> Liquid &nbsp;</td>
									</tr>
									<tr>
									    <td>12. Physical form:</td>
										<td><input type="text" name="receiver[mob]" value="<?php echo $mobile_no; ?>" class="form-control text-uppercase"></td>
										<td>13. Special handling instructions and additional information</td>
										<td><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">14. Sender’s Certificate</td>
									</tr>
									<tr>
										<td colspan="4">I hereby declare that the contents of the consignment are fully and
										accurately described above by proper shipping name and are categorised, packed, marked, and labelled, and are in all respects in proper conditions for transport by
										road according to applicable national government regulations.<br/><br/>
										Name and stamp: <input type="text" name="" class="form-control1 text-uppercase"> &nbsp; Signature: <input type="text" name="" class="form-control1 text-uppercase">&nbsp;Date: <input type="text" name="" class="form-control1 text-uppercase">
										</td>
									</tr>
									<tr>
										<td colspan="2">15. Transporter acknowledgement of receipt of Wastes</td>
										<td colspan="2"><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">
										Name and stamp: <input type="text" name="" class="form-control1 text-uppercase"> &nbsp; Signature: <input type="text" name="" class="form-control1 text-uppercase">&nbsp;Date: <input type="text" name="" class="form-control1 text-uppercase">
										</td>
									</tr>
									<tr>
										<td colspan="2">16. Receiver’s certification for receipt of hazardous and other waste:</td>
										<td colspan="2"><input type="text" name="receiver[phn1]" value="<?php echo $receiver_phn1; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4">
										Name and stamp: <input type="text" name="" class="form-control1 text-uppercase"> &nbsp; Signature: <input type="text" name="" class="form-control1 text-uppercase">&nbsp;Date: <input type="text" name="" class="form-control1 text-uppercase">
										</td>
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