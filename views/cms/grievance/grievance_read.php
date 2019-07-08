<div class="content-wrapper">		

    <section class="content">
        <div class="box box-primary"> 

            <div class="box-header with-border">

                <h2>Grivance Detail</h2>


            </div>

            <div class="box-body" id="boxbody">   
                <?php
                $this->load->helper("unituser");
                $this->load->helper("department");
                $unituser = get_unit_user($user_id);
                $dept = get_deptName($dept);
                ?>
                <table class="table">
                    <tr><td><strong>Complaint No</strong></td><td><?php echo $complaint_no; ?></td></tr>
                    <tr><td><strong>User</strong></td><td><?php echo ($unituser) ? $unituser->app_name : "" ?></td></tr>
                    <tr><td><strong>Department</strong></td><td><?= $dept["dept_name"]; ?></td></tr>
                    <tr><td><strong>subject</strong></td><td><?php echo $subject; ?></td></tr>
                    <tr><td><strong>message</strong></td><td><?php echo $message; ?></td></tr>
                    <tr><td><strong>document (If any)</strong></td><td><?php echo $document; ?></td></tr>
                    <tr><td><strong>Date</strong></td><td><?php echo $g_date; ?></td></tr>

                    <tr><td></td><td>
                            <a href="<?php echo site_url('cms/grievance') ?>" class="btn btn-default">Close</a>
                            <a href="#!" class="btn btn-warning" id="reply">Reply</a>
                        </td></tr>
                </table>
                <?php
                if($replies){
                foreach ($replies as $reply) {
                    ?>
                    <ul class="chat">
                        <li class="left clearfix"><span class="chat-img pull-left">
                                <img src="http://placehold.it/50/55C1E7/fff&text=<?= ($reply->grievance_reply_from_type == "cms") ? "D" : "O"; ?>" alt="User Avatar" class="img-circle" />
                            </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php if ($reply->grievance_reply_from_type == "cms") echo "Department"; ?></strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>  <?= $reply->grievance_reply_time ?></small>
                                </div>
                                <?= $reply->grievance_reply_msg ?>
                            </div>
                        </li>

                    </ul>
                <?php }
                } 
                ?>
            </div>
        </div>
    </section>        
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="replymodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reply Message</h4>
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
                <form class="form-horizontal" id="reply_form" action="<?= base_url("cms/grievance/reply_action"); ?>">
                    <div class="form-group">                        
                        <div class="col-md-12">
                            <input type="hidden" name="g_id" value="<?= $g_id; ?>">
                            <textarea class="form-control" name="msg" id="msg" cols="3" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a type="button" class="btn btn-primary" id="reply_submit">Submit</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {

        tinymce.init({selector: 'textarea'});
        $('#reply').click(function () {
            $('#replymodal').modal("show");
        });

        $('#reply_submit').click(function () {

            $.ajax({
                url: "<?= base_url("cms/grievance/replygrievance/"); ?>",
                method: "POST",
                data: {g_id:<?= $g_id ?>, msg: tinymce.get('msg').getContent()},
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
                        setTimeout(function () {
                            window.location.href = "<?= base_url("cms/grievance/read/" . $g_id . "/") ?>";
                        }, 3000);
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