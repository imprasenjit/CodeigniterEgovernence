<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Cafs extends Eodba {
    function index() {
        $this->load->view("admin/cafs_view");
    }//End of index()
}//End of Cafs