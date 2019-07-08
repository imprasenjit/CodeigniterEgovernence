<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Annualreportsnew extends Eodbs {
    function index() {        
        $this->load->view("staffs/annualreportsnew_view");
    }//End of index()
}//End of Annualreportsnew