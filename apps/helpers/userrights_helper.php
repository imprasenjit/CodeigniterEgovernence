<?php
defined("BASEPATH") OR exit("No direct script access allowed");
if (!function_exists("get_right")) {
    function get_right($right) {
        if ($right == "M") {
            $right_name = "Modify (Application Form)";
        } else if ($right == "Q") {
            $right_name = "Query (Application Form)";
        } else if ($right == "R") {
            $right_name = "Reject (Application Form)";
        } else if ($right == "F") {
            $right_name = "Forward (Application Form)";
        } else if ($right == "V") {
            $right_name = "Schedule Inspection";
        } else if ($right == "UVR") {
            $right_name = "Upload Inspection Report";
        } else if ($right == "A") {
            $right_name = "Approve (Application Form)";
        } else if ($right == "I") {
            $right_name = "Issue Certifcate";
        } else if ($right == "C") {
            $right_name = "Upload Certifcate";
        } else if ($right == "IF") {
            $right_name = "Issue Fund (Payment)";
        } else if ($right == "RF") {
            $right_name = "Reject Refund Request (Payment)";
        } else if ($right == "CR") {
            $right_name = "View & Receive Courier";
        } else {
            $right_name = "Undefined!";
        }
        return "<i class='fa fa-check-circle'></i> ".$right_name;
    }//End of get_right()
}//End of if