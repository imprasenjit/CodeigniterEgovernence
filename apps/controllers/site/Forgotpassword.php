<?php

/**
 * Description of Forgotpassword
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends Eodb {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->load->model("eodbfunctions/getDepartments_model");
        $this->load->model("eodbfunctions/getSubDepartment_model");
    }

    function index() {
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
        $this->load->view("site/forgotpassword/forgotpassword", $data);
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

// End of refreshcaptcha()

    function sendresetpasswordlink() {
        $this->load->model("site/registration_model");
        $this->load->model("eodbfunctions/getUser_model");
        $this->load->model("site/forgotpassword_model");
        $this->forgotpassword_model->sendresetpasswordlink();
    }

// End of sendresetpasswordlink()

    function changepassword() {
        $this->load->model("site/forgotpassword_model");
        $this->load->view("site/requires/header");
        $this->load->view("site/forgotpassword/changepassword");
        $this->load->view("site/requires/footer");
    }
// End of changepassword()
    
    function storechangedpassword(){
       $this->load->model("site/forgotpassword_model");
       $this->forgotpassword_model->storechangedpassword();
    }
}
