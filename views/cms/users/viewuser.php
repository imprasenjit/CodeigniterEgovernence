<style>
    .list-group-item > div > div{
        font-size: 18px;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="page-header">
                    <h1>View User</h1>
                </div>
                <?php //print_r($user); ?>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">Name</div>
                            <div class="col-md-7"><?= $user->name ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">                        
                        <div class="row">
                            <div class="col-md-5">Email</div>
                            <div class="col-md-7"><?= $user->email ?></div>
                        </div></li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">Mobile</div>
                            <div class="col-md-7"><?= $user->phone ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">User Registration Date</div>
                            <div class="col-md-7"><?= date("d-m-Y h:i A", strtotime($user->registered_on)) ?></div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-md-5">User IP</div>
                            <div class="col-md-7"><?= $user->user_ip ?></div>
                        </div>
                    </li>
                </ul>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#!" class="btn btn-primary" id="email_code">Generate email verification code</a>
                    </div>
                </div>
            </div>
        </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="email_verify_code">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Email Verification Code</h4>
            </div>
            <div class="modal-body">
                <p id="code_link"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        $('#email_code').click(function () {
            $.ajax({
                url: "<?= base_url("cms/users/generatelink/"); ?>",
                method: "post",
                data: {email: "<?= $user->email; ?>"},
                dataType: "html",
                beforeSend: function () {
                    $('#loader-wrapper').fadeIn("slow");
                },
                success: function (html) {
                    $('#code_link').empty().append(html);
                    $('#email_verify_code').modal("show");
                    $('#loader-wrapper').fadeOut("slow");
                }
            });
        });
    });
</script>