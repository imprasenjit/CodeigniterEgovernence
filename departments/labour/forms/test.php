<?php
require_once "../../requires/login_session.php";
$dept = "labour";
$form = "1";
$ci->load->helper('get_uain_details');
echo $table_name = getTableName($dept, $form);
require_once "../../../views/users/requires/test.php";
//echo $ci->load->view("users/requires/test");
//include "../../requires/check_form_save_mode.php";

$get_file_name = basename(__FILE__);

?>
<?php $ci->load->view("users/requires/cssjs"); //require '../../../user_area/includes/css.php'; ?>
<?php $ci->load->view("users/requires/header"); //require '../../../user_area/includes/header.php';  ?>