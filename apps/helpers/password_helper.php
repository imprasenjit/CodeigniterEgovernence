<?php

defined("BASEPATH") OR exit("No direct script access allowed");
/**
 * 
 * @param type $password
 * @return type Hashed Password
 */
if (!function_exists("create_hashed_password")) {

    function create_hashed_password($password) {
        $salt = uniqid("", true);
        $algo = "6";
        $rounds = "5050";
        $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
        $hashedPassword = crypt($password, $cryptSalt);
        return $hashedPassword;
    }

}
