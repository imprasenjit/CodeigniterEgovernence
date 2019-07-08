<?php

defined("BASEPATH") OR exit("No direct script access allowed");

function get($id = NULL) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->load->database();
    $ci->db->from("Department");
    if ($id != NULL) {
        $ci->db->where("id", $id);
    }
    $ci->db->where("status", "1");
    $ci->db->order_by("id", "ASC");
    $all_dept = $ci->db->get();
    if ($id != NULL) {
        return $all_dept->row();
    }
    $masterArray = array();
    foreach ($all_dept->result() as $result) {
        $tempArray = array('id' => $result->id, 'status' => $result->status, 'name' => $result->name, 'dept_code' => $result->dept_code, 'form_tables' => $result->form_tables, 'icons' => $result->icons, 'website' => $result->website);
        array_push($masterArray, $tempArray);
    }
    $ci->db->close();
    return $masterArray;
}

function get_deptName($dept_code) {
    $ci = & get_instance();
    $ci->load->database();
    $ci->db->select("id,name");
    $ci->db->from("SubDepartment");
    $ci->db->where("dept_code", $dept_code);
    $query = $ci->db->get();
    $dept_id = 0;
    if ($query->num_rows() == 0) {
        $ci->db->close();
        if ($dept_code == "goa") {
            $dept_name = "Govt. of Assam";
        } else if ($dept_code == "pmu" || $dept_code == "cms") {
            $dept_name = "Project Management Unit";
        } else {
            $dept_name = "";
        }
    } else {
        $ci->db->close();
        $row = $query->row();
        $dept_id = $row->id;
        $dept_name = $row->name;
    }//End of if else
    $dept_name = strtoupper($dept_name);
    $dept_array = array('dept_id' => $dept_id, 'dept_name' => $dept_name);
    return $dept_array;
}

// End get_deptName