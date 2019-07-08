<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || CM Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("cm/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("cm/requires/header");
            $this->load->view("cm/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <section class="content-header" style="padding-top: 2px">
                    <div class="box box-primary" style="margin-bottom: 0px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center text-uppercase"> Welcome to CM dashboard</h3>
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
                                        <?= sprintf("%05d", 0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Total Applications
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-list-alt"></i>
                                </div>
                                <a href="<?= base_url('cm/'); ?>totalapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-orange">
                                <div class="inner">
                                    <h3 id="total_underprocessed_applications">
                                        <?= sprintf("%05d", 0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Under Process</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-hourglass-2"></i>
                                </div>
                                <a href="<?= base_url('cm/'); ?>underprocessedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3 id="total_completed_application">
                                        <?= sprintf("%05d", 0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Approved</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-check-square"></i>
                                </div>
                                <a href="<?= base_url('cm/'); ?>approvedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3 id="total_rejected_applicaions">
                                        <?= sprintf("%05d", 0); ?>
                                    </h3>
                                    <p class="text-bold" style="font-size:22px">Rejected</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-trash-o"></i>
                                </div>
                                <a href="<?= base_url('cm/'); ?>rejectedapplications" class="small-box-footer">
                                    View All <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary fixedHeight">
                                <div class="box-header  with-border">
                                    <i class="fa fa-lock"></i>
                                    <h3 class="box-title">Recent Application Forms</h3>
                                </div>
                                <div class="box-body"  style="height:200px; overflow: auto;">
                                    <table class="table table-bordered table-responsive">
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="box-footer text-center" style="padding: 2px">
                                    <a class="btn btn-primary" href="<?=base_url('cm/myapplications')?>"><i class="fa fa-eye"></i> View All</a>
                                </div>
                            </div>
                        </div><!--End of .col-md-12 -->
                    </div>
                </section>
            </div>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>