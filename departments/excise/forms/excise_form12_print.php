<?php
$dept="excise";
 $form="12";
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
		$name_father=$results["name_father"];$edu_quali=$results["edu_quali"];$owner_age=$results["owner_age"];
		$sex_applicant=$results["sex_applicant"];$state=$results["state"];$pre_past_occupation=$results["pre_past_occupation"];
			
		$is_citizen=$results["is_citizen"];$is_criminal=$results["is_criminal"];$proposed_plant=$results["proposed_plant"];$apparatus_description=$results["apparatus_description"];$plant_site=$results["plant_site"];$ten_date=$results["ten_date"];$esti_quantity=$results["esti_quantity"];$is_servant=$results["is_servant"];$is_pollution=$results["is_pollution"];
			
			
			
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
			
			
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->a)) $site_distance_a=$site_distance->a; else $site_distance_a="";
				if(isset($site_distance->b)) $site_distance_b=$site_distance->b; else $site_distance_b="";
			}else{				
				$site_distance_a="";$site_distance_b="";
			}
		
    	
		if($is_citizen=="Y")
		{
		  $is_citizen="YES";
		}else{
			 $is_citizen="NO";	
		}
		if($is_criminal=="Y")
		{
		  $is_criminal="YES";
		}else{
		  $is_criminal="NO";
		}
		if($is_pollution=="Y")
		{
		  $is_pollution="YES";
		}else{
		  $is_pollution="NO";
		}

        if($is_servant=="Y")
		{
		  $is_servant="YES";
		}else{
		  $is_servant="NO";
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
									<td>1.Name of Applicant </td>
									<td>'.strtoupper($key_person).'</td>
								</tr>
								<tr>
									<td>2.Name of Father/Husband </td>
									<td>'.strtoupper($name_father).'</td>
								</tr>
								<tr>
									<td>3.Sex of Applicant </td>
									<td>'.strtoupper($sex_applicant).'</td>
								</tr>
								<tr>
									<td>4.Age of the applicant </td>
									<td>'.strtoupper($owner_age).'</td>
								</tr>
								<tr>
									<td>5. Educational Qualification </td>
									<td>'.strtoupper($edu_quali).'</td>
								</tr>
							    <tr>
									<td valign="top">6. Address of the Applicant :</td>
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
										<tr>
											<td>State:</td>
											<td>'.strtoupper($state).'</td>
										</tr>
									</table>
									</td>
							</tr>
							
					<tr>
							<td> 7. Present and Past Occupation of the Applicant :</td>
							<td>'.strtoupper($pre_past_occupation).'</td>
					</tr>
					<tr>
							<td>8. Whether the Applicant is a citizen of India as defined in articles 5 & 8 of the Constitution :</td>
							<td>'.strtoupper($is_citizen).'</td>
					</tr>
					<tr>
							<td> 9. Ever Convicted by a Criminal Court :</td>
							<td>'.strtoupper($is_criminal).'</td>
					</tr>
					<tr>
							<td>10. Purposed  of the proposed plant : </td>
							<td>'.strtoupper($proposed_plant).'</td>
					</tr>
					<tr>
						<td valign="top">11. Proposed Site&#39;s Location:</td>
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
								  <td>District :</td>
								  <td>'.strtoupper($site_loc_d).'</td> 
							</tr>
							 <tr>
								 <td>Zip/Pincode :</td>
								  <td>'.strtoupper($site_loc_z).'</td> 
							</tr>
				         </table>
						</td>
					</tr>
					<tr>
					      <td>12. Plant site :</td>
						  <td>'.strtoupper($plant_site).'</td> 
					</tr>
					<tr>
					      <td>13. Apparatus Description :</td>
					      <td>'.strtoupper($apparatus_description).'</td> 
					</tr>
					<tr>
					      <td>14. Tentative date :</td>
						  <td>'.strtoupper($ten_date).'</td> 
					</tr>
					<tr>
					      <td>15. Estimated quantity :</td>
					      <td>'.strtoupper($esti_quantity).'</td> 
					</tr>
					<tr>
					      <td>16. Enviromental pollution,if :</td>
					      <td>'.strtoupper($is_pollution).'</td> 
					</tr>
					<tr>
					      <td>17. Distance from Institutions :</td>
						  <td>'.strtoupper($site_distance_a).'</td> 
					</tr>
					<tr>
					      <td>18. Distance from National/State Highway :</td>
					      <td>'.strtoupper($site_distance_b).'</td> 
					</tr>
					<tr>
					      <td>19. Related to any Government servant,if :</td>
						  <td>'.strtoupper($is_servant).'</td> 
					</tr>
                
				';
				
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
				  
				