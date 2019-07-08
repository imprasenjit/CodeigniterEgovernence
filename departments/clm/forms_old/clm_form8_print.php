<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form8 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form8 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form8 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form8 where user_id='$swr_id' and active='1'") or die($clm->error);
	}
	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>E-mail ID : ".$email;
	
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	
	$q=$clm->query("select * from clm_form8 where user_id=$swr_id") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
		$form_id=$results["form_id"];$com_details=$results["com_details"];$c_name=$results["c_name"];
	
		if(!empty($results["ware"])){
			$ware=json_decode($results["ware"]);
			$ware_street_name1=$ware->street_name1;$ware_street_name2=$ware->street_name2;$ware_vill=$ware->vill;$ware_dist=$ware->dist;$ware_pincode=$ware->pincode;$ware_mobile_no=$ware->mobile_no;
		}else{
			$ware_street_name1="";$ware_street_name2="";$ware_vill="";$ware_dist="";$ware_pincode="";$ware_mobile_no="";
		}
	}
	$com_details = wordwrap($com_details, 40, "<br/>", true);	
	$form_name=$cms->query("select form_name from clm_form_names where form_no='8'")->fetch_object()->form_name;
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	 
 if(!isset($css)){
$printContents='
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FORM-2</title>
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
			'.$assamSarkarLogo.'<h4 >FORM-2</h4>
			<p  style="text-align:center">(See Rule 2-A)</p>
			<h4>'.$form_name.'</h4>
			<p  style="text-align:center">[Under Rule 27 of the Legal Metrology(Packaged Commodities) Rules,2011]</p>
			<p  style="text-align:center">Importer is an Individual, Company or Firm whose name figures in the bill of Lading/Importer documents as Importer.</p>
		</div>
		<br>
            <table border="1" width="99%" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive">
			<tr>
				<td>
					<table border="0" width="100%" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive">
						<tr>
							<td>To,</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td>The Controller of Legal Metrology, Assam,<br/>
								R.K. Mission Road, Ulubari,<br/>
								Guwahati-781007</td>
						</tr>
					</table>
				</td>
			</tr>
			</table>
			<table border="1" width="99%" style="margin:0px auto;border-collapse: collapse"  class="table table-bordered table-responsive">
                <tr>
					<td width="50%" valign="top">1. Name and address of the Importer:</td>
					<td>
						<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
							<tr>
								<td width="50%">Full Name </td>
								<td>'.strtoupper($key_person).'</td>
							</tr>
							<tr>
								<td>Street Name 1 </td>
								<td>'.strtoupper($street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2 </td>
								<td>'.strtoupper($street_name2).'</td>
							</tr>
							<tr>
								<td>Vilage/Town </td>
								<td>'.strtoupper($vill).'</td>
							</tr>
							<tr>
								<td>District </td>
								<td>'.strtoupper($dist).'</td>
							</tr>
							<tr>
								<td>Pincode </td>
								<td>'.strtoupper($pincode).'</td>
							</tr>
							<tr>
								<td>Mobile No. </td>
								<td>'.strtoupper($mobile_no).'</td>
							</tr>
							<tr>
								<td>E-Mail ID </td>
								<td>'.$email.'</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="50%" valign="top">(a)Registered office Address: </td>
					<td>
						<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
							<tr>
								<td width="50%">Office Name </td>
								<td>'.strtoupper($unit_name).'</td>
							</tr>
							<tr>
								<td>Street Name 1 </td>
								<td>'.strtoupper($b_street_name1).'</td>
							</tr>
							<tr>
								<td>Street Name 2 </td>
								<td>'.strtoupper($b_street_name2).'</td>
							</tr>
							<tr>
								<td>Vilage/Town </td>
								<td>'.strtoupper($b_vill).'</td>
							</tr>
							<tr>
								<td>District </td>
								<td>'.strtoupper($b_dist).'</td>
							</tr>
							<tr>
								<td>Pincode </td>
								<td>'.strtoupper($b_pincode).'</td>
							</tr>
							<tr>
								<td>Mobile No. </td>
								<td>'.strtoupper($b_mobile_no).'</td>
							</tr>
							<tr>
								<td>E-Mail ID </td>
								<td>'.$b_email.'</td>
							</tr>
						</table>
					</td>
				</tr>
			<tr>
			<tr>
				<td width="50%" valign="top">(b) Address of Warehouse where the goods are imported and kept:</td>
				<td>
					<table width="100%" border="1" class="table table-bordered table-resposive" style="border-collapse: collapse">
						<tr>
							<td width="50%">Street Name 1 </td>
							<td>'.strtoupper($ware_street_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2 </td>
							<td>'.strtoupper($ware_street_name2).'</td>
						</tr>
						<tr>
							<td>Vilage/Town </td>
							<td>'.strtoupper($ware_vill).'</td>
						</tr>
						<tr>
							<td>District </td>
							<td>'.strtoupper($ware_dist).'</td>
						</tr>
						<tr>
							<td>Pincode </td>
							<td>'.strtoupper($ware_pincode).'</td>
						</tr>
						<tr>
							<td>Mobile No. </td>
							<td>'.strtoupper($ware_mobile_no).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td colspan="2">2. Name and address of the Director of the firm etc.:</td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
							<tr>
								<td width="10%">Sl No.</td>
								<td width="20%">Name</td>
								<td width="20%">Family Name</td>
								<td width="20%">Address</td>
								<td width="10%">Pincode</td>
								<td width="20%">Contact No</td>
							</tr>';
							$results1=$clm->query("select * from clm_form8_members where form_id='$form_id'") or die("Error : ".$clm->error);
							$sl=1;
							while($rows=$results1->fetch_object()){
								$printContents=$printContents.'
								<tr>
									<td>'.$sl.'</td>
									<td>'.strtoupper($rows->name).'</td>
									<td>'.strtoupper($rows->family_name).'</td>
									<td>'.strtoupper($rows->address).'</td>
									<td>'.strtoupper($rows->pincode).'</td>
									<td>'.strtoupper($rows->contact).'</td>
								</tr>';
								$sl++;
							}
							$printContents=$printContents.'
					</table>
				</td>
			</tr>
			<tr>
				<td>3.i) Details of Packaged Commodities being/to be imported: </td>
				<td>'.$com_details.'</td>
			</tr>
			<tr>
				<td>ii) Name of the Country from where import is made:</td>
				<td>'.$c_name.'</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b><u>DECLARATION</u></b></td>
			</tr>
			<tr>
				<td colspan="2">&nbsp;&nbsp;&nbsp;&nbspI/WE hereby declare that the package manufactured/packed will comply the various
				provision of the legal metrology(Packaged Commodities) Rule, 2011.</td>
			</tr>
        </table>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tbody>
			<tr>
				<td width="50%">Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>
				Place : '.strtoupper($dist).'</td>
				<td align="right">Signature : '.strtoupper($key_person).'<br/>Designation : '.strtoupper($status_applicant).' </td>
			</tr> 
		</tbody>
	</table>';
?>


