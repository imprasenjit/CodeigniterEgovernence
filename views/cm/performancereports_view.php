<?php
$depts = array();
$pcs = array();
$bgs = array();
$stars = array();
$results = $this->performancereports_model->get_rows();
$counter=1;
if($results) {
    foreach($results as $rows) {
        $dept_code = $rows->dept_code;
        $deptRow = $this->subdepartments_model->get_deptbycode($dept_code);
        $dept_name = $deptRow?$deptRow->name:"Not found!";
        array_push($depts, $dept_name);
        $total_received_forms = $rows->total_received_forms;        
        $total_approved_forms = $rows->total_approved_forms;
        $approved_in_time = $rows->approved_in_time;
        $approved_exceed_time = $rows->approved_exceed_time;
        $total_in_processing = $rows->total_in_processing;
        $processing_in_time = $rows->processing_in_time;
        $processing_exceed_time = $rows->processing_exceed_time;
        $total_rejected = $rows->total_rejected;
        $rejected_in_time = $rows->rejected_in_time;
        $rejected_byond_time = $rows->rejected_byond_time;
        $report_generated_on = $rows->report_generated_on;
        $bgcolor = ($counter%2==0)?"#28a745":"#dc3545";
        array_push($bgs, $bgcolor);
        
        if ($total_received_forms == 0) {
            $percentage = 0;
        } else {
            if ($approved_in_time != 0) {
                $percentage = $approved_in_time * (100 / $total_approved_forms);
                $pcname = array("deptpc"=>$percentage, "dept_code"=>$dept_code, "deptname"=>$dept_name);
                array_push($stars, $pcname);
            } else {
                $percentage = 0;
            }//End of if else
        }//End of if else        
        array_push($pcs, $percentage);        
        $counter++;
    }//End of foreach
    arsort($stars); //Sorting start in descinding order
    $stars = array_slice($stars,0,3); //First 3 depts
}//End of if statement ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CM Dashboard :: Performance Reports</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("cm/requires/cssjs"); ?>
        <link href="<?=base_url('public/css/loading.css')?>" rel="stylesheet" />        
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
                                <h3 class="text-center text-uppercase"> Performance Reports</h3>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <?php foreach($stars as $ss) {
                            $pc = $ss["deptpc"];
                            $dept_code = $ss["dept_code"];
                            $dname = $ss["deptname"];
                            if ($pc < 50) {
                                $star = 0;
                            } else if ($pc < 60) {
                                $star = 1;
                            } else if ($pc < 70) {
                                $star = 2;
                            } else if ($pc < 80) {
                                $star = 3;
                            } else if ($pc < 90) {
                                $star = 4;
                            } else if ($pc < 101) {
                                $star = 5;
                            }//End of if else ?>
                            <div class="col-md-4">
                                <div class="small-box bg-red">
                                    <div class="inner">
                                        <h3 id="total_applications">
                                            <?php for($s = 1; $s <= $star; $s++) {
                                                echo '<i class="fa fa-star" style="color:#ff851b"></i>';
                                            }//End of for() ?>
                                        </h3>
                                        <p class="text-bold" style="font-size:22px"><?=$dname?></p>
                                    </div>
                                    <div class="icon">
                                        <i class="fa fa-list-alt"></i>
                                    </div>
                                    <a href="<?=base_url('cm/performancereports/dept/'.$dept_code)?>" class="small-box-footer">
                                        Performance Percentage : <?=sprintf("%0.2f", $pc)?>%
                                    </a>
                                </div>
                            </div><!--End of .col-->
                        <?php } ?>                        
                    </div>
                    
                    <div class="row">                        
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-body">
                                    <canvas id="bar-chart" width="800" height="450"></canvas>
                                </div>
                            </div>
                        </div><!-- End of .col-md-12-->
                    </div><!--End of .row-->
                </section>
            </div>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script type="text/javascript">
                new Chart(document.getElementById("bar-chart"), {
                    type: 'horizontalBar',
                    //type: 'bar',
                    data: {
                      labels: <?=json_encode($depts)?>,
                      datasets: [
                        {
                          label: "Performance Reports (Percentage)",
                          backgroundColor: <?=json_encode($bgs)?>,
                          data: <?=json_encode($pcs)?>
                        }
                      ]
                    },
                    options: {
                      legend: { display: false },
                      title: {
                        display: true,
                        text: 'Performance Reports'
                      }
                    }
                });
            </script>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>