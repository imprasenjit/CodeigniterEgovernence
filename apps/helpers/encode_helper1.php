<?php
defined("BASEPATH") OR exit("No direct script access allowed");
if(!function_exists("encodeme")){
    function encodeme($par){
        $ci =& get_instance();
        //$ci->load->library("encrypt");
        //$encoded_par = $ci->encrypt->encode($par);
        $ci->load->library("encryption");
        $encoded_par = $ci->encryption->encrypt($par);
        $newencoded_par = str_replace(array("+", "/", "="), array("-", "_", "~"), $encoded_par);
        return $newencoded_par;
    } // End of encodeme()
} // End of if statement

if(!function_exists("decodeme")){
    function decodeme($par){
        $ci =& get_instance();
        //$ci->load->library("encrypt");
        $ci->load->library("encryption");
        $encoded_par=str_replace(array("-", "_", "~"), array("+", "/", "="), $par);
        //$original_par=$ci->encrypt->decode($encoded_par);
        $original_par=$ci->encryption->decrypt($encoded_par);
        return $original_par;
    } // End of decodeme()
} // End of if statement