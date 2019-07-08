<?php
$id = $this->uri->segment(4);
$approval = $this->approvals_model->getApproval($id);
$caregory = array(
    1 => "Pre-Establishment",
    2 => "Pre-Operation",
    3 => "Post Commencement",
    4 => "Returns & Renewals",
    5 => "Other Approvals",
    6 => "Registers",
);

//print_r($approval);die();
?>
<div class="content-wrapper">		
    <section class="content">
        <div class="row">			
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2>
                            <a href="./" class="btn btn-default">
                                <i class="glyphicon glyphicon-chevron-left" style="font-weight: bold"></i>Back
                            </a>
                            Edit Approval
                        </h2>
                    </div>
                    <div class="box-body">
                        <div id="loader-wrapper">
                            <div id="loader"></div>
                        </div>
                        <form action="#!" method="post" id="editapproval">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Please Select a Department <span class="text-danger">*</span></label>
                                    <select name="dept" id="dept" class="form-control">
                                        <?php foreach ($this->getDepartments_model->get() as $depts) { ?>
                                            <option value="<?php echo $depts["id"]; ?>" <?php if ($approval->dept_code == $depts["id"]) echo "selected"; ?>><?php echo $depts["name"]; ?></option>
                                        <?php } // End of foreach ?>
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label>Please Select a Sub Department</label>
                                    <select name="sub_dept" id="sub_dept" class="form-control">
                                        <option value="<?= $approval->sub_dept; ?>" selected="selected"><?= $this->getSubDepartment_model->get_deptbyid($approval->sub_dept)->name; ?></option>
                                    </select>
                                </div>
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Category of Application <span class="text-danger">*</span></label>
                                    <select name="app_cat" class="form-control">
                                        <option value="<?= $approval->application_type ?>" selected="selected"><?= $caregory[$approval->application_type]; ?></option>
                                        <option value="1">Pre-Establishment</option>
                                        <option value="2">Pre-Operation</option>
                                        <option value="3">Post-Commencement</option>
                                        <option value="4">Returns And Renewals</option>
                                        <option value="6">Registers</option>
                                        <option value="5">Other Approvals</option>
                                    </select>
                                </div> 
                                <div class="form-group col-md-6">
                                    <br />
                                    <label>Inspection Required <span class="text-danger">*</span></label><br />

                                    <label class="radio-inline">
                                        <input type="radio" value="1" name="is_inspection" <?php if ($approval->is_inspection == 1) echo 'checked="checked"'; ?>>Yes
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" value="0" name="is_inspection" <?php if ($approval->is_inspection == 0) echo 'checked="checked"'; ?>>No
                                    </label>

                                </div>
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Form No.<span class="text-danger">*</span></label>
                                    <input type="text"  name="form_no" class="form-control" value="<?= $approval->form_no; ?>"/>
                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Name of Service <span class="text-danger">*</span></label>
                                    <input type="text"  name="service_name" class="form-control" value="<?= $approval->service_name; ?>"/>
                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Who should Apply <span class="text-danger">*</span></label>
                                    <textarea name="who_apply" class="form-control usetinymce"><?= $approval->who_should_apply; ?></textarea>
                                </div>
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label>How To Apply <span class="text-danger">*</span></label>
                                    <textarea name="how_apply" class="form-control usetinymce"><?= $approval->how_to_apply; ?></textarea>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Department Approval Procedure <span class="text-danger">*</span></label>
                                    <textarea name="approval_procedure" class="form-control usetinymce"><?= $approval->approval_procedure; ?></textarea>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Upload Procedure<span class="text-danger">*</span></label><br />
                                    <input type="file" name="procedure_file" id="procedure_file" />
                                    <span id="flediv1"></span>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>List Of Documents to be submitted <span class="text-danger">*</span></label>
                                    <textarea name="doc_list" class="form-control usetinymce"><?= $approval->documents_list; ?></textarea>
                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="form-group col-md-12" id="documentlist">
                                    <label>List Of Documents to be submitted<span class="text-danger">*</span></label>   
                                    <?php
                                    $documentslist = json_decode($approval->documentslist, TRUE);
                                    if (isset($documentslist["obj"])) {
                                        foreach ($documentslist["obj"] as $key => $values) {
                                            if ($key == 0) {
                                                echo "<div class='input-group'><input type='text' value='" . $values . "' name='documentslist[]' class='form-control doclist'><span class='input-group-btn'><button type='button' class='add_btn btn btn-info'><span class='glyphicon glyphicon-plus'></span></button></span></div>";
                                            } else {
                                                echo "<div class='input-group' style='margin-top:2px'><input type='text' value='" . $values . "' name='documentslist[]' class='form-control doclist'><span class='input-group-btn'><button type='button' class='del_btn btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></span></div>";
                                            }
                                        }
                                    } else {
                                        ?>
                                        <div class="input-group">
                                            <input placeholder="Document-1" name="documentslist[]" class="form-control doclist" type="text" />
                                            <span class="input-group-btn">
                                                <button type="button" class="add_btn btn btn-info">
                                                    <span class="glyphicon glyphicon-plus"></span></button>                                                            
                                            </span>
                                        </div>
                                    <?php } ?>


                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Timeline for approval <span class="text-danger">*</span></label>
                                    <textarea name="approval_timeline" class="form-control usetinymce"><?= $approval->approval_time; ?></textarea>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Payment Required <span class="text-danger">*</span></label>
                                    <label class="radio-inline"><input type="radio" name="payment_required" value="0" <?php if ($approval->payment_required == 0) echo 'checked="checked"'; ?>>No</label>
                                    <label class="radio-inline"><input type="radio" name="payment_required" value="1" <?php if ($approval->payment_required == 1) echo 'checked="checked"'; ?>>Yes</label>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Fees & Payments <span class="text-danger">*</span></label>
                                    <textarea name="fee" class="form-control usetinymce"><?= $approval->fees_payment; ?></textarea>
                                </div> 
                            </div> <!-- End of .row -->
                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Select payment code <span class="text-danger">*</span></label>
                                    <select name="paycode" id="paycode" class="form-control">
                                        <?php foreach ($this->common_model->getpaymentcodes() as $codes) { ?>
                                            <option value="<?php echo $codes->ID; ?>" <?php if ($codes->ID == $approval->paycode) echo 'selected="selected"'; ?>>
                                                <?php echo $codes->Department; ?> ||
                                                <?php echo $codes->Description; ?> || Major Head :
                                                <?php echo $codes->Major_Head; ?> || Minor Head :
                                                <?php echo $codes->Minor_Head; ?> || 
                                            </option>
                                        <?php } // End of foreach ?>
                                    </select>
                                </div> 
                            </div>

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Sample Form <span class="text-danger">*</span></label><br />
                                    <input type="file" name="form_file" id="form_file" />
                                    <span id="flediv2"><?php echo $approval->sample_form; ?></span>
                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Apply Online Link <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" name="apply_link" value="<?= $approval->apply_online; ?>"/>
                                </div>  
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Short Name of Service <span class="text-danger">*</span></label>
                                    <input type="text"  class="form-control" name="short_service_name" value="<?= $approval->sample_name; ?>"/>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">								
                                <div class="form-group col-md-12">
                                    <label>Timeline in days <span class="text-danger">*</span></label><br />
                                    <input type="text"  class="form-control" name="timeline" id="timeline" value="<?= $approval->timeline; ?>" maxlength="5" style="width: 50%; display: inline-block" />
                                    <span id="errmsg" class="error text-danger"></span>
                                </div> 
                            </div> <!-- End of .row -->

                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="<?= base_url("cms/approvals/newapproval/") ?>" class="btn btn-info">
                                        <i class="glyphicon glyphicon-eye-open" style="font-weight: bold"></i> View All
                                    </a>
                                    <a herf="#!" type="reset" class="btn btn-danger" id="reset">
                                        <i class="glyphicon glyphicon-repeat" style="font-weight: bold"></i> Reset
                                    </a>
                                    <a herf="#!" class="btn btn-success" id="submit">
                                        <i class="glyphicon glyphicon-ok-sign" style="font-weight: bold"></i> Submit
                                    </a>
                                </div>
                            </div> <!-- End of .row -->
                        </form>
                    </div>
                </div>
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
<script src='<?= base_url(); ?>public/js/tinymce.min.js'></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea'
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#reset").click(function () {
            //$("#addapproval")[0].reset();
        });
        $("#procedure_file").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "procedure_file"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });
        $("#form_file").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "form_file"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
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

        $("#submit").click(function () {
            tinyMCE.triggerSave();
            console.log("editing approval data!");
            var data = $('#editapproval').serializeArray();
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>cms/approvals/updateapproval/" +<?= $id; ?> + "",
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

                        });
                    } else {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append(res.error);
                        $('#ApprovalModal').modal("show");
                    }

                }
            });
        });

        var rows = 1;
        $(document).on("click", ".add_btn", function () {
            if (rows < 20) {
                rows++;
                $("#documentlist").append("<div class='input-group' style='margin:2px 0px'><input type='text' placeholder='Document-" + rows + "' name='documentslist[]' class='form-control' /><span class='input-group-btn'><button type='button' class='del_btn btn btn-danger'><span class='glyphicon glyphicon-remove'></span></button></span></div>");
            }
        });

        $(document).on("click", ".del_btn", function () {
            $(this).parent().parent("div").remove();
            rows--;
        });
    });
</script>
