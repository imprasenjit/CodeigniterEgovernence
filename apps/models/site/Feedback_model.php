<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class Feedback_model extends CI_Model{
		
		function getFeedbacks(){
			$this->load->database();
			$this->db->where("active",1);
			$this->db->order_by('id', 'DESC');
			$query=$this->db->get("feedback_records");
			$this->db->close();
			return $query->result();
			
		}//End of getFeedback() ;
		function storeFeedback(){
		    $this->load->model("eodbfunctions/getSubDepartment_model");
            $this->load->helper("userinfo");
			$name=$this->input->post('name');
			$business_type=$this->input->post('business_type');
			if($business_type=="B"){
				$business_name=$this->input->post('business_name');
				}else{
				$business_name="";
			}
			$email=$this->input->post('email');
			$dept=$this->input->post('dept');
			$ip_address=get_ip();
			$issue_date=date("Y-m-d H:i:s");
			if($dept=="General" || $dept==""){
				$dept_name="General";
				}else{				
				$dept_name=$this->getSubDepartment_model->get_deptbycode($dept)->name;
			}
			$issue=$this->input->post('issue');
			if($issue=="GF") $issue="General Feedback";
			else if($issue=="OS") $issue="Online Services";
			else if($issue=="OP") $issue="Online Processing";
			else if($issue=="PR") $issue="Payment Related";
			else $issue="Others - ".$_POST['inputIssue'];
			$contact=$this->input->post('phone_no');
			$comments=$this->input->post('enq_msg');
			if($name ==""){
				$errorMsg=  "Please Enter Your Full Name";
				$code= "1";
				$success=FALSE;
				}elseif(!preg_match("/^[A-Za-z0-9.\s]+$/", $name)){
				$errorMsg=  "No special characters are allowed except Dot";
				$code= "1";
				$success=FALSE;
				}elseif($email ==""){ 
				$errorMsg=  "Please Enter Your Email";
				$code= "2" ;
				$success=FALSE;
				}elseif(strlen($contact)!=10){
				$errorMsg=  "Please Enter 10 digit Mobile Number";
				$code= "3";
				$success=FALSE;
				}elseif(is_numeric(trim($contact)) == false){
				$errorMsg=  "Please Enter Numbers Only";
				$code= "3";
				$success=FALSE;
				}elseif($comments ==""){ 
				$errorMsg=  "Please fill out this field";
				$code= "4";
				$success=FALSE;
				}else{	
				//$insert_data=$mysqli->query("insert into feedback_records(name,business_name,email,phone_no,enq_msg,dept,issue,issue_date,ip_address) values('$name','$business_name','$email','$contact','$comments','$dept','$issue','$issue_date','$ip_address')") or die("Error :".$mysqli->error);
				$this->load->database();
				$data = array(
				'name' => $name,
				'business_name' => $business_name,
				'email' => $email,
				'phone_no' => $contact,
				'enq_msg' => $comments,
				'dept' => $dept,
				'issue' => $issue,
				'issue_date' => $issue_date,
				'ip_address' => $ip_address,
				);
				$this->db->insert('feedback_records', $data);		
				
				if($this->db->insert_id()){
					$admin_emails="eodb.assam@gmail.com".","."eodb@avantikain.com";
					//$admin_emails="chiranjit@avantikain.com";
					$subject = "Feedback Information (Dept. : ".$dept_name.")";
					$subject2 = "Ease of Doing Business in Assam";					
                    $success=TRUE;
					$this->load->helper("sendmail");
					$str = "We have received the following information:<br/><br/>Contact Name : ".$name."<br/><br/>Phone Number : ".$contact."<br/><br/>Email : ".$email."<br/><br/>Department : ".$dept_name."<br/><br/>Issue : ".$issue."<br/><br/>Feedback/Problem : ".$comments."<br/><br/>";
				    $str2 = "Thank you ".$name." for contacting us.<br/><br/> With Regards, <br/> Ease of Doing Business in Assam.";
				
					$send_mail=sendmail($admin_emails,$subject,$str);
					$send_mail2=sendmail($email,$subject,$str2);
					}else{
					$success=FALSE;
					//Response if the transaction is failed
				}// End of if
				$this->db->close();
			}
			
			if($success)
			{
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('x' =>1)))
				->_display();die();
			}
			else
			{
				$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('x' =>0,'error'=>$errorMsg)))
				->_display();die();
			}
			
		}//End of storeFeedback()
	}							