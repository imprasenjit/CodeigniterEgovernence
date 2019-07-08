<?php $depts = $this->subdepartments_model->get_rows(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CM Dashboard :: Departments Payments</title>
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
                                <h3 class="text-center text-uppercase"> Payment Reports</h3>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <?php if($depts) {
                            foreach($depts as $rows) {
                                $dcode = $rows->dept_code;
                                $dept_code = ($dcode == "pcb" || $dcode == "factory")?$dcode:"pcb";
                                $dept_name = $rows->name;
                                $dept_icon = $rows->icons;

                                $totRequests = $this->paymentrequests_model->tot_deptrows($dept_code); ?>
                                <div class="col-md-6">
                                    <div class="box box-primary">
                                        <div class="box-body">
                                            <div class="col-md-12 text-center">
                                                <i class="<?=$dept_icon?>" style="font-size:32px"></i>
                                                <a href="<?=base_url('cm/payments/index/'.$dept_code)?>">										
                                                    <div style="font-size:24px; font-weight: bold">
                                                        <?=character_limiter($dept_name, 30)?>
                                                    </div>
                                                </a>
                                            </div><!-- End of .col-md-12-->
                                        </div><!-- End of .box-body -->
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