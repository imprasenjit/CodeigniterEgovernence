<?php
$dept_code = $this->session->staff_dept;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Public Grievances
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box-body">
        <div class="col-md-6" style="padding: 0px; padding-right:2px">
            <h3 style="margin:0px;">New Grievances</h3>
            <table class="table table-bordered table-responsive" id="newtbl">
                <thead>
                    <tr class="success">
                        <th>Applicant</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th class="text-center">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->publicgrivances_model->get_rows()) {
                        foreach ($this->publicgrivances_model->get_rows() as $rows) {
                            $gid = $rows->g_id;
                            $user_id = $rows->user_id;
                            $user_name = $this->users_model->get_row($user_id) ? $this->users_model->get_row($user_id)->name : "Not found!";
                            $subject = $rows->subject;
                            $g_date = $rows->g_date;
                            if (is_null($g_date) || $g_date == "") {
                                $gdate = "Not found!";
                            } else {
                                $gdate = date("d/m/Y");
                            }//End of if else
                            ?>
                            <tr>
                                <td><?= $user_name ?></td>
                                <td><?= $subject ?></td>
                                <td><?= $gdate ?></td>
                                <td class="text-center">
                                    <a href="<?=base_url('staffs/publicgrievences/details/').encodeme($gid)?>" class="btn btn-warning">
                                        <i class="fa fa-folder-open-o">View</i>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                No records found!
                            </td>
                        </tr>
                    <?php }//End of if else  ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6" style="padding:0px; padding-left: 2px;">
            <h3 style="margin:0px;">Under Resolution (Replied)</h3>
            <table class="table table-bordered table-responsive" id="restbl">
                <thead>
                    <tr class="success">
                        <th>Applicant</th>
                        <th>Subject</th>
                        <th>Date</th>
                        <th class="text-center">Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->publicgrivances_model->get_urgr()) {
                        foreach ($this->publicgrivances_model->get_urgr() as $rows) {
                            $gid = $rows->g_id;
                            $user_id = $rows->user_id;
                            $user_name = $this->users_model->get_row($user_id) ? $this->users_model->get_row($user_id)->name : "Not found!";
                            $subject = $rows->subject;
                            $g_date = $rows->g_date;
                            if (is_null($g_date) || $g_date == "") {
                                $gdate = "Not found!";
                            } else {
                                $gdate = date("d/m/Y");
                            }//End of if else
                            ?>
                            <tr>
                                <td><?= $user_name ?></td>
                                <td><?= $subject ?></td>
                                <td><?= $gdate ?></td>
                                <td class="text-center">
                                    <a href="<?=base_url('staffs/publicgrievences/details/').$gid?>" class="btn btn-warning">
                                        <i class="fa fa-folder-open-o">View</i>
                                    </a>
                                </td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="4" class="text-center">
                                No records found!
                            </td>
                        </tr>
                    <?php }//End of if else  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>