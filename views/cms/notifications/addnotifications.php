<link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datetimepicker.css" />
<div class="content-wrapper">		
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h2>
                    <a href="./" class="btn btn-default">
                        <i class="glyphicon glyphicon-chevron-left" style="font-weight: bold"></i>Back
                    </a>
                    Upload Notification
                </h2>
            </div>
            <div class="box-body">
                <div id="loader-wrapper">
                    <div id="loader"></div>
                </div>
                <form action="#!" id="addnotification">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Please Select a Department <span class="text-danger">*</span></label>
                            <select name="dept" id="dept" class="form-control">
                                <option value="" selected="selected"></option>
                                <?php foreach ($this->getDepartments_model->get() as $depts) { ?>
                                    <option value="<?php echo $depts["id"]; ?>"><?php echo $depts["name"]; ?></option>
                                <?php } // End of foreach ?>

                            </select>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Please Select Sub Department <span class="text-danger">*</span></label>
                            <select name="sub_dept" id="sub_dept" class="form-control">
                                <option value=""> Select Department first</option>
                            </select>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-6 form-group">
                            <br />
                            <label>Please Select Type of Notification <span class="text-danger">*</span></label>

                            <label class="radio-inline">
                                <input type="radio" value="1" name="notification_type" checked="checked">Notification/Office Memo
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="2" name="notification_type" >Draft / Policies
                            </label>

                        </div>

                        <div class="col-md-3 form-group">
                            <label>Notification/Publication Date <span class="text-danger">*</span></label>
                            <input type="text" id="notification_date" name="notification_date" class="form-control" > 
                        </div>
                        <div class="col-md-3 form-group" id="endDate" style="display:none">
                            <label>End Date <span class="text-danger">*</span></label>
                            <input type="text" name="valid_date" id="valid_date" class="form-control dp_forward" />
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class=" col-md-6 form-group">
                            <label>Notification No <span class="text-danger">*</span></label>
                            <input type="text" name="notification_no" value="" class="form-control" />
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Issuing Authority <span class="text-danger">*</span></label>
                            <input type="text" name="issuing_authority" value="" class="form-control" />
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" name="sub" value="" class="form-control" />
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class=" col-md-12 form-group">
                            <label>Brief Description <span class="text-danger">*</span></label>
                            <textarea name="dsc" class="form-control usetinymce" rows="3"></textarea>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row">
                        <div class="col-md-12">
                            <label>Upload File <span class="text-danger">*</span></label>
                            <input type="file" name="notification_file" id="notification_file" />                            
                            <span id="flediv"></span>
                        </div>
                    </div> <!-- End of .row -->

                    <div class="row" style="padding-top:10px">
                        <div class="col-md-12 text-center">
                            <a href="<?= base_url("cms/notifications/"); ?>" class="btn btn-info">
                                <i class="glyphicon glyphicon-eye-open" style="font-weight: bold"></i> View All
                            </a>
                            <a href="#!" class="btn btn-danger" id="reset">
                                <i class="glyphicon glyphicon-repeat" style="font-weight: bold"></i> Reset
                            </a>
                            <a href="#!" class="btn btn-success" id="submit">
                                <i class="glyphicon glyphicon-ok-sign" style="font-weight: bold"></i> Submit
                            </a>
                        </div>
                    </div> <!-- End of .row -->
                </form>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="ApprovalModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalTitle" ></h4>
            </div>
            <div class="modal-body" id="modalContent">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script src="<?= base_url('public/'); ?>js/moment.js"></script>
<script src="<?= base_url('public/'); ?>js/datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#notification_date,#valid_date').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });
</script>
<script src='<?= base_url(); ?>public/js/tinymce.min.js'></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea'
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#notification_file").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "notification_file"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });

        $(".rm").click(function () {
            var nid = $("#nid").val();
            var fle_name = $("#fle").val();
            var ntype = $("input[name='notification_type']:checked").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>",
                data: {nid: nid, ntype: ntype, fle_name: fle_name},
                beforeSend: function () {
                    $("#flediv").html("Deleting File From Server...");
                },
                success: function (data) {
                    $("#flediv").html("File Removed Successfully!.");
                    $("#fle").val("");
                },
                error: function () { }
            });
        });

        $(document).on("change", "#dept", function () {
            var dept = $(this).val();
            $.ajax({
                type: "GET",
                url: "<?= base_url() ?>common/getSubdeptusingparentid/",
                data: {parent_id: dept},
                beforeSend: function () {
                    $("#sub_dept").html("<option value=''>Loading...</option>");
                },
                success: function (data) {
                    $("#sub_dept").html(data);
                }
            });
        });

        $("input[type=radio][name=notification_type]").change(function () {
            var st = $("input[name='notification_type']:checked").val();
            if (st == "2")
                $("#endDate").show();
            else
                $("#endDate").hide();
        });

        $("#reset").click(function () {
            $("#addapproval")[0].reset();
        });

        $("#submit").click(function () {
            tinyMCE.triggerSave();
            console.log("saving notifications data!");
            var data = $('#addnotification').serializeArray();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>cms/notifications/savenotifications/",
                data: data,
                dataType: "json",
                beforeSend: function () {
                    $('#loader-wrapper').fadeIn("slow");
                },
                success: function (res) {
                    $('#loader-wrapper').fadeOut("slow");

                    if (res.x == 1) {
                        $('#ModalTitle').empty().append("Success");
                        $('#modalContent').empty().append(res.info);
                        $('#ApprovalModal').modal("show");
                        $('#ApprovalModal').on('hidden.bs.modal', function (e) {
                            window.location.href = '<?php echo base_url(); ?>cms/notifications/';
                        });
                    } else {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append(res.error);
                        $('#ApprovalModal').modal("show");
                    }

                }
            });
        });
    });
</script>