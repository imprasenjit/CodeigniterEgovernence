<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Functions extends Eodba {
    function index() {
        $this->load->view("admin/functions_view");
    }//End of index()
}//End of Functions