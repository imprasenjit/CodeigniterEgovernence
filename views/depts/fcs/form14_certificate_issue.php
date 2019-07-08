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
			<tr>
				<td class="text-bold">License No.</td>
				<td><input class="form-control text-uppercase" required="required" id="license_no" name="license_no"/></td>
				<td  class="text-bold"></td>
				<td></td>
	</tr>	
	<tr>
		<td class="text-bold">The licence shall carry on retail business of notified articles at the following place</td>
		<td><input class="form-control text-uppercase" required="required" id="lic_place" name="lic_place"/></td>
		<td class="text-bold"> The notified articles in which the aforesaid business is to be carried on shall not be stored at any place other than the god-owns mentioned below</td>
		<td><input class="form-control text-uppercase" required="required" id="godown_place" name="godown_place"/></td>
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
            var file_auth_num = $("#file_auth_num").val();
            var license_no = $("#license_no").val();
			//var valid_upto = $("#valid_upto").val();
			var lic_place = $("#lic_place").val();
			var godown_place = $("#godown_place").val();
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/fcs_form14')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    file_auth_num: file_auth_num,
					license_no: license_no,
					//valid_upto: valid_upto,
					lic_place: lic_place,
					godown_place: godown_place
					
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