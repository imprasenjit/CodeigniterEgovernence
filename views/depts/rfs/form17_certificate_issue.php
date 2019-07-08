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
	   <td>License Number</td>
	   		<td><input type="text" class="form-control text-uppercase" name="license_no" id="license_no"/></td>
<td>Valid Upto:</td>
		<td>
			<input type="text" class="dob form-control text-uppercase dp" name="valid_upto" id="valid_upto">
			</td>
	</tr>
		<!--<td>Registration Number</td>
		<td><input type="text" class="form-control text-uppercase" name="regn_no" id="regn_no"/></td>
		<td>Of the year</td>
		<td>
			<input type="text" class="dob_year text-uppercase" name="from_the_year" id="from_the_year">-
			</td>-->
			
	<tr class="text-bold">
	<!--	<td>Date of Filling or Registration</td>
		<td><input type="date" class="form-control text-uppercase dp" name="date_of_filling" id="date_of_filling"/></td>
		<td>Other Place of Business</td>
		<td><textarea type="text" class="form-control text-uppercase" name="other_place" id="other_place"/></textarea></td>
	</tr>-->
	<td>Date of Submission</td>
		<td><input type="date" class="form-control text-uppercase dp" name="sub_date" id="sub_date"/></td>
		</tr>
	<!--<tr class="text-bold">
		<td>Date of Opening or Closing</td>
		<td><input type="date" class="form-control text-uppercase dp" name="date_of_o_n_c" id="date_of_o_n_c"/></td>
		<td>Remarks</td>
		<td><textarea type="text" class="form-control text-uppercase" name="c_remarks" id="c_remarks"/></textarea></td>
	</tr>
	<tr class="text-bold">
		<td>Date of Opening or Closing</td>
		<td><input type="date" class="form-control text-uppercase dp" name="date_of_o_n_c" id="date_of_o_n_c"/></td>
		<td>Remarks</td>
		<td><textarea type="text" class="form-control text-uppercase" name="c_remarks" id="c_remarks"/></textarea></td>
	</tr>-->
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
            var license_no = $("#license_no").val();
			  var valid_upto = $("#valid_upto").val();
			  var sub_date = $("#sub_date").val();
			  
			 // var to_the_year = $("#to_the_year").val();
				//var date_of_filling = $("#date_of_filling").val();
				  //var other_place = $("#other_place").val();
            //  var date_of_o_n_c = $("#date_of_o_n_c").val();
				   // var c_remarks = $("#c_remarks").val();
					
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                 url: "<?=base_url('staffs/issuecertificates/rfs_form17')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
					license_no: license_no,
					valid_upto: valid_upto,
					sub_date: sub_date,
					
          //regn_no: regn_no,
			//from_the_year: from_the_year,
			//to_the_year: to_the_year,
//date_of_filling: date_of_filling,
			//other_place: other_place,
					//date_of_o_n_c: date_of_o_n_c,
				//	c_remarks: c_remarks
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