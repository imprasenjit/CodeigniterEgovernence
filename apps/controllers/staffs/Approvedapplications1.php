<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Approvedapplications extends Eodbs {
    function index() {        
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/approvedapplications_view");
    }//End of index()
}//End of Underprocessedapplications