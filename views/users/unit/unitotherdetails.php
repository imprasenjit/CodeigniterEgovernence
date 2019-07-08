<?php
$row = $this->unit_model->getotherdetails($this->session->edit_unitid);
$investment = array(
    "1" => "Below INR 10 LAKH",
    "2" => "INR 10 LAKH to 25 LAKH",
    "3" => "INR 25 LAKH to 2.00 CRORE",
    "4" => "INR 2.00 CRORE to 5.00 CRORE",
    "5" => "INR 5.00 CRORE to 10.00 CRORE",
    "6" => "Above 10.00 CRORE"
);

$pollutionarray = array(
    "1" => "RED",
    "2" => "ORANGE",
    "3" => "GREEN",
    "4" => "OTHERS"
);
if (!$row) {
    ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Other details</h4>
                </div>
                <div class="modal-body">
                    <div id="loader-wrapper" class="otherdetailsloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form4"  class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Size of Current Investment<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" name="invest_size" data-error="Please select Size of Current Investment" id="invest_size">
                                    <option value="">Select</option>
                                    <?php foreach ($investment as $key => $invest) { ?>
                                        <option value="<?= $key; ?>"><?= $invest; ?></option>
    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" for="employement">
                                Current/Estimated Employment <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="employement" data-error="Please enter Current/Estimated Employment" id="employement">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Select Your Sector of Operation<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control requiredinput" name="operation_sector" id="operation_sector" data-error="Please select Sector of Operation">
                                    <option value="">Select</option>
                                    <?php
                                    //print_r($this->unit_model->getsectors());
                                    foreach ($this->unit_model->getsectors() as $sector) {
                                        ?>
                                        <option value="<?= $sector->sector_id; ?>"><?= $sector->sector_name; ?></option>
    <?php } ?>
                                </select>
                                <a style="text-decoration:none" href="nic_2008_17apr09.pdf" target="_blank"><span class="tooltip-pol_categories knowWard">Know More</span></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Select your business type<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12" id="business_type_div">
                                <select class="form-control requiredinput" name="business_type" id="business_type" data-error="Please select business type">
                                    <option value=""></option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Category of Enterprise based on pollution<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" name="entp_category" data-error="Please select Category of Enterprise based on pollution">
                                    <option value="">Select</option>
                                    <?php foreach ($pollutionarray as $key => $value) { ?>
                                        <option value="<?= $key; ?>"><?= $value; ?></option>
    <?php } ?>
                                </select><a style="text-decoration:none" href="unit_pollution_categories.php" target="_blank"><span class="tooltip-pol_categories knowWard">Know More</span></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" for="power_requirement">
                                Power Requirement in KW <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="power_requirement" id="power_requirement" data-error="Please enter power requirement in KW">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="other_details_submit">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function  getotherdetailsview() {
            $('.otherdetailsloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getotherdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.otherdetailsloader').fadeOut("slow");
                    $('#otherdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
            $("#operation_sector").change(function () {
                var sector = $(this).val();
                $("#business_type").empty().append("<option value=''>Loading...</option>")
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/getbusinesstypes/",
                    data: {sector: sector},
                    beforeSend: function () {},
                    success: function (res) {
                        $("#business_type").empty().append("<option value=''>Select</option>").append(res);
                    }
                }); //End of ajax()
            });
            $('#other_details_submit').click(function () {
                $('#form4 .requiredinput').each(function () {
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
                var data = $("#form4").serializeArray();
                $(".otherdetailsloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storeotherdetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.otherdetailsloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);
                            $('#myModal3').modal("hide");
                            $('#UnitModal').modal("show");
                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getotherdetailsview();
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            }); //End of submit function()
        });
    </script>

<?php
} else {
    $businesstypes = $this->unit_model->getbusinesstypes("", $row->business_type);
    ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal3">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Other details</h4>
                </div>
                <div class="modal-body">
                    <div id="loader-wrapper" class="otherdetailsloader-wrapper">
                        <div id="loader"></div>
                    </div>
                    <form id="form4"  class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Size of Current Investment<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" name="invest_size" data-error="Please select Size of Current Investment" id="invest_size">
                                    <?php foreach ($investment as $key => $invest) { ?>
                                        <option value="<?= $key; ?>" <?php if ($row->investment_size == $key) {
                                    echo 'selected';
                                } ?> ><?= $invest; ?></option>
    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" for="employement">
                                Current/Estimated Employment <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="employement" value="<?= $row->no_of_employee; ?>" data-error="Please enter Current/Estimated Employment" id="employement">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Select Your Sector of Operation<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control requiredinput" name="operation_sector" id="operation_sector" data-error="Please select Sector of Operation">
                                    <option value="">Select</option>
                                    <?php
                                    print_r($this->unit_model->getsectors());
                                    foreach ($this->unit_model->getsectors() as $sector) {
                                        ?>
                                        <option value="<?= $sector->sector_id; ?>" <?php if ($row->operation_sector == $sector->sector_id) {
                                            echo 'selected';
                                        } ?>><?= $sector->sector_name; ?></option>
    <?php } ?>
                                </select>
                                <a style="text-decoration:none" href="nic_2008_17apr09.pdf" target="_blank"><span class="tooltip-pol_categories knowWard">Know More</span></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Select your business type<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12" id="business_type_div">
                                <select class="form-control requiredinput" name="business_type" id="business_type" data-error="Please select business type">
                                    <option value="<?= $row->business_type; ?>"><?= $businesstypes[0]->business_type; ?></option> 
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12">
                                Category of Enterprise based on pollution<font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <select class="form-control text-uppercase requiredinput" name="entp_category" data-error="Please select Category of Enterprise based on pollution">
    <?php foreach ($pollutionarray as $key => $value) { ?>
                                        <option value="<?= $key; ?>" <?php if ($row->entp_category == $key) {
            echo 'selected';
        } ?>><?= $value; ?></option>
    <?php } ?>
                                </select><a style="text-decoration:none" href="unit_pollution_categories.php" target="_blank"><span class="tooltip-pol_categories knowWard">Know More</span></a>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-6 col-sm-12" for="power_requirement">
                                Power Requirement in KW <font class="mandatory_field">*</font> :
                            </label>
                            <div class="col-md-6 col-sm-12">
                                <input type="text" class="form-control requiredinput" name="power_requirement" id="power_requirement" value="<?= $row->power_requirement; ?>" data-error="Please enter power requirement in KW">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="other_details_submit">Submit</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        function  getotherdetailsview() {
            $('.otherdetailsloader').fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/getotherdetailsview/",
                dataType: "html",
                beforeSend: function () {},
                success: function (res) {
                    $('.otherdetailsloader').fadeOut("slow");
                    $('#otherdetailsview').empty().append(res);
                }
            });
        }
        $(document).ready(function () {
            getotherdetailsview();
            $("#operation_sector").change(function () {
                var sector = $(this).val();
                $("#business_type").empty().append("<option value=''>Loading...</option>")
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/getbusinesstypes/",
                    data: {sector: sector},
                    beforeSend: function () {},
                    success: function (res) {
                        $("#business_type").empty().append("<option value=''>Select</option>").append(res);
                    }
                }); //End of ajax()
            });
            $('#other_details_submit').click(function () {
                $('#form4 .requiredinput').each(function () {
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
                var data = $("#form4").serializeArray();
                $(".otherdetailsloader-wrapper").fadeIn("slow");
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>users/unit/storeotherdetails/",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {},
                    success: function (res) {
                        $('.otherdetailsloader-wrapper').fadeOut("slow");
                        //alert(data);
                        if (res.success == 1) {
                            $('#ModalTitle').empty().append("Success");
                            $('#modalContent').empty().append(res.info);
                            $('#myModal3').modal("hide");
                            $('#UnitModal').modal("show");
                            $('#UnitModal').on('hidden.bs.modal', function (e) {
                                getotherdetailsview();
                            });
                        } else {
                            $('#ModalTitle').empty().append("Error");
                            $('#modalContent').empty().append(res.error);
                            $('#UnitModal').modal("show");
                        }
                    }
                }); //End of ajax()
            }); //End of submit function()
        });
    </script>

<?php } ?>
