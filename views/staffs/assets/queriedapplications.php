<?php
$dept_code = $this->session->staff_dept; 
$apps = $this->applicationreports_model->get_queriedApplications($dept_code);
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        All queried applications
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr class="success">
                <th class="text-center">Sl. No.</th>
                <th>UAIN</th>
                <th>Query Date & Time</th>
                <th>Subject</th>
                <th>Message</th>
                <th class="text-center">OPERATION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl=1;
            if($apps) {
            foreach($apps as $rows) {
                $frmtbl = $rows["frmtbl"];
                $form_id = $rows["form_id"];
                $encoded = encodeme($frmtbl."|||".$form_id);
                $uain = $rows["uain"];
                if(is_null($uain) || $uain == "") {
                    $uain = "No UAIN found!";
                } else {
                    $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                }
                $queried_date = $rows["p_date"];
                if(is_null($queried_date) || $queried_date == "") {
                    $queried_date = "No date found!";
                } else {
                    $queried_date = date("d-m-Y h:i A", strtotime($queried_date));
                }
                $remarks = $rows["remark"];
                $pcs=explode("//",$remarks); //die("Length : ".count($pcs));
                if(count($pcs)<=1){
                    $subject=$remarks;
                    $message="Not found";
                } else {
                    $subject=$pcs[0];
                    $message=$pcs[1];
                }                    
                ?>
            <tr>
                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                <td><?= $uain; ?></td>
                <td><?= $queried_date; ?></td>
                <td><?=$subject?></td>
                <td><?=$message?></td>
                <td class="text-center">
                    <a class="btn btn-success" href="<?= base_url('staffs/applicationform/index/').$encoded; ?>">
                        <i class="fa fa-folder-open"></i> View
                    </a>
                </td>
            </tr>
            <?php $sl++; } }?>
        </tbody>
    </table>
</div>