<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Update My Profile </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url();?>public/css/jquery-ui.css" />
        <!--<link rel="stylesheet" href="<?=base_url();?>staffs/requires/cssjs" />
		<script src="staffs/requires/jquerry.form.js"></script>
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>		-->
        
	<!-- edited codes -->	
		
	<style>
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
     </style>
	 

	<!-- edited codes -->	
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
       <div class="wrapper">
            <div class="content-wrapper">
			<div class="row">
                <div class="col-lg-12">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        DMS
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> 
                        </a>
						
						
						<?php
								if ($this->session->flashdata('flashMsg') != NULL)
									echo $this->session->flashdata('flashMsg');
							?>
                    </h3>
                    <div class="box-body">
						 <div class="col-md-6 col-md-offset-4">
						 <form class="form-horizontal" action="<?=base_url(); ?>staffs/dms_upload_docs_con/create_action" method="post">
								<div class="row form-group">
									<div class="col-md-12">
										<label class="col-sm-2 pull-left">Document Name<?php echo form_error('doc_name') ?><span class="text-danger">*</span></label>
										<div class="col-md-4 pull-left">
											<input type="text" class="form-control" name="doc_name" id="doc_name" placeholder="Enter Document Name" value="<?php echo $doc_name; ?>" />
										</div>
									
										<label class="col-sm-2 ">Document Type<?php echo form_error('doc_type') ?> <span class="text-danger">*</span></label>
										<div class="col-md-4 pull-right">
											<input  type="text" class="form-control" name="doc_type" id="doc_type" placeholder="Enter Document type" value="<?php echo $doc_type; ?>" />
										</div>
									</div>
								</div>
								<div class="row form-group">
									<div class="col-sm-12">
										<label for="datetime" class="col-sm-2 pull-left">Date <?php echo form_error('uploaded_date') ?></label>
										<div class="col-sm-4 pull-left">
											<input type="date" class="form-control" name="uploaded_date" id="uploaded_date" placeholder="Enter first name" value="<?php echo $uploaded_date; ?>" />
										</div>

										<label for="varchar" class="col-sm-2">Created By  <?php echo form_error('created_by') ?></label>
										<div class="col-sm-4 pull-right">
											<input type="text" class="form-control" name="created_by" id="created_by" placeholder="Enter last name" value="<?php echo $created_by; ?>" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group"></div>
									<div class=" col-md-12">
										<label for="varchar">Upload Document <?php echo form_error('file_path') ?></label>
										<input type="file" name="file_path" id="file_path" data-error="Please upload Document." value="<?php echo $file_path; ?>" />
									</div>
									
								</div>
								<input type="hidden" name="id" value="<?php echo $id; ?>" /> 
								<div class="row">
									<div class="col-md-8" align="center"></br>
										<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
										<a href="<?php //echo site_url('dms_upload_docs_con') ?>" class="btn btn-default">Cancel</a>
									</div>
								</div>
							<br/>
						</form>
					</div><!--End of col-->
				</div><!--End of box-body-->	
			</div> <!--End of box box-->
		</div><!-- End of col-->
		</div><!--End of row-->
       </div> <!--End of content-wrapper-->
	</div>
           
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
<script type="text/javascript" src="<?= base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
   $(document).ready(function ($) {
		$("#file_path").pekeUpload({
			bootstrap: true,
			url: "<?= base_url(); ?>upload/",
			data: {file: "file_path"},
			limit: 1,
			allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf"
		}); 
		
	});	
	
</script>   
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