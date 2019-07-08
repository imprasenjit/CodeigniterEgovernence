<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Eodb {

    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
    }

    function index() {
        $this->load->helper("caf");
        $caf = get_caf($this->session->user_id);
        if ($caf) {
            $this->session->set_userdata("caf_id",$caf->caf_id);
            redirect(base_url("users/unit/"));
        } else {
            redirect(base_url("users/caf/"));
        }
    }

}
