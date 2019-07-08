<div class="content-wrapper">
    <section class="content">
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div id="useSlimScroll-1" class="box box-primary">
                    <div class="row">
                        <div  class="col-md-12" id="printcontent" style="width: 100%;">
                            <?php
                            $printContents = $this->load->view("cms/caf/caf_view", "", TRUE);
                            echo $printContents;
                            ?>
                        </div>
                    </div>
                    <br/>
                    <div class="row">
                        <br>
                        <div class="col-md-12 text-center">
                            <input type="button" value="Print" onclick="printcontent()" class="btn btn-info avoid_me" />
                            <?php
                            $unitid = $this->uri->segment(4);
                            $caf = $this->caf_model->getCaf($unitid);
                            ?>
                            <?php if ($caf->who_approved == NULL) { ?>
                                <a href="#!" class="btn btn-success" id="approve">Approve</a>
                                <a href="#!" class="btn btn-warning" data-toggle="modal" data-target="#QueryModal">Query</a>
                            <?php } ?>

                            <a href="<?= base_url(); ?>cms/caf/editcaf/<?= $unitid; ?>" class="btn btn-danger">Edit</a>
                        </div>
                    </div>
                    <br/>
                </div>
            </div>
        </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="registrationFormModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalTitle"></h4>
            </div>
            <div class="modal-body">
                <p id="modalContent"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src='<?= base_url(); ?>public/js/tinymce.min.js'></script>
<script type="text/javascript">
                                tinymce.init({
                                    selector: '#mytextarea'
                                });
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="QueryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalTitle"></h4>
            </div>
            <div class="modal-body">
                <div id="loader-wrapper2" style="display:none">
                    <div id="loader"></div>
                </div>
                <textarea id="mytextarea" style="width:100%;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="query" class="btn btn-warning" >Send Query</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="<?= base_url(); ?>/public/js/jQuery.print.min.js"></script>
<script src="<?= base_url(); ?>/public/js/jquery.slimscroll.min.js"></script>
<script type="text/javascript">

                                //Printing function
                                function printcontent() {
                                    $("#printcontent").print({
                                        globalStyles: false,
                                        mediaPrint: false,
                                        stylesheet: "<?= base_url('public/'); ?>css/AdminLTE.min.css",
                                        iframe: false,
                                        noPrintSelector: ".avoid_me",
                                        //append : printcontent1,
                                        prepend: null
                                    });
                                } //End of printcontent()
                                $(document).ready(function () {
                                    $('#approve').click(function () {
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>cms/caf/approvecaf/',
                                            data: {cafid:<?= $unitid; ?>},
                                            dataType: 'json',
                                            beforeSend: function () {
                                                $('#loader-wrapper').fadeIn("slow");
                                            },
                                            success: function (res) {
                                                $('#loader-wrapper').fadeOut("slow");

                                                if (res.x == 1) {
                                                    $('#ModalTitle').empty().append("Success");
                                                    $('#modalContent').empty().append(res.info);
                                                    $('#registrationFormModal').modal("show");
                                                    $('#registrationFormModal').on('hidden.bs.modal', function (e) {
                                                        window.location.href = '<?php echo base_url(); ?>/cms/caf/unapproved/';
                                                    });
                                                } else {
                                                    $('#ModalTitle').empty().append("Error");
                                                    $('#modalContent').empty().append(res.error);
                                                    $('#registrationFormModal').modal("show");
                                                }

                                            },
                                            error: function () {}
                                        }); //End of AJAX call
                                    }); //End of approve

                                    $('#query').click(function () {
                                        tinyMCE.triggerSave();
                                        var res = $("#mytextarea").val().replace("<p>", "").replace("</p>", "");
                                        var querymsg = res;
                                        $.ajax({
                                            type: 'POST',
                                            url: '<?php echo base_url(); ?>cms/caf/querycaf/',
                                            data: {cafid:<?= $unitid; ?>, query: querymsg},
                                            dataType: 'json',
                                            beforeSend: function () {
                                                $('#loader-wrapper2').fadeIn("slow");
                                            },
                                            success: function (res) {
                                                $('#loader-wrapper2').fadeOut("slow");
                                                $('#QueryModal').modal("hide");
                                                if (res.x == 1) {
                                                    $('#ModalTitle').empty().append("Success");
                                                    $('#modalContent').empty().append(res.info);
                                                    $('#registrationFormModal').modal("show");
                                                    $('#registrationFormModal').on('hidden.bs.modal', function (e) {
                                                        //window.location.href = '<?php echo base_url(); ?>/cms/caf/unapproved/';
                                                    });
                                                } else {
                                                    $('#ModalTitle').empty().append("Error");
                                                    $('#modalContent').empty().append(res.error);
                                                    $('#registrationFormModal').modal("show");
                                                }

                                            },
                                            error: function () {}
                                        }); //End of AJAX call
                                    }); //End of query click function
                                })
                                        ;


</script>