<?php
$this->load->helper("unittype");
?>
<div class="content-wrapper background-white">
    <div class="row">
        <div class="callout-blue text-center fade-in-b">
            <h4><b><?= $unit->unit_name; ?></b> - <?= get_unittype($unit->unit_type); ?></h4>
            <h4>UBIN : <?= $unit->ubin; ?></h4>
            <h5><?php
                $this->load->helper("address");
                $address = get_address($unit->address);
                echo $address->address . ',';
                echo '' . $address->dist . ',
                ' . $address->state . '-' . $address->pin;
				
                ?>  
				</h5>
        </div>
    </div>
    <br>    
    <div class="row">
        <div class="col-md-6 box-div">
            <div class="box box-primary minHeight300">
                <div class="tabbable-panel">
                    <div class="tabbable-line">
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                    Submitted Applications</a>
                            </li>
                            <li>
                                <a href="#tab_default_2" data-toggle="tab">
                                    Incomplete Applications  </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-with-no-padding tab-pane active" id="tab_default_1">
                                <div class="table-container">
                                    <table class="table-with-no-border">
                                        <tbody>
										
                                            <?php
                                            $this->load->helper("formprocesses");
                                            if($submitted_applications){
                                            foreach ($submitted_applications as $application) {
												$uain = $application->uain;
												$uainencoded = encodeme($uain);
                                                ?>
                                                <tr class="tr-border-bottom">
                                                    <td>
                                                        <div class="media">
                                                            <div class="media-body">

                                                                <div class="col-md-7"><h4 class="title">
                                                                        <?= $application->uain; ?>
                                                                        <span class="pull-right pagado"></span>
                                                                    </h4>                                                                    
                                                                    <p class="summary"></p>
                                                                </div>
                                                                <div class="col-md-4 text-right"><h4><?= get_process($application->current_status); ?></h4></div>
                                                                <div class="col-md-1">
                                                                    <h4><a href="<?= base_url('users/dashboard/get_appl_view/').$uainencoded; ?>" class="">View</a></h4>
																		
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }} ?>
										
                                    </table>
                                </div>
                            </div>
                            <div class="tab-with-no-padding tab-pane " id="tab_default_2">
                                <div class="table-container">
                                    <table class="table-with-no-border">
                                        <tbody>
                                            <?php
                                            if ($incomplete_applications) {
                                                foreach ($incomplete_applications as $application) {
                                                    ?>
                                                    <tr class="tr-border-bottom">
                                                        <td>
                                                            <div class="media">
                                                                <div class="media-body">
                                                                    <div class="col-md-7"><h4 class="title">
                                                                            <?= $application->uain; ?>
                                                                            <span class="pull-right pagado"></span>
                                                                        </h4>                                                                    
                                                                        <p class="summary"></p>
                                                                    </div>
                                                                    <div class="col-md-4 text-right"><h4><?= get_process($application->current_status); ?></h4></div>
                                                                    <div class="col-md-1">
                                                                        <!--<h4><a href="" class="">View</a></h4>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-center" >
                    <a href="<?= base_url("users/dashboard/viewallsubmittedapplications/".$this->session->unit_id."");?>" class="pull-left">View All Submitted Applications</a>
                    <a href="<?= base_url("users/dashboard/viewallincompleteapplications/".$this->session->unit_id."");?>" class="pull-right">View All Incomplete Applications</a>
                </div>
            </div>
            
        </div> <!--End of .col-md-6 -->
        <div class="col-md-6 box-div">
            <div class="box box-primary minHeight300" >
                <div class="box-header with-border" >
                    <i class="fa fa-inbox"></i>
                    <h3 class="box-title">My Inbox </h3>
                </div>
                <div class="box-body text-center" id="myinbox">
                    <table class="table table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Message</th>
                                <th>UAIN</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if($messages){ 
                                foreach($messages as $msg){?>
                            <tr>
                                <td class="text-left"><?=$msg->msg;?></td>
                                <td class="text-left" width="35%"><?=$msg->uain;?></td>
                                <td class="text-left" width="20%"><?=date("d-m-Y h:i A", strtotime($msg->q_date));?></td>
                            </tr>
                            <?php }}?>
                        </tbody>
                    </table>

                </div>
                <div class="box-footer text-center" >
                    <a href="<?= base_url("users/dashboard/viewallmessages/".$this->session->unit_id."");?>" class="">View All</a>
                </div>
            </div>
        </div> <!--End of .col-md-6 -->
    </div> <!--End of .row -->


</div> <!--End of .content-wrapper -->
