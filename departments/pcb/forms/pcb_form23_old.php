<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('pcb','23');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=pcb';
		</script>";	
}
$get_file_name=basename(__FILE__);
include "save_hw_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$l_o_business=$row1['Type_of_ownership'];$Name_of_owner=$row1['Name_of_owner'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	$q=$pcb->query("select * from pcb_form23 where  user_id='$swr_id' and active='1'") or die($pcb->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	//Empty Table
		$issue_date="";$ref_no="";$monitoring_date="";
		$file1="";
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
	}
	else{
		$form_id=$results['form_id'];	
		$issue_date=$results["issue_date"];$ref_no=$results["ref_no"];$monitoring_date=$results["monitoring_date"];
		
		$file1=$results["file1"];
		if(!empty($results["courier_details"])){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}		
	}
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
									<strong><?php echo $form_name=$formFunctions->get_formName('pcb','23'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
								<ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								  <li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">Upload Section</a></li>
								</ul>
								<br>
								<div class="tab-content">
									<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myformFT1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4">1.Name and address of the facility:</td>
										</tr>
										<tr>
											<td width="25%">Name</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $unit_name;  ?>" disabled></td>
											<td width="25%">Street Name 1:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name1	; ?>" disabled></td>
										</tr>
										<tr>
											
											<td width="25%">Street Name 2:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_street_name2	; ?>" disabled></td>
											<td width="25%">Vill/Town:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_vill; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">District:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_dist; ?>" disabled></td>
											<td width="25%">PIN Code:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_pincode; ?>" disabled></td>
										</tr>
										<tr>
											<td width="25%">Mobile No:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_mobile_no; ?>" disabled></td>
											<td width="25%">Phone Number:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="" value="<?php echo $b_landline_std."-".$b_landline_no; ?>" disabled></td>
										</tr>
										<tr>
											<td colspan="4" >2. Date of issuance of authorisation and its reference number:</td>
										</tr>
										<tr>
											<td width="25%">(a)Date:</td>
											<td width="25%"><input class="dob form-control text-uppercase" type="text" name="issue_date" value="<?php $issue_date; ?>" ></td>
											<td width="25%">(b)Reference number:</td>
											<td width="25%"><input class="form-control text-uppercase" type="text" name="ref_no" value="<?php $ref_no; ?>" ></td>
										</tr>
										<tr>
											<td width="25%">3. Description of hazardous and other wastes handled (Generated or Received):</td>
											<td width="25%"></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td width="25%">4. Date of environmental monitoring (as per authorisation or guidelines of Central Pollution Control Board):</td>
											<td width="25%"><input class="dob form-control text-uppercase" type="text" name="monitoring_date" value="<?php $monitoring_date; ?>" ></td>
											<td width="25%"></td>
											<td width="25%"></td>
										</tr>
										<tr>
											<td>Date: <label><?php echo $today ?></label><br/>
														Place: <label><?php echo strtoupper($dist)?>
											</td>
											<td></td>
											<td></td>
											<td align="right"><label><?php echo $key_person; ?></label><br/>Signature of the Applicant</td>
										</tr>
										<tr>
											<td colspan="4" align="center">
											<button type="submit" name="save23" class="btn btn-success" title="Save it and go to the next part">Save & Next</button></td>
										</tr>
									</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="fileUpload" id="dic1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
									<table id="" class="table table-responsive">	
									<tr>
										<td colspan="5">Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).<br/><font color="red">*N/A--Not Available&emsp;*S/C--Send By Courier</td>
									</tr>
									<tr>
										<td width="50%">Date wise description of management of hazardous and other wastes including products sent and to whom in case of recyclers or pre-processor or utiliser:</td>
										<td width="10%">
										<select trigger="FileModal" id="file1" class="file1" <?php if($file1!="" || $file1=="SC" || $file1=="NA") echo "disabled='disabled'"; ?>>
												<option value="0" selected="selected">Select</option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
											</select>
										<input type="hidden" name="mfile1" value="<?php if($file1!="") echo $file1; ?>" id="mfile1" value=""/>					
										</td>
										<td width="20%" id="mfile1-chiranjit"><?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>&emsp;<a href="#!" id="file1" onclick="enableField(this.id)"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>'; } else { echo "No File Selected"; } ?></td>
										<td width="10%"><input type="CheckBox" id="A1" class="file1" name="A1" <?php if($file1=="NA") echo "checked"; ?>  value='A1' <?php if($file1!="" && $file1!="NA") echo "disabled"; ?> onClick="checkData(this)">N/A</td>
										<td width="20%"><input type="CheckBox" id="A2" class="file1 cd" name="A2" <?php if($file1=="SC") echo "checked"; ?> value='A2' <?php if($file1!="" && $file1!="SC") echo "disabled"; ?> onClick="checkData(this)">S/C</td>	
									</tr>
									<tr id="courierd">
									
										<td colspan="5">
											<table width="100%">
											<tr>
												<td colspan="6">Courier Details : </td>
											</tr>
											<tr>
												<td>Name of Courier Service <input type="text" required="required" name="courier_details[cn]" value="<?php echo $courier_details_cn; ?>" placeholder="Name" size="35" class="text-uppercase" ></td>
												<td>Ref. No. / Consignment No. <input type="text" required="required" name="courier_details[rn]" value="<?php echo $courier_details_rn; ?>" size="20" placeholder="Ref. Number" class="text-uppercase" ></td>
												<td>Dispatch Date <input type="datetime" required="required" value="<?php echo $courier_details_dt; ?>" name="courier_details[dt]" size="20" placeholder="DD/MM/YYYY" class="dob text-uppercase" ></td>
											</tr>
											</table>
										</td>
									
											
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="dic_form1.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
											<button type="submit" class="btn btn-success" name="submit23" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	<?php if($if_any=="N"){ ?>
		$('#PI_indicate').attr('disabled', 'disabled');
	<?php }?>
	$('input[name="if_any"]').on('change', function(){
		if($(this).val() == 'Y'){
			$('#PI_indicate').removeAttr('disabled', 'disabled');			
		}else{
			$('#PI_indicate').attr('disabled', 'disabled');			
		}
	});
	/* ---------------------upload S/C click operation-------------------- */
	
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC'){	?>		
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