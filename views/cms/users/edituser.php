<div class="content-wrapper">
    <section class="content">
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
        <div id="loader-wrapper">
            <div id="loader"></div>
        </div>
        <div class="row">  
            <div class="page-header">
                <h1 align="center">Edit User</h1>
            </div>
            <form id="registrationForm" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <input type="text" name="name" id="name" value="<?= $user->name ?>" class="form-control">
                        <input type="hidden" name="user_id" id="user_id" value="<?= $user->id ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group has-feedback" id="phonecheck">
                    <label for="" class="col-sm-3 control-label">Mobile Number &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <div class="input-group-addon">+91</div>
                            <input type="text" class="form-control required" value="<?= $user->phone ?>" required="required" validate="mobileNumber" maxlength="10" id="phone" name="phone"  data-error="Please enter mobile no."/>
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                        <span  class="help-block">Enter 10 Digit Mobile Number</span>
                    </div>
                </div>


                <div style="margin-top:10px;" class="row">
                    <div class="col-sm-7 col-sm-offset-3 text-center">
                        <a href="#!" class="btn btn-primary btn-block" id="submit">Submit</a>
                    </div>
                </div>
            </form>
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
<script>

    function ValidatePhonenumber()
    {

        var phoneno = /^\d{10}$/;
        if ($("#phone").val().match(phoneno))
        {
            return true;
        } else
        {
            return false;
        }

    }
    $(document).ready(function () {
        $('#phone').keyup(function () {
            if ($("#phone").val() != "" && $("#phone").val().length > 9)
            {
                if (!ValidatePhonenumber())
                {
                    $("#phonecheck").addClass("has-error").removeClass("has-success");
                    $("#phonecheck").find(".help-block").empty().addClass("text-danger").append("Phone number is invalid!Enter 10 Digit Mobile Number.");
                    $("#phonecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });//End of phone blur function

        $('#submit').click(function () {
            var FormData = $('#registrationForm').serializeArray();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>cms/users/action_edituser/',
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
                        $('#registrationFormModal').modal("show");
                        $('#registrationFormModal').on('hidden.bs.modal', function (e) {
                            window.location.href = '';
                        });
                    } else {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append(res.error);
                        $('#registrationFormModal').modal("show");
                    }

                },
                error: function () {}
            }); //End of AJAX call  
        });

    });

</script>