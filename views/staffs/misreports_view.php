<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: MIS reports </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/css/loading.css')?>" />
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });
                
                $("#dtbl").DataTable();
                
                $(document).on("change", "#pay_mode", function () {
                    var frmdate = $("#frmdate").val();
                    var todate = $("#todate").val();
                    var mod = $(this).val(); //alert("catid : "+catid);
                    if(frmdate == "") {
                        $("#frmdate").notify("From date cannot be empty!", {position:"top"});
                        $("#frmdate").focus();
                    } else if(todate == "") {
                        $("#todate").notify("To date cannot be empty!", {position:"top"});
                        $("#todate").focus();
                    } else if(mod == "") {
                        $(this).notify("Please select a payment mode!", {position:"top"});
                    } else {
                        var url = "<?=base_url('staffs/misreports/index/')?>"+mod
                        window.location = url;
                    }//End of if else                        
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
                <?php $this->load->view("staffs/assets/misreports"); ?>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>