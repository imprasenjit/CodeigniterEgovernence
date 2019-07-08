<?php $depts = $this->subdepartments_model->get_rows(); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h3 class="welcomeText text-center text-uppercase">
            DEPARTMENT-WISE PAYMENTS REPORTS
        </h3>
        <br/>
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
                                    <a href="<?=base_url('cms/payments/index/'.$dept_code)?>">										
                                        <div style="font-size:22px; font-weight: bold">
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
    </section><!-- End of section -->
</div><!--End of .content-wrapper-->
