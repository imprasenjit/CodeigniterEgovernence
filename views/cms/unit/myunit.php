<div class="container user-bodysection">   
    <div class="row container-section">
        <?php
        $this->load->helper("unittype");
        $unittypes = get_allunittype();
        if (count($units) > 0 || count($pending_units)) {
            ?>
            <div class="col-md-2"> <h2>My units</h2></div>
            <div class="col-md-3 col-md-offset-7">
                <a href="<?= base_url("users/unit/add/"); ?>" class="btn btn-primary pull-left">Create New Unit</a>
                <a href="<?= base_url("users/unit/pendingunits/"); ?>" class="btn btn-dropbox pull-right">View pending Units</a>
            </div>
            <hr>
            <?php
            if ($units) {
                $sl_no = 1;
                foreach ($units as $unit) {
                    ?>
                    <div class="row">
                        <div class="col-md-2"><h4>                    <?=
                                $sl_no;
                                $sl_no++;
                                ?> . <?= $unit->unit_name; ?></h4></div>                
                        <div class="col-md-4"><h4><?php $address = $this->address_model->get($unit->address); ?>
                                <?= $address->house_no; ?>
                                <?= $address->village; ?>
                                <?= $address->dist; ?> 
                                <?= $address->state; ?>-<?= $address->pin; ?>   </h4>
                        </div>
                        <div class="col-md-3">

                        </div>
                        <div class="col-md-3">
                            <a class="btn btn-danger pull-right" style="margin-left:15px;" href="<?= base_url(); ?>users/unit/dashboard/?id=<?= $unit->unit_id; ?>">View Unit Dashboard</a></td>
                            <a class="btn btn-warning pull-right"  href="<?= base_url(); ?>users/unit/edit/?id=<?= $unit->unit_id; ?>">Edit</a>

                        </div>
                    </div>
                    <?php
                }
            }else{?>
            <div class="col-md-12">
            <h2 align="center">No units Approved yet</h2>
            <h2 align="center">Check Pending units</h2>
            </div>
            <?php }
        } else {
            ?>
            <h1 align="center">My units</h1>
            <h2 align="center"> First Time here? Create a new unit.</h2>
            <div class="col-md-2 col-md-offset-5"><a href="<?= base_url("users/unit/add/"); ?>" class="btn btn-block btn-bitbucket">Create New Unit</a></div>
<?php } ?>
    </div>   
</div>