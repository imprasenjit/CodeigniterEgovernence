<?php
require_once "../../../conf/dbconnect.php";
$uain=  protect($_GET["uain"]);
$swr_id=  clean($_GET["swr_id"]);

//$records=$tcp->query("SELECT a.form_id FROM tcp_form1 a, tcp_form1_process b WHERE a.uain='$uain' and a.save_mode='C' and b.form_id=a.form_id and b.process_type='I'");
$records=$tcp->query("SELECT form_id,user_id FROM tcp_form1 WHERE uain='$uain' and save_mode='C'");

if($records->num_rows > 0) {
	$business_id=$records->fetch_object()->user_id;
	$form_id=$records->fetch_object()->form_id;
	if($swr_id==$business_id){
		$results=$tcp->query("SELECT form_id FROM tcp_form1_process WHERE form_id='$form_id' and process_type='I'");
		if($results->num_rows>0){
			echo '3';
		}else{
			echo '2'; //Sorry, The NOC for this Application UAIN is not issued yet.
		}
	}else{
		echo '1'; //Sorry, Given UAIN is not submitted by you.
	}   
}else{
	echo '0'; //Sorry, Given UAIN is not found.
}
    
?>