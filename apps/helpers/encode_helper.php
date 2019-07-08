<?php
defined("BASEPATH") OR exit("No direct script access allowed");
if(!function_exists("encodeme")){
    function encodeme($par){
        $ci =& get_instance();
        $ci->load->library("encryption");
        $encoded_par = $ci->encryption->encrypt($par);
        $newencoded_par = str_replace(array("+", "/", "="), array("-", "_", "~"), $encoded_par);
        return $newencoded_par;
    } // End of encodeme()
} // End of if statement

if(!function_exists("decodeme")){
    function decodeme($par){
        $ci =& get_instance();
        $ci->load->library("encryption");
        $encoded_par=str_replace(array("-", "_", "~"), array("+", "/", "="), $par);
        $original_par=$ci->encryption->decrypt($encoded_par);
        return $original_par;
    } // End of decodeme()
} // End of if statement

if(!function_exists("uainexplode")){
    function uainexplode($uain, $ret){
        $pcs = explode("/", $uain);
        $dept_info = array_key_exists(0, $pcs)?$pcs[0]:NULL;
        $dept_code = get_dcode($dept_info);
        
        if($dept_info === "PCB" || $dept_info === "GMC") {//$pcb = "PCB/CTE/KM/000001/03/2018";
            if(array_key_exists(1, $pcs)) {
                $frm = $pcs[1];
                if($frm === "CTE") {
                    $frm_no = 1;
                } elseif($frm === "CTO") {
                    $frm_no = 2;
                } elseif($frm === "TRADE") {
                    $frm_no = 1;
                } else {
                    $frm_no = (int)str_replace("F", "", $frm);
                }                
                $frm_tbl = $dept_code."_form".$frm_no;
            } else {
                $frm_no = 0;
                $frm_tbl = NULL;
            }
        } else {            
            if(array_key_exists(1, $pcs)) {
                $frm = $pcs[1];
                $frm_no = (int)str_replace("F", "", $frm);
                $frm_tbl = $dept_code."_form".$frm_no;
            } else {
                $frm_no = 0;
                $frm_tbl = NULL;
            }
        }  
        $dist = array_key_exists(2, $pcs)?strtolower($pcs[2]):NULL; 
        $form_id = array_key_exists(2, $pcs)?(int)$pcs[3]:"1";          
        
        if($ret === "dept_code") {
            $res = $dept_code;
        } elseif($ret === "form_no") {
            $res = $frm_no;
        } elseif($ret === "form_table") {
            $res = $frm_tbl;
        } elseif($ret === "dist_code") {
            $res = $dist;
        } elseif($ret === "form_id") {
            $res = $form_id;
        }
        //$a = "Dept : ".$dept_code.", Form No. : ".$frm_no.", Form Table : ".$frm_tbl;
        return $res;
    } // End of uainexplode()
} // End of if statement

if(!function_exists("get_dcode")){
    function get_dcode($dept_info) {
        switch ($dept_info) {
            case "LEDF":$dept = "factory";
                break;
            case "LEDB":$dept = "boiler";
                break;
            case "LEDL":$dept = "labour";
                break;
            case "DEFT":$dept = "forest";
                break;
            case "DOT":$dept = "tourism";
                break;
            case "RCS":$dept = "society";
                break;
            case "DP":$dept = "power";
                break;
            case "EXD":$dept = "excise";
                break;
            case "GJB":$dept = "jalboard";
                break;
            case "WS":$dept = "water";
                break;
            case "DME":$dept = "dmedu";
                break;
            case "DSE":$dept = "dsedu";
                break;
            case "DEE":$dept = "deedu";
                break;
            case "DHE":$dept = "dhedu";
                break;
            default :$dept = strtolower($dept_info);
                break;
        }
        return $dept;
    } // End of uainexplode()
} // End of if statement
