<?php
defined("BASEPATH") OR exit("No direct script access allowed!");
class Error404 extends Eodb {
    public function index() {
        $this->load->view("site/error404_view");
    }//End of index()
}//End of Error404