<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="16";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form_new.php");
	
	

	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$firm_duration=$results["firm_duration"];$regn_no=$results["regn_no"];$business_details=$results["business_details"];$is_different=$results["is_different"];$nature_busi=$results["nature_busi"];
			
		}else{
			$form_id="";
			$firm_duration="";$regn_no="";$business_details="";$is_different="";$nature_busi="";
			
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$firm_duration=$results["firm_duration"];$regn_no=$results["regn_no"];$business_details=$results["business_details"];$is_different=$results["is_different"];$nature_busi=$results["nature_busi"];
		
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
							
								<br>
								<div class="tab-content">
									<div>
										<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
										
											<table class="table table-responsive">
												<tr>
													<td width="25%">1.Regn. No :</td>
													<td width="25%"><input type="text" name="regn_no" class="form-control text-uppercase" value="<?php echo $regn_no;?>" /></td>
													<td width="25%">2.Nature of business :</td>
													<td width="25%"><input type="text" name="nature_busi" class="form-control text-uppercase" value="<?php echo $nature_busi;?>" /></td>
												</tr>
												<tr>
													<td>3.Name of the firm :</td>
													<td><input type="text" name="firm_name" class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled" /></td>
													<td>4.Date of Establishment :</td>
													<td><input type="text" name="farm_es_date" class="form-control text-uppercase dob" disabled="disabled" value="<?php if(isset($date_of_commencement)) echo date("d-m-Y",strtotime($date_of_commencement)); ?>" required></td>
												</tr>
												<tr>
													<td>5. Duration of the Firm :</td>
													<td width="25%">
														<select type="text" name="firm_duration" class="form-control text-uppercase" value="<?php echo $firm_duration;?>">
															<option value="">Please Select</option>
															<option value="U" <?php if($firm_duration=="U") { echo "selected"; }?> >Unlimited</option>
															<option value="L" <?php if($firm_duration=="L") { echo "selected"; }?>>Limited</option>
														</select>
														<!--
													<input type="text" name="firm_duration" class="form-control text-uppercase" value="<?php // echo $firm_duration;?>" />-->
													</td>
													<td>6. PAN card :</td>
													<td><input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" maxlength="10" value="<?php  echo $pan_no; ?>" disabled="disabled"></td>
												</tr>
												<tr>
													<td>7. Principle place of business of the firm	</td>
													<td><textarea type="text"  name="business_details" class="form-control text-uppercase" /><?php echo $business_details; ?></textarea></td>
												</tr>
												<tr>
													<td colspan="3">8. Does the proposed firm carry out its business in any other place apart from the registered office?</td>
													<td><label class="radio-inline"><input type="radio" name="is_different" value="Y"  <?php if(isset($is_different) && $is_different=='Y') echo 'checked'; ?> /> Yes</label>
													<label class="radio-inline"><input type="radio" name="is_different"  value="N"  <?php if(isset($is_different) && $is_different=='N') echo 'checked'; ?>/> No</label>
													</td>
												</tr>
											    <tr>
													<td colspan="4">9. Changes in the constitution of the firm	 :</td>
												</tr>
												<tr>
													<td colspan="4">
													<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
													       <thead>
														       <tr>
																	<th></th>
																	<th colspan="2"><h4><b>Previous Constitution of the firm</h4></b></th>
																	<th colspan="5"><h4><b>Present Constitution of the firm</h4></b></th>
																</tr>
																<tr>
																	<th>Sl No.</th>
																	<th>Name of the partners</th>
																	<th>Address of the partners</th>
																	<th>Name of the partners</th>
																	<th>Address of the partners</th>
																	<th>Upload Photo</th>
																	<th>Upload Signature</th>
																	<th>Upload PAN</th>
																</tr>
															</thead>
															<?php
																$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
																$num1 = $part1->num_rows;
																if($num1==0){ 
																for($i=1; $i<8; $i++){ ?>
																	<tr>
																		<td><input type="text" readonly id="txxtA<?=$i;?>" class="form-control text-uppercase" value="<?=$i;?>" name="txxtA<?=$i;?>" size="1"></td>
																		<td><input type="text" id="txxtB<?=$i;?>" class="form-control text-uppercase" value="" name="txxtB<?=$i;?>" ></td>
																		<td><input type="text" value=""  id="txxtC<?=$i;?>" class="form-control text-uppercase" name="txxtC<?=$i;?>"></td>
																		<td><input type="text" value="" id="txxtD<?=$i;?>" class="form-control text-uppercase" name="txxtD<?=$i;?>"  ></td>
																		<td><input type="text" value="" id="txxtE<?=$i;?>" class="form-control text-uppercase" name="txxtE<?=$i;?>"  ></td>
																		
																		<td>
																			<span></span>
																			<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?=$i;?>" >Upload</a>
																		</td>
																		<td>
																			<span></span>
																			<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?=$i;?>">Upload</a>
																		</td>
																		<td>
																			<input type="button" upload="file" class="file btn btn-info" id="fl<?=$i;?>" required="required" value="Browse">
																			<input type="hidden" name="upload_pan<?=$i;?>" value="" id="mfl<?=$i;?>" readonly="readonly" />
																			<span id="tdfl<?=$i;?>">No File Selected</span>
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
																	if($rows->upload_signature == ""){
																		$upload_signature="";
																		$sign_base64="";
																	}else{
																		$upload_signature=$rows->upload_signature;
																		$sign_path = $server_url. 'departments/rfs/forms/upload/'.$upload_signature;
																		$sign_data = file_get_contents($sign_path);
																		$sign_base64 = 'data:image/png;base64,' . base64_encode($sign_data);
																	}
																 
																 ?>
																	 <tr>
																		<td><input type="text" readonly value="<?=$count;?>" id="txxtA" size="1" class="form-control text-uppercase" name="txxtA<?=$count;?>"></td>
																		<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>"></td>
																		<td><input type="text" id="txxtC<?=$count;?>" value="<?php echo strtoupper($rows->member_address);?>" class="form-control text-uppercase" name="txxtC<?=$count;?>"></td>					
																		<td><input type="text" value="<?php echo strtoupper($rows->member_name1);?>" id="txxtD<?=$count;?>" class="form-control text-uppercase" name="txxtD<?=$count;?>" ></td>
																		<td><input type="text" value="<?php echo strtoupper($rows->member_address1);?>" id="txxtE<?=$count;?>" class="form-control text-uppercase" name="txxtE<?=$count;?>" ></td>
																		<td>
																		<?php if($count<8){ ?>
																			<span><input type="hidden" name="member-photo<?php echo $count;?>" value="<?php echo $photo_base64; ?>"><img width="160" height="200" src="upload/<?php echo $upload_photo; ?>"/><br><br></span>
																			<a href="#!" class="btn btn-info myphoto" data-width="160" data-height="200" data-name="member-photo<?php echo $count;?>" >Upload</a>
																		<?php } ?>
																			
																		</td>
																		<td>
																			<?php if($count<8){ ?>
																				<span><input type="hidden" name="member-sign<?php echo $count;?>" value="<?php echo $sign_base64; ?>"><img width="360" height="120" src="upload/<?php echo $upload_signature; ?>"/><br><br></span>
																				<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?php echo $count;?>">Upload</a>
																			<?php } ?>
																			
																		</td>
																		<td>
																			<?php if($count<8){ ?>
																				<input type="button" upload="file" class="file btn btn-info" id="fl<?php echo $count;?>" value="Browse">
																			<input type="hidden" name="upload_pan<?php echo $count;?>" value="<?php echo $rows->upload_pan; ?>" id="mfl<?php echo $count;?>" readonly="readonly" />
																			<span id="tdfl<?php echo $count;?>"><?php if($rows->upload_pan =="") echo "No File Selected"; else echo '<a href="'. $upload.$rows->upload_pan .'" class="btn btn-success" target="_blank"> View </a>'; ?> </span>
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
													<td class="text-center" colspan="4">
														<button type="submit" name="save<?php echo $form;?>" class="btn btn-success submit1">Save and Next</button>
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
	$('#is_different_yes').css('display', 'none');
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