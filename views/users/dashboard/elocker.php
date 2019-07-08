<?php
$this->load->helper("unittype");
?>
<div class="content-wrapper background-white">
    <div class="row">
        <?php
        $unit = $this->unit_model->getunit('unit_id',$this->session->unit_id);
        ?>
        <div class="callout-blue text-center fade-in-b">
            <h4><b><?= $unit->unit_name; ?></b> - <?= get_unittype($unit->unit_type); ?></h4>
            <h4>UBIN : <?= $unit->ubin; ?></h4>
            <h5><?php
                $this->load->helper("address");
                $address = get_address($unit->address);
                echo $address->address . ',';
                echo '' . $address->dist . ',
                ' . $address->state . '-' . $address->pin;
                ?>  </h5>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <nav class="nav-sidebar">
                <ul class="nav tabs" style="margin-top: 20px;">
                    <li class="<?= ($page == "mydocuments") ? "active" : ""; ?>"><a href="<?= base_url("users/dashboard/elocker/" . $unit_id . ""); ?>">My Documents</a></li>
                    <li class="<?= ($page == "formdocuments") ? "active" : ""; ?>"><a href="<?= base_url("users/dashboard/formdocuments/" . $unit_id . ""); ?>">Form Documents</a></li>
                    <li class="<?= ($page == "certificates") ? "active" : ""; ?>"><a href="<?= base_url("users/dashboard/certificates/" . $unit_id . ""); ?>">Certificates</a></li>                               
                    <li><a href="#!" class="" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload"></i>&nbsp;Upload</a></li> 
                </ul>
            </nav>

        </div>
        <div class="col-sm-6">
            <!-- tab content -->
            <div class="tab-content">
                <?php
                if ($page == "mydocuments") {
                    if ($documents) {
                        ?>
                        <div class="tab-pane active text-style" id="tab1">
                            <h2>My Documents</h2>

                            <ul class="list-group">
                                <li class="list-group-item row hidden-xs">
                                    <div class="col-md-3"><h4>Document</h4></div>
                                    <div class="col-md-6s"><h4>Description</h4></div>
                                    <div class="col-md-3"><div>
                                            </li>
                                            <?php
                                            foreach ($documents as $doc) {
                                                ?>
                                                <li class="list-group-item row">
                                                    <div class="col-md-3"><?= $doc->name; ?></div>
                                                    <div class="col-md-6"><?= $doc->description; ?></div>
                                                    <div class="col-md-3"><a href="<?= $doc->file; ?>" class="btn btn-success pull-right">Download</a></div>
                                                </li>
                                            <?php }
                                            ?>

                                            </ul>
                                            <?php echo $pagination; ?>

                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                                <?php
                                if ($page == "formdocuments") {
                                    if ($documents) {
                                        ?>
                                        <div class="tab-pane active text-style" id="tab2">
                                            <h2>Form Documents</h2>

                                            <ul class="list-group">
                                                <li class="list-group-item row hidden-xs">
                                                    <div class="col-md-3"><h4>Document</h4></div>
                                                    <div class="col-md-3"><h4>Description</h4></div>
                                                    <div class="col-md-3"><div>
                                                            </li>
                                                            <?php
                                                            foreach ($documents as $doc) {
                                                                ?>
                                                                <li class="list-group-item row">
                                                                    <div class="col-md-3"><?= $doc->name; ?></div>
                                                                    <div class="col-md-6"><?= $doc->description; ?></div>
                                                                    <div class="col-md-3"><a href="<?= $doc->file; ?>" class="btn btn-success pull-right">Download</a></div>
                                                                </li>
                                                            <?php }
                                                            ?>

                                                            </ul>
                                                            <?php echo $pagination; ?>

                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <?php
                                                if ($page == "certificates") {
                                                    if ($documents) {
                                                        ?>
                                                        <div class="tab-pane active text-style" id="tab3">
                                                            <h2>Certificates</h2>

                                                            <ul class="list-group">
                                                                <li class="list-group-item row hidden-xs">
                                                                    <div class="col-md-3"><h4>Document</h4></div>
                                                                    <div class="col-md-3"><h4>Description</h4></div>
                                                                    <div class="col-md-3"><div>
                                                                            </li>
                                                                            <?php
                                                                            foreach ($documents as $doc) {
                                                                                ?>
                                                                                <li class="list-group-item row">
                                                                                    <div class="col-md-3"><?= $doc->name; ?></div>
                                                                                    <div class="col-md-6"><?= $doc->description; ?></div>
                                                                                    <div class="col-md-3"><a href="<?= $doc->file; ?>" class="btn btn-success pull-right">Download</a></div>
                                                                                </li>
                                                                            <?php }
                                                                            ?>

                                                                            </ul>
                                                                            <?php echo $pagination; ?>

                                                                        </div>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </div>


                                                            </div>
                                                            </div>
                                                            </div>
                                                            <script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
                                                            <div class="modal fade" tabindex="-1" role="dialog" id="upload_modal">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                            <h4 class="modal-title">Upload Mydocuments</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="alert alert-success alert-dismissible" style="display: none" id="success_msg_query">
                                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                                <strong>Success!</strong> <span id="info_msg_query"></span>
                                                                            </div>
                                                                            <div class="alert alert-danger alert-dismissible" style="display: none" id="error_msg_query">
                                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                                <strong>Error!</strong> <span id="info_msg_query_error"></span>
                                                                            </div>
                                                                            <div id="loader-wrapper">
                                                                                <div id="loader"></div>
                                                                            </div>
                                                                            <form id="upload_form" class="form-horizontal">
                                                                                <div class="form-group">
                                                                                    <label for="name" class="col-md-3 control-label">Name</label>  
                                                                                    <div class="col-md-9">
                                                                                        <input type="text" class="form-control" id="name" name="name"/>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label for="description" class="col-md-3 control-label">Description</label>
                                                                                    <div class="col-md-9">
                                                                                        <textarea class="form-control" name="description" id="description" placeholder="Type your reply here"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="document" class="col-sm-3 control-label">Upload File: </label>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="file" name="document" id="document" data-error="Please upload Address proof.">
                                                                                        <span class="filetype_Error"></span>
                                                                                    </div> 
                                                                                </div> 
                                                                            </form>
                                                                            <script>
                                                                                $(document).ready(function () {
                                                                                    $("#document").pekeUpload({
                                                                                        bootstrap: true,
                                                                                        url: "<?= base_url(); ?>upload/",
                                                                                        data: {file: "document"},
                                                                                        limit: 1,
                                                                                        allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                                                                                    });
                                                                                });

                                                                            </script>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="button" class="btn btn-primary" id="upload_mydocuments">Upload</button>
                                                                        </div>
                                                                    </div><!-- /.modal-content -->
                                                                </div><!-- /.modal-dialog -->
                                                            </div><!-- /.modal -->
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $('#upload_mydocuments').click(function () {
                                                                        var data = $('#upload_form').serializeArray();
                                                                        $.ajax({
                                                                            url: "<?= base_url("users/dashboard/upload_mydocuments/" . $unit_id . ""); ?>",
                                                                            method: "POST",
                                                                            data: data,
                                                                            dataType: "json",
                                                                            beforeSend: function () {
                                                                                $('#loader-wrapper').fadeIn();
                                                                            },
                                                                            success: function (jsn) {
                                                                                $('#loader-wrapper').hide();
                                                                                console.log(jsn.success);
                                                                                if (jsn.success === 1) {
                                                                                    $('#info_msg_query').empty().append(jsn.info);
                                                                                    $('#upload_form').hide();
                                                                                    $('#error_msg_query').hide();
                                                                                    $('#success_msg_query').fadeIn();
                                                                                } else {
                                                                                    $('#success_msg_query').hide();
                                                                                    $('#info_msg_query_error').empty().append("</br>" + jsn.info);
                                                                                    $('#error_msg_query').fadeIn();
                                                                                }
                                                                            }
                                                                        });
                                                                    });
                                                                });
                                                            </script>