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

                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                House No./Building Name <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_house_no" data-error="Please enter house no." placeholder="Enter house no." />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Street/Locality <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_street" data-error="Please enter street name." placeholder="Enter street" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                Village/ Town <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_village" data-error="Please enter Village / Town."  placeholder="Enter village" />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                State <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <select class="form-control requiredinput" name="app_state" data-error="Please select state." id="app_state">
                                    <option value="">Select State</option>
                                    <?php 
									$this->load->helper("address");
									foreach (getAllStates() as $row) { ?>
                                        <option value="<?php echo $row->state_id; ?>"><?php echo $row->state_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                District <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6" id="app_dist_div">
                                <select class="form-control requiredinput" name="app_dist" id="entp_dist" data-error="Please select District.">

                                </select>
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Pin Code <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" data-error="Please enter pin code." name="app_pin" value="" placeholder="6-digit PIN" maxlength="6" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Landline Number of the Applicant :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="app_std_code" value="" placeholder="STD Code" style="width: 24%; display: inline-block" maxlength="5" />
                                <input type="text" class="form-control" name="app_phone_no" value="" placeholder="Phone Number" style="width: 75%; display: inline-block" maxlength="8" />
                            </div>
                        </div>
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
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Email ID of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" name="app_email" class="form-control requiredinput emailvalidation" data-error="Please enter email-id."  placeholder="Enter email" />
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
                url: "<?= base_url(); ?>cms/unit/getapplicantdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.applicantdetailsloader').fadeOut("slow");
                    $('#applicantdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
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
                    url: "<?= base_url(); ?>cms/unit/storeapplicantdetails/",
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

                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                House No./Building Name <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_house_no" value="<?= $row->address->house_no; ?>" data-error="Please enter house no." placeholder="Enter house no." />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Street/Locality <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_street" value="<?= $row->address->street; ?>" data-error="Please enter street name." placeholder="Enter street" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                Village/ Town <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="app_village" value="<?= $row->address->village; ?>" data-error="Please enter Village / Town."  placeholder="Enter village" />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                State <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <select class="form-control requiredinput" name="app_state" data-error="Please select state." id="app_state">
                                    <option value="">Select State</option>
                                    <?php $this->load->helper("address");
									foreach (getAllStates() as $rowstate) { ?>
                                        <option value="<?php echo $rowstate->state_id; ?>" <?php
                                        if ($rowstate->state_id == $row->address->state) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $rowstate->state_name; ?></option>
    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-6">
                                District <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6" id="app_dist_div">
                                <select class="form-control requiredinput" name="app_dist" id="entp_dist" data-error="Please select District.">
                                    <option value="<?= $row->address->dist; ?>"><?= $row->address->dist; ?></option>

                                </select>
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Pin Code <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" value="<?= $row->address->pin; ?>" data-error="Please enter pin code." name="app_pin" value="" placeholder="6-digit PIN" maxlength="6" />
                            </div>
                        </div>

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
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Email ID of the Applicant<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" name="app_email" value="<?= $row->app_email; ?>" class="form-control requiredinput emailvalidation" data-error="Please enter email-id."  placeholder="Enter email" />
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
                url: "<?= base_url(); ?>cms/unit/getapplicantdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.applicantdetailsloader').fadeOut("slow");
                    $('#applicantdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
            getapplicantdetailsview();
            $("#app_state").change(function () {
                var entp_state = $(this).val();
                $("#entp_dist").empty().append("<option value=''>Loading...</option>")
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>ajax/site/get_district_of_state/",
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
                    url: "<?= base_url(); ?>cms/unit/storeapplicantdetails/",
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
