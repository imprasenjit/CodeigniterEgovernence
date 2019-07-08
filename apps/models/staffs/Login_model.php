<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
class Login_model extends CI_Model{
    function getsave_user($uname, $pass, $dept){
        $this->load->database();
        $dept_db = $this->load->database($dept, TRUE);
        $salt = uniqid("", true);
        $algo = "6";
        $rounds = "5050";
        $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
        $hashedPassword = crypt($pass, $cryptSalt);
        $qry_uname = $dept_db->query("SELECT user_id, uname, uemail FROM users WHERE uname = '$uname' LIMIT 1");
        if ($qry_uname->num_rows() == 1) {
            $row_dept = $qry_uname->row();
            $uid = $row_dept->user_id;
            $uname = $row_dept->uname;
            $uemail = $row_dept->uemail;
            $this->db->query("INSERT INTO admin_passwords(uid, username, email, password, dept) VALUES('$uid', '$uname', '$uemail', '$hashedPassword', '$dept')");
            $this->db->close();
            return $uid;
        } else {
            $qry_email = $dept_db->query("SELECT user_id, uname, uemail FROM users WHERE uemail = '$uname' LIMIT 1");
            if ($qry_email->num_rows() == 1) {
                $row_dept = $qry_email->row();
                $uid = $row_dept->user_id;
                $uname = $row_dept->uname;
                $uemail = $row_dept->uemail;
                $this->db->query("INSERT INTO admin_passwords(uid, username, email, password, dept) VALUES('$uid', '$uname', '$uemail', '$hashedPassword', '$dept')");
                $this->db->close();
                return $uid;
            } else {
                $this->db->close();
                return FALSE;
            }
        }
    }//End of getsave_user()
    
    function get_uid($uname, $pass, $dept){
        $this->load->database();
        $qry_uname = $this->db->query("SELECT uid FROM admin_passwords WHERE username = '$uname' AND dept='$dept' LIMIT 1");
        if ($qry_uname->num_rows() == 1) {
            $this->db->close();
            return $qry_uname->row()->uid;
        } else {
            $qry_email = $this->db->query("SELECT uid FROM admin_passwords WHERE email = '$uname' AND dept='$dept' LIMIT 1");
            if ($qry_email->num_rows() == 1) {
                $this->db->close();
                return $qry_email->row()->uid;
            } else {
                $this->db->close();
                return $this->getsave_user($uname, $pass, $dept);               
            }
        }
    }//End of get_uid()
    
    function process($uname, $pass, $dept){
        $this->load->database();
        $dept_db = $this->load->database($dept, TRUE);
        if($this->get_uid($uname, $pass, $dept)) {
            $uid = $this->get_uid($uname, $pass, $dept);
            $qry = $this->db->query("SELECT password FROM admin_passwords WHERE uid = '$uid'");
            $dbpassword = $qry->row()->password;
            if (crypt($pass, $dbpassword) == $dbpassword) {
                $usr = $dept_db->query("SELECT * FROM users WHERE user_id = '$uid'")->row();
                $user_name = $usr->user_name;
                $office_id = $usr->office_id;
                $uemail = $usr->uemail;
                $uname = $usr->uname;
                $utype = $usr->utype;
                $user_rights = $usr->user_rights;
                
                $dept_details = $this->db->query("SELECT id,name FROM SubDepartment WHERE dept_code = '$dept'")->row();
                $dept_name = $dept_details->name;
                $dept_id = $dept_details->id;
                $data = array(
                    "staff_id" => $uid,
                    "utype" => $utype,
                    "staff_dept_id" => $dept_id,
                    "staff_dept_name" => $dept_name,
                    "staff_dept" => $dept,
                    "staff_name" => $user_name,
                    "staff_uname" => $uname,
                    "staff_rights" => $user_rights,
                    "office_id" => $office_id,
                    "uemail" => $uemail,
                    "stafflogged" => true
                );
                $this->session->set_userdata($data);
                $this->db->close();
                return TRUE;
            } else {
                $this->db->close();
                return FALSE;
            }
        }
    } // End of process
    
    function logssave($data){
        $this->load->database();
        $this->db->insert("userlogs", $data);
        $this->db->close();
        return true;
    } // End of logssave
    
    function logsupdate($log_id){
        $this->load->database();
        $currentTime=date("Y-m-d H:i:s");
        $this->db->where("log_id", $log_id);
        $this->db->update("userlogs", array("logout_time" => $currentTime));
        $this->db->close();
        return true;
    } // End of logsupdate
} // End of Login_model 