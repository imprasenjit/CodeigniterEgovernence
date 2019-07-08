<?php
 $dept="excise";
 $form="93";
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
		$form_id=$results['form_id'];
		$owner_age=$results["owner_age"];$edu_quali=$results["edu_quali"];$proposed_site=$results["proposed_site"];
		$is_liabilities=$results["is_liabilities"];$is_license=$results["is_license"];$previ_licno_validity=$results["previ_licno_validity"];$pre_license_no=$results["pre_license_no"];	
			
			if(!empty($results["site_loc"])){
				$site_loc=json_decode($results["site_loc"]);
				if(isset($site_loc->p)) $site_loc_p=$site_loc->p; else $site_loc_p="";
				if(isset($site_loc->da)) $site_loc_da=$site_loc->da; else $site_loc_da="";
				if(isset($site_loc->pt)) $site_loc_pt=$site_loc->pt; else $site_loc_pt="";
				if(isset($site_loc->d)) $site_loc_d=$site_loc->d; else $site_loc_d="";
				if(isset($site_loc->ct)) $site_loc_ct=$site_loc->ct; else $site_loc_ct="";
				if(isset($site_loc->ar)) $site_loc_ar=$site_loc->ar; else $site_loc_ar="";
				if(isset($site_loc->z)) $site_loc_z=$site_loc->z; else $site_loc_z="";
				
			}else{				
				$site_loc_p="";$site_loc_da="";$site_loc_pt="";$site_loc_d="";$site_loc_ct="";$site_loc_ar="";$site_loc_z="";
			}
			
			if(!empty($results["area_type"])){
				$area_type=json_decode($results["area_type"]);
				if(isset($area_type->a)) $area_type_a=$area_type->a; 
				
			}else{				
				$area_type_a="";
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
			if(!empty($results["pre_add"])){
				$pre_add=json_decode($results["pre_add"]);
				$pre_add_sn1=$pre_add->sn1;$pre_add_sn2=$pre_add->sn2;$pre_add_v=$pre_add->v;$pre_add_d=$pre_add->d;$pre_add_p=$pre_add->p;$pre_add_mno=$pre_add->mno;	
			}else{				
				$pre_add_sn1="";$pre_add_sn2="";$pre_add_v="";$pre_add_d="";$pre_add_p="";$pre_add_mno="";
			}
	
        if($is_liabilities=="Y")
		{
		  $is_liabilities="YES";
		}else{
		  $is_liabilities="NO";
		}
		
		if($is_license=="Y")
		{
		  $is_license="YES";
		}else{
		  $is_license="NO";
		}
		
		if($area_type_a=="U"){
			$area_type_a="URBAN";
		}else if($area_type_a=="R"){
		   $area_type_a="RURAL";
		}else{
			$area_type_a="";
		}
		
		
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
    <div style="text-align:center">
  			'.$assamSarkarLogo.'<h4>'.$form_name.'</h4>
		</div><br/> 
  	<table class="table table-bordered table-responsive">
			      

					<tr>
						<td colspan="2">1. Name and Address of the Applicant :</td>
				    </tr>

					<tr>
							<td width="50%">Applicant Name :</td>
							<td>'.strtoupper($key_person).'</td>
					</tr>
					<tr>
							<td valign="top"> Permanent Address :</td>
							<td>
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td>Street name 1 :</td>
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
									<td>Email-ID :</td>
									<td>'.$email.'</td>
								</tr>
								<tr>
									<td>Mobile No. :</td>
									<td>'.strtoupper($mobile_no).'</td>
								</tr>
							</table>
							</td>
					</tr>
					<tr>
						    <td>2. Education qualification of the applicant :</td>
						    <td>'.strtoupper($edu_quali).'</td>
					</tr>
					<tr>
					      <td>3. Age of the applicant(with proof of age) :</td>
						     <td>'.strtoupper($owner_age).'</td>
					</tr>
					<tr>
							<td valign="top"> 4. Present Address :</td>
							<td>
							<table class="table table-bordered table-responsive">
							    
								<tr>
									<td>Street name 1 :</td>
									<td>'.strtoupper($pre_add_sn1).'</td>
								</tr>
								<tr>
									<td>Street name 2 :</td>
									<td>'.strtoupper($pre_add_sn2).'</td>
								</tr>
								<tr>
									<td>Village/Town :</td>
									<td>'.strtoupper($pre_add_v).'</td>
								</tr>
								<tr>
									<td>District :</td>
									<td>'.strtoupper($pre_add_d).'</td>
								</tr>
								<tr>
									<td>Pincode :</td>
									<td>'.strtoupper($pre_add_p).'</td>
								</tr>
								<tr>
									<td>Mobile No. :</td>
									<td>'.strtoupper($pre_add_mno).'</td>
								</tr>
							</table>
							</td>
					</tr>
					<tr>
						<td valign="top">5. Proposed Site&#39;s Location :</td>
						<td>
						<table class="table table-bordered table-responsive">
							<tr>
								  <td>Plot No. :</td>
								  <td>'.strtoupper($site_loc_p).'</td> 
							</tr>
							<tr>
								  <td>Dag No. :</td>
								  <td>'.strtoupper($site_loc_da).'</td> 
							</tr>
							<tr>
								  <td>Patta No. :</td>
								   <td>'.strtoupper($site_loc_pt).'</td> 
							</tr>
							<tr>
								  <td>City/Town  :</td>
								  <td>'.strtoupper($site_loc_ct).'</td> 
							</tr>
							 <tr>
								 <td>Zip/Pincode :</td>
								  <td>'.strtoupper($site_loc_z).'</td> 
							</tr>
								 
							<tr>
								  <td>District :</td>
								  <td>'.strtoupper($site_loc_d).'</td> 
							</tr>
							<tr>
					            <td>Area type :</td>
					            <td>'.strtoupper($area_type_a).'</td> 
					        </tr>
							
				         </table>
						</td>
					</tr>
					<tr>
					      <td>6. Proposed site name,Building for Retail shop :</td>
						  <td>'.strtoupper($proposed_site).'</td> 
					</tr>
					<tr>
					      <td>7. Your previous License No. held with Validity (if any) :</td>
					      <td>'.strtoupper($pre_license_no).'</td> 
					</tr>
					<tr>
					      <td>8. Previous License No. held by partner(s) with Validity (if any) :</td>
						  <td>'.strtoupper($proposed_site).'</td> 
					</tr>
					<tr>
					      <td>9. Tax Liabilities (if any) :</td>
					      <td>'.strtoupper($is_liabilities).'</td> 
					</tr>
					<tr>
					      <td>10. Trade License (if applicable) :</td>
						  <td>'.strtoupper($is_license).'</td> 
					</tr>
					<tr>
					      <td>11. Distance from Institutions :</td>
					      <td>'.strtoupper($site_distance_i).'</td> 
					</tr>
					<tr>
					      <td>12. Distance from National and State Highway. :</td>
						  <td>'.strtoupper($site_distance_s).'</td> 
					</tr>
					<tr>
					      <td>13. Distance from shop(similar) :</td>
					      <td>'.strtoupper($site_distance_sp).'</td> 
					</tr>
					<tr>
					      <td>14.  Caste : </td>
						  <td>'.strtoupper($caste_o_a).'</td> 
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
				  
				