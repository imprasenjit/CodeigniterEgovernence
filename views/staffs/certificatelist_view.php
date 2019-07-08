<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Upload certificates </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {                             
                $("#dtbl").DataTable();
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
                        Certificates List
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th class="text-center">#SN</th>
                                <th>UAIN</th>
                                <th>Processed Date</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            $dept_code = $this->session->staff_dept;
                            $dept_id = $this->subdepartments_model->get_deptbycode($dept_code)->id;
                            $certRows = $this->certificates_model->get_deptrows($dept_id);
                            if($certRows) {
                                $sl=1;
                                foreach($certRows as $rows) {
                                    $id = $rows->id;
                                    $uain = $rows->uain;
                                    $this->load->helper("encode");
                                    $uainencoded = encodeme($uain);
                                    $process_date = $rows->process_date;
                                    ?>
                                <tr>
                                    <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                                    <td><?=$uain?></td>
                                    <td><?=$process_date?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('staffs/certificates/details/'.$uainencoded)?>" class="btn btn-warning">
                                            <i class="fa fa-book"></i> View Certificate
                                        </a>
                                    </td>
                                </tr>
                                <?php $sl++; }//End of foreach()
                            }//End of if ?>
                        </tbody>
                    </table>
                </div><!--End of .box -->
            </div><!--End of content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>