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
		<td>Registration Date</td>
		<td><input type="text" class="form-control text-uppercase dp" name="reg_date" id="reg_date"/></td>
		<td>Registrar Name</td>
		<td><input type="text" class="form-control text-uppercase" name="reg_name" id="reg_name"/></td>
	</tr>
	<tr class="text-bold">
		<td>Of the year</td>
		<td>
		  <input type="text" class="form-control text-uppercase" name="from_the_year" id="from_the_year"></td>
     <td>
		 <input type="text" class="form-control text-uppercase" name="to_the_year" id="to_the_year"></td>
     </td>
		
		<td>Valid Upto</td>
		<td><input type="text" class="form-control text-uppercase dp" name="valid_upto" id="valid_upto"/></td>
	</tr>
	<tr class="text-bold">
		<td>Validity Extended Upto</td>
		<td><input type="text" class="form-control text-uppercase dobindia" name="validity_extended_upto" id="validity_extended_upto"/></td>
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
			var reg_date = $("#reg_date").val();
			var reg_name = $("#reg_name").val();
			var from_the_year = $("#from_the_year").val();
			var to_the_year = $("#to_the_year").val();
			var valid_upto = $("#valid_upto").val();
			var validity_extended_upto = $("#validity_extended_upto").val();
			
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/rfs_form10')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    reg_number: reg_number,
					issue_number: issue_number,
					reg_date: reg_date,
					reg_name: reg_name,
					from_the_year: from_the_year,
					to_the_year: to_the_year,
					valid_upto: valid_upto,
					validity_extended_upto: validity_extended_upto
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