<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Inbox extends Eodbu {
    function __construct() {
        parent::__construct();
        $this->load->model("users/unit_model");

    }//End of constructor
    public function index() {
        $this->isuserLoggedin();
        $unit_id = $this->session->unit_id;
        $user_id = $this->session->user_id;
        $ubin_details = $this->unit_model->get_row($unit_id);        
        $notifications=$this->unit_model->get_notifications($unit_id);
        if($notifications) $total_notifications=count($notifications);
        else $total_notifications=0;
        $data = array(
            "user_id" => $user_id,
            "unit_id" => $unit_id,
            "ubin_details" => $ubin_details,
            "total_notifications" => $total_notifications
        );
        $this->load->view("users/requires/header",$data);
        $this->load->view("users/inbox",$data);
        $this->load->view("users/requires/footer",$data);
    }//End of index()
    
    
}//End of Inbox
