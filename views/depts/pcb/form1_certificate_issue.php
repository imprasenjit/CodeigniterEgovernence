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
            <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE-1</th>
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
			<td>Certificate issued for the year :</td>
			<td><input id="lic_exp_year_from" class="form-control text-uppercase" type="text"></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>	
		</tr>
        <tr>
			<td>Production Capacity :</td>
			<td><input id="production_capacity" class="form-control text-uppercase" type="text"></td>
			<td>Under Section :</td>
			<td>
				<select required="required" class="form-control" id="act">
					<option value="0">Please select one option</option>
					<option value="1" >21 of Air (Prevention and Control of Pollution ) Act, 1981</option>
					<option value="2" >25 of Water (Prevention and Control of Pollution ) Act, 1974 as Amended</option>
					<option value="3" >Both 21 of Air Act, 1981 and 25 of Water Act, 1974 as Amended</option>
				</select>
			</td>	
		</tr>
		<tr>
			<td>Validity date :</td>
            <td><input id="valid_date" class="text-uppercase form-control dobindia"  type="date"></td>
          
			
			<td>Industry Type :</td>
			<td><input type="text" value="" class="form-control text-uppercase" id="industry_category"/></td>
		</tr> 
	
		<tr>
			<td>Number of Authorization</td>
			<td><input id="auth_no" type="text" class="text-uppercase form-control approveAppField" name="auth_no" placeholder=""/></td>
			<td>Terms and Conditions</td>
			<td><textarea type="text" class="form-control" id="terms" placeholder="Please write terms and conditions here"></textarea></td>
		</tr>
		<tr>
			<td colspan="4">
				<table width="50%" align="center" class="table table-bordered table-responsive text-center" style="border-collapse: collapse" border="1">			
					<thead>
						<tr>
							<th width="5%" align="center">Sl No</th>
							<th width="25%" align="center">Category of Hazardous Waste as per the Schedules I, II and III of these rules</th>
							<th width="25%" align="center">Authorised mode of disposal or recycling or utilisation or co-processing, etc.</th>
							<th width="20%" align="center">Quantity(ton/annum)</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[a]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[b]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[c]" placeholder=""/></td>
						</tr>
						<tr>
							<td>2</td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[d]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[e]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[f]" placeholder=""/></td>
						</tr>
						<tr>
							<td>3</td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[g]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[h]" placeholder=""/></td>
							<td><input type="text" class="text-uppercase form-control" name="auth_details[i]" placeholder=""/></td>
						</tr>
					</tbody>
				</table>
			</td>
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
            var lic_exp_year_from = $("#lic_exp_year_from").val();
            var production_capacity = $("#production_capacity").val();
            var act = $("#act").val();
            var valid_date = $("#valid_date").val();
            var industry_category = $("#industry_category").val();
            var auth_no = $("#auth_no").val();
            var terms = $("#terms").val();
            
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/pcb_form1')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    lic_exp_year_from: lic_exp_year_from,
                    production_capacity: production_capacity,
                    act: act,
                    valid_date: valid_date,
                    industry_category: industry_category,
                    auth_no: auth_no,
                    terms: terms
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