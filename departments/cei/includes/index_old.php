<?php  require_once "../requires/login_session.php"; ?>
<?php $form_names=$cms->query("select * from cei_form_names") or die("Error : ".$cms->error); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
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
					<div class="col-md-3"></div>
					<div class="col-md-6">
							<a href="info.php"><button class="text-bold text-uppercase btn-lg btn btn-block bg-blue-active margin" type="button">Visit Information Portal</button></a>
					</div>
					<div class="col-md-3"></div>
				</div>
				<div class="row">
				<?php while($rows=$form_names->fetch_object()){
					if($rows->form_no==1){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_1.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>
							</div>						
						</div>
					<?php }
					if($rows->form_no==2){ ?>
						<div class=" col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6  small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>								
							</div>						
						</div>
						<?php } ?>
				<?php if($rows->form_no==3){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_3.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div> 
								<div class="col-md-6  small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>
							</div>						
						</div>
						<?php }
					if($rows->form_no==4){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>
								
								
                                 
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==5){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==6){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==7){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==8){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==9){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==10){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==11){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==12){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==13){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==14){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php }
						if($rows->form_no==15){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==16){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==17){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==18){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==19){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==20){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==21){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==22){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==23){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==24){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==25){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
						if($rows->form_no==26){ ?>
						<div class="col-md-4">
							<div class="info-box bg-aqua-active" >
							 <div class="info-box-content">
									<strong><p><i class="glyphicon glyphicon-file"></i> <?php echo $rows->form_name; ?></p></strong>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">								
									<a href="<?php echo $server_url;?>dept_documents/cei/forms/Form_2.pdf" target="_blank"><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
								</div>
								<div class="col-md-6 small-box-footer btn btn-primary">			
									<a class="text-bold" href="../requires/terms.php?form=<?php echo $rows->form_no; ?>&dept=cei"><i class="fa fa-calendar"></i> <strong>Apply Online</strong></a>
								</div>                       
								
							</div>						
						</div>
						<?php } 
				} ?>
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