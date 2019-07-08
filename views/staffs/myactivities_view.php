<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: My Activities </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')?>" />
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')?>"></script>
        <script src="<?=base_url('public/datatables/')?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {                
                $("#myactivitiestbl").DataTable();
            });
        </script>
        <style type="text/css">
            .dataTables_wrapper {
                border: 1px solid #ccc;
                padding: 2px;
                padding-bottom: 0px;
            }
        </style>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("staffs/assets/myactivities"); ?>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>