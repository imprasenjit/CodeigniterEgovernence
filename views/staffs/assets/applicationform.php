<?php
$processRow = $this->formprocess_model->get_formrows($this->dept_code, $this->frmtbl, $this->form_id);
$cafRow = $this->cafs_model->get_row($this->swr_id);
if($cafRow) {
    $ubin = $cafRow->ubin;
    $companyName = $cafRow->Name;
    $unit_type = $cafRow->unit_type;
    $unitName = get_unittype($unit_type);
    $b_dist = $cafRow->b_dist;
    $b_block = $cafRow->b_block;
    $companyOwner = $cafRow->Name_of_owner;
}//End of if
?>
<div class="box box-primary box-alm" style="margin-top: 10px;">
    <h3 class="boxalm-head">
        Application form
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="success">
                <th>UBIN</th>
                <th>Enterprise Name</th>
                <th>Enterprise Address</th>
                <th>Unit Type</th>
            </tr>
        </thead>
        <tbody>
            <tr>	
                <td><?=$ubin?></td>
                <td><?=$companyName?>C</td>
                <td><?=$b_dist." ".$b_block?></td>
                <td><?=$unitName?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="box box-primary box-alm">
    <div class="text-center"><h3>Application Form Details</h3></div>
    <div id="formdiv"></div>
</div>

<div class="box box-primary box-alm" id="printcontent1">
    <h3 class="text-center">Actions/Processes</h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="success">
                <th>Date</th>
                <th>Process/Action</th>
                <th>Processed By</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php if($processRow) {
                foreach ($processRow as $rows) {
                    $deptuserRow = $this->deptusers_model->get_row($rows->user_id, $this->dept_code);
                    $staff_name = ($deptuserRow)?$deptuserRow->user_name:"Staff Member";
                    ?>
                    <tr>
                        <td><?=date("d-m-Y", strtotime($rows->p_date))?></td>
                        <td><?=get_process($rows->process_type)?></td>
                        <td><?=$staff_name?></td>
                        <td><?=$rows->remark?></td>
                    </tr>
                <?php }//End of foreach()
            }//End of if ?>
            <tr>
                <td colspan="6" class="text-center">
                    <a href="javascript:history.back(-1)" class="btn btn-primary">
                        <i class="fa fa-chevron-circle-left"></i> Back
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>