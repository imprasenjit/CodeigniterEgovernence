<?php  require_once "../../requires/login_session.php";
$dept="society";
$form="1";
$ci->load->helper('get_uain_details');
$table_name = getTableName($dept, $form);

include "../../requires/check_form_save_mode.php";
$get_file_name=basename(__FILE__);
include "save_form.php";


$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
if($q->num_rows<1){
	$p=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='0' ORDER BY form_id DESC LIMIT 1");
	if($p->num_rows>0){
		$results=$p->fetch_assoc();
		$form_id=$results['form_id'];
		$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$proposed_area=$results['proposed_area'];$s_obj=$results['s_obj'];
	}else{			
		$form_id="";
		$s_po="";$s_ps="";$s_con="";$proposed_area="";$s_obj="";
	}
}else{
	$results=$q->fetch_assoc();
	$form_id=$results['form_id'];
	$s_po=$results['s_po'];$s_ps=$results['s_ps'];$s_con=$results['s_con'];$proposed_area=$results['proposed_area'];$s_obj=$results['s_obj'];		
}	
?>
<?php require_once "../../requires/header.php";   ?>
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
							<form name="myform1" class="submit1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
							<table id="" class="table table-responsive">
								<tr>
									<td width="25%">1. Name of the proposed society:</td>
									<td width="25%"><input type="text"  class="form-control text-uppercase" name="society_name" value="<?php echo $unit_name; ?>" disabled ></td>
									<td width="25%"></td>
									<td width="25%"></td>					
								</tr>
								<tr>
									<td colspan="4">2. The address of the proposed society: </td>
								</tr>
								<tr>
									<td>a) House No./ Bye lane:</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_street_name1; ?>" ></td>
									<td>b) Locality:</td>
									<td><input type="text"  class="form-control text-uppercase"  disabled  value="<?php echo $b_street_name2; ?>" ></td>
								</tr>
								<tr>
									<td>c) Post office:</td>
									<td><input type="text"  class="form-control text-uppercase" name="s_po" value="<?php echo $s_po; ?>" ></td>
									<td>d)P.S:</td>
									<td><input type="text"  class="form-control text-uppercase" name="s_ps" value="<?php echo $s_ps; ?>" ></td>
								</tr>
								<tr>
									<td>e)Vill/ Town:</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $b_vill; ?>"  ></td>
									<td>f) Mouza:</td>
									<td><input type="text"  class="form-control" disabled value="<?php echo $mouza; ?>" ></td>
								</tr>
								<tr>
									<td>g)Circle:</td>
									<td><input type="text"  class="form-control text-uppercase" disabled value="<?php echo $circle; ?>" ></td>
									<td>h) Constituency:</td>
									<td><input type="text"  class="form-control text-uppercase" name="s_con" value="<?php echo $s_con; ?>" ></td>
								</tr>
								<tr>
									<td>i)Sub-division:</td>
									<td><input type="text"  class="form-control text-uppercase" name="b_block" disabled value="<?php echo $b_block; ?>"  ></td>
									<td>j)District:</td>
									<td><input type="text"  class="form-control" disabled value="<?php echo $b_dist; ?>" ></td>
								</tr>
								<tr>
									<td>3. Proposed area of operation of the society:</td>
									<td><input type="text"  class="form-control text-uppercase" name="proposed_area" value="<?php echo $proposed_area; ?>" ></td>
									<td>4.Objective of the society:</td>
									<td><textarea  class="form-control text-uppercase" name="s_obj" ><?php echo $s_obj; ?></textarea>255 Characters only</td>
								</tr>
								<tr>
									<td colspan="4"><b>Yours faithfully</b></td>
								</tr>
								<tr>
									<td colspan="4">
										<table name="objectTable1" id="objectTable1" class="text-center table table-responsive table-bordered">
											<thead>
												<tr>
													<th>Sl No.</th>
													<th>Name of Member</th>
													<th>Address</th>
													<th>Age</th>
													<th>Phone No.</th>
													<th>Upload Signature</th>
												</tr>
											</thead>
											<tbody>
											<?php 
											$part1=$formFunctions->executeQuery($dept,"select * from ".$table_name."_members where form_id='$form_id'");
												$num1 = $part1->num_rows;
												if($num1==0){ 
													for($gumo=1; $gumo<11; $gumo++){ ?>
													<tr>
														<td><input type="text" readonly id="txxtA<?=$gumo;?>" class="form-control text-uppercase" value="<?=$gumo;?>" name="txxtA<?=$gumo;?>" size="1"></td>
														<td><input type="text" id="txxtB<?=$gumo;?>" class="form-control text-uppercase" value="" name="txxtB<?=$gumo;?>" required="required"></td>
														<td><input type="text" value=""  id="txxtC<?=$gumo;?>" class="form-control text-uppercase" name="txxtC<?=$gumo;?>" required="required"></td>
														<td><input type="text" value="" id="txxtD<?=$gumo;?>" class="form-control text-uppercase" name="txxtD<?=$gumo;?>" validate="onlyNumbers" maxlength="2" required="required"></td>
														<td><input type="text" value="" id="txxtE<?=$gumo;?>" class="form-control text-uppercase" name="txxtE<?=$gumo;?>" validate="onlyNumbers" required="required"></td>
														<td>
															<span></span>
															<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?=$gumo;?>">Upload</a>
														</td>
													</tr>
												<?php } ?>
												<?php }else{	
													$count=1;
													while($rows=$part1->fetch_object()){
														if($rows->upload_signature == ""){
															$upload_signature="";
															$sign_base64="";
														}else{
															$upload_signature=$rows->upload_signature;
															$sign_path = $server_url. 'departments/society/forms/upload/'.$upload_signature;
															$sign_data = file_get_contents($sign_path);
															$sign_base64 = 'data:image/png;base64,' . base64_encode($sign_data);
														}														 
														?>
														<tr>
															<td><input type="text" readonly value="<?=$count;?>" id="txxtA" size="1" class="form-control text-uppercase" name="txxtA<?=$count;?>"></td>
															<td><input type="text" id="txxtB<?=$count;?>" value="<?php echo strtoupper($rows->member_name);?>" class="form-control text-uppercase" name="txxtB<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtC<?=$count;?>" value="<?php echo strtoupper($rows->member_address);?>" class="form-control text-uppercase" name="txxtC<?=$count;?>" required="required"></td>
															<td><input type="text" id="txxtD<?=$count;?>" value="<?php echo strtoupper($rows->member_age);?>" class="form-control text-uppercase" name="txxtD<?=$count;?>" validate="onlyNumbers" maxlength="2" required="required"></td>					
															<td><input type="text" id="txxtE<?=$count;?>" value="<?php echo strtoupper($rows->member_phone);?>" class="form-control text-uppercase" name="txxtE<?=$count;?>" validate="onlyNumbers" required="required"></td>
															<td>
															<?php if($count<11){ ?>
																<span><input type="hidden" name="member-sign<?php echo $count;?>" value="<?php echo $sign_base64; ?>"><img width="360" height="120" src="upload/<?php echo $upload_signature; ?>"/><br><br></span>
																<a href="#!" class="btn btn-info mysign" data-width="360" data-height="120" data-name="member-sign<?php echo $count;?>">Upload</a>
															<?php } ?>
															</td>
														</tr>
													<?php  $count++;
													}  ?>
											<?php } ?>	
											</tbody>
										</table>
										<!-- <div align="right" style="position:relative;right:10px">
											<button type="button" class="btn btn-default" onclick="addMorefunction1()" value="">Add More</button>
											<button type="button" href="#" onclick="mydelfunction1()" class="btn btn-default" value="">Delete</button>
											<input type="hidden" id="hiddenval1" name="hiddenval1" value="<?php echo $hiddenval1; ?>"/>
										</div>  -->
									</td>
								</tr>
								<tr>
									<td class="text-center" colspan="4">
									<a href="<?php echo $table_name; ?>.php?tab=1"><button type="submit" class="btn btn-primary">Go Back & Edit</button></a>	
									<button type="submit" class="btn btn-success submit1" name="save<?php echo $form; ?>" title="Save it" onclick="return confirm('Do you really want to save the form ?')">Submit</button>
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
<script src="../js/croppie.min.js" type="text/javascript"></script>
<script>
	$('#resid').hide();
	$('input[name="premises"]').on('change', function(){
		if($(this).val() == 'O'){
			$('#resid').show();
		}else{
			$('#resid').hide();
		}
	});
	$('.dob').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
	$('.dob2').datepicker({dateFormat: 'dd-mm-yy', changeMonth: true,changeYear: true, yearRange: "-100:+0"});
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
	/* ---------------------Block all after submit operation-------------------- */
	<?php if($check!=0 && $check!=4){ ?>
		$("#myform1 :input,select").prop("disabled", true);
	<?php } ?>
</script>