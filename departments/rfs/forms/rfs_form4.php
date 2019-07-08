<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="4";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form.php");
	
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
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
			$registration_deed_no="";$registration_deed_dte="";$registration_deed_place="";
			$rectification_reg_no="";$rectification_reg_dte="";$rectification_reg_place="";
			##### PART II ####
			$tax_certificate_no="";$tax_certificate_issue="";$tax_issuedate="";	
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
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
	$q1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
	if($q1->num_rows<1){
		$form_id="";
		$member_f_address="";$member_p_name="";$member_p_address="";$remarks="";$upload_photo="";
	}else{
		$results1=$q1->fetch_assoc();
		$form_id=$results1['form_id'];
		$member_f_address=$results1['member_f_address'];$member_p_name=$results1['member_p_name'];$member_p_address=$results1['member_p_address'];$remarks=$results1['remarks'];$upload_photo=$results1['upload_photo'];
	}
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
							<h4 class="text-center" >
								<strong><?php echo $form_name=$formFunctions->get_formName($dept,$form);?></strong>
							</h4>	
						</div>
						<div class="panel-body">
							<div id="table1" class="tab-pane" role="tabpanel">
								<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<table class="table table-responsive">
										<tr>
											<td colspan="4">1. Changes in the name and address of the Partners of the Firm <span class="mandatory_field">*</span></td>
										</tr>
										<tr>
											<td colspan="4">
											<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
											<thead>
											<tr>
												<th rowspan="2">Sl No.</th>
												<th colspan="2">Former</th>
												<th colspan="2">Present</th>
												<th rowspan="2">Remark</th>
												<th rowspan="2">Upload Photo</th>
											</tr>
											<tr>
												<th>Name of the Partners</th>
												<th>Address of the Partners</th>
												<th>Name of the Partners</th>
												<th>Address of the Partners</th>
											</tr>
											</thead>
											<tbody>
											<?php
												$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
												$num1 = $part1->num_rows;
												if($num1==0){ 
												for($i=1; $i<8; $i++){ ?>
												<tr>
													<td><input type="text" readonly id="txxtA<?=$i;?>" class="form-control text-uppercase" value="<?=$i;?>" name="txxtA<?=$i;?>" size="1"></td>
													<td><input type="text" id="txxtB<?=$i;?>" class="form-control text-uppercase" value="" name="txxtB<?=$i;?>" ></td>
													<td><input type="text" value=""  id="txxtC<?=$i;?>" class="form-control text-uppercase" name="txxtC<?=$i;?>"></td>
													<td><input type="text" value="" id="txxtD<?=$i;?>" class="form-control text-uppercase" name="txxtD<?=$i;?>"  ></td>
													<td><input type="text" value="" id="txxtE<?=$i;?>" class="form-control text-uppercase" name="txxtE<?=$i;?>"  ></td>
													<td><input type="text" value="" id="txxtF<?=$i;?>" class="form-control text-uppercase" name="txxtF<?=$i;?>"  ></td>
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
																<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_f_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>"></td>
																<td><input type="text" id="txxtC<?=$count;?>" value="<?php echo strtoupper($rows->member_f_address);?>" class="form-control text-uppercase" name="txxtC<?=$count;?>"></td>
																<td><input type="text" id="txxtD<?=$count;?>" value="<?php echo strtoupper($rows->member_p_name);?>" class="form-control text-uppercase" name="txxtD<?=$count;?>"></td>
																<td><input type="text" id="txxtE<?=$count;?>" value="<?php echo strtoupper($rows->member_p_address);?>" class="form-control text-uppercase" name="txxtE<?=$count;?>"></td>
																<td><input type="text" id="txxtF<?=$count;?>" value="<?php echo strtoupper($rows->remarks);?>" class="form-control text-uppercase" name="txxtF<?=$count;?>"></td>
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
											<td colspan="4">2. Registration Deed of Partnership</td>
										</tr>
										<tr>
											<td>Deed No.<span class="mandatory_field">*</span></td>
											<td><input type="text"  class="form-control text-uppercase" name="registration_deed[no]"  value="<?php echo $registration_deed_no; ?>" required /></td>
											<td>Date<span class="mandatory_field">*</span></td>
											<td><input type="text"  name="registration_deed[dte]" class="dob form-control text-uppercase" value="<?php echo $registration_deed_dte; ?>" required /></td>
										</tr>
										<tr>
											<td>Place of Deed Registration<span class="mandatory_field">*</span></td>
											<td><input type="text"  name="registration_deed[place]"  class="form-control text-uppercase"  value="<?php echo $registration_deed_place; ?>" required /></td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="4">3. Rectification Registration Deed of Partnership</td>
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
											<td colspan="4">4. Certificate of Sales Tax or Income Tax</td>
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
											<td colspan="4" class="text-center">
											<button type="submit" class="btn btn-success submit1" name="save<?php echo $form;?>" title="Save it and fill up the form later and Go to the Next Part" onclick="return confirm('Do you want to save..?')"> Save & Next</button></td>
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