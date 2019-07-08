<?php $results = $this->performancereports_model->get_rows(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Department-wise Performance Reports</title>
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
                                <h3 class="text-center text-uppercase"> Department-wise Performance Reports</h3>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <?php if($results) {
                            foreach($results as $rows) { 
                                $dept_code = $rows->dept_code;
                                $deptRow = $this->subdepartments_model->get_deptbycode($dept_code);
                                if($deptRow) {
                                    $dept_name = $deptRow->name;
                                    $dept_icon = $deptRow->icons;
                                } else {
                                    $dept_name = "Not found!";
                                    $dept_icon = "";
                                }//End of if else                                                   
                                $totApps = $rows->total_received_forms;
                                ?>
                            <div class="col-md-6">
                                <div class="box box-primary">
                                    <div class="box-header with-border text-center">
                                        <i class="<?=$dept_icon?>"></i>
                                        <h3 class="box-title"><?=character_limiter($dept_name, 50)?></h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-12 text-center">
                                            <a href="<?=base_url('cm/performancereports/dept/'.$dept_code)?>">										
                                                <div style="font-size:35px; font-weight: bold">
                                                    <?=sprintf("%03d", $totApps)?>
                                                </div>
                                                <h3 style="font-size: 16px; font-weight:bold">Total Applications Received</h3>
                                            </a>
                                        </div><!-- End of .col-md-3-->
                                    </div>
                                </div><!-- End of .box -->
                            </div><!-- End of .col-md-6-->
                            <?php }//End of foreach
                        }//End of if?>
                    </div><!--End of .row-->
                </section>
            </div>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>