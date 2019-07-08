<?php

/**
 * Description of Users_model
 * 
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    function get($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("id", $id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function getverifiedusers() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "verified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "verified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->user_id;
                $action = '<a href="' . base_url("cms/users/edit/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/users/edit/$id/") . '" class="btn btn-primary">Edit</a>';
                $nestedData["id"] = $id;
                $nestedData["name"] = $post->name;
                $nestedData["email"] = $post->email;
                $nestedData["phone"] = $post->phone;
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

    function getunverifiedusers() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'phone',
            4 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "unverified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "unverified");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->user_id;
                $action = '<a href="' . base_url("cms/users/view/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;&nbsp;<a href="' . base_url("cms/users/edit/$id/") . '" class="btn btn-primary">Edit</a>';
                $nestedData["id"] = $id;
                $nestedData["name"] = $post->name;
                $nestedData["email"] = $post->email;
                $nestedData["phone"] = $post->phone;
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

    function all_rows($limit, $start, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->select("users.id as user_id");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("users");
        $this->db->join("emails", "users.email=emails.email", "inner");

        if ($type == "verified") {
            $this->db->where("emails.verification_status", "1");
        } else {
            $this->db->where("emails.verification_status", "0");
        }
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }//End of if else
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->select("users.id as user_id");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("users");
        $this->db->join("emails", "users.email=emails.email", "inner");

        if ($type == "verified") {
            $this->db->where("emails.verification_status", "1");
        } else {
            $this->db->where("emails.verification_status", "0");
        }
        $this->db->where("(`users`.`name` LIKE '%$search%' ESCAPE '!'
                            OR  `users`.`email` LIKE '%$search%' ESCAPE '!'
                            OR  `users`.`phone` LIKE '%$search%' ESCAPE '!'
                            )");

        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }
    }

    function update_user() {
        $user_id = $this->input->post("user_id");
        $name = $this->input->post("name");
        $phone = $this->input->post("phone");
        $this->load->database();
        $data=array(
            "name"=>$name,
            "phone"=>$phone
        );
        $this->db->where("id",$user_id);
        $this->db->update("users",$data);
        if($this->db->affected_rows() > 0){
             echo json_encode(array("x" => 1, "info" => "User details updated successfully"));
        }
    }

}
