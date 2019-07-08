<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('clm','9');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=9&dept=clm';
		</script>";	
} else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=9&dept=clm';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
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
	
	$q=$clm->query("select * from clm_form9 where user_id='$swr_id'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$meeting_date="";$meeting_place="";
	}else{
		$form_id=$results['form_id'];	
		$meeting_date=$results['meeting_date'];$meeting_place=$results['meeting_place'];
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
									<strong>

									FORMAT FOR NOMINATION OF THE DIRECTOR BY THE COMPANY UNDER SUB-

									SECTION (2) OF THE LEGAL METROLOGY ACT, 2009</strong><br/>
								</h4>	
							</div>
							<div class="panel-body">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table id="tab1" class="table table-responsive">
									<tr>
										<td colspan="4" class="form-inline">
										&emsp;&emsp;Notice is hereby given that Shri/Smt. / Ms <input type="text" class="form-control" disabled value="<?php echo strtoupper($key_person) ?>"> Director of the  <input type="text" class="form-control" value="<?php echo strtoupper($unit_name); ?>" disabled>
										<input type="text" class="form-control" value="<?php echo strtoupper($b_dist); ?>" disabled> (name and address of the company) has been nominated by the company by a Resolution passed at their meeting held on <input type="text" class="dob form-control" name="meeting_date" value="<?php echo $meeting_date; ?>"> at <input type="text" class="form-control text-uppercase" name="meeting_place" value="<?php echo $meeting_place;?>"> to be 
								       charge of, and be responsible for the conduct of business of the company or any establishment/ branch/unit thereof and authorized to exercise all such powers and take all such steps as may be necessary or expedient to prevent the commission any offence by the said company under the Legal Metrology Act, 2009.</td>
									</tr>
									<tr>
									   <td colspan="4" class="form-inline">
									   &emsp;&emsp;&emsp;&emsp;Shri/Smt./Ms<input type="text" class="form-control" disabled value="<?php echo $key_person;?>"> Designation <input type="text" class="form-control" disabled value="<?php echo $status_applicant; ?>"> has accepted the said nomination and copy of said acceptance is enclosed herewith.
									   </td>
									</tr>
							
									<tr>
										<td colspan="4">
										&emsp;&emsp;&emsp;&emsp;A certified copy of the said Resolution is also enclosed.</td>
									</tr>
									
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									Place:<label><?php echo strtoupper($dist); ?></label></td>
															
									<td></td>
									<td></td>
									<td align="right"> <label><?php echo strtoupper($key_person) ?></label><br/>
									Managing Director/Secretary</br>

                                   (name of the company)</td>
								</tr>
								<tr>
									<td colspan="4">Note: Score out the portion which is not applicable.</td>
								</tr>
								<tr>
									<td colspan="4">&emsp;&emsp;&emsp;&emsp;I accept the above nomination in pursuance of sub – section (2) of Section 49 of the Legal Metrology Act, 2009 and Rule 29 of the Legal Metrology (General) Rules, 2011 made there under.</td>
								</tr>
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									 Place:<label><?php echo strtoupper($dist); ?></label></td>
									<td></td>
									<td></td>
									<td align="right"> <label><?php echo strtoupper($key_person); ?></label><br/>
									Director of <?php echo $unit_name;?>
									</td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">
											<button type="submit" name="save9" value="Save and Submit" class="btn btn-success" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
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