<?php

defined("BASEPATH") OR exit("No direct script access allowed");
/**
 * store_email()
 * @param type $email
 * @return boolean
 */
if (!function_exists("query_subject")) {

    function query_subject($subject = NULL) {
        if ($subject != NULL) {
            switch ($subject) {
                case "D":echo "Document Related";
                    break;
                case "F":echo "Fees & payments Related";
                    break;
                case "G":echo "General Query";
                    break;
                default :echo "Not Available";
                    break;
            }
        } else {
            echo "Not Available";
        }
    }

}