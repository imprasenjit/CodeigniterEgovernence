<div class="container user-bodysection" >
    <div class="row">
        <div id="loader-wrapper" class="finalloader-wrapper">
            <div id="loader"></div>
        </div>
        <h2>Enter unit details</h2>
        <p>This informations will automatically be fetched to the required applications of departments when you apply for a lisence/approval.</p>


        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default" id="panel4">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseFour"
                               href="#!" >                         
                                Unit details
                            </a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse in">
                        <div class="panel-body unitpanelbody" id="unitdetailsview"> 
                            <div id="loader-wrapper" class="unitloader">
                                <div id="loader"></div>
                            </div></div>
                        <div class="panel-footer" style="height:40px">
                            <a href="#!" class="pull-right" data-toggle="modal" data-target="#myModal1"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;<?php
                                if (!isset($this->session->edit_unitid)) {
                                    echo "Add";
                                } else {
                                    echo "Edit";
                                }
                                ?> Unit details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">   
                <div class="panel panel-default" id="panel2">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseTwo" 
                               href="#!" >
                                Authorised person details
                            </a>
                        </h4>

                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                        <div class="panel-body unitpanelbody" id="applicantdetailsview">
                            <div id="loader-wrapper" class="applicantdetailsloader">
                                <div id="loader">

                                </div>
                            </div>

                        </div>
                        <div class="panel-footer" style="height:40px">
                            <a href="#!" class="pull-right" data-toggle="modal" data-target="#myModal2"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                <?php
                                if (!$this->unit_model->getapplicantdetails($this->session->edit_unitid)) {
                                    echo "Add";
                                } else {
                                    echo "Edit";
                                }
                                ?> Applicant details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">


            <div class="col-md-6">
                <div class="panel panel-default" id="panel1">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseone"
                               href="#!" >
                                Land / Site Details

                            </a>
                        </h4>

                    </div>
                    <div id="collapseone" class="panel-collapse collapse in">
                        <div class="panel-body unitpanelbody" id="landdetailsview">
                            <div id="loader-wrapper" class="landdetailsloader">
                                <div id="loader">

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer" style="height:40px">
                            <a href="#!" class="pull-right" data-toggle="modal" data-target="#myModal4"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                <?php
                                if (!$this->unit_model->getlanddetails($this->session->edit_unitid)) {
                                    echo "Add";
                                } else {
                                    echo "Edit";
                                }
                                ?>  Land details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default" id="panel3">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseThree"
                               href="#!" >
                                Other details

                            </a>
                        </h4>

                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="panel-body unitpanelbody" id="otherdetailsview">
                            <div id="loader-wrapper" class="otherdetailsloader">
                                <div id="loader">

                                </div>
                            </div>

                        </div>
                        <div class="panel-footer" style="height:40px">
                            <a href="#!" class="pull-right" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                <?php
                                if (!$this->unit_model->getotherdetails($this->session->edit_unitid)) {
                                    echo "Add";
                                } else {
                                    echo "Edit";
                                }
                                ?> Other details</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default" id="panel5">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-target="#collapseFive"
                               href="#!" >
                                Documents
                            </a>
                        </h4>

                    </div>
                    <div id="collapseFive" class="panel-collapse collapse in">
                        <div class="panel-body unitpanelbody" id="documentsview">
                            <div id="loader-wrapper" class="otherdetailsloader">
                                <div id="loader">

                                </div>
                            </div>

                        </div>
                        <div class="panel-footer" style="height:40px">
                            <a href="#!" class="pull-right" data-toggle="modal" data-target="#myModal5"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;
                                <?php
                                if (!$this->unit_model->getotherdetails($this->session->edit_unitid)) {
                                    echo "Add";
                                } else {
                                    echo "Edit";
                                }
                                ?> Upload Documents</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default" id="panel5">
                        <div class="panel-body">
                                <h5>After you input all the information you click on the submit button.If you want to edit the informations please update now after you submit the form you won't be able to make any changes.</h5>
                                <a href="#!" class="btn btn-primary btn-lg btn-block" id="submitfinal">Sumbit</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    <?php $this->load->view("users/unit/newunitform"); ?>
    <?php $this->load->view("users/unit/unitapplicantdetails"); ?>
    <?php $this->load->view("users/unit/landdetails"); ?>    
    <?php $this->load->view("users/unit/unitotherdetails"); ?>    
    <?php $this->load->view("users/unit/uploaddocuments"); ?>    

<div class="modal fade" tabindex="-1" role="dialog" id="UnitModal">
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
    //Validation javascript functions
    function ValidateEmail(email)
    {

        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
        {
            return (true);
        }


        return (false);
    }//End of ValidateEmail()
    function ValidatePhonenumber(phone)
    {

        var phoneno = /^\d{10}$/;
        if (phone.match(phoneno))
        {
            return true;
        } else
        {
            return false;
        }

    }//End of ValidatePhonenumber()

    $(document).ready(function () {



        $('.emailvalidation').blur(function () {
            if ($(this).val() != "")
            {
                if (ValidateEmail($(this).val()))
                {
                    $(this).parent().parent().addClass("has-success").removeClass("has-error");
                } else {
                    $(this).parent().parent().removeClass("has-success").addClass("has-error");
                    $(this).parent().parent().find(".help-block").empty().addClass("text-danger").append("Please enter a valid email id.");
                    $(this).parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            }
        });
        $('.phonevalidation').blur(function () {
            if ($(this).val() != "")
            {
                if (ValidatePhonenumber($(this).val()))
                {
                    $(this).parent().parent().parent().addClass("has-success").removeClass("has-error");
                } else
                {
                    $(this).parent().parent().parent().removeClass("has-success").addClass("has-error");
                    $(this).parent().parent().parent().find(".help-block").empty().addClass("text-danger").append("Please enter a valid mobile number.");
                    $(this).parent().parent().parent().find(".glyphicon").empty().removeClass("glyphicon-ok").addClass("glyphicon-warning-sign");
                }
            }
        });//End of phone blur function


        $('#submitfinal').click(function () {
            $(".finalloader-wrapper").fadeIn("slow");
            $.ajax({
                type: "GET",
                url: "<?= base_url(); ?>users/unit/submitfinalunit/",
                dataType: "json",
                beforeSend: function () {},
                success: function (res) {
                    $('.finalloader-wrapper').fadeOut("slow");
                    //alert(data);
                    if (res.success == 1) {
                        $('#ModalTitle').empty().append("Success");
                        $('#modalContent').empty().append(res.info);
                        $('#UnitModal').modal("show");
                        $('#UnitModal').on('hidden.bs.modal', function (e) {
                            window.location.href = "<?= base_url(); ?>users/unit";
                        });

                    } else {
                        $('#ModalTitle').empty().append("Error");
                        $('#modalContent').empty().append(res.error);
                        $('#UnitModal').modal("show");
                    }
                }
            }); //End of ajax()

        });//End of final submit


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
