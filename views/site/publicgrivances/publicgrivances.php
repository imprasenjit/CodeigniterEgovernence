<br/><br/><br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="heading_pages"><h3>GRIEVANCE SUBMISSION FORM</h3></div>
	</div>
	<?php 
		if($this->session->userdata("userlogged")){
		?>
		<div class="row">	
			<div class="col-md-8">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div align="center"><b>Raise a Grievance</b></div>
					</div>
					<div class="panel-body">					
						<form id="myform" enctype="multipart/form-data" method="post" action="" name="myForm">
							<div class="form-group">
								<label for="exampleInputEmail1">Name of the Applicant</label>
								<input readonly="readonly" validate="specialChar" type="text" class="form-control text-uppercase" value="<?php echo $this->session->userdata("user_name");?>" id="" name="applicant_name" title="You can not change the name here">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Phone Number</label>
								<input  readonly="readonly" validate="mobileNumber" type="text" class="form-control" value="<?php echo $phone=$this->session->userdata("user_phone"); ?>" id="" name="phone_no" title="You can not change the mobile number here" placeholder="Phone Number">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email ID</label>
								<input  readonly="readonly" type="email" title="You can not change the email id here" class="form-control" id="" name="email" value="<?php echo $email=$this->session->userdata("user_email"); ?>" placeholder="Email Address">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Select Department against which grievance is to be posted <font color="red">*</font></label>
								<select required="required" name="dept" class="form-control text-uppercase">
									<option value="">Choose a department</option>
									<?php 
										$this->load->model("eodbfunctions/getSubDepartment_model");
										$results=$this->getSubDepartment_model->getAllSubdepartment();
										foreach($results as $key => $value){ ?>
										<option value="<?php echo $value['dept_code']; ?>"><?php echo $value['name']; ?></option>
										<?php }
									?>																	
								</select>
								<font color="red"><?php if(isset($code) && $code == 1){echo $errorMsg ;}?></font>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Subject <font color="red">*</font></label>
								<select required="required" name="subject" id="g_sub" class="form-control text-uppercase">
									<option value="">Choose a Subject</option>
									<option value="S">Single Window Clearance System Application</option>
									<option value="T">Time bound service activity</option>
									<option value="M">My Application</option>
									<option value="O">Other issues related to the Department</option>					
								</select>
							</div>
							<div class="form-group" id="application">
								<label for="exampleInputUain">UAIN &nbsp;<span class="text-danger">*&nbsp;<span class="text-danger" id="uainExists"></span></label>
									<div class="input-group">
										<input type="text" class="form-control" onblur="checkUain(this.value)" name="uain" id="uain" placeholder="Please enter the UAIN"/>
										<div class="input-group-addon"><span id="uain_checker"></span></div>
										<font color="red"><?php if(isset($code) && $code == 1){echo $errorMsg ;}?></font>
									</div>															
								</div>
								<div class="form-group">
									<label for="exampleInputEmail1">Message <font color="red">*</font></label>
									<textarea required="required" name="message" title="Maximum 255 characters are allowed" maxlength="255" validate="jsonObj" placeholder="Please type your message here" class="form-control"></textarea><font color="red"><?php if(isset($code) && $code == 2){echo $errorMsg ;}?></font>
								</div>
								<div class="form-group">
									<label for="exampleInputFile">Upload File (if any) : </label>
									<input type="file" name="document" id="file">
									<span class="filetype_Error"></span>											
								</div>
								<div align="center"><a href="#!" id="submit" class="btn btn-success">Submit</a></div>
							</form>				
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div align="center"><b> Grievance Status</b></div>
						</div>
						<div class="panel-body">
							<div id="token_error">
							</div>
							<p>
								Check grievance status 
								<div class="form-group"><input type="text" name="token_no" id="grievance_token_no" class="form-control" placeholder="Please enter grievance token no"/></div>
							</p>
							<div align="center"><input type="button" class="btn btn-md btn-success text-bold" id="check_grievance" name="check" onclick="checkGrievance()" value="Check"/>
							<input type="button" class="btn btn-md btn-primary text-bold" id="appeal_grievance" name="check" onclick="appealGrievance()" value="Appeal"/></div>
						</div>
					</div>
				</div>
			</div>
			<?php }else{ ?>					
			<div class="row">
				<div style="text-align:center" class="alert alert-danger" role="alert">
					<i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><h4><br/>You must be a registered user to access Grievance Redressal Form. To login <a href="<?php echo base_url();?>homepage/login.php?page=grievance">click here</a> or to register <a href="<?php echo base_url()?>common/registration.php?page=grievance">click here</a>.</h4>
				</div>		
			</div>
		<?php } ?>
	</div>
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title" id="title"></h4>
				</div>
				<div class="modal-body">
					<p id="message" class="text-danger"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			
		</div>
	</div>
	<script type="text/javascript">
		$('#application').hide();
		<?php if(isset($code) && $code == 1){ ?>
			$('#application').show();
		<?php }	?>
		$('#g_sub').on('change', function(){
			if($('#g_sub option:selected').attr('value') == 'M'){
				$('#application').show();
				$('input[name="uain"]').addClass('required');
				$('input[name="uain"]').attr('required', 'required');
				}else{
				$('#application').hide();
				$('input[name="uain"]').removeClass('required');
				$('input[name="uain"]').removeAttr('required');
			}
		});
		function checkUain(uain) { 
			$.ajax({
				type: 'GET',
				url: '<?= base_url();?>site/publicgrievances/checkUain/', 
				data: { uain: uain },
				dataType:'json',
				beforeSend:function(){
					$("#uain_checker").html("<i class='fa-li fa fa-spinner fa-spin'></i>");
				},
				success:function(res){ 	//alert(data);
					if(res.x == 1){
						$("#uain_checker").html("<i style='color:green' class='fa fa-check' aria-hidden='true'></i>");
						$("#uainExists").html("");				
						}else{
						$("#uain_checker").html("<i style='color:red' class='fa fa-times' aria-hidden='true'></i>");
						$("#uainExists").html("<font color='red'>UAIN does not exist !!! please enter your UAIN correctly.</font>");
						$("#uain").val('');
					}   
				},
				error:function(){}
			}); //End of AJAX call   
		}
		function checkGrievance() {
			var grievance_token_no=$("#grievance_token_no").val();
			$.ajax({
				type: 'GET',
				url: '<?= base_url();?>site/publicgrievances/checkGrievance/', 
				data: { grievance_token_no: grievance_token_no },
				dataType:'json',
				beforeSend:function(){
					$("#check_grievance").val("Checking...");
				},
				success:function(res){ 	//alert(data);
					if(res.x == 0){
						$("#token_error").html('<div style="text-align:center" class="alert alert-danger" role="alert"><i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><br/> You have entered the wrong Grievance Token Number.Please try again</div>');
						$("#check_grievance").val("Check");
						}else{					
						var u="<?= base_url();?>site/publicgrievances/grievancetrack/?id="+grievance_token_no+"";
						window.open(u, '_blank');
						$("#check_grievance").val("Check");
					}   
				},
				error:function(){}
			}); //End of AJAX call   
		}
		function appealGrievance() {
			var grievance_token_no=$("#grievance_token_no").val();
			var userid=<?php echo $this->session->userdata("user_id"); ?>;
			$.ajax({
				type: 'GET',
				url: '<?= base_url();?>site/publicgrievances/appealGrievance/', 
				data: { grievance_token_no: grievance_token_no, userid: userid },
				beforeSend:function(){
					$("#appeal_grievance").val("Please wait...");
				},
				success:function(res){ 	//alert(data);
					if(res == 0){
						$("#token_error").html('<div style="text-align:center" class="alert alert-danger" role="alert"><i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><br/> This grievance is under resolution and therefore no appeal can be initiated now. Please click on check to track status of this grievance.</div>');
						$("#appeal_grievance").val("Appeal");
						}else if(res=="appealed"){					
						$("#token_error").html('<div style="text-align:center" class="alert alert-danger" role="alert"><i class="fa fa-2x fa-exclamation-triangle" aria-hidden="true"></i><br/> This grievance is under resolution and therefore no appeal can be initiated now. Please click on check to track status of this grievance.</div>');
						$("#appeal_grievance").val("Appeal");
						}else{
						var u="<?= base_url();?>site/publicgrievances/grievanceappeal/?id="+grievance_token_no+"";
						window.open(u, '_blank');
						$("#appeal_grievance").val("Appeal");
					}   
				},
				error:function(){}
			}); //End of AJAX call   
		}
		$(document).ready(function(){
			$('#submit').click(function(){
			    $(this).empty().append("Processing...");
				var data=$('#myform').serializeArray();
				var userid=<?php echo $this->session->userdata("user_id"); ?>;
				$.ajax({
					type: 'POST',
					url: '<?= base_url();?>site/publicgrievances/storeGrievance/', 
					data: data,
					dataType:'json',
					beforeSend:function(){
						
					},
					success:function(res){ 	//alert(data);
						if(res.x == 1){
							$('#title').empty().append("Success");
							$('#message').empty().append("Thank you <strong>"+res.name+"</strong> for your valuable grievance.<br>Your Complaint Number is - <strong>"+res.complaint_no+"</strong></p>");
							$('#myModal').modal('show');
						}
						else
						{
							$('#title').empty().append("Error");
							$('#message').empty().append(res.error);
							$('#myModal').modal('show');
						}
						$('#myModal').on('hidden.bs.modal', function (e) {
							location.reload(true);
						});
						
					},
					error:function(){}
				}); //End of AJAX call  
			});
		});
		function submitted(event){
			if(document.getElementById('txtArea').value.length == 0){
				alert('Write your feedback and click submit');
				event.preventDefault();
			} 
		}
	</script>	
	<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
	<script>
		$(document).ready(function(){
			$("#file").pekeUpload({
				bootstrap:true, 
				url:"<?php echo base_url();?>/upload/",
				//data:{folder:0},
				allowedExtensions:"JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
			});
		});
	</script>	