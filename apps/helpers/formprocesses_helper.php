<?php
defined("BASEPATH") OR exit("No direct script access allowed");
if (!function_exists("get_process")) {
    function get_process($proc) {
        if ($proc == "A") {
            $proc_name = "Application Approved";
        } else if ($proc == "C") {
            $proc_name = "Certificate Uploaded";
        } else if ($proc == "F") {
            $proc_name = "Application Forwarded";
        } else if ($proc == "I") {
            $proc_name = "Issued Certificate/License";
        } else if ($proc == "Q") {
            $proc_name = "Application Sent on Query";
        } else if ($proc == "QR") {
            $proc_name = "Query Raised";
        } else if ($proc == "QA") {
            $proc_name = "Query Answered";
        } else if ($proc == "R") {
            $proc_name = "Application Rejected";
        } else if ($proc == "UVR") {
            $proc_name = "Verification Report Uploaded";
        } else if ($proc == "SRL") {
            $proc_name = "Sent Recommendation Letter";
        } else if ($proc == "V") {
            $proc_name = "Verification Scheduled";
        } else if ($proc == "RD") {
            $proc_name = "Read";
        } else if ($proc == "CS") {
            $proc_name = "Courier Sent";
        } else if ($proc == "RC") {
            $proc_name = "Received Courier";
        } else {
            $proc_name = "Default";
        }//End of if else
        return $proc_name;
    }
	//CS- Courier Sent, RD- Read, RC- Received Courier, F-Forward, V - Verification Scheduled, SRL - Sent Recommendation Letter, UVR - Verification Report Uploaded,QR - Query Raised, QA - Query Answered, A - Application Approved, I - Issued Certificate, C-Certificate Uploaded
}