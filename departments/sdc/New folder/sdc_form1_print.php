<?php
if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
	echo "<script>
			alert('Invalid Page Access');
	</script>";	
	die();
}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
	$form_id=$_GET["ui"];
	$q=$sdc->query("select * from sdc_form1  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else if(isset($_GET["uain"])){
	$uain=$_GET["uain"];
	$q=$sdc->query("select * from sdc_form1  where user_id='$swr_id' and uain='$uain'") or die("Error :".$sdc->error);	
}else if(isset($form_id)){
	$form_id=$form_id;
	$q=$sdc->query("select * from sdc_form1  where user_id='$swr_id' and form_id='$form_id'") or die("Error :".$sdc->error);
}else{
	$q=$sdc->query("select * from sdc_form1  where user_id='$swr_id' and active='1' and form_id=form_id") or die("Error :".$sdc->error);
}
	
	$results=$q->fetch_array();
	if($q->num_rows > 0){
		$email=$formFunctions->get_usermail($swr_id);
	$row1=$row1=$formFunctions->fetch_swr($swr_id);
	
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;
	$Type_of_ownership=$row1['Type_of_ownership'];
	
	$Name_of_owner=$row1['Name_of_owner'];
	$owners=Array();
	$owners=explode(",",$Name_of_owner);					
		$form_id=$results["form_id"];$location=$results["location"];$category=$results["category"];$particulars=$results["particulars"];
			if(!empty($results["supervision"])){
				$supervision=json_decode($results["supervision"]);
				$supervision_n1=$supervision->n1;$supervision_n2=$supervision->n2;
				$supervision_q1=$supervision->q1;$supervision_q2=$supervision->q2;
			}else{				
				$supervision_n1="";$supervision_n2="";$supervision_q1="";$supervision_q2="";
			}
		
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($file1);
			$val2=$formFunctions->get_uploadFile($file2);
			$val3=$formFunctions->get_uploadFile($file3);
			$val4=$formFunctions->get_uploadFile($file4);
			$val5=$formFunctions->get_uploadFile($file5);
			$val6=$formFunctions->get_uploadFile($file6);
			$val7=$formFunctions->get_uploadFile($file7);
			$val8=$formFunctions->get_uploadFile($file8);
		}else{
			$val1=$formFunctions->get_useruploadFile($file1,$applicant_id);
			$val2=$formFunctions->get_useruploadFile($file2,$applicant_id);
			$val3=$formFunctions->get_useruploadFile($file3,$applicant_id);
			$val4=$formFunctions->get_useruploadFile($file4,$applicant_id);
			$val5=$formFunctions->get_useruploadFile($file5,$applicant_id);
			$val6=$formFunctions->get_useruploadFile($file6,$applicant_id);
			$val7=$formFunctions->get_useruploadFile($file7,$applicant_id);
			$val8=$formFunctions->get_useruploadFile($file8,$applicant_id);
		}
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
            $courier_details=json_decode($results["courier_details"]);
            $courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
        }else{
            $courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
        }
	}
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	$form_name=$formFunctions->get_formName('sdc','1');
		if(!isset($css)){
		$printContents='<!DOCTYPE html>
		<html lang="en">
		<head>
		<title>FORM-I</title>
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
				$printContents=$printContents.'<p style="text-align:right;padding:20px 20px 0 0;"> UAIN: '.strtoupper($results["uain"]).'</p>';
		}
		$printContents=$printContents.'
		<h4 align="center">'.$assamSarkarLogo.'<br/>FORM-I<br/>[RULE 59(2)]<br/>'.$form_name.'</h4>
		<br>
		<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
		<tbody>	
		<tr>
			<td colspan="2">1.I/We &nbsp;'.strtoupper($key_person).'&nbsp; hereby apply for licence to sell by wholesale/retail drugs specified in Schedules C and C(1) excluding those specified in Schedule X and/or drugs other than those specified in Schedules C. C(1) and X to the Drugs and Cosmetics Rules, 1945* and also to operate a pharmacy on the premises situated at&nbsp;'.strtoupper($location).'.</td>
		</tr>
		<tr>
			<td width="50%">2. The sale and  dispensing of drugs will be made under the personal supervision of the qualified persons namely :-</td>
			<td width="50%"><table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;">
			<tr>
				<td>Name : '.strtoupper($supervision_n1).'</td>
				<td>Qualification : '.strtoupper($supervision_q1).'</td>
			</tr>
			<tr>
				<td >Name : '.strtoupper($supervision_n2).'</td>
				<td>Qualification : '.strtoupper($supervision_q2).'</td>
			</tr>
			</table></td>
		</tr>			
		<tr>
			<td >3. Categories of drugs to be sold. :</td>
			<td >'.strtoupper($category).'</td>
		</tr>			
		<tr>
			<td >4. Particulars for special storage accomodation.:</td>
			<td >'.strtoupper($particulars).'</td>
		</tr>		
		<tr>
			<td colspan="2"><b>List of Document to be submitted :</b></td>
		</tr>		
		<tr>
			<td >1. Experience Certificate in Trade with 4 years and hold a degree of a recognized university with 1 year experience in dealing with drugs.:</td>
			<td >'.strtoupper($val1).'</td>
		</tr>		
		<tr>
			<td >2. Stockiest Certificate with valid GMP certificate.:</td>
			<td >'.strtoupper($val2).'</td>
		</tr>		
		<tr>
			<td >3. Education qualification certificate.:</td>
			<td >'.strtoupper($val3).'</td>
		</tr>		
		<tr>
			<td >4. Proof of availability of cold storage facility.:</td>
			<td >'.strtoupper($val4).'</td>
		</tr>		
		<tr>
			<td >5. Approved layout premises (10 sq.m -15 sq.m).:</td>
			<td >'.strtoupper($val5).'</td>
		</tr>		
		<tr>
			<td >6. Proof of ownership of the owner of the premises.:</td>
			<td >'.strtoupper($val6).'</td>
		</tr>		
		<tr>
			<td >7. Proof of constitution of the firm.:</td>
			<td >'.strtoupper($val7).'</td>
		</tr>		
		<tr>
			<td >8. Residence address of the appliances, etc.:</td>
			<td >'.strtoupper($val8).'</td>
		</tr>			
		';			
			if(!empty($results["courier_details"]) && $results["courier_details"] != 1){
				$printContents=$printContents.'
				<tr>		   
				<td colspan="2">
					<table border="1" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" width="100%">
						<tr><td height="45px" colspan="2"><b>Courier Details.</b></td></tr>
						<tr><td width="50%">Name of Courier Service </td><td>'.strtoupper($courier_details_cn).'</td></tr>
						<tr><td width="50%">Ref. No. / Consignment No. </td><td>'.strtoupper($courier_details_rn).'</td></tr>
						<tr><td width="50%">Dispatch Date </td><td>'.strtoupper($courier_details_dt).'</td></tr>
					</table>
				</td>
				</tr>
				';				
				}
				if($results["payment_mode"]!=NULL){ 
				$printContents=$printContents.'<tr>		    
				<td colspan="2">
					<table border="0" width="100%">
					<tr><td height="45px" colspan="2">Payment Details :</td></tr>
					<tr><td width="40%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
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
				<td>Date : <strong> '.date('d-m-Y',strtotime($results["sub_date"])).'</strong></td>						
				<td align="center"> Signature :&nbsp;<strong>'.strtoupper($key_person).'</strong><br/> </td>				
			</tr>						
		</table>';

?>

