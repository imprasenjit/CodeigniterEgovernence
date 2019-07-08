<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Staff Dashboard :: E-inspections </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?php $this->load->view("staffs/requires/cssjs"); ?>
        <link rel="stylesheet" href="<?=base_url('public/css/loading.css')?>" />
        <link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
        <script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
        <script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#file1").pekeUpload({
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

                $("#inspectionRescheduleModal").on("show.bs.modal", function (e) {
                    var einspection_id = e.relatedTarget.id;
                    $("#einspectionId").val(einspection_id);
                });

                $("#inspectionViewModal").on("show.bs.modal", function (e) {
                    var inspection_id = e.relatedTarget.id; //alert(inspection_id);
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url('staffs/einspections/getInspectionDetails')?>",
                        data: {inspection_id: inspection_id, dept: "pcb"},
                        beforeSend: function () {
                            $("#inspectionViewModalBody").html("<div class='loading'></div>");
                        },
                        success: function (res) { //alert(inspectors);
                            $("#inspectionViewModalBody").html(res);
                        }
                    }); //End of ajax()
                }); // End of .on()

                $("#inspectionUploadModal").on("show.bs.modal", function (e) {
                    var inspection_id = e.relatedTarget.id; //alert(inspection_id);
                    $("#inspectionid").val(inspection_id);
                }); // End of .on()
            });
            
            //Printing function
            function printcontent() {
                $("#printcontent").print({
                    globalStyles : true,
                    mediaPrint : false,
                    stylesheet : "<?=base_url('public/bootstrap-3.3.7/css/bootstrap.min.css')?>",
                    iframe : false,
                    noPrintSelector : ".avoid_me",
                    append : null,
                    prepend : null
                });
            } //End of printcontent()
        </script>
    </head>
    <body class="hold-transition skin-blue fixed" data-target="#scrollspy" data-spy="scroll">
        <div class="wrapper">
            <?php
            $this->load->view("staffs/requires/header");
            $this->load->view("staffs/requires/sidebar");
            ?>
            <div class="content-wrapper">
                <?php $this->load->view("staffs/assets/einspections"); ?>
            </div><!--End of .content-wrapper-->
            <?php $this->load->view("staffs/requires/einspectionsModals"); ?>
            <?php $this->load->view("staffs/requires/footer"); ?>
        </div><!--End of .wrapper-->
    </body>
</html>