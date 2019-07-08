<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Uploadcertificates extends Eodbs {
    function index() {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/uploadcertificates_view");
    }//End of index()
    
    function save() {
        $dept_code = $this->session->staff_dept;
        $uid = $this->session->staff_id;
        $nowTime=date("Y-m-d H:i:s");
        $todayDate=date("Y-m-d");
        $modalids = $this->input->post("modalids");
        $pcs = explode("|||", $modalids);
        $form_table = $pcs[0];
        $form_id = $pcs[1];                
        $this->load->helper("fileupload");
        $files = $this->input->post("uplodedfile");
        $uploades =moveFile(1,$files);        
        $reportfile = $uploades["reportfile"];
        $remarks = $this->input->post("remarks");
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("staffs/formcertifcates_model");
        $dataAddProcess = array(
            "form_id" => $form_id,
            "p_date" => $nowTime,
            "process_type" => "C",
            "user_id" => $uid,
            "file_path" => $reportfile,
            "remark" => $remarks
        );
        
        $dataEditCertificate = array(
            "form_id" => $form_id,
            "upload_date" => $todayDate,
            "save_mode" => "C",
            "user_id" => $uid,
            "file_path" => $reportfile
        );
        $this->formprocess_model->edit_row(array("status"=>0), $dept_code, $form_table, $form_id);
        $this->formprocess_model->add_row($dataAddProcess, $dept_code, $form_table);
        $this->formcertifcates_model->edit_row($dataEditCertificate, $dept_code, $form_table, $form_id);
        $this->forms_model->edit_row(array("active"=>0), $dept_code, $form_table, $form_id);
        //echo "Dept : ".$dept_code.", Tbl : ".$form_table.", ID : ".$form_id."<br />"; print_r($dataAddProcess);
        $this->session->set_flashdata("flashMsg", "Certificate has been successfully uploaded");
        redirect(site_url("staffs/uploadcertificates"));
    }//End of save()
}//End of Uploadcertificates