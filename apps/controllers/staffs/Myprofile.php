<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Myprofile extends Eodbs {
    function index() {        
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/utypes_model");
        $this->load->model("staffs/offices_model");
        $this->load->helper("userrights");
        $this->load->view("staffs/myprofile_view");
    }//End of index()
}//End of Myprofile