<?php
$staff_dept = $this->session->staff_dept;
$appupRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
$appirRow = $this->applicationsir_model->get_uainrow($this->dept_code, $this->uain);
if($appupRow) {
    $office_id = $appupRow->office_id;
    $current_userid = $appupRow->current_userid;
    $process_date = date("d-m-Y h:i A", strtotime($appupRow->process_date));
} else if($appirRow) {
    $office_id = $appirRow->office_id;
    $current_userid = $appirRow->processed_by;
    $process_date = date("d-m-Y h:i A", strtotime($appirRow->process_date));
} else {
    $office_id = $current_userid = $process_date = "NOT FOUND!";
}//End of if else
//die("dept : ".$this->dept_code.", uain : ".$this->uain.", office_id : ".$office_id);
$officeRows = $this->offices_model->get_rows($this->dept_code);
$officeRow = $this->offices_model->get_row($office_id, $this->dept_code);
if($officeRow) {
    $office_name = $officeRow->office_name;
    $jurisdiction = $officeRow->jurisdiction;
} else {
    $office_name = $jurisdiction = "NOT FOUND!";
}//End of if else
    
$staffRows = $this->deptusers_model->get_officerows($this->dept_code, $office_id);

$staffRow = $this->deptusers_model->get_row($current_userid, $this->dept_code);
if($staffRow) {
    $current_username = $staffRow->user_name;
    $current_userdesignation = $staffRow->udesig;
} else {
    $current_username = $current_userdesignation = "NOT FOUND!";
}//End of if else
    
$dept_name = $this->subdepartments_model->get_deptbycode($this->dept_code)->name;
$rightsArray = explode(",", $this->session->staff_rights);
if ($this->session->flashdata("flashMsg")) {
    ?>
    <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div id="loader-wrapper" class="storelandloader-wrapper">
    <div id="loader"></div>
</div>

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
                        <option value="5">Issue License/Certificate/NOC</option>
                    <?php } ?>
                    <?php if(in_array("I", $rightsArray) && $staff_dept=="forest") { ?>
                        <option value="6">Issue NOC</option>
                    <?php } ?>
                    <?php if(in_array("I", $rightsArray) && $staff_dept=="pcb") { ?>								
                        <option value="7">Record Reports</option>
                    <?php } ?>	
                </select>
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
                    <option value="<?=$office_id?>"><?=$office_name?></option>
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
                    <option value="">Please select a staff</option>
                    <?php if($staffRows) {
                        foreach($staffRows as $rows) {
                            echo '<option value="'.$rows->user_id.'">'.$rows->user_name.'('.$rows->udesig.')</option>';
                        }
                    } else {
                        echo '<option value="">No records found</option>';
                    } ?>
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
<table id="table-2" style="display: none;" class="table table-bordered table-responsive">
    <thead>
        <tr class="info">
            <th class="text-center text-bold" colspan="4">APPROVE APPLICATION</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Department Name</td>
            <td><?=$this->dept_name?></td>
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
            <td colspan="4">Details of Fees to be Paid</td>			
        </tr>

        <tr>
            <td>Regular Fees For the Year<font color="red">*</font></td>
            <td colspan="2">
                <label>1<sup>st</sup> January of </label>&nbsp;&nbsp;<input id="AssignCurrentYear" value="" maxlength="4" />
                <label>&nbsp;&nbsp;to 31<sup>st</sup> December</label>&nbsp;&nbsp;<input id="lic_exp_year" maxlength="4" />
            </td>
            <td>
                <div style="width:250px" class="input-group">
                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                    <input placeholder="RUPEES" type="text" class="form-control f2sumRupees" id="regular_fees" />
                </div>												
            </td>
        </tr>
        <tr>
            <td>Arrear Fees For the Year</td>								
            <td colspan="2">
                <input type="text" class="form-control text-center" id="arrear_fees_details_y1" maxlength="4" style="display: inline-block; width: 100px" /> - 
                <input type="text" class="form-control text-center" id="arrear_fees_details_y2" maxlength="4" style="display: inline-block; width: 100px" />
            </td>								
            <td>
                <div style="width:250px" class="input-group">
                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                    <input type="text" class="form-control f2sumRupees" id="arrear_fees_details_fees" placeholder="RUPEES" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Penalty/other charges</td>
            <td>
                <div style="width:250px" class="input-group">
                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                    <input type="text" class="form-control f2sumRupees" id="penalty_charge" />
                </div>
            </td>
            <td>Total Fees</td>
            <td>
                <div style="width:250px" class="input-group">
                    <div class="input-group-addon"><i class="fa fa-inr" aria-hidden="true"></i></div>
                    <input type="text" id="total_fees" class="form-control" required="required" readonly="readonly" />
                </div>
            </td>
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

<?php //$this->load->view("depts/".$this->dept_code."/form".$this->frm_no."_certificate_approve"); ?>

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
            <td colspan="2">                
                <div class="form-group">
                    <label for="">Upload File (If Any)</label><br>
                    <input type="file" name="reportfile" id="docfile" />
                </div>
            </td>
        </tr>
        <tr>
            <td class="text-center" colspan="4">
                <button type="button" id="btn-verify" class="btn btn-success text-bold">
                    <i class="fa fa-check-circle"></i> Submit
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
            <td colspan="4" class="text-center">
                <a href="<?=base_url('staffs/issuenoc/issue/'.$this->uri->segment(4))?>" class="btn btn-primary" target="_blank" name="noc">Click here to generate NOC</a>
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
    
<link rel="stylesheet" href="<?=base_url('public/css/jquery-ui.css')?>" />
<script type="text/javascript" src="<?=base_url('public/js/jquery-ui.js')?>"></script>
<script type="text/javascript" src="<?=base_url('public/pekeupload/js/pekeUpload.js')?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#docfile").pekeUpload({
            bootstrap: true,
            url: "<?=base_url('upload/')?>",
            data: {file: "reportfile"},
            limit: 1,
            allowedExtensions: "JPG|JPEG|GIF|PNG|PDF|jpg|jpeg|gif|png|pdf|txt"
        });//End of pekeUpload

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
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

           /*  var regularyear_from = $("#regularyear_from").val();
            var regularyear_to = $("#regularyear_to").val(); */
            var lic_exp_year = $("#lic_exp_year").val();
            var regular_fees = $("#regular_fees").val();
            var arrear_fees_details_y1 = $("#arrear_fees_details_y1").val();
            var arrear_fees_details_y2 = $("#arrear_fees_details_y2").val();
            var arrear_fees_details_fees = $("#arrear_fees_details_fees").val();
            var penalty_charge = $("#penalty_charge").val();
            var total_fees = $("#total_fees").val();
            var remarks = $("#remarks_approve").val();
            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/applicationprocess/approve')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    lic_exp_year: lic_exp_year,
                    regular_fees: regular_fees,
                    arrear_fees_details_y1: arrear_fees_details_y1,
                    arrear_fees_details_y2: arrear_fees_details_y2,
                    arrear_fees_details_fees: arrear_fees_details_fees,
                    penalty_charge: penalty_charge,
                    total_fees: total_fees,
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
        
        /*********** FACTORY FEES LOGIC ******/
        $(document).on("focus", "#total_fee", function () {
            var regular_fee = $("#regular_fee").val();
            var arrearyear_fee = $("#arrearyear_fee").val();
            if(regular_fee == "") {
                $("#regular_fee").notify("Please enter an amount!", {position:"top"});
            } else if(arrearyear_fee == "") {
                $("#arrearyear_fee").notify("Please enter an amount!", {position:"left middle"});
            } else {
                var total = parseInt(regular_fee)+parseInt(arrearyear_fee);
                var tot = isNaN(total)?0:total; 
                $(this).val(tot);
            }            
        });
        
        $(document).on("click", "#btn-verify", function () {
            var remarks = $("#remarks_verify").val();
            var dov = $("#date_of_verification").val();
            var reportfile = [$('.uplodedfile').val()]; //alert("reportfile : "+reportfile);
            $.ajax({
                type: "POST",
                url: "<?= base_url('staffs/verificationschedule/schedule') ?>",
                data: { 
                    uain: uain,
                    dov:dov,
                    remarks:remarks,
                    upload_reportfile: reportfile
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $("#rescheduleModal").modal("hide");
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(res, {position: "bottom right"});
                    window.setTimeout(function(){ location.reload(true); }, 2000);
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
                url: "<?=base_url('staffs/rejectedapplications/reject')?>",
                data: { 
                    uain: uain,
                    remarks:remarks,
                    reasons: reasons
                },
                beforeSend: function () {
                    $(".storelandloader-wrapper").fadeIn("slow");
                },
                success: function (res) { //alert(res);
                    $("#rejectModal").modal("hide");
                    $(".storelandloader-wrapper").fadeOut("slow");
                    $.notify(res, {position: "bottom right"});
                    window.setTimeout(function(){ location.reload(true); }, 2000);
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
        /*********** FACTORY FEES LOGIC ******/

	$('.f2sumRupees').on('change', function(){

		var sum = 0;
		$('.f2sumRupees').each(function(){
			if(!isNaN(parseInt($(this).val()))){
				sum = sum + parseInt($(this).val());
			}
			
		});
		$('#f2totalAmount2').val(sum);
		$('#total_fees').val(sum);
	});
	/*********** END ******/
    });
</script>
