<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fcs->query("select * from fcs_form1 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fcs->query("select * from fcs_form1 where uain='$uain' and user_id='$swr_id'") or die($fcs->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fcs->query("select * from fcs_form1 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else{
		$q=$fcs->query("select * from fcs_form1 where user_id='$swr_id' and active='1'") or die($fcs->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);

	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];

	$from=$key_person."<br/>Designation : ".$status_applicant."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no."<br/>Phone Number : ".$landline_std."-".$landline_no."<br/>E-mail ID : ".$email;

	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	$results=$q->fetch_assoc();
	if($q->num_rows>0)
	{				
		$form_id=$results["form_id"];$father_name=$results["father_name"];$age=$results["age"];$caste=$results["caste"];$name_lic=$results["name_lic"];$is_lic_prev=$results["is_lic_prev"];$trading=$results["trading"];$stocks=$results["stocks"];$is_convicted=$results["is_convicted"];$particulars=$results["particulars"];$is_declared=$results["is_declared"];
		
			if(!empty($results["business"])){
				$business=json_decode($results["business"]);
				$business_place1=$business->place1;$business_place2=$business->place2;$business_place3=$business->place3;
			}else{				
				$business_place1="";$business_place2="";$business_place3="";
			}				
			if(!empty($results["licence"])){
				$licence=json_decode($results["licence"]);
				$licence_name=$licence->name;$licence_number=$licence->number;
			}else{				
				$licence_name="";$licence_number="";
			}				
			if(!empty($results["address"])){
				$address=json_decode($results["address"]);
				$address_s1=$address->s1;$address_s2=$address->s2;$address_d=$address->d;$address_p=$address->p;
			}else{				
				$address_s1="";$address_s2="";$address_d="";$address_p="";
			}	
		if($results["is_lic_prev"]=="Y"){
			$is_lic_prev="YES";
		}else{
			$is_lic_prev="NO";
		}
		if($results["is_declared"]=="Y"){
			$is_declared="YES";
		}else{
			$is_declared="NO";
		}
		if($results["is_convicted"]=="Y"){
			$is_convicted="YES";
		}else{
			$is_convicted="NO";
		}
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		$form_name=$formFunctions->get_formName('fcs','1');
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
}
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form I</title>
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
	if(!empty($results["uain"])){
		$printContents=$printContents.'<p style="text-align:right">UAIN : '.strtoupper($results["uain"]).'</p>';
	}
  	$printContents=$printContents.'
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>FORM - A</h4>
  			<h4>(See Clause 4 (1))<br/>'.$form_name.'</h4>
	</div><br/> 
  	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
  	   
  	    <tr>
            <td colspan="2">
                <p>To</p>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Licensing Authority<br/><br/></p>
			</td>
		</tr>
  	    <tr>
            <td colspan="2">
                <p>Sir,</p>
				<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I hereby apply the grant of a licence under the Assam Trade Articles (L&C) order, 1982.The required particulars are given here under : <br/><br/></p>
			</td>
		</tr>
  	    <tr>
            <td colspan="2">
                
			</td>
		</tr>
		<tr>
			<td valign="top" width="50%">1. Applicants particulars :</td>
			<td><table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Name : </td>
						<td >'.strtoupper($key_person).'</td>
					</tr>
					<tr>
						<td width="50%">S/O :</td>
						<td>'.strtoupper($father_name).'</td>
					</tr>
					<tr>
						<td width="50%">Age : </td>
						<td>'.strtoupper($age).'</td>
					</tr>
					<tr>
						<td width="50%">Caste : </td>
						<td>'.strtoupper($caste).'</td>
					</tr>
				</table></td>
		</tr>
		<tr>
			<td valign="top"> 2. Residential address of the applicant  :</td>
			<td>
				<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Street name 1 </td>
						<td >'.strtoupper($street_name1).'</td>
					</tr>
					<tr>
						<td width="50%">Street name 2 </td>
						<td>'.strtoupper($street_name2).'</td>
					</tr>
					<tr>
						<td width="50%">Village/Town </td>
						<td>'.strtoupper($vill).'</td>
					</tr>
					<tr>
						<td width="50%">District </td>
						<td>'.strtoupper($dist).'</td>
					</tr>
					<tr>
						<td width="50%">Pin Code </td>
						<td>'.strtoupper($pincode).'</td>
					</tr>
					<tr>
						<td width="50%">Mobile No. </td>
						<td>+91&nbsp;'.strtoupper($mobile_no).'</td>
					</tr>
					<tr>
						<td width="50%">E-Mail ID </td>
						<td>'.$email.'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td>3. Name/Style which licence is required </td>		
				<td >'.strtoupper($name_lic).'</td>	
		</tr>   
		<tr>
			<td >4. Situation of applications place of business  :</td>
			<td>
				<table>
					<tr>
						<td width="50%">a) House/ Shop No :</td>
						<td >'.strtoupper($b_street_name1).'</td>
					</tr>
					<tr>
						<td width="50%">b) Market :</td>
						<td>'.strtoupper($b_street_name2).'</td>
					</tr>
					<tr>
						<td width="50%">c) Village/ Town :</td>
						<td>'.strtoupper($b_vill).'</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
				<td colspan="2">5. Name of partners, if any of the firm:
				<table width="100%" align="center" class="table table-bordered table-responsive" style="border-collapse: collapse" border="1">
						<tr>
							<th width="10%">Sl No.</th>
							<th width="20%">Name</th>
							<th width="20%">Fathers Name</th>
							<th width="10%">Age</th>
							<th width="10%">Address</th>
							<th width="20%">Contact No</th>
						</tr>';
						$results1=$fcs->query("select * from fcs_form1_members where form_id='$form_id'") or die("Error : ".$fcs->error);
						$sl=1;
						while($rows=$results1->fetch_object()){
							$printContents=$printContents.'
							<tr>
								<td>'.$sl.'</td>
								<td>'.strtoupper($rows->name).'</td>
								<td>'.strtoupper($rows->fat_name).'</td>
								<td>'.strtoupper($rows->age).'</td>
								<td>'.strtoupper($rows->address).'</td>
								<td>'.strtoupper($rows->contact).'</td>
							</tr>';
							$sl++;
						}
						$printContents=$printContents.'
				</table></td>
		</tr> 
		<tr>
				<td colspan="2">6. Particulars of trade articles in which the applicant wants to carry on business as a :
				<table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
			<tr align="center" >
				<th width="5%" align="center">Slno</th>
				<th width="25%" align="center">As a wholesaler</th>
				<th width="20%" align="center">As a Importer</th>
				<th width="25%" align="center"> As a Retailer</th>
			</tr>';
			
			$part1=$fcs->query("SELECT * FROM fcs_form1_t1 WHERE form_id='$form_id'");
				while($row_1=$part1->fetch_array()){
				$printContents=$printContents.'
				<tr align="center">
						<td>'.strtoupper($row_1["slno"]).'</td>
						<td>'.strtoupper($row_1["wholesaler"]).'</td>
						<td>'.strtoupper($row_1["impoter"]).'</td>
						<td>'.strtoupper($row_1["retailer"]).'</td>
				</tr>';
				}$printContents=$printContents.'
			</table> </td>
		</tr>
		<tr>
				<td>7. Did the applicant previously hold a licence of the trade articles for which licence has now been applied for if so, give details :</td>
				<td>'.strtoupper($is_lic_prev).' <br/>
				i) Name of trade articles (s) :'.strtoupper($licence_name).'<br/>
				ii)  Licence no : '.strtoupper($licence_name).'
				</td>
		</tr>
		<tr>
				<td>8. How long has the application been trading in the trade article for which the license has been applied for? :</td>
				<td>'.strtoupper($trading).' </td>
		</tr>
		<tr>
				<td>9. Particular regarding stocks of trade article in possession on the date of application :</td>
				<td>'.strtoupper($stocks).'</td>
		</tr>
		<tr>
				<td>10. Complete address (with House no. market etc.) of godowns or place where trade articles for which licence has been applied will be stored :</td>
				<td>a) Village/ Town :'.strtoupper($address_s1).'<br/>
				b) P.S : '.strtoupper($address_s2).'<br/>
				c) District : '.strtoupper($address_d).'<br/>
				d) Pincode : '.strtoupper($address_p).'<br/>
				</td>
		</tr>
		<tr>
				<td>11. Has the applicant ever been convicted by a court of law for contravention of any order issued under Essential Commodities Act, 1955 during last 3 years? :</td>
				<td>'.strtoupper($is_convicted).'</td>
		</tr>
		<tr>
				<td>12. Particulars of suspension or cancellation of the licence held the applicant during last 3 years :</td>
				<td>'.strtoupper($particulars).'</td>
		</tr>
		<tr>
				<td>13. Weather the applicant was declared or adjudged as an insolvent by a court ? :</td>
				<td>'.strtoupper($is_declared).'</td>
		</tr>
		<tr>
				<td colspan="2">I Sri '.strtoupper($key_person).' declare that the particulars mentioned at item no. 1 to 13 above are true to the best of my knowledge and belief and nothing has been concealed therein. I have carefully read the provision of the Assam Trade Articles (Licensing and Control) order, 1982 and I Agree to abide by them.</td>
		</tr>
		';
		if($results["payment_mode"]!=NULL){ 
			$printContents=$printContents.'<tr>		    
			<td colspan="2">
				<table border="1" align="center" style="margin:0px auto;border-collapse: collapse" class="table table-bordered table-responsive" width="100%">
				<tr><td height="45px" colspan="2">Payment Details :</td></tr>
				<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
				if($results["payment_mode"]==0)
				{
					$printContents=$printContents.'<tr><td width="50%">Application Fee Challan Reciept :</td>
					<td>'.$offline_challan.'</td></tr>';
				}
				$printContents=$printContents.'</table>			
			</td>
		  </tr>';
		  }	
			$printContents=$printContents.' 
		
		
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	
		';
?>