<br><br><div class="container">
	<div class="row">
		<div class="heading_pages"><h3>FEEDBACK</h3></div>
		<div class="box-header with-border"><br/></div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<div align="center"><b> Feedbacks</b></div>
				</div>
				<div class="panel-body" style="min-height:570px;">
					<!--<div class="feed">asd</div>-->
					
					
					
					<?php 
						$results=$this->feedback_model->getFeedbacks();
						if(count($results) > 0){ ?>
						<div class="row" style="padding-top: 150px;">
							<div class="col-md-12">
								<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">
										<?php 
											$act=0;
											foreach ($results as $rows){
												
											?>	
											<div class ="item <?php if($act==0)echo 'active';?>">
												<div class="row">
													<div class ="col-md-10">
														<section class="testimonial" aria-label="testimonal">
															<div class="row">
																<div class="col-md-10 col-md-offset-2">
																	<blockquote class="style1 blockquote blockquote-reverse">
																		<p class="mb-0"><?php echo $rows->enq_msg; ?><span></span><br></p>
																		<footer class="blockquote-footer"><cite title="Source Title"><?php echo $rows->name; ?></cite></footer>
																	</blockquote>
																</div>
															</div>
														</section>
													</div>
												</div>
											</div>							
										<?php $act++;} ?>
									</div>
								</div>
								<!-- Controls -->
								<a class="carousel-control-feedback-left" href="#carousel-example-generic" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
								</a>
								<a class="carousel-control-feedback-right" href="#carousel-example-generic" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
								</a>
							</div>
						</div>
						<?php 
							}else{
							echo '
							<div class="list-group">
							<a href="#" class="list-group-item list-group-item-action">
							<h5 class="list-group-item-heading">No records found</h5>
							</a>
							</div>';						
						}
					?>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div align="center"><b>Feedback Form</b></div>
				</div>
				<div class="panel-body">			
					<form id="submitForm" enctype="multipart/form-data" method="post" action="#" name="myForm">
						
						<div class="form-group col-md-12">
							<label for="">Full Name</label>
							<input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Name"><font style="color:#f00"><?php //if(isset($code) && $code == 1){echo $errorMsg ;}?></font>
						</div>
						<div class="form-group col-md-12">
							<label for=""></label>
							<select class="form-control" name="business_type" required="required" id="business_type">
								<option value="B">Name of the Organisation</option>
								<option value="O">Others</option>
							</select>
						</div>
						<div class="form-group col-md-12" id="business_name_div">
							<label for=""></label>
							<input type="text" name="business_name" id="business_name" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Business/Organisation Name">
						</div>
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Email address</label>
							<input type="email" name="email" class="form-control" id="exampleInputEmail1" title="Enter a valid email address" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,4}$" required="required" placeholder="Enter your email address" ><font style="font-color:red"><?php //if(isset($code) && $code == 2){echo $errorMsg ;}?></font>
						</div>
						
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Phone Number</label>
							<input pattern="\d{10}" name="phone_no" type="text" class="form-control" title="Enter a valid phone number" placeholder="Enter your mobile number" maxlength="10" ><font class="compulsory"><?php //if(isset($code) && $code == 3){echo $errorMsg ;}?></font>
						</div>
						
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Name of the Department</label>
							<select required="required" name="dept" class="form-control">
								<option selected value="">Please Select</option>
								<option value="G">General</option>
								<?php 
									$results=$this->getSubDepartment_model->getAllSubdepartment();
									foreach($results as $dept_names){
										echo '<option value="'. $dept_names->dept_code .'">'. $dept_names->name .'</option>'; 
									}
								?>
								
							</select>
						</div>
						
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Issue Type </label>
							<select required="required" name="issue" class="form-control" id="sel1">
								<option selected value="">Please Select</option>
								<option value="GF">General Feedback</option>
								<option value="OS">Online Services</option>
								<option value="OP">Online Processing</option>
								<option value="PR">Payment Related</option>
								<option value="OT">Others</option>
								
							</select>
						</div>
						
						<div id="otherIssue_type" style="display:none" class="form-group col-md-12">
							<label for="exampleInputEmail1">Please Specify </label>
							<input type="text" id="inputIssue" placeholder="" class="form-control text-uppercase" name="inputIssue" pattern="[a-zA-Z0-9.\s]+" />
						</div>
						
						<div class="form-group col-md-12">
							<label for="exampleInputEmail1">Feedback </label>
							<textarea name="enq_msg" class="form-control" rows="4" cols="50" placeholder="Enter your text here" ></textarea><font class="compulsory"><?php //if(isset($code) && $code == 4){echo $errorMsg ;}?></font>
						</div>
						
						<div align="center">
							<a class="btn btn-success" id="submit">Submit</a>
						</div>
						
					</form>			
				</div>
			</div>
		</div>
		
	</div>
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
				<p id="error" class="text-danger"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		
	</div>
</div>
<script>
	$(document).ready(function(){
		$('#submit').click(function(){
			var data=$('#submitForm').serializeArray();
			$.ajax({
				url:"<?= base_url();?>site/feedback/giveFeedback",
				data:data,
				method:"POST",
				dataType:"json",
				success:function(jsn){
				   
					if(jsn.x==0)
					{
					$('#title').empty().append("Error");
					$('#error').empty().append(jsn.error);
					$('#myModal').modal('show');
					}
					else
					{
				    $('#title').empty().append("Success");
					$('#error').empty().append("Thank you for your valuable feedback.");
					$('#myModal').modal('show');
					}
					$('#myModal').on('hidden.bs.modal', function (e) {
	               location.reload(true);
					});
				}		
			});
		});
		
	});
</script>