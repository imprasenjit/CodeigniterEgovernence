<?php
$this->load->helper("unittype");
?>
<div class="content-wrapper background-white">
        <div class="row">
        <?php
        $unit = $this->unit_model->getunit('unit_id',$this->session->unit_id);
        ?>
        <div class="callout-blue text-center fade-in-b">
            <h4><b><?= $unit->unit_name; ?></b> - <?= get_unittype($unit->unit_type); ?></h4>
            <h4>UBIN : <?= $unit->ubin; ?></h4>
            <h5><?php
                $this->load->helper("address");
                $address = get_address($unit->address);
                echo $address->address . ',';
                echo '' . $address->dist . ',
                ' . $address->state . '-' . $address->pin;
                ?>  </h5>
        </div>
        </div><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 border-1px">
            <h2>Incomplete Applications</h2><hr>
        <div class="table-container">
                                    <table class="table-with-no-border">
                                        <tbody>
                                            <?php
                                            $this->load->helper("formprocesses");
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
                                            <?php } ?>
                                    </table>
            </div>
            <div class="col-md-12"><?php echo $pagination; ?></div>
            </div>
        
            </div>
        
            </div>
            
        