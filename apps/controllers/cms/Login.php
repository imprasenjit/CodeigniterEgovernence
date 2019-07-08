<?php

defined("BASEPATH") OR exit("No direct script access allowed");

class Login extends Eodb {

    public function index() {
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $this->load->view("site/requires/header");
        $this->load->view("cms/login_view");
        $this->load->view("site/requires/footer");
    }

//End of index()

    public function process() {
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
            $this->load->model("cms/login_model");
            if ($this->login_model->process($uname, $pass)) {
                $welcome = "Welcome Mr. " . $this->session->userdata("user_name") . "!";
                $this->session->set_flashdata("flashMsg", $welcome);
	        $goto = ($uname == "cm")?"cm/home":"cms/home";
                redirect(site_url($goto));
            } else {
                $this->session->set_flashdata("flashMsg", "Invalid Username or Password!");
                redirect(site_url("cms/login"));
            }
        } // End of if else
    }

//End of process()

    public function logout() {
        $this->load->model("cms/login_model");
        $this->login_model->logsupdate();
        $data = array(
            "cms_user_id",
            "cms_user_name",
            "cms_logid",
            "cms_userlogged"
        );
        $this->session->unset_userdata($data);
        $this->session->sess_destroy();
        $this->session->set_flashdata("flashMsg", "You have successfully logout!");
        redirect(site_url("cms/login"));
    }

//End of logout()
}

//End of Login
