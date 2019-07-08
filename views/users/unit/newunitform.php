<?php
if (!isset($this->session->edit_unitid)) {
    ?>    <div class="modal fade" tabindex="-1" role="dialog" id="myModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Unit Details</h4>
                </div>
                <div class="modal-body">
                    <div id="loader-wrapper" class="storeloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form1"  class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Name of the unit:
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="unit_name" id="unit_name" data-error="Please enter the name of the unit" placeholder="Name of the unit" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Type of unit for which CAF is being filled<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" data-error="Please select type of unit" name="unit_type" id="unit_type">
                                    <option value="">Select</option>
                                    <?php
                                    $this->load->helper("unittype");
                                    foreach (get_allunittype() as $key => $unittype) {
                                        ?>
                                        <option value="<?= $key; ?>"><?= $unittype; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" style="font-weight: bold">
                                Date of commencement
                            </label>
                            <div class="col-md-6 col-sm-12" style="font-weight: bold;">
                                <input type="text" id="dateofcommencement" name="dateofcommencement" class="form-control requiredinput" data-error="please select date of commencement" > 
                                <span id="helpBlock" class="help-block">Expected Date of Commencement of Business (If new) OR Date of Commencement of Business (if existing)</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" style="font-weight: bold">
                                Address of the unit for which CAF is being filled :
                            </label>
                          <!--  <div class="col-md-6 col-sm-12" style="font-weight: bold;">
                                <input type="checkbox" id="same_as_above" name="addresstype" value="sameas" style="width: 16px; height: 16px;"> Same as Enterprise/Registered Office
                            </div>-->
                        </div>
                        <?php 
                        $this->load->helper("address");
                        show_address_assam("unit");
                        ?>
                        <div class="form-group address-group">
                            <label class="col-md-3 col-sm-6">
                                Revenue Circle <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="revenue_circle" data-error="Please enter Revenue Circle." value="" id="revenue_circle" />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Block/ Ward No. <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="unit_block" id="unit_block" data-error="Please enter Block/ Ward No" placeholder="Enter block" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Landline Number :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="unit_std_code" id="unit_std_code" value="" placeholder="STD Code" style="width: 24%; display: inline-block" maxlength="5" />
                                <input type="text" class="form-control" name="unit_phone_no" id="unit_phone_no" value="" placeholder="Phone Number" style="width: 75%; display: inline-block" maxlength="8" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Mobile Number<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon">+91</span>
                                    <input type="text" name="unit_mobile_no" id="unit_mobile_no" class="form-control requiredinput phonevalidation" data-error="Please enter mobile number." placeholder="10 digit mobile no." maxlength="10" />
                                </div>
                                <span id="helpBlock" class="help-block">Enter mobile number.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Email ID<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" class="form-control requiredinput emailvalidation" name="unit_email_id" id="unit_email_id" data-error="Please enter email id." placeholder="Enter email" maxlength="100" />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitunitdetails">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function getunitdetails() {
            $('.unitloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getunitdetails/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.unitloader').fadeOut("slow");
                    $('#unitdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
            $('#same_as_above').click(function () {
                if ($(this).prop("checked") == true) {
                    $('#form1 .address-group').fadeOut("slow");
                    $('#form1 .address-group .requiredinput').removeClass("requiredinput").addClass(".disabledreqinput");
                } else if ($(this).prop("checked") == false) {
                    $('#form1 .address-group').fadeIn("slow");
                    $('#form1 .address-group .disabledreqinput').removeClass("disabledreqinput").addClass("requiredinput");
                }
            });
            // Checkbox functions to show and hide the address part
            $("#submitunitdetails").click(function () {
                $('#form1 .requiredinput').each(function () {
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
                var data = $("#form1").serializeArray();
                $(".storeloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storedetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.storeloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);

                            $('#myModal1').modal("hide");
                            $('#UnitModal').modal("show");

                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getunitdetails();
                            });

                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            });//End of unit submit
        });
    </script>
    <?php
} else {

    $id = $this->session->userdata('edit_unitid');
    $row = $this->unit_model->getunitdetails($id);
    $this->load->helper("unittype");
    ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"> Unit Details</h4>
                </div>
                <div class="modal-body">
                    <div id="loader-wrapper" class="storeloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form1"  class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Name of the unit:
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="unit_name" value="<?= $row->unit_name ?>" id="unit_name" data-error="Please enter the name of the unit" placeholder="Name of the unit" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Type of unit for which CAF is being filled<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" data-error="Please select type of unit" name="unit_type" id="unit_type">
                                    <option value="<?= $row->unit_type; ?>" selected><?= get_unittype($row->unit_type); ?></option>
                                    <?php foreach (get_allunittype() as $key => $unittype) { ?>
                                        <option value="<?= $key; ?>"><?= $unittype; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" style="font-weight: bold">
                                Date of commencement
                            </label>
                            <div class="col-md-6 col-sm-12" style="font-weight: bold;">
                                <input type="text" id="dateofcommencement" name="dateofcommencement" value="<?= $row->dateofcommencement; ?>" class="form-control requiredinput" data-error="please select date of commencement" > 
                                <span id="helpBlock" class="help-block">Expected Date of Commencement of Business (If new) OR Date of Commencement of Business (if existing)</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" style="font-weight: bold">
                                Address of the unit for which CAF is being filled :
                            </label>
                            <div class="col-md-6 col-sm-12" style="font-weight: bold;">
                                <input type="checkbox" id="same_as_above" name="addresstype" value="sameasregisteredoffice" style="width: 16px; height: 16px;" <?php if ($row->address->type_of_address == "registered_office") echo "checked"; ?>> Same as Enterprise/Registered Office
                            </div>
                        </div>
                        <?php 
                        $this->load->helper("address");
                        show_address_assam("unit",$row->address);
                        ?>
                        <div class="form-group address-group">
                            <label class="col-md-3 col-sm-6">
                                Revenue Circle <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="revenue_circle" data-error="Please enter Revenue Circle." value="<?=$row->revenue_circle;?>" id="revenue_circle" />
                            </div>
                            <label class="col-md-3 col-sm-6">
                                Block/ Ward No. <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-3 col-sm-6">
                                <input type="text" class="form-control requiredinput" name="unit_block" id="unit_block" data-error="Please enter Block/ Ward No" placeholder="Enter block" value="<?=$row->block;?>"/>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Landline Number :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control" name="unit_std_code" id="unit_std_code" value="<?= $row->landline_std ?>" placeholder="STD Code" style="width: 24%; display: inline-block" maxlength="5" />
                                <input type="text" class="form-control" name="unit_phone_no" id="unit_phone_no" value="<?= $row->landline_no ?>" placeholder="Phone Number" style="width: 75%; display: inline-block" maxlength="8" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Mobile Number<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <span class="input-group-addon">+91</span>
                                    <input type="text" name="unit_mobile_no" id="unit_mobile_no" value="<?= $row->mobile_no ?>" class="form-control requiredinput phonevalidation" data-error="Please enter mobile number." placeholder="10 digit mobile no." maxlength="10" />
                                </div>
                                <span id="helpBlock" class="help-block">Enter mobile number.</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Email ID<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="email" class="form-control requiredinput emailvalidation" value="<?= $row->email_id ?>" name="unit_email_id" id="unit_email_id" data-error="Please enter email id." placeholder="Enter email" maxlength="100" />
                                <span id="helpBlock" class="help-block">Enter email id.</span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitunitdetails">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function getunitdetails() {
            $('.unitloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getunitdetails/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.unitloader').fadeOut("slow");
                    $('#unitdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
            getunitdetails();
            // Checkbox functions to show and hide the address part
            $('#same_as_above').click(function () {
                if ($(this).prop("checked") == true) {
                    $('#form1 .address-group').fadeOut("slow");
                    $('#form1 .address-group .requiredinput').removeClass("requiredinput").addClass(".disabledreqinput");
                } else if ($(this).prop("checked") == false) {
                    $('#form1 .address-group').fadeIn("slow");
                    $('#form1 .address-group .disabledreqinput').removeClass("disabledreqinput").addClass("requiredinput");
                }
            });
            // Checkbox functions to show and hide the address part
            $("#submitunitdetails").click(function () {
                $('#form1 .requiredinput').each(function () {
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
                var data = $("#form1").serializeArray();
                $(".storeloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storedetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.storeloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);

                            $('#myModal1').modal("hide");
                            $('#UnitModal').modal("show");

                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getunitdetails();
                            });

                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            });//End of unit submit
    <?php if ($row->address->type_of_address == "registered_office") {
        ?>
                $('#form1 .address-group').fadeOut("slow");
                $('#form1 .address-group .requiredinput').removeClass("requiredinput").addClass(".disabledreqinput");
    <?php } ?>
        });
    </script>
<?php } ?>
