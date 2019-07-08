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
		<td>License no.</td>
		<td><input type="text" class="form-control text-uppercase" name="license_no" id="license_no"></td>
		
		<td>Date of Submission</td>
 <td><input type="date" class="form-control text-uppercase dp" name="sub_date" id="sub_date"></td>
	
	<tr class="text-bold">
		<td>Of the year</td>
		<td>
			<input type="text" class="form-control text-uppercase dp" name="valid_upto" id="valid_upto"></td>
		  </tr>
	<tr class="text-bold"> 
	 <td>License place</td>
		<td><input type="text" class="form-control text-uppercase" name="lic_place" id="lic_place"></td>
		
	 
	 </tr>
	 
	 
	 <!--
<input type="text" class="form-control text-uppercase" name="to_the_year" ></td>
     </td>
		</select> - <select class="dob_year text-uppercase" name="to_the_year" id="to_the_year">
			</select> -->
		
		
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
			var sub_date = $("#sub_date").val();
			var valid_upto = $("valid_upto").val();
			//var lic_exp_year = $("#lic_exp_year").val();
			var lic_place = $("#lic_place").val();
	//var to_the_year = $("#to_the_year").val();
		
			
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
					sub_date: sub_date,
					valid_upto: valid_upto,
					//lic_exp_year: lic_exp_year,
					lic_place: lic_place
					
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
                  //  window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax()
        });
    });
</script>