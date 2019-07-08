<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Annualreportsrecorded extends Eodbs {
    function index() {        
        $this->load->view("staffs/annualreportsrecorded_view");
    }//End of index()
}//End of Annualreportsrecorded