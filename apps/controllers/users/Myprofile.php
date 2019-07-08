<?php

/**
 * Description of Myprofile
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Myprofile extends Eodbu {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/address_model");
        $this->load->model("users/unit_model");
    }

    function index() {
        $data = array(
            "title" => "MY PROFILE",
        );
    
        $this->load->view("users/requires/header", $data);
        $this->load->view("users/myprofile/myprofile");
        $this->load->view("users/requires/footer");
    }

    function editmyprofile() {
        $data = array(
            "title" => "EDIT PROFILE",
        );
        $this->load->view("users/requires/header", $data);
        $this->load->view("users/myprofile/editmyprofile");
        $this->load->view("users/requires/footer");
    }

}
