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
        $this->load->view("cm/deptreports_view");
    }//End of index()
}//End of Deptreports