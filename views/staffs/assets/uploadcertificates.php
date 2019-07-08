<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Upload certificates
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="uctbl">
        <thead>
            <tr class="success">
                <th class="text-center">SN</th>
                <th>UAIN</th>
                <th>Form Name</th>
                <th class="text-center">Operation</th>
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
                <td><?= $uain; ?></td>
                <td><?= $p_date; ?></td>
                <td class="text-center">
                    <a id="<?=$frmtbl."|||".$form_id?>" class="btn btn-warning" href="javascript:void(0)" data-toggle="modal" data-target="#uploadcertificateModal">
                        <i class="fa fa-cloud-upload"></i> Upload
                    </a>
                </td>
            </tr>
            <?php $sl++; } } ?>
        </tbody>
    </table>
</div>