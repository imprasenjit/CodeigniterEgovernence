<?php  require_once "../../requires/login_session.php"; 
$check=$formFunctions->is_already_registered('dmedu','1');
if($check==1){
	echo "<script>
				alert('Already Registered');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=1&dept=dmedu';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=1&dept=dmedu';
		</script>";
}else if($check==3){
	$showtab=10;
}else{
	$showtab="";
}
$get_file_name=basename(__FILE__);
include "save_dmedu_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$cei->query("select * from cei_form15 where user_id='$swr_id'") or die($cei->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		$install_at="";$install_lift="";
		
	}
	else{
		$form_id=$results['form_id'];	
		$install_at=$results['install_at'];$install_lift=$results['install_lift'];
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}			
	}
	
##PHP TAB management
	if(isset($_GET['tab'])) $showtab=$_GET['tab'];
	
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
		.form-control1{
			width:200px; background-color: #fff;
			background-image: none;border: 1px solid #ccc;border-radius: 4px;padding: 6px 12px;
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
									<strong><?php echo $form_name=$formFunctions->get_formName('dmedu','1'); ?></strong>
								</h4>	
							</div>
							<div class="panel-body">
							   <ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $$tabbtn2; ?>"><a href="#table2">Declaration</a></li>
								</ul>
								<br>
							    
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
								<table class="table table-responsive table-bordered">	
									<tr>
									    <td colspan="4">To,<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Registrar,<br/><br/>
										Assam Council of Medical Registration,Guwahati-6  <br/><br/>
										Dear Sir,<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May I request you to be so good as to get my name registered in the Register of Registered Medical Practitioners maintained by you under section 15 of the Assam Medical Act,1916.A fee of Rs.4000 required for the purpose is remitted by Bank Draft.To facilitate registration I furnish the following particulars:-   
							
										</td>
									</tr>	
                                <tr>
								       <td width="25%">1. Full Name(in block letters):</td>
									   <td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $key_person; ?>" class="form-control text-uppercase"></td>
									   <td width="25%"></td>
									   <td width="25%"></td>
								    </tr>
								    <tr>
									   <td width="25%">2. Father's Name:</td>
									   <td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $father; ?>" class="form-control text-uppercase"></td>
									   <td width="25%"></td>
									   <td width="25%"></td>
								    </tr>
									<tr>
									  <td colspan="4">3.Present Address :</td>
								   </tr>
								   <tr>
									 <td width="25%">Street name 1 :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									 <td width="25%">Street name 2 :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
								  </tr>
								  <tr>
								    <td width="25%">Village/Town :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
								    <td width="25%">District :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								  </tr>
								  <tr>
								    <td width="25%">Pin code :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
								    <td width="25%">Mobile No. :</td>
								    <td width="25%"><input  type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								 </tr>
								  <tr>
									<td width="25%">E-mail id:</td>
									<td width="25%"><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								 </tr>
								 <tr>
								   <tr>
									  <td colspan="4">4.Permanent Address :</td>
								   </tr>
								   <tr>
									 <td width="25%">Street name 1 :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $street_name1; ?>" class="form-control text-uppercase"></td>
									 <td width="25%">Street name 2 :</td>
									 <td width="25%"><input type="text" disabled value="<?php echo $street_name2; ?>" class="form-control text-uppercase"></td>
								  </tr>
								  <tr>
								    <td width="25%">Village/Town :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $vill; ?>" class="form-control text-uppercase"></td>
								    <td width="25%">District :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $dist; ?>" class="form-control text-uppercase"></td>
								  </tr>
								  <tr>
								    <td width="25%">Pin code :</td>
								    <td width="25%"><input type="text" disabled value="<?php echo $pincode; ?>" class="form-control text-uppercase"></td>
								    <td width="25%">Mobile No. :</td>
								    <td width="25%"><input  type="text" disabled value="<?php echo '+91'.$mobile_no; ?>" class="form-control"></td>
								 </tr>
								  <tr>
									<td width="25%">E-mail id:</td>
									<td width="25%"><input type="text" disabled value="<?php echo $email; ?>" class="form-control"></td>
									<td width="25%"></td>
									<td width="25%"></td>
								 </tr>
								 <tr>
								  <td colspan="4">5. Qualifications and dates there of(to be supported by certificates in original) :
										<table name="objectTable2" id="objectTable2" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="20%">Qualification</th>
													<th width="20">Date</th>
													<th width="20%">Upload Document</th>
												</tr>
												</thead>
												<?php
													$part2=$dmedu->query("SELECT * FROM dmedu_form1_t1 WHERE form_id='$form_id'");
													$num2 = $part2->num_rows;
													if($num2>0){
													  $count=1;
													  while($row_2=$part2->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["qualification"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															
															<td><input value="<?php echo $row_2["date"]; ?>" id="txtC<?php echo $count;?>" class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															
															 <td width="30%">
											               <select trigger="FileModal" id="filea" class="form-control text-uppercase filea">                                            
												           <option value="0" selected="selected"><?php echo uploadinfo($details_upload); ?></option>
												           <option value="1">From E-Locker</option>
												           <option value="2">From PC</option>
												           <option value="4">Send by Courier</option>
												           <option value="3">Not Applicable</option>
									 		             </select>
											             <input type="hidden" name="details_upload" id="mfilea" value="<?php echo $details_upload !== '' ? $details_upload : ''; ?>" />
										                 </td>
										                <td width="20%" id="tdfilea">
											             <?php if($details_upload!="" && $details_upload!="SC" && $details_upload!="NA"){ echo '<a href="'.$upload.$details_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										              </td>
																													</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
														<td><input id="txtE1" size="10"   class="form-control text-uppercase" name="txtE1"></td>
														<td><input id="txtF1" size="10"   class="form-control text-uppercase" name="txtF1"></td>														
													</tr>
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore2()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
										</td>
								   </tr>
								   <tr>
								    <td colspan="2">6. Date of completion of Internship: <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
								   </tr>
								   <tr>
								    <td colspan="2">7.Provisional Registration No.:
								    <input type="text" class="form-control1 text-uppercase" name="auth_no" required="required"  value="<?php echo $auth_no; ?>"> </td>
								   </tr>
								   <tr>
								   <td >8.Passport size Photograph in duplicate duly attested:</td>
										<td width="30%">
											<select trigger="FileModal" id="filea" class="form-control text-uppercase filea">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($details_upload); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
											<input type="hidden" name="details_upload" id="mfilea" value="<?php echo $details_upload !== '' ? $details_upload : ''; ?>" />
										</td>
										<td width="20%" id="tdfilea">
											<?php if($details_upload!="" && $details_upload!="SC" && $details_upload!="NA"){ echo '<a href="'.$upload.$details_upload.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
								   
									  							
									<tr>
										<td colspan="2">Date of Birth: <b><?php echo date('d-m-Y',strtotime($today)); ?></b></td>
										
									</tr>	
									</table>
								</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
					           <form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
					           <table class="table table-responsive">			
					           <tr>
							     
						       <td colspan="5">Declaration</td>
							     <tr>
								  <td>1.I solemnly pledge myself to consecrate my life to the service of humanity.
								  </td>
								 </tr>
								 <tr>
								  <td>2.I will give to my teachers the respect and gratitude which is their due.
								  </td>
								 </tr>
								 <tr>
								  <td>3.I will practise my profession with consciense and dignity.
                              </td>
							     </tr>
								  <tr>
                              <td>4.The health of my patient will be my first consideration.
							     </tr>
								  <tr>
                              <td>5.I will respect the secrets,which are confided in me.
							     </td>
								  </tr>
								  <tr>
							      <td>6.I will maintain by all means in my power,the honour and noble traditions of medical profession as laid down in the medical ethics.
								  </td>
								  </tr>
								  <tr>
								  <td>7.My collegues will be my brothers.
								  </td>
								  </tr>
								  <tr>
								  <td>8.I will not considerations of religion,nationality,race,party politics or social standing to intervene between my duty and my patient.
								  </td>
								  </tr>
								   <tr>
                                <td>9.I will maintain the utmost respect for human life from the time of conception.
							      </td>
								   </tr>
								   <tr>
							       <td>10.Even under threat,I will not use my medical knowledge contrary to the law of humanity:I make these promises solemnly,freely and upon my honour.
								   </td>
								   </tr>
								   <tr>
										
										<td colspan="2" align="right"><label><?php echo strtoupper($key_person) ?></label><br/>Signature of the owner</td>
										<td colspan="2" align="right"><label><?php echo strtoupper($street_name1) ?></label><br/>Address</td>
										
									</tr>	
									<tr>
										<td class="text-center" colspan="4">
											
											<button type="submit" class="btn btn-success submit1" name="submit15" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
	function display(){
            var same = document.getElementById('field1').value;
			document.getElementById('field2').value = same;			
        }
	/* ---------------------upload S/C click operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
	/* ------------------------------------------------------ */
</script>
</body>
</html>
							 
         							  
								 
								 