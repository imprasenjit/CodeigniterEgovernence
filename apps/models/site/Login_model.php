<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Login_model extends CI_Model {

    /**
     * get_caf_user()
     * This method is used to check if user is a CAF user
     * @param type $uname
     * @return boolean
     */
    function get_caf_user($uname) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("email", $uname);
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

//End of get_caf_user()

    /**
     * get_unit_user
     * This function helps us to get the unit user if username is valid
     * @param type $username Username of the unit user
     * @return boolean
     */
    function get_unit_user($username) {
        $this->load->database();
        $this->db->select('*');
        $this->db->from('unit_master_record');
        $this->db->where("app_username", $username);
        $this->db->where("status", "1");
        $this->db->limit(1);
        $query = $this->db->get();
        $this->db->close();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    //End of get_unit_user

    function process($uname, $pass) {
        $this->load->helper("email");
        if ($usr = $this->get_caf_user($uname)) {
            if (verify_email($usr->email)) {
                if (crypt($pass, $usr->password) == $usr->password) {
                    $logid = $this->logssave($uid, "master_user");
                    $data = array(
                        "user_id" => $usr->id,
                        "user_name" => $usr->name,
                        "user_email" => $usr->email,
                        "user_phone" => $usr->phone,
                        "user_username" => $usr->username,
                        "user_type" => "master_user",
                        "user_logid" => $logid,
                        "userlogged" => TRUE
                    );

                    $this->session->set_userdata($data);
                    return TRUE;
                } else {
                    if (md5(strtoupper($pass)) == $usr->password) {
                        $salt = uniqid("", true);
                        $algo = "6";
                        $rounds = "5050";
                        $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
                        $hashedPassword = crypt($pass, $cryptSalt);
                        //Create salt
                        $this->load->database();
                        $this->db->set('password', $hashedPassword);
                        $this->db->where('id', $uid);
                        $this->db->update('users');
                        $this->db->close();
                        $logid = $this->logssave($uid, "master_user");
                        $data = array(
                            "user_id" => $usr->id,
                            "user_name" => $usr->name,
                            "user_email" => $usr->email,
                            "user_phone" => $usr->phone,
                            "user_username" => $usr->username,
                            "user_type" => "master_user",
                            "user_logid" => $logid,
                            "userlogged" => TRUE
                        );

                        $this->session->set_userdata($data);
                        session_start();
                        $_SESSION['user_id'] = $data['user_id'];
                        return TRUE;
                    } else {
                        $this->session->set_flashdata("flashMsg", "Invalid Password!");
                        return FALSE;
                    }
                }
            } else {
                $this->session->set_flashdata("flashMsg", "Email not verified! Please verify your email by clicking on the link sent to your registered email id.");
                return FALSE;
            }
        } else if ($usr = $this->get_unit_user($uname)) {
            if (crypt($pass, $usr->app_password) == $usr->app_password) {
				
                $uid = $usr->unit_master_record_id;
                $unit_id = $usr->unit_id;
                $caf_id = $usr->caf_id;
                $user_name = $usr->app_name;
                $username = $usr->app_username;
                $user_email = $usr->app_email;
                $user_phone = $usr->app_mobile_no;
                $logid = $this->logssave($uid, "unit_user");
                $data = array(
                    "unit_master_record_id" => $uid,
                    "unit_id" => $unit_id,
                    "caf_id" => $caf_id,
                    "user_name" => $user_name,
                    "user_email" => $user_email,
                    "user_phone" => $user_phone,
                    "user_username" => $username,
                    "user_type" => "unit_user",
                    "user_logid" => $logid,
                    "userlogged" => TRUE
                );
                $this->session->set_userdata($data);
                $this->load->library('session');
                $_SESSION['user_id'] = $data['user_id'];
                return TRUE;
            } else {
                $this->session->set_flashdata("flashMsg", "Invalid Password!");
                return FALSE;
            }
        } else {
            $this->session->set_flashdata("flashMsg", "Username does not exists!");
            return FALSE;
        }
    }

// End of process
    /**
     * 
     * @param type $uid (User ID)
     */
    function get_caf_id($uid) {
        $this->load->database();
        $this->db->select('caf_id');
        $this->db->where("user_id", $uid);
        $this->db->where("status", "1");
        $this->db->from('caf');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $caf = $query->row();
            return $caf->caf_id;
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $userid
     * @return boolean
     */
    public function logssave($userid, $type) {
        $this->load->helper("userinfo");
        $currentTime = date("Y-m-d H:i:s");
        $browser = get_user_browser();
        $os = get_os();
        $ip = get_ip();
        $systeminfo = $ip . "," . $os . "," . $browser;
        $data = array(
            "user_id" => $userid,
            "user_type" => $type,
            "login_time" => $currentTime,
            "system_info" => $systeminfo
        );
        $this->load->database();
        $this->db->insert("userlogs", $data);
        $ins_id = $this->db->insert_id();
        if ($ins_id > 0) {
            $this->db->close();
            return $ins_id;
        } else {
            return false;
        }
    }

// End of logssave
    /**
     * 
     * @return boolean
     */
    public function logsupdate() {
        $log_id = $this->session->userdata("user_logid");
        $this->load->database();
        $currentTime = date("Y-m-d H:i:s");
        $this->db->where("log_id", $log_id);
        $this->db->update("userlogs", array("logout_time" => $currentTime));
        $this->db->close();
        return true;
    }

// End of logsupdate
}

// End of Login_model 