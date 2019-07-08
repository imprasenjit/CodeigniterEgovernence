<?php
Class Sms_functions extends DbConnect{
	public function send_mobile_otp($user_id) {

		$mobile_otp=mt_rand(100000, 999999);
		
		$users_result=$this->executeQuery("dicc","select phone from users where id='$user_id'");
		if($users_result){
			$phone=$users_result->fetch_object()->phone;
			
			$results=$this->executeQuery("dicc","select otp from users_mobile_otps where user_id='$user_id'");
			if($results->num_rows>0){
				$mobile_otp=$results->fetch_object()->otp;
				$msg_string=$this->get_sms_otp_string($mobile_otp);
				$this->send_sms($phone,$msg_string);
				return 1;
			}else{
				$save_query=$this->executeQuery("dicc","INSERT INTO users_mobile_otps(user_id,mobile_no,otp) VALUES('$user_id','$phone','$mobile_otp')") or die($mysqli->error);
				if($save_query){
					$msg_string=$this->get_sms_otp_string($mobile_otp);
					$this->send_sms($phone,$msg_string);
					return 1;
				}else{
					return 0;
				}
			}
		}else{
			return 0;
		}
    }
	public function get_sms_otp_string($mobile_otp) {
		$endTime = date("H:i",time() + 1800);
		$string="Your One Time Password (OTP) for Registration on EODB Assam is ".$mobile_otp.", which is valid till ".$endTime.". DO NOT SHARE THIS WITH ANYBODY- EODB ASSAM";
		return $string;
	}
	public function is_mobile_no_verified($user_id){
		global $mysqli;
		$results=$mysqli->query("select phone from users where id='$user_id' and mobile_verify='Y'") or die($mysqli->error);
		if($results->num_rows>0){
			$mobile_no=$results->fetch_object()->phone;	
			return $mobile_no;
		}else{
			return 0;
		}		
	}
	public function send_sms_approved_caf($user_id,$ubin) {
		$mobile_no=$this->is_mobile_no_verified($user_id);
		$msg_string="Your CAF has been successfully verified by SWA, Govt. of Assam. Your UBIN is ".$ubin." . Helpline 7086044425 - EODB ASSAM";
		$this->send_sms($mobile_no,$msg_string);
		return 1;		
	}
	public function send_sms_send_caf_query($user_id) {
		$mobile_no=$this->is_mobile_no_verified($user_id);
		$msg_string="Details of discrepancies noted by SWA against your CAF has been sent to your registered email. Please take necessary action. Helpline 7086044425 - EODB ASSAM";
		$this->send_sms($mobile_no,$msg_string);
		return 1;		
	}
	public function send_sms_submitted_application($user_id,$uain) {
		$mobile_no=$this->is_mobile_no_verified($user_id);
		$msg_string="Your application form with UAIN - " .$uain. " has been successfully submitted. Helpline 7086044425 - EODB ASSAM";
		$this->send_sms($mobile_no,$msg_string);
		return 1;		
	}
	
	public function send_sms($msisdn,$msg_string) {
		if($msisdn!=0 && is_numeric($msisdn) && strlen($msisdn)==10){
			$save_msg=$msg_string;
			$msg_string=urlencode($msg_string);
			$msisdn=urlencode($msisdn);
			
			$rsp=file_get_contents("http://103.8.249.55/smsgwam/form_/send_api_edb_get.php?username=edbgov&password=edbdb@123&groupname=EDBGOV&to=$msisdn&msg=$msg_string");
			$rsp=1;

			if($rsp){			
				$file = $_SERVER["DOCUMENT_ROOT"].'/mobile_sms_log_file.txt';
				$write_text = PHP_EOL . "
				
				DATETIME : ".date("d-m-Y H:i:s")."  Mobile Number : ".$msisdn."   Message : ".$save_msg. PHP_EOL;			
				file_put_contents($file, $write_text, FILE_APPEND | LOCK_EX);
				
				return 1;
			}else{
				return 0;
			}
			
		}else{
			return 0;
		}		
    }
}
?>