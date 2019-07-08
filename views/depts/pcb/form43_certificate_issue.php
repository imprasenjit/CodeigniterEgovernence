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
            <th class="text-center text-bold" colspan="4">ISSUE CERTIFICATE-43</th>
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
		<td>File number of authorisation :</td>
		<td><input type="text" class="form-control text-uppercase" id="file_auth_num"/></td>
		
	</tr>
	<tr>
		<td colspan="4">
			<table width="100%" class="table table-bordered table-responsive text-left" style="margin:0px auto;border-collapse: collapse" >
				<thead>
				  <tr>
					<th width="25%">Category</th>
					<th width="25%">Type of Waste</th>
					<th width="25%">Quantity permitted for Handling</th>
				  </tr>
				  <tr>
					<th width="25%">(1)</th>
					<th width="25%">(2)</th>
					<th width="25%">(3)</th>
				  </tr>
				</thead>
				<tbody>
					<tr>
						<td rowspan="8" width="25%" valign="top">Yellow</td>
						<td width="25%">(a) Human Anatomical Waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[haw]" value="<?=$yellow_haw;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(b) Animal Anatomical Waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[aaw]" value="<?=$yellow_aaw;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(c) Soiled Waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[sw]" value="<?=$yellow_sw;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(d) Expired or Discarded Medicines </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[edm]" value="<?=$yellow_edm;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(e) Chemical Solid Waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[csw]" value="<?=$yellow_csw;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(f) Chemical Liquid Waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[clw]" value="<?=$yellow_clw;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(g) Discarded linen, mattresses, beddings contaminated with blood or body fluid </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[dlm]" value="<?=$yellow_dlm;?>"/></td>
					</tr>
					<tr>
						<td width="25%">(h) Microbiology, Biotechnology and other clinical laboratory waste </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="yellow[mbc]" value="<?=$yellow_mbc;?>"/></td>
					</tr>
					<tr>
						<td width="25%">Red</td>
						<td width="25%">Contaminated Waste (Recyclable) </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" id="red" value="<?=$red;?>"/></td>
					</tr>
					<tr>
						<td width="25%">White (Translucent)</td>
						<td width="25%">Waste sharps including Metals </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" id="white" value="<?=$waste_sharp_method;?>"/></td>
					<tr>
						<td rowspan="2" width="25%">Blue</td>
						<td width="25%">Glassware </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="blue[glass]" value="<?=$blue_glass;?>"/></td>
					</tr>
					<tr>
						<td width="25%">Metallic Body Implants </td>
						<td width="25%"><input type="text" class="form-control text-uppercase" name="blue[mbi]" value="<?=$blue_mbi;?>"/></td>
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
            var file_auth_num = $("#file_auth_num").val();
            var yellow = $("#yellow").val();
            var red = $("#red").val();
            var white = $("#white").val();
            var blue = $("#blue").val();
           
           
           
            var uain = $("#uain").val();
            var form_table = $("#form_table").val();
            var form_id = $("#form_id").val();

            $.ajax({
                type: "POST",
                url: "<?=base_url('staffs/issuecertificates/pcb_form43')?>",
                data: { 
                    uain: uain,
                    form_table:form_table,
                    form_id:form_id,
                    file_auth_num: file_auth_num,
                    yellow: yellow,
                    red: red,
                    white: white,
                    blue: blue
                    
                   
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