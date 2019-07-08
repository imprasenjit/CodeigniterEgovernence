<?php 
require_once "../../../admin/includes/login_session.php";
ob_start();
if(isset($_GET["token"])){
	$uain=$_GET["token"];
	$form=$formFunctions->get_uainForm($uain);
	$table_name=$formFunctions->getTableName("fire",$form);
	$query="SELECT user_id FROM ".$table_name." WHERE uain='$uain'";
	$se=$fire->query($query) OR die("Error : ".$fire->error);
	$row=$se->fetch_array();
	$swr_id=$row["user_id"];
	
	$rows=$formFunctions->fetch_swr($swr_id);
	$dist=$rows['b_dist'];
	
	$key_person=$rows['Key_person'];$unit_name=$rows['Name'];$street_name1=$rows['Street_name1'];$street_name2=$rows['Street_name2'];$vill=$rows['Vill'];$dist=$rows['Dist'];$block=$rows['block'];$pincode=$rows['Pincode'];$mobile_no=$rows['Mobile_no'];$landline_std=$rows['Landline_std'];$landline_no=$rows['Landline_no'];$owner_name=$rows['Name_of_owner'];
	$b_street_name1=$rows['b_street_name1'];$b_street_name2=$rows['b_street_name2'];$b_vill=$rows['b_vill'];$b_dist=$rows['b_dist'];$b_block=$rows['b_block'];$b_pincode=$rows['b_pincode'];$b_mobile_no=$rows['b_mobile_no'];$b_landline_std=$rows['b_landline_std'];$b_landline_no=$rows['b_landline_no'];$b_email=$rows['b_email'];

	$from= strtoupper($b_street_name1)." ,".strtoupper($b_street_name2)." ".strtoupper($b_vill);
	
}else{
	echo "<script>alert('Invalid page access !!!');</script>";
	die();
}
$get_file_name="";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Compliance Report</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Ease of doing business | Govt. of Assam</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<?php require '../../../user_area/includes/css.php';?>
	<style>
	hr.style1 {
		border-top: 3px double #8c8b8b;
	}
	</style>
</head>
<?php 
$printContents='

<style>
input, textarea { 
  text-transform: uppercase;
}
.header{
  width: 100%;
  height: 130px;
  font-weight: bold;
}
.main_body {
  height: 700px;
  width: 100%;
}
#form1 table {
  vertical-align: middle;
}
</style>
</head>
<body>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<p style="text-align:right">'.strtoupper($uain).'</p>
		<h3 class="text-center" style="text-align:center">COMPLIANCE REPORT OF FIRE SAFETY MEASURES SUGGESTIONS</h3>
		<hr class="style1">
		<p>To,<br/>
			&nbsp;The Director,<br/>&nbsp;Fire & Emergency Services, Assam.<br/><br/>
			Sir,<br/><br/>
			&nbsp;I/We, '.strtoupper($key_person).' on behalf of '.strtoupper($unit_name).' located at '.$from.' , Block/ward no. '.$b_block.' , District - '.$b_dist.' , do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;'.$letter_no.' dated &nbsp;'.$letter_date.' and Para wise compliance report is enclosed.<br/><br/>&nbsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/ building.
			</p>

			<br/>

			<p style="text-align:right">'.strtoupper($key_person).'<br/>Signature of the Applicant</p>
	</div>
</div></body></html>

';
$mypdf="ComplianceReport.pdf";
ob_end_clean();
include("../../../mpdf60/mpdf.php"); 
$mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
$mpdf->SetDisplayMode('fullpage');
$mpdf->list_indent_first_level = 0;
$mpdf->WriteHTML($printContents);         
$mpdf->Output($mypdf,'I');
$pcb->close();
?>