<?php
if (!defined("BASEPATH")) exit("No direct script access allowed");

class Firedept_model extends CI_Model {

    function get_nearest_fire_station_name($fire_station_id) {
        $dept_db = $this->load->database("fire", TRUE);
        $dept_db->select("nearest_fire_station");
        $dept_db->from("nearest_fire_stations"); 
        $dept_db->where("id", $fire_station_id ); 
        $query = $dept_db->get(); 
        if($query->num_rows() == 0) {
            $dept_db->close();
            return FALSE;
        } else {
            $dept_db->close();
            return $query->row()->nearest_fire_station;
        }//End of if else 
    }

}

//End of Subdepartments_model		