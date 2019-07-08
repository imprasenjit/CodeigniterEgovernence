<?php

defined("BASEPATH") OR exit("No direct script access allowed");

if (!function_exists("getAllEntity")) {

    function getAllEntity($id = NULL) {
        $ci = & get_instance();
        $ci->load->database();
        $ci->db->select("entity_id,entity_name");
        $ci->db->from("business_entities");
        if ($id != NULL) {
            $ci->db->where("entity_id", $id);
            $query = $ci->db->get();
            $ci->db->close();
            return $query->row();
        } else {
            $query = $ci->db->get();
            $ci->db->close();
            return $query->result_array();
        }
    }

}

if (!function_exists("get_entity_view")) {

    function get_entity_view($entity, $names, $other = NULL) {
        $owner_names = json_decode($names, true);
        switch ($entity) {
            case 1:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Proprietor:</div><div class="col-sm-6">' . $owner_names[0] . '</div></div>';
                break;
            case 2:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) : ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 3:
                echo '<div class="col-md-12"><div class="col-sm-6">LLpin: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 4:
                echo '<div class="col-md-12"><div class="col-sm-6">CIN: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Directors(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 5:
                echo '<div class="col-md-12"><div class="col-sm-6">LLpin: </div><div class="col-sm-6">' . $other . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Partner(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 6: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 7: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 8:
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Trusties(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 9: echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 10:
                echo '<div class="col-md-12"><div class="col-sm-6">name of Karta: </div><div class="col-sm-6">' . $owner_names[0] . '</div></div>';
                echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            case 11:echo '<div class="col-md-12"><div class="col-sm-6">Name of the Members(s) :</div><div class="col-sm-6"> ';
                foreach ($owner_names as $name) {
                    echo $name . '<br>';
                }
                echo '</div></div>';
                break;
            default:
                echo "Not found!";
        }
    }

    if (!function_exists("getEntityWithFields")) {

        function getEntityWithFields($entity, $names, $other = NULL) {
            $owner_names = json_decode($names, true);
            switch ($entity) {
                case 1:
                    echo '<div class="form-group has-feedback">     '
                    . '<label for="names" class="col-sm-3 control-label">Name of the Proprietor</label>     '
                    . '<div class="col-sm-7">       '
                    . '<input type="text" name="names[]" value="' . $owner_names[0] . '" class="form-control" data-error="Please enter Name of the Proprietor" />  '
                    . '<span class="glyphicon form-control-feedback" aria-hidden="true"></span>'
                    . '<span id="inputSuccess3Status" class="sr-only">(success)</span>'
                    . '<span class="help-block"></span>    </div>   '
                    . '</div>';
                    break;
                case 2:
                    foreach ($owner_names as $name) {
                        echo '<div class="form-group has-feedback">       '
                        . '<label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     '
                        . '<div class="col-sm-7"> '
                        . '<div class="input-group">    '
                        . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                        . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                        . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                        . '<span class="help-block"></span>   </div> '
                        . '</div>';
                    }

                    break;
                case 3:
                    echo '<div class="form-group"><label for="llpin" class="col-sm-3 control-label">LLPIN</label> '
                    . '<div class="col-sm-7">'
                    . '<input type="text" class="form-control" id="llpin" value="' . $other . '" name="cin_lpin" data-error="Please enter LLPIN" placeholder=""></div></div>'
                    ;
                    foreach ($owner_names as $name) {
                        echo '<div class="form-group has-feedback">       '
                        . '<label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     '
                        . '<div class="col-sm-7"> '
                        . '<div class="input-group">    '
                        . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                        . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                        . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                        . '<span class="help-block"></span>   </div> '
                        . '</div>';
                    }
                    break;
                case 4:
                    echo '<div class="form-group">'
                    . '<label for="cin" class="col-sm-3 control-label">CIN of the Company</label> '
                    . '<div class="col-sm-7">'
                    . '<input type="text" class="form-control" value="' . $other . '" id="cin" name="cin_lpin" placeholder="" data-error="Please enter CIN">'
                    . '</div></div>';
                    foreach ($owner_names as $name) {
                        echo '<div class="form-group has-feedback">       '
                        . '<label for="names" class="col-sm-3 control-label">Name of the Directors(s)</label>     '
                        . '<div class="col-sm-7"> '
                        . '<div class="input-group">    '
                        . '<input type="text" name="names[]" value= "' . $name . '" class="form-control" data-error="Please enter name of the Partner(s)">    '
                        . '<span class="input-group-btn">    <button type="button" class="add_btn btn btn-info">'
                        . '<span class="glyphicon glyphicon-plus"></span></button></span></div> '
                        . '<span class="help-block"></span>   </div> '
                        . '</div>';
                    }
                    break;
                case 5:
                    echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">CIN of the Company</label> <div class="col-sm-7"><input type="text" class="form-control" id="cin" name="cin_lpin" placeholder=""></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Director(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Directors(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 6:
                    echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 7:
                    echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 8:
                    echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Trusties(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Trusties(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 9:
                    echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 10:
                    echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">Name of Karta</label> <div class="col-sm-7"><input type="text" class="form-control" id="namess" name="names[]" placeholder="" data-error="Name of Karta" ></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                case 11:
                    echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Members(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control" data-error="Please enter name of the Members(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                    break;
                default:
                    echo "Please select Entity!";
            }
        }

    }
}

