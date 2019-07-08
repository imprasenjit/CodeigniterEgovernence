<?php require_once "../../requires/login_session.php";
$dept="rfs";
$form="18";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);
include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include("save_form18.php");
	
	
	$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1' ");
	if($q->num_rows<1){	 
		$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
		if($p->num_rows>0){
			$results=$p->fetch_assoc();
			$form_id=$results["form_id"];
			$regn_no=$results["regn_no"];$date_regno=$results["date_regno"];$nature_busi=$results["nature_busi"];$post_office=$results["post_office"];$police_station=$results["police_station"];
		}else{
			$form_id="";
			$regn_no="";$date_regno="";$nature_busi="";$post_office="";$police_station="";
		}
	}else{
		$results=$q->fetch_assoc();
		$form_id=$results["form_id"];
		$regn_no=$results["regn_no"];$date_regno=$results["date_regno"];$nature_busi=$results["nature_busi"];$post_office=$results["post_office"];$police_station=$results["police_station"];
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
							
								<br/>
								<div class="tab-content">
									<div>
										<form name="myform1" id="myform1" class="submit1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?>" enctype="multipart/form-data">
										
											<table class="table table-responsive">
												<tr>
													<td width="25%">1. Name of the Society</td>
													<td width="25%"><input type="text" class="form-control text-uppercase" disabled  value="<?php echo $unit_name;?>"></td>
													<td width="25%">2. Registration No.</td>
													<td width="25%"><input type="text" name="regn_no" class="form-control text-uppercase" value="<?php echo $regn_no;?>" /></td>
												</tr>
												<tr>
													<td>3.Date of Registration :</td>
													<td><input type="text" name="date_regno" class="dob form-control text-uppercase" value="<?php echo $date_regno;?>" /></td>
													<td>4.Nature of business :</td>
													<td><input type="text" name="nature_busi" class="form-control text-uppercase" value="<?php echo $nature_busi;?>" /></td>
												</tr>
												<tr>
													<td colspan="4">5. Address of the Society</td>
												</tr>
												<tr>
													<td>Mouza </td>
													<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $mouza; ?>"/></td>
													<td>Circle</td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $circle; ?>"/></td>
												</tr>
												<tr>
													<td>Patta No. </td>
													<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $patta_no; ?>"/></td>
													<td>Dag No.</td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $dag_no; ?>"/></td>
												</tr>
												<tr>
													<td>Area</td>
													<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $area; ?>"/></td>
													<td>Locality  </td>
													<td><input type="text" class="form-control text-uppercase"  disabled value="<?php  echo $b_street_name2; ?>"/></td>
												</tr>
												<tr>
													<td>Village/town/city </td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_vill; ?>"/></td>
													<td>Post Office </td>
													<td><input type="text"  class="form-control text-uppercase" id="post_office" name="post_office" value="<?php  echo $post_office; ?>"/></td>
												</tr>
												<tr> 
													<td>Police Station </td>
													<td><input type="text" class="form-control text-uppercase" id="police_station" name="police_station" value="<?php  echo $police_station; ?>"/></td>
													<td>District</td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_dist; ?>"/></td>
												</tr>
												<tr>
													<td>Pin code </td>
													 <td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_pincode; ?>" ></td>
													 <td>Mobile No.</td>
													<td><input type="text" class="form-control text-uppercase" disabled value="<?php  echo $b_mobile_no; ?>"/></td>
												</tr>
												<tr>
													<td>Email ID</td>
													<td><input type="text" class="form-control" disabled value="<?php  echo $b_email; ?>"/></td>
													<td></td>
													<td></td>
												</tr>
												<tr>
													<td colspan="4"> 6. A list of members of the Executive Committee with their full name (in block letter), address and occupation. :</td>
												</tr>
												<tr>
													<td colspan="4">
													<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
													       <thead>
																<tr>
																	<th>Sl No.</th>
																	<th>Name of the Members</th>
																	<th>Address</th>
																	<th>Occupation</th>
																	<th>Designation</th>
																</tr>
															</thead>
															<?php
															$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_t1 where form_id='$form_id'");
															$num1 = $part1->num_rows;
															if($num1>0){
															$count=1;
															while($row_1=$part1->fetch_array()){?>
															<tr>
																<td><input type="text" readonly id="txtA<?php echo $count;?>" class="form-control text-uppercase" value="<?php echo $row_1["sl_no"]; ?>" name="txtA<?php echo $count;?>" size="1"></td>
																<td><input type="text" id="txtB<?php echo $count;?>" class=" form-control text-uppercase" value="<?php echo $row_1["name_member"]; ?>" name="txtB<?php echo $count;?>" ></td>
																<td><input type="text" value="<?php echo $row_1["address"]; ?>"  id="txtC<?php echo $count;?>" class="form-control text-uppercase" name="txtC<?php echo $count;?>"></td>
																<td><input type="text" value="<?php echo $row_1["occupation"]; ?>" id="txtD<?php echo $count;?>" class="form-control text-uppercase" name="txtD<?php echo $count;?>"  ></td>
																<td><input type="text" value="<?php echo $row_1["designation"]; ?>" id="txtE<?php echo $count;?>" class="form-control text-uppercase" name="txtE<?php echo $count;?>"  ></td>
															</tr>	
															<?php $count++; } 
														 }else{	?>
															<tr>
																<td><input type="text" readonly value="1" id="txtA1" size="1" class="form-control text-uppercase" name="txtA1"></td>
																<td><input type="text" id="txtB1"  class="form-control text-uppercase" name="txtB1"></td>
																<td><input type="text" id="txtC1"  class="form-control text-uppercase" name="txtC1"></td>					
																<td><input type="text" id="txtD1" class="form-control text-uppercase" name="txtD1" ></td>
																<td><input type="text" id="txtE1" class="form-control text-uppercase" name="txtE1" ></td>
															</tr>
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
