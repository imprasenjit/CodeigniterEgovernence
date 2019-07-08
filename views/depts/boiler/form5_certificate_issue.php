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
		
	<!--	<td><b>Valid Upto</b></td>
		<td>
			<input type="text"  name="lic_exp_year" required="required" id="lic_exp_year" class="dobindia form-control"/>
		</td>			
	</tr>		
	<tr>	-->
 
            <td>IBS number : </td>
            <td><input id="ibs_no" class="form-control text-uppercase" type="text"></td>
            <td colspan="2"></td>
        
	
		
		<td><b>Maximum Continuous Evaporation :</b></td>
		<td><div class="form-group">
			<input type="text" id="max_evaporation" name="max_evaporation" required="required" class="form-control"/>
		</div></td>
	</tr>		
				
	<tr>
		<td><b>Repairs :</b></td>
		<td>
			<div class="form-group">
				<input type="text" id="repairs" name="repairs" class="form-control">
			</div>
		</td>
		<td><b>Remarks </b></td>
		<td><div class="form-group"><textarea name="remarks" id="remarks" class="form-control classy-editor text-uppercase" id="for_remerk" style="" placeholder="Your Remarks"></textarea></div></td>
	</tr>
	<tr>
		<td colspan="4"><b>Hydraulically Tested on :</b> <input type="text" id="tested_on" required="required" name="tested_on"/> <b>to</b> <input type="text" name="ibs_no" required="required"/> <b>Kg/cm<sup>2</sup></b></td>
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
            var ibs_no = $("#ibs_no").val();
       //     var valid_from = $("#valid_from").val();
			//var valid_upto = $("#valid_upto").val();
					
			var max_evaporation = $("#max_evaporation").val();
			
			var repairs = $("#repairs").val();
			var remarks = $("#remarks").val();
			var tested_on = $("#tested_on").val();
			
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
               url: "<?=base_url('staffs/issuecertificates/boiler_form1')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    ibs_no: ibs_no,
					//valid_upto: valid_upto,
					max_evaporation: max_evaporation,
					repairs: repairs,
					remarks: remarks,
					tested_on: tested_on,
					//loading_of: loading_of
					
					
					
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
