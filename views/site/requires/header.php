<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Ease of Doing Business in Assam</title>
		<meta name="author" content="Single window Agency, Govt of Assam" />
		<meta name="description" content="ease of doing business assam eodb investment business industry factory registrations approvals applications" />
		<meta name="keywords" content="ease of doing business assam eodb investment business industry factory registrations approvals applications" />
		<meta name="Resource-type" content="Document" />
		<link rel="icon" href="<?php echo base_url(); ?>public/imgs/favicon-32x32.png" type="image/ico" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/jquery.fullPage.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/bootstrap-3.3.7/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/animate.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/eodb.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/datatables.css" />
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/datatables.js" ></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>public/js/pace.js"></script>
		<script>
			paceOptions = {
				elements: true
			};
			Pace.start();
		</script>
	</head>
	<body>
	
		<!-- START NAV BAR -->
		<div class="navbar navbar-default main-header" id="menu">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="" href="/"><img src="<?php echo base_url(); ?>public/imgs/eodb.png" class="logo-eodb"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right menu-ul">
						<ul class="social-network social-circle hidden-sm hidden-xs">
							<li>
								<span id="realtime"></span>
								</li><!--
								<li><a href="#" class="icoFacebook" title="Facebook"><i class="fa fa-facebook"></i></a>
								</li>
								<li><a href="#" class="icoTwitter" title="Twitter"><i class="fa fa-twitter"></i></a>
								</li>
								<li><a href="#" class="icoGoogle" title="Google +"><i class="fa fa-google-plus"></i></a>
							</li>-->
							<li><a href="#" class="icoYoutube" title="Youtube"><i class="fa fa-youtube"></i></a>
							</li>
						</ul>
						<li data-menuanchor="firstPage"><a href="<?php echo base_url()?>#firstPage">Home</a>
						</li>
						<li data-menuanchor="secondPage"><a href="<?php echo base_url()?>#secondPage">About Us</a>
						</li>
						<li data-menuanchor="3rdPage"><a href="<?php echo base_url()?>#3rdPage">Online Services</a>
						</li>
						<li class="dropdown mega-dropdown" id="eodb-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" id="btn-eodb" aria-expanded="false">EODB<span class="caret"></span></a>
							<div class="dropdown-menu mega-dropdown-menu" id="eodb-tab">
								<div class="my_drop_menu">
									<ul class="nav nav-tabs my_tab_menu col-md-3 col-sm-3 col-md-3">
										<li id="first_tab" class="active tab-menu-new "><a href="#a" aria-controls="a" role="tab" data-toggle="tab"><span class="fa fa-window-restore"></span>&nbsp;&nbsp;Departments</a>
										</li>
										<li class="tab-menu-new"><a href="#kya" aria-controls="kya" role="tab" data-toggle="tab"><i class="fa fa-question-circle"></i></span>&nbsp;&nbsp;Know Your Approvals</a>
									</li>
                                    <li class="tab-menu-new"><a href="#loa" aria-controls="loa" role="tab" data-toggle="tab"><i class="fa fa-list-alt"></i></span>&nbsp;&nbsp;List of Approvals</a>
								</li>
								<li class="tab-menu-new"><a href="#ao" aria-controls="ao" role="tab" data-toggle="tab"><i class="fa fa-pencil-square-o"></i></span>&nbsp;&nbsp;Apply Online</a>
							</li>
							<li class="tab-menu-new"><a href="#b" aria-controls="b" role="tab" data-toggle="tab"><i class="fa fa-download"></i></span>&nbsp;&nbsp;Download Notifications</a>
						</li>
						<li class="tab-menu-new"><a href="#gr" aria-controls="gr" role="tab" data-toggle="tab"><i class="fa fa-exclamation"></i></span>&nbsp;&nbsp;Public Grievances </a>
					</li>                                    
					<li class="tab-menu-new"><a href="#c" aria-controls="c" role="tab" data-toggle="tab"><span class="fa fa-level-up"></span>&nbsp;&nbsp;Performance report</a>
					</li>
					<li class="tab-menu-new"><a href="#is" aria-controls="is" role="tab" data-toggle="tab"><span class="fa fa-binoculars"></span>&nbsp;&nbsp;Inspection Schedule</a>
					</li>
					<li class="tab-menu-new"><a href="#d" aria-controls="d" role="tab" data-toggle="tab"><span class="fa fa-university"></span>&nbsp;&nbsp;Land Bank</a>
					</li>
					<li class="tab-menu-new"><a href="#e" aria-controls="e" role="tab" data-toggle="tab"><span class="fa fa-check-square"></span>&nbsp;&nbsp;Online Verification</a>
					</li>
					<li class="tab-menu-new"><a href="#f" aria-controls="f" role="tab" data-toggle="tab"><span class="fa fa-commenting"></span>&nbsp;&nbsp;Public Comments on<br> Draft Notification</a>
					</li>
					<li class="tab-menu-new"><a href="#fb" aria-controls="fb" role="tab" data-toggle="tab"><span class="fa fa-comment"></span>&nbsp;&nbsp; Give Feedback</a>
					</li>
				</ul>
				<div class="tab-content col-md-9 col-sm-9 col-xs-9 menu-tab-content">
					<div class="col-md-12 col-sm-12 col-xs-12 tab-pane header-tab-pane" id="a">
						<h3 align="center">Departments under EODB</h3>
						<hr />
						<ul class=" col-md-4 col-sm-12 custom-list">
							<?php 
								$arr=$this->getDepartments_model->get();  
								//var_dump($arr);
								$s_l_d=1;
								$devideValue=count($arr);
								$devideValue=$devideValue/2;
								if($devideValue <12)
								$devideValue=9;
							?>
							<?php           
								foreach( $arr as $key => $value){
									if($value['status']!=0){
									?>    
									<?php if($s_l_d%$devideValue==0)
										{
										?></ul> <ul class="col-md-4 col-sm-12 custom-list" >
										<?php
										}?>  
										<?php $SubArr=$this->getSubDepartment_model->get($value['id']);?>
										<li class="menu-ul-li-items "><div class="eodb-menu-icons"><span class="<?php echo $value['icons'];?> "></span></div>
											<?php if(count($SubArr) == 0 ){?><a href="<?php echo $value['website'];?>" class="department-links-menu menu-dept-name"><?php echo $value['name'];?></a><?php }else{ ?><a href="#!" class="department-links-menu menu-dept-name"><?php echo $value['name']; ?></a><?php }?>
											<ul style="display:none">       
												<?php 
													foreach( $SubArr as $Subkey => $Subvalue){
														if(count($SubArr) > 0 && $Subvalue['status']!=0){
														?>
														<li class="menu-ul-li-items"><div class="eodb-menu-icons"><span class="<?php echo $Subvalue['icons'];?> "></span></div><a href="<?php echo $Subvalue['website'];?>" class="department-links-menu"><?php echo $Subvalue['name'];?></a></li>
														<?php
														}
													}
												?>
											</ul>
										</li>
										<?php 
											$s_l_d++;
										}
								}
							?>
						</ul>
					</div>
					<div class="tab-pane header-tab-pane" id="kya">
					<h4>Know Your Approvals&nbsp<i class="fa fa-question-circle"></i></h4>
					<h5 align="justify">Starting a new business or setting up a new Industry? Know your approvals before you set up</h5>
					<a href=""><h4>Click here to know more</h4></a>
				</div>
				<div class="tab-pane header-tab-pane" id="loa">
				<h4>List of Approvals&nbsp<i class="fa fa-list-alt"></i></h4>
				<h5 align="justify">This a comprehensive state list of all necessary Business Approvals, Permissions, Registrations, Licenses, NOCs including Returns and Renewals duly notified by Government of Assam, covering all departments related with Business activities</h5>
				<a href="<?php echo base_url(); ?>site/approvals/"><h4>Click here to know more</h4></a>
			</div>
			<div class="tab-pane header-tab-pane" id="ao">
				<h4>Apply Online&nbsp <i class="fa fa-pencil-square-o"></i></h4>
				<h5 align="justify">Select the department or Select the Online Services to Apply online. Read the procedures carefully, download a sample form before you apply online, upload the supporting document online and submit the same. Once you apply online successfully you will get an Unique Application Identification No (UAIN) through which you can track the status of your application</h5>
				<a href="<?php echo base_url(); ?>public/approvals/"><h4>Click here to know more</h4></a>
			</div>
			<div class="tab-pane header-tab-pane" id="b">
				<h4>Download Notification <i class="fa fa-commenting"></i></h4>
				<h5 align="justify"></h5>
				<a href=" <?php echo base_url();?>site/notifications/">
				<h4>Click here to download notifications</h4></a>
			</div>
			<div class="tab-pane header-tab-pane" id="gr">
				<h4>Public Grievances&nbsp <i class="fa fa-exclamation"></i></h4>
				<h5 align="justify">If you have any complain or grievances against any department you can log in with your registered user id and password, select the department and lodge the complaint. A ticket number will be generated through which you can track the status till the same is resolved. </h5>
				<h4><a href="<?php echo base_url();?>site/publicgrievances/">Click here to know more</a> </h4>
			</div>
			<div class="tab-pane header-tab-pane" id="c">
				<h4>State-Infographics &nbsp <i class="fa fa-level-up"></i></h4>
				<h5 align="justify">For transparent and effective service delivery the status of each department engaged in Single Window Clearance System can be viewed on real time basis. This will help the Government to effectively monitor the departments performance status for online service delivery in time. </h5>
				<a href="<?php echo base_url();?>site/statusreport/">
					<h4>Click here to see the State-Infographics of the departments.</h4>
				</a>
				
				
			</div>
			<div class="tab-pane header-tab-pane" id="is">
				<h4>Inspection Schedule <i class="fa fa-binoculars" ></i></h4>
				<h5 align="justify">This a very advance feature of Single Window Clearance System where an Inspection Schedule is generated through an automated system based on computerized risk assessment done by the system. You will be notified of the same well in advance through email and you can also view the inspection schedule in the portal or in your dashboard</h5>
				<h4><a href="<?php echo base_url(); ?>public/inspection_schedules.php">Click here to know more</a></h4>
			</div>
			<div class="tab-pane header-tab-pane" id="d">
				<h4>LandBank <i class="fa fa-university"></i></h4>
				<h5 align="justify">Landbank management system gives you a comprehensive view of the vacant land available in assam for industry.</h5>
				This system also provides the overview of type of land a business require.Search option is available to search among the district and agency of the lands in Assam.
				<h4><a href="<?php echo base_url(); ?>site/landbank/">Click here to view Landbank Details</a></h4>
			</div>
			<div class="tab-pane header-tab-pane" id="e">
				<h3>Online Verification System</h3><hr />
				<h4>To Verify All Approvals Of The Business Enterprise <i class="fa fa-check-square"></i></h4>
				<h5>
					To Verify all approvals of the business enterprise applied online through Single Window Clearance System. 
				</h5>
				<form class="form" role="form" method="post" action="<?php echo base_url('site/approvals/onlineverification');?>" accept-charset="UTF-8">
					<div class="form-group">
						<label for="exampleInputEmail1">Enter UBIN (#)</label>
						<input type="text" class="form-control"  name="token" placeholder="Enter UBIN">
					</div>
					<button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;Submit</button>
				</form>
				<br><br>     <h4>To Verify Specific Approval Of The Business Enterprise <i class="fa fa-check-square"></i></h4>
				<h5>
					To Verify a specific application of the business enterprise for a particular department applied through  Single Window Registration System. 
				</h5>
				<form class="form" role="form" method="post" action="<?php echo base_url('site/approvals/onlineverification');?>" accept-charset="UTF-8">
					<div class="form-group">
						<label for="exampleInputEmail1">Enter  UAIN (#)</label>
						<input type="text" class="form-control" id="usbin" name="token" placeholder="Enter UAIN">
					</div>
					<button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-open-file" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;Submit</button>
				</form>
			</div>
			<div class="tab-pane header-tab-pane" id="f">
				<h4>Public Comments on Draft Notification <i class="fa fa-commenting"></i></h4>
				<h5 align="justify">Transforming the role of Assam Government from regulator to facilitator and to make the participation of all stake holders more inclusive, the Single Window Clearance System has an inbuilt system wherein all the notifications, acts, rules and amendments will be available for public comments. These comments will be considered before enactment of the notification, acts or rules or any amendments made therein. </h5>
				<a href=" <?php echo base_url();?>site/draftnotifications/">
				<h4>Click here to know more</h4></a>
			</div>
			<div class="tab-pane header-tab-pane" id="fb">
				<h4>Give Feedback <i class="fa fa-comment"></i></h4>
				<h5 align="justify">Your feedback is important to us to create a user friendly system. Please do let us know your views. The portal is in beta stage of development and is being continuously improved. If you find any error please do let us know so that we can correct the same. Your cooperation in this regard will be very helpful to us to enhance the usability index of the portal. </h5>
				<h4><a href="<?php echo base_url("site/");?>feedback/">Click here to know more</a></h4>
			</div>
		</div>
		<!-- /tab-content -->
	</div>
</div>
</li>
<li data-menuanchor="5thpage"><a href="<?php echo base_url();?>#5thpage">Contact Us</a>
</li>
<?php if(isset($_SESSION["id"]) && $_SESSION["id"]>0){ ?>
	<li><a href="<?php echo base_url(); ?>userarea/"> Dashboard </a></li>
	<?php }else{ ?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle hidden-xs hidden-sm" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Log In<span class="caret"></span></a>
		<a href="<?= base_url('site/'); ?>login/process" class="dropdown-toggle hidden-lg hidden-md" >Log In</a>
		<ul class="dropdown-menu" id="login-dp">
			<li>
				<div class="row">
					<br>
					<div class="row">
						<div class="center-block">
							<img class="profile-img col-md-4 col-md-offset-4" src="<?php echo base_url(); ?>public/imgs/profile.png" alt="">
						</div>
					</div>
					<br>
					<div class="col-md-12">
						<form class="form" method="POST" id="loginfrm_nav" action="<?= base_url('site/login/process'); ?>">
							<div class="form-group">
								<label>Email Address or Username</label>
								<input type="text" class="form-control" name="username" id="username_nav" placeholder="Email Address or Username" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" class="form-control" name="password" id="password_nav" placeholder="Password" required>
								<div class="help-block text-right"><a href="<?php echo base_url(); ?>site/forgotpassword/">Forgot Password ?</a>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" id=""  class="btn btn-primary btn-block">Sign in</button>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="remember"> Keep me logged-in
								</label>
							</div>
						</form>
					</div>
					<div class="bottom text-center">
						New User? <a href="<?php echo base_url(); ?>site/registration/">Register Here</a>
					</div>
					<div class="bottom text-center">
						<a href="<?php echo base_url(); ?>admin" class="btn btn-danger btn-block"><i class="fa fa-user"></i> Employee Login</a>
					</div>
				</div>
			</li>
		</ul>
	</li>
<?php } ?>
</ul>
</div>
</div>
</div>
<!-- ENDS NAV BAR -->
