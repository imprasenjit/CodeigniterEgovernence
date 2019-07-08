<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Caf extends Eodbu {

    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
    }

    function index() {
        $this->session->unset_userdata('uplodedFile');
        $this->session->unset_userdata('finalUplodedFile');
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("users/caf_model");
        $this->load->helper('captcha');
        $vals = array(
            'word' => "",
            'img_path' => './storage/captcha/',
            'img_url' => base_url() . 'storage/captcha/',
            'font_path' => './public/fonts/Verdana.ttf',
            'img_width' => '140',
            'img_height' => 30,
            'expiration' => 7200,
            'word_length' => 5,
            'font_size' => 16,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 89, 245)
            )
        );

        $captcha = create_captcha($vals);
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        $data = array('captchaimage' => $captcha['image']);
        $this->load->view("users/requires/header");
        $this->load->view("users/caf/caf", $data);
        $this->load->view("users/requires/footer");
    }

    public function refreshcaptcha() {
        $this->load->helper('captcha');
        $vals = array(
            'word' => "",
            'img_path' => './storage/captcha/',
            'img_url' => base_url() . 'storage/captcha/',
            'font_path' => './public/fonts/Verdana.ttf',
            'img_width' => '140',
            'img_height' => 30,
            'expiration' => 7200,
            'word_length' => 5,
            'font_size' => 16,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            // White background and border, black text and red grid
            'colors' => array(
                'background' => array(255, 255, 255),
                'border' => array(255, 255, 255),
                'text' => array(0, 0, 0),
                'grid' => array(255, 89, 245)
            )
        );

        $captcha = create_captcha($vals);
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode', $captcha['word']);
        // Display captcha image
        echo $captcha['image'];
    }

    function checkpancard() {
        $this->load->model("users/caf_model");
        $this->load->model("eodbfunctions/getUser_model");
        $pan = $this->input->get("pancard");
        $result = $this->caf_model->checkpancard($pan);
        if ($result) {
            $userdetails = $this->getUser_model->getUserById($result);
            echo json_encode(array("x" => 1, "userID" => $userdetails));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

    function checkusername() {
        $this->load->model("users/caf_model");
        $pan = $this->input->get("uname");
        $result = $this->caf_model->checkusername($pan);
        if ($result) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

    function checkemail() {
        $this->load->model("users/caf_model");
        $email = $this->input->get("email");
        $this->load->helper("email");
        if (checkemail($email)) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

//End of checkemail()

    function checkmobileno() {
        $this->load->model("users/caf_model");
        $pan = $this->input->get("phone");
        $result = $this->caf_model->checkmobileno($pan);
        if ($result) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

//End of checkmobileno()

    function storeregistration() {
        $this->load->model("users/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->storeregistration();
    }

//End of storeregistration


    function getentityfields() {
        $this->load->model("users/caf_model");
        $this->caf_model->getData();
    }

//End of getentityfields()

    function getdistrict() {
        $this->load->model("eodbfunctions/state_model");
        $this->load->model("users/caf_model");

        $this->caf_model->getdistrict();
    }

//End of getdistrict()

    function verifyemail() {
        $this->load->model("users/caf_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/registration/verifyemail");
        $this->load->view("site/requires/footer");
    }

    function storeeditcaf() {
        $this->load->model("users/caf_model");
        $this->load->model("eodbfunctions/address_model");
        $this->caf_model->storeeditcaf();
    }

}

//End OF CAF Class

