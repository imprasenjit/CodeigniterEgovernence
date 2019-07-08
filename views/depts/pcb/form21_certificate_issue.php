<?php
$appupRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
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
$officeRow = $this->offices_model->get_row($office_id, $this->dept_code);
if($officeRow) {
    $office_name = $officeRow->office_name;
    $jurisdiction = $officeRow->jurisdiction;
} else {
    $office_name = $jurisdiction = "NOT FOUND!";
}//End of if else
$staffRow = $this->deptusers_model->get_row($current_userid, $this->dept_code);
if($staffRow) {
    $current_username = $staffRow->user_name;
    $current_userdesignation = $staffRow->udesig;
} else {
    $current_username = $current_userdesignation = "NOT FOUND!";
}//End of if else
?>
<table id="table-5" style="display:none" class="table table-bordered table-responsive">
    <thead>
        <tr class="info">
            <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE-21</th>
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
            <td><?=$current_userdesignation.$this->frm_no?></td>
            <td>Date of Issue</td>
            <td><?=$process_date?></td>			
        </tr>
        <tr>
            <td>File number of authorization : </td>
            <td colspan="3"><input id="file_no" class="form-control text-uppercase" type="text"></td>
        </tr>
        <tr>
            <td colspan="4">
                <table style="width:100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Authorised</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input id="a1" type="text" /></td>
                            <td><input id="b1" type="text" /></td>
                            <td><input id="c1" type="text" /></td>
                        </tr>
                        <tr>
                            <td><input id="a2" type="text" /></td>
                            <td><input id="b2" type="text" /></td>
                            <td><input id="c2" type="text" /></td>
                        </tr>
                        <tr>
                            <td><input id="a3" type="text" /></td>
                            <td><input id="b3" type="text" /></td>
                            <td><input id="c3" type="text" /></td>
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

<script type="text/javascript">
    $(document).ready(function () {
	$(document).on("click", "#btn-issuecer", function () {
            var file_no = $("#file_no").val();
            var a1 = $("#a1").val();
            var b1 = $("#b1").val();
            var c1 = $("#c1").val();
            
            var a2 = $("#a2").val();
            var b2 = $("#b2").val();
            var c2 = $("#c2").val();
            
            var a3= $("#a3").val();
            var b3 = $("#b3").val();
            var c3 = $("#c3").val();
            
            var auth_details = '{"a":"'+a1+'","b":"'+b1+'","c":"'+c1+'","d":"'+a2+'","e":"'+b2+'","f":"'+c2+'","g":"'+a3+'","h":"'+b3+'","i":"'+c3+'"}';
            //alert(auth_details);
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/pcb_form21')?>",
                data: { 
                    "uain": uain,
                    "form_table":form_table,
                    "form_id":form_id,
                    "file_no": file_no,
                    "auth_details": auth_details
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
    });
</script>
