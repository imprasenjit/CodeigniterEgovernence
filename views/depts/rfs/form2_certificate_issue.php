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
		<td><input type="text" class="form-control text-uppercase" name="regn_no" id="regn_no"/></td>
		<td>Of the year</td>
		<td>
			<input type="text" class="dob_year text-uppercase dp" name="from_the_year" id="from_the_year" readonly="readonly">
			</td> <td> <input type="text" class="dob_year text-uppercase dp" name="to_the_year" id="to_the_year" readonly="readonly">
			
		</td>
	</tr>
	<tr class="text-bold">
		<td>Date of Filling or Registration</td>
		<td><input type="text" class="form-control text-uppercase dobindia dp" name="date_of_filling" id="date_of_filling"/></td>
		<td>Nature of business</td>
		<td><input type="text" class="form-control text-uppercase" name="c_business_nature" id="c_business_nature"/></td>
	</tr>
	<tr class="text-bold">
		<td>Date of Opening or Closing</td>
		<td><input type="text" class="form-control text-uppercase dobindia dp" name="date_of_o_n_c" id="date_of_o_n_c"/></td>
		<td>Alteration in the name of the firm</td>
		<td><input type="text" class="form-control text-uppercase" name="alter_name" id="alter_name"/></td>
	</tr>
	<tr class="text-bold">
		<td>Alteration in the Principal Place of Business</td>
		<td><textarea id="alter_principal_place" class="form-control text-uppercase" name="alter_principal_place" /></textarea></td>
		<td>Alteration in the Address of any other place where the Firms carries its business</td>
		<td><textarea id="alter_other_place" class="form-control text-uppercase" name="alter_other_place" /></textarea></td>
	</tr>
	<tr class="text-bold">
		<td>Remarks</td>
		<td><textarea type="text" class="form-control text-uppercase" name="c_remarks" id="c_remarks"/></textarea></td>
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
            var regn_no = $("#regn_no").val();
             var from_the_year = $("#from_the_year").val();
			  var to_the_year = $("#to_the_year").val();
			   var date_of_filling = $("#date_of_filling").val();
			    var c_business_nature = $("#c_business_nature").val();
				 var date_of_o_n_c = $("#date_of_o_n_c").val();
				 var alter_name = $("#alter_name").val();
				 var alter_principal_place = $("#alter_principal_place").val();
				 var alter_other_place = $("#alter_other_place").val();
				  var c_remarks = $("#c_remarks").val();
				 
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/rfs_form2')?>",

                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    regn_no: regn_no,
					from_the_year: from_the_year,
					to_the_year: to_the_year,
					date_of_filling: date_of_filling,
					c_business_nature: c_business_nature,
					date_of_o_n_c: date_of_o_n_c,
					alter_name: alter_name,
					alter_principal_place: alter_principal_place,
					alter_other_place: alter_other_place,
					c_remarks: c_remarks
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
