<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$clm->query("select * from clm_form7 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$clm->query("select * from clm_form7 where uain='$uain' and user_id='$swr_id'") or die($clm->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$clm->query("select * from clm_form7 where user_id='$swr_id' and form_id='$form_id'") or die($clm->error);
	}else{
		$q=$clm->query("select * from clm_form7 where user_id='$swr_id' and active='1'") or die($clm->error);
	}
    $row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town :".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$q=$clm->query("select * from clm_form7 where user_id=$swr_id and active='1'") or die($clm->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0){
	$form_id=$results['form_id'];	
	$brnch_nm=$results["brnch_nm"];$commodities=$results["commodities"];$cst_no=$results["cst_no"];
		if(!empty($results["fac"])){
			$fac=json_decode($results["fac"]);
			$fac_name=$fac->name;$fac_strt_name1=$fac->strt_name1;$fac_strt_name2=$fac->strt_name2;$fac_vill=$fac->vill;$fac_dist=$fac->dist;$fac_pincode=$fac->pincode;
		}else{
			$fac_name="";$fac_strt_name1="";$fac_strt_name2="";$fac_vill="";$fac_dist="";$fac_pincode="";
		}
	}
	$form_name=$formFunctions->get_formName('clm','7');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form LD-II</title>
		<style type="test/css">
		table, thead, td {
			border: 1px solid #000;
			border-collapse: collapse;
		}
		</style>
		</head>
		<body>';		
		}else{
			$printContents='';
		}
		if(!empty($results["uain"])){
			$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;">UAIN : '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>Form LD-II<br/>SCHEDULE II B<br/>[See rule 11 (2)]<br/>'.$form_name.'</h4>
		</div><br/>
      <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
			<tr>
				<td colspan="2">To,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;The Controller of Legal Metrology, Assam,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;R.K. Mission Road, Ulubari,<br/>
				&nbsp;&nbsp;&nbsp;&nbsp;Guwahati-781007
				</td>
			</tr>
			<tr>
				<td width="50%" valign="top">1. Name of the Applicant/Firm :</td>
				<td>
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
						<tr>
							<td width="50%">(a) Name of the Firm</td>
							<td>'.strtoupper($unit_name).'</td>
						</tr>
						<tr>
							<td>(b) Name of the Applicant</td>
							<td>'.strtoupper($key_person).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">2. Complete address of the Applicannt/Firm :</td>
				<td>
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
						<tr>
							<td width="50%">Street Name 1</td>
							<td>'.strtoupper($street_name1).'</td>
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
							<td>Mobile No.</td>
							<td>'.strtoupper($mobile_no).'</td>
						</tr>
						<tr>
							<td>Phone No.</td>
							<td>'.strtoupper($landline_std).'-'.strtoupper($landline_no).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">3. Registered office address :</td>
				<td>
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
						<tr>
							<td  width="50%">Street Name 1</td>
							<td>'.strtoupper($b_street_name3).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($b_street_name4).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($b_vill2).'</td>
						</tr>
						<tr>
							<td>Block</td>
							<td>'.strtoupper($b_block2).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($b_dist2).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.strtoupper($b_pincode2).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td valign="top">4. Location of the factory :</td>
				<td>
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
						<tr>
							<td width="50%">Factory Name</td>
							<td>'.strtoupper($fac_name).'</td>
						</tr>
						<tr>
							<td>Street Name 1</td>
							<td>'.strtoupper($fac_strt_name1).'</td>
						</tr>
						<tr>
							<td>Street Name 2</td>
							<td>'.strtoupper($fac_strt_name2).'</td>
						</tr>
						<tr>
							<td>Village/Town</td>
							<td>'.strtoupper($fac_vill).'</td>
						</tr>
						<tr>
							<td>District</td>
							<td>'.strtoupper($fac_dist).'</td>
						</tr>
						<tr>
							<td>Pincode</td>
							<td>'.strtoupper($fac_pincode).'</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>5. Branches, if any :</td>
				<td>'.strtoupper($brnch_nm).'</td>
			</tr>
			<tr>
				<td colspan="2">6. Name(s) of the Proprietor/Partners/Occupier :</td>
			</tr>
			<tr>
				<td colspan="2">
					<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="0">
						<thead>
							<tr>
								<th>Sl. No.</th>
								<th>Name</th>
								<th>Father&apos;s/Spouse&apos;s Name</th>
								<th>Address</th>
								<th>Pincode</th>
								<th>Contact No</th>
							</tr>
						</thead>
						<tbody>';
						$results1=$clm->query("select * from clm_form7_members where form_id='$form_id'") or die("Error : ".$clm->error);
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
						</tbody>
					</table>
				</td>
			</tr>
			<tr>
				<td>7. Commodity(ies) intended to Pre-pack :</td>
				<td>'.strtoupper($commodities).'</td>
			</tr>
			<tr>
				<td>8. CST no./AGST no/MLT no.</td>
				<td>'.strtoupper($cst_no).'</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><b><u>DECLARATION</u></b></td>
			</tr>
			<tr>
				<td colspan="2">  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;I/we hereby declare that the packages manufactured/packed will comply the various provisions of the Legal Metrology (Packaged Commodities) Rule, 2011.</td>
			</tr>
	';
            $printContents=$printContents.'     
        <tr>
			<td>Date : '.date('d-m-Y',strtotime($results["sub_date"])).'<br/>Place : '.strtoupper($dist).'</td>
			<td  align="right">Designation : '.strtoupper($status_applicant).'<br/>Signature : '.strtoupper($key_person).'</td>
        </tr>
</table>';

?>