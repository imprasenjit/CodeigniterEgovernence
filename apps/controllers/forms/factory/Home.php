<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Home extends Eodb {
    public function index() {
        $this->load->view("forms/factory/home_view");
    }//End of index()
}//End of Home
