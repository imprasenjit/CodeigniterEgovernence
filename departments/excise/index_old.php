<?php  require_once "../requires/login_session.php"; ?>
<?php $form_names=$cms->query("select * from excise_form_names") or die("Error : ".$cms->error); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of Doing Business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../user_area/includes/css.php';?>
	
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
				<?php while($rows=$form_names->fetch_object()){
					if($rows->form_no==1){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active">							
								<div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a class="text-bold" href="<?php echo $server_url?>dept_documents/excise/forms/TradeLicenceAppForm.pdf" target="_blank"><i class="fa fa-download"></i> Download Sample form</a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=excise"><i class="fa fa-calendar"></i> Apply Online</a>
								</div>
							</div>							
						</div>
					<?php }
					if($rows->form_no==2){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active">							
								<div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a class="text-bold" href="<?php echo $server_url?>dept_documents/excise/forms/excise_form2.pdf" target="_blank"><i class="fa fa-download"></i> Download Sample form</a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=excise"><i class="fa fa-calendar"></i> Apply Online</a>
								</div>
							</div>	
						</div>
						<?php } ?>
				<?php if($rows->form_no==3){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active">							
								<div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a class="text-bold" href="<?php echo $server_url?>dept_documents/excise/forms/TradeLicenceAppForm.pdf" target="_blank"><i class="fa fa-download"></i> Download Sample form</a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=excise"><i class="fa fa-calendar"></i> Apply Online</a>
								</div>
							</div>		
						</div>
						<?php }
						if($rows->form_no==4){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active">							
								<div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a class="text-bold" href="<?php echo $server_url?>dept_documents/excise/forms/TradeLicenceAppForm.pdf" target="_blank"><i class="fa fa-download"></i> Download Sample form</a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=excise"><i class="fa fa-calendar"></i> Apply Online</a>
								</div>
							</div>							
						</div>
					<?php }
					if($rows->form_no==5){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active">							
								<div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a class="text-bold" href="<?php echo $server_url?>dept_documents/excise/forms/TradeLicenceAppForm.pdf" target="_blank"><i class="fa fa-download"></i> Download Sample form</a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=excise"><i class="fa fa-calendar"></i> Apply Online</a>
								</div>
							</div>		
						</div>  
						<?php }
				} ?>
				</div>
				<br/><br/>
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
							<a href="info.php"><button class="text-bold text-uppercase btn-lg btn btn-block bg-blue-active margin" type="button">Visit Information Portal</button></a>
					</div>
					<div class="col-md-3"></div>
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