<br><br><br><br><br><br><br><div class="container">   
    <div class="row">
        <div class="col-md-4 shadow">
            <h3>View Department<br>Notifications</h3>
            <a href="<?php echo base_url();?>homepage/draft_post/" class="pull-right">View all departments Notifications</a>
            <hr>
			<?php
				$arr=$this->getDepartments_model->get();
			?>
			<?php           
				foreach( $arr as $key => $value){
				?>    
				<ul class="treeview">
					<li ><i class="fa <?php echo $value['icons'];?> fa-lg dept_draft_icon" aria-hidden="true"></i><a href="<?php if($value['dept_code']=='')echo '#!';else{ echo base_url().'/homepage/draft_post/departments.php?dept='.$value['id'].'&dept_name='.$value['name'];}?>" class="draft_dept_link"><?php echo $value['name'];?></a>
						<?php
							$SubArr=$this->getSubDepartment_model->get($value['id']);                    
							foreach( $SubArr as $Subkey => $Subvalue){
								if(count($SubArr) > 0){
								?>
								<ul>
									<li ><i class="fa <?php echo $Subvalue['icons'];?> fa-lg dept_draft_sub_icon" aria-hidden="true"></i><a href="<?php echo base_url().'/homepage/draft_post/departments.php';?>?dept=<?php echo $Subvalue['id'].'&dept_name='.$Subvalue['name'];?>"><?php echo $Subvalue['name'];?></a></li>
								</ul>
								<?php }
							}
						?>
					</li>
				</ul>
				<?php 
				}
			?>
		</div>
		<div class="col-md-8 ">
			<div class="col-md-12 bg-primary"><h3 class="text-center"><?php if(isset($_GET['dept_name']))echo $_GET['dept_name'];?><br/>Draft Notifications</h3></div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<?php
						$i=1;
						$results=$this->draftNotifications_model->getNotifications();
						if(count($results) > 0)
						{
							foreach ($results as $form){
								$q1_date=new DateTime($form['Noti_date']);
								$timestamp1=$q1_date->getTimestamp();
							?>
							<div class="col-md-6 draft_post" >
								<div class="draft_post_inner draft-post-in">
									<?php if($form['post_image']!='' || $form['post_image']!=NULL){?>
										<div class="col-md-12"><img src="<?php echo base_url().'/images/post/'.$form['post_image'];?>" class="img-responsive" ></div>
									<?php }?>
									<h4 style="text-align:left;"><?php echo html_entity_decode($form['post_name']);  ?></h4>
									<p style="text-align:justify;"><?php
										$str=$form['post'];
										echo html_entity_decode($this->draftNotifications_model->truncateString($str,250, false));  
									?>
									</p> 
									<div class="col-md-6 likes-div"><i class="fa fa-thumbs-up" aria-hidden="true"><?php echo $form['likes'];?></i>
										&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-thumbs-down" aria-hidden="true"><?php echo $form['dislike'];?></i>
									</div>
									<a href="<?php echo base_url();?>site/draftnotifications/getnotification/<?php echo $form['id'];?>/" class="read-more-button">Read more </a>
								</div>
							</div>
							<?php 
							}
						}						 
						else
						{?>
						<div class="col-md-12"><h3>No notifications found <?php if(isset($_GET['dept_name']))echo $_GET['dept_name'];?></h3></div>
						<?php }
					?>
				</div> 
			</div>  
		</div> 
	</div>
</div>				