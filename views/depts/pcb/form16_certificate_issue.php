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
            <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE-1</th>
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
            <td>Date of Issue</td>
            <td><?=$process_date?></td>			
        </tr>
        <tr>
		<td>Authorisation Number:</td>
		<td><input type="text" class="form-control text-uppercase" id="auth_no"/></td>
		<td>Valid Upto</td>
		<td><input type="date" class="dobindia form-control text-uppercase" id="valid_upto"/></td>
	</tr>
	<tr>
		<td>Quanitity Of E-waste :</td>
		<td><input type="text" class="form-control text-uppercase" id="e_quantity"/></td>
		<td>Nature of E-waste :</td>
		<td><input type="text" class="form-control text-uppercase" id="e_nature"/></td>
	</tr>
	<tr>
		<td>E-waste dispase of in a manner :</td>
		<td><input type="text" class="form-control text-uppercase" id="e_manner"/></td>
		<td>E-waste treated at :</td>
		<td><input type="text" class="form-control text-uppercase" id="e_treated_at"/></td>
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
            var auth_no = $("#auth_no").val();
            var valid_upto = $("#valid_upto").val();
            var e_quantity = $("#e_quantity").val();
            var e_nature = $("#e_nature").val();
            var e_manner = $("#e_manner").val();
            var e_treated_at = $("#e_treated_at").val();
           
           
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/pcb_form13')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    auth_no: auth_no,
                    valid_upto: valid_upto,
                    e_quantity: e_quantity,
                    e_nature: e_nature,
                    e_manner: e_manner,
                    e_treated_at: e_treated_at
                   
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