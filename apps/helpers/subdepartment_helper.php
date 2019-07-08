<?php
defined("BASEPATH") OR exit("No direct script access allowed");
   function get($parentID) {
        $this->load->database();
        $all_dept = $this->db->query("SELECT * FROM SubDepartment WHERE ParentID='$parentID' ") or die($mysqli->error);
        $masterArray = array();
        $tempArray = array();
        foreach ($all_dept->result() as $result) {
            $tempArray = array('id' => $result->id, 'status' => $result->status, 'name' => $result->name, 'dept_code' => $result->dept_code, 'form_tables' => $result->form_tables, 'icons' => $result->icons, 'website' => $result->website);
            array_push($masterArray, $tempArray);
        }
        $this->db->close();
        return $masterArray;
    }

    function getAllSubdepartment() {
        $this->load->database();
        $query = $this->db->get("SubDepartment");
        $this->db->close();
        return $query->result_array();
    }

    function get_deptbycode($code) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("SubDepartment");
        $this->db->where("dept_code", $code);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row(); //Return OBJECT
        }//End of if else        
    }

//End of get_deptname()

    function get_deptbyid($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("SubDepartment");
        $this->db->where("id", $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            $object = new stdClass();
            $object->name="Undefined";
            return $object;
        } else {
            $this->db->close();
            return $query->row(); //Return OBJECT
        }//End of if else        
    }

//End of get_deptname()

