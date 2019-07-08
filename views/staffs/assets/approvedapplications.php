<?php
$dept_code = $this->session->staff_dept; 
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Approved Application forms
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr class="success">
                <th>UAIN</th>
                <th>Processed Time</th>
                <th class="text-center">Process</th>
                <th class="text-center">Processed by</th>
                <th class="text-center">OPERATION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($this->applicationreports_model->get_approvedApplications($dept_code)) {
            $sl=1;
            foreach($this->applicationreports_model->get_approvedApplications($dept_code) as $rows) {
                $frmtbl = $rows["frmtbl"];
                $form_id = $rows["form_id"];
                $encoded = encodeme($frmtbl."|||".$form_id);
                $uain = $rows["uain"];
                if(is_null($uain) || $uain == "") {
                    $uain = "No UAIN found!";
                } else {
                    $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                }
                $p_date = $rows["p_date"];
                if(is_null($p_date) || $p_date == "") {
                    $p_date = "No date found!";
                } else {
                    $p_date = date("d-m-Y h:i A", strtotime($p_date));
                }
                ?>
            <tr>
                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                <td class="text-center"><?= sprintf("%05d", $form_id); ?></td>
                <td><?= $uain; ?></td>
                <td><?= $p_date; ?></td>
                <td class="text-center">
                    <a class="btn btn-success" href="<?= base_url('staffs/applicationform/index/').$encoded; ?>">
                        <i class="fa fa-folder-open"></i> View
                    </a>
                    <a class="btn btn-warning" href="<?= base_url('staffs/applicationprocess/index/').$encoded; ?>">
                        <i class="fa fa-hourglass-2"></i> Process
                    </a>
                    <a id="<?=$encoded?>" class="btn btn-danger" href="javascript:void(0)"data-toggle="modal" data-target="#queryModal">
                        <i class="fa fa-comment"></i> Query
                    </a>
                </td>
            </tr>
            <?php $sl++; } } else { ?>
            <tr class="bg-danger">
                <td colspan="5" class="text-center text-bold">
                    No records found!
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>