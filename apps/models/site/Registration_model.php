<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Registration_model extends CI_Model {

    function checkusername($value) {
        $this->load->database();
        $this->db->select("username");
        $this->db->from("users");
        $this->db->where("username", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return true;
        } else {
            $this->db->close();
            return false;
        }
    }

//End of checkusername()
    /**
     * 
     * @param type $value
     * @return boolean
     */
    function checkmobileno($value) {
        $this->load->database();
        $this->db->select("phone");
        $this->db->from("users");
        $this->db->where("phone", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return true;
        } else {
            $this->db->close();
            return false;
        }
    }

//End of checkmobileno()

    /**
     * 
     */
    function storeregistration() {
        $error = 1;
        //Registration Informations    
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $mobile = $this->input->post("phone");
        $password = $this->input->post("password");
        $captcha = $this->input->post("captcha");
        $this->load->helper("email");
        if (empty($this->session->captchaCode) || $this->session->captchaCode != $captcha) {
            $error = "Captcha Does not match!";
        } else if (empty($name)) {
            $error = "Please enter name";
        } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error = "Only letters and white space allowed";
        } else if (empty($email)) {
            $error = "Please Enter Your Email ID";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email is not a valid email address";
        } else if (checkuseremail($email)) {
            $error = "Email already exists! Please use different Email.";
        } else if (empty($mobile)) {
            $error = "Please Enter Your Email ID";
        } else if (!preg_match("/^\d{10}$/", $mobile)) {
            $error = "Please Enter a valid 10 digits mobile number.";
        } else if ($this->checkmobileno($mobile)) {
            $error = "Mobile number already exists!";
        } else if (empty($password)) {
            $error = "Please enter a password.";
        } else if (strlen($password) < 6) {
            $error = "Please enter a valid six character password.";
        } else {
            $error = 1;
        }

        $today = date("Y-m-d H:i:s");
        if ($error == 1) {
            $salt = uniqid("", true);
            $algo = "6";
            $rounds = "5050";
            $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
            $hashedPassword = crypt($password, $cryptSalt);
            $this->load->helper("userinfo");
            $this->load->database();
            $remoteip = get_ip();
            $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $mobile,
                'password' => $hashedPassword,
                'registered_on' => $today,
                'user_ip' => $remoteip
            );
            $this->db->insert('users', $data);
            $id = $this->db->insert_id();
            $veryfy_link = store_email($email);
            if ($this->db->affected_rows() > 0 && $veryfy_link) {
                $sub = "EODB Email Verification Code";
                $msgBody = "Dear " . $name . ",<br><br>Your account has been created successfully.<br>Your Email verification otp is : ".$veryfy_link." . <br>OR Please click on the link below to verify your email.<br><br><a href='" . base_url() . "site/registration/verifyemail/?tag=" . $veryfy_link . " '>Click Here verify your email.</a><br>If you did not register and you have received this email, Please contact us at eodb.assam@gmail.com or call us at +91-7086044425 immediately.";
                $this->load->helper("sendmail");
                sendmail($email, $sub, $msgBody);
                echo json_encode(array("x" => 1, "info" => "<span style='color:green;'>Please check your Mobile number - <b>+91 " . $mobile . "</b> and Email - <b>" . $email . "</b>.The 6 digits One Time Password (OTP) has been sent to your mobile number and the Email Verification Code has been sent to your primary inbox, however if the email is not received kindly check your updates or spam/junk folder in your email account. </span>"));
            } else {
                echo json_encode(array("x" => 0, "error" => $error));
            }
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }
    
  /**
   * 
   * @return boolean
   */  
    function verifyemail() {
        $tag = $this->input->get('tag');
        $this->load->database();
        $this->db->select("id");
        $this->db->from("users");
        $this->db->where("email_verify_link", $tag);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->load->database();
            $this->db->set("email_verify_link", "verified");
            $this->db->set("active", "1");
            $this->db->update("users");
            return true;
        } else {
            return false;
        }
    }

}
