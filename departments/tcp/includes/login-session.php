<?php
include "../../../conf/dbconnect.php";
ob_start();
session_start();
$sid=$_SESSION["id"];
$swr_id=$_SESSION["swr_id"];
if(isset($_SESSION["username"], $_SESSION["id"], $_SESSION["swr_id"])) {
    $username=  protect($_SESSION["username"]);
    $userid=  protect($_SESSION["id"]); //echo $username.$userid; die();
    
    $stmt=$mysqli->prepare("SELECT * FROM users WHERE username=? AND id=? ") OR die($mysqli->error);
    $stmt->bind_param("ss",$username,$userid) OR die($mysqli->error);
    $stmt->execute() OR die($mysqli->error);
    $stmt->store_result();
	$numRows=$stmt->num_rows;
	$stmt->free_result();
	$swr_query=$mysqli->query("select id from singe_window_registration where id='$swr_id' and user_id='$userid'");
	$swr_numRows=$swr_query->num_rows;
    if($numRows == 0){
		$_SESSION['ACTION_MESSAGE']="<span style='color:red;font-weight:bold;'>Session does not exits !!!</span>";
		header("Location:".$server_url."common/login.php");exit();
	}
    if($swr_numRows == 0){
		$_SESSION['ACTION_MESSAGE']="<span style='color:red;font-weight:bold;'>Session does not exits !!!</span>";
		header("Location:".$server_url."common/login.php");exit();
	}
	
} else {
	$_SESSION['ACTION_MESSAGE']="<span style='color:red;font-weight:bold;'>Your Session has been expired !!!</span>";
    header("Location:".$server_url."common/login.php");exit();
}
?>