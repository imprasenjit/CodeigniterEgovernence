<?php $depts = $this->subdepartments_model->get_rows(); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h3 class="welcomeText text-center text-uppercase">
            DEPARTMENT-WISE APPLICATION REPORTS
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
                    $totApps = $this->appsreports_model->tot_rows($dept_code);;
                    ?>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border text-center">
                            <i class="<?=$dept_icon?>"></i>
                            <h3 class="box-title"><?=character_limiter($dept_name, 50)?></h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12 text-center">
                                <a href="<?=base_url('cms/appsreports/index/'.$dept_code)?>">										
                                    <div style="font-size:35px; font-weight: bold">
                                        <?=sprintf("%03d", $totApps)?>
                                    </div>
                                    <h3 style="font-size: 16px; font-weight:bold">Total Applications</h3>
                                </a>
                            </div><!-- End of .col-md-3-->
                        </div>
                    </div><!-- End of .box -->
                </div><!-- End of .col-md-6-->
                <?php }//End of foreach
            }//End of if?>
        </div><!--End of .row-->
    </section><!-- End of section -->
</div><!--End of .content-wrapper-->
