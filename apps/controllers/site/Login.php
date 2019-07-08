<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends Eodb {

    public function index() {
        
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/login/login_view");
        $this->load->view("site/requires/footer");
    }

//End of index()

    public function process() {
        
        $this->load->model("eodbfunctions/getUser_model");
        $this->load->library("form_validation");
        
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid/Empty Input fields!");
            $this->index();
        } else {
            $uname = $this->security->xss_clean($this->input->post("username"));
            $pass = $this->security->xss_clean($this->input->post("password"));
            $this->load->model("site/login_model");
            if ($this->login_model->process($uname, $pass)) {
                redirect(site_url("users/home/"));
            } else {                
                redirect(site_url("site/login"));
            }
           
        } // End of if else
    }

//End of process()

    public function logout() {
        $this->load->model("site/login_model");
        if ($this->login_model->logsupdate()) {
            $data=array(
                "user_id","unit_id","user_uname","user_email","user_phone","user_logid","userlogged","edit_unitid"
            );
            $this->session->unset_userdata($data);
            $this->session->sess_destroy();
            $this->session->set_flashdata("flashMsg", "You have successfully logged out!");
            redirect(site_url("site/login"));
        }
    }

//End of logout()
}

//End of Login