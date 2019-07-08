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
		<td>Compliance Report Number</td>
		<td><input type="text" class="form-control" required="required" id="compl_report_no" name="compl_report_no" value="<?php echo $letter_no; ?>" placeholder=""/></td>	
		<td>Report Date </td>
		<td><input type="text" class="form-control dobindia" required="required" id="compl_report_date" name="compl_report_date" value="<?php echo $letter_date; ?>" placeholder=""/></td>				
	</tr>				
	<tr>
		<td colspan="2">No objection certificate of inbuilt fire fighting/ fire prevention and means of escape measures in </td>
		<td colspan="2"><input type="text" class="form-control" required="required" id="certificate_for" name="certificate_for" value="" placeholder=""/></td>
	</tr>					
	<tr>
		<td colspan="4" class="text-bold">Details of Approved Occupation</td>
	</tr>
	<tr>
		<td colspan="2"><u>GROUND FLOOR</u></td>	
		<td colspan="2"><u>MEZANINE/BASEMENT FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>
	<tr>
		<td colspan="2"><u>FIRST FLOOR</u></td>	
		<td colspan="2"><u>SECOND FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>
	<tr>
		<td colspan="2"><u>THIRD FLOOR</u></td>	
		<td colspan="2"><u>FOURTH FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>
	<tr>
		<td colspan="2"><u>FIFTH FLOOR</u></td>	
		<td colspan="2"><u>SIXTH FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>
	<tr>
		<td colspan="2"><u>SEVENTH FLOOR</u></td>	
		<td colspan="2"><u>EIGHT FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>
	<tr>
		<td colspan="2"><u>NINETH FLOOR</u></td>	
		<td colspan="2"><u>TENTH FLOOR</u></td>	
	</tr>
	<tr>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>1. Floor Area</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
	</tr>	
	<tr>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control occupation_details" name="occupation_details[]" value="" placeholder=""/>
			</div></td>
		<td>2. Purpose of utilisation</td>
		<td><div class="form-group">
				<input type="text" validate="specialChar" class="form-control occupation_details" name="occupation_details[]" value="" placeholder=""/>
			</div></td>			
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
            var compl_report_no = $("#compl_report_no").val();
            var compl_report_date = $("#compl_report_date").val();
            var certificate_for = $("#certificate_for").val();
			//var occupation_details = $(".occupation_details").val();
			
			var occupation_details = 	$("input[name='occupation_details[]']").map(function(){
								return $(this).val();
							}).get();
			
            alert(occupation_details);
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/fire_form1')?>",
                data: { 
                    uain:	uain,
                    form_table:	form_table,
                    form_id:	form_id,
                    compl_report_no:	compl_report_no,
                    compl_report_date:	compl_report_date,
                    certificate_for: certificate_for,
                    occupation_details: occupation_details
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
