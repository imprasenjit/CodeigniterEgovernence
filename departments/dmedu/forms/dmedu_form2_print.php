<?php
 $dept="dmedu";
 $form="2";
 $table_name=$formFunctions->getTableName($dept,$form);
 
	if(!isset($form_id) && !isset($_GET["ui"]) &&  !isset($_GET["token"]) && !isset($_GET["uain"])){
		echo "<script>
				alert('Invalid Page Access');
		</script>";	
		die();
	}else if(isset($_GET["ui"]) && is_numeric($_GET["ui"])){
		$form_id=$_GET["ui"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else if(isset($_GET["uain"])){
		$uain=$_GET["uain"];
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where uain='$uain' and user_id='$swr_id'");
	}else if(isset($form_id)){
		$form_id=$form_id;
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and form_id='$form_id'");
	}else{
		$q=$formFunctions->executeQuery($dept,"select * from ".$table_name." where user_id='$swr_id' and active='1'");
	}

	
	
	
	if($q->num_rows>0){	
		$results=$q->fetch_assoc();
		$form_id=$results['form_id'];
		$constitution=$results["constitution"];$objectives=$results["objectives"];
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
			$affliation_name=$affliation->name;$affliation_dt=$affliation->dt;$affliation_number=$affliation->number;
		}else{				
			$affliation_name="";$affliation_dt="";$affliation_number="";
		}
		if(!empty($results["mailing_address"])){
			$mailing_address=json_decode($results["mailing_address"]);
			$mailing_address_sn1=$mailing_address->sn1;$mailing_address_sn2=$mailing_address->sn2;$mailing_address_vil=$mailing_address->vil;$mailing_address_dist=$mailing_address->dist;$mailing_address_pincode=$mailing_address->pincode;$mailing_address_mno=$mailing_address->mno;$mailing_address_email=$mailing_address->email;
		}else{				
			$mailing_address_sn1="";$mailing_address_sn2="";$mailing_address_vil="";$mailing_address_dist="";$mailing_address_pincode="";$mailing_address_mno="";$mailing_address_email="";
		}	
		if(!empty($results["banker"])){
			$banker=json_decode($results["banker"]);
			$banker_name=$banker->name;$banker_sn1=$banker->sn1;$banker_sn2=$banker->sn2;$banker_v=$banker->v;$banker_d=$banker->d;$banker_phn_no=$banker->phn_no;$banker_p=$banker->p;
		}else{				
			$banker_name="";$banker_sn1="";$banker_sn2="";$banker_v="";$banker_d="";$banker_phn_no="";$banker_p="";
		}			
    }
	$form_name=$formFunctions->get_formName($dept,$form);
	$assamSarkarLogo=$formFunctions->getAssamSarkarLogo($server_url);
	if(!isset($css)){
	$printContents='
	<!DOCTYPE html>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Form '.$form.'</title>
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
	table {	border-spacing: 0;border-collapse: collapse;table-layout: fixed;width:1000px;border: 1px solid black;}table, th, td {border: 1px solid black;}</style>
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
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/> 
  	<table class="table table-bordered table-responsive">
			      
        
					<tr>
							<td width="50%">1.Name of the Applicant :</td>
							<td width="50%">'.strtoupper($key_person).'</td>
					</tr>
					<tr>
							<td width="50%" valign="top">2. Address :</td>
							<td style="width:50%">
    	                     <table class="table table-bordered table-responsive">
							    
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
									<td>'.$email.'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
							<td width="50%" valign="top">3. Registered Office :</td>
							<td valign="top">
		                     <table class="table table-bordered table-responsive">
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
									<td>'.$b_email.'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					<tr>
							<td width="50%" valign="top">4. Mailing Address :</td>
							<td valign="top">
							<table class="table table-bordered table-responsive">
								<tr>
									<td width="50%">Street name 1 :</td>
									<td>'.strtoupper($mailing_address_sn1).'</td>
								</tr>
								<tr>
									<td width="50%">Street name 2 :</td>
									<td>'.strtoupper($mailing_address_sn2).'</td>
								</tr>
								<tr>
									<td width="50%">Village/Town :</td>
									<td>'.strtoupper($mailing_address_vil).'</td>
								</tr>
								<tr>
									<td width="50%">District :</td>
									<td>'.strtoupper($mailing_address_dist).'</td>
								</tr>
								<tr>
									<td width="50%">Pincode :</td>
									<td>'.strtoupper($mailing_address_pincode).'</td>
								</tr>
								<tr>
									<td width="50%">Mobile No :</td>
									<td>'.strtoupper($mailing_address_mno).'</td>
								</tr>
								<tr>
									<td width="50%">Email-ID :</td>
									<td>'.$mailing_address_email.'</td>
								</tr>
								
							</table>
							</td>
					</tr>
					
					<tr>
						    <td width="50%">5. Constitution :</td>
						    <td>'.strtoupper($constitution).'</td>
					</tr>
					<tr>
					      <td width="50%">6. Registration / Incorporation :</td>
						    <td>Number:'.strtoupper($reg_number).'<br/>
							Date:'.strtoupper($reg_dt).'</td> 
					</tr>
					<tr>
					      <td width="50%">7. Objectives :</td>
						   <td>'.strtoupper($objectives).'</td> 
					</tr>
					<tr>
					      <td width="50%">8. Letter of essentiality/permission from the state government/union territory :</td>
						    <td>Number : '.strtoupper($permission_number).'<br/>
							Date : '.strtoupper($permission_dt).'<br/>
							Issuing authority  : '.strtoupper($permission_issue).'</td> 
					</tr>
					<tr>
					      <td width="50%">9. Letter of University Affliation :</td>
						    <td>Number : '.strtoupper($affliation_number).'<br/>
							Date : '.strtoupper($affliation_dt).'<br/>
							Name of the Institution : '.strtoupper($affliation_name).'<br/></td> 
					</tr>
					<tr>
					      <td width="50%">10. Bankers :</td>
						    <td valign="top">
							<table class="table table-bordered table-responsive">
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
					</tr>';
					
                $printContents=$printContents.$formFunctions->print_upload_payment_details($results);
                $printContents=$printContents.'  
		
			<tr>
				<td valign="top" >Date: '.date('d-m-Y',strtotime($results["sub_date"])).'	</td>
				<td align="right">Signature: '.strtoupper($key_person).'</td>
			</tr> 
			<tr>
				<td valign="top" >Place: '.strtoupper($dist).'	</td>
				<td align="right">Designation : '.strtoupper($status_applicant).'</td>
			</tr>
           
		</table>
	
';
?>
				  
				