<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: CAFs </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#caftbl").DataTable({
                    "columns": [
                        {"data": "id", width:100},
                        {"data": "ubin"},
                        {"data": "Name"},
                        {"data": "unit_type"},
                        {"data": "b_street_name1"}
                    ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "<?= base_url("staffs/cafs/getDatatableRecords"); ?>",
                        "dataType": "json",
                        "type": "POST",
                    },
                    language: {
                        processing: "<div class='loading'>Loading...</div>",
                    },
                    "order": [[0, 'desc']],
                    "lengthMenu": [[20, 30, 50, 100, 200], [20, 30, 50, 100, 200]]
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
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Common application forms
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="caftbl">
                        <thead>
                            <tr>
                                <th>UNIT ID</th>
                                <th>UBIN</th>
                                <th>Enterprise</th>
                                <th>Unit Type</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>