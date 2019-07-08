<br><br>
<br><br>
<br><br>
<div class="container">
	<div class="col-md-12">
		<?php 
			$id=$pid=$this->uri->segment(4);	   
			$data=$this->draftNotifications_model->getNotificationsById($id);
			foreach($data as $post_data)
			{ ?>
			<h2><?php echo $post_data['post_name']; ?></h2>
			Notification date, <?php $dat_time=$post_data['Noti_date'];
				$q1_date=new DateTime($post_data['Noti_date']);
                $end_date=new DateTime($post_data['valid_date']);
                $end_date_fun=$end_date->getTimestamp();
				$timestamp1=$q1_date->getTimestamp();
				$datt_display_post = date("j F, Y, g:i A", $timestamp1); echo '&nbsp;&nbsp;&nbsp;&nbsp;'.$datt_display_post;
			?>.   <hr>
			<?php if($post_data['post_image']!='' || $post_data['post_image']!=NULL ){?>
				<p><div class="col-md-3 post-image">
					<img src="<?php echo $server_url.'/images/post/'.$post_data['post_image'];?>" 
				class="img-responsive"></div></p><?php }?>
				<p align="justify"><?php echo html_entity_decode($this->draftNotifications_model->ntop($post_data['post'])); ?></p>
				<br>
				<a href="<?php echo 'images/'.$post_data['pdf_file'];?>"><h4><i class="fa fa-cloud-download" aria-hidden="true"></i>&nbsp;Download notification<h4></a>
					<br><br>
					<a href="#!" class="text-primary" id="like" <?php if($this->session->userdata("userlogged")){ ?> onclick="like(<?php echo $post_data['id']; ?>,1)" <?php } ?>>
						<i class="fa fa-thumbs-up fa-2x" aria-hidden="true"><span id="like_count"> <?php echo $post_data['likes']; ?></span></i>
					</a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="#!" class="text-danger" id="unlike"  <?php if($this->session->userdata("userlogged")){ ?> onclick="like(<?php echo $post_data['id']; ?>,0)" <?php } ?>>
					<i class="fa fa-thumbs-down fa-2x" aria-hidden="true"> <span id="unlike_count"><?php echo $post_data['dislike']; ?></span></i></a>
				<?php } ?>
				<div class="col-md-7 pull-right text-right text-danger">Last date of accepting comments is &nbsp;&nbsp;<?php echo date("j F, Y, g:i A",$end_date_fun);?> </div>
				<hr>
				<?php if($this->session->userdata("userlogged")){  ?>
					<h4>Leave a Comment:</h4>
					<form method="post" action="" id="comment">
						<div class="form-group">   
							<textarea  rows="3" class="form-control" name="comment" required></textarea>
							<input type="hidden" name="pid" value="<?php echo $pid; ?>">
						</div>  
						<a href="#!" class="btn btn-success pull-right" id="submit">Submit</a>
					</form>
					<?php }else{ ?>
					<div class="alert alert-danger">
						<strong>You must be a registered user to comment.</strong>To login <a href="<?php echo base_url();?>users/login/">click here</a> or to register <a href="../../common/registration.php?page=discuss&<?php echo $pid; ?>">click here</a>.
					</div>
				<?php }?>
				<br><br>
				<?php 
					$data=$this->draftNotifications_model->getComments($pid);
					if(count($data)>0){ ?>
					<p><span class="badge"><?php echo count($data); ?></span> Comments:</p><br>
					<div class="row">
						<?php 
							foreach($data as $form)
							{
								$q_date=new DateTime($form['time']);
								$a_date=new DateTime();
								$difference = $a_date->diff($q_date);
								$query_time_to_be_substracted=date_create('@0')->add($difference)->getTimestamp();
								$dt1 = new DateTime("@0");
								$dt2 = new DateTime("@$query_time_to_be_substracted");
								$datt=$dt1->diff($dt2)->format('%a days, %h hours, %i minutes and %s seconds');
								$day_time=$dt1->diff($dt2)->format('%a');
								if($day_time>0){
									$q_date=new DateTime($form['time']);
									$timestamp=$q_date->getTimestamp();
									$datt_display = date("F j, Y, g:i a", $timestamp);
									}else{
									$h_time=$dt1->diff($dt2)->format('%h');
									$m_time=$dt1->diff($dt2)->format('%i');
									$s_time=$dt1->diff($dt2)->format('%s');	
									if($h_time>0){
										$datt_display=$dt1->diff($dt2)->format('%h hours, %i minutes and %s seconds');			
										}else{
										if($m_time>0){
											$datt_display=$dt1->diff($dt2)->format('%i minutes and %s seconds');			
											}else{
											$datt_display=$dt1->diff($dt2)->format('%s seconds');
										}
									}		
									//$datt_display=$dt1->diff($dt2)->format('%h hours, %i minutes and %s seconds');
									$datt_display=$datt_display.'&nbsp'.'ago';		
								} ?>
								<div class="col-sm-2 text-center">
									<img src="images/user.jpeg" class="img-circle" height="65" width="65" alt="Avatar">
								</div>
								<div class="col-sm-10">
									<h4><?php echo $form['subject'];  ?> <small><?php echo $datt_display;?></small></h4>
									<p><?php echo $form['comment'];  ?></p><br>
								</div>
						<?php } ?>
						<!--<div class="col-sm-2 text-center">
							<img src="images/user.png" class="img-circle" height="65" width="65" alt="Avatar">
							</div>
							<div class="col-sm-10">
							<h4>Anja <small>Sep 29, 2015, 9:12 PM</small></h4>
							Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</div>-->
					</div>
				<?php } ?>
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
			function like(k,f)
			{
				//alert('operation'+f);
				//("#like").html('precess');
				if(f==1){
					($("#like_count").html('Processing..')) 
					}else{
					($("#unlike_count").html('Processing..')) 	 
				}
				$.ajax({
					cache: false,
					type: 'POST',
					url: '<?php echo base_url();?>site/draftnotifications/postlike/',
					data: 'id='+k+'&flag='+f,
					success: function(data) 
					{    
						//alert(data);
						if(f==1){
							($("#like_count").html(data)) ;
							}else{
							($("#unlike_count").html(data)) ;	
						}
					}
				}); 
			} 
			
			$(document).ready(function(){
				$('#submit').click(function(){
					$(this).empty().append("Saving Comment....");
					var data=$('#comment').serializeArray();
					$.ajax({
						cache: false,
						type: 'POST',
						url: '<?php echo base_url();?>site/draftnotifications/postcomment/',
						data: data,
						success: function(jsn) 
						{    
							if(jsn.x==0)
							{
								$('#title').empty().append("Error");
								$('#error').empty().append(jsn.error);
								$('#myModal').modal('show');
							}
							else
							{
								$('#title').empty().append("Success");
								$('#error').empty().append("Thank you for your Comment.");
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