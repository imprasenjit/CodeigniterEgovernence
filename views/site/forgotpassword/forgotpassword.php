<br/><br/><br/><br/><br/><br/>
<div class="container">
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box-header with-border">
                <h2 class="box-title"></h2>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Forgot Password</div>
                        <div class="panel-body">
                            <p>Enter Your Registered email Address. A Password reset link will be sent to your email id.click on that link and reset your password.</p>	
                            <form id="forgotpasswordForm" class="form-horizontal">
                                <div class="form-group has-feedback" id="emailid">
                                    <label for="" class="col-sm-5 control-label">Email address &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Please provide a valid email address which will be used for future communications with you." aria-hidden="true"></i>&nbsp;<span class="text-danger">*&nbsp;</span></label>
                                    <div class="col-sm-7">
                                        <div class="input-group">

                                            <div class="input-group-addon">@</div>
                                            <input type="email" class="form-control" required="required"  maxlength="255" id="email" name="email" data-error="Please enter email."/>
                                        </div>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                        <span  class="help-block">Enter Your Registered email Address</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-5 control-label" ><span id="captchaimg"><?php echo $captchaimage; ?></span> &nbsp;<a href="#!" id="refreshCaptcha"><img src="<?php echo base_url(); ?>public/imgs/refresh.png" width="20px" height="20"></a></label>
                                    <div class="col-sm-7">

                                        <input type="text" class="form-control" required="required"  maxlength="255" id="captcha" name="captcha" data-error="Please enter Captcha."/>


                                        <span  class="help-block">Enter captcha here.</span>
                                    </div>
                                </div>
                            </form>
                            <div style="margin-top:10px;" class="row">
                                <div class="col-sm-7 col-sm-offset-5 text-center">
                                    <a href="#!" class="btn btn-primary btn-block" id="submit">Submit</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="forgotFormModal">
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
<script>
    function checkEmail(email) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>site/registration/checkemail/',
            data: {email: email},
            dataType: 'json',
            beforeSend: function () {
                $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").append("<i class='fa fa-spinner fa-spin'></i>");
            },
            success: function (res) { 	//alert(data);
                if (res.x == 0) {
                    $("#emailid").addClass("has-error");
                    $("#emailid").find(".help-block").empty().addClass("text-danger").append("No account exists with this email");
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                } else {
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#emailid").removeClass("has-error");
                    $("#emailid").find(".help-block").empty().removeClass("text-danger").append("");
                }
            },
            error: function () {}
        }); //End of AJAX call
    }

    function ValidateEmail()
    {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))
        {
            return (true);
        }


        return (false);
    }//End of ValidateEmail()

    $(document).ready(function () {
        $('#refreshCaptcha').on('click', function () {
            $('#captchaimg').empty().append("Loading...");
            $.get('<?php echo base_url() . 'site/forgotpassword/refreshcaptcha/'; ?>', function (data) {
                $('#captchaimg').empty().append(data);
            });
        });
        $('#email').blur(function () {
            if ($("#email").val() != "")
            {
                if (ValidateEmail())
                {
                    checkEmail($(this).val());
                } else {
                    $("#emailid").addClass("has-error");
                    $("#emailid").find(".help-block").empty().addClass("text-danger").append("Email ID  is Invalid!");
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            }
        });

        $('#submit').click(function () {
            var error = 1;
            $('#forgotpasswordForm input').each(function () {
                if ($(this).val() == "")
                {
                    //alert($(this).attr("name"));
                    $('#ModalTitle').empty().append("Error");
                    $('#modalContent').empty().append($(this).attr("data-error"));
                    $('#registrationFormModal').modal("show");
                    exit;
                }
            });

            if (error == 1)
            {
                var FormData = $('#forgotpasswordForm').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>site/forgotpassword/sendresetpasswordlink/',
                    data: FormData,
                    dataType: 'json',
                    beforeSend: function () {
                        $('#loader-wrapper').fadeIn("slow");
                    },
                    success: function (res) {
                        $('#loader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.x == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);
                            $('#forgotFormModal').modal("show");
                            $('#forgotFormModal').on('hidden.bs.modal', function (e) {
                                window.location.href = '<?php echo base_url(); ?>';
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#forgotFormModal').modal("show");
                        }

                    },
                    error: function () {}
                }); //End of AJAX call  

            }


        });
    });

</script>

