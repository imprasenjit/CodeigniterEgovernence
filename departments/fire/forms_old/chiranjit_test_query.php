<?php  require_once "../../requires/login_session.php"; 
$district_query=$mysqli->query("select * from district");

while($rows=$district_query->fetch_object()){
	$district_id=$rows->dist_id;
	$district_name=$rows->district;
	$fire->query("update `nearest_fire_stations` set district_id='$district_id' where district_id='$district_name'");
}
?>