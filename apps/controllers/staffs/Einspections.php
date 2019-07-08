<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Einspections extends Eodbs {
    function index() {
        $this->load->model("staffs/einspectionassigned_model");
        $this->load->model("users/unit_model");
        $this->load->view("staffs/einspections_view");
    }//End of index()
    
    function getInspectionDetails() {
        $inspection_id = $this->input->post("inspection_id");
        $this->load->model("staffs/einspectionassigned_model");
        $this->load->model("staffs/einspections_model");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("users/unit_model");
        if ($this->einspectionassigned_model->get_row($inspection_id)) {
            $row = $this->einspectionassigned_model->get_row($inspection_id);
            $inspection_id = $row->inspection_id;
            $einspection_id = $row->einspection_id;
            if($this->einspections_model->get_row($einspection_id)) {
                $last_inspection_dt = $this->einspections_model->get_row($einspection_id)->last_inspection_date;
            } else {
                $last_inspection_dt = "Date not found!";
            }//End of if else
            $ubin = $row->ubin;
            if($this->unit_model->get_unitbyubin($ubin)) {
                $unit = $this->unit_model->get_unitbyubin($ubin);
                $entp_name = $unit->Name;
                $b_dist = $unit->b_dist;
                $b_block = $unit->b_block;
                $b_pincode = $unit->b_pincode;
                $address = $b_dist . ", " . $b_block . "-" . $b_pincode;
            } else {
                $entp_name = $address = "Not found!";
            }//End of if else

            $inspection_date = $row->inspection_date;
            $inspector_id = $row->inspector_id;
            $dept_code = $this->session->staff_dept;
            if($this->deptusers_model->get_row($inspector_id, $dept_code)) {
                $deptusers = $this->deptusers_model->get_row($inspector_id, $dept_code);
                $inspector_name = $deptusers->user_name;
            } else {
                $inspector_name = "Not Found!";
            }//End of if else
            $reschedule_date = $row->reschedule_date;
            $reschedule_reason = $row->reschedule_reason;
        } ?>
        <table class="table">
            <tbody>
                <tr>
                    <td>Enterprise Name</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=$entp_name?></td>
                </tr>
                <tr>
                    <td>UBIN No.</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=$ubin?></td>
                </tr>
                <tr>
                    <td>Last Inspection On</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=date("d-m-Y", strtotime($last_inspection_dt))?></td>
                </tr>
                <tr>
                    <td>Inspector Assigned</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=$inspector_name?></td>
                </tr>
                <tr>
                    <td>Current Inspection Date</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=date("d-m-Y", strtotime($inspection_date))?></td>
                </tr>
                <tr>
                    <td>Communication Address</td>
                    <td style="width: 40px; text-align: center"><strong>:</strong></td>
                    <td><?=$address?></td>
                </tr>
                <?php if ($reschedule_date !== "0000-00-00") { ?>
                    <tr>
                        <td>Reschedule Date</td>
                        <td style="width: 40px; text-align: center"><strong>:</strong></td>
                        <td><?=$reschedule_date?></td>
                    </tr>
                    <tr>
                        <td>Reschedule Reason</td>
                        <td style="width: 40px; text-align: center"><strong>:</strong></td>
                        <td><?=$reschedule_reason?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php }//End of getInspectionDetails()
    
    function reportupload() {
        $this->load->helper("fileupload");
        $inspection_id = $this->input->post("inspectionid");
        $files = $this->input->post("uplodedfile");
        $uploades =moveFile(1,$files);        
        $reportfile = $uploades["reportfile"];
        $remarks = $this->input->post("remarks"); //die($inspection_id." ::: ".$reportfile." ::: ".$remarks);
        $this->load->model("staffs/einspectionassigned_model");
        $this->einspectionassigned_model->edit_row($inspection_id, array("inspection_report"=>$reportfile));
        $this->session->set_flashdata("flashMsg", "Inspection has been successfully uploaded");
        redirect(site_url("staffs/einspections"));
    }//End of reportupload()
    
    function reschedule() {
        $this->load->helper("fileupload");
        $inspection_id = $this->input->post("einspectionId");
        $reschedule_date = $this->input->post("reschedule_date");
        $dt = (strlen($reschedule_date)==0)?NULL:date("Y-m-d", strtotime($reschedule_date));
        $reschedule_reason = $this->input->post("reschedule_reason"); //die($inspection_id." ::: ".$reschedule_date." ::: ".$reschedule_reason);
        $this->load->model("staffs/einspectionassigned_model");
        $this->einspectionassigned_model->edit_row($inspection_id, array("reschedule_date"=>$dt, "reschedule_reason"=>$reschedule_reason));
        $this->session->set_flashdata("flashMsg", "Inspection has been successfully rescheduled!");
        redirect(site_url("staffs/einspections"));
    }//End of reschedule()
}//End of Einspections