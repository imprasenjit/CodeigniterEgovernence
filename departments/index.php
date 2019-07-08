<?php
$ciIndex = $_SERVER['DOCUMENT_ROOT'].'/eodbci/index.php';
require_once($ciIndex);
ob_end_clean();
$CI = & get_instance();

echo "<b>SESSION FROM EODBCI</b><br />";
$CI->load->library('session');
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";

$unit_id = $CI->session->unit_id;
echo "<br /><br /><b>UNIT MASTER RECORD FOR UNIT_ID=".$unit_id." : </b><br />";
$CI->load->database();
$qry = $CI->db->query("SELECT * FROM unit_master_record WHERE unit_id='$unit_id'");
$CI->db->close();
echo "<pre>";
var_dump($qry->result());
echo "</pre>";

