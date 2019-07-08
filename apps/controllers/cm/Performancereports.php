<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Performancereports extends Eodbc {
    function __construct() {
        parent::__construct();
        $this->load->model("staffs/subdepartments_model");
        $this->load->model("cm/performancereports_model");
        $this->load->helper("text");
    }//End of __construct()
    
    function index() {
        $this->load->view("cm/performancereports_view");
    }//End of index()
    
    function dept($dept=NULL) {
        $this->load->view("cm/performancedept_view");
    }//End of dept()
}//End of Performancereports