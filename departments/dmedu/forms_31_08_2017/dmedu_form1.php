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
}else{
	$showtab="";
}
 
$get_file_name=basename(__FILE__);
 
include "save_form.php";
$email=$formFunctions->get_usermail($swr_id);
$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];
	$unit_name=$row1['Name'];
	$street_name1=$row1['Street_name1'];
	$street_name2=$row1['Street_name2'];
	$vill=$row1['Vill'];
	$dist=$row1['Dist'];
	$pincode=$row1['Pincode'];
	$mobile_no=$row1['Mobile_no'];
     $b_street_name1=$row1['b_street_name1'];
	 $b_street_name2=$row1['b_street_name2'];
	 $b_vill=$row1['b_vill'];
	 $b_dist=$row1['b_dist'];

	 $b_pincode=$row1['b_pincode'];
	 $ubin=$row1['ubin'];
	 
	 
	$from=$key_person."<br/>Designation : ". $street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
    

	$q=$dmedu->query("select * from dmedu_form1 where user_id='$swr_id' and active='1'") or die("Error :".$dmedu->error);
	$results=$q->fetch_assoc();
	if($q->num_rows<1){	 
		$form_id="";
		########## Part A ###############
	
		$father_name="";$completion_date="";
		$registration="";
		
		$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		
	}else{
		$form_id=$results['form_id'];	
		#### Part A #####
		
		$father_name=$results["father_name"];$completion_date=$results["completion_date"];
		$registration=$results["registration"];
		
		#### Part B #####
		$file1=$results["file1"];
		$file2=$results["file2"];
		
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}			
}

##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	
	$tabbtn1="";$tabbtn2="";
	if($showtab=="" || $showtab<3|| $showtab>3 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2="";$tabbtn3="";
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active";$tabbtn3="";
	}
	if($showtab==3){
		$tabbtn1="";$tabbtn2="";$tabbtn3="active";
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
	<?php include ("dmedu_form1_addmore.php"); ?> <!-- File handles 'Addmore' Operation -->
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
									<strong>FORM NO. 1</strong><br/><strong><?php echo $form_name=$formFunctions->get_formName('dmedu','1');?></strong>
								</h4>	
							</div>
						   <div class="panel-body">
						    <ul class="nav nav-pills">
								  <li class="<?php echo $tabbtn1; ?>"><a href="#table1">PART I</a></li>
								  <li class="<?php echo $$tabbtn2; ?>"><a href="#table2">UPLOAD SECTION</a></li>
								  
								</ul>
								<br>
							<div class="tab-content">
							<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
							<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							
							<table  class="table table-responsive">   
							           <tr>
									    <td colspan="4">To,<br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Registrar,<br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										Assam Council of Medical Registration,Guwahati-6  <br/><br/>
										Dear Sir,<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;May I request you to be so good as to get my name registered in the Register of Registered Medical Practitioners maintained by you under section 15 of the Assam Medical Act,1916. A fee of Rs.4000 required for the purpose is remitted by Bank Draft.To facilitate registration I furnish the following particulars:-   
							
										</td>
									   </tr>										
								
								    <tr>
									 <td width="25%">1. Full Name(in block letters):</td>
									 <td width="25%"><input type="text" validate="specialChar" disabled value="<?php echo $key_person; ?>" class="form-control   text-uppercase"></td>
									 <td width="25%"></td>
									 <td width="25%"></td>
								   </tr>
								    
							         
								    <tr>
										<td>Father Name :</td>
										<td><input type="text" class="form-controll text-uppercase" name="father_name"  value="<?php echo  $father_name; ?>"></td>
									
								       <td width="25%"></td>
										<td width="25%"></td>
									 
									</tr>
								     <tr>
									  <td colspan="4">3. Present Address :</td>
								     </tr>
							        <tr>
										<td width="25%">&nbsp;  Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name1; ?>"></td>
										<td width="25%">&nbsp; Street Name2 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $street_name2; ?>" ></td>
								    </tr>
									<tr>
										<td> &nbsp;Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $vill; ?>"></td>
										<td> &nbsp;&nbsp;District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $dist; ?>"></td>
									</tr>
									<tr>
										<td> &nbsp;Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $pincode; ?>"></td>
										
									</tr>
									
								    <tr>
								 
									     <td colspan="4">4.Permanent Address :</td>
								   </tr>
								    <tr>
										<td width="25%">&nbsp;Street Name1 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $b_street_name1; ?>"></td>
										<td width="25%">&nbsp;Street Name2 :</td>
										<td width="25%"><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" validate="jsonOb" value="<?php echo $b_street_name2; ?>" ></td>
							      </tr>
									<tr>
										<td>&nbsp;Village/Town :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_vill; ?>"></td>
										<td>&nbsp;District :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_dist; ?>"></td>
									</tr>
									<tr>
										<td>&nbsp;Pin Code :</td>
										<td><input type="text" class="form-control text-uppercase" disabled="disabled" readonly="readonly" value="<?php echo $b_pincode; ?>"></td>
										
								   </tr>
								    <tr>
								    <td colspan="4">5. Qualifications and dates there of(to be supported by certificates in original) :
										<table name="objectTable1" id="objectTable1" class="table table-responsive text-center">
												<thead>
												<tr>
													<th width="5%">Sl. No.</th>
													<th width="50%">Qualification</th>
													<th width="50%">Date</th>
													</th>
												</tr>
												</thead>
												<?php
													$part1=$dmedu->query("SELECT * FROM dmedu_form1_t1 WHERE form_id='$form_id'");
													$num = $part1->num_rows;
													if($num>0){
													  $count=1;
													  while($row_2=$part1->fetch_array()){	?>
														<tr>
															<tr>
															<td><input type="text" readonly id="txxtA<?php echo $count;?>" class="form-control text-uppercase"  value="<?php echo $row_2["slno"]; ?>" name="txxtA<?php echo $count;?>" size="1"></td>
															<td><input id="txxtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["qualification"]; ?>" name="txxtB<?php echo $count;?>" size="10"></td>
															
															<td><input type="text" value="<?php echo $row_2["pass_date"]; ?>"  id="txxtC<?php echo $count;?>" class="dob form-control text-uppercase" name="txxtC<?php echo $count;?>"></td>
															
															
															
															
															
															
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input type="text"  readonly value="1" id="txxtA1" size="1"  class="form-control text-uppercase"  name="txxtA1"></td>
														<td><input type="text" id="txxtB1" size="10" class="form-control text-uppercase" name="txxtB1"></td>
														<td><input type="text" id="txxtC1" size="10" class="dob form-control text-uppercase" name="txxtC1"></td>
														
														
													</tr>
																													                    
													<?php } ?>														
												</table>
											<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMore1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
										</td>
								     </tr>
									 <tr>
								    <td width="25%">6. Date of completion of Internship. : <td width="25%"><input type="date" class="dob form-control text-uppercase" name="completion_date"  value="<?php echo $completion_date;?>"></td></td>
								
									
								
								    <td width="25%">7.Provisional Registration No. :</td>
									<td><input type="text" class="form-control text-uppercase" name="registration"  value="<?php echo  $registration; ?>"></td>
								    
									
								   </tr>
								   <table class="table table-responsive ">	
								<tr>
									<td >DECLARATION<span class="mandatory_field">*</span><br/></td>
								</tr>
								<tr>
									<td colspan=4 >1.&nbsp;&nbsp;  I solemnly pledge myself to consecrate my life to the service of humanity.</td>
									
								</tr>
								<tr>
									<td colspan=4>2.	&nbsp;&nbsp;I will give to my teachers the respect and gratitude which is their due.</td>
									
								</tr>
								
								<tr>
									<td colspan=4>3.&nbsp;&nbsp;	I will practise my profession with consciense and dignity.</td>
									
								</tr>
                             	<tr>
									<td colspan=4>4.&nbsp;&nbsp;	The health of my patient will be my first consideration.</td>
									
								</tr>
								
                            </tr>
                             <tr>
									<td colspan=4>5.&nbsp;&nbsp;	I will respect the secrets,which are confided in me.</td>
									
								</tr>
								<tr>
									<td colspan=4>6.&nbsp;&nbsp;	I will maintain by all means in my power,the honour and noble traditions of medical profession as laid down in the medical ethics.</td>
									
								</tr>
								<tr>
									<td colspan=4>7.&nbsp;&nbsp;	My collegues will be my brothers.</td>
									
								</tr>
								<tr>
									<td colspan=4>8.&nbsp;&nbsp;	I will not considerations of religion,nationality,race,party politics or social standing to intervene between my duty and my patient.</td>
									
								</tr>
								<tr>
									<td colspan=4>9.	&nbsp;&nbsp;I will maintain the utmost respect for human life from the time of conception.</td>
									
								</tr>
								<tr>
									<td colspan=4>10.&nbsp;&nbsp;	Even under threat,I will not use my medical knowledge contrary to the law of humanity:I make these promises solemnly,freely and upon my honour.</td>
									
								</tr>
									<tr>
										
										<td colspan="2" align="right">Signature of the owner: &nbsp;<strong><?php echo strtoupper($key_person)?></strong><br/>
										Address:&nbsp; <label><?php echo strtoupper($street_name1)?></strong>
										</td>
									</tr>	
								   

									<tr>
										<td colspan="4" class="text-center">
										<button type="submit" class="btn btn-success submit1" name="save1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next </button></td>
									</tr>
									
									
								   
                                
								</table>
							</form>
							</div>
							
							<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
				          <form name="fileUpload"  id="myform1" class="submit1" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
				        <table id="" class="table table-responsive">	
					      <tr>
						   <td colspan="5">Documents to be enclosed<span class="mandatory_field">*</span></br>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
					    </tr>
						<tr>
						<td width="50%">Qualifications:</td>
						<td width="30%">
                                            <select trigger="FileModal" id="file1" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
										</td>
										
						              <td width="20%" id="tdfile1">
                                            <?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
                                  </td>
									</tr>
					            <tr>
								   <td width="50%">Passport size Photograph in duplicate duly attested:</td>
										<td width="30%">
                                            <select trigger="FileModal" id="file2" class="form-control">                                            
                                                <option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
                                                <option value="1">From E-Locker</option>
                                                <option value="2">From PC</option>
                                                <option value="4">Send by Courier</option>
                                                <option value="3">Not Applicable</option>
                                            </select>
                                            <input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
										</td>
										 <td width="20%" id="tdfile2">
                                            <?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
									</tr>
									<tr>
									<td class="text-center" colspan="5">
										
										<a href="dmedu_form1.php?tab=1" type="button" class="btn btn-primary">Go Back & Edit</a>	
										<button type="submit" class="btn btn-success submit1" name="submit1" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
$(document).ready(function(){
			$("#heating_value").on("change", function(){	
				$('input[id="is_fabrication_n"]').prop('checked', true);
				var putValue = $(this).val()
				if(putValue > 3000){
				var calValue = putValue-3000 ;
				var calValue2 = Math.floor(calValue/200);
				var calValue3 = Math.floor(calValue2 * 600);
				var calValue4 = Math.floor(calValue3 + 21600);
				$('#reg_fees').val(calValue4);
				
				
				}
			});
			$('input[id="boiler_type_a"]').on('change', function(){
				if($(this).val() == 'U'){
					$('input[value="WT"]').prop('checked', true);
					$('input[id="boiler_type_b"]').attr('disabled', 'disabled');
				}else{
					$('input[value="WT"]').prop('checked', '');
					$('input[id="boiler_type_b"]').attr('disabled', false);
				}
			});
			$('input[name="heating_value"]').on('change', function(){
				//alert(typeof $(this).val());
				if($(this).val() <= 10){
					$('select[name="heating_select"] option[value="2"]').prop('selected', true);
					 $('#reg_fees').val("1800");
					 $('#heating').val("2");
				}else if($(this).val() >= 11 && $(this).val() < 30){
					$('select[name="heating_select"] option[value="3"]').prop('selected', true);
					$('#reg_fees').val("2400");
					$('#heating').val("3");					
				}else if($(this).val() >= 31 && $(this).val() <= 50){
					$('select[name="heating_select"] option[value="4"]').prop('selected', true);
					$('#reg_fees').val("2700");
					$('#heating').val("4");
				}else if($(this).val() >= 51 && $(this).val() <= 70){
					$('select[name="heating_select"] option[value="5"]').prop('selected', true);
					$('#reg_fees').val("3300");
					$('#heating').val("5");
				}else if($(this).val() >= 71 && $(this).val() <= 90){
					$('select[name="heating_select"] option[value="6"]').prop('selected', true);
					$('#reg_fees').val("3900");
					$('#heating').val("6");
				}else if($(this).val() >= 91 && $(this).val() <= 110){
					$('select[name="heating_select"] option[value="7"]').prop('selected', true);
					$('#reg_fees').val("4500");
					$('#heating').val("7");
				}else if($(this).val() >= 111 && $(this).val() <= 200){
					$('select[name="heating_select"] option[value="8"]').prop('selected', true);
					$('#reg_fees').val("5100");
					$('#heating').val("8");
				}else if($(this).val() >= 201 && $(this).val() <= 400){
					$('select[name="heating_select"] option[value="9"]').prop('selected', true);
					$('#reg_fees').val("5700");
					$('#heating').val("9");
				}else if($(this).val() >= 401 && $(this).val() <= 600){
					$('select[name="heating_select"] option[value="10"]').prop('selected', true);
					$('#reg_fees').val("6600");
					$('#heating').val("10");
				}else if($(this).val() >= 601 && $(this).val() <= 800){
					$('select[name="heating_select"] option[value="11"]').prop('selected', true);
					$('#reg_fees').val("7200");
					$('#heating').val("11");
				}else if($(this).val() >= 801 && $(this).val() <= 1000){
					$('select[name="heating_select"] option[value="12"]').prop('selected', true);
					$('#reg_fees').val("8100");
					$('#heating').val("12");
				}else if($(this).val() >= 1001 && $(this).val() <= 1200){
					$('select[name="heating_select"] option[value="13"]').prop('selected', true);
					$('#reg_fees').val("9600");
					$('#heating').val("13");
				}else if($(this).val() >= 1201 && $(this).val() <= 1400){
					$('select[name="heating_select"] option[value="14"]').prop('selected', true);
					$('#reg_fees').val("10800");
					$('#heating').val("14");
				}else if($(this).val() >= 1401 && $(this).val() <= 1600){
					$('select[name="heating_select"] option[value="15"]').prop('selected', true);
					$('#reg_fees').val("12600");
					$('#heating').val("15");
				}else if($(this).val() >= 1601 && $(this).val() <= 1800){
					$('select[name="heating_select"] option[value="16"]').prop('selected', true);
					$('#reg_fees').val("13500");
					$('#heating').val("16");
				}else if($(this).val() >= 1801 && $(this).val() <= 2000){
					$('select[name="heating_select"] option[value="17"]').prop('selected', true);
					$('#reg_fees').val("15000");
					$('#heating').val("17");
				}else if($(this).val() >= 2001 && $(this).val() <= 2200){
					$('select[name="heating_select"] option[value="18"]').prop('selected', true);
					$('#reg_fees').val("16200");
					$('#heating').val("18");
				}else if($(this).val() >= 2201 && $(this).val() <= 2400){
					$('select[name="heating_select"] option[value="19"]').prop('selected', true);
					$('#reg_fees').val("18000");
					$('#heating').val("19");
				}else if($(this).val() >= 2401 && $(this).val() <= 2600){
					$('select[name="heating_select"] option[value="20"]').prop('selected', true);
					$('#reg_fees').val("18900");
					$('#heating').val("20");
				}else if($(this).val() >= 2601 && $(this).val() <= 2800){
					$('select[name="heating_select"] option[value="21"]').prop('selected', true);
					$('#reg_fees').val("20400");
					$('#heating').val("21");
				}else if($(this).val() >= 2801 && $(this).val() <= 3000){
					$('select[name="heating_select"] option[value="22"]').prop('selected', true);
					$('#reg_fees').val("21600");
					$('#heating').val("22");			
				}else if($(this).val() >= '3001'){
					$('select[name="heating_select"] option[value="23"]').prop('selected', true);
					$('#heating').val("23");
				}else{
					$('#heating').val("1");
					$('select[name="heating_select"] option[value="1"]').prop('selected', true);
				}													
			});
			var oldValue=0, newValue=0;
			$('input[name="is_fabrication"]').on('change', function(){				
				if($(this).val() == 'Y'){
					if($('input[id="reg_fees"]').val() != ''){						
						oldValue2 = $('input[id="reg_fees"]').val()
						oldValue = $('input[id="reg_fees"]').val()
						newValue = oldValue*4;
						$('input[id="reg_fees"]').val(newValue);
					}	
				}else{
					$('input[id="reg_fees"]').val(oldValue2);
				}
				
			});
		});   
		$('input[name="boiler_owner"]').on('change', function(){
			if($(this).val() != 'undefined')
			$('input[name="signature"]').val($(this).val());			
		});
	$('#heat').on('click', function(){
		var i, d = new Date();
		d.getFullYear()
		for(i=d.getFullYear()-5; i<d.getFullYear()+5; i++){
		   $(this).append($('<option />').val(i).html(i));
		}
	});
	/* ----------------------------------------------------- */
	$('#courierd input').attr('disabled', 'disabled');
	<?php if($file1=='SC'){	?>		
		$('#courierd input').removeAttr('disabled', 'disabled');
	<?php }else{ ?>
		$('#courierd input').attr('disabled', 'disabled');
	<?php } ?>
	
</script>
</body>
</html>