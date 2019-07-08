<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Login_model extends CI_Model {

    public function get_uid($uname) {
        $this->load->database("cms");
        $this->db->select('*');
        $this->db->from('cms_users');
        $this->db->where("username", $uname);
        $this->db->where('active', "1");
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

//End of get_uid()

    public function process($uname, $pass) {
        $usr = $this->get_uid($uname);
        if (isset($usr)) {
            if (crypt($pass, $usr->password) == $usr->password) {
                $uid = $usr->id;
                $logid = $this->logssave($uid);
                $user_name = $usr->name;
                $data = array(
                    "cms_user_id" => $uid,
                    "cms_user_name" => $username,
                    "cms_logid" => $logid,
                    "cms_userlogged" => true
                );
                $this->session->set_userdata($data);
                return TRUE;
            } else {
               
                if (md5($pass) == $usr->password) {
                    $uid = $usr->id;
                    //Create salt
                    $salt = uniqid("", true);
                    $algo = "6";
                    $rounds = "5050";
                    $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
                    $hashedPassword = crypt($pass, $cryptSalt);
                    //Create salt
                    $this->load->database("cms");
                    $this->db->set('password', $hashedPassword);
                    $this->db->where('id', $uid);
                    $this->db->update('cms_users');
                    $this->db->close();
                    //End transaction                    
                    $user_name = $usr->name;
                    $logid = $this->logssave($uid);
                    $data = array(
                        "cms_user_id" => $uid,
                        "cms_user_name" => $user_name,
                        "cms_logid" => $logid,
                        "cms_userlogged" => true
                    );
                    $this->session->set_userdata($data);
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        }
    }

// End of process

    public function logssave($userid) {
        $this->load->helper("userinfo");
        $currentTime = date("Y-m-d H:i:s");
        $browser = get_user_browser();
        $os = get_os();
        $ip = get_ip();
        $systeminfo = $ip . "," . $os . "," . $browser;
        $data = array(
            "user_id" => $userid,
            "login_time" => $currentTime,
            "system_info" => $systeminfo
        );
        $this->load->database("cms");
        $this->db->insert("cms_userlogs", $data);
        $ins_id = $this->db->insert_id();
        if ($ins_id > 0) {
            $this->db->close();
            return $ins_id;
        } else {
            return false;
        }
    }

// End of logssave

    public function logsupdate() {
        $log_id = $this->session->userdata("cms_logid");        
        $this->load->database("cms");
        $currentTime = date("Y-m-d H:i:s");
        $this->db->where("log_id", $log_id);
        $this->db->update("cms_userlogs", array("logout_time" => $currentTime));
        $this->db->close();
        return true;
    }

// End of logsupdate
}

// End of Login_model 