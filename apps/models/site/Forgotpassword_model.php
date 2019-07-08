<?php

/*
 * Page created by Developers of Avantika Innovations PVT LTD
 *  
 */


if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Forgotpassword_model extends CI_Model {

    function sendresetpasswordlink() {
        $email = $this->input->post("email");
        $captcha = $this->input->post("captcha");
        $error = 1;
        if (empty($this->session->captchaCode) || $this->session->captchaCode != $captcha) {
            $error = "Captcha Does not match!";
        } else if (empty($email)) {
            $error = "Please Enter Your Email ID";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email is not a valid email address";
        } else if (!$this->registration_model->checkemail($email)) {
            $error = "Email Does not exists!";
        } else {
            $error = 1;
        }

        if ($error == 1) {
            $email_verify_link = mt_rand(10000000, 99999999);
            $this->load->database();
            $this->db->set('password_reset', $email_verify_link);
            $this->db->where('email', $email);
            $query = $this->db->update('users');
            if ($this->db->affected_rows() > 0) {
                $user = $this->getUser_model->getUserById($email, 'email');
                $sub = "EODB - Change Password";
                $msgBody = "Dear " . $user["name"] . " ,<br/>
			<ol>
				<li>Please click the link given below or copy the link in your web browser.</li> 
				<li>Enter New Password. </li>
				<li>Submit.</li>
			</ol>
			<br> <a href='" . base_url() . "site/forgotpassword/changepassword/?tag=" . $email_verify_link . " '>Click Here to change password</a>
			<br> 
			Please note the link will expire after 24 hours. <br/>";
                $this->load->helper("sendmail");
                sendmail($email, $sub, $msgBody);
                $msg = "<span style = 'font-size:18px;color:green'>Don’t Worry!!We have sent you a link in your registered email id - " . $email . ". Log in to your email account and follow the instruction given in the email. Thanks!!!!</span>";
                echo json_encode(array("x" => 1, "info" => $msg));
            }
            $this->db->close();
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }

// End of send password link


    function getuserusingtag($tag) {
        $this->load->database();
        $this->db->select('name,email');
        $this->db->from('users');
        $this->db->where('password_reset',$tag);
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        return $query->row_array();
    }

//End of getuserusingtag()

    function storechangedpassword() {
        $password = $this->input->post("password");
        $tag = $this->input->post("tag");
        $user=$this->getuserusingtag($tag);
        $error = 1;
        if (empty($password)) {
            $error = "Please enter password!";
        } else if (empty($tag)) {
            $error = "Tag not found!";
        } else {
            $error = 1;
        }


        if ($error == 1) {
           
            $salt = uniqid("", true);
            $algo = "6";
            $rounds = "5050";
            $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
            $hashedPassword = crypt($password, $cryptSalt);
            $this->load->database();
            $this->db->set('password', $hashedPassword);
            $this->db->set('password_reset', "");
            $this->db->where('password_reset', $tag);
            $query = $this->db->update('users');
            if ($this->db->affected_rows() > 0) {
                $sub = "EODB Password changed";
                $msgBody = "Dear " . $user["name"] . ",<br><br>Your account password has been changed successfully.If you did not changed your password and you have received this email, Please contact us at eodb.assam@gmail.com or call us at +91-7086044425 immediately.";
                $this->load->helper("sendmail");
                sendmail($user["email"], $sub, $msgBody);
                echo json_encode(array("x" => 1, "info" => "<span style='color:green;'>Password changed successfully!. </span>"));
            } else {
                echo json_encode(array("x" => 0, "error" => "Something went wrong!","dberror"=>""));
            }
            $this->db->close();
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }

}
