<?php  require_once "../../requires/login_session.php";

$get_file_name=basename(__FILE__);
include "save_form.php";
		$email=$formFunctions->get_usermail($swr_id);
		$row1=$row1=$formFunctions->fetch_swr($swr_id);

		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		
		$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
		
		$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
		
		$str_today = strtotime($today);
		$today_date = strtotime("+7 day", $str_today);
		
			##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
	}
	if($showtab==2){
		$tabdiv1="style='display:none;'";$tabbtn1="";$tabdiv2="style='display:block;'";$tabbtn2="active";
		$tabdiv3="style='display:none;'";$tabbtn3="";$tabdiv4="style='display:none;'";$tabbtn4="";
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
									<strong>APPLICATION FOR TRANSIT PASS</strong>
								</h4>	
							</div>
							<div class="panel-body">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										<td>Choose the UAIN of the Certificate of Origin :</td>
										<td>
											<select name="ref_uain" id="ref_uain" onchange="select_ref_uain()" class="form-control text-uppercase">
												<option value="">Please Select</option>
												<?php
												if($ref_uain!=""){?>
													<option value="<?=strtoupper($ref_uain)?>" selected><?=strtoupper($ref_uain)?></option>		
												<?php				
												}
													$query_reg_form="SELECT uain FROM forest_form2 a, forest_form2_process b WHERE a.user_id='$swr_id' AND b.form_id=a.form_id AND (b.process_type='I' OR b.process_type='C') AND a.active='0' GROUP BY uain";
													$exec_query_reg_form=$formFunctions->executeQuery("forest",$query_reg_form);
													while($reg_res=$exec_query_reg_form->fetch_object()){
												?>
												<option value="<?=strtoupper($reg_res->uain)?>"><?=strtoupper($reg_res->uain)?></option>
												<?php } 
												?>
											</select>
										</td>
										<td colspan="2" align="right"><a href="previous_transit_pass.php" class="btn btn-info">Click here to view previous Transit pass</a></td>
									</tr>
									<tr>
										<td colspan="4">1. Name and residence of the Passholder :</td>
									</tr>
									<tr>
										<td width="25%">Name</td>
										<td width="25%"><input type="text" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
										<td width="25%"></td>
										<td width="25%"></td>
									</tr>
									<tr>
										<td>Street Name 1</td>
										<td><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
										<td>Street Name 2</td>
										<td><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Village/Town</td>
										<td><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
										<td>District</td>
										<td><input type="text" disabled value="<?php echo $dist; ?>"  class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>Pincode</td>
										<td><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control"></td>
										<td>Mobile</td>
										<td><input type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td>Phone Number</td>
										<td><input type="text" disabled value="<?php echo $b_landline_std.'-'.$b_landline_no; ?>" class="form-control"></td>
										<td>Email id</td>
										<td><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									</tr>
									<tr>
										<td colspan="4">2. Number and date of permit or Certificate of Origin :</td>
									</tr>
									<tr>
										<td>Number</td>
										<td><input type="text" name="permit_no"  value="" class="form-control text-uppercase"></td>
										<td>Date</td>
										<td><input type="text" name="permit_date"  value="" class="dobindia form-control text-uppercase"></td>
									</tr>
									<tr>
										<td colspan="4" id="tree_details">
											
										</td>
									</tr>
									<tr>
										<td>9. Locality Whence collected</td>
										<td><input type="text" name="locality_whence_collected"  value="" class="form-control text-uppercase"></td>
										<td>10. Place From which to be transported</td>
										<td><input type="text" name="transported_place"  value="" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>11. Destination</td>
										<td><input type="text" name="destination"  value="" class="form-control text-uppercase"></td>
										<td>12. Route Of Transport</td>
										<td><input type="text" name="transport_route"  value="" class="form-control text-uppercase"></td>
									</tr>
									<tr>
										<td>13. Date of transportation</td>
										<td><input type="text" name="transport_date"  value="" class="dobindia form-control text-uppercase"></td>
										<td>14. Date of Expiry</td>
										<td><input type="text" name="expire_date"  value="<?=date('d-m-Y',$today_date);?>" class="form-control text-uppercase" readonly="readonly"></td>                              
									</tr>
									<tr>
										<td colspan="4">Signature of the Passholder with Date :</td>
									</tr>
									<tr>
										<td>Date :</td>
										<td><label class="text-uppercase"><?php echo date('d-m-Y',strtotime($today)); ?></label></td>
										<td>Signature of the Passholder :</td>
										<td> <label class="text-uppercase"><?php echo $key_person; ?></label></td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success submit1" name="submit_tp" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">Submit</button>
										</td>
									</tr>
								</table>
								</form>
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
	/* ---------------------upload S/C click operation-------------------- */
	
	function select_ref_uain(){
		 if($("#ref_uain").val()==false){
			alert("Please select the reference UAIN !");
			$("#ref_uain").focus();
			return ;			
		}else{
			var ref_uain = $("#ref_uain").val();
		}
        
		$.ajax({
            type: "POST",
            url: "transit_pass_tree_details.php",
            data: { ref_uain: ref_uain},
            beforeSend:function(){
                $("#tree_details").html("<img src='../../../images/loading.gif' style='width:200px; height:150px; margin:250px auto'>");
            },
            success:function(data){
                $("#tree_details").html(data);
				$('table.search-table').tableSearch({
					searchText:'Search Table',
					searchPlaceHolder:'SEARCH HERE',
					divStyle:'float:right'
				});
            }
        });
	 }
		
	
</script>
</body>
</html>