<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Applicationform extends Eodbs {
    function index($frm_id) {
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->model("staffs/Cafs_model");
        $this->load->model("staffs/Queriedapplications_model");
        $this->load->model("staffs/Formprocess_model");
        $this->load->model("staffs/Deptusers_model");
        $this->load->model("staffs/Offices_model");
        
        $this->load->view("staffs/applicationform_view");
    }//End of index()
    
    function save() {
        $app_id = $this->input->post("app_id");
        $swr_id = $this->input->post("swr_id");
        $this->load->model("staffs/applications_model");
        $data = array(
            "app_id" => $app_id,
            "swr_id" => $swr_id
        );
        $this->applications_model->add_row($data);
    }//End of save()
    
    
}//End of Applicationform