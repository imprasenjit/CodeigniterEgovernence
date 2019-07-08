<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends Eodba {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("admin/appsreports_model");
        $this->load->model("staffs/applicationsup_model");
        $this->load->helper("encode");
    }//End of __construct()
    
    function index() {
        $this->load->view("admin/home_view");
    }//End of index()
}//End of Home

