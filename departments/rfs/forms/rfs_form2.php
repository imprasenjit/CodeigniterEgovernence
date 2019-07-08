<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="2";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
/*$check=$formFunctions->is_already_registered($dept,'1');
if($check!=1){
	echo "<script>
			alert('You did not yet filled up the Registration of Firms. Please first fill up the Registration of Firm and after that alter your details in this form. ');
			window.location.href = '../../../user_area/';
	</script>";
}*/
$get_file_name=basename(__FILE__);
include("save_form.php");
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$date_f_alt=$results["date_f_alt"];$firm_name_alt=$results["firm_name_alt"];$reg_uain=$results["reg_uain"];$is_different=$results["is_different"];
			
			if(!empty($results['alteration_address'])){
				$alteration_address=json_decode($results['alteration_address']);
				$alteration_address_locality=$alteration_address->locality;$alteration_address_vill=$alteration_address->vill;$alteration_address_po=$alteration_address->po;$alteration_address_ps=$alteration_address->ps;$alteration_address_dist=$alteration_address->dist;$alteration_address_pincode=$alteration_address->pincode;$alteration_address_mobile=$alteration_address->mobile;$alteration_address_email=$alteration_address->email;
			}else{
				$alteration_address_locality="";$alteration_address_vill="";$alteration_address_po="";$alteration_address_ps="";$alteration_address_dist="";$alteration_address_pincode="";$alteration_address_mobile="";$alteration_address_email="";
			}
			if(!empty($results['other_address'])){
				$other_address=json_decode($results['other_address']);
				$other_address_locality=$other_address->locality;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
			}else{
				$other_address_locality="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
			}
			if(!empty($results['registration_deed'])){
				$registration_deed=json_decode($results['registration_deed']);
				$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
			}else{
				$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
			}
			if(!empty($results['rectification_reg'])){
				$rectification_reg=json_decode($results['rectification_reg']);
				$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
			}else{
				$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
			}
			#### PART II####
			if(!empty($results["tax"])){
				$tax=json_decode($results["tax"]);
				$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
			}else{
				$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
			}
		}else{
			$form_id="";
			#####PART I #####
			$firm_name_alt=$unit_name;$alteration_address_locality=$b_street_name1;$alteration_address_vill=$b_vill;$alteration_address_dist=$b_dist;$alteration_address_pincode=$b_pincode;$alteration_address_mobile=$b_mobile_no;$alteration_address_email=$b_email;
			$q1=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
			if($q1->num_rows>0){
				$results1=$q1->fetch_assoc();
				$alteration_address_po=$results1["po_name"];$alteration_address_ps=$results1["ps_name"];
			}else{
				$alteration_address_po="";$alteration_address_ps="";
			}
			$other_address_locality="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";$reg_uain="";$is_different="";
			##### PART II ####
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$date_f_alt=$results["date_f_alt"];$firm_name_alt=$results["firm_name_alt"];$reg_uain=$results["reg_uain"];$is_different=$results["is_different"];
		
		if(!empty($results['alteration_address'])){
			$alteration_address=json_decode($results['alteration_address']);
			$alteration_address_locality=$alteration_address->locality;$alteration_address_vill=$alteration_address->vill;$alteration_address_po=$alteration_address->po;$alteration_address_ps=$alteration_address->ps;$alteration_address_dist=$alteration_address->dist;$alteration_address_pincode=$alteration_address->pincode;$alteration_address_mobile=$alteration_address->mobile;$alteration_address_email=$alteration_address->email;
		}else{
			$alteration_address_locality="";$alteration_address_vill="";$alteration_address_po="";$alteration_address_ps="";$alteration_address_dist="";$alteration_address_pincode="";$alteration_address_mobile="";$alteration_address_email="";
		}
		if(!empty($results['other_address'])){
			$other_address=json_decode($results['other_address']);
			$other_address_locality=$other_address->locality;$other_address_vill=$other_address->vill;$other_address_po=$other_address->po;$other_address_ps=$other_address->ps;$other_address_dist=$other_address->dist;$other_address_pincode=$other_address->pincode;
		}else{
			$other_address_locality="";$other_address_vill="";$other_address_po="";$other_address_ps="";$other_address_dist="";$other_address_pincode="";
		}
		if(!empty($results['registration_deed'])){
			$registration_deed=json_decode($results['registration_deed']);
			$registration_deed_no=$registration_deed->no;$registration_deed_dte=$registration_deed->dte;$registration_deed_place=$registration_deed->place;
		}else{
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
		}
		if(!empty($results['rectification_reg'])){
			$rectification_reg=json_decode($results['rectification_reg']);
			$rectification_reg_no=$rectification_reg->no;$rectification_reg_dte=$rectification_reg->dte;$rectification_reg_place=$rectification_reg->place;
		}else{
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
		}
		#### PART II####
		if(!empty($results["tax"])){
			$tax=json_decode($results["tax"]);
			$tax_certificate_no=$tax->certificate_no;$tax_certificate_issue=$tax->certificate_issue;$tax_issuedate=$tax->issuedate;
		}else{
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";
		}
	}
	##PHP TAB management
	$showtab=isset($_GET['tab'])?$_GET['tab']:"";
	$tabbtn1="";$tabbtn2=""; 
	if($showtab=="" || $showtab<2 || $showtab>6 || is_numeric($showtab)==false){
		$tabbtn1="active";$tabbtn2=""; 
	}
	if($showtab==2){
		$tabbtn1="";$tabbtn2="active"; 
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
	<link href="../css/croppie.css" rel="stylesheet" type="text/css" />
	<style>
		/* Over writes AdminLTE form styles */
		p {
			text-align: justify;
		}
		.form-control:focus {
			box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)
		}
		.form-control {
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
	<?php include ("".$table_name."_addmore.php"); ?>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
<div class="overlay-div"></div>
<div id="loader" class="loader" style="display:none;"></div>
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
							<h4 class="text-center">
							   <strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>
						</div>
						<div class="panel-body">
							<ul class="nav nav-pills">
								<li class="<?php echo $tabbtn1; ?>"><a data-toggle="tab" href="#table1">PART I</a></li>
								<li class="<?php echo $tabbtn2; ?>"><a data-toggle="tab" href="#table2">PART II</a></li>
							</ul>
                         <div class="tab-content">
								<div id="table1" class="tab-pane <?php echo $tabbtn1; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
										<table class="table table-responsive">
											<tr>
												<td width="25%">Choose the UAIN of the Registered Firm :</td>
												<td width="25%">
													<select name="reg_uain" class="form-control text-uppercase">
														<option value="">Please Select</option>
														<?php
														if($reg_uain!=""){?>
															<option value="<?=strtoupper($reg_uain)?>" selected><?=strtoupper($reg_uain)?></option>		
														<?php				
														}
															$query_reg_form="SELECT uain FROM rfs_form1 WHERE user_id='$swr_id'";
															$exec_query_reg_form=$formFunctions->executeQuery("rfs",$query_reg_form);
															while($reg_res=$exec_query_reg_form->fetch_object()){
														?>
														<option value="<?=strtoupper($reg_res->uain)?>"><?=strtoupper($reg_res->uain)?></option>
														<?php } 
														?>
													</select>
												</td>
												<td width="25%"></td>
												<td width="25%"></td>
											</tr>
											<tr>
												<td width="25%">1. Date of Alteration</td>
												<td width="25%"><input type="date" class="form-control text-uppercase" readonly name="date_f_alt"  value="<?php echo date("Y-m-d");?>"></td>
												<td width="25%">2. Alteration in the name of the firm </td>
												<td width="25%"><input type="text" class="form-control text-uppercase" name="firm_name_alt"  value="<?php echo $firm_name_alt;?>"  ></td>
												
											</tr>
											<tr>
												<td colspan="4">3. Alteration in the Principal Place of Business </td>
											</tr>
											<tr>
												<td>Locality  </td>
												<td><input type="text" class="form-control text-uppercase"  name="alteration_address[locality]" value="<?php  echo $alteration_address_locality; ?>"/></td>
												<td> Village/town/city </td>
												<td><input type="text" class="form-control text-uppercase" name="alteration_address[vill]" value="<?php  echo $alteration_address_vill; ?>"/></td>
											</tr>
											<tr>
												<td> Post Office </td>
												<td><input type="text"  class="form-control text-uppercase" id="post_office" name="alteration_address[po]" value="<?php  echo $alteration_address_po; ?>"/></td>
												<td> Police Station </td>
												<td><input type="text" class="form-control text-uppercase" id="police_station" name="alteration_address[ps]" value="<?php  echo $alteration_address_ps; ?>"/></td>
											</tr>
											<tr>
												<td>District<span class="mandatory_field">*</span></td>
                                                 <td><input type="text" name="alteration_address[dist]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $alteration_address_dist; ?>"></td>
												
												<td>Pin code </td>
												 <td><input type="text" class="form-control text-uppercase" name="alteration_address[pincode]" value="<?php  echo $alteration_address_pincode; ?>" ></td>
											</tr>
											<tr>
												<td>Mobile No.</td>
												<td><input type="text" class="form-control text-uppercase" id="area" name="alteration_address[mobile]" validate="mobileNumber" maxlength="10" value="<?php  echo $alteration_address_mobile; ?>"/></td>
												<td>Email ID</td>
												<td><input type="email" class="form-control" id="area" name="alteration_address[email]" value="<?php  echo $alteration_address_email; ?>"/></td>
											</tr>
											<tr>
												<td colspan="4">4. Alteration in the Address of any other place where the Firms carries its business</td>
											</tr>
											<tr>
												<td>Locality  </td>
												<td><input type="text" class="form-control text-uppercase" name="other_address[locality]" value="<?php  echo $other_address_locality; ?>"/></td>
												<td> Village/town/city :</td>
												<td><input type="text" class="form-control text-uppercase" name="other_address[vill]" value="<?php  echo $other_address_vill; ?>"/></td>
											</tr>
											<tr>
												<td> Post Office :</td>
												<td><input type="text"  class="form-control text-uppercase"  name="other_address[po]" value="<?php  echo $other_address_po; ?>"/></td>
												<td> Police Station :</td>
												<td><input type="text" class="form-control text-uppercase" name="other_address[ps]" value="<?php  echo $other_address_ps; ?>"/></td>
											</tr>
											<tr>
												<td>District<span class="mandatory_field">*</span></td>
                                                <td><input type="text" name="other_address[dist]" class="form-control text-uppercase is_different_yes_class" value="<?php  echo $other_address_dist; ?>"></td>
												
												<td>Pin code :</td>
												 <td><input type="text" class="form-control text-uppercase" name="other_address[pincode]" validate="pincode" maxlength="6" value="<?php  echo $other_address_pincode; ?>" ></td>
											</tr>
											<tr>
												<td colspan="4">5. Original Registration Deed of Partnership</td>
											</tr>
											<tr>
												 <td>Deed No.<span class="mandatory_field">*</span></td>
												 <td><input type="text"  class="form-control text-uppercase" name="registration_deed[no]"  value="<?php echo $registration_deed_no; ?>" required /></td>
												 <td>Date<span class="mandatory_field">*</span></td>
												 <td><input type="text"  name="registration_deed[dte]" class="dob form-control text-uppercase" value="<?php echo $registration_deed_dte; ?>" required /></td>
											</tr>
											<tr>
												 <td>Place of Deed Registration<span class="mandatory_field">*</span></td>
												 <td><input type="text"  class="form-control text-uppercase"  name="registration_deed[place]" value="<?php echo $registration_deed_place; ?>" required /></td>
												 <td></td>
												 <td></td>
											</tr>
											<tr>
												<td colspan="4">6. Rectification Registration Deed of Partnership</td>
											</tr>
											<tr>
												 <td>Deed No.<span class="mandatory_field">*</span></td>
												 <td><input type="text"  class="form-control text-uppercase" name="rectification_reg[no]"  value="<?php echo $rectification_reg_no; ?>" required /></td>
												 <td>Date<span class="mandatory_field">*</span></td>
												 <td><input type="text"  name="rectification_reg[dte]" class="dob form-control text-uppercase"  value="<?php echo $rectification_reg_dte; ?>" required /></td>
											</tr>
											<tr>
												 <td>Place of Deed Registration<span class="mandatory_field">*</span></td>
												 <td><input type="text"  name="rectification_reg[place]" class="form-control text-uppercase"  value="<?php echo $rectification_reg_place; ?>" required /></td>
												 <td></td>
												 <td></td>
											</tr>
											<tr>
												<td align="center" colspan="4">
													<button type="submit"  style="font-weight:bold" name="save<?php echo $form;?>a" class="btn btn-success submit1">Save and Next</button>
												</td>
											</tr>
										</table>
									</form>
								</div>
								<div id="table2" class="tab-pane <?php echo $tabbtn2; ?>" role="tabpanel">
									<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
										<table class="table table-responsive table-bordered">
											<tr>
												<td colspan="4">7. Photos of the Partners<span class="mandatory_field">*</span></td>
											</tr>
											<tr>
													<td colspan="4">
													<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
													<thead>
														<tr>
															<th width="5%">Sl. No.</th>
															<th width="35%">Full Name of partners</th>
															<th width="60%">Upload photo</th>
														</tr>
													</thead>
													<?php
														$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
														$num1 = $part1->num_rows;
														if($num1==0){ 
														for($i=1; $i<8; $i++){ ?>
															
														<tr>
															<td><input type="text" readonly id="txxtA<?=$i;?>" class="form-control text-uppercase" value="<?=$i;?>" name="txxtA<?=$i;?>" size="1"></td>
															<td><input type="text" id="txxtB<?=$i;?>" class="form-control text-uppercase" value="" name="txxtB<?=$i;?>" ></td>
															<td>
																<span></span>
																<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?=$i;?>" >Upload</a>
															</td>			 
														</tr>
														<?php }		?>
																
																
																
															<?php
															    }else{	
																 $count=1;
																 while($rows=$part1->fetch_object()){
																	if($rows->upload_photo == ""){
																		$upload_photo="";
																		$photo_base64="";
																	}else{
																		$upload_photo=$rows->upload_photo;
																		$photo_path = $server_url. 'departments/rfs/forms/upload/'.$rows->upload_photo;
																		$photo_data = file_get_contents($photo_path);
																		$photo_base64 = 'data:image/png;base64,' . base64_encode($photo_data);
																	}
															
														    ?>
															<tr>
																<td><input type="text" readonly value="<?=$count;?>" id="txxtA1" size="1" class="form-control text-uppercase" name="txxtA<?=$count;?>"></td>
																<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>"></td>
															   <td>
																<?php if($count<8){ ?>
																	<span><input type="hidden" name="member-photo<?php echo $count;?>" value="<?php echo $photo_base64; ?>"><img width="160" height="200" src="upload/<?php echo $upload_photo; ?>"/><br><br></span>
																	<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?php echo $count;?>" >Upload</a>
																<?php } ?>
																	
																</td>
																
															</tr>
														<?php  $count++;
														}
														 
														 ?>
														
														
													<?php } ?>
													
												</table>
												<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											   <button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											   <input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/></div> 
                                         </td>
                                       </tr>
											<tr>
												<td colspan="4">8. Certificate of Sales Tax or Income Tax</td>
											</tr>
											<tr>
												<td width="25%">Certificate No. :</td>
												<td width="25%"><input type='text'  class="form-control text-uppercase" name="tax[certificate_no]" value="<?php echo $tax_certificate_no; ?>" ></td>
												<td width="25%">Issued by</td>
												<td width="25%"><input type='text'  name="tax[certificate_issue]" class="form-control text-uppercase"  value="<?php echo $tax_certificate_issue; ?>" ></td>
											</tr>
											<tr>
												<td>Date of Issue</td>
												<td><input type='text'  class="dob form-control text-uppercase"  name="tax[issuedate]" value="<?php echo $tax_issuedate; ?>"  ></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td colspan="2">Date : <strong><?php echo $today;?></strong><br/>
													Place : <strong><?php echo strtoupper($dist);?></strong></td>
												<td align="right" colspan="2">
													<b><?php echo strtoupper($key_person)?></b><br/>
														Signature of the Applicant               
												</td>
											</tr>
											<tr>
												<td colspan="4" align="center">
													<a type="button" href="<?php echo $table_name;?>.php?tab=1" class="btn btn-primary">Go Back & Edit</a>
													<button type="submit"  style="font-weight:bold" name="save<?php echo $form;?>b" class="btn btn-success submit1">Save and Next</button>
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
	<div class="modal fade" tabindex="-1" role="dialog" id="myModal-photo">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Upload Photo</h4>
				</div>
				<div class="modal-body" style="height:500px;">
				  <div class="col-md-12" >
									<div class="upload-demo-wrap">
										<div id="upload-demo"></div>
									</div>
								</div>
				</div>
				<div class="modal-footer">
				   <a class="btn file-btn btn-danger">
											<span>Browse Photo</span>
											<input type="file" id="upload" value="Choose a file" accept="image/*">
				   </a>       
				  <a href="#!" class="btn btn-primary result">Submit</a>       
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<?php require_once "../../../views/users/requires/footer.php";  ?>
    <?php require '../../requires/js.php' ?>
    </div>
	<!-- ./wrapper -->

<script src="../js/croppie.min.js" type="text/javascript"></script>
<script>
	$('#is_different_yes').css('display', 'table');
	$('.is_different_yes_class').attr('required', 'required');
	<?php if($is_different == 'N' || $is_different == ''){ ?>
	$('#is_different_yes').css('display', 'none');
	$('.is_different_yes_class').removeAttr('required', 'required');
	<?php } ?>

	$('input[name="is_different"]').on('change', function() {
		if ($(this).val() == 'Y') {
			$('#is_different_yes').css('display', 'table');
			$('.is_different_yes_class').attr('required', 'required');
		} else {
			$('#is_different_yes').css('display', 'none');
			$('.is_different_yes_class').removeAttr('required', 'required');
		}
	});
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>
<script>
   // window.onload = function(e){ 
		var img,width,height;
		$('.myphoto').click(function(){
			//alert("asd");
			width=$(this).attr("data-width");
			height=$(this).attr("data-height");
			$('#upload-demo').empty();
			$('#myModal-photo').modal('show');
			img=$(this);
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: width,
					height: height							
				},
				boundary: {
					width: 350,
					height:350
				}			
			});
		});
		$('.mysign').click(function(){
			width=$(this).attr("data-width");
			height=$(this).attr("data-height");
			$('#upload-demo').empty();
			$('#myModal-photo').modal('show');
			img=$(this);
			$uploadCrop = $('#upload-demo').croppie({
				viewport: {
					width: width,
					height: height								
				},
				boundary: {
					width: 400,
					height:400
				}			
			});
		});
		$('#myModal-photo').on('shown.bs.modal', function () {
		  
		});
        var $uploadCrop;
		function readFile(input) {
 			if (input.files && input.files[0]) {
	            var reader = new FileReader();
	            
	            reader.onload = function (e) {
					$('.upload-demo').addClass('ready');
	            	$uploadCrop.croppie('bind', {
	            		url: e.target.result
	            	}).then(function(){
	            		console.log('jQuery bind complete');
	            	});	            	
	            }	            
	            reader.readAsDataURL(input.files[0]);
	        }
	        else {
		        swal("Sorry - you're browser doesn't support the FileReader API");
		    }
		}
		
		$('#upload').on('change', function () { readFile(this); });
		$('.result').on('click', function (ev) {
			$uploadCrop.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (resp) {
				$('#myModal-photo').modal('hide');
				$('.cr-image').attr('src','');
				$("#upload").val('');
				img.parent().children('span').empty();
			    img.parent().children('span').append('<input type="hidden" name="'+img.attr('data-name')+'" value="'+resp+'"> <img src="'+resp+'"><br><br>');			
			});
		});	
	//}          
</script>
</body>
</html>