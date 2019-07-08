<?php 
ob_start();
require_once $_SERVER['DOCUMENT_ROOT']."/conf/dbconnect.php";
//require_once "login_session.php";
$swr_id=0;
$form_id=0;
if(isset($_GET["dept"]) && isset($_GET["form"])){
	$form=$_GET["form"];
	$dept_id=$_GET["dept"];
	$dept_query=$mysqli->query("SELECT dept_code FROM SubDepartment WHERE id='$dept_id'") or die($mysqli->error);
	if($dept_query->num_rows>0){
		$dept=$dept_query->fetch_object()->dept_code;
	}else{
		
		if(strlen($dept_id)<7){
			$dept=$dept_id;
		}else{
			echo "<script>alert('Something went wrong !!!');</script>";
			die(); 
		}
		
	}
	//$row1=$formFunctions->fetch_swr($swr_id);
	//$dist=$row1['b_dist'];
	$dept_name=$formFunctions->get_deptName($dept);
	$form_name=$formFunctions->get_formName($dept,$form);
	if($dept=="fire" && $form!=12 && $form!=13){
		$form_name="FORM OF APPLICATION FOR 'NO OBJECTION CERTIFICATE (NOC)' IN RESPECT OF FIRE SAFETY MEASURES IN ".$form_name." , ASSAM FIRE SAFETY SERVICE RULES, 1989";
	}
}else{
	echo "<script>alert('Something went wrong !!!');</script>";
	die();
}
$get_file_name="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Application Form with Acknowledgement</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../user_area/includes/css.php';?>
	<style>
	hr.style1 {
		border-top: 3px double #8c8b8b;
	}
	</style>
</head>
<?php 
$view_path=$formFunctions->get_preview_path($dept,$form);
$filebroken=Array();
$filebroken = explode( '.php', $view_path);
include ("../../".$filebroken[0].".php");
	
$printContents=$printContents.'</body></html>';

$mypdf=$dept."_Application Form - ".$form.".pdf";
ob_end_clean();
include("../../mpdf60/mpdf.php"); 
$mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($printContents);         
$mpdf->Output($mypdf,'I');
?>