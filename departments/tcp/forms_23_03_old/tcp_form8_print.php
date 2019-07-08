<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$tcp->query("select * from tcp_form8  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$tcp->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$tcp->query("select * from tcp_form8  where user_id='$swr_id' and uain='$uain'") or die("Error :".$tcp->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$tcp->query("select * from tcp_form8 where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$tcp->error);
}else{
	$q=$tcp->query("select * from tcp_form8 where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$tcp->error);
}
	$row1=$formFunctions->fetch_swr($swr_id);
    $email=$formFunctions->get_usermail($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];
	$b_street_name3=$row1['b_street_name3'];$b_street_name4=$row1['b_street_name4'];$b_vill2=$row1['b_vill2'];$b_dist2=$row1['b_dist2'];$b_block2=$row1['b_block2'];$b_pincode2=$row1['b_pincode2'];
	$from=$key_person."<br/>Address : ".$street_name1." ".$street_name2."<br/>Vill/Town : ".$vill.",".$dist."<br/>Pin Code : ".$pincode."<br/>Mobile Number : +91 ".$mobile_no;
	$unit_details=$unit_name."\n".$b_street_name1."  ".$b_street_name2."\nVill/Town : ".$b_vill." , ".$b_dist."\nPin Code : ".$b_pincode;
	
	$results=$q->fetch_assoc();
	
	if($q->num_rows>0){
		####### Part 1######
			$form_id=$results["form_id"];
			$supervision=$results["supervision"];$name=$results["name"];$edu_quali =$results["edu_quali"];$past_exp =$results["past_exp"];$father_name =$results["father_name"];$dob=$results["dob"];$owner_age=$results["owner_age"];$pan=$results["pan"];
			$file1=$results["file1"];
			if(!empty($results["authority_addres"])){
				$authority_addres=json_decode($results["authority_addres"]);
				$authority_addres_a=$authority_addres->a;$authority_addres_b=$authority_addres->b;
			}else{				
				$authority_addres_a="";$authority_addres_b="";
			}
			if(!empty($results["pre_add"])){
				$pre_add=json_decode($results["pre_add"]);
				$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;$pre_add_email=$pre_add->email;$pre_add_pan=$pre_add->pan;	
			}else{				
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";$pre_add_email="";$pre_add_pan="";
			}
			if(!empty($results["fees"])){
				$fees=json_decode($results["fees"]);
				$fees_n=$fees->n;$fees_r=$fees->r;
			}else{				
				$fees_n="";$fees_r="";
			}
			if(!isset($css)){
				$val1=$formFunctions->get_uploadFile($file1);
			}else{
				$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
			}
			if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
				$courier_details=json_decode($results["courier_details"]);
				$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
			}else{
				$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
			}
	}
	
	
	
		
	$form_name=$formFunctions->get_formName('tcp','8');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>Form</title>
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
  			'.$assamSarkarLogo.'<h4><br/><br/>'.$form_name.'</h4>
		</div><br/>
      <table width="100%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1">
		<tr>
			<td colspan="2">To <br/>'.strtoupper($authority_addres_a).'<br/>'.strtoupper($authority_addres_b).'<br/><br/>
			I hereby apply for enrolment of my name as competent Technical personnel to do the various works of schemes for Building Permitand supervision in the &nbsp;'.strtoupper($supervision).'<br/><br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I do hereby also declare that I shall follow and shall abide by all the Rules and Regulations now in force and that may be framed from time.</td>
		</tr>
		<tr>
				<td colspan="2">My personal bio-data are as follows-</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Name</td>
				<td width="50%">'.strtoupper($name).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Qualification:</td>
				<td width="50%">'.strtoupper($edu_quali).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Past experience :</td>
				<td width="50%">'.strtoupper($past_exp).'</td>
		</tr>
		<tr>
				<td valign="top" width="50%">Father&apos;s Name :</td>
				<td width="50%">'.strtoupper($father_name).'</td>
		</tr>
		<tr>
				<td valign="top">Present Address</td>
				<td>
					<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
					<tr>
						<td width="50%">Street Name 1</td>
						<td>'.strtoupper($pre_add_sn1).'</td>
					</tr>
					<tr>
						<td>Street Name 2</td>
						<td>'.strtoupper($pre_add_sn2).'</td>
					</tr>
					<tr>
						<td>Village/Town</td>
						<td>'.strtoupper($pre_add_v).'</td>
					</tr>
					<tr>
						<td>District</td>
						<td>'.strtoupper($pre_add_d).'</td>
					</tr>
					<tr>
						<td>Pincode</td>
						<td>'.strtoupper($pre_add_p).'</td>
					</tr>
					<tr>
						<td>Mobile</td>
						<td>+91 - '.strtoupper($pre_add_mno).'</td>
					</tr>
					<tr>
						<td>Email ID :</td>
						<td> '.$pre_add_email.'</td>
					</tr>
					<tr>
						<td>Pan No. :</td>
						<td>'.strtoupper($pre_add_pan).'</td>
					</tr>
					</table></td>
			</tr>
			<tr>
				<td valign="top">Premanent Address</td>
				<td>
				<table width="100%" border="1" class="table table-bordered table-responsive" style="border-collapse: collapse">
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
					<td>Mobile</td>
					<td>+91 - '.strtoupper($mobile_no).'</td>
				</tr>
				<tr>
					<td>Email ID :</td>
					<td> '.$email.'</td>
				</tr>
				<tr>
					<td>Pan No. :</td>
					<td>'.strtoupper($pan).'</td>
				</tr>
			</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I deposit herewith annual enrolment fees of Rs. &nbsp;'.strtoupper($fees_n).'&nbsp;(Rupees)&nbsp;'.strtoupper($fees_r).'&nbsp; only in cash as required.
			</td>
		</tr>
		<tr>
				<td colspan="2" valign="top" height="50px"><b>Checklist of the Documents</b></td>
		</tr>
		<tr>
			<td width="40%">1. Qualification certificate</td><td width="60%">'.$val1.'</td>
		</tr>
		 ';
		if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
			$printContents=$printContents.'
			<tr>		   
				<td colspan="2">
					<table border="0" width="100%">
						<tr><td height="45px" colspan="2">Courier Details.</td></tr>
						<tr><td width="40%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="40%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="40%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
			</tr>';
			}
		/*if($results["payment_mode"]!=NULL){ 
			if($results["payment_mode"]==0)  $payment_mode="Offline"; else  $payment_mode="Online";
			$offline_challan=$results["offline_challan"];
			$printContents=$printContents.'<tr>		    
			<td colspan="2">
				<table border="0" width="100%">
				<tr><td height="45px" colspan="2">Payment Details :</td></tr>
				<tr><td width="40%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
				if($results["payment_mode"]==0){
					$printContents=$printContents.'<tr><td width="40%">Application Fee Challan Reciept :</td>
					<td><a href="'.$upload.$offline_challan.'" target="_blank">View Challan</a></td>
					</tr>';
				}
				$printContents=$printContents.'</table>			
			</td>
		 </tr>';
		  }*/
	  $printContents=$printContents.'
	 
			<tr>
				<td> Date : '.date('d-m-Y',strtotime($results["sub_date"])).'</td>
				<td align="center">Signature : '.strtoupper($key_person).'</td>
			</tr>
	</table>';
?>