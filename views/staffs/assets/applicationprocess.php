<?php
$appupRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
$office_id = $appupRow->office_id;
$current_userid = $appupRow->current_userid;
$process_date = date("d-m-Y h:i A", strtotime($appupRow->process_date));

$officeRows = $this->offices_model->get_rows($this->dept_code);
$officeRow = $this->offices_model->get_row($office_id, $this->dept_code);
$office_name = $officeRow->office_name;
$jurisdiction = $officeRow->jurisdiction;

$staffRows = $this->deptusers_model->get_row($current_userid, $this->dept_code);
$current_username = $staffRows->user_name;
$current_userdesignation = $staffRows->udesig;

$dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
$rightsArray = explode(",", $this->session->staff_rights);
if ($this->session->flashdata("flashMsg")) {
    ?>
    <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div id="loader-wrapper" class="storelandloader-wrapper">
    <div id="loader"></div>
</div>

<div class="box box-primary box-alm" style="margin-top: 10px;">
    <h3 class="boxalm-head">
        Application process
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <input id="uain" value="<?=$this->uain?>" type="hidden" />
    <input id="form_table" value="<?=$this->frmtbl?>" type="hidden" />
    <input id="form_id" value="<?=$this->form_id?>" type="hidden" />
    <input id="swr_id" value="<?=$this->swr_id?>" type="hidden" />
    <table style="width: 100%; margin-bottom: 5px">
        <tbody>
            <tr class="bg-success">
                <td style="vertical-align: middle; font-weight: bold; text-align: right; font-size: 18px">
                    Please select an option : 
                </td>
                <td>
                    <select id="appoptions" class="form-control" style="width: auto;">
                        <option value="">Select an operation</option>
                        <?php if(in_array("F", $rightsArray)) { ?>
                            <option value="1">Forward Application</option>
                        <?php } ?>
                        <?php if(in_array("A", $rightsArray)) { ?>
                            <option value="2">Approve Application</option>
                        <?php } ?>
                        <?php if(in_array("V", $rightsArray)) { ?>								
                            <option value="3">Verify Application</option>
                        <?php } ?>
                        <?php if(in_array("R", $rightsArray)) { ?>																
                            <option value="4">Reject Application</option>
                        <?php } ?>
                        <?php if(in_array("I", $rightsArray)) { ?>
                            <option value="5">Issue Certificate</option>
                        <?php } ?>
                        <?php if(in_array("I", $rightsArray)) { ?>
                            <option value="6">Issue NOC</option>
                        <?php } ?>
                        <?php if(in_array("I", $rightsArray)) { ?>								
                            <option value="7">Record Reports</option>
                        <?php } ?>	
                    </select>
                    <!--
                    <select id="appoptions" class="form-control" style="width: auto;">
                        <option value="">Select an operation</option>
                        <option value="1">Forward Application</option>
                        <option value="2">Approve Application</option>								
                        <option value="3">Verify Application</option>																
                        <option value="4">Reject Application</option>
                        <option value="5">Issue Certificate</option>
                        <option value="6">Issue NOC</option>								
                        <option value="7">Record Reports</option>
                    </select>
		   -->
                    <?= form_error("appoptions") ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="table-1" style="display: none;" class="table table-bordered table-responsive">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">FORWARD APPLICATION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Department Name</td>
                <td><?=$dept_name?></td>
                <td>Office Name</td>
                <td><?=$office_name?></td>			
            </tr>
            <tr>
                <td>Designation</td>
                <td><?=$current_userdesignation?></td>
                <td>Date</td>
                <td><?=$process_date?></td>			
            </tr>					
            <tr>
                <td>Remarks (If Any)</td>
                <td colspan="3">
                    <textarea id="remarks" class="form-control" style="height: 50px" placeholder="Your Remarks"></textarea>
                </td>
            </tr>
            <tr>
                <td>Forward to </td>
                <td>
                    <select id="dept_office_id" class="form-control">
                        <option value="">Select Office </option>
                        <?php if($officeRows) {
                            foreach($officeRows as $rows) {
                                echo '<option value="'.$rows->id.'">'.$rows->office_name.'</option>';
                            }
                        } else {
                            echo '<option value="">No records found</option>';
                        } ?>
                    </select>
                </td>
                <td colspan="2" id="staffuser_div">
                    <select id="dept_user_id" class="form-control">
                        <option value="">Please Select</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button type="button" id="btn-forward" class="btn btn-success text-bold">
                        Forward <i class="fa fa-chevron-circle-right"></i>
                    </button>
                </td>
            </tr>
        </tbody>						
    </table>


<?php $this->load->view("depts/".$this->dept_code."/form".$this->frm_no."_certificate_approve"); ?>
<!--
    <table id="table-2" style="display: none;" class="table table-bordered table-responsive">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">APPROVE APPLICATION</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Department Name</td>
                <td><?=$dept_name?></td>
                <td>District/Ward Nos.</td>
                <td><?=$jurisdiction?></td>			
            </tr>
            <tr>
                <td>Designation</td>
                <td><?=$current_userdesignation?></td>
                <td>Date</td>
                <td><?=$process_date?></td>			
            </tr>

            <tr>
                <td>Remarks (If Any)</td>
                <td colspan="3">
                    <textarea id="remarks_approve" class="form-control" placeholder="Your Remarks"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="4"><div class="filetype_Error"></div></td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button type="button" id="btn-approve" class="btn btn-success text-bold">
                        <i class="fa fa-check-circle"></i> Approve
                    </button>
                </td>
            </tr>
        </tbody>					
    </table>
-->

    <table id="table-3" style="display:none" class="table table-bordered table-responsive">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">VERIFY APPLICATION</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Department Name</td>
                <td><?=$dept_name?></td>
                <td>Office Name</td>
                <td><?=$office_name?></td>			
            </tr>
            <tr>
                <td>Designation</td>
                <td><?=$current_userdesignation?></td>
                <td>Date</td>
                <td><?=$process_date?></td>			
            </tr>					
            <tr>
                <td>Remarks (If Any)</td>
                <td>
                    <textarea id="remarks_verify" class="form-control" placeholder="Your Remarks"></textarea>
                </td>
                <td>Date of Verification</td>
                <td>
                    <div class="form-group">
                        <input id="date_of_verification" class="form-control dp" type="text">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button type="button" id="btn-verify" class="btn btn-success text-bold">
                        <i class="fa fa-check-circle"></i> Forward
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="table-4" class="table table-bordered" style="display:none">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">
                    REJECT APPLICATION
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Department Name</td>
                <td><?=$dept_name?></td>
                <td>Office Name</td>
                <td><?=$office_name?></td>				
            </tr>
            <tr>
                <td>Designation</td>
                <td><?=$current_userdesignation?></td>
                <td>Date</td>
                <td><?=$process_date?></td>			
            </tr>	
            <tr>
                <td>Reasons</td>
                <td colspan="3">
                    <div class="checkbox">
                        <label><input class="reason" value="Incomplete form" type="checkbox">Incomplete form</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="reason" value="Wrong information submitted" type="checkbox">Wrong information submitted</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="reason" value="Payment not done or incomplete" type="checkbox">Payment not done or incomplete</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="reason" value="Query not submitted properly" type="checkbox">Query not submitted properly</label>
                    </div>
                    <div class="checkbox">
                        <label><input class="reason" value="Any other reason (Please specify)" type="checkbox">Any other reason (Please specify)</label>
                    </div>
                </td>
            </tr>					
            <tr>
                <td colspan="4">
                    <textarea id="remarks_reject" class="form-control" placeholder="Please describe the reason here"></textarea>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button type="button" id="btn-reject" class="btn btn-danger text-bold">
                        <i class="fa fa-remove"></i> Reject
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

<?php $this->load->view("depts/".$this->dept_code."/form".$this->frm_no."_certificate_issue"); ?>
<!--
    <table id="table-5" style="display:none" class="table table-bordered table-responsive">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Department Name</td>
                <td><?=$dept_name?></td>
                <td>Office Name</td>
                <td><?=$office_name?></td>				
            </tr>
            <tr>
                <td>Designation</td>
                <td><?=$current_userdesignation?></td>
                <td>Date of Issue</td>
                <td><?=$process_date?></td>			
            </tr>
            <tr>
                <td>File number of authorisation : </td>
                <td><input id="file_auth_num" class="form-control text-uppercase" type="text"></td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="4">
                    <table class="table table-bordered table-responsive text-left" style="margin:0px auto;border-collapse: collapse" width="100%">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Type of Waste</th>
                                <th>Quantity permitted for Handling</th>
                            </tr>
                            <tr>
                                <th>(1)</th>
                                <th>(2)</th>
                                <th>(3)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="8" valign="top">Yellow</td>
                                <td>(a) Human Anatomical Waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[haw]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(b) Animal Anatomical Waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[aaw]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(c) Soiled Waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[sw]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(d) Expired or Discarded Medicines </td>
                                <td><input class="form-control text-uppercase" name="yellow[edm]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(e) Chemical Solid Waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[csw]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(f) Chemical Liquid Waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[clw]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid </td>
                                <td><input class="form-control text-uppercase" name="yellow[dlm]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>(h) Microbiology, Biotechnology and other clinical laboratory waste </td>
                                <td><input class="form-control text-uppercase" name="yellow[mbc]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>Red</td>
                                <td>Contaminated Waste (Recyclable) </td>
                                <td><input class="form-control text-uppercase" name="red" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>White (Translucent)</td>
                                <td>Waste sharps including Metals </td>
                                <td><input class="form-control text-uppercase" name="white" value="" type="text"></td>
                            </tr><tr>
                                <td rowspan="2">Blue</td>
                                <td>Glassware </td>
                                <td><input class="form-control text-uppercase" name="blue[glass]" value="" type="text"></td>
                            </tr>
                            <tr>
                                <td>Metallic Body Implants </td>
                                <td><input class="form-control text-uppercase" name="blue[mbi]" value="" type="text"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button id="btn-issuecer" type="button" class="btn btn-success text-bold">
                        <i class="fa fa-check-circle"></i> Issue now
                    </button>
                </td>
            </tr>
        </tbody>					
    </table>
-->
    <table id="table-6" style="display:none" class="table table-bordered table-responsive">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">ISSUE NOC</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">								
                    <p class="text-danger" align="center">Issue NOC is required only in case of low risk.</p>
                </td>			
            </tr>
            <tr>
                <td colspan="2">
                    <a href="#" class="btn btn-primary" target="_blank" name="noc">Click here to generate NOC</a>
                    <input name="isuue_noc_form_id" value="1" type="hidden">
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button id="btn-issuenoc" type="button" class="btn btn-success text-bold">
                        <i class="fa fa-book"></i> Issue NOC
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="table-7" style="display:none" class="table table-bordered table-responsive">
        <thead>
            <tr class="info"><th class="text-center text-bold" colspan="4">Record Annual/Half-Yearly Reports</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>Department Name</td>
                <td></td>
                <td>Office Name</td>
                <td></td>			
            </tr>
            <tr>
                <td>Designation</td>
                <td></td>
                <td>Date</td>
                <td><?= date("d-m-Y H:i:s"); ?></td>			
            </tr>					
            <tr>
                <td>Remarks (If Any)</td>
                <td>
                    <textarea id="remarks_report" class="form-control" style="width:300px; height: 50px" placeholder="Your Remarks"></textarea>
                </td>
                <td>Upload File</td>
                <td>
                    <div class="form-group" id="upload">
                        <input type="file" id="file1" name="reportfile" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4"><div class="filetype_Error"></div></td>
            </tr>
            <tr>
                <td class="text-center" colspan="4">
                    <button id="btn-reports" type="button" class="btn btn-success text-bold">
                        <i class="fa fa-book"></i> Record Reports
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    
<link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
<script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(".dp").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true
        });

        $("#file1").pekeUpload({
            bootstrap: true,
            url: "<?=base_url('upload/')?>",
            data: {file: "reportfile"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });//End of pekeUpload

        $(document).on("change", "#appoptions", function () {
            var optn = $(this).val();
            if (optn === "") {
                $(this).notify("please select an option");
                $(this).focus();
            } else {
                var tbl = "#table-" + optn;
                $(".table").css("display", "none");
                $(tbl).css("display", "block");
                $(tbl).css("display", "table");
            }
        });


        var uain = $("#uain").val();
        var form_table = $("#form_table").val();
        var form_id = $("#form_id").val();

        $(document).on("change", "#dept_office_id", function(){
            var dept_office_id = $(this).val();
            if(dept_office_id == "") {
                $("#dept_office_id").notify("Please select a state");
                $(this).focus();
                return false;
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?=base_url('staffs/deptusers/getofficerows')?>",
                    data: {"office_id" : dept_office_id},
                    beforeSend:function(){
                        $("#staffuser_div").html("Loading...");
                    },
                    success: function(res){ //alert(res);
                        $("#staffuser_div").html(res);
                    }
                }); //End of Ajax
            } //End of else
        }); //End of onChange #dept_office_id

        $(document).on("click", "#btn-forward", function () {
            var dept_office_id = $("#dept_office_id").val();
            var dept_user_id = $("#dept_user_id").val();
            var remarks = $("#remarks").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/forward')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    dept_office_id: dept_office_id,
                    dept_user_id: dept_user_id,
                    remarks: remarks
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(res, {position: "bottom right"});
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-approve", function () {
            var remarks = $("#remarks_approve").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/approve') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    remarks: remarks
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(res, {position: "bottom right"});
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-verify", function () {
            var remarks = $("#remarks_verify").val();
            var dov = $("#date_of_verification").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/verify') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    dov: dov,
                    remarks: remarks
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(res, {position: "bottom right"});
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-reject", function () {
            var remarks = $("#remarks_reject").val();
            var reasons = [];
            $.each($(".reason:checked"), function () {
                reasons.push($(this).val());
            });
            reasons = reasons.join(", ");
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/reject') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    reasons: reasons,
                    remarks: remarks
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) {//alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(
                        "Application has been successfully rejected!!!",
                        {position: "bottom right"}
                    );
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-issuecer", function () {
            var file_auth_num = $("#file_auth_num").val();
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/issuecer') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    file_auth_num: file_auth_num
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) {//alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(
                        "Certificate has been successfully issued!!!",
                        {position: "bottom right"}
                    );
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-issuenoc", function () {
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/issuenoc') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) {//alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(
                        "NOC has been successfully issued!!!",
                        {position: "bottom right"}
                    );
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });

        $(document).on("click", "#btn-reports", function () {
            var remarks = $("#remarks_report").val();
            var reportfile = [$(".uplodedfile").val()];
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/applicationprocess/reports') ?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    reportfile: reportfile,
                    remarks: remarks
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) {//alert(res);
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(
                        "Report has been successfully uploaded!!!",
                        {position: "bottom right"}
                    );
                    window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });//End of on click
    });
</script>
