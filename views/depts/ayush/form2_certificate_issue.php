<?php
$appupRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
$appirRow = $this->applicationsup_model->get_uainrow($this->dept_code, $this->uain);
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
	
		<!--	<tr class="text-bold">
				<td width="25%">Department Name</td> 
				<td width="25%"><?php echo $this->dept_name; ?></td>
				<td width="25%">Jurisdiction</td>
				<td width="25%"><?php echo $area_rights; ?></td>			
	</tr>
	<tr class="text-bold">
				<td>Designation</td>
				<td><?php echo $udesig_name; ?></td>
				<td>Date</td>
				<td><?php echo date("d-m-Y H:i:s");?></td>			
	</tr>-->
	
	<tr class="text-bold">
		<td>License No. :</td>
		<td>
			<input type="text" name="lic_no" class="form-control text-uppercase" id="lic_no" required="required">
		</td>
		<td>Issue Number :</td>
		<td>
			<input type="text" name="issue_number" class="form-control text-uppercase" id="issue_number" required="required">
		</td>
	</tr>					
	<tr class="text-bold">
		<td>Valid From :</td>
		<td>
			<input type="text"  name="valid_from" class="dobindia form-control text-uppercase dp" id="valid_from" required="required">
		</td>
		<td>Valid Upto :</td>
		<td>
			<input type="text" name="valid_upto" class="dobindia form-control text-uppercase dp" id="valid_upto" required="required">
		</td>
	</tr>
	
	
	<!--
        <tr>
            <td>Department Name</td>
            <td><?//=$this->dept_name?></td>
            <td>Office Name</td>
            <td><?//=$office_name?></td>				
        </tr>
        <tr>
            <td>Designation</td>
            <td><?//=$current_userdesignation?></td>
            <td>Date of Issue</td>
            <td><?//=$process_date?></td>			
        </tr>
        <tr>
            <td>File number of authorization : </td>
            <td><input id="file_auth_num" class="form-control text-uppercase" type="text"></td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="4">
                <table class="table table-bordered table-responsive text-left" style="margin:0px auto;border-collapse: collapse" width="100%">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Type of Waste</th>
                            <th>Quantity permitted for Handling</th>
                        </tr>
                        <tr>
                            <th>(1)</th>
                            <th>(2)</th>
                            <th>(3)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="8" valign="top">Yellow</td>
                            <td>(a) Human Anatomical Waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[haw]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(b) Animal Anatomical Waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[aaw]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(c) Soiled Waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[sw]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(d) Expired or Discarded Medicines </td>
                            <td><input class="form-control text-uppercase" name="yellow[edm]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(e) Chemical Solid Waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[csw]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(f) Chemical Liquid Waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[clw]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid </td>
                            <td><input class="form-control text-uppercase" name="yellow[dlm]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>(h) Microbiology, Biotechnology and other clinical laboratory waste </td>
                            <td><input class="form-control text-uppercase" name="yellow[mbc]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>Red</td>
                            <td>Contaminated Waste (Recyclable) </td>
                            <td><input class="form-control text-uppercase" name="red" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>White (Translucent)</td>
                            <td>Waste sharps including Metals </td>
                            <td><input class="form-control text-uppercase" name="white" value="" type="text"></td>
                        </tr><tr>
                            <td rowspan="2">Blue</td>
                            <td>Glassware </td>
                            <td><input class="form-control text-uppercase" name="blue[glass]" value="" type="text"></td>
                        </tr>
                        <tr>
                            <td>Metallic Body Implants </td>
                            <td><input class="form-control text-uppercase" name="blue[mbi]" value="" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </td>
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
           // var file_auth_num = $("#file_auth_num").val();
			var lic_no =  $("#lic_no").val();
			var issue_number =  $("#issue_number").val();
			var valid_from =  $("#valid_from").val();
			var valid_upto =  $("#valid_upto").val();
            
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                 url: "<?=base_url('staffs/issuecertificates/ayush_form2')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                  //  file_auth_num: file_auth_num,
					lic_no: lic_no,
					issue_number: issue_number,
					valid_from: valid_from,
					valid_upto: valid_upto
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
