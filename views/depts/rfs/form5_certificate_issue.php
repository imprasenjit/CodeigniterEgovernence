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
            <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE</th>
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
        <tr class="text-bold">
		<td>Registration Number</td>
		<td><input type="text" class="form-control text-uppercase" name="reg_number" id="reg_number"/></td>
		<td>Issue Number</td>
		<td><input type="text" class="form-control text-uppercase" name="issue_number" id="issue_number"/></td>		
	</tr>
	<tr class="text-bold">
		<td>Of the year</td>
		<td>
			<input type="text" class="dob_year text-uppercase dp" name="from_the_year" id="from_the_year" readonly="readonly">
			</td> - <td><input type="text" class="dob_year text-uppercase dp" name="to_the_year"  id="to_the_year" readonly="readonly">
			
		</td>
		<td colspan="2"></td>
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
            var reg_number = $("#reg_number").val();
             var issue_number = $("#issue_number").val();
			  var from_the_year = $("#from_the_year").val();
			   var to_the_year = $("#to_the_year").val();
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/rfs_form1')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    reg_number: reg_number,
					issue_number: issue_number,
					from_the_year: from_the_year,
					to_the_year: to_the_year
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