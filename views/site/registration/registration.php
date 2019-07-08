<br/><br/><br/><br/><br/><br/>
<link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datetimepicker.css" />
<div class="container-fluid">
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <div class="page-header">
                <h1>New user registration<small>&nbsp;single registration for your organization</small></h1>
            </div>
            <p align="center">
                Please fill up the form below to create your account. This will be your single account for managing registrations, licenses and renewals for all units within the same entity.
                If your entity is already registered on the Single Window Clearance System, please Log In here.</font>
            </p>
            <p>
                How to Register as a New User / Entity ? - User Manual  <a href="<?php echo base_url(); ?>manual/Create User ID.pdf" class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i> &nbsp;Download</a></p>
            <hr class="colorgraph">
            <form id="registrationForm" class="form-horizontal">
                <div class="form-group">
                    <label for="name" class="col-sm-3 control-label">Name &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group has-feedback" id="phonecheck">
                    <label for="" class="col-sm-3 control-label">Mobile Number &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <div class="input-group-addon">+91</div>
                            <input type="text" class="form-control required" required="required" validate="mobileNumber" maxlength="10" id="phone" name="phone"  data-error="Please enter mobile no."/>
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                        <span  class="help-block">Enter 10 Digit Mobile Number</span>
                    </div>
                    </div>
                <div class="form-group has-feedback" id="emailid">
                    <label for="" class="col-md-3 control-label text-left">Email&nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-md-7">
                        <div class="input-group">
                            <div class="input-group-addon">@</div>
                            <input type="email" class="form-control" required="required"  maxlength="255" id="email" name="email" data-error="Please enter email."/>
                        </div>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                        <span  class="help-block">Your Email Address e.g you@example.com</span>
                    </div>
                </div>
                <div class="form-group has-feedback" id="passwordcheck">
                    <label for="" class="col-sm-3 control-label">Password &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control required" required="required" maxlength="255" id="password" name="password" data-error="Please enter password."/>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                        <span  class="help-block"> Password must be atleast six characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character.</span>
                    </div>
                </div>
                <div class="form-group has-feedback" id="cpasswordcheck">
                    <label for="" class="col-sm-3 control-label">Confirm Password &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                    <div class="col-sm-7">
                        <input type="password" class="form-control required" required="required" maxlength="255"  id="cpassword" name="cpassword" data-error="Please enter confirm password."/>
                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                        <span  class="help-block"> Please enter password again!</span>
                    </div>
                </div>


                <div class="form-group">
                    <label for="" class="col-sm-3 control-label"><span id="captchaimg"><?php echo $captchaimage; ?></span>&nbsp;<a href="#!" id="refreshCaptcha"><img src="<?php echo base_url(); ?>public/imgs/refresh.png" width="20px" height="20"></a></label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control required" required="required" maxlength="255"  id="captcha" name="captcha" data-error="Please enter Captcha."/>
                        <span  class="help-block"> Please enter captcha!</span>
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

</div>
<br/>
<br/>
<br/>
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
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
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
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#emailid").removeClass("has-error").addClass("has-success");
                    $("#emailid").find(".help-block").empty().removeClass("text-danger").append("Enter your Email Address e.g you@example.com");
                } else {
                    $("#emailid").addClass("has-error").removeClass("has-success");
                    $("#emailid").find(".help-block").empty().addClass("text-danger").append("Email ID  Already exits");
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            },
            error: function () {}
        }); //End of AJAX call
    }
    function checkUsername(uname) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>site/registration/checkusername/',
            data: {uname: uname},
            dataType: 'json',
            beforeSend: function () {
                $("#usernamecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").append("<i class='fa fa-spinner fa-spin'></i>");
            },
            success: function (res) { 	//alert(data);
                if (res.x == 0) {
                    $("#usernamecheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#usernamecheck").removeClass("has-error").addClass("has-success");
                    $("#usernamecheck").find(".help-block").empty().removeClass("text-danger").append("Please provide a username of your choice.Username can not contain any special character and username must be atleast five characters long.");
                } else {
                    $("#usernamecheck").addClass("has-error").removeClass("has-success");
                    $("#usernamecheck").find(".help-block").empty().addClass("text-danger").append("Username Already exits! Please User different username.");
                    $("#usernamecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            },
            error: function () {}
        }); //End of AJAX call       
    }
    function checkMobileNo(phone) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>site/registration/checkmobileno/',
            data: {phone: phone},
            dataType: 'json',
            beforeSend: function () {
                $("#phonecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").append("<i class='fa fa-spinner fa-spin'></i>");
            },
            success: function (res) { 	//alert(data);
                if (res.x == 0) {
                    $("#phonecheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#phonecheck").removeClass("has-error").addClass("has-success");
                    $("#phonecheck").find(".help-block").empty().removeClass("text-danger").append("Enter 10 Digit Mobile Number.");
                } else {
                    $("#phonecheck").addClass("has-error").removeClass("has-success");
                    $("#phonecheck").find(".help-block").empty().addClass("text-danger").append("Mobile number Already exits!.");
                    $("#phonecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            },
            error: function () {}
        }); //End of AJAX call

    }
    function checkPancard(pancard) {
        $.ajax({
            type: 'GET',
            url: '<?php echo base_url(); ?>site/registration/checkpancard/',
            data: {pancard: pancard},
            dataType: 'json',
            beforeSend: function () {
                $("#pan").find(".glyphicon").empty().removeClass("glyphicon-ok").append("<i class='fa fa-spinner fa-spin'></i>");
            },
            success: function (res) { 	//alert(data);
                if (res.x == 0) {
                    $("#pan").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#pan").removeClass("has-error").addClass("has-success");
                    $("#pan").find(".help-block").empty().removeClass("text-danger").append("");
                } else {
                    $("#pan").addClass("has-error").removeClass("has-success");
                    $("#pan").find(".help-block").empty().addClass("text-danger").append("Pan Card Already exits");
                    $("#pan").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                    $('#ModalTitle').empty().append("Error");
                    $('#modalContent').empty().append("This pan card is already registered with us.<br>Name " + res.userID.name + "<br>Email:" + res.userID.email + "<br>Phone:" + res.userID.phone + "<br>If you have forgot your password <a href='<?php echo base_url(); ?>/site/forgotpassword/'>click here</a><br>");
                    $("#registrationFormModal").modal("show");
                }
            },
            error: function () {}
        }); //End of AJAX call

    }
    function isValidCharacter(name) {
        var regExp = /^[a-zA-Z ]*$/
        if (!name.val().match(regExp)) {
            return false;
        } else {
            return true;
        }
    }//End of isValidCharacter()

    function ValidateEmail()
    {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))
        {
            return (true);
        }


        return (false);
    }//End of ValidateEmail()

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

    }//End of ValidatePhonenumber()

    function ValidateUsername() {

        var username = $('#username');
        var regExp = /^[a-zA-Z0-9]*$/
        if (!username.val().match(regExp) || username.val().length < 5) {
            return false;
        } else {
            return true;
        }

    }//End of ValidateUsername()

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

        $(".ispancardavailable").click(function () {
            if ($(this).val() == "No") {
                $('#pan_name_form,#pan').addClass("hidden");
                $('#pancard,#pan_name').removeClass("required");
                $('#file1').attr("data-error", "Upload Pan card declearation.");
                $('#pancardlabel').empty().append("Upload Pan card declearation.");
            } else {
                $('#pan_name_form,#pan').removeClass("hidden");
                $('#pancard,#pan_name').addClass("required");
                $('#pancardlabel').empty().append("Upload Pan card. ");
                $('#file1').attr("data-error", "Upload Pan card.");
            }
        });
        $("#pancard_doc").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "pancard_doc"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });
        $("#authorisation_letter").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "authorisation_letter"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });
        $("#address_proof").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "address_proof"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });
        $("#id_proof").pekeUpload({
            bootstrap: true,
            url: "<?php echo base_url(); ?>upload/",
            data: {file: "id_proof"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });
        $("#typeofenterprise").change(function () {
            var entity = parseInt($(this).val());
            entity == 1 ? $('.conditionforpancard').empty().append("Proprietor") : $('.conditionforpancard').empty().append("Enterprise");
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>site/registration/getentityfields/",
                data: {entity_id: entity},
                beforeSend: function () {},
                success: function (res) {
                    $("#ajax_results").html(res);
                }
            }); //End of ajax()
        });

        $("#entp_state,#app_state").change(function () {
            var entp_state = $(this).val();
            var id_name = $(this).attr("id");
            console.log(id_name);
            if (id_name === "entp_state") {
                $("#entp_dist").empty().append("<option value=''>Loading...</option>");
            } else {
                $("#app_dist").empty().append("<option value=''>Loading...</option>");
            }
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>site/registration/getdistrict/",
                data: {state: entp_state},
                beforeSend: function () {},
                success: function (res) {
                    if (id_name === "entp_state") {
                        $("#entp_dist").empty().append("<option value=''>Select</option>").append(res);
                    } else {
                        $("#app_dist").empty().append("<option value=''>Select</option>").append(res);
                    }
                }
            }); //End of ajax()
        });

        var rows = 1;
        $(document).on("click", ".add_btn", function () {
            if (rows < 10) {
                rows++;
                $("#ajax_results").append('<div class="form-group">       <label for="names" class="col-sm-3 control-label"></label>     <div class="col-sm-7"> <div class="input-group" style="margin:2px 0px"><input type="text"  name="names[]" class="form-control" /><span class="input-group-btn"><button type="button" class="del_btn btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></span></div></div>');
            }
        });

        $(document).on("click", ".del_btn", function () {
            $(this).parent().parent().parent().parent("div").fadeOut("slow").remove();
            rows--;
        });
        $('#refreshCaptcha').on('click', function () {
            $('#captchaimg').empty().append("Loading...");
            $.get('<?php echo base_url() . 'site/registration/refreshcaptcha/'; ?>', function (data) {
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
                    $("#emailid").addClass("has-error").removeClass("has-success");
                    $("#emailid").find(".help-block").empty().addClass("text-danger").append("Email ID  is Invalid!");
                    $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            }
        });

        $('#pancard').blur(function () {
            if ($('#pancard').val() != "") {
                checkPancard($(this).val());
            }
        });
        $('#nameofenterprise').blur(function () {
            if ($('#nameofenterprise').val() != "")
            {
                if (isValidCharacter($(this))) {

                    $("#namecheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#namecheck").removeClass("has-error").addClass("has-success");
                    $("#namecheck").find(".help-block").empty().removeClass("text-danger").append("");
                } else
                {
                    $("#namecheck").removeClass("has-success").addClass("has-error");
                    $("#namecheck").find(".help-block").empty().addClass("text-danger").append("Invalid Name!");
                    $("#namecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });

        $('#name').blur(function () {
            if ($('#name').val() != "")
            {
                if (isValidCharacter($(this))) {

                    $("#nameid").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#nameid").removeClass("has-error").addClass("has-success");
                    $("#nameid").find(".help-block").empty().removeClass("text-danger").append("");
                } else
                {
                    $("#nameid").removeClass("has-success").addClass("has-error");
                    $("#nameid").find(".help-block").empty().addClass("text-danger").append("Invalid Name!");
                    $("#nameid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });

        $('#pan_name').blur(function () {
            if ($('#pan_name').val() != "")
            {
                if (isValidCharacter($(this))) {

                    $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $(this).parent().parent().removeClass("has-error").addClass("has-success");
                    $(this).parent().parent().find(".help-block").empty().removeClass("text-danger").append("");
                } else
                {
                    $(this).parent().parent().removeClass("has-success").addClass("has-error");
                    $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append("Invalid Name!");
                    $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });

        $('#phone').blur(function () {
            if ($("#phone").val() != "")
            {
                if (ValidatePhonenumber())
                {
                    checkMobileNo($(this).val());
                } else
                {
                    $("#phonecheck").addClass("has-error").removeClass("has-success");
                    $("#phonecheck").find(".help-block").empty().addClass("text-danger").append("Phone number is invalid!Enter 10 Digit Mobile Number.");
                    $("#phonecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });//End of phone blur function

        $('#username').blur(function () {
            if ($('#username').val() != "")
            {
                if (ValidateUsername())
                {
                    checkUsername($(this).val());//This function will do ajax call and check if the username already exists
                } else
                {
                    $("#usernamecheck").addClass("has-error").removeClass("has-success");
                    $("#usernamecheck").find(".help-block").empty().addClass("text-danger").append("Invalid username ! Please provide a username of your choice.Username can not contain any special character and username must be atleast five characters long.");
                    $("#usernamecheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });//End of Username Blur function

        $('#password').blur(function () {
            if ($('#password').val() != "")
            {
                if (ValidatePassword())
                {
                    $("#passwordcheck").find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                    $("#passwordcheck").removeClass("has-error").addClass("has-success");
                    $("#passwordcheck").find(".help-block").empty().removeClass("text-danger").append("Password must be atleast six characters long. For stronger security, we advice that password should contains atleast one uppercase letter,one lowercase letter,one numeric and one special character.");
                } else
                {
                    $("#passwordcheck").addClass("has-error").removeClass("has-success");
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
                    $("#cpasswordcheck").removeClass("has-error").addClass("has-success");
                    $("#cpasswordcheck").find(".help-block").empty().removeClass("text-danger").append("");
                } else
                {
                    $("#cpasswordcheck").addClass("has-error").removeClass("has-success");
                    $("#cpasswordcheck").find(".help-block").empty().addClass("text-danger").append("Password and Confirm password does not match!");
                    $("#cpasswordcheck").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");

                }
            }
        });

        $('#submit').click(function () {
            var error = 1;
            $('.required').each(function () {

                if ($(this).val() === "")
                {
                    //alert($(this).attr("name"));
                    $('#ModalTitle').empty().append("Error");
                    $('#modalContent').empty().append($(this).attr("data-error"));
                    $('#registrationFormModal').modal("show");
                    $(this).parent().parent().removeClass("has-success").addClass("has-error");
                    $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append($(this).attr("data-error"));
                    $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                    //$(this).focus();
                    $('html,body').animate({
                        scrollTop: parseInt($(this).offset().top) - 200
                    }, 2500);
                    exit;
                } else {
                    $(this).parent().parent().removeClass("has-error").addClass("has-success");
                    // $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-warning-sign").addClass("glyphicon-ok");
                }
            });

            if (error == 1)
            {
                var FormData = $('#registrationForm').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>site/registration/storeregistration/',
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
                                window.location.href = '<?php echo base_url(); ?>';
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#registrationFormModal').modal("show");
                        }

                    },
                    error: function () {}
                }); //End of AJAX call  

            }


        });
    });

</script>
<script src="<?= base_url('public/'); ?>js/moment.js"></script>
<script src="<?= base_url('public/'); ?>js/datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        $('#dateofcommencement').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    });
</script>