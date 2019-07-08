<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        District reports
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered table-responsive" id="dtbl">
        <thead>
            <tr>
                <th>Districts</th>
                <th class="text-center">Total Applications</th>
                <th class="text-center">Under process</th>
                <th class="text-center">Approved</th>
                <th class="text-center">Rejected</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if ($this->districts_model->get_rows()) {
                    foreach ($this->districts_model->get_rows() as $rows) {
                        $dist_id = $rows->dist_id;
                        $district = $rows->district;
                        ?>
                            <tr>
                                <td><?=$district?></td>
                                <td style="text-align: center"><?=sprintf("%05d", 0)?></td>
                                <td style="text-align: center"><?=sprintf("%05d", 0)?></td>
                                <td style="text-align: center"><?=sprintf("%05d", 0)?></td>
                                <td style="text-align: center"><?=sprintf("%05d", 0)?></td>
                            </tr>
                        <?php
                    }//End of foreach loop
                }//End of if statement
            ?>
        </tbody>
    </table>
</div>