<?php

/**
 * Description of Caf_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications_model extends CI_Model {

    function getNotifications() {
        $columns = array(
            0 => 'id',
            1 => 'noti_no',
            2 => 'Noti_date',
            3 => 'post_name',
            4 => 'issue_by',
            5 => 'action'
        );
        $dept = $this->input->post("dept");
        $subdept = $this->input->post("sub_dept");
        $cat = $this->input->post("cat");
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, $dept, $subdept);
            $totalData = $this->total_rows($dept, $subdept);
            $totalFiltered = $totalData;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, $dept, $subdept);
            $totalFiltered = $totalData = count($records);
        }
        $data = array();
        if (!empty($records)) {
            foreach ($records as $post) {
                $id = $post->id;
                $action = '<a href="' . base_url("cms/notifications/notificationview/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/notifications/editnotification/$id/") . '" class="btn btn-primary">Edit</a>';
                $issue_by = $post->issue_by;
                $pieces = explode(" ", $issue_by);
                $issue_by1 = implode(" ", array_splice($pieces, 0, 3));
                if (str_word_count($issue_by) > 3)
                    $issue_by1 = $issue_by1 . "...";

                $nestedData["id"] = $id;
                $nestedData["noti_no"] = $post->Noti_no;
                $nestedData["Noti_date"] = date("d-m-Y", strtotime($post->Noti_date));
                $nestedData["post_name"] = $post->post_name;
                $nestedData["issue_by"] = '<span style="text-align: left" data-container="body" data-toggle="tooltip" title="' . $issue_by . '">"' . $issue_by1 . '"</span>';
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    //End of getApprovals()

    function total_rows($dept, $subdept) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->from("post");
        if ($dept != "" && $subdept != "") {
            $this->db->where("dept", $dept);
            $this->db->where("sub_dept", $subdept);
        }
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->num_rows();
        }//End of if else
    }

    function all_rows($limit, $start, $col, $dir, $dept, $subdept) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        if ($dept != "" && $subdept != "") {
            $this->db->where("dept", $dept);
            $this->db->where("sub_dept", $subdept);
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("post");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir, $dept, $subdept) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->like("post_name", $search);
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("post");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->result();
        }
    }

//End of search_rows()

    function savenotifications() {
        $this->load->helper("fileupload");
        $files = $this->input->post("uplodedfile");
        $uploades = moveFile(1, $files);
        $notification_file = $uploades["notification_file"];

        $today = date("Y-m-d H:i:s");
        $notidate = DateTime::createFromFormat('d/m/Y', $this->input->post("notification_date"));
        $notificationdate=$notidate->format('Y-m-d');
        if(!empty($this->input->post("valid_date"))){
        $valid_date = DateTime::createFromFormat('d/m/Y', $this->input->post("valid_date"));
        $validdate=$valid_date->format('Y-m-d');
        }else{
            $validdate=NULL;
        }

        $data = array(
            "dept" => $this->input->post("dept"),
            "sub_dept" => $this->input->post("sub_dept"),
            "post" => $this->input->post("dsc"),
            "issue_by" => $this->input->post("issuing_authority"),
            "Noti_date" => $notificationdate,
            "Noti_no" => $this->input->post("notification_no"),
            "type" => $this->input->post("notification_type"),
            "post_name" => $this->input->post("sub"),
            "valid_date" => $validdate,
            "publish_date" => $today,
            "pdf_file" => $notification_file
        );

        $this->load->database();
        $this->db->insert("post", $data);
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array("x" => 1, "info" => "Data Saved successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
        $this->db->close();
    }

    //End of savenotifications()

    function getNotification($id = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("post");
        $this->db->where("id", $id);

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else
    }

    //End of getNotification()

    function updatenotification() {
        $id=$this->session->userdata("notification_no");
        $today = date("Y-m-d H:i:s");
        $notidate = DateTime::createFromFormat('d/m/Y', $this->input->post("notification_date"));
        $notificationdate=$notidate->format('Y-m-d');
        if(!empty($this->input->post("valid_date"))){
        $valid_date = DateTime::createFromFormat('d/m/Y', $this->input->post("valid_date"));
        $validdate=$valid_date->format('Y-m-d');
        }else{
            $validdate=NULL;
        }
        if (!empty($this->input->post("uplodedfile"))) {
            $files = $this->input->post("uplodedfile");
            $this->load->helper("fileupload");

            $uploades = moveFile(1, $files);
            $notification_file = $uploades["notification_file"];
            $data = array(
                "dept" => $this->input->post("dept"),
                "sub_dept" => $this->input->post("sub_dept"),
                "post" => $this->input->post("dsc"),
                "issue_by" => $this->input->post("issuing_authority"),
                "Noti_date" => $notificationdate,
                "Noti_no" => $this->input->post("notification_no"),
                "type" => $this->input->post("notification_type"),
                "post_name" => $this->input->post("sub"),
                "valid_date" => $validdate,
                "publish_date" => $today,
                "pdf_file" => $notification_file
            );
        } else {
            $data = array(
                "dept" => $this->input->post("dept"),
                "sub_dept" => $this->input->post("sub_dept"),
                "post" => $this->input->post("dsc"),
                "issue_by" => $this->input->post("issuing_authority"),
                "Noti_date" => $notificationdate,
                "Noti_no" => $this->input->post("notification_no"),
                "type" => $this->input->post("notification_type"),
                "post_name" => $this->input->post("sub"),
                "valid_date" => $validdate,
                "publish_date" => $today                
            );
        }

        $this->load->database(); //Database load
        $this->db->where("id",$id);
        $this->db->update("post", $data); // Database work        
        if ($this->db->affected_rows() > 0) {
            echo json_encode(array("x" => 1, "info" => "Data Saved successfully"));
        } else {
            echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
        }
        $this->db->close();
        
    }

    //End of updatenotification()
}
