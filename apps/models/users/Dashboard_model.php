<?php

/**
 * Description of Unit_model
 *
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

    /**
     * get_all_application()
     * @param type $unit_id ID of the unit
     * @param type $type Type of Applications to returm
     * @return boolean
     */
    function get_all_application($unit_id, $type = NULL, $limit = NULL) {
        $this->load->database();
        $this->db->select("*");
		
        $this->db->from("applications");
        $this->db->where("unit_id", $unit_id);
		$this->db->order_by('id', 'desc');
        /* if ($type === "submitted") {
            $this->db->where("current_status <> ", NULL);
        } elseif ($type === "incomplete") {
            $this->db->where("current_status", NULL);
        } */
        if ($limit != NULL) {
            $this->db->limit($limit);
        }

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /**
     * get_all_message()
     * @param type $unit_id ID of the unit
     * @return boolean
     */
    function get_all_message($unit_id, $limit = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("queries");
        $this->db->where("unit_id", $unit_id);
        if ($limit != NULL) {
            $this->db->limit(5);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    function index_limit_messages($unit_id, $limit, $start = 0) {
        $this->load->database();
        $this->db->select("queries.query_id,queries.unit_id,queries.uain,queries.query_from,queries.subject,queries.msg,queries.document,queries.other_info,queries.q_date,queries.status");
        $this->db->select("query_replies.query_reply_id,query_replies.entry_time as reply_date");
        $this->db->from("queries");
        $this->db->join("query_replies", "query_replies.query_id=queries.query_id", "left");
        $this->db->where("queries.unit_id", $unit_id);
        $this->db->order_by("queries.query_id", "DESC");
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    function index_limit_applications($unit_id, $limit, $start = 0, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("unit_id", $unit_id);
        $this->db->order_by("id", "DESC");
        /* if ($type === "submitted") {
            $this->db->where("current_status <> ", NULL);
        } elseif ($type === "incomplete") {
            $this->db->where("current_status", NULL);
        } */
        $this->db->limit($limit, $start);
        return $this->db->get("applications")->result();
    }

    function get_message($query_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("queries");
        $this->db->where("query_id", $query_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    /**
     * 
     * @param type $unit_id
     * @return boolean
     */
    function get_all_documents($unit_id, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("digital_locker");
        if ($type === "mydocuments") {
            $this->db->where("document_type", "S");
        } elseif ($type === "form_documents") {
            $this->db->where("document_type", "F");
        } elseif ($type === "certificates") {
            $this->db->where("document_type", "P");
        }
        $this->db->where("unit_id", $unit_id);
        $query = $this->db->get();
        //echo $query = $this->db->get_compiled_select();die();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    /**
     * 
     * @param type $unit_id
     * @param type $limit
     * @param type $start
     * @param type $type
     * @return type
     */
    function index_limit_documents($unit_id, $limit, $start = 0, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->where("unit_id", $unit_id);
        $this->db->order_by("id", "DESC");
        if ($type === "mydocuments") {
            $this->db->where("document_type", "S");
        } elseif ($type === "form_documents") {
            $this->db->where("document_type", "F");
        } elseif ($type === "certificates") {
            $this->db->where("document_type", "P");
        }
        $this->db->limit($limit, $start);
        //echo $query = $this->db->get_compiled_select("digital_locker");die();
        return $this->db->get("digital_locker")->result();
    }

    function replyquery($unit_id) {
        $today = date("Y-m-d H:i:s");
        $error = 1;
        $msg = $this->input->post("msg");
        $query_type = $this->input->post("query_type");
        $query_id = $this->input->post("query_id");
        if ($query_type == "G") {
            $data = array(
                "unit_id" => $unit_id,
                "query_id" => $query_id,
                "query_type" => $query_type,
                "reply_msg" => $msg,
                "entry_time" => $today
            );
        } else if ($query_type == "D") {
            if (empty($msg)) {
                $error .= "Please Write your reply to the query.";
            } else {
                $this->load->database();
                $this->db->select("other_info");
                $this->db->from("queries");
                $this->db->where("query_id", $query_id);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    $row = $query->row();
                    $obj = json_decode($row->other_info);
                    $i = 1;
                    $files = array();
                    $this->load->helper("fileupload");
                    foreach ($obj->documents as $docs) {
                        if (!empty($this->input->post("upload_document" . $i . ""))) {
                            $temp_doc = moveFile(2, $this->input->post("upload_document" . $i . ""), "document" . $i . "");
                            $files[$docs->name] = $temp_doc;
                        } else {
                            $error .= "Please upload " . $docs->name . ".</br>";
                        }
                        $i++;
                    }
                    //print_r($files);
                    if ($error === 1) {
                        $data = array(
                            "unit_id" => $unit_id,
                            "query_id" => $query_id,
                            "query_type" => $query_type,
                            "reply_msg" => $msg,
                            "entry_time" => $today,
                            "other_info" => json_encode($files)
                        );
                    }
                }
            }
        }

        if ($error === 1) {
            $this->load->database();
            $this->db->insert("query_replies", $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("success" => 1, "info" => "Query Replied successfuly"));
            } else {
                echo json_encode(array("success" => 0, "info" => "Something went wrong"));
            }
        } else {
            echo json_encode(array("success" => "0", "info" => preg_replace('/[0-9]+/', '', $error)));
        }
    }

    function upload_mydocuments($unit_id) {
        $today = date("Y-m-d H:i:s");
        $this->load->helper("fileupload");
        $name = $this->input->post("name");
        $description = $this->input->post("description");
        if (!empty($this->input->post("upload_document"))) {
            
            $temp_doc = moveFile(2, $this->input->post("upload_document"), "document");
           
            $data = array(
                "unit_id" => $unit_id,
                "uploaded_on" => $today,
                "name" => $name,
                "description" => $description,
                "file" => $temp_doc[0],
                "document_type" => "S",
            );
            $this->load->database();
            $this->db->insert("digital_locker", $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("success" => 1, "info" => "Document Uploaded successfuly","file"=>$temp_doc[0]));
            } else {
                echo json_encode(array("success" => 0, "info" => "Something went wrong"));
            }
        }else{
          echo json_encode(array("success" => 0, "info" => "Document Not Uploaded"));  
        }
    }

}
