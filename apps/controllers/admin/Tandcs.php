<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Tandcs extends Eodba {
    function index() {
        $this->load->view("admin/tandcs_view");
    }//End of index()
}//End of Tandcs