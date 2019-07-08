<?php
$dept_code = $this->session->staff_dept; 
$dept_name = $this->subdepartments_model->get_deptbycode($dept_code)->name;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || Staff Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <section class="content-header" style="padding-top: 2px">
                    <div class="box box-primary" style="margin-bottom: 0px">
                        <div class="row">					
                            <div class="col-sm-3 col-xs-4 col-md-3">
                                <img class="img-responsive pull-left" style="height:60px" src="<?= base_url('public/'); ?>imgs/assam.png">
                            </div>
                            <div class="col-sm-6 col-xs-8 col-md-6">
                                <h3 class="text-center text-uppercase"> <?= $dept_name; ?></h3>
                            </div>
                            <div class="col-sm-3 hidden-xs col-md-3">
                                <img class="img-responsive pull-right" style="height:60px" src="<?= base_url('public/'); ?>imgs/eodb_logo.png">
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3 id="total_applications">
                                        <?= sprintf("%05d", is_array($this->applicationreports_model->get_allApplications($dept_code))?count($this->applicationreports_model->get_allApplications($dept_code)):0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Total Applications
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                </div>
                                <a href="<?= base_url('staffs/'); ?>totalapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3 id="total_underprocessed_applications">
                                        <?= sprintf("%05d", is_array($this->applicationreports_model->get_underprocessedApplications($dept_code))?count($this->applicationreports_model->get_underprocessedApplications($dept_code)):0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Under Process</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-hourglass-2"></i>
                                </div>
                                <a href="<?= base_url('staffs/'); ?>underprocessedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3 id="total_completed_application">
                                        <?= sprintf("%05d", is_array($this->applicationreports_model->get_approvedApplications($dept_code))?count($this->applicationreports_model->get_approvedApplications($dept_code)):0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Approved</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check-square"></i>
                                </div>
                                <a href="<?= base_url('staffs/'); ?>approvedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3 id="total_rejected_applicaions">
                                        <?= sprintf("%05d", is_array($this->applicationreports_model->get_rejectedApplications($dept_code))?count($this->applicationreports_model->get_rejectedApplications($dept_code)):0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Rejected</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-trash-o"></i>
                                </div>
                                <a href="<?= base_url('staffs/'); ?>rejectedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-primary fixedHeight">
                                <div class="box-header  with-border">
                                    <i class="fa fa-lock"></i>
                                    <h3 class="box-title">Recent Application Forms</h3>
                                </div>
                                <div class="box-body"  style="height:200px; overflow: auto;">
                                    <table class="table table-bordered table-responsive">
                                        <tbody>
                                            <?php
                                            $dept_code = $this->session->staff_dept; 
                                            $apps = $this->applicationreports_model->get_allApplications($dept_code);
                                            $sl=1;
                                            foreach($apps as $rows) {
                                                $frmtbl = $rows["frmtbl"];
                                                $form_id = $rows["form_id"];
                                                $encoded = encodeme($frmtbl."|||".$form_id);
                                                $uain = $rows["uain"];
                                                if(is_null($uain) || $uain == "") {
                                                    $uain = "No UAIN found!";
                                                } else {
                                                    $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                                                }
                                                $received_date = $rows["received_date"];
                                                if(is_null($received_date) || $received_date == "") {
                                                    $received_date = "No date found!";
                                                } else {
                                                    $received_date = date("d-m-Y h:i A", strtotime($received_date));
                                                }
                                                ?>
                                            <tr>
                                                <td><?=$uain?></td>
                                                <td><?= $received_date; ?></td>
                                            </tr>
                                            <?php $sl++;} ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="box-footer text-center" style="padding: 2px">
                                    <a class="btn btn-primary" href="<?=base_url('staffs/myapplications')?>"><i class="fa fa-eye"></i> View All</a>
                                </div>
                            </div>
                        </div><!--End of .col-md-6 -->
                        <div class="col-md-6">
                            <div class="box box-primary fixedHeight">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-certificate"></i> E-Bulletin</h3>
                                </div>
                                <div class="box-body" style="height:200px; overflow-y: auto">

                                </div>
                                <div class="box-footer text-center" style="padding: 2px">
                                    <a class="btn btn-primary" href="#"><i class="fa fa-eye"></i> View All</a>
                                </div>
                            </div>
                        </div><!--End of .col-md-6 -->
                    </div>
                </section>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>