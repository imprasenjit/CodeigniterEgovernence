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
$letters_details = $this->forms_model->get_compliance_report_row($this->dept_code, $this->uain);

//$letters_details = $admin_fetch_functions->executeQuery($dept,"select letter_no,letter_date from compliance_report where uain='$uain' ORDER BY comp_id DESC LIMIT 1");
if ($letters_details) {
	//$letters = $letters_details->fetch_object();
	$letter_no = $letters_details["letter_no"];
	$letter_date = $letters_details["letter_date"];
} else {
	$letter_no = "";
	$letter_date = "";
}

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
		<td>The name(s) of the fire and emergency service station(s) attended :</td>
		<td><textarea name="station_names" id="station_names" class="form-control"></textarea></td>	
		<td>Date and time of receipt of fire call in the Fire and Emergency : </td>
		<td><input type="text" class="form-control dob2"required="required" name="call_date" value="" placeholder="Date"/>
		<input type="" class="form-control mytime" required="required" name="call_time" value="" maxlength="50" placeholder="Time"/></td>				
	</tr>					
	<tr>
		<td>Duration of fire-fighting operation :</td>
		<td><input type="text" class="form-control" required="required" id="duration" name="duration" value="" placeholder=""/></td>	
		<td>Number and type of fire tenders / pumps pressed into service to extinguish the fire :</td>
		<td><textarea name="fire_tenders_used" id="fire_tenders_used" class="form-control"></textarea></td>				
	</tr>
	<tr>
		<td>Fire report no. :</td>
		<td><input type="text" class="form-control" required="required" id="fire_report_no" name="fire_report_no" value="" placeholder=""/></td>	
		<td>Commissioner/S.P/S.D.P.O forwarding no.:</td>
		<td><input type="text" class="form-control" required="required" id="forwarding_no" name="forwarding_no" value="" placeholder=""/></td>				
	</tr>	
	<tr>
		<td>Remarks :</td>
		<td><textarea name="remarks" class="form-control"></textarea></td>	
		<td>&nbsp;</td>
		<td>&nbsp;</td>				
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
            var duration = $("#duration").val();
            var fire_tenders_used = $("#fire_tenders_used").val();
            var fire_report_no = $("#fire_report_no").val();
            var forwarding_no = $("#forwarding_no").val();
            var call_date = $("#call_date").val();
            var call_time = $("#call_time").val();       
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();
			var station_names = 	$("input[name='station_names[]']").map(function(){
								return $(this).val();
							}).get();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/fire_form12')?>",
                data: { 
                    uain:	uain,
                    form_table:	form_table,
                    form_id:	form_id,
                    duration:	duration,
                    fire_tenders_used:	fire_tenders_used,
                    fire_report_no: fire_report_no,
                    forwarding_no: forwarding_no,
					call_date: call_date,
                    call_time: call_time

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
                    //window.setTimeout(function(){ history.go(-1); }, 2000);
                }
            });//End of ajax() 
        });
    });
</script>
