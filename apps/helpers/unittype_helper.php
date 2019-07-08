<?php
defined("BASEPATH") OR exit("No direct script access allowed");
if (!function_exists("get_unittype")) {
    function get_unittype($unit_type) {
        if ($unit_type == "H") {
            $unit_type_name = "Head Office";
        } else if ($unit_type == "B") {
            $unit_type_name = "Branch Office";
        } else if ($unit_type == "F") {
            $unit_type_name = "Factory";
        } else if ($unit_type == "G") {
            $unit_type_name = "Godown";
        } else {
            $unit_type_name = "Not found!";
        }
        return $unit_type_name;
    }//End of get_unittype()
}//End of if

if (!function_exists("get_allunittype")) {
    function get_allunittype() {
        $temp=array(
            "H"=>"Head Office",
            "B"=>"Branch Office",
            "F"=>"Factory",
            "G"=>"Godown"
            
        );
        return $temp;
    }//End of get_allunittype()
}//End of if