<?php
$dept_code = $this->session->staff_dept;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: All Applications </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link href="<?= base_url("public")?>/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?= base_url("public")?>/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="<?= base_url("public")?>/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#appstbl").DataTable({
                    "order": [[1, 'desc']],
                    "lengthMenu": [[10, 20, 50, 100, 200], [10, 20, 50, 100, 200]]
                });                    
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("staffs/assets/totalapplications"); ?>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/queryModal"); ?>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!--End of .wrapper-->
    </body>
</html>