<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Usermanual extends Eodbs {
    function index() {
        $this->load->view("staffs/usermanual_view");
    }//End of index()
}//End of Usermanual