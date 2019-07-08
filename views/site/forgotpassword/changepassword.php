<?php $tag = $this->input->get('tag'); ?>
<br><br><br><br><br><br>
<div class="container-fluid">
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row">
        <div  class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Change Password</div>
                <div class="panel-body">
                    <form id="changePasswordForm" class="form-horizontal">
                        <input type="hidden" name="tag" value="<?php echo $tag; ?>" />
                        <div class="form-group has-feedback" id="passwordcheck">
                            <label for="" class="col-sm-4 control-label">Password &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Password must be atleast five characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character." aria-hidden="true"></i>&nbsp;<span class="text-danger">*&nbsp;</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" required="required" maxlength="255" id="password" name="password" data-error="Please enter password."/>
                                <span class="glyphicon form-control-feedback" aria-hidden="true" ></span>
                                <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                <span  class="help-block"> Password must be atleast six characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character.</span>
                            </div>
                        </div>
                        <div class="form-group has-feedback" id="cpasswordcheck">
                            <label for="" class="col-sm-4 control-label">Confirm Password &nbsp;<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Please re-type the password entered above carefully." aria-hidden="true"></i>&nbsp;<span class="text-danger">*&nbsp;</span></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" required="required" maxlength="255"  id="cpassword" name="cpassword" data-error="Please enter confirm password."/>
                                <span class="glyphicon form-control-feedback" aria-hidden="true" ></span>
                                <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                <span  class="help-block"> Please enter password again!</span>
                            </div>
                        </div>
                        <div style="margin-top:10px;" class="row">
                            <div class="col-sm-8 col-sm-offset-4 text-center">
                                <a href="#!" class="btn btn-primary btn-block" id="submit">Submit</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="changePasswordModal">
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
    function ValidatePassword()
    {

        var passw = /^[A-Za-z]\w{5,50}$/;
        if ($('#password').val().match(passw))
        {

            return true;
        } else
        {

            return false;
        }

    }//End of CheckPassword()


    function ValidateConfirmPassword() {
        if ($('#password').val() === $('#cpassword').val())
        {

            return true;
        } else
        {

            return false;
        }

    }
    $(document).ready(function () {
        $('#password').blur(function () {
            if ($('#password').val() != "")
            {
                if (ValidatePassword())
                {
                    $("#passwordcheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#passwordcheck").removeClass("has-error");
                    $("#passwordcheck").find(".help-block").empty().removeClass("text-danger").append("Password must be atleast six characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character.");
                } else
                {
                    $("#passwordcheck").addClass("has-error");
                    $("#passwordcheck").find(".help-block").empty().addClass("text-danger").append("Invalid Password ! Password must be atleast six characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character. ");
                    $("#passwordcheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });//End of password blur function

        $('#cpassword').keyup(function () {
            if ($('#cpassword').val() != "")
            {
                if (ValidateConfirmPassword())
                {
                    $("#cpasswordcheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#cpasswordcheck").removeClass("has-error");
                    $("#cpasswordcheck").find(".help-block").empty().removeClass("text-danger").append("");
                } else
                {
                    $("#cpasswordcheck").addClass("has-error");
                    $("#cpasswordcheck").find(".help-block").empty().addClass("text-danger").append("Password and Confirm password does not match!");
                    $("#cpasswordcheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });


        $('#submit').click(function () {
            var error = 1;
            $('#changePasswordForm input').each(function () {
                if ($(this).val() == "")
                {
                    //alert($(this).attr("name"));
                    $('#ModalTitle').empty().append("Error");
                    $('#modalContent').empty().append($(this).attr("data-error"));
                    $('#changePasswordModal').modal("show");
                    exit;
                }
            });

            if (error == 1)
            {
                var FormData = $('#changePasswordForm').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>site/forgotpassword/storechangedpassword/',
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
                            $('#changePasswordModal').modal("show");
                            $('#changePasswordModal').on('hidden.bs.modal', function (e) {
                                window.location.href = '<?php echo base_url(); ?>';
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#changePasswordModal').modal("show");
                        }

                    },
                    error: function () {}
                }); //End of AJAX call  

            }


        });
    });
</script>