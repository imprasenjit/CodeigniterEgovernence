  <?php
if(!isset($get_file_name)){    
    ob_start();
	require_once "../../requires/login_session.php";
}
	$row1=$formFunctions->fetch_swr($swr_id);
  $key_person=$row1['Key_person']; $ownername=$row1['Name_of_owner'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
  $b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
   $from= strtoupper($street_name1)."  ".strtoupper($street_name2)."  ".strtoupper($vill);
$sql=$fire->query("select * from fire_form11 where user_id=$swr_id");
$rowkk=$sql->fetch_array();
	$printContents='
	<style>
	body{
		font-family:sans-serif;
		font-size:16px;
	}
	input,textarea {
	  text-transform: uppercase;
	}
	h4{
		text-align:center;
		text-decoration:underline;
	}
	table{border-collapse: collapse;}
	</style>
<table border="0" style="margin-left:auto;margin-right:auto;width:100%">
	<tr><td colspan="2" style="width:650px" align="center"><h4 align="center">FORM XI</h4></td></tr>
	<br/>
	<tr><td colspan="2" style="width:650px" align="center"><h4>FORM OF APPLICATION FOR COMPLIANCE REPORT OF FIRE SAFETY MEASURES SUGGESTIONS</h4></td>
	</tr>
	<br/><br/>
	<tr>
		<td>To,</td>
		<td align="right">UAIN :'.$rowkk['uain'].'</td>
	</tr>
	<tr>
		<td colspan="2" style="line-height: 180%;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Director,<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fire & Emergency Services,Assam<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Panbazar, Guwahati-1
		</td>
	</tr>
	<br/><br/>
	<tr>
		<td colspan="2">Sir,</td>	
	</tr>
	<br/><br/>
	<tr>
		<td colspan="2" style="width:650px"><p style="line-height: 180%;text-align:justify">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I/We, &nbsp;'.strtoupper($key_person).'&nbsp; on behalf of &nbsp;'.strtoupper($unit_name).'&nbsp;located at &nbsp;'.strtoupper($from).'&nbsp; holding &nbsp; 
'.strtoupper($rowkk['holding_no']).'&nbsp; block/ward no. &nbsp;'.strtoupper($block).'&nbsp; District &nbsp; 
'.strtoupper($dist).' do hereby inform you that Fire prevention &amp; Fire Safety Measures have been provided in the Building/ Premises as per recommendation by you vide your letter no. &nbsp;'.strtoupper($rowkk['letter_no']).'&nbsp;dated &nbsp;
'.strtoupper($rowkk['letter_date']).' and Para wise compliance report is enclosed.</p>
<br/>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requested kindly to take necessary action for grant of N.O.C. for the above premises/building.</p>
		</td>
	</tr>
<br/>
<br/>
<br/>
	<tr>
		<td width="60%" style="line-height:150%" align="left" valign="top"><u>Contact Details</u>
		<br/>
			1. Name in Full.:-&nbsp; '.strtoupper($key_person).'<br/>
			2. Telephone No.:-&nbsp; '.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'<br/>
			3. Mobile No.:-&nbsp; +91-'.strtoupper($mobile_no).'<br/>
		
		</td>

		<td width="350" valign="middle" align="center">
			'.strtoupper($key_person).'<br/>
			Signature of the Applicant
		</td>

	</tr>	
	<br/>
</table>';
 if(!isset($get_file_name))
{   
    $mypdf="fire-".".pdf";
    ob_end_clean();
    include('../../../mpdf60/mpdf.php'); 
    $mpdf=new mPDF('c','A4','','' , 15, 15, 16, 16, 9, 9); 
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;
    $mpdf->WriteHTML($printContents);         
    $mpdf->Output($mypdf,'I');

  $fire->close();
}  
?>
<!--

-->