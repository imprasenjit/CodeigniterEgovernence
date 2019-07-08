<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Publicgrievences extends Eodbs {
    function index() {        
        $this->load->helper("encode");
        $this->load->model("users/users_model");
        $this->load->model("staffs/publicgrivances_model");
        $this->load->view("staffs/publicgrievences_view");
    }//End of index()
    
    function details($id=NULL) {        
        $this->load->helper("encode");
        $this->load->model("users/users_model");
        $this->load->model("staffs/deptusers_model");
        $this->load->model("staffs/publicgrivances_model");
        $this->load->view("staffs/grievencedetails_view");
    }//End of details()
}//End of Publicgrievences