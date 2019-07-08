<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$fcs->query("select * from fcs_form2 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$fcs->query("select * from fcs_form2 where uain='$uain' and user_id='$swr_id'") or die($fcs->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$fcs->query("select * from fcs_form2 where user_id='$swr_id' and form_id='$form_id'") or die($fcs->error);
	}else{
		$q=$fcs->query("select * from fcs_form2 where user_id='$swr_id' and active='1'") or die($fcs->error);
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
		$form_id=$results["form_id"];$stock_point=$results['stock_point'];$lice_type=$results['lice_type'];
	if(!empty($results["supplier"])){
		$supplier=json_decode($results["supplier"]);
		$supplier_n=$supplier->n;$supplier_s1=$supplier->s1;$supplier_s2=$supplier->s2;$supplier_d=$supplier->d;$supplier_v=$supplier->v;$supplier_p=$supplier->p;$supplier_mno=$supplier->mno;
	}else{
		$supplier_n="";$supplier_s1="";$supplier_s2="";$supplier_d="";$supplier_v="";$supplier_p="";$supplier_mno="";$supplier_s1="";
	}
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		if($lice_type=='NL'){
			$lice_type='NEW LICENCE';
		}else if($lice_type=='R'){
			$lice_type='RENEWAL';
		}else{
			$lice_type=$lice_type;
		}
		
		$form_name=$formFunctions->get_formName('fcs','2');
		$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
}
$printContents='
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Form II</title>
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
  			'.$assamSarkarLogo.'
  			<h4>(See Clause 5.1 of Lub oil/ Greased processing supply & Distribution Registration Order, 1987)<br/><br/>'.$form_name.'</h4>
	</div><br/> 
  	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
  	    
		<tr>
			<td width="50%">1. FULL NAME OF THE APPLICANT :</td>
			<td>'.strtoupper($key_person).'</td>
		</tr>
		<tr>
			<td valign="top"> 2. ADDRESS IN FULL   :</td>
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
						<td width="50%">PIN Code </td>
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
				<td>3. LOCATION OF THE PLACE (S) OF  BUSINESS/ADDRESS : </td>	
				<td width="50%">'.strtoupper($unit_name).'</td>				
		</tr>   
		<tr>
				<td valign="top">5. NAME OF SUPPLIER AND ADDRESS IN FULL :</td>
				<td  width="50%">
			<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
				<tr>
						<td width="50%">Name</td>
						<td width="50%">'.strtoupper($supplier_n).'</td>
				</tr>
				<tr>
						<td width="50%">Street Name 1</td>
						<td width="50%">'.strtoupper($supplier_s1).'</td>
				</tr>
				<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($supplier_s2).'</td>
				</tr>
				<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($supplier_v).'</td>
				</tr>
				<tr>
						<td>District</td>
						<td>'.strtoupper($supplier_d).'</td>
				</tr>
				<tr>
						<td>Pincode</td>
						<td>'.strtoupper($supplier_p).'</td>
				</tr>				
				<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($supplier_mno).'</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
				<td>MENTION HERE THE NAME OF THE STOCK POINT :</td>
				<td>'.strtoupper($stock_point).'</td>
		</tr>
		<tr>
				<td>6. LICENCE TYPE :</td>
				<td>'.strtoupper($lice_type).' </td>
		</tr>
		<tr>
				<td colspan="2"> I SOLEMNLY DECLARE THAT THE INFORMATION GIVEN ABOVE IS TRUE TO THE BEST OF MY KNOWLEDGE AND BELIEF.</td>
		</tr>
		<tr>
			<td>Place<strong> :</strong> '.strtoupper($dist).' <br/>Date<strong> :</strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
			<td>Signature of Proprietor/Partner <strong> :</strong>&nbsp;'.strtoupper($key_person).'</td>
		</tr>
			
	</table>
	';
?>