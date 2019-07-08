<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fire->query("select * from fire_form11 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fire->query("select * from fire_form11 where uain='$uain' and user_id='$swr_id'") or die($fire->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fire->query("select * from fire_form11 where user_id='$swr_id' and form_id='$form_id'") or die($fire->error);		
	}else{
		$q=$fire->query("select * from fire_form11 where user_id='$swr_id' and active='1'") or die($fire->error);
	}
$row1=$formFunctions->fetch_swr($swr_id);
$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];$owner_name=$row1['Name_of_owner'];
		$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
		$from= strtoupper($b_street_name1)."&nbsp; ,".strtoupper($b_street_name2)."&nbsp; ,".strtoupper($b_vill);
		//$result=$fire->query("select * from fire_form11 where user_id='$swr_id'");
        $rowkk=$q->fetch_array();
		$lic=$rowkk["file1"];
   
   if(!isset($css)){
     $val1=$formFunctions->get_uploadFile($rowkk["file1"]);
	 $val2=$formFunctions->get_uploadFile($rowkk["file2"]);
	
    }else{
      $val1=$formFunctions->get_useruploadFile($rowkk["file1"],$applicant_id);
	  $val2=$formFunctions->get_useruploadFile($rowkk["file2"],$applicant_id);
     
     
      
    }
   if(!empty($rowkk["courier_details"]) && $rowkk['courier_details']!=1){
        $courier_details=json_decode($rowkk["courier_details"]);
        $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
      }else{
        $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
      }

$form_name=$formFunctions->get_formName('fire','11');
 $assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Form- XII</title>
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
<body>';    
}else{
      $printContents='';
}
if(!empty($rowkk["uain"])){
      $printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($rowkk["uain"]).'</p>';
    }
    $printContents=$printContents.'<div style="text-align:center">
        '.$assamSarkarLogo.'
        <h4>FORM - XII</h4>
        <h4> <u>FORM OF '.$form_name.'</u> </h4>
        </div><br/>
  <table width="99%" align="center" border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse"  >  
      <tr><td width="100%">
        <table width="100%" border="0" class="table table-bordered table-responsive" cellpadding="10" style="text-align:top;border-collapse:collapse;">
          <tr>
            <td width="5%" valign="top">To,</td>
      <td width="95%">
             <br/> The Director,<br>Fire & Emergency Services, Assam.<br>Panbazar, Guwahati-1.<br/>
            </td>
          </tr>


<tr>
            <td width="5%" valign="top">Sir,</td><td width="95%">
		 <br/>	<p>I/We, &nbsp;'.strtoupper($owner_name).'&nbsp; on behalf of &nbsp;'.strtoupper($unit_name).'&nbsp;located at &nbsp;'.strtoupper($from).' &nbsp; holding No.&nbsp; 
'.strtoupper($rowkk['holding_no']).'&nbsp; District '.strtoupper($b_dist).' ,&nbsp; State &nbsp;Assam do hereby inform you that No Objection Certificate (N.O.C.) issued vide your Letter No./ UAIN '.strtoupper($rowkk['letter_no']).'&nbsp;Dated &nbsp;'.strtoupper($rowkk['letter_date']).'&nbsp; valid up to &nbsp; '.strtoupper($rowkk['letter_valid_date']).'&nbsp;<strong>(Copy of N.O.C. is enclosed)</strong> and is due for renewal for a period of another 1(One) Year with effect from 1<sup>st</sup> of April '.strtoupper($rowkk['renewal_year1']).'&nbsp; to 31<sup>st</sup> of March '.strtoupper($rowkk['renewal_year2']).'.</p>
</td>
	</tr>
	</table>
	</td>
</tr>
</table>
	<br/>
		
 <table  border="1"class="table table-bordered table-responsive">
 <tr><td>In this connection it is submitted that -</td></tr>
<tr><td>i. There is no change in trade for which license has been issued.</td></tr>
<tr><td>ii. There is no any structural change of the Building either horizontally or vertically affecting means of escapes/ Exits.</td></tr>
<tr><td>iii. There is no any change in existing Fire Fighting arrangement.</td></tr>
<tr><td>iv. Fire prevention & Fire Safety Measures/ Arrangements have been tested and are in Good Working condition.</td></tr>
<tr><td>You are requested kindly to take necessary action for grant of Renewal of N.O.C. for the above premises/ building.</td></tr>
</table>
<table width="100%" class="table table-bordered table-responsive">
<tr>
	<td width="50%" style="line-height:150%" align="left" valign="top"><u>Contact Details</u><br/>
	1. Name in Full.:-&nbsp;<b> '.strtoupper($key_person).'</b><br/>
	2. Telephone No.:-&nbsp;<b> '.strtoupper($landline_std).'&nbsp;'.strtoupper($landline_no).'</b><br/>
	3. Mobile No.:-&nbsp;<b> +91 &nbsp;'.strtoupper($mobile_no).'</b><br/>	
</td>
</tr>
<tr>
<td align="right">
			'.strtoupper($key_person).'<br/>
			Signature of the Applicant</td>

	</tr>
	</table>
	<table class="table table-bordered table-responsive">
	<tr>
		<td><b>Documentary/Evidential proof of Property gutted/involved in Fire:</b></td>
	</tr>

		 <tr>
          <td width="50%">Copy of N.O.C.*</td>';
        if(!empty($previous_noc)){ 
	   $printContents=$printContents.'
         <td><a href="'.$adminupload.$previous_noc.'" target="_blank">previous_noc</a></td>';
	      } else {
	    $printContents=$printContents.'
       <td>'.$val2.'</td>';
		  }
	    $printContents=$printContents.'
         </tr>
           </table>';
if(!empty($rowkk["courier_details"]) && $rowkk['courier_details']!=1){
      $printContents=$printContents.'
  <table border="0" style="margin-left:auto;margin-right:auto;border-collapse: collapse;" width="100%">	
    <tr><td colspan="2">Courier Details.</td></tr>
          <tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
          <tr><td>Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
          <tr><td>Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr></table>';
   }
  $printContents=$printContents.'';
?>