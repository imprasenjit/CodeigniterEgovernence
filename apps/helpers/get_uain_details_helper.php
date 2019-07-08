<?php
function get_db_name($dept_code){
    switch($dept_code){
        case "LEDF":$dept="factory";
        break;
        case "LEDB":$dept="boiler";
        break;
        case "LEDL":$dept="labour";
        break;
        case "DEFT":$dept="forest";
        break;
        case "DOT":$dept="tourism";
        break;
        case "RCS":$dept="society";
        break;
        case "DP":$dept="power";
        break;
        case "EXD":$dept="excise";
        break;
        case "GJB":$dept="jalboard";
        break;
        case "WS":$dept="water";
        break;
        case "DME":$dept="dmedu";
        break;
        case "DSE":$dept="dsedu";
        break;
        case "DEE":$dept="deedu";
        break;
        case "DHE":$dept="dhedu";
        break;
        default :$dept=strtolower($dept_code);
        break;
    }
    return $dept;
}	
function get_uainDept($uian){
    $uian_type=Array();
    $uian_type=explode("/",$uian,3);
    $dept_code=$uian_type[0];
    $dept=get_db_name($dept_code);
    return $dept;
}
function get_uainForm($uian){
    $uian_type=Array();
    $uian_type=explode("/",$uian,3);
    $count = count($uian_type);
    if ($count > 1){		   
        $form_type=$uian_type[1];
        $form="";
        switch($form_type){
            case "TRADE": $form=1;
            break;
            case "CTE": $form=1;
            break;
            case "CTO": $form=2;
            break;
            case "F1": $form=1;
            break;
            default : $form=substr($form_type, 1);
            break;
        }
        return $form;
    }else{
       return 0;
    }
}
function getTableName($dept,$form){
    $table=$dept."_form".$form;
    return $table;
}

