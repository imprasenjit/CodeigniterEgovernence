<?php
$dept_code = $this->session->staff_dept;
$staff_id = $this->session->staff_id;
$results = $this->applicationsup_model->get_staffprocessrows($dept_code, $staff_id, "Q");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Queried Applications </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="<?= base_url('public/datatables/'); ?>DataTables-1.10.16/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#appstbl").DataTable();
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
                        All queried applications
                        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
                            <i class="fa fa-chevron-circle-left"></i> Back
                        </a>
                    </h3>
                    <table class="table table-bordered table-responsive" id="appstbl">
                        <thead>
                            <tr class="success">
                                <th>Query Date & Time</th>
                                <th>UAIN</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th class="text-center">OPERATION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sl=1;
                            if($results) {
                            foreach($results as $rows) {
                                $unit_id = $rows->unit_id;
                                $uain = $rows->uain;
                                $uainencoded = encodeme($uain);
                                $queryRow = $this->queriedapplications_model->get_uainrow($uain);
                                if($queryRow) {                                    
                                    $query_from = $queryRow->query_from;
                                    $subject = $queryRow->subject;
                                    $message = $queryRow->msg;
                                    $document = $queryRow->document;
                                    $queried_date = date("d-m-Y h:i A", strtotime($queryRow->q_date));
                                } else {
                                    $subject = "Not found!";
                                    $message = "Not found!";
                                    $queried_date = "Not found!";
                                }
                                ?>
                            <tr>
                                <td><?=$queried_date?></td>
                                <td><a href="<?=base_url('staffs/applicationform/index/'.$uainencoded)?>"><?=$uain?></a></td>
                                <td><?=$subject?></td>
                                <td><?=$message?></td>
                                <td class="text-center">
                                    <a href="<?=base_url('staffs/applicationform/index/'.$uainencoded)?>" class="btn btn-success">
                                        <i class="fa fa-folder-open"></i> View
                                    </a>
                                    <a id="<?=$uain?>" class="btn btn-warning" href="javascript:void(0)" data-toggle="modal" data-target="#queryModal">
                                        <i class="fa fa-comment"></i> Re-sent query
                                    </a>
                                    <a id="<?=$uain?>" href="javascript:void(0)" data-toggle="modal" data-target="#rejectModal" class="btn btn-danger">
                                        <i class="fa fa-comment"></i> Reject
                                    </a>
                                </td>
                            </tr>
                            <?php $sl++; } }?>
                        </tbody>
                    </table>
                </div>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/footer"); ?>
            <?php $this->load->view("staffs/requires/queryModal"); ?>
        </div>
        
        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="box box-success">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Reject Application</h4>
                        </div>
                        <div class="modal-body">
                            <input id="uain" type="hidden" />
                            <div class="form-group">
                                <label for="">Reason(s) for Rejection</label>
                                <div class="checkbox">
                                    <label><input class="reason" value="Incomplete form" type="checkbox">Incomplete form</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="reason" value="Wrong information submitted" type="checkbox">Wrong information submitted</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="reason" value="Payment not done or incomplete" type="checkbox">Payment not done or incomplete</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="reason" value="Query not submitted properly" type="checkbox">Query not submitted properly</label>
                                </div>
                                <div class="checkbox">
                                    <label><input class="reason" value="Any other reason (Please specify)" type="checkbox">Any other reason (Please specify)</label>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Remarks (If Any)</label>
                                <textarea class="form-control" id="remarks" placeholder="Type your message here"></textarea>
                            </div>
                            
                            <div align="center">
                                <button id="rejectbtn" type="button" class="btn btn-danger">
                                    <i class="fa fa-remove"></i>Reject now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--End of .modal-->
        
        <script type="text/javascript">                
            $("#rejectModal").on("show.bs.modal", function (e) {
                $("#uain").val(e.relatedTarget.id);
            });

            $(document).on("click", "#rejectbtn", function () {
                var uain = $("#uain").val();
                var remarks = $("#remarks").val();
                var reasons = [];
                $.each($(".reason:checked"), function () {
                    reasons.push($(this).val());
                });
                reasons = reasons.join(", ");//alert("reasons : "+reasons);
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('staffs/rejectedapplications/reject')?>",
                    data: { 
                        uain: uain,
                        remarks:remarks,
                        reasons: reasons
                    },
                    beforeSend: function () {
                        $(".storelandloader-wrapper").fadeIn("slow");
                    },
                    success: function (res) { //alert(res);
                        $("#rejectModal").modal("hide");
                        $(".storelandloader-wrapper").fadeOut("slow");
                        $.notify(res, {position: "bottom right"});
                        window.setTimeout(function(){ location.reload(true); }, 2000);
                    }
                });//End of ajax()
            });
        </script>
    </body>
</html>