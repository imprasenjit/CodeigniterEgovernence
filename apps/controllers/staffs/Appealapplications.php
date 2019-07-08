<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Appealapplications extends Eodbs {
    function index() {        
        $this->load->helper("encode");
        $this->load->model("staffs/applicationreports_model");
        $this->load->view("staffs/myapplications_view");
    }//End of index()
}//End of Appealapplications