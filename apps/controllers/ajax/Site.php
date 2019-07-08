<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends Eodb {

    function __construct() {
        parent::__construct();
    }

//End of __construct()

    function get_district_of_state() {
        $state=$this->input->post("state");
        $this->load->helper("address");
        $result=get_district_by_state($state);
        foreach ($result as $row) {
            echo '<option value="' . $row->dist_id . '">' . $row->dist_name . '</option>';
        }        
    }

}
