<?php
$dept_code = $this->session->staff_dept;
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        My Activities
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <div class="box-body">
        <table class="table table-bordered table-responsive" id="myactivitiestbl">
        <thead>
            <tr class="success">
                <th>SN</th>
                <th>UAIN</th>
                <th class="text-center">Process</th>
                <th>Processed time</th>
                <th class="text-center">Remarks</th>
                <th class="text-center">Document</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($this->myactivities_model->get_activities($dept_code)) {
            $sl=1;
            foreach($this->myactivities_model->get_activities($dept_code) as $rows) {
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
                $process_type = $rows["process_type"];
                $process_name = get_process($process_type);
                $remark = $rows["remark"];
                $file_path = $rows["file_path"];
                ?>
            <tr>
                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                <td><?= $uain; ?></td>
                <td><?= $process_name; ?></td>
                <td><?= $p_date; ?></td>
                <td><?= $remark; ?></td>
                <td><?= $file_path; ?></td>
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
    </div><!--End of .box-body-->
</div>