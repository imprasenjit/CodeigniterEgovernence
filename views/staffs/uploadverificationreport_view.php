<?php $results = $this->verificationschedule_model->get_rows($this->dept_code, $this->staff_id); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Verification Upload </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="<?=base_url('public/css/loading.css')?>" />
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#dtbl").DataTable();    
                
                $("#docfile").pekeUpload({
                    bootstrap: true,
                    url: "<?=base_url('upload/')?>",
                    data: {file: "reportfile"},
                    limit: 1,
                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                });//End of pekeUpload
                
                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });
            });
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <div class="box box-primary box-alm">
                    <h3 class="boxalm-head">
                        Upload Verification Report
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="dtbl">
                        <thead>
                            <tr class="success">
                                <th>UAIN</th>
                                <th>Enterprise Name</th>
                                <th>Verification Date</th>
                                <th class="text-center">OPERATION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($results) {
                                $frn_nos = array("1","2","3","47","48","49","50");
                                foreach($results as $rows) {
                                    $unit_id = $rows->unit_id;
                                    $uain = $rows->uain;        
                                    $form_table = uainexplode($uain, "form_table");
                                    $form_id = uainexplode($uain, "form_id");
                                    $form_no = uainexplode($uain, "form_no");
                                    $uainencoded = encodeme($uain);
                                    $unit_name = $rows->unit_name;
                                    $process_date = $rows->process_date;
                                    if(strlen($process_date) >= 10) {                                    
                                        $pdt = date("d-m-Y", strtotime($process_date));
                                    } else {
                                        $pdt = "";
                                    }//End of if else
                                    $process = $rows->process;
                                    //die($this->dept_code.", ".$form_table.", ".$form_id); ?>
                                    <tr>
                                        <td><a href="<?=base_url('staffs/applicationform/index/'.$uainencoded)?>"><?=$uain?></a></td>
                                        <td><?=$unit_name?></td>
                                        <td><?=$pdt?></td>
                                        <td class="text-center">
                                            <a href="<?=base_url('staffs/applicationform/index/'.$uainencoded)?>" class="btn btn-success">
                                                <i class="fa fa-folder-open"></i> View
                                            </a>
                                            <?php if($process == "V") { ?>
                                                <?php if ($this->dept_code == "pcb" && in_array($form_no, $frn_nos)) { ?>
                                                    <a class="btn btn-primary" href="<?= base_url('staffs/inspectionreports/index/').$uainencoded ?>" target="_blank">
                                                        <i class="fa fa-cloud-upload"></i> Upload
                                                    </a>
                                                <?php } else { ?>
                                                    <a id="<?=$uain?>" class="btn btn-primary" href="javascript:void(0)"data-toggle="modal" data-target="#vuploadModal">
                                                        <i class="fa fa-cloud-upload"></i> Upload
                                                    </a>
                                                <?php }//End of if else ?>
                                            <?php } else { ?>
                                                <a class="btn btn-warning" href="<?= base_url('staffs/applicationprocess/index/').$uainencoded; ?>">
                                                    <i class="fa fa-hourglass-2"></i> Process
                                                </a>
                                                <a id="<?=$uain?>" class="btn btn-danger" href="javascript:void(0)" data-toggle="modal" data-target="#queryModal">
                                                    <i class="fa fa-comment"></i> Query
                                                </a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }
                            }?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
        <?php $this->load->view("staffs/requires/queryModal"); ?>
        
        <div class="modal fade" id="vuploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="box box-success">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Upload Verification Report</h4>
                        </div>
                        <div class="modal-body">
                            <input id="uain" type="hidden" />
                            <div class="form-group">
                                <label for="">Upload Verification Report</label><br>
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
        
        <script type="text/javascript">
            $("#vuploadModal").on("show.bs.modal", function (e) {
                $("#uain").val(e.relatedTarget.id);
            });

            $(document).on("click", "#uploadbtn", function () {
                var uain = $("#uain").val();
                var remarks = $("#remarks").val();
                var reportfile = [$('.uplodedfile').val()]; //alert("reportfile : "+reportfile);
                $.ajax({
                    type: "POST",
                    url: "<?= base_url('staffs/uploadverificationreport/uploadreport') ?>",
                    data: { 
                        uain: uain,
                        remarks:remarks,
                        upload_reportfile: reportfile
                    },
                    beforeSend: function () {
                        $(".storelandloader-wrapper").fadeIn("slow");
                    },
                    success: function (res) { //alert(res);
                        $("#vuploadModal").modal("hide");
                        $(".storelandloader-wrapper").fadeOut("slow");
                        $.notify(res, {position: "bottom right"});
                        window.setTimeout(function(){ location.reload(true); }, 2000);
                    }
                });//End of ajax()
            });
        </script>
    </body>
</html>
