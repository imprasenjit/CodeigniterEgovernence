<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Courier receipts </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#cortbl").DataTable();
                $(".receive-courier").click(function(){
                    if(confirm("Are you sure you want to receive this courier?")){
                        var ids = $(this).attr("id");
                        $.ajax({
                            type: "POST",
                            url: "<?=base_url('staffs/courierreceipts/receive')?>",
                            data: { ids: ids},
                            success:function(res){ //alert(ids+" : "+res);
                                $.notify(res);
                                setTimeout(location.reload.bind(location), 1000);
                            }
                        });//End of ajax()
                    }
                    else{
                        return false;
                    }
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
                <?php $this->load->view("staffs/assets/courierreceipts"); ?>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>