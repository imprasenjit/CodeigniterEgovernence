<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("admin/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')?>" />
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('public/datatables/')?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {                
                $("#dtbl").DataTable();
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("admin/requires/header");
            $this->load->view("admin/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("admin/assets/users"); ?>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("admin/requires/footer"); ?>
        </div><!--End of wrapper-->
    </body>
</html>