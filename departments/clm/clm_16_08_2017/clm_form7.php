<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('clm','7');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=7&dept=clm';
		</script>";	
} else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=7&dept=clm';
		</script>";
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_clm_form.php";
	    $email=$formFunctions->get_usermail($swr_id);
		$row1=$formFunctions->fetch_swr($swr_id);
		$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
		$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
		$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

		$Name_of_owner=$row1['Name_of_owner'];
		$owners=Array();
		$owners=explode(",",$Name_of_owner);
		
		$q=$clm->query("select * from clm_form7 where user_id='$swr_id' and active='1'") or die($clm->error);
		if($q->num_rows<1) #################################Empty Form Details ################################	
		{	
			
			$form_id="";
			$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
			$brnch_nm="";$commodities="";$cst_no="";
		}
		else #################################Not Empty Form Details ################################	
		{
			$results=$q->fetch_assoc();
		    $form_id=$results["form_id"];
			$brnch_nm=$results["brnch_nm"];$commodities=$results["commodities"];$cst_no=$results["cst_no"];
	
			if(!empty($results["fac"])){
				$fac=json_decode($results["fac"]);
				$fac_name=$fac->name;$fac_strt_name1=$fac->strt_name1;$fac_strt_name2=$fac->strt_name2;$fac_vill=$fac->vill;$fac_dist=$fac->dist;$fac_pincode=$fac->pincode;
			}else{
				$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
			}
		}
##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabdiv1="";$tabbtn1="";$tabdiv2="";$tabbtn2="";$tabdiv3="";$tabbtn3="";$tabdiv4="";$tabbtn4="";$tabdiv5="";$tabbtn5="";
	if($showtab=="" || $showtab<2 || $showtab>2 || is_numeric($showtab)==false){
		$tabdiv1="style='display:block;'";$tabbtn1="active";$tabdiv2="style='display:none;'";$tabbtn2="";
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
									<strong><?php echo $form_name=$cms->query("select form_name from clm_form_names where form_no='7'")->fetch_object()->form_name; ?></strong>
								</h4>	
							</div>
                        <div class="panel-body">
	

							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
							<form name="my_form7" id="my_form7" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
							<table class="table table-responsive">


								 <tr>
									<td width="25%">1. (a) Name of the Firm: </td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $unit_name; ?>" ></td>
									<td width="25%">1. (b) Name of the Applicant:</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $key_person; ?>" /></td>
								</tr>
								<tr>
									<td colspan="4">2. Complete address of the Applicannt/Firm: </td>
								</tr>
								<tr>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name1; ?>"></td>
									<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $street_name2; ?>"></td>
								</tr>
								<tr>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase"  disabled="disabled" value="<?php echo $vill; ?>"></td>
									<td>District</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $dist; ?>"></td>
								</tr>
								<tr>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $pincode; ?>"></td>
									<td>Mobile No.</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $mobile_no; ?>"></td>
								</tr>	
								<tr>
									<td>Phone No.</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $landline_std; ?> - <?php echo $landline_no; ?>"></td>
									<td></td>
									<td></td>
								</tr>
								<tr>
									<td colspan="4">3. Registered office address: </td>
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
									<td>Block</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_block2; ?>"></td>
								</tr>
								<tr>
									<td>District</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_dist2; ?>"></td>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" disabled="disabled" value="<?php echo $b_pincode2; ?>"></td>
								</tr>
								<tr>
									<td colspan="4">4. Location of the factory: </td>
								</tr>
								
								<tr>
									<td width="25%">Factory Name</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="fac[name]" validate="letters" value="<?php echo $fac_name; ?>"></td>
									<td>Street Name 1</td>
									<td><input type="text" class="form-control text-uppercase"  name="fac[strt_name1]" value="<?php echo $fac_strt_name1; ?>"></td>
								</tr>
								<tr>
									<td>Street Name 2</td>
									<td><input type="text" class="form-control text-uppercase" name="fac[strt_name2]" value="<?php echo $fac_strt_name2; ?>"></td>
									<td>Village/Town</td>
									<td><input type="text" class="form-control text-uppercase" name="fac[vill]" value="<?php echo $fac_vill; ?>"></td>
								</tr>
								<tr>
									
									<td>District<span class="mandatory_field">*</span></td>
									<td><?php $dstresult=$mysqli->query("SELECT * FROM district WHERE district !='' GROUP BY district ASC")OR die("Error : ".$mysqli->error); ?>
									   <select name="fac[dist]" id="fac_dist" required class="form-control text-uppercase">
									   <option value="">Choose a district</option>
									   <?php
											  while($dstrows=$dstresult->fetch_object()) { 
											 if($fac_dist==$dstrows->district) $s='selected'; else $s=''; ?>
											  <option value="<?php echo $dstrows->district; ?>" <?php echo $s;?>><?php echo $dstrows->district; ?></option>
										<?php } ?>					
									</select></td>
									<td>Pincode</td>
									<td><input type="text" class="form-control text-uppercase" validate="pincode" maxlength="6"name="fac[pincode]" value="<?php echo $fac_pincode; ?>"></td>
								</tr>
								<tr>
									<td width="25%">5. Branches, if any :</td>
									<td width="25%"><input type="text" class="form-control text-uppercase" name="brnch_nm" value="<?php echo $brnch_nm; ?>" ></td>
									<td width="25%"></td>
									<td width="25%"></td>
								</tr>
								<td colspan="4">6. Name(s) of the Proprietor/Partners/Occupier :</td>
								<tr>
										<td colspan="4">
										<table class="table table-responsive text-center">
										<thead>
											<tr >
												<th>Sl. No.</th>
												<th>Name</th>
												<th>Father's/Spouse's Name</th>
												<th>Address</th>
												<th>Pincode</th>
												<th>Contact No</th>
											</tr>
										</thead>	
											<?php 
										$member_results=$clm->query("select * from clm_form7_members where form_id='$form_id'") or die("Error : ".$clm->error);
										
										if($member_results->num_rows==0){
											for($i=1;$i<=count($owners);$i++){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $owners[$i-1]; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" validate="pincode" maxlength="6" value="" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="10" value="" ></td>
											</tr>
											<?php } ?>
											<input type="hidden" name="hidden_value" value="<?php echo count($owners); ?>"/>
										<?php }else{
												$i=1;
										while($rows=$member_results->fetch_object()){ ?>
											<tr>
												<td><?php echo $i; ?></td>
												<td><input type="text" name="name<?php echo $i;?>" readonly="readonly" class="form-control text-uppercase" value="<?php echo $rows->name; ?>" /></td>
												<td><input type="text" name="family_name<?php echo $i;?>" class="form-control text-uppercase" validate="letters" value="<?php echo $rows->family_name; ?>" /></td>
												<td><input type="text" name="address<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->address; ?>" /></td>
												<td><input type="text" name="pincode<?php echo $i;?>" class="form-control text-uppercase" value="<?php echo $rows->pincode; ?>" maxlength="6" validate="pincode" ></td>
												<td><input type="text" name="contact<?php echo $i;?>" class="form-control text-uppercase" validate="onlyNumbers" pattern="[0-9]{10,11}" title="Please enter 10 digit number" maxlength="11" value="<?php echo $rows->contact; ?>" /></td>
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
									<td width="25%">7. Commodity(ies) intended to Pre-pack : </td>
									<td><input type="text" class="form-control text-uppercase" name="commodities"  value="<?php echo $commodities; ?>" ></td>
								
									<td width="25%">8. CST no./AGST no/MLT no. </td>
									<td><input type="text" class="form-control text-uppercase" name="cst_no" value="<?php echo $cst_no; ?>" ></td>
								</tr>
								<tr>
									<td colspan="4" align="center"><b><u>DECLARATION</u></b></td>
								</tr>
								<tr>
									<td colspan="4">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I/we hereby declare that the packages manufactured/packed will comply the various provisions of the Legal Metrology (Packaged Commodities) Rule, 2011.</td>
								</tr>
								<tr>
									<td>Date : <label><?php echo date('d-m-Y',strtotime($today));?></label><br/>
									Place: <label><?php echo strtoupper($dist); ?></label></td>
									<td></td>
									<td></td>
									<td align="right"> Signature: <label><?php echo strtoupper($key_person) ?></label><br/>Designation: <label><?php echo strtoupper($status_applicant) ?></label></td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">
										<button type="submit" name="save7" value="Save and Submit" class="btn btn-success submit1" title="Save it, if you want to complete it later" rel="tooltip" onclick="return confirm('Do you want to save..?')" >Save &amp; Next</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>