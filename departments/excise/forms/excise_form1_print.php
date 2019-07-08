<?php
$dept="excise";
$form="1";
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
			$owner_age=$results["owner_age"];$plant_proposed=$results["plant_proposed"];$building_proposed=$results["building_proposed"];$edu_quali=$results["edu_quali"];$state=$results["state"];
			
			if(!empty($results["site_distance"])){
				$site_distance=json_decode($results["site_distance"]);
				if(isset($site_distance->i)) $site_distance_i=$site_distance->i; else $site_distance_i="";
				if(isset($site_distance->s)) $site_distance_s=$site_distance->s; else $site_distance_s="";
				
			}else{				
				$site_distance_i="";$site_distance_s="";
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
			if(!empty($results["site_high"])){
				$site_high=json_decode($results["site_high"]);
				if(isset($site_high->a)) $site_high_a=$site_high->a; else $site_high_a="";
				if(isset($site_high->b)) $site_high_b=$site_high->b; else $site_high_b="";
			}else{				
				$site_high_a="";$site_high_b="";
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
									<td width="50%">1. Name of Applicant :</td>
									<td>'.strtoupper($key_person).'</td>
								</tr>
								<tr>
									<td valign="top">2. Address :</td>
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
									<td>3. State :</td>
									<td>'.strtoupper($state).'</td>
								</tr>
								<tr>
									<td>4. Education qualification of the applicant :</td>
									<td>'.strtoupper($edu_quali).'</td>
								</tr>
								<tr>
									<td>5. Age of the applicant(with proof of age) :</td>
									<td>'.strtoupper($owner_age).'</td>
								</tr>	
								
								<tr>
									<td valign="top">6. Proposed Site Location :</td>
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
					      <td>7. Purpose for which the plant is proposed to be opened. :</td>
						  <td>'.strtoupper($plant_proposed).'</td>
					</tr>		
					<tr>
							<td>8. Site on which proposed building of plants to be set up. :</td>
							<td>'.strtoupper($building_proposed).'</td>
					</tr>
					<tr>
							<td>9. Distance from Institutions :</td>
							<td>'.strtoupper($site_distance_i).'</td>
					</tr>
					<tr>
							<td>10. Distance from National and State Highway. :</td>
							<td>'.strtoupper($site_distance_s).'</td>
					</tr>
					<tr>
						<td colspan="2">11. Distance of the proposed site from  :</td>
					</tr>
					<tr>
							<td>(a)National Highways :</td>
							<td>'.strtoupper($site_high_a).'</td>
					</tr>
					<tr>
					      <td>(b) State Highways :</td>
					      <td>'.strtoupper($site_high_b).'</td> 
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
				  
				