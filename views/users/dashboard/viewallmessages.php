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
        <div class="col-md-10 col-md-offset-1">

            <h1>My Inbox</h1>   

            <div class="list-group">
                <?php
                $this->load->helper("query");
                if ($messages) {
                    foreach ($messages as $msg) {
                        ?>
                        <a href="#" class="list-group-item read <?=($msg->query_reply_id!=NULL)?"list-group-item-success":"";?>" data-message-id="<?= $msg->query_id; ?>">
                            <span class="name" style="min-width: 120px;display: inline-block;"><?= $msg->uain; ?></span> 
                            &nbsp;&nbsp;<span class="">(<?= query_subject($msg->subject); ?>)</span>
                            &nbsp;&nbsp; <span class="text-muted" style="font-size: 11px;"><span class="glyphicon glyphicon-envelope"></span> <?=($msg->query_reply_id!=NULL)?"Replied On ".date("D jS \ F Y h:i A", strtotime($msg->reply_date))."":$msg->msg;?></span> 
                            <span class="badge" style="font-size: 16px;"><?= date("D jS \ F Y h:i A", strtotime($msg->q_date)); ?></span> 
                            <!--<span class="pull-right">
                                <span class="glyphicon glyphicon-paperclip"></span>                                
                            </span>-->
                        </a>
                        <?php
                    }
                }
                ?>

            </div>
            <div class="col-md-12"><?php echo $pagination; ?></div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="msgModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Message<span id="uain_info"></span></h4>
            </div>
            <div class="modal-body" >
                
                    <div id="loader-wrapper">
                        <div id="loader"></div>
                    </div>
            
                <div class="" id="msg" style="height:auto;overflow:auto">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Send Message</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
    $(document).ready(function () {

        $('.read').click(function () {
            $('#msgModal').modal("show");
            $('#msg').empty();
            var message_id = parseInt($(this).attr("data-message-id"));
            $.ajax({
                url: "<?= base_url("users/dashboard/getmessage/".$unit_id.""); ?>",
                method: "POST",
                data: {msg_id: message_id},
                dataType: "html",
                beforeSend: function () {
                    $('#loader-wrapper').fadeIn();
                },
                success: function (res) {
                    //console.log("I m here");
                    $('#loader-wrapper').hide();
                    $('#msg').empty().append(res);
                }
            });

        });

    });
</script>

