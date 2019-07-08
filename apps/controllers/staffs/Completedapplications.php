<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Completedapplications extends Eodbs {
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();        
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->helper("formprocesses");
        $this->load->model("staffs/applicationsir_model");
        $this->load->model("staffs/deptusers_model");
    }
    function index() {
        $this->load->view("staffs/completedapplications_view");
    }//End of index()
}//End of Completedapplications