<?php 
$dept_code = $this->session->staff_dept; 
$distrows = $this->districts_model->get_rows();
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
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
        </script>
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
                        District reports
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr>
                                <th>Districts</th>
                                <th class="text-center">Total Applications</th>
                                <th class="text-center">Under process</th>
                                <th class="text-center">Approved</th>
                                <th class="text-center">Rejected</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($distrows) {
                                    $totAll=0;
                                    $totunderprocessAll=0;
                                    $totapprovedAll=0;
                                    $totrejectedAll=0;
                                    foreach ($distrows as $drows) {
                                        $dist_id = $drows->dist_id;
                                        $district = $drows->district;
                                        $officeRow = $this->offices_model->get_distrow($dept_code, $district);
                                        $office_id = ($officeRow)?$officeRow->id:0;
                                        
                                        $tot = $this->appsreports_model->tot_officerows($dept_code, $office_id);
                                        $totAll = $totAll + $tot;
                                        
                                        $totunderprocess = $this->appsreports_model->tot_officeprocessrows($dept_code, $office_id, "F");
                                        $totunderprocessAll = $totunderprocessAll + $totunderprocess;
                                        
                                        $totapproved = $this->appsreports_model->tot_officeprocessrows($dept_code, $office_id, "A");
                                        $totapprovedAll = $totapprovedAll + $totapproved;
                                        
                                        $totrejected = $this->appsreports_model->tot_officeprocessrows($dept_code, $office_id, "R");
                                        $totrejectedAll = $totrejectedAll + $totrejected;
                                        ?>
                                            <tr>
                                                <td><?=$district?></td>
                                                <td style="text-align: center">
                                                    <a href="<?=base_url('admin/appsreports/dist/'.encodeme($district).'/')?>"><?=sprintf("%05d", $tot)?></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?=base_url('admin/appsreports/dist/'.encodeme($district).'/F')?>">
                                                        <?=sprintf("%05d", $totunderprocess)?>
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?=base_url('admin/appsreports/dist/'.encodeme($district).'/A')?>"><?=sprintf("%05d", $totapproved)?></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?=base_url('admin/appsreports/dist/'.encodeme($district).'/R')?>"><?=sprintf("%05d", $totrejected)?></a>
                                                </td>
                                            </tr>
                                        <?php
                                    }//End of foreach loop
                                }//End of if statement
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Total : </th>
                                <th class="text-center"><?=sprintf("%05d", $totAll)?></th>
                                <th class="text-center"><?=sprintf("%05d", $totunderprocessAll)?></th>
                                <th class="text-center"><?=sprintf("%05d", $totapprovedAll)?></th>
                                <th class="text-center"><?=sprintf("%05d", $totrejectedAll)?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div><!--End of .box-->
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("admin/requires/footer"); ?>
        </div><!--End of wrapper-->
    </body>
</html>
