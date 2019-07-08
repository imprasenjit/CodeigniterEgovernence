<?php $results = $this->applicationsir_model->get_staffprocessrows($this->dept_code, $this->staff_id, "I"); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Upload Certificates </title>
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
                        Upload Certificates
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th>Process Time</th>
                                <th>UAIN</th>
                                <th>Enterprise/Unit Name</th>
                                <th>Processed by</th>
                                <th>Process</th>
                                <th class="text-center">Certificate</th>
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
                                    $pdt = date("d-m-Y h:i A", strtotime($process_date));
                                } else {
                                    $pdt = "";
                                }
                                $process = $rows->process;
                                $office_id = $rows->office_id;
                                $current_userid = $rows->processed_by;
                                $deptuserRow = $this->deptusers_model->get_row($current_userid, $this->dept_code);
                                if($deptuserRow) {
                                    $staff_name = $deptuserRow->user_name;
                                    $staff_designation = $deptuserRow->udesig; 
                                } else {
                                    $staff_name = $staff_designation = "Not found";                      
                                }
                                ?>
                            <tr>
                                <td><?=$pdt?></td>
                                <td><?=$uain?></td>
                                <td><?=$unit_name?></td> 
                                <td><?=$staff_name?></td>    
                                <td><?=get_process($process)?></td>
                                <td class="text-center">
                                    <a href="<?=base_url('staffs/applicationform/index/'.$uainencoded)?>" class="btn btn-success">
                                        <i class="fa fa-folder-open"></i> Application
                                    </a>
                                    <a href="<?=base_url('staffs/certificates/details/'.$uainencoded)?>" class="btn btn-warning">
                                        <i class="fa fa-book"></i> View
                                    </a>
                                    <a id="<?=$uain?>" data-toggle="modal" data-target="#cuploadModal" class="btn btn-info" href="javascript:void(0)">
                                        <i class="fa fa-cloud-upload"></i> Upload
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
        
        <div class="modal fade" id="cuploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="box box-success">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload Certificate</h4>
                        </div>
                        <div class="modal-body">
                            <input id="uain" type="hidden" />
                            <div class="form-group">
                                <label for="">Upload Certificate</label><br>
                                <input type="file" name="reportfile" id="docfile" />
                            </div>
                            
                            <div class="form-group">
                                <label for="">Remarks (If Any)</label>
                                <textarea class="form-control" id="remarks" placeholder="Type your message here"></textarea>
                            </div>
                            
                            <div align="center">
                                <button id="uploadbtn" type="button" class="btn btn-info">
                                    <i class="fa fa-check"></i>Upload now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--End of .modal-->
        
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $("#docfile").pekeUpload({
                bootstrap: true,
                url: "<?=base_url('upload/')?>",
                data: {file: "reportfile"},
                limit: 1,
                allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
            });//End of pekeUpload
                
            $("#cuploadModal").on("show.bs.modal", function (e) {
                $("#uain").val(e.relatedTarget.id);
            });

            $(document).on("click", "#uploadbtn", function () {
                var uain = $("#uain").val();
                var remarks = $("#remarks").val();
                var reportfile = [$('.uplodedfile').val()]; //alert("reportfile : "+reportfile);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('staffs/uploadcertificates/uploadcertificate') ?>",
                    data: { 
                        uain: uain,
                        remarks:remarks,
                        upload_reportfile: reportfile
                    },
                    beforeSend: function () {
                        $(".storelandloader-wrapper").fadeIn("slow");
                    },
                    success: function (res) { //alert(res);
                        $("#cuploadModal").modal("hide");
                        $(".storelandloader-wrapper").fadeOut("slow");
                        $.notify(res, {position: "bottom right"});
                        window.setTimeout(function(){ location.reload(true); }, 2000);
                    }
                });//End of ajax()
            });
        </script>
    </body>
</html>
