<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class AddUnit extends Eodbu {
    public function index() {
        $this->isuserLoggedin();
        $this->load->model("users/unit_model");
        $this->load->model("eodbfunctions/GetDistrict_model");
        $this->load->model("users/addUnit_model");
        
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
        $this->load->view("users/addUnit",$data);
        $this->load->view("users/requires/footer",$data);
    }//End of index()
    
    public function save(){
        $this->isuserloggedin();
        
        $this->load->library("form_validation");
        $this->form_validation->set_rules("unit_type", "Type of Unit", "required");
        $this->form_validation->set_rules("add_unit_name", "Unit Name", "required|max_length[150]");
        $this->form_validation->set_rules("street1", "Street Name 1", "required");
        $this->form_validation->set_rules("vill", "Village/Town", "required");
        $this->form_validation->set_rules("dist", "Select District", "required");
        $this->form_validation->set_rules("block", "Select Block or Ward", "required");
        $this->form_validation->set_rules("pincode", "Select Pincode", "required");
        $this->form_validation->set_rules("revenue", "Select Revenue Circle", "required");
        $this->form_validation->set_rules("subdivision", "Select Sub-division", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("errorMsg", "Invalid entry does not match");
            $this->index();
        } else {
            $nowTime = date("Y-m-d H:i:s");
            $user_id = $this->session->user_id;
            $unit_type = $this->input->post("unit_type");
            $add_unit_name = $this->input->post("add_unit_name");
            $vill = $this->input->post("vill");
            $dist = $this->input->post("dist");
            $block = $this->input->post("block");
            $pincode = $this->input->post("pincode");
            $revenue = $this->input->post("revenue");
            $subdivision = $this->input->post("subdivision");
            $is_hazardous = $this->input->post("is_hazardous");
            $data = array(
                "user_id" => $unit_id,
                "sub_date" => $nowTime,
                "fac_situation" => $fac_situation,
                "province" => $province,
                "vill3" => $vill3,
                "dist3" => $dist3,
                "pin3" => $pin3,
                "m_no" => $m_no,
                "n_rail_station" => $n_rail_station,
                "particulars" => $particulars,
                "is_hazardous" => $is_hazardous
            );
            echo "<pre>";
            var_dump($data);
            echo "</pre>";
            die("die here...");
            $this->load->model("forms/factory/form1_model");
            if($form_id ==="") {
                $this->form1_model->add_row($data, $dept_code);
                $msg = "Data has been Successfully Saved!";
            } else {
                $this->form1_model->edit_row($form_id, $data, $dept_code);
                $msg = "Data has been Successfully Updated!";
            } // End of if else
            
            $this->session->set_flashdata("flashMsg", $msg);
            redirect(site_url("forms/factory/form1"));
        }
    }//End of Save
    
    public function get_district_blocks() {
        $this->load->model("users/addUnit_model");
        $district = $this->input->get("district");
        $result = $this->addUnit_model->get_blocks($district);
        echo $result;
    }//End of index()
    
    public function get_district_pincodes() {
        $this->load->model("users/addUnit_model");
        $district = $this->input->get("district");
        $result = $this->addUnit_model->get_pincodes($district);
        echo $result;
    }//End of index()
    
    public function get_district_revenues() {
        $this->load->model("users/addUnit_model");
        $district = $this->input->get("district");
        $result = $this->addUnit_model->get_revenues($district);
        echo $result;
    }//End of index()
    
    public function get_district_subdivisions() {
        $this->load->model("users/addUnit_model");
        $district = $this->input->get("district");
        $result = $this->addUnit_model->get_subdivisions($district);
        echo $result;
    }//End of index()
    
    
}//End of AddUnit
