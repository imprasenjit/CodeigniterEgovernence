<?php
$dept_id = $this->subdepartments_model->get_deptbycode($this->dept_code)->id;
$staffRow = $this->deptusers_model->get_row($this->staff_id, $this->dept_code);
if($staffRow) {
    $office_id = $staffRow->office_id;
    $results = $this->applicationsir_model->get_officeprocessrows($this->dept_code, $office_id, "R");
} else {
    $results = NULL;
}//End of if else
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Rejected Applications </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable();
            });
        </script>
    </head>
    <?php if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
    <?php } ?>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        My Applications
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th class="text-center">SN</th>
                                <th>Rejected Date</th>
                                <th>UAIN</th>
                                <th>Enterprise/Unit Name</th>
                                <th>Application Name</th>
                                <th class="text-center">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($results) {
                            $sl=1;
                            foreach($results as $rows) {
                                $unit_id = $rows->unit_id;
                                $unit_name = $rows->unit_name;
                                $uain = $rows->uain;
                                $uainencoded = encodeme($uain);
                                $process_date = $rows->process_date;
                                if(strlen($process_date) >= 10) {                                    
                                    $pdt = date("d-m-Y", strtotime($process_date));
                                } else {
                                    $pdt = "";
                                }
                                $processed_by = $rows->processed_by;
                                $process = $rows->process;
                                $office_id = $rows->office_id;
                                $frmno = uainexplode($uain, "form_no");
                                $frmtbl = $this->dept_code."_form".$frmno;
                                $fromRow = $this->forms_model->get_formname($dept_id, $frmno);
                                if($fromRow) {
                                    $frmname = $fromRow->service_name;
                                } else {
                                    $frmname = "Not found";
                                } 
                                ?>
                            <tr>
                                <td class="text-center"><?= sprintf("%05d", $sl); ?></td>
                                <td><?=$pdt?></td>
                                <td><?=$uain?></td>
                                <td><?=$unit_name?></td> 
                                <td style="width:200px"><?=$frmname?></td>                               
                                <td class="text-center">
                                    <a class="btn btn-success" href="<?= base_url('staffs/applicationform/index/').$uainencoded; ?>">
                                        <i class="fa fa-folder-open"></i> View
                                    </a>
                                </td>
                            </tr>
                            <?php $sl++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
    </body>
</html>