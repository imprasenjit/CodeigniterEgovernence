<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Myapplications extends Eodbs {
    function __construct() {
        parent::__construct();
        $this->load->helper("encode");
        $this->load->model("staffs/applicationsup_model");
    }
    function index() {
        $this->load->model("staffs/forms_model");
        $this->load->model("staffs/subdepartments_model");
        $this->load->view("staffs/myapplications_view");
    }//End of index()
}//End of Myapplications