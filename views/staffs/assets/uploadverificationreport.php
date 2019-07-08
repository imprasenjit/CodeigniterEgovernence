<?php
$dept_code = $this->session->staff_dept;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Upload verification reports
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr class="success">
                <th>SN</th>
                <th>Process Date</th>
                <th>Received Date</th>
                <th>UAIN</th>                        
                <th>UNIT NAME</th>                        
                <th>FORM NAME</th>
                <th class="text-center">OPERATION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl=1;
            if($this->applicationreports_model->get_uploadverifyApplications($dept_code)) {
            foreach($this->applicationreports_model->get_uploadverifyApplications($dept_code) as $rows) {
                $frmtbl = $rows["frmtbl"];
                $form_id = $rows["form_id"];
                $user_id = $rows["user_id"];
                $entp_name = "";//$this->unit_model->get_row($user_id)?$this->unit_model->get_row($user_id)->Name:"Not found!";
                $encoded = encodeme($frmtbl."|||".$form_id);
                $uain = $rows["uain"];
                if(is_null($uain) || $uain == "") {
                    $uain = "No UAIN found!";
                } else {
                    $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                }
                $p_date = (is_null($rows["p_date"]) || $rows["p_date"] == "")?"":date("d-m-Y", strtotime($rows["p_date"]));
                $received_date = (is_null($rows["received_date"]) || $rows["received_date"] == "")?"":date("d-m-Y", strtotime($rows["received_date"]));
                ?>
            <tr>
                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                <td><?= $p_date; ?></td>
                <td><?= $received_date; ?></td>
                <td><?= $uain; ?></td>
                <td><?=$entp_name?></td>
                <td><?= sprintf("%05d", $form_id); ?></td>
                <td class="text-center">
                    <a href="<?=base_url('staffs/uploadverificationreport/uploadreport/').$frmtbl."/".$form_id?>" class="btn btn-info" target="_blank">
                        <i class="fa fa-upload"></i> Upload
                    </a>
                    <!--
                    <button class="btn btn-info" data-toggle="modal" data-target="#verificationUploadModal" id="<?=$frmtbl."|||".$form_id?>">
                        <i class="fa fa-upload"></i> Upload
                    </button>
                    -->
                </td>
            </tr>
            <?php $sl++; } } ?>
        </tbody>
    </table>
</div>