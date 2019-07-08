<?php  require_once "../../requires/login_session.php";
$check=$formFunctions->is_already_registered('sdc','16');
if($check==1){
	echo "<script>
				alert('Successfully Submitted');
				window.location.href = '".$server_url."departments/requires/acknowledgement.php?form=16&dept=sdc';
		</script>";	
}else if($check==2){
	echo "<script>				
				window.location.href = '".$server_url."departments/requires/courier_details.php?form=16&dept=sdc';		</script>";
}else if($check==3){
	echo "<script>window.location.href = 'payment_section.php?token=16';</script>";
}else{
	$showtab="";
}

$get_file_name=basename(__FILE__);	
include "save_form.php";
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner); 
		$q=$sdc->query("select * from sdc_form16 where user_id='$swr_id' and active='1'");
		$results=$q->fetch_array();
		if($q->num_rows<1){	
			$form_id="";$cosmetics_names="";
			
			$file1="";$file2="";$file3="";$file4="";
			
		}else{			
			$form_id=$results["form_id"];$cosmetics_names=$results["cosmetics_names"];
	}
	
	$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];
	
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
	<?php include ("sdc_form16_Addmore.php"); ?> <!-- File handles 'Addmore' Operation -->
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
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
									<?php echo $form_name=$cms->query("select form_name from sdc_form_names where form_no='16'")->fetch_object()->form_name; ?>
								</h4>	
							</div>
							<div class="panel-body">
								
								<br>
								<div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
								<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table id="" class="table table-bordered table-responsive">
											<tr class="form-inline">
											<td colspan="4">1. I/We &nbsp;<input type="text"  class="form-control text-uppercase" value="<?php echo $key_person;?>" disabled>&nbsp; of &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $unit_name;?>">&nbsp;hereby apply for the grant renewal of a licence to manufacture on the premises situated at &nbsp;<input type="text"  class="form-control text-uppercase" disabled value="<?php echo $dist;?>">&nbsp;the following cosmetics :-</td>
										</tr>
										<tr>
											<td width="25%">2.  Names of cosmetics :</td>
											<td width="25%"><textarea class="form-control text-uppercase" name="cosmetics_names"><?php echo $cosmetics_names;?></textarea></td>
											<td width="25%">&nbsp;</td>
											<td width="25%">&nbsp;</td>
										</tr>
										<tr>
											<td colspan="4">3. Names, qualifications and experience of technical staff employed for manufacture and testing :
											<table name="objectTable1" id="objectTable1" class="table table-responsive text-center" >
												<tr>
													<th width="10%">Slno</th>
													<th width="25%">Name</th>
													<th width="20%">Qualifications</th>
													<th width="20%">Experience</th>
													<th width="20%">Responsible</th>
												</tr>
												<?php
													$part1=$sdc->query("SELECT * FROM sdc_form16_t1 WHERE form_id='$form_id'");
													$num1 = $part1->num_rows;
													if($num1>0){
													  $count=1;
													  while($row_1=$part1->fetch_array()){	?>
														<tr>
															<td><input readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["slno"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
															<td><input id="txtB<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["name"]; ?>" validate="letters" name="txtB<?php echo $count;?>" size="10"></td>
															<td><input value="<?php echo $row_1["qualification"]; ?>" id="txtC<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtC<?php echo $count;?>"></td>
															<td><input value="<?php echo $row_1["experience"]; ?>" id="txtD<?php echo $count;?>"  class="form-control text-uppercase" size="10" name="txtD<?php echo $count;?>"></td>
															<td><select required="required" id="txtE<?php echo $count;?>" name="txtE<?php echo $count;?>" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option <?php if($row_1["responsible"]=="T") echo "selected"; ?> value='T' >Testing</option>
															<option <?php if($row_1["responsible"]=="M") echo "selected"; ?> value='M' >Manufacture</option>
															</select>									
															</td>
														</tr>	
													<?php $count++; } 
													}else{	?>
													<tr>
														<td><input value="1" id="txtA1" readonly="readonly" size="10" class="form-control text-uppercase" name="txtA1"></td>
														<td><input id="txtB1" size="10" validate="letters" class="form-control text-uppercase" name="txtB1"></td>
														<td><input id="txtC1" size="10"   class="form-control text-uppercase" name="txtC1"></td>	
														<td><input id="txtD1" size="10"   class="form-control text-uppercase" name="txtD1"></td>
														<td><select required="required" d="txtE1" name="txtE1" class="form-control text-uppercase">
															<option value='' >Select Type</option>
															<option value='T' >Testing</option>
															<option value='M' >Manufacture</option>
														</select></td>
													</tr>
													<?php }?>												
												</table>
											<div>													
												<button type="button" class="btn btn-default pull-right" href="#"  onclick="mydelfunction1()" value="">Delete</button>
												<button type="button" class="btn btn-default pull-right" href="#" onClick="addMore1()" value="">Add More</button>
												<input type="hidden" id="hiddenval" name="hiddenval" value="<?php echo $hiddenval; ?>"/></div>
											</td>
										</tr>
										<tr>
										
										
										<tr>
										<td colspan="4" class="text-bold">List of Documents to be enclosed <br/>(All documents mentioned here are mendatory. Please upload all proper documents before proceeding further).</td>
										</tr>
										<tr>
											<td colspan="2">1. Approved layout of the premises and other related documents as per Schedule M-II.</td>
											<td>
												<select trigger="FileModal" id="file1" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($file1); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
												<input type="hidden" name="mfile1" id="mfile1" value="<?php echo $file1 !== '' ? $file1 : ''; ?>" />
											</td>
											<td id="tdfile1">
												<?php if($file1!="" && $file1!="SC" && $file1!="NA"){ echo '<a href="'.$upload.$file1.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
										</tr>
										<tr>
											<td colspan="2">2. Approved competent technical staff for testing.</td>
											<td>
												<select trigger="FileModal" id="file2" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($file2); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
												<input type="hidden" name="mfile2" id="mfile2" value="<?php echo $file2 !== '' ? $file2 : ''; ?>" />
											</td>
											<td id="tdfile2">
												<?php if($file2!="" && $file2!="SC" && $file2!="NA"){ echo '<a href="'.$upload.$file2.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
										</tr>
										<tr>
											<td colspan="2">3. Specimens of labels, cartons of the products proposed to be manufacture.</td>
											<td>
											<select trigger="FileModal" id="file3" class="form-control">                                            
												<option value="0" selected="selected"><?php echo uploadinfo($file3); ?></option>
												<option value="1">From E-Locker</option>
												<option value="2">From PC</option>
												<option value="4">Send by Courier</option>
												<option value="3">Not Applicable</option>
											</select>
											<input type="hidden" name="mfile3" id="mfile3" value="<?php echo $file3 !== '' ? $file3 : ''; ?>" />
										</td>
										<td id="tdfile3">
											<?php if($file3!="" && $file3!="SC" && $file3!="NA"){ echo '<a href="'.$upload.$file3.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
										</td>
										</tr>
										<tr>
											<td colspan="2">4. List of products to be manufactured.</td>
											<td>
												<select trigger="FileModal" id="file4" class="form-control">                                            
													<option value="0" selected="selected"><?php echo uploadinfo($file4); ?></option>
													<option value="1">From E-Locker</option>
													<option value="2">From PC</option>
													<option value="4">Send by Courier</option>
													<option value="3">Not Applicable</option>
												</select>
												<input type="hidden" name="mfile4" id="mfile4" value="<?php echo $file4 !== '' ? $file4 : ''; ?>" />
											</td>
											<td width="20%" id="tdfile4">
												<?php if($file4!="" && $file4!="SC" && $file4!="NA"){ echo '<a href="'.$upload.$file4.'" target="_blank"><i class="fa fa-file-text" aria-hidden="true"></i> View</a>'; } else { echo "No File Selected"; } ?>
											</td>
										</tr>
										
										
											<td colspan="2">Date :&nbsp;<label ><?php echo $today;?></label></td>
											<td colspan="2" align="right">Signature :&nbsp;<label><?php echo strtoupper($key_person)?></label></td>
										</tr>	  
										<tr>
											<td class="text-center" colspan="4">
												<button type="submit" style="font-weight:bold" name="save16" class="btn btn-success">Save and Next</button>
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
	  <?php require '../../../user_area/includes/footer.php'; 	?>
	</div>
	<!-- ./wrapper -->
<?php require '../../../user_area/includes/js.php'; ?>

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
	
	/* ------------------------------------------------------ */
	
	$('#dist').change(function(){
        var city=$(this).val();
		$('#block').empty();
        $.ajax({ 
            type: 'GET',
            url: '../../../ajax/district_blocks.php', 
            data: { city: city },
            beforeSend:function(){
                $("#block").html("Loading..");
            },
            success:function(data){
                $("#block").html(data);
            },
            error:function(){ }
        }); //ajax end
    });
	$('#offlinePayDetials').hide();
	$(document).ready(function(){
		$('input[name="payment_mode"]').on('change', function(){
			if($(this).val() == 0){						
				$('#offlinePayDetials').show("fast");						
			}else{
				$('#offlinePayDetials').hide("slow");
			}	
			
		});
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
/*$('#is_registration_b').attr('readonly','readonly');
	<?php if($is_registration_a == 'Y') echo "$('#is_registration_b').removeAttr('readonly','readonly');"; ?>
	$('.is_registration_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_registration_b').removeAttr('readonly','readonly');
		}else{
			$('#is_registration_b').attr('readonly','readonly');
		}			
	});*/
$('#is_nonResidential_b').attr('readonly','readonly');
	<?php if($is_nonResidential_a == 'Y') echo "$('#is_nonResidential_b').removeAttr('readonly','readonly');"; ?>
	$('.is_nonResidential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#is_nonResidential_b').removeAttr('readonly','readonly');
		}else{
			$('#is_nonResidential_b').attr('readonly','readonly');
			$('#is_nonResidential_b').val('');
		}			
	});
	
$('#semi_residential_b').attr('readonly','readonly');
	<?php if($semi_residential_a == 'Y') echo "$('#semi_residential_b').removeAttr('readonly','readonly');"; ?>
	$('.semi_residential_a').on('change', function(){
		if($(this).val() == 'Y'){
			$('#semi_residential_b').removeAttr('readonly','readonly');
		}else{
			$('#semi_residential_b').attr('readonly','readonly');
			$('#semi_residential_b').val('');
		}			
	});
</script>
</body>
</html>