<?php
$dept_code = $this->session->staff_dept;
$dept_id = $this->subdepartments_model->get_deptbycode($dept_code)->id;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>EODB || Admin Dashboard</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("admin/requires/cssjs"); ?>
        <link href="<?=base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <link href="<?=base_url('public/datatables/Buttons-1.4.2/css/buttons.bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/dataTables.buttons.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.bootstrap.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/JSZip-2.5.0/jszip.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/pdfmake-0.1.32/pdfmake.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/pdfmake-0.1.32/vfs_fonts.js') ?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.html5.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.print.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/datatables/Buttons-1.4.2/js/buttons.colVis.min.js')?>" type="text/javascript"></script>        
        <script type="text/javascript">
            $(document).ready(function () { 
                var table = $("#dtbl").DataTable({
                    buttons: ["excel", "pdf", "print", "colvis"]
                });
                table.buttons().container().appendTo("#dtbl_wrapper .col-sm-6:eq(0)");
            });
        </script>>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("admin/requires/header");
            $this->load->view("admin/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Application Reports for District : <i><?=$district?></i>
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th class="text-center">SN</th>
                                <th>Received Date</th>
                                <th>UAIN</th>
                                <th>Enterprise/Unit Name</th>
                                <th>Application Name</th>
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
                                $current_userid = $rows->current_userid;
                                $frmno = uainexplode($uain, "form_no");
                                $frmtbl = $dept_code."_form".$frmno;
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
                                <td>
                                    <a href="<?=base_url('admin/applicationform/index/'.$uainencoded)?>">
                                        <?=$frmname?>
                                    </a>
                                </td>
                            </tr>
                            <?php $sl++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("admin/requires/footer"); ?>
        </div><!--End of wrapper-->
    </body>
</html>
