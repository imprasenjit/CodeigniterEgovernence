<?php
$this->load->helper("unittype");
$unittypes = get_allunittype();
?>
<div class="container user-bodysection">   
    <div class="row">
        <div class="col-md-4"> <h2>My pending units</h2></div>
        <div class="col-md-3 col-md-offset-5">
            <a href="<?= base_url("users/unit/add/"); ?>" class="btn btn-primary pull-left">Create New Unit</a>
            <a href="<?= base_url("users/unit/pendingunits/"); ?>" class="btn btn-dropbox pull-right">View pending Units</a>
        </div>
    </div>
    <hr>
    <?php
    if ($units) {
        $sl_no = 1;
        foreach ($units as $unit) {
            ?>
            <div class="row">
                <div class="col-md-9"><h4>  Name : <?= $unit->unit_name; ?></h4>
                    <h4>Type : <?= $unittypes[$unit->unit_type]; ?></h4>
                    <h4>Address:<?php $address = $this->address_model->get($unit->address); ?>
                        <?= $address->house_no; ?>,
                        <?= $address->village; ?>,
                        <?= $address->dist; ?> ,
                        <?= $address->state; ?>-<?= $address->pin; ?>  
                    </h4>

                </div>

                <div class="col-md-3">
                    <?php if ($unit->submitstatus == 0) { ?>
                        <a class="btn btn-warning pull-right"  href="<?= base_url(); ?>users/unit/edit/?id=<?= $unit->unit_id; ?>">&nbsp;<i class="fa fa-edit"></i>&nbsp;Edit</a>
                        <?php }else{ ?>
                        <h4 class="text-left">Unit information submitted.<br> Verification is in process.</h4>
                         <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    <hr>
</div>