<?php

/**
 * Description of Unit_model
 *
 * @author Avantika Innovations PVT LTD
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

    function storedetails() {
        extract($this->input->post());
        $error = 1;
        if (empty($unit_name)) {
            $error = "Please enter unit name. ";
        } else if (empty($unit_type)) {
            $error = "Please select unit type. ";
        } else if (empty($dateofcommencement)) {
            $error = "Please select date of commencement. ";
        } else if (empty($unit_mobile_no)) {
            $error = "Please enter Mobile number. ";
        } else if (empty($unit_email_id)) {
            $error = "Please enter email id. ";
        } else if (!isset($addresstype)) {
            if (empty($unit_state)) {
                $error = "Please enter state. ";
            } else if (empty($unit_address)) {
                $error = "Please enter address. ";
            } else if (empty($unit_dist)) {
                $error = "Please select district. ";
            } else if (empty($unit_block)) {
                $error = "Please enter block. ";
            } else if (empty($unit_pin)) {
                $error = "Please enter pin number. ";
            } else if (empty($revenue_circle)) {
                $error = "Please enter revenue circle. ";
            }
        } else {
            $error = 1;
        }

        if ($error == 1) {
            $today = date("Y-m-d H:i:s");
            $cafid = $this->session->userdata("caf_id");
            if (!isset($addresstype)) {
                $addressdata = array(
                    "type_of_address" => "unit_office",
                    "address" => $unit_address,
                    "state" => $unit_state,
                    "dist" => $unit_dist,
                    "pin" => $unit_pin,
                    "entrydate" => $today
                );
                if (isset($this->session->edit_unitid)) {
                    $unitaddressid = $this->unit_model->getunitdetails($this->session->edit_unitid);

                    if ($unitaddressid->address->type_of_address == "unit_office") {
                        $addressid = $this->address_model->update($addressdata, $unitaddressid->address->id);
                    } else {
                        $addressid = $this->address_model->save($addressdata);
                    }
                } else {
                    $addressid = $this->address_model->save($addressdata);
                }
            } else {
                $caf_id = $this->session->userdata("caf_id");
                $addressid = $this->address_model->getAddressIdOfCaf($caf_id);
                //echo $addressid;die();
            }
            if (!empty($addressid)) {
                $data = array(
                    "caf_id" => $cafid,
                    "unit_name" => $unit_name,
                    "unit_type" => $unit_type,
                    "dateofcommencement" => $dateofcommencement,
                    "address" => $addressid,
                    "block" => $unit_block,
                    "revenue_circle" => $revenue_circle,
                    "landline_std" => $unit_std_code,
                    "landline_no" => $unit_phone_no,
                    "mobile_no" => $unit_mobile_no,
                    "email_id" => $unit_email_id,
                    "submitstatus" => "0",
                    "submittedtime" => NULL,
                    "entrytime" => $today
                );
                $this->load->database();
                if (isset($this->session->edit_unitid)) {
                    $editid = $this->session->edit_unitid;
                    $this->db->where('unit_id', $editid);
                    $this->db->update('unit', $data);
                    $insid = $editid;
                } else {
                    $this->db->insert("unit", $data);
                    $insid = $this->db->insert_id();
                }

                if ($this->db->affected_rows() > 0) {
                    $this->session->set_userdata('edit_unitid', $insid);
                    echo json_encode(array("success" => 1, "info" => "Unit details saved successfully!"));
                } else {
                    echo json_encode(array("success" => 0, "error" => $error));
                }
            } else {
                echo json_encode(array("success" => 0, "error" => $error));
            }
        } else {
            echo json_encode(array("success" => 0, "error" => $error));
        }
    }

// End of storedetails

    function getunitdetails($id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit");
        $this->db->where("unit_id", $id);
        $query = $this->db->get();
        $array = $query->row();
        $addressid = $array->address;
        $address = $this->address_model->get($addressid);
        $array->address = $address;
        return $array;
    }

//End of getunitdetails();

     

    function storeapplicantdetails() {

        if (isset($this->session->edit_unitid)) {

            extract($this->input->post());
            $error = 1;
            if (empty($app_name)) {
                $error = "Please Enter applicant name. ";
            } else if (empty($app_designation)) {
                $error = "Please enter applicant designation. ";
            } else if (empty($app_mobile_no)) {
                $error = "Please enter applicant mobile no. ";
            } else if (empty($app_email)) {
                $error = "Please enter applicants email. ";
            } else {
                $error = 1;
            }

            if ($error = 1) {
                $today = date("Y-m-d H:i:s");
                $addressdata = array(
                    "type_of_address" => "applicant_address",
                    "address" => $app_address,
                    "state" => $app_state,
                    "dist" => $app_dist,
                    "pin" => $app_pin,
                    "entrydate" => $today
                );

                $unitid = $this->session->edit_unitid;
                $applicantdetails = $this->getapplicantdetails($unitid);
                $this->load->database();
                if ($applicantdetails) {
                    $addressid = $this->address_model->update($addressdata, $applicantdetails->address->id);
                    if ($this->check_if_username_already_exists($app_username, $applicantdetails->app_id)) {
                        $error = "Username already exists.Please use different username. ";
                        echo json_encode(array("success" => 0, "error" => $error));
                    } else {
                        $data = array(
                            "u_id" => $this->session->edit_unitid,
                            "app_name" => $app_name,
                            "app_designation" => $app_designation,
                            "app_addressid" => $addressid,
                            "app_mobile_no" => $app_mobile_no,
                            "app_email" => $app_email,
                            "app_username" => $app_username,
                            "app_password" => $this->create_hashed_password($app_password),
                            "entrydate" => $today,
                        );
                        $this->db->where("app_id", $applicantdetails->app_id);
                        $this->db->update("unit_applicant_details", $data);
                        $this->db->close();
                        echo json_encode(array("success" => 1, "info" => "Applicant details saved."));
                    }
                } else {
                    if ($this->check_if_username_already_exists($app_username)) {
                        $error = "Username already exists.Please use different username. ";
                        echo json_encode(array("success" => 0, "error" => $error));
                    } else {
                        $addressid = $this->address_model->save($addressdata);
                        $data = array(
                            "u_id" => $this->session->edit_unitid,
                            "app_name" => $app_name,
                            "app_designation" => $app_designation,
                            "app_addressid" => $addressid,
                            "app_mobile_no" => $app_mobile_no,
                            "app_email" => $app_email,
                            "app_username" => $app_username,
                            "app_password" => $this->create_hashed_password($app_password),
                            "entrydate" => $today,
                        );
                        $this->db->insert("unit_applicant_details", $data);
                        $this->db->close();
                        echo json_encode(array("success" => 1, "info" => "Applicant details saved."));
                    }
                }
            } else {
                echo json_encode(array("success" => 0, "error" => $error));
            }
        } else {
            echo json_encode(array("success" => 0, "error" => "Please enter unit details first."));
        }
    }

//End of storeapplicantdetails()

    /**
     * 
     * @param type $password
     * @return type Hashed Password
     */
    function create_hashed_password($password) {
        $salt = uniqid("", true);
        $algo = "6";
        $rounds = "5050";
        $cryptSalt = '$' . $algo . '$rounds=' . $rounds . '$' . $salt;
        $hashedPassword = crypt($password, $cryptSalt);
        return $hashedPassword;
    }

    function getapplicantdetails($unitid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit_applicant_details");
        $this->db->where("u_id", $unitid);
        $query = $this->db->get();
        $array = $query->row();
        if ($array) {
            $address = $this->address_model->get($array->app_addressid);
            $array->address = $address;
            return $array;
        } else {
            return false;
        }
    }

//End of getapplicantdetails()

    function storelanddetails() {
        if (isset($this->session->edit_unitid)) {
            extract($this->input->post());
            $error = 1;
            $today = date("Y-m-d H:i:s");
            if (empty($inlineRadioOptions)) {
                $error = "Please select if your land is under industrial estate. ";
            } else if ($inlineRadioOptions == "yes") {
                if (empty($estates)) {
                    $error = "Please select estate";
                }
            } else if (empty($area_type)) {
                $error = "Please select type of area. ";
            } else if (empty($land_status)) {
                $error = "Please select status of Land/Building/Premises. ";
            } else if (empty($land_type)) {
                $error = "Please select type of Land. ";
            } else if (empty($dag_no)) {
                $error = "Please enter Dag No. ";
            } else if (empty($patta_no)) {
                $error = "Please enter Patta No. ";
            } else if (empty($mouza)) {
                $error = "Please enter Mouza. ";
            } else {
                $error = 1;
            }

            if ($inlineRadioOptions == "No") {
                $estates = "";
            }

            if ($error == 1) {
                $data = array(
                    "unit_id" => $this->session->edit_unitid,
                    "estate" => $estates,
                    "area_type" => $area_type,
                    "land_status" => $land_status,
                    "land_type" => $land_type,
                    "dag_no" => $dag_no,
                    "patta_no" => $patta_no,
                    "mouza" => $mouza,
                    "entrytime" => $today
                );


                if (!$this->getlanddetails($this->session->edit_unitid)) {
                    $this->load->database();
                    $this->db->insert("unit_landdetails", $data);
                } else {
                    $this->load->database();
                    $this->db->where("unit_id", $this->session->edit_unitid);
                    $this->db->update("unit_landdetails", $data);
                }

                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("success" => 1, "info" => "Land details saved."));
                } else {
                    echo json_encode(array("success" => 0, "error" => "Something went wrong!"));
                }
                $this->db->close();
            } else {
                echo json_encode(array("success" => 0, "error" => $error));
            }
        } else {
            echo json_encode(array("success" => 0, "error" => "Please enter unit details first."));
        }
    }

//End of storelanddetails()


    function getlanddetails($unitid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit_landdetails");
        $this->db->where("unit_id", $unitid);
        $query = $this->db->get();
        $this->db->close();
        return $query->row();
    }

//End of getlanddetails()

    function getsectors($id = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("operation_sectors");
        if ($id == NULL) {
            $this->db->order_by("sector_name");
        } else {
            $this->db->where("sector_id", $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

//End of getsectors()

    function getbusinesstypes($sectorid, $businessid = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("business_types");
        if ($businessid == NULL) {
            $this->db->where("sector_id", $sectorid);
        } else {
            $this->db->where("business_id", $businessid);
        }
        $query = $this->db->get();
        return $query->result();
    }

//End of getbusinesstypes()

    function storeotherdetails() {
        if (isset($this->session->edit_unitid)) {
            extract($this->input->post());
            $error = 1;
            $today = date("Y-m-d H:i:s");
            if (empty($invest_size)) {
                $error = "Please select Size of Current Investment.";
            } else if (empty($employement)) {
                $error = "Please enter Current/Estimated Employment ";
            } else if (empty($operation_sector)) {
                $error = "Please select Sector of Operation.";
            } else if (empty($business_type)) {
                $error = "Please select business type.";
            } else if (empty($entp_category)) {
                $error = "Please select Category of Enterprise based on pollution.";
            } else if (empty($power_requirement)) {
                $error = "Please enter power requirement in KW";
            } else {
                $error = 1;
            }

            if ($error == 1) {
                $data = array(
                    "unit_id" => $this->session->edit_unitid,
                    "investment_size" => $invest_size,
                    "no_of_employee" => $employement,
                    "operation_sector" => $operation_sector,
                    "business_type" => $business_type,
                    "entp_category" => $entp_category,
                    "power_requirement" => $power_requirement,
                    "entrytime" => $today
                );


                $this->load->database();

                if (!$this->getotherdetails($this->session->edit_unitid)) {
                    $this->db->insert("unit_otherdetails", $data);
                } else {
                    $this->db->where("unit_id", $this->session->edit_unitid);
                    $this->db->update("unit_otherdetails", $data);
                }

                if ($this->db->affected_rows() > 0) {
                    echo json_encode(array("success" => 1, "info" => "Unit Details saved."));
                } else {
                    echo json_encode(array("success" => 0, "error" => "Something went wrong!"));
                }
                $this->db->close();
            } else {
                echo json_encode(array("success" => 0, "error" => $error));
            }
        } else {
            echo json_encode(array("success" => 0, "error" => "Please enter unit details first."));
        }
    }

//End of storeotherdetails()


    function getotherdetails($unitid) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit_otherdetails");
        $this->db->where("unit_id", $unitid);
        $query = $this->db->get();
        return $query->row();
    }

    //End of getotherdetails()
    /**
     * check_if_username_already_exists()
     * @param type $username
     * @return boolean
     */
    function check_if_username_already_exists($username, $applicantid = NULL) {

        if ($applicantid != NULL) {
            $this->load->database();
            $data = array(
                "app_username" => ""
            );
            $this->db->where("app_id", $applicantid);
            $this->db->update("unit_applicant_details", $data);
            if ($this->db->affected_rows() > 0) {
                $this->load->database();
                $this->db->select("app_username");
                $this->db->from("unit_applicant_details");
                $this->db->where("app_username", $username);
                $this->db->limit(1);
                $query = $this->db->get();
                if ($query->num_rows() > 0) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                $this->load->database();
                $this->db->select("app_username");
                $this->db->from("unit_applicant_details");
                $this->db->where("app_username", $username);
                $this->db->limit(1);
                $query = $this->db->get();
                //echo $query;
                //die();
                if ($query->num_rows() > 0) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
        } else {
            $this->load->database();
            $this->db->select("app_username");
            $this->db->from("unit_applicant_details");
            $this->db->where("app_username", $username);
            $this->db->limit(1);
            $query = $this->db->get();
            //$query = $this->db->get_compiled_select();
            //echo $query;
            //die();
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }

    function get_unit($unit_id) {
        $this->load->database();
        $this->db->from("unit");
        $this->db->where("unit_id", $unit_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function submitfinalunit() {
        $this->load->database();
        $editid = $this->session->edit_unitid;
        $today = date("Y-m-d H:i:s");
        $unit = $this->get_unit($editid);
        //print_r($unit->approvalstatus);
        if ($unit) {
            if ($unit->approvalstatus == 1 || $unit->approvalstatus == 3 ) {
                $data = array(
                    "submitstatus" => 1,
                    "submittedtime" => $today,
                    "approvalstatus" => "3"
                );
            } else {
                $data = array(
                    "submitstatus" => 1,
                    "submittedtime" => $today,
                    "approvalstatus" => "0"
                );
            }
            
            //print_r($data);
            $this->db->where('unit_id', $editid);
            $this->db->update('unit', $data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("success" => 1, "info" => "Unit successfully submitted."));
            } else {
                echo json_encode(array("success" => 0, "error" => "Something went wrong."));
            }
        } else {
            echo json_encode(array("success" => 0, "error" => "Something went wrong."));
        }


        $this->db->close();
    }

//End of submitfinalunit()
    function getapprovedunits() {
        $this->load->database();
        $this->db->from("unit_master_record");
        $this->db->where("caf_id", $this->session->caf_id);
        $this->db->where("status", "1");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function getunit($where, $value=NULL) {
		if($value == NULL){
			$value = $where;
			$where = "unit_master_record_id";
		}
        $this->load->database();
        $this->db->from("unit_master_record");
        $this->db->where($where, $value);
        $this->db->where("status", "1");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    function getallunits($type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit");
        $this->db->where("caf_id", $this->session->caf_id);
        if ($type == "approved") {
            $this->db->where("submitstatus", "1");
            $this->db->where("approvalstatus", "1");
        } else if ($type == "pending") {
            $this->db->where("submitstatus", "0");
            $this->db->where("approvalstatus", "0");
        } else if ($type == "rejected") {
            $this->db->where("submitstatus", "1");
            $this->db->where("approvalstatus", "2");
        } else if ($type == "submitted") {
            $this->db->where("submitstatus", "1");
            $this->db->where("approvalstatus", "0");
            $this->db->or_where("approvalstatus", "3");
        }
        $query = $this->db->get();
        return $query->result();
    }

//End of getunitdetails()

    function storedocuments() {
        $data = array();
        $this->load->helper("fileupload");
        if (!empty($this->input->post("upload_address_proof_of_unit"))) {
            $file = moveFile(0, $this->input->post("upload_address_proof_of_unit"), "address_proof_of_unit");
            $data["address_proof_of_unit"] = $file[0];
        }

        if (!empty($this->input->post("upload_applicant_id_proof"))) {
            $file = moveFile(0, $this->input->post("upload_applicant_id_proof"), "applicant_id_proof");
            $data["applicant_id_proof"] = $file[0];
        }

        if (!empty($this->input->post("upload_applicant_address_proof"))) {
            $file = moveFile(0, $this->input->post("upload_applicant_address_proof"), "applicant_address_proof");
            $data["applicant_address_proof"] = $file[0];
        }

        if (!empty($this->input->post("upload_gst_registration"))) {
            $file = moveFile(0, $this->input->post("upload_gst_registration"), "gst_registration");
            $data["gst_registration"] = $file[0];
        }
        if (count($data) > 0) {
            $today = date("Y-m-d H:i:s");
            $save_data = array(
                "documents" => json_encode($data),
                "document_submit_time" => $today
            );
            $this->load->database();
            $this->db->where('unit_id', $this->session->edit_unitid);
            $this->db->update('unit', $save_data);
            if ($this->db->affected_rows() > 0) {
                echo json_encode(array("success" => 1, "info" => "Documents successfully submitted."));
            } else {
                echo json_encode(array("success" => 0, "error" => "Something went wrong!."));
            }
        }
    }

    //End of storedocuments()

    function getunitdocuments() {
        $this->load->database();
        $this->db->select("documents");
        $this->db->from("unit");
        $this->db->where("unit_id", $this->session->edit_unitid);
        $query = $this->db->get();
        $this->db->close();
        $result = $query->row();
        if ($result) {
            $array = json_decode($result->documents, TRUE);
            echo '<div class="row">';
            if ($array != NULL || $array != "") {
                if (count($array) > 0) {
                    foreach ($array as $key => $value) {
                        echo '<div class="col-md-12"><div class="col-md-6">' . str_replace("_", " ", $key) . ' :</div><div class="col-md-6"> <a href="' . $value . '" target="_blank">Download</a></div></div>';
                    }
                    echo '</div>';
                }
            }
        } else {
            "No documents uploaded!";
        }
    }

    function add_row($data) {
        $this->load->database();
        $this->db->insert("singe_window_registration", $data);
        $this->db->close();
    }

//End of add_row()

    public function edit_row($id, $data) {
        $this->load->database();
        $this->db->where("id", $id);
        $this->db->update("singe_window_registration", $data);
        $this->db->close();
        return true;
    }

//End of edit_row()    

    function get_unitbyubin($ubin) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $this->db->where("ubin", $ubin);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }

//End of get_unitbyubin()

    function get_applicant($user_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("users");
        $this->db->where("id", $user_id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else        
    }

//End of get_applicant()

    function get_rows() {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of get_rows()

    function get_user_ubin_rows($user_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("singe_window_registration");
        $this->db->where("user_id", $user_id);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of get_rows()

    function delete_row($id) {
        $this->load->database();
        $this->db->where("id", $id);
        $this->db->delete("singe_window_registration");
        $this->db->close();
    }

//End of if delete_row()

    function validate_ubin($unit_id, $user_id) {
        $this->load->database();
        $this->db->select("id");
        $this->db->from("singe_window_registration");
        $this->db->where("id", $unit_id);
        $this->db->where("user_id", $user_id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->row();
        }//End of if else
    }

//End of validate_ubin()

    function approved_applications($unit_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications");
        $this->db->where("unit_id", $unit_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of if approved_applications()

    function recent_submitted_applications($unit_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("applications");
        $this->db->where("unit_id", $unit_id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit('4');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

//End of if approved_applications()

    function get_notifications($unit_id) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("notifications");
        $this->db->where("unit_id", $unit_id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        $this->db->close();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

    /**
     * 
     * @param type $unit_id
     * @return boolean
     */
    function check_unit_if_valid($unit_id) {
        $caf_id = $this->session->caf_id;
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit");
        $this->db->group_start();
        $this->db->where("unit_id", $unit_id);
        $this->db->where("caf_id", $caf_id);
        $this->db->group_end();
        $query = $this->db->get();
        $this->db->close();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return FALSE;
        } else {
            $this->db->close();
            return $query->result();
        }//End of if else
    }

    /**
     * 
     */
    function getapprovedunit() {
        $columns = array(
            0 => 'unit_id',
            1 => 'unitname',
            2 => 'entpname',
            3 => 'unitaddress',
            4 => 'unitapplicant',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "approved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "approved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->unit_id;
                $action = '<a href="' . base_url("cms/unit/edit/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/unit/edit/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["unit_id"] = $id;
                $nestedData["unitname"] = $post->unit_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["unitaddress"] = $fulladdress->house_no . " , " . $fulladdress->street . " , " . $fulladdress->village . " , " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                $nestedData["unitapplicant"] = $post->app_name;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getunapprovedunit() {
        $columns = array(
            0 => 'unit_id',
            1 => 'unitname',
            2 => 'entpname',
            3 => 'unitaddress',
            4 => 'unitapplicant',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "unapproved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "unapproved");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->unit_id;
                $action = '<a href="' . base_url("cms/unit/edit/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/unit/edit/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["unit_id"] = $id;
                $nestedData["unitname"] = $post->unit_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["unitaddress"] = $fulladdress->house_no . " , " . $fulladdress->street . " , " . $fulladdress->village . " , " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                $nestedData["unitapplicant"] = $post->app_name;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getrejectedunit() {
        $columns = array(
            0 => 'unit_id',
            1 => 'unitname',
            2 => 'entpname',
            3 => 'unitaddress',
            4 => 'unitapplicant',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "rejected");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "rejected");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->unit_id;
                $action = '<a href="' . base_url("cms/unit/manageunit/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/unit/manageunit/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["unit_id"] = $id;
                $nestedData["unitname"] = $post->unit_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["unitaddress"] = $fulladdress->house_no . " , " . $fulladdress->street . " , " . $fulladdress->village . " , " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                $nestedData["unitapplicant"] = $post->app_name;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function getunderqueryunit() {
        $columns = array(
            0 => 'unit_id',
            1 => 'unitname',
            2 => 'entpname',
            3 => 'unitaddress',
            4 => 'unitapplicant',
            5 => 'action'
        );
        $limit = $this->input->post("length");
        $start = $this->input->post("start");
        $order = $columns[$this->input->post("order")[0]["column"]];
        $dir = $this->input->post("order")[0]["dir"];
        if (empty($this->input->post("search")["value"])) {
            $records = $this->all_rows($limit, $start, $order, $dir, "underquery");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        } else {
            $search = $this->input->post("search")["value"];
            $records = $this->search_rows($limit, $start, $search, $order, $dir, "underquery");
            $totalFiltered = $records["totalrows"];
            $totalData = $totalFiltered;
        }
        $data = array();
        if (!empty($records["result"])) {
            foreach ($records["result"] as $post) {
                //print_r($post);die();
                $id = $post->unit_id;
                $action = '<a href="' . base_url("cms/unit/manageunit/$id/") . '" class="btn btn-warning">View</a>&nbsp;&nbsp;<a href="' . base_url("cms/unit/manageunit/$id/") . '" class="btn btn-primary">Edit</a>';
                $address = $post->address;
                $fulladdress = $this->address_model->get($address);
                $nestedData["unit_id"] = $id;
                $nestedData["unitname"] = $post->unit_name;
                $nestedData["entpname"] = $post->entp_name;
                $nestedData["unitaddress"] = $fulladdress->house_no . " , " . $fulladdress->street . " , " . $fulladdress->village . " , " . $fulladdress->state . " , " . $fulladdress->dist . " , " . $fulladdress->pin;
                $nestedData["unitapplicant"] = $post->app_name;
                $nestedData["action"] = $action;
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw" => intval($this->input->post("draw")),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );
        echo json_encode($json_data);
    }

    function all_rows($limit, $start, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $this->db->from("unit");
        $this->db->join("caf", "unit.caf_id=caf.caf_id");
        $this->db->join("unit_applicant_details", "unit.unit_id=unit_applicant_details.u_id");
        if ($type == "approved") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "1");
        } else if ($type == "underquery") {
            $this->db->where("caf.query_status", "1");
            $this->db->where("caf.status", "0");
        } else if ($type == "unapproved") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "0");
        } else if ($type == "rejected") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "2");
        }

        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }//End of if else
    }

//End of all_rows()

    function search_rows($limit, $start, $search, $col, $dir, $type = NULL) {
        $this->load->database();
        $this->db->select("*");
        $this->db->from("unit");
        $this->db->join("caf", "unit.caf_id=caf.caf_id");
        $this->db->join("unit_applicant_details", "unit.unit_id=unit_applicant_details.u_id");
        $this->db->where("(`caf`.`entp_name` LIKE '%$search%' ESCAPE '!'
                            OR  `users`.`name` LIKE '%$search%' ESCAPE '!'
                            OR  `users`.`phone` LIKE '%$search%' ESCAPE '!'
                            )");
        if ($type == "approved") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "1");
        } else if ($type == "underquery") {
            $this->db->where("caf.query_status", "1");
            $this->db->where("caf.status", "0");
        } else if ($type == "unapproved") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "0");
        } else if ($type == "rejected") {
            $this->db->where("unit.submitstatus", "1");
            $this->db->where("unit.approvalstatus", "2");
        }
        $this->db->limit($limit, $start);
        $this->db->order_by($col, $dir);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            $this->db->close();
            return NULL;
        } else {
            $this->db->close();
            $tmp = array(
                "totalrows" => $query->num_rows(),
                "result" => $query->result()
            );
            return $tmp;
        }
    }

    //End of searchrows

    function change_unit_password($unit_id, $password) {
        $data = array(
            "app_password" => $this->create_hashed_password($password)
        );
        $this->load->database();
        $this->db->where("unit_master_record_id", $unit_id);
        $this->db->update("unit_master_record", $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}

//End of unit model
