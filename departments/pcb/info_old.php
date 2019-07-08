<?php  require_once "../requires/login_session.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../user_area/includes/css.php';?>
	<style>
		p{text-align: justify;}
	</style>
</head>
<body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
	<div class="wrapper">
	  <?php require '../../user_area/includes/header.php'; ?>
	  <?php require '../../user_area/includes/aside.php'; ?>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header"></section>
			<section class="content">
				<?php require 'includes/banner.php'; ?>
				<div class="row">
					<div class="col-md-3">
						<div class="list-group">						  
						  <a href="#about" data-toggle="tab" class="list-group-item">About Us</a>
						  <a href="#loapplications" data-toggle="tab" class="list-group-item">List of Applications</a>
						  <a href="#lof" data-toggle="tab" class="list-group-item">List of Offices</a>
						  <a href="#procedure" data-toggle="tab" class="list-group-item">Procedure</a>
						  <a href="#time" data-toggle="tab" class="list-group-item">Timeline</a>
						  <a href="#fees" data-toggle="tab" class="list-group-item">Fees and Payments</a>
						  <a href="#tpsc" data-toggle="tab" class="list-group-item">Third Party/Self Certification</a>
						  <a href="#ip" data-toggle="tab" class="list-group-item">Inspection Procedure/Guidelines</a>
						  <a href="#acts" data-toggle="tab" class="list-group-item">Acts and Rules</a>
						  <a href="#nots" data-toggle="tab" class="list-group-item">Notifications and Circulars</a>
						</div>						
					</div>
					<div class="col-md-9">
						<div class="tab-content">
							<?php include 'assets/about.php';?>								
							<?php include 'assets/applications.php';?>
							<?php include 'assets/offices.php';?>							
							<?php include 'assets/procedure.php';?>
							<?php include 'assets/time.php';?>
							<?php include 'assets/fees.php';?>
							<?php include 'assets/thirdParty.php';?>
							<?php include 'assets/InsProcedure.php';?>
							<?php include 'assets/acts.php';?>
							<?php include 'assets/notifications.php';?>
						</div>
					</div>
				</div>
			</section>
		</div>
	  <!-- /.content-wrapper -->
	  <?php require '../../user_area/includes/footer.php'; ?>
	</div>
	<!-- ./wrapper -->
<?php require '../../user_area/includes/js.php' ?>
</body>
</html>