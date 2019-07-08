<div class="content-wrapper">
    <section class="content-header">
        <h3 class="welcomeText text-center text-uppercase">EASE OF DOING BUSINESS IN ASSAM</h3><br/>
    </section>
    <section class="content">
        <!-- Form Completion Status -->
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-database"></i>
                            <h3 class="box-title">Users Management</h3>
                            <a href="#"><span class="pull-right">Total Common Application Forms : <?php echo $total_users; ?></span></a>
                        </div>
                        <div class="box-body"></div> 
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-md-6 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/users/unverified/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_unverified_users; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Uverified</h3>
                                    </a>
                                </div>
                                <div class=" col-md-6 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/users/">							
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_verified_users; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Verified</h3>
                                    </a>
                                </div>
                            </div>					
                        </div>
                </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <i class="fa fa-database"></i>
                            <h3 class="box-title">CAF Management</h3>
                            <a href="#"><span class="pull-right">Total Common Application Forms : <?php echo $total_cafs; ?></span></a>
                        </div>
                        <div class="box-body"></div> 
                        <div class="box-footer no-border">
                            <div class="row">


                                <div class="col-md-3 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/caf/unapproved/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_unapproved_cafs; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Unapproved</h3>
                                    </a>
                                </div>
                                <div class=" col-md-3 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/caf/underquery/">							
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_underquery_cafs; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Under Query</h3>
                                    </a>
                                </div>
                                <div class=" col-md-3 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/caf/approvedcaf/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?= $total_approved_cafs; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Approved</h3>
                                    </a>
                                </div>
                                <div class="col-md-3 col-xs-3 text-center">
                                    <a href="<?= base_url(); ?>cms/caf/rejectedcaf/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_rejected_cafs; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">rejected</h3>
                                    </a>
                                </div>
                            </div>					
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-database"></i>
                            <h3 class="box-title">Unit Management</h3>
                            <a href="#"><span class="pull-right">Total Units : <?php echo $totalunit; ?></span></a>
                        </div>
                        <div class="box-body"></div> 
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-md-2 col-md-offset-1 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/unit/unapproved/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_unapproved_units; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Unapproved</h3>
                                    </a>
                                </div>
                                <div class="col-md-2 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/unit/modified/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_modified_units; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Modificitation Request</h3>
                                    </a>
                                </div>
                                <div class=" col-md-2 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/unit/underquery/">							
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_underquery_units; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Under Query</h3>
                                    </a>
                                </div>
                                <div class=" col-md-2 col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url(); ?>cms/unit/approved/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?= $total_approved_units; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Approved</h3>
                                    </a>
                                </div>
                                <div class="col-md-2 col-xs-3 text-center">
                                    <a href="<?= base_url(); ?>cms/unit/rejected/">										
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $total_rejected_units; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">rejected</h3>
                                    </a>
                                </div>
                            </div>					
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-database"></i>
                            <h3 class="box-title">List of Approvals</h3>
                            <a href="<?= base_url("cms/approvals/newapproval"); ?>"><span class="pull-right"><i class="fa fa-plus"></i> <b>Upload New Approvals</b></span></a>
                        </div>
                        <div class="box-body"></div> 
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-xs-6 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url("cms/approvals"); ?>">
                                        <div style="font-size:35px; font-weight: bold">
                                            <?= $total_list_of_approvsls; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Online Approvals</h3>
                                    </a>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <a href="approvals_offline.php">
                                        <div style="font-size:35px; font-weight: bold">

                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Other offline links for approvals</h3>
                                    </a>
                                </div>
                            </div>					
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <i class="fa fa-database"></i>
                            <h3 class="box-title">Notifications / Drafts</h3>
                            <a href="notification.php"><span class="pull-right"><i class="fa fa-plus"></i> <b>Upload New Notification</b></span></a>
                        </div>
                        <div class="box-body"></div> 
                        <div class="box-footer no-border">
                            <div class="row">
                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="<?= base_url("cms/notifications"); ?>">
                                        <div style="font-size:35px; font-weight: bold">
                                            <?php echo $totalnotifications; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Notifications</h3>
                                    </a>
                                </div>
                                <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
                                    <a href="notifications_list.php?ntype=2">
                                        <div style="font-size:35px; font-weight: bold">
                                            <?= $totaldraftnotifications; ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Draft Notifications</h3>
                                    </a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="notifications_list.php">
                                        <div style="font-size:35px; font-weight: bold" data-toggle="tooltip" title="All notifications when validation date is less than or equal to(<=) current date">
                                            <?php
                                            //$todayDate = "Y-m-d";
                                            //echo sprintf("%05d", $mysqli->query("SELECT * FROM post WHERE valid_date <='$todayDate' AND status='1'")->num_rows);
                                            /*
                                              $qry = $mysqli->query("SELECT * FROM post ORDER BY Noti_date ASC");
                                              $tot=0;
                                              while($rows = $qry->fetch_object()) {
                                              $ndate = $rows->Noti_date;
                                              $valid_date = $rows->valid_date;
                                              if($valid_date <= $ndate) $tot++;
                                              }
                                              echo sprintf("%05d",$tot);
                                             * 
                                             */
                                            ?>
                                        </div>
                                        <h3 style="font-size: 16px; font-weight:bold">Archive Draft Notifications</h3>
                                    </a>
                                </div>
                            </div>					
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>