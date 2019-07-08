<?php
$this->load->helper("query");
if ($query) {
    ?>
    <div class="col-md-12">
        <div class="row"><div class="col-md-2"><strong>From </strong></div><div class="col-md-10">: <?= $query->query_from ?></div></div>  
        <div class="row"><div class="col-md-2"><strong>UAIN </strong></div><div class="col-md-10">: <?= $query->uain ?></div></div>  
        <div class="row"><div class="col-md-2"><strong>Subject </strong></div><div class="col-md-10">: <?= query_subject($query->subject); ?></div></div>  

        <div class="row"><div class="col-md-2"><strong>Date </strong></div><div class="col-md-10">: <?= date("d-m-Y h:i A", strtotime($query->q_date)); ?></div></div>  
        <div class="row"><div class="col-md-2"><strong>Attachment </strong></div><div class="col-md-10">: <?= ($query->document != NULL) ? '<a href="' . $query->document . '" class="">View</a>' : 'No Attachment'; ?></div></div>  
        <div class="row"><div class="col-md-2"><strong>Message </strong></div><div class="col-md-10">: <?= $query->msg ?></div></div>  
        <hr>
        <div class="alert alert-success alert-dismissible" style="display: none" id="success_msg_query">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <span id="info_msg_query"></span>
        </div>
        <div class="alert alert-danger alert-dismissible" style="display: none" id="error_msg_query">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error!</strong> <span id="info_msg_query_error"></span>
        </div>
        <?php ?>
        <form id="query_form">
            <div class="form-group">
                <textarea class="form-control" name="msg" placeholder="Type your reply here"></textarea>
                <input type="hidden" name="query_type" value="<?= $query->subject ?>">
                <input type="hidden" name="query_id" value="<?= $query->query_id ?>">
            </div>

            <?php
            if ($query->subject == "F") {
                $obj = json_decode($query->other_info);
                ?>
                <div class="form-group">
                    <h4>Amount To be paid   <?= $obj->amount; ?></h4> 
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Make Payment</button>
                </div>

                <?php
            } else if ($query->subject == "D") {
                $obj = json_decode($query->other_info);
                $i = 1;
                foreach ($obj->documents as $docs) {
                    ?>
                    <div class="form-group row">
                        <label for="document<?= $i; ?>" class="col-sm-3 control-label"><?= $docs->name; ?>: </label>
                        <div class="col-sm-9">
                            <input type="file" name="document<?= $i; ?>" id="document<?= $i; ?>" data-error="Please upload Address proof.">
                            <span class="filetype_Error"></span>
                        </div> 
                    </div> 
                    <script>
                        $(document).ready(function () {
                            $("#document<?= $i; ?>").pekeUpload({
                                bootstrap: true,
                                url: "<?php echo base_url(); ?>upload/",
                                data: {file: "document<?= $i; ?>"},
                                limit: 1,
                                allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
                            });
                        });

                    </script>
                    <?php
                    $i++;
                }
                ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Submit</button>
                </div>   
            <?php } else { ?>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" name="submit">Submit</button>
                </div> 
            <?php }
            ?>
        </form>
    </div>  
    <script>
        $('#query_form').submit(function (e) {
            e.preventDefault();
            var data = $(this).serializeArray();
            $.ajax({
                url: "<?= base_url("users/dashboard/replyquery/" . $unit_id . ""); ?>",
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
                        $('#query_form').hide();
                        $('#error_msg_query').hide();
                        $('#success_msg_query').fadeIn();
                    } else {
                        $('#success_msg_query').hide();
                        $('#info_msg_query_error').empty().append("</br>"+jsn.info);
                        $('#error_msg_query').fadeIn();
                    }
                }
            });
        });
    </script>
<?php } else { ?>
    <h1>Data Not Found</h1>  
<?php } ?>
