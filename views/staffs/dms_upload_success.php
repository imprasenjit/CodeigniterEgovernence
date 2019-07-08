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
		
        <script type="text/javascript">
            $(document).ready(function () {
                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script>
	<!-- edited codes -->	
		 <script> 
        $(document).ready(function() { 
         var progressbar     = $('.progress-bar');
            $(".upload-image").click(function(){
            	$(".form-horizontal").ajaxForm(
		{
		  target: '.preview',
		  beforeSend: function() {
			$(".progress").css("display","block");
			progressbar.width('0%');
			progressbar.text('0%');
                    },
		    uploadProgress: function (event, position, total, percentComplete) {
		        progressbar.width(percentComplete + '%');
		        progressbar.text(percentComplete + '%');
		     },
		})
		.submit();
            });


        }); 
    </script>
	<script>
	.form-control-borderless {
    border: none;
	}

	.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;
	}
	
	img {
	border: 1px solid #ddd; /* Gray border */
	border-radius: 4px;  /* Rounded border */
	padding: 5px; /* Some padding */
	width: 150px; /* Set a small width */
	}

/* Add a hover effect (blue shadow) */
	img:hover {
	box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
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
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        DMS
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> 
                        </a>
                    </h3>
                    <div class="box-body">
						<div class="row justify-content-center">
                        <h3>Your file was successfully uploaded!</h3>

			<ul>
				<?php foreach ($upload_data as $item => $value):?>
				<li><?php echo $item;?>: <?php echo $value;?></li>
				<?php endforeach; ?>
					</ul>

			<p><?php echo anchor('dms_upload_docs', 'Upload Another File!'); ?></p>

                       </div>
                      <!--end of col-->                
				</br>			
			</div><!--End of box-body-->	
        </div> <!--End of box box-->
       </div> <!--End of content-wrapper-->
	</div>
            <?php $this->load->view("staffs/requires/footer"); ?>
	
		
		<script>
		function openTab(tabName) {
		var i, x;
		x = document.getElementsByClassName("containerTab");
		for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
		}
		document.getElementById(tabName).style.display = "block";
		}
		</script>
    </body>
</html>