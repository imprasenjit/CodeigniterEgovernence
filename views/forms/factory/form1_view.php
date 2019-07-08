<!DOCTYPE html>
<html>
    <head>
        <title><?=$dept_name?> :: <?=$form_name?></title>
        <?php $this->load->view("users/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php $this->load->view("users/requires/header"); ?>
            <?php $this->load->view("forms/requires/dept_banner"); ?>
            <?php $this->load->view("forms/factory/assets/form1"); ?>            
        </div> <!--End of .wrapper -->
        <?php $this->load->view("users/requires/footer"); ?>
    </body>
</html>