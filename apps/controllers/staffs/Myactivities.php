<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Myactivities extends Eodbs {
    function index() {          
        $this->load->helper("encode");
        $this->load->helper("formprocesses");
        $this->load->model("staffs/myactivities_model");
        $this->load->view("staffs/myactivities_view");
    }//End of index()
}//End of Myactivities