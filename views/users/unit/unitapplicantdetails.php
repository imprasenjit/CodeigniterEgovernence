<?php if (!$this->unit_model->getapplicantdetails($this->session->edit_unitid)) { ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Applicant details</h4>
                </div>
                <div class="modal-body">                
                    <div id="loader-wrapper" class="storeapplicantloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form2" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-7 col-sm-12 control-label">
                                Name of the Applicant/Authorised Person as per documentary evidence <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-5 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="app_name" id="app_name" data-error="Please enter applicant name." placeholder="Name of the Applicant" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-7 col-sm-12 control-label">
                                Designation of the Applicant <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-5 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="app_designation" data-error="Please enter applicant designation." placeholder="Designation of the Applicant" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" style="font-weight: bold">
                                Address of the Applicant
                            </label>
                        </div>
                        <?php
                        $this->load->helper("address");
                        show_address("app");
                        ?>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Mobile Number of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+91</span>
                                    <input type="text" name="app_mobile_no" class="form-control requiredinput phonevalidation" data-error="Please enter mobile no." value="" placeholder="10 digit mobile no." maxlength="10" />

                                </div>
                                <span id="helpBlock" class="help-block">Enter phone number.</span>
                            </div>
                        </div>
                        <div class="form-group has-feedback" id="emailid">
                            <label class="col-md-6 col-sm-12">
                                Email ID of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" name="app_email" id="email" class="form-control requiredinput " data-error="Please enter email-id."  placeholder="Enter email" />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                        <h4>This credentials will be used to login to the UNIT Dashboard.</h4>
                        <div class="form-group has-feedback" id="userid">
                            <label class="col-md-6 col-sm-12">
                                Username<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" name="app_username" id="app_username" class="form-control requiredinput " data-error="Please enter username."  />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Password<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="password" name="app_password" class="form-control requiredinput" data-error="Please enter Password" />
                                <span id="helpBlock" class="help-block">Enter Password.</span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="app_details_submit">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function  getapplicantdetailsview() {
            $('.applicantdetailsloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getapplicantdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.applicantdetailsloader').fadeOut("slow");
                    $('#applicantdetailsview').empty().append(res);
                }
            });
        }

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
        $(document).ready(function () {
            function ValidateEmail()
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))
                {
                    return (true);
                }
                return (false);
            }//End of ValidateEmail()
            $('#email').blur(function () {
                if ($("#email").val() !== "")
                {
                    if (ValidateEmail())
                    {
                        
                    } else {
                        $("#emailid").addClass("has-error").removeClass("has-success");
                        $("#emailid").find(".help-block").empty().addClass("text-danger").append("Email ID  is Invalid!");
                        $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                    }
                }
            });


            $('#app_details_submit').click(function () {
                $('#form2 .requiredinput').each(function () {
                    if ($(this).val() == "")
                    {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append($(this).attr("data-error"));
                        $('#UnitModal').modal("show");
                        $(this).parent().parent().removeClass("has-success").addClass("has-error");
                        $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append($(this).attr("data-error"));
                        $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                        //$(this).focus();
                        $('html,body').animate({
                            scrollTop: parseInt($(this).offset().top) - 200
                        }, 2000);
                        exit();
                    } else
                    {
                        $(this).parent().parent().addClass("has-success").removeClass("has-error");
                    }
                });
                var data = $("#form2").serializeArray();
                $(".storeapplicantloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storeapplicantdetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.storeapplicantloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);
                            $('#myModal2').modal("hide");
                            $('#UnitModal').modal("show");
                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getapplicantdetailsview();
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            });
        });
    </script>
    <?php
} else {
    $row = $this->unit_model->getapplicantdetails($this->session->edit_unitid);
    ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Applicant details</h4>
                </div>
                <div class="modal-body">                
                    <div id="loader-wrapper" class="storeapplicantloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form2" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-7 col-sm-12 control-label">
                                Name of the Applicant/Authorised Person as per documentary evidence <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-5 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="app_name" value="<?= $row->app_name; ?>" id="app_name" data-error="Please enter applicant name." placeholder="Name of the Applicant" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-7 col-sm-12 control-label">
                                Designation of the Applicant <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-5 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="app_designation" value="<?= $row->app_designation; ?>" data-error="Please enter applicant designation." placeholder="Designation of the Applicant" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" style="font-weight: bold">
                                Address of the Applicant
                            </label>
                        </div>

                        <?php
                        $this->load->helper("address");
                        show_address("app", $row->address);
                        ?>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Mobile Number of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon" id="basic-addon1">+91</span>
                                    <input type="text" name="app_mobile_no" value="<?= $row->app_mobile_no; ?>" class="form-control requiredinput phonevalidation" data-error="Please enter mobile no." value="" placeholder="10 digit mobile no." maxlength="10" />

                                </div>
                                <span id="helpBlock" class="help-block">Enter phone number.</span>
                            </div>
                        </div>
                        <div class="form-group has-feedback" id="emailid">
                            <label class="col-md-6 col-sm-12">
                                Email ID of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" name="app_email" id="email" value="<?= $row->app_email; ?>" class="form-control requiredinput" data-error="Please enter email-id."  placeholder="Enter email" />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                        <h4>This credentials will be used to login to the UNIT Dashboard.</h4>
                        <div class="form-group has-feedback" id="userid">
                            <label class="col-md-6 col-sm-12">
                                Username<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" name="app_username" id="app_username" value="<?= $row->app_username; ?>" class="form-control requiredinput " data-error="Please enter username."  />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Password<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="password" name="app_password" value="<?= $row->app_password; ?>" class="form-control requiredinput" data-error="Please enter Password" />
                                <span id="helpBlock" class="help-block">Enter Password.</span>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="app_details_submit">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function  getapplicantdetailsview() {
            $('.applicantdetailsloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getapplicantdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.applicantdetailsloader').fadeOut("slow");
                    $('#applicantdetailsview').empty().append(res);
                }
            });
        }

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
        $(document).ready(function () {
            function ValidateEmail()
            {
                if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val()))
                {
                    return true;
                }
                return false;
            }//End of ValidateEmail()
            $('#email').blur(function () {
                if ($("#email").val() !== "")
                {
                    if (ValidateEmail())
                    {
                        
                    } else {
                        $("#emailid").addClass("has-error").removeClass("has-success");
                        $("#emailid").find(".help-block").empty().addClass("text-danger").append("Email ID  is Invalid!");
                        $("#emailid").find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                    }
                }
            });
            getapplicantdetailsview();
            $("#app_state").change(function () {
                var entp_state = $(this).val();
                $("#entp_dist").empty().append("<option value=''>Loading...</option>")
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>site/registration/getdistrict/",
                    data: {state: entp_state},
                    beforeSend: function () {},
                    success: function (res) {
                        $("#entp_dist").empty().append("<option value=''>Select</option>").append(res);
                    }
                }); //End of ajax()
            });//state select then get the districts of that state

            $('#app_details_submit').click(function () {
                $('#form2 .requiredinput').each(function () {
                    if ($(this).val() == "")
                    {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append($(this).attr("data-error"));
                        $('#UnitModal').modal("show");
                        $(this).parent().parent().removeClass("has-success").addClass("has-error");
                        $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append($(this).attr("data-error"));
                        $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                        //$(this).focus();
                        $('html,body').animate({
                            scrollTop: parseInt($(this).offset().top) - 200
                        }, 2000);
                        exit();
                    } else
                    {
                        $(this).parent().parent().addClass("has-success").removeClass("has-error");
                    }
                });
                var data = $("#form2").serializeArray();
                $(".storeapplicantloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storeapplicantdetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.storeapplicantloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);
                            $('#myModal2').modal("hide");
                            $('#UnitModal').modal("show");
                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getapplicantdetailsview();
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            });
        });
    </script>
<?php } ?>
