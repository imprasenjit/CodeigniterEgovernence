<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Caf_model extends CI_Model {

    function checkpancard($value) {
        $this->load->database();
        $this->db->select("user_id");
        $this->db->from("caf");
        $this->db->where("pan", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return $userid->user_id;
        } else {
            $this->db->close();
            return FALSE;
        }
    }

//End of CheckPancard

    function getCaf($id = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("caf");
        if ($id != NULL) {
            $this->db->where("caf_id", $id);
            $query = $this->db->get();
            $this->db->close();
            return $query->row();
        } else {
            $this->db->where("caf.status", "0");
            $query = $this->db->get();
            $this->db->close();
            return $query->result();
        }
    }

    function getApplication($id = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications");
        if ($id != NULL) {
            $this->db->where("unit_id", $id);
            $query = $this->db->get();
            $this->db->close();
            return $query->result();
        } else {
            $this->db->close();
            return false;
        }
    }

    function get_row($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $this->db->where("id", $id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else
    }

//End of get_row()

    function checkusername($value) {
        $this->load->database();
        $this->db->select("username");
        $this->db->from("users");
        $this->db->where("username", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return true;
        } else {
            $this->db->close();
            return false;
        }
    }

//End of checkusername()



    function checkmobileno($value) {
        $this->load->database();
        $this->db->select("phone");
        $this->db->from("users");
        $this->db->where("phone", $value);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return true;
        } else {
            $this->db->close();
            return false;
        }
    }

//End of checkmobileno()


    function storeregistration() {
        $error = 1;


        //Registration Informations
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $mobile = $this->input->post("phone");
        $password = $this->input->post("password");
        $captcha = $this->input->post("captcha");
        $designation = $this->input->post("designation");
        $is_pancard_available = $this->input->post("ispancardavailable");

        // End of Registration informations
        //Enterprise informations
        $nameofentp = $this->input->post("nameofenterprise");
        $typeofentp = $this->input->post("typeofenterprise");
        $namesofmembers = $this->input->post("names");
        $pancard = $this->input->post("pancard");
        $panname = $this->input->post("pan_name");
        $dateofcommencement = $this->input->post("dateofcommencement");
        $cin_lpin = $this->input->post("cin_lpin");
        $entp_address = $this->input->post("entp_address");
        $entp_state = $this->input->post("entp_state");
        $entp_dist = $this->input->post("entp_dist");
        $entp_pin = $this->input->post("entp_pin");
        $app_address = $this->input->post("app_address");
        $app_state = $this->input->post("app_state");
        $app_dist = $this->input->post("app_dist");
        $app_pin = $this->input->post("app_pin");

        if ($this->input->post("entp_pin") != NULL) {
            $cin_liipn = $this->input->post("cin_lpiin");
        } else {
            $cin_liipn = "";
        }
        //End of Enterprise informations

        $array_of_entity_id = array(3, 4, 5, 10, 11); // This array will help us to determine which entity will require pan card
        $this->load->helper("email");
        if (empty($name)) {
            $error = "Please enter name";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($email)) {
            $error = "Please Enter Your Email ID";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email is not a valid email address";
        } elseif (empty($mobile)) {
            $error = "Please Enter Your Email ID";
        } elseif (!preg_match("/^\d{10}$/", $mobile)) {
            $error = "Please Enter a valid 10 digits mobile number.";
        } elseif ($this->checkmobileno($mobile)) {
            $error = "Mobile number already exists!";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $nameofentp)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($typeofentp)) {
            $error = "Please select type of enterprise.";
        } elseif (count($namesofmembers) < 0) {
            $error = "Please enter names of partners/members/trusties.";
        } elseif (empty($is_pancard_available)) {
            $error = "Do u have a pan Card?";
        } elseif (empty($entp_address)) {
            $error = "Please Enter Registered office address.";
        } elseif (empty($entp_state)) {
            $error = "Please select state.";
        } elseif (empty($entp_dist)) {
            $error = "Please select district.";
        } elseif (empty($entp_pin)) {
            $error = "Please Enter PIN number.";
        } elseif (empty($app_address)) {
            $error = "Please Enter Applicant address.";
        } elseif (empty($app_state)) {
            $error = "Please select Applicant state.";
        } elseif (empty($app_dist)) {
            $error = "Please select Applicant district.";
        } elseif (empty($designation)) {
            $error = "Please enter designation of the applicant.";
        } elseif (empty($app_pin)) {
            $error = "Please Enter Applicant PIN .";
        } elseif (!is_numeric($app_pin) || !is_numeric($entp_pin)) {
            $error = "Please Enter a numeric PIN Code.";
        } elseif (empty($this->input->post("upload_authorisation_letter"))) {
            $error = "Upload authorisation letter";
        } elseif (empty($this->input->post("upload_id_proof"))) {
            $error = "Upload ID proof";
        } elseif ($is_pancard_available === "Yes") {
            if (empty($pancard)) {
                $error = "Please Enter pancard number.";
            } elseif (empty($panname)) {
                $error = "Please Enter pan name.";
            } else {
                if (empty($this->input->post("upload_pancard_doc"))) {
                    $error = "Upload pan card.";
                }
            }
        } elseif ($is_pancard_available === "No") {
            if (in_array($typeofentp, $array_of_entity_id)) {
                $error = "Pan card is mandatory for your entity type.";
            } else {
                if (empty($this->input->post("upload_pancard_doc"))) {
                    $error = "Upload pan card declearation.";
                }
            }
        } else {

            $error = 1;
        }

        //echo $error;die();
        $today = date("Y-m-d H:i:s");
        if ($error == 1) {
            //Pancard Upload
            $this->load->helper("fileupload");
            if (!empty($this->input->post("upload_pancard_doc"))) {
                $pancard_doc = moveFile(0, $this->input->post("upload_pancard_doc"), "pancard_doc");
            } else {
                $error = "Upload pan card.";
            }
            //Authorisation letter Upload
            if (!empty($this->input->post("upload_authorisation_letter"))) {
                $authorisation_letter = moveFile(0, $this->input->post("upload_authorisation_letter"), "authorisation_letter");
            } else {
                $error = "Upload authorisation letter";
            }

            //ID proof
            if (!empty($this->input->post("upload_id_proof"))) {
                $id_proof = moveFile(0, $this->input->post("upload_id_proof"), "id_proof");
            } else {
                $error = "Upload ID proof";
            }
            $this->load->database();
            $app_addressdata = array(
                "type_of_address" => "applicant_address",
                "address" => $app_address,
                "state" => $app_state,
                "dist" => $app_dist,
                "pin" => $app_pin,
                "entrydate" => $today
            );
            $app_addressid = $this->address_model->save($app_addressdata);
            $this->load->helper("userinfo");
            $addressdata = array(
                "type_of_address" => "registered_office",
                "address" => $entp_address,
                "state" => $entp_state,
                "dist" => $entp_dist,
                "pin" => $entp_pin,
                "entrydate" => $today
            );
            $addressid = $this->address_model->save($addressdata);
            if (!empty($addressid) && !empty($app_addressid)) {
                $entpdata = array(
                    "user_id" => $this->session->user_id,
                    "entp_name" => $nameofentp,
                    "entity_id" => $typeofentp,
                    "owner_names" => json_encode($namesofmembers),
                    "cin_llpin" => $cin_lpin,
                    "date_of_commencement" => $dateofcommencement,
                    "pan" => $pancard,
                    "pan_name" => $panname,
                    "address" => $addressid,
                    'app_name' => $name,
                    'app_email' => $email,
                    'app_mobile' => $mobile,
                    'app_address' => $app_addressid,
                    'app_designation' => $designation,
                    "pan_card" => $pancard_doc[0],
                    "app_authorisation_letter" => $authorisation_letter[0],
                    "app_id_proof" => $id_proof[0],
                    "entrytime" => $today,
                );
                $this->load->database();
                $this->db->insert("caf", $entpdata);
                if ($this->db->affected_rows() > 0) {
//                        $sub = "EODB Email Verification Code";
//                        $msgBody = "Dear " . $name . ",<br><br>Your account has been created successfully.<br>Your Email verification otp is : '.$veryfy_link.' . <br>OR Please click on the link below to verify your email.<br><br><a href='" . base_url() . "site/registration/verifyemail/?tag=" . $veryfy_link . " '>Click Here verify your email.</a><br>If you did not register and you have received this email, Please contact us at eodb.assam@gmail.com or call us at +91-7086044425 immediately.";
//                        $this->load->helper("sendmail");
//                        sendmail($email, $sub, $msgBody);
                    echo json_encode(array("x" => 1, "info" => "<span style='color:green;'>Please check your Mobile number - <b>+91 " . $mobile . "</b> and Email - <b>" . $email . "</b>.The 6 digits One Time Password (OTP) has been sent to your mobile number and the Email Verification Code has been sent to your primary inbox, however if the email is not received kindly check your updates or spam/junk folder in your email account. </span>"));
                }
            } else {
                echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
            }
            $this->db->close();
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }

    function getAllEntity($id = NULL) {
        $this->load->database();
        $this->db->select("entity_id,entity_name");
        $this->db->from("business_entities");
        if ($id != NULL) {
            $this->db->where("entity_id", $id);
            $query = $this->db->get();
            $this->db->close();
            return $query->row();
        } else {
            $query = $this->db->get();
            $this->db->close();
            return $query->result_array();
        }
    }

    function getData() {
        $entity = $this->input->post("entity_id");
        switch ($entity) {
            case 1:
                echo '<div class="form-group has-feedback">     <label for="names" class="col-sm-3 control-label">Name of the Proprietor</label>     <div class="col-sm-7">       <input type="text" name="names[]" class="form-control required" data-error="Please enter Name of the Proprietor" />  <span class="glyphicon form-control-feedback" aria-hidden="true"></span><span id="inputSuccess3Status" class="sr-only">(success)</span><span class="help-block"></span>    </div>   </div>';
                break;
            case 2:
                echo '<div class="form-group has-feedback">       <label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Partner(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div> <span class="help-block"></span>   </div> </div>';
                break;
            case 3:
                echo '<div class="form-group"><label for="llpin" class="col-sm-3 control-label">LLPIN</label> <div class="col-sm-7"><input type="text" class="form-control required" id="llpin" name="cin_lpin" data-error="Please enter LLPIN" placeholder=""></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Partner(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Partner(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 4:
                echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">CIN of the Company</label> <div class="col-sm-7"><input type="text" class="form-control required" id="cin" name="cin_lpin" placeholder="" data-error="Please enter CIN"></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Director(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Directors(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 5:
                echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">CIN of the Company</label> <div class="col-sm-7"><input type="text" class="form-control required" id="cin" name="cin_lpin" placeholder=""></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Director(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Directors(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 6:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 7:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 8:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Trustees</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Trusties(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 9:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 10:
                echo '<div class="form-group"><label for="cin" class="col-sm-3 control-label">Name of Karta</label> <div class="col-sm-7"><input type="text" class="form-control required" id="namess" name="names[]" placeholder="" data-error="Name of Karta" ></div></div><div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 11:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 12:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 13:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
            case 14:
                echo '<div class="form-group">       <label for="names" class="col-sm-3 control-label">Name of the Member(s)</label>     <div class="col-sm-7"> <div class="input-group">    <input type="text" name="names[]" class="form-control required" data-error="Please enter name of the Member(s)">    <span class="input-group-btn">    <button type="button" class="add_btn btn btn-info"><span class="glyphicon glyphicon-plus"></span></button></span></div>   </div> </div>';
                break;
        }
    }

//End of getData()

    function getdistrict() {
        $state = $this->input->post("state");
        $result = $this->state_model->getdistrictofastate($state);
        foreach ($result as $row) {
            echo '<option value="' . $row['district'] . '">' . $row['district'] . '</option>';
        }
    }

//End of getdistrict();

    function verifyemail() {
        $tag = $this->input->get('tag');
        $this->load->database();
        $this->db->select("id");
        $this->db->from("users");
        $this->db->where("email_verify_link", $tag);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->load->database();
            $this->db->set("email_verify_link", "verified");
            $this->db->set("active", "1");
            $this->db->update("users");
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param type $value
     * @return boolean
     */
    function checkeditpancard($value, $entpid) {
        $this->load->database();
        $this->db->select("user_id");
        $this->db->from("caf");
        $this->db->where("pan", $value);
        $this->db->where("caf_id!=", $entpid);
        $query = $this->db->get();
        if ($userid = $query->row()) {
            $this->db->close();
            return $userid->user_id;
        } else {
            $this->db->close();
            return FALSE;
        }
    }

//End of checkeditpancard


    function storeeditcaf() {
        $error = 1;
        //Registration Informations
        $entpid = $this->input->post("entpid");
        $name = $this->input->post("name");
        $email = $this->input->post("email");
        $mobile = $this->input->post("phone");
        $password = $this->input->post("password");
        $captcha = $this->input->post("captcha");
        $designation = $this->input->post("designation");
        $is_pancard_available = $this->input->post("ispancardavailable");

        // End of Registration informations
        //Enterprise informations
        $nameofentp = $this->input->post("nameofenterprise");
        $typeofentp = $this->input->post("typeofenterprise");
        $namesofmembers = $this->input->post("names");
        $pancard = $this->input->post("pancard");
        $panname = $this->input->post("pan_name");
        $dateofcommencement = $this->input->post("dateofcommencement");
        $cin_lpin = $this->input->post("cin_lpin");
        $entp_address = $this->input->post("entp_address");
        $entp_state = $this->input->post("entp_state");
        $entp_dist = $this->input->post("entp_dist");
        $entp_pin = $this->input->post("entp_pin");
        $app_address = $this->input->post("app_address");
        $app_state = $this->input->post("app_state");
        $app_dist = $this->input->post("app_dist");
        $app_pin = $this->input->post("app_pin");

        if ($this->input->post("entp_pin") != NULL) {
            $cin_liipn = $this->input->post("cin_lpiin");
        } else {
            $cin_liipn = "";
        }
        //End of Enterprise informations

        $array_of_entity_id = array(3, 4, 5, 10, 11); // This array will help us to determine which entity will require pan card
        $this->load->helper("email");
        if (empty($name)) {
            $error = "Please enter name";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($email)) {
            $error = "Please Enter Your Email ID";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "$email is not a valid email address";
        } elseif (empty($mobile)) {
            $error = "Please Enter Your Email ID";
        } elseif (!preg_match("/^\d{10}$/", $mobile)) {
            $error = "Please Enter a valid 10 digits mobile number.";
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $nameofentp)) {
            $error = "Only letters and white space allowed";
        } elseif (empty($typeofentp)) {
            $error = "Please select type of enterprise.";
        } elseif (count($namesofmembers) < 0) {
            $error = "Please enter names of partners/members/trusties.";
        } elseif (empty($is_pancard_available)) {
            $error = "Do u have a pan Card?";
        } elseif (empty($entp_address)) {
            $error = "Please Enter Registered office address.";
        } elseif (empty($entp_state)) {
            $error = "Please select state.";
        } elseif (empty($entp_dist)) {
            $error = "Please select district.";
        } elseif (empty($entp_pin)) {
            $error = "Please Enter PIN number.";
        } elseif (empty($app_address)) {
            $error = "Please Enter Applicant address.";
        } elseif (empty($app_state)) {
            $error = "Please select Applicant state.";
        } elseif (empty($app_dist)) {
            $error = "Please select Applicant district.";
        } elseif (empty($designation)) {
            $error = "Please enter designation of the applicant.";
        } elseif (empty($app_pin)) {
            $error = "Please Enter Applicant PIN .";
        } elseif (!is_numeric($app_pin) || !is_numeric($entp_pin)) {
            $error = "Please Enter a numeric PIN Code.";
        } elseif ($is_pancard_available === "Yes") {
            if (empty($pancard)) {
                $error = "Please Enter pancard number.";
            } elseif (empty($panname)) {
                $error = "Please Enter pan name.";
            } elseif ($this->checkeditpancard($pancard, $entpid)) {
                $error = "Pan Card already exists!";
            }
        } elseif ($is_pancard_available === "No") {
            if (in_array($typeofentp, $array_of_entity_id)) {
                $error = "Pan card is mandatory for your entity type.";
            }
        } else {

            $error = 1;
        }

        $today = date("Y-m-d H:i:s");
        if ($error == 1) {
            //Pancard Upload

            $this->load->helper("fileupload");
            if (!empty($this->input->post("upload_pancard_doc"))) {
                $pancard_doc = moveFile(0, $this->input->post("upload_pancard_doc"), "pancard_doc");
            } else {
                $pancard_doc = array(0 => $this->input->post("pancard_document"));
            }
            //Authorisation letter Upload
            if (!empty($this->input->post("upload_authorisation_letter"))) {
                $authorisation_letter = moveFile(0, $this->input->post("upload_authorisation_letter"), "authorisation_letter");
            } else {
                $authorisation_letter = array(0 => $this->input->post("authorisation_document"));
            }

            //ID proof
            if (!empty($this->input->post("upload_id_proof"))) {
                $id_proof = moveFile(0, $this->input->post("upload_id_proof"), "id_proof");
            } else {
                $id_proof = array(0 => $this->input->post("idproof_document"));
            }
            //Enterpriseid to update
            //Addressid to update
            $addressid = $this->input->post("addressid");
            $app_addressid = $this->input->post("app_addressid");
            $today = date("Y-m-d H:i:s");
            if ($this->input->post("entp_pin") != NULL) {
                $cin_liipn = $this->input->post("cin_lpiin");
            } else {
                $cin_liipn = "";
            }
            $app_addressdata = array(
                "type_of_address" => "applicant_address",
                "address" => $app_address,
                "state" => $app_state,
                "dist" => $app_dist,
                "pin" => $app_pin,
                "entrydate" => $today
            );
            $this->address_model->update($app_addressdata, $app_addressid);
            $addressdata = array(
                "type_of_address" => "registered_address",
                "address" => $entp_address,
                "state" => $entp_state,
                "dist" => $entp_dist,
                "pin" => $entp_pin
            );
            $this->address_model->update($addressdata, $addressid);
            $this->load->database();
            //Updating enterprise data
            $entpdata = array(
                "entp_name" => $nameofentp,
                "entity_id" => $typeofentp,
                "owner_names" => json_encode($namesofmembers),
                "cin_llpin" => $cin_lpin,
                "date_of_commencement" => $dateofcommencement,
                "pan" => $pancard,
                "pan_name" => $panname,
                "address" => $addressid,
                'app_name' => $name,
                'app_email' => $email,
                'app_mobile' => $mobile,
                'app_address' => $app_addressid,
                'app_designation' => $designation,
                "pan_card" => $pancard_doc[0],
                "app_authorisation_letter" => $authorisation_letter[0],
                "app_id_proof" => $id_proof[0],
                "status" => "0",
                "query_status" => "0",
                "entrytime" => $today,
            );
            $this->db->where('caf_id', $entpid);
            $this->db->update('caf', $entpdata);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("x" => 1, "info" => "Caf editted successfully"));
            } else {
                echo json_encode(array("x" => 0, "error" => "Something went wrong!"));
            }
        } else {
            echo json_encode(array("x" => 0, "error" => $error));
        }
    }

}
