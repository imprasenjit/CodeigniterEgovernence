<?php  require_once "../requires/login_session.php"; ?>
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
			<?php require 'includes/banner.php';?>
			<div class="row">			
			<div class="col-md-4">
				<div class="info-box bg-aqua-active">
				<div class="info-box-content">
						<strong><p>APPLICATION FOR NOC</p></strong>
					</div>
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="#" data-toggle="modal" data-target="#myModal1" ><i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
					</div>
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="#" data-toggle="modal" data-target="#myModal" ><i class="fa fa-calendar"></i><strong>Apply Online</strong></a></div>
					
					
					<!-- /.info-box-content -->
				</div>	
			</div>			
			<div class="col-md-4">
				<div class="info-box bg-aqua-active">
				<div class="info-box-content">
						<strong><p>RENEWAL OF NOC</p></strong>
					</div>
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form11.pdf">
					<i class="fa fa-download"></i> <strong>Download Sample form</strong></a>
					</div>
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="../requires/terms.php?form=11&dept=fire"><i class="fa fa-calendar"></i><strong>Apply Online</strong></a></div>
					
					
					<!-- /.info-box-content -->
				</div>	
			</div>
			<div class="col-md-4">
				<div class="info-box bg-aqua-active">
				<div class="info-box-content">
						<strong><p>FIRE ATTENDANCE</p></strong>
					</div>
					
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form12.pdf"><i class="fa fa-download"></i><strong>Download Sample form</strong></a>
					</div>
					<div class="col-md-6 small-box-footer btn btn-primary">
					<a href="../requires/terms.php?form=12&dept=fire"><i class="fa fa-calendar"></i><strong>Apply Online</strong></a></div>
					<!-- /.info-box-content -->
				</div>	
			</div>
			<!-- /.modal -content -->
		</div>
		<p></p><br/>
			<div class="modal fade" id="myModal1" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">					
							<h4 class="modal-title">DOWNLOAD APPLICATION </h4>
						</div>
						<div class="modal-body">
							<ul>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form1.pdf">ONE STOREY, MULTISTORIED or HIGH RISE BUILDING</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form2.pdf">STORAGE AND HANDLING OF GASES</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form3.pdf">TRANSPORT GO-DOWNS AND OTHER GO-DOWNS</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form4.pdf">CINEMA/THEATRE HALLS & MULTIPLEX ETC</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form5.pdf">FUNCTION HALLS, BIBAH BHAVAN, BUILDING</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form6.pdf">ERECTING TEMPORARY STRUCTURES, CIRCUS ETC</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form7.pdf">STORAGE AND HANDLING PETROLEUM PRODUCTS/INDUSTRIES</a> </li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form8.pdf">STORAGE AND HANDLING OF CHEMICALS </a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form9.pdf">STORAGE AND HANDLING EXPLOSIVES</a></li>
								<li><a href="<?php echo $server_url?>dept_documents/fire/forms/blank_fire_form10.pdf">STORAGE AND HANDLING PHARMACEUTICAL PRODUCTS</a> </li>
							 </ul>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
				<!-- /.modal contents ends-content -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">					
							<h4 class="modal-title">CHOOSE SUITABLE APPLICATION </h4>
						</div>
						<div class="modal-body">
							<ul>
								<li><a href="../requires/terms.php?form=1&dept=fire">ONE STOREY, MULTISTORIED or HIGH RISE BUILDING</a></li>
								<li><a href="../requires/terms.php?form=2&dept=fire">STORAGE AND HANDLING OF GASES</a></li>
								<li><a href="../requires/terms.php?form=3&dept=fire">TRANSPORT GO-DOWNS AND OTHER GO-DOWNS</a></li>
								<li><a href="../requires/terms.php?form=4&dept=fire">CINEMA/THEATRE HALLS & MULTIPLEX ETC</a></li>
								<li><a href="../requires/terms.php?form=5&dept=fire">FUNCTION HALLS, BIBAH BHAVAN, BUILDING</a></li>
								<li><a href="../requires/terms.php?form=6&dept=fire">ERECTING TEMPORARY STRUCTURES, CIRCUS ETC</a></li>
								<li><a href="../requires/terms.php?form=7&dept=fire">STORAGE AND HANDLING PETROLEUM PRODUCTS/INDUSTRIES</a> </li>
								<li><a href="../requires/terms.php?form=8&dept=fire">STORAGE AND HANDLING OF CHEMICALS </a></li>
								<li><a href="../requires/terms.php?form=9&dept=fire">STORAGE AND HANDLING EXPLOSIVES</a></li>
								<li><a href="../requires/terms.php?form=10&dept=fire">STORAGE AND HANDLING PHARMACEUTICAL PRODUCTS</a> </li>
							 </ul>
						</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
					</div>
				</div>
			</div>
			
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
<script>
$(document).ready(function(){		  
  $('#radio').on('change', function(){
	if($('#radio option:selected').val() == 'YES'){
	  window.location.href="forms/fire_form11.php";
	 
	}else{
	 alert("Please fill Application For Noc");
	}
  });
});
</script>
</body>
</html>