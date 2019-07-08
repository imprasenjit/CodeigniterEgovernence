<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: User Manual </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <object data="<?=base_url('public/imgs/UserManualBackend.pdf')?>" type="application/pdf" width="100%" height="800px"> 

			  <p>It appears because you don't have a PDF plugin for this browser.You can <a href="User Manual Backend.pdf" target="_blank">click here to

			  download the PDF file.</a></p>  

			 </object>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>