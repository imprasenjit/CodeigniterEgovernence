<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends Eodbc {
    function index() {
        $this->load->view("cm/home_view");
    }//End of index()
}//End of Welcome
