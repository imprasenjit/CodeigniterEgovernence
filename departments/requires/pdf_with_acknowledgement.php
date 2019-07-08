<?php 

ob_start();
require_once "login_session.php";
$ci->load->helper('get_uain_details');
if(isset($_GET["uain"])){
	$row1=$formFunctions->fetch_swr($swr_id);
	$dist=$row1['b_dist'];
	$uain=$_GET["uain"];
	$dept=$formFunctions->get_uainDept($uain);
	$form=$formFunctions->get_uainForm($uain);
	$table_name=getTableName($dept,$form);

	$ci->load->model('eodbfunctions/GetDepartments_model');
	$dept_array = $ci->GetDepartments_model->get_deptName($dept);

	$dept_name=$dept_array["dept_name"];

	$form_name=$formFunctions->get_formName($dept,$form);
	if($dept=="fire" && $form!=11 && $form!=12){
		$form_name="FORM OF APPLICATION FOR 'NO OBJECTION CERTIFICATE (NOC)' IN RESPECT OF FIRE SAFETY MEASURES IN ".$form_name." , ASSAM FIRE SAFETY SERVICE RULES, 1989";
	}
}else{
	echo "<script>alert('Something went wrong !!!');window.location.href = '../../user_area/';</script>";
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
	<?php //require '../../user_area/includes/css.php';?>
	<style>
	hr.style1 {
		border-top: 3px double #8c8b8b;
	}
	</style>
    </head>
<?php //$css="";
$view_path=$formFunctions->get_printpath($dept, $form);
//$filebroken=Array();
$filebroken = explode( '.php', $view_path);
include ("../../".$filebroken[0].'.php');

$printContents=$printContents.'
<hr class="style1">
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<h3 class="text-center"><u>Acknowledgement</u></h3>
		<p class="text-center"> <strong>Your '.strtoupper($form_name).' has been submitted successfully to '.strtoupper($dept_name).' , '.ucwords($dist).' , Assam.</strong></p>
		<p class="text-center">Your <b>Unique Application Identification Number (UAIN)</b> is <b>'.$uain.'</b></p>		
		<p>You may track your application by entering this UAIN in the <b>Track Your Application</b> search box or clicking on <b>My Applications</b> in the dashboard. For any further query or help, you may contact us on our helpline number +91 70860 44425 and/or email us at eodb.assam@gmail.com.</p>
		<p align="justify"><b>Disclaimer : This is a computed generated acknowledgement, which is subject to granting of the final approval from the concerned authority. This acknowledgement should not be treated as the approval or its substitute for the purpose of any other application and/or approval. The concerned authority holds no responsibility if any other approvals are granted based on this acknowledgement.</b></p>
	</div>
</div></body></html>';
/* echo $printContents;
die(); */
$mypdf="Acknowledgement-".$uain.".pdf";
$ci->load->library('Tcpdflib');

ob_end_clean();

$pdf = new Tcpdflib('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetTitle($mypdf);
$pdf->AddPage(); 

$pdf->writeHTML(utf8_encode($printContents), true, false, true, false, '');
//$pdf->Output('storage/'.$mypdf, 'I');
//ob_end_flush();
$pdf->Output($mypdf, 'I');
//include("../../mpdf60/mpdf.php"); 
//$mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
//$mpdf->SetDisplayMode('fullpage');
//$mpdf->list_indent_first_level = 0;
//$mpdf->WriteHTML($printContents);         
//$mpdf->Output($mypdf,'I');
exit();
?>