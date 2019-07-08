<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Deptperformances extends Eodbc {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("cm/performancereports_model");
        $this->load->helper("text");
    }//End of __construct()
    
    function index() {
        $this->load->view("cm/deptperformances_view");
    }//End of index()
}//End of Deptperformances