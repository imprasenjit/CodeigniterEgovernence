<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Update My Profile </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
		<script src="staffs/requires/jquerry.form.js"></script> <!-- EDITED JS.FILE -->

        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
		<style>
		#myProgress {
		width: 100%;
		background-color: grey;
		}

		#myBar {
		  text-align: center;
		  color: white;
		  width: 1%;
		  height: 20px;
		  background-color: green;
		}
	
		</style>
		 <script> 
       function move() {
  var elem = document.getElementById("myBar"); 
  var width = 20;
  var id = setInterval(frame, 10);
  function frame() {
    if (width >= 100) {
      clearInterval(id);
    } else {
      width++; 
      elem.style.width = width + '%'; 
	   elem.innerHTML = width * 1  + '%';
    }
  }
}
    </script>
	<!-- edited codes -->	
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
			<input type="file" name="image" class="form-control" />
				<!--<button class="btn btn-primary upload-image">Upload Image</button>-->

				 <button type="button" class="btn btn-primary" onclick="move()" data-toggle="modal" data-target="#myModal">Upload Image</button>
				  <div class="modal fade" id="myModal">
					<div class="modal-dialog">
					  <div class="modal-content">
					  
					  
						<div class="modal-body">
							<div id="myProgress">
								<div id="myBar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%; align: center"> </div>
							</div>
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>
						</div><!--End of .modal-content-->
					</div><!--End of .modal-dialog-->
				</div>
				  </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!--End of .wrapper-->
		</body>
</html>