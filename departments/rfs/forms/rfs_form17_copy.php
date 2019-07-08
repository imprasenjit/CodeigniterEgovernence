<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="17";
$table_name=$formFunctions->getTableName($dept,$form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form_new.php");
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];$pan_no=$row1['pan_no'];$is_business_started=$row1['is_business_started'];$date_of_commencement=$row1['date_of_commencement'];
	$land_type=$row1['w_l'];$mouza=$row1['mouza'];$patta_no=$row1['pattano'];$dag_no=$row1['dagno'];
	$pan_doc=$row1['pan_doc'];
	$circle=$row1['revenue'];$area=$b_street_name3." ,".$b_street_name4;

	if($land_type=='O') $land_type="Owned Premises";
	else if($land_type=='L') $land_type="Leased Premises";
	else $land_type="Rented Premises";

	$from=$key_person." , ".$street_name1." ".$street_name2." , ".$dist."<br/>";
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$sector_classes_b=$row1['sector_classes_b'];
	$sector_classes_b=get_sector_classes_b_value($sector_classes_b);
	$l_o_business=$row1['Type_of_ownership'];
	$business_type=$row1["sector_classes_b"];
	$business_type=get_sector_classes_b_value($business_type);

	if($l_o_business=="PP"){
		$l_o_business_val="Partnership Firm";$l_o_business_name="Partners";
	}else if($l_o_business=="LLP"){
		$l_o_business_val="Limited Liability Partnership";$l_o_business_name="Partners";
	}else if($l_o_business=="PTLC"){
		$l_o_business_val="Private Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="PBLC"){
		$l_o_business_val="Public Limited Company";$l_o_business_name="Directors";
	}else if($l_o_business=="CS"){
		$l_o_business_val="Cooperative rfs";$l_o_business_name="Members";
	}else if($l_o_business=="AP"){
		$l_o_business_val="Association of Persons";$l_o_business_name="Members";
	}else if($l_o_business=="T"){
		$l_o_business_val="Trust";$l_o_business_name="Trusties";
	}else if($l_o_business=="C"){
		$l_o_business_val="Club";$l_o_business_name="Members";
	}else if($l_o_business=="H"){
		$l_o_business_val="Hindu Undivided Family";
	}else if($l_o_business=="PSU"){
		$l_o_business_val="Public Sector Undertaking";
	}else{
		$l_o_business_val="Proprietorship";$l_o_business_name="Proprietor";
	}
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);

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
													<td><input type="text"  class="form-control text-uppercase" value="<?php echo $unit_name;?>" disabled="disabled" /></td>
													<td>4.Date of Establishment :</td>
													<td><input type="text" name="farm_es_date" class="form-control text-uppercase dob" disabled="disabled" value="<?php if(isset($date_of_commencement)) echo date("d-m-Y",strtotime($date_of_commencement)); ?>" required></td>
												</tr>
												<tr>
													<td>5. Duration of the Firm :</td>
													<td width="25%"><input type="text" name="firm_duration" class="form-control text-uppercase" value="<?php echo $firm_duration;?>" /></td>
													<td>6. PAN card :</td>
													<td><input type="text" class="form-control text-uppercase" id="pan_no" name="pan_no" maxlength="10" value="<?php  echo $pan_no; ?>" disabled="disabled"></td>
												</tr>
												<tr>
													<td>7. Principle place of business of the firm	</td>
													<td><textarea type="text"  name="business_details"  class="form-control text-uppercase"  /><?php echo $business_details; ?></textarea></td>
												</tr>
												<tr>
													<td colspan="3">8. Does the proposed firm carry out its business in any other place apart from the registered office ?</td>
													<td><label class="radio-inline"><input type="radio" name="is_different" value="Y"  <?php if(isset($is_different) && $is_different=='Y') echo 'checked'; ?> /> Yes</label>
													<label class="radio-inline"><input type="radio" name="is_different"  value="N"  <?php if(isset($is_different) && $is_different=='N') echo 'checked'; ?>/> No</label>
													</td>
												</tr>
											    <tr>
													<td colspan="4">9.Name in full and permanent address of all the partners of the firm alongwith the date of joining, their passport size photograph and scanned copy of PAN Card and signature of each partner:</td>
												</tr>
												<tr>
													<td colspan="4">
													<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
													       <thead>
														       
																<tr>
																	<th>Sl No.</th>
																	<th>Full Name of partners</th>
																	<th>Permanent Address</th>
																	<th>Date of Joining</th>
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
																		<td><input type="text" value="" id="txxtD<?=$i;?>" class="dob form-control text-uppercase" name="txxtD<?=$i;?>"  ></td>
																		
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
																		<td><input type="text" value="<?php echo strtoupper($rows->date_of_joining);?>" id="txxtD<?=$count;?>" class="form-control text-uppercase" name="txxtD<?=$count;?>" ></td>
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
													<td colspan="4">10.Alteration in the name of the firm or in the location of the Pricipal place of business thereof :</td>
												</tr>
												<tr>
													<td colspan="4">
													<table name="objectTable2" id="objectTable2" class="text-center table table-responsive table-bordered">
													       <thead>
														       <tr>
																	<th></th>
																	<th colspan="2"><h4><b>Name of the firm	</h4></b></th>
																	<th colspan="5"><h4><b>Principal place of business	</h4></b></th>
																</tr>
																<tr>
																	<th>Sl No.</th>
																	<th>Date of alteration</th>
																	<th>Former Name</th>
																	<th>Present Name</th>
																	<th>Former Address</th>
																	<th>Present Address</th>
																</tr>
															</thead>
															<?php
															$part2=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t2 where form_id='$form_id'");
															$num2 = $part2->num_rows;
															if($num2>0){
															$count=1;
															while($row_2=$part2->fetch_array()){?>
															<tr>
																<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_2["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input type="text" id="txtB<?php echo $count;?>" class="dob form-control text-uppercase" value="<?php echo $row_2["date_alteration"]; ?>" name="txtB<?php echo $count;?>" ></td>
																<td><input type="text" value="<?php echo $row_2["former_name"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
																<td><input type="text" value="<?php echo $row_2["present_name"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"  ></td>
																<td><input type="text" value="<?php echo $row_2["former_address"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"  ></td>
																<td><input type="text" value="<?php echo $row_2["present_address"]; ?>" id="txtF<?php echo $count;?>" class="form-control text-uppercase" name="txtF<?php echo $count;?>"  ></td>
															</tr>	
															<?php $count++; } 
															}else{	?>
															<tr>
																<td><input type="text" readonly value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
																<td><input type="text" id="txtB1"  class="dob form-control text-uppercase" name="txtB1"></td>
																<td><input type="text" id="txtC1"  class="form-control text-uppercase" name="txtC1"></td>					
																<td><input type="text" id="txtD1" class="form-control text-uppercase" name="txtD1" ></td>
																<td><input type="text" id="txtE1" class="form-control text-uppercase" name="txtE1" ></td>
																<td><input type="text" id="txtF1" class="form-control text-uppercase" name="txtF1" ></td>
															</tr>
															<?php } ?>
													</table>
													<div align="right" style="position:relative;right:10px"><button type="button" class="btn btn-default" onclick="addMorefunction2()" value="">Add More</button>
													<button type="button" href="#" onclick="mydelfunction2()" class="btn btn-default" value="">Delete</button>
													<input type="hidden" id="hiddenval2" name="hiddenval2" value="<?php echo $hiddenval2; ?>"/></div>
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
	
	<?php require '../../../user_area/includes/footer.php'; ?>
	<?php require '../../../user_area/includes/js.php'; ?>
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