<?php
$dept_code = $this->session->staff_dept; 
if ($this->session->flashdata("flashMsg")) { ?>
        <script>$.notify("<?= $this->session->flashdata("flashMsg"); ?>", "error");</script>
<?php } ?>
<div class="box box-primary box-alm">
    <h3 class="boxalm-head">
        E-inspections
        <a href="javascript:history.back(-1)" class="btn btn-default backbtn-alm">
            <i class="fa fa-chevron-circle-left"></i> Back
        </a>
    </h3>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td>
                    From date :
                    <input class="form-control dp" type="text" />
                </td>
                <td>
                    To date :
                    <input class="form-control dp" type="text" />
                </td>
                <td>
                    Risk :
                    <select name="risk_id" class="form-control">
                        <option value="">Select</option>
                        <option value="1">High</option>
                        <option value="2">Medium</option>
                        <option value="3">Low</option>
                    </select>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table table-bordered table-responsive" id="appstbl">
        <thead>
            <tr>
                <th style="text-align: center">Sl. No.</th>                    
                <th>Date of Inspection</th>
                <th>Enterprise Name</th>
                <th>UBIN</th>
                <th style="text-align: center">Details</th>
                <th style="text-align: center">Submit Report</th>
                <th style="text-align: center">Re-Schedule</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if($this->einspectionassigned_model->get_rows()) {
            $sl = 1;
            foreach ($this->einspectionassigned_model->get_rows() as $rows) {
                $inspection_id = $rows->inspection_id;
                $einspection_id = $rows->einspection_id;
                $inspector_id = $rows->inspector_id;
                $inspection_date = $rows->inspection_date;
                $reschedule_date = $rows->reschedule_date;
                $inspection_report = $rows->inspection_report;
                $ubin = $rows->ubin;
                $risk = $rows->risk;
                if($this->unit_model->get_unitbyubin($ubin)) {
                    $unit = $this->unit_model->get_unitbyubin($ubin);
                    $entp_name = $unit->Name;
                } else {
                    $entp_name = "Not found!";
                }
                $ids = $einspection_id."-".$ubin."-".$inspector_id."-".$risk;
                ?>
                <tr>
                    <td style="text-align: center"><?=sprintf("%02d", $sl)?></td>
                    <td><?= date("d-m-Y", strtotime($inspection_date))?></td>
                    <td><?= $entp_name?></td>
                    <td><?= $ubin?></td>
                    <td style="text-align: center">
                        <button class="btn btn-default" data-toggle="modal" data-target="#inspectionViewModal" id="<?= $inspection_id?>">
                            <i class="fa fa-folder-open"></i> View
                        </button>
                    </td>
                    <td style="text-align: center">
                        <?php if (is_null($inspection_report)) { ?>
                            <button class="btn btn-info" data-toggle="modal" data-target="#inspectionUploadModal" id="<?=$inspection_id?>">
                                <i class="fa fa-upload"></i> Upload
                            </button>
                        <?php } else { ?>
                            <a href="<?=$inspection_report?>" class="btn btn-warning" target="_blank">
                                <i class="fa fa-download"></i> Download
                            </a>
                        <?php } ?> 
                    </td>
                    <td style="text-align: center">
                        <?php if ($reschedule_date == "0000-00-00") { ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#inspectionRescheduleModal" id="<?=$inspection_id?>">
                                <i class="fa fa-calendar"></i> Reschedule
                            </button>
                        <?php } else { ?>
                            <button class="btn btn-default" data-toggle="modal" data-target="#inspectionViewModal" id="<?=$inspection_id?>">
                                <?=$reschedule_date?>
                            </button>
                        <?php } ?>
                    </td>
                </tr>
                <?php $sl++;
            } } else { ?>
                <tr>
                    <td colspan="7" class="text-center">No records found!</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>