<?php
ob_start();

$ciIndex = $_SERVER['DOCUMENT_ROOT'].'/eodbci/index.php';
require_once($ciIndex);
ob_end_clean();
$ci = & get_instance();

$ci->load->library('session');

if(!isset($_SESSION["userlogged"]) || $_SESSION["userlogged"]!=true){
    header("Location: /eodbci/site/login");
    ob_end_flush();
    exit;
}

$user_id = $ci->session->user_id;
$swr_id = $unit_id = $ci->session->unit_id;
//print_r($ci->session);die();

if($unit_id==""){
	echo "<script>alert('Kindly select the UNIT first, for which you want to submit this application form.');
	window.location.href = '/eodbci/users/';
	</script>";
	exit();
	
}
$user_email = $ci->session->user_email;

require_once($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/db_config/DbConnect.php');
$dbconnect = new DbConnect();

require_once($_SERVER['DOCUMENT_ROOT'].'/eodbci/departments/controllers/Form_functions.php');
$formFunctions = new Form_functions();

$qry = $dbconnect->executeQuery("dicc", "SELECT caf_id,ubin,unit_name,app_email,mobile_no,email_id,landline_std,landline_no,app_name,app_mobile_no,app_email,app_designation,unit_type,dateofcommencement,business_type,address,app_addressid,area_type,land_status,land_type,mouza,patta_no,dag_no,revenue_circle,block,investment_size,no_of_employee,operation_sector,entp_category FROM unit_master_record WHERE unit_id='$unit_id' and status='1'");
if($qry->num_rows==0){
	//die($unit_id);
	header("Location: /eodbci/users/");
    exit;
}
$row = $qry->fetch_assoc();

$ci->load->model('forms/common/Form_details_model');
$ci->load->model('eodbfunctions/GetDistrict_model');
$ci->load->helper('address');

$trade_name=$unit_name=$row['unit_name']; $ubin=$row['ubin']; $b_mobile_no=$row['mobile_no']; $b_email=$row['email_id'];$b_landline_std = $row['landline_std']; $b_landline_no=$row['landline_no']; $gmc_zone=$b_block=$row['block'];

$key_person=$row['app_name']; $status_applicant=$row['app_designation'];$mobile_no=$row['app_mobile_no'];$email = $row['app_email'];

$unit_type = $row['unit_type']; $date_of_commencement=$row['dateofcommencement'];


$t_o_area=$row['area_type'];$land_status=$row['land_status'];$land_type=$row['land_type'];$mouza=$row['mouza'];$patta_no=$row['patta_no'];$dag_no=$row['dag_no'];$circle=$revenue_circle=$row['revenue_circle'];

$c_o_Enterprise=$entp_category=$row['entp_category'];

    
$address=$row['address'];
$app_addressid=$row['app_addressid'];

$business_type=$row['business_type'];
$gmc_zone_name=getZone($gmc_zone);

$e_n_employee=$no_of_employee=$row['no_of_employee'];
if($e_n_employee=="L10") $e_n_employee="5 To 10";
else if($e_n_employee=="L20") $e_n_employee="10 To 20";
else if($e_n_employee=="L50") $e_n_employee="20 To 50";
else if($e_n_employee=="G50")$e_n_employee="50 or more";
else $e_n_employee="Less than 5";
   
 
$cap_investment=$investment_size=$row['investment_size'];
if($cap_investment==10) $cap_investment="Below INR 10 LAKH";
else if($cap_investment==25) $cap_investment="INR 10 LAKH to 25 LAKH";
else if($cap_investment==200) $cap_investment="INR 25 LAKH to 2.00 CRORE";
else if($cap_investment==500) $cap_investment="INR 2.00 CRORE to 5.00 CRORE";
else if($cap_investment==1000) $cap_investment="INR 5.00 CRORE to 10.00 CRORE";
else $cap_investment="Above 10.00 CRORE";

$operation_sector=$row['operation_sector'];
//$business_type=get_sector_classes_b_value($business_type);

$caf_id=$row['caf_id'];

$caf_qry = $dbconnect->executeQuery("dicc", "SELECT owner_names,entity_id,pan  FROM caf WHERE caf_id='$caf_id'");
$caf_row = $caf_qry->fetch_assoc();

$owner_names = implode(",",json_decode($caf_row['owner_names']));
$owners = json_decode($caf_row['owner_names']);
//print_r($owners);die();


$pan_no=$caf_row['pan'];
$entity_id = $caf_row['entity_id'];

$business_entities_qry = $dbconnect->executeQuery("dicc", "SELECT entity_name,entity_code FROM business_entities WHERE entity_id='$entity_id'");
$business_entities_row = $business_entities_qry->fetch_assoc();
$Type_of_ownership = $legal_entity = $business_entities_row["entity_name"];
$owner_type = $business_entities_row["entity_code"];

$owner_type_name = get_legal_entity($owner_type);
   
    
$address_qry = $dbconnect->executeQuery("dicc", "SELECT * FROM address WHERE id IN ('$address','$app_addressid')");
$address_sl=1;
//print_r($address_qry->fetch_assoc());die();
while($address_row = $address_qry->fetch_assoc()){
    if($address_sl==1){
		$b_dist_id = $address_row['dist'];
		
      $b_street_name1=isset($address_row['house_no'])?$address_row['house_no']:"Not found";
$b_street_name2=isset($address_row['street'])?$address_row['street']:"Not found";
$b_vill=isset($address_row['village'])?$address_row['village']:"Not found";
$b_dist=getDistrict($address_row['dist'])?getDistrict($address_row['dist'])->dist_name:"Not Found";

//$b_block=isset($address_row['block'])?$address_row['block']:"Not found";

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
    
$subdivision=isset($address_row['subdivision'])?$address_row['subdivision']:"Not found";
    }
    $address_sl++;
}



$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email."<br/>Sub-Division : ".$subdivision;
$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

//$address_qry = $dbconnect->executeQuery("dicc", "SELECT * FROM unit_landdetails WHERE unit_id='$unit_id'");


$area=$from;

$landline_std = "";
$landline_no = "";
?>
