<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Login extends Eodb {
    function index() {
		$this->load->model("eodbfunctions/GetSubDepartment_model");
        $this->load->view("staffs/login_view");
    }//End of index()
    
    function process(){
        $this->load->library("form_validation");
        $this->form_validation->set_rules("username", "Username", "required");
        $this->form_validation->set_rules("password", "Password", "required");
        $this->form_validation->set_rules("dept", "Department", "required");
        $this->form_validation->set_error_delimiters("<font class='error animated fadeIn'>", "</font>");      
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata("flashMsg", "Invalid/Empty Input fields!");
            $this->index();
        } else {
            $uname = $this->security->xss_clean($this->input->post("username"));
            $pass = $this->security->xss_clean($this->input->post("password"));
            $dept = $this->security->xss_clean($this->input->post("dept"));
            $this->load->model("staffs/login_model");
            if($this->login_model->process($uname, $pass, $dept)) {
                $welcome = "Welcome Mr. ".$this->session->userdata("name")."!";
                $this->session->set_flashdata("flashMsg", $welcome);
                if($uname == 'admin') {
                    redirect(site_url("admin/home")); 
                } else {
                    redirect(site_url("staffs/home")); 
                }//End of if else                              
            } else {
                $this->session->set_flashdata("flashMsg", "Invalid Username or Password!");
                redirect(site_url("staffs/login"));
            }//End of if else
        }//End of if else
    }//End of process()
        
    function logout(){
        $this->session->unset_userdata("staff_id");
        $this->session->unset_userdata("staff_dept");
        $this->session->unset_userdata("staff_name");
        $this->session->unset_userdata("staff_uname");
        $this->session->unset_userdata("staff_rights");
        $this->session->unset_userdata("stafflogged");
        //$this->session->sess_destroy(); //Destroy all sessions
        $this->session->set_flashdata("flashMsg", "You have successfully logout!");
        redirect(site_url("staffs/login"));
    }//End of logout()
}//End of Login