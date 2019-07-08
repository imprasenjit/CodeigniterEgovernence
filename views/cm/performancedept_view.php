<?php
$dept_code = $this->uri->segment(4);
$deptRow = $this->subdepartments_model->get_deptbycode($dept_code);
$dept_name = $deptRow?$deptRow->name:"Not found!";
$result = $this->performancereports_model->get_deptrows($dept_code);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CM Dashboard :: Department Performance Reports</title>
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
                                <h3 class="text-center text-uppercase"> Performance Reports for <?=$dept_name?></h3>                                
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <?php if($result) { 
                            $total_received_forms = $result->total_received_forms;          
                            $total_approved_forms = $result->total_approved_forms;        
                            $approved_in_time = $result->approved_in_time;
                            $approved_exceed_time = $result->approved_exceed_time;
                            $intimePc = ($approved_in_time*$total_approved_forms)/100;
                            $exceedtimePc = ($approved_exceed_time*$total_approved_forms)/100;
                            $approvedpcs = array($intimePc, $exceedtimePc);
                            $approvedlbls = array("In Time : ".$approved_in_time, "Beyond Time : ".$approved_exceed_time);

                            $total_in_processing = $result->total_in_processing;
                            $processing_in_time = $result->processing_in_time;
                            $processing_exceed_time = $result->processing_exceed_time;
                            $intimeProcess = ($processing_in_time*$total_in_processing)/100;
                            $exceedtimeProcess = ($processing_exceed_time*$total_in_processing)/100;
                            $processpcs = array($intimeProcess, $exceedtimeProcess);
                            $processlbls = array("In Time : ".$processing_in_time, "Beyond Time : ".$processing_exceed_time);

                            $total_rejected = $result->total_rejected;
                            $rejected_in_time = $result->rejected_in_time;
                            $rejected_byond_time = $result->rejected_byond_time;
                            $intimeReject = ($rejected_in_time*$total_rejected)/100;
                            $exceedtimeReject = ($rejected_byond_time*$total_rejected)/100;
                            $rejectpcs = array($intimeReject, $exceedtimeReject);
                            $rejectlbls = array("In Time : ".$rejected_in_time, "Beyond Time : ".$rejected_byond_time);

                            $report_generated_on = $result->report_generated_on;
                            $bgs = array("#28a745", "#dc3545");
                            ?>
                            <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <canvas id="approved-chart" width="100%" height="200"></canvas>
                                    </div>
                                </div>                            
                            </div><!-- End of .col-md-4-->  

                            <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <canvas id="process-chart" width="100%" height="200"></canvas>
                                    </div>
                                </div>                            
                            </div><!-- End of .col-md-4--> 

                            <div class="col-md-4">
                                <div class="box box-primary">
                                    <div class="box-body">
                                        <canvas id="reject-chart" width="100%" height="200"></canvas>
                                    </div>
                                </div>                            
                            </div><!-- End of .col-md-4-->
                        </div><!--End of .row-->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
                        <script type="text/javascript">
                            new Chart(document.getElementById("approved-chart"), {
                                type: 'pie',
                                data: {
                                  labels: <?=json_encode($approvedlbls)?>,
                                  datasets: [{
                                    label: "Performance Reports (Percentage)",
                                      backgroundColor: <?=json_encode($bgs)?>,
                                      data: <?=json_encode($approvedpcs)?>
                                  }]
                                },
                                options: {
                                  showDatasetLabels : true,
                                  title: {
                                    display: true,
                                    text: 'Total Approved : <?=$total_approved_forms?>'
                                  }
                                }
                            });

                            new Chart(document.getElementById("process-chart"), {
                                type: 'pie',
                                data: {
                                  labels: <?=json_encode($processlbls)?>,
                                  datasets: [{
                                    label: "Performance Reports (Percentage)",
                                      backgroundColor: <?=json_encode($bgs)?>,
                                      data: <?=json_encode($processpcs)?>
                                  }]
                                },
                                options: {
                                  showDatasetLabels : true,
                                  title: {
                                    display: true,
                                    text: 'Total Processed : <?=$total_in_processing?>'
                                  }
                                }
                            });

                            new Chart(document.getElementById("reject-chart"), {
                                type: 'pie',
                                data: {
                                  labels: <?=json_encode($rejectlbls)?>,
                                  datasets: [{
                                    label: "Performance Reports (Percentage)",
                                      backgroundColor: <?=json_encode($bgs)?>,
                                      data: <?=json_encode($rejectpcs)?>
                                  }]
                                },
                                options: {
                                  showDatasetLabels : true,
                                  title: {
                                    display: true,
                                    text: 'Total Rejected : <?=$total_rejected?>'
                                  }
                                }
                            });
                        </script>
                        <?php } else {
                            echo "<h2 class='text-center'>No Records Found!</h2>";
                        }//End of if else ?>
                </section>
            </div>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>