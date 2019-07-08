<div class="container user-bodysection"> 
    <?php if ($this->session->flashdata("flashMsg")) { ?>
        <div class="alert alert-success" role="alert"><?= $this->session->flashdata("flashMsg"); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php } ?>
    <div class="row container-section">
        <div class="tabbable-panel">
            <div class="tabbable-line">
                <ul class="nav nav-tabs ">
                    <li class="active">
                        <a href="#tab_default_1" data-toggle="tab">
                            Approved Units </a>
                    </li>
                    <li>
                        <a href="#tab_default_2" data-toggle="tab">
                            Submitted Units </a>
                    </li>
                    <li>
                        <a href="#tab_default_3" data-toggle="tab">
                            Rejected Units </a>
                    </li>
                    <li>
                        <a href="#tab_default_4" data-toggle="tab">
                            Pending Units </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_default_1">
                        <?php
                        $this->load->helper("unittype");
                        $unittypes = get_allunittype();
                        if ($approved_units) {
                            if (count($approved_units) > 0) {
                                $sl_no = 1;
                                foreach ($approved_units as $unit) {
                                    ?>
                                    <div class="row" style="border-bottom: 2px solid #000;">
                                        <div class="col-md-3"><h4>                    <?=
                                                $sl_no;
                                                $sl_no++;
                                                ?> . <?= $unit->unit_name; ?></h4>     
                                            <h4><?php $address = $this->address_model->get($unit->address); ?>
                                                <?= $address->dist; ?> 
                                                <?= $address->state; ?>-<?= $address->pin; ?>   </h4>
                                        </div>
                                        <div class="col-md-3"><h4>Username: <?= $unit->app_username; ?></h4>
                                            <h4><?= $unit->ubin; ?> </h4>
                                        </div>
                                        <div class="col-md-6">
                                            <a class="btn btn-danger pull-right" style="margin-left:15px;" href="<?= base_url(); ?>users/dashboard/view/<?= $unit->unit_id; ?>/">View Unit Dashboard</a>
                                            <a class="btn btn-danger pull-right change_password" style="margin-left:15px;" href="#!"  data_id="<?= $unit->unit_id; ?>" data_name="<?= $unit->app_username; ?>">Change Password</a>
                                            <a class="btn btn-warning pull-right"  href="<?= base_url(); ?>users/unit/edit/?id=<?= $unit->unit_id; ?>">Edit</a>

                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="col-md-12">
                                    <h2 align="center">No units Approved yet</h2>
                                    <h2 align="center">Check Pending units</h2>
                                </div>
                                <?php
                            }?>
                        <div class="col-md-2 pull-right"><a href="<?= base_url("users/unit/add/"); ?>" class="btn btn-block btn-bitbucket">Create New Unit</a></div>
                        <?php
                        } else {
                            ?>
                            <h1 align="center">My units</h1>
                            <h2 align="center"> First Time here? Create a new unit.</h2>
                            <div class="col-md-2 col-md-offset-5"><a href="<?= base_url("users/unit/add/"); ?>" class="btn btn-block btn-bitbucket">Create New Unit</a></div>
                        <?php } ?>
                            
                    </div>
                    <div class="tab-pane" id="tab_default_2">
                        <?php
                        if ($submitted_units) {
                            $sl_no = 1;
                            foreach ($submitted_units as $unit) {
                                ?>
                                <div class="row">
                                    <div class="col-md-9"><h4>  Name : <?= $unit->unit_name; ?></h4>
                                        <h4>Type : <?= $unittypes[$unit->unit_type]; ?></h4>
                                        <h4>Address:<?php $address = $this->address_model->get($unit->address); ?>
                                            <?= $address->dist; ?> ,
                                            <?= $address->state; ?>-<?= $address->pin; ?>  
                                        </h4>

                                    </div>

                                    <div class="col-md-3">
                                        <?php if ($unit->submitstatus == 0) { ?>
                                            <a class="btn btn-warning pull-right"  href="<?= base_url(); ?>users/unit/edit/?id=<?= $unit->unit_id; ?>">&nbsp;<i class="fa fa-edit"></i>&nbsp;Edit</a>
                                        <?php } else { ?>
                                            <h4 class="text-left">Unit information submitted.<br> Verification is in process.</h4>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="tab_default_3">
                        <?php
                        if ($rejected_units) {
                            $sl_no = 1;
                            foreach ($rejected_units as $unit) {
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
                                        <h4 class="text-left text-danger">Unit is rejected.if you want to resubmit click on the edit button</h4>
                                        <a class="btn btn-warning"  href="<?= base_url(); ?>users/unit/edit/?id=<?= $unit->unit_id; ?>">&nbsp;<i class="fa fa-edit"></i>&nbsp;Edit</a>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <div class="tab-pane" id="tab_default_4">
                        <?php
                        if ($pending_units) {
                            $sl_no = 1;
                            foreach ($pending_units as $unit) {
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
                                        <?php } else { ?>
                                            <h4 class="text-left">Unit information submitted.<br> Verification is in process.</h4>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>   
</div>
<div class="modal fade" id="changepasswordmodal" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Password</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" action="<?= base_url("users/unit/unitchangepassword/"); ?>" method="post">
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" disabled="disabled" id="username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="unit_password" class="col-sm-4 control-label">Enter New Password</label>
                        <div class="col-sm-8">
                            <input type="hidden" id="user_id" name="user_id">                            
                            <input type="password" class="form-control" name="unit_password" id="unit_password">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.change_password').click(function () {
            $('#changepasswordmodal').modal("show");
            $('#username').val($(this).attr("data_name"))
            $('#user_id').val($(this).attr("data_id"));
        });
    });
</script>