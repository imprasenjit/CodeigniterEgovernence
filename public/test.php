<?php
defined("BASEPATH") OR exit("No direct script access allowed");
class Users extends Alom {
    function __construct(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        $this->load->model("mobile/users_model");
    }
    
    function index() {
        $res = $this->users_model->get_rows();
        echo json_encode($res);
    }//End of index()
        
    function addrow() {
        $this->load->helper("sendmail_helper");
        $nowTime = date("Y-m-d H:i:s");
        $json = file_get_contents("php://input");
        $obj = json_decode($json);
        $up_type = $obj->up_type;
        $up_mail = $obj->up_mail;
        if($this->users_model->email_signin($up_mail)) {
            echo json_encode(array("flag" => 0, "msg"=>"Email already exist!"));
        } else {
            $up_pass = md5($obj->up_pass);
            $up_name = strstr($up_mail, '@', true);
            $data = array(
                "entry_time" => $nowTime,
                "up_type" => $up_type,
                "up_name" => $up_name,
                "up_mail" => $up_mail,
                "up_pass" => $up_pass,
            );
            $this->users_model->add_row($data);

            $up_id = $this->db->insert_id();
            $code = rand(1000, 9999);
            $par = $up_id."|||".$code;
            $this->load->model("admin/verifycodes_model");
            $this->verifycodes_model->add_row(array("entry_time" => $nowTime, "up_id" => $up_id, "code"=> $code, "code_type"=>1));        
            $this->load->helper("encode");
            $vlink = base_url("verify/index/").encodeme($par);

            $sub = "Verify your email for Casualhours";
            $body = "Please use the O.T.P. <b>".$code."</b>, or click the link below to verify your email<br /><a href='".$vlink."' target='_blank'>Verify now</a>";
            sendmail($up_mail, $sub, $body);
            echo json_encode(array("flag" => 1, "msg"=>"Account created successfully!"));
        }//End of if else        
    }//End of addrow()
    
        
    function editrow() {
        $json = file_get_contents("php://input");
        $obj = json_decode($json);
        
        $up_id = $obj->up_id;
        $up_name = $obj->up_name;
        $up_about = $obj->up_about;
        $up_address = $obj->up_address;
        $up_dob = date("Y-m-d", strtotime($obj->up_dob));
        $up_phone = $obj->up_phone;
        $service_id = $obj->service_id;
        $subservice_ids = implode(",",$obj->subservice_ids);
        $skill_ids = implode(",",$obj->skill_ids);
        $up_qualification = $obj->up_qualification;
        $up_experience = $obj->up_experience;

        $data = array(
            "up_name" => $up_name,
            "up_about" => $up_about,
            "up_address" => $up_address,
            "up_dob" => $up_dob,
            "up_phone" => $up_phone,
            "service_id" => $service_id,
            "subservice_ids" => trim($subservice_ids, ","),
            "skill_ids" => trim($skill_ids, ","),
            "up_qualification" => $up_qualification,
            "up_experience" => $up_experience
        );
        $this->users_model->edit_row($up_id, $data);
        echo json_encode(array("flag" => 1, "msg"=>"Account updated successfully!"));        
    }//End of editrow()
    
    function signin() {
        $json = file_get_contents("php://input");
        $obj = json_decode($json);
        $up_mail = $obj->up_mail;
        $up_pass = md5($obj->up_pass);
        if($this->users_model->email_signin($up_mail)) {
            $row = $this->users_model->email_signin($up_mail);
            $up_id = $row->up_id;
            $up_type = $row->up_type;
            $dbpass = $row->up_pass;
            if($up_pass == $dbpass) {
                $uid=$up_id;
                $flag=1;
                $msg = "Login successful!";
            } else {
                $uid=$flag=0;
               $msg = "Password does not matched!!"; 
            }
        } else {
            $uid=$flag=$up_type=0;
            $msg = "Email id does not matched!!";
        }//End of if else
        echo json_encode(array('flag' => $flag, 'msg'=>$msg, 'up_id'=>$uid, 'up_type'=>$up_type));
    }//End of signin()
    
    function getrows() {
        $res = $this->users_model->get_rows();
        echo json_encode($res);
    }//End of getrows()
    
    function getutyperows($up_type=NULL) {
        $res = $this->users_model->get_utyperows($up_type);
        echo json_encode($res);
    }//End of getutyperows()
    
    function getprofile($up_id=NULL) {
        $this->load->model("mobile/skills_model");
        $row = $this->users_model->get_row($up_id);
        $entry_time = date('jS F Y', strtotime($row->entry_time));
        $up_name = $row->up_name;
        $up_about = $row->up_about;
        $up_address = $row->up_address;
        $up_dob = date('l, jS F Y', strtotime($row->up_dob));
        $up_mail = $row->up_mail;
        $up_type = $row->up_type;
        $up_phone = $row->up_phone;
        $up_image = $row->up_image;
        $portfolio = $row->portfolio;
        $up_purpose = "";//$row->up_purpose;
        $skill_ids = $row->skill_ids;
        $arr = explode(",", $skill_ids);
        $skills = "";
        for($i=0; $i<count($arr); $i++) {
            $skill_id = $arr[$i];
            if($this->skills_model->get_row($skill_id)) {
                $skills = $skills.", ".$this->skills_model->get_row($skill_id)->skill_name;
            }
        }
        $up_qualification = $row->up_qualification;
        $up_experience = $row->up_experience;
                
        $res = array(
            "up_id" =>$up_id,
            "entry_time" =>$entry_time,
            "up_name" =>$up_name,
            "up_about" =>$up_about,
            "up_address" =>$up_address,
            "up_dob" =>$up_dob,
            "up_mail" =>$up_mail,
            "up_type" =>$up_type,
            "up_phone" =>$up_phone,
            "up_image" => $up_image,
            "portfolio" =>$portfolio,
            "up_purpose" =>$up_purpose,
            "skills" =>trim($skills, ","),
            "up_qualification" =>$up_qualification,
            "up_experience" =>$up_experience
        );
        echo json_encode($res);
    }//End of getprofile()
    
    function getrow($up_id=NULL) {
        $res = $this->users_model->get_row($up_id);
        echo json_encode($res);
    }//End of getrow()

    function uploads() { 
        $nowTime = time();
        if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"])) {
            $fle = explode(".", $_FILES["profilepic"]["name"]);
            $nm = reset($fle);
            $nms = explode("-", $nm);
            $up_id = reset($nms);
            $db_fld = end($nms);
            $ext = end($fle);
            $rename = $nowTime.".".$ext;
            
            $config['upload_path'] = 'storage/uploads/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
            $config["file_name"] = $nowTime.".".$ext;
            
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('profilepic')) {
                $data_upload = $this->upload->data();
                $msg = $filePath = base_url('storage/uploads/'.$rename);
                $this->users_model->edit_row($up_id, array($db_fld=>$filePath));
            }  else {
                $msg =  $this->upload->display_errors();
            }
        } else {
            $msg =  "File not uploaded!";
        }//End of if else
        echo $msg;
    }//End of uploads()
}//End of Users
