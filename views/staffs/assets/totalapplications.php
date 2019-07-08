<?php
$dept_code = $this->session->staff_dept; 
$dept_id = $this->session->staff_dept_id; 
$office_id = $this->session->office_id; 
$apps = $this->applicationreports_model->get_myApplications($dept_code);
?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        All Applications Forms
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr class="success">
                <th class="text-center">Sl. No.</th>
                <th>DATE</th>
                <th>UAIN</th>
                <th>UNIT NAME</th>
                <th>APPLICATION FORM NAME</th>
                
                <th class="text-center">OPERATION</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sl=1;
            if($apps == FALSE){
                echo '<tr class="danger"><td colspan="6" class="text-center">No Records Found !!!</td></tr>';
            }else{
                foreach($apps as $rows) {
                $passValue = $rows["passValue"];
                $encoded = encodeme($passValue);
                $uain = $rows["uain"];
                if(is_null($uain) || $uain == "") {
                    $uain = "No UAIN found!";
                } else {
                    $uain = "<a href='".base_url("staffs/applicationform/index/").$encoded."'>$uain</a>";
                }
                $process_date = $rows["process_date"];
                if(is_null($process_date) || $process_date == "" || $process_date == "0000-00-00 00:00:00") {
                    $process_date = "";
                } else {
                    $process_date = date("d-m-Y h:i A", strtotime($process_date));
                }
                ?>
            <tr>
                <td class="text-center"><?= sprintf("%03d", $sl); ?></td>
                <!--<td class="text-center"><?= sprintf("%05d", $form_id); ?></td>-->
                <td><?= $process_date; ?></td>
                <td><?=$uain;?></td>
                <td><?=strtoupper($rows["unit_name"]);?></td>
                <td><?= $rows["form_name"];?></td>
                
                <td class="text-center">
                    <a class="btn btn-success btn-sm" href="<?= base_url('staffs/applicationform/index/').$encoded; ?>">
                        <i class="fa fa-folder-open"></i> View
                    </a>
                    <a class="btn btn-warning btn-sm" href="<?= base_url('staffs/applicationprocess/index/').$encoded; ?>">
                        <i class="fa fa-hourglass-2"></i> Process
                    </a>
                    <a id="<?=$encoded?>" class="btn btn-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#queryModal">
                        <i class="fa fa-comment"></i> Query
                    </a>
                </td>
            </tr>
            <?php $sl++; } 
            }
            ?>
        </tbody>
    </table>
</div>