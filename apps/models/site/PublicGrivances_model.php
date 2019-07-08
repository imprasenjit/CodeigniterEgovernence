<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}
class PublicGrivances_model extends CI_Model {
    function checkuain($uain) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications");
        $this->db->where("uain", $uain);
        $query = $this->db->get()->result_array();
        if (count($query) > 0) {
            echo json_encode(array("x" => 1));
        } else {
            echo json_encode(array("x" => 0));
        }
        $this->db->close();
    }//End of checkuain()

    function checkgrievance($grievance_token_no) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal");
        $this->db->where("complaint_no", $grievance_token_no);
        $arr = $this->db->get()->result_array();
        if (count($arr) > 0) {
            echo json_encode(array("x" => $arr[0]["g_id"]));
        } else {
            echo json_encode(array("x" => 0));
        }
        $this->db->close();
    }//End of checkgrievance()

    function appealgrievance() {
        $grievance_token_no = $this->input->get("grievance_token_no");
        $userid = $this->input->get("userid");
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal");
        $this->db->join("grievance_redressal_process", "grievance_redressal_process.g_id=grievance_redressal.g_id");
        $this->db->where("grievance_redressal.complaint_no", $grievance_token_no);
        $this->db->where("grievance_redressal_process.process_type", "R");
        $this->db->where("grievance_redressal_process.process_type", "R");
        $this->db->where("grievance_redressal_process.status", "1");
        $this->db->where("grievance_redressal.user_id", $userid);
        $data = $this->db->get()->result_array();
        if (count($data) > 0) {
            $g_id = $data["g_id"];
            $this->db->select("*");
            $this->db->from("grievance_redressal_appealed");
            $this->db->where("g_id", $g_id);
            $this->db->where("active", "1");
            $appeal = $this->db->get()->result_array();
            if (count($appeal) > 0) {
                echo "appealed";
            } else {
                echo $g_id = $appeal["g_id"];
            }
        } else {
            echo json_encode(array("x" => 0));
        }
    }//End of appealgrievance();

    function storegrievance() {
        $this->load->model("eodbfunctions/getSubDepartment_model");
        $user_id = $this->session->userdata("user_id");
        $today = date("Y-m-d H:i:s");
        $dept = $this->input->post('dept');
        $deptdata = $this->getSubDepartment_model->get_deptbycode($dept);
        $dept_name = $deptdata->name;
        $message = $this->input->post('message');
        $msg_subject = $this->input->post('subject');
        if ($msg_subject == "S") {
            $msg_subject = "Single Window Clearance System Application";
        } else if ($msg_subject == "T") {
            $msg_subject = "Time bound service activity";
        } else if ($msg_subject == "M") {
            $uain = $this->input->post('uain');
            $msg_subject = "My Application - " . $uain;
        } else {
            $msg_subject = "Other issues related to the Department";
        }
        $name = $this->session->userdata("user_name");
        $email = $this->session->userdata("user_email");
        $phone = $this->session->userdata("user_phone");
        $this->load->helper("userinfo");
        $ip_address = get_ip();
        $complaint_no = "EGR/" . mt_rand(10000000, 99999999) . "/" . date("m/Y");
        if (isset($uain) && $uain == "") {
            $errorMsg = "Please Enter UAIN";
            $code = "1";
        } elseif ($message == "") {
            $errorMsg = "Please fill out this field";
            $code = "2";
        } elseif ($dept == "") {
            $errorMsg = "Please select a department";
            $code = "3";
        } else {
            $this->load->helper("sendmail");
            $str = "We have received the following information : <br/><br/>Complaint No. : " . $complaint_no . "<br/><br/>Name : " . $name . "<br/><br/>Phone Number : " . $phone . "<br/><br/>Email : " . $email . "<br/><br/>Department : " . $dept_name . "<br/><br/>Subject : " . $msg_subject . "<br/><br/>Message : " . $message . "<br/><br/>";
            $str2 = "Dear " . $name . ", <br/>We have received your Grievance Redressal Form. Your Complaint Number is - <strong>" . $complaint_no . "</strong><br/>We will get back to you at the earliest.<br/>Thank you for your patience.<br/><br/> With Regards, <br/> Ease of Doing Business in Assam.";
            $subject = "Grievance Redressal (Dept. : " . $dept_name . ")";
            $subject2 = "EODB Grievance Redressal (Dept. : " . $dept_name . ")";
            $admin_emails = "eodb.assam@gmail.com" . "," . "eodb@avantikain.com";
            //$admin_emails="chiranjit@avantikain.com";
            $sendmail1 = sendmail($admin_emails, $subject, $str);
            $sendmail2 = sendmail($email, $subject2, $str2);

            $this->load->helper("fileupload");
            if (moveFile(0)) {
                $this->load->database();
                $file = $this->session->userdata("finalUplodedFile");
                $name = $this->session->userdata("user_name");
                $data = array(
                    "user_id" => $user_id,
                    "complaint_no" => $complaint_no,
                    "dept" => $dept,
                    "subject" => $msg_subject,
                    "message" => $message,
                    "document" => $file,
                    "ip_address" => $ip_address,
                    "g_date" => $today,
                );
                $this->db->insert("grievance_redressal", $data);

                if ($sendmail1 == true && $this->db->insert_id() > 0 && $sendmail2 == true) {
                    echo json_encode(array("x" => 1, "name" => $name, "complaint_no" => $complaint_no));
                } else {
                    echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
                }
                $this->db->close(); //Close Database();
            }
        }
    }//End of storegrievance

    function getGrievance($complaint_no) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal");
        $this->db->where("complaint_no", $complaint_no);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->close();
            return $query->row_array();
        } else {
            $this->db->close();
            return false;
        }
    }//End of getGrievance();

    function grievanceredressalappealed($gid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal_appealed");
        $this->db->where("g_id", $gid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->close();
            return $query->row();
        } else {
            $this->db->close();
            return false;
        }
    }//End of grievanceredressalappealed();

    function getMessages($gid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal_conv");
        $this->db->where("g_id", $gid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->close();
            return $query->result();
        } else {
            $this->db->close();
            return false;
        }
    }//End of getMessages();

    function grievanceRedressalProcess($gid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("grievance_redressal_process");
        $this->db->where("g_id", $gid);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->close();
            return $query->result();
        } else {
            $this->db->close();
            return false;
        }
    }//End of getMessages();

    function getOfficer($userId, $forward_dept = NULL) {
        $this->load->database();
        $this->db->select("user_name");
        if ($forward_dept == "goa") {
            $this->db->from("goa_users");
        } else if ($forward_dept == "pmu") {
            $this->db->from("pmu_users");
        } else if ($forward_dept == "cms") {
            $this->db->from("pmu_users");
        } else {
            $this->db->from("users");
        }
        $this->db->where("user_id", $userId);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->db->close();
            return $query->result();
        } else {
            $this->db->close();
            return false;
        }
    }//End of getOfficer();

    function storeAppealGrievance() {
        $today = date("Y-m-d H:i:s");
        $g_id = $this->input->post("g_id");
        $subject = $this->input->post("subject");
        $message = $this->input->post("message");
        $this->load->helper("fileupload");

        if (moveFile(0)) {
            $this->load->database();
            $file = $this->session->userdata("finalUplodedFile");
            $name = $this->session->userdata("user_name");
            $data = array(
                "g_id" => $g_id,
                "subject" => $subject,
                "message" => $message,
                "appeal_doc" => $file,
                "sub_date" => $today
            );
            $this->db->insert("grievance_redressal_appealed", $data);

            if ($this->db->insert_id() > 0) {
                echo json_encode(array("x" => 1));
            } else {
                echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
            }
            $this->db->close(); //Close Database();
        }
    }//End of appealGrievance();
}//End of PublicGrievances_model
