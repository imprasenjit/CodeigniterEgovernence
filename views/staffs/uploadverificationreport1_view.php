<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Upload verification reports </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#appstbl").DataTable();
                
                $("#file1").pekeUpload({
                    bootstrap: true,
                    url: "<?=base_url('upload/')?>",
                    data: {file: "reportfile"},
                    limit: 1,
                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                });//End of pekeUpload
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
                <?php $this->load->view("staffs/assets/uploadverificationreport"); ?>
            </div>
            <?php $this->load->view("staffs/requires/verificationModal"); ?>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>