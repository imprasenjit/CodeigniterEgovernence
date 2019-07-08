<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Approvedapplications extends Eodbs {
    public $dept_code;
    public $staff_id;
    
    function __construct() {
        parent::__construct();        
        $this->dept_code = $this->session->staff_dept;
        $this->staff_id = $this->session->staff_id;
        $this->load->helper("encode");
        $this->load->helper("formprocesses");
        $this->load->model("staffs/applicationsup_model");
        $this->load->model("staffs/formprocess_model");
        $this->load->model("staffs/deptusers_model");
    }
    function index() {
        $this->load->view("staffs/approvedapplications_view");
    }//End of index()
    
    function index1() {        
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/approvedapplications_view");
    }//End of index()
}//End of Underprocessedapplications