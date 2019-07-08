<?php
if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}
class GetDepartments_model extends CI_Model {
    function get($id=NULL) {
        $this->load->database();
        $this->db->from("Department");
        if($id!=NULL){
        $this->db->where("id",$id);
        }
        $this->db->where("status","1");
        $this->db->order_by("id", "ASC");
        $all_dept=$this->db->get(); 
        if($id!=NULL){
        return $all_dept->row();
        }
        $masterArray = array();
        foreach ($all_dept->result() as $result) {
            $tempArray = array('id' => $result->id, 'status' => $result->status, 'name' => $result->name, 'dept_code' => $result->dept_code, 'form_tables' => $result->form_tables, 'icons' => $result->icons, 'website' => $result->website);
            array_push($masterArray, $tempArray);
        }
        $this->db->close();
        return $masterArray;
    }

    function get_deptName($dept_code) {
        $this->load->database();
        $this->db->select("id,name");
        $this->db->from("SubDepartment");
        $this->db->where("dept_code", $dept_code);
        $query = $this->db->get();
        $dept_id = 0;
        if ($query->num_rows() == 0) {
            $this->db->close();
            if ($dept_code == "goa") {
                $dept_name = "Govt. of Assam";
            } else if ($dept_code == "pmu" || $dept_code == "cms") {
                $dept_name = "Project Management Unit";
            } else {
                $dept_name = "";
            }
        } else {
            $this->db->close();
            $row = $query->row();
            $dept_id = $row->id;
            $dept_name = $row->name;
        }//End of if else
        $dept_name = strtoupper($dept_name);
        $dept_array = array('dept_id' => $dept_id, 'dept_name' => $dept_name);
        return $dept_array;
    }// End get_deptName
}//End of Subdepartments_model