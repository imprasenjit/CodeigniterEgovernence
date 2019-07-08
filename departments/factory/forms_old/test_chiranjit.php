<?php 
$user_email="chiranjit@avantikain.com,chiranjit1808@rediffmail.com,chiranjitdas1808@yahoo.com";
$dept_email="chiranjit1808@gmail.com";
$str="Thank You email";
$test=2;
$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form 1</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>
		'.$test.'
		Thank u world !!!
		</body>
		</html>';

$mypdf=uniqid(rand()).".pdf";
/*---------mpdf logic-----------*/
require_once "../../../mpdf60/mpdf.php"; 
$mpdf=new mPDF('c','A4','','' , 10 , 10 , 10 , 10 , 0 , 0); 
$mpdf->SetDisplayMode('fullpage');
// 1 or 0 - whether to indent the first level of a list 
$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($printContents);         
$mpdf->Output($mypdf,'F');
require_once "../../../mailsending/sendAttachment.php";		
$emal=$dept_email.",".$user_email;
send_attachment($emal,$str,$mypdf);
unlink($mypdf);
?>