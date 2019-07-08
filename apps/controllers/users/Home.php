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
        if(!isset($this->session->unit_id)){
        $caf = get_caf($this->session->user_id);
        if ($caf) {
            if ($caf->status == 1) {
                $this->session->set_userdata("caf_id", $caf->caf_id);
                redirect(base_url("users/unit/"));
            } else {
                $this->viewcafstatus($caf);
            }
        } else {
            redirect(base_url("users/caf/"));
        }
        }else{
            redirect(base_url("users/dashboard/view/".$this->session->unit_id.""));
        }
    }

    /**
     * 
     * @param type $caf
     */
    function viewcafstatus($caf) {
        $this->load->helper("caf");
        $caf_queries = get_caf_queries($caf->caf_id);
        $this->load->view("users/requires/header", array("title" => "VIEW CAF STATUS"));
        $this->load->view("users/caf/viewcafstatus", array("caf" => $caf, "caf_queries" => $caf_queries));
        $this->load->view("users/requires/footer");
    }

    /**
     * 
     * @param type $caf
     */
    function viewcaf() {
        $this->load->helper("caf");
        $caf = get_caf($this->session->user_id);
        $this->load->view("users/requires/header", array("title" => "VIEW CAF"));
        $this->load->view("users/caf/viewcaf", array("caf" => $caf));
        $this->load->view("users/requires/footer");
    }

    /**
     * 
     */
    function changepassword() {
        $this->load->view("users/requires/header", array("title" => "CHANGE PASSWORD"));
        $this->load->view("users/changepassword/changepassword");
        $this->load->view("users/requires/footer");
    }

    /**
     * 
     */
    function dochangepassword() {
        $user_id = $this->session->user_id;
        $old_password = $this->input->post("old_password");
        $new_password = $this->input->post("password");
        $cnfm_password = $this->input->post("cfmPassword");
        $this->load->helper("password");
        $this->load->helper("users");
        $usr = get_caf_user($user_id);
        if (!empty($new_password) && strlen($new_password) > 6) {
            if (crypt($old_password, $usr->password) == $usr->password) {
                if ($new_password === $cnfm_password) {
                    $data = array(
                        "password" => create_hashed_password($new_password)
                    );
                    $this->load->database();
                    $this->db->where("id", $user_id);
                    $this->db->update("users", $data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata("flashMsg", "Password Changed!");
                        redirect(base_url("users/home/changepassword"));
                    } else {
                        $this->session->set_flashdata("flashMsg", "Something Went Wrong!");
                        redirect(base_url("users/home/changepassword"));
                    }
                } else {
                    $this->session->set_flashdata("flashMsg", "Password and confirm password does not match!");
                    redirect(base_url("users/home/changepassword"));
                }
            } else {
                $this->session->set_flashdata("flashMsg", "Invalid Old Password!");
                redirect(base_url("users/home/changepassword"));
            }
        } else {
            $this->session->set_flashdata("flashMsg", "Please enter a  Password which is more than 6 character long!");
            redirect(base_url("users/home/changepassword"));
        }
    }

    function editcaf() {
        $this->load->model("users/caf_model");
        $this->load->view("users/requires/header");
        $this->load->view("users/caf/editcaf");
        $this->load->view("users/requires/footer");
    }

}
