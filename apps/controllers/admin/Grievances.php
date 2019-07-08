<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Grievances extends Eodba {
    function index() {
        $this->load->helper("encode");
        $this->load->model("users/users_model");
        $this->load->model("staffs/publicgrivances_model");
        $this->load->view("admin/grievances_view");
    }//End of index()
    
    function details($id=NULL) {
        $this->load->helper("encode");
        $this->load->model("users/users_model");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/publicgrivances_model");
        $this->load->view("admin/grievencedetails_view");
    }//End of details()
    
    function save() {
        $this->load->model("admin/grievances_model");
        $this->input->post("id");
    }//End of save()
}//End of Grievances