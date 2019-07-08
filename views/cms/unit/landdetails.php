<?php if (!$this->unit_model->getlanddetails($this->session->edit_unitid)) {?>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal4">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Land / Site details</h4>
            </div>
            <div class="modal-body">
                <div id="loader-wrapper" class="storelandloader-wrapper">
                    <div id="loader"></div>
                </div>
                <form id="form3"  class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Is Land / Shed situated in Industrial Growth Center / Industrial Estate
                            <font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" class="estateradio requiredinput" name="inlineRadioOptions" data-error="Please select if your land is under industrial estate." data-value="yes" value=""> yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="estateradio requiredinput" name="inlineRadioOptions" data-error="Please select if your land is under industrial estate." data-value="no" value=""> no
                                </label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control hidden" id="estates" name="estates" data-error="Please select estate.">
                                    <option value="">Select estate</option>
                                    <?php
                                    foreach ($this->landbank_model->get_agency() as $estates) {
                                        ?>
                                        <option value="<?= $estates["Name_of_the_infrastructure_with_location"]; ?>"><?= $estates["Name_of_the_infrastructure_with_location"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Type of Area<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select type of area." name="area_type">
                                <option value=""></option>
                                <option value="Urban">Urban</option>
                                <option value="Rural">Rural</option>
                                <option  value="Others">Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Status of Land/Building/Premises<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select status of Land/Building/Premises." name="land_status" >
                                <option value=""></option>
                                <option value="Own">Own</option>
                                <option value="Rented">Rented</option>
                                <option value="Leased">Leased</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Type of Land<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select type of Land." name="land_type" >
                                <option value=""></option>
                                <option value="Government">Government</option>
                                <option value="Private">Private</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Dag No.<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="dag_no" data-error="Please enter Dag No." value="" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Patta No.<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="patta_no" data-error="Please enter Patta No." value="" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Mouza<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="mouza" value="" data-error="Please enter Mouza." placeholder="" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="land_details_submit">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
        function  getlanddetailsview() {
        $('.landdetailsloader').fadeIn("slow");
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>cms/unit/getlanddetailsview/",
            dataType: "html",
            beforeSend: function () {},
            success: function (res) {
                $('.landdetailsloader').fadeOut("slow");
                $('#landdetailsview').empty().append(res);
            }
        });
    }
    $(document).ready(function () {
        $('.estateradio').click(function () {
            if ($(this).is(':checked')) {
                if ($(this).attr("data-value") == "yes") {
                    $("#estates").removeClass("hidden").fadeIn("slow").addClass("requiredinput");
                    $('.estateradio').val("yes");
                } else {
                    $("#estates").addClass("hidden").fadeOut("slow").removeClass("requiredinput");
                    $('.estateradio').val("No");
                }
            }
        });// End of radio button function

        $('#land_details_submit').click(function () {
            $('#form3 .requiredinput').each(function () {
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
            var data = $("#form3").serializeArray();
            $(".storelandloader-wrapper").fadeIn("slow");
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>cms/unit/storelanddetails/",
                data: data,
                dataType: "json",
                beforeSend: function () {},
                success: function (res) {
                    $('.storelandloader-wrapper').fadeOut("slow");
                    //alert(data);
                    if (res.success == 1) {
                        $('#ModalTitle').empty().append("Success");
                        $('#modalContent').empty().append(res.info);
                        $('#myModal4').modal("hide");
                        $('#UnitModal').modal("show");
                        $('#UnitModal').on('hidden.bs.modal', function (e) {
                            getlanddetailsview();
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
<?php }else{ 
    $row=$this->unit_model->getlanddetails($this->session->edit_unitid);
    ?>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal4">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"> Land / Site details</h4>
            </div>
            <div class="modal-body">
                <div id="loader-wrapper" class="storelandloader-wrapper">
                    <div id="loader"></div>
                </div>
                <form id="form3"  class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Is Land / Shed situated in Industrial Growth Center / Industrial Estate
                            <font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <div class="col-md-4">
                                <label class="radio-inline">
                                    <input type="radio" class="estateradio requiredinput" name="inlineRadioOptions" data-error="Please select if your land is under industrial estate." data-value="yes" value="" <?php if($row->estate!=""){echo "checked";}?>> yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" class="estateradio requiredinput" name="inlineRadioOptions" data-error="Please select if your land is under industrial estate." data-value="no" value="" <?php if($row->estate==""){echo "checked";}?>> no
                                </label>
                            </div>
                            <div class="col-md-8">
                                <select class="form-control <?php if($row->estate==""){echo "hidden";}?>" id="estates" name="estates" data-error="Please select estate.">
                                    <option value="">Select estate</option>
                                    <?php
                                    foreach ($this->landbank_model->get_agency() as $estates) {
                                        ?>
                                        <option value="<?= $estates["Name_of_the_infrastructure_with_location"]; ?>" <?php if($row->estate==$estates["Name_of_the_infrastructure_with_location"]){echo "selected";}?>><?= $estates["Name_of_the_infrastructure_with_location"]; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Type of Area<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select type of area." name="area_type">
                                <option value=""></option>
                                <option value="Urban" <?php if($row->area_type=="Urban"){echo "selected";}?>>Urban</option>
                                <option value="Rural" <?php if($row->area_type=="Rural"){echo "selected";}?>>Rural</option>
                                <option  value="Others" <?php if($row->area_type=="Others"){echo "selected";}?>>Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Status of Land/Building/Premises<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select status of Land/Building/Premises." name="land_status" >
                                <option value=""></option>
                                <option value="Own" <?php if($row->land_status	=="Own"){echo "selected";}?>>Own</option>
                                <option value="Rented" <?php if($row->land_status=="Rented"){echo "selected";}?>>Rented</option>
                                <option value="Leased" <?php if($row->land_status=="Leased"){echo "selected";}?>>Leased</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Type of Land<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <select class="form-control text-uppercase requiredinput" data-error="Please select type of Land." name="land_type" >
                                <option value=""></option>
                                <option value="Government" <?php if($row->land_type=="Government"){echo "selected";}?>>Government</option>
                                <option value="Private" <?php if($row->land_type=="Private"){echo "selected";}?>>Private</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Dag No.<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="dag_no" data-error="Please enter Dag No." value="<?= $row->dag_no;?>" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Patta No.<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="patta_no" data-error="Please enter Patta No." value="<?= $row->patta_no;?>" placeholder="" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-6 col-sm-12">
                            Mouza<font class="mandatory_field">*</font> :
                        </label>
                        <div class="col-md-6 col-sm-12">
                            <input type="text" class="form-control requiredinput" name="mouza" value="<?= $row->mouza;?>" data-error="Please enter Mouza." placeholder="" />
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="land_details_submit">Submit</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    function  getlanddetailsview() {
        $('.landdetailsloader').fadeIn("slow");
        $.ajax({
            type: "GET",
            url: "<?= base_url(); ?>cms/unit/getlanddetailsview/",
            dataType: "html",
            beforeSend: function () {},
            success: function (res) {
                $('.landdetailsloader').fadeOut("slow");
                $('#landdetailsview').empty().append(res);
            }
        });
    }
    $(document).ready(function () {
        getlanddetailsview();
        $('.estateradio').click(function () {
            if ($(this).is(':checked')) {
                if ($(this).attr("data-value") == "yes") {
                    $("#estates").removeClass("hidden").fadeIn("slow").addClass("requiredinput");
                    $('.estateradio').val("yes");
                } else {
                    $("#estates").addClass("hidden").fadeOut("slow").removeClass("requiredinput");
                    $('.estateradio').val("No");
                }
            }
        });// End of radio button function

        $('#land_details_submit').click(function () {
            $('#form3 .requiredinput').each(function () {
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
            var data = $("#form3").serializeArray();
            $(".storelandloader-wrapper").fadeIn("slow");
            $.ajax({
                type: "POST",
                url: "<?= base_url(); ?>cms/unit/storelanddetails/",
                data: data,
                dataType: "json",
                beforeSend: function () {},
                success: function (res) {
                    $('.storelandloader-wrapper').fadeOut("slow");
                    //alert(data);
                    if (res.success == 1) {
                        $('#ModalTitle').empty().append("Success");
                        $('#modalContent').empty().append(res.info);
                        $('#myModal4').modal("hide");
                        $('#UnitModal').modal("show");
                        $('#UnitModal').on('hidden.bs.modal', function (e) {
                            getlanddetailsview();
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
