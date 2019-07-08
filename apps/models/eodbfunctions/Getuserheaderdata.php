<?php
if (!defined("BASEPATH"))
    exit("No direct script access allowed");
class Getuserheaderdata extends CI_Model {
    function header_data() {
        $this->load->model("users/unit_model");
        $unit_id = $this->session->unit_id;
        $user_id = $this->session->user_id;
        $ubin_details = $this->unit_model->get_row($unit_id);        
        $notifications=$this->unit_model->get_notifications($unit_id);
        if($notifications) $total_notifications=count($notifications);
        else $total_notifications=0;
        $header_data = array(
            "user_id" => $user_id,
            "unit_id" => $unit_id,
            "ubin_details" => $ubin_details,
            "total_notifications" => $total_notifications
        );
        return $header_data;
    }//End of header_data
}//End of Getuserheaderdata		