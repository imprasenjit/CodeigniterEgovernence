<?php

/**
 * Description of Users
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Eodbc {

    function __construct() {
        parent::__construct();
        $this->load->model("cms/users_model");
    }

//End of __construct()

    function index() {
        $this->load->view("cms/requires/header", array("title" => "Verified Users"));
        $this->load->view("cms/users/verifiedusers");
        $this->load->view("cms/requires/footer");
    }

    function view($id) {
        $data=array(
            "user"=>$this->users_model->get($id)
        );
        $this->load->view("cms/requires/header", array("title" => "View Users"));
        $this->load->view("cms/users/viewuser",$data);
        $this->load->view("cms/requires/footer");
    }
    
    function edit($id) {
        $data=array(
            "user"=>$this->users_model->get($id)
        );
        $this->load->view("cms/requires/header", array("title" => "EDIT Users"));
        $this->load->view("cms/users/edituser",$data);
        $this->load->view("cms/requires/footer");
    }

    function unverified() {
        $this->load->view("cms/requires/header", array("title" => "Verified Users"));
        $this->load->view("cms/users/unverifiedusers");
        $this->load->view("cms/requires/footer");
    }

    function getverifiedusers() {
        $this->users_model->getverifiedusers();
    }

    function getunverifiedusers() {
        $this->users_model->getunverifiedusers();
    }

    function generatelink() {
        $email_id=$this->input->post("email");
        $this->load->helper("email");
        if (!verify_email($email_id)) {
            $email = get_email($email_id);
            if($email->email_verify_code!='NULL'){
            echo '<h3>Email Verification code is '.$email->email_verify_code.'</h3>';
            }
            else{
                $this->load->database();
                $email_verify_tag = mt_rand(10000000, 99999999);
                $data=array(
                "email_verify_code"=>  $email_verify_tag,
                "verification_status"=>"0"                  
                );
                $this->db->where("email", $email_id);
                $this->db->update("emails",$data);
                echo '<h3>Email Verification code is '.$email_verify_tag.'</h3>';
            }
        }
    }
    
    function action_edituser(){
        $this->users_model->update_user();
        
    }

}
