<?php $results = $this->applicationsup_model->get_staffprocessrows($this->dept_code, $this->staff_id, "A"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Approved Applications </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable();
            });
        </script>
    </head>
    <?php if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
    <?php } ?>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Approved Applications
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th>Process Time</th>
                                <th>UAIN</th>
                                <th>Enterprise/Unit Name</th>
                                <th>Processed by</th>
                                <th>Process</th>
                                <th class="text-center">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($results) {
                            $sl=1;
                            foreach($results as $rows) {
                                $unit_id = $rows->unit_id;
                                $unit_name = $rows->unit_name;
                                $uain = $rows->uain;
                                $uainencoded = encodeme($uain);
                                $process_date = $rows->process_date;
                                if(strlen($process_date) >= 10) {                                    
                                    $pdt = date("d-m-Y h:i A", strtotime($process_date));
                                } else {
                                    $pdt = "";
                                }
                                $processed_by = $rows->processed_by;
                                $process = $rows->process;
                                $office_id = $rows->office_id;
                                $current_userid = $rows->current_userid;
                                $deptuserRow = $this->deptusers_model->get_row($current_userid, $this->dept_code);
                                if($deptuserRow) {
                                    $staff_name = $deptuserRow->user_name;
                                    $staff_designation = $deptuserRow->udesig; 
                                } else {
                                    $staff_name = $staff_designation = "Not found";                      
                                }
                                ?>
                            <tr>
                                <td><?=$pdt?></td>
                                <td><?=$uain?></td>
                                <td><?=$unit_name?></td> 
                                <td><?=$staff_name?></td>    
                                <td><?=get_process($process)?></td>
                                <td class="text-center">
                                    <?php if($sl == 1) { ?>
                                        <a class="btn btn-danger blinkme" href="<?= base_url('staffs/applicationprocess/index/').$uainencoded; ?>">
                                            <i class="fa fa-hourglass-2"></i> Process
                                        </a>
                                        <!--
                                        <a class="btn btn-success" href="<?= base_url('staffs/applicationform/index/').$uainencoded; ?>">
                                            <i class="fa fa-folder-open"></i> View
                                        </a>
                                        <a id="<?=$uain?>" class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#queryModal">
                                            <i class="fa fa-comment"></i> Query
                                        </a>
                                        -->
                                    <?php } else { ?>
                                        <a class="btn btn-default" href="javascript:void(0)">
                                            <i class="fa fa-search"></i> Queued
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $sl++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/queryModal"); ?>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>
