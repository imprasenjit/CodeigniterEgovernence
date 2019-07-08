<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form11 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form11 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form11 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form11 where user_id='$swr_id' and active='1'") or die($clm->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$clm->query("select * from clm_form11 where user_id=$swr_id and active='1'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];	
	}		
	$form_name=$formFunctions->get_formName('clm','11');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FORM-5</title>
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
if(!empty($results["uain"])){
        $printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
    }
    $printContents=$printContents.'
			<div style="text-align:center">
				'.$assamSarkarLogo.'<h4>Form- 5<br/>'.$form_name.'</h4>
			</div><br/>
             <table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
                <tr>
					<td>
						<table border="0" width="100%" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive">
							<tr>
								<td>To,</td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td>The Controller of Legal Metrology, Assam,<br/>R.K. Mission Road, Ulubari,<br/>Guwahati-781007
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">

				<tr>
                    <td width="50%"> 1. (a) Name of the owner of the Dispensing Units: </td>
                    <td width="50%">'.strtoupper($key_person).'</td>
                </tr>
                <tr>
					<td width="50%" valign="top">(b) Address of the owner of the Dispensing Units:</td>
					<td width="50%">
						<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
							<tr>
								<td width="50%">Street Name 1</td>
								<td width="50%">'.strtoupper($street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2</td>
								<td>'.strtoupper($street_name2).'</td>
							</tr>
							<tr>
								<td>Village/Town</td>
								<td>'.strtoupper($vill).'</td>
							</tr>
							<tr>
								<td>District</td>
								<td>'.strtoupper($dist).'</td>
							</tr>
							<tr>
								<td>Pincode</td>
								<td>'.strtoupper($pincode).'</td>
							</tr>
			
							<tr>
								<td>Mobile</td>
								<td>+91 - '.strtoupper($mobile_no).'</td>
							</tr>
						</table>
					</td>
				</tr>
                 <tr>
                    <td width="50%">2. (a) Name of the Firm:</td>
                    <td >'.strtoupper($unit_name).'</td>
                </tr>
				<tr>
					<td valign="top" width="50%">(b) Address of the Firm:</td>
					<td width="50%">
						<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
							<tr>
								<td width="50%">Street Name 1</td>
								<td width="50%">'.strtoupper($b_street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2</td>
								<td>'.strtoupper($b_street_name2).'</td>
							</tr>
							<tr>
								<td>Village/Town</td>
								<td>'.strtoupper($b_vill).'</td>
							</tr>
							<tr>
								<td>District</td>
								<td>'.strtoupper($b_dist).'</td>
							</tr>
							<tr>
								<td>Pincode</td>
								<td>'.strtoupper($b_pincode).'</td>
							</tr>
			
							<tr>
								<td>Mobile</td>
								<td>+91 - '.strtoupper($b_mobile_no).'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">3. Details of the New Dispensing Units:</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
							<thead>
							<tr>												
								<td width="25%">Sl No.</td>
								<td width="25%">Make</td>
								<td width="25%">Model No</td>
								<td width="25%">Sl. No. of D.U</td>
							</tr>
							</thead>';					
								$part1=$clm->query("SELECT * FROM clm_form11_t1 WHERE form_id='$form_id'");
								while($row_1=$part1->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_1["sl_no"]).'</td>
									<td>'.strtoupper($row_1["make"]).'</td>
									<td>'.strtoupper($row_1["model_no"]).'</td>
									<td>'.strtoupper($row_1["sl_f_du"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">4. Details of the Old Dispensing Units(in case of replacement):</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="100%" align="center" class="table table-bordered table-responsive text-center" style="margin:0px auto;border-collapse: collapse" border="1">			
							<thead>
							<tr>												
								<td width="25%">Sl No.</td>
								<td width="25%">Make</td>
								<td width="25%">Model No</td>
								<td width="25%">Sl. No. of D.U</td>
							</tr>
							</thead>';					
								$part2=$clm->query("SELECT * FROM clm_form11_t2 WHERE form_id='$form_id'");
								while($row_2=$part2->fetch_array()){
								$printContents=$printContents.'
								<tr>
									<td>'.strtoupper($row_2["sl_no"]).'</td>
									<td>'.strtoupper($row_2["make"]).'</td>
									<td>'.strtoupper($row_2["model_no"]).'</td>
									<td>'.strtoupper($row_2["sl_f_du"]).'</td>
								</tr>';
								}$printContents=$printContents.'
						</table>
					</td>
				</tr>
				<tr>
					<td> Place : '.strtoupper($dist).'<br/>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
					<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).'</td>
				</tr>
		</table>';

?>


