<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        Courier receipts
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="cortbl">
        <thead>
            <tr class="success">
                <th class="text-center">SN</th>
                <th>UAIN</th>
                <th>Enterprise Name</th>
                <th>Courier details</th>
                <th>Courier date</th>
                <th class="text-center">Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $courier_applications = $this->applicationreports_model->get_courierApplications($dept_code);
            if($courier_applications) {
                $sl=1;
                foreach($courier_applications as $rows) {
                    $frmtbl = $rows["frmtbl"];
                    $form_id = $rows["form_id"];
                    $unit_id = $rows["unit_id"];
                    $unit_name = $this->cafs_model->get_enterprise_details($unit_id)? $this->cafs_model->get_enterprise_details($unit_id)->unit_name:"Not found!";
                    $encoded = encodeme($frmtbl."|||".$form_id);
                    $uain = $rows["uain"];
                    if(is_null($uain) || $uain == "") {
                        $uain = "No UAIN found!";
                    } else {
                        $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                    }
                    $courier_details = $rows["courier_details"];
                    if(strlen($courier_details) > 1) {
                        $obj = json_decode($courier_details);
                        $cn = (isset($obj->cn) ? $obj->cn : "Not Found!");
                        $rn =  (isset($obj->rn) ? $obj->rn : "Not Found!");
                        $dt =  (isset($obj->dt) ? $obj->dt : "Not Found!");
                    } else {
                        $cn=$rn=$dt = "";
                    }
                    ?>
                <tr>
                    <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                    <td><?=$uain?></td>
                    <td><?=$unit_name?></td>
                    <td><?="Courier Name : <b>".$cn."</b><br /> Reference No. <b>".$rn."</b>"?></td>
                    <td><?=date("d-m-Y",strtotime($dt));?></td>
                    <td class="text-center">
                        <button class="btn btn-warning receive-courier" id="<?=$frmtbl."|||".$form_id?>">
                            <i class="fa fa-inbox"></i> Receive
                        </button>
                    </td>
                </tr>
                <?php 
                $sl++;            
                }            
            } 
            ?>
        </tbody>
    </table>
</div>