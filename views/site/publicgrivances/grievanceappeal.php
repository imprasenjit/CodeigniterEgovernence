<?php 
	$complain_no=$this->input->get("id");
	$grievance_row=$this->publicGrivances_model->getGrievance($complain_no);
	$row=$this->getUser_model->getUserById($grievance_row["user_id"]);
	$getDept=$this->getSubDepartment_model->get_deptbycode($grievance_row["dept"]);
	$gid=$grievance_row["g_id"];
?><br/><br/><br/><br/><br/><br/>
<div class="container">
	<div class="row">
		<div class="heading_pages"><h2>APPEAL GRIEVANCE</h2></div>		
	</div>
	<div class="row">	
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-success">
				<!-- <div class="panel-heading">
					<div align="center"><b>Grievance Form Details</b></div>
				</div> -->
				<div class="panel-body">
					<table class="table table-bordered table-responsive">
						<thead>
							<tr>
								<th colspan="4" class="text-center bg-success">Grievance Form</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Name of the Applicant</td>
								<td><?php echo $row["name"];?></td>
								<td>Phone Number</td>
								<td><?php echo $row["phone"]; ?></td>
							</tr>
							<tr>
								<td>Subject</td>
								<td><?php echo $grievance_row["subject"];?></td>							
								<td>Department</td>
								<td><?php echo $getDept->name;?></td>
							</tr>
							<tr>
								<td>Email ID</td>
								<td><?php echo $row["email"];?></td>
							</tr>
						</tbody>
					</table>
					<center><button id="history_button" class="btn btn-md btn-info text-center">Click here to view history</button></center>
					<div id="wrapper">
						<?php $messages=$this->publicGrivances_model->getMessages($gid); 
							if($messages){						
							?>
							<div class="panel-heading">
								<div align="center"><h4>Grievance Messages</h4></div>
							</div>
							<div style="padding:10px;border-color: #ccc;border-style: solid;border-top-color: #3c8dbc;">
								
								<?php 			
									foreach($messages as $rows){
										$officer_id=$rows->question_by;	
										$officer_details=$adminFunctions->getUserDetails($officer_id,$dept);
										$udesig_id=$officer_details->udesig;
										$udesigName=$adminFunctions->get_udesigName($udesig_id,$dept);
										$question=$rows->question;
										$q_date=$rows->q_date;
										$a_date=$rows->a_date;
										$status=$rows->status;
										$answer=$rows->ans;			
									?>
									<div class="box-body no-padding" style="padding-top:20px;">
										<div class="mailbox-read-info" style="padding-bottom:20px">
											<p>
												From : <b><?php echo $udesigName." - ".$dept_name; ?></b><br/>
											Date : <?php echo date('D, d-M-Y', strtotime($q_date))." at ".date('g:i A', strtotime($q_date));?></p>
											<!--<span class="mailbox-read-time pull-right"><?php echo date('D, d-M-Y', strtotime($q_date))." at ".date('g:i A', strtotime($q_date));?></span></p>-->
										</div>
										<!-- /.mailbox-controls -->
										<div class="mailbox-read-message">
											<p><?php echo $question; ?></p>
										</div>
										<!-- /.mailbox-read-message -->
									</div>
									<?php 
										if($status==1){ ?>
										<hr/>
										<div class="box-body no-padding">
											<div style="box-sizing: border-box;padding-bottom:20px" class="mailbox-read-info">
												<p>------Replied------<br/>Date : <?php echo date('D, d-M-Y', strtotime($a_date))." at ".date('g:i A', strtotime($a_date));?></p>
												
											</div>
											<!-- /.mailbox-controls -->
											<div class="mailbox-read-message">
												<p><?php echo $answer; ?></p>
											</div>
											<!-- /.mailbox-read-message -->
										</div>			
										<!-- /.box-body -->
										<?php if(!empty($rows->reply_doc)){ ?>
											<div class="box-footer" style="padding-top:20px;border-top: 1px dotted #ccc;border-bottom: 2px solid #ccc" >
												<ul class="mailbox-attachments clearfix">
													<li>
														<div class="mailbox-attachment-info">
															<a href="../Document_locker/grievance/<?php echo $rows->reply_doc; ?>" target="_blank" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> View attachment</a>
															<span class="mailbox-attachment-size">
																&nbsp;
																<a href="../Document_locker/grievance/<?php echo $rows->reply_doc;?>" target="_blank" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
															</span>
														</div>
													</li>
												</ul>
											</div>
										<?php } ?>
										<!-- /.box-footer -->
										<?php					
										}else{ ?>
										<div class="box-footer">
											<div class="pull-right">
												<?php 
													if($sid==$user_id){
														echo '<a href="#showTab" class="btn btn-default" data-toggle="tab" ><i class="fa fa-reply"></i> Reply</a>';
														}else{
														
													} 
												?>
												
											</div>
											<br>
											<hr/>
											<div class="tab-content">
												<div role="tabpanel" class="tab-pane box" id="showTab">
													<form name="myform1" id="myform1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
														<input type="hidden" name="g_id" value="<?php echo $rows->g_id; ?>"/>
														<input type="hidden" name="msg_id" value="<?php echo $rows->id; ?>"/>
														<input type="hidden" name="token" value="<?php echo $token; ?>"/>
														<div class="form-group">
															<label for="exampleInputEmail1">Your Message</label>
															<textarea class="form-control" name="ans" required="required" placeholder="Type your reply here" rows="3"></textarea>
														</div>
														<div class="form-group">
															<label for="exampleInputFile">Upload File : </label>
															<input accept=".jpg, .jpeg, .png, .pdf" type="file" name="reply_doc">
															<span class="filetype_Error"></span>											
														</div>
														<button type="submit" name="reply" class="btn btn-primary">Send Message</button>
													</form>
												</div>
											</div>
											<br/>
										</div>
										<?php }
									} ?>
									<br>
							</div>
						<?php } ?>
						
						<?php $processes=$this->publicGrivances_model->grievanceRedressalProcess($gid);  
							if($processes){ ?>
							<div class="panel-heading" style="margin-top:40px">
								<div align="center"><h4>Grievance Processes</h4></div>
							</div>
							<table class="table table-bordered table-responsive">
								<thead>						
									<tr>
										<th>#</th>
										<th>Process Date</th>
										<th>Processed By</th>
										<th>Department</th>
										<th>Process</th>
										<th>Remarks</th>
									</tr>
								</thead>
								<tbody>
									<?php $sl=1;
										foreach($processes as $rows){ 
											$officer_id=$rows->processed_by;
											$processed_dept=$rows->processed_dept;
											$forward_dept=$rows->forward_dept;
											$forward_to=$rows->forward_to;
											
											$process_type=$rows->process_type;
											$remark=$rows->remark;
											if($process_type=="F"){
												$officer_query=$this->publicGrivances_model->getOfficer($forward_to,$forward_dept);
												$officer_name=$officer_name_query->user_name;
												$this->load->model("eodbfunctions/getUserById_model");
												$forward_dept=$this->getUserById_model->getUserById($forward_dept);
												$process_type='Forwarded to '.$officer_name." , ".$forward_dept["name"];
												}else{
												$process_type='Resolved';$stop_process=1;
											}
											if($processed_dept=="goa"){
												$officer_query=$this->publicGrivances_model->getOfficer($officer_id,"goa");
												$officer_name=$officer_query->user_name;
												}else if($processed_dept=="pmu"){
												$officer_query=$this->publicGrivances_model->getOfficer($officer_id,"pmu");
												$officer_name=$officer_query->user_name;
												}else if($processed_dept=="cms"){
												$officer_query=$this->publicGrivances_model->getOfficer($officer_id,"cms");
												$officer_name=$officer_query->user_name;
												}else{
												$officer_query=$this->publicGrivances_model->getOfficer($officer_id);
												$officer_name=$officer_query->user_name;
											}
											$processed_dept=$this->getSubDepartment_model->get_deptbycode($grievance_row["dept"]);
										?>
										<tr>
											<td><?php echo $sl; ?></td>
											<td><?php echo date("d-m-Y",strtotime($rows->p_date)); ?></td>
											<td><?php echo $officer_name; ?></td>
											<td><?php echo $processed_dept->name; ?></td>
											<td><?php echo $process_type; ?></td>
											<td><?php echo $remark; ?></td>
										</tr>
										<?php $sl++;
										} ?>
								</tbody>
							</table>
						<?php } ?>			
					</div>
				</div>
			</div>
		</div>
	</div>
	<br/>
	<div class="row">
		<div class="text-center text-success"><h2>Appeal Grievance</h2></div>		
	</div>
	<br/>
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-success">
				<div class="panel-heading">
					<div align="center"><b>Raise an Appeal</b></div>
				</div>
				<div class="panel-body">
					<form id="myform" enctype="multipart/form-data" method="post" action="" name="myForm">	
					
					<input type="hidden" value="<?php echo $gid; ?>" name="token"/>
						<input type="hidden" value="<?php echo $gid; ?>" name="g_id"/>
						<div class="form-group">
							<label for="exampleInputEmail1">Subject</label>
							<input validate="specialChar" type="text" class="form-control" id="" name="subject" title="Subject" Placeholder="Subject">
						</div>
						<div class="form-group">
							<label for="exampleInputEmail1">Message</label>
							<textarea validate="specialChar" type="text" class="form-control" id="" name="message" title="Message" placeholder="Please enter your message here"></textarea>
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Upload File : </label>
							<input type="file" name="document" id="file">
							<span class="filetype_Error"></span>											
						</div>
						<center><a href="#!" id="submit" class="btn btn-success">Submit</a></center>
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
					<p id="message" class="text-danger"></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
			
		</div>
	</div>
<script>
	$("#wrapper").toggle();
	$("#history_button").click(function() { 
		// assumes element with id='button'
		$("#wrapper").toggle();
	});
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
	$(document).ready(function(){
		$("#file").pekeUpload({
			bootstrap:true, 
			url:"<?php echo base_url();?>/upload/",
			//data:{folder:0},
			allowedExtensions:"JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
		});//End of PEKEUPLOAD
		
		$('#submit').click(function(){
				$(this).empty().append("Processing...");
				var data=$('#myform').serializeArray();
				var userid=<?php echo $this->session->userdata("user_id"); ?>;
				$.ajax({
					type: 'POST',
					url: '<?= base_url();?>site/publicgrievances/storeAppealGrievance/', 
					data: data,
					dataType:'json',
					beforeSend:function(){
						
					},
					success:function(res){ 	//alert(data);
						if(res.x == 1){
							$('#title').empty().append("Success");
							$('#message').empty().append("<p>Thank you  for your Appeal.</p>");
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
</script>	