<?php
 $dept="excise";
 $form="34";
 $table_name=getTableName($dept,$form);
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
		$form_id=$results["form_id"];
			$applicant_age=$results["applicant_age"];$edu_quali=$results["edu_quali"];
			$proposed_site_name=$results["proposed_site_name"];$prev_license_no1=$results["prev_license_no1"];$prev_license_no2=$results["prev_license_no2"];
			$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];
			
			if(!empty($results["present_address"])){
				$present_address=json_decode($results["present_address"]);
				$present_address_sn1=$present_address->sn1;$present_address_sn2=$present_address->sn2;$present_address_vil=$present_address->vill;$present_address_dist=$present_address->dist;$present_address_pin=$present_address->pin;$present_address_mobile_no=$present_address->mobile_no;$present_address_email=$present_address->email;
			}else{				
				$present_address_sn1="";$present_address_sn2="";$present_address_vil="";$present_address_dist="";$present_address_pin="";$present_address_mobile_no="";$present_address_email="";
			}
			if(!empty($results["site_loc"])){
				$site_loc=json_decode($results["site_loc"]);
				if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
				if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
				if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
				if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
				if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
				if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
				
			}else{				
				$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_z="";
			}
			
			if(!empty($results["caste_o"])){
				$caste_o=json_decode($results["caste_o"]);
				if(isset($caste_o->a)) $caste_o_a=$caste_o->a; 
				
			}else{				
				$caste_o_a="";
			}
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
				if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
				if(isset($site_distance->sp)) $site_distance_sp=$site_distance->sp; else $site_distance_sp="";
				
			}else{				
				$site_distance_i="";$site_distance_s="";$site_distance_sp="";
			}
		if($is_liabilities=="Y") $is_liabilities="YES";
		else $is_liabilities="NO";
		if($is_license=="Y") $is_license="YES";
		else $is_license="NO";
		
		if($caste_o_a=="G"){
			$caste_o_a="GENERAL";
		}elseif($caste_o_a=="O"){
		   $caste_o_a="OBC";
	    }elseif($caste_o_a=="M"){
			$caste_o_a="MOBC";
	    }elseif($caste_o_a=="S"){
			$caste_o_a="SC";
		}elseif($caste_o_a=="T"){
			$caste_o_a="ST";
		}else{
			$caste_o_a="";
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
    <div style="text-align:center">'.$assamSarkarLogo.'<h4>'.$form_name.'</h4></div><br/> 
  	<table class="table table-bordered table-responsive">
								<tr>
									<td width="50%">1. Name of Applicant </td>
									<td>'.strtoupper($key_person).'</td>
								</tr>
								<tr>
									<td>2. Age</td>
									<td>'.strtoupper($applicant_age).'</td>
								</tr>
								<tr>
									<td>3. Educational Qualification </td>
									<td>'.strtoupper($edu_quali).'</td>
								</tr>
							    <tr>
									<td valign="top">4. Applicant Present address</td>
									<td>
									<table class="table table-bordered table-responsive">
										
										<tr>
											<td>Street Name 1 :</td>
											<td>'.strtoupper($present_address_sn1).'</td>
										</tr>
										<tr>
											<td>Street name 2 :</td>
											<td>'.strtoupper($present_address_sn2).'</td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td>'.strtoupper($present_address_vil).'</td>
										</tr>
										<tr>
											<td>District :</td>
											<td>'.strtoupper($present_address_dist).'</td>
										</tr>
										<tr>
											<td>Pincode :</td>
											<td>'.strtoupper($present_address_pin).'</td>
										</tr>
										<tr>
											<td>Mobile No. :</td>
											<td>'.strtoupper($present_address_mobile_no).'</td>
										</tr>
										<tr>
											<td>Email-Id :</td>
											<td>'.$present_address_email.'</td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td valign="top">5. Applicant Permanent address </td>
									<td>
									<table class="table table-bordered table-responsive">
										
										<tr>
											<td>Street Name 1 :</td>
											<td>'.strtoupper($street_name1).'</td>
										</tr>
										<tr>
											<td>Street name 2 :</td>
											<td>'.strtoupper($street_name2).'</td>
										</tr>
										<tr>
											<td>Village/Town :</td>
											<td>'.strtoupper($vill).'</td>
										</tr>
										<tr>
											<td>District :</td>
											<td>'.strtoupper($dist).'</td>
										</tr>
										<tr>
											<td>Pincode :</td>
											<td>'.strtoupper($pincode).'</td>
										</tr>
										<tr>
											<td>Mobile No. :</td>
											<td>'.strtoupper($mobile_no).'</td>
										</tr>
										<tr>
											<td>Email-Id :</td>
											<td>'.$email.'</td>
										</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td valign="top">6. Proposed Site Location </td>
									<td>
									<table class="table table-bordered table-responsive">
										
										<tr>
											<td>Plot No :</td>
											<td>'.strtoupper($site_loc_p).'</td>
										</tr>
										<tr>
											<td>Dag No :</td>
											<td>'.strtoupper($site_loc_da).'</td>
										</tr>
										<tr>
											<td>Patta No :</td>
											<td>'.strtoupper($site_loc_pt).'</td>
										</tr>
										<tr>
											<td>City / Town :</td>
											<td>'.strtoupper($site_loc_ct).'</td>
										</tr>
										<tr>
											<td>District :</td>
											<td>'.strtoupper($site_loc_d).'</td>
										</tr>
										<tr>
											<td>Zip / Pincode :</td>
											<td>'.strtoupper($site_loc_z).'</td>
										</tr>
									</table>
									</td>
								</tr>
							
					<tr>
					      <td>7. Proposed site name, Building for retail shop</td>
						  <td>'.strtoupper($proposed_site_name).'</td>
					</tr>		
					<tr>
							<td>8. Your previous license No. held with validity (if any)</td>
							<td>'.strtoupper($prev_license_no1).'</td>
					</tr>
					<tr>
							<td>9. Your previous license No. held by Partner(s) with validity (if any)</td>
							<td>'.strtoupper($prev_license_no2).'</td>
					</tr>
					<tr>
							<td>10. Tax Liabilities (if any)</td>
							<td>'.strtoupper($is_liabilities).'</td>
					</tr>
					<tr>
							<td>11. Distance from Institutions</td>
							<td>'.strtoupper($site_distance_i).'</td>
					</tr>
					<tr>
					      <td>12. Distance from National and State Highway.</td>
					      <td>'.strtoupper($site_distance_s).'</td> 
					</tr>
					<tr>
					      <td>13. Distance from shop(similar)</td>
					      <td>'.strtoupper($site_distance_sp).'</td> 
					</tr>
					<tr>
					      <td>14. Caste</td>
					      <td>'.strtoupper($caste_o_a).'</td> 
					</tr>
					<tr>
					      <td>15. Trade License (if applicable)</td>
					      <td>'.strtoupper($is_license).'</td> 
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
				  
				