<div class="modal fade" tabindex="-1" role="dialog" id="myModal5">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Documents</h4>
            </div>
            <div class="modal-body">
                <div id="loader-wrapper" class="storedocumentsloader-wrapper">
                    <div id="loader"></div>
                </div>
                <form id="form5"  class="form-horizontal">
                    <div class="form-group">
                        <label for="file1" class="col-sm-6 control-label">Proof of Address of the Unit (Occupancy Certificate / Property Tax Payment Receipt / Rent Agreement / Lease Agreement etc.)
                            : </label>
                        <div class="col-sm-6">
                            <input type="file" name="proof_of_address_of_unit" class="requiredinput" id="file1" data-error="Please upload proof of Address of the Unit.">
                            <span class="filetype_Error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file1" class="col-sm-6 control-label">Applicant ID Proof : </label>
                        <div class="col-sm-6">
                            <input type="file" name="applicant_id_proof" id="file2" class="requiredinput" data-error="Please upload Applicant ID Proof.">
                            <span class="filetype_Error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file1" class="col-sm-6 control-label">Applicant Address Proof : </label>
                        <div class="col-sm-6">
                            <input type="file" name="applicant_address_proof" id="file3" class="requiredinput" data-error="Please upload Applicant Address Proof.">
                            <span class="filetype_Error"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file1" class="col-sm-6 control-label">GST Registration : </label>
                        <div class="col-sm-6">
                            <input type="file" name="gst_registration" id="file4" class="requiredinput" data-error="Please upload GST Registration .">
                            <span class="filetype_Error"></span>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitdocuments">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
    function getunitdocuments() {
        $('.unitloader').fadeIn("slow");
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>cms/unit/getunitdocuments/",
            dataType: "html",
            beforeSend: function () {},
            success: function (res) {
                $('.unitloader').fadeOut("slow");
                $('#documentsview').empty().append(res);
            }
        });
    }
    $("#file1").pekeUpload({
        bootstrap: true,
        url: "<?php echo base_url(); ?>upload/",
        data: {file: "proof_of_address_of_unit"},
        limit: 1,
        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
    });
    $("#file2").pekeUpload({
        bootstrap: true,
        url: "<?php echo base_url(); ?>upload/",
        data: {file: "applicant_id_proof"},
        limit: 1,
        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
    });
    $("#file3").pekeUpload({
        bootstrap: true,
        url: "<?php echo base_url(); ?>upload/",
        data: {file: "applicant_address_proof"},
        limit: 1,
        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
    });
    $("#file4").pekeUpload({
        bootstrap: true,
        url: "<?php echo base_url(); ?>upload/",
        data: {file: "gst_registration"},
        limit: 1,
        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
    });
   $(document).ready(function(){
       getunitdocuments();
    $("#submitdocuments").click(function () {
        $('#form5 .requiredinput').each(function () {
            if ($(this).val() == "")
            {
                $('#ModalTitle').empty().append("Error");
                $('#modalContent').empty().append($(this).attr("data-error"));
                $('#UnitModal').modal("show");
                $(this).parent().parent().removeClass("has-success").addClass("has-error");
                $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append($(this).attr("data-error"));
                $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                //$(this).focus();
                $('html,body').animate({
                    scrollTop: parseInt($(this).offset().top) - 200
                }, 2000);
                exit();
            } else
            {
                $(this).parent().parent().addClass("has-success").removeClass("has-error");
            }
        });
        var data = $("#form5").serializeArray();
        $(".storedocumentsloader-wrapper").fadeIn("slow");
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>cms/unit/storedocuments/",
            data: data,
            dataType: "json",
            beforeSend: function () {},
            success: function (res) {
                $('.storedocumentsloader-wrapper').fadeOut("slow");
                //alert(data);
                if (res.success == 1) {
                    $('#ModalTitle').empty().append("Success");
                    $('#modalContent').empty().append(res.info);

                    $('#myModal1').modal("hide");
                    $('#UnitModal').modal("show");

                    $('#UnitModal').on('hidden.bs.modal', function (e) {
                        getunitdocuments();
                    });

                } else {
                    $('#ModalTitle').empty().append("Error");
                    $('#modalContent').empty().append(res.error);
                    $('#UnitModal').modal("show");
                }
            }
        }); //End of ajax()
    });//End of unit submit
    });//End of document.ready
</script>