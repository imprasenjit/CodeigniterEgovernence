<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Deptreports extends Eodbc {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("admin/appsreports_model");
        $this->load->helper("text");
    }//End of __construct()
    
    function index() {
        $this->load->model("cms/home_model");
        $this->load->view("cms/requires/header", array("title" => "Departmentwise Application Reports"));
        $this->load->view("cms/deptreports_view");
        $this->load->view("cms/requires/footer");
    }//End of index()
}//End of Deptreports