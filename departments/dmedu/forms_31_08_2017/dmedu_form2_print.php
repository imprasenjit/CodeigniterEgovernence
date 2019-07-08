<?php
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$dmedu->query("select * from dmedu_form2 where user_id='$swr_id' and form_id='$form_id'") or die($dmedu->error);
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$dmedu->query("select * from dmedu_form2 where uain='$uain' and user_id='$swr_id'") or die($dmedu->error);
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$dmedu->query("select * from dmedu_form2 where user_id='$swr_id' and form_id='$form_id'") or die($dmedu->error);
	}else{
		$q=$dmedu->query("select * from dmedu_form2 where user_id='$swr_id' and active='1'") or die($dmedu->error);
	}

	$email=$formFunctions->get_usermail($swr_id);
	$row1=$formFunctions->fetch_swr($swr_id);
	$key_person=$row1['Key_person'];$unit_name=$row1['Name'];$status_applicant=$row1['status_applicant'];$street_name1=$row1['Street_name1'];$street_name2=$row1['Street_name2'];$vill=$row1['Vill'];$dist=$row1['Dist'];$block=$row1['block'];$pincode=$row1['Pincode'];$mobile_no=$row1['Mobile_no'];$landline_std=$row1['Landline_std'];$landline_no=$row1['Landline_no'];
	$b_street_name1=$row1['b_street_name1'];$b_street_name2=$row1['b_street_name2'];$b_vill=$row1['b_vill'];$b_dist=$row1['b_dist'];$b_block=$row1['b_block'];$b_pincode=$row1['b_pincode'];$b_mobile_no=$row1['b_mobile_no'];$b_landline_std=$row1['b_landline_std'];$b_landline_no=$row1['b_landline_no'];$b_email=$row1['b_email'];$date_of_commencement=$row1['date_of_commencement'];
	
	$from=strtoupper($street_name1)." \n".strtoupper($street_name2)."\nVill/Town : ".strtoupper($vill).",\nDistrict : ".strtoupper($dist)."\nPin Code : ".$pincode."\nMobile Number : +91 ".$mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no."\nE-mail ID : ".$email;
	
	$unit_details="Street Name : ".strtoupper($b_street_name1)."  ".strtoupper($b_street_name2)."\nVill/Town : ".strtoupper($b_vill)." , ".strtoupper($b_dist)."\nPin Code : ".$b_pincode."\nMobile Number : +91 ".$b_mobile_no."\nPhone Number : ".$b_landline_std."-".$b_landline_no;

	
	$q=$dmedu->query("select * from dmedu_form2 where user_id='$swr_id' and active='1'") or die("Error :".$dmedu->error);
	$results=$q->fetch_assoc();
	if($q->num_rows>0)
	{					
		$form_id=$results['form_id'];
		$form_id=$results["form_id"];$constitution=$results["constitution"];$objectives=$results["objectives"];
		if(!empty($results["reg"])){
				$reg=json_decode($results["reg"]);
				$reg_number=$reg->number;$reg_dt=$reg->dt;
			}else{				
				$reg_number="";$reg_dt="";
			}			
			if(!empty($results["permission"])){
				$permission=json_decode($results["permission"]);
				$permission_number=$permission->number;$permission_issue=$permission->issue;$permission_dt=$permission->dt;
			}else{				
				$permission_number="";$permission_issue="";$permission_dt="";
			}
			if(!empty($results["affliation"])){
				$affliation=json_decode($results["affliation"]);
				$affliation_name=$affliation->no;$affliation_dt=$affliation->dt;$affliation_number=$affliation->number;
			}else{				
				$affliation_name="";$affliation_dt="";$affliation_number="";
			}				
			if(!empty($results["banker"])){
				$banker=json_decode($results["banker"]);
				$banker_name=$banker->name;$banker_sn1=$banker->sn1;$banker_sn2=$banker->sn2;$banker_v=$banker->v;$banker_d=$banker->d;$banker_phn_no=$banker->phn_no;$banker_p=$banker->p;
			}else{				
				$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
			}	
		$file1=$results["file1"];$file2=$results["file2"];$file3=$results["file3"];$file4=$results["file4"];$file5=$results["file5"];$file6=$results["file6"];$file7=$results["file7"];$file8=$results["file8"];$file9=$results["file9"];
		if(!isset($css)){
			$val1=$formFunctions->get_uploadFile($results["file1"]);
			$val2=$formFunctions->get_uploadFile($results["file2"]);
			$val3=$formFunctions->get_uploadFile($results["file3"]);
			$val4=$formFunctions->get_uploadFile($results["file4"]);
			$val5=$formFunctions->get_uploadFile($results["file5"]);
			$val6=$formFunctions->get_uploadFile($results["file6"]);
			$val7=$formFunctions->get_uploadFile($results["file7"]);
			$val8=$formFunctions->get_uploadFile($results["file8"]);
			$val9=$formFunctions->get_uploadFile($results["file9"]);
		}else{
			$val1=$formFunctions->get_useruploadFile($results["file1"],$applicant_id);
			$val2=$formFunctions->get_useruploadFile($results["file2"],$applicant_id);
			$val3=$formFunctions->get_useruploadFile($results["file3"],$applicant_id);
			$val4=$formFunctions->get_useruploadFile($results["file4"],$applicant_id);
			$val5=$formFunctions->get_useruploadFile($results["file5"],$applicant_id);
			$val6=$formFunctions->get_useruploadFile($results["file6"],$applicant_id);
			$val7=$formFunctions->get_useruploadFile($results["file7"],$applicant_id);
			$val8=$formFunctions->get_useruploadFile($results["file8"],$applicant_id);
			$val9=$formFunctions->get_useruploadFile($results["file9"],$applicant_id);
		}		
		 
		if($results["payment_mode"]==0){
			$payment_mode="OFFLINE";
			$offline_challan="<a href=".$upload.$results['offline_challan']." target='_blank'>Uploaded</a>";		
		}else{
			$payment_mode="ONLINE";
		}
		 
		if(!empty($results["courier_details"]) && $results["courier_details"]!=1){
			$courier_details=json_decode($results["courier_details"]);
			$courier_details_cn=$courier_details->cn;$courier_details_rn=$courier_details->rn;$courier_details_dt=$courier_details->dt;
		}else{
			$courier_details_cn="";$courier_details_rn="";$courier_details_dt="";
		}
    }
	$form_name=$formFunctions->get_formName('dmedu','2');
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form 3</title>
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
  			'.$assamSarkarLogo.'<h4>FORM NO. - I</h4>
  			<h4>'.$form_name.'</h4>
		</div><br/> 
  	<table width="99%" align="center" class="table table-bordered table-responsive" style="margin:0px auto;border-collapse: collapse" border="1" >
			      

					<tr>
							<td width="50%">1.Name of the Applicant :</td>
							<td width="50%">'.strtoupper($key_person).'</td>
					</tr>
					<tr>
							<td width="50%" valign="top">2. Address :</td>
							<td width="50%">
							<table border="0" width="100%">
							    
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Email-ID :</td>
									<td>'.strtoupper($email).'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
							<td width="50%" valign="top">3. Registered Office :</td>
							<td width="50%">
							<table border="0" width="100%">
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($b_street_name1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($b_street_name2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($b_vill).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($b_dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($b_pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Email-ID :</td>
									<td>'.strtoupper($b_email).'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
						    <td width="50%">4. Constitution :</td>
						    <td>'.strtoupper($constitution).'</td>
					</tr>
					<tr>
					      <td width="50%">5. Registration / Incorporation :</td>
						    <td>Number:'.strtoupper($reg_number).'<br/>
							Date:'.strtoupper($reg_dt).'</td> 
					</tr>
					<tr>
					      <td width="50%">6. Objectives :</td>
						    <td>'.strtoupper($objectives).'</td> 
					</tr>
					<tr>
					      <td width="50%">7. Letter of essentiality/permission from the state government/union territory :</td>
						    <td>Number :'.strtoupper($permission_number).'<br/>
							Date :'.strtoupper($permission_dt).'<br/>
							Issuing authority  :'.strtoupper($permission_issue).'</td> 
					</tr>
					<tr>
					      <td width="50%">8. Letter of University Affliation :</td>
						    <td>Number :'.strtoupper($affliation_number).'<br/>
							Date :'.strtoupper($affliation_dt).'<br/>
							Name of the Institution :'.strtoupper($affliation_name).'<br/></td> 
					</tr>
					<tr>
					      <td width="50%">9. Bankers :</td>
						    <td><table border="0" width="100%">
								<tr>
									<td width="50%">Name :</td>
									<td>'.strtoupper($banker_name).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($banker_sn1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($banker_sn2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($banker_v).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($banker_d).'</td>
								</tr>
								<tr>
									<td width="50%">Contact No. :</td>
									<td>'.strtoupper($banker_phn_no).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($banker_p).'</td>
								</tr>
								
							</table></td> 
					</tr>
                <tr>
					<td colspan="2" height="50px"><font color="red"><b>List of documents to be enclosed.</b></font></td>
				</tr>					
				<tr>
					<td>A copy of Certified Copy of Bye Laws/ Memorandum and Articles of Association/Trust Deed etc.</td>
					<td>'.$val1.'</td>
					
				</tr>					
				<tr>
				  <td>A copy of Certified Copy of Certificates of Registration /Incorporation. </td>
				  <td>'.$val2.'</td>
				</tr>					
				<tr>
				  <td>A copy of  Annual Reports and Audited Balance Sheets for the last 3 years.</td>
				  <td>'.$val3.'</td>
				</tr>					
				<tr>
				  <td>A copy of Certified Copy of the Title Deeds of the total  available land as a proof of ownership. </td>
				  <td>'.$val4.'</td>
				</tr>					
				<tr>
				  <td>A copy of Certified Copy of the Zoning plans of the available sites, indicating their land use. </td>
				  <td>'.$val5.'</td>
				</tr>					
				<tr>
				  <td>A copy of Proof of attachment with Medical College Hospital or 100 bed-ed General Hospital.</td>
				  <td>'.$val6.'</td>
				</tr>					
				<tr>
				  <td>A copy of Certified Copy of the essentially certificate by the respective State Government / Union Territory Administration. </td>
				  <td>'.$val7.'</td>
				</tr>				
				<tr>
				  <td> A copy of Certified copy of the Letter of Affiliation issued by a recognize University.</td>
				  <td>'.$val8.'</td>
				</tr>				
				<tr>
				  <td> A copy of Authorization Latter addressed to the Bankers of the Applicant authorising the Central Government / Dental Council of India to make independent inquiries regarding the financial track record of the applicant.</td>
				  <td>'.$val9.'</td>
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
				<tr><td width="50%">Payment Mode :</td><td>'.strtoupper($payment_mode).'</td></tr>';
				if($results["payment_mode"]==0)
				{
					$printContents=$printContents.'
					<tr>
						<td width="50%" valign="top">Demand Draft/Payment Reciept :</td>
						<td>'.$offline_challan.'<br/><br/>'.
						$formFunctions->offline_payment_details($uain) . '</td>
					</tr>';
				}else{
					$printContents=$printContents.$formFunctions->online_payment_details($results["uain"]);
				}
				$printContents=$printContents.'</table>		
				</td>
			</tr>';
			}
			$printContents=$printContents.' 
			<tr>
				<td valign="top" >Date: '.date('d-m-Y',strtotime($results["sub_date"])).'	</td>
				<td>Signature: '.strtoupper($key_person).'</td>
			</tr> 
			<tr>
				<td valign="top" >Place: '.strtoupper($dist).'	</td>
				<td>Designation : '.strtoupper($status_applicant).'</td>
			</tr>
           
		</table>
	
';
?>
				  
				