<?php $processRow = $this->formprocess_model->get_formrows($this->dept_code, $this->frmtbl, $this->form_id); ?>
<div class="box box-primary box-alm">
    <h3 class="text-center">Actions/Processes</h3>
    <table class="table table-bordered table-responsive">
        <thead>
            <tr class="success">
                <th>Date &AMP; Time</th>
                <th>Process/Action</th>
                <th>Processed By</th>
                <th>Designation</th>
                <th>File uploaded</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php if($processRow) {
                foreach ($processRow as $rows) {
                    $deptuserRow = $this->deptusers_model->get_row($rows->user_id, $this->dept_code);
                    if($deptuserRow) {
                        $staff_name = $deptuserRow->user_name;
                        $staff_designation = $deptuserRow->udesig; 
                    } else {
                        $staff_name = $staff_designation = "Not found";                      
                    }
                    $fpath = $rows->file_path;
                    if((strlen($fpath) > 0)) {
                        $fle = '<a href="'.$fpath.'" target="_blank">Download/View File</a>';
                    } else {
                        $fle = "No file uploaded!";
                    }
                    ?>
                    <tr>
                        <td><?=date("d-m-Y h:i A", strtotime($rows->p_date))?></td>
                        <td><?=get_process($rows->process_type)?></td>
                        <td><?=$staff_name?></td>
                        <td><?=$staff_designation?></td>
                        <td><?=$fle?></td>
                        <td><?=$rows->remark?></td>
                    </tr>
                <?php }//End of foreach()
            }//End of if ?>
        </tbody>
    </table>
</div>