<?php  require_once "../../requires/login_session.php";
$dept="pcb";
$form="22";
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
	
	$q=$formFunctions->executeQuery($dept,"select * from pcb_form22 where user_id='$swr_id' and active='1'");
	$results=$q->fetch_assoc();
	if($q->num_rows<1)////////for empty/////
	{	$form_id="";
		$auth_no="";$dt_of_issue="";$ref_no="";$ref_date="";$auth_period="";$auth_subject="";		
		$auth_req_col="";$auth_req_recept="";$auth_req_treatment="";
	}
	else////////////for Not empty///////
	{
		$form_id=$results['form_id'];	
		$auth_no=$results["auth_no"];$dt_of_issue=$results["dt_of_issue"];$ref_no=$results["ref_no"];$ref_date=$results["ref_date"];$auth_period =$results["auth_period"];	$auth_subject =$results["auth_subject"];		
		
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
	<?php include ("pcb_form22_addmore.php"); ?>
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
								<ul class="nav nav-pills">
									<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
									<li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">Conditions</a></li>
								</ul>
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
									     <td width="25%">1. (a) Number of authorisation :</td>
									     <td width="25%"><input type="text" name="auth_no" value="<?php echo $auth_no; ?>" class="form-control text-uppercase"></td>
									     <td width="25%">Date of issue :</td>
									     <td width="25%"><input type="datetime" name="dt_of_issue" value="<?php echo $dt_of_issue; ?>" class=" dob form-control"></td>
									</tr>
									<tr>
										<td colspan="4">2. Reference of application (No. and date)</td>
									</tr>
									<tr>
									    <td>No:</td>
										<td><input type="text"  name="ref_no" value="<?php echo $ref_no; ?>" class="form-control text-uppercase"></td>
										<td>Date:</td>
										<td><input type="datetime" name="ref_date" value="<?php echo $ref_date; ?>"class="dob form-control text-uppercase"></td>
									</tr>
									<tr>
									    <td colspan="4">
										<input type="text" name="" value="<?php echo $ref_date; ?>" class="form-control1 text-uppercase"> of <input type="text" name="" value="<?php echo $ref_date; ?> "class="form-control1 text-uppercase"> is hereby granted an authorisation based on the enclosed signed inspection report for generation, collection, reception, storage, transport, reuse, recycling, recovery, pre-processing, co-processing,utilisation, treatment, disposal or any other use of hazardous or other wastes or both on the premises situated at <input type="text" name="" value="<?php echo $ref_date; ?>" class="form-control1 text-uppercase">.
										</td>
									</tr>
									<tr>
									    <td colspan="4">3. Details of Authorisation</td>
									</tr>
									<td colspan="4">
												<table name="objectTable1" class="table table-responsive table-bordered text-center "id="objectTable1" >
													<thead>
													<tr>
														<th>Sl No.</th>
														<th>Category of Hazardous Waste as per the Schedules I, II and III of these rules</th>
														<th>Authorised mode of disposal or recycling or utilisation or co-processing,etc.</th>
														<th>Quantity(Ton/Annum)</th>
														
													</tr>
													</thead>
													<?php
													$part1=$formFunctions->executeQuery($dept,"select * from pcb_form22_auth_detail where form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													$count=1;
													while($row_1=$part1->fetch_array()){	?>
													<tr>
														<td><input readonly="readonly" id="txtA<?php echo $count;?>" class="form-control text-uppercase"; value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
														<td><input value="<?php echo $row_1["category"]; ?>" pattern="[a-zA-Z0-9.\s]+" title="No special characters are allowed except Dot" id="txtB<?php echo $count;?>" class="form-control text-uppercase"; name="txtB<?php echo $count;?>"></td>
														<td><input value="<?php echo $row_1["auth_mode"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase"; name="txtC<?php echo $count;?>" ></td>
														<td>
														<td><input value="<?php echo $row_1["qty"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase"; name="txtD<?php echo $count;?>" ></td>											
													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" readonly="readonly" id="txtA1" size="1" class="form-control text-uppercase"; name="txtA1"></td>
														<td><input id="txtB1" title="No special characters are allowed except Dot" pattern="[a-zA-Z0-9.\s]+" class="form-control text-uppercase"; name="txtB1"></td>
														<td><input id="txtC1" class="form-control text-uppercase"; name="txtC1"></td>														
														<td><input id="txtD1" class="form-control text-uppercase"; name="txtD1"></td>
																												
														
													</tr>
													<?php } ?>
												</table>	
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
												<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>									
									</tr>
									<tr>
									    <td>4. The authorisation shall be valid for a period of</td>
										<td><input type="text"  name="auth_period" value="<?php echo $auth_period; ?>" class="dob form-control "></td>
										<td>5. The authorisation is subject to the following general and specific conditions
										(Please specify any conditions that need to be imposed over and above general conditions, if any):</td>
										<td><input type="text" name="auth_subject" value="<?php echo $auth_subject; ?>" class="form-control "></td>
									</tr>								
									<tr>
										
										<td class="text-center" colspan="4">
											<button type="submit" class="btn btn-success" name="save1a" title="Save it and fill up the form later and Go to the Next Part"  onclick="return confirm('Do you want to save..?')" >Save and Next</button>
										</td>
										
									</tr>
								</table>
								</form>
								</div>
                                <div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
								<table id="" class="table table-responsive">
									<tr>
										 <td colspan="4"><p><h4 class="text-center" ><strong>A. General conditions of authorisation:</strong></h4></p></td>
									</tr>
									<tr>
										<td colspan="4">
										<ol type="1. ">
										<li> The authorised person shall comply with the provisions of the Environment (Protection) Act,	1986, and the rules made there under.</li>

										<li> The authorisation or its renewal shall be produced for inspection at the request of an officer	authorised by the State Pollution Control Board.</li>

										<li> The person authorised shall not rent, lend, sell, transfer or otherwise transport the hazardous and other wastes except what is permitted through this authorisation.</li>

										<li> Any unauthorised change in personnel, equipment or working conditions as mentioned in the application by the person authorised shall constitute a breach of his authorisation.</li>

										<li> The person authorised shall implement Emergency Response Procedure (ERP) for which
										this authorisation is being granted considering all site specific possible scenarios such as spillages, leakages, fire etc. and their possible impacts and also carry out mock drill in this regard at regular interval of time;</li>

										<li> The person authorised shall comply with the provisions outlined in the Central Pollution Control Board guidelines on “Implementing Liabilities for Environmental Damages due to Handling and Disposal of Hazardous Waste and Penalty”.</li>

										<li> It is the duty of the authorised person to take prior permission of the State Pollution Control Board to close down the facility.</li>

										<li> The imported hazardous and other wastes shall be fully insured for transit as well as for any accidental occurrence and its clean-up operation.</li>
										<li> The record of consumption and fate of the imported hazardous and other wastes shall be maintained.</li>
										<li> The hazardous and other waste which gets generated during recycling or reuse or recovery or pre-processing or utilisation of imported hazardous or other wastes shall be treated and disposed of as per specific conditions of authorisation.</li>
										<li> The importer or exporter shall bear the cost of import or export and mitigation of damages if any.</li>
										<li> An application for the renewal of an authorisation shall be made as laid down under these Rules.</li>
										<li> Any other conditions for compliance as per the Guidelines issued by the Ministry of Environment, Forest and Climate Change or Central Pollution Control Board from time to time.</li>
										<li> Annual return shall be filed by June 30th for the period ensuring 31st March of the year.</li>
										
										</ol>
									</td>
									</tr>
									<tr>
										<td>B. Specific conditions:</td>
									</tr>
									<tr>
										<td colspan="2">Date: <label><?php echo $today; ?></label></td>
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of the Applicant</td>
									</tr>
									<tr>
										<td class="text-center" colspan="4">
											<a href="pcb_form21.php?tab=1"type="submit" class="btn btn-primary">Go Back & Edit</a>
										
											<button type="submit" class="btn btn-success" name="submit22" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')">FINAL SUBMIT</button>
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
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
</script>
</body>
</html>