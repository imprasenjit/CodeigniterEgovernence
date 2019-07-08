<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: Application process </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php 
                
                $rightsArray = explode(",", $this->session->staff_rights);
                $dept_code = $this->session->staff_dept;
                $decoded_id = decodeme($this->uri->segment("4"));
                if (strlen($decoded_id) > 1) {
                    $pcs = explode("|||", $decoded_id);
                    $form_table = $pcs[0];
                    $form_id = $pcs[1];
                }//End of if statement
                if ($this->session->flashdata("flashMsg")) {
                    ?>
                    <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
                <?php } ?>
                <div id="loader-wrapper" class="storelandloader-wrapper">
                    <div id="loader"></div>
                </div>
                <?php //$this->load->view("staffs/assets/applicationprocess"); ?>
                <?php require_once "assets/applicationprocess.php"; ?>
            </div>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div>
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".dp").datepicker({
                    dateFormat: "dd-mm-yy",
                    changeMonth: true,
                    changeYear: true
                });
                
                $("#file1").pekeUpload({
                    bootstrap: true,
                    url: "<?=base_url('upload/')?>",
                    data: {file: "reportfile"},
                    limit: 1,
                    allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                });//End of pekeUpload

                $(document).on("change", "#appoptions", function () {
                    var optn = $(this).val();
                    if (optn === "") {
                        $(this).notify("please select an option");
                        $(this).focus();
                    } else {
                        var tbl = "#table-" + optn;
                        $(".table").css("display", "none");
                        $(tbl).css("display", "block");
                        $(tbl).css("display", "table");
                    }
                });

                $(document).on("click", "#btn-forward", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks").val();
                    var forward_to_office = $("#forward_to_office").val();
                    var forward_to = $("#forward_to").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/forward')?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, fto: forward_to_office, ft: forward_to},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-approve", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_approve").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/approve') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-verify", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_verify").val();
                    var dov = $("#date_of_verification").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/verify') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, dov: dov},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-reject", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_reject").val();
                    var reasons = [];
                    $.each($(".reason:checked"), function () {
                        reasons.push($(this).val());
                    });
                    reasons = reasons.join(", ");
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/reject') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, reasons: reasons},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Application has been successfully rejected!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-issuecer", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var file_auth_num = $("#file_auth_num").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/issuecer') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, file_auth_num: file_auth_num},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Certificate has been successfully issued!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-issuenoc", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/issuenoc') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "NOC has been successfully issued!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-reports", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_report").val();
                    var reportfile = [$(".uplodedfile").val()];
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/reports') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, reportfile:reportfile},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Report has been successfully uploaded!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });//End of on click
            });
        </script>
    </body>
</html>