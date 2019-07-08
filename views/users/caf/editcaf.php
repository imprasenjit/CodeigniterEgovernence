<?php
$this->load->helper("caf");
$caf_find=get_caf($this->session->user_id);
$caf_id = $caf_find->caf_id;
$caf =get_caf_info($caf_id);
$this->load->helper("address");
$address = get_address($caf->address);
$user_address = get_address($caf->app_address);
$this->load->helper("entity");
$this->load->helper("address");
$entity = getAllEntity($caf->entity_id);
?>
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
                            <link rel="stylesheet" type="text/css" href="<?= base_url('public/'); ?>css/datetimepicker.css" />
                            <h2 align="center">EDIT COMMON APPLICATION FORM</h2>
                            <form id="registrationForm" class="form-horizontal">
                                <input type="hidden" name="user_id" value="<?= $caf->user_id; ?>"/>
                                <div class="form-group has-feedback" id="namecheck">
                                    <label for="nameofenterprise" class="col-sm-3 control-label">Name of Enterprise <font class="mandatory_field">*</font> : </label>
                                    <div class="col-sm-7">
                                        <input type="hidden" name="entpid" value="<?= $caf_id; ?>">
                                        <input type="text" class="form-control" value="<?= $caf->entp_name; ?>" id="nameofenterprise" name="nameofenterprise" data-error="Please enter name of enterprise." >
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                        <span class="help-block"></span>  
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="col-sm-3 control-label">
                                        Date of Incorporation *
                                    </label>
                                    <div class="col-sm-7">
                                        <input type="text" id="dateofcommencement" value="<?= date("d-m-Y", strtotime($caf->date_of_commencement)) ?>" name="dateofcommencement" class="form-control" data-error="please select date of commencement" > 
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                        <span class="help-block"></span>  
                                    </div>
                                </div>
                                <div class="form-group" id="topcheck">
                                    <label for="typeofenterprise" class="col-sm-3 control-label">Select Legal Entity of the business <font class="mandatory_field">*</font> : </label>
                                    <div class="col-sm-7">
                                        <select class="form-control" id="typeofenterprise" name="typeofenterprise" data-error="Please select Legal Entity of the business">
                                            <option value="">Select</option>

                                            <?php foreach (getAllEntity() as $row) { ?>
                                                <option value="<?php echo $row['entity_id']; ?>" <?php if ($caf->entity_id == $row['entity_id']) echo "selected"; ?> ><?php echo $row['entity_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <span id="entity_details">
                                    <?php
                                    getEntityWithFields($caf->entity_id, $caf->owner_names, $caf->cin_llpin);
                                    ?>
                                </span>
                                <div id="ajax_results"></div>
                                <hr>

                                <div class="form-group">
                                    <label class="col-sm-3 text-left control-label" for="ispancardavailable" >
                                        Do you have PAN card?
                                    </label> 
                                    <div class="col-sm-2">
                                        &nbsp;&nbsp;&nbsp; <input type="radio" name="ispancardavailable" class="ispancardavailable" value="No">No&nbsp;&nbsp;&nbsp;
                                        <input type="radio" name="ispancardavailable" class="ispancardavailable" value="Yes" <?= ($caf->pan != "") ? "checked" : ""; ?>>Yes
                                    </div>
                                </div>
                                <div class="form-group has-feedback" id="pan">
                                    <label class="col-sm-3 control-label"for="pancard" >
                                        Income Tax Permanent Account Number (PAN) of <span class="conditionforpancard"></span><font class="mandatory_field">*</font> :
                                    </label>
                                    <div class="col-sm-3" id="pan_input">    
                                        <input rel="tooltip" data-toggle="tooltip" value="<?= $caf->pan; ?>" title="The Permanent Account Number (PAN) of the Proprietor / Company / Firm / Organization is already registered with us, you cannot re-register with the same PAN. <a href='<?= base_url("site/login"); ?>'>Click Here</a> to Log in to your account or if you have forgotten your password, <a href='<?= base_url("site/login"); ?>'>Click Here</a> to Reset your Password." type="text" class="form-control" maxlength="10" id="pancard" name="pancard" data-error="Please enter pan card no."/>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                        <span class="help-block"></span>  
                                    </div>
                                </div>

                                <div class="form-group has-feedback" id="pan_name_form" >
                                    <label class="col-sm-3 control-label">
                                        Name of <span class="conditionforpancard"></span> as per PAN<font class="mandatory_field">*</font> :
                                    </label>
                                    <div class="col-sm-3 col-sm-12" id="pan_name_input">
                                        <input type="text" class="form-control" value="<?= $caf->pan_name; ?>" name="pan_name" id="pan_name" value="" placeholder="Name on PAN" data-error="Please enter name as per PAN"/>
                                        <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                        <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                        <span class="help-block"></span> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pancard_doc" class="col-sm-3 control-label" id="pancardlabel">Upload Pancard: </label>
                                    <div class="col-sm-3">
                                        <input type="file" name="pancard_doc" id="pancard_doc" data-error="Please upload pancard.">
                                        <span class="filetype_Error"></span>
                                        <input type="hidden" name="pancard_document" value="<?= $caf->pan_card; ?>">
                                        <?php if (!empty($caf->pan_card)) { ?>
                                            <a href="<?= $caf->pan_card; ?>" target="_blank">View</a>
                                        <?php } ?>
                                    </div>

                                </div>
                                <hr>
                                <div class="form-group">
                                    <label class="col-md-12 control-label" >
                                        <input type="hidden" name="addressid" value="<?= $caf->address; ?>">
                                        <h4 align="left"> Location of the Enterprise/Registered Office</h4>

                                    </label>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <div class="col-md-6 form-group has-feedback">
                                            <label class="col-md-6 control-label">
                                                Address <font class="mandatory_field">*</font> :
                                            </label>
                                            <div class="col-md-6 ">
                                                <textarea class="form-control" name="entp_address" id="entp_address" data-error="Please enter Address" placeholder="" ><?= $address->address; ?></textarea>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                                <span class="help-block"></span> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group has-feedback">
                                            <label class="col-md-6 control-label">
                                                State <font class="mandatory_field">*</font> :
                                            </label>
                                            <div class="col-md-6 ">
                                                <select class="form-control" name="entp_state" id="entp_state" data-error="Please select state." >
                                                    <option value=""></option>
                                                    <?php foreach (getAllStates() as $row) { ?>
                                                        <option value="<?php echo $row->state; ?>" <?php if ($row->state == $address->state) echo "selected"; ?>><?php echo $row->state; ?></option>
                                                    <?php } ?>

                                                </select>
                                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                                <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                                <span class="help-block"></span> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6 form-group has-feedback">
                                            <label class="col-md-6 control-label">
                                                District <font class="mandatory_field">*</font> :
                                            </label>
                                            <div class="col-md-6 " id="dist_div">
                                                <select class="form-control" name="entp_dist" id="entp_dist" data-error="Please select District.">
                                                    <option value="<?= $address->dist; ?>"><?= $address->dist; ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 form-group has-feedback">
                                            <label class="col-md-6 control-label">
                                                Pin Code <font class="mandatory_field">*</font> :
                                            </label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control" value="<?= $address->pin; ?>" name="entp_pin" id="entp_pin" data-error="Please enter pin code" value="" placeholder="6-digit PIN" maxlength="6" />
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="form-group has-feedback" id="nameid">
                                        <label for="name" class="col-md-3 control-label">Name of the authorised person &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                                        <div class="col-md-3">                                                
                                            <input type="text" class="form-control required"  maxlength="255" id="name" name="name" data-error="Please enter authorised person name." value="<?= $caf->app_name; ?>"/>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                            <span  class="help-block">Enter the name of the authorised person</span>                   

                                        </div>
                                        <label for="" class="col-md-2 control-label text-left">Designation&nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control required"  maxlength="255" id="designation" name="designation" data-error="Please enter authorised person designation." value="<?= $caf->app_designation; ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="authorisation_letter" class="col-sm-3 control-label">Upload Authorisation letter: </label>
                                        <div class="col-sm-9">
                                            <input type="file" name="authorisation_letter" id="authorisation_letter" data-error="Please upload Authorisation.">
                                            <span class="filetype_Error"></span>	
                                            <input type="hidden" name="authorisation_document" value="<?= $caf->app_authorisation_letter; ?>">
                                            <?php if (!empty($caf->app_authorisation_letter)) { ?>
                                                <a href="<?= $caf->app_authorisation_letter; ?>" target="_blank">View</a>
                                            <?php } ?>
                                        </div>


                                    </div>
                                    <div class="form-group has-feedback">
                                        <input type="hidden" name="app_addressid" value="<?= $caf->app_address; ?>">
                                        <label class="col-md-3 control-label" for="app_address">
                                            Address <font class="mandatory_field">*</font> :
                                        </label>
                                        <div class="col-md-3">
                                            <textarea name="app_address" id="app_address" class="form-control required" value="" data-error="" ><?= $user_address->address; ?></textarea>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                            <span class="help-block"></span> 
                                        </div>


                                        <label class="col-md-3 control-label">
                                            Pin Code <font class="mandatory_field">*</font> :
                                        </label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control required" name="app_pin" id="app_pin" data-error="Please enter pin code"  placeholder="6-digit PIN" maxlength="6" value="<?= $user_address->pin; ?>"/>
                                        </div>

                                    </div>
                                    <div class="form-group">

                                        <label class="col-md-3 control-label">
                                            District <font class="mandatory_field">*</font> :
                                        </label>
                                        <div class="col-md-3 " id="dist_div">
                                            <select class="form-control required" name="app_dist" id="app_dist" data-error="Please select District.">
                                                <option value="<?= $user_address->dist; ?>"><?= $user_address->dist; ?></option>
                                            </select>
                                        </div>

                                        <label class="col-md-3 control-label">
                                            State <font class="mandatory_field">*</font> :
                                        </label>
                                        <div class="col-md-2 ">
                                            <select class="form-control required" name="app_state" id="app_state" data-error="Please select state." >
                                                <option value=""></option>
                                                <?php foreach (getAllStates() as $row) { ?>
                                                    <option value="<?php echo $row->state; ?>"  <?php if ($row->state == $user_address->state) echo "selected"; ?>><?php echo $row->state; ?></option>
                                                <?php } ?>

                                            </select>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                            <span class="help-block"></span> 
                                        </div>
                                        <label for="id_proof" class="col-sm-3 control-label">Upload ID Proof: </label>
                                        <div class="col-sm-3">
                                            <input type="file" name="id_proof" id="id_proof" data-error="Please upload ID proof.">
                                            <span class="filetype_Error"></span>	
                                            <input type="hidden" name="idproof_document" value="<?= $caf->app_id_proof; ?>">
                                            <?php if (!empty($caf->app_id_proof)) { ?>
                                                <a href="<?= $caf->app_id_proof; ?>" target="_blank">View</a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="form-group has-feedback" id="phonecheck">
                                        <label for="" class="col-sm-3 control-label">Mobile Number &nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">+91</div>
                                                <input type="text" class="form-control required" required="required" validate="mobileNumber" maxlength="10" id="phone" name="phone" value="<?= $caf->app_mobile ?>" data-error="Please enter mobile no."/>
                                            </div>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                            <span  class="help-block">Enter 10 Digit Mobile Number</span>
                                        </div>
                                        <label for="" class="col-md-3 control-label text-left">Email&nbsp;&nbsp;<span class="text-danger">*&nbsp;</span></label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">@</div>
                                                <input type="email" class="form-control" required="required"  maxlength="255" id="email" name="email" value="<?= $caf->app_email ?>" data-error="Please enter email."/>
                                            </div>
                                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                            <span id="inputSuccess3Status" class="sr-only">(success)</span>
                                            <span  class="help-block">Your Email Address e.g you@example.com</span>
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
                    <br/>
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
<script type="text/javascript" src="<?php echo base_url(); ?>public/pekeupload/js/pekeUpload.js" ></script>
<script>
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
            $('#entity_details').empty();
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
            $('#registrationForm input[type="text"],select').each(function () {
                if ($(this).val() == "")
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
                    }, 2000);
                    exit();
                }
            });

            if (error == 1)
            {
                var FormData = $('#registrationForm').serializeArray();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>users/caf/storeeditcaf/',
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
                                window.location.href = '<?php echo base_url(); ?>users/home/';
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