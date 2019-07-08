<?php  require_once "../../requires/login_session.php";

$check=$formFunctions->is_already_registered('tcp','3');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=3&dept=tcp';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=3&dept=tcp';
		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=3';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_tcp_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		
		$key_person=$row1['Key_person'];$owner_type=$row1['Type_of_ownership'];$owner_name=$row1['Name_of_owner'];$pan_no=$row1['pan_no'];$trade_name=$row1['Name'];$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_pincode=$row1['b_pincode'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$pincode=$row1['Pincode'];$block=$row1['block'];$std_code=$row1['Landline_std'];$phone_no=$row1['Landline_no'];$mobile_no=$row1['Mobile_no'];$cap_investment=$row1['Size_of_Investment'];
		$tcp_zone=$row1['b_block'];$id_proof_doc=$row1['id_proof_doc'];
		$sector_classes_b=$row1['sector_classes_b'];
		 
		$q=$tcp->query("select * from tcp_form3 where user_id='$swr_id' and active='1'") or die($tcp->error);
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";
			$ref_no="";$submit_dt="";$receive_dt="";$officer_name="";$add_line1="";$add_line2="";$engineer="";$engineer_address="";$owner_name="";$owner_address="";

			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}else{			
			$form_id=$results["form_id"];
			$ref_no=$results["ref_no"];$submit_dt=$results["submit_dt"];$receive_dt=$results["receive_dt"];$officer_name=$results["officer_name"];$add_line1=$results["add_line1"];$add_line2=$results["add_line2"];$engineer=$results["engineer"];$engineer_address=$results["engineer_address"];$owner_name=$results["owner_name"];$owner_address=$results["owner_address"];
			
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
		##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
	$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	if($showtab=="" || $showtab<2 || $showtab>5 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";$tabbtn4="";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==4){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="active";$tabbtn5="";$tabbtn6="";
	}
	if($showtab==5){
		$tabbtn1="";$tabbtn2="";$tabbtn3="";$tabbtn4="";$tabbtn5="active";$tabbtn6="";
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
		.form-control text-uppercase:focus{box-shadow:0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)}
		.form-control text-uppercase{
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
<div id="gif"></div>
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
								<h4 class="text-center text-bold" >
									<?php echo $form_name=$cms->query("select form_name from tcp_form_names where form_no='3'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
							    
								<br>
				<div class="tab-content">
					<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
						<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
                         <table class="table table-responsive">
								<tr>
									<td width="25%">Reference No.</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" name="ref_no" value="<?php echo $ref_no;?>"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<tr>
									<td>Owner's Name:</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $key_person;?>"></td>
									<td>Location:</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist;?>"></td>
								</tr>
								<tr>
									<td>Submitted on:</td>
									<td><input type="text"  class="dob form-control text-uppercase" name="submit_dt" value="<?php echo $submit_dt;?>"></td>
									<td>Received on:</td>
									<td><input type="text"  class="dob form-control text-uppercase" name="receive_dt" value="<?php echo $receive_dt;?>"></td>
								</tr>
								<tr>
									<td colspan="4" class="form-inline">
										The &nbsp;<input type="text"  class="form-control text-uppercase" name="officer_name" value="<?php echo $officer_name;?>"><br/>
										&nbsp;<input type="text"  class="form-control text-uppercase" name="add_line1" value="<?php echo $add_line1;?>"><br/>
										&nbsp;<input type="text"  class="form-control text-uppercase"  name="add_line2" value="<?php echo $add_line2;?>"><br/>
										Sir<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We hereby inform you that the work of execution of the building as per approved plan, working drawing and structural drawings has reached the first storey level and is executed under our supervision.<br/>
										We declare that the amended plan is not necessary at this stage.
									</td>
								</tr>
								<tr>
									<td colspan="4">Yours faithfully,</td>
								</tr>
								<tr>
									<td>Name of the Construction Engineer on Record </td>
									<td><input type="text"  class=" form-control text-uppercase" name="engineer" validate="letters"value="<?php echo $engineer;?>"></td>
									<td>Address of the Construction Engineer on Record </td>
									<td><textarea class="form-control text-uppercase" name="engineer_address"><?php echo $engineer_address;?></textarea></td>
									
								</tr>
								<tr>
									<td>Name of the Owner/Development/Builder </td>
									<td><input type="text"  class=" form-control text-uppercase" name="owner_name" validate="letters" value="<?php echo $owner_name;?>"></td>
									<td>Address of the Owner/Development/Builder </td>
									<td><textarea class="form-control text-uppercase" name="owner_address"><?php echo $owner_address;?></textarea></td>
									
								</tr>
								<tr>
									<td>Date : <strong><? echo date('d-m-Y',strtotime($today));?></strong></td>
									<td></td>
									<td></td>
									<td align="right">Signature Of the Applicant : <strong><?php echo $key_person;?></strong></td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">				
									<button type="submit" class="btn btn-success submit1" name="save3" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
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
		<?php if($is_v_ext=="N"){ ?>
	$('#v_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_v_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#v_no_floor').attr('disabled', 'disabled');
		else
			$('#v_no_floor').removeAttr('disabled');
	});
	<?php if($is_h_ext=="N"){ ?>
	$('#h_no_floor').attr('disabled', 'disabled');
	<?php } ?>
	$('input[name="is_h_ext"]').on('change', function(){
		if($(this).val() == 'N')
			$('#h_no_floor').attr('disabled', 'disabled');
		else
			$('#h_no_floor').removeAttr('disabled');
	});
	/* ---------------------upload S/C click operation-------------------- */
	
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC' || $file2=='SC' || $file3=='SC' || $file4=='SC' || $file5=='SC' || $file6=='SC' || $file7=='SC' || $file8=='SC'){	?>		
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
