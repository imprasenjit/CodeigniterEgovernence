<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Cpcbreports extends Eodba {
    function index() {
        $this->load->view("admin/cpcbreports_view");
    }//End of index()
}//End of Cpcbreports