<?php if(!defined("BASEPATH")) exit("No direct script access allowed");
	class DraftNotifications_model extends CI_Model{
		function getNotifications(){
			$this->load->database();
			$this->db->where("type",2);
			$this->db->where('status',1);
			$this->db->order_by('Noti_date', 'DESC');
			$query=$this->db->get("post");
			$this->db->close();
			return $query->result_array();
		}//End of getNotifications();
		
		function getNotificationsById($id){
			$this->load->database();
			$this->db->select('*');
			$this->db->from('post');
			$this->db->where('id',$id);
			$query=$this->db->get();
			$this->db->close();
			return $query->result_array();
		}
		function truncateString($str, $chars, $to_space, $replacement='...') {
			if($chars > strlen($str)) return $str;
			$str = substr($str, 0, $chars);
			$space_pos = strrpos($str, " ");
			if($to_space && $space_pos >= 0) 
			{$str = substr($str, 0, strrpos($str, " "));
			}
			return($str.$replacement);
		}//End Of truncateString();
		
		function ntop($string)
		{
			$paragraphs = '';
			foreach (explode("\n", $string) as $line) {
				if (trim($line)) {
					$paragraphs .= '<p>' . $line . '</p>';
				}
			}
			return $paragraphs;
		}//End o ntop();
		
		function postComment(){		    
		    $name=$this->session->userdata("user_name");
		    $email=$this->session->userdata("user_email");
		    $phone=$this->session->userdata("user_phone");
			$comment=$this->input->post("comment");
			$pid=$this->input->post("pid");
			$date=date("Y-m-d H:i:s");
			$this->load->database();
			$data = array(
			'subject' => $name,
			'p_id' => $pid,
			'time' => $date,
			'email' => $email,
			'phone' => $phone,
			'comment' => $comment,
			'status' => 0,
			'email_status' => 'verified',
			);
			
			$this->db->insert('post_comment', $data);	
			if($this->db->insert_id() > 0)
			{
		        $this->db->close();
				echo json_encode(array('x' =>1));
			}
			else{
                $this->db->close();
				echo json_encode(array('x' =>0));
			}
		}//End of Post Comment();
		
		function getComments($postID){
			$this->load->database();
			$this->db->select("*");
			$this->db->from("post_comment");
			$this->db->where("p_id",$postID);
			$query=$this->db->get();
			$this->db->close();
			return $query->result_array();
		}// End of getComments
		
		function likeThePost(){
			
			$pid=$this->input->post("id");
			$flag=$this->input->post("flag");
			$this->load->database();
			$this->db->select("likes");
			$this->db->from("post");
			$this->db->where("id",$pid);		
			
			$count_like=$this->db->count_all_results();
			
			$getPost=$this->getNotificationsById($pid);
			
			$like_count=$getPost[0]["likes"];
			$dislike_count=$getPost[0]["dislike"];
			
			$userid=$this->session->userdata("user_id");
			
			$this->load->model("eodbfunctions/getUser_model");
 	        $userdata=$this->getUser_model->getUserById($userid);
			$this->load->database();
			$email=$userdata[0]["email"];
			$this->db->select("*");
			$this->db->from("post_like");
			$this->db->where("email",$email);
			$this->db->where("p_id",$pid);          	
			$like=$this->db->count_all_results();
			//echo $like->num_rows=1;
			
			if($flag==1){
				if($like >0){
					echo ''.$like_count.'';
					}else{
					$data=array(
					"email"=>$email,
					"p_id"=>$pid,
					"status"=>$flag
					);
					$this->db->insert('post_like', $data);
					
					if($this->db->insert_id() > 0)
					{
						$update_like_count=$like_count+1;
						$this->db->set('likes', $update_like_count);
						$this->db->where('id',$pid);
						$this->db->update('post');
						echo ''.$update_like_count.'';
						
					}
				}
				}else{
				
				if($like >0){
					echo ''.$dislike_count.'';
					}else{
					
						$data=array(
					"email"=>$email,
					"p_id"=>$pid,
					"status"=>$flag
					);
					$this->db->insert('post_like', $data);
					if($this->db->insert_id() > 0)
					{
					
						$update_dislike_count=$dislike_count+1;
						$this->db->set('dislike', $update_dislike_count);
						$this->db->where('id',$pid);
						$this->db->update('post');
						echo ''.$update_dislike_count.'';
						
					}
				}
				
			}
			$this->db->close();
			
		}//End of likeThePost();
		
		
		
	}