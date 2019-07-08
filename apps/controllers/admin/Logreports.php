<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Logreports extends Eodba {
    function index() {
        $this->load->view("admin/logreports_view");
    }//End of index()
}//End of Logreports