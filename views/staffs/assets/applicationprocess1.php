

<div class="box box-primary box-alm" style="margin-top: 10px;">
    <h3 class="boxalm-head">
        Application process
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <input id="dept_code" value="<?= $dept_code ?>" type="hidden" />
    <input id="form_table" value="<?= $form_table ?>" type="hidden" />
    <input id="form_id" value="<?= $form_id ?>" type="hidden" />
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
                    <?= form_error("appoptions") ?>
                </td>
            </tr>
        </tbody>
    </table>

    <table id="table-1" style="display: none;" class="table table-bordered table-responsive processes_table">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">FORWARD APPLICATION</th>
            </tr>
        </thead>
        <tbody>
            <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->					
            <tr>
                <td width="15%">Remarks (If Any)</td>
                <td colspan="3">
                    <textarea id="remarks" class="form-control" style="height: 50px" placeholder="Your Remarks"></textarea>
                </td>
            </tr>
            <tr>
                <td width="15%">Forward to </td>
                <td>
                    <div class="form-inline">
                        <select style="width:250px" id="forward_to_office" class="form-control forward_to_office">
                            <option value="">Select Office </option>
                            <?php 
                            $offices_array = $this->Offices_model->get_rows($dept);
                            foreach($offices_array as $rows){
                                if($rows->id == $office_id) $s="selected"; else $s="";
                                echo '<option '.$s.' value="'.$rows->id.'">'.$rows->office_name.'</option>';
                            }
                            ?>
                        </select>
                        <select style="width:200px" id="forward_to" class="form-control forward_to_values">
                            <option value="">Please Select</option>
                            <option value="59">test Inspector (Inspector for testing)</option>
                            <option value="58">Test Facilator (Facilator for testing)</option>
                        </select>
                    </div>
                </td>
                <td width="15%">Upload File</td>
                <td>
                    <div class="form-group" id="upload">
                        <input type="file" id="file1" name="reportfile" accept=".jpg, .jpeg, .png, .pdf">
                    </div>
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

    <table id="table-2" style="display: none;" class="table table-bordered table-responsive processes_table">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">APPROVE APPLICATION</th>
            </tr>
        </thead>

        <tbody>
            <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->

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

    <table id="table-3" style="display:none" class="table table-bordered table-responsive processes_table">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">VERIFY APPLICATION</th>
            </tr>
        </thead>
        <tbody>
           <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->				
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

    <table id="table-4" class="table table-responsive table-bordered processes_table" style="display:none">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">
                    REJECT APPLICATION
                </th>
            </tr>
        </thead>
        <tbody>
            <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->	
            <tr>
                <td>Reasons</td>
                <td>
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
                <td>Upload File</td>
                <td>
                    <div class="form-group" id="upload">
                        <input type="file" id="file1" name="reportfile" accept=".jpg, .jpeg, .png, .pdf">
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

    <table id="table-5" style="display:none" class="table table-bordered table-responsive processes_table">
        <thead>
            <tr class="info">
                <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE</th>
            </tr>
        </thead>
        <tbody>
            <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->
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

    <table id="table-6" style="display:none" class="table table-bordered table-responsive processes_table">
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

    <table id="table-7" style="display:none" class="table table-bordered table-responsive processes_table">
        <thead>
            <tr class="info"><th class="text-center text-bold" colspan="4">Record Annual/Half-Yearly Reports</th></tr>
        </thead>
        <tbody>
            <!--<tr class="text-bold">
                <td width="15%">Department Name</td>
                <td width="35%">POLLUTION CONTROL BOARD ASSAM</td>
                <td width="15%">Office Name</td>
                <td width="35%">TESTING OFFICE</td>			
            </tr>
            <tr class="text-bold">
                <td>Designation</td>
                <td>Head of dept. for testing</td>
                <td>Date</td>
                <td>04-12-2017 10:46:06</td>			
            </tr>-->					
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
                        $(".processes_table").css("display", "none");
                        $(tbl).css("display", "block");
                        $(tbl).css("display", "table");
                    }
                });
                /*********** FORWARD LOGIC ******/
	
                var forward_to_office=$('.forward_to_office').val();
                $.ajax({
                    type: "POST",
                    url: "<?=base_url();?>staffs/applicationprocess/forward_to_users",
                    data: { 
                        staff_id: '<?=$staff_id;?>',
                        dept: '<?=$dept;?>',
                        forward_to_office: forward_to_office
                    },
                    beforeSend:function(){
                        $('.forward_to_values').html('<option>Please wait...</option>');
                    },
                    success:function(res){					
                        $('.forward_to_values').html(res);
                        //setTimeout(location.reload.bind(location), 1000);
                    }
                });

                $('.forward_to_office').on('change', function(){
                    var forward_to_office=$('.forward_to_office').val();
                    $.ajax({
                        type: "POST",
                        url: "<?=base_url();?>staffs/applicationprocess/forward_to_users",
                        data: { 
                            staff_id: '<?=$staff_id;?>',
                            dept: '<?=$dept;?>',
                            forward_to_office: forward_to_office
                        },
                        beforeSend:function(){
                            $('.forward_to_values').html('<option>Please wait...</option>');
                        },
                        success:function(res){					
                            $('.forward_to_values').html(res);
                            //setTimeout(location.reload.bind(location), 1000);
                        }
                    }); // End of ajax
                });
	
                $(document).on("click", "#btn-forward", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks").val();
                    var forward_to_office = $("#forward_to_office").val();
                    var forward_to = $("#forward_to").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/forward')?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, fto: forward_to_office, ft: forward_to},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-approve", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_approve").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/approve') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-verify", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_verify").val();
                    var dov = $("#date_of_verification").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/verify') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, dov: dov},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) { //alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(res, {position: "bottom right"});
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-reject", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_reject").val();
                    var reasons = [];
                    $.each($(".reason:checked"), function () {
                        reasons.push($(this).val());
                    });
                    reasons = reasons.join(", ");
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/reject') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, reasons: reasons},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Application has been successfully rejected!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-issuecer", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var file_auth_num = $("#file_auth_num").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/issuecer') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, file_auth_num: file_auth_num},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Certificate has been successfully issued!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-issuenoc", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/issuenoc') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "NOC has been successfully issued!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });

                $(document).on("click", "#btn-reports", function () {
                    var dept_code = $("#dept_code").val();
                    var form_table = $("#form_table").val();
                    var form_id = $("#form_id").val();
                    var remarks = $("#remarks_report").val();
                    var reportfile = [$(".uplodedfile").val()];
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('staffs/applicationprocess/reports') ?>",
                        data: {dept: dept_code, tbl: form_table, fid: form_id, rem: remarks, reportfile:reportfile},
                        beforeSend: function () {
                            $(".storelandloader-wrapper").fadeIn("slow");
                        },
                        success: function (res) {//alert(res);
                            $(".storelandloader-wrapper").fadeOut("slow");
                            $.notify(
                                "Report has been successfully uploaded!!!",
                                {position: "bottom right"}
                            );
                            window.setTimeout(function(){
                                history.go(-1);
                            }, 2000);
                        }
                    });//End of ajax()
                });//End of on click
            });
        </script>