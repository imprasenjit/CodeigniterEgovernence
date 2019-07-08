<?php
ob_start();

$ciIndex = $_SERVER['DOCUMENT_ROOT'].'/eodbci/index.php';
require_once($ciIndex);
ob_end_clean();
$ci = & get_instance();
$ci->load->helper('address');

//$user_id = $ci->input->get("user_id");
$swr_id = $unit_id = $ci->input->get("swr_id");
$form_id = $ci->input->get("form_id");
$dept = $ci->input->get("dept");
$form = $ci->input->get("form");

require_once ($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/db_config/DbConnect.php');
$dbconnect = new DbConnect();

require_once ($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/controllers/Form_functions.php');
$formFunctions = new Form_functions();

$qry = $dbconnect->executeQuery("dicc", "SELECT caf_id,ubin,unit_name,app_email,mobile_no,email_id,landline_std,landline_no,app_name,app_mobile_no,app_email,app_designation,unit_type,dateofcommencement,business_type,address,app_addressid FROM unit_master_record WHERE unit_id='$unit_id'");
$row = $qry->fetch_assoc();

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
$legal_entity = $owner_type=$caf_row['entity_id'];

$address_qry = $dbconnect->executeQuery("dicc", "SELECT * FROM address WHERE id IN ('$address','$app_addressid')");
$address_sl=1;
//print_r($address_qry->fetch_assoc());die();
while($address_row = $address_qry->fetch_assoc()){
    if($address_sl==1){
        $b_street_name1=isset($address_row['house_no'])?$address_row['house_no']:"Not found";
$b_street_name2=isset($address_row['street'])?$address_row['street']:"Not found";
$b_vill=isset($address_row['village'])?$address_row['village']:"Not found";
$b_dist=getDistrict($address_row['dist'])?getDistrict($address_row['dist'])->dist_name:"Not Found";
$b_block=isset($address_row['block'])?$address_row['block']:"Not found";
$b_pincode=$address_row['pin'];
$b_state=getState($address_row['state'])?getState($address_row['state'])->state_name:"Not Found";
    }else{
        $street_name1=isset($address_row['house_no'])?$address_row['house_no']:"Not found";
$street_name2=isset($address_row['street'])?$address_row['street']:"Not found";
$vill=isset($address_row['village'])?$address_row['village']:"Not found";
$dist=getDistrict($address_row['dist'])?getDistrict($address_row['dist'])->dist_name:"Not Found";
$block=isset($address_row['block'])?$address_row['block']:"Not found";
$pincode=$address_row['pin'];
$state=getState($address_row['state'])?getState($address_row['state'])->state_name:"Not Found";
    }
    $address_sl++;
}

$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
$landline_std = "";
$landline_no = "";
if(isset($form_id) && $form_id!=""){
    $ci->load->helper("get_uain_details_helper");
    $get_file_name=basename(__FILE__);$css="1";
    $view_path=$formFunctions->get_printpath($dept,$form);
    $filebroken=Array();
    $filebroken = explode( '.php', $view_path);
    include ("../../".$filebroken[0].'.php');

    echo $printContents;
}else{
    echo "<h3>Something went wrong</h3>";
}


?>
