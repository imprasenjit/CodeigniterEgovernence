<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Editprofile extends Eodbs {
    function index() {
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/utypes_model");
        $this->load->view("staffs/editprofile_view");
    }//End of index()
    
    function save() {
        $swr_id = $this->input->post("swr_id");
        $process_id = $this->input->post("process_id");
        $form_id = $this->input->post("form_id");
        $this->load->model("staffs/process_model");
        $data = array(
            "process_id" => $process_id,
            "form_id" => $form_id,
            "swr_id" => $swr_id
        );
        $this->process_model->edit_row($form_id, $data);
    }//End of save()
}//End of Editprofile