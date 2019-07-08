<?php
$staff_id = $dept_code = $this->session->staff_id;
$dept = $dept_code = $this->session->staff_dept;
$office_id = $this->session->office_id;
$rightsArray = explode(",", $this->session->staff_rights);
?>
<aside class="main-sidebar" style="overflow: auto;">
    <section class="sidebar" style="height: 10px">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-list top60pc1"></i><span>My Applications</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li value="1">
                        <a href="<?= base_url('staffs/myapplications') ?>">
                            <i class="fa fa-list top60pc"></i> My Applications
                        </a>
                    </li>
                    <?php if (in_array("CR", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/courierreceipts') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Courier Receipts</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (in_array("UVR", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/verificationschedule') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Verification Schedule</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (in_array("UVR", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/uploadverificationreport') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Upload Verification Report</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (in_array("C", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/uploadcertificates') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Upload Certificates</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (in_array("Q", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/queriedapplications') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Sent on Query</span>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (in_array("HP", $rightsArray)) { ?>
                        <li class="">
                            <a href="<?= base_url('staffs/hearingcasedetails') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Hearing Case Details</span>
                            </a>
                        </li>
                    <?php } ?>
                    <li><a href="<?= base_url('staffs/appealapplications') ?>"><i class="fa fa-list top60pc"></i> Appeal Against Rejection</a></li>
                    <?php if ($dept == "pcb") { ?>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-link"></i> <span>Annual Reports</span> <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <a href="<?= base_url('staffs/annualreportsnew') ?>">
                                        <i class="fa fa-list top60pc"></i> <span> New Reports</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= base_url('staffs/annualreportsrecorded') ?>">
                                        <i class="fa fa-list top60pc"></i> <span> Recorded Reports</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php
                    if ($dept == "sdc") { ?>
                        <li>
                            <a href="<?= base_url('staffs/annualreportsrecorded') ?>">
                                <i class="fa fa-list top60pc"></i> <span>Retention Applications</span>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list top60pc1"></i><span>Office's Applications</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li>
                        <a href="<?= base_url('staffs/queriedapplications') ?>">
                            <i class="fa fa-list top60pc"></i> Queried Applications
                        </a>
                    </li>
                    <li>
                        <a href="<?= base_url('staffs/underprocessedapplications') ?>">
                            <i class="fa fa-list top60pc"></i> Underprocess Apps
                        </a>
                    </li>	
                    <li>
                        <a href="<?= base_url('staffs/completedapplications') ?>">
                            <i class="fa fa-list top60pc"></i>
                            <span>Completed Applications</span>
                        </a>
                    </li>
                    <!-- <li>                        
                        <a href="<?= base_url('staffs/approvedapplications') ?>">
                            <i class="fa fa-list top60pc"></i> Approved Applications
                        </a>
                    </li>-->
                    <li>
                        <a href="<?= base_url('staffs/rejectedapplications') ?>">
                            <i class="fa fa-list top60pc"></i> Rejected Applications
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="<?= base_url('staffs/publicgrievences') ?>">
                    <i class="fa fa-list top60pc"></i> <span>Public Grievance</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('staffs/cafs') ?>">
                    <i class="fa fa-list top60pc"></i> <span>Common Application Forms</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('staffs/myactivities') ?>">
                    <i class="fa fa-list top60pc"></i> <span>My Activities</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('staffs/payments') ?>">
                    <i class="fa fa-list top60pc"></i> <span>MIS Reports</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('staffs/logreports') ?>">
                    <i class="fa fa-list top60pc"></i> <span>Log Reports</span>
                </a>
            </li>
            <li>
                <a href="<?= base_url('staffs/usermanual') ?>">
                    <i class="fa fa-file top60pc"></i> <span>User Manual</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
<!--
<aside class="main-sidebar" style="overflow: auto;">
    <section class="sidebar" style="height: 10px">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#"><i class="fa fa-list top60pc1"></i><span>Applications</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('staffs/myapplications')?>">My Applications</a></li>
                    <li><a href="<?=base_url('staffs/queriedapplications')?>">Queried Applications</a></li>
                    <li><a href="<?=base_url('staffs/underprocessedapplications')?>">Under process Applications</a></li>					
                    <li><a href="<?=base_url('staffs/approvedapplications')?>">Approved Applications</a></li>
                    <li><a href="<?=base_url('staffs/rejectedapplications')?>">Rejected Applications</a></li>
                    <li><a href="<?=base_url('staffs/appealapplications')?>">Appeal Against Rejection</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-list top60pc1"></i><span>Annual Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="<?=base_url('staffs/annualreportsnew')?>">New Reports</a></li>
                    <li><a href="<?=base_url('staffs/annualreportsrecorded')?>">Recorded Reports</a></li>
                </ul>
            </li>
            <li><a href="<?=base_url('staffs/uploadverificationreport')?>"><i class="fa fa-list top60pc"></i> <span>Upload Verification Report</span></a></li>
            <li><a href="<?=base_url('staffs/uploadcertificates')?>"><i class="fa fa-list top60pc"></i> <span>Upload Certificates</span></a></li>
            <li><a href="<?=base_url('staffs/einspections')?>"><i class="fa fa-list top60pc"></i> <span>E-Inspections</span></a></li>
            <li><a href="<?=base_url('staffs/courierreceipts')?>"><i class="fa fa-list top60pc"></i> <span>Courier Receipts</span></a></li>
            <li><a href="<?=base_url('staffs/publicgrievences')?>"><i class="fa fa-list top60pc"></i> <span>Public Grievance</span></a></li>
            <li><a href="<?=base_url('staffs/cafs')?>"><i class="fa fa-list top60pc"></i> <span>Common Application Forms</span></a></li>
            <li><a href="<?=base_url('staffs/myactivities')?>"><i class="fa fa-list top60pc"></i> <span>My Activities</span></a></li>
            <li><a href="<?=base_url('staffs/misreports')?>"><i class="fa fa-list top60pc"></i> <span>MIS Reports</span></a></li>
            <li><a href="<?=base_url('staffs/logreports')?>"><i class="fa fa-list top60pc"></i> <span>Log Reports</span></a></li>
            <li><a href="<?=base_url('staffs/usermanual')?>"><i class="fa fa-file top60pc"></i> <span>User Manual</span></a></li>
        </ul>
    </section>
</aside>
-->
