<?php 
require_once "../requires/login_session.php";

$query=$fire->query("select user_id,uname from users where utype='2'");


while($results=$query->fetch_object()){
	$user_id=$results->user_id;
	$uname=$results->uname;
	$uname_split=Array();
	$uname_split=explode(" ",$uname);
	$uname=$uname_split[0];
	$fire->query("update users set uname='$uname' where user_id='$user_id'");
}

?>