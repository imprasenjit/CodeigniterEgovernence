<?php
$dept_code = $this->uri->segment(4); //die("dept_code : ".$dept_code); 
$distrows = $this->districts_model->get_rows();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CM Dashboard :: Application Reports</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("cm/requires/cssjs"); ?>
        <link href="<?= base_url('public/datatables/DataTables-1.10.16/css/dataTables.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url('public/datatables/Buttons-1.4.2/css/buttons.bootstrap.min.css') ?>" rel="stylesheet" type="text/css" />
        <script src="<?= base_url('public/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/DataTables-1.10.16/js/dataTables.bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/Buttons-1.4.2/js/dataTables.buttons.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/Buttons-1.4.2/js/buttons.bootstrap.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/JSZip-2.5.0/jszip.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/pdfmake-0.1.32/pdfmake.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/pdfmake-0.1.32/vfs_fonts.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/Buttons-1.4.2/js/buttons.html5.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/Buttons-1.4.2/js/buttons.print.min.js') ?>" type="text/javascript"></script>
        <script src="<?= base_url('public/datatables/Buttons-1.4.2/js/buttons.colVis.min.js') ?>" type="text/javascript"></script>        
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
            if ($this->session->flashdata("flashMsg")) { ?>
                <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
            <?php }
            $this->load->view("cm/requires/header");
            $this->load->view("cm/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <section class="content-header" style="padding-top: 2px">
                    <div class="box box-primary" style="margin-bottom: 0px">
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="text-center text-uppercase"> Application Reports</h3>
                            </div>
                        </div>
                    </div>
                </section>
                
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
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
                                        $totAll = 0;
                                        $totunderprocessAll = 0;
                                        $totapprovedAll = 0;
                                        $totrejectedAll = 0;
                                        foreach ($distrows as $drows) {
                                            $dist_id = $drows->dist_id;
                                            $district = $drows->district;
                                            $officeRow = $this->offices_model->get_distrow($dept_code, $district);
                                            $office_id = ($officeRow) ? $officeRow->id : 0;

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
                                                <td><?= $district ?></td>
                                                <td style="text-align: center">
                                                    <a href="<?= base_url('cms/appsreports/dist/' . encodeme($district) . '/') ?>"><?= sprintf("%05d", $tot) ?></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?= base_url('cms/appsreports/dist/' . encodeme($district) . '/F') ?>">
                                                        <?= sprintf("%05d", $totunderprocess) ?>
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?= base_url('cms/appsreports/dist/' . encodeme($district) . '/A') ?>"><?= sprintf("%05d", $totapproved) ?></a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="<?= base_url('cms/appsreports/dist/' . encodeme($district) . '/R') ?>"><?= sprintf("%05d", $totrejected) ?></a>
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
                                        <th class="text-center"><?= sprintf("%05d", $totAll) ?></th>
                                        <th class="text-center"><?= sprintf("%05d", $totunderprocessAll) ?></th>
                                        <th class="text-center"><?= sprintf("%05d", $totapprovedAll) ?></th>
                                        <th class="text-center"><?= sprintf("%05d", $totrejectedAll) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div><!--End of .col-md-12 -->
                    </div><!--End of .row -->
                </section>
            </div>
            <?php $this->load->view("cm/requires/footer"); ?>
        </div>
    </body>
</html>