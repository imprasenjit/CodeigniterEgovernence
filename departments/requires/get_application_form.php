<?php
ob_start();

$ciIndex = $_SERVER['DOCUMENT_ROOT'].'/eodbci/index.php';
require_once($ciIndex);
ob_end_clean();
$ci = & get_instance();

//echo "<b>SESSION FROM EODBCI</b><br />";
$ci->load->library('session');
//echo "<pre>";
//var_dump($_SESSION);
//echo "</pre>";
//die();
if(!isset($_SESSION["userlogged"]) || $_SESSION["userlogged"]!=true){
    header("Location: /eodbci/site/login");
    ob_end_flush();
    exit;
}

$user_id = $ci->session->user_id;
$swr_id = $unit_id = $ci->session->unit_id;

require_once($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/db_config/DbConnect.php');
$dbconnect = new DbConnect();

require_once($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/controllers/Form_functions.php');
$formFunctions = new Form_functions();
//echo "<br /><br /><b>UNIT MASTER RECORD FOR UNIT_ID=".$unit_id." : </b><br />";
//$ci->load->database();
//$qry = $ci->db->query("SELECT * FROM unit_master_record WHERE unit_id='$unit_id'");
//$ci->db->close();
//var_dump($row = $qry->result());
//echo "</pre>";
//die();

$qry = $dbconnect->executeQuery("dicc", "SELECT caf_id,ubin,unit_name,app_email,mobile_no,email_id,landline_std,landline_no,app_name,app_mobile_no,app_email,app_designation,unit_type,dateofcommencement,business_type,address,app_addressid FROM unit_master_record WHERE unit_id='$unit_id'");
$row = $qry->fetch_assoc();
//echo "<pre>";
//print_r($row);
//echo "</pre>";
//die();

$ci->load->model('forms/common/Form_details_model');
$ci->load->model('eodbfunctions/GetDistrict_model');

$unit_name=$row['unit_name']; $ubin=$row['ubin']; $b_mobile_no=$row['mobile_no']; $b_email=$row['email_id'];$b_landline_std = $row['landline_std']; $b_landline_no=$row['landline_no'];

$key_person=$row['app_name']; $status_applicant=$row['app_designation'];$mobile_no=$row['app_mobile_no'];$email = $row['app_email'];

$unit_type = $row['unit_type']; $date_of_commencement=$row['dateofcommencement'];


$address=$row['address'];
$app_addressid=$row['app_addressid'];

$business_type=$row['business_type'];

//$business_type=get_sector_classes_b_value($business_type);

$caf_id=$row['caf_id'];

$caf_qry = $dbconnect->executeQuery("dicc", "SELECT owner_names,entity_id  FROM caf WHERE caf_id='$caf_id'");
$caf_row = $caf_qry->fetch_assoc();

$owner=$caf_row['owner_names'];
$owner_type=$caf_row['entity_id'];

$address_qry = $dbconnect->executeQuery("dicc", "SELECT * FROM address WHERE id IN ('$address','$app_addressid')");
$address_sl=1;
//print_r($address_qry->fetch_assoc());die();
while($address_row = $address_qry->fetch_assoc()){
    if($address_sl==1){
        $b_street_name1=$address_row['house_no'];$b_street_name2=$address_row['street'];$b_vill=$address_row['village'];$b_dist=$address_row['dist'];$b_block=$address_row['block'];$b_pincode=$address_row['pin'];$b_state=$address_row['state'];
    }else{
        $street_name1=$address_row['house_no'];$street_name2=$address_row['street'];$vill=$address_row['village'];$dist=$address_row['dist'];$block=$address_row['block'];$pincode=$address_row['pin'];$state=$address_row['state'];
    }
    $address_sl++;
}

$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

?>