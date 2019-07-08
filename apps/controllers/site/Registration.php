<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends Eodb {
    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");        
    }

    function index() {
        $this->load->model("site/registration_model");
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
        $this->load->view("site/requires/header");
        $this->load->view("site/registration/registration", $data);
        $this->load->view("site/requires/footer");
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


    function checkusername() {
        $this->load->model("site/registration_model");
        $pan = $this->input->get("uname");
        $result = $this->registration_model->checkusername($pan);
        if ($result) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

    function checkemail() {
        $this->load->model("site/registration_model");
        $email = $this->input->get("email");
        $this->load->helper("email");
        if (checkuseremail($email)) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

//End of checkemail()

    function checkmobileno() {
        $this->load->model("site/registration_model");
        $pan = $this->input->get("phone");
        $result = $this->registration_model->checkmobileno($pan);
        if ($result) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
    }

//End of checkmobileno()

    function storeregistration() {
        $this->load->model("site/registration_model");
        $this->load->model("eodbfunctions/address_model");
        $this->registration_model->storeregistration();
    }

//End of storeregistration
    function verifyemail(){
       $this->load->model("site/registration_model");
       $this->load->view("site/requires/header");
       $this->load->view("site/registration/verifyemail");
       $this->load->view("site/requires/footer");
    }

}

//End OF Registration Class
	
